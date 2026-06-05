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
 * Strings for component 'aiprovider_deepseek', language 'ar', version '5.1'.
 *
 * @package     aiprovider_deepseek
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action:explain_text:endpoint'] = 'النقطة الطرفية لواجهة برمجة التطبيق';
$string['action:explain_text:model'] = 'نموذج شرح النص!';
$string['action:explain_text:model_help'] = 'الوحدة المستعملة لتوضيح النص المقدم.';
$string['action:explain_text:systeminstruction'] = 'تعليمات النظام';
$string['action:explain_text:systeminstruction_help'] = 'يتم إرسال التعليمات إلى وحدة الذكاء الاصطناعي جنبًا إلى جنب مع النص التلقيني الذي يقدمه المستخدم. تعديل هذه التعليمات أمر غير موصى به ما لم يكن ذلك ضروريًا.';
$string['action:generate_text:endpoint'] = 'النقطة الطرفية لواجهة برمجة التطبيق';
$string['action:generate_text:model'] = 'نموذج الذكاء الاصطناعي';
$string['action:generate_text:model_help'] = 'الوحدة المستعمل لتوليد الاستجابة النصية.';
$string['action:generate_text:systeminstruction'] = 'تعليمات النظام';
$string['action:generate_text:systeminstruction_help'] = 'يتم إرسال التعليمات إلى وحدة الذكاء الاصطناعي جنبًا إلى جنب مع النص التلقيني الذي يقدمه المستخدم. تعديل هذه التعليمات أمر غير موصى به ما لم يكن ذلك ضروريًا.';
$string['action:summarise_text:endpoint'] = 'النقطة الطرفية لواجهة برمجة التطبيق';
$string['action:summarise_text:model'] = 'نموذج الذكاء الاصطناعي';
$string['action:summarise_text:model_help'] = 'الوحدة المستعملة لتلخيص النص المقدم.';
$string['action:summarise_text:systeminstruction'] = 'تعليمات النظام';
$string['action:summarise_text:systeminstruction_help'] = 'يتم إرسال التعليمات إلى وحدة الذكاء الاصطناعي جنبًا إلى جنب مع النص التلقيني الذي يقدمه المستخدم. تعديل هذه التعليمات أمر غير موصى به ما لم يكن ذلك ضروريًا.';
$string['apikey'] = 'مفتاح واجهة برمجة تطبيق Deepseek';
$string['apikey_help'] = 'أحصل على المفتاح من <a href="https://platform.deepseek.com/api_keys" target="_blank">مفاتيح واجهة برمجة تطبيق DeepSeek</a>.';
$string['custom_model_name'] = 'الاسم المخصص للنموذج';
$string['extraparams'] = 'العوامل الإضافية';
$string['extraparams_help'] = 'يمكن تهيئة المزيد من العوامل هنا. نحن ندعم صيغة JSON. على سبيل المثال:
<pre>
{
    "temperature": 0.5,
    "max_tokens": 100
}
</pre>';
$string['invalidjson'] = 'نص JSON خاطئ';
$string['pluginname'] = 'مزود واجهة برمجة تطبيق Deepseek';
$string['privacy:metadata'] = 'إن ملحق واجهة برمجة تطبيق DeepSeek لا يخزن أي بيانات شخصية.';
$string['privacy:metadata:aiprovider_deepseek:externalpurpose'] = 'تُرسل هذه المعلومات إلى واجهة برمجة تطبيقات Deepseek لإنشاء استجابة. قد تُغيّر إعدادات حسابك في Deepseek كيفية تخزين Deepseek لهذه البيانات وحفظها. لا تُرسَل بيانات المستخدم صراحةً إلى Deepseek أو تُخزَّن في نظام إدارة التعلم مودل بواسطة هذا الملحق.';
$string['privacy:metadata:aiprovider_deepseek:model'] = 'الوحدة المستعملة لتوليد الاستجابة';
$string['privacy:metadata:aiprovider_deepseek:prompttext'] = 'أدخل المستخدم نصًا تلقينيًا لتوليد الاستجابة';
$string['settings'] = 'الإعدادات';
$string['settings_frequency_penalty'] = 'غرامة_ التكرار';
$string['settings_frequency_penalty_help'] = 'رقم بين -2.0 و2.0. القيم الإيجابية تُعاقِب الترميز الجديد بناءً على تكراره الحالي في النص، مما يُقلل من احتمالية تكرار النموذج لنفس السطر حرفيًا.';
$string['settings_help'] = 'قم بتعديل الإعدادات أدناه لتخصيص كيفية إرسال الطلبات إلى Deepseek.';
$string['settings_logprobs'] = 'logprobs';
$string['settings_logprobs_help'] = 'هل سيتم إرجاع احتمالات السجل لترميز الإخراج أم لا؟ إذا كانت القيمة صحيحة، فسيتم إرجاع احتمالات السجل لكل ترميز إخراج مُعاد في محتوى الرسالة.';
$string['settings_logprobs_label'] = 'تمكين';
$string['settings_max_tokens'] = 'أقصى_ترميزات';
$string['settings_max_tokens_help'] = 'عدد صحيح بين 1 و8192. الحد الأقصى لعدد الترميزات التي يمكن إنشاؤها عند إكمال المحادثة. يقتصر الطول الإجمالي للترميزات المُدخلة والترميزات المُولدة على طول سياق النموذج. في حال عدم تحديد الحد الأقصى للترميزات، تُستعمل القيمة الافتراضية 4096.';
$string['settings_presence_penalty'] = 'غرامة_التواجد';
$string['settings_presence_penalty_help'] = 'رقم بين -2.0 و2.0. القيم الإيجابية تُعرِّض الترميزات الجديدة لعقوبة بناءً على ظهورها في النص حتى الآن، مما يزيد من احتمالية تناول النموذج لمواضيع جديدة.';
$string['settings_temperature'] = 'الحرارة';
$string['settings_temperature_help'] = 'ما هي درجة حرارة أخذ العينات المُستعملة، بين ٠ و٢. القيم الأعلى، مثل ٠.٨، ستجعل الناتج أكثر عشوائية، بينما القيم المنخفضة، مثل ٠.٢، ستجعله أكثر تركيزًا ودقة. نوصي عادةً بتعديل هذه القيمة أو أعلى_p، ولكن ليس كليهما.';
$string['settings_top_logprobs'] = 'أعلى_logprobs';
$string['settings_top_logprobs_help'] = 'عدد صحيح بين 0 و20 يحدد عدد الترميزات الأكثر احتمالاً للعودة عند كل موضع ترميز، وكل منها مع احتمالية السجل المرتبطة بها. ينبغي تعيين logprobs على true إذا تم استعمال هذ العامل.';
$string['settings_top_p'] = 'أعلى_p';
$string['settings_top_p_help'] = 'هناك بديل لأخذ العينات باستعمال درجة الحرارة، يُسمى أخذ العينات من النواة، حيث يأخذ النموذج بعين الاعتبار نتائج الرموز ذات الكتلة الاحتمالية الأعلى p. لذا، فإن 0.1 تعني أن الرموز التي تشكل الكتلة الاحتمالية الأعلى 10% هي فقط التي تُؤخذ في الاعتبار. نوصي عادةً بتعديل هذا أو درجة الحرارة، ولكن ليس كليهما.';
