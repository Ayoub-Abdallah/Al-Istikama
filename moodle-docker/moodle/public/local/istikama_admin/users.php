<?php
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');
require_once($CFG->libdir . '/accesslib.php');

require_login();
local_istikama_admin_require_full_admin();
$systemcontext = context_system::instance();
$baseurl = new moodle_url('/local/istikama_admin/users.php');

$roleid = optional_param('roleid', 0, PARAM_INT);
$school = optional_param('school', '', PARAM_TEXT);
$search = optional_param('search', '', PARAM_TEXT);
$page = optional_param('page', 0, PARAM_INT);
$perpage = optional_param('perpage', 25, PARAM_INT);
$perpage = max(10, min($perpage, 100));
$action = optional_param('action', '', PARAM_ALPHA);

if ($action === 'bulkassign' && confirm_sesskey()) {
    require_capability('moodle/role:assign', $systemcontext);
    $selected = optional_param_array('selectedusers', [], PARAM_INT);
    $newroleid = optional_param('newroleid', 0, PARAM_INT);

    if ($newroleid && !empty($selected)) {
        foreach ($selected as $userid) {
            if (!$DB->record_exists('role_assignments', [
                'roleid' => $newroleid,
                'userid' => $userid,
                'contextid' => $systemcontext->id,
            ])) {
                role_assign($newroleid, $userid, $systemcontext->id);
            }
        }
        redirect($baseurl, get_string('changessaved'));
    }
}

if ($action === 'bulkremove' && confirm_sesskey()) {
    require_capability('moodle/role:assign', $systemcontext);
    $selected = optional_param_array('selectedusers', [], PARAM_INT);
    $oldroleid = optional_param('newroleid', 0, PARAM_INT);

    if ($oldroleid && !empty($selected)) {
        foreach ($selected as $userid) {
            role_unassign($oldroleid, $userid, $systemcontext->id);
        }
        redirect($baseurl, get_string('changessaved'));
    }
}

$roles = $DB->get_records('role', null, 'sortorder ASC', 'id,shortname,name');
$roleoptions = [0 => get_string('all')];
foreach ($roles as $role) {
    $roleoptions[(int)$role->id] = role_get_name($role, $systemcontext);
}

$schooloptions = ['' => get_string('all')];
$schools = core_course_category::top()->get_children();
foreach ($schools as $sch) {
    $schooloptions[(int)$sch->id] = format_string($sch->name);
}

$where = ['u.deleted = 0', 'u.confirmed = 1'];
$params = [];

if ($search !== '') {
    $like = $DB->sql_like($DB->sql_concat('u.firstname', "' '", 'u.lastname'), ':searchname', false, false) .
        ' OR ' . $DB->sql_like('u.email', ':searchemail', false, false);
    $where[] = "({$like})";
    $params['searchname'] = "%{$search}%";
    $params['searchemail'] = "%{$search}%";
}

if ($roleid > 0) {
    $where[] = "EXISTS (
        SELECT 1
          FROM {role_assignments} ra
          JOIN {context} cx ON cx.id = ra.contextid
         WHERE ra.userid = u.id
           AND cx.contextlevel = :contextlevel
           AND ra.roleid = :roleid
    )";
    $params['contextlevel'] = CONTEXT_SYSTEM;
    $params['roleid'] = $roleid;
}

if ($school !== '') {
    $where[] = "EXISTS (
        SELECT 1
          FROM {istikama_user_school} us
         WHERE us.userid = u.id
           AND us.schoolid = :schoolfilter
    )";
    $params['schoolfilter'] = (int)$school;
}

$wheresql = implode(' AND ', $where);
$countsql = "SELECT COUNT(1) FROM {user} u WHERE {$wheresql}";
$totalusers = (int)$DB->count_records_sql($countsql, $params);

$selectsql = "SELECT u.id, u.firstname, u.lastname, u.email, u.lastaccess
                FROM {user} u
               WHERE {$wheresql}
            ORDER BY u.lastname ASC, u.firstname ASC";
