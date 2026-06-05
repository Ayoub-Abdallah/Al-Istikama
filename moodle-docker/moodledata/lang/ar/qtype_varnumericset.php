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
 * Strings for component 'qtype_varnumericset', language 'ar', version '5.1'.
 *
 * @package     qtype_varnumericset
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addmoreanswerblanks'] = 'إضافة {no} إجابات أخرى';
$string['addmorevariants'] = 'إضافة {$a} من الفراغات الإضافية للمزيد من المتغيرات';
$string['addmorevars'] = 'إضافة {no} من الفراغات الأخرى للمتغيرات';
$string['ae_numericallycorrect'] = 'إجابتك قريبة من الصحة. لديك القيمة الصحيحة وهي مُقرَّبة بشكل صحيح.';
$string['ae_numericallycorrectandwrongformat'] = 'إجابتك قريبة من الصحة. لديك القيمة الصحيحة وهي مُقرَّبة بشكل صحيح. ولكنها ليست بالترميز العلمي.';
$string['ae_roundingincorrect'] = 'إجابتك قريبة من الصحة، لكنها مُقرَّبة بشكل خاطئ.';
$string['ae_roundingincorrectandwrongformat'] = 'إجابتك قريبة من الصحة، لكنها مُقرَّبة بشكل خاطئ وليست بالترميز العلمي.';
$string['ae_toomanysigfigs'] = 'إجابتك قريبة من الصحة، لكنها تتضمن عدداً كبيراً من المراتب.';
$string['ae_toomanysigfigsandwrongformat'] = 'إجابتك قريبة من الصحة، لكنها تتضمن عدداً كبيراً من المراتب وليست بالترميز العلمي.';
$string['ae_wrongbyfactorof10'] = 'إجابتك قريبة من الصحة، لكن معامل 10 فيها خاطئ.';
$string['ae_wrongbyfactorof10andwrongformat'] = 'إجابتك قريبة من الصحة، لكن معامل 10 فيها خاطئ وليست بالترميز العلمي.';
$string['answer'] = 'الإجابة: {$a}';
$string['answermustbegiven'] = 'ينبغي عليك إدخال الإجابة إذا كانت هناك علامة أو إفادة.';
$string['answerno'] = 'الإجابة {$a}';
$string['autofirehdr'] = 'أعطِ الإفادة وجزء من الدرجة حيث تكون الإجابة {$a} خاطئة جزئياً';
$string['calculatewhen'] = 'متى يتم حساب القيم المحسوبة';
$string['cannotrecalculate'] = 'تتعذر إعادة حساب القيم للمتغيرات المحسوبة نظراً لوجود أخطاء في النموذج، عذراً. لطفاً، قم بإصلاح الأخطاء لتتمكن من إعادة حساب القيم.';
$string['checknumerical'] = 'إن كانت صائبة رقمياً';
$string['checkpowerof10'] = 'إن كان أس 10 غائباً';
$string['checkrounding'] = 'إن كان التقريب غير صحيح';
$string['checkscinotation'] = 'إن كان الترميز العلمي مطلوباً ولكنه غير مستعمل';
$string['correctansweris'] = 'الإجابة الصحيحة هي: {$a}';
$string['correctansweriserror'] = '{$a->answer} <sup>+</sup>/<sub>-</sub> {$a->error}';
$string['correctanswerissigfigs'] = '{$a->answer} ({$a->sigfigs} من الأرقام المؤثرة)';
$string['correctanswers'] = 'الإجابات الصائبة';
$string['err_ousupsubnotsupportedonmobile'] = 'هذا السؤال يتطلب استعمال الرموز الفوقية أو المنخفضة ولذلك فهو لا يعمل من هذا التطبيق. لطفاً، حاول إجابة هذا السؤال عبر مستعرض الويب.';
$string['error'] = 'الخطأ المقبول +/-';
$string['errorreportedbyexpressionevaluator'] = 'خطأ في تقييم التعبير: {$a}';
$string['expectingassignment'] = 'ينبغي عليك استعمال تعبير رياضي لتعيين القيمة إلى \'متغير محسوب\'.';
$string['expectingvariablename'] = 'يُتوقع وضع تسمية المتغير هنا';
$string['expressionevaluatesasinfinite'] = 'النتيجة هي ما لا نهاية.';
$string['expressionevaluatesasnan'] = 'النتيجة ليست رقماً.';
$string['expressionmustevaluatetoanumber'] = 'ينبغي عليك إدخال تعبير ذو قيمة رقمية هنا، وليس تعييناً لها';
$string['filloutoneanswer'] = 'ينبغي عليك تقديم إجابة محتملة واحدة على الأقل. الإجابات التي تتركها فارغة لن يتم استعمالها. يمكن استعمال \'*\' بمثابة رمز بديل يقابل أي رقم. سيتم استعمال أول إجابة مطابقة لتقرير الدرجة والإفادة.';
$string['forallanswers'] = 'لكل الإجابات';
$string['hintoverride'] = 'إذا انطلق التحقق التلقائي، إسمح بمحاولة أخرى، ولكن لا تُظهر هذا التلميح أو تطبق هذه الغرامة';
$string['illegalthousandseparator'] = 'لقد استعملتَ فاصلة آلاف غير صحيحة "{$a->thousandssep}" في إجابتك. نحن نقبل فقط الإجابات ذات الفاصلة العشرية "{$a->decimalsep}".';
$string['notenoughanswers'] = 'هذا النوع من الأسئلة يتطلب {$a} من الإجابات على الأقل';
$string['notvalidnumber'] = 'لم تقم بإدخال رقم بتنسيق معروف.';
$string['notvalidnumberprepostfound'] = 'لطفاً، أدخل رقماً صائباً، وليس شيئاً آخر.';
$string['options'] = 'الخيارات';
$string['pleaseenterananswer'] = 'لطفاً، أدخل الإجابة.';
$string['pluginname'] = 'مجموعة متغيرات رقمية';
$string['pluginname_help'] = 'للإجابة على السؤال، يقوم المجيب بطباعة رقم معين.

