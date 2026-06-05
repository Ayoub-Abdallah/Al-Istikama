<?php
// This file is part of Moodle - http://moodle.org/

namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

/**
 * Library / Content-Bank content manager.
 *
 * Centralizes:
 *  - Status moderation workflow (free transitions between any two statuses).
 *  - Per-content metadata edits (name, description, keywords).
 *  - Multi-level + multi-subject set/get (M:N tables).
 *  - Status-change audit log.
 *
 * Status changes are intentionally FREE: an admin/manager can move content
 * from any status to any other (approved → rejected → pending → approved
 * temporarily → ...). This is a moderation system, not a one-way pipeline.
 */
class content_manager {

    // Canonical status keys. Must match the cb_status_* lang strings.
    const STATUS_PENDING              = 'pending';
    const STATUS_REVIEWING            = 'reviewing';
    const STATUS_APPROVED             = 'approved';
    const STATUS_APPROVED_TEMPORARILY = 'approved_temp';
    const STATUS_REJECTED             = 'rejected';
    const STATUS_ARCHIVED             = 'archived';

    /**
     * Canonical, ordered list of moderation statuses with UI metadata.
     */
    public static function get_statuses(): array {
        return [
            self::STATUS_PENDING => [
                'label'    => get_string('lib_status_pending',       'local_istikama_admin'),
                'badge_bg' => '#fef3c7', 'badge_fg' => '#92400e', 'icon' => 'fa-hourglass-half',
            ],
            self::STATUS_REVIEWING => [
                'label'    => get_string('lib_status_reviewing',     'local_istikama_admin'),
                'badge_bg' => '#dbeafe', 'badge_fg' => '#1e40af', 'icon' => 'fa-search',
            ],
            self::STATUS_APPROVED => [
                'label'    => get_string('lib_status_approved',      'local_istikama_admin'),
                'badge_bg' => '#d1fae5', 'badge_fg' => '#047857', 'icon' => 'fa-check-circle',
            ],
            self::STATUS_APPROVED_TEMPORARILY => [
                'label'    => get_string('lib_status_approved_temp', 'local_istikama_admin'),
                'badge_bg' => '#e0f2fe', 'badge_fg' => '#075985', 'icon' => 'fa-clock',
            ],
            self::STATUS_REJECTED => [
                'label'    => get_string('lib_status_rejected',      'local_istikama_admin'),
                'badge_bg' => '#fee2e2', 'badge_fg' => '#991b1b', 'icon' => 'fa-times-circle',
            ],
            self::STATUS_ARCHIVED => [
                'label'    => get_string('lib_status_archived',      'local_istikama_admin'),
                'badge_bg' => '#f1f5f9', 'badge_fg' => '#475569', 'icon' => 'fa-archive',
            ],
        ];
    }

    public static function is_valid_status(string $status): bool {
        return array_key_exists($status, self::get_statuses());
    }

    /**
     * Fetch a content item by id. Returns null if not found.
     */
    public static function get(int $id): ?\stdClass {
        global $DB;
        $rec = $DB->get_record('istikama_content_bank', ['id' => $id]);
        return $rec ?: null;
    }

    // -----------------------------------------------------------------------
    // Levels (M:N)
    // -----------------------------------------------------------------------

    /** Returns the level keys associated with a content item. */
    public static function get_levels(int $contentid): array {
        global $DB;
        $rows = $DB->get_records('istikama_content_levels', ['content_id' => $contentid], 'level_key ASC', 'level_key');
        return array_values(array_map(fn($r) => $r->level_key, $rows));
    }

    /** Replace the level set for a content item (atomic). */
    public static function set_levels(int $contentid, array $levelkeys): void {
        global $DB;
        $clean = [];
        foreach ($levelkeys as $k) {
            $k = trim((string)$k);
            if ($k !== '' && \core_text::strlen($k) <= 100) {
                $clean[$k] = true;
            }
        }
        $now = time();
        $transaction = $DB->start_delegated_transaction();
        try {
            $DB->delete_records('istikama_content_levels', ['content_id' => $contentid]);
            foreach (array_keys($clean) as $k) {
                $DB->insert_record('istikama_content_levels', (object)[
                    'content_id'  => $contentid,
                    'level_key'   => $k,
                    'timecreated' => $now,
                ]);
            }
            // Keep the denormalized single-value column in sync with the FIRST level
            // so legacy queries that read istikama_content_bank.level still work.
            $primary = !empty($clean) ? array_key_first($clean) : '';
            $DB->set_field('istikama_content_bank', 'level', $primary, ['id' => $contentid]);
            $transaction->allow_commit();
        } catch (\Throwable $e) {
            $transaction->rollback($e);
            throw $e;
        }
    }

