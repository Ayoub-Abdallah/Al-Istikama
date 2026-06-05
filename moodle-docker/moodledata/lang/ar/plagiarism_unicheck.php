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
 * Strings for component 'plagiarism_unicheck', language 'ar', version '5.1'.
 *
 * @package     plagiarism_unicheck
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cronwarning'] = 'إن النص البرمجي للصيانة <a href="../../admin/cron.php">cron.php</a> لم يتم تشغيله لمدة 30 دقيقة على الأقل - ينبغي تهيئته للسماح لـ Unicheck بالعمل بشكل صحيح.';
$string['debugging:filter:perpage'] = 'لكل صفحة';
$string['defaultupdated'] = 'تم تحديث القيم الافتراضية';
$string['event:api_called'] = 'إلتماس واجهة برمجة التطبيق';
$string['event:api_user_created'] = 'مستخدم تم إنشاؤه';
$string['event:api_user_updated'] = 'مستخدم تم تحديثه';
$string['event:archive_files_checked'] = 'ملفات أرشيف تم فحصها';
$string['event:archive_files_unpacked'] = 'ملفات أرشيف تم استخراجها وتجهيزها لفحص التشابه';
$string['event:archive_files_uploaded'] = 'ملفات أرشيف تم رفعها';
$string['event:error_handled'] = 'خطأ تمت معالجته';
$string['event:file_similarity_check_completed'] = 'فحص تشابه تم إكماله';
$string['event:file_similarity_check_failed'] = 'فحص تشابه فشل';
$string['event:file_similarity_check_recalculated'] = 'فحص تشابه تمت إعادة حسابه';
$string['event:file_similarity_check_started'] = 'فحص تشابه تم بدؤه';
$string['event:file_upload_completed'] = 'رفع ملف إكتمل';
$string['event:file_upload_failed'] = 'رفع ملف فشل';
$string['event:file_upload_started'] = 'رفع ملف تم بدؤه';
$string['explainerrors'] = 'هذه الصفحة تعرض أي ملفات في وضعية خاطئة حاليًا.<br/> عند حذف الملفات في هذه الصفحة، لن يعود بالإمكان إعادة تسليمها ولن تبقى الأخطاء ظاهرة للمعلمين أو الطلاب.';
$string['getscore'] = 'إجلب الدرجة';
$string['heldevents'] = 'الأحداث المُقامة';
$string['heldeventsdescription'] = 'تلك هي أحداث غير مكتملة عند المحاولة الأولى وتمت إعادة وضعها في الطابور لإعادة التسليم - هذا يمنع الأحداث اللاحقة من الإكمال وقد يتطلب المزيد من التحري. بعض تلك الأحداث قد لا تكون ذات صلة بـ Unicheck.';
$string['privacy:metadata:plagiarism_external_unicheck_api:domain'] = 'مجال مخدم مودل';
$string['privacy:metadata:plagiarism_external_unicheck_api:filedata'] = 'محتوى الملف المرفوع';
$string['privacy:metadata:plagiarism_external_unicheck_api:fileformat'] = 'إمتداد الملف المرفوع';
$string['privacy:metadata:plagiarism_external_unicheck_api:filename'] = 'اسم الملف المرفوع';
$string['privacy:metadata:plagiarism_unicheck_files:filename'] = 'اسم الملف المخزون';
$string['refresh'] = 'أعد تنشيط الصفحة لمشاهدة النتائج';
$string['show_student_score'] = 'إظهار درجات التشابه للطالب';
$string['studentdisclosuredefault'] = 'سيتم تسليم كل الملفات المرفوعة إلى نظام كشف الانتحال Unicheck.';
$string['unicheck:viewsimilarity'] = 'السماح بمعاينة قيمة التشابه من Unicheck';
