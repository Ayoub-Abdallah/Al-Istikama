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
 * Strings for component 'factor_webauthn', language 'ar', version '5.1'.
 *
 * @package     factor_webauthn
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action:manage'] = 'إدارة مفتاح الأمان';
$string['action:revoke'] = 'إزالة مفتاح الأمان';
$string['authenticator:ble'] = 'BLE';
$string['authenticator:hybrid'] = 'مهجن';
$string['authenticator:internal'] = 'داخلي';
$string['authenticator:nfc'] = 'NFC';
$string['authenticator:usb'] = 'USB';
$string['authenticatorname'] = 'اسم مفتاح الأمان';
$string['error'] = 'فشلت المصادقة';
$string['error:alreadyregistered'] = 'سر مفتاح الأمان هذا سبق وأن تم تسجيله.';
$string['info'] = 'استعمال مفتاح أمان خارجي أو ماسح بصمات الأصابع.';
$string['logindesc'] = 'أنقر على المتابعة لاستعمال مفتاح الأمان.';
$string['loginoption'] = 'استعمل مفتاح أمانك';
$string['loginskip'] = 'ليس معي مفتاحي للأمان';
$string['loginsubmit'] = 'متابعة';
$string['logintitle'] = 'التحقق من أنه أنت عبر مفتاح الأمان';
$string['managefactor'] = 'إدارة مفتاح الأمان';
$string['managefactorbutton'] = 'إدارة';
$string['manageinfo'] = '\'{$a}\'';
$string['pluginname'] = 'مفتاح الأمان';
$string['privacy:metadata'] = 'إن ملحق عامل مصادقة مفتاح الأمان لا يخزن أي بيانات شخصية.';
$string['register'] = 'تسجيل مفتاح الأمان';
$string['registererror'] = 'تعذر تسجيل مفتاح الأمان: {$a}';
$string['registersuccess'] = 'مفتاح الأمان مسجل.';
$string['replacefactor'] = 'استبدال مفتاح الأمان';
$string['replacefactorconfirmation'] = 'أتريد استبدال مفتاح الأمان \'{$a}\'؟';
$string['revokefactorconfirmation'] = 'أتريد إزالة مفتاح الأمان \'{$a}\'؟';
$string['settings:authenticatortypes'] = 'أنواع المصادق';
$string['settings:authenticatortypes_help'] = 'تبديل بعض أنواع المصادقات';
$string['settings:description'] = '<p>يقوم المستخدمون بالمصادقة باستعمال مفتاح أمان ملموس، مثل عصى ذاكرة أو مخزن بيانات شخصي مرمز، أو بوسيلة بايومترية، مثل بصمة الإصبع. خلال عملية تسجيل الدخول، عليهم استعمال مفتاح الأمان هذا للتحقق من هوياتهم.</p>
<p>ينبغي على المستخدمين تهيئة مفاتيح الأمان الخاصة بهم أولاً.</p>';
$string['settings:shortdescription'] = 'مطابة المستخدمين باستعمال مفتاح أمان ملموس، مثل عصى ذاكرة أو مخزن بيانات شخصي مرمز، أو وسيلة بايومترية خلال عملية تسجيل الدخول.';
$string['settings:userverification'] = 'التحقق بالمستخدم';
$string['settings:userverification_help'] = 'يخدم غرض التأكد من كون المستخدم الذي يقوم بالمصادقة هو في الواقع من يدعي. التحقق من المستخدمين يمكنه أن يتخذ أشكال متعددة، مثل كلمة المرور، مَعرَّف الرقم الشخصي، بصمة الإصبع، إلخ.';
$string['setupfactor'] = 'تهيئة مفتاح الأمان';
$string['setupfactor:instructionsregistersecuritykey'] = '2. تسجيل مفتاح الأمان';
$string['setupfactor:instructionssecuritykeyname'] = '1. أعط مفتاحك اسمًا';
$string['setupfactor:intro'] = 'مفتاح الأمان هو جهاز خارجي يمكنك استعماله للمصادقة على نفسك. مفاتيح الأمان يمكنها أن تكون ترميزات USB، أجهزة بلوتوث أو ماسحات بصمات الأصابع المحفزة بالأحداث في جوالك أو حاسبتك';
$string['setupfactor:securitykeyinfo'] = 'هذا يساعدك في التعرف على أي من مفاتيح الأمان أنت تستعمل.';
$string['setupfactorbutton'] = 'التهيئة';
$string['setupfactorbuttonadditional'] = 'إضافة مفتاح الأمان';
$string['summarycondition'] = 'استعمال مصادق مدعوم من WebAuthn';
$string['userverification:discouraged'] = 'لا ينبغي توظيف التحقق بالمستخدم على سبيل المثال، للتقليل من التفاعل ما بين المستخدمين';
$string['userverification:preferred'] = 'التحقق بالمستخدم هو المفضل. لن تفشل المصادقة عند غياب التحقق بالمستخدم';
$string['userverification:required'] = 'التحقق بالمستخدم مطلوب حتمًا (مثلاً عبر رقم التعريف الشخصي pin). ستفشل المصادقة إذا لم يكن للمفتاح تحقق بالمستخدم';
