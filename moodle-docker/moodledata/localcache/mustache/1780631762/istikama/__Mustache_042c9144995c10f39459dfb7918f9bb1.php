<?php

class __Mustache_042c9144995c10f39459dfb7918f9bb1 extends Mustache_Template
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
        $buffer .= '>
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
        $buffer .= $indent . '<link rel="stylesheet" href="/local/istikama_admin/styles/landing.css?v=2">
';
        $buffer .= $indent . '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
';
        $buffer .= $indent . '<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&family=Noto+Sans+Arabic:wght@400;500;600;700;800&display=swap">
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<style>
';
        $buffer .= $indent . '/* ── Unify landing typography with the platform identity (Montserrat) ── */
';
        $buffer .= $indent . '#landing-page{--ld-font-display:\'Montserrat\',\'Noto Sans Arabic\',system-ui,sans-serif;--ld-font-body:\'Montserrat\',\'Noto Sans Arabic\',system-ui,sans-serif;--ld-font-ui:\'Montserrat\',\'Noto Sans Arabic\',system-ui,sans-serif}
';
        $buffer .= $indent . '/* Force the unified font over the theme\'s global font rule (which lacked an
';
        $buffer .= $indent . '   Arabic fallback — the cause of the broken Arabic). Icons (<i>) are excluded. */
';
        $buffer .= $indent . '#landing-page h1,#landing-page h2,#landing-page h3,#landing-page h4,#landing-page h5,#landing-page h6,
';
        $buffer .= $indent . '#landing-page p,#landing-page a,#landing-page li,#landing-page button,#landing-page input,#landing-page textarea,
';
        $buffer .= $indent . '#landing-page .ld-title,#landing-page .name,#landing-page .sub,#landing-page .cap,#landing-page .role,
';
        $buffer .= $indent . '#landing-page .desc,#landing-page .excerpt,#landing-page .ld-eyebrow,#landing-page .meta,#landing-page .info,
';
        $buffer .= $indent . '#landing-page .more,#landing-page .link,#landing-page .day,#landing-page .mon,#landing-page .knob,
';
        $buffer .= $indent . '#landing-page .figures,#landing-page .loc,#landing-page .copy,#landing-page .ld-lang-label,#landing-page .ld-lang-menu button,
';
        $buffer .= $indent . '#landing-page .contact-list li,#landing-page .ld-nav-links a,#landing-page .ld-mobile a{font-family:\'Montserrat\',\'Noto Sans Arabic\',system-ui,sans-serif !important}
';
        $buffer .= $indent . '#landing-page.ld-rtl h1,#landing-page.ld-rtl h2,#landing-page.ld-rtl h3,#landing-page.ld-rtl h4,#landing-page.ld-rtl h5,#landing-page.ld-rtl h6,
';
        $buffer .= $indent . '#landing-page.ld-rtl p,#landing-page.ld-rtl a,#landing-page.ld-rtl li,#landing-page.ld-rtl button,#landing-page.ld-rtl input,
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-title,#landing-page.ld-rtl .name,#landing-page.ld-rtl .sub,#landing-page.ld-rtl .cap,#landing-page.ld-rtl .role,
';
        $buffer .= $indent . '#landing-page.ld-rtl .desc,#landing-page.ld-rtl .excerpt,#landing-page.ld-rtl .ld-eyebrow,#landing-page.ld-rtl .meta,#landing-page.ld-rtl .info,
';
        $buffer .= $indent . '#landing-page.ld-rtl .more,#landing-page.ld-rtl .link,#landing-page.ld-rtl .loc,#landing-page.ld-rtl .copy,#landing-page.ld-rtl .day,#landing-page.ld-rtl .mon{font-family:\'Noto Sans Arabic\',\'Montserrat\',system-ui,sans-serif !important}
';
        $buffer .= $indent . '/* In Arabic, lead with Noto Sans Arabic everywhere for a uniform, clean look */
';
        $buffer .= $indent . '#landing-page.ld-rtl{--ld-font-display:\'Noto Sans Arabic\',\'Montserrat\',sans-serif;--ld-font-body:\'Noto Sans Arabic\',\'Montserrat\',sans-serif;--ld-font-ui:\'Noto Sans Arabic\',\'Montserrat\',sans-serif}
';
        $buffer .= $indent . '/* Event date: day always stacked above the month */
';
        $buffer .= $indent . '#landing-page .ld-event .date .day{display:block}
';
        $buffer .= $indent . '#landing-page .ld-event .date .mon{display:block}
';
        $buffer .= $indent . '/* Footer now has 2 columns (About + Contact) */
';
        $buffer .= $indent . '#landing-page .ld-footer .info-card{grid-template-columns:1.3fr 1fr;gap:48px}
';
        $buffer .= $indent . '#landing-page .ld-footer{padding-top:64px}
';
        $buffer .= $indent . '#landing-page,#landing-page h1,#landing-page h2,#landing-page h3,#landing-page h4,#landing-page h5,
';
        $buffer .= $indent . '#landing-page p,#landing-page a,#landing-page span,#landing-page li,#landing-page .ld-title,#landing-page .name,
';
        $buffer .= $indent . '#landing-page .cap,#landing-page .role,#landing-page .desc,#landing-page .excerpt,#landing-page .ld-eyebrow,
';
        $buffer .= $indent . '#landing-page .ld-btn,#landing-page input,#landing-page button{font-family:\'Montserrat\',\'Noto Sans Arabic\',system-ui,sans-serif}
';
        $buffer .= $indent . '#landing-page .ld-title,#landing-page h2,#landing-page h3{letter-spacing:-.015em;font-weight:800}
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '/* ── Hero — bigger, modern, heavier ── */
';
        $buffer .= $indent . '#landing-page .ld-hero .content h1{font-size:clamp(2.9rem,6.4vw,5.4rem);font-weight:900;letter-spacing:-.035em;line-height:1.03}
';
        $buffer .= $indent . '#landing-page .ld-hero .content p{font-size:clamp(1rem,1.5vw,1.18rem);font-weight:400;max-width:680px;margin-inline:auto}
';
        $buffer .= $indent . '#landing-page .ld-hero .content h1{animation:ldHeroUp .9s cubic-bezier(.22,1,.36,1) both}
';
        $buffer .= $indent . '#landing-page .ld-hero .content p{animation:ldHeroUp 1s .12s cubic-bezier(.22,1,.36,1) both}
';
        $buffer .= $indent . '#landing-page .ld-hero .content > a{animation:ldHeroUp 1s .24s cubic-bezier(.22,1,.36,1) both}
';
        $buffer .= $indent . '@keyframes ldHeroUp{from{opacity:0;transform:translateY(26px)}to{opacity:1;transform:none}}
';
        $buffer .= $indent . '#landing-page .ld-hero .accent{background:linear-gradient(100deg,var(--ld-gold) 0%,#ffd87a 45%,var(--ld-gold) 90%);-webkit-background-clip:text;background-clip:text;-webkit-text-fill-color:transparent}
';
        $buffer .= $indent . '#landing-page .ld-service,#landing-page .ld-cause,#landing-page .ld-scholar,#landing-page .ld-post{transition:transform .35s cubic-bezier(.22,1,.36,1),box-shadow .35s ease}
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '/* ── Brand logo (image only, no text) ── */
';
        $buffer .= $indent . '#landing-page .ld-brand .ld-logo-img{height:48px;width:auto;display:block}
';
        $buffer .= $indent . '#landing-page.scrolled .ld-brand .ld-logo-img,#landing-page .ld-nav.scrolled .ld-brand .ld-logo-img{height:42px}
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '/* ── Language switcher: globe + dropdown (dark, professional) ── */
';
        $buffer .= $indent . '#landing-page .ld-lang{position:relative}
';
        $buffer .= $indent . '#landing-page .ld-lang-toggle{display:inline-flex;align-items:center;gap:7px;border:1.5px solid rgba(20,28,46,.18);background:rgba(20,28,46,.04);color:#1e293b !important;border-radius:10px;padding:8px 13px;font-size:.78rem;font-weight:700;cursor:pointer;transition:.18s}
';
        $buffer .= $indent . '#landing-page .ld-lang-toggle i{color:#1e293b}
';
        $buffer .= $indent . '#landing-page .ld-lang-toggle:hover{border-color:var(--ld-gold);background:rgba(240,165,0,.08)}
';
        $buffer .= $indent . '#landing-page .ld-lang-toggle .fa-chevron-down{font-size:.58rem;opacity:.7;transition:transform .2s}
';
        $buffer .= $indent . '#landing-page .ld-lang.open .ld-lang-toggle .fa-chevron-down{transform:rotate(180deg)}
';
        $buffer .= $indent . '#landing-page .ld-lang-menu{position:absolute;top:calc(100% + 8px);inset-inline-end:0;min-width:158px;background:#fff;border:1px solid #e8e8ee;border-radius:12px;box-shadow:0 18px 44px -14px rgba(15,23,42,.35);padding:6px;opacity:0;visibility:hidden;transform:translateY(-6px);transition:.18s;z-index:60}
';
        $buffer .= $indent . '#landing-page .ld-lang.open .ld-lang-menu{opacity:1;visibility:visible;transform:none}
';
        $buffer .= $indent . '#landing-page .ld-lang-menu button{display:flex;align-items:center;gap:10px;width:100%;border:0;background:transparent;color:#1e293b;font-family:\'Montserrat\',\'Noto Sans Arabic\',sans-serif;font-size:.84rem;font-weight:600;padding:9px 11px;border-radius:8px;cursor:pointer;text-align:start}
';
        $buffer .= $indent . '#landing-page .ld-lang-menu button:hover{background:#f4f5f8}
';
        $buffer .= $indent . '#landing-page .ld-lang-menu button.on{background:var(--ld-gold);color:#fff}
';
        $buffer .= $indent . '#landing-page .ld-lang-menu button .flag{font-size:.72rem;font-weight:800;opacity:.55;min-width:20px}
';
        $buffer .= $indent . '#landing-page .ld-lang-menu button.on .flag{opacity:.9}
';
        $buffer .= $indent . '#landing-page .ld-mobile .ld-lang{margin:8px 0}
';
        $buffer .= $indent . '#landing-page .ld-mobile .ld-lang-toggle{width:100%;justify-content:center;color:#1e293b}
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '/* ── Join CTA band (above footer) — rich, ornamented ── */
';
        $buffer .= $indent . '#landing-page .ld-join{position:relative;overflow:hidden;background:linear-gradient(120deg,#10182b 0%,#1b2a47 55%,#243760 100%);padding:78px 0}
