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
 * Strings for component 'zoom', language 'ar', version '5.1'.
 *
 * @package     zoom
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accountid'] = 'معرف حساب zoom';
$string['actions'] = 'أجراءات';
$string['activitydate:ended'] = 'انتهى:';
$string['activitydate:started'] = 'بدأت:';
$string['activitydate:starts'] = 'Starts:';
$string['addparticipant'] = 'إضافة مشارك';
$string['addparticipantgroup'] = 'إضافة مجموعة من المشاركين';
$string['addroom'] = 'أضف غرفة';
$string['addroomalert'] = 'أضف غرفة بالنقر فوق';
$string['addtocalendar'] = 'إضافة للتقويم';
$string['allmeetings'] = 'كل الاجتماعات';
$string['allmeetings_desc'] = 'باستعمال هذا الإعداد، يمكنك التحكم في ما إذا كان سيتم عرض رابط لصفحة فهرس نشاط Zoom في أسفل كل صفحة نظرة عامة على مثيل النشاط أم لا. يؤثر هذا الإعداد فقط على عرض الرابط في صفحات النظرة العامة على نشاط Zoom. حتى إذا قررت عدم إظهار الرابط هناك، فقد يظل المستخدم قادرًا على الوصول إلى صفحة فهرس نشاط Zoom من خلال روابط أخرى داخل المساق.';
$string['allmeetings_disable'] = 'تعطيل كافة الارتباطات الاجتماعات';
$string['allmeetings_enable'] = 'تفعيل رابط كافة الاجتماعات';
$string['alternative_hosts'] = 'المضيفين البدلاء';
$string['alternative_hosts_desc'] = 'باستعمال هذا الإعداد، يمكنك التحكم في ما إذا كان خيار إختيار المضيفين البديلين يظهر للمستخدمين في إعدادات عيِّنة النشاط أم لا. يتوفر نوعان من الأدوات: حقل إدخال عادي يقبل عناوين البريد الإلكتروني المفصولة بفواصل. ومنتقي المستخدمين مع الإكمال التلقائي الذي يوفر اختيارًا سهلاً للمستخدمين المسجلين في المساق، ولديهم حساب Zoom ولديهم دور خارج عن {$a->roles}. المضيفون البديلون الذين ربما تم تعيينهم من قبل المعلم في Zoom مباشرة ولكن لا يمكن تحديدهم من داخل منتقي مستخدمي مودل، لا يزالون يظهرون في صفحة النظرة العامة على النشاط ويتم الاحتفاظ بهم أيضًا عند تحديث الاجتماع من داخل مودل.';
$string['alternative_hosts_disable'] = 'تعطيل خيار المضيفين البديلين';
$string['alternative_hosts_help'] = 'يسمح لك خيار المضيف البديل بجدولة الاجتماعات وتعيين مستخدم مدفوع آخر على نفس الحساب لبدء الاجتماع أو الندوة عبر الإنترنت إذا كنت غير قادر على ذلك. سيتلقى هذا المستخدم رسالة بريد إلكتروني لإعلامه بأنه قد تمت إضافته كمضيف بديل ، مع رابط لبدء الاجتماع. افصل بين عناوين البريد الإلكتروني المتعددة بفاصلة (بدون مسافات).';
$string['alternative_hosts_inputfield'] = 'إظهار خيار المضيفين البديلين كحقل إدخال عادي';
$string['alternative_hosts_picker'] = 'إظهار خيار المضيفين البديلين باعتباره منتقي المستخدمين مع الإكمال التلقائي';
$string['alternative_hosts_picker_help'] = 'يتيح لك خيار المضيف البديل جدولة الاجتماعات وتعيين مستخدم (مستخدمين) Zoom الآخرين المسجلين في هذا المساق لبدء الاجتماع أيضًا. سيتلقى هؤلاء المستخدمون بريدًا إلكترونيًا من Zoom لإعلامهم بأنه تمت إضافتهم كمضيف بديل، مع رابط لبدء الاجتماع.\\n\\nيمكنك اختيار مضيف بديل واحد أو أكثر بناءً على احتياجات الاجتماع الخاصة بك.\\n\\nإذا لم تعثر على مستخدم معين في منتقي المستخدمين هذا، فهذا المستخدم إما غير مسجل في هذا المساق بدور مناسب أو ليس لديه حساب مؤهل على Zoom.';
$string['alternative_hosts_picker_noneselected'] = 'لم يتم تحديد مضيف بديل';
$string['alternative_hosts_picker_placeholder'] = 'حدد المستخدم (المستخدمين)
';
$string['apiendpoint'] = 'نقطة نهاية واجهة برمجة تطبيقات Zoom';
$string['apiendpoint_desc'] = 'اختر نقطة نهاية Zoom API التي سيستخدمها نشاط Zoom للاتصال. يجب أن تعمل نقطة نهاية واجهة برمجة التطبيقات العامة لجميع المستخدمين. نقطة نهاية واجهة برمجة تطبيقات الاتحاد الأوروبي (EU) مخصصة فقط للمستخدمين الذين لديهم ترخيص Zoom مع خيار توفير الاتحاد الأوروبي. إذا لم تكن متأكدًا، فاستخدم نقطة نهاية واجهة برمجة التطبيقات العامة.';
$string['apiendpoint_eu'] = 'نقطة نهاية EU API';
$string['apiendpoint_global'] = 'نقطة نهاية API العالمية';
$string['apiidentifier'] = 'معرف Zoom API';
$string['apiidentifier_desc'] = 'حقل المعرف الذي سيتم استخدامه عند إجراء اتصال بـ Zoom API';
$string['apiurl'] = 'رابط واجهة تطبيق Zoom';
$string['audio_both'] = 'الاتصالات عبر بروتوكول الإنترنت VoIP والاتصالات الهاتفية';
$string['audio_telephony'] = 'عن طريق الهاتف فقط';
$string['audio_voip'] = 'الاتصالات عبر بروتوكول الإنترنت VoIP فقط';
$string['audiodefault'] = 'الصوت الافتراضي';
$string['authentication'] = 'المصادقة';
$string['autorecording_cloud'] = 'سحاب';
$string['autorecording_local'] = 'محلي';
$string['autorecording_none'] = 'لا أحد';
$string['autorecording_userdefault'] = 'استخدم إعدادات مستخدم Zoom الافتراضية';
$string['autorecordingoptionsupdate'] = 'تحديث خيارات التسجيل التلقائي';
$string['breakoutrooms'] = 'غرف جانبية';
$string['cachedef_oauth'] = 'ذاكرةzoom OAuthالتخزين المؤقت للرمز المميز';
$string['cachedef_zoomid'] = 'الرقم التعريفي لـ Zoom الخاص بالمستخدم';
$string['cachedef_zoommeetingsecurity'] = 'إعدادات أمان اجتماع Zoom، بما في ذلك تلبية متطلبات كلمة المرور الخاصة بالحساب';
$string['calendardescriptionintro'] = '\\nالوصف:\\n{\\$a}';
$string['calendariconalt'] = 'أيقونة التقويم';
$string['changehost'] = 'تغيير المضيف';
$string['clickjoin'] = 'تم النقر على زر الانضمام إلى الاجتماع';
$string['clientid'] = 'Zoom معرف العميل';
$string['clientsecret'] = 'zoom سر عميل';
$string['connectionfailed'] = 'فشل الاتصال:';
$string['connectionok'] = 'الاتصال يعمل.';
$string['connectionsettings'] = 'إعدادات الإتصال';
$string['connectionsettings_desc'] = 'تحدد هذه الإعدادات كيفية اتصال Moodle بـ Zoom.';
$string['connectionstatus'] = 'حالة الاتصال';
$string['day'] = 'يوم/أيام';
$string['defaultsettings'] = 'الاعدادات الافتراضية لـ Zoom';
$string['defaultsettings_help'] = 'هذه الاعدادات تحدد الاعدادات الافتراضية لاجتماعات وندوات Zoom';
$string['deletemeetingrecordings'] = 'حذف تسجيلات الاجتماع من موودل';
$string['deleteroom'] = 'حذف الغرفة';
$string['displayfirstname'] = 'الاسم الأول فقط';
$string['displayfullname'] = 'الاسم الكامل';
$string['displayid'] = '(معرف المستخدم) فقط';
$string['displayidfullname'] = '(معرف المستخدم) متبوعًا بالاسم الكامل';
$string['displayleadtime'] = 'عرض المهلة الزمنية';
$string['displayleadtime_desc'] = 'في حالة التمكين، سيتم عرض المهلة الزمنية للمستخدمين. بهذه الطريقة، يتم إعلام المستخدمين بأنه / متى يمكنهم الانضمام إلى الاجتماع قبل وقت البدء المجدول. قد يمنع هذا المستخدمين من إعادة تحميل الصفحة باستمرار حتى يتمكنوا من الانضمام.';
$string['displayleadtime_nohideif'] = 'يرجى ملاحظة: تتم معالجة هذا الإعداد فقط إذا تم تعيين الإعداد \'{$a}\' على قيمة أكبر من الصفر.';
$string['displaypassword'] = 'عرض رمز المرور';
$string['displaypassword_help'] = 'إذا تم تمكينه، فسيتم دائمًا عرض رمز مرور الاجتماع لغير المضيفين.';
$string['downloadical'] = 'تحميل iCal';
$string['downloadical_desc'] = 'باستخدام هذا الإعداد، يمكنك التحكم في ما إذا كان سيتم عرض رابط لتنزيل ملف iCal للاجتماع في صفحة النظرة العامة على مثيل النشاط أم لا. يؤثر هذا الإعداد فقط على إمكانية تنزيل ملف iCal لأدوات تقويم الطرف الثالث. بغض النظر عن هذا الإعداد، سيضيف نشاط اجتماع Zoom إدخال تقويم إلى تقويم Moodle بمجرد تحديد تاريخ بدء الاجتماع.';
$string['downloadical_disable'] = 'تعطيل رابط تنزيل iCal';
$string['downloadical_enable'] = 'تمكين رابط تنزيل iCal';
$string['duration'] = 'المدة (بالدقائق)';
$string['encryptiontype'] = 'نوع التشفير';
$string['encryptiontype_alwaysshow'] = 'قم دائمًا بإظهار منتقي نوع التشفير بغض النظر عما إذا كان بإمكان المستخدم استخدام التشفير الشامل أم لا';
$string['encryptiontype_desc'] = 'باستخدام هذا الإعداد، يمكنك التحكم في ما إذا كان خيار اختيار التشفير الشامل بدلاً من التشفير المحسن يظهر للمستخدمين في إعدادات مثيل النشاط أم لا. يؤثر هذا الإعداد فقط على إعدادات مثيل نشاط Moodle. حتى إذا قررت إظهار الخيار دائمًا، فسيظل المستخدم بحاجة إلى التشفير الشامل في Zoom لتمكين التشفير الشامل أخيرًا.';
$string['encryptiontype_disable'] = 'تعطيل منتقي نوع التشفير';
$string['encryptiontype_showonlyife2epossible'] = 'إظهار منتقي نوع التشفير فقط إذا كان بإمكان المستخدم استعمال التشفير الشامل';
$string['end_date_option_after'] = 'بعد';
$string['end_date_option_by'] = 'بواسطة';
$string['end_date_option_occurrences'] = 'الأحداث';
$string['enddate'] = 'تاريخ الانتهاء';
$string['endtime'] = 'زمن النهاية';
$string['err_downloadicaldisabled'] = 'تم تعطيل تنزيل ملفات Zoom Meeting iCal.';
$string['err_downloadicalrecurringempty'] = 'لا يمكن تنزيل ملف Zoom Meeting iCal لهذا الاجتماع لأنه لا يحتوي على حدث واحد على الأقل.';
$string['err_downloadicalrecurringnofixed'] = 'لا يمكن تنزيل ملف Zoom Meeting iCal لهذا الاجتماع لأنه اجتماع متكرر بدون وقت محدد.';
$string['err_duration_nonpositive'] = 'يجب أن تكون المدة إيجابية.';
$string['err_duration_too_long'] = 'لا يمكن أن تتجاوز المدة 150 ساعة.';
$string['err_end_date'] = 'لا يمكن أن يكون تاريخ انتهاء التكرار في الماضي';
$string['err_end_date_before_start'] = 'لا يمكن أن يكون تاريخ انتهاء التكرار قبل تاريخ البدء';
$string['err_invalid_password'] = 'يحتوي رمز المرور على أحرف غير صالحة.';
$string['err_long_timeframe'] = 'الإطار الزمني المطلوب طويل جدًا ، مع عرض نتائج الشهر الأخير في النطاق.';
$string['err_password'] = 'يجب أن تقتصر كلمة المرور على الرموز  [a-z A-Z 0-9 @ - _ *]. 10 حروف كحد أقصى';
$string['err_password_required'] = 'مطلوب رمز المرور.';
$string['err_repeat_monthly_interval'] = 'الحد الأقصى للفاصل الزمني للاجتماع الشهري هو 3 أشهر';
$string['err_repeat_weekly_interval'] = 'الحد الأقصى للفاصل الزمني للاجتماع الأسبوعي هو 12 أسبوعًا';
$string['err_start_time_past'] = 'لا يمكن أن يكون تاريخ البدء في الماضي.';
$string['err_start_time_past_recurring'] = 'بالنسبة للاجتماعات المتكررة، فإن جزء التاريخ في هذا الحقل هو أقرب تاريخ ممكن للاجتماع التالي. يجب أن يكون هذا التاريخ اليوم أو في المستقبل.';
$string['err_weekly_days'] = 'حدد يومًا (أيامًا) للاجتماع الأسبوعي المتكرر';
$string['erroraddinstance'] = 'تعذر إنشاء اجتماع Zoom جديد. تم تحديد خيارات غير صالحة لاجتماع متكرر.';
$string['errorwebservice'] = 'خطأ خدمة الويب الخاصة بـ Zoom: {$a}.';
$string['errorwebservice_badrequest'] = 'تلقى Zoom طلبًا سيئًا: {$a}';
$string['errorwebservice_notfound'] = 'المورد غير موجود';
$string['export'] = 'تصدير';
$string['externaluser'] = 'مستخدم خارجي';
$string['firstjoin'] = 'أول قادر على الانضمام';
$string['firstjoin_desc'] = 'أقرب مستخدم يمكنه الانضمام إلى اجتماع مجدول (دقائق قبل البدء).';
$string['getmeetingrecordings'] = 'احصل على تسجيلات الاجتماع من Zoom';
$string['getmeetingreports'] = 'الحصول على تقرير اجتماع من Zoom';
$string['globalsettings'] = 'الاعدادات العامة';
$string['globalsettings_desc'] = 'تنطبق هذه الإعدادات على المكون الإضافي Zoom ككل.';
$string['grading_needgrade'] = 'يجب تقدير المستخدمين التاليين يدوياً لأنه لا يمكن التعرف عليهم:\\n';
$string['grading_notenrolled'] = 'انضم المستخدمون التاليون إلى الاجتماع ولكن لم يتم التعرف عليهم كمستخدمين مسجلين:\\n';
$string['grading_notfound'] = 'قائمة المستخدمين الذين قاموا بالنقر للانضمام إلى الاجتماع، ولكن لم يتم التعرف عليهم في تقرير المشارك:\\n';
$string['gradingentry'] = 'عند الدخول';
$string['gradinglink'] = 'مراجعة الدرجات أو تحديثها
';
$string['gradingmessagebody'] = 'لجلسة Zoom Meeting: {$a->zoomurl};
<ر>
عدد المستخدمين الذين تم تصنيفهم تلقائيًا وفقًا لمدة تواجدهم في الاجتماع: {$a->graded}.
<ر>
عدد المستخدمين الذين تم تصنيفهم بالفعل: {$a->alreadygraded}.
<ر>
{$a->بحاجة إلى درجة<br>
قم بمراجعة درجات المستخدمين أو تحديثها هنا: {$a->gradeurl}
<ر>
{$a->غير موجود}
<ر>
{$a->غير مسجل}';
$string['gradingmessagesubject'] = 'تقديرات المستخدم لاجتماع Zoom: {$a->name}';
$string['gradingmethod'] = 'طريقة التصنيف';
$string['gradingmethod_heading'] = 'خيارات لطريقة التصنيف';
$string['gradingmethod_heading_help'] = 'حدد الطريقة التي ستستخدمها عند تقييم المشاركة في Zoom.';
$string['gradingmethod_help'] = 'اختر الطريقة التي سيتم استخدامها عند تقدير مشاركة الطلاب.<br>
عند الدخول: يحصل الطالب على العلامات الكاملة (الدرجة القصوى) عند النقر للانضمام إلى الاجتماع في Moodle.<br>
مدة الحضور: يحصل الطالب على درجة بناءً على النسبة المئوية لحضور الاجتماع مقارنةً بإجمالي مدة الاجتماع.<br>
ملاحظات بخصوص طريقة مدة الحضور:<br>
- تتطلب هذه الطريقة أن يحتوي اسم العرض على المعرف أو الاسم الكامل.<br>
- يوصى بضبط الإعداد "تكبير/تصغير |". defaultjoinbeforehost\' إلى (لا) لذا تكون مدة الاجتماع دقيقة.<br>
- بعض الطلاب الذين قاموا بتسجيل الدخول بالفعل إلى عميل Zoom بتفاصيل لا تتطابق مع تلك الموجودة في Moodle يجب أن يتم تقييمهم يدويًا بعد مراجعة تقرير الاجتماع.';
$string['gradingperiod'] = 'مدة الحضور';
$string['gradingsmallmeassage'] = 'تقرير سريع عن تقديرات المستخدم لـ {$a->name}:
<ر>
بحاجة إلى تصنيف يدوي: {$a->number}
<ر>
المستخدمون الذين تم تصنيفهم: {$a->graded + $a->alreadygraded}';
$string['host'] = 'مضيف';
$string['hostintro'] = '<a target="_blank" href="https://support.zoom.us/hc/en-us/articles/208220166">الاستضافات البديلة</a> يمكنها بدء اجتماعات زوم وإدارة غرفة الانتظار.';
$string['indicator:cognitivedepth'] = 'Zoom المعرفي';
$string['indicator:cognitivedepth_help'] = 'يعتمد هذا المؤشر على العمق المعرفي الذي وصل إليه الطالب في نشاط Zoom.';
$string['indicator:socialbreadth'] = 'Zoom الاجتماعي';
$string['indicator:socialbreadth_help'] = 'يعتمد هذا المؤشر على الاتساع الاجتماعي الذي وصل إليه الطالب في نشاط Zoom.';
$string['instanceusers'] = 'تحقق من مستخدمي المثيل';
$string['instanceusers_desc'] = 'إذا تم تمكين إعادة تعريف التراخيص، فتحقق فقط من المستخدمين المرخصين في مثيل Moodle هذا. مفيد للإعدادات التي تقوم فيها المثيلات المنفصلة بتقسيم مجموعة واحدة من تراخيص Zoom.';
$string['invalid_status'] = 'الحالة غير صحيحة، تحقق من قاعدة البيانات.';
$string['invalidscheduleuser'] = 'لا يمكنك جدولة المستخدم المحدد.';
$string['invitation_dialin'] = 'الاتصال الهاتفي في النمط';
$string['invitation_dialin_help'] = 'نمط التعبير العادي للعثور على طلب اجتماع Zoom بالأرقام.';
$string['invitation_h323'] = 'نمط الرسالة H.323';
$string['invitation_h323_help'] = 'نمط التعبير العادي للعثور على معلومات اجتماع Zoom H.323. إذا كانت دعواتك لا تحتوي على عناصر SIP أو H.323، فقم بتعيين نمط التعبير العادي المطابق إلى سلسلة فارغة. (ينطبق هذا بشكل خاص على الخوادم التي تم تمكين تصحيح الأخطاء فيها، لأنه يمكن أن يعطل تنسيق أنواع الملفات الخاصة مثل تصدير iCal.)';
$string['invitation_icallink'] = 'نمط رسالة رابط iCal';
$string['invitation_icallink_help'] = 'نمط التعبير العادي للعثور على رابط Zoom Meeting iCal.';
$string['invitation_invite'] = 'دعوة نمط الرسالة';
$string['invitation_invite_help'] = 'نمط التعبير العادي للعثور على رسالة مقدمة اجتماع Zoom.';
$string['invitation_joinurl'] = 'الانضمام إلى نمط URL';
$string['invitation_joinurl_help'] = 'نمط التعبير العادي للعثور على عنوان URL للانضمام إلى اجتماع Zoom.';
$string['invitation_onetapmobile'] = 'نمط المحمول بنقرة واحدة';
$string['invitation_onetapmobile_help'] = 'نمط التعبير العادي للعثور على تفاصيل اجتماع Zoom بنقرة واحدة.';
$string['invitation_sip'] = 'نمط SIP';
$string['invitation_sip_help'] = 'نمط التعبير العادي للعثور على معلومات SIP الخاصة باجتماع Zoom. إذا كانت دعواتك لا تحتوي على عناصر SIP أو H.323، فقم بتعيين نمط التعبير العادي المطابق إلى سلسلة فارغة. (ينطبق هذا بشكل خاص على الخوادم التي تم تمكين تصحيح الأخطاء فيها، لأنه يمكن أن يعطل تنسيق أنواع الملفات الخاصة مثل تصدير iCal.)';
$string['invitationmatchnotfound'] = 'لم يتم العثور على تطابق في دعوة التكبير/التصغير للعنصر: "{$a->element}" بالنمط: "{$a->pattern}".';
$string['invitationmodificationfailed'] = 'خطأ في التعبير العادي لعنصر دعوة التكبير/التصغير: "{$a->element}" بالنمط: "{$a->pattern}".';
$string['invitationregex'] = 'التعبير الاعتيادي لدعوة Zoom وإمكانياته';
$string['invitationregex_help'] = 'تعريف أنماط التعبير الاعتيادي لعزل كل جزء من دعوة Zoom ليصير بالإمكان التحكم بالمعلومات عبر الإمكانيات.';
$string['invitationregex_nohideif'] = 'يرجى ملاحظة: لن يتم استخدام أنماط التعبير العادي إلا إذا تم تمكين الإعداد \'{$a}\'.';
$string['invitationregexenabled'] = 'تمكين التعبير الاعتيادي لدعوة Zoom وإمكانياته.';
$string['invitationregexenabled_help'] = 'عند التمكين، سيتم تقسيم دعوة التكبير/التصغير الموضحة في النشاط إلى عناصر باستخدام التعبير العادي التالي وسيتم استخدام الإمكانات لتحديد الأجزاء التي سيتم عرضها لكل مستخدم. راجع إمكانيات التكبير/التصغير/عرض الانضمام وإمكانيات التكبير/التصغير/الاتصال بالعرض.';
$string['invitationremoveicallink'] = 'إزالة رابط iCal لدعوة التكبير/التصغير';
$string['invitationremoveicallink_help'] = 'إذا تم تمكينه، فسيتم تجريد رابط iCal الذي قد يتم تضمينه في رسالة البريد الإلكتروني لاجتماع Zoom باستخدام نمط regex الخاص بـinvite_icallink.';
$string['invitationremoveinvite'] = 'إزالة رسالة دعوة التكبير';
$string['invitationremoveinvite_help'] = 'إذا تم تمكينها، فسيتم تجريد الجملة المقدمة في رسالة البريد الإلكتروني الخاصة باجتماع Zoom باستخدام النمط العادي لدعوة_invite.';
$string['join'] = 'انضمام';
$string['join_meeting'] = 'انضمام إلى الاجتماع';
$string['joinbeforehost'] = 'انضمام للاجتماع قبل المضيف';
$string['joinbeforehostenable'] = 'السماح للمشاركين بالانضمام في أي وقت';
$string['joinlink'] = 'رابط الانضمام';
$string['jointime'] = 'زمن الانضمام';
$string['leavetime'] = 'زمن المغادرة';
$string['licenseonjoin'] = 'حدد هذا الخيار إذا كنت تريد أن يحصل المضيف على ترخيص عند بدء الاجتماع، <i>وكذلك</i> عند الإنشاء.';
$string['licensesettings'] = 'إعدادات الترخيص';
$string['licensesettings_desc'] = 'تحدد هذه الإعدادات الطريقة التي يتعامل بها Moodle مع ترخيص Zoom الخاص بك.';
$string['licensesnumber'] = 'عدد التراخيص';
$string['lowlicenses'] = 'إذا تجاوز عدد التراخيص الخاصة بك التراخيص المطلوبة ، فعند قيام المستخدم بإنشاء أي نشاط جديد ، سيتم تعيين ترخيص مدفوع عن طريق خفض حالة مستخدم آخر. يكون الخيار فعالًا عندما يكون عدد التراخيص المدفوعة النشطة أكثر من 5.';
$string['maskparticipantdata'] = 'إخفاء بيانات المشاركين';
$string['maskparticipantdata_help'] = 'يمنع ظهور بيانات المشاركين في التقارير (مفيد للمواقع التي تخفي بيانات المشاركين، على سبيل المثال، HIPAA).';
$string['media'] = 'وسائط';
$string['meeting_finished'] = 'انتهى';
$string['meeting_invite'] = 'معلومات الهاتف/الاتصال الهاتفي';
$string['meeting_invite_hide'] = 'إخفاء دعوة الاجتماع';
$string['meeting_invite_show'] = 'إظهار دعوة الاجتماع';
$string['meeting_nonexistent_on_zoom'] = 'غير موجود في Zoom';
$string['meeting_not_started'] = 'لم يبدأ';
$string['meeting_started'] = 'في تقدم';
$string['meeting_time'] = 'زمن البداية';
$string['meetingcapacitywarning'] = 'تحذير قدرة الاجتماع';
$string['meetingcapacitywarning_desc'] = 'باستعمال هذا الإعداد، يمكنك عرض إشعار تحذيري إذا كان هناك مشاركين نشطين ومنضمين إلى المساق أكثر من السعة المرخصة لاجتماع Zoom الخاص بالمضيف. سيتم عرض الإشعار للمضيف (والمضيفين البديلين) في صفحة النظرة العامة على نشاط Zoom. سيوصي المضيف بالتوجه إلى مالك حساب Zoom للحصول على ترخيص Zoom أكبر إذا لزم الأمر. يمكنك تغيير هذه الرسالة من خلال تخصيص لغة مودل.';
$string['meetingcapacitywarning_disable'] = 'تعطيل تحذير سعة الاجتماع';
$string['meetingcapacitywarning_enable'] = 'تفعيل تحذير سعة الاجتماع';
$string['meetingcapacitywarningbodyalthost'] = 'ترخيص Zoom الخاص بمضيف هذا الاجتماع، {$a->hostname}، يتسع لـ <strong>{$a->meetingcapacity} من المشاركين في الاجتماع</strong>، ولكن هذا المساق فيه <strong><a href="{ $a->courseparticipantsurl}">{$a->eligiblemeetingparticipants} من المنضمين والمشاركين النشطين</a></strong>.';
$string['meetingcapacitywarningbodyrealhost'] = 'يتسع ترخيص Zoom الخاص بك لـ <strong><a href="{$a->zoomprofileurl}" target="_blank">{$a->meetingcapacity}من المشاركين في الاجتماع </a></strong>، ولكن هذا المساق لديه <strong><a href="{$a->courseparticipantsurl}">{$a->eligiblemeetingparticipants} من المنضمين والمشاركين النشطين</a></strong>.';
$string['meetingcapacitywarningcontactalthost'] = 'يرجى مطالبة المضيف بالتوجه إلى مالك حساب Zoom للحصول على ترخيص Zoom أكبر إذا كان كل المنضمين إلى المساق بحاجة إلى الانضمام إلى الاجتماع.';
$string['meetingcapacitywarningcontactrealhost'] = 'يرجى التوجه إلى مالك حساب Zoom للحصول على ترخيص Zoom أكبر إذا كان كل المشاركين في المساق بحاجة إلى الانضمام إلى الاجتماع.';
$string['meetingcapacitywarningheading'] = 'تحذير سعة الاجتماع:';
$string['meetingparticipantsdeleted'] = 'تم حذف بيانات المستخدم المشارك في الاجتماع.';
$string['meetingrecordingviewsdeleted'] = 'تم حذف بيانات عرض المستخدم لتسجيل الاجتماع.';
$string['messageprovider:teacher_notification'] = 'قم بإخطار المعلمين بدرجات المستخدم (حسب المدة) في جلسة Zoom';
$string['modulename'] = 'اجتماع Zoom';
$string['modulename_help'] = 'Zoom عبارة عن تطبيق لعقد مؤتمرات الفيديو والويب يمنح المستخدمين المصرح لهم القدرة على استضافة الاجتماعات عبر الإنترنت.';
$string['modulenameplural'] = 'اجتماعات Zoom';
$string['month'] = 'شهر/شهور';
$string['month_day_text'] = 'من الشهر
';
$string['newmeetings'] = 'اجتماعات جديدة';
$string['nextoccurrence'] = 'الحدوث التالي';
$string['nomeetinginstances'] = 'لم يتم العثور على جلسات لهذا الاجتماع.';
$string['nonrecognizedusergrade'] = '(الاسم: {$a->userid}، الدرجة: {$a->grade})';
$string['nooccurrenceleft'] = 'لقد انتهى الحدث الأخير بالفعل';
$string['noparticipants'] = 'لم يتم العثور على مشاركين لهذه الجلسة في هذا الوقت.';
$string['norecordings'] = 'لم يتم العثور على تسجيلات لهذا الاجتماع في هذا الوقت.';
$string['norooms'] = 'لا توجد غرف';
$string['nosessions'] = 'لم يتم العثور على جلسات للنطاق المحدد.';
$string['nozooms'] = 'ليس هنالك اجتماعات';
$string['nozoomsfound'] = 'لم يتم العثور على أي اجتماعات في المساق المحدد.';
$string['occurson'] = 'يحدث في';
$string['off'] = 'إيقاف';
$string['oldmeetings'] = 'اجتماعات ختامية';
$string['on'] = 'تشغيل';
$string['option_allow_recording_change'] = 'السماح بتغيير التسجيل';
$string['option_allow_recording_change_help'] = 'السماح للمستخدم بتغيير إعداد التسجيل في وقت إنشاء النشاط';
$string['option_audio'] = 'خيارات الصوت';
$string['option_audio_help'] = 'باستخدام هذا الخيار، يمكنك السماح للمستخدمين بالاتصال باستخدام الهاتف فقط أو صوت الكمبيوتر فقط أو كليهما';
$string['option_authenticated_users'] = 'تتطلب المصادقة للانضمام';
$string['option_authenticated_users_help'] = 'يتطلب تمكين هذا الخيار من جميع الحاضرين تسجيل الدخول باستخدام حساب Zoom المعتمد الخاص بهم حتى يتمكنوا من الانضمام إلى الاجتماع. إنه <em>لا</em> يتعلق بتسجيل الدخول إلى Moodle بأي شكل من الأشكال.';
$string['option_auto_recording'] = 'التسجيل التلقائي';
$string['option_auto_recording_help'] = 'سيؤدي تمكين هذا الخيار إلى تسجيل الاجتماع تلقائيًا';
$string['option_encryption_type'] = 'التشفير';
$string['option_encryption_type_endtoendencryption'] = 'التشفير من النهاية إلى النهاية';
$string['option_encryption_type_enhancedencryption'] = 'التشفير المحسن';
$string['option_encryption_type_help'] = 'باستخدام هذا الخيار، يمكنك التحكم في مستوى التشفير والخصوصية لهذا الاجتماع.\\n\\n*التشفير المحسّن* يعني أن مفتاح التشفير مخزّن في سحابة Zoom.\\n\\n*التشفير الشامل* يعني ذلك يتم تخزين مفتاح التشفير على جهازك المحلي ولا يمكن لأي شخص آخر الحصول على مفتاح التشفير الخاص بك، ولا حتى Zoom.\\n\\nيُرجى ملاحظة أنه عند تمكين التشفير الشامل، لن تتوفر العديد من الميزات من داخل الاجتماع - [راجع التفاصيل في وثائق Zoom](https://support.zoom.us/hc/en-us/articles/360048660871).';
$string['option_host_video'] = 'فيديو المضيف';
$string['option_host_video_help'] = 'سيؤدي تمكين هذا الخيار إلى تمكين فيديو المضيف عند الانضمام إلى الاجتماع. حتى إذا اخترت إيقاف ذلك، سيكون لدى المضيف خيار بدء الفيديو الخاص به.';
$string['option_jbh'] = 'تمكين الانضمام قبل المضيف';
$string['option_jbh_help'] = 'تمكين هذا الخيار يسمح للحاضرين بالانضمام إلى الاجتماع قبل انضمام المضيف أو عندما يتعذر عليه حضور الاجتماع.\\n\\nهذا الخيار حصري مقابل خيار \'غرفة الانتظار\'، لذلك اختيار أحدهما سيعطل الآخر.';
$string['option_mute_upon_entry'] = 'كتم صوت المشاركين عند الدخول';
$string['option_mute_upon_entry_help'] = 'سيؤدي تمكين هذا الخيار إلى كتم صوت جميع المشاركين تلقائيًا عند انضمامهم إلى الاجتماع. يمكن للمشاركين إعادة صوت صوتهم بعد الانضمام إلى الاجتماع.';
$string['option_participants_video'] = 'فيديو المشاركين';
$string['option_participants_video_help'] = 'سيؤدي تمكين هذا الخيار إلى تمكين فيديو المشاركين عند الانضمام إلى الاجتماع. حتى إذا قمت بالاختيار، سيكون لدى المشاركين خيار بدء الفيديو الخاص بهم.';
$string['option_proxyhost'] = 'استخدام بروكسي';
$string['option_proxyhost_desc'] = 'يتم استخدام الوكيل الذي تم تعيينه هنا كـ \'<code>&lt;hostname&gt;:&lt;port&gt;</code>\' فقط للتواصل مع Zoom. اتركه فارغًا لاستخدام إعدادات الوكيل الافتراضية لـ Moodle. ما عليك سوى ضبط هذا إذا كنت لا ترغب في تعيين وكيل عام في Moodle.';
$string['option_view_recordings'] = 'السماح بمشاهدة التسجيلات';
$string['option_waiting_room'] = 'غرفة الانتظار';
$string['option_waiting_room_help'] = 'يؤدي تمكين هذا الخيار إلى السماح للمضيف بالتحكم في وقت انضمام أحد المشاركين إلى الاجتماع.\\n\\nهذا الخيار متنافي مع خيار "الانضمام قبل المضيف"، لذا فإن تحديد أحدهما سيؤدي إلى تعطيل الآخر.';
$string['participantdatanotavailable'] = 'التفاصيل غير متوفرة';
$string['participantdatanotavailable_help'] = 'بيانات المشاركين غير متاحة لجلسة Zoom هذه (على سبيل المثال، بسبب الامتثال لقانون HIPAA).';
$string['participantgroups'] = 'المجموعات المشاركة';
$string['participants'] = 'المشاركين';
$string['password'] = 'كلمة المرور';
$string['password_allowed_char'] = 'يجب أن يحتوي رمز المرور على الأحرف التالية فقط: [a-z A-Z 0-9 @ - _ *].';
$string['password_consecutive'] = 'الحد الأقصى {$a} من الأحرف المتتالية (abcd، 1111، 1234، إلخ.).';
$string['password_length'] = 'الحد الأدنى {$a} من الأحرف.';
$string['password_letter'] = 'يجب أن يحتوي رمز المرور على حرف واحد على الأقل.';
$string['password_lower_upper'] = 'يجب أن يتضمن رمز المرور أحرفًا صغيرة وكبيرة.';
$string['password_max_length'] = 'الحد الأقصى 10 أحرف.';
$string['password_number'] = 'يجب أن يحتوي رمز المرور على رقم واحد على الأقل.';
$string['password_only_numeric'] = 'يجب أن يحتوي رمز المرور على أرقام فقط وليس على أحرف أخرى.';
$string['password_special'] = 'يجب أن يحتوي رمز المرور على حرف خاص واحد على الأقل (@-_*).';
$string['passwordprotected'] = 'كلمة السر المحمية';
$string['pluginadministration'] = 'إدارة اجتماع Zoom';
$string['pluginname'] = 'اجتماع Zoom';
$string['privacy:metadata:zoom_breakout_participants'] = 'جدول قاعدة البيانات لتخزين قائمة المشاركين في غرف اجتماعات Zoom الجانبية';
$string['privacy:metadata:zoom_breakout_participants:userid'] = 'هوية معرف المستخدم المشارك';
$string['privacy:metadata:zoom_meeting_details'] = 'جدول قاعدة البيانات الذي يقوم بتخزين معلومات حول كل نسخة للاجتماع';
$string['privacy:metadata:zoom_meeting_details:topic'] = 'اسم الاجتماع الذي حضره المستخدم';
$string['privacy:metadata:zoom_meeting_participants'] = 'جدول قاعدة البيانات الذي يخزن معلومات حول المشاركين';
$string['privacy:metadata:zoom_meeting_participants:duration'] = 'كم من الوقت مكث المشارك في الاجتماع';
$string['privacy:metadata:zoom_meeting_participants:join_time'] = 'الوقت الذي انضم فيه المشارك إلى الاجتماع';
$string['privacy:metadata:zoom_meeting_participants:leave_time'] = 'الوقت الذي غادر فيه المشارك الاجتماع';
$string['privacy:metadata:zoom_meeting_participants:name'] = 'اسم المشارك';
$string['privacy:metadata:zoom_meeting_participants:user_email'] = 'البريد الالكتروني للمشارك';
$string['privacy:metadata:zoom_meeting_view'] = 'جدول قاعدة البيانات لتتبع المستخدمين الذين يشاهدون تسجيلات الاجتماع';
$string['privacy:metadata:zoom_meeting_view:userid'] = 'معرف المستخدم الذي شاهد التسجيل';
$string['recording'] = 'تسجيل';
$string['recordingadd'] = 'إضافة تسجيل';
$string['recordingdate'] = 'تاريخ التسجيل';
$string['recordingdelete'] = 'هل أنت متأكد أنك تريد حذف التسجيل "{$a}"؟';
$string['recordinghide'] = 'إخفاء التسجيل (المرئي حاليًا)';
$string['recordinglink'] = 'رابط التسجيل';
$string['recordingname'] = 'عنوان';
$string['recordingnotfound'] = 'لا يمكن العثور على التسجيل';
$string['recordingnotvisible'] = 'التسجيل غير مرئي. يرجى الاتصال بمسؤول النظام الخاص بك إذا كنت تعتقد أن هذا خطأ';
$string['recordingpasscode'] = 'تسجيل رمز المرور';
$string['recordings'] = 'التسجيلات';
$string['recordingshow'] = 'إظهار التسجيل (المخفي حاليًا)';
$string['recordingshowtoggle'] = 'تبديل عرض التسجيل';
$string['recordingtype_active_speaker'] = 'المتحدث النشط';
$string['recordingtype_audio_interpretation'] = 'الترجمة الصوتية';
$string['recordingtype_audio_only'] = 'صوت فقط';
$string['recordingtype_audio_transcript'] = 'نسخة صوتية';
$string['recordingtype_chat'] = 'ملف الدردشة';
$string['recordingtype_closed_caption'] = 'تسمية توضيحية مغلقة';
$string['recordingtype_gallery'] = 'عرض المعرض';
$string['recordingtype_poll'] = 'تصويت';
$string['recordingtype_production_studio'] = 'استوديو الإنتاج';
$string['recordingtype_shared'] = 'الشاشة المشتركة';
$string['recordingtype_shared_gallery'] = 'شاشة مشتركة مع عرض المعرض';
$string['recordingtype_shared_speaker'] = 'شاشة مشتركة مع عرض مكبر الصوت';
$string['recordingtype_shared_speaker_cc'] = 'شاشة مشتركة مع عرض مكبر الصوت (CC)';
$string['recordingtype_sign'] = 'تفسير التوقيع';
$string['recordingtype_speaker'] = 'عرض المتحدث';
$string['recordingtype_summary'] = 'ملخص';
$string['recordingtype_summary_next_steps'] = 'ملخص الخطوات التالية';
$string['recordingtype_summary_smart_chapters'] = 'ملخص الفصول الذكية';
$string['recordingtype_timeline'] = 'الجدول الزمني';
$string['recordingurl'] = 'عنوان URL للتسجيل';
$string['recordingview'] = 'عرض التسجيلات';
$string['recordingvisibility'] = 'هل تسجيلات هذا الاجتماع مرئية بشكل افتراضي؟';
$string['recordingvisibility_help'] = 'عند جلب التسجيلات الجديدة لهذا الاجتماع، هل يجب أن تكون مرئية في Moodle افتراضيًا؟';
$string['recreatesuccessful'] = 'تمت إعادة إنشاء الاجتماع بنجاح';
$string['recurrence_option_daily'] = 'يوميًا';
$string['recurrence_option_monthly'] = 'شهريا';
$string['recurrence_option_no_time'] = 'لا يوجد وقت محدد';
$string['recurrence_option_weekly'] = 'أسبوعي';
$string['recurrencetype'] = 'تكرار';
$string['recurringmeeting'] = 'متكرر';
$string['recurringmeeting_help'] = 'ليس له تاريخ انتهاء';
$string['recurringmeetingexplanation'] = 'ليس للاجتماع تاريخ انتهاء أو وقت';
$string['recurringmeetinglong'] = 'اجتماع متكرر (اجتماع بدون تاريخ أو وقت انتهاء)';
$string['recurringmeetingthisis'] = 'هذا لقاء متكرر';
$string['recycleonjoin'] = 'إعادة تدوير الترخيص عند الانضمام';
$string['redefinelicenses'] = 'إعادة تحديد التراخيص';
$string['refreshreports'] = 'تحديث تقارير الجلسة
';
$string['register'] = 'يسجل';
$string['registration'] = 'تتطلب التسجيل';
$string['registration_help'] = 'سيؤدي تمكين هذا الخيار إلى إجبار المشاركين على التسجيل في اجتماع Zoom/الندوة عبر الإنترنت قبل الانضمام.';
$string['registration_text'] = 'إجبار المشاركين على التسجيل لحضور الاجتماع/الندوة عبر الإنترنت';
$string['repeatinterval'] = 'تكرار كل';
$string['report'] = 'التقارير';
$string['reportapicalls'] = 'الإبلاغ عن استنفاد مكالمات واجهة برمجة التطبيقات';
$string['requirepasscode'] = 'تتطلب رمز المرور للاجتماع';
$string['requirepasscode_help'] = 'سيتطلب تمكين هذا الخيار أن يقوم المضيف بتعيين رمز مرور للاجتماع. سيُطلب من المشاركين المنضمين إدخال ذلك قبل الانضمام إلى الاجتماع. لا يحتاج المشاركون الذين يدخلون الاجتماع من داخل نشاط Moodle إلى إدخال رمز المرور هذا.';
$string['resetapicalls'] = 'إعادة ضبط عدد مكالمات API المتاحة';
$string['resetzoomsall'] = 'حذف كافة تقديرات المستخدم، وتسجيل بيانات عرض المستخدم، وبيانات المستخدم المشارك في الاجتماع.';
$string['room'] = 'غرفة';
$string['roomname'] = 'اسم الغرفة
';
$string['rooms'] = 'غرف';
$string['schedule'] = 'جدول';
$string['schedulefor'] = 'تحديد موعد للقاء';
$string['schedulefor_help'] = 'يمكنك جدولة الاجتماعات نيابة عن مستخدم آخر. كشرط أساسي، يجب أن يكون هذا المستخدم قد قام بتعيين امتياز الجدولة لك في Zoom. سيكون المستخدم المحدد هو مضيف الاجتماع وسيكون هو الشخص الذي سيتم استخدام ترخيص Zoom الخاص به في الاجتماع.';
$string['scheduleforself'] = 'نفسك';
$string['schedulingprivilege'] = 'امتياز الجدولة';
$string['schedulingprivilege_desc'] = 'باستخدام هذا الإعداد، يمكنك التحكم في ما إذا كان خيار امتياز الجدولة سيظهر للمستخدمين في إعدادات مثيل النشاط أم لا. يؤثر هذا الإعداد فقط على إعدادات مثيل نشاط Moodle. حتى إذا قررت إظهار الخيار، فسيظل المستخدم بحاجة إلى الحصول على امتياز الجدولة الممنوح من قبل مستخدم آخر في Zoom لجدولة اجتماع للمستخدم الآخر في النهاية.';
$string['schedulingprivilege_disable'] = 'تعطيل خيار امتياز الجدولة';
$string['schedulingprivilege_enable'] = 'تمكين خيار امتياز الجدولة';
$string['search:activity'] = 'Zoom - معلومات النشاط';
$string['security'] = 'حماية';
$string['selectionarea'] = 'لا اختيار';
$string['sessions'] = 'الجلسات';
$string['sessionsreport'] = 'تقرير الجلسات';
$string['sesskeyinvalid'] = 'تم اكتشاف جلسة غير صالحة. لا يمكن المضي قدما.';
$string['setpasscode'] = 'تعيين رمز المرور';
$string['showmedia'] = 'إظهار قسم الوسائط';
$string['showmedia_help'] = 'سيؤدي تمكين هذا الخيار إلى إظهار قسم الوسائط في صفحة نشاط الاجتماع.';
$string['showmediaonview'] = 'إظهار قسم الوسائط في صفحة الاجتماع';
$string['showschedule'] = 'عرض قسم الجدول الزمني';
$string['showschedule_help'] = 'سيؤدي تمكين هذا الخيار إلى إظهار قسم الجدول الزمني في صفحة نشاط الاجتماع.';
$string['showscheduleonview'] = 'إظهار قسم الجدول الزمني على صفحة الاجتماع';
$string['showsecurity'] = 'إظهار قسم الأمان';
$string['showsecurity_help'] = 'سيؤدي تمكين هذا الخيار إلى إظهار قسم الأمان في صفحة نشاط الاجتماع.';
$string['showsecurityonview'] = 'إظهار قسم الأمان في صفحة الاجتماع';
$string['start'] = 'ابدأ';
$string['start_meeting'] = 'ابدأ الاجتماع';
$string['start_time'] = 'في أي وقت';
$string['starthostjoins'] = 'ابدأ الفيديو عند انضمام المضيف';
$string['startpartjoins'] = 'ابدأ الفيديو عند انضمام مشارك';
$string['starttime'] = 'وقت البداية';
$string['status'] = 'الحالة';
$string['supplementaryfeaturessettings'] = 'إعدادات الميزات التكميلية';
$string['supplementaryfeaturessettings_desc'] = 'تتحكم هذه الإعدادات في إمكانية توفير ميزات Zoom الإضافية للمستخدمين وكيفية ذلك.';
$string['title'] = 'العنوان';
$string['topic'] = 'المضوع';
$string['trackingfields'] = 'حقول التتبع';
$string['trackingfields_help'] = 'أدخل اسم (أسماء) حقول التتبع/التسمية (التسميات)، مفصولة بفواصل، لتمكين أنشطة Zoom.';
$string['trackingfields_recommendedvalues'] = 'القيم الموصى بها:';
$string['unamedisplay'] = 'اسم عرض المستخدم';
$string['unamedisplay_help'] = 'كيفية عرض اسم المستخدم في الاجتماعات (يعمل فقط للمستخدمين الذين لم يقوموا بتسجيل الدخول إلى عميل Zoom).';
$string['unavailable'] = 'غير قادر على الانضمام في هذا الوقت';
$string['unavailablefinished'] = 'لقد انتهى الاجتماع بالفعل.
';
$string['unavailablefirstjoin'] = 'يمكنك الانضمام قبل {$a->mins} دقيقة من وقت البدء المجدول في أقرب وقت ممكن.';
$string['unavailablenotstartedyet'] = 'لم يبدأ الاجتماع بعد.';
$string['updatemeetings'] = 'تحديث اعدادات الاجتماع من Zoom';
$string['updatetrackingfields'] = 'قم بتحديث إعدادات حقل التتبع من Zoom';
$string['usepersonalmeeting'] = 'استخدام معرف الاجتماع الشخصي {$a}';
$string['waitingroom'] = 'غرفة الانتظار';
$string['waitingroomenable'] = 'تمكين غرفة الانتظار';
$string['webinar'] = 'ندوة عبر الانترنت';
$string['webinar_already_false'] = '<p><b>تم تعيين هذه الوحدة بالفعل على أنها اجتماع وليس ندوة عبر الويب. لا يمكنك تبديل هذا الإعداد بعد إنشاء الاجتماع.</b></p>';
$string['webinar_already_true'] = '<p><b>تم تعيين هذه الوحدة بالفعل كندوة عبر الإنترنت وليست اجتماعًا. لا يمكنك تبديل هذا الإعداد بعد إنشاء ندوة الويب.</b></p>';
$string['webinar_alwaysshow'] = 'قم دائمًا بإظهار خيار الندوات عبر الإنترنت بغض النظر عما إذا كان المستخدم لديه ترخيص لاستضافة الندوات عبر الإنترنت';
$string['webinar_by_default'] = 'ندوة عبر الإنترنت بشكل افتراضي';
$string['webinar_by_default_desc'] = 'قم بإنشاء مثيل Zoom كندوة عبر الإنترنت بشكل افتراضي.';
$string['webinar_desc'] = 'باستخدام هذا الإعداد، يمكنك التحكم في ما إذا كان خيار إنشاء ندوة عبر الإنترنت سيظهر للمستخدمين أثناء إنشاء الاجتماع أم لا. يؤثر هذا الإعداد فقط على إعدادات مثيل نشاط Moodle. حتى إذا قررت إظهار الخيار دائمًا، فسيظل المستخدم بحاجة إلى ترخيص صالح للندوات عبر الإنترنت حتى يتمكن أخيرًا من استضافة ندوة عبر الإنترنت.';
$string['webinar_disable'] = 'تعطيل الندوات عبر الإنترنت';
$string['webinar_help'] = 'هذا الخيار متاح فقط لحسابات Zoom المعتمدة مسبقًا.';
$string['webinar_showonlyiflicense'] = 'إظهار خيار الندوات عبر الإنترنت فقط إذا كان لدى المستخدم ترخيص لاستضافة الندوات عبر الإنترنت
';
$string['webinarthisis'] = 'هذه ندوة عبر الإنترنت';
$string['week'] = 'الأسبوع (الأسابيع)';
$string['weekoption_first'] = 'أولاً';
$string['weekoption_fourth'] = 'الرابع';
$string['weekoption_last'] = 'آخر';
$string['weekoption_second'] = 'ثان';
$string['weekoption_third'] = 'ثالث';
$string['zoom:addinstance'] = 'إضافة اجتماع Zoom جديد';
$string['zoom:eligiblealternativehost'] = 'يمكن اختياره كمضيف بديل ضمن اجتماعات Zoom';
$string['zoom:refreshsessions'] = 'قم بتحديث تقارير اجتماعات Zoom';
$string['zoom:view'] = 'عرض اجتماعات Zoom';
$string['zoom:viewdialin'] = 'عرض معلومات الاتصال الهاتفي Zoom';
$string['zoom:viewjoinurl'] = 'عرض عنوان URL للانضمام إلى Zoom';
$string['zoomerr'] = 'حدث خطأ مع Zoom';
$string['zoomerr_alternativehostusernotfound'] = 'لم يتم العثور على المستخدم {$a} على Zoom.';
$string['zoomerr_apilimit'] = 'تم الوصول إلى الحد الأقصى للمعدل اليومي لواجهة برمجة التطبيقات هذه. أعد المحاولة عند {$a}';
$string['zoomerr_field_missing'] = 'لم يتم العثور على {$a}.';
$string['zoomerr_id_missing'] = 'يجب عليك تحديد معرف المساق_الوحدة أو معرف النسخة';
$string['zoomerr_licensesnumber_missing'] = ' تم العثور على الإعداد الأقصى للتكبير/التصغير، ولكن لم يتم العثور على licensesnumber';
$string['zoomerr_maxretries'] = 'تمت إعادة المحاولة {$a->maxretries} مرات لإجراء المكالمة، لكنها فشلت: {$a->response}';
$string['zoomerr_meetingnotfound'] = 'لا يمكن العثور على هذا الاجتماع في Zoom. يمكنك لا يمكن العثور على هذا الاجتماع في Zoom. يمكنك <a href="{$a->recreate}">إعادة إنشائه هنا</a> أو <a href="{$a->delete}">حذفه نهائياً</a>.';
$string['zoomerr_meetingnotfound_info'] = 'لا يمكن العثور على هذا الاجتماع في Zoom. يرجى الاتصال بمضيف الاجتماع إذا كانت لديك أسئلة.';
$string['zoomerr_no_access_token'] = 'لم يتم إرجاع رمز الوصول';
$string['zoomerr_scopes'] = 'يفتقد تكوين Zoom OAuth هذه النطاقات المطلوبة: {$a}';
$string['zoomerr_usernotfound'] = 'تعذر العثور على حسابك في Zoom. إذا كنت تستعمل Zoom للمرة الأولى، فيجب عليك تفعيل حسابك عبر تسجيل الدخول إلى <a href="{$a}" target="_blank">{$a}</a>. بمجرد تنشيط حسابك في Zoom، أعد تحميل هذه الصفحة واستمر في إعداد اجتماعك. تأكد أيضاً من أن بريدك الالكتروني في Zoom يطابق بريدك الالكتروني في هذا النظام.';
$string['zoomerr_viewrecordings_off'] = 'تم إيقاف عرض التسجيلات، ولا يمكن تشغيل المهمة';
$string['zoomurl'] = 'رابط الصفحة الرئيسية لـ Zoom';
