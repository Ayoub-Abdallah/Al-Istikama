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
 * Strings for component 'block_smb_web_client', language 'ar', version '5.1'.
 *
 * @package     block_smb_web_client
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['advancedsettings'] = 'إعدادات متقدمة';
$string['back'] = 'عودة إلى إعدادات الكتلة';
$string['desccustomtitle'] = 'يعطي للكتلة عنوانًا مخصصًا من غير العنوان الافتراضي "Windows Shares"';
$string['deschomedirsharerep'] = 'النص المزمع استبداله في جملة المجلد الرئيسي';
$string['deschomedirsharesrch'] = 'النص المزمع البحث عنه في جملة المجلد الرئيسي';
$string['descmodrewrite'] = 'إذا كان لديك mod_rewrite منصبًا في Apache يمكنك تمكين هذا الإعداد ووضع ما يأتي في ملف .htaccess ضمن المجلد الجذري لهذه الكتلة:
<pre>
&lt;IfModule mod_rewrite.c&gt;
    RewriteEngine on
    RewriteCond    %{REQUEST_FILENAME}  -d
    RewriteRule ^(.*/[^\\./]*[^/])$ $1/#   RewriteRule ^(.*)$ smbwebclient.php?path=$1 [QSA,L]
&lt;/IfModule&gt;</pre>

عندها ستتمكن من الوصول مستعملاً الروابط "المُجمَّلة" (أي: http://server/windows-network/DOMAIN/SERVER/SHARE/PATH)';
$string['descssl'] = 'إجبار كتلة مشاركة الوصول لوندوز على الاتصال عبر SSL (موصى به)';
$string['false'] = 'خطأ';
$string['generalsettings'] = 'الإعدادات العامة';
$string['homedir'] = 'مجلد الصفحة الرئيسية';
$string['homedirshare'] = 'مشاركة مجلد الصفحة الرئيسية';
$string['labelallsharessite'] = 'عَرض كل المشاركات في صفحة الموقع';
$string['labelanonymous'] = 'السماح بتسجيل دخول المجهولين';
$string['labelcustomtitle'] = 'العنوان المخصص للكتلة';
$string['labelhomedirsharerep'] = 'استبدال جملة مجلد الصفحة الرئيسية';
$string['labelhomedirsharesrch'] = 'بحث جملة مجلد الصفحة الرئيسية';
$string['labelprn'] = 'إخفاء مشاركات الطابعة';
$string['sharename'] = 'مسار المشاركة (<i>domain/server/share</i>)';
$string['smbshare'] = 'ما يعادل Samba (<i>domain/servername</i>)';
$string['true'] = 'صح';
$string['windows'] = 'النوافذ';
