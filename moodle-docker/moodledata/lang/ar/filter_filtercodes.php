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
 * Strings for component 'filter_filtercodes', language 'ar', version '5.1'.
 *
 * @package     filter_filtercodes
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['enable_customnav'] = 'دعم التنقل المخصص';
$string['formcheckin'] = '<form action="{wwwroot}/local/contact/index.php" method="post" class="cf check-in">
    <fieldset>
        <input type="hidden" id="subject" name="subject" value="حاضر!">
        <input type="hidden" id="sesskey" name="sesskey" value="">
        <script>document.getElementById("sesskey").value = M.cfg.sesskey;</script>
        {recaptcha}
    </fieldset>
    <div>
        <input type="submit" name="submit" id="submit" value="أنا هنا">
    </div>
</form>';
$string['formcontactus'] = '<form action="{wwwroot}/local/contact/index.php" method="post" class="cf contact-us">
    <fieldset>
        <div class="form-group">
            <label for="name" id="namelabel" class="d-block">إسمك <strong class="required">(مطلوب)</strong></label>
            <input id="name" name="name" type="text" size="57" maxlength="45" pattern="[A-zÀ-ž]([A-zÀ-ž\\s]){2,}"
                    title="الحد الأدنى 3 حروف/فراغات." required="required" {readonly}{ifloggedin} disabled{/ifloggedin} value="{fullname}">
        </div>
        <div class="form-group">
            <label for="email" id="emaillabel" class="d-block">عنوان البريد الالكتروني <strong class="required">(مطلوب)</strong></label>
            <input id="email" name="email" type="email" size="57" maxlength="60"
                    required="required" {readonly}{ifloggedin} disabled{/ifloggedin} value="{email}">
        </div>
        <div class="form-group">
            <label for="subject" id="subjectlabel" class="d-block">الموضوع <strong class="required">(مطلوب)</strong></label>
            <input id="subject" name="subject" type="text" size="57" maxlength="80" minlength="5"
                    title="الحد الأدنى 5 حروف." required="required">
        </div>
        <div class="form-group">
            <label for="message" id="messagelabel" class="d-block">الرسالة <strong class="required">(مطلوب)</strong></label>
            <textarea id="message" name="message" rows="5" cols="58" minlength="5"
                    title="الحد الأدنى 5 حروف." required="required"></textarea>
        </div>
        <input type="hidden" id="sesskey" name="sesskey" value="">
        <script>document.getElementById("sesskey").value = M.cfg.sesskey;</script>
        {recaptcha}
    </fieldset>
    <div>
        <input type="submit" name="submit" id="submit" value="إرسال">
    </div>
</form>';
$string['formcourserequest'] = '<form action="{wwwroot}/local/contact/index.php" method="post" class="cf new-course-request">
    <fieldset>
        <div class="form-group">
            <label for="name" id="namelabel" class="d-block">إسمك <strong class="required">(مطلوب)</strong></label>
            <input id="name" name="name" type="text" size="57" maxlength="45" pattern="[A-zÀ-ž]([A-zÀ-ž\\s]){2,}"
                    title="الحد الأدنى 3 حروف/فراغات." required="required" {readonly}{ifloggedin} disabled{/ifloggedin} value="{fullname}">
        </div>
        <div class="form-group">
            <label for="email" id="emaillabel" class="d-block">عنوان البريد الالكتروني <strong class="required">(مطلوب)</strong></label>
            <input id="email" name="email" type="email" size="57" maxlength="60" required="required" {readonly}{ifloggedin} disabled{/ifloggedin} value="{email}">
        </div>
        <div class="form-group">
            <label for="new_course_name" id="new_course_namelabel" class="d-block">الاسم المقترح للمساق الدراسي الجديد <strong class="required">(مطلوب)</strong></label>
            <input id="new_course_name" name="new_course_name" type="text" size="57" maxlength="80" minlength="5"
                    title="الحد الأدنى 5 حروف." required="required">
        </div>
        <div class="form-group">
            <label for="description" id="descriptionlabel" class="d-block">وصف المساق <strong class="required">(مطلوب)</strong></label>
            <textarea id="description" name="description" rows="5" cols="58" minlength="5"
                    title="الحد الأدنى 5 حروف." required="required"></textarea>
        </div>
        <input type="hidden" id="sesskey" name="sesskey" value="">
        <script>document.getElementById("sesskey").value = M.cfg.sesskey;</script>
        {recaptcha}
    </fieldset>
    <div>
        <input type="submit" name="submit" id="submit" value="إرسال الطلب لهذا المساق">
    </div>
