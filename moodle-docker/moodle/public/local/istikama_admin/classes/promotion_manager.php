<?php
// This file is part of Moodle - http://moodle.org/

namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

/**
 * Student promotion / retention between academic seasons.
 *
 * A "promotion" is the act of taking a student's enrollment from one season
 * and re-creating it (or not) for the next season. The original row is
 * preserved untouched — promotion is additive, never destructive — so
 * historical data remains intact.
 *
 *   - promote:  copy enrollment from season A to season B, optionally with a
 *               new class (e.g., Primary 1 -> Primary 2).
 *   - retain:   copy enrollment with the SAME class (held back a year).
 *   - graduate: do not create a new enrollment in the target season; record
 *               the action for history.
 *   - transfer: similar to promote but cross-school.
 *
 * Each call writes one row to istikama_season_promotion as the audit trail.
 */
class promotion_manager {

    const ACTION_PROMOTE       = 'promote';       // Cross-season, new class (typical year-end promotion).
    const ACTION_RETAIN        = 'retain';        // Cross-season, same class (held back a year).
    const ACTION_GRADUATE      = 'graduate';      // Cross-season exit; no new enrollment.
    const ACTION_TRANSFER      = 'transfer';      // Cross-school or in-school move (any season).
    const ACTION_CHANGE_CLASS  = 'change_class';  // Within-season class change.

    // Enrollment row status values (istikama_user_school.status).
    const STATUS_ENROLLED    = 'enrolled';
    const STATUS_GRADUATED   = 'graduated';
    const STATUS_TRANSFERRED = 'transferred';
    const STATUS_SUSPENDED   = 'suspended';

    // Display-only status — never persisted to the DB. Computed at render time
    // when an enrollment row sits in a season whose state is `upcoming` (or
    // similar) so the row doesn't misleadingly show as actively "Enrolled".
    const STATUS_UPCOMING_DISPLAY = 'upcoming';

    /** Status label + visual metadata for the UI. */
    public static function get_enrollment_statuses(): array {
        return [
            self::STATUS_ENROLLED         => ['label' => get_string('status_enrolled',    'local_istikama_admin'), 'badge_bg' => '#d1fae5', 'badge_fg' => '#047857', 'icon' => 'fa-check-circle'],
            self::STATUS_UPCOMING_DISPLAY => ['label' => get_string('status_upcoming',    'local_istikama_admin'), 'badge_bg' => '#dbeafe', 'badge_fg' => '#1e40af', 'icon' => 'fa-calendar-alt'],
            self::STATUS_GRADUATED        => ['label' => get_string('status_graduated',   'local_istikama_admin'), 'badge_bg' => '#dbeafe', 'badge_fg' => '#1e40af', 'icon' => 'fa-user-graduate'],
            self::STATUS_TRANSFERRED      => ['label' => get_string('status_transferred', 'local_istikama_admin'), 'badge_bg' => '#fef3c7', 'badge_fg' => '#92400e', 'icon' => 'fa-arrow-right'],
            self::STATUS_SUSPENDED        => ['label' => get_string('status_suspended',   'local_istikama_admin'), 'badge_bg' => '#fee2e2', 'badge_fg' => '#991b1b', 'icon' => 'fa-pause-circle'],
        ];
    }

    /**
     * Compute the DISPLAY status for an enrollment row, taking the season's
     * lifecycle state into account.
     *
     * A row in {istikama_user_school} is created with `status = 'enrolled'`
     * the moment a student is promoted to the destination season — even if
     * that season is still `upcoming` (i.e. has not started yet). Showing
     * "Enrolled" in that case is misleading. This helper folds the season's
     * status into the rendering so the badge says "Upcoming" until the season
     * actually starts.
     *
     * Database status is never changed; this is rendering only.
     *
     * @param string $rowstatus  The raw value from istikama_user_school.status
     * @param int    $seasonid   The season the row belongs to (us.seasonid)
     * @return string A key suitable for get_enrollment_statuses()[…]
     */
    public static function display_status(string $rowstatus, int $seasonid): string {
        if ($rowstatus !== self::STATUS_ENROLLED) {
            // Graduated / transferred / suspended → always shown literally.
            return $rowstatus ?: self::STATUS_ENROLLED;
        }
        if ($seasonid <= 0) {
            return self::STATUS_ENROLLED;
        }
        $season = season_manager::get($seasonid);
        if (!$season) {
            return self::STATUS_ENROLLED;
        }
        if ($season->status === season_manager::STATUS_UPCOMING ||
            $season->status === season_manager::STATUS_DRAFT) {
            return self::STATUS_UPCOMING_DISPLAY;
        }
        return self::STATUS_ENROLLED;
    }

