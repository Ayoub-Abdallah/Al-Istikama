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
 * Strings for component 'local_usertours', language 'ar', version '5.1'.
 *
 * @package     local_usertours
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actions'] = 'الإجراءات';
$string['appliesto'] = 'يطبق على';
$string['backdrop'] = 'إظهار مع الخلفية';
$string['backdrop_help'] = 'يمكنك استخدام خلفية لإبراز جزء الصفحة الذي تشير إليه.

ملاحظة: الخلفيات غير متوافقة مع بعض أجزاء الصفحة مثل شريط التنقل.';
$string['block'] = 'الكتلة';
$string['block_named'] = 'الكتلة المسماة \'{$a}\'';
$string['bottom'] = 'أسفل';
$string['confirmstepremovalquestion'] = 'هل أنت متأكد من رغبتك في حذف هذه الخطوة؟';
$string['confirmstepremovaltitle'] = 'تأكيد إزالة الخطوة';
$string['confirmtourremovalquestion'] = 'هل أنت متأكد من رغبتك في حذف هذه الجولة؟';
$string['confirmtourremovaltitle'] = 'تأكيد حذف الجولة';
$string['content'] = 'المحتوى';
$string['content_help'] = 'هذا هو مضمون الخطوة.
يمكنك إدخال محتوى بالتنسيقات التالية:
<dl>
    <dt>نص عادي</dt>
    <dd>وصف نص عادي</dd>
    <dt>متعدد اللغات لمودل</dt>
    <dd>جملة تستعمل تنسيق مودل لمتعدد اللغات</dd>
    <dt>جملة مودل المترجمة</dt>
    <dd>قيمة موجودة في ملف لغة مودل بالتنسيق: identifier,component</dd>
</dl>';
$string['cssselector'] = 'CSS محدد';
$string['defaultvalue'] = 'الافتراضي ({$a})';
$string['delay'] = 'مهلة التأخير قبل إظهار الخطوة';
$string['delay_help'] = 'يمكنك اختيارياً اختيار إضافة مهلة تأخير قبل عرض الخطوة.

هذه المهلة بالميلي ثانية.';
$string['description'] = 'الوصف';
$string['done'] = 'تم';
$string['editstep'] = 'تحرير "{$a}"';
$string['enabled'] = 'مُمَكَّن';
$string['endtour'] = 'إنهاء الجولة';
$string['exporttour'] = 'تصدير الجولة';
$string['importtour'] = 'استيراد جولة';
$string['left'] = 'اليسار';
$string['movestepdown'] = 'خطوة للأسفل';
$string['movestepup'] = 'أنقل الخطوة للأعلى';
$string['movetourdown'] = 'أنقل الجولة للأسفل';
$string['movetourup'] = 'أنقل الجولة للأعلى';
$string['name'] = 'الاسم';
$string['newstep'] = 'خطوة جديدة';
$string['newtour'] = 'إنشاء جولة جديدة';
$string['next'] = 'التالي';
$string['orphan'] = 'إظهار ما إذا كان الهدف غير موجود';
$string['orphan_help'] = 'إظهار الخطوة إذا تعذر العثور على الهدف في الصفحة.';
$string['pathmatch'] = 'تطبيق على مطابقة عنوان الرابط';
$string['pathmatch_help'] = 'سيتم عرض الجولات على أي صفحة يتطابق عنوان رابطها مع هذه القيمة.

يمكنك استعمال الحرف % كحرف بديل ليعني أي شيء.
تتضمن بعض الأمثلة على القيم:

* /my/% - لتتناسب مع لوحة التحكم
* /course/view.php؟id=2 - لتتناسب مع مساق معين
* /mod/forum/view.php% - لتتناسب مع قائمة مناقشة المنتدى
* /user/profile.php% - لتتناسب مع صفحة الملف الشخصي للمستخدم';
$string['pausetour'] = 'توقف مؤقت';
$string['placement'] = 'الموضع';
$string['placement_help'] = 'يمكنك وضع الخطوة فوق الهدف أو أسفله أو يساره أو يمينه.

