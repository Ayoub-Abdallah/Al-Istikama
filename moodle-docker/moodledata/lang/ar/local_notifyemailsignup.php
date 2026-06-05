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
 * Strings for component 'local_notifyemailsignup', language 'ar', version '5.1'.
 *
 * @package     local_notifyemailsignup
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['notifyemailsignupbody'] = 'مرحبًا {$a->supportname}،

تم طلب حساب مستخدم جديد في \'{$a->sitename}\'
باستعمال المعلومات الآتية:

- البريد الالكتروني: {$a->signup_user_email}
- اسم المستخدم: {$a->signup_user_username}
- الاسم الأول: {$a->signup_user_firstname}
- الاسم الأخير: {$a->signup_user_lastname}

مع تحيات مشرف \'{$a->sitename}\'،
{$a->signoff}';
$string['notifyemailsignupsubject'] = 'إشعار تسجيل حساب جديد: {$a}';
$string['pluginname'] = 'إخطار مسؤولي الموقع بشأن الاشتراكات الجديدة بالبريد الإلكتروني';
$string['privacy:metadata:replytoname'] = 'اسم مستخدم الدعم كما تم تعريفه';
