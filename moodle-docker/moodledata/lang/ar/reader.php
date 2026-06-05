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
 * Strings for component 'reader', language 'ar', version '5.1'.
 *
 * @package     reader
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activemessages'] = 'الرسائل النشطة';
$string['addbookinstance'] = 'إضافة المزيد من الكتب إلى هذا المساق';
$string['adjustscores'] = 'تعديل الدرجات';
$string['all'] = 'الكل';
$string['attempts'] = 'محاولات';
$string['attemptscoremanagement'] = 'إدارة المحاولات والدرجات';
$string['blockquizattempts'] = 'منع المزيد من محاولات الاختبار';
$string['bookcovers_help'] = '**نعم**
: إظهار أغلفة الكتاب في الصفحة الرئيسية لنشاط القارئ هذا.

**لا**
: عدم إظهار أغلفة الكتاب في الصفحة الرئيسية لنشاط القارئ هذا.';
$string['bookhasnoquiz'] = 'ليس في هذا الكتاب إختبار.';
$string['bookquiznumber'] = 'رقم إختبار الكتاب';
$string['booksaddbook'] = 'إضافة كتاب جديد';
$string['bookswithoutquizzes'] = 'الكتب التي بدون إختبارات';
$string['bookswithquizzes'] = 'الكتب ذات إختبارات';
$string['booktitle'] = 'عنوان الكتاب';
$string['cannotaccesscourse'] = 'عذرًا، ليس لديك صلاحية إدارة النشاطات في المساق"{$a}".';
$string['changequiz'] = 'تغيير الاختبار';
$string['configintro'] = 'القيم التي تعينها هنا تمثل القيم الافتراضية المستعملة في نموذج الإعدادات عندما تنشئ نشاط قارئ جديد.

