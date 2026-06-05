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
 * Strings for component 'factor_grace', language 'ar', version '5.1'.
 *
 * @package     factor_grace
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['info'] = 'السماح بتسجيل الدخول بدون عامل آخر لمدة معينة من الوقت.';
$string['pluginname'] = 'مهلة التغاضي';
$string['preferences'] = 'تفضيلات المستخدم';
$string['privacy:metadata'] = 'إن ملحق عامل فترة التغاضي لا يخزن أي بيانات شخصية.';
$string['redirectsetup'] = 'ينبغي عليك إكمال التهيئة للمصادقة متعددة العوامل قبل أن تتسنى لك المتابعة.';
$string['revokeexpiredfactors'] = 'سحب عوامل فترة التغاضي منتهية الصلاحية';
$string['settings:customwarning'] = 'محتوى لافتة التحذير';
$string['settings:customwarning_help'] = 'أضف محتوى هنا لاستبدال إشعار تحذير التغاضي بمحتوى مخصص بلغة HTML. إضافة الترميز {timeremaining} ضمن النص سيستبدله بفترة التغاضي الحالية للمستخدم، والترميز {setuplink} سيستبدله برابط صفحة التهيئة للمستخدم.';
$string['settings:description'] = 'السماح للمستخدمين بتسجيل الدخول بدون المصادقة متعددة العوامل لفترة من الزمن، ليعطيهم ذلك مهلة تهيئة عوامل المصادقة الخاصة بهم. بعد انتهاء فترة السماح تلك، ينبغي على المستخدم استعمال المصادقة متعددة العوامل لتسجيل الدخول.';
$string['settings:forcesetup'] = 'تهيئة عامل الفرض';
$string['settings:forcesetup_help'] = 'يرغم المستخدم على الذهاب إلى صفحة التفضيلات لتهيئة المصادقة متعددة العوامل عند انتهاء فترة التغاضي. عند ضبطه على التعطيل، لن يكون بقدور المستخدمين المصادقة عند انتهاء فترة التغاضي.';
$string['settings:graceperiod'] = 'مهلة التغاضي';
$string['settings:graceperiod_help'] = 'الفترة الزمنية التي يمكن عندها للمستخدمين الوصول إلى مودل بدون العوامل المهيئة والمُمَكَّنة.';
$string['settings:ignorelist'] = 'العوامل المتجاهلة';
$string['settings:ignorelist_help'] = 'فترة التغاضي لن تمنح أي نقاط إذا كانت هناك عوامل أخرى يمكن للمستخدمين استعمالها للمصادقة مع المصادقة متعددة العوامل. لن يتم احتساب أي عوامل هنا من قبل التغاضي عند اتخاذ القرار بشأن منح النقاط. هذا يمكن أن يسمح لفترة التغاضي بإتاحة المصادقة إذا كان هناك عامل آخر، كالبريد الالكتروني، يعاني من أخطاء في التهيئة أو من مشاكل النظام.';
$string['settings:shortdescription'] = 'يسمح للمستخدمين بتسجيل الدخول بدون المصادقة متعددة العوامل لفترة معينة، مما يتيح لهم المجال لتهيئة عوامل المصادقة.';
$string['setupfactors'] = 'أنت حاليًا في وضع التغاضي، وقد لا تكون لديك عوامل أخرى مهيئة بمجرد انتهاء فترة التغاضي. قم بزيارة {$a->url} لفحص حالة المصادقة الخاصة بك وتهيئة المزيد من عواملها. فترة التغاضي الخاصة بك تنتهي في {$a->time}.';
$string['summarycondition'] = 'هو ضمن فترة التغاضي';
