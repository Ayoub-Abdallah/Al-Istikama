<?php
/**
 * Pick questions from the central bank and add them to a quiz.
 *
 * GET params:
 *   cmid       : the target quiz's course_module id (required)
 *   levelid    : preselected level filter (optional — defaults to quiz's level)
 *   subjectid  : preselected subject filter (optional — defaults to quiz's subject)
 *
 * POST (action=add): adds the selected qbe_ids to the quiz via the native
 * mod_quiz function quiz_add_quiz_question(). Already-attached questions are
 * skipped silently. After save, returns to /local/istikama_admin/edit_quiz.php.
 *
 * The list shows every non-hidden question in the system, joined to
 * istikama_question_meta for Level/Subject filtering. Quiz-context questions
 * are filtered out so we only add reusable / cross-quiz bank entries.
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');
require_once($CFG->dirroot . '/mod/quiz/locallib.php');

require_login();
local_istikama_admin_require_target_user();

global $DB, $PAGE, $OUTPUT, $USER;

$cmid       = required_param('cmid', PARAM_INT);
$levelid    = optional_param('levelid',   0, PARAM_INT);
$subjectid  = optional_param('subjectid', 0, PARAM_INT);
$qtypefilter = optional_param('qtype', '', PARAM_ALPHANUMEXT);
$search     = optional_param('q', '', PARAM_RAW);
$action     = optional_param('action', '', PARAM_ALPHA);

$cm = get_coursemodule_from_id('quiz', $cmid, 0, false, MUST_EXIST);
$quiz = $DB->get_record('quiz', ['id' => $cm->instance], '*', MUST_EXIST);
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$ctx = context_module::instance($cmid);
require_capability('mod/quiz:manage', $ctx);

// Inherit level/subject from quiz meta when not explicitly provided.
$qzmeta = $DB->get_record('istikama_quiz_meta', ['quizid' => (int)$quiz->id]);
if (!$levelid && $qzmeta)   { $levelid   = (int)$qzmeta->levelid; }
if (!$subjectid && $qzmeta) { $subjectid = (int)$qzmeta->subjectid; }

// Fallback: derive from the teacher's primary assignment (so a teacher opening
// pick_questions.php for a course-quiz immediately sees their bank).
if (!$levelid || !$subjectid) {
    $tier = local_istikama_admin_get_user_tier();
    if ($tier === 'teacher') {
        $assignments = local_istikama_admin_get_teacher_assignments();
        foreach ($assignments as $a) {
            if (!$levelid && !empty($a->levelid)) { $levelid = (int)$a->levelid; }
            if (!$subjectid && !empty($a->subjects)) {
                // subjects[] entries can be subject_name_ids or courseids; prefer subject_name_id.
                $sn = $DB->get_record('istikama_subject_names', ['id' => (int)$a->subjects[0]]);
                if ($sn) { $subjectid = (int)$sn->id; }
            }
            if ($levelid && $subjectid) { break; }
        }
    }
}

$editurl = new moodle_url('/local/istikama_admin/edit_quiz.php', ['cmid' => $cmid]);

// ─── Handle POST: add selected questions to the quiz ────────────────────────
if ($action === 'add') {
    require_sesskey();
    $qbeids = optional_param_array('qbe_ids', [], PARAM_INT);
    $added = 0;
    $skipped = 0;
    $errors = 0;

    foreach ($qbeids as $qbeid) {
        $qbeid = (int)$qbeid;
        if (!$qbeid) { continue; }

        // Skip if already attached.
        $already = $DB->record_exists_sql("
            SELECT 1
              FROM {quiz_slots} qs
              JOIN {question_references} qr ON qr.itemid = qs.id
             WHERE qs.quizid = :quizid
               AND qr.component = 'mod_quiz'
               AND qr.questionarea = 'slot'
               AND qr.questionbankentryid = :qbe
        ", ['quizid' => $quiz->id, 'qbe' => $qbeid]);
        if ($already) { $skipped++; continue; }

        // Resolve the latest non-hidden question id for this entry.
        $qid = (int)$DB->get_field_sql("
            SELECT qv.questionid
              FROM {question_versions} qv
             WHERE qv.questionbankentryid = :qbe
               AND qv.status <> 'hidden'
          ORDER BY qv.version DESC
             LIMIT 1
        ", ['qbe' => $qbeid]);
        if (!$qid) { $errors++; continue; }

        try {
            quiz_add_quiz_question($qid, $quiz);
            $added++;
        } catch (Exception $e) {
            $errors++;
        }
    }

    \core\notification::success("Added {$added} question(s) to the quiz" .
        ($skipped ? ", skipped {$skipped} already-present" : '') .
        ($errors ? ", {$errors} failed" : '') . '.');
    redirect($editurl);
}

// ─── Level → Subjects picker data ───────────────────────────────────────────
$levels = $DB->get_records_select('course_categories', 'depth = 2', null, 'name ASC', 'id, name');
$picker_data = [];
foreach ($levels as $lv) {
    $subjects = $DB->get_records('istikama_subject_names', ['level_id' => $lv->id], 'name ASC');
    if (empty($subjects)) { continue; }
    $subs = [];
    foreach ($subjects as $s) {
        $subs[] = ['id' => (int)$s->id, 'name' => format_string($s->name)];
    }
    $picker_data[] = [
        'id'       => (int)$lv->id,
        'name'     => format_string($lv->name),
        'subjects' => $subs,
    ];
}

// ─── Already-attached qbe ids (to mark rows disabled / "already in quiz") ───
$attached = [];
$attached_rows = $DB->get_records_sql("
    SELECT qr.questionbankentryid AS qbe
      FROM {quiz_slots} qs
      JOIN {question_references} qr ON qr.itemid = qs.id
     WHERE qs.quizid = :quizid
       AND qr.component = 'mod_quiz'
       AND qr.questionarea = 'slot'
", ['quizid' => $quiz->id]);
foreach ($attached_rows as $r) { $attached[(int)$r->qbe] = true; }

// ─── Query: latest non-hidden version of every question, filtered by L+S ───
$where = ["qv.status <> 'hidden'"];
$params = [];

if ($levelid) {
    $where[] = "iqm.levelid = :levelid";
    $params['levelid'] = $levelid;
}
if ($subjectid) {
    $where[] = "iqm.subjectid = :subjectid";
    $params['subjectid'] = $subjectid;
}
if ($qtypefilter) {
    $where[] = "q.qtype = :qtype";
    $params['qtype'] = $qtypefilter;
}
$searchclean = trim($search);
if ($searchclean !== '') {
    $where[] = '(' . $DB->sql_like('q.name', ':s1', false) . ' OR ' . $DB->sql_like('q.questiontext', ':s2', false) . ')';
    $params['s1'] = '%' . $DB->sql_like_escape($searchclean) . '%';
    $params['s2'] = '%' . $DB->sql_like_escape($searchclean) . '%';
}

$wheresql = $where ? ('WHERE ' . implode(' AND ', $where)) : '';

$sql = "
    SELECT q.id AS qid,
           q.name AS qname,
           q.qtype AS qtype,
           q.questiontext AS qtext,
           q.questiontextformat AS qtextformat,
           q.timemodified,
           qbe.id AS qbeid,
           qv.version AS qversion,
           iqm.levelid,
           iqm.subjectid,
           iqm.review_status,
           iqm.reported,
           lvl.name AS levelname,
           subj.name AS subjectname,
           u.firstname AS creatorfirst,
           u.lastname AS creatorlast
      FROM {question_bank_entries} qbe
      JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
      JOIN (SELECT questionbankentryid, MAX(version) AS maxv
              FROM {question_versions}
             WHERE status <> 'hidden'
          GROUP BY questionbankentryid) latest
        ON latest.questionbankentryid = qbe.id AND latest.maxv = qv.version
      JOIN {question} q ON q.id = qv.questionid
 LEFT JOIN {istikama_question_meta} iqm ON iqm.qbe_id = qbe.id
 LEFT JOIN {course_categories} lvl ON lvl.id = iqm.levelid
 LEFT JOIN {istikama_subject_names} subj ON subj.id = iqm.subjectid
 LEFT JOIN {user} u ON u.id = q.createdby
        $wheresql
  ORDER BY q.timemodified DESC
";
$questions = $DB->get_records_sql($sql, $params, 0, 1000);

// Distinct qtypes available (for the qtype dropdown).
$qtypes_available = [];
foreach ($questions as $q) {
    if (!isset($qtypes_available[$q->qtype])) { $qtypes_available[$q->qtype] = ucfirst($q->qtype); }
}
ksort($qtypes_available);

// Page setup.
$baseurl = new moodle_url('/local/istikama_admin/pick_questions.php', [
    'cmid' => $cmid, 'levelid' => $levelid, 'subjectid' => $subjectid,
]);
$PAGE->set_url($baseurl);
$PAGE->set_context($ctx);
$PAGE->set_course($course);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('pk_title','local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

require_once('admin_layout.php');

$dir = right_to_left() ? 'rtl' : 'ltr';
$textalign = right_to_left() ? 'right' : 'left';

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

$selected_level   = $levelid   ? ($DB->get_field('course_categories', 'name', ['id' => $levelid]) ?: '') : '';
$selected_subject = $subjectid ? ($DB->get_field('istikama_subject_names', 'name', ['id' => $subjectid]) ?: '') : '';
?>
<div class="container-fluid" dir="<?= $dir ?>" style="text-align:<?= $textalign ?>; background:#f8fafc; min-height:600px; margin:-24px; padding:24px;">

    <!-- Header -->
    <div class="isti-card" style="padding:20px 24px; margin-bottom:18px; display:flex; align-items:center; gap:16px; flex-wrap:wrap;">
        <a href="<?= $editurl->out() ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-arrow-left"></i> <?= get_string('q_back_to_quiz','local_istikama_admin') ?>
        </a>
        <span style="display:inline-flex;align-items:center;justify-content:center;width:46px;height:46px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.2rem">
            <i class="fa fa-folder-open"></i>
        </span>
        <div style="flex:1; min-width:240px">
            <h5 style="margin:0 0 4px 0; font-weight:700; color:#1e293b"><?= get_string('pk_heading','local_istikama_admin') ?> — <?= format_string($quiz->name) ?></h5>
            <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap; margin-top:6px">
                <?php if ($selected_level): ?>
                    <span class="isti-badge" style="background:#eff6ff;color:#006bff"><i class="fa fa-layer-group"></i> <?= s($selected_level) ?></span>
                <?php endif; ?>
                <?php if ($selected_subject): ?>
                    <span class="isti-badge isti-badge-primary"><i class="fa fa-book"></i> <?= s($selected_subject) ?></span>
                <?php endif; ?>
                <span class="isti-badge isti-badge-neutral"><i class="fa fa-database"></i> <?= count($questions) ?> available</span>
            </div>
        </div>
        <button type="button" id="addSelectedBtn" class="isti-btn isti-btn-primary" disabled>
            <i class="fa fa-check"></i> <?= get_string('pk_add_selected','local_istikama_admin') ?> (<span id="selectedCount">0</span>)
        </button>
    </div>

    <!-- Filter bar -->
    <form method="get" action="<?= (new moodle_url('/local/istikama_admin/pick_questions.php'))->out(false) ?>" class="isti-card"
          style="padding:14px 18px;margin-bottom:16px;display:flex;gap:10px;flex-wrap:wrap;align-items:center">
        <input type="hidden" name="cmid" value="<?= (int)$cmid ?>">
        <select name="levelid" class="isti-form-select" style="max-width:200px;font-size:.88rem" id="pkLevel">
            <option value="0"><?= get_string('pk_all_levels','local_istikama_admin') ?></option>
            <?php foreach ($picker_data as $lv): ?>
                <option value="<?= (int)$lv['id'] ?>" <?= (int)$lv['id'] === $levelid ? 'selected' : '' ?>><?= s($lv['name']) ?></option>
            <?php endforeach; ?>
        </select>
        <select name="subjectid" class="isti-form-select" style="max-width:220px;font-size:.88rem" id="pkSubject">
            <option value="0"><?= get_string('pk_all_subjects','local_istikama_admin') ?></option>
            <?php
            foreach ($picker_data as $lv) {
                foreach ($lv['subjects'] as $s) {
                    $sel = ((int)$s['id'] === $subjectid) ? 'selected' : '';
                    $optlvl = $lv['id'];
                    echo '<option value="' . (int)$s['id'] . '" data-level="' . (int)$optlvl . '" ' . $sel . '>'
                        . s($s['name'] . '  ·  ' . $lv['name']) . '</option>';
                }
            }
            ?>
        </select>
        <select name="qtype" class="isti-form-select" style="max-width:180px;font-size:.88rem">
            <option value=""><?= get_string('pk_any_type','local_istikama_admin') ?></option>
            <?php foreach ($qtypes_available as $tname => $tlabel): ?>
                <option value="<?= s($tname) ?>" <?= $tname === $qtypefilter ? 'selected' : '' ?>><?= s($tlabel) ?></option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="q" value="<?= s($searchclean) ?>" placeholder="<?= s(get_string('pk_search_ph','local_istikama_admin')) ?>"
               class="isti-form-input" style="flex:1;min-width:200px;font-size:.88rem">
        <button type="submit" class="isti-btn isti-btn-primary"><i class="fa fa-search"></i> <?= get_string('pk_filter','local_istikama_admin') ?></button>
        <a href="<?= (new moodle_url('/local/istikama_admin/pick_questions.php', ['cmid' => $cmid]))->out(false) ?>"
           class="isti-btn isti-btn-outline" style="white-space:nowrap"><?= get_string('pk_clear','local_istikama_admin') ?></a>
    </form>

    <?php if (empty($questions)): ?>
        <div class="isti-card" style="text-align:center;padding:48px 20px;color:#94a3b8">
            <i class="fa fa-search" style="font-size:3rem;margin-bottom:16px;display:block;color:#cbd5e1"></i>
            <p style="margin:0;font-size:1.05rem;color:#475569;font-weight:500"><?= get_string('pk_no_match','local_istikama_admin') ?></p>
            <p style="margin:6px 0 0 0;font-size:.9rem;color:#94a3b8">Try clearing filters, or create new questions for this Level &amp; Subject.</p>
        </div>
    <?php else: ?>
        <form method="post" action="<?= (new moodle_url('/local/istikama_admin/pick_questions.php'))->out(false) ?>" id="pickForm">
            <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="cmid" value="<?= (int)$cmid ?>">

            <div class="isti-card" style="padding:0;overflow:hidden">
                <div class="table-responsive">
                    <table class="isti-table" style="margin:0">
                        <thead><tr>
                            <th style="width:44px">
                                <input type="checkbox" id="selectAll" title="<?= s(get_string('pk_select_all','local_istikama_admin')) ?>">
                            </th>
                            <th style="width:54px"></th>
                            <th><?= get_string('act_col_question','local_istikama_admin') ?></th>
                            <th style="width:140px"><?= get_string('act_col_type','local_istikama_admin') ?></th>
                            <th><?= get_string('act_col_level','local_istikama_admin') ?></th>
                            <th><?= get_string('act_col_subject','local_istikama_admin') ?></th>
                            <th><?= get_string('act_col_creator','local_istikama_admin') ?></th>
                            <th style="text-align:right"><?= get_string('act_col_modified','local_istikama_admin') ?></th>
                        </tr></thead>
                        <tbody>
                            <?php foreach ($questions as $q):
                                $ico = $qtype_icons[$q->qtype] ?? 'fa-question';
                                $clr = $qtype_colors[$q->qtype] ?? '#64748b';
                                $plain = trim(html_to_text(format_text($q->qtext ?? '', (int)($q->qtextformat ?? FORMAT_HTML), ['context' => $ctx, 'noclean' => true])));
                                if (mb_strlen($plain) > 140) { $plain = mb_substr($plain, 0, 140) . '…'; }
                                $is_attached = isset($attached[(int)$q->qbeid]);
                                $creator = trim((string)$q->creatorfirst . ' ' . (string)$q->creatorlast) ?: '—';
                            ?>
                            <tr<?= $is_attached ? ' style="opacity:0.55;background:#f8fafc"' : '' ?>>
                                <td>
                                    <?php if ($is_attached): ?>
                                        <i class="fa fa-check-circle" style="color:#10b981" title="Already in this quiz"></i>
                                    <?php else: ?>
                                        <input type="checkbox" name="qbe_ids[]" value="<?= (int)$q->qbeid ?>" class="js-pick-row">
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="isti-qtype-pill" style="background:<?= $clr ?>15;color:<?= $clr ?>">
                                        <i class="fa <?= $ico ?>"></i>
                                    </span>
                                </td>
                                <td>
                                    <strong><?= format_string($q->qname) ?></strong>
                                    <?php if ($is_attached): ?>
                                        <span class="isti-badge isti-badge-warning" style="font-size:.7rem;margin-left:6px"><i class="fa fa-check"></i> In quiz</span>
                                    <?php endif; ?>
                                    <?php if ($plain): ?>
                                    <div style="margin-top:4px;font-size:.82rem;color:#64748b"><?= s($plain) ?></div>
                                    <?php endif; ?>
                                </td>
                                <td><span class="isti-badge" style="background:<?= $clr ?>15;color:<?= $clr ?>"><?= s(ucfirst($q->qtype)) ?></span></td>
                                <td><?= s($q->levelname ?: '—') ?></td>
                                <td>
                                    <?php if ($q->subjectname): ?>
                                        <span class="isti-badge isti-badge-primary"><?= s($q->subjectname) ?></span>
                                    <?php else: ?>
                                        <span style="color:#94a3b8">—</span>
                                    <?php endif; ?>
                                </td>
                                <td style="font-size:.85rem;color:#475569"><?= s($creator) ?></td>
                                <td style="text-align:right;white-space:nowrap;color:#64748b;font-size:.82rem">
                                    <?= userdate($q->timemodified, get_string('strftimedatetimeshort', 'langconfig')) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

<script>
(function() {
    'use strict';
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('pickForm');
        var addBtn = document.getElementById('addSelectedBtn');
        var selAll = document.getElementById('selectAll');
        var counter = document.getElementById('selectedCount');

        function updateCount() {
            if (!form || !addBtn) { return; }
            var rows = form.querySelectorAll('.js-pick-row:checked');
            if (counter) { counter.textContent = String(rows.length); }
            addBtn.disabled = rows.length === 0;
        }
        if (form) {
            form.addEventListener('change', function(e) {
                if (e.target.classList.contains('js-pick-row') || e.target === selAll) {
                    updateCount();
                }
            });
        }
        if (selAll && form) {
            selAll.addEventListener('change', function() {
                form.querySelectorAll('.js-pick-row').forEach(function(cb) { cb.checked = selAll.checked; });
                updateCount();
            });
        }
        if (addBtn && form) {
            addBtn.addEventListener('click', function() {
                if (form.querySelectorAll('.js-pick-row:checked').length === 0) { return; }
                form.submit();
            });
        }

        // Cross-filter subjects to level.
        var pkLevel = document.getElementById('pkLevel');
        var pkSubject = document.getElementById('pkSubject');
        function syncSubjects() {
            if (!pkLevel || !pkSubject) { return; }
            var lvl = parseInt(pkLevel.value, 10) || 0;
            Array.prototype.forEach.call(pkSubject.options, function(opt) {
                if (!opt.value) { opt.hidden = false; return; }
                var ol = parseInt(opt.getAttribute('data-level'), 10) || 0;
                opt.hidden = (lvl !== 0 && ol !== lvl);
                if (opt.hidden && opt.selected) { pkSubject.value = '0'; }
            });
        }
        if (pkLevel) { pkLevel.addEventListener('change', syncSubjects); }
        syncSubjects();

        updateCount();
    });
})();
</script>

<?php
echo '</div></div>';
echo $OUTPUT->footer();
