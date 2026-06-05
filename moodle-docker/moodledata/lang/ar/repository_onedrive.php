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
 * Strings for component 'repository_onedrive', language 'ar', version '5.1'.
 *
 * @package     repository_onedrive
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['access'] = 'الوصول';
$string['both'] = 'داخلي وخارجي';
$string['cachedef_folder'] = 'مُعرَّفات ملف OneDrive للمجلدات في حساب النظام';
$string['configplugin'] = 'تهيئة ملحق OneDrive';
$string['confirmimportskydrive'] = 'هل أنت متأكد من رغبتك في استيراد كل الملفات من مستودع مايكروسوفت SkyDrive إلى مستودع مايكروسوفت OneDrive؟ تنبغي تهيئة مستودع مايكروسوفت OneDrive وتشغيله لتستمر الملفات المستوردة بالعمل كما في السابق. تحذير: هذا الإجراء لا يمكن التراجع عنه!';
$string['defaultreturntype'] = 'نوع الإرجاع الافتراضي';
$string['external'] = 'خارجي (فقط الروابط المخزونة في مودل)';
$string['fileoptions'] = 'أنواع وافتراضيات الملفات العائدة يتم تعريفها هنا. لاحظ بأن كل الملفات المرتبطة خارجياً سيتم تحديثها ليكون المالك هو حساب النظام في مودل.';
$string['importskydrivefiles'] = 'استورد الملفات من مستودع مايكروسوف SkyDrive';
$string['internal'] = 'داخلي (الملفات المخزونة في مودل)';
$string['issuer'] = 'خدمة OAuth 2';
$string['issuer_help'] = 'إختر خدمة OAuth 2 التي تمت تهيئتها للاتصال مع مفتاح برمجة واجهة التطبيق لـ OneDrive. إن لم تكن الخدمة موجودة بعد، عليك إنشاؤها.';
$string['mysitenotfound'] = 'لم يسبق لك تسجيل الدخول إلى OneDrive من قبل. ينبغي عليك الدخول إلى OneDrive مرة واحدة على الأقل قبل أن يكون متاحاً للاستعمال مع مودل.';
$string['oauth2serviceslink'] = '<a href="{$a}" title="رابط تهيئة خدمات OAuth 2">تهيئة خدمات OAuth 2</a>';
$string['onedrive:view'] = 'معاينة مستودع OneDrive';
$string['owner'] = 'مملوك من قبل: {$a}';
$string['pluginname'] = 'OneDrive من مايكروسوفت';
$string['privacy:metadata:repository_onedrive'] = 'إن ملحق مستودع مايكروسوفت OneDrive يخزن منح الوصول المؤقتة، وينقل بيانات المستخدمين من مودل إلى نظام خارجي';
$string['privacy:metadata:repository_onedrive:repository_onedrive_access:itemid'] = 'مايكروسوفت OneDrive مع مُعرَّف عنصر منح الوصول المؤقت';
$string['privacy:metadata:repository_onedrive:repository_onedrive_access:permissionid'] = 'مُعرَّف صلاحية منح الوصول المؤقت لمايكروسوفت OneDrive';
$string['privacy:metadata:repository_onedrive:repository_onedrive_access:timecreated'] = 'تاريخ ووقت إنشاء منح الوصول المؤقت لمايكروسوفت OneDrive';
$string['privacy:metadata:repository_onedrive:repository_onedrive_access:timemodified'] = 'تاريخ ووقت تعديل منح الوصول المؤقت لمايكروسوفت OneDrive';
$string['privacy:metadata:repository_onedrive:repository_onedrive_access:usermodified'] = 'مُعرَّف المستخدم الذي قام بتعديل منح الوصول المؤقت لمايكروسوفت OneDrive';
$string['privacy:metadata:repository_onedrive:searchtext'] = 'استعلام البحث النصي للمستخدم في مستودع مايكروسوفت OneDrive';
$string['removetempaccesstask'] = 'إزالة حق الكتابة المؤقت من الروابط المسيطر عليها.';
$string['searchfor'] = 'إبحث عن {$a}';
$string['servicenotenabled'] = 'لم تتم تهيئة الوصول.';
$string['skydrivefilesexist'] = 'إن مستودع مايكروسوفت SkyDrive مُمَكَّن ولكن تم التخلي. يرجى التأكد من ترحيل الملفات من مستودع SkyDrive إلى مستودع OneDrive في أقرب وقت ممكن. في الإصدار 4.4 من مودل، لن يعود بالإمكان القيام بذلك.';
$string['skydrivefilesimported'] = 'تم استيراد كل الملفات من مستودع مايكروسوفت SkyDrive .';
$string['skydrivefilesnotimported'] = 'تعذر استيراد بعض الملفات من مستودع مايكروسوفت SkyDrive .';
$string['supportedreturntypes'] = 'الملفات المدعومة';
