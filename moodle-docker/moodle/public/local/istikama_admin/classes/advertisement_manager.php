<?php
// This file is part of Moodle - http://moodle.org/

namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

/**
 * Advertisements & Announcements service.
 *
 * Admins create flexible ads/announcements (school trips, events, promos,
 * messages) and choose, per ad:
 *   - placement : where it appears (popup, sidebar, login) — any combination
 *   - trigger   : when a popup fires (every visit, on login, on return, once)
 *   - audience  : who sees it (all, student, teacher, parent)
 *   - schedule  : start/end window
 *   - dismissible : whether students can permanently remove it
 *
 * Images live in Moodle file storage (filearea 'advertisement_image',
 * itemid = ad id) and are rendered responsively from their natural aspect
 * ratio on the client. Dismissals are tracked server-side so they persist.
 */
class advertisement_manager {

    // Placement surfaces (stored as a comma set in `placement`).
    const PLACE_POPUP   = 'popup';
    const PLACE_SIDEBAR = 'sidebar';
    const PLACE_LOGIN   = 'login';

    // Popup trigger rules.
    const TRIGGER_EVERYVISIT = 'everyvisit'; // once per browser session
    const TRIGGER_LOGIN      = 'login';      // only right after logging in
    const TRIGGER_RETURN     = 'return';     // when returning after a quiet spell
    const TRIGGER_ONCE       = 'once';       // a single time, ever, per user

    // Status.
    const STATUS_ACTIVE   = 'active';
    const STATUS_INACTIVE = 'inactive';

    /** Idle minutes before a TRIGGER_RETURN popup is considered "a return". */
    const RETURN_IDLE_MINUTES = 30;

    public static function get_placements(): array {
        // Two real render surfaces. "On login / on return" is a popup TIMING
        // choice (see get_triggers), not a separate surface — a login-only
        // placement would never render, so it is intentionally not offered here.
        return [
            self::PLACE_POPUP   => ['label' => get_string('ad_place_popup',   'local_istikama_admin'), 'icon' => 'fa-window-restore'],
            self::PLACE_SIDEBAR => ['label' => get_string('ad_place_sidebar', 'local_istikama_admin'), 'icon' => 'fa-table-columns'],
        ];
    }

    public static function get_triggers(): array {
        return [
            self::TRIGGER_EVERYVISIT => get_string('ad_trig_everyvisit', 'local_istikama_admin'),
            self::TRIGGER_LOGIN      => get_string('ad_trig_login',      'local_istikama_admin'),
            self::TRIGGER_RETURN     => get_string('ad_trig_return',     'local_istikama_admin'),
            self::TRIGGER_ONCE       => get_string('ad_trig_once',       'local_istikama_admin'),
        ];
    }

    public static function get_audiences(): array {
        return [
            'all'     => get_string('ad_aud_all',     'local_istikama_admin'),
            'student' => get_string('ad_aud_student', 'local_istikama_admin'),
            'teacher' => get_string('ad_aud_teacher', 'local_istikama_admin'),
            'parent'  => get_string('ad_aud_parent',  'local_istikama_admin'),
        ];
    }

    public static function get_statuses(): array {
        return [
            self::STATUS_ACTIVE   => ['label' => get_string('ad_status_active',   'local_istikama_admin'), 'bg' => '#dcfce7', 'fg' => '#15803d', 'icon' => 'fa-circle-check'],
            self::STATUS_INACTIVE => ['label' => get_string('ad_status_inactive', 'local_istikama_admin'), 'bg' => '#f1f5f9', 'fg' => '#475569', 'icon' => 'fa-circle-pause'],
        ];
    }

    /** True if $userid may manage ads (create/edit/delete). */
    public static function user_is_admin(int $userid = 0): bool {
        require_once(__DIR__ . '/../locallib.php');
        $tier = local_istikama_admin_get_user_tier($userid ?: null);
        return in_array($tier, ['full_admin', 'school_manager'], true);
    }

