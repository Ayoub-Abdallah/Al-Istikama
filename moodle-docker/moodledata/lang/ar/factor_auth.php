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
 * Strings for component 'factor_auth', language 'ar', version '5.1'.
 *
 * @package     factor_auth
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['info'] = 'التحقق من نوع المصادقة المستعملة لتسجيل الدخول بمثابة عامل المصادقة متعددة العوامل.';
$string['pluginname'] = 'نوع المصادقة';
$string['privacy:metadata'] = 'إن ملحق نوع المصادقة لا يخزن أي بيانات شخصية.';
$string['settings:description'] = 'تحقق تلقائيًا من المستخدمين بناءً على نوع مصادقتهم.';
$string['settings:goodauth'] = 'أنواع مصادقة العوامل';
$string['settings:goodauth_help'] = 'إختر كل أنواع المصادقة التي ستحصل على نقاط من هذا العامل. أنواع المصادقة الأخرى لن تتم معاملتها كفشل في المصادقة متعددة العوامل، ولكنها لن تحصل على النقاط التي لوزن هذا العامل.';
$string['settings:shortdescription'] = 'السماح للمستخدمين بتخطي خطوات المصادقة الإضافية بناءً على نوع مصادقتهم.';
$string['summarycondition'] = 'لديه نوع المصادقة {$a}';