$users = $DB->get_records_sql($selectsql, $params, $page * $perpage, $perpage);

$userids = array_map(static function($u): int {
    return (int)$u->id;
}, $users);

$rolesbyuser = [];
$roleshortbyuser = [];
if (!empty($userids)) {
    [$insql, $inparams] = $DB->get_in_or_equal($userids, SQL_PARAMS_NAMED);
    $rparams = array_merge($inparams, ['contextlevel2' => CONTEXT_SYSTEM]);
    $rsql = "SELECT ra.id as raid, ra.userid, r.shortname, r.name
               FROM {role_assignments} ra
               JOIN {role} r ON r.id = ra.roleid
               JOIN {context} cx ON cx.id = ra.contextid
              WHERE cx.contextlevel = :contextlevel2
                AND ra.userid {$insql}";
    $roleassignments = $DB->get_records_sql($rsql, $rparams);
    foreach ($roleassignments as $assignment) {
        $uid = (int)$assignment->userid;
        $rolesbyuser[$uid][] = !empty($assignment->name) ? $assignment->name : $assignment->shortname;
        $roleshortbyuser[$uid][] = $assignment->shortname;
    }
}

$schoolsbyuser = [];
if (!empty($userids)) {
    [$uinsql, $uiparams] = $DB->get_in_or_equal($userids, SQL_PARAMS_NAMED);
    $uisql = "SELECT us.userid, cc.name 
                FROM {istikama_user_school} us
                JOIN {course_categories} cc ON cc.id = us.schoolid
               WHERE us.userid {$uinsql}";
    $schoolrecords = $DB->get_recordset_sql($uisql, $uiparams);
    $temp = [];
    foreach ($schoolrecords as $row) {
        $temp[(int)$row->userid][] = format_string($row->name);
    }
    $schoolrecords->close();
    
    foreach ($temp as $uid => $names) {
        $schoolsbyuser[$uid] = implode(', ', array_unique($names));
    }
}

// Helper to detect role type.
function _istikama_detect_role_type(array $shortnames): string {
    $manager_roles = ['manager', 'coursecreator', 'schoolmanager'];
    $parent_roles = ['parent'];
    $tech_prof_roles = ['technicalprofessor', 'technical_professor', 'technicalprof', 'technical_teacher'];
    $teacher_roles = ['teacher', 'editingteacher'];
    $student_roles = ['student'];

    foreach ($shortnames as $sn) {
        if (in_array($sn, $manager_roles)) return 'manager';
    }
    foreach ($shortnames as $sn) {
        if (in_array($sn, $parent_roles)) return 'parent';
    }
    foreach ($shortnames as $sn) {
        if (in_array($sn, $tech_prof_roles)) return 'technical_professor';
    }
    foreach ($shortnames as $sn) {
        if (in_array($sn, $teacher_roles)) return 'teacher';
    }
    foreach ($shortnames as $sn) {
        if (in_array($sn, $student_roles)) return 'student';
    }
    return 'none';
}

