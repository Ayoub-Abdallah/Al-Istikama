<?php
// This file is part of Moodle - http://moodle.org/

namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

/**
 * Support / ticketing service.
 *
 * Single point of access for everything ticket-related: creation, replies,
 * permission checks, notifications, status changes, listing/filtering.
 *
 * All writes go through this class so the lifecycle stays consistent and
 * notifications can never be skipped.
 */
class support_manager {

    // ── Lifecycle statuses ─────────────────────────────────────────────────
    const STATUS_OPEN          = 'open';
    const STATUS_UNDER_REVIEW  = 'under_review';
    const STATUS_IN_PROGRESS   = 'in_progress';
    const STATUS_WAITING_USER  = 'waiting_user';
    const STATUS_RESOLVED      = 'resolved';
    const STATUS_REJECTED      = 'rejected';
    const STATUS_CLOSED        = 'closed';

    // ── Categories ─────────────────────────────────────────────────────────
    const CAT_BUG     = 'bug';
    const CAT_FEATURE = 'feature';
    const CAT_ACCESS  = 'access';
    const CAT_CONTENT = 'content';
    const CAT_ACCOUNT = 'account';
    const CAT_OTHER   = 'other';

    // ── Priorities ─────────────────────────────────────────────────────────
    const PRIO_LOW    = 'low';
    const PRIO_NORMAL = 'normal';
    const PRIO_HIGH   = 'high';
    const PRIO_URGENT = 'urgent';

    /** Final statuses — ticket is considered closed for reply purposes. */
    public static function is_terminal(string $status): bool {
        return in_array($status, [self::STATUS_RESOLVED, self::STATUS_REJECTED, self::STATUS_CLOSED], true);
    }

    /** UI metadata for each status. */
    public static function get_statuses(): array {
        return [
            self::STATUS_OPEN         => ['label' => get_string('support_status_open',         'local_istikama_admin'), 'bg' => '#dbeafe', 'fg' => '#1d4ed8', 'icon' => 'fa-inbox'],
            self::STATUS_UNDER_REVIEW => ['label' => get_string('support_status_under_review', 'local_istikama_admin'), 'bg' => '#e0e7ff', 'fg' => '#4338ca', 'icon' => 'fa-magnifying-glass'],
            self::STATUS_IN_PROGRESS  => ['label' => get_string('support_status_in_progress',  'local_istikama_admin'), 'bg' => '#fef3c7', 'fg' => '#a16207', 'icon' => 'fa-gears'],
            self::STATUS_WAITING_USER => ['label' => get_string('support_status_waiting_user', 'local_istikama_admin'), 'bg' => '#fce7f3', 'fg' => '#9d174d', 'icon' => 'fa-hourglass-half'],
            self::STATUS_RESOLVED     => ['label' => get_string('support_status_resolved',     'local_istikama_admin'), 'bg' => '#dcfce7', 'fg' => '#15803d', 'icon' => 'fa-circle-check'],
            self::STATUS_REJECTED     => ['label' => get_string('support_status_rejected',     'local_istikama_admin'), 'bg' => '#fee2e2', 'fg' => '#991b1b', 'icon' => 'fa-circle-xmark'],
            self::STATUS_CLOSED       => ['label' => get_string('support_status_closed',       'local_istikama_admin'), 'bg' => '#f1f5f9', 'fg' => '#475569', 'icon' => 'fa-lock'],
        ];
    }

    public static function get_categories(): array {
        return [
            self::CAT_BUG     => ['label' => get_string('support_cat_bug',     'local_istikama_admin'), 'icon' => 'fa-bug'],
            self::CAT_FEATURE => ['label' => get_string('support_cat_feature', 'local_istikama_admin'), 'icon' => 'fa-lightbulb'],
            self::CAT_ACCESS  => ['label' => get_string('support_cat_access',  'local_istikama_admin'), 'icon' => 'fa-key'],
            self::CAT_CONTENT => ['label' => get_string('support_cat_content', 'local_istikama_admin'), 'icon' => 'fa-folder-open'],
            self::CAT_ACCOUNT => ['label' => get_string('support_cat_account', 'local_istikama_admin'), 'icon' => 'fa-user'],
            self::CAT_OTHER   => ['label' => get_string('support_cat_other',   'local_istikama_admin'), 'icon' => 'fa-circle-question'],
        ];
    }