    // ──────────────────────────────────────────────────────────────────────
    //  CRUD
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Create or update an advertisement. Returns the ad id.
     *
     * @param array $data keys: id?, title, content, linkurl, linktext, placement[],
     *                    trigger_rule, audience, schoolid, dismissible, priority,
     *                    bgcolor, status, starttime, endtime, draftitemid
     */
    public static function save(array $data, int $userid): int {
        global $DB;

        $title = trim($data['title'] ?? '');
        if ($title === '') {
            throw new \moodle_exception('ad_title_required', 'local_istikama_admin');
        }

        // Normalise placement set.
        $places = $data['placement'] ?? [];
        if (is_string($places)) { $places = explode(',', $places); }
        $valid = array_keys(self::get_placements());
        $places = array_values(array_intersect($valid, array_map('trim', $places)));
        if (empty($places)) { $places = [self::PLACE_POPUP]; }

        $trigger = in_array($data['trigger_rule'] ?? '', array_keys(self::get_triggers()), true)
            ? $data['trigger_rule'] : self::TRIGGER_EVERYVISIT;
        $audience = in_array($data['audience'] ?? '', array_keys(self::get_audiences()), true)
            ? $data['audience'] : 'student';
        $status = (($data['status'] ?? self::STATUS_ACTIVE) === self::STATUS_INACTIVE)
            ? self::STATUS_INACTIVE : self::STATUS_ACTIVE;

        $now = time();
        $record = (object)[
            'title'        => $title,
            'content'      => $data['content'] ?? null,
            'linkurl'      => trim($data['linkurl'] ?? '') ?: null,
            'linktext'     => trim($data['linktext'] ?? '') ?: null,
            'placement'    => implode(',', $places),
            'trigger_rule' => $trigger,
            'audience'     => $audience,
            'schoolid'     => !empty($data['schoolid']) ? (int)$data['schoolid'] : null,
            'dismissible'  => !empty($data['dismissible']) ? 1 : 0,
            'priority'     => (int)($data['priority'] ?? 0),
            'bgcolor'      => trim($data['bgcolor'] ?? '') ?: null,
            'status'       => $status,
            'starttime'    => !empty($data['starttime']) ? (int)$data['starttime'] : null,
            'endtime'      => !empty($data['endtime']) ? (int)$data['endtime'] : null,
            'timemodified' => $now,
        ];

        if (!empty($data['id'])) {
            $record->id = (int)$data['id'];
            $DB->update_record('istikama_advertisement', $record);
            $adid = (int)$record->id;
        } else {
            $record->createdby   = $userid;
            $record->viewcount   = 0;
            $record->clickcount  = 0;
            $record->timecreated = $now;
            $adid = (int)$DB->insert_record('istikama_advertisement', $record);
        }

        // Save uploaded image into the ad's permanent filearea.
        if (!empty($data['draftitemid'])) {
            self::save_image($adid, (int)$data['draftitemid']);
        }

        return $adid;
    }

    public static function get(int $adid): ?\stdClass {
        global $DB;
        $r = $DB->get_record('istikama_advertisement', ['id' => $adid]);
        return $r ?: null;
    }

    public static function delete(int $adid): void {
        global $DB;
        // Remove image files.
        $fs = get_file_storage();
        $ctx = \context_system::instance();
        foreach ($fs->get_area_files($ctx->id, 'local_istikama_admin', 'advertisement_image', $adid, 'id', false) as $f) {
            $f->delete();
        }
        $DB->delete_records('istikama_ad_dismissal', ['adid' => $adid]);
        $DB->delete_records('istikama_advertisement', ['id' => $adid]);
    }

    public static function set_status(int $adid, string $status): void {
        global $DB;
        $status = ($status === self::STATUS_INACTIVE) ? self::STATUS_INACTIVE : self::STATUS_ACTIVE;
        $DB->update_record('istikama_advertisement', (object)[
            'id' => $adid, 'status' => $status, 'timemodified' => time(),
        ]);
    }

    /** All ads for the admin list (newest first), optional filters. */
    public static function list_all(array $filters = []): array {
        global $DB;
        $where = []; $params = [];
        if (!empty($filters['status'])) { $where[] = 'status = :status'; $params['status'] = $filters['status']; }
        if (!empty($filters['placement'])) {
            $where[] = $DB->sql_like('placement', ':pl', false);
            $params['pl'] = '%' . $DB->sql_like_escape($filters['placement']) . '%';
        }
        if (!empty($filters['q'])) {
            $where[] = '(' . $DB->sql_like('title', ':q', false) . ' OR ' . $DB->sql_like('content', ':q2', false) . ')';
            $params['q'] = '%' . $DB->sql_like_escape($filters['q']) . '%';
            $params['q2'] = '%' . $DB->sql_like_escape($filters['q']) . '%';
        }
        $wsql = $where ? 'WHERE ' . implode(' AND ', $where) : '';
        return array_values($DB->get_records_sql(
            "SELECT * FROM {istikama_advertisement} $wsql ORDER BY priority DESC, timecreated DESC", $params));
    }

