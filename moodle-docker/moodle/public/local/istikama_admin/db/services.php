<?php
// This file is part of Moodle - http://moodle.org/

defined('MOODLE_INTERNAL') || die();

$functions = [
    'local_istikama_get_admin_menu' => [
        'classname'   => 'local_istikama_admin_external',
        'methodname'  => 'get_admin_menu',
        'classpath'   => 'local/istikama_admin/externallib.php',
        'description' => 'Get custom admin navbar links.',
        'type'        => 'read',
        'capabilities'=> 'local/istikama_admin:viewnavbar',
    ],
    'local_istikama_users_management' => [
        'classname'   => 'local_istikama_admin_external',
        'methodname'  => 'users_management',
        'classpath'   => 'local/istikama_admin/externallib.php',
        'description' => 'Get users management summary.',
        'type'        => 'read',
        'capabilities'=> 'local/istikama_admin:viewusers',
    ],
    'local_istikama_content_bank' => [
        'classname'   => 'local_istikama_admin_external',
        'methodname'  => 'content_bank',
        'classpath'   => 'local/istikama_admin/externallib.php',
        'description' => 'Get content bank status summary.',
        'type'        => 'read',
        'capabilities'=> 'local/istikama_admin:viewcontentbank',
    ],
    'local_istikama_reports_dashboard' => [
        'classname'   => 'local_istikama_admin_external',
        'methodname'  => 'reports_dashboard',
        'classpath'   => 'local/istikama_admin/externallib.php',
        'description' => 'Get reports KPI summary.',
        'type'        => 'read',
        'capabilities'=> 'local/istikama_admin:viewreports',
    ],
];
