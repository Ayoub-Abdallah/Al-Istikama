<?php
// This file is part of Moodle - http://moodle.org/

defined('MOODLE_INTERNAL') || die();

/**
 * Check whether user should get custom Istikama admin experience.
 *
 * @param int|null $userid User id, defaults to current user.
 * @return bool
 */
function local_istikama_admin_is_target_user(?int $userid = null): bool {
    global $DB, $USER;

    $userid = $userid ?? (int)$USER->id;
    if (!$userid || isguestuser($userid)) {
        return false;
    }

    $systemcontext = context_system::instance();
    if (has_capability('moodle/site:config', $systemcontext, $userid)) {
        return true;
    }

    if (has_capability('local/istikama_admin:viewnavbar', $systemcontext, $userid)) {
        return true;
    }

    $shortnames = [
        'technicalprofessor',
        'technical_professor',
        'technicalprof',
        'technical_teacher',
    ];

    [$insql, $params] = $DB->get_in_or_equal($shortnames, SQL_PARAMS_NAMED);
    $params['userid'] = $userid;
    $params['contextsystem'] = CONTEXT_SYSTEM;

    $sql = "SELECT 1
              FROM {role_assignments} ra
              JOIN {context} cx ON cx.id = ra.contextid
              JOIN {role} r ON r.id = ra.roleid
             WHERE ra.userid = :userid
               AND cx.contextlevel = :contextsystem
               AND r.shortname {$insql}";

    return $DB->record_exists_sql($sql, $params);
}

/**
 * Require target user and capability.
 *
 * @param string $capability
 * @return void
 */
function local_istikama_admin_require_access(string $capability): void {
    $systemcontext = context_system::instance();
    require_capability($capability, $systemcontext);

    if (!local_istikama_admin_is_target_user()) {
        throw new required_capability_exception($systemcontext, $capability, 'nopermissions', '');
    }
}

/**
 * Get school profile field id if present.
 *
 * @return int
 */
function local_istikama_admin_get_school_fieldid(): int {
    global $DB;

    return (int)$DB->get_field('user_info_field', 'id', ['shortname' => 'school']);
}

/**
 * Require strict site admin access (main admin + administrators list only).
 *
 * @return void
 */
function local_istikama_admin_require_site_admin(): void {
    $systemcontext = context_system::instance();
    require_capability('moodle/site:config', $systemcontext);

    if (!is_siteadmin()) {
        throw new required_capability_exception($systemcontext, 'moodle/site:config', 'nopermissions', '');
    }
}

/**
 * Apply page-level cleanup for admin settings links on Istikama pages only.
 *
 * @param moodle_page $page
 * @return void
 */
function local_istikama_admin_apply_admin_page_cleanup(moodle_page $page): void {
    $page->add_body_class('istikama-admin-clean-nav');
    $page->requires->css(new moodle_url('/local/istikama_admin/styles/istikama_admin.css'));

    $categoriesjson = json_encode([
        'general',
        'users',
        'courses',
        'grades',
        'plugins',
        'appearance',
        'server',
        'reports',
        'development',
    ]);

    $page->requires->js_init_code("(function(){\n"
        . "  if (!document.body || !document.body.classList.contains('istikama-admin-clean-nav')) { return; }\n"
        . "  var categories = " . $categoriesjson . ";\n"
        . "  var labels = [\n"
        . "    'general','users','courses','grades','plugins','appearance','server','reports','development',\n"
        . "    'عام','المستخدمون','المقررات','الدرجات','الإضافات','المظهر','الخادم','التقارير','التطوير'\n"
        . "  ];\n"
        . "  var hiddenAnchors = 0;\n"
        . "  function hideAnchor(anchor){\n"
        . "    if (!anchor || anchor.dataset.istikamaHidden === '1') { return; }\n"
        . "    anchor.dataset.istikamaHidden = '1';\n"
        . "    anchor.classList.add('istikama-hidden-link');\n"
        . "    var container = anchor.closest('li, .nav-item, .list-group-item');\n"
        . "    if (container) { container.classList.add('istikama-hidden-item'); }\n"
        . "    hiddenAnchors++;\n"
        . "  }\n"
        . "  function normalizeText(text){\n"
        . "    return (text || '').replace(/\\s+/g, ' ').trim().toLowerCase();\n"
        . "  }\n"
        . "  function shouldHideByHref(anchor){\n"
        . "    var href = (anchor.getAttribute('href') || '').toLowerCase();\n"
        . "    if (!href) { return false; }\n"
        . "    return categories.some(function(category){\n"
        . "      return href.indexOf('category=' + category) !== -1;\n"
        . "    });\n"
        . "  }\n"
        . "  function shouldHideByLabel(anchor){\n"
        . "    var txt = normalizeText(anchor.textContent);\n"
        . "    return labels.indexOf(txt) !== -1;\n"
        . "  }\n"
        . "  var roots = document.querySelectorAll('#settingsnav, .block_settings, .adminsettings, .settingsform, .secondary-navigation, .primary-navigation, .tertiary-navigation, .nav-tabs, .list-group');\n"
        . "  roots.forEach(function(root){\n"
        . "    root.querySelectorAll('a').forEach(function(anchor){\n"
        . "      if (shouldHideByHref(anchor) || shouldHideByLabel(anchor)) {\n"
        . "        hideAnchor(anchor);\n"
        . "      }\n"
        . "    });\n"
        . "  });\n"
        . "  if (hiddenAnchors === 0) { return; }\n"
        . "  roots.forEach(function(root){\n"
        . "    root.querySelectorAll('.istikama-hidden-item').forEach(function(el){\n"
        . "      el.style.display = 'none';\n"
        . "    });\n"
        . "    root.querySelectorAll('ul, ol, .list-group').forEach(function(list){\n"
        . "      var visibleItems = Array.from(list.querySelectorAll(':scope > li, :scope > .nav-item, :scope > .list-group-item')).filter(function(el){\n"
        . "        return window.getComputedStyle(el).display !== 'none' && !el.classList.contains('istikama-hidden-item');\n"
        . "      });\n"
        . "      if (visibleItems.length === 0) {\n"
        . "        list.style.display = 'none';\n"
        . "      }\n"
        . "    });\n"
        . "    root.querySelectorAll('.separator, hr, .dropdown-divider, .divider').forEach(function(sep) {\n"
        . "       sep.style.display = 'none';\n"
        . "    });\n"
        . "    var visibleLinks = Array.from(root.querySelectorAll('a')).filter(function(a){\n"
        . "      return window.getComputedStyle(a).display !== 'none' && !a.classList.contains('istikama-hidden-link');\n"
        . "    });\n"
        . "    if (visibleLinks.length === 0) {\n"
        . "      root.classList.add('istikama-empty-settings-root');\n"
        . "      var block = root.closest('.block, .card, .adminsettings, .settingsform, #region-pre');\n"
        . "      if (block) { block.classList.add('istikama-empty-settings-block'); }\n"
        . "    }\n"
        . "  });\n"
        . "  var regionPre = document.querySelector('#region-pre');\n"
        . "  if (regionPre) {\n"
        . "    var remainingLinks = Array.from(regionPre.querySelectorAll('a')).filter(function(a){\n"
        . "      return window.getComputedStyle(a).display !== 'none';\n"
        . "    });\n"
        . "    if (remainingLinks.length === 0) {\n"
        . "      document.body.classList.add('istikama-settings-empty');\n"
        . "    }\n"
        . "  }\n"
        . "})();");
}

