<?php
/**
 * Parent Dashboard — Single Entry Point
 *
 * Sections: children (default), child (child dashboard with tabs)
 * ALL data is READ-ONLY. No write operations are exposed.
 *
 * @package    local_istikama_admin
 */
require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir . '/gradelib.php');
require_once(__DIR__ . '/locallib.php');

require_login();
local_istikama_admin_require_parent();

global $DB, $USER, $PAGE, $OUTPUT;

$section = optional_param('section', 'children', PARAM_ALPHAEXT);
$childid = optional_param('childid', 0, PARAM_INT);
$tab     = optional_param('tab', 'overview', PARAM_ALPHAEXT);

// Resolve which season's data the parent is viewing.
$viewseasonid = local_istikama_admin_resolve_view_seasonid();

$context = context_system::instance();
$baseurl = new moodle_url('/local/istikama_admin/parent.php');

// Security: validate child ownership.
if ($section === 'child' && $childid) {
    if (!local_istikama_admin_parent_owns_child((int)$USER->id, $childid)) {
        throw new \moodle_exception('nopermissions', 'error', '', get_string('parent_access_denied', 'local_istikama_admin'));
    }
}

$sectiontitles = [
    'children' => get_string('parent_my_children', 'local_istikama_admin'),
    'child'    => get_string('parent_child_dashboard', 'local_istikama_admin'),
];
$pagetitle = $sectiontitles[$section] ?? $sectiontitles['children'];

$PAGE->set_url(new moodle_url('/local/istikama_admin/parent.php', ['section' => $section]));
$PAGE->set_context($context);
$PAGE->set_pagelayout('base');
$PAGE->set_title($pagetitle);
$PAGE->requires->css('/local/istikama_admin/styles/istikama_admin.css?v=8');

local_istikama_admin_print_header($pagetitle);

$dir = right_to_left() ? 'rtl' : 'ltr';