';
        $buffer .= $indent . '#landing-page .ld-join::before{content:\'\';position:absolute;inset:0;background:radial-gradient(circle at 16% 130%,rgba(240,165,0,.22),transparent 42%),radial-gradient(circle at 94% -25%,rgba(240,165,0,.13),transparent 40%);pointer-events:none}
';
        $buffer .= $indent . '#landing-page .ld-join-zk{position:absolute;pointer-events:none;width:340px;max-width:36vw;opacity:.07;filter:brightness(0) invert(1);z-index:1}
';
        $buffer .= $indent . '/* Physical left/right so the ornaments never flip in RTL (Arabic) */
';
        $buffer .= $indent . '#landing-page .ld-join-zk.tl{top:-34px;left:-24px;right:auto}
';
        $buffer .= $indent . '#landing-page .ld-join-zk.br{bottom:-44px;right:-24px;left:auto;transform:rotate(180deg)}
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-join-zk.tl{left:-24px;right:auto}
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-join-zk.br{right:-24px;left:auto}
';
        $buffer .= $indent . '#landing-page .ld-join .inner{position:relative;z-index:2;display:flex;align-items:center;justify-content:space-between;gap:36px;flex-wrap:wrap}
';
        $buffer .= $indent . '#landing-page .ld-join-eyebrow{display:inline-flex;align-items:center;gap:9px;color:var(--ld-gold);font-family:var(--ld-font-ui);font-weight:700;letter-spacing:.16em;text-transform:uppercase;font-size:.72rem;margin-bottom:15px}
';
        $buffer .= $indent . '#landing-page .ld-join-eyebrow::before{content:\'\';width:28px;height:2px;background:var(--ld-gold);display:inline-block}
';
        $buffer .= $indent . '#landing-page .ld-join h3{color:#fff;font-size:clamp(1.9rem,3.4vw,2.75rem);font-weight:800;margin:0 0 12px;line-height:1.2}
';
        $buffer .= $indent . '#landing-page .ld-join h3 .accent{color:var(--ld-gold);-webkit-text-fill-color:var(--ld-gold);background:none}
';
        $buffer .= $indent . '#landing-page .ld-join p{color:rgba(255,255,255,.78);margin:0;font-size:1.02rem;max-width:560px;line-height:1.7}
';
        $buffer .= $indent . '#landing-page .ld-join .acts{display:flex;gap:14px;flex-wrap:wrap;flex-shrink:0}
';
        $buffer .= $indent . '#landing-page .ld-join .acts .ld-btn{padding:14px 30px}
';
        $buffer .= $indent . '#landing-page .ld-join .ld-btn-ghost{background:transparent;border:1.6px solid rgba(255,255,255,.45);color:#fff}
';
        $buffer .= $indent . '#landing-page .ld-join .ld-btn-ghost:hover{background:#fff;color:#10182b;border-color:#fff}
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-join .inner{flex-direction:row-reverse;text-align:right}
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-join-eyebrow{letter-spacing:0}
';
        $buffer .= $indent . '@media(max-width:760px){#landing-page .ld-join .inner,#landing-page.ld-rtl .ld-join .inner{flex-direction:column;text-align:center;align-items:center}#landing-page .ld-join-eyebrow::before{display:none}}
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '/* ── RTL / Arabic (Noto Sans Arabic — platform font) ── */
';
        $buffer .= $indent . '#landing-page.ld-rtl{direction:rtl}
';
        $buffer .= $indent . '#landing-page.ld-rtl,#landing-page.ld-rtl h1,#landing-page.ld-rtl h2,#landing-page.ld-rtl h3,#landing-page.ld-rtl h4,#landing-page.ld-rtl h5,
';
        $buffer .= $indent . '#landing-page.ld-rtl p,#landing-page.ld-rtl a,#landing-page.ld-rtl span,#landing-page.ld-rtl li,#landing-page.ld-rtl .ld-title,#landing-page.ld-rtl .name,
';
        $buffer .= $indent . '#landing-page.ld-rtl .cap,#landing-page.ld-rtl .role,#landing-page.ld-rtl .desc,#landing-page.ld-rtl .excerpt,#landing-page.ld-rtl .ld-eyebrow,
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-btn,#landing-page.ld-rtl input,#landing-page.ld-rtl button{font-family:\'Noto Sans Arabic\',\'Montserrat\',sans-serif}
';
        $buffer .= $indent . '/* Arabic must never use negative letter-spacing — it breaks letter joining */
';
        $buffer .= $indent . '#landing-page.ld-rtl,#landing-page.ld-rtl h1,#landing-page.ld-rtl h2,#landing-page.ld-rtl h3,#landing-page.ld-rtl h4,#landing-page.ld-rtl h5,
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-title,#landing-page.ld-rtl .name,#landing-page.ld-rtl .ld-hero .content h1,#landing-page.ld-rtl .ld-eyebrow{letter-spacing:0}
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-divider{direction:ltr}
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-amounts,#landing-page.ld-rtl .ld-pillars-row,#landing-page.ld-rtl .meta,#landing-page.ld-rtl .info,
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-topbar .right,#landing-page.ld-rtl .ld-topbar .social,#landing-page.ld-rtl .ld-join .inner{flex-direction:row-reverse}
';
        $buffer .= $indent . '/* Bulleted lists — correct RTL (icon on the right) */
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-causes-list{padding:0;direction:rtl}
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-causes-list li{flex-direction:row-reverse;text-align:right;justify-content:flex-end}
';
        $buffer .= $indent . '/* Numbers + progress always LTR so "%" and figures never break */
';
        $buffer .= $indent . '#landing-page .ld-progress .knob,#landing-page .figures b{direction:ltr;unicode-bidi:isolate;display:inline-block}
';
        $buffer .= $indent . '#landing-page.ld-rtl .ld-progress{direction:ltr}
';
        $buffer .= $indent . '#landing-page.ld-rtl .figures{flex-direction:row-reverse}
';
        $buffer .= $indent . '@media(max-width:600px){#landing-page .ld-lang-toggle{padding:7px 10px}}
';
        $buffer .= $indent . '</style>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<div id="landing-page" dir="ltr" lang="en">
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <div class="ld-topbar">
';
        $buffer .= $indent . '        <div class="ld-container inner">
';
        $buffer .= $indent . '            <div class="social">
';
        $buffer .= $indent . '                <span style="font-family:var(--ld-font-ui)" data-i18n="follow">Follow Us:</span>
';
        $buffer .= $indent . '                <a href="#" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
';
        $buffer .= $indent . '                <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
';
        $buffer .= $indent . '                <a href="#" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div class="right">
';
        $buffer .= $indent . '                <a href="mailto:help@istikama.org" class="contact-link">
';
        $buffer .= $indent . '                    <i class="fa-regular fa-envelope"></i><span>help@istikama.org</span>
';
        $buffer .= $indent . '                </a>
';
        $buffer .= $indent . '                <a href="tel:+00123345111" class="contact-link">
';
        $buffer .= $indent . '                    <i class="fa-solid fa-phone"></i><span>+(00) 123-345-11</span>
';
        $buffer .= $indent . '                </a>
';
        $buffer .= $indent . '                <a href="/login/index.php" class="tb-donate" data-i18n="enroll">Enroll Now</a>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <nav class="ld-nav" id="ldNav">
';
        $buffer .= $indent . '        <div class="ld-container inner">
';
        $buffer .= $indent . '            <a href="/" class="ld-brand">
';
        $value = $context->findDot('output.get_compact_logo_url');
        $buffer .= $this->section3c9bdb65f9d666332f20274fd3df86b4($context, $indent, $value);
        $value = $context->findDot('output.get_compact_logo_url');
        if (empty($value)) {
            
            $buffer .= $indent . '                    <img class="ld-logo-img" src="/local/istikama_admin/pix/landing/cropped-heading-img-32x32.png" alt="Istikama">
';
        }
        $buffer .= $indent . '            </a>
';
        $buffer .= $indent . '            <div class="ld-nav-links">
';
        $buffer .= $indent . '                <a href="#home" data-i18n="nav_home">Home</a>
';
        $buffer .= $indent . '                <a href="#services" data-i18n="nav_platform">Platform</a>
';
        $buffer .= $indent . '                <a href="#pilgrimage" data-i18n="nav_method">Method</a>
';
        $buffer .= $indent . '                <a href="#scholars" data-i18n="nav_teachers">Teachers</a>
';
        $buffer .= $indent . '                <a href="#events" data-i18n="nav_news">News</a>
';
        $buffer .= $indent . '                <a href="#contact" data-i18n="nav_contact">Contact</a>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div class="ld-nav-right">
';
        $buffer .= $indent . '                <div class="ld-lang" role="group" aria-label="Language">
';
        $buffer .= $indent . '                    <button type="button" class="ld-lang-toggle" aria-haspopup="true"><i class="fa-solid fa-globe"></i> <span class="ld-lang-label">EN</span> <i class="fa-solid fa-chevron-down"></i></button>
';
        $buffer .= $indent . '                    <div class="ld-lang-menu">
';
        $buffer .= $indent . '                        <button type="button" data-lang="en" class="on"><span class="flag">EN</span> English</button>
';
        $buffer .= $indent . '                        <button type="button" data-lang="fr"><span class="flag">FR</span> Français</button>
';
        $buffer .= $indent . '                        <button type="button" data-lang="ar"><span class="flag">ع</span> العربية</button>
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <a href="/login/index.php" class="ld-btn" style="padding:9px 22px;font-size:.74rem" data-i18n="login">Login</a>
';
        $buffer .= $indent . '                <button class="ld-hamburger" id="ldHamburger" aria-label="Menu"><i class="fa-solid fa-bars"></i></button>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        <div class="ld-mobile" id="ldMobile">
';
        $buffer .= $indent . '            <a href="#home" data-i18n="nav_home">Home</a>
';
        $buffer .= $indent . '            <a href="#services" data-i18n="nav_platform">Platform</a>
';
        $buffer .= $indent . '            <a href="#pilgrimage" data-i18n="nav_method">Method</a>
';
        $buffer .= $indent . '            <a href="#scholars" data-i18n="nav_teachers">Teachers</a>
';
        $buffer .= $indent . '            <a href="#events" data-i18n="nav_news">News</a>
';
        $buffer .= $indent . '            <a href="#contact" data-i18n="nav_contact">Contact</a>
';
        $buffer .= $indent . '            <div class="ld-lang">
';
        $buffer .= $indent . '                <button type="button" class="ld-lang-toggle"><i class="fa-solid fa-globe"></i> <span class="ld-lang-label">EN</span> <i class="fa-solid fa-chevron-down"></i></button>
';
        $buffer .= $indent . '                <div class="ld-lang-menu">
