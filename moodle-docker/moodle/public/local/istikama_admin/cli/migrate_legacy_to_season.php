<?php
// This file is part of Moodle - http://moodle.org/
//
// CLI: assign a seasonid to all legacy (NULL-seasonid) rows in the five
// season-aware tables.
//
// USAGE
//   php cli/migrate_legacy_to_season.php --seasonid=<N> [--table=<name>|all] [--dry-run] [--yes]
//
// Examples:
//   php cli/migrate_legacy_to_season.php --seasonid=1 --dry-run
//   php cli/migrate_legacy_to_season.php --seasonid=1 --yes
//   php cli/migrate_legacy_to_season.php --seasonid=2 --table=istikama_attendance --yes

define('CLI_SCRIPT', true);

require(__DIR__ . '/../../../../config.php');
require_once($CFG->libdir . '/clilib.php');
require_once($CFG->dirroot . '/local/istikama_admin/locallib.php');

[$options, $unrecognised] = cli_get_params([
    'seasonid' => null,
    'table'    => 'all',
    'dry-run'  => false,
    'yes'      => false,
    'help'     => false,
], [
    'h' => 'help',
    'n' => 'dry-run',
    'y' => 'yes',
]);

if ($options['help']) {
    echo <<<EOT
Migrate legacy (seasonid IS NULL) rows to a chosen season.

Required:
  --seasonid=<N>       Target seasonid (must exist in istikama_season).

Optional:
  --table=<name>       One of: istikama_user_school | istikama_teacher_subject |
                       istikama_teacher_activities | istikama_attendance |
                       istikama_assessments | all   (default: all)
  --dry-run | -n       Show counts only, do not write.
  --yes | -y           Skip confirmation prompt.
  --help | -h          Show this help.

Examples:
  php cli/migrate_legacy_to_season.php --seasonid=1 --dry-run
  php cli/migrate_legacy_to_season.php --seasonid=1 --yes

EOT;
    exit(0);
}

if (!empty($unrecognised)) {
    cli_error('Unknown option(s): ' . implode(' ', $unrecognised));
}

$seasonid = (int)$options['seasonid'];
if ($seasonid <= 0) {
    cli_error('--seasonid=<N> is required and must be a positive integer.');
}

$season = \local_istikama_admin\season_manager::get($seasonid);
if (!$season) {
    cli_error("Season {$seasonid} does not exist in mdl_istikama_season.");
}

if (in_array($season->status, [
    \local_istikama_admin\season_manager::STATUS_ARCHIVED,
    \local_istikama_admin\season_manager::STATUS_CLOSED,
], true)) {
    cli_error("Refusing to backfill into an {$season->status} season. Use an active/upcoming/draft season.");
}

$alltables = [
    'istikama_user_school',
    'istikama_teacher_subject',
    'istikama_teacher_activities',
    'istikama_attendance',
    'istikama_assessments',
];

$tables = $options['table'] === 'all' ? $alltables : [$options['table']];
foreach ($tables as $t) {
    if (!in_array($t, $alltables, true)) {
        cli_error("Unknown table '$t'. Valid: " . implode(', ', $alltables) . ', all');
    }
}

cli_heading("Legacy -> Season backfill");
echo "Target season:  #{$season->id} {$season->name} ({$season->status})\n";
echo "Tables:         " . implode(', ', $tables) . "\n";
echo "Dry run:        " . ($options['dry-run'] ? 'yes' : 'NO (will write)') . "\n";
echo "\n";

$counts = [];
foreach ($tables as $t) {
    $counts[$t] = (int)$DB->count_records_select($t, 'seasonid IS NULL');
    echo sprintf("  %-32s legacy rows: %d\n", $t, $counts[$t]);
}
$grandtotal = array_sum($counts);
echo "\nTotal legacy rows to stamp: {$grandtotal}\n\n";

if ($grandtotal === 0) {
    echo "Nothing to do — no legacy rows found.\n";
    exit(0);
}

if ($options['dry-run']) {
    echo "Dry-run: no rows updated. Re-run without --dry-run to apply.\n";
    exit(0);
}

if (!$options['yes']) {
    echo "About to stamp {$grandtotal} rows with seasonid={$seasonid}. Proceed? [y/N]: ";
    $reply = trim(fread(STDIN, 4));
    if (strtolower($reply) !== 'y' && strtolower($reply) !== 'yes') {
        echo "Aborted.\n";
        exit(2);
    }
}

$transaction = $DB->start_delegated_transaction();
try {
    $updated = 0;
    foreach ($tables as $t) {
        if ($counts[$t] === 0) {
            continue;
        }
        $sql = "UPDATE {{$t}} SET seasonid = :sid WHERE seasonid IS NULL";
        $DB->execute($sql, ['sid' => $seasonid]);
        $updated += $counts[$t];
        echo "  $t: stamped {$counts[$t]} rows.\n";
    }
    $transaction->allow_commit();
    echo "\nDone. Total rows updated: {$updated}\n";
} catch (\Throwable $e) {
    $transaction->rollback($e);
    cli_error('Failed: ' . $e->getMessage());
}
