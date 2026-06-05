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
 * Strings for component 'factor_capability', language 'ar', version '5.1'.
 *
 * @package     factor_capability
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['capability:cannotpassfactor'] = 'ينبغي استعمال عامل آخر من المصادقة متعددة العوامل للحصول على التفويض.';
$string['pluginname'] = 'إمكانيات المستخدم';
$string['privacy:metadata'] = 'إن ملحق عامل إمكانية المستخدم لا يخزن أي بيانات شخصية.';
$string['settings:adminpasses'] = 'مشرفو الموقع يمكنهم اجتياز هذا العامل';
$string['settings:adminpasses_help'] = 'إفتراضيًا، يمكن للمشرفين اجتياز كل فحوص الإمكانية، بضمنها هذا الفحص الذي يستعمل \'factor/capability:cannotpassfactor\'، ما يعني أنهم سيفشلون عند هذا العامل.
عند تأشيره سيجتاز كل مشرفي الموقع هذا العامل إذا لم تكن لديهم تلك الإمكانية من دور آخر.
عند عدم تأشيره، سيفشل مشرفو الموقع عند هذا العامل.';
$string['settings:description'] = '<p>استعمل الإمكانية \'factor/capability:cannotpassfactor\' لتحدد أي المستخدمين الذين عليهم استعمال عامل مصادقة آخر.</p>
<p>إسمح بهذه الإمكانية إلى الأدوار المحددة في <a href="roles/manage.php">تعريف الأدوار</a>.</p>';
$string['settings:shortdescription'] = 'تحديد أي المستخدمين الذين عليهم استعمال العوامل الأخرى للمصادقة. تنبغي مصاحبته مع عوامل أخرى.';
$string['summarycondition'] = 'ليست لديه الإمكانية \'factor/capability:cannotpassfactor\' في أي دور بما في ذلك مشرف الموقع.';
