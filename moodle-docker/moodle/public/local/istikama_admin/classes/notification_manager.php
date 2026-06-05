<?php
// This file is part of Moodle - http://moodle.org/

namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

/**
 * School-manager notifications service.
 *
 * One row in {istikama_school_notification} per notification. When sent,
 * recipients are resolved from {istikama_user_school} according to the
 * audience filters (role / class / level) and a Moodle message is sent to
 * each via the standard message_send() API.
 *
 * Recipient counts are stored on the row for the analytics dashboard.
 */
class notification_manager {

    const STATUS_DRAFT     = 'draft';
    const STATUS_SCHEDULED = 'scheduled';
    const STATUS_SENT      = 'sent';

    /** Audience roles users can pick when composing. */
    public static function get_audience_roles(): array {
        return [
            'all'     => ['label' => get_string('sn_aud_all',     'local_istikama_admin'), 'icon' => 'fa-users'],
            'student' => ['label' => get_string('sn_aud_student', 'local_istikama_admin'), 'icon' => 'fa-user-graduate'],
            'teacher' => ['label' => get_string('sn_aud_teacher', 'local_istikama_admin'), 'icon' => 'fa-chalkboard-user'],
            'parent'  => ['label' => get_string('sn_aud_parent',  'local_istikama_admin'), 'icon' => 'fa-people-roof'],
        ];
    }

    public static function get_statuses(): array {
        return [
            self::STATUS_DRAFT     => ['label' => get_string('sn_status_draft',     'local_istikama_admin'), 'bg' => '#f1f5f9', 'fg' => '#475569', 'icon' => 'fa-pen-to-square'],
            self::STATUS_SCHEDULED => ['label' => get_string('sn_status_scheduled', 'local_istikama_admin'), 'bg' => '#fef3c7', 'fg' => '#a16207', 'icon' => 'fa-clock'],
            self::STATUS_SENT      => ['label' => get_string('sn_status_sent',      'local_istikama_admin'), 'bg' => '#dcfce7', 'fg' => '#15803d', 'icon' => 'fa-paper-plane'],
        ];
    }

    /**
     * Create a draft notification. Returns new id.
     */
    public static function create(
        int $schoolid, int $createdby,
        string $title, string $body,
        ?string $audience_role = null,
        ?int $audience_classid = null,
        ?int $audience_levelid = null,
        ?int $scheduledfor = null
    ): int {
        global $DB;
        $title = trim($title);
        $body  = trim($body);
        if ($title === '' || $body === '') {
            throw new \moodle_exception('sn_title_body_required', 'local_istikama_admin');
        }
        $now = time();
        $status = ($scheduledfor && $scheduledfor > $now) ? self::STATUS_SCHEDULED : self::STATUS_DRAFT;
        $id = $DB->insert_record('istikama_school_notification', (object)[
            'schoolid'         => $schoolid,
            'createdby'        => $createdby,
            'title'            => $title,
            'body'             => $body,
            'audience_role'    => $audience_role === '' ? null : $audience_role,
            'audience_classid' => $audience_classid ?: null,
            'audience_levelid' => $audience_levelid ?: null,
            'status'           => $status,
            'scheduledfor'     => $scheduledfor ?: null,
            'recipients_count' => 0,
            'read_count'       => 0,
            'timecreated'      => $now,
            'timemodified'     => $now,
        ]);
        return (int)$id;
    }

    /**
     * Resolve recipient userids for a notification's audience filters.
     */
    public static function resolve_recipients(\stdClass $n): array {
        global $DB;
        $params = ['sch' => (int)$n->schoolid];
        $where  = ['us.schoolid = :sch', 'u.deleted = 0', 'u.suspended = 0'];

        // Role: "all" / "" / null → no role filter.
        if (!empty($n->audience_role) && $n->audience_role !== 'all') {
            $where[] = 'us.role = :role';
            $params['role'] = $n->audience_role;
        }
        if (!empty($n->audience_classid)) {
            $where[] = 'us.classid = :cls';
            $params['cls'] = (int)$n->audience_classid;
        }
        if (!empty($n->audience_levelid)) {
            $where[] = 'us.levelid = :lvl';
            $params['lvl'] = (int)$n->audience_levelid;
        }
        $sql = "SELECT DISTINCT u.id, u.firstname, u.lastname, u.email, u.maildisplay
                  FROM {istikama_user_school} us
                  JOIN {user} u ON u.id = us.userid
                 WHERE " . implode(' AND ', $where);
        return array_values($DB->get_records_sql($sql, $params));
    }

