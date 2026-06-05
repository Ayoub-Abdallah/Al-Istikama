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
 * Strings for component 'enrol_fee', language 'ar', version '5.1'.
 *
 * @package     enrol_fee
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['assignrole'] = 'تعيين الدور';
$string['cost'] = 'رسوم الانضمام';
$string['costerror'] = 'رسوم الانضمام ينبغي أن تكون رقماً.';
$string['currency'] = 'العملة';
$string['defaultrole'] = 'تعيين الدور الافتراضي';
$string['defaultrole_desc'] = 'إختر الدور المفترض تعيينه إلى المستخدمين بعد قيامهم بالتسديد.';
$string['enrolenddate'] = 'تاريخ الانتهاء';
$string['enrolenddate_help'] = 'عند تمكينه، سيستمر انضمام المستخدمين حتى ذلك اليوم فقط.';
$string['enrolenddaterror'] = 'تاريخ انتهاء الانضمام لا يمكن أن يكون سابقاً لتاريخ بدئه.';
$string['enrolperiod'] = 'فترة الانضمام';
$string['enrolperiod_desc'] = 'الفترة الافتراضية التي يستغرقها الانضمام. عند جعلها صفراً، ستكون فترة الانضمام غير محدودة إفتراضياً';
$string['enrolperiod_help'] = 'الفترة التي يستغرقها الانضمام بدءاً من اللحظة التي انضم فيها المستخدم. عند تعطيله، ستكون فترة الانضمام غير محدودة.';
$string['enrolstartdate'] = 'تاريخ البدء';
$string['enrolstartdate_help'] = 'عند تمكينه، سيبدأ انضمام المستخدمين من ذلك اليوم وما بعهده.';
$string['expiredaction'] = 'إجراء انتهاء صلاحية الانضمام';
$string['expiredaction_help'] = 'إختر الإجراء المطلوب اتخاذه عند انتهاء صلاحية انضمام المستخدم. يرجى ملاحظة أن بعض بيانات المستخدم وإعداداته يجري حذفها عند إلغاء انضمامه.';
$string['fee:config'] = 'تهيئة الانضمام في عينات الانضمام بالدفع المالي';
$string['fee:manage'] = 'إدارة المستخدمين المنضمين';
$string['fee:unenrol'] = 'إلغاء انضمام المستخدمين إلى المساق';
$string['fee:unenrolself'] = 'إلغاء انضمامه إلى المساق';
$string['instancedescription'] = 'وصف العيِّنة';
$string['instancedescription_help'] = 'الوصف يُعرض فقط في صفحة \'طرق الانضمام\' ولا يظهر للمستخدمين المنضمين إلى المساق.';
$string['nocost'] = 'ليست هناك تكلفة عند الانضمام إلى هذا المساق!';
$string['paymentaccount'] = 'حساب الدفع المالي';
$string['paymentaccount_help'] = 'رسوم الانضمام سيتم تسديدها إلى هذا الحساب.';
$string['pluginname'] = 'الانضمام عند الدفع المالي';
$string['pluginname_desc'] = 'إن طريقة الانضمام عبر الدفع المالي تسمح لك بإعداد المقررات الدراسية التي تتطلب تسديد مبالغ مالية. إذا تم جعل رسوم أي مقرر صفراً، فلن تتم مطالبة الطلبة بدفع المال مقابل الانضمام إليها. هناك رسوم على مستوى الموقع يمكنك جعلها هنا إفتراضية لكل الموقع، وهناك إعدادات منفردة على مسوى كل مقرر. رسوم المساق تتجاوز رسوم الموقع.';
$string['privacy:metadata'] = 'إن إضافة الانضمام عبر الدفع المالي لا تخزن أي بيانات شخصية.';
$string['purchasedescription'] = 'الانضمام إلى المساق {$a}';
$string['sendpaymentbutton'] = 'إختر نوع الدفع المالي';
$string['status'] = 'الانضمامات العائدة للسماح بالانضمام عند الدفع المالي';
$string['status_desc'] = 'السماح للمستخدمين بالدفع المالي من أجل الانضمام إلى المقررات الدراسية إفتراضياً.';
