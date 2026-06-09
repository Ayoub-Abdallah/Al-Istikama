<?php
$string['pluginname'] = 'Istikama administration';
$string['menu_dashboard'] = 'Home';
$string['menu_users'] = 'Users';
$string['menu_contentbank'] = 'Library';
$string['menu_reports'] = 'Reports';
$string['menu_siteadmin'] = 'Settings';
$string['menu_support'] = 'Support';
$string['users_title'] = 'Users';
$string['contentbank_title'] = 'Library';
$string['reports_title'] = 'Reports dashboard';
$string['support_title'] = 'Technical support';

// ═══ Support / Ticketing System ═══
$string['menu_support_admin']        = 'Support center';
$string['support_my_tickets']        = 'My tickets';
$string['support_all_tickets']       = 'All tickets';
$string['support_new_ticket']        = 'New ticket';
$string['support_create_btn']        = 'Open ticket';
$string['support_ticket_subject']    = 'Subject';
$string['support_ticket_subject_ph'] = 'A short, descriptive title for the issue';
$string['support_ticket_message']    = 'Describe the issue';
$string['support_ticket_message_ph'] = 'Be as specific as possible — what were you trying to do, what happened instead, and any error messages.';
$string['support_ticket_category']   = 'Category';
$string['support_ticket_priority']   = 'Priority';
$string['support_ticket_attachments']= 'Attach screenshots or files';
$string['support_no_tickets']        = 'No tickets yet';
$string['support_no_tickets_msg']    = 'When you open a support ticket, it appears here with its status and the response from our team.';
$string['support_no_tickets_admin']  = 'No tickets in the system yet.';
$string['support_filters']           = 'Filters';
$string['support_filter_status']     = 'Status';
$string['support_filter_category']   = 'Category';
$string['support_filter_priority']   = 'Priority';
$string['support_filter_search']     = 'Search';
$string['support_filter_search_ph']  = 'Search subject or body…';
$string['support_filter_apply']      = 'Apply';
$string['support_filter_reset']      = 'Reset';
$string['support_filter_all']        = 'All';
$string['support_filter_mine']       = 'Assigned to me';

$string['support_table_subject']     = 'Subject';
$string['support_table_status']      = 'Status';
$string['support_table_category']    = 'Category';
$string['support_table_priority']    = 'Priority';
$string['support_table_user']        = 'Submitted by';
$string['support_table_assigned']    = 'Assigned';
$string['support_table_updated']     = 'Last update';
$string['support_table_messages']    = 'Replies';
$string['support_unassigned']        = 'Unassigned';
$string['support_assigned_to']       = 'Assigned to {$a}';

// Lifecycle status labels
$string['support_status_open']         = 'Open';
$string['support_status_under_review'] = 'Under review';
$string['support_status_in_progress']  = 'In progress';
$string['support_status_waiting_user'] = 'Waiting for user';
$string['support_status_resolved']     = 'Resolved';
$string['support_status_rejected']     = 'Rejected';
$string['support_status_closed']       = 'Closed';
$string['support_status_changed_to']   = 'Status changed to: {$a}';

// Categories
$string['support_cat_bug']     = 'Bug / Something broken';
$string['support_cat_feature'] = 'Feature request';
$string['support_cat_access']  = 'Access / Login issue';
$string['support_cat_content'] = 'Content / Library issue';
$string['support_cat_account'] = 'Account / Profile';
$string['support_cat_other']   = 'Other';

// Priorities
$string['support_prio_low']    = 'Low';
$string['support_prio_normal'] = 'Normal';
$string['support_prio_high']   = 'High';
$string['support_prio_urgent'] = 'Urgent';

// Ticket detail page
$string['support_ticket_title']         = 'Ticket #{$a}';
$string['support_back_to_list']         = 'Back to tickets';
$string['support_opened_by']            = 'Opened by';
$string['support_opened_at']            = 'Opened';
$string['support_last_updated']         = 'Updated';
$string['support_reply_label']          = 'Reply';
$string['support_reply_ph']             = 'Write your reply…';
$string['support_reply_btn']            = 'Send reply';
$string['support_internal_note_label']  = 'Internal staff note';
$string['support_internal_note_ph']     = 'Visible only to support staff — not shown to the user.';
$string['support_internal_note_btn']    = 'Save internal note';
$string['support_internal_only']        = 'Internal — not visible to user';
$string['support_system_message']       = 'System';
$string['support_change_status']        = 'Change status';
$string['support_assign_to']            = 'Assign to';
$string['support_attachments_label']    = 'Attachments';
$string['support_no_attachments']       = 'No attachments';
$string['support_view_ticket']          = 'Open ticket';
$string['support_ticket_closed_notice'] = 'This ticket is closed. To continue this conversation, please open a new ticket.';

// Empty/error states
$string['support_subject_body_required'] = 'A subject and a description are required.';
$string['support_message_required']      = 'A reply message is required.';
$string['support_invalid_status']        = 'Invalid status value.';
$string['support_save_done']             = 'Ticket saved.';
$string['support_created_done']          = 'Your ticket was submitted. The team will respond as soon as possible.';
$string['support_reply_sent']            = 'Reply sent.';

// Admin dashboard
$string['support_admin_title']           = 'Support center';
$string['support_admin_subtitle']        = 'Track, prioritize, and resolve every issue raised across the platform.';
$string['support_kpi_total']             = 'Total tickets';
$string['support_kpi_open']              = 'Open';
$string['support_kpi_resolved']          = 'Resolved';
$string['support_kpi_urgent']            = 'Urgent / high';
$string['support_kpi_avg_resolve']       = 'Avg. resolve (hrs)';
$string['support_kpi_recent_7d']         = 'New (7d)';
$string['support_breakdown_status']      = 'By status';
$string['support_breakdown_category']    = 'By category';
$string['support_breakdown_role']        = 'By role';

// Notifications
$string['support_notify_new_subject']    = 'New support ticket';
$string['support_notify_new_body']       = '{$a->author} opened a ticket: "{$a->subject}"';
$string['support_notify_reply_subject']  = 'New reply on your ticket';
$string['support_notify_reply_body']     = '{$a->author} replied on ticket "{$a->subject}"';
$string['support_notify_status_subject'] = 'Ticket status updated';
$string['support_notify_status_body']    = 'Your ticket "{$a->subject}" is now: {$a->status}';

// CRUD strings
$string['support_edit_ticket']     = 'Edit ticket';
$string['support_delete_ticket']   = 'Delete ticket';
$string['support_save_changes']    = 'Save changes';
$string['support_cancel']          = 'Cancel';
$string['support_delete_confirm']  = 'Delete this ticket permanently? This cannot be undone.';
$string['support_deleted_done']    = 'Ticket deleted.';
$string['support_updated_done']    = 'Ticket updated.';
$string['support_locked_for_edit'] = 'You can no longer edit this ticket — staff have already started handling it.';
$string['support_audit_edited']    = 'Ticket details edited by the submitter.';
$string['support_action_view']     = 'View';
$string['support_action_edit']     = 'Edit';
$string['support_action_delete']   = 'Delete';
$string['filter_role'] = 'Role';
$string['filter_school'] = 'School';
$string['filter_search'] = 'Search';
$string['filter_apply'] = 'Apply';
$string['filter_reset'] = 'Reset';
$string['export_csv'] = 'Export CSV';
$string['bulk_actions'] = 'Bulk actions';
$string['action_assign_role'] = 'Assign role';
$string['action_export_selected'] = 'Export selected';
$string['name'] = 'Name';
$string['email'] = 'Email';
$string['role'] = 'Role';
$string['school'] = 'School';
$string['lastlogin'] = 'Last login';
$string['actions'] = 'Actions';
$string['edit'] = 'Edit';
$string['delete'] = 'Delete';
$string['view'] = 'View';
$string['nocustomschool'] = 'Not set';
$string['digitalcontent'] = 'Digital content';
$string['quizbank'] = 'Quiz bank';
$string['activities'] = 'Activities';
$string['uploadnew'] = 'Upload new file';
$string['replace_delete'] = 'Replace / Delete';
$string['recategorize'] = 'Re-categorize';
$string['validation'] = 'Review / Validation';
$string['pending'] = 'Pending';
$string['approved'] = 'Approved';
$string['general_reports'] = 'General reports';
$string['school_performance'] = 'School performance';
$string['file_stats'] = 'File statistics';
$string['interaction_quality'] = 'Interaction quality';
$string['kpi_activeusers'] = 'Active users (30d)';
$string['kpi_totalcourses'] = 'Total courses';
$string['kpi_completionrate'] = 'Completion rate';
$string['kpi_fileusage'] = 'File usage';
$string['capability:viewnavbar'] = 'View custom Istikama admin navbar';
$string['capability:viewusers'] = 'View users management page';
$string['capability:viewcontentbank'] = 'View content bank page';
$string['capability:managecontentbank'] = 'Manage content bank approvals';
$string['capability:viewreports'] = 'View reports dashboard page';
$string['capability:viewsupport'] = 'View technical support page';
$string['capability:parentview'] = 'View parent dashboard (read-only child data)';

// Menu items.
$string['menu_children'] = 'Children';
$string['menu_schools'] = 'Schools';
$string['menu_library'] = 'Library';
$string['menu_performance'] = 'Performance';
$string['menu_notifications'] = 'Notifications';
$string['menu_class_library'] = 'Class Library';
$string['menu_classes'] = 'Classes';
$string['menu_my_lessons'] = 'My Lessons';
$string['menu_my_report'] = 'My Personal Report';

// ═══ Parent Module ═══
$string['parent_title'] = 'Parent Dashboard';
$string['parent_my_children'] = 'My Children';
$string['parent_no_children'] = 'No children linked to your account. Please contact your school administration.';
$string['parent_child_dashboard'] = 'Child Dashboard';
$string['parent_child_school'] = 'School';
$string['parent_child_level'] = 'Level';
$string['parent_child_class'] = 'Class';
$string['parent_child_last_access'] = 'Last active';
$string['parent_child_never_accessed'] = 'Never logged in';
$string['parent_view_child'] = 'View Dashboard →';

// Parent — Overview Tab.
$string['parent_tab_overview'] = 'Overview';
$string['parent_tab_learning'] = 'Learning Content';
$string['parent_tab_assessments'] = 'Assessments';
$string['parent_tab_activity'] = 'Activity & Results';
$string['parent_child_info'] = 'Child Information';
$string['parent_enrolled_courses'] = 'Enrolled Courses';
$string['parent_global_progress'] = 'Overall Progress';
$string['parent_time_spent'] = 'Time on Platform';
$string['parent_recent_activity'] = 'Recent Activity';
$string['parent_no_courses'] = 'Not enrolled in any courses yet.';
$string['parent_no_activity'] = 'No recent activity recorded.';
$string['parent_courses_count'] = '{$a} courses';
$string['parent_completion_rate'] = 'Completion Rate';
$string['parent_hours'] = '{$a} hours';
$string['parent_minutes'] = '{$a} min';

// Parent — Learning Content Tab.
$string['parent_course_sections'] = 'Course Sections';
$string['parent_new_content'] = 'NEW';
$string['parent_no_sections'] = 'No content available for this course.';
$string['parent_last_accessed'] = 'Last accessed';

// Parent — Assessments Tab.
$string['parent_assessment_type'] = 'Type';
$string['parent_assessment_name'] = 'Assessment';
$string['parent_assessment_course'] = 'Course';
$string['parent_assessment_status'] = 'Status';
$string['parent_assessment_grade'] = 'Grade';
$string['parent_assessment_feedback'] = 'Feedback';
$string['parent_assessment_submitted'] = 'Submitted';
$string['parent_assessment_notsubmitted'] = 'Not submitted';
$string['parent_assessment_graded'] = 'Graded';
$string['parent_assessment_notgraded'] = 'Not graded';
$string['parent_no_assessments'] = 'No assessments found.';
$string['parent_custom_assessments'] = 'Teacher Assessments';