$rows = [];
foreach ($users as $user) {
    $userid = (int)$user->id;
    $userroletype = _istikama_detect_role_type($roleshortbyuser[$userid] ?? []);
    
    // Plain-text school value (used for CSV export — never HTML).
    $school_plain = $schoolsbyuser[$userid] ?? get_string('nocustomschool', 'local_istikama_admin');
    if ($userroletype === 'technical_professor' || $userroletype === 'full_admin') {
        $school_plain = get_string('platform_wide', 'local_istikama_admin');
    }
    // HTML display value (badge for platform-wide roles).
    $school_display = s($school_plain);
    if ($userroletype === 'technical_professor') {
        $school_display = '<span class="badge badge-info" style="background:#3b82f6;color:white;padding:4px 8px;border-radius:12px;font-size:0.75rem">' . get_string('platform_wide', 'local_istikama_admin') . '</span>';
    } else if ($userroletype === 'full_admin') {
        $school_display = '<span class="badge badge-secondary" style="background:#64748b;color:white;padding:4px 8px;border-radius:12px;font-size:0.75rem">' . get_string('platform_wide', 'local_istikama_admin') . '</span>';
    }

    $rows[] = [
        'id' => $userid,
        'name' => fullname($user),
        'email' => s($user->email),
        'role' => s(implode(', ', $rolesbyuser[$userid] ?? [])),
        'role_type' => $userroletype,
        'school' => $school_display,
        'lastlogin' => !empty($user->lastaccess) ? userdate($user->lastaccess) : '-',
        // Plain-text values for CSV export (no HTML, no escaping).
        'email_plain' => $user->email,
        'role_plain' => implode(', ', $rolesbyuser[$userid] ?? []),
        'school_plain' => $school_plain,
        'editurl' => (new moodle_url('/user/editadvanced.php', ['id' => $userid, 'returnto' => 'istikama']))->out(false),
        'viewurl' => (new moodle_url('/user/profile.php', ['id' => $userid]))->out(false),
        'deleteurl' => (new moodle_url('/admin/user.php', [
            'delete' => $userid,
            'sesskey' => sesskey(),
        ]))->out(false),
    ];
}

