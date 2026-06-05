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
 * Strings for component 'mlbackend_php', language 'ar', version '5.1'.
 *
 * @package     mlbackend_php
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['datasetsizelimited'] = 'نظراً لحجمها الكبير، تم تقييم جزء من مجموعة البيانات فقط. عدل $CFG->mlbackend_php_no_memory_limit إذا كنت واثقاً بأن نظامك قادر على مواكبة مجموعة البيانات {$a}.';
$string['errorcantloadmodel'] = 'ملف مودل {$a} غير موجود. ينبغي تدريب النموذج قبل استعماله لأغراض التنبؤ.';
$string['errorlowscore'] = 'دقة التنبؤ للنموذج المقيم ليست عالية، لذلك فإن بعض التنبؤات قد لا تكون دقيقة. نقاط مودل = {$a->score}، أدنى نقاط = {$a->minscore}';
$string['errornotenoughdata'] = 'لا تتوفر بيانات كافية لتقييم هذا النموذج باستعمال فترة التحليل المحددة.';
$string['errornotenoughdatadev'] = 'نتائج التقييم متفاوتة جداً. من الموصى به جمع المزيد من البيانات لضمان صحة النموذج. الانحراف المعياري لنتائج التقييم = {$a->deviation}، أقصى انحراف معياري موصى به = {$a->accepteddeviation}';
$string['pluginname'] = 'خلفية التعلم الآلي لـ PHP';
$string['privacy:metadata'] = 'إن ملحق خلفية التعلم الآلي لـ PHP لا يخزن أي بيانات شخصية.';
