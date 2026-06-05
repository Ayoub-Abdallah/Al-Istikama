<?php
// This file is part of Moodle - http://moodle.org/
//
// AJAX endpoint for the Library / Content-Bank in-page modal.
// All responses are JSON. Endpoints accept POST with sesskey + action.

define('AJAX_SCRIPT', true);

require_once('../../config.php');
require_once(__DIR__ . '/locallib.php');

use local_istikama_admin\content_manager;

require_login();
require_sesskey();

// Only full_admin or school_manager can read/edit library moderation data.
local_istikama_admin_require_school_manager();

header('Content-Type: application/json; charset=utf-8');

$action = required_param('action', PARAM_ALPHAEXT);

try {
    switch ($action) {

        // -------------------------------------------------------------------
        // get_details — full content record + M:N + history + preview info
        // -------------------------------------------------------------------
        case 'get_details': {
            $id = required_param('id', PARAM_INT);
            $content = content_manager::get($id);
            if (!$content) {
                throw new \moodle_exception('invalidrecord', 'error', '', 'istikama_content_bank');
            }

            $levels    = content_manager::get_levels($id);
            $subjects  = content_manager::get_subjects($id);
            $history   = content_manager::get_status_history($id);
            $preview   = content_manager::build_preview($content);
            $catalog   = content_manager::get_known_levels_and_subjects();
            $statuses  = content_manager::get_statuses();

            // Format history for the UI.
            $historyout = [];
            foreach ($history as $h) {
                $historyout[] = [
                    'old_status'  => $h->old_status,
                    'new_status'  => $h->new_status,
                    'notes'       => $h->notes,
                    'changed_by'  => trim(($h->firstname ?? '') . ' ' . ($h->lastname ?? '')),
                    'timecreated' => (int)$h->timecreated,
                    'when'        => userdate($h->timecreated, get_string('strftimedatetimeshort', 'langconfig')),
                ];
            }

            $uploader = '';
            if (!empty($content->uploaded_by)) {
                $u = $DB->get_record('user', ['id' => $content->uploaded_by], 'firstname, lastname', IGNORE_MISSING);
                if ($u) { $uploader = trim(($u->firstname ?? '') . ' ' . ($u->lastname ?? '')); }
            }

            echo json_encode([
                'ok'       => true,
                'content'  => [
                    'id'           => (int)$content->id,
                    'name'         => $content->name,
                    'description'  => $content->description,
                    'keywords'     => $content->keywords ?? '',
                    'content_type' => $content->content_type,
                    'category'     => $content->category,
                    'external_url' => $content->external_url ?? '',
                    'filename'     => $content->filename ?? '',
                    'status'       => $content->status,
                    'uploader'     => $uploader,
                    'created'      => userdate($content->timecreated, get_string('strftimedatetimeshort', 'langconfig')),
                ],
                'levels'   => $levels,
                'subjects' => $subjects,
                'preview'  => $preview,
                'history'  => $historyout,
                'catalog'  => $catalog,
                'statuses' => array_map(fn($k, $m) => ['key' => $k, 'label' => $m['label']],
                                       array_keys($statuses), array_values($statuses)),
            ]);
            break;
        }

        // -------------------------------------------------------------------
        // save — atomic update of metadata + levels + subjects + status
        // -------------------------------------------------------------------
        case 'save': {
            $id          = required_param('id', PARAM_INT);
            $name        = optional_param('name', null, PARAM_TEXT);
            $description = optional_param('description', null, PARAM_RAW);
            $keywords    = optional_param('keywords', null, PARAM_TEXT);
            $extlink     = optional_param('external_url', null, PARAM_URL);
            $category    = optional_param('category', null, PARAM_ALPHAEXT);
            $newstatus   = optional_param('status', '', PARAM_ALPHAEXT);
            $statusnotes = optional_param('status_notes', '', PARAM_TEXT);
            $levels      = optional_param('levels', '', PARAM_RAW);     // JSON array of strings
            $subjects    = optional_param('subjects', '', PARAM_RAW);   // JSON array of strings

            // Metadata edit (only set the fields the client actually sent).
            $meta = [];
            if ($name        !== null) { $meta['name']         = trim($name); }
            if ($description !== null) { $meta['description']  = $description; }
            if ($keywords    !== null) { $meta['keywords']     = $keywords; }
            if ($extlink     !== null) { $meta['external_url'] = $extlink; }
            if ($category    !== null) { $meta['category']     = $category; }
            if (!empty($meta)) {
                content_manager::update_metadata($id, $meta);
            }

            // Levels (M:N) — only if a JSON array was supplied.
            if ($levels !== '') {
                $arr = json_decode($levels, true);
                if (is_array($arr)) {
                    content_manager::set_levels($id, $arr);
                }
            }

            // Subjects (M:N) — same shape.
            if ($subjects !== '') {
                $arr = json_decode($subjects, true);
                if (is_array($arr)) {
                    content_manager::set_subjects($id, $arr);
                }
            }

            // Status change (free transitions).
            if ($newstatus !== '' && content_manager::is_valid_status($newstatus)) {
                content_manager::change_status($id, $newstatus, $statusnotes);
            }

            echo json_encode(['ok' => true]);
            break;
        }

        default:
            throw new \moodle_exception('lib_unknown_action', 'local_istikama_admin');
    }
} catch (\Throwable $e) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}
