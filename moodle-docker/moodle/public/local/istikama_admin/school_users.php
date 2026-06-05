<?php
/**
 * School Manager - Users Management Page
 * Scoped to a single school. No school filter, no managers tab,
 * no technical professors in teachers list.
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');
require_once($CFG->libdir . '/accesslib.php');

require_login();
local_istikama_admin_require_school_manager();

$schoolid = local_istikama_admin_get_manager_school();
if (!$schoolid) {
    throw new \moodle_exception('sm_no_school_assigned', 'local_istikama_admin');
}

// Get school info for display.
try {
    $schoolcat = core_course_category::get($schoolid);
    $schoolname = format_string($schoolcat->name);
} catch (\Exception $e) {
    throw new \moodle_exception('sm_no_school_assigned', 'local_istikama_admin');
}

$systemcontext = context_system::instance();
$baseurl = new moodle_url('/local/istikama_admin/school_users.php');

$search = optional_param('search', '', PARAM_TEXT);
$page = optional_param('page', 0, PARAM_INT);
$perpage = optional_param('perpage', 25, PARAM_INT);
$perpage = max(10, min($perpage, 100));
$action = optional_param('action', '', PARAM_ALPHA);

// Bulk assign action (restricted to manager's school users).
if ($action === 'bulkassign' && confirm_sesskey()) {
    $selected = optional_param_array('selectedusers', [], PARAM_INT);
    $newroleid = optional_param('newroleid', 0, PARAM_INT);

    if ($newroleid && !empty($selected)) {
        foreach ($selected as $userid) {
            // Verify user belongs to this school.
            if (!local_istikama_admin_user_belongs_to_school($userid, $schoolid)) {
                continue;
            }
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
    $selected = optional_param_array('selectedusers', [], PARAM_INT);
    $oldroleid = optional_param('newroleid', 0, PARAM_INT);

    if ($oldroleid && !empty($selected)) {
        foreach ($selected as $userid) {
            if (!local_istikama_admin_user_belongs_to_school($userid, $schoolid)) {
                continue;
            }
            role_unassign($oldroleid, $userid, $systemcontext->id);
        }
        redirect($baseurl, get_string('changessaved'));
    }
}

// Build role options (only student/teacher relevant roles — no manager-level roles).
$allowed_role_shortnames = ['student', 'teacher', 'editingteacher'];
[$rinsql, $rinparams] = $DB->get_in_or_equal($allowed_role_shortnames, SQL_PARAMS_NAMED);
$roles = $DB->get_records_select('role', "shortname $rinsql", $rinparams, 'sortorder ASC', 'id,shortname,name');
$roleoptions = [0 => get_string('all')];
foreach ($roles as $role) {
    $roleoptions[(int)$role->id] = role_get_name($role, $systemcontext);
}

$roleid = optional_param('roleid', 0, PARAM_INT);

// Query users — always filtered to this school, never show technical professors or school managers.
$where = ['u.deleted = 0', 'u.confirmed = 1'];
$params = [];

// Always filter to school.
$where[] = "EXISTS (
    SELECT 1
      FROM {istikama_user_school} us
     WHERE us.userid = u.id
       AND us.schoolid = :schoolfilter
)";
$params['schoolfilter'] = $schoolid;

// Exclude technical professors and school managers from user list.
$excluded_roles = ['technicalprofessor', 'technical_professor', 'technicalprof', 'technical_teacher', 'schoolmanager'];
[$exinsql, $exparams] = $DB->get_in_or_equal($excluded_roles, SQL_PARAMS_NAMED, 'ex');
$where[] = "NOT EXISTS (
    SELECT 1
      FROM {role_assignments} raex
      JOIN {context} cxex ON cxex.id = raex.contextid
      JOIN {role} rex ON rex.id = raex.roleid
     WHERE raex.userid = u.id
       AND cxex.contextlevel = :excontextlevel
       AND rex.shortname {$exinsql}
)";
$params['excontextlevel'] = CONTEXT_SYSTEM;
$params = array_merge($params, $exparams);

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

// Helper to detect role type (student/teacher only for school manager scope).
function _sm_detect_role_type(array $shortnames): string {
    $teacher_roles = ['teacher', 'editingteacher'];
    $student_roles = ['student'];
    $parent_roles = ['parent'];

    foreach ($shortnames as $sn) {
        if (in_array($sn, $teacher_roles)) return 'teacher';
    }
    foreach ($shortnames as $sn) {
        if (in_array($sn, $student_roles)) return 'student';
    }
    foreach ($shortnames as $sn) {
        if (in_array($sn, $parent_roles)) return 'parent';
    }
    return 'none';
}

$rows = [];
foreach ($users as $user) {
    $userid = (int)$user->id;
    $userroletype = _sm_detect_role_type($roleshortbyuser[$userid] ?? []);
    $rows[] = [
        'id' => $userid,
        'name' => fullname($user),
        'email' => s($user->email),
        'role' => s(implode(', ', $rolesbyuser[$userid] ?? [])),
        'role_type' => $userroletype,
        'school' => s($schoolname),
        'lastlogin' => !empty($user->lastaccess) ? userdate($user->lastaccess) : '-',
        'editurl' => (new moodle_url('/user/editadvanced.php', ['id' => $userid]))->out(false),
        'viewurl' => (new moodle_url('/user/profile.php', ['id' => $userid]))->out(false),
        'deleteurl' => (new moodle_url('/admin/user.php', [
            'delete' => $userid,
            'sesskey' => sesskey(),
        ]))->out(false),
    ];
}

// CSV export.
$download = optional_param('download', '', PARAM_ALPHA);
$selectedforcsv = optional_param_array('selectedusers', [], PARAM_INT);
if ($download === 'csv') {
    if (!empty($selectedforcsv)) {
        $rows = array_values(array_filter($rows, static function(array $row) use ($selectedforcsv): bool {
            return in_array((int)$row['id'], $selectedforcsv, true);
        }));
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="school_users_export.csv"');
    $out = fopen('php://output', 'w');
    fputcsv($out, [
        get_string('name', 'local_istikama_admin'),
        get_string('email', 'local_istikama_admin'),
        get_string('role', 'local_istikama_admin'),
        get_string('school', 'local_istikama_admin'),
        get_string('lastlogin', 'local_istikama_admin'),
    ]);
    foreach ($rows as $row) {
        fputcsv($out, [$row['name'], $row['email'], $row['role'], $row['school'], $row['lastlogin']]);
    }
    fclose($out);
    exit;
}

$templatecontext = [
    'baseurl' => $baseurl->out(false),
    'ajaxurl' => (new moodle_url('/local/istikama_admin/ajax.php'))->out(false),
    'sesskey' => sesskey(),
    'search' => s($search),
    'is_school_manager' => true,
    'manager_schoolid' => $schoolid,
    'manager_schoolname' => s($schoolname),
    'roleoptions' => array_map(static function($id, $label) use ($roleid): array {
        return ['value' => $id, 'label' => s($label), 'selected' => (int)$id === (int)$roleid];
    }, array_keys($roleoptions), array_values($roleoptions)),
    // No school options for school managers.
    'schooloptions' => [],
    'users' => $rows,
    'roleassignoptions' => array_map(static function($id, $label): array {
        return ['value' => $id, 'label' => s($label)];
    }, array_keys($roleoptions), array_values($roleoptions)),
    'exporturl' => (new moodle_url($baseurl, [
        'download' => 'csv',
        'roleid' => $roleid,
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
$PAGE->set_title(get_string('school_users_title', 'local_istikama_admin'));

require_once('admin_layout.php');

// Quick-actions bar: Bulk Promotion.
$bulkurl = (new moodle_url('/local/istikama_admin/promotions.php'))->out(false);
echo '<div style="display:flex; justify-content:flex-end; gap:8px; margin-bottom:16px;">';
echo '<a href="' . $bulkurl . '" style="display:inline-flex; align-items:center; gap:8px; background:#006bff; color:white; padding:9px 18px; border-radius:8px; text-decoration:none; font-size:13px; font-weight:600; box-shadow:0 2px 6px rgba(0,107,255,0.25);"><i class="fa fa-graduation-cap"></i> ' .
    get_string('bulk_promotion_title', 'local_istikama_admin') . '</a>';
echo '</div>';

echo $OUTPUT->render_from_template('local_istikama_admin/users_management', $templatecontext);
echo $OUTPUT->paging_bar($totalusers, $page, $perpage, $baseurl);

echo '</div></div>'; // end content and container from layout
echo '<div style="margin-top:30px;padding-top:20px;border-top:1px solid #dee2e6;">';
echo '<p style="text-align:center;color:#6c757d;">' . s($schoolname) . ' &copy; ' . date('Y') . '</p>';
echo '</div>';
echo $OUTPUT->footer();
