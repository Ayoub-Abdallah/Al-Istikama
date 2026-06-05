<?php
// Compatibility shim for Moodle 5.x
// These functions were removed in Moodle 5 but are still called by core code.
// We provide safe stubs that either redirect or return sane defaults.

defined('MOODLE_INTERNAL') || die();
global $CFG;
require_once($CFG->libdir . '/questionlib.php');

if (!defined('DEFAULT_QUESTIONS_PER_PAGE')) {
    define('DEFAULT_QUESTIONS_PER_PAGE', 20);
}
if (!defined('MAXIMUM_QUESTIONS_PER_PAGE')) {
    define('MAXIMUM_QUESTIONS_PER_PAGE', 1000);
}

/**
 * Stub for question_edit_setup - this function was removed in Moodle 5.
 * When called from mod/quiz/edit.php, we redirect to our simplified editor.
 * For other callers, we return the minimum viable data structure.
 */
if (!function_exists('question_edit_setup')) {
    function question_edit_setup($edittab, $baseurl, $requirequestioncap = true) {
        global $DB, $PAGE, $CFG;

        $cmid = optional_param('cmid', 0, PARAM_INT);

        // We no longer redirect to simple editor as per user request

        // For other callers, build minimum viable return array
        $cm = null;
        $course = null;
        if ($cmid) {
            $cm = get_coursemodule_from_id(null, $cmid, 0, false, MUST_EXIST);
            $course = $DB->get_record('course', ['id' => $cm->course], '*', MUST_EXIST);
            require_login($course, false, $cm);
        } else {
            $courseid = optional_param('courseid', 0, PARAM_INT);
            if ($courseid) {
                $course = $DB->get_record('course', ['id' => $courseid], '*', MUST_EXIST);
                require_login($course);
            }
        }

        $context = $cm ? context_module::instance($cm->id) : ($course ? context_course::instance($course->id) : context_system::instance());
        $contexts = new core_question\local\bank\question_edit_contexts($context);
        $thispageurl = new moodle_url($baseurl);
        if ($cmid) {
            $thispageurl->param('cmid', $cmid);
        }

        $defaultcategory = question_get_default_category($context->id, true);
        $qperpage = optional_param('qperpage', DEFAULT_QUESTIONS_PER_PAGE, PARAM_INT);
        if ($qperpage <= 0) {
            $qperpage = DEFAULT_QUESTIONS_PER_PAGE;
        }
        if ($qperpage > MAXIMUM_QUESTIONS_PER_PAGE) {
            $qperpage = MAXIMUM_QUESTIONS_PER_PAGE;
        }

        $pagevars = [
            'tabname' => $edittab,
            'cat' => $defaultcategory->id . ',' . $context->id,
            'qpage' => optional_param('qpage', 0, PARAM_INT),
            'qperpage' => $qperpage,
        ];

        $module = $cm ? $DB->get_record($cm->modname, ['id' => $cm->instance]) : null;
        return [$thispageurl, $contexts, $cmid, $cm, $module, $pagevars];
    }
}

/**
 * Stub for question_get_category_id_from_pagevars
 */
if (!function_exists('question_get_category_id_from_pagevars')) {
    function question_get_category_id_from_pagevars($pagevars) {
        if (!empty($pagevars['cat'])) {
            $parts = explode(',', $pagevars['cat']);
            return (int) $parts[0];
        }
        return 0;
    }
}

/**
 * Stub for question_build_edit_resources - also removed in Moodle 5.
 */
if (!function_exists('question_build_edit_resources')) {
    function question_build_edit_resources($edittab, $baseurl, $params = []) {
        $cmid = $params['cmid'] ?? optional_param('cmid', 0, PARAM_INT);
        $_GET['cmid'] = $cmid; // Ensure it's available for question_edit_setup
        return question_edit_setup($edittab, $baseurl);
    }
}

/**
 * Stub for question_get_default_category if missing.
 */
if (!function_exists('question_get_default_category')) {
    // It should exist via questionlib.php, but just in case
}

/**
 * Compatibility wrapper for question preference APIs expected by qbank plugins.
 *
 * @param string $name
 * @param mixed|null $value
 * @param mixed $default
 * @param moodle_url|null $url
 * @return mixed
 */
if (!function_exists('question_set_or_get_user_preference')) {
    function question_set_or_get_user_preference($name, $value = null, $default = 0, $url = null) {
        if ($value !== null) {
            set_user_preference($name, $value);
        }
        return get_user_preferences($name, $default);
    }
}

/**
 * Compatibility wrapper for question text display preference reads.
 *
 * @param string $name
 * @param mixed $default
 * @param string $type
 * @param moodle_url|null $url
 * @return mixed
 */
if (!function_exists('question_get_display_preference')) {
    function question_get_display_preference($name, $default = 0, $type = PARAM_RAW, $url = null) {
        $value = question_set_or_get_user_preference($name, null, $default, $url);
        return clean_param($value, $type);
    }
}

/**
 * Compatibility helper: get module instance and cm record from a cmid.
 *
 * @param int $cmid
 * @return array{0:stdClass,1:stdClass}
 */
if (!function_exists('get_module_from_cmid')) {
    function get_module_from_cmid($cmid) {
        global $DB;

        $cmid = clean_param($cmid, PARAM_INT);
        if (empty($cmid)) {
            throw new moodle_exception('invalidcoursemodule');
        }

        $cm = get_coursemodule_from_id('', $cmid, 0, false, MUST_EXIST);
        $module = $DB->get_record($cm->modname, ['id' => $cm->instance], '*', MUST_EXIST);

        return [$module, $cm];
    }
}
