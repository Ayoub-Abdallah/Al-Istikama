<?php
// This file is part of Moodle - http://moodle.org/

require_once('../../config.php');
require_once(__DIR__ . '/locallib.php');

use local_istikama_admin\season_manager;
use local_istikama_admin\promotion_manager;

require_login();
// Allows BOTH full_admin and school_manager.
local_istikama_admin_require_school_manager();

$tier            = local_istikama_admin_get_user_tier();
$isfulladmin     = ($tier === 'full_admin');
$managerschoolid = local_istikama_admin_get_manager_school();

// PARAM_ALPHAEXT (not PARAM_ALPHA) — we use underscores in action values
// (e.g. "bulk_promote", "change_class"). PARAM_ALPHA would silently strip the
// underscore and break every form submission. Do NOT downgrade this.
$action       = optional_param('action', '', PARAM_ALPHAEXT);
$schoolid     = optional_param('schoolid', 0, PARAM_INT);
$levelid      = optional_param('levelid', 0, PARAM_INT);
$classid      = optional_param('classid', 0, PARAM_INT);
$fromseasonid = optional_param('fromseasonid', 0, PARAM_INT);
$statusfilter = optional_param('statusfilter', 'all', PARAM_ALPHAEXT);  // all|enrolled|graduated|transferred|suspended

// Lock school manager to their own school.
if (!$isfulladmin && $managerschoolid > 0) {
    $schoolid = $managerschoolid;
}

// Default source season to the currently active one.
if (!$fromseasonid && season_manager::has_active()) {
    $fromseasonid = season_manager::get_active_id();
}

