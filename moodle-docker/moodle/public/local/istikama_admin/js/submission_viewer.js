/**
 * Istikama submission viewer — reusable modal for previewing student submission
 * files (PDF, images, Office docs, video, audio, text) without forced download.
 *
 * Usage from any page that includes this script:
 *
 *   IstikamaSubmissionViewer.open([
 *     { name: 'essay.pdf',  url: '/pluginfile.php/.../essay.pdf',  ext: 'pdf' },
 *     { name: 'photo.jpg',  url: '/pluginfile.php/.../photo.jpg',  ext: 'jpg' },
 *   ], { startIndex: 0, title: 'Mohamed Benchahla — Submission' });
 *
 * The viewer detects file type from `ext` (or falls back to URL extension) and
 * picks the right preview strategy:
 *   - PDF                → <iframe>
 *   - image              → <img> (with zoom controls)
 *   - video              → <video controls>
 *   - audio              → <audio controls>
 *   - txt / md / csv     → fetched + rendered as <pre>
 *   - office (doc/xls…)  → Office Online embed if HTTPS, otherwise download CTA
 *   - everything else    → download CTA
 *
 * No external dependencies. Safe to load on any page.
 */
(function () {
    'use strict';

    if (window.IstikamaSubmissionViewer) {
        return; // already initialized
    }

    var IMG_EXT   = ['jpg', 'jpeg', 'png', 'gif', 'svg', 'bmp', 'webp'];
    var VIDEO_EXT = ['mp4', 'webm', 'ogg', 'mov'];
    var AUDIO_EXT = ['mp3', 'wav', 'ogg', 'aac', 'flac', 'm4a'];
    var TEXT_EXT  = ['txt', 'md', 'csv', 'log', 'json', 'xml', 'html', 'js', 'css', 'php', 'py'];
    var OFFICE_EXT = ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'odt', 'ods', 'odp'];

    function detectKind(ext) {
        ext = (ext || '').toLowerCase().replace(/^\./, '');
        if (ext === 'pdf') return 'pdf';
        if (IMG_EXT.indexOf(ext) !== -1) return 'image';
        if (VIDEO_EXT.indexOf(ext) !== -1) return 'video';
        if (AUDIO_EXT.indexOf(ext) !== -1) return 'audio';
        if (TEXT_EXT.indexOf(ext) !== -1) return 'text';
        if (OFFICE_EXT.indexOf(ext) !== -1) return 'office';
        return 'other';
    }

    function extFromName(name) {
        var m = (name || '').toLowerCase().match(/\.([a-z0-9]+)$/);
        return m ? m[1] : '';
    }

    function iconFor(kind, ext) {
        if (kind === 'pdf')   return { icon: 'fa-file-pdf',         color: '#ef4444' };
        if (kind === 'image') return { icon: 'fa-image',            color: '#06b6d4' };
        if (kind === 'video') return { icon: 'fa-file-video',       color: '#a855f7' };
        if (kind === 'audio') return { icon: 'fa-file-audio',       color: '#f59e0b' };
        if (kind === 'text')  return { icon: 'fa-file-alt',         color: '#64748b' };
        if (ext === 'doc' || ext === 'docx' || ext === 'odt' || ext === 'rtf') return { icon: 'fa-file-word',       color: '#3b82f6' };
        if (ext === 'xls' || ext === 'xlsx' || ext === 'ods')                   return { icon: 'fa-file-excel',      color: '#10b981' };
        if (ext === 'ppt' || ext === 'pptx' || ext === 'odp')                   return { icon: 'fa-file-powerpoint', color: '#f59e0b' };
        if (ext === 'zip' || ext === 'rar' || ext === '7z' || ext === 'tar' || ext === 'gz') return { icon: 'fa-file-archive', color: '#94a3b8' };
        return { icon: 'fa-file', color: '#64748b' };
    }

    function el(tag, attrs, content) {
        var e = document.createElement(tag);
        if (attrs) {
            Object.keys(attrs).forEach(function (k) {
                if (k === 'class') { e.className = attrs[k]; }
                else if (k === 'style' && typeof attrs[k] === 'object') {
                    Object.assign(e.style, attrs[k]);
                } else if (k.indexOf('on') === 0) {
                    e.addEventListener(k.substring(2), attrs[k]);
                } else {
                    e.setAttribute(k, attrs[k]);
                }
            });
        }
        if (content !== undefined) {
            if (Array.isArray(content)) {
                content.forEach(function (c) {
                    if (typeof c === 'string') { e.appendChild(document.createTextNode(c)); }
                    else if (c) { e.appendChild(c); }
                });
            } else if (typeof content === 'string') {
                e.innerHTML = content;
            } else if (content) {
                e.appendChild(content);
            }
        }
        return e;
    }

    function buildShell() {
        var backdrop = el('div', {
            class: 'isti-sv-backdrop',
            role: 'dialog',
            'aria-modal': 'true',
        });
        var dialog = el('div', { class: 'isti-sv-dialog' });

        var header = el('div', { class: 'isti-sv-header' });
        var titleWrap = el('div', { class: 'isti-sv-title-wrap' });
        var icon = el('span', { class: 'isti-sv-fileicon' }, '<i class="fa fa-file"></i>');
        var title = el('div', { class: 'isti-sv-title' }, [
            el('strong', { class: 'isti-sv-name' }, 'Submission'),
            el('span',   { class: 'isti-sv-meta' }, ''),
        ]);
        titleWrap.appendChild(icon);
        titleWrap.appendChild(title);

        var actions = el('div', { class: 'isti-sv-actions' });
        var download = el('a', {
            class: 'isti-sv-action',
            target: '_blank',
            rel: 'noopener',
            title: 'Download',
        }, '<i class="fa fa-download"></i>');
        var closeBtn = el('button', {
            class: 'isti-sv-close',
            type: 'button',
            'aria-label': 'Close',
        }, '<i class="fa fa-times"></i>');
        actions.appendChild(download);
        actions.appendChild(closeBtn);

        header.appendChild(titleWrap);
        header.appendChild(actions);

        var body = el('div', { class: 'isti-sv-body' });
        var nav = el('div', { class: 'isti-sv-nav' });
        var stage = el('div', { class: 'isti-sv-stage' });
        body.appendChild(nav);
        body.appendChild(stage);

        var footer = el('div', { class: 'isti-sv-footer' });

        dialog.appendChild(header);
        dialog.appendChild(body);
        dialog.appendChild(footer);
        backdrop.appendChild(dialog);
        return {
            backdrop: backdrop,
            dialog: dialog,
            icon: icon,
            name: title.querySelector('.isti-sv-name'),
            meta: title.querySelector('.isti-sv-meta'),
            download: download,
            closeBtn: closeBtn,
            nav: nav,
            stage: stage,
            footer: footer,
        };
    }

    function renderFile(stage, file) {
        stage.innerHTML = '';
        var kind = file.kind || detectKind(file.ext || extFromName(file.name));
        var ext = (file.ext || extFromName(file.name)).toLowerCase();

        if (kind === 'pdf') {
            var iframe = el('iframe', {
                src: file.url + '#toolbar=1&view=FitH',
                class: 'isti-sv-iframe',
                title: file.name || 'PDF',
            });
            stage.appendChild(iframe);
            return;
        }
        if (kind === 'image') {
            var imgWrap = el('div', { class: 'isti-sv-imgwrap' });
            var img = el('img', {
                src: file.url,
                alt: file.name || 'Image',
                class: 'isti-sv-img',
            });
            var ctrls = el('div', { class: 'isti-sv-imgctrls' });
            var zoomLevel = 1;
            function applyZoom() { img.style.transform = 'scale(' + zoomLevel + ')'; }
            ctrls.appendChild(el('button', {
                type: 'button', class: 'isti-sv-iconbtn', title: 'Zoom in',
                onclick: function () { zoomLevel = Math.min(zoomLevel * 1.2, 6); applyZoom(); },
            }, '<i class="fa fa-search-plus"></i>'));
            ctrls.appendChild(el('button', {
                type: 'button', class: 'isti-sv-iconbtn', title: 'Zoom out',
                onclick: function () { zoomLevel = Math.max(zoomLevel / 1.2, 0.2); applyZoom(); },
            }, '<i class="fa fa-search-minus"></i>'));
            ctrls.appendChild(el('button', {
                type: 'button', class: 'isti-sv-iconbtn', title: 'Reset',
                onclick: function () { zoomLevel = 1; applyZoom(); },
            }, '<i class="fa fa-undo"></i>'));
            imgWrap.appendChild(img);
            imgWrap.appendChild(ctrls);
            stage.appendChild(imgWrap);
            return;
        }
        if (kind === 'video') {
            stage.appendChild(el('video', {
                src: file.url, controls: 'controls', class: 'isti-sv-video',
            }));
            return;
        }
        if (kind === 'audio') {
            var audWrap = el('div', { class: 'isti-sv-audiowrap' });
            audWrap.appendChild(el('i', { class: 'fa fa-music isti-sv-audio-icon' }));
            audWrap.appendChild(el('div', { class: 'isti-sv-audio-name' }, file.name || ''));
            audWrap.appendChild(el('audio', {
                src: file.url, controls: 'controls', class: 'isti-sv-audio',
            }));
            stage.appendChild(audWrap);
            return;
        }
        if (kind === 'text') {
            var pre = el('pre', { class: 'isti-sv-text' }, 'Loading…');
            stage.appendChild(pre);
            fetch(file.url, { credentials: 'same-origin' })
                .then(function (r) { return r.text(); })
                .then(function (t) { pre.textContent = t; })
                .catch(function () { pre.textContent = '(Could not load text content. Try the Download button.)'; });
            return;
        }
        if (kind === 'office') {
            // Try Office Online viewer — works for HTTPS-accessible public files.
            // Falls back to download CTA below if location.protocol is http.
            if (window.location.protocol === 'https:') {
                var encoded = encodeURIComponent(file.url);
                stage.appendChild(el('iframe', {
                    src: 'https://view.officeapps.live.com/op/embed.aspx?src=' + encoded,
                    class: 'isti-sv-iframe',
                    title: file.name || 'Document',
                }));
                return;
            }
        }
        // Fallback: download CTA.
        var unknown = el('div', { class: 'isti-sv-unsupported' });
        var ic = iconFor(kind, ext);
        unknown.innerHTML =
            '<div class="isti-sv-unsupported-icon" style="color:' + ic.color + '"><i class="fa ' + ic.icon + '"></i></div>' +
            '<div class="isti-sv-unsupported-title">' + (file.name || 'File') + '</div>' +
            '<div class="isti-sv-unsupported-msg">Preview is not available for this file type in the browser.</div>' +
            '<a class="isti-sv-unsupported-btn" href="' + file.url + '" target="_blank" rel="noopener" download>' +
            '<i class="fa fa-download"></i> Download to view' +
            '</a>';
        stage.appendChild(unknown);
    }

    function buildNav(nav, files, currentIdx, onPick) {
        nav.innerHTML = '';
        if (!files || files.length < 2) {
            nav.style.display = 'none';
            return;
        }
        nav.style.display = '';
        files.forEach(function (f, idx) {
            var kind = f.kind || detectKind(f.ext || extFromName(f.name));
            var ic = iconFor(kind, (f.ext || extFromName(f.name)).toLowerCase());
            var item = el('button', {
                type: 'button',
                class: 'isti-sv-navitem' + (idx === currentIdx ? ' active' : ''),
                title: f.name || '',
                onclick: function () { onPick(idx); },
            });
            item.appendChild(el('span', {
                class: 'isti-sv-navitem-icon',
                style: 'color:' + ic.color,
            }, '<i class="fa ' + ic.icon + '"></i>'));
            item.appendChild(el('span', { class: 'isti-sv-navitem-name' }, f.name || ''));
            nav.appendChild(item);
        });
    }

    var state = { shell: null, files: [], idx: 0, opts: {} };

    function ensureShell() {
        if (state.shell) return state.shell;
        state.shell = buildShell();
        document.body.appendChild(state.shell.backdrop);
        state.shell.backdrop.addEventListener('click', function (e) {
            if (e.target === state.shell.backdrop) { close(); }
        });
        state.shell.closeBtn.addEventListener('click', close);
        document.addEventListener('keydown', onKey);
        return state.shell;
    }

    function onKey(e) {
        if (!state.shell || !state.shell.backdrop.classList.contains('open')) return;
        if (e.key === 'Escape') { close(); }
        else if (e.key === 'ArrowRight') { goTo(state.idx + 1); }
        else if (e.key === 'ArrowLeft')  { goTo(state.idx - 1); }
    }

    function goTo(idx) {
        if (!state.files.length) return;
        if (idx < 0) idx = 0;
        if (idx >= state.files.length) idx = state.files.length - 1;
        state.idx = idx;
        var f = state.files[idx];
        var ext = (f.ext || extFromName(f.name)).toLowerCase();
        var kind = f.kind || detectKind(ext);
        var ic = iconFor(kind, ext);
        var shell = state.shell;
        shell.icon.style.background = ic.color + '20';
        shell.icon.style.color = ic.color;
        shell.icon.innerHTML = '<i class="fa ' + ic.icon + '"></i>';
        shell.name.textContent = f.name || 'Submission';
        var metaBits = [];
        if (ext) metaBits.push(ext.toUpperCase());
        if (f.size) metaBits.push(f.size);
        if (f.uploaded) metaBits.push(f.uploaded);
        shell.meta.textContent = metaBits.join(' · ');
        shell.download.setAttribute('href', f.url);
        shell.download.setAttribute('download', f.name || '');
        buildNav(shell.nav, state.files, idx, goTo);
        renderFile(shell.stage, f);
    }

    function open(files, opts) {
        opts = opts || {};
        if (!Array.isArray(files)) { files = [files]; }
        if (!files.length) return;
        state.files = files;
        state.opts = opts;
        ensureShell();
        state.shell.backdrop.classList.add('open');
        document.body.classList.add('isti-sv-open');
        goTo(opts.startIndex || 0);
    }

    function close() {
        if (!state.shell) return;
        state.shell.backdrop.classList.remove('open');
        document.body.classList.remove('isti-sv-open');
        // Stop any playing media.
        var m = state.shell.stage.querySelector('video, audio');
        if (m) { try { m.pause(); } catch (e) {} }
    }

    window.IstikamaSubmissionViewer = {
        open: open,
        close: close,
        detectKind: detectKind,
        iconFor: iconFor,
    };
})();