يتم اختيار الأرقام المستعملة في السؤال والأرقام المستعملة في حساب الإجابة من مجموعة محضرة مسبقاً، وهذه الأخيرة يمكن حسابها مسبقاً من تعابير رياضية.

يتم حساب كل التعابير عند إنشاء السؤال والقيم الناتجة من الدوال العشوائية هي نفسها لجميع المستخدمين. للحصول على سؤال بلا متغيرات، مع تعابير محسوبة آنياً وقيم عشوائية مختلفة لكل مستخدم، أنظر نوع السؤال \'متغيرات رقمية\'.';
$string['pluginname_link'] = 'question/type/varnumericset';
$string['pluginnameadding'] = 'إضافة سؤال مجموعة متغيرات رقمية';
$string['pluginnameediting'] = 'تحرير سؤال مجموعة متغيرات رقمية';
$string['pluginnamesummary'] = 'يسمح باستجابة رقمية، يمكن للأسئلة أن يكون لها \'متغيرات\' متعددة، يتم تقييم التعابير لكل متغير في السؤال';
$string['preandpostfixesignored'] = 'تم منح العلامة على الجزء الرقمي فقط من إجابتك.';
$string['privacy:metadata'] = 'إن ملحق نوع السؤال، مجموعة متغيرات رقمية لا يخزن أي بيانات شخصية.';
$string['questiontext'] = 'نص السؤال والمتغيرات المتضمنة';
$string['questiontext_help'] = 'يمكنك تضمين أسماء المتغيرات والتعابير في نص السؤال، الإفادة العامة، إفادة الإجابة، والتلميحات.

كل ما تتم إحاطته بأقواس مربعة مزدوجة سيتم تقييمه قبل عرضه. أي، إذا أدخلتَ على سبيل المثال، [[a]] فسيتم عرض قيمة المتغير a. [[log(a)]] ستعرض قيمة لوغارتم a.

