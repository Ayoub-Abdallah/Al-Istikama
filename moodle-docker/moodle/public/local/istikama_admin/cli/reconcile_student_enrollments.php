<?php
/**
 * Reconcile student Moodle-course enrollments to match their CURRENT class.
 *
 * Background: before the per-promotion unenroll fix landed, students who were
 * moved from class A to class B remained enrolled in A's Moodle courses,
 * leaving them in two classes' worth of subjects at once. This script walks
 * every active (status='enrolled') student in istikama_user_school for the
 * latest season, looks at every course their old/other class memberships
 * registered them in, and unenrolls them from anything that doesn't belong
 * to their current class.
 *
 * Idempotent — safe to re-run. Touches only manual enrollments; never
 * istikama_user_school rows or audit logs (historical data preserved).
 *
 * Usage:
 *   php local/istikama_admin/cli/reconcile_student_enrollments.php          # dry-run
 *   php local/istikama_admin/cli/reconcile_student_enrollments.php --apply  # actually unenroll
 */

define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../../config.php');
require_once($CFG->libdir . '/clilib.php');
require_once($CFG->dirroot . '/local/istikama_admin/locallib.php');

list($options, $unrecognised) = cli_get_params(
    ['apply' => false, 'help' => false],
    ['h' => 'help']
);

if ($options['help']) {
    cli_writeln("Reconcile student enrollments to current class only.");
    cli_writeln("  --apply   Actually unenroll. Without this flag runs in dry-run mode.");
    cli_writeln("  --help    Show this help.");
    exit(0);
}

$apply = (bool)$options['apply'];
cli_heading('Reconcile Student Enrollments ' . ($apply ? '(APPLYING)' : '(DRY RUN)'));

global $DB;

// Find the ACTIVE season. Without one, there's no "current class" to bind to.
$activeseasonid = \local_istikama_admin\season_manager::get_active_id();
if (!$activeseasonid) {
    cli_writeln('No active season — nothing to reconcile. Enrollments are gated by season activation.');
    exit(0);
}

// Pull every student row tied to the active season. THAT row's classid is
// the student's current class — every Moodle enrollment must align to it.
// Rows in upcoming/closed seasons are ignored here (their enrollments are
// not yet/no longer the source of truth).
$students = $DB->get_records_sql("
    SELECT us.userid AS userid, us.id AS latestrowid
      FROM {istikama_user_school} us
     WHERE us.role = 'student'
       AND us.status = 'enrolled'
       AND us.seasonid = :seasonid
", ['seasonid' => $activeseasonid]);

if (!$students) {
    cli_writeln('No active student enrollments found for season id ' . $activeseasonid . '.');
    exit(0);
}

cli_writeln('Scanning ' . count($students) . ' active student(s)...');

$totalremoved = 0;
$totalkept = 0;
$totalstudents = 0;

require_once($CFG->dirroot . '/lib/enrollib.php');
$manualenrol = enrol_get_plugin('manual');
if (!$manualenrol) {
    cli_error('Manual enrol plugin not available — cannot continue.');
}

foreach ($students as $row) {
    $userid = (int)$row->userid;
    $currentrow = $DB->get_record('istikama_user_school', ['id' => (int)$row->latestrowid]);
    if (!$currentrow || empty($currentrow->classid)) {
        continue;
    }

    $currentclassid = (int)$currentrow->classid;

    // Build the set of allowed Moodle course ids for this student's CURRENT class.
    $allowed = $DB->get_records('istikama_class_subjects', ['classid' => $currentclassid], '', 'id, courseid');
    $allowedcids = [];
    foreach ($allowed as $a) {
        $allowedcids[(int)$a->courseid] = true;
    }

    // Find every Moodle course the student is currently enrolled in.
    $enrolledcourses = enrol_get_users_courses($userid, false, 'id');
    if (empty($enrolledcourses)) {
        continue;
    }

    // For each enrollment, check if the course is bound to ANY class in our
    // istikama_class_subjects table. If so, and it's NOT in the allowed set,
    // unenroll. Courses NOT in the table (e.g. central question bank,
    // teacher-shared courses) are never touched.
    $perstudentremoved = 0;
    $perstudentkept = 0;

    foreach ($enrolledcourses as $course) {
        $cid = (int)$course->id;
        $istikamabound = $DB->record_exists('istikama_class_subjects', ['courseid' => $cid]);
        if (!$istikamabound) {
            // Not a class-bound course — leave alone.
            continue;
        }
        if (isset($allowedcids[$cid])) {
            $perstudentkept++;
            continue;
        }

        // Stale enrollment — must be removed.
        if ($apply) {
            try {
                $instance = $DB->get_record('enrol', [
                    'courseid' => $cid,
                    'enrol'    => 'manual',
                ], '*', IGNORE_MULTIPLE);
                if ($instance) {
                    $manualenrol->unenrol_user($instance, $userid);
                    $perstudentremoved++;
                }
            } catch (\Throwable $e) {
                cli_writeln("  ! user $userid course $cid: " . $e->getMessage());
            }
        } else {
            $perstudentremoved++;
        }
    }

    if ($perstudentremoved > 0) {
        $totalstudents++;
        $totalremoved += $perstudentremoved;
        $totalkept += $perstudentkept;
        cli_writeln(sprintf(
            "  user %d (class %d): %s%d stale course(s), %d kept",
            $userid,
            $currentclassid,
            $apply ? 'unenrolled from ' : 'WOULD remove ',
            $perstudentremoved,
            $perstudentkept
        ));
    }
}

cli_writeln('');
cli_writeln(sprintf(
    '%s %d student(s); %d stale enrollment(s) %s, %d kept (in current class).',
    $apply ? 'Reconciled' : 'Would reconcile',
    $totalstudents,
    $totalremoved,
    $apply ? 'removed' : 'detected',
    $totalkept
));

if (!$apply) {
    cli_writeln('');
    cli_writeln('Run again with --apply to actually unenroll.');
}
