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
 * Strings for component 'message_kopereemail', language 'ar', version '5.1'.
 *
 * @package     message_kopereemail
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action_create'] = 'إنشاء رسالة مخصصة';
$string['action_delete'] = 'حذف الرسالة المخصصة';
$string['action_edit'] = 'تعديل الرسالة المخصصة';
$string['action_export'] = 'تصدير JSON';
$string['action_import'] = 'استيراد JSON';
$string['action_preview'] = 'القوالب';
$string['action_preview_click'] = 'انقر هنا لتلقي رسالة بريد إلكتروني مع اختبار هذا القالب';
$string['action_preview_success'] = 'تم إرسال البريد الإلكتروني بنجاح. يرجى التحقق من صندوق الوارد أو مجلد البريد العشوائي.';
$string['export_filename_prefix'] = 'kopereemail-templates';
$string['export_title'] = 'تصدير القوالب';
$string['import_file'] = 'ملف JSON';
$string['import_file_help'] = 'اختر ملف JSON الذي تم تصديره من البيئة الأخرى.';
$string['import_invalid_json'] = 'ملف غير صالح: JSON غير مُنسّق بشكل صحيح.';
$string['import_invalid_payload'] = 'ملف غير صالح: بنية التصدير غير مطابقة.';
$string['import_overwrite'] = 'الكتابة فوق القوالب الحالية';
$string['import_overwrite_help'] = 'إذا تم تحديده، سيتم تحديث القوالب الحالية. إذا لم يتم تحديده، فسيتم تجاهل القوالب الحالية.';
$string['import_success'] = 'اكتمل الاستيراد.<br>&amp;nbsp;&amp;gt; <strong>تم الاستيراد:</strong> {$a->imported}<br>&amp;nbsp;&amp;gt; <strong>تم التجاوز:</strong> {$a->skipped}<br>&amp;nbsp;&amp;gt; <strong>تم تحديث الغلاف:</strong> {$a->wrapper}.';
$string['import_title'] = 'استيراد القوالب';
$string['import_wrapper'] = 'استيراد غلاف HTML (القالب الأساسي)';
$string['import_wrapper_help'] = 'إذا تم تحديده، فسيستبدل غلاف HTML الموجود في JSON الغلاف المُكوَّن في هذه البيئة.';
$string['messages'] = 'messages';
$string['placeholders_course_data_desc'] = 'بيانات المقرر (عند إمكانية اكتشافها).';
$string['placeholders_course_url_desc'] = 'رابط المقرر (عند إمكانية اكتشافه).';
$string['placeholders_dates_now_desc'] = 'التاريخ/الوقت الحاليان (userdate).';
$string['placeholders_desc'] = 'يمكنك استخدام عناصر نائبة Mustache في الرسالة.';
$string['placeholders_fullmessage_desc'] = 'رسالة نصية عادية.';
$string['placeholders_fullmessagehtml_desc'] = 'رسالة HTML (استخدم الأقواس الثلاثية).';
$string['placeholders_site_fullname_desc'] = 'الاسم الكامل للموقع (<code>{$SITE->fullname}</code>).';
$string['placeholders_site_logourl_desc'] = 'شعار الموقع (<img src="{$a->logo_url}" style="max-width:70px;max-height:70px;">).';
$string['placeholders_site_shortname_desc'] = 'الاسم المختصر للموقع (<code>{$SITE->shortname}</code>).';
$string['placeholders_site_url_desc'] = 'رابط الموقع (<code>{$CFG->wwwroot}</code>).';
$string['placeholders_subject_desc'] = 'موضوع الإشعار الحالي.';
$string['placeholders_title'] = 'العناصر النائبة المتاحة';
$string['placeholders_userfrom_data_desc'] = 'بيانات المُرسِل.';
$string['placeholders_userto_data_desc'] = 'بيانات المُستلم.';
$string['pluginname'] = 'Kopere Email';
$string['privacy:metadata:attachment'] = 'ملف مرفق في نظام الملفات.';
$string['privacy:metadata:attachname'] = 'اسم المرفق.';
$string['privacy:metadata:externalpurpose'] = 'غرض خارجي';
$string['privacy:metadata:fullmessage'] = 'رسالة نصية عادية.';
$string['privacy:metadata:fullmessagehtml'] = 'رسالة HTML.';
$string['privacy:metadata:recipient'] = 'مستلم البريد الإلكتروني.';
$string['privacy:metadata:replyto'] = 'بريد الرد (Reply-to).';
$string['privacy:metadata:replytoname'] = 'اسم الرد (Reply-to).';
$string['privacy:metadata:subject'] = 'موضوع البريد الإلكتروني.';
$string['privacy:metadata:userfrom'] = 'مرسل البريد الإلكتروني.';
$string['settings_customtemplates'] = 'رسائل مخصصة لكل مزوّد';
$string['settings_customtemplates_desc'] = 'إنشاء/تعديل رسالة مخصصة لكل مزوّد إشعارات.';
$string['settings_wrapper'] = 'قالب البريد الإلكتروني الأساسي (الغلاف)';
$string['settings_wrapper_desc'] = 'تم تنسيق هذا الـ HTML باستخدام Mustache وسيُطبَّق كقالب للرسالة المراد إرسالها إلى الطالب. يجب إدراج محتوى HTML في الموضع الذي توجد فيه {{{fullmessagehtml}}}.';
$string['table_actions'] = 'الإجراءات';
$string['table_component'] = 'المكوّن';
$string['table_name'] = 'الاسم';
$string['table_provider'] = 'المزوّد';
$string['template'] = 'القالب';
$string['template_changue'] = 'أريد استخدام هذا القالب كقالب افتراضي لـ Kopere Mail';
$string['template_changued'] = 'تم تحديث القالب بنجاح';
$string['template_delete_confirm'] = 'هل أنت متأكد أنك تريد حذف الرسالة المخصصة لهذا المزوّد؟';
$string['template_delete_title'] = 'حذف الرسالة المخصصة';
$string['template_deleted'] = 'تم حذف الرسالة المخصصة.';
$string['template_edit_bodyhtml'] = 'HTML الرسالة';
$string['template_edit_provider'] = 'المزوّد';
$string['template_edit_save'] = 'حفظ';
$string['template_edit_subject'] = 'الموضوع (اختياري)';
$string['template_edit_title'] = 'رسالة مخصصة';
$string['template_preview'] = 'معاينة القالب';
$string['template_saved'] = 'تم حفظ الرسالة المخصصة.';
$string['templates_other'] = 'قوالب أخرى';
$string['templates_transfer_desc'] = 'استخدم هذه الخدمة لترحيل الإعدادات بين البيئات (مثلًا: staging -> production).';
$string['templates_transfer_title'] = 'تصدير / استيراد الإعدادات';
