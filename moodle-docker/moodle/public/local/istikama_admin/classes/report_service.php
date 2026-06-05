<?php
// This file is part of Moodle - http://moodle.org/
defined('MOODLE_INTERNAL') || die();

/**
 * Reporting service for the Istikama admin plugin.
 * All methods return computed data (averages, percentages, trends) — not raw rows.
 */
class local_istikama_admin_report_service {

    /**
     * Currently-selected season scope for all reads.
     *
     *    0  — no filter (every season, plus legacy NULL rows)
     *   >0  — strict to season N
     *   -1  — legacy NULL rows only
     */
    private static int $seasonid = 0;

    /**
     * Set the season scope used by every report query below.
     * Called from reports.php once per request.
     */
    public static function set_seasonid(int $sid): void {
        self::$seasonid = $sid;
    }

    /**
     * Current season scope (read-only accessor for templates).
     */
    public static function get_seasonid(): int {
        return self::$seasonid;
    }

    /**
     * Build a SQL fragment + params for the current season scope on an
     * istikama_* table with a `seasonid` column.
     */
    private static function season_where(string $alias = '', string $paramname = 'rptseason'): array {
        // IMPORTANT: param names must start with a letter — Moodle's named-param
        // parser silently skips names that start with underscore, leaving the
        // literal ":__name" in the SQL and producing "Error reading from database".
        return local_istikama_admin_season_where_sql(self::$seasonid, $alias, $paramname);
    }

    // ═══════════════════════════════════════════════════════════
    //  ADMIN / SYSTEM-WIDE REPORTS
    // ═══════════════════════════════════════════════════════════

    /**
     * System-wide KPI summary.
     */
    public static function get_system_kpis(): array {
        global $DB;
        $cutoff30 = time() - 30 * DAYSECS;

        $activeusers = (int)$DB->count_records_select('user',
            'deleted = 0 AND suspended = 0 AND lastaccess >= :cutoff',
            ['cutoff' => $cutoff30]);

        $totalusers = (int)$DB->count_records_select('user',
            'deleted = 0 AND suspended = 0 AND id > 1');

        $totalcourses = (int)$DB->count_records_select('course',
            'id <> :siteid', ['siteid' => SITEID]);

        $completiontotal = (int)$DB->count_records('course_completions');
        $completiondone = (int)$DB->count_records_select('course_completions',
            'timecompleted IS NOT NULL AND timecompleted > 0');
        $completionrate = $completiontotal > 0
            ? round(($completiondone / $completiontotal) * 100, 1) : 0;

        $fileusage = 0;
        try {
            $fileusage = (int)$DB->count_records('istikama_content_bank');
        } catch (\Exception $e) {}

        // Engagement score: (logins_30d + quiz_attempts_30d) / active_users.
        $logins30 = 0;
        try {
            $logins30 = (int)$DB->count_records_sql(
                "SELECT COUNT(1) FROM {logstore_standard_log}
                  WHERE action = 'loggedin' AND timecreated >= :cutoff",
                ['cutoff' => $cutoff30]);
        } catch (\Exception $e) {}

        $quizattempts30 = 0;
        try {
            $quizattempts30 = (int)$DB->count_records_sql(
                "SELECT COUNT(1) FROM {quiz_attempts}
                  WHERE timestart >= :cutoff",
                ['cutoff' => $cutoff30]);
        } catch (\Exception $e) {}

        $engagement = $activeusers > 0
            ? round(($logins30 + $quizattempts30) / $activeusers, 1) : 0;

        return [
            'active_users'    => $activeusers,
            'total_users'     => $totalusers,
            'total_courses'   => $totalcourses,
            'completion_rate' => $completionrate,
            'file_usage'      => $fileusage,
            'engagement'      => $engagement,
            'logins_30d'      => $logins30,
            'quiz_attempts_30d' => $quizattempts30,
        ];
    }

    /**
     * Daily login trend for the last N days.
     */
    public static function get_login_trend(int $days = 14): array {
        global $DB;
        $result = [];
        try {
            for ($i = $days - 1; $i >= 0; $i--) {
                $daystart = strtotime("-{$i} days midnight");
                $dayend = $daystart + DAYSECS;
                $count = (int)$DB->count_records_sql(
                    "SELECT COUNT(DISTINCT userid) FROM {logstore_standard_log}
                      WHERE action = 'loggedin'
                        AND timecreated >= :start AND timecreated < :end",
                    ['start' => $daystart, 'end' => $dayend]);
                $result[] = [
                    'label' => date('M d', $daystart),
                    'value' => $count,
                ];
            }
        } catch (\Exception $e) {
            // logstore may not exist.
        }
        return $result;
    }

