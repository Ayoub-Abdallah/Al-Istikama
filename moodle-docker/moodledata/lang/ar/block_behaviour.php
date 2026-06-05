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
 * Strings for component 'block_behaviour', language 'ar', version '5.1'.
 *
 * @package     block_behaviour
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['adminheadershownames'] = 'إظهار الأسماء أو الأرقام التسلسلية للطلاب';
$string['behaviour'] = 'تحليل السلوك';
$string['behaviour:addinstance'] = 'إضافة كتلة جديدة من تحليل السلوك';
$string['behaviour:myaddinstance'] = 'إضافة كتلة جديدة من تحليل السلوك إلى صفحة مودل الخاصة بي';
$string['behaviour:view'] = 'معاينة تحليل السلوك';
$string['deluserdesc'] = 'يَحذف كل بيانات سجل الوقوعات لطلاب هذا المقرر. تلك السجلات هي تكرار لوقوعات مودل التي استخرجتها تحليلات السلوك. لن تُحذف أي بيانات من سجلات وقوعات مودل.';
$string['docsdescription'] = 'تحليلات السلوك هي عبارة عن الإضافة كتلة في مودل يهدف إلى استخراج أنماط السلوك المتتابع للطلاب من سجلات الوصول إلى المقرر. يعتبر تحليل السلوك كل الأنشطة الموجودة في صفحة المقرر كعقد في الرسم البياني. الروابط بين العقد هي وصول الطلاب إلى تلك الأنشطة. كل طالب لديه نقطة وسطية مستمدة من وصوله إلى الأنشطة وإحداثيات العقد. يمكن وضع النقط الوسطى للطلاب في عُقد لتجميع الطلاب والعثور على أنماط وصول مشتركة. يمكن وضع العقد في الرسم البياني يدويًا و/أو إزالتها من الرسم البياني، مما سيؤثر على النقاط الوسطى للطالب. عندما يقوم الطلاب بإنشاء بيانات جديدة للنظام، يتم تحديث نتائج التجميع ويمكن إعادة تشغيلها للتحقق بصريًا من بقاء التجميع صحيحًا بعد إضافة البيانات الجديدة. يمكن تغيير المجموعات غير الصحيحة يدويًا. الإضافة مخصص ليستعمله المعلم ولن يراه الطلاب.';
$string['docslord1'] = 'أولاً ، ينبغي تنصيب إضافة LORD في مودل. بعد ذلك، هناك خيار للمشرف للسماح بالتكامل. عند تمكين خيار الشرف، سيظهر رابط إضافي في الكتلة لتهيئة التكامل. هناك إعدادان متاحان من داخل الكتلة. الأول يجعل تحليلات السلوك تستعمل أحدث رسم بياني تم إنشاؤه في إضافة LORD. أما الثاني فيقوم بالتبديل ما بين استعمال الرسم البياني الذي أنشأه النظام والرسم البياني الذي يتلاعب به المستخدم. إذا لم يكن هناك رسم بياني متاح للاستعمال من قبل LORD، فسيتم استعمال الرسم البياني المصنوع من تحليلات السلوك بدلاً من ذلك. إذا تمت إزالة الأنشطة من المساق أو إضافتها إليها منذ إنشاء الرسم البياني من LORD آخر مرة، فستكون هناك حاجة لإنشاء الرسم البياني مرة أخرى قبل الاستعمال.';
$string['docslord2'] = 'عند استعمال الرسم البياني الذي أنشأه LORD، من الممكن معالجة العقد باستعمال ميزة "تهيئة عُقد الموارد". سيظهر الرسم البياني مختلفًا بعض الشيء ، حيث سيحتوي على عقد تجميع مع الروابط المرتبطة بها. إذا تم التلاعب بمخطط LORD ضمن تحليلات السلوك، فسيتوقف عن كونه رسم بياني من LORD. هذا يعني أنه يجب إيقاف تشغيل تكامل LORD لاستعمال الرسم البياني الذي تم التلاعب به حديثًا. سيحتوي هذا الرسم البياني على جميع العقد في المواضع الصحيحة، لكن الروابط ستظهر بشكل مختلف، حيث لن تكون هناك روابط بين العقد.';
$string['docssettings'] = 'يحتوي الإضافة على بعض الإعدادات العامة التي تؤثر على ما يراه المستخدم عند استعمال البرنامج. هناك خيار للسماح للطلاب برؤية معرفات الدراسة الخاصة بهم وإظهار أسماء الطلاب في قائمة الرسوم البيانية بدلاً من الأرقام المتسلسلة. إذا تم تثبيت إضافة LORD، فهناك خيار للسماح بالتكامل معه. توفر الإعدادات أيضًا خيار منح أو إبطال دور الباحث لأي مستخدم غير طالب مسجل في مقرر دراسي تم تنصيب فيه. يسمح دور الباحث للمستخدم بمشاهدة تكوينات الرسم البياني الحالية ونتائج التجميع للمستخدمين الآخرين في ذلك المساق. يمكن للباحث فقط رؤية بيانات المستخدمين الآخرين، ولا يمكنهم تغييرها. يمكن الوصول إلى الإعدادات بصفة مشرف من إدارة الموقع -> نظرة عامة على الإضافات، ثم البحث عن "تحليلات السلوك" والنقر على رابط الإعدادات المرتبطة.';
$string['docstask'] = 'للكتلة مهمة مجدولة مُعَدَّة إفتراضيًا للعمل كل يوم. يمكن تغيير تواتر تشغيل المهمة عبر الذهاب إلى إدارة الموقع > المخدم -> المهام المجدولة، ثم النقر على أيقونة الإعدادات لـ "تحديث سلوك التحليلات."';
$string['docswhatis'] = 'ما هي تحليلات السلوك؟';
$string['eventbehaviourexported'] = 'ملف وقوعات تحليلات السلوك تم تصديره';
$string['eventbehaviourimported'] = 'ملف وقوعات تحليلات السلوك تم استيراده';
$string['eventbehaviourviewed'] = 'إحصائيات سلوك تمت معاينتها';
$string['exportcliout'] = 'تصدير سجلات الوقوعات إلى {$a}';
$string['exportlogprefix'] = 'logs_';
$string['exportlogs'] = 'تصدير سجلات وقوعات الطلبة';
$string['importbutlabel'] = 'استيراد';
$string['importlogs'] = 'استيراد سجلات وقوعات الطلبة';
$string['invalidcourse'] = 'رقم مُعرَّف المقرر {$a} غير صحيح. المقرر غير موجود.';
$string['pluginname'] = 'تحليلات السلوك';
$string['print'] = 'طباعة';
$string['privacy:metadata:block_behaviour:centroidx'] = 'قيمة إحداثي x الوسطي';
$string['privacy:metadata:block_behaviour:centroidy'] = 'قيمة إحداثي y الوسطي';
$string['privacy:metadata:block_behaviour:changed'] = 'قيمة آخر وقت انتقلت فيه عقدة المخطط هذه';
$string['privacy:metadata:block_behaviour:time'] = 'القيمة التي تمثل الوقت الذي تم فيه إنشاء هذا التسجيل، والتي تستعمل فقط لغرض الفرز.';
$string['privacy:metadata:block_behaviour:totalx'] = 'قيمة إحداثي x المُجَمَّعة';
$string['privacy:metadata:block_behaviour:totaly'] = 'قيمة إحداثي y المُجَمَّعة';
$string['privacy:metadata:block_behaviour:xcoord'] = 'قيمة إحداثي x لعقدة الرسم البياني';
$string['privacy:metadata:block_behaviour:ycoord'] = 'قيمة إحداثي y لعقدة الرسم البياني';
$string['shownameslabel'] = 'أتريد إظهار أسماء الطلاب؟';
$string['title'] = 'تحليلات السلوك';
$string['update'] = 'تحديث تحليلات السلوك';
$string['viewed'] = 'المستخدم ذي المُعرَّف \'{$a->uid}\' شاهد تحليلات السلوك للمساق ذي المُعرَّف \'{$a->cid}\'.';
$string['wrongfile'] = 'اسم المقرر ليس في اسم الملف، هل حصلت على الملف الصحيح؟';
