<?php
// This file is part of Moodle - http://moodle.org/
namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

class student_report_service {

    /**
     * Get comprehensive personal report data for a student.
     *
     * When $seasonid > 0 is provided, ALL time-windowed queries (logs,
     * completions, etc.) are clamped to that season's start_date..end_date
     * range, and istikama_assessment / istikama_attendance reads are scoped
     * with WHERE seasonid = ?. When $seasonid == 0 the report aggregates
     * across the user's full lifetime (the legacy behavior).
     *
     * @param int $studentid
     * @param int $seasonid 0 = no scope, >0 = season strict, -1 = legacy
     * @return array
     */
    public static function getStudentReport(int $studentid, int $seasonid = 0): array {
        global $DB;

        // Resolve season date window if scoping is requested.
        $seasonstart = null;
        $seasonend   = null;
        if ($seasonid > 0) {
            $season = season_manager::get($seasonid);
            if ($season) {
                $seasonstart = (int)$season->start_date;
                $seasonend   = (int)$season->end_date;
            }
        }

        $report = [
            'grades' => [],
            'average' => 0,
            'progress' => [
                'course_completion_rate' => 0,
                'activities_completed' => 0,
                'activities_total' => 0
            ],
            'engagement' => [
                'score' => 0,
                'logins' => 0,
                'time_spent_weighted' => 0,
                'submissions' => 0
            ],
            'insights' => [],
            'trend_data' => []
        ];

        if ($studentid <= 0) {
            return $report;
        }

        // Default is rolling 30 days. When a season is scoped, use the season window.
        if ($seasonstart !== null && $seasonend !== null) {
            $cutoff   = $seasonstart;
            $rangeend = min($seasonend, time());
        } else {
            $period = 30;
            $cutoff = time() - $period * DAYSECS;
            $rangeend = time();
        }

        // 1. Academic Performance (grade_grades & grade_items)
        $sql_grades = "SELECT gi.id, gi.courseid, c.fullname AS coursename, gi.itemname, 
                              gg.finalgrade, gi.grademin, gi.grademax
                         FROM {grade_grades} gg
                         JOIN {grade_items} gi ON gi.id = gg.itemid
                         JOIN {course} c ON c.id = gi.courseid
                        WHERE gg.userid = :userid
                          AND gi.itemtype = 'course'
                          AND gg.finalgrade IS NOT NULL";
        
        $grades = $DB->get_records_sql($sql_grades, ['userid' => $studentid]);
        
        $total_percentage = 0;
        $course_count = 0;
        $weak_subjects = [];
        $strong_subjects = [];

        foreach ($grades as $g) {
            $range = $g->grademax - $g->grademin;
            if ($range > 0) {
                // Calculate percentage based on min and max
                $percentage = (($g->finalgrade - $g->grademin) / $range) * 100;
                $percentage = round($percentage, 1);
                
                $report['grades'][] = [
                    'course' => format_string($g->coursename),
                    'grade' => $percentage
                ];

                $total_percentage += $percentage;
                $course_count++;

                if ($percentage < 50) {
                    $weak_subjects[] = format_string($g->coursename);
                } else if ($percentage >= 80) {
                    $strong_subjects[] = format_string($g->coursename);
                }
            }
        }

        if ($course_count > 0) {
            $report['average'] = round($total_percentage / $course_count, 1);
        }

        // Alternative grades if course grades are empty -> use mod grades
        if (empty($report['grades'])) {
            $sql_mod_grades = "SELECT gi.courseid, c.fullname AS coursename, 
                                      AVG(CASE WHEN (gi.grademax - gi.grademin) > 0 THEN ((gg.finalgrade - gi.grademin) / (gi.grademax - gi.grademin)) * 100 ELSE 0 END) AS avg_pct
                                 FROM {grade_grades} gg
                                 JOIN {grade_items} gi ON gi.id = gg.itemid
                                 JOIN {course} c ON c.id = gi.courseid
                                WHERE gg.userid = :userid
                                  AND gi.itemtype = 'mod'
                                  AND gg.finalgrade IS NOT NULL
                             GROUP BY gi.courseid, c.fullname";
            $mod_grades = $DB->get_records_sql($sql_mod_grades, ['userid' => $studentid]);
            $course_count = 0;
            $total_percentage = 0;
            foreach ($mod_grades as $mg) {
                $pct = round((float)$mg->avg_pct, 1);
                $report['grades'][] = [
                    'course' => format_string($mg->coursename),
                    'grade' => $pct
                ];
                $total_percentage += $pct;
                $course_count++;

                if ($pct < 50) {
                    $weak_subjects[] = format_string($mg->coursename);
                } else if ($pct >= 80) {
                    $strong_subjects[] = format_string($mg->coursename);
                }
            }
            if ($course_count > 0) {
                $report['average'] = round($total_percentage / $course_count, 1);
            }
        }

        // 2. Progress Tracking
        // Course completion
        $comp_total = (int)$DB->count_records('course_completions', ['userid' => $studentid]);
        $comp_done = (int)$DB->count_records_select('course_completions', 'userid = :uid AND timecompleted IS NOT NULL AND timecompleted > 0', ['uid' => $studentid]);
        $report['progress']['course_completion_rate'] = $comp_total > 0 ? round(($comp_done / $comp_total) * 100, 1) : 0;

        // Activity completion
        $act_comp_state = $DB->get_record_sql(
            "SELECT COUNT(1) AS total, SUM(CASE WHEN completionstate > 0 THEN 1 ELSE 0 END) AS completed
               FROM {course_modules_completion}
              WHERE userid = :userid",
            ['userid' => $studentid]
        );
        $report['progress']['activities_total'] = $act_comp_state ? (int)$act_comp_state->total : 0;
        $report['progress']['activities_completed'] = $act_comp_state ? (int)$act_comp_state->completed : 0;

        // 3. Activity & Engagement
        $logins = 0;
        $submissions = 0;
        $time_spent_weighted = 0;
        
        try {
            $logins = (int)$DB->count_records_sql(
                "SELECT COUNT(1) FROM {logstore_standard_log}
                  WHERE userid = :uid AND action = 'loggedin' AND timecreated >= :cutoff AND timecreated <= :rangeend",
                ['uid' => $studentid, 'cutoff' => $cutoff, 'rangeend' => $rangeend]
            );

            // Time spent pseudo-calculation from logs (unique hours they executed actions)
            $time_spent_weighted = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT FLOOR(timecreated / 3600))
                   FROM {logstore_standard_log}
                  WHERE userid = :uid AND timecreated >= :cutoff AND timecreated <= :rangeend",
                ['uid' => $studentid, 'cutoff' => $cutoff, 'rangeend' => $rangeend]
            );

