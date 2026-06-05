# Library & Schools Page Modernization

Modernize `contentbank.php` (Library) and `schools.php` (Schools) to match the existing Istikama dashboard design system (`isti-*` classes from `istikama_dashboard.css`).

## User Review Required

> [!IMPORTANT]
> **French Language**: No `lang/fr/` directory currently exists. I will create it with all translated strings. Please confirm French translations are desired.

> [!IMPORTANT]
> **Schools Page**: The current page has two layout modes (Legacy Grid / Modern Vertical). I plan to **remove the legacy grid layout toggle** entirely and keep only the modernized collapsible tree. Confirm this is acceptable.

> [!IMPORTANT]
> **Upload Content Types**: Currently 6 types (Document, Video, H5P, Book, Quiz, Link). I'll keep all 6 in a 3×2 grid with modern SVG icons replacing emojis. Confirm this set is complete.

## Open Questions

> [!NOTE]
> **Content Bank → Library rename**: The EN lang file already has `contentbank_title` = `'Content bank'` and `menu_library` = `'Library'`. Should I change `contentbank_title` to `'Library'` across all languages, or create a new string key?

---

## Proposed Changes

### Component 1 — Language Files (AR / EN / FR)

Fix broken `[[placeholders]]` and add missing strings. Create FR language file.

#### [MODIFY] [local_istikama_admin.php](file:///home/ayoub/istikama/moodle-docker/moodle/public/local/istikama_admin/lang/en/local_istikama_admin.php)
- Change `contentbank_title` from `'Content bank'` to `'Library'`
- Add any missing string keys used by the new UI (tab labels, button labels, modal strings)

#### [MODIFY] [local_istikama_admin.php](file:///home/ayoub/istikama/moodle-docker/moodle/public/local/istikama_admin/lang/ar/local_istikama_admin.php)
- Change `contentbank_title` from `'بنك المحتوى'` to `'المكتبة'`
- Add matching Arabic translations for all new string keys

#### [NEW] [local_istikama_admin.php](file:///home/ayoub/istikama/moodle-docker/moodle/public/local/istikama_admin/lang/fr/local_istikama_admin.php)
- Create complete French translation file covering all existing + new strings
- Covers: tabs, buttons, modals, validation, schools, upload, filters

---

### Component 2 — Library Page Header & Spacing

#### [MODIFY] [admin_layout.php](file:///home/ayoub/istikama/moodle-docker/moodle/public/local/istikama_admin/admin_layout.php)
- Reduce top padding/margin from the layout wrapper
- Use compact `padding-top: 16px` instead of excessive margins
- Keep the `isti-page-header` and `isti-card-modern` wrappers

#### [MODIFY] [contentbank.php](file:///home/ayoub/istikama/moodle-docker/moodle/public/local/istikama_admin/contentbank.php)
- Update `$PAGE->set_title()` to use the renamed `Library` string
- Replace old Bootstrap `nav nav-tabs` with modern `isti-tabs` system (matching Users page)
- Replace content cards grid with `isti-table` system (matching Users page table)
- Redesign upload tab: remove the initial upload button, show grid directly
- Use modern SVG/FA icons instead of emojis for content types
- Modernize validation workflow table to use `isti-table` classes
- Add proper RTL support throughout

---

### Component 3 — Library Tabs Modernization

**Current**: Bootstrap `nav nav-tabs` with `nav-link` classes → old Moodle look
**Target**: `isti-tabs` container with `isti-tab` buttons → matching Users page

