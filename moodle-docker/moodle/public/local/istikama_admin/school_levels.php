<?php
// This file is part of Moodle - http://moodle.org/
//
// Central hub for:
//  • Managing ALL global academic levels (create, rename, reorder, delete)
//  • Toggling which levels are enabled for a specific school

require_once('../../config.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_full_admin();

$schoolid = required_param('schoolid', PARAM_INT);
$action   = optional_param('action',          '', PARAM_ALPHA);
$id       = optional_param('id',               0, PARAM_INT);
$globalid = optional_param('global_level_id',  0, PARAM_INT);

$url = new moodle_url('/local/istikama_admin/school_levels.php', ['schoolid' => $schoolid]);
local_istikama_admin_setup_page($PAGE, $url, get_string('manage_school_levels', 'local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

$school = $DB->get_record('course_categories', ['id' => $schoolid], 'id, name', MUST_EXIST);

$tiers = [
    'primary' => get_string('tier_primary', 'local_istikama_admin'),
    'middle'  => get_string('tier_middle',  'local_istikama_admin'),
    'high'    => get_string('tier_high',    'local_istikama_admin'),
];

// ---------------------------------------------------------------------------
// Action handlers
// ---------------------------------------------------------------------------
if ($action && confirm_sesskey()) {
    try {
        switch ($action) {

            // ── Create global level ────────────────────────────────────────
            case 'create': {
                $name = required_param('name', PARAM_TEXT);
                $tier = required_param('tier', PARAM_ALPHA);
                if (!isset($tiers[$tier])) {
                    throw new \moodle_exception('invalid_tier', 'local_istikama_admin');
                }
                $name = trim($name);
                if ($name === '') {
                    throw new \moodle_exception('level_name_required', 'local_istikama_admin');
                }
                $maxorder = (int)$DB->get_field_sql(
                    "SELECT COALESCE(MAX(order_index), 0) FROM {istikama_global_level} WHERE tier = ?",
                    [$tier]
                );
                $now   = time();
                $newid = $DB->insert_record('istikama_global_level', (object)[
                    'name'         => $name,
                    'tier'         => $tier,
                    'order_index'  => $maxorder + 1,
                    'timecreated'  => $now,
                    'timemodified' => $now,
                ]);
                // Auto-enable for this school.
                $DB->insert_record('istikama_school_level', (object)[
                    'schoolid'        => $schoolid,
                    'global_level_id' => $newid,
                    'enabled'         => 1,
                    'timecreated'     => $now,
                    'timemodified'    => $now,
                ]);
                redirect($url, get_string('level_created', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }

            // ── Rename global level ────────────────────────────────────────
            case 'rename': {
                $name = trim(required_param('name', PARAM_TEXT));
                if ($name === '') {
                    throw new \moodle_exception('level_name_required', 'local_istikama_admin');
                }
                $rec = $DB->get_record('istikama_global_level', ['id' => $id], '*', MUST_EXIST);
                $rec->name        = $name;
                $rec->timemodified = time();
                $DB->update_record('istikama_global_level', $rec);
                redirect($url, get_string('level_renamed', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }

            // ── Move up / down within tier ────────────────────────────────
            case 'move': {
                $dir   = required_param('dir', PARAM_ALPHA);
                $level = $DB->get_record('istikama_global_level', ['id' => $id], '*', MUST_EXIST);
                $op    = $dir === 'up' ? '<' : '>';
                $sort  = $dir === 'up' ? 'DESC' : 'ASC';
                $nbr   = $DB->get_record_sql(
                    "SELECT * FROM {istikama_global_level}
                      WHERE tier = ? AND order_index $op ?
                      ORDER BY order_index $sort",
                    [$level->tier, $level->order_index],
                    IGNORE_MULTIPLE
                );
                if ($nbr) {
                    $now = time();
                    $DB->set_field('istikama_global_level', 'order_index',  $nbr->order_index, ['id' => $level->id]);
                    $DB->set_field('istikama_global_level', 'order_index',  $level->order_index, ['id' => $nbr->id]);
                    $DB->set_field('istikama_global_level', 'timemodified', $now, ['id' => $level->id]);
                    $DB->set_field('istikama_global_level', 'timemodified', $now, ['id' => $nbr->id]);
                }
                redirect($url, get_string('level_reordered', 'local_istikama_admin'), 1,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }

            // ── Delete global level (protected) ───────────────────────────
            case 'delete': {
                // Block ONLY if a school has physically added this level as a
                // course_category (recorded in istikama_level_info). That data
                // can't be orphaned safely.
                if ($DB->record_exists('istikama_level_info', ['global_level_id' => $id])) {
                    throw new \moodle_exception('level_delete_has_categories', 'local_istikama_admin', $url->out(false));
                }
                // istikama_school_level rows are just toggle/assignment records —
                // safe to cascade-delete when the global level is removed.
                $DB->delete_records('istikama_school_level', ['global_level_id' => $id]);
                $DB->delete_records('istikama_global_level', ['id' => $id]);
                redirect($url, get_string('level_deleted', 'local_istikama_admin'), 2,
                    \core\output\notification::NOTIFY_SUCCESS);
                break;
            }

            // ── Toggle school assignment ───────────────────────────────────
            case 'enable':
            case 'disable': {
                $lid = $globalid ?: $id;
                if (!$lid) break;
                $enabled = ($action === 'enable') ? 1 : 0;
                $now     = time();
                $row     = $DB->get_record('istikama_school_level',
                    ['schoolid' => $schoolid, 'global_level_id' => $lid]);
                if ($row) {
                    $row->enabled      = $enabled;
                    $row->timemodified = $now;
                    $DB->update_record('istikama_school_level', $row);
                } else {
                    $DB->insert_record('istikama_school_level', (object)[
                        'schoolid'        => $schoolid,
                        'global_level_id' => $lid,
                        'enabled'         => $enabled,
                        'timecreated'     => $now,
                        'timemodified'    => $now,
                    ]);
                }
                $msg = $enabled
                    ? get_string('school_level_toggled_on',  'local_istikama_admin')
                    : get_string('school_level_toggled_off', 'local_istikama_admin');
                redirect($url, $msg, 1, \core\output\notification::NOTIFY_SUCCESS);
                break;
            }
        }
    } catch (\Throwable $e) {
        redirect($url, $e->getMessage(), 4, \core\output\notification::NOTIFY_ERROR);
    }
}

// ---------------------------------------------------------------------------
// Data
// ---------------------------------------------------------------------------
$levels       = $DB->get_records('istikama_global_level', null, 'tier ASC, order_index ASC');
$schoolmaps   = $DB->get_records('istikama_school_level', ['schoolid' => $schoolid], '',
    'global_level_id, enabled');

$bytier = ['primary' => [], 'middle' => [], 'high' => []];
foreach ($levels as $l) {
    $bytier[$l->tier ?? 'primary'][] = $l;
}

$tiercolors = [
    'primary' => ['bg' => '#ecfdf5', 'fg' => '#065f46', 'dot' => '#10b981'],
    'middle'  => ['bg' => '#eff6ff', 'fg' => '#1e40af', 'dot' => '#3b82f6'],
    'high'    => ['bg' => '#fefce8', 'fg' => '#854d0e', 'dot' => '#eab308'],
];

// ---------------------------------------------------------------------------
// Render
// ---------------------------------------------------------------------------
// Suppress the h1 that admin_layout.php prints — we render our own header.
$isti_hide_page_header = true;
require(__DIR__ . '/admin_layout.php');

$schoolsurl   = (new moodle_url('/local/istikama_admin/schools.php'))->out(false);
$reorderurl   = (new moodle_url('/local/istikama_admin/level_reorder.php'))->out(false);
$sk           = sesskey();
$savedstr     = addslashes(get_string('level_reordered',      'local_istikama_admin'));
$failstr      = addslashes(get_string('level_reorder_failed', 'local_istikama_admin'));
$confirmstr   = addslashes(get_string('confirm_delete_level', 'local_istikama_admin'));
$schoolname   = s(format_string($school->name));

// Tier totals for the sub-pills.
$tiercounts = array_map('count', $bytier);

// No extra wrapper — content sits directly inside isti-card-modern from admin_layout.php.
?>

<!-- ── Header bar ──────────────────────────────────────────────────────── -->
<div style="
    display: flex;
    align-items: center;
    gap: 14px;
    margin: -24px -24px 20px;
    padding: 20px 24px 18px;
    border-bottom: 1px solid #f1f5f9;
    flex-wrap: wrap;
    background: #fff;
">
        <!-- Back arrow — tight, right next to the title -->
        <a href="<?php echo $schoolsurl; ?>"
           style="
               display: inline-flex;
               align-items: center;
               justify-content: center;
               width: 34px; height: 34px;
               background: #f1f5f9;
               border-radius: 8px;
               color: #475569;
               text-decoration: none;
               flex-shrink: 0;
               transition: background .15s;
           "
           onmouseover="this.style.background='#e2e8f0'"
           onmouseout="this.style.background='#f1f5f9'"
           title="<?php echo get_string('manage_schools', 'local_istikama_admin'); ?>"
        ><i class="fa fa-arrow-left" style="font-size: 13px;"></i></a>

        <!-- Title + subtitle -->
        <div style="flex: 1; min-width: 0;">
            <div style="display:flex; align-items:baseline; gap:10px; flex-wrap:wrap;">
                <h2 style="margin:0; font-size:1.15rem; font-weight:700; color:#0f172a; white-space:nowrap;">
                    <?php echo get_string('manage_school_levels', 'local_istikama_admin'); ?>
                </h2>
                <span style="font-size:.85rem; color:#64748b; font-weight:400;">
                    <?php echo $schoolname; ?>
                </span>
            </div>
            <p style="margin:3px 0 0; font-size:12px; color:#94a3b8; line-height:1.4;">
                <?php echo get_string('school_level_help', 'local_istikama_admin'); ?>
            </p>
        </div>

        <!-- Tier pills (counts) -->
        <div style="display:flex; gap:6px; align-items:center; flex-wrap:wrap;">
            <?php foreach ($tiers as $tk => $tl): ?>
                <?php $c = $tiercolors[$tk]; ?>
                <span style="
                    background: <?php echo $c['bg']; ?>;
                    color: <?php echo $c['fg']; ?>;
                    padding: 3px 10px 3px 8px;
                    border-radius: 20px;
                    font-size: 11px;
                    font-weight: 700;
                    display: inline-flex;
                    align-items: center;
                    gap: 5px;
                ">
                    <span style="
                        width:7px; height:7px;
                        border-radius:50%;
                        background:<?php echo $c['dot']; ?>;
                        display:inline-block;
                    "></span>
                    <?php echo s($tl); ?> · <?php echo $tiercounts[$tk]; ?>
                </span>
            <?php endforeach; ?>
        </div>

        <!-- New Level button -->
        <button
            id="btn-open-new-level"
            type="button"
            style="
                display: inline-flex;
                align-items: center;
                gap: 6px;
                background: #2563eb;
                color: white;
                border: 0;
                padding: 8px 16px;
                border-radius: 8px;
                font-size: 13px;
                font-weight: 600;
                cursor: pointer;
                white-space: nowrap;
                flex-shrink: 0;
            "
        >
            <i class="fa fa-plus"></i>
            <?php echo get_string('new_level', 'local_istikama_admin'); ?>
        </button>
    </div>

<!-- ── Level rows (one section per tier) ──────────────────────────────── -->
<div style="margin: 0 -24px;">

        <?php if (empty($levels)): ?>
        <div style="padding: 40px 24px; text-align:center; color:#94a3b8;">
            <i class="fa fa-layer-group" style="font-size:2.5rem; display:block; margin-bottom:12px; color:#cbd5e1;"></i>
            <p style="margin:0; font-size:14px;"><?php echo get_string('no_levels_defined', 'local_istikama_admin'); ?></p>
        </div>
        <?php else: ?>

        <?php foreach ($tiers as $tkey => $tlabel):
            $c          = $tiercolors[$tkey];
            $tierlevels = $bytier[$tkey];
            $total      = count($tierlevels);
        ?>

        <!-- Tier section -->
        <div>
            <!-- Tier divider label -->
            <div style="
                padding: 8px 24px;
                background: <?php echo $c['bg']; ?>;
                border-top: 1px solid #f1f5f9;
                display: flex;
                align-items: center;
                gap: 8px;
            ">
                <span style="
                    width: 8px; height: 8px;
                    border-radius: 50%;
                    background: <?php echo $c['dot']; ?>;
                    display: inline-block;
                "></span>
                <span style="font-size: 11px; font-weight: 700; color: <?php echo $c['fg']; ?>; text-transform: uppercase; letter-spacing: .6px;">
                    <?php echo s($tlabel); ?>
                </span>
                <span style="font-size: 11px; color: <?php echo $c['fg']; ?>; opacity:.6;">
                    (<?php echo $total; ?>)
                </span>
            </div>

            <?php if ($total === 0): ?>
            <div style="padding: 18px 24px; text-align:center; color:#cbd5e1; font-size:13px; font-style:italic;">
                <?php echo get_string('no_levels_in_tier', 'local_istikama_admin'); ?>
            </div>
            <?php else: ?>

            <table style="width:100%; border-collapse:collapse;"
                   data-isti-level-tier="<?php echo s($tkey); ?>">
                <tbody class="isti-level-rows">
                <?php foreach ($tierlevels as $idx => $l):
                    $mapping = $schoolmaps[$l->id] ?? null;
                    $enabled = $mapping ? (int)$mapping->enabled : 1;
                    $rowbg   = $idx % 2 === 0 ? '#fff' : '#fafafa';
                    $delurl  = $url . '&action=delete&id=' . $l->id . '&sesskey=' . $sk;
                    $upurl   = $url . '&action=move&id=' . $l->id . '&dir=up&sesskey=' . $sk;
                    $dnurl   = $url . '&action=move&id=' . $l->id . '&dir=down&sesskey=' . $sk;
                    $enurl   = $url . '&action=enable&global_level_id='  . $l->id . '&sesskey=' . $sk;
                    $disurl  = $url . '&action=disable&global_level_id=' . $l->id . '&sesskey=' . $sk;
                ?>
                <tr draggable="true"
                    data-isti-level-id="<?php echo $l->id; ?>"
                    style="
                        background: <?php echo $rowbg; ?>;
                        border-bottom: 1px solid #f1f5f9;
                        cursor: default;
                        transition: background .1s;
                    "
                    onmouseover="this.style.background='#f8fafc'"
                    onmouseout="this.style.background='<?php echo $rowbg; ?>'"
                >
                    <!-- Drag handle -->
                    <td style="padding:11px 8px 11px 20px; width:20px; color:#d1d5db; cursor:grab;"
                        class="isti-drag-handle">
                        <i class="fa fa-grip-vertical"></i>
                    </td>

                    <!-- Order index -->
                    <td style="padding:11px 10px; width:28px; color:#cbd5e1; font-family:monospace; font-size:11px; text-align:center;"
                        class="isti-level-order"><?php echo $idx + 1; ?></td>

                    <!-- Name + inline rename form -->
                    <td style="padding:11px 14px; font-weight:500; color:#1e293b;">
                        <span class="isti-level-name-display"
                              title="<?php echo addslashes(get_string('click_to_rename', 'local_istikama_admin')); ?>"
                              style="cursor:text;"
                        ><?php echo s($l->name); ?></span>

                        <form class="isti-rename-form" method="post" action="<?php echo $url; ?>"
                              style="display:none; margin:0;">
                            <input type="hidden" name="action"  value="rename">
                            <input type="hidden" name="id"      value="<?php echo $l->id; ?>">
                            <input type="hidden" name="sesskey" value="<?php echo $sk; ?>">
                            <div style="display:flex; gap:5px; align-items:center;">
                                <input type="text" name="name" value="<?php echo s($l->name); ?>" required
                                       style="
                                           flex:1; padding:5px 9px;
                                           border:1.5px solid #3b82f6;
                                           border-radius:5px;
                                           font-size:13px;
                                           outline:none;
                                           min-width:100px;
                                       ">
                                <button type="submit"
                                        style="background:#059669; color:white; border:0; padding:5px 9px; border-radius:5px; cursor:pointer;">
                                    <i class="fa fa-check"></i>
                                </button>
                                <button type="button" class="isti-cancel-rename"
                                        style="background:#f1f5f9; color:#475569; border:0; padding:5px 9px; border-radius:5px; cursor:pointer;">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        </form>
                    </td>

                    <!-- School toggle -->
                    <td style="padding:11px 14px; width:110px; text-align:center;">
                        <?php if ($enabled): ?>
                        <a href="<?php echo $disurl; ?>"
                           title="Click to disable for this school"
                           style="
                               display:inline-flex; align-items:center; gap:4px;
                               background:#d1fae5; color:#065f46;
                               padding:3px 10px; border-radius:20px;
                               font-size:11px; font-weight:700;
                               text-decoration:none;
                               transition:background .15s;
                           "
                           onmouseover="this.style.background='#a7f3d0'"
                           onmouseout="this.style.background='#d1fae5'"
                        ><i class="fa fa-check-circle"></i> <?php echo get_string('school_level_enabled', 'local_istikama_admin'); ?></a>
                        <?php else: ?>
                        <a href="<?php echo $enurl; ?>"
                           title="Click to enable for this school"
                           style="
                               display:inline-flex; align-items:center; gap:4px;
                               background:#fee2e2; color:#991b1b;
                               padding:3px 10px; border-radius:20px;
                               font-size:11px; font-weight:700;
                               text-decoration:none;
                               transition:background .15s;
                           "
                           onmouseover="this.style.background='#fecaca'"
                           onmouseout="this.style.background='#fee2e2'"
                        ><i class="fa fa-ban"></i> <?php echo get_string('school_level_disabled', 'local_istikama_admin'); ?></a>
                        <?php endif; ?>
                    </td>

                    <!-- Up / Down -->
                    <td style="padding:11px 6px; width:68px; text-align:center; white-space:nowrap;">
                        <?php if ($idx > 0): ?>
                        <a href="<?php echo $upurl; ?>"
                           style="
                               display:inline-flex; align-items:center; justify-content:center;
                               width:26px; height:26px;
                               background:#f1f5f9; color:#475569;
                               border-radius:5px; text-decoration:none;
                               font-size:11px;
                               transition:background .15s;
                           "
                           onmouseover="this.style.background='#e2e8f0'"
                           onmouseout="this.style.background='#f1f5f9'"
                           title="<?php echo addslashes(get_string('move_up', 'local_istikama_admin')); ?>"
                        ><i class="fa fa-arrow-up"></i></a>
                        <?php else: ?>
                        <span style="display:inline-block; width:26px;"></span>
                        <?php endif; ?>

                        <?php if ($idx < $total - 1): ?>
                        <a href="<?php echo $dnurl; ?>"
                           style="
                               display:inline-flex; align-items:center; justify-content:center;
                               width:26px; height:26px;
                               background:#f1f5f9; color:#475569;
                               border-radius:5px; text-decoration:none;
                               font-size:11px;
                               margin-left:2px;
                               transition:background .15s;
                           "
                           onmouseover="this.style.background='#e2e8f0'"
                           onmouseout="this.style.background='#f1f5f9'"
                           title="<?php echo addslashes(get_string('move_down', 'local_istikama_admin')); ?>"
                        ><i class="fa fa-arrow-down"></i></a>
                        <?php else: ?>
                        <span style="display:inline-block; width:26px; margin-left:2px;"></span>
                        <?php endif; ?>
                    </td>

                    <!-- Edit / Delete -->
                    <td style="padding:11px 20px 11px 6px; width:68px; text-align:right; white-space:nowrap;">
                        <!-- Pencil / rename -->
                        <button type="button"
                                class="isti-edit-level"
                                data-levelid="<?php echo $l->id; ?>"
                                title="<?php echo addslashes(get_string('edit', 'local_istikama_admin')); ?>"
                                style="
                                    display:inline-flex; align-items:center; justify-content:center;
                                    width:28px; height:28px;
                                    background:#eff6ff; color:#2563eb;
                                    border:0; border-radius:6px;
                                    cursor:pointer;
                                    font-size:12px;
                                    transition:background .15s;
                                "
                                onmouseover="this.style.background='#dbeafe'"
                                onmouseout="this.style.background='#eff6ff'"
                        ><i class="fa fa-pencil"></i></button>

                        <!-- Trash / delete -->
                        <a href="<?php echo $delurl; ?>"
                           onclick="return confirm('<?php echo $confirmstr; ?>')"
                           title="<?php echo addslashes(get_string('delete', 'local_istikama_admin')); ?>"
                           style="
                               display:inline-flex; align-items:center; justify-content:center;
                               width:28px; height:28px;
                               background:#fff1f2; color:#e11d48;
                               border-radius:6px;
                               text-decoration:none;
                               font-size:12px;
                               margin-left:3px;
                               transition:background .15s;
                           "
                           onmouseover="this.style.background='#ffe4e6'"
                           onmouseout="this.style.background='#fff1f2'"
                        ><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <?php endif; // end $total === 0 check ?>
        </div><!-- /tier section -->

        <?php endforeach; ?>

        <?php endif; // end empty($levels) ?>

</div><!-- /level rows -->


<!-- ═══════════════════════════════════════════════════════════════════════
     NEW LEVEL MODAL
════════════════════════════════════════════════════════════════════════ -->
<div id="isti-new-level-overlay"
     style="
         display:none;
         position:fixed; inset:0; z-index:2000;
         background:rgba(15,23,42,.45);
         backdrop-filter:blur(2px);
         align-items:center;
         justify-content:center;
     "
>
    <div style="
        background:white;
        border-radius:14px;
        box-shadow:0 20px 60px rgba(0,0,0,.18);
        width:100%;
        max-width:460px;
        margin:20px;
        overflow:hidden;
    ">
        <!-- Modal header -->
        <div style="
            display:flex;
            align-items:center;
            justify-content:space-between;
            padding:18px 22px 16px;
            border-bottom:1px solid #f1f5f9;
        ">
            <div style="display:flex; align-items:center; gap:10px;">
                <span style="
                    width:34px; height:34px;
                    background:#eff6ff;
                    border-radius:8px;
                    display:inline-flex;
                    align-items:center;
                    justify-content:center;
                    color:#2563eb;
                "><i class="fa fa-layer-group"></i></span>
                <div>
                    <div style="font-weight:700; font-size:.95rem; color:#0f172a;">
                        <?php echo get_string('new_level', 'local_istikama_admin'); ?>
                    </div>
                    <div style="font-size:11px; color:#94a3b8;">
                        <?php echo $schoolname; ?>
                    </div>
                </div>
            </div>
            <button id="btn-close-new-level" type="button"
                    style="
                        background:none; border:0;
                        font-size:18px; color:#94a3b8;
                        cursor:pointer; line-height:1;
                        padding:4px;
                    "
                    onmouseover="this.style.color='#475569'"
                    onmouseout="this.style.color='#94a3b8'"
            >&times;</button>
        </div>

        <!-- Modal body -->
        <form id="form-new-level" method="post" action="<?php echo $url; ?>">
            <input type="hidden" name="action"  value="create">
            <input type="hidden" name="sesskey" value="<?php echo $sk; ?>">

            <div style="padding:22px;">

                <!-- Level name -->
                <div style="margin-bottom:18px;">
                    <label for="nl-name"
                           style="display:block; font-size:11px; font-weight:700; color:#475569;
                                  text-transform:uppercase; letter-spacing:.5px; margin-bottom:7px;">
                        <?php echo get_string('level_name', 'local_istikama_admin'); ?>
                        <span style="color:#e11d48;">*</span>
                    </label>
                    <input id="nl-name" type="text" name="name" required
                           placeholder="e.g. Primary 1, Year 7, Bac 2 Sciences…"
                           autofocus
                           style="
                               display:block; width:100%; box-sizing:border-box;
                               padding:10px 13px;
                               border:1.5px solid #e2e8f0;
                               border-radius:8px;
                               font-size:14px; color:#1e293b;
                               outline:none;
                               transition:border-color .15s;
                           "
                           onfocus="this.style.borderColor='#3b82f6'"
                           onblur="this.style.borderColor='#e2e8f0'"
                    >
                </div>

                <!-- Tier -->
                <div style="margin-bottom:6px;">
                    <label style="display:block; font-size:11px; font-weight:700; color:#475569;
                                  text-transform:uppercase; letter-spacing:.5px; margin-bottom:10px;">
                        <?php echo get_string('level_tier', 'local_istikama_admin'); ?>
                        <span style="color:#e11d48;">*</span>
                    </label>
                    <div style="display:flex; gap:10px;">
                        <?php foreach ($tiers as $tk => $tl):
                            $c = $tiercolors[$tk]; ?>
                        <label style="
                            flex:1; display:flex; flex-direction:column; align-items:center;
                            gap:6px; padding:12px 8px;
                            border:2px solid #e2e8f0;
                            border-radius:10px; cursor:pointer;
                            font-size:12px; font-weight:600; color:<?php echo $c['fg']; ?>;
                            background:<?php echo $c['bg']; ?>;
                            transition:border-color .15s;
                        " class="isti-tier-label" data-tier="<?php echo $tk; ?>">
                            <input type="radio" name="tier" value="<?php echo $tk; ?>"
                                   style="position:absolute; opacity:0; pointer-events:none;"
                                   <?php echo $tk === 'primary' ? 'checked' : ''; ?>>
                            <span style="
                                width:10px; height:10px; border-radius:50%;
                                background:<?php echo $c['dot']; ?>;
                                display:block;
                            "></span>
                            <?php echo s($tl); ?>
                        </label>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div><!-- /modal body -->

            <!-- Modal footer -->
            <div style="
                display:flex; justify-content:flex-end; gap:10px;
                padding:14px 22px;
                border-top:1px solid #f1f5f9;
                background:#fafafa;
            ">
                <button type="button" id="btn-cancel-new-level"
                        style="
                            padding:8px 18px;
                            background:white; color:#64748b;
                            border:1.5px solid #e2e8f0;
                            border-radius:8px; font-size:13px;
                            font-weight:600; cursor:pointer;
                        "
                        onmouseover="this.style.background='#f8fafc'"
                        onmouseout="this.style.background='white'"
                ><?php echo get_string('cancel'); ?></button>
                <button type="submit"
                        style="
                            padding:8px 20px;
                            background:#2563eb; color:white;
                            border:0; border-radius:8px;
                            font-size:13px; font-weight:600;
                            cursor:pointer;
                            display:inline-flex; align-items:center; gap:6px;
                        "
                        onmouseover="this.style.background='#1d4ed8'"
                        onmouseout="this.style.background='#2563eb'"
                >
                    <i class="fa fa-plus"></i>
                    <?php echo get_string('save', 'local_istikama_admin'); ?>
                </button>
            </div>
        </form>
    </div>
</div>


<!-- ═══════════════════════════════════════════════════════════════════════
     TOAST + JAVASCRIPT
════════════════════════════════════════════════════════════════════════ -->
<div id="isti-toast"
     style="
         display:none; position:fixed; bottom:24px; right:24px;
         padding:10px 18px; border-radius:8px;
         font-size:13px; font-weight:500;
         color:white; z-index:9999;
         box-shadow:0 4px 16px rgba(0,0,0,.18);
     "
></div>

<script>
(function () {
'use strict';

/* ── Toast helper ─────────────────────────────────────────────────────── */
function toast(msg, ok) {
    var t = document.getElementById('isti-toast');
    if (!t) return;
    t.textContent    = msg;
    t.style.background = ok ? '#059669' : '#dc2626';
    t.style.display    = 'block';
    clearTimeout(t._tid);
    t._tid = setTimeout(function () { t.style.display = 'none'; }, 2400);
}

/* ── Modal open / close ───────────────────────────────────────────────── */
var overlay    = document.getElementById('isti-new-level-overlay');
var btnOpen    = document.getElementById('btn-open-new-level');
var btnClose   = document.getElementById('btn-close-new-level');
var btnCancel  = document.getElementById('btn-cancel-new-level');
var nameInput  = document.getElementById('nl-name');

function openModal() {
    overlay.style.display = 'flex';
    requestAnimationFrame(function () {
        if (nameInput) { nameInput.value = ''; nameInput.focus(); }
    });
}
function closeModal() {
    overlay.style.display = 'none';
}

if (btnOpen)   btnOpen.addEventListener('click',  openModal);
if (btnClose)  btnClose.addEventListener('click',  closeModal);
if (btnCancel) btnCancel.addEventListener('click', closeModal);
if (overlay)   overlay.addEventListener('click', function (e) {
    if (e.target === overlay) closeModal();
});
document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeModal();
});

/* ── Tier radio card highlight ────────────────────────────────────────── */
document.querySelectorAll('.isti-tier-label').forEach(function (lbl) {
    var radio = lbl.querySelector('input[type=radio]');
    function update() {
        document.querySelectorAll('.isti-tier-label').forEach(function (l) {
            l.style.borderColor = '#e2e8f0';
            l.style.boxShadow   = 'none';
        });
        if (radio && radio.checked) {
            lbl.style.borderColor = '#3b82f6';
            lbl.style.boxShadow   = '0 0 0 3px rgba(59,130,246,.15)';
        }
    }
    lbl.addEventListener('click', function () {
        if (radio) radio.checked = true;
        update();
    });
    if (radio && radio.checked) update();
});

/* ── Inline rename toggle ─────────────────────────────────────────────── */
document.querySelectorAll('.isti-edit-level').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var row  = btn.closest('tr');
        var disp = row.querySelector('.isti-level-name-display');
        var form = row.querySelector('.isti-rename-form');
        if (!disp || !form) return;
        disp.style.display = 'none';
        form.style.display = 'block';
        var inp = form.querySelector('input[name=name]');
        if (inp) { inp.focus(); inp.select(); }
    });
});
document.querySelectorAll('.isti-cancel-rename').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var row  = btn.closest('tr');
        var disp = row.querySelector('.isti-level-name-display');
        var form = row.querySelector('.isti-rename-form');
        if (!disp || !form) return;
        form.style.display = 'none';
        disp.style.display = '';
    });
});
document.querySelectorAll('.isti-level-name-display').forEach(function (span) {
    span.addEventListener('dblclick', function () {
        var btn = span.closest('tr').querySelector('.isti-edit-level');
        if (btn) btn.click();
    });
});

