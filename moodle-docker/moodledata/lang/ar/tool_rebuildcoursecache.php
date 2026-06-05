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
 * Strings for component 'tool_rebuildcoursecache', language 'ar', version '5.1'.
 *
 * @package     tool_rebuildcoursecache
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['areyousure'] = 'هل أنت متأكد من الاستمرار؟';
$string['disclaimer'] = 'ستقوم هذه الأداة بإعادة إنشاء مخبوءات المساق (modinfo و sectioncache) لكل المساقات في موقعك. <br /> قد يستغرق هذا وقتًا طويلاً في المواقع الكبيرة، لذا قد ترغب في القيام بذلك أثناء الليل أو أوقات التوقف.';
$string['fail'] = 'فشل - تعذر العثور على معرف المساق: {$a} <br />';
$string['notifyfinished'] = 'تمت إعادة بناء خبء المساق';
$string['notifyrebuilding'] = 'البدء بإعادة بناء خبء المساق';
$string['pageheader'] = 'إعادة بناء خبء المساق';
$string['pluginname'] = 'إعادة بناء خبء المساق';
$string['specifyids'] = 'اترك مربع النص فارغًا لإعادة إنشاء كل المساقات أو تحديد مُعرفات المساقات الفردية المزمع إعادة بنائها (مفصولة بفوارز إنجليزية أو مسافات) <br /> مثال: 1,2,30,100 أو 1 2 30 100';
$string['success'] = 'نجاح - معرف المساق: {$a} <br />';
