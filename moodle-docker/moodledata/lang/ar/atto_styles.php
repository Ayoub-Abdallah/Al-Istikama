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
 * Strings for component 'atto_styles', language 'ar', version '5.1'.
 *
 * @package     atto_styles
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['code_example'] = '{<br />
&nbsp;&nbsp;&nbsp;&nbsp;"title": "Blue box",<br />
&nbsp;&nbsp;&nbsp;&nbsp;"type": "block",<br />
&nbsp;&nbsp;&nbsp;&nbsp;"classes": "box blue",<br />
&nbsp;&nbsp;&nbsp;&nbsp;"preview": true<br />
}';
$string['code_example_bootstrap'] = '{<br />
&nbsp;&nbsp;&nbsp;&nbsp;"title": "Success alert",<br />
&nbsp;&nbsp;&nbsp;&nbsp;"type": "block",<br />
&nbsp;&nbsp;&nbsp;&nbsp;"classes": "alert alert-success"<br />
}';
$string['code_example_bootstrap_multiple'] = '[{<br />
&nbsp;&nbsp;&nbsp;&nbsp;"title": "Success alert",<br />
&nbsp;&nbsp;&nbsp;&nbsp;"type": "block",<br />
&nbsp;&nbsp;&nbsp;&nbsp;"classes": "alert alert-success"<br />
},{<br />
&nbsp;&nbsp;&nbsp;&nbsp;"title": "Danger alert",<br />
&nbsp;&nbsp;&nbsp;&nbsp;"type": "block",<br />
&nbsp;&nbsp;&nbsp;&nbsp;"classes": "alert alert-danger"<br />
}]';
$string['config'] = 'تهيئة الأنماط';
$string['config_desc'] = 'تهيئة واجهة المستخدم لأنماط Atto بتنسيق JSON.<br /> يمكنك العثور على مثال موسع في الملف README.md في المقطع <a href="https://github.com/moodle-an-hochschulen/moodle-atto_styles/blob/main/README.md#usage--settings">"الاستعمال والإعدادات"</a>.
<hr />
على سبيل المثال:<br />
{$a->code_example}
<hr />
تحدد السمة <em>title</em> اسم النمط داخل عنصر واجهة المستخدم الرسومية لأنماط Atto.<br />
<br />
يمكن أن يدعم العنوان أيضًا مرشح مودل متعدد اللغات (إذا تم تمكينه)، ولكن يجب الإفلات من علامات الاقتباس المزدوجة الإضافية باستعمال الشرطة المائلة للخلف.<br />
يرجى إلقاء نظرة على ملف README الخاص بالملحق للحصول على مثال.<br />
<hr />
يمكن أن تحتوي السمة <em>type</em> على إحدى القيمتين: "block" أو "inline".<br />
<br />
ستنشئ "block" علامة div بالفئة (الفئات) المحددة وستعمل كعنصر قياسي على مستوى الكتلة. سيكون لهذا الأسبقية على عنصر مستوى الكتلة الحالي وقد ينطبق على أكثر من مجرد النص المحدد حاليًا.<br />
<br />
ستنشئ "inline" علامة span بالفئة (الفئات) المحددة وستعمل كعنصر قياسي مضمن. سيتم تطبيق هذا فقط على النص المحدد حاليًا.
<hr />
تأخذ السمة <em>classes</em> اسم فئة CSS الذي سيتم تطبيقه على النص المضمن أو الكتلة.<br />
<br />
يمكن تعريف فئات متعددة لكل عنصر، مفصولة بمسافة. سيتم تطبيقها جميعًا على النص المضمن أوالكتلة.<br />
<br />
لا يمكن إنشاء تعريفات فئة CSS داخل هذا الملحق. سيتعين عليك إضافة تعريفات فئة CSS إلى السمة أو إعدادات HTML الإضافية في مودل.
<hr />
تأخذ السمة <em>preview</em> القيم المنطقية true أو false (إفتراضيًا). إذا تم تعيين هذه القيمة على true، فسيحصل عنصر النمط على معاينة حقيقية للنمط. بخلاف ذلك، سيعرض عنصر النمط عنوانه فقط في نص عادي.<br />
<br />
يرجى ملاحظة أنه إذا اخترت عرض المعاينة لعنصر نمط، فيجب تعريف هذه الفئة في CSS بطريقة يمكن تطبيقها على وسوم الامتداد span، حتى إذا كان عنصر النمط نفسه عنصرًا على مستوى الكتلة.
<hr />
في تنصيبات مودل مع السمات المستندة إلى Bootstrap (خاصةً <em>Boost</em>)، يمكنك أيضًا إنشاء أنماط باستخدام فئات CSS المستندة إلى Bootstrap بدلاً من تعريف فئاتك الخاصة.
<br /><br />
على سبيل المثال:<br />
{$a->code_example_bootstrap}
<br/><br/>
للمزيد من المعلومات عن فئات bootstrap، يرجى زيارة الروابط الآتية ضمن توثيقات Bootstrap 4:
<ul>
<li><a href="https://getbootstrap.com/docs/4.6/components/badge/">شارات Bootstrap</a></li>
<li><a href="https://getbootstrap.com/docs/4.6/components/alerts/">تنبيهات Bootstrap</a></li>
<li><a href="https://getbootstrap.com/docs/4.6/utilities/">أدوات Bootstrap</a></li>
</ul>
<hr />
ترجى ملاحظة أن التعريفات المتعددة ينبغي إحاطتها بأقواس مربعة.
<br /><br />
على سبيل المثال:<br />
{$a->code_example_bootstrap_multiple}';
$string['inlinehint'] = 'إختر نصًا معينًا أولاً لتطبيق هذا النمط';
$string['jsondecodemessage'] = 'إدخال رموز JSON أمر غير صالح.';
$string['nostyle'] = 'لا أنماط';
$string['pluginname'] = 'الأنماط';
$string['privacy:metadata'] = 'إن ملحق atto_styles لا يخزن أيّ بيانات شخصية.';
$string['settings'] = 'إعدادات الأنماط';