    /**
     * Promote a single student.
     *
     * @param int $studentid
     * @param int $fromseasonid The season the student was in.
     * @param int $toseasonid   The season they're moving to (must be active or upcoming).
     * @param int|null $toclassid  Destination class category id (NULL for graduate).
     * @param string $action    One of the ACTION_* constants.
     * @param string $notes     Optional free-text note.
     * @return int promotion log id
     * @throws \moodle_exception
     */
    public static function promote_student(
        int $studentid,
        int $fromseasonid,
        int $toseasonid,
        ?int $toclassid,
        string $action = self::ACTION_PROMOTE,
        string $notes = '',
        ?int $tolevelid = null
    ): int {
        global $DB, $USER;

        // ---- 1. Validate seasons & action --------------------------------------
        if ($fromseasonid <= 0 || $toseasonid <= 0) {
            throw new \moodle_exception('promotion_invalid_seasons', 'local_istikama_admin');
        }
        if (!in_array($action, [
            self::ACTION_PROMOTE, self::ACTION_RETAIN, self::ACTION_GRADUATE,
            self::ACTION_TRANSFER, self::ACTION_CHANGE_CLASS,
        ], true)) {
            throw new \moodle_exception('promotion_invalid_action', 'local_istikama_admin');
        }

        // Same-season operations are permitted ONLY for TRANSFER (in-school class
        // change or cross-school move within the same season) and CHANGE_CLASS.
        $samesizon = ($fromseasonid === $toseasonid);
        if ($samesizon && !in_array($action, [self::ACTION_TRANSFER, self::ACTION_CHANGE_CLASS], true)) {
            throw new \moodle_exception('promotion_same_season', 'local_istikama_admin');
        }
        // CHANGE_CLASS is *only* meaningful within the same season.
        if ($action === self::ACTION_CHANGE_CLASS && !$samesizon) {
            throw new \moodle_exception('change_class_must_be_same_season', 'local_istikama_admin');
        }

        $toseason = season_manager::get($toseasonid);
        if (!$toseason) {
            throw new \moodle_exception('promotion_target_season_missing', 'local_istikama_admin');
        }
        if (in_array($toseason->status, [season_manager::STATUS_ARCHIVED, season_manager::STATUS_CLOSED], true)) {
            throw new \moodle_exception('promotion_target_season_locked', 'local_istikama_admin');
        }

        // ---- 2. Find the source enrollment row ---------------------------------
        $source = $DB->get_record('istikama_user_school',
            ['userid' => $studentid, 'seasonid' => $fromseasonid, 'role' => 'student'], '*', IGNORE_MULTIPLE);

        // Fallback: legacy data without seasonid — pick the most recent student row.
        if (!$source) {
            $source = $DB->get_record_sql(
                "SELECT * FROM {istikama_user_school}
                  WHERE userid = ? AND role = 'student'
               ORDER BY timecreated DESC",
                [$studentid], IGNORE_MULTIPLE
            );
        }

        // Source enrollment is REQUIRED for every action. Without it we have no
        // school/level to anchor the new row to.
        if (!$source) {
            throw new \moodle_exception('promotion_no_source_enrollment', 'local_istikama_admin');
        }

        // ---- 3. Decide destination class per action ---------------------------
        //   promote      → toclassid REQUIRED (you're moving to a new class).
        //   retain       → toclassid optional, defaults to source class.
        //   graduate     → no destination class (no new row at all).
        //   transfer     → toclassid REQUIRED.
        //   change_class → toclassid REQUIRED, must differ from source class.
        $destclassid = null;
        switch ($action) {
            case self::ACTION_GRADUATE:
                $destclassid = null;
                break;
            case self::ACTION_RETAIN:
                $destclassid = $toclassid ? (int)$toclassid : (int)$source->classid;
                break;
            case self::ACTION_PROMOTE:
            case self::ACTION_TRANSFER:
            case self::ACTION_CHANGE_CLASS:
                if (empty($toclassid)) {
                    throw new \moodle_exception('promotion_class_required', 'local_istikama_admin');
                }
                $destclassid = (int)$toclassid;
                break;
        }

        // ---- 4. Derive + validate destination level ---------------------------
        // The destination level MUST equal the chosen class's parent category.
        // If the caller passed an explicit $tolevelid, we strictly verify it matches
        // — this guards against UI bugs or stale form state submitting an
        // inconsistent (level, class) pair.
        $derivedlevelid = null;
        if ($destclassid) {
            try {
                $cat = \core_course_category::get($destclassid, IGNORE_MISSING);
                if ($cat && $cat->parent) {
                    $derivedlevelid = (int)$cat->parent;
                }
            } catch (\Throwable $e) {
                // ignore — fall through to validation below.
            }
        }

        if ($tolevelid !== null && $tolevelid > 0 && $destclassid) {
            // Explicit level: must match the class's actual parent.
            if ($derivedlevelid === null || $derivedlevelid !== (int)$tolevelid) {
                throw new \moodle_exception('promotion_level_class_mismatch', 'local_istikama_admin');
            }
        }

        $destlevelid = $derivedlevelid;
        if (!$destlevelid && $action === self::ACTION_RETAIN) {
            $destlevelid = (int)$source->levelid;
        }

        // ---- 5. No-op detection (same-season ops only) -----------------------
        // Refuse the operation ONLY if BOTH the class AND the derived level are
        // unchanged — i.e. nothing about the enrollment would actually change.
        // If the class stays the same but the level needs correcting (e.g. fixing
        // a corrupt enrollment row), we let the operation proceed.
        if ($samesizon
            && $destclassid !== null
            && $destclassid === (int)$source->classid
            && $destlevelid !== null
            && $destlevelid === (int)$source->levelid
        ) {
            throw new \moodle_exception('promotion_no_class_change', 'local_istikama_admin');
        }

        // ---- 6. Persist (in a transaction) ------------------------------------
        $transaction = $DB->start_delegated_transaction();
        try {

            $now = time();

            if ($samesizon) {
                // ── Same-season operation: UPDATE the existing row in place. ──
                // No new row is created — historical class/level for this season
                // is recorded only via the audit log entry below.
                $DB->update_record('istikama_user_school', (object)[
                    'id'           => (int)$source->id,
                    'classid'      => $destclassid,
                    'levelid'      => $destlevelid ?: (int)$source->levelid,
                    // Status stays 'enrolled' — same-season transfer/change-class
                    // does not change membership state.
                    'timemodified' => $now,
                ]);

            } else if ($action !== self::ACTION_GRADUATE) {
                // ── Cross-season op (not graduate): INSERT a new enrollment row. ──
                $existing = $DB->get_record('istikama_user_school', [
                    'userid'   => $studentid,
                    'seasonid' => $toseasonid,
                    'role'     => 'student',
                ], 'id', IGNORE_MULTIPLE);
                if ($existing) {
                    throw new \moodle_exception('promotion_already_enrolled', 'local_istikama_admin');
                }

                $newrec = (object)[
                    'userid'       => $studentid,
                    'schoolid'     => (int)$source->schoolid,
                    'levelid'      => $destlevelid,
                    'classid'      => $destclassid,
                    'role'         => 'student',
                    'seasonid'     => $toseasonid,
                    'status'       => self::STATUS_ENROLLED,
                    'timecreated'  => $now,
                    'timemodified' => $now,
                ];
                $DB->insert_record('istikama_user_school', $newrec);
            }

            // ── Source-row status updates for terminal cross-season transitions. ──
            if (!$samesizon) {
                if ($action === self::ACTION_GRADUATE) {
                    $DB->update_record('istikama_user_school', (object)[
                        'id'           => (int)$source->id,
                        'status'       => self::STATUS_GRADUATED,
                        'timemodified' => $now,
                    ]);
                } else if ($action === self::ACTION_TRANSFER) {
                    $DB->update_record('istikama_user_school', (object)[
                        'id'           => (int)$source->id,
                        'status'       => self::STATUS_TRANSFERRED,
                        'timemodified' => $now,
                    ]);
                }
            }

            // ── Audit log — always written. ──
            $logid = $DB->insert_record('istikama_season_promotion', (object)[
                'studentid'     => $studentid,
                'from_seasonid' => $fromseasonid,
                'to_seasonid'   => $toseasonid,
                'from_classid'  => (int)$source->classid,
                'to_classid'    => $destclassid,
                'action'        => $action,
                'notes'         => $notes,
                'performed_by'  => (int)$USER->id,
                'timecreated'   => $now,
            ]);

            $transaction->allow_commit();
        } catch (\Throwable $e) {
            $transaction->rollback($e);
            throw $e;
        }

        // ---- 7. Reconcile Moodle course enrollments to match the new class ----
        // Runs OUTSIDE the transaction so enrollment failures never roll back
        // the promotion itself (it's recorded best-effort).
        //
        // Rule: a student MUST only be enrolled in subjects (Moodle courses)
        // belonging to their CURRENT class. When the class changes, we must
        // remove enrollments tied to the OLD class so stale entries don't
        // accumulate (the bug the user reported).
        //
        // Season gating: Moodle-course enrollments are only synced when the
        // DESTINATION season is ACTIVE. If we're moving the student into an
        // upcoming (not-yet-started) season, the `istikama_user_school` row is
        // already in place — but they MUST NOT receive lessons yet. The
        // `season_manager::activate()` flow will run `sync_active_enrollments`
        // and pull these forward into Moodle enrolments when the season opens.
        //
        // Historical data (istikama_user_school rows, audit log) is preserved
        // — we only touch the live Moodle enrollment tables.

        $origclassid   = (int)$source->classid;
        $destseason    = season_manager::get($toseasonid);
        $destisactive  = $destseason && $destseason->status === season_manager::STATUS_ACTIVE;

        if ($destisactive) {
            // ── Active destination season → apply enrollment changes immediately. ──
            if ($origclassid > 0 && $origclassid !== (int)($destclassid ?? 0)) {
                self::unenroll_from_class_courses($studentid, $origclassid, $destclassid ?? 0);
            }
            if ($destclassid && $action !== self::ACTION_GRADUATE) {
                self::enroll_in_class_courses($studentid, $destclassid);
            }
        } else if ($action === self::ACTION_CHANGE_CLASS || $action === self::ACTION_TRANSFER) {
            // ── Same-season class moves: the season they're sitting in IS active. ──
            // Sync immediately regardless of destseason status — these actions
            // never cross into a future season.
            if ($origclassid > 0 && $origclassid !== (int)($destclassid ?? 0)) {
                self::unenroll_from_class_courses($studentid, $origclassid, $destclassid ?? 0);
            }
            if ($destclassid && $action !== self::ACTION_GRADUATE) {
                self::enroll_in_class_courses($studentid, $destclassid);
            }
        }
        // else: destination season is upcoming/draft/etc. — defer to activate().

        return (int)$logid;
    }

