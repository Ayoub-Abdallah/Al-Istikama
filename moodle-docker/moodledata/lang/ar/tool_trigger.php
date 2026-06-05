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
 * Strings for component 'tool_trigger', language 'ar', version '5.1'.
 *
 * @package     tool_trigger
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'الإجراء';
$string['actionscurrent'] = 'التهيئة الحالية';
$string['actionshistoric'] = 'التهيئة الماضية';
$string['active'] = 'نشط';
$string['addworkflow'] = 'إضافة سير عمل حافز جديد';
$string['areatomonitor'] = 'المنطقة المزمع مراقبتها';
$string['areatomonitor_help'] = 'منطقة مودل التي تتضمن الحدث المؤدي إلى تفعيل الحافز.';
$string['assigncohortactionstepdesc'] = 'الخطوة التي تسمح بتعيين المستخدم إلى زمرة';
$string['assigncohortactionstepname'] = 'تعيين الزمرة';
$string['autorerun'] = 'تمكين إعادة التشغيل التلقائية';
$string['autorerun_help'] = '';
$string['autorerunduration'] = 'أقل فترة قبل محاولة إعادة التشغيل';
$string['autorerunduration_help'] = 'الفترة الزمنية ما بين إعادتي التشغيل لمحاولة فاشلة.';
$string['autorerunmaxtries'] = 'عدد محاولات إعادة التشغيل';
$string['autorerunmaxtries_help'] = 'أقصى عدد من محاولات التشغيل للتي في حالة الخطأ.';
$string['autorerunsettings'] = 'إعادة تشغيل تلقائية';
$string['autorerunsettingsdesc'] = '';
$string['availablefields'] = 'الحقول المتاحة';
$string['badstepclass'] = 'اسم فئة خطوة خاطئ';
$string['badsteptype'] = 'نوع خطوة خاطئ';
$string['cachedef_eventsubscriptions'] = 'خبء اشتراك حدث محفز الأداة';
$string['categoryidfield'] = 'حقل بيانات مُعرَّف التصنيف';
$string['categoryidfield_help'] = 'يمكنك استعمال مُعرَّف التصنيف';
$string['cleanupsettings'] = 'تطهير الإعدادات';
$string['cleanupsettingsdesc'] = 'الإعدادات الآتية تتحكم بمهام التطهير للملحق.';
$string['cli_extractfields'] = 'استخراج الحقول الخاصة بالأحداث المعلومة من قاعدة البيانات...';
$string['cli_filefail'] = 'فشلت كتابة الملف: {$a}';
$string['cli_filesummary'] = 'تمت كتابة الملف إلى: {$a}';
$string['cli_writingfile'] = 'تجري كتابة تعاريف حقل حدث {$a} إلى الملف...';
$string['cohortidfield'] = 'مٌعرَّف الزمرة';
$string['contextidfield'] = 'حقل بيانات مُعرَّف السياق';
$string['contextidfield_help'] = 'يمكنك استعمال مُعرَّف السياق كرقم أو كاسم حقل من بيانات سير العمل';
$string['core'] = 'النواة';
$string['courseidfield'] = 'حقل بيانات مُعرَّف المساق';
$string['courseidfield_help'] = 'يمكنك استعمال مُعرَّف المساق كرقم أو كاسم حقل من بيانات سير العمل';
$string['debounce'] = 'مضاد الارتداد';
$string['debounce_desc'] = 'خطوة مضاد الارتداد هي خطوة خاصة تقوم بوضع سير العمل في طابور التشغيل لتنفيذه بعد فترة محددة من الوقت باستعمال آخر عيِّنة من سير العمل التي كانت تتواجد في الفترة، مع إعادة ضبط للفترة يحدث عند كل تحفيز جديد لعيِّنة سير العمل.';
$string['debouncecontext'] = 'حقول مطابقة مضاد الارتداد';
$string['debouncecontext_help'] = 'الحقول التي سيُنظر في مطابقتها في حدث ما من أجل بدء مضاد الارتداد. كل الحقول المحددة ينبغي تطابقها من أجل مضادة الارتداد.';
$string['debounceduration'] = 'فترة مضادة ارتداد الأحداث';
$string['deferred'] = 'مؤجلة';
$string['deleterule'] = 'حذف القاعدة';
$string['deletestep'] = 'حذف الخطوة';
$string['description'] = 'الوصف';
$string['downloadrule'] = 'تنزيل القاعدة';
$string['downloadrundetails'] = 'تنزيل تفاصيل التشغيل';
$string['downloadworkflow'] = 'تنزيل ماضي سير العمل';
$string['draft'] = 'مسودة';
$string['draftmode'] = 'وضعية المسودة';
$string['draftmode_help'] = 'استعمل وضعية المسودة لاختبار سير العمل مع انطلاق المحفزات.';
$string['duplicatedworkflowname'] = '{$a} (نسخة)';
$string['duplicaterule'] = 'تكرار القاعدة';
$string['editrule'] = 'تحرير القاعدة';
$string['editsettings'] = 'إعدادات سير العمل';
$string['editstep'] = 'تحرير الخطوة';
$string['editworkflow'] = 'تحرير سير عمل الحافز';
$string['emailactionstepdesc'] = 'خطوة من شأنها السماح بإرسال البريد الالكتروني';
$string['emailactionstepname'] = 'البريد الالكتروني';
$string['emailcontent'] = 'المحتوى';
$string['emailcontent_help'] = 'المحتوى المزمع استعماله في البريد الالكتروني';
$string['emailsubject'] = 'الموضوع';
$string['emailsubject_help'] = 'النص المزمع استعماله في موضوع البريد الالكتروني';
$string['emailto'] = 'إلى';
$string['emailto_help'] = 'إلى من تذهب الرسالة';
$string['erroreditstep'] = 'وقع خطأ ما خلال محاولة حفظ سير عمل الخطوة. ترجى المحاولة مجددًا.';
$string['errorimportworkflow'] = 'وقع خطأ ما خلال استيراد سير العمل. ترجى المحاولة مجددًا.';
$string['erroronfail'] = 'خطأ عند الفشل';
$string['erroronfail_help'] = 'ضع الخطوة على حالة الخطأ بدلاً من الفشل';
$string['errorsavingworkflow'] = 'وقع خطأ ما خلال محاولة حفظ السير عمل. ترجى المحاولة مجددًا.';
$string['errorstep'] = 'الخطوة الخاطئة {$a}';
$string['errorstepretrypending'] = '(تنتظر إعادة المحاولة {$a})';
$string['event'] = 'الحدث';
$string['eventdescription'] = 'وصف الحدث';
$string['eventfields'] = 'حقول الحدث';
$string['eventid'] = 'مُعرَّف الحدث';
$string['eventtomonitor'] = 'الحدث المزمعة مراقبته';
$string['eventtomonitor_help'] = 'حدث مودل الذي عنده يتم تحفيز سير العمل.';
$string['executenext'] = 'تنفيذ الخطوة الآتية';
$string['executenextconfirm'] = 'هل أنت متأكد من رغبتك في تنفيذ الخطوة الآتية؟ سيتم تنفيذها بناءً على البيانات المستحصلة من هذه الخطوة.';
$string['expectedresponse'] = 'الترميز المتوقع للاستجابة';
$string['expectedresponse_help'] = 'أدخل نصوص الاستجابة بصيغة HTTP التي تتوقع تلقيها من الخطوة. أي رؤوس استجابة أخرى ستتسبب في تخطئة الخطوة.';
$string['failedstep'] = 'خطوة فاشلة {$a}';
$string['filter'] = 'المرشح';
$string['filtercancelled'] = 'ملغى';
$string['filterdeferred'] = 'مؤجل';
$string['filtererrored'] = 'خاطئ';
$string['filterfailed'] = 'فاشل';
$string['filterlabelrunstatus'] = 'الترشيح حسب حالة التشغيل';
$string['filterlabeluser'] = 'الترشيح حسب اسم المستخدم أو مُعرَّفه';
$string['filterpassed'] = 'ناجزة';
$string['filterreset'] = 'إعادة تعيين';
$string['filtersubmit'] = 'مرشح';
$string['historyduration'] = 'فترة تخزين عيِّنات الحوافز';
$string['historydurationdesc'] = 'هذه تمثل فترة تخزين عيِّنات الحوافز المفصلة. بعد تلك الفترة، لن يعود بالإمكان الرجوع لتنفيذ خطوات العيِّنة أو معاينة بياناتها.';
$string['historysettings'] = 'إعدادات ماضي سير العمل';
$string['historysettingsdesc'] = 'هذه الإعدادات توفر التحكم بكيفية خزن ماضي سير العمل.';
$string['httpostactionheaders'] = 'الرؤوس';
$string['httpostactionheaders_help'] = 'رؤوس الطلبات المزمع إرسالها';
$string['httpostactionparams'] = 'العوامل';
$string['httpostactionparams_help'] = 'العوامل المزمع إرسالها مع الطلب';
$string['httpostactionurl'] = 'الرابط';
$string['httpostactionurl_help'] = 'الرابط المزمع نشر البيانات فيه.';
$string['httpostmethod'] = 'طريقة HTTP';
$string['httpostmethod_help'] = 'طريقة HTTP للطلب المعطى.';
$string['httppostactionstepdesc'] = 'خطوة من شأنها تمكين مودل من إرسال البيانات إلى نقاط نهاية HTTP/S.';
$string['httppostactionstepname'] = 'طلب HTTP';
$string['importmodaltitle'] = 'استيراد سير العمل من ملف';
$string['importworkflow'] = 'استيراد سير العمل';
$string['inputprefixrole'] = 'البادئة المستعملة في التحري عن الأدوار';
$string['inputprefixuser'] = 'البادئة المستعملة في التحري عن المستخدمي';
$string['invalidjson'] = 'ملف استيراد سير العمل يحتوي على ترميز JSON خاطئ ويتعذر استيراده';
$string['invalidversion'] = 'إن ملف استيراد سير العمل ليس صالحًا مع هذا الإصدار من الملحق';
$string['jsonencode'] = 'عوامل ترميز JSON';
$string['jsonencode_help'] = 'عند تمكينه، القيم التي في حقل العوامل سيتكون بترميز JSON.';
$string['lasttriggered'] = 'المحفز أخيرًا';
$string['learning'] = 'تمكين وضع التعلم';
$string['learning_help'] = 'وضع التعلم ستجمع بيانات عن الحقول المتاحة للأحداث المستثارة';
$string['learningsettings'] = 'إعدادات وضع التعلم';
$string['learningsettingsdesc'] = 'يوفر كل حدث في مودل مجموعة من الحقول التي يمكن استعمالها كعناصر نائبة في سير العمل الذي يتم تشغيله لهذا الحدث.<br/>
يأتي هذا الملحق مع مجموعة محددة مسبقًا من العناصر النائبة لبعض أحداث مودل الأساسية. يؤدي تمكين وضع التعلم إلى تحديث قائمة العناصر النائبة المتاحة لأحداث مودل بشكل ديناميكي.<br/><br/>
يمكن أن يتسبب هذا الإعداد في حدوث مشكلات في أداء مودل ويجب تمكينه فقط عندما تكون هناك أحداث مثل تلك الموجودة في اللاحق التي لا تتواجد فيها تعريفات لعناصر نائبة. <br/>
يرجى الرجوع إلى وثائق الملحق لمزيد من المعلومات.';
$string['lookup'] = 'التحري';
$string['manage'] = 'إدارة';
$string['manageworkflow'] = 'إدارة سير العمل';
$string['messageprovider:tool_trigger'] = 'إشعارات محفز الحدث';
$string['modaltitle'] = 'السماح بخطوة سير العمل.';
$string['movestepdown'] = 'نقل الخطوة نحو النهاية';
$string['movestepup'] = 'نقل الخطوة نحو البداية';
$string['name'] = 'الاسم';
$string['newrunfailed'] = 'التشغيل {$a->prev} تمت إعادة تشغيله بمثابة التشغيل {$a->new} ثم أخطأ مجددًا.';
$string['noavailablefields'] = 'لا تتوفر أي حقول، خذ بعين الاعتبار تشغيل وضع التعلم.';
$string['noworkflowfile'] = 'لا يوجد ملف سير العمل';
$string['numsteps'] = 'الخطوات';
$string['outputprefix'] = 'بادئة الحقول المضافة';
$string['pluginname'] = 'محفز الأحداث';
$string['pluginname_help'] = 'محفز الأحداث لمودل';
$string['pluginsettings'] = 'إعدادات الملحق';
$string['prevstep'] = 'مٌعرَّف الخطوة السابقة';
$string['privacy:metadata:events'] = 'البيانات من أحداث مودل الخاضعة للمراقبة';
$string['privacy:metadata:events:anonymous'] = 'فيما إذا تم تأشير الحدث على أنه غير مشخصن';
$string['privacy:metadata:events:eventname'] = 'اسم الحدث';
$string['privacy:metadata:events:ip'] = 'عنوان IP المستعمل عند وقت الحدث';
$string['privacy:metadata:events:origin'] = 'أصل الحدث';
$string['privacy:metadata:events:other'] = 'معلومات إضافية عن الحدث';
$string['privacy:metadata:events:realuserid'] = 'مُعرَّف المستخدم الحقيقي الذي وراء الحدث، عند تقمص حساب مستخدم آخر';
$string['privacy:metadata:events:relateduserid'] = 'مُعرَّف المستخدم ذي الصلة بالحدث';
$string['privacy:metadata:events:timecreated'] = 'وقت حدوث الحدث';
$string['privacy:metadata:events:userid'] = 'مُعرَّف المستخدم ذي أثار هذا الحدث';
$string['privacy:metadata:learnevents'] = 'البيانات من أحداث التعليم لمودل الخاضعة للمراقبة';
$string['privacy:metadata:learnevents:anonymous'] = 'فيما إذا تم تأشير حدث التعليم على أنه غير مشخصن';
$string['privacy:metadata:learnevents:eventname'] = 'اسم حدث التعليم';
$string['privacy:metadata:learnevents:ip'] = 'عنوان IP المستعمل عند وقت حدث التعليم';
$string['privacy:metadata:learnevents:origin'] = 'أصل حدث التعليم';
$string['privacy:metadata:learnevents:other'] = 'معلومات إضافية عن حدث التعليم';
$string['privacy:metadata:learnevents:realuserid'] = 'مُعرَّف المستخدم الحقيقي الذي وراء حدث التعليم، عند تقمص حساب مستخدم آخر';
$string['privacy:metadata:learnevents:relateduserid'] = 'مُعرَّف المستخدم ذي الصلة بحدث التعليم هذا';
$string['privacy:metadata:learnevents:timecreated'] = 'وقت حدوث حدث التعليم';
$string['privacy:metadata:learnevents:userid'] = 'مُعرَّف المستخدم ذي أثار حدث التعليم هذا';
$string['privacy:metadata:runhistory'] = 'هذا الجدول يخزن البيانات التاريخية لخطوات تشغيل الحوافز من أجل السماح بإعادة تشغيلها.';
$string['privacy:metadata:runhistory:executed'] = 'الوقت الذي تم فيه تنفيذ الخطوة';
$string['privacy:metadata:runhistory:results'] = 'جملة مرمزة من النتائج المترتبة على تنفيذ الخطوة';
$string['privacy:metadata:workflowhistory'] = 'هذا الجدول يخزن بيانات تاريخية لتشغيلات الحوافز من أجل السماح بإعادة تشغيلها.';
$string['privacy:metadata:workflowhistory:event'] = 'الإدخال المرمز للحدث الذي أثار تشغيل المحفز';
$string['privacy:metadata:workflowhistory:timecreated'] = 'وقت تنفيذ تشغيل الحافز';
$string['privacy:path:events'] = '';
$string['privacy:path:learnevents'] = '';
$string['queuelimit'] = 'حد الطابور';
$string['queuelimitdesc'] = 'أقصى عدد من المهام المزمعة محاولتها ومعالجتها في الطابور';
$string['queuesettings'] = 'إعدادات طابور سير العمل';
$string['queuesettingsdesc'] = 'هذه الإعدادات تتحكم بكيفية إدارة الطابور.';
$string['realtime'] = 'الوقت الحقيقي';
$string['rerunallcurr'] = 'إعادة تشغيل كل التشغيلات الخاطئة مع التهيئة الحالية';
$string['rerunallcurrconfirm'] = 'هل أنت متأكد من رغبتك بإعادة تشغيل كل التشغيلات الخاطئة باستعمال التهيئة الحالية لسير العمل؟';
$string['rerunallhist'] = 'إعادة تشغيل كل التشغيلات الخاطئة مع التهيئة الماضية';
$string['rerunallhistconfirm'] = 'يوفر كل حدث في مودل مجموعة من الحقول التي يمكن استعمالها كعناصر نائبة في سير العمل الذي يتم تشغيله لهذا الحدث.<br/>
يأتي هذا الملحق مع مجموعة محددة مسبقًا من العناصر النائبة لبعض أحداث مودل الأساسية. يؤدي تمكين وضع التعلم إلى تحديث قائمة العناصر النائبة المتاحة لأحداث مودل بشكل ديناميكي.<br/><br/>
يمكن أن يتسبب هذا الإعداد في حدوث مشكلات في أداء مودل ويجب تمكينه فقط عندما تكون هناك أحداث مثل تلك الموجودة في اللاحق التي لا تتواجد فيها تعريفات لعناصر نائبة. <br/>
يرجى الرجوع إلى وثائق الملحق لمزيد من المعلومات.إعادة تشغيل كل التشغيلات الخاطئة باستعمال التهيئة الماضية لسير العمل؟';
$string['rerunerrors'] = 'كل التشغيلات الخاطئة تمت إعادة تشغيلها.';
$string['rerunstep'] = 'إعادة تشغيل الخطوة';
$string['rerunstepandfinish'] = 'إعادة تشغيل الخطوة مع إنهاء التشغيل';
$string['rerunstepandfinishconfirm'] = 'هل أنت متأكد من رغبتك بإعادة تشغيل هذه الخطوة مع تنفيذ كل الخطوات حتى إنهاء التشغيل؟';
$string['rerunstepandnext'] = 'إعادة تشغيل الخطوة مع المتابعة';
$string['rerunstepandnextconfirm'] = 'هل أنت متأكد من رغبتك بإعادة تشغيل هذه الخطوة مع تنفيذ الخطوة اللاحقة في سير العمل؟';
$string['rerunstepconfirm'] = 'هل أنت متأكد من رغبتك بإعادة تشغيل الخطوة؟ هذا من شأنه تنفيذ كل إجراءاتها.';
$string['rerunworkflow'] = 'إعادة تشغيل سير عمل';
$string['rerunworkflowconfirm'] = 'هل أنت متأكد من رغبتك بإعادة تشغيل سير العمل مع التهيئة الحالية له؟ هذا من شأنه تنفيذ كل الإجراءات بناءً على الحدث الأصلي.';
$string['roleassignactionstepdesc'] = 'تعيين دور إلى المستخدم في السياق المعطى';
$string['roleassignactionstepname'] = 'تعيين الأدوار';
$string['roleidfield'] = 'حقل بيانات مُعرَّف الدور';
$string['roleidfield_help'] = 'يمكنك استعمال مُعرَّف الدور بمثابة رقم أو بمثابة اسم الحقل من بيانات سير العمل';
$string['rolesunassignactionstepdesc'] = 'خطوة من شأنها إلغاء تعيين كل الأدوار للمستخدم.';
$string['rolesunassignactionstepname'] = 'إلغاء تعيين الأدوار';
$string['roleunassignactionstepdesc'] = 'خطوة من شأنها إلغاء تعيين دور معين للمستخدم.';
$string['roleunassignactionstepname'] = 'إلغاء تعيين الدور';
$string['runid'] = 'مُعرّّف التشغيل';
$string['runpassed'] = 'الخطوة الناجزة {$a}';
$string['runpassednonum'] = 'ناجز';
$string['runstatus'] = 'حالة التشغيل';
$string['step_action_email:privacy:desc'] = 'يمكن تهيئة هذا الملحق لإرسال رسائل البريد الالكتروني تحتوي على بيانات من مودل.';
$string['step_action_httppost:privacy:desc'] = 'يمكن تهيئة هذا الملحق لإرسال طلبات HTTP إلى عناوين خارجية، تحتوي على بيانات من مودل.';
$string['step_action_logdump_desc'] = 'هذه الخطوة تطبع الحدث وخطوات سير العمل إلى سجل وقوعات مشغل الوظائف الدورية. (غالبًا مفيدة لأغراض التجربة).';
$string['step_action_logdump_name'] = 'وقوعات الوظائف الدورية';
$string['step_action_role_assign_contextidfield'] = 'حقل بيانات مُعرَّف السياق';
$string['step_action_role_assign_roleidfield'] = 'حقل بيانات مُعرَّف الدور';
$string['step_action_role_assign_useridfield'] = 'حقل بيانات مُعرَّف المستخدم';
$string['step_action_role_unassign_contextidfield'] = 'حقل بيانات مُعرَّف السياق';
$string['step_action_role_unassign_roleidfield'] = 'حقل بيانات مُعرَّف الدور';
$string['step_action_role_unassign_useridfield'] = 'حقل بيانات مُعرَّف المستخدم';
$string['step_action_webservice:privacy:desc'] = 'هذا الملحق يمكن تهيئته لطلب دوال خدمات الويب مباشرة وعلى ضوء ذلك يمكنه معالجة البيانات من مودل اعتمادًا على الدالة المطلوبة.';
$string['step_filter_fail_desc'] = 'خطوة من شأنها أن تفشل دومًا. (مفيدة غالبًا لأغراض التجربة).';
$string['step_filter_fail_name'] = 'فشل';
$string['step_lookup_category_categoryidfield'] = 'حقل بيانات مُعرَّف التصنيف';
$string['step_lookup_category_desc'] = 'هذه الخطوة تتحرى عن بيانات تصنيف ما.';
$string['step_lookup_category_name'] = 'التحري عن التصنيف';
$string['step_lookup_cohort_desc'] = 'هذه الخطوة تتحرى عن بيانات الزمرة لمستخدم ما.';
$string['step_lookup_cohort_name'] = 'التحري عن الزمرة';
$string['step_lookup_course:privacy:categorydata_desc'] = 'بيانات عن تصنيفات المساقات، تتضمن الاسم، الوصف، إلخ.';
$string['step_lookup_course:privacy:coursedata_desc'] = 'بيانات عن المساقات، تتضمن المُعرَّف، اسم المقرر، تاريخي البدء والانتهاء، إلخ.';
$string['step_lookup_course_courseidfield'] = 'حقل بيانات مُعرَّف المساق';
$string['step_lookup_course_desc'] = 'هذه الخطوة تتحرى عن بيانات مساق ما.';
$string['step_lookup_course_name'] = 'التحري عن المساق';
$string['step_lookup_roles:privacy:userdata_desc'] = 'هذه الخطوة تتحرى عن أدوار المستخدم ضمن سياقات متعددة..';
$string['step_lookup_roles_desc'] = 'هذه الخطوة تتحرى عن أدوار المستخدم.';
$string['step_lookup_roles_name'] = 'التحري عن أدوار المستخدم';
$string['step_lookup_user:privacy:userdata_desc'] = 'بيانات شخصية عن المستخدمين، كأسماء دخولهم، أسمائهم، عناوين بريدهم الالكتروني، إلخ.';
$string['step_lookup_user_desc'] = 'هذه الخطوة تتحرى عن بيانات المستخدم.';
$string['step_lookup_user_name'] = 'التحري عن المستخدم';
$string['step_lookup_user_nodeleted'] = 'أتريد الخروج إذا تم حذف المستخدم؟';
$string['step_lookup_user_useridfield'] = 'حقل بيانات مُعرَّف المستخدم';
$string['stepclass'] = 'الخطوة';
$string['stepclass_help'] = 'إختر الخطوة لتطبيقها';
$string['stepdescription'] = 'وصف الخطوة';
$string['stepdescription_help'] = 'وصف ذو معنى للخطوة';
$string['stepid'] = 'مُعرَّف الخطوة';
$string['stepmodalbutton'] = 'إضافة خطوة سير العمل';
$string['stepname'] = 'اسم الخطوة';
$string['stepname_help'] = 'اسم هذه الخطوة';
$string['stepnotfound'] = 'الخطوة غير موجودة';
$string['stepnumber'] = 'رقم الخطوة';
$string['steprequired'] = 'سير العمل ينبغي أن يحتوي على خطوة واحدة على الأقل.';
$string['stepresults'] = 'نتائج الخطوة:';
$string['steptype'] = 'نوع الخطوة';
$string['steptype_help'] = 'نوع الخطوة المزمع تطبيقها.';
$string['sttepidembed'] = 'مُعرَّف الخطوة: {$a}';
$string['taskcleanup'] = 'حذف الأحداث القديمة التي سبقت معالجتها';
$string['taskcleanuphistory'] = 'حذف البيانات التاريخية للحوافز';
$string['taskemptyhistoryconfig'] = 'خطأ: تعريف مدة الفترة التاريخية مفقود. يجري الخروج الآن...';
$string['tasklearn'] = 'تعرف على الحقول التي في الأحداث المخزونة.';
$string['tasklearnstart'] = 'يجري البدء بمعالجة استخراج حقول الحدث...';
$string['taskprocessworkflows'] = 'المهمة المجدولة لمعالجة سير العمل';
$string['timeexecuted'] = 'وقت تنفيذها';
$string['timetocleanup'] = 'وقت تطهير الأحداث القديمة';
$string['timetocleanup_help'] = 'هذا الإعداد يضبط فترة الاستبقاء على سير العمل المشغلة بنجاح في قاعدة بيانات مودل قبل أن يُصار إلى إزالتها.';
$string['trigger:exportrundetails'] = 'تنزيل ماضي تشغيل خطوات محفز الأحداث المصدرة';
$string['trigger:exportworkflowhistory'] = 'تنزيل ماضي تشغيل سير عمل محفز الأحداث المصدرة';
$string['trigger:manageworkflows'] = 'إنشاء وتهيئة سير عمل محفزة بالأحداث تلقائية';
$string['triggerhistory'] = 'الماضي';
$string['triggernumber'] = 'رقم الحافز';
$string['triggernumberembed'] = 'رقم الحافز: {$a}';
$string['update_trigger_helper_task'] = 'المهمة المخصصة لتفريغ أعمال معالجة الترقية';
$string['useridfield'] = 'حقل بيانات مُعرَّف المستخدم';
$string['useridfield_help'] = 'يمكنك إضافة مُعرَّف المستخدم بمثابة رقم أو بمثابة اسم الحقل من بيانات سير العمل';
$string['viewdetailedrun'] = 'معاينة تفاصيل التشغيل';
$string['viewstepinfo'] = 'معاينة معلومات الخطوة';
$string['viewtriggerrun'] = 'معاينة التشغيل';
$string['warningdebugging'] = 'وضع كشف الأخطاء معطل بالنسبة لسير العمل الحالي. لتتمكن من تأريخ الوقوعات، عليك <a href = "/admin/tool/trigger/edit.php?workflowid={$a}">بتمكين وضع كشف الأخطاء لسير العمل</a>.';
$string['webserviceactionfunctionname'] = 'الدالة';
$string['webserviceactionfunctionname_help'] = 'دالة خدمة الويب المزمع طلبها. أنظر <a href="/admin/webservice/documentation.php">توثيقات واجهة برمجة التطبيق</a>';
$string['webserviceactionparams'] = 'العوامل';
$string['webserviceactionparams_help'] = 'عوامل الدالة - حاليًا مع دعم JSON.';
$string['webserviceactionstepdesc'] = 'خطوة من شأنها تمكين سير العمل من تحفيز دوال خدمات الويب.';
$string['webserviceactionstepname'] = 'دالة خدمة الويب';
$string['webserviceactionusername'] = 'مَن';
$string['webserviceactionusername_help'] = 'المستخدم (اسم المستخدم) الذي ستُنفذ من أجله هذه الخطوة ضمن السياق. تذهب تلقائيًا إلى المستخدم (المشرف الرئيسي) إذا لم يتم ذكره بشكل صريح';
$string['workflowactive'] = 'سير العمل نشط';
$string['workflowactive_help'] = 'سير العمل النشطة فقط ستتم معالجتها عند تحفيز الحدث.';
$string['workflowcopysuccess'] = 'سير العمل تم تكراره بنجاح';
$string['workflowdebug'] = 'وضع كشف الأخطاء';
$string['workflowdebug_help'] = 'وضع كشف الأخطاء يخزن بيانات تاريخية عن سير العمل هذا لاستعمالها لاحقًا في تحسينه.';
$string['workflowdeleteareyousure'] = 'هل أنت متأكد من رغبتك في حذف سير العمل "{$a}"؟';
$string['workflowdeletesuccess'] = 'تم حذف سير العمل بنجاح';
$string['workflowdescription'] = 'الوصف';
$string['workflowdescription_help'] = 'وصف موجز عن الغرض من سير العمل هذا.';
$string['workflowfile'] = 'ملف سير العمل';
$string['workflowid'] = 'مُعرَّف سير العمل: {$a}';
$string['workflowimported'] = 'تم استيراد سير العمل بنجاح';
$string['workflowname'] = 'الاسم';
$string['workflowname_help'] = 'الاسم المقروء لسير العمل هذا.';
$string['workflowoverview'] = 'استعراض سير العمل';
$string['workflowrealtime'] = 'المعالجة في الوقت الحقيقي';
$string['workflowrealtime_help'] = 'عند تمكينه، سيتم تحفيز سير العمل هذا بالتزامن كجزء من الحدث. كن حذرًا عن تمكينه نظرًا لكون سير العمل ذات متطلبات التشغيل الطويلة ستحجب واجهة المستخدم.';
$string['workflowviewhistory'] = 'معاينة ماضي سير العمل';