</form>';
$string['formquickquestion'] = '<form action="{wwwroot}/local/contact/index.php" method="post" class="cf contact-us">
    <fieldset>
        <div class="form-group">
            <label for="subject" id="subjectlabel" class="d-block">الموضوع <strong class="required">(مطلوب)</strong></label>
            <input class="block" id="subject" name="subject" type="text" size="57" maxlength="80" minlength="5"
                    title="الحد الأدنى 5 حروف." required="required">
        </div>
        <div class="form-group">
            <label for="message" id="messagelabel" class="d-block">الرسالة <strong class="required">(مطلوب)</strong></label>
            <textarea id="message" name="message" rows="5" cols="58" minlength="5"
                    title="الحد الأدنى 5 حروف." required="required"></textarea>
        </div>
        <input type="hidden" id="sesskey" name="sesskey" value="">
        <script>document.getElementById("sesskey").value = M.cfg.sesskey;</script>
        {recaptcha}
    </fieldset>
    <div>
        <input type="submit" name="submit" id="submit" value="إرسال">
    </div>
</form>';
$string['formsupport'] = '<form action="{wwwroot}/local/contact/index.php" method="post" class="cf support-request">
    <fieldset>
        <div class="form-group">
            <label for="name" id="namelabel" class="d-block">إسمك <strong class="required">(مطلوب)</strong></label>
            <input id="name" name="name" type="text" size="57" maxlength="45" pattern="[A-zÀ-ž]([A-zÀ-ž\\s]){2,}"
                    title="الحد الأدنى 3 حروف/فراغات." required="required" {readonly}{ifloggedin} disabled{/ifloggedin} value="{fullname}">
        </div>
        <div class="form-group">
            <label for="email" id="emaillabel" class="d-block">البريد الالكتروني <strong class="required">(مطلوب)</strong></label>
            <input id="email" name="email" type="email" size="57" maxlength="60" required="required" {readonly}{ifloggedin} disabled{/ifloggedin} value="{email}">
        </div>
        <div class="form-group">
            <label for="subject" id="subjectlabel" class="d-block">الموضوع <strong class="required">(مطلوب)</strong></label>
            <select id="subject" name="subject" required="required">
                <option label="إختر الموضوع"></option>
                <option>لا أستطيع تغيير كلمة مروري</option>
                <option>لا يمكنني الدخول</option>
                <option value="إقتراح">عندي اقتراح</option>
                <option value="رسالة خطأ">تواجهني رسالة خطأ</option>
                <option value="خطأ في النظام">شيء ما لا يعمل كما ينبغي</option>
                <option value="المساق">تواجهني صعوبة في الوصول إلى المساق أو بعض محتوياته</option>
                <option value="سبب آخر">غيرها (حددها لطفًا)</option>
            </select>
        </div>
        <div class="form-group">
            <label for="specific_subject" id="specifylabel" class="d-block">موضوع محدد أو اسم المقرر&nbsp;<strong class="required">(مطلوب)</strong></label>
            <input type="text" id="specific_subject" name="specific_subject" size="57" maxlength="80" required="required">
        </div>
        <div class="form-group">
            <label for="url" id="urllabel" class="d-block">حدد عنوان الرابط</label>
            <input type="url" id="url" name="url" size="57" maxlength="80" value="{referer}">
        </div>
        <div class="form-group">
            <label for="description" id="descriptionlabel" class="d-block">الوصف وتفاصيل خطوة بخطوة عن كيفية إعادة توليد المشكلة&nbsp;<strong class="required">(مطلوب)</strong></label>
            <textarea id="description" name="description" rows="5" cols="58" minlength="5"
                    title="الحد الأدنى 5 حروف." required="required"></textarea>
        </div>
        <input type="hidden" id="sesskey" name="sesskey" value="">
        <script>document.getElementById("sesskey").value = M.cfg.sesskey;</script>
        {recaptcha}
    </fieldset>
    <div>
        <input type="submit" name="submit" id="submit" value="إرسال الطلب للمساعدة">
    </div>
</form>';
$string['privacy:metadata'] = 'إن إضافة رموز المرشح لا تخزن أي بيانات شخصية عن أي مستخدم.';
$string['sizeb'] = '&nbsp;بايت';
$string['sizeeb'] = '&nbsp;اكسا بايت';
$string['sizegb'] = '&nbsp;غيغا بايت';
$string['sizekb'] = '&nbsp;كيلو بايت';
$string['sizemb'] = '&nbsp;ميغا بايت';
$string['sizetb'] = '&nbsp;تيرا بايت';
$string['sizeyb'] = '&nbsp;يوتا بايت';
$string['sizezb'] = '&nbsp;زيتا بايت';
