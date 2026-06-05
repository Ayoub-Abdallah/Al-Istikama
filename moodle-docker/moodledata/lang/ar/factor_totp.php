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
 * Strings for component 'factor_totp', language 'ar', version '5.1'.
 *
 * @package     factor_totp
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action:manage'] = 'إدارة مُصادق كلمة المرور الواحدة المقيدة بوقت (TOTP)';
$string['action:revoke'] = 'إزالة مُصادق كلمة المرور الواحدة المقيدة بوقت (TOTP)';
$string['devicename'] = 'ملصق الجهاز';
$string['devicename_help'] = 'هذا هو الجهاز المنصب فيه برنامج المُصادقة. بإمكانك إعداد أجهزة متعددة لذلك فإن هذا الملصق يساعدك في تتبع أي منها يجري استعماله. ينبغي عليك إعداد كل جهاز بترميزه الخاص الفريد حتى تتمكن من سحب أي منها بشكل مستقل.';
$string['devicenameexample'] = 'مثلاً "جوال العمل نوكيا C7"';
$string['error:alreadyregistered'] = 'سر TOTP كلمة المرور الواحدة المقيدة بوقت سبق وأن تم تسجيله.';
$string['error:codealreadyused'] = 'لقد سبق وأن تم استعمال هذا الرمز للمصادقة. يرجى انتظار توليد رمز جديد، ثم أعد المحاولة.';
$string['error:futurecode'] = 'الرمز غير صحيح. يرجى التحقق من أن التوقيت في الجهاز المستعمل للمصادقة صحيح ثم حاول مجددًا.
التوقيت الحالي للنظام هو {$a}.';
$string['error:oldcode'] = 'الرمز قديم جدًا. يرجى التحقق من أن التوقيت في الجهاز المستعمل للمصادقة صحيح ثم حاول مجددًا.
التوقيت الحالي للنظام هو {$a}.';
$string['error:wrongverification'] = 'رمز التحقق خاطئ.';
$string['factorsetup'] = 'تهيئة التطبيق';
$string['info'] = 'توليد رمز التحقق باستعمال تطبيق مُصادق.';
$string['logindesc'] = 'استعمل تطبيق المصادقة في جوالك لتوليد الرمز.';
$string['loginoption'] = 'استعمال تطبيق المصادقة';
$string['loginskip'] = 'ليس عندي أي جهاز';
$string['loginsubmit'] = 'متابعة';
$string['logintitle'] = 'التحقق من أنه أنت عبر تطبيق الجوال';
$string['managefactor'] = 'إدارة تطبيق المصادقة';
$string['managefactorbutton'] = 'إدارة';
$string['manageinfo'] = 'أنت تستعمل \'{$a}\' للمصادقة.';
$string['pluginname'] = 'تطبيق المصادقة';
$string['privacy:metadata'] = 'إن ملحق عامل التطبيق المُصادِق لا يخزن أي بيانات شخصية.';
$string['replacefactor'] = 'استبدال تطبيق المصادقة';
$string['replacefactorconfirmation'] = 'أتريد استبدال تطبيق المصادقة \'{$a}\'؟';
$string['revokefactorconfirmation'] = 'أتريد إزالة تطبيق المصادقة \'{$a}\'؟';
$string['settings:description'] = 'سيحتاج المستخدمون إلى تنصيب تطبيق مصادقة في جوالاتهم لتوليد الرمز، والذي عليهم إدخاله خلال عملية تسجيل الدخول.';
$string['settings:shortdescription'] = 'مطالبة المستخدمين بإدخال رمز من تطبيق مصادقة منصب في أجهزتهم خلال تسجيل الدخول.';
$string['settings:totplink'] = 'إظهار رابط تهيئة تطبيق الجوال';
$string['settings:totplink_help'] = 'عند تمكينه، سيشاهد المستخدم خيار تهيئة ثالث مع رابط otpauth:// مباشر';
$string['settings:window'] = 'نافذة مصادقة TOTP';
$string['settings:window_help'] = 'فسحة الوقت التي تعمل فيها كلمة المرور الواحدة المقيدة بوقت TOTP بمثابة المجال الزمني الذي يكون فيه رمز الدخول صالحًا، وهو الوقت ما بين كل توليد للرموز الجديدة،
عادة 30 ثانية.
إذا كانت الفسحة 15 (الوضع الافتراضي) وبصمة الزمن الحالي هي 147682209، يتم اختبار كلمة المرور OTP خلال الفترة ما بين 147682194 (147682209 - 15)، 147682209 و 147682224 (147682209 + 15).
الفسحة ستكون أقل من 30. لذلك هذا الفحص يتضمن كلمة المرور للمرة الواحدة السابقة وليس اللاحقة.
بإمكانك ضبطها على قيمة أعلى (حتى 29) بمثابة حل بديل إذا كانت أجهزة مستخدميك ذات توقيتات غالبًا ما تكون خاطئة.';
$string['setupfactor'] = 'تهيئة تطبيق المصادق';
$string['setupfactor:account'] = 'الحساب:';
$string['setupfactor:devicename'] = 'اسم الجهاز';
$string['setupfactor:devicenameinfo'] = 'هذا يساعدك في التعرف على أي من الأجهزة يتلقى رمز التحقق.';
$string['setupfactor:enter'] = 'أدخل التفاصيل يدويًا';
$string['setupfactor:instructionsdevicename'] = '1. أعط جهازك اسمًا.';
$string['setupfactor:instructionsscan'] = 'إمسح رمز الاستجابة السريعة بطبيق المصادقة الخاص بك.';
$string['setupfactor:instructionsverification'] = 'أدخل رمز التحقق.';
$string['setupfactor:intro'] = 'لتهيئة هذه الطريقة، تحتاج أن يكون لديك جهاز فيه تطبيق مصادقة. إذا لم يكن لديك التطبيق، يمكنك تنزيل أحدها. مثلاً، <a href="https://2fas.com/" target="_blank">2FAS Auth</a>، <a href="https://freeotp.github.io/" target="_blank">FreeOTP</a>، مُصادق Google، مُصادق مايكروسوفت أو Twilio Authy.';
$string['setupfactor:key'] = 'مفتاح السر:';
$string['setupfactor:link'] = 'أو أدخل التفاصيل يدويًا.';
$string['setupfactor:link_help'] = 'إذا كنت تعمل من جهازك الجوال ولديك مسبقًا تطبيق مصادقة منصب، فهذا الرابط قد يعمل عندك. لاحظ بأن استعمال TOTP في نفس الجهاز الذي تقوم بتسجيل الدخول منه قد يضعف من فوائد المصادقة متعددة العوامل.';
$string['setupfactor:linklabel'] = 'إفتح التطبيق المنصب مسبقًا في هذا الجهاز';
$string['setupfactor:mode'] = 'الوضع:';
$string['setupfactor:mode:timebased'] = 'مبني على الوقت';
$string['setupfactor:scanwithapp'] = 'إمسح رمز الاستجابة السريعة بتطبيق المصادقة الذي تختاره.';
$string['setupfactor:verificationcode'] = 'رمز التحقق';
$string['setupfactorbutton'] = 'التهيئة';
$string['summarycondition'] = 'باستعمال تطبيق TOTP';
$string['systimeformat'] = '%l:%M:%S %P %Z';
$string['verificationcode'] = 'أدخل رمز التحقق الخاص بك الذي من 6 أرقام';
$string['verificationcode_help'] = 'إفتح تطبيقك للمصادقة، كأن يكون مُصادِق Google وتحرَّ وجود الرمز الذي من 6 أرقام والذي يطابق هذا الموقع واسم المستخدم';
