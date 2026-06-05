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
 * Strings for component 'swiftquiz', language 'ar', version '5.1'.
 *
 * @package     swiftquiz
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['instructions_for_instructor'] = '<h3>ترجى قراءة التعليمات بإمعان:</h3>
    <p>هناك مفاتيح ساخنة متاحة، يمكن استعمالها عندما لا يكون حقل الإدخال حائزًا على التركيز.</p>
    <table>
        <tr>
               <th>المسيطر</th>
               <th>المفتاح الساخن</th>
               <th>الوصف</th>
        </tr>
        <tr>
            <td>
                <i class="fa fa-repeat"></i> Re-poll
            </td>
            <td>r</td>
            <td>
                يسمح للمرشد بإعادة طرح السؤال الذي تمت إجابته توًا.
                هذا مشابه للبدء بالسؤال من <i class="fa fa-bars"></i> قائمة القفز المنسدلة.
            </td>
        </tr>
        <tr>
            <td>
                <i class="fa fa-bar-chart"></i> Vote
            </td>
            <td>v</td>
            <td>
                 السماح للطلاب بالتصويت على إجاباتهم.
                 يمكن للمرشد النقر على إجابة للتبديل ما بين ما إذا كان ينبغي تضمينها في التصويت أم لا.
                 النقر على شريط الإجابة سيبدأ دمجًا من تلك الإجابة.
                 لاحظ بأن ذلك الشريط سيستحوذ على الشريط الذي تنقر عليه لاحقًا.
            </td>
        </tr>
        <tr>
            <td>
                <i class="fa fa-edit"></i> إرتجل
            </td>
            <td>i</td>
            <td>
                يظهر الأسئلة المعدة للاتجال. أكتب الأسئلة على السبورة وأطلب الإدخال من بين تلك الأسئلة.
            </td>
        </tr>
        <tr>
            <td>
                <i class="fa fa-bars"></i> القفز
            </td>
            <td>j</td>
            <td>
                يظهر قائمة بكل الأسئلة المعدة للاختبار.
            </td>
        </tr>
        <tr>
            <td>
                <i class="fa fa-forward"></i> التالي
            </td>
            <td>n</td>
            <td>
                الاستمرار مع السؤال التالي من قائمة الأسئلة المعدة للاختبار.
            </td>
        </tr>
        <tr>
            <td>
                <i class="fa fa-close"></i> إنهاء
            </td>
            <td>e</td>
            <td>
                إنهاء السؤال الحالي.
            </td>
        </tr>
        <tr>
            <td>
                <i class="fa fa-expand"></i> ملء الشاشة
            </td>
            <td>f</td>
            <td>
                إظهار النتائج في ملء الشاشة. لن تظهر الإجابات في أثناء السؤال، لذلك يمكنك المتابعة بهذه الوتيرة طيلة الجلسة.
            </td>
        </tr>
        <tr>
            <td>
                <i class="fa fa-square-o"></i> / <i class="fa fa-check-square-o"></i> الإجابة
            </td>
            <td>a</td>
            <td>
                يعطي المرشد معاينة للسؤال مع تأشير على الإجابة الصائبة.
            </td>
        </tr>
        <tr>
            <td>
                <i class="fa fa-square-o"></i> / <i class="fa fa-check-square-o"></i> الإجابات
            </td>
            <td>t (toggle)</td>
            <td>
                إظهار إجابات الطلاب أو إخفائها.
            </td>
        </tr>
        <tr>
            <td>
                <i class="fa fa-window-close"></i> الخروج
            </td>
            <td></td>
            <td>
                الخروج من جلسة الاختبار الحالية.
            </td>
        </tr>
    </table>';
