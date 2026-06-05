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
 * Strings for component 'scheduler', language 'ar', version '5.1'.
 *
 * @package     scheduler
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action'] = 'النشاط';
$string['actions'] = 'الأنشطة';
$string['addappointment'] = 'أضف طالباً اّخر';
$string['addcommands'] = 'أضف مواعيد';
$string['addondays'] = 'إضافة الحجوزات في';
$string['addsession'] = 'أضف مواعيد متعددة';
$string['addsingleslot'] = 'أضف موعداً واحداً';
$string['addslot'] = 'يمكنك إضافة مواعيد حجوزات في أي وقت لاحق';
$string['addstudenttogroup'] = 'أضف هذا الطالب إلى المجموعة في الحجز المحدد';
$string['allappointments'] = 'كل الحجوزات';
$string['allononepage'] = 'كل المواعيد بصفحة واحدة';
$string['allowgroup'] = 'موعد حصري - اضغط للتغيير';
$string['alreadyappointed'] = 'لا يمكن الحجز, الموعد محجوز بالفعل';
$string['appointagroup_help'] = 'اختر بين أن يكون الموعد لك وحدك, أو للمجموعة بالكامل';
$string['appointfor'] = 'إنشاء موعد من أجل';
$string['appointforgroup'] = 'إنشاء حجوزات لـ: {$a}';
$string['appointingstudent'] = 'حجز موعد';
$string['appointingstudentinnew'] = 'حجوزات لموعد جديد';
$string['appointment'] = 'حجز';
$string['appointmentmode'] = 'حدد نوع الحجز';
$string['appointmentmode_help'] = '<p>يمكنك هنا اختيار بعض الخيارات لتحديد طريقة حجز الحجوزات. </p>
<p><ul>
<li><strong>"<emph>n</emph> الحجوزات في هذا الجدول":</strong> يمكن للطالب حجز عدد محدد فقط من الحجوزات في هذا النشاط. حتى لو وضع المعلم علامة "مرئية"، فلن يُسمح له بحجز اجتماعات أخرى. الطريقة الوحيدة لإعادة ضبط إمكانية الطالب للحجز هي حذف سجلات "المشاهدة" القديمة.</li>
<li><strong>"<emph>n</emph> موعد في المرة الواحدة":</strong> يمكن للطالب حجز عدد محدد من المواعيد. بمجرد انتهاء الاجتماع ووضع المعلم علامة "مرئية" على الطالب، يمكن للطالب حجز مواعيد أخرى. مع ذلك، يقتصر الطالب على عدد محدد من المواعيد "المفتوحة" (غير المرئية) في أي وقت.
</li>
</ul>
</p>';
$string['appointmentno'] = 'الحجز {$a}';
$string['appointmentnote'] = 'ملاحظات حول الحجز (مرئية للطلاب)';
$string['appointments'] = 'الحجوزات';
$string['appointmentsgrouped'] = 'الحجوزات مجمّعة حسب الموعد';
$string['appointmentsummary'] = 'الموعد في {$a->startdate} من {$a->starttime} إلى {$an->endtime} مع {$a->teacher}';
$string['appointsolo'] = 'أنا فقط';
$string['appointsomeone'] = 'إضافة موعد جديد';
$string['areaappointmentnote'] = 'الملفات في ملاحظات الحجز';
$string['areaslotnote'] = 'الملفات في ملاحظات الموعد';
$string['areateachernote'] = 'الملفات في المذكرات السرية';
$string['attendable'] = 'متاح للحضور';
$string['attendablelbl'] = 'كل المرشحين لجدولة المواعيد';
$string['attended'] = 'حضر بالفعل';
$string['attendedlbl'] = 'عد الحضور من الطلاب';
$string['attendedslots'] = 'مواعيد الحضور';
$string['availableslots'] = 'المواعيد المتوافرة';
$string['availableslotsall'] = 'كل المواعيد';
$string['availableslotsnotowned'] = 'غير مملوك لك';
$string['availableslotsowned'] = 'مملوك لك';
$string['bookaslot'] = 'احجز موعداً';
$string['bookingdetails'] = 'تفاصيل الحجز';
$string['bookingformoptions'] = 'استمارة الحجز والبيانات المقدمة من الطالب';
$string['bookinginstructions'] = 'تعليمات حول الحجز';
$string['bookinginstructions_help'] = 'سيُعرض هذا النص للطلاب قبل إجراء الحجز. على سبيل المثال، يُمكنه توجيههم إلى كيفية ملء حقل الرسالة الاختياري أو تحديد الملفات المطلوب تحميلها.';
$string['bookslot'] = 'احجز موعداً';
$string['bookwithteacher'] = 'مدرس';
$string['bookwithteacher_help'] = 'اختر مدرساً للحجز';
$string['break'] = 'الاستراحة بين المواعي';
$string['breaknotnegative'] = 'مدة الاستراحة يجب أن تكون عدداً موجباً';
$string['canbook1appointment'] = 'يمكنك حجز موعد آخر في هذا الجدول.';
$string['canbooknappointments'] = 'يمكنك حجز {$a} موعدًا إضافيًا في هذا الجدول.';
$string['canbooknofurtherappointments'] = 'لا يمكنك حجز مواعيد أخرى في هذا الجدول.';
$string['canbooksingleappointment'] = 'يمكنك حجز موعد واحد في هذا الجدول';
$string['canbookunlimitedappointments'] = 'يمكنك حجز أي عدد من المواعيد في هذا الجدول';
$string['cancelbooking'] = 'إلغاء الحجز';
$string['chooseexisting'] = 'اختر الموجود';
$string['choosingslotstart'] = 'اختيار وقت البدء';
$string['choosingslotstart_help'] = 'غيّر (أو اختر) وقت بدء الحجز. في حال تعارض هذا الحجز مع مواعيد أخرى، سيُطلب منك تحديد ما إذا كان هذا الحجز سيحل محل جميع المواعيد المتعارضة. يُرجى العلم أن معلمات الموعد الجديد ستلغي جميع الإعدادات السابقة.';
$string['comments'] = 'التعليقات';
$string['complete'] = 'محجوز';
$string['confirmbooking'] = 'تأكيد الحجز';
$string['confirmdelete-all'] = 'سيؤدي هذا إلى حذف جميع المواعيد في هذا الجدول. لا يُمكن التراجع عن الحذف. هل تريد المتابعة على أي حال؟';
$string['confirmdelete-mine'] = 'سيؤدي هذا إلى حذف جميع المواعيد الخاصة بك في هذا الجدول. لا يُمكن التراجع عن الحذف. هل تريد المتابعة على أي حال؟';
$string['confirmdelete-myunused'] = 'سيؤدي هذا إلى حذف جميع المواعيد غير المستخدمة في هذا الجدول. لا يُمكن التراجع عن الحذف. هل ترغب في المتابعة على أي حال؟';
$string['confirmdelete-one'] = 'حذف الموعد؟';
$string['confirmdelete-selected'] = 'سيؤدي هذا إلى حذف المواعيد المحددة. لا يمكن التراجع عن الحذف. هل تريد المتابعة على أي حال؟';
$string['confirmdelete-unused'] = 'سيؤدي هذا إلى حذف جميع المواعيد غير المستخدمة في هذا الجدول. لا يُمكن التراجع عن الحذف. تابع على أي حال؟';
$string['confirmrevoke'] = 'إلغاء كافة الحجوزات في الفترة الحالية؟';
$string['conflictingslots'] = 'لا يمكن إنشاء الموعد في {$a} بسبب وجود مواعيد تتضارب معه';
$string['conflictlocal'] = '{$a->datetime} ({$a->duration} دقيقة) في هذا الجدول';
$string['conflictremote'] = '{$a->datetime} ({$a->duration} دقيقة) في المقرر الدراسي {$a->courseshortname}، الجدول {$a->schedulername}';
$string['contentformat'] = 'الصيغة';
$string['contentformat_help'] = '<p>هناك ثلاثة خيارات أساسية لتنسيق التصدير، تختلف في كيفية التعامل مع المواعيد التي تحتوي على عدة حجوزات.
<dl>
<dt>سطر واحد لكل موعد</dt>:
<dd>
سيحتوي ملف الإخراج على سطر واحد لكل موعد. إذا احتوى الموعد على عدة مواعيد، فسيتم عرض علامة "(متعددة)" بدلاً من اسم الطالب، إلخ.
</dd>
<dt>سطر واحد لكل حجز</dt>:
<dd>
سيحتوي ملف الإخراج على سطر واحد لكل حجز. إذا احتوى الموعد على عدة حجوزات، فستظهر عدة مرات في القائمة (مع تكرار بياناتها).
</dd>
<dt>الحجوزات المجمعة حسب الفترة الزمنية</dt>:
<dd>
يتم تجميع جميع حجوزات ضمن الموعد الواحد معًا، مسبوقة بسطر رأسي يشير إلى الفترة الزمنية المعنية. قد لا يعمل هذا بشكل جيد مع تنسيق ملف الإخراج CSV، نظرًا لأن عدد الأعمدة غير ثابت.
</dd>
</dl>
يمكنك استكشاف تأثير هذه الخيارات باستخدام زر "معاينة".</p>';
$string['copytomyself'] = 'أرسل نسخة لنفسي';
$string['course'] = 'المقرر الدراسي';
$string['createexport'] = 'إنشاء ملف التصدير';
$string['csvfieldseparator'] = 'فاصل الحقل لملف CSV';
$string['csvformat'] = 'CSV';
$string['cumulatedduration'] = 'المدة الإجمالية للحجوزات';
$string['datatoinclude'] = 'البيانات المطلوب تضمينها';
$string['datatoinclude_help'] = 'حدد الحقول المراد تضمينها في عملية التصدير. سيظهر كلٌّ منها في عمود واحد من ملف الإخراج.';
$string['date'] = 'التاريخ';
$string['datelist'] = 'نظرة عامة';
$string['defaultslotduration'] = 'المدة الافتراضية للموعد';
$string['defaultslotduration_help'] = 'الطول الافتراضي (بالدقائق) لمواعيد الحجوزات التي قمت بإعدادها';
$string['deleteallslots'] = 'حذف جميع المواعيد';
$string['deleteallunusedslots'] = 'حذف المواعيد غير المستخدمة';
$string['deletecommands'] = 'حذف المواعيد';
$string['deletedconflictingslots'] = 'بالنسبة للموعد الموجود على {$a}، تم حذف المواعيد المتضاربة:';
$string['deletemyslots'] = 'حذف جميع مواعيدي';
$string['deleteonsave'] = 'حذف هذا الحجز (عند حفظ النموذج)';
$string['deleteselection'] = 'احذف المواعيد المختارة';
$string['deletetheseslots'] = 'احذف هذه المواعيد';
$string['deleteunusedslots'] = 'احذف مواعيدي غير المستخدمة';
$string['department'] = 'من أين؟';
$string['disengage'] = 'إلغاء حجوزاتي';
$string['displayfrom'] = 'أظهر الموعد للطلاب بدءاً من';
$string['distributetoslot'] = 'توزيعها على المجموعة بأكملها';
$string['divide'] = 'تقسيم إلى فتحات؟';
$string['duration'] = 'المدة';
$string['durationrange'] = 'يجب أن تكون مدة الموعد بين {$a->min} و{$a->max} دقيقة.';
$string['editbooking'] = 'تعديل الحجز';
$string['email_applied_html'] = 'تم تقديم طلب حجز موعد في {$a->date} و{$a->time}، من قِبل الطالب <a href="{$a->attendee_url}">{$a->attendee}</a> للدورة:

