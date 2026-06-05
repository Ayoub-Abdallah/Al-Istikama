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
 * Strings for component 'local_recompletion', language 'ar', version '5.1'.
 *
 * @package     local_recompletion
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['advancedrecompletiontitle'] = 'متقدمة';
$string['archivequiz'] = 'أرشفة محاولات الاختبار القديمة';
$string['assignevent'] = 'تحديث إكمال المساق عند تغيير التقدير';
$string['eventrecompletion'] = 'إعادة إكمال المساق';
$string['privacy:metadata:quiz_attempts'] = 'تفاصيل مؤرشفة عن كل محاولة للاختبار';
$string['privacy:metadata:quiz_attempts:attempt'] = 'رقم المحاولة';
$string['privacy:metadata:quiz_attempts:currentpage'] = 'الصفحة الحالية التي يقف عندها المستخدم';
$string['privacy:metadata:quiz_attempts:preview'] = 'فيما إذا كان هذا استعراض للاختبار';
$string['privacy:metadata:quiz_attempts:state'] = 'الحالة الحالية للمحاولة';
$string['privacy:metadata:quiz_attempts:sumgrades'] = 'مجموع التقديرات في المحاولة';
$string['privacy:metadata:quiz_attempts:timecheckstate'] = 'وقت التحقق من الحالة';
$string['privacy:metadata:quiz_attempts:timefinish'] = 'وقت إكمال المحاولة';
$string['privacy:metadata:quiz_attempts:timemodified'] = 'وقت تحديث المحاولة';
$string['privacy:metadata:quiz_attempts:timemodifiedoffline'] = 'وقت تحديث المحاولة من قبل التحديث بدون الاتصال بالإنترنت';
$string['privacy:metadata:quiz_attempts:timestart'] = 'وقت بدء المحاولة';
$string['privacy:metadata:quiz_grades'] = 'تفاصيل مؤرشفة عن الدرجة الإجمالية للمحاولات السابقة لهذا الاختبار';
$string['privacy:metadata:quiz_grades:grade'] = 'الدرجة الإجمالية لهذا الاختبار';
$string['privacy:metadata:quiz_grades:quiz'] = 'الاختبار الذي تم تقييمه';
$string['privacy:metadata:quiz_grades:timemodified'] = 'وقت تحديث الدرجة';
$string['privacy:metadata:quiz_grades:userid'] = 'المستخدم الذي تم تقييمه';
$string['quizattempts'] = 'محاولات الاختبار';
$string['quizattempts_help'] = 'ما العمل مع المحاولات الحالية للاختبار. إذا تم اختيار الحذف والأرشفة، ستتم أرشفة المحاولات القديمة للاختبار في جداول local_recompletion، أما إذا تم اختيار منح محاولات إضافية، هذا من شأنه إضافة تجاوز في الاختبار للسماح للمستخدم بأن يوضع له العدد الأقصى المسموح به من المحاولات.';
$string['recompletionemailbody_help'] = 'يمكن إضافة رسالة عن موضوع الإكمال مخصصة بتنسيق عادي أو بتنسيق مودل التلقائي، متضمنة وسوم HTML ووسوم متعدد اللغات.

يمكن تضمين العناصر النائبة الآتية في الرسالة:

* اسم المقرر {$a->coursename}
* رابط المساق {$a->link}
* رابط إلى صفحة الملف الشخصي للمستخدم {$a->profileurl}
* بريد المستخدم {$a->email}
* اسم المستخدم الكامل {$a->fullname}';
$string['recompletionemailsubject_help'] = 'يمكن إضافة رسالة عن موضوع الإكمال مخصصة بتنسيق عادي.

يمكن تضمين العناصر النائبة الآتية في الرسالة:

* اسم المقرر {$a->coursename}
* اسم المستخدم الكامل {$a->fullname}';
