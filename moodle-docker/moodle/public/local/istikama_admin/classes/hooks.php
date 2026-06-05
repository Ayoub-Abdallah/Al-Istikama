<?php
namespace local_istikama_admin;

defined('MOODLE_INTERNAL') || die();

use core\hook\navigation\primary_extend;
use moodle_url;

/**
 * Hook callbacks for local_istikama_admin.
 */
class hooks {
    /**
     * Redirect Moodle's native mod_assign view pages to our Istikama-branded
     * homework / grading pages so the experience is consistent.
     *
     * Triggers on:
     *   - /mod/assign/view.php?id=X                  → view_homework.php
     *   - /mod/assign/view.php?id=X (no action)      → view_homework.php
     *   - /mod/assign/view.php?id=X&action=grader    → grade_homework.php
     *   - /mod/assign/view.php?id=X&action=grading   → grade_homework.php
     *
     * Leaves alone:
     *   - action=editsubmission  (Moodle's native upload form — needed)
     *   - action=submit          (submission confirmation)
     *   - any other action       (less common flows; keep Moodle behavior)
     *
     * @param \core\hook\after_config $hook
     */
    public static function after_config($hook): void {
        global $SCRIPT, $FULLME;

        // Only act on /mod/assign/view.php — the page Moodle uses for all
        // assignment views/grading. Use $SCRIPT which is set early.
        if (empty($SCRIPT) || strpos($SCRIPT, '/mod/assign/view.php') === false) {
            return;
        }

        // Read the URL params (these are reliable even before require_login).
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id <= 0) {
            return;
        }
        $action = isset($_GET['action']) ? (string)$_GET['action'] : '';

        // Actions we DO redirect:
        //   ''       (default view)
        //   'view'   (explicit view)
        //   'grader' (single-user grading workspace)
        //   'grading'(grading table for everyone)
        $redirectable = ['', 'view', 'grader', 'grading'];
        if (!in_array($action, $redirectable, true)) {
            return;
        }

