<?php
/**
 * Student CSV import endpoint.
 *
 *  - ?action=template           → download a UTF-8 (BOM) CSV template.
 *  - POST action=import         → validate the uploaded CSV and return JSON.
 *                                 dryrun=1 (default) only validates + previews;
 *                                 dryrun=0 actually creates the student accounts.
 *
 * Columns (header row, order-independent, case-insensitive):
 *   firstname, lastname, fathername, grandfathername, gender, dob,
 *   studentid, email, username, password, status
 */

require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot . '/user/lib.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_full_admin();
$context = context_system::instance();

$action = optional_param('action', '', PARAM_ALPHA);

// Canonical column order used by the template and the parser.
$COLS = ['firstname', 'lastname', 'fathername', 'grandfathername', 'gender', 'dob',
         'studentid', 'email', 'username', 'password', 'status'];

// ── Template download ────────────────────────────────────────────────────────
if ($action === 'template') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="students_import_template.csv"');
    header('Pragma: no-cache');
    echo "\xEF\xBB\xBF";
    $q = static function (array $r): string {
        return implode(',', array_map(static function ($v) {
            return '"' . str_replace('"', '""', (string)$v) . '"';
        }, $r)) . "\r\n";
    };
    echo $q($COLS);
    echo $q(['Ahmed', 'Benali', 'Mohamed', 'Youcef', 'Male', '12/03/2012', 'STD-001', 'ahmed.benali@example.com', '', '', 'active']);
    echo $q(['Sara', 'Khelifi', 'Karim', 'Said', 'Female', '05/09/2013', 'STD-002', 'sara.khelifi@example.com', 'sara.khelifi', '', 'active']);
    exit;
}