';
        $buffer .= $indent . '                    <button type="button" data-lang="en" class="on"><span class="flag">EN</span> English</button>
';
        $buffer .= $indent . '                    <button type="button" data-lang="fr"><span class="flag">FR</span> Français</button>
';
        $buffer .= $indent . '                    <button type="button" data-lang="ar"><span class="flag">ع</span> العربية</button>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <a href="/login/index.php" class="cta" data-i18n="login_student">Student Login</a>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </nav>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <section class="ld-hero" id="home">
';
        $buffer .= $indent . '        <img class="bg" src="/local/istikama_admin/pix/landing/istakama-banner.jpg" alt="Mosque at dusk" fetchpriority="high">
';
        $buffer .= $indent . '        <div class="overlay"></div>
';
        $buffer .= $indent . '        <div class="content">
';
        $buffer .= $indent . '            <div class="ld-divider center" data-reveal><span class="dots"><span></span><span></span><span></span></span></div>
';
        $buffer .= $indent . '            <h1 data-reveal data-i18n-html="hero_h1">Where <span class="accent">Learning</span><br>Shapes the Future</h1>
';
        $buffer .= $indent . '            <div class="ld-divider center" data-reveal><span class="dots"><span></span><span></span><span></span></span></div>
';
        $buffer .= $indent . '            <p data-reveal data-i18n="hero_p">One smart platform uniting the finest Quranic schools and the most dedicated teachers — guiding your children toward excellence in faith, knowledge and character.</p>
';
        $buffer .= $indent . '            <a href="#about" class="ld-btn" data-reveal data-i18n="hero_cta">Discover the Platform</a>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </section>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <section class="ld-about ld-pad" id="about">
';
        $buffer .= $indent . '        <img class="ld-zakhrafa tl" src="/local/istikama_admin/pix/landing/bg-vector-2-1.png" alt="" aria-hidden="true">
';
        $buffer .= $indent . '        <div class="ld-container">
';
        $buffer .= $indent . '            <div class="grid">
';
        $buffer .= $indent . '                <div class="frame" data-reveal="left">
';
        $buffer .= $indent . '                    <img src="/local/istikama_admin/pix/landing/about-us-taqwa-theme.jpg" alt="Grand mosque" loading="lazy">
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <div data-reveal="right">
';
        $buffer .= $indent . '                    <span class="ld-eyebrow" data-i18n="about_eyebrow">Who We Are</span>
';
        $buffer .= $indent . '                    <h2 class="ld-title" data-i18n="about_title">About Istikama</h2>
';
        $buffer .= $indent . '                    <div class="ld-divider"><span class="dots"><span></span><span></span><span></span></span></div>
';
        $buffer .= $indent . '                    <p class="desc" data-i18n="about_p1">Istikama is a unified digital platform that brings all our Quranic-sciences schools together under one intelligent system — blending authentic Islamic education with modern technology. From Tajweed and memorization to Tafseer and jurisprudence, every student learns through a structured, age-appropriate curriculum.</p>
';
        $buffer .= $indent . '                    <p class="desc" data-i18n="about_p2">Our dedicated teachers, modern digital library, interactive lessons and real-time progress tracking give parents full visibility — so every child receives the guidance to become a hero of tomorrow.</p>
';
        $buffer .= $indent . '                    <a href="#services" class="ld-btn" data-i18n="about_cta">Explore Features</a>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </section>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <section class="ld-donation">
';
        $buffer .= $indent . '        <div class="media" data-reveal="left">
';
        $buffer .= $indent . '            <img src="/local/istikama_admin/pix/landing/donation-bg.jpg" alt="Students learning" loading="lazy">
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        <div class="body" data-reveal="right">
';
        $buffer .= $indent . '            <span class="ld-eyebrow" data-i18n="eco_eyebrow">Why Istikama</span>
';
        $buffer .= $indent . '            <h2 class="ld-title" data-i18n="eco_title">A Complete Learning Ecosystem</h2>
';
        $buffer .= $indent . '            <div class="ld-divider"><span class="dots"><span></span><span></span><span></span></span></div>
';
        $buffer .= $indent . '            <div class="ld-amounts" id="ldAmounts">
';
        $buffer .= $indent . '                <button class="ld-amount" data-i18n="eco_tag1">Digital Library</button>
';
        $buffer .= $indent . '                <button class="ld-amount active" data-i18n="eco_tag2">Smart Quizzes</button>
';
        $buffer .= $indent . '                <button class="ld-amount" data-i18n="eco_tag3">Live Tracking</button>
';
        $buffer .= $indent . '                <button class="ld-amount" data-i18n="eco_tag4">Parent Portal</button>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <ul class="ld-causes-list">
';
        $buffer .= $indent . '                <li><i class="fa-solid fa-circle-check"></i> <span data-i18n="eco_b1">A rich digital library of lessons, videos and PDFs — organised by level, subject and lesson.</span></li>
';
        $buffer .= $indent . '                <li><i class="fa-solid fa-circle-check"></i> <span data-i18n="eco_b2">Interactive assignments and auto-graded quizzes that make learning engaging.</span></li>
';
        $buffer .= $indent . '                <li><i class="fa-solid fa-circle-check"></i> <span data-i18n="eco_b3">Parents follow attendance, results and progress in real time, from anywhere.</span></li>
';
        $buffer .= $indent . '            </ul>
';
        $buffer .= $indent . '            <a href="/login/index.php" class="ld-btn ld-btn-dark" data-i18n="eco_cta">Get Started</a>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </section>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <section class="ld-services ld-pad" id="services">
';
        $buffer .= $indent . '        <div class="ld-container">
';
        $buffer .= $indent . '            <div class="ld-section-head" data-reveal>
';
        $buffer .= $indent . '                <span class="ld-eyebrow" data-i18n="feat_eyebrow">What We Offer</span>
';
        $buffer .= $indent . '                <h2 class="ld-title" data-i18n="feat_title">Everything in One Platform</h2>
';
        $buffer .= $indent . '                <div class="ld-divider center"><span class="dots"><span></span><span></span><span></span></span></div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div class="ld-cards-4">
';
        $buffer .= $indent . '                <div class="ld-service" data-reveal="zoom">
';
        $buffer .= $indent . '                    <div class="pic"><img src="/local/istikama_admin/pix/landing/quran-class-300x300.jpg" alt="Digital Library" loading="lazy"></div>
';
        $buffer .= $indent . '                    <div class="cap" data-i18n="feat_c1">Digital Library</div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <div class="ld-service" data-reveal="zoom" style="transition-delay:.08s">
';
        $buffer .= $indent . '                    <div class="pic"><img src="/local/istikama_admin/pix/landing/service-childcare.jpg" alt="Interactive Lessons" loading="lazy"></div>
';
        $buffer .= $indent . '                    <div class="cap" data-i18n="feat_c2">Interactive Lessons</div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <div class="ld-service" data-reveal="zoom" style="transition-delay:.16s">
';
        $buffer .= $indent . '                    <div class="pic"><img src="/local/istikama_admin/pix/landing/service-community.jpg" alt="Quizzes & Assignments" loading="lazy"></div>
';
        $buffer .= $indent . '                    <div class="cap" data-i18n="feat_c3">Quizzes &amp; Assignments</div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <div class="ld-service" data-reveal="zoom" style="transition-delay:.24s">
';
        $buffer .= $indent . '                    <div class="pic"><img src="/local/istikama_admin/pix/landing/service-building.jpg" alt="Progress & Reports" loading="lazy"></div>
';
        $buffer .= $indent . '                    <div class="cap" data-i18n="feat_c4">Progress &amp; Reports</div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </section>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <section class="ld-pillars ld-pad" id="pilgrimage">
';
        $buffer .= $indent . '        <img class="bg" src="/local/istikama_admin/pix/landing/pillars-bg.jpg" alt="" aria-hidden="true">
';
        $buffer .= $indent . '        <div class="overlay"></div>
';
        $buffer .= $indent . '        <div class="ld-container inner">
';
        $buffer .= $indent . '            <div class="ld-section-head" data-reveal>
';
        $buffer .= $indent . '                <span class="ld-eyebrow" data-i18n="method_eyebrow">Our Approach</span>
';
        $buffer .= $indent . '                <h2 class="ld-title" data-i18n="method_title">The Istikama Method</h2>
';
        $buffer .= $indent . '                <div class="ld-divider center"><span class="dots"><span></span><span></span><span></span></span></div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div class="ld-pillars-row">
';
        $buffer .= $indent . '                <div class="ld-pillar" data-reveal="zoom"><div class="box"><i class="fa-solid fa-book-open-reader"></i></div><h3 data-i18n="method_1">Memorization</h3><p data-i18n="method_1s">(Hifdh)</p><span class="connector"></span></div>
';
        $buffer .= $indent . '                <div class="ld-pillar" data-reveal="zoom" style="transition-delay:.1s"><div class="box"><i class="fa-solid fa-feather-pointed"></i></div><h3 data-i18n="method_2">Recitation</h3><p data-i18n="method_2s">(Tajweed)</p><span class="connector"></span></div>
';
        $buffer .= $indent . '                <div class="ld-pillar" data-reveal="zoom" style="transition-delay:.2s"><div class="box"><i class="fa-solid fa-lightbulb"></i></div><h3 data-i18n="method_3">Understanding</h3><p data-i18n="method_3s">(Tafseer)</p><span class="connector"></span></div>
';
        $buffer .= $indent . '                <div class="ld-pillar" data-reveal="zoom" style="transition-delay:.3s"><div class="box"><i class="fa-solid fa-hand-holding-heart"></i></div><h3 data-i18n="method_4">Character</h3><p data-i18n="method_4s">(Akhlaq)</p><span class="connector"></span></div>
';
        $buffer .= $indent . '                <div class="ld-pillar" data-reveal="zoom" style="transition-delay:.4s"><div class="box"><i class="fa-solid fa-award"></i></div><h3 data-i18n="method_5">Mastery</h3><p data-i18n="method_5s">(Itqan)</p><span class="connector"></span></div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </section>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <section class="ld-causes ld-pad" id="causes">
';
        $buffer .= $indent . '        <img class="ld-zakhrafa br" src="/local/istikama_admin/pix/landing/bg-vector-2-1.png" alt="" aria-hidden="true">
';
        $buffer .= $indent . '        <div class="ld-container">
';
        $buffer .= $indent . '            <div class="ld-section-head" data-reveal>
';
        $buffer .= $indent . '                <span class="ld-eyebrow" data-i18n="prog_eyebrow">Explore</span>
';
        $buffer .= $indent . '                <h2 class="ld-title" data-i18n="prog_title">Our Programs</h2>
