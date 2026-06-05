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
 * Strings for component 'auth_saml2sso', language 'ar', version '5.1'.
 *
 * @package     auth_saml2sso
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['error_lockconfig_field_map_firstname'] = 'الاسم الأول في حقول تعيين البيانات إجباري';
$string['help_autocreate'] = 'أتريد السماح بإنشاء مستخدمين جدد؟';
$string['help_field_idp_firstname'] = 'الحقل من IdP الذي يحتوي على الاسم الأول للمستخدم';
$string['help_logout_url_redir'] = 'عنوان الرابط الذي ستوجه إليه المستخدمين عند تسجيل خروجهم. إذا كان الرابط خاطئاً أو فارغاً، ستتم إعادة توجيههم إلى صفحة مودل الرئيسية. (مثال: https://go.to/another/url)';
$string['label_field_idp_fullname'] = 'الاسم الكامل من IdP';
$string['label_instructions_p1'] = '<p>ينبغي عليك إملاء حقول التعيين الآتية بالشكل:</p><ul><li>Firstname => givenName</li><li>Surname => surname</li><li>Email address: => email</li></ul><p>يمكنك تغيير ذلك في مصفوفة <code>$stringMapping</code> في الملف <code>auth.php</code></p>';
$string['label_logout'] = 'أنقر هنا لتسجيل الخروج';
$string['pluginname'] = 'مصادقة SAML2 SSO';