    /**
     * Send a draft or scheduled notification immediately.
     * Updates status='sent', records recipients_count.
     *
     * Returns the recipient count.
     */
    public static function send(int $notificationid, int $byuserid): int {
        global $DB;
        $n = $DB->get_record('istikama_school_notification', ['id' => $notificationid], '*', MUST_EXIST);
        if ($n->status === self::STATUS_SENT) {
            // Idempotent — already sent.
            return (int)$n->recipients_count;
        }

        $recipients = self::resolve_recipients($n);
        $now = time();
        $from = $DB->get_record('user', ['id' => $byuserid], '*', IGNORE_MISSING) ?: \core_user::get_noreply_user();
        // Point recipients at the role-agnostic viewer — school_notifications.php
        // is gated by require_school_manager() and would 403 for students /
        // teachers / parents with "Change site configuration" capability error.
        $url = (new \moodle_url('/local/istikama_admin/notification_view.php', ['id' => $notificationid]))->out(false);

        $sent = 0;
        foreach ($recipients as $r) {
            try {
                $msg = new \core\message\message();
                $msg->component         = 'moodle';
                $msg->name              = 'instantmessage';
                $msg->userfrom          = $from;
                $msg->userto            = $r;
                $msg->subject           = format_string($n->title);
                $msg->fullmessage       = $n->body . "\n\n" . $url;
                $msg->fullmessageformat = FORMAT_PLAIN;
                $msg->fullmessagehtml   = '<p>' . nl2br(s($n->body)) . '</p><p><a href="' . s($url) . '">' . get_string('sn_view_in_platform', 'local_istikama_admin') . '</a></p>';
                $msg->smallmessage      = $n->title;
                $msg->notification      = 1;
                $msg->contexturl        = $url;
                $msg->contexturlname    = get_string('school_notifications_title', 'local_istikama_admin');
                if (message_send($msg)) { $sent++; }
            } catch (\Throwable $e) {
                debugging('notification send failed for user ' . $r->id . ': ' . $e->getMessage(), DEBUG_DEVELOPER);
            }
        }

        $DB->update_record('istikama_school_notification', (object)[
            'id'               => $notificationid,
            'status'           => self::STATUS_SENT,
            'sentat'           => $now,
            'sentby'           => $byuserid,
            'recipients_count' => $sent,
            'timemodified'     => $now,
        ]);
        return $sent;
    }

    /** Delete (only drafts/scheduled — sent ones stay as history). */
    public static function delete(int $notificationid): void {
        global $DB;
        $n = $DB->get_record('istikama_school_notification', ['id' => $notificationid], '*', MUST_EXIST);
        if ($n->status === self::STATUS_SENT) {
            throw new \moodle_exception('sn_cannot_delete_sent', 'local_istikama_admin');
        }
        $DB->delete_records('istikama_school_notification', ['id' => $notificationid]);
    }

    /**
     * Listing with filters.
     */
    public static function list_for_school(int $schoolid, array $filters = []): array {
        global $DB;
        $where  = ['schoolid = :sch'];
        $params = ['sch' => $schoolid];

        if (!empty($filters['status'])) {
            $where[] = 'status = :status';
            $params['status'] = $filters['status'];
        }
        if (!empty($filters['q'])) {
            $where[] = '(' . $DB->sql_like('title', ':q', false) . ' OR ' . $DB->sql_like('body', ':q2', false) . ')';
            $params['q']  = '%' . $DB->sql_like_escape($filters['q']) . '%';
            $params['q2'] = '%' . $DB->sql_like_escape($filters['q']) . '%';
        }
        $sql = "SELECT * FROM {istikama_school_notification}
                 WHERE " . implode(' AND ', $where) . "
              ORDER BY COALESCE(sentat, scheduledfor, timecreated) DESC";
        return array_values($DB->get_records_sql($sql, $params));
    }

    /** Quick analytics for the school dashboard. */
    public static function get_analytics(int $schoolid): array {
        global $DB;
        $out = [
            'total' => 0, 'sent' => 0, 'scheduled' => 0, 'drafts' => 0,
            'total_recipients' => 0, 'recent_7d' => 0,
        ];
        try {
            $out['total']     = (int)$DB->count_records('istikama_school_notification', ['schoolid' => $schoolid]);
            $out['sent']      = (int)$DB->count_records('istikama_school_notification', ['schoolid' => $schoolid, 'status' => self::STATUS_SENT]);
            $out['scheduled'] = (int)$DB->count_records('istikama_school_notification', ['schoolid' => $schoolid, 'status' => self::STATUS_SCHEDULED]);
            $out['drafts']    = (int)$DB->count_records('istikama_school_notification', ['schoolid' => $schoolid, 'status' => self::STATUS_DRAFT]);
            $totrec = $DB->get_field_sql(
                "SELECT SUM(recipients_count) FROM {istikama_school_notification}
                  WHERE schoolid = :sch AND status = 'sent'",
                ['sch' => $schoolid]
            );
            $out['total_recipients'] = (int)($totrec ?: 0);
            $cutoff = time() - 7 * DAYSECS;
            $out['recent_7d'] = (int)$DB->count_records_select(
                'istikama_school_notification',
                'schoolid = :sch AND sentat >= :cutoff',
                ['sch' => $schoolid, 'cutoff' => $cutoff]
            );
        } catch (\Throwable $e) {
            debugging('notification analytics failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }
        return $out;
    }
}