// Parent — Activity & Results Tab.
$string['parent_quiz_attempts'] = 'Quiz Attempts';
$string['parent_quiz_name'] = 'Quiz';
$string['parent_quiz_attempts_count'] = 'Attempts';
$string['parent_quiz_best_grade'] = 'Best Grade';
$string['parent_quiz_last_attempt'] = 'Last Attempt';
$string['parent_no_quiz_attempts'] = 'No quiz attempts recorded.';
$string['parent_attendance_record'] = 'Attendance Record';
$string['parent_attendance_present'] = 'Present';
$string['parent_attendance_absent'] = 'Absent';
$string['parent_attendance_late'] = 'Late';
$string['parent_attendance_excused'] = 'Excused';
$string['parent_attendance_rate'] = 'Attendance Rate';
$string['parent_no_attendance'] = 'No attendance records found.';
$string['parent_participation'] = 'Participation Metrics';
$string['parent_total_logins'] = 'Total Logins (30d)';
$string['parent_pages_viewed'] = 'Pages Viewed (30d)';
$string['parent_access_denied'] = 'You do not have permission to view this child\'s data.';

// General/shared strings (used across multiple views).
$string['go_back'] = '← Back';
$string['status'] = 'Status';
$string['date'] = 'Date';
$string['attendance_date'] = 'Date';
$string['attendance_status'] = 'Status';
$string['attendance_behavior'] = 'Behavior Note';
$string['assessment_title'] = 'Assessment Title';
$string['assessment_score'] = 'Score';
$string['assessment_notes'] = 'Notes';

// User management tabs & assignment.
$string['tab_all'] = 'All';
$string['tab_students'] = 'Students';
$string['tab_teachers'] = 'Teachers';
$string['tab_managers'] = 'Managers';
$string['tab_parents'] = 'Parents';
$string['manage'] = 'Manage';
$string['manage_assignment'] = 'Manage Assignment';
$string['assign_school'] = 'School';
$string['assign_level'] = 'Level';
$string['assign_class'] = 'Class';
$string['assign_subjects'] = 'Subjects';
$string['select_school'] = 'Select school...';
$string['select_level'] = 'Select level...';
$string['select_class'] = 'Select class...';
$string['assignment_saved'] = 'Assignment saved successfully.';
$string['assignment_error'] = 'Error saving assignment.';
$string['no_assignment'] = 'No assignment yet.';
$string['remove_assignment'] = 'Remove assignment';
$string['saving'] = 'Saving...';
$string['loading'] = 'Loading...';
$string['close'] = 'Close';
$string['save_changes'] = 'Save Changes';
$string['managed_schools'] = 'Managed Schools';
$string['add_school_assignment'] = 'Add School';
$string['add_class_assignment'] = 'Add Class Assignment';
$string['no_role_detected'] = 'No role detected for this user. Please assign a role first.';
$string['student_assignment_title'] = 'Student Assignment';
$string['teacher_assignment_title'] = 'Teacher Assignment';
$string['manager_assignment_title'] = 'Manager Assignment';
$string['parent_assignment_title'] = 'Parent — Assign Children';
$string['confirm_remove'] = 'Are you sure you want to remove this assignment?';
$string['action_remove_role'] = 'Remove Role';

// Parent assignment modal.
$string['parent_search_students'] = 'Search students by name...';
$string['parent_linked_to_others'] = 'Also linked to other parent(s)';
$string['parent_no_students_available'] = 'No students found in the system.';

// ═══ Reports Dashboard ═══
$string['reports_title'] = 'Reports Dashboard';
$string['report_tab_overview'] = 'Overview';
$string['report_tab_schools'] = 'School Performance';
$string['report_tab_files'] = 'File Statistics';
$string['report_tab_interaction'] = 'Interaction Quality';
$string['report_tab_general'] = 'General';
$string['report_tab_lessons'] = 'Lessons';
$string['report_tab_students'] = 'Students';

// KPI labels.
$string['kpi_activeusers'] = 'Active Users (30d)';
$string['kpi_totalusers'] = 'Total Users';
$string['kpi_totalcourses'] = 'Total Courses';
$string['kpi_completionrate'] = 'Completion Rate';
$string['kpi_fileusage'] = 'Content Items';
$string['kpi_engagement'] = 'Engagement Score';
$string['kpi_logins30'] = 'Logins (30d)';
$string['kpi_quizattempts30'] = 'Quiz Attempts (30d)';
$string['kpi_myclasses'] = 'My Classes';
$string['kpi_mystudents'] = 'My Students';
$string['kpi_avgattendance'] = 'Avg Attendance';
$string['kpi_avggrade'] = 'Avg Grade';
$string['kpi_mycontent'] = 'My Content';

// Reports — charts and tables.
$string['report_login_trend'] = 'Login Trend (14 days)';
$string['report_daily_logins'] = 'Daily Unique Logins';
$string['report_school_ranking'] = 'School Rankings';
$string['report_school_name'] = 'School';
$string['report_user_count'] = 'Users';
$string['report_completion'] = 'Completion';
$string['report_content_by_type'] = 'Content by Type';
$string['report_content_by_status'] = 'Content by Status';
$string['report_upload_trend'] = 'Upload Trend (14 days)';
$string['report_engagement_formula'] = 'Engagement = (Logins + Quiz Attempts) / Active Users';
$string['report_engagement_detail'] = 'This score measures how actively users interact with the platform over the last 30 days.';
$string['report_no_data'] = 'No data available for this report.';
$string['report_no_classes'] = 'You are not assigned to any classes yet.';

// ═══ New modern reports — section headers + empty states + insights ═══
$string['report_section_executive']     = 'Executive Summary';
$string['report_section_insights']      = 'Key Insights';
$string['report_section_school_perf']   = 'School Performance';
$string['report_section_growth']        = 'Growth & Trends';
$string['report_section_content']       = 'Content & Library';
$string['report_section_engagement']    = 'Engagement & Activity';
$string['report_section_academic']      = 'Academic Outcomes';
$string['report_section_class_perf']    = 'Class Performance';
$string['report_section_at_risk']       = 'Students Needing Attention';

$string['report_empty_schools_title']   = 'School performance data not available yet';
$string['report_empty_schools_msg']     = 'Enrol students in schools and complete the season setup so we can compute performance metrics. Once students are active, this panel fills with attendance, grades, and growth data.';
$string['report_empty_schools_action']  = 'Manage schools';
$string['report_empty_content_title']   = 'No content uploaded yet';
$string['report_empty_content_msg']     = 'Once teachers upload library items or homework, distribution charts and upload trends will appear here.';
$string['report_empty_content_action']  = 'Open Library';
$string['report_empty_login_title']     = 'Activity tracking unavailable';
$string['report_empty_login_msg']       = 'Login trends require Moodle\'s standard log store to be enabled. Activate it in Site Admin → Plugins → Logging.';
$string['report_empty_teachers_title']  = 'No teacher activity yet';
$string['report_empty_teachers_msg']    = 'Assign teachers to classes from the Users page. Their activity (uploads, last login) will appear here.';
$string['report_empty_students_title']  = 'No students enrolled yet';
$string['report_empty_students_msg']    = 'Enrol students into your classes from the Users page. Their attendance, grades and progress will appear here as they learn.';
$string['report_empty_lessons_title']   = 'No lessons yet';
$string['report_empty_lessons_msg']     = 'Add lessons and learning content to your classes — their engagement metrics will appear once students start using them.';
$string['report_executive_subtitle']    = 'High-level platform performance at a glance.';
$string['report_growth_subtitle']       = 'How activity has changed over the last two weeks.';
$string['report_content_subtitle']      = 'Distribution of content items by type and approval status.';
$string['report_school_perf_subtitle']  = 'Comparison of enrolment, grades and completion across schools.';

// School performance table columns.
$string['report_col_students']      = 'Students';
$string['report_col_teachers']      = 'Teachers';
$string['report_col_avg_grade']     = 'Avg grade';
$string['report_col_completion']    = 'Completion';
$string['report_col_submission']    = 'Submission rate';
$string['report_col_logins_7d']     = 'Active (7d)';
$string['report_col_class']         = 'Class';
$string['report_col_level']         = 'Level';
$string['report_col_subject']       = 'Subject';
$string['report_col_courses']       = 'Courses';
$string['report_col_uploads']       = 'Uploads';
$string['report_col_activity']      = 'Activity';
$string['report_col_last_access']   = 'Last access';
$string['report_col_days_inactive'] = 'Inactive';

// Enriched manager report sections.
$string['report_section_enrollment_funnel'] = 'Enrolment funnel';
$string['report_enrollment_funnel_sub']     = 'Student lifecycle across enrolled, upcoming, graduated, and transferred states.';
$string['report_class_perf_sub']            = 'Performance metrics for every class in the school — ordered by average grade.';
$string['report_section_teacher_eff']       = 'Teacher effectiveness';
$string['report_teacher_eff_sub']           = 'Each teacher\'s course load, content contributions, and recent activity.';
$string['report_section_subject_perf']      = 'Subject performance';
$string['report_subject_perf_sub']          = 'Aggregated performance per academic subject across all classes.';
$string['report_at_risk_sub']               = 'Students with no recent activity (last 14 days). Reach out before they fall further behind.';

// New empty-state strings.
$string['report_empty_classes_title']   = 'No classes set up yet';
$string['report_empty_classes_msg']     = 'Create classes inside each level of this school to start tracking class performance.';
$string['report_empty_subjects_title']  = 'No subjects linked to classes yet';
$string['report_empty_subjects_msg']    = 'Assign subjects to your classes from the Levels page to populate subject performance.';

