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
 * Strings for component 'tool_coursebank', language 'ar', version '5.1'.
 *
 * @package     tool_coursebank
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['coursebank:download'] = 'تنزيل ملفات الحفظ الاحتياطي لبنك المساق';
$string['coursebank:edit'] = 'تحرير ملفات الحفظ الاحتياطي لبنك المساق';
$string['coursebank:view'] = 'معاينة قائمة لملفات الحفظ الاحتياطي لبنك المساق';
$string['coursebank:viewlogs'] = 'معاينة سجلات وقوعات بنك المساق';
$string['coursebanklogging'] = 'تسجيل وقوعات بنك المساق';
$string['coursefullname'] = 'اسم المقرر';
$string['coursename'] = 'اسم المقرر';
$string['event_backup_chunk_interrupted'] = 'نقل الحفظ الاحتياطي مع {$a} تمت مقاطعته بسبب فشل إحدى مكوناته';
$string['event_backup_init_completed'] = 'تم سابقًا نقل الحفظ الاحتياطي للمساق مع {$a} إلى بنك المساق.';
$string['event_backup_init_exists_data'] = 'الحفظ الاحتياطي للمساق مع {$a} موجود مسبقًا في بنك المساق. ستتم الكتابة على البيانات الموجودة.';
$string['event_backup_init_exists_nodata'] = 'الحفظ الاحتياطي للمساق مع {$a} موجود مسبقًا في بنك المساق، ولكن لم يتم نقل أي بيانات بعد.';
$string['event_backup_init_interrupted'] = 'تمت مقاطعة نقل الحفظ الاحتياطي مع {$a} خلال الشروع به.';
$string['event_backup_transfer_completed'] = 'نقل الحفظ الاحتياطي للمساق مع {$a} تم إكماله';
$string['event_backup_transfer_started'] = 'نقل الحفظ الاحتياطي للمساق مع {$a} تم بدؤه';
$string['event_backup_update'] = 'نقل الحفظ الاحتياطي للمساق مع {$a} تم تحديثه';
$string['event_backup_update_interrupted'] = 'نقل الحفظ الاحتياطي مع {$a} تمت مقاطعته بسبب فشل تحديثه';
$string['event_download_view_failed'] = 'المستخدم ذو المُعرَّف \'{$a}\' حاول مشاهدة صفحة تنزيلات الحفظ الاحتياطي ولكن وقع خطأ ما';
$string['event_downloads_viewed'] = 'المستخدم ذو المُعرَّف \'{$a}\' شاهد صفحة تنزيلات الحفظ الاحتياطي';
$string['event_transfer_queue_populated'] = '{$a} من ملفات الحفظ الاحتياطي للمساق تمت إضافتها إلى طابور النقل';
$string['eventbackupdeleted'] = 'ملف الحفظ الاحتياطي تم حذفه';
$string['eventbackupdeletefailed'] = 'حذف الحفظ الاحتياطي فشل';
$string['eventbackupdeleteskipped'] = 'حذف الحفظ الاحتياطي تم تخطيه';
$string['eventbackupdownloaded'] = 'الحفظ الاحتياطي تم تنزيله';
$string['eventbackupdownloadfailed'] = 'تنزيل الحفظ الاحتياطي فشل';
$string['eventbackupsendfailed'] = 'إرسال الحفظ الاحتياطي فشل';
$string['eventbackupupdated'] = 'سجل الحفظ الاحتياطي تم تحديثه';
$string['eventconnectionchecked'] = 'اتصال تم التحقق منه';
$string['eventconnectioncheckfailed'] = 'فحص الاتصال فشل';
$string['eventcroncompleted'] = 'مهمة بنك المساق المجدولة تم إكمالها';
$string['eventcronstarted'] = 'مهمة بنك المساق المجدولة تم بدؤها';
$string['eventdownloadsviewed'] = 'صفحة التنزيل تمت معاينتها';
$string['eventdownloadviewfailed'] = 'معاينة صفحة التنزيل فشلت';
$string['eventgetsession'] = 'مفتاح جلسة جديد تم إنشاؤه';
$string['eventgetsessionfailed'] = 'إنشاء مفتاح جلسة فشل';
$string['eventhttprequest'] = 'طلب HTTP';
$string['eventhttprequestfailed'] = 'طلب HTTP فشل';
$string['eventloggedas'] = '{$a->realusername} بصفة {$a->asusername}';
$string['eventname'] = 'اسم الحدث';
$string['eventorigin'] = 'الأصل';
$string['eventqueuepopulated'] = 'طابور حفظ إحتياطي للمساق تم نشره';
$string['eventstatusupdated'] = 'حالة الحفظ الإحتياطي تم تحديثها';
$string['eventstatusupdatefailed'] = 'تحديث حالة الحفظ الإحتياطي فشل';
$string['eventtimeoutreached'] = 'وقت انتهاء تنفيذ مشغل الوظائف الدورية تم بلوغه';
$string['eventtimeoutreached_desc'] = 'وقت انتهاء تنفيذ مشغل الوظائف الدورية تم بلوغه خلال نقل المساق {$a}.';
$string['eventtransfercompleted'] = 'نقل الحفظ الاحتياطي إكتمل';
$string['eventtransferinterrupted'] = 'نقل الحفظ الاحتياطي تمت مقاطعته';
$string['eventtransferresumed'] = 'نقل الحفظ الاحتياطي تم استئنافه';
$string['eventtransferstarted'] = 'نقل الحفظ الاحتياطي تم بدؤه';
$string['eventtransferstartfailed'] = 'بدء نقل الحفظ الاحتياطي فشل';
$string['filesize'] = 'حجم الملف';
$string['nav_report'] = 'سجلات وقوعات بنك المساق';
$string['reportpageheader'] = 'سجلات وقوعات بنك المساق';
$string['settings_intro'] = 'لطفاً، أنظر <a href="https://account.coursebank.biz/content/moodle-setup" target="_blank">توثيقات إعداد مودل</a> لتتعلم كيفية تهيئة ملحقك. هناك أيضاً <a href="https://account.coursebank.biz/content/faq" target="_blank">صفحة الأسئلة المتكررة</a>';
$string['statusinprogress'] = 'النقل قيد التنفيذ';
$string['valuefor'] = 'قيمة {$a}';
