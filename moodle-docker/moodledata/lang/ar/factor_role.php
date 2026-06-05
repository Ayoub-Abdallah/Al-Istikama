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
 * Strings for component 'factor_role', language 'ar', version '5.1'.
 *
 * @package     factor_role
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'الأدوار';
$string['privacy:metadata'] = 'إن ملحق عامل دور المستخدم لا يخزن أي بيانات شخصية.';
$string['settings:description'] = 'حدد الأدوار التي عليها استعمال العوامل الأخرى للمصادقة. إذا لم يتم تشغيل هذا العامل، فكل الأدوار عليها استعمال عامل مصادقة إضافي.';
$string['settings:roles'] = 'الأدوار التي لا تجتاز';
$string['settings:roles_help'] = 'إختر الأدوار التي لن تجتاز هذا العامل. هذا يسمح لك بإرغام تلك الأدوار على استعمال عوامل أخرى للمصادقة.';
$string['settings:shortdescription'] = 'حدد المستخدمين الذين ينبغي عليهم استعمال العوامل الأخرى للمصادقة، بناءً على أدوارهم. تنبغي مصاحبته لعوامل أخرى.';
$string['summarycondition'] = 'ليس لديه تعيين في أي من الأدوار الآتية عند أي سياق: {$a}';
