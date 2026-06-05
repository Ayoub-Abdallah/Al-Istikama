<?php
/**
 * Add Content From Library — Teacher flow.
 *
 * Lists approved library items (istikama_content_bank) and, on submit,
 * creates a native Moodle course module instance (mod_resource for files,
 * mod_url for external links) attached to the requested course section.
 *
 * Entered from teacher.php section=classview or the custom "+ Add"
 * intercept on /course/view.php for teachers.
 *
 * Query params:
 *   courseid    (int)    target course id
 *   sectionnum  (int)    target section number (0 = general; 1+ = topic)
 *   sectionid   (int)    optional section row id (not required, sectionnum drives placement)
 *   beforemod   (int)    optional course_modules.id to insert before
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/course/modlib.php');
require_once($CFG->dirroot . '/mod/resource/locallib.php'); // RESOURCELIB_DISPLAY_AUTO
require_once($CFG->dirroot . '/mod/resource/lib.php');
require_once($CFG->dirroot . '/mod/url/lib.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_target_user();

global $DB, $PAGE, $OUTPUT, $USER;

$courseid   = required_param('courseid', PARAM_INT);
$sectionnum = optional_param('sectionnum', 0, PARAM_INT);
$beforemod  = optional_param('beforemod', 0, PARAM_INT);
$action     = optional_param('action', '', PARAM_ALPHA);

$course = $DB->get_record('course', ['id' => $courseid], '*', MUST_EXIST);
$ctx    = context_course::instance($course->id);
require_capability('moodle/course:manageactivities', $ctx);

$PAGE->set_url(new moodle_url('/local/istikama_admin/add_library_content.php', ['courseid' => $courseid]));
$PAGE->set_context($ctx);
$PAGE->set_course($course);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('addlib_page_title', 'local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

// ── POST: attach a library item to the course ─────────────────────────────
if ($action === 'attach' && confirm_sesskey()) {
    $contentid = required_param('content_id', PARAM_INT);
    $item = $DB->get_record('istikama_content_bank', ['id' => $contentid, 'status' => 'approved'], '*', MUST_EXIST);

    // Resolve the actual file (if any) attached to this content_bank row.
    $fs = get_file_storage();
    $sysctx = context_system::instance();
    $files = $fs->get_area_files($sysctx->id, 'local_istikama_admin', 'content', $item->id, 'id', false);
    $first_file = !empty($files) ? reset($files) : null;

    // Decide module: external URL → mod_url; file or otherwise → mod_resource.
    $is_external = !empty($item->external_url);
    $modulename  = $is_external ? 'url' : ($first_file ? 'resource' : 'page');

    // Build moduleinfo object.
    $mi = new stdClass();
    $mi->modulename = $modulename;
    $mi->course     = $course->id;
    $mi->section    = $sectionnum;
    $mi->visible    = 1;
    $mi->name       = $item->name;
    $mi->introeditor = [
        'text'   => (string)$item->description,
        'format' => FORMAT_HTML,
        'itemid' => 0,
    ];

    if ($modulename === 'url') {
        $mi->externalurl = $item->external_url;
        $mi->display = 0; // auto
        $mi->printintro = !empty($item->description) ? 1 : 0;
    }

    if ($modulename === 'resource') {
        // We need to clone the stored file into a draft area so add_moduleinfo can move it.
        $usercontext = context_user::instance($USER->id);
        $draftitemid = file_get_unused_draft_itemid();
        $fs->create_file_from_storedfile([
            'contextid' => $usercontext->id,
            'component' => 'user',
            'filearea'  => 'draft',
            'itemid'    => $draftitemid,
            'filepath'  => '/',
            'filename'  => $first_file->get_filename(),
        ], $first_file);
        $mi->files = $draftitemid;
        // RESOURCELIB_DISPLAY_AUTO is defined in mod/resource/locallib.php (required above).
        // Use defined() as a defensive fallback in case the include path changes.
        $mi->display = defined('RESOURCELIB_DISPLAY_AUTO') ? RESOURCELIB_DISPLAY_AUTO : 0;
        $mi->printintro = !empty($item->description) ? 1 : 0;
        $mi->showsize = 0;
        $mi->showtype = 0;
        $mi->showdate = 0;
        $mi->filterfiles = 0;
    }

    if ($modulename === 'page') {
        // No file, no URL — fall back to a Page with the description text.
        $mi->page = ['text' => (string)$item->description, 'format' => FORMAT_HTML, 'itemid' => 0];
        $mi->display = 0;
        $mi->printheading = 1;
        $mi->printintro = 0;
    }

    if ($beforemod) {
        $mi->beforemod = $beforemod;
    }

    $newcm = create_module($mi);

    // Audit link (so we can show "linked from library" on student-facing UI if needed later).
    try {
        $DB->insert_record('istikama_content_lesson_link', (object)[
            'content_id'  => $item->id,
            'courseid'    => $course->id,
            'classid'     => 0,
            'linked_by'   => $USER->id,
            'timecreated' => time(),
        ], false, true);
    } catch (\Exception $e) {
        // Non-fatal: the module is already created. Audit is best-effort.
    }

    \core\notification::success(get_string('content_added_success', 'local_istikama_admin', format_string($item->name)));
    redirect(new moodle_url('/course/view.php', ['id' => $course->id, 'sectionid' => $sectionnum]));
}

require_once(__DIR__ . '/admin_layout.php');

// ── Filters ────────────────────────────────────────────────────────────────
$f_type   = optional_param('ctype', '', PARAM_ALPHA);
$f_search = optional_param('q', '', PARAM_TEXT);

$where  = "status = 'approved'";
$params = [];
if ($f_search) {
    $where .= ' AND (' . $DB->sql_like('name', ':sq1', false) . ' OR ' . $DB->sql_like('keywords', ':sq2', false) . ' OR ' . $DB->sql_like('description', ':sq3', false) . ')';
    $like = '%' . $DB->sql_like_escape($f_search) . '%';
    $params['sq1'] = $like; $params['sq2'] = $like; $params['sq3'] = $like;
}
if ($f_type) {
    $where .= ' AND content_type = :ftype';
    $params['ftype'] = $f_type;
}
$items = $DB->get_records_select('istikama_content_bank', $where, $params, 'timecreated DESC', '*', 0, 200);

$type_meta = [
    'document' => ['fa-file-alt',  '#006bff', 'Document'],
    'video'    => ['fa-video',     '#8b5cf6', 'Video'],
    'h5p'      => ['fa-cube',      '#f59e0b', 'H5P'],
    'book'     => ['fa-book',      '#10b981', 'Book'],
    'link'     => ['fa-link',      '#06b6d4', 'Link'],
    'quiz'     => ['fa-question-circle', '#ec4899', 'Quiz'],
];

$dir       = right_to_left() ? 'rtl' : 'ltr';
$cancelurl = new moodle_url('/course/view.php', ['id' => $course->id]);
$baseurl   = new moodle_url('/local/istikama_admin/add_library_content.php', [
    'courseid' => $courseid, 'sectionnum' => $sectionnum, 'beforemod' => $beforemod,
]);
?>
<div class="container-fluid" dir="<?= $dir ?>" style="background:#f1f5f9;min-height:600px;margin:-24px;padding:24px;">

    <!-- Header -->
    <div class="isti-card" style="padding:20px 24px;margin-bottom:18px;display:flex;align-items:center;gap:14px;flex-wrap:wrap">
        <a href="<?= $cancelurl->out(false) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-arrow-left"></i> <?= get_string('back_to_lesson', 'local_istikama_admin') ?>
        </a>
        <span style="display:inline-flex;align-items:center;justify-content:center;width:46px;height:46px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.2rem">
            <i class="fa fa-folder-open"></i>
        </span>
        <div style="flex:1;min-width:200px">
            <h5 style="margin:0;font-weight:700;color:#1e293b"><?= get_string('addlib_page_title', 'local_istikama_admin') ?></h5>
            <div style="font-size:.85rem;color:#64748b;margin-top:4px">
                <i class="fa fa-book-open"></i> <?= format_string($course->fullname) ?>
                · <?= get_string('section_label', 'local_istikama_admin') ?> <?= (int)$sectionnum ?>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="isti-card" style="padding:12px 18px;margin-bottom:16px;display:flex;gap:10px;align-items:center;flex-wrap:wrap">
        <form method="get" style="display:contents">
            <input type="hidden" name="courseid"   value="<?= (int)$courseid ?>">
            <input type="hidden" name="sectionnum" value="<?= (int)$sectionnum ?>">
            <?php if ($beforemod): ?>
            <input type="hidden" name="beforemod"  value="<?= (int)$beforemod ?>">
            <?php endif; ?>
            <select name="ctype" class="isti-form-select" style="max-width:170px;font-size:.88rem">
                <option value=""><?= get_string('all_types', 'local_istikama_admin') ?></option>
                <?php foreach ($type_meta as $k => [$ico, $clr, $lbl]): ?>
                <option value="<?= $k ?>" <?= $f_type === $k ? 'selected' : '' ?>><?= $lbl ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="q" value="<?= s($f_search) ?>" placeholder="<?= get_string('addlib_search_ph', 'local_istikama_admin') ?>" class="isti-form-input" style="flex:1;min-width:200px;font-size:.88rem">
            <button type="submit" class="isti-btn isti-btn-primary"><i class="fa fa-search"></i> <?= get_string('filter_apply', 'local_istikama_admin') ?></button>
            <?php if ($f_search || $f_type): ?>
            <a href="<?= $baseurl->out(false) ?>" class="isti-btn isti-btn-outline"><?= get_string('filter_reset', 'local_istikama_admin') ?></a>
            <?php endif; ?>
        </form>
    </div>

    <?php if (empty($items)): ?>
    <div class="isti-card" style="text-align:center;padding:64px 20px;color:#94a3b8">
        <i class="fa fa-inbox" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
        <p style="color:#475569;font-size:1rem;font-weight:500"><?= get_string('no_library_content', 'local_istikama_admin') ?></p>
        <p style="font-size:.88rem;color:#94a3b8"><?= get_string('no_library_content_hint', 'local_istikama_admin') ?></p>
    </div>
    <?php else: ?>
    <div class="isti-card" style="padding:0;overflow:hidden">
        <div class="table-responsive">
            <table class="isti-table">
                <thead><tr>
                    <th style="width:54px"></th>
                    <th><?= get_string('col_title', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_type', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_subject', 'local_istikama_admin') ?></th>
                    <th style="text-align:right"><?= get_string('col_added', 'local_istikama_admin') ?></th>
                    <th style="text-align:center;width:120px"><?= get_string('col_preview', 'local_istikama_admin') ?></th>
                    <th style="text-align:center;width:170px"><?= get_string('col_action', 'local_istikama_admin') ?></th>
                </tr></thead>
                <tbody>
                    <?php foreach ($items as $item):
                        [$ico, $clr, $lbl] = $type_meta[$item->content_type] ?? ['fa-file', '#64748b', ucfirst($item->content_type)];
                        $previewurl = '';
                        if (!empty($item->external_url)) { $previewurl = $item->external_url; }
                        elseif (!empty($item->filename)) {
                            $sysctx = context_system::instance();
                            $previewurl = moodle_url::make_pluginfile_url($sysctx->id, 'local_istikama_admin', 'content', $item->id, '/', $item->filename)->out(false);
                        }
                    ?>
                    <tr>
                        <td><span class="isti-qtype-pill" style="background:<?= $clr ?>15;color:<?= $clr ?>"><i class="fa <?= $ico ?>"></i></span></td>
                        <td>
                            <strong><?= format_string($item->name) ?></strong>
                            <?php if (!empty($item->description)): ?>
                            <div style="font-size:.8rem;color:#64748b;margin-top:2px"><?= s(substr(strip_tags($item->description), 0, 110)) ?></div>
                            <?php endif; ?>
                        </td>
                        <td><span class="isti-badge" style="background:<?= $clr ?>15;color:<?= $clr ?>"><?= $lbl ?></span></td>
                        <td><?= s($item->subject ?: '—') ?></td>
                        <td style="text-align:right;font-size:.82rem;color:#64748b"><?= userdate($item->timecreated, get_string('strftimedatetimeshort', 'langconfig')) ?></td>
                        <td style="text-align:center">
                            <?php if ($previewurl): ?>
                            <a href="<?= s($previewurl) ?>" class="isti-icon-btn" title="Preview" target="_blank" rel="noopener"><i class="fa fa-eye"></i></a>
                            <?php else: ?><span style="color:#cbd5e1">—</span><?php endif; ?>
                        </td>
                        <td style="text-align:center">
                            <form method="post" action="<?= $baseurl->out(false) ?>" style="display:inline">
                                <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                                <input type="hidden" name="action" value="attach">
                                <input type="hidden" name="content_id" value="<?= (int)$item->id ?>">
                                <button type="submit" class="isti-btn isti-btn-primary" style="padding:5px 12px;font-size:.85rem">
                                    <i class="fa fa-plus"></i> <?= get_string('btn_add_to_lesson', 'local_istikama_admin') ?>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div style="font-size:.82rem;color:#94a3b8;margin-top:8px;text-align:right"><?= get_string('items_shown', 'local_istikama_admin', count($items)) ?></div>
    <?php endif; ?>
</div>
<?php
echo '</div></div>';
echo $OUTPUT->footer();