/**
 * Determine the tier of the user in the Istikama system.
 * Returns: 'full_admin', 'school_manager', 'teacher_creator', 'teacher', or 'none'.
 *
 * @param int|null $userid
 * @return string
 */
function local_istikama_admin_get_user_tier(?int $userid = null): string {
    global $DB, $USER;
    $userid = $userid ?? (int)($USER->id ?? 0);
    if (!$userid || isguestuser($userid)) {
        return 'none';
    }

    $systemcontext = \context_system::instance();
    if (is_siteadmin($userid) || has_capability('moodle/site:config', $systemcontext, $userid)) {
        return 'full_admin';
    }

    // Role in istikama_user_school
    $records = $DB->get_records('istikama_user_school', ['userid' => $userid], '', 'role');
    if ($records) {
        if (array_key_exists('manager', $records)) {
            return 'school_manager';
        }
    }
    
    // Check school info admin_userid
    if ($DB->record_exists('istikama_school_info', ['admin_userid' => $userid])) {
        return 'school_manager';
    }

    // Is a technical professor (platform-wide content manager)?
    $tp_shortnames = [
        'technicalprofessor',
        'technical_professor',
        'technicalprof',
        'technical_teacher',
    ];
    list($tpinsql, $tpparams) = $DB->get_in_or_equal($tp_shortnames, SQL_PARAMS_NAMED, 'tp');
    $tpparams['tp_userid'] = $userid;
    $tpparams['tp_ctx'] = CONTEXT_SYSTEM;
    $tpsql = "SELECT 1
              FROM {role_assignments} ra
              JOIN {context} cx ON cx.id = ra.contextid
              JOIN {role} r ON r.id = ra.roleid
             WHERE ra.userid = :tp_userid
               AND cx.contextlevel = :tp_ctx
               AND r.shortname {$tpinsql}";
    if ($DB->record_exists_sql($tpsql, $tpparams)) {
        return 'technical_professor';
    }

    // Is a course creator system-wide?
    $cc_shortnames = ['coursecreator'];
    list($ccinsql, $ccparams) = $DB->get_in_or_equal($cc_shortnames, SQL_PARAMS_NAMED, 'cc');
    $ccparams['cc_userid'] = $userid;
    $ccparams['cc_ctx'] = CONTEXT_SYSTEM;
    $ccsql = "SELECT 1
              FROM {role_assignments} ra
              JOIN {context} cx ON cx.id = ra.contextid
              JOIN {role} r ON r.id = ra.roleid
             WHERE ra.userid = :cc_userid
               AND cx.contextlevel = :cc_ctx
               AND r.shortname {$ccinsql}";
    if ($DB->record_exists_sql($ccsql, $ccparams)) {
        return 'teacher_creator';
    }

    // In istikama_user_school as a teacher?
    if ($records && array_key_exists('teacher', $records)) {
        return 'teacher';
    }

    // In istikama_user_school as a student?
    if ($records && array_key_exists('student', $records)) {
        return 'student';
    }

    // Fallback capability
    if (has_capability('local/istikama_admin:viewnavbar', $systemcontext, $userid)) {
        return 'teacher_creator';
    }

    // Parent check
    if ($DB->record_exists('istikama_parent_child', ['parentid' => $userid])) {
        return 'parent';
    }

    return 'none';
}

