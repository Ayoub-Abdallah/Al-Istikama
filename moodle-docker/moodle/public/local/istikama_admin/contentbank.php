<?php
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/contentbank/classes/contentbank.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_target_user();
$context = context_system::instance();
$baseurl = new moodle_url('/local/istikama_admin/contentbank.php');

// Detect school manager scope.
$tier = local_istikama_admin_get_user_tier();
$is_sm = ($tier === 'school_manager');
$sm_schoolid = null;
if ($is_sm) {
    $sm_schoolid = local_istikama_admin_get_manager_school();
    if (!$sm_schoolid) {
        throw new \moodle_exception('sm_no_school_assigned', 'local_istikama_admin');
    }
}

$PAGE->set_url($baseurl);
$PAGE->set_context($context);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('contentbank_title', 'local_istikama_admin'));

// Load our custom CSS.
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css?v=12');

require_once('admin_layout.php');

// ---- Handle Actions (upload) ----
$action = optional_param('action', '', PARAM_ALPHA);
$contentid = optional_param('contentid', 0, PARAM_INT);

if ($action && confirm_sesskey()) {
    global $DB, $USER;

    if ($action === 'upload') {
        $ctype = required_param('content_type', PARAM_ALPHA);
        $name  = required_param('content_name', PARAM_TEXT);
        $subject  = optional_param('subject', '', PARAM_TEXT);
        $level    = optional_param('level', '', PARAM_TEXT);
        $lesson   = optional_param('lesson', '', PARAM_TEXT);
        $category = optional_param('content_category', 'main', PARAM_ALPHA);
        $description = optional_param('description', '', PARAM_RAW);
        $keywords    = optional_param('keywords', '', PARAM_TEXT);
        $external_url = optional_param('external_url', '', PARAM_URL);

        $record = new stdClass();
        $record->name = $name;
        $record->content_type = $ctype;
        $record->subject = $subject;
        $record->level = $level;
        $record->lesson = $lesson;
        $record->category = $category;
        $record->description = $description;
        $record->keywords = $keywords;
        $record->external_url = $external_url;
        $record->status = 'pending';
        $record->uploaded_by = $USER->id;
        $record->timecreated = time();
        $record->timemodified = time();

        // Handle file upload if present.
        $draftitemid = optional_param('content_file', 0, PARAM_INT);
        if ($draftitemid) {
            $record->file_itemid = $draftitemid;
            $fs = get_file_storage();
            $usercontext = context_user::instance($USER->id);
            $files = $fs->get_area_files($usercontext->id, 'user', 'draft', $draftitemid, 'id', false);
            if (!empty($files)) {
                $file = reset($files);
                $record->filename = $file->get_filename();

                // Save file permanently.
                $newid = $DB->insert_record('istikama_content_bank', $record);

                $filerecord = [
                    'contextid' => $context->id,
                    'component' => 'local_istikama_admin',
                    'filearea'  => 'content',
                    'itemid'    => $newid,
                    'filepath'  => '/',
                    'filename'  => $file->get_filename(),
                ];
                $fs->create_file_from_storedfile($filerecord, $file);

                \core\notification::success(get_string('content_uploaded', 'local_istikama_admin'));
                redirect(new moodle_url('/local/istikama_admin/contentbank.php', ['tab' => 'upload-file']));
            }
        }

        // No file — just URL or metadata-only content.
        $DB->insert_record('istikama_content_bank', $record);
        \core\notification::success(get_string('content_uploaded', 'local_istikama_admin'));
        redirect(new moodle_url('/local/istikama_admin/contentbank.php', ['tab' => 'upload-file']));
    }
}

// ---- Subjects and Levels (database-driven) ----
// Subjects: use the actual subject_names table so IDs match what the chooser queries.
$subjects = [];
if ($DB->get_manager()->table_exists('istikama_subject_names')) {
    $subject_rows = $DB->get_records('istikama_subject_names', [], 'name ASC');
    $seen_names = [];
    foreach ($subject_rows as $sr) {
        // Deduplicate by name (same subject can exist for multiple levels).
        if (!isset($seen_names[$sr->name])) {
            $subjects[(string)$sr->id] = format_string($sr->name);
            $seen_names[$sr->name] = true;
        }
    }
}
// Fallback if table is empty.
if (empty($subjects)) {
    $subjects = [
        'math' => get_string('subject_math', 'local_istikama_admin'),
        'science' => get_string('subject_science', 'local_istikama_admin'),
        'arabic' => get_string('subject_arabic', 'local_istikama_admin'),
        'french' => get_string('subject_french', 'local_istikama_admin'),
        'english' => get_string('subject_english', 'local_istikama_admin'),
        'islamic' => get_string('subject_islamic', 'local_istikama_admin'),
        'history' => get_string('subject_history', 'local_istikama_admin'),
        'physics' => get_string('subject_physics', 'local_istikama_admin'),
        'other' => get_string('subject_other', 'local_istikama_admin'),
    ];
}

// Levels: use the category ID as the value so it matches the chooser query exactly.
function get_istikama_schools_and_levels() {
    $data = ['schools' => [], 'levels_by_school' => [], 'all_levels' => []];
    if (class_exists('core_course_category')) {
        $topcats = core_course_category::top()->get_children();
        foreach ($topcats as $school) {
            $data['schools'][$school->id] = $school->get_formatted_name();
            $data['levels_by_school'][$school->id] = [];
            foreach ($school->get_children() as $level) {
                $lname = $level->get_formatted_name();
                // Use category ID as the key/value — this is what the chooser query matches on.
                $data['levels_by_school'][$school->id][(string)$level->id] = $lname;
                $data['all_levels'][(string)$level->id] = $lname;
            }
        }
    }
    return $data;
}

$school_level_data = get_istikama_schools_and_levels();
$schools = $school_level_data['schools'];
$levels = $school_level_data['all_levels'];
$levels_json = json_encode($school_level_data['levels_by_school']);

$categories_list = [
    'main' => get_string('category_main', 'local_istikama_admin'),
    'explanatory' => get_string('category_explanatory', 'local_istikama_admin'),
    'enrichment' => get_string('category_enrichment', 'local_istikama_admin'),
];

// Content types config.
$content_types = [
    'document' => ['fa' => 'fa-file-pdf',       'color' => 'c-document', 'name' => get_string('type_document', 'local_istikama_admin'), 'desc' => get_string('type_document_desc', 'local_istikama_admin')],
    'video'    => ['fa' => 'fa-play-circle',     'color' => 'c-video',    'name' => get_string('type_video', 'local_istikama_admin'),    'desc' => get_string('type_video_desc', 'local_istikama_admin')],
    'h5p'      => ['fa' => 'fa-layer-group',     'color' => 'c-h5p',      'name' => get_string('type_h5p', 'local_istikama_admin'),      'desc' => get_string('type_h5p_desc', 'local_istikama_admin')],
    'book'     => ['fa' => 'fa-book-open',       'color' => 'c-book',     'name' => get_string('type_book', 'local_istikama_admin'),     'desc' => get_string('type_book_desc', 'local_istikama_admin')],
    'quiz'     => ['fa' => 'fa-question-circle', 'color' => 'c-quiz',     'name' => get_string('type_quiz', 'local_istikama_admin'),     'desc' => get_string('type_quiz_desc', 'local_istikama_admin')],
    'link'     => ['fa' => 'fa-link',            'color' => 'c-link',     'name' => get_string('type_link', 'local_istikama_admin'),     'desc' => get_string('type_link_desc', 'local_istikama_admin')],
];

// Fetch digital library data. PARAM_ALPHAEXT — status keys like 'approved_temp'
// contain underscores which PARAM_ALPHA would silently strip.
$search_q     = optional_param('q', '', PARAM_TEXT);
$filter_type  = optional_param('ftype',   '', PARAM_ALPHAEXT);
$filter_subj  = optional_param('fsubj',   '', PARAM_ALPHAEXT);
$filter_lvl   = optional_param('flvl',    '', PARAM_ALPHAEXT);
$filter_cat   = optional_param('fcat',    '', PARAM_ALPHAEXT);
$filter_status = optional_param('fstatus','', PARAM_ALPHAEXT);

$active_tab = optional_param('tab', 'digital-library', PARAM_ALPHAEXT);

// Build SQL for digital library. By default we now show ALL non-archived content;
// the status filter narrows it. The OLD "approved only" gate is dropped — the
// library page is also where moderation happens.
if ($filter_status !== '') {
    $lib_where  = "status = :fstatus";
    $lib_params = ['fstatus' => $filter_status];
} else {
    $lib_where  = "1=1";
    $lib_params = [];
}

// School manager: filter to only content from their school's users.
if ($is_sm && $sm_schoolid) {
    $lib_where .= " AND uploaded_by IN (SELECT us.userid FROM {istikama_user_school} us WHERE us.schoolid = :smschoolid)";
    $lib_params['smschoolid'] = $sm_schoolid;
}

// Text search hits name + keywords + description.
if ($search_q !== '') {
    $lib_where .= " AND (" . $DB->sql_like('name', ':q1', false) . " OR " .
                  $DB->sql_like('keywords', ':q2', false) . " OR " .
                  $DB->sql_like('description', ':q3', false) . ")";
    $lib_params['q1'] = "%{$search_q}%";
    $lib_params['q2'] = "%{$search_q}%";
    $lib_params['q3'] = "%{$search_q}%";
}
if ($filter_type) { $lib_where .= " AND content_type = :ftype"; $lib_params['ftype'] = $filter_type; }
if ($filter_cat)  { $lib_where .= " AND category     = :fcat";  $lib_params['fcat']  = $filter_cat;  }

