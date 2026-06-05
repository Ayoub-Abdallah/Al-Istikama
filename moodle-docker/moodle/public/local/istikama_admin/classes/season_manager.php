<?php
// This file is part of Moodle - http://moodle.org/

namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

/**
 * Academic Season manager.
 *
 * Lifecycle (Phase 2 — explicit, no silent demotion):
 *
 *   draft     - newly created, editable, not yet usable
 *   upcoming  - scheduled to start later
 *   active    - the current season (ONLY ONE allowed; all writes target it)
 *   closed    - ended (manually closed by admin, OR end_date auto-closed by cron);
 *               no new actions allowed; data retained but read-only
 *   archived  - permanently preserved past season (terminal)
 *
 * Transitions allowed:
 *   draft     -> upcoming, active (only if no other active)
 *   upcoming  -> active (only if no other active), draft
 *   active    -> closed              (admin confirms close, OR cron at end_date)
 *   closed    -> archived            (preserve forever)
 *               -> active            (admin safety net: re-open a wrongly-closed season,
 *                                     only if no other active)
 *   archived  -> (terminal)
 *
 * Hard rules:
 *   - Cannot activate a season while another is active. The current one must be
 *     CLOSED first. (No silent auto-archive.)
 *   - Cannot perform platform actions when no active season exists. UI gates
 *     this via local_istikama_admin_require_active_season().
 */
class season_manager {

    /** Allowed status values. */
    const STATUS_DRAFT    = 'draft';
    const STATUS_UPCOMING = 'upcoming';
    const STATUS_ACTIVE   = 'active';
    const STATUS_ARCHIVED = 'archived';
    const STATUS_CLOSED   = 'closed';

    /**
     * Full status registry — labels + UI metadata.
     */
    public static function get_statuses(): array {
        return [
            self::STATUS_DRAFT    => ['label' => 'Draft',    'badge_bg' => '#f1f5f9', 'badge_fg' => '#475569', 'icon' => 'fa-pencil-alt'],
            self::STATUS_UPCOMING => ['label' => 'Upcoming', 'badge_bg' => '#dbeafe', 'badge_fg' => '#1e40af', 'icon' => 'fa-calendar'],
            self::STATUS_ACTIVE   => ['label' => 'Active',   'badge_bg' => '#d1fae5', 'badge_fg' => '#047857', 'icon' => 'fa-check-circle'],
            self::STATUS_ARCHIVED => ['label' => 'Archived', 'badge_bg' => '#fef3c7', 'badge_fg' => '#92400e', 'icon' => 'fa-archive'],
            self::STATUS_CLOSED   => ['label' => 'Closed',   'badge_bg' => '#fee2e2', 'badge_fg' => '#991b1b', 'icon' => 'fa-lock'],
        ];
    }

    /**
     * Status values that block data writes (immutability).
     *
     * Only the ACTIVE season is writable. Everything else (draft, upcoming,
     * closed, archived) is read-only for actions/data.
     */
    public static function get_write_blocking_statuses(): array {
        return [self::STATUS_DRAFT, self::STATUS_UPCOMING, self::STATUS_CLOSED, self::STATUS_ARCHIVED];
    }

    // -----------------------------------------------------------------
    // Reads
    // -----------------------------------------------------------------

    public static function get(int $id): ?\stdClass {
        global $DB;
        $rec = $DB->get_record('istikama_season', ['id' => $id]);
        return $rec ?: null;
    }

    public static function get_all(): array {
        global $DB;
        return $DB->get_records('istikama_season', null, 'start_date DESC, id DESC');
    }

    /**
     * Return the single active season, or null if none.
     */
    public static function get_active(): ?\stdClass {
        global $DB;
        $rec = $DB->get_record('istikama_season', ['status' => self::STATUS_ACTIVE], '*', IGNORE_MULTIPLE);
        return $rec ?: null;
    }