    public static function get_priorities(): array {
        return [
            self::PRIO_LOW    => ['label' => get_string('support_prio_low',    'local_istikama_admin'), 'bg' => '#f1f5f9', 'fg' => '#475569', 'icon' => 'fa-arrow-down'],
            self::PRIO_NORMAL => ['label' => get_string('support_prio_normal', 'local_istikama_admin'), 'bg' => '#dbeafe', 'fg' => '#1d4ed8', 'icon' => 'fa-minus'],
            self::PRIO_HIGH   => ['label' => get_string('support_prio_high',   'local_istikama_admin'), 'bg' => '#fef3c7', 'fg' => '#a16207', 'icon' => 'fa-arrow-up'],
            self::PRIO_URGENT => ['label' => get_string('support_prio_urgent', 'local_istikama_admin'), 'bg' => '#fee2e2', 'fg' => '#991b1b', 'icon' => 'fa-fire'],
        ];
    }

    // ──────────────────────────────────────────────────────────────────────
    //  CREATE / READ
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Create a new ticket. Returns the new ticket id.
     *
     * @param int    $userid     Submitter
     * @param string $subject    Short title
     * @param string $body       Initial message body (plain text or simple HTML)
     * @param string $category   One of CAT_*
     * @param string $priority   One of PRIO_*
     * @param int    $draftitemid optional Moodle file draft id for attachments
     */
    public static function create_ticket(
        int $userid, string $subject, string $body,
        string $category = self::CAT_OTHER,
        string $priority = self::PRIO_NORMAL,
        int $draftitemid = 0
    ): int {
        global $DB;

        $subject = trim($subject);
        $body    = trim($body);
        if ($subject === '' || $body === '') {
            throw new \moodle_exception('support_subject_body_required', 'local_istikama_admin');
        }

        $validcats  = array_keys(self::get_categories());
        $validprios = array_keys(self::get_priorities());
        if (!in_array($category, $validcats, true))  { $category = self::CAT_OTHER; }
        if (!in_array($priority, $validprios, true)) { $priority = self::PRIO_NORMAL; }

        // Snapshot the user's tier, school, and season at creation time so
        // historical filtering still works after role/season changes.
        require_once(__DIR__ . '/../locallib.php');
        $role = function_exists('local_istikama_admin_get_user_tier')
            ? local_istikama_admin_get_user_tier($userid)
            : 'none';

        $schoolid = null;
        try {
            $row = $DB->get_record_sql(
                "SELECT schoolid FROM {istikama_user_school}
                  WHERE userid = ? AND schoolid IS NOT NULL
               ORDER BY id DESC",
                [$userid], IGNORE_MULTIPLE
            );
            if ($row) { $schoolid = (int)$row->schoolid; }
        } catch (\Throwable $e) {}

        $seasonid = null;
        try {
            if (class_exists('\local_istikama_admin\season_manager')) {
                $aid = season_manager::get_active_id();
                if ($aid > 0) { $seasonid = $aid; }
            }
        } catch (\Throwable $e) {}

        $now = time();
        $ticketid = $DB->insert_record('istikama_support_tickets', (object)[
            'userid'       => $userid,
            'role'         => $role,
            'schoolid'     => $schoolid,
            'seasonid'     => $seasonid,
            'category'     => $category,
            'priority'     => $priority,
            'subject'      => $subject,
            'message'      => $body,
            'severity'     => $priority === self::PRIO_HIGH || $priority === self::PRIO_URGENT ? 'high' : 'normal',
            'status'       => self::STATUS_OPEN,
            'assigned_to'  => null,
            'lastreplytime'=> $now,
            'lastreplyby'  => $userid,
            'timecreated'  => $now,
            'timemodified' => $now,
        ]);

        // Attach uploaded files to the ticket area.
        if ($draftitemid > 0) {
            self::save_attachments($ticketid, 0, $draftitemid, $userid);
        }

        // Notify admins.
        self::notify_admins_of_new_ticket($ticketid);

        return (int)$ticketid;
    }

