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
 * Strings for component 'local_uploadnotification', language 'ar', version '5.1'.
 *
 * @package     local_uploadnotification
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actioncreated'] = 'تم إنشاؤها';
$string['actionupdated'] = 'تم تحديثها';
$string['heading'] = 'رفع إعدادات الإشعارات';
$string['long_diff'] = 'في هذا الملف {$a}، الصفحات قد تغيرت.';
$string['long_diff_many'] = 'تغيرت صفحات كثيرة في هذا الملف.';
$string['messageprovider:digest'] = 'إشعار موجز تعديلات المساق';
$string['pluginname'] = 'إشعار الرفع';
$string['printed_changelog_prefix'] = 'هذا الملف هو تحديث لـ {$a->filename} من {$a->date}.';
$string['printed_diff_prefix'] = 'الصفحات الآتية من هذا الملف قد تغيرت:';
$string['settings_allow_changelog'] = 'السماح بالتوليد التلقائي لسجل وقوعات التغيير في المساقات';
$string['settings_allow_changelog_help'] = 'السماح للمعلمين بتمكين التحري التلقائي عن سجل وقوعات التغيير في مساقاتهم. عند تعطيله، لن يرى المعلمون هذا الإعداد ولن يتمكنوا من تمكين هذه الوظيفة.';
$string['settings_allow_mail'] = 'السماح بتوصيل إشعار البريد الالكتروني';
$string['settings_allow_mail_help'] = 'عند تمكينه، يمكن إرسال البريد الالكتروني المتضمن إشعارات بشأن المواد الجديدة';
$string['settings_course_allow_attachment'] = 'السماح بمرفقات البريد الالكتروني';
$string['settings_course_allow_attachment_help'] = 'عند ضبطه، يمكن للطلاب مراجعة المادة الجديدة مباشرة عبر البريد الالكتروني. تفعيل هذا الخيار لن يؤدي إلى إرسال المرفقات تلقائيًا في كل مرة، ولكن للطلاب إمكانية تمكين هذه الوظيفة لهم.';
$string['settings_course_disable'] = 'تعطيل';
$string['settings_course_enable'] = 'تمكين';
$string['settings_course_enable_changelog'] = 'عرض سجل وقوعات التغيير بشأن التحديثات.';
$string['settings_course_enable_changelog_help'] = 'عند ضبطه، سيتم التحري عن التحديثات في المادة المعطاة وسيتم عرض سجل وقوعات التغيير تحت الملف الحالي. هذا من شأنه مساعدة طلابك في معالجة التغييرات في المستندات.';
$string['settings_course_enable_diff'] = 'التحري عن الاختلافات في التحديثات';
$string['settings_course_enable_diff_help'] = 'عند ضبطه، سيقوم محلل تلقائي بالتحري عن التغييرات في الصفحات إذا قمت بتغيير المادة المعطاة. سيتم عرض رقم الصفحة تحت الملف الحالي.';
$string['settings_course_enable_mail'] = 'تمكين إيصال إشعارات البريد الالكتروني بشأن رفع المواد';
$string['settings_course_enable_mail_help'] = 'بلا تفضيل: يمكن لطلابك أن يقرروا بأنفسهم ما إذا كانوا يريدون تلقي رسائل البريد الالكتروني أم لا<br>معطلة: لن يتم إيصال رسائل البريد الالكتروني بشأن التغييرات في المادة التي في مساقك<br>مُمَكَّنة: سيتلقى الطلاب رسائل بريد الكتروني عند تغييرات المادة، ما عدا إذا قاموا بحظر التوصيل المسهب للمادة.';
$string['settings_course_error_diff_no_changelog'] = 'التحري عن الاختلاف يتطلب وظيفة سجل وقوعات التغيير. يرجى تمكينه أو تعطيل التحري عن الاختلافات.';
$string['settings_course_headline'] = 'إعدادات المساق بشأن إشعارات الرفع وتوليد سجل وقوعات التغيير.';
$string['settings_course_link'] = 'إشعارات الرفع';
$string['settings_course_no_preferences'] = 'لا تفضيلات';
$string['settings_course_require_valid_course_admin'] = 'هذه الميزة متاحة فقط إلى مشرفي المساق.';
$string['settings_course_require_valid_course_id'] = 'هذه الميزة متاحة فقط إلى مُعرفات المساق الصحيحة.';
$string['settings_diff_not_available'] = '<p>لا يتوفر التحري عن التغييرات في ملفات PDF نظرًا لعدم وجود أداة <code>diff</code> في نظامك. إذا فعّلت الإعداد أعلاه، فراجع إعدادات المشرف في مكتبة ChangelogLib المحلية لتحديد المسار الصحيح. تختفي هذه الرسالة في حال العثور على الأداة.</p>';
$string['settings_digest'] = 'وقت توصيل الموجز';
$string['settings_digest_help'] = 'الموعد اليومي الذي ينبغي عند إرسال إشعارات الإيجاز.';
$string['settings_enable_changelog_by_default'] = 'تمكين سجل وقوعات التغيير إفتراضيًا';
$string['settings_enable_changelog_by_default_help'] = 'عند تمكينه، سيتم تفعيل سجل وقوعات التغييرات في المساقات التي ليست فيها إعدادات مخصصة. إذا لم يكن المعلم راغبًا بهذا، فعليه تعطيله يدويًا.';
$string['settings_enable_diff_by_default'] = 'تمكين التحري عن الاختلافات تلقائيًا';
$string['settings_enable_diff_by_default_help'] = 'عند تمكينه، سيتم تفعيل التحري عن التغييرات في المساقات التي ليست فيها إعدادات مخصصة. إذا لم يكن المعلم راغبًا بهذا، فعليه تعطيله يدويًا.';
$string['settings_max_diff_filesize'] = 'الحجم المسموح به للملفات المحللة من أجل التحري عن التغييرات<br>(بالميغا بايت)';
$string['settings_max_diff_filesize_help'] = 'إذا كان حجم ملف المادة أكبر من هذه القيمة، لن يتم احتساب أي فروقات له. ضع هذه القيمة على صفر لتعطيل التحري عن الفروقات.<br>التحري عن الفروقات يتطلب تمكين سجل وقوعات التغيير.';
$string['settings_max_mail_amount'] = 'أقصى حجم للمساق بالنسبة للأشعارات';
$string['settings_max_mail_amount_help'] = 'عدِّل هذه القيمة لتجنب الحمل الزائد في وقت واحد. تعريف ما يصل إليه حجم المساق حيث سيتم إرسال الرسائل.';
$string['settings_max_mail_filesize'] = 'أقصى حجم للملفات المرفقة بالبريد الالكتروني<br>(بالكيلوا بايت)';
$string['settings_max_mail_filesize_help'] = 'أقصى حجم لملفات المادة الذي يُسمح بإرساله كمرفقات بالبريد الالكتروني<br>ضعه صفرًا لتعطيل المرفقات.';
$string['settings_max_mails_for_resource'] = 'أقصى عدد من رسائل البريد الالكتروني التي معها نفس المرفق';
$string['settings_max_mails_for_resource_help'] = 'عدِّل هذه القيمة لتجنب الحمل الزائد في وقت واحد. تعريف مقدار الرسائل ذات المرفقات التي يسمح بإرسالها بناءً على وحدة مساق واحدة.';
$string['settings_pdftotext_not_available'] = '<p>لا يتوفر التحري عن التغييرات في ملفات PDF نظرًا لعدم وجود الأداة <code>pdftotext</code> في نظامك. إذا فعّلت الإعداد أعلاه، فراجع إعدادات المشرف في مكتبة ChangelogLib المحلية لتحديد المسار الصحيح. تختفي هذه الرسالة في حال العثور على الأداة.</p>';
$string['settings_required_mail_suffix'] = 'الللاحقة المطلوبة لعناوين البريد الالكتروني';
$string['settings_required_mail_suffix_help'] = 'أدخل اسم مجال مؤسستك للسماح حصرياً للعناوين التي تنتهي به. أتركه فارغاً للسماح لكل المزودين.';
$string['settings_saved_successfully'] = 'تم حفظ إعداداتك.';
$string['settings_user_disable'] = 'تعطيل';
$string['settings_user_enable'] = 'تمكين';
$string['settings_user_enable_digest'] = 'أرسل الموجز اليومي فقط';
$string['settings_user_enable_digest_help'] = 'تمكين: ستتلقى فقط بريد الكتروني واحد مساءً فيه كل التغييرات لذلك اليوم<br>تعطيل: ستتلقى بريدًا الكترونيًا في أقرب وقت ممكن بعد التغييرات';
$string['settings_user_enable_mail'] = 'تمكين إيصال إشعارات البريد الالكتروني عند رفع المواد';
$string['settings_user_enable_mail_help'] = 'بلا تفضيل: ستتلقى فقط بريدًا الكترونيًا إذا كام المعلم بتمكينه حصريًا في هذا المساق<br>معطل: لن يتم إيصال أي بريد الكتروني بشأن تغييرات المادة<br>مُمَكَّن: ستتلقى بريدًا الكترونيًا عند تغيير المادة، ما لم يمنع المعلم إيصاله بشكل حصري';
$string['settings_user_headline'] = 'هل ترغب بتلقي الإشعارات عند رفع المادة الجديدة إلى المساق؟';
$string['settings_user_link'] = 'إِشعار الرفع';
$string['settings_user_max_mail_filesize'] = 'أقصى حجم للملفات المرفقة بالبريد الالكتروني<br>(بالكيلوا بايت)';
$string['settings_user_max_mail_filesize_help'] = 'يمكنك تلقي المواد الجديدة أو المحدثة مباشرة عبر البريد الالكتروني. هذا يحدد أقصى حجم لملفات المادة المسموح بإرسالها كمرفقات بالبريد الالكتروني<br>ضعه صفرًا لتعطيل المرفقات.';
$string['settings_user_max_mail_filesize_not_more_than_admin'] = 'إن مشرف الموقع يسمح فقط للمرفقات إلى حد {$a} كيلو بايت';
$string['settings_user_no_preferences'] = 'لا تفضيل';
$string['settings_user_not_negative'] = 'القِيَم السالبة غير مسموح بها';
$string['settings_user_require_valid_users'] = 'هذه الميزة متاحة فقط للمستخدمين الفعليين.';
$string['templatemessage'] = 'مرحبًا {$a->firstname}،