يمكنك أيضاً تحديد كيفية عرض النتيجة مستعملاً ترميزات printf. على سبيل المثال، [[a,.3e]] ستعرض القيمة بالترميز العلمي مع 4 مراتب مؤثرة.';
$string['randomseed'] = 'الجُملة المستعملة كجذر لتوليد العشوائية';
$string['recalculatenow'] = 'إعادة الحساب الآن';
$string['requirescinotation'] = 'يتطلب الترميز العلمي';
$string['sigfigs'] = 'الأرقام المؤثرة';
$string['syserrorpenalty'] = 'لكل خصم من الأخطاء';
$string['unspecified'] = 'غير محدد';
$string['usesuperscript'] = 'استعمال الرموز المرتفعة';
$string['varheader'] = 'المتغير {no}';
$string['variables'] = 'المتغيرات';
$string['variant'] = 'قيمة المتغير {$a}';
$string['variants'] = 'قيم المتغيرات';
$string['variants_help'] = 'أدخل قيم \'المتغيرات المُعرَّفة مسبقاً\' هنا <strong>أو</strong> إذا كان هذا \'متغيراً محسوباً\'، فسترى القيم المحسوبة هنا.

بالنسبة إلى المتغير المُعرَّف مسبقاً، ينبغي عليك إدخال القيمة لمتغير واحد في السؤال على الأقل، ولكل المتغيرات المعرفة مسبقاً، فعليك إملاء عدد مساوٍ من الخانات.

يقوم مودل تلقائياً بتقرير عدد المتغيرات التي في السؤال عبر معاينة عدد قيم المتغيرات للمتغيرات المُعرَّفة مسبقاً والتي تم إملاؤها، أو إذا لم يكن هناك متغيرات مُعرَّفة مسبقاً، بل متغيرات محسوبة فقط، عندها سنفترض وجود 5 متغيرات في السؤال. ليس عليك إملاء الخانات الفارغة الأخيرة، إنها فقط لإتاحة المجال لك لوضع المزيد من القيم للمتغيرات في السؤال، إذا تطلب الأمر ذلك.';
$string['varname'] = 'الاسم أو التعيين';
$string['varname_help'] = 'بالنسبة إلى \'متغير مُعرَّف مسبقاً\' تقوم فقط بإدخال اسم المتغير هنا، مثلاً \'a\'. ثم أدخل قيم هذا المتغير لكل متغير في السؤال أدناه.

أو بالنسبة إلى \'متغير محسوب\' أدخل اسم المتغير وعيِّن له قيمة من تعبير رياضي، مثلاً \'b = a^4\' (حيث أن \'a\' هو متغير مُعرَّف مسبقاً).

إذا تركتَ هذا الحقل فارغاً، فأي قيم أدناه سيتم تجاهلها.';
$string['varnumericset'] = 'مجموعة متغيرات رقمية';
$string['varnumericset_help'] = 'للإجابة على السؤال، يقوم المجيب بطباعة رقم معين.

يتم اختيار الأرقام المستعملة في السؤال والأرقام المستعملة في حساب الإجابة من مجموعة محضرة مسبقاً، وهذه الأخيرة يمكن حسابها مسبقاً من تعابير رياضية.

يتم حساب كل التعابير عند إنشاء السؤال والقيم الناتجة من الدوال العشوائية هي نفسها لجميع المستخدمين. للحصول على سؤال بلا متغيرات، مع تعابير محسوبة آنياً وقيم عشوائية مختلفة لكل مستخدم، أنظر نوع السؤال \'متغيرات رقمية\'.';
$string['varnumericset_link'] = 'question/type/varnumericset';
$string['varnumericsetsummary'] = 'يسمح بالاستجابة رقمية، يمكن للسؤال أن تكون له \'متغيرات\' متعددة. يتم تقييم التعابير مسبقاً لكل متغير في السؤال';
$string['vartypecalculated'] = 'المتغير المحسوب';
$string['vartypepredefined'] = 'المتغير المُعرَّف مسبقاً';
$string['youmustprovideavalueforallvariants'] = 'لطفاً، أدخل عدداً مساوياً من الفراغات لكل المتغيرات التي سبق تعريفها، أي قيمة لكل متغير مُعرَّف مسبقاً ولكل متغيرات السؤال التي تطلبها.';
$string['youmustprovideavalueforatleastonevariant'] = 'ينبغي عليك وضع قيمة هنا.';
