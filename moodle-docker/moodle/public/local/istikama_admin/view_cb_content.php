<?php
/**
 * Content-bank item viewer.
 * Displays a YouTube embed, PDF, video, or external link stored in
 * istikama_content_bank, with an inline discussion/comment section.
 *
 * Query params:
 *   id  (int)  — istikama_content_bank.id
 */
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_target_user();

global $DB, $PAGE, $OUTPUT, $USER, $CFG;

$cbid = required_param('id', PARAM_INT);

$context = context_system::instance();
$PAGE->set_url(new moodle_url('/local/istikama_admin/view_cb_content.php', ['id' => $cbid]));
$PAGE->set_context($context);
$PAGE->set_pagelayout('base');
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css?v=19');

// Load content bank record.
if (!$DB->get_manager()->table_exists('istikama_content_bank')) {
    throw new moodle_exception('error');
}
$item = $DB->get_record('istikama_content_bank', ['id' => $cbid]);
if (!$item) {
    throw new moodle_exception('invalidrecordid');
}

// Viewer tier drives capabilities on this read-only previewer.
$viewertier = local_istikama_admin_get_user_tier();
// Technical professors and admins moderate; they can preview unapproved content.
$can_moderate     = in_array($viewertier, ['full_admin', 'technical_professor', 'school_manager'], true);
// Only technical professors and admins may READ the discussion/feedback comments.
$can_see_comments = in_array($viewertier, ['full_admin', 'technical_professor'], true);
// All staff who reach this page (incl. teachers) may POST a comment.
$can_comment      = true;
// Teachers preview only — they never get edit/moderation controls here.

if ($item->status !== 'approved') {
    // Non-moderators cannot view unapproved content.
    if (!$can_moderate) {
        throw new moodle_exception('nopermissions', 'error', '', 'view unapproved content');
    }
}

$PAGE->set_title(format_string($item->name ?? 'Content'));

// ── Detect content type ────────────────────────────────────────────────────
$youtube_id  = null;
$file_url    = null;
$file_name   = '';
$is_pdf      = false;
$is_video    = false;
$embed_url   = null;

$raw_url = trim($item->external_url ?? '');

if ($raw_url) {
    // YouTube detection — all common URL formats.
    if (preg_match('!youtu\.be/([A-Za-z0-9_-]{6,20})!', $raw_url, $m) ||
        preg_match('!youtube(?:-nocookie)?\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/)([A-Za-z0-9_-]{6,20})!', $raw_url, $m)) {
        $youtube_id = $m[1];
    } else {
        $embed_url = $raw_url;
    }
}

if (!$youtube_id && !empty($item->filename)) {
    $file_url = moodle_url::make_pluginfile_url(
        $context->id, 'local_istikama_admin', 'content', $item->id, '/', $item->filename
    )->out(false);
    $file_name = $item->filename;
    $ext       = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $is_pdf    = ($ext === 'pdf');
    $is_video  = in_array($ext, ['mp4', 'webm', 'ogg', 'mov', 'avi']);
}

// ── Comments ───────────────────────────────────────────────────────────────
// Use content_id = cbid (content bank IDs are in a separate namespace from
// course-module cmids — they live in different tables so collision is unlikely).
// We prefix with 'cb' semantically but store as a large integer offset to be safe.
$comment_content_id = 900000000 + (int)$cbid;

if (optional_param('action', '', PARAM_ALPHA) === 'comment' && confirm_sesskey()) {
    $text = trim(required_param('commenttext', PARAM_TEXT));
    if ($text !== '') {
        $DB->insert_record('istikama_content_comments', (object)[
            'content_id'   => $comment_content_id,
            'userid'       => (int)$USER->id,
            'comment_text' => $text,
            'timecreated'  => time(),
        ]);
    }
    redirect(new moodle_url('/local/istikama_admin/view_cb_content.php', ['id' => $cbid]));
}

