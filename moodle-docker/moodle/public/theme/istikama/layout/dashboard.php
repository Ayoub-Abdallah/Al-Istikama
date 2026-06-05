<?php
// Dashboard layout for Istikama theme.
// Renders the sidebar + topbar + main content wrapper for logged-in dashboard pages.

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/behat/lib.php');
require_once($CFG->dirroot . '/course/lib.php');

// Determine user tier.
$tier = 'none';
$userlevel = '';
if (isloggedin() && !isguestuser()) {
    require_once($CFG->dirroot . '/local/istikama_admin/locallib.php');
    $tier = local_istikama_admin_get_user_tier((int)$USER->id);

    // Determine student level (primary/middle/high) for UI adaptation.
    if ($tier === 'student') {
        global $DB;
        $rec = $DB->get_record('istikama_user_school', ['userid' => $USER->id, 'role' => 'student'], 'levelid', IGNORE_MULTIPLE);
        $level_catname = '';

        if ($rec && $rec->levelid) {
            $cat = $DB->get_record('course_categories', ['id' => $rec->levelid], 'name,parent');
            if ($cat) {
                $level_catname = $cat->name;
                // Also check parent category name for context (e.g. class → level → school).
                if ($cat->parent) {
                    $parent = $DB->get_record('course_categories', ['id' => $cat->parent], 'name');
                    if ($parent) { $level_catname .= ' ' . $parent->name; }
                }
            }
        }

        // Fallback: derive from enrolled course categories when levelid is empty.
        if ($level_catname === '') {
            $enrolled = enrol_get_users_courses((int)$USER->id, true, 'id,category');
            $checked  = [];
            foreach ($enrolled as $ecourse) {
                $cid = (int)$ecourse->category;
                if (isset($checked[$cid])) { continue; }
                $checked[$cid] = true;
                $ecat = $DB->get_record('course_categories', ['id' => $cid], 'id,name,parent');
                if (!$ecat) { continue; }
                $level_catname .= ' ' . $ecat->name;
                if ($ecat->parent) {
                    $ep = $DB->get_record('course_categories', ['id' => $ecat->parent], 'name');
                    if ($ep) { $level_catname .= ' ' . $ep->name; }
                }
            }
        }

        if ($level_catname !== '') {
            $ln = strtolower($level_catname);
            // Primary 1-5: English, French, Arabic, transliterated Arabic
            $primary_re = '/(primary\s*[1-5]|primary\s+level\s*[1-5]|primaire\s*[1-5]|'
                        . 'cm[1-2]|cp\b|ce[1-2]\b|'
                        . 'sana\s*(oula|thania|thalitha|rabi3a|khamissa)|'
                        . 'سنة\s*(أولى|ثانية|ثالثة|رابعة|خامسة)|'
                        . 'ابتدائي|تحضيري|أولى ابتدائي|'
                        . 'première|première\s+année)/ui';
            // Generic "primary" keyword also maps to primary (covers "Primary Level 1" etc.)
            $primary_generic = '/(^|\s)primary(\s|$)/i';
            if (preg_match($primary_re, $ln) || preg_match($primary_generic, $ln)) {
                $userlevel = 'primary';
            } elseif (preg_match('/(middle|متوسط|إعدادي|moyen|collège|secondary\s*[1-3])/i', $ln)) {
                $userlevel = 'middle';
            } elseif (preg_match('/(high|ثانوي|lycée|secondary|terminal)/i', $ln)) {
                $userlevel = 'high';
            }
        }
    }
}

// Build sidebar navigation items based on tier.
$sidebaritems = [];
$activepage = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '.php');
$activequery = $_SERVER['QUERY_STRING'] ?? '';

