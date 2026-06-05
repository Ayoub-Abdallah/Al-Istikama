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
 * Strings for component 'qtype_multichoiceset', language 'ar', version '5.1'.
 *
 * @package     qtype_multichoiceset
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['correctanswer'] = 'صحيح';
$string['deletedchoice'] = 'تم حذف هذا الاختيار بعد بدء المحاولة.';
$string['errnocorrect'] = 'ينبغي أن يكون أحد الخيارات على الأقل صحيحاً بحيث يمكن الحصول على العلامة الكاملة لهذا السؤال.';
$string['pluginname'] = 'الكل أو لا شيء متعدد الخيارات';
$string['pluginname_help'] = 'بعد مقدمة اختيارية، يمكن للمستجيب اختيار إجابة واحدة أو أكثر. إذا كانت الإجابات المختارة تتوافق تماماً مع الخيارات "الصحيحة" المحددة في السؤال، فسيحصل المجيب على 100٪. إذا اختار هو/هي أي خيارات "غير صحيحة" أو لم يحدد جميع الخيارات "الصحيحة"، فإن التقدير هو 0٪. يجب تحديد إختيار واحد على الأقل بشكل صحيح لكل سؤال. أضف خيار "لا شيء مما سبق" للتعامل مع السؤال عندما لا يوجد خيار آخر صحيح. على عكس سؤال الاختيار من متعدد ذي الدرجات الجزئية، فإن الدرجات الممكنة الوحيدة لسؤال الكل أو لا شيء هي 100٪ أو 0٪';
$string['pluginname_link'] = 'question/type/multichoiceset';
$string['pluginnameadding'] = 'إضافة سؤال الكل أو لا شيء متعدد الخيارات';
$string['pluginnameediting'] = 'تحرير سؤال الكل أو لا شيء متعدد الخيارات';
$string['pluginnamesummary'] = 'يسمح باختيار استجابات متعددة من قائمة محددة مسبقاً ويستعمل منح التقديرات على أساس الكل أو لا شيء (100٪ أو 0٪).';
$string['privacy:metadata'] = 'إن ملحق نوع السؤال، الكل أو لا شيء متعدد الخيارات لا يخزن أي بيانات شخصية.';
$string['showeachanswerfeedback'] = 'إظهار الإفادة للاستجابات المحددة.';