// ═══ School Notifications — modernized full system ═══
$string['sn_page_title']           = 'School notifications';
$string['sn_page_subtitle']        = 'Compose, schedule, and broadcast announcements to teachers, students, parents, or specific classes.';
$string['sn_compose']              = 'New notification';
$string['sn_kpi_total']            = 'Total notifications';
$string['sn_kpi_sent']             = 'Sent';
$string['sn_kpi_scheduled']        = 'Scheduled';
$string['sn_kpi_drafts']           = 'Drafts';
$string['sn_kpi_total_recipients'] = 'Total reach';
$string['sn_kpi_recent_7d']        = 'Sent (last 7d)';
$string['sn_filter_status']        = 'Status';
$string['sn_filter_search']        = 'Search';
$string['sn_filter_search_ph']     = 'Search title or body…';
$string['sn_filter_apply']         = 'Apply';
$string['sn_filter_reset']         = 'Reset';
$string['sn_filter_all']           = 'All';
$string['sn_status_draft']         = 'Draft';
$string['sn_status_scheduled']     = 'Scheduled';
$string['sn_status_sent']          = 'Sent';
$string['sn_status_changed']       = 'Status updated.';
$string['sn_table_title']          = 'Title';
$string['sn_table_audience']       = 'Audience';
$string['sn_table_status']         = 'Status';
$string['sn_table_recipients']     = 'Recipients';
$string['sn_table_date']           = 'Date';
$string['sn_table_actions']        = 'Actions';
$string['sn_no_notifications']     = 'No notifications yet';
$string['sn_no_notifications_msg'] = 'When you compose announcements, they appear here with their status and reach.';
$string['sn_create_title']         = 'Compose new notification';
$string['sn_field_title']          = 'Title';
$string['sn_field_title_ph']       = 'Short, clear title that appears in the recipient\'s notification bell';
$string['sn_field_body']           = 'Message';
$string['sn_field_body_ph']        = 'The body of your notification — keep it concise and actionable.';
$string['sn_field_audience']       = 'Audience';
$string['sn_field_audience_help']  = 'Who should receive this notification?';
$string['sn_field_class']          = 'Class (optional)';
$string['sn_field_class_help']     = 'Restrict to one class. Leave empty to send to the whole school.';
$string['sn_field_level']          = 'Level (optional)';
$string['sn_field_level_help']     = 'Restrict to one academic level.';
$string['sn_field_schedule']       = 'Schedule (optional)';
$string['sn_field_schedule_help']  = 'Leave empty to send immediately when you click "Send now".';
$string['sn_aud_all']              = 'Everyone in school';
$string['sn_aud_student']          = 'Students only';
$string['sn_aud_teacher']          = 'Teachers only';
$string['sn_aud_parent']           = 'Parents only';
$string['sn_save_draft']           = 'Save as draft';
$string['sn_send_now']             = 'Send now';
$string['sn_schedule_btn']         = 'Schedule';
$string['sn_action_view']          = 'View';
$string['sn_action_send']          = 'Send';
$string['sn_action_delete']        = 'Delete';
$string['sn_cancel']               = 'Cancel';
$string['sn_close']                = 'Close';
$string['sn_view_detail']          = 'Notification detail';
$string['sn_view_in_platform']     = 'Open in platform';
$string['sn_sent_to_n']            = 'Sent to {$a} recipient(s).';
$string['sn_saved_draft']          = 'Saved as draft.';
$string['sn_scheduled_for']        = 'Scheduled for {$a}.';
$string['sn_deleted']              = 'Notification deleted.';
$string['sn_title_body_required']  = 'A title and a message are required.';
$string['sn_cannot_delete_sent']   = 'Sent notifications are kept as history and cannot be deleted.';
$string['sn_audience_all']         = 'Everyone';
$string['sn_audience_by_role']     = 'Role: {$a}';
$string['sn_audience_class']       = 'Class: {$a}';
$string['sn_audience_level']       = 'Level: {$a}';
$string['sn_section_history']      = 'History';
$string['sn_section_analytics']    = 'At a glance';
$string['sn_no_permission']        = 'This notification was not sent to you.';
$string['report_no_access']        = 'You do not have access to the reports area.';

// ═══ Advertisements & Announcements ═══
$string['menu_ads']             = 'Announcements';
$string['ad_page_title']        = 'Advertisements & Announcements';
$string['ad_page_subtitle']     = 'Create flexible announcements — school trips, events, promotions — and choose exactly where and when students see them.';
$string['ad_new']               = 'New announcement';
$string['ad_create_title']      = 'Create announcement';
$string['ad_edit_title']        = 'Edit announcement';
$string['ad_field_title']       = 'Title';
$string['ad_field_title_ph']    = 'Short heading shown on the popup / sidebar';
$string['ad_field_content']     = 'Message (optional)';
$string['ad_field_content_ph']  = 'Announcement text — supports basic formatting. Leave empty for an image-only ad.';
$string['ad_field_image']       = 'Image (optional)';
$string['ad_field_image_help']  = 'Any size. Popups adapt to the image; sidebar ads suit tall / narrow images. The system renders each by its real aspect ratio.';
$string['ad_field_link']        = 'Link URL (optional)';
$string['ad_field_link_ph']     = 'https://… — where the ad sends students when clicked';
$string['ad_field_linktext']    = 'Button label (optional)';
$string['ad_field_linktext_ph'] = 'e.g. Learn More';
$string['ad_field_placement']   = 'Where should it appear?';
$string['ad_field_trigger']     = 'Popup timing';
$string['ad_field_audience']    = 'Audience';
$string['ad_field_dismissible'] = 'Students can dismiss it';
$string['ad_field_priority']    = 'Priority';
$string['ad_field_priority_help'] = 'Higher numbers show first when several ads compete for the same spot.';
$string['ad_field_start']       = 'Show from (optional)';
$string['ad_field_end']         = 'Show until (optional)';
$string['ad_field_status']      = 'Status';
$string['ad_place_popup']       = 'Popup modal';
$string['ad_place_sidebar']     = 'Right sidebar';
$string['ad_place_login']       = 'On login';
$string['ad_trig_everyvisit']   = 'Once each session';
$string['ad_trig_login']        = 'Right after login';
$string['ad_trig_return']       = 'When returning after a while';
$string['ad_trig_once']         = 'Only once, ever';
$string['ad_aud_all']           = 'Everyone';
$string['ad_aud_student']       = 'Students';
$string['ad_aud_teacher']       = 'Teachers';
$string['ad_aud_parent']        = 'Parents';
$string['ad_status_active']     = 'Active';
$string['ad_status_inactive']   = 'Inactive';
$string['ad_table_title']       = 'Announcement';
$string['ad_table_placement']   = 'Placement';
$string['ad_table_audience']    = 'Audience';
$string['ad_table_status']      = 'Status';
$string['ad_table_window']      = 'Schedule';
$string['ad_table_stats']       = 'Views / Clicks';
$string['ad_table_actions']     = 'Actions';
$string['ad_no_ads']            = 'No announcements yet';
$string['ad_no_ads_msg']        = 'Create your first announcement to greet students with school news, trips, and events.';
$string['ad_save']              = 'Save announcement';
$string['ad_cancel']            = 'Cancel';
$string['ad_delete']            = 'Delete';
$string['ad_delete_confirm']    = 'Delete this announcement permanently?';
$string['ad_saved']             = 'Announcement saved.';
$string['ad_deleted']           = 'Announcement deleted.';
$string['ad_status_changed']    = 'Status updated.';
$string['ad_title_required']    = 'A title is required.';
$string['ad_filter_search_ph']  = 'Search announcements…';
$string['ad_filter_all']        = 'All';
$string['ad_kpi_total']         = 'Total';
$string['ad_kpi_active']        = 'Active';
$string['ad_kpi_views']         = 'Total views';
$string['ad_kpi_clicks']        = 'Total clicks';
$string['ad_no_image']          = 'No image';
$string['ad_dismiss']           = 'Dismiss';
$string['ad_learn_more']        = 'Learn more';

// Teacher report table headers.
$string['report_student_name'] = 'Student';
$string['report_student_class'] = 'Class';
$string['report_student_attendance'] = 'Attendance';
$string['report_student_grade'] = 'Avg Grade';
$string['report_student_lastaccess'] = 'Last Access';
$string['report_lesson_name'] = 'Lesson';
$string['report_lesson_class'] = 'Class';
$string['report_lesson_content'] = 'Linked Content';
$string['report_lesson_enrolled'] = 'Enrolled';
$string['report_lesson_completion'] = 'Completion';

// ═══ Student Report ═══
$string['student_report_title'] = 'My Personal Report';
$string['student_tab_overview'] = 'Overview';
$string['student_kpi_avg'] = 'Average Grade';
$string['student_kpi_completion'] = 'Completion Rate';
$string['student_kpi_engagement'] = 'Engagement Score';
$string['student_report_grades'] = 'My Grades';
$string['student_report_activity'] = 'Activity Trend';
$string['student_report_insights'] = 'Smart Insights';
$string['student_course'] = 'Subject / Course';
$string['student_grade'] = 'Grade';
$string['student_no_data'] = 'No activity or data yet. Start learning to see your report!';
// Student report — personal greeting + UI strings
$string['sr_hi'] = 'Hi';
$string['sr_subtitle'] = "Here's how you're doing across all your lessons.";
$string['sr_kpi_avg'] = 'My Average Grade';
$string['sr_kpi_completion'] = 'Lessons Completed';
$string['sr_kpi_tasks'] = 'Tasks This Month';
$string['sr_kpi_days'] = 'Active Days';
$string['sr_my_grades'] = 'My Grades';
$string['sr_my_activity'] = 'My Activity';
$string['sr_last4weeks'] = 'last 4 weeks';
$string['sr_course_count_singular'] = 'course';
$string['sr_course_count_plural'] = 'courses';
$string['sr_no_grades'] = 'No grades yet — your scores will appear here.';
$string['sr_no_activity'] = 'No activity yet. Open a lesson to begin!';
$string['sr_footer_active'] = 'Keep going — small steps every day add up to big progress.';
$string['sr_footer_empty'] = 'Open your first lesson and start your learning journey!';
// Student insights (dynamic — use {$a} for subject names / values)
$string['insight_weak_subjects']    = 'Focus more on {$a} to improve your overall average.';
$string['insight_strong_subjects']  = 'Great job! You are excelling in {$a}.';
$string['insight_low_engagement']   = 'Your engagement seems a bit low recently. Try logging in consistently to keep up with your courses!';
$string['insight_high_engagement']  = 'Excellent consistency! Your active engagement is building a strong learning habit.';
$string['insight_incomplete']       = 'You have many incomplete activities. Try organizing your time to tackle a few each day.';
$string['insight_default']          = 'Keep up the steady work! Regular study sessions yield the best results over time.';
$string['sr_post_comment'] = 'Post comment';
$string['sr_discussion'] = 'Discussion';
$string['sr_no_comments'] = 'No comments yet — start the discussion!';
$string['sr_back_to_lesson'] = 'Back to Lesson';
$string['sr_comment_placeholder'] = 'Ask a question or share a thought…';

// ═══ Library Page (modernized) ═══
$string['library_title'] = 'Library';
$string['digital_library'] = 'Digital Library';
$string['digital_library_desc'] = 'Browse all approved educational materials.';
$string['upload_content'] = 'Upload Content';
$string['choose_content_type'] = 'Choose content type';
$string['choose_content_type_desc'] = 'Select the type of content you want to upload to the library.';
$string['validation_workflow'] = 'Validation Workflow';
$string['search_placeholder'] = 'Search by name or keywords...';
$string['all_types'] = 'All types';
$string['all_subjects'] = 'All subjects';
$string['all_levels'] = 'All levels';
$string['all_categories'] = 'All categories';
$string['no_content_found'] = 'No content matches your search criteria.';
$string['no_content_yet'] = 'No content available in the library yet.';
$string['uploaded_by'] = 'Uploaded by';
$string['uploaded_on'] = 'Uploaded on';
$string['view_content'] = 'View';
$string['content_type'] = 'Type';
$string['content_name'] = 'Content name';
$string['content_subject'] = 'Subject';
$string['content_level'] = 'Level';
$string['content_lesson'] = 'Lesson';
$string['content_category'] = 'Category';
$string['content_description'] = 'Description';
$string['content_keywords'] = 'Keywords';
$string['content_keywords_help'] = 'Enter keywords separated by commas';
$string['content_file'] = 'File';
$string['content_school'] = 'School';
$string['youtube_url'] = 'YouTube or video URL';
$string['external_link_url'] = 'External link URL';
$string['category_main'] = 'Main content';
$string['category_explanatory'] = 'Explanatory';
$string['category_enrichment'] = 'Enrichment';
$string['submit_content'] = 'Submit Content';
$string['content_uploaded'] = 'Content uploaded successfully and is pending approval.';
$string['content_approved'] = 'Content approved.';
$string['content_rejected'] = 'Content rejected.';
$string['back_to_types'] = '← Back to content types';
$string['no_pending'] = 'No content pending approval.';
$string['approve'] = 'Approve';
$string['reject'] = 'Reject';
$string['preview'] = 'Preview';
$string['type_document'] = 'Document';
$string['type_document_desc'] = 'PDF, Word, PowerPoint or other documents';
$string['type_video'] = 'Video';
$string['type_video_desc'] = 'Upload a video file or paste a YouTube URL';
$string['type_h5p'] = 'H5P Interactive';
$string['type_h5p_desc'] = 'Interactive H5P content';
$string['type_book'] = 'Book';
$string['type_book_desc'] = 'Multi-page textbook or reading material';
$string['type_quiz'] = 'Quiz';
$string['type_quiz_desc'] = 'Create a quiz from the question bank';
$string['type_link'] = 'External Link';
$string['type_link_desc'] = 'Link to website or external resource';
$string['subject_math'] = 'Mathematics';
$string['subject_science'] = 'Science';
$string['subject_arabic'] = 'Arabic';
$string['subject_french'] = 'French';
$string['subject_english'] = 'English';
$string['subject_islamic'] = 'Islamic Studies';
$string['subject_history'] = 'History & Geography';
$string['subject_physics'] = 'Physics';
$string['subject_other'] = 'Other';
$string['quizbank_desc'] = 'Manage question banks and quizzes using the Moodle quiz system.';
$string['rejected'] = 'Rejected';

