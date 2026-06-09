<?php
// This file is part of Moodle - http://moodle.org/

require_once('../../config.php');
require_once(__DIR__ . '/locallib.php');
require_once($CFG->libdir . '/formslib.php');

use local_istikama_admin\school_manager;
use local_istikama_admin\geodata;
use local_istikama_admin\form\school_form;

require_login();
local_istikama_admin_require_full_admin();

$action = optional_param('action', '', PARAM_ALPHA);
$categoryid = optional_param('categoryid', 0, PARAM_INT);
$parentid = optional_param('parentid', 0, PARAM_INT);
$confirm = optional_param('confirm', 0, PARAM_INT);
$sesskey = optional_param('sesskey', '', PARAM_RAW);
$layout = optional_param('layout', '', PARAM_ALPHA); // Toggle layout

if ($layout === 'modern' || $layout === 'legacy') {
    set_user_preference('istikama_schools_layout', $layout);
}
$current_layout = get_user_preferences('istikama_schools_layout', 'modern');

$url = new moodle_url('/local/istikama_admin/schools.php');
local_istikama_admin_setup_page($PAGE, $url, get_string('manage_schools', 'local_istikama_admin'));
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css');

// Handle form actions.
$message = '';
$messagetype = 'success';

if ($action && confirm_sesskey()) {
    switch ($action) {
        case 'addschool':
            $form = new school_form(null, ['categoryid' => 0]);
            if ($data = $form->get_data()) {
                if (!empty($data->wilaya_code)) {
                    $data->wilaya_name = geodata::get_wilaya_name($data->wilaya_code);
                }
                if (!empty($data->commune_code) && !empty($data->wilaya_code)) {
                    $data->commune_name = geodata::get_commune_name($data->wilaya_code, $data->commune_code);
                }
                try {
                    school_manager::create_school($data);
                    $message = get_string('school_created', 'local_istikama_admin');
                } catch (\Exception $e) {
                    $message = $e->getMessage();
                    $messagetype = 'error';
                }
                redirect($url, $message, 2, \core\output\notification::NOTIFY_SUCCESS);
            }
            break;

        case 'editschool':
            $form = new school_form(null, [
                'categoryid' => $categoryid,
                'schoolinfo' => school_manager::get_school_info($categoryid),
            ]);
            if ($data = $form->get_data()) {
                if (!empty($data->wilaya_code)) {
                    $data->wilaya_name = geodata::get_wilaya_name($data->wilaya_code);
                }
                if (!empty($data->commune_code) && !empty($data->wilaya_code)) {
                    $data->commune_name = geodata::get_commune_name($data->wilaya_code, $data->commune_code);
                }
                try {
                    school_manager::update_school($categoryid, $data);
                    $message = get_string('school_updated', 'local_istikama_admin');
                } catch (\Exception $e) {
                    $message = $e->getMessage();
                    $messagetype = 'error';
                }
                redirect($url, $message, 2, \core\output\notification::NOTIFY_SUCCESS);
            }
            break;

        case 'addlevel':
            $global_level_id = required_param('global_level_id', PARAM_INT);
            try {
                school_manager::create_level($parentid, $global_level_id);
                $message = get_string('level_created', 'local_istikama_admin');
            } catch (\Exception $e) {
                $message = $e->getMessage();
                $messagetype = 'error';
            }
            redirect($url, $message, 2, \core\output\notification::NOTIFY_SUCCESS);
            break;

        case 'addclass':
            $name = required_param('name', PARAM_TEXT);
            try {
                school_manager::create_class($parentid, $name);
                $message = get_string('class_created', 'local_istikama_admin');
            } catch (\Exception $e) {
                $message = $e->getMessage();
                $messagetype = 'error';
            }
            redirect($url, $message, 2, \core\output\notification::NOTIFY_SUCCESS);
            break;

        case 'addsubject':
            $name = required_param('name', PARAM_TEXT);
            try {
                $courseid = school_manager::create_subject($parentid, $name);
                // Auto enroll class students
                local_istikama_admin_enroll_class_students_in_subject($parentid, $courseid);
                $message = get_string('subject_created', 'local_istikama_admin');
            } catch (\Exception $e) {
                $message = $e->getMessage();
                $messagetype = 'error';
            }
            redirect($url, $message, 2, $messagetype === 'error' ? \core\output\notification::NOTIFY_ERROR : \core\output\notification::NOTIFY_SUCCESS);
            break;

        case 'deleteschool':
            if ($confirm && confirm_sesskey()) {
                try {
                    school_manager::delete_school($categoryid);
                    $message = get_string('school_deleted', 'local_istikama_admin');
                } catch (\Exception $e) {
                    $message = $e->getMessage();
                    $messagetype = 'error';
                }
                redirect($url, $message, 2, \core\output\notification::NOTIFY_SUCCESS);
            }
            break;

        case 'deletelevel':
            if ($confirm && confirm_sesskey()) {
                try {
                    // Resolve global_level_id from the category so we can clean up
                    // istikama_school_level after deleting the category.
                    $levelinfo = $DB->get_record('istikama_level_info', ['categoryid' => $categoryid]);
                    $cat = core_course_category::get($categoryid);
                    $cat->delete_full(true);
                    if ($levelinfo) {
                        $DB->delete_records('istikama_level_info', ['categoryid' => $categoryid]);
                        // Find which school this category belonged to so we only
                        // remove that school's mapping, not all schools' mappings.
                        $parentcat = $DB->get_field('course_categories', 'parent', ['id' => $categoryid]);
                        if ($parentcat) {
                            $DB->delete_records('istikama_school_level', [
                                'schoolid'        => (int)$parentcat,
                                'global_level_id' => (int)$levelinfo->global_level_id,
                            ]);
                        }
                    }
                    $message = get_string('level_deleted', 'local_istikama_admin');
                } catch (\Exception $e) {
                    $message = $e->getMessage();
                    $messagetype = 'error';
                }
                redirect($url, $message, 2,
                    $messagetype === 'error'
                        ? \core\output\notification::NOTIFY_ERROR
                        : \core\output\notification::NOTIFY_SUCCESS);
            }
            break;

        case 'deleteclass':
            if ($confirm && confirm_sesskey()) {
                try {
                    $cat = core_course_category::get($categoryid);
                    $cat->delete_full(true);
                    $message = get_string('item_deleted', 'local_istikama_admin');
                } catch (\Exception $e) {
                    $message = $e->getMessage();
                    $messagetype = 'error';
                }
                redirect($url, $message, 2, \core\output\notification::NOTIFY_SUCCESS);
            }
            break;

        case 'deletesubject':
            $courseid = required_param('courseid', PARAM_INT);
            if ($confirm && confirm_sesskey()) {
                try {
                    delete_course($courseid, false);
                    $message = get_string('subject_deleted', 'local_istikama_admin');
                } catch (\Exception $e) {
                    $message = $e->getMessage();
                    $messagetype = 'error';
                }
                redirect($url, $message, 2, $messagetype === 'error' ? \core\output\notification::NOTIFY_ERROR : \core\output\notification::NOTIFY_SUCCESS);
            }
            break;
    }
}