يمكنك أيضاً تعيين إعدادات القارئ التي تُعتبر متقدمة.';
$string['confirmstarttimelimit'] = 'هذا الاختبار له وقت محدد. هل أنت متأكد أنك تريد بدأ الاختبار؟';
$string['defaultquestioncategoryinfo'] = 'أسئلة {$a->category} في {$a->quiz}';
$string['delayquizattempts'] = 'تأخير محاولات الاختبار الإضافية';
$string['deletemessages'] = 'حذف رسائل القارئ';
$string['deletemessages_help'] = 'سيتم حذف كل الرسائل التي تظهر في صفحة الطلاب الرئيسية لنشاطات القارئ.';
$string['downloadbookswithoutquizzes'] = 'تنزيل بيانات الكتاب (بدون الاختبارات)';
$string['downloadbookswithquizzes'] = 'تنزيل بيانات الكتاب والاختبارات';
$string['editquiztoreader'] = 'حذف الاختبارات';
$string['event_attempt_added'] = 'محاولة اختبار قارئ تم بدؤها';
$string['event_attempt_added_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" بدأ محاولة اختبار لنشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_attempt_added_explanation'] = 'مستخدم ما بدأ توًا محاولة في اختبار القارئ';
$string['event_attempt_deleted'] = 'محاولة اختبار قارئ تم حذفها';
$string['event_attempt_deleted_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بحذف محاولة اختبار لنشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_attempt_deleted_explanation'] = 'مستخدم ما قام توًا بحذف محاولة في اختبار القارئ';
$string['event_attempt_edited'] = 'محاولة اختبار قارئ تم تحريرها';
$string['event_attempt_edited_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بتحرير محاولة اختبار لنشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_attempt_edited_explanation'] = 'مستخدم ما قام توًا بتحرير محاولة في اختبار القارئ';
$string['event_attempt_submitted'] = 'محاولة اختبار قارئ تم تسليمها';
$string['event_attempt_submitted_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بتسليم محاولة اختبار لنشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_attempt_submitted_explanation'] = 'مستخدم ما قام توًا بتسليم محاولة في اختبار القارئ';
$string['event_base'] = 'حدث قارئ تم كشفه';
$string['event_base_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام ببدء حدث في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_base_explanation'] = 'حدث تم اكتشافه من قِبل وحدة القارئ';
$string['event_book_added'] = 'كتاب قارئ تمت إضافته';
$string['event_book_added_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بإضافة كتاب في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_book_added_explanation'] = 'مستخدم ما قام توًا بإضافة بيانات عن كتاب قارئ';
$string['event_book_deleted'] = 'كتاب قارئ تم حذفه';
$string['event_book_deleted_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بحذف كتاب من نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_book_deleted_explanation'] = 'مستخدم ما قام توًا بحذف بيانات عن كتاب قارئ';
$string['event_book_edited'] = 'كتاب قارئ تم تحريره';
$string['event_book_edited_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بتحرير كتاب في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_book_edited_explanation'] = 'مستخدم ما قام توًا بتحرير بيانات عن كتاب قارئ';
$string['event_books_downloaded'] = 'كتب قارئ تم تنزيلها';
$string['event_books_downloaded_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بتنزيل كتب من نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_books_downloaded_explanation'] = 'مستخدم ما قام توًا بتنزيل بيانات عن كتب قارئ';
$string['event_cron_run'] = 'وظيفة قارئ الدورية تم تشغيلها';
$string['event_cron_run_description'] = 'وظيفة قارئ الدورية تم تشغيلها';
$string['event_cron_run_explanation'] = 'وظيفة قارئ الدورية تم توًا تشغيلها';
$string['event_downloads_viewed'] = 'تنزيلات قارئ تمت معاينتها';
$string['event_downloads_viewed_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" شاهد بيانات عن تنزيلات نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_downloads_viewed_explanation'] = 'مستخدم ما قد شاهد توًا بيانات عن تنزيلات القارئ';
$string['event_message_added'] = 'رسالة قارئ تمت إضافتها';
$string['event_message_added_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بإضافة رسالة في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_message_added_explanation'] = 'مستخدم ما قد أضاف توًا رسالة إلى نشاط القارئ';
$string['event_message_deleted'] = 'رسالة قارئ تم حذفها';
$string['event_message_deleted_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بحذف رسالة في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_message_deleted_explanation'] = 'مستخدم ما قام توًا بحذف رسالة من نشاط القارئ';
$string['event_message_edited'] = 'رسالة قارئ تم تحريرها';
$string['event_message_edited_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بتحرير رسالة في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_message_edited_explanation'] = 'مستخدم ما قام توًا بتحرير رسالة في نشاط القارئ';
$string['event_quiz_added'] = 'اختبار قارئ تمت إضافته';
$string['event_quiz_added_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بإضافة اختبار في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_quiz_added_explanation'] = 'قام مستخدم ما تواً بإضافة اختبار إلى نشاط القارئ';
$string['event_quiz_delay_set'] = 'تأخير اختبار قارئ تم ضبطه';
$string['event_quiz_delay_set_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بضبط تأخير اختبار في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_quiz_delay_set_explanation'] = 'مستخدم ما قام توًا بوضع تأخير في اختبار قارئ';
$string['event_quiz_deleted'] = 'اختبار قارئ تم حذفه';
$string['event_quiz_deleted_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بحذف اختبار في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_quiz_deleted_explanation'] = 'مستخدم ما قام توًا بحذف اختبار قارئ';
$string['event_quiz_edited'] = 'اختبار قارئ تم تحديثه';
$string['event_quiz_edited_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بتحرير اختبار في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_quiz_edited_explanation'] = 'مستخدم ما قام توًا بتحرير اختبار قارئ';
$string['event_quiz_finished'] = 'اختبار قارئ تم إنهاؤه';
$string['event_quiz_finished_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بإنهاء اختبار في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_quiz_finished_explanation'] = 'مستخدم ما قام توًا بإنهاء اختبار قارئ';
$string['event_quiz_selected'] = 'اختبار قارئ تم تحديده';
$string['event_quiz_selected_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بتحديد اختبار في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_quiz_selected_explanation'] = 'مستخدم ما قام توًا بتحديد اختبار قارئ';
$string['event_quiz_started'] = 'اختبار قارئ تم بدؤه';
$string['event_quiz_started_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام ببدء اختبار في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_quiz_started_explanation'] = 'مستخدم ما قام توًا ببدأ اختبار قارئ';
$string['event_report_bookdetailed_viewed'] = 'تقرير قارئ تمت معاينته: الكتب (مفصل)';
$string['event_report_bookdetailed_viewed_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" شاهد تقرير "الكتب (مفصل)" لنشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_report_bookdetailed_viewed_explanation'] = 'مستخدم ما قد شاهد توًا تقرير القارئ: الكتب (مفصل)';
$string['event_report_booksummary_viewed'] = 'تقرير قارئ تمت معاينته: الكتب (ملخص)';
$string['event_report_booksummary_viewed_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" شاهد تقرير "الكتب (ملخص)" لنشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_report_booksummary_viewed_explanation'] = 'مستخدم ما قد شاهد توًا تقرير القارئ: الكتب (ملخص)';
$string['event_report_groups_viewed'] = 'تقرير قارئ تمت معاينته: المجموعات (ملخص)';
$string['event_report_groups_viewed_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" شاهد تقرير "المجموعات (ملخص)" لنشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_report_groups_viewed_explanation'] = 'مستخدم ما قد شاهد توًا تقرير القارئ: المجموعات (ملخص)';
$string['event_report_userdetailed_viewed'] = 'تقرير قارئ تمت معاينته: المستخدمون (مفصل)';
$string['event_report_userdetailed_viewed_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" شاهد تقرير "المستخدمون (مفصل)" لنشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_report_userdetailed_viewed_explanation'] = 'تقرير قارئ تمت معاينته: المستخدمون (مفصل)';
$string['event_report_usersummary_viewed'] = 'تقرير قارئ تمت معاينته: المستخدمون (ملخص)';
$string['event_report_usersummary_viewed_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" شاهد تقرير "المستخدمون (ملخص)" لنشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_report_usersummary_viewed_explanation'] = 'تقرير قارئ تمت معاينته: المستخدمون (ملخص)';
$string['event_tool_run'] = 'أداة إدارة القارئ تم تشغيلها';
$string['event_tool_run_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بتشغيل أداة الإدارة في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_tool_run_explanation'] = 'مستخدم ما قام توًا بتشغيل أداة قارئ: {$a}';
$string['event_user_goal_set'] = 'هدف قراءة للطالب تم وضعه';
$string['event_user_goal_set_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بوضع هدف قراءة للطالب في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_user_goal_set_explanation'] = 'مستخدم ما قام توًا بوضع هدف قراءة للطالب في نشاط القارئ';
$string['event_user_level_set'] = 'مستوى قراءة للطالب تم وضعه';
$string['event_user_level_set_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بوضع مستوى قراءة للطالب في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_user_level_set_explanation'] = 'مستخدم ما قام توًا بوضع مستوى قراءة للطالب في نشاط القارئ';
$string['event_users_exported'] = 'مستخدو القارئ تم تصديرهم';
$string['event_users_exported_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام بتصدير بيانات الطالب في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_users_exported_explanation'] = 'مستخدم ما قام توًا بتصدير بيانات الطالب في نشاط القارئ';
$string['event_users_imported'] = 'مستخدو القارئ تم استيرادهم';
$string['event_users_imported_description'] = 'المستخدم ذو المُعرَّف "{$a->userid}" قام باستيراد بيانات الطالب في نشاط "القارئ" ضمن وحدة المساق ذات المُعرَّف "{$a->cmid}"';
$string['event_users_imported_explanation'] = 'مستخدم ما قام توًا باستيراد بيانات الطالب في نشاط القارئ';
$string['fix_slashesinnames'] = 'إصلاح الشطبات المائلة في الأسماء';
$string['fix_slashesinnames_desc'] = 'إزالة أي شطبات مائلة من أسماء كتب القارئ وأصناف الأسئلة.';
$string['fixquizslots'] = 'تصحيح فسحات الاختبار الخاطئة في محاولات الاختبار';
$string['fixslashesinnames'] = 'إزالة الشُرط المائلة من عناوين الكتب';
$string['fullreportbybooktitle'] = 'التقرير الكامل حسب عنوان الكتاب';
$string['getstarted'] = '**كيفية البدء**

