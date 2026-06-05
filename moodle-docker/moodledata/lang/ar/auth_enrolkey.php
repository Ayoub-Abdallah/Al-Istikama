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
 * Strings for component 'auth_enrolkey', language 'ar', version '5.1'.
 *
 * @package     auth_enrolkey
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['description'] = 'هذا يقدم مفتاح الانضمام المبنى عليه التسجيل الذاتي';
$string['noemail'] = 'تمت محاولة إرسال بريد إلكتروني لك ولكنها فشلت';
$string['pluginname'] = 'التسجيل الذاتي المبنى على مفتاح الانضمام';
$string['privacy:metadata'] = 'إن إضافة مفتاح انضمام المصادقة لا تخزن أي بيانات شخصية.';
$string['recaptcha'] = 'يضيف عنصر تأكيد بشكل مرئي/مسموع إلى صفحة تسجيل الدخول بالنسبة إلى المستخدمين الراغبين بالتسجيل الشخصي المبني على أساس البريد الالكتروني. هذا من شأنه حماية موقعك من المزعجين ويرفع من أدائه بشكل عام. أنظر <a href="https://www.google.com/recaptcha">https://www.google.com/recaptcha</a>  للمزيد من التفاصيل.';
$string['recaptcha_key'] = 'تمكين عنصر reCAPTCHA';
$string['settings_email_title'] = 'يتطلب تأكيد البريد الالكتروني';
$string['settings_heading'] = 'الإعدادات العامة';
$string['settings_required_description'] = 'مفتاح الانضمام سيكون حقلاً مطلوبًا لأغراض التحقق';
$string['settings_required_title'] = 'يتطلب مفتاح الانضمام لغرض التحقق';
$string['settings_visible_title'] = 'تمكين عنصر مفتاح الانضمام';
$string['signup_field_title'] = 'مفتاح الانضمام';
$string['signup_missing'] = 'مفتاح الانضمام مفقود';
$string['signup_token_invalid'] = 'مفتاح الانضمام الذي أدخلته غير صالح';
$string['signup_view'] = 'الانضمام إلى المقرر الدراسي';
$string['signup_view_message_basic'] = 'لقد تم ضمك بصفة {$a->role} في المقرر \'<a href="{$a->href}">{$a->course}</a>\'';
$string['signup_view_message_basic_dates'] = 'لقد انضممت إلى {$a->course} بصفة {$a->role}. <a href={$a->href}>أنقر هنا لمعاينة المساق.</a><br />المقرر يبدأ في: {$a->startdate}<br />المقرر ينتهي في: {$a->enddate}';
$string['signup_view_message_basic_dates_endonly'] = 'لقد انضممت إلى {$a->course} بصفة {$a->role}. <a href={$a->href}>أنقر هنا لمعاينة المقرر.</a><br />المقرر ينتهي في: {$a->enddate}';
$string['signup_view_message_basic_dates_startonly'] = 'لقد انضممت إلى {$a->course} بصفة {$a->role}. <a href={$a->href}>أنقر هنا لمعاينة المقرر.</a><br />المقرر الدراسي يبدأ في: {$a->startdate}';