    /**
     * Top schools ranked by user count + completion rate.
     */
    public static function get_school_rankings(int $limit = 10): array {
        global $DB;
        $schools = [];
        try {
            [$swhere, $sparams] = self::season_where('us');
            $sql = "SELECT us.schoolid, COUNT(DISTINCT us.userid) AS user_count
                      FROM {istikama_user_school} us
                     WHERE 1=1 $swhere
                  GROUP BY us.schoolid
                  ORDER BY user_count DESC";
            $rows = $DB->get_records_sql($sql, $sparams, 0, $limit);

            foreach ($rows as $row) {
                $schoolname = '';
                try {
                    $cat = \core_course_category::get($row->schoolid);
                    $schoolname = format_string($cat->name);
                } catch (\Exception $e) {
                    continue;
                }

                // Get category tree for completion calc.
                $allcatids = [(int)$row->schoolid];
                try {
                    $cat = \core_course_category::get($row->schoolid);
                    foreach ($cat->get_children() as $level) {
                        $allcatids[] = (int)$level->id;
                        foreach ($level->get_children() as $class) {
                            $allcatids[] = (int)$class->id;
                        }
                    }
                } catch (\Exception $e) {}

                $comprate = 0;
                if (!empty($allcatids)) {
                    [$insql, $params] = $DB->get_in_or_equal($allcatids, SQL_PARAMS_NAMED);
                    $total = (int)$DB->count_records_sql(
                        "SELECT COUNT(1) FROM {course_completions} cc
                           JOIN {course} c ON c.id = cc.course
                          WHERE c.category $insql", $params);
                    $done = (int)$DB->count_records_sql(
                        "SELECT COUNT(1) FROM {course_completions} cc
                           JOIN {course} c ON c.id = cc.course
                          WHERE c.category $insql
                            AND cc.timecompleted IS NOT NULL AND cc.timecompleted > 0", $params);
                    $comprate = $total > 0 ? round(($done / $total) * 100, 1) : 0;
                }

                $schools[] = [
                    'schoolid'        => (int)$row->schoolid,
                    'name'            => $schoolname,
                    'user_count'      => (int)$row->user_count,
                    'completion_rate' => $comprate,
                ];
            }
        } catch (\Exception $e) {}
        return $schools;
    }

    /**
     * Content bank statistics: by type, by status, upload trend.
     */
    public static function get_content_stats(): array {
        global $DB;
        $result = [
            'by_type' => [],
            'by_status' => [],
            'upload_trend' => [],
            'total' => 0,
        ];
        try {
            // By type.
            $types = $DB->get_records_sql(
                "SELECT content_type, COUNT(1) AS cnt
                   FROM {istikama_content_bank} GROUP BY content_type ORDER BY cnt DESC");
            foreach ($types as $t) {
                $result['by_type'][] = ['label' => $t->content_type, 'value' => (int)$t->cnt];
            }

            // By status.
            $statuses = $DB->get_records_sql(
                "SELECT status, COUNT(1) AS cnt
                   FROM {istikama_content_bank} GROUP BY status ORDER BY cnt DESC");
            foreach ($statuses as $s) {
                $result['by_status'][] = ['label' => $s->status, 'value' => (int)$s->cnt];
            }

            // Upload trend (last 14 days).
            for ($i = 13; $i >= 0; $i--) {
                $daystart = strtotime("-{$i} days midnight");
                $dayend = $daystart + DAYSECS;
                $cnt = (int)$DB->count_records_sql(
                    "SELECT COUNT(1) FROM {istikama_content_bank}
                      WHERE timecreated >= :start AND timecreated < :end",
                    ['start' => $daystart, 'end' => $dayend]);
                $result['upload_trend'][] = ['label' => date('M d', $daystart), 'value' => $cnt];
            }

            $result['total'] = (int)$DB->count_records('istikama_content_bank');
        } catch (\Exception $e) {}
        return $result;
    }

    // ═══════════════════════════════════════════════════════════
    //  TEACHER REPORTS
    // ═══════════════════════════════════════════════════════════

    /**
     * Teacher KPIs: classes taught, total students, avg attendance, avg grade.
     */
    public static function get_teacher_kpis(int $teacherid): array {
        global $DB;

        // Classes for this teacher in the current season scope.
        $teacherwhere = ['userid' => $teacherid, 'role' => 'teacher'];
        if (self::$seasonid > 0) {
            $teacherwhere['seasonid'] = self::$seasonid;
        }
        $assignments = $DB->get_records('istikama_user_school', $teacherwhere);
        // If the season scope yields no teaching rows, fall back to global so
        // legacy (NULL seasonid) data still shows.
        if (empty($assignments) && self::$seasonid > 0) {
            $assignments = $DB->get_records('istikama_user_school',
                ['userid' => $teacherid, 'role' => 'teacher', 'seasonid' => null]);
        }
        $classids = [];
        foreach ($assignments as $a) {
            if ($a->classid && !in_array((int)$a->classid, $classids)) {
                $classids[] = (int)$a->classid;
            }
        }

        // Students in those classes.
        $totalstudents = 0;
        if (!empty($classids)) {
            [$insql, $params] = $DB->get_in_or_equal($classids, SQL_PARAMS_NAMED);
            [$swhere, $sparams] = self::season_where('');
            $totalstudents = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT userid) FROM {istikama_user_school}
                  WHERE classid $insql AND role = 'student' $swhere",
                array_merge($params, $sparams));
        }

        // Average attendance rate across teacher's classes (season-scoped).
        $avgattendance = 0;
        if (!empty($classids)) {
            [$insql, $params] = $DB->get_in_or_equal($classids, SQL_PARAMS_NAMED);
            [$swhere, $sparams] = self::season_where('');
            $allparams = array_merge($params, $sparams);
            $totalrecords = (int)$DB->count_records_sql(
                "SELECT COUNT(1) FROM {istikama_attendance} WHERE classid $insql $swhere", $allparams);
            $presentrecords = (int)$DB->count_records_sql(
                "SELECT COUNT(1) FROM {istikama_attendance}
                  WHERE classid $insql AND status = 'present' $swhere", $allparams);
            $avgattendance = $totalrecords > 0
                ? round(($presentrecords / $totalrecords) * 100, 1) : 0;
        }

        // Average assessment grade across teacher's classes (season-scoped).
        $avggrade = 0;
        if (!empty($classids)) {
            [$insql, $params] = $DB->get_in_or_equal($classids, SQL_PARAMS_NAMED);
            [$swhere, $sparams] = self::season_where('');
            $gradedata = $DB->get_record_sql(
                "SELECT AVG(CASE WHEN max_score > 0 THEN (score / max_score) * 100 ELSE 0 END) AS avg_pct
                   FROM {istikama_assessments}
                  WHERE classid $insql AND score IS NOT NULL AND max_score > 0 $swhere",
                array_merge($params, $sparams));
            $avggrade = $gradedata ? round((float)$gradedata->avg_pct, 1) : 0;
        }

        // Content uploaded by this teacher.
        $contentcount = 0;
        try {
            $contentcount = (int)$DB->count_records('istikama_content_bank',
                ['uploaded_by' => $teacherid]);
        } catch (\Exception $e) {}

        return [
            'classes_count'   => count($classids),
            'students_count'  => $totalstudents,
            'avg_attendance'  => $avgattendance,
            'avg_grade'       => $avggrade,
            'content_count'   => $contentcount,
            'classids'        => $classids,
        ];
    }

    /**
     * Student performance table for teacher's classes.
     */
    public static function get_teacher_student_summary(int $teacherid): array {
        global $DB;
        $kpis = self::get_teacher_kpis($teacherid);
        $classids = $kpis['classids'];
        if (empty($classids)) return [];

        [$insql, $params] = $DB->get_in_or_equal($classids, SQL_PARAMS_NAMED);
        [$swhere, $sparams] = self::season_where('us');
        $sql = "SELECT us.userid, u.firstname, u.lastname, u.email, u.lastaccess,
                       us.classid, cc.name AS classname
                  FROM {istikama_user_school} us
                  JOIN {user} u ON u.id = us.userid AND u.deleted = 0
                  JOIN {course_categories} cc ON cc.id = us.classid
                 WHERE us.classid $insql AND us.role = 'student' $swhere
              ORDER BY cc.name, u.lastname, u.firstname";
        $students = $DB->get_records_sql($sql, array_merge($params, $sparams));

        $result = [];
        foreach ($students as $s) {
            $sid = (int)$s->userid;
            $cid = (int)$s->classid;

            // Attendance rate for this student in this class (season-scoped).
            [$attwhere, $attparams] = self::season_where('');
            $aparams = array_merge(['sid' => $sid, 'cid' => $cid], $attparams);
            $atotal = (int)$DB->count_records_sql(
                "SELECT COUNT(1) FROM {istikama_attendance} WHERE studentid = :sid AND classid = :cid $attwhere",
                $aparams);
            $apresent = (int)$DB->count_records_sql(
                "SELECT COUNT(1) FROM {istikama_attendance} WHERE studentid = :sid AND classid = :cid AND status = 'present' $attwhere",
                $aparams);
            $attrate = $atotal > 0 ? round(($apresent / $atotal) * 100, 1) : 0;

            // Average grade for this student in this class (season-scoped).
            $gdata = $DB->get_record_sql(
                "SELECT AVG(CASE WHEN max_score > 0 THEN (score / max_score) * 100 ELSE 0 END) AS avg_pct
                   FROM {istikama_assessments}
                  WHERE studentid = :sid AND classid = :cid AND score IS NOT NULL AND max_score > 0 $attwhere",
                $aparams);
            $avgg = $gdata ? round((float)$gdata->avg_pct, 1) : 0;

            $result[] = [
                'name'       => fullname($s),
                'email'      => $s->email,
                'classname'  => format_string($s->classname),
                'attendance' => $attrate,
                'avg_grade'  => $avgg,
                'lastaccess' => !empty($s->lastaccess) ? userdate($s->lastaccess) : '-',
            ];
        }
        return $result;
    }

    /**
     * Lesson engagement data for teacher's classes.
     */
    public static function get_teacher_lesson_engagement(int $teacherid): array {
        global $DB;
        $kpis = self::get_teacher_kpis($teacherid);
        $classids = $kpis['classids'];
        if (empty($classids)) return [];

        $lessons = [];
        foreach ($classids as $cid) {
            $classname = '';
            try {
                $cat = \core_course_category::get($cid);
                $classname = format_string($cat->name);
                $courses = $cat->get_courses();
                foreach ($courses as $course) {
                    // Content linked to this course.
                    $linkedcontent = 0;
                    try {
                        $linkedcontent = (int)$DB->count_records('istikama_content_lesson_link',
                            ['courseid' => $course->id, 'classid' => $cid]);
                    } catch (\Exception $e) {}

                    // Enrolled students.
                    $ctx = \context_course::instance($course->id, IGNORE_MISSING);
                    $enrolled = $ctx ? count_enrolled_users($ctx) : 0;

                    // Completion rate.
                    $comptotal = (int)$DB->count_records('course_completions',
                        ['course' => $course->id]);
                    $compdone = (int)$DB->count_records_select('course_completions',
                        'course = :crs AND timecompleted IS NOT NULL AND timecompleted > 0',
                        ['crs' => $course->id]);
                    $comprate = $comptotal > 0
                        ? round(($compdone / $comptotal) * 100, 1) : 0;

                    $lessons[] = [
                        'classname'      => $classname,
                        'lesson_name'    => format_string($course->fullname),
                        'linked_content' => $linkedcontent,
                        'enrolled'       => $enrolled,
                        'completion_rate' => $comprate,
                    ];
                }
            } catch (\Exception $e) {}
        }
        return $lessons;
    }

    // ═══════════════════════════════════════════════════════════
    //  SCHOOL MANAGER REPORTS
    // ═══════════════════════════════════════════════════════════

    /**
     * School Manager KPIs
     */
    public static function get_school_kpis(int $schoolid): array {
        global $DB;
        $cutoff30 = time() - 30 * DAYSECS;

        // Total teachers / students (season-scoped).
        [$swhere, $sparams] = self::season_where('');
        $totalteachers = (int)$DB->count_records_sql(
            "SELECT COUNT(1) FROM {istikama_user_school}
              WHERE schoolid = :sid AND role = 'teacher' $swhere",
            array_merge(['sid' => $schoolid], $sparams));
        $totalstudents = (int)$DB->count_records_sql(
            "SELECT COUNT(1) FROM {istikama_user_school}
              WHERE schoolid = :sid AND role = 'student' $swhere",
            array_merge(['sid' => $schoolid], $sparams));

        // Active users (last 30 days)
        $activeusers = (int)$DB->count_records_sql(
            "SELECT COUNT(DISTINCT u.id)
               FROM {user} u
               JOIN {istikama_user_school} us ON us.userid = u.id
              WHERE us.schoolid = :sid AND u.deleted = 0 AND u.lastaccess >= :cutoff",
            ['sid' => $schoolid, 'cutoff' => $cutoff30]
        );

        // Content items
        $contenttotal = 0;
        try {
            $school_userids_sql = "SELECT userid FROM {istikama_user_school} WHERE schoolid = :sid";
            $contenttotal = (int)$DB->count_records_sql(
                "SELECT COUNT(1) FROM {istikama_content_bank} cb
                  WHERE cb.uploaded_by IN ($school_userids_sql)",
                ['sid' => $schoolid]
            );
        } catch (\Exception $e) {}

        return [
            'total_teachers' => $totalteachers,
            'total_students' => $totalstudents,
            'active_users'   => $activeusers,
            'total_content'  => $contenttotal
        ];
    }

    /**
     * Login trend for school over the last 14 days
     */
    public static function get_school_login_trend(int $schoolid, int $days = 14): array {
        global $DB;
        $result = [];
        try {
            for ($i = $days - 1; $i >= 0; $i--) {
                $daystart = strtotime("-{$i} days midnight");
                $dayend = $daystart + DAYSECS;
                $count = (int)$DB->count_records_sql(
                    "SELECT COUNT(DISTINCT log.userid) 
                       FROM {logstore_standard_log} log
                       JOIN {istikama_user_school} us ON us.userid = log.userid
                      WHERE log.action = 'loggedin'
                        AND us.schoolid = :sid
                        AND log.timecreated >= :start AND log.timecreated < :end",
                    ['sid' => $schoolid, 'start' => $daystart, 'end' => $dayend]);
                $result[] = [
                    'label' => date('M d', $daystart),
                    'value' => $count,
                ];
            }
        } catch (\Exception $e) {}
        return $result;
    }

    /**
     * Get Teacher activity for a school
     */
    public static function get_school_teacher_activity(int $schoolid): array {
        global $DB;
        $teachers = [];
        try {
            $sql = "SELECT u.id, u.firstname, u.lastname, u.email, u.lastaccess,
                           (SELECT COUNT(1) FROM {istikama_content_bank} cb WHERE cb.uploaded_by = u.id) AS upload_count
                      FROM {user} u
                      JOIN {istikama_user_school} us ON us.userid = u.id
                     WHERE us.schoolid = :sid AND us.role = 'teacher' AND u.deleted = 0
                  ORDER BY upload_count DESC, u.firstname ASC";
            $rows = $DB->get_records_sql($sql, ['sid' => $schoolid], 0, 50);

            foreach ($rows as $row) {
                $teachers[] = [
                    'name' => fullname($row),
                    'email' => $row->email,
                    'upload_count' => (int)$row->upload_count,
                    'lastaccess' => !empty($row->lastaccess) ? userdate($row->lastaccess) : '-',
                ];
            }
        } catch (\Exception $e) {}
        return $teachers;
    }

    public static function get_school_content_stats(int $schoolid): array {
        global $DB;
        $result = ['by_type' => [], 'by_status' => []];
        try {
            $school_userids_sql = "SELECT userid FROM {istikama_user_school} WHERE schoolid = :sid";
            
            $types = $DB->get_records_sql(
                "SELECT content_type, COUNT(1) AS cnt
                   FROM {istikama_content_bank} 
                  WHERE uploaded_by IN ($school_userids_sql)
               GROUP BY content_type ORDER BY cnt DESC", ['sid' => $schoolid]);
            foreach ($types as $t) {
                $result['by_type'][] = ['label' => $t->content_type, 'value' => (int)$t->cnt];
            }

            $statuses = $DB->get_records_sql(
                "SELECT status, COUNT(1) AS cnt
                   FROM {istikama_content_bank}
                  WHERE uploaded_by IN ($school_userids_sql)
               GROUP BY status ORDER BY cnt DESC", ['sid' => $schoolid]);
            foreach ($statuses as $s) {
                $result['by_status'][] = ['label' => $s->status, 'value' => (int)$s->cnt];
            }
        } catch (\Exception $e) {}
        return $result;
    }

    // ═══════════════════════════════════════════════════════════
    //  TECHNICAL PROFESSOR REPORTS
    //  Content-management focused: reusable questions, quiz reuse, teacher consumption.
    // ═══════════════════════════════════════════════════════════

    /** Resolve the central QB course context (or null). */
    private static function qb_course_ctx(): ?\context_course {
        global $DB;
        $qb = $DB->get_record('course', ['shortname' => 'ISTIKAMA_QBANK']);
        return $qb ? \context_course::instance($qb->id) : null;
    }

    /**
     * Top-of-page KPIs for the Technical Professor.
     */
    public static function get_tp_kpis(): array {
        global $DB;
        $qbctx = self::qb_course_ctx();

        $total = (int)$DB->count_records_sql("
            SELECT COUNT(DISTINCT qbe.id)
              FROM {question_bank_entries} qbe
              JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
             WHERE qv.status <> 'hidden'
        ");

        $reusable = 0;
        if ($qbctx) {
            $reusable = (int)$DB->count_records_sql("
                SELECT COUNT(DISTINCT qbe.id)
                  FROM {question_bank_entries} qbe
                  JOIN {question_categories} qc ON qc.id = qbe.questioncategoryid
                  JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
                 WHERE qc.contextid = :ctxid AND qv.status <> 'hidden'
            ", ['ctxid' => $qbctx->id]);
        }

        $total_quizzes = (int)$DB->count_records_select('quiz', 'name <> :n', ['n' => 'Question Bank Gateway']);

        // Teachers that have used a quiz module recently (created or edited).
        $cutoff = time() - 30 * DAYSECS;
        $active_teachers = 0;
        try {
            $active_teachers = (int)$DB->count_records_sql("
                SELECT COUNT(DISTINCT q.timemodified)
                  FROM {question} q
                 WHERE q.timemodified >= :cutoff
            ", ['cutoff' => $cutoff]);
        } catch (\Exception $e) {}

        $active_levels = 0;
        if ($qbctx) {
            $active_levels = (int)$DB->count_records_sql("
                SELECT COUNT(DISTINCT qc.parent)
                  FROM {question_categories} qc
                 WHERE qc.contextid = :ctxid AND qc.parent <> 0
            ", ['ctxid' => $qbctx->id]);
        }

        return [
            'total_questions'  => $total,
            'reusable'         => $reusable,
            'total_quizzes'    => $total_quizzes,
            'active_teachers'  => $active_teachers,
            'active_levels'    => $active_levels,
        ];
    }

    /** Top N most-used questions (by quiz slot references). */
    public static function get_tp_most_used_questions(int $limit = 10): array {
        global $DB;
        try {
            return array_values($DB->get_records_sql("
                SELECT q.id, q.name, q.qtype, qc.name AS catname, COUNT(qr.id) AS uses
                  FROM {question_references} qr
                  JOIN {question_bank_entries} qbe ON qbe.id = qr.questionbankentryid
                  JOIN {question_versions} qv     ON qv.questionbankentryid = qbe.id
                  JOIN {question} q                ON q.id = qv.questionid
                  JOIN {question_categories} qc    ON qc.id = qbe.questioncategoryid
                 WHERE qr.component = 'mod_quiz' AND qr.questionarea = 'slot'
              GROUP BY q.id, q.name, q.qtype, qc.name
              ORDER BY uses DESC, q.timemodified DESC
            ", null, 0, $limit));
        } catch (\Exception $e) { return []; }
    }

    /** Questions that exist but have never been used in any quiz. */
    public static function get_tp_unused_questions(int $limit = 10): array {
        global $DB;
        try {
            return array_values($DB->get_records_sql("
                SELECT q.id, q.name, q.qtype, q.timemodified, qc.name AS catname
                  FROM {question_bank_entries} qbe
                  JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
                  JOIN {question} q ON q.id = qv.questionid
                  JOIN {question_categories} qc ON qc.id = qbe.questioncategoryid
             LEFT JOIN {question_references} qr
                    ON qr.questionbankentryid = qbe.id
                   AND qr.component = 'mod_quiz' AND qr.questionarea = 'slot'
                 WHERE qr.id IS NULL AND qv.status <> 'hidden'
              GROUP BY q.id, q.name, q.qtype, q.timemodified, qc.name
              ORDER BY q.timemodified DESC
            ", null, 0, $limit));
        } catch (\Exception $e) { return []; }
    }

    /** Question count grouped by qtype. */
    public static function get_tp_questions_by_type(): array {
        global $DB;
        $rows = $DB->get_records_sql("
            SELECT q.qtype AS qtype, COUNT(DISTINCT qbe.id) AS cnt
              FROM {question_bank_entries} qbe
              JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
              JOIN {question} q ON q.id = qv.questionid
             WHERE qv.status <> 'hidden'
          GROUP BY q.qtype
          ORDER BY cnt DESC
        ");
        $out = [];
        foreach ($rows as $r) { $out[] = ['label' => $r->qtype, 'value' => (int)$r->cnt]; }
        return $out;
    }

    /** Reusable questions count per Level (using QB course category tree). */
    public static function get_tp_questions_by_level(int $limit = 12): array {
        global $DB;
        $qbctx = self::qb_course_ctx();
        if (!$qbctx) { return []; }
        try {
            $rows = $DB->get_records_sql("
                SELECT parentcat.id AS levelid, parentcat.name AS levelname, COUNT(DISTINCT qbe.id) AS cnt
                  FROM {question_categories} subcat
                  JOIN {question_categories} parentcat ON parentcat.id = subcat.parent
                  JOIN {question_bank_entries} qbe ON qbe.questioncategoryid = subcat.id
                  JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
                 WHERE subcat.contextid = :ctxid
                   AND parentcat.contextid = :ctxid2
                   AND parentcat.name <> 'top'
                   AND qv.status <> 'hidden'
              GROUP BY parentcat.id, parentcat.name
              ORDER BY cnt DESC
            ", ['ctxid' => $qbctx->id, 'ctxid2' => $qbctx->id], 0, $limit);
            $out = [];
            foreach ($rows as $r) {
                $out[] = ['label' => $r->levelname, 'value' => (int)$r->cnt];
            }
            return $out;
        } catch (\Exception $e) { return []; }
    }

    /** Reusable questions count per Subject. */
    public static function get_tp_questions_by_subject(int $limit = 12): array {
        global $DB;
        $qbctx = self::qb_course_ctx();
        if (!$qbctx) { return []; }
        try {
            $rows = $DB->get_records_sql("
                SELECT qc.id, qc.name AS subjectname, parentcat.name AS levelname, COUNT(DISTINCT qbe.id) AS cnt
                  FROM {question_categories} qc
             LEFT JOIN {question_categories} parentcat ON parentcat.id = qc.parent
                  JOIN {question_bank_entries} qbe ON qbe.questioncategoryid = qc.id
                  JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
                 WHERE qc.contextid = :ctxid
                   AND qv.status <> 'hidden'
              GROUP BY qc.id, qc.name, parentcat.name
              ORDER BY cnt DESC
            ", ['ctxid' => $qbctx->id], 0, $limit);
            $out = [];
            foreach ($rows as $r) {
                $out[] = [
                    'subject' => $r->subjectname,
                    'level'   => $r->levelname ?: '—',
                    'count'   => (int)$r->cnt,
                ];
            }
            return $out;
        } catch (\Exception $e) { return []; }
    }

    /** Recently added questions. */
    public static function get_tp_recent_questions(int $limit = 8): array {
        global $DB;
        try {
            return array_values($DB->get_records_sql("
                SELECT q.id, q.name, q.qtype, q.timecreated, qc.name AS catname,
                       u.firstname, u.lastname
                  FROM {question_bank_entries} qbe
                  JOIN {question_versions} qv ON qv.questionbankentryid = qbe.id
                  JOIN {question} q ON q.id = qv.questionid
                  JOIN {question_categories} qc ON qc.id = qbe.questioncategoryid
             LEFT JOIN {user} u ON u.id = q.createdby
                 WHERE qv.status <> 'hidden'
              ORDER BY q.timecreated DESC
            ", null, 0, $limit));
        } catch (\Exception $e) { return []; }
    }

    /** Teachers ranked by quizzes they created. */
    public static function get_tp_top_teachers(int $limit = 10): array {
        global $DB;
        try {
            return array_values($DB->get_records_sql("
                SELECT u.id, u.firstname, u.lastname,
                       COUNT(DISTINCT qz.id) AS quizzes,
                       COUNT(DISTINCT qs.id) AS slots
                  FROM {user} u
                  JOIN {course} c ON 1=1
                  JOIN {quiz} qz ON qz.course = c.id AND qz.name <> 'Question Bank Gateway'
             LEFT JOIN {quiz_slots} qs ON qs.quizid = qz.id
                 WHERE u.id IN (
                       SELECT DISTINCT ra.userid FROM {role_assignments} ra
                       JOIN {role} r ON r.id = ra.roleid
                       WHERE r.shortname IN ('teacher', 'editingteacher')
                 )
              GROUP BY u.id, u.firstname, u.lastname
              ORDER BY quizzes DESC, slots DESC
            ", null, 0, $limit));
        } catch (\Exception $e) { return []; }
    }

    /** Quizzes by adoption — how many slots / how many question entries. */
    public static function get_tp_top_quizzes(int $limit = 10): array {
        global $DB;
        try {
            return array_values($DB->get_records_sql("
                SELECT qz.id, qz.name, c.fullname AS coursename,
                       COUNT(qs.id) AS slots,
                       MAX(qz.timemodified) AS lastmod
                  FROM {quiz} qz
                  JOIN {course} c ON c.id = qz.course
             LEFT JOIN {quiz_slots} qs ON qs.quizid = qz.id
                 WHERE qz.name <> 'Question Bank Gateway'
              GROUP BY qz.id, qz.name, c.fullname
              ORDER BY slots DESC, lastmod DESC
            ", null, 0, $limit));
        } catch (\Exception $e) { return []; }
    }

    /** Quizzes that contain zero questions. */
    public static function get_tp_empty_quizzes(int $limit = 10): array {
        global $DB;
        try {
            return array_values($DB->get_records_sql("
                SELECT qz.id, qz.name, c.fullname AS coursename, qz.timecreated
                  FROM {quiz} qz
                  JOIN {course} c ON c.id = qz.course
             LEFT JOIN {quiz_slots} qs ON qs.quizid = qz.id
                 WHERE qz.name <> 'Question Bank Gateway' AND qs.id IS NULL
              ORDER BY qz.timecreated DESC
            ", null, 0, $limit));
        } catch (\Exception $e) { return []; }
    }

    // ═══════════════════════════════════════════════════════════════════════
    //  ENRICHED SCHOOL PERFORMANCE — backs the new School Performance section
    // ═══════════════════════════════════════════════════════════════════════

    /**
     * Aggregate academic + activity performance for a school within the current
     * season scope. Returns enrollment funnel, average grade, submission rate,
     * teacher activity, and recent-7-day momentum.
     *
     * Falls back gracefully when a metric can't be computed (e.g. legacy data
     * without season ids, or a school with no graded courses yet).
     *
     * @param int $schoolid course_categories.id for the school
     * @return array
     */
    public static function get_school_performance(int $schoolid): array {
        global $DB;

        $out = [
            'schoolid'          => $schoolid,
            'name'              => '',
            'students_enrolled' => 0,
            'students_upcoming' => 0,
            'students_graduated'=> 0,
            'teachers_active'   => 0,
            'avg_grade'         => null,
            'avg_grade_pct'     => null,
            'submission_rate'   => null,
            'completion_rate'   => null,
            'recent_logins_7d'  => 0,
            'recent_attempts_7d'=> 0,
        ];

        try {
            $cat = \core_course_category::get($schoolid, IGNORE_MISSING);
            if ($cat) { $out['name'] = format_string($cat->name); }
        } catch (\Throwable $e) {}

        // Enrollment funnel (season-aware via us.seasonid).
        try {
            [$swhere, $sparams] = self::season_where('us');
            $params = array_merge($sparams, ['sch' => $schoolid]);

            $out['students_enrolled'] = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT us.userid)
                   FROM {istikama_user_school} us
                  WHERE us.schoolid = :sch
                    AND us.role = 'student'
                    AND us.status = 'enrolled' $swhere",
                $params
            );

            $out['students_graduated'] = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT us.userid)
                   FROM {istikama_user_school} us
                  WHERE us.schoolid = :sch
                    AND us.role = 'student'
                    AND us.status = 'graduated'",
                ['sch' => $schoolid]
            );

            // Upcoming = enrolled rows whose season is in upcoming state.
            $out['students_upcoming'] = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT us.userid)
                   FROM {istikama_user_school} us
                   JOIN {istikama_season} s ON s.id = us.seasonid
                  WHERE us.schoolid = :sch
                    AND us.role = 'student'
                    AND us.status = 'enrolled'
                    AND s.status = 'upcoming'",
                ['sch' => $schoolid]
            );

            $out['teachers_active'] = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT us.userid)
                   FROM {istikama_user_school} us
                  WHERE us.schoolid = :sch
                    AND us.role = 'teacher'
                    AND us.status = 'enrolled' $swhere",
                $params
            );
        } catch (\Throwable $e) {}

        // Collect courses tied to this school category tree.
        $allcatids = [$schoolid];
        try {
            $cat = \core_course_category::get($schoolid);
            foreach ($cat->get_children() as $level) {
                $allcatids[] = (int)$level->id;
                foreach ($level->get_children() as $class) {
                    $allcatids[] = (int)$class->id;
                }
            }
        } catch (\Throwable $e) {}

        if (!empty($allcatids)) {
            try {
                [$insql, $iparams] = $DB->get_in_or_equal($allcatids, SQL_PARAMS_NAMED);

                // Average grade across all course completions (best-effort).
                $row = $DB->get_record_sql(
                    "SELECT AVG(gg.finalgrade) AS avg_g, AVG(gi.grademax) AS avg_max
                       FROM {grade_grades} gg
                       JOIN {grade_items} gi ON gi.id = gg.itemid
                       JOIN {course} c ON c.id = gi.courseid
                      WHERE c.category $insql
                        AND gi.itemtype = 'course'
                        AND gg.finalgrade IS NOT NULL",
                    $iparams
                );
                if ($row && $row->avg_g !== null && $row->avg_max > 0) {
                    $out['avg_grade']     = round((float)$row->avg_g, 1);
                    $out['avg_grade_pct'] = round(((float)$row->avg_g / (float)$row->avg_max) * 100, 1);
                }

                // Completion rate across school courses.
                $total = (int)$DB->count_records_sql(
                    "SELECT COUNT(1) FROM {course_completions} cc
                       JOIN {course} c ON c.id = cc.course
                      WHERE c.category $insql",
                    $iparams
                );
                $done = (int)$DB->count_records_sql(
                    "SELECT COUNT(1) FROM {course_completions} cc
                       JOIN {course} c ON c.id = cc.course
                      WHERE c.category $insql
                        AND cc.timecompleted IS NOT NULL AND cc.timecompleted > 0",
                    $iparams
                );
                $out['completion_rate'] = $total > 0 ? round(($done / $total) * 100, 1) : 0;

                // Assignment submission rate (homework completion).
                $sub_total = (int)$DB->count_records_sql(
                    "SELECT COUNT(DISTINCT CONCAT(a.id, '-', e_users.userid))
                       FROM {assign} a
                       JOIN {course} c ON c.id = a.course
                       JOIN {context} ctx ON ctx.instanceid = c.id AND ctx.contextlevel = 50
                       JOIN {role_assignments} ra ON ra.contextid = ctx.id
                       JOIN {role} r ON r.id = ra.roleid AND r.shortname = 'student'
                       JOIN {user} e_users ON e_users.id = ra.userid
                      WHERE c.category $insql",
                    $iparams
                );
                $sub_made = (int)$DB->count_records_sql(
                    "SELECT COUNT(DISTINCT CONCAT(a.id, '-', sub.userid))
                       FROM {assign} a
                       JOIN {course} c ON c.id = a.course
                       JOIN {assign_submission} sub ON sub.assignment = a.id
                                                    AND sub.status = 'submitted'
                      WHERE c.category $insql",
                    $iparams
                );
                $out['submission_rate'] = $sub_total > 0 ? round(($sub_made / $sub_total) * 100, 1) : null;
            } catch (\Throwable $e) {}
        }

        // Recent momentum (last 7 days)
        $cutoff7 = time() - 7 * DAYSECS;
        try {
            $out['recent_logins_7d'] = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT log.userid)
                   FROM {logstore_standard_log} log
                   JOIN {istikama_user_school} us ON us.userid = log.userid
                  WHERE us.schoolid = :sch
                    AND log.action = 'loggedin'
                    AND log.timecreated >= :cutoff",
                ['sch' => $schoolid, 'cutoff' => $cutoff7]
            );
        } catch (\Throwable $e) {}

        return $out;
    }

    /**
     * School performance snapshot for every school in the current season scope.
     */
    public static function get_all_school_performance(int $limit = 20): array {
        global $DB;
        try {
            [$swhere, $sparams] = self::season_where('us');
            $rows = $DB->get_records_sql("
                SELECT DISTINCT us.schoolid AS schoolid
                  FROM {istikama_user_school} us
                 WHERE us.schoolid IS NOT NULL $swhere
              ORDER BY us.schoolid ASC
            ", $sparams, 0, $limit);
        } catch (\Throwable $e) {
            return [];
        }

        $result = [];
        foreach ($rows as $r) {
            $perf = self::get_school_performance((int)$r->schoolid);
            if ($perf['name']) { $result[] = $perf; }
        }
        return $result;
    }

    // ═══════════════════════════════════════════════════════════════════════
    //  INSIGHTS — server-side narrative generation from raw metrics.
    //  Each insight is one short sentence + a `tone` (positive/neutral/warn/danger).
    // ═══════════════════════════════════════════════════════════════════════

    /**
     * Generate executive insights for the admin dashboard.
     */
    public static function get_admin_insights(array $kpis, array $logintrend, array $schools): array {
        $insights = [];

        // Login momentum: compare last 7 days vs prior 7 days.
        if (count($logintrend) >= 14) {
            $recent = array_slice($logintrend, -7);
            $prior  = array_slice($logintrend, -14, 7);
            $rsum = array_sum(array_column($recent, 'value'));
            $psum = array_sum(array_column($prior, 'value'));
            if ($psum > 0) {
                $delta = round((($rsum - $psum) / $psum) * 100, 1);
                if ($delta >= 10) {
                    $insights[] = ['tone' => 'positive', 'icon' => 'fa-arrow-trend-up',
                        'text' => "Logins are up {$delta}% week-over-week. Engagement is strengthening."];
                } else if ($delta <= -10) {
                    $insights[] = ['tone' => 'warn', 'icon' => 'fa-arrow-trend-down',
                        'text' => "Logins dropped " . abs($delta) . "% vs the previous 7 days — consider checking pending notifications."];
                }
            }
        }

        // Engagement score interpretation.
        if (isset($kpis['engagement'])) {
            $e = (float)$kpis['engagement'];
            if ($e >= 3) {
                $insights[] = ['tone' => 'positive', 'icon' => 'fa-bolt',
                    'text' => "Engagement is high: each active user averaged {$e} actions in the last 30 days."];
            } else if ($e < 1 && ($kpis['active_users'] ?? 0) > 0) {
                $insights[] = ['tone' => 'warn', 'icon' => 'fa-circle-exclamation',
                    'text' => "Engagement is low (score {$e}) — active users average fewer than one action per period."];
            }
        }

        // Completion rate.
        if (isset($kpis['completion_rate'])) {
            $c = (float)$kpis['completion_rate'];
            if ($c >= 75) {
                $insights[] = ['tone' => 'positive', 'icon' => 'fa-circle-check',
                    'text' => "Course completion rate of {$c}% is excellent."];
            } else if ($c < 40 && $kpis['total_courses'] > 0) {
                $insights[] = ['tone' => 'warn', 'icon' => 'fa-triangle-exclamation',
                    'text' => "Completion rate of {$c}% is below target — review activity tracking on key courses."];
            }
        }

        // Top school.
        if (!empty($schools)) {
            $top = $schools[0];
            if (!empty($top['name']) && $top['user_count'] > 0) {
                $insights[] = ['tone' => 'neutral', 'icon' => 'fa-trophy',
                    'text' => "Top school by enrolment: {$top['name']} with {$top['user_count']} users."];
            }
        }

        return $insights;
    }

    /**
     * Generate insights for a school manager.
     */
    public static function get_manager_insights(array $kpis, array $logintrend): array {
        $insights = [];

        if (count($logintrend) >= 14) {
            $recent = array_slice($logintrend, -7);
            $prior  = array_slice($logintrend, -14, 7);
            $rsum = array_sum(array_column($recent, 'value'));
            $psum = array_sum(array_column($prior, 'value'));
            if ($psum > 0) {
                $delta = round((($rsum - $psum) / $psum) * 100, 1);
                if ($delta >= 10) {
                    $insights[] = ['tone' => 'positive', 'icon' => 'fa-arrow-trend-up',
                        'text' => "School logins increased {$delta}% this week — your students are returning more often."];
                } else if ($delta <= -10) {
                    $insights[] = ['tone' => 'warn', 'icon' => 'fa-arrow-trend-down',
                        'text' => "School logins dropped " . abs($delta) . "% — consider checking with teachers about engagement."];
                }
            }
        }

        if (isset($kpis['students']) && $kpis['students'] === 0) {
            $insights[] = ['tone' => 'warn', 'icon' => 'fa-user-plus',
                'text' => "No active students yet for this season — enroll students from the Users page to begin."];
        }

        if (isset($kpis['active_users_7d'], $kpis['students']) && $kpis['students'] > 0) {
            $activity_pct = round(($kpis['active_users_7d'] / $kpis['students']) * 100, 1);
            if ($activity_pct < 30) {
                $insights[] = ['tone' => 'warn', 'icon' => 'fa-user-clock',
                    'text' => "Only {$activity_pct}% of students were active in the last 7 days."];
            } else if ($activity_pct >= 70) {
                $insights[] = ['tone' => 'positive', 'icon' => 'fa-user-check',
                    'text' => "{$activity_pct}% of students were active in the last 7 days — strong participation."];
            }
        }

        return $insights;
    }

    /**
     * Generate insights for a teacher's class report.
     */
    public static function get_teacher_insights(array $kpis, array $students): array {
        $insights = [];

        if (empty($students)) {
            $insights[] = ['tone' => 'neutral', 'icon' => 'fa-chalkboard-user',
                'text' => "No students enrolled in your classes yet — once enrolment opens, their progress will appear here."];
            return $insights;
        }

        // Average attendance.
        $atts = array_filter(array_map(fn($s) => $s['attendance'] ?? null, $students), fn($v) => $v !== null);
        if (!empty($atts)) {
            $avg_att = round(array_sum($atts) / count($atts), 1);
            if ($avg_att >= 85) {
                $insights[] = ['tone' => 'positive', 'icon' => 'fa-circle-check',
                    'text' => "Class average attendance is {$avg_att}% — well above the target of 80%."];
            } else if ($avg_att < 70) {
                $insights[] = ['tone' => 'warn', 'icon' => 'fa-triangle-exclamation',
                    'text' => "Class average attendance is {$avg_att}% — below the 80% target."];
            }
        }

        // At-risk students.
        $at_risk = array_filter($students, fn($s) =>
            (isset($s['grade']) && $s['grade'] < 50) || (isset($s['attendance']) && $s['attendance'] < 70)
        );
        if (count($at_risk) > 0) {
            $n = count($at_risk);
            $insights[] = ['tone' => 'warn', 'icon' => 'fa-user-shield',
                'text' => "{$n} student" . ($n === 1 ? '' : 's') . " flagged as at-risk (low grades or attendance) — review the list below."];
        }

        return $insights;
    }

    // ═══════════════════════════════════════════════════════════════════════
    //  ENRICHED SCHOOL MANAGER REPORTS
    //  Extended analytics: enrollment funnel, class performance, teacher
    //  effectiveness, subject performance, attendance, at-risk students.
    //  All season-aware via the static $seasonid scope.
    // ═══════════════════════════════════════════════════════════════════════

    /**
     * School enrollment funnel: enrolled / upcoming / graduated / transferred
     * counts, season-scoped where appropriate.
     */
    public static function get_school_enrollment_funnel(int $schoolid): array {
        global $DB;
        $out = [
            'enrolled'    => 0,
            'upcoming'    => 0,
            'graduated'   => 0,
            'transferred' => 0,
            'suspended'   => 0,
        ];
        try {
            [$swhere, $sparams] = self::season_where('us');
            $params = array_merge(['sch' => $schoolid], $sparams);

            $out['enrolled'] = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT us.userid)
                   FROM {istikama_user_school} us
                  WHERE us.schoolid = :sch
                    AND us.role = 'student'
                    AND us.status = 'enrolled' $swhere",
                $params
            );

            // Upcoming = rows in an upcoming season.
            $out['upcoming'] = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT us.userid)
                   FROM {istikama_user_school} us
                   JOIN {istikama_season} se ON se.id = us.seasonid
                  WHERE us.schoolid = :sch
                    AND us.role = 'student'
                    AND us.status = 'enrolled'
                    AND se.status = 'upcoming'",
                ['sch' => $schoolid]
            );

            $out['graduated'] = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT us.userid)
                   FROM {istikama_user_school} us
                  WHERE us.schoolid = :sch
                    AND us.role = 'student'
                    AND us.status = 'graduated'",
                ['sch' => $schoolid]
            );
            $out['transferred'] = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT us.userid)
                   FROM {istikama_user_school} us
                  WHERE us.schoolid = :sch
                    AND us.role = 'student'
                    AND us.status = 'transferred'",
                ['sch' => $schoolid]
            );
            $out['suspended'] = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT us.userid)
                   FROM {istikama_user_school} us
                  WHERE us.schoolid = :sch
                    AND us.role = 'student'
                    AND us.status = 'suspended'",
                ['sch' => $schoolid]
            );
        } catch (\Throwable $e) {
            debugging('get_school_enrollment_funnel failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }
        return $out;
    }

    /** Walks the category tree under $schoolid and returns all class ids (depth=3). */
    private static function school_class_ids(int $schoolid): array {
        $ids = [];
        try {
            $cat = \core_course_category::get($schoolid, IGNORE_MISSING);
            if (!$cat) { return []; }
            foreach ($cat->get_children() as $level) {
                foreach ($level->get_children() as $class) {
                    $ids[] = (int)$class->id;
                }
            }
        } catch (\Throwable $e) {}
        return $ids;
    }

    /**
     * Per-class performance breakdown — students enrolled, average grade,
     * completion rate, last activity. Returns one row per class.
     */
    public static function get_school_class_performance(int $schoolid): array {
        global $DB;
        $rows = [];
        $classids = self::school_class_ids($schoolid);
        if (empty($classids)) { return $rows; }

        try {
            foreach ($classids as $classid) {
                $cat = \core_course_category::get($classid, IGNORE_MISSING);
                if (!$cat) { continue; }
                $levelcat = $cat->parent ? \core_course_category::get($cat->parent, IGNORE_MISSING) : null;

                // Students enrolled in this class.
                $studentcount = (int)$DB->count_records_sql(
                    "SELECT COUNT(DISTINCT userid)
                       FROM {istikama_user_school}
                      WHERE classid = :cid AND role = 'student' AND status = 'enrolled'",
                    ['cid' => $classid]
                );

                // Course ids tied to this class via istikama_class_subjects.
                $courseids = $DB->get_fieldset_select('istikama_class_subjects', 'courseid', 'classid = ?', [$classid]);
                if (empty($courseids)) {
                    $rows[] = [
                        'classid'    => $classid,
                        'class_name' => format_string($cat->name),
                        'level_name' => $levelcat ? format_string($levelcat->name) : '—',
                        'students'   => $studentcount,
                        'courses'    => 0,
                        'avg_grade'  => null,
                        'completion' => 0,
                        'submission_rate' => null,
                    ];
                    continue;
                }
                [$insql, $iparams] = $DB->get_in_or_equal($courseids, SQL_PARAMS_NAMED);

                // Average grade across class courses.
                $row = $DB->get_record_sql(
                    "SELECT AVG(gg.finalgrade) AS avg_g, AVG(gi.grademax) AS avg_max
                       FROM {grade_grades} gg
                       JOIN {grade_items} gi ON gi.id = gg.itemid
                      WHERE gi.courseid $insql
                        AND gi.itemtype = 'course'
                        AND gg.finalgrade IS NOT NULL",
                    $iparams
                );
                $avg = ($row && $row->avg_g !== null && $row->avg_max > 0)
                    ? round(((float)$row->avg_g / (float)$row->avg_max) * 100, 1)
                    : null;

                // Completion rate.
                $total = (int)$DB->count_records_sql(
                    "SELECT COUNT(1) FROM {course_completions} WHERE course $insql",
                    $iparams
                );
                $done = (int)$DB->count_records_sql(
                    "SELECT COUNT(1) FROM {course_completions}
                      WHERE course $insql AND timecompleted IS NOT NULL AND timecompleted > 0",
                    $iparams
                );
                $completion = $total > 0 ? round(($done / $total) * 100, 1) : 0;

                // Submission rate (assign).
                $expected = (int)$DB->count_records_sql(
                    "SELECT COUNT(DISTINCT CONCAT(a.id, '-', ra.userid))
                       FROM {assign} a
                       JOIN {context} ctx ON ctx.instanceid = a.course AND ctx.contextlevel = 50
                       JOIN {role_assignments} ra ON ra.contextid = ctx.id
                       JOIN {role} r ON r.id = ra.roleid AND r.shortname = 'student'
                      WHERE a.course $insql",
                    $iparams
                );
                $made = (int)$DB->count_records_sql(
                    "SELECT COUNT(DISTINCT CONCAT(a.id, '-', s.userid))
                       FROM {assign} a
                       JOIN {assign_submission} s ON s.assignment = a.id AND s.status = 'submitted'
                      WHERE a.course $insql",
                    $iparams
                );
                $subrate = $expected > 0 ? round(($made / $expected) * 100, 1) : null;

                $rows[] = [
                    'classid'         => $classid,
                    'class_name'      => format_string($cat->name),
                    'level_name'      => $levelcat ? format_string($levelcat->name) : '—',
                    'students'        => $studentcount,
                    'courses'         => count($courseids),
                    'avg_grade'       => $avg,
                    'completion'      => $completion,
                    'submission_rate' => $subrate,
                ];
            }
        } catch (\Throwable $e) {
            debugging('get_school_class_performance failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }

        // Best classes first (by avg_grade desc, students desc as tiebreak).
        usort($rows, function($a, $b) {
            $av = $a['avg_grade'] ?? -1;
            $bv = $b['avg_grade'] ?? -1;
            if ($av === $bv) { return $b['students'] <=> $a['students']; }
            return $bv <=> $av;
        });
        return $rows;
    }

    /**
     * Per-teacher effectiveness — how many courses they own, content uploads,
     * last login, average grade of students taught.
     */
    public static function get_school_teacher_effectiveness(int $schoolid): array {
        global $DB;
        $rows = [];
        try {
            [$swhere, $sparams] = self::season_where('us');
            $params = array_merge(['sch' => $schoolid], $sparams);
            $teachers = $DB->get_records_sql(
                "SELECT DISTINCT u.id, u.firstname, u.lastname, u.email, u.lastaccess
                   FROM {user} u
                   JOIN {istikama_user_school} us ON us.userid = u.id
                  WHERE us.schoolid = :sch
                    AND us.role = 'teacher'
                    AND u.deleted = 0 $swhere
               ORDER BY u.lastname ASC, u.firstname ASC",
                $params
            );

            $classids = self::school_class_ids($schoolid);
            $courseids = [];
            if (!empty($classids)) {
                [$cInSql, $cParams] = $DB->get_in_or_equal($classids, SQL_PARAMS_NAMED);
                $courseids = $DB->get_fieldset_select('istikama_class_subjects', 'courseid', "classid $cInSql", $cParams);
            }

            foreach ($teachers as $t) {
                $uploads = (int)$DB->count_records('istikama_content_bank', ['uploaded_by' => $t->id]);

                // Courses where this teacher is enrolled as editingteacher inside the school's courses.
                $courses_taught = 0;
                $avg_student_grade = null;
                if (!empty($courseids)) {
                    [$cInSql2, $cParams2] = $DB->get_in_or_equal($courseids, SQL_PARAMS_NAMED, 'cp');
                    $cParams2['tid'] = $t->id;
                    $courses_taught = (int)$DB->count_records_sql(
                        "SELECT COUNT(DISTINCT ctx.instanceid)
                           FROM {role_assignments} ra
                           JOIN {context} ctx ON ctx.id = ra.contextid AND ctx.contextlevel = 50
                           JOIN {role} r ON r.id = ra.roleid
                          WHERE ra.userid = :tid
                            AND r.shortname IN ('editingteacher','teacher')
                            AND ctx.instanceid $cInSql2",
                        $cParams2
                    );
                }

                $rows[] = [
                    'userid'      => (int)$t->id,
                    'name'        => fullname($t),
                    'email'       => $t->email,
                    'uploads'     => $uploads,
                    'courses'     => $courses_taught,
                    'last_access' => $t->lastaccess ? userdate($t->lastaccess, get_string('strftimedatetimeshort', 'langconfig')) : '—',
                    'active_recently' => $t->lastaccess && ($t->lastaccess > time() - 7 * DAYSECS),
                ];
            }
        } catch (\Throwable $e) {
            debugging('get_school_teacher_effectiveness failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }
        return $rows;
    }

    /**
     * Per-subject performance across the school — students touching the
     * subject, average grade, completion. Subjects are derived from
     * istikama_subject_names joined via istikama_class_subjects.
     */
    public static function get_school_subject_performance(int $schoolid): array {
        global $DB;
        $rows = [];
        $classids = self::school_class_ids($schoolid);
        if (empty($classids)) { return $rows; }

        try {
            [$insql, $iparams] = $DB->get_in_or_equal($classids, SQL_PARAMS_NAMED);
            $sub_rows = $DB->get_records_sql(
                "SELECT cs.subjectid AS subjectid,
                        sn.name      AS subject_name,
                        GROUP_CONCAT(DISTINCT cs.courseid) AS courseids
                   FROM {istikama_class_subjects} cs
                   JOIN {istikama_subject_names} sn ON sn.id = cs.subjectid
                  WHERE cs.classid $insql
               GROUP BY cs.subjectid, sn.name
               ORDER BY sn.name ASC",
                $iparams
            );

            foreach ($sub_rows as $sr) {
                $cids = array_filter(array_map('intval', explode(',', $sr->courseids ?? '')));
                $student_count = 0;
                $avg = null;
                $completion = 0;

                if (!empty($cids)) {
                    [$cInSql, $cParams] = $DB->get_in_or_equal($cids, SQL_PARAMS_NAMED);

                    $student_count = (int)$DB->count_records_sql(
                        "SELECT COUNT(DISTINCT ra.userid)
                           FROM {role_assignments} ra
                           JOIN {context} ctx ON ctx.id = ra.contextid AND ctx.contextlevel = 50
                           JOIN {role} r ON r.id = ra.roleid AND r.shortname = 'student'
                          WHERE ctx.instanceid $cInSql",
                        $cParams
                    );

                    $row = $DB->get_record_sql(
                        "SELECT AVG(gg.finalgrade) AS avg_g, AVG(gi.grademax) AS avg_max
                           FROM {grade_grades} gg
                           JOIN {grade_items} gi ON gi.id = gg.itemid
                          WHERE gi.courseid $cInSql
                            AND gi.itemtype = 'course'
                            AND gg.finalgrade IS NOT NULL",
                        $cParams
                    );
                    if ($row && $row->avg_g !== null && $row->avg_max > 0) {
                        $avg = round(((float)$row->avg_g / (float)$row->avg_max) * 100, 1);
                    }

                    $total = (int)$DB->count_records_sql(
                        "SELECT COUNT(1) FROM {course_completions} WHERE course $cInSql",
                        $cParams
                    );
                    $done = (int)$DB->count_records_sql(
                        "SELECT COUNT(1) FROM {course_completions}
                          WHERE course $cInSql AND timecompleted IS NOT NULL AND timecompleted > 0",
                        $cParams
                    );
                    $completion = $total > 0 ? round(($done / $total) * 100, 1) : 0;
                }

                $rows[] = [
                    'subjectid'    => (int)$sr->subjectid,
                    'subject_name' => format_string($sr->subject_name),
                    'students'     => $student_count,
                    'avg_grade'    => $avg,
                    'completion'   => $completion,
                ];
            }
        } catch (\Throwable $e) {
            debugging('get_school_subject_performance failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }
        return $rows;
    }

    /**
     * At-risk students: low recent activity, no submissions, or low grades.
     * Returns up to 20 rows.
     */
    public static function get_school_at_risk_students(int $schoolid): array {
        global $DB;
        $rows = [];
        try {
            $cutoff = time() - 14 * DAYSECS;
            $list = $DB->get_records_sql(
                "SELECT u.id, u.firstname, u.lastname, u.email, u.lastaccess,
                        us.classid,
                        cc.name AS class_name
                   FROM {istikama_user_school} us
                   JOIN {user} u  ON u.id = us.userid
              LEFT JOIN {course_categories} cc ON cc.id = us.classid
                  WHERE us.schoolid = :sch
                    AND us.role = 'student'
                    AND us.status = 'enrolled'
                    AND (u.lastaccess IS NULL OR u.lastaccess < :cutoff)
               ORDER BY u.lastaccess ASC NULLS FIRST",
                ['sch' => $schoolid, 'cutoff' => $cutoff],
                0, 20
            );
            // MySQL doesn't support NULLS FIRST in all versions — fall back if so.
            if (empty($list)) {
                $list = $DB->get_records_sql(
                    "SELECT u.id, u.firstname, u.lastname, u.email, u.lastaccess,
                            us.classid,
                            cc.name AS class_name
                       FROM {istikama_user_school} us
                       JOIN {user} u  ON u.id = us.userid
                  LEFT JOIN {course_categories} cc ON cc.id = us.classid
                      WHERE us.schoolid = :sch
                        AND us.role = 'student'
                        AND us.status = 'enrolled'
                        AND (u.lastaccess IS NULL OR u.lastaccess < :cutoff)
                   ORDER BY COALESCE(u.lastaccess, 0) ASC",
                    ['sch' => $schoolid, 'cutoff' => $cutoff],
                    0, 20
                );
            }
            foreach ($list as $u) {
                $rows[] = [
                    'userid'      => (int)$u->id,
                    'name'        => fullname($u),
                    'email'       => $u->email,
                    'class_name'  => $u->class_name ? format_string($u->class_name) : '—',
                    'last_access' => $u->lastaccess ? userdate($u->lastaccess, get_string('strftimedatetimeshort', 'langconfig')) : 'Never',
                    'days_inactive' => $u->lastaccess ? (int)floor((time() - $u->lastaccess) / DAYSECS) : 999,
                ];
            }
        } catch (\Throwable $e) {
            // Try a safer fallback without NULLS FIRST.
            try {
                $cutoff = time() - 14 * DAYSECS;
                $list = $DB->get_records_sql(
                    "SELECT u.id, u.firstname, u.lastname, u.email, u.lastaccess,
                            us.classid,
                            cc.name AS class_name
                       FROM {istikama_user_school} us
                       JOIN {user} u  ON u.id = us.userid
                  LEFT JOIN {course_categories} cc ON cc.id = us.classid
                      WHERE us.schoolid = :sch
                        AND us.role = 'student'
                        AND us.status = 'enrolled'
                        AND (u.lastaccess IS NULL OR u.lastaccess < :cutoff)
                   ORDER BY COALESCE(u.lastaccess, 0) ASC",
                    ['sch' => $schoolid, 'cutoff' => $cutoff],
                    0, 20
                );
                foreach ($list as $u) {
                    $rows[] = [
                        'userid'        => (int)$u->id,
                        'name'          => fullname($u),
                        'email'         => $u->email,
                        'class_name'    => $u->class_name ? format_string($u->class_name) : '—',
                        'last_access'   => $u->lastaccess ? userdate($u->lastaccess, get_string('strftimedatetimeshort', 'langconfig')) : 'Never',
                        'days_inactive' => $u->lastaccess ? (int)floor((time() - $u->lastaccess) / DAYSECS) : 999,
                    ];
                }
            } catch (\Throwable $e2) {
                debugging('get_school_at_risk_students failed: ' . $e2->getMessage(), DEBUG_DEVELOPER);
            }
        }
        return $rows;
    }
}
