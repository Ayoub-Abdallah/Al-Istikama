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
 * Strings for component 'theme_boost_magnific', language 'ar', version '5.1'.
 *
 * @package     theme_boost_magnific
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['background_color'] = 'لون الخلفية';
$string['background_color_desc'] = 'لون الخلفية لرأس وتذييل الصفحة!';
$string['background_color_random'] = 'القالب العشوائي {$a}';
$string['background_text_color'] = 'لون النص';
$string['background_text_color_desc'] = 'لون النص العلوي ولون نص التذييل!';
$string['choosereadme'] = 'Boost Magnific هو مظهر مُصمّم بعناية لجلب ألوان مرحة إلى مودل.';
$string['contact_address'] = 'العنوان';
$string['contact_email'] = 'البريد الالكتروني';
$string['contact_phone'] = 'رقم الهاتف';
$string['content_type_default'] = 'الافتراضي لمودل';
$string['content_type_empty'] = '(بلا محتوى)';
$string['content_type_footer'] = 'نوع المحتوى للتذييل';
$string['content_type_footer_desc'] = 'إختر نوع المحتوى الذي تريد عرضه في التذييل.';
$string['content_type_home'] = 'نوع المحتوى للصفحة الرئيسية';
$string['content_type_home_desc'] = 'إختر نوع المحتوى الذي تريد عرضه في الصفحة الرئيسية.';
$string['content_type_html'] = 'الصفحة التي سيتم إنشاؤها باستعمال المحرر';
$string['continuar'] = 'متابعة الدراسة';
$string['countlesson'] = 'درس {$a}';
$string['countlessons'] = 'دروس {$a}';
$string['course_access'] = 'الوصول إلى المقرر الدراسي';
$string['course_moore'] = 'مزيد من التفاصيل';
$string['customcss'] = 'CSS مخصص';
$string['customcss_desc'] = 'أي قواعد CSS تضيفها إلى منطقة النص هذه ستنعكس على كل الصفحات، مما يجعل من السهل تخصيص هذا القالب.';
$string['custommenuitems'] = 'عناصر القائمة العلوية المخصصة';
$string['custommenuitems_desc'] = 'يمكنك إنشاء قائمة مخصصة جنبًا إلى جنب مع القوائم العلوية. يجب أن تبدأ القائمة الجذرية بمسافة من حافة الصفحة، ويجب أن تسبق القوائم الفرعية برمز الشرطة (-). يحدد عدد الشرطات عمق العنصر. وبالتالي، تظهر العناصر ذات الشرطة الواحدة في قائمة فرعية تحت العنصر الرئيسي السابق، وتظهر العناصر ذات الشرطتين في قائمة فرعية تحت القائمة الفرعية السابقة.
محتوى كل عنصر في القائمة يجب أن يتكون من ما يصل إلى ثلاث عناصر (<strong>التسمية</strong> | <strong>الرابط</strong> | <strong>تلميح</strong> | <strong>اللغة</strong>)، مفصولة بالرمز "|".
<ul>
<li><strong>التسمية</strong>: هذا هو النص الذي سيتم عرضه داخل عنصر القائمة. يجب عليك تحديد تسمية لكل عنصر في القائمة.</li>
<li><strong>الرابط</strong>: هذا هو الرابط الذي سيرتبط به المستخدم عند النقر على عنصر القائمة. هذا اختياري؛ إذا لم يتم توفيره، فلن يتم ربط العنصر في أي مكان.<br>
يمكن إضافة سمات أخرى مثل "الهدف" إلى نهاية الرابط.</li>
<li><strong>التلميح</strong>: إذا قدمت رابطًا، يمكنك أيضًا اختيار تقديم تلميح للرابط الذي تم إنشاؤه بالرابط. هذا اختياري، وإذا لم يتم تحديده، فسيتم استخدام التسمية كتلميح لعنصر القائمة.</li>
<li><strong>اللغة</strong>: يمكنك إضافة رمز لغة (أو قائمة من الرموز المفصولة بالفواصل) كالعنصر الرابع في السطر. سيتم عرض السطر فقط إذا اختار المستخدم اللغة (أو اللغات) المدرجة.</li>
</ul>
فيما يلي مثال على كيفية إنشاء قائمة مخصصة:
<blockquote><pre>
المقررات
-كل المقررات | /course/
-مقرراتي
--مقرر توضيحي
---مقرر توضيحي 7 | /course/view.php?id=7
---مقرر توضيحي 9 | /course/view.php?id=9
--مقرر تجريبي
---مقرر تجريبي 2 | /course/view.php?id=2
---مقرر تجريبي 5 | /course/view.php?id=5
قوقل
-قوقل بأي لغة | https://google.com/" target="_blank
-قوقل في المكسيك | https://www.google.com.mx/" target="_blank|Google Label|en
-قوقل بالبرتغالية | https://google.com.br/" target="_blank|Google Label|pt,pt_br,pt_br_kids
صفحة الدعم | https://support.com/" target="_blank
</pre></blockquote>
لـ Moodle مع دعم للغات متعددة، يجب تنسيق قيمة <strong>التسمية</strong> على النحو التالي <strong>"اسم السلسلة النصية للغة,اسم المكون"</strong>.
<blockquote><pre>
profile,moodle | /user/profile.php
messages,message | /message/index.php
</pre></blockquote>
<a href="https://docs.moodle.org/404/en/Advanced_theme_settings" target="_blank">معلومات إضافية حول القائمة</a>';
$string['editor_link_footer'] = 'تحرير كتلة التذييل للغة {$a}';
$string['editor_link_footer_all'] = 'تحرير كتلة التذييل لكل اللغات';
$string['editor_link_home'] = 'تحرير الصفحة الرئيسية للغة {$a}';
$string['editor_link_home_all'] = 'تحرير الصفحة الرئيسية لكل اللغات';
$string['favicon'] = 'الأيقونة المفضلة';
$string['favicon_desc'] = 'يتم عرض الشعار المفضل للموقع بجوار عنوان الصفحة في تبويب المتصفح. يتم عرض الشعار المفضل الافتراضي لـمودل إذا لم يتم توفير شعار مفضل مخصص للموقع.';
$string['fontfamily'] = 'خطوط النص الخاصة بالموقع';
$string['fontfamily_desc'] = 'إختر الخط الذي تريد استعماله للنص في موقع مودل الخاص بك.';
$string['fontfamily_menus'] = 'خطوط القوائم';
$string['fontfamily_menus_desc'] = 'إختر الخط الذي تريد استعماله للقوائم في موقع مودلالخاص بك.';
$string['fontfamily_sitename'] = 'خط اسم الموقع';
$string['fontfamily_sitename_desc'] = 'الخط الذي سيتم تطبيقه على اسم الموقع إذا لم يتم توفير الشعار.';
$string['fontfamily_title'] = 'خطوط عناوين النص';
$string['fontfamily_title_desc'] = 'إختر الخط الذي تريد استعماله للعناوين في موقع مودل الخاص بك.';
$string['fontpreview'] = 'استعراض قائمة الخطوط';
$string['footer_contact_title'] = 'عنوان كتلة جهة الاتصال';
$string['footer_contact_title_default'] = 'اتصل بنا';
$string['footer_contact_title_desc'] = 'أدخل عنوان الكتلة التي ستظهر في التذييل مع تفاصيل جهة الاتصال بالموقع.';
$string['footer_description'] = 'الوصف';
$string['footer_description_desc'] = 'صف مودل الخاص بك، ما الذي تفعله، وسيتم عرض هذه المعلومات أسفل الشعار في تذييل مودل';
$string['footer_frontpage_blockcourses_instructor'] = 'إظهار اسم الأستاذ';
$string['footer_frontpage_blockcourses_instructor_desc'] = 'عند تأشيره، فإنه يعرض أسماء الأساتذة في قائمة المساق!';
$string['footer_frontpage_blockcourses_text'] = 'نص قصير يشرح كتلة "{$a}"';
$string['footer_frontpage_blockcourses_text_desc'] = 'أضف نصًا يتحدث عن "{$a}"!';
$string['footer_links_title'] = 'عنوان كتلة الروابط';
$string['footer_links_title_default'] = 'روابط مهمة';
$string['footer_show_copywriter'] = 'إظهار مصنوع بحب ❤️';
$string['footer_show_copywriter_desc'] = 'قم بإلغاء التحقق إذا كنت ترغب في إخفاء "مصنوع بحب ❤️"';
$string['footer_social_title'] = 'عنوان كتلة الروابط الاجتماعية';
$string['footer_social_title_default'] = 'تابعنا على وسائل التواصل الاجتماعي';
$string['footer_social_title_desc'] = 'أدخل عنوان الكتلة التي ستظهر في التذييل مع بيانات شبكاتك الاجتماعية.';
$string['footerblink'] = 'روابط كتلة التذييل';
$string['footerblink_desc'] = 'يمكنك تكوين روابط كتلة التذييل هنا ليتم عرضها بواسطة القوالب.<br>تتكون كل سطر من نص القائمة أو مفتاح اللغة أو النص، رابط URL (اختياري)، مفصولة بشريط عمودي. على سبيل المثال:<br><pre>الدعم Moodle|https://moodle.org/support</pre>';
$string['footerblock_contact'] = 'كتلة الاتصال';
$string['footerblock_copywriter'] = 'مصنوع بحب ❤️';
$string['footerblock_description'] = 'كتلة الوصف';
$string['footerblock_links'] = 'كتلة الروابط';
$string['footerblock_social'] = 'كتلة الروابط الاجتماعية';
$string['free_name'] = 'مجاناً';
$string['frontpage_about_description'] = 'صف ما تقوم به';
$string['frontpage_about_description_desc'] = 'صف في خطوط بحد أقصى 5 الغرض من Moodle الخاص بك';
$string['frontpage_about_enable'] = 'تمكين كتلة المعلومات';
$string['frontpage_about_enable_desc'] = 'إذا تم التحقق منها، ستظهر كتلة المعلومات تحت البانر!';
$string['frontpage_about_info'] = 'صندوق البيانات {$a}';
$string['frontpage_about_logo'] = 'شعار مختلف سيتم عرضه هنا';
$string['frontpage_about_logo_desc'] = 'إذا تم تعيينه، سيتم استعمال هذا الشعار هنا بدلاً من الشعار العلوي.<br>إذا كان فارغًا، سيتم استعمال الشعار العلوي!';
$string['frontpage_about_number'] = 'كمية البيانات';
$string['frontpage_about_number_desc'] = 'أدخل كمية المعلومات المذكورة أعلاه';
$string['frontpage_about_text'] = 'اسم البيانات';
$string['frontpage_about_text_1_defalt'] = 'المقررات الدراسية';
$string['frontpage_about_text_2_defalt'] = 'المعلمون';
$string['frontpage_about_text_3_defalt'] = 'الطلاب';
$string['frontpage_about_text_4_defalt'] = 'الدروس';
$string['frontpage_about_text_desc'] = 'أدخل اسم البيانات التي سيتم عرضها على الصفحة الرئيسية';
$string['frontpage_about_title'] = 'عنوان كتلة المعلومات';
$string['frontpage_about_title_default'] = 'مجتمعنا العالمي';
$string['heart'] = 'إذا كنت تحب هذا القالب، لا تنسى النقر على ❤️ على صفحة القوالب <a href="{$a}" target="_blank">بالنقر هنا</a>';
$string['instructor'] = 'المدرب';
$string['login_backgroundcolor'] = 'لون الخلفية';
$string['login_backgroundcolor_desc'] = 'حدد لون الخلفية لصفحة استعادة كلمة المرور';
$string['login_backgroundfoto'] = 'صورة الخلفية';
$string['login_backgroundfoto_desc'] = 'حدد صورة الخلفية لتسجيل الدخول/استعادة كلمة المرور/إنشاء الحساب. الصورة الافتراضية هي: {$a}';
$string['login_forgot_description'] = 'نص على جانب شاشة نسيت كلمة المرور';
$string['login_forgot_description_desc'] = 'النص الذي سيظهر فقط على شاشة نسيت كلمة المرور';
$string['login_login_description'] = 'نص على جانب شاشة تسجيل الدخول';
$string['login_login_description_desc'] = 'النص الذي سيظهر فقط على شاشة تسجيل الدخول';
$string['login_signup_description'] = 'نص على جانب شاشة إنشاء حساب';
$string['login_signup_description_desc'] = 'النص الذي سيظهر فقط على شاشة إنشاء حساب';
$string['login_theme'] = 'قالب تسجيل الدخول';
$string['login_theme_block'] = 'مربع أبيض مركزي مع خلفية اختيارية';
$string['login_theme_desc'] = 'اختر القالب الذي تريده في منطقة تسجيل الدخول';
$string['login_theme_image_login'] = 'صورة الخلفية وتسجيل الدخول على الجانب';
$string['login_theme_imagetext_login'] = 'صورة الخلفية، نص فوق الصورة، وتسجيل الدخول على الجانب';
$string['login_theme_login'] = 'شاشة تسجيل الدخول فقط، بدون صورة جانبية';
$string['logo_color'] = 'شعار ملون';
$string['logo_color_desc'] = 'يرجى تحميل شعارك الملون إذا كنت ترغب في تضمينه في الأعلى. سيتم عرض هذا الشعار عند التمرير على الصفحة، وسيتم عرض القائمة على خلفية بيضاء.';
$string['logo_write'] = 'شعار القائمة العلوية أثناء التمرير';
$string['logo_write_desc'] = 'يرجى تحميل شعارك إذا كنت ترغب في تضمينه في الأعلى. سيتم عرض هذا الشعار عندما يظل التمرير في الأعلى، وسيتم عرض القائمة على خلفية ملونة.';
$string['matricular'] = 'الانضمام';
$string['mycourses_color'] = 'لون خلفية الكتلة';
$string['mycourses_color_desc'] = 'لون الخلفية للكتلة.';
$string['mycourses_icon'] = 'الأيقونة';
$string['mycourses_icon_desc'] = 'أيقونة تمثيلية للكتلة. ينبغي أن يكون حجم الأيقونة 48 × 48 بكسل.';
$string['mycourses_info'] = 'كتلة {$a}';
$string['mycourses_numblocos'] = 'لا توجد كتل';
$string['mycourses_numblocos_desc'] = 'كم عدد الصور التي تريدها في عرض الشرائح؟';
$string['mycourses_numblocos_nenhum'] = 'لا توجد شرائح في الصفحة الرئيسية';
$string['mycourses_title'] = 'عنوان الكتلة المختصر';
$string['mycourses_title_desc'] = 'عنوان مختصر وصفي للكتلة.';
$string['mycourses_url'] = 'رابط الكتلة';
$string['mycourses_url_desc'] = 'عنوان الرابط المراد الانتقال إليه عند النقر على الكتلة. يمكن أن يكون رابطًا خارجيًا أو رابطًا داخليًا ضمن المنصة.';
$string['pluginname'] = 'Boost Magnific';
$string['privacy:metadata'] = 'لا يقوم موضوع Boost Magnific بتخزين أي بيانات شخصية عن أي مستخدم.';
$string['settings_about_heading'] = 'عن Moodle الخاص بك';
$string['settings_accessibility_desc'] = 'يسمح بتخصيص الخيارات لتحسين إمكانية الوصول إلى المنصة، مثل التباين، حجم الخط، وتنقلات لوحة المفاتيح.';
$string['settings_css_heading'] = 'الخطوط و CSS';
$string['settings_footer_heading'] = 'صندوق التذييل';
$string['settings_icons_change_icons'] = 'تغيير الرمز الافتراضي في قائمة المقررات الدراسية';
$string['settings_login_heading'] = 'شاشة تسجيل الدخول';
$string['settings_mycourses_heading'] = 'كتل مساقاتي';
$string['settings_slideshow_heading'] = 'عرض الشرائح';
$string['settings_theme_heading'] = 'الموضوع';
$string['settings_top_heading'] = 'القائمة العلوية';
$string['sitefonts'] = 'خطوط Google الإضافية';
$string['sitefonts_desc'] = 'أدخل رمز @import من Google Fonts كما هو موضح في الصورة أدناه. بعد الحفظ، ستُحدث حقل "خط الموقع"، مع عرض هذه الخطوط. يمكنك إضافة @import متعدد حسب الحاجة.';
$string['slidecaption_desc'] = 'أدخل نص التسمية المستخدم على الشريحة';
$string['slideshow_image'] = 'صورة الشريحة';
$string['slideshow_image_desc'] = 'يجب أن تكون الصورة بحجم 1250 بكسل × 400 بكسل.';
$string['slideshow_info'] = 'الشريحة {$a}';
$string['slideshow_numslides'] = 'كم عدد الصور في عرض الشرائح';
$string['slideshow_numslides_desc'] = 'كم عدد الصور التي تريد في عرض الشرائح؟';
$string['slideshow_numslides_nenhum'] = 'لا توجد شرائح في الصفحة الرئيسية';
$string['slideshow_text'] = 'نص وصفي قصير للشريحة';
$string['slideshow_text_desc'] = 'أدخل نصًا قصيرًا حول الشريحة.';
$string['slideshow_url'] = 'رابط زر الشرائح';
$string['slideshow_url_desc'] = 'أدخل رابط الوجهة لزر صورة الشريحة';
$string['social_facebook'] = 'فيسبوك الخاص بك';
$string['social_facebook_desc'] = 'رابط فيسبوك منظمتك.';
$string['social_instagram'] = 'إنستجرام الخاص بك';
$string['social_instagram_desc'] = 'رابط إنستجرام منظمتك.';
$string['social_linkedin'] = 'لينكد إن الخاص بك';
$string['social_linkedin_desc'] = 'رابط لينكد إن منظمتك.';
$string['social_twitter'] = 'تويترك';
$string['social_twitter_desc'] = 'عنوان تويتر منظمتك.';
$string['social_youtube'] = 'يوتيوبك';
$string['social_youtube_desc'] = 'عنوان يوتيوب منظمتك.';
$string['theme_boost_magnific_about_editbooton'] = 'تحرير كتلة حول';
$string['theme_boost_magnific_frontpage_bloco'] = 'كتلة "{$a}"';
$string['theme_boost_magnific_frontpage_home'] = 'كتل الصفحة الرئيسية';
$string['theme_boost_magnific_mycourses_editbooton'] = 'تحرير الكتل';
$string['theme_boost_magnific_slideshow_editbooton'] = 'تحرير عرض الشرائح';
$string['theme_color'] = 'اختيار اللون';
$string['theme_color-color_buttons'] = 'لون الأزرار';
$string['theme_color-color_buttons_desc'] = 'اللون المستخدم للأزرار، مما يضيف تلازمًا بصريًا ويؤكد الإجراءات التفاعلية.';
$string['theme_color-color_primary'] = 'اللون الأساسي';
$string['theme_color-color_primary_desc'] = 'اللون الأساسي الرئيسي للقالب، يُستخدم عادة لتسليط الضوء على العناصر المميزة وتأكيدها.';
$string['theme_color-color_secondary'] = 'اللون الثانوي';
$string['theme_color-color_secondary_desc'] = 'لون ثانوي يكمل اللون الأساسي، يستخدم لتسليط الضوء على العناصر الثانوية أو التباين مع اللون الأساسي.';
$string['theme_color_desc'] = 'حدد ألوان نصوص مودل وأزرارها أو انقر على السطر أدناه:';
$string['theme_color_heading'] = 'اختيار لون البيئة';
$string['theme_color_sugestion'] = 'اقتراح اللون';
$string['theme_color_sugestion_text'] = 'انقر على الخط لتطبيق اللون على الحقول أدناه:';
$string['theme_login_branco'] = 'شاشة تسجيل الدخول فقط، بدون صورة جانبية، مع النموذج على خلفية بيضاء';
$string['top_color_heading'] = 'لون تمرير لأعلى';
$string['top_scroll'] = 'تثبيت القائمة عند التمرير عبر الصفحة';
$string['top_scroll_background_color'] = 'لون خلفية القائمة العلوية عند التمرير';
$string['top_scroll_background_color_desc'] = 'حدد لون الخلفية عند التمرير على الصفحة.';
$string['top_scroll_desc'] = 'عند التمكين، ستتم إعادة تثبيت القائمة في أعلى الشاشة أثناء تمريرك عبر الصفحة، مما يضمن سهولة الوصول إلى خيارات القائمة.';
$string['top_scroll_text_color'] = 'لون النص للقائمة عند التمرير';
$string['top_scroll_text_color_desc'] = 'حدد لون النص للقائمة عند التمرير على الصفحة.';
$string['vvveb_footer_contact_title_default'] = 'اتصل بنا';
$string['vvveb_home_access'] = 'الوصول إلى المقرر';
$string['vvveb_home_automatically_catalogo'] = 'لا تقم بالتعديل. سيتم استبدال هذه الكتلة تلقائيًا بفهرس المساق.';
$string['vvveb_home_automatically_category'] = 'لا تقم بالتعديل. سيتم استبدال هذه الكتلة تلقائيًا بتصنيفات المساق.';
$string['vvveb_home_automatically_my_course'] = 'لا تقم بالتعديل. سيتم استبدال هذه الكتلة تلقائيًا بالمقررات التي سجل فيها الطالب.';
$string['vvveb_home_automatically_popular'] = 'لا تعدل. سيتم استبدال هذه الكتلة تلقائيًا بالمساقات الأكثر شهرة.';
$string['vvveb_home_catalogo_heading'] = 'فهرس المساق';
$string['vvveb_home_category_heading'] = 'تصنيفات المقرر الدراسي';
$string['vvveb_home_mycourses_heading'] = 'مقرراتي الدراسية';
$string['vvveb_home_popular_course'] = 'المقررات الأكثر شيوعاً';
$string['vvveb_home_team_subtitle'] = 'نحن مجموعة من المحترفين المكرسين لعملهم';
$string['vvveb_home_team_title'] = 'تعرف على فريقنا';
