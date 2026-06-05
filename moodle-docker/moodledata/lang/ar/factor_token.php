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
 * Strings for component 'factor_token', language 'ar', version '5.1'.
 *
 * @package     factor_token
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['event:token_created'] = 'ترميز مصادقة متعددة العوامل تم إنشاؤه.';
$string['form:trust'] = 'الثقة بهذا الجهاز لـ {$a}.';
$string['pluginname'] = 'الثقة بهذا الجهاز';
$string['privacy:metadata'] = 'إن ملحق عامل الثقة بهذا الجهاز لا يخزن أي بيانات شخصية.';
$string['settings:description'] = 'السماح للمستخدمين بتخطي المصادقة الإضافية في الأجهزة المعلمة على أنها موثوقة بعد المصادقة الأولى';
$string['settings:expireovernight'] = 'إنهاء الثقة بعد منتصف الليل';
$string['settings:expireovernight_help'] = 'هذا يرغم الترميزات على انتهاء صلاحيتها عند منتصف الليل، مما يجنب المستخدمين المقاطعة خلال النهار. ستتم مطالبتهم بتجديد المصادقة متعددة العوامل عند بداية اليوم بعد انتهاء صلاحيتها.';
$string['settings:expiry'] = 'فترة الثقة';
$string['settings:expiry_help'] = 'فترة الثقة بالجهاز قبل أن يتطلب مصادقة متعددة العوامل جديدة.';
$string['settings:shortdescription'] = 'السماح للمستخدمين بتخطي المصادقة الإضافية في الأجهزة المعلمة على أنها موثوقة. تنبغي مصاحبته لعوامل أخرى.';
$string['summarycondition'] = 'المستخدم أعطى ثقته سابقًا بهذا الجهاز';
$string['tokenstoredindevice'] = 'المستخدم ذو المُعرَّف {$a->userid} لديه ترميز مصادقة متعددة العوامل مخزون في جهازه. <br> المعلومات: {$a->string}.';
