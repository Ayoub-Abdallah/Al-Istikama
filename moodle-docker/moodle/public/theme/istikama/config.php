<?php

defined('MOODLE_INTERNAL') || die();

$THEME->name = 'istikama';
$THEME->sheets = [];
$THEME->editor_sheets = [];
$THEME->parents = ['boost'];
$THEME->enable_dock = false;

// Inject custom CSS
$THEME->sheets = ['istikama-theme'];

// Define layout overrides.
$THEME->layouts = [
    'frontpage' => array(
        'file' => 'frontpage.php',
        'regions' => array('side-pre', 'side-post'),
        'defaultregion' => 'side-pre',
        'options' => array('nonavbar' => false),
    ),
    // Dashboard layout for Istikama admin pages.
    'admin' => array(
        'file' => 'dashboard.php',
        'regions' => array(),
        'defaultregion' => '',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    'standard' => array(
        'file' => 'dashboard.php',
        'regions' => array(),
        'defaultregion' => '',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    'mydashboard' => array(
        'file' => 'dashboard.php',
        'regions' => array(),
        'defaultregion' => '',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    // User profile page.
    'mypublic' => array(
        'file' => 'dashboard.php',
        'regions' => array(),
        'defaultregion' => '',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    // Base layout — catches question bank, quiz editing, etc.
    'base' => array(
        'file' => 'dashboard.php',
        'regions' => array(),
        'defaultregion' => '',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    // Course pages.
    'course' => array(
        'file' => 'dashboard.php',
        'regions' => array(),
        'defaultregion' => '',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    // In-course pages (activities, quiz view, etc.).
    'incourse' => array(
        'file' => 'dashboard.php',
        'regions' => array(),
        'defaultregion' => '',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    // Report pages.
    'report' => array(
        'file' => 'dashboard.php',
        'regions' => array(),
        'defaultregion' => '',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    // Course category browsing.
    'coursecategory' => array(
        'file' => 'dashboard.php',
        'regions' => array(),
        'defaultregion' => '',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    // My Courses page — student lesson list.
    'mycourses' => array(
        'file' => 'dashboard.php',
        'regions' => array(),
        'defaultregion' => '',
        'options' => array('nonavbar' => true, 'langmenu' => true),
    ),
    // Pages that appear in pop-up windows or iframes — no navigation, no blocks, no sidebar.
    'popup' => array(
        'file' => 'columns1.php',
        'regions' => array(),
        'options' => array(
            'nofooter' => true,
            'nonavbar' => true,
            'activityheader' => [
                'notitle' => true,
                'nocompletion' => true,
                'nodescription' => true,
            ],
        ),
    ),
    // Embedded pages (iframes, object embeds) — maximum content space.
    'embedded' => array(
        'file' => 'embedded.php',
        'regions' => array('side-pre'),
        'defaultregion' => 'side-pre',
    ),
    // Legacy frame layouts.
    'frametop' => array(
        'file' => 'columns1.php',
        'regions' => array(),
        'options' => array(
            'nofooter' => true,
            'nocoursefooter' => true,
            'activityheader' => [
                'nocompletion' => true,
            ],
        ),
    ),
    // Print layout — content only.
    'print' => array(
        'file' => 'columns1.php',
        'regions' => array(),
        'options' => array('nofooter' => true, 'nonavbar' => false, 'noactivityheader' => true),
    ),
    // Redirect layout — bare minimum.
    'redirect' => array(
        'file' => 'embedded.php',
        'regions' => array(),
    ),
];

$THEME->rendererfactory = 'theme_overridden_renderer_factory';

