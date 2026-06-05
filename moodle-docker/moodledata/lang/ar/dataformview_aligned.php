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
 * Strings for component 'dataformview_aligned', language 'ar', version '5.1'.
 *
 * @package     dataformview_aligned
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aligned:addinstance'] = 'إضافة معاينة نموذج بيانات للمحاذاة جديد';
$string['entrytemplate_help'] = 'إن المُدخل قالب المعاينة ذات المحاذاة هو تعريف مبسط لصف في جدول. هو يتكون من قائمة من تعاريف الأعمدة، كل منها في سطر جديد. صيغة تعريف العمود تكون بالشكل:
نمط الحقل|عنوان العمود (إختياري)| فئة css للخلية (إختياري). على سبيل المثال، التعريف الآتي سيعرض المُدخلات بجدول بلا عناوين ذي 3 أعمدة وأنماط الحقول المحددة بالترتيب:
<p>
[[Name]]<br />
[[Email]]<br />
[[Message]]<br />
</p>
التعريف الآتي سيعرض المُدخلات بجدول ذي 5 أعمدة مع صف عناوين للأعمدة الثلاثة الأولى منها:
<p>
[[Name]]|Name<br />
[[Email]]|Email<br />
[[Message]]|Message<br />
[[EAC:edit]]]<br />
[[EAC:delete]]<br />
</p>.';
$string['pluginname'] = 'محاذى';
