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
 * Strings for component 'plagiarism_turnitinsim', language 'ar', version '5.1'.
 *
 * @package     plagiarism_turnitinsim
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accessoptions'] = 'وصول الطالب';
$string['accessoptions_help'] = 'سيتمكن الطلاب من الوصول إلى تقرير التشابه للعمل المُرسَل بعد إنشاء التقرير.';
$string['accessstudents'] = 'تمكين الطلاب من عرض تقارير التشابه';
$string['addtoindex'] = 'فهرسة جميع المهام';
$string['code'] = 'رمز';
$string['connecttest'] = 'اختبار اتصال Turnitin';
$string['connecttestfailed'] = 'فشل في عملية اختبار الاتصال';
$string['connecttestsuccess'] = 'نجاح عملية اختبار الاتصال';
$string['dbexport'] = 'تصدير قاعدة البيانات';
$string['dbexporttable'] = 'تصدير بيانات {$a}';
$string['defaultsettings'] = 'الإعدادات الافتراضية';
$string['errorenabledfeatures'] = 'تعذر الوصول إلى قائمة الميزات التي تم تمكينها';
$string['errorgettingsubmissioninfo'] = 'حدث خطأ عند محاولة الوصول إلى معلومات التسليم';
$string['errorprocessingdeletedsubmission'] = 'ينتمي هذا التسليم إلى مهمة محذوفة، تعذر معالجته.';
$string['errorquizattemptnotfound'] = 'تعذر العثور على محاولة الاختبار لهذا التسليم.';
$string['errortoolarge'] = 'لن يتم إرسال هذا الملف إلى ملحق Turnitin لتجاوزة الحد الأقصى من الحجم {$a} المسموح به';
$string['eulaaccept'] = 'أوافق على شروط اتفاقية ترخيص المستخدم النهائي (EULA) لـ Turnitin';
$string['eulaaccepted'] = 'نشكرك على قبول شروط اتفاقية ترخيص المستخدم النهائي (EULA) لملحق Turnitin الجديدة. سيتم إرسال جميع التسليمات القادمة إلى  Turnitin للمعالجة.';
$string['eulaalreadyaccepted'] = 'لقد وافقت بالفعل على اتفاقية ترخيص المستخدم النهائي (EULA) لملحق Turnitin الأخيرة.';
$string['euladecline'] = 'لا أوافق على اتفاقية ترخيص المستخدم النهائي (EULA) لـ Turnitin';
$string['euladeclined'] = 'لن يتم إرسال التسليمات الخاصة بك إلى ملحق Turnitin بسبب عدم موافقتك على شروط اتفاقية ترخيص المستخدم النهائي (EULA) لـ Turnitin.';
$string['eulaheader'] = 'اتفاقية ترخيص المستخدم النهائي (EULA) لملحق Turnitin';
$string['eulalink'] = 'لإرسال هذا التسليم إلى Turnitin، ينبغي عليك قبول <a href="{$a}" target="_blank">اتفاقية ترخيص المستخدم النهائي لـ Turnitin</a>.';
$string['eulalinkgeneric'] = 'أذا أردت لتسليماتك المستقبلية أن يتم إرسالها إلى Turnitin، ينبغي عليك قبول <a href="{$a}" target="_blank">اتفاقية الترخيص المستخجم النهائي لـ Turnitin</a>.';
$string['eulalinkmodal'] = 'لإرسال هذا التسليم إلى Turnitin، ينبغي عليك قبول <a href="#" class="eula_link">اتفاقية الترخيص المستخجم النهائي لـTurnitin</a>.';
$string['eulanotrequired'] = 'أنت غير مطالب بقبول اتفاقية ترخيص المستخجم النهائي لـ Turnitin';
$string['excludebiblio'] = 'المراجع';
$string['excludeoptions'] = 'استبعد من تقارير التشابه';
$string['excludeoptions_help'] = 'لن يتم عرض الخيارات المحددة على أنها متطابقة مع أي مصدر في تقارير التشابه.';
$string['excludequotes'] = 'الاقتباسات';
$string['faultcode'] = 'كود خاطئ';
$string['getwebhookfailure:message'] = 'قد يكون هناك مشكلة مع webhook الذي قمت بتسجيله في Turnitin لملحق السرقة الأدبية. تعذر اتصال المهمة المجدولة لفحص ذلك مع ملحق Turnitin للسرقة الأدبية. الرجاء التحقق من سجلاتك.';
$string['getwebhookfailure:subject'] = 'حدث خطأ في عملية تحقق Webhook من Turnitin';
$string['indexoptions'] = 'فهرسة التسليمات';
$string['indexoptions_help'] = 'سيتم إتاحة التقارير المسلمة ليتم مقارنتها في تقارير التشابه.';
$string['invalidtablename'] = 'الجدول {$a} لا يمكن تصديره';
$string['line'] = 'خط';
$string['message'] = 'رسالة';
$string['messageprovider:digital_receipt_instructor'] = 'الإيصال الرقمي للمدرس حول ما تم إرساله إلى Turnitin';
$string['messageprovider:digital_receipt_student'] = 'الإيصال الرقمي للطالب حول ما تم إرساله إلى Turnitin';
$string['messageprovider:get_webhook_failure'] = 'حدث خطأ في عملية تحقق Webhook من Turnitin';
$string['messageprovider:new_eula'] = 'إصدار اتفاقية ترخيص المستخدم النهائي (EULA) لملحق Turnitin الجديد';
$string['neweula:message'] = 'أطلق Turnitin إصدار اتفاقية ترخيص المستخدم النهائي (EULA) جديد, للحصول على المزيد من المعلومات انقر  <a href="{$a}">هنا</a>.';
$string['neweula:subject'] = 'إصدار اتفاقية ترخيص المستخدم النهائي الجديد لـ Turnitin';
$string['pluginname'] = 'ملحق فحص النزاهة الأكاديمية Turnitin';
$string['pluginsetup'] = 'الإعداد';
$string['privacy:metadata:plagiarism_turnitinsim_client'] = 'لإرسال التسليم إلى Turnitin بنجاح، لا بد من تبادل بيانات المستخدم ما بين Moodle وملحق Turnitin. للحصول على المزيد من المعلومات حول ملحقات Moodle واللائحة العامة لحماية البيانات، يرجى زيارة الرابط التالي: https://help.turnitin.com/feedback-studio/moodle/moodle-plugins-and-gdpr.htm';
$string['privacy:metadata:plagiarism_turnitinsim_client:firstname'] = 'تم إرسال الاسم الأول للمستخدم إلى Turnitin عند إطلاق معاينة Turnitin ليكون بالإمكان التعرف عليه';
$string['privacy:metadata:plagiarism_turnitinsim_client:lastname'] = 'تم إرسال الاسم الأخير للمستخدم إلى Turnitin عند إطلاق معاينة Turnitin ليكون بالإمكان التعرف عليه';
$string['privacy:metadata:plagiarism_turnitinsim_client:submission_content'] = 'يرجى أن تكون مدركاً بأن محتوى الملف/التسليم يتم إرسالها إلى Turnitin للمعالجة';
$string['privacy:metadata:plagiarism_turnitinsim_client:submission_filename'] = 'اسم الملف المسلَّم سيتم إرساله إلى Turntin ليكون بالإمكان التعرف عليه';
$string['privacy:metadata:plagiarism_turnitinsim_client:submission_title'] = 'عنوان التسليم سيتم إرساله إلى Turntin ليكون بالإمكان التعرف عليه';
$string['privacy:metadata:plagiarism_turnitinsim_sub'] = 'المعلومات التي تربط التسليم المُرسل لـ Moodle مع التسليم المُرسل لـ Turnitin';
$string['privacy:metadata:plagiarism_turnitinsim_sub:identifier'] = 'يتم استخدام hash في Moodle حتى يتم تعريف الملف المُرسل.';
$string['privacy:metadata:plagiarism_turnitinsim_sub:itemid'] = 'يحدد رقم المعرف الفريد الخاص بالتسليم الذي تم إرساله لنوع الوحدة ذات الصلة';
$string['privacy:metadata:plagiarism_turnitinsim_sub:overallscore'] = '.درجة التشابه النهائية للتسليم';
$string['privacy:metadata:plagiarism_turnitinsim_sub:submittedtime'] = 'يشير الطابع الزمني إلى موعد إرسال المستخدم تسليمه إلى Turnitin.';
$string['privacy:metadata:plagiarism_turnitinsim_sub:turnitinid'] = 'رقم المعرف المستعمل من قبل Turnitin للدلالة على التسليم.';
$string['privacy:metadata:plagiarism_turnitinsim_sub:userid'] = 'رقم المعرف الخاص بالمستخدم الذي قام بالتسليم.';
$string['privacy:metadata:plagiarism_turnitinsim_users'] = 'المعلومات التي تربط مستخدم Moodle مع مستخدم Turnitin.';
$string['privacy:metadata:plagiarism_turnitinsim_users:lasteulaaccepted'] = 'آخر نسخة  حول قبول المستخدم اتفاقية ترخيص المستخجم النهائي لـ Turnitin';
$string['privacy:metadata:plagiarism_turnitinsim_users:lasteulaacceptedlang'] = 'اللغة المستخدمة للإشارة إلى إلى آخر مرة قبل بها المستخدم اتفاقية ترخيص المستخجم النهائي لـ Turnitin';
$string['privacy:metadata:plagiarism_turnitinsim_users:lasteulaacceptedtime'] = 'يشير الطابع الزمني إلى آخر مرة قبل بها المستخدم اتفاقية ترخيص المستخجم النهائي لـ Turnitin';
$string['privacy:metadata:plagiarism_turnitinsim_users:turnitinid'] = 'المُعرَّف المستعمل من قبل Turnitin للدلالة على المستخدم';
$string['privacy:metadata:plagiarism_turnitinsim_users:userid'] = 'رقم معرف المستخدم الذي قام بإرسال التسليم';
$string['queuedrafts'] = 'معالجة مسودة التسليمات';
$string['queuedrafts_help'] = 'يرجى ملاحظة أن أن التسليمات التي تكون على شكل مسودة لن يتم فهرستها في Turnitin للفحص مرة أخرى.';
$string['receiptsinstructor:message'] = 'التسليم المعنون <strong>{$a->submission_title}</strong> المقدم إلى الوحدة <strong>{$a->module_name}</strong> في الصف <strong>{$a->course_fullname}</strong> تم إرساله إلى Turnitin.<br /><br />مُعرَّف التسليم: <strong>{$a->submission_id}</strong><br />تاريخ التسليم: <strong>{$a->submission_date}</strong>';
$string['receiptsinstructor:subject'] = 'تم إرسال التسليم إلى Turnitin';
$string['receiptstudent:message'] = 'عزيزنا {$a->firstname} {$a->lastname}،<br /><br />ملفك <strong>{$a->submission_title}</strong> في وحدة <strong>{$a->module_name}</strong> في الصف <strong>{$a->course_fullname}</strong> تم تقديمه بنجاح إلى Turnitin في <strong>{$a->submission_date}</strong>. مُعرَّف تسليمك هو <strong>{$a->submission_id}</strong>.<br /><br />شكرًا على استعمالك Turnitin،<br /><br />فريق Turnitin';
$string['receiptstudent:subject'] = 'الإيصال الرقمي لـ  Turnitin الخاص بك';
$string['reportgen0'] = 'فوراً';
$string['reportgen1'] = 'فوراً وإعادة الإعداد في موعد تاريخ تسليم المهمة';
$string['reportgen2'] = 'تاريخ التسليم';
$string['reportgenoptions'] = 'إعداد تقارير التشابه';
$string['reportgenoptions_help'] = '<strong>فوراً:</strong> سيتم إنشاء تقرير التشابه مباشرة بعد إرسال الملف.
<br/><br/><strong>تاريخ التسليم:</strong>سيتم إنشاء تقرير التشابه فقط في تاريخ التسليم لإرسال المهمة.<br/><br/><strong>فوراً وفي تاريخ التسليم:</strong>سيتم إنشاء تقرير التشابه فوراً بعد  إرسال الملف. وسيتم إنشاء تقرير التشابه مرة أخرى في تاريخ تسليم المهمة. يمكن استخدام هذا الخيار للتحقق من التواطؤ بين الطلاب في العمل معاً حين يكون ذلك غير مسموح به.';
$string['resubmittoturnitin'] = 'إعادة التسليم لملحق Turnitin';
$string['savesuccess'] = 'تم حفظ التغييرات';
$string['settingslearnmore'] = 'تعلم المزيد حول إعدادات Turnitin';
$string['submissiondisplayerror:cannotextracttext'] = 'التقرير غير متاح';
$string['submissiondisplayerror:cannotextracttext_help'] = 'تعذر إنشاء تقرير حول هذا التسليم. وقد يكون السبب وراء ذلك أن نوع هذا الملف لا يدعم إنشاء تقرير أو النص الموجود في الملف غير كافي.';
$string['submissiondisplayerror:corruptfile'] = 'ملف تالف';
$string['submissiondisplayerror:corruptfile_help'] = 'يبدو أن الملف المرفوع تالف.';
$string['submissiondisplayerror:eulanotaccepted'] = 'لم تتم الموافقة على اتفاقية ترخيص المستخدم النهائي (EULA)';
$string['submissiondisplayerror:eulanotaccepted_help'] = 'يجب أن تتم موافقة الشخص الذي يقوم بإرسال تسليمه إلى Turnitin على اتفاقية ترخيص المستخدم النهائي (EULA) لـ Turnitin وذلك قبل أن يتم فحص أصالة التسليم المُرسل.';
$string['submissiondisplayerror:filelocked'] = 'تم تأمين الملف';
$string['submissiondisplayerror:filelocked_help'] = 'الملف المرفوع يتطلب فتحه كلمة مرور.';
$string['submissiondisplayerror:generic'] = 'لم يتم إرسال الملف إلى Turnitin';
$string['submissiondisplayerror:generic_help'] = 'هذا الملف لم يتم إرساله إلى Turnitin، يرجى الرجوع إلى مدير الموقع';
$string['submissiondisplayerror:notsent'] = 'لم يتم إرسال الملف إلى Turnitin';
$string['submissiondisplayerror:notsent_help'] = 'هذا الملف لم يتم إرساله إلى Turnitin لأن Turnitin لم يكن ممكناً أثناء التسليم، يرجى تعديل أو إعادة تحميل التقديم إذا كنت ترغب في إرساله إلى Turnitin.';
$string['submissiondisplayerror:processingerror'] = 'حدث خطأ في المعالجة';
$string['submissiondisplayerror:processingerror_help'] = 'حدث خطأ غير محدد أثناء معالجة التسليمات.';
$string['submissiondisplayerror:toolarge'] = 'إن حجم الملف كبيراً جداً';
$string['submissiondisplayerror:toolarge_help'] = 'هذا الملف كبير جداً ليتم إرساله إلى Turnitin. للتحقق من أصالة التسليم، يرجى تقديم ملف حجمه أقل من 100MB.';
$string['submissiondisplayerror:toolittletext'] = 'عدد الكلمات أقل من الحد المطلوب';
$string['submissiondisplayerror:toolittletext_help'] = 'لا يحتوي التسليم على عدد كاف من الكلمات لتوليد تقرير التشابه (يجب أن يتضمن التسليم على ما لا يقل عن 20 كلمة).';
$string['submissiondisplayerror:toomanypages'] = 'صفحات كثيرة جدًا';
$string['submissiondisplayerror:toomanypages_help'] = 'هناك صفحات كثيرة جدًا في التسليم بحيث يتعذر توليد تقرير التشابه (لا يمكن للتسليم أن يحتوي على أكثر من 400 صفحة)';
$string['submissiondisplayerror:toomuchtext'] = 'عدد الكلمات تجاوز الحد المسموح به';
$string['submissiondisplayerror:toomuchtext_help'] = 'لقد تجاوز التسليم عدد الكلمات المسموح به، لذلك لا يمكن إنشاء تقرير التشابه (بعد أن يتم تحويل النص الذي تم استخراجه إلى UTF-8، يجب أن يحتوي التسليم على عدد كلمات أقل من  {$a} النص)';
$string['submissiondisplayerror:unknown'] = 'يوجد خطأ في تسليمك';
$string['submissiondisplayerror:unknown_help'] = 'حدث خطأ غير معروف بالتسليم  وهذا الملف لم يتم إرساله إلى Turnitin، يرجى مراجعة  مدير النظام الخاص بك.';
$string['submissiondisplayerror:unsupportedfiletype'] = 'نوع ملف غير مدعوم';
$string['submissiondisplayerror:unsupportedfiletype_help'] = 'نوع الملف المرفوع غير مدعوم.';
$string['submissiondisplaystatus:awaitingeula'] = 'في انتظار اتفاقية ترخيص المستخدم النهائي (EULA)';
$string['submissiondisplaystatus:cannotextracttext'] = 'التقرير غير متاح';
$string['submissiondisplaystatus:error'] = 'خطأ';
$string['submissiondisplaystatus:notsent'] = 'لم يتم الإرسال';
$string['submissiondisplaystatus:pending'] = 'معلّق';
$string['submissiondisplaystatus:queued'] = 'بقائمة الانتظار';
$string['submissiondisplaystatus:unknown'] = 'خطأ غير معروف';
$string['taskadminupdate'] = 'تحديث التكوينات المحلية لملحق فحص النزاهة الأكاديمية Turnitin';
$string['taskgetreportscores'] = 'إجلب درجات التقرير لملحق النزاهة الأكاديمية Turnitin';
$string['taskoutputenabledfeaturesnotretrieved'] = 'تعذر استرجاع ميزات Turnitin';
$string['taskoutputenabledfeaturesretrievalfailure'] = 'فشل في اتصال تمكين ميزات Turnitin';
$string['taskoutputenabledfeaturesretrieved'] = 'تم استرجاع ميزات Turnitin';
$string['taskoutputfailedconnection'] = 'حدثت مشكلة في الاتصال بواجهة برمجة التطبيقات (API) لـ Turnitin';
$string['taskoutputfailedcvlaunchurl'] = 'حدثت مشكلة في طلب عنوان URL  لعارض Turnitin من واجهة برمجة التطبيقات Turnitin لرقم معرف التسليم: {$a}';
$string['taskoutputfailedreportrequest'] = 'حدثت مشكلة في طلب إنشاء تقرير الأصالة من واجهة برمجة التطبيقات Turnitin  لرقم معرف التسليم: {$a}';
$string['taskoutputfailedscorerequest'] = 'حدثت مشكلة في طلب معدل  تقرير الأصالة من واجهة برمجة التطبيقات Turnitin  لرقم معرف التسليم: {$a}';
$string['taskoutputfailedupload'] = 'حدثت مشكلة في تحميل ملف لواجهة برمجة التطبيقات Turnitin  لرقم معرف التسليم:  {$a}';
$string['taskoutputfileuploaded'] = 'الملف المحمّل إلى Turnitin {$a}';
$string['taskoutputlatesteulanotretrieved'] = 'تعذر استرجاع النسخة الأخيرة من اتفاقية ترخيص المستخدم النهائي (EULA)';
$string['taskoutputlatesteularetrievalfailure'] = 'فشل الاتصال بالنسخة الأخيرة من اتفاقية ترخيص المستخدم النهائي (EULA)';
$string['taskoutputlatesteularetrieved'] = 'نسخة اتفاقية ترخيص المستخدم النهائي (EULA) {$a} تم استرجاع.';
$string['taskoutputpluginnotconfigured'] = 'المهمة إلى {$a} تعذر تشغيلها وذلك لأن الإضافة النزاهة الأكاديمية Turnitin لم يتم تكوينه. <br/>يرجى الذهاب إلى صفحة تكوين الملحق من إدارة الموقع لإضافة بيانات الاعتماد لواجهة برمجة التطبيقات (API) Turnitin الخاصة بك';
$string['taskoutputsubmissioncreated'] = 'التسليم الذي تم إنشاؤه في Turnitin هو:   {$a}';
$string['taskoutputsubmissionnotcreatedeula'] = 'تعذر إنشاء التسليم المرسل في Turnitin بسبب عدم موافقة المُرسِل لاتفاقية ترخيص المستخدم النهائي (EULA).';
$string['taskoutputsubmissionnotcreatedgeneral'] = 'تعذر إنشاء التسليم المرسل في Turnitin يرجى مراجعة السجلات الخاصة بك.';
$string['taskoutputwebhookcreated'] = 'تم إنشاء Webhook. سيرسل Turnitin الاستدعاءات إلى {$a}';
$string['taskoutputwebhookcreationfailure'] = 'فشل في طلب إنشاء Webhook. يرجى مراجعة السجلات الخاصة بك.';
$string['taskoutputwebhookdeleted'] = 'Webhook {$a} تم حذف';
$string['taskoutputwebhookdeletefailure'] = 'تعذر حذف Webhook. يرجى مراجعة السجلات الخاصة بك.';
$string['taskoutputwebhooknotcreated'] = 'تعذر إنشاء Webhook. يرجى مراجعة السجلات الخاصة بك.';
$string['taskoutputwebhooknotdeleted'] = 'Webhook {$a} تعذر حذف';
$string['taskoutputwebhooknotretrieved'] = 'Webhook {$a} تعذر استرجاع. سيتم إنشاء Webhook جديد.';
$string['taskoutputwebhookretrievalfailure'] = 'Webhook {$a} فشل عملية استرجاع';
$string['taskoutputwebhookretrieved'] = 'تم استرجاع {$a} Webhook . إن Webhook نشط';
$string['tasksendqueuedsubmissions'] = 'أرسل الملفات المدرجة في قائمة الانتظار من ملحق فحص النزاهة الأكاديمية Turnitin';
$string['turnitinapikey'] = 'مفتاح واجهة برمجة تطبيقات (API) Turnitin';
$string['turnitinapiurl'] = 'عنوان URL لواجهة برمجة تطبيقات (API) Turnitin';
$string['turnitinconfig'] = 'تهيئة الإضافة';
$string['turnitinenablelogging'] = 'تمكين وضع التشخيص';
$string['turnitinenableremotelogging'] = 'أرسل السجلات إلى Turnitin';
$string['turnitinenableremotelogging_help'] = 'سترسل السجلات تلقائياً إلى Turnitin لأغراض التشخيص. ولا يتم نقل أي بيانات خاصة. نحن نوصي بأن يبقى هذا الإطار ممكناً حتى نتمكن من تقديم الدعم بسرعة إذا لزم الأمر. ومع ذلك، لا تزال هناك إمكانية العثور على السجلات في بيئة Moodle الخاص بك ليتم إرسالها يدوياً إلى Turnitin.';
$string['turnitinfeatures'] = 'ميزات ملحق فحص النزاهة الأكاديمية Turnitin';
$string['turnitinfeatures::eulanotrequired'] = 'لا يلزم من جميع المستخدمين الموافقة على  شروط اتفاقية ترخيص المستخدم النهائي (EULA) لـ Turnitin';
$string['turnitinfeatures::eularequired'] = 'ويلزم من جميع المستخدمين الموافقة على  شروط اتفاقية ترخيص المستخدم النهائي (EULA) لـ Turnitin';
$string['turnitinfeatures::header'] = 'ميزات ملحق فحص النزاهة الأكاديمية Turnitin';
$string['turnitinfeatures::moreinfo'] = 'للحصول على المزيد من المعلومات عن الميزات والحزم المتاحة من Turnitin، يرجى الاطلاع على <a href="http://www.turnitin.com" target="_blank">http://www.turnitin.com</a>.';
$string['turnitinfeatures::repositories'] = 'تم فحص المستودعات مقابل:';
$string['turnitinfeatures::viewoptions'] = 'خيارات المشاهد لـ Turnitin:';
$string['turnitinhideidentity'] = 'إخفاء هوية الطالب عن ملحق Turnitin';
$string['turnitinmodenabled'] = 'تمكين ملحق فحص النزاهة الأكاديمية Turnitin  لـ {$a}';
$string['turnitinpluginenabled'] = 'تمكين Turnitin';
$string['turnitinpluginsettings'] = 'إعدادات ملحق فحص النزاهة الأكاديمية Turnitin';
$string['turnitinsim'] = 'ملحق فحص النزاهة الأكاديمية Turnitin';
$string['turnitinsim:enable'] = 'تمكين ملحق فحص النزاهة الأكاديمية Turnitin';
$string['turnitinsim:viewfullreport'] = 'مشاهدة تقرير الأصالة';
$string['turnitinsiminternet'] = 'إفحص مقابل محتوى الإنترنت';
$string['turnitinsimprivate'] = 'إفحص مقابل المحتوى الشخصي';
$string['turnitinviewermatchsubinfo'] = 'السماح للمعلمين داخل مؤسستكم بالاطلاع على معلومات التسليم للبحث الداخلي عن التطابق';
$string['turnitinviewersavechanges'] = 'حفظ تغييرات المشاهد';
$string['turnitinviewerviewfullsource'] = 'السماح للمعلمين داخل مؤسستكم بالاطلاع على النص الكامل للتسليمات للبحث الداخلي عن التطابق';
$string['viewapilog'] = 'مشاهدة سجلات الوقاعات لواجهة برمجة التطبيقات (API) من {$a}';
$string['viewerpermissionferpa'] = 'وتؤثر الصلاحيات التالية على كيفية مشاركة  البيانات عبر مؤسستكم. وهذه البيانات هي مسؤولية مؤسستكم وحدها، بالتالي عند تحديد هذه الصلاحيات، يجب مراعاة فيما إذا كانت تلك البيانات تمتثل امتثالاً تاماً لسياسات مؤسستكم فيما يتعلق بسجلات الطلاب.';
$string['viewerpermissionoptions'] = 'صلاحيات المعاينة';
$string['viewlogs'] = 'السجلات';
$string['webhook_description'] = 'Webhook لـ {$a}';
$string['webhookincorrectsignature'] = 'فشل إستدعاء  Webhook لأن التوقيع غير صحيح';
