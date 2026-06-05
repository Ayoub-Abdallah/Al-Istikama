<?php
/**
 * Advertisements & Announcements — admin management page.
 *
 * Full-admins and school managers create/edit/delete flexible announcements,
 * choose placement (popup / sidebar / login), audience, schedule, dismissal,
 * and upload an image. Uses the unified blue-header data table + the platform
 * modal pattern.
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->libdir . '/filelib.php');
require_once(__DIR__ . '/locallib.php');
require_once(__DIR__ . '/classes/advertisement_manager.php');

use local_istikama_admin\advertisement_manager;

require_login();
if (!advertisement_manager::user_is_admin((int)$USER->id)) {
    throw new required_capability_exception(context_system::instance(), 'moodle/site:config', 'nopermissions', '');
}

$baseurl = new moodle_url('/local/istikama_admin/advertisements.php');
$action  = optional_param('action', '', PARAM_ALPHANUMEXT);

global $DB, $USER, $PAGE, $OUTPUT;

// ── POST handlers ───────────────────────────────────────────────────────────
if ($action === 'save' && confirm_sesskey()) {
    try {
        $start = optional_param('starttime', 0, PARAM_INT);
        $end   = optional_param('endtime', 0, PARAM_INT);
        $adid = advertisement_manager::save([
            'id'           => optional_param('id', 0, PARAM_INT),
            'title'        => required_param('title', PARAM_TEXT),
            'content'      => optional_param('content', '', PARAM_RAW),
            'linkurl'      => optional_param('linkurl', '', PARAM_RAW_TRIMMED),
            'linktext'     => optional_param('linktext', '', PARAM_TEXT),
            'placement'    => optional_param_array('placement', [], PARAM_ALPHA),
            'trigger_rule' => optional_param('trigger_rule', 'everyvisit', PARAM_ALPHA),
            'audience'     => optional_param('audience', 'student', PARAM_ALPHA),
            'schoolid'     => optional_param('schoolid', 0, PARAM_INT),
            'dismissible'  => optional_param('dismissible', 0, PARAM_INT),
            'priority'     => optional_param('priority', 0, PARAM_INT),
            'bgcolor'      => optional_param('bgcolor', '', PARAM_TEXT),
            'status'       => optional_param('status', 'active', PARAM_ALPHA),
            'starttime'    => $start,
            'endtime'      => $end,
            // No draft area — we save the raw multipart upload below instead.
        ], (int)$USER->id);

        // Persist the uploaded image (raw $_FILES upload from our dropzone).
        if (!empty($_FILES['adimage_file']) && isset($_FILES['adimage_file']['error'])
            && $_FILES['adimage_file']['error'] === UPLOAD_ERR_OK
            && !empty($_FILES['adimage_file']['tmp_name'])) {
            advertisement_manager::replace_image_from_path(
                $adid,
                $_FILES['adimage_file']['tmp_name'],
                (string)($_FILES['adimage_file']['name'] ?? '')
            );
        }

        \core\notification::success(get_string('ad_saved', 'local_istikama_admin'));
    } catch (\Throwable $e) {
        \core\notification::error($e->getMessage());
    }
    redirect($baseurl);
}

if ($action === 'delete' && confirm_sesskey()) {
    advertisement_manager::delete(required_param('id', PARAM_INT));
    \core\notification::success(get_string('ad_deleted', 'local_istikama_admin'));
    redirect($baseurl);
}

if ($action === 'toggle' && confirm_sesskey()) {
    $id = required_param('id', PARAM_INT);
    $ad = advertisement_manager::get($id);
    if ($ad) {
        advertisement_manager::set_status($id,
            $ad->status === advertisement_manager::STATUS_ACTIVE
                ? advertisement_manager::STATUS_INACTIVE : advertisement_manager::STATUS_ACTIVE);
        \core\notification::success(get_string('ad_status_changed', 'local_istikama_admin'));
    }
    redirect($baseurl);
}

// ── Read ────────────────────────────────────────────────────────────────────
$filters = ['status' => optional_param('status', '', PARAM_ALPHA), 'q' => optional_param('q', '', PARAM_TEXT)];
$ads = advertisement_manager::list_all($filters);

$placements = advertisement_manager::get_placements();
$triggers   = advertisement_manager::get_triggers();
$audiences  = advertisement_manager::get_audiences();
$statuses   = advertisement_manager::get_statuses();

// KPIs.
$kpi = ['total' => 0, 'active' => 0, 'views' => 0, 'clicks' => 0];
foreach ($ads as $a) {
    $kpi['total']++;
    if ($a->status === 'active') { $kpi['active']++; }
    $kpi['views']  += (int)$a->viewcount;
    $kpi['clicks'] += (int)$a->clickcount;
}

// Shape rows + a JSON map for the edit modal.
$rows = []; $editmap = [];
foreach ($ads as $a) {
    $st = $statuses[$a->status] ?? null;
    $placelabels = [];
    foreach (explode(',', $a->placement) as $p) {
        if (isset($placements[$p])) { $placelabels[] = $placements[$p]['label']; }
    }
    $window = '—';
    if ($a->starttime || $a->endtime) {
        $sfrom = $a->starttime ? userdate($a->starttime, get_string('strftimedateshort', 'langconfig')) : '…';
        $sto   = $a->endtime ? userdate($a->endtime, get_string('strftimedateshort', 'langconfig')) : '…';
        $window = $sfrom . ' → ' . $sto;
    }
    $rows[] = [
        'id'          => (int)$a->id,
        'title'       => format_string($a->title),
        'img'         => advertisement_manager::image_url((int)$a->id),
        'placement'   => implode(' · ', $placelabels),
        'audience'    => $audiences[$a->audience] ?? $a->audience,
        'status'      => $a->status,
        'status_label'=> $st['label'] ?? $a->status,
        'status_bg'   => $st['bg'] ?? '#f1f5f9',
        'status_fg'   => $st['fg'] ?? '#475569',
        'status_icon' => $st['icon'] ?? 'fa-tag',
        'window'      => $window,
        'views'       => (int)$a->viewcount,
        'clicks'      => (int)$a->clickcount,
        'is_active'   => $a->status === 'active',
    ];
    $editmap[(int)$a->id] = [
        'id'           => (int)$a->id,
        'title'        => $a->title,
        'content'      => $a->content,
        'linkurl'      => $a->linkurl,
        'linktext'     => $a->linktext,
        'placement'    => explode(',', $a->placement),
        'trigger_rule' => $a->trigger_rule,
        'audience'     => $a->audience,
        'dismissible'  => (int)$a->dismissible,
        'priority'     => (int)$a->priority,
        'status'       => $a->status,
        'starttime'    => (int)$a->starttime,
        'endtime'      => (int)$a->endtime,
    ];
}

// Status filter options.
$status_options = [['value' => '', 'label' => get_string('ad_filter_all', 'local_istikama_admin'), 'selected' => $filters['status'] === '']];
foreach ($statuses as $k => $m) {
    $status_options[] = ['value' => $k, 'label' => $m['label'], 'selected' => $filters['status'] === $k];
}

$draftitemid = file_get_unused_draft_itemid();

$PAGE->set_url($baseurl);
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('base');
$PAGE->set_title(get_string('ad_page_title', 'local_istikama_admin'));
$PAGE->activityheader->disable();
$PAGE->set_heading('');
$PAGE->set_secondary_navigation(false);
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

$isti_hide_page_header = true;
$isti_no_card_wrapper  = true;
require_once('admin_layout.php');

$dir = right_to_left() ? 'rtl' : 'ltr';
?>
<div class="container-fluid isti-ads" dir="<?= $dir ?>" style="background:#fff;padding:24px;min-height:600px">

    <!-- Header -->
    <div class="isti-card" style="padding:20px 24px;margin-bottom:18px;display:flex;align-items:center;gap:14px;flex-wrap:wrap">
        <span style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:12px;background:#eff6ff;color:#006bff;font-size:1.3rem;flex-shrink:0">
            <i class="fa fa-bullhorn"></i>
        </span>
        <div style="flex:1;min-width:240px">
            <h5 style="margin:0;font-weight:700;color:#0f172a;font-size:1.15rem"><?= get_string('ad_page_title', 'local_istikama_admin') ?></h5>
            <p style="margin:4px 0 0;color:#64748b;font-size:.85rem"><?= get_string('ad_page_subtitle', 'local_istikama_admin') ?></p>
        </div>
        <button type="button" class="isti-btn isti-btn-primary" id="adNewBtn"><i class="fa fa-plus"></i> <?= get_string('ad_new', 'local_istikama_admin') ?></button>
    </div>

    <!-- KPIs -->
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:14px;margin-bottom:18px">
        <?php foreach ([
            ['fa-rectangle-ad', get_string('ad_kpi_total','local_istikama_admin'), $kpi['total']],
            ['fa-circle-check', get_string('ad_kpi_active','local_istikama_admin'), $kpi['active']],
            ['fa-eye',          get_string('ad_kpi_views','local_istikama_admin'), $kpi['views']],
            ['fa-hand-pointer', get_string('ad_kpi_clicks','local_istikama_admin'), $kpi['clicks']],
        ] as $k): ?>
        <div class="isti-card" style="padding:16px 18px;display:flex;align-items:center;gap:14px">
            <div style="width:44px;height:44px;border-radius:11px;background:#eff6ff;color:#006bff;display:inline-flex;align-items:center;justify-content:center;font-size:1.05rem;flex-shrink:0"><i class="fa <?= $k[0] ?>"></i></div>
            <div><div style="font-size:.74rem;text-transform:uppercase;letter-spacing:.45px;color:#64748b;font-weight:600"><?= s($k[1]) ?></div>
            <div style="font-size:1.5rem;font-weight:700;color:#0f172a;margin-top:2px;line-height:1.1"><?= (int)$k[2] ?></div></div>
        </div>
        <?php endforeach; ?>
    </div>

    <!-- Filters -->
    <div class="isti-card" style="padding:14px 18px;margin-bottom:14px">
        <form method="get" action="<?= $baseurl->out(false) ?>" style="display:flex;gap:10px;align-items:center;flex-wrap:wrap">
            <input type="text" name="q" value="<?= s($filters['q']) ?>" placeholder="<?= s(get_string('ad_filter_search_ph','local_istikama_admin')) ?>" style="flex:1;min-width:200px;padding:9px 13px;border:1px solid #cbd5e1;border-radius:8px">
            <select name="status" style="padding:9px 13px;border:1px solid #cbd5e1;border-radius:8px">
                <?php foreach ($status_options as $o): ?><option value="<?= s($o['value']) ?>"<?= $o['selected']?' selected':'' ?>><?= s($o['label']) ?></option><?php endforeach; ?>
            </select>
            <button type="submit" class="isti-btn isti-btn-primary" style="padding:9px 18px"><?= get_string('ad_apply','local_istikama_admin') ?></button>
            <a href="<?= $baseurl->out(false) ?>" class="isti-btn isti-btn-outline" style="padding:9px 18px"><?= get_string('ad_reset','local_istikama_admin') ?></a>
        </form>
    </div>

    <!-- Table -->
    <div class="isti-data-table">
        <?php if (empty($rows)): ?>
            <div class="isti-data-empty">
                <i class="fa fa-bullhorn isti-data-empty-icon"></i>
                <div class="isti-data-empty-title"><?= get_string('ad_no_ads','local_istikama_admin') ?></div>
                <div class="isti-data-empty-msg"><?= get_string('ad_no_ads_msg','local_istikama_admin') ?></div>
            </div>
        <?php else: ?>
            <div class="isti-data-table-scroll">
                <table>
                    <thead><tr>
                        <th><?= get_string('ad_table_title','local_istikama_admin') ?></th>
                        <th><?= get_string('ad_table_placement','local_istikama_admin') ?></th>
                        <th><?= get_string('ad_table_audience','local_istikama_admin') ?></th>
                        <th><?= get_string('ad_table_status','local_istikama_admin') ?></th>
                        <th><?= get_string('ad_table_window','local_istikama_admin') ?></th>
                        <th><?= get_string('ad_table_stats','local_istikama_admin') ?></th>
                        <th class="isti-th-right"><?= get_string('ad_table_actions','local_istikama_admin') ?></th>
                    </tr></thead>
                    <tbody>
                    <?php foreach ($rows as $r): ?>
                        <tr>
                            <td>
                                <div style="display:flex;align-items:center;gap:12px">
                                    <?php if ($r['img']): ?>
                                        <img src="<?= s($r['img']) ?>" alt="" style="width:48px;height:48px;border-radius:8px;object-fit:cover;flex-shrink:0">
                                    <?php else: ?>
                                        <span style="width:48px;height:48px;border-radius:8px;background:#f1f5f9;color:#cbd5e1;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0"><i class="fa fa-image"></i></span>
                                    <?php endif; ?>
                                    <span class="isti-cell-title"><?= s($r['title']) ?></span>
                                </div>
                            </td>
                            <td><?= s($r['placement']) ?></td>
                            <td><?= s($r['audience']) ?></td>
                            <td><span class="isti-pill" style="background:<?= s($r['status_bg']) ?>;color:<?= s($r['status_fg']) ?>"><i class="fa <?= s($r['status_icon']) ?>"></i> <?= s($r['status_label']) ?></span></td>
                            <td style="color:#64748b;font-size:.84rem"><?= s($r['window']) ?></td>
                            <td style="color:#64748b;font-size:.86rem"><i class="fa fa-eye" style="color:#94a3b8"></i> <?= (int)$r['views'] ?> &nbsp; <i class="fa fa-hand-pointer" style="color:#94a3b8"></i> <?= (int)$r['clicks'] ?></td>
                            <td class="isti-td-actions">
                                <button type="button" class="isti-tbl-action adEditBtn" data-id="<?= (int)$r['id'] ?>" title="<?= s(get_string('ad_tip_edit','local_istikama_admin')) ?>"><i class="fa fa-pen"></i></button>
                                <form method="post" action="<?= $baseurl->out(false) ?>" class="isti-tbl-action-form">
                                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>"><input type="hidden" name="action" value="toggle"><input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                                    <button type="submit" class="isti-tbl-action" title="<?= s($r['is_active']?get_string('ad_tip_deactivate','local_istikama_admin'):get_string('ad_tip_activate','local_istikama_admin')) ?>"><i class="fa <?= $r['is_active']?'fa-pause':'fa-play' ?>"></i></button>
                                </form>
                                <form method="post" action="<?= $baseurl->out(false) ?>" class="isti-tbl-action-form" onsubmit="return confirm('<?= s(get_string('ad_delete_confirm','local_istikama_admin')) ?>')">
                                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                                    <button type="submit" class="isti-tbl-action isti-tbl-action-danger" title="<?= s(get_string('ad_tip_delete','local_istikama_admin')) ?>"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- ── Create / Edit modal ── -->
    <div class="isti-modal-overlay" id="adModal" role="dialog" aria-modal="true" style="display:none">
        <div class="isti-modal" style="max-width:760px;width:100%;max-height:92vh">
            <div class="isti-modal-header">
                <h5 style="margin:0;font-weight:700;color:#0f172a;font-size:1.05rem;display:flex;align-items:center;gap:10px">
                    <span style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;background:#eff6ff;color:#006bff;font-size:1rem"><i class="fa fa-bullhorn"></i></span>
                    <span id="adModalTitle"><?= get_string('ad_create_title','local_istikama_admin') ?></span>
                </h5>
                <button type="button" id="adModalClose" aria-label="Close" style="background:transparent;border:0;color:#64748b;font-size:1.2rem;cursor:pointer;padding:6px 10px"><i class="fa fa-xmark"></i></button>
            </div>
            <form method="post" action="<?= $baseurl->out(false) ?>" enctype="multipart/form-data">
                <div class="isti-modal-body">
                    <input type="hidden" name="sesskey" value="<?= sesskey() ?>">
                    <input type="hidden" name="action" value="save">
                    <input type="hidden" name="id" id="adId" value="">
                    <input type="hidden" name="adimage" value="<?= (int)$draftitemid ?>">
                    <input type="hidden" name="starttime" id="adStartUnix" value="0">
                    <input type="hidden" name="endtime" id="adEndUnix" value="0">

                    <div style="margin-bottom:16px">
                        <label class="adlbl"><?= get_string('ad_field_title','local_istikama_admin') ?> *</label>
                        <input type="text" name="title" id="adTitle" required maxlength="255" placeholder="<?= s(get_string('ad_field_title_ph','local_istikama_admin')) ?>" class="adinput">
                    </div>

                    <div style="margin-bottom:16px">
                        <label class="adlbl"><?= get_string('ad_field_content','local_istikama_admin') ?></label>
                        <textarea name="content" id="adContent" rows="3" placeholder="<?= s(get_string('ad_field_content_ph','local_istikama_admin')) ?>" class="adinput" style="resize:vertical;font-family:inherit;line-height:1.6"></textarea>
                    </div>

                    <div style="margin-bottom:16px">
                        <label class="adlbl"><i class="fa fa-image" style="color:#006bff"></i> <?= get_string('ad_field_image','local_istikama_admin') ?></label>
                        <div id="adDropzone" style="border:2px dashed #cbd5e1;border-radius:12px;padding:18px;background:#f8fafc;text-align:center;cursor:pointer;position:relative">
                            <i class="fa fa-cloud-upload-alt" style="font-size:1.6rem;color:#94a3b8;display:block;margin-bottom:4px"></i>
                            <span style="color:#475569;font-size:.86rem;font-weight:500"><?= get_string('ad_dropzone','local_istikama_admin') ?></span>
                            <input type="file" name="adimage_file" id="adImageInput" accept="image/*" style="position:absolute;width:1px;height:1px;opacity:0;overflow:hidden;clip:rect(0 0 0 0);clip-path:inset(50%);pointer-events:none">
                        </div>
                        <div id="adImgPreview" style="margin-top:8px;display:none"></div>
                        <small style="color:#94a3b8;display:block;margin-top:6px"><?= get_string('ad_field_image_help','local_istikama_admin') ?></small>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                        <div>
                            <label class="adlbl"><?= get_string('ad_field_link','local_istikama_admin') ?></label>
                            <input type="url" name="linkurl" id="adLink" placeholder="<?= s(get_string('ad_field_link_ph','local_istikama_admin')) ?>" class="adinput">
                        </div>
                        <div>
                            <label class="adlbl"><?= get_string('ad_field_linktext','local_istikama_admin') ?></label>
                            <input type="text" name="linktext" id="adLinkText" placeholder="<?= s(get_string('ad_field_linktext_ph','local_istikama_admin')) ?>" class="adinput">
                        </div>
                    </div>

                    <div style="margin-bottom:16px">
                        <label class="adlbl"><?= get_string('ad_field_placement','local_istikama_admin') ?></label>
                        <div style="display:flex;gap:10px;flex-wrap:wrap">
                            <?php foreach ($placements as $key => $meta): ?>
                            <label class="adplace" data-place="<?= s($key) ?>" style="display:inline-flex;align-items:center;gap:8px;padding:10px 16px;border:1.5px solid #e2e8f0;border-radius:10px;background:#f8fafc;cursor:pointer;font-size:.88rem;color:#475569;font-weight:600">
                                <input type="checkbox" name="placement[]" value="<?= s($key) ?>" class="adPlaceChk" <?= $key==='popup'?'checked':'' ?> style="display:none">
                                <i class="fa <?= s($meta['icon']) ?>"></i> <?= s($meta['label']) ?>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                        <div>
                            <label class="adlbl"><?= get_string('ad_field_trigger','local_istikama_admin') ?></label>
                            <select name="trigger_rule" id="adTrigger" class="adinput">
                                <?php foreach ($triggers as $k=>$l): ?><option value="<?= s($k) ?>"><?= s($l) ?></option><?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="adlbl"><?= get_string('ad_field_audience','local_istikama_admin') ?></label>
                            <select name="audience" id="adAudience" class="adinput">
                                <?php foreach ($audiences as $k=>$l): ?><option value="<?= s($k) ?>" <?= $k==='student'?'selected':'' ?>><?= s($l) ?></option><?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
                        <div>
                            <label class="adlbl"><?= get_string('ad_field_start','local_istikama_admin') ?></label>
                            <input type="datetime-local" id="adStartRaw" class="adinput">
                        </div>
                        <div>
                            <label class="adlbl"><?= get_string('ad_field_end','local_istikama_admin') ?></label>
                            <input type="datetime-local" id="adEndRaw" class="adinput">
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px;align-items:end">
                        <div>
                            <label class="adlbl"><?= get_string('ad_field_priority','local_istikama_admin') ?></label>
                            <input type="number" name="priority" id="adPriority" value="0" class="adinput">
                        </div>
                        <div>
                            <label class="adlbl"><?= get_string('ad_field_status','local_istikama_admin') ?></label>
                            <select name="status" id="adStatus" class="adinput">
                                <option value="active"><?= get_string('ad_status_active','local_istikama_admin') ?></option>
                                <option value="inactive"><?= get_string('ad_status_inactive','local_istikama_admin') ?></option>
                            </select>
                        </div>
                        <label style="display:flex;align-items:center;gap:8px;font-size:.9rem;color:#334155;padding-bottom:10px;cursor:pointer">
                            <input type="checkbox" name="dismissible" id="adDismiss" value="1" checked> <?= get_string('ad_field_dismissible','local_istikama_admin') ?>
                        </label>
                    </div>
                </div>
                <div class="isti-modal-footer">
                    <button type="button" id="adModalCancel" class="isti-btn isti-btn-outline"><?= get_string('ad_cancel','local_istikama_admin') ?></button>
                    <button type="submit" class="isti-btn isti-btn-primary"><i class="fa fa-floppy-disk"></i> <?= get_string('ad_save','local_istikama_admin') ?></button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.isti-ads .adlbl{display:block;font-weight:600;color:#475569;font-size:.78rem;text-transform:uppercase;letter-spacing:.4px;margin-bottom:6px}
.isti-ads .adinput{width:100%;padding:11px 14px;border:1.5px solid #cbd5e1;border-radius:10px;font-size:.93rem;color:#0f172a;background:#fff}
.isti-ads .adinput:focus{outline:0;border-color:#006bff;box-shadow:0 0 0 3px rgba(0,107,255,.12)}
.isti-ads .adplace.on{border-color:#006bff!important;background:#eff6ff!important;color:#006bff!important;box-shadow:0 0 0 3px rgba(0,107,255,.10)}
/* Guarantee the create/edit modal scrolls when its content (incl. an uploaded
   image preview) is taller than the viewport — independent of which global
   modal CSS is present. */