';
        $buffer .= $indent . '                <div class="ld-divider center"><span class="dots"><span></span><span></span><span></span></span></div>
';
        $buffer .= $indent . '                <p style="margin-top:14px" data-i18n="prog_intro">Structured learning paths for every age and level — taught by qualified teachers and powered by a smart digital platform.</p>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div class="ld-cards-3">
';
        $buffer .= $indent . '                <div class="ld-cause" data-reveal="zoom">
';
        $buffer .= $indent . '                    <div class="pic"><img src="/local/istikama_admin/pix/landing/service-childcare.jpg" alt="Primary Quran Program" loading="lazy"></div>
';
        $buffer .= $indent . '                    <div class="body">
';
        $buffer .= $indent . '                        <h3 data-i18n="prog1_t">Primary Quran Program</h3>
';
        $buffer .= $indent . '                        <div class="meta"><span><i class="fa-solid fa-children"></i> <span data-i18n="prog1_age">Ages 6–10</span></span><span><i class="fa-solid fa-chalkboard-user"></i> <span data-i18n="prog1_teacher">Sheikh Bilal</span></span></div>
';
        $buffer .= $indent . '                        <p class="excerpt" data-i18n="prog1_x">Foundations of reading, Tajweed and short Surahs through playful, interactive lessons.</p>
';
        $buffer .= $indent . '                        <div class="ld-progress"><div class="fill" data-pct="80"><span class="knob">80%</span></div></div>
';
        $buffer .= $indent . '                        <div class="figures"><span><span data-i18n="prog_enrolled">Enrolled</span>: <b>240</b></span><span><span data-i18n="prog_seats">Seats</span>: <b>300</b></span></div>
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <div class="ld-cause" data-reveal="zoom" style="transition-delay:.1s">
';
        $buffer .= $indent . '                    <div class="pic"><img src="/local/istikama_admin/pix/landing/quran-class-300x300.jpg" alt="Memorization Track" loading="lazy"></div>
';
        $buffer .= $indent . '                    <div class="body">
';
        $buffer .= $indent . '                        <h3 data-i18n="prog2_t">Memorization Track</h3>
';
        $buffer .= $indent . '                        <div class="meta"><span><i class="fa-solid fa-children"></i> <span data-i18n="prog2_age">Ages 10–15</span></span><span><i class="fa-solid fa-chalkboard-user"></i> <span data-i18n="prog2_teacher">Sheikh Ali</span></span></div>
';
        $buffer .= $indent . '                        <p class="excerpt" data-i18n="prog2_x">A guided Hifdh journey with revision tools, audio recitation and milestone tracking.</p>
';
        $buffer .= $indent . '                        <div class="ld-progress"><div class="fill" data-pct="65"><span class="knob">65%</span></div></div>
';
        $buffer .= $indent . '                        <div class="figures"><span><span data-i18n="prog_enrolled">Enrolled</span>: <b>180</b></span><span><span data-i18n="prog_seats">Seats</span>: <b>280</b></span></div>
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <div class="ld-cause" data-reveal="zoom" style="transition-delay:.2s">
';
        $buffer .= $indent . '                    <div class="pic"><img src="/local/istikama_admin/pix/landing/about-mosque.jpg" alt="Islamic Sciences" loading="lazy"></div>
';
        $buffer .= $indent . '                    <div class="body">
';
        $buffer .= $indent . '                        <h3 data-i18n="prog3_t">Islamic Sciences</h3>
';
        $buffer .= $indent . '                        <div class="meta"><span><i class="fa-solid fa-children"></i> <span data-i18n="prog3_age">Ages 13+</span></span><span><i class="fa-solid fa-chalkboard-user"></i> <span data-i18n="prog3_teacher">Sheikh Nasir</span></span></div>
';
        $buffer .= $indent . '                        <p class="excerpt" data-i18n="prog3_x">Tafseer, Hadith and Fiqh taught with depth, discussion and modern resources.</p>
';
        $buffer .= $indent . '                        <div class="ld-progress"><div class="fill" data-pct="70"><span class="knob">70%</span></div></div>
';
        $buffer .= $indent . '                        <div class="figures"><span><span data-i18n="prog_enrolled">Enrolled</span>: <b>210</b></span><span><span data-i18n="prog_seats">Seats</span>: <b>300</b></span></div>
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </section>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <section class="ld-blog ld-pad" id="events">
';
        $buffer .= $indent . '        <div class="ld-container">
';
        $buffer .= $indent . '            <div class="ld-section-head" data-reveal>
';
        $buffer .= $indent . '                <span class="ld-eyebrow" data-i18n="news_eyebrow">News &amp; Events</span>
';
        $buffer .= $indent . '                <h2 class="ld-title" data-i18n="news_title">Latest News &amp; Events</h2>
';
        $buffer .= $indent . '                <div class="ld-divider center"><span class="dots"><span></span><span></span><span></span></span></div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div class="grid">
';
        $buffer .= $indent . '                <div data-reveal="left">
';
        $buffer .= $indent . '                    <article class="ld-post">
';
        $buffer .= $indent . '                        <img src="/local/istikama_admin/pix/landing/blog-quran.jpg" alt="News">
';
        $buffer .= $indent . '                        <div class="body">
';
        $buffer .= $indent . '                            <h3 data-i18n="post1_t">New School Year, New Possibilities</h3>
';
        $buffer .= $indent . '                            <div class="meta"><span><i class="fa-regular fa-calendar"></i> <span data-i18n="post1_date">Sep 1, 2025</span></span><span><i class="fa-regular fa-user"></i> <span data-i18n="post_author">Istikama Team</span></span></div>
';
        $buffer .= $indent . '                            <p class="excerpt" data-i18n="post1_x">Discover what\'s new on the platform this year — richer libraries, smarter parent tools and more…</p>
';
        $buffer .= $indent . '                            <a href="#" class="more" data-i18n="read_more">Read More &rarr;</a>
';
        $buffer .= $indent . '                        </div>
';
        $buffer .= $indent . '                    </article>
';
        $buffer .= $indent . '                    <article class="ld-post">
';
        $buffer .= $indent . '                        <img src="/local/istikama_admin/pix/landing/slider-green-taqwa-islamic-300x300.jpg" alt="Technology">
';
        $buffer .= $indent . '                        <div class="body">
';
        $buffer .= $indent . '                            <h3 data-i18n="post2_t">How Technology Elevates Quranic Learning</h3>
';
        $buffer .= $indent . '                            <div class="meta"><span><i class="fa-regular fa-calendar"></i> <span data-i18n="post2_date">Aug 18, 2025</span></span><span><i class="fa-regular fa-user"></i> <span data-i18n="post_author">Istikama Team</span></span></div>
';
        $buffer .= $indent . '                            <p class="excerpt" data-i18n="post2_x">Audio recitation, instant feedback and progress insights are transforming the classroom…</p>
';
        $buffer .= $indent . '                            <a href="#" class="more" data-i18n="read_more">Read More &rarr;</a>
';
        $buffer .= $indent . '                        </div>
';
        $buffer .= $indent . '                    </article>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <div data-reveal="right">
';
        $buffer .= $indent . '                    <div class="ld-event">
';
        $buffer .= $indent . '                        <div class="date"><span class="day">28</span><span class="mon" data-i18n="mon_nov">Nov</span></div>
';
        $buffer .= $indent . '                        <div>
';
        $buffer .= $indent . '                            <h3 data-i18n="ev1_t">Open Day &amp; School Tour</h3>
';
        $buffer .= $indent . '                            <div class="info"><span><i class="fa-solid fa-location-dot"></i> <span data-i18n="ev_loc_campus">Main Campus</span></span><span><i class="fa-regular fa-clock"></i> 9:30 — 13:15</span></div>
';
        $buffer .= $indent . '                            <a href="#" class="link" data-i18n="ev_details">Event Details &rarr;</a>
';
        $buffer .= $indent . '                        </div>
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                    <div class="ld-event">
';
        $buffer .= $indent . '                        <div class="date"><span class="day">24</span><span class="mon" data-i18n="mon_dec">Dec</span></div>
';
        $buffer .= $indent . '                        <div>
';
        $buffer .= $indent . '                            <h3 data-i18n="ev2_t">Quran Recitation Contest</h3>
';
        $buffer .= $indent . '                            <div class="info"><span><i class="fa-solid fa-location-dot"></i> <span data-i18n="ev_loc_campus">Main Campus</span></span><span><i class="fa-regular fa-clock"></i> 9:30 — 13:15</span></div>
';
        $buffer .= $indent . '                            <a href="#" class="link" data-i18n="ev_details">Event Details &rarr;</a>
';
        $buffer .= $indent . '                        </div>
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                    <div class="ld-event">
';
        $buffer .= $indent . '                        <div class="date"><span class="day">25</span><span class="mon" data-i18n="mon_dec">Dec</span></div>
';
        $buffer .= $indent . '                        <div>
';
        $buffer .= $indent . '                            <h3 data-i18n="ev3_t">Parents &amp; Teachers Meetup</h3>
';
        $buffer .= $indent . '                            <div class="info"><span><i class="fa-solid fa-location-dot"></i> <span data-i18n="ev_loc_online">Online</span></span><span><i class="fa-regular fa-clock"></i> 18:00 — 19:30</span></div>
';
        $buffer .= $indent . '                            <a href="#" class="link" data-i18n="ev_details">Event Details &rarr;</a>
';
        $buffer .= $indent . '                        </div>
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </section>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <section class="ld-scholars ld-pad" id="scholars">
';
        $buffer .= $indent . '        <div class="ld-container">
';
        $buffer .= $indent . '            <div class="ld-section-head" data-reveal>
';
        $buffer .= $indent . '                <span class="ld-eyebrow" data-i18n="team_eyebrow">Meet The Team</span>
';
        $buffer .= $indent . '                <h2 class="ld-title" data-i18n="team_title">Our Expert Teachers</h2>
';
        $buffer .= $indent . '                <div class="ld-divider center"><span class="dots"><span></span><span></span><span></span></span></div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div class="ld-cards-3">
';
        $buffer .= $indent . '                <div class="ld-scholar" data-reveal="zoom">
';
        $buffer .= $indent . '                    <div class="pic"><img src="/local/istikama_admin/pix/landing/service-community.jpg" alt="" loading="lazy"></div>
';
        $buffer .= $indent . '                    <div class="card">
';
        $buffer .= $indent . '                        <div class="socials"><a href="#"><i class="fa-brands fa-x-twitter"></i></a><a href="#"><i class="fa-brands fa-facebook-f"></i></a><a href="#"><i class="fa-brands fa-linkedin-in"></i></a><a href="#"><i class="fa-brands fa-youtube"></i></a></div>
