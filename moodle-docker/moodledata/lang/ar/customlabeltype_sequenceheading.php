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
 * Strings for component 'customlabeltype_sequenceheading', language 'ar', version '5.1'.
 *
 * @package     customlabeltype_sequenceheading
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['heading'] = 'عنوان التسلسل';
$string['image'] = 'صورة العنوان المصغرة';
$string['left'] = 'اليسار';
$string['right'] = 'اليمين';
$string['sequenceheading:view'] = 'يمكنه معاينة المحتوى';
$string['shortdesc'] = 'الوصف المختصر';
$string['template'] = '<table class="custombox-sequenceheading" width="100%">
<tr valign="<%%verticalalignoption%%>" class="custombox-icon sequenceheading">
<%%imageL%%>
<td>
<h2 class="custombox-caption sequenceheading"><%%heading%%></h2>
<p class="sequenceheading"><%%shortdesc%%></p>
</td>
<%%imageR%%>
</tr>
</table>';
$string['verticalalign'] = 'المحاذاة عموديًا';