/**
 * Get manager's assigned school ID.
 *
 * @param int|null $userid
 * @return int
 */
function local_istikama_admin_get_manager_school(?int $userid = null): int {
    global $DB, $USER;
    $userid = $userid ?? (int)($USER->id ?? 0);

    $recinfo = $DB->get_record('istikama_school_info', ['admin_userid' => $userid], 'categoryid', IGNORE_MULTIPLE);
    if ($recinfo) {
        return (int)$recinfo->categoryid;
    }

    $rec = $DB->get_record('istikama_user_school', ['userid' => $userid, 'role' => 'manager'], 'schoolid', IGNORE_MULTIPLE);
    if ($rec) {
        return (int)$rec->schoolid;
    }

    return 0;
}

/**
 * Require full admin access.
 */
function local_istikama_admin_require_full_admin(): void {
    if (local_istikama_admin_get_user_tier() !== 'full_admin') {
        throw new \required_capability_exception(\context_system::instance(), 'moodle/site:config', 'nopermissions', '');
    }
}

/**
 * Require school manager or full admin access.
 */
function local_istikama_admin_require_school_manager(): void {
    $tier = local_istikama_admin_get_user_tier();
    if ($tier !== 'school_manager' && $tier !== 'full_admin') {
        throw new \required_capability_exception(\context_system::instance(), 'moodle/site:config', 'nopermissions', '');
    }
}

/**
 * Require teacher or higher access. Explicitly blocks students, parents, and guests.
 * Allowed tiers: teacher, teacher_creator, technical_professor, school_manager, full_admin.
 */
function local_istikama_admin_require_teacher(): void {
    $allowed = ['teacher', 'teacher_creator', 'technical_professor', 'school_manager', 'full_admin'];
    if (!in_array(local_istikama_admin_get_user_tier(), $allowed, true)) {
        throw new \moodle_exception('nopermissions', 'error', '', 'Require teacher or higher access.');
    }
}

/**
 * Require a staff-level target user (anyone who manages content / users).
 * Explicitly EXCLUDES students and parents — those are end-users, not admins.
 *
 * Allowed tiers: teacher, teacher_creator, technical_professor, school_manager, full_admin.
 */
function local_istikama_admin_require_target_user(): void {
    $allowed = ['teacher', 'teacher_creator', 'technical_professor', 'school_manager', 'full_admin'];
    if (!in_array(local_istikama_admin_get_user_tier(), $allowed, true)) {
        throw new \moodle_exception('nopermissions', 'error', '', 'Staff access required.');
    }
}

/**
 * Require strictly student tier access.
 */
function local_istikama_admin_require_student(): void {
    $tier = local_istikama_admin_get_user_tier();
    if ($tier !== 'student') {
        throw new \moodle_exception('nopermissions', 'error', '', 'Unauthorized access. Student view only.');
    }
}

/**
 * Setup common page options.
 *
 * @param \moodle_page $page
 * @param \moodle_url $url
 * @param string $title
 * @param \context|null $context
 */
function local_istikama_admin_setup_page(\moodle_page $page, \moodle_url $url, string $title, ?\context $context = null): void {
    if (!$context) {
        $context = \context_system::instance();
    }
    $page->set_context($context);
    $page->set_url($url);
    $page->set_pagelayout('admin');
    $page->set_title($title);
    $page->set_heading($title);
}

/**
 * Print standard header for Istikama custom pages.
 *
 * @param string $title
 */
function local_istikama_admin_print_header(string $title = ''): void {
    global $PAGE, $OUTPUT, $CFG;
    if ($title) {
        $PAGE->set_heading($title);
    }
    require(__DIR__ . '/admin_layout.php');
}

/**
 * Print standard footer for Istikama custom pages.
 */
function local_istikama_admin_print_footer(): void {
    global $OUTPUT;
    echo '</div></div>';
    echo $OUTPUT->footer();
}

/**
 * Return teacher's primary school ID.
 */
function local_istikama_admin_get_teacher_school(?int $userid = null): int {
    global $DB, $USER;
    $userid = $userid ?? (int)($USER->id ?? 0);
    $rec = $DB->get_record('istikama_user_school', ['userid' => $userid, 'role' => 'teacher'], 'schoolid', IGNORE_MULTIPLE);
    return $rec ? (int)$rec->schoolid : 0;
}

/**
 * Return detailed assignments for teacher.
 */
