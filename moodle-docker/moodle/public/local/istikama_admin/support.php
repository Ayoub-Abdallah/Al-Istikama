<?php
/**
 * Technical Support — user-facing ticket list and "new ticket" page.
 *
 * Every authenticated platform user (student, teacher, parent, school manager,
 * technical professor, admin) can open and track their own tickets here.
 * Admins / staff also have a separate dashboard at support_admin.php; this
 * page is for raising and tracking issues as a user.
 *
 * Routes:
 *   GET  /local/istikama_admin/support.php          → user's ticket list + "new" form
 *   POST /local/istikama_admin/support.php          → action=create_ticket
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/filelib.php'); // for file_get_unused_draft_itemid()
require_once(__DIR__ . '/locallib.php');
require_once(__DIR__ . '/classes/support_manager.php');

use local_istikama_admin\support_manager;

require_login();

$baseurl = new moodle_url('/local/istikama_admin/support.php');
// PARAM_ALPHANUMEXT allows letters, digits, underscores — needed for
// "create_ticket", "update_ticket", "delete_ticket" action names.
$action  = optional_param('action', '', PARAM_ALPHANUMEXT);

global $DB, $USER, $PAGE, $OUTPUT;

// ── POST handler: create a new ticket ──────────────────────────────────────
if ($action === 'create_ticket' && confirm_sesskey()) {
    $subject     = required_param('subject', PARAM_TEXT);
    $body        = required_param('body', PARAM_RAW);
    $category    = optional_param('category', support_manager::CAT_OTHER, PARAM_ALPHANUMEXT);
    $priority    = optional_param('priority', support_manager::PRIO_NORMAL, PARAM_ALPHA);
    $draftitemid = optional_param('attachments', 0, PARAM_INT);

    try {
        $ticketid = support_manager::create_ticket(
            (int)$USER->id, $subject, $body, $category, $priority, $draftitemid
        );
        \core\notification::success(get_string('support_created_done', 'local_istikama_admin'));
        redirect(new moodle_url('/local/istikama_admin/support_ticket.php', ['id' => $ticketid]));
    } catch (\Throwable $e) {
        \core\notification::error($e->getMessage());
        redirect($baseurl);
    }
}

if ($action === 'update_ticket' && confirm_sesskey()) {
    $ticketid = required_param('ticketid', PARAM_INT);
    $subject  = required_param('subject', PARAM_TEXT);
    $body     = required_param('body', PARAM_RAW);
    $category = optional_param('category', support_manager::CAT_OTHER, PARAM_ALPHANUMEXT);
    $priority = optional_param('priority', support_manager::PRIO_NORMAL, PARAM_ALPHA);
    try {
        support_manager::update_ticket((int)$ticketid, (int)$USER->id, $subject, $body, $category, $priority);
        \core\notification::success(get_string('support_updated_done', 'local_istikama_admin'));
    } catch (\Throwable $e) {
        \core\notification::error($e->getMessage());
    }
    redirect($baseurl);
}

if ($action === 'delete_ticket' && confirm_sesskey()) {
    $ticketid = required_param('ticketid', PARAM_INT);
    try {
        support_manager::delete_ticket((int)$ticketid, (int)$USER->id);
        \core\notification::success(get_string('support_deleted_done', 'local_istikama_admin'));
    } catch (\Throwable $e) {
        \core\notification::error($e->getMessage());
    }
    redirect($baseurl);
}

// ── Filters ────────────────────────────────────────────────────────────────
$filters = [
    'status'   => optional_param('status',   '', PARAM_ALPHANUMEXT),
    'category' => optional_param('category', '', PARAM_ALPHANUMEXT),
    'priority' => optional_param('priority', '', PARAM_ALPHA),
    'q'        => optional_param('q', '', PARAM_TEXT),
];

$tickets = support_manager::list_tickets((int)$USER->id, $filters);

// Pre-shape rows for the template.
$statuses   = support_manager::get_statuses();
$categories = support_manager::get_categories();
$priorities = support_manager::get_priorities();

$rows = [];
$edit_rows = []; // ticketid → full row needed by the JS edit modal
foreach ($tickets as $t) {
    $st = $statuses[$t->status] ?? null;
    $pr = $priorities[$t->priority] ?? null;
    $ct = $categories[$t->category] ?? null;
    $can_edit = support_manager::user_can_edit($t, (int)$USER->id);
    $can_delete = support_manager::user_can_delete($t, (int)$USER->id);
    $rows[] = [
        'id'             => (int)$t->id,
        'subject'        => format_string($t->subject),
        'url'            => (new moodle_url('/local/istikama_admin/support_ticket.php', ['id' => $t->id]))->out(false),
        'status'         => $t->status,
        'status_label'   => $st['label'] ?? $t->status,
        'status_bg'      => $st['bg']    ?? '#f1f5f9',
        'status_fg'      => $st['fg']    ?? '#475569',
        'status_icon'    => $st['icon']  ?? 'fa-tag',
        'priority'       => $t->priority,
        'priority_label' => $pr['label'] ?? $t->priority,
        'priority_bg'    => $pr['bg']    ?? '#f1f5f9',
        'priority_fg'    => $pr['fg']    ?? '#475569',
        'priority_icon'  => $pr['icon']  ?? 'fa-flag',
        'category_label' => $ct['label'] ?? $t->category,
        'category_icon'  => $ct['icon']  ?? 'fa-tag',
        'updated'        => userdate($t->lastreplytime ?: $t->timecreated, get_string('strftimedatetimeshort', 'langconfig')),
        'message_count'  => (int)$t->message_count,
        'can_edit'       => $can_edit,
        'can_delete'     => $can_delete,
    ];
    if ($can_edit) {
        // Stash plain values so the edit modal can pre-fill instantly via JS.
        $edit_rows[(int)$t->id] = [
            'subject'  => $t->subject,
            'body'     => $t->message,
            'category' => $t->category,
            'priority' => $t->priority,
        ];
    }
}

// Filter option lists for the dropdowns.
$status_options   = [['value' => '', 'label' => get_string('support_filter_all', 'local_istikama_admin'), 'selected' => $filters['status'] === '']];
foreach ($statuses as $key => $meta) {
    $status_options[] = ['value' => $key, 'label' => $meta['label'], 'selected' => $filters['status'] === $key];
}

$cat_options = [['value' => '', 'label' => get_string('support_filter_all', 'local_istikama_admin'), 'selected' => $filters['category'] === '']];
foreach ($categories as $key => $meta) {
    $cat_options[] = ['value' => $key, 'label' => $meta['label'], 'selected' => $filters['category'] === $key];
}

$prio_options = [['value' => '', 'label' => get_string('support_filter_all', 'local_istikama_admin'), 'selected' => $filters['priority'] === '']];
foreach ($priorities as $key => $meta) {
    $prio_options[] = ['value' => $key, 'label' => $meta['label'], 'selected' => $filters['priority'] === $key];
}

// "New ticket" form selects.
$new_categories = array_map(fn($k, $m) => ['value' => $k, 'label' => $m['label'], 'icon' => $m['icon']], array_keys($categories), $categories);
$new_priorities = array_map(fn($k, $m) => ['value' => $k, 'label' => $m['label'], 'selected' => $k === support_manager::PRIO_NORMAL], array_keys($priorities), $priorities);

// Draft area for file attachments.
$draftitemid = file_get_unused_draft_itemid();

// ── Page setup ────────────────────────────────────────────────────────────
$PAGE->set_url($baseurl);
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('support_title', 'local_istikama_admin'));
$PAGE->activityheader->disable();
$PAGE->set_heading('');
$PAGE->set_secondary_navigation(false);
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

$isti_hide_page_header = true;
$isti_no_card_wrapper  = true;
require_once('admin_layout.php');

$is_staff = support_manager::user_is_staff((int)$USER->id);
$dir = right_to_left() ? 'rtl' : 'ltr';
?>
<div class="container-fluid isti-support" dir="<?= $dir ?>" style="background:#fff;padding:24px;min-height:600px">

    <!-- Page header -->
    <div class="isti-card" style="padding:22px 26px;margin-bottom:18px;display:flex;align-items:center;gap:16px;flex-wrap:wrap">
        <span style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.3rem;flex-shrink:0">
            <i class="fa fa-life-ring"></i>
        </span>
        <div style="flex:1;min-width:240px">
            <h5 style="margin:0;font-weight:700;color:#0f172a;font-size:1.15rem"><?= get_string('support_title', 'local_istikama_admin') ?></h5>
            <div style="margin-top:4px;color:#64748b;font-size:.85rem">
                <?= get_string('support_no_tickets_msg', 'local_istikama_admin') ?>
            </div>
        </div>
        <?php if ($is_staff): ?>
        <a href="<?= (new moodle_url('/local/istikama_admin/support_admin.php'))->out(false) ?>" class="isti-btn isti-btn-outline">
            <i class="fa fa-shield-halved"></i> <?= get_string('menu_support_admin', 'local_istikama_admin') ?>
        </a>
        <?php endif; ?>
        <button type="button" class="isti-btn isti-btn-primary" id="supOpenNewBtn">
            <i class="fa fa-plus"></i> <?= get_string('support_new_ticket', 'local_istikama_admin') ?>
        </button>
    </div>

    <!-- Filters -->
    <div class="isti-card" style="padding:14px 18px;margin-bottom:14px">
        <form method="get" action="<?= $baseurl->out(false) ?>" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap">
            <input type="text" name="q" value="<?= s($filters['q']) ?>" placeholder="<?= s(get_string('support_filter_search_ph', 'local_istikama_admin')) ?>"
                   style="flex:1;min-width:200px;padding:9px 13px;border:1px solid #cbd5e1;border-radius:8px">
            <select name="status" style="padding:9px 13px;border:1px solid #cbd5e1;border-radius:8px">
                <?php foreach ($status_options as $o): ?>
                    <option value="<?= s($o['value']) ?>"<?= $o['selected'] ? ' selected' : '' ?>><?= s($o['label']) ?></option>
                <?php endforeach; ?>
            </select>
            <select name="category" style="padding:9px 13px;border:1px solid #cbd5e1;border-radius:8px">
                <?php foreach ($cat_options as $o): ?>
                    <option value="<?= s($o['value']) ?>"<?= $o['selected'] ? ' selected' : '' ?>><?= s($o['label']) ?></option>
                <?php endforeach; ?>
            </select>
            <select name="priority" style="padding:9px 13px;border:1px solid #cbd5e1;border-radius:8px">
                <?php foreach ($prio_options as $o): ?>
                    <option value="<?= s($o['value']) ?>"<?= $o['selected'] ? ' selected' : '' ?>><?= s($o['label']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="isti-btn isti-btn-primary" style="padding:9px 18px"><?= get_string('support_filter_apply', 'local_istikama_admin') ?></button>
            <a href="<?= $baseurl->out(false) ?>" class="isti-btn isti-btn-outline" style="padding:9px 18px"><?= get_string('support_filter_reset', 'local_istikama_admin') ?></a>
        </form>
    </div>

    <!-- Ticket list — unified blue-header data table -->
    <div class="isti-data-table" style="margin-bottom:18px">
        <?php if (empty($rows)): ?>
            <div class="isti-data-empty">
                <i class="fa fa-inbox isti-data-empty-icon"></i>
                <div class="isti-data-empty-title"><?= get_string('support_no_tickets', 'local_istikama_admin') ?></div>
                <div class="isti-data-empty-msg"><?= get_string('support_no_tickets_msg', 'local_istikama_admin') ?></div>
            </div>
        <?php else: ?>
            <div class="isti-data-table-scroll">
                <table>
                    <thead><tr>
                        <th><?= get_string('support_table_subject',  'local_istikama_admin') ?></th>
                        <th><?= get_string('support_table_category', 'local_istikama_admin') ?></th>
                        <th><?= get_string('support_table_priority', 'local_istikama_admin') ?></th>
                        <th><?= get_string('support_table_status',   'local_istikama_admin') ?></th>
                        <th><?= get_string('support_table_updated',  'local_istikama_admin') ?></th>
                        <th class="isti-th-right">Actions</th>
                    </tr></thead>
                    <tbody>
                    <?php foreach ($rows as $r): ?>
                        <tr data-ticketid="<?= (int)$r['id'] ?>" class="isti-row-clickable" onclick="if(!event.target.closest('a, button, form')) window.location.href='<?= s($r['url']) ?>'">
                            <td>
                                <span class="isti-cell-id">#<?= (int)$r['id'] ?></span>
                                <span class="isti-cell-title"><?= s($r['subject']) ?></span>
                                <?php if ($r['message_count'] > 0): ?>
                                    <span class="isti-cell-meta"><i class="fa fa-comment"></i> <?= (int)$r['message_count'] ?> replies</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <i class="fa <?= s($r['category_icon']) ?>" style="color:#94a3b8;margin-right:5px"></i>
                                <?= s($r['category_label']) ?>
                            </td>
                            <td>
                                <span class="isti-pill" style="background:<?= s($r['priority_bg']) ?>;color:<?= s($r['priority_fg']) ?>">
                                    <i class="fa <?= s($r['priority_icon']) ?>"></i> <?= s($r['priority_label']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="isti-pill" style="background:<?= s($r['status_bg']) ?>;color:<?= s($r['status_fg']) ?>">
                                    <i class="fa <?= s($r['status_icon']) ?>"></i> <?= s($r['status_label']) ?>
                                </span>
                            </td>
                            <td style="color:#64748b;font-size:.84rem"><?= s($r['updated']) ?></td>
                            <td class="isti-td-actions">
                                <a href="<?= s($r['url']) ?>" class="isti-tbl-action" title="<?= s(get_string('support_action_view', 'local_istikama_admin')) ?>">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <?php if ($r['can_edit']): ?>
                                <button type="button" class="isti-tbl-action supEditBtn" data-ticketid="<?= (int)$r['id'] ?>"
                                        title="<?= s(get_string('support_action_edit', 'local_istikama_admin')) ?>">
                                    <i class="fa fa-pen"></i>
                                </button>
                                <?php endif; ?>
                                <?php if ($r['can_delete']): ?>
                                <button type="button" class="isti-tbl-action isti-tbl-action-danger supDeleteBtn" data-ticketid="<?= (int)$r['id'] ?>"
                                        title="<?= s(get_string('support_action_delete', 'local_istikama_admin')) ?>">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- New ticket modal (uses platform .isti-modal-overlay / .isti-modal pattern) -->
    <div class="isti-modal-overlay" id="newTicketModal" role="dialog" aria-modal="true" aria-labelledby="newTicketModalTitle" style="display:none">
        <div class="isti-modal" style="max-width:720px;width:100%">
            <div class="isti-modal-header">
                <h5 id="newTicketModalTitle" style="margin:0;font-weight:700;color:#0f172a;font-size:1.05rem;display:flex;align-items:center;gap:10px">
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;background:#eff6ff;color:#006bff;font-size:1rem">
                        <i class="fa fa-pen-to-square"></i>
                    </span>
                    <?= get_string('support_new_ticket', 'local_istikama_admin') ?>
                </h5>
                <button type="button" class="isti-btn isti-btn-outline" id="newTicketModalClose"
                        aria-label="Close" style="padding:6px 10px;border:0;background:transparent;color:#64748b;font-size:1.2rem;cursor:pointer">
                    <i class="fa fa-xmark"></i>
                </button>
            </div>
            <form method="post" action="<?= $baseurl->out(false) ?>" enctype="multipart/form-data" id="newTicketForm">
                <div class="isti-modal-body">
                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                    <input type="hidden" name="action" value="create_ticket">
                    <input type="hidden" name="attachments" value="<?= (int)$draftitemid ?>">

                    <p style="color:#64748b;font-size:.88rem;margin-bottom:18px;line-height:1.55">
                        <?= get_string('support_ticket_message_ph', 'local_istikama_admin') ?>
                    </p>

                    <div style="margin-bottom:16px">
                        <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                            <?= get_string('support_ticket_subject', 'local_istikama_admin') ?> *
                        </label>
                        <input type="text" name="subject" required maxlength="255"
                               placeholder="<?= s(get_string('support_ticket_subject_ph', 'local_istikama_admin')) ?>"
                               style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.95rem">
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                        <div>
                            <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                                <?= get_string('support_ticket_category', 'local_istikama_admin') ?>
                            </label>
                            <select name="category" style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.95rem">
                                <?php foreach ($new_categories as $c): ?>
                                    <option value="<?= s($c['value']) ?>"<?= $c['value'] === support_manager::CAT_OTHER ? ' selected' : '' ?>><?= s($c['label']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                                <?= get_string('support_ticket_priority', 'local_istikama_admin') ?>
                            </label>
                            <!-- Priority picker as colored radio chips for clearer affordance. -->
                            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:6px">
                                <?php foreach ($priorities as $key => $meta): ?>
                                <label style="cursor:pointer">
                                    <input type="radio" name="priority" value="<?= s($key) ?>"<?= $key === support_manager::PRIO_NORMAL ? ' checked' : '' ?> style="display:none" class="supPrioRadio">
                                    <span class="supPrioChip" data-value="<?= s($key) ?>"
                                          style="display:flex;align-items:center;justify-content:center;gap:6px;padding:9px 8px;border:1.5px solid #e2e8f0;border-radius:10px;background:<?= s($meta['bg']) ?>;color:<?= s($meta['fg']) ?>;font-weight:600;font-size:.82rem;transition:border-color .15s ease,box-shadow .15s ease">
                                        <i class="fa <?= s($meta['icon']) ?>"></i> <?= s($meta['label']) ?>
                                    </span>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div style="margin-bottom:16px">
                        <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                            <?= get_string('support_ticket_message', 'local_istikama_admin') ?> *
                        </label>
                        <textarea name="body" rows="6" required
                                  placeholder="<?= s(get_string('support_ticket_message_ph', 'local_istikama_admin')) ?>"
                                  style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.93rem;resize:vertical;font-family:inherit;line-height:1.6"></textarea>
                    </div>

                    <div>
                        <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                            <i class="fa fa-paperclip" style="color:#006bff"></i> <?= get_string('support_ticket_attachments', 'local_istikama_admin') ?>
                        </label>
                        <div id="supDropzone" style="border:2px dashed #cbd5e1;border-radius:12px;padding:16px;background:#f8fafc;text-align:center;cursor:pointer;transition:border-color .15s ease,background .15s ease;position:relative">
                            <i class="fa fa-cloud-upload-alt" style="font-size:1.6rem;color:#94a3b8;display:block;margin-bottom:4px"></i>
                            <span style="color:#475569;font-size:.86rem;font-weight:500"><?= get_string('support_dropzone', 'local_istikama_admin') ?></span>
                            <input type="file" name="sup_files[]" id="supFileInput" multiple
                                   style="position:absolute;left:-9999px;width:1px;height:1px;opacity:0"
                                   accept=".pdf,.doc,.docx,.txt,.jpg,.jpeg,.png,.gif,.webp,.zip">
                        </div>
                        <div id="supFileList" style="margin-top:8px;display:none"></div>
                    </div>
                </div>
                <div class="isti-modal-footer">
                    <button type="button" class="isti-btn isti-btn-outline" id="newTicketModalCancel">Cancel</button>
                    <button type="submit" class="isti-btn isti-btn-primary">
                        <i class="fa fa-paper-plane"></i> <?= get_string('support_create_btn', 'local_istikama_admin') ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ── Edit ticket modal ─────────────────────────────────────── -->
    <div class="isti-modal-overlay" id="editTicketModal" role="dialog" aria-modal="true" style="display:none">
        <div class="isti-modal" style="max-width:680px;width:100%">
            <div class="isti-modal-header">
                <h5 style="margin:0;font-weight:700;color:#0f172a;font-size:1.05rem;display:flex;align-items:center;gap:10px">
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;background:#fef3c7;color:#a16207;font-size:1rem">
                        <i class="fa fa-pen"></i>
                    </span>
                    <?= get_string('support_edit_ticket', 'local_istikama_admin') ?>
                </h5>
                <button type="button" id="editTicketModalClose" aria-label="Close" style="background:transparent;border:0;color:#64748b;font-size:1.2rem;cursor:pointer;padding:6px 10px">
                    <i class="fa fa-xmark"></i>
                </button>
            </div>
            <form method="post" action="<?= $baseurl->out(false) ?>" id="editTicketForm">
                <div class="isti-modal-body">
                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                    <input type="hidden" name="action" value="update_ticket">
                    <input type="hidden" name="ticketid" id="editTicketId" value="">

                    <div style="margin-bottom:16px">
                        <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                            <?= get_string('support_ticket_subject', 'local_istikama_admin') ?> *
                        </label>
                        <input type="text" name="subject" id="editTicketSubject" required maxlength="255"
                               style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.95rem">
                    </div>
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                        <div>
                            <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                                <?= get_string('support_ticket_category', 'local_istikama_admin') ?>
                            </label>
                            <select name="category" id="editTicketCategory"
                                    style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.95rem">
                                <?php foreach ($categories as $key => $meta): ?>
                                    <option value="<?= s($key) ?>"><?= s($meta['label']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                                <?= get_string('support_ticket_priority', 'local_istikama_admin') ?>
                            </label>
                            <select name="priority" id="editTicketPriority"
                                    style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.95rem">
                                <?php foreach ($priorities as $key => $meta): ?>
                                    <option value="<?= s($key) ?>"><?= s($meta['label']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                            <?= get_string('support_ticket_message', 'local_istikama_admin') ?> *
                        </label>
                        <textarea name="body" id="editTicketBody" rows="6" required
                                  style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.93rem;resize:vertical;font-family:inherit;line-height:1.6"></textarea>
                    </div>
                </div>
                <div class="isti-modal-footer">
                    <button type="button" id="editTicketModalCancel" class="isti-btn isti-btn-outline"><?= get_string('support_cancel', 'local_istikama_admin') ?></button>
                    <button type="submit" class="isti-btn isti-btn-primary">
                        <i class="fa fa-floppy-disk"></i> <?= get_string('support_save_changes', 'local_istikama_admin') ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ── Delete-confirm modal ───────────────────────────────────── -->
    <div class="isti-modal-overlay" id="deleteTicketModal" role="dialog" aria-modal="true" style="display:none">
        <div class="isti-modal" style="max-width:480px;width:100%">
            <div class="isti-modal-header">
                <h5 style="margin:0;font-weight:700;color:#991b1b;font-size:1.05rem;display:flex;align-items:center;gap:10px">
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;background:#fee2e2;color:#dc2626;font-size:1rem">
                        <i class="fa fa-triangle-exclamation"></i>
                    </span>
                    <?= get_string('support_delete_ticket', 'local_istikama_admin') ?>
                </h5>
                <button type="button" id="deleteTicketModalClose" aria-label="Close" style="background:transparent;border:0;color:#64748b;font-size:1.2rem;cursor:pointer;padding:6px 10px">
                    <i class="fa fa-xmark"></i>
                </button>
            </div>
            <form method="post" action="<?= $baseurl->out(false) ?>" id="deleteTicketForm">
                <div class="isti-modal-body">
                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                    <input type="hidden" name="action" value="delete_ticket">
                    <input type="hidden" name="ticketid" id="deleteTicketId" value="">
                    <p style="color:#0f172a;font-size:.95rem;line-height:1.6;margin:0"><?= get_string('support_delete_confirm', 'local_istikama_admin') ?></p>
                    <p id="deleteTicketSubjectLine" style="margin-top:10px;color:#475569;font-size:.88rem;background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:10px 14px"></p>
                </div>
                <div class="isti-modal-footer">
                    <button type="button" id="deleteTicketModalCancel" class="isti-btn isti-btn-outline"><?= get_string('support_cancel', 'local_istikama_admin') ?></button>
                    <button type="submit" class="isti-btn" style="background:#dc2626;color:#fff;border:0;padding:9px 18px">
                        <i class="fa fa-trash"></i> <?= get_string('support_delete_ticket', 'local_istikama_admin') ?>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
(function() {
    // ── Modal open / close ──────────────────────────────────────────────
    var modal      = document.getElementById('newTicketModal');
    var openBtn    = document.getElementById('supOpenNewBtn');
    var closeBtn   = document.getElementById('newTicketModalClose');
    var cancelBtn  = document.getElementById('newTicketModalCancel');

    function showModal() {
        if (!modal) return;
        modal.style.display = 'flex';
        // Allow the browser to paint with display:flex first, then animate in.
        requestAnimationFrame(function() { modal.classList.add('visible'); });
        document.body.style.overflow = 'hidden';
    }
    function hideModal() {
        if (!modal) return;
        modal.classList.remove('visible');
        document.body.style.overflow = '';
        // Wait for the CSS transition to finish before display:none.
        setTimeout(function() { modal.style.display = 'none'; }, 200);
    }
    if (openBtn)   openBtn.addEventListener('click',   function(e) { e.preventDefault(); showModal(); });
    if (closeBtn)  closeBtn.addEventListener('click',  function(e) { e.preventDefault(); hideModal(); });
    if (cancelBtn) cancelBtn.addEventListener('click', function(e) { e.preventDefault(); hideModal(); });
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) { hideModal(); }
        });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('visible')) { hideModal(); }
        });
    }

    // Auto-open if URL ends with #new (e.g. from a "Need help?" call-to-action elsewhere).
    if (window.location.hash === '#new') { showModal(); }

    // ── Generic modal helper for edit + delete modals ───────────────────
    function bindModal(modalId, closeIds) {
        var m = document.getElementById(modalId);
        if (!m) return { show: function(){}, hide: function(){} };
        function show() {
            m.style.display = 'flex';
            requestAnimationFrame(function() { m.classList.add('visible'); });
            document.body.style.overflow = 'hidden';
        }
        function hide() {
            m.classList.remove('visible');
            document.body.style.overflow = '';
            setTimeout(function() { m.style.display = 'none'; }, 200);
        }
        (closeIds || []).forEach(function(id) {
            var el = document.getElementById(id);
            if (el) el.addEventListener('click', function(e) { e.preventDefault(); hide(); });
        });
        m.addEventListener('click', function(e) { if (e.target === m) hide(); });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && m.classList.contains('visible')) hide();
        });
        return { show: show, hide: hide };
    }

    var editModalCtl   = bindModal('editTicketModal',   ['editTicketModalClose',   'editTicketModalCancel']);
    var deleteModalCtl = bindModal('deleteTicketModal', ['deleteTicketModalClose', 'deleteTicketModalCancel']);

    // ── Edit ticket — fill modal from server-side stash ────────────────
    var EDIT_DATA = <?= json_encode($edit_rows, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
    document.querySelectorAll('.supEditBtn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var id = btn.getAttribute('data-ticketid');
            var data = EDIT_DATA[id];
            if (!data) return;
            document.getElementById('editTicketId').value      = id;
            document.getElementById('editTicketSubject').value = data.subject || '';
            document.getElementById('editTicketBody').value    = data.body || '';
            var cat = document.getElementById('editTicketCategory');
            if (cat) cat.value = data.category || 'other';
            var pr  = document.getElementById('editTicketPriority');
            if (pr)  pr.value = data.priority || 'normal';
            editModalCtl.show();
        });
    });

    // ── Delete ticket — show confirm modal ─────────────────────────────
    document.querySelectorAll('.supDeleteBtn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var id = btn.getAttribute('data-ticketid');
            document.getElementById('deleteTicketId').value = id;
            // Show the ticket subject for clarity.
            var row = btn.closest('tr');
            var subj = row ? row.querySelector('td').innerText.trim() : '';
            document.getElementById('deleteTicketSubjectLine').innerText = subj;
            deleteModalCtl.show();
        });
    });

    // ── Priority chip picker (visual radio) ─────────────────────────────
    function paintPriorityChips() {
        var radios = document.querySelectorAll('.supPrioRadio');
        radios.forEach(function(r) {
            var chip = r.parentElement.querySelector('.supPrioChip');
            if (!chip) return;
            if (r.checked) {
                chip.style.borderColor = chip.style.color || '#006bff';
                chip.style.boxShadow = '0 0 0 3px rgba(0, 107, 255, 0.10)';
            } else {
                chip.style.borderColor = '#e2e8f0';
                chip.style.boxShadow = 'none';
            }
        });
    }
    document.querySelectorAll('.supPrioRadio').forEach(function(r) {
        r.addEventListener('change', paintPriorityChips);
    });
    paintPriorityChips();

    // ── File dropzone ───────────────────────────────────────────────────
    var dz = document.getElementById('supDropzone');
    var fi = document.getElementById('supFileInput');
    var fl = document.getElementById('supFileList');
    if (!dz || !fi || !fl) { return; }
    function renderFiles() {
        if (!fi.files || fi.files.length === 0) { fl.style.display = 'none'; fl.innerHTML = ''; return; }
        fl.style.display = 'block';
        var h = '<div style="background:#fff;border:1px solid #e2e8f0;border-radius:10px;padding:8px 12px">';
        for (var i = 0; i < fi.files.length; i++) {
            var f = fi.files[i];
            var size = (f.size / 1024).toFixed(1) + ' KB';
            if (f.size > 1024 * 1024) size = (f.size / (1024 * 1024)).toFixed(1) + ' MB';
            h += '<div style="display:flex;align-items:center;gap:10px;padding:5px 0">'
              + '<i class="fa fa-file" style="color:#64748b"></i>'
              + '<span style="flex:1;font-size:.85rem;color:#334155">' + (f.name || '') + '</span>'
              + '<span style="font-size:.78rem;color:#94a3b8">' + size + '</span>'
              + '</div>';
        }
        h += '</div>';
        fl.innerHTML = h;
    }
    dz.addEventListener('click', function() { fi.click(); });
    fi.addEventListener('change', renderFiles);
    ['dragenter','dragover'].forEach(function(ev) {
        dz.addEventListener(ev, function(e) { e.preventDefault(); e.stopPropagation();
            dz.style.borderColor = '#006bff'; dz.style.background = '#eff6ff'; });
    });
    ['dragleave','drop'].forEach(function(ev) {
        dz.addEventListener(ev, function(e) { e.preventDefault(); e.stopPropagation();
            dz.style.borderColor = '#cbd5e1'; dz.style.background = '#f8fafc'; });
    });
    dz.addEventListener('drop', function(e) {
        if (e.dataTransfer && e.dataTransfer.files && e.dataTransfer.files.length) {
            fi.files = e.dataTransfer.files; renderFiles();
        }
    });
})();
</script>

<?php
echo '</div>';   // close .container-fluid
echo '</div>';   // close .istikama-dashboard-container from admin_layout.php
echo $OUTPUT->footer();
