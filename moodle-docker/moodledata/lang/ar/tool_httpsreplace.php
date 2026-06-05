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
 * Strings for component 'tool_httpsreplace', language 'ar', version '5.1'.
 *
 * @package     tool_httpsreplace
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['complete'] = 'منجز';
$string['count'] = 'عدد عناصر المحتوى المضمنة';
$string['disclaimer'] = 'أنا أفهم مخاطر هذه العملية';
$string['doclink'] = 'أداة تحويل HTTPS';
$string['doit'] = 'نفذ التحويل';
$string['domain'] = 'مجال إشكالي';
$string['domainexplain'] = 'عندما يتم نقل موقع من HTTP إلى HTTPS، فإن جميع محتويات HTTP المضمنة ستتوقف عن العمل.
تتيح لك هذه الأداة تحويل محتوى HTTP تلقائياً إلى HTTPS.

قبل إجراء التحويل، سيتم فحص المحتوى للعثور على أي روابط قد لا تعمل بعد التحويل. قد ترغب بعدها في التحقق من وجود رابط HTTPS لكل منها، أو العثور على موارد بديلة.';
$string['domainexplainhelp'] = 'تم العثور على هذه المجالات في المحتوى الخاص بك، ولكن لا يبدو أنها تدعم محتوى HTTPS. بعد التبديل إلى HTTPS، لن يتم عرض المحتوى المتضمن من هذه المواقع داخل مودل للمستخدمين ذوي المتصفحات الحديثة الآمنة. من المحتمل أن تكون هذه المواقع غير متاحة مؤقتاً أو بشكل دائم ولن تعمل مع أي إعداد للأمان. تابع فقط بعد مراجعة هذه النتائج وتحديد ما إذا كان هذا المحتوى المستضاف خارجياً غير أساسي. ملاحظة: لن يعمل هذا المحتوى بعد التبديل إلى HTTPS على أي حال.';
$string['httpwarning'] = 'لا يزال هذا المثيل قيد التشغيل على HTTP. لا يزال بإمكانك تشغيل هذه الأداة وسيتم تغيير المحتوى الخارجي إلى HTTPS ، ولكن سيبقى المحتوى الداخلي على HTTP. ستحتاج إلى تشغيل هذا البرنامج النصي مرة أخرى بعد التبديل إلى HTTPS لتحويل المحتوى الداخلي.';
$string['notimplemented'] = 'عذرًا ، هذه الميزة غير مطبقة في برنامج تشغيل قاعدة البيانات لديك.';
$string['oktoprocede'] = 'لا يجد الفحص أي مشاكل مع المحتوى الخاص بك. يمكنك المتابعة لترقية أي محتوى HTTP لاستخدام HTTPS.';
$string['pageheader'] = 'قم بترقية عناوين URL للمحتوى المستضاف خارجيًا إلى HTTPS';
$string['pluginname'] = 'أداة تحويل HTTPS';
$string['privacy:metadata'] = 'إن ملحق أداة تحويل HTTPS لا يخزن أي بيانات شخصية.';
$string['replacing'] = 'استبدال محتوى HTTP بـ HTTPS ...';
$string['searching'] = 'البحث عن {$a}';
$string['takeabackupwarning'] = 'تحذير: بعد تشغيل هذه الأداة ، لا يمكن التراجع عن التغييرات. يوصى بعمل نسخة احتياطية للموقع قبل المتابعة ، حيث يوجد خطر ضئيل في استبدال المحتوى الخاطئ.';
$string['toolintro'] = 'إذا كنت تخطط لتحويل موقعك إلى HTTPS، فيمكنك استعمال <a href="{$a}">أداة تحويل HTTPS</a>  لتحويل المحتوى المضمن لديك إلى HTTPS.';
