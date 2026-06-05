<?php
/**
 * CLI: Create the central Istikama Question Bank course and enroll the Technical Professor
 * in ALL courses with an editing teacher role so they can access every question bank.
 *
 * Also creates question categories organized by Level > Subject.
 *
 * Run: docker compose exec -T moodle_app php /var/www/html/local/istikama_admin/cli/setup_questionbank.php
 */
define('CLI_SCRIPT', true);
require(__DIR__ . '/../../../config.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/lib/enrollib.php');
require_once($CFG->libdir . '/clilib.php');

global $DB;

// ════════════════════════════════════════════════════════
// 1) Find or create a central "Istikama Question Bank" course
// ════════════════════════════════════════════════════════
$qbcourse = $DB->get_record('course', ['shortname' => 'ISTIKAMA_QBANK']);
if (!$qbcourse) {
    cli_writeln('Creating central Istikama Question Bank course...');
    $cat = $DB->get_record('course_categories', ['parent' => 0], 'id', IGNORE_MULTIPLE);
    $newcourse = new stdClass();
    $newcourse->fullname = 'Istikama Question Bank';
    $newcourse->shortname = 'ISTIKAMA_QBANK';
    $newcourse->category = $cat ? $cat->id : 1;
    $newcourse->summary = 'Central question bank for platform-wide reusable questions and quizzes. Managed by Technical Professors.';
    $newcourse->format = 'topics';
    $newcourse->visible = 0; // Hidden from students
    $newcourse->numsections = 1;
    $newcourse->enablecompletion = 0;
    $qbcourse = create_course((object)$newcourse);
    cli_writeln("  Created course ID: {$qbcourse->id}");
} else {
    cli_writeln("Central QB course already exists (ID: {$qbcourse->id})");
}

// ════════════════════════════════════════════════════════
// 2) Enroll all Technical Professors in ALL courses as editingteacher
// ════════════════════════════════════════════════════════
$techprof_roleid = $DB->get_field('role', 'id', ['shortname' => 'technicalprofessor']);
$editingteacher_roleid = $DB->get_field('role', 'id', ['shortname' => 'editingteacher']);

if (!$techprof_roleid) {
    cli_error('Role "technicalprofessor" not found.');
}
if (!$editingteacher_roleid) {
    cli_error('Role "editingteacher" not found.');
}

// Find all users with the technicalprofessor role at system level.
$systemctx = context_system::instance();
$techprofs = $DB->get_records_sql("
    SELECT DISTINCT ra.userid, u.username
    FROM {role_assignments} ra
    JOIN {user} u ON u.id = ra.userid
    WHERE ra.roleid = :roleid AND ra.contextid = :ctxid
", ['roleid' => $techprof_roleid, 'ctxid' => $systemctx->id]);

cli_writeln("Found " . count($techprofs) . " technical professor(s).");

// Get ALL courses.
$allcourses = $DB->get_records_select('course', 'id <> :siteid', ['siteid' => SITEID], '', 'id, fullname, shortname');

// Enroll manual plugin.
$enrol_manual = enrol_get_plugin('manual');

foreach ($techprofs as $tp) {
    cli_writeln("Processing user: {$tp->username} (ID: {$tp->userid})");
    
    foreach ($allcourses as $course) {
        // Check if already enrolled.
        $coursectx = context_course::instance($course->id);
        
        // Check for manual enrol instance.
        $enrolinstance = $DB->get_record('enrol', [
            'courseid' => $course->id,
            'enrol' => 'manual',
            'status' => ENROL_INSTANCE_ENABLED,
        ], '*', IGNORE_MULTIPLE);
        
        if (!$enrolinstance) {
            // Create manual enrol instance.
            $enrolid = $enrol_manual->add_instance($course);
            $enrolinstance = $DB->get_record('enrol', ['id' => $enrolid]);
        }
        
        // Check if already enrolled in this course.
        $isenrolled = $DB->record_exists('user_enrolments', [
            'userid' => $tp->userid,
            'enrolid' => $enrolinstance->id,
        ]);
        
        if (!$isenrolled) {
            $enrol_manual->enrol_user($enrolinstance, $tp->userid, $editingteacher_roleid);
            cli_writeln("  ✓ Enrolled in: {$course->fullname}");
        }
        
        // Also assign the role in the course context if not already.
        if (!$DB->record_exists('role_assignments', [
            'userid' => $tp->userid,
            'roleid' => $editingteacher_roleid,
            'contextid' => $coursectx->id,
        ])) {
            role_assign($editingteacher_roleid, $tp->userid, $coursectx->id);
        }
    }
}

// ════════════════════════════════════════════════════════
// 3) Create question categories organized by Level > Subject in the QB course
// ════════════════════════════════════════════════════════
cli_writeln("\nSetting up question categories in central QB course...");

$qbcoursectx = context_course::instance($qbcourse->id);

// Ensure a top category exists.
$topcat = $DB->get_record('question_categories', [
    'contextid' => $qbcoursectx->id,
    'parent' => 0,
]);
if (!$topcat) {
    $topcat = new stdClass();
    $topcat->name = 'top';
    $topcat->info = '';
    $topcat->contextid = $qbcoursectx->id;
    $topcat->parent = 0;
    $topcat->sortorder = 0;
    $topcat->stamp = make_unique_id_code();
    $topcat->id = $DB->insert_record('question_categories', $topcat);
}

// Get all levels (depth=2 categories).
$levels = $DB->get_records_select('course_categories', 'depth = 2', null, 'name ASC');

foreach ($levels as $level) {
    // Check for existing level category.
    $levelcat = $DB->get_record('question_categories', [
        'contextid' => $qbcoursectx->id,
        'parent' => $topcat->id,
        'name' => $level->name,
    ]);
    if (!$levelcat) {
        $levelcat = new stdClass();
        $levelcat->name = $level->name;
        $levelcat->info = "Questions for level: {$level->name} (category ID: {$level->id})";
        $levelcat->infoformat = FORMAT_MOODLE;
        $levelcat->contextid = $qbcoursectx->id;
        $levelcat->parent = $topcat->id;
        $levelcat->sortorder = 999;
        $levelcat->stamp = make_unique_id_code();
        $levelcat->id = $DB->insert_record('question_categories', $levelcat);
        cli_writeln("  Created level category: {$level->name}");
    }
    
    // Get subjects for this level.
    $subjects = $DB->get_records('istikama_subject_names', ['level_id' => $level->id], 'name ASC');
    
    foreach ($subjects as $subj) {
        $subcat = $DB->get_record('question_categories', [
            'contextid' => $qbcoursectx->id,
            'parent' => $levelcat->id,
            'name' => $subj->name,
        ]);
        if (!$subcat) {
            $subcat = new stdClass();
            $subcat->name = $subj->name;
            $subcat->info = "Subject: {$subj->name} | Level: {$level->name} | LevelID: {$level->id} | SubjectID: {$subj->id}";
            $subcat->infoformat = FORMAT_MOODLE;
            $subcat->contextid = $qbcoursectx->id;
            $subcat->parent = $levelcat->id;
            $subcat->sortorder = 999;
            $subcat->stamp = make_unique_id_code();
            $subcat->id = $DB->insert_record('question_categories', $subcat);
            cli_writeln("    Created subject category: {$subj->name}");
        }
    }
}

cli_writeln("\n✅ Setup complete! Central QB course ID: {$qbcourse->id}");
cli_writeln("Now purge caches: php admin/cli/purge_caches.php");