    // ──────────────────────────────────────────────────────────────────────
    //  IMAGES — Moodle file storage
    // ──────────────────────────────────────────────────────────────────────

    public static function save_image(int $adid, int $draftitemid): void {
        if ($draftitemid <= 0) { return; }
        $ctx = \context_system::instance();
        try {
            file_save_draft_area_files($draftitemid, $ctx->id, 'local_istikama_admin',
                'advertisement_image', $adid, ['maxfiles' => 1, 'maxbytes' => 0, 'subdirs' => 0]);
        } catch (\Throwable $e) {
            debugging('advertisement_manager::save_image failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }
    }

    /**
     * Store an uploaded image (from a plain multipart $_FILES upload) into the
     * ad's filearea, replacing any existing image. This is the reliable path
     * for our custom dropzone (a raw <input type=file> does NOT populate a
     * Moodle draft area, which is why draft-area saving silently saved nothing).
     */
    public static function replace_image_from_path(int $adid, string $tmppath, string $filename): bool {
        if ($adid <= 0 || $tmppath === '' || !is_readable($tmppath)) { return false; }
        $fs  = get_file_storage();
        $ctx = \context_system::instance();
        $clean = clean_param($filename, PARAM_FILE);
        if ($clean === '') { $clean = 'ad-image-' . $adid . '.png'; }
        try {
            // Remove any existing image first (single-image filearea).
            foreach ($fs->get_area_files($ctx->id, 'local_istikama_admin', 'advertisement_image', $adid, 'id', false) as $f) {
                $f->delete();
            }
            $fs->create_file_from_pathname([
                'contextid' => $ctx->id,
                'component' => 'local_istikama_admin',
                'filearea'  => 'advertisement_image',
                'itemid'    => $adid,
                'filepath'  => '/',
                'filename'  => $clean,
            ], $tmppath);
            return true;
        } catch (\Throwable $e) {
            debugging('advertisement_manager::replace_image_from_path failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
            return false;
        }
    }

    /** First stored image file for an ad, or null. */
    public static function get_image_file(int $adid): ?\stored_file {
        $fs = get_file_storage();
        $ctx = \context_system::instance();
        $files = $fs->get_area_files($ctx->id, 'local_istikama_admin', 'advertisement_image', $adid, 'filename', false);
        return $files ? reset($files) : null;
    }

    public static function image_url(int $adid): ?string {
        $f = self::get_image_file($adid);
        if (!$f) { return null; }
        return \moodle_url::make_pluginfile_url(
            $f->get_contextid(), $f->get_component(), $f->get_filearea(),
            $f->get_itemid(), $f->get_filepath(), $f->get_filename()
        )->out(false);
    }

    // ──────────────────────────────────────────────────────────────────────
    //  STUDENT-FACING RESOLUTION
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Resolve the ads visible to $userid right now for a given surface.
     *
     * @param int    $userid
     * @param string $surface  PLACE_POPUP | PLACE_SIDEBAR | PLACE_LOGIN
     * @return array of payload arrays (id,title,content,image,width,height,…)
     */
    public static function get_visible(int $userid, string $surface): array {
        global $DB;
        if ($userid <= 0) { return []; }

        require_once(__DIR__ . '/../locallib.php');
        $tier = local_istikama_admin_get_user_tier($userid);

        // Map tier → audience bucket.
        $bucket = 'all';
        if ($tier === 'student') { $bucket = 'student'; }
        else if (in_array($tier, ['teacher', 'teacher_creator'], true)) { $bucket = 'teacher'; }
        else if ($tier === 'parent') { $bucket = 'parent'; }

        // The viewer's school (for school-scoped ads).
        $schoolid = 0;
        try {
            $row = $DB->get_record_sql(
                "SELECT schoolid FROM {istikama_user_school}
                  WHERE userid = ? AND schoolid IS NOT NULL ORDER BY id DESC",
                [$userid], IGNORE_MULTIPLE);
            if ($row) { $schoolid = (int)$row->schoolid; }
        } catch (\Throwable $e) {}

        $now = time();
        $params = ['now1' => $now, 'now2' => $now, 'surface' => '%' . $surface . '%'];
        $audSql = '(a.audience = :auda OR a.audience = :audb)';
        $params['auda'] = 'all';
        $params['audb'] = $bucket;

        $schoolSql = '(a.schoolid IS NULL';
        if ($schoolid > 0) { $schoolSql .= ' OR a.schoolid = :sch'; $params['sch'] = $schoolid; }
        $schoolSql .= ')';

        $sql = "SELECT a.*
                  FROM {istikama_advertisement} a
                 WHERE a.status = 'active'
                   AND " . $DB->sql_like('a.placement', ':surface', false) . "
                   AND $audSql
                   AND $schoolSql
                   AND (a.starttime IS NULL OR a.starttime <= :now1)
                   AND (a.endtime   IS NULL OR a.endtime   >= :now2)
              ORDER BY a.priority DESC, a.timecreated DESC";
        $rows = $DB->get_records_sql($sql, $params);
        if (empty($rows)) { return []; }

        // Exclude ones the user permanently dismissed (sidebar) or already saw
        // (popup TRIGGER_ONCE).
        $dismissed = $DB->get_records_sql(
            "SELECT adid, reason FROM {istikama_ad_dismissal} WHERE userid = ?", [$userid]);
        $dismissedIds = [];
        foreach ($dismissed as $d) {
            $dismissedIds[(int)$d->adid][$d->reason] = true;
        }

        $statuses = self::get_statuses();
        $out = [];
        foreach ($rows as $a) {
            $aid = (int)$a->id;
            // Sidebar: hide if dismissed.
            if ($surface === self::PLACE_SIDEBAR && !empty($dismissedIds[$aid]['dismissed'])) {
                continue;
            }
            // Popup "once ever": hide if seen.
            if ($surface === self::PLACE_POPUP && $a->trigger_rule === self::TRIGGER_ONCE
                && !empty($dismissedIds[$aid]['seen'])) {
                continue;
            }
            $img = self::get_image_file($aid);
            $imgurl = null; $w = 0; $h = 0;
            if ($img) {
                $imgurl = \moodle_url::make_pluginfile_url($img->get_contextid(), $img->get_component(),
                    $img->get_filearea(), $img->get_itemid(), $img->get_filepath(), $img->get_filename())->out(false);
                $info = $img->get_imageinfo();
                if ($info) { $w = (int)$info['width']; $h = (int)$info['height']; }
            }
            $out[] = [
                'id'          => $aid,
                'title'       => format_string($a->title),
                'content'     => $a->content ? format_text($a->content, FORMAT_HTML) : '',
                'image'       => $imgurl,
                'width'       => $w,
                'height'      => $h,
                'linkurl'     => $a->linkurl,
                'linktext'    => $a->linktext,
                'placement'   => $a->placement,
                'trigger'     => $a->trigger_rule,
                'dismissible' => (int)$a->dismissible === 1,
                'bgcolor'     => $a->bgcolor,
            ];
        }
        return $out;
    }

    /** Record a dismissal or a "seen" event (idempotent, upsert). */
    public static function mark(int $adid, int $userid, string $reason): void {
        global $DB;
        $reason = ($reason === 'seen') ? 'seen' : 'dismissed';
        if ($adid <= 0 || $userid <= 0) { return; }
        if (!$DB->record_exists('istikama_ad_dismissal', ['adid' => $adid, 'userid' => $userid, 'reason' => $reason])) {
            try {
                $DB->insert_record('istikama_ad_dismissal', (object)[
                    'adid' => $adid, 'userid' => $userid, 'reason' => $reason, 'timecreated' => time(),
                ]);
            } catch (\Throwable $e) {
                // Unique race — ignore.
            }
        }
    }

    /** Increment a counter (view|click) without a full row load. */
    public static function bump(int $adid, string $what): void {
        global $DB;
        $col = ($what === 'click') ? 'clickcount' : 'viewcount';
        try {
            $DB->execute("UPDATE {istikama_advertisement} SET $col = $col + 1 WHERE id = ?", [$adid]);
        } catch (\Throwable $e) {}
    }
}
