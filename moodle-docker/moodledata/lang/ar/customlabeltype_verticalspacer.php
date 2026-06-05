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
 * Strings for component 'customlabeltype_verticalspacer', language 'ar', version '5.1'.
 *
 * @package     customlabeltype_verticalspacer
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['configtypename'] = 'تمكين المناطق العمودية الفارغة في الصفحة للملحق';
$string['pluginname'] = 'عنصر المساق: الفاصل العمودي';
$string['template'] = '<div id="custombox-verticalspacer<%%customid%%>" class="custombox-verticalspacer" style="height:<%%spacing%%>px;min-height:<%%spacing%%>px">
 
<%if %%editing%% %>
<img id="verticalspacer<%%customid%%>" src="<%%dragimageurl%%>">
<script type="text/javascript">
var verticalspacerlocation<%%customid%%> = 0;
var verticalspacerpagelocation<%%customid%%> = 0;

// إزالة كل الأحداث
$(\'#verticalspacer<%%customid%%>\').off();

$(\'#verticalspacer<%%customid%%>\').mousedown(function(event) {
    verticalspacerlocation<%%customid%%> = parseInt($(\'#custombox-verticalspacer<%%customid%%>\').css(\'height\').replace(/em|px/, \'\'));
    verticalspacerpagelocation<%%customid%%> = event.pageY;
    event.stopImmediatePropagation();
    return false;
});
$(\'#verticalspacer<%%customid%%>\').mouseup(function(event) {
    verticalspacerlocation<%%customid%%> = 0;
    verticalspacerpagelocation<%%customid%%> = 0;

    height = $(\'#custombox-verticalspacer<%%customid%%>\').css(\'height\');
    url = \'<%%wwwroot%%>/mod/customlabel/type/verticalspacer/ajax/service.php?id=<%%courseid%%>&cid=<%%cid%%>&height=\'+height.replace(/em|px/, \'\');
    $.get(url);
    event.stopImmediatePropagation();
    return false;
});
$(\'#verticalspacer<%%customid%%>\').mousemove(function(event) {
    if (verticalspacerlocation<%%customid%%> != 0) {
        dist = event.pageY - verticalspacerpagelocation<%%customid%%>;
        height = verticalspacerlocation<%%customid%%>;
        newheight = (height + dist) + \'px\';
        $(\'#custombox-verticalspacer<%%customid%%>\').css(\'height\', newheight);
    }
    event.stopImmediatePropagation();
    return false;
});
</script>
<%endif %>
</div>';
$string['typename'] = 'الفاصل العمودي الفارغ للأعمدة';
$string['verticalspacer:view'] = 'يمكنه معاينة المحتوى';