* هدف هذا النشاط هو قراءة الكثير من الكتب لبناء حصيلة قراءتك الإجمالية.
* حصيلة قراءتك الإجمالية هي إجمالي عدد الكلمات في كل الكتب التي قرأتها.

**إختيار الكتاب**

* ينبغي عليك إختيار الكتب التي تستطيع قراءتها بسهولة دون الحاجة إلى استعمال القاموس.
* كذلك، حاول اختيار الكتب التي تستهويك لأنها ستكون ممتعة أكثر عند قراءتها.

**المشاركة في الاختبار عبر الإنترنت**

* بعد قراءتك لكتاب ما، شارك في اختبار عبر الإنترنت.
* استعمل مربعات البحث في هذه الصفحة للعثور على الاختبار الذي تريده. بعد العثور عليه، أنقر الزر لبدئه.
* هناك أسئلة متعددة في كل اختبار عن الكتاب الذي قرأته. تكون الأسئلة مختلفة لكل طالب.
* إذا تمكنت من اجتياز الاختبار، سيضاف عدد كلمات الكتاب إلى إجمالي القراءة عندك. إذا فشلت في الاختبار لن يتغير ذلك الإجمالي.
* ***لا يمكنك إعادة الاختبارات***، لذلك من فضلك، حضِّر للاختبارات بعناية.';
$string['includepublishers'] = 'أتريد البحث في أسماء الناشرين أيضًا؟';
$string['incorrect'] = '- خطأ';
$string['levelcheck_help'] = '**نعم**
: سيُسمح للطلاب فقط بالمشاركة في اختبارات القارئ بالنسبة إلى الكتب التي عند مستوى قراءتهم الحالي أو قريبًا منه. عدد الاختبارات التي يُسمح للطلاب بالمشاركة فيها محدد في إعدادات هذه الصفحة عند "الاختبارات في المستوى الحالي/السابق/اللاحق"

