<?php
/**
 * Technical Support — single-ticket detail page.
 *
 * Renders the conversation thread for one ticket, lets the viewer post a
 * reply, lets staff post internal notes, change status, and assign the
 * ticket to another staff member.
 *
 * GET  ?id=...                  → render the ticket
 * POST action=reply              → user/staff visible reply
 * POST action=internal_note      → staff-only internal note
 * POST action=set_status         → staff-only lifecycle change
 * POST action=assign             → staff-only assignment change
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/filelib.php'); // for file_get_unused_draft_itemid()
require_once(__DIR__ . '/locallib.php');
require_once(__DIR__ . '/classes/support_manager.php');

use local_istikama_admin\support_manager;

require_login();

$ticketid = required_param('id', PARAM_INT);
// PARAM_ALPHANUMEXT allows underscores — needed for action names like
// "set_status", "internal_note", etc.
$action   = optional_param('action', '', PARAM_ALPHANUMEXT);
// embedded=1: strip the surrounding admin chrome so this page can be loaded
// inside an iframe in the admin support center modal.
$embedded = optional_param('embedded', 0, PARAM_INT) === 1;

global $DB, $USER, $PAGE, $OUTPUT;

// Resolve ticket + viewer permissions up front.
$ticket = $DB->get_record('istikama_support_tickets', ['id' => $ticketid], '*', MUST_EXIST);
if (!support_manager::user_can_view($ticket, (int)$USER->id)) {
    throw new required_capability_exception(context_system::instance(), 'moodle/site:config', 'nopermissions', '');
}
$is_staff      = support_manager::user_is_staff((int)$USER->id);
$can_manage    = support_manager::user_can_manage($ticket, (int)$USER->id);
$can_reply     = support_manager::user_can_reply($ticket, (int)$USER->id);

$baseurl = new moodle_url('/local/istikama_admin/support_ticket.php', ['id' => $ticketid]);

// ── POST actions ──────────────────────────────────────────────────────────
if ($action && confirm_sesskey()) {
    try {
        if ($action === 'reply' && $can_reply) {
            $body        = required_param('body', PARAM_RAW);
            $draftitemid = optional_param('attachments', 0, PARAM_INT);
            support_manager::add_message($ticketid, (int)$USER->id, $body, false, $draftitemid);
            \core\notification::success(get_string('support_reply_sent', 'local_istikama_admin'));
        } else if ($action === 'internal_note' && $can_manage) {
            $body = required_param('body', PARAM_RAW);
            support_manager::add_message($ticketid, (int)$USER->id, $body, true, 0);
            \core\notification::success(get_string('support_save_done', 'local_istikama_admin'));
        } else if ($action === 'set_status' && $can_manage) {
            $newstatus = required_param('status', PARAM_ALPHANUMEXT);
            support_manager::set_status($ticketid, (int)$USER->id, $newstatus);
            \core\notification::success(get_string('support_save_done', 'local_istikama_admin'));
        } else if ($action === 'assign' && $can_manage) {
            $assignee = optional_param('assignee', 0, PARAM_INT);
            support_manager::assign($ticketid, (int)$USER->id, $assignee);
            \core\notification::success(get_string('support_save_done', 'local_istikama_admin'));
        }
    } catch (\Throwable $e) {
        \core\notification::error($e->getMessage());
    }
    redirect($baseurl);
}

// Re-load the ticket and conversation after any POST.
$bundle = support_manager::get_ticket_with_messages($ticketid, (int)$USER->id);
$ticket = $bundle['ticket'];
$messages = $bundle['messages'];

$statuses   = support_manager::get_statuses();
$categories = support_manager::get_categories();
$priorities = support_manager::get_priorities();

$st = $statuses[$ticket->status]   ?? null;
$pr = $priorities[$ticket->priority] ?? null;
$ct = $categories[$ticket->category] ?? null;

// Submitter info.
$submitter = $DB->get_record('user', ['id' => $ticket->userid], '*', IGNORE_MISSING);
$assignee  = $ticket->assigned_to ? $DB->get_record('user', ['id' => $ticket->assigned_to], '*', IGNORE_MISSING) : null;

// All attachments (opening post + per-message).
$opening_attachments = support_manager::get_attachments($ticketid, 0);

// Build message rows for rendering.
$msg_rows = [];
foreach ($messages as $m) {
    $u = $DB->get_record('user', ['id' => $m->userid], 'id,firstname,lastname,picture,imagealt,firstnamephonetic,lastnamephonetic,middlename,alternatename', IGNORE_MISSING);
    $picurl = $u ? $OUTPUT->user_picture($u, ['size' => 56, 'link' => false, 'class' => '']) : '';
    $picsrc = '';
    if (preg_match('/src="([^"]+)"/', $picurl, $pm)) { $picsrc = $pm[1]; }
    $author_is_staff = $u ? support_manager::user_is_staff((int)$u->id) : false;

    $msg_rows[] = [
        'message'    => $m,
        'author'     => $u,
        'picsrc'     => $picsrc,
        'is_staff'   => $author_is_staff,
        'is_system'  => (int)$m->is_system === 1,
        'is_internal'=> (int)$m->is_internal === 1,
        'attachments'=> support_manager::get_attachments($ticketid, (int)$m->id),
    ];
}

// Staff lookup for the "assign" select.
$staff_options = [];
if ($can_manage) {
    $staff_options[] = ['value' => 0, 'label' => '— ' . get_string('support_unassigned', 'local_istikama_admin'), 'selected' => empty($ticket->assigned_to)];
    $admins = get_admins();
    foreach ($admins as $a) {
        $staff_options[] = [
            'value'    => (int)$a->id,
            'label'    => fullname($a),
            'selected' => ((int)$ticket->assigned_to === (int)$a->id),
        ];
    }
}

// File draft area for replies.
$reply_draftitemid = file_get_unused_draft_itemid();

// ── Page setup ────────────────────────────────────────────────────────────
$PAGE->set_url($baseurl);
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('support_ticket_title', 'local_istikama_admin', $ticketid));
$PAGE->activityheader->disable();
$PAGE->set_heading('');
$PAGE->set_secondary_navigation(false);
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

$isti_hide_page_header = true;
$isti_no_card_wrapper  = true;
if ($embedded) {
    // Skip admin_layout entirely — emit minimal head + body so the iframe
    // host (support_admin.php modal) can scroll the inner content cleanly.
    echo '<!doctype html><html><head><meta charset="utf-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>' . s($PAGE->title) . '</title>';
    echo '<link rel="stylesheet" href="' . (new moodle_url('/theme/istikama/style/istikama-theme.css'))->out(false) . '">';
    echo '<link rel="stylesheet" href="/local/istikama_admin/styles/istikama_admin.css?v=16">';
    echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">';
    echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap">';
    echo '<style>body{margin:0;background:#fff;font-family:Montserrat,system-ui,sans-serif}</style>';
    echo '</head><body>';
} else {
    require_once('admin_layout.php');
}

$dir = right_to_left() ? 'rtl' : 'ltr';
$back_url = $is_staff
    ? (new moodle_url('/local/istikama_admin/support_admin.php'))->out(false)
    : (new moodle_url('/local/istikama_admin/support.php'))->out(false);
?>
<div class="container-fluid isti-support-ticket" dir="<?= $dir ?>" style="background:#fff;padding:24px;min-height:600px">

    <!-- Header card -->
    <div class="isti-card" style="padding:20px 24px;margin-bottom:18px;display:flex;align-items:center;gap:14px;flex-wrap:wrap">
        <?php if (!$embedded): ?>
        <a href="<?= s($back_url) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-arrow-left"></i> <?= get_string('support_back_to_list', 'local_istikama_admin') ?>
        </a>
        <?php endif; ?>
        <span style="display:inline-flex;align-items:center;justify-content:center;width:44px;height:44px;border-radius:11px;background:#eff6ff;color:#006bff;font-size:1.15rem;flex-shrink:0">
            <i class="fa fa-life-ring"></i>
        </span>
        <div style="flex:1;min-width:240px">
            <div style="font-size:.78rem;color:#94a3b8;font-weight:500;text-transform:uppercase;letter-spacing:.4px">
                <?= s(get_string('support_ticket_title', 'local_istikama_admin', $ticketid)) ?>
            </div>
            <h5 style="margin:2px 0 0;font-weight:700;color:#0f172a;font-size:1.1rem"><?= s($ticket->subject) ?></h5>
            <div style="margin-top:6px;display:flex;gap:8px;flex-wrap:wrap;align-items:center;font-size:.82rem;color:#64748b">
                <?php if ($submitter): ?>
                <span><i class="fa fa-user" style="color:#94a3b8"></i> <?= s(fullname($submitter)) ?></span>
                <span style="color:#cbd5e1">·</span>
                <?php endif; ?>
                <span><i class="fa fa-clock" style="color:#94a3b8"></i> <?= s(userdate($ticket->timecreated, get_string('strftimedatetimeshort', 'langconfig'))) ?></span>
            </div>
        </div>
        <span style="background:<?= s($st['bg'] ?? '#f1f5f9') ?>;color:<?= s($st['fg'] ?? '#475569') ?>;font-size:.78rem;font-weight:600;padding:5px 12px;border-radius:999px;white-space:nowrap">
            <i class="fa <?= s($st['icon'] ?? 'fa-tag') ?>"></i> <?= s($st['label'] ?? $ticket->status) ?>
        </span>
        <span style="background:<?= s($pr['bg'] ?? '#f1f5f9') ?>;color:<?= s($pr['fg'] ?? '#475569') ?>;font-size:.78rem;font-weight:600;padding:5px 12px;border-radius:999px;white-space:nowrap;display:inline-flex;align-items:center;gap:6px">
            <i class="fa <?= s($pr['icon'] ?? 'fa-flag') ?>"></i> <?= s($pr['label'] ?? $ticket->priority) ?>
        </span>
        <span style="background:#f1f5f9;color:#475569;font-size:.78rem;font-weight:600;padding:5px 12px;border-radius:999px;white-space:nowrap">
            <i class="fa <?= s($ct['icon'] ?? 'fa-tag') ?>"></i> <?= s($ct['label'] ?? $ticket->category) ?>
        </span>
    </div>

    <div style="display:grid;grid-template-columns: 1fr <?= $can_manage ? '320px' : '0' ?>;gap:18px;<?= !$can_manage ? 'grid-template-columns:1fr;' : '' ?>">

        <!-- LEFT: conversation thread -->
        <div>
            <!-- Opening post -->
            <div class="isti-card sup-msg sup-msg-opening" style="padding:0;overflow:hidden;margin-bottom:14px">
                <div style="padding:14px 20px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;gap:10px;background:#f8fafc">
                    <?php if ($submitter): ?>
                        <?php $sub_pic = $OUTPUT->user_picture($submitter, ['size' => 56, 'link' => false, 'class' => '']); ?>
                        <?php if (preg_match('/src="([^"]+)"/', $sub_pic, $sm)): ?>
                            <img src="<?= s($sm[1]) ?>" alt="" style="width:36px;height:36px;border-radius:50%;object-fit:cover">
                        <?php else: ?>
                            <span style="width:36px;height:36px;border-radius:50%;background:#e0e7ff;color:#4f46e5;display:inline-flex;align-items:center;justify-content:center;font-weight:700;font-size:.8rem">
                                <?= s(strtoupper(substr($submitter->firstname, 0, 1) . substr($submitter->lastname, 0, 1))) ?>
                            </span>
                        <?php endif; ?>
                        <div style="flex:1">
                            <strong style="color:#0f172a;font-size:.92rem"><?= s(fullname($submitter)) ?></strong>
                            <div style="font-size:.78rem;color:#94a3b8"><?= s(userdate($ticket->timecreated, get_string('strftimedatetimeshort', 'langconfig'))) ?></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div style="padding:18px 22px;color:#0f172a;font-size:.93rem;line-height:1.7;white-space:pre-wrap">
                    <?= s($ticket->message) ?>
                </div>
                <?php if (!empty($opening_attachments)): ?>
                <div style="padding:12px 22px 18px;border-top:1px solid #f1f5f9;display:flex;flex-wrap:wrap;gap:8px">
                    <?php foreach ($opening_attachments as $f): ?>
                        <a href="<?= s(support_manager::attachment_url($f)->out(false)) ?>"
                           target="_blank" rel="noopener"
                           style="display:inline-flex;align-items:center;gap:8px;padding:7px 12px;background:#eff6ff;color:#1d4ed8;border-radius:8px;font-size:.82rem;text-decoration:none">
                            <i class="fa fa-paperclip"></i> <?= s($f->get_filename()) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>

            <!-- Replies -->
            <?php foreach ($msg_rows as $row):
                $m  = $row['message'];
                $u  = $row['author'];
                $bg = $row['is_system'] ? '#f8fafc'
                    : ($row['is_internal'] ? '#fffbeb'
                    : ($row['is_staff'] ? '#eff6ff' : '#fff'));
                $border = $row['is_internal'] ? '#fcd34d' : '#e2e8f0';
            ?>
            <div class="isti-card" style="background:<?= $bg ?>;border-color:<?= $border ?>;padding:0;overflow:hidden;margin-bottom:12px">
                <div style="padding:12px 18px;border-bottom:1px solid <?= $border ?>;display:flex;align-items:center;gap:10px">
                    <?php if ($row['is_system']): ?>
                        <span style="width:32px;height:32px;border-radius:50%;background:#cbd5e1;color:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:.85rem;flex-shrink:0">
                            <i class="fa fa-circle-info"></i>
                        </span>
                        <strong style="color:#475569;font-size:.85rem"><?= get_string('support_system_message', 'local_istikama_admin') ?></strong>
                    <?php else: ?>
                        <?php if ($row['picsrc']): ?>
                            <img src="<?= s($row['picsrc']) ?>" alt="" style="width:32px;height:32px;border-radius:50%;object-fit:cover">
                        <?php else: ?>
                            <span style="width:32px;height:32px;border-radius:50%;background:#e0e7ff;color:#4f46e5;display:inline-flex;align-items:center;justify-content:center;font-size:.78rem;font-weight:700">
                                <?= $u ? s(strtoupper(substr($u->firstname, 0, 1) . substr($u->lastname, 0, 1))) : '?' ?>
                            </span>
                        <?php endif; ?>
                        <div style="flex:1">
                            <strong style="color:#0f172a;font-size:.88rem"><?= $u ? s(fullname($u)) : '—' ?></strong>
                            <?php if ($row['is_staff']): ?>
                                <span style="background:#dbeafe;color:#1d4ed8;font-size:.66rem;font-weight:700;padding:2px 7px;border-radius:6px;margin-left:6px;text-transform:uppercase;letter-spacing:.4px">Staff</span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <span style="font-size:.78rem;color:#94a3b8;margin-left:auto">
                        <?= s(userdate($m->timecreated, get_string('strftimedatetimeshort', 'langconfig'))) ?>
                    </span>
                    <?php if ($row['is_internal']): ?>
                        <span style="background:#fef3c7;color:#a16207;font-size:.66rem;font-weight:700;padding:3px 8px;border-radius:6px;text-transform:uppercase;letter-spacing:.4px">
                            <i class="fa fa-lock"></i> <?= get_string('support_internal_only', 'local_istikama_admin') ?>
                        </span>
                    <?php endif; ?>
                </div>
                <div style="padding:14px 20px;color:#1e293b;font-size:.9rem;line-height:1.65;white-space:pre-wrap">
                    <?= s($m->message) ?>
                </div>
                <?php if (!empty($row['attachments'])): ?>
                <div style="padding:10px 20px 14px;border-top:1px solid <?= $border ?>;display:flex;flex-wrap:wrap;gap:8px">
                    <?php foreach ($row['attachments'] as $f): ?>
                        <a href="<?= s(support_manager::attachment_url($f)->out(false)) ?>"
                           target="_blank" rel="noopener"
                           style="display:inline-flex;align-items:center;gap:6px;padding:6px 10px;background:#fff;color:#1d4ed8;border:1px solid #bfdbfe;border-radius:8px;font-size:.8rem;text-decoration:none">
                            <i class="fa fa-paperclip"></i> <?= s($f->get_filename()) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>

            <!-- Reply form -->
            <?php if ($can_reply): ?>
            <div class="isti-card" style="padding:20px 22px;margin-bottom:12px">
                <h6 style="font-weight:700;color:#0f172a;margin-bottom:10px;font-size:.95rem">
                    <i class="fa fa-reply" style="color:#006bff"></i> <?= get_string('support_reply_label', 'local_istikama_admin') ?>
                </h6>
                <form method="post" action="<?= $baseurl->out(false) ?>" enctype="multipart/form-data">
                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                    <input type="hidden" name="action" value="reply">
                    <input type="hidden" name="attachments" value="<?= (int)$reply_draftitemid ?>">
                    <textarea name="body" rows="4" required
                              placeholder="<?= s(get_string('support_reply_ph', 'local_istikama_admin')) ?>"
                              style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.92rem;resize:vertical;font-family:inherit;line-height:1.6;margin-bottom:10px"></textarea>
                    <button type="submit" class="isti-btn isti-btn-primary" style="padding:9px 18px">
                        <i class="fa fa-paper-plane"></i> <?= get_string('support_reply_btn', 'local_istikama_admin') ?>
                    </button>
                </form>
            </div>
            <?php else: ?>
            <div style="background:#f1f5f9;border:1.5px dashed #cbd5e1;border-radius:10px;padding:14px 18px;color:#64748b;font-size:.88rem;text-align:center">
                <i class="fa fa-lock"></i> <?= get_string('support_ticket_closed_notice', 'local_istikama_admin') ?>
            </div>
            <?php endif; ?>

            <!-- Internal note (staff only) -->
            <?php if ($can_manage): ?>
            <div class="isti-card" style="padding:18px 20px;background:#fffbeb;border-color:#fcd34d;margin-top:14px">
                <h6 style="font-weight:700;color:#a16207;margin-bottom:8px;font-size:.92rem">
                    <i class="fa fa-lock"></i> <?= get_string('support_internal_note_label', 'local_istikama_admin') ?>
                </h6>
                <form method="post" action="<?= $baseurl->out(false) ?>">
                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                    <input type="hidden" name="action" value="internal_note">
                    <textarea name="body" rows="3" required
                              placeholder="<?= s(get_string('support_internal_note_ph', 'local_istikama_admin')) ?>"
                              style="width:100%;padding:10px 13px;border:1.5px solid #fcd34d;border-radius:9px;font-size:.9rem;resize:vertical;font-family:inherit;line-height:1.55;background:#fff;margin-bottom:10px"></textarea>
                    <button type="submit" class="isti-btn isti-btn-outline" style="padding:8px 16px;border-color:#a16207;color:#a16207">
                        <i class="fa fa-floppy-disk"></i> <?= get_string('support_internal_note_btn', 'local_istikama_admin') ?>
                    </button>
                </form>
            </div>
            <?php endif; ?>
        </div>

        <!-- RIGHT: staff sidebar -->
        <?php if ($can_manage): ?>
        <div>
            <!-- Status -->
            <div class="isti-card" style="padding:18px 20px;margin-bottom:14px">
                <h6 style="font-weight:700;color:#0f172a;font-size:.88rem;margin-bottom:10px">
                    <i class="fa fa-flag" style="color:#006bff"></i> <?= get_string('support_change_status', 'local_istikama_admin') ?>
                </h6>
                <form method="post" action="<?= $baseurl->out(false) ?>" id="supStatusForm">
                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                    <input type="hidden" name="action" value="set_status">
                    <select name="status" onchange="document.getElementById('supStatusForm').submit()"
                            style="width:100%;padding:10px 13px;border:1.5px solid #cbd5e1;border-radius:9px;font-size:.9rem">
                        <?php foreach ($statuses as $key => $meta): ?>
                            <option value="<?= s($key) ?>"<?= $ticket->status === $key ? ' selected' : '' ?>><?= s($meta['label']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>

            <!-- Assignment -->
            <div class="isti-card" style="padding:18px 20px;margin-bottom:14px">
                <h6 style="font-weight:700;color:#0f172a;font-size:.88rem;margin-bottom:10px">
                    <i class="fa fa-user-tag" style="color:#006bff"></i> <?= get_string('support_assign_to', 'local_istikama_admin') ?>
                </h6>
                <form method="post" action="<?= $baseurl->out(false) ?>" id="supAssignForm">
                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                    <input type="hidden" name="action" value="assign">
                    <select name="assignee" onchange="document.getElementById('supAssignForm').submit()"
                            style="width:100%;padding:10px 13px;border:1.5px solid #cbd5e1;border-radius:9px;font-size:.9rem">
                        <?php foreach ($staff_options as $o): ?>
                            <option value="<?= (int)$o['value'] ?>"<?= $o['selected'] ? ' selected' : '' ?>><?= s($o['label']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>

            <!-- Submitter info -->
            <?php if ($submitter): ?>
            <div class="isti-card" style="padding:18px 20px">
                <h6 style="font-weight:700;color:#0f172a;font-size:.88rem;margin-bottom:10px">
                    <i class="fa fa-id-card" style="color:#006bff"></i> <?= get_string('support_opened_by', 'local_istikama_admin') ?>
                </h6>
                <div style="display:flex;align-items:center;gap:10px">
                    <?php $sp = $OUTPUT->user_picture($submitter, ['size' => 64, 'link' => false, 'class' => '']); ?>
                    <?php if (preg_match('/src="([^"]+)"/', $sp, $sm2)): ?>
                        <img src="<?= s($sm2[1]) ?>" alt="" style="width:40px;height:40px;border-radius:50%;object-fit:cover">
                    <?php endif; ?>
                    <div>
                        <strong style="color:#0f172a;font-size:.9rem;display:block"><?= s(fullname($submitter)) ?></strong>
                        <span style="color:#64748b;font-size:.78rem"><?= s($submitter->email) ?></span>
                        <?php if (!empty($ticket->role)): ?>
                            <div style="margin-top:4px"><span style="background:#f1f5f9;color:#475569;font-size:.7rem;font-weight:600;padding:2px 8px;border-radius:6px;text-transform:uppercase;letter-spacing:.4px"><?= s(str_replace('_', ' ', $ticket->role)) ?></span></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div>
</div>

<?php
echo '</div>';   // close .container-fluid
if ($embedded) {
    echo '</body></html>';
} else {
    echo '</div>';   // close .istikama-dashboard-container from admin_layout.php
    echo $OUTPUT->footer();
}
