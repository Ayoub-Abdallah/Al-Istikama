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
 * Strings for component 'local_contact', language 'ar', version '5.1'.
 *
 * @package     local_contact
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['confirmationemail'] = '<p>عزيزنا [fromname]،</p>
<p>شكراً على تواصلك معنا. إذا تطلب الأمر، سنتصل بك قريباً.</p>
<p>مع التحية،</p>
<p>[supportname]<br>
[sitefullname]<br>
<a href="[siteurl]">[siteurl]</a></p>';
$string['norecaptcha'] = 'بدون ReCAPTCHA';
$string['norecaptcha_description'] = 'لا تستعمل ReCAPTCHA مع النماذج التي تتم معالجتها من قبل نموذج التواصل.';
$string['nosubjectsitename'] = 'لا توجد تسمية الموقع في حقل موضوع الرسالة';
$string['privacy:metadata'] = 'إن ملحق نموذج الاتصال لا يخزن أي بيانات شخصية عن أي مستخدم.';
$string['recapchainfo'] = 'باستعمال ReCAPTCHA';
$string['recapchainfo_description'] = 'تم تمكين ReCAPTCHA حاليًا في مودل. <strong>يجب</strong> عليك:<br>
<ul>
  <li>التأكد من تضمين وسم {recaptcha} في كل النماذج التي تتم معالجتها من قبل نموذج التواصل لمودل.</li>
  <li>التأكد من تنصيب وتمكين <a href="https://moodle.org/plugins/filter_filtercodes">ملحق FilterCodes</a>.</li>
</ul>';
