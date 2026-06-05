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
 * Strings for component 'ai', language 'ar', version '5.1'.
 *
 * @package     ai
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['acceptai'] = 'القبول والمتابعة';
$string['action'] = 'الإجراء';
$string['action_explain_text'] = 'توضيح النص';
$string['action_explain_text_desc'] = 'يشرح محتوى النص في صفحة المساق.';
$string['action_explain_text_help'] = 'يوفر تفسيرًا يتوسع من الأفكار الأساسية، يبسط المفاهيم المعقدة ويضيف شرحًا ييسر فهم النص.';
$string['action_explain_text_instruction'] = 'ستتلقى نصًا مدخلاً من المستخدم. مهمتك هي شرح النص المقدم. اتبع الإرشادات التالية:
1. التوسع: التوسع في الأفكار والمفاهيم الرئيسية، مع التأكد من أن الشرح يضيف عمقًا ذا مغزى ويتجنب إعادة صياغة النص حرفيًا.
2. التبسيط: تقسيم المصطلحات أو الأفكار المعقدة إلى مكونات أبسط، مما يجعلها سهلة الفهم لجمهور واسع، بما في ذلك المتعلمين.
3. توفير السياق: شرح سبب حدوث شيء ما، وكيف يعمل، أو ما هو الغرض منه. تضمين أمثلة أو تشبيهات ذات صلة لتعزيز الفهم عند الاقتضاء.
4. التنظيم المنطقي: هيكل شرحك ليتدفق بشكل طبيعي، بدءًا بالأفكار الأساسية قبل الانتقال إلى التفاصيل الدقيقة.

تعليمات مهمة:
1. أعد الملخص بنص عادي فقط.
2. لا تقم بتضمين أي تنسيق ترميزي أو تحيات أو عبارات مبتذلة.
3. ركز على الوضوح والإيجاز وإمكانية الوصول.

تأكد من أن الشرح سهل القراءة وينقل بفعالية النقاط الرئيسية للنص الأصلي.';
$string['action_generate_image'] = 'توليد الصورة';
$string['action_generate_image_desc'] = 'توليد الصورة بناءً على النص التلقيني.';
$string['action_generate_image_help'] = 'ينشئ صورة بناء على نص تلقيني.';
$string['action_generate_text'] = 'توليد النص';
$string['action_generate_text_desc'] = 'توليد النص بناءً على النص الملقن.';
$string['action_generate_text_help'] = 'ينشئ نصًا بناء على نص تلقيني.';
$string['action_generate_text_instruction'] = 'ستتلقى إدخالاً نصيًا من المستخدم. مهمتك هي توليد نص بناءً على طلبه. إتبع التعليمات الهامة الآتية:
    1. أعد الملخص كنص عادي فقط.
    2. لا تضمن أي علامات تنسيق، تحيات، أو كلام مبتذل.';
$string['action_summarise_text'] = 'تلخيص النص';
$string['action_summarise_text_desc'] = 'تلخيص محتوى النص في صفحة المساق.';
$string['action_summarise_text_help'] = 'ينشئ موجزًا لمحتوى الصفحة.';
$string['action_summarise_text_instruction'] = 'ستتلقى إدخالاً نصيًا من المستخدم. مهمتك هي توليد نص بناءً على طلبه. إتبع الإرشادات الآتية:
    1. التركيز: إختصر الجمل الطويلة في نقاط هامة.
    2. التبسيط: إجعل المعلومات المعقدة أسهل للفهم، وبخاصة للمتعلمين.

تعليمات هامة:
    1. أعد الملخص كنص عادي فقط.
    2. لا تضمن أي علامات تنسيق، تحيات، أو كلام مبتذل.
    3. ركز على الوضوح، الإيجاز، وسهولة الوصول.

