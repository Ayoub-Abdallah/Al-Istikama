<?php
/**
 * School Notifications — composing, scheduling, and broadcasting announcements
 * to a school's users (teachers, students, parents) from a school manager
 * account.
 *
 * Routes:
 *   GET  /school_notifications.php              → list + compose modal
 *   GET  ?view=ID                                → detail view modal (auto-opens)
 *   POST action=create_notification              → save / send / schedule
 *   POST action=send                             → fire a draft/scheduled now
 *   POST action=delete                           → drop a draft/scheduled row
 *
 * Replaces the previous mixed-language summary page with a real notification
 * management system. Uses notification_manager service for all writes.
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once(__DIR__ . '/locallib.php');
require_once(__DIR__ . '/classes/notification_manager.php');

use local_istikama_admin\notification_manager;

require_login();
local_istikama_admin_require_school_manager();

$schoolid = local_istikama_admin_get_manager_school();
if (!$schoolid) {
    throw new \moodle_exception('sm_no_school_assigned', 'local_istikama_admin');
}

try {
    $schoolcat = core_course_category::get($schoolid);
    $schoolname = format_string($schoolcat->name);
} catch (\Exception $e) {
    throw new \moodle_exception('sm_no_school_assigned', 'local_istikama_admin');
}

$baseurl = new moodle_url('/local/istikama_admin/school_notifications.php');
$action  = optional_param('action', '', PARAM_ALPHANUMEXT);

global $DB, $USER, $PAGE, $OUTPUT;

// ── POST handlers ──────────────────────────────────────────────────────────
if ($action === 'create_notification' && confirm_sesskey()) {
    $title       = required_param('title', PARAM_TEXT);
    $body        = required_param('body', PARAM_RAW);
    $audrole     = optional_param('audience_role', '', PARAM_ALPHA);
    $audclassid  = optional_param('audience_classid', 0, PARAM_INT);
    $audlevelid  = optional_param('audience_levelid', 0, PARAM_INT);
    $scheduledfor= optional_param('scheduledfor', 0, PARAM_INT);
    $submit      = optional_param('submit_mode', 'draft', PARAM_ALPHA);

    try {
        $nid = notification_manager::create(
            $schoolid, (int)$USER->id, $title, $body,
            $audrole ?: null, $audclassid ?: null, $audlevelid ?: null,
            $scheduledfor ?: null
        );
        if ($submit === 'send') {
            $count = notification_manager::send($nid, (int)$USER->id);
            \core\notification::success(get_string('sn_sent_to_n', 'local_istikama_admin', $count));
        } else if ($submit === 'schedule' && $scheduledfor) {
            \core\notification::success(get_string('sn_scheduled_for', 'local_istikama_admin',
                userdate($scheduledfor, get_string('strftimedatetimeshort', 'langconfig'))));
        } else {
            \core\notification::success(get_string('sn_saved_draft', 'local_istikama_admin'));
        }
    } catch (\Throwable $e) {
        \core\notification::error($e->getMessage());
    }
    redirect($baseurl);
}

if ($action === 'send' && confirm_sesskey()) {
    $nid = required_param('id', PARAM_INT);
    try {
        $n = $DB->get_record('istikama_school_notification', ['id' => $nid, 'schoolid' => $schoolid], '*', MUST_EXIST);
        $count = notification_manager::send($nid, (int)$USER->id);
        \core\notification::success(get_string('sn_sent_to_n', 'local_istikama_admin', $count));
    } catch (\Throwable $e) {
        \core\notification::error($e->getMessage());
    }
    redirect($baseurl);
}

if ($action === 'delete' && confirm_sesskey()) {
    $nid = required_param('id', PARAM_INT);
    try {
        $n = $DB->get_record('istikama_school_notification', ['id' => $nid, 'schoolid' => $schoolid], '*', MUST_EXIST);
        notification_manager::delete($nid);
        \core\notification::success(get_string('sn_deleted', 'local_istikama_admin'));
    } catch (\Throwable $e) {
        \core\notification::error($e->getMessage());
    }
    redirect($baseurl);
}

// ── Read data ─────────────────────────────────────────────────────────────
$filters = [
    'status' => optional_param('status', '', PARAM_ALPHA),
    'q'      => optional_param('q', '', PARAM_TEXT),
];
$rows_raw = notification_manager::list_for_school($schoolid, $filters);
$analytics = notification_manager::get_analytics($schoolid);
$statuses  = notification_manager::get_statuses();
$audroles  = notification_manager::get_audience_roles();

// Build audience option lists (levels + classes under this school).
$levels  = [];
$classes = [];
try {
    foreach ($schoolcat->get_children() as $lc) {
        $levels[(int)$lc->id] = format_string($lc->name);
        foreach ($lc->get_children() as $cc) {
            $classes[(int)$cc->id] = [
                'levelid' => (int)$lc->id,
                'name'    => format_string($cc->name) . ' (' . format_string($lc->name) . ')',
            ];
        }
    }
} catch (\Throwable $e) {}

// Shape rows for the table.
$rows = [];
foreach ($rows_raw as $r) {
    $st = $statuses[$r->status] ?? null;

    // Build audience label.
    $aud_parts = [];
    if (!empty($r->audience_role) && $r->audience_role !== 'all') {
        $aud_parts[] = $audroles[$r->audience_role]['label'] ?? $r->audience_role;
    } else if (empty($r->audience_classid) && empty($r->audience_levelid)) {
        $aud_parts[] = get_string('sn_audience_all', 'local_istikama_admin');
    }
    if (!empty($r->audience_classid) && isset($classes[(int)$r->audience_classid])) {
        $aud_parts[] = $classes[(int)$r->audience_classid]['name'];
    }
    if (!empty($r->audience_levelid) && isset($levels[(int)$r->audience_levelid])) {
        $aud_parts[] = $levels[(int)$r->audience_levelid];
    }

    $rows[] = [
        'id'           => (int)$r->id,
        'title'        => format_string($r->title),
        'body_excerpt' => format_string(mb_substr($r->body, 0, 120)) . (mb_strlen($r->body) > 120 ? '…' : ''),
        'audience'     => implode(' · ', $aud_parts),
        'status'       => $r->status,
        'status_label' => $st['label'] ?? $r->status,
        'status_bg'    => $st['bg']    ?? '#f1f5f9',
        'status_fg'    => $st['fg']    ?? '#475569',
        'status_icon'  => $st['icon']  ?? 'fa-tag',
        'recipients'   => (int)$r->recipients_count,
        'sent_at'      => $r->sentat ? userdate($r->sentat, get_string('strftimedatetimeshort', 'langconfig')) : '',
        'scheduled_at' => $r->scheduledfor ? userdate($r->scheduledfor, get_string('strftimedatetimeshort', 'langconfig')) : '',
        'created_at'   => userdate($r->timecreated, get_string('strftimedatetimeshort', 'langconfig')),
        'is_draft'     => $r->status === notification_manager::STATUS_DRAFT,
        'is_scheduled' => $r->status === notification_manager::STATUS_SCHEDULED,
        'is_sent'      => $r->status === notification_manager::STATUS_SENT,
    ];
}

// Detail-view auto-open?
$viewid = optional_param('view', 0, PARAM_INT);
$viewdata = null;
if ($viewid > 0) {
    $vrow = $DB->get_record('istikama_school_notification', ['id' => $viewid, 'schoolid' => $schoolid], '*', IGNORE_MISSING);
    if ($vrow) {
        $vst = $statuses[$vrow->status] ?? null;
        $viewdata = [
            'id'           => (int)$vrow->id,
            'title'        => format_string($vrow->title),
            'body'         => $vrow->body,
            'status_label' => $vst['label'] ?? $vrow->status,
            'status_bg'    => $vst['bg']    ?? '#f1f5f9',
            'status_fg'    => $vst['fg']    ?? '#475569',
            'status_icon'  => $vst['icon']  ?? 'fa-tag',
            'recipients'   => (int)$vrow->recipients_count,
            'sent_at'      => $vrow->sentat ? userdate($vrow->sentat, get_string('strftimedatetimeshort', 'langconfig')) : null,
            'scheduled_at' => $vrow->scheduledfor ? userdate($vrow->scheduledfor, get_string('strftimedatetimeshort', 'langconfig')) : null,
            'created_at'   => userdate($vrow->timecreated, get_string('strftimedatetimeshort', 'langconfig')),
        ];
    }
}

// Status filter options.
$status_options = [['value' => '', 'label' => get_string('sn_filter_all', 'local_istikama_admin'), 'selected' => $filters['status'] === '']];
foreach ($statuses as $key => $meta) {
    $status_options[] = ['value' => $key, 'label' => $meta['label'], 'selected' => $filters['status'] === $key];
}

// ── Page setup ────────────────────────────────────────────────────────────
$PAGE->set_url($baseurl);
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('sn_page_title', 'local_istikama_admin'));
$PAGE->activityheader->disable();
$PAGE->set_heading('');
$PAGE->set_secondary_navigation(false);
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

$isti_hide_page_header = true;
$isti_no_card_wrapper  = true;
require_once('admin_layout.php');

$dir = right_to_left() ? 'rtl' : 'ltr';
?>
<div class="container-fluid isti-school-notifications" dir="<?= $dir ?>" style="background:#fff;padding:24px;min-height:600px">

    <!-- Header -->
    <div class="isti-card" style="padding:20px 24px;margin-bottom:18px;display:flex;align-items:center;gap:14px;flex-wrap:wrap">
        <span style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.3rem;flex-shrink:0">
            <i class="fa fa-bullhorn"></i>
        </span>
        <div style="flex:1;min-width:240px">
            <h5 style="margin:0;font-weight:700;color:#0f172a;font-size:1.15rem"><?= get_string('sn_page_title', 'local_istikama_admin') ?></h5>
            <div style="margin-top:4px;color:#64748b;font-size:.85rem">
                <i class="fa fa-school" style="color:#94a3b8"></i> <?= s($schoolname) ?> · <?= get_string('sn_page_subtitle', 'local_istikama_admin') ?>
            </div>
        </div>
        <button type="button" class="isti-btn isti-btn-primary" id="snOpenComposeBtn">
            <i class="fa fa-plus"></i> <?= get_string('sn_compose', 'local_istikama_admin') ?>
        </button>
    </div>

    <!-- KPI tiles -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:14px;margin-bottom:18px">
        <?php
        $kpis = [
            ['icon' => 'fa-paper-plane',  'label' => get_string('sn_kpi_sent',              'local_istikama_admin'), 'value' => $analytics['sent']],
            ['icon' => 'fa-clock',         'label' => get_string('sn_kpi_scheduled',         'local_istikama_admin'), 'value' => $analytics['scheduled']],
            ['icon' => 'fa-pen-to-square', 'label' => get_string('sn_kpi_drafts',            'local_istikama_admin'), 'value' => $analytics['drafts']],
            ['icon' => 'fa-users',         'label' => get_string('sn_kpi_total_recipients',  'local_istikama_admin'), 'value' => $analytics['total_recipients']],
            ['icon' => 'fa-bolt',          'label' => get_string('sn_kpi_recent_7d',         'local_istikama_admin'), 'value' => $analytics['recent_7d']],
        ];
        foreach ($kpis as $k): ?>
        <div class="isti-card" style="padding:16px 18px;display:flex;align-items:center;gap:14px">
            <div style="width:44px;height:44px;border-radius:11px;background:#eff6ff;color:#006bff;display:inline-flex;align-items:center;justify-content:center;font-size:1.05rem;flex-shrink:0">
                <i class="fa <?= s($k['icon']) ?>"></i>
            </div>
            <div style="flex:1;min-width:0">
                <div style="font-size:.74rem;text-transform:uppercase;letter-spacing:.45px;color:#64748b;font-weight:600"><?= s($k['label']) ?></div>
                <div style="font-size:1.5rem;font-weight:700;color:#0f172a;margin-top:2px;line-height:1.1"><?= s((string)$k['value']) ?></div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Filters -->
    <div class="isti-card" style="padding:14px 18px;margin-bottom:14px">
        <form method="get" action="<?= $baseurl->out(false) ?>" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap">
            <input type="text" name="q" value="<?= s($filters['q']) ?>" placeholder="<?= s(get_string('sn_filter_search_ph', 'local_istikama_admin')) ?>"
                   style="flex:1;min-width:200px;padding:9px 13px;border:1px solid #cbd5e1;border-radius:8px">
            <select name="status" style="padding:9px 13px;border:1px solid #cbd5e1;border-radius:8px">
                <?php foreach ($status_options as $o): ?>
                    <option value="<?= s($o['value']) ?>"<?= $o['selected'] ? ' selected' : '' ?>><?= s($o['label']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="isti-btn isti-btn-primary" style="padding:9px 18px"><?= get_string('sn_filter_apply', 'local_istikama_admin') ?></button>
            <a href="<?= $baseurl->out(false) ?>" class="isti-btn isti-btn-outline" style="padding:9px 18px"><?= get_string('sn_filter_reset', 'local_istikama_admin') ?></a>
        </form>
    </div>

    <!-- List — unified blue-header data table -->
    <div class="isti-data-table">
        <?php if (empty($rows)): ?>
            <div class="isti-data-empty">
                <i class="fa fa-bullhorn isti-data-empty-icon"></i>
                <div class="isti-data-empty-title"><?= get_string('sn_no_notifications', 'local_istikama_admin') ?></div>
                <div class="isti-data-empty-msg"><?= get_string('sn_no_notifications_msg', 'local_istikama_admin') ?></div>
            </div>
        <?php else: ?>
            <div class="isti-data-table-scroll">
                <table>
                    <thead><tr>
                        <th><?= get_string('sn_table_title',      'local_istikama_admin') ?></th>
                        <th><?= get_string('sn_table_audience',   'local_istikama_admin') ?></th>
                        <th><?= get_string('sn_table_status',     'local_istikama_admin') ?></th>
                        <th><?= get_string('sn_table_recipients', 'local_istikama_admin') ?></th>
                        <th><?= get_string('sn_table_date',       'local_istikama_admin') ?></th>
                        <th class="isti-th-right"><?= get_string('sn_table_actions',   'local_istikama_admin') ?></th>
                    </tr></thead>
                    <tbody>
                    <?php foreach ($rows as $r): ?>
                        <tr class="snRow isti-row-clickable" data-id="<?= (int)$r['id'] ?>">
                            <td>
                                <span class="isti-cell-title"><?= s($r['title']) ?></span>
                                <span class="isti-cell-meta"><?= s($r['body_excerpt']) ?></span>
                            </td>
                            <td><?= s($r['audience']) ?></td>
                            <td>
                                <span class="isti-pill" style="background:<?= s($r['status_bg']) ?>;color:<?= s($r['status_fg']) ?>">
                                    <i class="fa <?= s($r['status_icon']) ?>"></i> <?= s($r['status_label']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($r['is_sent']): ?>
                                    <strong><?= (int)$r['recipients'] ?></strong>
                                <?php else: ?>
                                    <span style="color:#cbd5e1">—</span>
                                <?php endif; ?>
                            </td>
                            <td style="color:#64748b;font-size:.84rem">
                                <?php if ($r['is_sent']): ?>
                                    <i class="fa fa-paper-plane" style="color:#15803d"></i> <?= s($r['sent_at']) ?>
                                <?php elseif ($r['is_scheduled']): ?>
                                    <i class="fa fa-clock" style="color:#a16207"></i> <?= s($r['scheduled_at']) ?>
                                <?php else: ?>
                                    <i class="fa fa-pen" style="color:#94a3b8"></i> <?= s($r['created_at']) ?>
                                <?php endif; ?>
                            </td>
                            <td class="isti-td-actions">
                                <a href="<?= (new moodle_url('/local/istikama_admin/notification_view.php', ['id' => (int)$r['id']]))->out(false) ?>"
                                   class="isti-tbl-action" title="<?= s(get_string('sn_action_view', 'local_istikama_admin')) ?>">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <?php if (!$r['is_sent']): ?>
                                    <form method="post" action="<?= $baseurl->out(false) ?>" class="isti-tbl-action-form">
                                        <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                                        <input type="hidden" name="action" value="send">
                                        <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                                        <button type="submit" class="isti-tbl-action isti-tbl-action-primary" title="<?= s(get_string('sn_action_send', 'local_istikama_admin')) ?>">
                                            <i class="fa fa-paper-plane"></i>
                                        </button>
                                    </form>
                                    <form method="post" action="<?= $baseurl->out(false) ?>" class="isti-tbl-action-form" onsubmit="return confirm('Delete this notification?')">
                                        <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                                        <button type="submit" class="isti-tbl-action isti-tbl-action-danger" title="<?= s(get_string('sn_action_delete', 'local_istikama_admin')) ?>">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- ── Compose modal ──────────────────────────────────────────── -->
    <div class="isti-modal-overlay" id="snComposeModal" role="dialog" aria-modal="true" style="display:none">
        <div class="isti-modal" style="max-width:720px;width:100%">
            <div class="isti-modal-header">
                <h5 style="margin:0;font-weight:700;color:#0f172a;font-size:1.05rem;display:flex;align-items:center;gap:10px">
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;background:#eff6ff;color:#006bff;font-size:1rem">
                        <i class="fa fa-bullhorn"></i>
                    </span>
                    <?= get_string('sn_create_title', 'local_istikama_admin') ?>
                </h5>
                <button type="button" id="snComposeClose" aria-label="Close" style="background:transparent;border:0;color:#64748b;font-size:1.2rem;cursor:pointer;padding:6px 10px">
                    <i class="fa fa-xmark"></i>
                </button>
            </div>
            <form method="post" action="<?= $baseurl->out(false) ?>">
                <div class="isti-modal-body">
                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                    <input type="hidden" name="action" value="create_notification">
                    <input type="hidden" name="submit_mode" id="snSubmitMode" value="draft">
                    <input type="hidden" name="scheduledfor" id="snScheduledForUnix" value="0">

                    <div style="margin-bottom:16px">
                        <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                            <?= get_string('sn_field_title', 'local_istikama_admin') ?> *
                        </label>
                        <input type="text" name="title" required maxlength="255"
                               placeholder="<?= s(get_string('sn_field_title_ph', 'local_istikama_admin')) ?>"
                               style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.95rem">
                    </div>

                    <div style="margin-bottom:16px">
                        <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                            <?= get_string('sn_field_body', 'local_istikama_admin') ?> *
                        </label>
                        <textarea name="body" rows="6" required
                                  placeholder="<?= s(get_string('sn_field_body_ph', 'local_istikama_admin')) ?>"
                                  style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.93rem;resize:vertical;font-family:inherit;line-height:1.6"></textarea>
                    </div>

                    <div style="margin-bottom:16px">
                        <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                            <?= get_string('sn_field_audience', 'local_istikama_admin') ?>
                        </label>
                        <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:8px">
                            <?php $first = true; foreach ($audroles as $key => $meta): ?>
                            <label style="cursor:pointer">
                                <input type="radio" name="audience_role" value="<?= s($key) ?>"<?= $first ? ' checked' : '' ?> style="display:none" class="snAudRadio">
                                <span class="snAudChip"
                                      style="display:flex;align-items:center;justify-content:center;gap:6px;padding:10px 8px;border:1.5px solid #e2e8f0;border-radius:10px;background:#f8fafc;color:#475569;font-weight:600;font-size:.82rem;transition:border-color .15s ease,box-shadow .15s ease,background .15s ease">
                                    <i class="fa <?= s($meta['icon']) ?>"></i> <?= s($meta['label']) ?>
                                </span>
                            </label>
                            <?php $first = false; endforeach; ?>
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                        <div>
                            <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                                <?= get_string('sn_field_level', 'local_istikama_admin') ?>
                            </label>
                            <select name="audience_levelid" style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.95rem">
                                <option value="0">— <?= get_string('sn_filter_all', 'local_istikama_admin') ?></option>
                                <?php foreach ($levels as $lid => $lname): ?>
                                    <option value="<?= (int)$lid ?>"><?= s($lname) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                                <?= get_string('sn_field_class', 'local_istikama_admin') ?>
                            </label>
                            <select name="audience_classid" style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.95rem">
                                <option value="0">— <?= get_string('sn_filter_all', 'local_istikama_admin') ?></option>
                                <?php foreach ($classes as $cid => $c): ?>
                                    <option value="<?= (int)$cid ?>"><?= s($c['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label style="display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px">
                            <i class="fa fa-calendar" style="color:#f59e0b"></i> <?= get_string('sn_field_schedule', 'local_istikama_admin') ?>
                        </label>
                        <input type="datetime-local" id="snScheduledForRaw"
                               style="width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.95rem">
                        <small style="color:#94a3b8;display:block;margin-top:6px"><?= get_string('sn_field_schedule_help', 'local_istikama_admin') ?></small>
                    </div>
                </div>
                <div class="isti-modal-footer">
                    <button type="button" id="snComposeCancel" class="isti-btn isti-btn-outline"><?= get_string('sn_cancel', 'local_istikama_admin') ?></button>
                    <button type="submit" name="submit_btn" value="draft" class="isti-btn isti-btn-outline" onclick="document.getElementById('snSubmitMode').value='draft'">
                        <i class="fa fa-floppy-disk"></i> <?= get_string('sn_save_draft', 'local_istikama_admin') ?>
                    </button>
                    <button type="submit" name="submit_btn" value="schedule" class="isti-btn isti-btn-outline" id="snScheduleBtn" style="display:none" onclick="document.getElementById('snSubmitMode').value='schedule'">
                        <i class="fa fa-clock"></i> <?= get_string('sn_schedule_btn', 'local_istikama_admin') ?>
                    </button>
                    <button type="submit" name="submit_btn" value="send" class="isti-btn isti-btn-primary" onclick="document.getElementById('snSubmitMode').value='send'">
                        <i class="fa fa-paper-plane"></i> <?= get_string('sn_send_now', 'local_istikama_admin') ?>
                    </button>
                </div>
            </form>
        </div>
    </div>


</div>

<script>
(function() {
    // ── Modal helper ────────────────────────────────────────────────
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

    var composeModal = bindModal('snComposeModal', ['snComposeClose', 'snComposeCancel']);

    // Open compose modal.
    var openBtn = document.getElementById('snOpenComposeBtn');
    if (openBtn) openBtn.addEventListener('click', function(e) { e.preventDefault(); composeModal.show(); });

    // ── Audience chip picker ───────────────────────────────────────
    function paintChips() {
        document.querySelectorAll('.snAudRadio').forEach(function(r) {
            var chip = r.parentElement.querySelector('.snAudChip');
            if (!chip) return;
            if (r.checked) {
                chip.style.borderColor = '#006bff';
                chip.style.background  = '#eff6ff';
                chip.style.color       = '#006bff';
                chip.style.boxShadow   = '0 0 0 3px rgba(0,107,255,0.10)';
            } else {
                chip.style.borderColor = '#e2e8f0';
                chip.style.background  = '#f8fafc';
                chip.style.color       = '#475569';
                chip.style.boxShadow   = 'none';
            }
        });
    }
    document.querySelectorAll('.snAudRadio').forEach(function(r) {
        r.addEventListener('change', paintChips);
    });
    paintChips();

    // ── Schedule input — convert to unix + show "Schedule" button ──
    var rawSched = document.getElementById('snScheduledForRaw');
    var unixSched = document.getElementById('snScheduledForUnix');
    var schedBtn  = document.getElementById('snScheduleBtn');
    if (rawSched && unixSched) {
        rawSched.addEventListener('change', function() {
            if (rawSched.value) {
                unixSched.value = Math.floor(new Date(rawSched.value).getTime() / 1000);
                if (schedBtn) schedBtn.style.display = '';
            } else {
                unixSched.value = 0;
                if (schedBtn) schedBtn.style.display = 'none';
            }
        });
    }

    // ── Row click opens the full notification viewer ─────────────────
    // (We used to render the detail in an inline modal, but the modal couldn't
    // show the full body and we already have a dedicated /notification_view.php
    // route that works for both staff and recipients with proper permissions.)
    var VIEW_BASE = <?= json_encode((new moodle_url('/local/istikama_admin/notification_view.php'))->out(false)) ?>;
    document.querySelectorAll('.snRow').forEach(function(tr) {
        tr.addEventListener('click', function(e) {
            // Don't intercept clicks on inline forms or action buttons/links.
            if (e.target.closest('form, button, a')) { return; }
            var id = tr.getAttribute('data-id');
            if (!id) return;
            window.location.href = VIEW_BASE + '?id=' + encodeURIComponent(id);
        });
    });

    <?php if ($viewdata): ?>
    // Legacy ?view=N param → redirect to the recipient-friendly URL.
    setTimeout(function() {
        window.location.href = VIEW_BASE + '?id=<?= (int)$viewid ?>';
    }, 0);
    <?php endif; ?>
})();
</script>

<?php
echo '</div>';   // close .container-fluid
echo '</div>';   // close .istikama-dashboard-container from admin_layout.php
echo $OUTPUT->footer();
