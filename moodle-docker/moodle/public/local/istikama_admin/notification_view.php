<?php
/**
 * Recipient-side notification viewer.
 *
 * This page exists so that students, teachers, and parents can OPEN a
 * notification they received without hitting the school-manager-only guard
 * on school_notifications.php (which previously caused the
 * "Sorry, but you do not currently have permissions to do that
 * (Change site configuration)" error when recipients clicked the notification
 * link).
 *
 * Permission model:
 *   - require_login() — any authenticated user.
 *   - The viewer can open a notification only if:
 *       (a) they belong to the same school the notification was sent to, AND
 *       (b) they match the audience filters (role / class / level).
 *     Staff (admins / school managers / technical professors) can always
 *     view notifications they have scope over.
 *
 * No admin/site:config capability is required — by design.
 */

require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/locallib.php');
require_once(__DIR__ . '/classes/notification_manager.php');

use local_istikama_admin\notification_manager;

require_login();

$nid = required_param('id', PARAM_INT);

global $DB, $USER, $PAGE, $OUTPUT;

$n = $DB->get_record('istikama_school_notification', ['id' => $nid], '*', MUST_EXIST);

// ── Permission gate: is the viewer authorized to see THIS notification? ──
$tier = local_istikama_admin_get_user_tier();
$is_staff = in_array($tier, ['full_admin', 'school_manager', 'technical_professor'], true);

$canview = false;
if ($is_staff) {
    if ($tier === 'full_admin' || $tier === 'technical_professor') {
        $canview = true;
    } else if ($tier === 'school_manager') {
        $mgrschool = local_istikama_admin_get_manager_school();
        $canview = $mgrschool && (int)$mgrschool === (int)$n->schoolid;
    }
} else {
    // Regular recipient: must belong to the school AND match audience filters.
    $where  = ['us.userid = :uid', 'us.schoolid = :sch'];
    $params = ['uid' => $USER->id, 'sch' => $n->schoolid];
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
    $sql = 'SELECT 1 FROM {istikama_user_school} us WHERE ' . implode(' AND ', $where);
    $canview = $DB->record_exists_sql($sql, $params);
}

if (!$canview) {
    // We deliberately don't expose ANY admin capability — just a 403-ish page.
    throw new \moodle_exception('nopermissions', 'error', new \moodle_url('/my/'),
        get_string('sn_no_permission', 'local_istikama_admin'));
}

// ── Page setup ──
$baseurl = new moodle_url('/local/istikama_admin/notification_view.php', ['id' => $nid]);
$PAGE->set_url($baseurl);
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title(format_string($n->title));
$PAGE->activityheader->disable();
$PAGE->set_heading('');
$PAGE->set_secondary_navigation(false);
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

$isti_hide_page_header = true;
$isti_no_card_wrapper  = true;
require_once('admin_layout.php');

// Sender info.
$sender = null;
if (!empty($n->sentby)) {
    $sender = $DB->get_record('user', ['id' => $n->sentby], 'id,firstname,lastname,picture,imagealt,firstnamephonetic,lastnamephonetic,middlename,alternatename', IGNORE_MISSING);
}

// Audience label (for staff view).
$audroles = notification_manager::get_audience_roles();
$audlabel = '';
if (!empty($n->audience_role) && $n->audience_role !== 'all') {
    $audlabel = $audroles[$n->audience_role]['label'] ?? $n->audience_role;
} else {
    $audlabel = get_string('sn_audience_all', 'local_istikama_admin');
}

$statuses = notification_manager::get_statuses();
$smeta    = $statuses[$n->status] ?? null;

// School name.
$schoolname = '';
try {
    $schoolname = format_string(core_course_category::get($n->schoolid)->name);
} catch (\Throwable $e) {}

$dir = right_to_left() ? 'rtl' : 'ltr';

// Back URL: staff go back to their dashboard, recipients to /my/.
$back_url = $is_staff
    ? (new moodle_url('/local/istikama_admin/school_notifications.php'))->out(false)
    : (new moodle_url('/my/'))->out(false);