<p>{$a->course_short}: <a href="{$a->course_url}">{$a->course}</a></p>

<p>باستخدام جدول المحاضرات بعنوان "<em><a href="{$a->scheduler_url}">{$a->module}</a></em>" على الموقع الإلكتروني: <a href="{$a->site_url}">{$a->site}</a>.</p>';
$string['email_applied_plain'] = 'لقد تم تحديد موعد بتاريخ {$a->date} عند {$a->time}،
من قبل الطالب(ة) {$a->attendee} للمساق:

{$a->course_short}: {$a->course}

باستعمال المُجدول المعنون "{$a->module}" في موقع الويب: {$a->site}.';
$string['email_applied_subject'] = '{$a->course_short}: حجز جديد';
$string['email_cancelled_html'] = '<p>حجزك في <strong>{$a->date</strong> و<strong>{$a->time</strong>،</br/>
مع الطالب <strong><a href="{$a->attendee_url}">{$a->attendee</a></strong> للدورة:</p>

<p><strong>{$a->course_short} : <a href="{$a->course_url}">{$a->course}</a></strong></p>

<p>في الجدول بعنوان "<em><a href="{$a->scheduler_url}">{$a->module}</a></em>" على الموقع الإلكتروني: <strong><a href="{$a->site_url}">{$a->site}</a></strong></p>

<p><strong><span class="error">تم إلغاؤه أو تم نقله</span></strong>.</p>';
$string['email_cancelled_plain'] = 'موعدك بتاريخ {$a->date} عند {$a->time}،
مع الطالب(ة) {$a->attendee} للمساق:

{$a->course_short}: {$a->course}

في المُجدول المعنون "{$a->module}" في موقع الويب: {$a->site}

تم إلغاؤه أو نقله.';
$string['email_cancelled_subject'] = '{$a->course_short}: تم إلغاء الموعد أو نقله بواسطة طالب';
$string['email_invite_html'] = '<p>يرجى اختيار فترة زمنية للحجز في:</p> <p>{$a->scheduler_url</p>';
$string['email_invite_subject'] = 'دعوة: {$a->module}';
$string['email_invitereminder_html'] = 'هذا تذكير فقط بأنك لم تحدد حجزك بعد. يُرجى اختيار حجزك في أقرب وقت ممكن على:</p><p>{$a->scheduler_url</p>';
$string['email_invitereminder_subject'] = 'تذكير: {$a->module}';
$string['email_reminder_html'] = 'لديك حجز قادم في <strong>{$a->date</strong>
من <strong>{$a->time</strong> إلى <strong>{$a->endtime</strong><br/>
مع <strong><a href="{$a->attendant_url}">{$a->attendant</a></strong>.</p>

<p>الموقع: <strong>{$a->location</strong></p>';
$string['email_reminder_plain'] = 'لديك حجز قادم في {$a->date} من {$a->time} إلى {$an->end time}
مع {$an->attendant}.
الموقع: {$a->location}';
$string['email_reminder_subject'] = '{$a->course_short}: تذكير بالحجز';
$string['email_teachercancelled_html'] = '<p>حجزك في <strong>{$a->date</strong> و<strong>{$a->time}</strong>،</strong>
مع {$a->staffrole} <strong><a href="{$a->attendant_url}">{$a->attendant}</a></strong> للدورة:</p>

<p><strong>{$a->course_short}: <a href="{$a->course_url}">{$a->course}</a></strong></p>

<p>في المجدول "<em><a href="{$a->scheduler_url}">{$a->module}</a></em>" على الموقع الإلكتروني: <strong><a href="{$a->site_url}">{$a->site}</a></strong></p>

<p><strong><span class="error">تم تم الإلغاء. يُرجى التقدم بطلب للحصول على موعد جديد.';
$string['email_teachercancelled_plain'] = 'موعدك بتاريخ {$a->date} عند {$a->time}،
مع {$a->staffrole} {$a->attendant} للمساق:

{$a->course_short}: {$a->course}

في المُجدول المعنون "{$a->module}" في موقع الويب: {$a->site}

تم إلغاؤه. يرجى التقديم إلى فسحة جديدة.';
$string['email_teachercancelled_subject'] = '{$a->course_short}: تم إلغاء الحجز من قبل المعلم';
$string['emailreminder'] = 'إرسال تذكير بالبريد الإلكتروني';
$string['emailreminderondate'] = 'إرسال تذكير بالبريد الإلكتروني على';
$string['end'] = 'نهاية';
$string['enddate'] = 'كرر المواعيد حتى';
$string['event_appointmentlistviewed'] = 'قائمة مواعيد مُجدوِل تمت معاينتها';
$string['event_bookingadded'] = 'حجز مُجدوِل تمت إضافته';
$string['event_bookingformviewed'] = 'نموذج حجز مُجدوِل تمت معاينته';
$string['event_bookingremoved'] = 'حجز مُجدوِل تمت إزالته';
$string['event_slotadded'] = 'فسحة مُجدوِل تمت إضافتها';
$string['event_slotdeleted'] = 'فسحة مُجدوِل تم حذفها';
$string['everyone'] = 'الجميع';
$string['excelformat'] = 'Excel';
$string['exclusive'] = 'حصري';
$string['exclusivity'] = 'الحصرية';
$string['exclusivity_help'] = 'يمكنك تحديد عدد الطلاب الذين يمكنهم التقديم لموعد معين. </p>
<p>تحديد الحد الأقصى بـ ١ (افتراضي) يعني أن الموعد مخصص لطالب واحد فقط. </p>
<p>تحديد الحد الأقصى، مثلاً ٣، يعني أنه يمكن لثلاثة طلاب حجز الموعد. </p>
<p>في حال عدم تفعيل هذا الخيار، يمكن لأي عدد من الطلاب حجز الموعد؛ ولن يُعتبر الموعد "مكتملًا". </p>';
$string['exclusivityoverload'] = 'تم تعيين {$a} طالبًا في هذا الموعد، وهو عدد أكبر من المسموح به بواسطة هذا الإعداد.';
$string['exclusivitypositive'] = 'يجب أن يكون عدد الطلاب في كل موعد طالبًا واحدًا أو أكثر.';
$string['explaingeneralconfig'] = 'لا يمكن إعداد هذه الخيارات إلا على مستوى الموقع وسيتم تطبيقها على جميع الجداول لتثبيت Moodle هذا.';
$string['export'] = 'استيراد';
$string['exporthdr'] = 'تصدير المواعيد و الحجوزات';
$string['exporttimerange'] = 'النطاق الزمني';
$string['exporttimerangeall'] = 'مواعيد المستقبل والماضي';
$string['exporttimerangefuture'] = 'المواعيدد المستقبلية فقط';
$string['exporttimerangepast'] = 'المواعيدد المنتهية فقط';
$string['field-appointmentnote'] = 'ملاحظة حول الحجز (للطلاب)';
$string['field-attended'] = 'حضر';
$string['field-date'] = 'التاريخ';
$string['field-endtime'] = 'وقت النهاية';
$string['field-filecount'] = 'عدد الملفات المرفوعة';
$string['field-grade'] = 'الدرجة';
$string['field-groupsmulti'] = 'المجموعات (عدة أعمدة)';
$string['field-groupssingle'] = 'المجموعات';
$string['field-groupssingle-label'] = 'المجموعات (عمود واحد)';
$string['field-location'] = 'الموقع';
$string['field-maxstudents'] = 'الحد الأقصى للطلاب';
$string['field-slotnotes'] = 'ملاحظات حول الموعد';
$string['field-starttime'] = 'وقت البدء';
$string['field-studentemail'] = 'البريد الالكتروني للطالب';
$string['field-studentfirstname'] = 'الاسم الأول للطالب';
$string['field-studentfullname'] = 'الاسم الكامل للطالب';
$string['field-studentidnumber'] = 'رقم المُعرَّف للطالب';
$string['field-studentlastname'] = 'الاسم الأخير للطالب';
$string['field-studentnote'] = 'رسالة من قبل الطالب';
$string['field-studentusername'] = 'اسم المستخدم للطالب';
$string['field-teachernote'] = 'ملاحظة سرية (للمعلم فقط)';
$string['fileformat'] = 'صيغة الملف';
$string['fileformat_help'] = 'تتوفر تنسيقات الملفات التالية:
<ul>
<li>ملفات نصية مفصولة بفواصل (CSV). يمكن اختيار فاصل الحقول، افتراضيًا فاصلة، من الأسفل.

يمكن فتح ملفات CSV في معظم تطبيقات جداول البيانات؛</li>
<li>ملفات مايكروسوفت إكسل (تنسيق إكسل 2007)؛</li>
<li>جداول بيانات المستندات المفتوحة (ODS)؛</li>
<li>تنسيق HTML - صفحة ويب تعرض جدول الإخراج، ويمكن طباعته باستخدام ميزة الطباعة في المتصفح؛</li>
<li>مستندات PDF. يمكنك الاختيار بين الاتجاهين الأفقي والعمودي.</li>
</ul>';
$string['finalgrade'] = 'الدرجة النهائية';
$string['firstslotavailable'] = 'سيتم فتح الموعد الأول في: {$a}';
$string['forbidgroup'] = 'موعد المجموعة - انقر للتغيير';
$string['forcewhenoverlap'] = 'الإجبار عن التضارب';
$string['forcewhenoverlap_help'] = '<h3>إجبار إنشاء خانة عند تداخلها</h3>
<p>يحدد هذا الإعداد كيفية التعامل مع المواعيد الجديدة في حال تداخلها مع مواعيد أخرى موجودة بالفعل.</p>
<p>في حال تفعيله، سيتم حذف الموعد المتضارب الموجود وإنشاء الموعد الجديد.</p>
<p>في حال تعطيله، سيتم الاحتفاظ بالموعد المتداخلة الموجود ولن يتم إنشاء موعد جديد.</p>';
$string['forcewhenoverlap_link'] = 'mod/scheduler/conflict';
$string['forcourses'] = 'اختيار الطلاب في الدورات';
$string['friday'] = 'الجمعة';
$string['generalconfig'] = 'إعدادات عامة';
$string['grade'] = 'الدرجة';
$string['gradeingradebook'] = 'الدرجة في سلم الدرجات';
$string['gradingstrategy'] = 'استراتيجية التصنيف';
$string['gradingstrategy_help'] = 'في جدول زمني يسمح للطلاب بتحديد عدة حجوزات، حدد كيفية تجميع الدرجات. يعرض سجل الدرجات إما متوسط الدرجة أو الحد الأقصى للدرجة التي حصل عليها الطالب.';
$string['group'] = 'مجموعة';
$string['groupbookings'] = 'الحجز في المجموعات';
$string['groupbookings_help'] = 'السماح للطلاب بحجز موعد لجميع أعضاء مجموعتهم.
(ملاحظة: هذا منفصل عن إعداد "وضع المجموعة"، الذي يتحكم في الأماكن التي يمكن للطالب رؤيتها.)';
$string['groupbreakdown'] = 'حسب حجم المجموعة';
$string['groupmodeyourgroups'] = 'وضع المجموعة: {$a->groupmode}. فقط الطلاب في {$a->grouplist} يمكنهم حجز المواعيد معك.';
$string['groupmodeyourgroupsempty'] = 'وضع المجموعة: {$a->groupmode}. أنت لست عضوًا في أي مجموعة، وبالتالي لا يمكن للطلاب حجز مواعيد معك.';
$string['groupscheduling'] = 'تمكين جدولة المجموعة';
$string['groupscheduling_desc'] = 'السماح بجدولة مجموعات كاملة دفعةً واحدة.
(باستثناء الخيار العام، يجب تفعيل خيار "الحجز في مجموعات" في مُجدوِل الجدولة المعني.)';
$string['groupsession'] = 'جلسة جماعية';
$string['groupsize'] = 'حجم المجموعة';
$string['guardtime'] = 'وقت الحراسة';
$string['guardtime_help'] = 'يمنع وقت الحراسة الطلاب من تغيير حجزهم قبل الموعد بفترة وجيزة.
<p>إذا تم تفعيل وقت الحراسة وضبطه، على سبيل المثال، على ساعتين، فلن يتمكن الطلاب من حجز موعد يبدأ بعد أقل من ساعتين من الآن، ولن يتمكنوا من إلغاء الحجز إذا بدأ بعد أقل من ساعتين.</p>';
$string['guestscantdoanything'] = 'لا يمكن للضيوف فعل أي شيء هنا.';
$string['howtoaddstudents'] = 'لإضافة الطلاب إلى جدول زمني عالمي، استخدم إعداد الدور للوحدة.<br/>يمكنك أيضًا استخدام تعريفات دور الوحدة لتحديد الحاضرين لطلابك.';
$string['htmlformat'] = 'HTML';
$string['ignoreconflicts'] = 'تجاهل تعارضات الجدولة';
$string['ignoreconflicts_help'] = 'في حال تفعيل هذا الخيار، سيتم نقل الموعد إلى التاريخ والوقت المطلوبين، حتى في حال وجود مواعيد أخرى في نفس الوقت. قد يؤدي هذا إلى تداخل مواعيد بعض المعلمين أو الطلاب، لذا يجب استخدامه بحذر.';
$string['ignoreconflicts_link'] = 'mod/scheduler/conflict';
$string['includeemptyslots'] = 'تضمين الفتحات الفارغة';
$string['includeslotsfor'] = 'تضمين فتحات لـ';
$string['incourse'] = 'في المقرر الدراسي';
$string['introduction'] = 'المقدمة';
$string['isnonexclusive'] = 'غير حصري';
$string['landscape'] = 'منظر جمالي';
$string['lengthbreakdown'] = 'حسب المدة الزمنية لموعد';
$string['limited'] = 'محدود ({$a} متبقي)';
$string['location'] = 'الموقع';
$string['location_help'] = 'حدد الموقع المقرر للاجتماع.';
$string['markasseennow'] = 'ضع علامة كما هو موضح الآن';
$string['markseen'] = 'بعد أن يكون لديك حجز مع طالب ما، يرجى وضع علامة "تمت رؤيته" عليه من خلال النقر فوق مربع الاختيار الموجود بجوار صورة المستخدم الخاصة به أعلاه.';
$string['maxgrade'] = 'احصل على أعلى درجة';
$string['maxstudentlistsize'] = 'الحد الأقصى لطول قائمة الطلاب';
$string['maxstudentlistsize_desc'] = 'الحد الأقصى لطول قائمة الطلاب المطلوب حجز موعد لهم، كما هو موضح في عرض المعلم في مُجدول المواعيد. إذا زاد عدد الطلاب عن هذا الحد، فلن تُعرض أي قائمة.';
$string['maxstudentsperslot'] = 'الحد الأقصى لعدد الطلاب لكل موعد';
$string['maxstudentsperslot_desc'] = 'يمكن أن تستوعب المواعيد الجماعية/غير الحصرية هذا العدد من الطلاب كحد أقصى. يُرجى العلم أنه يمكن دائمًا اختيار إعداد "غير محدود" للمواعيد.';
$string['meangrade'] = 'خذ الدرجة المتوسطة';
$string['meetingwith'] = 'لقاء معكم';
$string['meetingwithplural'] = 'لقاء معكم';
$string['message'] = 'رسالة';
$string['messagebody'] = 'نص الرسالة';
$string['messageprovider:bookingnotification'] = 'إشعار عند إجراء الحجز أو إلغائه';
$string['messageprovider:invitation'] = 'دعوة لحجز موعد';
$string['messageprovider:reminder'] = 'تذكير بالموعد القادم';
$string['messagesent'] = 'تم إرسال الرسالة إلى {$a} من المستلمين';
$string['messagesubject'] = 'الموضوع';
$string['minutes'] = 'الدقائق';
$string['minutesperslot'] = 'الدقائق لكل موعد';
$string['missingstudents'] = 'لا يزال يتعين على {$a} الطلاب تحديد موعد للحجز';
$string['missingstudentsmany'] = 'لا يزال يتعين على {$a} طالب حجز موعد. لا يتم عرض القائمة بسبب الحجم.';
$string['mixindivgroup'] = 'مزج الحجوزات الفردية والجماعية';
$string['mixindivgroup_desc'] = 'عندما يتم تمكين جدولة المجموعة، اسمح بالحجوزات الفردية أيضًا.';
$string['mode'] = 'الوضع';
$string['modeappointments'] = 'الحجوزات';
$string['modeintro'] = 'يمكن للطلاب التسجيل';
$string['modeoneatatime'] = 'في وقت واحد';
$string['modeoneonly'] = 'في هذا الجدول';
$string['modulename'] = 'الجدول';
$string['modulename_help'] = 'يساعدك نشاط الجدولة في جدولة الحجوزات مع طلابك.

يحدد المعلمون فترات زمنية للاجتماعات، ثم يختار الطلاب إحداها عبر مودل.

يمكن للمعلمين بدورهم تسجيل نتائج الاجتماع - مع إضافة علامة اختيارية - في الجدولة.

يدعم الجدولة الجماعية؛ أي أن كل فترة زمنية تستوعب عدة طلاب، ويمكن تحديد مواعيد مجموعات كاملة في الوقت نفسه.';
$string['modulename_link'] = 'mod/scheduler/view';
$string['modulenameplural'] = 'المجدولون';
$string['monday'] = 'الإثنين';
$string['multiple'] = '(متعدد)';
$string['myappointments'] = 'حجوزاتي';
$string['myself'] = 'نفسي';
$string['name'] = 'اسم المجدول';
$string['needteachers'] = 'لا يمكن إضافة مواعيد لأن هذه الدورة ليس بها مدرسين';
$string['negativerange'] = 'النطاق الزمني سلبي. هذا غير ممكن.';
$string['negativetimerange'] = 'يجب أن يكون وقت الانتهاء لاحقًا لوقت البدء.';
$string['never'] = 'أبداً';
$string['nfiles'] = 'ملفات {$a}';
$string['noappointments'] = 'لا يوجد حجوزات';
$string['noexistingstudents'] = 'لا يوجد طلاب متاحين للجدولة';
$string['nogroups'] = 'لا يوجد مجموعات متاحة للجدولة';
$string['noresults'] = 'لا يوجد نتائج';
$string['noschedulers'] = 'لا يوجد جدولة';
$string['noslots'] = 'لا توجد مواعيد متاحة.';
$string['noslotsavailable'] = 'لا توجد أماكن متاحة للحجز في هذا الوقت.';
$string['noslotsopennow'] = 'لا توجد مواعيد مفتوحة للحجز في الوقت الحالي.';
$string['nostudents'] = 'لا يوجد طلاب مجدولين';
$string['nostudenttobook'] = 'لا يوجد طالب للحجز';
$string['note'] = 'الدرجة';
$string['noteacherforslot'] = 'لا يوجد مدرس للمواعيد';
$string['noteachershere'] = 'لا يوجد مدرسين متاحين';
$string['notenoughplaces'] = 'عذرا، لا يوجد عدد كاف من الحجوزات في هذه الفترة.';
$string['notesrequired'] = 'يجب عليك إدخال النص في هذا الحقل قبل حجز الموعد.';
$string['notifications'] = 'الإشعارات';
$string['notifications_help'] = 'عندما يتم تفعيل هذا الخيار، سيتلقى المعلمون والطلاب إشعارات عند التقدم للمواعيد أو إلغائها.';
$string['notseen'] = 'لم يتم رؤيته';
$string['now'] = 'الاّن';
$string['occurrences'] = 'الحوادث';
$string['on'] = 'على';
$string['onedaybefore'] = 'يوم واحد قبل الموعد';
$string['onelineperappointment'] = 'خط واحد لكل حجز';
$string['onelineperslot'] = 'خط واحد لكل موعد';
$string['oneslotadded'] = 'تم إضافة موعد جديد';
$string['oneslotdeleted'] = 'تم حذف موعد';
$string['oneweekbefore'] = 'أسبوع قبل الموعد';
$string['onthemorningofappointment'] = 'صباح الحجز';
$string['options'] = 'الخيارات';
$string['otherstudents'] = 'المشتركون الاّخرون';
$string['outlineappointments'] = '{$a->attended} حجوزات حضرها، {$a->upcoming} حجوزات قادمة.';
$string['outlinegrade'] = 'الدرجة: {$a}.';
$string['overall'] = 'إجمالي';
$string['overlappings'] = 'بعض المواعيد الأخرى متداخلة';
$string['pageperteacher'] = 'صفحة واحدة لكل {$a}';
$string['pagination'] = 'الترقيم';
$string['pagination_help'] = 'اختر ما إذا كان التصدير سيحتوي على صفحة منفصلة لكل معلم. في Excel وتنسيق ملفات ODS، تتوافق هذه الصفحات مع علامات التبويب (أوراق العمل) في المصنف.';
$string['pdfformat'] = 'PDF';
$string['pdforientation'] = 'اتجاه صفحة PDF';
$string['pluginadministration'] = 'إدارة الجدولة';
$string['pluginname'] = 'الجدولة';
$string['portrait'] = 'لَوحَة';
$string['preview'] = 'معاينة';
$string['previewlimited'] = '(المعاينة تقتصر على {$a} سطراً.)';
$string['privacy:metadata:filepurpose'] = 'الملف المستخدم في الملاحظات الخاصة بالحجز أو الموعد';
$string['privacy:metadata:scheduler_appointment'] = 'يمثل حجز الطالب في الجدول الزمني';
$string['privacy:metadata:scheduler_appointment:appointmentnote'] = 'ملاحظة المعلم (مرئية للطالب)';
$string['privacy:metadata:scheduler_appointment:appointmentnoteformat'] = 'تنسيق مذكرة المعلم';
$string['privacy:metadata:scheduler_appointment:attended'] = 'هل تم حضور الموعد';
$string['privacy:metadata:scheduler_appointment:grade'] = 'الدرجة للتعيين';
$string['privacy:metadata:scheduler_appointment:studentid'] = 'الطالب الذي حجز الموعد';
$string['privacy:metadata:scheduler_appointment:studentnote'] = 'ملاحظة من الطالب';
$string['privacy:metadata:scheduler_appointment:studentnoteformat'] = 'تنسيق مذكرة الطالب';
$string['privacy:metadata:scheduler_appointment:teachernote'] = 'ملاحظة المعلم (خاصة)';
$string['privacy:metadata:scheduler_appointment:teachernoteformat'] = 'نموذج مذكرة المعلم الخصوصي';
$string['privacy:metadata:scheduler_slots'] = 'يمثل موعداً واحداً في المجدول';
$string['privacy:metadata:scheduler_slots:appointmentlocation'] = 'مكان الحجز';
$string['privacy:metadata:scheduler_slots:duration'] = 'مدة الفترة الزمنية للموعد بالدقائق';
$string['privacy:metadata:scheduler_slots:exclusivity'] = 'الحد الأقصى لعدد الطلاب في الموعد';
$string['privacy:metadata:scheduler_slots:notes'] = 'ملاحظات حول الموعد';
$string['privacy:metadata:scheduler_slots:notesformat'] = 'تنسيق الملاحظات';
$string['privacy:metadata:scheduler_slots:starttime'] = 'وقت بدء الموعد';
$string['privacy:metadata:scheduler_slots:teacherid'] = 'المعلم المرتبط بالموعد';
$string['purgeunusedslots'] = 'إزالة المواعيد غير المستخدمة في الماضي';
$string['recipients'] = 'المستلمون';
$string['registeredlbl'] = 'الطالب المُعيَّن';
$string['reminder'] = 'تذكير';
$string['requireupload'] = 'مطلوب تحميل الملف';
$string['resetappointments'] = 'حذف الحجوزات والدرجات';
$string['resetslots'] = 'حذف مواعيد الجدولة';
$string['return'] = 'عودة إلى المساق';
$string['revealteachernotes'] = 'إظهار ملاحظات المعلم في صادرات الخصوصية';
$string['revealteachernotes_desc'] = 'إذا تم تحديد هذا الخيار، فسيتم الكشف عن ملاحظات المعلم السرية (والتي عادةً ما تكون غير مرئية للطلاب) للطلاب في طلبات تصدير البيانات، أي عبر واجهة برمجة التطبيقات الخاصة. يجب عليك تحديد ما إذا كان يجب تضمينها في عمليات تصدير البيانات للطلاب بموجب اللائحة العامة لحماية البيانات (GDPR) بناءً على استخدامك الشخصي لهذا الحقل.';
$string['revoke'] = 'إلغاء الحجز';
$string['saturday'] = 'السبت';
$string['save'] = 'حفظ';
$string['savechoice'] = 'احفظ اختياري';
$string['saveseen'] = 'حفظ المشاهدة';
$string['schedule'] = 'الجدول';
$string['scheduleappointment'] = 'جدولة حجز لـ {$a}';
$string['schedulecancelled'] = '{$a} : تم إلغاء حجزك أو نقله';
$string['schedulegroups'] = 'الجدول حسب المجموعة';
$string['scheduleinnew'] = 'الجدول في موعد جديد';
$string['scheduleinslot'] = 'الجدول الزمني في الموعد';
$string['scheduler'] = 'المجدول';
$string['scheduler:addinstance'] = 'إضافة مُجدوِل جديد';
$string['scheduler:appoint'] = 'احجز مواعيد';
$string['scheduler:attend'] = 'حضور الطلاب';
$string['scheduler:canscheduletootherteachers'] = 'جدولة الحجوزات لأعضاء آخرين من الموظفين';
$string['scheduler:canseeotherteachersbooking'] = 'شاهد واستعرض حجوزات المعلمين الآخرين';
$string['scheduler:disengage'] = 'هذه القدرة أصبحت قديمة ولا تفعل شيئًا';
$string['scheduler:editallattended'] = 'قم بتمييز الطلاب في جميع الحجوزات على أنهم حضروا / لم يحضروا.';
$string['scheduler:editallgrades'] = 'تعديل الدرجات في كافة الحجوزات.';
$string['scheduler:editallnotes'] = 'تعديل ملاحظات الحجز في جميع الحجوزات.';
$string['scheduler:manage'] = 'إدارة حجوزاتك ومواعيدك';
$string['scheduler:manageallappointments'] = 'إدارة جميع بيانات الجدولة';
$string['scheduler:seeotherstudentsbooking'] = 'انظر الطلاب الآخرين المتضمنين في حجز الموعد';
$string['scheduler:seeotherstudentsresults'] = 'انظر نتائج مواعيد الطلاب الآخرين';
$string['scheduler:seeoverviewoutsideactivity'] = 'استخدم شاشة النظرة العامة لرؤية المواعيد خارج نشاط المجدول الحالي.';
$string['scheduler:viewfullslots'] = 'انظر إلى المواعيد حتى لو كانت محجوزة بالكامل (في شاشة الطالب)';
$string['scheduler:viewslots'] = 'انظر إلى الحجوزات المفتوحة للحجز (في شاشة الطالب)';
$string['schedulestudents'] = 'الجدول حسب الطالب';
$string['scopemenu'] = 'إظهار المواعيد في: {$a}';
$string['scopemenuself'] = 'إظهار مواعيدي في: {$a}';
$string['search:activity'] = 'المجدول - معلومات النشاط';
$string['seen'] = 'تمت رؤيته';
$string['selectedtoomany'] = 'لقد اخترتَ عددًا كبيرًا جدًا من المواعيد. لا يمكنك اختيار أكثر من {$a}.';
$string['sendinvitation'] = 'أرسل دعوة';
$string['sendmessage'] = 'أرسل رسالة';
$string['sendreminder'] = 'أرسل تذكير';
$string['sendreminders'] = 'إرسال رسائل تذكير بالبريد الإلكتروني للحجوزات القادمة';
$string['sepcolon'] = 'نقطتين';
$string['sepcomma'] = 'فاصلة';
$string['sepsemicolon'] = 'فاصلة منقوطة';
$string['showemailplain'] = 'إظهار عناوين البريد الإلكتروني في نص عادي';
$string['showemailplain_desc'] = 'في وجهة نظر المعلم للمجدول، أظهر عناوين البريد الإلكتروني للطلاب الذين يحتاجون إلى حجز في نص عادي، بالإضافة إلى روابط mailto:';
$string['showparticipants'] = 'أظهر المشتركين';
$string['slot'] = 'الموعد';
$string['slot_is_just_in_use'] = 'عذرًا، تم الحجز من قِبل طالب آخر! يُرجى المحاولة مجددًا.';
$string['slotdatetime'] = '{$a->shortdatetime} لمدة {$a->duration} دقيقة';
$string['slotdatetimelabel'] = 'التاريخ و الوقت';
$string['slotdatetimelong'] = '{$a->date}، {$a->starttime} & {$a->endtime}';
$string['slotdescription'] = '{$a->status} في {$a->start date} من {$a->starttime} إلى {$an->end time} في {$a->location} مع {$a->facilitator}';
$string['slots'] = 'المواعيد';
$string['slotsadded'] = 'تم إضافة {$a} موعد';
$string['slotsdeleted'] = 'تم حذف {$a} موعد';
$string['slottype'] = 'نوع الموعد';
$string['slotupdated'] = 'تم تعديل موعد واحد';
$string['slotwarning'] = '<strong>تحذير:</strong> نقل هذه الموعد إلى الوقت المحدد يتعارض مع المواعيد المدرجة أدناه. حدّد "تجاهل تعارضات الجدولة" إذا كنت ترغب في نقل الفترة.';
$string['staffbreakdown'] = 'بواسطة {$a}';
$string['staffrolename'] = 'اسم الدور للمعلم';
$string['staffrolename_help'] = 'تسمية الشخص الذي يُشرف على الطلاب. ليس بالضرورة "معلمًا".';
$string['start'] = 'البداية';
$string['startpast'] = 'لا يمكنك بدء حجز فارغ في الماضي';
$string['statistics'] = 'الإحصائيات';
$string['student'] = 'الطالب';
$string['studentbreakdown'] = 'حسب الطالب';
$string['studentcomments'] = 'رسالة الطالب';
$string['studentdetails'] = 'تفاصيل الطالب';
$string['studentfiles'] = 'الملفات المرفوعة';
$string['studentmultiselect'] = 'يمكن اختيار كل طالب مرة واحدة فقط في هذا الموعد';
$string['studentnote'] = 'رسالة من الطالب';
$string['studentprovided'] = 'الطالب المُقدَّم: {$a}';
$string['students'] = 'الطلاب';
$string['sunday'] = 'الأحد';
$string['tab-otherappointments'] = 'كل حجوزات هذا الطالب';
$string['tab-otherstudents'] = 'الطلاب في هذا الموعد';
$string['tab-thisappointment'] = 'هذا الحجز';
$string['teacher'] = 'المدرس';
$string['teachernote'] = 'ملاحظات سرية (مرئية للمعلم فقط)';
$string['teachersmenu'] = 'إظهار المواعيد لـ: {$a}';
$string['thiscourse'] = 'هذا المقرر الدراسي';
$string['thisscheduler'] = 'هذا الجدول';
$string['thissite'] = 'الموقع بأكمله';
$string['thursday'] = 'الخميس';
$string['timefrom'] = 'من:';
$string['timerange'] = 'النطاق الزمني';
$string['timeto'] = 'إلى:';
$string['totalgrade'] = 'الدرجة الكلية';
$string['tuesday'] = 'الثلاثاء';
$string['unattended'] = 'بدون مراقبة';
$string['unlimited'] = 'غير محود';
$string['unregisteredlbl'] = 'الطلاب غير المعينين';
$string['upcomingslots'] = 'المواعيد القادمة';
$string['updategrades'] = 'تحديث الدرجات';
$string['uploadmaxfiles'] = 'أقصى عدد من الملفات المرفوعة';
$string['uploadmaxfiles_help'] = 'الحد الأقصى لعدد الملفات التي يمكن للطالب رفعها في نموذج الحجز. رفع الملف اختياري ما لم يتم تحديد خيار "رفع الملف مطلوب". في حال ضبطه على 0، لن يظهر للطلاب مربع رفع الملف.';
$string['uploadmaxfilesglobal'] = 'أقصى عدد من الملفات المرفوعة';
$string['uploadmaxfilesglobal_desc'] = 'الحد الأقصى لعدد الملفات التي يمكن للطالب رفعها في نموذج الحجز. يمكن تخفيض هذا الحد بشكل أكبر على مستوى كل جدول.';
$string['uploadmaxsize'] = 'أقصى حجم للملف';
$string['uploadmaxsize_help'] = 'الحد الأقصى لحجم الملفات التي يرفعها الطلاب. ينطبق هذا الحد على كل ملف.';
$string['uploadrequired'] = 'يجب عليك تحميل الملفات هنا قبل حجز الموعد.';
$string['uploadstudentfiles'] = 'تحميل الملفات';
$string['usebookingform'] = 'استخدم نموذج الحجز';
$string['usebookingform_help'] = 'في حال تفعيل هذه الميزة، سيظهر للطالب شاشة حجز منفصلة قبل حجز موعد. قد تتطلب شاشة الحجز إدخال بيانات، أو تحميل ملفات، أو حل اختبار CAPTCHA؛ راجع الخيارات أدناه.';
$string['usebookingform_link'] = 'mod/scheduler/bookingform';
$string['usecaptcha'] = 'استخدم CAPTCHA للحجوزات الجديدة';
$string['usecaptcha_help'] = 'في حال تفعيله، سيحتاج الطلاب إلى حلّ سؤال أمان CAPTCHA قبل إجراء حجز جديد.

استخدم هذا الإعداد إذا كنت تشكّ في أن الطلاب يستخدمون برامج آلية للحصول على المواعيد المتاحة.

<p>لن يتم عرض رمز التحقق إذا عدّل الطالب حجزًا موجودًا.</p>';
$string['usenotes'] = 'استخدم الملاحظات للمواعيد';
$string['usenotesboth'] = 'كلا النوعين من الملاحظات';
$string['usenotesnone'] = 'لا أحد';
$string['usenotesstudent'] = 'مذكرة الموعد، مرئية للمعلم والطالب';
$string['usenotesteacher'] = 'ملاحظة سرية، مرئية للمعلمين فقط';
$string['usestudentnotes'] = 'السماح للطلاب بإدخال رسالة';
$string['usestudentnotes_help'] = 'في حال تفعيل هذه الخاصية، ستحتوي شاشة الحجز على مربع نصي يُمكن للطلاب من خلاله إدخال رسالة. استخدم "تعليمات الحجز" أعلاه لإرشاد الطلاب إلى المعلومات التي يجب عليهم تقديمها.';
$string['viewbooking'] = 'انظر التفاصيل';
$string['wednesday'] = 'الأربعاء';
$string['welcomebackstudent'] = 'بإمكانك حجز فترات إضافية بالضغط على زر "حجز الفترة" المقابل أدناه.';
$string['welcomenewstudent'] = 'يوضح الجدول أدناه جميع المواعيد المتاحة. اختر موعدك بالضغط على زر "حجز موعد". إذا أردت تغيير موعدك لاحقًا، يمكنك زيارة هذه الصفحة مجددًا.';
$string['welcomenewteacher'] = 'الرجاء الضغط على الزر أدناه لإضافة مواعيد محددة.';
$string['what'] = 'ماذا؟';
$string['whathappened'] = 'ماذا حدث؟';
$string['whatresulted'] = 'ماذا نتج؟';
$string['when'] = 'متى؟';
$string['where'] = 'أين؟';
$string['who'] = 'مع من؟';
$string['whosthere'] = 'من هناك؟';
$string['xdaysbefore'] = '{$a} أيام قبل الموعد';
$string['xweeksbefore'] = '{$a} أسابيع قبل الموعد';
$string['yesallgroups'] = 'نعم لجميع المجموعات';
$string['yesingrouping'] = 'نعم، في المجموعة {$a}';
$string['yesoptional'] = 'نعم، اختياري للطالب';
$string['yesrequired'] = 'نعم يجب على الطالب إدخال رسالة';
$string['yourappointmentnote'] = 'تعليقات لعينك';
$string['yourslotnotes'] = 'تعليقات على الاجتماع';
$string['yourstudentnote'] = 'رسالتك';
$string['yourtotalgrade'] = 'مجموع درجاتك في هذا النشاط هو <strong>{$a}</strong>.';
