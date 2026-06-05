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
 * Strings for component 'local_mass_enroll', language 'ar', version '5.1'.
 *
 * @package     local_mass_enroll
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['idnumber'] = 'رقم المُعرَّف';
$string['mass_enroll_help'] = '<h1>الانضمامات بالجملة</h1>

<p>
مع هذا الخيار ستقوم بضم قائمة من المستخدمين المعروفين باستعمال ملف يحتوي على حساب واحد لكل سطر
</p>
<p>
<b> السطر الأول </b> سيتم تخطي الأسطر الفارغة أو تلك التي تحتوي على حسابات غير معروفة. </p>

<p>
قد يحتوي الملف على عمود واحد أو أكثر مفصولة بفارزة أو فارزة منقوطة أو علامة الجدولة.

ينبغي عليك تحضيره باستعمال برنامج معالجة الجداول المعهود عندك مشتملاً على القائمة الرسمية للطلاب مثلاً،
وعند الحاجة، إضافة عمود يتضمن المجموعات التي تريد إضافة هؤلاء المستخدمين إليها. وأخيرًا، قم بتصديره بصيغة CSV. (*)</p>

<p>
<b> العمود الأول ينبغي أن يحتوي على المعرف الفريد للحساب </b>: idnumber (إفتراضيًا) اسم الدخول أو البريد الالكتروني للمستخدم المستهدف. (**). </p>

<p>
العمود الثاني <b>إذا كان حاضرًا، </b> يحتوي على اسم المجموعة التي تريد إضافة المستخدم إليها. </p>

<p>
إذا كان اسم المجموعة غير موجود، سيتم إنشاؤها في مساقك مع إضافة تجميع أيضًا بنفس التسمية حيث ستوضع المجموعة بداخله.
.<br/>
هذا يعود إلى حقيقة أن النشاطات في مودل يتم تقييدها حسب التجميعات (مجموعة من المجموعات)، وليس المجموعات نفسها،
وهذا من شأنه أن يجعل حياتك أسهل. (هذا يتطلب أن تكون التجميعات مُمَكَّنة من قبل المشرف في موقعك).

<p>
قد تجعل في نفس الملف مجموعات مستهدفة متعددة أو لا مجموعات لبعض الحسابات
</p>

<p>
يمكنك رفع خيار إنشاء المجموعات والتجميعات إذا كنت متأكدًا بأنها موجودة مسبقًا في المساق.
</p>

<p>
إفتراضيًا، سيتم ضم المستخدمين بدور طلاب، ولكن يمكنك اختيار أدوار أخرى تمتلك صلاحية الإدارة (معلم، معلم بلا تحرير، أو أي أدوار مخصصة أخرى)
</p>

<p>
يمكنك إعادة هذه العملية حسب الرغبة بدون أضرار، على سبيل المثال، إذا نسيت ذكر المجموعة المستهدفة أو أخطأت في تسميتها.
</p>


<h2> نماذج من الملفات </h2>

أرقام المعرفات وأسماء المجموعات المطلوب إنشاؤها في المساق (*)
<pre>
"idnumber";"group"
" 2513110";" 4GEN"
" 2512334";" 4GEN"
" 2314149";" 4GEN"
" 2514854";" 4GEN"
" 2734431";" 4GEN"
" 2514934";" 4GEN"
" 2631955";" 4GEN"
" 2512459";" 4GEN"
" 2510841";" 4GEN"
</pre>

المعرفات فقط (**)
<pre>
idnumber
2513110
2512334
2314149
2514854
2734431
2514934
2631955
</pre>

عناوين البريد الالكتروني فقط (**)
<pre>
email
toto@insa-lyon.fr
titi@]insa-lyon.fr
tutu@insa-lyon.fr
</pre>

أسماء المستخدمين والمجموعات مفصولة بعلامة جدولة:

<pre>
username	 group
ppollet      groupe_de_test              will be in that group
codet        groupe_de_test              also him
astorck      autre_groupe                will be in another group
yjayet                                   no group for this one
                                         empty line skipped
unknown                                  unknown account skipped
</pre>

<p>
<span <font color=\'red\'>(*) </font></span>: علامات التنصيص المزدوجة والفراغات المضافة من قبل بعض برامج معالجة الجداول، ستتم إزالتها.
</p>

<p>
<span <font color=\'red\'>(**) </font></span>: الحساب المستهدف ينبغي أن يكون موجودًا في مودل؛ هذا هو الوضع الاعتيادي عندما يكون مودل متزامنًا
مع مجلد خارجي، مثلاً (LDAP...)
</p>';
