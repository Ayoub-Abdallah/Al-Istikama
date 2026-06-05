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
 * Strings for component 'qtype_pmatch', language 'ar', version '5.1'.
 *
 * @package     qtype_pmatch
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['add'] = 'إضافة';
$string['addmoreanswerblanks'] = 'إضافة {no} إجابات أخرى';
$string['addmoresynonymblanks'] = 'إضافة {no} مرادفات أخرى';
$string['addtoanswer'] = 'أضف إلى الإجابة';
$string['allowsubscript'] = 'السماح باستعمال النصوص السفلية';
$string['allowsuperscript'] = 'السماح باستعمال النصوص العلوية';
$string['amatiwsurl'] = 'رابط خدمة الويب لـ Amati';
$string['amatiwsurl_desc'] = 'رابط خدمة الويب لـ Amati';
$string['answer'] = 'الإجابة: {$a}';
$string['answeringoptions'] = 'خيارات إدخال الإجابات';
$string['answermustbegiven'] = 'ينبغي عليك إعطاء الإجابة إذا كانت هناك علامة أو إفادة.';
$string['answermustmatch'] = 'الإجابة ينبغي أن تتطابق';
$string['answerno'] = 'الإجابة {$a} ينبغي أن تتطابق';
$string['answeroptions'] = 'خيارات الإجابة';
$string['anyotheranswer'] = 'أي إجابة أخرى';
$string['apply_spellchecker_label'] = 'لا تتحقق من إملاء الطالب';
$string['apply_spellchecker_missing_language_attempt'] = 'هذا السؤال معد لاستعمال التدقيق الإملائي {$a}، ولكن تلك اللغة غير متاحة في هذا المخدم.';
$string['apply_spellchecker_missing_language_select'] = '{$a} (تنبيه! القاموس غير منصب في هذا المخدم)';
$string['apply_spellchecker_select'] = '{$a->name} ({$a->code})';
$string['applydictionarycheck'] = 'التدقيق الإملائي';
$string['caseno'] = 'لا، حالة الأحرف غير مهمة';
$string['casesensitive'] = 'يتحسس حالة الأحرف';
$string['caseyes'] = 'نعم، ينبغي أن تتطابق حالة الأحرف';
$string['choosetoken'] = 'إختر الترميز';
$string['combinedcontrolnamepmatch'] = 'إدخال النص';
$string['converttospace'] = 'التحويل إلى فراغ';
$string['converttospace_help'] = 'حدد الأحرف التي تريد أن يحوّلها النظام إلى فراغات قبل تشغيل عملية مطابقة الأنماط. هذا الخيار مثالي لتبسيط عملية الإدخال إذا لم تكن علامات الترقيم مهمة.';
$string['correctanswers'] = 'مطابقة الإجابة';
$string['correctanswers_help'] = 'أبسط أشكال مطابقة الأنماط هي كتابة <code>match (word)</code>، حيث تكون كلمة \'word\' هي الكلمة التي تريد مطابقتها.

إذا كانت لديك كلمات بديلة، يمكنك إما استعمال المرادفات أعلاه، أو استخدام رمز (<code>|</code>) للدلالة على "أو". مثال: <code>match (word|words)</code>. في الحالات الأكثر تعقيدًا، يمكنك استعمال:

<pre>
match_any (
match (word)
match (words)
match (wordage)
match (wordiness)
)
</pre>
في المثال السابق، ولأن كل الإجابات تبدأ بنفس البداية، يمكنك أيضًا استعمال علامة النجمة (<code>*</code>) للسماح باستعمال أحرف بديلة متعددة: <code>match (word*)</code>. تُستعمل علامة الاستفهام (<code>?</code>) لأحرف البدل المكونة من حرف واحد.