// ═══ Schools Page (modernized) ═══
$string['manage_schools'] = 'Schools Management';
$string['schools'] = 'Schools';
$string['add_school'] = 'Add School';
$string['edit_school'] = 'Edit School';
$string['add_level'] = 'Add Level';
$string['add_class'] = 'Add Class';
$string['add_class_name'] = 'Class Name';
$string['add_class_placeholder'] = 'Enter class name...';
$string['add_class_to_level'] = 'Add Class to Level';
$string['hierarchy_class'] = 'Class';
$string['no_schools'] = 'No schools added yet.';
$string['no_levels'] = 'No levels added yet.';
$string['no_classes'] = 'No classes added yet.';
$string['delete_school_confirm'] = 'Are you sure you want to delete this school with all its levels and classes?';
$string['school_created'] = 'School created successfully.';
$string['school_updated'] = 'School updated successfully.';
$string['school_deleted'] = 'School deleted successfully.';
$string['level_created'] = 'Level added successfully.';
$string['class_created'] = 'Class added successfully.';
$string['item_deleted'] = 'Item deleted successfully.';
$string['subject_created'] = 'Subject created successfully.';
$string['subject_deleted'] = 'Subject deleted successfully.';
$string['expand_all'] = 'Expand All';
$string['collapse_all'] = 'Collapse All';
$string['no_subjects_assigned'] = 'No subjects assigned yet.';
$string['assign_subjects_btn'] = 'Assign Subjects';
$string['class_name'] = 'Class Name';
$string['class_name_placeholder'] = 'e.g. 1st Year A, 2nd Year B...';
$string['open_question_bank'] = 'Open Question Bank';
$string['view_quizzes'] = 'View Quizzes';

// ═══ Technical Professor / Activities ═══
$string['menu_activities'] = 'Activities';
$string['activities_title'] = 'Activities & Question Bank';
$string['tab_quizzes'] = 'Quizzes';
$string['tab_questions'] = 'Question Bank';
$string['total_quizzes'] = 'Total Quizzes';
$string['total_questions'] = 'Total Questions';
$string['no_quizzes_yet'] = 'No quizzes have been created yet.';
$string['no_questions_yet'] = 'No questions in the bank yet.';
$string['view_all_quizzes'] = 'View All Quizzes';
$string['role_technical_professor'] = 'Technical Professor';
$string['platform_wide'] = 'Platform-wide';
$string['date_created'] = 'Date Created';
$string['date_modified'] = 'Last Modified';
$string['question_type'] = 'Type';
$string['course'] = 'Course';

// ═══ Teacher Dashboard ═══
$string['sm_no_school_assigned'] = 'You are not assigned to any school yet. Please contact your administrator.';
$string['teacher_welcome'] = 'Welcome, {$a}';
$string['teacher_section_dashboard'] = 'Dashboard';
$string['teacher_section_classes'] = 'My Classes';
$string['teacher_section_classlibrary'] = 'Class Library';
$string['teacher_section_library'] = 'Library';
$string['teacher_quick_actions'] = 'Quick Actions';
$string['teacher_total_classes'] = 'Classes';
$string['teacher_total_students'] = 'Students';
$string['teacher_total_content'] = 'My Content';
$string['teacher_total_activities'] = 'My Activities';
$string['teacher_pending_content'] = 'Pending Approval';
$string['teacher_select_subject'] = 'Select a subject to manage';
$string['classes_taught'] = 'My Classes';
$string['classes_no_assignments'] = 'You are not assigned to any classes yet.';
$string['view_class_action'] = 'Open Class';
$string['manage_subject'] = 'Manage Subject';
$string['go_back'] = 'Back';

// ═══ Class View Tabs ═══
$string['class_students'] = 'Students';
$string['class_reports'] = 'Reports';
$string['class_lessons'] = 'Lessons';
$string['class_assessments'] = 'Assessments';
$string['class_attendance'] = 'Attendance';
$string['class_activity_interaction'] = 'Interaction';

// ═══ Students ═══
$string['student_name'] = 'Name';
$string['student_email'] = 'Email';
$string['student_last_access'] = 'Last Access';
$string['student_no_students'] = 'No students enrolled in this class.';

// ═══ Reports ═══
$string['report_present_rate'] = 'Present Rate';
$string['report_avg_score'] = 'Avg Score';
$string['total_assessments'] = 'Total Assessments';

// ═══ Assessments ═══
$string['assessment_add'] = 'Add Assessment';
$string['assessment_student'] = 'Student';
$string['assessment_max_score'] = 'Max Score';
$string['assessment_no_records'] = 'No assessments recorded yet.';
$string['assessment_saved'] = 'Assessment saved.';

// ═══ Attendance ═══
$string['attendance_present'] = 'Present';
$string['attendance_absent'] = 'Absent';
$string['attendance_late'] = 'Late';
$string['attendance_excused'] = 'Excused';
$string['attendance_save'] = 'Save Attendance';
$string['attendance_saved'] = 'Attendance saved.';

// ═══ Interaction ═══
$string['interaction_no_data'] = 'No linked activities yet.';
$string['interaction_activity_name'] = 'Activity';
$string['linked_date'] = 'Linked On';

// ═══ Class Library (teacher) ═══
$string['classlibrary_content_uploaded'] = 'Content uploaded successfully.';
$string['classlibrary_content_linked'] = 'Content linked to lesson.';
$string['classlibrary_activity_created'] = 'Activity created successfully.';
$string['classlibrary_activity_linked'] = 'Activity linked to lesson.';

// ═══ Library (teacher) ═══
$string['library_my_files'] = 'My Uploads';
$string['library_no_files'] = 'You have not uploaded any content yet.';
$string['library_upload_new'] = 'Upload New';

// ═══ Content Upload Form ═══
$string['content_name'] = 'Content Name';
$string['content_type'] = 'Type';
$string['content_description'] = 'Description';
$string['content_keywords'] = 'Keywords';
$string['content_file'] = 'File';
$string['external_link_url'] = 'External URL';
$string['submit_content'] = 'Submit Content';

// ═══ Teacher Library — subtitles & tabs ═══
$string['library_subtitle']        = 'Browse approved content, question bank, quizzes and your uploads';
$string['libtab_central']          = 'Central Library';
$string['libtab_questions']        = 'Question Bank';
$string['libtab_quizzes']          = 'Quizzes & Exams';
$string['libtab_myuploads']        = 'My Uploads';
$string['col_name']                = 'Name';
$string['col_type']                = 'Type';
$string['col_subject']             = 'Subject';
$string['col_date']                = 'Date';
$string['col_preview']             = 'Preview';
$string['no_approved_content']     = 'No approved content in the central library.';
$string['btn_central_library']     = 'Central Library';
$string['btn_question_bank']       = 'Question Bank';
$string['btn_quizzes']             = 'Quizzes';

// ═══ Class Library tabs ═══
$string['classlibrary_tab_add']    = 'Add Content';
$string['classlibrary_tab_create'] = 'Create Activity';
$string['classlibrary_tab_link']   = 'Link Activity';
$string['create_activity_btn']     = 'Create Activity';
$string['link_activity_title']     = 'Link Activity to a Lesson';
$string['link_activity_btn']       = 'Link Activity';
$string['no_questions_found']      = 'No questions found for your level/subject.';
$string['no_quizzes_found']        = 'No quizzes found for your level.';
$string['no_assigned_subjects']    = 'No assigned subjects found for this class.';
$string['students_count']          = 'students';
$string['subjects_count']          = 'subjects';
$string['search_students_ph']      = 'Search students by name or email…';

// ═══ Add to Lesson modal ═══
$string['addlesson_title']         = 'Add to Lesson';
$string['addlesson_library_title'] = 'Library Content';
$string['addlesson_library_desc']  = 'Pick from the approved library: PDF, video, YouTube, documents and more.';
$string['addlesson_quiz_title']    = 'Quiz / Exam';
$string['addlesson_quiz_desc']     = 'Reuse an existing quiz or create a new one from the question bank.';
$string['addlesson_forum_title']   = 'Forum / Announcement';
$string['addlesson_forum_desc']    = 'Add a discussion forum or an announcements channel for this lesson.';

// ═══ Shared page UI ═══
$string['back_to_lesson']          = 'Back to Lesson';
$string['section_label']           = 'Section';
$string['col_question']            = 'Question';
$string['col_creator']             = 'Creator';
$string['col_modified']            = 'Modified';
$string['col_actions']             = 'Actions';
$string['col_quiz_name']           = 'Quiz Name';
$string['col_level']               = 'Level';
$string['col_course']              = 'Course';
$string['col_questions_count']     = 'Questions';
$string['col_created']             = 'Created';
$string['col_status']              = 'Status';
$string['col_uploaded']            = 'Uploaded';
$string['col_title']               = 'Title';
$string['col_added']               = 'Added';
$string['col_action']              = 'Action';

// ═══ Add Library Content page ═══
$string['addlib_page_title']       = 'Add Content From Library';
$string['addlib_search_ph']        = 'Search library…';
$string['btn_add_to_lesson']       = 'Add to Lesson';
$string['no_library_content']      = 'No approved library content matches your filters.';
$string['no_library_content_hint'] = 'Ask an administrator or the technical professor to upload approved content.';
$string['items_shown']             = '{$a} items shown';
$string['content_added_success']   = 'Content "{$a}" added to lesson.';

// ═══ Add Quiz page ═══
$string['addquiz_page_title']      = 'Add Quiz / Exam';
$string['addquiz_tab_new']         = 'Create New Quiz';
$string['addquiz_tab_reuse']       = 'Reuse Existing Quiz';
$string['create_quiz_brand_new']   = 'Create a brand-new quiz';
$string['create_quiz_brand_new_desc'] = "We'll create an empty quiz in this lesson, then take you to the slot editor where you can add questions (pick existing from the bank, or create new ones with the full Moodle editor).";
$string['quiz_name_label']         = 'Quiz Name';
$string['quiz_name_ph']            = 'e.g. Chapter 3 — Quick check';
$string['btn_create_quiz_questions'] = 'Create Quiz & Add Questions';
$string['no_reusable_quizzes']     = 'No reusable quizzes available for your level.';
$string['no_reusable_quizzes_hint'] = 'Create a quiz here first, or ask the technical professor to publish a reusable one.';
$string['badge_reusable']          = 'Reusable';
$string['btn_use_in_lesson']       = 'Use in Lesson';

// ═══ Add Forum page ═══
$string['addforum_page_title']     = 'Add Forum / Announcement';
$string['addforum_heading']        = 'Add Forum or Announcement';
$string['addforum_choose']         = 'Choose the forum type — you will be taken to the standard creation form.';
$string['forum_type_general_title'] = 'General Discussion';
$string['forum_type_general_desc']  = 'Open forum — teachers and students can start threads and reply freely.';
$string['forum_type_news_title']    = 'Announcements';
$string['forum_type_news_desc']     = 'One-way channel. Only teachers post; students read and subscribe.';
$string['forum_type_qanda_title']   = 'Q &amp; A Forum';
$string['forum_type_qanda_desc']    = "Students must post their own response before seeing others' replies.";
$string['forum_type_blog_title']    = 'Blog-style Forum';
$string['forum_type_blog_desc']     = 'Each post is a standalone blog entry. Good for personal reflection.';
$string['forum_type_single_title']  = 'Single Discussion';
$string['forum_type_single_desc']   = 'One shared topic for the whole class — ideal for focused debate.';
$string['forum_type_eachuser_title'] = 'Each Person Posts One Discussion';
$string['forum_type_eachuser_desc']  = 'Every student starts exactly one thread; others can reply.';

