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
 * Strings for component 'local_codechecker', language 'ar', version '5.1'.
 *
 * @package     local_codechecker
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['check'] = 'تدقيق النص البرمجي';
$string['clihelp'] = 'التحقق من بعض النصوص البرمجية بلغة PHP إزاء تعليمات البرمجة في مودل.
الخيارات:
  --interactive، -i يتوقف بعد كل ملف مما يسمح بالمتابعة مع الملف
                    التالي أو إعادة الفحص إزاء نفس الملف.
  --exclude، -e     استثناء الملفات المتواجدة في مسارات مبينة بنصوص مطابقة جزئية،
                    علامة النجمة مسموح بها بمثابة حروف عوض في أي موضع.
  --help، -h        تظهر هذه المعلومات
مثال:
  php run.php local/codechecker';
$string['error_find'] = 'فشل البحث في المجلد';
$string['exclude'] = 'استثناء';
$string['filesfound'] = 'الملفات المعثور عليها: {$a}';
$string['filesummary'] = '{$a->path} - {$a->count}';
$string['includewarnings'] = 'تضمين التحذيرات';
$string['info'] = '<p>يفحص النص البرمجي إزاء بعض المعايير الخاصة بـ {$a->link}.</p>
<p>أدخل المسار المؤدي إلى المجلد الجذري لنصوص مودل البرمجية، على سبيل المثال: {$a->path}.</p>
<p>يمكنك إما إدخال ملف PHP محدد، أو المجلد لفحص كل الملفات التي فيه.
هناك دعم لإدخالات متعددة (ملفات أو مجلدات)، كل منها بسطر مستقل.</p>
<p>لاستثناء بعض الملفات، يمكن استعمال قائمة من المسارات عبر ذكر نصوص جزئية من مسمياتها، على سبيل المثال: {$a->excludeexample}. علامة النجمة مسموح بها بمثابة حروف عوض في أي موضع.</p>';
$string['invalidpath'] = 'مسار خاطئ {$a}';
$string['moodlecodingguidelines'] = 'إرشادات البرمجة في مودل';
$string['numerrorswarnings'] = '{$a->errors} من الأخطاء و {$a->warnings} من التحذيرات';
$string['other_crlf'] = 'السطر منته بـ (CRLF) لوندوز بدلاً من مجرد LF (الإبلاغ فقط عن الحالة الأولى)';
$string['other_eol'] = 'الفراغ عند نهاية الخط';
$string['other_extralfs'] = 'سطر أو سطور فارغة إضافية عند نهاية الملف (استعمل واحداً بالضبط)';
$string['other_missinglf'] = 'فقدان LF عند نهاية الملف (استعمل واحدًا بالتحديد)';
$string['other_ratherlong'] = 'السطر أطول من عدد الأحرف الموصى بها والبالغ 132';
$string['other_tab'] = 'حرف Tab غير مسموح به';
$string['other_toolong'] = 'السطر أطول من عدد الأحرف القصوى والبالغ 180';
$string['path'] = 'المسارات المزمع فحصها';
$string['pluginname'] = 'مدقق النص البرمجي';
$string['privacy:metadata'] = 'إن ملحق فاحص الترميز البرمجي لا يخزن أي بيانات شخصية.';
$string['recheckfile'] = 'إعادة فحص الملف الحالي فقط';
$string['showstandard'] = 'عرض النص البرمجي القياسي بلغة php المتعلق بالمشكلة';
$string['success'] = 'أحسنت!';
$string['summary'] = 'الإجمالي: {$a}';
$string['wholefile'] = 'الملف';
