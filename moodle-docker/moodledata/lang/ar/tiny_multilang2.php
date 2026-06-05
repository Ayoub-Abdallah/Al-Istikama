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
 * Strings for component 'tiny_multilang2', language 'ar', version '5.1'.
 *
 * @package     tiny_multilang2
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addlanguage'] = 'إضافة اللغة يدويًا';
$string['addlanguage_desc'] = 'إذا اخترت هذا الخيار، يمكنك يدويًا إضافة اللغات عبر إدخال رمز iso للغة في مربع النص أدناه. بخلاف ذلك، ينبغي عليك تنصيب لغتنين على الأقل في حزم اللغات التي في الموقع.';
$string['helplinktext'] = 'محتوى متعدد اللغات (الإصدار 2)';
$string['highlight'] = 'إبراز المحددات';
$string['highlight_desc'] = 'إبراز بصري لمحددات المحتوى متعدد اللغات (أي، {mlang XX} و {mlang}) في محرر WYSIWYG';
$string['highlightcss'] = 'أنماط CSS لوسم اللغة';
$string['highlightcss_desc'] = 'أنماط CSS المستعملة في الإبراز البصري لمحددات المحتوى متعدد اللغات.

إذا أردت عرض اللغة في الكتل متعددة اللغات، بإمكانك استعمال شيء مشابه لما يأتي (المثال هو للغة الباسك، الألوان ربما لا تكون أفضل ما يمكن تحقيقه):

<pre>
.multilang-begin:lang(eu):before {
    content: "eu";
    position: relative;
    top: -0.5em;
    font-weight: bold;
    background-color: #e05e5e;
    color: #ffffff;
}
</pre>';
$string['language_options_desc'] = 'حدد خيارات زر القائمة المنسدلة التي تستعرض اللغات.

<br>القائمة الكاملة متاحة من خلال <small><a href=\'https://www.w3schools.com/tags/ref_language_codes.asp\'>
                             <u>https://www.w3schools.com/tags/ref_language_codes.asp</u></a></small>';
$string['language_setting'] = 'إعدادات زر اللغات';
$string['languageoptions'] = 'اللغة';
$string['multilang2:desc'] = 'إضافة وسوم متعدد اللغات للمحتوى';
$string['multilang2:langTagsInSelection'] = 'النص المحدد يتضمن وسوم اللغات. يرجى النقر على وسم معين لتحديده';
$string['multilang2:language'] = 'اللغة';
$string['multilang2:multiBlockElements'] = 'النص المحدد مجزأ على عدة عناصر من الفقرات/الكُتل. يرجى اختيار إحداها فقط.';
$string['multilang2:other'] = 'التراجع';
$string['multilang2:removetag'] = 'إزالة وسم اللغة';
$string['multilang2:viewlanguagemenu'] = 'معاينة القائمة المنسدلة للغات في محرر TinyMCE';
$string['pluginname'] = 'محتوى متعدد اللغات (الإصدار 2)';
$string['privacy:metadata'] = 'إن ملحق Tiny للمحتوى متعدد اللغات (الإصدار 2) لا سخزن أي بيانات شخصية.';
$string['removealltags'] = 'إزالة كل وسوم اللغات';
$string['requiremultilang2'] = 'يتطلب منقح المحتوى متعدد اللغات (الإصدار 2)';
$string['requiremultilang2_desc'] = 'عند تمكينه، تصير القائمة المنسدلة للغات مرئية فقط عند تمكين مرشح المحتوى متعدد اللغات (الإصدار 2).';
$string['showalllangs'] = 'إظهار كل اللغات';
$string['showalllangs_desc'] = 'عند تمكينه، ستتضمن القائمة المنسدلة للغات كل اللغات المدعومة في مودل. عند تعطيله، ستظهر فقط اللغات المنصبة والممكنة في الموقع.';