// ═══ Quiz / forum success notifications ═══
$string['quiz_created_success']    = 'Quiz "{$a}" created. Add questions to it now.';
$string['quiz_cloned_success']     = 'Quiz cloned into the lesson with {$a} question(s).';

// ═══ My Uploads — status filter ═══
$string['filter_all']              = 'All';

// ═══ My Uploads — Upload New Content form ═══
$string['close_form']              = 'Close Form';
$string['upload_new_content']      = 'Upload New Content';
$string['upload_pick_type']        = 'Pick a content type — the form adapts to what you need.';
$string['upload_change_type']      = 'change';

$string['ctype_pdf_title']         = 'PDF Document';
$string['ctype_pdf_desc']          = 'Upload a PDF lesson, worksheet, or reading.';
$string['ctype_youtube_title']     = 'YouTube Video';
$string['ctype_youtube_desc']      = 'Paste a YouTube link to embed and discuss.';
$string['ctype_video_title']       = 'Video File';
$string['ctype_video_desc']        = 'Upload an MP4/WebM/MOV video file.';
$string['ctype_audio_title']       = 'Audio';
$string['ctype_audio_desc']        = 'Upload an audio file (MP3, WAV, OGG).';
$string['ctype_image_title']       = 'Image';
$string['ctype_image_desc']        = 'Upload an image (JPG, PNG, GIF, SVG).';
$string['ctype_document_title']    = 'Document';
$string['ctype_document_desc']     = 'Upload a Word, Excel, or Office document.';
$string['ctype_presentation_title'] = 'Presentation';
$string['ctype_presentation_desc'] = 'Upload a slideshow or PowerPoint file.';
$string['ctype_book_title']        = 'Book / eBook';
$string['ctype_book_desc']         = 'Upload an EPUB or multi-page book file.';
$string['ctype_link_title']        = 'External Link';
$string['ctype_link_desc']         = 'Add any external educational resource URL.';

$string['upload_label_title']      = 'Title';
$string['upload_label_subject']    = 'Subject (optional)';
$string['upload_subject_ph']       = 'e.g. Math, Arabic, Science';
$string['upload_label_file']       = 'Choose file';
$string['upload_label_url']        = 'URL';
$string['upload_label_youtube_url'] = 'YouTube URL';
$string['upload_youtube_hint']     = 'A valid YouTube link looks like <code>https://youtu.be/XXXXXXX</code> or <code>https://youtube.com/watch?v=XXXXXXX</code>.';
$string['upload_label_description'] = 'Description';
$string['upload_label_keywords']   = 'Keywords';
$string['upload_keywords_ph']      = 'comma, separated, tags';
$string['upload_submit_review']    = 'Submit for Review';

// ═══ Homework / Assignment ═══
$string['addquiz_tab_homework']      = 'Upload Homework';
$string['homework_create_title']     = 'Create Homework Assignment';
$string['homework_create_desc']      = 'Upload a document (PDF, Word, Image) and allow students to submit their work via file upload or rich text editor.';
$string['homework_title_label']      = 'Homework Title';
$string['homework_title_ph']         = 'e.g., Chapter 4 Exercises';
$string['homework_desc_label']       = 'Description / Instructions (Optional)';
$string['homework_desc_ph']          = 'Provide any additional instructions here...';
$string['homework_file_label']       = 'Homework Document (PDF, Image, Word)';
$string['homework_file_hint']        = 'Drag and drop files here, or click to browse.';
$string['homework_duedate_label']    = 'Due Date (Optional)';
$string['homework_submission_types'] = 'Allowed Submission Methods';
$string['homework_submission_file']  = 'File Upload (Students upload files)';
$string['homework_submission_text']  = 'Online Text (Students use rich text editor)';
$string['btn_create_homework']       = 'Create Homework';
$string['homework_created_success']  = 'Homework "{$a}" created successfully.';
$string['homework_view_title']       = 'View Homework';
$string['homework_badge']            = 'Homework';
$string['homework_submitted']        = 'Submitted';
$string['homework_grade_btn']        = 'Grade Submissions';
$string['homework_settings_btn']     = 'Settings';
$string['homework_instructions']     = 'Instructions';
$string['homework_attached_files']   = 'Attached Files';
$string['homework_download']         = 'Download';
$string['homework_your_submission']  = 'Your Submission';
$string['homework_graded']           = 'Graded';
$string['homework_grade_out_of']     = 'out of {$a}';
$string['homework_edit_submission']  = 'Edit Submission';
$string['homework_submit_now']       = 'Submit Now';
$string['homework_tl_assigned']      = 'Assigned';
$string['homework_tl_due']           = 'Due';
$string['homework_tl_submitted']     = 'Submitted';
$string['homework_tl_graded']        = 'Graded';
$string['homework_late']             = 'Late';
$string['homework_grading_title']    = 'Grading';
$string['homework_no_submissions']   = 'No submissions yet';
$string['homework_no_submissions_msg'] = 'When students submit, they will appear in the list on the left.';
$string['homework_select_student']   = 'Select a student from the list to review their submission.';
$string['homework_student_files']    = 'Submission files';
$string['homework_student_text']     = 'Online text';
$string['homework_grade_input']      = 'Grade';
$string['homework_grade_max']        = 'Out of {$a}';
$string['homework_feedback_label']   = 'Feedback for student';
$string['homework_feedback_ph']      = 'Optional notes, encouragement, or revision instructions…';
$string['homework_save_grade']       = 'Save grade';
$string['homework_save_grade_done']  = 'Grade saved.';
$string['homework_save_grade_fail']  = 'Could not save grade — please try again.';
$string['homework_state_new']        = 'New submission';
$string['homework_state_resubmitted'] = 'Resubmitted';
$string['homework_state_graded']     = 'Graded';
$string['homework_state_nothing']    = 'No submission';

// ── Content Bank Extended Status System ──
$string['cb_status_draft']             = 'Draft';
$string['cb_status_pending']           = 'Pending Review';
$string['cb_status_under_study']       = 'Under Study';
$string['cb_status_needs_revision']    = 'Needs Revision';
$string['cb_status_needs_metadata']    = 'Needs Metadata';
$string['cb_status_technical_review']  = 'Technical Review';
$string['cb_status_teacher_suggested'] = 'Teacher Suggested';
$string['cb_status_approved']          = 'Approved';
$string['cb_status_published']         = 'Published';
$string['cb_status_rejected']          = 'Rejected';
$string['cb_status_archived']          = 'Archived';
$string['cb_status_restricted']        = 'Restricted';
$string['cb_status_deprecated']        = 'Deprecated';

// ── Content Bank Moderation UI ──
$string['cb_change_status']        = 'Change Status';
$string['cb_reclassify']           = 'Reclassify';
$string['cb_moderation_notes']     = 'Moderation Notes';
$string['cb_notes_placeholder']    = 'Add notes about this status change...';
$string['cb_status_changed']       = 'Status changed successfully';
$string['cb_bulk_change']          = 'Bulk Change Status';
$string['cb_bulk_changed']         = 'Status updated for {$a} item(s)';
$string['cb_workflow_history']     = 'Workflow History';
$string['cb_history_empty']        = 'No history yet';
$string['cb_history_entry']        = '{$a->user} changed status from <strong>{$a->old}</strong> to <strong>{$a->new}</strong>';
$string['cb_filter_status']        = 'Filter by Status';
$string['cb_all_statuses']         = 'All Statuses';
$string['cb_rejected_panel']       = 'Rejected Content';
$string['cb_rejected_reason']      = 'Reason';
$string['cb_reopen']               = 'Reopen';
$string['cb_reopened']             = 'Content reopened for review';
$string['cb_view_history']         = 'View History';
$string['invalid_status']          = 'Invalid content status';

// ── Content Bank Tags ──
$string['cb_tags']              = 'Tags';
$string['cb_add_tag']           = 'Add Tag';
$string['cb_remove_tag']        = 'Remove Tag';
$string['cb_edit_tags']         = 'Edit Tags';
$string['cb_tag_added']         = 'Tag added';
$string['cb_tag_removed']       = 'Tag removed';
$string['cb_tag_placeholder']   = 'Type a tag and press Enter...';
$string['cb_tag_suggestions']   = 'Suggestions';
$string['cb_no_tags']           = 'No tags';

// ─────────────────────────────────────────────────────────────────────────────
// Academic Seasons (Phase 1)
// ─────────────────────────────────────────────────────────────────────────────
$string['manage_seasons']                = 'Academic Seasons';
$string['current_active_season']         = 'Current active season';
$string['no_active_season']              = 'No active season is set.';
$string['no_active_season_help']         = 'New attendance, assessment, and promotion data will not be stamped with a season until one is activated. Create or activate a season below.';
$string['all_seasons']                   = 'All seasons';
$string['new_season']                    = 'New season';
$string['season_name']                   = 'Name';
$string['season_description']            = 'Description';
$string['season_start_date']             = 'Start date';
$string['season_end_date']               = 'End date';
$string['season_status']                 = 'Status';
$string['no_seasons_yet']                = 'No seasons defined yet. Create the first one to get started.';
$string['mark_upcoming']                 = 'Mark upcoming';
$string['activate']                      = 'Activate';
$string['archive']                       = 'Archive';
$string['close_season']                  = 'Close';
$string['reactivate']                    = 'Re-activate';
$string['locked']                        = 'Locked';
$string['confirm_activate']              = 'Activate this season? The currently active season (if any) will be archived.';
$string['confirm_archive']               = 'Archive this season? Writes to season-scoped data will be blocked.';
$string['confirm_close']                 = 'Permanently close this season? This cannot be undone — no further writes will be possible.';
$string['confirm_reactivate']            = 'Re-activate this archived season? The currently active season will be archived.';
$string['confirm_delete_season']         = 'Delete this draft season? This action cannot be undone.';
$string['save']                          = 'Save';
$string['season_created']                = 'Season created.';
$string['season_updated']                = 'Season updated.';
$string['season_activated']              = 'Season activated.';
$string['season_archived']               = 'Season archived.';
$string['season_closed']                 = 'Season closed permanently.';
$string['season_marked_upcoming']        = 'Season marked as upcoming.';
$string['reopen_season']                 = 'Reopen';
$string['confirm_reopen']                = 'Reopen this closed season as the active one? Only allowed if no other season is currently active.';
$string['season_reopened']               = 'Season reopened and set as active.';
$string['season_already_active']         = 'Cannot activate: another season is already active. Close it first.';
$string['season_close_name_mismatch']    = 'The typed name did not match. Season was not closed.';
$string['archived_terminal']             = 'Archived (read-only)';
$string['no_active_season_blocked']      = 'No active season — actions are blocked until an admin activates a season.';
$string['task_auto_close_seasons']       = 'Auto-close expired Istikama seasons';
$string['season_dates_overlap']          = 'Date range overlaps with another season ({$a}). Seasons must not intersect.';
$string['season_end_in_past']            = 'The active season\'s end date cannot be moved into the past. Pick today or later.';
$string['edit_season']                   = 'Edit season';
$string['season_active_edit_note']       = 'This is the active season. You can edit any field, but the end date cannot be moved into the past.';
$string['season_deleted']                = 'Season deleted.';
$string['season_immutable']              = 'This season is closed or archived — writes are blocked.';
$string['season_name_required']          = 'Season name is required.';
$string['season_name_too_long']          = 'Season name is too long (max 100 characters).';
$string['season_dates_required']         = 'Both start and end dates are required.';
$string['season_end_before_start']       = 'End date must be after start date.';
$string['season_name_taken']             = 'A season with that name already exists.';
$string['season_transition_not_allowed'] = 'Season status transition is not allowed: {$a}.';
$string['season_delete_not_draft']       = 'Only draft or upcoming seasons can be deleted. Active seasons must be closed first; closed/archived seasons are read-only.';
$string['confirm_close_q']               = 'Close season?';
$string['confirm_close_help']            = 'This action ends the active season. No further actions will be possible on the platform until a new season is activated. All season data is preserved.';
$string['confirm_close_typename']        = 'Type the season name';
$string['season_delete_has_data']        = 'Cannot delete: data is already linked to this season.';
$string['invalid_status']                = 'Invalid status.';
$string['season_start_in_past']          = 'Season start date cannot be in the past.';
$string['season_not_started_yet']        = 'Cannot activate: this season has not started yet. Activation is only allowed once the season\'s start date has been reached.';
$string['restore_season']                = 'Restore';
$string['confirm_restore']               = 'Restore this season from archive? It will be set to Closed status. You can then Reopen it as the active season if needed.';
$string['season_restored']               = 'Season restored from archive.';