// Only technical professors and admins may read the discussion. Teachers can
// post feedback but never see other people's comments.
$comments = [];
if ($can_see_comments) {
    $comments = $DB->get_records_sql("
        SELECT c.*, u.firstname, u.lastname
          FROM {istikama_content_comments} c
          JOIN {user} u ON u.id = c.userid
         WHERE c.content_id = :cid
      ORDER BY c.timecreated ASC
    ", ['cid' => $comment_content_id], 0, 200);
}

require_once(__DIR__ . '/admin_layout.php');

$dir     = right_to_left() ? 'rtl' : 'ltr';
$backurl = new moodle_url('/local/istikama_admin/contentbank.php', ['tab' => 'digital-library']);

// UI strings.
$str_back        = get_string('sr_back_to_lesson', 'local_istikama_admin');
$str_discussion  = get_string('sr_discussion', 'local_istikama_admin');
$str_post        = get_string('sr_post_comment', 'local_istikama_admin');
$str_placeholder = get_string('sr_comment_placeholder', 'local_istikama_admin');
$str_no_comments = get_string('sr_no_comments', 'local_istikama_admin');
$str_download    = get_string('download', 'moodle');
$str_open        = get_string('openinnewwindow', 'moodle');

// Type meta for display.
$type_labels = [
    'document' => ['fa' => 'fa-file-pdf',       'bg' => '#fff8e1', 'clr' => '#f59e0b'],
    'video'    => ['fa' => 'fa-play-circle',     'bg' => '#eff6ff', 'clr' => '#006bff'],
    'h5p'      => ['fa' => 'fa-layer-group',     'bg' => '#f5f3ff', 'clr' => '#7c3aed'],
    'book'     => ['fa' => 'fa-book-open',       'bg' => '#f0fdf4', 'clr' => '#16a34a'],
    'quiz'     => ['fa' => 'fa-question-circle', 'bg' => '#fdf2f8', 'clr' => '#db2777'],
    'link'     => ['fa' => 'fa-link',            'bg' => '#ecfeff', 'clr' => '#0891b2'],
];
$tmeta = $type_labels[$item->content_type ?? 'document'] ?? $type_labels['document'];
?>
<style>
@media(max-width:860px){.isti-cbv-grid{grid-template-columns:1fr !important}}
</style>

<div class="container-fluid" dir="<?= $dir ?>" style="background:#f1f5f9;min-height:100vh;margin:-24px;padding:24px;">

  <!-- Top bar -->
  <div class="isti-card" style="padding:14px 20px;margin-bottom:16px;display:flex;align-items:center;gap:12px;flex-wrap:wrap">
    <a href="<?= $backurl->out(false) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
      <i class="fa fa-arrow-<?= right_to_left() ? 'right' : 'left' ?>"></i> <?= $str_back ?>
    </a>
    <div style="display:flex;align-items:center;gap:10px;flex:1;min-width:200px">
      <div style="width:38px;height:38px;border-radius:10px;background:<?= $tmeta['bg'] ?>;color:<?= $tmeta['clr'] ?>;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0">
        <i class="fa <?= $tmeta['fa'] ?>"></i>
      </div>
      <div>
        <h5 style="margin:0;font-weight:700;color:#1e293b;line-height:1.2"><?= format_string($item->name ?? 'Content') ?></h5>
        <?php if (!empty($item->subject) || !empty($item->level)): ?>
        <div style="font-size:.78rem;color:#94a3b8;margin-top:2px">
          <?= s($item->subject ?? '') ?><?= (!empty($item->subject) && !empty($item->level)) ? ' · ' : '' ?><?= s($item->level ?? '') ?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Main grid: viewer + comments sidebar -->
  <div class="isti-cbv-grid" style="display:grid;grid-template-columns:1fr 340px;gap:18px;align-items:start">

    <!-- ── Viewer ────────────────────────────────────────────────── -->
    <div>

      <?php if ($youtube_id): ?>
      <!-- YouTube embed -->
      <div class="isti-card" style="padding:0;overflow:hidden;border-radius:16px">
        <div style="position:relative;padding-top:56.25%;background:#000">
          <iframe
            src="https://www.youtube-nocookie.com/embed/<?= s($youtube_id) ?>?rel=0&modestbranding=1&color=white"
            title="<?= s($item->name ?? '') ?>"
            style="position:absolute;inset:0;width:100%;height:100%;border:none"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            allowfullscreen loading="lazy"></iframe>
        </div>
        <?php if (!empty($item->description)): ?>
        <div style="padding:16px 20px;border-top:1px solid #f1f5f9;color:#475569;font-size:.88rem;line-height:1.65">
          <?= format_text($item->description, FORMAT_HTML) ?>
        </div>
        <?php endif; ?>
      </div>

      <?php elseif ($is_pdf && $file_url): ?>
      <!-- PDF inline viewer -->
      <div class="isti-card" style="padding:0;overflow:hidden;border-radius:16px">
        <div style="height:75vh">
          <iframe src="<?= s($file_url) ?>" style="width:100%;height:100%;border:none" title="<?= s($file_name) ?>"></iframe>
        </div>
        <div style="padding:10px 16px;border-top:1px solid #e2e8f0;display:flex;align-items:center;gap:10px">
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
      <div class="isti-card" style="padding:0;overflow:hidden;border-radius:16px">
        <video controls style="width:100%;display:block;background:#000;max-height:62vh">
          <source src="<?= s($file_url) ?>">
        </video>
        <?php if (!empty($item->description)): ?>
        <div style="padding:12px 16px;color:#475569;font-size:.88rem"><?= format_text($item->description, FORMAT_HTML) ?></div>
        <?php endif; ?>
      </div>

      <?php elseif ($embed_url): ?>
      <!-- Generic external link embed -->
      <div class="isti-card" style="padding:0;overflow:hidden;border-radius:16px">
        <div style="height:72vh">
          <iframe src="<?= s($embed_url) ?>" style="width:100%;height:100%;border:none"
            title="<?= s($item->name ?? '') ?>" sandbox="allow-scripts allow-same-origin allow-forms allow-popups"></iframe>
        </div>
        <div style="padding:10px 16px;border-top:1px solid #e2e8f0;display:flex;align-items:center;gap:10px">
          <i class="fa fa-link" style="color:#006bff"></i>
          <span style="flex:1;font-size:.88rem;color:#1e293b;font-weight:600"><?= format_string($item->name ?? '') ?></span>
          <a href="<?= s($embed_url) ?>" class="isti-btn isti-btn-outline" style="padding:4px 12px;font-size:.82rem" target="_blank" rel="noopener">
            <i class="fa fa-external-link-alt"></i> <?= $str_open ?>
          </a>
        </div>
      </div>

      <?php elseif ($file_url): ?>
      <!-- Non-embeddable file download card -->
      <div class="isti-card" style="padding:40px;text-align:center">
        <div style="width:72px;height:72px;border-radius:18px;background:<?= $tmeta['bg'] ?>;color:<?= $tmeta['clr'] ?>;display:flex;align-items:center;justify-content:center;font-size:2rem;margin:0 auto 16px">
          <i class="fa <?= $tmeta['fa'] ?>"></i>
        </div>
        <h6 style="font-weight:700;color:#1e293b;margin-bottom:6px"><?= s($file_name) ?></h6>
        <?php if (!empty($item->description)): ?>
        <div style="color:#64748b;font-size:.9rem;margin-bottom:22px"><?= format_text($item->description, FORMAT_HTML) ?></div>
        <?php endif; ?>
        <div style="display:flex;gap:10px;justify-content:center;flex-wrap:wrap">
          <a href="<?= s($file_url) ?>" class="isti-btn isti-btn-primary" target="_blank" rel="noopener">
            <i class="fa fa-eye"></i> View
          </a>
          <a href="<?= s($file_url) ?>" class="isti-btn isti-btn-outline" download>
            <i class="fa fa-download"></i> <?= $str_download ?>
          </a>
        </div>
      </div>

      <?php else: ?>
      <!-- Nothing to display -->
      <div class="isti-card" style="padding:48px;text-align:center">
        <i class="fa fa-cube" style="font-size:2.8rem;color:#cbd5e1;display:block;margin-bottom:16px"></i>
        <h6 style="font-weight:600;color:#1e293b;margin-bottom:6px"><?= format_string($item->name ?? 'Content') ?></h6>
        <p style="color:#94a3b8;font-size:.9rem">No viewable content is attached to this item.</p>
      </div>
      <?php endif; ?>

      <!-- Description (if not already shown inline above) -->
      <?php if (!empty($item->description) && !$youtube_id && !$is_pdf && !$is_video && empty($embed_url) && empty($file_url)): ?>
      <div class="isti-card" style="padding:20px;margin-top:14px;color:#334155;font-size:.9rem;line-height:1.75">
        <?= format_text($item->description, FORMAT_HTML) ?>
      </div>
      <?php endif; ?>

    </div>

    <!-- ── Discussion / Comments ─────────────────────────────────── -->
    <div>
      <div class="isti-card" style="padding:18px">
        <h6 style="margin:0 0 14px;font-weight:700;color:#1e293b;display:flex;align-items:center;gap:8px">
          <span style="display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:8px;background:#eff6ff;color:#006bff">
            <i class="fa fa-comments"></i>
          </span>
          <?= $can_see_comments ? $str_discussion : get_string('cb_feedback_title', 'local_istikama_admin') ?>
          <?php if ($can_see_comments): ?>
          <span class="isti-badge" style="background:#eff6ff;color:#006bff;margin-<?= right_to_left() ? 'right' : 'left' ?>:auto"><?= count($comments) ?></span>
          <?php endif; ?>
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

        <?php if (!$can_see_comments): ?>
        <div style="background:#f8fafc;border:1px dashed #cbd5e1;border-radius:10px;padding:14px;color:#64748b;font-size:.82rem;line-height:1.6;display:flex;gap:10px;align-items:flex-start">
          <i class="fa fa-lock" style="color:#94a3b8;margin-top:2px"></i>
          <span><?= get_string('cb_feedback_note', 'local_istikama_admin') ?></span>
        </div>
        <?php else: ?>
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
        <?php endif; ?>
      </div>
    </div>

  </div><!-- /grid -->
</div>
<?php
echo '</div></div>';
echo $OUTPUT->footer();