// ═══════════════════════════════════════════════════════════
// SECTION: CHILDREN LISTING
// ═══════════════════════════════════════════════════════════
if ($section === 'children') {
    $children = local_istikama_admin_get_parent_children();
    ?>
    <div dir="<?= $dir ?>">

      <div style="margin-bottom:24px">
        <h5 style="margin:0 0 4px;font-weight:700;color:#1e293b;font-size:1.1rem">
          <i class="fa fa-users" style="color:#006bff;margin-right:8px"></i>
          <?= get_string('parent_my_children', 'local_istikama_admin') ?>
        </h5>
        <div style="font-size:.83rem;color:#64748b"><?= count($children) ?> child<?= count($children) !== 1 ? 'ren' : '' ?> linked to your account</div>
      </div>

      <?php if (empty($children)): ?>
      <div style="text-align:center;padding:72px 20px;color:#94a3b8">
        <i class="fa fa-child" style="font-size:3rem;display:block;margin-bottom:16px;color:#cbd5e1"></i>
        <h3 style="font-size:1rem;font-weight:600;color:#475569;margin-bottom:8px"><?= get_string('parent_no_children', 'local_istikama_admin') ?></h3>
        <p style="font-size:.85rem;max-width:340px;margin:0 auto;color:#94a3b8">
          No children have been linked to your account yet. Please contact the school administrator.
        </p>
      </div>

      <?php else: ?>
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px">
        <?php foreach ($children as $child):
            $userpicobj = new \user_picture($child);
            $userpicobj->size = 100;
            $picurl = $userpicobj->get_url($PAGE);
            $childurl = (new moodle_url('/local/istikama_admin/parent.php', ['section' => 'child', 'childid' => $child->id]))->out(false);
            $lastaccessstr = $child->lastaccess
                ? userdate($child->lastaccess, get_string('strftimedatetimeshort', 'langconfig'))
                : 'Never';

            // Quick stats.
            $coursect = count(enrol_get_users_courses($child->id, true));
            $quizct   = (int)$DB->count_records_sql(
                "SELECT COUNT(*) FROM {quiz_attempts} WHERE userid = :uid AND state = 'finished'",
                ['uid' => $child->id]
            );
        ?>
        <a href="<?= $childurl ?>"
           style="display:flex;flex-direction:column;background:#fff;border:2px solid #e2e8f0;border-radius:14px;
                  padding:20px;text-decoration:none;color:inherit;
                  transition:border-color .15s,box-shadow .15s,transform .12s"
           onmouseover="this.style.borderColor='#006bff';this.style.boxShadow='0 4px 16px rgba(0,0,0,.08)';this.style.transform='translateY(-2px)'"
           onmouseout="this.style.borderColor='#e2e8f0';this.style.boxShadow='';this.style.transform=''">

          <!-- Avatar + name -->
          <div style="display:flex;align-items:center;gap:14px;margin-bottom:14px">
            <img src="<?= $picurl ?>" alt="" style="width:52px;height:52px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0;flex-shrink:0">
            <div>
              <div style="font-weight:700;font-size:.95rem;color:#1e293b"><?= fullname($child) ?></div>
              <?php if ($child->classname): ?>
              <div style="font-size:.78rem;color:#64748b;margin-top:2px">
                <i class="fa fa-chalkboard" style="color:#8b5cf6;margin-right:3px"></i><?= format_string($child->classname) ?>
              </div>
              <?php endif; ?>
            </div>
          </div>

          <!-- School / level breadcrumb -->
          <?php if ($child->schoolname || $child->levelname): ?>
          <div style="font-size:.78rem;color:#94a3b8;margin-bottom:14px;display:flex;gap:6px;align-items:center;flex-wrap:wrap">
            <?php if ($child->schoolname): ?>
              <i class="fa fa-university" style="color:#006bff"></i>
              <span><?= format_string($child->schoolname) ?></span>
            <?php endif; ?>
            <?php if ($child->levelname): ?>
              <span style="color:#e2e8f0">›</span>
              <span><?= format_string($child->levelname) ?></span>
            <?php endif; ?>
          </div>
          <?php endif; ?>

          <!-- Mini stats -->
          <div style="display:flex;gap:12px;margin-bottom:14px">
            <div style="flex:1;text-align:center;background:#f0f7ff;border-radius:8px;padding:8px 4px">
              <div style="font-weight:700;font-size:1rem;color:#006bff"><?= $coursect ?></div>
              <div style="font-size:.7rem;color:#64748b">Lessons</div>
            </div>
            <div style="flex:1;text-align:center;background:#f0fdf4;border-radius:8px;padding:8px 4px">
              <div style="font-weight:700;font-size:1rem;color:#10b981"><?= $quizct ?></div>
              <div style="font-size:.7rem;color:#64748b">Attempts</div>
            </div>
          </div>

          <!-- Last access -->
          <div style="font-size:.75rem;color:#94a3b8;margin-top:auto;padding-top:10px;border-top:1px solid #f1f5f9">
            <i class="fa fa-clock" style="margin-right:4px"></i> Last access: <?= $lastaccessstr ?>
          </div>

          <!-- CTA -->
          <div style="margin-top:12px;text-align:right;font-size:.78rem;font-weight:600;color:#006bff">
            View Dashboard <i class="fa fa-arrow-right" style="margin-left:3px;font-size:.7rem"></i>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>
    </div>
    <?php
}

