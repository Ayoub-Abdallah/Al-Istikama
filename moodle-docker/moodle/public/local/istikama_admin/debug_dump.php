<?php
require('/var/www/html/config.php');
require_once('/var/www/html/question/editlib.php');
require_once('/var/www/html/mod/quiz/locallib.php');
require_once('/var/www/html/lib/questionlib.php');

$CFG->debug = 32767;
$CFG->debugdisplay = 1;

global $DB, $USER;
$USER = $DB->get_record('user', ['username' => 'admin']);
$quiz = $DB->get_record('quiz', ['course' => 14], '*', IGNORE_MULTIPLE);
$cm = get_coursemodule_from_instance('quiz', $quiz->id);
$context = context_module::instance($cm->id);

$category = $DB->get_record('question_categories', ['contextid' => $context->id], '*', IGNORE_MULTIPLE);
if (!$category) {
    echo "Creating category...\n";
    $category = new stdClass();
    $category->contextid = $context->id;
    $category->name = 'Default for ' . $quiz->name;
    $category->info = '';
    $category->parent = 0;
    $category->sortorder = 999;
    $category->stamp = make_unique_id_code();
    $category->id = $DB->insert_record('question_categories', $category);
} else {
    echo "Found category: " . $category->id . "\n";
}

$qtypeobj = question_bank::get_qtype('truefalse');
$q = new stdClass();
$q->category = $category->id . ',' . $category->contextid;
$q->qtype = 'truefalse';
$q->name = 'Test simple tf question';
$q->questiontext = ['text' => 'yes or no?', 'format' => FORMAT_HTML];
$q->generalfeedback = ['text' => '', 'format' => FORMAT_HTML];
$q->defaultmark = 1;
$q->penalty = 0.3333333;
$q->length = 1;
$q->stamp = make_unique_id_code();
$q->version = make_unique_id_code();
$q->hidden = 0;

$q->answer = [0 => ['text' => 'True', 'format' => FORMAT_HTML], 1 => ['text' => 'False', 'format' => FORMAT_HTML]];
$q->fraction = [0 => 1.0, 1 => 0.0];
$q->feedback = [0 => ['text' => '', 'format' => FORMAT_HTML], 1 => ['text' => '', 'format' => FORMAT_HTML]];
$q->correctanswer = true;

echo "Saving question...\n";
$savedq = $qtypeobj->save_question($q, $q);
echo "Saved question ID: " . $savedq->id . "\n";
