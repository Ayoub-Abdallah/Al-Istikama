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
 * Strings for component 'tool_catalogue', language 'ar', version '5.1'.
 *
 * @package     tool_catalogue
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aboutthiscourse'] = 'عن هذا المساق';
$string['aboutthisprogram'] = 'حول هذا البرنامج';
$string['all'] = 'الكل';
$string['allavailablecourses'] = 'كل المساقات المتاحة';
$string['allowhtmltags'] = 'السماح بعلامات HTML';
$string['aria:courseactions'] = 'إجراءات المساق';
$string['cachedef_filters'] = 'تعلم نتائج البحث في الكتالوج والمرشحات';
$string['catalogue'] = 'فهرس';
$string['catalogue:config'] = 'تكوين كتالوج التعلم';
$string['catalogueisdisabled'] = 'تم تعطيل كتالوج التعلم';
$string['cataloguesettings'] = 'إعدادات برامجي وفهرس مساقاتي';
$string['categories'] = 'فئات';
$string['categoriesdepthlimit'] = 'الحد الأقصى لعدد مستويات الفئات المتداخلة';
$string['categoriesdepthlimit_desc'] = 'العدد الأقصى لمستويات التصنيف المتداخلة في منتقي التصنيفات. ستظل المساقات الموجودة في المستويات الأعمق ظاهرة في نتائج البحث.';
$string['categorieslimit'] = 'الحد الأقصى لعدد الفئات ذات المستوى نفسه';
$string['categorieslimit_desc'] = 'العدد الأقصى من التصنيفات التي بنفس المستوى في منتقي التصنيفات. سيتم عرض التصنيفات بنفس الترتيب المحدد لها في صفحة إدارة المساقات. إذا كان هناك المزيد من التصنيفات في مستوى واحد، لن يتم إظهار التصنيفات في المنتقي ولكن ستكون كل المساقات مرئية في نتائج البحث.';
$string['certifications'] = 'الشهادات';
$string['certificationstatuscertified'] = 'اكتملت الشهادة \'<strong>{$a->name}</strong>\'';
$string['certificationstatuscertifiedwithdate'] = 'اكتملت الشهادة \'<strong>{$a->name}</strong>\'. ستنتهي صلاحيته في \'<strong>{$a->date}</strong>\'';
$string['certificationstatusexpired'] = 'انتهت صلاحية الشهادة \'<strong>{$a->name}</strong>\' في {$a->date}';
$string['certificationstatusopen'] = 'الشهادة \'<strong>{$a->name}</strong>\' ليس لها تاريخ استحقاق';
$string['certificationstatusopenwithdate'] = 'أكمل هذا البرنامج بحلول \'<strong>{$a->date}</strong>\' للحصول على الشهادة \'<strong>{$a->name}</strong>\'';
$string['certificationstatusoverdue'] = 'كانت الشهادة "<strong>{$a->name}</strong>" مستحقة في "<strong>{$a->date}</strong>"';
$string['clearall'] = 'امسح الكل';
$string['complete'] = 'مكتمل';
$string['completeatleast'] = 'أكمل {$a} على الأقل';
$string['coursecoverhelp'] = 'هذا المساق هو جزء من برنامج \'{$a}\'';
$string['coursecoverhelpmultiprogram'] = 'هذا المساق هو جزء من بعض البرامج';
$string['coursecoverhelptext'] = '<ul><li>هذا مجرد مساق واحد ضمن برامج أكبر</li><li>قد تتوفر مساقات جديدة بعد إكمال هذ المساق</li></ul>';
$string['coursedisplayduelimit'] = 'عرض الأيام المتبقية للمساقات';
$string['coursedisplayduelimit_desc'] = 'عدد الأيام التي سيرى المستخدمون بدءًا منها تذكيرًا صغيرًا (كذا يوم بقيت) بجوار اسم المقرر. على سبيل المثال، إذا تم ضبطه على 14، سيكون التذكير مرئيًا خلال 14 يومًا قبل وصول المساق إلى إلى تاريخ اختتامه. في حالة وجود العديد من تواريخ الانتهاء المختلفة، سيقوم النظام بتقييم أي منها هو الأقرب. اضبطه على 0 لتعطيل هذه الوظيفة.';
$string['coursefiles'] = 'ملفات المساق';
$string['courseimage_help'] = 'صورة المساق.';
$string['coursenotavailable'] = 'المساق غير متاح';
$string['courses'] = 'المساقات';
$string['coursesperpage_frontpage'] = 'عدد المساقات لكل صفحة، الصفحة الرئيسية للموقع';
$string['coursesperpage_frontpage_desc'] = 'عدد المساقات التي سيتم عرضها في الصفحة الرئيسية للموقع عند تضمين "قائمة المساقات" في إعداد عناصر الصفحة الرئيسية للموقع.';
$string['coursesperpage_main'] = 'عدد المساقات لكل صفحة، صفحة الفهرس الرئيسية';
$string['coursesperpage_main_desc'] = 'عدد المساقات التي سيتم عرضها في صفحة الفهرس الرئيسية قبل تحديد التصنيف أو تقديم استعلام البحث وقبل تطبيق أي مرشحات.';
$string['coursesperpage_search'] = 'عدد المساقات لكل صفحة، نتائج البحث';
$string['coursesperpage_search_desc'] = 'عدد المقررات الدراسية التي سيتم عرضها في نتائج بحث المقررات الدراسية أو عند تحديد الفئة.';
$string['dates'] = 'مواعيد';
$string['daysleft'] = 'متبقي {$a} يوم';
$string['defaultsortorder'] = 'ترتيب الافتراضي';
$string['display'] = 'عرض';
$string['displaycourseinfomodal'] = 'عرض نموذج معلومات المساق';
$string['displayfields_desc'] = 'يرجى تحديد كافة الحقول التي تريد عرضها كمرشحات وترتيبها بالترتيب المناسب. لا يمكن استخدام كافة أنواع الحقول المخصصة في عوامل التصفية.<br>يتم حفظ التغييرات في الجدول أعلاه تلقائيًا.';
$string['displayfields_list'] = 'الحقول المطلوب عرضها في طريقة العرض "القائمة" (detailed) لكتالوج التعلم';
$string['displayfields_tiles'] = 'الحقول المطلوب عرضها في طريقة العرض "المربعة" (compact) لكتالوج التعلم';
$string['displayforeverybody'] = 'عرض للجميع';
$string['displayfornotadmin'] = 'العرض فقط للمستخدمين غير الإداريين';
$string['displayforstudentsandguests'] = 'يتم العرض فقط أثناء وصول الضيوف وللطلاب';
$string['displaynever'] = 'لا تعرض أبدًا
';
$string['displayprogramcoverpage'] = 'عرض صفحة غلاف البرنامج';
$string['displaysummaryasis'] = 'عرض كما هو';
$string['displaysummarynohtml'] = 'عرض بدون HTML';
$string['displaysummarynone'] = 'لا تعرض';
$string['dontshowagain'] = 'لا تظهر هذه الرسالة مرة أخرى';
$string['duedate'] = 'الترتيب حسب تاريخ الانتهاء';
$string['duedateinfo'] = 'مستحق في 1 يوم';
$string['duedateinfodays'] = 'مستحق خلال {$a} من الأيام';
$string['duedatex'] = '<strong>تاريخ التسليم:</strong> {$a}';
$string['enablelearningcatalogue'] = 'تمكين كتالوج التعلم';
$string['enablelearningcatalogue_desc'] = 'قم بتمكين كتالوج التعلم في هذا الموقع.';
$string['enddate'] = 'تاريخ الانتهاء';
$string['enddatex'] = '<strong>تاريخ الانتهاء:</strong> {$a}';
$string['errornopermissionviewcoursecover'] = 'لا صلاحية لمعاينة صفحة غلاف المساق';
$string['errornopermissionviewprogram'] = 'لا يوجد إذن لعرض البرنامج';
$string['filterfields'] = 'الحقول المطلوب عرضها في مرشح كتالوج التعلم';
$string['hiddenfromlearners'] = 'مخفية عن المتعلمين';
$string['htmltagsall'] = 'السماح بأي علامات HTML';
$string['htmltagsnone'] = 'تجريد كافة علامات HTML';
$string['htmltagssafe'] = 'علامات HTML الآمنة فقط';
$string['incomplete'] = 'غير مكتمل';
$string['information'] = 'المعلومات';
$string['iunderstand'] = 'أنا أفهم';
$string['lastaccess'] = 'الفرز حسب آخر وصول';
$string['mycourses'] = 'مساقاتي';
$string['name'] = 'الفرز حسب الاسم';
$string['noresultsfor'] = 'لا نتائج بالنسبة إلى \'{$a}\'';
$string['proceedtocourse'] = 'المواصلة إلى محتويات المقرر';
$string['proceedtoprogram'] = 'المتابعة إلى محتوى البرنامج';
$string['program'] = 'البرنامج';
$string['programhelptext'] = '<ul><li>قد تحتوي البرامج التعليمية على أكثر من مساق</li><li>أكمل المساقات لإكمال البرنامج التعليمي</li></ul>';
$string['programhelptitle'] = 'ما هو البرنامج؟';
$string['programlink'] = 'أنظر تفاصيل "{$a}"';
$string['programlinksingle'] = 'أنظر تفاصيل البرنامج';
$string['programs'] = 'البرامج';
$string['programstructure'] = 'هيكل البرنامج';
$string['progress'] = '{$a}% اكتملت';
$string['progresscompleted'] = '{$a->completed} من {$a->total} اكتملت';
$string['recentlyaccessedcourses'] = 'المساقات التي تم الوصول إليها مؤخرًا';
$string['todo'] = 'للقيام به:';
$string['trydifferentskeyword'] = 'حاول استعمال كلمات مفتاحية مختلفة أو معايير تصفية أخرى';