$download = optional_param('download', '', PARAM_ALPHA);
$selectedforcsv = optional_param_array('selectedusers', [], PARAM_INT);
if ($download === 'csv') {
    if (!empty($selectedforcsv)) {
        $rows = array_values(array_filter($rows, static function(array $row) use ($selectedforcsv): bool {
            return in_array((int)$row['id'], $selectedforcsv, true);
        }));
    }

    // Excel-friendly CSV: UTF-8 with BOM, RFC-4180 (every field quoted, "" escaped),
    // CRLF line endings, and only plain text (no HTML/badges/markup) in any cell.
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="users_export_' . date('Y-m-d') . '.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Normalise any value to clean single-line plain text.
    $csvclean = static function ($v): string {
        $v = (string)$v;
        $v = html_entity_decode(strip_tags($v), ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $v = preg_replace('/\s*\R\s*/u', ' ', $v);   // collapse newlines
        return trim($v);
    };
    // RFC-4180 row: quote every field, escape embedded quotes, CRLF terminator.
    $writerow = static function (array $fields) use ($csvclean): void {
        $cells = array_map(static function ($f) use ($csvclean): string {
            return '"' . str_replace('"', '""', $csvclean($f)) . '"';
        }, $fields);
        echo implode(',', $cells) . "\r\n";
    };

    echo "\xEF\xBB\xBF"; // UTF-8 BOM so Excel detects the encoding.
    $writerow([
        get_string('name', 'local_istikama_admin'),
        get_string('email', 'local_istikama_admin'),
        get_string('role', 'local_istikama_admin'),
        get_string('school', 'local_istikama_admin'),
        get_string('lastlogin', 'local_istikama_admin'),
    ]);
    foreach ($rows as $row) {
        $writerow([
            $row['name'],
            $row['email_plain'],
            $row['role_plain'],
            $row['school_plain'],
            $row['lastlogin'],
        ]);
    }
    exit;
}

// Build subjects list for template.
$templatecontext = [
    'baseurl' => $baseurl->out(false),
    'ajaxurl' => (new moodle_url('/local/istikama_admin/ajax.php'))->out(false),
    'sesskey' => sesskey(),
    'search' => s($search),
    'roleoptions' => array_map(static function($id, $label) use ($roleid): array {
        return ['value' => $id, 'label' => s($label), 'selected' => (int)$id === (int)$roleid];
    }, array_keys($roleoptions), array_values($roleoptions)),
    'schooloptions' => array_map(static function($value, $label) use ($school): array {
        return ['value' => s($value), 'label' => s($label), 'selected' => (string)$value === (string)$school];
    }, array_keys($schooloptions), array_values($schooloptions)),
    'users' => $rows,
    'roleassignoptions' => array_map(static function($id, $label): array {
        return ['value' => $id, 'label' => s($label)];
    }, array_keys($roleoptions), array_values($roleoptions)),
    'exporturl' => (new moodle_url($baseurl, [
        'download' => 'csv',
        'roleid' => $roleid,
        'school' => $school,
        'search' => $search,
    ]))->out(false),
    'str_tab_all' => get_string('tab_all', 'local_istikama_admin'),
    'str_tab_students' => get_string('tab_students', 'local_istikama_admin'),
    'str_tab_teachers' => get_string('tab_teachers', 'local_istikama_admin'),
    'str_tab_parents' => get_string('tab_parents', 'local_istikama_admin'),
    'str_tab_managers' => get_string('tab_managers', 'local_istikama_admin'),
    'str_manage' => get_string('manage', 'local_istikama_admin'),
    'str_manage_assignment' => get_string('manage_assignment', 'local_istikama_admin'),
    'str_assign_school' => get_string('assign_school', 'local_istikama_admin'),
    'str_assign_level' => get_string('assign_level', 'local_istikama_admin'),
    'str_assign_class' => get_string('assign_class', 'local_istikama_admin'),
    'str_assign_subjects' => get_string('assign_subjects', 'local_istikama_admin'),
    'str_select_school' => get_string('select_school', 'local_istikama_admin'),
    'str_select_level' => get_string('select_level', 'local_istikama_admin'),
    'str_select_class' => get_string('select_class', 'local_istikama_admin'),
    'str_assignment_saved' => get_string('assignment_saved', 'local_istikama_admin'),
    'str_assignment_error' => get_string('assignment_error', 'local_istikama_admin'),
    'str_no_assignment' => get_string('no_assignment', 'local_istikama_admin'),
    'str_saving' => get_string('saving', 'local_istikama_admin'),
    'str_loading' => get_string('loading', 'local_istikama_admin'),
    'str_close' => get_string('close', 'local_istikama_admin'),
    'str_save_changes' => get_string('save_changes', 'local_istikama_admin'),
    'str_managed_schools' => get_string('managed_schools', 'local_istikama_admin'),
    'str_add_school_assignment' => get_string('add_school_assignment', 'local_istikama_admin'),
    'str_add_class_assignment' => get_string('add_class_assignment', 'local_istikama_admin'),
    'str_no_role_detected' => get_string('no_role_detected', 'local_istikama_admin'),
    'str_student_title' => get_string('student_assignment_title', 'local_istikama_admin'),
    'str_teacher_title' => get_string('teacher_assignment_title', 'local_istikama_admin'),
    'str_manager_title' => get_string('manager_assignment_title', 'local_istikama_admin'),
    'str_parent_title' => get_string('parent_assignment_title', 'local_istikama_admin'),
    'str_parent_search_students' => get_string('parent_search_students', 'local_istikama_admin'),
    'str_parent_linked_to_others' => get_string('parent_linked_to_others', 'local_istikama_admin'),
    'str_parent_no_students' => get_string('parent_no_students_available', 'local_istikama_admin'),
    'str_remove_assignment' => get_string('remove_assignment', 'local_istikama_admin'),
    'str_confirm_remove' => get_string('confirm_remove', 'local_istikama_admin'),
    'str_action_remove_role' => get_string('action_remove_role', 'local_istikama_admin'),
];

$PAGE->set_url($baseurl);
$PAGE->set_context($systemcontext);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('users_title', 'local_istikama_admin'));

require_once('admin_layout.php');

// Quick-actions bar: New user + Import students + Bulk Promotion.
$bulkurl    = (new moodle_url('/local/istikama_admin/promotions.php'))->out(false);
$newuserurl = (new moodle_url('/user/editadvanced.php', ['id' => -1, 'returnto' => 'istikama']))->out(false);
echo '<div style="display:flex; justify-content:flex-end; align-items:center; gap:10px; margin-bottom:16px; flex-wrap:wrap;">';
// Import students (opens modal; the modal + button visibility per-tab is handled in the template JS).
echo '<button type="button" id="istiImportStudentsBtn" class="isti-qa-btn isti-qa-btn-outline" style="display:none; align-items:center; gap:8px; background:#fff; color:#006bff; padding:9px 18px; border-radius:8px; border:1.5px solid #006bff; cursor:pointer; font-size:13px; font-weight:600;"><i class="fa fa-file-import"></i> ' .
    get_string('import_students', 'local_istikama_admin') . '</button>';
