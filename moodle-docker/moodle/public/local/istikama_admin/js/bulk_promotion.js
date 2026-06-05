/* Bulk promotion page — multi-select + cascading filters + confirmation modal. */
(function () {
    'use strict';

    function el(id) { return document.getElementById(id); }
    function $all(sel) { return document.querySelectorAll(sel); }

    // ── Configuration (from hidden data div) ──────────────────────────────────
    var data = el('isti-bp-data');
    function attr(k, fb) { return data ? (data.getAttribute('data-' + k) || fb) : fb; }
    // Parse the level→classes map (serialized as JSON in a data attribute).
    var classesByLevel = {};
    try {
        var raw = data ? data.getAttribute('data-classes-by-level') : '';
        if (raw) { classesByLevel = JSON.parse(raw) || {}; }
    } catch (e) { classesByLevel = {}; }

    var cfg = {
        fromSeasonId:    attr('from-season-id', ''),
        fromSeasonName:  attr('from-season-name', ''),
        noStudentsMsg:   attr('validation-no-students', 'No students selected.'),
        noSeasonMsg:     attr('validation-no-season',   'Select a destination season.'),
        noClassMsg:      attr('validation-no-class',    'Select a destination class.'),
        noLevelMsg:      attr('validation-no-level',    'Select a destination level.'),
        selectAClass:    attr('select-a-class',         'Select a class…'),
        pickLevelFirst:  attr('pick-level-first',       'Pick a level first…'),
        actPromote:      attr('action-promote',     'promote'),
        actRetain:       attr('action-retain',      'retain'),
        actGraduate:     attr('action-graduate',    'graduate'),
        actTransfer:     attr('action-transfer',    'transfer'),
        actChangeClass:  attr('action-change-class','change_class'),
    };

    // ── Cascading filters: auto-submit on change ─────────────────────────────
    $all('.isti-bp-cascade').forEach(function (sel) {
        sel.addEventListener('change', function () {
            if (sel.name === 'schoolid') {
                var lvl = document.querySelector('select[name="levelid"]');
                var cls = document.querySelector('select[name="classid"]');
                if (lvl) lvl.value = '0';
                if (cls) cls.value = '0';
            } else if (sel.name === 'levelid') {
                var cls2 = document.querySelector('select[name="classid"]');
                if (cls2) cls2.value = '0';
            }
            sel.form.submit();
        });
    });

    // ── Multi-select: select-all + selected counter ──────────────────────────
    var selectAll = el('isti-bp-selectall');
    var rows      = $all('.isti-bp-row');
    var counter   = el('isti-bp-selcount');
    var submitBtn = el('isti-bp-submit-btn');

    function updateCount() {
        var n = 0;
        rows.forEach(function (r) { if (r.checked) n++; });
        if (counter) counter.textContent = String(n);
        if (submitBtn) submitBtn.disabled = (n === 0);
    }

    if (selectAll) {
        selectAll.addEventListener('change', function () {
            rows.forEach(function (r) { r.checked = selectAll.checked; });
            updateCount();
        });
    }
    rows.forEach(function (r) {
        r.addEventListener('change', function () {
            if (!r.checked && selectAll) { selectAll.checked = false; }
            updateCount();
        });
    });
    updateCount();

    // ── Cascade: destination level → destination class ───────────────────────
    var levelSel     = el('isti-bp-tolevel');
    var levelWrap    = el('isti-bp-tolevel-wrap');
    var levelStar    = el('isti-bp-level-required');
    var classSel     = el('isti-bp-toclass');
    var classWrap    = el('isti-bp-toclass-wrap');
    var classStar    = el('isti-bp-class-required');
    var actionSel    = el('isti-bp-actiontype');
    var seasonSel    = el('isti-bp-toseason');

    function rebuildClassOptions() {
        if (!classSel) return;
        // Clear all existing options.
        while (classSel.firstChild) { classSel.removeChild(classSel.firstChild); }
        var lvlid = levelSel ? levelSel.value : '0';
        var classes = (lvlid && lvlid !== '0' && classesByLevel[lvlid]) ? classesByLevel[lvlid] : [];

        var placeholder = document.createElement('option');
        placeholder.value = '0';
        placeholder.textContent = (lvlid && lvlid !== '0')
            ? cfg.selectAClass
            : cfg.pickLevelFirst;
        classSel.appendChild(placeholder);

        for (var i = 0; i < classes.length; i++) {
            var opt = document.createElement('option');
            opt.value = String(classes[i].id);
            opt.textContent = classes[i].name;
            classSel.appendChild(opt);
        }
        classSel.disabled = (classes.length === 0);
    }
    if (levelSel) {
        levelSel.addEventListener('change', rebuildClassOptions);
    }

    // ── Action-driven visibility / required-ness ─────────────────────────────
    function syncActionUI() {
        if (!actionSel) return;
        var act = actionSel.value;
        var needsClassLevel = (act === cfg.actPromote || act === cfg.actTransfer || act === cfg.actChangeClass);
        var isGraduate      = (act === cfg.actGraduate);
        var isRetain        = (act === cfg.actRetain);
        var isChangeClass   = (act === cfg.actChangeClass);

        // For GRADUATE: hide both level + class.
        // For RETAIN: hide both (backend keeps the source class).
        // For everything else: show + require both.
        var hideClassLevel = isGraduate || isRetain;
        if (levelWrap) { levelWrap.style.display = hideClassLevel ? 'none' : ''; }
        if (classWrap) { classWrap.style.display = hideClassLevel ? 'none' : ''; }
        if (levelStar) { levelStar.style.display = needsClassLevel ? '' : 'none'; }
        if (classStar) { classStar.style.display = needsClassLevel ? '' : 'none'; }

        // CHANGE_CLASS: destination season is locked to source.
        if (seasonSel) {
            if (isChangeClass && cfg.fromSeasonId) {
                seasonSel.value    = cfg.fromSeasonId;
                seasonSel.disabled = true;
            } else {
                seasonSel.disabled = false;
            }
        }
    }
    if (actionSel) {
        actionSel.addEventListener('change', syncActionUI);
        syncActionUI();
    }
    rebuildClassOptions();

    // ── Modal helpers ────────────────────────────────────────────────────────
    function openModal(id) {
        var m = el(id);
        if (m) { m.style.display = 'flex'; m.style.opacity = '1'; }
    }
    function closeAll() {
        $all('.isti-modal-overlay').forEach(function (m) {
            m.style.display = 'none';
            m.style.opacity = '';
        });
    }
    document.addEventListener('click', function (e) {
        if (!e || !e.target) return;
        if (e.target.classList && e.target.classList.contains('isti-modal-overlay')) {
            e.target.style.display = 'none';
            e.target.style.opacity = '';
            return;
        }
        var closeBtn = e.target.closest ? e.target.closest('[data-close-modal]') : null;
        if (closeBtn) { closeAll(); }
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { closeAll(); }
    });

    // ── Submit handler: validate + show confirmation modal ──────────────────
    if (submitBtn) {
        submitBtn.addEventListener('click', function () {
            var selected = 0;
            rows.forEach(function (r) { if (r.checked) selected++; });
            if (selected === 0) { alert(cfg.noStudentsMsg); return; }

            var act = actionSel ? actionSel.value : cfg.actPromote;
            var needsClassLevel = (act === cfg.actPromote || act === cfg.actTransfer || act === cfg.actChangeClass);
            var isGraduate      = (act === cfg.actGraduate);
            var isRetain        = (act === cfg.actRetain);
            var isChangeClass   = (act === cfg.actChangeClass);

            // Destination season must always have a value.
            var toSeasonId   = seasonSel ? seasonSel.value : '';
            var toSeasonName = (seasonSel && toSeasonId) ? seasonSel.options[seasonSel.selectedIndex].text : '';
            if (!toSeasonId) { alert(cfg.noSeasonMsg); return; }

            var toLevelName = '—';
            var toClassName = '—';
            if (needsClassLevel) {
                if (!levelSel || !levelSel.value || levelSel.value === '0') {
                    alert(cfg.noLevelMsg); return;
                }
                if (!classSel || !classSel.value || classSel.value === '0') {
                    alert(cfg.noClassMsg); return;
                }
                toLevelName = levelSel.options[levelSel.selectedIndex].text;
                toClassName = classSel.options[classSel.selectedIndex].text;
            } else if (isRetain) {
                toLevelName = 'Same level (retain)';
                toClassName = 'Same class (retain)';
            } else if (isGraduate) {
                toLevelName = '—';
                toClassName = '—';
            }

            var actionName = actionSel ? actionSel.options[actionSel.selectedIndex].text : '';

            var sameSeasonNote = isChangeClass
                ? '<p style="color:#0891b2; font-size:13px; margin-top:8px;"><i class="fa fa-info-circle"></i> Same-season class change: the existing enrollment row is updated in place (no new row created).</p>'
                : '<p style="color:#475569; font-size:13px;"><i class="fa fa-shield-alt" style="color:#059669"></i> Historical data (attendance, grades, notes) from the source season is preserved untouched.</p>';

            var html =
                '<p><strong>' + selected + '</strong> students will be processed.</p>' +
                '<ul style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:14px 14px 14px 32px; margin:10px 0; font-size:13px; line-height:1.8; list-style:disc;">' +
                '<li><strong>From season:</strong> ' + escapeHtml(cfg.fromSeasonName || '—') + '</li>' +
                '<li><strong>To season:</strong> '   + escapeHtml(toSeasonName) + '</li>' +
                '<li><strong>Target level:</strong> ' + escapeHtml(toLevelName) + '</li>' +
                '<li><strong>Target class:</strong> ' + escapeHtml(toClassName) + '</li>' +
                '<li><strong>Action:</strong> '      + escapeHtml(actionName) + '</li>' +
                '</ul>' + sameSeasonNote;

            var text = el('isti-bp-confirm-text');
            if (text) text.innerHTML = html;
            openModal('isti-bp-confirm-modal');
        });
    }

    var confirmYes = el('isti-bp-confirm-yes');
    if (confirmYes) {
        confirmYes.addEventListener('click', function () {
            // Re-enable the season dropdown so its value gets submitted by the form
            // even when CHANGE_CLASS disabled it for UX.
            if (seasonSel && seasonSel.disabled) {
                seasonSel.disabled = false;
            }
            var form = el('isti-bp-form');
            if (form) form.submit();
        });
    }

    function escapeHtml(s) {
        return String(s == null ? '' : s)
            .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;').replace(/'/g, '&#39;');
    }
}());
