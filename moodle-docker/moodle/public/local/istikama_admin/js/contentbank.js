/* Library / Content-Bank — in-page preview & moderation modal. */
(function () {
    'use strict';

    function el(id) { return document.getElementById(id); }
    function $all(sel, root) { return (root || document).querySelectorAll(sel); }
    function escHtml(s) {
        return String(s == null ? '' : s)
            .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }

    // ── Config from the hidden data div ───────────────────────────────────────
    var dataEl = el('isti-cb-data');
    var cfg = {
        ajaxUrl: dataEl ? dataEl.getAttribute('data-ajax-url') : '',
        sesskey: dataEl ? dataEl.getAttribute('data-sesskey') : '',
        strings: {
            saving:        dataEl ? dataEl.getAttribute('data-str-saving')        : 'Saving…',
            saved:         dataEl ? dataEl.getAttribute('data-str-saved')         : 'Saved.',
            errorPrefix:   dataEl ? dataEl.getAttribute('data-str-error-prefix')  : 'Error: ',
            noPreview:     dataEl ? dataEl.getAttribute('data-str-no-preview')    : 'No preview available.',
            download:      dataEl ? dataEl.getAttribute('data-str-download')      : 'Download',
            openExternal:  dataEl ? dataEl.getAttribute('data-str-open-external') : 'Open in new tab',
        },
    };

    // ── Modal helpers ─────────────────────────────────────────────────────────
    function openModal() {
        var m = el('isti-cb-modal');
        if (!m) return;
        m.style.display = 'flex';
        m.style.opacity = '1';
        document.body.style.overflow = 'hidden';
    }
    function closeModal() {
        var m = el('isti-cb-modal');
        if (m) { m.style.display = 'none'; m.style.opacity = ''; }
        document.body.style.overflow = '';
        // Stop any embedded media to avoid background playback.
        var viewer = el('isti-cb-modal-viewer');
        if (viewer) { viewer.innerHTML = ''; }
    }

    document.addEventListener('click', function (e) {
        if (!e || !e.target) return;
        var t = e.target;
        if (t.classList && t.classList.contains('isti-cb-modal-overlay')) { closeModal(); return; }
        if (t.closest && t.closest('[data-cb-close]'))                   { closeModal(); return; }
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { closeModal(); }
    });

    // ── Open the modal in response to a "preview" button click ───────────────
    document.addEventListener('click', function (e) {
        if (!e || !e.target) return;
        var btn = e.target.closest ? e.target.closest('.isti-cb-preview-btn') : null;
        if (!btn) return;
        e.preventDefault();
        var id = btn.getAttribute('data-id');
        if (!id) return;
        openModal();
        loadDetails(parseInt(id, 10));
    });

    function setStatusMsg(text, kind) {
        var s = el('isti-cb-modal-msg');
        if (!s) return;
        s.textContent = text || '';
        s.style.color = (kind === 'error') ? '#dc2626' : (kind === 'ok' ? '#059669' : '#64748b');
    }

    // ── Render the preview area (left side of the modal) ─────────────────────
    function renderPreview(preview, name) {
        var v = el('isti-cb-modal-viewer');
        if (!v) return;
        v.innerHTML = '';

        if (!preview || preview.type === 'none') {
            v.innerHTML = '<div style="display:flex;align-items:center;justify-content:center;height:100%;color:#94a3b8;flex-direction:column;gap:10px;">'
                + '<i class="fa fa-cube" style="font-size:3rem;color:#cbd5e1;"></i>'
                + '<div>' + escHtml(cfg.strings.noPreview) + '</div>'
                + '</div>';
            return;
        }

        var url = preview.url || '';
        switch (preview.type) {
            case 'youtube':
                v.innerHTML =
                    '<div style="position:relative;width:100%;height:100%;background:#000;">' +
                    '<iframe src="' + escHtml(url) + '" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ' +
                    'style="position:absolute;inset:0;width:100%;height:100%;border:0;"></iframe></div>';
                break;
            case 'pdf':
                v.innerHTML =
                    '<iframe src="' + escHtml(url) + '" style="width:100%;height:100%;border:0;background:#525659;" ' +
                    'title="' + escHtml(name || preview.filename || '') + '"></iframe>';
                break;
            case 'video':
                v.innerHTML =
                    '<video controls preload="metadata" style="width:100%;height:100%;background:#000;display:block;">' +
                    '<source src="' + escHtml(url) + '"' + (preview.mime ? ' type="' + escHtml(preview.mime) + '"' : '') + '></video>';
                break;
            case 'audio':
                v.innerHTML =
                    '<div style="display:flex;align-items:center;justify-content:center;height:100%;background:#0f172a;color:#fff;flex-direction:column;gap:20px;">' +
                    '<i class="fa fa-music" style="font-size:4rem;opacity:.6;"></i>' +
                    '<audio controls preload="metadata" style="width:80%;max-width:480px;"><source src="' + escHtml(url) + '"></audio>' +
                    '</div>';
                break;
            case 'image':
                v.innerHTML =
                    '<div style="display:flex;align-items:center;justify-content:center;height:100%;background:#0f172a;">' +
                    '<img src="' + escHtml(url) + '" alt="' + escHtml(name || '') + '" style="max-width:100%;max-height:100%;object-fit:contain;"/>' +
                    '</div>';
                break;
            case 'link':
                v.innerHTML =
                    '<iframe src="' + escHtml(url) + '" sandbox="allow-scripts allow-same-origin allow-forms allow-popups allow-popups-to-escape-sandbox" ' +
                    'style="width:100%;height:100%;border:0;background:#fff;"></iframe>';
                break;
            case 'download':
            default:
                v.innerHTML =
                    '<div style="display:flex;align-items:center;justify-content:center;height:100%;flex-direction:column;gap:18px;color:#475569;">' +
                    '<i class="fa fa-file" style="font-size:4rem;color:#cbd5e1;"></i>' +
                    '<div style="font-weight:600;color:#1e293b;">' + escHtml(preview.filename || name || '') + '</div>' +
                    '<a href="' + escHtml(url) + '" download style="background:#006bff;color:white;padding:9px 20px;border-radius:8px;text-decoration:none;font-size:13px;font-weight:600;">' +
                    '<i class="fa fa-download"></i> ' + escHtml(cfg.strings.download) + '</a>' +
                    '</div>';
                break;
        }
    }

    // ── Render the multi-select chips for levels / subjects ──────────────────
    function renderChips(targetId, selected, available, dataAttr) {
        var box = el(targetId);
        if (!box) return;
        box.innerHTML = '';
        box.setAttribute(dataAttr, JSON.stringify(selected));

        // Show selected chips first.
        var selSet = {};
        (selected || []).forEach(function (v) { selSet[v] = true; });

        function chip(label, isSelected) {
            var c = document.createElement('button');
            c.type = 'button';
            c.textContent = label;
            c.style.cssText = 'border:0;padding:5px 12px;border-radius:14px;font-size:12px;cursor:pointer;font-weight:600;' +
                'background:' + (isSelected ? '#006bff' : '#f1f5f9') + ';' +
                'color:' + (isSelected ? '#fff' : '#475569') + ';';
            c.addEventListener('click', function () {
                var current = JSON.parse(box.getAttribute(dataAttr) || '[]');
                var idx = current.indexOf(label);
                if (idx === -1) { current.push(label); }
                else            { current.splice(idx, 1); }
                box.setAttribute(dataAttr, JSON.stringify(current));
                // Re-render to update colors.
                renderChips(targetId, current, available, dataAttr);
            });
            return c;
        }

        // Merge selected + available into a unique ordered list.
        var all = {};
        (available || []).forEach(function (v) { all[v] = true; });
        (selected  || []).forEach(function (v) { all[v] = true; });
        Object.keys(all).sort().forEach(function (v) {
            box.appendChild(chip(v, !!selSet[v]));
        });

        // Add new item input.
        var addWrap = document.createElement('span');
        addWrap.style.cssText = 'display:inline-flex;gap:4px;margin-left:6px;align-items:center;';
        var inp = document.createElement('input');
        inp.type = 'text';
        inp.placeholder = '+ add';
        inp.style.cssText = 'border:1px dashed #cbd5e1;background:#fff;padding:4px 10px;border-radius:14px;font-size:12px;width:90px;color:#475569;';
        inp.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                var v = inp.value.trim();
                if (v) {
                    var current = JSON.parse(box.getAttribute(dataAttr) || '[]');
                    if (current.indexOf(v) === -1) { current.push(v); }
                    var avail = (available || []).slice();
                    if (avail.indexOf(v) === -1) { avail.push(v); }
                    inp.value = '';
                    renderChips(targetId, current, avail, dataAttr);
                }
            }
        });
        addWrap.appendChild(inp);
        box.appendChild(addWrap);
    }

    // ── Load full details and populate the modal ─────────────────────────────
    function loadDetails(id) {
        setStatusMsg('Loading…');
        var v = el('isti-cb-modal-viewer');
        if (v) { v.innerHTML = '<div style="display:flex;align-items:center;justify-content:center;height:100%;color:#94a3b8;"><i class="fa fa-spinner fa-spin" style="font-size:2rem;"></i></div>'; }

        var fd = new FormData();
        fd.append('sesskey', cfg.sesskey);
        fd.append('action',  'get_details');
        fd.append('id',      String(id));

        fetch(cfg.ajaxUrl, { method: 'POST', body: fd, credentials: 'same-origin' })
            .then(function (r) { return r.json(); })
            .then(function (json) {
                if (!json.ok) {
                    setStatusMsg(cfg.strings.errorPrefix + (json.error || 'load failed'), 'error');
                    return;
                }
                setStatusMsg('');
                fillModal(json);
            })
            .catch(function (err) {
                setStatusMsg(cfg.strings.errorPrefix + err.message, 'error');
            });
    }

    function fillModal(d) {
        var c = d.content;
        el('isti-cb-modal-title').textContent = c.name || '';
        el('isti-cb-modal-id').value          = c.id;
        el('isti-cb-modal-name').value        = c.name || '';
        el('isti-cb-modal-desc').value        = c.description || '';
        el('isti-cb-modal-keywords').value    = c.keywords || '';
        el('isti-cb-modal-extlink').value     = c.external_url || '';
        el('isti-cb-modal-uploader').textContent = c.uploader || '—';
        el('isti-cb-modal-created').textContent  = c.created || '—';
        el('isti-cb-modal-type').textContent     = c.content_type || '—';

        // Status select.
        var ss = el('isti-cb-modal-status');
        ss.innerHTML = '';
        (d.statuses || []).forEach(function (s) {
            var o = document.createElement('option');
            o.value = s.key; o.textContent = s.label;
            if (s.key === c.status) { o.selected = true; }
            ss.appendChild(o);
        });

        // Chips.
        renderChips('isti-cb-modal-levels',   d.levels,   d.catalog ? d.catalog.levels   : [], 'data-selected');
        renderChips('isti-cb-modal-subjects', d.subjects, d.catalog ? d.catalog.subjects : [], 'data-selected');

        // History.
        var hb = el('isti-cb-modal-history');
        hb.innerHTML = '';
        (d.history || []).forEach(function (h) {
            var row = document.createElement('div');
            row.style.cssText = 'display:flex;gap:8px;font-size:12px;padding:6px 0;border-bottom:1px solid #f1f5f9;';
            row.innerHTML =
                '<div style="color:#94a3b8;width:120px;flex-shrink:0;">' + escHtml(h.when) + '</div>' +
                '<div style="flex:1;"><strong>' + escHtml(h.changed_by || '?') + '</strong> · ' +
                escHtml(h.old_status) + ' → <strong>' + escHtml(h.new_status) + '</strong>' +
                (h.notes ? '<div style="color:#64748b;margin-top:2px;">' + escHtml(h.notes) + '</div>' : '') +
                '</div>';
            hb.appendChild(row);
        });
        if (!d.history || !d.history.length) {
            hb.innerHTML = '<div style="color:#94a3b8;font-size:12px;font-style:italic;">No moderation history yet.</div>';
        }

        renderPreview(d.preview, c.name);
    }

    // ── Save handler ─────────────────────────────────────────────────────────
    var saveBtn = el('isti-cb-modal-save');
    if (saveBtn) {
        saveBtn.addEventListener('click', function () {
            var id = el('isti-cb-modal-id').value;
            if (!id) return;
            setStatusMsg(cfg.strings.saving);
            saveBtn.disabled = true;

            var levelsJson   = el('isti-cb-modal-levels').getAttribute('data-selected')   || '[]';
            var subjectsJson = el('isti-cb-modal-subjects').getAttribute('data-selected') || '[]';

            var fd = new FormData();
            fd.append('sesskey',      cfg.sesskey);
            fd.append('action',       'save');
            fd.append('id',           id);
            fd.append('name',         el('isti-cb-modal-name').value);
            fd.append('description',  el('isti-cb-modal-desc').value);
            fd.append('keywords',     el('isti-cb-modal-keywords').value);
            fd.append('external_url', el('isti-cb-modal-extlink').value);
            fd.append('status',       el('isti-cb-modal-status').value);
            fd.append('status_notes', el('isti-cb-modal-statusnotes').value);
            fd.append('levels',       levelsJson);
            fd.append('subjects',     subjectsJson);

            fetch(cfg.ajaxUrl, { method: 'POST', body: fd, credentials: 'same-origin' })
                .then(function (r) { return r.json(); })
                .then(function (json) {
                    saveBtn.disabled = false;
                    if (!json.ok) {
                        setStatusMsg(cfg.strings.errorPrefix + (json.error || 'save failed'), 'error');
                        return;
                    }
                    setStatusMsg(cfg.strings.saved, 'ok');
                    // Reload details so the displayed status + history reflect the save.
                    loadDetails(parseInt(id, 10));
                    // Reload the page table after a beat so the row reflects the new status/name.
                    setTimeout(function () { window.location.reload(); }, 1200);
                })
                .catch(function (err) {
                    saveBtn.disabled = false;
                    setStatusMsg(cfg.strings.errorPrefix + err.message, 'error');
                });
        });
    }
}());