    /**
     * Append a reply to a ticket. Updates lastreplytime + status if needed.
     *
     * @param int    $ticketid
     * @param int    $userid       Author
     * @param string $body
     * @param bool   $is_internal  Internal admin note (hidden from submitter)
     * @param int    $draftitemid  Optional file upload draft id
     * @return int new message id
     */
    public static function add_message(
        int $ticketid, int $userid, string $body,
        bool $is_internal = false, int $draftitemid = 0
    ): int {
        global $DB;

        $body = trim($body);
        if ($body === '') {
            throw new \moodle_exception('support_message_required', 'local_istikama_admin');
        }

        $ticket = $DB->get_record('istikama_support_tickets', ['id' => $ticketid], '*', MUST_EXIST);
        if (!self::user_can_view($ticket, $userid)) {
            throw new \required_capability_exception(\context_system::instance(), 'moodle/site:config', 'nopermissions', '');
        }
        // Only staff may post internal notes.
        if ($is_internal && !self::user_is_staff($userid)) {
            $is_internal = false;
        }

        $now = time();
        $msgid = $DB->insert_record('istikama_support_messages', (object)[
            'ticketid'    => $ticketid,
            'userid'      => $userid,
            'message'     => $body,
            'is_internal' => $is_internal ? 1 : 0,
            'is_system'   => 0,
            'timecreated' => $now,
        ]);

        if ($draftitemid > 0) {
            self::save_attachments($ticketid, (int)$msgid, $draftitemid, $userid);
        }

        // Don't bump lastreply for internal notes — keep the SLA clock honest.
        if (!$is_internal) {
            $update = (object)[
                'id'            => $ticketid,
                'lastreplytime' => $now,
                'lastreplyby'   => $userid,
                'timemodified'  => $now,
            ];

            // If a user replies to a "waiting_user" ticket, move it back to in_progress.
            if ($ticket->status === self::STATUS_WAITING_USER && (int)$ticket->userid === $userid) {
                $update->status = self::STATUS_IN_PROGRESS;
            }
            $DB->update_record('istikama_support_tickets', $update);

            self::notify_reply($ticketid, $userid);
        }

        return (int)$msgid;
    }

    /**
     * Change a ticket's status. Logs the change as a system message so the
     * conversation thread reflects the lifecycle.
     */
    public static function set_status(int $ticketid, int $userid, string $newstatus): void {
        global $DB;

        $valid = array_keys(self::get_statuses());
        if (!in_array($newstatus, $valid, true)) {
            throw new \moodle_exception('support_invalid_status', 'local_istikama_admin');
        }
        if (!self::user_is_staff($userid)) {
            throw new \required_capability_exception(\context_system::instance(), 'moodle/site:config', 'nopermissions', '');
        }

        $ticket = $DB->get_record('istikama_support_tickets', ['id' => $ticketid], '*', MUST_EXIST);
        if ($ticket->status === $newstatus) { return; }

        $now = time();
        $update = (object)[
            'id'           => $ticketid,
            'status'       => $newstatus,
            'timemodified' => $now,
        ];
        if (self::is_terminal($newstatus) && empty($ticket->resolvedtime)) {
            $update->resolvedtime = $now;
        }
        $DB->update_record('istikama_support_tickets', $update);

        // Log as a system message.
        $statuses = self::get_statuses();
        $label = $statuses[$newstatus]['label'] ?? $newstatus;
        $DB->insert_record('istikama_support_messages', (object)[
            'ticketid'    => $ticketid,
            'userid'      => $userid,
            'message'     => get_string('support_status_changed_to', 'local_istikama_admin', $label),
            'is_internal' => 0,
            'is_system'   => 1,
            'timecreated' => $now,
        ]);

        self::notify_status_change($ticketid, $userid, $newstatus);
    }

    /** Assign a ticket to a staff member (or unassign with $assigneeid = 0). */
    public static function assign(int $ticketid, int $byuserid, int $assigneeid): void {
        global $DB;
        if (!self::user_is_staff($byuserid)) {
            throw new \required_capability_exception(\context_system::instance(), 'moodle/site:config', 'nopermissions', '');
        }
        $ticket = $DB->get_record('istikama_support_tickets', ['id' => $ticketid], '*', MUST_EXIST);
        $assignee = $assigneeid > 0 ? $assigneeid : null;
        if ((int)$ticket->assigned_to === (int)$assignee) { return; }

        $now = time();
        $DB->update_record('istikama_support_tickets', (object)[
            'id'           => $ticketid,
            'assigned_to'  => $assignee,
            'timemodified' => $now,
        ]);

        // System log entry.
        $msg = $assignee
            ? get_string('support_assigned_to', 'local_istikama_admin', fullname($DB->get_record('user', ['id' => $assignee], 'firstname,lastname')))
            : get_string('support_unassigned', 'local_istikama_admin');
        $DB->insert_record('istikama_support_messages', (object)[
            'ticketid'    => $ticketid,
            'userid'      => $byuserid,
            'message'     => $msg,
            'is_internal' => 1,
            'is_system'   => 1,
            'timecreated' => $now,
        ]);
    }

