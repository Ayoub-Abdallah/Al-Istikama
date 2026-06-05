<?php
/**
 * Smart content viewer — YouTube embed, PDF/video inline, generic fallback.
 * Shows a discussion/comment sidebar pulled from istikama_content_comments.
 *
 * Query params:
 *   cmid  (int)  course module id
 */
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/locallib.php');

global $DB, $PAGE, $OUTPUT, $USER;

$cmid = required_param('cmid', PARAM_INT);
[$course, $cm] = get_course_and_cm_from_cmid($cmid);

// ── ROOT-CAUSE FIX ────────────────────────────────────────────────────────
// require_course_login() is the correct Moodle entry point for any user
// (enrolled student, teacher, admin) trying to access a course activity.
// It handles login, course visibility, enrolment, and per-module visibility
// using Moodle's native capability stack — no manual capability checks.
//
// The previous code called require_capability('moodle/course:view') which is
// the "View courses without participation" capability — granted only to
// guests/non-participants. Enrolled students have 'moodle/course:participate'
// instead, which made every PDF/resource access throw a permission error.
// ──────────────────────────────────────────────────────────────────────────
require_course_login($course, true, $cm);

$modcontext = context_module::instance($cmid);
$coursectx  = context_course::instance($course->id);

$PAGE->set_url(new moodle_url('/local/istikama_admin/view_content.php', ['cmid' => $cmid]));
$PAGE->set_context($modcontext);
$PAGE->set_course($course);
$PAGE->set_pagelayout('base');
$PAGE->set_title(format_string($cm->name));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css?v=12');

// ── Resolve module content ─────────────────────────────────────────────────
$modulename = $cm->modname;
$instance   = $DB->get_record($modulename, ['id' => $cm->instance]);

$youtube_id = null;
$embed_url  = null;
$file_url   = null;
$file_name  = '';
$is_pdf     = false;
$is_video   = false;

if ($modulename === 'url' && !empty($instance->externalurl)) {
    $raw = $instance->externalurl;
    // Detect YouTube in all common formats:
    //   youtu.be/ID, youtube.com/watch?v=ID, youtube.com/embed/ID,
    //   youtube.com/shorts/ID, youtube-nocookie.com/embed/ID
    if (preg_match('!youtu\.be/([A-Za-z0-9_-]{6,20})!', $raw, $m) ||
        preg_match('!youtube(?:-nocookie)?\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/)([A-Za-z0-9_-]{6,20})!', $raw, $m)) {
        $youtube_id = $m[1];
    }
    $embed_url = $raw;
}

if ($modulename === 'resource') {
    $fs    = get_file_storage();
    $files = $fs->get_area_files($modcontext->id, 'mod_resource', 'content', 0, 'id', false);
    $file  = !empty($files) ? reset($files) : null;
    if ($file) {
        $file_url  = moodle_url::make_pluginfile_url(
            $modcontext->id, 'mod_resource', 'content', 0,
            $file->get_filepath(), $file->get_filename()
        )->out(false);
        $file_name = $file->get_filename();
        $ext       = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $is_pdf    = ($ext === 'pdf');
        $is_video  = in_array($ext, ['mp4', 'webm', 'ogg', 'mov', 'avi']);
    }
}

// ── Comments ───────────────────────────────────────────────────────────────
// Comments are keyed by cmid so each activity has its own discussion.
// (Reusing the istikama_content_comments.content_id column — semantically
// "the thing being discussed". Per-cmid is the right granularity for
// students reading a specific PDF/video.)
$content_id = (int)$cmid;

if (optional_param('action', '', PARAM_ALPHA) === 'comment' && confirm_sesskey()) {
    $text = trim(required_param('commenttext', PARAM_TEXT));
    if ($text !== '') {
        $DB->insert_record('istikama_content_comments', (object)[
            'content_id'   => $content_id,
            'userid'       => (int)$USER->id,
            'comment_text' => $text,
            'timecreated'  => time(),
        ]);
    }
    redirect(new moodle_url('/local/istikama_admin/view_content.php', ['cmid' => $cmid]));
}