**لا**
: سيُسمح للطلاب دائمًا بالمشاركة في اختبارات القارئ بالنسبة إلى الكتب التي عند أي مستوى قراءة.';
$string['mainpagesettings'] = 'إعدادات الصفحة الرئيسية';
$string['maxquizattemptrate'] = 'أقصى معدل لمحاولات الاختبار';
$string['maxquizfailurerate'] = 'أقصى معدل للفشل في الاختبار';
$string['minpassgrade_help'] = 'أدنى تقدير للنجاح، كنسبة مئوية، للاختبارات في نشاط القارئ هذا.

المحاولات ذات النسبة المئوية الأدنى من هذه القيمة ستعتبر فاشلة.';
$string['minquizattemptrate'] = 'أدنى معدل لمحاولات الاختبار';
$string['modulename_link'] = 'mod/reader/view';
$string['newsetting'] = 'القيمة الجديدة لهذا الإعداد';
$string['noreview'] = 'ليس مسموحًا لك بمراجعة هذا الاختبار';
$string['nothavepermissioncreateinstance'] = 'عذرًا، ليست لديك صلاحية القيام بذلك';
$string['pagesettings'] = 'إعدادات الصفحة';
$string['process_addquestion'] = '<b>إضافة الأسئلة إلى الاختبار {$a}.</b><br />';
$string['questionscores'] = 'إظهار درجات الأسئلة';
$string['quizattemptinprogress'] = 'محاولة الاختبار قيد التنفيذ ...';
$string['quizfordays'] = 'تقييد التكرار (بالأيام)';
$string['quizhasnoquestions'] = 'الاختبار ليس فيه أسئلة';
$string['quizzes'] = 'الاختبارات';
$string['quizzesadd'] = 'إضافة الاختبارات';
$string['quizzesadded'] = 'تمت إضافة الاختبارات';
$string['quizzesarrange'] = 'ترتيب الاختبارات';
$string['quizzesdelete'] = 'حذف الاختبارات';
$string['reader:addinstance'] = 'إضافة نشاط قارئ جديد';
$string['reader:manageremotesites'] = 'إدارة المواقع البعيدة';
$string['readonlymode_desc'] = 'هذا النشاط بوضع القراءة فقط حاليًا. يمكنك معاينة المعلومات في الصفحة الأولى من نشاط القارئ هذا، ولكنك لا تستطيع محاولات أي من اختبارات القارئ.';
$string['reports'] = 'تقارير';
$string['reportuserdetailed'] = 'الطلاب (كاملاً)';
$string['reportusersummary'] = 'الطلاب (ملخص)';
$string['returntocoursepage'] = 'عودة إلى صفحة المساق';
$string['returntostudentlist'] = 'عودة إلى قائمة الطلاب';
$string['rowsperpage'] = 'الصفوف لكل صفحة';
$string['search_help'] = 'للبحث عن كتاب بعينه، أدخل نصًا ما يتضمنه عنوان الكتاب ثم انقر زر "إذهب"';
$string['setname'] = 'تعيين عنوان الكتاب';
$string['settings'] = 'إعدادت';
$string['show'] = 'عرض';
$string['showall'] = 'عرض الكل';
$string['showdeleted'] = 'عرض المحاولات المحذوفة';
$string['showhide'] = 'عرض/اخفاء';
$string['showhidebook'] = 'عرض أو اخفاء';
$string['showpercentgrades_help'] = '**نعم **
: عرض الدرجة (كنسبة مئوية) لكل محاولة في اختبار القارئ

