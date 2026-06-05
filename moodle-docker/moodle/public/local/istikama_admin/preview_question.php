<?php
/**
 * Modern wrapper around Moodle's native question preview.
 *
 * Loads the question via Moodle's REAL preview engine inside our admin chrome
 * (sidebar + navbar + theme), keeping all question behaviors intact (multichoice
 * rendering, true/false, calculated variants, etc.) and the "Start again" / "Save"
 * controls — but presented inside the Istikama layout instead of raw Moodle UI.
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_target_user();

$qid = required_param('id', PARAM_INT);

global $DB, $PAGE, $OUTPUT;

// Resolve the question and its (single) version + category for our header info.
$q = $DB->get_record_sql("
    SELECT q.id, q.name, q.qtype, q.timecreated, q.timemodified,
           qbe.id AS qbe_id,
           qc.name AS catname, qc.parent AS catparent, qc.info AS catinfo
      FROM {question} q
      JOIN {question_versions} qv ON qv.questionid = q.id
      JOIN {question_bank_entries} qbe ON qbe.id = qv.questionbankentryid
      JOIN {question_categories} qc ON qc.id = qbe.questioncategoryid
     WHERE q.id = :qid
     LIMIT 1
", ['qid' => $qid], MUST_EXIST);

// Try to resolve Level/Subject from our durable metadata.
$meta = $DB->get_record_sql("
    SELECT iqm.levelid, iqm.subjectid, iqm.review_status, iqm.reported,
           lvl.name AS levelname, subj.name AS subjectname
      FROM {istikama_question_meta} iqm
 LEFT JOIN {course_categories} lvl ON lvl.id = iqm.levelid
 LEFT JOIN {istikama_subject_names} subj ON subj.id = iqm.subjectid
     WHERE iqm.qbe_id = :qbe
", ['qbe' => (int)$q->qbe_id]);

$levelname = $meta && !empty($meta->levelname) ? $meta->levelname : '';
$subjectname = $meta && !empty($meta->subjectname) ? $meta->subjectname : format_string($q->catname);
$review_status = $meta && !empty($meta->review_status) ? $meta->review_status : 'approved';

// Page setup.
$baseurl = new moodle_url('/local/istikama_admin/preview_question.php', ['id' => $qid]);
$returnurl = new moodle_url('/local/istikama_admin/activities.php', ['tab' => 'questions']);

$PAGE->set_url($baseurl);
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('q_preview_prefix','local_istikama_admin').': ' . format_string($q->name));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

require_once('admin_layout.php');

$dir = right_to_left() ? 'rtl' : 'ltr';
$textalign = right_to_left() ? 'right' : 'left';

// Find a usable cmid (we use the gateway quiz so the question engine has a real context).
$qbcourse = $DB->get_record('course', ['shortname' => 'ISTIKAMA_QBANK']);
$cmid = 0;
if ($qbcourse) {
    $gw = $DB->get_record_sql("
        SELECT cm.id
          FROM {course_modules} cm
          JOIN {modules} m ON m.id = cm.module AND m.name = 'quiz'
          JOIN {quiz} qz ON qz.id = cm.instance AND qz.name = 'Question Bank Gateway'
         WHERE cm.course = :cid LIMIT 1
    ", ['cid' => $qbcourse->id]);
    if ($gw) { $cmid = (int)$gw->id; }
}

// Native Moodle preview URL — we embed it in an iframe.
$preview_params = ['id' => $qid];
if ($cmid) { $preview_params['cmid'] = $cmid; }
$nativepreview = (new moodle_url('/question/bank/previewquestion/preview.php', $preview_params))->out(false);

// Edit URL.
$edit_cmid = $cmid ?: 0;
$editurl = (new moodle_url('/question/bank/editquestion/question.php', [
    'id'        => $qid,
    'cmid'      => $edit_cmid,
    'courseid'  => $qbcourse ? (int)$qbcourse->id : SITEID,
    'returnurl' => '/local/istikama_admin/activities.php?tab=questions',
]))->out(false);

$qtype_icons = [
    'multichoice'=>'fa-list-ul','truefalse'=>'fa-check-double','shortanswer'=>'fa-keyboard',
    'essay'=>'fa-paragraph','numerical'=>'fa-calculator','match'=>'fa-exchange-alt',
    'description'=>'fa-align-left','multianswer'=>'fa-layer-group','random'=>'fa-random',
    'gapselect'=>'fa-mouse-pointer','ddwtos'=>'fa-hand-pointer','ordering'=>'fa-sort',
];
$qtype_colors = [
    'multichoice'=>'#006bff','truefalse'=>'#10b981','shortanswer'=>'#f59e0b',
    'essay'=>'#8b5cf6','numerical'=>'#ec4899','match'=>'#06b6d4',
    'description'=>'#64748b','multianswer'=>'#f97316','random'=>'#94a3b8',
];
$ico = $qtype_icons[$q->qtype] ?? 'fa-question';
$clr = $qtype_colors[$q->qtype] ?? '#64748b';
?>
<div class="container-fluid" dir="<?= $dir ?>" style="text-align:<?= $textalign ?>; background:#f8fafc; min-height:600px; margin:-24px; padding:24px;">

    <!-- Header card -->
    <div class="isti-card" style="padding:20px 24px; margin-bottom:18px; display:flex; align-items:center; gap:16px; flex-wrap:wrap;">
        <a href="<?= $returnurl->out() ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-arrow-left"></i> <?= get_string('q_back','local_istikama_admin') ?>
        </a>
        <span style="display:inline-flex;align-items:center;justify-content:center;width:46px;height:46px;border-radius:12px;background:<?= $clr ?>15;color:<?= $clr ?>;font-size:1.2rem">
            <i class="fa <?= $ico ?>"></i>
        </span>
        <div style="flex:1; min-width:240px">
            <h5 style="margin:0 0 4px 0; font-weight:700; color:#1e293b"><?= format_string($q->name) ?></h5>
            <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap; margin-top:6px">
                <?php if ($levelname): ?>
                <span class="isti-badge" style="background:#eff6ff;color:#006bff"><i class="fa fa-layer-group"></i> <?= s($levelname) ?></span>
                <?php endif; ?>
                <span class="isti-badge isti-badge-primary"><i class="fa fa-book"></i> <?= s($subjectname) ?></span>
                <span class="isti-badge isti-badge-neutral"><?= s($q->qtype) ?></span>
                <?php if ($review_status === 'pending'): ?>
                    <span class="isti-badge isti-badge-warning"><i class="fa fa-clock"></i> Pending Review</span>
                <?php elseif ($review_status === 'rejected'): ?>
                    <span class="isti-badge isti-badge-danger"><i class="fa fa-times"></i> Rejected</span>
                <?php endif; ?>
            </div>
        </div>
        <a href="<?= $editurl ?>" class="isti-btn isti-btn-primary" style="white-space:nowrap">
            <i class="fa fa-edit"></i> <?= get_string('q_edit_question','local_istikama_admin') ?>
        </a>
    </div>

    <!-- Preview frame (Moodle native engine, scoped chrome) -->
    <div class="isti-card" style="padding:0;overflow:hidden">
        <div style="padding:14px 20px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;gap:8px;flex-wrap:wrap">
            <h6 style="margin:0;font-weight:700;color:#1e293b"><i class="fa fa-eye" style="color:#006bff"></i> <?= get_string('q_question_preview','local_istikama_admin') ?></h6>
            <span style="font-size:.78rem;color:#94a3b8">Live interactive preview using Moodle's question engine.</span>
        </div>
        <iframe id="qPreviewFrame"
                src="<?= s($nativepreview) ?>"
                style="width:100%; min-height:640px; border:0; background:#fff; display:block"
                referrerpolicy="same-origin"
                title="Question preview"></iframe>
    </div>
</div>

<script>
(function() {
    var f = document.getElementById('qPreviewFrame');
    if (!f) { return; }
    var returnUrl = <?= json_encode($returnurl->out(false)) ?>;

    function resize() {
        try {
            var doc = f.contentWindow && f.contentWindow.document;
            if (!doc) { return; }
            var h = Math.max(640,
                doc.documentElement.scrollHeight || 0,
                doc.body ? doc.body.scrollHeight : 0
            );
            f.style.height = (h + 24) + 'px';
        } catch (e) { /* cross-origin guard */ }
    }

    /**
     * Intercept the "Close preview" button inside the iframe.
     * Moodle's preview.js does: if (window.opener === null) location.href = url;
     * In an iframe, opener is always null, so it would navigate the iframe
     * to the full question bank page (with the entire app shell).
     * We override the button to navigate the PARENT page instead.
     */
    function interceptCloseButton() {
        try {
            var doc = f.contentWindow && f.contentWindow.document;
            if (!doc) { return; }
            var btn = doc.getElementById('close-previewquestion-page');
            if (btn) {
                // Remove all existing listeners by cloning the node.
                var newBtn = btn.cloneNode(true);
                btn.parentNode.replaceChild(newBtn, btn);
                newBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopImmediatePropagation();
                    // Navigate the PARENT page, not the iframe.
                    window.location.href = returnUrl;
                });
            }
            // Also intercept any <a> fallback close links.
            var links = doc.querySelectorAll('a[role="button"]');
            links.forEach(function(a) {
                if (a.textContent.trim().toLowerCase().indexOf('close') !== -1) {
                    a.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopImmediatePropagation();
                        window.location.href = returnUrl;
                    });
                }
            });
        } catch (e) { /* cross-origin guard */ }
    }

    f.addEventListener('load', function() {
        resize();
        interceptCloseButton();
        // Moodle behaviors change DOM after load (MathJax, dnd init).
        setTimeout(resize, 600);
        setTimeout(resize, 1500);
        // Re-intercept after Moodle AMD modules initialize (they attach listeners late).
        setTimeout(interceptCloseButton, 800);
        setTimeout(interceptCloseButton, 2000);
    });
    window.addEventListener('resize', resize);
})();
</script>

<?php
echo '</div></div>';
echo $OUTPUT->footer();
