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
 * Strings for component 'enrol_invitation', language 'ar', version '5.1'.
 *
 * @package     enrol_invitation
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['a_day'] = 'يوم واحد';
$string['a_minute'] = 'دقيقة واحدة';
$string['about_hour'] = 'حوالي ساعة واحدة';
$string['about_x_hours'] = 'حوالي {$a} من الساعات';
$string['accepteddescription'] = 'المستخدم ذي المُعرَّف {$a->userid} قد قبِل الدعوة إلى المساق ذي المُعرَّف \'{$a->courseid}\'.';
$string['action_extend_invite'] = 'تمديد الدعوة';
$string['action_resend_invite'] = 'إعادة إرسال الدعوة';
$string['action_revoke_invite'] = 'سحب الدعوة';
$string['anonymoususer'] = '(مجهول)';
$string['assignrole'] = 'تعيين الدور';
$string['customnamecourse'] = 'صيغة مخصصة';
$string['customsubjectformat'] = '{$a->shortname} - {$a->fullname}';
$string['default_subject'] = 'دعوة المساق: {$a}';
$string['defaultinvitevalues'] = 'القيم الافتراضية للدعوة';
$string['defaultsubjectformat'] = 'الصيغة الافتراضية للموضوع';
$string['defaultsubjectformat_desc'] = 'هذه هي الصيغة الافتراضية لاسم المقرر التي ستُستعمل في سطر الموضوع عند إرسال الدعوات بالبريد الالكتروني. لاحظ أن ذلك سيؤثر فقط على عينات طرق الانضمام عند الشروع بإنشائها. إذا اخترت <strong>الصيغة المخصصة</strong>، يمكك <a href="../admin/tool/customlang/">تخصيص <strong>\'customsubjectformat\'</strong> عبارة اللغة</a> العائدة إلى ملحق <strong>دعوة الانضمام</strong> باستعمال أي تشكيلة من الاسم الكامل و/أو المختصر للمقرر. عند تنصيب هذا الملحق للمرة الأولى، تكون الصيغة المخصصة مضبوعة على القيمة \'shortname - fullname\'.';
$string['deleteddescription'] = 'المستخدم ذي المُعرَّف {$a->userid} قد حذف الدعوة إلى المساق ذي المُعرَّف \'{$a->courseid}\' المرسلة إلى \'{$a->email}\'.';
$string['editenrolment'] = 'تحرير الانضمام';
$string['email_clarification'] = 'بإمكانك تحديد عناوين بريد الكتروني متعددة عبر الفصل بينها باستعمال فوارز إنجليزية أو فوارز منقوطة إنجليزية، فراغات، أو سطور جديد.';
$string['emailaddressnumber'] = 'عنوان البريد الالكتروني';
$string['emailmessageuserenrolled'] = 'مرحبًا،

إن {$a->userfullname} ({$a->useremail}) قد قبل دعوتك للوصول إلى {$a->coursefullname} بصفة "{$a->rolename}". يمكك التحقق من حالة هذه الدعوة عبر معاينة أي من:

* قائمة المشاركين: {$a->courseenrolledusersurl}
* ماضي الدعوة: {$a->invitehistoryurl}

{$a->sitename}
-------------
{$a->supportemail}';
$string['emailmsghtml'] = 'استعراض';
$string['emailmsghtml_help'] = '<p>أسعد الله يومكم،</p>
<p>أنتم مدعوون للانضمام إلى المقرر الآتي:</p>
<ul>
  <li>اسم المقرر: <b>{$a->coursename}</b></li>
  <li>تاريخ البدء: <b>{$a->start}</b></li>
  <li>تاريخ الانتهاء: <b>{$a->end}</b></li>