// ─────────────────────────────────────────────────────────────────────────────
// Academic Levels (Phase 3)
// ─────────────────────────────────────────────────────────────────────────────
$string['manage_levels']             = 'Academic Levels';
$string['global_levels']             = 'Global academic levels';
$string['global_levels_help']        = 'Define the levels offered across the platform. Schools then choose which ones they offer in their own settings.';
$string['new_level']                 = 'New level';
$string['level_name']                = 'Name';
$string['level_tier']                = 'Tier';
$string['tier_primary']              = 'Primary';
$string['tier_middle']               = 'Middle';
$string['tier_high']                 = 'High School';
$string['levels']                    = 'level(s)';
$string['no_levels_in_tier']         = 'No levels defined for this tier yet.';
$string['move_up']                   = 'Move up';
$string['move_down']                 = 'Move down';
$string['level_renamed']             = 'Level renamed.';
$string['level_reordered']           = 'Level reordered.';
$string['level_deleted']             = 'Level deleted.';
$string['level_name_required']       = 'Level name is required.';
$string['invalid_tier']              = 'Invalid tier value.';
$string['level_delete_has_subjects'] = 'Cannot delete: this level still has subjects assigned. Remove them first.';
$string['level_delete_has_categories'] = 'Cannot delete: this level is in use by one or more schools. Detach it from those schools first.';
$string['level_delete_has_school']     = 'Cannot delete: this level is still assigned to one or more schools. Remove the assignment first.';
$string['confirm_delete_level']      = 'Delete this level? This action cannot be undone.';

// ─────────────────────────────────────────────────────────────────────────────
// Student Promotions (Phase 4)
// ─────────────────────────────────────────────────────────────────────────────
$string['manage_promotions']               = 'Student Promotions';
$string['promotion_step_seasons']          = 'Step 1 — Choose source and destination seasons';
$string['promotion_step_class']            = 'Step 2 — Choose source class';
$string['promotion_step_destination']      = 'Step 3 — Pick destination, action, and students';
$string['promotion_from_season']           = 'From season';
$string['promotion_to_season']             = 'To season';
$string['promotion_source_class']          = 'Source class';
$string['promotion_destination_class']     = 'Destination class';
$string['promotion_no_class_required_graduate'] = '— (none — graduate or no class) —';
$string['promotion_action']                = 'Action';
$string['promotion_action_promote']        = 'Promote to next class';
$string['promotion_action_retain']         = 'Retain in current class';
$string['promotion_action_graduate']       = 'Graduate (no new enrollment)';
$string['promotion_action_transfer']       = 'Transfer (different school)';
$string['promotion_pick_seasons_first']    = 'Pick a source and destination season above to continue.';
$string['load_students']                   = 'Load students';
$string['students']                        = 'students';
$string['no_students_in_class']            = 'No students found in this class for the chosen season.';
$string['promote_selected']                = 'Promote selected students';
$string['confirm_promote']                 = 'Are you sure you want to promote the selected students?';
$string['continue']                        = 'Continue';
$string['notes']                           = 'Notes (optional)';
$string['promotion_complete']              = 'Promotion complete: {$a->ok} succeeded, {$a->failed} failed.';
$string['promotion_invalid_seasons']       = 'Source and destination seasons must both be set.';
$string['promotion_same_season']           = 'Cannot promote to the same season.';
$string['promotion_invalid_action']        = 'Invalid promotion action.';
$string['promotion_target_season_missing'] = 'Destination season does not exist.';
$string['promotion_target_season_locked']  = 'Cannot promote into an archived or closed season.';

// ─────────────────────────────────────────────────────────────────────────────
// Academic History / Archive (Phase 5)
// ─────────────────────────────────────────────────────────────────────────────
$string['academic_history_title']    = 'Academic history';
$string['legacy_season_label']       = 'Legacy (pre-Seasons)';
$string['no_history_yet']            = 'No historical academic data is recorded yet.';
$string['present']                   = 'Present';
$string['absent']                    = 'Absent';
$string['late']                      = 'Late';
$string['assessments_count']         = 'Assessments';
$string['avg_score']                 = 'Avg. score';
$string['view_assessment_details']   = 'View assessment details';
$string['subject']                   = 'Subject';
$string['title']                     = 'Title';
$string['score']                     = 'Score';

// ─────────────────────────────────────────────────────────────────────────────
// Dashboard season filter (Phase 6)
// ─────────────────────────────────────────────────────────────────────────────
$string['viewing_season']      = 'Viewing season';
$string['view_past_years']     = 'View past years';
$string['jump_to_season']      = 'Jump to season';

// ─────────────────────────────────────────────────────────────────────────────
// Drag/drop reorder + school↔level enablement (Gaps 3, 4)
// ─────────────────────────────────────────────────────────────────────────────
$string['level_reorder_failed']           = 'Reorder failed';
$string['level_reorder_cross_tier']       = 'Cannot move a level across tiers — change its tier first.';
$string['invalid_payload']                = 'Invalid request payload.';
$string['manage_school_levels']           = 'Levels offered';
$string['school_level_help']              = 'Toggle which globally-defined levels this school offers. Disabled levels are hidden from this school\'s pickers but historical data stays intact.';
$string['school_level_enabled']           = 'Enabled';
$string['school_level_disabled']          = 'Disabled';
$string['school_level_toggled_on']        = 'Level enabled for this school.';
$string['school_level_toggled_off']       = 'Level disabled for this school.';
$string['no_levels_defined']              = 'No levels have been defined in the platform. Add some on the Academic Levels page first.';
$string['click_to_rename']                = 'Double-click to rename';

// ─────────────────────────────────────────────────────────────────────────────
// Top-level admin tree categories
// ─────────────────────────────────────────────────────────────────────────────
$string['admincat_academic']   = 'Academic Management';
$string['admincat_seasons']    = 'Seasons';
$string['admincat_structure']  = 'Schools & Levels';
$string['admincat_students']   = 'Students & Promotions';
$string['admincat_archives']   = 'Reports & Archives';
$string['admincat_operations'] = 'Operations';
$string['admin_users_management']  = 'Users Management';
$string['admin_parent_dashboard']  = 'Parent Dashboard';
$string['admin_reports']           = 'Reports Dashboard';
$string['admin_contentbank']       = 'Content Bank';
$string['admin_tech_support']      = 'Tech Support';

// ─────────────────────────────────────────────────────────────────────────────
// Bulk Promotion & Season History (Academic Progression System)
// ─────────────────────────────────────────────────────────────────────────────
$string['bulk_promotion_title']              = 'Bulk Student Promotion';
$string['bulk_promotion_help']               = 'Progress multiple students to a new academic level or class for the next season. Historical data is preserved.';
$string['bulk_promotion_result']             = '{$a->ok} students promoted successfully. {$a->failed} failed.';
$string['source_season']                     = 'Source season';
$string['destination_season']                = 'Destination season';
$string['destination_class']                 = 'Destination class';
$string['select_a_season']                   = 'Select a season…';
$string['keep_same_class']                   = 'Keep same class';
$string['promotion_destination']             = 'Destination';
$string['level']                             = 'Level';
$string['class']                             = 'Class';
$string['all_classes']                       = 'All classes';
$string['reset_filters']                     = 'Reset';
$string['apply_filters']                     = 'Apply';
$string['found']                             = 'found';
$string['selected']                          = 'selected';
$string['select_all']                        = 'Select all';
$string['no_students_match_filters']         = 'No students match the current filters.';
$string['select_school_to_continue']         = 'Select a school and source season to view students.';
$string['action_promote']                    = 'Promote (move to a new class)';
$string['action_retain']                     = 'Retain (held back — same class next season)';
$string['action_graduate']                   = 'Graduate (no further enrollment)';
$string['action_transfer']                   = 'Transfer (across schools)';
$string['optional']                          = 'optional';
$string['confirm_promotion_title']           = 'Confirm Promotion';
$string['confirm_promotion_body']            = 'Please review the details below before promoting students.';
$string['confirm_yes_promote']               = 'Confirm Promotion';
$string['promotion_no_students_selected']    = 'Please select at least one student.';
$string['promotion_no_destination_season']   = 'Please choose a destination season.';
$string['promotion_already_enrolled']        = 'Student is already enrolled in the destination season — refusing to create a duplicate enrollment.';
$string['promotion_invalid_seasons']         = 'Invalid season IDs for promotion.';
$string['promotion_same_season']             = 'Source and destination seasons must be different.';
$string['promotion_invalid_action']          = 'Unknown promotion action.';
$string['promotion_target_season_missing']   = 'Target season does not exist.';
$string['promotion_target_season_locked']    = 'Cannot promote into an archived or closed season.';
$string['teacher_history']                   = 'Teacher';
$string['student_history']                   = 'Student';
$string['classes_taught']                    = 'Classes taught';
$string['activities_authored']               = 'Activities authored';
$string['attendance_recorded']               = 'Attendance recorded';
$string['assessments_recorded']              = 'Assessments recorded';
$string['subjects']                          = 'Subjects';
$string['view_class_assignments']            = 'View class assignments';
$string['view_activities']                   = 'View activities';
$string['view_attendance_log']               = 'View attendance log';
$string['assigned_on']                       = 'Assigned on';
$string['created']                           = 'Created';
$string['excused']                           = 'Excused';
$string['history']                           = 'History';
$string['view_history']                      = 'View history';
$string['promotion_log']                     = 'Promotion log';
$string['enrollment_status']                 = 'Enrollment status';
$string['all']                               = 'All';
$string['select_a_class']                    = 'Select a class…';
$string['promotion_no_destination_class']    = 'Please select a destination class.';
$string['promotion_class_required']          = 'A destination class is required for this action.';
$string['promotion_no_source_enrollment']    = 'No source enrollment found for this student in the selected source season.';
$string['not_selectable_terminal']           = 'This enrollment is in a terminal status and cannot be promoted again.';
$string['showing_students_for']              = 'Showing students for';
$string['season']                            = 'Season';
$string['status_enrolled']                   = 'Enrolled';
$string['status_upcoming']                   = 'Upcoming';
$string['status_graduated']                  = 'Graduated';
$string['status_transferred']                = 'Transferred';
$string['status_suspended']                  = 'Suspended';
$string['action_change_class']               = 'Change Class (within the same season)';
$string['promotion_no_class_change']         = 'The destination class must be different from the current one for a change-class operation.';
$string['change_class_must_be_same_season']  = 'Change Class is a within-season action — destination season must match source season.';
$string['other_seasons']                     = 'Other seasons';
$string['destination_level']                 = 'Destination level';
$string['select_a_level']                    = 'Select a level…';
$string['pick_level_first']                  = 'Pick a level first…';
$string['promotion_no_destination_level']    = 'Please select a destination level.';
$string['promotion_level_class_mismatch']    = 'The chosen destination class does not belong to the chosen destination level. Pick a class that lives under the selected level.';

