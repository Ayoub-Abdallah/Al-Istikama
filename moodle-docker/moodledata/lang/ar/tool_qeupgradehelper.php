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
 * Strings for component 'tool_qeupgradehelper', language 'ar', version '5.1'.
 *
 * @package     tool_qeupgradehelper
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'الإجراء';
$string['alreadydone'] = 'لقد تم تحويل كل شيء';
$string['areyousure'] = 'هل أنت متأكد؟';
$string['areyousuremessage'] = 'هل ترغب بمتابعة الترقية لكل المحاولات {$a->numtoconvert} للاختبار \'{$a->name}\' في المساق {$a->shortname}؟';
$string['attemptstoconvert'] = 'المحاولات التي بحاجة إلى تحويل';
$string['backtoindex'] = 'عودة إلى الصفحة الرئيسية';
$string['conversioncomplete'] = 'إكتمل التحويل';
$string['convertattempts'] = 'قم بتحويل المحاولات';
$string['convertedattempts'] = 'المحاولات المحولة';
$string['convertquiz'] = 'قم بتحويل المحاولات...';
$string['cronenabled'] = 'تم تمكين مشغل الوظائف المجدولة';
$string['cronprocesingtime'] = 'وقت تشغيل المعالجة لكل جولة من جولات مشغل الوظائف المجدولة';
$string['cronsetup'] = 'تهيئة مشغل الوظائف المجدولة';
$string['cronsetup_desc'] = 'يمكنك تهيئة مشغل الوظائف المجدولة ليقوم بإكمال تحويل بيانات محاولات الاختبار تلقائياً.';
$string['cronstarthour'] = 'ساعة البدء';
$string['cronstophour'] = 'ساعة التوقف';
$string['gotoindex'] = 'عودة إلى قائمة الاختبارات التي يمكن ترقيتها';
$string['gotoquizreport'] = 'إذهب إلى تقارير الاختبار للتحقق من الترقية';
$string['gotoresetlink'] = 'إذهب إلى قائمة الاختبارات التي يمكن إعادة تعيينها';
$string['includedintheupgrade'] = 'هل تريد تضمينها في الترقية؟';
$string['invalidquizid'] = 'مُعرَّف الاختبار غير صحيح. إما أن الاختبار غير موجود، أو ليس فيه محاولات لتحويلها.';
$string['listpreupgrade'] = 'أدرج الاختبارات ومحاولاتها';
$string['listpreupgradeintro'] = 'تلك هي عدد محاولات الاختبارات التي ستحتاج إلى معالجة عندما تقوم بترقية موقعك. بضعة عشرات الآلاف ليست بالأمر الذي يدعو إلى القلق. أما الأكثر من ذلك بكثير، سيدفعك إلى النظر في طول المدة التي تستغرقها عملية الترقية.';
$string['listtodo'] = 'أدرج الاختبارات الباقية للترقية';
$string['listupgraded'] = 'أدرج الاختبارات التي سبق تحويلها والتي يمكن إعادة تعيينها';
$string['noquizattempts'] = 'موقعك ليست فيه محاولات للاختبارات على الإطلاق!';
$string['nothingupgradedyet'] = 'لا توجد محاولات مرقاة يمكن إعادة تعيينها';
$string['notupgradedsiterequired'] = 'يمكن لهذا النص البرمجي العمل فقط قبل ترقية الموقع.';
$string['numberofattempts'] = 'عدد محاولات الاختبار';
$string['outof'] = '{$a->some} من {$a->total}';
$string['pluginname'] = 'مساعد ترقية محرك الأسئلة';
$string['pretendupgrade'] = 'قم بتشغيل تجريبي لترقية المحاولات';
$string['questionsessions'] = 'جولات السؤال';
$string['quizid'] = 'مُعرَّف الاختبار';
$string['quizupgrade'] = 'حالة ترقية الاختبار';
$string['quizzestobeupgraded'] = 'كل الاختبارات ذات المحاولات';
$string['quizzeswithunconverted'] = 'الاختبارات الآتية فيها محاولات بحاجة إلى تحويل';
$string['resetcomplete'] = 'إعادة التعيين إكتملت';
$string['resetquiz'] = 'أعد تعيين المحاولات...';
$string['resettingquizattempts'] = 'تجري إعادة تعيين محاولات الاختبار';
$string['resettingquizattemptsprogress'] = 'إعادة تعيين المحاولة {$a->done} / {$a->outof}';
$string['upgradedsiterequired'] = 'يمكن لهذا النص البرمجي العمل فقط بعد ترقية الموقع.';
$string['upgradingquizattempts'] = 'تجري ترقية المحاولات للاختبار \'{$a->name}\' في المساق {$a->shortname}';
$string['veryoldattemtps'] = 'في موقعك {$a} من محاولات الاختبارات التي لم يتم تحديثها على الإطلاق بشكل كامل خلال الترقية من مودل 1.4 إلى مودل 1.5. سيتم التعامل مع تلك المحاولات قبل إجراء الترقية الرئيسية. عليك أن تأخذ بنظر الاعتبار الوقت الإضافي الذي تتطلبه هذه العملية.';
