<?php
// This file is part of Moodle - http://moodle.org/

require_once('../../config.php');
require_once(__DIR__ . '/locallib.php');

use local_istikama_admin\season_manager;

require_login();
local_istikama_admin_require_full_admin();

$action = optional_param('action', '', PARAM_ALPHA);
$id = optional_param('id', 0, PARAM_INT);

$url = new moodle_url('/local/istikama_admin/seasons.php');
local_istikama_admin_setup_page($PAGE, $url, get_string('manage_seasons', 'local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

// ---------------------------------------------------------------------------
// Action handlers (all require sesskey).
// ---------------------------------------------------------------------------
if ($action && confirm_sesskey()) {
    try {
        switch ($action) {
            case 'create': {
                $data = (object)[
                    'name'        => required_param('name', PARAM_TEXT),
                    'description' => optional_param('description', '', PARAM_TEXT),
                    'start_date'  => required_param('start_date', PARAM_INT),
                    'end_date'    => required_param('end_date', PARAM_INT),
                ];
                season_manager::create($data);
                redirect($url, get_string('season_created', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
            case 'update': {
                $data = (object)[
                    'name'        => required_param('name', PARAM_TEXT),
                    'description' => optional_param('description', '', PARAM_TEXT),
                    'start_date'  => required_param('start_date', PARAM_INT),
                    'end_date'    => required_param('end_date', PARAM_INT),
                ];
                season_manager::update($id, $data);
                redirect($url, get_string('season_updated', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
            case 'activate': {
                season_manager::change_status($id, season_manager::STATUS_ACTIVE);
                redirect($url, get_string('season_activated', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
            case 'archive': {
                season_manager::change_status($id, season_manager::STATUS_ARCHIVED);
                redirect($url, get_string('season_archived', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
            case 'close': {
                // Strong gate: caller must include confirmtext matching the season name.
                $season = season_manager::get($id);
                if (!$season) {
                    throw new \moodle_exception('invalidrecord', 'error', '', 'Season');
                }
                $confirmtext = optional_param('confirmtext', '', PARAM_TEXT);
                if (trim($confirmtext) !== trim($season->name)) {
                    throw new \moodle_exception('season_close_name_mismatch', 'local_istikama_admin');
                }
                season_manager::change_status($id, season_manager::STATUS_CLOSED);
                redirect($url, get_string('season_closed', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
            case 'reopen': {
                season_manager::change_status($id, season_manager::STATUS_ACTIVE);
                redirect($url, get_string('season_reopened', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
            case 'upcoming': {
                season_manager::change_status($id, season_manager::STATUS_UPCOMING);
                redirect($url, get_string('season_marked_upcoming', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
            case 'delete': {
                season_manager::delete($id);
                redirect($url, get_string('season_deleted', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
            case 'restore': {
                season_manager::change_status($id, season_manager::STATUS_CLOSED);
                redirect($url, get_string('season_restored', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
        }
    } catch (\Throwable $e) {
        redirect($url, $e->getMessage(), 4, \core\output\notification::NOTIFY_ERROR);
    }
}

// ---------------------------------------------------------------------------
// Render.
// ---------------------------------------------------------------------------
$PAGE->requires->js(new moodle_url('/local/istikama_admin/js/seasons.js'));
require(__DIR__ . '/admin_layout.php');

// Fix any seasons that are Closed but haven't started yet (reset to Upcoming).
season_manager::auto_correct_statuses();

$seasons = season_manager::get_all();
$active = season_manager::get_active();
$statuses = season_manager::get_statuses();
$now = time();

// ---- Active season banner ----
echo '<div class="isti-section" style="margin-bottom: 24px;">';
if ($active) {
    echo '<div style="background: linear-gradient(135deg, #006bff, #0052cc); color: white; padding: 16px 20px; border-radius: 8px; display:flex; align-items:center; justify-content: space-between; gap: 16px;">';
    echo '<div>';
    echo '<div style="font-size: 12px; opacity: 0.85; text-transform: uppercase; letter-spacing: 0.5px;">' .
        get_string('current_active_season', 'local_istikama_admin') . '</div>';
    echo '<div style="font-size: 22px; font-weight: 700; margin-top: 4px;">' . s($active->name) . '</div>';
    echo '<div style="font-size: 13px; opacity: 0.9; margin-top: 2px;">' .
        userdate($active->start_date, get_string('strftimedate', 'langconfig')) . ' &rarr; ' .
        userdate($active->end_date, get_string('strftimedate', 'langconfig')) . '</div>';
    echo '</div>';
    echo '<div><i class="fa fa-check-circle" style="font-size: 36px; opacity: 0.5;"></i></div>';
    echo '</div>';
} else {
    echo '<div style="background: #fef3c7; border-left: 4px solid #f59e0b; color: #78350f; padding: 14px 18px; border-radius: 6px;">';
    echo '<strong><i class="fa fa-exclamation-triangle"></i> ' . get_string('no_active_season', 'local_istikama_admin') . '</strong><br>';
    echo '<span style="font-size: 13px;">' . get_string('no_active_season_help', 'local_istikama_admin') . '</span>';
    echo '</div>';
}
echo '</div>';

// ---- Create button (opens the modal below) ----
echo '<div style="display:flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">';
echo '<h3 style="margin: 0; color: #1e293b;">' . get_string('all_seasons', 'local_istikama_admin') . '</h3>';
echo '<button type="button" id="isti-new-season-btn" class="btn" style="background: #006bff; color: white; padding: 8px 18px; border-radius: 6px; border: 0; cursor:pointer;">';
echo '<i class="fa fa-plus"></i> ' . get_string('new_season', 'local_istikama_admin');
echo '</button>';
echo '</div>';

// ---- Seasons table ----
echo '<div style="background:white; border:1px solid #e2e8f0; border-radius:8px; overflow:hidden;">';
echo '<table class="isti-table" style="width:100%; border-collapse:collapse;">';
echo '<thead><tr style="background:#006bff; color:white;">';
echo '<th style="padding:12px 14px; text-align:left;">' . get_string('season_name', 'local_istikama_admin') . '</th>';
echo '<th style="padding:12px 14px; text-align:left;">' . get_string('season_start_date', 'local_istikama_admin') . '</th>';
echo '<th style="padding:12px 14px; text-align:left;">' . get_string('season_end_date', 'local_istikama_admin') . '</th>';
echo '<th style="padding:12px 14px; text-align:left;">' . get_string('season_status', 'local_istikama_admin') . '</th>';
echo '<th style="padding:12px 14px; text-align:right;">' . get_string('actions', 'local_istikama_admin') . '</th>';
echo '</tr></thead><tbody>';

if (empty($seasons)) {
    echo '<tr><td colspan="5" style="padding:32px 14px; text-align:center; color:#64748b;">' .
        get_string('no_seasons_yet', 'local_istikama_admin') . '</td></tr>';
} else {
    $row = 0;
    foreach ($seasons as $s) {
        $row++;
        $bg = $row % 2 === 0 ? '#f8fafc' : 'white';
        $meta = $statuses[$s->status] ?? ['label' => $s->status, 'badge_bg' => '#e2e8f0', 'badge_fg' => '#475569', 'icon' => 'fa-tag'];
        echo '<tr style="background:' . $bg . '; border-bottom:1px solid #e2e8f0;">';
        echo '<td style="padding:12px 14px; font-weight:600;">' . s($s->name);
        if (!empty($s->description)) {
            echo '<div style="font-size:12px; color:#64748b; font-weight:normal; margin-top:2px;">' .
                s(\core_text::substr($s->description, 0, 80)) . '</div>';
        }
        echo '</td>';
        echo '<td style="padding:12px 14px; color:#475569;">' . userdate($s->start_date, get_string('strftimedate', 'langconfig')) . '</td>';
        echo '<td style="padding:12px 14px; color:#475569;">' . userdate($s->end_date, get_string('strftimedate', 'langconfig')) . '</td>';
        echo '<td style="padding:12px 14px;">';
        echo '<span style="display:inline-flex; align-items:center; gap:6px; background:' . $meta['badge_bg'] .
            '; color:' . $meta['badge_fg'] . '; padding:4px 10px; border-radius:12px; font-size:12px; font-weight:600;">';
        echo '<i class="fa ' . $meta['icon'] . '"></i> ' . s($meta['label']);
        echo '</span></td>';
        echo '<td style="padding:12px 14px; text-align:right; white-space:nowrap;">';
        // Action buttons based on status. Pass data via attributes (HTML-safe) — never JSON inside onclick.
        $btn = function($action, $label, $color, $confirm = '') use ($url, $s) {
            $confirmattr = $confirm ? ' onclick="return confirm(this.dataset.confirm)" data-confirm="' . s($confirm) . '"' : '';
            return '<a href="' . $url . '?action=' . $action . '&id=' . $s->id . '&sesskey=' . sesskey() . '"' . $confirmattr .
                ' style="display:inline-block; background:' . $color . '; color:white; padding:5px 12px; border-radius:4px; font-size:12px; margin-left:4px; text-decoration:none;">' .
                $label . '</a>';
        };
        // Edit button: data attributes carry the season data; a single delegated JS handler reads them.
        $editbtn = function($s) {
            return '<button type="button" class="isti-season-edit-btn"'
                . ' data-id="' . (int)$s->id . '"'
                . ' data-name="' . s($s->name) . '"'
                . ' data-desc="' . s($s->description ?? '') . '"'
                . ' data-start="' . (int)$s->start_date . '"'
                . ' data-end="' . (int)$s->end_date . '"'
                . ' data-status="' . s($s->status) . '"'
                . ' style="display:inline-block; background:#0891b2; color:white; padding:5px 12px;'
                . ' border-radius:4px; font-size:12px; margin-left:4px; border:0; cursor:pointer;">'
                . '<i class="fa fa-pencil-alt"></i> ' . get_string('edit') . '</button>';
        };
        switch ($s->status) {
            case season_manager::STATUS_DRAFT:
                echo $editbtn($s);
                echo $btn('upcoming', get_string('mark_upcoming', 'local_istikama_admin'), '#3b82f6');
                if ((int)$s->start_date <= $now) {
                    echo $btn('activate', get_string('activate', 'local_istikama_admin'), '#059669',
                        get_string('confirm_activate', 'local_istikama_admin'));
                }
                echo $btn('delete', get_string('delete'), '#dc2626',
                    get_string('confirm_delete_season', 'local_istikama_admin'));
                break;
            case season_manager::STATUS_UPCOMING:
                echo $editbtn($s);
                if ((int)$s->start_date <= $now) {
                    echo $btn('activate', get_string('activate', 'local_istikama_admin'), '#059669',
                        get_string('confirm_activate', 'local_istikama_admin'));
                }
                echo $btn('delete', get_string('delete'), '#dc2626',
                    get_string('confirm_delete_season', 'local_istikama_admin'));
                break;
            case season_manager::STATUS_ACTIVE:
                echo $editbtn($s);
                echo '<button type="button" class="isti-season-close-btn"'
                    . ' data-id="' . (int)$s->id . '"'
                    . ' data-name="' . s($s->name) . '"'
                    . ' style="display:inline-block; background:#dc2626; color:white;'
                    . ' padding:5px 12px; border-radius:4px; font-size:12px; margin-left:4px; border:0; cursor:pointer;">'
                    . '<i class="fa fa-lock"></i> ' . get_string('close_season', 'local_istikama_admin')
                    . '</button>';
                break;
            case season_manager::STATUS_CLOSED:
                echo $btn('archive', get_string('archive', 'local_istikama_admin'), '#d97706',
                    get_string('confirm_archive', 'local_istikama_admin'));
                echo $btn('reopen', get_string('reopen_season', 'local_istikama_admin'), '#0891b2',
                    get_string('confirm_reopen', 'local_istikama_admin'));
                break;
            case season_manager::STATUS_ARCHIVED:
                echo $btn('restore', get_string('restore_season', 'local_istikama_admin'), '#0891b2',
                    get_string('confirm_restore', 'local_istikama_admin'));
                break;
        }
        echo '</td></tr>';
    }
}
echo '</tbody></table></div>';

// =====================================================================
// Modals (Create / Edit / Close) — all use the same overlay pattern.
// One delegated JS controller wires up all buttons via data-attributes.
// =====================================================================

$formurl    = $url->out(false);
$sk         = sesskey();
$strCreate  = s(get_string('new_season', 'local_istikama_admin'));
$strEdit    = s(get_string('edit_season', 'local_istikama_admin'));
$strClose   = s(get_string('close_season', 'local_istikama_admin'));
$strName    = s(get_string('season_name', 'local_istikama_admin'));
$strDesc    = s(get_string('season_description', 'local_istikama_admin'));
$strStart   = s(get_string('season_start_date', 'local_istikama_admin'));
$strEnd     = s(get_string('season_end_date', 'local_istikama_admin'));
$strSave    = s(get_string('save', 'local_istikama_admin'));
$strCancel  = s(get_string('cancel'));
$strActNote = s(get_string('season_active_edit_note', 'local_istikama_admin'));
$jsActNote  = json_encode(get_string('season_active_edit_note', 'local_istikama_admin'));
$strCloseQ  = s(get_string('confirm_close_q', 'local_istikama_admin'));
$strCloseH  = s(get_string('confirm_close_help', 'local_istikama_admin'));
$strCloseT  = s(get_string('confirm_close_typename', 'local_istikama_admin'));

echo <<<HTML
<style>
  .isti-modal-overlay { display:none; position:fixed; top:0; left:0; right:0; bottom:0;
    background:rgba(15,23,42,0.55); z-index:1050; align-items:center; justify-content:center; padding:16px; }
  .isti-modal-overlay.open { display:flex; }
  .isti-modal-card { background:#fff; border-radius:14px; max-width:580px; width:100%;
    padding:26px; box-shadow:0 20px 60px rgba(0,0,0,0.3); max-height:90vh; overflow:auto; }
  .isti-modal-card h4 { margin:0 0 14px; color:#0f172a; font-size:1.15rem; }
  .isti-modal-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
  .isti-modal-grid .full { grid-column: span 2; }
  .isti-modal-card label { display:block; font-weight:600; font-size:13px; color:#475569; margin-bottom:4px; }
  .isti-modal-card input[type=text], .isti-modal-card input[type=date],
  .isti-modal-card select, .isti-modal-card textarea {
    width:100%; padding:9px 11px; border:1px solid #cbd5e1; border-radius:8px; font-size:14px;
    box-sizing:border-box;
  }
  .isti-modal-actions { display:flex; gap:10px; justify-content:flex-end; margin-top:20px; }
  .isti-modal-btn { border:0; padding:9px 18px; border-radius:8px; cursor:pointer; font-weight:500; font-size:14px; }
  .isti-modal-btn-cancel { background:#e2e8f0; color:#0f172a; }
  .isti-modal-btn-primary { background:#006bff; color:#fff; }
  .isti-modal-btn-danger { background:#dc2626; color:#fff; }
  .isti-modal-btn-info { background:#0891b2; color:#fff; }
  .isti-modal-btn[disabled] { opacity:.5; cursor:not-allowed; }
  .isti-modal-note { background:#fef3c7; border-left:4px solid #f59e0b; color:#78350f;
    padding:10px 12px; border-radius:8px; margin-bottom:14px; font-size:13px; }
</style>

<!-- Hidden data element: passes PHP-land strings to seasons.js -->
<div id="isti-seasons-data" style="display:none" data-act-note="{$strActNote}"></div>

<!-- Create modal -->
<div class="isti-modal-overlay" id="isti-create-modal" style="display:none;">
  <div class="isti-modal-card">
    <h4><i class="fa fa-plus" style="color:#006bff"></i> {$strCreate}</h4>
    <form method="post" action="{$formurl}">
      <input type="hidden" name="action" value="create">
      <input type="hidden" name="sesskey" value="{$sk}">
      <input type="hidden" name="start_date" id="isti-create-start-ts" value="">
      <input type="hidden" name="end_date" id="isti-create-end-ts" value="">
      <div class="isti-modal-grid">
        <div class="full"><label>{$strName} *</label>
          <input type="text" name="name" required maxlength="100" placeholder="2025/2026"></div>
        <div><label>{$strStart} *</label>
          <input type="date" id="isti-create-start" required></div>
        <div><label>{$strEnd} *</label>
          <input type="date" id="isti-create-end" required></div>
        <div class="full"><label>{$strDesc}</label>
          <textarea name="description" rows="2"></textarea></div>
      </div>
      <div class="isti-modal-actions">
        <button type="button" class="isti-modal-btn isti-modal-btn-cancel" data-close-modal>{$strCancel}</button>
        <button type="submit" class="isti-modal-btn isti-modal-btn-primary">{$strSave}</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit modal -->
<div class="isti-modal-overlay" id="isti-edit-modal" style="display:none;">
  <div class="isti-modal-card">
    <h4><i class="fa fa-pencil-alt" style="color:#0891b2"></i> {$strEdit}</h4>
    <div class="isti-modal-note" id="isti-edit-note" style="display:none;"></div>
    <form method="post" action="{$formurl}">
      <input type="hidden" name="action" value="update">
      <input type="hidden" name="sesskey" value="{$sk}">
      <input type="hidden" name="id" id="isti-edit-id">
      <input type="hidden" name="start_date" id="isti-edit-start-ts">
      <input type="hidden" name="end_date" id="isti-edit-end-ts">
      <div class="isti-modal-grid">
        <div class="full"><label>{$strName} *</label>
          <input type="text" name="name" id="isti-edit-name" required maxlength="100"></div>
        <div><label>{$strStart} *</label>
          <input type="date" id="isti-edit-start" required></div>
        <div><label>{$strEnd} *</label>
          <input type="date" id="isti-edit-end" required></div>
        <div class="full"><label>{$strDesc}</label>
          <textarea name="description" id="isti-edit-desc" rows="2"></textarea></div>
      </div>
      <div class="isti-modal-actions">
        <button type="button" class="isti-modal-btn isti-modal-btn-cancel" data-close-modal>{$strCancel}</button>
        <button type="submit" class="isti-modal-btn isti-modal-btn-info">{$strSave}</button>
      </div>
    </form>
  </div>
</div>

<!-- Close modal -->
<div class="isti-modal-overlay" id="isti-close-modal" style="display:none;">
  <div class="isti-modal-card" style="max-width:480px;">
    <h4 style="color:#dc2626;"><i class="fa fa-exclamation-triangle"></i> {$strCloseQ}</h4>
    <p style="color:#475569; font-size:14px; margin-bottom:14px;">{$strCloseH}</p>
    <p style="color:#475569; font-size:13px; margin-bottom:8px;">
      {$strCloseT} <strong id="isti-close-name" style="color:#0f172a;"></strong>:
    </p>
    <form method="post" action="{$formurl}">
      <input type="hidden" name="action" value="close">
      <input type="hidden" name="sesskey" value="{$sk}">
      <input type="hidden" name="id" id="isti-close-id">
      <input type="text" name="confirmtext" id="isti-close-input" autocomplete="off">
      <div class="isti-modal-actions">
        <button type="button" class="isti-modal-btn isti-modal-btn-cancel" data-close-modal>{$strCancel}</button>
        <button type="submit" class="isti-modal-btn isti-modal-btn-danger" id="isti-close-submit" disabled>{$strClose}</button>
      </div>
    </form>
  </div>
</div>

HTML;

local_istikama_admin_print_footer();
