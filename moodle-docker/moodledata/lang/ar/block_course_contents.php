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
 * Strings for component 'block_course_contents', language 'ar', version '5.1'.
 *
 * @package     block_course_contents
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['config_autotitle'] = 'العنوان التلقائي';
$string['config_autotitle_desc'] = 'إذا لم يكن للقسم عنوان صريح، يمكن للكتلة محاولة استخراج العنوان من نص ملخص القسم. هذا الإعداد يحدد السلوك الافتراضي لهذه الميزة في عيِّنات الكتلة.';
$string['config_autotitle_forced_off'] = 'معطل في كل الكتل';
$string['config_autotitle_forced_on'] = 'مُمَكَّن في كل الكتل';
$string['config_autotitle_help'] = 'إذا لم يكن للقسم عنوان صريح، يمكن للكتلة محاولة استخراج العنوان من نص ملخص القسم.

إذا كان الملخص بادئًا بعنوان، فسيستعمل نص ذلك العنوان. إذا كان الملخص بادئًا بنص مضخم، فسيتم استعماله كعنوان للقسم. إذا كان الملخص محتويًا على عدة فقرات، سيتم استعمال الفقرة الأولى.';
$string['config_autotitle_label'] = 'تلقائيًا، استخرج العنوان من نص ملخص القسم';
$string['config_blocktitle'] = 'عنوان الكتلة';
$string['config_blocktitle_default'] = 'جدول المحتويات';
$string['config_blocktitle_help'] = 'أترك هذا الحقل فارغًا لاستعمال العنوان الافتراضي للكتلة. إذا وضعت عنوناً هنا، سيتم استعماله بدلاً عن العنوان الافتراضي.';
$string['config_display_course_link_forced_off'] = 'معطل في كل الكتل';
$string['config_display_course_link_forced_on'] = 'مُمَكَّن في كل الكتل';
$string['config_display_course_link_text'] = 'نص مخصص لرابط صفحة المقرر';
$string['config_display_course_link_text_desc'] = 'القيمة الافتراضية لنص ارتكاز رابط الصفحة الرئيسية للمساق. عند تركه فارغًا، سيتم استعمال الاسم المختصر للمقرر الدراسي.';
$string['config_display_course_link_text_help'] = 'نص ارتكاز رابط الصفحة الرئيسية للمساق. عند تركه فارغًا، سيتم استعمال القيمة الافتراضية على مستوى الموقع ما لم تكن فارغة هي الأخرى. في تلك الحالة، سيتم استعمال الاسم المختصر للمقرر الدراسي.';
$string['config_enumerate'] = 'ترقيم عناوين المقاطع';
$string['config_enumerate_desc'] = 'يمكن عرض رقم القسم قبل عنوانه. هذا الإعداد يحدد القيمة الافتراضية لنمط الترقيم في كل عيِّنة من الكتلة وما إذا كان بالإمكان تغييره أم لا.';
$string['config_enumerate_forced_off'] = 'معطل في كل الكتل';
$string['config_enumerate_forced_on'] = 'مُمَكَّن في كل الكتل';
$string['config_enumerate_label'] = 'عند تمكينه، رقم القسم سيُعرض قبل عنوانه';
$string['course_contents:addinstance'] = 'إضافة كتلة جديدة لمحتوى المقرر';
$string['pluginname'] = 'محتويات المقرر';
$string['privacy:metadata'] = 'محتويات المقررات الدراسية لا يخزن أي بيانات شخصية';