إذا كانت لديك عبارة قصيرة ترغب في مطابقتها، فضعها بين قوسين مربعين (<code>[...]</code>). مثال: <code>match ([كلمات عديدة تُكوّن جملة قصيرة])</code>. يمكنك دمج الجمل بين قوسين مربعين وجملة أنبوبية إذا رغبت في ذلك.';
$string['correctanswers_link'] = 'Pattern-match_question_type_detailed_documentation#Pattern_match_syntax';
$string['duplicateresponse'] = '{$a}: تكرار';
$string['env_dictmissing'] = 'قاموس التدقيق اللغوي المفقود {$a->langforspellchecker} للغة المنصبة {$a->humanfriendlylang} قد تم تنصيبه.';
$string['env_dictmissing2'] = 'حاول الطالب إجراء التدقيق اللغوي باللغة \'{$a}\'. لكن قاموس التدقيق اللغوي لتلك اللغة غير منصب.';
$string['env_dictok'] = 'قاموس التدقيق اللغوي {$a->langforspellchecker} للغة المنصبة {$a->humanfriendlylang} قد تم تنصيبه.';
$string['env_peclnormalisationmissing'] = 'يبدو أن رزمة PECL لمعاير يونيكود غير منصبة بشكل صحيح';
$string['env_peclnormalisationok'] = 'يبدو أن رزمة PECL لمعاير يونيكود منصبة بشكل صحيح';
$string['env_pspellmissing'] = 'يبدو أن رزمة مكتبة Pspell غير منصبة بشكل صحيح';
$string['env_pspellok'] = 'يبدو أن رزمة مكتبة Pspell منصبة بشكل صحيح';
$string['environmentcheck'] = 'فحوصات بيئة التشغيل للسؤال من نوع المطابقة';
$string['err_ousupsubnotsupportedonmobile'] = 'هذا السؤال يتطلب استعمال النصوص السفلية أو النصوص العلوية ولذلك هو لا يعمل حتى الآن في التطبيق. ترجى الإجابة على هذا السؤال من خلال مستعرض الويب.';
$string['err_providepmatchexpression'] = 'ينبغي عليك إعطاء تعبير مطابقة هنا';
$string['error:blank'] = 'الاستجابة لا يمكن أن تكون فارغة';
$string['error:title'] = 'خطأ';
$string['errorfilecell'] = 'يتطلب الملف صفين على الأقل (الصف الأول هو صف العنوان، الصف الثاني فما بعده للإجابات).';
$string['errorfilecolumnbigger'] = 'يتضمن المف أكثر من عمودين. يرجى الاقتصار على تضمين الدرجة والاستجابة فقط.';
$string['errorfilecolumnless'] = 'يتطلب الملف عمودين على الأقل (العمود الأول هو للدرجات المتوقعة، الصف الثاني للإجابات).';
$string['errorfileformat'] = 'ينبغي أن يكون الملف بأحد الصيغ الآتية: .csv/.xlsx/.html/.json/.ods.';
$string['errors'] = 'يرجى إصلاح المشاكل الآتية: {$a}';
$string['exclude'] = 'استبعاد';
$string['extenddictionary'] = 'إضافة تلك الكلمات إلى القاموس';
$string['filloutoneanswer'] = 'استعمل صيغة مطابقة الأنماط لوصف الإجابات المحتملة. ستُقارن إجابات الطالب بهذه الإجابات بالترتيب، وسيحدد نمط المطابقة الأول النتيجة والتقييم. ينبغي عليك تقديم نمط واحد على الأقل.';
$string['forcelength'] = 'إذا كانت الإجابة تزيد عن 20 كلمة';
$string['forcelengthno'] = 'لا توجه تنبيهًا';
$string['forcelengthyes'] = 'قم بالتنبيه بأن الإجابة طويلة جدًا وحث المستجيب على تقليلها';
$string['ie_illegaloptions'] = 'خيارات غير مقبولة في التعبير "match<strong><em>{$a}</em></strong>()".';
$string['ie_lastsubcontenttypeorcharacter'] = 'كلمة "أو" ينبغي أن لا ينتهي بها المحتوى الفرعي في "{$a}".';
$string['ie_lastsubcontenttypeworddelimiter'] = 'فاصل الكلمات ينبغي أن ينتهي بها المحتوى الفرعي "{$a}".';
$string['ie_missingclosingbracket'] = 'قوس الإغلاق مفقود في مقطع النص البرمجي "{$a}".';
$string['ie_nofullstop'] = 'حروف إنهاء الفقرات غير مسموح بها في تعبيرات المطابقة. (الفاصلة العشرية التي وسط الأرقام لا بأس بها).';
$string['ie_nomatchfound'] = 'خطأ في ترميز نمط المطابقة';
$string['ie_unrecognisedexpression'] = 'تعبير غير معروف';
$string['ie_unrecognisedsubcontents'] = 'محتوى فرعي غير معروف في مقطع النص البرمجي "{$a}".';
$string['inputareatoobig'] = 'منطقة الإدخال المعرفة بـ "{$a}" كبيرة جدًا. حجم منطقة الإدخال محدد بعرض مقداره 150 حرف وارتفاع مقداره 100 حرف.';
$string['minresponses'] = 'أقل عدد من الاستجابات';
$string['minresponses_desc'] = 'أقل عدد من الاستجابات المقيمة التي ينبغي رفعها إلى نظام Amati ليولد القواعد.';
$string['modelanswer'] = 'إجابة النموذج';
$string['modelanswer_appropriateinputsize'] = 'حجم الإدخال المناسب:';
$string['modelanswer_help'] = 'أعط إجابة محتملة واحدة لهذا السؤال يمكن تقييمها على أنها صحيحة.';
$string['modelanswer_possibleanswerplaceholders'] = 'العناصر النائيبة للإجابة الصحيحة';
$string['modelanswererror'] = '\'<strong>{$a}</strong>\' ليست الإجابة الصحيحة لهذا السؤال.';
$string['modelanswermissing'] = 'ينبغي عليك إ‘طاء إجابة محتملة لهذا السؤال يمكن تقييمها على أنها 100% صحيحة.';
$string['nolanguagesfound'] = '<i>لم يتم العثور على أي لغة</i>';
$string['nomatchingsynonymforword'] = 'لم يتم إدخال مرادفات الكلمة. إحذف الكلمة أو أدخل مرادفاتها.';
$string['nomatchingwordforsynonym'] = 'لم تقم بإدخال الكلمة التي يقابلها المرادف. إحذف المرادفات أو أدخل الكلمة التي تقابلها.';
$string['notenoughanswers'] = 'هذا النوع من الأسئلة يتطلب {$a} من الإجابات على الأقل';
$string['or'] = 'أو';
$string['overallgradingaccuracy'] = 'دقة التقييم عمومًا';
$string['pleaseenterananswer'] = 'يرجى إدخال الإجابة.';
$string['pluginname'] = 'مطابقة النمط';
$string['pluginname_help'] = 'ردًا على سؤال (قد يتضمن صورة)، يكتب المُجيب عبارة قصيرة. قد تكون هناك عدة إجابات صحيحة محتملة، ولكل منها درجة مختلفة. عند اختيار "حساس لحالة الأحرف"، يمكنك الحصول على درجات مختلفة لكل من "Word" و"word".';
$string['pluginname_link'] = 'question/type/pmatch';
$string['pluginnameadding'] = 'إضافة سؤال مطابقة النمط';
$string['pluginnameediting'] = 'تحرير سؤال مطابقة النمط';
$string['pluginnamesummary'] = 'يسمح بإجابة قصيرة تتكون من جملة واحدة أو عدد قليل من الجمل التي يتم تصنيفها من خلال المقارنة بإجابات نموذجية مختلفة، والتي يتم وصفها باستعمال صيغة مطابقة النمط الخاصة بـ OU.';
$string['precedes'] = 'يسبق';
$string['precedesclosely'] = 'يسبق عن قرب';
$string['prefillanswertext'] = 'نص الإجابة المعبأ مسبقًا';
$string['prefillanswertext_help'] = 'استعمل هذا المربع لإضافة أي نص ترغب في ظهوره في نص الإجابة ليتمكن الطالب من إكماله أو تعديله أو تصحيحه. يمكنك تضمين علامتي <sub> و<sup> (ويقتصر استعمالهما على) وسوم لغة ترميز النص التشعبي (HTML).

