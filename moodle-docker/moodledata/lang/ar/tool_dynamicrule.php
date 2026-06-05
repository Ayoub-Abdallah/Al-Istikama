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
 * Strings for component 'tool_dynamicrule', language 'ar', version '5.1'.
 *
 * @package     tool_dynamicrule
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['active'] = 'فعال';
$string['activerules'] = 'قواعد التفعيل';
$string['addcondition'] = 'إضافة الشرط';
$string['addconditions'] = 'إضافة الشرط الى القواعد';
$string['addoutcome'] = 'إضافة الاجراء';
$string['addoutcomes'] = 'إضافة الإجرائات للقواعد';
$string['archive'] = 'الأرشفة';
$string['archived'] = 'مؤرشف';
$string['archivedrules'] = 'قواعد الأرشفة';
$string['availableplaceholders'] = 'العناصر النائبة المتاحة';
$string['body'] = 'نص مطبوع';
$string['cannotenablerule'] = 'لا يمكن تمكين القاعدة
 \'{$a}\'
إلا إذا كانت تحتوي على شروط وإجراءات ولا تحتوي على أي أخطاء';
$string['cohort'] = 'مجموعة';
$string['conditioncohortmember'] = 'المستخدم هو عضو في المجموعة';
$string['conditioncohortmemberdescription'] = 'المستخدمون الأعضاء في المجموعة  \'{$a}\\';
$string['conditioncohortnotmember'] = 'المستخدم ليس عضوًا في الدفعة';
$string['conditioncohortnotmemberdescription'] = 'المستخدم ليس عضوًا في الدفعة \'{$a}\'';
$string['conditioncoursecompleted'] = 'اكتمال المساق';
$string['conditioncoursecompleteddescription'] = 'المستخدمون الذين أكملوا المساق  \'{$a}\\';
$string['conditioncoursenotcompleted'] = 'لم يتم اكمال المساق';
$string['conditioncoursenotcompleteddescription'] = 'المستخدمون الذين لم يكملوا المساق  \'{$a}\\';
$string['conditionisbroken'] = 'يحتوي هذا الشرط على خطأ';
$string['conditionnotsaved'] = 'لم يتم حفظ الشرط';
$string['conditions'] = 'الشروط';
$string['conditionuserenrolled'] = 'تم تسجيل المستخدم';
$string['conditionuserenrolleddescription'] = 'المستخدمون المسجلون في المساق';
$string['conditionuserlastlogin'] = 'أخر ظهور للمستخدم';
$string['conditionuserlastlogindescriptionbefore'] = 'المستخدمون الذين سجلوا آخر دخول منذ {$a}';
$string['conditionuserlastlogindescriptionever'] = 'المستخدمين الذين قاموا بتسجيل الدخول مرة واحدة على الأقل';
$string['conditionuserlastlogindescriptioninlast'] = 'المستخدمون الذين سجلوا آخر مرة في آخر
 {$a}';
$string['conditionuserlastlogindescriptionnever'] = 'المستخدمين الذين لم يسجلوا الدخول';
$string['conditionusernotenrolled'] = 'المستخدم غير مسجل';
$string['conditionusernotenrolleddescription'] = 'المستخدمون الذين لم يتم تسجيلهم في المساق \'{$a->course}\\';
$string['conditionuserprofilefield'] = 'حقل ملف تعريف المستخدم';
$string['confirmarchiverule'] = 'هل أنت متأكد من أنك تريد أرشفة القاعدة \'{$a}\'؟ ستظل القواعد الفعالة المؤرشفة متاحة للتقارير الحالية والمستقبلية.';
$string['confirmdeletecondition'] = 'هل أنت متأكد من أنك حذف الشرط \'{$a}\' وجميع البيانات المرتبطة؟ لا يمكن التراجع عن هذا الإجراء.';
$string['confirmdeleteoutcome'] = 'هل  أنت متأكد من حذف الإجراء \'{$a}\'
 وجميع البيانات المرتبطة به؟ لا يمكن التراجع عن هذا الإجراء';
$string['confirmdeleterule'] = 'هل أنت متأكد من حذف القاعدة
 \'{$a}\' وجميع البيانات المرتبطة؟ لا يمكن التراجع عن هذا الإجراء.';
$string['confirmduplicaterule'] = 'هل تريد بالتأكيد تكرار القاعدة
 \'{$a}\'؟';
