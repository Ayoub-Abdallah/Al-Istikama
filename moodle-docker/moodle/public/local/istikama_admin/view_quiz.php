<?php
/**
 * Native-rendered quiz overview inside our admin chrome.
 *
 * Replaces the previous iframe approach (which broke because Moodle's quiz view
 * embeds the full app shell that can't be reliably CSS-stripped). Instead we
 * read quiz_slots → question_references → question_bank_entries → question
 * directly and render the quiz overview ourselves, then expose buttons to:
 *   - Edit Questions  → our edit_quiz.php (native slot editor)
 *   - Attempt Quiz    → native /mod/quiz/view.php (only when launching an attempt)
 *   - Settings        → native /course/modedit.php
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_target_user();

$cmid = required_param('id', PARAM_INT);

global $DB, $PAGE, $OUTPUT, $USER;

$cm = get_coursemodule_from_id('quiz', $cmid, 0, false, MUST_EXIST);
$quiz = $DB->get_record('quiz', ['id' => $cm->instance], '*', MUST_EXIST);
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$ctx = context_module::instance($cmid);

// Reusable-quiz metadata.
$meta = $DB->get_record('istikama_quiz_meta', ['quizid' => (int)$quiz->id]);
$qmeta_levelname = '';
$qmeta_subjectname = '';
if ($meta) {
    if (!empty($meta->levelid)) {
        $lv = $DB->get_record('course_categories', ['id' => $meta->levelid], 'name');
        if ($lv) { $qmeta_levelname = $lv->name; }
    }
    if (!empty($meta->subjectid)) {
        $sub = $DB->get_record('istikama_subject_names', ['id' => $meta->subjectid], 'name');
        if ($sub) { $qmeta_subjectname = $sub->name; }
    }
}

$baseurl  = new moodle_url('/local/istikama_admin/view_quiz.php', ['id' => $cmid]);
$returnurl = new moodle_url('/local/istikama_admin/activities.php', ['tab' => 'quizzes']);
$editurl  = (new moodle_url('/local/istikama_admin/edit_quiz.php', ['cmid' => $cmid]))->out(false);
$attempturl = (new moodle_url('/mod/quiz/view.php', ['id' => $cmid]))->out(false);
$settingsurl = (new moodle_url('/course/modedit.php', ['update' => $cmid, 'return' => 1]))->out(false);

$PAGE->set_url($baseurl);
$PAGE->set_context($ctx);
$PAGE->set_course($course);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('q_quiz_prefix','local_istikama_admin').': ' . format_string($quiz->name));
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
           qv.status AS qstatus,
           q.name   AS qname,
           q.qtype  AS qtype,
           q.questiontext AS qtext,
           q.questiontextformat AS qtextformat,
           q.defaultmark,
           q.timecreated AS qcreated
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

$slotcount    = count($slots);
$attemptcount = (int)$DB->count_records('quiz_attempts', ['quiz' => $quiz->id, 'preview' => 0]);
$canmanage    = has_capability('mod/quiz:manage', $ctx);
$canattempt   = has_capability('mod/quiz:attempt', $ctx);

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

// Aggregate marks shown to the student.
$total_mark = 0.0;
foreach ($slots as $s) { $total_mark += (float)$s->maxmark; }
?>
<div class="container-fluid" dir="<?= $dir ?>" style="text-align:<?= $textalign ?>; background:#f8fafc; min-height:600px; margin:-24px; padding:24px;">

    <!-- Header card -->
    <div class="isti-card" style="padding:20px 24px; margin-bottom:18px; display:flex; align-items:center; gap:16px; flex-wrap:wrap;">
        <a href="<?= $returnurl->out() ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-arrow-left"></i> <?= get_string('q_back','local_istikama_admin') ?>
        </a>
        <span style="display:inline-flex;align-items:center;justify-content:center;width:46px;height:46px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.2rem">
            <i class="fa fa-question-circle"></i>
        </span>
        <div style="flex:1; min-width:240px">
            <h5 style="margin:0 0 4px 0; font-weight:700; color:#1e293b"><?= format_string($quiz->name) ?></h5>
            <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap; margin-top:6px">
                <?php if ($qmeta_levelname): ?>
                <span class="isti-badge" style="background:#eff6ff;color:#006bff"><i class="fa fa-layer-group"></i> <?= s($qmeta_levelname) ?></span>
                <?php endif; ?>
                <?php if ($qmeta_subjectname): ?>
                <span class="isti-badge isti-badge-primary"><i class="fa fa-book"></i> <?= s($qmeta_subjectname) ?></span>
                <?php endif; ?>
                <span class="isti-badge isti-badge-neutral"><i class="fa fa-list-ol"></i> <?= $slotcount ?> question<?= $slotcount === 1 ? '' : 's' ?></span>
                <span class="isti-badge isti-badge-neutral"><i class="fa fa-star"></i> <?= rtrim(rtrim(number_format($total_mark, 2), '0'), '.') ?: '0' ?> marks</span>
                <span class="isti-badge isti-badge-neutral"><i class="fa fa-users"></i> <?= $attemptcount ?> attempts</span>
                <span class="isti-badge isti-badge-neutral"><i class="fa fa-folder"></i> <?= format_string($course->fullname) ?></span>
            </div>
        </div>
        <?php if ($canmanage): ?>
        <a href="<?= $editurl ?>" class="isti-btn isti-btn-primary" style="white-space:nowrap">
            <i class="fa fa-edit"></i> <?= get_string('vq_edit_questions','local_istikama_admin') ?>
        </a>
        <a href="<?= $settingsurl ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-cog"></i> Settings
        </a>
        <?php endif; ?>
        <?php if ($canattempt && $slotcount > 0): ?>
        <a href="<?= $attempturl ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap" target="_blank" rel="noopener">
            <i class="fa fa-play"></i> Attempt
        </a>
        <?php endif; ?>
    </div>

    <?php if (!empty($quiz->intro)): ?>
    <div class="isti-card" style="padding:18px 22px;margin-bottom:18px;color:#334155">
        <?= format_text($quiz->intro, (int)($quiz->introformat ?? FORMAT_HTML), ['context' => $ctx]) ?>
    </div>
    <?php endif; ?>

    <!-- Questions list -->
    <div class="isti-card" style="padding:0;overflow:hidden">
        <div style="padding:14px 20px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;gap:8px;flex-wrap:wrap">
            <h6 style="margin:0;font-weight:700;color:#1e293b"><i class="fa fa-list-ol" style="color:#006bff"></i> Questions in this Quiz</h6>
            <span style="font-size:.78rem;color:#94a3b8"><?= get_string('vq_readonly','local_istikama_admin') ?></span>
        </div>

        <?php if ($slotcount === 0): ?>
            <div style="padding:48px 20px;text-align:center;color:#94a3b8">
                <i class="fa fa-inbox" style="font-size:2.5rem;display:block;margin-bottom:12px;color:#cbd5e1"></i>
                <p style="margin:0;font-size:1rem;color:#475569;font-weight:500"><?= get_string('q_no_questions','local_istikama_admin') ?></p>
                <?php if ($canmanage): ?>
                <p style="margin:8px 0 0 0;font-size:.88rem">
                    <a href="<?= $editurl ?>" class="isti-btn isti-btn-primary" style="margin-top:8px"><i class="fa fa-plus"></i> Add Questions</a>
                </p>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="isti-table" style="margin:0">
                    <thead><tr>
                        <th style="width:64px">#</th>
                        <th style="width:54px"></th>
                        <th><?= get_string('act_col_question','local_istikama_admin') ?></th>
                        <th><?= get_string('act_col_type','local_istikama_admin') ?></th>
                        <th style="text-align:right;width:120px"><?= get_string('q_col_marks','local_istikama_admin') ?></th>
                        <th style="text-align:center;width:120px"><?= get_string('q_col_page','local_istikama_admin') ?></th>
                    </tr></thead>
                    <tbody>
                        <?php foreach ($slots as $s):
                            $qtype = $s->qtype ?: 'unknown';
                            $ico = $qtype_icons[$qtype] ?? 'fa-question';
                            $clr = $qtype_colors[$qtype] ?? '#64748b';
                            $qname = $s->qname ?: '— question missing —';
                            $plain = trim(html_to_text(format_text($s->qtext ?? '', (int)($s->qtextformat ?? FORMAT_HTML), ['context' => $ctx, 'noclean' => true])));
                            if (mb_strlen($plain) > 140) { $plain = mb_substr($plain, 0, 140) . '…'; }
                        ?>
                        <tr>
                            <td><strong style="color:#1e293b"><?= (int)$s->slot ?></strong></td>
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
                            <td style="text-align:right;font-weight:600;color:#1e293b"><?= rtrim(rtrim(number_format((float)$s->maxmark, 2), '0'), '.') ?: '0' ?></td>
                            <td style="text-align:center"><span class="isti-badge isti-badge-neutral"><?= (int)$s->page ?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

</div>
<?php
echo '</div></div>';
echo $OUTPUT->footer();