?>
<div class="container-fluid isti-notification-view" dir="<?= $dir ?>" style="background:#fff;padding:24px;min-height:600px;max-width:900px;margin:0 auto">

    <!-- Header card -->
    <div class="isti-card" style="padding:22px 26px;margin-bottom:18px;display:flex;align-items:flex-start;gap:16px;flex-wrap:wrap">
        <a href="<?= s($back_url) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
            <i class="fa fa-arrow-left"></i> <?= s(get_string('back', 'moodle')) ?>
        </a>
        <span style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.3rem;flex-shrink:0">
            <i class="fa fa-bullhorn"></i>
        </span>
        <div style="flex:1;min-width:240px">
            <h5 style="margin:0;font-weight:700;color:#0f172a;font-size:1.2rem;line-height:1.35"><?= s(format_string($n->title)) ?></h5>
            <div style="margin-top:8px;color:#64748b;font-size:.85rem;display:flex;flex-wrap:wrap;gap:12px;align-items:center">
                <?php if ($sender): ?>
                <span><i class="fa fa-user" style="color:#94a3b8"></i> <?= s(fullname($sender)) ?></span>
                <span style="color:#cbd5e1">·</span>
                <?php endif; ?>
                <?php if ($schoolname): ?>
                <span><i class="fa fa-school" style="color:#94a3b8"></i> <?= s($schoolname) ?></span>
                <span style="color:#cbd5e1">·</span>
                <?php endif; ?>
                <?php if ($n->sentat): ?>
                <span><i class="fa fa-clock" style="color:#94a3b8"></i> <?= s(userdate($n->sentat, get_string('strftimedatetimeshort', 'langconfig'))) ?></span>
                <?php endif; ?>
                <?php if ($smeta): ?>
                <span style="background:<?= s($smeta['bg']) ?>;color:<?= s($smeta['fg']) ?>;font-size:.72rem;font-weight:600;padding:3px 10px;border-radius:999px;display:inline-flex;align-items:center;gap:5px">
                    <i class="fa <?= s($smeta['icon']) ?>"></i> <?= s($smeta['label']) ?>
                </span>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Message body -->
    <div class="isti-card" style="padding:28px 32px;line-height:1.75;color:#0f172a;font-size:.96rem;white-space:pre-wrap;word-break:break-word">
        <?= s($n->body) ?>
    </div>

    <?php if ($is_staff): ?>
    <!-- Staff-only delivery panel -->
    <div class="isti-card" style="padding:20px 24px;margin-top:18px">
        <h6 style="font-weight:700;color:#0f172a;font-size:.95rem;margin-bottom:12px">
            <i class="fa fa-chart-simple" style="color:#006bff"></i> <?= s(get_string('sn_section_analytics', 'local_istikama_admin')) ?>
        </h6>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:12px">
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:12px 14px">
                <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;color:#64748b;font-weight:600"><?= s(get_string('sn_table_audience', 'local_istikama_admin')) ?></div>
                <div style="font-size:1rem;font-weight:700;color:#0f172a;margin-top:2px"><?= s($audlabel) ?></div>
            </div>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:12px 14px">
                <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;color:#64748b;font-weight:600"><?= s(get_string('sn_table_recipients', 'local_istikama_admin')) ?></div>
                <div style="font-size:1rem;font-weight:700;color:#0f172a;margin-top:2px"><?= (int)$n->recipients_count ?></div>
            </div>
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:12px 14px">
                <div style="font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;color:#64748b;font-weight:600"><?= s(get_string('sn_table_date', 'local_istikama_admin')) ?></div>
                <div style="font-size:.85rem;font-weight:600;color:#0f172a;margin-top:2px">
                    <?= s($n->sentat ? userdate($n->sentat, get_string('strftimedatetimeshort', 'langconfig')) : userdate($n->timecreated, get_string('strftimedatetimeshort', 'langconfig'))) ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>

<?php
echo '</div>'; // close .container-fluid
echo '</div>'; // close .istikama-dashboard-container from admin_layout.php
echo $OUTPUT->footer();
