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
 * Strings for component 'recommend', language 'ar', version '5.1'.
 *
 * @package     recommend
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addquestion'] = 'إضافة سؤال';
$string['editquestion'] = 'تحرير السؤال';
$string['editquestions'] = 'تحرير الأسئلة';
$string['error_questionnotfound'] = 'لم يُعثر على السؤال';
$string['eventquestioncreated'] = 'سؤال توصية تم إنشاؤه';
$string['eventquestiondeleted'] = 'سؤال توصية تم حذفه';
$string['eventquestionupdated'] = 'سؤال توصية تم تحديثه';
$string['eventrequestaccepted'] = 'توصية تم قبولها';
$string['eventrequestcompleted'] = 'توصية تم إكمالها';
$string['eventrequestcreated'] = 'طلب توصية تم إنشاؤه';
$string['eventrequestdeclined'] = 'طلب توصية تم رفضه';
$string['eventrequestdeleted'] = 'طلب توصية تم حذفه';
$string['eventrequestrejected'] = 'توصية تم رفضها';
$string['eventrequestsent'] = 'طلب توصية تم إرساله';
$string['notificationcompleted_body'] = 'عزيزي {$a->recipient}،

تم إكمال توصيات جديدة في {$a->site} وهي تنتظر الآن قبولها.

المشارك: {$a->participant}
اسم الشخص الموصي: {$a->name}

لمعاينة التوصية، اتبع الرابط:
{$a->link}

إذا احتجت إلى مساعدة، يرجى التواصل مع مشرف الموقع،
{$a->admin}';
$string['notificationstatuschanged_body'] = 'عزيزي {$a->recipient}،

تفضلك بالعلم بشأن التغيير في حالة التوصية التي طلبتها.
اسم الشخص الموصي: {$a->name}
البريد الالكتروني: {$a->email}
الحالة الجديدة: <b>{$a->status}</b>

لمعاينة كل طلبات توصياتك، اتبع الرابط:
{$a->link}

إذا احتجت إلى مساعدة، يرجى التواصل مع مشرف الموقع،
{$a->admin}';
$string['prefillwith'] = 'الملء المسبق بـ:';
$string['question'] = 'السؤال';
$string['questiontype'] = 'النوع';
$string['recommend:addinstance'] = 'إضافة نشاط إلتماس التوصية جديد';
$string['recommendatorname'] = 'اسم الشخص الموصي';
$string['recommendname'] = 'الاسم';
$string['recommendname_help'] = 'اسم النشاط معروض في صفحة المساق وهو غير مرئي بالنسبة إلى الشخص الموصي.';
$string['requesttemplatebody'] = 'عزيزي {NAME}

{PARTICIPANT} قد سألك بأن تقدم له توصية في {SITE}.
لملء نموذج التوصية عبر الاتصال بالإنترنت، يرجى اتباع الرابط:
{LINK}

إذا أردت الحصول على مساعدة، يرجى التواصل مع مشرف الموقع،
{ADMIN}';
$string['selectquestiontype'] = 'إختر نوع السؤال';
$string['typelabel'] = 'نص توضيحي بدون مسيطرات الإدخال';
