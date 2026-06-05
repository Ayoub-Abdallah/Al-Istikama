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
 * Strings for component 'aiprovider_ollama', language 'ar', version '5.1'.
 *
 * @package     aiprovider_ollama
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action:explain_text:model'] = 'وحدة توضيح النص';
$string['action:explain_text:model_help'] = 'الوحدة المستعملة لتوضيح النص المقدم.';
$string['action:explain_text:systeminstruction'] = 'تعليمات النظام';
$string['action:explain_text:systeminstruction_help'] = 'تُرسل هذه التعليمات إلى وحدة الذكاء الاصطناعي مع الأمر التلقيني للمستخدم. من غير الموصى به تعديل تلك التعليمات ما لم يكن ذلك ضروريًا.';
$string['action:generate_text:model'] = 'وحدة توليد النص';
$string['action:generate_text:model_help'] = 'الوحدة المستعملة لتوليد الاستجابة النصية.';
$string['action:generate_text:systeminstruction'] = 'تعليمات النظام';
$string['action:generate_text:systeminstruction_help'] = 'تُرسل هذه التعليمات إلى وحدة الذكاء الاصطناعي مع الأمر التلقيني للمستخدم. من غير الموصى به تعديل تلك التعليمات ما لم يكن ذلك ضروريًا.';
$string['action:summarise_text:model'] = 'وحدة تلخيص النص';
$string['action:summarise_text:model_help'] = 'الوحدة المستعملة لتلخيص النص المقدم.';
$string['action:summarise_text:systeminstruction'] = 'تعليمات النظام';
$string['action:summarise_text:systeminstruction_help'] = 'تُرسل هذه التعليمات إلى وحدة الذكاء الاصطناعي مع الأمر التلقيني للمستخدم. من غير الموصى به تعديل تلك التعليمات ما لم يكن ذلك ضروريًا.';
$string['custom_model_name'] = 'الاسم المخصص للوحدة';
$string['enablebasicauth'] = 'تمكين المصادقة الأساسية';
$string['enablebasicauth_help'] = 'تمكين المصادقة الأساسية لمزود واجهة برمجة تطبيق Ollama.';
$string['endpoint'] = 'النقطة الطرفية لواجهة برمجة التطبيق';
$string['endpoint_help'] = 'النقطة الطرفية لواجهة برمجة التطبيق الخاصة بمخدم Ollama.';
$string['extraparams'] = 'المعاملات الإضافية';
$string['extraparams_help'] = 'يمكن تهيئة المعاملات الإضافية هنا. نحن ندعم صيغة JSON. على سبيل المثال:
<pre>
{
    "temperature": 0.5,
    "max_tokens": 100
}
</pre>';
$string['invalidjson'] = 'سلسلة JSON خاطئة';
$string['password'] = 'كلمة المرور';
$string['password_help'] = 'كلمة المرور المستعملة للمصادقة الأساسية.';
$string['pluginname'] = 'مزود واجهة برمجة تطبيق Ollama';
$string['privacy:metadata'] = 'إن ملحق مزود واجهة برمجة تطبيق Ollama لا يخزن أي بيانات إضافية.';
$string['privacy:metadata:aiprovider_ollama:externalpurpose'] = 'هذه المعلومات تُرسل إلى واجهة برمجة تطبيق Ollama من أجل توليد الاستجابة. إعدادات حسابك في Ollama قد تؤدي إلى تغيير كيفية قيام Ollama بتخزين تلك البيانات والاحتفاظ بها. لا تُرسل أي بيانات شخصية حصرية إلى Ollama أو تُخزن في مودل من قبل هذا الملحق.';
$string['privacy:metadata:aiprovider_ollama:model'] = 'الوحدة المستعملة لتوليد الاستجابة';
$string['privacy:metadata:aiprovider_ollama:prompttext'] = 'المستخدم الذي أدخل التلقين النصي المستعمل لتوليد الاستجابة';
$string['settings'] = 'الإعدادات';
$string['settings_help'] = 'عدل الإعدادات أدناه لتخصيص كيفية إرسال الطلبات إلى Ollama.';
$string['settings_mirostat'] = 'Mirostat';
$string['settings_mirostat_help'] = 'إن Mirostat هي خوارزمي فك ترميز النصوص مستندة إلى شبكات عصبية تستعمل للتحكم بدرجة التعقيد. 0 = معطل، 1 = Mirostat، 2 = Mirostat 2.0 (الإفتراضي: 0)';
$string['settings_seed'] = 'الجذر';
$string['settings_seed_help'] = 'يضبط جذر الرقم العشوائي المستعمل للتوليد. جعله رقمًا معينًا سيجعل الوحدة تولد نفس النص لنفس الأمر التلقيني. (الإفتراضي: 0)';
$string['settings_temperature'] = 'الحرارة';
$string['settings_temperature_help'] = 'الحرارة تؤثر على كون المخرجات أكثر عشوائية وإبداعًا أو أقرب إلى التوقع.
زيادة الحرارة سيؤدي إلى جعل الوحدة تقدم إجابات أكثر إبداعًا. (الافتراضي: 0.8)';
$string['settings_top_k'] = 'top_k';
$string['settings_top_k_help'] = 'يقلل إحتمالية توليد إجابة غير منطقية. قيمة أعلى (مثلاً 100) سيعطي إجابات أكثر تنوعًا، بينما قيمة أدنى (مثلاً 10) سيجعله أكثر تحفظًا. (الافتراضي 40)';
$string['settings_top_p'] = 'top_p';
$string['settings_top_p_help'] = 'يعمل جنبًا إلى جنب مع top-k. قيمة أعلى (مثلاً 0.95) سيؤدي إلى نص أكثر تنوعًا، بينما قيمة أدنى (مثلاً 0.5) سيولد نصًا أكثر تركيزًا وتحفظًا. (الافتراضي 0.9)';
$string['username'] = 'اسم المستخدم';
$string['username_help'] = 'اسم المستخدم المستعمل للمصادقة الأساسية.';