// Build the page.
local_istikama_admin_print_header(get_string('manage_schools', 'local_istikama_admin'));

// Show form if action requires it.
$showaction = optional_param('show', '', PARAM_ALPHA);

if ($showaction === 'schoolform') {
    $schoolinfo = $categoryid ? school_manager::get_school_info($categoryid) : null;
    $form = new school_form(null, [
        'categoryid' => $categoryid,
        'schoolinfo' => $schoolinfo,
    ]);
    $form->display();
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var wilayaSelect = document.getElementById('id_wilaya_code');
        var communeSelect = document.getElementById('id_commune_code');
        if (wilayaSelect && communeSelect) {
            var currentCommune = communeSelect.value;
            
            function updateCommunes() {
                var code = wilayaSelect.value;
                communeSelect.innerHTML = '<option value="">...</option>';
                if (!code) {
                    communeSelect.innerHTML = '<option value=""><?php echo get_string("choosedots"); ?></option>';
                    return;
                }

                var argurl = M.cfg.wwwroot + '/local/istikama_admin/ajax.php?action=communes&wilaya=' +
                          encodeURIComponent(code) + '&sesskey=' + M.cfg.sesskey;
                fetch(argurl).then(function(r) { return r.json(); }).then(function(data) {
                    communeSelect.innerHTML = '<option value=""><?php echo get_string("choosedots"); ?></option>';
                    data.forEach(function(c) {
                        var opt = document.createElement('option');
                        opt.value = c.code;
                        opt.textContent = c.name + ' (' + c.name_ar + ')';
                        if (c.code === currentCommune) {
                            opt.selected = true;
                        }
                        communeSelect.appendChild(opt);
                    });
                });
            }
            
            wilayaSelect.addEventListener('change', function() {
                currentCommune = ''; 
                updateCommunes();
            });
            
            if (wilayaSelect.value) {
                updateCommunes();
            } else {
                communeSelect.innerHTML = '<option value=""><?php echo get_string("choosedots"); ?></option>';
            }
        }
    });
    </script>
    <?php
    local_istikama_admin_print_footer();
    exit;
}

// Get the hierarchy.
$hierarchy = school_manager::get_hierarchy();
$canmanage = has_capability('moodle/category:manage', context_system::instance());