function local_istikama_admin_get_teacher_assignments(?int $userid = null): array {
    global $DB, $USER;
    $userid = $userid ?? (int)($USER->id ?? 0);
    
    $assignments = $DB->get_records('istikama_user_school', ['userid' => $userid, 'role' => 'teacher']);
    $result = [];
    foreach ($assignments as $a) {
        if (!$a->classid) continue;
        
        $obj = new \stdClass();
        $obj->id = $a->id;
        $obj->classid = $a->classid;
        $obj->schoolid = $a->schoolid;
        
        $class = $DB->get_record('course_categories', ['id' => $a->classid]);
        $obj->classname = $class ? $class->name : '';
        
        if ($a->levelid) {
            $level = $DB->get_record('course_categories', ['id' => $a->levelid]);
            $obj->levelname = $level ? $level->name : '';
        }
        if ($a->schoolid) {
            $school = $DB->get_record('course_categories', ['id' => $a->schoolid]);
            $obj->schoolname = $school ? $school->name : '';
        }
        
        $subjects = $DB->get_records('istikama_teacher_subject', ['assignmentid' => $a->id], '', 'subject');
        $obj->subjects = array_keys($subjects);
        $result[$a->id] = $obj;
    }
    return $result;
}

/**
 * Returns array of class IDs the teacher teaches.
 */
function local_istikama_admin_get_teacher_classes(?int $userid = null): array {
    $assignments = local_istikama_admin_get_teacher_assignments($userid);
    $classes = [];
    foreach ($assignments as $a) {
        if (!in_array($a->classid, $classes)) {
            $classes[] = $a->classid;
        }
    }
    return $classes;
}

/**
 * Get subjects a teacher teaches in a given class.
 */
function local_istikama_admin_get_teacher_class_subjects(int $classid, ?int $userid = null): array {
    $assignments = local_istikama_admin_get_teacher_assignments($userid);
    foreach ($assignments as $a) {
        if ($a->classid == $classid) {
            return $a->subjects;
        }
    }
    return [];
}

/**
 * Check if teacher has access to a specific class.
 */
function local_istikama_admin_teacher_has_class(int $classid, ?int $userid = null): bool {
    $classes = local_istikama_admin_get_teacher_classes($userid);
    return in_array((int)$classid, $classes);
}

/**
 * Enroll user in a subject course.
 */
function local_istikama_admin_enroll_user_in_subject(int $userid, int $courseid, string $roleshortname = 'student'): void {
    global $DB;
    $course = $DB->get_record('course', ['id' => $courseid]);
    if (!$course) {
        return;
    }

    $enrol = enrol_get_plugin('manual');
    if (!$enrol) {
        return;
    }

    $instance = $DB->get_record('enrol', ['courseid' => $course->id, 'enrol' => 'manual']);
    if (!$instance) {
        $enrolid = $enrol->add_default_instance($course);
        $instance = $DB->get_record('enrol', ['id' => $enrolid]);
    }
    if (!$instance) {
        return;
    }

    // Suppress the welcome email so message_send() is never called during enrollment.
    // Without this, the welcome message exception ("Message was not sent.") propagates
    // through allow_commit() and breaks the AJAX response even when the DB commit succeeded.
    if ((int)$instance->customint1 !== 0) {
        $instance->customint1 = 0; // ENROL_DO_NOT_SEND_EMAIL
        $DB->update_record('enrol', $instance);
    }

    $role = $DB->get_record('role', ['shortname' => $roleshortname]);
    if ($role) {
        $enrol->enrol_user($instance, $userid, $role->id);
    }
}

/**
 * Unenroll user from a subject course.
 */
function local_istikama_admin_unenroll_user_from_subject(int $userid, int $courseid): void {
    global $DB;
    $enrol = enrol_get_plugin('manual');
    if (!$enrol) {
        return;
    }
    $instances = $DB->get_records('enrol', ['courseid' => $courseid, 'enrol' => 'manual']);
    foreach ($instances as $instance) {
        $enrol->unenrol_user($instance, $userid);
    }
}

/**
 * Enroll user in every course that belongs to a given class category.
 * Safe to call inside a DB transaction — welcome emails are suppressed.
 */