    // -----------------------------------------------------------------------
    // Subjects (M:N)
    // -----------------------------------------------------------------------

    public static function get_subjects(int $contentid): array {
        global $DB;
        $rows = $DB->get_records('istikama_content_subjects', ['content_id' => $contentid], 'subject_key ASC', 'subject_key');
        return array_values(array_map(fn($r) => $r->subject_key, $rows));
    }

    public static function set_subjects(int $contentid, array $subjectkeys): void {
        global $DB;
        $clean = [];
        foreach ($subjectkeys as $k) {
            $k = trim((string)$k);
            if ($k !== '' && \core_text::strlen($k) <= 100) {
                $clean[$k] = true;
            }
        }
        $now = time();
        $transaction = $DB->start_delegated_transaction();
        try {
            $DB->delete_records('istikama_content_subjects', ['content_id' => $contentid]);
            foreach (array_keys($clean) as $k) {
                $DB->insert_record('istikama_content_subjects', (object)[
                    'content_id'  => $contentid,
                    'subject_key' => $k,
                    'timecreated' => $now,
                ]);
            }
            $primary = !empty($clean) ? array_key_first($clean) : '';
            $DB->set_field('istikama_content_bank', 'subject', $primary, ['id' => $contentid]);
            $transaction->allow_commit();
        } catch (\Throwable $e) {
            $transaction->rollback($e);
            throw $e;
        }
    }

    // -----------------------------------------------------------------------
    // Status (free transitions)
    // -----------------------------------------------------------------------

    /**
     * Change a content item's status. Any → any transition is permitted —
     * moderation is reversible by design. Writes an audit row to
     * {istikama_content_status_history}.
     */
    public static function change_status(int $contentid, string $newstatus, string $notes = ''): void {
        global $DB, $USER;

        if (!self::is_valid_status($newstatus)) {
            throw new \moodle_exception('lib_invalid_status', 'local_istikama_admin');
        }
        $content = self::get($contentid);
        if (!$content) {
            throw new \moodle_exception('invalidrecord', 'error', '', 'istikama_content_bank');
        }
        $old = $content->status ?? self::STATUS_PENDING;
        if ($old === $newstatus) {
            return; // no-op
        }

        $now = time();
        $transaction = $DB->start_delegated_transaction();
        try {
            $DB->update_record('istikama_content_bank', (object)[
                'id'           => $contentid,
                'status'       => $newstatus,
                'approved_by'  => $newstatus === self::STATUS_APPROVED ? (int)$USER->id : null,
                'timemodified' => $now,
            ]);
            $DB->insert_record('istikama_content_status_history', (object)[
                'content_id'  => $contentid,
                'old_status'  => $old,
                'new_status'  => $newstatus,
                'changed_by'  => (int)$USER->id,
                'notes'       => $notes,
                'timecreated' => $now,
            ]);
            $transaction->allow_commit();
        } catch (\Throwable $e) {
            $transaction->rollback($e);
            throw $e;
        }
    }

    /** Status-change audit trail for a content item (oldest first). */
    public static function get_status_history(int $contentid): array {
        global $DB;
        return $DB->get_records_sql(
            "SELECT h.*, u.firstname, u.lastname
               FROM {istikama_content_status_history} h
          LEFT JOIN {user} u ON u.id = h.changed_by
              WHERE h.content_id = :cid
           ORDER BY h.timecreated ASC",
            ['cid' => $contentid]
        );
    }

    // -----------------------------------------------------------------------
    // Metadata edit
    // -----------------------------------------------------------------------

    /**
     * Update editable metadata fields on a content item.
     * Only the keys present in $data are touched. Unknown keys are ignored.
     *
     * Accepted keys: name, description, keywords (comma-separated string),
     *                content_type, external_url.
     */
    public static function update_metadata(int $contentid, array $data): void {
        global $DB;
        $content = self::get($contentid);
        if (!$content) {
            throw new \moodle_exception('invalidrecord', 'error', '', 'istikama_content_bank');
        }

        $allowed = ['name', 'description', 'keywords', 'content_type', 'external_url', 'category'];
        $rec = ['id' => $contentid, 'timemodified' => time()];
        foreach ($allowed as $field) {
            if (array_key_exists($field, $data)) {
                $rec[$field] = (string)$data[$field];
            }
        }
        if (isset($rec['name']) && trim($rec['name']) === '') {
            throw new \moodle_exception('lib_name_required', 'local_istikama_admin');
        }
        $DB->update_record('istikama_content_bank', (object)$rec);
    }