if ($tier === 'full_admin') {
    $sidebaritems = [
        ['icon' => 'fa-home', 'label' => get_string('menu_dashboard', 'local_istikama_admin'), 'url' => '/my/', 'key' => 'my'],
        ['icon' => 'fa-users', 'label' => get_string('menu_users', 'local_istikama_admin'), 'url' => '/local/istikama_admin/users.php', 'key' => 'users'],
        ['icon' => 'fa-folder-open', 'label' => get_string('menu_library', 'local_istikama_admin'), 'url' => '/local/istikama_admin/contentbank.php', 'key' => 'contentbank'],
        ['icon' => 'fa-school', 'label' => get_string('menu_schools', 'local_istikama_admin'), 'url' => '/local/istikama_admin/schools.php', 'key' => 'schools'],
        ['icon' => 'fa-chart-bar', 'label' => get_string('menu_reports', 'local_istikama_admin'), 'url' => '/local/istikama_admin/reports.php', 'key' => 'reports'],
        ['icon' => 'fa-bullhorn', 'label' => get_string('menu_ads', 'local_istikama_admin'), 'url' => '/local/istikama_admin/advertisements.php', 'key' => 'ads'],
        ['icon' => 'fa-shield-halved', 'label' => get_string('menu_support_admin', 'local_istikama_admin'), 'url' => '/local/istikama_admin/support_admin.php', 'key' => 'support_admin'],
        ['icon' => 'fa-cogs', 'label' => get_string('menu_siteadmin', 'local_istikama_admin'), 'url' => '/admin/', 'key' => 'admin'],
        ['icon' => 'fa-life-ring', 'label' => get_string('menu_support', 'local_istikama_admin'), 'url' => '/local/istikama_admin/support.php', 'key' => 'support'],
    ];
} elseif ($tier === 'school_manager') {
    $sidebaritems = [
        ['icon' => 'fa-home', 'label' => get_string('menu_dashboard', 'local_istikama_admin'), 'url' => '/my/', 'key' => 'my'],
        ['icon' => 'fa-users', 'label' => get_string('menu_users', 'local_istikama_admin'), 'url' => '/local/istikama_admin/school_users.php', 'key' => 'school_users'],
        ['icon' => 'fa-folder-open', 'label' => get_string('menu_library', 'local_istikama_admin'), 'url' => '/local/istikama_admin/contentbank.php', 'key' => 'contentbank'],
        ['icon' => 'fa-chart-bar', 'label' => get_string('menu_performance', 'local_istikama_admin'), 'url' => '/local/istikama_admin/reports.php', 'key' => 'reports'],
        ['icon' => 'fa-bell', 'label' => get_string('menu_notifications', 'local_istikama_admin'), 'url' => '/local/istikama_admin/school_notifications.php', 'key' => 'school_notifications'],
        ['icon' => 'fa-bullhorn', 'label' => get_string('menu_ads', 'local_istikama_admin'), 'url' => '/local/istikama_admin/advertisements.php', 'key' => 'ads'],
        ['icon' => 'fa-shield-halved', 'label' => get_string('menu_support_admin', 'local_istikama_admin'), 'url' => '/local/istikama_admin/support_admin.php', 'key' => 'support_admin'],
        ['icon' => 'fa-life-ring', 'label' => get_string('menu_support', 'local_istikama_admin'), 'url' => '/local/istikama_admin/support.php', 'key' => 'support'],
    ];
} elseif ($tier === 'technical_professor') {
    $sidebaritems = [
        ['icon' => 'fa-home', 'label' => get_string('menu_dashboard', 'local_istikama_admin'), 'url' => '/my/', 'key' => 'my'],
        ['icon' => 'fa-folder-open', 'label' => get_string('menu_library', 'local_istikama_admin'), 'url' => '/local/istikama_admin/contentbank.php', 'key' => 'contentbank'],
        ['icon' => 'fa-tasks', 'label' => get_string('menu_activities', 'local_istikama_admin'), 'url' => '/local/istikama_admin/activities.php', 'key' => 'activities'],
        ['icon' => 'fa-chart-bar', 'label' => get_string('menu_reports', 'local_istikama_admin'), 'url' => '/local/istikama_admin/reports.php', 'key' => 'reports'],
        ['icon' => 'fa-shield-halved', 'label' => get_string('menu_support_admin', 'local_istikama_admin'), 'url' => '/local/istikama_admin/support_admin.php', 'key' => 'support_admin'],
        ['icon' => 'fa-life-ring', 'label' => get_string('menu_support', 'local_istikama_admin'), 'url' => '/local/istikama_admin/support.php', 'key' => 'support'],
    ];
} elseif ($tier === 'teacher' || $tier === 'teacher_creator') {
    $sidebaritems = [
        ['icon' => 'fa-home', 'label' => get_string('menu_dashboard', 'local_istikama_admin'), 'url' => '/my/', 'key' => 'my'],
        ['icon' => 'fa-book-reader', 'label' => get_string('menu_class_library', 'local_istikama_admin'), 'url' => '/local/istikama_admin/teacher.php?section=classlibrary', 'key' => 'classlibrary'],
        ['icon' => 'fa-folder-open', 'label' => get_string('menu_library', 'local_istikama_admin'), 'url' => '/local/istikama_admin/teacher.php?section=library', 'key' => 'library'],
        ['icon' => 'fa-chalkboard', 'label' => get_string('menu_classes', 'local_istikama_admin'), 'url' => '/local/istikama_admin/teacher.php?section=classes', 'key' => 'classes'],
    ];
    if ($tier === 'teacher_creator') {
        $sidebaritems[] = ['icon' => 'fa-folder-open', 'label' => get_string('menu_library', 'local_istikama_admin'), 'url' => '/local/istikama_admin/contentbank.php', 'key' => 'contentbank'];
        $sidebaritems[] = ['icon' => 'fa-chart-bar', 'label' => get_string('menu_reports', 'local_istikama_admin'), 'url' => '/local/istikama_admin/reports.php', 'key' => 'reports'];
    }
    // All teachers get Support — they previously didn't.
    $sidebaritems[] = ['icon' => 'fa-life-ring', 'label' => get_string('menu_support', 'local_istikama_admin'), 'url' => '/local/istikama_admin/support.php', 'key' => 'support'];
} elseif ($tier === 'parent') {
    $sidebaritems = [
        ['icon' => 'fa-home', 'label' => get_string('menu_dashboard', 'local_istikama_admin'), 'url' => '/my/', 'key' => 'my'],
        ['icon' => 'fa-child', 'label' => get_string('menu_children', 'local_istikama_admin'), 'url' => '/local/istikama_admin/parent.php', 'key' => 'parent'],
        ['icon' => 'fa-life-ring', 'label' => get_string('menu_support', 'local_istikama_admin'), 'url' => '/local/istikama_admin/support.php', 'key' => 'support'],
    ];
} elseif ($tier === 'student') {
    $sidebaritems = [
        ['icon' => 'fa-home',        'label' => get_string('menu_dashboard',  'local_istikama_admin'), 'url' => '/my/',                   'key' => 'my'],
        ['icon' => 'fa-book-open',   'label' => get_string('menu_my_lessons', 'local_istikama_admin'), 'url' => '/my/courses.php',        'key' => 'courses'],
        ['icon' => 'fa-chart-line',  'label' => get_string('menu_my_report',  'local_istikama_admin'), 'url' => '/local/istikama_admin/reports.php', 'key' => 'reports'],
        ['icon' => 'fa-life-ring',   'label' => get_string('menu_support',    'local_istikama_admin'), 'url' => '/local/istikama_admin/support.php', 'key' => 'support'],
    ];
}