    /**
     * Get a ticket plus all its visible messages, scoped to the viewer.
     *
     * Internal notes are stripped unless the viewer is staff.
     *
     * @return array{ticket: object, messages: array, attachments: array}
     */
    public static function get_ticket_with_messages(int $ticketid, int $viewerid): array {
        global $DB;
        $ticket = $DB->get_record('istikama_support_tickets', ['id' => $ticketid], '*', MUST_EXIST);
        if (!self::user_can_view($ticket, $viewerid)) {
            throw new \required_capability_exception(\context_system::instance(), 'moodle/site:config', 'nopermissions', '');
        }

        $isstaff = self::user_is_staff($viewerid);

        $where  = 'ticketid = :tid';
        $params = ['tid' => $ticketid];
        if (!$isstaff) {
            $where .= ' AND is_internal = 0';
        }
        $messages = $DB->get_records_select('istikama_support_messages', $where, $params, 'timecreated ASC');

        return [
            'ticket'   => $ticket,
            'messages' => array_values($messages),
            'is_staff' => $isstaff,
        ];
    }

    /**
     * List tickets visible to $viewerid with optional filters.
     *
     * @param int   $viewerid
     * @param array $filters keys: status, category, priority, schoolid, userid, q, sort
     * @return array of ticket rows
     */
    public static function list_tickets(int $viewerid, array $filters = []): array {
        global $DB;

        $where = [];
        $params = [];

        // Visibility scoping based on viewer tier.
        require_once(__DIR__ . '/../locallib.php');
        $tier = local_istikama_admin_get_user_tier($viewerid);

        if ($tier === 'full_admin') {
            // sees everything
        } else if ($tier === 'school_manager') {
            $schoolid = local_istikama_admin_get_manager_school();
            if ($schoolid) {
                $where[] = '(t.schoolid = :sch OR t.userid = :uidself)';
                $params['sch'] = $schoolid;
                $params['uidself'] = $viewerid;
            } else {
                $where[] = 't.userid = :uidself';
                $params['uidself'] = $viewerid;
            }
        } else {
            // Regular users (teachers, students, parents, etc.) → only own tickets.
            $where[] = 't.userid = :uidself';
            $params['uidself'] = $viewerid;
        }

        if (!empty($filters['status'])) {
            $where[] = 't.status = :status';
            $params['status'] = $filters['status'];
        }
        if (!empty($filters['category'])) {
            $where[] = 't.category = :category';
            $params['category'] = $filters['category'];
        }
        if (!empty($filters['priority'])) {
            $where[] = 't.priority = :priority';
            $params['priority'] = $filters['priority'];
        }
        if (!empty($filters['schoolid'])) {
            $where[] = 't.schoolid = :fschool';
            $params['fschool'] = (int)$filters['schoolid'];
        }
        if (!empty($filters['userid'])) {
            $where[] = 't.userid = :fuser';
            $params['fuser'] = (int)$filters['userid'];
        }
        if (!empty($filters['q'])) {
            $like = $DB->sql_like_escape($filters['q']);
            $where[] = '(' . $DB->sql_like('t.subject', ':q', false) . ' OR ' . $DB->sql_like('t.message', ':q2', false) . ')';
            $params['q'] = '%' . $like . '%';
            $params['q2'] = '%' . $like . '%';
        }
        if (!empty($filters['mine_assigned'])) {
            $where[] = 't.assigned_to = :mine';
            $params['mine'] = $viewerid;
        }

        $wsql = $where ? 'WHERE ' . implode(' AND ', $where) : '';

        // Default sort: most recently active first.
        $orderby = 't.lastreplytime DESC, t.timecreated DESC';
        if (($filters['sort'] ?? '') === 'priority') {
            $orderby = "FIELD(t.priority, 'urgent','high','normal','low'), t.lastreplytime DESC";
        }

        $sql = "SELECT t.*,
                       u.firstname, u.lastname, u.email,
                       au.firstname AS assigned_firstname, au.lastname AS assigned_lastname,
                       (SELECT COUNT(1) FROM {istikama_support_messages} m
                         WHERE m.ticketid = t.id AND m.is_internal = 0) AS message_count
                  FROM {istikama_support_tickets} t
                  JOIN {user} u  ON u.id = t.userid
             LEFT JOIN {user} au ON au.id = t.assigned_to
                  $wsql
              ORDER BY $orderby";

        return array_values($DB->get_records_sql($sql, $params));
    }

