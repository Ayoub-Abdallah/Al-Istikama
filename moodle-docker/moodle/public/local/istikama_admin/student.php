<?php
// Redirect students to Moodle's native My Courses page.
require_once(__DIR__ . '/../../config.php');
require_login();
redirect(new moodle_url('/my/courses.php'));
