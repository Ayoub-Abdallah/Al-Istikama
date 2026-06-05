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
 * Strings for component 'factor_iprange', language 'ar', version '5.1'.
 *
 * @package     factor_iprange
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowedipsempty'] = 'لن يتمكن أحد من اجتياز هذا العامل حاليًا! يمكن إضافة عنوان IP العائد لك (<i>{$a->ip}</i>)';
$string['allowedipshasmyip'] = 'عنوان IP العائد لك (<i>{$a->ip}</i>) هو ضمن القائمة وستجتاز هذا العامل.';
$string['allowedipshasntmyip'] = 'عنوان IP العائد لك (<i>{$a->ip}</i>) ليس ضمن القائمة ولن تجتاز هذا العامل.';
$string['pluginname'] = 'مدى IP';
$string['privacy:metadata'] = 'إن ملحق عامل مدى IP لا يخزن أي بيانات شخصية.';
$string['settings:description'] = 'تمكين التحقق التلقائي من المستخدمين باستعمال عناوين IP. هذا لا يتطلب أي تهيئة من طرف المستخدم ويمكنه توفير تسجيل دخول آمن وسلس في الشبكات الموثوقة.';
$string['settings:safeips'] = 'مديات IP الآمنة';
$string['settings:safeips_help'] = 'أدخل قائمة عناوين IP أو الشبكات الفرعية ليتم احتسابها بمثابة أحد عوامل الاجتياز. إذا تُركت فارغة، لن يجتاز أحد هذا العامل. {$a->info} {$a->syntax}';
$string['settings:shortdescription'] = 'استعمل عنوان IP للتحقق التلقائي من هوية المستخدم.';
$string['summarycondition'] = 'هو عند شبكة مؤمنة';
