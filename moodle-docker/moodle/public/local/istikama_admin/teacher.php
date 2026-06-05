<?php
/**
 * Teacher Interface — Single Entry Point
 * Sections: dashboard, classlibrary, library, classes, classview
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_teacher();

global $DB, $USER, $PAGE, $OUTPUT;

$section   = optional_param('section', 'dashboard', PARAM_ALPHAEXT);
$classid   = optional_param('classid', 0, PARAM_INT);
$subjectid = optional_param('subjectid', '', PARAM_TEXT);
$classtab  = optional_param('classtab', 'students', PARAM_ALPHAEXT);

$schoolid = local_istikama_admin_get_teacher_school();
if (!$schoolid) {
    throw new \moodle_exception('sm_no_school_assigned', 'local_istikama_admin');
}
$schoolname = '';
try {
    $schoolcat = core_course_category::get($schoolid);
    $schoolname = format_string($schoolcat->name);
} catch (\Exception $e) {
    throw new \moodle_exception('sm_no_school_assigned', 'local_istikama_admin');
}

$assignments = local_istikama_admin_get_teacher_assignments();
$classids    = local_istikama_admin_get_teacher_classes();

// Resolve which season the teacher is viewing (request > preference > active).
$viewseasonid = local_istikama_admin_resolve_view_seasonid();

// Collect teacher level IDs (for question/quiz bank filtering).
$teacher_levelids = [];
foreach ($assignments as $a) {
    if (!empty($a->levelid)) {
        $teacher_levelids[(int)$a->levelid] = (int)$a->levelid;
    }
}
$teacher_levelids = array_values($teacher_levelids);

$baseurl = new moodle_url('/local/istikama_admin/teacher.php');
$context = context_system::instance();

// ── POST handlers ──────────────────────────────────────────────────────────
$action = optional_param('action', '', PARAM_ALPHA);
if ($action && confirm_sesskey()) {
    if ($action === 'uploadcontent') {
        $ctype   = required_param('content_type', PARAM_ALPHA);
        $name    = required_param('content_name', PARAM_TEXT);
        $subject = optional_param('subject', '', PARAM_TEXT);
        $description = optional_param('description', '', PARAM_RAW);
        $keywords    = optional_param('keywords', '', PARAM_TEXT);
        $external_url = optional_param('external_url', '', PARAM_URL);

        $record = new stdClass();
        $record->name = $name;
        $record->content_type = $ctype;
        $record->subject = $subject;
        $record->description = $description;
        $record->keywords = $keywords;
        $record->external_url = $external_url;
        $record->status = 'pending';
        $record->uploaded_by = $USER->id;
        $record->timecreated = time();
        $record->timemodified = time();

        $draftitemid = optional_param('content_file', 0, PARAM_INT);
        if ($draftitemid) {
            $record->file_itemid = $draftitemid;
            $fs = get_file_storage();
            $usercontext = context_user::instance($USER->id);
            $files = $fs->get_area_files($usercontext->id, 'user', 'draft', $draftitemid, 'id', false);
            if (!empty($files)) {
                $file   = reset($files);
                $record->filename = $file->get_filename();
                $newid  = $DB->insert_record('istikama_content_bank', $record);
                $fs->create_file_from_storedfile([
                    'contextid' => $context->id, 'component' => 'local_istikama_admin',
                    'filearea'  => 'content', 'itemid' => $newid,
                    'filepath'  => '/', 'filename' => $file->get_filename(),
                ], $file);
            } else {
                $DB->insert_record('istikama_content_bank', $record);
            }
        } else {
            $DB->insert_record('istikama_content_bank', $record);
        }
        \core\notification::success(get_string('classlibrary_content_uploaded', 'local_istikama_admin'));
        redirect(new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'library', 'libtab' => 'myfiles']));
    }

    if ($action === 'createactivity') {
        $name   = required_param('activity_name', PARAM_TEXT);
        $type   = 'quiz';
        $desc   = optional_param('activity_desc', '', PARAM_RAW);
        $subject = optional_param('subject', '', PARAM_TEXT);
        $target_classid = optional_param('target_classid', 0, PARAM_INT);
        $seasonid = local_istikama_admin_resolve_write_seasonid();
        local_istikama_admin_guard_season_writes($seasonid);
        $rec = (object)[
            'name' => $name, 'type' => $type, 'description' => $desc,
            'created_by' => $USER->id, 'schoolid' => $schoolid,
            'classid' => $target_classid ?: null, 'subject' => $subject,
            'status' => 'active',
            'seasonid' => $seasonid ?: null,
            'timecreated' => time(), 'timemodified' => time(),
        ];
        $DB->insert_record('istikama_teacher_activities', $rec);
        \core\notification::success(get_string('classlibrary_activity_created', 'local_istikama_admin'));
        redirect(new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classlibrary', 'cltab' => 'addactivity']));
    }

    if ($action === 'linkcontent') {
        $content_id    = required_param('content_id', PARAM_INT);
        $courseid      = required_param('courseid', PARAM_INT);
        $link_classid  = required_param('link_classid', PARAM_INT);
        if (!local_istikama_admin_teacher_has_class($link_classid)) {
            throw new \moodle_exception('accessdenied', 'admin');
        }
        if (!$DB->record_exists('istikama_content_lesson_link', ['content_id' => $content_id, 'courseid' => $courseid, 'classid' => $link_classid])) {
            $DB->insert_record('istikama_content_lesson_link', (object)[
                'content_id' => $content_id, 'courseid' => $courseid, 'classid' => $link_classid,
                'linked_by' => $USER->id, 'timecreated' => time(),
            ]);
        }
        \core\notification::success(get_string('classlibrary_content_linked', 'local_istikama_admin'));
        redirect(new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classlibrary']));
    }

    if ($action === 'linkactivity') {
        $activity_id  = required_param('activity_id', PARAM_INT);
        $courseid     = required_param('courseid', PARAM_INT);
        $link_classid = required_param('link_classid', PARAM_INT);
        if (!local_istikama_admin_teacher_has_class($link_classid)) {
            throw new \moodle_exception('accessdenied', 'admin');
        }
        if (!$DB->record_exists('istikama_activity_lesson_link', ['activity_id' => $activity_id, 'courseid' => $courseid, 'classid' => $link_classid])) {
            $DB->insert_record('istikama_activity_lesson_link', (object)[
                'activity_id' => $activity_id, 'courseid' => $courseid, 'classid' => $link_classid,
                'linked_by' => $USER->id, 'timecreated' => time(),
            ]);
        }
        \core\notification::success(get_string('classlibrary_activity_linked', 'local_istikama_admin'));
        redirect(new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classlibrary']));
    }

    if ($action === 'saveattendance' && $classid) {
        if (!local_istikama_admin_teacher_has_class($classid)) {
            throw new \moodle_exception('accessdenied', 'admin');
        }
        $attend_date = required_param('attend_date', PARAM_TEXT);
        $statuses   = optional_param_array('att_status',   [], PARAM_ALPHA);
        $behaviors  = optional_param_array('att_behavior', [], PARAM_RAW);
        $seasonid = local_istikama_admin_resolve_write_seasonid();
        local_istikama_admin_guard_season_writes($seasonid);
        foreach ($statuses as $studentid => $status) {
            $existing = $DB->get_record('istikama_attendance', ['studentid' => $studentid, 'classid' => $classid, 'attend_date' => $attend_date]);
            if ($existing) {
                // Updating an existing row: block writes if the row belongs to an
                // archived/closed season.
                if (!empty($existing->seasonid)) {
                    local_istikama_admin_guard_season_writes((int)$existing->seasonid);
                }
                $existing->status = $status;
                $existing->behavior_note = $behaviors[$studentid] ?? '';
                $existing->timemodified  = time();
                $DB->update_record('istikama_attendance', $existing);
            } else {
                $DB->insert_record('istikama_attendance', (object)[
                    'studentid' => $studentid, 'classid' => $classid, 'attend_date' => $attend_date,
                    'status' => $status, 'behavior_note' => $behaviors[$studentid] ?? '',
                    'recorded_by' => $USER->id,
                    'seasonid' => $seasonid ?: null,
                    'timecreated' => time(), 'timemodified' => time(),
                ]);
            }
        }
        \core\notification::success(get_string('attendance_saved', 'local_istikama_admin'));
        redirect(new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classview', 'classid' => $classid, 'classtab' => 'attendance']));
    }

    if ($action === 'saveassessment' && $classid) {
        if (!local_istikama_admin_teacher_has_class($classid)) {
            throw new \moodle_exception('accessdenied', 'admin');
        }
        $studentid = required_param('studentid', PARAM_INT);
        $title     = required_param('assess_title', PARAM_TEXT);
        $subject_a = required_param('assess_subject', PARAM_TEXT);
        $score     = optional_param('score', null, PARAM_FLOAT);
        $max_score = optional_param('max_score', null, PARAM_FLOAT);
        $notes     = optional_param('assess_notes', '', PARAM_RAW);
        $seasonid = local_istikama_admin_resolve_write_seasonid();
        local_istikama_admin_guard_season_writes($seasonid);
        $DB->insert_record('istikama_assessments', (object)[
            'studentid' => $studentid, 'classid' => $classid, 'subject' => $subject_a,
            'title' => $title, 'score' => $score, 'max_score' => $max_score,
            'notes' => $notes, 'assessed_by' => $USER->id,
            'seasonid' => $seasonid ?: null,
            'timecreated' => time(), 'timemodified' => time(),
        ]);
        \core\notification::success(get_string('assessment_saved', 'local_istikama_admin'));
        redirect(new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classview', 'classid' => $classid, 'classtab' => 'assessments']));
    }
}

if ($section === 'classview' && $classid) {
    if (!local_istikama_admin_teacher_has_class($classid)) {
        throw new \moodle_exception('accessdenied', 'admin');
    }
}

// ── Page setup ──────────────────────────────────────────────────────────────
$PAGE->set_url(new moodle_url('/local/istikama_admin/teacher.php', ['section' => $section]));
$PAGE->set_context($context);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('teacher_section_' . ($section === 'classview' ? 'classes' : $section), 'local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

local_istikama_admin_print_header('');

$dir       = right_to_left() ? 'rtl' : 'ltr';
$textalign = right_to_left() ? 'right' : 'left';

// ── Shared helpers ──────────────────────────────────────────────────────────
function isti_teacher_type_icon(string $type): string {
    $icons = ['document' => 'fa-file-alt', 'video' => 'fa-video', 'h5p' => 'fa-cube',
              'book' => 'fa-book', 'quiz' => 'fa-question-circle', 'link' => 'fa-link'];
    return $icons[$type] ?? 'fa-file';
}
function isti_teacher_type_color(string $type): string {
    $colors = ['document' => '#006bff', 'video' => '#8b5cf6', 'h5p' => '#f59e0b',
               'book' => '#10b981', 'quiz' => '#ec4899', 'link' => '#06b6d4'];
    return $colors[$type] ?? '#64748b';
}
function isti_status_badge(string $status): string {
    $map = [
        'approved' => ['isti-badge-success', 'fa-check-circle', 'Approved'],
        'pending'  => ['isti-badge-warning', 'fa-clock', 'Pending'],
        'rejected' => ['isti-badge-danger',  'fa-times-circle', 'Rejected'],
        'active'   => ['isti-badge-success', 'fa-check', 'Active'],
    ];
    [$cls, $ico, $lbl] = $map[$status] ?? ['isti-badge-neutral', 'fa-circle', ucfirst($status)];
    return '<span class="isti-badge ' . $cls . '"><i class="fa ' . $ico . '"></i> ' . $lbl . '</span>';
}

// ─────────────────────────────────────────────────────────────────────────────
// ══ DASHBOARD ══
// ─────────────────────────────────────────────────────────────────────────────
if ($section === 'dashboard') {
    $total_classes   = count($classids);
    $total_students  = 0;
    foreach ($classids as $cid) {
        [$swhere, $sparams] = local_istikama_admin_season_where_sql($viewseasonid);
        $total_students += (int)$DB->count_records_sql(
            "SELECT COUNT(1) FROM {istikama_user_school} WHERE classid = :cid AND role = 'student' $swhere",
            array_merge(['cid' => $cid], $sparams));
    }
    $my_content    = (int)$DB->count_records('istikama_content_bank', ['uploaded_by' => $USER->id]);
    $my_activities = 0;
    try { $my_activities = (int)$DB->count_records('istikama_teacher_activities', ['created_by' => $USER->id]); } catch (\Exception $e) {}
    $pending = (int)$DB->count_records('istikama_content_bank', ['uploaded_by' => $USER->id, 'status' => 'pending']);
    ?>
    <div class="container-fluid" dir="<?= $dir ?>" style="background:#f1f5f9;min-height:600px;margin:-24px;padding:24px;">

        <div style="margin-bottom:24px">
            <h4 style="margin:0 0 4px 0;font-weight:700;color:#1e293b">
                <?= get_string('teacher_welcome', 'local_istikama_admin', fullname($USER)) ?>
            </h4>
            <span style="font-size:.88rem;color:#64748b"><i class="fa fa-school"></i> <?= s($schoolname) ?></span>
        </div>

        <!-- KPI tiles -->
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(170px,1fr));gap:14px;margin-bottom:28px">
            <?php
            $kpis = [
                ['fa-chalkboard', '#006bff', $total_classes,   get_string('teacher_total_classes',    'local_istikama_admin')],
                ['fa-users',      '#10b981', $total_students,  get_string('teacher_total_students',   'local_istikama_admin')],
                ['fa-file-alt',   '#8b5cf6', $my_content,      get_string('teacher_total_content',    'local_istikama_admin')],
                ['fa-clipboard-check', '#f59e0b', $my_activities, get_string('teacher_total_activities','local_istikama_admin')],
                ['fa-clock',      '#ef4444', $pending,         get_string('teacher_pending_content',  'local_istikama_admin')],
            ];
            foreach ($kpis as [$ico, $clr, $val, $lbl]): ?>
            <div class="isti-card" style="padding:18px 16px;text-align:center">
                <span style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:12px;background:<?= $clr ?>15;color:<?= $clr ?>;font-size:1.2rem;margin-bottom:10px">
                    <i class="fa <?= $ico ?>"></i>
                </span>
                <div style="font-size:1.6rem;font-weight:700;color:#1e293b;line-height:1"><?= $val ?></div>
                <div style="font-size:.78rem;color:#64748b;margin-top:4px"><?= $lbl ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Quick actions -->
        <div class="isti-card" style="padding:18px 22px;margin-bottom:24px">
            <h6 style="margin:0 0 14px 0;font-weight:700;color:#1e293b"><?= get_string('teacher_quick_actions', 'local_istikama_admin') ?></h6>
            <div style="display:flex;flex-wrap:wrap;gap:10px">
                <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'library', 'libtab' => 'central']))->out(false) ?>" class="isti-btn isti-btn-primary"><i class="fa fa-book-open"></i> <?= get_string('btn_central_library', 'local_istikama_admin') ?></a>
                <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'library', 'libtab' => 'questions']))->out(false) ?>" class="isti-btn isti-btn-primary" style="background:#10b981;border-color:#10b981"><i class="fa fa-database"></i> <?= get_string('btn_question_bank', 'local_istikama_admin') ?></a>
                <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'library', 'libtab' => 'quizzes']))->out(false) ?>" class="isti-btn isti-btn-primary" style="background:#8b5cf6;border-color:#8b5cf6"><i class="fa fa-question-circle"></i> <?= get_string('btn_quizzes', 'local_istikama_admin') ?></a>
                <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classes']))->out(false) ?>" class="isti-btn isti-btn-outline"><i class="fa fa-chalkboard"></i> <?= get_string('classes_taught', 'local_istikama_admin') ?></a>
                <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'library', 'libtab' => 'myfiles']))->out(false) ?>" class="isti-btn isti-btn-outline"><i class="fa fa-upload"></i> <?= get_string('library_my_files', 'local_istikama_admin') ?></a>
            </div>
        </div>

        <!-- Classes summary -->
        <?php if (!empty($assignments)): ?>
        <h6 style="margin:0 0 14px 0;font-weight:700;color:#1e293b"><i class="fa fa-chalkboard" style="color:#006bff"></i> <?= get_string('classes_taught', 'local_istikama_admin') ?></h6>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:14px">
            <?php foreach ($assignments as $a):
                [$swhere2, $sparams2] = local_istikama_admin_season_where_sql($viewseasonid);
                $scount = $a->classid ? (int)$DB->count_records_sql("SELECT COUNT(1) FROM {istikama_user_school} WHERE classid = :cid AND role = 'student' $swhere2", array_merge(['cid' => $a->classid], $sparams2)) : 0;
                $url = $a->classid ? (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classview', 'classid' => $a->classid]))->out(false) : '#';
            ?>
            <a href="<?= $url ?>" class="isti-card" style="padding:18px 20px;text-decoration:none;display:block;transition:box-shadow .15s;border:1.5px solid #e2e8f0" onmouseover="this.style.borderColor='#006bff'" onmouseout="this.style.borderColor='#e2e8f0'">
                <div style="font-weight:700;font-size:1rem;color:#1e293b;margin-bottom:4px"><?= s($a->classname ?: '—') ?></div>
                <div style="font-size:.82rem;color:#64748b;margin-bottom:10px"><?= s($a->levelname ?? '') ?> · <?= s($a->schoolname ?? '') ?></div>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                    <span class="isti-badge isti-badge-primary"><i class="fa fa-users"></i> <?= $scount ?> <?= get_string('students_count', 'local_istikama_admin') ?></span>
                    <?php if (!empty($a->subjects)): ?>
                    <span class="isti-badge isti-badge-neutral"><i class="fa fa-book"></i> <?= count($a->subjects) ?> <?= get_string('subjects_count', 'local_istikama_admin') ?></span>
                    <?php endif; ?>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php
}

// ─────────────────────────────────────────────────────────────────────────────
// ══ CLASS LIBRARY (content bank flow) ══
// ─────────────────────────────────────────────────────────────────────────────
if ($section === 'classlibrary') {
    $cltab = optional_param('cltab', 'addcontent', PARAM_ALPHAEXT);
    $cltabs = [
        'addcontent'   => ['fa-folder-open',  get_string('classlibrary_tab_add',    'local_istikama_admin')],
        'addactivity'  => ['fa-plus-circle',  get_string('classlibrary_tab_create', 'local_istikama_admin')],
        'linkactivity' => ['fa-link',         get_string('classlibrary_tab_link',   'local_istikama_admin')],
    ];
    $courses_for_link = [];
    foreach ($classids as $cid) {
        $tsubs = local_istikama_admin_get_teacher_class_subjects($cid);
        try {
            $cat = core_course_category::get($cid);
            foreach ($cat->get_courses() as $c) {
                if (in_array((string)$c->id, $tsubs)) {
                    $courses_for_link[$c->id] = format_string($c->fullname) . ' (' . format_string($cat->name) . ')';
                }
            }
        } catch (\Exception $e) {}
    }
    ?>
    <div class="container-fluid" dir="<?= $dir ?>" style="background:#f1f5f9;min-height:600px;margin:-24px;padding:24px;">
        <!-- Tabs -->
        <div class="isti-tabs isti-tabs-modern" style="margin-bottom:22px" role="tablist">
            <?php foreach ($cltabs as $k => [$ico, $lbl]):
                $cltaburl = new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classlibrary', 'cltab' => $k]);
                $clactive = ($cltab === $k);
            ?>
            <a href="<?= $cltaburl->out(true) ?>"
               class="isti-tab <?= $clactive ? 'active' : '' ?>"
               role="tab"
               aria-selected="<?= $clactive ? 'true' : 'false' ?>">
                <i class="fa <?= $ico ?>"></i><?= $lbl ?>
            </a>
            <?php endforeach; ?>
        </div>

        <?php if ($cltab === 'addcontent'):
            $cb_filter_type = optional_param('cbtype', '', PARAM_ALPHA);
            $cb_search      = optional_param('cbq', '', PARAM_TEXT);
            $cb_where = "status = 'approved'";
            $cb_params = [];
            if ($cb_search) {
                $cb_where .= " AND (name LIKE :q1 OR keywords LIKE :q2)";
                $cb_params['q1'] = "%{$cb_search}%";
                $cb_params['q2'] = "%{$cb_search}%";
            }
            if ($cb_filter_type) { $cb_where .= " AND content_type = :ftype"; $cb_params['ftype'] = $cb_filter_type; }
            $approved = $DB->get_records_select('istikama_content_bank', $cb_where, $cb_params, 'timecreated DESC', '*', 0, 100);
        ?>
        <!-- Filter row -->
        <div class="isti-card" style="padding:14px 18px;margin-bottom:16px;display:flex;gap:10px;align-items:center;flex-wrap:wrap">
            <form method="get" style="display:contents">
                <input type="hidden" name="section" value="classlibrary">
                <input type="hidden" name="cltab" value="addcontent">
                <select name="cbtype" class="isti-form-select" style="max-width:160px;font-size:.88rem">
                    <option value=""><?= get_string('t_all_types','local_istikama_admin') ?></option>
                    <?php foreach (['document' => 'Document', 'video' => 'Video', 'h5p' => 'H5P', 'book' => 'Book', 'link' => 'Link'] as $k => $v): ?>
                    <option value="<?= $k ?>" <?= $cb_filter_type === $k ? 'selected' : '' ?>><?= $v ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="cbq" value="<?= s($cb_search) ?>" placeholder="Search content…" class="isti-form-input" style="flex:1;min-width:200px;font-size:.88rem">
                <button type="submit" class="isti-btn isti-btn-primary"><i class="fa fa-search"></i> <?= get_string('pk_filter','local_istikama_admin') ?></button>
            </form>
        </div>

        <?php if (empty($approved)): ?>
        <div class="isti-card" style="text-align:center;padding:48px 20px">
            <i class="fa fa-folder-open" style="font-size:2.5rem;color:#cbd5e1;display:block;margin-bottom:12px"></i>
            <p style="color:#64748b"><?= get_string('t_no_central_content','local_istikama_admin') ?></p>
        </div>
        <?php else: ?>
        <div class="isti-card" style="padding:0;overflow:hidden">
            <div class="table-responsive">
                <table class="isti-table">
                    <thead><tr>
                        <th style="width:44px"></th>
                        <th><?= get_string('act_col_name','local_istikama_admin') ?></th>
                        <th><?= get_string('act_col_type','local_istikama_admin') ?></th>
                        <th><?= get_string('act_col_subject','local_istikama_admin') ?></th>
                        <th style="text-align:right"><?= get_string('t_col_added','local_istikama_admin') ?></th>
                        <th style="text-align:center;width:180px"><?= get_string('act_col_actions','local_istikama_admin') ?></th>
                    </tr></thead>
                    <tbody>
                        <?php foreach ($approved as $item):
                            $ico   = isti_teacher_type_icon($item->content_type);
                            $clr   = isti_teacher_type_color($item->content_type);
                            $furl  = '';
                            if (!empty($item->external_url)) { $furl = $item->external_url; }
                            elseif (!empty($item->filename)) {
                                $furl = moodle_url::make_pluginfile_url($context->id, 'local_istikama_admin', 'content', $item->id, '/', $item->filename)->out(false);
                            }
                        ?>
                        <tr>
                            <td><span class="isti-qtype-pill" style="background:<?= $clr ?>15;color:<?= $clr ?>"><i class="fa <?= $ico ?>"></i></span></td>
                            <td>
                                <strong><?= format_string($item->name) ?></strong>
                                <?php if ($item->description): ?>
                                <div style="font-size:.8rem;color:#64748b"><?= s(substr(strip_tags($item->description), 0, 80)) ?></div>
                                <?php endif; ?>
                            </td>
                            <td><span class="isti-badge" style="background:<?= $clr ?>15;color:<?= $clr ?>"><?= ucfirst($item->content_type) ?></span></td>
                            <td><?= s($item->subject ?: '—') ?></td>
                            <td style="text-align:right;font-size:.82rem;color:#64748b"><?= userdate($item->timecreated, get_string('strftimedatetimeshort', 'langconfig')) ?></td>
                            <td style="text-align:center;white-space:nowrap">
                                <?php if ($furl): ?>
                                <a href="<?= (new moodle_url('/local/istikama_admin/view_cb_content.php', ['id' => (int)$item->id]))->out(false) ?>" class="isti-icon-btn" title="Preview"><i class="fa fa-eye"></i></a>
                                <?php endif; ?>
                                <!-- inline link form -->
                                <form method="post" action="<?= $baseurl->out(false) ?>" style="display:inline-flex;gap:4px;align-items:center">
                                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                                    <input type="hidden" name="action" value="linkcontent">
                                    <input type="hidden" name="content_id" value="<?= $item->id ?>">
                                    <select name="link_classid" class="isti-form-select" required style="font-size:.78rem;padding:2px 6px;max-width:120px">
                                        <option value=""><?= get_string('t_opt_class','local_istikama_admin') ?></option>
                                        <?php foreach ($assignments as $a) { if ($a->classid) echo '<option value="' . $a->classid . '">' . s($a->classname) . '</option>'; } ?>
                                    </select>
                                    <select name="courseid" class="isti-form-select" required style="font-size:.78rem;padding:2px 6px;max-width:120px">
                                        <option value=""><?= get_string('t_opt_lesson','local_istikama_admin') ?></option>
                                        <?php foreach ($courses_for_link as $cid => $cname) echo '<option value="' . $cid . '">' . s($cname) . '</option>'; ?>
                                    </select>
                                    <button type="submit" class="isti-btn isti-btn-primary" style="padding:3px 8px;font-size:.78rem"><i class="fa fa-plus"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <?php elseif ($cltab === 'addactivity'): ?>
        <div class="isti-card" style="padding:22px;max-width:640px">
            <h6 style="font-weight:700;color:#1e293b;margin-bottom:16px"><i class="fa fa-plus-circle" style="color:#006bff"></i> Create a New Quiz/Activity</h6>
            <form method="post" action="<?= $baseurl->out(false) ?>">
                <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                <input type="hidden" name="action" value="createactivity">
                <div class="isti-form-group" style="margin-bottom:14px">
                    <label class="isti-form-label"><?= get_string('t_lbl_activity_name','local_istikama_admin') ?> *</label>
                    <input type="text" class="isti-form-input" name="activity_name" required>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:14px">
                    <div class="isti-form-group">
                        <label class="isti-form-label"><?= get_string('act_col_subject','local_istikama_admin') ?></label>
                        <select class="isti-form-select" name="subject">
                            <option value="">—</option>
                            <?php foreach (['math','science','arabic','french','english','islamic','history','physics','chemistry','biology','informatics','philosophy','other'] as $k): ?>
                            <option value="<?= $k ?>"><?= get_string('subject_' . $k, 'local_istikama_admin') ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="isti-form-group">
                        <label class="isti-form-label"><?= get_string('t_lbl_class','local_istikama_admin') ?></label>
                        <select class="isti-form-select" name="target_classid">
                            <option value="">—</option>
                            <?php foreach ($assignments as $a) { if ($a->classid) echo '<option value="' . $a->classid . '">' . s($a->classname) . '</option>'; } ?>
                        </select>
                    </div>
                </div>
                <div class="isti-form-group" style="margin-bottom:16px">
                    <label class="isti-form-label"><?= get_string('t_lbl_description','local_istikama_admin') ?></label>
                    <textarea class="isti-form-input" name="activity_desc" rows="3" style="resize:vertical"></textarea>
                </div>
                <button type="submit" class="isti-btn isti-btn-primary"><i class="fa fa-plus"></i> <?= get_string('create_activity_btn', 'local_istikama_admin') ?></button>
            </form>
        </div>
        <div class="isti-card" style="padding:14px 18px;margin-top:14px;background:#eff6ff;border:1.5px solid #bfdbfe">
            <p style="margin:0;font-size:.88rem;color:#1e40af">
                <i class="fa fa-info-circle"></i>
                For full quiz management (with question bank), use the
                <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'library', 'libtab' => 'quizzes']))->out(false) ?>">Quizzes tab</a>.
            </p>
        </div>

        <?php elseif ($cltab === 'linkactivity'):
            $my_acts = [];
            try { $my_acts = $DB->get_records('istikama_teacher_activities', ['created_by' => $USER->id], 'name ASC'); } catch (\Exception $e) {}
        ?>
        <?php if (empty($my_acts)): ?>
        <div class="isti-card" style="text-align:center;padding:48px 20px;color:#94a3b8">
            <i class="fa fa-clipboard-list" style="font-size:2.5rem;display:block;margin-bottom:12px;color:#cbd5e1"></i>
            <p><?= get_string('t_no_activities','local_istikama_admin') ?> <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classlibrary', 'cltab' => 'addactivity']))->out(false) ?>">Create one first.</a></p>
        </div>
        <?php else: ?>
        <div class="isti-card" style="padding:22px;max-width:640px">
            <h6 style="font-weight:700;color:#1e293b;margin-bottom:16px"><i class="fa fa-link" style="color:#006bff"></i> <?= get_string('link_activity_title', 'local_istikama_admin') ?></h6>
            <form method="post" action="<?= $baseurl->out(false) ?>">
                <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                <input type="hidden" name="action" value="linkactivity">
                <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:14px">
                    <div class="isti-form-group">
                        <label class="isti-form-label"><?= get_string('t_lbl_activity','local_istikama_admin') ?></label>
                        <select class="isti-form-select" name="activity_id" required>
                            <?php foreach ($my_acts as $a) echo '<option value="' . $a->id . '">' . s($a->name) . '</option>'; ?>
                        </select>
                    </div>
                    <div class="isti-form-group">
                        <label class="isti-form-label"><?= get_string('t_lbl_class','local_istikama_admin') ?></label>
                        <select class="isti-form-select" name="link_classid" required>
                            <?php foreach ($assignments as $a) { if ($a->classid) echo '<option value="' . $a->classid . '">' . s($a->classname) . '</option>'; } ?>
                        </select>
                    </div>
                    <div class="isti-form-group">
                        <label class="isti-form-label"><?= get_string('t_lbl_lesson','local_istikama_admin') ?></label>
                        <select class="isti-form-select" name="courseid" required>
                            <option value="">—</option>
                            <?php foreach ($courses_for_link as $cid => $cname) echo '<option value="' . $cid . '">' . s($cname) . '</option>'; ?>
                        </select>
                    </div>
                </div>
                <button type="submit" class="isti-btn isti-btn-primary"><i class="fa fa-link"></i> <?= get_string('link_activity_btn', 'local_istikama_admin') ?></button>
            </form>
        </div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
    <?php
}

// ─────────────────────────────────────────────────────────────────────────────
// ══ LIBRARY ══
// ─────────────────────────────────────────────────────────────────────────────
if ($section === 'library') {
    $libtab = optional_param('libtab', 'central', PARAM_ALPHAEXT);
    $libtabs = [
        'central'   => ['fa-book-open',       get_string('libtab_central',    'local_istikama_admin')],
        'questions' => ['fa-database',        get_string('libtab_questions',  'local_istikama_admin')],
        'quizzes'   => ['fa-question-circle', get_string('libtab_quizzes',    'local_istikama_admin')],
        'myfiles'   => ['fa-upload',          get_string('libtab_myuploads',  'local_istikama_admin')],
    ];
    ?>
    <div class="container-fluid" dir="<?= $dir ?>" style="background:#f1f5f9;min-height:600px;margin:-24px;padding:24px;">

        <!-- Tabs (proper anchor tags so HTML attribute escaping & native cmd/ctrl-click work) -->
        <div class="isti-tabs isti-tabs-modern" style="margin-bottom:22px" role="tablist">
            <?php foreach ($libtabs as $k => [$ico, $lbl]):
                $taburl = new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'library', 'libtab' => $k]);
                $isactive = ($libtab === $k);
            ?>
            <a href="<?= $taburl->out(true) ?>"
               class="isti-tab <?= $isactive ? 'active' : '' ?>"
               role="tab"
               aria-selected="<?= $isactive ? 'true' : 'false' ?>"
               aria-current="<?= $isactive ? 'page' : 'false' ?>">
                <i class="fa <?= $ico ?>"></i><?= $lbl ?>
            </a>
            <?php endforeach; ?>
        </div>

    <?php
    // ── CENTRAL LIBRARY ──────────────────────────────────────────────────────
    if ($libtab === 'central'):
        $cb_search  = optional_param('cbq',    '', PARAM_TEXT);
        $cb_type    = optional_param('cbtype', '', PARAM_ALPHA);
        $cb_where   = "status = 'approved'";
        $cb_params  = [];
        if ($cb_search) {
            $cb_where .= " AND (name LIKE :q1 OR keywords LIKE :q2 OR description LIKE :q3)";
            $cb_params['q1'] = "%{$cb_search}%";
            $cb_params['q2'] = "%{$cb_search}%";
            $cb_params['q3'] = "%{$cb_search}%";
        }
        if ($cb_type) { $cb_where .= " AND content_type = :ftype"; $cb_params['ftype'] = $cb_type; }
        $approved = $DB->get_records_select('istikama_content_bank', $cb_where, $cb_params, 'timecreated DESC', '*', 0, 100);
    ?>
    <!-- Filter -->
    <div class="isti-card" style="padding:12px 18px;margin-bottom:16px;display:flex;gap:10px;align-items:center;flex-wrap:wrap">
        <form method="get" style="display:contents">
            <input type="hidden" name="section" value="library">
            <input type="hidden" name="libtab" value="central">
            <select name="cbtype" class="isti-form-select" style="max-width:160px;font-size:.88rem">
                <option value=""><?= get_string('all_types', 'local_istikama_admin') ?></option>
                <?php foreach (['document','video','h5p','book','link'] as $t): ?>
                <option value="<?= $t ?>" <?= $cb_type === $t ? 'selected' : '' ?>><?= ucfirst($t) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="cbq" value="<?= s($cb_search) ?>" placeholder="<?= get_string('search_placeholder', 'local_istikama_admin') ?>"
                   class="isti-form-input" style="flex:1;min-width:200px;font-size:.88rem">
            <button type="submit" class="isti-btn isti-btn-primary"><i class="fa fa-search"></i> <?= get_string('filter_apply', 'local_istikama_admin') ?></button>
            <?php if ($cb_search || $cb_type): ?>
            <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'library', 'libtab' => 'central']))->out(false) ?>" class="isti-btn isti-btn-outline"><?= get_string('filter_reset', 'local_istikama_admin') ?></a>
            <?php endif; ?>
        </form>
    </div>

    <?php if (empty($approved)): ?>
    <div class="isti-card" style="text-align:center;padding:64px 20px;color:#94a3b8">
        <i class="fa fa-book-open" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
        <p style="font-size:1rem;color:#475569;font-weight:500"><?= get_string('no_approved_content', 'local_istikama_admin') ?></p>
    </div>
    <?php else: ?>
    <div class="isti-card" style="padding:0;overflow:hidden">
        <div class="table-responsive">
            <table class="isti-table">
                <thead><tr>
                    <th style="width:44px"></th>
                    <th><?= get_string('col_name', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_type', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_subject', 'local_istikama_admin') ?></th>
                    <th style="text-align:right"><?= get_string('col_date', 'local_istikama_admin') ?></th>
                    <th style="text-align:center;width:100px"><?= get_string('col_preview', 'local_istikama_admin') ?></th>
                </tr></thead>
                <tbody>
                    <?php foreach ($approved as $item):
                        $ico = isti_teacher_type_icon($item->content_type);
                        $clr = isti_teacher_type_color($item->content_type);
                        $furl = '';
                        if (!empty($item->external_url)) { $furl = $item->external_url; }
                        elseif (!empty($item->filename)) {
                            $furl = moodle_url::make_pluginfile_url($context->id, 'local_istikama_admin', 'content', $item->id, '/', $item->filename)->out(false);
                        }
                    ?>
                    <tr>
                        <td><span class="isti-qtype-pill" style="background:<?= $clr ?>15;color:<?= $clr ?>"><i class="fa <?= $ico ?>"></i></span></td>
                        <td>
                            <strong><?= format_string($item->name) ?></strong>
                            <?php if ($item->description): ?><div style="font-size:.8rem;color:#64748b"><?= s(substr(strip_tags($item->description), 0, 90)) ?></div><?php endif; ?>
                        </td>
                        <td><span class="isti-badge" style="background:<?= $clr ?>15;color:<?= $clr ?>"><?= ucfirst($item->content_type) ?></span></td>
                        <td><?= s($item->subject ?: '—') ?></td>
                        <td style="text-align:right;font-size:.82rem;color:#64748b"><?= userdate($item->timecreated, get_string('strftimedatetimeshort', 'langconfig')) ?></td>
                        <td style="text-align:center">
                            <?php if ($furl): ?>
                            <a href="<?= (new moodle_url('/local/istikama_admin/view_cb_content.php', ['id' => (int)$item->id]))->out(false) ?>" class="isti-icon-btn" title="Preview"><i class="fa fa-eye"></i></a>
                            <?php else: ?><span style="color:#cbd5e1">—</span><?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <?php
    // ── QUESTION BANK ─────────────────────────────────────────────────────────
    elseif ($libtab === 'questions'):
        $q_search   = optional_param('q', '', PARAM_TEXT);
        $q_levelid  = optional_param('levelid', 0, PARAM_INT);
        $q_subjectid = optional_param('subjectid', 0, PARAM_INT);
        $q_qtype    = optional_param('qtype', '', PARAM_ALPHANUMEXT);

        // Restrict level options to teacher's levels.
        if (!$q_levelid && !empty($teacher_levelids)) {
            $q_levelid = $teacher_levelids[0];
        }

        // Build level options for dropdown (teacher-scoped).
        $level_opts = [];
        foreach ($teacher_levelids as $lvid) {
            $lvname = $DB->get_field('course_categories', 'name', ['id' => $lvid]);
            if ($lvname) { $level_opts[$lvid] = $lvname; }
        }

        // Build WHERE for question query.
        $q_where  = ["qv.status <> 'hidden'"];
        $q_params = [];
        if ($q_levelid) {
            $q_where[] = "iqm.levelid = :levelid";
            $q_params['levelid'] = $q_levelid;
        } elseif (!empty($teacher_levelids)) {
            list($insql, $inparams) = $DB->get_in_or_equal($teacher_levelids, SQL_PARAMS_NAMED, 'tlvl');
            $q_where[] = "iqm.levelid $insql";
            $q_params  = array_merge($q_params, $inparams);
        }
        if ($q_subjectid) {
            $q_where[] = "iqm.subjectid = :subjectid";
            $q_params['subjectid'] = $q_subjectid;
        }
        if ($q_qtype) {
            $q_where[] = "q.qtype = :qtype";
            $q_params['qtype'] = $q_qtype;
        }
        if ($q_search) {
            $q_where[] = '(' . $DB->sql_like('q.name', ':sq1', false) . ' OR ' . $DB->sql_like('q.questiontext', ':sq2', false) . ')';
            $q_params['sq1'] = '%' . $DB->sql_like_escape($q_search) . '%';
            $q_params['sq2'] = '%' . $DB->sql_like_escape($q_search) . '%';
        }
        $q_wheresql = 'WHERE ' . implode(' AND ', $q_where);

        $questions = $DB->get_records_sql("
            SELECT q.id AS qid, q.name AS qname, q.qtype, q.timemodified,
                   q.questiontext AS qtext, q.questiontextformat AS qtextformat,
                   qbe.id AS qbeid,
                   iqm.levelid, iqm.subjectid,
                   lvl.name AS levelname, subj.name AS subjectname,
                   u.firstname AS creatorfirst, u.lastname AS creatorlast
              FROM {question_bank_entries} qbe
              JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
              JOIN (SELECT questionbankentryid, MAX(version) AS maxv
                      FROM {question_versions} WHERE status <> 'hidden'
                  GROUP BY questionbankentryid) latest
                ON latest.questionbankentryid = qbe.id AND latest.maxv = qv.version
              JOIN {question} q ON q.id = qv.questionid
         LEFT JOIN {istikama_question_meta} iqm ON iqm.qbe_id = qbe.id
         LEFT JOIN {course_categories} lvl ON lvl.id = iqm.levelid
         LEFT JOIN {istikama_subject_names} subj ON subj.id = iqm.subjectid
         LEFT JOIN {user} u ON u.id = q.createdby
              $q_wheresql
          ORDER BY q.timemodified DESC
        ", $q_params, 0, 500);

        // Subject options filtered by selected level.
        $subject_opts = [];
        if ($q_levelid) {
            $subs = $DB->get_records('istikama_subject_names', ['level_id' => $q_levelid], 'name ASC', 'id, name');
            foreach ($subs as $s) { $subject_opts[$s->id] = $s->name; }
        }

        $qtype_icons  = ['multichoice'=>'fa-list-ul','truefalse'=>'fa-check-double','shortanswer'=>'fa-keyboard','essay'=>'fa-paragraph','numerical'=>'fa-calculator','match'=>'fa-exchange-alt'];
        $qtype_colors = ['multichoice'=>'#006bff','truefalse'=>'#10b981','shortanswer'=>'#f59e0b','essay'=>'#8b5cf6','numerical'=>'#ec4899','match'=>'#06b6d4'];

        // Get gateway cmid for preview links.
        $gateway_cmid = 0;
        $qbcourse = $DB->get_record('course', ['shortname' => 'ISTIKAMA_QBANK']);
        if ($qbcourse) {
            $gw = $DB->get_record_sql("SELECT cm.id AS cmid FROM {course_modules} cm JOIN {modules} m ON m.id=cm.module AND m.name='quiz' JOIN {quiz} qz ON qz.id=cm.instance AND qz.name='Question Bank Gateway' WHERE cm.course=:cid LIMIT 1", ['cid' => $qbcourse->id]);
            if ($gw) { $gateway_cmid = (int)$gw->cmid; }
        }
    ?>
    <!-- Filter -->
    <div class="isti-card" style="padding:12px 18px;margin-bottom:16px;display:flex;gap:10px;align-items:center;flex-wrap:wrap">
        <form method="get" style="display:contents">
            <input type="hidden" name="section" value="library">
            <input type="hidden" name="libtab" value="questions">
            <select name="levelid" id="q_lvl" class="isti-form-select" style="max-width:180px;font-size:.88rem">
                <option value="0"><?= get_string('t_all_my_levels','local_istikama_admin') ?></option>
                <?php foreach ($level_opts as $lid => $lname): ?>
                <option value="<?= $lid ?>" <?= (int)$q_levelid === $lid ? 'selected' : '' ?>><?= s($lname) ?></option>
                <?php endforeach; ?>
            </select>
            <?php if (!empty($subject_opts)): ?>
            <select name="subjectid" class="isti-form-select" style="max-width:180px;font-size:.88rem">
                <option value="0"><?= get_string('pk_all_subjects','local_istikama_admin') ?></option>
                <?php foreach ($subject_opts as $sid => $sname): ?>
                <option value="<?= $sid ?>" <?= (int)$q_subjectid === $sid ? 'selected' : '' ?>><?= s($sname) ?></option>
                <?php endforeach; ?>
            </select>
            <?php endif; ?>
            <input type="text" name="q" value="<?= s($q_search) ?>" placeholder="<?= s(get_string('t_search_questions_ph','local_istikama_admin')) ?>"
                   class="isti-form-input" style="flex:1;min-width:180px;font-size:.88rem">
            <button type="submit" class="isti-btn isti-btn-primary"><i class="fa fa-search"></i> <?= get_string('pk_filter','local_istikama_admin') ?></button>
            <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'library', 'libtab' => 'questions']))->out(false) ?>" class="isti-btn isti-btn-outline">Clear</a>
        </form>
        <?php if ($gateway_cmid && $qbcourse):
            // Build create question link using the first level/subject available.
            $cq_levelid = $q_levelid ?: ($teacher_levelids[0] ?? 0);
            if ($cq_levelid) {
                $cq_url = (new moodle_url('/local/istikama_admin/create_question.php', [
                    'levelid'   => $cq_levelid,
                    'subjectid' => $q_subjectid ?: (array_key_first($subject_opts) ?: 0),
                    'sesskey'   => sesskey(),
                ]))->out(false);
        ?>
        <a href="<?= $cq_url ?>" class="isti-btn isti-btn-primary" style="background:#10b981;border-color:#10b981;white-space:nowrap">
            <i class="fa fa-plus"></i> Create Question
        </a>
        <?php } endif; ?>
    </div>

    <?php if (empty($questions)): ?>
    <div class="isti-card" style="text-align:center;padding:64px 20px;color:#94a3b8">
        <i class="fa fa-database" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
        <p style="font-size:1rem;color:#475569;font-weight:500"><?= get_string('no_questions_found', 'local_istikama_admin') ?></p>
        <p style="font-size:.88rem;color:#94a3b8"><?= get_string('t_try_adjust_filters','local_istikama_admin') ?></p>
    </div>
    <?php else: ?>
    <div class="isti-card" style="padding:0;overflow:hidden">
        <div class="table-responsive">
            <table class="isti-table" id="teacherQTable">
                <thead><tr>
                    <th style="width:44px"></th>
                    <th><?= get_string('col_question', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_type', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_level', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_subject', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_creator', 'local_istikama_admin') ?></th>
                    <th style="text-align:right"><?= get_string('col_modified', 'local_istikama_admin') ?></th>
                    <th style="text-align:center;width:100px"><?= get_string('col_actions', 'local_istikama_admin') ?></th>
                </tr></thead>
                <tbody>
                    <?php foreach ($questions as $q):
                        $qtype = $q->qtype ?: 'unknown';
                        $ico  = $qtype_icons[$qtype]  ?? 'fa-question';
                        $clr  = $qtype_colors[$qtype] ?? '#64748b';
                        $creator = trim((string)$q->creatorfirst . ' ' . (string)$q->creatorlast) ?: '—';
                    ?>
                    <tr>
                        <td><span class="isti-qtype-pill" style="background:<?= $clr ?>15;color:<?= $clr ?>"><i class="fa <?= $ico ?>"></i></span></td>
                        <td><strong><?= format_string($q->qname) ?></strong></td>
                        <td><span class="isti-badge" style="background:<?= $clr ?>15;color:<?= $clr ?>"><?= s(ucfirst($qtype)) ?></span></td>
                        <td><?= s($q->levelname ?: '—') ?></td>
                        <td><?php if ($q->subjectname): ?><span class="isti-badge isti-badge-primary"><?= s($q->subjectname) ?></span><?php else: ?>—<?php endif; ?></td>
                        <td style="font-size:.85rem;color:#475569"><?= s($creator) ?></td>
                        <td style="text-align:right;font-size:.82rem;color:#64748b"><?= userdate($q->timemodified, get_string('strftimedatetimeshort', 'langconfig')) ?></td>
                        <td style="text-align:center;white-space:nowrap">
                            <a href="<?= (new moodle_url('/local/istikama_admin/preview_question.php', ['id' => (int)$q->qid]))->out(false) ?>" class="isti-icon-btn" title="Preview"><i class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div style="font-size:.82rem;color:#94a3b8;margin-top:8px;text-align:right"><?= count($questions) ?> questions shown</div>
    <?php endif; ?>

    <?php
    // ── QUIZZES ───────────────────────────────────────────────────────────────
    elseif ($libtab === 'quizzes'):
        $qz_search  = optional_param('qzq', '', PARAM_TEXT);
        $qz_levelid = optional_param('levelid', $teacher_levelids[0] ?? 0, PARAM_INT);

        // Build WHERE for quizzes filtered by teacher's level.
        $qz_where   = ["qz.name <> 'Question Bank Gateway'"];
        $qz_params  = [];
        if (!empty($teacher_levelids)) {
            if ($qz_levelid && in_array($qz_levelid, $teacher_levelids)) {
                $qz_where[] = "iqm.levelid = :lvid";
                $qz_params['lvid'] = $qz_levelid;
            } else {
                list($insql, $inparams) = $DB->get_in_or_equal($teacher_levelids, SQL_PARAMS_NAMED, 'qlvl');
                $qz_where[] = "iqm.levelid $insql";
                $qz_params  = array_merge($qz_params, $inparams);
            }
        }
        if ($qz_search) {
            $qz_where[] = $DB->sql_like('qz.name', ':qzs', false);
            $qz_params['qzs'] = '%' . $DB->sql_like_escape($qz_search) . '%';
        }
        $qz_wheresql = 'WHERE ' . implode(' AND ', $qz_where);

        $quizzes = $DB->get_records_sql("
            SELECT qz.id, qz.name, qz.timecreated, qz.grade,
                   c.fullname AS coursename, c.id AS courseid,
                   cm.id AS cmid,
                   iqm.reusable, iqm.levelid, iqm.subjectid,
                   lvl.name AS levelname, subj.name AS subjectname
              FROM {quiz} qz
              JOIN {course} c ON c.id = qz.course
              LEFT JOIN {course_modules} cm ON cm.instance = qz.id AND cm.course = qz.course
              LEFT JOIN {modules} m ON m.id = cm.module AND m.name = 'quiz'
              LEFT JOIN {istikama_quiz_meta} iqm ON iqm.quizid = qz.id
              LEFT JOIN {course_categories} lvl ON lvl.id = iqm.levelid
              LEFT JOIN {istikama_subject_names} subj ON subj.id = iqm.subjectid
                $qz_wheresql
              ORDER BY qz.timecreated DESC
        ", $qz_params, 0, 200);

        $qz_slotcounts = [];
        try {
            $sc = $DB->get_records_sql("SELECT quizid, COUNT(*) AS cnt FROM {quiz_slots} GROUP BY quizid");
            foreach ($sc as $r) { $qz_slotcounts[(int)$r->quizid] = (int)$r->cnt; }
        } catch (\Exception $e) {}
    ?>
    <!-- Filter -->
    <div class="isti-card" style="padding:12px 18px;margin-bottom:16px;display:flex;gap:10px;align-items:center;flex-wrap:wrap">
        <form method="get" style="display:contents">
            <input type="hidden" name="section" value="library">
            <input type="hidden" name="libtab" value="quizzes">
            <?php if (!empty($level_opts ?? [])): foreach ($level_opts as $lid => $lname): ?>
            <option style="display:none" value="<?= $lid ?>"></option>
            <?php endforeach; endif; ?>
            <select name="levelid" class="isti-form-select" style="max-width:180px;font-size:.88rem">
                <option value="0"><?= get_string('t_all_my_levels','local_istikama_admin') ?></option>
                <?php foreach ($teacher_levelids as $lid):
                    $lname = $DB->get_field('course_categories', 'name', ['id' => $lid]) ?: $lid; ?>
                <option value="<?= $lid ?>" <?= (int)$qz_levelid === $lid ? 'selected' : '' ?>><?= s($lname) ?></option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="qzq" value="<?= s($qz_search) ?>" placeholder="<?= s(get_string('t_search_quizzes_ph','local_istikama_admin')) ?>"
                   class="isti-form-input" style="flex:1;min-width:180px;font-size:.88rem">
            <button type="submit" class="isti-btn isti-btn-primary"><i class="fa fa-search"></i> <?= get_string('pk_filter','local_istikama_admin') ?></button>
        </form>
    </div>

    <?php if (empty($quizzes)): ?>
    <div class="isti-card" style="text-align:center;padding:64px 20px;color:#94a3b8">
        <i class="fa fa-question-circle" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
        <p style="font-size:1rem;color:#475569;font-weight:500"><?= get_string('no_quizzes_found', 'local_istikama_admin') ?></p>
    </div>
    <?php else: ?>
    <div class="isti-card" style="padding:0;overflow:hidden">
        <div class="table-responsive">
            <table class="isti-table">
                <thead><tr>
                    <th><?= get_string('col_quiz_name', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_level', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_subject', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_course', 'local_istikama_admin') ?></th>
                    <th style="text-align:center"><?= get_string('col_questions_count', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_created', 'local_istikama_admin') ?></th>
                    <th style="text-align:center;width:120px"><?= get_string('col_actions', 'local_istikama_admin') ?></th>
                </tr></thead>
                <tbody>
                    <?php foreach ($quizzes as $qz):
                        $qcount = $qz_slotcounts[(int)$qz->id] ?? 0;
                        $viewurl = !empty($qz->cmid) ? (new moodle_url('/local/istikama_admin/view_quiz.php', ['id' => $qz->cmid]))->out(false) : '#';
                        $is_reusable = !empty($qz->reusable);
                    ?>
                    <tr>
                        <td>
                            <strong><?= format_string($qz->name) ?></strong>
                            <?php if ($is_reusable): ?>
                            <span class="isti-badge isti-badge-primary" style="font-size:.7rem;margin-left:6px"><i class="fa fa-star"></i> <?= get_string('t_reusable','local_istikama_admin') ?></span>
                            <?php endif; ?>
                        </td>
                        <td><?= s($qz->levelname ?: '—') ?></td>
                        <td><?php if ($qz->subjectname): ?><span class="isti-badge isti-badge-primary"><?= s($qz->subjectname) ?></span><?php else: ?>—<?php endif; ?></td>
                        <td><span class="isti-badge isti-badge-neutral"><?= format_string($qz->coursename) ?></span></td>
                        <td style="text-align:center"><span class="isti-badge isti-badge-neutral"><?= $qcount ?></span></td>
                        <td style="font-size:.82rem;color:#64748b"><?= userdate($qz->timecreated, get_string('strftimedatetimeshort', 'langconfig')) ?></td>
                        <td style="text-align:center;white-space:nowrap">
                            <a href="<?= $viewurl ?>" class="isti-icon-btn" title="View Quiz"><i class="fa fa-eye"></i></a>
                            <?php if (!empty($qz->cmid) && has_capability('mod/quiz:manage', context_module::instance($qz->cmid))): ?>
                            <a href="<?= (new moodle_url('/local/istikama_admin/pick_questions.php', ['cmid' => $qz->cmid]))->out(false) ?>" class="isti-icon-btn" title="Add Questions"><i class="fa fa-folder-open"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

    <?php
    // ── MY UPLOADS ────────────────────────────────────────────────────────────
    elseif ($libtab === 'myfiles'):
        $status_filter = optional_param('fstatus', '', PARAM_ALPHA);
        $show_form     = optional_param('showupload', 0, PARAM_INT);
        $where_f  = ['uploaded_by' => $USER->id];
        if ($status_filter) { $where_f['status'] = $status_filter; }
        $myfiles = $DB->get_records('istikama_content_bank', $where_f, 'timecreated DESC');
    ?>
    <!-- Upload toggle + status pills -->
    <div class="isti-card" style="padding:14px 18px;margin-bottom:16px;display:flex;align-items:center;gap:10px;flex-wrap:wrap">
        <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'library', 'libtab' => 'myfiles', 'showupload' => $show_form ? 0 : 1]))->out(false) ?>" class="isti-btn <?= $show_form ? 'isti-btn-outline' : 'isti-btn-primary' ?>" style="white-space:nowrap">
            <i class="fa fa-<?= $show_form ? 'times' : 'upload' ?>"></i> <?= $show_form ? get_string('close_form', 'local_istikama_admin') : get_string('library_upload_new', 'local_istikama_admin') ?>
        </a>
        <div style="flex:1"></div>
        <?php foreach (['' => get_string('filter_all', 'local_istikama_admin'), 'approved' => get_string('approved', 'local_istikama_admin'), 'pending' => get_string('pending', 'local_istikama_admin'), 'rejected' => get_string('rejected', 'local_istikama_admin')] as $k => $v): ?>
        <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'library', 'libtab' => 'myfiles', 'fstatus' => $k]))->out(false) ?>"
           class="isti-badge <?= $status_filter === $k ? 'isti-badge-primary' : 'isti-badge-neutral' ?>" style="cursor:pointer;font-size:.8rem;padding:4px 10px"><?= $v ?></a>
        <?php endforeach; ?>
    </div>

    <?php if ($show_form):
        // Content-type catalogue — drives both the picker grid and the
        // type-specific field rules (file vs. URL, accepted MIME, etc.).
        $p = 'local_istikama_admin';
        $upload_types = [
            'pdf'          => ['icon' => 'fa-file-pdf',          'color' => '#ef4444', 'bg' => '#fef2f2',  'title' => get_string('ctype_pdf_title', $p),          'desc' => get_string('ctype_pdf_desc', $p),          'input' => 'file', 'accept' => '.pdf'],
            'youtube'      => ['icon' => 'fa-youtube',           'color' => '#dc2626', 'bg' => '#fef2f2',  'title' => get_string('ctype_youtube_title', $p),      'desc' => get_string('ctype_youtube_desc', $p),      'input' => 'url',  'placeholder' => 'https://youtube.com/watch?v=…'],
            'video'        => ['icon' => 'fa-video',             'color' => '#8b5cf6', 'bg' => '#faf5ff',  'title' => get_string('ctype_video_title', $p),        'desc' => get_string('ctype_video_desc', $p),        'input' => 'file', 'accept' => 'video/*'],
            'audio'        => ['icon' => 'fa-headphones',        'color' => '#ec4899', 'bg' => '#fdf2f8',  'title' => get_string('ctype_audio_title', $p),        'desc' => get_string('ctype_audio_desc', $p),        'input' => 'file', 'accept' => 'audio/*'],
            'image'        => ['icon' => 'fa-image',             'color' => '#06b6d4', 'bg' => '#ecfeff',  'title' => get_string('ctype_image_title', $p),        'desc' => get_string('ctype_image_desc', $p),        'input' => 'file', 'accept' => 'image/*'],
            'document'     => ['icon' => 'fa-file-word',         'color' => '#3b82f6', 'bg' => '#eff6ff',  'title' => get_string('ctype_document_title', $p),     'desc' => get_string('ctype_document_desc', $p),     'input' => 'file', 'accept' => '.doc,.docx,.xls,.xlsx,.ppt,.pptx,.odt,.ods,.odp,.txt,.rtf'],
            'presentation' => ['icon' => 'fa-file-powerpoint',   'color' => '#f59e0b', 'bg' => '#fffbeb',  'title' => get_string('ctype_presentation_title', $p), 'desc' => get_string('ctype_presentation_desc', $p), 'input' => 'file', 'accept' => '.ppt,.pptx,.odp,.key'],
            'book'         => ['icon' => 'fa-book',              'color' => '#10b981', 'bg' => '#f0fdf4',  'title' => get_string('ctype_book_title', $p),         'desc' => get_string('ctype_book_desc', $p),         'input' => 'file', 'accept' => '.epub,.pdf'],
            'link'         => ['icon' => 'fa-link',              'color' => '#64748b', 'bg' => '#f8fafc',  'title' => get_string('ctype_link_title', $p),         'desc' => get_string('ctype_link_desc', $p),         'input' => 'url',  'placeholder' => 'https://…'],
        ];
    ?>
    <style>
      /* Centered upload wizard ------------------------------------------ */
      .isti-upload-shell { max-width:980px; margin:0 auto 18px; background:#fff; border:1px solid #e2e8f0; border-radius:16px; padding:28px 28px 22px; box-shadow:0 1px 3px rgba(0,0,0,.03) }
      .isti-upload-title { font-weight:700; color:#1e293b; margin:0 0 4px; font-size:1.1rem; text-align:center }
      .isti-upload-sub   { color:#64748b; font-size:.85rem; text-align:center; margin-bottom:24px }
      .isti-uploadtype-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:14px; max-width:880px; margin:0 auto }
      @media (max-width:760px) { .isti-uploadtype-grid { grid-template-columns:1fr 1fr } }
      @media (max-width:460px) { .isti-uploadtype-grid { grid-template-columns:1fr } }
      .isti-uploadtype-card { display:flex; flex-direction:column; align-items:flex-start; padding:18px 16px; border:2px solid #e2e8f0; border-radius:14px; background:#fff; cursor:pointer; transition:all .15s; text-align:left }
      .isti-uploadtype-card:hover { border-color:var(--accent, #006bff); transform:translateY(-2px); box-shadow:0 4px 16px rgba(0,0,0,.06) }
      .isti-uploadtype-card.selected { border-color:var(--accent, #006bff); background:rgba(0,107,255,.04); box-shadow:0 4px 14px rgba(0,107,255,.10) }
      .isti-uploadtype-icon { display:inline-flex; align-items:center; justify-content:center; width:42px; height:42px; border-radius:11px; font-size:1.1rem; margin-bottom:10px }
      .isti-uploadtype-title { font-weight:700; color:#1e293b; font-size:.92rem; margin-bottom:4px }
      .isti-uploadtype-desc  { font-size:.77rem; color:#64748b; line-height:1.45 }
      .isti-upload-step2 { display:none; margin-top:24px; padding-top:22px; border-top:1px solid #e2e8f0 }
      .isti-upload-step2.show { display:block }
    </style>

    <div class="isti-upload-shell">
      <h5 class="isti-upload-title"><i class="fa fa-upload" style="color:#006bff;margin-right:6px"></i> <?= get_string('upload_new_content', 'local_istikama_admin') ?></h5>
      <p class="isti-upload-sub"><?= get_string('upload_pick_type', 'local_istikama_admin') ?></p>

      <!-- Step 1: type picker -->
      <div class="isti-uploadtype-grid" id="istiUploadGrid">
        <?php foreach ($upload_types as $key => $t): ?>
        <button type="button" class="isti-uploadtype-card"
                data-type="<?= $key ?>"
                data-input="<?= $t['input'] ?>"
                data-accept="<?= s($t['accept'] ?? '') ?>"
                data-placeholder="<?= s($t['placeholder'] ?? '') ?>"
                data-title="<?= s($t['title']) ?>"
                style="--accent:<?= $t['color'] ?>">
          <span class="isti-uploadtype-icon" style="background:<?= $t['bg'] ?>;color:<?= $t['color'] ?>">
            <i class="fa <?= $t['icon'] ?>"></i>
          </span>
          <div class="isti-uploadtype-title"><?= s($t['title']) ?></div>
          <div class="isti-uploadtype-desc"><?= s($t['desc']) ?></div>
        </button>
        <?php endforeach; ?>
      </div>

      <!-- Step 2: details form (hidden until a type is picked) -->
      <form method="post" action="<?= $baseurl->out(false) ?>" enctype="multipart/form-data"
            class="isti-upload-step2" id="istiUploadStep2">
        <input type="hidden" name="sesskey"      value="<?= sesskey() ?>">
        <input type="hidden" name="action"       value="uploadcontent">
        <input type="hidden" name="content_type" id="istiUploadType" value="">

        <div style="text-align:center;margin-bottom:18px">
          <div id="istiUploadChip" style="display:inline-flex;align-items:center;gap:8px;padding:6px 14px;background:#eff6ff;color:#006bff;border-radius:999px;font-size:.82rem;font-weight:600">
            <i class="fa fa-check"></i> <span id="istiUploadChipLabel">—</span>
            <button type="button" id="istiUploadReset" style="background:none;border:none;color:#006bff;cursor:pointer;padding:0;margin-left:4px;font-size:.8rem;text-decoration:underline"><?= get_string('upload_change_type', 'local_istikama_admin') ?></button>
          </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;max-width:760px;margin-left:auto;margin-right:auto">
          <div class="isti-form-group">
            <label class="isti-form-label"><?= get_string('upload_label_title', 'local_istikama_admin') ?> *</label>
            <input type="text" class="isti-form-input" name="content_name" required>
          </div>
          <div class="isti-form-group">
            <label class="isti-form-label"><?= get_string('upload_label_subject', 'local_istikama_admin') ?></label>
            <input type="text" class="isti-form-input" name="subject" placeholder="<?= s(get_string('upload_subject_ph', 'local_istikama_admin')) ?>">
          </div>
        </div>

        <!-- File field (for file-input types) -->
        <div class="isti-form-group" id="istiUploadFileWrap" style="display:none;margin-bottom:14px;max-width:760px;margin-left:auto;margin-right:auto">
          <label class="isti-form-label" id="istiUploadFileLabel"><?= get_string('upload_label_file', 'local_istikama_admin') ?></label>
          <input type="hidden" name="content_file" value="<?= file_get_unused_draft_itemid() ?>">
          <input type="file" class="isti-form-input" name="content_file_upload" id="istiUploadFileInput">
        </div>

        <!-- URL field (for URL-input types) -->
        <div class="isti-form-group" id="istiUploadUrlWrap" style="display:none;margin-bottom:14px;max-width:760px;margin-left:auto;margin-right:auto">
          <label class="isti-form-label" id="istiUploadUrlLabel"><?= get_string('upload_label_url', 'local_istikama_admin') ?> *</label>
          <input type="url" class="isti-form-input" name="external_url" id="istiUploadUrlInput" placeholder="https://…">
          <div id="istiUploadUrlHint" style="font-size:.75rem;color:#94a3b8;margin-top:6px;display:none">
            <i class="fa fa-info-circle"></i> <?= get_string('upload_youtube_hint', 'local_istikama_admin') ?>
          </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:18px;max-width:760px;margin-left:auto;margin-right:auto">
          <div class="isti-form-group">
            <label class="isti-form-label"><?= get_string('upload_label_description', 'local_istikama_admin') ?></label>
            <textarea class="isti-form-input" name="description" rows="2" style="resize:vertical"></textarea>
          </div>
          <div class="isti-form-group">
            <label class="isti-form-label"><?= get_string('upload_label_keywords', 'local_istikama_admin') ?></label>
            <input type="text" class="isti-form-input" name="keywords" placeholder="<?= s(get_string('upload_keywords_ph', 'local_istikama_admin')) ?>">
          </div>
        </div>

        <div style="text-align:center">
          <button type="submit" class="isti-btn isti-btn-primary" style="min-width:200px;justify-content:center">
            <i class="fa fa-upload"></i> <?= get_string('upload_submit_review', 'local_istikama_admin') ?>
          </button>
        </div>
      </form>
    </div>

    <script>
    var _istiUploadStr = {
        urlLabel:     <?= json_encode(get_string('upload_label_url', 'local_istikama_admin') . ' *') ?>,
        ytUrlLabel:   <?= json_encode(get_string('upload_label_youtube_url', 'local_istikama_admin') . ' *') ?>
    };
    (function() {
      var grid     = document.getElementById('istiUploadGrid');
      var step2    = document.getElementById('istiUploadStep2');
      var typeIn   = document.getElementById('istiUploadType');
      var chipLbl  = document.getElementById('istiUploadChipLabel');
      var fileWrap = document.getElementById('istiUploadFileWrap');
      var urlWrap  = document.getElementById('istiUploadUrlWrap');
      var fileInp  = document.getElementById('istiUploadFileInput');
      var urlInp   = document.getElementById('istiUploadUrlInput');
      var urlHint  = document.getElementById('istiUploadUrlHint');
      var urlLabel = document.getElementById('istiUploadUrlLabel');
      var resetBtn = document.getElementById('istiUploadReset');

      function selectType(card) {
        var type        = card.dataset.type;
        var inputKind   = card.dataset.input;
        var accept      = card.dataset.accept;
        var placeholder = card.dataset.placeholder;
        var title       = card.dataset.title;

        // Visual selection.
        grid.querySelectorAll('.isti-uploadtype-card').forEach(function(c) { c.classList.remove('selected'); });
        card.classList.add('selected');

        typeIn.value = type;
        chipLbl.textContent = title;

        if (inputKind === 'file') {
          fileWrap.style.display = '';
          urlWrap.style.display  = 'none';
          fileInp.required = true;
          fileInp.accept = accept || '';
          urlInp.required = false;
        } else {
          urlWrap.style.display  = '';
          fileWrap.style.display = 'none';
          urlInp.required = true;
          urlInp.placeholder = placeholder || 'https://…';
          fileInp.required = false;
          urlLabel.textContent = (type === 'youtube' ? _istiUploadStr.ytUrlLabel : _istiUploadStr.urlLabel);
          urlHint.style.display = (type === 'youtube' ? '' : 'none');
        }

        step2.classList.add('show');
        // Smooth scroll to step 2.
        setTimeout(function() { step2.scrollIntoView({behavior:'smooth', block:'center'}); }, 80);
      }

      grid.querySelectorAll('.isti-uploadtype-card').forEach(function(card) {
        card.addEventListener('click', function() { selectType(card); });
      });

      resetBtn.addEventListener('click', function() {
        step2.classList.remove('show');
        typeIn.value = '';
        grid.querySelectorAll('.isti-uploadtype-card').forEach(function(c) { c.classList.remove('selected'); });
        grid.scrollIntoView({behavior:'smooth', block:'center'});
      });
    })();
    </script>
    <?php endif; ?>

    <?php if (empty($myfiles)): ?>
    <div class="isti-card" style="text-align:center;padding:64px 20px;color:#94a3b8">
        <i class="fa fa-folder-open" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
        <p style="color:#475569"><?= get_string('library_no_files', 'local_istikama_admin') ?></p>
    </div>
    <?php else: ?>
    <div class="isti-card" style="padding:0;overflow:hidden">
        <div class="table-responsive">
            <table class="isti-table">
                <thead><tr>
                    <th style="width:44px"></th>
                    <th><?= get_string('col_name', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_type', 'local_istikama_admin') ?></th>
                    <th><?= get_string('col_status', 'local_istikama_admin') ?></th>
                    <th style="text-align:right"><?= get_string('col_uploaded', 'local_istikama_admin') ?></th>
                </tr></thead>
                <tbody>
                    <?php foreach ($myfiles as $f):
                        $ico = isti_teacher_type_icon($f->content_type);
                        $clr = isti_teacher_type_color($f->content_type);
                    ?>
                    <tr>
                        <td><span class="isti-qtype-pill" style="background:<?= $clr ?>15;color:<?= $clr ?>"><i class="fa <?= $ico ?>"></i></span></td>
                        <td><strong><?= format_string($f->name) ?></strong></td>
                        <td><span class="isti-badge" style="background:<?= $clr ?>15;color:<?= $clr ?>"><?= ucfirst($f->content_type) ?></span></td>
                        <td><?= isti_status_badge($f->status ?? 'pending') ?></td>
                        <td style="text-align:right;font-size:.82rem;color:#64748b"><?= userdate($f->timecreated, get_string('strftimedatetimeshort', 'langconfig')) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>
    <?php endif; // libtab ?>
    </div>
    <?php
} // end library

// ─────────────────────────────────────────────────────────────────────────────
// ══ CLASSES LIST ══
// ─────────────────────────────────────────────────────────────────────────────
if ($section === 'classes') {
    // Group assignments by level name.
    $byLevel = [];
    foreach ($assignments as $a) {
        $lname = $a->levelname ?? 'Other';
        $byLevel[$lname][] = $a;
    }
    ?>
    <div class="container-fluid" dir="<?= $dir ?>" style="background:#f1f5f9;min-height:600px;margin:-24px;padding:24px;">
        <?php if (empty($assignments)): ?>
        <div class="isti-card" style="text-align:center;padding:64px 20px;color:#94a3b8">
            <i class="fa fa-chalkboard" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
            <p style="color:#475569;font-size:1rem;font-weight:500"><?= get_string('classes_no_assignments', 'local_istikama_admin') ?></p>
        </div>
        <?php else: ?>
        <?php foreach ($byLevel as $level => $items): ?>
        <div style="margin-bottom:28px">
            <h6 style="font-size:.78rem;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.06em;margin-bottom:14px">
                <i class="fa fa-layer-group" style="color:#006bff;margin-right:6px"></i><?= s($level) ?>
            </h6>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px">
                <?php foreach ($items as $a):
                    [$swhere2, $sparams2] = local_istikama_admin_season_where_sql($viewseasonid);
                $scount = $a->classid ? (int)$DB->count_records_sql("SELECT COUNT(1) FROM {istikama_user_school} WHERE classid = :cid AND role = 'student' $swhere2", array_merge(['cid' => $a->classid], $sparams2)) : 0;
                    $url = $a->classid ? (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classview', 'classid' => $a->classid]))->out(false) : '#';
                ?>
                <a href="<?= $url ?>" style="text-decoration:none">
                    <div class="isti-card" style="padding:20px 22px;border:1.5px solid #e2e8f0;transition:border-color .15s,box-shadow .15s;cursor:pointer"
                         onmouseover="this.style.borderColor='#006bff';this.style.boxShadow='0 4px 12px rgba(0,107,255,.1)'"
                         onmouseout="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                        <div style="display:flex;align-items:flex-start;gap:14px;margin-bottom:14px">
                            <span style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:14px;background:#eff6ff;color:#006bff;font-size:1.3rem;flex-shrink:0">
                                <i class="fa fa-chalkboard-teacher"></i>
                            </span>
                            <div style="min-width:0">
                                <div style="font-weight:700;font-size:1rem;color:#1e293b;margin-bottom:3px"><?= s($a->classname ?: '—') ?></div>
                                <div style="font-size:.82rem;color:#64748b"><?= s($a->schoolname ?? '') ?></div>
                            </div>
                        </div>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:14px">
                            <span class="isti-badge isti-badge-primary"><i class="fa fa-users"></i> <?= $scount ?> <?= get_string('students_count', 'local_istikama_admin') ?></span>
                            <span class="isti-badge isti-badge-neutral"><i class="fa fa-layer-group"></i> <?= s($a->levelname ?? '—') ?></span>
                            <?php if (!empty($a->subjects)): ?>
                            <span class="isti-badge isti-badge-neutral"><i class="fa fa-book"></i> <?= count($a->subjects) ?> <?= get_string('subjects_count', 'local_istikama_admin') ?></span>
                            <?php endif; ?>
                        </div>
                        <div style="font-size:.82rem;font-weight:600;color:#006bff"><i class="fa fa-arrow-right"></i> <?= get_string('view_class_action', 'local_istikama_admin') ?></div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <?php
}

// ─────────────────────────────────────────────────────────────────────────────
// ══ CLASS VIEW ══
// ─────────────────────────────────────────────────────────────────────────────
if ($section === 'classview' && $classid) {
    $classname = '';
    try { $classcat = core_course_category::get($classid); $classname = format_string($classcat->name); } catch (\Exception $e) {}
    $teacher_subjects = local_istikama_admin_get_teacher_class_subjects($classid);
    $students = local_istikama_admin_get_class_students($classid);

    // ── Subject selection grid ──
    if (empty($subjectid)) {
        $courses = [];
        try {
            $classcat2 = core_course_category::get($classid);
            foreach ($classcat2->get_courses() as $c) {
                if (in_array((string)$c->id, $teacher_subjects)) { $courses[] = $c; }
            }
        } catch (\Exception $e) {}
        ?>
        <div class="container-fluid" dir="<?= $dir ?>" style="background:#f1f5f9;min-height:600px;margin:-24px;padding:24px;">
            <div style="display:flex;align-items:center;gap:14px;margin-bottom:22px">
                <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classes']))->out(false) ?>" class="isti-btn isti-btn-outline">
                    <i class="fa fa-arrow-left"></i> <?= get_string('go_back', 'local_istikama_admin') ?>
                </a>
                <span style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.2rem">
                    <i class="fa fa-chalkboard-teacher"></i>
                </span>
                <div>
                    <h5 style="margin:0 0 2px 0;font-weight:700;color:#1e293b"><?= s($classname) ?></h5>
                    <span style="font-size:.82rem;color:#64748b"><?= get_string('teacher_select_subject', 'local_istikama_admin') ?></span>
                </div>
            </div>

            <?php if (empty($courses)): ?>
            <div class="isti-card" style="text-align:center;padding:64px 20px;color:#94a3b8">
                <i class="fa fa-book" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
                <p style="color:#475569"><?= get_string('t_no_assigned_subjects','local_istikama_admin') ?></p>
            </div>
            <?php else: ?>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px">
                <?php foreach ($courses as $course):
                    $url = (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classview', 'classid' => $classid, 'subjectid' => $course->id]))->out(false);
                    // Count students and recent assessments for this subject.
                    $stucount = count($students);
                    $assesscount = 0;
                    try {
                        [$swhere_a, $sparams_a] = local_istikama_admin_season_where_sql($viewseasonid);
                        $assesscount = (int)$DB->count_records_sql(
                            "SELECT COUNT(1) FROM {istikama_assessments} WHERE classid=:cid AND subject=:sub $swhere_a",
                            array_merge(['cid' => $classid, 'sub' => (string)$course->id], $sparams_a));
                    } catch (\Exception $e) {}
                ?>
                <a href="<?= $url ?>" style="text-decoration:none">
                    <div class="isti-card" style="padding:22px;border:1.5px solid #e2e8f0;transition:border-color .15s,box-shadow .15s"
                         onmouseover="this.style.borderColor='#006bff';this.style.boxShadow='0 4px 12px rgba(0,107,255,.1)'"
                         onmouseout="this.style.borderColor='#e2e8f0';this.style.boxShadow='none'">
                        <span style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.2rem;margin-bottom:12px">
                            <i class="fa fa-book-open"></i>
                        </span>
                        <div style="font-weight:700;font-size:1rem;color:#1e293b;margin-bottom:8px"><?= format_string($course->fullname) ?></div>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:12px">
                            <span class="isti-badge isti-badge-neutral"><i class="fa fa-users"></i> <?= $stucount ?> <?= get_string('students_count', 'local_istikama_admin') ?></span>
                            <?php if ($assesscount): ?>
                            <span class="isti-badge isti-badge-primary"><i class="fa fa-clipboard-check"></i> <?= $assesscount ?> <?= get_string('class_assessments', 'local_istikama_admin') ?></span>
                            <?php endif; ?>
                        </div>
                        <div style="font-size:.82rem;font-weight:600;color:#006bff"><i class="fa fa-arrow-right"></i> <?= get_string('manage_subject', 'local_istikama_admin') ?></div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php
    } else {
        // ── Subject view with tabs ──
        $subject_name = '';
        if (is_numeric($subjectid)) {
            try { $subjcourse = get_course((int)$subjectid); $subject_name = format_string($subjcourse->fullname); } catch (\Exception $e) { $subject_name = $subjectid; }
        } else {
            $subject_name = $subjectid;
        }

        $classtabs = [
            'students'    => ['fa-users',          get_string('class_students',    'local_istikama_admin')],
            'reports'     => ['fa-chart-bar',       get_string('class_reports',     'local_istikama_admin')],
            'lessons'     => ['fa-book-reader',     get_string('class_lessons',     'local_istikama_admin')],
            'assessments' => ['fa-clipboard-check', get_string('class_assessments', 'local_istikama_admin')],
            'attendance'  => ['fa-calendar-check',  get_string('class_attendance',  'local_istikama_admin')],
            'interaction' => ['fa-exchange-alt',    get_string('class_activity_interaction', 'local_istikama_admin')],
        ];
        ?>
        <div class="container-fluid" dir="<?= $dir ?>" style="background:#f1f5f9;min-height:600px;margin:-24px;padding:24px;">
            <!-- Header -->
            <div class="isti-card" style="padding:18px 22px;margin-bottom:18px;display:flex;align-items:center;gap:14px;flex-wrap:wrap">
                <a href="<?= (new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classview', 'classid' => $classid]))->out(false) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
                    <i class="fa fa-arrow-left"></i> <?= get_string('go_back', 'local_istikama_admin') ?>
                </a>
                <span style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.2rem">
                    <i class="fa fa-book-open"></i>
                </span>
                <div style="flex:1;min-width:200px">
                    <div style="font-weight:700;font-size:1rem;color:#1e293b"><?= s($classname) ?></div>
                    <div style="font-size:.85rem;color:#64748b;margin-top:2px"><?= s($subject_name) ?></div>
                </div>
                <span class="isti-badge isti-badge-neutral"><i class="fa fa-users"></i> <?= count($students) ?> <?= get_string('students_count', 'local_istikama_admin') ?></span>
            </div>

            <!-- Tabs -->
            <div class="isti-tabs isti-tabs-modern" style="margin-bottom:20px" role="tablist">
                <?php foreach ($classtabs as $k => [$ico, $lbl]):
                    $cvtaburl = new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classview', 'classid' => $classid, 'subjectid' => $subjectid, 'classtab' => $k]);
                    $cvactive = ($classtab === $k);
                ?>
                <a href="<?= $cvtaburl->out(true) ?>"
                   class="isti-tab <?= $cvactive ? 'active' : '' ?>"
                   role="tab"
                   aria-selected="<?= $cvactive ? 'true' : 'false' ?>">
                    <i class="fa <?= $ico ?>"></i><?= $lbl ?>
                </a>
                <?php endforeach; ?>
            </div>

        <?php
        // ── STUDENTS ──────────────────────────────────────────────────────────
        if ($classtab === 'students'): ?>
        <div class="isti-card" style="padding:14px 18px;margin-bottom:14px;display:flex;align-items:center;gap:12px;flex-wrap:wrap">
            <input type="text" id="studentSearch" class="isti-form-input" placeholder="<?= get_string('search_students_ph', 'local_istikama_admin') ?>" style="flex:1;min-width:200px;font-size:.88rem">
            <span class="isti-badge isti-badge-neutral"><i class="fa fa-users"></i> <span id="studentCount"><?= count($students) ?></span> <?= get_string('students_count', 'local_istikama_admin') ?></span>
        </div>

        <?php if (empty($students)): ?>
        <div class="isti-card" style="text-align:center;padding:64px 20px;color:#94a3b8">
            <i class="fa fa-users" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
            <p style="color:#475569"><?= get_string('student_no_students', 'local_istikama_admin') ?></p>
        </div>
        <?php else: ?>
        <div class="isti-card" style="padding:0;overflow:hidden">
            <div class="table-responsive">
                <table class="isti-table" id="studentsTable">
                    <thead><tr>
                        <th style="width:44px">#</th>
                        <th><?= get_string('student_name', 'local_istikama_admin') ?></th>
                        <th><?= get_string('student_email', 'local_istikama_admin') ?></th>
                        <th><?= get_string('student_last_access', 'local_istikama_admin') ?></th>
                    </tr></thead>
                    <tbody>
                        <?php $idx = 0; foreach ($students as $s): $idx++; ?>
                        <tr data-search="<?= s(strtolower(fullname($s) . ' ' . $s->email)) ?>">
                            <td style="color:#94a3b8;font-size:.85rem"><?= $idx ?></td>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px">
                                    <span style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:50%;background:#eff6ff;color:#006bff;font-weight:700;font-size:.88rem;flex-shrink:0">
                                        <?= mb_strtoupper(mb_substr($s->firstname, 0, 1)) ?>
                                    </span>
                                    <strong><?= fullname($s) ?></strong>
                                </div>
                            </td>
                            <td style="color:#475569"><?= s($s->email) ?></td>
                            <td style="color:#64748b;font-size:.85rem"><?= !empty($s->lastaccess) ? userdate($s->lastaccess, get_string('strftimedatetimeshort', 'langconfig')) : '<span style="color:#cbd5e1">—</span>' ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
        (function() {
            var inp = document.getElementById('studentSearch');
            var cnt = document.getElementById('studentCount');
            var tbl = document.getElementById('studentsTable');
            if (!inp || !tbl) { return; }
            inp.addEventListener('input', function() {
                var q = this.value.toLowerCase().trim();
                var visible = 0;
                tbl.querySelectorAll('tbody tr').forEach(function(row) {
                    var blob = row.getAttribute('data-search') || '';
                    var show = !q || blob.indexOf(q) !== -1;
                    row.style.display = show ? '' : 'none';
                    if (show) { visible++; }
                });
                if (cnt) { cnt.textContent = String(visible); }
            });
        })();
        </script>
        <?php endif; ?>

        <?php
        // ── REPORTS ───────────────────────────────────────────────────────────
        elseif ($classtab === 'reports'):
            // ── Per-student insights (attendance + assessments + status) ──
            [$swhere_r, $sparams_r] = local_istikama_admin_season_where_sql($viewseasonid);
            // Attendance is recorded per class/day (not per subject) — aggregate per student.
            $att_by = [];
            try {
                $rows_a = $DB->get_records_sql(
                    "SELECT studentid,
                            COUNT(1) AS total,
                            SUM(CASE WHEN status='present' THEN 1 ELSE 0 END) AS present,
                            SUM(CASE WHEN status='absent'  THEN 1 ELSE 0 END) AS absent,
                            SUM(CASE WHEN status='late'    THEN 1 ELSE 0 END) AS late
                       FROM {istikama_attendance}
                      WHERE classid=:cid $swhere_r
                   GROUP BY studentid",
                    array_merge(['cid' => $classid], $sparams_r));
                foreach ($rows_a as $r) { $att_by[(int)$r->studentid] = $r; }
            } catch (\Exception $e) {}
            // Assessment scores per student for the current subject.
            $ass_by = [];
            try {
                $rows_s = $DB->get_records_sql(
                    "SELECT studentid, AVG(score) AS avgscore, COUNT(1) AS cnt
                       FROM {istikama_assessments}
                      WHERE classid=:cid AND subject=:sub AND score IS NOT NULL $swhere_r
                   GROUP BY studentid",
                    array_merge(['cid' => $classid, 'sub' => $subjectid], $sparams_r));
                foreach ($rows_s as $r) { $ass_by[(int)$r->studentid] = $r; }
            } catch (\Exception $e) {}

            $tot_present = 0; $tot_att = 0; $score_sum = 0; $score_n = 0; $assess_total = 0; $atrisk = 0;
            $stud_rows = [];
            foreach ($students as $s) {
                $a = $att_by[(int)$s->id] ?? null; $as = $ass_by[(int)$s->id] ?? null;
                $atotal = $a ? (int)$a->total : 0; $apres = $a ? (int)$a->present : 0;
                $alate  = $a ? (int)$a->late  : 0; $aabs  = $a ? (int)$a->absent  : 0;
                $arate  = $atotal > 0 ? (int)round(($apres / $atotal) * 100) : null;
                $avg    = $as ? round((float)$as->avgscore, 1) : null; $acnt = $as ? (int)$as->cnt : 0;
                $tot_present += $apres; $tot_att += $atotal; $assess_total += $acnt;
                if ($avg !== null) { $score_sum += $avg; $score_n++; }
                $status = 'nodata';
                if ($atotal > 0 || $acnt > 0) {
                    $risk = (($arate !== null && $arate < 70) || ($avg !== null && $avg < 50));
                    $status = $risk ? 'atrisk' : 'ontrack';
                    if ($risk) { $atrisk++; }
                }
                $stud_rows[] = compact('s', 'atotal', 'apres', 'alate', 'aabs', 'arate', 'avg', 'acnt', 'status');
            }
            $class_rate = $tot_att > 0 ? (int)round(($tot_present / $tot_att) * 100) : 0;
            $class_avg  = $score_n > 0 ? round($score_sum / $score_n, 1) : 0;

            $s_ontrack = count(array_filter($stud_rows, fn($r) => $r['status'] === 'ontrack'));
            $s_atrisk  = count(array_filter($stud_rows, fn($r) => $r['status'] === 'atrisk'));
            $s_nodata  = count(array_filter($stud_rows, fn($r) => $r['status'] === 'nodata'));
            // Absent rate for overall class.
            $abs_total = array_sum(array_column($stud_rows, 'aabs'));
            $absent_rate = $tot_att > 0 ? (int)round(($abs_total / $tot_att) * 100) : 0;
        ?>
        <!-- ── HERO BANNER ── -->
        <div style="background:linear-gradient(135deg,#006bff 0%,#0052cc 100%);border-radius:18px;padding:24px 28px;margin-bottom:20px;display:flex;align-items:center;gap:18px;flex-wrap:wrap;box-shadow:0 8px 24px -8px rgba(0,107,255,.45)">
            <span style="width:54px;height:54px;border-radius:14px;background:rgba(255,255,255,.18);display:inline-flex;align-items:center;justify-content:center;font-size:1.5rem;color:#fff;flex-shrink:0"><i class="fa fa-chart-line"></i></span>
            <div style="flex:1;min-width:180px">
                <h4 style="margin:0;font-weight:800;color:#fff;font-size:1.15rem"><?= get_string('ins_title', 'local_istikama_admin') ?></h4>
                <p style="margin:3px 0 0;color:rgba(255,255,255,.75);font-size:.85rem;line-height:1.4"><?= s($subject_name) ?> &nbsp;·&nbsp; <?= format_string($DB->get_field('course_categories', 'name', ['id' => $classid]) ?: '') ?></p>
            </div>
            <div style="display:flex;gap:10px;flex-wrap:wrap">
                <div style="text-align:center;background:rgba(255,255,255,.15);border-radius:12px;padding:10px 18px;min-width:70px">
                    <div style="font-size:1.6rem;font-weight:800;color:#fff;line-height:1"><?= count($stud_rows) ?></div>
                    <div style="font-size:.72rem;color:rgba(255,255,255,.7);margin-top:3px;text-transform:uppercase;letter-spacing:.05em"><?= get_string('teacher_total_students', 'local_istikama_admin') ?></div>
                </div>
                <div style="text-align:center;background:rgba(255,255,255,.15);border-radius:12px;padding:10px 18px;min-width:70px">
                    <div style="font-size:1.6rem;font-weight:800;color:#fff;line-height:1"><?= $class_rate ?>%</div>
                    <div style="font-size:.72rem;color:rgba(255,255,255,.7);margin-top:3px;text-transform:uppercase;letter-spacing:.05em"><?= get_string('ins_kpi_attendance', 'local_istikama_admin') ?></div>
                </div>
                <?php if ($class_avg > 0): ?>
                <div style="text-align:center;background:rgba(255,255,255,.15);border-radius:12px;padding:10px 18px;min-width:70px">
                    <div style="font-size:1.6rem;font-weight:800;color:#fff;line-height:1"><?= $class_avg ?></div>
                    <div style="font-size:.72rem;color:rgba(255,255,255,.7);margin-top:3px;text-transform:uppercase;letter-spacing:.05em"><?= get_string('ins_kpi_avg', 'local_istikama_admin') ?></div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- ── KPI GRID (matches admin identity — full-width, 5 columns) ── -->
        <div class="isti-kpi-grid" style="grid-template-columns:repeat(5,1fr);margin-bottom:20px">
            <div class="isti-kpi-card">
                <div class="isti-kpi-content">
                    <span class="isti-kpi-label"><?= get_string('ins_kpi_attendance', 'local_istikama_admin') ?></span>
                    <span class="isti-kpi-value"><?= $class_rate ?>%</span>
                    <span class="isti-kpi-trend <?= $class_rate >= 80 ? 'up' : 'down' ?>">
                        <i class="fa <?= $class_rate >= 80 ? 'fa-arrow-up' : 'fa-arrow-down' ?>"></i>
                        <?= $class_rate >= 80 ? get_string('t_rate_good','local_istikama_admin') : ($class_rate >= 60 ? get_string('t_rate_low','local_istikama_admin') : get_string('t_rate_very_low','local_istikama_admin')) ?>
                    </span>
                </div>
                <div class="isti-kpi-icon <?= $class_rate >= 80 ? 'green' : 'red' ?>"><i class="fa fa-calendar-check"></i></div>
            </div>
            <div class="isti-kpi-card">
                <div class="isti-kpi-content">
                    <span class="isti-kpi-label"><?= get_string('ins_kpi_avg', 'local_istikama_admin') ?></span>
                    <span class="isti-kpi-value"><?= $class_avg > 0 ? $class_avg : '—' ?></span>
                    <?php if ($class_avg > 0): ?>
                    <span class="isti-kpi-trend <?= $class_avg >= 70 ? 'up' : 'down' ?>">
                        <i class="fa <?= $class_avg >= 70 ? 'fa-arrow-up' : 'fa-arrow-down' ?>"></i>
                        <?= $class_avg >= 70 ? get_string('t_rate_good','local_istikama_admin') : ($class_avg >= 50 ? get_string('t_rate_low','local_istikama_admin') : get_string('t_rate_very_low','local_istikama_admin')) ?>
                    </span>
                    <?php endif; ?>
                </div>
                <div class="isti-kpi-icon <?= $class_avg >= 70 ? 'green' : ($class_avg > 0 ? 'amber' : 'blue') ?>"><i class="fa fa-star"></i></div>
            </div>
            <div class="isti-kpi-card">
                <div class="isti-kpi-content">
                    <span class="isti-kpi-label"><?= get_string('ins_kpi_assess', 'local_istikama_admin') ?></span>
                    <span class="isti-kpi-value"><?= $assess_total ?></span>
                </div>
                <div class="isti-kpi-icon purple"><i class="fa fa-clipboard-check"></i></div>
            </div>
            <div class="isti-kpi-card">
                <div class="isti-kpi-content">
                    <span class="isti-kpi-label"><?= get_string('ins_kpi_atrisk', 'local_istikama_admin') ?></span>
                    <span class="isti-kpi-value" style="color:<?= $atrisk > 0 ? '#ef4444' : '#10b981' ?>"><?= $atrisk ?></span>
                    <?php if (count($students) > 0): ?>
                    <span class="isti-kpi-trend <?= $atrisk === 0 ? 'up' : 'down' ?>">
                        <?= $atrisk === 0 ? get_string('t_all_on_track','local_istikama_admin') : get_string('t_n_of_total','local_istikama_admin', ['n'=>$atrisk,'total'=>count($students)]) ?>
                    </span>
                    <?php endif; ?>
                </div>
                <div class="isti-kpi-icon <?= $atrisk > 0 ? 'red' : 'green' ?>"><i class="fa fa-triangle-exclamation"></i></div>
            </div>
            <div class="isti-kpi-card">
                <div class="isti-kpi-content">
                    <span class="isti-kpi-label"><?= get_string('ins_absent', 'local_istikama_admin') ?></span>
                    <span class="isti-kpi-value" style="color:<?= $absent_rate > 20 ? '#ef4444' : '#1e293b' ?>"><?= $absent_rate ?>%</span>
                    <span class="isti-kpi-trend <?= $absent_rate <= 10 ? 'up' : 'down' ?>">
                        <i class="fa <?= $absent_rate <= 10 ? 'fa-arrow-down' : 'fa-arrow-up' ?>"></i>
                        <?= $abs_total ?> session<?= $abs_total !== 1 ? 's' : '' ?>
                    </span>
                </div>
                <div class="isti-kpi-icon <?= $absent_rate > 20 ? 'red' : 'amber' ?>"><i class="fa fa-user-xmark"></i></div>
            </div>
        </div>

        <!-- ── STATUS DISTRIBUTION BAR ── -->
        <?php if (!empty($stud_rows)): ?>
        <div class="isti-card" style="padding:16px 20px;margin-bottom:18px">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;flex-wrap:wrap;gap:8px">
                <strong style="color:#0f172a;font-size:.9rem"><i class="fa fa-chart-pie" style="color:#006bff;margin-inline-end:7px"></i><?= get_string('t_status_distribution','local_istikama_admin') ?></strong>
                <div style="display:flex;gap:14px;font-size:.78rem;font-weight:600">
                    <span style="color:#10b981"><i class="fa fa-circle" style="font-size:.5rem;vertical-align:middle"></i> <?= get_string('ins_ontrack','local_istikama_admin') ?> (<?= $s_ontrack ?>)</span>
                    <span style="color:#ef4444"><i class="fa fa-circle" style="font-size:.5rem;vertical-align:middle"></i> <?= get_string('ins_atrisk','local_istikama_admin') ?> (<?= $s_atrisk ?>)</span>
                    <span style="color:#94a3b8"><i class="fa fa-circle" style="font-size:.5rem;vertical-align:middle"></i> <?= get_string('ins_nodata','local_istikama_admin') ?> (<?= $s_nodata ?>)</span>
                </div>
            </div>
            <?php $total_students = count($stud_rows); ?>
            <div style="height:14px;border-radius:8px;overflow:hidden;display:flex;gap:2px">
                <?php if ($s_ontrack): ?><div style="flex:<?= $s_ontrack ?>;background:#10b981;border-radius:8px 0 0 8px;transition:flex .4s ease"></div><?php endif; ?>
                <?php if ($s_atrisk):  ?><div style="flex:<?= $s_atrisk ?>;background:#ef4444;transition:flex .4s ease<?= !$s_ontrack ? ';border-radius:8px 0 0 8px' : '' ?>"></div><?php endif; ?>
                <?php if ($s_nodata):  ?><div style="flex:<?= $s_nodata ?>;background:#e2e8f0;border-radius:0 8px 8px 0;transition:flex .4s ease"></div><?php endif; ?>
                <?php if (!$s_ontrack && !$s_atrisk && !$s_nodata): ?><div style="flex:1;background:#e2e8f0;border-radius:8px"></div><?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- ── PER-STUDENT TABLE ── -->
        <?php if (empty($stud_rows)): ?>
        <div class="isti-card" style="text-align:center;padding:64px 20px">
            <i class="fa fa-users" style="font-size:2.8rem;color:#cbd5e1;display:block;margin-bottom:14px"></i>
            <p style="color:#94a3b8"><?= get_string('ins_empty', 'local_istikama_admin') ?></p>
        </div>
        <?php else: ?>
        <div class="isti-data-table">
            <div class="isti-data-table-scroll">
                <table>
                    <thead><tr>
                        <th style="min-width:200px"><?= get_string('ins_col_student', 'local_istikama_admin') ?></th>
                        <th style="min-width:190px"><?= get_string('ins_col_attendance', 'local_istikama_admin') ?></th>
                        <th style="text-align:center;min-width:80px"><?= get_string('ins_col_score', 'local_istikama_admin') ?></th>
                        <th style="text-align:center;min-width:70px"><?= get_string('ins_col_assess', 'local_istikama_admin') ?></th>
                        <th style="min-width:100px"><?= get_string('ins_col_last', 'local_istikama_admin') ?></th>
                        <th style="text-align:center;min-width:110px"><?= get_string('ins_col_status', 'local_istikama_admin') ?></th>
                    </tr></thead>
                    <tbody>
                    <?php foreach ($stud_rows as $r):
                        $s = $r['s'];
                        $barclr   = $r['arate'] === null ? '#cbd5e1' : ($r['arate'] < 70 ? '#ef4444' : ($r['arate'] < 85 ? '#f59e0b' : '#10b981'));
                        $scoreclr = $r['avg'] === null    ? '#94a3b8' : ($r['avg'] < 50 ? '#ef4444' : ($r['avg'] < 70 ? '#f59e0b' : '#10b981'));
                        $rowbg    = $r['status'] === 'atrisk' ? 'rgba(239,68,68,.03)' : '';
                        $pill_bg  = ['ontrack'=>'#dcfce7','atrisk'=>'#fee2e2','nodata'=>'#f1f5f9'][$r['status']];
                        $pill_fg  = ['ontrack'=>'#166534','atrisk'=>'#991b1b','nodata'=>'#64748b'][$r['status']];
                        $pill_ic  = ['ontrack'=>'fa-circle-check','atrisk'=>'fa-triangle-exclamation','nodata'=>'fa-minus'][$r['status']];
                        $pill_lbl = ['ontrack'=>get_string('ins_ontrack','local_istikama_admin'),'atrisk'=>get_string('ins_atrisk','local_istikama_admin'),'nodata'=>get_string('ins_nodata','local_istikama_admin')][$r['status']];
                    ?>
                        <tr style="<?= $rowbg ? "background:$rowbg" : '' ?>">
                            <td>
                                <div style="display:flex;align-items:center;gap:10px">
                                    <span style="width:36px;height:36px;border-radius:50%;background:<?= $r['status']==='atrisk'?'#fee2e2':'#eff6ff' ?>;color:<?= $r['status']==='atrisk'?'#ef4444':'#006bff' ?>;display:inline-flex;align-items:center;justify-content:center;font-weight:700;font-size:.84rem;flex-shrink:0"><?= mb_strtoupper(mb_substr($s->firstname, 0, 1)) ?></span>
                                    <div><div style="font-weight:600;color:#0f172a;font-size:.9rem"><?= fullname($s) ?></div>
                                    <div style="font-size:.72rem;color:#94a3b8"><?= s($s->email) ?></div></div>
                                </div>
                            </td>
                            <td>
                                <?php if ($r['arate'] === null): ?>
                                <span style="color:#cbd5e1;font-size:.82rem">—</span>
                                <?php else: ?>
                                <div style="display:flex;align-items:center;gap:9px">
                                    <div style="flex:1;height:8px;border-radius:6px;background:#f1f5f9;overflow:hidden;min-width:72px">
                                        <div style="width:<?= (int)$r['arate'] ?>%;height:100%;background:<?= $barclr ?>;border-radius:6px;transition:width .5s ease"></div>
                                    </div>
                                    <strong style="color:<?= $barclr ?>;font-size:.85rem;min-width:38px"><?= (int)$r['arate'] ?>%</strong>
                                </div>
                                <div style="font-size:.7rem;color:#94a3b8;margin-top:4px;display:flex;gap:8px">
                                    <span><i class="fa fa-check" style="color:#10b981"></i> <?= $r['apres'] ?></span>
                                    <span><i class="fa fa-clock" style="color:#f59e0b"></i> <?= $r['alate'] ?></span>
                                    <span><i class="fa fa-xmark" style="color:#ef4444"></i> <?= $r['aabs'] ?></span>
                                </div>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:center">
                                <?php if ($r['avg'] === null): ?>
                                <span style="color:#cbd5e1">—</span>
                                <?php else: ?>
                                <div style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:50%;background:<?= $scoreclr ?>15;color:<?= $scoreclr ?>;font-weight:800;font-size:.95rem"><?= $r['avg'] ?></div>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:center">
                                <span style="display:inline-flex;align-items:center;justify-content:center;width:30px;height:30px;border-radius:8px;background:#eff6ff;color:#006bff;font-weight:700;font-size:.85rem"><?= $r['acnt'] ?></span>
                            </td>
                            <td style="color:#64748b;font-size:.8rem">
                                <?= !empty($s->lastaccess) ? userdate($s->lastaccess, get_string('strftimedateshort', 'langconfig')) : '<span style="color:#cbd5e1">—</span>' ?>
                            </td>
                            <td style="text-align:center">
                                <span class="isti-pill" style="background:<?= $pill_bg ?>;color:<?= $pill_fg ?>;font-weight:700;font-size:.75rem;padding:4px 10px;border-radius:8px;display:inline-flex;align-items:center;gap:5px">
                                    <i class="fa <?= $pill_ic ?>"></i> <?= $pill_lbl ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>

        <?php
        // ── LESSONS ───────────────────────────────────────────────────────────
        elseif ($classtab === 'lessons'):
            $courses_l = [];
            try {
                $classcat_l = core_course_category::get($classid);
                foreach ($classcat_l->get_courses() as $c) {
                    if ((string)$c->id === (string)$subjectid) { $courses_l[] = $c; }
                }
            } catch (\Exception $e) {}
        ?>
        <?php if (empty($courses_l)): ?>
        <div class="isti-card" style="text-align:center;padding:64px 20px;color:#94a3b8">
            <i class="fa fa-book" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
            <p style="color:#475569"><?= get_string('t_no_lesson_structure','local_istikama_admin') ?></p>
        </div>
        <?php else: ?>
        <?php foreach ($courses_l as $course):
            $linked_content = 0; $linked_activities = 0;
            try { $linked_content = (int)$DB->count_records('istikama_content_lesson_link', ['courseid' => $course->id, 'classid' => $classid]); } catch (\Exception $e) {}
            try { $linked_activities = (int)$DB->count_records('istikama_activity_lesson_link', ['courseid' => $course->id, 'classid' => $classid]); } catch (\Exception $e) {}
        ?>
        <div class="isti-card" style="padding:20px 24px;margin-bottom:14px;display:flex;align-items:center;gap:18px;flex-wrap:wrap">
            <span style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.2rem">
                <i class="fa fa-book-open"></i>
            </span>
            <div style="flex:1;min-width:200px">
                <div style="font-weight:700;color:#1e293b;margin-bottom:6px"><?= format_string($course->fullname) ?></div>
                <div style="display:flex;gap:8px;flex-wrap:wrap">
                    <span class="isti-badge isti-badge-neutral"><i class="fa fa-file-alt"></i> <?= $linked_content ?> content</span>
                    <span class="isti-badge isti-badge-neutral"><i class="fa fa-clipboard-check"></i> <?= $linked_activities ?> activities</span>
                </div>
            </div>
            <a href="<?= (new moodle_url('/course/view.php', ['id' => $course->id]))->out(false) ?>" class="isti-btn isti-btn-outline" target="_blank">
                <i class="fa fa-external-link-alt"></i> Open Lesson
            </a>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>

        <?php
        // ── ASSESSMENTS (real quiz attempts by students in this subject) ──────
        elseif ($classtab === 'assessments'):
            // Resolve the courseid for this subject (subjectid here = course id).
            $assess_courseid = is_numeric($subjectid) ? (int)$subjectid : 0;

            // Pull all quizzes in this course with attempt data per enrolled student.
            $quizzes_in_course = [];
            $attempts_rows = [];
            $aq_qfilter = optional_param('aq_quiz', 0, PARAM_INT);
            $aq_search  = optional_param('aq_q', '', PARAM_TEXT);

            if ($assess_courseid > 0) {
                try {
                    $quizzes_in_course = $DB->get_records('quiz', ['course' => $assess_courseid], 'name ASC', 'id, name, grade, sumgrades');
                } catch (\Exception $e) {}

                if (!empty($quizzes_in_course) && !empty($students)) {
                    $student_ids = array_keys($students);
                    list($insql, $inparams) = $DB->get_in_or_equal($student_ids, SQL_PARAMS_NAMED, 'sid');
                    $quiz_ids = array_keys($quizzes_in_course);
                    list($qzinsql, $qzinparams) = $DB->get_in_or_equal($quiz_ids, SQL_PARAMS_NAMED, 'qz');
                    $params = array_merge($inparams, $qzinparams);

                    $extra_qz_filter = '';
                    if ($aq_qfilter && in_array($aq_qfilter, $quiz_ids)) {
                        $extra_qz_filter = ' AND qa.quiz = :qzfilter ';
                        $params['qzfilter'] = $aq_qfilter;
                    }

                    try {
                        $attempts_rows = $DB->get_records_sql("
                            SELECT qa.id, qa.userid, qa.quiz AS quizid, qa.attempt AS attemptnum,
                                   qa.state, qa.sumgrades, qa.timestart, qa.timefinish,
                                   q.name AS quizname, q.grade AS quizgrade, q.sumgrades AS quizsum
                              FROM {quiz_attempts} qa
                              JOIN {quiz} q ON q.id = qa.quiz
                             WHERE qa.preview = 0
                               AND qa.userid $insql
                               AND qa.quiz $qzinsql
                               $extra_qz_filter
                          ORDER BY qa.timefinish DESC, qa.timestart DESC
                        ", $params);
                    } catch (\Exception $e) {}
                }
            }

            // Build per-quiz best-grade view too (optional summary).
            $best_per_student = [];
            foreach ($attempts_rows as $row) {
                $k = (int)$row->userid . '|' . (int)$row->quizid;
                if (!isset($best_per_student[$k])) { $best_per_student[$k] = $row; continue; }
                if ((float)$row->sumgrades > (float)$best_per_student[$k]->sumgrades) {
                    $best_per_student[$k] = $row;
                }
            }
        ?>
        <?php if ($assess_courseid <= 0 || empty($quizzes_in_course)): ?>
        <div class="isti-card" style="text-align:center;padding:64px 20px;color:#94a3b8">
            <i class="fa fa-clipboard-check" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
            <p style="color:#475569;font-size:1rem;font-weight:500"><?= get_string('t_no_quizzes_subject','local_istikama_admin') ?></p>
            <p style="font-size:.88rem;color:#94a3b8"><?= get_string('t_add_quiz_hint','local_istikama_admin') ?></p>
        </div>
        <?php else: ?>
        <!-- Filter -->
        <div class="isti-card" style="padding:12px 18px;margin-bottom:16px;display:flex;gap:10px;align-items:center;flex-wrap:wrap">
            <form method="get" style="display:contents">
                <input type="hidden" name="section" value="classview">
                <input type="hidden" name="classid" value="<?= $classid ?>">
                <input type="hidden" name="subjectid" value="<?= s($subjectid) ?>">
                <input type="hidden" name="classtab" value="assessments">
                <select name="aq_quiz" class="isti-form-select" style="max-width:240px;font-size:.88rem">
                    <option value="0"><?= get_string('t_all_quizzes','local_istikama_admin') ?></option>
                    <?php foreach ($quizzes_in_course as $qz): ?>
                    <option value="<?= (int)$qz->id ?>" <?= $aq_qfilter === (int)$qz->id ? 'selected' : '' ?>><?= format_string($qz->name) ?></option>
                    <?php endforeach; ?>
                </select>
                <input type="text" name="aq_q" value="<?= s($aq_search) ?>" placeholder="Search by student name…" class="isti-form-input" style="flex:1;min-width:200px;font-size:.88rem">
                <button type="submit" class="isti-btn isti-btn-primary"><i class="fa fa-search"></i> <?= get_string('pk_filter','local_istikama_admin') ?></button>
            </form>
        </div>

        <?php
            // Build score rows (one row per attempt, filtered).
            $rows_render = [];
            foreach ($attempts_rows as $row) {
                $u = $students[$row->userid] ?? null;
                if (!$u) { continue; }
                $fn = fullname($u);
                if ($aq_search && stripos($fn, $aq_search) === false) { continue; }
                $rows_render[] = ['row' => $row, 'user' => $u];
            }
        ?>

        <?php if (empty($rows_render)): ?>
        <div class="isti-card" style="text-align:center;padding:48px 20px;color:#94a3b8">
            <i class="fa fa-clipboard" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
            <p style="color:#475569"><?= get_string('assessment_no_records', 'local_istikama_admin') ?></p>
            <p style="font-size:.88rem;color:#94a3b8"><?= get_string('t_no_attempts','local_istikama_admin') ?></p>
        </div>
        <?php else: ?>
        <div class="isti-card" style="padding:0;overflow:hidden">
            <div class="table-responsive">
                <table class="isti-table">
                    <thead><tr>
                        <th><?= get_string('assessment_student', 'local_istikama_admin') ?></th>
                        <th><?= get_string('assessment_title', 'local_istikama_admin') ?></th>
                        <th style="text-align:center;width:80px"><?= get_string('t_col_attempt','local_istikama_admin') ?></th>
                        <th style="text-align:center;width:130px"><?= get_string('t_col_score','local_istikama_admin') ?></th>
                        <th style="text-align:center;width:120px"><?= get_string('status','local_istikama_admin') ?></th>
                        <th style="text-align:right;width:160px"><?= get_string('t_col_finished','local_istikama_admin') ?></th>
                    </tr></thead>
                    <tbody>
                        <?php foreach ($rows_render as $r):
                            $row = $r['row']; $u = $r['user'];
                            $maxgrade = (float)($row->quizgrade ?: 0);
                            $sumgrades = (float)($row->quizsum ?: 0);
                            // Convert raw sumgrades to scaled grade out of quiz->grade.
                            $student_grade = null;
                            if ($sumgrades > 0 && $maxgrade > 0 && $row->sumgrades !== null) {
                                $student_grade = ((float)$row->sumgrades / $sumgrades) * $maxgrade;
                            }
                            $score_str = $student_grade !== null
                                ? round($student_grade, 2) . ' / ' . round($maxgrade, 2)
                                : '—';
                            $score_pct = ($maxgrade > 0 && $student_grade !== null) ? round(($student_grade / $maxgrade) * 100) : null;
                            $score_clr = $score_pct === null ? '#64748b' : ($score_pct >= 75 ? '#10b981' : ($score_pct >= 50 ? '#f59e0b' : '#ef4444'));

                            $state_map = [
                                'finished'  => ['#10b981', 'fa-check-circle', 'Finished'],
                                'inprogress'=> ['#f59e0b', 'fa-spinner',      'In Progress'],
                                'overdue'   => ['#ef4444', 'fa-exclamation-circle', 'Overdue'],
                                'abandoned' => ['#94a3b8', 'fa-times-circle', 'Abandoned'],
                            ];
                            [$st_clr, $st_ico, $st_lbl] = $state_map[$row->state] ?? ['#64748b', 'fa-circle', ucfirst((string)$row->state)];
                        ?>
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:10px">
                                    <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:50%;background:#eff6ff;color:#006bff;font-weight:700;font-size:.82rem;flex-shrink:0">
                                        <?= mb_strtoupper(mb_substr($u->firstname, 0, 1)) ?>
                                    </span>
                                    <strong><?= fullname($u) ?></strong>
                                </div>
                            </td>
                            <td><strong><?= format_string($row->quizname) ?></strong></td>
                            <td style="text-align:center"><span class="isti-badge isti-badge-neutral">#<?= (int)$row->attemptnum ?></span></td>
                            <td style="text-align:center"><span style="font-weight:700;color:<?= $score_clr ?>"><?= $score_str ?><?php if ($score_pct !== null): ?> <small style="color:<?= $score_clr ?>;font-weight:500">(<?= $score_pct ?>%)</small><?php endif; ?></span></td>
                            <td style="text-align:center"><span class="isti-badge" style="background:<?= $st_clr ?>15;color:<?= $st_clr ?>"><i class="fa <?= $st_ico ?>"></i> <?= $st_lbl ?></span></td>
                            <td style="text-align:right;font-size:.82rem;color:#64748b">
                                <?= !empty($row->timefinish) ? userdate($row->timefinish, get_string('strftimedatetimeshort', 'langconfig')) : '<span style="color:#cbd5e1">—</span>' ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="font-size:.82rem;color:#94a3b8;margin-top:8px;text-align:right"><?= count($rows_render) ?> attempts shown across <?= count($quizzes_in_course) ?> quiz<?= count($quizzes_in_course) === 1 ? '' : 'zes' ?></div>
        <?php endif; ?>
        <?php endif; ?>

        <?php
        // ── ATTENDANCE ────────────────────────────────────────────────────────
        elseif ($classtab === 'attendance'):
            $attend_date = optional_param('attend_date', date('Y-m-d'), PARAM_TEXT);
            $existing_att = [];
            try {
                $recs = $DB->get_records('istikama_attendance', ['classid' => $classid, 'subject' => $subjectid, 'attend_date' => $attend_date]);
                foreach ($recs as $r) { $existing_att[$r->studentid] = $r; }
            } catch (\Exception $e) {}
            $att_statuses = ['present' => ['fa-check-circle', '#10b981', get_string('attendance_present', 'local_istikama_admin')],
                             'absent'  => ['fa-times-circle', '#ef4444', get_string('attendance_absent',  'local_istikama_admin')],
                             'late'    => ['fa-clock',        '#f59e0b', get_string('attendance_late',    'local_istikama_admin')],
                             'excused' => ['fa-clipboard',    '#8b5cf6', get_string('attendance_excused', 'local_istikama_admin')]];
        ?>
<?php
            $attajax = (new moodle_url('/local/istikama_admin/attendance_ajax.php'))->out(false);
            $att_l = [
                'present'   => get_string('att_present', 'local_istikama_admin'),
                'absent'    => get_string('att_absent', 'local_istikama_admin'),
                'late'      => get_string('att_late', 'local_istikama_admin'),
                'excuse_q'  => get_string('att_excuse_q', 'local_istikama_admin'),
                'excused'   => get_string('att_excused', 'local_istikama_admin'),
                'no_excuse' => get_string('att_no_excuse', 'local_istikama_admin'),
                'just_q'    => get_string('att_justified_q', 'local_istikama_admin'),
                'just_ph'   => get_string('att_justify_ph', 'local_istikama_admin'),
                'for'       => get_string('att_for', 'local_istikama_admin'),
                'saved'     => get_string('att_saved', 'local_istikama_admin'),
                'nostud'    => get_string('att_no_students', 'local_istikama_admin'),
                'notrec'    => get_string('att_not_recorded', 'local_istikama_admin'),
                'future'    => get_string('att_future_day', 'local_istikama_admin'),
            ];
        ?>
        <div id="istiAtt" data-classid="<?= (int)$classid ?>" data-ajax="<?= s($attajax) ?>" data-sesskey="<?= sesskey() ?>" data-lang="<?= s(current_language()) ?>" data-strings='<?= s(json_encode($att_l, JSON_UNESCAPED_UNICODE)) ?>'>
            <div class="isti-card" style="padding:18px 22px;margin-bottom:14px;display:flex;align-items:center;gap:14px;flex-wrap:wrap">
                <span style="width:46px;height:46px;border-radius:12px;background:#eff6ff;color:#006bff;display:inline-flex;align-items:center;justify-content:center;font-size:1.3rem;flex-shrink:0"><i class="fa fa-calendar-check"></i></span>
                <div style="flex:1;min-width:180px">
                    <h5 style="margin:0;font-weight:700;color:#0f172a"><?= get_string('att_cal_title', 'local_istikama_admin') ?></h5>
                    <p style="margin:2px 0 0;color:#64748b;font-size:.85rem"><?= get_string('att_cal_sub', 'local_istikama_admin') ?></p>
                </div>
                <div style="display:flex;align-items:center;gap:6px;flex-wrap:wrap">
                    <button type="button" class="isti-btn isti-btn-outline" id="attPrev" aria-label="prev"><i class="fa fa-chevron-left"></i></button>
                    <strong id="attMonthLabel" style="min-width:160px;text-align:center;color:#0f172a"></strong>
                    <button type="button" class="isti-btn isti-btn-outline" id="attNext" aria-label="next"><i class="fa fa-chevron-right"></i></button>
                    <button type="button" class="isti-btn isti-btn-primary" id="attToday"><?= get_string('att_today', 'local_istikama_admin') ?></button>
                </div>
            </div>
            <div style="display:flex;gap:18px;flex-wrap:wrap;margin-bottom:12px;font-size:.8rem;color:#475569;padding:0 4px">
                <span><i class="fa fa-circle" style="color:#10b981"></i> <?= get_string('att_present', 'local_istikama_admin') ?></span>
                <span><i class="fa fa-circle" style="color:#ef4444"></i> <?= get_string('att_absent', 'local_istikama_admin') ?></span>
                <span><i class="fa fa-circle" style="color:#f59e0b"></i> <?= get_string('att_late', 'local_istikama_admin') ?></span>
            </div>
            <div class="isti-card" style="padding:14px">
                <div class="isti-attcal-grid" id="attWeekdays" style="margin-bottom:8px"></div>
                <div class="isti-attcal-grid" id="attDays"></div>
            </div>
        </div>

        <div class="isti-modal-overlay" id="attModal" role="dialog" aria-modal="true" style="display:none">
            <div class="isti-modal isti-att-modal">
                <div class="isti-modal-header">
                    <h5 id="attModalTitle" style="margin:0;font-weight:700;color:#0f172a;display:flex;align-items:center;gap:10px"></h5>
                    <button type="button" class="att-close" aria-label="Close" style="background:none;border:0;color:#64748b;font-size:1.2rem;cursor:pointer"><i class="fa fa-xmark"></i></button>
                </div>
                <div class="isti-modal-body" id="attModalBody"></div>
                <div class="isti-modal-footer">
                    <button type="button" class="att-close isti-btn isti-btn-outline"><?= get_string('att_close', 'local_istikama_admin') ?></button>
                    <button type="button" id="attMarkAll" class="isti-btn isti-btn-outline"><i class="fa fa-check-double"></i> <?= get_string('att_mark_all_present', 'local_istikama_admin') ?></button>
                    <button type="button" id="attSaveBtn" class="isti-btn isti-btn-primary"><i class="fa fa-save"></i> <?= get_string('att_save', 'local_istikama_admin') ?></button>
                </div>
            </div>
        </div>

        <style>
        .isti-attcal-grid{display:grid;grid-template-columns:repeat(7,1fr);gap:8px}
        #attWeekdays>div{text-align:center;font-size:.72rem;font-weight:700;text-transform:uppercase;color:#94a3b8;padding:4px 0}
        .isti-attday{min-height:76px;border:1px solid #e2e8f0;border-radius:10px;padding:6px 8px;cursor:pointer;background:#fff;transition:.12s;display:flex;flex-direction:column;gap:4px}
        .isti-attday:hover{border-color:#006bff;box-shadow:0 6px 16px -8px rgba(0,107,255,.5)}
        .isti-attday.empty{background:transparent;border:0;cursor:default;box-shadow:none}
        .isti-attday.today{border-color:#006bff;background:#eff6ff}
        .isti-attday.future{opacity:.45;cursor:not-allowed;pointer-events:none}
        .isti-attday-num{font-weight:700;font-size:.85rem;color:#334155}
        .isti-attday-dots{display:flex;gap:4px;flex-wrap:wrap;margin-top:auto}
        .isti-attday-dot{font-size:.64rem;font-weight:700;padding:1px 6px;border-radius:6px;line-height:1.5}
        .att-dot-p{background:#dcfce7;color:#166534}.att-dot-a{background:#fee2e2;color:#991b1b}.att-dot-l{background:#fef3c7;color:#92400e}
        #attModal .isti-att-modal{display:flex;flex-direction:column;max-height:94vh;overflow:hidden;width:min(920px,calc(100vw - 24px))!important;max-width:920px!important}
        #attModal .isti-modal-body{flex:1 1 auto;min-height:0;overflow-y:auto;overflow-x:auto;padding:0}
        #attModal.isti-modal-visible,#attModal[style*="flex"]{align-items:center;justify-content:center}
        /* Attendance marking table */
        /* Responsive: collapse 5-col KPI grid on narrower screens */
        @media(max-width:1100px){.isti-kpi-grid[style*="repeat(5"]{grid-template-columns:repeat(3,1fr)!important}}
        @media(max-width:700px){.isti-kpi-grid[style*="repeat(5"]{grid-template-columns:repeat(2,1fr)!important}}
        #attTbl{width:100%;border-collapse:collapse;min-width:580px}
        #attTbl thead th{background:linear-gradient(180deg,#006bff,#0052cc);color:#fff;font-weight:700;font-size:.73rem;text-transform:uppercase;letter-spacing:.05em;padding:11px 14px;position:sticky;top:0;z-index:2;white-space:nowrap;border:0}
        #attTbl tbody tr{border-bottom:1px solid #f1f5f9}
        #attTbl tbody tr:last-child{border-bottom:0}
        #attTbl tbody tr.att-tr-absent{background:rgba(239,68,68,.04)}
        #attTbl tbody tr.att-tr-late{background:rgba(245,158,11,.04)}
        #attTbl tbody td{padding:9px 14px;vertical-align:middle;font-size:.86rem;color:#1e293b;border-left:0;border-right:0}
        #attTbl th,#attTbl td{border-left:0!important;border-right:0!important}
        .att-num{color:#94a3b8;font-size:.78rem;font-weight:700;min-width:24px}
        .att-av{width:30px;height:30px;border-radius:50%;background:#eff6ff;color:#006bff;display:inline-flex;align-items:center;justify-content:center;font-weight:700;font-size:.76rem;flex-shrink:0}
        /* Status radio buttons rendered as icon-pills */
        .att-radio-grp{display:inline-flex;border:1.5px solid #e2e8f0;border-radius:9px;overflow:hidden}
        .att-radio-grp button{border:0;background:#fafafa;padding:5px 11px;font-size:.76rem;font-weight:600;color:#64748b;cursor:pointer;transition:background .12s,color .12s;display:inline-flex;align-items:center;gap:4px;border-inline-end:1px solid #e2e8f0}
        .att-radio-grp button:last-child{border-inline-end:0}
        .att-radio-grp button.on.s-p{background:#10b981;color:#fff}
        .att-radio-grp button.on.s-a{background:#ef4444;color:#fff}
        .att-radio-grp button.on.s-l{background:#f59e0b;color:#fff}
        /* Excuse chip (appears inline next to status for absent/late) */
        .att-ex-wrap{display:inline-flex;align-items:center;gap:6px;margin-inline-start:8px;vertical-align:middle}
        .att-ex-btn{border:1.5px solid #cbd5e1;border-radius:7px;background:#fff;font-size:.72rem;font-weight:600;color:#64748b;padding:3px 9px;cursor:pointer;white-space:nowrap}
        .att-ex-btn.on{background:#006bff;border-color:#006bff;color:#fff}
        /* Note input */
        .att-note-inp{width:100%;border:1.5px solid #e2e8f0;border-radius:8px;padding:5px 9px;font-size:.78rem;color:#334155;background:#fff}
        .att-note-inp:focus{outline:0;border-color:#006bff}
        /* Summary bar at top of table body */
        #attSummaryBar{display:flex;gap:8px;padding:10px 14px;background:#f8fafc;border-bottom:1px solid #e2e8f0;font-size:.78rem;font-weight:600;align-items:center;flex-wrap:wrap}
        .att-sum-chip{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:8px}
        .att-sum-p{background:#dcfce7;color:#166534}.att-sum-a{background:#fee2e2;color:#991b1b}.att-sum-l{background:#fef3c7;color:#92400e}
        </style>
        <script>
        (function(){
          var root=document.getElementById('istiAtt'); if(!root) return;
          var AJAX=root.dataset.ajax, CID=root.dataset.classid, SESS=root.dataset.sesskey, LANG=root.dataset.lang||'en';
          var L={}; try{ L=JSON.parse(root.dataset.strings); }catch(e){}
          var weekdaysEl=document.getElementById('attWeekdays'), daysEl=document.getElementById('attDays'), monLbl=document.getElementById('attMonthLabel');
          var modal=document.getElementById('attModal'), body=document.getElementById('attModalBody'), title=document.getElementById('attModalTitle');
          var now=new Date(), cur={y:now.getFullYear(), m:now.getMonth()+1}, monthData={}, dayState=[], curDate='';
          var todayStr=fmt(now);
          function pad(n){return (n<10?'0':'')+n;}
          function fmt(d){return d.getFullYear()+'-'+pad(d.getMonth()+1)+'-'+pad(d.getDate());}
          function esc(s){var d=document.createElement('div');d.textContent=(s==null?'':String(s));return d.innerHTML;}
          function intl(opts){try{return new Intl.DateTimeFormat(LANG,opts);}catch(e){return new Intl.DateTimeFormat('en',opts);}}

          // weekday headers (Mon..Sun)
          (function(){var f=intl({weekday:'short'});var h='';for(var i=0;i<7;i++){var d=new Date(2024,0,1+i);/*Mon Jan1 2024*/h+='<div>'+esc(f.format(d))+'</div>';}weekdaysEl.innerHTML=h;})();

          function renderMonth(){
            monLbl.textContent=intl({month:'long',year:'numeric'}).format(new Date(cur.y,cur.m-1,1));
            var q=AJAX+'?action=month&classid='+CID+'&year='+cur.y+'&month='+cur.m+'&sesskey='+SESS;
            fetch(q,{credentials:'same-origin'}).then(function(r){return r.json();}).then(function(d){
              monthData=(d&&d.days)||{}; paint();
            }).catch(function(){ monthData={}; paint(); });
          }
          function paint(){
            var first=new Date(cur.y,cur.m-1,1);
            var lead=(first.getDay()+6)%7; // Monday-first
            var dim=new Date(cur.y,cur.m,0).getDate();
            var html='';
            for(var i=0;i<lead;i++){ html+='<div class="isti-attday empty"></div>'; }
            for(var day=1;day<=dim;day++){
              var ds=cur.y+'-'+pad(cur.m)+'-'+pad(day);
              var info=monthData[ds];
              var cls='isti-attday'; if(ds===todayStr)cls+=' today'; if(ds>todayStr)cls+=' future';
              var dots='';
              if(info){ if(info.present)dots+='<span class="isti-attday-dot att-dot-p">'+info.present+'</span>'; if(info.absent)dots+='<span class="isti-attday-dot att-dot-a">'+info.absent+'</span>'; if(info.late)dots+='<span class="isti-attday-dot att-dot-l">'+info.late+'</span>'; }
              html+='<div class="'+cls+'" data-d="'+ds+'"><span class="isti-attday-num">'+day+'</span><div class="isti-attday-dots">'+dots+'</div></div>';
            }
            daysEl.innerHTML=html;
            daysEl.querySelectorAll('.isti-attday[data-d]').forEach(function(c){
              if(c.classList.contains('future')) return;
              c.addEventListener('click',function(){ openDay(c.getAttribute('data-d')); });
            });
          }
          document.getElementById('attPrev').addEventListener('click',function(){ cur.m--; if(cur.m<1){cur.m=12;cur.y--;} renderMonth(); });
          document.getElementById('attNext').addEventListener('click',function(){ cur.m++; if(cur.m>12){cur.m=1;cur.y++;} renderMonth(); });
          document.getElementById('attToday').addEventListener('click',function(){ cur={y:now.getFullYear(),m:now.getMonth()+1}; renderMonth(); });

          // Build the full attendance table (compact, scales to 30+ students).
          function buildTable(){
            if(!dayState.length){ body.innerHTML='<p style="text-align:center;color:#94a3b8;padding:24px">'+esc(L.nostud)+'</p>'; return; }
            var html='<div id="attSummaryBar"></div>'+
              '<table id="attTbl"><thead><tr>'+
              '<th style="width:36px;text-align:center">#</th>'+
              '<th><?= s(get_string('t_col_student','local_istikama_admin')) ?></th>'+
              '<th style="min-width:210px"><?= get_string('status','local_istikama_admin') ?></th>'+
              '<th style="min-width:90px"><?= s(get_string('t_col_excuse','local_istikama_admin')) ?></th>'+
              '<th style="min-width:160px">'+esc(L.just_ph.split(' ')[0])+'…</th>'+
              '</tr></thead><tbody>';
            dayState.forEach(function(s,i){
              var trCls='att-tr-'+(s.status==='absent'?'absent':s.status==='late'?'late':'');
              html+='<tr class="'+trCls+'" data-i="'+i+'">'+
                '<td class="att-num" style="text-align:center">'+(i+1)+'</td>'+
                '<td><div style="display:flex;align-items:center;gap:8px">'+
                  '<span class="att-av">'+esc(s.initial)+'</span>'+
                  '<span style="font-weight:600;font-size:.88rem">'+esc(s.name)+'</span>'+
                '</div></td>'+
                '<td><div class="att-radio-grp" data-rg="'+i+'">'+
                  '<button type="button" data-s="present" class="s-p'+(s.status==='present'?' on':'')+'"><i class="fa fa-check"></i> '+esc(L.present)+'</button>'+
                  '<button type="button" data-s="absent"  class="s-a'+(s.status==='absent'?' on':'')+'"><i class="fa fa-xmark"></i> '+esc(L.absent)+'</button>'+
                  '<button type="button" data-s="late"    class="s-l'+(s.status==='late'?' on':'')+'"><i class="fa fa-clock"></i> '+esc(L.late)+'</button>'+
                '</div></td>'+
                '<td>'+exChip(s,i)+'</td>'+
                '<td><input class="att-note-inp" data-ni="'+i+'" value="'+esc(s.note||'')+'" placeholder="'+esc(L.just_ph)+'"'+(s.status==='present'?' style="display:none"':'')+'></td>'+
              '</tr>';
            });
            html+='</tbody></table>';
            body.innerHTML=html;
            wireTable();
            refreshSummary();
          }

          function exChip(s,i){
            if(s.status==='present'||s.status==='') return '<span style="color:#cbd5e1;font-size:.8rem">—</span>';
            var lbl=s.status==='late'?esc(L.excuse_q):esc(L.just_q);
            return '<span class="att-ex-wrap" data-ew="'+i+'">'+
              '<button type="button" class="att-ex-btn on" data-ev="1">'+esc(L.excused)+'</button>'+
              '<button type="button" class="att-ex-btn'+(s.excused===0?' on':'')+'" data-ev="0">'+esc(L.no_excuse)+'</button>'+
            '</span>';
          }

          function refreshSummary(){
            var cnt={present:0,absent:0,late:0};
            dayState.forEach(function(s){ if(cnt[s.status]!==undefined) cnt[s.status]++; });
            var bar=document.getElementById('attSummaryBar');
            if(!bar) return;
            bar.innerHTML=
              '<span class="att-sum-chip att-sum-p"><i class="fa fa-check"></i> '+cnt.present+' '+esc(L.present)+'</span>'+
              '<span class="att-sum-chip att-sum-a"><i class="fa fa-xmark"></i> '+cnt.absent+' '+esc(L.absent)+'</span>'+
              '<span class="att-sum-chip att-sum-l"><i class="fa fa-clock"></i> '+cnt.late+' '+esc(L.late)+'</span>'+
              '<span style="margin-inline-start:auto;color:#94a3b8">'+dayState.length+' total</span>';
          }

          // Event delegation on the table — scales to 30+ students without wiring per-row.
          function wireTable(){
            var tbl=document.getElementById('attTbl');
            if(!tbl) return;
            tbl.addEventListener('click',function(e){
              // Status buttons
              var btn=e.target.closest('[data-rg] button[data-s]');
              if(btn){
                var i=+btn.closest('[data-rg]').dataset.rg;
                btn.closest('[data-rg]').querySelectorAll('button').forEach(function(x){x.classList.remove('on');});
                btn.classList.add('on');
                dayState[i].status=btn.dataset.s;
                var tr=btn.closest('tr');
                tr.className='att-tr-'+(btn.dataset.s==='absent'?'absent':btn.dataset.s==='late'?'late':'');
                // Refresh excuse chip cell
                tr.querySelector('[data-ew="'+i+'"]')
                  ? (tr.cells[3].innerHTML=exChip(dayState[i],i), wireExcuse(tr.cells[3],i))
                  : (tr.cells[3].innerHTML=exChip(dayState[i],i), wireExcuse(tr.cells[3],i));
                // Show/hide note input
                var ni=tr.querySelector('.att-note-inp');
                if(ni) ni.style.display=btn.dataset.s==='present'?'none':'';
                refreshSummary();
              }
              // Excuse buttons
              var exb=e.target.closest('.att-ex-btn');
              if(exb){
                var ew=exb.closest('[data-ew]'); if(!ew) return;
                var i=+ew.dataset.ew;
                ew.querySelectorAll('.att-ex-btn').forEach(function(x){x.classList.remove('on');});
                exb.classList.add('on');
                dayState[i].excused=+exb.dataset.ev;
              }
            });
            tbl.addEventListener('input',function(e){
              var ni=e.target.closest('.att-note-inp');
              if(ni){ dayState[+ni.dataset.ni].note=ni.value; }
            });
            // Wire existing excuse chips in initial render.
            tbl.querySelectorAll('[data-ew]').forEach(function(ew){ wireExcuse(ew,+ew.dataset.ew); });
          }
          function wireExcuse(cell,i){
            cell.querySelectorAll('.att-ex-btn').forEach(function(b){
              b.addEventListener('click',function(){
                cell.querySelectorAll('.att-ex-btn').forEach(function(x){x.classList.remove('on');});
                b.classList.add('on');
                dayState[i].excused=+b.dataset.ev;
              });
            });
          }

          function openDay(ds){
            curDate=ds;
            title.innerHTML='<i class="fa fa-calendar-day" style="color:#006bff"></i> '+esc(L.for)+' '+esc(intl({weekday:'long',day:'numeric',month:'long',year:'numeric'}).format(new Date(ds+'T00:00:00')));
            body.innerHTML='<div style="text-align:center;padding:30px;color:#94a3b8"><i class="fa fa-spinner fa-spin"></i></div>';
            show();
            fetch(AJAX+'?action=day&classid='+CID+'&date='+ds+'&sesskey='+SESS,{credentials:'same-origin'}).then(function(r){return r.json();}).then(function(d){
              if(!d.ok){ body.innerHTML='<p style="color:#ef4444;padding:20px">'+esc(d.message||'error')+'</p>'; return; }
              dayState=d.students.map(function(s){ return {studentid:s.studentid,name:s.name,initial:s.initial,status:s.status||'present',excused:s.excused,note:s.note}; });
              buildTable();
            });
          }

          document.getElementById('attMarkAll').addEventListener('click',function(){
            dayState.forEach(function(s){ s.status='present'; s.excused=0; });
            buildTable();
          });
          document.getElementById('attSaveBtn').addEventListener('click',function(){
            var btn=this, old=btn.innerHTML; btn.disabled=true; btn.innerHTML='<i class="fa fa-spinner fa-spin"></i>';
            var fd=new FormData(); fd.append('action','save'); fd.append('classid',CID); fd.append('date',curDate); fd.append('sesskey',SESS); fd.append('rows',JSON.stringify(dayState));
            fetch(AJAX,{method:'POST',body:fd,credentials:'same-origin'}).then(function(r){return r.json();}).then(function(d){
              btn.disabled=false; btn.innerHTML=old;
              if(d.ok){ hide(); renderMonth(); }
              else { alert(d.message||'error'); }
            }).catch(function(){ btn.disabled=false; btn.innerHTML=old; });
          });
          function show(){ modal.style.display='flex'; requestAnimationFrame(function(){modal.classList.add('isti-modal-visible');}); document.body.style.overflow='hidden'; }
          function hide(){ modal.classList.remove('isti-modal-visible'); document.body.style.overflow=''; setTimeout(function(){modal.style.display='none';},160); }
          modal.querySelectorAll('.att-close').forEach(function(b){ b.addEventListener('click',hide); });
          modal.addEventListener('click',function(e){ if(e.target===modal) hide(); });
          document.addEventListener('keydown',function(e){ if(e.key==='Escape'&&modal.classList.contains('isti-modal-visible')) hide(); });

          renderMonth();
        })();
        </script>

        <?php
        // ── INTERACTION ───────────────────────────────────────────────────────
        elseif ($classtab === 'interaction'):
            $linked_acts = [];
            try {
                $linked_acts = $DB->get_records_sql(
                    "SELECT al.*, ta.name AS activity_name, ta.type AS activity_type
                       FROM {istikama_activity_lesson_link} al
                       JOIN {istikama_teacher_activities} ta ON ta.id = al.activity_id
                      WHERE al.classid = :classid",
                    ['classid' => $classid]);
            } catch (\Exception $e) {}
        ?>
        <?php if (empty($linked_acts)): ?>
        <div class="isti-card" style="text-align:center;padding:64px 20px;color:#94a3b8">
            <i class="fa fa-exchange-alt" style="font-size:3rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
            <p style="color:#475569"><?= get_string('interaction_no_data', 'local_istikama_admin') ?></p>
        </div>
        <?php else: ?>
        <div class="isti-card" style="padding:0;overflow:hidden">
            <div class="table-responsive">
                <table class="isti-table">
                    <thead><tr>
                        <th><?= get_string('interaction_activity_name', 'local_istikama_admin') ?></th>
                        <th><?= get_string('act_col_type','local_istikama_admin') ?></th>
                        <th style="text-align:right"><?= get_string('linked_date', 'local_istikama_admin') ?></th>
                    </tr></thead>
                    <tbody>
                        <?php foreach ($linked_acts as $la): ?>
                        <tr>
                            <td><strong><?= format_string($la->activity_name) ?></strong></td>
                            <td><span class="isti-badge isti-badge-neutral"><?= s($la->activity_type) ?></span></td>
                            <td style="text-align:right;font-size:.82rem;color:#64748b"><?= userdate($la->timecreated, get_string('strftimedatetimeshort', 'langconfig')) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
        </div>
        <?php endif; ?>
        <?php endif; // classtab ?>
        </div><!-- container-fluid -->
        <?php
    } // end subject view
} // end classview

local_istikama_admin_print_footer();
