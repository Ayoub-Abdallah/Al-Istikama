<?php
/**
 * Add Content from Istikama Content Bank natively into a Moodle Course.
 */

require_once('../../config.php');
require_once(__DIR__ . '/locallib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/course/modlib.php');

$courseid = required_param('courseid', PARAM_INT);
$sectionid = optional_param('sectionid', 0, PARAM_INT); // Could be section ID or section num from JS
$action = optional_param('action', '', PARAM_ALPHA);

local_istikama_admin_require_teacher();
$course = get_course($courseid);
$context = context_course::instance($courseid);
require_login($course);
require_capability('moodle/course:manageactivities', $context);

$PAGE->set_url(new moodle_url('/local/istikama_admin/add_from_bank.php', ['courseid' => $courseid, 'sectionid' => $sectionid]));
$PAGE->set_context($context);
$PAGE->set_pagelayout('admin');
$PAGE->set_title('Add Istikama Content');
$PAGE->set_heading(format_string($course->fullname));

// Use section ID to find section number natively
$sectionnum = 1;
if ($sectionid) {
    if ($DB->record_exists('course_sections', ['id' => $sectionid])) {
        $sectionnum = $DB->get_field('course_sections', 'section', ['id' => $sectionid]);
    } else {
        $sectionnum = $sectionid;
    }
}

// Resolve current class/level and strict teacher scope for this course.
$courseclassid = (int)$course->category;
$courselevelid = 0;
try {
    $classcat = core_course_category::get($courseclassid);
    $courselevelid = (int)$classcat->parent;
} catch (\Exception $e) {
    throw new moodle_exception('invalidcourseid', 'error');
}

$subjectkeys = [(string)$courseid];
$subjectmap = $DB->get_record('istikama_class_subjects', ['courseid' => $courseid]);
if ($subjectmap && !empty($subjectmap->subject_name_id)) {
    $subjectkeys[] = (string)$subjectmap->subject_name_id;
}
$subjectkeys = array_values(array_unique(array_filter($subjectkeys)));

$levelkeys = [(string)$courselevelid];
$levelinfo = $DB->get_record('istikama_level_info', ['categoryid' => $courselevelid]);
if ($levelinfo && !empty($levelinfo->global_level_id)) {
    $levelkeys[] = (string)$levelinfo->global_level_id;
}
$levelkeys = array_values(array_unique(array_filter($levelkeys)));

if (empty($subjectkeys) || empty($levelkeys)) {
    throw new required_capability_exception($context, 'moodle/course:manageactivities', 'nopermissions', '');
}

list($teachersubsql, $teachersubparams) = $DB->get_in_or_equal($subjectkeys, SQL_PARAMS_NAMED, 'tsub');
$teacherparams = [
    'userid' => (int)$USER->id,
    'classid' => $courseclassid,
    'levelid' => $courselevelid,
];
$teacherparams = array_merge($teacherparams, $teachersubparams);
$teachersql = "SELECT 1
                 FROM {istikama_user_school} us
                 JOIN {istikama_teacher_subject} ts ON ts.assignmentid = us.id
                WHERE us.userid = :userid
                  AND us.role = 'teacher'
                  AND us.classid = :classid
                  AND us.levelid = :levelid
                  AND ts.subject {$teachersubsql}";

if (!$DB->record_exists_sql($teachersql, $teacherparams)) {
    throw new required_capability_exception($context, 'moodle/course:manageactivities', 'nopermissions', '');
}

if ($action === 'submit' && confirm_sesskey()) {
    $content_id = required_param('content_id', PARAM_INT);
    $name = required_param('name', PARAM_TEXT);
    
    $content = $DB->get_record('istikama_content_bank', ['id' => $content_id], '*', MUST_EXIST);

    // Strict enforcement: only approved content in same subject + level can be inserted.
    if (($content->status ?? '') !== 'approved' ||
        !in_array((string)($content->subject ?? ''), $subjectkeys, true) ||
        !in_array((string)($content->level ?? ''), $levelkeys, true)) {
        throw new required_capability_exception($context, 'moodle/course:manageactivities', 'nopermissions', '');
    }
    
    // Determine the actual URL for this content
    $url = '';
    if (!empty($content->external_url)) {
        $url = $content->external_url;
    } else {
        // Point to the content bank file serving route (a lightweight handler or directly to pluginfile)
        $syscontext = context_system::instance();
        $url = moodle_url::make_pluginfile_url(
            $syscontext->id, 
            'local_istikama_admin', 
            'content', 
            $content->id, 
            '/', 
            $content->filename
        )->out(false);
    }

    // Create a URL module instance in the course
    $moduleid = $DB->get_field('modules', 'id', ['name' => 'url'], MUST_EXIST);
    
    $cmrec = new stdClass();
    $cmrec->course = $courseid;
    $cmrec->module = $moduleid;
    $cmrec->instance = 0;
    $cmrec->section = $sectionnum;
    $cmrec->added = time();
    $cmrec->visible = 1;
    $cmid = $DB->insert_record('course_modules', $cmrec);

    $urlrec = new stdClass();
    $urlrec->course = $courseid;
    $urlrec->name = $name;
    $urlrec->intro = $content->description;
    $urlrec->introformat = FORMAT_HTML;
    $urlrec->externalurl = $url;
    $urlrec->display = RESOURCELIB_DISPLAY_EMBED; // Auto-embeds PDFs, Videos, Images natively!
    $urlrec->parameters = serialize([]);
    $urlrec->timemodified = time();
    
    $urlid = $DB->insert_record('url', $urlrec);
    
    // Finalize linkage
    $DB->set_field('course_modules', 'instance', $urlid, ['id' => $cmid]);
    course_add_cm_to_section($courseid, $cmid, $sectionnum);
    
    // Ensure Moodle caches are rebuilt so the module appears immediately
    course_modinfo::clear_instance_cache($courseid);
    rebuild_course_cache($courseid, true);
    
    \core\notification::success('Content added to course successfully!');
    redirect(new moodle_url('/course/view.php', ['id' => $courseid]));
}