أفضل الخيارات هي الجهة العلوية أو السفلية حيث يتناسبان بشكل أفضل مع شاشة الجوال.';
$string['pluginname'] = 'جولات المستخدم';
$string['reflex'] = 'الانتقال بالنقر';
$string['reflex_help'] = 'الانتقال للخطوة التالية عند النقر على الهدف.';
$string['resettouronpage'] = 'إعادة تعيين جولة المستخدم في هذه الصفحة';
$string['resumetour'] = 'استئناف';
$string['right'] = 'يمين';
$string['select_block'] = 'حدد الكتلة';
$string['select_targettype'] = 'ترتبط كل خطوة بجزء من الصفحة يجب عليك اختياره. لتسهيل ذلك، توجد عدة أنواع من الهدف لأنواع مختلفة من محتوى الصفحة.
<dl>
    <dt>كتلة</dt>
    <dd>اعرض الخطوة الموجودة بجوار أول كتلة مطابقة من النوع الموجود على الصفحة</dd>
    <dt>محدد</dt>
    <dd>تعد محددات CSS طريقة فعالة تسمح لك بتحديد أجزاء مختلفة من الصفحة بناءً على البيانات الوصفية المضمنة في الصفحة.</dd>
    <dt>اعرض في منتصف الصفحة</dt>
    <dd>بدلاً من ربط الخطوة بجزء معين من الصفحة ، يمكنك عرضها في منتصف الصفحة.</dd>
</dl>';
$string['selector_defaulttitle'] = 'أدخل عنوناً وصفياً';
$string['selectordisplayname'] = 'محدد CSS يطابق \'{$a}\'';
$string['selecttype'] = 'حدد نوع الخطوة';
$string['sharedtourslink'] = 'مستودع الجولات';
$string['skip'] = 'تخطى';
$string['target'] = 'الهدف';
$string['target_block'] = 'الكتلة';
$string['target_selector'] = 'المحدد';
$string['target_selector_targetvalue'] = 'محددات CSS';
$string['target_selector_targetvalue_help'] = 'يمكنك استخدام "محدد CSS" لاستهداف أي عنصر في الصفحة تقريبًا.

تعد محددات CSS قوية جدًا ويمكنك بسهولة العثور على أجزاء من الصفحة عن طريق إنشاء المحدد تدريجيًا.

تقدم موزيلا بعض [وثائق جيدة جدًا] (https://developer.mozilla.org/en/docs/Web/Guide/CSS/Getting_started/S
electors)
للمحددات التي قد تساعدك في بناء المحددات الخاصة بك.

ستجد أيضًا أن أدوات مطور المستعرض الخاص بك مفيدة للغاية في إنشاء هذه المحددات:

* [متصفح جوجل كروم] (https://developer.chrome.com/devtools#dom-and-styles)
* [متصفح موزيلا فيرفوكس] (https://developer.mozilla.org/en-US/docs/Tools/DOM_Property_Viewer)
* [متصفح مايكروسوفت ايدج] (https://developer.microsoft.com/en-us/microsoft-edge/platform/documentation/f12-devtools-guide/)
* [متصفح سفاري] (https://developer.apple.com/library/iad/documentation/AppleApplications/Conceptual/Safari_Developer_Guide/ResourcesandtheDOM/ResourcesandtheDOM.html#//apple_ref/doc/uid/TP40007874-CH3-SW1)';
$string['target_unattached'] = 'العرض فى منتصف الصفحة';
$string['targettype'] = 'نوع الهدف';
$string['title'] = 'العنوان';
$string['title_help'] = 'هذا هو العنوان الظاهر أعلى الخطوة.
يمكنك إدخال العنوان بالتنسيقات الآتية:
<dl>
    <dt>نص عادي</dt>
    <dd>وصف نص عادي</dd>
    <dt>متعدد اللغات لمودل</dt>
    <dd>جملة تستعمل تنسيق مودل لمتعدد اللغات</dd>
    <dt>جملة مودل المترجمة</dt>
    <dd>قيمة موجودة في ملف لغة مودل بالتنسيق: identifier,component</dd>
</dl>';
$string['top'] = 'أعلى';
$string['tourconfig'] = 'ملف تهيئة الجولة المزمع استيرادها';
$string['tourlist_explanation'] = 'يمكنك إنشاء أي عدد من الجولات كما تريد وتمكينها لأجزاء مختلفة من مودل. يمكن إنشاء جولة واحدة فقط لكل صفحة.';
$string['tours'] = 'الجولات';
$string['usertours'] = 'جولات المستخدم';
$string['viewtour_info'] = 'هذه هي الجولة \'{$a->tourname}\'. إنها تطبق على المسار \'{$a->path}\'.';
