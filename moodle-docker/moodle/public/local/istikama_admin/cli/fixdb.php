<?php
define('CLI_SCRIPT', true);
require(__DIR__ . '/../../../../config.php');
global $DB;
$DB->delete_records('task_adhoc', ['component' => 'mod_qbank']);
echo "Deleted stale mod_qbank adhoc tasks.\n";
