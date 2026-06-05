<?php
// This file is part of Moodle - http://moodle.org/
//
// Istikama admin tree integration.
//
// We register a top-level admin category ("istikamaacademic") BEFORE the
// core "users" / "courses" categories so that the platform's institutional
// concepts (seasons, levels, promotions, archives) feel like first-class
// administration — not buried under Local Plugins.
//
// Each sub-page is grouped into a logical sub-category so the tabbed
// admin UI renders a clean hierarchy.

defined('MOODLE_INTERNAL') || die();

if ($hassiteconfig) {

    // ─────────────────────────────────────────────────────────────────────
    // Top-level institutional category, inserted BEFORE 'users' in the
    // admin root tree. The third arg to admin_root::add() is the sibling
    // to position before.
    // ─────────────────────────────────────────────────────────────────────
    $ADMIN->add(
        'root',
        new admin_category(
            'istikamaacademic',
            new lang_string('admincat_academic', 'local_istikama_admin')
        ),
        'users'
    );

    // ─────────────────────────────────────────────────────────────────────
    // Sub-categories — order matches the user's expected flow:
    //   1. Seasons (the core temporal scope)
    //   2. Levels & Schools (the structural axis)
    //   3. Students (operational: enrollment, promotion)
    //   4. Archives & Reports (historical)
    //   5. Support
    // ─────────────────────────────────────────────────────────────────────
    $ADMIN->add('istikamaacademic', new admin_category(
        'istikamacat_seasons',
        new lang_string('admincat_seasons', 'local_istikama_admin')
    ));
    $ADMIN->add('istikamaacademic', new admin_category(
        'istikamacat_structure',
        new lang_string('admincat_structure', 'local_istikama_admin')
    ));
    $ADMIN->add('istikamaacademic', new admin_category(
        'istikamacat_students',
        new lang_string('admincat_students', 'local_istikama_admin')
    ));
    $ADMIN->add('istikamaacademic', new admin_category(
        'istikamacat_archives',
        new lang_string('admincat_archives', 'local_istikama_admin')
    ));
    $ADMIN->add('istikamaacademic', new admin_category(
        'istikamacat_operations',
        new lang_string('admincat_operations', 'local_istikama_admin')
    ));

    // ─────────────────────────────────────────────────────────────────────
    // 1) Seasons sub-category
    // ─────────────────────────────────────────────────────────────────────
    $ADMIN->add('istikamacat_seasons', new admin_externalpage(
        'local_istikama_admin_seasons',
        new lang_string('manage_seasons', 'local_istikama_admin'),
        new moodle_url('/local/istikama_admin/seasons.php'),
        'moodle/site:config'
    ));

    // ─────────────────────────────────────────────────────────────────────
    // 2) Structure sub-category (Schools + Levels + per-school enablement)
    // ─────────────────────────────────────────────────────────────────────
    $ADMIN->add('istikamacat_structure', new admin_externalpage(
        'local_istikama_admin_schools',
        new lang_string('manage_schools', 'local_istikama_admin'),
        new moodle_url('/local/istikama_admin/schools.php'),
        'moodle/site:config'
    ));
    $ADMIN->add('istikamacat_structure', new admin_externalpage(
        'local_istikama_admin_levels',
        new lang_string('manage_levels', 'local_istikama_admin'),
        new moodle_url('/local/istikama_admin/levels.php'),
        'moodle/site:config'
    ));

    // ─────────────────────────────────────────────────────────────────────
    // 3) Students sub-category (Users, Promotions)
    // ─────────────────────────────────────────────────────────────────────
    $ADMIN->add('istikamacat_students', new admin_externalpage(
        'local_istikama_admin_users',
        new lang_string('admin_users_management', 'local_istikama_admin'),
        new moodle_url('/local/istikama_admin/users.php'),
        'moodle/site:config'
    ));
    $ADMIN->add('istikamacat_students', new admin_externalpage(
        'local_istikama_admin_promotions',
        new lang_string('manage_promotions', 'local_istikama_admin'),
        new moodle_url('/local/istikama_admin/promotions.php'),
        'moodle/site:config'
    ));
    $ADMIN->add('istikamacat_students', new admin_externalpage(
        'local_istikama_admin_parent',
        new lang_string('admin_parent_dashboard', 'local_istikama_admin'),
        new moodle_url('/local/istikama_admin/parent.php'),
        'moodle/site:config'
    ));

    // ─────────────────────────────────────────────────────────────────────
    // 4) Archives / Reports sub-category
    // ─────────────────────────────────────────────────────────────────────
    $ADMIN->add('istikamacat_archives', new admin_externalpage(
        'local_istikama_admin_reports',
        new lang_string('admin_reports', 'local_istikama_admin'),
        new moodle_url('/local/istikama_admin/reports.php'),
        'moodle/site:config'
    ));
    $ADMIN->add('istikamacat_archives', new admin_externalpage(
        'local_istikama_admin_season_history',
        new lang_string('academic_history_title', 'local_istikama_admin'),
        new moodle_url('/local/istikama_admin/season_history.php'),
        'moodle/site:config'
    ));

    // ─────────────────────────────────────────────────────────────────────
    // 5) Operations sub-category (Content Bank, Support)
    // ─────────────────────────────────────────────────────────────────────
    $ADMIN->add('istikamacat_operations', new admin_externalpage(
        'local_istikama_admin_contentbank',
        new lang_string('admin_contentbank', 'local_istikama_admin'),
        new moodle_url('/local/istikama_admin/contentbank.php'),
        'moodle/site:config'
    ));
    $ADMIN->add('istikamacat_operations', new admin_externalpage(
        'local_istikama_admin_support',
        new lang_string('admin_tech_support', 'local_istikama_admin'),
        new moodle_url('/local/istikama_admin/support.php'),
        'moodle/site:config'
    ));
}