// ── Import / preview (AJAX → JSON) ───────────────────────────────────────────
if ($action === 'import') {
    require_sesskey();
    header('Content-Type: application/json; charset=utf-8');

    $dryrun = (int)optional_param('dryrun', 1, PARAM_INT) === 1;

    $respond = static function (array $payload): void {
        echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        exit;
    };

    if (empty($_FILES['csvfile']) || ($_FILES['csvfile']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        $respond(['ok' => false, 'message' => get_string('import_err_nofile', 'local_istikama_admin')]);
    }

    $raw = file_get_contents($_FILES['csvfile']['tmp_name']);
    if ($raw === false || trim($raw) === '') {
        $respond(['ok' => false, 'message' => get_string('import_err_empty', 'local_istikama_admin')]);
    }
    // Strip UTF-8 BOM and normalise line endings.
    $raw = preg_replace('/^\xEF\xBB\xBF/', '', $raw);
    $raw = str_replace(["\r\n", "\r"], "\n", $raw);
    $lines = array_values(array_filter(explode("\n", $raw), static function ($l) { return trim($l) !== ''; }));
    if (count($lines) < 2) {
        $respond(['ok' => false, 'message' => get_string('import_err_norows', 'local_istikama_admin')]);
    }

    // Header → column index map.
    $header = array_map(static function ($h) { return strtolower(trim($h)); }, str_getcsv($lines[0]));
    $idx = array_flip($header);
    foreach (['firstname', 'lastname', 'email'] as $req) {
        if (!isset($idx[$req])) {
            $respond(['ok' => false, 'message' => get_string('import_err_missingcol', 'local_istikama_admin', $req)]);
        }
    }

    $get = static function (array $row, array $idx, string $key): string {
        return isset($idx[$key]) && isset($row[$idx[$key]]) ? trim((string)$row[$idx[$key]]) : '';
    };

    $studentroleid = (int)$DB->get_field('role', 'id', ['shortname' => 'student']);
    $profilefields = local_istikama_admin_student_profile_fields();
    $fieldids = [];
    foreach (array_keys($profilefields) as $sn) {
        $fieldids[$sn] = (int)$DB->get_field('user_info_field', 'id', ['shortname' => $sn]);
    }

    $results = [];
    $seenemails = [];
    $seenusernames = [];
    $okcount = 0; $errcount = 0; $created = 0;

    for ($i = 1; $i < count($lines); $i++) {
        $row = str_getcsv($lines[$i]);
        $line = $i + 1;
        $firstname = $get($row, $idx, 'firstname');
        $lastname  = $get($row, $idx, 'lastname');
        $email     = strtolower($get($row, $idx, 'email'));
        $username  = strtolower($get($row, $idx, 'username'));
        $password  = $get($row, $idx, 'password');
        $gender    = $get($row, $idx, 'gender');
        $dob       = $get($row, $idx, 'dob');
        $status    = strtolower($get($row, $idx, 'status')) ?: 'active';
        $errs = [];

        // Required.
        if ($firstname === '') { $errs[] = get_string('import_err_firstname', 'local_istikama_admin'); }
        if ($lastname === '')  { $errs[] = get_string('import_err_lastname', 'local_istikama_admin'); }
        if ($email === '' || !validate_email($email)) {
            $errs[] = get_string('import_err_email', 'local_istikama_admin');
        } else if (isset($seenemails[$email]) || $DB->record_exists_select('user', 'LOWER(email) = ? AND deleted = 0', [$email])) {
            $errs[] = get_string('import_err_emaildup', 'local_istikama_admin');
        }

        // Username: generate if blank.
        if ($username === '') {
            $base = clean_param(core_text::strtolower($firstname . '.' . $lastname), PARAM_USERNAME);
            $base = $base !== '' ? $base : 'student';
            $username = $base; $n = 1;
            while (isset($seenusernames[$username]) || $DB->record_exists('user', ['username' => $username, 'mnethostid' => $CFG->mnet_localhost_id])) {
                $username = $base . (++$n);
            }
        } else {
            $clean = clean_param($username, PARAM_USERNAME);
            if ($clean !== $username || $username === '') {
                $errs[] = get_string('import_err_username', 'local_istikama_admin');
            } else if (isset($seenusernames[$username]) || $DB->record_exists('user', ['username' => $username, 'mnethostid' => $CFG->mnet_localhost_id])) {
                $errs[] = get_string('import_err_usernamedup', 'local_istikama_admin');
            }
        }

        // Optional validations.
        if ($gender !== '' && !in_array(core_text::strtolower($gender), ['male', 'female', 'ذكر', 'أنثى', 'homme', 'femme'], true)) {
            $errs[] = get_string('import_err_gender', 'local_istikama_admin');
        }
        if ($dob !== '' && !preg_match('#^\d{1,2}/\d{1,2}/\d{4}$#', $dob)) {
            $errs[] = get_string('import_err_dob', 'local_istikama_admin');
        }

        $name = trim($firstname . ' ' . $lastname);
        if ($errs) {
            $errcount++;
            $results[] = ['line' => $line, 'name' => $name, 'email' => $email, 'status' => 'error', 'message' => implode(' · ', $errs)];
            continue;
        }

        $seenemails[$email] = true;
        $seenusernames[$username] = true;
        $okcount++;

        if (!$dryrun) {
            try {
                $newuser = new stdClass();
                $newuser->auth        = 'manual';
                $newuser->confirmed   = 1;
                $newuser->mnethostid  = $CFG->mnet_localhost_id;
                $newuser->username    = $username;
                $newuser->email       = $email;
                $newuser->firstname   = $firstname;
                $newuser->lastname    = $lastname;
                $newuser->password    = $password !== '' ? $password : generate_password(10);
                $newuser->suspended   = ($status === 'suspended' || $status === 'inactive') ? 1 : 0;
                $newuser->lang        = current_language();
                $uid = user_create_user($newuser, true, false);

                // Custom profile fields.
                $map = [
                    'istikamafathername'  => $get($row, $idx, 'fathername'),
                    'istikamagrandfather' => $get($row, $idx, 'grandfathername'),
                    'istikamastudentid'   => $get($row, $idx, 'studentid'),
                    'istikamadob'         => $dob,
                    'istikamagender'      => $gender !== '' ? ucfirst(core_text::strtolower($gender === 'ذكر' ? 'male' : ($gender === 'أنثى' ? 'female' : $gender))) : '',
                ];
                foreach ($map as $sn => $val) {
                    if ($val === '' || empty($fieldids[$sn])) { continue; }
                    $rec = (object)['userid' => $uid, 'fieldid' => $fieldids[$sn], 'data' => $val, 'dataformat' => 0];
                    $DB->insert_record('user_info_data', $rec);
                }

                // Assign the student role at system level.
                if ($studentroleid) {
                    role_assign($studentroleid, $uid, $context->id);
                }
                $created++;
                $results[] = ['line' => $line, 'name' => $name, 'email' => $email, 'status' => 'created', 'message' => $username];
            } catch (\Throwable $e) {
                $errcount++; $okcount--;
                $results[] = ['line' => $line, 'name' => $name, 'email' => $email, 'status' => 'error', 'message' => $e->getMessage()];
            }
        } else {
            $results[] = ['line' => $line, 'name' => $name, 'email' => $email, 'status' => 'ok', 'message' => $username];
        }
    }

    $respond([
        'ok'       => true,
        'dryrun'   => $dryrun,
        'total'    => count($results),
        'valid'    => $okcount,
        'invalid'  => $errcount,
        'created'  => $created,
        'rows'     => $results,
    ]);
}

// No valid action.
redirect(new moodle_url('/local/istikama_admin/users.php'));