    /**
     * Return the active season's id (0 if none). Use this as the safe
     * default `seasonid` when writing data anywhere in the platform.
     */
    public static function get_active_id(): int {
        $s = self::get_active();
        return $s ? (int)$s->id : 0;
    }

    /**
     * Is there an active season? UI gating / activation prerequisite.
     */
    public static function has_active(): bool {
        return self::get_active_id() > 0;
    }

    /**
     * Determine the initial status for a new season based on its dates.
     *
     * - start_date > now               → upcoming  (future season)
     * - start_date <= now, end >= now  → active (if no other active) OR upcoming
     * - end_date < now                 → archived  (past; shouldn't happen after validation)
     */
    public static function determine_auto_status(int $start_date, int $end_date): string {
        $now = time();
        if ($start_date > $now) {
            return self::STATUS_UPCOMING;
        }
        if ($end_date >= $now) {
            return self::has_active() ? self::STATUS_UPCOMING : self::STATUS_ACTIVE;
        }
        return self::STATUS_ARCHIVED;
    }

    /**
     * Is the given season status one that blocks writes?
     */
    public static function is_write_blocked(int $seasonid): bool {
        if ($seasonid <= 0) {
            return false;
        }
        $s = self::get($seasonid);
        if (!$s) {
            return false;
        }
        return in_array($s->status, self::get_write_blocking_statuses(), true);
    }

    // -----------------------------------------------------------------
    // Writes — lifecycle
    // -----------------------------------------------------------------

    /**
     * Create a new season. Defaults to status=draft.
     *
     * @param object $data Fields: name, description, start_date, end_date, status (optional).
     * @return int New season id.
     * @throws \moodle_exception on validation failure.
     */
    public static function create(object $data): int {
        global $DB, $USER;

        self::validate_data($data);

        $status = self::determine_auto_status((int)$data->start_date, (int)$data->end_date);

        $now = time();
        $rec = (object)[
            'name'         => trim((string)$data->name),
            'description'  => isset($data->description) ? (string)$data->description : '',
            'start_date'   => (int)$data->start_date,
            'end_date'     => (int)$data->end_date,
            'status'       => $status,
            'created_by'   => (int)$USER->id,
            'timecreated'  => $now,
            'timemodified' => $now,
        ];

        return (int)$DB->insert_record('istikama_season', $rec);
    }

    /**
     * Update season name/description/dates (but NOT status — use change_status).
     *
     * Blocks edits to archived/closed seasons.
     */
    public static function update(int $id, object $data): void {
        global $DB;
        $existing = self::get($id);
        if (!$existing) {
            throw new \moodle_exception('invalidrecord', 'error', '', 'Season');
        }
        // Closed and archived seasons are immutable.
        if (in_array($existing->status, [self::STATUS_CLOSED, self::STATUS_ARCHIVED], true)) {
            throw new \moodle_exception('season_immutable', 'local_istikama_admin');
        }

        self::validate_data($data, $id);

        // Active season: end_date cannot be moved into the past.
        // (You can extend it, you can't already-end it via the form.)
        if ($existing->status === self::STATUS_ACTIVE) {
            $newend = (int)$data->end_date;
            if ($newend < time()) {
                throw new \moodle_exception('season_end_in_past', 'local_istikama_admin');
            }
        }

        $rec = (object)[
            'id'           => $id,
            'name'         => trim((string)$data->name),
            'description'  => isset($data->description) ? (string)$data->description : '',
            'start_date'   => (int)$data->start_date,
            'end_date'     => (int)$data->end_date,
            'timemodified' => time(),
        ];
        $DB->update_record('istikama_season', $rec);
    }

