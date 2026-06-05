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
 * Strings for component 'plagiarism_unplag', language 'ar', version '5.1'.
 *
 * @package     plagiarism_unplag
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['attempts'] = 'المحاولات التي تم اكمالها';
$string['cronwarning'] = 'إن النص البرمجي للصيانة <a href="../../admin/cron.php">cron.php</a> لم يتم تشغيله لمدة 30 دقيقة على الأقل - ينبغي تهيئته للسماح لـ UNPLAG بالعمل بشكل صحيح.';
$string['defaultupdated'] = 'تم تحديث القيم الافتراضية';
$string['explainerrors'] = 'هذه الصفحة تعرض أي ملفات في وضعية خاطئة حاليًا.<br/> عند حذف الملفات في هذه الصفحة، لن يعود بالإمكان إعادة تسليمها ولن تبقى الأخطاء ظاهرة للمعلمين أو الطلاب.';
$string['getscore'] = 'إجلب الدرجة';
$string['heldevents'] = 'الأحداث المحتجزة';
$string['heldeventsdescription'] = 'تلك هي أحداث غير مكتملة عند المحاولة الأولى وتمت إعادة وضعها في الطابور لإعادة التسليم - هذا يمنع الأحداث اللاحقة من الإكمال وقد يتطلب المزيد من التحري. بعض تلك الأحداث قد لا تكون ذات صلة بـ UNPLAG.';
$string['refresh'] = 'أعد تنشيط الصفحة لمشاهدة النتائج';
$string['studentdisclosuredefault'] = 'سيتم تسليم كل الملفات المرفوعة إلى نظام كشف الانتحال UNPLAG.';
$string['unplag:viewsimilarity'] = 'السماح بمعاينة قيمة التشابه من UNPLAG';
$string['unplag_show_student_score'] = 'إظهار الدرجات للطلاب';
$string['waitingevents'] = 'هناك {$a->countallevents} من الأحداث التي تنتظر مشغل الوظائف الدورية و {$a->countheld} من الأحداث المحتجزة لإعادة تقديمها';
