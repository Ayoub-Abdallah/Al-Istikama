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
 * Strings for component 'local_rocketchat', language 'ar', version '5.1'.
 *
 * @package     local_rocketchat
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowexternalconnection'] = 'اتصال خارجي';
$string['allowexternalconnection_desc'] = 'في حالة التمكين ، يمكن للمستخدمين <a href="/local/rocketchat/linkaccount.php" target="_blank"> الاتصال </a> بمثيل Rocket.Chat وتخزين الرمز الذي تم استرداده في Moodle. باستخدام هذا الإعداد ، يجب على المستخدمين ربط حساب Rocket.Chat مرة واحدة فقط.';
$string['auth_failure'] = 'Rocket.Chat تكامل - فشل المصادقة';
$string['button_sync'] = 'مزامنة يدوية';
$string['channel_creation'] = 'Rocket.Chat تكامل - إنشاء قناة';
$string['connection_failure'] = 'فشل إنشاء اتصال عميل بخادم Rocket.Chat';
$string['course_desc'] = 'إدارة التكامل بين مودل و Rocket.Chat. حدد المستخدمين والمساقات التي تتطلب تكامل Rocket.Chat وقم بتشغيل المزامنة يدويًا.';
$string['courseeventbasedsyncresult'] = 'معرّف المساق هو - {$a->courseid} / إن eventbasedsync هو {$a->eventbasedsync}';
$string['courseinfo_1'] = 'سوف تتأثر المساقات المبنية على المزامنة القائمة على الأحداث بأحداث معينة - group_member_added و group_member_removed و user_enrolment_updated. تأكد من إجراءك لمزامنة أولية قبل تشغيلها.';
$string['courseinfo_2'] = 'ستتم مزامنة المساقات ذات المزامنة المعلقة مع rocketchat عند التنفيذ التالي لمشغل الوظائف الدورية في الخلفية. ستتم إزالة المزامنة المعلقة بعد إجرائها.';
$string['courseinfo_3'] = 'سيؤدي التمرير فوق النقاط الثلاث إلى عرض أي أخطاء.';
$string['courseinfo_4'] = 'سيتم تشغيل تنفيذ المزامنة اليدوية على الفور';
$string['coursesyncparam_courseid'] = 'معرف المساق';
$string['coursesyncparam_enentbasedsync'] = 'يبرز ما إذا كان المساق قد تم فيه تفعيل المزامنة القائمة على الحدث';
$string['coursesyncparam_pendingsync'] = 'يبرز ما إذا كان المساق بانتظار للمزامنة';
$string['coursesyncparam_requiresync'] = 'يبرز ما إذا كان المساق يتطلب المزامنة';
$string['coursesyncparam_roleid'] = 'معرف الدور';
$string['coursesyncresult'] = 'معرّف المساق هو - {$a->courseid} / إن Pendingsync هو {$a->pendingsync}';
$string['coursetable_column_1'] = 'مساق';
$string['coursetable_column_2'] = 'مزامنة على أساس الحدث';
$string['coursetable_column_3'] = 'مزامنة معلقة';
$string['coursetable_column_4'] = 'تاريخ آخر مزامنة';
$string['coursetriggeryncresult'] = 'النجاح: معرف المساق هو - {$a-> courseid}';
$string['groupregex'] = 'مجموعة عوامل تصفية Regex';
$string['groupregex_desc'] = 'يُستعمل لمطابقة المجموعات التي تنبغي مزامنتها مع Rocket.Chat:<ul><li>/all/</li><li>/coach group [a-z] [0-9]/</li><li>/مثلا  مجموعة المشروع [0-9] [0-9]/</li></ul>';
$string['heading_api'] = 'اتصال واجهة برمجة التطبيق';
$string['heading_course'] = 'تكامل المساق';
$string['heading_role'] = 'تكامل الدور';
$string['heading_sync'] = 'إعدادات المزامنة';
$string['hostname'] = 'اسم المضيف';
$string['hostname_desc'] = 'يرجى تحديد اسم المجال المؤهل بالكامل لمثيل روكت جات.';
$string['linkaccount'] = 'تفضيلات Rocket.Chat';
$string['linkaccount_connected'] = 'حساب Rocket.Chat متصل';
$string['linkaccount_disconnected'] = 'حساب Rocket.Chat غير متصل';
$string['linkaccount_unexpectedmessage'] = '<br/><br/>أعاد Rocket.Chat الخطأ: "{$a}"';
$string['linkaccount_unexpectedresult'] = 'حدثت مشكلة في الاتصال بحساب Rocket.Chat الخاص بك. يرجى التحقق من معطيات الحساب ثم حاول مجددًا.';
$string['password'] = 'كلمه المرور';
$string['password_desc'] = 'كلمة المرور المحددة للمستخدم المحدد.';
$string['pluginname'] = 'Rocket.Chat';
$string['port'] = 'المنفذ';
$string['port_desc'] = 'يرجى تحديد المنفذ إن لم يكن هو الافتراضي (3000).';
$string['privacy:metadata:local_rocketchat'] = 'تم إرسال معطيات حساب المستخدم وواجهة برمجة التطبيق إلى مضيف Rocket.Chat الخارجي.';
$string['privacy:metadata:local_rocketchat_api:password'] = 'كلمة المرور المتعلقة بحساب واجهة برمجة تطبيق Rocket.Chat.';
$string['privacy:metadata:local_rocketchat_api:username'] = 'اسم المستخدم المتعلق بحساب واجهة برمجة تطبيق Rocket.Chat.';
$string['privacy:metadata:local_rocketchat_user:password'] = 'كلمة المرور المتعلقة بحساب مستخدم Rocket.Chat.';
$string['privacy:metadata:local_rocketchat_user:username'] = 'البريد الالكتروني المتعلق بحساب مستخدم Rocket.Chat.';