// Multi-subject + multi-level filters: match either the denormalized single
// column OR any row in the M:N tables. Falls back gracefully if M:N tables
// don't exist yet (pre-upgrade).
if ($filter_subj && $DB->get_manager()->table_exists('istikama_content_subjects')) {
    $lib_where .= " AND (subject = :fsubj OR id IN (SELECT content_id FROM {istikama_content_subjects} WHERE subject_key = :fsubj2))";
    $lib_params['fsubj']  = $filter_subj;
    $lib_params['fsubj2'] = $filter_subj;
} else if ($filter_subj) {
    $lib_where .= " AND subject = :fsubj";
    $lib_params['fsubj'] = $filter_subj;
}
if ($filter_lvl && $DB->get_manager()->table_exists('istikama_content_levels')) {
    $lib_where .= " AND (level = :flvl OR id IN (SELECT content_id FROM {istikama_content_levels} WHERE level_key = :flvl2))";
    $lib_params['flvl']  = $filter_lvl;
    $lib_params['flvl2'] = $filter_lvl;
} else if ($filter_lvl) {
    $lib_where .= " AND level = :flvl";
    $lib_params['flvl'] = $filter_lvl;
}

global $DB;
$library_contents = [];
if ($DB->get_manager()->table_exists('istikama_content_bank')) {
    // Check if 'name' column exists (post-upgrade).
    try {
        $library_contents = $DB->get_records_select('istikama_content_bank', $lib_where, $lib_params, 'timecreated DESC');
    } catch (Exception $e) {
        $library_contents = [];
    }
}

// Get content statuses registry
$all_statuses = local_istikama_admin_get_content_statuses();

// Filter for validation tab. PARAM_ALPHAEXT — status keys like 'approved_temp'
// contain underscores which PARAM_ALPHA would silently strip.
$val_status = optional_param('val_status', 'all', PARAM_ALPHAEXT);

// Canonical moderation statuses. Single source of truth — the same set used
// everywhere else (preview modal dropdown, Digital Library filter, etc.).
$canonical_statuses = array_keys(\local_istikama_admin\content_manager::get_statuses());
// Default to viewing pending-side work when "all" is chosen on the validation tab.
$review_statuses = ['pending', 'reviewing'];

if ($val_status !== 'all' && !in_array($val_status, $canonical_statuses, true)) {
    $val_status = 'all';
}

// Validation contents
$validation_contents = [];
$status_counts = [];

try {
    $base_where = "1=1";
    $base_params = [];
    if ($is_sm && $sm_schoolid) {
        $base_where = "uploaded_by IN (SELECT us.userid FROM {istikama_user_school} us WHERE us.schoolid = :sid)";
        $base_params['sid'] = $sm_schoolid;
    }

    // Initialize counts for the canonical 6 statuses only.
    foreach ($canonical_statuses as $st) {
        $status_counts[$st] = 0;
    }

    // Get counts per status.
    $counts_sql = "SELECT status, COUNT(1) AS c FROM {istikama_content_bank} WHERE $base_where GROUP BY status";
    $counts = $DB->get_records_sql($counts_sql, $base_params);
    foreach ($counts as $st => $rec) {
        if (array_key_exists($st, $status_counts)) {
            $status_counts[$st] = (int)$rec->c;
        }
    }

    // Items shown in the validation table.
    $val_where = $base_where;
    $val_params = $base_params;
    if ($val_status === 'all') {
        // "All" on the validation tab = work-in-progress (pending + reviewing).
        list($in_sql, $in_params) = $DB->get_in_or_equal($review_statuses, SQL_PARAMS_NAMED, 'st');
        $val_where .= " AND status $in_sql";
        $val_params = array_merge($val_params, $in_params);
    } else {
        $val_where .= " AND status = :vst";
        $val_params['vst'] = $val_status;
    }

    $validation_contents = $DB->get_records_select('istikama_content_bank', $val_where, $val_params, 'timecreated ASC');

} catch (Exception $e) {
    // Table might not have new columns yet — pre-upgrade.
}

// Fetch tags for all displayed content (library + validation).
$all_displayed_ids = [];
if (!empty($library_contents))    $all_displayed_ids = array_merge($all_displayed_ids, array_keys($library_contents));
if (!empty($validation_contents)) $all_displayed_ids = array_merge($all_displayed_ids, array_keys($validation_contents));

$content_tags = [];
if (!empty($all_displayed_ids)) {
    try {
        list($in_sql, $in_params) = $DB->get_in_or_equal($all_displayed_ids);
        $rs = $DB->get_recordset_select('istikama_content_tags', "content_id $in_sql", $in_params);
        foreach ($rs as $tag) {
            $content_tags[$tag->content_id][] = $tag;
        }
        $rs->close();
    } catch (Exception $e) {}
}

// KPI totals — pulled from the canonical-status counts only.
$pending_total       = $status_counts['pending']       ?? 0;
$reviewing_total     = $status_counts['reviewing']     ?? 0;
$approved_total      = $status_counts['approved']      ?? 0;
$approved_temp_total = $status_counts['approved_temp'] ?? 0;
$rejected_total      = $status_counts['rejected']      ?? 0;
$archived_total      = $status_counts['archived']      ?? 0;

// Helper: get type icon.
function istikama_type_icon($type) {
    $icons = ['document' => '📄', 'video' => '🎥', 'h5p' => '📦', 'book' => '📖', 'quiz' => '❓', 'link' => '🔗'];
    return $icons[$type] ?? '📁';
}

// Helper: render star rating.
function istikama_render_stars($rating, $max = 5) {
    $html = '<span class="istikama-stars">';
    for ($i = 1; $i <= $max; $i++) {
        $html .= ($i <= round($rating)) ? '★' : '<span class="empty">★</span>';
    }
    $html .= '</span>';
    return $html;
}

// Helper: get average rating for a content.
function istikama_avg_rating($contentid) {
    global $DB;
    try {
        $avg = $DB->get_field_sql("SELECT AVG(rating) FROM {istikama_content_ratings} WHERE content_id = ?", [$contentid]);
        return $avg ? round($avg, 1) : 0;
    } catch (Exception $e) {
        return 0;
    }
}

// Helper: get user fullname.
function istikama_user_fullname($userid) {
    global $DB;
    $user = $DB->get_record('user', ['id' => $userid], 'firstname, lastname');
    return $user ? fullname($user) : '—';
}

// --- File picker draft area for upload form ---
$draftitemid = file_get_unused_draft_itemid();

$dir = right_to_left() ? 'rtl' : 'ltr';
$textalign = right_to_left() ? 'right' : 'left';
?>

