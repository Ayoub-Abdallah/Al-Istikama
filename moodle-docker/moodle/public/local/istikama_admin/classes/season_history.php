<?php
// This file is part of Moodle - http://moodle.org/

namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

/**
 * Season-scoped read helpers for historical academic data.
 *
 * The plugin's data is moving towards being season-stamped (see Phase 2).
 * Rows with a NULL seasonid are pre-Seasons "legacy" data — these helpers
 * surface that as a synthetic "legacy" entry when listing per-student history.
 */
class season_history {

    /**
     * List every season a student has data in (enrollment, attendance,
     * or assessment), most-recent first.
     *
     * Returns an array of {seasonid, season} where seasonid==0 means
     * un-stamped legacy data.
     */
    public static function get_student_seasons(int $studentid): array {
        global $DB;

        $sql = "SELECT DISTINCT seasonid FROM (
                    SELECT seasonid FROM {istikama_user_school} WHERE userid = :u1 AND role = 'student'
                    UNION ALL
                    SELECT seasonid FROM {istikama_attendance}  WHERE studentid = :u2
                    UNION ALL
                    SELECT seasonid FROM {istikama_assessments} WHERE studentid = :u3
                ) src";
        $rows = $DB->get_records_sql($sql, ['u1' => $studentid, 'u2' => $studentid, 'u3' => $studentid]);

        $result = [];
        foreach ($rows as $r) {
            $sid = (int)$r->seasonid;
            if ($sid === 0) {
                $result[0] = (object)[
                    'seasonid' => 0,
                    'season'   => (object)[
                        'id'         => 0,
                        'name'       => get_string('legacy_season_label', 'local_istikama_admin'),
                        'status'     => 'archived',
                        'start_date' => 0,
                        'end_date'   => 0,
                    ],
                ];
            } else {
                $season = season_manager::get($sid);
                if ($season) {
                    $result[$sid] = (object)[
                        'seasonid' => $sid,
                        'season'   => $season,
                    ];
                }
            }
        }

