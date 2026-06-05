<?php
/**
 * Add Quiz / Exam to a course — Teacher flow.
 *
 * Two entry points:
 *   1. Pick a reusable quiz (filtered by teacher's level/subject) → clone its
 *      slot list into a new quiz CM created in the target course.
 *   2. Create a brand-new quiz CM in the target course → redirect to
 *      edit_quiz.php so the teacher can add questions (existing or new).
 *
 * Both paths use Moodle-native APIs:
 *   - course_modules / quiz inserts
 *   - mod_quiz\quiz_settings::create()
 *   - mod_quiz\structure::create_for_quiz()
 *   - quiz_add_quiz_question()
 *
 * Query params:
 *   courseid    (int)    target course id
 *   sectionnum  (int)    target section number
 *   beforemod   (int)    optional course_modules.id to insert before
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/mod/quiz/locallib.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_target_user();

global $DB, $PAGE, $OUTPUT, $USER;

$courseid   = required_param('courseid', PARAM_INT);
$sectionnum = optional_param('sectionnum', 0, PARAM_INT);
$beforemod  = optional_param('beforemod', 0, PARAM_INT);
$action     = optional_param('action', '', PARAM_ALPHA);

$course = $DB->get_record('course', ['id' => $courseid], '*', MUST_EXIST);
$ctx    = context_course::instance($course->id);
require_capability('moodle/course:manageactivities', $ctx);

$PAGE->set_url(new moodle_url('/local/istikama_admin/add_course_quiz.php', ['courseid' => $courseid]));
$PAGE->set_context($ctx);
$PAGE->set_course($course);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('addquiz_page_title', 'local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

// Resolve teacher's level scope for filtering reusable quizzes.
$teacher_levelids = [];
try {
    $assignments = local_istikama_admin_get_teacher_assignments();
    foreach ($assignments as $a) {
        if (!empty($a->levelid)) { $teacher_levelids[(int)$a->levelid] = (int)$a->levelid; }
    }
    $teacher_levelids = array_values($teacher_levelids);
} catch (\Exception $e) {}

// ── Helper: create a brand-new quiz CM in the target course ───────────────
$create_quiz_cm = function(string $name) use ($course, $sectionnum, $USER, $DB) {
    global $CFG;
    require_once($CFG->dirroot . '/course/modlib.php');

    $mi = new stdClass();
    $mi->modulename  = 'quiz';
    $mi->course      = $course->id;
    $mi->section     = $sectionnum;
    $mi->visible     = 1;
    $mi->name        = $name;
    $mi->introeditor = ['text' => '', 'format' => FORMAT_HTML, 'itemid' => 0];

    // Fields that quiz_process_options() reads and writes to the DB.
    // quizpassword → password (NOTNULL, no DEFAULT — omitting causes "Error writing to database").
    $mi->quizpassword    = '';
    $mi->subnet          = '';
    $mi->browsersecurity = '';

    $mi->preferredbehaviour    = 'deferredfeedback';
    $mi->attempts              = 0;
    $mi->attemptonlast         = 0;
    $mi->grademethod           = 1; // QUIZ_GRADEHIGHEST
    $mi->grade                 = 10;
    $mi->sumgrades             = 0;
    $mi->questionsperpage      = 1;
    $mi->shuffleanswers        = 1;
    $mi->navmethod             = 'free';
    $mi->decimalpoints         = 2;
    $mi->questiondecimalpoints = -1;
    $mi->timelimit             = 0;
    $mi->overduehandling       = 'autosubmit';
    $mi->graceperiod           = 0;
    $mi->timeopen              = 0;
    $mi->timeclose             = 0;
    $mi->delay1                = 0;
    $mi->delay2                = 0;
    $mi->showuserpicture       = 0;
    $mi->showblocks            = 0;

    // Individual review-option booleans that quiz_review_option_form_to_db() reads.
    foreach (['attempt','correctness','maxmarks','marks','specificfeedback','generalfeedback','rightanswer'] as $f) {
        $mi->{$f . 'during'}      = 1;
        $mi->{$f . 'immediately'} = 1;
        $mi->{$f . 'open'}        = 1;
        $mi->{$f . 'closed'}      = 1;
    }
    $mi->overallfeedbackduring      = 0;
    $mi->overallfeedbackimmediately = 1;
    $mi->overallfeedbackopen        = 1;
    $mi->overallfeedbackclosed      = 1;

    return create_module($mi);
};

// ── POST: create new empty quiz ───────────────────────────────────────────
if ($action === 'createnew' && confirm_sesskey()) {
    $name = trim(required_param('name', PARAM_TEXT));
    if ($name === '') {
        \core\notification::error('Quiz name is required.');
        redirect($PAGE->url);
    }
    $cm = $create_quiz_cm($name);

    // Register level/subject metadata if the teacher has a single level.
    $tlvl = $teacher_levelids[0] ?? 0;
    if ($tlvl) {
        try {
            $DB->insert_record('istikama_quiz_meta', (object)[
                'quizid'        => (int)$cm->instance,
                'cmid'          => (int)$cm->coursemodule,
                'levelid'       => (int)$tlvl,
                'subjectid'     => 0,
                'createdby'     => (int)$USER->id,
                'reusable'      => 0,
                'review_status' => 'approved',
                'timecreated'   => time(),
                'timemodified'  => time(),
            ]);
        } catch (\Exception $e) {}
    }

    \core\notification::success(get_string('quiz_created_success', 'local_istikama_admin', format_string($name)));
    redirect(new moodle_url('/local/istikama_admin/edit_quiz.php', ['cmid' => $cm->coursemodule]));
}

// ── POST: clone a reusable quiz into the target course ───────────────────
if ($action === 'reuse' && confirm_sesskey()) {
    try {
        $sourcequizid = required_param('quizid', PARAM_INT);
        $sourcequiz = $DB->get_record('quiz', ['id' => $sourcequizid], '*', MUST_EXIST);

        // Create a fresh quiz CM in the target course, copying the source name.
        $newcm = $create_quiz_cm($sourcequiz->name);
        $newquizid = (int)$newcm->instance;

        // Fetch slots from source, each with the latest non-hidden question id.
        $sourceslots = $DB->get_records_sql("
            SELECT qs.id        AS slotid,
                   qs.slot      AS slotnum,
                   qs.page      AS page,
                   qs.maxmark   AS maxmark,
                   qr.questionbankentryid AS qbeid
              FROM {quiz_slots} qs
         LEFT JOIN {question_references} qr
                ON qr.itemid = qs.id
               AND qr.component = 'mod_quiz'
               AND qr.questionarea = 'slot'
             WHERE qs.quizid = :quizid
          ORDER BY qs.slot ASC
        ", ['quizid' => $sourcequizid]);

        // We need a fully-hydrated quiz object for quiz_add_quiz_question().
        $newquizrec = $DB->get_record('quiz', ['id' => $newquizid], '*', MUST_EXIST);

        $copied = 0;
        foreach ($sourceslots as $s) {
            if (empty($s->qbeid)) { continue; }
            // Resolve latest non-hidden questionid for this entry.
            $qid = $DB->get_field_sql("
                SELECT qv.questionid
                  FROM {question_versions} qv
                 WHERE qv.questionbankentryid = :qbeid
                   AND qv.status <> 'hidden'
              ORDER BY qv.version DESC
            ", ['qbeid' => (int)$s->qbeid], IGNORE_MULTIPLE);
            if (!$qid) {
                // Fallback: take latest version regardless of status.
                $qid = $DB->get_field_sql("
                    SELECT qv.questionid
                      FROM {question_versions} qv
                     WHERE qv.questionbankentryid = :qbeid
                  ORDER BY qv.version DESC
                ", ['qbeid' => (int)$s->qbeid], IGNORE_MULTIPLE);
            }
            if (!$qid) { continue; }

            // Native API: handles slot row + question_references row.
            quiz_add_quiz_question(
                (int)$qid,
                $newquizrec,
                (int)$s->page,
                (float)$s->maxmark
            );
            $copied++;
        }

        // Recompute sumgrades on the new quiz (Moodle 5 API).
        try {
            $qsettings = \mod_quiz\quiz_settings::create($newquizid);
            $qsettings->get_grade_calculator()->recompute_quiz_sumgrades();
        } catch (\Exception $e) {
            debugging('recompute_quiz_sumgrades failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }

        rebuild_course_cache($course->id, true);

        \core\notification::success(get_string('quiz_cloned_success', 'local_istikama_admin', $copied));
        redirect(new moodle_url('/course/view.php', ['id' => $course->id]));
    } catch (\Throwable $e) {
        \core\notification::error('Failed to clone quiz: ' . $e->getMessage());
        // Stay on page so the teacher can retry / report.
        redirect(new moodle_url('/local/istikama_admin/add_course_quiz.php', [
            'courseid' => $courseid, 'sectionnum' => $sectionnum, 'beforemod' => $beforemod, 'tab' => 'reuse',
        ]));
    }
}

// ── POST: create homework (Moodle native mod_assign) ─────────────────────
if ($action === 'createhomework' && confirm_sesskey()) {
    require_once($CFG->dirroot . '/course/modlib.php');
    require_once($CFG->dirroot . '/mod/assign/lib.php');

    $name = trim(required_param('name', PARAM_TEXT));
    if ($name === '') {
        \core\notification::error('Homework title is required.');
        redirect($PAGE->url);
    }
    $description  = optional_param('hw_description', '', PARAM_RAW);
    $duedate      = optional_param('hw_duedate', 0, PARAM_INT);
    $allow_file   = optional_param('hw_allow_file', 1, PARAM_INT);
    $allow_text   = optional_param('hw_allow_text', 0, PARAM_INT);

    // Build the moduleinfo object for create_module().
    $mi = new stdClass();
    $mi->modulename  = 'assign';
    $mi->course      = $course->id;
    $mi->section     = $sectionnum;
    $mi->visible     = 1;
    $mi->name        = $name;
    $mi->introeditor = ['text' => $description, 'format' => FORMAT_HTML, 'itemid' => 0];
    $mi->showdescription = 1;

    // Submission types.
    $mi->assignsubmission_file_enabled    = $allow_file ? 1 : 0;
    $mi->assignsubmission_file_maxfiles   = 5;
    $mi->assignsubmission_file_maxsizebytes = 0; // Use site default.
    $mi->assignsubmission_onlinetext_enabled = $allow_text ? 1 : 0;

    // Feedback types.
    $mi->assignfeedback_comments_enabled  = 1;
    $mi->assignfeedback_file_enabled      = 1;
    $mi->assignfeedback_offline_enabled   = 0;

    // Dates.
    $mi->duedate          = $duedate ?: 0;
    $mi->allowsubmissionsfromdate = 0;
    $mi->cutoffdate       = 0;
    $mi->gradingduedate   = 0;

    // Grading.
    $mi->grade            = 100;
    $mi->submissiondrafts = 0;
    $mi->requiresubmissionstatement = 0;
    $mi->sendnotifications          = 0;
    $mi->sendlatenotifications      = 0;
    $mi->sendstudentnotifications   = 1;
    $mi->teamsubmission   = 0;
    $mi->requireallteammemberssubmit = 0; // Required by assign_add_instance even with teamsubmission=0.
    $mi->teamsubmissiongroupingid    = 0;
    $mi->preventsubmissionnotingroup = 0;
    $mi->blindmarking     = 0;
    $mi->markingworkflow  = 0;
    $mi->markingallocation = 0;          // Required even when markingworkflow=0.
    $mi->markinganonymous  = 0;
    $mi->hidegrader        = 0;
    $mi->maxattempts      = -1;
    $mi->attemptreopenmethod = 'none';
    $mi->completionsubmit   = 0;
    $mi->activityeditor     = ['text' => '', 'format' => FORMAT_HTML, 'itemid' => 0];
    // Common Moodle module fields that create_module() relies on.
    $mi->visibleoncoursepage = 1;
    $mi->cmidnumber          = '';
    $mi->groupmode           = 0;
    $mi->groupingid          = 0;

    $cm = create_module($mi);

    // Attach uploaded files (from $_FILES['hw_files']) as introattachments.
    if (!empty($_FILES['hw_files']) && is_array($_FILES['hw_files']['name'])) {
        $fs = get_file_storage();
        $modctx = context_module::instance($cm->coursemodule);
        $uploads = $_FILES['hw_files'];
        $count = count($uploads['name']);
        for ($i = 0; $i < $count; $i++) {
            if (empty($uploads['tmp_name'][$i]) || $uploads['error'][$i] !== UPLOAD_ERR_OK) {
                continue;
            }
            $filename = clean_param($uploads['name'][$i], PARAM_FILE);
            if ($filename === '') { continue; }
            try {
                // Skip duplicates within the same upload batch.
                if ($fs->file_exists($modctx->id, 'mod_assign', 'introattachment', 0, '/', $filename)) {
                    continue;
                }
                $fs->create_file_from_pathname([
                    'contextid' => $modctx->id,
                    'component' => 'mod_assign',
                    'filearea'  => 'introattachment',
                    'itemid'    => 0,
                    'filepath'  => '/',
                    'filename'  => $filename,
                ], $uploads['tmp_name'][$i]);
            } catch (\Throwable $e) {
                debugging('Homework file upload failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
            }
        }
    }

    rebuild_course_cache($course->id, true);
    \core\notification::success(get_string('homework_created_success', 'local_istikama_admin', format_string($name)));
    redirect(new moodle_url('/local/istikama_admin/view_homework.php', ['id' => $cm->coursemodule]));
}

require_once(__DIR__ . '/admin_layout.php');

// Reusable quiz list, scoped to teacher's levels.
$reusable_quizzes = [];
try {
    $where  = ["iqm.reusable = 1", "qz.name <> 'Question Bank Gateway'"];
    $params = [];
    if (!empty($teacher_levelids)) {
        list($insql, $inparams) = $DB->get_in_or_equal($teacher_levelids, SQL_PARAMS_NAMED, 'lvl');
        $where[] = "iqm.levelid $insql";
        $params = array_merge($params, $inparams);
    }
    $wheresql = 'WHERE ' . implode(' AND ', $where);
    $reusable_quizzes = $DB->get_records_sql("
        SELECT qz.id, qz.name, qz.grade,
               iqm.levelid, iqm.subjectid,
               lvl.name AS levelname, subj.name AS subjectname,
               (SELECT COUNT(*) FROM {quiz_slots} qs WHERE qs.quizid = qz.id) AS slotcount
          FROM {quiz} qz
          JOIN {istikama_quiz_meta} iqm ON iqm.quizid = qz.id
     LEFT JOIN {course_categories} lvl ON lvl.id = iqm.levelid
     LEFT JOIN {istikama_subject_names} subj ON subj.id = iqm.subjectid
            $wheresql
      ORDER BY qz.timecreated DESC
    ", $params, 0, 100);
} catch (\Exception $e) {}

$dir       = right_to_left() ? 'rtl' : 'ltr';
$cancelurl = new moodle_url('/course/view.php', ['id' => $course->id]);
$tabchoice = optional_param('tab', 'new', PARAM_ALPHA);
?>
<div class="container-fluid" dir="<?= $dir ?>" style="background:#f1f5f9;min-height:600px;margin:-24px;padding:24px;">

    <!-- Header -->
    <div class="isti-card" style="padding:20px 24px;margin-bottom:18px;display:flex;align-items:center;gap:14px;flex-wrap:wrap">
        <a href="<?= $cancelurl->out(false) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-arrow-left"></i> <?= get_string('back_to_lesson', 'local_istikama_admin') ?>
        </a>
        <span style="display:inline-flex;align-items:center;justify-content:center;width:46px;height:46px;border-radius:12px;background:#f0fdf4;color:#10b981;font-size:1.2rem">
            <i class="fa fa-question-circle"></i>
        </span>
        <div style="flex:1;min-width:200px">
            <h5 style="margin:0;font-weight:700;color:#1e293b"><?= get_string('addquiz_page_title', 'local_istikama_admin') ?></h5>
            <div style="font-size:.85rem;color:#64748b;margin-top:4px">
                <i class="fa fa-book-open"></i> <?= format_string($course->fullname) ?>
                · <?= get_string('section_label', 'local_istikama_admin') ?> <?= (int)$sectionnum ?>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <div class="isti-tabs" style="margin-bottom:20px">
        <?php foreach (['new' => ['fa-plus', get_string('addquiz_tab_new', 'local_istikama_admin')], 'reuse' => ['fa-copy', get_string('addquiz_tab_reuse', 'local_istikama_admin')], 'homework' => ['fa-file-upload', get_string('addquiz_tab_homework', 'local_istikama_admin')]] as $k => [$ico, $lbl]): ?>
        <button class="isti-tab <?= $tabchoice === $k ? 'active' : '' ?>"
                onclick="window.location='<?= (new moodle_url('/local/istikama_admin/add_course_quiz.php', ['courseid' => $courseid, 'sectionnum' => $sectionnum, 'beforemod' => $beforemod, 'tab' => $k]))->out(false) ?>'">
            <i class="fa <?= $ico ?>"></i> <?= $lbl ?>
        </button>
        <?php endforeach; ?>
    </div>

    <?php if ($tabchoice === 'new'): ?>
    <!-- Create new -->
    <div class="isti-card" style="padding:24px 28px;max-width:640px">
        <h6 style="font-weight:700;color:#1e293b;margin-bottom:16px"><i class="fa fa-plus" style="color:#006bff"></i> <?= get_string('create_quiz_brand_new', 'local_istikama_admin') ?></h6>
        <p style="color:#64748b;font-size:.88rem;margin-bottom:18px">
            <?= get_string('create_quiz_brand_new_desc', 'local_istikama_admin') ?>
        </p>
        <form method="post" action="<?= $PAGE->url->out(false) ?>">
            <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
            <input type="hidden" name="action" value="createnew">
            <input type="hidden" name="courseid"   value="<?= (int)$courseid ?>">
            <input type="hidden" name="sectionnum" value="<?= (int)$sectionnum ?>">
            <input type="hidden" name="beforemod"  value="<?= (int)$beforemod ?>">
            <div class="isti-form-group" style="margin-bottom:18px">
                <label class="isti-form-label"><?= get_string('quiz_name_label', 'local_istikama_admin') ?> *</label>
                <input type="text" class="isti-form-input" name="name" placeholder="<?= s(get_string('quiz_name_ph', 'local_istikama_admin')) ?>" required>
            </div>
            <button type="submit" class="isti-btn isti-btn-primary"><i class="fa fa-plus"></i> <?= get_string('btn_create_quiz_questions', 'local_istikama_admin') ?></button>
        </form>
    </div>

    <?php elseif ($tabchoice === 'reuse'): ?>
    <!-- Reuse existing -->
    <?php if (empty($reusable_quizzes)): ?>
    <div class="isti-card" style="text-align:center;padding:64px 20px;color:#94a3b8">
        <i class="fa fa-copy" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
        <p style="color:#475569;font-size:1rem;font-weight:500"><?= get_string('no_reusable_quizzes', 'local_istikama_admin') ?></p>
        <p style="font-size:.88rem;color:#94a3b8"><?= get_string('no_reusable_quizzes_hint', 'local_istikama_admin') ?></p>
    </div>
    <?php else: ?>
    <div class="isti-card" style="padding:0;overflow:hidden">
        <div class="table-responsive">
            <table class="isti-table">
                <thead><tr>
                    <th><?= get_string('col_quiz_name', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_level', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_subject', 'local_istikama_admin') ?></th>
                    <th style="text-align:center"><?= get_string('col_questions_count', 'local_istikama_admin') ?></th>
                    <th style="text-align:center;width:180px"><?= get_string('col_action', 'local_istikama_admin') ?></th>
                </tr></thead>
                <tbody>
                    <?php foreach ($reusable_quizzes as $qz): ?>
                    <tr>
                        <td>
                            <strong><?= format_string($qz->name) ?></strong>
                            <span class="isti-badge isti-badge-primary" style="font-size:.7rem;margin-left:6px"><i class="fa fa-star"></i> <?= get_string('badge_reusable', 'local_istikama_admin') ?></span>
                        </td>
                        <td><?= s($qz->levelname ?: '—') ?></td>
                        <td><?php if ($qz->subjectname): ?><span class="isti-badge isti-badge-primary"><?= s($qz->subjectname) ?></span><?php else: ?>—<?php endif; ?></td>
                        <td style="text-align:center"><span class="isti-badge isti-badge-neutral"><?= (int)$qz->slotcount ?></span></td>
                        <td style="text-align:center">
                            <form method="post" action="<?= $PAGE->url->out(false) ?>" style="display:inline" onsubmit="return confirm('Add this quiz to your lesson with all <?= (int)$qz->slotcount ?> questions?')">
                                <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                                <input type="hidden" name="action" value="reuse">
                                <input type="hidden" name="quizid" value="<?= (int)$qz->id ?>">
                                <input type="hidden" name="courseid"   value="<?= (int)$courseid ?>">
                                <input type="hidden" name="sectionnum" value="<?= (int)$sectionnum ?>">
                                <input type="hidden" name="beforemod"  value="<?= (int)$beforemod ?>">
                                <button type="submit" class="isti-btn isti-btn-primary" style="padding:5px 12px;font-size:.85rem">
                                    <i class="fa fa-plus"></i> <?= get_string('btn_use_in_lesson', 'local_istikama_admin') ?>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <?php elseif ($tabchoice === 'homework'): ?>
    <!-- Upload Homework -->
    <div class="isti-card" style="padding:28px 32px;width:100%">
        <h6 style="font-weight:700;color:#1e293b;margin-bottom:6px;font-size:1.15rem">
            <i class="fa fa-file-upload" style="color:#8b5cf6"></i>
            <?= get_string('homework_create_title', 'local_istikama_admin') ?>
        </h6>
        <p style="color:#64748b;font-size:.9rem;margin-bottom:24px">
            <?= get_string('homework_create_desc', 'local_istikama_admin') ?>
        </p>
        <form method="post" action="<?= $PAGE->url->out(false) ?>" enctype="multipart/form-data" id="hwForm">
            <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
            <input type="hidden" name="action" value="createhomework">
            <input type="hidden" name="courseid"   value="<?= (int)$courseid ?>">
            <input type="hidden" name="sectionnum" value="<?= (int)$sectionnum ?>">
            <input type="hidden" name="beforemod"  value="<?= (int)$beforemod ?>">

            <div class="isti-form-group" style="margin-bottom:18px">
                <label class="isti-form-label"><?= get_string('homework_title_label', 'local_istikama_admin') ?> *</label>
                <input type="text" class="isti-form-input" name="name" placeholder="<?= s(get_string('homework_title_ph', 'local_istikama_admin')) ?>" required style="width:100%">
            </div>

            <div class="isti-form-group" style="margin-bottom:18px">
                <label class="isti-form-label"><?= get_string('homework_desc_label', 'local_istikama_admin') ?></label>
                <textarea class="isti-form-input" name="hw_description" rows="4" style="resize:vertical;width:100%" placeholder="<?= s(get_string('homework_desc_ph', 'local_istikama_admin')) ?>"></textarea>
            </div>

            <div class="isti-form-group" style="margin-bottom:18px">
                <label class="isti-form-label"><i class="fa fa-paperclip" style="color:#006bff"></i> <?= get_string('homework_file_label', 'local_istikama_admin') ?></label>
                <div id="hwDropzone" style="border:2px dashed #cbd5e1;border-radius:12px;padding:24px;background:#f8fafc;text-align:center;cursor:pointer;transition:border-color .15s ease,background .15s ease">
                    <i class="fa fa-cloud-upload-alt" style="font-size:2.4rem;color:#94a3b8;display:block;margin-bottom:10px"></i>
                    <span style="color:#475569;font-size:.92rem;font-weight:600;display:block;margin-bottom:4px">
                        <?= get_string('homework_file_hint', 'local_istikama_admin') ?>
                    </span>
                    <span style="color:#94a3b8;font-size:.8rem;display:block">PDF, Word, images, video — up to 10 files</span>
                    <input type="file" name="hw_files[]" id="hwFileInput" multiple
                           style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0"
                           accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.odt,.ods,.odp,.txt,.rtf,.jpg,.jpeg,.png,.gif,.svg,.bmp,.webp,.mp4,.webm,.mp3,.wav,.zip,.rar">
                </div>
                <div id="hwFileList" style="margin-top:10px;display:none"></div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-bottom:22px">
                <div class="isti-form-group">
                    <label class="isti-form-label"><i class="fa fa-calendar" style="color:#f59e0b"></i> <?= get_string('homework_duedate_label', 'local_istikama_admin') ?></label>
                    <input type="datetime-local" class="isti-form-input" name="hw_duedate_raw" id="hwDueDateRaw" style="width:100%">
                    <input type="hidden" name="hw_duedate" id="hwDueDateUnix" value="0">
                </div>
                <div class="isti-form-group">
                    <label class="isti-form-label" style="margin-bottom:10px"><?= get_string('homework_submission_types', 'local_istikama_admin') ?></label>
                    <label style="display:flex;align-items:center;gap:6px;font-size:.9rem;color:#334155;cursor:pointer;margin-bottom:8px">
                        <input type="checkbox" name="hw_allow_file" value="1" checked> <i class="fa fa-upload" style="color:#006bff"></i> <?= get_string('homework_submission_file', 'local_istikama_admin') ?>
                    </label>
                    <label style="display:flex;align-items:center;gap:6px;font-size:.9rem;color:#334155;cursor:pointer">
                        <input type="checkbox" name="hw_allow_text" value="1" checked> <i class="fa fa-edit" style="color:#10b981"></i> <?= get_string('homework_submission_text', 'local_istikama_admin') ?>
                    </label>
                </div>
            </div>

            <button type="submit" class="isti-btn isti-btn-primary" style="background:#8b5cf6;border-color:#8b5cf6;padding:11px 22px;font-size:.95rem">
                <i class="fa fa-plus"></i> <?= get_string('btn_create_homework', 'local_istikama_admin') ?>
            </button>
        </form>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // ── Due-date Unix conversion ──────────────────────────────────────
        var rawInput = document.getElementById('hwDueDateRaw');
        var unixInput = document.getElementById('hwDueDateUnix');
        if (rawInput && unixInput) {
            rawInput.addEventListener('change', function() {
                unixInput.value = rawInput.value ? Math.floor(new Date(rawInput.value).getTime() / 1000) : 0;
            });
        }

        // ── Custom file dropzone ──────────────────────────────────────────
        var dropzone = document.getElementById('hwDropzone');
        var fileInput = document.getElementById('hwFileInput');
        var fileList = document.getElementById('hwFileList');
        if (!dropzone || !fileInput || !fileList) { return; }

        function renderList() {
            var files = fileInput.files;
            if (!files || files.length === 0) {
                fileList.style.display = 'none';
                fileList.innerHTML = '';
                return;
            }
            fileList.style.display = 'block';
            var html = '<div style="background:#fff;border:1px solid #e2e8f0;border-radius:10px;padding:10px 14px">';
            for (var i = 0; i < files.length; i++) {
                var f = files[i];
                var size = (f.size / 1024).toFixed(1) + ' KB';
                if (f.size > 1024 * 1024) size = (f.size / (1024 * 1024)).toFixed(1) + ' MB';
                html += '<div style="display:flex;align-items:center;gap:10px;padding:6px 0;border-bottom:1px solid #f1f5f9">';
                html += '<i class="fa fa-file" style="color:#64748b"></i>';
                html += '<span style="flex:1;font-size:.85rem;color:#334155">' + (f.name || '') + '</span>';
                html += '<span style="font-size:.78rem;color:#94a3b8">' + size + '</span>';
                html += '</div>';
            }
            html += '</div>';
            fileList.innerHTML = html;
        }

        dropzone.addEventListener('click', function() { fileInput.click(); });
        fileInput.addEventListener('change', renderList);

        ['dragenter', 'dragover'].forEach(function(ev) {
            dropzone.addEventListener(ev, function(e) {
                e.preventDefault(); e.stopPropagation();
                dropzone.style.borderColor = '#006bff';
                dropzone.style.background = '#eff6ff';
            });
        });
        ['dragleave', 'drop'].forEach(function(ev) {
            dropzone.addEventListener(ev, function(e) {
                e.preventDefault(); e.stopPropagation();
                dropzone.style.borderColor = '#cbd5e1';
                dropzone.style.background = '#f8fafc';
            });
        });
        dropzone.addEventListener('drop', function(e) {
            if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length) {
                fileInput.files = e.dataTransfer.files;
                renderList();
            }
        });
    });
    </script>
    <?php endif; ?>
</div>
<?php
echo '</div></div>';
echo $OUTPUT->footer();
