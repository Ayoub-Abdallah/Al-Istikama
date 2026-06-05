<?php
/**
 * CLI script to grant all required capabilities to the Technical Professor role.
 * Run: php local/istikama_admin/cli/fix_techprof_caps.php
 */
define('CLI_SCRIPT', true);
require(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/clilib.php');

$roleid = $DB->get_field('role', 'id', ['shortname' => 'technicalprofessor']);
if (!$roleid) {
    cli_error('Role "technicalprofessor" not found.');
}

$systemcontextid = context_system::instance()->id;

// All capabilities the Technical Professor needs.
$capabilities = [
    // Question engine.
    'moodle/question:add',
    'moodle/question:editmine',
    'moodle/question:editall',
    'moodle/question:viewmine',
    'moodle/question:viewall',
    'moodle/question:usemine',
    'moodle/question:useall',
    'moodle/question:movemine',
    'moodle/question:moveall',
    'moodle/question:managecategory',
    'moodle/question:tagmine',
    'moodle/question:tagall',
    // Quiz module.
    'mod/quiz:view',
    'mod/quiz:addinstance',
    'mod/quiz:manage',
    'mod/quiz:preview',
    'mod/quiz:attempt',
    'mod/quiz:reviewmyattempts',
    'mod/quiz:deleteattempts',
    'mod/quiz:grade',
    'mod/quiz:viewreports',
    // Course management.
    'moodle/course:create',
    'moodle/course:update',
    'moodle/course:view',
    'moodle/course:viewhiddencourses',
    'moodle/course:viewparticipants',
    'moodle/course:enrolreview',
    'moodle/course:manageactivities',
    'moodle/course:managegroups',
    'moodle/course:ignoreavailabilityrestrictions',
    // Site-level access.
    'moodle/site:accessallgroups',
    'moodle/site:viewreports',
    'moodle/site:configview',
    'moodle/site:viewfullnames',
    // Categories.
    'moodle/category:viewhiddencategories',
    'moodle/category:manage',
    // Backup/restore.
    'moodle/backup:backupcourse',
    'moodle/restore:restorecourse',
    'moodle/restore:rolldates',
    // Content bank.
    'moodle/contentbank:access',
    'moodle/contentbank:upload',
    'moodle/contentbank:useeditor',
    'moodle/contentbank:manageanycontent',
    'moodle/contentbank:manageowncontent',
    'moodle/contentbank:copyanycontent',
    'moodle/contentbank:copycontent',
    'moodle/contentbank:deleteanycontent',
    'moodle/contentbank:downloadcontent',
    'moodle/contentbank:viewunlistedcontent',
    // H5P.
    'contenttype/h5p:access',
    'contenttype/h5p:upload',
    'contenttype/h5p:useeditor',
    // Reports.
    'report/outline:view',
    'report/progress:view',
    'report/stats:view',
    'report/completion:view',
    'gradereport/grader:view',
    'gradereport/overview:view',
    // Assign module (activities overview).
    'mod/assign:addinstance',
    'mod/assign:view',
    'mod/assign:grade',
    'mod/assign:viewgrades',
    // Lesson module.
    'mod/lesson:viewreports',
    // Repositories.
    'repository/contentbank:accesscoursecategorycontent',
    'repository/contentbank:accesscoursecontent',
    'repository/contentbank:accessgeneralcontent',
    'repository/contentbank:view',
    'repository/coursefiles:view',
    'repository/filesystem:view',
    'repository/local:view',
    'repository/webdav:view',
    // Upload courses.
    'tool/uploadcourse:use',
    // Istikama plugin.
    'local/istikama_admin:viewnavbar',
    'local/istikama_admin:viewcontentbank',
    'local/istikama_admin:managecontentbank',
    'local/istikama_admin:viewreports',
    'local/istikama_admin:viewsupport',
    'local/istikama_admin:viewschools',
];

$added = 0;
$skipped = 0;

foreach ($capabilities as $cap) {
    // Check if already assigned.
    $exists = $DB->record_exists('role_capabilities', [
        'roleid' => $roleid,
        'capability' => $cap,
        'contextid' => $systemcontextid,
    ]);
    if ($exists) {
        $skipped++;
        continue;
    }
    // Verify capability exists in the system.
    $capexists = $DB->record_exists('capabilities', ['name' => $cap]);
    if (!$capexists) {
        cli_writeln("WARNING: Capability '{$cap}' does not exist in this Moodle installation. Skipping.");
        continue;
    }
    $record = new stdClass();
    $record->contextid = $systemcontextid;
    $record->roleid = $roleid;
    $record->capability = $cap;
    $record->permission = CAP_ALLOW;
    $record->timemodified = time();
    $record->modifierid = 0;
    $DB->insert_record('role_capabilities', $record);
    $added++;
}

cli_writeln("Done. Added: {$added}, Already existed: {$skipped}");
cli_writeln("Now purge caches: php admin/cli/purge_caches.php");