    // -----------------------------------------------------------------------
    // Preview URL builder — used by the in-page preview modal.
    // -----------------------------------------------------------------------

    /**
     * Build a preview descriptor for a content item. Returns the JSON-able
     * structure that the JS modal uses to render the appropriate viewer
     * (YouTube embed, PDF iframe, native video, image, generic link, or
     * download fallback).
     *
     * @return array{type:string, url:string, filename:string, mime:string}
     *               type ∈ youtube | pdf | video | image | audio | link | download | none
     */
    public static function build_preview(\stdClass $content): array {
        global $CFG;
        $out = ['type' => 'none', 'url' => '', 'filename' => '', 'mime' => ''];

        $raw = trim((string)($content->external_url ?? ''));
        if ($raw !== '') {
            // YouTube — accept watch, youtu.be, embed, shorts.
            if (preg_match('!youtu\.be/([A-Za-z0-9_-]{6,20})!', $raw, $m) ||
                preg_match('!youtube(?:-nocookie)?\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/)([A-Za-z0-9_-]{6,20})!', $raw, $m)) {
                $out['type'] = 'youtube';
                $out['url']  = 'https://www.youtube-nocookie.com/embed/' . $m[1] . '?rel=0&modestbranding=1';
                return $out;
            }
            $out['type'] = 'link';
            $out['url']  = $raw;
            return $out;
        }

        if (!empty($content->filename)) {
            $context = \context_system::instance();
            $fileurl = \moodle_url::make_pluginfile_url(
                $context->id, 'local_istikama_admin', 'content', $content->id, '/', $content->filename
            )->out(false);
            $ext = strtolower(pathinfo($content->filename, PATHINFO_EXTENSION));
            $out['url']      = $fileurl;
            $out['filename'] = $content->filename;
            if ($ext === 'pdf')                                                  { $out['type'] = 'pdf';   $out['mime'] = 'application/pdf'; }
            elseif (in_array($ext, ['mp4','webm','ogg','mov','m4v'], true))       { $out['type'] = 'video'; $out['mime'] = 'video/' . ($ext === 'mov' ? 'quicktime' : $ext); }
            elseif (in_array($ext, ['jpg','jpeg','png','gif','webp','svg'], true)){ $out['type'] = 'image'; $out['mime'] = 'image/' . ($ext === 'jpg' ? 'jpeg' : $ext); }
            elseif (in_array($ext, ['mp3','wav','m4a','aac','flac'], true))       { $out['type'] = 'audio'; $out['mime'] = 'audio/' . $ext; }
            else                                                                  { $out['type'] = 'download'; }
            return $out;
        }
        return $out;
    }

    /**
     * Return the catalog of available levels and subjects discoverable in the
     * system. Combines existing istikama_global_level + existing data in the
     * M:N tables so the picker can present everything that's already known.
     */
    public static function get_known_levels_and_subjects(): array {
        global $DB;
        $levels = [];
        // From global level catalog if present.
        if ($DB->get_manager()->table_exists('istikama_global_level')) {
            $rows = $DB->get_records('istikama_global_level', null, 'order_index ASC, name ASC', 'name');
            foreach ($rows as $r) { $levels[$r->name] = true; }
        }
        // From existing content_bank rows.
        $rows = $DB->get_records_sql("SELECT DISTINCT level FROM {istikama_content_bank} WHERE level IS NOT NULL AND level <> ''");
        foreach ($rows as $r) { $levels[$r->level] = true; }
        // From content_levels M:N rows.
        $rows = $DB->get_records_sql("SELECT DISTINCT level_key FROM {istikama_content_levels}");
        foreach ($rows as $r) { $levels[$r->level_key] = true; }

        $subjects = [];
        // From existing content_bank rows.
        $rows = $DB->get_records_sql("SELECT DISTINCT subject FROM {istikama_content_bank} WHERE subject IS NOT NULL AND subject <> ''");
        foreach ($rows as $r) { $subjects[$r->subject] = true; }
        $rows = $DB->get_records_sql("SELECT DISTINCT subject_key FROM {istikama_content_subjects}");
        foreach ($rows as $r) { $subjects[$r->subject_key] = true; }

        return [
            'levels'   => array_keys($levels),
            'subjects' => array_keys($subjects),
        ];
    }
}
