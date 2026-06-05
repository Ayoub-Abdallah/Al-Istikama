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
 * Strings for component 'gradepenalty_duedate', language 'ar', version '5.1'.
 *
 * @package     gradepenalty_duedate
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addrule'] = 'إضافة قاعدة';
$string['deleteallrules'] = 'حذف كل القواعد';
$string['duedate:manage'] = 'صلاحية إدارة قواعد الغرامات';
$string['duedaterule'] = 'قواعد الغرامات';
$string['editduedaterule'] = 'تحرير قواعد الغرامات';
$string['error_overdueby_abovevalue'] = 'مقدار التأخير ينبغي أن يكون أكبر من قيمة القاعدة أعلاه: {$a}.';
$string['error_overdueby_maxvalue'] = 'الاستيجاب لا يمكن أن يكون أكبر من {$a}.';
$string['error_overdueby_minvalue'] = 'الاستيجاب ينبغي أن يكون مساويًا أو أكبر من {$a}';
$string['error_penalty_abovevalue'] = 'الغرامة ينبغي أن تكون أكبر من الغرامة للقاعدة أعلاه: ({$a}%).';
$string['error_penalty_maxvalue'] = 'الغرامة لا يمكن أن تكون أكبر من: {$a}.';
$string['error_penalty_minvalue'] = 'الغرامة ينبغي أن تكون مساويًا أو أكبر من: {$a}.';
$string['existingrule'] = 'القواعد الموجودة';
$string['finalpenaltyrule'] = 'قاعدة الغرامة النهائية';
$string['finalpenaltyrule_help'] = 'قاعدة الغرامة النهائية تحدد الغرامة التي تُطبق على التسليمات التي تتجاوز فترة تأخيرها الفترات المُعرفة مع كل غرامات التأخير الأخرى.';
$string['insertrule'] = 'أدرج أدناه';
$string['overdueby'] = 'الاستيجاب';
$string['overdueby_help'] = 'الوقت بالثواني بعد تاريخ الاستيجاب الذي سيتم فيه تطبيق الغرامة.';
$string['overdueby_label'] = 'الاستيجاب:';
$string['overdueby_lastrow'] = '&gt; {$a}';
$string['overdueby_onerow'] = 'كل التسليمات المتأخرة';
$string['overdueby_row'] = '&le; {$a}';
$string['penalty'] = 'الغرامة';
$string['penalty_help'] = 'الغرامة بنسبة مئوية التي سيتم تطبيقها على التسليمات المتأخرة.';
$string['penalty_label'] = 'الغرامة:';
$string['penaltyrule'] = 'قواعد الغرامات';
$string['penaltyrule_group'] = 'قاعدة الغرامة {no}';
$string['penaltyrule_inherited'] = 'قواعد الغرامات التي في هذا السياق موروثة من سياق أعلى رتبة. أنقر على زر "التحرير" لتجاوز القيم.';
$string['penaltyrule_not_inherited'] = 'أنقر على زر "تحرير" لتغيير القواعد أو إنشائها.';
$string['penaltyrule_overridden'] = 'تم تخطي قواعد الغرامات. يمكنك النقر على زر "إعادة التعيين" لإزالة القواعد التي أدت إلى التخطي. هذا سيؤدي إلى إزالتها جميعًا إذا لم يكن هناك أي قواعد في السياق الأعلى رتبة.';
$string['pluginname'] = 'غرامات التسليم المتأخر';
$string['privacy:metadata:gradepenalty_duedate_rule'] = 'جدول غرامات الدرجة لتاريخ الاستيجاب';
$string['privacy:metadata:gradepenalty_duedate_rule:usermodified'] = 'المستخدم الذي غير القاعدة';
$string['resetconfirm'] = 'هذا من شأنه إزالة كل القواعد المعدة لهذا السياق. هل أنت متأكد من رغبتك في المتابعة؟';
