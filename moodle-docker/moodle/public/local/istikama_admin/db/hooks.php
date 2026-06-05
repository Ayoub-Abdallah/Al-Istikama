<?php
// This file is part of Moodle - http://moodle.org/

defined('MOODLE_INTERNAL') || die();

$callbacks = [
    [
        'hook' => 'core\\hook\\navigation\\primary_extend',
        'callback' => 'local_istikama_admin\\hooks::extend_primary_navigation',
        'priority' => 900,
    ],
    [
        'hook' => 'core\\hook\\output\\before_standard_head_html_generation',
        'callback' => 'local_istikama_admin\\hooks::before_standard_head_html_generation',
        'priority' => 900,
    ],
    [
        'hook' => 'core\\hook\\output\\before_standard_top_of_body_html_generation',
        'callback' => 'local_istikama_admin\\hooks::before_standard_top_of_body_html_generation',
        'priority' => 900,
    ],
    [
        'hook' => 'core\\hook\\after_config',
        'callback' => 'local_istikama_admin\\hooks::after_config',
        'priority' => 900,
    ],
];
