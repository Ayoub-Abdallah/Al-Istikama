<?php
// This file is part of Moodle - http://moodle.org/

require_once('../../config.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_full_admin();

$action = optional_param('action', '', PARAM_ALPHA);
$id = optional_param('id', 0, PARAM_INT);

$url = new moodle_url('/local/istikama_admin/levels.php');
local_istikama_admin_setup_page($PAGE, $url, get_string('manage_levels', 'local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

$tiers = [
    'primary' => get_string('tier_primary', 'local_istikama_admin'),
    'middle'  => get_string('tier_middle', 'local_istikama_admin'),
    'high'    => get_string('tier_high', 'local_istikama_admin'),
];

// ---------------------------------------------------------------------------
// Action handlers.
// ---------------------------------------------------------------------------
if ($action && confirm_sesskey()) {
    try {
        switch ($action) {
            case 'create': {
                $name  = required_param('name', PARAM_TEXT);
                $tier  = required_param('tier', PARAM_ALPHA);
                if (!isset($tiers[$tier])) {
                    throw new \moodle_exception('invalid_tier', 'local_istikama_admin');
                }
                if (trim($name) === '') {
                    throw new \moodle_exception('level_name_required', 'local_istikama_admin');
                }
                $maxorder = (int)$DB->get_field_sql(
                    "SELECT COALESCE(MAX(order_index), 0) FROM {istikama_global_level} WHERE tier = ?",
                    [$tier]
                );
                $now = time();
                $DB->insert_record('istikama_global_level', (object)[
                    'name'         => trim($name),
                    'tier'         => $tier,
                    'order_index'  => $maxorder + 1,
                    'timecreated'  => $now,
                    'timemodified' => $now,
                ]);
                redirect($url, get_string('level_created', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
            case 'rename': {
                $name = required_param('name', PARAM_TEXT);
                $rec = $DB->get_record('istikama_global_level', ['id' => $id], '*', MUST_EXIST);
                $rec->name = trim($name);
                $rec->timemodified = time();
                $DB->update_record('istikama_global_level', $rec);
                redirect($url, get_string('level_renamed', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
            case 'move': {
                // Move up/down within its tier.
                $direction = required_param('dir', PARAM_ALPHA); // 'up' or 'down'
                $level = $DB->get_record('istikama_global_level', ['id' => $id], '*', MUST_EXIST);
                $op = $direction === 'up' ? '<' : '>';
                $sort = $direction === 'up' ? 'DESC' : 'ASC';
                $neighbour = $DB->get_record_sql(
                    "SELECT * FROM {istikama_global_level} WHERE tier = ? AND order_index $op ? ORDER BY order_index $sort",
                    [$level->tier, $level->order_index],
                    IGNORE_MULTIPLE
                );
                if ($neighbour) {
                    $a = $level->order_index;
                    $b = $neighbour->order_index;
                    $DB->set_field('istikama_global_level', 'order_index', $b, ['id' => $level->id]);
                    $DB->set_field('istikama_global_level', 'order_index', $a, ['id' => $neighbour->id]);
                    $DB->set_field('istikama_global_level', 'timemodified', time(), ['id' => $level->id]);
                    $DB->set_field('istikama_global_level', 'timemodified', time(), ['id' => $neighbour->id]);
                }
                redirect($url, get_string('level_reordered', 'local_istikama_admin'), 1,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
            case 'delete': {
                // Refuse if any school uses this level or if subjects/categories reference it.
                if ($DB->record_exists('istikama_subject_names', ['level_id' => $id])) {
                    throw new \moodle_exception('level_delete_has_subjects', 'local_istikama_admin');
                }
                if ($DB->record_exists('istikama_level_info', ['global_level_id' => $id])) {
                    throw new \moodle_exception('level_delete_has_categories', 'local_istikama_admin');
                }
                $DB->delete_records('istikama_school_level', ['global_level_id' => $id]);
                $DB->delete_records('istikama_global_level', ['id' => $id]);
                redirect($url, get_string('level_deleted', 'local_istikama_admin'), 2,
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
require(__DIR__ . '/admin_layout.php');

// Pull all levels grouped by tier.
$levels = $DB->get_records('istikama_global_level', null, 'tier ASC, order_index ASC');
$bytier = ['primary' => [], 'middle' => [], 'high' => []];
foreach ($levels as $l) {
    $bytier[$l->tier ?? 'primary'][] = $l;
}

echo '<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">';
echo '<div>';
echo '<h3 style="margin:0; color:#1e293b;">' . get_string('global_levels', 'local_istikama_admin') . '</h3>';
echo '<p style="margin:4px 0 0; color:#64748b; font-size:13px;">' . get_string('global_levels_help', 'local_istikama_admin') . '</p>';
echo '</div>';
echo '<button type="button" class="btn" style="background:#006bff; color:white; padding:8px 18px; border-radius:6px; border:0;" onclick="document.getElementById(\'isti-level-create\').style.display=\'block\'">';
echo '<i class="fa fa-plus"></i> ' . get_string('new_level', 'local_istikama_admin');
echo '</button>';
echo '</div>';

// Create form.
echo '<div id="isti-level-create" style="display:none; background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:20px; margin-bottom:20px;">';
echo '<form method="post" action="' . $url . '">';
echo '<input type="hidden" name="action" value="create">';
echo '<input type="hidden" name="sesskey" value="' . sesskey() . '">';
echo '<div style="display:grid; grid-template-columns:2fr 1fr auto; gap:12px; align-items:end;">';
echo '<div><label style="display:block; font-weight:600; font-size:13px; color:#475569;">' .
    get_string('level_name', 'local_istikama_admin') . ' *</label>';
echo '<input type="text" name="name" required placeholder="Primary 1, Year 7, Form 5..." style="width:100%; padding:8px 10px; border:1px solid #cbd5e1; border-radius:4px;"></div>';
echo '<div><label style="display:block; font-weight:600; font-size:13px; color:#475569;">' .
    get_string('level_tier', 'local_istikama_admin') . ' *</label>';
echo '<select name="tier" style="width:100%; padding:8px 10px; border:1px solid #cbd5e1; border-radius:4px;">';
foreach ($tiers as $key => $label) {
    echo '<option value="' . $key . '">' . s($label) . '</option>';
}
echo '</select></div>';
echo '<div style="display:flex; gap:8px;"><button type="button" class="btn btn-secondary" onclick="document.getElementById(\'isti-level-create\').style.display=\'none\'">' .
    get_string('cancel') . '</button>';
echo '<button type="submit" class="btn" style="background:#006bff; color:white; border:0; padding:8px 20px; border-radius:6px;">' .
    get_string('save', 'local_istikama_admin') . '</button></div>';
echo '</div>';
echo '</form>';
echo '</div>';

// Render each tier section.
$tiercolors = [
    'primary' => ['#dcfce7', '#166534'],
    'middle'  => ['#dbeafe', '#1e40af'],
    'high'    => ['#fef3c7', '#92400e'],
];
foreach ($tiers as $tkey => $tlabel) {
    [$bg, $fg] = $tiercolors[$tkey];
    echo '<div style="margin-bottom:24px;">';
    echo '<div style="display:flex; align-items:center; gap:10px; margin-bottom:10px;">';
    echo '<span style="background:' . $bg . '; color:' . $fg . '; padding:4px 12px; border-radius:14px; font-weight:600; font-size:13px;">' . s($tlabel) . '</span>';
    echo '<span style="color:#64748b; font-size:12px;">' . count($bytier[$tkey]) . ' ' . get_string('levels', 'local_istikama_admin') . '</span>';
    echo '</div>';
    echo '<div style="background:white; border:1px solid #e2e8f0; border-radius:8px; overflow:hidden;">';
    if (empty($bytier[$tkey])) {
        echo '<div style="padding:24px; text-align:center; color:#94a3b8; font-style:italic;">' . get_string('no_levels_in_tier', 'local_istikama_admin') . '</div>';
    } else {
        echo '<table style="width:100%; border-collapse:collapse;" data-isti-level-tier="' . s($tkey) . '">';
        echo '<tbody class="isti-level-rows">';
        $total = count($bytier[$tkey]);
        foreach ($bytier[$tkey] as $idx => $l) {
            $rowbg = $idx % 2 === 0 ? 'white' : '#f8fafc';
            echo '<tr draggable="true" data-isti-level-id="' . $l->id . '" style="background:' . $rowbg . '; border-bottom:1px solid #e2e8f0; cursor:move;">';
            echo '<td style="padding:10px 14px; width:36px; color:#94a3b8; text-align:center;"><i class="fa fa-grip-vertical"></i></td>';
            echo '<td style="padding:10px 14px; width:36px; color:#94a3b8; font-family:monospace; text-align:center;" class="isti-level-order">' . ($idx + 1) . '</td>';
            echo '<td style="padding:10px 14px; font-weight:500;">' . s($l->name) . '</td>';
            echo '<td style="padding:10px 14px; text-align:right; white-space:nowrap;">';
            if ($idx > 0) {
                echo '<a href="' . $url . '?action=move&id=' . $l->id . '&dir=up&sesskey=' . sesskey() .
                    '" style="background:#e2e8f0; color:#475569; padding:4px 8px; border-radius:4px; text-decoration:none; margin-left:4px;" title="' . get_string('move_up', 'local_istikama_admin') . '"><i class="fa fa-arrow-up"></i></a>';
            }
            if ($idx < $total - 1) {
                echo '<a href="' . $url . '?action=move&id=' . $l->id . '&dir=down&sesskey=' . sesskey() .
                    '" style="background:#e2e8f0; color:#475569; padding:4px 8px; border-radius:4px; text-decoration:none; margin-left:4px;" title="' . get_string('move_down', 'local_istikama_admin') . '"><i class="fa fa-arrow-down"></i></a>';
            }
            echo '<a href="' . $url . '?action=delete&id=' . $l->id . '&sesskey=' . sesskey() .
                '" onclick="return confirm(\'' . addslashes(get_string('confirm_delete_level', 'local_istikama_admin')) . '\')" style="background:#fee2e2; color:#991b1b; padding:4px 10px; border-radius:4px; text-decoration:none; margin-left:4px;"><i class="fa fa-trash"></i></a>';
            echo '</td></tr>';
        }
        echo '</tbody></table>';
    }
    echo '</div></div>';
}

// ── Drag-and-drop reorder (HTML5 native; no AMD module required) ────────────
$reorderurl = (new moodle_url('/local/istikama_admin/level_reorder.php'))->out(false);
$sesskey = sesskey();
$savedstr = addslashes(get_string('level_reordered', 'local_istikama_admin'));
$failstr  = addslashes(get_string('level_reorder_failed', 'local_istikama_admin'));
echo <<<HTML
<div id="isti-reorder-toast" style="display:none; position:fixed; bottom:24px; right:24px; background:#1e293b; color:white; padding:10px 18px; border-radius:6px; font-size:13px; z-index:9999;"></div>
<script>
(function(){
  var dragged = null;
  function toast(msg, ok){
    var t = document.getElementById('isti-reorder-toast');
    if (!t) return;
    t.textContent = msg;
    t.style.background = ok ? '#059669' : '#dc2626';
    t.style.display = 'block';
    setTimeout(function(){ t.style.display='none'; }, 2200);
  }
  document.querySelectorAll('table[data-isti-level-tier] tbody.isti-level-rows tr').forEach(function(row){
    row.addEventListener('dragstart', function(e){
      dragged = row;
      row.style.opacity = '0.4';
      e.dataTransfer.effectAllowed = 'move';
    });
    row.addEventListener('dragend', function(){
      if (dragged) dragged.style.opacity = '1';
      dragged = null;
    });
    row.addEventListener('dragover', function(e){
      e.preventDefault();
      e.dataTransfer.dropEffect = 'move';
    });
    row.addEventListener('drop', function(e){
      e.preventDefault();
      if (!dragged || dragged === row) return;
      var table = row.closest('table[data-isti-level-tier]');
      var draggedTable = dragged.closest('table[data-isti-level-tier]');
      if (table !== draggedTable) {
        toast('{$failstr}: cross-tier drag not allowed', false);
        return;
      }
      var tbody = row.parentNode;
      var rect = row.getBoundingClientRect();
      var insertBefore = (e.clientY - rect.top) < rect.height / 2;
      tbody.insertBefore(dragged, insertBefore ? row : row.nextSibling);
      // Renumber visible order labels.
      Array.from(tbody.querySelectorAll('tr')).forEach(function(r, i){
        var lbl = r.querySelector('.isti-level-order');
        if (lbl) lbl.textContent = (i+1);
      });
      // POST new order to the endpoint.
      var tier = table.getAttribute('data-isti-level-tier');
      var ids = Array.from(tbody.querySelectorAll('tr')).map(function(r){
        return r.getAttribute('data-isti-level-id');
      });
      var fd = new FormData();
      fd.append('sesskey', '{$sesskey}');
      fd.append('tier', tier);
      fd.append('ids', ids.join(','));
      fetch('{$reorderurl}', { method: 'POST', body: fd, credentials: 'same-origin' })
        .then(function(r){ return r.json().catch(function(){ return {ok:false, error:'parse'}; }); })
        .then(function(j){
          if (j && j.ok) toast('{$savedstr}', true);
          else toast('{$failstr}: ' + (j && j.error ? j.error : 'unknown'), false);
        }).catch(function(err){
          toast('{$failstr}: ' + err, false);
        });
    });
  });
})();
</script>
HTML;


local_istikama_admin_print_footer();