النشاطات والموارد الآتية قد تغيرت في المساقات التي أنت منضم إليها.

{$a->notifications}

{$a->signoff}

أنت تتلقى هذه الرسالة لأنك أو لأن المعلم قد طلب هذه المعلومات. بإمكانك تحرير تفضيلاتك من خلال {$a->user_settings}';
$string['templatemessage_html'] = 'مرحبًا {$a->firstname}،<br><br>

النشاطات والموارد الآتية قد تغيرت في المساقات التي أنت منضم إليها.

<ul>
{$a->notifications}
</ul>

{$a->signoff}<br><br>

أنت تتلقى هذه الرسالة لأنك أو لأن المعلم قد طلب هذه المعلومات. بإمكانك تحرير تفضيلاتك من خلال <a href="{$a->user_settings}">preferences</a>.';
$string['templateresource'] = '* "{$a->filename}" في "{$a->coursefullname}" ({$a->url_course}) قد {$a->action}: {$a->url_file}';
$string['templateresource_html'] = '<li><a href="{$a->url_file}">{$a->filename}</a> في <a href="{$a->url_course}">{$a->coursefullname}</a> قد {$a->action}</li>';
$string['templatesubject_plural'] = 'تحديثات الموارد التي في مساقاتك {$a}';
$string['templatesubject_singular'] = 'تحديثات الموارد التي في مساقك {$a}';
$string['uploadnotification:receivedigest'] = 'تلقي إشعار بموجز التغيير في المساق';
$string['warning'] = 'تحذير';
