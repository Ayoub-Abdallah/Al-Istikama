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
 * Strings for component 'tool_uploadblocksettings', language 'ar', version '5.1'.
 *
 * @package     tool_uploadblocksettings
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['blockadded'] = '{$a->line} {$a->linenum} [{$a->oplabel}]: الكتلة "{$a->blocktitle}" ({$a->blockname}) أضيفت إلى المساق "{$a->coursename}" ({$a->courseid}).';
$string['blockadderror'] = '{$a->line} {$a->linenum} [{$a->oplabel}]: خطأ: الكتلة "{$a->blocktitle}" ({$a->blockname}) لم تُضف إلى المساق "{$a->coursename}" ({$a->courseid}). {$a->skipped}.';
$string['blockalreadyadded'] = '{$a->line} {$a->linenum} [{$a->oplabel}]: الكتلة "{$a->blocktitle}" ({$a->blockname}) سبقت إضافتها إلى المساق "{$a->coursename}" ({$a->courseid}). {$a->skipped}.';
$string['blockdeleted'] = '{$a->line} {$a->linenum} [{$a->oplabel}]: الكتلة "{$a->blocktitle}" ({$a->blockname}) حُذِفت من المساق "{$a->coursename}" ({$a->courseid}).';
$string['blockdoesntexist'] = '{$a->line} {$a->linenum} [{$a->oplabel}]: الكتلة "{$a->blocktitle}" ({$a->blockname}) لم تُضف إلى المساق "{$a->coursename}" ({$a->courseid}). {$a->skipped}.';
$string['blockinstancenotfound'] = '{$a->line} {$a->linenum} [{$a->oplabel}]: تحذير: الكتلة "{$a->blocktitle}" ({$a->blockname}) غير موجودة في المساق "{$a->coursename}" ({$a->courseid}).';
$string['blockmoved'] = '{$a->line} {$a->linenum} [{$a->oplabel}]: الكتلة "{$a->blocktitle}" ({$a->blockname}) في المساق "{$a->coursename}" ({$a->courseid}) moved.';
$string['heading'] = 'رفع إعدادات كتلة المساق من ملف CSV';
$string['operationnotvalid'] = '{$a->line} {$a->linenum} [{$a->oplabel}]: العملية غير صحيحة للكتلة "{$a->blocktitle}" ({$a->blockname}). {$a->skipped}.';
$string['pluginname'] = 'رفع إعدادات الكتلة';
$string['pluginname_help'] = 'رفع إعدادات كتلة المقرر من ملف CSV لضبط تلك الإعدادات لمدى من المقررات الدراسية بعملية واحدة.';
$string['privacy:metadata'] = 'أداة الإدارة \'رفع إعدادات الكتلة\' لا تخزن أي بيانات شخصية.';
