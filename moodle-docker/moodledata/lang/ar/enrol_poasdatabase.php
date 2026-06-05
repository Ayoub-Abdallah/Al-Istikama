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
 * Strings for component 'enrol_poasdatabase', language 'ar', version '5.1'.
 *
 * @package     enrol_poasdatabase
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allow_reenabling_teachers'] = 'الإبقاء على انضمامات المعلمين';
$string['allow_unenrol_2nd_teachers'] = 'إلغاء انضمامات المعلمين غير ذي الصلة';
$string['dbencoding'] = 'ترميز قاعدة البيانات';
$string['dbhost'] = 'مضيف قاعدة البيانات';
$string['dbname'] = 'اسم قاعدة البيانات';
$string['dbname_desc'] = 'أتركه فارغًا إن كنت تستعمل اسم DSN في مضيف قاعدة البيانات.';
$string['dbpass'] = 'كلمة مرور قاعدة البيانات';
$string['dbsetupsql'] = 'أمر تنصيب قاعدة البيانات';
$string['dbsybasequoting'] = 'استعمل علامات اقتباس sybase';
$string['dbtype'] = 'مشغل قاعدة البيانات';
$string['dbtype_desc'] = 'اسم مشغل قاعدة بيانات ADOdb، وهو نوع محرك قاعدة البيانات الخارجية.';
$string['dbuser'] = 'مستخدم قاعدة البيانات';
$string['debugdb'] = 'كشف أخطاء ADOdb';
$string['debugdb_desc'] = 'كشف أخطاء اتصال ADOdb مع قاعدة البيانات الخارجية. يُستعمل عند تلقي صفحة فارغة خلال عملية تسجيل الدخول. غير مناسب مع المواقع الإنتاجية!';
$string['defaultcategory'] = 'التصنيف الافتراضي للمساق الجديد';
$string['defaultcategory_desc'] = 'التصنيف الافتراضي للمساقات المنشأة تلقائيًا. يُستعمل عند عدم تعيين قيمة في حقل مُعرَّف التصنيف أو تعذر العثور عليها.';
$string['defaultrole'] = 'الدور الافتراضي';
$string['defaultrole_desc'] = 'الدور الي سيتم إسناده افتراضيًا إذا لم يتم تحديد أي دور في الجدول الخارجي.';
$string['enableremovingduplicatecohorts'] = 'تمكين حذف الزمر المكررة المولدة عرضيًا نتيجة لتغييرات في الاسم/رقم المعرف في مصدر البيانات الخارجي';
$string['enableupdatingcohorts'] = 'عند تمكينه، سيتم تحديث الزمر الموجودة محليًا إذا تغيرت في المصدر الخارجي';
$string['enableupdatingcohorts_desc'] = 'سيتم تنفيذ التحديث في كل مرة عند مزامنة الزُمر.';
$string['extremovedcohortaction_desc'] = 'إختر الإجراء المطلوب تنفيذه عند اختفاء الزُمر من قاعدة البيانات الخارجية. يرجى ملاحظة أن إزالة العضوية من إحدى الزمر سيؤدي إلى إلغاء الانضمام إلى المساقات في بعض الإعدادات وكذلك بيانات المستخدمين الذين كانوا ضمن تلك الزمرة.';
$string['extuserremovedfromcohortaction'] = 'الإجراء المتخذ عند إزالة المستخدم من الزمرة في قاعدة البيانات الخارجية';
$string['ignorehiddencourses'] = 'تجاهل المساقات المخفية';
$string['ignorehiddencourses_desc'] = 'عند تمكينه، لن يتم ضم المستخدمين إلى المساقات التي تم ضبطها غير متاحة للطلاب.';
$string['keepenrolledcohorts'] = 'الإبقاء على الزُمر التي فيها انضمامات';
$string['keepenrolledcohorts_desc'] = 'هذا الإعداد يُستعمل إذا تم اختيار وضع حذف الزُمر عند اختفائها من المصدر الخارجي. عند تمكينه، الزُمر المنضمة إلى مساق واحد على الأقل لن يتم حذفها.';
$string['laggingcourseidnumberpattern'] = 'العمود المقابل لرقم مٌعرَّف المساق وفق المضاهاة';
$string['laggingexactcourseidnumber'] = 'العمود المقابل لرقم مٌعرَّف المساق';
$string['laggingstudentlogin'] = 'العمود المقابل لاسم دخول الطالب';
$string['laggingstudentlogin_desc'] = 'اسم العمود المقابل لاسم دخول الطالب في قاعدة البيانات الخارجية.';
$string['laggingstudentstable'] = 'جدول الطلاب المتأخر';
$string['localcategoryfield'] = 'حقل التصنيف المحلي';
$string['localcoursefield'] = 'حقل المساق المحلي';
$string['localrolefield'] = 'حقل الدور المحلي';
$string['localuserfield'] = 'حقل المستخدم المحلي';
$string['newcoursecategory'] = 'حقل التصنيف للمساق الجديد';
$string['newcoursefullname'] = 'حقل الاسم الكامل للمساق الجديد';
$string['newcourseidnumber'] = 'حقل رقم المعرَّف للمساق الجديد';
$string['newcourseshortname'] = 'حقل الاسم المختصر للمساق الجديد';
$string['newcoursetable'] = 'جدول المساقات الجديدة البعيد';
$string['option_cohortextremovedkeep'] = 'إبقاء الزُمر ذات الانضمامات';
$string['option_cohortextremovedsuspend'] = 'تعليق انضمامات المساق (مع إبقاء بيانات المستخدم)';
$string['option_cohortextremovedunenrol'] = 'إزالة الزُمر وإلغاء الانضمامات في المساقات بالكامل';
$string['option_usercohortextremovedkeep'] = 'الإبقاء في الزُمرة (إبقاء الانضمام)';
$string['option_usercohortextremovedsuspend'] = 'التعليق في كل المساقات (المحددة من قبل ملحق انضمامات الزُمر)';
$string['option_usercohortextremovedunenrol'] = 'إزالة من الزُمرة';
$string['pluginname'] = 'قاعدة البيانات الخارجية POAS';
$string['poasdatabase:config'] = 'تهيئة عينات الانضمام لقاعدة البيانات POAS';
$string['poasdatabase:unenrol'] = 'إلغاء انضمام المستخدمين المعلقين';
$string['remotecategoriestable'] = 'جدول التصنيف البعيد';
$string['remotecategoryidnumberfield'] = 'حقل رقم مُعرَّف التصنيف البعيد';
$string['remotecategorynamefield'] = 'حقل الاسم الكامل للتصنيف البعيد';
$string['remotecohortdescriptionfield'] = 'حقل وصف الزمرة البعيد';
$string['remotecohortidnumberfield'] = 'حقل رقم مُعرَّف الزمرة البعيد';
$string['remotecohortmemberrole'] = 'حقل دور الزمرة البعيد';
$string['remotecohortnamefield'] = 'حقل الاسم الكامل للزمرة البعيد';
$string['remotecohortstable'] = 'جدول الزُمر البعيد';
$string['remotecoursecohorttable'] = 'جدول تعيين الزُمر للمساقات البعيد';
$string['remotecoursefield'] = 'حقل المساق البعيد';
$string['remotecourseidnumberfield'] = 'حقل رقم مُعرَّف المساق البعيد';
$string['remoteenroltable'] = 'جدول انضمامات المستخدمين البعيد';
$string['remotegroupnamefield'] = 'حقل اسم المجموعة البعيد';
$string['remoteotheruserfield'] = 'حقل الاسم الآخر للمستخدم البعيد';
$string['remoterolefield'] = 'حقل الدور البعيد';
$string['remotetagtable'] = 'جدول الوسوم البعيد';
$string['remotetagtagnamefield'] = 'حقل اسم الوسم في جدول الوسوم';
$string['remoteusercohortcohortidnumberfield'] = 'حقل رقم مُعرَّف الزمرة في الجدول';
$string['remoteusercohorttable'] = 'جدول تعيين المستخدمين للزُمر البعيد';
$string['remoteusercohortuserloginfield'] = 'حقل دخول المستخدم في الجدول';
$string['remoteuserfield'] = 'حقل المستخدم البعيد';
$string['remoteuserfield_desc'] = 'اسم الحقل في الجدول البعيد الذي نستعمله لمطابقة الإدخالات في جدول المستخدمين.';
$string['settingsheadercoursecohort'] = 'انضمامات المساقات المبني على الزُمر';
$string['settingsheaderdb'] = 'اتصال قاعدة البيانات الخارجية';
