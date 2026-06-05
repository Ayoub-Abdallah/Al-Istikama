<?php
/**
 * Create a new reusable quiz inside the central ISTIKAMA_QBANK course.
 *
 * Inputs (POST): levelid, subjectid, name, sesskey.
 * Creates a real Moodle quiz module via quiz table + course_modules + course_sections
 * wiring, registers Level/Subject metadata into istikama_quiz_meta, then
 * redirects to edit_quiz.php?cmid=NEWCMID so the user can add questions.
 *
 * This endpoint is POST-only; the quiz name is collected in the Create Quiz
 * modal on activities.php.
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');
require_once($CFG->dirroot . '/course/lib.php');

require_login();
require_sesskey();
local_istikama_admin_require_target_user();

global $DB, $USER, $PAGE, $OUTPUT;

$levelid   = required_param('levelid', PARAM_INT);
$subjectid = required_param('subjectid', PARAM_INT);
$name      = required_param('name', PARAM_TEXT);

$returnurl = new moodle_url('/local/istikama_admin/activities.php', ['tab' => 'quizzes']);

// Name must not be empty.
$name = trim($name);
if ($name === '') {
    throw new moodle_exception('missingfield', 'error', $returnurl, null, 'Quiz name is required.');
}

// Validate level + subject.
$level   = $DB->get_record('course_categories', ['id' => $levelid, 'depth' => 2], '*', MUST_EXIST);
$subject = $DB->get_record('istikama_subject_names', ['id' => $subjectid, 'level_id' => $levelid], '*', MUST_EXIST);

// Find the central QB course (where reusable quizzes live).
$qbcourse = $DB->get_record('course', ['shortname' => 'ISTIKAMA_QBANK']);
if (!$qbcourse) {
    throw new moodle_exception('errornoqbcourse', 'error', $returnurl,
        null, 'Central Question Bank course (ISTIKAMA_QBANK) not found. Run setup_questionbank.php.');
}

$qbcoursectx = context_course::instance($qbcourse->id);
require_capability('moodle/course:manageactivities', $qbcoursectx);

// ─────────────────────────────────────────────────────────────────────────────
// Real creation: insert a quiz + course_module + section linkage.
// Mirrors the pattern used by cli/create_qb_gateway.php (Moodle-native).
// ─────────────────────────────────────────────────────────────────────────────
$quizmoduleid = $DB->get_field('modules', 'id', ['name' => 'quiz']);
if (!$quizmoduleid) {
    throw new moodle_exception('moduledoesnotexist', 'error', $returnurl, null, 'mod_quiz not installed.');
}

// Ensure a section exists (use section 1 — section 0 holds the gateway).
$section = $DB->get_record('course_sections', ['course' => $qbcourse->id, 'section' => 1]);
if (!$section) {
    $section = (object)[
        'course'        => $qbcourse->id,
        'section'       => 1,
        'name'          => 'Reusable Quizzes',
        'summary'       => '',
        'summaryformat' => FORMAT_HTML,
        'sequence'      => '',
    ];
    $section->id = $DB->insert_record('course_sections', $section);
}

// Insert the quiz record (Moodle defaults).
$now = time();
$quiz = (object)[
    'course'             => $qbcourse->id,
    'name'               => $name,
    'intro'              => '',
    'introformat'        => FORMAT_HTML,
    'timeopen'           => 0,
    'timeclose'          => 0,
    'timelimit'          => 0,
    'overduehandling'    => 'autoabandon',
    'preferredbehaviour' => 'deferredfeedback',
    'attempts'           => 0,
    'grademethod'        => 1, // QUIZ_GRADEHIGHEST
    'grade'              => 10,
    'sumgrades'          => 0,
    'decimalpoints'      => 2,
    'questionsperpage'   => 0,
    'shuffleanswers'     => 1,
    'navmethod'          => 'free',
    'showuserpicture'    => 0,
    'showblocks'         => 0,
    'graceperiod'        => 0,
    'reviewattempt'      => 65536 | 4096 | 256 | 16, // sensible defaults
    'reviewcorrectness'  => 65536 | 4096 | 256 | 16,
    'reviewmarks'        => 65536 | 4096 | 256 | 16,
    'reviewspecificfeedback' => 65536 | 4096 | 256 | 16,
    'reviewgeneralfeedback'  => 65536 | 4096 | 256 | 16,
    'reviewrightanswer'      => 65536 | 4096 | 256 | 16,
    'reviewoverallfeedback'  => 65536 | 4096 | 256 | 16,
    'questiondecimalpoints'  => -1,
    'timecreated'        => $now,
    'timemodified'       => $now,
];
$quiz->id = $DB->insert_record('quiz', $quiz);

// Create course module.
$cm = (object)[
    'course'              => $qbcourse->id,
    'module'              => $quizmoduleid,
    'instance'            => $quiz->id,
    'section'             => $section->id,
    'added'               => $now,
    'visible'             => 1,
    'visibleoncoursepage' => 1,
    'groupmode'           => 0,
    'idnumber'            => '',
];
$cmid = $DB->insert_record('course_modules', $cm);

// Update section sequence.
$seq = $section->sequence;
$section->sequence = $seq ? ($seq . ',' . $cmid) : (string)$cmid;
$DB->update_record('course_sections', $section);

// Build context for the new module + rebuild course cache.
context_module::instance($cmid);
rebuild_course_cache($qbcourse->id, true);

// Persist reusable-quiz metadata.
$meta = (object)[
    'quizid'        => (int)$quiz->id,
    'cmid'          => (int)$cmid,
    'levelid'       => (int)$levelid,
    'subjectid'     => (int)$subjectid,
    'createdby'     => (int)$USER->id,
    'reusable'      => 1,
    'review_status' => 'approved',
    'reported'      => 0,
    'reportedby'    => null,
    'reportreason'  => null,
    'timecreated'   => $now,
    'timemodified'  => $now,
];
$DB->insert_record('istikama_quiz_meta', $meta);

// Jump straight into our edit_quiz.php wrapper.
redirect(new moodle_url('/local/istikama_admin/edit_quiz.php', ['cmid' => $cmid]));
