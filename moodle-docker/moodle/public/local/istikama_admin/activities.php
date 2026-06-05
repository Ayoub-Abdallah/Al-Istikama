<?php
/**
 * Technical Professor — Activities (Question Bank & Quizzes).
 *
 * Clean, minimal dashboard:
 *  - Questions table with right-aligned "Create Question" button
 *  - Modal: Level + Subject + Proceed -> opens Moodle's native question-type chooser
 *  - Quizzes table on a second tab
 *
 * The actual question creation, editing and saving uses Moodle's REAL question
 * engine (qbank_editquestion + question/question.php) — we only host the trigger UI.
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_target_user();

$context = context_system::instance();
$baseurl = new moodle_url('/local/istikama_admin/activities.php');
$active_tab = optional_param('tab', 'questions', PARAM_ALPHAEXT);

$PAGE->set_url($baseurl);
$PAGE->set_context($context);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('activities_title', 'local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

require_once('admin_layout.php');

global $DB;

$dir = right_to_left() ? 'rtl' : 'ltr';
$textalign = right_to_left() ? 'right' : 'left';

// ─────────────────────────────────────────────────────────────────────────────
// Locate the central Question Bank course + Gateway quiz.
// ─────────────────────────────────────────────────────────────────────────────
$qbcourse = $DB->get_record('course', ['shortname' => 'ISTIKAMA_QBANK']);
$qbcourse_id = $qbcourse ? (int)$qbcourse->id : 0;

$gateway_cmid = 0;
if ($qbcourse) {
    $gw = $DB->get_record_sql("
        SELECT cm.id AS cmid
          FROM {course_modules} cm
          JOIN {modules} m ON m.id = cm.module AND m.name = 'quiz'
          JOIN {quiz} qz ON qz.id = cm.instance AND qz.name = 'Question Bank Gateway'
         WHERE cm.course = :cid
         LIMIT 1
    ", ['cid' => $qbcourse->id]);
    if ($gw) {
        $gateway_cmid = (int)$gw->cmid;
    }
}

$setup_missing = (!$qbcourse_id || !$gateway_cmid);

// ─────────────────────────────────────────────────────────────────────────────
// Stats — count EVERY non-hidden question across the platform.
// ─────────────────────────────────────────────────────────────────────────────
$qbcoursectx = $qbcourse ? context_course::instance($qbcourse->id) : null;

$total_questions = (int)$DB->count_records_sql("
    SELECT COUNT(DISTINCT qbe.id)
      FROM {question_bank_entries} qbe
      JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
     WHERE qv.status <> 'hidden'
");
$total_categories = 0;
try { $total_categories = (int)$DB->count_records('question_categories'); } catch (Exception $e) {}
$total_quizzes = (int)$DB->count_records('quiz');

// QB-course-scoped count (for the "Reusable" KPI).
$reusable_questions = 0;
if ($qbcoursectx) {
    $reusable_questions = (int)$DB->count_records_sql("
        SELECT COUNT(DISTINCT qbe.id)
          FROM {question_bank_entries} qbe
          JOIN {question_categories} qc ON qc.id = qbe.questioncategoryid
          JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
         WHERE qc.contextid = :ctxid AND qv.status <> 'hidden'
    ", ['ctxid' => $qbcoursectx->id]);
}

// ─────────────────────────────────────────────────────────────────────────────
// Fetch ALL questions across the system (latest non-hidden version of each entry).
// ─────────────────────────────────────────────────────────────────────────────
// MariaDB/MySQL-friendly: use a JOIN to a "latest version per entry" subquery.
$recent_questions = $DB->get_records_sql("
    SELECT q.id,
           q.name,
           q.qtype,
           q.timecreated,
           q.timemodified,
           qbe.id        AS qbe_id,
           qv.version    AS qversion,
           qv.status     AS qstatus,
           qc.id         AS catid,
           qc.name       AS catname,
           qc.parent     AS catparent,
           qc.info       AS catinfo,
           qc.contextid  AS catctxid,
           ctx.contextlevel AS ctxlevel,
           ctx.instanceid   AS ctxinstanceid,
           u.id          AS creatorid,
           u.firstname   AS creatorfirst,
           u.lastname    AS creatorlast
      FROM {question_bank_entries} qbe
      JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
      JOIN (
            SELECT questionbankentryid, MAX(version) AS maxv
              FROM {question_versions}
             WHERE status <> 'hidden'
          GROUP BY questionbankentryid
           ) latest ON latest.questionbankentryid = qbe.id AND latest.maxv = qv.version
      JOIN {question} q ON q.id = qv.questionid
      JOIN {question_categories} qc ON qc.id = qbe.questioncategoryid
      JOIN {context} ctx ON ctx.id = qc.contextid
 LEFT JOIN {user} u ON u.id = q.createdby
  ORDER BY q.timemodified DESC
", null, 0, 500);

// Build a lookup for every question_category id → parent name (so we can show Level/Module).
$all_cats_lookup = $DB->get_records('question_categories', null, '', 'id, name, parent, contextid');
$cat_parent_name = [];
foreach ($all_cats_lookup as $c) {
    if (!empty($c->parent) && isset($all_cats_lookup[$c->parent])) {
        $pn = $all_cats_lookup[$c->parent]->name;
        $cat_parent_name[$c->id] = ($pn === 'top') ? '' : $pn;
    }
}

// Map module/course context ids → human-friendly source labels.
$module_sources = [];
$cm_to_label = [];
try {
    $mods = $DB->get_records_sql("
        SELECT cm.id, m.name AS modname, c.fullname AS coursename, cm.instance, cm.course
          FROM {course_modules} cm
          JOIN {modules} m ON m.id = cm.module
          JOIN {course} c ON c.id = cm.course
    ");
    foreach ($mods as $cm) {
        $modinstancename = '';
        try {
            $rec = $DB->get_field($cm->modname, 'name', ['id' => $cm->instance]);
            if ($rec) { $modinstancename = $rec; }
        } catch (Exception $e) {}
        $cm_to_label[(int)$cm->id] = [
            'course'   => $cm->coursename,
            'modname'  => $cm->modname,
            'instance' => $modinstancename ?: ucfirst($cm->modname),
        ];
    }
} catch (Exception $e) {}

$course_to_label = [];
try {
    $crs = $DB->get_records_sql("SELECT id, fullname, shortname FROM {course}");
    foreach ($crs as $c) {
        $course_to_label[(int)$c->id] = ['fullname' => $c->fullname, 'shortname' => $c->shortname];
    }
} catch (Exception $e) {}

// Durable level/subject metadata, keyed by qbe_id. Falls back to category-name parsing.
$qmeta = [];
try {
    $rows = $DB->get_records_sql("
        SELECT iqm.qbe_id, iqm.levelid, iqm.subjectid, iqm.review_status, iqm.reported, iqm.reportreason,
               lvl.name AS levelname, subj.name AS subjectname
          FROM {istikama_question_meta} iqm
     LEFT JOIN {course_categories} lvl ON lvl.id = iqm.levelid
     LEFT JOIN {istikama_subject_names} subj ON subj.id = iqm.subjectid
    ");
    foreach ($rows as $r) {
        $qmeta[(int)$r->qbe_id] = [
            'level'    => $r->levelname ?: '',
            'subject'  => $r->subjectname ?: '',
            'status'   => $r->review_status ?: 'approved',
            'reported' => (int)$r->reported,
            'reason'   => $r->reportreason ?: '',
        ];
    }
} catch (Exception $e) {}

// Quick usage counter: how many slots reference each question_bank_entry.
$qusage = [];
try {
    $rows = $DB->get_records_sql("
        SELECT qr.questionbankentryid AS qbe_id, COUNT(*) AS uses
          FROM {question_references} qr
         WHERE qr.component = 'mod_quiz' AND qr.questionarea = 'slot'
      GROUP BY qr.questionbankentryid
    ");
    foreach ($rows as $r) { $qusage[(int)$r->qbe_id] = (int)$r->uses; }
} catch (Exception $e) {}

// Quizzes.
$quizzes = $DB->get_records_sql("
    SELECT qz.id, qz.name, qz.timeopen, qz.timeclose, qz.timecreated,
           c.fullname AS coursename, c.id AS courseid,
           cm.id AS cmid
      FROM {quiz} qz
      JOIN {course} c ON c.id = qz.course
      LEFT JOIN {course_modules} cm ON cm.instance = qz.id AND cm.course = qz.course
      LEFT JOIN {modules} m ON m.id = cm.module AND m.name = 'quiz'
     WHERE qz.name <> 'Question Bank Gateway'
     ORDER BY qz.timecreated DESC
", null, 0, 100);

$quiz_question_counts = [];
try {
    $qcounts = $DB->get_records_sql("SELECT qs.quizid, COUNT(*) AS cnt FROM {quiz_slots} qs GROUP BY qs.quizid");
    foreach ($qcounts as $qc) { $quiz_question_counts[(int)$qc->quizid] = (int)$qc->cnt; }
} catch (Exception $e) {}

// Reusable-quiz metadata keyed by quizid.
$quiz_meta = [];
try {
    $rows = $DB->get_records_sql("
        SELECT iqm.quizid, iqm.reusable, iqm.review_status, iqm.reported,
               lvl.name AS levelname, subj.name AS subjectname
          FROM {istikama_quiz_meta} iqm
     LEFT JOIN {course_categories} lvl ON lvl.id = iqm.levelid
     LEFT JOIN {istikama_subject_names} subj ON subj.id = iqm.subjectid
    ");
    foreach ($rows as $r) {
        $quiz_meta[(int)$r->quizid] = [
            'level'    => $r->levelname ?: '',
            'subject'  => $r->subjectname ?: '',
            'reusable' => (int)$r->reusable,
            'status'   => $r->review_status ?: 'approved',
            'reported' => (int)$r->reported,
        ];
    }
} catch (Exception $e) {}

// ─────────────────────────────────────────────────────────────────────────────
// Build Level → Subjects picker data.
// ─────────────────────────────────────────────────────────────────────────────
// BUG FIX: was querying course_categories WHERE depth=2, whose IDs (17–32)
// don't match istikama_subject_names.level_id (which references
// istikama_global_level.id, range 1–13). Use the canonical level catalog so
// the picker actually shows the platform's levels with their subjects.
$levels = $DB->get_records('istikama_global_level', null, 'order_index ASC, name ASC', 'id, name, tier');
$picker_data = [];
foreach ($levels as $lv) {
    $subjects = $DB->get_records('istikama_subject_names', ['level_id' => $lv->id], 'name ASC');
    if (empty($subjects)) {
        continue;
    }
    $subs = [];
    foreach ($subjects as $s) {
        $subs[] = [
            'id'   => (int)$s->id,
            'name' => format_string($s->name),
        ];
    }
    $picker_data[] = [
        'id'       => (int)$lv->id,
        'name'     => format_string($lv->name),
        'subjects' => $subs,
    ];
}

$qtype_icons = [
    'multichoice'=>'fa-list-ul','truefalse'=>'fa-check-double','shortanswer'=>'fa-keyboard',
    'essay'=>'fa-paragraph','numerical'=>'fa-calculator','match'=>'fa-exchange-alt',
    'description'=>'fa-align-left','multianswer'=>'fa-layer-group','random'=>'fa-random',
    'gapselect'=>'fa-mouse-pointer','ddwtos'=>'fa-hand-pointer','ordering'=>'fa-sort',
    'calculated'=>'fa-square-root-alt','calculatedmulti'=>'fa-square-root-alt',
    'calculatedsimple'=>'fa-square-root-alt','ddimageortext'=>'fa-image','ddmarker'=>'fa-map-marker-alt',
];
$qtype_colors = [
    'multichoice'=>'#006bff','truefalse'=>'#10b981','shortanswer'=>'#f59e0b',
    'essay'=>'#8b5cf6','numerical'=>'#ec4899','match'=>'#06b6d4',
    'description'=>'#64748b','multianswer'=>'#f97316','random'=>'#94a3b8',
    'gapselect'=>'#0ea5e9','ddwtos'=>'#14b8a6','ordering'=>'#a855f7',
];
$qtype_labels = [
    'multichoice'=>'Multiple Choice','truefalse'=>'True/False','shortanswer'=>'Short Answer',
    'essay'=>'Essay','numerical'=>'Numerical','match'=>'Matching','description'=>'Description',
    'multianswer'=>'Embedded Answers','random'=>'Random','gapselect'=>'Select Missing Words',
    'ddwtos'=>'Drag & Drop into Text','ordering'=>'Ordering',
    'calculated'=>'Calculated','calculatedmulti'=>'Calculated Multi','calculatedsimple'=>'Calculated Simple',
    'ddimageortext'=>'Drag & Drop on Image','ddmarker'=>'Drag & Drop Markers',
];
?>

<div class="container-fluid" dir="<?= $dir ?>" style="text-align:<?= $textalign ?>; background:#f8fafc; min-height:500px; margin:-24px; padding:24px;">

    <?php if ($setup_missing): ?>
        <div class="isti-alert isti-alert-warning" style="background:#fffbeb;border:1px solid #fcd34d;color:#92400e;padding:14px 18px;border-radius:12px;margin-bottom:20px;display:flex;align-items:center;gap:12px;">
            <i class="fa fa-exclamation-triangle" style="font-size:1.2rem"></i>
            <div style="flex:1">
                <strong><?= get_string('act_setup_incomplete','local_istikama_admin') ?></strong>
                Run <code>php local/istikama_admin/cli/setup_questionbank.php</code> and <code>create_qb_gateway.php</code> on the server, then refresh.
            </div>
        </div>
    <?php endif; ?>

    <!-- ─── Tabs ─── -->
    <div class="isti-tabs" id="activitiesTabs" style="margin-bottom:24px">
        <button class="isti-tab <?= $active_tab == 'questions' ? 'active' : '' ?>" data-tab="questions">
            <i class="fa fa-database"></i> <?= get_string('act_tab_qbank','local_istikama_admin') ?>
        </button>
        <button class="isti-tab <?= $active_tab == 'quizzes' ? 'active' : '' ?>" data-tab="quizzes">
            <i class="fa fa-question-circle"></i> <?= get_string('act_tab_quizzes','local_istikama_admin') ?>
        </button>
    </div>

    <div class="tab-content" id="activitiesTabsContent">

        <!-- ─── Question Bank Tab ─── -->
        <div class="tab-pane <?= $active_tab == 'questions' ? 'active' : '' ?>" id="questions"
             style="<?= $active_tab != 'questions' ? 'display:none' : '' ?>">

            <!-- ─── Top action row: search + Create button right-aligned ─── -->
            <div class="isti-card" style="padding:14px 18px; margin-bottom:16px; display:flex; align-items:center; gap:14px; flex-wrap:wrap;">
                <h5 style="margin:0; font-weight:700; color:#1e293b; flex:1; min-width:200px">
                    <i class="fa fa-database" style="color:#006bff"></i> <?= get_string('act_questions_h','local_istikama_admin') ?>
                </h5>
                <select id="qFilterScope" class="isti-form-select" style="max-width:180px;min-width:140px;font-size:.85rem">
                    <option value="all"><?= get_string('act_f_all_q','local_istikama_admin') ?></option>
                    <option value="reusable" <?= $qbcoursectx ? '' : 'disabled' ?>><?= get_string('act_f_central','local_istikama_admin') ?></option>
                    <option value="quiz"><?= get_string('act_f_in_quizzes','local_istikama_admin') ?></option>
                </select>
                <input type="text" id="qSearchInput" class="isti-form-input"
                       placeholder="<?= s(get_string('act_search_q_ph','local_istikama_admin')) ?>"
                       style="max-width:320px; min-width:180px; flex:1; font-size:.88rem">
                <button type="button" id="qb_create_btn_open" class="isti-btn isti-btn-primary" style="white-space:nowrap"
                        <?= $setup_missing ? 'disabled' : '' ?>>
                    <i class="fa fa-plus"></i> <?= get_string('act_create_question','local_istikama_admin') ?>
                </button>
            </div>

            <!-- ─── Questions Table ─── -->
            <?php if (empty($recent_questions)): ?>
                <div class="isti-card" style="text-align:center;padding:48px 20px;color:#94a3b8">
                    <i class="fa fa-database" style="font-size:3rem;margin-bottom:16px;display:block;color:#cbd5e1"></i>
                    <p style="margin:0;font-size:1.05rem;color:#475569;font-weight:500"><?= get_string('act_no_questions','local_istikama_admin') ?></p>
                    <p style="margin:6px 0 0 0;font-size:.9rem;color:#94a3b8"><?= get_string('act_no_questions_hint','local_istikama_admin') ?></p>
                </div>
            <?php else: ?>
                <div class="isti-card" style="overflow:hidden; padding:0">
                    <div class="table-responsive">
                        <table class="isti-table" id="questionsTable">
                            <thead><tr>
                                <th style="width:54px"></th>
                                <th><?= get_string('act_col_question','local_istikama_admin') ?></th>
                                <th><?= get_string('act_col_type','local_istikama_admin') ?></th>
                                <th><?= get_string('act_col_level','local_istikama_admin') ?></th>
                                <th><?= get_string('act_col_subject_cat','local_istikama_admin') ?></th>
                                <th><?= get_string('act_col_source','local_istikama_admin') ?></th>
                                <th style="text-align:center"><?= get_string('act_col_used_in','local_istikama_admin') ?></th>
                                <th><?= get_string('act_col_creator','local_istikama_admin') ?></th>
                                <th style="text-align:right"><?= get_string('act_col_modified','local_istikama_admin') ?></th>
                                <th style="text-align:center;width:140px"><?= get_string('act_col_actions','local_istikama_admin') ?></th>
                            </tr></thead>
                            <tbody>
                                <?php
                                $qb_ctx_id = $qbcoursectx ? (int)$qbcoursectx->id : 0;
                                foreach ($recent_questions as $q):
                                    $ico = $qtype_icons[$q->qtype] ?? 'fa-question';
                                    $clr = $qtype_colors[$q->qtype] ?? '#64748b';
                                    $qtypename = $qtype_labels[$q->qtype] ?? ucfirst($q->qtype);
                                    $subjectname = format_string($q->catname === 'top' ? '—' : $q->catname);

                                    // Resolve Level/Subject from durable metadata first, then category info, then parent.
                                    $meta = $qmeta[(int)$q->qbe_id] ?? null;
                                    $levelname = '—';
                                    if ($meta && !empty($meta['level'])) {
                                        $levelname = format_string($meta['level']);
                                    } else if (!empty($q->catinfo) && preg_match('/Level:\s*([^|]+)/', $q->catinfo, $m)) {
                                        $levelname = trim($m[1]);
                                    } else if (!empty($cat_parent_name[$q->catid])) {
                                        $levelname = $cat_parent_name[$q->catid];
                                    }
                                    if ($meta && !empty($meta['subject'])) {
                                        $subjectname = format_string($meta['subject']);
                                    }
                                    $review_status = $meta['status']   ?? 'approved';
                                    $reported_flag = (int)($meta['reported'] ?? 0);

                                    // Resolve Source.
                                    $sourcetype = 'other';
                                    $sourcelabel = 'System';
                                    $sourceicon = 'fa-globe';
                                    if ((int)$q->catctxid === $qb_ctx_id) {
                                        $sourcetype = 'reusable';
                                        $sourcelabel = get_string('act_source_central','local_istikama_admin');
                                        $sourceicon = 'fa-star';
                                    } else if ((int)$q->ctxlevel === CONTEXT_MODULE && isset($cm_to_label[(int)$q->ctxinstanceid])) {
                                        $cm = $cm_to_label[(int)$q->ctxinstanceid];
                                        $sourcetype = 'quiz';
                                        $sourcelabel = format_string($cm['instance']) . ' (' . format_string($cm['course']) . ')';
                                        $sourceicon = 'fa-question-circle';
                                    } else if ((int)$q->ctxlevel === CONTEXT_COURSE && isset($course_to_label[(int)$q->ctxinstanceid])) {
                                        $sourcetype = 'course';
                                        $sourcelabel = format_string($course_to_label[(int)$q->ctxinstanceid]['fullname']);
                                        $sourceicon = 'fa-book-open';
                                    }

                                    $creator = trim((string)$q->creatorfirst . ' ' . (string)$q->creatorlast);
                                    if ($creator === '') { $creator = '—'; }
                                    $usage = $qusage[(int)$q->qbe_id] ?? 0;

                                    // Determine the cmid Moodle requires for editing this question:
                                    //   - reusable (central bank) → gateway cmid
                                    //   - quiz-scoped → the quiz's cmid
                                    //   - course/other → still use gateway as fallback (Moodle will permit if user has caps)
                                    if ($sourcetype === 'quiz') {
                                        $edit_cmid = (int)$q->ctxinstanceid;
                                    } else if ($gateway_cmid) {
                                        $edit_cmid = $gateway_cmid;
                                    } else {
                                        $edit_cmid = 0;
                                    }

                                    // Build native edit / preview / delete URLs.
                                    $editurl = (new moodle_url('/question/bank/editquestion/question.php', [
                                        'id'        => (int)$q->id,
                                        'cmid'      => $edit_cmid,
                                        'courseid'  => $qbcourse_id ?: SITEID,
                                        'returnurl' => '/local/istikama_admin/activities.php?tab=questions',
                                    ]))->out(false);
                                    $previewurl = (new moodle_url('/local/istikama_admin/preview_question.php', [
                                        'id' => (int)$q->id,
                                    ]))->out(false);
                                    $deleteurl  = (new moodle_url('/question/bank/deletequestion/delete.php', [
                                        'returnurl' => '/local/istikama_admin/activities.php?tab=questions',
                                        'courseid'  => $qbcourse_id ?: SITEID,
                                        'q' . (int)$q->id => 1,
                                        'sesskey'   => sesskey(),
                                    ]))->out(false);

                                    // Moderation actions (AJAX-driven against ajax.php).
                                    $can_review = ($sourcetype !== 'reusable') || ($review_status !== 'approved');
                                    $reportbtn_label = $reported_flag ? 'Reported' : 'Report';
                                    $reportbtn_class = $reported_flag ? 'isti-icon-btn-danger' : '';

                                    $search_blob = strtolower($q->name . ' ' . $qtypename . ' ' . $levelname . ' ' . $subjectname . ' ' . $creator . ' ' . $sourcelabel . ' ' . $review_status);
                                ?>
                                <tr data-search="<?= s($search_blob) ?>" data-scope="<?= s($sourcetype) ?>"
                                    data-qbe="<?= (int)$q->qbe_id ?>" data-review="<?= s($review_status) ?>">
                                    <td>
                                        <span class="isti-qtype-pill" style="background:<?= $clr ?>15;color:<?= $clr ?>">
                                            <i class="fa <?= $ico ?>"></i>
                                        </span>
                                    </td>
                                    <td>
                                        <strong><?= format_string($q->name) ?></strong>
                                        <?php if ($review_status === 'pending'): ?>
                                            <br><span class="isti-badge isti-badge-warning" style="font-size:.7rem"><i class="fa fa-clock"></i> Pending Review</span>
                                        <?php elseif ($review_status === 'rejected'): ?>
                                            <br><span class="isti-badge isti-badge-danger" style="font-size:.7rem"><i class="fa fa-times"></i> Rejected</span>
                                        <?php endif; ?>
                                        <?php if ($reported_flag): ?>
                                            <span class="isti-badge isti-badge-danger" style="font-size:.7rem;margin-left:4px"><i class="fa fa-flag"></i> Reported</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="isti-badge" style="background:<?= $clr ?>15;color:<?= $clr ?>"><?= s($qtypename) ?></span></td>
                                    <td><?= s($levelname) ?></td>
                                    <td><span class="isti-badge isti-badge-primary"><?= s($subjectname) ?></span></td>
                                    <td style="font-size:.82rem;color:#475569">
                                        <i class="fa <?= s($sourceicon) ?>" style="color:#94a3b8;margin-right:4px"></i><?= s($sourcelabel) ?>
                                    </td>
                                    <td style="text-align:center"><span class="isti-badge isti-badge-neutral"><?= $usage ?></span></td>
                                    <td><?= s($creator) ?></td>
                                    <td style="text-align:right;white-space:nowrap;color:#64748b;font-size:.82rem">
                                        <?= userdate($q->timemodified, get_string('strftimedatetimeshort', 'langconfig')) ?>
                                    </td>
                                    <td style="text-align:center;white-space:nowrap">
                                        <a href="<?= $previewurl ?>" class="isti-icon-btn" title="Preview"><i class="fa fa-eye"></i></a>
                                        <a href="<?= $editurl ?>" class="isti-icon-btn" title="Edit"><i class="fa fa-edit"></i></a>
                                        <button type="button" class="isti-icon-btn js-qmod-approve" data-qbe="<?= (int)$q->qbe_id ?>" title="Approve"><i class="fa fa-check"></i></button>
                                        <button type="button" class="isti-icon-btn <?= $reportbtn_class ?> js-qmod-report" data-qbe="<?= (int)$q->qbe_id ?>" title="<?= s($reportbtn_label) ?>"><i class="fa fa-flag"></i></button>
                                        <a href="<?= $deleteurl ?>" class="isti-icon-btn isti-icon-btn-danger" title="Delete"
                                           onclick="return confirm('<?= s(get_string('act_delete_q_confirm','local_istikama_admin')) ?>');">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- ─── Quizzes Tab ─── -->
        <div class="tab-pane <?= $active_tab == 'quizzes' ? 'active' : '' ?>" id="quizzes"
             style="<?= $active_tab != 'quizzes' ? 'display:none' : '' ?>">

            <!-- Top action row -->
            <div class="isti-card" style="padding:14px 18px; margin-bottom:16px; display:flex; align-items:center; gap:14px; flex-wrap:wrap;">
                <h5 style="margin:0; font-weight:700; color:#1e293b; flex:1; min-width:200px">
                    <i class="fa fa-question-circle" style="color:#006bff"></i> Quizzes &amp; Exams
                </h5>
                <select id="qzFilterScope" class="isti-form-select" style="max-width:200px;min-width:140px;font-size:.85rem">
                    <option value="all"><?= get_string('act_f_all_qz','local_istikama_admin') ?></option>
                    <option value="reusable"><?= get_string('act_f_reusable','local_istikama_admin') ?></option>
                    <option value="course"><?= get_string('act_f_course_only','local_istikama_admin') ?></option>
                </select>
                <input type="text" id="qzSearchInput" class="isti-form-input"
                       placeholder="<?= s(get_string('act_search_qz_ph','local_istikama_admin')) ?>"
                       style="max-width:280px; min-width:180px; flex:1; font-size:.88rem">
                <button type="button" id="qz_create_btn_open" class="isti-btn isti-btn-primary" style="white-space:nowrap"
                        <?= $setup_missing ? 'disabled' : '' ?>>
                    <i class="fa fa-plus"></i> Create Quiz
                </button>
            </div>

            <?php if (empty($quizzes)): ?>
                <div class="isti-card" style="text-align:center;padding:48px 20px;color:#94a3b8">
                    <i class="fa fa-question-circle" style="font-size:3rem;margin-bottom:16px;display:block;color:#cbd5e1"></i>
                    <p style="margin:0;font-size:1.05rem;color:#475569;font-weight:500"><?= get_string('act_no_quizzes','local_istikama_admin') ?></p>
                    <p style="margin:6px 0 0 0;font-size:.9rem;color:#94a3b8">Click <strong>Create Quiz</strong> to build the first reusable one.</p>
                </div>
            <?php else: ?>
                <div class="isti-card" style="overflow:hidden; padding:0">
                    <div class="table-responsive">
                        <table class="isti-table" id="quizzesTable">
                            <thead><tr>
                                <th><?= get_string('act_col_name','local_istikama_admin') ?></th>
                                <th><?= get_string('act_col_scope','local_istikama_admin') ?></th>
                                <th><?= get_string('act_col_level','local_istikama_admin') ?></th>
                                <th><?= get_string('act_col_subject','local_istikama_admin') ?></th>
                                <th><?= get_string('act_col_course','local_istikama_admin') ?></th>
                                <th style="text-align:center">Questions</th>
                                <th><?= get_string('act_col_created','local_istikama_admin') ?></th>
                                <th style="text-align:center;width:160px"><?= get_string('act_col_actions','local_istikama_admin') ?></th>
                            </tr></thead>
                            <tbody>
                                <?php foreach ($quizzes as $qz):
                                    $qcount = $quiz_question_counts[(int)$qz->id] ?? 0;
                                    $qzm    = $quiz_meta[(int)$qz->id] ?? null;
                                    $is_reusable = $qzm && !empty($qzm['reusable']);
                                    $scope_label = $is_reusable ? get_string('act_scope_reusable','local_istikama_admin') : get_string('act_scope_course','local_istikama_admin');
                                    $scope_class = $is_reusable ? 'isti-badge-primary' : 'isti-badge-neutral';
                                    $qz_level = $qzm['level']   ?? '—';
                                    $qz_subject = $qzm['subject'] ?? '—';
                                    $qz_status = $qzm['status']  ?? 'approved';
                                    $qz_reported = (int)($qzm['reported'] ?? 0);

                                    $viewurl = !empty($qz->cmid) ? (new moodle_url('/local/istikama_admin/view_quiz.php', ['id' => $qz->cmid]))->out() : '#';
                                    $editurl = !empty($qz->cmid) ? (new moodle_url('/local/istikama_admin/edit_quiz.php', ['cmid' => $qz->cmid]))->out() : '#';
                                    $settingsurl = !empty($qz->cmid) ? (new moodle_url('/course/modedit.php', ['update' => $qz->cmid, 'return' => 1]))->out() : '#';

                                    $search_blob = strtolower($qz->name . ' ' . $qz->coursename . ' ' . $qz_level . ' ' . $qz_subject . ' ' . $scope_label);
                                ?>
                                <tr data-search="<?= s($search_blob) ?>" data-scope="<?= s($is_reusable ? 'reusable' : 'course') ?>">
                                    <td>
                                        <strong><?= format_string($qz->name) ?></strong>
                                        <?php if ($qz_reported): ?>
                                            <br><span class="isti-badge isti-badge-danger" style="font-size:.7rem"><i class="fa fa-flag"></i> Reported</span>
                                        <?php elseif ($qz_status === 'pending'): ?>
                                            <br><span class="isti-badge isti-badge-warning" style="font-size:.7rem"><i class="fa fa-clock"></i> Pending Review</span>
                                        <?php elseif ($qz_status === 'rejected'): ?>
                                            <br><span class="isti-badge isti-badge-danger" style="font-size:.7rem"><i class="fa fa-times"></i> Rejected</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="isti-badge <?= s($scope_class) ?>"><?= s($scope_label) ?></span></td>
                                    <td><?= s($qz_level ?: '—') ?></td>
                                    <td>
                                        <?php if ($qz_subject && $qz_subject !== '—'): ?>
                                            <span class="isti-badge isti-badge-primary"><?= s($qz_subject) ?></span>
                                        <?php else: ?>
                                            <span style="color:#94a3b8">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="isti-badge isti-badge-neutral"><?= format_string($qz->coursename) ?></span></td>
                                    <td style="text-align:center"><span class="isti-badge isti-badge-neutral"><?= $qcount ?></span></td>
                                    <td style="color:#64748b;font-size:.82rem"><?= userdate($qz->timecreated, get_string('strftimedatetimeshort', 'langconfig')) ?></td>
                                    <td style="text-align:center;white-space:nowrap">
                                        <a href="<?= $viewurl ?>" class="isti-icon-btn" title="View Quiz"><i class="fa fa-eye"></i></a>
                                        <a href="<?= $editurl ?>" class="isti-icon-btn" title="Edit Questions"><i class="fa fa-edit"></i></a>
                                        <a href="<?= $settingsurl ?>" class="isti-icon-btn" title="Quiz Settings"><i class="fa fa-cog"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div><!-- end tab-content -->
</div>

<!-- ─── Create Quiz Modal ─── -->
<div class="isti-modal-overlay" id="qzCreateModal" role="dialog" aria-modal="true" aria-labelledby="qzCreateModalTitle">
    <div class="isti-modal" style="max-width:560px">
        <div class="isti-modal-header">
            <div>
                <h3 id="qzCreateModalTitle" style="margin:0;font-size:1.1rem;font-weight:700;color:#1e293b">
                    <i class="fa fa-plus-circle" style="color:#006bff"></i> <?= get_string('act_create_quiz','local_istikama_admin') ?>
                </h3>
                <span class="isti-kpi-label" style="font-size:.72rem;color:#64748b"><?= get_string('act_create_quiz_sub','local_istikama_admin') ?></span>
            </div>
            <button type="button" class="isti-modal-close" id="qzCreateModalClose" aria-label="Close">&times;</button>
        </div>
        <form id="qzCreateForm" method="post" action="<?= (new moodle_url('/local/istikama_admin/create_quiz.php'))->out(false) ?>">
            <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
            <div class="isti-modal-body">
                <div class="isti-form-group" style="margin-bottom:16px">
                    <label for="qz_name_input" class="isti-form-label">
                        <i class="fa fa-pen" style="color:#006bff;margin-right:6px"></i><?= get_string('act_quiz_name','local_istikama_admin') ?>
                    </label>
                    <input id="qz_name_input" class="isti-form-input" name="name" type="text" required
                           placeholder="<?= s(get_string('act_quiz_name_ph','local_istikama_admin')) ?>"
                           style="width:100%;font-size:.95rem">
                </div>
                <div class="isti-form-group" style="margin-bottom:16px">
                    <label for="qz_level_select" class="isti-form-label">
                        <i class="fa fa-layer-group" style="color:#006bff;margin-right:6px"></i><?= get_string('act_level','local_istikama_admin') ?>
                    </label>
                    <select id="qz_level_select" class="isti-form-select" name="levelid" style="width:100%" required>
                        <option value=""><?= get_string('act_select_level','local_istikama_admin') ?></option>
                        <?php foreach ($picker_data as $lv): ?>
                            <option value="<?= (int)$lv['id'] ?>"><?= s($lv['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="isti-form-group">
                    <label for="qz_subject_select" class="isti-form-label">
                        <i class="fa fa-book" style="color:#006bff;margin-right:6px"></i><?= get_string('act_subject','local_istikama_admin') ?>
                    </label>
                    <select id="qz_subject_select" class="isti-form-select" name="subjectid" style="width:100%" required disabled>
                        <option value=""><?= get_string('act_select_level_first','local_istikama_admin') ?></option>
                    </select>
                </div>
                <p style="margin:14px 0 0 0;font-size:.78rem;color:#94a3b8;line-height:1.5">
                    <i class="fa fa-info-circle"></i>
                    <?= get_string('act_quiz_info','local_istikama_admin') ?>
                </p>
            </div>
            <div class="isti-modal-footer">
                <button type="button" class="isti-btn isti-btn-outline" id="qzCreateModalCancel"><?= get_string('act_cancel','local_istikama_admin') ?></button>
                <button type="submit" class="isti-btn isti-btn-primary" id="qzCreateModalProceed" disabled>
                    <i class="fa fa-check"></i> <?= get_string('act_create_open_editor','local_istikama_admin') ?>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ─── Create Question Modal ─── -->
<div class="isti-modal-overlay" id="qbCreateModal" role="dialog" aria-modal="true" aria-labelledby="qbCreateModalTitle">
    <div class="isti-modal" style="max-width:520px">
        <div class="isti-modal-header">
            <div>
                <h3 id="qbCreateModalTitle" style="margin:0;font-size:1.1rem;font-weight:700;color:#1e293b">
                    <i class="fa fa-plus-circle" style="color:#006bff"></i> <?= get_string('act_create_q_title','local_istikama_admin') ?>
                </h3>
                <span class="isti-kpi-label" style="font-size:.72rem;color:#64748b"><?= get_string('act_create_q_sub','local_istikama_admin') ?></span>
            </div>
            <button type="button" class="isti-modal-close" id="qbCreateModalClose" aria-label="Close">&times;</button>
        </div>
        <div class="isti-modal-body">
            <form id="qbCreateForm" onsubmit="return false;">
                <div class="isti-form-group" style="margin-bottom:16px">
                    <label for="qb_level_select" class="isti-form-label" style="display:block;font-weight:600;font-size:.85rem;color:#334155;margin-bottom:6px">
                        <i class="fa fa-layer-group" style="color:#006bff;margin-right:6px"></i><?= get_string('act_level','local_istikama_admin') ?>
                    </label>
                    <select id="qb_level_select" class="isti-form-select" style="width:100%">
                        <option value=""><?= get_string('act_select_level','local_istikama_admin') ?></option>
                        <?php foreach ($picker_data as $lv): ?>
                            <option value="<?= (int)$lv['id'] ?>"><?= s($lv['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="isti-form-group">
                    <label for="qb_subject_select" class="isti-form-label" style="display:block;font-weight:600;font-size:.85rem;color:#334155;margin-bottom:6px">
                        <i class="fa fa-book" style="color:#006bff;margin-right:6px"></i><?= get_string('act_subject','local_istikama_admin') ?>
                    </label>
                    <select id="qb_subject_select" class="isti-form-select" style="width:100%" disabled>
                        <option value=""><?= get_string('act_select_level_first','local_istikama_admin') ?></option>
                    </select>
                </div>
                <p id="qbModalHint" style="margin-top:14px;font-size:.78rem;color:#94a3b8;line-height:1.5">
                    <i class="fa fa-info-circle"></i>
                    <?= get_string('act_q_info','local_istikama_admin') ?>
                </p>
            </form>
        </div>
        <div class="isti-modal-footer">
            <button type="button" class="isti-btn isti-btn-outline" id="qbCreateModalCancel"><?= get_string('act_cancel','local_istikama_admin') ?></button>
            <button type="button" class="isti-btn isti-btn-primary" id="qbCreateModalProceed" disabled>
                <i class="fa fa-arrow-right"></i> <?= get_string('act_proceed','local_istikama_admin') ?>
            </button>
        </div>
    </div>
</div>

<!-- ─── JavaScript ─── -->
<script>
(function() {
    'use strict';
    var pickerData = <?= json_encode($picker_data, JSON_UNESCAPED_UNICODE) ?>;
    var createUrl = '<?= (new moodle_url('/local/istikama_admin/create_question.php'))->out(false) ?>';
    var sesskey = '<?= sesskey() ?>';

    document.addEventListener('DOMContentLoaded', function() {

        // ── Tab switching ──
        var tabs = document.querySelectorAll('#activitiesTabs .isti-tab');
        var panes = document.querySelectorAll('#activitiesTabsContent .tab-pane');
        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                tabs.forEach(function(t) { t.classList.remove('active'); });
                panes.forEach(function(p) { p.classList.remove('active'); p.style.display = 'none'; });
                tab.classList.add('active');
                var target = document.getElementById(tab.getAttribute('data-tab'));
                if (target) { target.classList.add('active'); target.style.display = ''; }
                try {
                    var url = new URL(window.location.href);
                    url.searchParams.set('tab', tab.getAttribute('data-tab'));
                    window.history.replaceState(null, '', url.toString());
                } catch (e) {}
            });
        });

        // ── Search + scope filter ──
        var searchInput = document.getElementById('qSearchInput');
        var scopeSel = document.getElementById('qFilterScope');
        function applyQuestionFilters() {
            var q = (searchInput ? searchInput.value : '').toLowerCase().trim();
            var scope = scopeSel ? scopeSel.value : 'all';
            document.querySelectorAll('#questionsTable tbody tr').forEach(function(row) {
                var blob = row.getAttribute('data-search') || '';
                var rowScope = row.getAttribute('data-scope') || 'other';
                var scopeOk = (scope === 'all') ||
                              (scope === 'reusable' && rowScope === 'reusable') ||
                              (scope === 'quiz' && rowScope === 'quiz');
                var searchOk = (q === '' || blob.indexOf(q) !== -1);
                row.style.display = (scopeOk && searchOk) ? '' : 'none';
            });
        }
        if (searchInput) { searchInput.addEventListener('input', applyQuestionFilters); }
        if (scopeSel) { scopeSel.addEventListener('change', applyQuestionFilters); }

        // ── Modal open/close ──
        var modal = document.getElementById('qbCreateModal');
        var openBtn = document.getElementById('qb_create_btn_open');
        var closeBtn = document.getElementById('qbCreateModalClose');
        var cancelBtn = document.getElementById('qbCreateModalCancel');
        var proceedBtn = document.getElementById('qbCreateModalProceed');
        var levelSel = document.getElementById('qb_level_select');
        var subjectSel = document.getElementById('qb_subject_select');

        function openModal() {
            levelSel.value = '';
            subjectSel.innerHTML = '<option value=""><?= get_string('act_select_level_first','local_istikama_admin') ?></option>';
            subjectSel.disabled = true;
            proceedBtn.disabled = true;
            modal.style.display = 'flex';
            requestAnimationFrame(function() { modal.classList.add('isti-modal-visible'); });
            setTimeout(function() { levelSel.focus(); }, 50);
        }
        function closeModal() {
            modal.classList.remove('isti-modal-visible');
            setTimeout(function() { modal.style.display = 'none'; }, 200);
        }

        if (openBtn) { openBtn.addEventListener('click', openModal); }
        if (closeBtn) { closeBtn.addEventListener('click', closeModal); }
        if (cancelBtn) { cancelBtn.addEventListener('click', closeModal); }
        modal.addEventListener('click', function(e) { if (e.target === modal) { closeModal(); } });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('isti-modal-visible')) { closeModal(); }
        });

        // ── Level/Subject cascade ──
        levelSel.addEventListener('change', function() {
            var lvid = parseInt(this.value, 10) || 0;
            subjectSel.innerHTML = '';
            proceedBtn.disabled = true;
            if (!lvid) {
                subjectSel.innerHTML = '<option value=""><?= get_string('act_select_level_first','local_istikama_admin') ?></option>';
                subjectSel.disabled = true;
                return;
            }
            var level = pickerData.find(function(l) { return l.id === lvid; });
            if (!level || !level.subjects.length) {
                subjectSel.innerHTML = '<option value=""><?= s(get_string('act_no_subjects','local_istikama_admin')) ?></option>';
                subjectSel.disabled = true;
                return;
            }
            var placeholder = document.createElement('option');
            placeholder.value = '';
            placeholder.textContent = '— Select Subject —';
            subjectSel.appendChild(placeholder);
            level.subjects.forEach(function(s) {
                var opt = document.createElement('option');
                opt.value = String(s.id);
                opt.textContent = s.name;
                subjectSel.appendChild(opt);
            });
            subjectSel.disabled = false;
        });
        subjectSel.addEventListener('change', function() {
            proceedBtn.disabled = !this.value;
        });

        // ── Proceed → forward to wrapper page which auto-resolves the question category and shows the Moodle qtype chooser ──
        proceedBtn.addEventListener('click', function() {
            var lvid = parseInt(levelSel.value, 10) || 0;
            var subid = parseInt(subjectSel.value, 10) || 0;
            if (!lvid || !subid) { return; }
            var url = createUrl + '?levelid=' + lvid + '&subjectid=' + subid + '&sesskey=' + encodeURIComponent(sesskey);
            window.location.href = url;
        });

        // ── Quizzes tab: search + scope filter ──
        var qzSearchInput = document.getElementById('qzSearchInput');
        var qzScopeSel = document.getElementById('qzFilterScope');
        function applyQuizFilters() {
            var q = (qzSearchInput ? qzSearchInput.value : '').toLowerCase().trim();
            var scope = qzScopeSel ? qzScopeSel.value : 'all';
            document.querySelectorAll('#quizzesTable tbody tr').forEach(function(row) {
                var blob = row.getAttribute('data-search') || '';
                var rowScope = row.getAttribute('data-scope') || 'course';
                var scopeOk = (scope === 'all') ||
                              (scope === 'reusable' && rowScope === 'reusable') ||
                              (scope === 'course' && rowScope === 'course');
                var searchOk = (q === '' || blob.indexOf(q) !== -1);
                row.style.display = (scopeOk && searchOk) ? '' : 'none';
            });
        }
        if (qzSearchInput) { qzSearchInput.addEventListener('input', applyQuizFilters); }
        if (qzScopeSel) { qzScopeSel.addEventListener('change', applyQuizFilters); }

        // ── Create Quiz modal ──
        var qzModal = document.getElementById('qzCreateModal');
        var qzOpenBtn = document.getElementById('qz_create_btn_open');
        var qzCloseBtn = document.getElementById('qzCreateModalClose');
        var qzCancelBtn = document.getElementById('qzCreateModalCancel');
        var qzProceedBtn = document.getElementById('qzCreateModalProceed');
        var qzLevelSel = document.getElementById('qz_level_select');
        var qzSubjectSel = document.getElementById('qz_subject_select');

        var qzNameInput = document.getElementById('qz_name_input');
        var qzForm = document.getElementById('qzCreateForm');

        function qzValidate() {
            var nameOk = qzNameInput && qzNameInput.value.trim().length > 0;
            var subOk = qzSubjectSel && qzSubjectSel.value;
            qzProceedBtn.disabled = !(nameOk && subOk);
        }

        function qzOpen() {
            if (qzNameInput) { qzNameInput.value = ''; }
            qzLevelSel.value = '';
            qzSubjectSel.innerHTML = '<option value=""><?= get_string('act_select_level_first','local_istikama_admin') ?></option>';
            qzSubjectSel.disabled = true;
            qzProceedBtn.disabled = true;
            qzModal.style.display = 'flex';
            requestAnimationFrame(function() { qzModal.classList.add('isti-modal-visible'); });
            setTimeout(function() { if (qzNameInput) qzNameInput.focus(); }, 50);
        }
        function qzClose() {
            qzModal.classList.remove('isti-modal-visible');
            setTimeout(function() { qzModal.style.display = 'none'; }, 200);
        }
        if (qzOpenBtn) { qzOpenBtn.addEventListener('click', qzOpen); }
        if (qzCloseBtn) { qzCloseBtn.addEventListener('click', qzClose); }
        if (qzCancelBtn) { qzCancelBtn.addEventListener('click', qzClose); }
        qzModal.addEventListener('click', function(e) { if (e.target === qzModal) { qzClose(); } });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && qzModal.classList.contains('isti-modal-visible')) { qzClose(); }
        });
        if (qzNameInput) { qzNameInput.addEventListener('input', qzValidate); }
        qzLevelSel.addEventListener('change', function() {
            var lvid = parseInt(this.value, 10) || 0;
            qzSubjectSel.innerHTML = '';
            qzProceedBtn.disabled = true;
            if (!lvid) {
                qzSubjectSel.innerHTML = '<option value=""><?= get_string('act_select_level_first','local_istikama_admin') ?></option>';
                qzSubjectSel.disabled = true;
                qzValidate();
                return;
            }
            var level = pickerData.find(function(l) { return l.id === lvid; });
            if (!level || !level.subjects.length) {
                qzSubjectSel.innerHTML = '<option value=""><?= s(get_string('act_no_subjects','local_istikama_admin')) ?></option>';
                qzSubjectSel.disabled = true;
                qzValidate();
                return;
            }
            var ph = document.createElement('option');
            ph.value = ''; ph.textContent = '— Select Subject —';
            qzSubjectSel.appendChild(ph);
            level.subjects.forEach(function(s) {
                var opt = document.createElement('option');
                opt.value = String(s.id);
                opt.textContent = s.name;
                qzSubjectSel.appendChild(opt);
            });
            qzSubjectSel.disabled = false;
            qzValidate();
        });
        qzSubjectSel.addEventListener('change', function() {
            qzValidate();
        });
        // Form submit is handled natively by the <form> — no JS redirect needed.

        // ── Moderation: approve / report buttons (AJAX) ──
        var ajaxUrl = '<?= (new moodle_url('/local/istikama_admin/ajax.php'))->out(false) ?>';

        function callMod(action, qbeId, reason) {
            var body = new URLSearchParams();
            body.append('action', action);
            body.append('sesskey', sesskey);
            body.append('qbe_id', String(qbeId));
            if (typeof reason === 'string') { body.append('reason', reason); }
            return fetch(ajaxUrl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: body.toString()
            }).then(function(r) { return r.json().catch(function() { return { success:false }; }); });
        }

        document.addEventListener('click', function(e) {
            var approveBtn = e.target.closest && e.target.closest('.js-qmod-approve');
            var reportBtn = e.target.closest && e.target.closest('.js-qmod-report');

            if (approveBtn) {
                e.preventDefault();
                var qbe = parseInt(approveBtn.getAttribute('data-qbe'), 10);
                if (!qbe) { return; }
                callMod('approve_question', qbe).then(function(res) {
                    if (res && res.success) { location.reload(); }
                    else { alert((res && res.error) || <?= json_encode(get_string('act_could_not_approve','local_istikama_admin'), JSON_UNESCAPED_UNICODE) ?>); }
                });
                return;
            }

            if (reportBtn) {
                e.preventDefault();
                var qbe2 = parseInt(reportBtn.getAttribute('data-qbe'), 10);
                if (!qbe2) { return; }
                var reason = prompt(<?= json_encode(get_string('act_report_reason_prompt','local_istikama_admin'), JSON_UNESCAPED_UNICODE) ?>, '');
                if (reason === null) { return; }
                callMod('report_question', qbe2, reason).then(function(res) {
                    if (res && res.success) { location.reload(); }
                    else { alert((res && res.error) || <?= json_encode(get_string('act_could_not_report','local_istikama_admin'), JSON_UNESCAPED_UNICODE) ?>); }
                });
            }
        });
    });
})();
</script>

<?php
echo '</div></div>';
echo $OUTPUT->footer();
