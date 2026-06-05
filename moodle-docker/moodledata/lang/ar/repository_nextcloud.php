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
 * Strings for component 'repository_nextcloud', language 'ar', version '5.1'.
 *
 * @package     repository_nextcloud
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['both'] = 'داخلي وخارجي';
$string['cannotconnect'] = 'تعذرت مصادقة المستخدم. لطفاً، قم بتسجيل الدخول ومن ثم إرفع الملف.';
$string['chooseissuer'] = 'المُصدر';
$string['chooseissuer_help'] = 'لإضافة مُصدر جديد، إذهب إلى إدارة الموقع / المخدم / خدمات OAuth 2.';
$string['configplugin'] = 'تهيئة مستودع Nextcloud';
$string['configuration_exception'] = 'وقع خطأ في تهيئة عميل OAuth 2: {$a}';
$string['contactadminwith'] = 'تعذر تنفيذ الإجراء المطلوب. إذا تكرر ذلك، لطفاً، تواصل مع المشرف على الموقع لتزويده بالمعلومات الإضافية الآتية:<br>"<i>{$a}</i>".';
$string['couldnotmove'] = 'تعذر نقل الملف المطلوب إلى المجلد {$a}.';
$string['defaultreturntype'] = 'نوع الإرجاع الافتراضي';
$string['endpointnotdefined'] = 'نقطة النهاية {$a} لم يتم تعريفها.';
$string['external'] = 'خارجي (فقط الروابط المخزونة في مودل)';
$string['externalpubliclinkwarning'] = 'تنبيه: هذا الملف سيكون متاحًا بشكل عام.';
$string['filenotaccessed'] = 'تعذر الوصول إلى الملف المطلوب. لطفاً، تحقق من كونك قد اخترت ملفاً صحيحاً ولديك صلاحيات الحساب الصحيح.';
$string['fileoptions'] = 'أنواع وافتراضيات الملفات العائدة يتم تعريفها هنا. لاحظ بأن كل الملفات المرتبطة خارجياً سيتم تحديثها ليكون المالك هو حساب النظام في مودل.';
$string['foldername'] = 'اسم المجلد المنشأ في الحيز الشخصي لـ Nextcloud والذي يمتلك كل روابط سيطرة الوصول.';
$string['foldername_help'] = 'لضمان عثور المستخدمين على الملفات المشاركة معهم، يتم حفظ ما تتم مشاركته في مجلد معين.

هذا الإعداد يحدد اسم المجلد. من الموصى به اختيار اسم ذي صلة بعينة تنصيبك من مودل.';
$string['internal'] = 'داخلي (الملفات المخزونة في مودل)';
$string['invalidresponse'] = 'استجابة خاطئة للمخدم.';
$string['issuervalidation_invalid'] = 'حالياً، مُصدر {$a} نشط، مع ذلك، هو لا يطبق كل النقاط النهائية الضرورية. لن يعمل المستودع.';
$string['issuervalidation_valid'] = 'مُصدر {$a} نشط حالياً.';
$string['issuervalidation_without'] = 'لم تختر بعد مخدم Nextcloud بمثابة مُصدر لـ OAuth 2.';
$string['nextcloud'] = 'Nextcloud';
$string['nextcloud:view'] = 'معاينة Nextcloud';
$string['no_right_issuers'] = 'لا يقوم أي من المُصدرين الحاليين بتنفيذ جميع نقاط النهاية المطلوبة. يرجى تسجيل المصدر المناسب.';
$string['noclientconnection'] = 'تعذر توصيل عملاء OAuth.';
$string['notauthorized'] = 'ليس مصرحاً لك بتنفيذ هذا الطلب. لطفاً، تأكد من أنك تمتلك الصلاحية الصحيحة في حسابك.';
$string['oauth2serviceslink'] = '<a href="{$a}" title="رابط لتهيئة خدمات OAuth 2">تهيئة خدمات OAuth 2</a>';
$string['pathnotcreated'] = 'تعذر إنشار مسار المجلد {$a} في حساب النظام.';
$string['pluginname'] = 'Nextcloud';
$string['pluginname_help'] = 'مستودع Nextcloud';
$string['privacy:metadata'] = 'إن ملحق مستودع Nextcloud لا يخزن أي بيانات شخصية، ولا ينقل بيانات المستخدمين من مودل إلى نظام خارجي.';
$string['request_exception'] = 'فشل طلب {$a->instance}. {$a->errormessage}';
$string['requestnotexecuted'] = 'تعذر تنفيذ الطلب. إذا حدث ذلك بشكل متكرر، لطفاً، تواصل مع مشرف الموقع.';
$string['right_issuers'] = 'يقوم المُصدرون الآتون بتنفيذ نقاط النهاية المطلوبة: <br> {$a}';
$string['supportedreturntypes'] = 'الملفات المدعومة';