// ─────────────────────────────────────────────────────────────────────────────
// Library / Content-Bank — moderation, preview modal, multi-level/subject
// ─────────────────────────────────────────────────────────────────────────────
$string['lib_status_pending']         = 'Pending';
$string['lib_status_reviewing']       = 'Reviewing';
$string['lib_status_approved']        = 'Approved';
$string['lib_status_approved_temp']   = 'Approved (temporary)';
$string['lib_status_rejected']        = 'Rejected';
$string['lib_status_archived']        = 'Archived';
$string['lib_invalid_status']         = 'Invalid status value.';
$string['lib_name_required']          = 'Title cannot be empty.';
$string['lib_unknown_action']         = 'Unknown library action.';
$string['lib_keywords_col']           = 'Keywords';
$string['lib_keywords_ph']            = 'comma, separated, keywords';
$string['lib_search_label']           = 'Search';
$string['lib_search_placeholder']     = 'Search by title, description, or keyword…';
$string['lib_preview_and_moderate']   = 'Preview & moderate';
$string['lib_details_and_moderation'] = 'Details & moderation';
$string['lib_levels_multi']           = 'Levels (one or more)';
$string['lib_subjects_multi']         = 'Subjects (one or more)';
$string['lib_status_notes_ph']        = 'Reason / note for this status change (optional)';
$string['lib_moderation_history']     = 'Moderation history';
$string['lib_saving']                 = 'Saving…';
$string['lib_saved']                  = 'Saved.';
$string['lib_error_prefix']           = 'Error: ';
$string['lib_no_preview']             = 'No preview available.';
$string['lib_validation_help']        = 'Moderate uploaded content. Click any item to preview, edit metadata, and change its status.';
$string['lib_validation_all_open']    = 'All open items (Pending + Reviewing)';

// ── Dashboard (/my/) — added 2026-06 ──
$string['dash_welcome']                  = 'Welcome back, {$a} 👋';
$string['dash_subtitle']                 = 'Track your progress, manage your platform, and stay on top of everything.';
$string['dash_total_schools']            = 'Total Schools';
$string['dash_total_users']              = 'Total Users';
$string['dash_active_students']          = 'Active Students';
$string['dash_active_teachers']          = 'Active Teachers';
$string['dash_schools_overview']         = 'Schools Overview';
$string['dash_view_all']                 = 'View All';
$string['dash_col_school']               = 'School Name';
$string['dash_col_students']             = 'Students';
$string['dash_col_teachers']             = 'Teachers';
$string['dash_col_courses']              = 'Courses';
$string['dash_col_status']               = 'Status';
$string['dash_status_active']            = 'Active';
$string['dash_no_schools']               = 'No schools found. Let\'s create your first school!';
$string['dash_activity_insights']        = 'Activity Insights';
$string['dash_new_enrollments']          = 'New Enrollments';
$string['dash_new_enrollments_desc']     = 'This week\'s active student registrations';
$string['dash_course_completion']        = 'Course Completion';
$string['dash_course_completion_desc']   = 'Average completion rate across schools';
$string['dash_live_sessions']            = 'Live Sessions';
$string['dash_live_sessions_desc']       = 'Teachers hosting active classes right now';
$string['dash_menu']                     = 'Menu';
$string['dash_search_ph']                = 'Search...';
$string['dash_role_admin']               = 'Administrator';
$string['dash_role_school_manager']      = 'School Manager';
$string['dash_role_technical_professor'] = 'Technical Professor';
$string['dash_role_teacher_creator']     = 'Teacher / Creator';
$string['dash_role_teacher']             = 'Teacher';
$string['dash_role_student']             = 'Student';
$string['dash_role_parent']              = 'Parent';

// ── Announcements page — UI controls ──
$string['ad_apply']             = 'Apply';
$string['ad_reset']             = 'Reset';
$string['ad_dropzone']          = 'Click or drop an image';
$string['ad_tip_edit']          = 'Edit';
$string['ad_tip_activate']      = 'Activate';
$string['ad_tip_deactivate']    = 'Deactivate';
$string['ad_tip_delete']        = 'Delete';

// ── Users page: new user + student import ──
$string['add_new_user']         = 'Add new user';
$string['import_students']       = 'Import students';
$string['import_students_title'] = 'Import students from CSV';
$string['import_intro']          = 'Upload a CSV file to create multiple student accounts at once. Download the template, fill one student per row, then upload it below.';
$string['import_structure_title']= 'Required CSV structure';
$string['import_required_note']  = 'Required columns: firstname, lastname, email. All other columns are optional. Username is generated automatically when left empty.';
$string['import_download_template'] = 'Download CSV template';
$string['import_dropzone_title'] = 'Drag & drop your CSV here';
$string['import_dropzone_sub']   = 'or click to browse — .csv only';
$string['import_preview_btn']    = 'Validate & preview';
$string['import_confirm_btn']    = 'Confirm import';
$string['import_back']           = 'Back';
$string['import_close']          = 'Close';
$string['import_processing']     = 'Processing…';
$string['import_summary_total']  = 'Rows';
$string['import_summary_valid']  = 'Valid';
$string['import_summary_invalid']= 'Errors';
$string['import_summary_created']= 'Created';
$string['import_col_line']       = 'Row';
$string['import_col_name']       = 'Name';
$string['import_col_email']      = 'Email';
$string['import_col_status']     = 'Status';
$string['import_col_detail']     = 'Detail / username';
$string['import_done']           = 'Import complete: {$a} student(s) created.';
$string['import_fix_errors']     = 'Fix the rows marked in red, then re-upload. Valid rows can still be imported.';
// Field reference (shown in the structure help).
$string['import_f_firstname']    = 'firstname — First name (required)';
$string['import_f_lastname']     = 'lastname — Last name (required)';
$string['import_f_fathername']   = 'fathername — Father name (informational)';
$string['import_f_grandfather']  = 'grandfathername — Grandfather name (informational)';
$string['import_f_gender']       = 'gender — Male or Female';
$string['import_f_dob']          = 'dob — Date of birth (dd/mm/yyyy)';
$string['import_f_studentid']    = 'studentid — Unique student identifier';
$string['import_f_email']        = 'email — Email address (required, unique)';
$string['import_f_username']     = 'username — Login name (auto-generated if empty)';
$string['import_f_password']     = 'password — Initial password (auto-generated if empty)';
$string['import_f_status']       = 'status — active or suspended';
// Validation errors.
$string['import_err_nofile']     = 'No file was uploaded.';
$string['import_err_empty']      = 'The uploaded file is empty.';
$string['import_err_norows']     = 'The file has no data rows.';
$string['import_err_missingcol'] = 'Missing required column: {$a}';
$string['import_err_firstname']  = 'First name is required';
$string['import_err_lastname']   = 'Last name is required';
$string['import_err_email']      = 'Invalid email';
$string['import_err_emaildup']   = 'Email already exists';
$string['import_err_username']   = 'Invalid username';
$string['import_err_usernamedup']= 'Username already taken';
$string['import_err_gender']     = 'Gender must be Male or Female';
$string['import_err_dob']        = 'Date of birth must be dd/mm/yyyy';

// ── Global search ──
$string['search_cat_pages']    = 'Pages';
$string['search_cat_courses']  = 'Courses';
$string['search_cat_admin']    = 'Site administration';
$string['search_cat_users']    = 'Users';
$string['search_recent']       = 'Recent searches';
$string['search_no_results']   = 'No results found';
$string['search_hint']         = 'Search pages, users, courses…';
$string['search_clear_recent'] = 'Clear';

// ── Attendance calendar ──
$string['att_cal_title']    = 'Attendance calendar';
$string['att_cal_sub']      = 'Click any day to record or review attendance.';
$string['att_today']        = 'Today';
$string['att_present']      = 'Present';
$string['att_absent']       = 'Absent';
$string['att_late']         = 'Late';
$string['att_excuse_q']     = 'Excuse?';
$string['att_excused']      = 'Has excuse';
$string['att_no_excuse']    = 'No excuse';
$string['att_justified_q']  = 'Justification brought?';
$string['att_justify_ph']   = 'Justification / excuse note (optional)';
$string['att_for']          = 'Attendance for';
$string['att_save']         = 'Save attendance';
$string['att_saved']        = 'Attendance saved';
$string['att_no_students']  = 'No students in this class.';
$string['att_not_recorded'] = 'Not recorded';
$string['att_recorded']     = 'Recorded';
$string['att_mark_all_present'] = 'Mark all present';
$string['att_close']        = 'Close';
$string['att_legend']       = 'Legend';
$string['att_future_day']   = 'Cannot record attendance for a future date.';

// ── Content preview: teacher feedback ──
$string['cb_feedback_title'] = 'Send feedback';
$string['cb_feedback_note']  = 'Your feedback is shared privately with the content team (technical professors & admins). You will not see other reviewers\' comments here.';
$string['cb_feedback_send']  = 'Send feedback';
$string['cb_feedback_ph']    = 'Share a note about this content with the content team…';
$string['cb_preview_readonly'] = 'Preview only — you cannot edit this content.';

// ── Class insights dashboard ──
$string['ins_title']       = 'Student insights';
$string['ins_sub']         = 'Attendance, assessment and progress analytics for every student in this subject.';
$string['ins_kpi_attendance'] = 'Class attendance';
$string['ins_kpi_avg']     = 'Class average';
$string['ins_kpi_assess']  = 'Assessments';
$string['ins_kpi_atrisk']  = 'Students at risk';
$string['ins_col_student'] = 'Student';
$string['ins_col_attendance'] = 'Attendance';
$string['ins_col_score']   = 'Avg score';
$string['ins_col_assess']  = 'Assessments';
$string['ins_col_last']    = 'Last active';
$string['ins_col_status']  = 'Status';
$string['ins_ontrack']     = 'On track';
$string['ins_atrisk']      = 'At risk';
$string['ins_nodata']      = 'No data';
$string['ins_present']     = 'present';
$string['ins_late']        = 'late';
$string['ins_absent']      = 'absent';
$string['ins_empty']       = 'No students in this class yet.';

// ── School form fields ──
$string['school_name']        = 'School name';
$string['institution_code']   = 'Institution code';
$string['wilaya']             = 'Wilaya';
$string['commune']            = 'Commune';
$string['address']            = 'Address';
$string['phone']              = 'Phone';
$string['school_email']       = 'Email';
$string['school_admin']       = 'School manager';
$string['school_logo']        = 'School logo';

