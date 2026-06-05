<?php
// This file is part of Moodle - http://moodle.org/

defined('MOODLE_INTERNAL') || die();

/**
 * Serve files for local_istikama_admin plugin.
 *
 * @param stdClass $course
 * @param stdClass $cm
 * @param context $context
 * @param string $filearea
 * @param array $args
 * @param bool $forcedownload
 * @param array $options
 * @return bool
 */
function local_istikama_admin_pluginfile($course, $cm, $context, $filearea, $args, $forcedownload, array $options = []) {
    if ($context->contextlevel != CONTEXT_SYSTEM) {
        return false;
    }

    require_login();

    if (!in_array($filearea, ['content', 'schoollogo', 'support_ticket_attachment', 'advertisement_image'], true)) {
        return false;
    }

    $itemid = (int)array_shift($args);
    $filename = array_pop($args);
    $filepath = $args ? '/' . implode('/', $args) . '/' : '/';

    // Support ticket attachments: verify the viewer is permitted to see the ticket.
    if ($filearea === 'support_ticket_attachment') {
        // itemid is packed as ticketid * 100000 + messageid.
        $ticketid = (int)floor($itemid / 100000);
        if ($ticketid <= 0) { return false; }
        global $DB, $USER;
        $ticket = $DB->get_record('istikama_support_tickets', ['id' => $ticketid], '*', IGNORE_MISSING);
        if (!$ticket) { return false; }
        require_once(__DIR__ . '/classes/support_manager.php');
        if (!\local_istikama_admin\support_manager::user_can_view($ticket, (int)$USER->id)) {
            return false;
        }
    }

    $fs = get_file_storage();
    $file = $fs->get_file($context->id, 'local_istikama_admin', $filearea, $itemid, $filepath, $filename);

    if (!$file || $file->is_directory()) {
        return false;
    }

    send_stored_file($file, 0, 0, $forcedownload, $options);
    return true;
}
