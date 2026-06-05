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
 * Strings for component 'amanote', language 'ar', version '5.1'.
 *
 * @package     amanote
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['amanotedetails_sizedate'] = '{$a->size} {$a->date}';
$string['amanotedetails_sizetype'] = '{$a->size} {$a->type}';
$string['amanotedetails_sizetypedate'] = '{$a->size} {$a->type} {$a->date}';
$string['cannotcreatetoken_help'] = 'ليست لديك صلاحيات فتح المستند في Amanote.';
$string['importantinformationdescription'] = 'لتعمل الوحدة بشكل صحيح، يرجى التحقق من كون المتطلبات الآتية ملباة في موقعك لمودل:

1. خدمات الويب مُمَكَّنة (إدارة الموقع > مزايا متقدمة)

2. *خدمة الويب للجوال في مودل* مُمَكَّنة (إدارة الموقع > الإضافات > خدمات الويب > الخدمات الخارجية)

3. بروتوكول REST مُفعَّل (إدارة الموقع > الإضافات > خدمات الويب > إدارة البروتوكولات)

4. الإمكانية *webservice/rest:use* مسموح بها *للمستخدم المصادق عليه* (إدارة الموقع > المستخدمون > الصلاحيات > تعريف الأدوار > المستخدمون المصادق عليهم > إدارة الأدوار)';
$string['modulename_help'] = 'الملف القابل للشروحات هو أحد موارد المقرر (ملف PDF) يمكن للطلاب فتحه في Amanote© من أجل تدوين ملاحظات واضحة ومنظمة فيه.

للطلاب أن يقوموا بما يأتي:

* فتح مورد المساق في تبويب جديد من المستعرض
* تنزيل مورد المساق إلى حاسباتهم
* فتح مورد المساق في Amanote© والشروع بتدوين الملاحظات

عندما يفتح الطلاب مورد المقرر في Amanote©، لديهم إمكانية البدء بتدوين الملاحظات الذكي. يتم ربك ملاحظاتهم مع الصفحات المختلفة من المستند. بل الأكثر من ذلك، يمكنهم إغناء ملاحظاتهم بالشروحات، الرسومات، المعادلات، الصور، التأشيرات في الشرائح، إلخ.

عندما يحفظ الطلاب ملاحظاتهم، يتم حفظها ضمن المورد في مساحتهم الشخصية. سيجدون ملاحظاتهم أمامهم في المرة القادمة التي يفتحون فيها المورد.';
$string['openstatistics'] = 'إفتح الإحصائيات';
$string['openstatistics_help'] = 'هذا يمنحك وصولاً إلى إحصائيات الاستعمال العائدة للطلبة وإفاداتهم بشأن هذا المورد.';
$string['printintro'] = 'عَرض وصف المورد';
$string['printintroexplain'] = 'أتريد عرض وصف المورد تحت المحتوى؟';
$string['privacy:metadata:fullname'] = 'تم إرسال الاسم الكامل للمستخدم إلى النظام البعيد لإتاحة تجربة أفضل للمستخدم';
$string['showdate_desc'] = 'أتريد عرض تاريخ الرفع/التعديل في صفحة المقرر؟';
$string['showsize'] = 'إظهار الحجم';
$string['showsize_desc'] = 'أتريد عرض حجم الملف في صفحة المقرر؟';
$string['statisticsbutton'] = 'فتح تحليلات التعلم';