// Fetch global levels for the dropdowns
$global_levels = $DB->get_records('istikama_global_level', [], 'order_index ASC');
$gl_options = '<option value="">' . get_string('choosedots') . '</option>';
foreach ($global_levels as $gl) {
    $gl_options .= '<option value="' . $gl->id . '">' . s($gl->name) . '</option>';
}

echo '<div class="isti-school-tree">';

// Header row
echo '<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px">';
echo '<div style="display:flex;align-items:center;gap:10px">';
echo '<h3 style="margin:0;font-weight:700;font-size:1.15rem;color:#1e293b"><i class="fa fa-university" style="color:#3b82f6;margin-right:6px"></i>' . get_string('schools', 'local_istikama_admin') . '</h3>';
echo '</div>';
echo '<div style="display:flex;gap:8px;flex-wrap:wrap">';
echo '<button type="button" class="isti-btn isti-btn-outline isti-btn-sm" id="btn-expand-all"><i class="fa fa-chevron-down"></i> ' . get_string('expand_all', 'local_istikama_admin') . '</button>';
echo '<button type="button" class="isti-btn isti-btn-outline isti-btn-sm" id="btn-collapse-all"><i class="fa fa-chevron-up"></i> ' . get_string('collapse_all', 'local_istikama_admin') . '</button>';
if ($canmanage) {
    echo '<a href="' . (new moodle_url('/local/istikama_admin/schools.php', ['show' => 'schoolform']))->out() .
         '" class="isti-btn isti-btn-primary isti-btn-sm"><i class="fa fa-plus"></i> ' .
         get_string('add_school', 'local_istikama_admin') . '</a>';
}
echo '</div>';
echo '</div>';

