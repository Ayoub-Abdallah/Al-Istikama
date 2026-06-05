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
 * Strings for component 'local_mailtest', language 'ar', version '5.1'.
 *
 * @package     local_mailtest
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['additionalinfo'] = 'المعلومات الإضافية:';
$string['alwaysshowlog'] = 'دائمًا أظهر وقوعات الاتصالات مع المخدم حتى وإن لم يكن هناك أخطاء.';
$string['checkingdomain'] = 'فحص أمان DNS لـ {$a}:';
$string['connectionlog'] = 'وقوعات الاتصالات مع المخدم';
$string['credit'] = 'Michael Milette - <a href="http://www.tngconsulting.ca/">TNG Consulting Inc.</a>';
$string['divertallemails'] = 'تحويل كل رسائل البريد';
$string['divertedto'] = 'التحويل إلى {$a}';
$string['emailfail'] = 'فشلت عملية إرسال البريد الالكتروني';
$string['failaccessdenied'] = '<li>الاتصال مع مخدم البريد ولكنه مغلق ثم أغلق الاتصال.</li>';
$string['failclosedport'] = 'منفذ المخدم {$a} مغلق. هل حددت رقم المنفذ الصحيح :port؟';
$string['fromemail'] = 'من عنوان البريد الالكتروني';
$string['heading'] = 'رسالة فحص تهيئة البريد';
$string['iconlabel'] = 'فحص الأمان لـ {$a}';
$string['message'] = '<p>هذه رسالة اختبارية. يُرجى إهمالها.</p>
<p>إذا تلقيت هذه الرسالة، فهذا معناه أنك نجحت في تهيئة إعدادات البريد الالكتروني في موقع مودل.</p>
<hr><p><strong>معلومات المستخدم الإضافية</strong></p>
<ul>
<li><strong>حالة التسجيل:</strong> {$a->regstatus}</li>
<li><strong>اللغة المفضلة:</strong> {$a->lang}</li>
<li><strong>مستعرض الويب الذي يستعمله المستخدم:</strong> {$a->browser}</li>
<li><strong>الرسالة مقدمة من:</strong> {$a->referer}</li>
<li><strong>إصدار مودل:</strong> {$a->release}</li>
<li><strong>عنوان IP للمستخدم:</strong> {$a->ip}</li>
</ul>';
$string['noemailever'] = '<p>البريد الالكتروني في هذا الموقع قد تم تعطيله بطريقة <strong>$CFG-&gt;noemailever = true;</strong>.</p>';
$string['phpmethod'] = 'طريقة PHP الافتراضية';
$string['privacy:metadata'] = 'إن ملحق اختبار البريد الالكتروني لا يخزن أي بيانات شخصية.';
$string['recipientisrequired'] = 'ينبغي عليك تحديد عناوين البريد الالكتروني لمتلقي الرسالة.';
$string['registered'] = 'المستخدم المسجل ({$a}).';
$string['sendmethod'] = 'طريقة إرسال البريد الالكتروني';
$string['sendtest'] = 'أرسل رسالة اختبار';
$string['sentmail'] = 'نجح مودل في إرسال رسالة الاختبار إلى مخدم البريد SMTP.';
$string['sentmailphp'] = 'رسالة اختبار مودل تم قبولها بنجاح من قبل بريد PHP.';
$string['server'] = 'المخدم: {$a}';
$string['smtpmethod'] = 'مستضيفو SMTP: {$a}';
$string['testing'] = 'إختبار تهيئة البريد الالكتروني';
$string['toemail'] = 'إلى عنوان البريد الالكتروني';
$string['winsyslog'] = 'وقوعات الحدث في وندوز';
$string['youremail'] = 'عنوان بريدك الالكتروني';
