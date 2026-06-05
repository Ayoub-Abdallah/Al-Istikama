<?php
/**
 * Forum / Announcement type picker.
 *
 * Shows a centered grid of forum types. Selecting one redirects to Moodle's
 * native mod-edit form (course/modedit.php) so no custom creation logic is needed.
 *
 * Query params:
 *   courseid    (int)  target course id
 *   sectionnum  (int)  target section number (0 = general)
 *   beforemod   (int)  optional cm id to insert before
 */
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_target_user();

global $DB, $PAGE, $OUTPUT;

$courseid   = required_param('courseid', PARAM_INT);
$sectionnum = optional_param('sectionnum', 0, PARAM_INT);
$beforemod  = optional_param('beforemod', 0, PARAM_INT);

$course = $DB->get_record('course', ['id' => $courseid], '*', MUST_EXIST);
$ctx    = context_course::instance($course->id);
require_capability('moodle/course:manageactivities', $ctx);

$PAGE->set_url(new moodle_url('/local/istikama_admin/add_course_forum.php', ['courseid' => $courseid]));
$PAGE->set_context($ctx);
$PAGE->set_course($course);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('addforum_page_title', 'local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css?v=8');

require_once(__DIR__ . '/admin_layout.php');

$dir       = right_to_left() ? 'rtl' : 'ltr';
$cancelurl = new moodle_url('/course/view.php', ['id' => $course->id]);

// Base URL for Moodle's native forum creation form.
// After saving, Moodle returns to the course page automatically.
$modedit_base = new moodle_url('/course/modedit.php', [
    'add'        => 'forum',
    'course'     => $courseid,
    'section'    => $sectionnum,
    'return'     => 0,
    'sr'         => 0,
]);

$forum_types = [
    'general' => [
        'icon'  => 'fa-comments',
        'color' => '#006bff',
        'bg'    => '#eff6ff',
        'title' => get_string('forum_type_general_title', 'local_istikama_admin'),
        'desc'  => get_string('forum_type_general_desc',  'local_istikama_admin'),
    ],
    'news' => [
        'icon'  => 'fa-bullhorn',
        'color' => '#f59e0b',
        'bg'    => '#fffbeb',
        'title' => get_string('forum_type_news_title', 'local_istikama_admin'),
        'desc'  => get_string('forum_type_news_desc',  'local_istikama_admin'),
    ],
    'qanda' => [
        'icon'  => 'fa-question-circle',
        'color' => '#10b981',
        'bg'    => '#f0fdf4',
        'title' => get_string('forum_type_qanda_title', 'local_istikama_admin'),
        'desc'  => get_string('forum_type_qanda_desc',  'local_istikama_admin'),
    ],
    'blog' => [
        'icon'  => 'fa-rss',
        'color' => '#8b5cf6',
        'bg'    => '#faf5ff',
        'title' => get_string('forum_type_blog_title', 'local_istikama_admin'),
        'desc'  => get_string('forum_type_blog_desc',  'local_istikama_admin'),
    ],
    'single' => [
        'icon'  => 'fa-align-left',
        'color' => '#ec4899',
        'bg'    => '#fdf2f8',
        'title' => get_string('forum_type_single_title', 'local_istikama_admin'),
        'desc'  => get_string('forum_type_single_desc',  'local_istikama_admin'),
    ],
    'eachuser' => [
        'icon'  => 'fa-user',
        'color' => '#64748b',
        'bg'    => '#f8fafc',
        'title' => get_string('forum_type_eachuser_title', 'local_istikama_admin'),
        'desc'  => get_string('forum_type_eachuser_desc',  'local_istikama_admin'),
    ],
];
?>

<style>
.isti-ftype-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    max-width: 860px;
    margin: 0 auto;
}
@media (max-width: 700px) {
    .isti-ftype-grid { grid-template-columns: 1fr 1fr; }
}
@media (max-width: 460px) {
    .isti-ftype-grid { grid-template-columns: 1fr; }
}
.isti-ftype-card {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 20px 18px;
    border: 2px solid #e2e8f0;
    border-radius: 14px;
    background: #ffffff;
    text-decoration: none;
    color: inherit;
    transition: border-color .15s, box-shadow .15s, transform .12s;
    cursor: pointer;
}
.isti-ftype-card:hover {
    border-color: var(--card-accent, #006bff);
    box-shadow: 0 4px 16px rgba(0,0,0,.08);
    transform: translateY(-2px);
    color: inherit;
    text-decoration: none;
}
.isti-ftype-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 46px;
    height: 46px;
    border-radius: 12px;
    font-size: 1.2rem;
    margin-bottom: 12px;
    flex-shrink: 0;
}
.isti-ftype-title {
    font-weight: 700;
    font-size: .95rem;
    color: #1e293b;
    margin-bottom: 5px;
}
.isti-ftype-desc {
    font-size: .8rem;
    color: #64748b;
    line-height: 1.5;
}
</style>

<div class="container-fluid" dir="<?= $dir ?>" style="background:#f1f5f9;min-height:600px;margin:-24px;padding:24px;">

  <!-- Back / title row -->
  <div style="display:flex;align-items:center;gap:12px;margin-bottom:22px;flex-wrap:wrap">
    <a href="<?= $cancelurl->out(false) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
      <i class="fa fa-arrow-left"></i> <?= get_string('back_to_lesson', 'local_istikama_admin') ?>
    </a>
    <div>
      <h5 style="margin:0;font-weight:700;color:#1e293b"><?= get_string('addforum_heading', 'local_istikama_admin') ?></h5>
      <div style="font-size:.82rem;color:#64748b;margin-top:2px">
        <i class="fa fa-book-open"></i> <?= format_string($course->fullname) ?>
        · <?= get_string('section_label', 'local_istikama_admin') ?> <?= (int)$sectionnum ?>
      </div>
    </div>
  </div>

  <p style="text-align:center;color:#64748b;font-size:.9rem;margin-bottom:24px">
    <?= get_string('addforum_choose', 'local_istikama_admin') ?>
  </p>

  <!-- Centered type grid -->
  <div class="isti-ftype-grid">
    <?php foreach ($forum_types as $type => $meta):
        $url = new moodle_url($modedit_base, ['type' => $type]);
    ?>
    <a href="<?= $url->out(false) ?>"
       class="isti-ftype-card"
       style="--card-accent:<?= $meta['color'] ?>">
      <span class="isti-ftype-icon" style="background:<?= $meta['bg'] ?>;color:<?= $meta['color'] ?>">
        <i class="fa <?= $meta['icon'] ?>"></i>
      </span>
      <div class="isti-ftype-title"><?= $meta['title'] ?></div>
      <div class="isti-ftype-desc"><?= $meta['desc'] ?></div>
    </a>
    <?php endforeach; ?>
  </div>

</div>
<?php
echo '</div></div>';
echo $OUTPUT->footer();