    // ──────────────────────────────────────────────────────────────────────
    //  PERMISSIONS
    // ──────────────────────────────────────────────────────────────────────

    /** Staff = anyone allowed to manage other users' tickets. */
    public static function user_is_staff(int $userid): bool {
        require_once(__DIR__ . '/../locallib.php');
        $tier = local_istikama_admin_get_user_tier($userid);
        return in_array($tier, ['full_admin', 'school_manager', 'technical_professor'], true);
    }

    /** True if $userid can VIEW the given ticket. */
    public static function user_can_view(\stdClass $ticket, int $userid): bool {
        if ((int)$ticket->userid === $userid) { return true; }
        if (self::user_is_staff($userid)) {
            require_once(__DIR__ . '/../locallib.php');
            $tier = local_istikama_admin_get_user_tier($userid);
            if ($tier === 'full_admin' || $tier === 'technical_professor') { return true; }
            // School managers: scoped to their school's tickets.
            if ($tier === 'school_manager') {
                $sch = local_istikama_admin_get_manager_school();
                return $sch && (int)$ticket->schoolid === (int)$sch;
            }
        }
        return false;
    }

    /** True if $userid can manage (change status, assign, internal note) on this ticket. */
    public static function user_can_manage(\stdClass $ticket, int $userid): bool {
        if (!self::user_is_staff($userid)) { return false; }
        return self::user_can_view($ticket, $userid);
    }

    /** True if $userid may post a (non-internal) reply on this ticket. */
    public static function user_can_reply(\stdClass $ticket, int $userid): bool {
        if (self::is_terminal($ticket->status)) {
            // Staff may still reply (re-open by changing status); regular submitter cannot.
            return self::user_can_manage($ticket, $userid);
        }
        return self::user_can_view($ticket, $userid);
    }

    /**
     * True if $userid can EDIT this ticket's body/subject/category/priority.
     *
     * Rule for the submitter: only while the ticket is still untouched —
     * i.e. status='open', no assignee yet, and not terminal.
     * Staff can always edit (within their view scope).
     */
    public static function user_can_edit(\stdClass $ticket, int $userid): bool {
        if (self::user_can_manage($ticket, $userid)) {
            return true;
        }
        if ((int)$ticket->userid !== $userid) {
            return false;
        }
        if (!empty($ticket->assigned_to)) { return false; }
        if (self::is_terminal($ticket->status)) { return false; }
        if ($ticket->status !== self::STATUS_OPEN) { return false; }
        return true;
    }

    /**
     * True if $userid can DELETE this ticket.
     *
     * Submitter: only while untouched (open, no assignee, no replies).
     * Staff with full_admin tier: always.
     */
    public static function user_can_delete(\stdClass $ticket, int $userid): bool {
        require_once(__DIR__ . '/../locallib.php');
        $tier = local_istikama_admin_get_user_tier($userid);
        if ($tier === 'full_admin') { return true; }
        if ((int)$ticket->userid !== $userid) { return false; }
        if (!empty($ticket->assigned_to)) { return false; }
        if (self::is_terminal($ticket->status)) { return false; }
        if ($ticket->status !== self::STATUS_OPEN) { return false; }
        // Submitter cannot delete once anyone else has posted on it.
        global $DB;
        $others = $DB->count_records_select('istikama_support_messages',
            'ticketid = :tid AND userid <> :uid AND is_system = 0',
            ['tid' => (int)$ticket->id, 'uid' => $userid]
        );
        return ((int)$others === 0);
    }