';
        $buffer .= $indent . '                        <h3 data-i18n="t1_name">Sheikh Bilal Hatim</h3>
';
        $buffer .= $indent . '                        <div class="role" data-i18n="t1_role">Founder &amp; Lead Educator</div>
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <div class="ld-scholar featured" data-reveal="zoom" style="transition-delay:.1s">
';
        $buffer .= $indent . '                    <div class="pic"><img src="/local/istikama_admin/pix/landing/service-childcare.jpg" alt="" loading="lazy"></div>
';
        $buffer .= $indent . '                    <div class="card">
';
        $buffer .= $indent . '                        <div class="socials"><a href="#"><i class="fa-brands fa-x-twitter"></i></a><a href="#"><i class="fa-brands fa-facebook-f"></i></a><a href="#"><i class="fa-brands fa-linkedin-in"></i></a><a href="#"><i class="fa-brands fa-youtube"></i></a></div>
';
        $buffer .= $indent . '                        <h3 data-i18n="t2_name">Sheikh Ali Hammam</h3>
';
        $buffer .= $indent . '                        <div class="role" data-i18n="t2_role">Memorization Specialist</div>
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <div class="ld-scholar" data-reveal="zoom" style="transition-delay:.2s">
';
        $buffer .= $indent . '                    <div class="pic"><img src="/local/istikama_admin/pix/landing/quran-class-300x300.jpg" alt="" loading="lazy"></div>
';
        $buffer .= $indent . '                    <div class="card">
';
        $buffer .= $indent . '                        <div class="socials"><a href="#"><i class="fa-brands fa-x-twitter"></i></a><a href="#"><i class="fa-brands fa-facebook-f"></i></a><a href="#"><i class="fa-brands fa-linkedin-in"></i></a><a href="#"><i class="fa-brands fa-youtube"></i></a></div>
';
        $buffer .= $indent . '                        <h3 data-i18n="t3_name">Ustadha Nasira Sheikh</h3>
';
        $buffer .= $indent . '                        <div class="role" data-i18n="t3_role">Early-Years Teacher</div>
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </section>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <section class="ld-join">
';
        $buffer .= $indent . '        <img class="ld-join-zk tl" src="/local/istikama_admin/pix/landing/bg-vector-2-1.png" alt="" aria-hidden="true">
';
        $buffer .= $indent . '        <img class="ld-join-zk br" src="/local/istikama_admin/pix/landing/bg-vector-2-1.png" alt="" aria-hidden="true">
';
        $buffer .= $indent . '        <div class="ld-container inner">
';
        $buffer .= $indent . '            <div data-reveal="left">
';
        $buffer .= $indent . '                <span class="ld-join-eyebrow" data-i18n="join_eyebrow">Start Today</span>
';
        $buffer .= $indent . '                <h3 data-i18n-html="join_title">Ready to unlock your child\'s <span class="accent">potential</span>?</h3>
';
        $buffer .= $indent . '                <p data-i18n="join_p">Join Istikama today — give your children the finest teachers, an authentic curriculum and a smart platform that grows with them.</p>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div class="acts" data-reveal="right">
';
        $buffer .= $indent . '                <a href="/login/index.php" class="ld-btn" data-i18n="join_cta1">Enroll Now</a>
';
        $buffer .= $indent . '                <a href="#about" class="ld-btn ld-btn-ghost" data-i18n="join_cta2">Learn More</a>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </section>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <footer class="ld-footer" id="contact">
';
        $buffer .= $indent . '        <div class="ld-container">
';
        $buffer .= $indent . '            <div class="info-card">
';
        $buffer .= $indent . '                <div class="about-col">
';
        $buffer .= $indent . '                    <h4 data-i18n="f_about">About Us</h4>
';
        $buffer .= $indent . '                    <p data-i18n="f_about_p">Istikama unites the finest Quranic schools and teachers on one smart platform — helping every child learn, grow and thrive through authentic education and modern technology.</p>
';
        $buffer .= $indent . '                    <div class="logo-circle"><img src="/local/istikama_admin/pix/landing/cropped-heading-img-32x32.png" alt="Istikama"></div>
';
        $buffer .= $indent . '                    <div class="loc"><i class="fa-solid fa-location-dot"></i> <span data-i18n="f_loc">Istikama Foundation — Headquarters</span></div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '                <div>
';
        $buffer .= $indent . '                    <h4 data-i18n="f_contact">Contact Info</h4>
';
        $buffer .= $indent . '                    <ul class="contact-list">
';
        $buffer .= $indent . '                        <li><i class="fa-regular fa-envelope"></i> info@istikama.org</li>
';
        $buffer .= $indent . '                        <li><i class="fa-solid fa-phone"></i> 1800-123-456-7</li>
';
        $buffer .= $indent . '                        <li><i class="fa-solid fa-location-dot"></i> <span data-i18n="f_addr">19 Education Avenue, Algeria</span></li>
';
        $buffer .= $indent . '                        <li><i class="fa-solid fa-globe"></i> www.istikama.org</li>
';
        $buffer .= $indent . '                    </ul>
';
        $buffer .= $indent . '                    <div class="social-row">
';
        $buffer .= $indent . '                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
';
        $buffer .= $indent . '                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
';
        $buffer .= $indent . '                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
';
        $buffer .= $indent . '                    </div>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        <div class="gold-bar">
';
        $buffer .= $indent . '            <div class="ld-container">
';
        $buffer .= $indent . '                <div class="copy" style="margin:0 auto;text-align:center" data-i18n="g_copy">Istikama © Copyright 2026 — All Rights Reserved</div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </footer>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <button class="ld-totop" id="ldTotop" aria-label="Back to top"><i class="fa-solid fa-arrow-up"></i></button>