            // Submissions proxy. Logs where action = 'submitted' or target = 'submission'
            $submissions = (int)$DB->count_records_sql(
                "SELECT COUNT(1) FROM {logstore_standard_log}
                  WHERE userid = :uid AND (action = 'submitted' OR target = 'submission')
                    AND timecreated >= :cutoff AND timecreated <= :rangeend",
                ['uid' => $studentid, 'cutoff' => $cutoff, 'rangeend' => $rangeend]
            );

            // Distribute activity distribution for chart (past 4 weeks)
            for ($i = 3; $i >= 0; $i--) {
                $wstart = strtotime("-" . ($i + 1) . " weeks");
                $wend = strtotime("-{$i} weeks");
                $wcount = (int)$DB->count_records_sql(
                    "SELECT COUNT(1) FROM {logstore_standard_log}
                      WHERE userid = :uid AND timecreated >= :wstart AND timecreated < :wend",
                    ['uid' => $studentid, 'wstart' => $wstart, 'wend' => $wend]
                );
                $report['trend_data'][] = [
                    'label' => 'Week ' . (4 - $i),
                    'value' => $wcount
                ];
            }
        } catch (\Exception $e) {
            // Logging store might not be standard.
        }

        $report['engagement']['logins'] = $logins;
        $report['engagement']['submissions'] = $submissions;
        $report['engagement']['time_spent_weighted'] = $time_spent_weighted;

        // Engagement Score Formula Calculation — denominator is the actual
        // window length in days (so per-season reports remain comparable to
        // the 30-day rolling default).
        $windowdays = max(1, (int)round(($rangeend - $cutoff) / DAYSECS));
        $engagement_score = ($logins + $submissions + $time_spent_weighted) / $windowdays;
        $report['engagement']['score'] = round($engagement_score, 2);

        // 4. Error & Learning Insights (Smart Layer)
        if (!empty($weak_subjects)) {
            $report['insights'][] = [
                'type' => 'warning',
                'message' => get_string('insight_weak_subjects', 'local_istikama_admin',
                    implode(', ', array_slice($weak_subjects, 0, 2))),
            ];
        }
        if (!empty($strong_subjects)) {
            $report['insights'][] = [
                'type' => 'positive',
                'message' => get_string('insight_strong_subjects', 'local_istikama_admin',
                    implode(', ', array_slice($strong_subjects, 0, 2))),
            ];
        }

        if ($engagement_score < 0.5) {
            $report['insights'][] = [
                'type' => 'info',
                'message' => get_string('insight_low_engagement', 'local_istikama_admin'),
            ];
        } else if ($engagement_score >= 1.5) {
            $report['insights'][] = [
                'type' => 'positive',
                'message' => get_string('insight_high_engagement', 'local_istikama_admin'),
            ];
        }

        if ($report['progress']['activities_total'] > 0) {
            $progress_pct = ($report['progress']['activities_completed'] / $report['progress']['activities_total']) * 100;
            if ($progress_pct < 20) {
                $report['insights'][] = [
                    'type' => 'warning',
                    'message' => get_string('insight_incomplete', 'local_istikama_admin'),
                ];
            }
        }

        if (empty($report['insights'])) {
            $report['insights'][] = [
                'type' => 'info',
                'message' => get_string('insight_default', 'local_istikama_admin'),
            ];
        }

        return $report;
    }
}
