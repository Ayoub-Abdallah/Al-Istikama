<?php
// This file is part of Moodle - http://moodle.org/
//
// Compatibility shim — the canonical URL is now /local/istikama_admin/promotions.php.
// Kept so existing bookmarks and external links continue to work.

require_once('../../config.php');

$target = new moodle_url('/local/istikama_admin/promotions.php', $_GET);
redirect($target);
