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
 * Strings for component 'factor_sms', language 'ar', version '5.1'.
 *
 * @package     factor_sms
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action:manage'] = 'تهيئة رقم الجوال';
$string['action:revoke'] = 'إزالة رقم الجوال';
$string['addnumber'] = 'رقم الجوال';
$string['clientnotfound'] = 'تعذر العثور على عميل خدمة AWS. ينبغي أن يكون العميل بتسمية كاملة للفئة، مثلاً \\Aws\\S3\\S3Client.';
$string['editphonenumber'] = 'تحرير رقم الجوال';
$string['editphonenumberinfo'] = 'إذا لم تتلق الرمز أو أدخلت رقمًا خاطئًا، يرجى تحرير الرقم ثم المحاولة مجددًا.';
$string['error:emptyverification'] = 'رمز فارغ. حاول مجددًا';
$string['error:wrongphonenumber'] = 'رقم الهاتف الذي أعطيته ليس بالتنسيق الصحيح.';
$string['error:wrongverification'] = 'رمز خاطئ. حاول مجددًا';
$string['errorawsconection'] = 'وقع خطأ عند الاتصال بمخدم AWS: {$a}';
$string['errorsmssent'] = 'وقع خطأ عند إرسال الرسالة القصيرة التي تحتوي رمز التحقق الخاص بك.';
$string['event:smssent'] = 'الرسالة القصيرة قد أُرسلت.';
$string['event:smssentdescription'] = 'المستخدم ذو المُعرَّف {$a->userid} قد حصل على رمز تحقق أُرسل إليه عبر رسالة قصيرة.
المعلومات: {$a->debuginfo}';
$string['info'] = 'إحصل على رمز تحقق يُرسل إلى رقم الجوال الذي تختاره.';
$string['logindesc'] = 'تم إرسال رسالة قصيرة تحتوي على رمز مكون من 6 مراتب رقمية إلى رقم الجوال: {$a}';
$string['loginoption'] = 'إحصل على رمز يُرسل إلى رقم جوالك';
$string['loginskip'] = 'لم أتلقى الرمز';
$string['loginsubmit'] = 'متابعة';
$string['logintitle'] = 'أدخل رمز التحقق المرسل إلى جوالك';
$string['managefactor'] = 'إدارة الرسالة القصيرة';
$string['managefactorbutton'] = 'إدارة';
$string['manageinfo'] = 'أنت تستعمل \'{$a}\' للمصادقة.';
$string['notification:smsgatewaymigration'] = 'إعدادات الرسائل القصيرة تم نقلها';
$string['notification:smsgatewaymigrationinfo'] = 'نظام رسائل قصيرة فرعي جديد صار متاحًا الآن لإدارة وتهيئة كل الوظائف ذات الصلة بالرسائل القصيرة. إعدادات الرسائل القصيرة عندك تم ترحيلها ضمنيًا إلى الصفحة <a href="{$a}">بوابات الرسائل القصيرة</a>.';
$string['phonehelp'] = 'أدخل رقم جوالك (متضمنًا رمز البلد) لتتلقى رمز التحقق.';
$string['pluginname'] = 'الرسائل القصيرة';
$string['privacy:metadata'] = 'إن ملحق الرسائل القصيرة لا يخزن أي بيانات شخصية.';
$string['revokefactorconfirmation'] = 'أتريد إزالة الرسالة القصيرة \'{$a}\'؟';
$string['settings:aws'] = 'رسالة قصيرة إلى AWS';
$string['settings:aws:key'] = 'المفتاح';
$string['settings:aws:key_help'] = 'معطيات دخول مفتاح واجهة برمجة تطبيق أمازون.';
$string['settings:aws:region'] = 'المنطقة';
$string['settings:aws:region_help'] = 'منطقة بوابة مفتاح واجهة برمجة تطبيق أمازون.';
$string['settings:aws:secret'] = 'السر';
$string['settings:aws:secret_help'] = 'معطيات سر واجهة برمجة تطبيق أمازون.';
$string['settings:aws:usecredchain'] = 'العثور على معطيات AWS باستعمال سلسلة مزود المعطيات الافتراضي';
$string['settings:countrycode'] = 'رمز البلد';
$string['settings:countrycode_help'] = 'رمز النداء بدون علامة + بادئة بشكل إفتراضي إذا لم يُدخل المستخدم رقمًا دوليًا ذي بائدة تحتوي على علامة +.

أنظر هذا الرابط الذي يعرض قائمة برموز النداء: {$a}';
$string['settings:duration'] = 'فترة الصلاحية';
$string['settings:duration_help'] = 'المهلة الزمنية التي يكون فيها الرمز صالحًا.';
$string['settings:gateway'] = 'بوابة الرسالة القصيرة';
$string['settings:gateway_help'] = 'مزود الرسائل القصيرة الذي ترغب بإرسالها عبره.';
$string['settings:heading'] = 'سيتلقى المستخدمون رسالة قصيرة تحتوي على رمز من 6 أرقام خلال تسجيل الدخول، وعليهم إدخاله لإكمال عملية الدخول. ينبغي على المستخدمين تسجيل أرقام جوالاتهم أولاً.';
$string['settings:setupdesc'] = 'لاستعمال الرسائل القصيرة كعامل مصادقة، عليك أولاً <a href="{$a}">تهيئة بوابة الرسائل القصيرة</a>.';
$string['settings:shortdescription'] = 'يتطلب من المستخدمين إدخال رمز يتلقونه عبر رسالة قصيرة.';
$string['settings:smsgateway'] = 'بوابة الرسالة القصيرة';
$string['settings:smsgateway_help'] = 'إختر إحدى البوابات من القائمة، أو <a href="{$a}">أنشئ بوابة جديدة</a>';
$string['setupfactor'] = 'تهيئة الرسالة القصيرة';
$string['setupfactorbutton'] = 'تهيئة الرسالة القصيرة';
$string['setupsubmitcode'] = 'حفظ';
$string['setupsubmitphone'] = 'إرسال الرمز';
$string['smsstring'] = '{$a->code} هو رمز الأمان {$a->fullname} المستعمل لمرة واحدة.

@{$a->url} #{$a->code}';
$string['summarycondition'] = 'استعمال رمز أمان لمرة واحدة عبر رسالة قصيرة';