// ═══════════════════════════════════════════════════════════
// SECTION: CHILD DASHBOARD
// ═══════════════════════════════════════════════════════════
if ($section === 'child' && $childid) {
    $child   = $DB->get_record('user', ['id' => $childid, 'deleted' => 0], '*', MUST_EXIST);
    $courses = enrol_get_users_courses($childid, true, 'id,fullname,shortname,startdate,enddate,visible', 'fullname ASC');
    // Exclude site front page and helper courses.
    $courses = array_filter($courses, function($c) {
        return $c->id > 1 && stripos($c->fullname, 'question bank') === false;
    });

    // Child profile data.
    $userschool = $DB->get_record('istikama_user_school', ['userid' => $childid, 'role' => 'student'], '*', IGNORE_MULTIPLE);
    $schoolname = $levelname = $classname = '';
    if ($userschool) {
        if (!empty($userschool->schoolid)) {
            $cat = $DB->get_record('course_categories', ['id' => $userschool->schoolid], 'name');
            $schoolname = $cat ? format_string($cat->name) : '';
        }
        if (!empty($userschool->levelid)) {
            $cat = $DB->get_record('course_categories', ['id' => $userschool->levelid], 'name');
            $levelname = $cat ? format_string($cat->name) : '';
        }
        if (!empty($userschool->classid)) {
            $cat = $DB->get_record('course_categories', ['id' => $userschool->classid], 'name');
            $classname = $cat ? format_string($cat->name) : '';
        }
    }

    $userpicobj = new \user_picture($child);
    $userpicobj->size = 100;
    $picurl = $userpicobj->get_url($PAGE);
    ?>
    <div dir="<?= $dir ?>">

    <!-- ── Back + child identity ── -->
    <div style="display:flex;align-items:center;gap:12px;margin-bottom:22px;flex-wrap:wrap">
      <a href="<?= $baseurl->out(false) ?>" class="isti-btn isti-btn-outline" style="white-space:nowrap">
        <i class="fa fa-arrow-left"></i> Back
      </a>
      <img src="<?= $picurl ?>" alt="" style="width:44px;height:44px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0">
      <div>
        <div style="font-weight:700;font-size:1.05rem;color:#1e293b"><?= fullname($child) ?></div>
        <div style="font-size:.78rem;color:#64748b;display:flex;gap:6px;flex-wrap:wrap;margin-top:2px">
          <?php if ($schoolname): ?><span><i class="fa fa-university" style="color:#006bff"></i> <?= $schoolname ?></span><?php endif; ?>
          <?php if ($levelname): ?><span style="color:#cbd5e1">›</span><span><?= $levelname ?></span><?php endif; ?>
          <?php if ($classname): ?><span style="color:#cbd5e1">›</span><span style="font-weight:600;color:#1e293b"><?= $classname ?></span><?php endif; ?>
        </div>
      </div>
    </div>

    <!-- ── Tab navigation ── -->
    <?php
    $tabs = [
        'overview'    => ['icon' => 'fa-tachometer-alt', 'label' => 'Overview'],
        'assessments' => ['icon' => 'fa-clipboard-check', 'label' => 'Assessments'],
        'learning'    => ['icon' => 'fa-book-open', 'label' => 'Lessons'],
        'activity'    => ['icon' => 'fa-chart-line', 'label' => 'Activity'],
    ];
    ?>
    <div style="display:flex;gap:4px;border-bottom:2px solid #e2e8f0;margin-bottom:24px;overflow-x:auto">
      <?php foreach ($tabs as $k => $t): ?>
      <a href="<?= (new moodle_url('/local/istikama_admin/parent.php', ['section' => 'child', 'childid' => $childid, 'tab' => $k]))->out(false) ?>"
         style="display:inline-flex;align-items:center;gap:6px;padding:10px 16px;font-size:.85rem;font-weight:600;
                text-decoration:none;white-space:nowrap;border-bottom:2px solid transparent;margin-bottom:-2px;
                <?= $tab === $k ? 'color:#006bff;border-bottom-color:#006bff;background:rgba(0,107,255,.04)' : 'color:#64748b' ?>;
                border-radius:6px 6px 0 0;transition:all .15s">
        <i class="fa <?= $t['icon'] ?>"></i><?= $t['label'] ?>
      </a>
      <?php endforeach; ?>
    </div>

    <?php
    // ────────────────────────────────────────────────────────
    // TAB: OVERVIEW
    // ────────────────────────────────────────────────────────
    if ($tab === 'overview'):

        // KPI data.
        $coursecount = count($courses);

        // Quiz attempts total + best average.
        $quiz_attempts_total = 0;
        $quiz_scores = [];
        foreach ($courses as $course) {
            $quizzes = $DB->get_records('quiz', ['course' => $course->id], '', 'id,sumgrades');
            foreach ($quizzes as $q) {
                $cnt = $DB->count_records('quiz_attempts', ['quiz' => $q->id, 'userid' => $childid, 'state' => 'finished']);
                $quiz_attempts_total += $cnt;
                $best = $DB->get_field_sql(
                    "SELECT MAX(sumgrades) FROM {quiz_attempts} WHERE quiz=:qid AND userid=:uid AND state='finished'",
                    ['qid' => $q->id, 'uid' => $childid]
                );
                if ($best !== false && $best !== null && $q->sumgrades > 0) {
                    $quiz_scores[] = round(($best / $q->sumgrades) * 100, 1);
                }
            }
        }
        $avg_score = !empty($quiz_scores) ? round(array_sum($quiz_scores) / count($quiz_scores), 1) : null;

        // Attendance rate (season-scoped).
        [$swhere_p, $sparams_p] = local_istikama_admin_season_where_sql($viewseasonid);
        $base_p = array_merge(['sid' => $childid], $sparams_p);
        $att_total   = (int)$DB->count_records_sql(
            "SELECT COUNT(1) FROM {istikama_attendance} WHERE studentid = :sid $swhere_p", $base_p);
        $att_present = (int)$DB->count_records_sql(
            "SELECT COUNT(1) FROM {istikama_attendance} WHERE studentid = :sid AND status = 'present' $swhere_p", $base_p);
        $att_rate    = $att_total > 0 ? round(($att_present / $att_total) * 100) : null;

        // Activity last 30 days.
        $since = time() - (30 * DAYSECS);
        $activity30 = 0;
        try {
            $activity30 = (int)$DB->count_records_sql(
                "SELECT COUNT(*) FROM {logstore_standard_log} WHERE userid=:uid AND timecreated>:since AND action='viewed'",
                ['uid' => $childid, 'since' => $since]
            );
        } catch (\Exception $e) {}

        // Last login.
        $lastloginstr = $child->lastaccess ? userdate($child->lastaccess, get_string('strftimedatetimeshort', 'langconfig')) : 'Never';
    ?>

    <!-- KPI grid -->
    <div class="isti-kpi-grid" style="margin-bottom:28px">
      <div class="isti-kpi-card">
        <div class="isti-kpi-content">
          <span class="isti-kpi-label">Enrolled Lessons</span>
          <span class="isti-kpi-value"><?= $coursecount ?></span>
        </div>
        <div class="isti-kpi-icon blue"><i class="fa fa-book-open"></i></div>
      </div>
      <div class="isti-kpi-card">
        <div class="isti-kpi-content">
          <span class="isti-kpi-label">Quiz Attempts</span>
          <span class="isti-kpi-value"><?= $quiz_attempts_total ?></span>
        </div>
        <div class="isti-kpi-icon green"><i class="fa fa-clipboard-check"></i></div>
      </div>
      <div class="isti-kpi-card">
        <div class="isti-kpi-content">
          <span class="isti-kpi-label">Avg. Quiz Score</span>
          <span class="isti-kpi-value"><?= $avg_score !== null ? $avg_score . '%' : '—' ?></span>
        </div>
        <div class="isti-kpi-icon amber"><i class="fa fa-star"></i></div>
      </div>
      <?php if ($att_rate !== null): ?>
      <div class="isti-kpi-card">
        <div class="isti-kpi-content">
          <span class="isti-kpi-label">Attendance Rate</span>
          <span class="isti-kpi-value"><?= $att_rate ?>%</span>
        </div>
        <div class="isti-kpi-icon <?= $att_rate >= 80 ? 'green' : ($att_rate >= 60 ? 'amber' : 'red') ?>">
          <i class="fa fa-calendar-check"></i>
        </div>
      </div>
      <?php else: ?>
      <div class="isti-kpi-card">
        <div class="isti-kpi-content">
          <span class="isti-kpi-label">Activity (30d)</span>
          <span class="isti-kpi-value"><?= $activity30 ?></span>
        </div>
        <div class="isti-kpi-icon purple"><i class="fa fa-mouse-pointer"></i></div>
      </div>
      <?php endif; ?>
    </div>

    <!-- Two-column: recent quiz attempts + enrolled lessons -->
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px">

      <!-- Recent quiz attempts -->
      <div class="isti-card-modern">
        <div class="isti-card-modern-header">
          <h3 class="isti-card-modern-title"><i class="fa fa-clipboard-check"></i> Recent Quiz Attempts</h3>
        </div>
        <div class="isti-card-modern-body" style="padding:0">
          <?php
          $recent_attempts = [];
          foreach ($courses as $course) {
              $quizzes = $DB->get_records('quiz', ['course' => $course->id], '', 'id,name,sumgrades');
              foreach ($quizzes as $q) {
                  $atts = $DB->get_records('quiz_attempts',
                      ['quiz' => $q->id, 'userid' => $childid, 'state' => 'finished'],
                      'timefinish DESC', '*', 0, 3
                  );
                  foreach ($atts as $a) {
                      $a->quizname  = format_string($q->name);
                      $a->maxgrade  = $q->sumgrades;
                      $a->coursename = format_string($course->fullname);
                      $recent_attempts[] = $a;
                  }
              }
          }
          usort($recent_attempts, fn($a, $b) => $b->timefinish - $a->timefinish);
          $recent_attempts = array_slice($recent_attempts, 0, 6);
          ?>
          <?php if (empty($recent_attempts)): ?>
          <div style="padding:20px;text-align:center;color:#94a3b8;font-size:.85rem">No quiz attempts yet.</div>
          <?php else: ?>
          <table class="isti-table">
            <thead><tr>
              <th>Quiz</th><th>Score</th><th>Date</th>
            </tr></thead>
            <tbody>
              <?php foreach ($recent_attempts as $a):
                  $scorestr = $a->sumgrades !== null
                      ? round($a->sumgrades, 1) . ' / ' . round($a->maxgrade, 1)
                      : '—';
                  $pct = ($a->maxgrade > 0 && $a->sumgrades !== null)
                      ? round(($a->sumgrades / $a->maxgrade) * 100) : 0;
                  $badgecls = $pct >= 70 ? 'isti-badge-success' : ($pct >= 40 ? 'isti-badge-warning' : 'isti-badge-danger');
              ?>
              <tr>
                <td><div style="font-weight:600;color:#1e293b"><?= $a->quizname ?></div>
                    <div style="font-size:.75rem;color:#94a3b8"><?= $a->coursename ?></div></td>
                <td><span class="isti-badge <?= $badgecls ?>"><?= $scorestr ?></span></td>
                <td style="font-size:.8rem;color:#64748b"><?= userdate($a->timefinish, '%d %b') ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <?php endif; ?>
        </div>
      </div>

      <!-- Enrolled lessons -->
      <div class="isti-card-modern">
        <div class="isti-card-modern-header">
          <h3 class="isti-card-modern-title"><i class="fa fa-book-open"></i> Enrolled Lessons</h3>
        </div>
        <div class="isti-card-modern-body" style="padding:0">
          <?php if (empty($courses)): ?>
          <div style="padding:20px;text-align:center;color:#94a3b8;font-size:.85rem">No lessons enrolled.</div>
          <?php else: ?>
          <table class="isti-table">
            <thead><tr><th>Subject</th><th>Status</th></tr></thead>
            <tbody>
              <?php foreach ($courses as $course):
                  $cinfo = new \completion_info($course);
                  $done  = $cinfo->is_enabled() && $cinfo->is_course_complete($childid);
              ?>
              <tr>
                <td style="font-weight:600;color:#1e293b"><?= format_string($course->fullname) ?></td>
                <td>
                  <?php if ($done): ?>
                  <span class="isti-badge isti-badge-success"><i class="fa fa-check"></i> Done</span>
                  <?php else: ?>
                  <span class="isti-badge isti-badge-neutral">In Progress</span>
                  <?php endif; ?>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Last access info -->
    <div style="font-size:.8rem;color:#94a3b8;text-align:right">
      <i class="fa fa-clock" style="margin-right:4px"></i> Last login: <?= $lastloginstr ?>
    </div>

    <?php
    // ────────────────────────────────────────────────────────
    // TAB: ASSESSMENTS
    // ────────────────────────────────────────────────────────
    elseif ($tab === 'assessments'):

        // All quizzes with attempt data.
        $quiz_rows = [];
        foreach ($courses as $course) {
            $quizzes = $DB->get_records('quiz', ['course' => $course->id], 'name ASC', 'id,name,sumgrades');
            foreach ($quizzes as $q) {
                $attempts  = $DB->count_records('quiz_attempts', ['quiz' => $q->id, 'userid' => $childid]);
                $finished  = $DB->count_records('quiz_attempts', ['quiz' => $q->id, 'userid' => $childid, 'state' => 'finished']);
                $bestscore = $DB->get_field_sql(
                    "SELECT MAX(sumgrades) FROM {quiz_attempts} WHERE quiz=:qid AND userid=:uid AND state='finished'",
                    ['qid' => $q->id, 'uid' => $childid]
                );
                $quiz_rows[] = (object)[
                    'name'       => format_string($q->name),
                    'coursename' => format_string($course->fullname),
                    'attempts'   => $attempts,
                    'finished'   => $finished,
                    'bestscore'  => $bestscore,
                    'maxscore'   => $q->sumgrades,
                ];
            }
        }

        // Assignments (mod_assign).
        $assign_rows = [];
        foreach ($courses as $course) {
            $assigns = $DB->get_records('assign', ['course' => $course->id], 'name ASC', 'id,name,grade');
            foreach ($assigns as $a) {
                $sub   = $DB->get_record('assign_submission', ['assignment' => $a->id, 'userid' => $childid, 'latest' => 1]);
                $grade = $DB->get_record('assign_grades', ['assignment' => $a->id, 'userid' => $childid]);
                $assign_rows[] = (object)[
                    'name'       => format_string($a->name),
                    'coursename' => format_string($course->fullname),
                    'submitted'  => !empty($sub),
                    'grade'      => ($grade && $grade->grade >= 0) ? $grade->grade : null,
                    'maxgrade'   => $a->grade,
                ];
            }
        }
    ?>

    <!-- Quizzes section -->
    <div class="isti-card-modern" style="margin-bottom:20px">
      <div class="isti-card-modern-header">
        <h3 class="isti-card-modern-title"><i class="fa fa-question-circle"></i> Quizzes & Exams</h3>
        <span style="font-size:.8rem;color:#94a3b8"><?= count($quiz_rows) ?> quiz<?= count($quiz_rows) !== 1 ? 'zes' : '' ?></span>
      </div>
      <div class="isti-card-modern-body" style="padding:0">
        <?php if (empty($quiz_rows)): ?>
        <div style="padding:24px;text-align:center;color:#94a3b8;font-size:.88rem">No quizzes found.</div>
        <?php else: ?>
        <div style="overflow-x:auto">
        <table class="isti-table">
          <thead><tr>
            <th>Quiz</th><th>Subject</th><th>Attempts</th><th>Best Score</th><th>%</th>
          </tr></thead>
          <tbody>
            <?php foreach ($quiz_rows as $r):
                $pct = ($r->maxscore > 0 && $r->bestscore !== null && $r->bestscore !== false)
                    ? round(($r->bestscore / $r->maxscore) * 100) : null;
                $badgecls = $pct === null ? 'isti-badge-neutral'
                    : ($pct >= 70 ? 'isti-badge-success' : ($pct >= 40 ? 'isti-badge-warning' : 'isti-badge-danger'));
                $scorestr = ($r->bestscore !== null && $r->bestscore !== false)
                    ? round($r->bestscore, 1) . ' / ' . round($r->maxscore, 1) : '—';
            ?>
            <tr>
              <td style="font-weight:600;color:#1e293b"><?= $r->name ?></td>
              <td style="color:#64748b;font-size:.85rem"><?= $r->coursename ?></td>
              <td><span class="isti-badge isti-badge-neutral"><?= $r->finished ?> / <?= $r->attempts ?></span></td>
              <td><?= $scorestr ?></td>
              <td><?php if ($pct !== null): ?>
                <span class="isti-badge <?= $badgecls ?>"><?= $pct ?>%</span>
              <?php else: ?>—<?php endif; ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Assignments section -->
    <div class="isti-card-modern">
      <div class="isti-card-modern-header">
        <h3 class="isti-card-modern-title"><i class="fa fa-tasks"></i> Assignments</h3>
        <span style="font-size:.8rem;color:#94a3b8"><?= count($assign_rows) ?> assignment<?= count($assign_rows) !== 1 ? 's' : '' ?></span>
      </div>
      <div class="isti-card-modern-body" style="padding:0">
        <?php if (empty($assign_rows)): ?>
        <div style="padding:24px;text-align:center;color:#94a3b8;font-size:.88rem">No assignments found.</div>
        <?php else: ?>
        <div style="overflow-x:auto">
        <table class="isti-table">
          <thead><tr>
            <th>Assignment</th><th>Subject</th><th>Submitted</th><th>Grade</th>
          </tr></thead>
          <tbody>
            <?php foreach ($assign_rows as $r):
                $gradstr = $r->grade !== null
                    ? round($r->grade, 1) . ' / ' . round($r->maxgrade, 1) : '—';
            ?>
            <tr>
              <td style="font-weight:600;color:#1e293b"><?= $r->name ?></td>
              <td style="color:#64748b;font-size:.85rem"><?= $r->coursename ?></td>
              <td>
                <?php if ($r->submitted): ?>
                <span class="isti-badge isti-badge-success"><i class="fa fa-check"></i> Submitted</span>
                <?php else: ?>
                <span class="isti-badge isti-badge-warning">Pending</span>
                <?php endif; ?>
              </td>
              <td style="font-weight:600"><?= $gradstr ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <?php
    // ────────────────────────────────────────────────────────
    // TAB: LEARNING (LESSONS)
    // ────────────────────────────────────────────────────────
    elseif ($tab === 'learning'):
    ?>

    <?php if (empty($courses)): ?>
    <div style="text-align:center;padding:60px;color:#94a3b8">
      <i class="fa fa-book" style="font-size:2.5rem;display:block;margin-bottom:14px;color:#cbd5e1"></i>
      <p>No lessons enrolled yet.</p>
    </div>
    <?php else: ?>
    <div style="display:grid;gap:12px">
      <?php foreach ($courses as $course):
          $modinfo  = get_fast_modinfo($course);
          $cms      = $modinfo->get_cms();
          $visible  = array_filter($cms, fn($m) => $m->visible);
          $content_count = count($visible);
          $cinfo    = new \completion_info($course);
          $done     = $cinfo->is_enabled() && $cinfo->is_course_complete($childid);
      ?>
      <div class="isti-card-modern">
        <div class="isti-card-modern-header">
          <h3 class="isti-card-modern-title">
            <i class="fa fa-book-open" style="color:#006bff"></i>
            <?= format_string($course->fullname) ?>
          </h3>
          <div style="display:flex;align-items:center;gap:8px">
            <span class="isti-badge isti-badge-neutral"><i class="fa fa-puzzle-piece"></i> <?= $content_count ?> items</span>
            <?php if ($done): ?>
            <span class="isti-badge isti-badge-success"><i class="fa fa-check"></i> Complete</span>
            <?php else: ?>
            <span class="isti-badge isti-badge-neutral">In Progress</span>
            <?php endif; ?>
          </div>
        </div>
        <?php if (!empty($visible)): ?>
        <div class="isti-card-modern-body" style="padding:0">
          <table class="isti-table">
            <thead><tr><th>Activity</th><th>Type</th></tr></thead>
            <tbody>
              <?php $shown = 0; foreach ($visible as $cm):
                  if ($shown++ >= 8) break; ?>
              <tr>
                <td><?= format_string($cm->name) ?></td>
                <td style="color:#64748b;font-size:.8rem;text-transform:capitalize"><?= $cm->modname ?></td>
              </tr>
              <?php endforeach; ?>
              <?php if (count($visible) > 8): ?>
              <tr>
                <td colspan="2" style="text-align:center;color:#94a3b8;font-size:.8rem;padding:8px">
                  … and <?= count($visible) - 8 ?> more
                </td>
              </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
        <?php endif; ?>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php
    // ────────────────────────────────────────────────────────
    // TAB: ACTIVITY
    // ────────────────────────────────────────────────────────
    elseif ($tab === 'activity'):

        // Attendance data.
        $attendance = $DB->get_records('istikama_attendance', ['studentid' => $childid], 'attend_date DESC', '*', 0, 60);
        $att_total   = count($attendance);
        $att_present = 0; $att_absent = 0; $att_late = 0; $att_excused = 0;
        foreach ($attendance as $a) {
            switch ($a->status) {
                case 'present': $att_present++; break;
                case 'absent':  $att_absent++;  break;
                case 'late':    $att_late++;    break;
                case 'excused': $att_excused++; break;
            }
        }
        $att_rate = $att_total > 0 ? round(($att_present / $att_total) * 100) : null;

        // Participation metrics (last 30 days).
        $since = time() - (30 * DAYSECS);
        $logins_30d = 0; $views_30d = 0;
        try {
            $logins_30d = (int)$DB->count_records_sql(
                "SELECT COUNT(DISTINCT DATE(FROM_UNIXTIME(timecreated))) FROM {logstore_standard_log}
                  WHERE userid=:uid AND action='loggedin' AND timecreated>:since",
                ['uid' => $childid, 'since' => $since]
            );
            $views_30d = (int)$DB->count_records_sql(
                "SELECT COUNT(*) FROM {logstore_standard_log}
                  WHERE userid=:uid AND action='viewed' AND timecreated>:since",
                ['uid' => $childid, 'since' => $since]
            );
        } catch (\Exception $e) {}

        // Recent quiz attempts (all).
        $all_attempts = [];
        foreach ($courses as $course) {
            $quizzes = $DB->get_records('quiz', ['course' => $course->id], '', 'id,name,sumgrades');
            foreach ($quizzes as $q) {
                $atts = $DB->get_records('quiz_attempts',
                    ['quiz' => $q->id, 'userid' => $childid, 'state' => 'finished'],
                    'timefinish DESC', '*', 0, 5
                );
                foreach ($atts as $a) {
                    $a->quizname   = format_string($q->name);
                    $a->coursename = format_string($course->fullname);
                    $a->maxgrade   = $q->sumgrades;
                    $all_attempts[] = $a;
                }
            }
        }
        usort($all_attempts, fn($a, $b) => $b->timefinish - $a->timefinish);
        $all_attempts = array_slice($all_attempts, 0, 20);
    ?>

    <!-- Participation KPIs -->
    <div class="isti-kpi-grid" style="margin-bottom:24px">
      <div class="isti-kpi-card">
        <div class="isti-kpi-content">
          <span class="isti-kpi-label">Login Days (30d)</span>
          <span class="isti-kpi-value"><?= $logins_30d ?></span>
        </div>
        <div class="isti-kpi-icon blue"><i class="fa fa-sign-in-alt"></i></div>
      </div>
      <div class="isti-kpi-card">
        <div class="isti-kpi-content">
          <span class="isti-kpi-label">Pages Viewed (30d)</span>
          <span class="isti-kpi-value"><?= $views_30d ?></span>
        </div>
        <div class="isti-kpi-icon purple"><i class="fa fa-eye"></i></div>
      </div>
      <?php if ($att_rate !== null): ?>
      <div class="isti-kpi-card">
        <div class="isti-kpi-content">
          <span class="isti-kpi-label">Attendance Rate</span>
          <span class="isti-kpi-value"><?= $att_rate ?>%</span>
        </div>
        <div class="isti-kpi-icon <?= $att_rate >= 80 ? 'green' : ($att_rate >= 60 ? 'amber' : 'red') ?>">
          <i class="fa fa-calendar-check"></i>
        </div>
      </div>
      <div class="isti-kpi-card">
        <div class="isti-kpi-content">
          <span class="isti-kpi-label">Sessions Recorded</span>
          <span class="isti-kpi-value"><?= $att_total ?></span>
        </div>
        <div class="isti-kpi-icon amber"><i class="fa fa-list-alt"></i></div>
      </div>
      <?php endif; ?>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:20px">

      <!-- Quiz attempts history -->
      <div class="isti-card-modern">
        <div class="isti-card-modern-header">
          <h3 class="isti-card-modern-title"><i class="fa fa-history"></i> Quiz Attempt History</h3>
        </div>
        <div class="isti-card-modern-body" style="padding:0">
          <?php if (empty($all_attempts)): ?>
          <div style="padding:20px;text-align:center;color:#94a3b8;font-size:.85rem">No attempts yet.</div>
          <?php else: ?>
          <div style="overflow-x:auto">
          <table class="isti-table">
            <thead><tr><th>Quiz</th><th>Score</th><th>Date</th></tr></thead>
            <tbody>
              <?php foreach ($all_attempts as $a):
                  $pct = ($a->maxgrade > 0 && $a->sumgrades !== null)
                      ? round(($a->sumgrades / $a->maxgrade) * 100) : null;
                  $badgecls = $pct === null ? 'isti-badge-neutral'
                      : ($pct >= 70 ? 'isti-badge-success' : ($pct >= 40 ? 'isti-badge-warning' : 'isti-badge-danger'));
                  $scorestr = $a->sumgrades !== null
                      ? round($a->sumgrades, 1) . ' / ' . round($a->maxgrade, 1) : '—';
              ?>
              <tr>
                <td>
                  <div style="font-weight:600;font-size:.85rem;color:#1e293b"><?= $a->quizname ?></div>
                  <div style="font-size:.73rem;color:#94a3b8"><?= $a->coursename ?></div>
                </td>
                <td><span class="isti-badge <?= $badgecls ?>"><?= $pct !== null ? $pct . '%' : $scorestr ?></span></td>
                <td style="font-size:.78rem;color:#64748b"><?= userdate($a->timefinish, '%d %b %Y') ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          </div>
          <?php endif; ?>
        </div>
      </div>

      <!-- Attendance records -->
      <div class="isti-card-modern">
        <div class="isti-card-modern-header">
          <h3 class="isti-card-modern-title"><i class="fa fa-calendar-alt"></i> Attendance</h3>
          <?php if ($att_rate !== null): ?>
          <span class="isti-badge <?= $att_rate >= 80 ? 'isti-badge-success' : ($att_rate >= 60 ? 'isti-badge-warning' : 'isti-badge-danger') ?>">
            <?= $att_rate ?>%
          </span>
          <?php endif; ?>
        </div>
        <div class="isti-card-modern-body" style="padding:0">
          <?php if (empty($attendance)): ?>
          <div style="padding:20px;text-align:center;color:#94a3b8;font-size:.85rem">No attendance records.</div>
          <?php else: ?>
          <div style="overflow-x:auto">
          <table class="isti-table">
            <thead><tr><th>Date</th><th>Status</th><th>Note</th></tr></thead>
            <tbody>
              <?php
              $status_cls = [
                  'present' => 'isti-badge-success',
                  'absent'  => 'isti-badge-danger',
                  'late'    => 'isti-badge-warning',
                  'excused' => 'isti-badge-neutral',
              ];
              foreach ($attendance as $a):
              ?>
              <tr>
                <td style="font-size:.82rem;color:#475569"><?= s($a->attend_date) ?></td>
                <td>
                  <span class="isti-badge <?= $status_cls[$a->status] ?? 'isti-badge-neutral' ?>">
                    <?= ucfirst($a->status) ?>
                  </span>
                </td>
                <td style="font-size:.8rem;color:#64748b"><?= format_string($a->behavior_note ?? '') ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <?php endif; // end tab switch ?>

    </div><!-- /child dashboard wrapper -->
    <?php
} // end $section === 'child'

local_istikama_admin_print_footer();