';
        $buffer .= $indent . '</div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<div class="d-none">';
        $value = $this->resolveValue($context->findDot('output.main_content'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '</div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<script>
';
        $buffer .= $indent . '(function () {
';
        $buffer .= $indent . '    \'use strict\';
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ════════════ i18n DICTIONARY (EN / FR / AR) ════════════
';
        $buffer .= $indent . '    var I18N = {
';
        $buffer .= $indent . '        en: {
';
        $buffer .= $indent . '            follow:\'Follow Us:\', prayer:\'Prayer Times\', enroll:\'Enroll Now\',
';
        $buffer .= $indent . '            join_eyebrow:\'Start Today\', join_title:\'Ready to unlock your child\\\'s <span class="accent">potential</span>?\', join_p:\'Join Istikama today — give your children the finest teachers, an authentic curriculum and a smart platform that grows with them.\', join_cta1:\'Enroll Now\', join_cta2:\'Learn More\',
';
        $buffer .= $indent . '            brand_name:\'Istikama <span class="accent">Academy</span>\', brand_sub:\'Quranic Sciences Association\',
';
        $buffer .= $indent . '            nav_home:\'Home\', nav_platform:\'Platform\', nav_method:\'Method\', nav_teachers:\'Teachers\', nav_news:\'News\', nav_contact:\'Contact\',
';
        $buffer .= $indent . '            login:\'Login\', login_student:\'Student Login\',
';
        $buffer .= $indent . '            hero_h1:\'Where <span class="accent">Learning</span><br>Shapes the Future\',
';
        $buffer .= $indent . '            hero_p:\'One smart platform uniting the finest Quranic schools and the most dedicated teachers — guiding your children toward excellence in faith, knowledge and character.\',
';
        $buffer .= $indent . '            hero_cta:\'Discover the Platform\',
';
        $buffer .= $indent . '            about_eyebrow:\'Who We Are\', about_title:\'About Istikama\',
';
        $buffer .= $indent . '            about_p1:\'Istikama is a unified digital platform that brings all our Quranic-sciences schools together under one intelligent system — blending authentic Islamic education with modern technology. From Tajweed and memorization to Tafseer and jurisprudence, every student learns through a structured, age-appropriate curriculum.\',
';
        $buffer .= $indent . '            about_p2:\'Our dedicated teachers, modern digital library, interactive lessons and real-time progress tracking give parents full visibility — so every child receives the guidance to become a hero of tomorrow.\',
';
        $buffer .= $indent . '            about_cta:\'Explore Features\',
';
        $buffer .= $indent . '            eco_eyebrow:\'Why Istikama\', eco_title:\'A Complete Learning Ecosystem\',
';
        $buffer .= $indent . '            eco_tag1:\'Digital Library\', eco_tag2:\'Smart Quizzes\', eco_tag3:\'Live Tracking\', eco_tag4:\'Parent Portal\',
';
        $buffer .= $indent . '            eco_b1:\'A rich digital library of lessons, videos and PDFs — organised by level, subject and lesson.\',
';
        $buffer .= $indent . '            eco_b2:\'Interactive assignments and auto-graded quizzes that make learning engaging.\',
';
        $buffer .= $indent . '            eco_b3:\'Parents follow attendance, results and progress in real time, from anywhere.\',
';
        $buffer .= $indent . '            eco_cta:\'Get Started\',
';
        $buffer .= $indent . '            feat_eyebrow:\'What We Offer\', feat_title:\'Everything in One Platform\',
';
        $buffer .= $indent . '            feat_c1:\'Digital Library\', feat_c2:\'Interactive Lessons\', feat_c3:\'Quizzes & Assignments\', feat_c4:\'Progress & Reports\',
';
        $buffer .= $indent . '            method_eyebrow:\'Our Approach\', method_title:\'The Istikama Method\',
';
        $buffer .= $indent . '            method_1:\'Memorization\', method_1s:\'(Hifdh)\', method_2:\'Recitation\', method_2s:\'(Tajweed)\',
';
        $buffer .= $indent . '            method_3:\'Understanding\', method_3s:\'(Tafseer)\', method_4:\'Character\', method_4s:\'(Akhlaq)\',
';
        $buffer .= $indent . '            method_5:\'Mastery\', method_5s:\'(Itqan)\',
';
        $buffer .= $indent . '            prog_eyebrow:\'Explore\', prog_title:\'Our Programs\',
';
        $buffer .= $indent . '            prog_intro:\'Structured learning paths for every age and level — taught by qualified teachers and powered by a smart digital platform.\',
';
        $buffer .= $indent . '            prog1_t:\'Primary Quran Program\', prog1_age:\'Ages 6–10\', prog1_teacher:\'Sheikh Bilal\', prog1_x:\'Foundations of reading, Tajweed and short Surahs through playful, interactive lessons.\',
';
        $buffer .= $indent . '            prog2_t:\'Memorization Track\', prog2_age:\'Ages 10–15\', prog2_teacher:\'Sheikh Ali\', prog2_x:\'A guided Hifdh journey with revision tools, audio recitation and milestone tracking.\',
';
        $buffer .= $indent . '            prog3_t:\'Islamic Sciences\', prog3_age:\'Ages 13+\', prog3_teacher:\'Sheikh Nasir\', prog3_x:\'Tafseer, Hadith and Fiqh taught with depth, discussion and modern resources.\',
';
        $buffer .= $indent . '            prog_enrolled:\'Enrolled\', prog_seats:\'Seats\',
';
        $buffer .= $indent . '            news_eyebrow:\'News & Events\', news_title:\'Latest News & Events\',
';
        $buffer .= $indent . '            post1_t:\'New School Year, New Possibilities\', post1_date:\'Sep 1, 2025\', post1_x:"Discover what\'s new on the platform this year — richer libraries, smarter parent tools and more…",
';
        $buffer .= $indent . '            post2_t:\'How Technology Elevates Quranic Learning\', post2_date:\'Aug 18, 2025\', post2_x:\'Audio recitation, instant feedback and progress insights are transforming the classroom…\',
';
        $buffer .= $indent . '            post_author:\'Istikama Team\', read_more:\'Read More →\',
';
        $buffer .= $indent . '            mon_nov:\'Nov\', mon_dec:\'Dec\', ev_details:\'Event Details →\', ev_loc_campus:\'Main Campus\', ev_loc_online:\'Online\',
';
        $buffer .= $indent . '            ev1_t:\'Open Day & School Tour\', ev2_t:\'Quran Recitation Contest\', ev3_t:\'Parents & Teachers Meetup\',
';
        $buffer .= $indent . '            team_eyebrow:\'Meet The Team\', team_title:\'Our Expert Teachers\',
';
        $buffer .= $indent . '            t1_name:\'Sheikh Bilal Hatim\', t1_role:\'Founder & Lead Educator\',
';
        $buffer .= $indent . '            t2_name:\'Sheikh Ali Hammam\', t2_role:\'Memorization Specialist\',
';
        $buffer .= $indent . '            t3_name:\'Ustadha Nasira Sheikh\', t3_role:\'Early-Years Teacher\',
';
        $buffer .= $indent . '            f_about:\'About Us\', f_about_p:\'Istikama unites the finest Quranic schools and teachers on one smart platform — helping every child learn, grow and thrive through authentic education and modern technology.\',
';
        $buffer .= $indent . '            f_loc:\'Istikama Foundation — Headquarters\',
';
        $buffer .= $indent . '            f_news:\'Latest News\', f_news1:\'New School Year, New Possibilities\', f_news2:\'Technology & Quranic Learning\', f_news3:"A Parent\'s Guide to the Platform", f_news3_date:\'Aug 6, 2025\',
';
        $buffer .= $indent . '            f_contact:\'Contact Info\', f_addr:\'19 Education Avenue, Algeria\',
';
        $buffer .= $indent . '            f_subscribe:\'Subscribe Newsletter\', f_name:\'Name\', f_email:\'Email\', f_subscribe_btn:\'Subscribe\',
';
        $buffer .= $indent . '            g_title:\'Subscribe, For Weekly Updates\', g_ph:\'Enter Your Email Address *\', g_btn:\'Signup Now\',
';
        $buffer .= $indent . '            g_copy:\'Istikama © Copyright 2026 — All Rights Reserved\'
';
        $buffer .= $indent . '        },
';
        $buffer .= $indent . '        fr: {
';
        $buffer .= $indent . '            follow:\'Suivez-nous :\', prayer:\'Horaires de prière\', enroll:\'Inscrivez-vous\',
';
        $buffer .= $indent . '            join_eyebrow:\'Commencez aujourd\\\'hui\', join_title:\'Prêt à révéler le <span class="accent">potentiel</span> de votre enfant ?\', join_p:\'Rejoignez Istikama dès aujourd\\\'hui — offrez à vos enfants les meilleurs enseignants, un programme authentique et une plateforme intelligente qui grandit avec eux.\', join_cta1:\'Inscrivez-vous\', join_cta2:\'En savoir plus\',
';
        $buffer .= $indent . '            brand_name:\'Istikama <span class="accent">Academy</span>\', brand_sub:\'Association des sciences coraniques\',
';
        $buffer .= $indent . '            nav_home:\'Accueil\', nav_platform:\'Plateforme\', nav_method:\'Méthode\', nav_teachers:\'Enseignants\', nav_news:\'Actualités\', nav_contact:\'Contact\',
';
        $buffer .= $indent . '            login:\'Connexion\', login_student:\'Espace élève\',
';
        $buffer .= $indent . '            hero_h1:\'Où le <span class="accent">savoir</span><br>façonne l\\\'avenir\',
';
        $buffer .= $indent . '            hero_p:\'Une plateforme intelligente réunissant les meilleures écoles coraniques et les enseignants les plus dévoués — pour guider vos enfants vers l\\\'excellence dans la foi, le savoir et le caractère.\',
';
        $buffer .= $indent . '            hero_cta:\'Découvrir la plateforme\',
';
        $buffer .= $indent . '            about_eyebrow:\'Qui sommes-nous\', about_title:\'À propos d\\\'Istikama\',
';
        $buffer .= $indent . '            about_p1:\'Istikama est une plateforme numérique unifiée qui rassemble toutes nos écoles de sciences coraniques au sein d\\\'un système intelligent — alliant un enseignement islamique authentique aux technologies modernes. Du Tajwid et de la mémorisation au Tafsir et à la jurisprudence, chaque élève apprend selon un programme structuré et adapté à son âge.\',
';
        $buffer .= $indent . '            about_p2:\'Nos enseignants dévoués, notre bibliothèque numérique moderne, nos cours interactifs et le suivi en temps réel offrent aux parents une visibilité totale — pour que chaque enfant devienne un héros de demain.\',
';
        $buffer .= $indent . '            about_cta:\'Voir les fonctionnalités\',
';
        $buffer .= $indent . '            eco_eyebrow:\'Pourquoi Istikama\', eco_title:\'Un écosystème d\\\'apprentissage complet\',
';
        $buffer .= $indent . '            eco_tag1:\'Bibliothèque\', eco_tag2:\'Quiz intelligents\', eco_tag3:\'Suivi en direct\', eco_tag4:\'Espace parents\',
';
        $buffer .= $indent . '            eco_b1:\'Une riche bibliothèque numérique de cours, vidéos et PDF — classée par niveau, matière et leçon.\',
';
        $buffer .= $indent . '            eco_b2:\'Des devoirs interactifs et des quiz auto-corrigés qui rendent l\\\'apprentissage captivant.\',
';
        $buffer .= $indent . '            eco_b3:\'Les parents suivent la présence, les résultats et la progression en temps réel, partout.\',
';
        $buffer .= $indent . '            eco_cta:\'Commencer\',
';
        $buffer .= $indent . '            feat_eyebrow:\'Ce que nous offrons\', feat_title:\'Tout sur une seule plateforme\',
';
        $buffer .= $indent . '            feat_c1:\'Bibliothèque numérique\', feat_c2:\'Cours interactifs\', feat_c3:\'Quiz & devoirs\', feat_c4:\'Suivi & rapports\',
';
        $buffer .= $indent . '            method_eyebrow:\'Notre approche\', method_title:\'La méthode Istikama\',
';
        $buffer .= $indent . '            method_1:\'Mémorisation\', method_1s:\'(Hifdh)\', method_2:\'Récitation\', method_2s:\'(Tajwid)\',
';
        $buffer .= $indent . '            method_3:\'Compréhension\', method_3s:\'(Tafsir)\', method_4:\'Caractère\', method_4s:\'(Akhlaq)\',
';
        $buffer .= $indent . '            method_5:\'Excellence\', method_5s:\'(Itqan)\',
';
        $buffer .= $indent . '            prog_eyebrow:\'Découvrir\', prog_title:\'Nos programmes\',
';
        $buffer .= $indent . '            prog_intro:\'Des parcours structurés pour chaque âge et niveau — encadrés par des enseignants qualifiés et soutenus par une plateforme numérique intelligente.\',
';
        $buffer .= $indent . '            prog1_t:\'Programme coranique primaire\', prog1_age:\'6 à 10 ans\', prog1_teacher:\'Cheikh Bilal\', prog1_x:\'Les bases de la lecture, du Tajwid et des courtes sourates à travers des leçons interactives et ludiques.\',
';
        $buffer .= $indent . '            prog2_t:\'Parcours de mémorisation\', prog2_age:\'10 à 15 ans\', prog2_teacher:\'Cheikh Ali\', prog2_x:\'Un parcours de Hifdh guidé avec outils de révision, récitation audio et suivi des étapes.\',
';
        $buffer .= $indent . '            prog3_t:\'Sciences islamiques\', prog3_age:\'13 ans et +\', prog3_teacher:\'Cheikh Nasir\', prog3_x:\'Tafsir, Hadith et Fiqh enseignés avec profondeur, débat et ressources modernes.\',
';
        $buffer .= $indent . '            prog_enrolled:\'Inscrits\', prog_seats:\'Places\',
';
        $buffer .= $indent . '            news_eyebrow:\'Actualités & événements\', news_title:\'Dernières actualités & événements\',
';
        $buffer .= $indent . '            post1_t:\'Nouvelle année scolaire, nouvelles possibilités\', post1_date:\'1 sept. 2025\', post1_x:\'Découvrez les nouveautés de la plateforme cette année — bibliothèques enrichies, outils parents et plus encore…\',
';
        $buffer .= $indent . '            post2_t:\'Comment la technologie élève l\\\'apprentissage coranique\', post2_date:\'18 août 2025\', post2_x:\'Récitation audio, retour instantané et suivi des progrès transforment la classe…\',
';
        $buffer .= $indent . '            post_author:\'Équipe Istikama\', read_more:\'Lire la suite →\',
';
        $buffer .= $indent . '            mon_nov:\'Nov\', mon_dec:\'Déc\', ev_details:\'Détails →\', ev_loc_campus:\'Campus principal\', ev_loc_online:\'En ligne\',
';
        $buffer .= $indent . '            ev1_t:\'Journée portes ouvertes\', ev2_t:\'Concours de récitation\', ev3_t:\'Rencontre parents & enseignants\',
';
        $buffer .= $indent . '            team_eyebrow:\'L\\\'équipe\', team_title:\'Nos enseignants experts\',
';
        $buffer .= $indent . '            t1_name:\'Cheikh Bilal Hatim\', t1_role:\'Fondateur & éducateur principal\',
';
        $buffer .= $indent . '            t2_name:\'Cheikh Ali Hammam\', t2_role:\'Spécialiste en mémorisation\',
';
        $buffer .= $indent . '            t3_name:\'Oustadha Nasira Sheikh\', t3_role:\'Enseignante des petites classes\',
';
        $buffer .= $indent . '            f_about:\'À propos\', f_about_p:\'Istikama réunit les meilleures écoles et enseignants coraniques sur une plateforme intelligente — pour aider chaque enfant à apprendre, grandir et s\\\'épanouir grâce à un enseignement authentique et des technologies modernes.\',
';
        $buffer .= $indent . '            f_loc:\'Fondation Istikama — Siège\',
';
        $buffer .= $indent . '            f_news:\'Dernières actualités\', f_news1:\'Nouvelle année scolaire\', f_news2:\'Technologie & apprentissage coranique\', f_news3:\'Guide des parents pour la plateforme\', f_news3_date:\'6 août 2025\',
';
        $buffer .= $indent . '            f_contact:\'Coordonnées\', f_addr:\'19 Avenue de l\\\'Éducation, Algérie\',
';
        $buffer .= $indent . '            f_subscribe:\'Newsletter\', f_name:\'Nom\', f_email:\'E-mail\', f_subscribe_btn:\'S\\\'abonner\',
';
        $buffer .= $indent . '            g_title:\'Abonnez-vous pour les mises à jour\', g_ph:\'Entrez votre adresse e-mail *\', g_btn:\'S\\\'inscrire\',
';
        $buffer .= $indent . '            g_copy:\'Istikama © Copyright 2026 — Tous droits réservés\'
';
        $buffer .= $indent . '        },
';
        $buffer .= $indent . '        ar: {
';
        $buffer .= $indent . '            follow:\'تابعونا:\', prayer:\'مواقيت الصلاة\', enroll:\'سجّل الآن\',
';
        $buffer .= $indent . '            join_eyebrow:\'ابدأ اليوم\', join_title:\'هل أنت مستعدّ لإطلاق <span class="accent">إمكانات</span> طفلك؟\', join_p:\'انضمّ إلى الاستقامة اليوم — امنح أبناءك نخبة المعلّمين، ومنهجًا أصيلًا، ومنصة ذكية تكبر معهم.\', join_cta1:\'سجّل الآن\', join_cta2:\'اعرف المزيد\',
';
        $buffer .= $indent . '            brand_name:\'الاستقامة\', brand_sub:\'جمعية العلوم القرآنية\',
';
        $buffer .= $indent . '            nav_home:\'الرئيسية\', nav_platform:\'المنصة\', nav_method:\'منهجنا\', nav_teachers:\'المعلمون\', nav_news:\'الأخبار\', nav_contact:\'اتصل بنا\',
';
        $buffer .= $indent . '            login:\'دخول\', login_student:\'دخول التلميذ\',
';
        $buffer .= $indent . '            hero_h1:\'حيث يصنع <span class="accent">العلمُ</span><br>مستقبلَ أبنائنا\',
';
        $buffer .= $indent . '            hero_p:\'منصة ذكية تجمع أفضل مدارس العلوم القرآنية ونخبة المعلمين، لنقود أبناءكم نحو التميّز في الإيمان والعلم والأخلاق.\',
';
        $buffer .= $indent . '            hero_cta:\'اكتشف المنصة\',
';
        $buffer .= $indent . '            about_eyebrow:\'من نحن\', about_title:\'عن منصة الاستقامة\',
';
        $buffer .= $indent . '            about_p1:\'الاستقامة منصة رقمية موحَّدة تجمع كل مدارس العلوم القرآنية في نظام ذكي واحد، يمزج بين التعليم الإسلامي الأصيل وأحدث التقنيات. من التجويد والحفظ إلى التفسير والفقه، يتعلّم كل تلميذ وفق منهجٍ منظَّم يناسب سنّه ومستواه.\',
';
        $buffer .= $indent . '            about_p2:\'معلّمونا المتفانون، ومكتبتنا الرقمية الحديثة، ودروسنا التفاعلية، ومتابعة الأداء لحظةً بلحظة، تمنح الأولياء رؤيةً كاملة — ليحظى كل طفل بالرعاية التي تجعله بطل الغد.\',
';
        $buffer .= $indent . '            about_cta:\'استكشف المزايا\',
';
        $buffer .= $indent . '            eco_eyebrow:\'لماذا الاستقامة\', eco_title:\'منظومة تعليمية متكاملة\',
';
        $buffer .= $indent . '            eco_tag1:\'مكتبة رقمية\', eco_tag2:\'اختبارات ذكية\', eco_tag3:\'متابعة مباشرة\', eco_tag4:\'بوابة الأولياء\',
';
        $buffer .= $indent . '            eco_b1:\'مكتبة رقمية غنية من الدروس والفيديوهات وملفات PDF، منظَّمة حسب المستوى والمادة والدرس.\',
';
        $buffer .= $indent . '            eco_b2:\'واجبات تفاعلية واختبارات تُصحَّح آليًا تجعل التعلّم ممتعًا.\',
';
        $buffer .= $indent . '            eco_b3:\'يتابع الأولياء الحضور والنتائج والتقدّم لحظيًا، من أي مكان.\',
';
        $buffer .= $indent . '            eco_cta:\'ابدأ الآن\',
';
        $buffer .= $indent . '            feat_eyebrow:\'ما الذي نقدّمه\', feat_title:\'كل شيء في منصة واحدة\',
';
        $buffer .= $indent . '            feat_c1:\'المكتبة الرقمية\', feat_c2:\'دروس تفاعلية\', feat_c3:\'اختبارات وواجبات\', feat_c4:\'التقارير والمتابعة\',
';
        $buffer .= $indent . '            method_eyebrow:\'منهجنا\', method_title:\'منهج الاستقامة\',
';
        $buffer .= $indent . '            method_1:\'الحفظ\', method_1s:\'(التحفيظ)\', method_2:\'التلاوة\', method_2s:\'(التجويد)\',
';
        $buffer .= $indent . '            method_3:\'الفهم\', method_3s:\'(التفسير)\', method_4:\'الأخلاق\', method_4s:\'(السلوك)\',
';
        $buffer .= $indent . '            method_5:\'الإتقان\', method_5s:\'(الاستقامة)\',
';
        $buffer .= $indent . '            prog_eyebrow:\'استكشف\', prog_title:\'برامجنا\',
';
        $buffer .= $indent . '            prog_intro:\'مسارات تعليمية منظَّمة لكل سنٍّ ومستوى — يؤطّرها معلّمون أكفاء وتدعمها منصة رقمية ذكية.\',
';
        $buffer .= $indent . '            prog1_t:\'برنامج القرآن الابتدائي\', prog1_age:\'٦ – ١٠ سنوات\', prog1_teacher:\'الشيخ بلال\', prog1_x:\'أسس القراءة والتجويد وقصار السور عبر دروس تفاعلية ممتعة.\',
';
        $buffer .= $indent . '            prog2_t:\'مسار التحفيظ\', prog2_age:\'١٠ – ١٥ سنة\', prog2_teacher:\'الشيخ علي\', prog2_x:\'رحلة حفظٍ موجَّهة مع أدوات للمراجعة وتلاوة صوتية وتتبّع للمراحل.\',
';
        $buffer .= $indent . '            prog3_t:\'العلوم الشرعية\', prog3_age:\'١٣ سنة فأكثر\', prog3_teacher:\'الشيخ ناصر\', prog3_x:\'تفسير وحديث وفقه يُدرَّس بعمق ونقاش وموارد حديثة.\',
';
        $buffer .= $indent . '            prog_enrolled:\'المسجّلون\', prog_seats:\'المقاعد\',
';
        $buffer .= $indent . '            news_eyebrow:\'الأخبار والفعاليات\', news_title:\'آخر الأخبار والفعاليات\',
';
        $buffer .= $indent . '            post1_t:\'عام دراسي جديد، آفاق جديدة\', post1_date:\'١ سبتمبر ٢٠٢٥\', post1_x:\'اكتشف جديد المنصة هذا العام — مكتبات أغنى وأدوات أذكى للأولياء والمزيد…\',
';
        $buffer .= $indent . '            post2_t:\'كيف ترتقي التقنية بتعلّم القرآن\', post2_date:\'١٨ أوت ٢٠٢٥\', post2_x:\'التلاوة الصوتية والتغذية الراجعة الفورية ومؤشرات التقدّم تُحوِّل القسم…\',
';
        $buffer .= $indent . '            post_author:\'فريق الاستقامة\', read_more:\'اقرأ المزيد ←\',
';
        $buffer .= $indent . '            mon_nov:\'نوف\', mon_dec:\'ديس\', ev_details:\'تفاصيل الفعالية ←\', ev_loc_campus:\'المقر الرئيسي\', ev_loc_online:\'عن بُعد\',
';
        $buffer .= $indent . '            ev1_t:\'يوم مفتوح وجولة في المدرسة\', ev2_t:\'مسابقة في تلاوة القرآن\', ev3_t:\'لقاء الأولياء والمعلمين\',
';
        $buffer .= $indent . '            team_eyebrow:\'تعرّف على الفريق\', team_title:\'نخبة معلّمينا\',
';
        $buffer .= $indent . '            t1_name:\'الشيخ بلال حاتم\', t1_role:\'المؤسّس والمعلّم الرئيسي\',
';
        $buffer .= $indent . '            t2_name:\'الشيخ علي همّام\', t2_role:\'مختصّ في التحفيظ\',
';
        $buffer .= $indent . '            t3_name:\'الأستاذة نصيرة شيخ\', t3_role:\'معلّمة المراحل الأولى\',
';
        $buffer .= $indent . '            f_about:\'من نحن\', f_about_p:\'الاستقامة تجمع أفضل المدارس والمعلّمين في منصة ذكية واحدة — لتساعد كل طفل على التعلّم والنموّ والتفوّق عبر تعليمٍ أصيل وتقنيات حديثة.\',
';
        $buffer .= $indent . '            f_loc:\'مؤسسة الاستقامة — المقر الرئيسي\',
';
        $buffer .= $indent . '            f_news:\'آخر الأخبار\', f_news1:\'عام دراسي جديد، آفاق جديدة\', f_news2:\'التقنية وتعلّم القرآن\', f_news3:\'دليل الأولياء لاستخدام المنصة\', f_news3_date:\'٦ أوت ٢٠٢٥\',
';
        $buffer .= $indent . '            f_contact:\'معلومات التواصل\', f_addr:\'19 شارع التعليم، الجزائر\',
';
        $buffer .= $indent . '            f_subscribe:\'النشرة البريدية\', f_name:\'الاسم\', f_email:\'البريد الإلكتروني\', f_subscribe_btn:\'اشترك\',
';
        $buffer .= $indent . '            g_title:\'اشترك لتصلك التحديثات أسبوعيًا\', g_ph:\'أدخل بريدك الإلكتروني *\', g_btn:\'اشترك الآن\',
';
        $buffer .= $indent . '            g_copy:\'الاستقامة © جميع الحقوق محفوظة ٢٠٢٦\'
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '    };
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    var lp = document.getElementById(\'landing-page\');
';
        $buffer .= $indent . '    function applyLang(lang) {
';
        $buffer .= $indent . '        var dict = I18N[lang] || I18N.en;
';
        $buffer .= $indent . '        lp.querySelectorAll(\'[data-i18n]\').forEach(function (el) {
';
        $buffer .= $indent . '            var k = el.getAttribute(\'data-i18n\'); if (dict[k] != null) el.textContent = dict[k];
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '        lp.querySelectorAll(\'[data-i18n-html]\').forEach(function (el) {
';
        $buffer .= $indent . '            var k = el.getAttribute(\'data-i18n-html\'); if (dict[k] != null) el.innerHTML = dict[k];
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '        lp.querySelectorAll(\'[data-i18n-ph]\').forEach(function (el) {
';
        $buffer .= $indent . '            var k = el.getAttribute(\'data-i18n-ph\'); if (dict[k] != null) el.setAttribute(\'placeholder\', dict[k]);
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '        lp.setAttribute(\'lang\', lang);
';
        $buffer .= $indent . '        lp.setAttribute(\'dir\', lang === \'ar\' ? \'rtl\' : \'ltr\');
';
        $buffer .= $indent . '        lp.classList.toggle(\'ld-rtl\', lang === \'ar\');
';
        $buffer .= $indent . '        var labels = { en: \'EN\', fr: \'FR\', ar: \'العربية\' };
';
        $buffer .= $indent . '        document.querySelectorAll(\'#landing-page .ld-lang-label\').forEach(function (el) { el.textContent = labels[lang] || \'EN\'; });
';
        $buffer .= $indent . '        document.querySelectorAll(\'#landing-page .ld-lang-menu [data-lang]\').forEach(function (b) {
';
        $buffer .= $indent . '            b.classList.toggle(\'on\', b.getAttribute(\'data-lang\') === lang);
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '        try { localStorage.setItem(\'isti-landing-lang\', lang); } catch (e) {}
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '    // Dropdown open/close + selection
';
        $buffer .= $indent . '    document.querySelectorAll(\'#landing-page .ld-lang\').forEach(function (box) {
';
        $buffer .= $indent . '        var toggle = box.querySelector(\'.ld-lang-toggle\');
';
        $buffer .= $indent . '        if (toggle) toggle.addEventListener(\'click\', function (e) {
';
        $buffer .= $indent . '            e.stopPropagation();
';
        $buffer .= $indent . '            var willOpen = !box.classList.contains(\'open\');
';
        $buffer .= $indent . '            document.querySelectorAll(\'#landing-page .ld-lang.open\').forEach(function (o) { o.classList.remove(\'open\'); });
';
        $buffer .= $indent . '            box.classList.toggle(\'open\', willOpen);
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '        box.querySelectorAll(\'.ld-lang-menu [data-lang]\').forEach(function (btn) {
';
        $buffer .= $indent . '            btn.addEventListener(\'click\', function () { applyLang(btn.getAttribute(\'data-lang\')); box.classList.remove(\'open\'); });
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '    document.addEventListener(\'click\', function () {
';
        $buffer .= $indent . '        document.querySelectorAll(\'#landing-page .ld-lang.open\').forEach(function (o) { o.classList.remove(\'open\'); });
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '    var saved = \'en\';
';
        $buffer .= $indent . '    try { saved = localStorage.getItem(\'isti-landing-lang\') || \'en\'; } catch (e) {}
';
        $buffer .= $indent . '    if (saved !== \'en\') applyLang(saved);
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Sticky nav shadow ──
';
        $buffer .= $indent . '    var nav = document.getElementById(\'ldNav\');
';
        $buffer .= $indent . '    var totop = document.getElementById(\'ldTotop\');
';
        $buffer .= $indent . '    function onScroll() {
';
        $buffer .= $indent . '        var y = window.pageYOffset || document.documentElement.scrollTop;
';
        $buffer .= $indent . '        if (nav) nav.classList.toggle(\'scrolled\', y > 30);
';
        $buffer .= $indent . '        if (totop) totop.classList.toggle(\'show\', y > 600);
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '    window.addEventListener(\'scroll\', onScroll, { passive: true });
';
        $buffer .= $indent . '    onScroll();
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Mobile menu ──
';
        $buffer .= $indent . '    var burger = document.getElementById(\'ldHamburger\');
';
        $buffer .= $indent . '    var mobile = document.getElementById(\'ldMobile\');
';
        $buffer .= $indent . '    if (burger && mobile) {
';
        $buffer .= $indent . '        burger.addEventListener(\'click\', function () {
';
        $buffer .= $indent . '            var open = mobile.classList.toggle(\'open\');
';
        $buffer .= $indent . '            burger.innerHTML = open ? \'<i class="fa-solid fa-xmark"></i>\' : \'<i class="fa-solid fa-bars"></i>\';
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '        mobile.querySelectorAll(\'a\').forEach(function (a) {
';
        $buffer .= $indent . '            a.addEventListener(\'click\', function () {
';
        $buffer .= $indent . '                mobile.classList.remove(\'open\');
';
        $buffer .= $indent . '                burger.innerHTML = \'<i class="fa-solid fa-bars"></i>\';
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Smooth in-page anchor scroll ──
';
        $buffer .= $indent . '    document.querySelectorAll(\'#landing-page a[href^="#"]\').forEach(function (a) {
';
        $buffer .= $indent . '        a.addEventListener(\'click\', function (e) {
';
        $buffer .= $indent . '            var id = a.getAttribute(\'href\');
';
        $buffer .= $indent . '            if (id.length < 2) return;
';
        $buffer .= $indent . '            var t = document.querySelector(id);
';
        $buffer .= $indent . '            if (!t) return;
';
        $buffer .= $indent . '            e.preventDefault();
';
        $buffer .= $indent . '            var top = t.getBoundingClientRect().top + window.pageYOffset - 70;
';
        $buffer .= $indent . '            window.scrollTo({ top: top, behavior: \'smooth\' });
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Back to top ──
';
        $buffer .= $indent . '    if (totop) totop.addEventListener(\'click\', function () { window.scrollTo({ top: 0, behavior: \'smooth\' }); });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Feature-tag selector (visual) ──
';
        $buffer .= $indent . '    var amounts = document.getElementById(\'ldAmounts\');
';
        $buffer .= $indent . '    if (amounts) amounts.addEventListener(\'click\', function (e) {
';
        $buffer .= $indent . '        var b = e.target.closest(\'.ld-amount\');
';
        $buffer .= $indent . '        if (!b) return;
';
        $buffer .= $indent . '        amounts.querySelectorAll(\'.ld-amount\').forEach(function (x) { x.classList.remove(\'active\'); });
';
        $buffer .= $indent . '        b.classList.add(\'active\');
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Scroll-reveal via IntersectionObserver (with hard safety net) ──
';
        $buffer .= $indent . '    var revealEls = document.querySelectorAll(\'#landing-page [data-reveal]\');
';
        $buffer .= $indent . '    function reveal(el) {
';
        $buffer .= $indent . '        if (el.classList.contains(\'in\')) return;
';
        $buffer .= $indent . '        el.classList.add(\'in\');
';
        $buffer .= $indent . '        el.querySelectorAll(\'.ld-progress .fill\').forEach(function (f) {
';
        $buffer .= $indent . '            var p = f.getAttribute(\'data-pct\') || 0;
';
        $buffer .= $indent . '            requestAnimationFrame(function () { f.style.width = p + \'%\'; });
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '    if (\'IntersectionObserver\' in window) {
';
        $buffer .= $indent . '        var io = new IntersectionObserver(function (entries) {
';
        $buffer .= $indent . '            entries.forEach(function (en) {
';
        $buffer .= $indent . '                if (en.isIntersecting) { reveal(en.target); io.unobserve(en.target); }
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        }, { threshold: 0.08, rootMargin: \'0px 0px -6% 0px\' });
';
        $buffer .= $indent . '        revealEls.forEach(function (el) { io.observe(el); });
';
        $buffer .= $indent . '        requestAnimationFrame(function () {
';
        $buffer .= $indent . '            revealEls.forEach(function (el) {
';
        $buffer .= $indent . '                var r = el.getBoundingClientRect();
';
        $buffer .= $indent . '                if (r.top < window.innerHeight && r.bottom > 0) reveal(el);
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '        setTimeout(function () {
';
        $buffer .= $indent . '            revealEls.forEach(function (el) {
';
        $buffer .= $indent . '                var r = el.getBoundingClientRect();
';
        $buffer .= $indent . '                if (r.top < window.innerHeight * 1.5) reveal(el);
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        }, 1200);
';
        $buffer .= $indent . '        setTimeout(function () { revealEls.forEach(reveal); }, 3000);
';
        $buffer .= $indent . '        var passTick = false;
';
        $buffer .= $indent . '        window.addEventListener(\'scroll\', function () {
';
        $buffer .= $indent . '            if (passTick) return; passTick = true;
';
        $buffer .= $indent . '            requestAnimationFrame(function () {
';
        $buffer .= $indent . '                passTick = false;
';
        $buffer .= $indent . '                revealEls.forEach(function (el) {
';
        $buffer .= $indent . '                    if (el.classList.contains(\'in\')) return;
';
        $buffer .= $indent . '                    var r = el.getBoundingClientRect();
';
        $buffer .= $indent . '                    if (r.top < window.innerHeight * 0.95) reveal(el);
';
        $buffer .= $indent . '                });
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        }, { passive: true });
';
        $buffer .= $indent . '    } else {
';
        $buffer .= $indent . '        revealEls.forEach(reveal);
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '})();
';
        $buffer .= $indent . '</script>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '</body>
';
        $buffer .= $indent . '</html>
';
        $value = $context->find('js');
        $buffer .= $this->section8f64be98d371bcb5b5c40cc9fcb53da3($context, $indent, $value);

        return $buffer;
    }

    private function section3c9bdb65f9d666332f20274fd3df86b4(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                    <img class="ld-logo-img" src="{{output.get_compact_logo_url}}" alt="Istikama">
                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                    <img class="ld-logo-img" src="';
                $value = $this->resolveValue($context->findDot('output.get_compact_logo_url'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" alt="Istikama">
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section8f64be98d371bcb5b5c40cc9fcb53da3(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
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