/* ── Drag-and-drop reorder ────────────────────────────────────────────── */
var dragged = null;

document.querySelectorAll('table[data-isti-level-tier] tbody.isti-level-rows tr')
    .forEach(function (row) {

    row.addEventListener('dragstart', function (e) {
        dragged = row;
        setTimeout(function () { row.style.opacity = '0.4'; }, 0);
        e.dataTransfer.effectAllowed = 'move';
    });
    row.addEventListener('dragend', function () {
        row.style.opacity = '1';
        dragged = null;
        document.querySelectorAll('tr.isti-drag-over').forEach(function(r){
            r.classList.remove('isti-drag-over');
            r.style.outline = '';
        });
    });
    row.addEventListener('dragover', function (e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        document.querySelectorAll('tr.isti-drag-over').forEach(function(r){
            r.classList.remove('isti-drag-over');
            r.style.outline = '';
        });
        row.classList.add('isti-drag-over');
        row.style.outline = '2px dashed #3b82f6';
    });
    row.addEventListener('drop', function (e) {
        e.preventDefault();
        row.classList.remove('isti-drag-over');
        row.style.outline = '';
        if (!dragged || dragged === row) return;

        var tbl      = row.closest('table[data-isti-level-tier]');
        var drgTbl   = dragged.closest('table[data-isti-level-tier]');
        if (tbl !== drgTbl) {
            toast('<?php echo $failstr; ?>: cross-tier drag not allowed', false);
            return;
        }

        var tbody = row.parentNode;
        var rect  = row.getBoundingClientRect();
        var insertBefore = (e.clientY - rect.top) < (rect.height / 2);
        tbody.insertBefore(dragged, insertBefore ? row : row.nextSibling);

        // Renumber visible order labels.
        Array.from(tbody.querySelectorAll('tr')).forEach(function (r, i) {
            var lbl = r.querySelector('.isti-level-order');
            if (lbl) lbl.textContent = i + 1;
        });

        // POST new order to server.
        var tier = tbl.getAttribute('data-isti-level-tier');
        var ids  = Array.from(tbody.querySelectorAll('tr'))
                       .map(function (r) { return r.getAttribute('data-isti-level-id'); });
        var fd = new FormData();
        fd.append('sesskey', '<?php echo $sk; ?>');
        fd.append('tier',    tier);
        fd.append('ids',     ids.join(','));

        fetch('<?php echo $reorderurl; ?>', {
            method: 'POST', body: fd, credentials: 'same-origin'
        })
        .then(function (r) { return r.json().catch(function () { return {ok:false,error:'parse'}; }); })
        .then(function (j) {
            if (j && j.ok) toast('<?php echo $savedstr; ?>', true);
            else toast('<?php echo $failstr; ?>: ' + (j && j.error ? j.error : 'unknown'), false);
        })
        .catch(function (err) {
            toast('<?php echo $failstr; ?>: ' + err, false);
        });
    });
});

})();
</script>

<?php local_istikama_admin_print_footer(); ?>
