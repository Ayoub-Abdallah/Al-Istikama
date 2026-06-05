<?php

class __Mustache_b405481b049cea37b30a98b5329fbdcd extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        if ($partial = $this->mustache->loadPartial('theme_boost/head')) {
            $buffer .= $partial->renderInternal($context);
        }
        $buffer .= $indent . '
';
        $buffer .= $indent . '<body ';
        $value = $this->resolveValue($context->find('bodyattributes'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= ' data-istikama-tier="';
        $value = $this->resolveValue($context->find('tier'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '" data-istikama-level="';
        $value = $this->resolveValue($context->find('userlevel'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '">
';
        $buffer .= $indent . '<script>
';
        $buffer .= $indent . '/* Apply dark-mode preference synchronously to avoid a flash of light content.
';
        $buffer .= $indent . '   ── TEMPORARILY DISABLED (2026-06) alongside the hidden dark-mode toggle ──
';
        $buffer .= $indent . '   The dark-mode CSS + toggle JS are all preserved. To fully restore dark mode,
';
        $buffer .= $indent . '   un-comment the line below AND remove style="display:none" hidden from the
';
        $buffer .= $indent . '   #istiDarkModeToggle button later in this file. Nothing else is needed. */
';
        $buffer .= $indent . '/* (function(){ try { if (localStorage.getItem(\'isti-dark-mode\') === \'1\') { document.body.classList.add(\'dark-mode\'); } } catch(e) {} })(); */
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '/* Global safety net for legacy Moodle / 3rd-party JS that calls
';
        $buffer .= $indent . '   addEventListener on null elements (boost drawer, block-level tour init,
';
        $buffer .= $indent . '   etc.). We log but never let the dashboard die because of these. */
';
        $buffer .= $indent . '(function() {
';
        $buffer .= $indent . '    window.addEventListener(\'error\', function(e) {
';
        $buffer .= $indent . '        var msg = e && e.message ? String(e.message) : \'\';
';
        $buffer .= $indent . '        if (msg.indexOf("Cannot read properties of null") !== -1 ||
';
        $buffer .= $indent . '            msg.indexOf("Cannot read property \'addEventListener\'") !== -1 ||
';
        $buffer .= $indent . '            msg.indexOf("null is not an object") !== -1) {
';
        $buffer .= $indent . '            if (window.console && console.warn) {
';
        $buffer .= $indent . '                console.warn(\'[istikama] Suppressed dashboard JS error:\', msg, e.filename + \':\' + e.lineno);
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '            e.preventDefault();
';
        $buffer .= $indent . '            return true;
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '    }, true);
';
        $buffer .= $indent . '    window.addEventListener(\'unhandledrejection\', function(e) {
';
        $buffer .= $indent . '        if (window.console && console.warn) {
';
        $buffer .= $indent . '            console.warn(\'[istikama] Unhandled promise rejection (suppressed):\', e.reason);
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '        e.preventDefault();
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '})();
';
        $buffer .= $indent . '</script>
';
        if ($partial = $this->mustache->loadPartial('core/local/toast/wrapper')) {
            $buffer .= $partial->renderInternal($context);
        }
        $value = $this->resolveValue($context->findDot('output.standard_top_of_body_html'), $context);
        $buffer .= $indent . ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<link rel="preconnect" href="https://fonts.googleapis.com">
';
        $buffer .= $indent . '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
';
        $buffer .= $indent . '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&family=Noto+Sans+Arabic:wght@400;500;600;700;800&display=swap">
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<link rel="stylesheet" href="/local/istikama_admin/styles/istikama_dashboard.css?v=19">
';
        $buffer .= $indent . '<link rel="stylesheet" href="/local/istikama_admin/styles/istikama_admin.css?v=29">
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- ═══ SIDEBAR ═══ -->
';
        $buffer .= $indent . '<aside class="isti-sidebar" id="istiSidebar">
';
        $buffer .= $indent . '    <div class="isti-sidebar-brand" title="';
        $value = $this->resolveValue($context->find('schoolbrandname'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '">
';
        $value = $context->find('schoolbrandlogo');
        $buffer .= $this->section4ece2ea01b45a76eca1fff8d145d21b6($context, $indent, $value);
        $value = $context->find('schoolbrandlogo');
        if (empty($value)) {
            
            $buffer .= $indent . '        <div class="isti-sidebar-brand-badge">';
            $value = $this->resolveValue($context->find('schoolbrandinitial'), $context);
            $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
            $buffer .= '</div>
';
        }
        $value = $context->find('isplatformlogo');
        if (empty($value)) {
            
            $buffer .= $indent . '        <div class="isti-sidebar-brand-text">
';
            $buffer .= $indent . '            <span class="isti-sidebar-brand-name">';
            $value = $this->resolveValue($context->find('schoolbrandname'), $context);
            $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
            $buffer .= '</span>
';
            $buffer .= $indent . '        </div>
';
        }
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <nav class="isti-sidebar-nav">
';
        $buffer .= $indent . '        <div class="isti-sidebar-section">
';
        $buffer .= $indent . '            <div class="isti-sidebar-section-title">';
        $value = $context->find('str');
        $buffer .= $this->section24764c4f0d5c5bb7d8b4be30028d5243($context, $indent, $value);
        $buffer .= '</div>
';
        $value = $context->find('sidebaritems');
        $buffer .= $this->section2731b8204c09b71de444e6fd16dca8a5($context, $indent, $value);
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </nav>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <div class="isti-sidebar-footer">
';
        $buffer .= $indent . '        <a href="';
        $value = $this->resolveValue($context->find('logouturl'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '" class="isti-nav-item" style="color:#f87171;">
';
        $buffer .= $indent . '            <i class="fa fa-sign-out-alt"></i>
';
        $buffer .= $indent . '            <span>';
        $value = $context->find('str');
        $buffer .= $this->section1baf1c786b07388405a84c8441ca0998($context, $indent, $value);
        $buffer .= '</span>
';
        $buffer .= $indent . '        </a>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</aside>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- ═══ SIDEBAR OVERLAY (mobile) ═══ -->
';
        $buffer .= $indent . '<div class="isti-sidebar-overlay" id="istiSidebarOverlay"></div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- ═══ TOPBAR ═══ -->
';
        $buffer .= $indent . '<header class="isti-topbar" id="istiTopbar">
';
        $buffer .= $indent . '    <button class="isti-topbar-toggle" id="istiSidebarToggle" aria-label="Toggle sidebar">
';
        $buffer .= $indent . '        <i class="fa fa-bars"></i>
';
        $buffer .= $indent . '    </button>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <div class="isti-topbar-search" id="istiSearchWrap">
';
        $buffer .= $indent . '        <i class="fa fa-search"></i>
';
        $buffer .= $indent . '        <input type="text" placeholder="';
        $value = $context->find('str');
        $buffer .= $this->sectionFfdb7c82e3ec92a063ae74618929303a($context, $indent, $value);
        $buffer .= '" id="istiGlobalSearch" autocomplete="off" role="combobox" aria-expanded="false" aria-autocomplete="list" aria-controls="istiSearchDropdown">
';
        $buffer .= $indent . '        <span class="isti-search-spinner" id="istiSearchSpinner" aria-hidden="true"></span>
';
        $buffer .= $indent . '        <div class="isti-search-dropdown" id="istiSearchDropdown" role="listbox"></div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <div class="isti-topbar-actions">
';
        $buffer .= $indent . '        <button class="isti-topbar-btn" title="Dark mode" id="istiDarkModeToggle" style="display:none" hidden aria-hidden="true">
';
        $buffer .= $indent . '            <i class="fa fa-moon"></i>
';
        $buffer .= $indent . '        </button>
';
        $buffer .= $indent . '
';
        $value = $context->find('langmenu');
        $buffer .= $this->sectionDc79c419173ced31afb4a2b716497c3c($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '        ';
        $value = $this->resolveValue($context->findDot('output.navbar_plugin_output'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        <div class="d-flex align-items-stretch usermenu-container" data-region="usermenu">
';
        $value = $context->find('usermenu');
        $buffer .= $this->sectionC1a074dbb434be152581dde91d267c63($context, $indent, $value);
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        ';
        $value = $this->resolveValue($context->findDot('output.edit_switch'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</header>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- ═══ GLOBAL SEARCH (permission-aware dropdown) ═══ -->
';
        $buffer .= $indent . '<script>
';
        $buffer .= $indent . '(function(){
';
        $buffer .= $indent . '  var input = document.getElementById(\'istiGlobalSearch\');
';
        $buffer .= $indent . '  var dd    = document.getElementById(\'istiSearchDropdown\');
';
        $buffer .= $indent . '  var wrap  = document.getElementById(\'istiSearchWrap\');
';
        $buffer .= $indent . '  var spin  = document.getElementById(\'istiSearchSpinner\');
';
        $buffer .= $indent . '  if(!input || !dd) return;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '  var SEARCH_URL = \'/local/istikama_admin/search.php\';
';
        $buffer .= $indent . '  var STR = {
';
        $buffer .= $indent . '    recent:   ';
        $value = $context->find('quote');
        $buffer .= $this->sectionCbb57d899ac960f14004071783fac71d($context, $indent, $value);
        $buffer .= ',
';
        $buffer .= $indent . '    none:     ';
        $value = $context->find('quote');
        $buffer .= $this->sectionF6b65ea350ee986144dda3cf18dafeb5($context, $indent, $value);
        $buffer .= ',
';
        $buffer .= $indent . '    clear:    ';
        $value = $context->find('quote');
        $buffer .= $this->sectionD69c782e5191ce3992ca9435771de2fa($context, $indent, $value);
        $buffer .= '
';
        $buffer .= $indent . '  };
';
        $buffer .= $indent . '  var CATS = {
';
        $buffer .= $indent . '    pages:   ';
        $value = $context->find('quote');
        $buffer .= $this->sectionC628d764a519f04184e0095d58115da8($context, $indent, $value);
        $buffer .= ',
';
        $buffer .= $indent . '    users:   ';
        $value = $context->find('quote');
        $buffer .= $this->section29707c7edbb032dd4b0293fd44c008b7($context, $indent, $value);
        $buffer .= ',
';
        $buffer .= $indent . '    courses: ';
        $value = $context->find('quote');
        $buffer .= $this->section1c1660249fd8565f704d929f84088b9c($context, $indent, $value);
        $buffer .= ',
';
        $buffer .= $indent . '    admin:   ';
        $value = $context->find('quote');
        $buffer .= $this->section087a408c790e495c3cfb9d044b602530($context, $indent, $value);
        $buffer .= '
';
        $buffer .= $indent . '  };
';
        $buffer .= $indent . '  var RECENT_KEY = \'isti-search-recent\';
';
        $buffer .= $indent . '  var timer=null, lastQ=\'\', items=[], active=-1, open=false;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '  function esc(s){ var d=document.createElement(\'div\'); d.textContent=(s==null?\'\':String(s)); return d.innerHTML; }
';
        $buffer .= $indent . '  function getRecent(){ try{ return JSON.parse(localStorage.getItem(RECENT_KEY)||\'[]\'); }catch(e){ return []; } }
';
        $buffer .= $indent . '  function pushRecent(it){ try{ var r=getRecent().filter(function(x){return x.url!==it.url;}); r.unshift({label:it.label,url:it.url,icon:it.icon}); localStorage.setItem(RECENT_KEY, JSON.stringify(r.slice(0,5))); }catch(e){} }
';
        $buffer .= $indent . '  function clearRecent(){ try{ localStorage.removeItem(RECENT_KEY); }catch(e){} renderRecent(); }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '  function setOpen(v){ open=v; wrap.classList.toggle(\'isti-search-open\', v); input.setAttribute(\'aria-expanded\', v?\'true\':\'false\'); }
';
        $buffer .= $indent . '  function close(){ setOpen(false); active=-1; }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '  function row(it, idx, cat){
';
        $buffer .= $indent . '    return \'<a class="isti-search-item" role="option" data-idx="\'+idx+\'" href="\'+esc(it.url)+\'">\'+
';
        $buffer .= $indent . '      \'<span class="isti-search-ic"><i class="fa \'+esc(it.icon||\'fa-arrow-right\')+\'"></i></span>\'+
';
        $buffer .= $indent . '      \'<span class="isti-search-tx"><span class="isti-search-lbl">\'+esc(it.label)+\'</span>\'+
';
        $buffer .= $indent . '      (it.sublabel?\'<span class="isti-search-sub">\'+esc(it.sublabel)+\'</span>\':\'\')+\'</span></a>\';
';
        $buffer .= $indent . '  }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '  function renderResults(results){
';
        $buffer .= $indent . '    items = results;
';
        $buffer .= $indent . '    if(!results.length){ dd.innerHTML=\'<div class="isti-search-empty"><i class="fa fa-magnifying-glass"></i> \'+esc(STR.none)+\'</div>\'; setOpen(true); return; }
';
        $buffer .= $indent . '    var html=\'\', cat=null, idx=0;
';
        $buffer .= $indent . '    results.forEach(function(it){
';
        $buffer .= $indent . '      if(it.category!==cat){ cat=it.category; html+=\'<div class="isti-search-cat">\'+esc(CATS[cat]||cat)+\'</div>\'; }
';
        $buffer .= $indent . '      html+=row(it, idx, cat); idx++;
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '    dd.innerHTML=html; active=-1; setOpen(true); bindRows();
';
        $buffer .= $indent . '  }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '  function renderRecent(){
';
        $buffer .= $indent . '    var r=getRecent();
';
        $buffer .= $indent . '    if(!r.length){ return false; }
';
        $buffer .= $indent . '    items=r;
';
        $buffer .= $indent . '    var html=\'<div class="isti-search-cat">\'+esc(STR.recent)+\'<button type="button" class="isti-search-clear" id="istiSearchClear">\'+esc(STR.clear)+\'</button></div>\';
';
        $buffer .= $indent . '    r.forEach(function(it,i){ html+=row(it,i,\'recent\'); });
';
        $buffer .= $indent . '    dd.innerHTML=html; active=-1; setOpen(true); bindRows();
';
        $buffer .= $indent . '    var cb=document.getElementById(\'istiSearchClear\'); if(cb) cb.addEventListener(\'click\',function(e){ e.preventDefault(); e.stopPropagation(); clearRecent(); });
';
        $buffer .= $indent . '    return true;
';
        $buffer .= $indent . '  }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '  function bindRows(){
';
        $buffer .= $indent . '    dd.querySelectorAll(\'.isti-search-item\').forEach(function(a){
';
        $buffer .= $indent . '      a.addEventListener(\'mousedown\', function(e){ e.preventDefault(); pushRecent(items[parseInt(a.getAttribute(\'data-idx\'),10)]); window.location.href=a.getAttribute(\'href\'); });
';
        $buffer .= $indent . '      a.addEventListener(\'mouseenter\', function(){ active=parseInt(a.getAttribute(\'data-idx\'),10); paint(); });
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '  }
';
        $buffer .= $indent . '  function paint(){ dd.querySelectorAll(\'.isti-search-item\').forEach(function(a){ a.classList.toggle(\'active\', parseInt(a.getAttribute(\'data-idx\'),10)===active); }); }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '  function doSearch(q){
';
        $buffer .= $indent . '    if(spin) spin.classList.add(\'on\');
';
        $buffer .= $indent . '    fetch(SEARCH_URL+\'?q=\'+encodeURIComponent(q), {credentials:\'same-origin\'})
';
        $buffer .= $indent . '      .then(function(r){return r.json();})
';
        $buffer .= $indent . '      .then(function(d){ if(spin) spin.classList.remove(\'on\'); if(input.value.trim()===q){ renderResults((d&&d.results)||[]); } })
';
        $buffer .= $indent . '      .catch(function(){ if(spin) spin.classList.remove(\'on\'); });
';
        $buffer .= $indent . '  }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '  input.addEventListener(\'input\', function(){
';
        $buffer .= $indent . '    var q=input.value.trim();
';
        $buffer .= $indent . '    if(timer) clearTimeout(timer);
';
        $buffer .= $indent . '    if(q.length<2){ if(!renderRecent()) close(); return; }
';
        $buffer .= $indent . '    timer=setTimeout(function(){ if(q!==lastQ){ lastQ=q; } doSearch(q); }, 220);
';
        $buffer .= $indent . '  });
';
        $buffer .= $indent . '  input.addEventListener(\'focus\', function(){ var q=input.value.trim(); if(q.length>=2){ if(items.length) setOpen(true); else doSearch(q); } else { renderRecent(); } });
';
        $buffer .= $indent . '  input.addEventListener(\'keydown\', function(e){
';
        $buffer .= $indent . '    if(!open) return;
';
        $buffer .= $indent . '    var n=dd.querySelectorAll(\'.isti-search-item\').length;
';
        $buffer .= $indent . '    if(e.key===\'ArrowDown\'){ e.preventDefault(); active=Math.min(active+1,n-1); paint(); scrollTo(); }
';
        $buffer .= $indent . '    else if(e.key===\'ArrowUp\'){ e.preventDefault(); active=Math.max(active-1,0); paint(); scrollTo(); }
';
        $buffer .= $indent . '    else if(e.key===\'Enter\'){ if(active>=0&&items[active]){ e.preventDefault(); pushRecent(items[active]); window.location.href=items[active].url; } }
';
        $buffer .= $indent . '    else if(e.key===\'Escape\'){ close(); input.blur(); }
';
        $buffer .= $indent . '  });
';
        $buffer .= $indent . '  function scrollTo(){ var el=dd.querySelector(\'.isti-search-item.active\'); if(el&&el.scrollIntoView) el.scrollIntoView({block:\'nearest\'}); }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '  document.addEventListener(\'click\', function(e){ if(!wrap.contains(e.target)) close(); });
';
        $buffer .= $indent . '})();
';
        $buffer .= $indent . '</script>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- ═══ MAIN CONTENT ═══ -->
';
        $buffer .= $indent . '<main class="isti-main" id="istiMainContent">
';
        $buffer .= $indent . '    <div id="page-wrapper">
';
        $buffer .= $indent . '        <div id="page" data-region="mainpage" data-usertour="scroller" class="drawers">
';
        $buffer .= $indent . '            <div id="topofscroll" class="main-inner">
';
        $buffer .= $indent . '                ';
        $value = $this->resolveValue($context->findDot('output.full_header'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $value = $context->find('secondarymoremenu');
        $buffer .= $this->section4f721713009e54f14c799fa89336f6ee($context, $indent, $value);
        $buffer .= $indent . '
';
        $value = $context->find('isdashboard');
        $buffer .= $this->section764458fe23d32f70a9ff5d8f19be4ee7($context, $indent, $value);
        $buffer .= $indent . '
';
        $buffer .= $indent . '                <div id="page-content" class="d-print-block">
';
        $buffer .= $indent . '                    <div id="region-main-box">
';
        $value = $context->find('hasregionmainsettingsmenu');
        $buffer .= $this->section346492518df262484486db9a461398f2($context, $indent, $value);
        $buffer .= $indent . '                        <div id="region-main">
';
        $value = $context->find('hasregionmainsettingsmenu');
        $buffer .= $this->section85b38e2ef114feb4bcec35483a18248f($context, $indent, $value);
        $buffer .= $indent . '                            ';
        $value = $this->resolveValue($context->findDot('output.course_content_header'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $value = $context->find('headercontent');
        $buffer .= $this->section10ab9b7b6d2d94caa34262ddc48e2718($context, $indent, $value);
        $value = $context->find('overflow');
        $buffer .= $this->section6bf36f1a79af754fa25425b0182d3182($context, $indent, $value);
        $buffer .= $indent . '                            ';
        $value = $this->resolveValue($context->findDot('output.main_content'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '                            ';
        $value = $this->resolveValue($context->findDot('output.activity_navigation'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '                            ';
        $value = $this->resolveValue($context->findDot('output.course_content_footer'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '                        </div>
';
        $buffer .= $indent . '                    </div>
';
        $value = $context->find('hasblocks');
        $buffer .= $this->section7db37fc1d0ef38731265018ab95e330d($context, $indent, $value);
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '    ';
        $value = $this->resolveValue($context->find('addblockbutton'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '    ';
        $value = $this->resolveValue($context->findDot('output.standard_after_main_region_html'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '</main>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<!-- ═══ DASHBOARD JS ═══ -->
';
        $buffer .= $indent . '<script>
';
        $buffer .= $indent . '/**
';
        $buffer .= $indent . ' * Istikama dashboard wiring.
';
        $buffer .= $indent . ' *
';
        $buffer .= $indent . ' * Every element lookup is null-guarded and every block is wrapped in
';
        $buffer .= $indent . ' * try/catch so a missing element in one feature can never break another.
';
        $buffer .= $indent . ' * The whole runner waits for DOMContentLoaded; if the script tag is loaded
';
        $buffer .= $indent . ' * after DOMContentLoaded already fired we run immediately.
';
        $buffer .= $indent . ' */
';
        $buffer .= $indent . '(function() {
';
        $buffer .= $indent . '    function safeRun(fn) {
';
        $buffer .= $indent . '        try { fn(); } catch (err) {
';
        $buffer .= $indent . '            if (window.console && console.warn) {
';
        $buffer .= $indent . '                console.warn(\'[istikama] dashboard JS guarded error:\', err);
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function boot() {
';
        $buffer .= $indent . '        var sidebar    = document.getElementById(\'istiSidebar\');
';
        $buffer .= $indent . '        var overlay    = document.getElementById(\'istiSidebarOverlay\');
';
        $buffer .= $indent . '        var toggle     = document.getElementById(\'istiSidebarToggle\');
';
        $buffer .= $indent . '        var darkToggle = document.getElementById(\'istiDarkModeToggle\');
';
        $buffer .= $indent . '        var isMobile   = window.innerWidth <= 1024;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // ── Sidebar toggle ────────────────────────────────────────────────
';
        $buffer .= $indent . '        safeRun(function() {
';
        $buffer .= $indent . '            if (!toggle) { return; }
';
        $buffer .= $indent . '            toggle.addEventListener(\'click\', function() {
';
        $buffer .= $indent . '                if (!sidebar) { return; }
';
        $buffer .= $indent . '                if (isMobile) {
';
        $buffer .= $indent . '                    sidebar.classList.toggle(\'mobile-open\');
';
        $buffer .= $indent . '                    if (overlay) { overlay.classList.toggle(\'visible\'); }
';
        $buffer .= $indent . '                } else {
';
        $buffer .= $indent . '                    sidebar.classList.toggle(\'collapsed\');
';
        $buffer .= $indent . '                    try {
';
        $buffer .= $indent . '                        localStorage.setItem(\'isti-sidebar-collapsed\',
';
        $buffer .= $indent . '                            sidebar.classList.contains(\'collapsed\') ? \'1\' : \'0\');
';
        $buffer .= $indent . '                    } catch (e) { /* localStorage may be disabled */ }
';
        $buffer .= $indent . '                }
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // ── Mobile overlay click ──────────────────────────────────────────
';
        $buffer .= $indent . '        safeRun(function() {
';
        $buffer .= $indent . '            if (!overlay) { return; }
';
        $buffer .= $indent . '            overlay.addEventListener(\'click\', function() {
';
        $buffer .= $indent . '                if (sidebar) { sidebar.classList.remove(\'mobile-open\'); }
';
        $buffer .= $indent . '                overlay.classList.remove(\'visible\');
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // ── Restore sidebar state from localStorage ───────────────────────
';
        $buffer .= $indent . '        safeRun(function() {
';
        $buffer .= $indent . '            if (!sidebar || isMobile) { return; }
';
        $buffer .= $indent . '            try {
';
        $buffer .= $indent . '                if (localStorage.getItem(\'isti-sidebar-collapsed\') === \'1\') {
';
        $buffer .= $indent . '                    sidebar.classList.add(\'collapsed\');
';
        $buffer .= $indent . '                }
';
        $buffer .= $indent . '            } catch (e) { /* localStorage may be disabled */ }
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // ── Responsive resize handler ─────────────────────────────────────
';
        $buffer .= $indent . '        safeRun(function() {
';
        $buffer .= $indent . '            window.addEventListener(\'resize\', function() {
';
        $buffer .= $indent . '                isMobile = window.innerWidth <= 1024;
';
        $buffer .= $indent . '                if (!isMobile) {
';
        $buffer .= $indent . '                    if (sidebar) { sidebar.classList.remove(\'mobile-open\'); }
';
        $buffer .= $indent . '                    if (overlay) { overlay.classList.remove(\'visible\'); }
';
        $buffer .= $indent . '                }
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // ── Dark mode toggle ──────────────────────────────────────────────
';
        $buffer .= $indent . '        safeRun(function() {
';
        $buffer .= $indent . '            if (!darkToggle) { return; }
';
        $buffer .= $indent . '            var isDark = false;
';
        $buffer .= $indent . '            try { isDark = localStorage.getItem(\'isti-dark-mode\') === \'1\'; }
';
        $buffer .= $indent . '            catch (e) { /* localStorage may be disabled */ }
';
        $buffer .= $indent . '            var darkIcon = darkToggle.querySelector(\'i\');
';
        $buffer .= $indent . '            if (isDark && document.body) {
';
        $buffer .= $indent . '                document.body.classList.add(\'dark-mode\');
';
        $buffer .= $indent . '                if (darkIcon) { darkIcon.className = \'fa fa-sun\'; }
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '            darkToggle.addEventListener(\'click\', function() {
';
        $buffer .= $indent . '                if (!document.body) { return; }
';
        $buffer .= $indent . '                document.body.classList.toggle(\'dark-mode\');
';
        $buffer .= $indent . '                var nowDark = document.body.classList.contains(\'dark-mode\');
';
        $buffer .= $indent . '                try { localStorage.setItem(\'isti-dark-mode\', nowDark ? \'1\' : \'0\'); }
';
        $buffer .= $indent . '                catch (e) { /* localStorage may be disabled */ }
';
        $buffer .= $indent . '                var ic = darkToggle.querySelector(\'i\');
';
        $buffer .= $indent . '                if (ic) { ic.className = nowDark ? \'fa fa-sun\' : \'fa fa-moon\'; }
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ──────────────────────────────────────────────────────────────
';
        $buffer .= $indent . '    // Teacher: intercept Moodle\'s activity chooser "+" button and
';
        $buffer .= $indent . '    // show our custom 2-option modal (Library content / Quiz).
';
        $buffer .= $indent . '    // ──────────────────────────────────────────────────────────────
';
        $buffer .= $indent . '    safeRun(function() {
';
        $buffer .= $indent . '        if (!document.body) { return; }
';
        $buffer .= $indent . '        var bodyTier = document.body.getAttribute(\'data-istikama-tier\') || \'\';
';
        $buffer .= $indent . '        if (bodyTier !== \'teacher\' && bodyTier !== \'teacher_creator\') {
';
        $buffer .= $indent . '            return;
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        var addModalEl = null;
';
        $buffer .= $indent . '        var pendingCtx = null;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        var courseIdFromContext = function() {
';
        $buffer .= $indent . '            // Try Moodle\'s M.cfg first, then body class "course-{id}", then URL ?id=.
';
        $buffer .= $indent . '            if (window.M && M.cfg && M.cfg.courseId) { return String(M.cfg.courseId); }
';
        $buffer .= $indent . '            var bodyClass = (document.body && document.body.className) || \'\';
';
        $buffer .= $indent . '            var m = bodyClass.match(/(?:^|\\s)course-(\\d+)/);
';
        $buffer .= $indent . '            if (m) { return m[1]; }
';
        $buffer .= $indent . '            var u = new URL(window.location.href);
';
        $buffer .= $indent . '            var id = u.searchParams.get(\'id\');
';
        $buffer .= $indent . '            if (id && /course\\/view\\.php/.test(u.pathname)) { return id; }
';
        $buffer .= $indent . '            return \'\';
';
        $buffer .= $indent . '        };
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        var _istiM = {
';
        $buffer .= $indent . '            title:      "';
        $value = $context->find('str');
        $buffer .= $this->section436f64ad88f6f4a5fc37ff5bbdeceeb4($context, $indent, $value);
        $buffer .= '",
';
        $buffer .= $indent . '            libTitle:   "';
        $value = $context->find('str');
        $buffer .= $this->section1f7000783141226ba4f7272aa2160f64($context, $indent, $value);
        $buffer .= '",
';
        $buffer .= $indent . '            libDesc:    "';
        $value = $context->find('str');
        $buffer .= $this->section0a27ba8ac139006f207ee0f0a929bc77($context, $indent, $value);
        $buffer .= '",
';
        $buffer .= $indent . '            quizTitle:  "';
        $value = $context->find('str');
        $buffer .= $this->sectionC5f726fe25601b9c503d04916ff59dad($context, $indent, $value);
        $buffer .= '",
';
        $buffer .= $indent . '            quizDesc:   "';
        $value = $context->find('str');
        $buffer .= $this->sectionD86fc2e346741eccf0723b945e6a4459($context, $indent, $value);
        $buffer .= '",
';
        $buffer .= $indent . '            forumTitle: "';
        $value = $context->find('str');
        $buffer .= $this->sectionB641bb5b6e74bb1e24f2dc2a02660301($context, $indent, $value);
        $buffer .= '",
';
        $buffer .= $indent . '            forumDesc:  "';
        $value = $context->find('str');
        $buffer .= $this->sectionBfaa283bbcd826ed3f1a74f21a725115($context, $indent, $value);
        $buffer .= '"
';
        $buffer .= $indent . '        };
';
        $buffer .= $indent . '        var buildModal = function() {
';
        $buffer .= $indent . '            if (addModalEl) { return; }
';
        $buffer .= $indent . '            addModalEl = document.createElement(\'div\');
';
        $buffer .= $indent . '            addModalEl.className = \'isti-addmodal-backdrop\';
';
        $buffer .= $indent . '            addModalEl.setAttribute(\'style\',
';
        $buffer .= $indent . '                \'display:none;position:fixed;inset:0;z-index:1100;\' +
';
        $buffer .= $indent . '                \'background:rgba(15,23,42,.55);align-items:center;justify-content:center;\');
';
        $buffer .= $indent . '            addModalEl.innerHTML =
';
        $buffer .= $indent . '                \'<div class="isti-addmodal-dialog" role="dialog" aria-modal="true" \' +
';
        $buffer .= $indent . '                \'style="background:#fff;border-radius:18px;width:min(620px,95vw);\' +
';
        $buffer .= $indent . '                \'box-shadow:0 20px 60px rgba(0,0,0,.25);overflow:hidden;">\' +
';
        $buffer .= $indent . '                  \'<div class="isti-addmodal-header" style="padding:18px 22px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between">\' +
';
        $buffer .= $indent . '                    \'<h5 style="margin:0;font-weight:700;color:#1e293b;font-size:1.05rem"><i class="fa fa-plus-circle" style="color:#006bff;margin-right:6px"></i> \' + _istiM.title + \'</h5>\' +
';
        $buffer .= $indent . '                    \'<button type="button" class="isti-addmodal-close" aria-label="Close" style="background:none;border:none;font-size:1.4rem;color:#64748b;cursor:pointer;line-height:1">&times;</button>\' +
';
        $buffer .= $indent . '                  \'</div>\' +
';
        $buffer .= $indent . '                  \'<div class="isti-addmodal-body" style="padding:20px;display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px">\' +
';
        $buffer .= $indent . '                    \'<a href="#" data-isti-add="library" class="isti-addmodal-option" style="display:block;padding:20px 16px;border:1.5px solid #e2e8f0;border-radius:14px;cursor:pointer;background:#fff;text-decoration:none;color:inherit">\' +
';
        $buffer .= $indent . '                      \'<span style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:12px;font-size:1.3rem;margin-bottom:12px;background:#eff6ff;color:#006bff"><i class="fa fa-folder-open"></i></span>\' +
';
        $buffer .= $indent . '                      \'<strong style="display:block;color:#1e293b;font-size:.92rem;margin-bottom:5px">\' + _istiM.libTitle + \'</strong>\' +
';
        $buffer .= $indent . '                      \'<span style="color:#64748b;font-size:.82rem;line-height:1.45">\' + _istiM.libDesc + \'</span>\' +
';
        $buffer .= $indent . '                    \'</a>\' +
';
        $buffer .= $indent . '                    \'<a href="#" data-isti-add="quiz" class="isti-addmodal-option" style="display:block;padding:20px 16px;border:1.5px solid #e2e8f0;border-radius:14px;cursor:pointer;background:#fff;text-decoration:none;color:inherit">\' +
';
        $buffer .= $indent . '                      \'<span style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:12px;font-size:1.3rem;margin-bottom:12px;background:#f0fdf4;color:#10b981"><i class="fa fa-question-circle"></i></span>\' +
';
        $buffer .= $indent . '                      \'<strong style="display:block;color:#1e293b;font-size:.92rem;margin-bottom:5px">\' + _istiM.quizTitle + \'</strong>\' +
';
        $buffer .= $indent . '                      \'<span style="color:#64748b;font-size:.82rem;line-height:1.45">\' + _istiM.quizDesc + \'</span>\' +
';
        $buffer .= $indent . '                    \'</a>\' +
';
        $buffer .= $indent . '                    \'<a href="#" data-isti-add="forum" class="isti-addmodal-option" style="display:block;padding:20px 16px;border:1.5px solid #e2e8f0;border-radius:14px;cursor:pointer;background:#fff;text-decoration:none;color:inherit">\' +
';
        $buffer .= $indent . '                      \'<span style="display:inline-flex;align-items:center;justify-content:center;width:48px;height:48px;border-radius:12px;font-size:1.3rem;margin-bottom:12px;background:#fdf4ff;color:#a855f7"><i class="fa fa-comments"></i></span>\' +
';
        $buffer .= $indent . '                      \'<strong style="display:block;color:#1e293b;font-size:.92rem;margin-bottom:5px">\' + _istiM.forumTitle + \'</strong>\' +
';
        $buffer .= $indent . '                      \'<span style="color:#64748b;font-size:.82rem;line-height:1.45">\' + _istiM.forumDesc + \'</span>\' +
';
        $buffer .= $indent . '                    \'</a>\' +
';
        $buffer .= $indent . '                  \'</div>\' +
';
        $buffer .= $indent . '                \'</div>\';
';
        $buffer .= $indent . '            if (document.body) { document.body.appendChild(addModalEl); }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            addModalEl.addEventListener(\'click\', function(e) {
';
        $buffer .= $indent . '                if (e.target === addModalEl) { hideModal(); return; }
';
        $buffer .= $indent . '                if (e.target && e.target.closest && e.target.closest(\'.isti-addmodal-close\')) {
';
        $buffer .= $indent . '                    hideModal(); return;
';
        $buffer .= $indent . '                }
';
        $buffer .= $indent . '                var opt = e.target && e.target.closest && e.target.closest(\'[data-isti-add]\');
';
        $buffer .= $indent . '                if (!opt) { return; }
';
        $buffer .= $indent . '                e.preventDefault();
';
        $buffer .= $indent . '                routeAddAction(opt.getAttribute(\'data-isti-add\'));
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '            document.addEventListener(\'keydown\', function(e) {
';
        $buffer .= $indent . '                if (e.key === \'Escape\' && addModalEl && addModalEl.style.display !== \'none\') {
';
        $buffer .= $indent . '                    hideModal();
';
        $buffer .= $indent . '                }
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        };
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        var showModal = function(ctx) {
';
        $buffer .= $indent . '            buildModal();
';
        $buffer .= $indent . '            pendingCtx = ctx;
';
        $buffer .= $indent . '            if (addModalEl) { addModalEl.style.display = \'flex\'; }
';
        $buffer .= $indent . '        };
';
        $buffer .= $indent . '        var hideModal = function() {
';
        $buffer .= $indent . '            if (addModalEl) { addModalEl.style.display = \'none\'; }
';
        $buffer .= $indent . '            pendingCtx = null;
';
        $buffer .= $indent . '        };
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        var routeAddAction = function(kind) {
';
        $buffer .= $indent . '            var ctx = pendingCtx || {};
';
        $buffer .= $indent . '            var courseid = courseIdFromContext();
';
        $buffer .= $indent . '            if (!courseid) {
';
        $buffer .= $indent . '                if (window.console && console.warn) {
';
        $buffer .= $indent . '                    console.warn(\'[istikama] No courseid — cannot open picker.\');
';
        $buffer .= $indent . '                }
';
        $buffer .= $indent . '                hideModal();
';
        $buffer .= $indent . '                return;
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '            var params = new URLSearchParams();
';
        $buffer .= $indent . '            params.set(\'courseid\', courseid);
';
        $buffer .= $indent . '            if (ctx.sectionnum) { params.set(\'sectionnum\', ctx.sectionnum); }
';
        $buffer .= $indent . '            if (ctx.sectionid)  { params.set(\'sectionid\',  ctx.sectionid); }
';
        $buffer .= $indent . '            if (ctx.beforemod)  { params.set(\'beforemod\',  ctx.beforemod); }
';
        $buffer .= $indent . '            var pages = {
';
        $buffer .= $indent . '                quiz:    \'/local/istikama_admin/add_course_quiz.php\',
';
        $buffer .= $indent . '                forum:   \'/local/istikama_admin/add_course_forum.php\',
';
        $buffer .= $indent . '                library: \'/local/istikama_admin/add_library_content.php\',
';
        $buffer .= $indent . '            };
';
        $buffer .= $indent . '            window.location.href = (pages[kind] || pages.library) + \'?\' + params.toString();
';
        $buffer .= $indent . '        };
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // Capture-phase delegation: fires before any of Moodle\'s own
';
        $buffer .= $indent . '        // listeners and works for buttons rendered after page load.
';
        $buffer .= $indent . '        var interceptClick = function(e) {
';
        $buffer .= $indent . '            if (!e || !e.target || !e.target.closest) { return; }
';
        $buffer .= $indent . '            var btn = e.target.closest(\'[data-action="open-chooser"]\');
';
        $buffer .= $indent . '            if (!btn) { return; }
';
        $buffer .= $indent . '            e.preventDefault();
';
        $buffer .= $indent . '            e.stopPropagation();
';
        $buffer .= $indent . '            if (e.stopImmediatePropagation) { e.stopImmediatePropagation(); }
';
        $buffer .= $indent . '            showModal({
';
        $buffer .= $indent . '                sectionnum: btn.getAttribute(\'data-sectionnum\') || \'\',
';
        $buffer .= $indent . '                sectionid:  btn.getAttribute(\'data-section-id\') || \'\',
';
        $buffer .= $indent . '                beforemod:  btn.getAttribute(\'data-beforemod\') || \'\',
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        };
';
        $buffer .= $indent . '        // Listen on both document and body, capture phase, for maximum priority.
';
        $buffer .= $indent . '        document.addEventListener(\'click\',      interceptClick, true);
';
        $buffer .= $indent . '        document.addEventListener(\'mousedown\',  interceptClick, true);
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ──────────────────────────────────────────────────────────────
';
        $buffer .= $indent . '    // Redirect resource/url activity clicks to the Istikama content
';
        $buffer .= $indent . '    // viewer (view_content.php) for a richer YouTube / PDF experience.
';
        $buffer .= $indent . '    // ──────────────────────────────────────────────────────────────
';
        $buffer .= $indent . '    safeRun(function() {
';
        $buffer .= $indent . '        // Skip if we\'re already in the viewer to avoid redirect loops.
';
        $buffer .= $indent . '        if (/\\/local\\/istikama_admin\\/view_content\\.php/.test(window.location.pathname)) { return; }
';
        $buffer .= $indent . '        document.addEventListener(\'click\', function(e) {
';
        $buffer .= $indent . '            if (!e || !e.target || !e.target.closest) { return; }
';
        $buffer .= $indent . '            var link = e.target.closest(\'a[href]\');
';
        $buffer .= $indent . '            if (!link) { return; }
';
        $buffer .= $indent . '            var href = link.href || \'\';
';
        $buffer .= $indent . '            var m = href.match(/\\/mod\\/(url|resource)\\/view\\.php[^?]*\\?(?:.*&)?id=(\\d+)/);
';
        $buffer .= $indent . '            if (!m) { return; }
';
        $buffer .= $indent . '            e.preventDefault();
';
        $buffer .= $indent . '            e.stopPropagation();
';
        $buffer .= $indent . '            window.location.href = \'/local/istikama_admin/view_content.php?cmid=\' + m[2];
';
        $buffer .= $indent . '        }, false);
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // Also intercept direct navigation to mod/url or mod/resource if user
';
        $buffer .= $indent . '        // somehow lands there (e.g. from a bookmarked link).
';
        $buffer .= $indent . '        var path = window.location.pathname;
';
        $buffer .= $indent . '        var direct = path.match(/\\/mod\\/(url|resource)\\/view\\.php$/);
';
        $buffer .= $indent . '        if (direct) {
';
        $buffer .= $indent . '            var params = new URLSearchParams(window.location.search);
';
        $buffer .= $indent . '            var cmid = params.get(\'id\');
';
        $buffer .= $indent . '            if (cmid) {
';
        $buffer .= $indent . '                window.location.replace(\'/local/istikama_admin/view_content.php?cmid=\' + cmid);
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    if (document.readyState === \'loading\') {
';
        $buffer .= $indent . '        document.addEventListener(\'DOMContentLoaded\', boot);
';
        $buffer .= $indent . '    } else {
';
        $buffer .= $indent . '        boot();
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '})();
';
        $buffer .= $indent . '</script>
';
        $buffer .= $indent . '
';
        $value = $this->resolveValue($context->findDot('output.standard_end_of_body_html'), $context);
        $buffer .= $indent . ($value === null ? '' : $value);
        $buffer .= '
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>
';
        $value = $context->find('js');
        $buffer .= $this->section0176f9f7308bd980a0cc37ee682f036d($context, $indent, $value);

        return $buffer;
    }

    private function sectionBdd5f3e0f56888006dba19179c3f178b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        <img src="{{schoolbrandlogo}}" alt="{{schoolbrandname}}" class="isti-sidebar-logo">
        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '        <img src="';
                $value = $this->resolveValue($context->find('schoolbrandlogo'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" alt="';
                $value = $this->resolveValue($context->find('schoolbrandname'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" class="isti-sidebar-logo">
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section4ece2ea01b45a76eca1fff8d145d21b6(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
        {{#isplatformlogo}}
        <img src="{{schoolbrandlogo}}" alt="{{schoolbrandname}}" class="isti-sidebar-logo">
        {{/isplatformlogo}}
        {{^isplatformlogo}}
        <img src="{{schoolbrandlogo}}" alt="{{schoolbrandname}}" class="isti-sidebar-logo isti-school-logo">
        {{/isplatformlogo}}
        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $value = $context->find('isplatformlogo');
                $buffer .= $this->sectionBdd5f3e0f56888006dba19179c3f178b($context, $indent, $value);
                $value = $context->find('isplatformlogo');
                if (empty($value)) {
                    
                    $buffer .= $indent . '        <img src="';
                    $value = $this->resolveValue($context->find('schoolbrandlogo'), $context);
                    $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                    $buffer .= '" alt="';
                    $value = $this->resolveValue($context->find('schoolbrandname'), $context);
                    $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                    $buffer .= '" class="isti-sidebar-logo isti-school-logo">
';
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section24764c4f0d5c5bb7d8b4be30028d5243(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_menu, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_menu, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section5749c750acb0d7477dd5257d00cc6d53(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'active';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'active';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section2731b8204c09b71de444e6fd16dca8a5(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            <a href="{{url}}" class="isti-nav-item {{#active}}active{{/active}}">
                <i class="fa {{icon}}"></i>
                <span>{{label}}</span>
            </a>
            ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '            <a href="';
                $value = $this->resolveValue($context->find('url'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" class="isti-nav-item ';
                $value = $context->find('active');
                $buffer .= $this->section5749c750acb0d7477dd5257d00cc6d53($context, $indent, $value);
                $buffer .= '">
';
                $buffer .= $indent . '                <i class="fa ';
                $value = $this->resolveValue($context->find('icon'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '"></i>
';
                $buffer .= $indent . '                <span>';
                $value = $this->resolveValue($context->find('label'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</span>
';
                $buffer .= $indent . '            </a>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section1baf1c786b07388405a84c8441ca0998(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'logout';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'logout';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionFfdb7c82e3ec92a063ae74618929303a(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_search_ph, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_search_ph, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionDc79c419173ced31afb4a2b716497c3c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
            {{> theme_boost/language_menu }}
        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                if ($partial = $this->mustache->loadPartial('theme_boost/language_menu')) {
                    $buffer .= $partial->renderInternal($context, $indent . '            ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC1a074dbb434be152581dde91d267c63(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                {{> core/user_menu }}
            ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                if ($partial = $this->mustache->loadPartial('core/user_menu')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section31590da236b0bc14999e27a484a5ad76(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'search_recent, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'search_recent, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionCbb57d899ac960f14004071783fac71d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#str}}search_recent, local_istikama_admin{{/str}}';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $value = $context->find('str');
                $buffer .= $this->section31590da236b0bc14999e27a484a5ad76($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionB0decf58cfd7f8649b1003622418e9c9(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'search_no_results, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'search_no_results, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionF6b65ea350ee986144dda3cf18dafeb5(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#str}}search_no_results, local_istikama_admin{{/str}}';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $value = $context->find('str');
                $buffer .= $this->sectionB0decf58cfd7f8649b1003622418e9c9($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionEc6edda876d79338fa88792ad4de21a6(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'search_clear_recent, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'search_clear_recent, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD69c782e5191ce3992ca9435771de2fa(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#str}}search_clear_recent, local_istikama_admin{{/str}}';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $value = $context->find('str');
                $buffer .= $this->sectionEc6edda876d79338fa88792ad4de21a6($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section961f9d9086b86afd493e02e72b078867(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'search_cat_pages, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'search_cat_pages, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC628d764a519f04184e0095d58115da8(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#str}}search_cat_pages, local_istikama_admin{{/str}}';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $value = $context->find('str');
                $buffer .= $this->section961f9d9086b86afd493e02e72b078867($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionFe20346dda78fc674fc5473eaedaec4c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'search_cat_users, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'search_cat_users, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section29707c7edbb032dd4b0293fd44c008b7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#str}}search_cat_users, local_istikama_admin{{/str}}';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $value = $context->find('str');
                $buffer .= $this->sectionFe20346dda78fc674fc5473eaedaec4c($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0b199f2ec33dbf31e856561534ef2485(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'search_cat_courses, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'search_cat_courses, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section1c1660249fd8565f704d929f84088b9c(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#str}}search_cat_courses, local_istikama_admin{{/str}}';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $value = $context->find('str');
                $buffer .= $this->section0b199f2ec33dbf31e856561534ef2485($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section7593f4ebe7b118167eadbe7bd92bbde9(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'search_cat_admin, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'search_cat_admin, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section087a408c790e495c3cfb9d044b602530(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{#str}}search_cat_admin, local_istikama_admin{{/str}}';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $value = $context->find('str');
                $buffer .= $this->section7593f4ebe7b118167eadbe7bd92bbde9($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section4f721713009e54f14c799fa89336f6ee(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    <div class="secondary-navigation d-print-none">
                        {{> core/moremenu}}
                    </div>
                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                    <div class="secondary-navigation d-print-none">
';
                if ($partial = $this->mustache->loadPartial('core/moremenu')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                        ');
                }
                $buffer .= $indent . '                    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC25a09df79f7c3c8e552140a1e63c570(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_welcome, local_istikama_admin, {{userfirstname}}';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_welcome, local_istikama_admin, ';
                $value = $this->resolveValue($context->find('userfirstname'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section3231e6d420617b057e21980c760a9cf5(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_subtitle, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_subtitle, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionBaf09e0ab2bc9076a22fca13f8728982(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    <div class="isti-kpi-card">
                        <div class="isti-kpi-content">
                            <span class="isti-kpi-label">{{label}}</span>
                            <span class="isti-kpi-value">{{value}}</span>
                        </div>
                        <div class="isti-kpi-icon {{colorclass}}">
                            <i class="fa {{icon}}"></i>
                        </div>
                    </div>
                    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                    <div class="isti-kpi-card">
';
                $buffer .= $indent . '                        <div class="isti-kpi-content">
';
                $buffer .= $indent . '                            <span class="isti-kpi-label">';
                $value = $this->resolveValue($context->find('label'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</span>
';
                $buffer .= $indent . '                            <span class="isti-kpi-value">';
                $value = $this->resolveValue($context->find('value'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</span>
';
                $buffer .= $indent . '                        </div>
';
                $buffer .= $indent . '                        <div class="isti-kpi-icon ';
                $value = $this->resolveValue($context->find('colorclass'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">
';
                $buffer .= $indent . '                            <i class="fa ';
                $value = $this->resolveValue($context->find('icon'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '"></i>
';
                $buffer .= $indent . '                        </div>
';
                $buffer .= $indent . '                    </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section30c7029a5cecfbef26f396888a7c9a80(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_schools_overview, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_schools_overview, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionA763c6c4cbf076ae88b7a7fa43a77467(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_view_all, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_view_all, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionAcec30724a311000e53751e3dfaea759(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_col_school, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_col_school, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionB361796e860d92fc03da27666f9fef66(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_col_students, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_col_students, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section8bf7b1a0b756a711b4c749d4adf7dd02(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_col_teachers, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_col_teachers, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section161e06fae382fa3448815dc94123d558(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_col_courses, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_col_courses, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionDa55604fb73d3886a8ad74414bebdb98(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_col_status, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_col_status, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section8239685822d7652a5757cafb3135ba5f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '<img src="{{logourl}}" alt="{{name}}">';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= '<img src="';
                $value = $this->resolveValue($context->find('logourl'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" alt="';
                $value = $this->resolveValue($context->find('name'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionBf0e4905d1d7d090d4ff156a95107f8e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                            <tr>
                                                <td>
                                                    <div class="isti-table-user">
                                                        {{#logourl}}<img src="{{logourl}}" alt="{{name}}">{{/logourl}}
                                                        {{^logourl}}<div style="width:36px;height:36px;border-radius:50%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#94a3b8"><i class="fa fa-university"></i></div>{{/logourl}}
                                                        <strong>{{name}}</strong>
                                                    </div>
                                                </td>
                                                <td>{{students}}</td>
                                                <td>{{teachers}}</td>
                                                <td>{{courses}}</td>
                                                <td><span class="isti-kpi-trend up" style="font-size:0.75rem;padding:4px 8px">{{status}}</span></td>
                                            </tr>
                                            ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                                            <tr>
';
                $buffer .= $indent . '                                                <td>
';
                $buffer .= $indent . '                                                    <div class="isti-table-user">
';
                $buffer .= $indent . '                                                        ';
                $value = $context->find('logourl');
                $buffer .= $this->section8239685822d7652a5757cafb3135ba5f($context, $indent, $value);
                $buffer .= '
';
                $buffer .= $indent . '                                                        ';
                $value = $context->find('logourl');
                if (empty($value)) {
                    
                    $buffer .= '<div style="width:36px;height:36px;border-radius:50%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#94a3b8"><i class="fa fa-university"></i></div>';
                }
                $buffer .= '
';
                $buffer .= $indent . '                                                        <strong>';
                $value = $this->resolveValue($context->find('name'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</strong>
';
                $buffer .= $indent . '                                                    </div>
';
                $buffer .= $indent . '                                                </td>
';
                $buffer .= $indent . '                                                <td>';
                $value = $this->resolveValue($context->find('students'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</td>
';
                $buffer .= $indent . '                                                <td>';
                $value = $this->resolveValue($context->find('teachers'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</td>
';
                $buffer .= $indent . '                                                <td>';
                $value = $this->resolveValue($context->find('courses'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</td>
';
                $buffer .= $indent . '                                                <td><span class="isti-kpi-trend up" style="font-size:0.75rem;padding:4px 8px">';
                $value = $this->resolveValue($context->find('status'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</span></td>
';
                $buffer .= $indent . '                                            </tr>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD962eea34028c2aa79d7b7a0542f1ca3(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                <div class="table-responsive">
                                    <table class="isti-table">
                                        <thead>
                                            <tr>
                                                <th>{{#str}}dash_col_school, local_istikama_admin{{/str}}</th>
                                                <th>{{#str}}dash_col_students, local_istikama_admin{{/str}}</th>
                                                <th>{{#str}}dash_col_teachers, local_istikama_admin{{/str}}</th>
                                                <th>{{#str}}dash_col_courses, local_istikama_admin{{/str}}</th>
                                                <th>{{#str}}dash_col_status, local_istikama_admin{{/str}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{#recentschools}}
                                            <tr>
                                                <td>
                                                    <div class="isti-table-user">
                                                        {{#logourl}}<img src="{{logourl}}" alt="{{name}}">{{/logourl}}
                                                        {{^logourl}}<div style="width:36px;height:36px;border-radius:50%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#94a3b8"><i class="fa fa-university"></i></div>{{/logourl}}
                                                        <strong>{{name}}</strong>
                                                    </div>
                                                </td>
                                                <td>{{students}}</td>
                                                <td>{{teachers}}</td>
                                                <td>{{courses}}</td>
                                                <td><span class="isti-kpi-trend up" style="font-size:0.75rem;padding:4px 8px">{{status}}</span></td>
                                            </tr>
                                            {{/recentschools}}
                                        </tbody>
                                    </table>
                                </div>
                                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                                <div class="table-responsive">
';
                $buffer .= $indent . '                                    <table class="isti-table">
';
                $buffer .= $indent . '                                        <thead>
';
                $buffer .= $indent . '                                            <tr>
';
                $buffer .= $indent . '                                                <th>';
                $value = $context->find('str');
                $buffer .= $this->sectionAcec30724a311000e53751e3dfaea759($context, $indent, $value);
                $buffer .= '</th>
';
                $buffer .= $indent . '                                                <th>';
                $value = $context->find('str');
                $buffer .= $this->sectionB361796e860d92fc03da27666f9fef66($context, $indent, $value);
                $buffer .= '</th>
';
                $buffer .= $indent . '                                                <th>';
                $value = $context->find('str');
                $buffer .= $this->section8bf7b1a0b756a711b4c749d4adf7dd02($context, $indent, $value);
                $buffer .= '</th>
';
                $buffer .= $indent . '                                                <th>';
                $value = $context->find('str');
                $buffer .= $this->section161e06fae382fa3448815dc94123d558($context, $indent, $value);
                $buffer .= '</th>
';
                $buffer .= $indent . '                                                <th>';
                $value = $context->find('str');
                $buffer .= $this->sectionDa55604fb73d3886a8ad74414bebdb98($context, $indent, $value);
                $buffer .= '</th>
';
                $buffer .= $indent . '                                            </tr>
';
                $buffer .= $indent . '                                        </thead>
';
                $buffer .= $indent . '                                        <tbody>
';
                $value = $context->find('recentschools');
                $buffer .= $this->sectionBf0e4905d1d7d090d4ff156a95107f8e($context, $indent, $value);
                $buffer .= $indent . '                                        </tbody>
';
                $buffer .= $indent . '                                    </table>
';
                $buffer .= $indent . '                                </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionAba40600a4051b0bbe994655d1748176(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_no_schools, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_no_schools, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionB4e08715eeef9ef6d7b288b66d775d49(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_activity_insights, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_activity_insights, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section30414f24aae66d878ee2ae3f76137f34(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_new_enrollments, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_new_enrollments, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section8b8e5aa05a2bbf18a873f45f4db34fa0(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_new_enrollments_desc, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_new_enrollments_desc, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section6994c2ca60f420648de0df1e7d791240(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_course_completion, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_course_completion, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0665f8eb9bd78cbbca5d773a27aa2991(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_course_completion_desc, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_course_completion_desc, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC38af654ba797e848eceed8fa3ffc353(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_live_sessions, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_live_sessions, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section628a434f210d17494981ddc3c446ee2f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'dash_live_sessions_desc, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'dash_live_sessions_desc, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionEbeda56a8acb28b1f8f90979b415b442(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                <!-- ═══ PREMIUM STATS GRID (STUDDY INSPIRED) ═══ -->
                <div class="isti-kpi-grid" style="margin-bottom: 32px;">
                    {{#dashboardstats}}
                    <div class="isti-kpi-card">
                        <div class="isti-kpi-content">
                            <span class="isti-kpi-label">{{label}}</span>
                            <span class="isti-kpi-value">{{value}}</span>
                        </div>
                        <div class="isti-kpi-icon {{colorclass}}">
                            <i class="fa {{icon}}"></i>
                        </div>
                    </div>
                    {{/dashboardstats}}
                </div>

                <!-- ═══ DASHBOARD MAIN CONTENT (STUDDY INSPIRED) ═══ -->
                <div class="isti-row">
                    <!-- Schools Overview Table -->
                    <div class="isti-col-6">
                        <div class="isti-card-modern">
                            <div class="isti-card-modern-header">
                                <h3 class="isti-card-modern-title"><i class="fa fa-university"></i> {{#str}}dash_schools_overview, local_istikama_admin{{/str}}</h3>
                                <a href="/local/istikama_admin/schools.php" style="font-size: 0.8rem; color: var(--primary-color); font-weight: 600; text-decoration: none;">{{#str}}dash_view_all, local_istikama_admin{{/str}}</a>
                            </div>
                            <div class="isti-card-modern-body" style="padding: 0">
                                {{#hasrecentschools}}
                                <div class="table-responsive">
                                    <table class="isti-table">
                                        <thead>
                                            <tr>
                                                <th>{{#str}}dash_col_school, local_istikama_admin{{/str}}</th>
                                                <th>{{#str}}dash_col_students, local_istikama_admin{{/str}}</th>
                                                <th>{{#str}}dash_col_teachers, local_istikama_admin{{/str}}</th>
                                                <th>{{#str}}dash_col_courses, local_istikama_admin{{/str}}</th>
                                                <th>{{#str}}dash_col_status, local_istikama_admin{{/str}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{#recentschools}}
                                            <tr>
                                                <td>
                                                    <div class="isti-table-user">
                                                        {{#logourl}}<img src="{{logourl}}" alt="{{name}}">{{/logourl}}
                                                        {{^logourl}}<div style="width:36px;height:36px;border-radius:50%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#94a3b8"><i class="fa fa-university"></i></div>{{/logourl}}
                                                        <strong>{{name}}</strong>
                                                    </div>
                                                </td>
                                                <td>{{students}}</td>
                                                <td>{{teachers}}</td>
                                                <td>{{courses}}</td>
                                                <td><span class="isti-kpi-trend up" style="font-size:0.75rem;padding:4px 8px">{{status}}</span></td>
                                            </tr>
                                            {{/recentschools}}
                                        </tbody>
                                    </table>
                                </div>
                                {{/hasrecentschools}}
                                {{^hasrecentschools}}
                                <div style="padding: 20px 28px; text-align: center; color: #94a3b8; font-size: 0.9rem;">
                                    {{#str}}dash_no_schools, local_istikama_admin{{/str}}
                                </div>
                                {{/hasrecentschools}}
                            </div>
                        </div>
                    </div>
                    <!-- Activity Insights -->
                    <div class="isti-col-6">
                        <div class="isti-card-modern">
                            <div class="isti-card-modern-header">
                                <h3 class="isti-card-modern-title"><i class="fa fa-chart-pie"></i> {{#str}}dash_activity_insights, local_istikama_admin{{/str}}</h3>
                            </div>
                            <div class="isti-card-modern-body">
                                <div style="display:flex; flex-direction:column; gap:16px;">
                                    <!-- Placeholder Insight 1 -->
                                    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px; border:1px solid #f1f5f9; border-radius:12px; background:#fafafa;">
                                        <div style="display:flex; align-items:center; gap:12px;">
                                            <div style="width:40px;height:40px;border-radius:10px;background:#e0e7ff;color:#4f46e5;display:flex;align-items:center;justify-content:center;font-size:1.2rem;"><i class="fa fa-user-plus"></i></div>
                                            <div>
                                                <h4 style="margin:0;font-size:0.9rem;font-weight:600;color:#1e293b;">{{#str}}dash_new_enrollments, local_istikama_admin{{/str}}</h4>
                                                <span style="font-size:0.75rem;color:#64748b;">{{#str}}dash_new_enrollments_desc, local_istikama_admin{{/str}}</span>
                                            </div>
                                        </div>
                                        <div style="font-weight:700;color:#1e293b;font-size:1.1rem;">+24%</div>
                                    </div>
                                    <!-- Placeholder Insight 2 -->
                                    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px; border:1px solid #f1f5f9; border-radius:12px; background:#fafafa;">
                                        <div style="display:flex; align-items:center; gap:12px;">
                                            <div style="width:40px;height:40px;border-radius:10px;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;font-size:1.2rem;"><i class="fa fa-book-reader"></i></div>
                                            <div>
                                                <h4 style="margin:0;font-size:0.9rem;font-weight:600;color:#1e293b;">{{#str}}dash_course_completion, local_istikama_admin{{/str}}</h4>
                                                <span style="font-size:0.75rem;color:#64748b;">{{#str}}dash_course_completion_desc, local_istikama_admin{{/str}}</span>
                                            </div>
                                        </div>
                                        <div style="font-weight:700;color:#1e293b;font-size:1.1rem;">82%</div>
                                    </div>
                                    <!-- Placeholder Insight 3 -->
                                    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px; border:1px solid #f1f5f9; border-radius:12px; background:#fafafa;">
                                        <div style="display:flex; align-items:center; gap:12px;">
                                            <div style="width:40px;height:40px;border-radius:10px;background:#fef3c7;color:#d97706;display:flex;align-items:center;justify-content:center;font-size:1.2rem;"><i class="fa fa-video"></i></div>
                                            <div>
                                                <h4 style="margin:0;font-size:0.9rem;font-weight:600;color:#1e293b;">{{#str}}dash_live_sessions, local_istikama_admin{{/str}}</h4>
                                                <span style="font-size:0.75rem;color:#64748b;">{{#str}}dash_live_sessions_desc, local_istikama_admin{{/str}}</span>
                                            </div>
                                        </div>
                                        <div style="font-weight:700;color:#1e293b;font-size:1.1rem;">12</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                <!-- ═══ PREMIUM STATS GRID (STUDDY INSPIRED) ═══ -->
';
                $buffer .= $indent . '                <div class="isti-kpi-grid" style="margin-bottom: 32px;">
';
                $value = $context->find('dashboardstats');
                $buffer .= $this->sectionBaf09e0ab2bc9076a22fca13f8728982($context, $indent, $value);
                $buffer .= $indent . '                </div>
';
                $buffer .= $indent . '
';
                $buffer .= $indent . '                <!-- ═══ DASHBOARD MAIN CONTENT (STUDDY INSPIRED) ═══ -->
';
                $buffer .= $indent . '                <div class="isti-row">
';
                $buffer .= $indent . '                    <!-- Schools Overview Table -->
';
                $buffer .= $indent . '                    <div class="isti-col-6">
';
                $buffer .= $indent . '                        <div class="isti-card-modern">
';
                $buffer .= $indent . '                            <div class="isti-card-modern-header">
';
                $buffer .= $indent . '                                <h3 class="isti-card-modern-title"><i class="fa fa-university"></i> ';
                $value = $context->find('str');
                $buffer .= $this->section30c7029a5cecfbef26f396888a7c9a80($context, $indent, $value);
                $buffer .= '</h3>
';
                $buffer .= $indent . '                                <a href="/local/istikama_admin/schools.php" style="font-size: 0.8rem; color: var(--primary-color); font-weight: 600; text-decoration: none;">';
                $value = $context->find('str');
                $buffer .= $this->sectionA763c6c4cbf076ae88b7a7fa43a77467($context, $indent, $value);
                $buffer .= '</a>
';
                $buffer .= $indent . '                            </div>
';
                $buffer .= $indent . '                            <div class="isti-card-modern-body" style="padding: 0">
';
                $value = $context->find('hasrecentschools');
                $buffer .= $this->sectionD962eea34028c2aa79d7b7a0542f1ca3($context, $indent, $value);
                $value = $context->find('hasrecentschools');
                if (empty($value)) {
                    
                    $buffer .= $indent . '                                <div style="padding: 20px 28px; text-align: center; color: #94a3b8; font-size: 0.9rem;">
';
                    $buffer .= $indent . '                                    ';
                    $value = $context->find('str');
                    $buffer .= $this->sectionAba40600a4051b0bbe994655d1748176($context, $indent, $value);
                    $buffer .= '
';
                    $buffer .= $indent . '                                </div>
';
                }
                $buffer .= $indent . '                            </div>
';
                $buffer .= $indent . '                        </div>
';
                $buffer .= $indent . '                    </div>
';
                $buffer .= $indent . '                    <!-- Activity Insights -->
';
                $buffer .= $indent . '                    <div class="isti-col-6">
';
                $buffer .= $indent . '                        <div class="isti-card-modern">
';
                $buffer .= $indent . '                            <div class="isti-card-modern-header">
';
                $buffer .= $indent . '                                <h3 class="isti-card-modern-title"><i class="fa fa-chart-pie"></i> ';
                $value = $context->find('str');
                $buffer .= $this->sectionB4e08715eeef9ef6d7b288b66d775d49($context, $indent, $value);
                $buffer .= '</h3>
';
                $buffer .= $indent . '                            </div>
';
                $buffer .= $indent . '                            <div class="isti-card-modern-body">
';
                $buffer .= $indent . '                                <div style="display:flex; flex-direction:column; gap:16px;">
';
                $buffer .= $indent . '                                    <!-- Placeholder Insight 1 -->
';
                $buffer .= $indent . '                                    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px; border:1px solid #f1f5f9; border-radius:12px; background:#fafafa;">
';
                $buffer .= $indent . '                                        <div style="display:flex; align-items:center; gap:12px;">
';
                $buffer .= $indent . '                                            <div style="width:40px;height:40px;border-radius:10px;background:#e0e7ff;color:#4f46e5;display:flex;align-items:center;justify-content:center;font-size:1.2rem;"><i class="fa fa-user-plus"></i></div>
';
                $buffer .= $indent . '                                            <div>
';
                $buffer .= $indent . '                                                <h4 style="margin:0;font-size:0.9rem;font-weight:600;color:#1e293b;">';
                $value = $context->find('str');
                $buffer .= $this->section30414f24aae66d878ee2ae3f76137f34($context, $indent, $value);
                $buffer .= '</h4>
';
                $buffer .= $indent . '                                                <span style="font-size:0.75rem;color:#64748b;">';
                $value = $context->find('str');
                $buffer .= $this->section8b8e5aa05a2bbf18a873f45f4db34fa0($context, $indent, $value);
                $buffer .= '</span>
';
                $buffer .= $indent . '                                            </div>
';
                $buffer .= $indent . '                                        </div>
';
                $buffer .= $indent . '                                        <div style="font-weight:700;color:#1e293b;font-size:1.1rem;">+24%</div>
';
                $buffer .= $indent . '                                    </div>
';
                $buffer .= $indent . '                                    <!-- Placeholder Insight 2 -->
';
                $buffer .= $indent . '                                    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px; border:1px solid #f1f5f9; border-radius:12px; background:#fafafa;">
';
                $buffer .= $indent . '                                        <div style="display:flex; align-items:center; gap:12px;">
';
                $buffer .= $indent . '                                            <div style="width:40px;height:40px;border-radius:10px;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;font-size:1.2rem;"><i class="fa fa-book-reader"></i></div>
';
                $buffer .= $indent . '                                            <div>
';
                $buffer .= $indent . '                                                <h4 style="margin:0;font-size:0.9rem;font-weight:600;color:#1e293b;">';
                $value = $context->find('str');
                $buffer .= $this->section6994c2ca60f420648de0df1e7d791240($context, $indent, $value);
                $buffer .= '</h4>
';
                $buffer .= $indent . '                                                <span style="font-size:0.75rem;color:#64748b;">';
                $value = $context->find('str');
                $buffer .= $this->section0665f8eb9bd78cbbca5d773a27aa2991($context, $indent, $value);
                $buffer .= '</span>
';
                $buffer .= $indent . '                                            </div>
';
                $buffer .= $indent . '                                        </div>
';
                $buffer .= $indent . '                                        <div style="font-weight:700;color:#1e293b;font-size:1.1rem;">82%</div>
';
                $buffer .= $indent . '                                    </div>
';
                $buffer .= $indent . '                                    <!-- Placeholder Insight 3 -->
';
                $buffer .= $indent . '                                    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px; border:1px solid #f1f5f9; border-radius:12px; background:#fafafa;">
';
                $buffer .= $indent . '                                        <div style="display:flex; align-items:center; gap:12px;">
';
                $buffer .= $indent . '                                            <div style="width:40px;height:40px;border-radius:10px;background:#fef3c7;color:#d97706;display:flex;align-items:center;justify-content:center;font-size:1.2rem;"><i class="fa fa-video"></i></div>
';
                $buffer .= $indent . '                                            <div>
';
                $buffer .= $indent . '                                                <h4 style="margin:0;font-size:0.9rem;font-weight:600;color:#1e293b;">';
                $value = $context->find('str');
                $buffer .= $this->sectionC38af654ba797e848eceed8fa3ffc353($context, $indent, $value);
                $buffer .= '</h4>
';
                $buffer .= $indent . '                                                <span style="font-size:0.75rem;color:#64748b;">';
                $value = $context->find('str');
                $buffer .= $this->section628a434f210d17494981ddc3c446ee2f($context, $indent, $value);
                $buffer .= '</span>
';
                $buffer .= $indent . '                                            </div>
';
                $buffer .= $indent . '                                        </div>
';
                $buffer .= $indent . '                                        <div style="font-weight:700;color:#1e293b;font-size:1.1rem;">12</div>
';
                $buffer .= $indent . '                                    </div>
';
                $buffer .= $indent . '                                </div>
';
                $buffer .= $indent . '                            </div>
';
                $buffer .= $indent . '                        </div>
';
                $buffer .= $indent . '                    </div>
';
                $buffer .= $indent . '                </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section764458fe23d32f70a9ff5d8f19be4ee7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                <!-- ═══ HERO WELCOME SECTION ═══ -->
                <div class="isti-hero-welcome">
                    <div class="isti-hero-content">
                        <h1 class="isti-hero-title">{{#str}}dash_welcome, local_istikama_admin, {{userfirstname}}{{/str}}</h1>
                        <p class="isti-hero-subtitle">{{#str}}dash_subtitle, local_istikama_admin{{/str}}</p>
                    </div>
                    <div class="isti-hero-illustration">
                        <svg viewBox="0 0 200 160" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Book stack -->
                            <rect x="20" y="90" width="60" height="12" rx="3" fill="rgba(255,255,255,0.3)"/>
                            <rect x="25" y="78" width="55" height="12" rx="3" fill="rgba(255,255,255,0.4)"/>
                            <rect x="22" y="66" width="58" height="12" rx="3" fill="rgba(255,255,255,0.5)"/>
                            <!-- Graduation cap -->
                            <polygon points="100,20 140,40 100,60 60,40" fill="rgba(255,255,255,0.6)"/>
                            <rect x="96" y="60" width="8" height="20" fill="rgba(255,255,255,0.4)"/>
                            <rect x="88" y="80" width="24" height="4" rx="2" fill="rgba(255,255,255,0.5)"/>
                            <!-- Star -->
                            <polygon points="160,30 165,45 180,45 168,55 172,70 160,60 148,70 152,55 140,45 155,45" fill="rgba(255,255,255,0.35)"/>
                            <!-- Chart bars -->
                            <rect x="130" y="100" width="12" height="30" rx="3" fill="rgba(255,255,255,0.3)"/>
                            <rect x="148" y="85" width="12" height="45" rx="3" fill="rgba(255,255,255,0.4)"/>
                            <rect x="166" y="70" width="12" height="60" rx="3" fill="rgba(255,255,255,0.5)"/>
                        </svg>
                    </div>
                </div>

                {{#hasdashboardstats}}
                <!-- ═══ PREMIUM STATS GRID (STUDDY INSPIRED) ═══ -->
                <div class="isti-kpi-grid" style="margin-bottom: 32px;">
                    {{#dashboardstats}}
                    <div class="isti-kpi-card">
                        <div class="isti-kpi-content">
                            <span class="isti-kpi-label">{{label}}</span>
                            <span class="isti-kpi-value">{{value}}</span>
                        </div>
                        <div class="isti-kpi-icon {{colorclass}}">
                            <i class="fa {{icon}}"></i>
                        </div>
                    </div>
                    {{/dashboardstats}}
                </div>

                <!-- ═══ DASHBOARD MAIN CONTENT (STUDDY INSPIRED) ═══ -->
                <div class="isti-row">
                    <!-- Schools Overview Table -->
                    <div class="isti-col-6">
                        <div class="isti-card-modern">
                            <div class="isti-card-modern-header">
                                <h3 class="isti-card-modern-title"><i class="fa fa-university"></i> {{#str}}dash_schools_overview, local_istikama_admin{{/str}}</h3>
                                <a href="/local/istikama_admin/schools.php" style="font-size: 0.8rem; color: var(--primary-color); font-weight: 600; text-decoration: none;">{{#str}}dash_view_all, local_istikama_admin{{/str}}</a>
                            </div>
                            <div class="isti-card-modern-body" style="padding: 0">
                                {{#hasrecentschools}}
                                <div class="table-responsive">
                                    <table class="isti-table">
                                        <thead>
                                            <tr>
                                                <th>{{#str}}dash_col_school, local_istikama_admin{{/str}}</th>
                                                <th>{{#str}}dash_col_students, local_istikama_admin{{/str}}</th>
                                                <th>{{#str}}dash_col_teachers, local_istikama_admin{{/str}}</th>
                                                <th>{{#str}}dash_col_courses, local_istikama_admin{{/str}}</th>
                                                <th>{{#str}}dash_col_status, local_istikama_admin{{/str}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{#recentschools}}
                                            <tr>
                                                <td>
                                                    <div class="isti-table-user">
                                                        {{#logourl}}<img src="{{logourl}}" alt="{{name}}">{{/logourl}}
                                                        {{^logourl}}<div style="width:36px;height:36px;border-radius:50%;background:#f1f5f9;display:flex;align-items:center;justify-content:center;color:#94a3b8"><i class="fa fa-university"></i></div>{{/logourl}}
                                                        <strong>{{name}}</strong>
                                                    </div>
                                                </td>
                                                <td>{{students}}</td>
                                                <td>{{teachers}}</td>
                                                <td>{{courses}}</td>
                                                <td><span class="isti-kpi-trend up" style="font-size:0.75rem;padding:4px 8px">{{status}}</span></td>
                                            </tr>
                                            {{/recentschools}}
                                        </tbody>
                                    </table>
                                </div>
                                {{/hasrecentschools}}
                                {{^hasrecentschools}}
                                <div style="padding: 20px 28px; text-align: center; color: #94a3b8; font-size: 0.9rem;">
                                    {{#str}}dash_no_schools, local_istikama_admin{{/str}}
                                </div>
                                {{/hasrecentschools}}
                            </div>
                        </div>
                    </div>
                    <!-- Activity Insights -->
                    <div class="isti-col-6">
                        <div class="isti-card-modern">
                            <div class="isti-card-modern-header">
                                <h3 class="isti-card-modern-title"><i class="fa fa-chart-pie"></i> {{#str}}dash_activity_insights, local_istikama_admin{{/str}}</h3>
                            </div>
                            <div class="isti-card-modern-body">
                                <div style="display:flex; flex-direction:column; gap:16px;">
                                    <!-- Placeholder Insight 1 -->
                                    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px; border:1px solid #f1f5f9; border-radius:12px; background:#fafafa;">
                                        <div style="display:flex; align-items:center; gap:12px;">
                                            <div style="width:40px;height:40px;border-radius:10px;background:#e0e7ff;color:#4f46e5;display:flex;align-items:center;justify-content:center;font-size:1.2rem;"><i class="fa fa-user-plus"></i></div>
                                            <div>
                                                <h4 style="margin:0;font-size:0.9rem;font-weight:600;color:#1e293b;">{{#str}}dash_new_enrollments, local_istikama_admin{{/str}}</h4>
                                                <span style="font-size:0.75rem;color:#64748b;">{{#str}}dash_new_enrollments_desc, local_istikama_admin{{/str}}</span>
                                            </div>
                                        </div>
                                        <div style="font-weight:700;color:#1e293b;font-size:1.1rem;">+24%</div>
                                    </div>
                                    <!-- Placeholder Insight 2 -->
                                    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px; border:1px solid #f1f5f9; border-radius:12px; background:#fafafa;">
                                        <div style="display:flex; align-items:center; gap:12px;">
                                            <div style="width:40px;height:40px;border-radius:10px;background:#dcfce7;color:#16a34a;display:flex;align-items:center;justify-content:center;font-size:1.2rem;"><i class="fa fa-book-reader"></i></div>
                                            <div>
                                                <h4 style="margin:0;font-size:0.9rem;font-weight:600;color:#1e293b;">{{#str}}dash_course_completion, local_istikama_admin{{/str}}</h4>
                                                <span style="font-size:0.75rem;color:#64748b;">{{#str}}dash_course_completion_desc, local_istikama_admin{{/str}}</span>
                                            </div>
                                        </div>
                                        <div style="font-weight:700;color:#1e293b;font-size:1.1rem;">82%</div>
                                    </div>
                                    <!-- Placeholder Insight 3 -->
                                    <div style="display:flex; align-items:center; justify-content:space-between; padding:16px; border:1px solid #f1f5f9; border-radius:12px; background:#fafafa;">
                                        <div style="display:flex; align-items:center; gap:12px;">
                                            <div style="width:40px;height:40px;border-radius:10px;background:#fef3c7;color:#d97706;display:flex;align-items:center;justify-content:center;font-size:1.2rem;"><i class="fa fa-video"></i></div>
                                            <div>
                                                <h4 style="margin:0;font-size:0.9rem;font-weight:600;color:#1e293b;">{{#str}}dash_live_sessions, local_istikama_admin{{/str}}</h4>
                                                <span style="font-size:0.75rem;color:#64748b;">{{#str}}dash_live_sessions_desc, local_istikama_admin{{/str}}</span>
                                            </div>
                                        </div>
                                        <div style="font-weight:700;color:#1e293b;font-size:1.1rem;">12</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{/hasdashboardstats}}
                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                <!-- ═══ HERO WELCOME SECTION ═══ -->
';
                $buffer .= $indent . '                <div class="isti-hero-welcome">
';
                $buffer .= $indent . '                    <div class="isti-hero-content">
';
                $buffer .= $indent . '                        <h1 class="isti-hero-title">';
                $value = $context->find('str');
                $buffer .= $this->sectionC25a09df79f7c3c8e552140a1e63c570($context, $indent, $value);
                $buffer .= '</h1>
';
                $buffer .= $indent . '                        <p class="isti-hero-subtitle">';
                $value = $context->find('str');
                $buffer .= $this->section3231e6d420617b057e21980c760a9cf5($context, $indent, $value);
                $buffer .= '</p>
';
                $buffer .= $indent . '                    </div>
';
                $buffer .= $indent . '                    <div class="isti-hero-illustration">
';
                $buffer .= $indent . '                        <svg viewBox="0 0 200 160" fill="none" xmlns="http://www.w3.org/2000/svg">
';
                $buffer .= $indent . '                            <!-- Book stack -->
';
                $buffer .= $indent . '                            <rect x="20" y="90" width="60" height="12" rx="3" fill="rgba(255,255,255,0.3)"/>
';
                $buffer .= $indent . '                            <rect x="25" y="78" width="55" height="12" rx="3" fill="rgba(255,255,255,0.4)"/>
';
                $buffer .= $indent . '                            <rect x="22" y="66" width="58" height="12" rx="3" fill="rgba(255,255,255,0.5)"/>
';
                $buffer .= $indent . '                            <!-- Graduation cap -->
';
                $buffer .= $indent . '                            <polygon points="100,20 140,40 100,60 60,40" fill="rgba(255,255,255,0.6)"/>
';
                $buffer .= $indent . '                            <rect x="96" y="60" width="8" height="20" fill="rgba(255,255,255,0.4)"/>
';
                $buffer .= $indent . '                            <rect x="88" y="80" width="24" height="4" rx="2" fill="rgba(255,255,255,0.5)"/>
';
                $buffer .= $indent . '                            <!-- Star -->
';
                $buffer .= $indent . '                            <polygon points="160,30 165,45 180,45 168,55 172,70 160,60 148,70 152,55 140,45 155,45" fill="rgba(255,255,255,0.35)"/>
';
                $buffer .= $indent . '                            <!-- Chart bars -->
';
                $buffer .= $indent . '                            <rect x="130" y="100" width="12" height="30" rx="3" fill="rgba(255,255,255,0.3)"/>
';
                $buffer .= $indent . '                            <rect x="148" y="85" width="12" height="45" rx="3" fill="rgba(255,255,255,0.4)"/>
';
                $buffer .= $indent . '                            <rect x="166" y="70" width="12" height="60" rx="3" fill="rgba(255,255,255,0.5)"/>
';
                $buffer .= $indent . '                        </svg>
';
                $buffer .= $indent . '                    </div>
';
                $buffer .= $indent . '                </div>
';
                $buffer .= $indent . '
';
                $value = $context->find('hasdashboardstats');
                $buffer .= $this->sectionEbeda56a8acb28b1f8f90979b415b442($context, $indent, $value);
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section346492518df262484486db9a461398f2(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                        <div id="region-main-settings-menu" class="d-print-none">
                            <div> {{{ regionmainsettingsmenu }}} </div>
                        </div>
                        ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                        <div id="region-main-settings-menu" class="d-print-none">
';
                $buffer .= $indent . '                            <div> ';
                $value = $this->resolveValue($context->find('regionmainsettingsmenu'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= ' </div>
';
                $buffer .= $indent . '                        </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section85b38e2ef114feb4bcec35483a18248f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                <div class="region_main_settings_menu_proxy"></div>
                            ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                                <div class="region_main_settings_menu_proxy"></div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section10ab9b7b6d2d94caa34262ddc48e2718(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                {{> core/activity_header }}
                            ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                if ($partial = $this->mustache->loadPartial('core/activity_header')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                                ');
                }
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section6bf36f1a79af754fa25425b0182d3182(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                                <div class="container-fluid tertiary-navigation">
                                    <div class="navitem">
                                        {{> core/url_select}}
                                    </div>
                                </div>
                            ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                                <div class="container-fluid tertiary-navigation">
';
                $buffer .= $indent . '                                    <div class="navitem">
';
                if ($partial = $this->mustache->loadPartial('core/url_select')) {
                    $buffer .= $partial->renderInternal($context, $indent . '                                        ');
                }
                $buffer .= $indent . '                                    </div>
';
                $buffer .= $indent . '                                </div>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section7db37fc1d0ef38731265018ab95e330d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section436f64ad88f6f4a5fc37ff5bbdeceeb4(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'addlesson_title, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'addlesson_title, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section1f7000783141226ba4f7272aa2160f64(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'addlesson_library_title, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'addlesson_library_title, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0a27ba8ac139006f207ee0f0a929bc77(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'addlesson_library_desc, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'addlesson_library_desc, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionC5f726fe25601b9c503d04916ff59dad(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'addlesson_quiz_title, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'addlesson_quiz_title, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD86fc2e346741eccf0723b945e6a4459(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'addlesson_quiz_desc, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'addlesson_quiz_desc, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionB641bb5b6e74bb1e24f2dc2a02660301(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'addlesson_forum_title, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'addlesson_forum_title, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionBfaa283bbcd826ed3f1a74f21a725115(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'addlesson_forum_desc, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'addlesson_forum_desc, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0176f9f7308bd980a0cc37ee682f036d(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
// Load the boost loader but NOT the boost drawer — our dashboard provides its
// own sidebar (.isti-sidebar) instead of the boost drawer DOM elements, so
// Drawer.init() would crash with addEventListener(null, …).
M.util.js_pending(\'theme_boost/loader\');
require([\'theme_boost/loader\'], function(Loader) {
    M.util.js_complete(\'theme_boost/loader\');
});
';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '// Load the boost loader but NOT the boost drawer — our dashboard provides its
';
                $buffer .= $indent . '// own sidebar (.isti-sidebar) instead of the boost drawer DOM elements, so
';
                $buffer .= $indent . '// Drawer.init() would crash with addEventListener(null, …).
';
                $buffer .= $indent . 'M.util.js_pending(\'theme_boost/loader\');
';
                $buffer .= $indent . 'require([\'theme_boost/loader\'], function(Loader) {
';
                $buffer .= $indent . '    M.util.js_complete(\'theme_boost/loader\');
';
                $buffer .= $indent . '});
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