Changes in [contentbank.php](file:///home/ayoub/istikama/moodle-docker/moodle/public/local/istikama_admin/contentbank.php):
- Replace `<ul class="nav nav-tabs">` with `<div class="isti-tabs">`
- Replace `<a class="nav-link">` with `<button class="isti-tab">`
- Add FontAwesome icons to each tab
- Update JS tab switching to use the new class names
- Tabs: 📚 Digital Library | 📤 Upload Content | ✅ Validation Workflow | ❓ Quiz Bank

---

### Component 4 — Digital Library: Cards → Table

**Current**: `istikama-library-grid` with `istikama-content-card` cards
**Target**: `isti-table` with blue header, no vertical borders

Table columns:
| # | Type | Name | Subject | Level | Category | Uploaded By | Rating | Actions |
|---|------|------|---------|-------|----------|-------------|--------|---------|

- Use `isti-card-modern` wrapper around the table
- No vertical borders between `th` elements (matching Users page)
- Row hover states
- Type shown as FA icon instead of emoji
- Keep search/filter bar with modern `isti-filter-bar` styling

---

### Component 5 — Upload Content Tab Redesign

**Current**: Upload button → type chooser (hidden) → form (hidden) — 3-step flow
**Target**: Type chooser grid shown directly (no initial button) → form

Grid layout:
```
┌──────────┐ ┌──────────┐ ┌──────────┐
│ 📄 Doc   │ │ 🎥 Video │ │ 📦 H5P   │
└──────────┘ └──────────┘ └──────────┘
┌──────────┐ ┌──────────┐ ┌──────────┐
│ 📖 Book  │ │ ❓ Quiz  │ │ 🔗 Link  │
└──────────┘ └──────────┘ └──────────┘
```

Changes:
- Remove `#upload-initial-state` button entirely
- Show `#type-chooser-panel` directly (remove `istikama-hidden` class)
- Set grid to `grid-template-columns: repeat(3, 1fr)` with `max-width: 700px; margin: 0 auto`
- Replace emoji icons with FontAwesome icons in colored circles
- Use `isti-card-modern` styling for each type card
- Blue accent on hover/selected states (matching platform blue `#3b82f6`)
- Centered layout

---

### Component 6 — Validation Workflow Modernization

**Current**: Has stat cards + basic table
**Target**: Use `isti-kpi-card` for stats + `isti-table` for pending items

Changes:
- Replace `istikama-validation-summary` → `isti-kpi-grid` with 3 KPI cards
- Replace `istikama-validation-table` → `isti-table` with blue headers, no vertical borders
- Status badges use `istikama-status` pills
- Action buttons use `isti-btn` classes
- Approve/Reject buttons use modern styling

---

### Component 7 — CSS Updates

#### [MODIFY] [istikama_admin.css](file:///home/ayoub/istikama/moodle-docker/moodle/public/local/istikama_admin/styles/istikama_admin.css)
- Add new CSS for the modernized upload grid (centered 3×2 with FA icons)
- Add CSS for modern type cards with blue accent system
- Add overrides to reduce top spacing on `isti-page-header`
- Ensure `isti-table th` has no vertical borders in both Users and Library pages
- Add schools collapsible tree modernized styles
- Add modal styles for add-class popup

---

### Component 8 — Schools Page: Full Modernization

#### [MODIFY] [schools.php](file:///home/ayoub/istikama/moodle-docker/moodle/public/local/istikama_admin/schools.php)

**Remove**: Legacy grid layout toggle and all legacy grid code
**Keep**: Only the modern collapsible tree layout

Changes:
- Remove layout toggle buttons (Legacy Grid / Modern Vertical)
- Remove entire legacy grid rendering block (`$current_layout !== 'modern'`)
- Modernize school row headers with `isti-card-modern` styling
- Modernize collapsible `<details>` with smooth animations
- Replace old buttons with `isti-btn isti-btn-primary` / `isti-btn-outline` classes
- Add class via modal popup instead of inline form
- Modernize subject pills
- Add expand/collapse all button
- Use proper `get_string()` for all hardcoded English strings

---

### Component 9 — Schools: Add Class Modal

**Current**: Inline `<form>` with input group inside each level's `<details>`
**Target**: Modal popup matching Users page manage modal

Implementation:
- Create modal HTML at bottom of page (same structure as subject assignment modal)
- Use `isti-modal-overlay` / `isti-modal` classes from dashboard CSS
- Form fields: Class Name (text input)
- Hidden fields: parentid (level ID), sesskey, action
- JS: Click "Add Class" button → open modal with level context → submit via form POST
- On success: redirect with notification (existing Moodle pattern)

---

### Component 10 — Schools: Button Modernization

Replace all button styles:

| Old | New |
|-----|-----|
| `btn btn-sm btn-outline-info` | `isti-btn isti-btn-outline` |
| `btn btn-sm btn-outline-secondary` | `isti-btn isti-btn-outline` |
| `btn btn-sm btn-outline-danger` | `isti-btn isti-btn-danger` (small) |
| `btn istikama-btn-primary` | `isti-btn isti-btn-primary` |
| `btn btn-outline-primary` | `isti-btn isti-btn-primary` (outline variant) |

---

### Component 11 — Schools: Collapsible Hierarchy

**Current**: Uses `<details>` + `<summary>` with basic styling
**Target**: Same `<details>` pattern but with modern animations and styling

Hierarchy visual:
```
🏫 School Name                    [Edit] [Delete]
  ├── 📁 Level 1                  [Assign Subjects] [3 Classes]
  │   ├── 👥 Class A              [Assign Subjects] [5 Courses]
  │   │   └── Subject pills...
  │   ├── 👥 Class B
  │   └── [+ Add Class]  ← opens modal
  └── [+ Add Level]
```

Styling improvements:
- Smooth rotate animation on chevron
- Indentation via padding (not margin)
- Alternating background for levels vs classes
- Blue left border on expanded items
- Modern transition on open/close

---

### Component 12 — Responsive & RTL

Ensure both pages:
- Work on mobile (stack filters, collapse tables)
- RTL direction works (Arabic)
- No horizontal scrolling
- Tabs wrap on small screens

---

## Verification Plan

### Automated Tests
- Open `http://localhost:8080/local/istikama_admin/contentbank.php` — verify all 4 tabs work
- Open `http://localhost:8080/local/istikama_admin/schools.php` — verify collapsible tree
- Switch language to Arabic — verify all strings translated, RTL layout correct
- Check browser console for JS errors
- Test tab switching, upload type selection, form submission flows
- Test add class modal open/close/submit

### Manual Verification
- Visual comparison with Users page to confirm design consistency
- Test on narrow viewport (mobile simulation)
- Verify all CRUD operations still work (approve, reject, upload, add school/level/class)

---

## Files to Modify

| File | Action |
|------|--------|
| `contentbank.php` | Major rewrite of HTML/UI |
| `schools.php` | Major rewrite of HTML/UI, remove legacy layout |
| `admin_layout.php` | Reduce top spacing |
| `styles/istikama_admin.css` | Add new styles, update existing |
| `lang/en/local_istikama_admin.php` | Add/update strings |
| `lang/ar/local_istikama_admin.php` | Add/update strings |
| `lang/fr/local_istikama_admin.php` | **NEW** — Full French translation |

**Estimated: ~7 files modified, ~1 new file**