// ── Activities / Question bank page ──
$string['act_tab_qbank']='Question Bank'; $string['act_tab_quizzes']='Quizzes';
$string['act_questions_h']='Questions'; $string['act_setup_incomplete']='Question bank setup incomplete.';
$string['act_f_all_q']='All Questions'; $string['act_f_central']='Central Bank Only'; $string['act_f_in_quizzes']='In Quizzes';
$string['act_search_q_ph']='Search by name, type, level, subject, creator…'; $string['act_create_question']='Create Question';
$string['act_no_questions']='No questions exist on the platform yet.';
$string['act_no_questions_hint']='Use the Create Question button above to add your first one to the central bank.';
$string['act_col_question']='Question'; $string['act_col_type']='Type'; $string['act_col_level']='Level';
$string['act_col_subject_cat']='Subject / Category'; $string['act_col_source']='Source'; $string['act_col_used_in']='Used in';
$string['act_col_creator']='Creator'; $string['act_col_modified']='Modified'; $string['act_col_actions']='Actions';
$string['act_delete_q_confirm']='Delete this question? This is permanent.';
$string['act_source_central']='Central Bank'; $string['act_scope_reusable']='Reusable Bank'; $string['act_scope_course']='Course quiz';
$string['act_f_all_qz']='All Quizzes'; $string['act_f_reusable']='Reusable Bank Only'; $string['act_f_course_only']='Course-only';
$string['act_search_qz_ph']='Search quizzes…'; $string['act_col_name']='Name'; $string['act_col_scope']='Scope';
$string['act_col_subject']='Subject'; $string['act_col_course']='Course'; $string['act_col_created']='Created';
$string['act_no_quizzes']='No quizzes have been created yet.';
$string['act_create_quiz']='Create Reusable Quiz';
$string['act_create_quiz_sub']='Name your quiz, pick a Level & Subject, then start adding questions.';
$string['act_quiz_name']='Quiz / Exam Name'; $string['act_quiz_name_ph']='e.g. Algebra — Midterm Exam';
$string['act_level']='Level'; $string['act_subject']='Subject';
$string['act_select_level']='— Select Level —'; $string['act_select_level_first']='— Select Level first —';
$string['act_quiz_info']='The quiz is saved into the central reusable bank under the selected Level & Subject. After creation you\'ll go straight to the question editor.';
$string['act_cancel']='Cancel'; $string['act_create_open_editor']='Create & Open Editor';
$string['act_create_q_title']='Create New Question'; $string['act_create_q_sub']='Choose a Level and Subject to begin';
$string['act_q_info']='After clicking Proceed you\'ll choose a question type and fill in the question using Moodle\'s native editor. The question becomes available to teachers of this level & subject.';
$string['act_proceed']='Proceed';
$string['act_no_subjects']='No subjects for this level'; $string['act_could_not_approve']='Could not approve the question.';
$string['act_report_reason_prompt']='Why are you reporting this question?'; $string['act_could_not_report']='Could not report the question.';
$string['support_dropzone'] = 'Drop screenshots or click to browse (max 5 files)';

// ── Quiz editing flow (edit_quiz / pick_questions / view_quiz / create_question chooser) ──
$string['q_back']='Back'; $string['q_back_to_qbank']='Back to Question Bank'; $string['q_back_to_quiz']='Back to Quiz';
$string['q_edit_quiz']='Edit Quiz'; $string['q_quiz_prefix']='Quiz'; $string['q_preview_prefix']='Preview';
$string['q_n_questions']='{$a} questions'; $string['q_n_marks']='{$a} marks';
$string['q_add_from_bank']='Add From Bank'; $string['q_add_new_q']='Add New Question'; $string['q_preview']='Preview'; $string['q_settings']='Settings';
$string['q_questions_layout']='Questions & Layout';
$string['q_reorder_hint']='Reorder with the ↑ / ↓ buttons; use the trash icon to remove. Changes save instantly.';
$string['q_no_questions']='No questions in this quiz yet.';
$string['q_no_questions_hint']='Add questions from the central bank for this level & subject, or create new ones.';
$string['q_col_order']='Order'; $string['q_col_marks']='Marks'; $string['q_col_page']='Page'; $string['q_question_missing']='— question missing —';
$string['q_err_remove']='Could not remove the question.'; $string['q_err_reorder']='Could not reorder the slot.'; $string['q_err_mark']='Could not save the new mark.';
$string['q_will_add_to_quiz']='— will be added to this quiz';
$string['eq_modal_title']='Add New Question to this Quiz';
$string['eq_modal_sub']='Choose a Level and Subject — the question is saved to the central bank and attached to this quiz.';
$string['pk_title']='Add Questions to Quiz'; $string['pk_heading']='Add Questions from the Bank'; $string['pk_available']='{$a} available';
$string['pk_add_selected']='Add Selected'; $string['pk_all_levels']='All Levels'; $string['pk_all_subjects']='All Subjects'; $string['pk_any_type']='Any Type';
$string['pk_search_ph']='Search question name or text…'; $string['pk_filter']='Filter'; $string['pk_clear']='Clear'; $string['pk_select_all']='Select all';
$string['pk_no_match']='No matching questions in the bank.';
$string['vq_readonly']='Read-only overview. Use Edit Questions to add, remove or reorder.'; $string['vq_edit_questions']='Edit Questions';
$string['qc_choose_type']='Choose a Question Type';
$string['qc_pick_hint']='Pick the type that fits your question. You\'ll fill it in using Moodle\'s native editor; the saved question becomes available to teachers of {$a}.';
$string['qc_filter_ph']='Filter question types…'; $string['qc_section_types']='Question Types'; $string['qc_section_other']='Other';
$string['qtd_multichoice']='One or many correct answers from a list.'; $string['qtd_truefalse']='A simple True / False question.';
$string['qtd_shortanswer']='Student types a short word or phrase.'; $string['qtd_essay']='Free-text long answer, manually graded.';
$string['qtd_numerical']='A number, with optional unit and tolerance.'; $string['qtd_match']='Match items in two columns.';
$string['qtd_description']='Static text — no answer required.'; $string['qtd_multianswer']='Cloze: many sub-questions inside a passage.';
$string['qtd_random']='Pulls a random question from a category.'; $string['qtd_gapselect']='Select missing words from drop-downs.';
$string['qtd_ddwtos']='Drag words to drop-zones in text.'; $string['qtd_ordering']='Place items in the correct sequence.';
$string['qtd_calculated']='Numeric question with wildcard variables.'; $string['qtd_calculatedmulti']='Calculated, with multiple-choice answers.';
$string['qtd_calculatedsimple']='Simplified calculated question.'; $string['qtd_ddimageortext']='Drag images / text onto a background.';
$string['qtd_ddmarker']='Drop markers on an image.'; $string['qtd_randomsamatch']='Random short-answer matching.'; $string['qtd_custom']='Custom question type.';

$string['q_edit_question']='Edit Question'; $string['q_question_preview']='Question Preview';

$string['rpt_col_school']='School'; $string['rpt_upcoming']='upcoming'; $string['rpt_search_students_ph']='Search students by name…';
$string['rpt_empty_student']="Once you're assigned to a class, your class analytics will appear here.";
$string['rpt_col_category']='Category'; $string['rpt_col_uses']='Uses'; $string['rpt_col_teacher']='Teacher';
$string['rpt_col_quizzes']='Quizzes'; $string['rpt_col_question_slots']='Question Slots';

// ── teacher.php + simple_quiz_questions.php ──
$string['t_all_types']='All Types'; $string['t_no_central_content']='No approved content in the central bank yet.';
$string['t_col_added']='Added'; $string['t_opt_class']='Class…'; $string['t_opt_lesson']='Lesson…';
$string['t_all_my_levels']='All My Levels'; $string['t_search_questions_ph']='Search questions…';
$string['t_try_adjust_filters']='Try adjusting the filters, or create a new question.'; $string['t_search_quizzes_ph']='Search quizzes…';
$string['t_no_assigned_subjects']='No assigned subjects found for this class.';
$string['t_rate_good']='Good'; $string['t_rate_low']='Low'; $string['t_rate_very_low']='Very low';
$string['t_all_on_track']='All on track'; $string['t_n_of_total']='{$a->n} of {$a->total}';
$string['t_no_lesson_structure']='No lesson structure found for this subject.';
$string['t_no_quizzes_subject']='No quizzes have been added to this subject yet.';
$string['t_add_quiz_hint']='Add a quiz to the lesson to start tracking assessments.';
$string['t_all_quizzes']='All Quizzes'; $string['t_no_attempts']='No students have attempted these quizzes yet.';
$string['t_col_attempt']='Attempt'; $string['t_col_score']='Score'; $string['t_col_finished']='Finished';
$string['t_col_student']='Student'; $string['t_col_excuse']='Excuse'; $string['t_reusable']='Reusable';
$string['t_status_distribution']='Student status distribution'; $string['t_no_activities']='No activities yet.';
$string['sq_answer_choices']='Answer Choices'; $string['sq_select_correct']='Select the radio button for the Correct Answer';
$string['sq_true']='True'; $string['sq_false']='False'; $string['sq_total_points']='Total Points: ';
$string['sq_saving']='Saving...'; $string['sq_fill_two']='Please fill out at least two answer choices.';
$string['sq_confirm_remove']='Remove this question from the quiz?'; $string['sq_network_error']='Network error. Please try again.';

$string['sq_manage_prefix']='Manage: '; $string['sq_questions_in_quiz']='Questions in this quiz';
$string['sq_tab_mc']='Multiple Choice'; $string['sq_tab_tf']='True / False'; $string['sq_question_text']='Question Text';
$string['sq_add_mc']='Add Multiple Choice Question'; $string['sq_correct_answer_is']='Correct Answer is'; $string['sq_add_tf']='Add True/False Question';
$string['sq_ph_mc_text']='e.g. What is the capital of Algeria?'; $string['sq_ph_tf_text']='e.g. The capital of Algeria is Oran.';
$string['sq_ph_choice_a']='Choice A (Correct)'; $string['sq_ph_choice_b']='Choice B'; $string['sq_ph_choice_c']='Choice C'; $string['sq_ph_choice_d']='Choice D';
$string['sq_no_questions_yet']='No questions yet'; $string['sq_add_first']='Add your first question using the form below.';
$string['sq_points_prefix']='Points: '; $string['sq_remove']='Remove';

$string['t_lbl_activity_name']='Activity Name'; $string['t_lbl_class']='Class'; $string['t_lbl_description']='Description'; $string['t_lbl_activity']='Activity'; $string['t_lbl_lesson']='Lesson';

// ── Assign Subjects modal (schools.php) ─────────────────────────────────────
$string['assignsub_title']            = 'Assign Subjects';
$string['assignsub_loading']          = 'Loading...';
$string['assignsub_target_school']    = 'Target School';
$string['assignsub_target_level']     = 'Target Level';
$string['assignsub_target_class']     = 'Target Class';
$string['assignsub_loading_subjects'] = 'Loading subjects...';
$string['assignsub_help']             = 'Selected subjects will be assigned to all targets. Missing subjects will be auto-created.';
$string['assignsub_create_new']       = 'Create New Dynamic Subject';
$string['assignsub_name_ph']          = 'Subject Name...';
$string['assignsub_close']            = 'Close';
$string['assignsub_save']             = 'Assign & Create';
$string['assignsub_none']             = 'No subjects found for this level. Create one below.';
$string['assignsub_load_failed']      = 'Failed to load targets.';
$string['assignsub_name_required']    = 'Please provide a Subject Name.';
$string['assignsub_creating']         = 'Creating...';
$string['assignsub_created']          = 'Created {name}!';
$string['assignsub_reused']           = 'Reused existing tag: {name}!';
$string['assignsub_failed']           = 'Failed';
$string['assignsub_network_error']    = 'Network error';
$string['assignsub_info_class']       = 'Assigning subjects to this class';
$string['assignsub_info_level']       = 'Assigning subjects to all classes in this level';
$string['assignsub_info_school']      = 'Assigning subjects to all classes in this school';
$string['assignsub_no_classes']       = 'No classes found in this target to assign subjects to.';
$string['assignsub_processing']       = 'Processing...';
$string['assignsub_success']          = 'Successfully assigned subjects! Created {count} new courses.';
$string['assignsub_select_one']       = 'Please select at least one subject.';
$string['assignsub_error']            = 'An error occurred';

// ── Support page extras (support.php) ───────────────────────────────────────
$string['support_table_actions'] = 'Actions';
$string['support_replies_count'] = 'replies';
$string['support_cancel_btn']    = 'Cancel';
$string['support_close']         = 'Close';
