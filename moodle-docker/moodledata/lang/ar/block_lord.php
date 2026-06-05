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
 * Strings for component 'block_lord', language 'ar', version '5.1'.
 *
 * @package     block_lord
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['docs:whatis:desc1'] = 'تم تصميم إضافة Learning Object Relation Discovery (LORD) لاكتشاف العلاقات بين مكونات التعلم. يتم ذلك عن طريق استخراج المحتوى النصي لكل وحدة تعليمية في المقرر أولاً. ثم يتم تقسيم محتوى النص إلى جمل بحيث يمكن مقارنة كل جملة مع أقرانها. يتم إجراء المقارنة باستعمال خدمة الويب (https://ws-nlp.vipresearch.ca/) المصممة لهذا الغرض. تعتمد خدمة الويب على WordNet (https://wordnet.princeton.edu/) لتحديد التشابه بين الكلمات في الجمل، وعلى هذا النحو، يقتصر استعمال الإضافة حاليًا على اللغة الإنجليزية. يتم تعيين قيمة تشابه نهائية بين كل زوج من مكونات التعلم، والتي تُستعمل بعد ذلك كمقياس للمسافة بين العقد في الرسم البياني للشبكة، حيث تمثل عقد الرسم البياني وحدات التعلم. تم تصميم هذه العملية لإنشاء تكوين رسم بياني حيث يتم تجميع العقد المماثلة معًا. يمكن بعد ذلك استعمال الرسم البياني الذي تم إنشاؤه مع إضافة تحليلات السلوك، والذي يستعمل نفس الرسم البياني لشبكة مكون التعلم لتحليل تفاعل الطالب مع مادة المقرر.';
$string['formerror'] = 'القيمة ينبغي أن تكون رقمًا صحيحًا موجبًا.';
$string['formerror2'] = 'القيمة ينبغي أن تكون رقمًا من مرتبة، مرتبتين أو ثلاث مراتب (1، 2.5، 12، 1.75).';
$string['formerror3'] = 'القيمة ينبغي أن تتضمن حروفًا فقط، بلا أرقام أو رموز.';
$string['name'] = 'الاسم';
$string['names'] = 'الأسماء';
$string['optimalassign'] = 'الواجب المثالي';
$string['privacy:metadata:block_lord:coordsid'] = 'قيمة مُعرَّف تهيئة الرسم البياني';
$string['privacy:metadata:block_lord:courseid'] = 'قيمة مُعرَّف المساق';
$string['privacy:metadata:block_lord:distscale'] = 'المقدار الذي تُضرب به قيمة التشابه للحصول على قيمة المسافة';
$string['privacy:metadata:block_lord:maxdist'] = 'القيمة العظمى للمسافة المستعملة في توليد الرسم البياني';
$string['privacy:metadata:block_lord:mindist'] = 'القيمة الصغرى للمسافة المستعملة في توليد الرسم البياني';
$string['privacy:metadata:block_lord:module'] = 'قيمة مُعرَّف الوحدة';
$string['privacy:metadata:block_lord:module1'] = 'قيمة مُعرَّف الوحدة للوحدة الأولى في المقارنة';
$string['privacy:metadata:block_lord:module2'] = 'قيمة مُعرَّف الوحدة للوحدة الثانية في المقارنة';
$string['privacy:metadata:block_lord:moduleid'] = 'قيمة مُعرَّف الوحدة';
$string['privacy:metadata:block_lord:name'] = 'اسم الوحدة';
$string['privacy:metadata:block_lord:paragraph'] = 'قيمة مُعرَّف الرسم البياني';
$string['privacy:metadata:block_lord:scale'] = 'قيمة مقياس الرسم البياني';
$string['privacy:metadata:block_lord:value'] = 'قيمة التشابه بين مكونات التعلم';
$string['privacy:metadata:block_lord:weight'] = 'قيمة التشابه بين نشاطي تعلم اثنين';
$string['privacy:metadata:block_lord:xcoord'] = 'قيمة إحداثي x';
$string['privacy:metadata:block_lord:ycoord'] = 'قيمة إحداثي y';
$string['runphysics'] = 'أتريد السماح بالتغييرات؟';