#adModal{overflow:auto;}
#adModal .isti-modal{display:flex;flex-direction:column;max-height:92vh;overflow:hidden;width:min(760px,calc(100vw - 32px));}
/* The <form> sits between .isti-modal and the body/footer, so it must also be a
   flex column that fills the modal — otherwise the body can never shrink and
   scroll. This is the actual fix for the "half the form is hidden" bug. */
#adModal .isti-modal>form{display:flex;flex-direction:column;flex:1 1 auto;min-height:0;}
#adModal .isti-modal-header,#adModal .isti-modal-footer{flex:0 0 auto;}
/* min-height:0 lets this flex child shrink below its content height so the
   browser paints a vertical scrollbar instead of overflowing the modal.
   overflow-x:hidden kills the stray horizontal scrollbar. */
#adModal .isti-modal-body{flex:1 1 auto;min-height:0;overflow-y:auto;overflow-x:hidden;-webkit-overflow-scrolling:touch;}
#adModal #adImgPreview img{max-height:240px;max-width:100%;width:auto;border-radius:10px;}
</style>

<script>
(function(){
    function bindModal(id, closeIds){
        var m=document.getElementById(id); if(!m) return {show:function(){},hide:function(){}};
        function show(){m.style.display='flex';requestAnimationFrame(function(){m.classList.add('visible')});document.body.style.overflow='hidden';}
        function hide(){m.classList.remove('visible');document.body.style.overflow='';setTimeout(function(){m.style.display='none'},200);}
        (closeIds||[]).forEach(function(c){var e=document.getElementById(c);if(e)e.addEventListener('click',function(ev){ev.preventDefault();hide();});});
        m.addEventListener('click',function(e){if(e.target===m)hide();});
        document.addEventListener('keydown',function(e){if(e.key==='Escape'&&m.classList.contains('visible'))hide();});
        return {show:show,hide:hide};
    }
    var modal = bindModal('adModal',['adModalClose','adModalCancel']);

    function paintPlaces(){
        document.querySelectorAll('.adPlaceChk').forEach(function(c){
            c.closest('.adplace').classList.toggle('on', c.checked);
        });
    }
    document.querySelectorAll('.adplace').forEach(function(l){
        l.addEventListener('click', function(e){
            // let the native checkbox toggle, then repaint
            setTimeout(paintPlaces, 0);
        });
    });

    function unix(el){ return el.value ? Math.floor(new Date(el.value).getTime()/1000) : 0; }
    var sR=document.getElementById('adStartRaw'), eR=document.getElementById('adEndRaw');
    if(sR) sR.addEventListener('change',function(){document.getElementById('adStartUnix').value=unix(sR);});
    if(eR) eR.addEventListener('change',function(){document.getElementById('adEndUnix').value=unix(eR);});

    function resetForm(){
        document.getElementById('adId').value='';
        document.getElementById('adTitle').value='';
        document.getElementById('adContent').value='';
        document.getElementById('adLink').value='';
        document.getElementById('adLinkText').value='';
        document.getElementById('adTrigger').value='everyvisit';
        document.getElementById('adAudience').value='student';
        document.getElementById('adPriority').value='0';
        document.getElementById('adStatus').value='active';
        document.getElementById('adDismiss').checked=true;
        document.querySelectorAll('.adPlaceChk').forEach(function(c){c.checked=(c.value==='popup');});
        if(sR){sR.value='';} if(eR){eR.value='';}
        document.getElementById('adStartUnix').value='0'; document.getElementById('adEndUnix').value='0';
        document.getElementById('adImgPreview').style.display='none';
        document.getElementById('adImgPreview').innerHTML='';
        paintPlaces();
    }

    var newBtn=document.getElementById('adNewBtn');
    if(newBtn) newBtn.addEventListener('click',function(){
        resetForm();
        document.getElementById('adModalTitle').textContent=<?= json_encode(get_string('ad_create_title','local_istikama_admin')) ?>;
        modal.show();
    });

    var EDIT=<?= json_encode($editmap, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?>;
    document.querySelectorAll('.adEditBtn').forEach(function(b){
        b.addEventListener('click',function(){
            var d=EDIT[b.getAttribute('data-id')]; if(!d) return;
            resetForm();
            document.getElementById('adModalTitle').textContent=<?= json_encode(get_string('ad_edit_title','local_istikama_admin')) ?>;
            document.getElementById('adId').value=d.id;
            document.getElementById('adTitle').value=d.title||'';
            document.getElementById('adContent').value=d.content||'';
            document.getElementById('adLink').value=d.linkurl||'';
            document.getElementById('adLinkText').value=d.linktext||'';
            document.getElementById('adTrigger').value=d.trigger_rule||'everyvisit';
            document.getElementById('adAudience').value=d.audience||'student';
            document.getElementById('adPriority').value=d.priority||0;
            document.getElementById('adStatus').value=d.status||'active';
            document.getElementById('adDismiss').checked=!!d.dismissible;
            document.querySelectorAll('.adPlaceChk').forEach(function(c){c.checked=(d.placement||[]).indexOf(c.value)>=0;});
            function toLocal(ts){ if(!ts) return ''; var dt=new Date(ts*1000); var p=function(n){return String(n).padStart(2,'0');}; return dt.getFullYear()+'-'+p(dt.getMonth()+1)+'-'+p(dt.getDate())+'T'+p(dt.getHours())+':'+p(dt.getMinutes()); }
            if(sR){sR.value=toLocal(d.starttime); document.getElementById('adStartUnix').value=d.starttime||0;}
            if(eR){eR.value=toLocal(d.endtime); document.getElementById('adEndUnix').value=d.endtime||0;}
            paintPlaces();
            modal.show();
        });
    });

    // Image dropzone preview
    var dz=document.getElementById('adDropzone'), fi=document.getElementById('adImageInput'), pv=document.getElementById('adImgPreview');
    if(dz&&fi&&pv){
        dz.addEventListener('click',function(){fi.click();});
        fi.addEventListener('change',function(){
            if(!fi.files||!fi.files[0]){pv.style.display='none';return;}
            var url=URL.createObjectURL(fi.files[0]);
            pv.style.display='block';
            pv.innerHTML='<img src="'+url+'" style="max-width:100%;max-height:200px;border-radius:10px;border:1px solid #e2e8f0">';
        });
        ['dragenter','dragover'].forEach(function(ev){dz.addEventListener(ev,function(e){e.preventDefault();e.stopPropagation();dz.style.borderColor='#006bff';dz.style.background='#eff6ff';});});
        ['dragleave','drop'].forEach(function(ev){dz.addEventListener(ev,function(e){e.preventDefault();e.stopPropagation();dz.style.borderColor='#cbd5e1';dz.style.background='#f8fafc';});});
        dz.addEventListener('drop',function(e){if(e.dataTransfer&&e.dataTransfer.files&&e.dataTransfer.files.length){fi.files=e.dataTransfer.files;fi.dispatchEvent(new Event('change'));}});
    }
    paintPlaces();
})();
</script>

<?php
echo '</div>';
echo '</div>';
echo $OUTPUT->footer();
