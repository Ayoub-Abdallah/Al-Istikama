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
 * Strings for component 'forumngfeature_delete', language 'ar', version '5.1'.
 *
 * @package     forumngfeature_delete
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['confirmdeletediscussion'] = 'هل أنت متأكد من رغبتك في حذف هذه المناقشة؟';
$string['confirmundeletediscussion'] = 'هل أنت متأكد من رغبتك في إلغاء حذف هذه المناقشة؟';
$string['deletediscussion'] = 'حذف المناقشة';
$string['emailcontenthtml'] = 'هذا إشعار لإبلاغك بأن مناقشتك التي بدأتها
ذات التفاصيل الآتية قد تم حذفه من قبل \'{$a->firstname} {$a->lastname}\':<br />
<br />
الموضوع: {$a->subject}<br />
المنتدى: {$a->forum}<br />
المساق: {$a->course}<br/>
<br/>';
$string['emailcontentplain'] = 'هذا إشعار لإبلاغك بأن مناقشتك التي بدأتها
ذات التفاصيل الآتية قد تم حذفه من قبل \'{$a->firstname} {$a->lastname}\':

الموضوع: {$a->subject}
المنتدى: {$a->forum}
المساق: {$a->course}';
$string['notifycontributorsemailcontenthtml'] = 'هذا إشعار لإبلاغك بأن المناقشة التي شاركت فيها
ذات التفاصيل الآتية قد تم حذفه من قبل \'{$a->firstname} {$a->lastname}\':<br />
<br />
الموضوع: {$a->subject}<br />
المنتدى: {$a->forum}<br />
المساق: {$a->course}<br/>
<br/>';
$string['notifycontributorsemailcontentplain'] = 'هذا إشعار لإبلاغك بأن المناقشة التي شاركت فيها
ذات التفاصيل الآتية قد تم حذفه من قبل \'{$a->firstname} {$a->lastname}\':

الموضوع: {$a->subject}
المنتدى: {$a->forum}
المساق: {$a->course}';
$string['pluginname'] = 'حذف/إلغاء حذف المناقشة';
$string['undeletediscussion'] = 'إلغاء حذف المناقشة';