إذا كنت تستعمل هذا الإعداد، فقد ترغب في تعطيل التدقيق الإملائي.';
$string['privacy:metadata'] = 'إن ملحق السؤال من نوع مطابقة النمط يسمح لمنشئي السؤال بوضع خيارات إفتراضية كتفضيلات للمستخدم';
$string['privacy:preference:allowsubscript'] = 'ما إذا كان النص السفلي مستعملاً لإدخال الإجابة';
$string['privacy:preference:allowsuperscript'] = 'ما إذا كان النص العلوي مستعملاً لإدخال الإجابة';
$string['privacy:preference:applydictionarycheck'] = 'ما إذا كان ينبغي تدقيق إجابة الطالب إملائيًا';
$string['privacy:preference:converttospace'] = 'ما هي الحروف المعدة لتحويلها إلى فراغات';
$string['privacy:preference:defaultmark'] = 'الدرجة الافتراضية المعدة لسؤال معين';
$string['privacy:preference:forcelength'] = 'ما إذا كان ينبغي عرض تنبيه عندما تزيد الإجابة على 20 كلمة';
$string['privacy:preference:penalty'] = 'الغرامة لكل محاولة فاشلة عند تشغيل الأسئلة بسلوك \'تفاعلي ذي محاولات متعددة\' أو \'الوضع المتكيف\'';
$string['privacy:preference:quotematching'] = 'ما إذا كانت علامات الاقتباس الذكية والمباشرة تتم مطابقتها بصرامة أم بتوانٍ';
$string['privacy:preference:sentencedividers'] = 'ما هو الحروف المعدة لمعاملتها بمثابة نقاط إنتهاء الجمل';
$string['privacy:preference:testquestion_pagesize'] = 'عدد محاولات أسئلة مطابقة النمط لإظهارها في الصفحة';
$string['privacy:preference:usecase'] = 'ما إذا كانت حالة الأحرف غير مهمة أو تنبغي مطابقتها في إجابة الطالب';
$string['processingxofy'] = 'تجري معالجة الإجابة {$a->row} من {$a->total}: {$a->response}.';
$string['repeatedword'] = 'هذه الكلمة تظهر أكثر من مرة في قائمة المرادفات.';
$string['resetrule'] = 'إعادة تعيين القاعدة';
$string['row'] = 'الصف';
$string['rule'] = 'القاعدة';
$string['ruleaccuracy'] = 'الإجابات غير المطابقة أعلاه: {$a->responseneedmatch} <br> المطابقة بشكل صحيح لهذه القاعدة: {$a->correctlymatched}، <span class="{$a->class}">المطابقة بشكل غير صحيح: {$a->incorrectlymatched}</span> <br> الإجابات التي لا تزال بانتظار المعالجة أدناه: {$a->responsestillprocess}';
$string['ruleaccuracylabel'] = 'التأثير على الإجابات النموذجية';
$string['rulecreationasst'] = 'إظهار/إخفاء مساعد إنشاء القاعدة';
$string['rulecreationtoomanyors'] = 'عذرًا، استعمالات كثيرة لـ "أو".';
$string['rulecreationtoomanyterms'] = 'عذرًا، الكثرة من الشروط.';
$string['rulesuggestionbutton'] = 'توليد تلقائي لقواعد المطابقة';
$string['rulesuggestiondescriptionnoresponses'] = 'إنشاء تلقائي لقواعد المطابقة عبر رفع مجموعة من الإجابات المقيمة بدرجات';
$string['rulesuggestionlabel'] = 'مقترح القاعدة';
$string['savedxresponses'] = 'تم حفظ {$a} من الإجابات';
$string['sentencedividers'] = 'نقاط إنتهاء العبارة';
$string['sentencedividers_help'] = 'حدد أحرفًا ليتعامل معها النظام كنقاط نهاية للجملة. افتراضيًا، علامة \'؟\' هي نقطة نهاية للجملة، لذا إذا أردت مطابقة "مرحبًا؟"، فاحذف علامة \'؟\' من هذا الحقل واستعمل "match (مرحبًا\\؟)". لاحظ أن علامة ؟" تحتاج إلى حرف الإفلات ( \\ ) في تعبير المطابقة لأنها حرف خاص، بينما لا تحتاج \'.\' و \'!\' إلى حرف الإفلات.';
$string['sentencedividers_noconvert'] = '\'<strong>{$a}</strong>\' مستعمل بمثابة <strong>نقطة نهاية العبارة</strong> ولا يمكن تحويله إلى فراغ.';
$string['setting_installed_spell_check_dictionaries'] = 'قواميس التدقيق الإملائي';
$string['setting_installed_spell_check_dictionaries_des'] = 'هذا الإعداد يتحكم بخيارات التدقيق الإملائي التي تُعرض بلغتها لمنشئي الأسئلة عندما ينشؤونها أو يحررونها.';
$string['showcoverage'] = 'إظهار التغطية';
$string['showingresponsesforquestion'] = 'يجري إظهار الإجابات للسؤال المحدد: {$a}';
$string['smart_straight_quote_matching'] = 'مطابقة علامة الاقتباس والفاصلة العلوية';
$string['smart_straight_quote_matching_help'] = 'إذا تم تمكين الخيار "متوان"، فأي علامات اقتباس متموجة (تُعرف أيضًا بـ "ذكية") والفاصلات العلوية ضمن حقول تأليف السؤال سيتم تحويلها إلى ما يقابلها من علامات الاقتباس المستوية عند الحفظ.';
$string['smart_straight_quote_matching_relaxed'] = 'متوان: كل أشكال علامات الاقتباس والفاصلات العلوية قابلة للتبديل (الافتراضي).';
$string['smart_straight_quote_matching_strict'] = 'صارم: كل أشكال علامات الاقتباس والفاصلات العلوية قائمة بحد ذاتها.';
$string['spellcheckdisabled'] = 'السماح باستعمال النصوص السفلية أو العلمية سيؤدي إلى تعطيل التدقيق الإملائي.';
$string['spellcheckerenchant'] = 'مكتبة التدقيق الإملائي Enchant';
$string['spellcheckernull'] = 'لا يتوفر أي تدقيق إملائي';
$string['spellcheckerpspell'] = 'مكتبة التدقيق الإملائي Pspell';
$string['spellcheckertype'] = 'مكتبة التدقيق الإملائي';
$string['spellcheckertype_desc'] = 'أي من مكتبات التدقيق الإملائي المستعملة. ينبغي ضبطها تلقائيًا على القيمة الصحيحة عند التنصيب.';
$string['spellingmistakes'] = 'الكلمات الآتية ليست في قاموسنا: {$a}. يرجى تصحيح إملائك.';
$string['subsuponelineonly'] = 'يمكن استعمال محرر النصوص السفلية / العلوية فقط مع مربع إدخال بعلو لا يقل عن سطر واحد.';
$string['synonym'] = 'المرادفات';
$string['synonymcontainsillegalcharacters'] = 'المرادف يحتوي على حروف غير مقبولة.';
$string['synonymsheader'] = 'تعريف المرادفات للكلمات التي في الإجابات';
$string['synonymsno'] = 'المرادفات {$a}';
$string['template'] = 'القالب';
$string['term'] = 'الشرط';
$string['test'] = 'إختبار';
$string['testquestionactualmark'] = 'الدرجة المحسوبة';
$string['testquestionbacklink'] = 'عودة إلى سؤال الفحص';
$string['testquestionchangescore'] = 'تغيير الدرجة';
$string['testquestioncorrect'] = 'صحيح';
$string['testquestiondeletedresponses'] = 'الإجابات تم حذفها بنجاح.';
$string['testquestioneditresponse'] = 'تحرير الإجابة';
$string['testquestionexpectedfraction'] = 'الدرجة البشرية';
$string['testquestionformcancelresponsebutton'] = 'إلغاء';
$string['testquestionformdeletecheck'] = 'هل أنت متأكد تمامًا من رغبتك في حذف تلك الإجابات نهائيًا؟';
$string['testquestionformdeletesubmit'] = 'حذف';
$string['testquestionformduplicateresponse'] = 'الإجابات المكررة غير مسموح بها.';
$string['testquestionformerror_incorrectquestionid'] = 'مُعرَّف السؤال خاطئ، أو هو ليس سؤال مطابقة النمط.';
$string['testquestionformheader'] = 'الإجابات المقيمة بدرجات لرفعها';
$string['testquestionforminfo'] = 'ينبغي عليك رفع ملف جدول بيانات (بصيغة .csv أو .xlsx) بعمودين. يحتوي العمود الأول على الدرجة المتوقعة لتلك الاستجابة، بينما يحتوي العمود الثاني على تلك الاستجابة. يُفترض أن يحتوي الصف الأول في الملف على عناوين الأعمدة، ويتم تجاهله.';
$string['testquestionformnewresponsebutton'] = 'إضافة إجابة جديدة';
$string['testquestionformsaveresponsebutton'] = 'حفظ';
$string['testquestionformtestsubmit'] = 'فحص الإجابات المحددة';
$string['testquestionformtitle'] = 'أداة فحص سؤال مطابقة النمط';
$string['testquestionformuploadlabel'] = 'الإجابات المقيمة بدرجات';
$string['testquestionheader'] = 'فحص السؤال: {$a}';
$string['testquestionidlabel'] = '#';
$string['testquestionincorrectlymarkedrights'] = 'العلامات السالبة المفقودة';
$string['testquestionincorrectlymarkedwrong'] = 'العلامات الموجبة المفقودة';
$string['testquestionmatches'] = 'مطابق';
$string['testquestionresponse'] = 'الإجابة';
$string['testquestionresponsesthatare'] = 'إظهار الإجابات التي';
$string['testquestionresultsheader'] = 'نتائج الفحص: {$a}';
$string['testquestionresultssummary'] = 'إجابات نموذجية: {$a->total} <br>
مقيمة بشكل صحيح: {$a->correct} ({$a->accuracy}%)<br>
<span>الدرجة المحسوبة أعلى من الدرجة البشرية: {$a->misspositive} (علامة إيجابية مفقودة)</span><br>
<span>الدرجة المحسوبة أقل من الدرجة البشرية: {$a->missnegative} (علامة سلبية مفقودة)</span>';
$string['testquestionruleslabel'] = 'القواعد';
$string['testquestionseletresponsex'] = 'إختر الإجابة {$a}';
$string['testquestiontool'] = 'أداة فحص مطابقة النمط';
$string['testquestionungraded'] = 'غير مُقيَّم';
$string['testquestionuploadanother'] = 'رفع ملف آخر';
$string['testquestionuploadincorrectmark'] = '{$a->response}: الدرجة المتوقعة كانت {$a->expectedmark}. يُسمح فقط بـ 0 أو 1.';
$string['testquestionuploadresponses'] = 'إرفع الاستجابات';
$string['testquestionuploadrowhastwoitems'] = 'ينبغي أن يحتوي كل صف على عنصرين بالضبط، درجة رقمية وإجابة. الصف <b>{$a->row}</b> يحتوي على <b>{$a->items}</b> من العناصر.';
$string['testquestionuploadrownotvalidutf8'] = 'الإجابة في الصف <b>{$a}</b> تحتوي على حروف خاصة غير معروفة. ينبغي أن يكون الإدخال حروف صحيحة بترميز UTF-8.';
$string['testquestionuploadtheseresponses'] = 'إرفع هذه الإجابات';
$string['testsubquestionx'] = 'إفحص السؤال الفرعي {$a}';
$string['testthisquestion'] = 'إفحص هذا السؤال';
$string['testthisquestionnoresmoreponsesrequired'] = 'مزيد من الإجابات مطلوبة لتعمل وظيفة الاقتراح الآلي. هناك {$a->existing} من الإجابات وأنت بحاجة إلى {$a->required} منها';
$string['testthisquestionnoresponsesfound'] = 'لم يُعثر على أي إجابة.';
$string['testthisquestionnorulesreturned'] = 'لم يتم اقتراح أي قاعدة.';
$string['toomanywords'] = 'إجابتك طويلة جدًا. يرجى تعديلها بحيث لا تتجاوز 20 كلمة.';
$string['tryrule'] = 'تجربة القاعدة';
$string['tryrulecoverage'] = 'التغطية';
$string['tryrulegradeerror'] = 'عفوًا، تجربة القاعدة تعمل فقط عند ضبط الدرجة إلى 100% أو لا شيء.';
$string['tryrulenogradedresponses'] = 'ليست هناك إجابات مقيمة، يرجى تقييم مجموعة إجاباتك.';
$string['tryrulenomatch'] = 'هذه القاعدة لا تطابق أي إجابات مقيمة.';
$string['tryrulenovalidrule'] = 'هذه القاعدة ليست تعبير صحيح لمطابقة النمط.';
$string['unknownlanguagex'] = 'لغة مجهولة ({$a})';
$string['unparseable'] = 'إننا لا نفهم الكحروف أو علامات التنقيط هنا "{$a}"';
$string['wordcontainsillegalcharacters'] = 'الكلمة تحتوي على حروف غير مقبولة.';
$string['wordwithsynonym'] = 'الكلمة';
$string['xresponsesduplicated'] = 'الإجابات {$a} الآتية تم تكرارها';
$string['xresponsesproblems'] = 'الإجابات {$a} الآتية لم يتم حفظها';
$string['xrulesuggested'] = '{$a} من الإجابات الجديدة تم اقتراحها وإضافتها إلى نهاية الإجابات الموجودة';