$comments = $DB->get_records_sql("
    SELECT c.*, u.firstname, u.lastname, u.picture, u.imagealt, u.email, u.middlename, u.alternatename, u.firstnamephonetic, u.lastnamephonetic
      FROM {istikama_content_comments} c
      JOIN {user} u ON u.id = c.userid
     WHERE c.content_id = :cid
  ORDER BY c.timecreated ASC
", ['cid' => $content_id], 0, 200);

// Suppress Moodle's native activity_header (title + completion + intro block).
// Our custom breadcrumb card below already shows the module name.
$PAGE->activityheader->disable();
$isti_hide_page_header = true;

require_once(__DIR__ . '/admin_layout.php');

$dir        = right_to_left() ? 'rtl' : 'ltr';
$backurl    = new moodle_url('/course/view.php', ['id' => $course->id]);
$intro_html = !empty($instance->intro) ? format_text($instance->intro, $instance->introformat ?? FORMAT_HTML) : '';

// Translated UI strings
$str_back        = get_string('sr_back_to_lesson', 'local_istikama_admin');
$str_discussion  = get_string('sr_discussion', 'local_istikama_admin');
$str_post        = get_string('sr_post_comment', 'local_istikama_admin');
$str_placeholder = get_string('sr_comment_placeholder', 'local_istikama_admin');
$str_no_comments = get_string('sr_no_comments', 'local_istikama_admin');
$str_download    = get_string('download', 'moodle');
$str_open        = get_string('openinnewwindow', 'moodle');
$str_view        = get_string('view');
$str_open_viewer = get_string('openinnewwindow', 'moodle');
?>
<style>
@media(max-width:860px){.isti-viewer-grid{grid-template-columns:1fr !important}}
</style>

<div dir="<?= $dir ?>">

  <!-- Breadcrumb / title bar -->
  <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;margin-bottom:18px;padding-bottom:16px;border-bottom:1px solid #e2e8f0">
    <a href="<?= $backurl->out(false) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
      <i class="fa fa-arrow-<?= right_to_left() ? 'right' : 'left' ?>"></i> <?= $str_back ?>
    </a>
    <div style="flex:1;min-width:180px">
      <h5 style="margin:0;font-weight:700;color:#1e293b"><?= format_string($cm->name) ?></h5>
      <div style="font-size:.8rem;color:#64748b;margin-top:2px">
        <i class="fa fa-book-open"></i> <?= format_string($course->fullname) ?>
      </div>
    </div>
  </div>

  <div class="isti-viewer-grid" style="display:grid;grid-template-columns:1fr 340px;gap:18px;align-items:start">

    <!-- ── Main viewer ────────────────────────────────────── -->
    <div>

      <?php if ($youtube_id): ?>
      <!-- YouTube player -->
      <div style="border:1px solid #e2e8f0;border-radius:16px;overflow:hidden">
        <div style="position:relative;padding-top:56.25%;background:#000">
          <iframe
            src="https://www.youtube-nocookie.com/embed/<?= s($youtube_id) ?>?rel=0&modestbranding=1"
            title="<?= s($cm->name) ?>"
            style="position:absolute;inset:0;width:100%;height:100%;border:none"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen loading="lazy"></iframe>
        </div>
        <?php if ($intro_html): ?>
        <div style="padding:14px 18px;border-top:1px solid #f1f5f9;color:#475569;font-size:.88rem;line-height:1.6">
          <?= $intro_html ?>
        </div>
        <?php endif; ?>
      </div>

      <?php elseif ($is_pdf && $file_url): ?>
      <!-- PDF inline viewer -->
      <div style="border:1px solid #e2e8f0;border-radius:16px;overflow:hidden">
        <div style="height:75vh">
          <iframe src="<?= s($file_url) ?>" style="width:100%;height:100%;border:none" title="<?= s($cm->name) ?>"></iframe>
        </div>
        <div style="padding:10px 16px;border-top:1px solid #e2e8f0;display:flex;align-items:center;gap:10px;background:#fff">
          <i class="fa fa-file-pdf" style="color:#ef4444;font-size:1.1rem"></i>
          <span style="flex:1;font-size:.88rem;color:#1e293b;font-weight:600"><?= s($file_name) ?></span>
          <a href="<?= s($file_url) ?>" class="isti-btn isti-btn-outline" style="padding:4px 12px;font-size:.82rem" download>
            <i class="fa fa-download"></i> <?= $str_download ?>
          </a>
          <a href="<?= s($file_url) ?>" class="isti-btn isti-btn-outline" style="padding:4px 12px;font-size:.82rem" target="_blank" rel="noopener">
            <i class="fa fa-external-link-alt"></i> <?= $str_open ?>
          </a>
        </div>
      </div>

      <?php elseif ($is_video && $file_url): ?>
      <!-- Native video player -->
      <div style="border:1px solid #e2e8f0;border-radius:16px;overflow:hidden">
        <video controls style="width:100%;display:block;background:#000;max-height:62vh">
          <source src="<?= s($file_url) ?>">
        </video>
        <?php if ($intro_html): ?>
        <div style="padding:12px 18px;border-top:1px solid #f1f5f9;color:#475569;font-size:.88rem;line-height:1.6;background:#fff">
          <?= $intro_html ?>
        </div>
        <?php endif; ?>
      </div>

      <?php elseif ($embed_url): ?>
      <!-- Generic external URL embedded -->
      <div style="border:1px solid #e2e8f0;border-radius:16px;overflow:hidden">
        <div style="height:72vh">
          <iframe src="<?= s($embed_url) ?>" style="width:100%;height:100%;border:none"
            title="<?= s($cm->name) ?>" sandbox="allow-scripts allow-same-origin allow-forms allow-popups"></iframe>
        </div>
        <div style="padding:10px 16px;border-top:1px solid #e2e8f0;display:flex;align-items:center;gap:10px;background:#fff">
          <i class="fa fa-link" style="color:#006bff"></i>
          <span style="flex:1;font-size:.88rem;color:#1e293b;font-weight:600"><?= format_string($cm->name) ?></span>
          <a href="<?= s($embed_url) ?>" class="isti-btn isti-btn-outline" style="padding:4px 12px;font-size:.82rem" target="_blank" rel="noopener">
            <i class="fa fa-external-link-alt"></i> <?= $str_open ?>
          </a>
        </div>
      </div>

      <?php elseif ($file_url): ?>
      <!-- Non-embeddable file (Word, etc.) -->
      <div style="border:1px solid #e2e8f0;border-radius:16px;padding:40px;text-align:center">
        <i class="fa fa-file-alt" style="font-size:3.5rem;color:#94a3b8;display:block;margin-bottom:18px"></i>
        <h6 style="font-weight:700;color:#1e293b;margin-bottom:22px"><?= s($file_name) ?></h6>
        <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
          <a href="<?= s($file_url) ?>" class="isti-btn isti-btn-primary" target="_blank" rel="noopener"><i class="fa fa-eye"></i> <?= $str_view ?></a>
          <a href="<?= s($file_url) ?>" class="isti-btn isti-btn-outline" download><i class="fa fa-download"></i> <?= $str_download ?></a>
        </div>
      </div>

      <?php elseif ($modulename === 'page'): ?>
      <!-- Page content -->
      <div style="color:#334155;line-height:1.75;font-size:.95rem">
        <?= format_text($instance->content ?? '', $instance->contentformat ?? FORMAT_HTML) ?>
      </div>

      <?php else: ?>
      <!-- Fallback: link to native viewer -->
      <div style="border:1px solid #e2e8f0;border-radius:16px;padding:40px;text-align:center">
        <i class="fa fa-cube" style="font-size:2.8rem;color:#94a3b8;display:block;margin-bottom:16px"></i>
        <h6 style="font-weight:600;color:#1e293b;margin-bottom:6px"><?= format_string($cm->name) ?></h6>
        <a href="<?= (new moodle_url("/mod/{$modulename}/view.php", ['id' => $cmid]))->out(false) ?>" class="isti-btn isti-btn-primary">
          <i class="fa fa-external-link-alt"></i> <?= $str_open ?>
        </a>
      </div>
      <?php endif; ?>

    </div>

    <!-- ── Discussion sidebar ─────────────────────────────── -->
    <div>
      <div style="border:1px solid #e2e8f0;border-radius:12px;padding:18px;background:#f8fafc">
        <h6 style="margin:0 0 14px;font-weight:700;color:#1e293b;display:flex;align-items:center;gap:8px">
          <span style="display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:8px;background:#eff6ff;color:#006bff">
            <i class="fa fa-comments"></i>
          </span>
          <?= $str_discussion ?>
          <span class="isti-badge" style="background:#eff6ff;color:#006bff;margin-left:auto"><?= count($comments) ?></span>
        </h6>

        <form method="post" action="<?= $PAGE->url->out(false) ?>" style="margin-bottom:14px">
          <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
          <input type="hidden" name="action"  value="comment">
          <textarea name="commenttext" rows="3" class="isti-form-input"
            placeholder="<?= s($str_placeholder) ?>"
            style="width:100%;resize:vertical;font-size:.84rem;margin-bottom:8px" required></textarea>
          <button type="submit" class="isti-btn isti-btn-primary" style="width:100%;justify-content:center;font-size:.85rem">
            <i class="fa fa-paper-plane"></i> <?= $str_post ?>
          </button>
        </form>
        <div style="border-top:1px solid #e2e8f0;margin-bottom:12px"></div>

        <div style="display:flex;flex-direction:column;gap:10px;max-height:55vh;overflow-y:auto">
          <?php if (empty($comments)): ?>
          <p style="text-align:center;color:#94a3b8;font-size:.84rem;padding:16px 0">
            <?= $str_no_comments ?>
          </p>
          <?php else: ?>
          <?php foreach ($comments as $c): ?>
          <div style="display:flex;gap:9px;align-items:flex-start">
            <div style="width:32px;height:32px;border-radius:50%;background:#eff6ff;color:#006bff;display:flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;flex-shrink:0">
              <?= mb_strtoupper(mb_substr($c->firstname ?? 'U', 0, 1) . mb_substr($c->lastname ?? '', 0, 1)) ?>
            </div>
            <div style="flex:1;min-width:0">
              <div style="font-size:.77rem;color:#64748b;margin-bottom:2px">
                <strong style="color:#1e293b"><?= s(fullname((object)['firstname' => $c->firstname, 'lastname' => $c->lastname])) ?></strong>
                &nbsp;·&nbsp;<?= userdate($c->timecreated, get_string('strftimedatetimeshort', 'langconfig')) ?>
              </div>
              <div style="font-size:.85rem;color:#334155;line-height:1.5;word-break:break-word"><?= s($c->comment_text) ?></div>
            </div>
          </div>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </div>

  </div>
</div>
<?php
echo '</div></div>';
echo $OUTPUT->footer();