// Add new user.
echo '<a href="' . $newuserurl . '" class="isti-qa-btn" style="display:inline-flex; align-items:center; gap:8px; background:#006bff; color:white; padding:9px 18px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:600; box-shadow:0 2px 6px rgba(0,107,255,0.25);"><i class="fa fa-user-plus"></i> ' .
    get_string('add_new_user', 'local_istikama_admin') . '</a>';
// Bulk promotion.
echo '<a href="' . $bulkurl . '" class="isti-qa-btn" style="display:inline-flex; align-items:center; gap:8px; background:#fff; color:#006bff; padding:9px 18px; border-radius:8px; border:1.5px solid #006bff; text-decoration:none; font-size:13px; font-weight:600;"><i class="fa fa-graduation-cap"></i> ' .
    get_string('bulk_promotion_title', 'local_istikama_admin') . '</a>';
echo '</div>';

echo $OUTPUT->render_from_template('local_istikama_admin/users_management', $templatecontext);
echo $OUTPUT->paging_bar($totalusers, $page, $perpage, $baseurl);

// ── Student CSV import modal ────────────────────────────────────────────────
$importurl   = (new moodle_url('/local/istikama_admin/import_students.php'))->out(false);
$templateurl = (new moodle_url('/local/istikama_admin/import_students.php', ['action' => 'template']))->out(false);
$importsesskey = sesskey();
$fieldrefs = ['import_f_firstname','import_f_lastname','import_f_fathername','import_f_grandfather',
    'import_f_gender','import_f_dob','import_f_studentid','import_f_email','import_f_username',
    'import_f_password','import_f_status'];
$fieldlist = '';
foreach ($fieldrefs as $fr) {
    $fieldlist .= '<li>' . s(get_string($fr, 'local_istikama_admin')) . '</li>';
}
$g = static function (string $k): string { return s(get_string($k, 'local_istikama_admin')); };
$jsstrings = json_encode([
    'processing' => get_string('import_processing', 'local_istikama_admin'),
    'preview'    => get_string('import_preview_btn', 'local_istikama_admin'),
    'confirm'    => get_string('import_confirm_btn', 'local_istikama_admin'),
    'total'      => get_string('import_summary_total', 'local_istikama_admin'),
    'valid'      => get_string('import_summary_valid', 'local_istikama_admin'),
    'invalid'    => get_string('import_summary_invalid', 'local_istikama_admin'),
    'created'    => get_string('import_summary_created', 'local_istikama_admin'),
    'c_line'     => get_string('import_col_line', 'local_istikama_admin'),
    'c_name'     => get_string('import_col_name', 'local_istikama_admin'),
    'c_email'    => get_string('import_col_email', 'local_istikama_admin'),
    'c_status'   => get_string('import_col_status', 'local_istikama_admin'),
    'c_detail'   => get_string('import_col_detail', 'local_istikama_admin'),
    'fixerrors'  => get_string('import_fix_errors', 'local_istikama_admin'),
    'done'       => get_string('import_done', 'local_istikama_admin', '%N%'),
], JSON_UNESCAPED_UNICODE);

