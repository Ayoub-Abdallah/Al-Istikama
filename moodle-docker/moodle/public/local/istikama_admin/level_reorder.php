<?php
// This file is part of Moodle - http://moodle.org/
//
// Minimal JSON endpoint that re-numbers istikama_global_level.order_index
// according to a client-supplied ordered list (per-tier).

define('AJAX_SCRIPT', true);

require_once('../../config.php');
require_once(__DIR__ . '/locallib.php');

require_login();
require_sesskey();
local_istikama_admin_require_full_admin();

header('Content-Type: application/json; charset=utf-8');

try {
    $tier = required_param('tier', PARAM_ALPHA);
    if (!in_array($tier, ['primary', 'middle', 'high'], true)) {
        throw new \moodle_exception('invalid_tier', 'local_istikama_admin');
    }

    $rawids = required_param('ids', PARAM_RAW);
    $ids = array_values(array_filter(array_map('intval', explode(',', $rawids)), function($v) { return $v > 0; }));
    if (empty($ids)) {
        throw new \moodle_exception('invalid_payload', 'local_istikama_admin');
    }

    // Validate every id belongs to the named tier — refuse cross-tier moves
    // (those go through a separate flow).
    [$insql, $params] = $DB->get_in_or_equal($ids, SQL_PARAMS_NAMED);
    $params['tier'] = $tier;
    $existing = $DB->get_records_sql_menu(
        "SELECT id, tier FROM {istikama_global_level} WHERE id $insql AND tier = :tier",
        $params
    );
    if (count($existing) !== count($ids)) {
        throw new \moodle_exception('level_reorder_cross_tier', 'local_istikama_admin');
    }

    // Renumber atomically.
    $transaction = $DB->start_delegated_transaction();
    try {
        $i = 1;
        $now = time();
        foreach ($ids as $id) {
            $DB->update_record('istikama_global_level', (object)[
                'id'           => $id,
                'order_index'  => $i,
                'timemodified' => $now,
            ]);
            $i++;
        }
        $transaction->allow_commit();
    } catch (\Throwable $e) {
        $transaction->rollback($e);
        throw $e;
    }

    echo json_encode(['ok' => true, 'count' => count($ids)]);
} catch (\Throwable $e) {
    http_response_code(400);
    echo json_encode(['ok' => false, 'error' => $e->getMessage()]);
}
