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
 * Strings for component 'aiprovider_openai', language 'ar', version '5.1'.
 *
 * @package     aiprovider_openai
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action:explain_text:endpoint'] = 'نقطة نهاية واجهة برمجة التطبيق';
$string['action:explain_text:model'] = 'وحدة الذكاء الاصطناعي';
$string['action:explain_text:model_help'] = 'الوحدة المستعملة لتوضيح النص المقدم.';
$string['action:explain_text:systeminstruction'] = 'تعليمات النظام';
$string['action:explain_text:systeminstruction_help'] = 'هذه التعليمات تُرسل إلى وحدة الذكاء الاصطناعي رفقة النص التلقيني المقدم من قبل المستخدم. تحرير هذه التعليمات أمر غير موصى به إلا عند الضرورة الحتمية.';
$string['action:generate_image:endpoint'] = 'نقطة نهاية مفتاح واجهة برمجة التطبيق';
$string['action:generate_image:model'] = 'وحدة الذكاء الاصطناعي';
$string['action:generate_image:model_desc'] = 'الوحدة المستعملة لتوليد الصور من تلقيمات المستخدمين.';
$string['action:generate_image:model_help'] = 'الوحدة المستعملة لتوليد الاستجابة الصورية من تلقيمات المستخدمين.';
$string['action:generate_text:endpoint'] = 'نقطة نهاية مفتاح واجهة برمجة التطبيق';
$string['action:generate_text:model'] = 'وحدة الذكاء الاصطناعي';
$string['action:generate_text:model_desc'] = 'الوحدة المستعملة لتوليد الاستجابة النصية.';
$string['action:generate_text:model_help'] = 'الوحدة المستعملة لتوليد الاستجابة النصية.';
$string['action:generate_text:systeminstruction'] = 'تعليمات النظام';
$string['action:generate_text:systeminstruction_desc'] = 'هذه التعليمات تُرسل إلى وحدة الذكاء الاصطناعي جنبًا إلى جنب مع النص التلقيني للمستخدم.
تعديل هذه التعليمات أمر غير موصى به ما لم يكن ذلك ضروريًا.';
$string['action:generate_text:systeminstruction_help'] = 'هذا التوجيه أُرسل إلى وحدة الذكاء الاصطناعي مع تلقين المستخدم.
تعديل هذا التوجيه أمر غير موصى به ما لم يكن ذلك ضروريًا.';
$string['action:summarise_text:endpoint'] = 'نقطة نهاية مفتاح واجهة برمجة التطبيق';
$string['action:summarise_text:model'] = 'وحدة الذكاء الاصطناعي';
$string['action:summarise_text:model_desc'] = 'الوحدة المستعملة لتلخيص النص المقدم';
$string['action:summarise_text:model_help'] = 'الوحدة المستعملة لتلخيص النص المقدم.';
$string['action:summarise_text:systeminstruction'] = 'تعليمات النظام';
$string['action:summarise_text:systeminstruction_desc'] = 'هذه التعليمات تُرسل إلى وحدة الذكاء الاصطناعي جنبًا إلى جنب مع النص التلقيني للمستخدم.
تعديل هذه التعليمات أمر غير موصى به ما لم يكن ذلك ضروريًا.';
$string['action:summarise_text:systeminstruction_help'] = 'هذا التوجيه أُرسل إلى وحدة الذكاء الاصطناعي مع تلقين المستخدم.
تعديل هذا التوجيه أمر غير موصى به ما لم يكن ذلك ضروريًا.';
$string['apikey'] = 'مفتاح واجهة برمجة التطبيق لـ OpenAI';
$string['apikey_desc'] = 'إحصل على المفتاح من <a href="https://platform.openai.com/account/api-keys" target="_blank">مفاتيح واجهة برمجة التطبيق لـ OpenAI</a>.';
$string['apikey_help'] = 'إحصل على المفتاح من <a href="https://platform.openai.com/account/api-keys" target="_blank">مفاتيح واجهة برمجة تطبيق OpenAI</a>.';
$string['custom_model_name'] = 'الاسم المخصص للوحدة';
$string['enableglobalratelimit'] = 'ضبط معدل الطلبات على مستوى الموقع';
$string['enableglobalratelimit_desc'] = 'تقييد عدد الطلبات التي يمكن لمزود واجهة برمجة التطبيق للذكاء الاصطناعي من OpenAI تلقيها في عموم الموقع لكل ساعة.';
$string['enableuserratelimit'] = 'ضبط معدل الطلبات على مستوى المستخدم';
$string['enableuserratelimit_desc'] = 'تقييد عدد الطلبات التي يمكن لكل مستخدم لواجهة برمجة التطبيق للذكاء الاصطناعي من OpenAI إرسالها إلى المزود لكل ساعة.';
$string['extraparams'] = 'العوامل الإضافية';
$string['extraparams_help'] = 'يمكن تهيئة العوامل الإضافية هنا. نحن ندعم صيغة JSON. على سبيل المثال:
<pre>
{
    "temperature": 0.5,
    "max_completion_tokens": 100
}
</pre>';
$string['globalratelimit'] = 'أقصى عدد من الطلبات على مستوى الموقع';
$string['globalratelimit_desc'] = 'عدد الطلبات على مستوى الموقع المسموح بها في الساعة.';
$string['invalidjson'] = 'نص JSON خاطئ';
$string['orgid'] = 'مُعرَّف المنظمة لـ OpenAI';
$string['orgid_desc'] = 'إحصل على مُعرَّف المنظمة لـ OpenAI الخاص بك من <a href="https://platform.openai.com/account/org-settings" target="_blank">حساب منصة OpenAI</a>.';
$string['orgid_help'] = 'إحصل على مُعرَّف المؤسسة لـ OpenAI الخاص بك من <a href="https://platform.openai.com/account/org-settings" target="_blank">حساب OpenAI</a>.';
$string['pluginname'] = 'مزود واجهة برمجة التطبيق لـ OpenAI';
$string['privacy:metadata'] = 'إن ملحق مفتاح واجهة برمجة التطبيق للذكاء الاصطناعي من OpenAI لا يخزن أي بيانات شخصية.';
$string['privacy:metadata:aiprovider_openai:externalpurpose'] = 'تم إرسال هذه المعلومات إلى واجهة برمجة التطبيق لـ OpenAI من أجل توليد الاستجابة. قد تؤثر إعدادات حسابك في OpenAI على كيفية قيام OpenAI بخزن تلك البيانات والاحتفاظ بها. لم يتم إرسال بيانات المستخدم بصراحة إلى OpenAI أو خزنها في نظام إدارة المحتوى التعليمي مودل من قبل هذا الملحق.';
$string['privacy:metadata:aiprovider_openai:model'] = 'الوحدة المستعملة لتوليد الاستجابة';
$string['privacy:metadata:aiprovider_openai:numberimages'] = 'عدد الصور المستعملة في الاستجابة عند توليد الصور.';
$string['privacy:metadata:aiprovider_openai:prompttext'] = 'النص المدخل من قبل المستخدم المستعمل في توليد الاستجابة';
$string['privacy:metadata:aiprovider_openai:responseformat'] = 'صيغة الاستجابة عند توليد الصور.';
$string['settings'] = 'الإعدادات';
$string['settings_frequency_penalty'] = 'غرامة_التواتر';
$string['settings_frequency_penalty_help'] = 'تغريم التواتر يضبط كم هو عدد تكرارات الكلمات. الغرامة الأعلى معناها تكرارات أقل في النص المولد.';
$string['settings_help'] = 'عدل الإعدادات أدناه لتخصيص كيفية إرسال الطلبات إلى OpenAI.';
$string['settings_max_completion_tokens'] = 'max_completion_tokens';
$string['settings_max_completion_tokens_help'] = 'أقصى عدد من الترميزات المستعملة في النص المولد.';
$string['settings_max_tokens'] = 'أقصى_ترميزات';
$string['settings_max_tokens_help'] = 'أقصى عدد من الترميزات المستعملة في النص المولد.';
$string['settings_presence_penalty'] = 'غرامة_التواجد';
$string['settings_presence_penalty_help'] = 'تغريم التواتر يشجع وحدة الذكاء الاصطناعي على استعمال كلمات جديدة من خلال زيادة إحتمالية إختيار كلمات لم يسبق لها استعمالها سابقًا. قيمة أعلى تجعل النص المولد أكثر تنوعًا، بينما القيم الأدنى تسمح بتكرارات أكثر.';
$string['settings_top_p'] = 'top_p';
$string['settings_top_p_help'] = 'top_p (نمذجة النواة) يتحكم في العدد الممكن من الكلمات التي يتم أخذها بعين الاعتبار. قيمة عالية (مثلاً 0.9) تعني أن الوحدة تتحرى كلمات أكثر، مما يجعل النص المولد أكثر تنوعًا.';
$string['userratelimit'] = 'أقصى عدد من الطلبات لكل مستخدم';
$string['userratelimit_desc'] = 'عدد الطلبات المسموح بها لكل مستخدم في الساعة.';
