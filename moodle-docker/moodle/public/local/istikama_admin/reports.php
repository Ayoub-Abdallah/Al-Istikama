<?php
/**
 * Reports Dashboard — role-aware analytics.
 *
 * Detects user tier and renders the appropriate report view:
 *   - full_admin            → system-wide KPIs, school performance, content stats
 *   - school_manager        → single-school KPIs + teacher activity + content stats
 *   - teacher / creator     → class performance + lesson + student tables
 *   - technical_professor   → question bank + quiz authoring stats
 *   - student               → dedicated personal_report template (separate)
 *
 * All data comes from local_istikama_admin_report_service. Insights are
 * computed server-side and rendered as narrative cards. Empty states are
 * explanatory (not just "No data").
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');
require_once(__DIR__ . '/classes/report_service.php');

require_login();

// This page renders a DIFFERENT report per tier — including a dedicated,
// student-safe "personal report" for students. So it must NOT use the
// staff-only require_target_user() guard (that wrongly blocked students with
// "Staff access required"). Instead allow exactly the tiers this page handles;
// students only ever reach their own personal report branch below.
$tier = local_istikama_admin_get_user_tier();
$allowed_report_tiers = ['full_admin', 'school_manager', 'teacher', 'teacher_creator', 'technical_professor', 'student'];
if (!in_array($tier, $allowed_report_tiers, true)) {
    throw new \moodle_exception('nopermissions', 'error', '', get_string('report_no_access', 'local_istikama_admin'));
}

// ── Season scope ───────────────────────────────────────────────────────────
$viewseasonid = local_istikama_admin_resolve_view_seasonid();
local_istikama_admin_report_service::set_seasonid($viewseasonid);

$systemcontext = context_system::instance();
$baseurl = new moodle_url('/local/istikama_admin/reports.php');
$svc = 'local_istikama_admin_report_service';

// School manager → resolve their school id.
$schoolid = false;
if ($tier === 'school_manager') {
    $schoolid = local_istikama_admin_get_manager_school();
}

// ── Build season-banner data once for the template ────────────────────────
$activeseason = \local_istikama_admin\season_manager::get_active();
$allseasons   = \local_istikama_admin\season_manager::get_all();
$statuses     = \local_istikama_admin\season_manager::get_statuses();
$season_banner = null;
if (!empty($allseasons)) {
    $islegacy  = ($viewseasonid === -1);
    $isall     = ($viewseasonid === 0);
    $viewed    = ($viewseasonid > 0) ? ($allseasons[$viewseasonid] ?? null) : null;
    $iscurrent = $activeseason && (int)$activeseason->id === $viewseasonid;

    if ($isall) {
        $name = get_string('all_seasons', 'local_istikama_admin');
        $statuslabel = '';
        $statusclass = '';
    } else if ($islegacy) {
        $name = get_string('legacy_season_label', 'local_istikama_admin');
        $statuslabel = 'Legacy';
        $statusclass = 'legacy';
    } else if ($viewed) {
        $name = $viewed->name;
        if ($iscurrent) {
            $statuslabel = get_string('current_active_season', 'local_istikama_admin');
            $statusclass = 'active';
        } else {
            $statuslabel = $statuses[$viewed->status]['label'] ?? $viewed->status;
            $statusclass = $viewed->status;
        }
    } else if ($activeseason) {
        $name = $activeseason->name;
        $statuslabel = get_string('current_active_season', 'local_istikama_admin');
        $statusclass = 'active';
    } else {
        $name = get_string('no_active_season', 'local_istikama_admin');
        $statuslabel = '';
        $statusclass = '';
    }

    $picker = [];
    if ($tier !== 'student') {
        $picker[] = [
            'url' => (new moodle_url('/local/istikama_admin/reports.php', ['view_season' => 0]))->out(false),
            'label' => get_string('all_seasons', 'local_istikama_admin'),
            'selected' => $isall,
        ];
        if ($activeseason) {
            $picker[] = [
                'url' => (new moodle_url('/local/istikama_admin/reports.php', ['view_season' => (int)$activeseason->id]))->out(false),
                'label' => $activeseason->name . ' — ' . get_string('current_active_season', 'local_istikama_admin'),
                'selected' => $iscurrent,
            ];
        }
        foreach ($allseasons as $s) {
            if ($activeseason && (int)$s->id === (int)$activeseason->id) { continue; }
            $picker[] = [
                'url' => (new moodle_url('/local/istikama_admin/reports.php', ['view_season' => (int)$s->id]))->out(false),
                'label' => $s->name . ' (' . ($statuses[$s->status]['label'] ?? $s->status) . ')',
                'selected' => ((int)$s->id === $viewseasonid),
            ];
        }
        $picker[] = [
            'url' => (new moodle_url('/local/istikama_admin/reports.php', ['view_season' => -1]))->out(false),
            'label' => get_string('legacy_season_label', 'local_istikama_admin'),
            'selected' => $islegacy,
        ];
    }

    $season_banner = [
        'label'          => get_string('viewing_season', 'local_istikama_admin'),
        'name'           => $name,
        'status_label'   => $statuslabel,
        'status_class'   => $statusclass,
        'picker_options' => $picker,
    ];
}

// ── Build template context per tier ───────────────────────────────────────
$templatecontext = [
    'is_admin'      => false,
    'is_techprof'   => false,
    'is_teacher'    => false,
    'is_manager'    => false,
    'is_student'    => false,
    'season_banner' => $season_banner,
];

if ($tier === 'full_admin') {
    $kpis         = $svc::get_system_kpis();
    $logintrend   = $svc::get_login_trend(14);
    $schools      = $svc::get_school_rankings(10);
    $contentstats = $svc::get_content_stats();
    $schoolperf   = $svc::get_all_school_performance(15);
    $insights     = $svc::get_admin_insights($kpis, $logintrend, $schools);

    $hascontent = !empty($contentstats['by_type']) || !empty($contentstats['by_status']) || !empty($contentstats['upload_trend']);

    $templatecontext['is_admin'] = true;
    $templatecontext['kpis']       = $kpis;
    $templatecontext['login_trend']= json_encode($logintrend);
    $templatecontext['has_login_trend'] = !empty($logintrend);
    $templatecontext['schools']    = $schools;
    $templatecontext['has_schools']= !empty($schools);
    $templatecontext['school_perf']= $schoolperf;
    $templatecontext['has_school_perf'] = !empty($schoolperf);
    $templatecontext['content_stats'] = $contentstats;
    $templatecontext['content_by_type_json']   = json_encode($contentstats['by_type']);
    $templatecontext['content_by_status_json'] = json_encode($contentstats['by_status']);
    $templatecontext['upload_trend_json']      = json_encode($contentstats['upload_trend']);
    $templatecontext['has_content'] = $hascontent;
    $templatecontext['insights']     = $insights;
    $templatecontext['has_insights'] = !empty($insights);

} else if ($tier === 'school_manager' && $schoolid) {
    $kpis         = $svc::get_school_kpis($schoolid);
    $logintrend   = $svc::get_school_login_trend($schoolid, 14);
    $teachers     = $svc::get_school_teacher_activity($schoolid);
    $contentstats = $svc::get_school_content_stats($schoolid);
    $insights     = $svc::get_manager_insights($kpis, $logintrend);

    // Enriched analytics (added 2026-05-31).
    $funnel       = $svc::get_school_enrollment_funnel($schoolid);
    $classperf    = $svc::get_school_class_performance($schoolid);
    $teachereff   = $svc::get_school_teacher_effectiveness($schoolid);
    $subjectperf  = $svc::get_school_subject_performance($schoolid);
    $atrisk       = $svc::get_school_at_risk_students($schoolid);

    $hascontent = !empty($contentstats['by_type']) || !empty($contentstats['by_status']);

    $templatecontext['is_manager']      = true;
    $templatecontext['manager_kpis']    = $kpis;
    $templatecontext['login_trend']     = json_encode($logintrend);
    $templatecontext['has_login_trend'] = !empty($logintrend);
    $templatecontext['school_teachers'] = $teachers;
    $templatecontext['has_teachers']    = !empty($teachers);
    $templatecontext['content_by_type_json']   = json_encode($contentstats['by_type']);
    $templatecontext['content_by_status_json'] = json_encode($contentstats['by_status']);
    $templatecontext['has_content']     = $hascontent;
    $templatecontext['insights']        = $insights;
    $templatecontext['has_insights']    = !empty($insights);
    // Enrichment slots.
    $templatecontext['school_funnel']        = $funnel;
    $templatecontext['class_perf']           = $classperf;
    $templatecontext['has_class_perf']       = !empty($classperf);
    $templatecontext['teacher_eff']          = $teachereff;
    $templatecontext['has_teacher_eff']      = !empty($teachereff);
    $templatecontext['subject_perf']         = $subjectperf;
    $templatecontext['has_subject_perf']     = !empty($subjectperf);
    $templatecontext['at_risk_students']     = $atrisk;
    $templatecontext['has_at_risk_students'] = !empty($atrisk);

    $templatecontext['school_name'] = '';
    try {
        $schoolcat = core_course_category::get($schoolid);
        $templatecontext['school_name'] = format_string($schoolcat->name);
    } catch (\Throwable $e) {}

} else if ($tier === 'teacher' || $tier === 'teacher_creator') {
    $userid   = (int)$USER->id;
    $kpis     = $svc::get_teacher_kpis($userid);
    $students = $svc::get_teacher_student_summary($userid);
    $lessons  = $svc::get_teacher_lesson_engagement($userid);
    $insights = $svc::get_teacher_insights($kpis, $students);

    $templatecontext['is_teacher'] = true;
    $templatecontext['teacher_kpis']    = $kpis;
    $templatecontext['teacher_students']= $students;
    $templatecontext['has_students']    = !empty($students);
    $templatecontext['teacher_lessons'] = $lessons;
    $templatecontext['has_lessons']     = !empty($lessons);
    $templatecontext['has_classes']     = ($kpis['classes_count'] ?? 0) > 0;
    $templatecontext['insights']        = $insights;
    $templatecontext['has_insights']    = !empty($insights);

} else if ($tier === 'technical_professor') {
    // Kept lean — technical view: question & quiz authoring stats.
    $kpis        = $svc::get_tp_kpis();
    $mostused    = $svc::get_tp_most_used_questions(10);
    $unused      = $svc::get_tp_unused_questions(10);
    $topteachers = $svc::get_tp_top_teachers(10);

    $fmt = function(array $rows, callable $build): array {
        $out = [];
        foreach ($rows as $row) { $out[] = $build($row); }
        return $out;
    };

    $templatecontext['is_techprof'] = true;
    $templatecontext['tp_kpis']     = $kpis;
    $templatecontext['tp_mostused'] = $fmt($mostused, fn($r) => [
        'name' => format_string($r->name), 'qtype' => $r->qtype,
        'category' => format_string($r->catname), 'uses' => (int)$r->uses,
    ]);
    $templatecontext['tp_has_mostused'] = !empty($mostused);
    $templatecontext['tp_unused'] = $fmt($unused, fn($r) => [
        'name' => format_string($r->name), 'qtype' => $r->qtype,
        'category' => format_string($r->catname),
        'modified' => userdate($r->timemodified, get_string('strftimedatetimeshort', 'langconfig')),
    ]);
    $templatecontext['tp_has_unused'] = !empty($unused);
    $templatecontext['tp_topteachers'] = $fmt($topteachers, function($r) {
        $name = trim(($r->firstname ?? '') . ' ' . ($r->lastname ?? ''));
        return ['name' => $name ?: '—', 'quizzes' => (int)$r->quizzes, 'slots' => (int)$r->slots];
    });
    $templatecontext['tp_has_topteachers'] = !empty($topteachers);

} else if ($tier === 'student') {
    // Student → dedicated simplified template (rendered below).
    require_once(__DIR__ . '/classes/student_report_service.php');
    $student_svc = '\local_istikama_admin\student_report_service';
    $student_report = $student_svc::getStudentReport($USER->id, $viewseasonid);

    $templatecontext['is_student'] = true;

    $grade_color = function($pct) {
        if ($pct >= 70) return '#10b981';
        if ($pct >= 40) return '#f59e0b';
        return '#ef4444';
    };
    $grades_simple = [];
    foreach ($student_report['grades'] as $g) {
        $pct = isset($g['grade']) ? (int)round($g['grade']) : 0;
        $grades_simple[] = [
            'course'      => $g['course'] ?? '',
            'grade'       => $pct,
            'grade_color' => $grade_color($pct),
        ];
    }
    $trend_raw = $student_report['trend_data'] ?? [];
    $maxlog = 1; $maxsub = 1;
    foreach ($trend_raw as $w) {
        $maxlog = max($maxlog, (int)($w['logins'] ?? 0));
        $maxsub = max($maxsub, (int)($w['submissions'] ?? 0));
    }
    $trend_weeks = [];
    foreach (array_slice($trend_raw, -4) as $w) {
        $loginP = $maxlog ? ((int)($w['logins'] ?? 0) / $maxlog) * 50 : 0;
        $subP   = $maxsub ? ((int)($w['submissions'] ?? 0) / $maxsub) * 50 : 0;
        $trend_weeks[] = [
            'label'   => substr((string)($w['week'] ?? ''), 5),
            'percent' => max(8, (int)round($loginP + $subP)),
        ];
    }
    $insights = [];
    foreach (array_slice($student_report['insights'] ?? [], 0, 3) as $ins) {
        $type = $ins['type'] ?? 'info';
        $icon = $type === 'positive' ? 'fa-thumbs-up'
              : ($type === 'warning' ? 'fa-exclamation-circle' : 'fa-info-circle');
        $insights[] = [
            'type' => $type === 'positive' ? 'positive' : ($type === 'warning' ? 'warning' : 'info'),
            'icon' => $icon,
            'message' => $ins['message'] ?? '',
        ];
    }
    $first = explode(' ', fullname($USER))[0] ?? 'there';
    $student_ctx = [
        'student_firstname' => $first,
        'avg'               => (int)round($student_report['average'] ?? 0),
        'completion'        => (int)round($student_report['progress']['course_completion_rate'] ?? 0),
        'submissions'       => (int)($student_report['engagement']['submissions'] ?? 0),
        'logins'            => (int)($student_report['engagement']['logins'] ?? 0),
        'has_grades'        => !empty($grades_simple),
        'grade_count'       => count($grades_simple),
        'grade_plural'      => count($grades_simple) !== 1,
        'grades'            => $grades_simple,
        'has_insights'      => !empty($insights),
        'insights'          => $insights,
        'has_trend'         => !empty($trend_weeks),
        'trend_weeks'       => $trend_weeks,
        'str_hi'            => get_string('sr_hi', 'local_istikama_admin'),
        'str_subtitle'      => get_string('sr_subtitle', 'local_istikama_admin'),
        'str_kpi_avg'       => get_string('sr_kpi_avg', 'local_istikama_admin'),
        'str_kpi_completion'=> get_string('sr_kpi_completion', 'local_istikama_admin'),
        'str_kpi_tasks'     => get_string('sr_kpi_tasks', 'local_istikama_admin'),
        'str_kpi_days'      => get_string('sr_kpi_days', 'local_istikama_admin'),
        'str_my_grades'     => get_string('sr_my_grades', 'local_istikama_admin'),
        'str_my_activity'   => get_string('sr_my_activity', 'local_istikama_admin'),
        'str_last4weeks'    => get_string('sr_last4weeks', 'local_istikama_admin'),
        'str_count_singular'=> get_string('sr_course_count_singular', 'local_istikama_admin'),
        'str_count_plural'  => get_string('sr_course_count_plural', 'local_istikama_admin'),
        'str_no_grades'     => get_string('sr_no_grades', 'local_istikama_admin'),
        'str_no_activity'   => get_string('sr_no_activity', 'local_istikama_admin'),
        'str_footer_active' => get_string('sr_footer_active', 'local_istikama_admin'),
        'str_footer_empty'  => get_string('sr_footer_empty', 'local_istikama_admin'),
    ];
}

// ── Page setup ────────────────────────────────────────────────────────────
$PAGE->set_url($baseurl);
$PAGE->set_context($systemcontext);
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('reports_title', 'local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

require_once('admin_layout.php');

if ($tier === 'student' && isset($student_ctx)) {
    echo $OUTPUT->render_from_template('local_istikama_admin/student_personal_report', $student_ctx);
} else {
    echo $OUTPUT->render_from_template('local_istikama_admin/reports_dashboard', $templatecontext);
}

echo '</div></div>'; // close admin_layout's two divs
echo $OUTPUT->footer();
