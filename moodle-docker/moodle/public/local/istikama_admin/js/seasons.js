/* Seasons admin page — modal controller. Loaded at end of body via $PAGE->requires->js(). */
(function () {
    'use strict';

    // ── Helpers ────────────────────────────────────────────────────────────────
    function pad(n) { return String(n).padStart(2, '0'); }

    function tsToDate(ts) {
        if (!ts) return '';
        var d = new Date(ts * 1000);
        return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate());
    }

    function dateToTs(s) {
        if (!s) return 0;
        return Math.floor(new Date(s + 'T00:00:00').getTime() / 1000);
    }

    function todayStr() {
        var d = new Date();
        d.setHours(0, 0, 0, 0);
        return d.getFullYear() + '-' + pad(d.getMonth() + 1) + '-' + pad(d.getDate());
    }

    function el(id) { return document.getElementById(id); }

    function openModal(id) {
        var m = el(id);
        if (m) { m.style.display = 'flex'; m.style.opacity = '1'; }
    }

    function closeAll() {
        var overlays = document.querySelectorAll('.isti-modal-overlay');
        for (var i = 0; i < overlays.length; i++) {
            overlays[i].style.display = 'none';
            overlays[i].style.opacity = '';
        }
    }

    // Read config string stored in hidden data element
    var dataEl = el('isti-seasons-data');
    var actNote = dataEl ? (dataEl.getAttribute('data-act-note') || '') : '';

    // ── Modal close: click-outside + [data-close-modal] + Escape ──────────────
    document.addEventListener('click', function (e) {
        if (!e || !e.target) return;
        var t = e.target;
        if (t.classList && t.classList.contains('isti-modal-overlay')) {
            t.style.display = 'none';
            t.style.opacity = '';
            return;
        }
        var closeBtn = t.closest ? t.closest('[data-close-modal]') : null;
        if (closeBtn) { closeAll(); }
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') { closeAll(); }
    });

    // ── Create modal ───────────────────────────────────────────────────────────
    var newBtn = el('isti-new-season-btn');
    if (newBtn) {
        newBtn.addEventListener('click', function () {
            var cStart = el('isti-create-start');
            var cEnd   = el('isti-create-end');
            var cSts   = el('isti-create-start-ts');
            var cEts   = el('isti-create-end-ts');
            if (cStart) { cStart.min = todayStr(); cStart.value = ''; }
            if (cEnd)   { cEnd.value = ''; }
            if (cSts)   { cSts.value = ''; }
            if (cEts)   { cEts.value = ''; }
            openModal('isti-create-modal');
        });
    }

    function syncCreate() {
        var cs   = el('isti-create-start');
        var ce   = el('isti-create-end');
        var cSts = el('isti-create-start-ts');
        var cEts = el('isti-create-end-ts');
        if (cSts) { cSts.value = cs ? dateToTs(cs.value) : 0; }
        if (cEts) { cEts.value = ce ? dateToTs(ce.value) : 0; }
    }

    var cStartEl = el('isti-create-start');
    var cEndEl   = el('isti-create-end');
    if (cStartEl) { cStartEl.addEventListener('change', syncCreate); }
    if (cEndEl)   { cEndEl.addEventListener('change', syncCreate); }

    // ── Edit modal — document-level delegation ─────────────────────────────────
    document.addEventListener('click', function (e) {
        if (!e || !e.target) return;
        var btn = e.target.closest ? e.target.closest('.isti-season-edit-btn') : null;
        if (!btn) return;
        e.preventDefault();

        var d        = btn.dataset;
        var startTs  = parseInt(d.start, 10) || 0;
        var endTs    = parseInt(d.end, 10) || 0;
        var isActive = (d.status === 'active');

        var eId      = el('isti-edit-id');
        var eName    = el('isti-edit-name');
        var eDesc    = el('isti-edit-desc');
        var eStart   = el('isti-edit-start');
        var eEnd     = el('isti-edit-end');
        var eStartTs = el('isti-edit-start-ts');
        var eEndTs   = el('isti-edit-end-ts');
        var eNote    = el('isti-edit-note');

        if (eId)      { eId.value   = d.id || ''; }
        if (eName)    { eName.value  = d.name || ''; }
        if (eDesc)    { eDesc.value  = d.desc || ''; }
        if (eStart)   { eStart.value = tsToDate(startTs); }
        if (eEnd)     { eEnd.value   = tsToDate(endTs); }
        // Pre-set hidden timestamps directly from original data (avoids TZ rounding issues)
        if (eStartTs) { eStartTs.value = startTs; }
        if (eEndTs)   { eEndTs.value   = endTs; }

        // Reset onchange handlers before setting new ones
        if (eStart) { eStart.onchange = null; }
        if (eEnd)   { eEnd.onchange   = null; }

        if (isActive) {
            if (eStart) { eStart.disabled = true; eStart.style.opacity = '0.6'; eStart.style.background = '#f1f5f9'; }
            if (eEnd)   { eEnd.min = todayStr(); }
            if (eNote)  { eNote.textContent = actNote; eNote.style.display = 'block'; }
            if (eEnd) {
                eEnd.onchange = function () {
                    if (eEndTs) { eEndTs.value = dateToTs(eEnd.value); }
                };
            }
        } else {
            if (eStart) { eStart.disabled = false; eStart.style.opacity = ''; eStart.style.background = ''; eStart.removeAttribute('min'); }
            if (eEnd)   { eEnd.removeAttribute('min'); }
            if (eNote)  { eNote.style.display = 'none'; }
            if (eStart) {
                eStart.onchange = function () {
                    if (eStartTs) { eStartTs.value = dateToTs(eStart.value); }
                };
            }
            if (eEnd) {
                eEnd.onchange = function () {
                    if (eEndTs) { eEndTs.value = dateToTs(eEnd.value); }
                };
            }
        }

        openModal('isti-edit-modal');
        setTimeout(function () { if (eName) { eName.focus(); } }, 50);
    });

    // ── Close modal — document-level delegation ────────────────────────────────
    var clExpected = '';

    document.addEventListener('click', function (e) {
        if (!e || !e.target) return;
        var btn = e.target.closest ? e.target.closest('.isti-season-close-btn') : null;
        if (!btn) return;
        e.preventDefault();

        clExpected = (btn.dataset.name || '').trim();
        var clId     = el('isti-close-id');
        var clName   = el('isti-close-name');
        var clInput  = el('isti-close-input');
        var clSubmit = el('isti-close-submit');

        if (clId)     { clId.value = btn.dataset.id || ''; }
        if (clName)   { clName.textContent = '"' + clExpected + '"'; }
        if (clInput)  { clInput.value = ''; }
        if (clSubmit) { clSubmit.disabled = true; }

        openModal('isti-close-modal');
        setTimeout(function () { if (clInput) { clInput.focus(); } }, 50);
    });

    var clInputEl = el('isti-close-input');
    if (clInputEl) {
        clInputEl.addEventListener('input', function () {
            var clSubmit = el('isti-close-submit');
            if (clSubmit) { clSubmit.disabled = (this.value.trim() !== clExpected); }
        });
    }

}());
