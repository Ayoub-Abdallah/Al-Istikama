<?php
// This file is part of Moodle - http://moodle.org/

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . '/externallib.php');
require_once(__DIR__ . '/locallib.php');

/**
 * External services for local_istikama_admin.
 */
class local_istikama_admin_external extends external_api {
    public static function get_admin_menu_parameters(): external_function_parameters {
        return new external_function_parameters([]);
    }

    public static function get_admin_menu(): array {
        global $CFG;

        self::validate_context(context_system::instance());
        local_istikama_admin_require_access('local/istikama_admin:viewnavbar');

        return [
            'dashboard' => (new moodle_url('/my/'))->out(false),
            'users' => (new moodle_url('/local/istikama_admin/users.php'))->out(false),
            'contentbank' => (new moodle_url('/local/istikama_admin/contentbank.php'))->out(false),
            'reports' => (new moodle_url('/local/istikama_admin/reports.php'))->out(false),
            'settings' => (new moodle_url('/admin/'))->out(false),
            'support' => (new moodle_url('/local/istikama_admin/support.php'))->out(false),
        ];
    }

    public static function get_admin_menu_returns(): external_single_structure {
        return new external_single_structure([
            'dashboard' => new external_value(PARAM_URL, 'Dashboard URL'),
            'users' => new external_value(PARAM_URL, 'Users URL'),
            'contentbank' => new external_value(PARAM_URL, 'Content bank URL'),
            'reports' => new external_value(PARAM_URL, 'Reports URL'),
            'settings' => new external_value(PARAM_URL, 'Settings URL'),
            'support' => new external_value(PARAM_URL, 'Support URL'),
        ]);
    }

    public static function users_management_parameters(): external_function_parameters {
        return new external_function_parameters([]);
    }

    public static function users_management(): array {
        global $DB;

        self::validate_context(context_system::instance());
        local_istikama_admin_require_access('local/istikama_admin:viewusers');

        return [
            'totalusers' => (int)$DB->count_records_select('user', 'deleted = 0 AND confirmed = 1'),
        ];
    }

    public static function users_management_returns(): external_single_structure {
        return new external_single_structure([
            'totalusers' => new external_value(PARAM_INT, 'Total active users'),
        ]);
    }

    public static function content_bank_parameters(): external_function_parameters {
        return new external_function_parameters([]);
    }

    public static function content_bank(): array {
        global $DB;

        self::validate_context(context_system::instance());
        local_istikama_admin_require_access('local/istikama_admin:viewcontentbank');

        if (!$DB->get_manager()->table_exists('istikama_content_bank')) {
            return ['pending' => 0, 'approved' => 0];
        }

        return [
            'pending' => (int)$DB->count_records('istikama_content_bank', ['status' => 'pending']),
            'approved' => (int)$DB->count_records('istikama_content_bank', ['status' => 'approved']),
        ];
    }

    public static function content_bank_returns(): external_single_structure {
        return new external_single_structure([
            'pending' => new external_value(PARAM_INT, 'Pending records'),
            'approved' => new external_value(PARAM_INT, 'Approved records'),
        ]);
    }

    public static function reports_dashboard_parameters(): external_function_parameters {
        return new external_function_parameters([]);
    }

    public static function reports_dashboard(): array {
        global $DB;

        self::validate_context(context_system::instance());
        local_istikama_admin_require_access('local/istikama_admin:viewreports');

        $activeusers = (int)$DB->count_records_select('user', 'deleted = 0 AND suspended = 0 AND lastaccess >= :cutoff', ['cutoff' => time() - 30 * DAYSECS]);
        $totalcourses = (int)$DB->count_records_select('course', 'id <> :siteid', ['siteid' => SITEID]);

        return [
            'activeusers' => $activeusers,
            'totalcourses' => $totalcourses,
        ];
    }

    public static function reports_dashboard_returns(): external_single_structure {
        return new external_single_structure([
            'activeusers' => new external_value(PARAM_INT, 'Active users in last 30 days'),
            'totalcourses' => new external_value(PARAM_INT, 'Total courses'),
        ]);
    }
}