local_istikama_admin_print_header('Assign Content from Central Bank');

$contentid = optional_param('contentid', 0, PARAM_INT);
$specific_content = null;
$default_name = '';

if ($contentid) {
    $specific_content = $DB->get_record('istikama_content_bank', ['id' => $contentid]);
    if ($specific_content &&
        ($specific_content->status ?? '') === 'approved' &&
        in_array((string)($specific_content->subject ?? ''), $subjectkeys, true) &&
        in_array((string)($specific_content->level ?? ''), $levelkeys, true)) {
        $default_name = $specific_content->name;
    } else {
        $specific_content = null;
    }
} else {
    list($subjectsql, $subjectparams) = $DB->get_in_or_equal($subjectkeys, SQL_PARAMS_NAMED, 'sub');
    list($levelsql, $levelparams) = $DB->get_in_or_equal($levelkeys, SQL_PARAMS_NAMED, 'lvl');
    $params = ['status' => 'approved'];
    $params = array_merge($params, $subjectparams, $levelparams);

    $sql = "SELECT *
              FROM {istikama_content_bank}
             WHERE status = :status
               AND subject {$subjectsql}
               AND level {$levelsql}
          ORDER BY timecreated DESC";
    $approved_content = $DB->get_records_sql($sql, $params);
}
?>
<div class="istikama-assessment-form" style="max-width: 600px; margin: 0 auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
    <h4 style="margin-bottom:24px;">🔗 Insert Lesson Content</h4>
    <form method="post" action="add_from_bank.php">
        <input type="hidden" name="sesskey" value="<?php echo sesskey(); ?>">
        <input type="hidden" name="action" value="submit">
        <input type="hidden" name="courseid" value="<?php echo $courseid; ?>">
        <input type="hidden" name="sectionid" value="<?php echo $sectionid; ?>">
        
        <?php if ($specific_content): ?>
            <input type="hidden" name="content_id" value="<?php echo $specific_content->id; ?>">
            <div class="mb-4 p-3" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 6px;">
                <label class="form-label text-muted mb-1" style="font-size: 12px; text-transform: uppercase;">Selected Content Bank Item</label>
                <div style="font-weight: 600; font-size: 16px; display: flex; align-items: center;">
                    <span style="font-size: 24px; margin-right: 10px;">📚</span>
                    <?php echo format_string($specific_content->name); ?>
                </div>
                <div style="margin-top: 8px; font-size: 13px; color: #6c757d;">
                    Type: <strong style="text-transform: uppercase;"><?php echo $specific_content->content_type; ?></strong>
                </div>
            </div>
        <?php else: ?>
            <div class="mb-3">
                <label class="form-label" style="font-weight:600;">Choose Content <span class="text-danger">*</span></label>
                <select name="content_id" class="form-control" required style="padding:10px;" onchange="document.getElementById('cname').value = this.options[this.selectedIndex].text;">
                    <option value="">-- Select from Approved Content --</option>
                    <?php foreach ($approved_content as $c): ?>
                        <option value="<?php echo $c->id; ?>"><?php echo format_string($c->name); ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="form-text text-muted">Only approved items from the Central Bank are displayed.</div>
            </div>
        <?php endif; ?>
        
        <div class="mb-4">
            <label class="form-label" style="font-weight:600;">Display Name in Course <span class="text-danger">*</span></label>
            <input type="text" name="name" id="cname" class="form-control" required style="padding:10px;" value="<?php echo s($default_name); ?>" placeholder="e.g. Chapter 1 Lesson">
        </div>
        
        <div class="d-flex justify-content-between align-items-center" style="margin-top: 30px;">
            <a href="<?php echo (new moodle_url('/course/view.php', ['id' => $courseid]))->out(false); ?>" class="btn btn-outline-secondary" style="border-radius:6px; padding:8px 16px;">Cancel</a>
            <button type="submit" class="btn btn-primary" style="border-radius:6px; padding:8px 20px;">➕ Add to Lesson</button>
        </div>
    </form>
</div>
<?php

local_istikama_admin_print_footer();
