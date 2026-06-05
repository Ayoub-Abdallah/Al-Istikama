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
 * Strings for component 'plagiarism_turnitin', language 'ar', version '5.1'.
 *
 * @package     plagiarism_turnitin
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['enablepseudo'] = 'تمكين خصوصية الطالب';
$string['enablepseudo_desc'] = 'إذا تم تحديد هذا الخيار، سيجري تحويل عناوين البريد الالكتروني للطلاب إلى ما يكافئها من العناوين الزائفة من أجل استدعاءات واجهة برمجة التطبيق في Turnitin.<br /><i>(<b>ملاحظة:</b> لا يمكن تغيير هذا الخيار إذا سبق وأن تمت مزامنة بيانات أي من المستخدمين مع Turnitin)</i>';
$string['excludesmallmatchesvalue'] = 'قيمة الاستبعاد';
$string['excludevalue'] = 'استبعاد التطابقات الصغيرة';
$string['journalcheck'] = 'الفحص إزاء المجلات،<br />الدوريات والمنشورات';
$string['ppeventsfailedconnection'] = 'لن تتم معالجة أي أحداث من قبل ملحق منع الانتحال Turnitin بواسطة تنفيذ مشغل الوظائف الدورية هذا نظرًا لتعذر تأسيس الاتصال مع Turnitin.';
$string['privacy:metadata:plagiarism_turnitin_client:firstname'] = 'تم إرسال الاسم الأول للمستخدم إلى Turnitin ليكون بالإمكان التعرف عليه';
$string['privacy:metadata:plagiarism_turnitin_client:lastname'] = 'تم إرسال الاسم الأخير للمستخدم إلى Turnitin ليكون بالإمكان التعرف عليه';
$string['privacy:metadata:plagiarism_turnitin_client:submission_content'] = 'يرجى أن تكون مدركاً بأن محتوى الملف/التسليم يتم إرسالها إلى Turnitin للمعالجة';
$string['privacy:metadata:plagiarism_turnitin_client:submission_filename'] = 'اسم الملف المسلَّم سيتم إرساله إلى Turntin ليكون بالإمكان التعرف عليه';
$string['privacy:metadata:plagiarism_turnitin_client:submission_title'] = 'عنوان التسليم سيتم إرساله إلى Turntin ليكون بالإمكان التعرف عليه';
$string['privacy:metadata:plagiarism_turnitin_files:attempt'] = 'طابع زمني يشير إلى وقت معاينة المستخدم للإفادة في تسليمه';
$string['privacy:metadata:plagiarism_turnitin_files:student_read'] = 'يشير إلى ما إذا قرأ الطالب إفادته';
$string['privacy:metadata:plagiarism_turnitin_files:submissionscore'] = 'درجة التشابه للتسليم';
$string['pseudoemailaddress'] = 'عنوان البريد الالكتروني الزائف';
$string['pseudoemaildomain'] = 'مجال البريد الالكتروني الزائف';
$string['pseudoemaildomain_desc'] = '<b>[إختياري]</b><br />مجال إختياري لعناوين البريد الالكتروني الزائفة. (إفتراضياً هو @tiimoodle.com إذا تُرك فارغاً)';
$string['pseudoemailsalt'] = 'الشفرة الفريدة الزائفة';
$string['pseudoemailsalt_desc'] = '<b>[إختياري]</b><br />شفرة فريدة إختيارية لزيادة تعقيد عنوان البريد الالكتروني الزائف المولد للطالب.<br />(<b>ملاحظة:</b> ينبغي الحفاظ على الشفرة الفريدة بلا تغيير لضمان تناسق عناوين البريد الالكتروني الزائفة)';
$string['pseudofirstname'] = 'الاسم الأول الزائف للطالب';
$string['pseudofirstname_desc'] = '<b>[إختياري]</b><br />الاسم الأول للطالب لعرضه في معاينة مستندات Turnitin';
$string['pseudolastname'] = 'الاسم الأخير الزائف للطالب';
$string['pseudolastname_desc'] = 'الاسم الأخير للطالب لعرضه في معاينة مستندات Turnitin';
$string['pseudolastnamegen_desc'] = 'إذا تم ضبطه إلى نعم، وتم ضبط الاسم الأخير الزائف للمستخدم إلى حقل من الملف الشخصي، فستتم تعبئة الحقل تلقائيًا بمُعرَّف فريد.';
$string['student'] = 'الطالب';
$string['studentdataprivacy'] = 'إعدادات خصوصية بيانات الطالب';
$string['studentdataprivacy_desc'] = 'يمكن تهيئة الإعدادات الآتية لضمان عدم إرسال البيانات الشخصية للطلاب إلى Turnitin بواسطة واجهة برمجة التطبيق.';
$string['studentreports_help'] = 'يسمح لك بعرض تقارير التشابه من Turnitin للطلاب. عند جعله \'نعم\'، تقرير التشابه المولد من قبل Turnitin سيكون متاحًا للطلاب لمعاينته.';