    // ──────────────────────────────────────────────────────────────────────
    //  UPDATE / DELETE
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Update the editable fields of a ticket (subject, body, category, priority).
     * Permission check via user_can_edit().
     */
    public static function update_ticket(
        int $ticketid, int $userid,
        string $subject, string $body,
        string $category, string $priority
    ): void {
        global $DB;

        $ticket = $DB->get_record('istikama_support_tickets', ['id' => $ticketid], '*', MUST_EXIST);
        if (!self::user_can_edit($ticket, $userid)) {
            throw new \required_capability_exception(\context_system::instance(), 'moodle/site:config', 'nopermissions', '');
        }

        $subject = trim($subject);
        $body    = trim($body);
        if ($subject === '' || $body === '') {
            throw new \moodle_exception('support_subject_body_required', 'local_istikama_admin');
        }

        $validcats  = array_keys(self::get_categories());
        $validprios = array_keys(self::get_priorities());
        if (!in_array($category, $validcats, true))  { $category = $ticket->category; }
        if (!in_array($priority, $validprios, true)) { $priority = $ticket->priority; }

        $DB->update_record('istikama_support_tickets', (object)[
            'id'           => $ticketid,
            'subject'      => $subject,
            'message'      => $body,
            'category'     => $category,
            'priority'     => $priority,
            'severity'     => in_array($priority, [self::PRIO_HIGH, self::PRIO_URGENT], true) ? 'high' : 'normal',
            'timemodified' => time(),
        ]);

        // Audit trail as a system message.
        $DB->insert_record('istikama_support_messages', (object)[
            'ticketid'    => $ticketid,
            'userid'      => $userid,
            'message'     => get_string('support_audit_edited', 'local_istikama_admin'),
            'is_internal' => 1,
            'is_system'   => 1,
            'timecreated' => time(),
        ]);
    }

    /**
     * Hard-delete a ticket and all its messages + attachments.
     * Permission check via user_can_delete().
     */
    public static function delete_ticket(int $ticketid, int $userid): void {
        global $DB;

        $ticket = $DB->get_record('istikama_support_tickets', ['id' => $ticketid], '*', MUST_EXIST);
        if (!self::user_can_delete($ticket, $userid)) {
            throw new \required_capability_exception(\context_system::instance(), 'moodle/site:config', 'nopermissions', '');
        }

        // Remove all attachments (opening post + any per-message files).
        $fs = get_file_storage();
        $context = \context_system::instance();
        $msgs = $DB->get_fieldset_select('istikama_support_messages', 'id', 'ticketid = ?', [$ticketid]);
        // Itemid pattern: ticketid * 100000 + messageid (0 = opening post).
        $itemids = [$ticketid * 100000];
        foreach ($msgs as $mid) {
            $itemids[] = ($ticketid * 100000) + (int)$mid;
        }
        foreach ($itemids as $iid) {
            $files = $fs->get_area_files($context->id, 'local_istikama_admin', 'support_ticket_attachment', $iid, 'id', false);
            foreach ($files as $f) { $f->delete(); }
        }

        $DB->delete_records('istikama_support_messages', ['ticketid' => $ticketid]);
        $DB->delete_records('istikama_support_tickets', ['id' => $ticketid]);
    }

    // ──────────────────────────────────────────────────────────────────────
    //  ATTACHMENTS — Moodle file storage
    // ──────────────────────────────────────────────────────────────────────

