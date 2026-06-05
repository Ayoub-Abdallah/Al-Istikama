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
 * Strings for component 'factor_email', language 'ar', version '5.1'.
 *
 * @package     factor_email
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['email:accident'] = 'إذا لم تكن من طلب هذا البريد الالكتروني، أنقر \'استمر\' لتخطئة محاولة تسجيل الدخول.
إذا نقرت على هذا الرابط سهوًا، أنقر \'إلغاء\' ولن يتم اتخاذ أي إجراء.';
$string['email:browseragent'] = 'تفاصيل المستعرض لهذا الطلب هي: \'{$a}\'';
$string['email:geoinfo'] = 'يبدو أن هذا الطلب قد انطلق تقريبًا من:';
$string['email:greeting'] = 'مرحبًا {$a} 👋';
$string['email:ipinfo'] = 'تفاصيل إلتماس تسجيل الدخول:';
$string['email:link'] = 'رابط التحقق';
$string['email:loginlink'] = 'أو، إذا كنت عند نفس الجهاز، استعمل {$a} هذا.';
$string['email:message'] = 'إليك رمز التحقق الخاص بك في {$a->sitename} ({$a->siteurl}).';
$string['email:originatingip'] = 'تم تقديم إلتماس تسجيل الدخول هذا من \'{$a}\'';
$string['email:revokelink'] = 'إن لم يكن ذلك منك، فيمكنك {$a}.';
$string['email:revokesuccess'] = 'تم بنجاح سحب هذا الرمز. كل جلسات هذا المستخدم تم إنهاؤها.
لن يكون البريد الالكتروني مستعملاً بمثابة عامل حتى يتم التحقق من أمان الحساب.';
$string['email:stoploginlink'] = 'إيقاف محاولة الدخول هذه';
$string['email:subject'] = 'إليك رمز التحقق';
$string['email:uadescription'] = 'هوية المستعرض لهذا الطلب:';
$string['email:validity'] = 'يمكن استعمال هذا الرمز لمرة واحدة فقط وهو صالح لـ {$a}.';
$string['error:badcode'] = 'تعذر العثور على الرمز. قد يكون هذا رابطًا قديمًا، أو أن رمزًا أحدث قد تم إرساله بريديًا، أو أن محاولة الدخول بهذا الرمز كانت ناجحة.';
$string['error:parameters'] = 'معاملات الصفحة خاطئة.';
$string['error:wrongverification'] = 'رمز التحقق خاطئ. حاول مجددًا.';
$string['event:unauthemail'] = 'بريد الكتروني غير مرخص له تم تلقيه';
$string['info'] = 'أنت تستعمل البريد الالكتروني {$a} للمصادقة. لقد تم إعداد ذلك من قبل مشرف موقعك.';
$string['logindesc'] = 'لقد أرسلنا توًا رمزًا من ستة أرقام إلى بريدك الالكتروني: {$a}';
$string['loginoption'] = 'إحصل على رمز يذهب إلى بريدك';
$string['loginskip'] = 'لم أتلقَّ الرمز';
$string['loginsubmit'] = 'متابعة';
$string['logintitle'] = 'التحقق من أنه أنت عبر البريد الالكتروني';
$string['managefactor'] = 'إدارة البريد الالكتروني';
$string['manageinfo'] = 'يجري استعمال \'{$a}\' للمصادقة. لقد تم إعداد ذلك من قبل مشرف موقعك.';
$string['pluginname'] = 'البريد الالكتروني';
$string['privacy:metadata'] = 'إن ملحق عامل البريد الالكتروني لا يخزن أي بيانات شخصية.';
$string['settings:description'] = 'سيتلقى المستخدمون رقمًا من 6 مراتب عبر البريد الالكتروني، وعليهم إدخاله لإكمال عملية تسجيل الدخول.';
$string['settings:duration'] = 'فترة الصلاحية';
$string['settings:duration_help'] = 'المدة الزمنية التي يكون فيها الرمز صالحًا.';
$string['settings:shortdescription'] = 'يتطلب من المستخدمين إدخال رمز يتلقونه عبر البريد الالكتروني خلال عملية تسجيل الدخول.';
$string['settings:suspend'] = 'تعليق الحسابات غير المرخصة';
$string['settings:suspend_help'] = 'قم بتأشيره لتعليق حسابات المستخدمين إذا تم تلقي تحقق بريدي غير مرخص له.';
$string['setupfactor'] = 'تهيئة البريد الالكتروني';
$string['summarycondition'] = 'لديه تهيئة بريد الكتروني صالحة';
$string['unauthemail'] = 'بريد الكتروني غير مرخص';
$string['unauthloginattempt'] = 'قام المستخدم ذو المُعرَّف {$a->userid} بمحاولة تسجيل دخول غير مرخص لها مستعملاً التحقق عبر البريد الالكتروني من عنوان IP {$a->ip} باستعمال وكيل المستعرض {$a->useragent}.';
$string['verificationcode'] = 'أدخل رمز التحقق للتأكيد';
$string['verificationcode_help'] = 'رمز التحقق تم إرساله إلى عنوان بريدك الالكتروني.';