تأكد من أن الموجز سهل القراءة ويوصل النقاط الأساسية للنص الأصلي بسهولة.';
$string['action_translate_text'] = 'ترجمة النص';
$string['action_translate_text_desc'] = 'ترجمة النص المقدم من لغة إلى أخرى.';
$string['actionsettingprovider'] = 'إعدادات الإجراء {$a}';
$string['actionsettingprovider_desc'] = 'هذه الإعدادات تتحكم بالكيفية التي يقوم بها المزود {$a->providername} بالإجراء
{$a->actionname}.';
$string['actionsettings'] = 'إعدادات الإجراء';
$string['actionsettings_desc'] = 'هذه الإعدادات تتحكم بإجراءات الذكاء الاصطناعي لعيِّنة المزود هذه.';
$string['ai'] = 'الذكاء الاصطناعي';
$string['aiactionregister'] = 'تسجيل إجراءات الذكاء الاصطناعي';
$string['aiactionshdr'] = 'إختر ميزات الذكاء الاصطناعي لهذا النشاط:';
$string['aiplacements'] = 'مواضع الذكاء الاصطناعي';
$string['aipolicyacceptance'] = 'قبول سياسة الذكاء الاصطناعي';
$string['aipolicyregister'] = 'تسجيل سياسة الذكاء الاصطناعي';
$string['aiproviders'] = 'مزودو الذكاء الاصطناعي';
$string['aireports'] = 'تقارير الذكاء الاصطناعي';
$string['aitools'] = 'أدواة الذكاء الاصطناعي';
$string['aitoolsincourseactivitydesc'] = 'عند ضبطه على نعم، يمكنك تحديد ما يتوفر من ميزات الذكاء الاصطناعي.';
$string['aitoolsincoursedesc'] = 'عند ضبطه على نعم، سيتكون ميزات الذكاء الاصطناعي متاحة للنشاطات في هذا المساق. يمكن تهيئة أدوات الذكاء الاصطناعي ضمن إعدادات كل نشاط.';
$string['aitoolsnotenabled'] = 'لتحديد أي من ميزات الذكاء الاصطناعي المتاحة في هذا النشاط، إذهب إلى إعدادات المساق ثم اسمح بأدوات الذكاء الاصطناعي.';
$string['aiusage'] = 'استعمال الذكاء الاصطناعي';
$string['aiusagepolicy'] = 'سياسة استعمال الذكاء الاصطناعي';
$string['availableplacements'] = 'إختر مواضع إتاحة إجراءات الذكاء الاصطناعي';
$string['availableplacements_desc'] = 'مواضع الذكاء الاصطناعي مسؤولة عن تقرير مكان وكيفية استعمال خدمات الذكاء الاصطناعي ضمن موقعك. يمكنك تحديد أي من الإجراءات سيتوافر في أي موضع عبر الإعدادات.';
$string['availableproviders'] = 'إدارة مزودي الذكاء الاصطناعي المتصلون بموقعك';
$string['availableproviders_desc'] = 'مزودو الذكاء الاصطناعي يضيفون خدمات الذكاء الاصطناعي إلى موقعك عبر
\'الإجراءات\' مثل تلخيص النص وتوليد الصور.<br/>
يمكنك إدارة تلك الإجراءات لكل مزود عبر إعداداته.';
$string['btninstancecreate'] = 'إنشاء عيِّنة';
$string['btninstanceupdate'] = 'تحديث العيِّنة';
$string['completiontokens'] = 'ترميزات الإكمال';
$string['completiontokens_help'] = 'ترميزات الإكمال هي وحدات نصية مولدة من قبل وحدة الذكاء الاصطناعي كاستجابة إلى ما أدخلته. الاستجابات الأطول تستعمل ترميزات أكثر، مما يزيد التكلفة بطبيعة الحال.';
$string['configureprovider'] = 'تهيئة عيِّنة المزود';
$string['contentwatermark'] = 'منشأة من قبل الذكاء الاصطناعي';
$string['createnewprovider'] = 'إنشاء عيِّنة مزود جديدة';
$string['dateaccepted'] = 'تاريخ القبول';
$string['declineaipolicy'] = 'رفض';
$string['enableaitoolsincourse'] = 'السماح بأدوات الذكاء الاصطناعي في هذا المساق';
$string['enableaitoolsincourseactivity'] = 'السماح بأدوات الذكاء الاصطناعي في هذا النشاط';
$string['enableglobalratelimit'] = 'ضبط حد المعدل على مستوى الموقع';
$string['enableglobalratelimit_help'] = 'حدد عدد الطلبات التي يمكن لمزود الذكاء الاصطناعي تلقيها من كل الموقع في كل ساعة.';
$string['enableuserratelimit'] = 'ضبط حد المعدل على مستوى المستخدم';
$string['enableuserratelimit_help'] = 'حدد عدد الطلبات التي يمكن لكل مستخدم تقديمها إلى مزود الذكاء الاصطناعي في كل ساعة.';
$string['error:400'] = 'طلب خاطئ';
$string['error:401'] = 'غير مرخص';
$string['error:401:upstreamless'] = 'يتعذر الاتصال مع خدمة الذكاء الاصطناعي. حاول مجددًا في وقت لاحق.';
$string['error:404'] = 'غير موجود';
$string['error:404:upstreamless'] = 'خدمة الذكاء الاصطناعي غير متاحة الآن. حاول مجددًا في وقت لاحق.';
$string['error:429'] = 'طلبات كثيرة جدًا';
$string['error:429:internalsitewide'] = 'لقد وصلت طلبات الذكاء الاصطناعي إلى الحد الأقصى للساعة الواحدة على مستوى الموقع. حاول مجددًا في وقت لاحق.';
$string['error:429:internaluser'] = 'لقد وصلت طلباتك للذكاء الاصطناعي إلى الحد الأقصى للساعة الواحدة. حاول مجددًا في وقت لاحق.';
$string['error:429:upstreamless'] = 'لقد وصلت الطلبات الموجهة لهذا الذكاء الاصطناعي إلى الحد الأقصى. حاول مجددًا في وقت لاحق.';
$string['error:500'] = 'خطأ داخلي في المخدم';
$string['error:503'] = 'الخدمة غير متاحة';
$string['error:actionnotfound'] = 'الإجراء \'{$a}\' غير مدعوم.';
$string['error:defaultmessage'] = 'وقع خطأ ما عند معالجة طلبك. حاول مجددًا في وقت لاحق.';
$string['error:defaultmessageshort'] = 'حاول مجددًا في وقت لاحق.';
$string['error:defaultname'] = 'وقع خطأ ما';
$string['error:noproviders'] = 'لا يوجد أي مزود لمعالجة الإجراء.';
$string['error:providernotfound'] = 'عيِّنة مزود الذكاء الاصطناعي غير موجودة.';
$string['error:unknown'] = 'خطأ مجهول';
$string['globalratelimit'] = 'أقصى عدد من الطلبات على مستوى الموقع';
$string['globalratelimit_help'] = 'عدد الطلبات المسموح بها على مستوى الموقع بالساعة.';
$string['manageaiplacements'] = 'إدارة مواضع الذكاء الاصطناعي';
$string['manageaiproviders'] = 'إدارة مزودي الذكاء الاصطناعي';
$string['noproviderplugins'] = 'لا توجد ملاحق مزودين منصبة. قم بتنصيب ملحق مزود لتمكين إنشاء عيِّنة منها.';
$string['noproviders'] = 'هذا الإجراء غير متاح. ليس هناك <a href="{$a}">مزودو ذكاء اصطناعي</a> معرفون لهذا الإجراء.';
$string['off'] = 'مطفأة';
$string['on'] = 'شغالة';
$string['placement'] = 'الموضع';
$string['placementactionsettings'] = 'الإجراءات';
$string['placementactionsettings_desc'] = 'إجراءات الذكاء الاصطناعي المتاحة لهذا الموضع.';
$string['placementsettings'] = 'الإعدادات الخاصة بالموضع';
$string['placementsettings_desc'] = 'تلك الإعدادات تتحكم بكيفية اتصال الموضع بخدمة الذكاء الاصطناعي والعمليات ذات الصلة.';
$string['privacy:metadata:ai_action_explain_text'] = 'جدول يخزن طلبات توضيح النص التي قدمها المستخدمون.';
$string['privacy:metadata:ai_action_explain_text:completiontoken'] = 'ترميزات الإكمال المستعملة لتوضيح النص';
$string['privacy:metadata:ai_action_explain_text:fingerprint'] = 'الترميز الرقمي الفريد الذي يمثل الحالة/النسخة للوحدة والمحتوى';
$string['privacy:metadata:ai_action_explain_text:generatedcontent'] = 'النص الفعلي المولد من من قبل وحدة الذكاء الاصطناعي بناء على النص التلقيني المُدخل';
$string['privacy:metadata:ai_action_explain_text:prompt'] = 'النص التلقيني الخاص بطلب';
$string['privacy:metadata:ai_action_explain_text:prompttokens'] = 'ترميزات النص التلقيني المستعملة لتوضيح النص';
$string['privacy:metadata:ai_action_explain_text:responseid'] = 'مُعرَّف الاستجابة';
$string['privacy:metadata:ai_action_generate_image'] = 'جدول يخزن طلبات توليد الصور المقدمة من قبل المستخدمين';
$string['privacy:metadata:ai_action_generate_image:aspectratio'] = 'نسبة أبعاد الصورة المولدة';
$string['privacy:metadata:ai_action_generate_image:numberimages'] = 'عدد الصور المولدة';
$string['privacy:metadata:ai_action_generate_image:prompt'] = 'عبارة الطلب لتوليد الصورة';
$string['privacy:metadata:ai_action_generate_image:quality'] = 'جودة الصورة المولدة';
$string['privacy:metadata:ai_action_generate_image:revisedprompt'] = 'عبارة الطلب المنقحة للصورة المولدة';
$string['privacy:metadata:ai_action_generate_image:sourceurl'] = 'عنوان الرابط المصدري للصورة المولدة';
$string['privacy:metadata:ai_action_generate_image:style'] = 'نمط الصورة المولدة';
$string['privacy:metadata:ai_action_generate_text'] = 'جدول يخزن طلبات توليد النصوص المقدمة من قبل المستخدمين';
$string['privacy:metadata:ai_action_generate_text:completiontoken'] = 'ترميزات الإكمال المستعملة لتوليد النص';
$string['privacy:metadata:ai_action_generate_text:fingerprint'] = 'الترميز الرقمي الفريد الذي يمثل حالة/إصدار الوحدة ومحتواها';
$string['privacy:metadata:ai_action_generate_text:generatedcontent'] = 'النص الفعلي المولد من قبل وحدة الذكاء الاصطناعي بناءً على النص الملقن';
$string['privacy:metadata:ai_action_generate_text:prompt'] = 'النص التلقيني لطلب توليد النص';
$string['privacy:metadata:ai_action_generate_text:prompttokens'] = 'ترميزات النص التلقيني المستعملة لتوليد النص';
$string['privacy:metadata:ai_action_generate_text:responseid'] = 'مُعرَّف الاستجابة';
$string['privacy:metadata:ai_action_register'] = 'جدول يخزن طلبات الإجراءات المقدمة من قبل المستخدمين';
$string['privacy:metadata:ai_action_register:actionid'] = 'مُعرَّف طلب الإجراء';
$string['privacy:metadata:ai_action_register:actionname'] = 'اسم الإجراء للطلب';
$string['privacy:metadata:ai_action_register:model'] = 'الوحدة المستعملة لتوليد الاستجابة';
$string['privacy:metadata:ai_action_register:provider'] = 'اسم المزود الذي يتولى الطلب';
$string['privacy:metadata:ai_action_register:success'] = 'حالة طلب الإجراء';
$string['privacy:metadata:ai_action_register:timecompleted'] = 'وقت إكمال الطلب';
$string['privacy:metadata:ai_action_register:timecreated'] = 'وقت إنشاء الطلب';
$string['privacy:metadata:ai_action_register:userid'] = 'مُعرَّف المستخدم الذي قدم الطلب';
$string['privacy:metadata:ai_action_summarise_text'] = 'جدول يخزن طلبات تلخيص النص المقدمة من قبل المستخدمين';
$string['privacy:metadata:ai_action_summarise_text:completiontoken'] = 'ترميزات الإكمال المستعملة في تلخيص النص';
$string['privacy:metadata:ai_action_summarise_text:fingerprint'] = 'الترميز الفريد الذي يمثل الحالة/الإصدار للوحدة ومحتواها';
$string['privacy:metadata:ai_action_summarise_text:generatedcontent'] = 'النص الفعلي المولد من قبل وحدة الذكاء الاصطناعي بناءً على النص الملقن';
$string['privacy:metadata:ai_action_summarise_text:prompt'] = 'النص الخاص بطلب تلخيص النص';
$string['privacy:metadata:ai_action_summarise_text:prompttokens'] = 'ترميزات الطلب المستعملة لتلخيص النص';
$string['privacy:metadata:ai_action_summarise_text:responseid'] = 'مُعرَّف الاستجابة';
$string['privacy:metadata:ai_policy_register'] = 'جدول يخزن حالة سياسة قبول الذكاء الاصطناعي لكل مستخدم';
$string['privacy:metadata:ai_policy_register:contextid'] = 'مُعرَّف السياق الذي تم خزن بياناته';
$string['privacy:metadata:ai_policy_register:timeaccepted'] = 'وقت موافقة المستخدم على سياسة الذكاء الاصطناعي';
$string['privacy:metadata:ai_policy_register:userid'] = 'مُعرَّف المستخدم الذي تم خزن بياناته';
$string['prompttokens'] = 'ترميزات التلقين';
$string['prompttokens_help'] = 'ترميزات النص التلقيني هي الوحدات النصية التي تشكل الإدخال الذي ترسله إلى وحدة الذكاء الاصطناعي. الإدخالات الأطول تستعمل ترميزات أكثر، والتي تؤدي بالنتيجة إلى كلف أعلى.';
$string['provider'] = 'المزود';
$string['provideractionsettings'] = 'الإجراءات';
$string['provideractionsettings_desc'] = 'حدد الإجراءات وقم بتهيئتها والتي يمكن لـ {$a} القيام بها في موقعك.';
$string['providerinstanceactionupdated'] = 'إعدادات إجراءات {$a} تم تحديثها';
$string['providerinstancecreated'] = 'عيِّنة مزود الذكاء الاصطناعي {$a} تم إنشاؤها.';
$string['providerinstancedelete'] = 'حذف عيِّنة مزود الذكاء الاصطناعي';
$string['providerinstancedeleteconfirm'] = 'أنت على وشك حذف عيِّنة مزود الذكاء الاصطناعي: {$a->name} ({$a->provider}). هل أنت متأكد؟';
$string['providerinstancedeleted'] = 'عيِّنة مزود الذكاء الاصطناعي {$a} تم حذفها.';
$string['providerinstancedeletefailed'] = 'يتعذر حذف عيِّنة مزود الذكاء الاصطناعي {$a}. إما أن المزود قيد الاستعمال أو هناك مشكلة في قاعدة البيانات. تأكد من كون المزود نشط أو تواصل مع مشرف قاعدة بياناتك لطلب المساعدة';
$string['providerinstancedisablefailed'] = 'يتعذر تعطيل عيِّنة مزود الذكاء الاصطناعي {$a}. إما أن المزود قيد الاستعمال أو هناك مشكلة في قاعدة البيانات. تأكد من كون المزود نشط أو تواصل مع مشرف قاعدة بياناتك لطلب المساعدة';
$string['providerinstanceupdated'] = 'عيِّنة مزود الذكاء الاصطناعي {$a} تم تحديثها.';
$string['providermoveddown'] = '{$a} تم نقله إلى الأسفل.';
$string['providermovedup'] = '{$a} تم نقله إلى الأعلى.';
$string['providername'] = 'اسم العيِّنة';
$string['providers'] = 'المزودون';
$string['providersettings'] = 'الإعدادات';
$string['providertype'] = 'إختر ملحق مزود الذكاء الاصطناعي';
$string['timegenerated'] = 'وقت التوليد';
$string['unknownvalue'] = '—';
$string['userpolicy'] = '<h4><strong>مرحبًا بكم مع ميزة الذكاء الاصطناعي الجديدة!</strong></h4>
<p>ميزة الذكاء الاصطناعي (AI) هذه مؤسسة كليًا على وحدات لغة كبيرة خارجية (LLM) لتحسين تجربة التعلم والتعليم عندك. قبل أن تبدأ باستعمال خدمات الذكاء الاصطناعي هذه، يرجى قراءة سياسة الاستعمال هذه..</p>
<h4><strong>دقة المحتوى المولد بالذكاء الاصطناعي</strong></h4>
<p>يستطيع الذكاء الاصطناعي توفير معلومات ومقترحات هامة، ولكن دقته قد تتباين. عليك دومًا إعادة التأكد من المعلومات التي يقدمها للتثبت من أنها دقيقة، كاملة، ومناسبة للحالة الخاصة عندك.</p>
<h4><strong>كيف تُعالج بياناتك</strong></h4>
<p>ميزة الذكاء الاصطناعي هذه توفرها وحدات لغة كبيرة خارجية من أطراف ثالثة. إذا اخترت استعمال هذه الميزة، ستتم معالجة أي إدخالات أو بيانات شخصية تقدمها وفقًا لسياسات الخصوصية لهؤلاء المزودين للخدمات. نحن ننصح بأن تراجع سياسة الخصوصية لديهم لتتفهم كيفية معاملة بياناتك.
فضلاً عن ذلك، قد يتم الاحتفاظ بسجل عن تعاملاتك مع ميزات الذكاء الاصطناعي في هذا الموقع.</p>
<p>إذا كانت لديك أسئلة عن كيفية معالجة بياناتك، يرجى مراجعة معلميك أو مؤسستك التعليمية.</p>
<p>المتابعة من هنا معناها أنك تعرفت على هذه السياسة ووافقت عليها.</p>';
$string['userratelimit'] = 'أقصى عدد من الطلبات على مستوى المستخدم';
$string['userratelimit_help'] = 'عدد الطلبات المسموح بها على مستوى المستخدم بالساعة.';