</ul>
{$a->message}
<p>سجل دخولك لتأكيد انضمامك إلى المقرر.</p>
<p>عبر استعمالك لهذا الرابط، أنت تؤكد بأنك الشخص المعنونة إليه هذه الرسالة والمقصود بهذه الدعوة.</p>
<p><a class="btn btn-primary" href="{$a->inviteurl}">{$a->acceptinvitation}</a></p>
<p>إذا لم تكن راغبًا بالانضمام إلى هذا المقرر، يرجى استعمال الرابط الآتي بدلاً منه:</p>
<p><a class="btn btn-danger" href="{$a->rejecturl}">{$a->rejectinvitation}</a></p>
<p>ترجى ملاحظة أن صلاحية هذين الرابطين تنتهي في <b>{$a->expiration}</b></p>
<p>إنني آمل أن أراك في المقرر.</p>';
$string['emailmsgunsubscribe'] = '<span class="apple-link">إذا كنت تعتقد أنك تلقيت هذه الرسالة عن طريق الخطأ، كنت بحاجة إلى مساعدة أو لا ترغب بتلقي المزيد من الدعوات إلى هذا المساق، رجاءً تواصل مع:</span> <a href="mailto:{$a->supportemail}">{$a->supportemail}</a>.';
$string['emailtitleuserenrolled'] = '{$a->userfullname} قد قبِل الدعوة إلى {$a->coursefullname}.';
$string['enrolconfimation'] = 'يتطلب تأكيد الطلاب على الانضمام';
$string['err_cohortlist'] = 'أو ينبغي عليك اختيار الزمر هنا.';
$string['err_userlist'] = 'أو ينبغي عليك اختيار المستخدمين هنا.';
$string['event_invitation_accepted'] = 'قُبلت';
$string['event_invitation_attempted'] = 'محاولة';
$string['event_invitation_deleted'] = 'حُذفت';
$string['event_invitation_rejected'] = 'رفضت';
$string['event_invitation_sent'] = 'أرسلت';
$string['event_invitation_updated'] = 'حُدّثت';
$string['event_invitation_viewed'] = 'شوهدت';
$string['expiredtoken'] = 'انتهت صلاحية ترميز الدعوة أو سبق وأن تم استعماله.';
$string['extend_invite_sucess'] = 'تم تمديد الدعوة بنجاح';
$string['failuredescription'] = 'فشل: المستخدم ذو المُعرَّف {$a->userid}، المساق ذو المُعرَّف \'{$a->courseid}\'. السبب: {$a->errormsg}.';
$string['half_minute'] = 'نصف دقيقة';
$string['header_email'] = 'من تريد أن تدعوه؟';
$string['header_role'] = 'ما هو الدور الذي تريد تعيينه للمدعو؟';
$string['historyactions'] = 'الإجراءات';
$string['historydateexpiration'] = 'تاريخ انتهاء الصلاحية';
$string['historydatesent'] = 'تاريخ إرسالها';
$string['historyexpires_in'] = 'تنتهي صلاحيتها في';
$string['historyinvitee'] = 'المدعو';
$string['historyrole'] = 'الدور';
$string['historystatus'] = 'الحالة';
$string['historyundefinedrole'] = 'تعذر العثور على الدور. يرجى إعادة إرسال الدعوة واختيار دور آخر.';
$string['invitation:config'] = 'تهيئة عيِّنات الدعوة';
$string['invitation:enrol'] = 'دعوة المستخدمين';
$string['invitation:manage'] = 'إدارة تعيينات الدعوة';
$string['invitation:unenrol'] = 'إلغاء تعيين المستخدمين في المساق';
$string['invitation:unenrolself'] = 'إلغاء تعيين نفسه في المساق';
$string['invitation_acceptance_title'] = 'قبول الدعوة';
$string['invitationacceptance'] = '<p>أنت مدعو للوصول إلى <strong>{$a->coursefullname}</strong> بصفة <strong>{$a->rolename}</strong>. يرجى تأكيد قبولك للانضمام إلى هذا المساق.</p>';
$string['invitationacceptancebutton'] = 'قبول الدعوة';
$string['invitationrejectbutton'] = 'رفض الدعوة';
$string['invitationrejected'] = 'الدعوة رُفضت';
$string['invitationsuccess'] = 'الدعوة أُرسلت بنجاح';
$string['inviteexpiration'] = 'انتهاء صلاحية الدعوة';
$string['inviteexpiration_desc'] = 'طول المدة التي تكون فيها الدعوة سارية (بالثواني). الافتراضي هو أسبوعان.';
$string['invitehistory'] = 'ماضي الدعوة';
$string['inviteusers'] = 'دعوة المستخدمين';
$string['invtitation_rejected_notice'] = '<p>هذه الدعوة قد تم رفضها.</p>';
$string['less_minute'] = 'أقل من دقيقة';
$string['less_than_x_seconds'] = 'أقل من {$a} من الثواني';
$string['loggedinnot'] = '<p>ينبغي عليك تسجيل الدخول قبل أن يتسنى لك قبول هذه الدعوة.</p>';
$string['message'] = 'الرسالة';
$string['message_help_link'] = 'أنظر التعليمات التي أُرسلت إلى المدعويين';
$string['noenddate'] = 'بلا تاريخ انتهاء';
$string['noinvitationinstanceset'] = 'لم يتم العثور على أي عيِّنة للانضمام. يرجى إضافة عيِّنة انضمام الدعوة إلى مساقك أولاً.';
$string['noinvitehistory'] = 'لم يتم إرسال أي دعوات بعد';
$string['nopermissiontosendinvitation'] = 'لا صلاحية لإرسال الدعوة';
$string['norole'] = 'يرجى اختيار الدور';
$string['notify_inviter'] = 'إشعاري من خلال {$a->email} عندما يقبل المستخدمون المدعوون هذه الدعوة.';
$string['notsentdescription'] = 'المستخدم ذو المُعرَّف {a->userid} فشل في إرسال الدعوة إلى المساق ذي المُعرَّف \'{a->courseid}\' بسبب عدم وجود أي حساب يمتلك عنوان البريد الالكتروني \'{a->email}\'.';
$string['pluginname'] = 'الدعوة';
$string['pluginname_desc'] = 'إن وحدة الدعوة تسمح بإرسال الدعوات عبر البريد الالكتروني. يمكن استعمال تلك الدعوات لمرة واحدة فقط. المستخدمون الذين ينقرون على الرابط في البريد الالكتروني يتم ضمهم تلقائيًا.';
$string['registeredonly'] = 'إرسال الدعوات فقط إلى المستخدمين المسجلين';
$string['registeredonly_help'] = 'سيقتصر إرسال الدعوات على عناوين البريد الالكتروني العائدة إلى المستخدمين المسجلين.';
$string['rejecteddescription'] = 'المستخدم ذو المُعرَّف {$a->userid} قد رفض الدعوة إلى المساق ذي المُعرَّف \'{$a->courseid}\'.';
$string['reminder'] = 'التذكير:';
$string['resend_invite_sucess'] = 'الدعوة أُعيد إرسالها بنجاح';
$string['returntocourse'] = 'عودة إلى المساق';
$string['returntoinvite'] = 'إرسال دعوة أخرى';
$string['revoke_invite_sucess'] = 'الدعوة سُحِبت بنجاح';
$string['sentdescription'] = 'المستخدم ذو المُعرَّف {$a->userid} أرسل دعوة إلى المساق ذي المُعرَّف \'{$a->courseid}\' وإلى العنوان \'{$a->email}\'.';
$string['show_from_email'] = 'السماح للمستخدم المدعو بالتواصل معي عبر {$a->email} (سيكون عنوان بريدك في حقل "من". إذا لم يتم تأشيره، سيكون حقل "من" معبأ بـ {$a->supportemail})';
$string['status'] = 'السماح بالدعوات';
$string['status_desc'] = 'السماح للمستخدمين بدعوة الناس للانضمام إلى المساق إفتراضيًا.';
$string['status_invite_active'] = 'نشط';
$string['status_invite_expired'] = 'منته الصلاحية';
$string['status_invite_invalid'] = 'خاطئة';
$string['status_invite_rejected'] = 'رُفضت';
$string['status_invite_resent'] = 'أُعيد إرسالها';
$string['status_invite_revoked'] = 'سُحبت';
$string['status_invite_used'] = 'قُبلت';
$string['status_invite_used_expiration'] = '(ينتهي الوصول في {$a})';
$string['status_invite_used_noaccess'] = '(لم يعد متاح له الوصول)';
$string['subject'] = 'الموضوع';
$string['unenrol'] = 'إلغاء انضمام المستخدم';
$string['unenroluser'] = 'هل ترغب حقًا في إلغاء انضمام "{$a->user}" إلى المساق "{$a->course}"؟';
$string['updateddescription'] = 'المستخدم ذو المُعرَّف {$a->userid} قام بتمديد الدعوة إلى المساق ذي المُعرَّف \'{$a->courseid} وإلى \'{$a->email}\'.';
$string['used_by'] = 'من قِبل {$a->username} ({$a->roles}، {$a->useremail}) في {$a->timeused}';
$string['usedefaultvalues'] = 'استعمل الدعوة مع القيم الافتراضية';
$string['usernotmatch'] = '<p>الدعوة موجهة إلى مستخدم آخر.</p>';
$string['vieweddescription'] = 'المستخدم ذو المُعرَّف {$a->userid} شاهد الدعوة إلى المساق ذي المُعرَّف \'{$a->courseid}\'.';
$string['x_days'] = '{$a} من الأيام';
$string['x_minutes'] = '{$a} من الدقائق';