// Determine active sidebar item.
$currentlocalurl = $PAGE->url->out_as_local_url();
foreach ($sidebaritems as &$item) {
    $itempage = basename(parse_url($item['url'], PHP_URL_PATH), '.php');
    $itemquery = parse_url($item['url'], PHP_URL_QUERY) ?? '';
    $item['active'] = false;

    // Special handling: Settings (/admin/) should match any /admin/* URL.
    if ($item['key'] === 'admin') {
        $item['active'] = strpos($currentlocalurl, '/admin/') === 0;
    } elseif ($activepage === $itempage) {
        if (empty($itemquery)) {
            $item['active'] = true;
        } else {
            // Check if query params match.
            parse_str($itemquery, $itemparams);
            parse_str($activequery, $activeparams);
            $match = true;
            foreach ($itemparams as $k => $v) {
                if (!isset($activeparams[$k]) || $activeparams[$k] !== $v) {
                    $match = false;
                    break;
                }
            }
            $item['active'] = $match;
        }
    }
}
unset($item);

// User info for topbar.
$userfullname = fullname($USER);
$userrole = '';
switch ($tier) {
    case 'full_admin': $userrole = get_string('dash_role_admin', 'local_istikama_admin'); break;
    case 'school_manager': $userrole = get_string('dash_role_school_manager', 'local_istikama_admin'); break;
    case 'technical_professor': $userrole = get_string('dash_role_technical_professor', 'local_istikama_admin'); break;
    case 'teacher_creator': $userrole = get_string('dash_role_teacher_creator', 'local_istikama_admin'); break;
    case 'teacher': $userrole = get_string('dash_role_teacher', 'local_istikama_admin'); break;
    case 'student': $userrole = get_string('dash_role_student', 'local_istikama_admin'); break;
    case 'parent': $userrole = get_string('dash_role_parent', 'local_istikama_admin'); break;
    default: $userrole = ''; break;
}

// Get user picture URL.
$userpicture = $OUTPUT->user_picture($USER, ['size' => 80, 'link' => false, 'class' => '']);
// Extract src from the img tag.
preg_match('/src="([^"]+)"/', $userpicture, $matches);
$useravatarurl = $matches[1] ?? '';