$url = new moodle_url('/local/istikama_admin/promotions.php');
local_istikama_admin_setup_page($PAGE, $url, get_string('bulk_promotion_title', 'local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');
$PAGE->requires->js(new moodle_url('/local/istikama_admin/js/bulk_promotion.js'));

// ---------------------------------------------------------------------------
// POST handler — execute the bulk promotion.
// ---------------------------------------------------------------------------
if ($action === 'bulk_promote' && confirm_sesskey()) {
    $selectedstudents = optional_param_array('selectedstudents', [], PARAM_INT);
    $toseasonid       = required_param('toseasonid', PARAM_INT);
    $tolevelid        = optional_param('tolevelid', 0, PARAM_INT);
    $toclassid        = optional_param('toclassid', 0, PARAM_INT);
    // PARAM_ALPHAEXT — "change_class" contains an underscore which PARAM_ALPHA would strip.
    $promotionaction  = optional_param('promotionaction', promotion_manager::ACTION_PROMOTE, PARAM_ALPHAEXT);
    $notes            = optional_param('notes', '', PARAM_TEXT);

    if (empty($selectedstudents)) {
        redirect($url, get_string('promotion_no_students_selected', 'local_istikama_admin'),
            3, \core\output\notification::NOTIFY_WARNING);
    }

    try {
        $result = promotion_manager::promote_bulk(
            $selectedstudents,
            $fromseasonid,
            $toseasonid,
            $toclassid ?: null,
            $promotionaction,
            $notes,
            $tolevelid ?: null
        );
        $msg = get_string('bulk_promotion_result', 'local_istikama_admin',
            (object)['ok' => $result['ok'], 'failed' => $result['failed']]);
        if (!empty($result['errors'])) {
            $msg .= '<br><small>' . s(implode(' | ', array_slice($result['errors'], 0, 3))) . '</small>';
        }
        $type = $result['failed'] === 0
            ? \core\output\notification::NOTIFY_SUCCESS
            : \core\output\notification::NOTIFY_WARNING;
        // Redirect to the DESTINATION season so the user immediately sees the new enrollments.
        $redirecturl = new moodle_url($url, [
            'schoolid'     => $schoolid,
            'fromseasonid' => $toseasonid,
        ]);
        redirect($redirecturl, $msg, 4, $type);
    } catch (\Throwable $e) {
        redirect($url, $e->getMessage(), 4, \core\output\notification::NOTIFY_ERROR);
    }
}

// ---------------------------------------------------------------------------
// Build dropdown data.
// ---------------------------------------------------------------------------
$schools = [];
if ($isfulladmin) {
    $top = core_course_category::top();
    $schools = $top ? $top->get_children() : [];
}

$levels = [];
if ($schoolid > 0) {
    try {
        $schoolcat = core_course_category::get($schoolid, IGNORE_MISSING);
        if ($schoolcat) {
            $levels = $schoolcat->get_children();
        }
    } catch (\Throwable $e) {
        // ignore
    }
}

$classes = [];
if ($levelid > 0) {
    try {
        $levelcat = core_course_category::get($levelid, IGNORE_MISSING);
        if ($levelcat) {
            $classes = $levelcat->get_children();
        }
    } catch (\Throwable $e) {
        // ignore
    }
}

$allseasons    = season_manager::get_all();
$seasonstatus  = season_manager::get_statuses();

// Destination season list — exclude archived/closed (writes are forbidden into past),
// but DO include the source season so same-season operations (change_class / in-season
// transfer) are possible. The backend enforces which actions allow same season.
$targetseasons = [];
foreach ($allseasons as $s) {
    if (in_array($s->status, [season_manager::STATUS_ARCHIVED, season_manager::STATUS_CLOSED], true)) {
        continue;
    }
    $targetseasons[(int)$s->id] = $s;
}

// Destination level & class picker data — limited to the selected school.
// $destlevels: list of levels for the school
// $classesbylevel: map of levelid → [classes...] (used by JS to filter the class
// dropdown after the user picks a level).
$destlevels       = [];
$classesbylevel   = [];
if ($schoolid > 0) {
    try {
        $schoolcat = core_course_category::get($schoolid, IGNORE_MISSING);
        if ($schoolcat) {
            foreach ($schoolcat->get_children() as $lvl) {
                $lvlid = (int)$lvl->id;
                $destlevels[$lvlid] = (object)[
                    'id'   => $lvlid,
                    'name' => format_string($lvl->name),
                ];
                $classesbylevel[$lvlid] = [];
                foreach ($lvl->get_children() as $cls) {
                    $classesbylevel[$lvlid][] = (object)[
                        'id'   => (int)$cls->id,
                        'name' => format_string($cls->name),
                    ];
                }
            }
        }
    } catch (\Throwable $e) {
        // ignore
    }
}

// ---------------------------------------------------------------------------
// Query students matching the filters.
// ---------------------------------------------------------------------------
$students = [];
if ($schoolid > 0 && $fromseasonid > 0) {
    $where  = ['us.role = :role', 'us.seasonid = :seasonid', 'us.schoolid = :schoolid', 'u.deleted = 0', 'u.confirmed = 1'];
    $params = ['role' => 'student', 'seasonid' => $fromseasonid, 'schoolid' => $schoolid];

    if ($levelid > 0)        { $where[] = 'us.levelid = :levelid';     $params['levelid']     = $levelid; }
    if ($classid > 0)        { $where[] = 'us.classid = :classid';     $params['classid']     = $classid; }
    if ($statusfilter !== 'all') {
        $where[] = 'us.status = :statusf';
        $params['statusf'] = $statusfilter;
    }

    $sql = "SELECT us.id AS rowid, us.userid, us.classid, us.levelid, us.status, us.seasonid,
                   u.firstname, u.lastname, u.email,
                   cc.name AS class_name, lc.name AS level_name
              FROM {istikama_user_school} us
              JOIN {user} u  ON u.id = us.userid
         LEFT JOIN {course_categories} cc ON cc.id = us.classid
         LEFT JOIN {course_categories} lc ON lc.id = us.levelid
             WHERE " . implode(' AND ', $where) . "
          ORDER BY u.lastname ASC, u.firstname ASC";
    $students = $DB->get_records_sql($sql, $params);
}

// Pre-fetch each visible student's other enrollments (other seasons) for the
// "history at a glance" column. One query for all visible students.
$pasthistory = [];   // userid → array of [season_name, level_name, class_name, status]
if (!empty($students)) {
    $sids = array_unique(array_map(fn($r) => (int)$r->userid, $students));
    [$insql, $inparams] = $DB->get_in_or_equal($sids, SQL_PARAMS_NAMED);
    $inparams['fromseason'] = $fromseasonid;
    $rows = $DB->get_records_sql(
        "SELECT us.id, us.userid, us.classid, us.levelid, us.seasonid, us.status,
                s.name AS season_name, s.start_date AS season_start,
                cc.name AS class_name, lc.name AS level_name
           FROM {istikama_user_school} us
      LEFT JOIN {istikama_season} s   ON s.id  = us.seasonid
      LEFT JOIN {course_categories} cc ON cc.id = us.classid
      LEFT JOIN {course_categories} lc ON lc.id = us.levelid
          WHERE us.role = 'student'
            AND us.userid $insql
            AND (us.seasonid IS NULL OR us.seasonid <> :fromseason)
       ORDER BY s.start_date DESC, us.timecreated DESC",
        $inparams
    );
    foreach ($rows as $r) {
        $pasthistory[(int)$r->userid][] = $r;
    }
}

// Source/destination season name strings for the JS confirmation modal.
$fromseasonname   = '';
$fromseasonstatus = '';
if ($fromseasonid > 0) {
    $from = season_manager::get($fromseasonid);
    if ($from) {
        $fromseasonname   = $from->name;
        $fromseasonstatus = $from->status;
    }
}

$enrollstatuses = promotion_manager::get_enrollment_statuses();

// ---------------------------------------------------------------------------
// Render. Hide admin_layout's outer <h1> page header — we render our own
// branded gradient header below.
// ---------------------------------------------------------------------------
$isti_hide_page_header = true;
require(__DIR__ . '/admin_layout.php');

// Strip the outer admin_layout card so the promotions content fills the page.
echo '<style>
  body .istikama-dashboard-container > .isti-card-modern,
  .istikama-dashboard-container > .isti-card-modern {
    padding: 0 !important;
    background: transparent !important;
    border: 0 !important;
    box-shadow: none !important;
    min-height: 0 !important;
  }
</style>';

echo '<div class="isti-bp-page">';

// Branded title + intro — all text + icon explicitly white.
echo '<div style="background:linear-gradient(135deg,#006bff,#0052cc); padding:18px 22px; border-radius:10px; margin-bottom:20px;">';
echo '<h2 style="margin:0; font-size:20px; color:#ffffff;">' .
    '<i class="fa fa-graduation-cap" style="color:#ffffff;"></i> ' .
    '<span style="color:#ffffff;">' . get_string('bulk_promotion_title', 'local_istikama_admin') . '</span></h2>';
echo '<p style="margin:6px 0 0; font-size:13px; color:#ffffff; opacity:0.92;">' .
    get_string('bulk_promotion_help', 'local_istikama_admin') . '</p>';
echo '</div>';

// ── Filter bar ────────────────────────────────────────────────────────────
echo '<form method="get" action="' . $url->out(false) . '" class="isti-bp-filters" '
    . 'style="background:white; border:1px solid #e2e8f0; border-radius:10px; padding:16px 18px; margin-bottom:18px; display:grid; grid-template-columns:repeat(5,1fr); gap:12px;">';

// School (only for full admin).
if ($isfulladmin) {
    echo '<div><label style="font-size:12px; color:#475569; font-weight:600; display:block; margin-bottom:4px;">' .
        get_string('school', 'local_istikama_admin') . '</label>';
    echo '<select name="schoolid" class="isti-bp-cascade" style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">';
    echo '<option value="0">' . get_string('select_school', 'local_istikama_admin') . '</option>';
    foreach ($schools as $sch) {
        $sel = ((int)$sch->id === (int)$schoolid) ? ' selected' : '';
        echo '<option value="' . (int)$sch->id . '"' . $sel . '>' . s(format_string($sch->name)) . '</option>';
    }
    echo '</select></div>';
} else {
    echo '<input type="hidden" name="schoolid" value="' . (int)$schoolid . '">';
}

// Source season — name + status badge.
echo '<div><label style="font-size:12px; color:#475569; font-weight:600; display:block; margin-bottom:4px;">' .
    get_string('season', 'local_istikama_admin') . '</label>';
echo '<select name="fromseasonid" class="isti-bp-cascade" style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">';
foreach ($allseasons as $s) {
    $statlabel = $seasonstatus[$s->status]['label'] ?? $s->status;
    $sel = ((int)$s->id === (int)$fromseasonid) ? ' selected' : '';
    echo '<option value="' . (int)$s->id . '"' . $sel . '>' . s($s->name) . ' — ' . s($statlabel) . '</option>';
}
echo '</select></div>';

// Level.
echo '<div><label style="font-size:12px; color:#475569; font-weight:600; display:block; margin-bottom:4px;">' .
    get_string('level', 'local_istikama_admin') . '</label>';
echo '<select name="levelid" class="isti-bp-cascade" style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;"' .
    (empty($levels) ? ' disabled' : '') . '>';
echo '<option value="0">' . get_string('all_levels', 'local_istikama_admin') . '</option>';
foreach ($levels as $lvl) {
    $sel = ((int)$lvl->id === (int)$levelid) ? ' selected' : '';
    echo '<option value="' . (int)$lvl->id . '"' . $sel . '>' . s(format_string($lvl->name)) . '</option>';
}
echo '</select></div>';

// Class.
echo '<div><label style="font-size:12px; color:#475569; font-weight:600; display:block; margin-bottom:4px;">' .
    get_string('class', 'local_istikama_admin') . '</label>';
echo '<select name="classid" class="isti-bp-cascade" style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;"' .
    (empty($classes) ? ' disabled' : '') . '>';
echo '<option value="0">' . get_string('all_classes', 'local_istikama_admin') . '</option>';
foreach ($classes as $cls) {
    $sel = ((int)$cls->id === (int)$classid) ? ' selected' : '';
    echo '<option value="' . (int)$cls->id . '"' . $sel . '>' . s(format_string($cls->name)) . '</option>';
}
echo '</select></div>';

// Status filter.
echo '<div><label style="font-size:12px; color:#475569; font-weight:600; display:block; margin-bottom:4px;">' .
    get_string('enrollment_status', 'local_istikama_admin') . '</label>';
echo '<select name="statusfilter" class="isti-bp-cascade" style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">';
echo '<option value="all"' . ($statusfilter === 'all' ? ' selected' : '') . '>' . get_string('all', 'local_istikama_admin') . '</option>';
foreach ($enrollstatuses as $k => $meta) {
    $sel = ($statusfilter === $k) ? ' selected' : '';
    echo '<option value="' . s($k) . '"' . $sel . '>' . s($meta['label']) . '</option>';
}
echo '</select></div>';

echo '<div style="grid-column:1/-1; display:flex; justify-content:flex-end; gap:8px;">';
echo '<a href="' . $url->out(false) . '" style="padding:9px 18px; border-radius:6px; border:1px solid #cbd5e1; background:white; color:#475569; text-decoration:none; font-size:13px;"><i class="fa fa-refresh"></i> ' .
    get_string('reset_filters', 'local_istikama_admin') . '</a>';
echo '<button type="submit" style="padding:9px 22px; border-radius:6px; border:0; background:#006bff; color:white; cursor:pointer; font-size:13px; font-weight:600;"><i class="fa fa-search"></i> ' .
    get_string('apply_filters', 'local_istikama_admin') . '</button>';
echo '</div>';

echo '</form>';

// ── Current-filter summary bar ────────────────────────────────────────────
if ($fromseasonid && $fromseasonname) {
    $smeta = $seasonstatus[$fromseasonstatus] ?? ['label' => $fromseasonstatus, 'badge_bg' => '#e2e8f0', 'badge_fg' => '#475569'];
    echo '<div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:10px 14px; margin-bottom:14px; display:flex; align-items:center; gap:10px; font-size:13px;">';
    echo '<i class="fa fa-info-circle" style="color:#006bff;"></i>';
    echo '<span style="color:#475569;">' . get_string('showing_students_for', 'local_istikama_admin') . ':</span>';
    echo '<strong style="color:#0f172a;">' . s($fromseasonname) . '</strong>';
    echo '<span style="background:' . $smeta['badge_bg'] . '; color:' . $smeta['badge_fg'] . '; padding:2px 10px; border-radius:10px; font-size:11px; font-weight:600;">' . s($smeta['label']) . '</span>';
    echo '</div>';
}

// ── Students table + action form ──────────────────────────────────────────
echo '<form method="post" action="' . $url->out(false) . '" id="isti-bp-form">';
echo '<input type="hidden" name="action" value="bulk_promote">';
echo '<input type="hidden" name="sesskey" value="' . sesskey() . '">';
echo '<input type="hidden" name="schoolid" value="' . (int)$schoolid . '">';
echo '<input type="hidden" name="levelid" value="' . (int)$levelid . '">';
echo '<input type="hidden" name="classid" value="' . (int)$classid . '">';
echo '<input type="hidden" name="fromseasonid" value="' . (int)$fromseasonid . '">';
echo '<input type="hidden" name="statusfilter" value="' . s($statusfilter) . '">';

echo '<div style="background:white; border:1px solid #e2e8f0; border-radius:10px; overflow:hidden; margin-bottom:18px;">';
echo '<div style="padding:14px 18px; background:#f8fafc; border-bottom:1px solid #e2e8f0; display:flex; align-items:center; justify-content:space-between;">';
echo '<div><strong style="color:#1e293b;">' . get_string('students', 'local_istikama_admin') . '</strong> ';
echo '<span id="isti-bp-count" style="color:#64748b; font-size:13px; margin-left:8px;">(' .
    count($students) . ' ' . get_string('found', 'local_istikama_admin') . ', <span id="isti-bp-selcount">0</span> ' .
    get_string('selected', 'local_istikama_admin') . ')</span></div>';
if (!empty($students)) {
    echo '<label style="font-size:13px; color:#475569; display:flex; align-items:center; gap:6px; cursor:pointer;">';
    echo '<input type="checkbox" id="isti-bp-selectall"> ' . get_string('select_all', 'local_istikama_admin');
    echo '</label>';
}
echo '</div>';

if (empty($students)) {
    echo '<div style="padding:36px; text-align:center; color:#64748b;">';
    echo '<i class="fa fa-info-circle" style="font-size:28px; color:#cbd5e1;"></i><br>';
    echo $schoolid && $fromseasonid
        ? get_string('no_students_match_filters', 'local_istikama_admin')
        : get_string('select_school_to_continue', 'local_istikama_admin');
    echo '</div>';
} else {
    echo '<table style="width:100%; border-collapse:collapse; font-size:13px;">';
    echo '<thead><tr style="background:#f1f5f9; color:#475569;">';
    echo '<th style="padding:10px 14px; width:42px; text-align:center;"></th>';
    echo '<th style="padding:10px 14px; text-align:left;">' . get_string('name', 'local_istikama_admin') . '</th>';
    echo '<th style="padding:10px 14px; text-align:left;">' . get_string('email', 'local_istikama_admin') . '</th>';
    echo '<th style="padding:10px 14px; text-align:left;">' . get_string('level', 'local_istikama_admin') . '</th>';
    echo '<th style="padding:10px 14px; text-align:left;">' . get_string('class', 'local_istikama_admin') . '</th>';
    echo '<th style="padding:10px 14px; text-align:left;">' . get_string('enrollment_status', 'local_istikama_admin') . '</th>';
    echo '<th style="padding:10px 14px; text-align:left;">' . get_string('other_seasons', 'local_istikama_admin') . '</th>';
    echo '<th style="padding:10px 14px; text-align:center;">' . get_string('history', 'local_istikama_admin') . '</th>';
    echo '</tr></thead><tbody>';

    $i = 0;
    foreach ($students as $st) {
        $bg = ($i++ % 2 === 0) ? 'white' : '#fafbfc';
        $name = fullname((object)['firstname' => $st->firstname, 'lastname' => $st->lastname]);
        $historyurl = new moodle_url('/local/istikama_admin/season_history.php', ['userid' => (int)$st->userid]);

        $rowstatus = $st->status ?: 'enrolled';
        // Compute the *display* status — folds the season's lifecycle state in
        // so rows for not-yet-started seasons render as "Upcoming" rather than
        // misleadingly showing as actively "Enrolled". DB row is unchanged.
        $displaystatus = promotion_manager::display_status($rowstatus, (int)($st->seasonid ?? $st->us_seasonid ?? 0));
        $smeta = $enrollstatuses[$displaystatus] ?? ['label' => $displaystatus, 'badge_bg' => '#e2e8f0', 'badge_fg' => '#475569', 'icon' => 'fa-tag'];

        // Allow selection only for active 'enrolled' rows in this season.
        // Upcoming-season rows can't be selected here — they're already queued
        // for that future season and shouldn't be re-promoted from this view.
        $isenrolled = ($rowstatus === promotion_manager::STATUS_ENROLLED)
                      && ($displaystatus === promotion_manager::STATUS_ENROLLED);

        echo '<tr style="background:' . $bg . '; border-bottom:1px solid #f1f5f9;">';
        echo '<td style="padding:10px 14px; text-align:center;">';
        if ($isenrolled) {
            echo '<input type="checkbox" name="selectedstudents[]" value="' . (int)$st->userid . '" class="isti-bp-row">';
        } else {
            echo '<span title="' . s(get_string('not_selectable_terminal', 'local_istikama_admin')) . '" style="color:#cbd5e1;">—</span>';
        }
        echo '</td>';
        echo '<td style="padding:10px 14px; font-weight:600; color:#1e293b;">' . s($name) . '</td>';
        echo '<td style="padding:10px 14px; color:#475569;">' . s($st->email) . '</td>';
        echo '<td style="padding:10px 14px; color:#64748b;">' . s($st->level_name ?? '—') . '</td>';
        echo '<td style="padding:10px 14px; color:#64748b;">' . s($st->class_name ?? '—') . '</td>';
        echo '<td style="padding:10px 14px;">';
        echo '<span style="background:' . $smeta['badge_bg'] . '; color:' . $smeta['badge_fg'] . '; padding:3px 10px; border-radius:10px; font-size:11px; font-weight:600; white-space:nowrap;">' .
            '<i class="fa ' . $smeta['icon'] . '"></i> ' . s($smeta['label']) . '</span>';
        echo '</td>';

        // History-at-a-glance column: list other seasons (compact pills).
        echo '<td style="padding:10px 14px; font-size:12px;">';
        $past = $pasthistory[(int)$st->userid] ?? [];
        if (empty($past)) {
            echo '<span style="color:#94a3b8;">—</span>';
        } else {
            $pills = [];
            foreach (array_slice($past, 0, 3) as $h) {
                $sname  = $h->season_name ?: get_string('legacy_season_label', 'local_istikama_admin');
                $cname  = $h->class_name  ?: '—';
                $hstat  = $h->status ?: 'enrolled';
                // Use display_status so future-season pills show as "Upcoming" too.
                $hdisplay = promotion_manager::display_status($hstat, (int)$h->seasonid);
                $hmeta  = $enrollstatuses[$hdisplay] ?? ['badge_bg' => '#e2e8f0', 'badge_fg' => '#475569'];
                $tip    = $sname . ' · ' . ($h->level_name ?: '—') . ' · ' . $cname . ' · ' . $hstat;
                $pills[] = '<span title="' . s($tip) . '" style="display:inline-block; background:' . $hmeta['badge_bg'] .
                    '; color:' . $hmeta['badge_fg'] . '; padding:2px 8px; border-radius:8px; font-size:11px; margin-right:3px; white-space:nowrap;">' .
                    s($sname) . ' → ' . s($cname) . '</span>';
            }
            echo implode('', $pills);
            if (count($past) > 3) {
                echo '<span style="color:#64748b; font-size:11px;">+' . (count($past) - 3) . '</span>';
            }
        }
        echo '</td>';

        echo '<td style="padding:10px 14px; text-align:center;">';
        echo '<a href="' . $historyurl->out(false) . '" target="_blank" title="' .
            s(get_string('view_history', 'local_istikama_admin')) . '" '
            . 'style="color:#0891b2; text-decoration:none;"><i class="fa fa-history"></i></a>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
}
echo '</div>';

// ── Action panel ──────────────────────────────────────────────────────────
if (!empty($students)) {
    echo '<div style="background:white; border:1px solid #e2e8f0; border-radius:10px; padding:18px;">';
    echo '<h4 style="margin:0 0 14px; color:#1e293b; font-size:15px;"><i class="fa fa-arrow-right"></i> ' .
        get_string('promotion_destination', 'local_istikama_admin') . '</h4>';
    echo '<div style="display:grid; grid-template-columns:repeat(2,1fr); gap:12px;">';

    // Action type (drives required-ness of level/class).
    echo '<div><label style="font-size:12px; color:#475569; font-weight:600; display:block; margin-bottom:4px;">' .
        get_string('promotion_action', 'local_istikama_admin') . '</label>';
    echo '<select name="promotionaction" id="isti-bp-actiontype" style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">';
    echo '<option value="' . promotion_manager::ACTION_PROMOTE      . '">' . get_string('action_promote', 'local_istikama_admin')      . '</option>';
    echo '<option value="' . promotion_manager::ACTION_RETAIN       . '">' . get_string('action_retain', 'local_istikama_admin')       . '</option>';
    echo '<option value="' . promotion_manager::ACTION_GRADUATE     . '">' . get_string('action_graduate', 'local_istikama_admin')     . '</option>';
    echo '<option value="' . promotion_manager::ACTION_TRANSFER     . '">' . get_string('action_transfer', 'local_istikama_admin')     . '</option>';
    echo '<option value="' . promotion_manager::ACTION_CHANGE_CLASS . '">' . get_string('action_change_class', 'local_istikama_admin') . '</option>';
    echo '</select></div>';

    // Destination season.
    echo '<div id="isti-bp-toseason-wrap"><label style="font-size:12px; color:#475569; font-weight:600; display:block; margin-bottom:4px;">' .
        get_string('destination_season', 'local_istikama_admin') . ' *</label>';
    echo '<select name="toseasonid" id="isti-bp-toseason" required style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">';
    echo '<option value="">' . get_string('select_a_season', 'local_istikama_admin') . '</option>';
    foreach ($targetseasons as $s) {
        $statlbl = $seasonstatus[$s->status]['label'] ?? $s->status;
        echo '<option value="' . (int)$s->id . '">' . s($s->name) . ' — ' . s($statlbl) . '</option>';
    }
    echo '</select></div>';

    // Destination level (NEW). Drives the class dropdown below via JS.
    echo '<div id="isti-bp-tolevel-wrap"><label style="font-size:12px; color:#475569; font-weight:600; display:block; margin-bottom:4px;">' .
        get_string('destination_level', 'local_istikama_admin') . ' <span id="isti-bp-level-required">*</span></label>';
    echo '<select name="tolevelid" id="isti-bp-tolevel" style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;">';
    echo '<option value="0">' . get_string('select_a_level', 'local_istikama_admin') . '</option>';
    foreach ($destlevels as $lvl) {
        echo '<option value="' . (int)$lvl->id . '">' . s($lvl->name) . '</option>';
    }
    echo '</select></div>';

    // Destination class — filtered client-side based on the chosen destination level.
    echo '<div id="isti-bp-toclass-wrap"><label style="font-size:12px; color:#475569; font-weight:600; display:block; margin-bottom:4px;">' .
        get_string('destination_class', 'local_istikama_admin') . ' <span id="isti-bp-class-required">*</span></label>';
    echo '<select name="toclassid" id="isti-bp-toclass" style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px;" disabled>';
    echo '<option value="0">' . get_string('pick_level_first', 'local_istikama_admin') . '</option>';
    echo '</select></div>';

    // Notes (full row).
    echo '<div style="grid-column:1/-1;"><label style="font-size:12px; color:#475569; font-weight:600; display:block; margin-bottom:4px;">' .
        get_string('notes', 'local_istikama_admin') . ' (' . get_string('optional', 'local_istikama_admin') . ')</label>';
    echo '<textarea name="notes" id="isti-bp-notes" rows="2" maxlength="500" '
        . 'style="width:100%; padding:8px; border:1px solid #cbd5e1; border-radius:6px; font-family:inherit; resize:vertical;"></textarea></div>';

    echo '</div>';

    echo '<div style="margin-top:16px; display:flex; justify-content:flex-end; gap:8px;">';
    echo '<button type="button" id="isti-bp-submit-btn" '
        . 'style="padding:11px 26px; background:#059669; color:white; border:0; border-radius:8px; cursor:pointer; font-size:14px; font-weight:600;" disabled>'
        . '<i class="fa fa-check"></i> ' . get_string('promote_selected', 'local_istikama_admin') . '</button>';
    echo '</div>';

    echo '</div>';
}

echo '</form>';

// ── Hidden config div for JS ──────────────────────────────────────────────
// classesbylevel is JSON-encoded so the JS can rebuild the class dropdown
// when the user picks a destination level.
echo '<div id="isti-bp-data" style="display:none" '
    . 'data-from-season-id="' . (int)$fromseasonid . '" '
    . 'data-from-season-name="' . s($fromseasonname) . '" '
    . 'data-validation-no-students="' . s(get_string('promotion_no_students_selected', 'local_istikama_admin')) . '" '
    . 'data-validation-no-season="' . s(get_string('promotion_no_destination_season', 'local_istikama_admin')) . '" '
    . 'data-validation-no-class="' . s(get_string('promotion_no_destination_class', 'local_istikama_admin')) . '" '
    . 'data-validation-no-level="' . s(get_string('promotion_no_destination_level', 'local_istikama_admin')) . '" '
    . 'data-classes-by-level="' . s(json_encode($classesbylevel)) . '" '
    . 'data-select-a-class="' . s(get_string('select_a_class', 'local_istikama_admin')) . '" '
    . 'data-pick-level-first="' . s(get_string('pick_level_first', 'local_istikama_admin')) . '" '
    . 'data-action-promote="' . promotion_manager::ACTION_PROMOTE . '" '
    . 'data-action-retain="' . promotion_manager::ACTION_RETAIN . '" '
    . 'data-action-graduate="' . promotion_manager::ACTION_GRADUATE . '" '
    . 'data-action-transfer="' . promotion_manager::ACTION_TRANSFER . '" '
    . 'data-action-change-class="' . promotion_manager::ACTION_CHANGE_CLASS . '">'
    . '</div>';

// ── Confirmation modal ────────────────────────────────────────────────────
echo '<div class="isti-modal-overlay" id="isti-bp-confirm-modal" style="display:none;">';
echo '  <div class="isti-modal-card" style="background:#fff; border-radius:14px; max-width:520px; width:100%; padding:26px; box-shadow:0 20px 60px rgba(0,0,0,0.3);">';
echo '    <h4 style="margin:0 0 14px; color:#0f172a; font-size:1.15rem;"><i class="fa fa-check-circle" style="color:#059669;"></i> ' .
    get_string('confirm_promotion_title', 'local_istikama_admin') . '</h4>';
echo '    <div id="isti-bp-confirm-text" style="color:#475569; font-size:14px; line-height:1.55;"></div>';
echo '    <div style="display:flex; gap:10px; justify-content:flex-end; margin-top:20px;">';
echo '      <button type="button" data-close-modal '
    . 'style="border:0; padding:9px 18px; border-radius:8px; cursor:pointer; font-weight:500; font-size:14px; background:#e2e8f0; color:#0f172a;">' .
    get_string('cancel') . '</button>';
echo '      <button type="button" id="isti-bp-confirm-yes" '
    . 'style="border:0; padding:9px 18px; border-radius:8px; cursor:pointer; font-weight:600; font-size:14px; background:#059669; color:#fff;">' .
    get_string('confirm_yes_promote', 'local_istikama_admin') . '</button>';
echo '    </div>';
echo '  </div>';
echo '</div>';

echo '</div>'; // .isti-bp-page

local_istikama_admin_print_footer();
