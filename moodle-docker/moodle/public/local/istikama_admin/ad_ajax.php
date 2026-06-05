<?php
/**
 * AJAX endpoint for advertisement interactions (dismiss / seen / click).
 *
 * Lightweight, sesskey-protected. Any logged-in user can record their own
 * interaction with an ad they were shown — no admin capability required.
 */
define('AJAX_SCRIPT', true);

require_once('../../config.php');
require_once(__DIR__ . '/classes/advertisement_manager.php');

use local_istikama_admin\advertisement_manager;

require_login();
require_sesskey();

global $USER;

header('Content-Type: application/json; charset=utf-8');

$action = required_param('action', PARAM_ALPHA);
$adid   = required_param('adid', PARAM_INT);

try {
    switch ($action) {
        case 'dismiss':
            advertisement_manager::mark($adid, (int)$USER->id, 'dismissed');
            echo json_encode(['ok' => true]);
            break;
        case 'seen':
            advertisement_manager::mark($adid, (int)$USER->id, 'seen');
            advertisement_manager::bump($adid, 'view');
            echo json_encode(['ok' => true]);
            break;
        case 'click':
            advertisement_manager::bump($adid, 'click');
            echo json_encode(['ok' => true]);
            break;
        default:
            echo json_encode(['ok' => false, 'error' => 'unknown action']);
    }
} catch (\Throwable $e) {
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}