        try {
            // Defer the redirect decision until require_login() has run, so
            // capabilities are accurate. We do this by hooking into the page
            // setup via a deferred token rather than redirecting here directly.
            // SIMPLEST: just try to redirect now — Moodle's session is up.

            if (!function_exists('\local_istikama_admin_get_user_tier')) {
                require_once(__DIR__ . '/../locallib.php');
            }

            global $USER, $DB;
            if (empty($USER->id) || isguestuser()) {
                return;
            }

            // Resolve the cmid → context to check capabilities.
            $cm = $DB->get_record('course_modules', ['id' => $id], 'id,instance,course,module', IGNORE_MISSING);
            if (!$cm) {
                return;
            }
            $modulerec = $DB->get_record('modules', ['id' => $cm->module], 'name');
            if (!$modulerec || $modulerec->name !== 'assign') {
                return;
            }

            $modctx = \context_module::instance($id, IGNORE_MISSING);
            if (!$modctx) {
                return;
            }

            $cangrade  = has_capability('mod/assign:grade', $modctx);
            $cansubmit = has_capability('mod/assign:submit', $modctx);

            // Decision matrix:
            //   action=grader/grading → grade_homework.php (only if cangrade)
            //   action=''/view        → view_homework.php  (everyone — page itself decides what to show)
            $target = null;
            if (in_array($action, ['grader', 'grading'], true)) {
                if ($cangrade) {
                    $userid = isset($_GET['userid']) ? (int)$_GET['userid'] : 0;
                    $params = ['id' => $id];
                    if ($userid > 0) { $params['userid'] = $userid; }
                    $target = new moodle_url('/local/istikama_admin/grade_homework.php', $params);
                }
            } else {
                // Default view — works for both students and teachers.
                $target = new moodle_url('/local/istikama_admin/view_homework.php', ['id' => $id]);
            }

            if ($target) {
                // Send the redirect immediately. No output has been generated
                // at after_config time so headers are still safe.
                redirect($target);
            }
        } catch (\Throwable $e) {
            // Non-fatal — fall through to Moodle's native behavior.
            debugging('istikama after_config assign redirect failed: ' . $e->getMessage(), DEBUG_DEVELOPER);
        }
    }

    /**
     * Replace top navigation for target users.
     *
     * @param primary_extend $hook
     * @return void
     */
    public static function extend_primary_navigation(primary_extend $hook): void {
        global $USER;

        if (empty($USER->id) || isguestuser()) {
            return;
        }

        require_once(__DIR__ . '/../locallib.php');

        $tier = local_istikama_admin_get_user_tier((int)$USER->id);
        if ($tier === 'none') {
            return;
        }

        $primaryview = $hook->get_primaryview();
        $keys = $primaryview->get_children_key_list();

        if ($tier === 'student') {
            $primaryview->add(get_string('menu_my_report', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/reports.php'));
            return;
        }

        foreach ($keys as $key) {
            $item = $primaryview->get($key);
            if ($item) {
                $item->remove();
            }
        }

        if ($tier === 'school_manager') {
            // School Manager: Dashboard, Users, Library, Reports, Notifications, Support center, Support
            $primaryview->add(get_string('menu_dashboard', 'local_istikama_admin'), new moodle_url('/my/'));
            $primaryview->add(get_string('menu_users', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/school_users.php'));
            $primaryview->add(get_string('menu_library', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/contentbank.php'));
            $primaryview->add(get_string('menu_performance', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/reports.php'));
            $primaryview->add(get_string('menu_notifications', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/school_notifications.php'));
            $primaryview->add(get_string('menu_support_admin', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/support_admin.php'));
            $primaryview->add(get_string('menu_support', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/support.php'));
        } else if ($tier === 'parent') {
            // Parent sees only: Home, Children, Support
            $primaryview->add(get_string('menu_dashboard', 'local_istikama_admin'), new moodle_url('/my/'));
            $primaryview->add(get_string('menu_children', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/parent.php'));
            $primaryview->add(get_string('menu_support', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/support.php'));
        } else if ($tier === 'teacher') {
            // Teacher: Dashboard, Class Library, Library, Classes, Support
            $primaryview->add(get_string('menu_dashboard', 'local_istikama_admin'), new moodle_url('/my/'));
            $primaryview->add(get_string('menu_class_library', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classlibrary']));
            $primaryview->add(get_string('menu_library', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'library']));
            $primaryview->add(get_string('menu_classes', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/teacher.php', ['section' => 'classes']));
            // Teachers can raise tickets — this was missing.
            $primaryview->add(get_string('menu_support', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/support.php'));
        } else {
            // Base Navbar items applicable to all target users (Teachers & Creators)
            $primaryview->add(get_string('menu_dashboard', 'local_istikama_admin'), new moodle_url('/my/'));
            $primaryview->add(get_string('menu_contentbank', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/contentbank.php'));
            $primaryview->add(get_string('menu_reports', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/reports.php'));

            // Items exclusive to Full Admins
            if ($tier === 'full_admin') {
                $primaryview->add(get_string('menu_schools', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/schools.php'));
                $primaryview->add(get_string('menu_users', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/users.php'));
                $primaryview->add(get_string('manage_promotions', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/promotions.php'));
                $primaryview->add(get_string('menu_support_admin', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/support_admin.php'));
                // Default Site administration landing is the searchable admin page (not index.php).
                $primaryview->add(get_string('menu_siteadmin', 'local_istikama_admin'), new moodle_url('/admin/search.php'));
            }

            // Support is available for everyone
            $primaryview->add(get_string('menu_support', 'local_istikama_admin'), new moodle_url('/local/istikama_admin/support.php'));
        }

        $hook->stop_propagation();
    }

    /**
     * Inject the Istikama admin CSS into core /admin/* pages and quiz pages.
     *
     * @param \core\hook\output\before_standard_head_html_generation $hook
     */
    public static function before_standard_head_html_generation($hook): void {
        global $PAGE;

        if (!$PAGE || empty($PAGE->url)) {
            return;
        }

        try {
            // Always-on plugin CSS so theming applies platform-wide.
            $PAGE->requires->css(new moodle_url('/local/istikama_admin/styles/istikama_admin.css'));

            $path = $PAGE->url->get_path();
            if (strpos($path, '/admin/') === 0) {
                $PAGE->add_body_class('istikama-admin-modernized');
            }

            $isquizpage     = (strpos($path, '/mod/quiz/') === 0);
            $isquestionpage = (strpos($path, '/question/') === 0);

            if ($isquizpage || $isquestionpage) {
                // Inject quiz CSS directly into <head> so it is guaranteed to load
                // regardless of Moodle's cache-invalidation for $PAGE->requires->css().
                $cssurl = (new moodle_url('/local/istikama_admin/styles/moodle_quiz.css'))->out(false);
                $hook->add_html('<link rel="stylesheet" href="' . $cssurl . '">');
                $PAGE->add_body_class('istikama-quiz-modern');
            }

            // ── forceview=1 redirect ─────────────────────────────────────────
            // After modedit.php saves, Moodle pushes admin to view.php?forceview=1
            // which is an empty, confusing page for them. Send them back to
            // activities.php instead.
            if ($isquizpage && strpos($path, '/mod/quiz/view.php') !== false) {
                $forceview = optional_param('forceview', 0, PARAM_INT);
                if ($forceview === 1) {
                    $tier = function_exists('local_istikama_admin_get_user_tier')
                        ? local_istikama_admin_get_user_tier()
                        : '';
                    if (in_array($tier, ['full_admin', 'school_manager', 'technical_professor'], true)) {
                        $target = (new moodle_url('/local/istikama_admin/activities.php'))->out(false);
                        $hook->add_html('<script>window.location.replace(' . json_encode($target) . ');</script>');
                    }
                }
            }

        } catch (\Throwable $e) {
            // Non-fatal.
        }
    }

    /**
     * Inject quiz-page DOM patches right after <body> opens.
     *
     * Runs on DOMContentLoaded and:
     *  1. Rewires "Back to course" → /local/istikama_admin/activities.php for admins.
     *  2. Rewires "Edit quiz" links → /local/istikama_admin/edit_quiz.php for admins.
     *  3. Hides raw Moodle breadcrumbs that reference internal course paths for admins.
     *
     * @param \core\hook\output\before_standard_top_of_body_html_generation $hook
     */
    public static function before_standard_top_of_body_html_generation($hook): void {
        global $PAGE, $USER;

        // IMPORTANT: do NOT rely on $PAGE->url here. On some layouts (notably the
        // dashboard / "/my/") this hook fires before set_url() has run, so
        // $PAGE->url is empty. Derive the request path from the server request
        // instead — it is always available — and only fall back to $PAGE->url.
        $path = '';
        if (!empty($_SERVER['REQUEST_URI'])) {
            $path = (string)parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }
        if ($path === '' && $PAGE && $PAGE->has_set_url()) {
            $path = $PAGE->url->get_path();
        }

        // ── Advertisements / announcements (popup + sidebar) on EVERY page ──
        // Runs for any logged-in real user. Best-effort: never breaks a page.
        try {
            self::inject_advertisements($hook, $path);
        } catch (\Throwable $e) {
            // Non-fatal.
        }

        // ── User create/edit form: lift the Istikama student detail fields up so
        //    they sit with the core identity fields (they are primary details). ──
        try {
            if (strpos($path, '/user/editadvanced.php') === 0 || strpos($path, '/user/edit.php') === 0) {
                self::inject_userform_enhance($hook);
            }
        } catch (\Throwable $e) {
            // Non-fatal.
        }

        try {
            $isquizpage = (strpos($path, '/mod/quiz/') === 0);
            if (!$isquizpage) {
                return;
            }

            require_once(__DIR__ . '/../locallib.php');
            $tier = function_exists('local_istikama_admin_get_user_tier')
                ? local_istikama_admin_get_user_tier((int)$USER->id)
                : 'none';

            $isadmin = in_array($tier, ['full_admin', 'school_manager', 'technical_professor'], true);

            // Build JSON-safe values to embed in the inline script.
            $activitiesurl = (new moodle_url('/local/istikama_admin/activities.php'))->out(false);
            $editquizbase  = (new moodle_url('/local/istikama_admin/edit_quiz.php'))->out(false);
            $isadminjson   = $isadmin ? 'true' : 'false';
            $activitiesjson = json_encode($activitiesurl);
            $editbasejson   = json_encode($editquizbase);

            $js = <<<JS
<script>
(function() {
    var IS_ADMIN    = {$isadminjson};
    var ACTIVITIES  = {$activitiesjson};
    var EDIT_BASE   = {$editbasejson};

    function patchLinks() {
        try {
            if (IS_ADMIN) {
                var backForm = document.querySelector('.continuebutton form, .quizattempt .singlebutton form');
                if (backForm) {
                    backForm.action = ACTIVITIES;
                    var inputs = backForm.querySelectorAll('input[type="hidden"]');
                    inputs.forEach(function(inp) { inp.remove(); });
                    var btn = backForm.querySelector('button, input[type="submit"]');
                    if (btn) { btn.textContent = 'Back to Activities'; }
                }

                var editLinks = document.querySelectorAll('a[href*="/mod/quiz/edit.php"]');
                editLinks.forEach(function(link) {
                    try {
                        var u = new URL(link.href, window.location.origin);
                        var cmid = u.searchParams.get('cmid');
                        if (cmid) {
                            link.href = EDIT_BASE + '?cmid=' + encodeURIComponent(cmid);
                        }
                    } catch (e) {}
                });

                var backLinks = document.querySelectorAll('.tertiary-navigation a[href*="/mod/quiz/view.php"]');
                backLinks.forEach(function(link) {
                    link.href = ACTIVITIES;
                    link.textContent = 'Back to Activities';
                });
            }

            // Ensure CSS scoping class is on <body>.
            if (document.body) {
                document.body.classList.add('istikama-quiz-modern');
            }
        } catch (e) {
            if (window.console && console.warn) {
                console.warn('[istikama-quiz] patchLinks error:', e);
            }
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', patchLinks);
    } else {
        patchLinks();
    }
})();
</script>
JS;
            $hook->add_html($js);

        } catch (\Throwable $e) {
            // Non-fatal.
        }
    }

    /**
     * Inject advertisements / announcements (popup modal + dismissible right
     * sidebar) into the current page for the logged-in user.
     *
     * Skips: guests, the public landing/login pages, and the ads-management
     * page itself. Pure best-effort — wrapped by the caller's try/catch.
     *
     * @param \core\hook\output\before_standard_top_of_body_html_generation $hook
     */
    /**
     * On the user create/edit form, move the "Istikama student details" fieldset
     * (gender, father/grandfather name, DOB, student ID) directly below the
     * General identity section and expand it, so these primary details are not
     * buried in a lower, collapsed section.
     *
     * @param \core\hook\output\before_standard_top_of_body_html_generation $hook
     */
    private static function inject_userform_enhance($hook): void {
        $js = <<<'JS'
<script>
(function(){
  function expand(fs){
    fs.classList.remove('collapsed');
    var inner = fs.querySelector(':scope > .fcontainer, :scope > .collapse, .fcontainer');
    if(inner){ inner.classList.add('show'); inner.classList.remove('collapse'); }
    var toggle = fs.querySelector('[aria-expanded]'); if(toggle){ toggle.setAttribute('aria-expanded','true'); }
  }
  function run(){
    var form = document.querySelector('#region-main form.mform, form.mform');
    if(!form){ return; }
    var fsets = form.querySelectorAll('fieldset');
    if(fsets.length < 2){ return; }
    var target=null;
    fsets.forEach(function(fs){
      var lg = fs.querySelector('legend');
      if(lg && lg.textContent.indexOf('Istikama student details') !== -1){ target = fs; }
    });
    if(!target){ return; }
    expand(target);
    var first = fsets[0];
    if(first && target !== first && first.parentNode && target !== first.nextSibling){
      first.parentNode.insertBefore(target, first.nextSibling);
    }
  }
  if(document.readyState === 'loading'){ document.addEventListener('DOMContentLoaded', run); }
  else { run(); }
})();
</script>
JS;
        $hook->add_html($js);
    }

    private static function inject_advertisements($hook, string $path = ''): void {
        global $USER, $CFG;

        if (empty($USER->id) || isguestuser()) {
            return;
        }
        // Don't show ads on auth pages or the ads admin page itself.
        if (strpos($path, '/login/') === 0
            || strpos($path, '/local/istikama_admin/advertisements.php') !== false) {
            return;
        }

        require_once(__DIR__ . '/advertisement_manager.php');

        $popups  = \local_istikama_admin\advertisement_manager::get_visible((int)$USER->id, 'popup');
        $sidebar = \local_istikama_admin\advertisement_manager::get_visible((int)$USER->id, 'sidebar');
        if (empty($popups) && empty($sidebar)) {
            return;
        }

        $popupsjson  = json_encode(array_values($popups),  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $sidebarjson = json_encode(array_values($sidebar), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $ajaxurl     = json_encode((new moodle_url('/local/istikama_admin/ad_ajax.php'))->out(false));
        $sesskey     = json_encode(sesskey());
        $idle        = (int)\local_istikama_admin\advertisement_manager::RETURN_IDLE_MINUTES;

        $css = self::advertisement_css();

        $html = <<<HTML
<style>{$css}</style>
<div id="isti-ad-sidebar" class="isti-ad-sidebar" aria-label="Announcements"></div>
<div id="isti-ad-popup-root"></div>
<script>
(function(){
    "use strict";
    var POPUPS  = {$popupsjson};
    var SIDEBAR = {$sidebarjson};
    var AJAX    = {$ajaxurl};
    var SESS    = {$sesskey};
    var IDLE_MS = {$idle} * 60 * 1000;

    function track(action, adid){
        try {
            var fd = new FormData();
            fd.append('sesskey', SESS); fd.append('action', action); fd.append('adid', adid);
            if (navigator.sendBeacon) { navigator.sendBeacon(AJAX, fd); }
            else { fetch(AJAX, { method:'POST', body:fd, credentials:'same-origin' }); }
        } catch(e){}
    }

    function adImage(ad, cls){
        if (!ad.image) return '';
        var ratio = (ad.width && ad.height) ? (ad.width + '/' + ad.height) : 'auto';
        return '<img class="'+cls+'" src="'+ad.image+'" alt="'+(ad.title||'')+'" '
             + (ad.width? 'style="aspect-ratio:'+ratio+'"':'') + '>';
    }

    // ── SIDEBAR ───────────────────────────────────────────────────────────
    function renderSidebar(){
        var root = document.getElementById('isti-ad-sidebar');
        if (!root || !SIDEBAR.length) { if(root) root.style.display='none'; return; }
        SIDEBAR.forEach(function(ad){
            var card = document.createElement('div');
            card.className = 'isti-ad-card';
            if (ad.bgcolor) card.style.background = ad.bgcolor;
            var inner = '';
            if (ad.dismissible) {
                inner += '<button class="isti-ad-x" aria-label="Dismiss" title="Dismiss">&times;</button>';
            }
            var clickable = ad.linkurl ? true : false;
            if (ad.image) inner += adImage(ad, 'isti-ad-card-img');
            inner += '<div class="isti-ad-card-body">';
            if (ad.title)   inner += '<div class="isti-ad-card-title">'+ad.title+'</div>';
            if (ad.content) inner += '<div class="isti-ad-card-text">'+ad.content+'</div>';
            if (ad.linkurl) inner += '<a class="isti-ad-card-cta" href="'+ad.linkurl+'" target="_blank" rel="noopener">'+(ad.linktext||'Learn more')+' &rarr;</a>';
            inner += '</div>';
            card.innerHTML = inner;
            // Whole-card click → link (except on the X / CTA which handle themselves)
            if (clickable) {
                card.addEventListener('click', function(e){
                    if (e.target.closest('.isti-ad-x')) return;
                    track('click', ad.id);
                    if (!e.target.closest('a')) window.open(ad.linkurl, '_blank', 'noopener');
                });
            }
            var x = card.querySelector('.isti-ad-x');
            if (x) x.addEventListener('click', function(e){
                e.stopPropagation();
                track('dismiss', ad.id);
                card.classList.add('isti-ad-out');
                setTimeout(function(){ card.remove(); if(!root.querySelector('.isti-ad-card')) root.style.display='none'; }, 250);
            });
            var cta = card.querySelector('.isti-ad-card-cta');
            if (cta) cta.addEventListener('click', function(){ track('click', ad.id); });
            track('seen', ad.id);
            root.appendChild(card);
        });
    }

    // ── POPUP ─────────────────────────────────────────────────────────────
    function shouldPopup(ad){
        try {
            if (ad.trigger === 'once') return true; // server already filtered seen
            if (ad.trigger === 'everyvisit') {
                var k = 'isti-ad-seen-session-' + ad.id;
                if (sessionStorage.getItem(k)) return false;
                return true;
            }
            if (ad.trigger === 'login') {
                // Only on the first page right after authentication. We use a
                // one-shot flag the server-less way: a sessionStorage marker set
                // once per browser session; combined with "no referrer from same
                // origin" heuristics is fragile, so treat like everyvisit-once.
                var lk = 'isti-ad-login-' + ad.id;
                if (sessionStorage.getItem(lk)) return false;
                return true;
            }
            if (ad.trigger === 'return') {
                var rk = 'isti-ad-last-' + ad.id;
                var last = parseInt(localStorage.getItem(rk) || '0', 10);
                var now = Date.now();
                if (last && (now - last) < IDLE_MS) return false;
                return true;
            }
        } catch(e){ return true; }
        return true;
    }
    function markPopupShown(ad){
        try {
            if (ad.trigger === 'everyvisit') sessionStorage.setItem('isti-ad-seen-session-'+ad.id,'1');
            if (ad.trigger === 'login') sessionStorage.setItem('isti-ad-login-'+ad.id,'1');
            if (ad.trigger === 'return') localStorage.setItem('isti-ad-last-'+ad.id, String(Date.now()));
        } catch(e){}
    }
    function showPopup(ad){
        var root = document.getElementById('isti-ad-popup-root');
        if (!root) return;
        var ov = document.createElement('div');
        ov.className = 'isti-ad-popup-ov';
        var box = '<div class="isti-ad-popup" role="dialog" aria-modal="true">';
        box += '<button class="isti-ad-popup-x" aria-label="Close">&times;</button>';
        if (ad.image)   box += '<a class="isti-ad-popup-imgwrap" '+(ad.linkurl?'href="'+ad.linkurl+'" target="_blank" rel="noopener"':'')+'>'+adImage(ad,'isti-ad-popup-img')+'</a>';
        if (ad.title || ad.content || ad.linkurl) {
            box += '<div class="isti-ad-popup-body">';
            if (ad.title)   box += '<h3 class="isti-ad-popup-title">'+ad.title+'</h3>';
            if (ad.content) box += '<div class="isti-ad-popup-text">'+ad.content+'</div>';
            if (ad.linkurl) box += '<a class="isti-ad-popup-cta" href="'+ad.linkurl+'" target="_blank" rel="noopener">'+(ad.linktext||'Learn more')+'</a>';
            box += '</div>';
        }
        box += '</div>';
        ov.innerHTML = box;
        root.appendChild(ov);
        requestAnimationFrame(function(){ ov.classList.add('show'); });
        track('seen', ad.id);
        markPopupShown(ad);
        function close(){ ov.classList.remove('show'); setTimeout(function(){ ov.remove(); }, 250); }
        ov.querySelector('.isti-ad-popup-x').addEventListener('click', close);
        ov.addEventListener('click', function(e){ if (e.target===ov) close(); });
        document.addEventListener('keydown', function esc(e){ if(e.key==='Escape'){ close(); document.removeEventListener('keydown', esc);} });
        var cta = ov.querySelector('.isti-ad-popup-cta, .isti-ad-popup-imgwrap');
        if (cta) cta.addEventListener('click', function(){ track('click', ad.id); });
    }

    function init(){
        renderSidebar();
        // Show at most ONE popup per page load (highest priority eligible).
        for (var i=0;i<POPUPS.length;i++){
            if (shouldPopup(POPUPS[i])) { showPopup(POPUPS[i]); break; }
        }
    }
    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init);
    else init();
})();
</script>
HTML;
        $hook->add_html($html);
    }

    /** Scoped CSS for the popup + sidebar ad surfaces. */
    private static function advertisement_css(): string {
        return <<<CSS
.isti-ad-sidebar{position:fixed;top:84px;right:14px;z-index:1090;width:230px;max-width:74vw;display:flex;flex-direction:column;gap:14px;pointer-events:none}
.isti-ad-sidebar .isti-ad-card{pointer-events:auto}
.isti-ad-card{position:relative;background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;box-shadow:0 10px 30px -12px rgba(15,23,42,.22);cursor:pointer;transition:transform .2s ease,box-shadow .2s ease,opacity .25s ease;animation:istiAdIn .35s cubic-bezier(.22,1,.36,1)}
.isti-ad-card:hover{transform:translateY(-3px);box-shadow:0 16px 36px -12px rgba(0,107,255,.28)}
.isti-ad-card.isti-ad-out{opacity:0;transform:translateX(30px)}
.isti-ad-card-img{width:100%;display:block;object-fit:cover;background:#f1f5f9}
.isti-ad-card-body{padding:12px 14px}
.isti-ad-card-title{font-weight:700;color:#0f172a;font-size:.92rem;line-height:1.3;margin-bottom:4px}
.isti-ad-card-text{color:#64748b;font-size:.8rem;line-height:1.5}
.isti-ad-card-cta{display:inline-block;margin-top:8px;color:#006bff;font-weight:600;font-size:.8rem;text-decoration:none}
.isti-ad-x{position:absolute;top:8px;right:8px;z-index:3;width:26px;height:26px;border-radius:50%;border:none;background:rgba(15,23,42,.55);color:#fff;font-size:1.05rem;line-height:1;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .2s}
.isti-ad-x:hover{background:rgba(15,23,42,.85)}
@keyframes istiAdIn{from{opacity:0;transform:translateX(30px)}to{opacity:1;transform:none}}
.isti-ad-popup-ov{position:fixed;inset:0;z-index:11000;background:rgba(15,23,42,.6);display:flex;align-items:center;justify-content:center;padding:20px;opacity:0;transition:opacity .25s ease;-webkit-backdrop-filter:blur(2px);backdrop-filter:blur(2px)}
.isti-ad-popup-ov.show{opacity:1}
.isti-ad-popup{position:relative;background:#fff;border-radius:20px;overflow:hidden;width:min(720px,94vw);max-width:94vw;max-height:92vh;box-shadow:0 30px 80px rgba(0,0,0,.4);transform:translateY(16px) scale(.96);transition:transform .28s cubic-bezier(.22,1,.36,1);display:flex;flex-direction:column}
.isti-ad-popup-ov.show .isti-ad-popup{transform:none}
.isti-ad-popup-x{position:absolute;top:14px;right:14px;z-index:4;width:38px;height:38px;border-radius:50%;border:none;background:rgba(15,23,42,.5);color:#fff;font-size:1.5rem;line-height:1;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .2s}
.isti-ad-popup-x:hover{background:rgba(15,23,42,.8)}
.isti-ad-popup-imgwrap{display:block;min-height:0}
.isti-ad-popup-img{width:100%;display:block;object-fit:contain;max-height:62vh;background:#0f172a}
.isti-ad-popup-body{padding:26px 32px 30px;overflow-y:auto;overflow-x:hidden;min-height:0}
.isti-ad-popup-title{font-size:1.55rem;font-weight:800;color:#0f172a;margin:0 0 12px;line-height:1.25}
.isti-ad-popup-text{color:#475569;font-size:1.02rem;line-height:1.7}
.isti-ad-popup-cta{display:inline-block;margin-top:18px;background:#006bff;color:#fff;padding:13px 28px;border-radius:12px;font-weight:700;font-size:.95rem;text-decoration:none;transition:background .2s}
.isti-ad-popup-cta:hover{background:#0052cc;color:#fff}
@media(max-width:992px){.isti-ad-sidebar{display:none!important}}
CSS;
    }

    /**
     * Inject JS for terminology substitution on core pages for target users.
     * Acts as an interceptor for restricted Moodle Core page spoofing.
     *
    private static function inject_school_branding(\core\hook\output\before_standard_html_head $hook, int $userid): void {
        global $DB;

        $assignment = $DB->get_record_sql(
            "SELECT us.schoolid
               FROM {istikama_user_school} us
              WHERE us.userid = :userid
           ORDER BY us.id ASC",
            ['userid' => $userid],
            IGNORE_MULTIPLE
        );

        if (!$assignment || empty($assignment->schoolid)) {
            return;
        }

        try {
            $schoolcat = \core_course_category::get($assignment->schoolid);
            $schoolname = format_string($schoolcat->name);
        } catch (\Throwable $e) {
            return;
        }

        $logourl = '';
        if (class_exists('\\local_istikama_admin\\school_manager')) {
            $logourl = (string)\local_istikama_admin\school_manager::get_school_logo_url($assignment->schoolid);
        }

        $schoolnamejson = json_encode($schoolname, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $logourljson = json_encode($logourl, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

        $html = $hook->get_html();
        $js = <<<JS
<script>
document.addEventListener('DOMContentLoaded', function() {
    var schoolName = {$schoolnamejson};
    var logoUrl = {$logourljson};

    var brandEl = document.querySelector('.navbar-brand');
    if (!brandEl) {
        return;
    }

    var textEl = brandEl.querySelector('.site-name, span') || brandEl;
    if (textEl && schoolName) {
        textEl.textContent = schoolName;
    }

    if (!logoUrl) {
        return;
    }

    var imgEl = brandEl.querySelector('img');
    if (imgEl) {
        imgEl.src = logoUrl;
        imgEl.alt = schoolName;
        return;
    }

    var injected = document.createElement('img');
    injected.src = logoUrl;
    injected.alt = schoolName;
    injected.style.cssText = 'height:32px;width:32px;border-radius:8px;object-fit:cover;margin-right:8px;';
    brandEl.insertBefore(injected, brandEl.firstChild);
});
</script>
JS;
        $hook->set_html($html . $js);
    }

    /**
     * Overrides for teachers operating natively inside Moodle course pages.
     */
    private static function inject_teacher_course_overrides(\core\hook\output\before_standard_html_head $hook, string $path): void {
        if (strpos($path, '/course/view.php') !== 0) {
            return;
        }

        $html = $hook->get_html();
        $sesskeyjson = json_encode(sesskey(), JSON_UNESCAPED_SLASHES);

        $js = <<<JS
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.info('[Istikama] chooser override loaded');
    document.documentElement.setAttribute('data-istikama-chooser-hook', '1');

    var lastSectionId = 0;
    var sesskey = {$sesskeyjson};

    function isChooserModal(el) {
        if (!el) {
            return false;
        }
        if (el.matches('[data-region="activity-chooser"], [data-region="activitychooser"], [data-region="modules"]') ||
            el.querySelector('[data-region="activity-chooser"], [data-region="activitychooser"], [data-region="modules"]')) {
            return true;
        }
        var txt = (el.textContent || '').toLowerCase();
        return txt.includes('add an activity') || txt.includes('add a resource') ||
            txt.includes('ajouter une activité') || txt.includes('ajouter une ressource') ||
            txt.includes('إضافة نشاط') || txt.includes('إضافة مورد');
    }

    function currentCourseId() {
        return new URLSearchParams(window.location.search).get('id') || document.body.dataset.courseId || 0;
    }

    function applyChooser(modalEl) {
        if (!isChooserModal(modalEl) || modalEl.dataset.istiInjected === '1') {
            return;
        }

        modalEl.dataset.istiInjected = '1';

        var sectionId = lastSectionId || 0;
        var expanded = document.querySelector('[data-action="open-chooser"][aria-expanded="true"]');
        if (expanded && expanded.dataset.sectionid) {
            sectionId = expanded.dataset.sectionid;
        }

        var grids = Array.from(modalEl.querySelectorAll('[data-region="modules"], .options, .modules, .activitychooser-options, .chooser-options, [role="list"]'));
        if (grids.length === 0 && modalEl.matches('[data-region="modules"]')) {
            grids = [modalEl];
        }
        if (grids.length === 0) {
            var fallback = modalEl.querySelector('.modal-body, [data-region="activity-chooser"], [data-region="activitychooser"]');
            if (fallback) {
                grids = [fallback];
            }
        }
        if (grids.length === 0) {
            return;
        }

        var courseId = currentCourseId();
        grids.forEach(function(grid) {
            grid.innerHTML = '<div style="width:100%;text-align:center;padding:20px;">Fetching Approved Content...</div>';
            fetch('/local/istikama_admin/ajax.php?action=get_chooser_content&courseid=' + courseId + '&sesskey=' + encodeURIComponent(sesskey))
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    grid.innerHTML = '';
                    if (!data || data.error || data.length === 0) {
                        grid.innerHTML = '<div style="width:100%;text-align:center;padding:20px;color:#64748b;">No approved content found for this level.</div>';
                        return;
                    }

                    data.forEach(function(item) {
                        var desc = item.description ? '<div style="font-size:11px;color:#6b7280;margin-top:4px;line-height:1.3;max-height:2.6em;overflow:hidden;">' + item.description + '</div>' : '';
                        var date = item.date ? '<div style="font-size:10px;color:#94a3b8;margin-top:3px;">' + item.date + '</div>' : '';
                        var itemHtml = '<div class="option" role="listitem" style="border:1px solid #e2e8f0;background:#f8fafc;border-radius:8px;margin:4px;flex-grow:1;flex-basis:160px;">' +
                            '<a href="/local/istikama_admin/add_from_bank.php?courseid=' + courseId + '&sectionid=' + sectionId + '&contentid=' + item.id + '" class="d-flex flex-column text-center align-items-center p-3" style="text-decoration:none;color:inherit;width:100%;">' +
                            '<div class="icon-container mb-2" style="font-size:32px;">' + item.icon + '</div>' +
                            '<div class="optionname" style="font-weight:600;color:#0f172a;font-size:13px;word-break:break-word;">' + item.name + '</div>' +
                            '<div style="font-size:11px;color:#64748b;margin-top:4px;text-transform:uppercase;">' + item.content_type + '</div>' +
                            desc + date +
                            '</a></div>';
                        grid.insertAdjacentHTML('beforeend', itemHtml);
                    });
                })
                .catch(function() {
                    grid.innerHTML = '<div style="width:100%;text-align:center;padding:20px;color:red;">Failed to retrieve content bank.</div>';
                });
        });

        var tabs = modalEl.querySelectorAll('.nav-tabs, .searchbar, [role="tablist"]');
        tabs.forEach(function(tab) { tab.style.display = 'none'; });

        var titleRoot = modalEl.closest('.modal, .moodle-dialogue') || modalEl;
        var title = titleRoot.querySelector('.modal-title, [data-region="dialogue-header"] h4');
        if (title) {
            title.innerText = 'Select Content from Bank';
        }
    }

    function scanAndApply() {
        var candidates = document.querySelectorAll('.modal-dialog .modal-content, [data-region="activity-chooser"], [data-region="activitychooser"], [data-region="modules"], .moodle-dialogue-bd');
        candidates.forEach(function(el) {
            applyChooser(el);
        });
    }

    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mut) {
            if (mut.addedNodes && mut.addedNodes.length > 0) {
                scanAndApply();
            }
        });
    });
    observer.observe(document.body, {childList: true, subtree: true});

    document.addEventListener('click', function(e) {
        var trigger = e.target.closest('[data-action="open-chooser"], .activity-add, .section-modchooser-link');
        if (!trigger) {
            return;
        }
        lastSectionId = trigger.dataset.sectionid || trigger.getAttribute('data-sectionid') || 0;
        setTimeout(scanAndApply, 70);
        setTimeout(scanAndApply, 250);
        setTimeout(scanAndApply, 700);
    }, true);

    scanAndApply();
    setTimeout(scanAndApply, 900);
});
</script>
JS;
        $hook->set_html($html . $js);
    }
}

__halt_compiler();

            logoEl.src = logoUrl;
            logoEl.alt = schoolName;
        } else {
            /**
             * Overrides for teachers operating natively inside Moodle Course pages.
             */
            private static function inject_teacher_course_overrides(\core\hook\output\before_standard_html_head $hook, string $path): void {
                if (strpos($path, '/course/view.php') !== 0) {
                    return;
                }

                $html = $hook->get_html();
                $sesskey = sesskey();
                $js = <<<JS
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.info('[Istikama] chooser override loaded');
            document.documentElement.setAttribute('data-istikama-chooser-hook', '1');

            var lastSectionId = 0;

            function isChooserModal(modalEl) {
                if (!modalEl) {
                    return false;
                }
                if (modalEl.matches('[data-region="activity-chooser"], [data-region="activitychooser"], [data-region="modules"]') ||
                    modalEl.querySelector('[data-region="activity-chooser"], [data-region="activitychooser"], [data-region="modules"]')) {
                    return true;
                }
                var txt = (modalEl.textContent || '').toLowerCase();
                return txt.includes('add an activity') || txt.includes('add a resource') ||
                       txt.includes('ajouter une activité') || txt.includes('ajouter une ressource') ||
                       txt.includes('إضافة نشاط') || txt.includes('إضافة مورد');
            }

            function getCourseId() {
                return new URLSearchParams(window.location.search).get('id') || document.body.dataset.courseId || 0;
            }

            function fetchApprovedContent(courseId) {
                return fetch('/local/istikama_admin/ajax.php?action=get_chooser_content&courseid=' + courseId + '&sesskey={$sesskey}')
                    .then(function(response) {
                        return response.json();
                    });
            }

            function decorateChooser(modalEl) {
                if (!isChooserModal(modalEl) || modalEl.dataset.istiInjected === 'true') {
                    return;
                }

                modalEl.dataset.istiInjected = 'true';
                var courseId = getCourseId();
                var sectionId = lastSectionId || 0;
                var expandedBtn = document.querySelector('[data-action="open-chooser"][aria-expanded="true"]');
                if (expandedBtn && expandedBtn.dataset.sectionid) {
                    sectionId = expandedBtn.dataset.sectionid;
                }

                setTimeout(function() {
                    var grids = Array.from(modalEl.querySelectorAll('[data-region="modules"], .options, .modules, .activitychooser-options, .chooser-options, [role="list"]'));
                    if (grids.length === 0 && modalEl.matches('[data-region="modules"]')) {
                        grids = [modalEl];
                    }
                    if (grids.length === 0) {
                        var fallback = modalEl.querySelector('.modal-body, [data-region="activity-chooser"], [data-region="activitychooser"]');
                        if (fallback) {
                            grids = [fallback];
                        }
                    }
                    if (grids.length === 0) {
                        return;
                    }

                    grids.forEach(function(grid) {
                        grid.innerHTML = '<div style="width:100%;text-align:center;padding:20px;">Fetching Approved Content...</div>';
                        fetchApprovedContent(courseId)
                            .then(function(data) {
                                grid.innerHTML = '';
                                if (!data || data.length === 0 || data.error) {
                                    grid.innerHTML = '<div style="width:100%;text-align:center;padding:20px;color:#64748b;">No approved content found for this level.</div>';
                                    return;
                                }

                                data.forEach(function(item) {
                                    var desc = item.description ? '<div style="font-size:11px;color:#6b7280;margin-top:4px;line-height:1.3;max-height:2.6em;overflow:hidden;">' + item.description + '</div>' : '';
                                    var date = item.date ? '<div style="font-size:10px;color:#94a3b8;margin-top:3px;">' + item.date + '</div>' : '';
                                    var itemHtml = '<div class="option" role="listitem" style="border: 1px solid #e2e8f0; background-color: #f8fafc; border-radius: 8px; margin: 4px; flex-grow: 1; flex-basis: 160px; transition: all 0.2s;"><a href="/local/istikama_admin/add_from_bank.php?courseid=' + courseId + '&sectionid=' + sectionId + '&contentid=' + item.id + '" class="d-flex flex-column text-center align-items-center p-3" style="text-decoration:none; color:inherit;width:100%;"><div class="icon-container mb-2" style="font-size:32px;">' + item.icon + '</div><div class="optionname" style="font-weight:600; color:#0f172a;font-size:13px;word-break:break-word;">' + item.name + '</div><div style="font-size:11px;color:#64748b;margin-top:4px;text-transform:uppercase;">' + item.content_type + '</div>' + desc + date + '</a></div>';
                                    grid.insertAdjacentHTML('beforeend', itemHtml);
                                });
                            })
                            .catch(function() {
                                grid.innerHTML = '<div style="width:100%;text-align:center;padding:20px;color:red;">Failed to retrieve content bank.</div>';
                            });
                    });

                    var tabsMenu = modalEl.querySelectorAll('.nav-tabs, .searchbar, [role="tablist"]');
                    tabsMenu.forEach(function(tab) {
                        tab.style.display = 'none';
                    });

                    var titleRoot = modalEl.closest('.modal, .moodle-dialogue') || modalEl;
                    var title = titleRoot.querySelector('.modal-title, [data-region="dialogue-header"] h4');
                    if (title) {
                        title.innerText = 'Select Content from Bank';
                    }
                }, 180);
            }

            function scanAndDecorate() {
                var modals = document.querySelectorAll('.modal-dialog .modal-content, [data-region="activity-chooser"], [data-region="activitychooser"], [data-region="modules"], .moodle-dialogue-bd');
                modals.forEach(function(modalEl) {
                    decorateChooser(modalEl);
                });
            }

            var observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mut) {
                    if (mut.addedNodes && mut.addedNodes.length > 0) {
                        scanAndDecorate();
                    }
                });
            });
            observer.observe(document.body, { childList: true, subtree: true });

            document.addEventListener('click', function(e) {
                var trigger = e.target.closest('[data-action="open-chooser"], .activity-add, .section-modchooser-link');
                if (!trigger) {
                    return;
                }

                lastSectionId = trigger.dataset.sectionid || trigger.getAttribute('data-sectionid') || 0;
                setTimeout(scanAndDecorate, 60);
                setTimeout(scanAndDecorate, 240);
                setTimeout(scanAndDecorate, 700);
            }, true);

            scanAndDecorate();
            setTimeout(scanAndDecorate, 800);
        });
        </script>
        JS;
                $hook->set_html($html . $js);
            }
        }

            var tabsMenu = modalEl.querySelectorAll('.nav-tabs, .searchbar, [role="tablist"]');
            tabsMenu.forEach(function(tab) {
                tab.style.display = 'none';
            });

            var titleRoot = modalEl.closest('.modal, .moodle-dialogue') || modalEl;
            var title = titleRoot.querySelector('.modal-title, [data-region="dialogue-header"] h4');
            if (title) {
                title.innerText = 'Select Content from Bank';
            }
        }, 180);
    }

    function scanAndDecorate() {
        var modals = document.querySelectorAll('.modal-dialog .modal-content, [data-region="activity-chooser"], [data-region="activitychooser"], [data-region="modules"], .moodle-dialogue-bd');
        modals.forEach(function(modalEl) {
            decorateChooser(modalEl);
        });
    }

    var observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mut) {
            if (mut.addedNodes && mut.addedNodes.length > 0) {
                scanAndDecorate();
            }
        });
    });
    observer.observe(document.body, { childList: true, subtree: true });

    document.addEventListener('click', function(e) {
        var trigger = e.target.closest('[data-action="open-chooser"], .activity-add, .section-modchooser-link');
        if (!trigger) {
            return;
        }

        lastSectionId = trigger.dataset.sectionid || trigger.getAttribute('data-sectionid') || 0;
        setTimeout(scanAndDecorate, 60);
        setTimeout(scanAndDecorate, 240);
        setTimeout(scanAndDecorate, 700);
    }, true);

    scanAndDecorate();
    setTimeout(scanAndDecorate, 800);
});
</script>
JS;
        $hook->set_html($html . $js);
    }
}

