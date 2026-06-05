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
 * Strings for component 'local_notificationsagent', language 'ar', version '5.1'.
 *
 * @package     local_notificationsagent
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actiondetail'] = 'تفاصيل الإجراء';
$string['actionerror'] = 'وقع خطأ عند تنفيذ الإجراء';
$string['actionid'] = 'مُعرَّف الإجراء';
$string['actionplugins'] = 'ملاحق الإجراء';
$string['actions'] = 'الإجراءات';
$string['admin_breadcrumb'] = 'مشرف وكيل الإشعارات';
$string['assign'] = 'إختر';
$string['assignassign'] = 'تعيين:';
$string['assigncancel'] = 'إلغاء';
$string['assignforced'] = 'تعيين القاعدة على أنها مفروضة';
$string['assignsave'] = 'حفظ التغييرات';
$string['assignselectcourses'] = 'إختر المساقات';
$string['assignselectedinfo'] = 'تم تحديد {$a->courses} من المساقات و {$a->categories} من التصنيفات';
$string['assignunselectcourses'] = 'إلغاء تحديد المساقات';
$string['brokenrulebody'] = 'القاعدة: {$a->rule} للمساق :{$a->course} قد تم إيقافها.';
$string['cachedef_action'] = 'قائمة الإجراءات.';
$string['cachedef_condition'] = 'قائمة الشروط.';
$string['cachedef_course'] = 'بيانات المساق.';
$string['cachedef_launched'] = 'قائمة المستخدمين الذين بدؤوا بشكل دوري.';
$string['card_day'] = 'يوم';
$string['card_day_plural'] = 'أيام';
$string['card_hour'] = 'ساعة';
$string['card_hour_plural'] = 'ساعات';
$string['card_minute'] = 'دقيقة';
$string['card_minute_plural'] = 'دقائق';
$string['card_second'] = 'ثانية';
$string['card_second_plural'] = 'ثوان';
$string['cardif'] = 'إذا كل من:';
$string['cardsharedby'] = 'مشاركة من قبل {$a->username} في المساق {$a->coursename}';
$string['cardthen'] = 'إذن:';
$string['cardunless'] = 'ما لم يكن أي من:';
$string['condition_days'] = 'أيام';
$string['condition_grade'] = 'التقدير';
$string['condition_hours'] = 'ساعات';
$string['condition_minutes'] = 'دقائق';
$string['condition_seconds'] = 'ثوان';
$string['conditionplugins'] = 'ملاحق الشرط';
$string['conditions'] = 'الشروط';
$string['course_breadcrumb'] = 'وكيل الإشعارات';
$string['courseid'] = 'مُعرَّف المساق';
$string['deleteaccept'] = 'القاعدة حُذفت';
$string['deletecontent_hascontext'] = 'إن {$a->type} {$a->title} التي ترغب بحذفها مرتبطة بسياقات أخرى. هل ترغب في المتابعة؟';
$string['deletecontent_nocontext'] = 'أنت على وشك حذف {$a->type} {$a->title}، هل ترغب في المتابعة؟';
$string['deletetitle'] = 'حذف {$a->type} {$a->title}';
$string['disable_user_use'] = 'تعطيل استعمال الطلبة';
$string['disable_user_use_desc'] = 'تعطيل استعمال الطلاب لوكيل الإشعارات. تعطيل المستخدمين الذين ليست لديهم الإمكانية "local/notificationsagent:managecourserule".';
$string['editrule_action_error'] = 'ينبغي عليك إضافة إجراء واحد على الأقل';
$string['editrule_activaterule'] = 'تفعيل';
$string['editrule_clonerule'] = 'إضافة قاعدة';
$string['editrule_condition_error'] = 'ينبغي عليك إضافة شرط واحد على الأقل';
$string['editrule_deleterule'] = 'حذف';
$string['editrule_editrule'] = 'تحرير';
$string['editrule_execution_error'] = '{$a->timesfired} بين {$a->minimum} و {$a->maximum}';
$string['editrule_generalconditions'] = 'الشرةط العامة';
$string['editrule_newaction'] = 'إجراء جديد:';
$string['editrule_newcondition'] = 'شرط جديد:';
$string['editrule_newrule'] = 'قاعدة جديدة';
$string['editrule_newtemplate'] = 'قالب جديد';
$string['editrule_orderby'] = 'مرتب حسب';
$string['editrule_pauserule'] = 'أيقاف';
$string['editrule_reportrule'] = 'التقرير';
$string['editrule_reports'] = 'التقارير';
$string['editrule_required_error'] = 'حقل مطلوب';
$string['editrule_runtime'] = 'الفترة';
$string['editrule_runtime_error'] = 'إذا كانت {$a->timesfired} > 0، ينبغي ذكر الفترة';
$string['editrule_shareallrule'] = 'مشاركة';
$string['editrule_sharedallrule'] = 'تمت مشاركته';
$string['editrule_sharerule'] = 'مشاركة';
$string['editrule_timesfired'] = 'عدد مرات التنفيذ';
$string['editrule_title'] = 'العنوان';
$string['editrule_type'] = 'نوع القاعدة';
$string['editrule_unshareallrule'] = 'إلغاء المشاركة';
$string['editrule_unsharerule'] = 'إلغاء المشاركة';
$string['editrule_usetemplate'] = 'أنشئ من هذا القالب';
$string['evaluaterule'] = 'تقييم القاعدة';
$string['evaluaterule_help'] = 'يتم تقييم القاعدة كما يأتي: ([Condition 1] **AND** [Condition 2]  **AND** ... ) **AND NOT** ([Exception 1] **OR** [Exception 2] ...) -> [Action 1]->[Action 2]';
$string['exceptions'] = 'الاستثناءات';
$string['export'] = 'تصدير';
$string['fullaction'] = 'الإجراء';
$string['fullcourse'] = 'المساق';
$string['fullrule'] = 'القاعدة';
$string['fulltemplate'] = 'القالب';
$string['fulluser'] = 'المستخدم';
$string['heading'] = 'وكيل الإشعارات';
$string['hideshow'] = 'إخفاء/إظهار';
$string['id'] = 'المُعرَّف';
$string['import'] = 'استيراد';
$string['import_apply'] = 'استيراد وتطبيق';
$string['import_choose'] = 'ملف JSON';
$string['import_desc'] = 'إختر ملف JSON لاستيراد القواعد';
$string['import_error'] = 'لا يمكن استيراد القاعدة، تحقق من ملف JSON الخاص بك';
$string['import_success'] = 'تم استيراد القاعدة بنجاح';
$string['import_title'] = 'استيراد القواعد';
$string['importrulemissingcapability'] = 'إمكانية استيراد القواعد';
$string['isnotrule'] = 'إن مُعرَّف القاعدة المعطى ليس قاعدة.';
$string['manageactionplugins'] = 'إدارة ملاحق الإجراء';
$string['manageconditionplugins'] = 'إدارة ملاحق الشرط';
$string['managenotificationsactionplugins'] = 'إدارة ملاحق الإجراء';
$string['managenotificationsconditionplugins'] = 'إدارة ملاحق الشرط';
$string['max_rules_cron'] = 'أقصى عدد من القواعد خلال دورة مشغل الوظائف الدورية';
$string['max_rules_cron_desc'] = 'أقصى عدد من القواعد خلال دورة مشغل الوظائف الدورية';
$string['menu'] = 'مساعدي';
$string['messageprovider:notificationsagent_message'] = 'إشعارات القواعد المكسورة';
$string['needcourseid'] = 'مُعرَّف المساق مطلوب';
$string['no_file_selected'] = 'لم يتم تحديد أي ملف';
$string['no_json_file'] = 'الملف ليس ملف JSON';
$string['nosuchinstance'] = 'لم يتم العثور على هكذا عيِّنة.';
$string['notificationaction_action'] = 'الملاحف الفرعية للإجراء';
$string['notificationsactionpluginname'] = 'ملحق الإجراء';
$string['notificationsagent:assignrule'] = 'تعيين القاعدة';
$string['notificationsagent:checkrulecontext'] = 'فحص سياق القاعدة';
$string['notificationsagent:createrule'] = 'إنشاء القاعدة';
$string['notificationsagent:deleterule'] = 'حذف القاعدة';
$string['notificationsagent:editrule'] = 'تحرير القاعدة';
$string['notificationsagent:exportrule'] = 'تصدير القاعدة';
$string['notificationsagent:forcerule'] = 'فرض القاعدة';
$string['notificationsagent:importrule'] = 'استيراد القاعدة';
$string['notificationsagent:manageallrule'] = 'إمكانية إدارة كل القواعد';
$string['notificationsagent:managecourserule'] = 'إدارة القواعد على مستوى المساق';
$string['notificationsagent:manageownrule'] = 'إدارة قواعد المساق الخاص بك';
$string['notificationsagent:managesessions'] = 'إمكانية حفظ ترتيب القاعدة';
$string['notificationsagent:managesiterule'] = 'إدارة القواعد على مستوى الموقع';
$string['notificationsagent:shareruleall'] = 'الموافقة على مشاركة القاعدة';
$string['notificationsagent:unshareruleall'] = 'رفض مشاركة القاعدة';
$string['notificationsagent:updateruleshare'] = 'تحديث حالة المشاركة للقاعدة';
$string['notificationsagent:updaterulestatus'] = 'تحديث حالة القاعدة';
$string['notificationsagent:viewassistantreport'] = 'معاينة تقرير القاعدة';
$string['notificationsagent:viewcourserule'] = 'إمكانية معاينة قواعد المساق';
$string['notificationsconditionpluginname'] = 'ملحق الشرط';
$string['pause_after_restore'] = 'إيقاف القواعد بعد الاستعادة';
$string['pause_after_restore_desc'] = 'إيقاف القواعد بعد استعادة المساق';
$string['placeholder_Course_Category_Name'] = 'اسم تصنيف المساق';
$string['placeholder_Course_FullName'] = 'الاسم الكامل للمساق';
$string['placeholder_Course_Url'] = 'رابط المساق';
$string['placeholder_Current_time'] = 'الوقت الحالي';
$string['placeholder_Follow_Link'] = 'اتباع الرابط';
$string['placeholder_Separator'] = 'فاصل الرسائل';
$string['placeholder_Teacher_Address'] = 'عنوان المعلم';
$string['placeholder_Teacher_Email'] = 'البريد الالكتروني للمعلم';
$string['placeholder_Teacher_FirstName'] = 'الاسم الأول للمعلم';
$string['placeholder_Teacher_LastName'] = 'الاسم الأخير للمعلم';
$string['placeholder_Teacher_Username'] = 'اسم المستخدم للمعلم';
$string['placeholder_User_Address'] = 'عنوان المستخدم';
$string['placeholder_User_Email'] = 'البريد الالكتروني للمستخدم';
$string['placeholder_User_FirstName'] = 'الاسم الأول للمستخدم';
$string['placeholder_User_LastName'] = 'الاسم الأخير للمستخدم';
$string['placeholder_User_Username'] = 'اسم المستخدم للمستخدم';
$string['pluginname'] = 'وكيل الإشعارات';
$string['privacy:metadata:actiondetail'] = 'تفصيل الإجراء المرسل إلى المستخدم';
$string['privacy:metadata:actionid'] = 'مُعرَّف الإجراء';
$string['privacy:metadata:courseid'] = 'مُعرَّف المساق';
$string['privacy:metadata:createdat'] = 'وقت إنشاء القاعدة';
$string['privacy:metadata:createdby'] = 'مُعرَّف المستخدم المرتبط بالقاعدة';
$string['privacy:metadata:localnotificationsagentreport'] = 'تقرير وكيل الإشعارات';
$string['privacy:metadata:notificationsagent_cache'] = 'يخزن بيانات الخبء للمستخدمين.';
$string['privacy:metadata:notificationsagent_cache:cache'] = 'البيانات المخبئة';
$string['privacy:metadata:notificationsagent_cache:startdate'] = 'وقت بدء الخبء';
$string['privacy:metadata:notificationsagent_cache:userid'] = 'مُعرَّف المستخدم المرتبط بالخبء';
$string['privacy:metadata:notificationsagent_launched'] = 'يخزن معلومات عن الإشعارات المطلقة إلى المستخدمين.';
$string['privacy:metadata:notificationsagent_launched:timecreated'] = 'بصمة الوقت الذي تم فيه إنشاء السجل';
$string['privacy:metadata:notificationsagent_launched:timemodified'] = 'بصمة الوقت الذي تم فيه آخر تعديل للسجل';
$string['privacy:metadata:notificationsagent_launched:timesfired'] = 'عدد المرات التي تم فيها تحفيز القاعدة';
$string['privacy:metadata:notificationsagent_launched:userid'] = 'مُعرَّف المستخدم المرتبط بالقاعدة المطلقة';
$string['privacy:metadata:notificationsagent_rule'] = 'يخزن القواعد المنشأة من قبل المستخدمين.';
$string['privacy:metadata:notificationsagent_rule:createdat'] = 'بصمة الوقت الذي تم فيه إنشاء القاعدة';
$string['privacy:metadata:notificationsagent_rule:createdby'] = 'مُعرَّف المستخدم الذي أنشأ القاعدة';
$string['privacy:metadata:notificationsagent_triggers'] = 'يخزن المحفزات المرتبطة بالمستخدمين.';
$string['privacy:metadata:notificationsagent_triggers:ruleoff'] = 'القاعدة المرتبطة بالحافز';
$string['privacy:metadata:notificationsagent_triggers:startdate'] = 'تاريخ بدء الحافز';
$string['privacy:metadata:notificationsagent_triggers:userid'] = 'مُعرَّف المستخدم المرتبط بالحافز';
$string['privacy:metadata:notificationsagentreport'] = 'يسجل الرسائل المرسلة إلى المستخدمين والتي قد تحتوي على بعض بياناتهم.';
$string['privacy:metadata:notificationsagentrule'] = 'يخزن القواعد التي قد تحتوي على بعض بيانات المستخدمين.';
$string['privacy:metadata:ruleid'] = 'مُعرَّف للقاعدة';
$string['privacy:metadata:timestamp'] = 'بصمة الوقت لإجراء الإرسال';
$string['privacy:metadata:userid'] = 'مُعرَّف المستخدم المرتبط بهذا الجدول';
$string['report'] = 'تقرير وكيل الإشعارات';
$string['rulecancelled'] = 'القاعدة ألغيَت';
$string['ruledownload'] = 'تصدير القاعدة بمثابة';
$string['ruleid'] = 'مُعرَّف القاعدة';
$string['rulename'] = 'اسم القاعدة';
$string['rulesaved'] = 'القاعدة قد حُفظت';
$string['settings'] = 'الإعدادات';
$string['shareaccept'] = 'القاعدة تمت مشاركتها';
$string['shareallcontent'] = 'أنت على وشك الموافقة على القاعدة المشاركة {$a->title}، هل ترغب في المتابعة؟';
$string['sharealltitle'] = 'الموافقة على القاعدة المشاركة {$a->title}';
$string['sharecontent'] = 'أنت على وشك مشاركة القاعدة {$a->title} مع المشرف، هل ترغب في المتابعة؟';
$string['sharereject'] = 'القاعدة قد رُفضت';
$string['sharetitle'] = 'مشاركة القاعدة {$a->title}';
$string['startdate'] = 'تهيئة تواريخ النشاط';
$string['startdate_desc'] = 'استعمل سطرًا لكل نشاط بالنمط الآتي: اسم الملحق|اسم الجدول|تاريخ البدء|نهاية البدء';
$string['status_acceptactivated'] = 'القاعدة تم تفعيلها';
$string['status_acceptpaused'] = 'القاعدة تم إيقافها';
$string['status_activatecontent'] = 'أنت على وشك تفعيل القاعدة {$a->title} هل ترغب في المتابعة؟';
$string['status_activatetitle'] = 'تفعيل القاعدة {$a->title}';
$string['status_active'] = 'فعالة';
$string['status_broken'] = 'مكسورة';
$string['status_pausecontent'] = 'أنت على وشك إيقاف القاعدة {$a->title} هل ترغب في المتابعة؟';
$string['status_paused'] = 'متوقفة';
$string['status_pausetitle'] = 'إيقاف القاعدة {$a->title}';
$string['status_required'] = 'مطلوب';
$string['statusactivate'] = 'تفعيل';
$string['statuspause'] = 'إيقاف';
$string['subplugintype_notificationsaction'] = 'ملحق الإجراء';
$string['subplugintype_notificationsaction_plural'] = 'ملاحق الإجراء';
$string['subplugintype_notificationsagentaction'] = 'الملاحق الفرعية للإجراء';
$string['subplugintype_notificationscondition'] = 'ملحق الشرط';
$string['subplugintype_notificationscondition_plural'] = 'ملاحق الشرط';
$string['tasktriggers'] = 'مهمة محفزات الإشعارات';
$string['timestamp'] = 'التاريخ';
$string['tracelog'] = 'سجل وقوعات التتبع';
$string['tracelog_desc'] = 'سجل وقوعات التتبع. قم بتعطيله في الموقع الإنتاجي';
$string['type_rule'] = 'القاعدة';
$string['type_sharedrule'] = 'قاعدة تمت مشاركتها';
$string['type_template'] = 'القالب';
$string['unshareaccept'] = 'قاعدة تم إلغاء مشاركتها';
$string['unshareallcontent'] = 'أنت على وشك رفض القاعدة المشاركة {$a->title}، هل ترغب في المتابعة؟';
$string['unsharealltitle'] = 'رفض القاعدة المشاركة{$a->title}';
$string['unsharecontent'] = 'أنت على وشك إلغاء مشاركة القاعدة {$a->title} مع المشرف، هل ترغب في المتابعة؟';
$string['unsharetitle'] = 'إلغاء مشاركة القاعدة {$a->title}';
$string['userid'] = 'مُعرَّف المستخدم';
