<?php
/**
 * Permission-aware global search endpoint for the Istikama top-nav search box.
 *
 * GET ?q=term → JSON { ok, results: [ {category, label, sublabel, url, icon} ] }
 *
 * Results are scoped to what the current user is allowed to reach:
 *   - Pages / features: a per-tier catalogue (students never see admin pages).
 *   - Users: only for admin / school manager / technical professor.
 *   - Courses: only courses the user can access.
 *   - Site administration entries: only for full admins.
 */

define('AJAX_SCRIPT', true);
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/locallib.php');

require_login();
$context = context_system::instance();
header('Content-Type: application/json; charset=utf-8');

$q = trim(optional_param('q', '', PARAM_TEXT));
$tier = local_istikama_admin_get_user_tier((int)$USER->id);

$respond = static function (array $results): void {
    echo json_encode(['ok' => true, 'results' => array_values($results)], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
};

if (core_text::strlen($q) < 2) {
    $respond([]);
}
$needle = core_text::strtolower($q);
$match = static function (string $hay) use ($needle): bool {
    return mb_stripos($hay, $needle) !== false;
};
$str = static function (string $key): string {
    return get_string($key, 'local_istikama_admin');
};

$results = [];
$cap = 12;

// ── 1. Pages / features catalogue (per tier) ────────────────────────────────
$pages = [];
$add = static function (&$pages, $label, $url, $icon, $sub) {
    $pages[] = ['category' => 'pages', 'label' => $label, 'sublabel' => $sub, 'url' => $url, 'icon' => $icon];
};

$catpage = $str('search_cat_pages');
// Common to every authenticated user.
$add($pages, $str('menu_dashboard'), '/my/', 'fa-home', $catpage);
$add($pages, $str('menu_support'), '/local/istikama_admin/support.php', 'fa-life-ring', $catpage);

if (in_array($tier, ['full_admin', 'school_manager', 'technical_professor', 'teacher_creator'], true)) {
    $add($pages, $str('menu_reports'), '/local/istikama_admin/reports.php', 'fa-chart-bar', $catpage);
    $add($pages, $str('menu_contentbank'), '/local/istikama_admin/contentbank.php', 'fa-folder-open', $catpage);
}
if (in_array($tier, ['full_admin', 'school_manager'], true)) {
    $add($pages, $str('menu_users'), '/local/istikama_admin/users.php', 'fa-users', $catpage);
    $add($pages, $str('menu_ads'), '/local/istikama_admin/advertisements.php', 'fa-bullhorn', $catpage);
    $add($pages, $str('menu_support_admin'), '/local/istikama_admin/support_admin.php', 'fa-shield-halved', $catpage);
    $add($pages, $str('bulk_promotion_title'), '/local/istikama_admin/promotions.php', 'fa-graduation-cap', $catpage);
}
if ($tier === 'full_admin') {
    $add($pages, $str('menu_schools'), '/local/istikama_admin/schools.php', 'fa-school', $catpage);
    $add($pages, $str('add_new_user'), '/user/editadvanced.php?id=-1&returnto=istikama', 'fa-user-plus', $catpage);
    $add($pages, $str('import_students'), '/local/istikama_admin/users.php', 'fa-file-import', $catpage);
    $add($pages, $str('menu_siteadmin'), '/admin/search.php', 'fa-cogs', $catpage);
}
if ($tier === 'student') {
    $add($pages, $str('menu_my_lessons'), '/my/courses.php', 'fa-book-open', $catpage);
    $add($pages, $str('menu_my_report'), '/local/istikama_admin/reports.php', 'fa-chart-line', $catpage);
}
foreach ($pages as $p) {
    if ($match($p['label']) || $match($p['sublabel'])) {
        $results[] = $p;
    }
}

// ── 2. Users (admin / manager / technical professor) ────────────────────────
if (in_array($tier, ['full_admin', 'school_manager', 'technical_professor'], true) && count($results) < $cap) {
    $like = $DB->sql_like($DB->sql_concat('u.firstname', "' '", 'u.lastname'), ':n1', false)
          . ' OR ' . $DB->sql_like('u.email', ':n2', false);
    $params = ['n1' => '%' . $DB->sql_like_escape($q) . '%', 'n2' => '%' . $DB->sql_like_escape($q) . '%'];
    $users = $DB->get_records_sql(
        "SELECT u.id, u.firstname, u.lastname, u.email FROM {user} u
          WHERE u.deleted = 0 AND u.confirmed = 1 AND u.id <> :guest AND ($like)
       ORDER BY u.lastname ASC", array_merge($params, ['guest' => (int)$CFG->siteguest]), 0, 6);
    foreach ($users as $u) {
        $results[] = [
            'category' => 'users',
            'label'    => fullname($u),
            'sublabel' => $u->email,
            'url'      => (new moodle_url('/user/editadvanced.php', ['id' => $u->id, 'returnto' => 'istikama']))->out(false),
            'icon'     => 'fa-user',
        ];
    }
}

// ── 3. Courses the user can access ──────────────────────────────────────────
if (count($results) < $cap) {
    $courses = [];
    if ($tier === 'full_admin') {
        $like = $DB->sql_like('fullname', ':cn', false);
        $courses = $DB->get_records_sql(
            "SELECT id, fullname FROM {course} WHERE id <> 1 AND $like ORDER BY fullname ASC",
            ['cn' => '%' . $DB->sql_like_escape($q) . '%'], 0, 6);
    } else {
        foreach (enrol_get_my_courses(['id', 'fullname']) as $c) {
            if ($match($c->fullname)) { $courses[$c->id] = $c; }
            if (count($courses) >= 6) { break; }
        }
    }
    foreach ($courses as $c) {
        $results[] = [
            'category' => 'courses',
            'label'    => format_string($c->fullname),
            'sublabel' => $str('search_cat_courses'),
            'url'      => (new moodle_url('/course/view.php', ['id' => $c->id]))->out(false),
            'icon'     => 'fa-book',
        ];
    }
}

// ── 4. Site administration entries (full admin only) ────────────────────────
if ($tier === 'full_admin' && count($results) < $cap) {
    try {
        $adminroot = admin_get_root(false, false);
        $found = 0;
        $walk = function ($node) use (&$walk, &$results, $match, &$found, $str) {
            if ($found >= 6) { return; }
            if ($node instanceof admin_settingpage || $node instanceof admin_externalpage) {
                $name = (string)$node->visiblename;
                if ($match($name)) {
                    $url = ($node instanceof admin_externalpage)
                        ? $node->url
                        : (new moodle_url('/admin/settings.php', ['section' => $node->name]))->out(false);
                    $results[] = ['category' => 'admin', 'label' => $name,
                        'sublabel' => $str('search_cat_admin'), 'url' => $url, 'icon' => 'fa-sliders'];
                    $found++;
                }
            } else if ($node instanceof admin_category) {
                foreach ($node->get_children() as $child) { $walk($child); }
            }
        };
        $walk($adminroot);
    } catch (\Throwable $e) {
        // Admin tree unavailable — ignore.
    }
}

$respond($results);
