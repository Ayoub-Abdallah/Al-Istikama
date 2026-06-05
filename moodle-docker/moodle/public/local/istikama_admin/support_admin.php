<?php
/**
 * Technical Support — staff dashboard.
 *
 * Combines:
 *   - 6 KPI tiles at the top (total, open, urgent, resolved, avg resolve hrs, recent 7d)
 *   - 3 breakdown charts (by status, by category, by role)
 *   - filterable ticket list with quick triage links
 *
 * Visible to: full_admin, school_manager (scoped to their school), technical_professor.
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/filelib.php'); // ensure file APIs (consistent with sibling pages)
require_once(__DIR__ . '/locallib.php');
require_once(__DIR__ . '/classes/support_manager.php');

use local_istikama_admin\support_manager;

require_login();
if (!support_manager::user_is_staff((int)$USER->id)) {
    throw new required_capability_exception(context_system::instance(), 'moodle/site:config', 'nopermissions', '');
}

$baseurl = new moodle_url('/local/istikama_admin/support_admin.php');

global $DB, $USER, $PAGE, $OUTPUT;

// ── Filters ────────────────────────────────────────────────────────────────
$filters = [
    'status'        => optional_param('status', '', PARAM_ALPHANUMEXT),
    'category'      => optional_param('category', '', PARAM_ALPHANUMEXT),
    'priority'      => optional_param('priority', '', PARAM_ALPHA),
    'q'             => optional_param('q', '', PARAM_TEXT),
    'mine_assigned' => optional_param('mine_assigned', 0, PARAM_INT),
    'sort'          => optional_param('sort', '', PARAM_ALPHA),
];

$tickets = support_manager::list_tickets((int)$USER->id, $filters);
$analytics = support_manager::get_analytics();
$statuses   = support_manager::get_statuses();
$categories = support_manager::get_categories();
$priorities = support_manager::get_priorities();

// ── Shape rows for table ──
$rows = [];
foreach ($tickets as $t) {
    $st = $statuses[$t->status] ?? null;
    $pr = $priorities[$t->priority] ?? null;
    $ct = $categories[$t->category] ?? null;
    $authorname = trim(($t->firstname ?? '') . ' ' . ($t->lastname ?? ''));
    $assignedname = trim(($t->assigned_firstname ?? '') . ' ' . ($t->assigned_lastname ?? ''));
    $rows[] = [
        'id'             => (int)$t->id,
        'subject'        => format_string($t->subject),
        'url'            => (new moodle_url('/local/istikama_admin/support_ticket.php', ['id' => $t->id]))->out(false),
        'status_label'   => $st['label'] ?? $t->status,
        'status_bg'      => $st['bg']    ?? '#f1f5f9',
        'status_fg'      => $st['fg']    ?? '#475569',
        'status_icon'    => $st['icon']  ?? 'fa-tag',
        'priority_label' => $pr['label'] ?? $t->priority,
        'priority_bg'    => $pr['bg']    ?? '#f1f5f9',
        'priority_fg'    => $pr['fg']    ?? '#475569',
        'priority_icon'  => $pr['icon']  ?? 'fa-flag',
        'category_label' => $ct['label'] ?? $t->category,
        'category_icon'  => $ct['icon']  ?? 'fa-tag',
        'author'         => $authorname,
        'email'          => $t->email,
        'role'           => $t->role ? str_replace('_', ' ', $t->role) : '',
        'assigned'       => $assignedname,
        'updated'        => userdate($t->lastreplytime ?: $t->timecreated, get_string('strftimedatetimeshort', 'langconfig')),
        'message_count'  => (int)$t->message_count,
    ];
}

// Build label-friendly breakdowns for Chart.js.
$status_chart = ['labels' => [], 'values' => []];
foreach ($analytics['by_status'] as $k => $v) {
    $status_chart['labels'][] = $statuses[$k]['label'] ?? $k;
    $status_chart['values'][] = $v;
}
$cat_chart = ['labels' => [], 'values' => []];
foreach ($analytics['by_category'] as $k => $v) {
    $cat_chart['labels'][] = $categories[$k]['label'] ?? $k;
    $cat_chart['values'][] = $v;
}
$role_chart = ['labels' => [], 'values' => []];
foreach ($analytics['by_role'] as $k => $v) {
    $role_chart['labels'][] = $k === 'unknown' ? '—' : str_replace('_', ' ', $k);
    $role_chart['values'][] = $v;
}

// Filter dropdown lists.
$status_options = [['value' => '', 'label' => get_string('support_filter_all', 'local_istikama_admin'), 'selected' => $filters['status'] === '']];
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

$PAGE->set_url($baseurl);
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('support_admin_title', 'local_istikama_admin'));
$PAGE->activityheader->disable();
$PAGE->set_heading('');
$PAGE->set_secondary_navigation(false);
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

$isti_hide_page_header = true;
$isti_no_card_wrapper  = true;
require_once('admin_layout.php');

$dir = right_to_left() ? 'rtl' : 'ltr';
?>
<div class="container-fluid isti-support-admin" dir="<?= $dir ?>" style="background:#fff;padding:24px;min-height:600px">

    <!-- Header -->
    <div class="isti-card" style="padding:20px 24px;margin-bottom:18px;display:flex;align-items:center;gap:14px;flex-wrap:wrap">
        <span style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.3rem;flex-shrink:0">
            <i class="fa fa-shield-halved"></i>
        </span>
        <div style="flex:1;min-width:240px">
            <h5 style="margin:0;font-weight:700;color:#0f172a;font-size:1.15rem"><?= get_string('support_admin_title', 'local_istikama_admin') ?></h5>
            <p style="margin:4px 0 0;color:#64748b;font-size:.85rem"><?= get_string('support_admin_subtitle', 'local_istikama_admin') ?></p>
        </div>
        <a href="<?= (new moodle_url('/local/istikama_admin/support.php'))->out(false) ?>" class="isti-btn isti-btn-outline">
            <i class="fa fa-user"></i> <?= get_string('support_my_tickets', 'local_istikama_admin') ?>
        </a>
    </div>

    <!-- KPIs -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:14px;margin-bottom:18px">
        <?php
        $kpis = [
            ['icon' => 'fa-inbox',          'label' => get_string('support_kpi_total',       'local_istikama_admin'), 'value' => $analytics['total']],
            ['icon' => 'fa-bell',           'label' => get_string('support_kpi_open',        'local_istikama_admin'), 'value' => $analytics['open']],
            ['icon' => 'fa-fire',           'label' => get_string('support_kpi_urgent',      'local_istikama_admin'), 'value' => $analytics['urgent']],
            ['icon' => 'fa-circle-check',   'label' => get_string('support_kpi_resolved',    'local_istikama_admin'), 'value' => $analytics['resolved']],
            ['icon' => 'fa-clock',          'label' => get_string('support_kpi_avg_resolve', 'local_istikama_admin'), 'value' => $analytics['avg_resolve_hours'] === null ? '—' : $analytics['avg_resolve_hours']],
            ['icon' => 'fa-bolt',           'label' => get_string('support_kpi_recent_7d',   'local_istikama_admin'), 'value' => $analytics['recent_count_7d']],
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

    <!-- Breakdown charts -->
    <?php if (!empty($analytics['by_status']) || !empty($analytics['by_category']) || !empty($analytics['by_role'])): ?>
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:14px;margin-bottom:18px">
        <div class="isti-card" style="padding:18px 20px">
            <h6 style="font-weight:700;color:#0f172a;font-size:.92rem;margin-bottom:10px">
                <i class="fa fa-flag" style="color:#006bff"></i> <?= get_string('support_breakdown_status', 'local_istikama_admin') ?>
            </h6>
            <div style="position:relative;height:200px"><canvas id="supStatusChart"></canvas></div>
        </div>
        <div class="isti-card" style="padding:18px 20px">
            <h6 style="font-weight:700;color:#0f172a;font-size:.92rem;margin-bottom:10px">
                <i class="fa fa-folder-open" style="color:#006bff"></i> <?= get_string('support_breakdown_category', 'local_istikama_admin') ?>
            </h6>
            <div style="position:relative;height:200px"><canvas id="supCategoryChart"></canvas></div>
        </div>
        <div class="isti-card" style="padding:18px 20px">
            <h6 style="font-weight:700;color:#0f172a;font-size:.92rem;margin-bottom:10px">
                <i class="fa fa-users" style="color:#006bff"></i> <?= get_string('support_breakdown_role', 'local_istikama_admin') ?>
            </h6>
            <div style="position:relative;height:200px"><canvas id="supRoleChart"></canvas></div>
        </div>
    </div>
    <?php endif; ?>

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
            <label style="display:flex;align-items:center;gap:6px;font-size:.85rem;color:#475569">
                <input type="checkbox" name="mine_assigned" value="1"<?= $filters['mine_assigned'] ? ' checked' : '' ?>>
                <?= get_string('support_filter_mine', 'local_istikama_admin') ?>
            </label>
            <button type="submit" class="isti-btn isti-btn-primary" style="padding:9px 18px"><?= get_string('support_filter_apply', 'local_istikama_admin') ?></button>
            <a href="<?= $baseurl->out(false) ?>" class="isti-btn isti-btn-outline" style="padding:9px 18px"><?= get_string('support_filter_reset', 'local_istikama_admin') ?></a>
        </form>
    </div>

    <!-- Ticket list — unified blue-header data table -->
    <div class="isti-data-table">
        <?php if (empty($rows)): ?>
            <div class="isti-data-empty">
                <i class="fa fa-inbox isti-data-empty-icon"></i>
                <div class="isti-data-empty-title"><?= get_string('support_no_tickets_admin', 'local_istikama_admin') ?></div>
            </div>
        <?php else: ?>
            <div class="isti-data-table-scroll">
                <table>
                    <thead><tr>
                        <th><?= get_string('support_table_subject',  'local_istikama_admin') ?></th>
                        <th><?= get_string('support_table_user',     'local_istikama_admin') ?></th>
                        <th><?= get_string('support_table_category', 'local_istikama_admin') ?></th>
                        <th><?= get_string('support_table_priority', 'local_istikama_admin') ?></th>
                        <th><?= get_string('support_table_status',   'local_istikama_admin') ?></th>
                        <th><?= get_string('support_table_assigned', 'local_istikama_admin') ?></th>
                        <th><?= get_string('support_table_updated',  'local_istikama_admin') ?></th>
                    </tr></thead>
                    <tbody>
                    <?php foreach ($rows as $r): ?>
                        <tr class="supAdminRow isti-row-clickable" data-ticketid="<?= (int)$r['id'] ?>">
                            <td>
                                <span class="isti-cell-id">#<?= (int)$r['id'] ?></span>
                                <span class="isti-cell-title"><?= s($r['subject']) ?></span>
                                <?php if ($r['message_count'] > 0): ?>
                                    <span class="isti-cell-meta"><i class="fa fa-comment"></i> <?= (int)$r['message_count'] ?> replies</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <span class="isti-cell-title" style="display:block;font-size:.88rem"><?= s($r['author']) ?></span>
                                <span class="isti-cell-meta"><?= s($r['role'] ?: $r['email']) ?></span>
                            </td>
                            <td>
                                <i class="fa <?= s($r['category_icon']) ?>" style="color:#94a3b8"></i> <?= s($r['category_label']) ?>
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
                            <td>
                                <?= $r['assigned'] ? s($r['assigned']) : '<span style="color:#cbd5e1">—</span>' ?>
                            </td>
                            <td style="color:#64748b;font-size:.82rem"><?= s($r['updated']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- ── Ticket detail modal (iframe-based — reuses support_ticket.php embedded mode) ── -->
    <div class="isti-modal-overlay" id="supTicketModal" role="dialog" aria-modal="true" aria-labelledby="supTicketModalTitle" style="display:none">
        <div class="isti-modal" style="max-width:1100px;width:100%;max-height:92vh">
            <div class="isti-modal-header">
                <h5 id="supTicketModalTitle" style="margin:0;font-weight:700;color:#0f172a;font-size:1.05rem;display:flex;align-items:center;gap:10px">
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;background:#eff6ff;color:#006bff;font-size:1rem">
                        <i class="fa fa-life-ring"></i>
                    </span>
                    Ticket detail
                </h5>
                <button type="button" id="supTicketModalClose" aria-label="Close" style="background:transparent;border:0;color:#64748b;font-size:1.2rem;cursor:pointer;padding:6px 10px">
                    <i class="fa fa-xmark"></i>
                </button>
            </div>
            <div class="isti-modal-body" style="padding:0;background:#f1f5f9">
                <iframe id="supTicketFrame" src="about:blank"
                        style="width:100%;height:75vh;border:0;display:block;background:#fff"
                        title="Ticket detail"></iframe>
            </div>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Chart === 'undefined') return;
    var palette = ['#006bff', '#10b981', '#f59e0b', '#a855f7', '#06b6d4', '#3389ff', '#ef4444', '#64748b'];
    function donut(canvasId, labels, values) {
        var el = document.getElementById(canvasId);
        if (!el || !labels.length) return;
        new Chart(el.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{ data: values, backgroundColor: palette, borderWidth: 0 }]
            },
            options: {
                responsive: true, maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { color: '#475569', font: { size: 11 } } } },
                cutout: '60%',
            }
        });
    }
    donut('supStatusChart',   <?= json_encode($status_chart['labels']) ?>, <?= json_encode($status_chart['values']) ?>);
    donut('supCategoryChart', <?= json_encode($cat_chart['labels'])    ?>, <?= json_encode($cat_chart['values'])    ?>);
    donut('supRoleChart',     <?= json_encode($role_chart['labels'])   ?>, <?= json_encode($role_chart['values'])   ?>);

    // ── Ticket detail modal (iframe loads support_ticket.php?embedded=1) ─
    var modal    = document.getElementById('supTicketModal');
    var frame    = document.getElementById('supTicketFrame');
    var closeBtn = document.getElementById('supTicketModalClose');
    var titleEl  = document.getElementById('supTicketModalTitle');

    function openTicket(id, subject) {
        if (!modal || !frame) return;
        frame.src = '/local/istikama_admin/support_ticket.php?id=' + encodeURIComponent(id) + '&embedded=1';
        if (titleEl && subject) {
            titleEl.querySelector('span:last-child') || titleEl;
            // Update the text node next to the icon span — keep the icon.
            var icon = titleEl.querySelector('span');
            titleEl.innerHTML = '';
            if (icon) titleEl.appendChild(icon);
            titleEl.insertAdjacentText('beforeend', ' #' + id + ' — ' + subject);
        }
        modal.style.display = 'flex';
        requestAnimationFrame(function() { modal.classList.add('visible'); });
        document.body.style.overflow = 'hidden';
    }
    function closeTicket() {
        if (!modal) return;
        modal.classList.remove('visible');
        document.body.style.overflow = '';
        setTimeout(function() {
            modal.style.display = 'none';
            if (frame) frame.src = 'about:blank';
        }, 200);
        // Soft refresh of the table so status changes inside the modal are reflected.
        // Defer so the iframe's last navigation has completed.
        setTimeout(function() { window.location.reload(); }, 220);
    }

    if (closeBtn) closeBtn.addEventListener('click', closeTicket);
    if (modal) {
        modal.addEventListener('click', function(e) { if (e.target === modal) closeTicket(); });
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal.classList.contains('visible')) closeTicket();
        });
    }

    document.querySelectorAll('.supAdminRow').forEach(function(tr) {
        tr.addEventListener('click', function(e) {
            // Don't intercept clicks on links inside the row.
            if (e.target.closest('a, button')) { return; }
            var id = tr.getAttribute('data-ticketid');
            var subj = (tr.querySelector('td') || {}).innerText || '';
            openTicket(id, subj.trim());
        });
    });
});
</script>

<?php
echo '</div>';   // close .container-fluid
echo '</div>';   // close .istikama-dashboard-container from admin_layout.php
echo $OUTPUT->footer();