if (empty($hierarchy)) {
    echo '<div style="text-align:center;padding:60px 20px;color:#94a3b8"><i class="fa fa-university" style="font-size:3rem;display:block;margin-bottom:12px;color:#cbd5e1"></i><p style="margin:0">' . get_string('no_schools', 'local_istikama_admin') . '</p></div>';
} else {

    foreach ($hierarchy as $school) {
        $info = $school['info'] ?? null;
        $logourl = school_manager::get_school_logo_url($school['id']);

        echo '<div class="isti-school-item">';
        echo '<details open>';
        echo '<summary>';
        // School icon/logo
        if ($logourl) {
            echo '<img src="' . s($logourl) . '" alt="" style="width:32px;height:32px;border-radius:8px;object-fit:cover">';
        } else {
            echo '<span style="width:32px;height:32px;border-radius:8px;background:#eff6ff;color:#3b82f6;display:inline-flex;align-items:center;justify-content:center"><i class="fa fa-university"></i></span>';
        }
        echo '<span class="isti-school-name" style="flex:1;min-width:0">' . s($school['name']);
        if ($info && !empty($info->wilaya_name)) {
            echo ' <span style="color:#94a3b8;font-size:.8rem;font-weight:400"><i class="fa fa-map-marker"></i> ' . s($info->wilaya_name);
            if (!empty($info->commune_name)) echo ' - ' . s($info->commune_name);
            echo '</span>';
        }
        echo '</span>';
        // Actions
        if ($canmanage) {
            echo '<span class="isti-chevron" style="display:flex;gap:6px;align-items:center">';
            echo '<button type="button" class="isti-btn isti-btn-outline isti-btn-sm istikama-btn-assign-subjects" data-context="school" data-id="'.$school['id'].'" onclick="event.stopPropagation()"><i class="fa fa-tags"></i> ' . get_string('assign_subjects_btn', 'local_istikama_admin') . '</button>';
            $lvlsurl = new moodle_url('/local/istikama_admin/school_levels.php', ['schoolid' => $school['id']]);
            echo '<a href="' . $lvlsurl->out() . '" class="isti-btn isti-btn-outline isti-btn-sm" onclick="event.stopPropagation()" title="' . s(get_string('manage_school_levels', 'local_istikama_admin')) . '"><i class="fa fa-layer-group"></i> ' . get_string('manage_school_levels', 'local_istikama_admin') . '</a>';
            $editurl = new moodle_url('/local/istikama_admin/schools.php', ['show' => 'schoolform', 'categoryid' => $school['id']]);
            echo '<a href="' . $editurl->out() . '" class="isti-btn isti-btn-outline isti-btn-sm" onclick="event.stopPropagation()"><i class="fa fa-edit"></i></a>';
            $delurl = new moodle_url('/local/istikama_admin/schools.php', ['action' => 'deleteschool', 'categoryid' => $school['id'], 'confirm' => 1, 'sesskey' => sesskey()]);
            echo '<a href="' . $delurl->out() . '" class="isti-btn isti-btn-danger isti-btn-sm" onclick="event.stopPropagation();return confirm(\'' . s(get_string('delete_school_confirm', 'local_istikama_admin')) . '\');"><i class="fa fa-trash"></i></a>';
            echo '<i class="fa fa-chevron-right"></i>';
            echo '</span>';
        } else {
            echo '<span class="isti-chevron"><i class="fa fa-chevron-right"></i></span>';
        }
        echo '</summary>';

        // Levels
        echo '<div class="isti-level-list">';
        if (!empty($school['children'])) {
            foreach ($school['children'] as $level) {
                echo '<div class="isti-level-item">';
                echo '<details>';
                echo '<summary>';
                echo '<i class="fa fa-folder-open" style="color:#3b82f6"></i>';
                echo '<span style="flex:1">' . s($level['name']) . '</span>';
                echo '<span style="font-size:.75rem;color:#94a3b8;margin-right:8px">' . count($level['children']) . ' ' . get_string('hierarchy_class', 'local_istikama_admin') . '</span>';
                if ($canmanage) {
                    echo '<button type="button" class="isti-btn isti-btn-outline isti-btn-sm istikama-btn-assign-subjects" data-context="level" data-id="'.$level['id'].'" onclick="event.stopPropagation()" style="margin-right:4px"><i class="fa fa-tags"></i></button>';
                    $dellvlurl = new moodle_url('/local/istikama_admin/schools.php', [
                        'action' => 'deletelevel', 'categoryid' => $level['id'], 'confirm' => 1, 'sesskey' => sesskey(),
                    ]);
                    echo '<a href="' . $dellvlurl->out() . '" class="isti-btn isti-btn-danger isti-btn-sm"'
                        . ' onclick="event.stopPropagation();return confirm(\'' . s(get_string('confirm_delete_level', 'local_istikama_admin')) . '\');"'
                        . ' title="' . s(get_string('delete', 'local_istikama_admin')) . '">'
                        . '<i class="fa fa-trash"></i></a>';
                }
                echo '<span class="isti-chevron"><i class="fa fa-chevron-right"></i></span>';
                echo '</summary>';

                // Classes
                echo '<div class="isti-class-list">';
                if (!empty($level['children'])) {
                    foreach ($level['children'] as $class) {
                        echo '<div class="isti-class-row">';
                        echo '<i class="fa fa-users" style="color:#64748b"></i>';
                        echo '<span class="isti-class-name">' . s($class['name']) . '</span>';
                        // Subject pills
                        if (!empty($class['subjects'])) {
                            echo '<span style="display:flex;gap:3px;flex-wrap:wrap">';
                            foreach ($class['subjects'] as $subject) {
                                echo '<span class="isti-subject-pill">' . s($subject['name']);
                                if ($canmanage) {
                                    $delsbjurl = new moodle_url('/local/istikama_admin/schools.php', ['action' => 'deletesubject', 'courseid' => $subject['id'], 'confirm' => 1, 'sesskey' => sesskey()]);
                                    echo ' <a href="' . $delsbjurl->out() . '" style="color:#ef4444;text-decoration:none" onclick="return confirm(\'' . get_string('areyousure') . '\');"><i class="fa fa-times" style="font-size:.6rem"></i></a>';
                                }
                                echo '</span>';
                            }
                            echo '</span>';
                        }
                        echo '<span class="isti-class-actions">';
                        if ($canmanage) {
                            echo '<button type="button" class="isti-btn isti-btn-outline isti-btn-sm istikama-btn-assign-subjects" data-context="class" data-id="'.$class['id'].'"><i class="fa fa-tags"></i></button>';
                            $delurl = new moodle_url('/local/istikama_admin/schools.php', ['action' => 'deleteclass', 'categoryid' => $class['id'], 'confirm' => 1, 'sesskey' => sesskey()]);
                            echo '<a href="' . $delurl->out() . '" class="isti-btn isti-btn-danger isti-btn-sm" onclick="return confirm(\'' . get_string('areyousure') . '\');"><i class="fa fa-trash"></i></a>';
                        }
                        echo '</span>';
                        echo '</div>';
                    }
                } else {
                    echo '<div style="padding:8px 12px;color:#94a3b8;font-size:.85rem">' . get_string('no_classes', 'local_istikama_admin') . '</div>';
                }

                // Add class button (opens modal)
                if ($canmanage) {
                    echo '<div style="padding:8px 12px">';
                    echo '<button type="button" class="isti-btn isti-btn-outline isti-btn-sm btn-open-add-class" data-levelid="' . $level['id'] . '" data-levelname="' . s($level['name']) . '"><i class="fa fa-plus"></i> ' . get_string('add_class', 'local_istikama_admin') . '</button>';
                    echo '</div>';
                }
                echo '</div>'; // class-list
                echo '</details>';
                echo '</div>'; // level-item
            }
        } else {
            echo '<div style="padding:12px;color:#94a3b8;font-size:.85rem">' . get_string('no_levels', 'local_istikama_admin') . '</div>';
        }

        // Add level form
        if ($canmanage) {
            echo '<div style="padding:12px;border-top:1px solid #e2e8f0;margin-top:8px">';
            echo '<form method="post" action="' . $url->out() . '" style="display:flex;gap:8px;align-items:center;max-width:400px">';
            echo '<input type="hidden" name="sesskey" value="' . sesskey() . '">';
            echo '<input type="hidden" name="action" value="addlevel">';
            echo '<input type="hidden" name="parentid" value="' . $school['id'] . '">';
            echo '<select class="isti-form-select" name="global_level_id" required style="flex:1">' . $gl_options . '</select>';
            echo '<button type="submit" class="isti-btn isti-btn-primary isti-btn-sm"><i class="fa fa-plus"></i> ' . get_string('add_level', 'local_istikama_admin') . '</button>';
            echo '</form>';
            echo '</div>';
        }

        echo '</div>'; // level-list
        echo '</details>';
        echo '</div>'; // school-item
    }
}

