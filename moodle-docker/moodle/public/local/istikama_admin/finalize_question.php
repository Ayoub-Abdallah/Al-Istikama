<?php
/**
 * Finalize a question creation/edit triggered from create_question.php.
 *
 * Moodle's question.php saves the question into the chosen category and redirects
 * to our returnurl with ?lastchanged=<questionid>. We use that to:
 *
 *   - locate the question_bank_entry id for the saved question
 *   - persist {qbe_id, levelid, subjectid, createdby} into istikama_question_meta
 *     (the durable level/subject mapping that survives category renames and
 *      lets us filter the teacher question selector without parsing info fields)
 *   - if quizid is supplied (the request originated from edit_quiz.php's Add New
 *     Question flow): attach the question to that quiz via Moodle's native
 *     quiz_add_quiz_question() so it appears in the quiz's slot list immediately.
 *   - then redirect to activities.php (or back to edit_quiz.php when scoped).
 */
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/locallib.php');
require_once($CFG->dirroot . '/mod/quiz/locallib.php');

require_login();
local_istikama_admin_require_target_user();

global $DB, $USER;

$levelid     = required_param('levelid', PARAM_INT);
$subjectid   = required_param('subjectid', PARAM_INT);
$lastchanged = optional_param('lastchanged', 0, PARAM_INT);
$quizid      = optional_param('quizid', 0, PARAM_INT);
$quizcmid    = optional_param('quizcmid', 0, PARAM_INT);

// Default landing target.
if ($quizcmid) {
    $returnurl = new moodle_url('/local/istikama_admin/edit_quiz.php', ['cmid' => $quizcmid]);
} else {
    $returnurl = new moodle_url('/local/istikama_admin/activities.php', ['tab' => 'questions']);
}

if ($lastchanged) {
    // Find the question_bank_entry id that owns this question id (any version).
    $qbe_id = (int)$DB->get_field_sql("
        SELECT qbe.id
          FROM {question_bank_entries} qbe
          JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
         WHERE qv.questionid = :qid
         LIMIT 1
    ", ['qid' => $lastchanged]);

    if ($qbe_id) {
        $now = time();
        $existing = $DB->get_record('istikama_question_meta', ['qbe_id' => $qbe_id]);
        if ($existing) {
            $existing->levelid      = $levelid;
            $existing->subjectid    = $subjectid;
            $existing->timemodified = $now;
            $DB->update_record('istikama_question_meta', $existing);
        } else {
            $rec = (object)[
                'qbe_id'        => $qbe_id,
                'levelid'       => $levelid,
                'subjectid'     => $subjectid,
                'createdby'     => (int)$USER->id,
                'review_status' => 'approved',
                'reported'      => 0,
                'timecreated'   => $now,
                'timemodified'  => $now,
            ];
            $DB->insert_record('istikama_question_meta', $rec);
        }

        // Attach to the quiz if the request originated from edit_quiz.php.
        if ($quizid) {
            $quiz = $DB->get_record('quiz', ['id' => $quizid]);
            if ($quiz) {
                $cm = get_coursemodule_from_instance('quiz', $quiz->id, $quiz->course);
                if ($cm) {
                    require_capability('mod/quiz:manage', context_module::instance($cm->id));
                    // Avoid double-adding if Moodle already attached the question.
                    $already = $DB->record_exists_sql("
                        SELECT 1
                          FROM {quiz_slots} qs
                          JOIN {question_references} qr ON qr.itemid = qs.id
                         WHERE qs.quizid = :quizid
                           AND qr.component = 'mod_quiz'
                           AND qr.questionarea = 'slot'
                           AND qr.questionbankentryid = :qbe
                    ", ['quizid' => $quiz->id, 'qbe' => $qbe_id]);
                    if (!$already) {
                        try {
                            quiz_add_quiz_question((int)$lastchanged, $quiz);
                        } catch (Exception $e) {
                            // Non-fatal — still return user to the editor.
                        }
                    }
                }
            }
        }

        $returnurl->param('lastchanged', $lastchanged);
    }
}

redirect($returnurl);