echo <<<HTML
<div class="isti-modal-overlay" id="istiImportModal" role="dialog" aria-modal="true" style="display:none">
  <div class="isti-modal isti-import-modal">
    <div class="isti-modal-header">
      <h5 style="margin:0;font-weight:700;color:#0f172a;font-size:1.05rem;display:flex;align-items:center;gap:10px">
        <span style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;background:#eff6ff;color:#006bff"><i class="fa fa-file-import"></i></span>
        {$g('import_students_title')}
      </h5>
      <button type="button" class="isti-import-close" aria-label="Close" style="background:transparent;border:0;color:#64748b;font-size:1.2rem;cursor:pointer;padding:6px 10px"><i class="fa fa-xmark"></i></button>
    </div>
    <div class="isti-modal-body">
      <!-- STEP 1: upload -->
      <div id="istiImportStep1">
        <p style="color:#475569;font-size:.9rem;line-height:1.6;margin:0 0 14px">{$g('import_intro')}</p>
        <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:14px 16px;margin-bottom:14px">
          <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;margin-bottom:8px">
            <strong style="color:#0f172a;font-size:.9rem"><i class="fa fa-table-list" style="color:#006bff;margin-inline-end:6px"></i>{$g('import_structure_title')}</strong>
            <a href="{$templateurl}" class="isti-qa-btn" style="display:inline-flex;align-items:center;gap:7px;background:#006bff;color:#fff;padding:7px 14px;border-radius:8px;text-decoration:none;font-size:12.5px;font-weight:600"><i class="fa fa-download"></i> {$g('import_download_template')}</a>
          </div>
          <p style="color:#64748b;font-size:.8rem;margin:0 0 8px">{$g('import_required_note')}</p>
          <ul style="columns:2;column-gap:24px;margin:0;padding-inline-start:18px;color:#475569;font-size:.8rem;line-height:1.7">{$fieldlist}</ul>
        </div>
        <div id="istiImportDrop" style="border:2px dashed #cbd5e1;border-radius:14px;padding:28px 18px;background:#f8fafc;text-align:center;cursor:pointer;transition:.15s">
          <i class="fa fa-cloud-arrow-up" style="font-size:2rem;color:#94a3b8;display:block;margin-bottom:8px"></i>
          <div style="color:#334155;font-weight:600;font-size:.95rem">{$g('import_dropzone_title')}</div>
          <div style="color:#94a3b8;font-size:.82rem;margin-top:2px">{$g('import_dropzone_sub')}</div>
          <input type="file" id="istiImportFile" accept=".csv,text/csv" style="position:absolute;width:1px;height:1px;opacity:0;overflow:hidden;clip:rect(0 0 0 0);pointer-events:none">
          <div id="istiImportFileName" style="display:none;margin-top:12px;color:#006bff;font-weight:600;font-size:.85rem"></div>
        </div>
      </div>
      <!-- STEP 2/3: results -->
      <div id="istiImportStep2" style="display:none">
        <div id="istiImportSummary" style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:14px"></div>
        <div id="istiImportNote" style="display:none;background:#fff7ed;border:1px solid #fed7aa;color:#9a3412;border-radius:10px;padding:10px 14px;font-size:.82rem;margin-bottom:12px"></div>
        <div class="isti-data-table" style="max-height:none"><div class="isti-data-table-scroll"><table id="istiImportTable"><thead></thead><tbody></tbody></table></div></div>
      </div>
    </div>
    <div class="isti-modal-footer">
      <button type="button" class="isti-import-close isti-btn isti-btn-outline">{$g('import_close')}</button>
      <button type="button" id="istiImportBack" class="isti-btn isti-btn-outline" style="display:none">{$g('import_back')}</button>
      <button type="button" id="istiImportPreviewBtn" class="isti-btn isti-btn-primary" disabled><i class="fa fa-circle-check"></i> {$g('import_preview_btn')}</button>
      <button type="button" id="istiImportConfirmBtn" class="isti-btn isti-btn-primary" style="display:none"><i class="fa fa-user-plus"></i> {$g('import_confirm_btn')}</button>
    </div>
  </div>
