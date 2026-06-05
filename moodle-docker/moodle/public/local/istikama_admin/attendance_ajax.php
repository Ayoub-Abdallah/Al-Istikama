<?php
/**
 * Attendance AJAX endpoint for the calendar-driven attendance manager.
 *
 *   action=month  classid, year, month   → per-day status summary for the month
 *   action=day    classid, date          → students + their record for that date
 *   action=save   classid, date, rows    → persist marks (JSON rows)
 *
 * Each row: { studentid, status(present|absent|late), excused(0|1), note }
 *   - late + excused=1  → late with a valid excuse
 *   - absent + excused=1 → absence justified (note brought later)
 */

define('AJAX_SCRIPT', true);
require_once(__DIR__ . '/../../config.php');
require_once(__DIR__ . '/locallib.php');

require_login();
require_sesskey();
header('Content-Type: application/json; charset=utf-8');

$action  = required_param('action', PARAM_ALPHA);
$classid = required_param('classid', PARAM_INT);

$fail = static function (string $msg): void {
    echo json_encode(['ok' => false, 'message' => $msg]);
    exit;
};
$ok = static function (array $data): void {
    echo json_encode(array_merge(['ok' => true], $data), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
};

// Access: the teacher must own the class (admins pass too inside the helper).
if (!local_istikama_admin_teacher_has_class($classid)) {
    $fail(get_string('accessdenied', 'admin'));
}

$VALID = ['present', 'absent', 'late'];

if ($action === 'month') {
    $year  = required_param('year', PARAM_INT);
    $month = required_param('month', PARAM_INT);
    $prefix = sprintf('%04d-%02d-', $year, $month);
    $recs = $DB->get_records_select('istikama_attendance',
        'classid = ? AND ' . $DB->sql_like('attend_date', '?'),
        [$classid, $prefix . '%'], '', 'id, attend_date, status, excused');
    $days = [];
    foreach ($recs as $r) {
        $d = $r->attend_date;
        if (!isset($days[$d])) { $days[$d] = ['present' => 0, 'absent' => 0, 'late' => 0, 'justified' => 0, 'total' => 0]; }
        if (isset($days[$d][$r->status])) { $days[$d][$r->status]++; }
        $days[$d]['total']++;
        if ((int)$r->excused === 1) { $days[$d]['justified']++; }
    }
    $ok(['days' => $days]);
}

if ($action === 'day') {
    $date = required_param('date', PARAM_TEXT);
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) { $fail('bad date'); }
    $students = local_istikama_admin_get_class_students($classid);
    $recs = [];
    foreach ($DB->get_records('istikama_attendance', ['classid' => $classid, 'attend_date' => $date]) as $r) {
        $recs[(int)$r->studentid] = $r;
    }
    $rows = [];
    foreach ($students as $s) {
        $rec = $recs[(int)$s->id] ?? null;
        $rows[] = [
            'studentid' => (int)$s->id,
            'name'      => fullname($s),
            'initial'   => core_text::strtoupper(core_text::substr($s->firstname, 0, 1)),
            'status'    => $rec ? $rec->status : '',
            'excused'   => $rec ? (int)$rec->excused : 0,
            'note'      => $rec ? (string)$rec->justify_note : '',
            'recorded'  => $rec ? 1 : 0,
        ];
    }
    $ok(['date' => $date, 'students' => $rows]);
}

if ($action === 'save') {
    $date = required_param('date', PARAM_TEXT);
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) { $fail('bad date'); }
    $rows = json_decode(required_param('rows', PARAM_RAW), true);
    if (!is_array($rows)) { $fail('bad rows'); }

    $seasonid = local_istikama_admin_resolve_write_seasonid();
    local_istikama_admin_guard_season_writes($seasonid);

    $valid = array_flip($VALID);
    $saved = 0;
    foreach ($rows as $row) {
        $sid    = (int)($row['studentid'] ?? 0);
        $status = (string)($row['status'] ?? '');
        if ($sid <= 0 || !isset($valid[$status])) { continue; }
        $excused = !empty($row['excused']) ? 1 : 0;
        $note    = core_text::substr(clean_param((string)($row['note'] ?? ''), PARAM_TEXT), 0, 255);

        $existing = $DB->get_record('istikama_attendance',
            ['studentid' => $sid, 'classid' => $classid, 'attend_date' => $date]);
        if ($existing) {
            if (!empty($existing->seasonid)) {
                local_istikama_admin_guard_season_writes((int)$existing->seasonid);
            }
            $existing->status       = $status;
            $existing->excused      = $excused;
            $existing->justify_note = $note;
            $existing->timemodified = time();
            $DB->update_record('istikama_attendance', $existing);
        } else {
            $DB->insert_record('istikama_attendance', (object)[
                'studentid'    => $sid,
                'classid'      => $classid,
                'attend_date'  => $date,
                'status'       => $status,
                'behavior_note' => '',
                'excused'      => $excused,
                'justify_note' => $note,
                'recorded_by'  => $USER->id,
                'seasonid'     => $seasonid ?: null,
                'timecreated'  => time(),
                'timemodified' => time(),
            ]);
        }
        $saved++;
    }
    $ok(['saved' => $saved]);
}

$fail('unknown action');