// ==== ADD CLASS MODAL ====
if ($canmanage) {
    echo '<div class="isti-modal-overlay" id="add-class-modal">
    <div class="isti-modal">
        <div class="isti-modal-header">
            <h5><i class="fa fa-plus" style="color:#3b82f6;margin-right:6px"></i>' . get_string('add_class', 'local_istikama_admin') . '</h5>
            <button class="isti-modal-close" id="add-class-modal-close">&times;</button>
        </div>
        <form method="post" action="' . $url->out() . '">
        <div class="isti-modal-body">
            <input type="hidden" name="sesskey" value="' . sesskey() . '">
            <input type="hidden" name="action" value="addclass">
            <input type="hidden" name="parentid" id="add-class-parentid" value="">
            <div class="istikama-form-field" style="margin-bottom:16px">
                <label style="font-size:.8rem;font-weight:600;color:#475569;text-transform:uppercase;letter-spacing:.5px">' . get_string('class_name', 'local_istikama_admin') . ' <span style="color:#ef4444">*</span></label>
                <input type="text" class="isti-form-input" name="name" id="add-class-name" required placeholder="' . get_string('class_name_placeholder', 'local_istikama_admin') . '">
            </div>
            <div id="add-class-level-info" style="font-size:.85rem;color:#64748b"></div>
        </div>
        <div class="isti-modal-footer">
            <button type="button" class="isti-btn isti-btn-outline" id="add-class-cancel">' . get_string('cancel') . '</button>
            <button type="submit" class="isti-btn isti-btn-primary"><i class="fa fa-plus"></i> ' . get_string('add_class', 'local_istikama_admin') . '</button>
        </div>
        </form>
    </div>
</div>

<script>
(function() {
    var modal = document.getElementById("add-class-modal");
    if (!modal) return;
    var parentInput = document.getElementById("add-class-parentid");
    var nameInput   = document.getElementById("add-class-name");
    var levelInfo   = document.getElementById("add-class-level-info");
    var closeBtn    = document.getElementById("add-class-modal-close");
    var cancelBtn   = document.getElementById("add-class-cancel");

    function openModal(levelId, levelName) {
        parentInput.value = levelId;
        nameInput.value = "";
        levelInfo.innerHTML = "<i class=\"fa fa-folder-open\" style=\"color:#3b82f6;margin-right:4px\"></i> Adding class to: <strong>" + levelName + "</strong>";
        modal.style.display = "flex";
        setTimeout(function() { modal.classList.add("isti-modal-visible"); nameInput.focus(); }, 10);
    }
    function closeModal() {
        modal.classList.remove("isti-modal-visible");
        setTimeout(function() { modal.style.display = "none"; }, 200);
    }

    closeBtn.addEventListener("click", closeModal);
    cancelBtn.addEventListener("click", closeModal);
    modal.addEventListener("click", function(e) { if (e.target === modal) closeModal(); });

    document.querySelectorAll(".btn-open-add-class").forEach(function(btn) {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            openModal(this.getAttribute("data-levelid"), this.getAttribute("data-levelname"));
        });
    });
})();
</script>';
}