// ── Sidebar brand logo ──
// Admins, super admins and technical professors ALWAYS keep the static platform
// logo. Teachers, students and school managers get their own school's logo (or
// the school name as a fallback when no logo is set).
$schoolname = format_string($SITE->shortname, true);

// The platform mark (site compact logo).
$schoollogourl = '';
if (method_exists($OUTPUT, 'get_compact_logo_url')) {
    $logourl = $OUTPUT->get_compact_logo_url();
    if ($logourl) {
        $schoollogourl = $logourl->out(false);
    }
}

$platformlogoroles = ['full_admin', 'technical_professor'];
$isplatformlogo = in_array($tier, $platformlogoroles, true);

$schoolbrandname = $schoolname;
$schoolbrandlogo = '';
if ($isplatformlogo) {
    // Keep the platform logo + site name for platform-wide roles.
    $schoolbrandlogo = $schoollogourl;
    $schoolbrandname = $schoolname;
} else if (isloggedin() && !isguestuser()) {
    global $DB;
    $schrow = $DB->get_record_sql(
        "SELECT us.schoolid, cc.name
           FROM {istikama_user_school} us
           JOIN {course_categories} cc ON cc.id = us.schoolid
          WHERE us.userid = ? AND us.schoolid IS NOT NULL
       ORDER BY us.id DESC",
        [(int)$USER->id], IGNORE_MULTIPLE);
    if ($schrow) {
        $schoolbrandname = format_string($schrow->name);
        if (class_exists('\local_istikama_admin\school_manager')) {
            $logo = \local_istikama_admin\school_manager::get_school_logo_url((int)$schrow->schoolid);
            if (!empty($logo)) { $schoolbrandlogo = $logo; }
        }
    }
}
$schoolbrandinitial = function_exists('mb_substr')
    ? mb_strtoupper(mb_substr(trim($schoolbrandname) !== '' ? trim($schoolbrandname) : 'I', 0, 1, 'UTF-8'), 'UTF-8')
    : strtoupper(substr(trim($schoolbrandname) ?: 'I', 0, 1));

// ── Moodle Core Navigation (mirrors Boost drawers.php) ──
// Secondary navigation (admin tabs) — only show on actual admin pages.
$secondarynavigation = false;
$overflow = '';
$isadminpage = strpos($PAGE->url->out_as_local_url(), '/admin/') === 0;
if ($isadminpage && $PAGE->has_secondary_navigation()) {
    $tablistnav = $PAGE->has_tablist_secondary_navigation();
    $moremenu = new \core\navigation\output\more_menu($PAGE->secondarynav, 'nav-tabs', true, $tablistnav);
    $secondarynavigation = $moremenu->export_for_template($OUTPUT);
    $overflowdata = $PAGE->secondarynav->get_overflow_menu_data();
    if (!is_null($overflowdata)) {
        $overflow = $overflowdata->export_for_template($OUTPUT);
    }
}

// Primary navigation (user menu, lang menu, mobile nav).
$primary = new core\navigation\output\primary($PAGE);
$renderer = $PAGE->get_renderer('core');
$primarymenu = $primary->export_for_template($renderer);

// Region main settings menu.
$buildregionmainsettings = !$PAGE->include_region_main_settings_in_header_actions()
    && !$PAGE->has_secondary_navigation();
$regionmainsettingsmenu = $buildregionmainsettings ? $OUTPUT->region_main_settings_menu() : false;

// Activity header.
$header = $PAGE->activityheader;
$headercontent = $header->export_for_template($renderer);

// Boost standard parts (keep the footer, JS, etc.)
$bodyattributes = $OUTPUT->body_attributes([
    'istikama-dashboard',
    'istikama-tier-' . str_replace('_', '-', $tier),
]);

// Dashboard-specific data: hero section + stats.
$isdashboard = ($PAGE->pagelayout === 'mydashboard');
$userfirstname = explode(' ', $userfullname)[0];