    /**
     * Apply pending istikama_user_school enrollments for a season that just
     * became active. Called by season_manager::activate().
     *
     * Walks every `enrolled` student row for the given season and:
     *  - Unenrolls them from any other-class Moodle courses they still hold
     *    (e.g. last season's class).
     *  - Enrolls them in every Moodle course bound to their row's class.
     *
     * Idempotent — safe to call repeatedly. Skips rows without a classid.
     *
     * @param int $seasonid
     * @return array{processed:int, enrolled:int, unenrolled:int, skipped:int}
     */
    public static function sync_active_enrollments(int $seasonid): array {
        global $DB;
        $stats = ['processed' => 0, 'enrolled' => 0, 'unenrolled' => 0, 'skipped' => 0];

        if ($seasonid <= 0) { return $stats; }

        $rows = $DB->get_records('istikama_user_school', [
            'seasonid' => $seasonid,
            'role'     => 'student',
            'status'   => self::STATUS_ENROLLED,
        ]);

        foreach ($rows as $row) {
            $userid  = (int)$row->userid;
            $classid = (int)$row->classid;
            if ($userid <= 0 || $classid <= 0) {
                $stats['skipped']++;
                continue;
            }

            // Find any other class the student also holds an enrollment in
            // (previous season) to unenroll them from those leftover Moodle
            // courses that aren't in the new class.
            $others = $DB->get_records_sql(
                "SELECT DISTINCT classid
                   FROM {istikama_user_school}
                  WHERE userid = :userid
                    AND role = 'student'
                    AND classid <> :classid
                    AND classid IS NOT NULL
                    AND classid > 0",
                ['userid' => $userid, 'classid' => $classid]
            );
            foreach ($others as $o) {
                $r = self::unenroll_from_class_courses($userid, (int)$o->classid, $classid);
                $stats['unenrolled'] += $r['unenrolled'];
            }

            $r = self::enroll_in_class_courses($userid, $classid);
            $stats['enrolled'] += $r['enrolled'];
            $stats['processed']++;
        }
        return $stats;
    }

