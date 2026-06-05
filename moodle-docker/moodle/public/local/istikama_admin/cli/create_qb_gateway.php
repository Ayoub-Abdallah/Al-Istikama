<?php
/**
 * CLI: Create a gateway quiz activity in the Istikama QB course.
 * Moodle requires a cmid (course module) to create questions via the native editor.
 * This script creates a hidden "Question Bank Gateway" quiz in the QB course.
 *
 * Run: docker compose exec -T moodle_app php /var/www/html/local/istikama_admin/cli/create_qb_gateway.php
 */
define('CLI_SCRIPT', true);
require(__DIR__ . '/../../../config.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/mod/quiz/lib.php');
require_once($CFG->libdir . '/clilib.php');

global $DB, $USER, $CFG;

// Find the QB course.
$qbcourse = $DB->get_record('course', ['shortname' => 'ISTIKAMA_QBANK']);
if (!$qbcourse) {
    cli_error('Central QB course (ISTIKAMA_QBANK) not found. Run setup_questionbank.php first.');
}

cli_writeln("QB Course ID: {$qbcourse->id}");

// Check if gateway quiz already exists.
$existing_quiz = $DB->get_record('quiz', ['course' => $qbcourse->id, 'name' => 'Question Bank Gateway']);
if ($existing_quiz) {
    // Find cmid.
    $cm = $DB->get_record_sql("
        SELECT cm.id FROM {course_modules} cm
        JOIN {modules} m ON m.id = cm.module AND m.name = 'quiz'
        WHERE cm.instance = :qid AND cm.course = :cid
    ", ['qid' => $existing_quiz->id, 'cid' => $qbcourse->id]);
    
    if ($cm) {
        cli_writeln("Gateway quiz already exists. CMID: {$cm->id}");
        cli_writeln("Quiz ID: {$existing_quiz->id}");
        exit(0);
    }
}

// Create the gateway quiz using Moodle's API.
$quiz = new stdClass();
$quiz->course = $qbcourse->id;
$quiz->name = 'Question Bank Gateway';
$quiz->intro = 'This is the gateway quiz activity for the central Istikama Question Bank. DO NOT DELETE.';
$quiz->introformat = FORMAT_HTML;
$quiz->timeopen = 0;
$quiz->timeclose = 0;
$quiz->timelimit = 0;
$quiz->preferredbehaviour = 'deferredfeedback';
$quiz->attempts = 0;
$quiz->grademethod = QUIZ_GRADEHIGHEST;
$quiz->grade = 10;
$quiz->sumgrades = 0;
$quiz->decimalpoints = 2;
$quiz->questionsperpage = 0;
$quiz->shuffleanswers = 1;
$quiz->timecreated = time();
$quiz->timemodified = time();
$quiz->visible = 0; // Hidden from students.

// Get the quiz module id.
$quizmoduleid = $DB->get_field('modules', 'id', ['name' => 'quiz']);
if (!$quizmoduleid) {
    cli_error('Quiz module not found in modules table.');
}

// Get/create a section.
$section = $DB->get_record('course_sections', ['course' => $qbcourse->id, 'section' => 0]);
if (!$section) {
    $section = new stdClass();
    $section->course = $qbcourse->id;
    $section->section = 0;
    $section->name = '';
    $section->summary = '';
    $section->summaryformat = FORMAT_HTML;
    $section->sequence = '';
    $section->id = $DB->insert_record('course_sections', $section);
}

// Insert the quiz record.
$quiz->id = $DB->insert_record('quiz', $quiz);
cli_writeln("Created quiz ID: {$quiz->id}");

// Create the course module.
$cm = new stdClass();
$cm->course = $qbcourse->id;
$cm->module = $quizmoduleid;
$cm->instance = $quiz->id;
$cm->section = $section->id;
$cm->added = time();
$cm->visible = 0; // Hidden.
$cm->visibleoncoursepage = 0;
$cm->groupmode = 0;
$cm->idnumber = '';
$cmid = $DB->insert_record('course_modules', $cm);

cli_writeln("Created course module CMID: {$cmid}");

// Add to section sequence.
$seq = $section->sequence;
$section->sequence = $seq ? $seq . ',' . $cmid : $cmid;
$DB->update_record('course_sections', $section);

// Create a top question category for this context.
$modulecontext = context_module::instance($cmid);
$topcat = $DB->get_record('question_categories', [
    'contextid' => $modulecontext->id,
    'parent' => 0,
]);
if (!$topcat) {
    $topcat = new stdClass();
    $topcat->name = 'top';
    $topcat->info = '';
    $topcat->contextid = $modulecontext->id;
    $topcat->parent = 0;
    $topcat->sortorder = 0;
    $topcat->stamp = make_unique_id_code();
    $topcat->id = $DB->insert_record('question_categories', $topcat);
}

// Create default category.
$defcat = $DB->get_record('question_categories', [
    'contextid' => $modulecontext->id,
    'parent' => $topcat->id,
    'name' => 'Default for Question Bank Gateway',
]);
if (!$defcat) {
    $defcat = new stdClass();
    $defcat->name = 'Default for Question Bank Gateway';
    $defcat->info = 'The default category for questions shared in the Question Bank Gateway.';
    $defcat->infoformat = FORMAT_MOODLE;
    $defcat->contextid = $modulecontext->id;
    $defcat->parent = $topcat->id;
    $defcat->sortorder = 999;
    $defcat->stamp = make_unique_id_code();
    $defcat->id = $DB->insert_record('question_categories', $defcat);
}

cli_writeln("\n✅ Gateway quiz created successfully!");
cli_writeln("  Quiz ID: {$quiz->id}");
cli_writeln("  CMID: {$cmid}");
cli_writeln("  Context ID: {$modulecontext->id}");
cli_writeln("\nNow purge caches: php admin/cli/purge_caches.php");