    /**
     * Save files from a draft area into the ticket's permanent file area.
     *
     * The Moodle file-area is keyed by ticketid (component=local_istikama_admin,
     * filearea='support_ticket_attachment'). messageid 0 = files attached to
     * the ticket's opening post; messageid > 0 = files on a specific reply.
     */
    public static function save_attachments(int $ticketid, int $messageid, int $draftitemid, int $userid): void {
        if ($draftitemid <= 0) { return; }
        $context = \context_system::instance();
        // ItemID is a packed value: ticketid * 100000 + messageid (so messages and
        // the opening post can share the same filearea without colliding).
        $itemid = ($ticketid * 100000) + $messageid;
        try {
            file_save_draft_area_files(
                $draftitemid,
                $context->id,
                'local_istikama_admin',
                'support_ticket_attachment',
                $itemid,
                ['maxfiles' => 5, 'maxbytes' => 0, 'subdirs' => 0]
            );
        } catch (\Throwable $e) {
            debugging('support_manager::save_attachments failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }
    }

    /** Return stored_file[] for a ticket (or specific message) attachments. */
    public static function get_attachments(int $ticketid, int $messageid = 0): array {
        $fs = get_file_storage();
        $context = \context_system::instance();
        $itemid = ($ticketid * 100000) + $messageid;
        $files = $fs->get_area_files($context->id, 'local_istikama_admin', 'support_ticket_attachment', $itemid, 'filename', false);
        return array_values($files);
    }

    /** Convenience: build moodle_url for a stored attachment. */
    public static function attachment_url(\stored_file $file): \moodle_url {
        return \moodle_url::make_pluginfile_url(
            $file->get_contextid(),
            $file->get_component(),
            $file->get_filearea(),
            $file->get_itemid(),
            $file->get_filepath(),
            $file->get_filename()
        );
    }

    // ──────────────────────────────────────────────────────────────────────
    //  NOTIFICATIONS
    // ──────────────────────────────────────────────────────────────────────

    /** Notify all platform admins that a new ticket was created. */
    private static function notify_admins_of_new_ticket(int $ticketid): void {
        global $DB, $CFG;
        try {
            $ticket = $DB->get_record('istikama_support_tickets', ['id' => $ticketid]);
            if (!$ticket) { return; }
            $author = $DB->get_record('user', ['id' => $ticket->userid], '*', IGNORE_MISSING);
            if (!$author) { return; }

            $admins = get_admins();
            $url = (new \moodle_url('/local/istikama_admin/support_ticket.php', ['id' => $ticketid]))->out(false);

            foreach ($admins as $admin) {
                self::send_notification(
                    $admin,
                    get_string('support_notify_new_subject', 'local_istikama_admin'),
                    get_string('support_notify_new_body', 'local_istikama_admin', (object)[
                        'author'  => fullname($author),
                        'subject' => $ticket->subject,
                    ]),
                    $url,
                    $author
                );
            }
        } catch (\Throwable $e) {
            debugging('notify_admins_of_new_ticket failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }
    }

    /** Notify the OTHER party when someone replies. */
    private static function notify_reply(int $ticketid, int $authorid): void {
        global $DB;
        try {
            $ticket = $DB->get_record('istikama_support_tickets', ['id' => $ticketid]);
            if (!$ticket) { return; }
            $author = $DB->get_record('user', ['id' => $authorid]);

            $url = (new \moodle_url('/local/istikama_admin/support_ticket.php', ['id' => $ticketid]))->out(false);

            // If author is the submitter → notify admins. Otherwise → notify submitter.
            $authorisstaff = self::user_is_staff($authorid);
            $recipients = [];
            if ($authorisstaff) {
                $sub = $DB->get_record('user', ['id' => $ticket->userid]);
                if ($sub) { $recipients[] = $sub; }
            } else {
                // Notify ticket owner if assigned, otherwise all admins.
                if ($ticket->assigned_to) {
                    $a = $DB->get_record('user', ['id' => $ticket->assigned_to]);
                    if ($a) { $recipients[] = $a; }
                } else {
                    $recipients = array_values(get_admins());
                }
            }

            foreach ($recipients as $r) {
                self::send_notification(
                    $r,
                    get_string('support_notify_reply_subject', 'local_istikama_admin'),
                    get_string('support_notify_reply_body', 'local_istikama_admin', (object)[
                        'author'  => $author ? fullname($author) : 'A user',
                        'subject' => $ticket->subject,
                    ]),
                    $url,
                    $author
                );
            }
        } catch (\Throwable $e) {
            debugging('notify_reply failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }
    }

    /** Notify the submitter that ticket status changed. */
    private static function notify_status_change(int $ticketid, int $byuserid, string $newstatus): void {
        global $DB;
        try {
            $ticket = $DB->get_record('istikama_support_tickets', ['id' => $ticketid]);
            if (!$ticket) { return; }
            if ((int)$ticket->userid === $byuserid) { return; } // self-action, no notification

            $sub = $DB->get_record('user', ['id' => $ticket->userid]);
            if (!$sub) { return; }
            $actor = $DB->get_record('user', ['id' => $byuserid]);
            $statuses = self::get_statuses();
            $label = $statuses[$newstatus]['label'] ?? $newstatus;
            $url = (new \moodle_url('/local/istikama_admin/support_ticket.php', ['id' => $ticketid]))->out(false);

            self::send_notification(
                $sub,
                get_string('support_notify_status_subject', 'local_istikama_admin'),
                get_string('support_notify_status_body', 'local_istikama_admin', (object)[
                    'subject' => $ticket->subject,
                    'status'  => $label,
                ]),
                $url,
                $actor
            );
        } catch (\Throwable $e) {
            debugging('notify_status_change failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }
    }

    /** Wrapper around Moodle's message API. */
    private static function send_notification(
        \stdClass $to, string $subject, string $body, string $url, ?\stdClass $from = null
    ): void {
        $msg = new \core\message\message();
        $msg->component         = 'moodle';
        $msg->name              = 'instantmessage';
        $msg->userfrom          = $from ?: \core_user::get_noreply_user();
        $msg->userto            = $to;
        $msg->subject           = $subject;
        $msg->fullmessage       = $body . "\n\n" . $url;
        $msg->fullmessageformat = FORMAT_PLAIN;
        $msg->fullmessagehtml   = '<p>' . s($body) . '</p><p><a href="' . s($url) . '">' . get_string('support_view_ticket', 'local_istikama_admin') . '</a></p>';
        $msg->smallmessage      = $subject;
        $msg->notification      = 1;
        $msg->contexturl        = $url;
        $msg->contexturlname    = get_string('support_title', 'local_istikama_admin');

        try { message_send($msg); } catch (\Throwable $e) {
            debugging('support send_notification failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }
    }

    // ──────────────────────────────────────────────────────────────────────
    //  ANALYTICS (admin insights)
    // ──────────────────────────────────────────────────────────────────────

    /** Aggregate KPIs for the admin support dashboard. */
    public static function get_analytics(): array {
        global $DB;
        $out = [
            'total'        => 0,
            'open'         => 0,
            'resolved'     => 0,
            'urgent'       => 0,
            'avg_resolve_hours' => null,
            'by_status'    => [],
            'by_category'  => [],
            'by_role'      => [],
            'recent_count_7d' => 0,
        ];
        try {
            $out['total']    = (int)$DB->count_records('istikama_support_tickets');
            $out['open']     = (int)$DB->count_records_select('istikama_support_tickets',
                "status IN ('open','under_review','in_progress','waiting_user')");
            $out['resolved'] = (int)$DB->count_records_select('istikama_support_tickets',
                "status IN ('resolved','closed')");
            $out['urgent']   = (int)$DB->count_records_select('istikama_support_tickets',
                "priority IN ('high','urgent') AND status NOT IN ('resolved','closed','rejected')");

            $row = $DB->get_record_sql(
                "SELECT AVG(resolvedtime - timecreated) AS avg_secs
                   FROM {istikama_support_tickets}
                  WHERE resolvedtime IS NOT NULL AND resolvedtime > timecreated"
            );
            if ($row && $row->avg_secs > 0) {
                $out['avg_resolve_hours'] = round((float)$row->avg_secs / 3600, 1);
            }

            $statusrows = $DB->get_records_sql(
                "SELECT status, COUNT(1) AS cnt
                   FROM {istikama_support_tickets}
               GROUP BY status"
            );
            foreach ($statusrows as $r) { $out['by_status'][$r->status] = (int)$r->cnt; }

            $catrows = $DB->get_records_sql(
                "SELECT category, COUNT(1) AS cnt
                   FROM {istikama_support_tickets}
               GROUP BY category"
            );
            foreach ($catrows as $r) { $out['by_category'][$r->category] = (int)$r->cnt; }

            $rolerows = $DB->get_records_sql(
                "SELECT COALESCE(role, 'unknown') AS role, COUNT(1) AS cnt
                   FROM {istikama_support_tickets}
               GROUP BY role"
            );
            foreach ($rolerows as $r) { $out['by_role'][$r->role] = (int)$r->cnt; }

            $cutoff7 = time() - 7 * DAYSECS;
            $out['recent_count_7d'] = (int)$DB->count_records_select(
                'istikama_support_tickets', 'timecreated >= :c', ['c' => $cutoff7]);
        } catch (\Throwable $e) {
            debugging('support get_analytics failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }
        return $out;
    }
}
