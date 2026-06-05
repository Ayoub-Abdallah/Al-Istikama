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
 * Strings for component 'theme_degrade', language 'ar', version '5.1'.
 *
 * @package     theme_degrade
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['background_color'] = 'لون الخلفية';
$string['background_color_default'] = 'القالب الافتراضي {$a}';
$string['background_color_desc'] = 'لون الخلفية للجزء الأعلى والتذييل!';
$string['background_text_color'] = 'لون النص';
$string['background_text_color_desc'] = 'لون النص العلوي ولون نص التذييل!';
$string['choosereadme'] = 'Degrade هو قالب تم تصميمه بعناية لإضفاء ألوان مبهجة على موودل';
$string['contact_address'] = 'العنوان';
$string['contact_email'] = 'البريد الالكتروني';
$string['contact_phone'] = 'رقم الهاتف';
$string['content_pagefonts'] = 'خطوط قوقل إضافية';
$string['content_pagefonts_desc'] = 'أضف هنا رابط @import من Google للحصول على خطوط إضافية.<br>يمكنك وضع استيرادات متعددة.<br><a href="https://fonts.google.com/selection/embed" target="google">تضمين الكود</a><br><img src="{$a}" style="max-width: 100%;width: 420px;">';
$string['content_type_default'] = 'افتراضي موودل';
$string['content_type_empty'] = '(لا يوجد محتوى)';
$string['content_type_footer'] = 'نوع المحتوى للتذييل';
$string['content_type_footer_desc'] = 'اختر نوع المحتوى الذي ترغب في إظهاره على التذييل';
$string['content_type_home'] = 'نوع محتوى الصفحة الرئيسية';
$string['content_type_home_desc'] = 'حدد نوع المحتوى الذي تريد عرضه على الصفحة الرئيسية.';
$string['content_type_html'] = 'الصفحة التي سيتم إنشاؤها باستخدام المحرر';
$string['continuar'] = 'مواصلة الدراسة';
$string['countlesson'] = 'الدرس {$a}';
$string['countlessons'] = 'الدروس {$a}';
$string['course_access'] = 'الوصول إلى المقرر';
$string['course_moore'] = 'مزيد من التفاصيل';
$string['customcss_desc'] = 'ستنعكس أي قواعد CSS تضيفها إلى منطقة النص هذه على جميع الصفحات، مما يجعل من السهل تخصيص هذا المظهر.';
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
-جميع المقررات | /course/
-مقرراتي الدراسية
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
$string['editor_link_footer'] = 'قم بتحرير صندوق التذييل للغة {$a}.';
$string['editor_link_footer_all'] = 'تحرير صندوق التذييل لجميع اللغات';
$string['editor_link_home'] = 'قم بتحرير الصفحة الرئيسية للغة {$a}.';
$string['editor_link_home_all'] = 'تحرير الصفحة الرئيسية لجميع اللغات';
$string['favicon'] = 'أيقونة الموقع';
$string['favicon_desc'] = 'تظهر الرمز التعريفي المرافق لعنوان الصفحة في علامة التبويب بالمتصفح. يتم عرض رمز تعريف مودل إذا لم يتم توفير رمز تعريف مخصص.';
$string['fontfamily'] = 'خطوط النص في الموقع';
$string['fontfamily_desc'] = 'اختر الخط الذي ترغب في استخدامه للنص في موقعك على مودل.';
$string['fontfamily_menus'] = 'خطوط القائمة';
$string['fontfamily_menus_desc'] = 'اختر الخط الذي ترغب في استخدامه للقوائم على موقعك على مودل.';
$string['fontfamily_sitename'] = 'الخط لاسم الموقع';
$string['fontfamily_sitename_desc'] = 'الخط الذي سيتم تطبيقه على اسم الموقع إذا لم يتم توفير شعار.';
$string['fontfamily_title'] = 'خطوط العنوان';
$string['fontfamily_title_desc'] = 'اختر الخط الذي ترغب في استخدامه للعناوين على موقعك على مودل.';
$string['fontpreview'] = 'معاينة قائمة الخطوط';
$string['footer_contact_title'] = 'عنوان صندوق جهة الاتصال';
$string['footer_contact_title_default'] = 'إتصل بنا';
$string['footer_contact_title_desc'] = 'أدخل عنوان الكتلة التي ستظهر في التذييل مع تفاصيل الاتصال.';
$string['footer_description'] = 'الوصف';
$string['footer_description_desc'] = 'قم بوصف نظام Moodle الخاص بك، وماذا تفعل، وستظهر هذه المعلومات أسفل الشعار في تذييل Moodle';
$string['footer_frontpage_blockcourses_instructor'] = 'إظهار اسم الأستاذ';
$string['footer_frontpage_blockcourses_instructor_desc'] = 'إذا تم تحديدها، تظهر أسماء الأساتذة في قائمة المقررات الدراسية!';
$string['footer_frontpage_blockcourses_text'] = 'نص قصير يشرح الكتلة "{$a}".';
$string['footer_frontpage_blockcourses_text_desc'] = 'أضف نصًا يتحدث عن "{$a}"!';
$string['footer_links_title'] = 'عنوان كتلة الروابط';
$string['footer_links_title_default'] = 'الروابط المهمة';
$string['footer_show_copywriter'] = 'عرض تم التصميم بواسطة ❤️';
$string['footer_show_copywriter_desc'] = 'قم بإلغاء التحديد إذا كنت تريد إخفاء "عرض تم التصميم بواسطة ❤️"';
$string['footer_social_title'] = 'عنوان كتلة روابط التواصل الاجتماعي';
$string['footer_social_title_default'] = 'تابعنا على وسائل التواصل الإجتماعي';
$string['footer_social_title_desc'] = 'أدخل عنوان الصندوق التي سيظهر في التذييل مع البيانات من شبكات التواصل الاجتماعي الخاصة بك.';
$string['footerblink'] = 'روابط صندوق التذييل';
$string['footerblink_desc'] = 'يمكنك تكوين روابط كتلة التذييل هنا لتظهر حسب القوالب.<br>يتكون كل سطر من نص القائمة أو مفتاح اللغة أو النص، وعنوان URL للرابط (اختياري)، مفصولاً بأشرطة رأسية. على سبيل المثال:<br><pre>دعم Moodle|https://moodle.org/support</pre>';
$string['footerblock_contact'] = 'صندوق الاتصال';
$string['footerblock_copywriter'] = 'تم التصميم بواسطة  ❤️';
$string['footerblock_description'] = 'صندوق الوصف';
$string['footerblock_links'] = 'صندوق الروابط';
$string['footerblock_social'] = 'صندوق التواصل الاجتماعي';
$string['free_name'] = 'مجاناً';
$string['frontpage_about_description'] = 'صف ما تفعله';
$string['frontpage_about_description_desc'] = 'صف في 5 أسطر كحد أقصى الغرض من نظام المودل الخاص بك';
$string['frontpage_about_enable'] = 'تفعيل صندوق حول الموقع';
$string['frontpage_about_enable_desc'] = 'إذا تم تحديده، فسوف تظهر كتلة "حول الموقع" أسفل الشعار!';
$string['frontpage_about_info'] = 'صندوق البيانات';
$string['frontpage_about_logo'] = 'شعار مختلف ليتم عرضه هنا';
$string['frontpage_about_logo_desc'] = 'إذا تم تعيينه، فسيتم استخدام هذا الشعار هنا بدلاً من الشعار العلوي.<br>
يستخدم الفارغ الشعار العلوي!';
$string['frontpage_about_number'] = 'كمية البيانات';
$string['frontpage_about_number_desc'] = 'أدخل كمية المعلومات المذكورة أعلاه';
$string['frontpage_about_text'] = 'اسم البيانات';
$string['frontpage_about_text_1_defalt'] = 'المقررات الدراسية';
$string['frontpage_about_text_2_defalt'] = 'المدرسين';
$string['frontpage_about_text_3_defalt'] = 'الطلاب';
$string['frontpage_about_text_4_defalt'] = 'الدروس';
$string['frontpage_about_text_desc'] = 'أدخل اسم البيانات التي ستظهر على الصفحة الرئيسية';
$string['frontpage_about_title'] = 'عنوان صندوق حول الشركة';
$string['frontpage_about_title_default'] = 'مجتمعنا العالمي';
$string['heart'] = 'إذا أعجبك هذا القالب، فلا تنس النقر على ❤️ في صفحة القوالب <a href="{$a}" target="_blank">بالنقر هنا</a>';
$string['instructor'] = 'المدرس';
$string['login_backgroundcolor'] = 'لون الخلفية';
$string['login_backgroundcolor_desc'] = 'حدد لون الخلفية لصفحة استعادة كلمة المرور';
$string['login_backgroundfoto'] = 'صورة الخلفية';
$string['login_backgroundfoto_desc'] = 'حدد صورة خلفية تسجيل الدخول/استعادة كلمة المرور/إنشاء حساب. الصورة الافتراضية هي: {$a}';
$string['login_forgot_description'] = 'النص الموجود على جانب شاشة نسيت كلمة المرور';
$string['login_forgot_description_desc'] = 'النص الذي سيظهر فقط على شاشة نسيت كلمة المرور';
$string['login_login_description'] = 'النص الموجود على جانب شاشة تسجيل الدخول';
$string['login_login_description_desc'] = 'النص الذي سيظهر فقط على شاشة تسجيل الدخول';
$string['login_signup_description'] = 'النص الموجود على جانب شاشة إنشاء حساب';
$string['login_signup_description_desc'] = 'النص الذي سيظهر فقط على شاشة إنشاء حساب';
$string['login_theme'] = 'قالب الدخول';
$string['login_theme_block'] = 'صندوق أبيض في الوسط مع خلفية اختيارية';
$string['login_theme_desc'] = 'اختر القالب التي تريده في منطقة تسجيل الدخول';
$string['login_theme_image_login'] = 'صورة الخلفية وتسجيل الدخول على الجانب';
$string['login_theme_imagetext_login'] = 'صورة الخلفية، والنص فوق الصورة، وتسجيل الدخول على الجانب';
$string['login_theme_login'] = 'شاشة تسجيل الدخول فقط، بدون صورة جانبية';
$string['logo_color'] = 'الشعار الملون';
$string['logo_color_desc'] = 'يرجى تحميل شعارك الملون إذا كنت تريد إدراجه في الأعلى. سيتم عرض هذا الشعار أثناء تمرير الصفحة، وسيتم عرض القائمة على خلفية بيضاء.';
$string['logo_write'] = 'شعار القائمة العلوية أثناء التمرير';
$string['logo_write_desc'] = 'يرجى تحميل شعارك إذا كنت ترغب في تضمينه في الأعلى. سيتم عرض هذا الشعار عندما يظل التمرير في الأعلى، وسيتم عرض القائمة على خلفية ملونة.';
$string['matricular'] = 'انضمام';
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
$string['pluginname'] = 'تدرج';
$string['privacy:metadata'] = 'لا يقوم قالب Degrade بتخزين أي بيانات شخصية عن أي مستخدم.';
$string['settings_about_heading'] = 'حول موودل الخاص بك';
$string['settings_accessibility_desc'] = 'يسمح بتخصيص الخيارات لتحسين إمكانية الوصول إلى المنصة، مثل التباين، حجم الخط، وتنقلات لوحة المفاتيح.';
$string['settings_css_heading'] = 'الخطوط وCSS';
$string['settings_footer_heading'] = 'صندوق التذييل';
$string['settings_icons_change_icons'] = 'قم بتغيير الأيقونة الافتراضي في قائمة المقرر الدراسي';
$string['settings_login_heading'] = 'شاشة الدخول';
$string['settings_mycourses_heading'] = 'كتل مساقاتي';
$string['settings_slideshow_heading'] = 'عرض الشرائح';
$string['settings_theme_heading'] = 'الموضوع';
$string['settings_top_heading'] = 'القائمة العلوية';
$string['sitefonts'] = 'خطوط Google الإضافية';
$string['sitefonts_desc'] = 'أدخل رمز @import من Google Fonts كما هو موضح في الصورة أدناه. بعد الحفظ، سيتم تحديث حقل "خط النص في الموقع"، مع عرض هذه الخطوط. يمكنك إضافة العديد من @import حسب الحاجة.';
$string['slidecaption_desc'] = 'أدخل نص التسمية التوضيحية الذي سيتم استخدامه على الشريحة';
$string['slideshow_image'] = 'صورة الشريحة';
$string['slideshow_image_desc'] = 'يجب أن تكون الصورة 1250 بكسل × 400 بكسل.';
$string['slideshow_info'] = 'الشريحة {$a}';
$string['slideshow_numslides'] = 'كم عدد الصور في عرض الشرائح';
$string['slideshow_numslides_desc'] = 'كم عدد الصور التي تريدها في عرض الشرائح؟';
$string['slideshow_numslides_nenhum'] = 'لا توجد شرائح على الصفحة الرئيسية';
$string['slideshow_text'] = 'نص وصفي قصير للشريحة';
$string['slideshow_text_desc'] = 'أدخل نصًا قصيرًا حول الشريحة.';
$string['slideshow_url'] = 'رابط زر الشرائح';
$string['slideshow_url_desc'] = 'أدخل رابط الوجهة لزر صورة الشريحة';
$string['social_facebook'] = 'حسابك على فيسبوك';
$string['social_facebook_desc'] = 'رابط حساب مؤسستك على فيسبوك';
$string['social_instagram'] = 'حسابك على انستغرام';
$string['social_instagram_desc'] = 'رابط حساب مؤسستك على انستغرام';
$string['social_linkedin'] = 'حسابك على لينكدن';
$string['social_linkedin_desc'] = 'رابط حساب مؤسستك على لينكدن';
$string['social_twitter'] = 'حسابك على تويتر';
$string['social_twitter_desc'] = 'رابط حساب مؤسستك على تويتر';
$string['social_youtube'] = 'حسابك على يوتيوب';
$string['social_youtube_desc'] = 'رابط حساب مؤسستك على يوتيوب';
$string['theme_color-color_buttons'] = 'لون الأزرار';
$string['theme_color-color_buttons_desc'] = 'اللون المستخدم للأزرار، يضيف التماسك البصري ويؤكد على الإجراءات التفاعلية.';
$string['theme_color-color_names'] = 'لون الأسماء';
$string['theme_color-color_names_desc'] = 'اللون المستخدم لتمييز الأسماء أو المعرفات، مما يوفر الوضوح والتركيز على معلومات نصية محددة.';
$string['theme_color-color_primary'] = 'اللون الرئيسي';
$string['theme_color-color_primary_desc'] = 'اللون الأساسي الرئيسي للقالب، يُستخدم عادةً لعناصر التمييز والتأكيد.';
$string['theme_color-color_secondary'] = 'اللون الثانوي';
$string['theme_color-color_secondary_desc'] = 'لون ثانوي مكمل للون الأساسي، يستخدم لإبراز العناصر الثانوية أو للتباين مع اللون الأساسي.';
$string['theme_color_desc'] = 'حدد ألوان نصوص وأزرار Moodle أو انقر فوق السطر أدناه:';
$string['theme_color_heading'] = 'اختيار لون البيئة';
$string['theme_color_sugestion'] = 'اقتراح اللون';
$string['theme_color_sugestion_text'] = 'انقر على الخط لتطبيق اللون على الحقول أدناه:';
$string['theme_degrade_about_editbooton'] = 'تحرير صندوق عن الموقع';
$string['theme_degrade_frontpage_bloco'] = 'صندوق  "{$a}"';
$string['theme_degrade_frontpage_home'] = 'صناديق الصفحة الرئيسية';
$string['theme_degrade_mycourses_editbooton'] = 'تحرير الكتل';
$string['theme_degrade_slideshow_editbooton'] = 'تحرير عرض الشرائح';
$string['theme_login_branco'] = 'شاشة تسجيل الدخول فقط، بدون صورة جانبية، مع النموذج على خلفية بيضاء';
$string['top_color_heading'] = 'لون التمرير العلوي';
$string['top_scroll'] = 'تثبيت القائمة عند التمرير عبر الصفحة';
$string['top_scroll_background_color'] = 'لون خلفية القائمة العلوية عند التمرير';
$string['top_scroll_background_color_desc'] = 'تعيين لون الخلفية عند التمرير عبر الصفحة. إذا كان الحقل فارغًا، سيبقى اللون دون تغيير.';
$string['top_scroll_desc'] = 'عند التمكين، ستتم إعادة تثبيت القائمة في أعلى الشاشة أثناء تمريرك عبر الصفحة، مما يضمن سهولة الوصول إلى خيارات القائمة.';
$string['top_scroll_text_color'] = 'لون نص القائمة في التمرير';
$string['top_scroll_text_color_desc'] = 'اضبط لون نص القائمة عند تمرير الصفحة.';
$string['vvveb_footer_contact_title_default'] = 'إتصل بنا';
$string['vvveb_home_access'] = 'الوصول إلى المقرر الدراسي';
$string['vvveb_home_automatically_catalogo'] = 'لا تقم بالتعديل. سيتم استبدال هذه الكتلة تلقائيًا بفهرس المساق.';
$string['vvveb_home_automatically_category'] = 'لا تعدل. سيتم استبدال هذه الكتلة تلقائيًا بتصنيفات المقرر.';
$string['vvveb_home_automatically_my_course'] = 'لا تقم بالتعديل. سيتم استبدال هذه الكتلة تلقائيًا بالمقررات التي سجل فيها الطالب.';
$string['vvveb_home_automatically_popular'] = 'لا تعدل. سيتم استبدال هذه الكتلة تلقائيًا بالمقررات الأكثر شهرة.';
$string['vvveb_home_catalogo_heading'] = 'كتالوج المقرر الدراسي';
$string['vvveb_home_category_heading'] = 'تصنيفات المقررات';
$string['vvveb_home_mycourses_heading'] = 'مقرراتي الدراسية';
$string['vvveb_home_popular_course'] = 'المقررات الأكثر شيوعاً';
$string['vvveb_home_team_subtitle'] = 'نحن مجموعة من المحترفين المكرسين لعملهم';
$string['vvveb_home_team_title'] = 'تعرف على فريقنا';
