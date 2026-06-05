<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Strings for component 'local_o365', language 'ar', version '5.1'.
 *
 * @package     local_o365
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['acp_maintenance'] = 'أدوات الصيانة';
$string['acp_parentsite_desc'] = 'الموقع حيث توجد بيانات المقررات الدراسية المشارك بها.';
$string['acp_parentsite_name'] = 'مودل';
$string['acp_tenants_add'] = 'إضافة مستأجر جديد';
$string['acp_tenants_title_desc'] = 'هذه الصفحة تسمح لك بإعداد وصول متعدد المستأجرين إلى مودل من مايكروسوف 365.';
$string['acp_userconnections_filtering_muserfullname'] = 'الاسم الكامل لمستخدم مودل';
$string['acp_userconnections_manualmatch_details'] = 'هذه الصفحة تسمح لك بمطابقة مستخدم واحد في مودل مع مستخدم واحد في مايكروسوف 365.';
$string['acp_usermatch_matchqueue_desc'] = 'هذا الجدول يظهر الحالة الحالية لعملية المطابقة. عند كل تشغيل لمشغل الوظائف الدورية، ستتم معالجنة حفنة من المستخدمين التالية أسماؤهم.<br /><b>ملاحظة:</b>لن يتم تحديث هذه الصفحة تلقائيًا، لذلك عليك تنشيطها يدويًا لمعاينة الحالة الحالية.';
$string['calendar_event'] = 'معاينة التفاصيل';
$string['calendar_site'] = 'تقويم على مستوى الموقع';
$string['calendar_user'] = 'التقويم الشخصي (للمستخدم)';
$string['errornodirectaccess'] = 'الوصول المباشر إلى الصفحة أمر محظور';
$string['erroro365apibadpermission'] = 'الصلاحية غير موجودة';
$string['erroro365apicouldnotcreatesite'] = 'مشكلة عند إنشاء الموقع.';
$string['erroro365apisiteexistsnolocal'] = 'الموقع موجود مسبقاً، ولكن تعذر العثور على سجله المحلي.';
$string['eventapifail'] = 'فشل واجهة برمجة التطبيق';
$string['eventcalendarsubscribed'] = 'مستخدم اشترك في تقويم';
$string['eventcalendarunsubscribed'] = 'مستخدم ألغى اشتراكه في تقويم';
$string['help_user_emailsync'] = 'مساعدة عن مزامنة أسماء مستخدمي azure مع عناوين البريد الالكتروني في مودل';
$string['help_user_emailsync_help'] = 'تمكين هذا الخيار سيؤدي إلى مطابقة أسماء مستخدمي azure مع عناوين البريد الالكتروني في مودل، بدلاً من السلوك الافتراضي والذي هو أسماء مستخدمي azure مع أسماء مستخدمي مودل.';
$string['personal_calendar'] = 'شخصي';
$string['privacy:metadata:local_o365_calidmap:eventid'] = 'مُعرَّف الحدث في مودل.';
$string['privacy:metadata:local_o365_calidmap:outlookeventid'] = 'مُعرَّف الحدث في Outlook.';
$string['privacy:metadata:local_o365_matchqueue:musername'] = 'اسم المستخدم لحساب مستخدم مودل';
$string['privacy:metadata:local_o365_matchqueue:o365username'] = 'اسم المستخدم لحساب مستخدم مايكروسوفت 365';
$string['privacy:metadata:local_o365_objects:o365name'] = 'الاسم القابل للقراءة للمكون في مايكروسوفت 365';
$string['settings_course_reset_teams_option_per_course'] = 'السماح بالإعدادات لكل مساق<br/>يتطلب هذا إضافة كتلة مايكروسوفت إلى المساق. يمكن للمستخدمين الذي لديهم إمكانية إعادة تعيين المساق اختيار ما يريدون عمله في الكتلة خلال عملية إعادة تعيين المساق.';
$string['settings_customtheme'] = 'قالب مخصص (متقدم)';
$string['settings_detectperms'] = 'صلاحيات التطبيق';
$string['settings_detectperms_fixperms'] = 'إصلاح الصلاحيات';
$string['settings_detectperms_invalid'] = 'فحص الصلاحيات في Azure AD';
$string['settings_detectperms_unifiednomissing'] = 'كل الصلاحيات الموحدة حاضرة.';
$string['settings_detectperms_valid'] = 'تم إعداد الصلاحيات.';
$string['settings_header_advanced'] = 'متقدمة';
$string['settings_main_name_option_full_name'] = 'الاسم الكامل';
$string['settings_maintenance'] = 'الصيانة';
$string['settings_maintenance_details'] = 'تتوفر مهام صيانة متعددة لحل بعض المشاكل الشائعة.';
$string['settings_maintenance_linktext'] = 'معاينة أدوات الصيانة';
$string['settings_moodlesettingssetup_details'] = 'هذا سيتأكد من:
<ul class="local_o365_settings_teams_horizontal_spacer">
<li>مُعرَّف Open مُمَكَّن.</li>
<li>تضمين الإطارات مُمَكَّن.</li>
<li>خدمات الويب مُمَكَّنة.</li>
<li>بروتوكول Rest مُمَكَّن.</li>
<li>خدمات الويب لمايكروسوف 365 مُمَكَّنة.</li>
<li>المستخدم المصادق عليه يمتلك صلاحية إنشاء ترميز خدمة الويب.</li>
<li>المستخدم المصادق عليه يمتلك صلاحية استعمال بروتوكول Rest.</li>
</ul>';
$string['settings_notice_createtokennotallowed'] = 'هناك مشكلة عند منح صلاحية إنشاء ترميز خدمة الويب';
$string['settings_notice_restusageallowed'] = 'تم منح صلاحية استعمال بروتوكول REST';
$string['settings_notice_restusagealreadyallowed'] = 'تم مسبقًا منح صلاحية استعمال بروتوكول REST';
$string['settings_notice_restusagenotallowed'] = 'هناك مشكلة عند منح صلاحية استعمال بروتوكول REST';
$string['settings_reset_group_name_prefix_details'] = 'عند إعادة تعيين مساق مرتبط بمجموعة، اسم المجموعة الموجود سيتم إسباقه بهذا.';
$string['settings_reset_team_name_prefix_details'] = 'عند إعادة تعيين مساق مرتبط بفريق، اسم الفريق الموجود سيتم إسباقه بهذا.';
$string['settings_secthead_advanced'] = 'إعدادات متقدمة';
$string['settings_serviceresourceabstract_empty'] = 'يرجى إدخال قيمة أو النقر على "الكشف" لمحاولة الكشف عن القيمة الصحيحة..';
$string['settings_serviceresourceabstract_invalid'] = 'لا تبدو هذه القيمة مستعملة.';
$string['settings_setup_step1_continue'] = '<b>بمجرد إدخالك لمُعرَّف التطبيق الخاص بك والمفتاح، أنقر على "حفظ التغييرات" عند نهاية الصفحة للمتابعة.</b><br /><br /><br /><br /><br />';
$string['settings_setup_step3'] = 'الخطوة 3/3: موافقة المشرف والمعلومات الإضافية';
$string['settings_team_name_sync_desc'] = 'عند تمكينه، عند تحديث مساق مودل، سيتم تحديث اسم الفريق وفقًا لآخر إعدادات في تسمية الفريق.';
$string['settings_usersynccreationrestriction_fieldval'] = 'قيمة الحقل';
$string['settings_usersynccreationrestriction_regex'] = 'القيمة هي تعبير اعتيادي';
$string['spsite_group_contributors_desc'] = 'كل المستخدمين الذين يمكنهم إدارة الملفات في المساق {$a}';
$string['ucp_index_connectionstatus_matched'] = 'لقد تمت مطابقتك مع مستخدم Office&nbsp;365 user <small>"{$a}"</small>. إكمال هذ الاتصال، يرجى النقر على الرابط أدناه وتسجيل الدخول إلى Office&nbsp;365.';
$string['ucp_syncwith_title'] = 'اسم تقويم Outlook المراد المزامنة معه';