<div class="container-fluid" dir="<?= $dir ?>" style="text-align: <?= $textalign ?>;">

    <div class="isti-tabs" id="contentBankTabs">
        <?php
        // Each tab can declare a custom 'url' to navigate elsewhere instead of
        // switching the inner tab body — Quiz Bank now points directly at
        // /local/istikama_admin/activities.php as a real navigation link.
        $cb_tabs = [
            'digital-library' => ['icon' => 'fa-book-open',         'label' => get_string('digital_library', 'local_istikama_admin'),    'badge' => 0],
            'upload-file'     => ['icon' => 'fa-cloud-upload-alt',  'label' => get_string('upload_content', 'local_istikama_admin'),     'badge' => 0],
            'validation'      => ['icon' => 'fa-check-circle',      'label' => get_string('validation_workflow', 'local_istikama_admin'),'badge' => ($pending_total + $reviewing_total)],
            'quiz-bank'       => ['icon' => 'fa-question-circle',   'label' => get_string('quizbank', 'local_istikama_admin'),           'badge' => 0,
                                  'url'  => (new moodle_url('/local/istikama_admin/activities.php'))->out(false)],
        ];
        foreach ($cb_tabs as $tkey => $tdef):
            $turl = $tdef['url'] ?? (new moodle_url('/local/istikama_admin/contentbank.php', ['tab' => $tkey]))->out(true);
            $isactive = ($active_tab === $tkey) && empty($tdef['url']);
        ?>
        <a href="<?= $turl ?>"
           class="isti-tab <?= $isactive ? 'active' : '' ?>"
           role="tab"
           aria-selected="<?= $isactive ? 'true' : 'false' ?>">
            <i class="fa <?= $tdef['icon'] ?>"></i> <?= $tdef['label'] ?>
            <?php if ($tdef['badge'] > 0): ?><span class="isti-nav-badge"><?= $tdef['badge'] ?></span><?php endif; ?>
        </a>
        <?php endforeach; ?>
    </div>

    <div class="tab-content" id="contentBankTabsContent" style="margin-top:20px">

        <!-- ==================== DIGITAL LIBRARY ==================== -->
        <div id="digital-library" style="<?= $active_tab !== 'digital-library' ? 'display:none' : '' ?>">

            <!-- Filter Bar — rebuilt as a CSS grid so the search input is wide
                 and all controls align cleanly regardless of viewport width. -->
            <form method="get" action="<?= $baseurl->out(false) ?>"
                  style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:14px 16px;margin-bottom:18px;
                         display:grid;grid-template-columns:minmax(240px,2fr) repeat(4,minmax(150px,1fr)) auto auto;
                         gap:10px;align-items:end;">
                <input type="hidden" name="tab" value="digital-library">

                <!-- Wide search input. Backend already searches name|description|keywords. -->
                <div>
                    <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:4px;">
                        <i class="fa fa-search" style="color:#006bff;"></i>
                        <?= get_string('lib_search_label', 'local_istikama_admin') ?>
                    </label>
                    <input type="text" name="q"
                           placeholder="<?= get_string('lib_search_placeholder', 'local_istikama_admin') ?>"
                           value="<?= s($search_q) ?>"
                           style="width:100%;padding:9px 12px;border:1px solid #cbd5e1;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>

                <div>
                    <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:4px;"><?= get_string('content_type', 'local_istikama_admin') ?></label>
                    <select name="ftype" style="width:100%;padding:9px 10px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;background:#fff;box-sizing:border-box;">
                        <option value=""><?= get_string('all_types', 'local_istikama_admin') ?></option>
                        <?php foreach ($content_types as $k => $ct): ?>
                            <option value="<?= $k ?>" <?= $filter_type === $k ? 'selected' : '' ?>><?= $ct['name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:4px;"><?= get_string('content_subject', 'local_istikama_admin') ?></label>
                    <select name="fsubj" style="width:100%;padding:9px 10px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;background:#fff;box-sizing:border-box;">
                        <option value=""><?= get_string('all_subjects', 'local_istikama_admin') ?></option>
                        <?php foreach ($subjects as $k => $v): ?>
                            <option value="<?= $k ?>" <?= $filter_subj === $k ? 'selected' : '' ?>><?= $v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:4px;"><?= get_string('content_level', 'local_istikama_admin') ?></label>
                    <select name="flvl" style="width:100%;padding:9px 10px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;background:#fff;box-sizing:border-box;">
                        <option value=""><?= get_string('all_levels', 'local_istikama_admin') ?></option>
                        <?php foreach ($levels as $k => $v): ?>
                            <option value="<?= $k ?>" <?= $filter_lvl === $k ? 'selected' : '' ?>><?= $v ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:4px;"><?= get_string('status', 'local_istikama_admin') ?></label>
                    <?php $filter_status = optional_param('fstatus', '', PARAM_ALPHAEXT); ?>
                    <select name="fstatus" style="width:100%;padding:9px 10px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;background:#fff;box-sizing:border-box;">
                        <option value=""><?= get_string('all', 'local_istikama_admin') ?></option>
                        <?php foreach (\local_istikama_admin\content_manager::get_statuses() as $sk => $sm): ?>
                            <option value="<?= s($sk) ?>" <?= $filter_status === $sk ? 'selected' : '' ?>><?= s($sm['label']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" style="padding:9px 18px;background:#006bff;color:white;border:0;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;align-self:end;">
                    <i class="fa fa-filter"></i> <?= get_string('filter_apply', 'local_istikama_admin') ?>
                </button>
                <a href="<?= new moodle_url('/local/istikama_admin/contentbank.php', ['tab' => 'digital-library']) ?>"
                   style="padding:9px 16px;border:1px solid #cbd5e1;border-radius:8px;color:#475569;text-decoration:none;font-size:13px;align-self:end;background:#fff;">
                    <?= get_string('filter_reset', 'local_istikama_admin') ?>
                </a>
            </form>

            <?php if (empty($library_contents)): ?>
                <div style="text-align:center;padding:50px 20px;color:#94a3b8">
                    <i class="fa fa-book-open" style="font-size:3rem;margin-bottom:12px;display:block;color:#cbd5e1"></i>
                    <?php if ($search_q || $filter_type || $filter_subj || $filter_lvl || $filter_cat): ?>
                        <p style="margin:0"><?= get_string('no_content_found', 'local_istikama_admin') ?></p>
                    <?php else: ?>
                        <p style="margin:0"><?= get_string('no_content_yet', 'local_istikama_admin') ?></p>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="isti-card-modern" style="overflow:hidden">
                    <div class="table-responsive">
                        <table class="isti-table isti-table-striped">
                            <thead><tr>
                                <th><?= get_string('content_type', 'local_istikama_admin') ?></th>
                                <th><?= get_string('name', 'local_istikama_admin') ?></th>
                                <th><?= get_string('content_subject', 'local_istikama_admin') ?></th>
                                <th><?= get_string('content_level', 'local_istikama_admin') ?></th>
                                <th><?= get_string('uploaded_by', 'local_istikama_admin') ?></th>
                                <th><?= get_string('status', 'local_istikama_admin') ?></th>
                                <th><?= get_string('lib_keywords_col', 'local_istikama_admin') ?></th>
                                <th style="text-align:center"><?= get_string('actions', 'local_istikama_admin') ?></th>
                            </tr></thead>
                            <tbody>
                                <?php
                                $type_fa = ['document'=>'fa-file-alt','video'=>'fa-video','h5p'=>'fa-cube','book'=>'fa-book','quiz'=>'fa-question-circle','link'=>'fa-link'];
                                $type_clr = ['document'=>'#f59e0b','video'=>'#3b82f6','h5p'=>'#8b5cf6','book'=>'#10b981','quiz'=>'#ec4899','link'=>'#06b6d4'];
                                foreach ($library_contents as $item):
                                    $t = $item->content_type ?? 'document';
                                    $ico = $type_fa[$t] ?? 'fa-file'; $clr = $type_clr[$t] ?? '#64748b';
                                    $st = $item->status ?? 'pending';
                                    $c_st = $all_statuses[$st] ?? $all_statuses['pending'];
                                    $tags = $content_tags[$item->id] ?? [];
                                ?>
                                <tr>
                                    <td><span style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;background:<?= $clr ?>15;color:<?= $clr ?>"><i class="fa <?= $ico ?>"></i></span></td>
                                    <td><strong><?= format_string($item->name ?? $item->filename ?? 'Untitled') ?></strong></td>
                                    <td><?= isset($subjects[$item->subject ?? '']) ? $subjects[$item->subject] : '—' ?></td>
                                    <td><?= isset($levels[$item->level ?? '']) ? $levels[$item->level] : '—' ?></td>
                                    <td><?= istikama_user_fullname($item->uploaded_by) ?></td>
                                    <td><span style="padding:3px 12px;border-radius:20px;font-size:.75rem;font-weight:600;background:<?= $c_st['badge_bg'] ?>;color:<?= $c_st['badge_fg'] ?>"><i class="fa <?= $c_st['icon'] ?>" style="margin-right:4px"></i><?= $c_st['label'] ?></span></td>
                                    <td>
                                        <div style="display:flex;gap:4px;flex-wrap:wrap;align-items:center" id="tags-<?= $item->id ?>">
                                            <?php foreach ($tags as $tag): ?>
                                                <span class="isti-tag" style="background:#f1f5f9;border:1px solid #e2e8f0;padding:2px 8px;border-radius:12px;font-size:.75rem;color:#475569;display:inline-flex;align-items:center;gap:4px">
                                                    <?= s($tag->tag) ?>
                                                </span>
                                            <?php endforeach; ?>
                                            <button class="isti-btn-icon btn-edit-tags" data-id="<?= $item->id ?>" style="width:24px;height:24px;padding:0;background:none;border:1px dashed #cbd5e1;color:#64748b;border-radius:50%;cursor:pointer;display:inline-flex;align-items:center;justify-content:center" title="<?= get_string('cb_edit_tags', 'local_istikama_admin') ?>">
                                                <i class="fa fa-plus" style="font-size:.7rem"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td style="text-align:center">
                                        <!-- Preview now opens the in-page moderation modal (no more external page jumps). -->
                                        <button type="button" class="isti-btn isti-btn-outline isti-btn-sm isti-cb-preview-btn"
                                                data-id="<?= (int)$item->id ?>"
                                                title="<?= s(get_string('lib_preview_and_moderate', 'local_istikama_admin')) ?>">
                                            <i class="fa fa-play-circle"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- ==================== UPLOAD CONTENT ==================== -->
        <div id="upload-file" style="<?= $active_tab !== 'upload-file' ? 'display:none' : '' ?>">

            <!-- Type Chooser -->
            <div id="type-chooser-panel">
                <div style="margin-bottom:22px">
                    <h4 style="margin:0 0 4px;font-weight:700;color:#1e293b;font-size:1.15rem">
                        <i class="fa fa-th-large" style="color:#006bff;margin-right:8px"></i><?= get_string('choose_content_type', 'local_istikama_admin') ?>
                    </h4>
                    <p style="margin:0;color:#64748b;font-size:.88rem"><?= get_string('choose_content_type_desc', 'local_istikama_admin') ?></p>
                </div>
                <div class="istikama-type-chooser">
                    <?php foreach ($content_types as $key => $ct): ?>
                    <div class="istikama-type-card"
                         data-type="<?= $key ?>"
                         data-fa="fa <?= $ct['fa'] ?>"
                         data-color="<?= $ct['color'] ?>"
                         role="button" tabindex="0">
                        <div class="isti-type-icon-circle <?= $ct['color'] ?>">
                            <i class="fa <?= $ct['fa'] ?>"></i>
                        </div>
                        <div class="istikama-type-name"><?= $ct['name'] ?></div>
                        <div class="istikama-type-desc"><?= $ct['desc'] ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Upload Form (hidden until type selected) -->
            <div id="upload-form-panel" class="istikama-hidden">
                <button type="button" class="istikama-back-btn" id="btn-back-to-types">
                    <i class="fa fa-arrow-left"></i> <?= get_string('back_to_types', 'local_istikama_admin') ?>
                </button>

                <div class="isti-card" style="padding:28px">
                    <!-- Form header -->
                    <div style="display:flex;align-items:center;gap:14px;margin-bottom:24px;padding-bottom:18px;border-bottom:1px solid #f1f5f9">
                        <div id="form-type-icon-wrap" class="isti-type-icon-circle" style="width:52px;height:52px;font-size:1.4rem;margin:0"></div>
                        <div>
                            <div id="form-type-title" style="font-weight:700;font-size:1.05rem;color:#1e293b"></div>
                            <div style="font-size:.82rem;color:#94a3b8;margin-top:2px"><?= get_string('upload_content', 'local_istikama_admin') ?></div>
                        </div>
                    </div>

                    <form method="post" action="<?= $baseurl->out(false) ?>" enctype="multipart/form-data" id="upload-content-form">
                        <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                        <input type="hidden" name="action" value="upload">
                        <input type="hidden" name="tab" value="upload-file">
                        <input type="hidden" name="content_type" id="form-content-type" value="">

                        <!-- Content Name -->
                        <div class="isti-form-group" style="margin-bottom:18px">
                            <label class="isti-form-label"><?= get_string('content_name', 'local_istikama_admin') ?> <span style="color:#ef4444">*</span></label>
                            <input type="text" class="isti-form-input" id="content_name" name="content_name" required>
                        </div>

                        <!-- School / Level / Subject / Category row -->
                        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:16px;margin-bottom:18px">
                            <div class="isti-form-group">
                                <label class="isti-form-label"><?= get_string('content_school', 'local_istikama_admin') ?></label>
                                <select class="isti-form-select" id="school" name="school">
                                    <option value="">— <?= get_string('all', 'moodle') ?> —</option>
                                    <?php foreach ($schools as $k => $v): ?>
                                        <option value="<?= $k ?>"><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="isti-form-group">
                                <label class="isti-form-label"><?= get_string('content_level', 'local_istikama_admin') ?></label>
                                <select class="isti-form-select" id="level" name="level" disabled>
                                    <option value="">—</option>
                                </select>
                            </div>
                            <div class="isti-form-group">
                                <label class="isti-form-label"><?= get_string('content_subject', 'local_istikama_admin') ?></label>
                                <select class="isti-form-select" id="subject" name="subject">
                                    <option value="">—</option>
                                    <?php foreach ($subjects as $k => $v): ?>
                                        <option value="<?= $k ?>"><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="isti-form-group">
                                <label class="isti-form-label"><?= get_string('content_category', 'local_istikama_admin') ?></label>
                                <select class="isti-form-select" id="content_category" name="content_category">
                                    <?php foreach ($categories_list as $k => $v): ?>
                                        <option value="<?= $k ?>"><?= $v ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Lesson -->
                        <div class="isti-form-group" style="margin-bottom:18px">
                            <label class="isti-form-label"><?= get_string('content_lesson', 'local_istikama_admin') ?></label>
                            <input type="text" class="isti-form-input" id="lesson" name="lesson">
                        </div>

                        <!-- File upload -->
                        <div class="isti-form-group" id="field-file" style="margin-bottom:18px">
                            <label class="isti-form-label"><?= get_string('content_file', 'local_istikama_admin') ?></label>
                            <?php $PAGE->requires->js_call_amd('core/form-filetypes', 'init', []); ?>
                            <input type="file" class="isti-form-input" id="content_file_input" name="content_file_upload"
                                   style="padding:10px 14px;cursor:pointer">
                            <input type="hidden" name="content_file" id="content_file_draftid" value="<?= $draftitemid ?>">
                            <div id="file-accept-hint" style="font-size:.78rem;color:#94a3b8;margin-top:4px"></div>
                        </div>

                        <!-- YouTube / Video URL -->
                        <div class="isti-form-group istikama-hidden" id="field-youtube" style="margin-bottom:18px">
                            <label class="isti-form-label">
                                <i class="fa fa-play-circle" style="color:#006bff"></i>
                                <?= get_string('youtube_url', 'local_istikama_admin') ?>
                            </label>
                            <input type="url" class="isti-form-input" id="external_url_video" name="external_url"
                                   placeholder="https://youtu.be/... or https://youtube.com/watch?v=...">
                            <div style="font-size:.78rem;color:#94a3b8;margin-top:4px">
                                <i class="fa fa-info-circle"></i> Supports YouTube, Vimeo, or any video link
                            </div>
                        </div>

                        <!-- External link URL -->
                        <div class="isti-form-group istikama-hidden" id="field-link" style="margin-bottom:18px">
                            <label class="isti-form-label">
                                <i class="fa fa-link" style="color:#0891b2"></i>
                                <?= get_string('external_link_url', 'local_istikama_admin') ?>
                            </label>
                            <input type="url" class="isti-form-input" id="external_url_link" name="external_url" placeholder="https://...">
                        </div>

                        <!-- Description -->
                        <div class="isti-form-group" style="margin-bottom:18px">
                            <label class="isti-form-label"><?= get_string('content_description', 'local_istikama_admin') ?></label>
                            <textarea class="isti-form-input" id="description" name="description" rows="3"
                                      style="resize:vertical"></textarea>
                        </div>

                        <!-- Keywords -->
                        <div class="isti-form-group" style="margin-bottom:24px">
                            <label class="isti-form-label"><?= get_string('content_keywords', 'local_istikama_admin') ?></label>
                            <input type="text" class="isti-form-input" id="keywords" name="keywords"
                                   placeholder="<?= get_string('content_keywords_help', 'local_istikama_admin') ?>">
                        </div>

                        <div style="display:flex;gap:12px;align-items:center">
                            <button type="submit" class="isti-btn isti-btn-primary" style="padding:12px 32px;font-size:.95rem">
                                <i class="fa fa-cloud-upload-alt"></i>
                                <?= get_string('submit_content', 'local_istikama_admin') ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- ==================== VALIDATION WORKFLOW ==================== -->
        <!-- Rebuilt to mirror the Digital Library table: full-width KPI strip,
             same row layout, SAME preview button that opens the moderation
             modal (where status, levels, subjects and metadata are edited). -->
        <div id="validation" style="<?= $active_tab !== 'validation' ? 'display:none' : '' ?>">

            <!-- Branded header (matches the rest of the platform) -->
            <div style="background:linear-gradient(135deg,#006bff,#0052cc);padding:18px 22px;border-radius:10px;margin-bottom:20px;">
                <h2 style="margin:0;font-size:20px;color:#fff;">
                    <i class="fa fa-check-circle" style="color:#fff;"></i>
                    <span style="color:#fff;"><?= get_string('validation_workflow', 'local_istikama_admin') ?></span>
                </h2>
                <p style="margin:6px 0 0;font-size:13px;color:#fff;opacity:.92;">
                    <?= get_string('lib_validation_help', 'local_istikama_admin') ?>
                </p>
            </div>

            <!-- KPI cards: one per canonical status, full-width grid, no side borders. -->
            <?php
            $val_status_meta = \local_istikama_admin\content_manager::get_statuses();
            ?>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:14px;margin-bottom:18px;">
                <?php foreach ($canonical_statuses as $sk):
                    $m = $val_status_meta[$sk];
                    $cnt = $status_counts[$sk] ?? 0;
                    $isactive = ($val_status === $sk);
                    $href = (new moodle_url('/local/istikama_admin/contentbank.php', ['tab' => 'validation', 'val_status' => $sk]))->out(false);
                ?>
                <a href="<?= $href ?>"
                   style="background:#fff;border:1px solid <?= $isactive ? '#006bff' : '#e2e8f0' ?>;border-radius:12px;padding:16px 18px;
                          text-decoration:none;color:inherit;display:block;<?= $isactive ? 'box-shadow:0 4px 14px rgba(0,107,255,.18);' : '' ?>">
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                        <span style="width:34px;height:34px;border-radius:10px;background:<?= $m['badge_bg'] ?>;color:<?= $m['badge_fg'] ?>;display:flex;align-items:center;justify-content:center;font-size:14px;">
                            <i class="fa <?= $m['icon'] ?>"></i>
                        </span>
                        <div style="font-size:11px;font-weight:700;color:#475569;text-transform:uppercase;letter-spacing:.4px;">
                            <?= s($m['label']) ?>
                        </div>
                    </div>
                    <div style="font-size:1.8rem;font-weight:800;color:#0f172a;line-height:1;"><?= $cnt ?></div>
                </a>
                <?php endforeach; ?>
            </div>

            <!-- Filter bar — same grid pattern as the Digital Library tab. -->
            <form method="get" action="<?= $baseurl->out(false) ?>"
                  style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:14px 16px;margin-bottom:18px;
                         display:grid;grid-template-columns:minmax(260px,2fr) minmax(180px,1fr) auto auto;gap:10px;align-items:end;">
                <input type="hidden" name="tab" value="validation">

                <div>
                    <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:4px;">
                        <i class="fa fa-search" style="color:#006bff;"></i> <?= get_string('lib_search_label', 'local_istikama_admin') ?>
                    </label>
                    <input type="text" name="q" value="<?= s(optional_param('q', '', PARAM_TEXT)) ?>"
                           placeholder="<?= s(get_string('lib_search_placeholder', 'local_istikama_admin')) ?>"
                           style="width:100%;padding:9px 12px;border:1px solid #cbd5e1;border-radius:8px;font-size:14px;box-sizing:border-box;">
                </div>

                <div>
                    <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:4px;"><?= get_string('status', 'local_istikama_admin') ?></label>
                    <select name="val_status" style="width:100%;padding:9px 10px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;background:#fff;box-sizing:border-box;">
                        <option value="all" <?= $val_status === 'all' ? 'selected' : '' ?>>
                            <?= get_string('lib_validation_all_open', 'local_istikama_admin') ?>
                        </option>
                        <?php foreach ($canonical_statuses as $sk):
                            $m = $val_status_meta[$sk];
                        ?>
                            <option value="<?= s($sk) ?>" <?= $val_status === $sk ? 'selected' : '' ?>>
                                <?= s($m['label']) ?> (<?= $status_counts[$sk] ?? 0 ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" style="padding:9px 18px;background:#006bff;color:#fff;border:0;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;align-self:end;">
                    <i class="fa fa-filter"></i> <?= get_string('filter_apply', 'local_istikama_admin') ?>
                </button>
                <a href="<?= (new moodle_url('/local/istikama_admin/contentbank.php', ['tab' => 'validation']))->out(false) ?>"
                   style="padding:9px 16px;border:1px solid #cbd5e1;border-radius:8px;color:#475569;text-decoration:none;font-size:13px;align-self:end;background:#fff;">
                    <?= get_string('filter_reset', 'local_istikama_admin') ?>
                </a>
            </form>

            <?php
            // Optional client-side text-filter on the same set we already fetched
            // (server-side search already happens via the Digital Library query,
            //  but the validation tab uses a separate, more focused query).
            $val_search = optional_param('q', '', PARAM_TEXT);
            if ($val_search !== '') {
                $needle = mb_strtolower($val_search);
                $validation_contents = array_filter($validation_contents, function($it) use ($needle) {
                    return (mb_strpos(mb_strtolower($it->name ?? ''),        $needle) !== false)
                        || (mb_strpos(mb_strtolower($it->description ?? ''), $needle) !== false)
                        || (mb_strpos(mb_strtolower($it->keywords ?? ''),    $needle) !== false);
                });
            }
            ?>

            <?php if (empty($validation_contents)): ?>
                <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:48px;text-align:center;">
                    <i class="fa fa-folder-open" style="font-size:2.5rem;color:#cbd5e1;display:block;margin-bottom:12px;"></i>
                    <p style="margin:0;font-weight:600;color:#1e293b;"><?= get_string('no_pending', 'local_istikama_admin') ?></p>
                    <p style="margin:6px 0 0;color:#94a3b8;font-size:13px;">No items match the current filter.</p>
                </div>
            <?php else: ?>
                <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;overflow:hidden;">
                    <table class="isti-table isti-table-striped" style="margin:0;width:100%;">
                        <thead>
                            <tr style="background:#f1f5f9;color:#475569;">
                                <th><?= get_string('content_type', 'local_istikama_admin') ?></th>
                                <th><?= get_string('name', 'local_istikama_admin') ?></th>
                                <th><?= get_string('content_subject', 'local_istikama_admin') ?></th>
                                <th><?= get_string('content_level', 'local_istikama_admin') ?></th>
                                <th><?= get_string('uploaded_by', 'local_istikama_admin') ?></th>
                                <th><?= get_string('status', 'local_istikama_admin') ?></th>
                                <th><?= get_string('lib_keywords_col', 'local_istikama_admin') ?></th>
                                <th style="text-align:center;"><?= get_string('actions', 'local_istikama_admin') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        // Reuse the SAME icon/color maps as the Digital Library table.
                        $type_fa = ['document'=>'fa-file-alt','video'=>'fa-video','h5p'=>'fa-cube','book'=>'fa-book','quiz'=>'fa-question-circle','link'=>'fa-link'];
                        $type_clr= ['document'=>'#f59e0b','video'=>'#3b82f6','h5p'=>'#8b5cf6','book'=>'#10b981','quiz'=>'#ec4899','link'=>'#06b6d4'];
                        foreach ($validation_contents as $item):
                            $t = $item->content_type ?? 'document';
                            $ico = $type_fa[$t]  ?? 'fa-file';
                            $clr = $type_clr[$t] ?? '#64748b';
                            $sk  = $item->status ?? 'pending';
                            $sm  = $val_status_meta[$sk] ?? $val_status_meta['pending'];
                            $tags = $content_tags[$item->id] ?? [];
                        ?>
                            <tr>
                                <td>
                                    <span style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;background:<?= $clr ?>15;color:<?= $clr ?>;">
                                        <i class="fa <?= $ico ?>"></i>
                                    </span>
                                </td>
                                <td>
                                    <strong style="color:#1e293b;"><?= format_string($item->name ?? $item->filename ?? 'Untitled') ?></strong>
                                    <div style="font-size:.75rem;color:#94a3b8;margin-top:2px;"><?= userdate($item->timecreated, get_string('strftimedatetimeshort', 'langconfig')) ?></div>
                                </td>
                                <td><?= isset($subjects[$item->subject ?? '']) ? $subjects[$item->subject] : '—' ?></td>
                                <td><?= isset($levels[$item->level ?? '']) ? $levels[$item->level] : '—' ?></td>
                                <td><?= istikama_user_fullname($item->uploaded_by) ?></td>
                                <td>
                                    <span style="padding:3px 12px;border-radius:20px;font-size:.75rem;font-weight:600;background:<?= $sm['badge_bg'] ?>;color:<?= $sm['badge_fg'] ?>;white-space:nowrap;">
                                        <i class="fa <?= $sm['icon'] ?>" style="margin-right:4px;"></i><?= s($sm['label']) ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="display:flex;gap:4px;flex-wrap:wrap;align-items:center;">
                                        <?php foreach ($tags as $tag): ?>
                                            <span style="background:#f1f5f9;border:1px solid #e2e8f0;padding:2px 8px;border-radius:12px;font-size:.7rem;color:#475569;"><?= s($tag->tag) ?></span>
                                        <?php endforeach; ?>
                                        <?php if (empty($tags)): ?>
                                            <span style="color:#cbd5e1;font-size:.7rem;">—</span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td style="text-align:center;">
                                    <!-- Same preview button as Digital Library — opens the moderation modal. -->
                                    <button type="button" class="isti-btn isti-btn-outline isti-btn-sm isti-cb-preview-btn"
                                            data-id="<?= (int)$item->id ?>"
                                            title="<?= s(get_string('lib_preview_and_moderate', 'local_istikama_admin')) ?>">
                                        <i class="fa fa-play-circle"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- Quiz Bank tab now navigates directly to /local/istikama_admin/activities.php.
             No inline tab body needed — the tab nav anchor handles the redirect. -->
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ---- Upload Content: State Machine ----
    const btnBackToTypes = document.getElementById('btn-back-to-types');
    const chooserPanel = document.getElementById('type-chooser-panel');
    const formPanel = document.getElementById('upload-form-panel');
    const typeCards = document.querySelectorAll('.istikama-type-card');
    const formContentType = document.getElementById('form-content-type');
    const formTypeIconWrap = document.getElementById('form-type-icon-wrap');
    const formTypeTitle = document.getElementById('form-type-title');

    const fieldFile = document.getElementById('field-file');
    const fieldYoutube = document.getElementById('field-youtube');
    const fieldLink = document.getElementById('field-link');
    const fileAcceptHint = document.getElementById('file-accept-hint');

    const typeConfig = {
        document: { showFile: true, showYoutube: false, showLink: false, accept: '.pdf,.doc,.docx,.ppt,.pptx,.odt,.odp', hint: 'PDF, DOC, DOCX, PPT, PPTX' },
        video:    { showFile: true, showYoutube: true,  showLink: false, accept: '.mp4,.webm,.avi,.mov,.mkv', hint: 'MP4, WEBM, AVI, MOV' },
        h5p:      { showFile: true, showYoutube: false, showLink: false, accept: '.h5p', hint: 'H5P interactive content' },
        book:     { showFile: true, showYoutube: false, showLink: false, accept: '.pdf,.epub,.doc,.docx', hint: 'PDF, EPUB, DOC, DOCX' },
        quiz:     { showFile: false, showYoutube: false, showLink: false, accept: '', hint: '' },
        link:     { showFile: false, showYoutube: false, showLink: true, accept: '', hint: '' },
    };

    function showForm(show) {
        if (chooserPanel) chooserPanel.style.display = show ? 'none' : '';
        if (formPanel) formPanel.classList.toggle('istikama-hidden', !show);
    }

    if (btnBackToTypes) {
        btnBackToTypes.addEventListener('click', function() {
            showForm(false);
            typeCards.forEach(c => c.classList.remove('selected'));
        });
    }

    typeCards.forEach(card => {
        card.addEventListener('click', function() {
            const type = this.dataset.type;
            const cfg = typeConfig[type] || typeConfig.document;

            typeCards.forEach(c => c.classList.remove('selected'));
            this.classList.add('selected');

            if (type === 'quiz') {
                window.open(M.cfg.wwwroot + '/question/edit.php?courseid=' + M.cfg.courseId, '_blank');
                return;
            }

            formContentType.value = type;
            var fa = this.dataset.fa || 'fa fa-file';
            var color = this.dataset.color || 'c-document';
            if (formTypeIconWrap) {
                formTypeIconWrap.innerHTML = '<i class="fa ' + fa.replace('fa ', '') + '"></i>';
                formTypeIconWrap.className = 'isti-type-icon-circle ' + color;
                formTypeIconWrap.style.margin = '0';
                formTypeIconWrap.style.width = '52px';
                formTypeIconWrap.style.height = '52px';
                formTypeIconWrap.style.fontSize = '1.4rem';
            }
            if (formTypeTitle) formTypeTitle.textContent = this.querySelector('.istikama-type-name').textContent;

            if (fieldFile) fieldFile.classList.toggle('istikama-hidden', !cfg.showFile);
            if (fieldYoutube) fieldYoutube.classList.toggle('istikama-hidden', !cfg.showYoutube);
            if (fieldLink) fieldLink.classList.toggle('istikama-hidden', !cfg.showLink);

            const fileInput = document.getElementById('content_file_input');
            if (fileInput) fileInput.accept = cfg.accept;
            if (fileAcceptHint) fileAcceptHint.textContent = cfg.hint ? 'Accepted: ' + cfg.hint : '';
            if (fileInput) fileInput.required = cfg.showFile && type !== 'video';

            showForm(true);
        });

        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });

    // ---- File upload handling via FormData ----
    const form = document.getElementById('upload-content-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const fileInput = document.getElementById('content_file_input');
            if (fileInput && fileInput.files.length > 0) {
                e.preventDefault();
                const file = fileInput.files[0];
                const draftId = document.getElementById('content_file_draftid').value;

                const formData = new FormData();
                formData.append('repo_upload_file', file);
                formData.append('sesskey', M.cfg.sesskey);
                formData.append('repo_id', getRepoId());
                formData.append('itemid', draftId);
                formData.append('author', '');
                formData.append('savepath', '/');
                formData.append('title', file.name);
                formData.append('overwrite', '1');
                formData.append('ctx_id', <?= $context->id ?>);

                fetch(M.cfg.wwwroot + '/repository/repository_ajax.php?action=upload', {
                    method: 'POST',
                    body: formData,
                })
                .then(r => r.json())
                .then(data => {
                    if (data.error) {
                        alert('Upload error: ' + data.error);
                        return;
                    }
                    document.getElementById('content_file_draftid').value = draftId;
                    fileInput.disabled = true;
                    form.submit();
                })
                .catch(err => {
                    console.error('Upload failed:', err);
                    alert('File upload failed. Please try again.');
                });
            }
        });
    }

    function getRepoId() {
        return <?php
            $repos = repository::get_instances(['type' => 'upload', 'currentcontext' => $context]);
            $repoid = 0;
            foreach ($repos as $repo) {
                $repoid = $repo->id;
                break;
            }
            echo $repoid ?: 2;
        ?>;
    }

    // ---- School / Level Chained Dropdowns ----
    const schoolSelect = document.getElementById('school');
    const levelSelect = document.getElementById('level');
    const levelsBySchool = <?= $levels_json ?>;

    if (schoolSelect && levelSelect) {
        schoolSelect.addEventListener('change', function() {
            const schoolId = this.value;
            levelSelect.innerHTML = '<option value="">— Select Level —</option>';
            levelSelect.disabled = true;

            if (schoolId && levelsBySchool[schoolId]) {
                const levels = levelsBySchool[schoolId];
                if (Object.keys(levels).length > 0) {
                    levelSelect.disabled = false;
                    for (const [lvlValue, lvlName] of Object.entries(levels)) {
                        const option = document.createElement('option');
                        option.value = lvlValue;
                        option.textContent = lvlName;
                        levelSelect.appendChild(option);
                    }
                }
            }
        });
    }

    // ═══════════════════════════════════════════════════════════════════
    // Moderation UI JS
    // ═══════════════════════════════════════════════════════════════════
    
    const sesskey = M.cfg.sesskey;
    const ajaxUrl = M.cfg.wwwroot + '/local/istikama_admin/ajax.php';
    const allStatuses = <?= json_encode($all_statuses) ?>;

    // --- 1. Inline Status Dropdown Logic ---
    document.querySelectorAll('.isti-status-dropdown').forEach(dd => {
        const cid = dd.dataset.id;
        const currentBadge = dd.querySelector('.current');

        currentBadge.addEventListener('click', function(e) {
            e.stopPropagation();
            document.querySelectorAll('.isti-status-menu').forEach(m => m.remove());

            const menu = document.createElement('div');
            menu.className = 'isti-status-menu';
            menu.style.position = 'absolute';
            menu.style.zIndex = '1000';
            menu.style.background = '#fff';
            menu.style.border = '1px solid #e2e8f0';
            menu.style.borderRadius = '8px';
            menu.style.boxShadow = '0 10px 15px -3px rgba(0,0,0,0.1)';
            menu.style.padding = '8px';
            menu.style.minWidth = '180px';
            menu.style.marginTop = '4px';

            for (const [k, st] of Object.entries(allStatuses)) {
                const item = document.createElement('div');
                item.style.padding = '6px 12px';
                item.style.cursor = 'pointer';
                item.style.borderRadius = '4px';
                item.style.fontSize = '.85rem';
                item.style.display = 'flex';
                item.style.alignItems = 'center';
                item.style.gap = '8px';
                item.style.color = '#1e293b';

                item.innerHTML = `<i class="fa ${st.icon}" style="color:${st.badge_bg}"></i> ${st.label}`;
                
                item.addEventListener('mouseover', () => item.style.background = '#f8fafc');
                item.addEventListener('mouseout', () => item.style.background = 'transparent');
                
                item.addEventListener('click', () => {
                    if (['rejected', 'needs_revision'].includes(k)) {
                        const notes = prompt("<?= get_string('cb_moderation_notes', 'local_istikama_admin') ?>:");
                        if (notes !== null) changeStatus(cid, k, notes, dd);
                    } else {
                        changeStatus(cid, k, '', dd);
                    }
                });

                menu.appendChild(item);
            }

            dd.appendChild(menu);

            document.addEventListener('click', function closeMenu() {
                menu.remove();
                document.removeEventListener('click', closeMenu);
            }, { once: true });
        });
    });

    function changeStatus(cid, newStatus, notes, ddElement) {
        const currentBadge = ddElement.querySelector('.current');
        currentBadge.style.opacity = '0.5';

        const formData = new FormData();
        formData.append('action', 'cb_change_status');
        formData.append('sesskey', sesskey);
        formData.append('contentid', cid);
        formData.append('new_status', newStatus);
        if (notes) formData.append('notes', notes);

        fetch(ajaxUrl, { method: 'POST', body: formData })
            .then(r => r.json())
            .then(res => {
                if (res.success) {
                    currentBadge.style.background = res.badge_bg;
                    currentBadge.style.color = res.badge_fg;
                    currentBadge.querySelector('.lbl').textContent = res.label;
                    currentBadge.querySelector('.fa').className = `fa ${res.icon}`;
                    
                    const currentFilter = document.querySelector('select[name="val_status"]').value;
                    const reviewPipeline = <?= json_encode($review_statuses) ?>;
                    
                    let shouldRemove = false;
                    if (currentFilter === 'all' && !reviewPipeline.includes(newStatus)) shouldRemove = true;
                    if (currentFilter !== 'all' && currentFilter !== newStatus) shouldRemove = true;

                    if (shouldRemove) {
                        const row = document.getElementById(`val-row-${cid}`);
                        if (row) {
                            row.style.transition = 'opacity 0.3s, transform 0.3s';
                            row.style.opacity = '0';
                            row.style.transform = 'translateX(20px)';
                            setTimeout(() => row.remove(), 300);
                        }
                    }
                } else {
                    alert(res.error || 'Error changing status');
                }
            })
            .finally(() => {
                currentBadge.style.opacity = '1';
            });
    }

    // --- 2. Bulk Actions Logic ---
    const checkAll = document.getElementById('val-check-all');
    const checkItems = document.querySelectorAll('.val-check-item');
    const btnBulk = document.getElementById('btn-bulk-change');

    function updateBulkBtn() {
        if (!btnBulk) return;
        const anyChecked = Array.from(checkItems).some(cb => cb.checked);
        btnBulk.disabled = !anyChecked;
    }

    if (checkAll) {
        checkAll.addEventListener('change', function() {
            checkItems.forEach(cb => cb.checked = this.checked);
            updateBulkBtn();
        });
    }

    checkItems.forEach(cb => {
        cb.addEventListener('change', updateBulkBtn);
    });

    if (btnBulk) {
        btnBulk.addEventListener('click', function() {
            const checkedIds = Array.from(checkItems).filter(cb => cb.checked).map(cb => cb.value);
            if (checkedIds.length === 0) return;

            const stKeys = Object.keys(allStatuses).join(', ');
            const newStatus = prompt(`Enter new status for ${checkedIds.length} items (${stKeys}):`);
            
            if (newStatus && allStatuses[newStatus]) {
                const formData = new FormData();
                formData.append('action', 'cb_bulk_change_status');
                formData.append('sesskey', sesskey);
                formData.append('contentids', checkedIds.join(','));
                formData.append('new_status', newStatus);

                btnBulk.disabled = true;
                btnBulk.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';

                fetch(ajaxUrl, { method: 'POST', body: formData })
                    .then(r => r.json())
                    .then(res => {
                        if (res.success) location.reload();
                        else alert('Error: ' + res.error);
                    });
            }
        });
    }

    // --- 3. Workflow History Modal ---
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-view-history');
        if (btn) {
            const cid = btn.dataset.id;
            const tbd = document.getElementById('history-tbody');
            tbd.innerHTML = '<tr><td colspan="3" style="text-align:center"><i class="fa fa-spinner fa-spin"></i></td></tr>';
            document.getElementById('historyModal').style.display = 'flex';

            fetch(`${ajaxUrl}?action=cb_get_history&contentid=${cid}`)
                .then(r => r.json())
                .then(res => {
                    tbd.innerHTML = '';
                    if (res.length === 0) {
                        tbd.innerHTML = `<tr><td colspan="3" style="text-align:center;color:#64748b"><?= get_string('cb_history_empty', 'local_istikama_admin') ?></td></tr>`;
                        return;
                    }
                    res.forEach(h => {
                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td style="font-size:.85rem;color:#64748b;white-space:nowrap">${h.time}</td>
                            <td>
                                <div><strong>${h.user}</strong> changed status</div>
                                <div style="display:flex;align-items:center;gap:6px;margin-top:4px;font-size:.85rem">
                                    <span style="background:#f1f5f9;padding:2px 6px;border-radius:4px">${h.old_status}</span>
                                    <i class="fa fa-arrow-right" style="color:#94a3b8;font-size:.7rem"></i>
                                    <span style="background:#e0f2fe;padding:2px 6px;border-radius:4px;color:#0369a1">${h.new_status}</span>
                                </div>
                            </td>
                            <td style="font-size:.85rem;color:#475569">${h.notes ? h.notes : '—'}</td>
                        `;
                        tbd.appendChild(tr);
                    });
                });
        }
    });

    document.querySelectorAll('[data-dismiss="modal"]').forEach(btn => {
        btn.addEventListener('click', () => {
            btn.closest('.isti-modal').style.display = 'none';
        });
    });

    // --- 4. Reopen Rejected Content ---
    document.querySelectorAll('.btn-reopen').forEach(btn => {
        btn.addEventListener('click', function() {
            const cid = this.dataset.id;
            if (confirm("<?= get_string('cb_reopen', 'local_istikama_admin') ?>?")) {
                const formData = new FormData();
                formData.append('action', 'cb_change_status');
                formData.append('sesskey', sesskey);
                formData.append('contentid', cid);
                formData.append('new_status', 'pending');
                formData.append('notes', 'Reopened from Rejected panel');

                fetch(ajaxUrl, { method: 'POST', body: formData })
                    .then(r => r.json())
                    .then(res => {
                        if (res.success) location.reload();
                    });
            }
        });
    });

    // --- 5. Tagging Logic ---
    let currentTagContentId = null;
    const tagModal = document.getElementById('tagModal');
    const tagInput = document.getElementById('new-tag-input');
    const tagList = document.getElementById('modal-tag-list');

    // Use event delegation for dynamically updating tables
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-edit-tags');
        if (btn) {
            currentTagContentId = btn.dataset.id;
            tagModal.style.display = 'flex';
            tagList.innerHTML = '<div style="text-align:center;padding:20px;color:#94a3b8"><i class="fa fa-spinner fa-spin"></i></div>';
            tagInput.value = '';
            loadTags(currentTagContentId);
        }
    });

    function loadTags(cid) {
        fetch(`${ajaxUrl}?action=cb_get_tags&contentid=${cid}`)
            .then(r => r.json())
            .then(res => {
                tagList.innerHTML = '';
                if (res.length === 0) {
                    tagList.innerHTML = `<div style="text-align:center;padding:20px;color:#94a3b8"><?= get_string('cb_no_tags', 'local_istikama_admin') ?></div>`;
                    return;
                }
                
                res.forEach(t => {
                    const el = document.createElement('div');
                    el.className = 'isti-tag-item';
                    el.style.display = 'inline-flex';
                    el.style.alignItems = 'center';
                    el.style.gap = '6px';
                    el.style.background = '#f1f5f9';
                    el.style.border = '1px solid #e2e8f0';
                    el.style.padding = '4px 10px';
                    el.style.borderRadius = '16px';
                    el.style.margin = '4px';
                    el.style.fontSize = '.85rem';
                    el.style.color = '#1e293b';

                    el.innerHTML = `
                        ${t.tag}
                        <i class="fa fa-times remove-tag-btn" data-id="${t.id}" style="color:#ef4444;cursor:pointer;font-size:.75rem;margin-left:4px"></i>
                    `;
                    tagList.appendChild(el);
                });

                tagList.querySelectorAll('.remove-tag-btn').forEach(btn => {
                    btn.addEventListener('click', function() {
                        const tid = this.dataset.id;
                        this.className = 'fa fa-spinner fa-spin';
                        
                        const formData = new FormData();
                        formData.append('action', 'cb_remove_tag');
                        formData.append('sesskey', sesskey);
                        formData.append('tagid', tid);

                        fetch(ajaxUrl, { method: 'POST', body: formData })
                            .then(r => r.json())
                            .then(data => {
                                if (data.success) {
                                    loadTags(currentTagContentId);
                                    updateRowTags(currentTagContentId);
                                }
                            });
                    });
                });
            });
    }

    function addTag() {
        const val = tagInput.value.trim();
        if (!val || !currentTagContentId) return;

        const formData = new FormData();
        formData.append('action', 'cb_add_tag');
        formData.append('sesskey', sesskey);
        formData.append('contentid', currentTagContentId);
        formData.append('tag', val);

        fetch(ajaxUrl, { method: 'POST', body: formData })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    tagInput.value = '';
                    loadTags(currentTagContentId);
                    updateRowTags(currentTagContentId);
                } else {
                    alert(data.error || 'Error adding tag');
                }
            });
    }

    if (tagInput) {
        tagInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addTag();
            }
        });
        document.getElementById('btn-add-tag').addEventListener('click', addTag);
    }

    function updateRowTags(cid) {
        fetch(`${ajaxUrl}?action=cb_get_tags&contentid=${cid}`)
            .then(r => r.json())
            .then(res => {
                const cell = document.getElementById(`tags-${cid}`);
                if (!cell) return;
                
                const btnHtml = `<button class="isti-btn-icon btn-edit-tags" data-id="${cid}" style="width:24px;height:24px;padding:0;background:none;border:1px dashed #cbd5e1;color:#64748b;border-radius:50%;cursor:pointer;display:inline-flex;align-items:center;justify-content:center" title="<?= get_string('cb_edit_tags', 'local_istikama_admin') ?>"><i class="fa fa-plus" style="font-size:.7rem"></i></button>`;
                
                let tagsHtml = '';
                res.forEach(t => {
                    tagsHtml += `<span class="isti-tag" style="background:#f1f5f9;border:1px solid #e2e8f0;padding:2px 8px;border-radius:12px;font-size:.75rem;color:#475569;display:inline-flex;align-items:center;gap:4px">${t.tag}</span>`;
                });
                
                cell.innerHTML = tagsHtml + btnHtml;
            });
    }

});
</script>

<!-- Workflow History Modal -->
<div id="historyModal" class="isti-modal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(15,23,42,0.6);z-index:9999;align-items:center;justify-content:center">
    <div class="isti-modal-content" style="background:#fff;border-radius:12px;width:100%;max-width:600px;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);overflow:hidden">
        <div style="padding:16px 24px;border-bottom:1px solid #e2e8f0;display:flex;justify-content:space-between;align-items:center;background:#f8fafc">
            <h4 style="margin:0;font-weight:600;color:#1e293b"><i class="fa fa-history" style="color:#006bff;margin-right:8px"></i> <?= get_string('cb_workflow_history', 'local_istikama_admin') ?></h4>
            <button data-dismiss="modal" style="background:none;border:none;font-size:1.2rem;color:#64748b;cursor:pointer"><i class="fa fa-times"></i></button>
        </div>
        <div style="padding:0;max-height:60vh;overflow-y:auto">
            <table class="isti-table" style="margin:0">
                <thead>
                    <tr>
                        <th style="width:140px">Date</th>
                        <th>Action</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody id="history-tbody">
                </tbody>
            </table>
        </div>
        <div style="padding:16px 24px;border-top:1px solid #e2e8f0;background:#f8fafc;text-align:right">
            <button data-dismiss="modal" class="isti-btn isti-btn-outline"><?= get_string('close', 'core') ?></button>
        </div>
    </div>
</div>

<!-- Tags Modal -->
<div id="tagModal" class="isti-modal" style="display:none;position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(15,23,42,0.6);z-index:9999;align-items:center;justify-content:center">
    <div class="isti-modal-content" style="background:#fff;border-radius:12px;width:100%;max-width:480px;box-shadow:0 25px 50px -12px rgba(0,0,0,0.25);overflow:hidden">
        <div style="padding:16px 24px;border-bottom:1px solid #e2e8f0;display:flex;justify-content:space-between;align-items:center;background:#f8fafc">
            <h4 style="margin:0;font-weight:600;color:#1e293b"><i class="fa fa-tags" style="color:#006bff;margin-right:8px"></i> <?= get_string('cb_tags', 'local_istikama_admin') ?></h4>
            <button data-dismiss="modal" style="background:none;border:none;font-size:1.2rem;color:#64748b;cursor:pointer"><i class="fa fa-times"></i></button>
        </div>
        <div style="padding:24px">
            <div style="display:flex;gap:8px;margin-bottom:16px">
                <input type="text" id="new-tag-input" class="isti-form-input" placeholder="<?= get_string('cb_tag_placeholder', 'local_istikama_admin') ?>" style="flex:1">
                <button id="btn-add-tag" class="isti-btn isti-btn-primary"><i class="fa fa-plus"></i></button>
            </div>
            
            <div style="font-size:.85rem;color:#64748b;margin-bottom:8px;font-weight:600;text-transform:uppercase"><?= get_string('cb_tags', 'local_istikama_admin') ?></div>
            <div id="modal-tag-list" style="min-height:80px;border:1px solid #e2e8f0;border-radius:8px;padding:12px;background:#f8fafc;display:flex;flex-wrap:wrap;align-content:flex-start">
                <!-- Tags injected via JS -->
            </div>
        </div>
        <div style="padding:16px 24px;border-top:1px solid #e2e8f0;background:#f8fafc;text-align:right">
            <button data-dismiss="modal" class="isti-btn isti-btn-primary"><?= get_string('close', 'core') ?></button>
        </div>
    </div>
</div>

<!-- ====================================================================
     LIBRARY PREVIEW + MODERATION MODAL
     Rendered once per page. JS in js/contentbank.js fills its contents
     when the user clicks a `.isti-cb-preview-btn` button in the table.
     ==================================================================== -->
<div id="isti-cb-data"
     style="display:none"
     data-ajax-url="<?= (new moodle_url('/local/istikama_admin/library_ajax.php'))->out(false) ?>"
     data-sesskey="<?= sesskey() ?>"
     data-str-saving="<?= s(get_string('lib_saving', 'local_istikama_admin')) ?>"
     data-str-saved="<?= s(get_string('lib_saved', 'local_istikama_admin')) ?>"
     data-str-error-prefix="<?= s(get_string('lib_error_prefix', 'local_istikama_admin')) ?>"
     data-str-no-preview="<?= s(get_string('lib_no_preview', 'local_istikama_admin')) ?>"
     data-str-download="<?= s(get_string('download', 'moodle')) ?>"
     data-str-open-external="<?= s(get_string('openinnewwindow', 'moodle')) ?>"></div>

<div id="isti-cb-modal" class="isti-cb-modal-overlay" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,.65);z-index:10000;align-items:center;justify-content:center;padding:24px;opacity:1;">
  <div style="background:#fff;border-radius:16px;width:96%;max-width:1280px;max-height:92vh;display:flex;flex-direction:column;overflow:hidden;box-shadow:0 25px 80px rgba(0,0,0,.4);">

    <!-- Header -->
    <div style="padding:16px 22px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;gap:14px;flex-shrink:0;background:#f8fafc;">
      <i class="fa fa-photo-video" style="font-size:1.4rem;color:#006bff;"></i>
      <h4 id="isti-cb-modal-title" style="margin:0;flex:1;font-weight:700;color:#0f172a;font-size:1.05rem;">Content</h4>
      <span id="isti-cb-modal-msg" style="font-size:12px;color:#64748b;"></span>
      <button type="button" data-cb-close style="background:transparent;border:0;color:#64748b;cursor:pointer;font-size:1.3rem;padding:4px 10px;">&times;</button>
    </div>

    <!-- Body: two-column grid (viewer left, editor right). Both scroll independently. -->
    <div style="display:grid;grid-template-columns:1.7fr 1fr;gap:0;flex:1;min-height:0;">

      <!-- Viewer pane -->
      <div id="isti-cb-modal-viewer" style="background:#0f172a;min-height:480px;overflow:hidden;"></div>

      <!-- Edit pane -->
      <div style="padding:20px;overflow-y:auto;background:#fff;border-left:1px solid #e2e8f0;">
        <input type="hidden" id="isti-cb-modal-id" value="">

        <h5 style="margin:0 0 14px;color:#0f172a;font-size:1rem;font-weight:700;">
          <i class="fa fa-pen" style="color:#006bff;margin-right:6px;"></i><?= get_string('lib_details_and_moderation', 'local_istikama_admin') ?>
        </h5>

        <!-- Status -->
        <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:4px;"><?= get_string('status', 'local_istikama_admin') ?></label>
        <select id="isti-cb-modal-status" style="width:100%;padding:9px 11px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;margin-bottom:12px;background:#fff;"></select>
        <input type="text" id="isti-cb-modal-statusnotes" placeholder="<?= s(get_string('lib_status_notes_ph', 'local_istikama_admin')) ?>"
               style="width:100%;padding:8px 11px;border:1px solid #e2e8f0;border-radius:8px;font-size:12px;margin-bottom:18px;color:#475569;">

        <!-- Title -->
        <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:4px;"><?= get_string('name', 'local_istikama_admin') ?></label>
        <input type="text" id="isti-cb-modal-name"
               style="width:100%;padding:9px 11px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;margin-bottom:12px;">

        <!-- Description -->
        <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:4px;"><?= get_string('content_description', 'local_istikama_admin') ?></label>
        <textarea id="isti-cb-modal-desc" rows="3"
                  style="width:100%;padding:9px 11px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;margin-bottom:12px;font-family:inherit;resize:vertical;"></textarea>

        <!-- Keywords -->
        <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:4px;"><?= get_string('lib_keywords_col', 'local_istikama_admin') ?></label>
        <input type="text" id="isti-cb-modal-keywords" placeholder="<?= s(get_string('lib_keywords_ph', 'local_istikama_admin')) ?>"
               style="width:100%;padding:9px 11px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;margin-bottom:12px;">

        <!-- Multi-select chips: Levels -->
        <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:6px;"><?= get_string('lib_levels_multi', 'local_istikama_admin') ?></label>
        <div id="isti-cb-modal-levels" data-selected="[]" style="margin-bottom:14px;display:flex;flex-wrap:wrap;gap:5px;padding:8px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;min-height:42px;"></div>

        <!-- Multi-select chips: Subjects -->
        <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:6px;"><?= get_string('lib_subjects_multi', 'local_istikama_admin') ?></label>
        <div id="isti-cb-modal-subjects" data-selected="[]" style="margin-bottom:14px;display:flex;flex-wrap:wrap;gap:5px;padding:8px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;min-height:42px;"></div>

        <!-- External URL -->
        <label style="font-size:12px;font-weight:600;color:#475569;display:block;margin-bottom:4px;"><?= get_string('external_link_url', 'local_istikama_admin') ?></label>
        <input type="text" id="isti-cb-modal-extlink"
               style="width:100%;padding:9px 11px;border:1px solid #cbd5e1;border-radius:8px;font-size:13px;margin-bottom:14px;">

        <!-- Read-only info -->
        <div style="background:#f1f5f9;border-radius:8px;padding:10px 12px;margin-bottom:14px;font-size:12px;color:#475569;display:flex;gap:14px;flex-wrap:wrap;">
          <span><strong><?= get_string('content_type', 'local_istikama_admin') ?>:</strong> <span id="isti-cb-modal-type">—</span></span>
          <span><strong><?= get_string('uploaded_by', 'local_istikama_admin') ?>:</strong> <span id="isti-cb-modal-uploader">—</span></span>
          <span><strong><?= get_string('created', 'local_istikama_admin') ?>:</strong> <span id="isti-cb-modal-created">—</span></span>
        </div>

        <!-- Moderation history -->
        <h6 style="margin:18px 0 8px;font-size:13px;font-weight:700;color:#0f172a;">
          <i class="fa fa-history" style="color:#006bff;margin-right:4px;"></i><?= get_string('lib_moderation_history', 'local_istikama_admin') ?>
        </h6>
        <div id="isti-cb-modal-history" style="max-height:160px;overflow-y:auto;border:1px solid #e2e8f0;border-radius:8px;padding:8px 12px;background:#fff;"></div>
      </div>
    </div>

    <!-- Footer -->
    <div style="padding:14px 22px;border-top:1px solid #e2e8f0;background:#f8fafc;display:flex;justify-content:flex-end;gap:10px;flex-shrink:0;">
      <button type="button" data-cb-close style="background:#e2e8f0;color:#0f172a;border:0;padding:9px 18px;border-radius:8px;cursor:pointer;font-size:13px;font-weight:500;"><?= get_string('cancel') ?></button>
      <button type="button" id="isti-cb-modal-save" style="background:#059669;color:#fff;border:0;padding:9px 22px;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;">
        <i class="fa fa-save"></i> <?= get_string('save_changes', 'local_istikama_admin') ?>
      </button>
    </div>
  </div>
</div>

<?php
$PAGE->requires->js(new moodle_url('/local/istikama_admin/js/contentbank.js'));

echo '</div></div>'; // end content and container from layout
echo '<div style="margin-top:30px;padding-top:20px;border-top:1px solid #dee2e6;">';
echo '<p style="text-align:center;color:#6c757d;">Istikama Admin &copy; ' . date('Y') . '</p>';
echo '</div>';
echo $OUTPUT->footer();
?>