    /**
     * Unenroll the student from every Moodle course linked to {$oldclassid}
     * that is NOT also linked to {$keepclassid} (the new/current class).
     *
     * Used when a student's class membership changes — keeps the enrollment
     * scope cleanly bound to the current class. Failures are swallowed so
     * a partial cleanup never rolls back a successful promotion.
     *
     * @param int $studentid
     * @param int $oldclassid    The class the student is leaving.
     * @param int $keepclassid   The class they're joining (0 = none, e.g. graduate).
     * @return array{unenrolled:int, kept:int, failed:int, total:int}
     */
    public static function unenroll_from_class_courses(int $studentid, int $oldclassid, int $keepclassid = 0): array {
        global $DB, $CFG;

        $stats = ['unenrolled' => 0, 'kept' => 0, 'failed' => 0, 'total' => 0];

        if ($studentid <= 0 || $oldclassid <= 0) {
            return $stats;
        }

        $oldcourses = $DB->get_records('istikama_class_subjects', ['classid' => $oldclassid], '', 'id, courseid');
        $stats['total'] = count($oldcourses);
        if (empty($oldcourses)) {
            return $stats;
        }

        // Build the set of courses the student must REMAIN enrolled in (those
        // belonging to the destination class). Anything in the old class but
        // also in this set is kept untouched.
        $keepcourseids = [];
        if ($keepclassid > 0) {
            $keeprows = $DB->get_records('istikama_class_subjects', ['classid' => $keepclassid], '', 'id, courseid');
            foreach ($keeprows as $r) {
                $keepcourseids[(int)$r->courseid] = true;
            }
        }

        require_once($CFG->dirroot . '/lib/enrollib.php');
        require_once($CFG->dirroot . '/enrol/manual/lib.php');

        $manualenrol = enrol_get_plugin('manual');
        if (!$manualenrol) {
            // No manual enrol plugin available — nothing we can do safely.
            $stats['failed'] = $stats['total'];
            return $stats;
        }

        foreach ($oldcourses as $cs) {
            $courseid = (int)$cs->courseid;
            if ($courseid <= 0) { continue; }

            // Skip courses that also belong to the new class — keep enrollment.
            if (isset($keepcourseids[$courseid])) {
                $stats['kept']++;
                continue;
            }

            try {
                $context = \context_course::instance($courseid, IGNORE_MISSING);
                if (!$context) { $stats['failed']++; continue; }

                if (!is_enrolled($context, $studentid, '', false)) {
                    // Already not enrolled — nothing to do.
                    $stats['kept']++;
                    continue;
                }

                $instance = $DB->get_record('enrol', [
                    'courseid' => $courseid,
                    'enrol'    => 'manual',
                ], '*', IGNORE_MULTIPLE);

                if (!$instance) {
                    // Student is enrolled via some non-manual plugin (cohort,
                    // self, etc.); don't touch — only manage manual entries.
                    $stats['kept']++;
                    continue;
                }

                $manualenrol->unenrol_user($instance, $studentid);
                $stats['unenrolled']++;
            } catch (\Throwable $e) {
                debugging('unenroll_from_class_courses failed for course ' . $courseid . ': ' . $e->getMessage(), DEBUG_DEVELOPER);
                $stats['failed']++;
            }
        }

        return $stats;
    }

