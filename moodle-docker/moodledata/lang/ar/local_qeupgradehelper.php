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
 * Strings for component 'local_qeupgradehelper', language 'ar', version '5.1'.
 *
 * @package     local_qeupgradehelper
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'الإجراء';
$string['alreadydone'] = 'تم تحويل كل شيء مسبقاً';
$string['areyousure'] = 'هل أنت متأكد؟';
$string['areyousuremessage'] = 'هل ترغب بالاستمرار وترقية كل المحاولات {$a->numtoconvert} في الاختبار \'{$a->name}\' في المساق {$a->shortname}?';
$string['areyousureresetmessage'] = 'الاختبار \'{$a->name}\' في المساق {$a->shortname} فيه {$a->totalattempts} محاولة، منها {$a->convertedattempts} تمت ترقيتها من النظام القديم. من تلك المحاولات، {$a->resettableattempts} يمكن إعادة تعيينها من أجل معاودة تحويلها. هل ترغب بالاستمرار في ذلك؟';
$string['attemptstoconvert'] = 'المحاولات التي بحاجة إلى تحويل';
$string['backtoindex'] = 'عودة إلى الصفحة الرئيسية';
$string['conversioncomplete'] = 'إكتمل التحويل';
$string['convertattempts'] = 'قم بتحويل المحاولات';
$string['convertedattempts'] = 'المحاولات المحولة';
$string['convertquiz'] = 'حوِّل المحاولات...';
$string['cronenabled'] = 'تم تمكين مشغل الوظائف الدورية';
$string['croninstructions'] = 'يمكنك تمكين مشغل الوظائف الدورية لإكمال الترقية تلقائياً بعد إجرائها على نطاق جزئي. مشغل الوظائف الدورية سيعمل بين ساعات محددة في اليوم (وفقاً لتوقيت المخدم المحلي). عند كل تشغيل سيعالج مشغل الوظائف الدورية عدداً من المحاولات حتى استنفاذه لمهلة تشغيل المهمة، ثم سيتوقف وينتظر موعد التشغيل القادم. حتى وإن كنت أعددت مشغل الوظائف الدورية، فلن يقوم بأي شيء ما لم يجد أن الترقية الأساسية إلى الإصدار 2.1 قد اكتملت.';
$string['cronprocesingtime'] = 'فترة المعالجة عند كل تشغيل لمشغل الوظائف الدورية';
$string['cronsetup'] = 'تهيئة مشغل الوظائف الدورية';
$string['cronsetup_desc'] = 'يمكنك تهيئة مشغل الوظائف الدورية لإكمال ترقية بيانات محاولات الاختبار تلقائياً.';
$string['cronstarthour'] = 'ساعة البدء';
$string['cronstophour'] = 'ساعة الانتهاء';
$string['extracttestcase'] = 'استخرج حقيبة الفحص';
$string['extracttestcase_desc'] = 'استعمل بيانات كنموذج من قاعدة البيانات للمساعدة في إنشاء وحدات فحص من أجل فحص الترقية.';
$string['gotoindex'] = 'عودة إلى قائمة الاختبارات التي يمكن ترقيتها';
$string['gotoquizreport'] = 'إذهب إلى تقارير هذا الاختبار للتحقق من الترقية';
$string['gotoresetlink'] = 'إذهب إلى قائمة الاختبارات التي يمكن إعادة تعيينها';
$string['includedintheupgrade'] = 'مضمنة في الترقية؟';
$string['invalidquizid'] = 'مُعرَّف اختبار غير صحيح. إما أن الاختبار غير موجود، أو ليس فيه محاولات لتحويلها.';
$string['listpreupgrade'] = 'أدرج الاختبارات والمحاولات';
$string['listpreupgrade_desc'] = 'هذا سيعرض كل الاختبارات في النظام وعدد المحاولات لكل منها. هذا سيعطيك فكرة عن حجم الترقية التي أنت بصددها.';
$string['listpreupgradeintro'] = 'هذه أعداد محاولات الاختبارات التي عليك معالجتها عند ترقية موقعك. بضعة عشرات من الألوف ليست أمراً يدعو للقلق. أكثر من ذلك قد يجعلك تتفهم مدة الوقت التي قد تستغرقها الترقية.';
$string['listtodo'] = 'أدرج الاختبارات التي تنتظر الترقية';
$string['listtodo_desc'] = 'هذا سيعرض تقريراً بكل الاختبارات في النظام (إن وجدت) والتي لديها محاولات لا تزال بحاجة إلى ترقية إلى محرك الأسئلة الجديد.';
$string['listtodointro'] = 'هذه كل الاختبارات مع بيانات المحاولات والتي لا تزال بحاجة إلى تحويل. يمكنك تحويل المحاولات عبر النقر على الرابط.';
$string['listupgraded'] = 'أدرج الاختبارات التي سبقت ترقيتها والتي يمكن إعادة تعيينها';
$string['listupgraded_desc'] = 'هذا سيظهر تقريراً عن كل الاختبارات في النظام والتي لديها محاولات تمت ترقيتها، مع البيانات القديمة التي لا تزال حاضرة بحيث أن الترقية يمكن إعادتها مجدداً.';
$string['listupgradedintro'] = 'هذه تمثل كل الاختبارات التي لديها محاولات تمت ترقيتها، مع مواضع تواجد البيانات القديمة من أجل إعادة تعيينها وبالتالي إعادة تشغيل الترقية.';
$string['noquizattempts'] = 'موقعك ليس فيه محاولات اختبارات على الإطلاق!';
$string['nothingupgradedyet'] = 'لا محاولات مرقاة يمكن إعادة تعيينها';
$string['notupgradedsiterequired'] = 'هذا النص البرمجي يمكنه العمل فقط قبل إجراء الترقية للموقع.';
$string['numberofattempts'] = 'عدد محاولات الاختبار';
$string['oldsitedetected'] = 'يبدو أن هذا الموقع لم تتم ترقيته بعد ليتضمن محرك الأسئلة الجديد.';
$string['outof'] = '{$a->some} من {$a->total}';
$string['pluginname'] = 'مساعد ترقية محرك الأسئلة';
$string['pretendupgrade'] = 'قم بتشغيل تجريبي لترقية المحاولات';
$string['pretendupgrade_desc'] = 'الترقية تقوم بثلاثة أمور: تحميل البيانات الموجودة من قاعدة البيانات؛ تحويلها؛ ثم إعادة كتابة البيانات المحولة إلى قاعدة البيانات. هذا النص البرمجي سيقوم بفحص المرحلتين الأولتين من هذه العملية.';
$string['questionsessions'] = 'جلسات الاختبار';
$string['quizid'] = 'مُعرَّف الاختبار';
$string['quizupgrade'] = 'حالة ترقية الاختبار';
$string['quizzesthatcanbereset'] = 'الاختبارات الآتية لديها محاولات محولة يمكن لك إعادة تعيينها';
$string['quizzestobeupgraded'] = 'كل الاختبارات ذات المحاولات';
$string['quizzeswithunconverted'] = 'الاختبارات الآتية لديها محاولات بحاجة إلى تحويل';
$string['resetcomplete'] = 'إعادة التعيين إكتملت';
$string['resetquiz'] = 'أعد تعيين المحاولات...';
$string['resettingquizattempts'] = 'تجري إعادة تعيين محاولات الاختبار';
$string['resettingquizattemptsprogress'] = 'إعادة تعيين المحاولة {$a->done} / {$a->outof}';
$string['upgradedsitedetected'] = 'يبدو أن هذا الموقع قد تمت ترقيته ليتضمن محرك الأسئلة الجديد.';
$string['upgradedsiterequired'] = 'يمكن لهذا النص البرمجي أن يعمل فقط بعد ترقية الموقع.';
$string['upgradingquizattempts'] = 'ترقية المحاولات للاختبار \'{$a->name}\' في المساق {$a->shortname}';
$string['veryoldattemtps'] = 'موقعك فيه {$a} محاولات اختبارات لم يسبق أبداً تحديثها خلال الترقية من مودل 1.4 إلى مودل 1.5. سيتم التعامل مع تلك المحاولات قبل الترقية الرئيسية. عليك الأخذ بنظر الاعتبار الوقت الإضافي الذي تتطلبه هذه العملية.';
