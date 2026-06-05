<?php
define('CLI_SCRIPT', true);
require(__DIR__ . '/../../config.php');
require_once($CFG->dirroot . '/question/editlib.php');
require_once($CFG->dirroot . '/mod/quiz/locallib.php');
require_once($CFG->libdir . '/questionlib.php');

global $DB, $USER;

// Create dummy admin user context if needed
if (!$USER->id) {
    $USER = $DB->get_record('user', ['username' => 'admin']);
}

try {
    $quiz = $DB->get_record('quiz', ['course' => 14], '*', IGNORE_MULTIPLE);
    if (!$quiz) die("Quiz not found\n");
    $cm = get_coursemodule_from_instance('quiz', $quiz->id);
    $quizcontext = context_module::instance($cm->id);

    echo "Quiz Context ID: {$quizcontext->id}\n";
    
    // Attempt to get a question category for this context
    $category = $DB->get_record('question_categories', ['contextid' => $quizcontext->id]);
    if (!$category) {
        $category = new stdClass();
        $category->contextid = $quizcontext->id;
        $category->name = 'Default for ' . $quiz->name;
        $category->info = '';
        $category->parent = 0;
        $category->sortorder = 999;
        $category->stamp = make_unique_id_code();
        $category->id = $DB->insert_record('question_categories', $category);
        echo "Created category ID: {$category->id}\n";
    } else {
        echo "Found category ID: {$category->id}\n";
    }

    // Set up a basic multichoice question object manually to pass to question bank wrapper
    $question = new stdClass();
    $question->category = $category->id . ',' . $category->contextid;
    $question->qtype = 'multichoice';
    $question->name = 'Test simple question';
    $question->questiontext = ['text' => 'What is 2+2?', 'format' => FORMAT_HTML];
    $question->generalfeedback = ['text' => '', 'format' => FORMAT_HTML];
    $question->defaultmark = 1;
    $question->penalty = 0.3333333;
    $question->length = 1;
    $question->stamp = make_unique_id_code();
    $question->version = make_unique_id_code();
    $question->hidden = 0;
    
    // Multichoice specific
    $question->single = 1; // Single choice
    $question->shuffleanswers = 1;
    $question->answernumbering = 'abc';
    $question->showstandardinstruction = 0;
    
    // Answers array
    $question->answer = [
        0 => ['text' => '3', 'format' => FORMAT_HTML],
        1 => ['text' => '4', 'format' => FORMAT_HTML],
        2 => ['text' => '5', 'format' => FORMAT_HTML]
    ];
    $question->fraction = [
        0 => 0,
        1 => 1.0, // Correct answer
        2 => 0
    ];
    $question->feedback = [
        0 => ['text' => '', 'format' => FORMAT_HTML],
        1 => ['text' => '', 'format' => FORMAT_HTML],
        2 => ['text' => '', 'format' => FORMAT_HTML]
    ];

    require_once($CFG->dirroot . '/question/type/questiontypebase.php');
    require_once($CFG->dirroot . '/question/type/multichoice/questiontype.php');
    $qtypeobj = new \qtype_multichoice();
    
    // In Moodle 4.0+, questions are saved via the category manager and question versions!
    // But let's see if save_question still magically handles it 
    $savedq = $qtypeobj->save_question($question, $question);
    
    if (isset($savedq->id)) {
        echo "Saved question successfully! ID: {$savedq->id}\n";
        
        // Add to quiz
        quiz_add_quiz_question($savedq->id, $quiz);
        echo "Added to quiz!\n";
    } else {
        echo "Failed to save question.\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
