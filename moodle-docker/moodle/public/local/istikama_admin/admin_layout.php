<?php
defined('MOODLE_INTERNAL') || die();

// Outputs Moodle's required JS/CSS and HTML start
$PAGE->set_pagelayout('admin');
echo $OUTPUT->header();

// Strip site suffix (like " | Istikama") from the title
$cleantitle = format_string($PAGE->title);
if (strpos($cleantitle, '|') !== false) {
    $cleantitle = trim(explode('|', $cleantitle)[0]);
}

// Compact layout — minimal top spacing
echo '<div class="istikama-dashboard-container" style="padding: 0; width: 100%;">';
if (empty($isti_hide_page_header)) {
    echo '<div class="isti-page-header" style="margin-bottom: 16px; padding-top: 0;">';
    echo '<h1 class="isti-page-title" style="margin-top: 0; margin-bottom: 0;">' . $cleantitle . '</h1>';
    echo '</div>';
}
// Platform-wide warning when no season is active — actions are blocked.
if (function_exists('local_istikama_admin_active_season_id') && local_istikama_admin_active_season_id() === 0) {
    $seasonsurl = (new \moodle_url('/local/istikama_admin/seasons.php'))->out(false);
    echo '<div style="background:#fef3c7; border:1px solid #f59e0b; border-left-width:4px; color:#78350f; padding:12px 16px; border-radius:8px; margin-bottom:16px; display:flex; align-items:center; gap:12px;">'
        . '<i class="fa fa-exclamation-triangle" style="font-size:20px;"></i>'
        . '<div style="flex:1;">'
        . '<strong>' . get_string('no_active_season', 'local_istikama_admin') . '</strong><br>'
        . '<span style="font-size:13px;">' . get_string('no_active_season_help', 'local_istikama_admin') . '</span>'
        . '</div>'
        . '<a href="' . $seasonsurl . '" style="background:#f59e0b; color:white; padding:6px 14px; border-radius:6px; text-decoration:none; font-size:13px; font-weight:600;">'
        . get_string('manage_seasons', 'local_istikama_admin') . '</a>'
        . '</div>';
}

if (empty($isti_no_card_wrapper)) {
    echo '<div class="isti-card-modern" style="padding: 24px; min-height: 400px;">';
}
