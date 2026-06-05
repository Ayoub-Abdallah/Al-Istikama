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
 * Strings for component 'block_onlinesurvey', language 'ar', version '5.1'.
 *
 * @package     block_onlinesurvey
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['error_debugmode_missing_capability'] = 'الكتلة في وضع تصحيح الأخطاء. ليست لديك صلاحية معاينة المحتوى.';
$string['error_survey_pwd_missing'] = 'كلمة مرور SOAP مفقودة';
$string['onlinesurvey:myaddinstance'] = 'إضافة كتلة جديدة من التقييمات (EvaSys) إلى صفحتي';
$string['privacy:metadata:block_onlinesurvey:username'] = 'قيمة اسم المستخدم المرسلة إلى EvaSys للتحقق من الاستطلاعات الموجودة';
$string['setting_blocktitle'] = 'العنوان';
$string['setting_blocktitle_desc'] = 'النص المُدخل هنا سيستعمل بمثابة عنوان للكتلة.';
$string['setting_communication_interface'] = 'بروتوكول الاتصال';
$string['setting_communication_interface_desc'] = 'هنا يمكنك تعريف ما إذا كان ينبغي على مودل الاتصال مع EvaSys عبر SOAP أو LTI. <br /><em>إعتماداً على بروتوكول الاتصال المحدد هنا، لطفاً، أجرِ الإعدادات الإضافية في قسم البروتوكول ذي الصلة أدناه.</em>';
$string['setting_survey_debug_desc'] = 'إذا تم تفعيله، ستظهر بيانات كشف الأخطاء ورسائلها ضمن كتلة EvaSys .';
$string['setting_survey_hide_empty'] = 'إخفاء الكتلة الفارغة';
$string['setting_survey_popupinfo_content_default'] = '<p>عزيزي الطالب،</p>
<p>هناك حاليًا استبيان واحد أو أكثر لا يزال مفتوحًا بشأن المقررات الدراسية التي قمت بزيارتها. مشاركتك تساعدنا في تحسين عروضنا.<br />
روابط الاستبيانات معروضة في كتلة "التقييمات".</p>
<p>شكرًا لدعمك!<br />
فريق تقييمك</p>';
$string['setting_survey_popupinfo_title'] = 'العنوان المنبثق';
$string['setting_survey_popupinfo_title_desc'] = 'عند الحاجة، يمكن تعديل عنوان النافذة المنبثقة بهذا الإعداد.';
$string['setting_survey_pwd'] = 'كلمة مرور EvaSys SOAP';
$string['setting_survey_pwd_desc'] = 'كلمة المرور لمستخدم EvaSys SOAP.';
$string['setting_survey_timeout'] = 'مهلة الاتصال';
$string['setting_survey_timeout_desc'] = 'أقصى وقت استجابة (بالثواني) لمخدم EvaSys. إذا لم يقم مخدم EvaSys بالإجابة خلال هذه المهلة، يتم إحباط الطلب ولن يتم عرض الاستبيانات للمستخدم.';