**لا**
: لا تظهر درجات المحاولات الفردية في اختبار القارئ';
$string['showprogressbar_help'] = '**نعم**
: إظهار شريط التقدم لعداد الكلمات في الصفحة الرئيسية لنشاط القارئ هذا

**لا**
: عدم إظهار شريط التقدم لعداد الكلمات في الصفحة الرئيسية لنشاط القارئ هذا';
$string['starteditcourse'] = '**كيفية البدء**

في هذه الصفحة يمكنك تحرير وإزالة كتب القارئ المتاحة في هذا المساق. يمكنك أيضًا جعل كتب جديدة أخرى متاحة في هذا المساق ما دام قد سبق تنزيلها إلى موقع مودل هذا باستعمال صفحات التنزيل.';
$string['starteditsite'] = '**كيفية البدء**

في هذه الصفحة يمكنك تحرير وإزالة كتب القارئ في موقع مودل هذا. من أجل إضافة كتب القارئ الجديدة إلى هذا الموقع، يرجى استعمال صفحات التنزيل.';
$string['studentmanagement'] = 'إدارة الطلاب';
$string['studentuserid'] = 'مُعرَّف المستخدم للطالب';
$string['studentusername'] = 'اسم المستخدم للطالب';
$string['studentview'] = 'ما يعاينه الطالب';
$string['summaryreportbybooktitle'] = 'التقرير الموجز حسب عنوان الكتاب';
$string['thisattempt'] = 'هذه المحاولة';
$string['thisblockunavailable'] = 'هذه الكتلة غير متاحة حاليًا لهذا الطالب';
$string['timefinish'] = 'وقت الانتهاء';
$string['timeleft'] = 'الوقت المتبقي';
$string['timestart'] = 'وقت البدء';
$string['to'] = 'إلى';
$string['tools'] = 'أدوات';
$string['updatequizzes'] = 'تحديث الاختبارات';
$string['uploaddatanoquizzes'] = 'تنزيل بيانات الكتب التي ليس لها اختبارات';
$string['uploadquiztoreader'] = 'تنزيل الاختبارات من قاعدة بيانات قارئ الاختبارات';
$string['usedefaultquizid'] = 'استعمل دائماً الاختبار الافتراضي';
$string['valueoutofrange'] = 'هذه القيمة ينبغي أن تكون بين {$a->min} و {$a->max}';
$string['windowclosing'] = 'هذه النافذة ستُغلق قريباً';
$string['withoutdayfilter'] = 'بدون ترشيح اليوم';
$string['youcantakeaquizafter'] = 'يمكنك أخذ إختبارك التالي بعد {$a}';
$string['youcantakeaquiznow'] = 'يمكنك أخذ الاختبار الآن.';
$string['youcantakeasmanyquizzesasyouwant'] = 'يمكنك أخذ أي عدد تريده من الاختبارات عند المستوى {$a}.';