$string['confirmenablerule'] = 'هل أنت متأكد من تمكين هذه القاعدة؟ سيؤثر تمكينها على
 {$a} المستخدمين';
$string['countmatchingusers'] = '{$a} إجمالي المطابقات';
$string['courseinternalid'] = 'معرف المساق الداخلي للمستخدم في عناوين
URL';
$string['courseurl'] = 'عنوان المساق';
$string['datetypeever'] = 'كما هو شأنه دائما';
$string['datetypeinlast'] = 'الوارد أخرا';
$string['datetypenever'] = 'بَتَاتاً';
$string['datetypenone'] = 'غير مُجهز';
$string['datetypepast'] = 'خلال';
$string['deletecondition'] = 'الغاء الشرط';
$string['deleteoutcome'] = 'الغاء الاجراء';
$string['duplicate'] = 'تكرار';
$string['dynamicrule:manage'] = 'ادارة قواعد التكرار';
$string['editcondition'] = 'تحرير الشرط';
$string['editdetails'] = 'تحرير تفاصيل الشرط  \'{$a}\\';
$string['editoutcome'] = 'تحرير الإجراء';
$string['editrulename'] = 'تحرير اسم القاعدة \'{$a}\'';
$string['enable'] = 'تفعيل';
$string['enablehelp'] = 'قاعدة التفعيل';
$string['enablehelp_help'] = 'القاعدة تتطلب شرط واحد على الأقل كما اجراء واحد على الأقل لتتفعل';
$string['enablehelpmodal'] = 'قاعدة التفعيل';
$string['enablehelpmodal_help'] = 'القاعدة تتطلب اجراء واحد على الأقل لتتفعل';
$string['errorcannotcreate'] = 'ليس لديك إذن لإنشاء القواعد';
$string['errorcannotmanage'] = 'ليست لديك صلاحية إدارة هذه القاعدة';
$string['errorcannotmanagecondition'] = 'ليست لديك صلاحية إدارة هذا الشرط';
$string['errorcannotmanageoutcome'] = 'ليست لديك صلاحية إدارة هذا الإجراء';
$string['errorinvalidbody'] = 'نص إشعارغير صالح';
$string['errorinvalidcohort'] = 'مجموعة غير صالحة';
$string['errorinvalidcourse'] = 'مساق غير صالح';
$string['errorinvalidoperator'] = 'عامل غير صالح. فقط قبل وبعد السماح.';
$string['errorinvalidsubject'] = 'موضوع إشعار غير صالح';
$string['errorinvaliduserlastlogin'] = 'تاريخ آخر تسجيل دخول غير صالح';
$string['errorinvaliduserlastlogintype'] = 'نوع تسجيل الدخول الأخير غير صالح';
$string['errorinvaliduserprofilefield'] = 'حقل ملف التعريف غير صالح';
$string['errorinvaliduserprofilefieldvalue'] = 'قيمة حقل الملف الشخصي غير صحيحة';
$string['errornopermissionissuecertificate'] = 'ليست لديك صلاحية منح هذه الشهادة';
$string['ever'] = 'كما هو شأنه دائما';
$string['field'] = 'حقل';
$string['general'] = 'إجمالي';
$string['lastlogin'] = 'آخر تسجيل دخول للمستخدم كان في';
$string['lastlogin_help'] = 'يمكنك تحديد تاريخ متعلق بالتاريخ الحالي أو بالمستخدمين الذين لم يقوموا بتسجيل الدخول مطلقًا';
$string['limitreached'] = 'تم الوصول إلى الحد الأقصى للقواعد المتفاعلة';
$string['limitreacheddescr'] = 'لقد وصلت إلى الحد الأقصى لعدد القواعد الديناميكية على هذا الموقع. يرجى ملاحظة أن القواعد المؤرشفة تحسب أيضًا في حدود هذا الحد';
$string['limitreachednumdescr'] = 'يمكنك فقط إنشاء قاعدة أو قواعد متفاعلة {$a} على هذا الموقع. يرجى ملاحظة أن القواعد المؤرشفة تحسب أيضًا في حدود هذا الحد';
$string['managebadges'] = 'إدارة الشارات';
$string['managecompetencies'] = 'إدارة الكفاءات';
$string['match'] = 'تطابق';
$string['matchedtime'] = 'الوقت المتطابق';
$string['matchlimitinvalid'] = 'يجب تشغيل القاعدة مرة واحدة على الأقل';
$string['messageprovider:notificationoutcome'] = 'إجراء الإخطار لأداة القاعدة المتفاعلة';
$string['newnameforrule'] = 'اسم جديد للقاعدة \'{$a} \\';
$string['newrule'] = 'قاعدة جديدة';
$string['noruleconditions'] = 'لا شروط على هذه القاعدة';
$string['noruleoutcomes'] = 'لا توجد إجراءات بشأن هذه القاعدة';
$string['operatorafter'] = 'بعد';
$string['operatorbefore'] = 'قبل';
$string['outcomebadge'] = 'منح الجائزة';
$string['outcomebadgedescription'] = 'منح جائزة  \'{$a}\' للمستخدمين';
$string['outcomecertificate'] = 'منح الشهادة';
$string['outcomecertificatedescription'] = 'منح الشهادة \'{$a}\' إلى المستخدمين';
$string['outcomecompetency'] = 'منح الأهلية';
$string['outcomecompetencydescription'] = 'منح الأهلية  \'{$a}\' الى المستخدمين';
$string['outcomeisbroken'] = 'يحتوي هذا الإجراء على خطأ';
$string['outcomenotification'] = 'إشعار';
$string['outcomenotificationdescription'] = 'أرسل إشعار  \'{$a}\' الى المستخدمين';
$string['outcomenotsaved'] = 'الإجراء غير محفوظ';
$string['outcomes'] = 'الإجرائات';
$string['placeholdersdesc'] = 'العناصر النائبة';
$string['placeholdersdesc_help'] = 'تمكنك العناصر النائبة اضافة محتوى تفاعلي على سبيل المثال {{userfullname}} . سيتم استبدال العنصر النائب باسم المستخدم بالكامل في الإشعار الذي يتم تسليمه إلى المستخدم';
$string['pluginname'] = 'القواعد المتفاعلة';
$string['previewcoursefullname'] = 'اسم المقرر بالكامل';
$string['previewcourseshortname'] = 'الاسم القصير للمقرر';
$string['privacy:metadata:tool_dynamicrule_match'] = 'تتطابق المعلومات حول المستخدم مع شروط قاعدة معينة. نتيجة لمطابقة المستخدم تتأثر الإجراءات المحددة في القاعدة';
$string['privacy:metadata:tool_dynamicrule_match:matchedtime'] = 'الطابع الزمني للإشارة إلى الزمان الذي تم مطابقة المستخدم مع شروط القاعدة';
$string['privacy:metadata:tool_dynamicrule_match:ruleid'] = 'معرف القاعدة';
$string['privacy:metadata:tool_dynamicrule_match:unmatchedtime'] = 'الطابع الزمني للإشارة إلى الزمان الذي لم يعد المستخدم مطابق مع شروط القاعدة';
$string['privacy:metadata:tool_dynamicrule_match:userid'] = 'معرف المستخدم الذي تمت مطابقته لشروط القاعدة';
$string['rolemanager'] = 'مدير القواعد المتفاعلة';
$string['rolemanagerdescription'] = 'يسمح بإنشاء وإدارة القواعد المتفاعلة داخل المتملك الحالي';
$string['rulematchfreq'] = 'تطابق التردد';
$string['rulematchfreq_help'] = 'بشكل افتراضي، يتم تطبيق إجراءات القاعدة على المستخدمين عند استيفاء الشروط. إذا تم تمكين تردد المطابقة ، فسيقتصر تطبيق القاعدة على العدد المحدد من المرات في الفترة المطلوبة أو في أي وقت';
$string['rulematchfreqdesc0'] = 'لا يمكن أن ينطلق أكثرمن';
$string['rulematchfreqdesc1'] = 'الأوقات';
$string['rulematchfreqenable'] = 'تمكين مطابقة الحد من التردد';
$string['rulename'] = 'الإسم';
$string['rulenotfound'] = 'لم يتم العثورعلى القاعدة';
$string['select'] = 'اختر';
$string['selectbadge'] = 'اختر شارة';
$string['selectbadge_help'] = 'حدد شارة لإصدارها';
$string['selectcertificate'] = 'إختر الشهادة';
$string['toomanycertificatestoshow'] = 'هناك الكثير من الشهادات ({$a}) لإظهارها';