function local_istikama_admin_enroll_user_in_class(int $userid, int $classid, string $roleshortname = 'student'): void {
    try {
        $cat     = core_course_category::get($classid, IGNORE_MISSING);
        if (!$cat) {
            return;
        }
        $courses = $cat->get_courses(['recursive' => false]);
        foreach ($courses as $c) {
            local_istikama_admin_enroll_user_in_subject($userid, $c->id, $roleshortname);
        }
    } catch (\Throwable $e) {
        // Non-fatal — enrollment failures must not block the assignment save.
        debugging('istikama enroll_user_in_class failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
    }
}

/**
 * Unenroll user from every course that belongs to a given class category.
 */
function local_istikama_admin_unenroll_user_from_class(int $userid, int $classid): void {
    try {
        $cat = core_course_category::get($classid, IGNORE_MISSING);
        if (!$cat) {
            return;
        }
        foreach ($cat->get_courses(['recursive' => false]) as $c) {
            local_istikama_admin_unenroll_user_from_subject($userid, $c->id);
        }
    } catch (\Throwable $e) {
        debugging('istikama unenroll_user_from_class failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
    }
}

/**
 * Check whether a course category (by id) is a descendant of the school root category.
 */
function local_istikama_admin_category_belongs_to_school(int $categoryid, int $schoolid): bool {
    if ($categoryid <= 0 || $schoolid <= 0) {
        return false;
    }
    try {
        $cat = core_course_category::get($categoryid, IGNORE_MISSING);
        if (!$cat) {
            return false;
        }
        // Walk the path up to the root looking for schoolid.
        $path = explode('/', trim($cat->path, '/'));
        return in_array((string)$schoolid, $path, true);
    } catch (\Throwable $e) {
        return false;
    }
}

/**
 * Check whether a user has any assignment record for the given school.
 */
function local_istikama_admin_user_belongs_to_school(int $userid, int $schoolid): bool {
    global $DB;
    return $DB->record_exists('istikama_user_school', ['userid' => $userid, 'schoolid' => $schoolid]);
}

/**
 * Enroll all class students in a subject course.
 */
function local_istikama_admin_enroll_class_students_in_subject(int $classid, int $courseid): void {
    global $DB;
    $students = $DB->get_records('istikama_user_school', ['classid' => $classid, 'role' => 'student']);
    foreach ($students as $stu) {
        local_istikama_admin_enroll_user_in_subject($stu->userid, $courseid, 'student');
    }
}

/**
 * Get all students in a given class.
 *
 * @param int $classid
 * @return array
 */
function local_istikama_admin_get_class_students(int $classid): array {
    global $DB;
    $sql = "SELECT u.* 
            FROM {user} u
            JOIN {istikama_user_school} us ON us.userid = u.id
            WHERE us.classid = :classid AND us.role = 'student' AND u.deleted = 0
            ORDER BY u.firstname, u.lastname";
    return $DB->get_records_sql($sql, ['classid' => $classid]);
}

/**
 * Require parent tier access.
 */
function local_istikama_admin_require_parent(): void {
    $tier = local_istikama_admin_get_user_tier();
    if ($tier !== 'parent' && $tier !== 'full_admin') {
        throw new \moodle_exception('nopermissions', 'error', '', 'Parent access required.');
    }
}

/**
 * Verify that a parent user owns a specific child.
 *
 * @param int $parentid
 * @param int $childid
 * @return bool
 */
function local_istikama_admin_parent_owns_child(int $parentid, int $childid): bool {
    global $DB;
    return $DB->record_exists('istikama_parent_child', ['parentid' => $parentid, 'childid' => $childid]);
}

/**
 * Get all children linked to a parent.
 *
 * @param int|null $parentid defaults to current user
 * @return array of user objects with school/class info
 */
function local_istikama_admin_get_parent_children(?int $parentid = null): array {
    global $DB, $USER;
    $parentid = $parentid ?? (int)($USER->id ?? 0);

    $sql = "SELECT u.id, u.firstname, u.lastname, u.email, u.picture, u.firstnamephonetic,
                   u.lastnamephonetic, u.middlename, u.alternatename, u.imagealt, u.lastaccess,
                   us.schoolid, us.levelid, us.classid
              FROM {istikama_parent_child} pc
              JOIN {user} u ON u.id = pc.childid AND u.deleted = 0
         LEFT JOIN {istikama_user_school} us ON us.userid = u.id AND us.role = 'student'
             WHERE pc.parentid = :parentid
          ORDER BY u.firstname, u.lastname";
    $children = $DB->get_records_sql($sql, ['parentid' => $parentid]);

    // Enrich with category names.
    foreach ($children as $child) {
        $child->schoolname = '';
        $child->levelname = '';
        $child->classname = '';
        if (!empty($child->schoolid)) {
            $cat = $DB->get_record('course_categories', ['id' => $child->schoolid], 'name');
            if ($cat) $child->schoolname = $cat->name;
        }
        if (!empty($child->levelid)) {
            $cat = $DB->get_record('course_categories', ['id' => $child->levelid], 'name');
            if ($cat) $child->levelname = $cat->name;
        }
        if (!empty($child->classid)) {
            $cat = $DB->get_record('course_categories', ['id' => $child->classid], 'name');
            if ($cat) $child->classname = $cat->name;
        }
    }
    return $children;
}

/**
 * Ensures a teacher is natively enrolled in the central Istikama Question Bank course
 * so they can bypass the "Cannot enroll yourself" error and manage reusable questions.
 *
 * @param int $userid The user ID of the teacher.
 */
function local_istikama_admin_ensure_qbank_access(int $userid): void {
    global $DB;
    
    // 1. Get the central Question Bank course
    $qbcourse = $DB->get_record('course', ['shortname' => 'ISTIKAMA_QBANK'], 'id', IGNORE_MULTIPLE);
    if (!$qbcourse) {
        return; // Course doesn't exist yet, setup_questionbank.php hasn't run.
    }
    
    $coursectx = context_course::instance($qbcourse->id);
    
    // 2. Get the manual enrol instance
    $enrol_manual = enrol_get_plugin('manual');
    $enrolinstance = $DB->get_record('enrol', [
        'courseid' => $qbcourse->id,
        'enrol'    => 'manual',
        'status'   => ENROL_INSTANCE_ENABLED,
    ], '*', IGNORE_MULTIPLE);
    
    if (!$enrolinstance) {
        $enrolid = $enrol_manual->add_instance((object)['id' => $qbcourse->id]);
        $enrolinstance = $DB->get_record('enrol', ['id' => $enrolid]);
    }
    
    // 3. Get the standard non-editing teacher role (to prevent them from deleting categories)
    $roleid = $DB->get_field('role', 'id', ['shortname' => 'teacher']);
    if (!$roleid) {
        return;
    }
    
    // 4. Enroll the user
    $isenrolled = $DB->record_exists('user_enrolments', [
        'userid'  => $userid,
        'enrolid' => $enrolinstance->id,
    ]);
    
    if (!$isenrolled) {
        $enrol_manual->enrol_user($enrolinstance, $userid, $roleid);
    }
    
    // 5. Explicitly assign the role in the course context just to be safe
    if (!$DB->record_exists('role_assignments', [
        'userid'    => $userid,
        'roleid'    => $roleid,
        'contextid' => $coursectx->id,
    ])) {
        role_assign($roleid, $userid, $coursectx->id);
    }
}

// ═══════════════════════════════════════════════════════════════════════════
// Academic Seasons — global helpers
// ═══════════════════════════════════════════════════════════════════════════

/**
 * Get the active season record, or null.
 * Cached per-request to avoid hitting the DB on every write/read.
 *
 * @return \stdClass|null
 */
function local_istikama_admin_get_active_season(): ?\stdClass {
    static $cache = null;
    static $fetched = false;
    if (!$fetched) {
        $fetched = true;
        $cache = \local_istikama_admin\season_manager::get_active();
    }
    return $cache;
}

/**
 * Get the active season id (0 if none).
 *
 * Use this everywhere data is written that should be season-scoped.
 *
 * @return int
 */
function local_istikama_admin_get_active_season_id(): int {
    $s = local_istikama_admin_get_active_season();
    return $s ? (int)$s->id : 0;
}

/**
 * Throw an exception if writes are blocked for the given season
 * (status = archived or closed). Pass 0 to check the currently-active
 * season (which is never write-blocked, so this is a no-op then).
 *
 * Callers in attendance/assessment/etc. write paths must invoke this
 * to enforce the closed-season immutability guarantee.
 *
 * @param int $seasonid
 * @throws \moodle_exception
 */
function local_istikama_admin_guard_season_writes(int $seasonid): void {
    if ($seasonid <= 0) {
        return;
    }
    if (\local_istikama_admin\season_manager::is_write_blocked($seasonid)) {
        throw new \moodle_exception('season_immutable', 'local_istikama_admin');
    }
}

/**
 * Resolve the seasonid to use for a NEW write.
 *
 * Returns the active season's id, or 0 if none is set. When 0 is
 * returned the caller may either fail (preferred) or write
 * un-stamped data (back-compat path) — that's a per-call decision.
 *
 * @return int
 */
function local_istikama_admin_resolve_write_seasonid(): int {
    return local_istikama_admin_get_active_season_id();
}

/**
 * Resolve which season a read should be scoped to.
 *
 * Reads season selection from the request (?view_season=N) first, falling
 * back to the user preference, then the active season, then 0 (all).
 *
 *   0    — no filter, show data from every season (legacy + all)
 *   N>0  — filter strictly to season N (NULL rows are EXCLUDED)
 *   -1   — legacy / NULL seasonid rows only
 *
 * @return int
 */
function local_istikama_admin_resolve_view_seasonid(): int {
    static $resolved = null;
    if ($resolved !== null) {
        return $resolved;
    }
    $param = optional_param('view_season', PHP_INT_MIN, PARAM_INT);
    if ($param !== PHP_INT_MIN) {
        if ($param > 0 || $param === -1 || $param === 0) {
            set_user_preference('local_istikama_admin_view_seasonid', (string)$param);
            $resolved = (int)$param;
            return $resolved;
        }
    }
    $pref = get_user_preferences('local_istikama_admin_view_seasonid', null);
    if ($pref !== null && $pref !== '') {
        $resolved = (int)$pref;
        return $resolved;
    }
    $resolved = local_istikama_admin_get_active_season_id();
    return $resolved;
}

/**
 * Returns the set of global level IDs enabled for a school.
 *
 * Default behavior (no rows in istikama_school_level for this school):
 * all globally-defined levels are considered enabled (back-compat).
 * Once any row exists for the school, only explicitly-enabled levels
 * are returned.
 *
 * @param int $schoolid
 * @return int[] Set of istikama_global_level.id values
 */
function local_istikama_admin_get_school_enabled_level_ids(int $schoolid): array {
    global $DB;
    if ($schoolid <= 0) {
        return [];
    }
    $rows = $DB->get_records('istikama_school_level', ['schoolid' => $schoolid]);
    if (empty($rows)) {
        // Back-compat: no explicit mapping yet -> all levels.
        return array_keys($DB->get_records_menu('istikama_global_level', null, 'order_index ASC', 'id, id AS x'));
    }
    $enabled = [];
    foreach ($rows as $r) {
        if ((int)$r->enabled === 1) {
            $enabled[] = (int)$r->global_level_id;
        }
    }
    return $enabled;
}

/**
 * Build a SQL fragment + params for season-scoped reads against any
 * istikama table that has a `seasonid` column.
 *
 * Usage:
 *   [$swhere, $sparams] = local_istikama_admin_season_where_sql($sid, 'us', 'sw');
 *   $sql = "SELECT ... FROM {istikama_user_school} us WHERE us.role = 'student' $swhere";
 *   $DB->get_records_sql($sql, array_merge($baseparams, $sparams));
 *
 * Semantics:
 *   $seasonid =  0  -> no filter (empty fragment)
 *   $seasonid >  0  -> "AND alias.seasonid = :param"      (excludes legacy NULL rows)
 *   $seasonid = -1  -> "AND alias.seasonid IS NULL"       (legacy only)
 *
 * @param int $seasonid
 * @param string $alias Table alias (no trailing dot). Empty = unqualified column.
 * @param string $paramname Named-param key.
 * @return array{0:string,1:array}
 */
function local_istikama_admin_season_where_sql(int $seasonid, string $alias = '', string $paramname = 'seasonid'): array {
    $prefix = $alias === '' ? '' : ($alias . '.');
    if ($seasonid === 0) {
        return ['', []];
    }
    if ($seasonid === -1) {
        return [" AND {$prefix}seasonid IS NULL ", []];
    }
    return [" AND {$prefix}seasonid = :{$paramname} ", [$paramname => $seasonid]];
}

// ═══════════════════════════════════════════════════════════════════════════
// Content Bank — Extended Status & Moderation System
// ═══════════════════════════════════════════════════════════════════════════

/**
 * Returns the full content status registry.
 *
 * Each status maps to a language string key, badge colors, an icon, and
 * whether it is a "terminal" state (no further automatic transitions).
 *
 * @return array keyed by status slug
 */
function local_istikama_admin_get_content_statuses(): array {
    return [
        'draft' => [
            'label'    => get_string('cb_status_draft', 'local_istikama_admin'),
            'badge_bg' => '#f1f5f9', 'badge_fg' => '#475569',
            'icon'     => 'fa-pencil-alt',
            'group'    => 'preparation',
        ],
        'pending' => [
            'label'    => get_string('cb_status_pending', 'local_istikama_admin'),
            'badge_bg' => '#fef3c7', 'badge_fg' => '#92400e',
            'icon'     => 'fa-clock',
            'group'    => 'review',
        ],
        'under_study' => [
            'label'    => get_string('cb_status_under_study', 'local_istikama_admin'),
            'badge_bg' => '#dbeafe', 'badge_fg' => '#1e40af',
            'icon'     => 'fa-search',
            'group'    => 'review',
        ],
        'needs_revision' => [
            'label'    => get_string('cb_status_needs_revision', 'local_istikama_admin'),
            'badge_bg' => '#ffedd5', 'badge_fg' => '#9a3412',
            'icon'     => 'fa-edit',
            'group'    => 'review',
        ],
        'needs_metadata' => [
            'label'    => get_string('cb_status_needs_metadata', 'local_istikama_admin'),
            'badge_bg' => '#fce7f3', 'badge_fg' => '#9d174d',
            'icon'     => 'fa-tags',
            'group'    => 'review',
        ],
        'technical_review' => [
            'label'    => get_string('cb_status_technical_review', 'local_istikama_admin'),
            'badge_bg' => '#e0e7ff', 'badge_fg' => '#3730a3',
            'icon'     => 'fa-cogs',
            'group'    => 'review',
        ],
        'teacher_suggested' => [
            'label'    => get_string('cb_status_teacher_suggested', 'local_istikama_admin'),
            'badge_bg' => '#ecfccb', 'badge_fg' => '#3f6212',
            'icon'     => 'fa-lightbulb',
            'group'    => 'review',
        ],
        'approved' => [
            'label'    => get_string('cb_status_approved', 'local_istikama_admin'),
            'badge_bg' => '#d1fae5', 'badge_fg' => '#065f46',
            'icon'     => 'fa-check-circle',
            'group'    => 'active',
        ],
        'published' => [
            'label'    => get_string('cb_status_published', 'local_istikama_admin'),
            'badge_bg' => '#d1fae5', 'badge_fg' => '#047857',
            'icon'     => 'fa-globe',
            'group'    => 'active',
        ],
        'rejected' => [
            'label'    => get_string('cb_status_rejected', 'local_istikama_admin'),
            'badge_bg' => '#fee2e2', 'badge_fg' => '#991b1b',
            'icon'     => 'fa-times-circle',
            'group'    => 'terminal',
        ],
        'archived' => [
            'label'    => get_string('cb_status_archived', 'local_istikama_admin'),
            'badge_bg' => '#f1f5f9', 'badge_fg' => '#64748b',
            'icon'     => 'fa-archive',
            'group'    => 'terminal',
        ],
        'restricted' => [
            'label'    => get_string('cb_status_restricted', 'local_istikama_admin'),
            'badge_bg' => '#fef9c3', 'badge_fg' => '#854d0e',
            'icon'     => 'fa-lock',
            'group'    => 'active',
        ],
        'deprecated' => [
            'label'    => get_string('cb_status_deprecated', 'local_istikama_admin'),
            'badge_bg' => '#e2e8f0', 'badge_fg' => '#475569',
            'icon'     => 'fa-ban',
            'group'    => 'terminal',
        ],
    ];
}

/**
 * Change the status of a content bank item, recording an audit trail.
 *
 * @param int    $contentid  The content bank record ID.
 * @param string $newstatus  The new status slug.
 * @param string $notes      Optional moderation notes.
 * @throws \moodle_exception on invalid status or missing content.
 */
function local_istikama_admin_change_content_status(int $contentid, string $newstatus, string $notes = ''): void {
    global $DB, $USER;

    $statuses = local_istikama_admin_get_content_statuses();
    if (!isset($statuses[$newstatus])) {
        throw new \moodle_exception('invalid_status', 'local_istikama_admin');
    }

    $content = $DB->get_record('istikama_content_bank', ['id' => $contentid], 'id, status', MUST_EXIST);
    $oldstatus = $content->status;

    // Update the content record.
    $DB->update_record('istikama_content_bank', (object)[
        'id'           => $contentid,
        'status'       => $newstatus,
        'approved_by'  => $USER->id,
        'timemodified' => time(),
    ]);

    // If rejecting, store notes as reject_reason too.
    if ($newstatus === 'rejected' && $notes !== '') {
        $DB->set_field('istikama_content_bank', 'reject_reason', $notes, ['id' => $contentid]);
    }

    // Write audit trail.
    $DB->insert_record('istikama_content_status_history', (object)[
        'content_id'  => $contentid,
        'old_status'  => $oldstatus,
        'new_status'  => $newstatus,
        'changed_by'  => $USER->id,
        'notes'       => $notes,
        'timecreated' => time(),
    ]);
}

/**
 * Gate any platform action behind the existence of an active season.
 *
 * Call this at the top of any page/handler that creates or mutates
 * season-scoped data (attendance, assessments, teacher activities, etc).
 * Site admins bypass the gate so they can recover the system.
 *
 * @throws \moodle_exception
 */
function local_istikama_admin_require_active_season(): void {
    if (is_siteadmin()) {
        return;
    }
    if (!\local_istikama_admin\season_manager::has_active()) {
        throw new \moodle_exception('no_active_season_blocked', 'local_istikama_admin');
    }
}

/**
 * Soft check — returns the active season id (0 if none).
 * For display gating (show banner / disable buttons) rather than hard block.
 */
function local_istikama_admin_active_season_id(): int {
    return \local_istikama_admin\season_manager::get_active_id();
}


/**
 * Definitions for the Istikama student custom profile fields.
 *
 * Returned as shortname => [name, datatype, extra params]. Used both by the
 * upgrade step that creates them and by the student CSV importer.
 *
 * @return array
 */
function local_istikama_admin_student_profile_fields(): array {
    return [
        'istikamastudentid'    => ['name' => 'Student ID',         'datatype' => 'text'],
        'istikamafathername'   => ['name' => "Father's name",      'datatype' => 'text'],
        'istikamagrandfather'  => ['name' => "Grandfather's name", 'datatype' => 'text'],
        'istikamagender'       => ['name' => 'Gender',             'datatype' => 'menu', 'param1' => "Male\nFemale"],
        'istikamadob'          => ['name' => 'Date of birth',      'datatype' => 'text', 'help' => 'Format: dd/mm/yyyy'],
    ];
}

/**
 * Idempotently create the Istikama student custom profile fields and their
 * category. Safe to call repeatedly (only creates what is missing).
 *
 * @return void
 */
function local_istikama_admin_ensure_student_profile_fields(): void {
    global $DB;

    // Ensure a dedicated profile-field category exists.
    $catname = 'Istikama student details';
    $catid = $DB->get_field('user_info_category', 'id', ['name' => $catname]);
    if (!$catid) {
        $maxsort = (int)$DB->get_field_sql('SELECT MAX(sortorder) FROM {user_info_category}');
        $cat = (object)['name' => $catname, 'sortorder' => $maxsort + 1];
        $catid = $DB->insert_record('user_info_category', $cat);
    }

    $sort = (int)$DB->get_field_sql('SELECT MAX(sortorder) FROM {user_info_field} WHERE categoryid = ?', [$catid]);
    foreach (local_istikama_admin_student_profile_fields() as $shortname => $def) {
        if ($DB->record_exists('user_info_field', ['shortname' => $shortname])) {
            continue;
        }
        $sort++;
        $field = (object)[
            'shortname'          => $shortname,
            'name'               => $def['name'],
            'datatype'           => $def['datatype'],
            'description'        => $def['help'] ?? '',
            'descriptionformat'  => FORMAT_HTML,
            'categoryid'         => $catid,
            'sortorder'          => $sort,
            'required'           => 0,
            'locked'             => 0,
            'visible'            => 1,   // Visible to the user and to staff with viewalldetails.
            'forceunique'        => 0,
            'signup'             => 0,
            'defaultdata'        => '',
            'defaultdataformat'  => FORMAT_HTML,
            'param1'             => $def['param1'] ?? ($def['datatype'] === 'text' ? '30' : ''),
            'param2'             => $def['datatype'] === 'text' ? '2048' : '',
            'param3'             => $def['datatype'] === 'text' ? '0' : '',
            'param4'             => '',
            'param5'             => '',
        ];
        $DB->insert_record('user_info_field', $field);
    }
}
