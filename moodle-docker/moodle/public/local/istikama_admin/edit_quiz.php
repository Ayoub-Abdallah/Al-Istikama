<?php
/**
 * Native quiz slot editor inside our admin chrome.
 *
 * Replaces the previous iframe approach. Renders the quiz's slot list ourselves
 * and exposes three actions:
 *
 *   - Add From Bank   → /pick_questions.php (filtered by quiz's level + subject)
 *   - Add New         → /create_question.php?...&quizid=...&quizcmid=... (existing flow)
 *   - Remove / Reorder slots → AJAX into /local/istikama_admin/ajax.php
 *
 * Uses Moodle's native quiz_add_quiz_question() / structure::remove_slot() /
 * structure::move_slot() under the hood so grading, sections and pages remain
 * coherent.
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_target_user();

$cmid = required_param('cmid', PARAM_INT);

global $DB, $PAGE, $OUTPUT, $USER;

$cm = get_coursemodule_from_id('quiz', $cmid, 0, false, MUST_EXIST);
$quiz = $DB->get_record('quiz', ['id' => $cm->instance], '*', MUST_EXIST);
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$ctx = context_module::instance($cmid);
require_capability('mod/quiz:manage', $ctx);

// Reusable-quiz metadata (drives Add-From-Bank filtering).
$qzmeta = $DB->get_record('istikama_quiz_meta', ['quizid' => (int)$quiz->id]);
$qmeta_levelid = $qzmeta ? (int)$qzmeta->levelid : 0;
$qmeta_subjectid = $qzmeta ? (int)$qzmeta->subjectid : 0;
$qmeta_levelname = '';
$qmeta_subjectname = '';
if ($qmeta_levelid) {
    // BUG FIX: levelid stored on questions historically pointed at either
    // istikama_global_level.id (the canonical level catalog) OR at the older
    // course_categories.id at depth=2. Try the canonical table first, then
    // fall back so old records still render their level name.
    $lv = $DB->get_record('istikama_global_level', ['id' => $qmeta_levelid], 'name');
    if (!$lv) {
        $lv = $DB->get_record('course_categories', ['id' => $qmeta_levelid], 'name');
    }
    if ($lv) { $qmeta_levelname = $lv->name; }
}
if ($qmeta_subjectid) {
    $sub = $DB->get_record('istikama_subject_names', ['id' => $qmeta_subjectid], 'name');
    if ($sub) { $qmeta_subjectname = $sub->name; }
}

// Pre-built Level → Subjects picker for the "Add New Question" modal.
//
// BUG FIX: the old query used course_categories WHERE depth=2 (per-school
// level *categories*, IDs in the 17–32 range). But istikama_subject_names.level_id
// references istikama_global_level.id (1–13) — a different namespace — so the
// JOIN almost never matched and the picker showed no levels. Use the canonical
// level catalog directly.
$levels = $DB->get_records('istikama_global_level', null, 'order_index ASC, name ASC', 'id, name, tier');
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

// Page setup.
$baseurl = new moodle_url('/local/istikama_admin/edit_quiz.php', ['cmid' => $cmid]);
$returnurl = new moodle_url('/local/istikama_admin/activities.php', ['tab' => 'quizzes']);
$viewurl   = (new moodle_url('/local/istikama_admin/view_quiz.php', ['id' => $cmid]))->out(false);
$settingsurl = (new moodle_url('/course/modedit.php', ['update' => $cmid, 'return' => 1]))->out(false);
$pickurl   = (new moodle_url('/local/istikama_admin/pick_questions.php', [
    'cmid'      => $cmid,
    'levelid'   => $qmeta_levelid,
    'subjectid' => $qmeta_subjectid,
]))->out(false);

$PAGE->set_url($baseurl);
$PAGE->set_context($ctx);
$PAGE->set_course($course);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('q_edit_quiz','local_istikama_admin').': ' . format_string($quiz->name));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

require_once('admin_layout.php');

$dir = right_to_left() ? 'rtl' : 'ltr';
$textalign = right_to_left() ? 'right' : 'left';

// Pull the slot list natively.
$slots = $DB->get_records_sql("
    SELECT qs.id AS slotid,
           qs.slot,
           qs.page,
           qs.maxmark,
           qs.requireprevious,
           qr.questionbankentryid AS qbeid,
           qv.questionid,
           qv.version,
           q.name   AS qname,
           q.qtype  AS qtype,
           q.questiontext AS qtext,
           q.questiontextformat AS qtextformat,
           q.defaultmark
      FROM {quiz_slots} qs
 LEFT JOIN {question_references} qr
        ON qr.itemid = qs.id
       AND qr.component = 'mod_quiz'
       AND qr.questionarea = 'slot'
 LEFT JOIN {question_bank_entries} qbe ON qbe.id = qr.questionbankentryid
 LEFT JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
       AND qv.version = (SELECT MAX(version)
                           FROM {question_versions}
                          WHERE questionbankentryid = qbe.id
                            AND status <> 'hidden')
 LEFT JOIN {question} q ON q.id = qv.questionid
     WHERE qs.quizid = :quizid
  ORDER BY qs.slot ASC
", ['quizid' => $quiz->id]);

$slotcount = count($slots);
$totalmark = 0.0;
foreach ($slots as $s) { $totalmark += (float)$s->maxmark; }

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
?>
<div class="container-fluid" dir="<?= $dir ?>" style="text-align:<?= $textalign ?>; background:#f8fafc; min-height:600px; margin:-24px; padding:24px;">

    <!-- Header card -->
    <div class="isti-card" style="padding:20px 24px; margin-bottom:18px; display:flex; align-items:center; gap:14px; flex-wrap:wrap;">
        <a href="<?= $returnurl->out() ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-arrow-left"></i> <?= get_string('q_back','local_istikama_admin') ?>
        </a>
        <span style="display:inline-flex;align-items:center;justify-content:center;width:46px;height:46px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.2rem">
            <i class="fa fa-edit"></i>
        </span>
        <div style="flex:1; min-width:220px">
            <h5 style="margin:0 0 4px 0; font-weight:700; color:#1e293b"><?= format_string($quiz->name) ?></h5>
            <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap; margin-top:6px">
                <?php if ($qmeta_levelname): ?>
                <span class="isti-badge" style="background:#eff6ff;color:#006bff"><i class="fa fa-layer-group"></i> <?= s($qmeta_levelname) ?></span>
                <?php endif; ?>
                <?php if ($qmeta_subjectname): ?>
                <span class="isti-badge isti-badge-primary"><i class="fa fa-book"></i> <?= s($qmeta_subjectname) ?></span>
                <?php endif; ?>
                <span class="isti-badge isti-badge-neutral" id="slotCountBadge"><i class="fa fa-list-ol"></i> <?= get_string('q_n_questions','local_istikama_admin', $slotcount) ?></span>
                <span class="isti-badge isti-badge-neutral" id="totalMarkBadge"><i class="fa fa-star"></i> <?= get_string('q_n_marks','local_istikama_admin', rtrim(rtrim(number_format($totalmark, 2), '0'), '.') ?: '0') ?></span>
            </div>
        </div>
        <a href="<?= s($pickurl) ?>" class="isti-btn isti-btn-primary" style="white-space:nowrap">
            <i class="fa fa-folder-open"></i> <?= get_string('q_add_from_bank','local_istikama_admin') ?>
        </a>
        <button type="button" id="addNewQuestionBtn" class="isti-btn isti-btn-primary" style="white-space:nowrap;background:#10b981;border-color:#10b981">
            <i class="fa fa-plus"></i> <?= get_string('q_add_new_q','local_istikama_admin') ?>
        </button>
        <a href="<?= s($viewurl) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-eye"></i> <?= get_string('q_preview','local_istikama_admin') ?>
        </a>
        <a href="<?= s($settingsurl) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-cog"></i> <?= get_string('q_settings','local_istikama_admin') ?>
        </a>
    </div>

    <!-- Slot list -->
    <div class="isti-card" style="padding:0;overflow:hidden">
        <div style="padding:14px 20px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;gap:8px;flex-wrap:wrap">
            <h6 style="margin:0;font-weight:700;color:#1e293b"><i class="fa fa-list-ol" style="color:#006bff"></i> <?= get_string('q_questions_layout','local_istikama_admin') ?></h6>
            <span style="font-size:.78rem;color:#94a3b8"><?= get_string('q_reorder_hint','local_istikama_admin') ?></span>
        </div>

        <?php if ($slotcount === 0): ?>
            <div style="padding:64px 20px;text-align:center;color:#94a3b8">
                <i class="fa fa-inbox" style="font-size:3rem;display:block;margin-bottom:16px;color:#cbd5e1"></i>
                <p style="margin:0;font-size:1.05rem;color:#475569;font-weight:500"><?= get_string('q_no_questions','local_istikama_admin') ?></p>
                <p style="margin:6px 0 14px 0;font-size:.9rem"><?= get_string('q_no_questions_hint','local_istikama_admin') ?></p>
                <div style="display:inline-flex;gap:10px;flex-wrap:wrap;justify-content:center">
                    <a href="<?= s($pickurl) ?>" class="isti-btn isti-btn-primary"><i class="fa fa-folder-open"></i> <?= get_string('q_add_from_bank','local_istikama_admin') ?></a>
                    <button type="button" id="addNewQuestionBtn2" class="isti-btn isti-btn-primary" style="background:#10b981;border-color:#10b981"><i class="fa fa-plus"></i> <?= get_string('act_create_q_title','local_istikama_admin') ?></button>
                </div>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="isti-table" id="slotsTable" style="margin:0">
                    <thead><tr>
                        <th style="width:90px"><?= get_string('q_col_order','local_istikama_admin') ?></th>
                        <th style="width:54px"></th>
                        <th><?= get_string('act_col_question','local_istikama_admin') ?></th>
                        <th style="width:140px"><?= get_string('act_col_type','local_istikama_admin') ?></th>
                        <th style="text-align:right;width:120px"><?= get_string('q_col_marks','local_istikama_admin') ?></th>
                        <th style="text-align:center;width:120px"><?= get_string('act_col_actions','local_istikama_admin') ?></th>
                    </tr></thead>
                    <tbody>
                        <?php $idx = 0; foreach ($slots as $s):
                            $idx++;
                            $qtype = $s->qtype ?: 'unknown';
                            $ico = $qtype_icons[$qtype] ?? 'fa-question';
                            $clr = $qtype_colors[$qtype] ?? '#64748b';
                            $qname = $s->qname ?: get_string('q_question_missing','local_istikama_admin');
                            $plain = trim(html_to_text(format_text($s->qtext ?? '', (int)($s->qtextformat ?? FORMAT_HTML), ['context' => $ctx, 'noclean' => true])));
                            if (mb_strlen($plain) > 110) { $plain = mb_substr($plain, 0, 110) . '…'; }
                        ?>
                        <tr data-slotid="<?= (int)$s->slotid ?>" data-slot="<?= (int)$s->slot ?>">
                            <td>
                                <div style="display:inline-flex;align-items:center;gap:4px">
                                    <strong style="color:#1e293b;min-width:24px;display:inline-block;text-align:right"><?= (int)$s->slot ?></strong>
                                    <button type="button" class="isti-icon-btn js-slot-up" title="Move up"<?= $idx === 1 ? ' disabled' : '' ?>><i class="fa fa-arrow-up"></i></button>
                                    <button type="button" class="isti-icon-btn js-slot-down" title="Move down"<?= $idx === $slotcount ? ' disabled' : '' ?>><i class="fa fa-arrow-down"></i></button>
                                </div>
                            </td>
                            <td>
                                <span class="isti-qtype-pill" style="background:<?= $clr ?>15;color:<?= $clr ?>">
                                    <i class="fa <?= $ico ?>"></i>
                                </span>
                            </td>
                            <td>
                                <strong><?= format_string($qname) ?></strong>
                                <?php if ($plain): ?>
                                <div style="margin-top:4px;font-size:.82rem;color:#64748b"><?= s($plain) ?></div>
                                <?php endif; ?>
                            </td>
                            <td><span class="isti-badge" style="background:<?= $clr ?>15;color:<?= $clr ?>"><?= s(ucfirst($qtype)) ?></span></td>
                            <td style="text-align:right">
                                <input type="number" step="0.01" min="0" class="isti-form-input js-slot-mark"
                                       value="<?= rtrim(rtrim(number_format((float)$s->maxmark, 2), '0'), '.') ?: '0' ?>"
                                       style="width:80px;text-align:right;font-weight:600">
                            </td>
                            <td style="text-align:center;white-space:nowrap">
                                <?php if (!empty($s->questionid)): ?>
                                <a href="<?= (new moodle_url('/local/istikama_admin/preview_question.php', ['id' => (int)$s->questionid]))->out(false) ?>" class="isti-icon-btn" title="Preview"><i class="fa fa-eye"></i></a>
                                <a href="<?= (new moodle_url('/question/bank/editquestion/question.php', ['id' => (int)$s->questionid, 'cmid' => $cmid, 'courseid' => $course->id, 'returnurl' => '/local/istikama_admin/edit_quiz.php?cmid=' . $cmid]))->out(false) ?>" class="isti-icon-btn" title="Edit Question"><i class="fa fa-edit"></i></a>
                                <?php endif; ?>
                                <button type="button" class="isti-icon-btn isti-icon-btn-danger js-slot-remove" title="Remove from quiz"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- ─── Add-New-Question Modal ─── -->
<div class="isti-modal-overlay" id="qbCreateModal" role="dialog" aria-modal="true" aria-labelledby="qbCreateModalTitle">
    <div class="isti-modal" style="max-width:520px">
        <div class="isti-modal-header">
            <div>
                <h3 id="qbCreateModalTitle" style="margin:0;font-size:1.1rem;font-weight:700;color:#1e293b">
                    <i class="fa fa-plus-circle" style="color:#006bff"></i> <?= get_string('eq_modal_title','local_istikama_admin') ?>
                </h3>
                <span class="isti-kpi-label" style="font-size:.72rem;color:#64748b">Choose a Level and Subject — the question is saved to the central bank and attached to this quiz.</span>
            </div>
            <button type="button" class="isti-modal-close" id="qbCreateModalClose" aria-label="Close">&times;</button>
        </div>
        <div class="isti-modal-body">
            <div class="isti-form-group" style="margin-bottom:16px">
                <label for="qb_level_select" class="isti-form-label">
                    <i class="fa fa-layer-group" style="color:#006bff;margin-right:6px"></i><?= get_string('act_level','local_istikama_admin') ?>
                </label>
                <select id="qb_level_select" class="isti-form-select" style="width:100%">
                    <option value=""><?= get_string('act_select_level','local_istikama_admin') ?></option>
                    <?php foreach ($picker_data as $lv): ?>
                        <option value="<?= (int)$lv['id'] ?>" <?= $qmeta_levelid === (int)$lv['id'] ? 'selected' : '' ?>><?= s($lv['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="isti-form-group">
                <label for="qb_subject_select" class="isti-form-label">
                    <i class="fa fa-book" style="color:#006bff;margin-right:6px"></i><?= get_string('act_subject','local_istikama_admin') ?>
                </label>
                <select id="qb_subject_select" class="isti-form-select" style="width:100%" disabled>
                    <option value=""><?= get_string('act_select_level_first','local_istikama_admin') ?></option>
                </select>
            </div>
        </div>
        <div class="isti-modal-footer">
            <button type="button" class="isti-btn isti-btn-outline" id="qbCreateModalCancel"><?= get_string('act_cancel','local_istikama_admin') ?></button>
            <button type="button" class="isti-btn isti-btn-primary" id="qbCreateModalProceed" disabled>
                <i class="fa fa-arrow-right"></i> <?= get_string('act_proceed','local_istikama_admin') ?>
            </button>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';
    var pickerData = <?= json_encode($picker_data, JSON_UNESCAPED_UNICODE) ?>;
    var presetLevel = <?= (int)$qmeta_levelid ?>;
    var presetSubject = <?= (int)$qmeta_subjectid ?>;
    var createUrl = '<?= (new moodle_url('/local/istikama_admin/create_question.php'))->out(false) ?>';
    var ajaxUrl = '<?= (new moodle_url('/local/istikama_admin/ajax.php'))->out(false) ?>';
    var quizid = <?= (int)$quiz->id ?>;
    var quizcmid = <?= (int)$cmid ?>;
    var sesskey = '<?= sesskey() ?>';

    document.addEventListener('DOMContentLoaded', function() {

        // ─── Add New Question modal ─────────────────────────────────
        var modal = document.getElementById('qbCreateModal');
        var openBtn = document.getElementById('addNewQuestionBtn');
        var openBtn2 = document.getElementById('addNewQuestionBtn2');
        var closeBtn = document.getElementById('qbCreateModalClose');
        var cancelBtn = document.getElementById('qbCreateModalCancel');
        var proceedBtn = document.getElementById('qbCreateModalProceed');
        var levelSel = document.getElementById('qb_level_select');
        var subjectSel = document.getElementById('qb_subject_select');

        function populateSubjects(lvid, selectId) {
            subjectSel.innerHTML = '';
            proceedBtn.disabled = true;
            if (!lvid) {
                subjectSel.innerHTML = '<option value=""><?= get_string('act_select_level_first','local_istikama_admin') ?></option>';
                subjectSel.disabled = true;
                return;
            }
            var level = pickerData.find(function(l) { return l.id === lvid; });
            if (!level || !level.subjects.length) {
                subjectSel.innerHTML = <?= json_encode('<option value="">'.s(get_string('act_no_subjects','local_istikama_admin')).'</option>', JSON_UNESCAPED_UNICODE) ?>;
                subjectSel.disabled = true;
                return;
            }
            var ph = document.createElement('option');
            ph.value = ''; ph.textContent = '— Select Subject —';
            subjectSel.appendChild(ph);
            level.subjects.forEach(function(s) {
                var opt = document.createElement('option');
                opt.value = String(s.id);
                opt.textContent = s.name;
                if (selectId && s.id === selectId) { opt.selected = true; }
                subjectSel.appendChild(opt);
            });
            subjectSel.disabled = false;
            if (selectId && subjectSel.value === String(selectId)) { proceedBtn.disabled = false; }
        }
        function openModal() {
            var lv = presetLevel || (parseInt(levelSel.value, 10) || 0);
            if (lv) { levelSel.value = String(lv); }
            populateSubjects(lv, presetSubject);
            modal.style.display = 'flex';
            requestAnimationFrame(function() { modal.classList.add('isti-modal-visible'); });
            setTimeout(function() { levelSel.focus(); }, 50);
        }
        function closeModal() {
            modal.classList.remove('isti-modal-visible');
            setTimeout(function() { modal.style.display = 'none'; }, 200);
        }
        if (openBtn)  { openBtn.addEventListener('click', openModal); }
        if (openBtn2) { openBtn2.addEventListener('click', openModal); }
        if (closeBtn) { closeBtn.addEventListener('click', closeModal); }
        if (cancelBtn) { cancelBtn.addEventListener('click', closeModal); }
        modal.addEventListener('click', function(e) { if (e.target === modal) { closeModal(); } });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('isti-modal-visible')) { closeModal(); }
        });
        levelSel.addEventListener('change', function() {
            var lvid = parseInt(this.value, 10) || 0;
            populateSubjects(lvid, 0);
        });
        subjectSel.addEventListener('change', function() {
            proceedBtn.disabled = !this.value;
        });
        proceedBtn.addEventListener('click', function() {
            var lvid = parseInt(levelSel.value, 10) || 0;
            var subid = parseInt(subjectSel.value, 10) || 0;
            if (!lvid || !subid) { return; }
            var url = createUrl
                + '?levelid=' + lvid
                + '&subjectid=' + subid
                + '&quizid=' + quizid
                + '&quizcmid=' + quizcmid
                + '&sesskey=' + encodeURIComponent(sesskey);
            window.location.href = url;
        });

        // ─── Slot management (remove / reorder / mark) ──────────────
        function callAction(action, payload) {
            var body = new URLSearchParams();
            body.append('action', action);
            body.append('sesskey', sesskey);
            body.append('cmid', String(quizcmid));
            Object.keys(payload || {}).forEach(function(k) {
                body.append(k, String(payload[k]));
            });
            return fetch(ajaxUrl, {
                method: 'POST',
                credentials: 'same-origin',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: body.toString()
            }).then(function(r) { return r.json().catch(function() { return { success: false }; }); });
        }

        var table = document.getElementById('slotsTable');
        if (!table) { return; }

        function busy(b) { table.style.opacity = b ? '0.5' : '1'; table.style.pointerEvents = b ? 'none' : ''; }

        table.addEventListener('click', function(e) {
            var removeBtn = e.target.closest && e.target.closest('.js-slot-remove');
            var upBtn = e.target.closest && e.target.closest('.js-slot-up');
            var downBtn = e.target.closest && e.target.closest('.js-slot-down');
            if (removeBtn) {
                e.preventDefault();
                var tr = removeBtn.closest('tr');
                if (!tr) { return; }
                if (!confirm('Remove this question from the quiz?\n\nThe question stays in the bank and can be re-added later.')) { return; }
                busy(true);
                callAction('quiz_slot_remove', { slot: tr.getAttribute('data-slot') })
                    .then(function(res) {
                        busy(false);
                        if (res && res.success) { window.location.reload(); }
                        else { alert((res && res.error) || <?= json_encode(get_string('q_err_remove','local_istikama_admin'), JSON_UNESCAPED_UNICODE) ?>); }
                    });
                return;
            }
            if (upBtn || downBtn) {
                e.preventDefault();
                var tr2 = (upBtn || downBtn).closest('tr');
                if (!tr2) { return; }
                busy(true);
                callAction('quiz_slot_move', {
                    slot: tr2.getAttribute('data-slot'),
                    direction: upBtn ? 'up' : 'down',
                }).then(function(res) {
                    busy(false);
                    if (res && res.success) { window.location.reload(); }
                    else { alert((res && res.error) || <?= json_encode(get_string('q_err_reorder','local_istikama_admin'), JSON_UNESCAPED_UNICODE) ?>); }
                });
            }
        });

        // Inline maxmark editing.
        table.addEventListener('change', function(e) {
            var inp = e.target.closest && e.target.closest('.js-slot-mark');
            if (!inp) { return; }
            var tr = inp.closest('tr');
            if (!tr) { return; }
            var v = parseFloat(inp.value);
            if (isNaN(v) || v < 0) { v = 0; inp.value = '0'; }
            callAction('quiz_slot_setmark', {
                slot: tr.getAttribute('data-slot'),
                maxmark: v,
            }).then(function(res) {
                if (!(res && res.success)) {
                    alert((res && res.error) || <?= json_encode(get_string('q_err_mark','local_istikama_admin'), JSON_UNESCAPED_UNICODE) ?>);
                }
            });
        });
    });
})();
</script>

<?php
echo '</div></div>';
echo $OUTPUT->footer();
