<?php
/**
 * Homework viewer + submission page inside our admin chrome.
 *
 * Modern student-facing view of a Moodle mod_assign instance:
 *   - Assignment header with status timeline (Assigned → Submitted → Graded)
 *   - Teacher-uploaded files (clickable, open in IstikamaSubmissionViewer)
 *   - Student's own submission (clickable files + online text)
 *   - Submit / Edit submission CTA → Moodle's native form (for the upload step
 *     itself only — the rest of the experience stays in our chrome)
 *   - Grade + teacher feedback panel
 *
 * Uses Moodle's native mod_assign API for all data/permissions/grading logic.
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/mod/assign/locallib.php');
require_once(__DIR__ . '/locallib.php');

require_login();

$cmid = required_param('id', PARAM_INT);

global $DB, $PAGE, $OUTPUT, $USER, $CFG;

$cm     = get_coursemodule_from_id('assign', $cmid, 0, false, MUST_EXIST);
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$ctx    = context_module::instance($cmid);

$PAGE->set_url(new moodle_url('/local/istikama_admin/view_homework.php', ['id' => $cmid]));
$PAGE->set_context($ctx);
$PAGE->set_course($course);
$PAGE->set_pagelayout('base');

$assign_rec = $DB->get_record('assign', ['id' => $cm->instance], '*', MUST_EXIST);
$PAGE->set_title(get_string('homework_view_title', 'local_istikama_admin') . ': ' . format_string($assign_rec->name));
// Suppress Moodle's auto-rendered activity header + duplicate page heading —
// our card-style header inside the page already covers all the metadata.
$PAGE->activityheader->disable();
$PAGE->set_heading('');
$PAGE->set_secondary_navigation(false);
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');
$PAGE->requires->js(new moodle_url('/local/istikama_admin/js/submission_viewer.js'));

$canmanage  = has_capability('mod/assign:grade', $ctx);
$cansubmit  = has_capability('mod/assign:submit', $ctx);
$dir        = right_to_left() ? 'rtl' : 'ltr';
$textalign  = right_to_left() ? 'right' : 'left';
$returnurl  = new moodle_url('/course/view.php', ['id' => $course->id]);

$fs = get_file_storage();
$introfiles = $fs->get_area_files($ctx->id, 'mod_assign', 'introattachment', 0, 'filename', false);

$submission = null;
$submissionfiles = [];
$submissiontext = '';
if ($cansubmit && !$canmanage) {
    $submission = $DB->get_record('assign_submission', [
        'assignment' => $assign_rec->id,
        'userid'     => $USER->id,
        'latest'     => 1,
    ]);
    if ($submission) {
        $subfiles = $fs->get_area_files($ctx->id, 'assignsubmission_file', 'submission_files', $submission->id, 'filename', false);
        $submissionfiles = $subfiles ?: [];
        $onlinetext = $DB->get_record('assignsubmission_onlinetext', ['assignment' => $assign_rec->id, 'submission' => $submission->id]);
        if ($onlinetext) {
            $submissiontext = $onlinetext->onlinetext;
        }
    }
}

$grade = null;
$feedbacktext = '';
if ($submission) {
    $grade = $DB->get_record('assign_grades', [
        'assignment' => $assign_rec->id,
        'userid'     => $USER->id,
    ], '*', IGNORE_MULTIPLE);
    if ($grade) {
        $fb = $DB->get_record('assignfeedback_comments', [
            'assignment' => $assign_rec->id,
            'grade'      => $grade->id,
        ], '*', IGNORE_MULTIPLE);
        if ($fb) { $feedbacktext = $fb->commenttext; }
    }
}

// Build the file list for client-side IstikamaSubmissionViewer.open().
// We emit a single JSON blob per file group so the JS picks them up cleanly.
$introfilesjs = [];
foreach ($introfiles as $f) {
    $name = $f->get_filename();
    $introfilesjs[] = [
        'name' => $name,
        'url'  => moodle_url::make_pluginfile_url($ctx->id, 'mod_assign', 'introattachment', 0, '/', $name)->out(false),
        'ext'  => strtolower(pathinfo($name, PATHINFO_EXTENSION)),
        'size' => display_size($f->get_filesize()),
    ];
}
$submissionfilesjs = [];
foreach ($submissionfiles as $f) {
    $name = $f->get_filename();
    $submissionfilesjs[] = [
        'name'     => $name,
        'url'      => moodle_url::make_pluginfile_url($ctx->id, 'assignsubmission_file', 'submission_files', $submission->id, '/', $name)->out(false),
        'ext'      => strtolower(pathinfo($name, PATHINFO_EXTENSION)),
        'size'     => display_size($f->get_filesize()),
        'uploaded' => userdate($f->get_timemodified() ?: $submission->timemodified, get_string('strftimedatetimeshort', 'langconfig')),
    ];
}

// Timeline state.
$timeline = [
    'assigned'  => ['icon' => 'fa-flag',          'label' => get_string('homework_tl_assigned',  'local_istikama_admin'), 'state' => 'done'],
    'due'       => ['icon' => 'fa-calendar-day',  'label' => get_string('homework_tl_due',       'local_istikama_admin'), 'state' => 'current'],
    'submitted' => ['icon' => 'fa-paper-plane',   'label' => get_string('homework_tl_submitted', 'local_istikama_admin'), 'state' => 'pending'],
    'graded'    => ['icon' => 'fa-check-double',  'label' => get_string('homework_tl_graded',    'local_istikama_admin'), 'state' => 'pending'],
];
if ($submission) {
    $timeline['submitted']['state'] = 'done';
    $timeline['submitted']['label'] .= ' · ' . userdate($submission->timemodified, get_string('strftimedatetimeshort', 'langconfig'));
}
if ($assign_rec->duedate) {
    $timeline['due']['label'] .= ' · ' . userdate($assign_rec->duedate, get_string('strftimedatetimeshort', 'langconfig'));
    $islate = ($submission && $submission->timemodified > $assign_rec->duedate);
    $isoverdue = (!$submission && $assign_rec->duedate < time());
    if ($islate)    { $timeline['submitted']['state'] = 'danger'; $timeline['submitted']['label'] .= ' · ' . get_string('homework_late', 'local_istikama_admin'); }
    if ($isoverdue) { $timeline['due']['state'] = 'danger'; }
}
if ($grade && $grade->grade >= 0) {
    $timeline['graded']['state'] = 'done';
    $timeline['graded']['label'] .= ' · ' . rtrim(rtrim(number_format((float)$grade->grade, 1), '0'), '.') . '/' . (int)$assign_rec->grade;
}

$isti_hide_page_header = true;
$isti_no_card_wrapper  = true;
require_once('admin_layout.php');
?>
<div class="container-fluid" dir="<?= $dir ?>" style="text-align:<?= $textalign ?>; background:#fff; min-height:600px; padding:24px;">

    <!-- Header card -->
    <div class="isti-card" style="padding:22px 26px; margin-bottom:18px;">
        <div style="display:flex; align-items:flex-start; gap:16px; flex-wrap:wrap;">
            <a href="<?= $returnurl->out() ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
                <i class="fa fa-arrow-left"></i> <?= get_string('back_to_lesson', 'local_istikama_admin') ?>
            </a>
            <span style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:12px;background:#faf5ff;color:#8b5cf6;font-size:1.3rem;flex-shrink:0">
                <i class="fa fa-file-upload"></i>
            </span>
            <div style="flex:1; min-width:240px">
                <h5 style="margin:0; font-weight:700; color:#0f172a; font-size:1.15rem"><?= format_string($assign_rec->name) ?></h5>
                <div style="margin-top:6px; color:#64748b; font-size:.85rem;">
                    <i class="fa fa-folder" style="color:#94a3b8"></i> <?= format_string($course->fullname) ?>
                </div>
            </div>
            <?php if ($canmanage): ?>
            <a href="<?= (new moodle_url('/local/istikama_admin/grade_homework.php', ['id' => $cmid]))->out(false) ?>" class="isti-btn isti-btn-primary" style="white-space:nowrap">
                <i class="fa fa-check-double"></i> <?= get_string('homework_grade_btn', 'local_istikama_admin') ?>
            </a>
            <a href="<?= (new moodle_url('/course/modedit.php', ['update' => $cmid, 'return' => 1]))->out(false) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
                <i class="fa fa-cog"></i> <?= get_string('homework_settings_btn', 'local_istikama_admin') ?>
            </a>
            <?php endif; ?>
        </div>

        <!-- Timeline -->
        <div class="isti-hw-timeline">
            <?php foreach ($timeline as $key => $step):
                $class = 'isti-hw-timeline-step';
                if ($step['state'] === 'done')    { $class .= ' done'; }
                if ($step['state'] === 'current') { $class .= ' current'; }
                if ($step['state'] === 'danger')  { $class .= ' danger'; }
            ?>
            <div class="<?= $class ?>"><i class="fa <?= $step['icon'] ?>"></i> <?= s($step['label']) ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Instructions -->
    <?php if (!empty($assign_rec->intro)): ?>
    <div class="isti-card" style="padding:20px 24px;margin-bottom:18px;color:#334155;line-height:1.65">
        <h6 style="font-weight:700;color:#0f172a;margin-bottom:10px;font-size:.95rem">
            <i class="fa fa-info-circle" style="color:#006bff"></i> <?= get_string('homework_instructions', 'local_istikama_admin') ?>
        </h6>
        <?= format_text($assign_rec->intro, (int)($assign_rec->introformat ?? FORMAT_HTML), ['context' => $ctx]) ?>
    </div>
    <?php endif; ?>

    <!-- Teacher attachments -->
    <?php if (!empty($introfiles)): ?>
    <div class="isti-card" style="padding:0;overflow:hidden;margin-bottom:18px">
        <div style="padding:16px 22px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between">
            <h6 style="margin:0;font-weight:700;color:#0f172a;font-size:.95rem">
                <i class="fa fa-paperclip" style="color:#8b5cf6"></i> <?= get_string('homework_attached_files', 'local_istikama_admin') ?>
            </h6>
            <span style="font-size:.78rem;color:#64748b"><?= count($introfilesjs) ?> file(s)</span>
        </div>
        <div style="padding:20px;display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:12px">
            <?php foreach ($introfilesjs as $idx => $f):
                $ext = $f['ext']; $kind = 'other';
                if ($ext === 'pdf') $kind = 'pdf';
                elseif (in_array($ext, ['jpg','jpeg','png','gif','svg','bmp','webp'])) $kind = 'image';
                elseif (in_array($ext, ['mp4','webm','ogg','mov'])) $kind = 'video';
                $iconmap = ['pdf'=>['fa-file-pdf','#ef4444'], 'image'=>['fa-image','#06b6d4'], 'video'=>['fa-file-video','#a855f7']];
                if (in_array($ext, ['doc','docx','odt','rtf'])) $iconmap['other'] = ['fa-file-word','#3b82f6'];
                elseif (in_array($ext, ['xls','xlsx','ods'])) $iconmap['other'] = ['fa-file-excel','#10b981'];
                elseif (in_array($ext, ['ppt','pptx','odp'])) $iconmap['other'] = ['fa-file-powerpoint','#f59e0b'];
                else $iconmap['other'] = ['fa-file','#64748b'];
                [$icon, $color] = $iconmap[$kind] ?? $iconmap['other'];
            ?>
            <a class="isti-file-tile" href="#" data-isti-viewer="intro" data-isti-viewer-index="<?= (int)$idx ?>">
                <span class="isti-file-tile-icon" style="background:<?= $color ?>1a;color:<?= $color ?>"><i class="fa <?= $icon ?>"></i></span>
                <div class="isti-file-tile-body">
                    <div class="isti-file-tile-name"><?= s($f['name']) ?></div>
                    <div class="isti-file-tile-meta"><?= s($f['size']) ?> · <?= strtoupper($ext) ?></div>
                </div>
                <span class="isti-file-tile-cta"><i class="fa fa-eye"></i></span>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <!-- Student submission -->
    <?php if ($cansubmit && !$canmanage): ?>
    <div class="isti-card" style="padding:0;overflow:hidden;margin-bottom:18px">
        <div style="padding:16px 22px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px">
            <h6 style="margin:0;font-weight:700;color:#0f172a;font-size:.95rem">
                <i class="fa fa-paper-plane" style="color:#10b981"></i> <?= get_string('homework_your_submission', 'local_istikama_admin') ?>
            </h6>
            <a href="<?= (new moodle_url('/mod/assign/view.php', ['id' => $cmid, 'action' => 'editsubmission']))->out(false) ?>" class="isti-btn isti-btn-primary" style="background:#10b981;border-color:#10b981">
                <i class="fa fa-<?= $submission ? 'edit' : 'paper-plane' ?>"></i>
                <?= $submission ? get_string('homework_edit_submission', 'local_istikama_admin') : get_string('homework_submit_now', 'local_istikama_admin') ?>
            </a>
        </div>
        <div style="padding:22px">
            <?php if ($grade && $grade->grade >= 0): ?>
            <div style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);border:1.5px solid #bbf7d0;border-radius:14px;padding:18px 22px;margin-bottom:18px;display:flex;align-items:center;gap:16px;flex-wrap:wrap">
                <span style="display:inline-flex;align-items:center;justify-content:center;width:56px;height:56px;border-radius:14px;background:#10b981;color:#fff;font-size:1.3rem;font-weight:800;flex-shrink:0">
                    <?= rtrim(rtrim(number_format((float)$grade->grade, 1), '0'), '.') ?>
                </span>
                <div style="flex:1;min-width:200px">
                    <strong style="color:#166534;font-size:1.05rem;display:block"><?= get_string('homework_graded', 'local_istikama_admin') ?></strong>
                    <div style="font-size:.82rem;color:#15803d;margin-top:2px"><?= get_string('homework_grade_out_of', 'local_istikama_admin', (int)$assign_rec->grade) ?></div>
                </div>
                <?php if ($feedbacktext): ?>
                <div style="flex:1 1 100%;background:#fff;border:1px solid #d1fae5;border-radius:10px;padding:12px 14px;color:#0f172a;font-size:.88rem;line-height:1.55">
                    <strong style="color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;display:block;margin-bottom:6px">Teacher feedback</strong>
                    <?= format_text($feedbacktext, FORMAT_HTML, ['context' => $ctx]) ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if (empty($submissionfilesjs) && empty($submissiontext)): ?>
            <div style="background:#f8fafc;border:1.5px dashed #cbd5e1;border-radius:12px;padding:32px;text-align:center;color:#64748b">
                <i class="fa fa-cloud-upload-alt" style="font-size:2.2rem;color:#cbd5e1;display:block;margin-bottom:10px"></i>
                <strong style="color:#475569;display:block;margin-bottom:4px">No submission yet</strong>
                <span style="font-size:.86rem;color:#94a3b8">Click "Submit now" to upload your work.</span>
            </div>
            <?php endif; ?>

            <?php if (!empty($submissionfilesjs)): ?>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:12px;margin-top:4px">
                <?php foreach ($submissionfilesjs as $idx => $f):
                    $ext = $f['ext'];
                    if ($ext === 'pdf') { $icon = 'fa-file-pdf'; $color = '#ef4444'; }
                    elseif (in_array($ext, ['jpg','jpeg','png','gif','svg','bmp','webp'])) { $icon = 'fa-image'; $color = '#06b6d4'; }
                    elseif (in_array($ext, ['doc','docx','odt'])) { $icon = 'fa-file-word'; $color = '#3b82f6'; }
                    elseif (in_array($ext, ['xls','xlsx','ods'])) { $icon = 'fa-file-excel'; $color = '#10b981'; }
                    elseif (in_array($ext, ['ppt','pptx','odp'])) { $icon = 'fa-file-powerpoint'; $color = '#f59e0b'; }
                    else { $icon = 'fa-file'; $color = '#64748b'; }
                ?>
                <a class="isti-file-tile" href="#" data-isti-viewer="submission" data-isti-viewer-index="<?= (int)$idx ?>">
                    <span class="isti-file-tile-icon" style="background:<?= $color ?>1a;color:<?= $color ?>"><i class="fa <?= $icon ?>"></i></span>
                    <div class="isti-file-tile-body">
                        <div class="isti-file-tile-name"><?= s($f['name']) ?></div>
                        <div class="isti-file-tile-meta"><?= s($f['size']) ?> · <?= strtoupper($ext) ?></div>
                    </div>
                    <span class="isti-file-tile-cta"><i class="fa fa-eye"></i></span>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

            <?php if ($submissiontext): ?>
            <div style="margin-top:18px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px 18px">
                <h6 style="font-weight:600;color:#475569;font-size:.82rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:10px">
                    <i class="fa fa-align-left" style="color:#8b5cf6"></i> Your online text
                </h6>
                <div style="color:#1e293b;font-size:.93rem;line-height:1.65">
                    <?= format_text($submissiontext, FORMAT_HTML, ['context' => $ctx]) ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

</div>

<script>
(function() {
    var INTRO = <?= json_encode($introfilesjs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
    var SUBM  = <?= json_encode($submissionfilesjs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;

    function bind() {
        if (!window.IstikamaSubmissionViewer) {
            // viewer JS hasn't loaded yet — retry shortly
            setTimeout(bind, 80);
            return;
        }
        document.querySelectorAll('[data-isti-viewer]').forEach(function(el) {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                var group = el.getAttribute('data-isti-viewer');
                var idx   = parseInt(el.getAttribute('data-isti-viewer-index'), 10) || 0;
                var files = group === 'intro' ? INTRO : SUBM;
                if (!files || !files.length) return;
                IstikamaSubmissionViewer.open(files, { startIndex: idx });
            });
        });
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bind);
    } else {
        bind();
    }
})();
</script>

<?php
echo '</div>'; // close .container-fluid
echo '</div>'; // close .istikama-dashboard-container (from admin_layout.php)
echo $OUTPUT->footer();
