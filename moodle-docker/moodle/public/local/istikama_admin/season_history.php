<?php
// This file is part of Moodle - http://moodle.org/

require_once('../../config.php');
require_once(__DIR__ . '/locallib.php');

use local_istikama_admin\season_history;
use local_istikama_admin\season_manager;

require_login();

// Accept either `userid` (new, unified) or `studentid` (legacy) — they mean the same thing.
$userid = optional_param('userid', 0, PARAM_INT);
if (!$userid) {
    $userid = optional_param('studentid', 0, PARAM_INT);
}

$tier = local_istikama_admin_get_user_tier();

if ($userid && $userid !== (int)$USER->id) {
    // Only admins / school managers / parents-of-this-child can view someone else.
    $allowed = false;
    if (in_array($tier, ['full_admin', 'school_manager'], true)) {
        $allowed = true;
    } else if ($tier === 'parent' && local_istikama_admin_parent_owns_child((int)$USER->id, $userid)) {
        $allowed = true;
    }
    if (!$allowed) {
        throw new \moodle_exception('nopermissions', 'error', '', 'Cannot view another user\'s history');
    }
} else {
    $userid = (int)$USER->id;
}

// Detect user role for this history view. We look at istikama_user_school first
// (which always has the canonical role), and fall back to Moodle system role names.
$userroleinplugin = $DB->get_field('istikama_user_school', 'role', ['userid' => $userid], IGNORE_MULTIPLE);
$isteacher = ($userroleinplugin === 'teacher' || $userroleinplugin === 'manager');
if (!$userroleinplugin) {
    // No plugin enrollment row at all — try Moodle roles.
    $systemcontext = context_system::instance();
    $rolesql = "SELECT r.shortname FROM {role_assignments} ra
                  JOIN {role} r ON r.id = ra.roleid
                 WHERE ra.userid = :u AND ra.contextid = :ctx";
    $sysroles = $DB->get_fieldset_sql($rolesql, ['u' => $userid, 'ctx' => $systemcontext->id]);
    $isteacher = !empty(array_intersect($sysroles, ['teacher', 'editingteacher', 'technicalprofessor', 'technical_professor']));
}

