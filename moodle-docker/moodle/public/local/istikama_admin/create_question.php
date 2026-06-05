<?php
/**
 * Wrapper that:
 *   1) Validates Level + Subject (provided by the modal on activities.php).
 *   2) Resolves the matching question category inside the central ISTIKAMA_QBANK course
 *      (creates Level and Subject question categories on the fly if missing).
 *   3) Renders a MODERN full-width grid of every Moodle question type.
 *
 * Selecting a type submits a real form to /question/bank/editquestion/question.php?qtype=...
 * with the resolved category + cmid + returnurl, so question creation continues inside
 * Moodle's REAL question engine. After save, the user is returned to activities.php.
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');
require_once($CFG->dirroot . '/question/editlib.php');
require_once($CFG->libdir . '/questionlib.php');

require_login();
require_sesskey();
local_istikama_admin_require_target_user();

$levelid   = required_param('levelid', PARAM_INT);
$subjectid = required_param('subjectid', PARAM_INT);
// Optional: when the request originated from edit_quiz.php (Add New Question).
$quizid    = optional_param('quizid', 0, PARAM_INT);
$quizcmid  = optional_param('quizcmid', 0, PARAM_INT);

global $DB, $USER, $PAGE, $OUTPUT, $CFG;

// ─────────────────────────────────────────────────────────────────────────────
// Resolve the central QB course + gateway quiz (we need a cmid for question.php).
// ─────────────────────────────────────────────────────────────────────────────
$qbcourse = $DB->get_record('course', ['shortname' => 'ISTIKAMA_QBANK']);
if (!$qbcourse) {
    throw new moodle_exception('errornoqbcourse', 'error', new moodle_url('/local/istikama_admin/activities.php'),
        null, 'Central Question Bank course (ISTIKAMA_QBANK) not found. Run setup_questionbank.php.');
}
$qbcoursectx = context_course::instance($qbcourse->id);

$gw = $DB->get_record_sql("
    SELECT cm.id AS cmid
      FROM {course_modules} cm
      JOIN {modules} m ON m.id = cm.module AND m.name = 'quiz'
      JOIN {quiz} qz ON qz.id = cm.instance AND qz.name = 'Question Bank Gateway'
     WHERE cm.course = :cid
     LIMIT 1
", ['cid' => $qbcourse->id]);
if (!$gw) {
    throw new moodle_exception('errornogateway', 'error', new moodle_url('/local/istikama_admin/activities.php'),
        null, 'Gateway quiz missing. Run create_qb_gateway.php.');
}
$gateway_cmid = (int)$gw->cmid;

// ─────────────────────────────────────────────────────────────────────────────
// Validate the level and subject.
// ─────────────────────────────────────────────────────────────────────────────
// The modal's Level dropdown supplies an istikama_global_level.id (the canonical
// level catalog), NOT a course_categories id — match that here.
$level = $DB->get_record('istikama_global_level', ['id' => $levelid], '*', MUST_EXIST);
$subject = $DB->get_record('istikama_subject_names', ['id' => $subjectid, 'level_id' => $levelid], '*', MUST_EXIST);

// ─────────────────────────────────────────────────────────────────────────────
// Ensure question categories exist:  top → <Level> → <Subject>.
// ─────────────────────────────────────────────────────────────────────────────
$topcat = $DB->get_record('question_categories', [
    'contextid' => $qbcoursectx->id,
    'parent'    => 0,
]);
if (!$topcat) {
    $topcat = (object)[
        'name'        => 'top',
        'info'        => '',
        'infoformat'  => FORMAT_MOODLE,
        'contextid'   => $qbcoursectx->id,
        'parent'      => 0,
        'sortorder'   => 0,
        'stamp'       => make_unique_id_code(),
    ];
    $topcat->id = $DB->insert_record('question_categories', $topcat);
}

$levelcat = $DB->get_record('question_categories', [
    'contextid' => $qbcoursectx->id,
    'parent'    => $topcat->id,
    'name'      => $level->name,
]);
if (!$levelcat) {
    $levelcat = (object)[
        'name'       => $level->name,
        'info'       => "Questions for level: {$level->name} (LevelID: {$level->id})",
        'infoformat' => FORMAT_MOODLE,
        'contextid'  => $qbcoursectx->id,
        'parent'     => $topcat->id,
        'sortorder'  => 999,
        'stamp'      => make_unique_id_code(),
    ];
    $levelcat->id = $DB->insert_record('question_categories', $levelcat);
}

$subjectcat = $DB->get_record('question_categories', [
    'contextid' => $qbcoursectx->id,
    'parent'    => $levelcat->id,
    'name'      => $subject->name,
]);
if (!$subjectcat) {
    $subjectcat = (object)[
        'name'       => $subject->name,
        'info'       => "Subject: {$subject->name} | Level: {$level->name} | LevelID: {$level->id} | SubjectID: {$subject->id}",
        'infoformat' => FORMAT_MOODLE,
        'contextid'  => $qbcoursectx->id,
        'parent'     => $levelcat->id,
        'sortorder'  => 999,
        'stamp'      => make_unique_id_code(),
    ];
    $subjectcat->id = $DB->insert_record('question_categories', $subjectcat);
}
$categoryid = (int)$subjectcat->id;

// ─────────────────────────────────────────────────────────────────────────────
// Permission check using Moodle's real capability.
// ─────────────────────────────────────────────────────────────────────────────
require_capability('moodle/question:add', $qbcoursectx);

// ─────────────────────────────────────────────────────────────────────────────
// Build the list of creatable question types from Moodle's REAL registry.
// ─────────────────────────────────────────────────────────────────────────────
\core_question\local\bank\helper::require_plugin_enabled('qbank_editquestion');
$realqtypes = [];
$fakeqtypes = [];
foreach (question_bank::get_creatable_qtypes() as $qtypename => $qtype) {
    $entry = [
        'name'    => $qtypename,
        'label'   => $qtype->menu_name(),
        'help'    => '', // We can't reliably extract qtype help string. We'll provide our own short summaries below.
    ];
    if ($qtype->is_real_question_type()) {
        $realqtypes[] = $entry;
    } else {
        $fakeqtypes[] = $entry;
    }
}

// Human-friendly short summaries and icon mapping for the modern card grid.
$qtype_meta = [
    'multichoice'      => ['icon' => 'fa-list-ul',         'color' => '#006bff', 'desc' => get_string('qtd_multichoice','local_istikama_admin')],
    'truefalse'        => ['icon' => 'fa-check-double',    'color' => '#10b981', 'desc' => get_string('qtd_truefalse','local_istikama_admin')],
    'shortanswer'      => ['icon' => 'fa-keyboard',        'color' => '#f59e0b', 'desc' => get_string('qtd_shortanswer','local_istikama_admin')],
    'essay'            => ['icon' => 'fa-paragraph',       'color' => '#8b5cf6', 'desc' => get_string('qtd_essay','local_istikama_admin')],
    'numerical'        => ['icon' => 'fa-calculator',      'color' => '#ec4899', 'desc' => get_string('qtd_numerical','local_istikama_admin')],
    'match'            => ['icon' => 'fa-exchange-alt',    'color' => '#06b6d4', 'desc' => get_string('qtd_match','local_istikama_admin')],
    'description'      => ['icon' => 'fa-align-left',      'color' => '#64748b', 'desc' => get_string('qtd_description','local_istikama_admin')],
    'multianswer'      => ['icon' => 'fa-layer-group',     'color' => '#f97316', 'desc' => get_string('qtd_multianswer','local_istikama_admin')],
    'random'           => ['icon' => 'fa-random',          'color' => '#94a3b8', 'desc' => get_string('qtd_random','local_istikama_admin')],
    'gapselect'        => ['icon' => 'fa-mouse-pointer',   'color' => '#0ea5e9', 'desc' => get_string('qtd_gapselect','local_istikama_admin')],
    'ddwtos'           => ['icon' => 'fa-hand-pointer',    'color' => '#14b8a6', 'desc' => get_string('qtd_ddwtos','local_istikama_admin')],
    'ordering'         => ['icon' => 'fa-sort',            'color' => '#a855f7', 'desc' => get_string('qtd_ordering','local_istikama_admin')],
    'calculated'       => ['icon' => 'fa-square-root-alt', 'color' => '#0891b2', 'desc' => get_string('qtd_calculated','local_istikama_admin')],
    'calculatedmulti'  => ['icon' => 'fa-square-root-alt', 'color' => '#0e7490', 'desc' => get_string('qtd_calculatedmulti','local_istikama_admin')],
    'calculatedsimple' => ['icon' => 'fa-square-root-alt', 'color' => '#155e75', 'desc' => get_string('qtd_calculatedsimple','local_istikama_admin')],
    'ddimageortext'    => ['icon' => 'fa-image',           'color' => '#db2777', 'desc' => get_string('qtd_ddimageortext','local_istikama_admin')],
    'ddmarker'         => ['icon' => 'fa-map-marker-alt',  'color' => '#e11d48', 'desc' => get_string('qtd_ddmarker','local_istikama_admin')],
    'randomsamatch'    => ['icon' => 'fa-shuffle',         'color' => '#7c3aed', 'desc' => get_string('qtd_randomsamatch','local_istikama_admin')],
];
function isti_qtype_meta(string $name, array $meta): array {
    return $meta[$name] ?? ['icon' => 'fa-question', 'color' => '#475569', 'desc' => get_string('qtd_custom','local_istikama_admin')];
}

// ─────────────────────────────────────────────────────────────────────────────
// Page setup.
// ─────────────────────────────────────────────────────────────────────────────
// The returnurl Moodle redirects to after save — finalize_question.php captures
// the saved question id, persists Level/Subject metadata, and (when quizid
// is set) auto-attaches the saved question to that quiz.
if ($quizcmid) {
    $returnurl_back = new moodle_url('/local/istikama_admin/edit_quiz.php', ['cmid' => $quizcmid]);
} else {
    $returnurl_back = new moodle_url('/local/istikama_admin/activities.php', ['tab' => 'questions']);
}
$returnurl_params = ['levelid' => $levelid, 'subjectid' => $subjectid];
if ($quizid)   { $returnurl_params['quizid']   = $quizid; }
if ($quizcmid) { $returnurl_params['quizcmid'] = $quizcmid; }
$returnurl = new moodle_url('/local/istikama_admin/finalize_question.php', $returnurl_params);

$pageurl_params = ['levelid' => $levelid, 'subjectid' => $subjectid, 'sesskey' => sesskey()];
if ($quizid)   { $pageurl_params['quizid']   = $quizid; }
if ($quizcmid) { $pageurl_params['quizcmid'] = $quizcmid; }
$pageurl = new moodle_url('/local/istikama_admin/create_question.php', $pageurl_params);

$PAGE->set_url($pageurl);
$PAGE->set_context($qbcoursectx);
$PAGE->set_course($qbcourse);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('chooseqtypetoadd', 'question'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

require_once('admin_layout.php');

$dir = right_to_left() ? 'rtl' : 'ltr';
$textalign = right_to_left() ? 'right' : 'left';

// The action URL that question.php receives.
$action_url = new moodle_url('/question/bank/editquestion/question.php');
$action_url_str = $action_url->out(false);
?>

<div class="container-fluid" dir="<?= $dir ?>" style="text-align:<?= $textalign ?>; background:#f8fafc; min-height:500px; margin:-24px; padding:24px;">

    <!-- ─── Header card ─── -->
    <div class="isti-card" style="padding:20px 24px; margin-bottom:20px; display:flex; align-items:center; gap:18px; flex-wrap:wrap;">
        <a href="<?= $returnurl_back->out() ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-arrow-left"></i> <?= get_string('q_back_to_qbank','local_istikama_admin') ?>
        </a>
        <div style="flex:1; min-width:240px">
            <h5 style="margin:0 0 4px 0; font-weight:700; color:#1e293b">
                <i class="fa fa-plus-circle" style="color:#006bff"></i> <?= get_string('act_create_q_title','local_istikama_admin') ?>
                <?php if ($quizid): ?>
                    <span style="font-weight:500;font-size:.85rem;color:#64748b"><?= get_string('q_will_add_to_quiz','local_istikama_admin') ?></span>
                <?php endif; ?>
            </h5>
            <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap; margin-top:8px">
                <span class="isti-badge" style="background:#eff6ff;color:#006bff;font-weight:600;padding:4px 10px;border-radius:999px;font-size:.78rem">
                    <i class="fa fa-layer-group"></i> <?= s($level->name) ?>
                </span>
                <i class="fa fa-chevron-right" style="color:#cbd5e1;font-size:.7rem"></i>
                <span class="isti-badge isti-badge-primary" style="font-weight:600;padding:4px 10px;border-radius:999px;font-size:.78rem">
                    <i class="fa fa-book"></i> <?= s($subject->name) ?>
                </span>
                <?php if ($quizid):
                    $qz = $DB->get_record('quiz', ['id' => $quizid], 'name');
                ?>
                <i class="fa fa-chevron-right" style="color:#cbd5e1;font-size:.7rem"></i>
                <span class="isti-badge isti-badge-warning" style="font-weight:600;padding:4px 10px;border-radius:999px;font-size:.78rem">
                    <i class="fa fa-question-circle"></i> <?= s($qz ? $qz->name : 'Quiz') ?>
                </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- ─── Full-width modern Question-Type grid ─── -->
    <div class="isti-card" style="padding:24px">
        <div style="display:flex;align-items:center;gap:14px;flex-wrap:wrap;margin-bottom:6px">
            <div style="flex:1;min-width:200px">
                <h6 style="margin:0;font-weight:700;color:#1e293b;font-size:1rem">
                    <i class="fa fa-list" style="color:#006bff"></i> <?= get_string('qc_choose_type','local_istikama_admin') ?>
                </h6>
                <p style="margin:6px 0 0 0;font-size:.85rem;color:#64748b">
                    <?= get_string('qc_pick_hint','local_istikama_admin', s($level->name).' · '.s($subject->name)) ?>
                </p>
            </div>
            <input type="text" id="qtypeSearch" class="isti-form-input"
                   placeholder="<?= s(get_string('qc_filter_ph','local_istikama_admin')) ?>" style="max-width:280px;min-width:180px;font-size:.85rem">
        </div>

        <!-- All qtype forms — one per card. The card itself submits to /question/bank/editquestion/question.php. -->
        <?php if (!empty($realqtypes)): ?>
            <div class="isti-qtype-section-title"><?= get_string('qc_section_types','local_istikama_admin') ?></div>
            <div class="isti-qtype-grid" id="qtypeGridReal">
                <?php foreach ($realqtypes as $qt): $m = isti_qtype_meta($qt['name'], $qtype_meta); ?>
                    <form method="get" action="<?= s($action_url_str) ?>" class="isti-qtype-form" data-qtype-name="<?= s(strtolower($qt['name'] . ' ' . $qt['label'])) ?>">
                        <input type="hidden" name="qtype"     value="<?= s($qt['name']) ?>">
                        <input type="hidden" name="category"  value="<?= (int)$categoryid ?>">
                        <input type="hidden" name="cmid"      value="<?= (int)$gateway_cmid ?>">
                        <input type="hidden" name="courseid"  value="<?= (int)$qbcourse->id ?>">
                        <input type="hidden" name="returnurl" value="<?= s($returnurl->out_as_local_url(false)) ?>">
                        <input type="hidden" name="sesskey"   value="<?= sesskey() ?>">
                        <button type="submit" class="isti-qtype-card">
                            <span class="isti-qtype-card-icon" style="background:<?= s($m['color']) ?>15;color:<?= s($m['color']) ?>">
                                <i class="fa <?= s($m['icon']) ?>"></i>
                            </span>
                            <span class="isti-qtype-card-body">
                                <span class="isti-qtype-card-title"><?= s($qt['label']) ?></span>
                                <span class="isti-qtype-card-desc"><?= s($m['desc']) ?></span>
                            </span>
                        </button>
                    </form>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($fakeqtypes)): ?>
            <div class="isti-qtype-section-title"><?= get_string('qc_section_other','local_istikama_admin') ?></div>
            <div class="isti-qtype-grid" id="qtypeGridFake">
                <?php foreach ($fakeqtypes as $qt): $m = isti_qtype_meta($qt['name'], $qtype_meta); ?>
                    <form method="get" action="<?= s($action_url_str) ?>" class="isti-qtype-form" data-qtype-name="<?= s(strtolower($qt['name'] . ' ' . $qt['label'])) ?>">
                        <input type="hidden" name="qtype"     value="<?= s($qt['name']) ?>">
                        <input type="hidden" name="category"  value="<?= (int)$categoryid ?>">
                        <input type="hidden" name="cmid"      value="<?= (int)$gateway_cmid ?>">
                        <input type="hidden" name="courseid"  value="<?= (int)$qbcourse->id ?>">
                        <input type="hidden" name="returnurl" value="<?= s($returnurl->out_as_local_url(false)) ?>">
                        <input type="hidden" name="sesskey"   value="<?= sesskey() ?>">
                        <button type="submit" class="isti-qtype-card">
                            <span class="isti-qtype-card-icon" style="background:<?= s($m['color']) ?>15;color:<?= s($m['color']) ?>">
                                <i class="fa <?= s($m['icon']) ?>"></i>
                            </span>
                            <span class="isti-qtype-card-body">
                                <span class="isti-qtype-card-title"><?= s($qt['label']) ?></span>
                                <span class="isti-qtype-card-desc"><?= s($m['desc']) ?></span>
                            </span>
                        </button>
                    </form>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<script>
(function() {
    var input = document.getElementById('qtypeSearch');
    if (!input) { return; }
    input.addEventListener('input', function() {
        var q = this.value.toLowerCase().trim();
        document.querySelectorAll('.isti-qtype-form').forEach(function(card) {
            var blob = card.getAttribute('data-qtype-name') || '';
            card.style.display = (q === '' || blob.indexOf(q) !== -1) ? '' : 'none';
        });
    });
})();
</script>

<?php
echo '</div></div>';
echo $OUTPUT->footer();
