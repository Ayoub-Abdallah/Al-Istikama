<?php
/**
 * Teacher / admin grading workspace for a mod_assign instance.
 *
 * Split-view layout (3 columns):
 *   ┌──────────────┬──────────────────────────┬──────────────┐
 *   │ Student list │ Submission file grid +   │ Grade panel  │
 *   │ (filterable) │ in-page viewer modal     │ + feedback   │
 *   └──────────────┴──────────────────────────┴──────────────┘
 *
 * Replaces Moodle's native `/mod/assign/view.php?action=grader` for our users.
 * Uses Moodle's `assign` class for grade persistence (assign->update_grade())
 * so the gradebook stays in sync. Feedback is saved via assignfeedback_comments
 * just like Moodle's native flow.
 *
 * GET params:
 *   id      (required) the assign cmid
 *   userid  (optional) the student to focus on (defaults to first w/ submission)
 *
 * POST params (action=save_grade):
 *   userid     int
 *   grade      string (numeric — empty = clear)
 *   feedback   raw HTML
 *   sesskey
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/mod/assign/locallib.php');
require_once(__DIR__ . '/locallib.php');

require_login();

$cmid = required_param('id', PARAM_INT);
$focuseduser = optional_param('userid', 0, PARAM_INT);

global $DB, $PAGE, $OUTPUT, $USER, $CFG;

$cm     = get_coursemodule_from_id('assign', $cmid, 0, false, MUST_EXIST);
$course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
$ctx    = context_module::instance($cmid);

require_capability('mod/assign:grade', $ctx);

$PAGE->set_url(new moodle_url('/local/istikama_admin/grade_homework.php', ['id' => $cmid]));
$PAGE->set_context($ctx);
$PAGE->set_course($course);
$PAGE->set_pagelayout('base');

$assign_rec = $DB->get_record('assign', ['id' => $cm->instance], '*', MUST_EXIST);
$PAGE->set_title(get_string('homework_grading_title', 'local_istikama_admin') . ': ' . format_string($assign_rec->name));
// Suppress Moodle's auto-rendered activity header + duplicate page heading —
// our card-style header inside the page already covers all the metadata.
$PAGE->activityheader->disable();
$PAGE->set_heading('');
$PAGE->set_secondary_navigation(false);
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');
$PAGE->requires->js(new moodle_url('/local/istikama_admin/js/submission_viewer.js'));

// ── POST handler: save grade + feedback ─────────────────────────────────────
if (optional_param('action', '', PARAM_ALPHA) === 'save_grade' && confirm_sesskey()) {
    $targetuser = required_param('userid', PARAM_INT);
    $gradevalue = optional_param('grade', '', PARAM_TEXT);
    $feedbackhtml = optional_param('feedback', '', PARAM_RAW);

    $assign = new assign($ctx, $cm, $course);
    $usergrade = $assign->get_user_grade($targetuser, true);
    $usergrade->grader = (int)$USER->id;

    // Grade: empty string → -1 (no grade).
    $gradeclean = trim($gradevalue);
    if ($gradeclean === '' || !is_numeric($gradeclean)) {
        $usergrade->grade = -1;
    } else {
        $usergrade->grade = (float)$gradeclean;
        if ($assign_rec->grade > 0) {
            // Clamp to [0, max].
            if ($usergrade->grade < 0) $usergrade->grade = 0;
            if ($usergrade->grade > (float)$assign_rec->grade) $usergrade->grade = (float)$assign_rec->grade;
        }
    }
    $assign->update_grade($usergrade);

    // Sanitize plain-text feedback from our textarea into safe HTML so it
    // round-trips correctly with Moodle's native rich-text renderer.
    // (We store FORMAT_HTML for compatibility — strip any incoming tags first.)
    $feedbackclean = trim($feedbackhtml);
    if ($feedbackclean !== '') {
        $feedbackclean = strip_tags($feedbackclean);
        $feedbackclean = nl2br(s($feedbackclean), false);
    }

    // Save the comment via assignfeedback_comments table directly — simpler
    // than running the whole assign_feedback_comments plugin update flow.
    $existing = $DB->get_record('assignfeedback_comments', [
        'assignment' => $assign_rec->id,
        'grade'      => $usergrade->id,
    ]);
    if ($existing) {
        $existing->commenttext = $feedbackclean;
        $existing->commentformat = FORMAT_HTML;
        $DB->update_record('assignfeedback_comments', $existing);
    } else {
        $DB->insert_record('assignfeedback_comments', (object)[
            'assignment'   => $assign_rec->id,
            'grade'        => $usergrade->id,
            'commenttext'  => $feedbackclean,
            'commentformat' => FORMAT_HTML,
        ]);
    }

    \core\notification::success(get_string('homework_save_grade_done', 'local_istikama_admin'));
    redirect(new moodle_url('/local/istikama_admin/grade_homework.php', [
        'id'     => $cmid,
        'userid' => $targetuser,
    ]));
}

// ── Build student roster (everyone enrolled with mod/assign:submit) ─────────
$enrolledusers = get_enrolled_users($ctx, 'mod/assign:submit', 0, 'u.id, u.firstname, u.lastname, u.email, u.picture, u.imagealt, u.firstnamephonetic, u.lastnamephonetic, u.middlename, u.alternatename', 'u.lastname ASC, u.firstname ASC');

// Pull each student's latest submission + grade in two batched queries.
$studentids = array_keys($enrolledusers);
$submissions = [];
$grades = [];
if (!empty($studentids)) {
    [$insql, $inparams] = $DB->get_in_or_equal($studentids, SQL_PARAMS_NAMED, 'uid');
    $inparams['assignment'] = $assign_rec->id;
    $subrows = $DB->get_records_sql(
        "SELECT * FROM {assign_submission}
          WHERE assignment = :assignment AND latest = 1 AND userid $insql",
        $inparams
    );
    foreach ($subrows as $s) {
        $submissions[(int)$s->userid] = $s;
    }
    $graderows = $DB->get_records_sql(
        "SELECT * FROM {assign_grades}
          WHERE assignment = :assignment AND userid $insql
          ORDER BY id DESC",
        $inparams
    );
    foreach ($graderows as $g) {
        if (!isset($grades[(int)$g->userid])) {
            $grades[(int)$g->userid] = $g;
        }
    }
}

// Determine focused user.
if (!$focuseduser) {
    // Auto-focus first student with submitted but ungraded status.
    foreach ($enrolledusers as $u) {
        $sub = $submissions[(int)$u->id] ?? null;
        $gr  = $grades[(int)$u->id] ?? null;
        if ($sub && (!$gr || $gr->grade < 0)) {
            $focuseduser = (int)$u->id;
            break;
        }
    }
    if (!$focuseduser && !empty($enrolledusers)) {
        $focuseduser = (int)array_key_first($enrolledusers);
    }
}

// Load focused user details.
$focuseduserrec  = $focuseduser ? ($enrolledusers[$focuseduser] ?? null) : null;
$focusedsub      = $focuseduser ? ($submissions[$focuseduser] ?? null) : null;
$focusedgrade    = $focuseduser ? ($grades[$focuseduser] ?? null) : null;

$fs = get_file_storage();
$focusedfiles = [];
$focusedtext  = '';
if ($focusedsub) {
    $sfs = $fs->get_area_files($ctx->id, 'assignsubmission_file', 'submission_files', $focusedsub->id, 'filename', false);
    foreach ($sfs as $f) {
        $name = $f->get_filename();
        $focusedfiles[] = [
            'name'     => $name,
            'url'      => moodle_url::make_pluginfile_url($ctx->id, 'assignsubmission_file', 'submission_files', $focusedsub->id, '/', $name)->out(false),
            'ext'      => strtolower(pathinfo($name, PATHINFO_EXTENSION)),
            'size'     => display_size($f->get_filesize()),
            'uploaded' => userdate($f->get_timemodified() ?: $focusedsub->timemodified, get_string('strftimedatetimeshort', 'langconfig')),
        ];
    }
    $ot = $DB->get_record('assignsubmission_onlinetext', ['assignment' => $assign_rec->id, 'submission' => $focusedsub->id]);
    if ($ot) { $focusedtext = $ot->onlinetext; }
}

$focusedfeedback = '';
if ($focusedgrade) {
    $fb = $DB->get_record('assignfeedback_comments', [
        'assignment' => $assign_rec->id,
        'grade'      => $focusedgrade->id,
    ], '*', IGNORE_MULTIPLE);
    if ($fb) { $focusedfeedback = $fb->commenttext; }
}

// Helper: small state label per student.
function isti_grader_state($sub, $gr): array {
    if (!$sub) {
        return ['key' => 'nothing', 'label' => get_string('homework_state_nothing', 'local_istikama_admin'),
                'bg' => '#f1f5f9', 'fg' => '#94a3b8'];
    }
    if ($gr && $gr->grade >= 0) {
        return ['key' => 'graded', 'label' => get_string('homework_state_graded', 'local_istikama_admin'),
                'bg' => '#dcfce7', 'fg' => '#15803d'];
    }
    return ['key' => 'new', 'label' => get_string('homework_state_new', 'local_istikama_admin'),
            'bg' => '#dbeafe', 'fg' => '#1e40af'];
}

$dir = right_to_left() ? 'rtl' : 'ltr';
$textalign = right_to_left() ? 'right' : 'left';

$isti_hide_page_header = true;
$isti_no_card_wrapper  = true;
require_once('admin_layout.php');
?>
<div class="container-fluid" dir="<?= $dir ?>" style="text-align:<?= $textalign ?>; background:#fff; min-height:calc(100vh - 120px); padding:24px;">

    <!-- Page header -->
    <div class="isti-card" style="padding:18px 22px; margin-bottom:16px; display:flex; align-items:center; gap:14px; flex-wrap:wrap;">
        <a href="<?= (new moodle_url('/local/istikama_admin/view_homework.php', ['id' => $cmid]))->out(false) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-arrow-left"></i> <?= get_string('back_to_lesson', 'local_istikama_admin') ?>
        </a>
        <span style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:11px;background:#eff6ff;color:#006bff;font-size:1.15rem;flex-shrink:0">
            <i class="fa fa-check-double"></i>
        </span>
        <div style="flex:1; min-width:240px">
            <h5 style="margin:0; font-weight:700; color:#0f172a; font-size:1.1rem"><?= get_string('homework_grading_title', 'local_istikama_admin') ?>: <?= format_string($assign_rec->name) ?></h5>
            <div style="margin-top:4px; color:#64748b; font-size:.84rem;">
                <i class="fa fa-folder" style="color:#94a3b8"></i> <?= format_string($course->fullname) ?>
                · <i class="fa fa-users" style="color:#94a3b8"></i> <?= count($enrolledusers) ?> students
                · <i class="fa fa-paper-plane" style="color:#94a3b8"></i> <?= count($submissions) ?> submitted
            </div>
        </div>
    </div>

    <?php if (empty($enrolledusers)): ?>
    <div class="isti-card" style="padding:60px 20px;text-align:center">
        <i class="fa fa-users" style="font-size:3rem;color:#cbd5e1;display:block;margin-bottom:14px"></i>
        <h5 style="font-weight:700;color:#475569"><?= get_string('homework_no_submissions', 'local_istikama_admin') ?></h5>
        <p style="color:#94a3b8;font-size:.9rem;margin-top:6px"><?= get_string('homework_no_submissions_msg', 'local_istikama_admin') ?></p>
    </div>
    <?php else: ?>

    <div class="isti-grading-shell">

        <!-- LEFT: Student list -->
        <div class="isti-grading-col">
            <div class="isti-grading-col-header">
                <i class="fa fa-users"></i> Students
            </div>
            <div class="isti-grading-col-body">
                <div class="isti-grading-student-list" role="list">
                    <?php foreach ($enrolledusers as $u):
                        $sub = $submissions[(int)$u->id] ?? null;
                        $gr  = $grades[(int)$u->id] ?? null;
                        $state = isti_grader_state($sub, $gr);
                        $isactive = ((int)$u->id === (int)$focuseduser);
                        $initials = strtoupper(substr($u->firstname, 0, 1) . substr($u->lastname, 0, 1));
                        $picurl = $OUTPUT->user_picture($u, ['size' => 64, 'link' => false, 'class' => '']);
                        $picsrc = '';
                        if (preg_match('/src="([^"]+)"/', $picurl, $pm)) { $picsrc = $pm[1]; }
                        $url = (new moodle_url('/local/istikama_admin/grade_homework.php', ['id' => $cmid, 'userid' => (int)$u->id]))->out(false);
                    ?>
                    <a href="<?= $url ?>" class="isti-grading-student-item<?= $isactive ? ' active' : '' ?>" role="listitem">
                        <span class="isti-grading-student-avatar">
                            <?php if ($picsrc): ?><img src="<?= $picsrc ?>" alt=""><?php else: ?><?= s($initials) ?><?php endif; ?>
                        </span>
                        <span class="isti-grading-student-meta">
                            <span class="isti-grading-student-name"><?= s(fullname($u)) ?></span>
                            <span class="isti-grading-student-state" style="color:<?= $state['fg'] ?>">
                                <span style="display:inline-block;width:6px;height:6px;border-radius:50%;background:<?= $state['fg'] ?>;margin-right:5px"></span>
                                <?= s($state['label']) ?>
                                <?php if ($gr && $gr->grade >= 0): ?> · <?= rtrim(rtrim(number_format((float)$gr->grade, 1), '0'), '.') ?>/<?= (int)$assign_rec->grade ?><?php endif; ?>
                            </span>
                        </span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- MIDDLE: Submission viewer -->
        <div class="isti-grading-col isti-grading-stage">
            <div class="isti-grading-col-header">
                <i class="fa fa-file-alt"></i> <?= get_string('homework_student_files', 'local_istikama_admin') ?>
                <?php if ($focusedsub): ?>
                <span style="margin-inline-start:auto;font-weight:500;color:#94a3b8;font-size:.78rem;text-transform:none;letter-spacing:0">
                    <?= userdate($focusedsub->timemodified, get_string('strftimedatetimeshort', 'langconfig')) ?>
                </span>
                <?php endif; ?>
            </div>
            <div class="isti-grading-col-body">
                <?php if (!$focuseduserrec): ?>
                <div class="isti-grading-empty">
                    <i class="fa fa-hand-pointer"></i>
                    <div class="isti-grading-empty-title">Pick a student</div>
                    <div class="isti-grading-empty-msg"><?= get_string('homework_select_student', 'local_istikama_admin') ?></div>
                </div>
                <?php elseif (!$focusedsub): ?>
                <div class="isti-grading-empty">
                    <i class="fa fa-inbox"></i>
                    <div class="isti-grading-empty-title"><?= get_string('homework_state_nothing', 'local_istikama_admin') ?></div>
                    <div class="isti-grading-empty-msg"><?= s(fullname($focuseduserrec)) ?> hasn't submitted anything yet.</div>
                </div>
                <?php else: ?>

                    <?php if (!empty($focusedfiles)): ?>
                    <div class="isti-grading-file-grid">
                        <?php foreach ($focusedfiles as $idx => $f):
                            $ext = $f['ext'];
                            if ($ext === 'pdf') { $icon = 'fa-file-pdf'; $color = '#ef4444'; }
                            elseif (in_array($ext, ['jpg','jpeg','png','gif','svg','bmp','webp'])) { $icon = 'fa-image'; $color = '#06b6d4'; }
                            elseif (in_array($ext, ['mp4','webm','mov'])) { $icon = 'fa-file-video'; $color = '#a855f7'; }
                            elseif (in_array($ext, ['doc','docx','odt'])) { $icon = 'fa-file-word'; $color = '#3b82f6'; }
                            elseif (in_array($ext, ['xls','xlsx','ods'])) { $icon = 'fa-file-excel'; $color = '#10b981'; }
                            elseif (in_array($ext, ['ppt','pptx','odp'])) { $icon = 'fa-file-powerpoint'; $color = '#f59e0b'; }
                            else { $icon = 'fa-file'; $color = '#64748b'; }
                        ?>
                        <a class="isti-file-tile" href="#" data-isti-viewer-index="<?= (int)$idx ?>">
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

                    <?php if ($focusedtext): ?>
                    <div style="margin-top:14px;background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:18px 20px">
                        <h6 style="font-weight:700;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:12px">
                            <i class="fa fa-align-left" style="color:#8b5cf6"></i> <?= get_string('homework_student_text', 'local_istikama_admin') ?>
                        </h6>
                        <div style="color:#0f172a;font-size:.94rem;line-height:1.7">
                            <?= format_text($focusedtext, FORMAT_HTML, ['context' => $ctx]) ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (empty($focusedfiles) && empty($focusedtext)): ?>
                    <div class="isti-grading-empty">
                        <i class="fa fa-file"></i>
                        <div class="isti-grading-empty-title">Empty submission</div>
                        <div class="isti-grading-empty-msg">Student submitted but provided neither files nor text.</div>
                    </div>
                    <?php endif; ?>

                <?php endif; ?>
            </div>
        </div>

        <!-- RIGHT: Grade panel -->
        <div class="isti-grading-col">
            <div class="isti-grading-col-header">
                <i class="fa fa-star"></i> Grade & Feedback
            </div>
            <div class="isti-grading-col-body">
                <?php if (!$focuseduserrec): ?>
                <div class="isti-grading-empty">
                    <i class="fa fa-user"></i>
                    <div class="isti-grading-empty-title">No student selected</div>
                </div>
                <?php else: ?>

                <!-- Student card -->
                <div style="display:flex;align-items:center;gap:12px;padding-bottom:14px;border-bottom:1px solid #f1f5f9;margin-bottom:16px">
                    <span class="isti-grading-student-avatar" style="width:44px;height:44px;font-size:.9rem">
                        <?php
                        $pic = $OUTPUT->user_picture($focuseduserrec, ['size' => 80, 'link' => false, 'class' => '']);
                        if (preg_match('/src="([^"]+)"/', $pic, $pm)) {
                            echo '<img src="' . s($pm[1]) . '" alt="">';
                        } else {
                            echo s(strtoupper(substr($focuseduserrec->firstname, 0, 1) . substr($focuseduserrec->lastname, 0, 1)));
                        }
                        ?>
                    </span>
                    <div style="flex:1;min-width:0">
                        <strong style="color:#0f172a;font-size:.95rem;display:block"><?= s(fullname($focuseduserrec)) ?></strong>
                        <span style="color:#94a3b8;font-size:.78rem"><?= s($focuseduserrec->email) ?></span>
                    </div>
                </div>

                <form method="post" action="<?= $PAGE->url->out(false) ?>">
                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                    <input type="hidden" name="action" value="save_grade">
                    <input type="hidden" name="userid" value="<?= (int)$focuseduser ?>">

                    <div style="margin-bottom:18px">
                        <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                            <i class="fa fa-star" style="color:#f59e0b"></i> <?= get_string('homework_grade_input', 'local_istikama_admin') ?>
                            <span style="color:#94a3b8;font-weight:500;text-transform:none;letter-spacing:0;margin-left:4px"><?= s(get_string('homework_grade_max', 'local_istikama_admin', (int)$assign_rec->grade)) ?></span>
                        </label>
                        <input type="number"
                               name="grade"
                               step="any"
                               min="0"
                               max="<?= (int)$assign_rec->grade ?>"
                               value="<?= ($focusedgrade && $focusedgrade->grade >= 0) ? rtrim(rtrim(number_format((float)$focusedgrade->grade, 2), '0'), '.') : '' ?>"
                               placeholder="—"
                               style="width:100%;padding:12px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:1.1rem;font-weight:700;color:#006bff;text-align:center">
                    </div>

                    <div style="margin-bottom:18px">
                        <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                            <i class="fa fa-comment" style="color:#06b6d4"></i> <?= get_string('homework_feedback_label', 'local_istikama_admin') ?>
                        </label>
                        <?php
                        // Convert any stored HTML feedback to plain text for the textarea —
                        // <p> wrappers and <br>s become natural newlines that the teacher can
                        // edit cleanly. Save handler will re-wrap with <br>s as HTML.
                        $feedbackplain = $focusedfeedback;
                        if ($feedbackplain !== '') {
                            $feedbackplain = preg_replace('#</p\s*>#i', "\n\n", $feedbackplain);
                            $feedbackplain = preg_replace('#<br\s*/?\s*>#i', "\n", $feedbackplain);
                            $feedbackplain = html_to_text($feedbackplain, 0, false);
                            $feedbackplain = trim($feedbackplain);
                        }
                        ?>
                        <textarea name="feedback"
                                  rows="7"
                                  placeholder="<?= s(get_string('homework_feedback_ph', 'local_istikama_admin')) ?>"
                                  style="width:100%;padding:12px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.9rem;resize:vertical;font-family:inherit;line-height:1.6"><?= s($feedbackplain) ?></textarea>
                    </div>

                    <button type="submit" class="isti-btn isti-btn-primary" style="width:100%;justify-content:center;padding:11px;font-size:.93rem">
                        <i class="fa fa-check"></i> <?= get_string('homework_save_grade', 'local_istikama_admin') ?>
                    </button>
                </form>

                <?php endif; ?>
            </div>
        </div>

    </div>

    <?php endif; ?>

</div>

<script>
(function() {
    var FILES = <?= json_encode($focusedfiles, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;

    function bind() {
        if (!window.IstikamaSubmissionViewer) {
            setTimeout(bind, 80);
            return;
        }
        document.querySelectorAll('[data-isti-viewer-index]').forEach(function(el) {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                var idx = parseInt(el.getAttribute('data-isti-viewer-index'), 10) || 0;
                if (!FILES || !FILES.length) return;
                IstikamaSubmissionViewer.open(FILES, { startIndex: idx });
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