    /**
     * Enroll the student in every Moodle course linked to the given class
     * via {istikama_class_subjects}. Idempotent — skips already-enrolled users.
     * Failures are swallowed (logged via debugging()) so a partial enrollment
     * never breaks the promotion that triggered it.
     *
     * @param int $studentid
     * @param int $classid   course_categories.id (depth=3)
     * @return array{enrolled:int, skipped:int, failed:int, total:int}
     */
    public static function enroll_in_class_courses(int $studentid, int $classid): array {
        global $DB, $CFG;

        $stats = ['enrolled' => 0, 'skipped' => 0, 'failed' => 0, 'total' => 0];

        if ($studentid <= 0 || $classid <= 0) {
            return $stats;
        }

        $courses = $DB->get_records('istikama_class_subjects', ['classid' => $classid], '', 'id, courseid');
        $stats['total'] = count($courses);
        if (empty($courses)) {
            return $stats;
        }

        require_once($CFG->dirroot . '/lib/enrollib.php');
        require_once($CFG->dirroot . '/enrol/manual/lib.php');

        $manualenrol  = enrol_get_plugin('manual');
        $studentroleid = (int)$DB->get_field('role', 'id', ['shortname' => 'student']);

        foreach ($courses as $cs) {
            $courseid = (int)$cs->courseid;
            if ($courseid <= 0) {
                continue;
            }
            try {
                $context = \context_course::instance($courseid, IGNORE_MISSING);
                if (!$context) { $stats['failed']++; continue; }

                if (is_enrolled($context, $studentid, '', false)) {
                    $stats['skipped']++;
                    continue;
                }

                $instance = $DB->get_record('enrol', [
                    'courseid' => $courseid,
                    'enrol'    => 'manual',
                ], '*', IGNORE_MULTIPLE);

                if (!$instance && $manualenrol) {
                    $course = $DB->get_record('course', ['id' => $courseid], 'id, shortname', IGNORE_MISSING);
                    if ($course) {
                        $instanceid = $manualenrol->add_default_instance($course);
                        if ($instanceid) {
                            $instance = $DB->get_record('enrol', ['id' => $instanceid]);
                        }
                    }
                }

                if ($instance && $manualenrol && $studentroleid) {
                    $manualenrol->enrol_user($instance, $studentid, $studentroleid);
                    $stats['enrolled']++;
                } else {
                    $stats['failed']++;
                }
            } catch (\Throwable $e) {
                debugging('enroll_in_class_courses failed for course ' . $courseid . ': ' . $e->getMessage(), DEBUG_DEVELOPER);
                $stats['failed']++;
            }
        }

        return $stats;
    }