// ==== ASSIGN SUBJECTS MODAL ====
if ($canmanage) {
    // We pass global levels for the inline creator.
    $gl_options_json = json_encode($global_levels);

    // Strings used by the modal's client-side JS, passed as a JSON map so the
    // markup the script builds at runtime is localised too.
    $assignsub_js = json_encode([
        'loading_subjects' => get_string('assignsub_loading_subjects', 'local_istikama_admin'),
        'none'             => get_string('assignsub_none', 'local_istikama_admin'),
        'load_failed'      => get_string('assignsub_load_failed', 'local_istikama_admin'),
        'name_required'    => get_string('assignsub_name_required', 'local_istikama_admin'),
        'creating'         => get_string('assignsub_creating', 'local_istikama_admin'),
        'created'          => get_string('assignsub_created', 'local_istikama_admin'),
        'reused'           => get_string('assignsub_reused', 'local_istikama_admin'),
        'failed'           => get_string('assignsub_failed', 'local_istikama_admin'),
        'network_error'    => get_string('assignsub_network_error', 'local_istikama_admin'),
        'info_class'       => get_string('assignsub_info_class', 'local_istikama_admin'),
        'info_level'       => get_string('assignsub_info_level', 'local_istikama_admin'),
        'info_school'      => get_string('assignsub_info_school', 'local_istikama_admin'),
        'no_classes'       => get_string('assignsub_no_classes', 'local_istikama_admin'),
        'processing'       => get_string('assignsub_processing', 'local_istikama_admin'),
        'success'          => get_string('assignsub_success', 'local_istikama_admin'),
        'select_one'       => get_string('assignsub_select_one', 'local_istikama_admin'),
        'error'            => get_string('assignsub_error', 'local_istikama_admin'),
    ], JSON_UNESCAPED_UNICODE);

    echo '<div class="istikama-modal-overlay" id="istikama-subject-modal" style="display:none;">
    <div class="istikama-modal-container" style="max-width: 600px;">
        <div class="istikama-modal-header">
            <div class="istikama-modal-title-group">
                <h3 id="istikama-smodal-title"><i class="fa fa-tags"></i> ' . get_string('assignsub_title', 'local_istikama_admin') . '</h3>
                <span class="istikama-modal-subtitle" id="istikama-smodal-subtitle"></span>
            </div>
            <button class="istikama-modal-close" id="istikama-smodal-close">&times;</button>
        </div>
        <div class="istikama-modal-body" id="istikama-smodal-body">
            <div class="istikama-modal-loading" id="istikama-smodal-loading" style="display:none;">
                <div class="istikama-spinner"></div>
                <span>' . get_string('assignsub_loading', 'local_istikama_admin') . '</span>
            </div>
            <div id="istikama-smodal-content">
                <div class="alert alert-info small" id="istikama-smodal-info"></div>
                
                <div class="istikama-cascade-group mb-3" style="display:none;" id="istikama-smodal-selectors">
                    <div class="istikama-form-field">
                        <label>' . get_string('assignsub_target_school', 'local_istikama_admin') . '</label>
                        <select id="ism-s-school" class="form-control form-select"><option value="">' . get_string('select_school', 'local_istikama_admin') . '</option></select>
                    </div>
                    <div class="istikama-form-field">
                        <label>' . get_string('assignsub_target_level', 'local_istikama_admin') . '</label>
                        <select id="ism-s-level" class="form-control form-select" disabled><option value="">' . get_string('select_level', 'local_istikama_admin') . '</option></select>
                    </div>
                    <div class="istikama-form-field" id="ism-s-class-container">
                        <label>' . get_string('assignsub_target_class', 'local_istikama_admin') . '</label>
                        <select id="ism-s-class" class="form-control form-select" disabled><option value="">' . get_string('select_class', 'local_istikama_admin') . '</option></select>
                    </div>
                </div>

                <div class="istikama-form-field">
                    <label>' . get_string('subjects', 'local_istikama_admin') . '</label>
                    <div class="istikama-subject-chips" id="istikama-smodal-tags">
                        <span class="text-muted small">' . get_string('assignsub_loading_subjects', 'local_istikama_admin') . '</span>
                    </div>
                    <small class="text-muted mt-1 d-block">' . get_string('assignsub_help', 'local_istikama_admin') . '</small>
                </div>

                <div class="mt-4 pt-3 border-top">
                    <h6>' . get_string('assignsub_create_new', 'local_istikama_admin') . '</h6>
                    <div class="input-group input-group-sm mb-2">
                        <input type="text" id="ism-new-subject-name" class="form-control" placeholder="' . get_string('assignsub_name_ph', 'local_istikama_admin') . '">
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="button" id="ism-create-subject-btn"><i class="fa fa-plus text-primary"></i></button>
                        </div>
                    </div>
                    <div id="ism-create-subject-feedback" class="small mt-1" style="display:none;"></div>
                </div>
            </div>
        </div>
        <div class="istikama-modal-footer">
            <div id="istikama-smodal-feedback" class="istikama-modal-feedback" style="display:none;"></div>
            <div class="istikama-modal-actions">
                <button class="btn istikama-btn-cancel" id="istikama-smodal-cancel-btn">' . get_string('assignsub_close', 'local_istikama_admin') . '</button>
                <button class="btn istikama-btn-save" id="istikama-smodal-save-btn">
                    <i class="fa fa-check"></i> ' . get_string('assignsub_save', 'local_istikama_admin') . '
                </button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var modal = document.getElementById("istikama-subject-modal");
    if (!modal) return;
    
    var modalTitle = document.getElementById("istikama-smodal-title");
    var modalSubtitle = document.getElementById("istikama-smodal-subtitle");
    var modalInfo = document.getElementById("istikama-smodal-info");
    var modalLoading = document.getElementById("istikama-smodal-loading");
    var modalContent = document.getElementById("istikama-smodal-content");
    var modalFeedback = document.getElementById("istikama-smodal-feedback");
    var saveBtn = document.getElementById("istikama-smodal-save-btn");
    
    var allGlobalLevels = ' . $gl_options_json . ';
    var currentContext = "";
    var currentId = 0;
    var AJAX_URL = M.cfg.wwwroot + "/local/istikama_admin/ajax.php";
    var SESSKEY = M.cfg.sesskey;
    var STR = ' . $assignsub_js . ';
    
    var rawHierarchy = ' . json_encode($hierarchy) . '; // Pass hierarchy down
    var targetClassIds = [];
    var targetClassIds = [];
    var currentGlobalLevelId = 0;

    function closeModal() {
        modal.classList.remove("istikama-modal-visible");
        setTimeout(function() { modal.style.display = "none"; }, 300);
    }
    
    document.getElementById("istikama-smodal-close").addEventListener("click", closeModal);
    document.getElementById("istikama-smodal-cancel-btn").addEventListener("click", closeModal);
    modal.addEventListener("click", function(e) { if (e.target === modal) closeModal(); });

    // Render subjective tags based loosely on context
    function fetchAndRenderTags(selectId = null) {
        var container = document.getElementById("istikama-smodal-tags");
        container.innerHTML = "<div class=\'spinner-border spinner-border-sm text-primary\'></div> " + STR.loading_subjects;
        
        var url = AJAX_URL + "?action=getglobaltags&targetcatid=" + currentId + "&context=" + currentContext + "&sesskey=" + SESSKEY;
        fetch(url).then(function(r) { return r.json(); }).then(function(tags) {
            if (tags.length === 0) {
                container.innerHTML = "<span class=\'text-muted small\'>" + STR.none + "</span>";
                return;
            }
            var html = "";
            tags.forEach(function(s) {
                var checkedAttr = (selectId && s.id == selectId) ? \'checked\' : \'\';
                var activeClass = checkedAttr ? \'active\' : \'\';
                html += \'<label class="istikama-chip \' + activeClass + \'">\';
                html += \'<input type="checkbox" value="\' + s.id + \'" \' + checkedAttr + \'> <i class="fa fa-book mr-1"></i> \' + s.name;
                html += \'</label>\';
            });
            container.innerHTML = html;
            
            container.querySelectorAll(".istikama-chip input").forEach(function(inp) {
                inp.addEventListener("change", function() {
                    this.parentElement.classList.toggle("active", this.checked);
                });
            });
        }).catch(function(err) {
            container.innerHTML = "<span class=\'text-danger small\'>" + STR.load_failed + "</span>";
        });
    }

    // Dynamic Creation Handler
    document.getElementById("ism-create-subject-btn").addEventListener("click", function() {
        var nameInp = document.getElementById("ism-new-subject-name");
        var fback = document.getElementById("ism-create-subject-feedback");
        var name = nameInp.value.trim();
        
        if (!name) {
            fback.style.display = "block";
            fback.className = "small mt-1 text-danger";
            fback.textContent = STR.name_required;
            return;
        }

        fback.style.display = "block";
        fback.className = "small mt-1 text-info";
        fback.textContent = STR.creating;

        var formData = new FormData();
        formData.append("action", "createsubject");
        formData.append("sesskey", SESSKEY);
        formData.append("name", name);
        formData.append("targetcatid", currentId);
        formData.append("context", currentContext);

        fetch(AJAX_URL, { method: "POST", body: formData })
            .then(function(r) { return r.json(); })
            .then(function(result) {
                if (result.success) {
                    nameInp.value = "";
                    fback.className = "small mt-1 text-success";
                    if (result.is_new) {
                        fback.textContent = STR.created.replace("{name}", result.name);
                    } else {
                        fback.textContent = STR.reused.replace("{name}", result.name);
                    }
                    // Retrigger tags and pass the newly created/reused ID to auto-select it
                    fetchAndRenderTags(result.id);
                    setTimeout(function() { fback.style.display = "none"; }, 3000);
                } else {
                    fback.className = "small mt-1 text-danger";
                    fback.textContent = result.error || STR.failed;
                }
            }).catch(function() {
                fback.className = "small mt-1 text-danger";
                fback.textContent = STR.network_error;
            });
    });

    function flattenClasses(context, id) {
        var cls = [];
        rawHierarchy.forEach(function(s) {
            if (context === "school" && s.id == id) {
                if (s.children) {
                    s.children.forEach(function(l) {
                        if (l.children) l.children.forEach(function(c) { cls.push(c.id); });
                    });
                }
            } else if (context === "level") {
                if (s.children) {
                    s.children.forEach(function(l) {
                        if (l.id == id && l.children) {
                            l.children.forEach(function(c) { cls.push(c.id); });
                        }
                    });
                }
            } else if (context === "class") {
                if (s.children) {
                    s.children.forEach(function(l) {
                        if (l.children) {
                            l.children.forEach(function(c) {
                                if (c.id == id) { cls.push(c.id); currentGlobalLevelId = l.global_level_id || 0;}
                            });
                        }
                    });
                }
            }
        });
        return cls;
    }
    
    document.querySelectorAll(".istikama-btn-assign-subjects").forEach(function(btn) {
        btn.addEventListener("click", function(e) {
            e.preventDefault();
            currentContext = this.getAttribute("data-context");
            currentId = parseInt(this.getAttribute("data-id"));
            var nameEl = this.closest(".istikama-school-row, .istikama-school-card, .istikama-level-node, .istikama-level-group, .istikama-class-node, .istikama-tree-class");
            var name = "";
            if (nameEl) {
                var h4 = nameEl.querySelector("h4");
                var st = nameEl.querySelector("strong");
                if (!h4 && !st) {
                    var el = nameEl.querySelector("summary .d-flex") || nameEl.querySelector("span");
                    if (el) name = el.textContent.trim();
                } else if (h4) {
                    name = h4.textContent.trim();
                } else if (st) {
                    name = st.textContent.trim();
                }
            }
            
            modalSubtitle.textContent = name;
            modalInfo.innerHTML = (currentContext === "class" ? STR.info_class : (currentContext === "level" ? STR.info_level : STR.info_school));
            
            targetClassIds = flattenClasses(currentContext, currentId);
            if (targetClassIds.length === 0) {
                modalInfo.innerHTML = "<span class=\'text-danger\'>" + STR.no_classes + "</span>";
                saveBtn.disabled = true;
            } else {
                saveBtn.disabled = false;
            }
            
            modalFeedback.style.display = "none";
            fetchAndRenderTags();
            
            modal.style.display = "flex";
            setTimeout(function() { modal.classList.add("istikama-modal-visible"); }, 10);
        });
    });

    saveBtn.addEventListener("click", function() {
        var selectedSubjects = [];
        document.querySelectorAll("#istikama-smodal-tags input:checked").forEach(function(inp) {
            selectedSubjects.push(parseInt(inp.value));
        });
        
        if (selectedSubjects.length === 0) {
            showFeedback(STR.select_one, "error");
            return;
        }
        if (targetClassIds.length === 0) return;
        
        saveBtn.disabled = true;
        saveBtn.innerHTML = \'<i class="fa fa-spinner fa-spin"></i> \' + STR.processing;
        
        var payload = {
            classids: targetClassIds,
            subjects: selectedSubjects
        };
        
        var formData = new FormData();
        formData.append("action", "bulkassignsubjects");
        formData.append("sesskey", SESSKEY);
        formData.append("data", JSON.stringify(payload));
        
        fetch(AJAX_URL, { method: "POST", body: formData })
            .then(function(r) { return r.json(); })
            .then(function(result) {
                if (result.success) {
                    showFeedback(STR.success.replace("{count}", result.createdcount), "success");
                    setTimeout(function() { window.location.reload(); }, 1500);
                } else {
                    saveBtn.disabled = false;
                    saveBtn.innerHTML = \'<i class="fa fa-check"></i> \' + ' . json_encode(get_string('assignsub_save', 'local_istikama_admin'), JSON_UNESCAPED_UNICODE) . ';
                    showFeedback(result.error || STR.error, "error");
                }
            })
            .catch(function(err) {
                saveBtn.disabled = false;
                saveBtn.innerHTML = \'<i class="fa fa-check"></i> \' + ' . json_encode(get_string('assignsub_save', 'local_istikama_admin'), JSON_UNESCAPED_UNICODE) . ';
                showFeedback(STR.network_error, "error");
            });
    });
    
    function showFeedback(msg, type) {
        modalFeedback.textContent = msg;
        modalFeedback.className = "istikama-modal-feedback istikama-feedback-" + type;
        modalFeedback.style.display = "block";
    }
});
</script>';
}

echo '</div>'; // .schools-container

local_istikama_admin_print_footer();
