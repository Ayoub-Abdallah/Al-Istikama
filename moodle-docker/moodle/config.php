<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype = getenv('MOODLE_DB_TYPE') ?: 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost = getenv('MOODLE_DB_HOST') ?: 'moodle_db';
$CFG->dbname = getenv('MOODLE_DB_NAME') ?: 'moodle';
$CFG->dbuser = getenv('MOODLE_DB_USER') ?: 'moodleuser';
$CFG->dbpass = getenv('MOODLE_DB_PASS') ?: 'moodlepass';
$CFG->prefix = 'mdl_';
$CFG->dboptions = array(
  'dbpersist' => 0,
  'dbport' => getenv('MOODLE_DB_PORT') ?: 3306,
  'dbsocket' => '',
  'dbcollation' => 'utf8mb4_0900_ai_ci',
);

$CFG->wwwroot = getenv('MOODLE_WWWROOT') ?: 'http://localhost:8080';
$CFG->dataroot = '/var/www/moodledata';
$CFG->admin = 'admin';

$CFG->directorypermissions = 0777;

$CFG->phpunit_prefix = "phpu_";
$CFG->phpunit_dataroot = "/var/www/phpunit_data";

require_once(__DIR__ . "/lib/setup.php");

$CFG->zend_exception_ignore_args = true;
$CFG->disablecomposervendorcheck = true;