    /**
     * Bulk promote a set of students with the same action and destination.
     *
     * @return array{ok:int, failed:int, errors:string[]}
     */
    public static function promote_bulk(
        array $studentids,
        int $fromseasonid,
        int $toseasonid,
        ?int $toclassid,
        string $action = self::ACTION_PROMOTE,
        string $notes = '',
        ?int $tolevelid = null
    ): array {
        $ok = 0;
        $failed = 0;
        $errors = [];
        foreach ($studentids as $sid) {
            $sid = (int)$sid;
            if ($sid <= 0) continue;
            try {
                self::promote_student($sid, $fromseasonid, $toseasonid, $toclassid, $action, $notes, $tolevelid);
                $ok++;
            } catch (\Throwable $e) {
                $failed++;
                $errors[] = 'Student #' . $sid . ': ' . $e->getMessage();
            }
        }
        return ['ok' => $ok, 'failed' => $failed, 'errors' => $errors];
    }

    /**
     * Promote an entire class to a new class in the next season.
     */
    public static function promote_class(
        int $fromclassid,
        int $fromseasonid,
        int $toseasonid,
        ?int $toclassid,
        string $action = self::ACTION_PROMOTE,
        string $notes = ''
    ): array {
        global $DB;
        $students = $DB->get_records('istikama_user_school', [
            'classid' => $fromclassid,
            'role' => 'student',
            'seasonid' => $fromseasonid,
        ]);
        if (empty($students)) {
            // Legacy fallback — older data without seasonid.
            $students = $DB->get_records('istikama_user_school', [
                'classid' => $fromclassid,
                'role' => 'student',
            ]);
        }
        $ids = array_map(fn($r) => (int)$r->userid, $students);
        return self::promote_bulk($ids, $fromseasonid, $toseasonid, $toclassid, $action, $notes);
    }

    /**
     * Get the promotion history for a student across all seasons.
     */
    public static function get_student_history(int $studentid): array {
        global $DB;
        return $DB->get_records('istikama_season_promotion',
            ['studentid' => $studentid], 'timecreated ASC');
    }
}
