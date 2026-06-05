<?php
// This file is part of Moodle - http://moodle.org/

namespace local_istikama_admin\task;

defined('MOODLE_INTERNAL') || die();

use local_istikama_admin\season_manager;

/**
 * Auto-close any active season whose end_date has passed.
 */
class auto_close_expired_seasons extends \core\task\scheduled_task {

    public function get_name(): string {
        return get_string('task_auto_close_seasons', 'local_istikama_admin');
    }

    public function execute(): void {
        $closed = season_manager::auto_close_expired();
        if ($closed > 0) {
            mtrace("istikama: auto-closed {$closed} expired season(s).");
        }
    }
}
