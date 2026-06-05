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
 * Strings for component 'newsletter', language 'ar', version '5.1'.
 *
 * @package     newsletter
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['delete_issue_question'] = 'هل أنت متأكد من رغبتك في حذف هذا العدد؟';
$string['delete_subscription_question'] = 'هل أنت متأكد من رغبتك في حذف هذا الاشتراك؟';
$string['emailexists'] = 'يوجد مسبقًا حساب مستخدم بعنوان البريد الالكتروني هذا. يرجى تسجيل دخولك من أجل الاشتراك بالرسالة الخبرية. إذا نسيت معطيات دخولك، استعمل رابط {$a} في صفحة تسجيل الدخول لاستعادتها.';
$string['entries_per_page'] = 'المُدخلات لكل صفحة';
$string['eventissuecreated'] = 'عدد رسالة خبرية تم إنشاؤه';
$string['eventissueviewed'] = 'عدد رسالة خبرية تمت معاينته';
$string['eventsubscriptioncreated'] = 'إشتراك رسالة خبرية جديد';
$string['eventsubscriptiondeleted'] = 'إشتراك رسالة خبرية تم حذفه';
$string['eventsubscriptionresubscribed'] = 'إعادة إشتراك في رسالة خبرية';
$string['eventsubscriptionsviewed'] = 'إشتراك رسالة خبرية تمت معاينته';
$string['eventsubscriptionunsubscribed'] = 'اشتراك رسالة خبرية تم إلغاؤه';
$string['header_content'] = 'محتوى العدد';
$string['issue_htmlcontent'] = 'محتوى HTML';
$string['issue_stylesheet'] = 'ورقة الأنماط لمحتوى HTML';
$string['issue_title'] = 'عنوان العدد';
$string['issue_title_help'] = 'أكتب هنا عنوان هذا العدد. مطلوب.';
$string['newsletter:addinstance'] = 'إضافة رسالة خبرية';
$string['newsletterintro'] = 'الوصف';
$string['subscribe_question'] = 'هل ترغب بالاشتراك في الرسالة الخبرية "{$a->name}" مستعملاً البريد الالكتروني "{$a->email}"؟';
$string['toc'] = 'إختر كيفية التوليد التلقائي لجدول المحتويات';
$string['toc_no'] = 'لا تقم بالتوليد التلقائي لجدول المحتويات';
$string['unsubscribe_mail_text'] = '<p>
عزيزنا {$a->firstname} {$a->lastname},
<br>
لقد تم إلغاء اشتراكك بنجاح من الرسالة الخبرية {$a->newslettertitle}. إن كنت قاصدًا لذلك، فليس لديك شيء آخر لتعمله. إن كان إلغاء الاشتراك أمرًا غير مقصود، يمكنك إعادة الاشتراك الآن عبر الرابط الآتي:
<br>
{$a->newsletterurl}</p>';
$string['unsubscribe_question'] = 'هل ترغب بإلغاء اشتراك بريدك الالكتروني "{$a->email}" في الرسالة الخبرية "{$a->name}"؟';
