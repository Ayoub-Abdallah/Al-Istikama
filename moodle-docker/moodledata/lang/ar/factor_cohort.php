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
 * Strings for component 'factor_cohort', language 'ar', version '5.1'.
 *
 * @package     factor_cohort
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'الزُمر';
$string['privacy:metadata'] = 'إن ملحق عامل الزمرة لا يخزن أي بيانات شخصية.';
$string['settings:cohort'] = 'الدفعات غير المجتازة';
$string['settings:cohort_help'] = 'إختر الدفعات التي لن تجتاز هذا العامل. هذا يسمح لكل بإرغام تلك الدفعات على استعمال عوامل مصادقة أخرى.';
$string['settings:description'] = '<p>حدد زمر المستخدمين التي عليها استعمال عوامل إضافية للمصادقة. إذا لم تتم تهيئة هذا العامل، سيكون لزامًا على كل الزمر استعمال العوامل الإضافية إفتراضيًا.</p>
<p>يتطلب هذا العامل إنشاء زمرة.</p>';
$string['settings:shortdescription'] = 'حدد أي الزمر التي عليها استعمال العوامل الأخرى للمصادقة. تنبغي مصاحبته مع عوامل أخرى.';
$string['summarycondition'] = 'ليس لديه تعيين في أي من الدفعات الآتية عند أي سياق: {$a}';
