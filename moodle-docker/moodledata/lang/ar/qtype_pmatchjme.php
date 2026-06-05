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
 * Strings for component 'qtype_pmatchjme', language 'ar', version '5.1'.
 *
 * @package     qtype_pmatchjme
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowanothertry'] = 'السماح بمحاولة أخرى';
$string['answeringoptions'] = 'خيارات المحرر الجزيئي';
$string['atomcount'] = 'إفادة عدد Atom';
$string['autoez'] = 'التوليد التلقائي لـ SMILES باستخدام الكيمياء الفراغية E,Z ("autoez")';
$string['enablejavascript'] = '<p>يجري تحميل المحرر الجزيئي...</p><p>إذا لم يتم استبدال هذه الرسالة بواسطة المحرر الجزيئي، فهذا يعني أن جافا سكريبت لا يعمل في متصفحك.</p>';
$string['firstcorrectanswermustbestraightmatch'] = 'ينبغي أن تكون الإجابة الصحيحة الأولى مطابقة مباشرة لسلسلة SMILES بدون أحرف بديلة مثل match(SMILESEXPRESSION).';
$string['firstcorrectanswermustnotrequireatomcountfeedback'] = 'أول إجابة صحيحة لا يمكن أن تتطلب إفادة عدد الذرات';
$string['nostereo'] = 'لم يتم أخذ الكيمياء الفراغية بنظر الاعتبار عند إنشاء SMILES ("nostereo")';
$string['pluginname'] = 'مطابقة النمط مع محرر الجزيئات';
$string['pluginname_help'] = 'للإجابة على سؤال (قد يتضمن صورة)، يستعمل المُجيب مُحرر الجزيئات لوصف بنية جزيئية. قد تكون هناك عدة إجابات صحيحة محتملة، ولكل منها درجة مختلفة.';
$string['pluginname_link'] = 'question/type/pmatchjme';
$string['pluginnameadding'] = 'إضافة سؤال مطابقة النمط مع محرر الجزيئات';
$string['pluginnameediting'] = 'تحرير سؤال مطابقة النمط مع محرر الجزيئات';
$string['pluginnamesummary'] = 'يسمح برسم جزيء باستعمال محرر الجزيئات. تُقيّم الإجابة بمقارنتها بإجابات نموذجية مختلفة، والتي تُوصف باستعمال صيغة مطابقة النمط في OU.';
$string['privacy:metadata'] = 'إن الملحق محرر نوع السؤال مطابقة النمط يسمح لمؤلفي السؤال بوضع خيارات إفتراضية كتفضيلات للمستخدم.';
$string['privacy:preference:allowsubscript'] = 'ما إذا كان النص السفلي مستعمل لإدخال الجواب';
$string['privacy:preference:allowsuperscript'] = 'ما إذا كان النص العلوي مستعمل لإدخال الجواب';
$string['privacy:preference:defaultmark'] = 'العلامة الافتراضية المعدة لسؤال معين';
$string['privacy:preference:penalty'] = 'الغرامة لكل محاولة فاشلة عند تشغيل الأسئلة بسلوك \'تفاعلي ذي محاولات متعددة\' أو \'الوضع المتكيف\'';
$string['smiles_aromatic_c'] = 'ذرات الكربون العطرية';
$string['smiles_br'] = 'ذرات البروم';
$string['smiles_c'] = 'ذرات الكربون الأليفاتية';
$string['smiles_cl'] = 'ذرات الكلور';
$string['smiles_doublebond'] = 'الأواصر المزدوجة';
$string['smiles_f'] = 'ذرات الفلور';
$string['smiles_i'] = 'ذرات اليود';
$string['smiles_n'] = 'ذرات النتروجين';
$string['smiles_o'] = 'ذرات الأوكسجين';
$string['smiles_s'] = 'ذرات الكبريت';
$string['smiles_triplebond'] = 'الأواصر الثلاثية';
$string['smilescorrectcount'] = 'لديك الصيغة الجزيئية الصحيحة ولكن ليست لديك البنية الصحيحة.';
$string['smilesequal'] = 'لديك العدد الصحيح من {$a}.';
$string['smilestoofew'] = 'لديك القليل جدًا من {$a}.';
$string['smilestoomany'] = 'لديك الكثير جدًا من {$a}.';
