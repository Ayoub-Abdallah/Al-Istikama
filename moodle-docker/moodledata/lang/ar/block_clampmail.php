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
 * Strings for component 'block_clampmail', language 'ar', version '5.1'.
 *
 * @package     block_clampmail
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actions'] = 'الإجراءات';
$string['add_all'] = 'إضافة الكل';
$string['add_button'] = 'إضافة';
$string['all_groups'] = 'كل المجموعات';
$string['allowstudents'] = 'السماح للطلاب باستعمال CLAMPMail';
$string['alternate'] = 'عناوين البريد الالكتروني البديلة';
$string['alternate_activated'] = 'البريد الالكتروني البديل {$a->address} يمكن استعماله الآن في {$a->course}.';
$string['alternate_activation_status'] = 'حالة التفعيل';
$string['alternate_approved'] = 'موافق عليه';
$string['alternate_body'] = '<p>
{$a->fullname} أضاف {$a->address} بمثابة عنوان إرسال بديل لـ {$a->course}.
</p>

<p>
الغرض من هذا البريد كان التحقق من أن هذا العنوان موجود، وإن مالكه لديه الصلاحيات المناسبة في مودل.
</p>

<p>
إذا كنت ترغب في إكمال عملية التحقق، يرجى
المتابعة عبر توجيه متصفحك إلى الرابط الآتي: {$a->url}.
</p>

<p>
إذا كان الوصف في هذه الرسالة غير مفهوم بالنسبة إليك، فقد
تكون استلمتها بطريق الخطأ. ببساطة، أهمل هذه الرسالة.
</p>

