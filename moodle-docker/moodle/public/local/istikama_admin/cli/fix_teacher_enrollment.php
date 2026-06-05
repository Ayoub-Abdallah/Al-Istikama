<?php
/**
 * CLI script to fix teacher enrollment issues.
 *
 * This script iterates over all teacher assignments in the Istikama custom tables
 * (istikama_user_school and istikama_teacher_subject) and ensures that the
 * corresponding users are properly enrolled as 'editingteacher' in the Moodle
 * courses associated with their assigned subjects.
 *
 * Usage:
 * php /path/to/moodle/local/istikama_admin/cli/fix_teacher_enrollment.php
 */
define('CLI_SCRIPT', true);
require_once(__DIR__ . '/../../../../config.php');
require_once($CFG->libdir . '/clilib.php');
require_once(__DIR__ . '/../locallib.php');

cli_heading('Fixing Teacher Enrollments');

global $DB;

$teacher_records = $DB->get_records('istikama_user_school', ['role' => 'teacher']);
if (!$teacher_records) {
    cli_writeln('No teacher assignments found in istikama_user_school.');
    exit(0);
}

$count = 0;
foreach ($teacher_records as $rec) {
    $userid = (int)$rec->userid;
    $subjects = $DB->get_records('istikama_teacher_subject', ['assignmentid' => $rec->id]);
    
    foreach ($subjects as $sub) {
        $courseid = (int)$sub->subject;
        if ($courseid > 0) {
            // Enroll the teacher in the subject course using manual enrollment plugin
            local_istikama_admin_enroll_user_in_subject($userid, $courseid, 'editingteacher');
            cli_writeln("Enrolled Teacher (User ID: $userid) as editingteacher in Course ID: $courseid");
            $count++;
        }
    }
    
    // Enroll the teacher in the central Question Bank to allow question creation
    local_istikama_admin_ensure_qbank_access($userid);
    cli_writeln("Granted QBank access to Teacher (User ID: $userid)");
}

cli_writeln("Done! Fixed enrollment for $count teacher-subject pairs and ensured QBank access.");
exit(0);