</div>
<style>
#istiImportModal .isti-import-modal{display:flex;flex-direction:column;max-height:92vh;overflow:hidden;width:min(840px,calc(100vw - 32px))}
#istiImportModal .isti-modal-body{flex:1 1 auto;min-height:0;overflow-y:auto;overflow-x:hidden}
#istiImportModal.isti-modal-visible,#istiImportModal[style*="flex"]{align-items:center;justify-content:center}
#istiImportDrop.isti-drag{border-color:#006bff;background:#eff6ff}
#istiImportTable td .isti-imp-pill{display:inline-flex;align-items:center;gap:5px;padding:3px 9px;border-radius:999px;font-size:.72rem;font-weight:700}
.isti-imp-ok{background:#dcfce7;color:#166534}.isti-imp-err{background:#fee2e2;color:#991b1b}.isti-imp-new{background:#dbeafe;color:#1e40af}
.isti-imp-kpi{flex:1;min-width:120px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:10px 14px}
.isti-imp-kpi b{display:block;font-size:1.4rem;color:#0f172a;line-height:1.1}
.isti-imp-kpi span{font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;color:#64748b;font-weight:600}
</style>
<script>
(function(){
  var S = {$jsstrings};
  var IMPORT_URL = "{$importurl}", SESS = "{$importsesskey}";
  var modal = document.getElementById('istiImportModal');
  var openBtn = document.getElementById('istiImportStudentsBtn');
  if(!modal) return;

  // Show the Import button only on the "all" and "students" tabs.
  function syncBtn(){
    var active = document.querySelector('.isti-tab.active');
    var t = active ? active.getAttribute('data-tab') : 'all';
    if(openBtn) openBtn.style.display = (t==='all'||t==='students') ? 'inline-flex' : 'none';
  }
  document.querySelectorAll('.isti-tab').forEach(function(tab){ tab.addEventListener('click', function(){ setTimeout(syncBtn,0); }); });
  syncBtn();

  var file=null;
  var drop=document.getElementById('istiImportDrop'),
      input=document.getElementById('istiImportFile'),
      fname=document.getElementById('istiImportFileName'),
      previewBtn=document.getElementById('istiImportPreviewBtn'),
      confirmBtn=document.getElementById('istiImportConfirmBtn'),
      backBtn=document.getElementById('istiImportBack'),
      step1=document.getElementById('istiImportStep1'),
      step2=document.getElementById('istiImportStep2');

  function show(){ modal.style.display='flex'; requestAnimationFrame(function(){modal.classList.add('isti-modal-visible');}); document.body.style.overflow='hidden'; }
  function hide(){ modal.classList.remove('isti-modal-visible'); document.body.style.overflow=''; setTimeout(function(){modal.style.display='none';},180); }
  function reset(){ file=null; input.value=''; fname.style.display='none'; previewBtn.disabled=true;
    confirmBtn.style.display='none'; backBtn.style.display='none'; previewBtn.style.display='inline-flex';
    step1.style.display='block'; step2.style.display='none'; }
  if(openBtn) openBtn.addEventListener('click', function(){ reset(); show(); });
  modal.querySelectorAll('.isti-import-close').forEach(function(b){ b.addEventListener('click', hide); });
  modal.addEventListener('click', function(e){ if(e.target===modal) hide(); });
  document.addEventListener('keydown', function(e){ if(e.key==='Escape' && modal.classList.contains('isti-modal-visible')) hide(); });

  function setFile(f){ if(!f) return; file=f; fname.textContent='📄 '+f.name; fname.style.display='block'; previewBtn.disabled=false; }
  drop.addEventListener('click', function(){ input.click(); });
  input.addEventListener('change', function(){ if(input.files[0]) setFile(input.files[0]); });
  ['dragenter','dragover'].forEach(function(ev){ drop.addEventListener(ev,function(e){ e.preventDefault(); drop.classList.add('isti-drag'); }); });
  ['dragleave','drop'].forEach(function(ev){ drop.addEventListener(ev,function(e){ e.preventDefault(); drop.classList.remove('isti-drag'); }); });
  drop.addEventListener('drop', function(e){ if(e.dataTransfer.files[0]) setFile(e.dataTransfer.files[0]); });

  function esc(s){ var d=document.createElement('div'); d.textContent=(s==null?'':String(s)); return d.innerHTML; }
  function pill(st){ if(st==='error') return '<span class="isti-imp-pill isti-imp-err"><i class="fa fa-xmark"></i></span>';
    if(st==='created') return '<span class="isti-imp-pill isti-imp-new"><i class="fa fa-user-plus"></i></span>';
    return '<span class="isti-imp-pill isti-imp-ok"><i class="fa fa-check"></i></span>'; }

  function renderResult(data, committed){
    step1.style.display='none'; step2.style.display='block';
    var sum=document.getElementById('istiImportSummary');
    sum.innerHTML =
      '<div class="isti-imp-kpi"><b>'+data.total+'</b><span>'+esc(S.total)+'</span></div>'+
      '<div class="isti-imp-kpi"><b style="color:#16a34a">'+data.valid+'</b><span>'+esc(S.valid)+'</span></div>'+
      '<div class="isti-imp-kpi"><b style="color:#dc2626">'+data.invalid+'</b><span>'+esc(S.invalid)+'</span></div>'+
      (committed?'<div class="isti-imp-kpi"><b style="color:#2563eb">'+data.created+'</b><span>'+esc(S.created)+'</span></div>':'');
    var note=document.getElementById('istiImportNote');
    if(!committed && data.invalid>0){ note.style.display='block'; note.textContent=S.fixerrors; } else { note.style.display='none'; }
    var thead=document.querySelector('#istiImportTable thead');
    thead.innerHTML='<tr><th>'+esc(S.c_line)+'</th><th>'+esc(S.c_name)+'</th><th>'+esc(S.c_email)+'</th><th>'+esc(S.c_status)+'</th><th>'+esc(S.c_detail)+'</th></tr>';
    var tb=document.querySelector('#istiImportTable tbody'); tb.innerHTML='';
    data.rows.forEach(function(r){
      var tr=document.createElement('tr');
      if(r.status==='error') tr.style.background='#fef2f2';
      tr.innerHTML='<td>'+r.line+'</td><td>'+esc(r.name)+'</td><td>'+esc(r.email)+'</td><td>'+pill(r.status)+'</td><td style="color:'+(r.status==='error'?'#b91c1c':'#475569')+';font-size:.82rem">'+esc(r.message)+'</td>';
      tb.appendChild(tr);
    });
    backBtn.style.display='inline-flex';
    if(committed){ confirmBtn.style.display='none'; previewBtn.style.display='none'; }
    else { previewBtn.style.display='none'; confirmBtn.style.display=(data.valid>0?'inline-flex':'none'); }
  }

  function send(dryrun, ondone){
    if(!file) return;
    var fd=new FormData(); fd.append('action','import'); fd.append('sesskey',SESS); fd.append('dryrun',dryrun?'1':'0'); fd.append('csvfile',file);
    var btn=dryrun?previewBtn:confirmBtn; var old=btn.innerHTML; btn.disabled=true; btn.innerHTML='<i class="fa fa-spinner fa-spin"></i> '+esc(S.processing);
    fetch(IMPORT_URL,{method:'POST',body:fd,credentials:'same-origin'}).then(function(r){return r.json();}).then(function(d){
      btn.disabled=false; btn.innerHTML=old;
      if(!d.ok){ alert(d.message||'Error'); return; }
      ondone(d);
    }).catch(function(){ btn.disabled=false; btn.innerHTML=old; alert('Network error'); });
  }
  previewBtn.addEventListener('click', function(){ send(true, function(d){ renderResult(d,false); }); });
  confirmBtn.addEventListener('click', function(){ send(false, function(d){ renderResult(d,true);
    setTimeout(function(){ window.location.reload(); }, 1800); }); });
  backBtn.addEventListener('click', function(){ step2.style.display='none'; step1.style.display='block'; backBtn.style.display='none'; confirmBtn.style.display='none'; previewBtn.style.display='inline-flex'; });
})();
</script>
HTML;

echo '</div></div>'; // end content and container from layout
echo $OUTPUT->footer();