$url = new moodle_url('/local/istikama_admin/season_history.php', ['userid' => $userid]);
local_istikama_admin_setup_page($PAGE, $url, get_string('academic_history_title', 'local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

require(__DIR__ . '/admin_layout.php');

$user = $DB->get_record('user', ['id' => $userid], 'id, firstname, lastname, email', MUST_EXIST);

echo '<div style="margin-bottom: 20px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px;">';
echo '<div>';
echo '<h3 style="margin: 0; color: #1e293b;">' . s(fullname($user)) . '</h3>';
echo '<p style="margin:4px 0 0; color:#64748b; font-size:13px;">' . s($user->email) . ' &middot; ' .
    ($isteacher
        ? '<span style="background:#dbeafe; color:#1e40af; padding:2px 10px; border-radius:10px; font-size:11px; font-weight:600;"><i class="fa fa-chalkboard-teacher"></i> ' . get_string('teacher_history', 'local_istikama_admin') . '</span>'
        : '<span style="background:#d1fae5; color:#047857; padding:2px 10px; border-radius:10px; font-size:11px; font-weight:600;"><i class="fa fa-user-graduate"></i> ' . get_string('student_history', 'local_istikama_admin') . '</span>') .
    '</p>';
echo '</div>';
echo '</div>';

// ─────────────────────────────────────────────────────────────────────────
// TEACHER VIEW
// ─────────────────────────────────────────────────────────────────────────
if ($isteacher) {
    $seasons = season_history::get_teacher_seasons($userid);

    if (empty($seasons)) {
        echo '<div style="background:#fef3c7; border-left:4px solid #f59e0b; color:#78350f; padding:14px 18px; border-radius:6px;">' .
            get_string('no_history_yet', 'local_istikama_admin') . '</div>';
        local_istikama_admin_print_footer();
        return;
    }

    $statuses = season_manager::get_statuses();
    foreach ($seasons as $entry) {
        $s = $entry->season;
        $sid = (int)$entry->seasonid;
        $summary = season_history::get_teacher_season_summary($userid, $sid);
        $meta = $statuses[$s->status] ?? ['label' => $s->status, 'badge_bg' => '#e2e8f0', 'badge_fg' => '#475569', 'icon' => 'fa-tag'];

        echo '<div style="background:white; border:1px solid #e2e8f0; border-radius:8px; padding:20px; margin-bottom:16px;">';
        echo '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">';
        echo '<div>';
        echo '<h4 style="margin:0; color:#1e293b;">' . s($s->name) . '</h4>';
        if ($s->start_date) {
            echo '<div style="color:#64748b; font-size:13px; margin-top:2px;">' .
                userdate($s->start_date, get_string('strftimedate', 'langconfig')) . ' &rarr; ' .
                userdate($s->end_date, get_string('strftimedate', 'langconfig')) . '</div>';
        }
        echo '</div>';
        echo '<span style="background:' . $meta['badge_bg'] . '; color:' . $meta['badge_fg'] .
            '; padding:4px 12px; border-radius:14px; font-size:12px; font-weight:600;">' .
            '<i class="fa ' . $meta['icon'] . '"></i> ' . s($meta['label']) . '</span>';
        echo '</div>';

        echo '<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:12px;">';
        $tile = function($value, $label, $color = '#006bff') {
            echo '<div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:6px; padding:12px; text-align:center;">';
            echo '<div style="font-size:22px; font-weight:700; color:' . $color . ';">' . $value . '</div>';
            echo '<div style="font-size:12px; color:#64748b; margin-top:2px;">' . $label . '</div>';
            echo '</div>';
        };
        $tile($summary->classes_count,        get_string('classes_taught',       'local_istikama_admin'));
        $tile($summary->activities_count,     get_string('activities_authored',  'local_istikama_admin'));
        $tile($summary->attendance_recorded,  get_string('attendance_recorded',  'local_istikama_admin'));
        $tile($summary->assessments_recorded, get_string('assessments_recorded', 'local_istikama_admin'));
        echo '</div>';

        if (!empty($summary->subjects)) {
            echo '<div style="margin-top:14px; font-size:13px; color:#475569;"><strong>' .
                get_string('subjects', 'local_istikama_admin') . ':</strong> ';
            $bits = [];
            foreach ($summary->subjects as $subj) {
                $bits[] = '<span style="background:#e0f2fe; color:#075985; padding:2px 8px; border-radius:8px; font-size:12px;">' . s($subj) . '</span>';
            }
            echo implode(' ', $bits) . '</div>';
        }

        // Drill-in: classes assigned in this season.
        $tclasses = season_history::get_teacher_classes($userid, $sid);
        if (!empty($tclasses)) {
            echo '<details style="margin-top:14px;"><summary style="cursor:pointer; color:#006bff; font-weight:600; font-size:13px;">' .
                get_string('view_class_assignments', 'local_istikama_admin') . ' (' . count($tclasses) . ')</summary>';
            echo '<table style="width:100%; margin-top:10px; border-collapse:collapse; font-size:13px;">';
            echo '<thead><tr style="background:#f1f5f9;">';
            echo '<th style="padding:8px; text-align:left;">' . get_string('school', 'local_istikama_admin') . '</th>';
            echo '<th style="padding:8px; text-align:left;">' . get_string('level', 'local_istikama_admin') . '</th>';
            echo '<th style="padding:8px; text-align:left;">' . get_string('class', 'local_istikama_admin') . '</th>';
            echo '<th style="padding:8px; text-align:left;">' . get_string('assigned_on', 'local_istikama_admin') . '</th>';
            echo '</tr></thead><tbody>';
            foreach ($tclasses as $tc) {
                echo '<tr style="border-bottom:1px solid #e2e8f0;">';
                echo '<td style="padding:8px;">' . s(format_string($tc->school_name ?? '—')) . '</td>';
                echo '<td style="padding:8px;">' . s(format_string($tc->level_name ?? '—')) . '</td>';
                echo '<td style="padding:8px;">' . s(format_string($tc->class_name ?? '—')) . '</td>';
                echo '<td style="padding:8px;">' . userdate($tc->timecreated, get_string('strftimedate', 'langconfig')) . '</td>';
                echo '</tr>';
            }
            echo '</tbody></table></details>';
        }

        // Drill-in: activities authored.
        $tacts = season_history::get_teacher_activities($userid, $sid);
        if (!empty($tacts)) {
            echo '<details style="margin-top:8px;"><summary style="cursor:pointer; color:#006bff; font-weight:600; font-size:13px;">' .
                get_string('view_activities', 'local_istikama_admin') . ' (' . count($tacts) . ')</summary>';
            echo '<table style="width:100%; margin-top:10px; border-collapse:collapse; font-size:13px;">';
            echo '<thead><tr style="background:#f1f5f9;">';
            echo '<th style="padding:8px; text-align:left;">' . get_string('subject', 'local_istikama_admin') . '</th>';
            echo '<th style="padding:8px; text-align:left;">' . get_string('name', 'local_istikama_admin') . '</th>';
            echo '<th style="padding:8px; text-align:left;">' . get_string('status', 'local_istikama_admin') . '</th>';
            echo '<th style="padding:8px; text-align:left;">' . get_string('created', 'local_istikama_admin') . '</th>';
            echo '</tr></thead><tbody>';
            foreach ($tacts as $a) {
                echo '<tr style="border-bottom:1px solid #e2e8f0;">';
                echo '<td style="padding:8px;">' . s($a->subject ?? '—') . '</td>';
                echo '<td style="padding:8px;">' . s($a->name ?? '—') . '</td>';
                echo '<td style="padding:8px;">' . s($a->status ?? '—') . '</td>';
                echo '<td style="padding:8px;">' . userdate($a->timecreated, get_string('strftimedate', 'langconfig')) . '</td>';
                echo '</tr>';
            }
            echo '</tbody></table></details>';
        }

        echo '</div>';
    }

    local_istikama_admin_print_footer();
    return;
}

// ─────────────────────────────────────────────────────────────────────────
// STUDENT VIEW
// ─────────────────────────────────────────────────────────────────────────
$seasons = season_history::get_student_seasons($userid);

if (empty($seasons)) {
    echo '<div style="background:#fef3c7; border-left:4px solid #f59e0b; color:#78350f; padding:14px 18px; border-radius:6px;">' .
        get_string('no_history_yet', 'local_istikama_admin') . '</div>';
    local_istikama_admin_print_footer();
    return;
}

$statuses = season_manager::get_statuses();
foreach ($seasons as $entry) {
    $s = $entry->season;
    $sid = (int)$entry->seasonid;
    $summary = season_history::get_student_season_summary($userid, $sid);
    $meta = $statuses[$s->status] ?? ['label' => $s->status, 'badge_bg' => '#e2e8f0', 'badge_fg' => '#475569', 'icon' => 'fa-tag'];

    echo '<div style="background:white; border:1px solid #e2e8f0; border-radius:8px; padding:20px; margin-bottom:16px;">';
    echo '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px;">';
    echo '<div>';
    echo '<h4 style="margin:0; color:#1e293b;">' . s($s->name);
    if ($summary->class_name) {
        echo ' <span style="color:#64748b; font-weight:400; font-size:14px;">— ' . s($summary->class_name) . '</span>';
    }
    echo '</h4>';
    if ($s->start_date) {
        echo '<div style="color:#64748b; font-size:13px; margin-top:2px;">' .
            userdate($s->start_date, get_string('strftimedate', 'langconfig')) . ' &rarr; ' .
            userdate($s->end_date, get_string('strftimedate', 'langconfig')) . '</div>';
    }
    echo '</div>';
    echo '<span style="background:' . $meta['badge_bg'] . '; color:' . $meta['badge_fg'] .
        '; padding:4px 12px; border-radius:14px; font-size:12px; font-weight:600;">' .
        '<i class="fa ' . $meta['icon'] . '"></i> ' . s($meta['label']) . '</span>';
    echo '</div>';

    echo '<div style="display:grid; grid-template-columns:repeat(5,1fr); gap:12px;">';
    $tile = function($value, $label, $color = '#006bff') {
        echo '<div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:6px; padding:12px; text-align:center;">';
        echo '<div style="font-size:22px; font-weight:700; color:' . $color . ';">' . $value . '</div>';
        echo '<div style="font-size:12px; color:#64748b; margin-top:2px;">' . $label . '</div>';
        echo '</div>';
    };
    $tile($summary->present,    get_string('present', 'local_istikama_admin'), '#059669');
    $tile($summary->absent,     get_string('absent', 'local_istikama_admin'),  '#dc2626');
    $tile($summary->late,       get_string('late', 'local_istikama_admin'),    '#d97706');
    $tile($summary->assessments, get_string('assessments_count', 'local_istikama_admin'));
    $tile($summary->avg_score !== null ? $summary->avg_score . '%' : '—',
          get_string('avg_score', 'local_istikama_admin'),
          ($summary->avg_score !== null && $summary->avg_score >= 50) ? '#059669' : '#dc2626');
    echo '</div>';

    // Drill-in: assessments table.
    $assessments = season_history::get_assessments($userid, $sid);
    if (!empty($assessments)) {
        echo '<details style="margin-top:14px;"><summary style="cursor:pointer; color:#006bff; font-weight:600; font-size:13px;">' .
            get_string('view_assessment_details', 'local_istikama_admin') . ' (' . count($assessments) . ')</summary>';
        echo '<table style="width:100%; margin-top:10px; border-collapse:collapse; font-size:13px;">';
        echo '<thead><tr style="background:#f1f5f9;">';
        echo '<th style="padding:8px; text-align:left;">' . get_string('subject', 'local_istikama_admin') . '</th>';
        echo '<th style="padding:8px; text-align:left;">' . get_string('title', 'local_istikama_admin') . '</th>';
        echo '<th style="padding:8px; text-align:right;">' . get_string('score', 'local_istikama_admin') . '</th>';
        echo '</tr></thead><tbody>';
        foreach ($assessments as $a) {
            echo '<tr style="border-bottom:1px solid #e2e8f0;">';
            echo '<td style="padding:8px;">' . s($a->subject) . '</td>';
            echo '<td style="padding:8px;">' . s($a->title) . '</td>';
            echo '<td style="padding:8px; text-align:right; font-family:monospace;">' .
                (isset($a->score) ? format_float((float)$a->score, 2) : '—') .
                (isset($a->max_score) ? ' / ' . format_float((float)$a->max_score, 2) : '') . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table></details>';
    }

    // Drill-in: attendance log.
    $attlog = season_history::get_attendance($userid, $sid);
    if (!empty($attlog)) {
        echo '<details style="margin-top:8px;"><summary style="cursor:pointer; color:#006bff; font-weight:600; font-size:13px;">' .
            get_string('view_attendance_log', 'local_istikama_admin') . ' (' . count($attlog) . ')</summary>';
        echo '<table style="width:100%; margin-top:10px; border-collapse:collapse; font-size:13px;">';
        echo '<thead><tr style="background:#f1f5f9;">';
        echo '<th style="padding:8px; text-align:left;">' . get_string('date', 'local_istikama_admin') . '</th>';
        echo '<th style="padding:8px; text-align:left;">' . get_string('status', 'local_istikama_admin') . '</th>';
        echo '<th style="padding:8px; text-align:left;">' . get_string('notes', 'local_istikama_admin') . '</th>';
        echo '</tr></thead><tbody>';
        foreach ($attlog as $a) {
            $statuscolor = ['present' => '#059669', 'absent' => '#dc2626', 'late' => '#d97706', 'excused' => '#0891b2'][$a->status] ?? '#475569';
            echo '<tr style="border-bottom:1px solid #e2e8f0;">';
            echo '<td style="padding:8px;">' . userdate($a->attend_date, get_string('strftimedate', 'langconfig')) . '</td>';
            echo '<td style="padding:8px;"><span style="color:' . $statuscolor . '; font-weight:600;">' . s($a->status) . '</span></td>';
            echo '<td style="padding:8px; color:#64748b;">' . s($a->behavior_note ?? '') . '</td>';
            echo '</tr>';
        }
        echo '</tbody></table></details>';
    }

    echo '</div>';
}

// Promotion log (at the end of the page).
$promolog = season_history::get_promotion_log($userid);
if (!empty($promolog)) {
    echo '<div style="background:white; border:1px solid #e2e8f0; border-radius:8px; padding:20px; margin-bottom:16px;">';
    echo '<h4 style="margin:0 0 12px; color:#1e293b;"><i class="fa fa-arrows-alt-h"></i> ' .
        get_string('promotion_log', 'local_istikama_admin') . '</h4>';
    echo '<table style="width:100%; border-collapse:collapse; font-size:13px;">';
    echo '<thead><tr style="background:#f1f5f9;">';
    echo '<th style="padding:8px; text-align:left;">' . get_string('date', 'local_istikama_admin') . '</th>';
    echo '<th style="padding:8px; text-align:left;">' . get_string('promotion_action', 'local_istikama_admin') . '</th>';
    echo '<th style="padding:8px; text-align:left;">' . get_string('source_season', 'local_istikama_admin') . '</th>';
    echo '<th style="padding:8px; text-align:left;">' . get_string('destination_season', 'local_istikama_admin') . '</th>';
    echo '<th style="padding:8px; text-align:left;">' . get_string('notes', 'local_istikama_admin') . '</th>';
    echo '</tr></thead><tbody>';
    foreach ($promolog as $pl) {
        $fromS = season_manager::get((int)$pl->from_seasonid);
        $toS   = season_manager::get((int)$pl->to_seasonid);
        echo '<tr style="border-bottom:1px solid #e2e8f0;">';
        echo '<td style="padding:8px;">' . userdate($pl->timecreated, get_string('strftimedate', 'langconfig')) . '</td>';
        echo '<td style="padding:8px;"><span style="background:#dbeafe; color:#1e40af; padding:2px 8px; border-radius:8px; font-size:11px; font-weight:600;">' . s($pl->action) . '</span></td>';
        echo '<td style="padding:8px;">' . s($fromS ? $fromS->name : '—') . '</td>';
        echo '<td style="padding:8px;">' . s($toS ? $toS->name : '—') . '</td>';
        echo '<td style="padding:8px; color:#64748b;">' . s($pl->notes ?? '') . '</td>';
        echo '</tr>';
    }
    echo '</tbody></table>';
    echo '</div>';
}

local_istikama_admin_print_footer();