    /**
     * Change the status of a season, enforcing the transition matrix.
     *
     * Activating a season atomically demotes the previous active one to archived.
     */
    public static function change_status(int $id, string $newstatus): void {
        global $DB;

        $season = self::get($id);
        if (!$season) {
            throw new \moodle_exception('invalidrecord', 'error', '', 'Season');
        }

        $statuses = self::get_statuses();
        if (!isset($statuses[$newstatus])) {
            throw new \moodle_exception('invalid_status', 'local_istikama_admin');
        }

        if ($season->status === $newstatus) {
            return;
        }

        if (!self::is_transition_allowed($season->status, $newstatus)) {
            throw new \moodle_exception('season_transition_not_allowed', 'local_istikama_admin', '',
                $season->status . ' -> ' . $newstatus);
        }

        // Activating: refuse if the season has not started yet.
        if ($newstatus === self::STATUS_ACTIVE && $season->start_date > time()) {
            throw new \moodle_exception('season_not_started_yet', 'local_istikama_admin');
        }

        // Activating: refuse if another season is already active.
        // The current active season must be CLOSED first (explicit close, no silent demotion).
        if ($newstatus === self::STATUS_ACTIVE) {
            $other = self::get_active();
            if ($other && (int)$other->id !== $id) {
                throw new \moodle_exception('season_already_active', 'local_istikama_admin');
            }
        }

        $DB->update_record('istikama_season', (object)[
            'id' => $id,
            'status' => $newstatus,
            'timemodified' => time(),
        ]);

        // When a season is ACTIVATED, materialize the Moodle-course
        // enrollments for every student already queued under that season.
        // Those students were pre-promoted while the season was still
        // upcoming, so they had a row in {istikama_user_school} but no
        // matching Moodle enrolments yet. Now is the time.
        if ($newstatus === self::STATUS_ACTIVE) {
            try {
                promotion_manager::sync_active_enrollments($id);
            } catch (\Throwable $e) {
                debugging('season activation enrollment sync failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
            }
        }
    }

    /**
     * Delete a season — only allowed if draft and no data references it.
     */
    public static function delete(int $id): void {
        global $DB;
        $season = self::get($id);
        if (!$season) {
            return;
        }
        $deletable = [self::STATUS_DRAFT, self::STATUS_UPCOMING];
        if (!in_array($season->status, $deletable, true)) {
            throw new \moodle_exception('season_delete_not_draft', 'local_istikama_admin');
        }

        // Refuse if any season-stamped data references this season.
        $tables = ['istikama_user_school', 'istikama_attendance', 'istikama_assessments', 'istikama_teacher_activities', 'istikama_teacher_subject'];
        foreach ($tables as $t) {
            if (!$DB->get_manager()->table_exists($t)) {
                continue;
            }
            $cols = $DB->get_columns($t);
            if (!isset($cols['seasonid'])) {
                continue;
            }
            if ($DB->record_exists($t, ['seasonid' => $id])) {
                throw new \moodle_exception('season_delete_has_data', 'local_istikama_admin');
            }
        }

        $DB->delete_records('istikama_season', ['id' => $id]);
    }

    // -----------------------------------------------------------------
    // Internal
    // -----------------------------------------------------------------

    /**
     * Transition matrix.
     */
    private static function is_transition_allowed(string $from, string $to): bool {
        $matrix = [
            self::STATUS_DRAFT    => [self::STATUS_UPCOMING, self::STATUS_ACTIVE],
            self::STATUS_UPCOMING => [self::STATUS_ACTIVE, self::STATUS_DRAFT],
            self::STATUS_ACTIVE   => [self::STATUS_CLOSED],
            self::STATUS_CLOSED   => [self::STATUS_ARCHIVED, self::STATUS_ACTIVE],
            self::STATUS_ARCHIVED => [self::STATUS_CLOSED], // restorable to closed
        ];
        return isset($matrix[$from]) && in_array($to, $matrix[$from], true);
    }

    /**
     * Auto-close any active seasons whose end_date is in the past.
     * Called by the scheduled task.
     *
     * @return int Number of seasons closed.
     */
    public static function auto_close_expired(): int {
        global $DB;
        $now = time();
        $sql = "SELECT * FROM {istikama_season} WHERE status = :status AND end_date > 0 AND end_date < :now";
        $expired = $DB->get_records_sql($sql, ['status' => self::STATUS_ACTIVE, 'now' => $now]);
        $count = 0;
        foreach ($expired as $s) {
            $DB->update_record('istikama_season', (object)[
                'id' => $s->id,
                'status' => self::STATUS_CLOSED,
                'timemodified' => $now,
            ]);
            $count++;
        }
        return $count;
    }

    /**
     * Auto-correct impossible status combinations caused by data entry errors.
     *
     * Rule: a season whose start_date is still in the future must never be Closed
     * (Closed implies the season ran as active and was ended). Reset such seasons
     * to Upcoming so they can be properly activated when their date arrives.
     *
     * @return int Number of seasons corrected.
     */
    public static function auto_correct_statuses(): int {
        global $DB;
        $now = time();
        $sql = "SELECT * FROM {istikama_season} WHERE status = :closed AND start_date > :now";
        $wrong = $DB->get_records_sql($sql, ['closed' => self::STATUS_CLOSED, 'now' => $now]);
        $count = 0;
        foreach ($wrong as $s) {
            $DB->update_record('istikama_season', (object)[
                'id'           => (int)$s->id,
                'status'       => self::STATUS_UPCOMING,
                'timemodified' => $now,
            ]);
            $count++;
        }
        return $count;
    }

    /**
     * Validate season form data.
     *
     * @param object $data
     * @param int $excludeid skip this id during name-uniqueness check (for edits).
     */
    private static function validate_data(object $data, int $excludeid = 0): void {
        global $DB;

        $name = isset($data->name) ? trim((string)$data->name) : '';
        if ($name === '') {
            throw new \moodle_exception('season_name_required', 'local_istikama_admin');
        }
        if (\core_text::strlen($name) > 100) {
            throw new \moodle_exception('season_name_too_long', 'local_istikama_admin');
        }

        $start = isset($data->start_date) ? (int)$data->start_date : 0;
        $end   = isset($data->end_date)   ? (int)$data->end_date   : 0;
        if ($start <= 0 || $end <= 0) {
            throw new \moodle_exception('season_dates_required', 'local_istikama_admin');
        }
        if ($end <= $start) {
            throw new \moodle_exception('season_end_before_start', 'local_istikama_admin');
        }

        // New seasons cannot start in the past.
        if ($excludeid === 0) {
            $midnight_today = mktime(0, 0, 0, (int)date('n'), (int)date('j'), (int)date('Y'));
            if ($start < $midnight_today) {
                throw new \moodle_exception('season_start_in_past', 'local_istikama_admin');
            }
        }

        // Uniqueness on name.
        $params = ['name' => $name];
        $sql = "SELECT id FROM {istikama_season} WHERE " . $DB->sql_compare_text('name') . " = " . $DB->sql_compare_text(':name');
        if ($excludeid > 0) {
            $sql .= " AND id <> :excludeid";
            $params['excludeid'] = $excludeid;
        }
        if ($DB->record_exists_sql($sql, $params)) {
            throw new \moodle_exception('season_name_taken', 'local_istikama_admin');
        }

        // Overlap check: seasons must never intersect each other's date ranges.
        // Two ranges [s1,e1] and [s2,e2] overlap iff s1 <= e2 AND s2 <= e1.
        $overlapsql = "SELECT id, name FROM {istikama_season} WHERE start_date <= :end AND end_date >= :start";
        $overlapparams = ['start' => $start, 'end' => $end];
        if ($excludeid > 0) {
            $overlapsql .= " AND id <> :excludeid";
            $overlapparams['excludeid'] = $excludeid;
        }
        $clashing = $DB->get_records_sql($overlapsql, $overlapparams, 0, 1);
        if (!empty($clashing)) {
            $other = reset($clashing);
            throw new \moodle_exception('season_dates_overlap', 'local_istikama_admin', '', $other->name);
        }
    }
}