Thank you.';
$string['alternate_delete_confirm'] = 'هل أنت متأكد من رغبتك في حذف {$a->address}؟ هذا الإجراء لا يمكن التراجع عنه.';
$string['alternate_failure'] = 'لا يمكن إرسال البريد إلى {$a->address}. يرجى التأكد من وجود {$a->address}، ثم حاول مجددًا.';
$string['alternate_from'] = 'مودل: {$a}';
$string['alternate_invalid'] = 'رابط التفعيل لم يعد له وجود بالنسبة إلى {$a->address}. المتابعة إلى إرسال رابط التفعيل.';
$string['alternate_new'] = 'إضافة عنوان بديل';
$string['alternate_saved'] = 'العنوان البديل {$a->address} قد تم حفظه.';
$string['alternate_subject'] = 'التحقق من عنوان البريد الالكتروني البديل';
$string['alternate_success'] = 'لقد أُرسل رسالة بريد الكتروني إلى {$a->address} للتحقق. التعليمات الخاصة بكيفية تفعيل العنوان مضمنة في محتوياتها.';
$string['alternate_waiting'] = 'بالانتظار';
$string['are_you_sure'] = 'هل أنت متأكد من رغبتك في حذف {$a->title}؟ هذا الإجراء لا يمكن التراجع عنه.';
$string['attachment'] = 'المرفق(ات)';
$string['clampmail:addinstance'] = 'إضافة كتلة CLAMPMail جديدة';
$string['clampmail:allowalternate'] = 'السماح للمستخدمين بإضافة عنوان بريد الكتروني بديل للمساقات.';
$string['clampmail:canconfig'] = 'السماح للمستخدمين بتهيئة عيِّنة CLAMPMail.';
$string['clampmail:canimpersonate'] = 'السماح للمستخدمين بتسجيل الدخول بصفة مستخدمين آخرين ومعاينة الأحداث الماضية.';
$string['clampmail:cansend'] = 'السماح للمستخدمين بإرسال بريد الكتروني عبر CLAMPMail';
$string['clampmail:cansendtoall'] = 'السماح للمستخدمين بمراسلة كل الآخرين الذين معهم في المساق بغض النظر عن إعدادات المجموعات';
$string['composenew'] = 'كتابة بريد الكتروني جديد';
$string['config'] = 'التهيئة';
$string['default_flag'] = 'الافتراضي';
$string['default_signature'] = '{$a} (الافتراضي)';
$string['defaultgroupmode'] = 'الوضع الافتراضي للمجموعة';
$string['defaultgroupmode_desc'] = 'الوضع الافتراضي للمجموعة بالنسبة إلى عيِّنات الكتلة الجديدة';
$string['delete_confirm'] = 'هل أنت متأكد من رغبتك في حذف الرسالة ذات التفاصيل الآتية: {$a}';
$string['delete_email'] = 'حذف البريد الالكتروني';
$string['delete_failed'] = 'فشلت عملية حذف البريد الالكتروني';
$string['delete_signature_confirm'] = 'هل أنت متأكد من رغبتك في حذف: {$a}';
$string['drafts'] = 'معاينة المسودات';
$string['email'] = 'البريد الالكتروني';
$string['eventalternateemailadded'] = 'بريد الكتروني بديل تمت إضافته';
$string['from'] = 'من';
$string['log'] = 'معاينة الأحداث الماضية';
$string['manage_signatures'] = 'إدارة التواقيع';
$string['maximumupload'] = 'أقصى حجم للمرفقات';
$string['maximumupload_desc'] = 'أقصى حجم للمرفقات بالنسبة إلى رسالة البريد الالكتروني المنفردة.';
$string['message'] = 'الرسالة';
$string['missing_recipient'] = 'المتلقي ذي المُعرَّف {$a} لم يعد منضمًا إلى هذا المساق.';
$string['newsignature'] = 'توقيع جديد';
$string['no_alternates'] = 'لم يُعثر على بريد الكتروني بديل لـ {$a->fullname}. المتابعة لإنشائه.';
$string['no_course'] = 'مساق خاطئ ذي المُعرَّف {$a}';
$string['no_drafts'] = 'ليست لديك مسودات بريد الكتروني.';
$string['no_email'] = 'تعذرت مراسلة {$a->firstname} {$a->lastname}.';
$string['no_filter'] = 'بلا مرشح';
$string['no_group'] = 'ليس في المجموعة';
$string['no_log'] = 'ليست لديك أحدث ماضية بعد.';
$string['no_permission'] = 'ليست لديك صلاحية إرسال رسائل بريد الكتروني مع {$a}.';
$string['no_recipient_emails'] = 'ليس هناك متلقون لرسالة البريد الالكتروني. إما أنك نسيت إدخال أي منهم، أو قمت بتحديد عناوين ليس مسموحًا لك بمراسلتها.';
$string['no_selected'] = 'ينبغي عليك اختيار بعض المستخدمين لمراسلتهم.';
$string['no_subject'] = 'ينبغي أن يكون لديك موضوع';
$string['no_type'] = '{$a} ليس ضمن نوع المعاينين المقبولين. يرجى استعمال التطبيق بالشكل الصحيح.';
$string['no_users'] = 'ليس هناك مستخدمون بإمكانك مراسلتهم.';
$string['not_valid'] = 'ليس هذا نوع معاينة أحداث بريد الكتروني ماضية صالح: {$a}';
$string['not_valid_action'] = 'ينبغي عليك أن تعطي إجراءً صحيحًا: {$a}';
$string['not_valid_typeid'] = 'ينبغي عليك إعطاء بريد الكتروني صحيح لـ {$a}';
$string['not_valid_user'] = 'لا يمكنك معاينة الأحداث الماضية للبريد الالكتروني للآخرين.';
$string['open_email'] = 'فتح البريد الالكتروني';
$string['pluginname'] = 'CLAMPMail';
$string['potential_groups'] = 'المجموعات المحتملة';
$string['potential_users'] = 'المتلقون المحتملون';
$string['prepend_class'] = 'إلحاق اسم المقرر';
$string['prepend_class_desc'] = 'إلحاق الاسم المختصر للمساق بموضوع البريد الالكتروني.';
$string['privacy:metadata:clampmail_drafts'] = 'مسودات البريد الالكتروني المحفوظة';
$string['privacy:metadata:clampmail_log'] = 'سجل وقوعات لرسائل البريد الالكتروني المرسلة';
$string['privacy:metadata:clampmail_message:mailto'] = 'مُعرَّف(ات) متلقي البريد الالكتروني';
$string['privacy:metadata:clampmail_message:message'] = 'محتوى البريد الالكتروني';
$string['privacy:metadata:clampmail_message:subject'] = 'سطر موضوع البريد الالكتروني';
$string['privacy:metadata:clampmail_message:time'] = 'الوقت الذي فيه تم إنشاء البريد الالكتروني أو حفظه';
$string['privacy:metadata:clampmail_message:userid'] = 'مُعرَّف المستخدم الذي أنشأ البريد الالكتروني';
$string['privacy:metadata:clampmail_signatures'] = 'تواقيع البريد الالكتروني';
$string['privacy:metadata:clampmail_signatures:signature'] = 'محتوى التوقيع';
$string['privacy:metadata:clampmail_signatures:title'] = 'عنوان التوقيع';
$string['privacy:metadata:clampmail_signatures:userid'] = 'مُعرَّف المستخدم الذي يمتلك التوقيع';
$string['receipt'] = 'تلقي نسخة';
$string['receipt_help'] = 'تلقي نسخة من البريد الالكتروني المزمع إرساله';
$string['remove_all'] = 'إزالة الكل';
$string['remove_button'] = 'إزالة';
$string['required'] = 'ترجى تعبئة الحقول المطلوبة.';
$string['reset'] = 'استعادة إفتراضات النظام';
$string['role_filter'] = 'مرشح الأدوار';
$string['save_draft'] = 'حفظ المسودة';
$string['select_cansend'] = 'الأدوار التي بإمكانها إرسال البريد الالكتروني';
$string['select_cansend_help'] = 'هذا الخيار يضبط ويزيل تجاوزات الإمكانية block/clampmail:cansend';
$string['select_roles'] = 'الأدوار لاستعماله في المرشح';
$string['select_users'] = 'إختر المستخدمين...';
$string['selected'] = 'المتلقون المحددون';
$string['send_email'] = 'إرسال البريد الالكتروني';
$string['sig'] = 'التوقيع';
$string['signature'] = 'التواقيع';
$string['signature_text'] = 'نص التوقيع';
$string['subject'] = 'الموضوع';
$string['title'] = 'العنوان';
