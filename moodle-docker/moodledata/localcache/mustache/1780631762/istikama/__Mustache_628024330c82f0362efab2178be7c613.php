<?php

class __Mustache_628024330c82f0362efab2178be7c613 extends Mustache_Template
{
    private $lambdaHelper;

    public function renderInternal(Mustache_Context $context, $indent = '')
    {
        $this->lambdaHelper = new Mustache_LambdaHelper($this->mustache, $context);
        $buffer = '';

        $buffer .= $indent . '<div class="istikama-section" dir="auto">
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <div class="isti-tabs" id="istikama-user-tabs" style="margin-bottom:var(--space-lg)">
';
        $buffer .= $indent . '        <button type="button" class="isti-tab active" data-tab="all">
';
        $buffer .= $indent . '            <i class="fa fa-users"></i> ';
        $value = $this->resolveValue($context->find('str_tab_all'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '
';
        $buffer .= $indent . '        </button>
';
        $buffer .= $indent . '        <button type="button" class="isti-tab" data-tab="students">
';
        $buffer .= $indent . '            <i class="fa fa-graduation-cap"></i> ';
        $value = $this->resolveValue($context->find('str_tab_students'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '
';
        $buffer .= $indent . '        </button>
';
        $buffer .= $indent . '        <button type="button" class="isti-tab" data-tab="teachers">
';
        $buffer .= $indent . '            <i class="fa fa-chalkboard-teacher"></i> ';
        $value = $this->resolveValue($context->find('str_tab_teachers'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '
';
        $buffer .= $indent . '        </button>
';
        $buffer .= $indent . '        <button type="button" class="isti-tab" data-tab="parents">
';
        $buffer .= $indent . '            <i class="fa fa-user-friends"></i> ';
        $value = $this->resolveValue($context->find('str_tab_parents'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '
';
        $buffer .= $indent . '        </button>
';
        $value = $context->find('is_school_manager');
        if (empty($value)) {
            
            $buffer .= $indent . '        <button type="button" class="isti-tab" data-tab="managers">
';
            $buffer .= $indent . '            <i class="fa fa-building"></i> ';
            $value = $this->resolveValue($context->find('str_tab_managers'), $context);
            $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
            $buffer .= '
';
            $buffer .= $indent . '        </button>
';
        }
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <form method="get" action="';
        $value = $this->resolveValue($context->find('baseurl'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '" class="isti-filter-bar" id="istikama-filter-form" style="justify-content: flex-start; align-items: flex-end;">
';
        $buffer .= $indent . '        <div class="isti-form-group">
';
        $buffer .= $indent . '            <label class="isti-form-label" style="font-size:0.85rem; font-weight:600; margin-bottom:0px;">';
        $value = $context->find('str');
        $buffer .= $this->section5a2db0676bee2c7837e95fc3c2fc900f($context, $indent, $value);
        $buffer .= '</label>
';
        $buffer .= $indent . '            <input class="isti-form-input search" type="text" name="search" value="';
        $value = $this->resolveValue($context->find('search'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '" id="istikama-search-input" style="width: 350px;">
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        <div class="isti-form-group" style="width: 200px;">
';
        $buffer .= $indent . '            <label class="isti-form-label" style="font-size:0.85rem; font-weight:600; margin-bottom:0px;">';
        $value = $context->find('str');
        $buffer .= $this->section1b1303bc9d8aae75a38041554362b1ac($context, $indent, $value);
        $buffer .= '</label>
';
        $buffer .= $indent . '            <select class="isti-form-select" name="roleid">
';
        $value = $context->find('roleoptions');
        $buffer .= $this->section6d4cd8d98fa5934ffa14d8de912070e8($context, $indent, $value);
        $buffer .= $indent . '            </select>
';
        $buffer .= $indent . '        </div>
';
        $value = $context->find('is_school_manager');
        if (empty($value)) {
            
            $buffer .= $indent . '        <div class="isti-form-group" style="width: 200px;">
';
            $buffer .= $indent . '            <label class="isti-form-label" style="font-size:0.85rem; font-weight:600; margin-bottom:0px;">';
            $value = $context->find('str');
            $buffer .= $this->section836e27aad3ca4bc3159039f99fb8024b($context, $indent, $value);
            $buffer .= '</label>
';
            $buffer .= $indent . '            <select class="isti-form-select" name="school">
';
            $value = $context->find('schooloptions');
            $buffer .= $this->section6d4cd8d98fa5934ffa14d8de912070e8($context, $indent, $value);
            $buffer .= $indent . '            </select>
';
            $buffer .= $indent . '        </div>
';
        }
        $buffer .= $indent . '        <div class="isti-form-group">
';
        $buffer .= $indent . '            <button class="isti-btn isti-btn-primary" type="submit" style="height: 42px;">';
        $value = $context->find('str');
        $buffer .= $this->section81355c07e089f3ee516573fa88aa1e64($context, $indent, $value);
        $buffer .= '</button>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </form>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    <form method="post" action="';
        $value = $this->resolveValue($context->find('baseurl'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '" id="istikama-users-bulk-form">
';
        $buffer .= $indent . '        <input type="hidden" name="sesskey" value="';
        $value = $this->resolveValue($context->find('sesskey'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '">
';
        $buffer .= $indent . '        <div class="isti-action-row isti-mb-md">
';
        $buffer .= $indent . '         
';
        $buffer .= $indent . '            <select class="isti-form-select bulk-action-btn" name="newroleid" style="width:auto; border-radius: 20px;" disabled>
';
        $value = $context->find('roleassignoptions');
        $buffer .= $this->sectionAc345f5e6a9b3961a88bd2bb0bbb53fe($context, $indent, $value);
        $buffer .= $indent . '            </select>
';
        $buffer .= $indent . '            <button class="isti-btn isti-btn-primary bulk-action-btn" type="submit" name="action" value="bulkassign" style="border-radius: 20px;" disabled>
';
        $buffer .= $indent . '                <i class="fa fa-user-plus"></i> ';
        $value = $context->find('str');
        $buffer .= $this->sectionF7ab17d2acc0df3c2f40daad8949437f($context, $indent, $value);
        $buffer .= '
';
        $buffer .= $indent . '            </button>
';
        $buffer .= $indent . '            <button class="isti-btn isti-btn-danger bulk-action-btn" type="submit" name="action" value="bulkremove" style="border-radius: 20px;" disabled>
';
        $buffer .= $indent . '                <i class="fa fa-user-minus"></i> ';
        $value = $this->resolveValue($context->find('str_action_remove_role'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '
';
        $buffer .= $indent . '            </button>
';
        $buffer .= $indent . '            <button class="isti-btn isti-btn-success bulk-action-btn" type="submit" name="download" value="csv" style="border-radius: 20px;" disabled>
';
        $buffer .= $indent . '                <i class="fa fa-download"></i> ';
        $value = $context->find('str');
        $buffer .= $this->section8490ae99b040899425757f98803c67d6($context, $indent, $value);
        $buffer .= '
';
        $buffer .= $indent . '            </button>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        <div class="isti-card-modern">
';
        $buffer .= $indent . '            <div class="isti-card-body" style="padding:0">
';
        $buffer .= $indent . '                <div class="table-responsive">
';
        $buffer .= $indent . '                    <table class="isti-table isti-table-striped" id="istikama-users-table">
';
        $buffer .= $indent . '                        <thead>
';
        $buffer .= $indent . '                            <tr>
';
        $buffer .= $indent . '                                <th style="width: 48px; border: none;"><input type="checkbox" id="istikama-select-all"></th>
';
        $buffer .= $indent . '                                <th style="border: none; border-left: none; border-right: none;">';
        $value = $context->find('str');
        $buffer .= $this->section56969744b7561d447791b1fcb4af3f50($context, $indent, $value);
        $buffer .= '</th>
';
        $buffer .= $indent . '                                <th style="border: none; border-left: none; border-right: none;">';
        $value = $context->find('str');
        $buffer .= $this->section2ab85814230c071671904f891eecb590($context, $indent, $value);
        $buffer .= '</th>
';
        $buffer .= $indent . '                                <th style="border: none; border-left: none; border-right: none;">';
        $value = $context->find('str');
        $buffer .= $this->section79c57a23a0789f52a124f2a15f20c965($context, $indent, $value);
        $buffer .= '</th>
';
        $buffer .= $indent . '                                <th style="border: none; border-left: none; border-right: none;">';
        $value = $context->find('str');
        $buffer .= $this->section52030fc5bea44c625e063d9e9632d969($context, $indent, $value);
        $buffer .= '</th>
';
        $buffer .= $indent . '                                <th style="border: none; border-left: none; border-right: none;">';
        $value = $context->find('str');
        $buffer .= $this->section90c1466789642bab0844286a3a534a1a($context, $indent, $value);
        $buffer .= '</th>
';
        $buffer .= $indent . '                                <th style="border: none; text-align: center; border-left: none; border-right: none;">';
        $value = $context->find('str');
        $buffer .= $this->section0370c9d783a80c5514faa7926dafeb3e($context, $indent, $value);
        $buffer .= '</th>
';
        $buffer .= $indent . '                            </tr>
';
        $buffer .= $indent . '                        </thead>
';
        $buffer .= $indent . '                        <tbody id="istikama-users-tbody">
';
        $value = $context->find('users');
        $buffer .= $this->sectionD76c1d539fec21fd3b43144233f10c64($context, $indent, $value);
        $buffer .= $indent . '                        </tbody>
';
        $buffer .= $indent . '                    </table>
';
        $buffer .= $indent . '                </div>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </form>
';
        $buffer .= $indent . '</div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<div class="isti-modal-overlay" id="istikama-manage-modal">
';
        $buffer .= $indent . '    <div class="isti-modal">
';
        $buffer .= $indent . '        <div class="isti-modal-header">
';
        $buffer .= $indent . '            <div>
';
        $buffer .= $indent . '                <h3 id="istikama-modal-title" style="margin:0;font-size:1.15rem;font-weight:700">';
        $value = $this->resolveValue($context->find('str_manage_assignment'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '</h3>
';
        $buffer .= $indent . '                <span class="isti-kpi-label" id="istikama-modal-subtitle"></span>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <button class="isti-btn" style="background:transparent;border:none;font-size:1.5rem;padding:0;color:var(--text-muted)" id="istikama-modal-close">&times;</button>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        <div class="isti-modal-body" id="istikama-modal-body">
';
        $buffer .= $indent . '            <div class="isti-loading" id="istikama-modal-loading">
';
        $buffer .= $indent . '                <div class="isti-spinner"></div>
';
        $buffer .= $indent . '                <span>';
        $value = $this->resolveValue($context->find('str_loading'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '</span>
';
        $buffer .= $indent . '            </div>
';
        $buffer .= $indent . '            <div id="istikama-modal-content" style="display:none;"></div>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '        <div class="isti-modal-footer">
';
        $buffer .= $indent . '            <div id="istikama-modal-feedback" class="isti-alert" style="display:none;margin-bottom:0;flex:1"></div>
';
        $buffer .= $indent . '            <button class="isti-btn isti-btn-outline" id="istikama-modal-cancel-btn">';
        $value = $this->resolveValue($context->find('str_close'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '</button>
';
        $buffer .= $indent . '            <button class="isti-btn isti-btn-primary" id="istikama-modal-save-btn">
';
        $buffer .= $indent . '                <i class="fa fa-check"></i> ';
        $value = $this->resolveValue($context->find('str_save_changes'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '
';
        $buffer .= $indent . '            </button>
';
        $buffer .= $indent . '        </div>
';
        $buffer .= $indent . '    </div>
';
        $buffer .= $indent . '</div>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<script id="istikama-subjects-data" type="application/json">';
        $value = $this->resolveValue($context->find('subjectsJson'), $context);
        $buffer .= ($value === null ? '' : $value);
        $buffer .= '</script>
';
        $buffer .= $indent . '<script id="istikama-sm-config" type="application/json">{"is_school_manager": ';
        $value = $context->find('is_school_manager');
        $buffer .= $this->section03a2cb78adf693fb240638cbbc7ea15e($context, $indent, $value);
        $value = $context->find('is_school_manager');
        if (empty($value)) {
            
            $buffer .= 'false';
        }
        $buffer .= ', "manager_schoolid": ';
        $value = $context->find('manager_schoolid');
        $buffer .= $this->section6a11eb7dd252f61029b41613dd21670f($context, $indent, $value);
        $value = $context->find('manager_schoolid');
        if (empty($value)) {
            
            $buffer .= '0';
        }
        $buffer .= ', "manager_schoolname": "';
        $value = $this->resolveValue($context->find('manager_schoolname'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '"}</script>
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '<script>
';
        $buffer .= $indent . 'document.addEventListener(\'DOMContentLoaded\', function() {
';
        $buffer .= $indent . '    var AJAX_URL = \'';
        $value = $this->resolveValue($context->find('ajaxurl'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\';
';
        $buffer .= $indent . '    var SESSKEY = \'';
        $value = $this->resolveValue($context->find('sesskey'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\';
';
        $buffer .= $indent . '    var SM_CONFIG = JSON.parse(document.getElementById(\'istikama-sm-config\').textContent);
';
        $buffer .= $indent . '    var IS_SCHOOL_MANAGER = SM_CONFIG.is_school_manager;
';
        $buffer .= $indent . '    var MANAGER_SCHOOLID = SM_CONFIG.manager_schoolid;
';
        $buffer .= $indent . '    var MANAGER_SCHOOLNAME = SM_CONFIG.manager_schoolname;
';
        $buffer .= $indent . '    var STRINGS = {
';
        $buffer .= $indent . '        manage_assignment: \'';
        $value = $this->resolveValue($context->find('str_manage_assignment'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        assign_school: \'';
        $value = $this->resolveValue($context->find('str_assign_school'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        assign_level: \'';
        $value = $this->resolveValue($context->find('str_assign_level'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        assign_class: \'';
        $value = $this->resolveValue($context->find('str_assign_class'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        assign_subjects: \'';
        $value = $this->resolveValue($context->find('str_assign_subjects'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        select_school: \'';
        $value = $this->resolveValue($context->find('str_select_school'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        select_level: \'';
        $value = $this->resolveValue($context->find('str_select_level'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        select_class: \'';
        $value = $this->resolveValue($context->find('str_select_class'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        assignment_saved: \'';
        $value = $this->resolveValue($context->find('str_assignment_saved'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        assignment_error: \'';
        $value = $this->resolveValue($context->find('str_assignment_error'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        no_assignment: \'';
        $value = $this->resolveValue($context->find('str_no_assignment'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        saving: \'';
        $value = $this->resolveValue($context->find('str_saving'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        loading: \'';
        $value = $this->resolveValue($context->find('str_loading'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        close: \'';
        $value = $this->resolveValue($context->find('str_close'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        save_changes: \'';
        $value = $this->resolveValue($context->find('str_save_changes'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        managed_schools: \'';
        $value = $this->resolveValue($context->find('str_managed_schools'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        add_school: \'';
        $value = $this->resolveValue($context->find('str_add_school_assignment'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        add_class: \'';
        $value = $this->resolveValue($context->find('str_add_class_assignment'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        no_role: \'';
        $value = $this->resolveValue($context->find('str_no_role_detected'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        student_title: \'';
        $value = $this->resolveValue($context->find('str_student_title'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        teacher_title: \'';
        $value = $this->resolveValue($context->find('str_teacher_title'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        manager_title: \'';
        $value = $this->resolveValue($context->find('str_manager_title'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        parent_title: \'';
        $value = $this->resolveValue($context->find('str_parent_title'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        parent_search: \'';
        $value = $this->resolveValue($context->find('str_parent_search_students'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        parent_linked: \'';
        $value = $this->resolveValue($context->find('str_parent_linked_to_others'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        parent_no_students: \'';
        $value = $this->resolveValue($context->find('str_parent_no_students'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        remove: \'';
        $value = $this->resolveValue($context->find('str_remove_assignment'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\',
';
        $buffer .= $indent . '        confirm_remove: \'';
        $value = $this->resolveValue($context->find('str_confirm_remove'), $context);
        $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
        $buffer .= '\'
';
        $buffer .= $indent . '    };
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Select all checkbox ──
';
        $buffer .= $indent . '    var selectAll = document.getElementById(\'istikama-select-all\');
';
        $buffer .= $indent . '    
';
        $buffer .= $indent . '    function toggleBulkActions() {
';
        $buffer .= $indent . '        var anyChecked = document.querySelectorAll(\'.istikama-user-checkbox:checked\').length > 0;
';
        $buffer .= $indent . '        document.querySelectorAll(\'.bulk-action-btn\').forEach(function(btn) {
';
        $buffer .= $indent . '            if (anyChecked) {
';
        $buffer .= $indent . '                btn.removeAttribute(\'disabled\');
';
        $buffer .= $indent . '                btn.classList.remove(\'disabled\');
';
        $buffer .= $indent . '                btn.style.pointerEvents = \'auto\';
';
        $buffer .= $indent . '                btn.style.opacity = \'1\';
';
        $buffer .= $indent . '            } else {
';
        $buffer .= $indent . '                btn.setAttribute(\'disabled\', \'disabled\');
';
        $buffer .= $indent . '                btn.classList.add(\'disabled\');
';
        $buffer .= $indent . '                btn.style.pointerEvents = \'none\';
';
        $buffer .= $indent . '                btn.style.opacity = \'0.5\';
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    if (selectAll) {
';
        $buffer .= $indent . '        selectAll.addEventListener(\'change\', function() {
';
        $buffer .= $indent . '            document.querySelectorAll(\'input[name="selectedusers[]"]\').forEach(function(cb) {
';
        $buffer .= $indent . '                cb.checked = selectAll.checked;
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '            toggleBulkActions();
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '    
';
        $buffer .= $indent . '    // Bind to individual checkboxes (delegated to tbody)
';
        $buffer .= $indent . '    var tbodyNode = document.getElementById(\'istikama-users-tbody\');
';
        $buffer .= $indent . '    if (tbodyNode) {
';
        $buffer .= $indent . '        tbodyNode.addEventListener(\'change\', function(e) {
';
        $buffer .= $indent . '            if (e.target && e.target.classList.contains(\'istikama-user-checkbox\')) {
';
        $buffer .= $indent . '                toggleBulkActions();
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Tab switching ──
';
        $buffer .= $indent . '    var currentTab = \'all\';
';
        $buffer .= $indent . '    document.querySelectorAll(\'.isti-tab\').forEach(function(tab) {
';
        $buffer .= $indent . '        tab.addEventListener(\'click\', function() {
';
        $buffer .= $indent . '            var tabName = this.getAttribute(\'data-tab\');
';
        $buffer .= $indent . '            if (tabName === currentTab) return;
';
        $buffer .= $indent . '            currentTab = tabName;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            document.querySelectorAll(\'.isti-tab\').forEach(function(t) { t.classList.remove(\'active\'); });
';
        $buffer .= $indent . '            this.classList.add(\'active\');
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            if (tabName === \'all\') {
';
        $buffer .= $indent . '                loadUsersForTab(\'all\');
';
        $buffer .= $indent . '                return;
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            // AJAX fetch for tab
';
        $buffer .= $indent . '            loadUsersForTab(tabName);
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function loadUsersForTab(tab) {
';
        $buffer .= $indent . '        var tbody = document.getElementById(\'istikama-users-tbody\');
';
        $buffer .= $indent . '        tbody.innerHTML = \'<tr><td colspan="7" class="text-center py-4"><div class="istikama-spinner"></div></td></tr>\';
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        var search = document.getElementById(\'istikama-search-input\') ? document.getElementById(\'istikama-search-input\').value : \'\';
';
        $buffer .= $indent . '        var selectSchool = document.querySelector(\'select[name="school"]\');
';
        $buffer .= $indent . '        var school = selectSchool ? selectSchool.value : \'\';
';
        $buffer .= $indent . '        var actionName = IS_SCHOOL_MANAGER ? \'smgetusersbytab\' : \'getusersbytab\';
';
        $buffer .= $indent . '        var url = AJAX_URL + \'?action=\' + actionName + \'&tab=\' + encodeURIComponent(tab) +
';
        $buffer .= $indent . '                  \'&search=\' + encodeURIComponent(search) +
';
        $buffer .= $indent . '                  \'&school=\' + encodeURIComponent(school) +
';
        $buffer .= $indent . '                  \'&sesskey=\' + SESSKEY;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        fetch(url)
';
        $buffer .= $indent . '            .then(function(r) { return r.json(); })
';
        $buffer .= $indent . '            .then(function(data) {
';
        $buffer .= $indent . '                if (!data.users || data.users.length === 0) {
';
        $buffer .= $indent . '                    tbody.innerHTML = \'<tr><td colspan="7" class="text-center text-muted py-4">No users found</td></tr>\';
';
        $buffer .= $indent . '                    return;
';
        $buffer .= $indent . '                }
';
        $buffer .= $indent . '                var html = \'\';
';
        $buffer .= $indent . '                data.users.forEach(function(u) {
';
        $buffer .= $indent . '                    html += \'<tr data-userid="\' + u.id + \'" data-roletype="\' + esc(u.role_type) + \'">\';
';
        $buffer .= $indent . '                    html += \'<td><input type="checkbox" name="selectedusers[]" value="\' + u.id + \'" class="istikama-user-checkbox"></td>\';
';
        $buffer .= $indent . '                    html += \'<td>\' + esc(u.name) + \'</td>\';
';
        $buffer .= $indent . '                    html += \'<td>\' + esc(u.email) + \'</td>\';
';
        $buffer .= $indent . '                    html += \'<td><span class="istikama-role-badge istikama-role-\' + esc(u.role_type) + \'">\' + esc(u.role) + \'</span></td>\';
';
        $buffer .= $indent . '                    html += \'<td>\' + esc(u.assignment || \'-\') + \'</td>\';
';
        $buffer .= $indent . '                    html += \'<td>\' + esc(u.lastlogin) + \'</td>\';
';
        $buffer .= $indent . '                    html += \'<td style="border-left: none; border-right: none;">\';
';
        $buffer .= $indent . '                    html += \'<div style="display: flex; justify-content: center; gap: 8px;">\';
';
        $buffer .= $indent . '                    html += \'<button type="button" class="isti-action-btn istikama-btn-manage" data-userid="\' + u.id + \'" data-username="\' + esc(u.name) + \'" data-roletype="\' + esc(u.role_type) + \'" title="Manage"><i class="fa fa-cog"></i></button>\';
';
        $buffer .= $indent . '                    html += \'<a class="isti-action-btn" href="\' + esc(u.editurl) + \'" title="Edit"><i class="fa fa-pencil-alt"></i></a>\';
';
        $buffer .= $indent . '                    html += \'<a class="isti-action-btn" href="\' + esc(u.viewurl) + \'" title="View"><i class="fa fa-eye"></i></a>\';
';
        $buffer .= $indent . '                    if (u.deleteurl) {
';
        $buffer .= $indent . '                        html += \'<a class="isti-action-btn delete-btn" href="\' + esc(u.deleteurl) + \'" title="Delete"><i class="fa fa-trash"></i></a>\';
';
        $buffer .= $indent . '                    }
';
        $buffer .= $indent . '                    html += \'</div></td></tr>\';
';
        $buffer .= $indent . '                });
';
        $buffer .= $indent . '                tbody.innerHTML = html;
';
        $buffer .= $indent . '                bindManageButtons();
';
        $buffer .= $indent . '            })
';
        $buffer .= $indent . '            .catch(function() {
';
        $buffer .= $indent . '                tbody.innerHTML = \'<tr><td colspan="7" class="text-center text-danger py-4">Error loading users</td></tr>\';
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Modal management ──
';
        $buffer .= $indent . '    var modal = document.getElementById(\'istikama-manage-modal\');
';
        $buffer .= $indent . '    var modalTitle = document.getElementById(\'istikama-modal-title\');
';
        $buffer .= $indent . '    var modalSubtitle = document.getElementById(\'istikama-modal-subtitle\');
';
        $buffer .= $indent . '    var modalBody = document.getElementById(\'istikama-modal-content\');
';
        $buffer .= $indent . '    var modalLoading = document.getElementById(\'istikama-modal-loading\');
';
        $buffer .= $indent . '    var modalFeedback = document.getElementById(\'istikama-modal-feedback\');
';
        $buffer .= $indent . '    var saveBtn = document.getElementById(\'istikama-modal-save-btn\');
';
        $buffer .= $indent . '    var currentUserId = null;
';
        $buffer .= $indent . '    var currentRoleType = null;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function openModal(userid, username, roletype) {
';
        $buffer .= $indent . '        currentUserId = userid;
';
        $buffer .= $indent . '        currentRoleType = roletype;
';
        $buffer .= $indent . '        modalTitle.textContent = STRINGS.manage_assignment;
';
        $buffer .= $indent . '        modalSubtitle.textContent = username;
';
        $buffer .= $indent . '        modalBody.style.display = \'none\';
';
        $buffer .= $indent . '        modalLoading.style.display = \'flex\';
';
        $buffer .= $indent . '        modalFeedback.style.display = \'none\';
';
        $buffer .= $indent . '        modal.style.display = \'flex\';
';
        $buffer .= $indent . '        modal.style.display = \'flex\';
';
        $buffer .= $indent . '        document.body.style.overflow = \'hidden\';
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        setTimeout(function() { modal.classList.add(\'visible\'); }, 10);
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // Load assignment data.
';
        $buffer .= $indent . '        var assignAction = IS_SCHOOL_MANAGER ? \'smgetuserassignment\' : \'getuserassignment\';
';
        $buffer .= $indent . '        var url = AJAX_URL + \'?action=\' + assignAction + \'&userid=\' + userid + \'&sesskey=\' + SESSKEY;
';
        $buffer .= $indent . '        fetch(url)
';
        $buffer .= $indent . '            .then(function(r) { return r.json(); })
';
        $buffer .= $indent . '            .then(function(data) {
';
        $buffer .= $indent . '                renderModalContent(data);
';
        $buffer .= $indent . '                modalLoading.style.display = \'none\';
';
        $buffer .= $indent . '                modalBody.style.display = \'block\';
';
        $buffer .= $indent . '            })
';
        $buffer .= $indent . '            .catch(function(err) {
';
        $buffer .= $indent . '                modalLoading.style.display = \'none\';
';
        $buffer .= $indent . '                modalBody.style.display = \'block\';
';
        $buffer .= $indent . '                modalBody.innerHTML = \'<div class="alert alert-danger">Error loading data</div>\';
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function closeModal() {
';
        $buffer .= $indent . '        modal.classList.remove(\'visible\');
';
        $buffer .= $indent . '        setTimeout(function() {
';
        $buffer .= $indent . '            modal.style.display = \'none\';
';
        $buffer .= $indent . '            document.body.style.overflow = \'\';
';
        $buffer .= $indent . '            modalBody.innerHTML = \'\';
';
        $buffer .= $indent . '        }, 300);
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    document.getElementById(\'istikama-modal-close\').addEventListener(\'click\', closeModal);
';
        $buffer .= $indent . '    document.getElementById(\'istikama-modal-cancel-btn\').addEventListener(\'click\', closeModal);
';
        $buffer .= $indent . '    modal.addEventListener(\'click\', function(e) {
';
        $buffer .= $indent . '        if (e.target === modal) closeModal();
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Render modal content based on role type ──
';
        $buffer .= $indent . '    function renderModalContent(data) {
';
        $buffer .= $indent . '        var rt = data.roletype || currentRoleType;
';
        $buffer .= $indent . '        currentRoleType = rt;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        if (rt === \'none\') {
';
        $buffer .= $indent . '            modalBody.innerHTML = \'<div class="istikama-no-role-notice"><i class="fa fa-exclamation-triangle"></i> \' + esc(STRINGS.no_role) + \'</div>\';
';
        $buffer .= $indent . '            saveBtn.style.display = \'none\';
';
        $buffer .= $indent . '            return;
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        saveBtn.style.display = \'\';
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        if (rt === \'student\') {
';
        $buffer .= $indent . '            modalTitle.innerHTML = \'<i class="fa fa-graduation-cap"></i> \' + esc(STRINGS.student_title);
';
        $buffer .= $indent . '            renderStudentForm(data);
';
        $buffer .= $indent . '        } else if (rt === \'teacher\') {
';
        $buffer .= $indent . '            modalTitle.innerHTML = \'<i class="fa fa-chalkboard-teacher"></i> \' + esc(STRINGS.teacher_title);
';
        $buffer .= $indent . '            renderTeacherForm(data);
';
        $buffer .= $indent . '        } else if (rt === \'technical_professor\') {
';
        $buffer .= $indent . '            modalTitle.innerHTML = \'<i class="fa fa-globe"></i> Technical Professor\';
';
        $buffer .= $indent . '            renderTechProfForm(data);
';
        $buffer .= $indent . '        } else if (rt === \'manager\') {
';
        $buffer .= $indent . '            modalTitle.innerHTML = \'<i class="fa fa-building"></i> \' + esc(STRINGS.manager_title);
';
        $buffer .= $indent . '            renderManagerForm(data);
';
        $buffer .= $indent . '        } else if (rt === \'parent\') {
';
        $buffer .= $indent . '            modalTitle.innerHTML = \'<i class="fa fa-user-friends"></i> \' + esc(STRINGS.parent_title);
';
        $buffer .= $indent . '            renderParentForm(data);
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Technical Professor form ──
';
        $buffer .= $indent . '    function renderTechProfForm(data) {
';
        $buffer .= $indent . '        var html = \'<div class="istikama-assignment-form">\';
';
        $buffer .= $indent . '        html += \'<div class="alert alert-info" style="background:#e0f2fe;color:#0369a1;border-color:#bae6fd;border-radius:12px;display:flex;align-items:center;gap:12px;padding:16px;">\';
';
        $buffer .= $indent . '        html += \'<i class="fa fa-info-circle" style="font-size:1.5rem"></i>\';
';
        $buffer .= $indent . '        html += \'<div><strong>Platform-wide Role</strong><br>Technical Professors manage content across all schools. They do not need to be assigned to specific schools or classes.</div>\';
';
        $buffer .= $indent . '        html += \'</div>\';
';
        $buffer .= $indent . '        html += \'</div>\';
';
        $buffer .= $indent . '        modalBody.innerHTML = html;
';
        $buffer .= $indent . '        saveBtn.style.display = \'none\'; // Nothing to save
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Student form ──
';
        $buffer .= $indent . '    function renderStudentForm(data) {
';
        $buffer .= $indent . '        var a = (data.assignments && data.assignments.length > 0) ? data.assignments[0] : null;
';
        $buffer .= $indent . '        var html = \'<div class="istikama-assignment-form">\';
';
        $buffer .= $indent . '        html += \'<div class="istikama-cascade-group">\';
';
        $buffer .= $indent . '        html += \'<div class="istikama-form-field"><label>\' + esc(STRINGS.assign_school) + \'</label>\';
';
        $buffer .= $indent . '        html += \'<select id="ism-student-school" class="form-select"><option value="">\' + esc(STRINGS.select_school) + \'</option></select></div>\';
';
        $buffer .= $indent . '        html += \'<div class="istikama-form-field"><label>\' + esc(STRINGS.assign_level) + \'</label>\';
';
        $buffer .= $indent . '        html += \'<select id="ism-student-level" class="form-select" disabled><option value="">\' + esc(STRINGS.select_level) + \'</option></select></div>\';
';
        $buffer .= $indent . '        html += \'<div class="istikama-form-field"><label>\' + esc(STRINGS.assign_class) + \'</label>\';
';
        $buffer .= $indent . '        html += \'<select id="ism-student-class" class="form-select" disabled><option value="">\' + esc(STRINGS.select_class) + \'</option></select></div>\';
';
        $buffer .= $indent . '        html += \'</div></div>\';
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        modalBody.innerHTML = html;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // Load schools and set current values.
';
        $buffer .= $indent . '        loadSchoolsInto(\'ism-student-school\', a ? a.schoolid : null, function() {
';
        $buffer .= $indent . '            if (a && a.schoolid) {
';
        $buffer .= $indent . '                loadLevelsInto(\'ism-student-level\', a.schoolid, a.levelid, function() {
';
        $buffer .= $indent . '                    if (a.levelid) {
';
        $buffer .= $indent . '                        loadClassesInto(\'ism-student-class\', a.levelid, a.classid);
';
        $buffer .= $indent . '                    }
';
        $buffer .= $indent . '                });
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // Wire cascading.
';
        $buffer .= $indent . '        document.getElementById(\'ism-student-school\').addEventListener(\'change\', function() {
';
        $buffer .= $indent . '            var sid = this.value;
';
        $buffer .= $indent . '            resetSelect(\'ism-student-level\', STRINGS.select_level);
';
        $buffer .= $indent . '            resetSelect(\'ism-student-class\', STRINGS.select_class);
';
        $buffer .= $indent . '            if (sid) loadLevelsInto(\'ism-student-level\', sid);
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '        document.getElementById(\'ism-student-level\').addEventListener(\'change\', function() {
';
        $buffer .= $indent . '            var lid = this.value;
';
        $buffer .= $indent . '            resetSelect(\'ism-student-class\', STRINGS.select_class);
';
        $buffer .= $indent . '            if (lid) loadClassesInto(\'ism-student-class\', lid);
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Teacher form ──
';
        $buffer .= $indent . '    function renderTeacherForm(data) {
';
        $buffer .= $indent . '        var html = \'<div class="istikama-assignment-form" id="ism-teacher-assignments">\';
';
        $buffer .= $indent . '        html += \'<div id="ism-teacher-list"></div>\';
';
        $buffer .= $indent . '        html += \'<button type="button" class="btn istikama-btn-add-assignment" id="ism-teacher-add"><i class="fa fa-plus"></i> \' + esc(STRINGS.add_class) + \'</button>\';
';
        $buffer .= $indent . '        html += \'</div>\';
';
        $buffer .= $indent . '        modalBody.innerHTML = html;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        var assignments = data.assignments || [];
';
        $buffer .= $indent . '        if (assignments.length === 0) {
';
        $buffer .= $indent . '            addTeacherRow(null);
';
        $buffer .= $indent . '        } else {
';
        $buffer .= $indent . '            assignments.forEach(function(a) { addTeacherRow(a); });
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        document.getElementById(\'ism-teacher-add\').addEventListener(\'click\', function() {
';
        $buffer .= $indent . '            addTeacherRow(null);
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    var teacherRowIdx = 0;
';
        $buffer .= $indent . '    function addTeacherRow(existingData) {
';
        $buffer .= $indent . '        var idx = teacherRowIdx++;
';
        $buffer .= $indent . '        var container = document.getElementById(\'ism-teacher-list\');
';
        $buffer .= $indent . '        var row = document.createElement(\'div\');
';
        $buffer .= $indent . '        row.className = \'istikama-teacher-row\';
';
        $buffer .= $indent . '        row.setAttribute(\'data-idx\', idx);
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        var html = \'<div class="istikama-teacher-row-header">\';
';
        $buffer .= $indent . '        html += \'<span class="istikama-teacher-row-num">#\' + (container.children.length + 1) + \'</span>\';
';
        $buffer .= $indent . '        html += \'<button type="button" class="istikama-teacher-row-remove" data-idx="\' + idx + \'"><i class="fa fa-trash"></i></button>\';
';
        $buffer .= $indent . '        html += \'</div>\';
';
        $buffer .= $indent . '        html += \'<div class="istikama-cascade-group">\';
';
        $buffer .= $indent . '        html += \'<div class="istikama-form-field"><label>\' + esc(STRINGS.assign_school) + \'</label>\';
';
        $buffer .= $indent . '        html += \'<select id="ism-t-school-\' + idx + \'" class="form-select ism-t-school"><option value="">\' + esc(STRINGS.select_school) + \'</option></select></div>\';
';
        $buffer .= $indent . '        html += \'<div class="istikama-form-field"><label>\' + esc(STRINGS.assign_level) + \'</label>\';
';
        $buffer .= $indent . '        html += \'<select id="ism-t-level-\' + idx + \'" class="form-select ism-t-level" disabled><option value="">\' + esc(STRINGS.select_level) + \'</option></select></div>\';
';
        $buffer .= $indent . '        html += \'<div class="istikama-form-field"><label>\' + esc(STRINGS.assign_class) + \'</label>\';
';
        $buffer .= $indent . '        html += \'<select id="ism-t-class-\' + idx + \'" class="form-select ism-t-class" disabled><option value="">\' + esc(STRINGS.select_class) + \'</option></select></div>\';
';
        $buffer .= $indent . '        html += \'</div>\';
';
        $buffer .= $indent . '        html += \'<div class="istikama-form-field"><label>\' + esc(STRINGS.assign_subjects) + \'</label>\';
';
        $buffer .= $indent . '        html += \'<div class="istikama-subject-chips" id="ism-t-subjects-\' + idx + \'">\';
';
        $buffer .= $indent . '        html += \'<span class="text-muted small">Select a class to view subjects.</span>\';
';
        $buffer .= $indent . '        html += \'</div></div>\';
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        row.innerHTML = html;
';
        $buffer .= $indent . '        container.appendChild(row);
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // Wire remove.
';
        $buffer .= $indent . '        row.querySelector(\'.istikama-teacher-row-remove\').addEventListener(\'click\', function() {
';
        $buffer .= $indent . '            if (container.children.length > 1) {
';
        $buffer .= $indent . '                row.remove();
';
        $buffer .= $indent . '                renumberTeacherRows();
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // Load schools.
';
        $buffer .= $indent . '        loadSchoolsInto(\'ism-t-school-\' + idx, existingData ? existingData.schoolid : null, function() {
';
        $buffer .= $indent . '            if (existingData && existingData.schoolid) {
';
        $buffer .= $indent . '                loadLevelsInto(\'ism-t-level-\' + idx, existingData.schoolid, existingData.levelid, function() {
';
        $buffer .= $indent . '                    if (existingData.levelid) {
';
        $buffer .= $indent . '                        loadClassesInto(\'ism-t-class-\' + idx, existingData.levelid, existingData.classid, function() {
';
        $buffer .= $indent . '                            if (existingData.classid) {
';
        $buffer .= $indent . '                                loadSubjectsInto(\'ism-t-subjects-\' + idx, existingData.classid, existingData.subjects || []);
';
        $buffer .= $indent . '                            }
';
        $buffer .= $indent . '                        });
';
        $buffer .= $indent . '                    }
';
        $buffer .= $indent . '                });
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // Wire cascading.
';
        $buffer .= $indent . '        document.getElementById(\'ism-t-school-\' + idx).addEventListener(\'change\', function() {
';
        $buffer .= $indent . '            var rowIdx = this.id.split(\'-\').pop();
';
        $buffer .= $indent . '            resetSelect(\'ism-t-level-\' + rowIdx, STRINGS.select_level);
';
        $buffer .= $indent . '            resetSelect(\'ism-t-class-\' + rowIdx, STRINGS.select_class);
';
        $buffer .= $indent . '            document.getElementById(\'ism-t-subjects-\' + rowIdx).innerHTML = \'<span class="text-muted small">Select a class to view subjects.</span>\';
';
        $buffer .= $indent . '            if (this.value) loadLevelsInto(\'ism-t-level-\' + rowIdx, this.value);
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '        document.getElementById(\'ism-t-level-\' + idx).addEventListener(\'change\', function() {
';
        $buffer .= $indent . '            var rowIdx = this.id.split(\'-\').pop();
';
        $buffer .= $indent . '            resetSelect(\'ism-t-class-\' + rowIdx, STRINGS.select_class);
';
        $buffer .= $indent . '            document.getElementById(\'ism-t-subjects-\' + rowIdx).innerHTML = \'<span class="text-muted small">Select a class to view subjects.</span>\';
';
        $buffer .= $indent . '            if (this.value) loadClassesInto(\'ism-t-class-\' + rowIdx, this.value);
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '        document.getElementById(\'ism-t-class-\' + idx).addEventListener(\'change\', function() {
';
        $buffer .= $indent . '            var rowIdx = this.id.split(\'-\').pop();
';
        $buffer .= $indent . '            var subContainer = document.getElementById(\'ism-t-subjects-\' + rowIdx);
';
        $buffer .= $indent . '            if (this.value) {
';
        $buffer .= $indent . '                subContainer.innerHTML = \'<span class="text-muted small"><i class="fa fa-spinner fa-spin"></i> Loading subjects...</span>\';
';
        $buffer .= $indent . '                loadSubjectsInto(\'ism-t-subjects-\' + rowIdx, this.value, []);
';
        $buffer .= $indent . '            } else {
';
        $buffer .= $indent . '                subContainer.innerHTML = \'<span class="text-muted small">Select a class to view subjects.</span>\';
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function renumberTeacherRows() {
';
        $buffer .= $indent . '        document.querySelectorAll(\'.istikama-teacher-row\').forEach(function(row, i) {
';
        $buffer .= $indent . '            row.querySelector(\'.istikama-teacher-row-num\').textContent = \'#\' + (i + 1);
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Manager form ──
';
        $buffer .= $indent . '    function renderManagerForm(data) {
';
        $buffer .= $indent . '        var html = \'<div class="istikama-assignment-form">\';
';
        $buffer .= $indent . '        html += \'<label class="istikama-form-label-main"><i class="fa fa-building"></i> \' + esc(STRINGS.managed_schools) + \'</label>\';
';
        $buffer .= $indent . '        html += \'<div class="istikama-manager-schools" id="ism-manager-schools"></div>\';
';
        $buffer .= $indent . '        html += \'</div>\';
';
        $buffer .= $indent . '        modalBody.innerHTML = html;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        var assignedSchools = (data.assignments || []).map(function(a) { return a.schoolid; });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // Load all schools as checkboxes.
';
        $buffer .= $indent . '        fetchData(\'getschools\', {}, function(schools) {
';
        $buffer .= $indent . '            var container = document.getElementById(\'ism-manager-schools\');
';
        $buffer .= $indent . '            if (!schools || schools.length === 0) {
';
        $buffer .= $indent . '                container.innerHTML = \'<div class="text-muted">No schools available</div>\';
';
        $buffer .= $indent . '                return;
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '            var html = \'\';
';
        $buffer .= $indent . '            schools.forEach(function(s) {
';
        $buffer .= $indent . '                var checked = assignedSchools.indexOf(s.id) >= 0;
';
        $buffer .= $indent . '                html += \'<label class="istikama-school-check\' + (checked ? \' active\' : \'\') + \'">\';
';
        $buffer .= $indent . '                html += \'<input type="checkbox" value="\' + s.id + \'"\' + (checked ? \' checked\' : \'\') + \'>\';
';
        $buffer .= $indent . '                html += \'<i class="fa fa-university"></i> \' + esc(s.name);
';
        $buffer .= $indent . '                html += \'</label>\';
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '            container.innerHTML = html;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '            container.querySelectorAll(\'.istikama-school-check input\').forEach(function(inp) {
';
        $buffer .= $indent . '                inp.addEventListener(\'change\', function() {
';
        $buffer .= $indent . '                    this.parentElement.classList.toggle(\'active\', this.checked);
';
        $buffer .= $indent . '                });
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Parent form ──
';
        $buffer .= $indent . '    function renderParentForm(data) {
';
        $buffer .= $indent . '        var students = data.students || [];
';
        $buffer .= $indent . '        var childIds = data.childIds || [];
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        var html = \'<div class="istikama-assignment-form">\';
';
        $buffer .= $indent . '        html += \'<div class="istikama-form-field" style="margin-bottom:16px;">\';
';
        $buffer .= $indent . '        html += \'<div style="position:relative;">\';
';
        $buffer .= $indent . '        html += \'<i class="fa fa-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#adb5bd;"></i>\';
';
        $buffer .= $indent . '        html += \'<input type="text" id="ism-parent-search" class="form-control" placeholder="\' + esc(STRINGS.parent_search) + \'" style="padding-left:36px;border-radius:8px;">\';
';
        $buffer .= $indent . '        html += \'</div></div>\';
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        if (students.length === 0) {
';
        $buffer .= $indent . '            html += \'<div class="text-muted text-center py-4"><i class="fa fa-info-circle"></i> \' + esc(STRINGS.parent_no_students) + \'</div>\';
';
        $buffer .= $indent . '        } else {
';
        $buffer .= $indent . '            html += \'<div id="ism-parent-students" style="max-height:380px;overflow-y:auto;">\';
';
        $buffer .= $indent . '            students.forEach(function(s) {
';
        $buffer .= $indent . '                var checked = s.assigned ? \' checked\' : \'\';
';
        $buffer .= $indent . '                var badgeHtml = s.linked_to_others
';
        $buffer .= $indent . '                    ? \' <span class="badge" style="background:#fff3cd;color:#856404;font-size:11px;padding:2px 8px;border-radius:10px;margin-left:6px;"><i class="fa fa-link"></i> \' + esc(STRINGS.parent_linked) + \'</span>\'
';
        $buffer .= $indent . '                    : \'\';
';
        $buffer .= $indent . '                html += \'<label class="istikama-parent-student-row\' + (s.assigned ? \' active\' : \'\') + \'" data-name="\' + esc(s.name.toLowerCase()) + \'" style="display:flex;align-items:center;gap:10px;padding:10px 14px;margin-bottom:4px;border-radius:8px;cursor:pointer;border:1px solid \' + (s.assigned ? \'#0d6efd\' : \'#e9ecef\') + \';background:\' + (s.assigned ? \'#f0f6ff\' : \'#fff\') + \';transition:all .2s;">\';
';
        $buffer .= $indent . '                html += \'<input type="checkbox" value="\' + s.id + \'"\' + checked + \' style="width:18px;height:18px;accent-color:#0d6efd;">\';
';
        $buffer .= $indent . '                html += \'<div style="flex:1;min-width:0;">\';
';
        $buffer .= $indent . '                html += \'<div style="font-weight:600;font-size:14px;">\' + esc(s.name) + badgeHtml + \'</div>\';
';
        $buffer .= $indent . '                html += \'<div style="font-size:12px;color:#6c757d;">\' + esc(s.email) + \'</div>\';
';
        $buffer .= $indent . '                html += \'</div></label>\';
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '            html += \'</div>\';
';
        $buffer .= $indent . '            html += \'<div style="margin-top:10px;font-size:13px;color:#6c757d;text-align:right;" id="ism-parent-count">\';
';
        $buffer .= $indent . '            var assignedCount = students.filter(function(s) { return s.assigned; }).length;
';
        $buffer .= $indent . '            html += \'<i class="fa fa-check-circle" style="color:#198754;"></i> \' + assignedCount + \' student(s) selected\';
';
        $buffer .= $indent . '            html += \'</div>\';
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '        html += \'</div>\';
';
        $buffer .= $indent . '        modalBody.innerHTML = html;
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // Wire search filter.
';
        $buffer .= $indent . '        var searchInput = document.getElementById(\'ism-parent-search\');
';
        $buffer .= $indent . '        if (searchInput) {
';
        $buffer .= $indent . '            searchInput.addEventListener(\'input\', function() {
';
        $buffer .= $indent . '                var query = this.value.toLowerCase().trim();
';
        $buffer .= $indent . '                document.querySelectorAll(\'.istikama-parent-student-row\').forEach(function(row) {
';
        $buffer .= $indent . '                    var name = row.getAttribute(\'data-name\') || \'\';
';
        $buffer .= $indent . '                    row.style.display = name.indexOf(query) >= 0 ? \'\' : \'none\';
';
        $buffer .= $indent . '                });
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        // Wire checkbox visual toggle + count update.
';
        $buffer .= $indent . '        var container = document.getElementById(\'ism-parent-students\');
';
        $buffer .= $indent . '        if (container) {
';
        $buffer .= $indent . '            container.querySelectorAll(\'input[type=checkbox]\').forEach(function(cb) {
';
        $buffer .= $indent . '                cb.addEventListener(\'change\', function() {
';
        $buffer .= $indent . '                    var row = this.closest(\'.istikama-parent-student-row\');
';
        $buffer .= $indent . '                    if (this.checked) {
';
        $buffer .= $indent . '                        row.classList.add(\'active\');
';
        $buffer .= $indent . '                        row.style.borderColor = \'#0d6efd\';
';
        $buffer .= $indent . '                        row.style.background = \'#f0f6ff\';
';
        $buffer .= $indent . '                    } else {
';
        $buffer .= $indent . '                        row.classList.remove(\'active\');
';
        $buffer .= $indent . '                        row.style.borderColor = \'#e9ecef\';
';
        $buffer .= $indent . '                        row.style.background = \'#fff\';
';
        $buffer .= $indent . '                    }
';
        $buffer .= $indent . '                    // Update count.
';
        $buffer .= $indent . '                    var count = container.querySelectorAll(\'input[type=checkbox]:checked\').length;
';
        $buffer .= $indent . '                    var countEl = document.getElementById(\'ism-parent-count\');
';
        $buffer .= $indent . '                    if (countEl) {
';
        $buffer .= $indent . '                        countEl.innerHTML = \'<i class="fa fa-check-circle" style="color:#198754;"></i> \' + count + \' student(s) selected\';
';
        $buffer .= $indent . '                    }
';
        $buffer .= $indent . '                });
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Save handler ──
';
        $buffer .= $indent . '    saveBtn.addEventListener(\'click\', function() {
';
        $buffer .= $indent . '        saveBtn.disabled = true;
';
        $buffer .= $indent . '        saveBtn.innerHTML = \'<i class="fa fa-spinner fa-spin"></i> \' + esc(STRINGS.saving);
';
        $buffer .= $indent . '        modalFeedback.style.display = \'none\';
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        var payload = {};
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        if (currentRoleType === \'student\') {
';
        $buffer .= $indent . '            payload = {
';
        $buffer .= $indent . '                schoolid: val(\'ism-student-school\'),
';
        $buffer .= $indent . '                levelid: val(\'ism-student-level\'),
';
        $buffer .= $indent . '                classid: val(\'ism-student-class\')
';
        $buffer .= $indent . '            };
';
        $buffer .= $indent . '        } else if (currentRoleType === \'teacher\') {
';
        $buffer .= $indent . '            var assignments = [];
';
        $buffer .= $indent . '            document.querySelectorAll(\'.istikama-teacher-row\').forEach(function(row) {
';
        $buffer .= $indent . '                var rowIdx = row.getAttribute(\'data-idx\');
';
        $buffer .= $indent . '                var subjects = [];
';
        $buffer .= $indent . '                row.querySelectorAll(\'.istikama-chip input:checked\').forEach(function(inp) {
';
        $buffer .= $indent . '                    subjects.push(inp.value);
';
        $buffer .= $indent . '                });
';
        $buffer .= $indent . '                assignments.push({
';
        $buffer .= $indent . '                    schoolid: val(\'ism-t-school-\' + rowIdx),
';
        $buffer .= $indent . '                    levelid: val(\'ism-t-level-\' + rowIdx),
';
        $buffer .= $indent . '                    classid: val(\'ism-t-class-\' + rowIdx),
';
        $buffer .= $indent . '                    subjects: subjects
';
        $buffer .= $indent . '                });
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '            payload = { assignments: assignments };
';
        $buffer .= $indent . '        } else if (currentRoleType === \'manager\') {
';
        $buffer .= $indent . '            var schoolids = [];
';
        $buffer .= $indent . '            document.querySelectorAll(\'#ism-manager-schools input:checked\').forEach(function(inp) {
';
        $buffer .= $indent . '                schoolids.push(parseInt(inp.value));
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '            payload = { schoolids: schoolids };
';
        $buffer .= $indent . '        } else if (currentRoleType === \'parent\') {
';
        $buffer .= $indent . '            var studentIds = [];
';
        $buffer .= $indent . '            var parentContainer = document.getElementById(\'ism-parent-students\');
';
        $buffer .= $indent . '            if (parentContainer) {
';
        $buffer .= $indent . '                parentContainer.querySelectorAll(\'input[type=checkbox]:checked\').forEach(function(inp) {
';
        $buffer .= $indent . '                    studentIds.push(parseInt(inp.value));
';
        $buffer .= $indent . '                });
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '            payload = { studentIds: studentIds };
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        var formData = new FormData();
';
        $buffer .= $indent . '        formData.append(\'action\', IS_SCHOOL_MANAGER ? \'smsaveuserassignment\' : \'saveuserassignment\');
';
        $buffer .= $indent . '        formData.append(\'sesskey\', SESSKEY);
';
        $buffer .= $indent . '        formData.append(\'userid\', currentUserId);
';
        $buffer .= $indent . '        formData.append(\'roletype\', currentRoleType);
';
        $buffer .= $indent . '        formData.append(\'data\', JSON.stringify(payload));
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '        fetch(AJAX_URL, { method: \'POST\', body: formData })
';
        $buffer .= $indent . '            .then(function(r) { return r.json(); })
';
        $buffer .= $indent . '            .then(function(result) {
';
        $buffer .= $indent . '                saveBtn.disabled = false;
';
        $buffer .= $indent . '                saveBtn.innerHTML = \'<i class="fa fa-check"></i> \' + esc(STRINGS.save_changes);
';
        $buffer .= $indent . '                if (result.success) {
';
        $buffer .= $indent . '                    showFeedback(STRINGS.assignment_saved, \'success\');
';
        $buffer .= $indent . '                    // Refresh tab if active
';
        $buffer .= $indent . '                    if (currentTab !== \'all\') {
';
        $buffer .= $indent . '                        setTimeout(function() { loadUsersForTab(currentTab); }, 800);
';
        $buffer .= $indent . '                    }
';
        $buffer .= $indent . '                } else {
';
        $buffer .= $indent . '                    showFeedback(result.error || STRINGS.assignment_error, \'error\');
';
        $buffer .= $indent . '                }
';
        $buffer .= $indent . '            })
';
        $buffer .= $indent . '            .catch(function() {
';
        $buffer .= $indent . '                saveBtn.disabled = false;
';
        $buffer .= $indent . '                saveBtn.innerHTML = \'<i class="fa fa-check"></i> \' + esc(STRINGS.save_changes);
';
        $buffer .= $indent . '                showFeedback(STRINGS.assignment_error, \'error\');
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '    });
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function showFeedback(msg, type) {
';
        $buffer .= $indent . '        modalFeedback.textContent = msg;
';
        $buffer .= $indent . '        modalFeedback.className = \'istikama-modal-feedback istikama-feedback-\' + type;
';
        $buffer .= $indent . '        modalFeedback.style.display = \'block\';
';
        $buffer .= $indent . '        setTimeout(function() { modalFeedback.style.display = \'none\'; }, 4000);
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Utility functions ──
';
        $buffer .= $indent . '    function fetchData(action, params, cb) {
';
        $buffer .= $indent . '        var url = AJAX_URL + \'?action=\' + action + \'&sesskey=\' + SESSKEY;
';
        $buffer .= $indent . '        for (var k in params) {
';
        $buffer .= $indent . '            url += \'&\' + k + \'=\' + encodeURIComponent(params[k]);
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '        fetch(url)
';
        $buffer .= $indent . '            .then(function(r) { return r.json(); })
';
        $buffer .= $indent . '            .then(cb)
';
        $buffer .= $indent . '            .catch(function() { cb([]); });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function loadSchoolsInto(selectId, selectedVal, cb) {
';
        $buffer .= $indent . '        if (IS_SCHOOL_MANAGER) {
';
        $buffer .= $indent . '            // School manager: pre-fill with their single school.
';
        $buffer .= $indent . '            var sel = document.getElementById(selectId);
';
        $buffer .= $indent . '            if (!sel) return;
';
        $buffer .= $indent . '            sel.innerHTML = \'<option value="\' + MANAGER_SCHOOLID + \'" selected>\' + esc(MANAGER_SCHOOLNAME) + \'</option>\';
';
        $buffer .= $indent . '            sel.disabled = true;
';
        $buffer .= $indent . '            if (cb) cb();
';
        $buffer .= $indent . '            return;
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '        fetchData(\'getschools\', {}, function(schools) {
';
        $buffer .= $indent . '            var sel = document.getElementById(selectId);
';
        $buffer .= $indent . '            if (!sel) return;
';
        $buffer .= $indent . '            var html = \'<option value="">\' + esc(STRINGS.select_school) + \'</option>\';
';
        $buffer .= $indent . '            schools.forEach(function(s) {
';
        $buffer .= $indent . '                html += \'<option value="\' + s.id + \'"\' + (selectedVal && s.id == selectedVal ? \' selected\' : \'\') + \'>\' + esc(s.name) + \'</option>\';
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '            sel.innerHTML = html;
';
        $buffer .= $indent . '            sel.disabled = false;
';
        $buffer .= $indent . '            if (cb) cb();
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function loadLevelsInto(selectId, schoolid, selectedVal, cb) {
';
        $buffer .= $indent . '        var sel = document.getElementById(selectId);
';
        $buffer .= $indent . '        sel.disabled = true;
';
        $buffer .= $indent . '        sel.innerHTML = \'<option value="">...</option>\';
';
        $buffer .= $indent . '        var levelAction = IS_SCHOOL_MANAGER ? \'smgetlevels\' : \'getlevels\';
';
        $buffer .= $indent . '        var levelParams = IS_SCHOOL_MANAGER ? {} : { schoolid: schoolid };
';
        $buffer .= $indent . '        fetchData(levelAction, levelParams, function(levels) {
';
        $buffer .= $indent . '            var html = \'<option value="">\' + esc(STRINGS.select_level) + \'</option>\';
';
        $buffer .= $indent . '            levels.forEach(function(l) {
';
        $buffer .= $indent . '                html += \'<option value="\' + l.id + \'"\' + (selectedVal && l.id == selectedVal ? \' selected\' : \'\') + \'>\' + esc(l.name) + \'</option>\';
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '            sel.innerHTML = html;
';
        $buffer .= $indent . '            sel.disabled = false;
';
        $buffer .= $indent . '            if (cb) cb();
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function loadClassesInto(selectId, levelid, selectedVal, cb) {
';
        $buffer .= $indent . '        var sel = document.getElementById(selectId);
';
        $buffer .= $indent . '        sel.disabled = true;
';
        $buffer .= $indent . '        sel.innerHTML = \'<option value="">...</option>\';
';
        $buffer .= $indent . '        var classAction = IS_SCHOOL_MANAGER ? \'smgetclasses\' : \'getclasses\';
';
        $buffer .= $indent . '        fetchData(classAction, { levelid: levelid }, function(classes) {
';
        $buffer .= $indent . '            var html = \'<option value="">\' + esc(STRINGS.select_class) + \'</option>\';
';
        $buffer .= $indent . '            classes.forEach(function(c) {
';
        $buffer .= $indent . '                html += \'<option value="\' + c.id + \'"\' + (selectedVal && c.id == selectedVal ? \' selected\' : \'\') + \'>\' + esc(c.name) + \'</option>\';
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '            sel.innerHTML = html;
';
        $buffer .= $indent . '            sel.disabled = false;
';
        $buffer .= $indent . '            if (cb) cb();
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function loadSubjectsInto(containerId, classid, selectedIds) {
';
        $buffer .= $indent . '        var container = document.getElementById(containerId);
';
        $buffer .= $indent . '        if (!classid || !container) return;
';
        $buffer .= $indent . '        fetchData(\'getsubjects\', { classid: classid }, function(subjects) {
';
        $buffer .= $indent . '            if (!subjects || subjects.length === 0) {
';
        $buffer .= $indent . '                container.innerHTML = \'<span class="text-muted small">No subjects assigned for this class.</span>\';
';
        $buffer .= $indent . '                return;
';
        $buffer .= $indent . '            }
';
        $buffer .= $indent . '            var html = \'\';
';
        $buffer .= $indent . '            subjects.forEach(function(s) {
';
        $buffer .= $indent . '                // Ensure correct comparison (strings to strings)
';
        $buffer .= $indent . '                var sIdStr = String(s.id);
';
        $buffer .= $indent . '                var checked = selectedIds.some(function(selId) { return String(selId) === sIdStr; });
';
        $buffer .= $indent . '                html += \'<label class="istikama-chip\' + (checked ? \' active\' : \'\') + \'">\';
';
        $buffer .= $indent . '                html += \'<input type="checkbox" value="\' + esc(s.id) + \'"\' + (checked ? \' checked\' : \'\') + \'> <i class="fa fa-book mr-1"></i> \' + esc(s.name);
';
        $buffer .= $indent . '                html += \'</label>\';
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '            container.innerHTML = html;
';
        $buffer .= $indent . '            // Wire chip toggles
';
        $buffer .= $indent . '            container.querySelectorAll(\'.istikama-chip input\').forEach(function(inp) {
';
        $buffer .= $indent . '                inp.addEventListener(\'change\', function() {
';
        $buffer .= $indent . '                    this.parentElement.classList.toggle(\'active\', this.checked);
';
        $buffer .= $indent . '                });
';
        $buffer .= $indent . '            });
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function resetSelect(selectId, placeholder) {
';
        $buffer .= $indent . '        var sel = document.getElementById(selectId);
';
        $buffer .= $indent . '        if (sel) {
';
        $buffer .= $indent . '            sel.innerHTML = \'<option value="">\' + esc(placeholder) + \'</option>\';
';
        $buffer .= $indent . '            sel.disabled = true;
';
        $buffer .= $indent . '        }
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function val(id) {
';
        $buffer .= $indent . '        var el = document.getElementById(id);
';
        $buffer .= $indent . '        return el ? el.value : \'\';
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function esc(str) {
';
        $buffer .= $indent . '        if (!str) return \'\';
';
        $buffer .= $indent . '        var div = document.createElement(\'div\');
';
        $buffer .= $indent . '        div.appendChild(document.createTextNode(str));
';
        $buffer .= $indent . '        return div.innerHTML;
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // ── Bind manage buttons ──
';
        $buffer .= $indent . '    function bindManageButtons() {
';
        $buffer .= $indent . '        document.querySelectorAll(\'.istikama-btn-manage\').forEach(function(btn) {
';
        $buffer .= $indent . '            btn.removeEventListener(\'click\', handleManageClick);
';
        $buffer .= $indent . '            btn.addEventListener(\'click\', handleManageClick);
';
        $buffer .= $indent . '        });
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    function handleManageClick() {
';
        $buffer .= $indent . '        var uid = this.getAttribute(\'data-userid\');
';
        $buffer .= $indent . '        var uname = this.getAttribute(\'data-username\');
';
        $buffer .= $indent . '        var rtype = this.getAttribute(\'data-roletype\');
';
        $buffer .= $indent . '        teacherRowIdx = 0;
';
        $buffer .= $indent . '        openModal(uid, uname, rtype);
';
        $buffer .= $indent . '    }
';
        $buffer .= $indent . '
';
        $buffer .= $indent . '    // Initial binding.
';
        $buffer .= $indent . '    bindManageButtons();
';
        $buffer .= $indent . '});
';
        $buffer .= $indent . '</script>
';

        return $buffer;
    }

    private function section5a2db0676bee2c7837e95fc3c2fc900f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'filter_search, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'filter_search, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section1b1303bc9d8aae75a38041554362b1ac(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'filter_role, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'filter_role, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section9e2875c627d2dbad7c957250bbb623f7(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'selected';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'selected';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section6d4cd8d98fa5934ffa14d8de912070e8(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                <option value="{{value}}" {{#selected}}selected{{/selected}}>{{label}}</option>
                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                <option value="';
                $value = $this->resolveValue($context->find('value'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" ';
                $value = $context->find('selected');
                $buffer .= $this->section9e2875c627d2dbad7c957250bbb623f7($context, $indent, $value);
                $buffer .= '>';
                $value = $this->resolveValue($context->find('label'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</option>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section836e27aad3ca4bc3159039f99fb8024b(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'filter_school, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'filter_school, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section81355c07e089f3ee516573fa88aa1e64(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'filter_apply, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'filter_apply, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionAc345f5e6a9b3961a88bd2bb0bbb53fe(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                <option value="{{value}}">{{label}}</option>
                ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                <option value="';
                $value = $this->resolveValue($context->find('value'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">';
                $value = $this->resolveValue($context->find('label'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</option>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionF7ab17d2acc0df3c2f40daad8949437f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'action_assign_role, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'action_assign_role, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section8490ae99b040899425757f98803c67d6(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'action_export_selected, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'action_export_selected, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section56969744b7561d447791b1fcb4af3f50(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'name, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'name, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section2ab85814230c071671904f891eecb590(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'email, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'email, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section79c57a23a0789f52a124f2a15f20c965(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'role, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'role, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section52030fc5bea44c625e063d9e9632d969(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'school, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'school, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section90c1466789642bab0844286a3a534a1a(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'lastlogin, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'lastlogin, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section0370c9d783a80c5514faa7926dafeb3e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'actions, local_istikama_admin';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'actions, local_istikama_admin';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function sectionD76c1d539fec21fd3b43144233f10c64(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '
                            <tr data-userid="{{id}}" data-roletype="{{role_type}}">
                                <td style="border-left: none; border-right: none;"><input type="checkbox" name="selectedusers[]" value="{{id}}" class="istikama-user-checkbox"></td>
                                <td style="border-left: none; border-right: none;"><strong>{{name}}</strong></td>
                                <td style="border-left: none; border-right: none;"><span class="isti-kpi-label">{{email}}</span></td>
                                <td style="border-left: none; border-right: none;"><span class="istikama-role-badge istikama-role-{{role_type}}">{{role}}</span></td>
                                <td style="border-left: none; border-right: none;">{{{school}}}</td>
                                <td style="border-left: none; border-right: none;">{{lastlogin}}</td>
                                <td style="border-left: none; border-right: none;">
                                    <div style="display: flex; justify-content: center; gap: 8px;">
                                        <button type="button" class="isti-action-btn istikama-btn-manage" data-userid="{{id}}" data-username="{{name}}" data-roletype="{{role_type}}" title="{{str_manage}}">
                                            <i class="fa fa-cog"></i>
                                        </button>
                                        <a href="{{editurl}}" class="isti-action-btn" title="Edit">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>
                                        <a href="{{viewurl}}" class="isti-action-btn" title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        {{^is_school_manager}}
                                        <a href="{{deleteurl}}" class="isti-action-btn delete-btn" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                        {{/is_school_manager}}
                                    </div>
                                </td>
                            </tr>
                            ';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= $indent . '                            <tr data-userid="';
                $value = $this->resolveValue($context->find('id'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" data-roletype="';
                $value = $this->resolveValue($context->find('role_type'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">
';
                $buffer .= $indent . '                                <td style="border-left: none; border-right: none;"><input type="checkbox" name="selectedusers[]" value="';
                $value = $this->resolveValue($context->find('id'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" class="istikama-user-checkbox"></td>
';
                $buffer .= $indent . '                                <td style="border-left: none; border-right: none;"><strong>';
                $value = $this->resolveValue($context->find('name'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</strong></td>
';
                $buffer .= $indent . '                                <td style="border-left: none; border-right: none;"><span class="isti-kpi-label">';
                $value = $this->resolveValue($context->find('email'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</span></td>
';
                $buffer .= $indent . '                                <td style="border-left: none; border-right: none;"><span class="istikama-role-badge istikama-role-';
                $value = $this->resolveValue($context->find('role_type'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">';
                $value = $this->resolveValue($context->find('role'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</span></td>
';
                $buffer .= $indent . '                                <td style="border-left: none; border-right: none;">';
                $value = $this->resolveValue($context->find('school'), $context);
                $buffer .= ($value === null ? '' : $value);
                $buffer .= '</td>
';
                $buffer .= $indent . '                                <td style="border-left: none; border-right: none;">';
                $value = $this->resolveValue($context->find('lastlogin'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '</td>
';
                $buffer .= $indent . '                                <td style="border-left: none; border-right: none;">
';
                $buffer .= $indent . '                                    <div style="display: flex; justify-content: center; gap: 8px;">
';
                $buffer .= $indent . '                                        <button type="button" class="isti-action-btn istikama-btn-manage" data-userid="';
                $value = $this->resolveValue($context->find('id'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" data-username="';
                $value = $this->resolveValue($context->find('name'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" data-roletype="';
                $value = $this->resolveValue($context->find('role_type'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" title="';
                $value = $this->resolveValue($context->find('str_manage'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '">
';
                $buffer .= $indent . '                                            <i class="fa fa-cog"></i>
';
                $buffer .= $indent . '                                        </button>
';
                $buffer .= $indent . '                                        <a href="';
                $value = $this->resolveValue($context->find('editurl'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" class="isti-action-btn" title="Edit">
';
                $buffer .= $indent . '                                            <i class="fa fa-pencil-alt"></i>
';
                $buffer .= $indent . '                                        </a>
';
                $buffer .= $indent . '                                        <a href="';
                $value = $this->resolveValue($context->find('viewurl'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $buffer .= '" class="isti-action-btn" title="View">
';
                $buffer .= $indent . '                                            <i class="fa fa-eye"></i>
';
                $buffer .= $indent . '                                        </a>
';
                $value = $context->find('is_school_manager');
                if (empty($value)) {
                    
                    $buffer .= $indent . '                                        <a href="';
                    $value = $this->resolveValue($context->find('deleteurl'), $context);
                    $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                    $buffer .= '" class="isti-action-btn delete-btn" title="Delete">
';
                    $buffer .= $indent . '                                            <i class="fa fa-trash"></i>
';
                    $buffer .= $indent . '                                        </a>
';
                }
                $buffer .= $indent . '                                    </div>
';
                $buffer .= $indent . '                                </td>
';
                $buffer .= $indent . '                            </tr>
';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section03a2cb78adf693fb240638cbbc7ea15e(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = 'true';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $buffer .= 'true';
                $context->pop();
            }
        }
    
        return $buffer;
    }

    private function section6a11eb7dd252f61029b41613dd21670f(Mustache_Context $context, $indent, $value)
    {
        $buffer = '';
    
        if (!is_string($value) && is_callable($value)) {
            $source = '{{manager_schoolid}}';
            $result = (string) call_user_func($value, $source, $this->lambdaHelper);
            $buffer .= $result;
        } elseif (!empty($value)) {
            $values = $this->isIterable($value) ? $value : array($value);
            foreach ($values as $value) {
                $context->push($value);
                
                $value = $this->resolveValue($context->find('manager_schoolid'), $context);
                $buffer .= ($value === null ? '' : call_user_func($this->mustache->getEscape(), $value));
                $context->pop();
            }
        }
    
        return $buffer;
    }

}
