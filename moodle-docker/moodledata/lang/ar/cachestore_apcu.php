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
 * Strings for component 'cachestore_apcu', language 'ar', version '5.1'.
 *
 * @package     cachestore_apcu
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['clusternotice'] = 'لطفاً، كن على دراية بأن APCu هو مجرد خيار مناسب لمواقع العقدة المفردة أو المخبوءات التي يمكن تخزينها محلياً.
لمزيد من المعلومات، راجع <a href="{$a}">توثيقات مخبأ مستخدم APC</a>.';
$string['notice'] = 'تنويه';
$string['pluginname'] = 'خبء مستخدم APC (APCu)';
$string['prefix'] = 'اختصار';
$string['prefix_help'] = 'يتم استخدام البادئة أعلاه لجميع المفاتيح التي يتم تخزينها في مثيل متجر APC هذا. بشكل افتراضي ، يتم استخدام بادئة قاعدة البيانات.';
$string['prefixinvalid'] = 'البادئة التي حددتها غير صالحة. يمكنك فقط استخدام az AZ 0-9-_.';
$string['prefixnotunique'] = 'البادئة التي حددتها ليست فريدة. يرجى اختيار بادئة فريدة من نوعها.';
$string['privacy:metadata'] = 'تخزن إضافة خبء المستخدم APC (APCu) البيانات لفترة وجيزة كجزء من وظيفة التخزين المؤقت ولكن يتم مسح هذه البيانات بانتظام ولا يتم إرسالها خارجياً بأيّ طريقة.';
$string['testperformance'] = 'إختبار الأداء';
$string['testperformance_desc'] = 'في حالة التمكين، سيتم تضمين أداء APCu عند عرض صفحة إختبار الأداء. تمكينه على موقع الإنتاج غير مستحسن.';