        // Order: legacy last, others by start_date DESC.
        uasort($result, function($a, $b) {
            if ($a->seasonid === 0) return 1;
            if ($b->seasonid === 0) return -1;
            return ((int)$b->season->start_date) - ((int)$a->season->start_date);
        });
        return $result;
    }

    /**
     * Summary stats for a student for a given season.
     *
     * @param int $studentid
     * @param int $seasonid 0 = legacy (NULL seasonid)
     * @return object {attendance_days, present, absent, late, excused, assessments, avg_score, class_name}
     */
    public static function get_student_season_summary(int $studentid, int $seasonid): object {
        global $DB;

        $sidsql = $seasonid > 0 ? 'seasonid = :sid' : 'seasonid IS NULL';
        $params = $seasonid > 0 ? ['u' => $studentid, 'sid' => $seasonid] : ['u' => $studentid];

        // Attendance counts.
        $att = $DB->get_record_sql(
            "SELECT
                COUNT(*) AS total,
                SUM(CASE WHEN status = 'present' THEN 1 ELSE 0 END) AS present,
                SUM(CASE WHEN status = 'absent'  THEN 1 ELSE 0 END) AS absent,
                SUM(CASE WHEN status = 'late'    THEN 1 ELSE 0 END) AS late,
                SUM(CASE WHEN status = 'excused' THEN 1 ELSE 0 END) AS excused
               FROM {istikama_attendance}
              WHERE studentid = :u AND $sidsql",
            $params
        );

        // Assessment count + average normalized score.
        $params2 = $params;
        $assess = $DB->get_record_sql(
            "SELECT
                COUNT(*) AS cnt,
                AVG(CASE WHEN max_score > 0 THEN (score / max_score) * 100 ELSE NULL END) AS avg_pct
               FROM {istikama_assessments}
              WHERE studentid = :u AND $sidsql",
            $params2
        );

        // Class name from most recent enrollment row for this season.
        $classname = '';
        $enrol = $DB->get_record_sql(
            "SELECT cc.name
               FROM {istikama_user_school} us
               JOIN {course_categories} cc ON cc.id = us.classid
              WHERE us.userid = :u AND us.role = 'student' AND $sidsql
           ORDER BY us.timecreated DESC",
            $params, IGNORE_MULTIPLE
        );
        if ($enrol) {
            $classname = $enrol->name;
        }

        return (object)[
            'attendance_days' => (int)($att->total ?? 0),
            'present'         => (int)($att->present ?? 0),
            'absent'          => (int)($att->absent ?? 0),
            'late'            => (int)($att->late ?? 0),
            'excused'         => (int)($att->excused ?? 0),
            'assessments'     => (int)($assess->cnt ?? 0),
            'avg_score'       => isset($assess->avg_pct) ? round((float)$assess->avg_pct, 1) : null,
            'class_name'      => $classname,
        ];
    }

    /**
     * Full assessment rows for student in a given season.
     */
    public static function get_assessments(int $studentid, int $seasonid): array {
        global $DB;
        $sidsql = $seasonid > 0 ? 'seasonid = :sid' : 'seasonid IS NULL';
        $params = $seasonid > 0 ? ['u' => $studentid, 'sid' => $seasonid] : ['u' => $studentid];
        return $DB->get_records_sql(
            "SELECT * FROM {istikama_assessments}
              WHERE studentid = :u AND $sidsql
           ORDER BY timecreated DESC",
            $params
        );
    }

    /**
     * Full attendance rows for a student in a given season.
     */
    public static function get_attendance(int $studentid, int $seasonid): array {
        global $DB;
        $sidsql = $seasonid > 0 ? 'seasonid = :sid' : 'seasonid IS NULL';
        $params = $seasonid > 0 ? ['u' => $studentid, 'sid' => $seasonid] : ['u' => $studentid];
        return $DB->get_records_sql(
            "SELECT * FROM {istikama_attendance}
              WHERE studentid = :u AND $sidsql
           ORDER BY attend_date DESC, timecreated DESC",
            $params
        );
    }

    /**
     * Promotion history rows for a student across seasons.
     */
    public static function get_promotion_log(int $studentid): array {
        global $DB;
        return $DB->get_records('istikama_season_promotion',
            ['studentid' => $studentid], 'timecreated ASC');
    }

    // ─────────────────────────────────────────────────────────────────────────
    // Teacher equivalents
    // ─────────────────────────────────────────────────────────────────────────

    /**
     * List every season a teacher has data in (assignment, activity, or subject).
     * Returns the same shape as get_student_seasons().
     */
    public static function get_teacher_seasons(int $teacherid): array {
        global $DB;

        $sql = "SELECT DISTINCT seasonid FROM (
                    SELECT seasonid FROM {istikama_user_school}        WHERE userid = :u1 AND role IN ('teacher','manager')
                    UNION ALL
                    SELECT seasonid FROM {istikama_teacher_activities} WHERE created_by = :u2
                    UNION ALL
                    SELECT ts.seasonid
                      FROM {istikama_teacher_subject} ts
                      JOIN {istikama_user_school} us ON us.id = ts.assignmentid
                     WHERE us.userid = :u3
                ) src";
        $rows = $DB->get_records_sql($sql, ['u1' => $teacherid, 'u2' => $teacherid, 'u3' => $teacherid]);

        $result = [];
        foreach ($rows as $r) {
            $sid = (int)$r->seasonid;
            if ($sid === 0) {
                $result[0] = (object)[
                    'seasonid' => 0,
                    'season'   => (object)[
                        'id'         => 0,
                        'name'       => get_string('legacy_season_label', 'local_istikama_admin'),
                        'status'     => 'archived',
                        'start_date' => 0,
                        'end_date'   => 0,
                    ],
                ];
            } else {
                $season = season_manager::get($sid);
                if ($season) {
                    $result[$sid] = (object)[
                        'seasonid' => $sid,
                        'season'   => $season,
                    ];
                }
            }
        }

        uasort($result, function($a, $b) {
            if ($a->seasonid === 0) return 1;
            if ($b->seasonid === 0) return -1;
            return ((int)$b->season->start_date) - ((int)$a->season->start_date);
        });
        return $result;
    }

    /**
     * Summary stats for a teacher in a given season.
     *
     * Returns: classes_count, subjects, activities_count, attendance_recorded, assessments_recorded
     */
    public static function get_teacher_season_summary(int $teacherid, int $seasonid): object {
        global $DB;
        $sidsql = $seasonid > 0 ? 'seasonid = :sid' : 'seasonid IS NULL';
        $params = $seasonid > 0 ? ['u' => $teacherid, 'sid' => $seasonid] : ['u' => $teacherid];

        // Distinct classes assigned.
        $classes = $DB->get_records_sql(
            "SELECT DISTINCT classid FROM {istikama_user_school}
              WHERE userid = :u AND role IN ('teacher','manager') AND classid IS NOT NULL AND $sidsql",
            $params
        );

        // Subjects taught.
        $subparams = $params;
        $subjects = $DB->get_records_sql(
            "SELECT DISTINCT ts.subject
               FROM {istikama_teacher_subject} ts
               JOIN {istikama_user_school} us ON us.id = ts.assignmentid
              WHERE us.userid = :u AND " . ($seasonid > 0 ? 'ts.seasonid = :sid' : 'ts.seasonid IS NULL'),
            $subparams
        );
        $subjectlist = array_map(fn($r) => (string)$r->subject, $subjects);

        // Activities authored.
        $actparams = $seasonid > 0 ? ['u' => $teacherid, 'sid' => $seasonid] : ['u' => $teacherid];
        $activities = $DB->get_record_sql(
            "SELECT COUNT(*) AS cnt FROM {istikama_teacher_activities}
              WHERE created_by = :u AND " . ($seasonid > 0 ? 'seasonid = :sid' : 'seasonid IS NULL'),
            $actparams
        );

        // Attendance / assessment events recorded by this teacher.
        $attparams = $seasonid > 0 ? ['u' => $teacherid, 'sid' => $seasonid] : ['u' => $teacherid];
        $att = $DB->get_record_sql(
            "SELECT COUNT(*) AS cnt FROM {istikama_attendance}
              WHERE recorded_by = :u AND " . ($seasonid > 0 ? 'seasonid = :sid' : 'seasonid IS NULL'),
            $attparams
        );
        $assess = $DB->get_record_sql(
            "SELECT COUNT(*) AS cnt FROM {istikama_assessments}
              WHERE assessed_by = :u AND " . ($seasonid > 0 ? 'seasonid = :sid' : 'seasonid IS NULL'),
            $attparams
        );

        return (object)[
            'classes_count'        => count($classes),
            'subjects'             => $subjectlist,
            'activities_count'     => (int)($activities->cnt ?? 0),
            'attendance_recorded'  => (int)($att->cnt ?? 0),
            'assessments_recorded' => (int)($assess->cnt ?? 0),
        ];
    }

    /**
     * Detailed class assignments for a teacher in a given season.
     * Returns rows with classid, class_name, level_name, school_name.
     */
    public static function get_teacher_classes(int $teacherid, int $seasonid): array {
        global $DB;
        $sidsql = $seasonid > 0 ? 'us.seasonid = :sid' : 'us.seasonid IS NULL';
        $params = $seasonid > 0 ? ['u' => $teacherid, 'sid' => $seasonid] : ['u' => $teacherid];
        return $DB->get_records_sql(
            "SELECT us.id AS rowid, us.classid, us.levelid, us.schoolid,
                    cc.name AS class_name, lc.name AS level_name, sc.name AS school_name,
                    us.timecreated
               FROM {istikama_user_school} us
          LEFT JOIN {course_categories} cc ON cc.id = us.classid
          LEFT JOIN {course_categories} lc ON lc.id = us.levelid
          LEFT JOIN {course_categories} sc ON sc.id = us.schoolid
              WHERE us.userid = :u
                AND us.role IN ('teacher','manager')
                AND $sidsql
           ORDER BY us.timecreated DESC",
            $params
        );
    }

    /**
     * Activities authored by a teacher in a given season.
     */
    public static function get_teacher_activities(int $teacherid, int $seasonid): array {
        global $DB;
        $sidsql = $seasonid > 0 ? 'seasonid = :sid' : 'seasonid IS NULL';
        $params = $seasonid > 0 ? ['u' => $teacherid, 'sid' => $seasonid] : ['u' => $teacherid];
        return $DB->get_records_sql(
            "SELECT * FROM {istikama_teacher_activities}
              WHERE created_by = :u AND $sidsql
           ORDER BY timecreated DESC",
            $params
        );
    }
}