// Dashboard stats for admin users.
$dashboardstats = [];
$recentschools = [];
if ($isdashboard && ($tier === 'full_admin' || $tier === 'school_manager' || $tier === 'technical_professor')) {
    global $DB;
    $totalusers = $DB->count_records_select('user', 'deleted = 0 AND suspended = 0') - 1; // exclude guest
    $totalcourses = $DB->count_records('course') - 1; // exclude frontpage
    $thirtyago = time() - (30 * 24 * 60 * 60);
    $activeusers = $DB->count_records_select('user', 'deleted = 0 AND suspended = 0 AND lastaccess > ?', [$thirtyago]);
    $totalschools = count(core_course_category::top()->get_children());
    
    // Count students and teachers
    $sql_students = "SELECT COUNT(DISTINCT userid) FROM {role_assignments} ra JOIN {role} r ON ra.roleid = r.id WHERE r.shortname = 'student'";
    $totalstudents = $DB->count_records_sql($sql_students);
    $sql_teachers = "SELECT COUNT(DISTINCT userid) FROM {role_assignments} ra JOIN {role} r ON ra.roleid = r.id WHERE r.shortname LIKE '%teacher%' OR r.shortname = 'editingteacher'";
    $totalteachers = $DB->count_records_sql($sql_teachers);

    $dashboardstats = [
        ['icon' => 'fa-university', 'value' => $totalschools, 'label' => get_string('dash_total_schools', 'local_istikama_admin'), 'colorclass' => 'blue'],
        ['icon' => 'fa-users', 'value' => $totalusers, 'label' => get_string('dash_total_users', 'local_istikama_admin'), 'colorclass' => 'blue'],
        ['icon' => 'fa-user-graduate', 'value' => $totalstudents, 'label' => get_string('dash_active_students', 'local_istikama_admin'), 'colorclass' => 'blue'],
        ['icon' => 'fa-chalkboard-teacher', 'value' => $totalteachers, 'label' => get_string('dash_active_teachers', 'local_istikama_admin'), 'colorclass' => 'blue'],
    ];

    // Recent Schools
    require_once($CFG->dirroot . '/local/istikama_admin/locallib.php');
    if (class_exists('\local_istikama_admin\school_manager')) {
        $schools = \local_istikama_admin\school_manager::get_hierarchy();
        $i = 0;
        foreach ($schools as $school) {
            if ($i++ >= 5) break;
            $info = $school['info'] ?? null;
            $logourl = \local_istikama_admin\school_manager::get_school_logo_url($school['id']);
            $recentschools[] = [
                'id' => $school['id'],
                'name' => format_string($school['name']),
                'students' => rand(50, 500), // mock
                'teachers' => rand(10, 50), // mock
                'courses' => rand(20, 100), // mock
                'status' => get_string('dash_status_active', 'local_istikama_admin'),
                'lastupdate' => userdate(time() - rand(0, 86400*5)),
                'logourl' => $logourl
            ];
        }
    }
}

// Block regions.
$addblockbutton = '';
$blockshtml = '';
$hasblocks = false;

$templatecontext = [
    'sitename' => $schoolname,
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes,
    'tier' => $tier,
    'userlevel' => $userlevel,
    'sidebaritems' => $sidebaritems,
    'userfullname' => $userfullname,
    'userfirstname' => $userfirstname,
    'userrole' => $userrole,
    'useravatarurl' => $useravatarurl,
    'schoolname' => $schoolname,
    'schoollogourl' => $schoollogourl,
    'schoolbrandname' => $schoolbrandname,
    'schoolbrandlogo' => $schoolbrandlogo,
    'schoolbrandinitial' => $schoolbrandinitial,
    'isplatformlogo' => $isplatformlogo,
    'logouturl' => (new moodle_url('/login/logout.php', ['sesskey' => sesskey()]))->out(false),
    'profileurl' => (new moodle_url('/user/profile.php'))->out(false),
    'dashboardurl' => (new moodle_url('/my/'))->out(false),
    'isloggedin' => isloggedin() && !isguestuser(),
    'isdashboard' => $isdashboard,
    // Moodle core navigation context.
    'usermenu' => $primarymenu['user'],
    'langmenu' => $primarymenu['lang'],
    'primarymoremenu' => $primarymenu['moremenu'],
    'mobileprimarynav' => $primarymenu['mobileprimarynav'],
    'secondarymoremenu' => $secondarynavigation ?: false,
    'overflow' => $overflow,
    'headercontent' => $headercontent,
    'regionmainsettingsmenu' => $regionmainsettingsmenu,
    'hasregionmainsettingsmenu' => !empty($regionmainsettingsmenu),
    // Dashboard hero + stats.
    'dashboardstats' => $dashboardstats,
    'hasdashboardstats' => !empty($dashboardstats),
    'recentschools' => $recentschools,
    'hasrecentschools' => !empty($recentschools),
    // Block region.
    'addblockbutton' => $addblockbutton,
    'blockshtml' => $blockshtml,
    'hasblocks' => $hasblocks,
];

echo $OUTPUT->render_from_template('theme_istikama/dashboard_layout', $templatecontext);
