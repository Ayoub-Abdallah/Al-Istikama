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
 * Strings for component 'block_xp', language 'ar', version '5.1'.
 *
 * @package     block_xp
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actions'] = 'الإجراءات';
$string['activityname'] = 'اسم النشاط';
$string['activityname_help'] = 'النص الذي  ينبغي أن يكون اسم النشاط محتويًا له أو مساويًا. إنه لا يتحسسن حالة الأحرف';
$string['activityoresourceis'] = 'النشاط أو المورد هو {$a}';
$string['addacondition'] = 'إضافة شرط';
$string['addarule'] = 'إضافة قاعدة';
$string['addinstructions'] = 'إضافة المزيد من المعلومات';
$string['additionalresources'] = 'الموارد الأخرى';
$string['addlevel'] = 'إضافة مرحلة';
$string['addondeactivated'] = 'XP+ معطلة';
$string['addondeactivatedinfo'] = 'إن ملاحق XP ليست على توافق فيما بينها، مما يؤدي إلى تعطيل XP+. إن إصدار {$a->localxpversion} للملحق الترقي XP+ (local_xp) هو المتوقع.';
$string['addoninstallationerror'] = 'لقد اكتشفنا مشكلة في الملحق (local_xp)، ولا يبدو أنه غير منصب بشكل صحيح. ينبغي على المشرف إكمال تنصيبه.';
$string['addonnotactivated'] = 'الملحق غير مفعل.';
$string['addrulesformhelp'] = 'العمود الأخير يُعرِّف مقدار نقاط الخبرة المكتسبة عند تلبية المعيار.';
$string['admindefaultrulesintro'] = 'القواعد الآتية ستُستعمل إفتراضيًا للمساقات التي تُضاف إليها الكتلة.';
$string['admindefaultsettingsintro'] = 'الإعدادات أدناه ستُستعمل بمثابة الإفتراضيات عند إضافة الكتلة حديثًا إلى مساق ما. يمكن إقفال بعض الإعدادات، مما يؤدي إلى فرض قيمها في كل العينات التي للملحق.';
$string['admindefaultvisualsintro'] = 'ما يلي سيُستعمل بمثابة الإفتراضيات عند إضافة الكتلة حديثًا إلى مساق ما.';
$string['adminnoticeaddondeactivatedmessage'] = 'تم تعطيل ميزة الترقي XP+!

تتلقى هذا الإشعار كتحذير لأنه تم تعطيل ميزة الترقي XP+ لتجنب أي مشاكل محتملة. الملحقان الترقي XP (block_xp) والترقي XP+ (local_xp) غير متوافقتين حاليًا. تحدث هذه المشكلة عند ترقية XP إلى إصدار رئيسي جديد مع بقاء ميزة XP+ قديمة.

قد يؤدي هذا التعارض إلى فقدان الوظائف وظهور أخطاء وعواقب غير متوقعة أخرى. لحل هذه المشكلة، ينبغي عليك ترقية ميزة الترقي XP+.

- إصدار الترقي XP (block_xp): {$a->blockxpversion}
- إصدار الترقي XP+ (local_xp): {$a->localxpversion}
- الإصدار المتوقع لـ الترقي XP+: {$a->localxpversionexpected}

مصادر إضافية:

- [وثائق الترقية](https://docs.levelup.plus/xp/docs/upgrade)
- [وثائق إلغاء تنشيط XP+](https://docs.levelup.plus/xp/docs/addon-deactivated)
- [وثائق التوافق](https://docs.levelup.plus/xp/docs/requirements-compatibility)

--

تم إرسال هذا الإشعار إلى كل المشرفين. لتعطيل كل إشعارات المشرفين، يُرجى زيارة إعدادات مشرف الترقي XP.';
$string['adminnoticeaddondeactivatedsubject'] = 'إن ملحق XP+ معطل!';
$string['adminnoticeoutofsyncmessage'] = 'إشعار بعدم توافق الترقي XP والترقي XP+!

يُرسل إليك هذا الإشعار كتحذير لأن الملحقين الترقي XP (block_xp) والترقي XP+ (local_xp) غير متزامنين حاليًا وغير متوافقين مع بعضهما البعض. تحدث هذه المشكلة عند ترقية XP إلى إصدار رئيسي جديد مع بقاء إصدار XP+ قديمًا.

قد يؤدي هذا التعارض إلى فقدان الوظائف وظهور أخطاء وعواقب غير متوقعة أخرى. لحل هذه المشكلة، يجب عليك ترقية الترقي XP+.

**هام!** في المستقبل، إذا لم تكن هذه الملاحق متزامنة، فسيتم تعطيل الترقي XP+ تلقائيًا. لمنع حدوث ذلك، تأكد من عدم ترقية الترقي XP إلى إصدار رئيسي جديد دون ترقية الترقي XP+ أيضًا.

- إصدار ترقية XP (block_xp): {$a->blockxpversion}
- إصدار ترقية XP+ (local_xp): {$a->localxpversion}
- الإصدار المتوقع لترقية XP+: {$a->localxpversionexpected}

مصادر إضافية:

- [وثائق الترقية](https://docs.levelup.plus/xp/docs/upgrade)
- [وثائق التوافق](https://docs.levelup.plus/xp/docs/requirements-compatibility)

--

تم إرسال هذا الإشعار إلى كل المشرفين. لتعطيل كل إشعارات المشرفين، يُرجى زيارة إعدادات مشرف الترقي XP.';
$string['adminnoticeoutofsyncsubject'] = 'إشعار عدم توافق ملاحق XP!';
$string['adminnotices'] = 'إشعارات المشرف';
$string['adminnotices_desc'] = 'عند تمكين هذه الميزة، قد يتلقى مشرفو الموقع في بعض الأحيان إشعارات مهمة تتعلق بالتوافق والأمان وتوافر الإصدارات الأحدث من الترقي XP+.';
$string['adminscanearnxp'] = 'المشرفون يمكنهم اكتساب النقاط';
$string['adminscanearnxp_desc'] = 'افتراضيًا، لا يُدرج المشرفون ضمن مجموعة المستخدمين الذين يمكنهم كسب النقاط. وذلك لأن المشرفين لديهم دائمًا صلاحية _block/xp:earnxp_، مما يسمح لهم بجمع النقاط باستمرار في كل مكان. يمكنك استعمال هذا الإعداد للسماح للمشرفين أيضًا بكسب النقاط.';
$string['allcoursesreset'] = 'تمت إعادة تعيين كل المساقات.';
$string['anonymity'] = 'عدم الكشف عن الهوية';
$string['anonymity_help'] = 'هذا الإعداد يتحكم فيما إذا كان بإمكان المشاركين مشاهدة اسم أي منهم وصورته المستعارة.';
$string['apply'] = 'تطبيق';
$string['awardaxpwhen'] = '<strong>{$a}</strong> من النقاط تُكتسب عند:';
$string['badgeaward'] = 'الشارة الممنوحة';
$string['badgeawarddesc'] = 'الشارة الممنوحة عند وصول المستخدم إلى المرحلة.';
$string['basepoints'] = 'النقاط الأساسية';
$string['basepointslineardesc'] = 'الزيادة الصغرى ما بين مرحلة وأخرى.';
$string['basepointsrelativedesc'] = 'عدد النقاط التي تبدأ منها';
$string['basexp'] = 'أساس الخوارزمية';
$string['blockappearance'] = 'مظهر الكتلة';
$string['blockappearancemovedtopluginsettings'] = 'تم نقل إعدادات مظهر الكتلة إلى صفحة إعدادات الملحق.';
$string['cachedef_filters'] = 'مرشحات المرحلة';
$string['cachedef_metadata'] = 'البيانات الوصفية';
$string['cachedef_ruleevent_eventslist'] = 'قائمة بعض الأحداث';
$string['canjoinfromdatex'] = 'ستتمكن من الالتحاق من {$a}.';
$string['cannotbesetindefaults'] = 'لا يمكن ضبطه في الإعدادات الافتراضية.';
$string['cannotearnpoints'] = 'لا يمكنه اكتساب النقاط.';
$string['cannotshowblockconfig'] = 'أقوم عادة بعرض إعدادات الظهور هنا، ولكنني لم أتمكن من العثور على كتلتك. لتغيير مظهر الكتلة، توجه إلى [هنا] ({$a}) (أو حيثما أضفت الكتلة)، قم بتشغيل وضع التحرير، واتبع خيار "التهيئة" في القائمة المنسدلة للكتلة. إن لم تجد الكتلة، أضفها إلى مساقك مجددًا.';
$string['cannotshowblockconfigsys'] = 'سأقوم عادة بعرض إعدادات القالب هنا، ولكنني لم أتمكن من العثور على كتلتك. قد تكون مفقودة من [front page]({$a->fp}) ومن [default dashboard] ({$a->mysys}) لمستخدميك، أو موجودة في كليهما. لتحرير الإعدادات من هنا، تأكد من كونها تظهر في واحدة منهما فقط.';
$string['changecourse'] = 'تغيير المساق';
$string['changelevelformhelp'] = 'إذا غيرت عدد المراحل، سيتم تعطيل شارات المراحل المخصصة مؤقتًا لمنع مصادفة مراحل بدون شارات. إذا غيرت عدد المراحل، إذهب إلى \'مرئيات\' الصفحة إعادة تمكين الشارات المخصصة بمجرد حفظك لهذا النموذج.';
$string['changetocourse'] = 'التغيير إلى المساق';
$string['changetositewide'] = 'عودة إلى مستوى الموقع';
$string['cheatguard'] = 'مانع الغش';
$string['cheatguardsettingsmovednotice'] = 'إعدادات مانع الغش نُقلت إلى [صفحة قواعد الحدث]({$a->url}).';
$string['checkaddoncompatibility'] = 'تكامل ملحق الترقي XP';
$string['chooseacondition'] = 'إختر الشرط';
$string['clearfilter'] = 'إخلاء المرشح';
$string['clicktoselectcm'] = 'أنقر لاختيار النشاط أو المورد';
$string['cmselector'] = 'منتقي وحدة المساق';
$string['coefxp'] = 'معامل الخوارزمية';
$string['colon'] = '{$a->a}: {$a->b}';
$string['comparisonmethod'] = 'طريقة المقارنة';
$string['compatibilitycheck'] = 'فحص التوافق';
$string['completionrules'] = 'قواعد الإكمال';
$string['completionrules_help'] = 'تُقسّم قواعد الإكمال إلى ثلاث فئات: إكمال النشاط، وإكمال المقطع، وإكمال المساق. إضافة شروط إلى الفئات تُحدد وقت وعدد النقاط المُمنوحة.

تُقيّم القواعد حسب ترتيب عرضها على الشاشة. بمجرد استيفاء شرط، تُمنح النقاط المُقابلة له، ولن تُقيّم القواعد الأخرى.

[للمزيد](https://docs.levelup.plus/xp/docs/completion-rules?ref=blockxp_help)';
$string['completionrulesintro'] = 'خصص النقاط للطلاب بمجرد إكمالهم للنشاطات، المقاطع، أو المساقات.';
$string['completionruleslegacyusednotice'] = 'لديك "قواعد أحداث" حالية تستعمل شروط الإكمال. نوصي بشدة بإزالتها واستعمال الطرق التالية، لأن استعمال كلٍّ من "قواعد الأحداث" و"قواعد الإكمال" قد يُضاعف النقاط الممنوحة.';
$string['condition'] = 'الشرط';
$string['configblockrankingsnapshot'] = 'عرض لقطة لوحة المتصدرين';
$string['configblockrankingsnapshot_help'] = 'تعرض لقطة لوحة المتصدرين ترتيب المستخدم، كما ستحاول عرض الشخصين المحيطين به. تتطلب هذه الميزة تفعيل لوحة المتصدرين وعرض ترتيبهم فيها.';
$string['configdescription'] = 'المقدمة';
$string['configdescription_help'] = 'وصف موجز يُعرض في الكتلة. للطلاب إمكانية صرف الرسالة، وفي تلك الحالة، لن يشاهدوها مرة أخرى.';
$string['configheader'] = 'الإعدادات';
$string['configrecentactivity'] = 'عرض المكافآة الأخيرة';
$string['configrecentactivity_help'] = 'عند تمكينه، ستعرض الكتلة قائمة مختصرة للأحداث الأخيرة التي كافأت الطالب بالنقاط.';
$string['configtitle'] = 'العنوان';
$string['configtitle_help'] = 'عنوان الكتلة.';
$string['congratulationsyouleveledup'] = 'تهانينا!';
$string['coolthanks'] = 'جميل، شكرًا!';
$string['coursea'] = 'المساق "{$a}"';
$string['courselog'] = 'السجل';
$string['courselogintro'] = 'يعرض السجل الإجراءات الملاحظة، وكم من النقاط التي منحتها.';
$string['coursereport'] = 'التقرير';
$string['coursereportintro'] = 'يوفر التقرير تفاصيل عن كل مشارك، ويدعم التعامل معهم فرديًا أو جماعيًا.';
$string['courserules'] = 'قواعد المساق';
$string['courseselectedcolon'] = 'المساق المحدد:';
$string['coursesettings'] = 'إعدادات المساق';
$string['coursevisuals'] = 'مرئيات المساق';
$string['currencysign'] = 'رمز النقاط';
$string['currencysign_help'] = 'باستعمال هذا الإعداد، يمكنك تغيير معنى النقاط. سيظهر الرمز بجوار عدد نقاط كل مستخدم، كبديل عن الإشارة إلى _نقاط الخبرة_.

اختر أحد الرموز المُتاحة، أو ارفع رمزك الخاص!';
$string['currencysignxp'] = 'XP (نقاط الخبرة)';
$string['customizelevels'] = 'تخصيص المراحل';
$string['dangerzone'] = 'منطقة الخطر';
$string['dataformat'] = 'الشكل';
$string['defaultlevels'] = 'المراحل الافتراضية';
$string['defaultrules'] = 'القواعد الافتراضية';
$string['defaultrulesformhelp'] = 'هذه هي القواعد الافتراضية التي يوفرها الملحق، وهي تُعطي تلقائيًا نقاطًا افتراضية وتتجاهل بعض الأحداث المكررة. قواعدك الخاصة لها الأولوية عليها.';
$string['defaultsettings'] = 'الإعدادات الافتراضية';
$string['defaultvisuals'] = 'المظهر الافتراضي';
$string['deletecondition'] = 'حذف الشرط';
$string['deleterule'] = 'حذف القاعدة';
$string['description'] = 'الوصف';
$string['difference'] = 'الفرق';
$string['difficulty'] = 'طريقة إحتساب النقاط';
$string['difficultyflat'] = 'يساوي';
$string['difficultyflatdesc'] = 'تتطلب كل المراحل إحراز نفس عدد النقاط.';
$string['difficultylinear'] = 'بزيادة';
$string['difficultylineardesc'] = 'تحتاج المراحل جهدًا مضطردًا للوصول إليها.';
$string['difficultylinearincrdesc'] = 'عدد النقاط المستعملة للصعوبة المضطردة.';
$string['difficultypointincrease'] = 'زيادة النقاط';
$string['difficultyrelative'] = 'كرة الثلج';
$string['difficultyrelativedesc'] = 'تتصاعد صعوبة الوصول إلى المراحل.';
$string['difficultyrelativeincrdesc'] = 'نسبة الزيادة المئوية من المرحلة السابقة.';
$string['discoverlevelupplus'] = 'استكشاف الترقي XP+';
$string['dismissnotice'] = 'صرف الملاحظة';
$string['displayeveryone'] = 'عرض الجميع';
$string['displaynneighbours'] = 'عرض {$a} من المجاورين';
$string['displayoneneigbour'] = 'عرض مجاور واحد فقط';
$string['displayparticipantsidentity'] = 'عرض هوية المشارك';
$string['displayrank'] = 'عرض المرتبة';
$string['displayrelativerank'] = 'عرض المرتبة النسبية';
$string['documentation'] = 'التوثيقات';
$string['drops'] = 'اللقيات';
$string['drops_help'] = 'في ألعاب الفيديو، يُمكن لبعض الشخصيات إسقاط عناصر أو نقاط خبرة على الأرض ليلتقطها اللاعب. تُعرف هذه العناصر والنقاط عادةً باسم "اللقيات".

في الترقي XP، تُعتبر اللقيات رموزًا مختصرة (مثل `[xpdrop id=1 secret=abcdef]`) يُمكن للمُدرِّب وضعها في محتوى مودل العادي. عند مصادفة المستخدم لهذه اللقيات، يتم التقاطها ومنحه نقاطًا.

حاليًا، تكون اللقيات غير مرئية للمستخدم، وتُمنح نقاطًا تلقائيًا عند مواجهتها لأول مرة.

يمكن استعمال اللقيات لمنح نقاط بذكاء عند استعمال الطالب لنوع مُعين من المحتوى. إليك بعض الأفكار:

- ضع لقية في الإفادة على اختبار لا يُرى إلا للدرجات الكاملة.
- ضع لقية في قسم المحتوى المُعمّق لمكافأة استهلاكهم.
- ضع لقية في قسم نقاش شيق في المنتدى.
- إضع لقية في صفحة يصعب الوصول إليها ضمن وحدة الدرس.

[للمزيد من المعلومات](https://docs.levelup.plus/xp/docs/how-to/use-drops?ref=blockxp_help)';
$string['dropsintro'] = 'اللقيات هي مقتطفات برمجية توضع مباشرة في المحتوى الذي يمنح نقاطًا عند مصادفتها من قبل المستخدم.';
$string['editcondition'] = 'تحرير الشرط';
$string['editingdefaultsettingsinwholesitemodenotice'] = '**انتباه!** أنت لا تُعدّل الإعدادات النشطة حاليًا، بل تُعدّل القيم الافتراضية. بما أن نقاط خبرة الترقي تُستعمل على مستوى الموقع، فمن المرجح أنك تُريد تغيير الإعدادات على مستوى الموقع. [انتقل هنا]({$a->url}) لتغيير هذه الإعدادات، أو اتبع رابط "الإعدادات" من كتلة الترقي XP نفسها.';
$string['editinstructions'] = 'تحرير المعلومات';
$string['enablecheatguard'] = 'تمكين مانع الغش';
$string['enablecheatguard_help'] = 'يوفر مانع الغش آلية بسيطة وغير مكلفة لمنع الطلاب من إساءة استعمال النظام باستخدام أساليب بديهية، مثل تحديث الصفحة نفسها باستمرار، أو تكرار نفس الإجراء مرارًا وتكرارًا.

[للمزيد من المعلومات](https://docs.levelup.plus/xp/docs/getting-started/cheat-guard?ref=blockxp_help)';
$string['enableinfos'] = 'تمكين صفحة المعلومات';
$string['enableinfos_help'] = 'عند ضبطه على \'لا\'، لن يتمكن الطلاب من معاينة صفحة المعلومات.';
$string['enableladder'] = 'تمكين لوحة المتصدرين';
$string['enableladder_help'] = 'عند ضبطه على \'لا\'، لن يتمكن الطلاب من معاينة لوحة المتصدرين.';
$string['enablelevelupnotif'] = 'تمكين إشعار الترقي';
$string['enablelevelupnotif_help'] = 'عند ضبطه على \'نعم\'، سيتم عرض نافذة منبثقة للطلاب لتهنئتهم بالمستوى الجديد الذي وصلوه.';
$string['enablelogging'] = 'تمكين التسجيل';
$string['enablexpgain'] = 'تمكين إكتساب النقاط';
$string['enablexpgain_help'] = 'عند جعله \'لا\'، لن يحصل أحد على نقاط في المساق. هذا مفيد لتجميد الحصول على النقاط، أو لتمكينها في وقت معين.

يرجى ملاحظة أن ذلك يمكن التحكم به على مستوى أدق باستعمال الإمكانية _block/xp:earnxp_.';
$string['entersearchterm'] = 'أدخل عبارة البحث';
$string['envcheckaddonincompatibilitymessage'] = 'الملحق الترقي XP+ (local_xp) غير متوافق مع الترقي XP (block_xp). سيؤدي هذا إلى تعطيل XP+. لتجنب ذلك، يُرجى ترقية الملحقين. لمزيد من المعلومات، ترجى زيارة https://docs.levelup.plus/xp/docs/compatibility.';
$string['erroraddondeactivated'] = 'الترقي XP+ قد تم تعطيله. الرجاء مراجعة [التوثيقات]({$a->docsurl}) لمزيد من المعلومات.';
$string['errorcontextcoursemismatchforwholesite'] = 'إن رابط صفحة <em>الترقي!</em> هذه لا تتوافق مع التهيئة الحالية للملحق. التهيئة الحالية عندك تعلن بأن <em>الترقي XP</em> يُستعمل \'لكل الموقع\'، ولكن هذه الصفحة تتوقع استعماله \'حسب المساق\'. يرجى <a href="{$a->nexturl}">النقر هنا</a> للانتقال إلى الصفحة الصحيحة. إبحث عن الإعداد \'block_xp_context\' إذا أردت تغيير التهيئة الخاصة بك.';
$string['errorcontextcoursemismatchpercourse'] = 'إن رابط صفحة <em>الترقي!</em> هذه لا تتوافق مع التهيئة الحالية للإضافة. التهيئة الحالية عندك تعلن بأن <em>الترقي!</em> يُستعمل \'لكل مقرر\'، ولكن هذه الصفحة تتوقع استعماله على مستوى \'كل الموقع\'. هذا غالباً منشؤه <em>كتلة</em> أضيفت إلى لوحة التحكم أو صفحة الواجهة في أثناء تهيئة مختلفة. ينبغي عليك إزالة الكتلة من الصفحات اللاحقة، واستعمالها من داخل المقررات الدراسية الفردية فقط.';
$string['errorformvalues'] = 'هناك بعض الأخطاء في قِيَم النموذج، يرجى إصلاحها.';
$string['errorlevelsincorrect'] = 'أقل عدد من المراحل هو 2';
$string['errornotalllevelsbadgesprovided'] = 'لم يتم تزويد كل شارات المراحل. نفتقد: {$a}';
$string['errorunknownevent'] = 'خطأ: حدث مجهول';
$string['errorunknownmodule'] = 'خطأ: وحدة مجهولة';
$string['errorxprequiredlowerthanpreviouslevel'] = 'النقاط المطلوب أقل من أو تساوي المرحلة السابقة.';
$string['event_user_leveledup'] = 'مستخدم مرتبته ترقَّت';
$string['eventis'] = 'الحدث هو {$a}';
$string['eventname'] = 'اسم الحدث';
$string['eventproperty'] = 'خاصية الحدث';
$string['eventsrules'] = 'قواعد الحدث';
$string['eventsrules_help'] = 'هذ الملحق يستعمل الأحداث لمنح النقاط سمة الإجراءات التي على الطلاب القيام بها.
يمكنك استعمال النموذج أدناه لإضافة القواعد الخاصة بك وتعديل القواعد الافتراضية.

من الموصى به مراجعة صفحة وقوعات الملحق _Log_ page لمعرفة أيّ الأحداث تم تحفيزها عندما يقوم الطلاب بإجراءات في المساق.

موارد إضافية:

- [كيفية احتساب نقاط الخبرة](https://docs.levelup.plus/xp/docs/getting-started/points-calculation?ref=blockxp_help)
- [تشخيص مشاكل القواعد ](https://docs.levelup.plus/xp/docs/troubleshooting/event-rule-not-working?ref=blockxp_help)';
$string['eventsrulesintro'] = 'لاحظ الإجراءات وامنح النقاط للطلبة عندما يقومون بها.';
$string['eventtime'] = 'وقت الحدث';
$string['export'] = 'تصدير';
$string['exportdata'] = 'تصدير البيانات';
$string['filterbyuser'] = 'الترشيح حسب المستخدم';
$string['filterellipsis'] = 'ترشيح...';
$string['filtermodules'] = 'ترشيح الوحدات';
$string['filterparticipants'] = 'ترشيح المشاركين';
$string['for1day'] = 'ليوم واحد';
$string['for1month'] = 'لمدة شهر';
$string['for1week'] = 'لمدة أسبوع';
$string['for3days'] = 'لثلاثة أيام';
$string['forever'] = 'للأبد';
$string['forthewholesite'] = 'للموقع بأكمله';
$string['give'] = 'أعطِ';
$string['gotofullladder'] = 'إذهب إلى لوحة المتصدرين الكاملة';
$string['graderules'] = 'قواعد الدرجة';
$string['graderules_help'] = 'سيحصل الطلاب على نقاط مساوية لدرجاتهم.
يحصل الطالب على 5 نقاط عند حصوله على 5/10 و5/100.
عندما تتغير درجة الطالب عدة مرات، يحصل على نقاط مساوية لأعلى درجة حصل عليها.
لا تُخصم أي نقاط من الطلاب، ويتم تجاهل الدرجات السلبية.

مثال: تُسلم عشتار واجبًا، وتحصل على علامة 40/100. في _الترقي XP_، تحصل عشتار على 40 نقطة لدرجتها.
تعيد عشتار محاولة حل واجبها، ولكن هذه المرة تُخفض درجتها إلى 25/100. لا تتغير نقاطها في _الترقي XP_.
في محاولتها الأخيرة، حصلت عشتار على 60/100 نقطة، ستحصل على 20 نقطة إضافية في _الترقي XP_، ليصير مجموع نقاطها 60 نقطة.

[للمزيد، تفضل بزيارة توثيقات _الترقي XP_](https://docs.levelup.plus/xp/docs/how-to/grade-based-rewards?ref=blockxp_help)';
$string['graderulesintro'] = 'قواعد الدرجة تسمح للطلاب بتلقي نقاط مساوية للدرجات التي يحصلون عليها.';
$string['grid'] = 'الشبكة';
$string['hasbadgeaward'] = 'تم تعيين الشارة التي تُمنح';
$string['hasdescription'] = 'ضبط الوصف';
$string['hasname'] = 'تم تعيين الاسم';
$string['hasnobadgeaward'] = 'لا شارة لمنحها';
$string['hasnodescription'] = 'لا وصف';
$string['hasnoname'] = 'لا اسم';
$string['hasnopopupmessage'] = 'لا رسالة منبثقة';
$string['haspopupmessage'] = 'الرسالة المنبثقة تم تعيينها';
$string['hideparticipantsidentity'] = 'إخفاء هوية المشاركين';
$string['hiderank'] = 'إخفاء الرتبة';
$string['importpoints'] = 'استيراد النقاط';
$string['importpoints_help'] = 'يمكن استعمال عملية الاستيراد لزيادة نقاط الطلاب، أو لاستبدالها بالقيمة المُعطاة.

يرجى ملاحظة أن عملية الاستيراد __لا تستعمل__ نفس تنسيق التقرير المُصدَّر. التنسيق المطلوب موضح في [التوثيقات](https://docs.levelup.plus/xp/docs/how-to/import-points/importing-points-from-csv?ref=localxp_help)، حيث يتوفر [ملف نموذجي](https://docs.levelup.plus/xp/docs/how-to/import-points/importing-points-from-csv?ref=localxp_help#sample-file).';
$string['importpointsintro'] = 'استيراد النقاط من ملف CSV، وأرسل رسالة إلى المتلقي إختياريًا.';
$string['incourses'] = 'في المساقات';
$string['ineffective'] = 'غير فعال';
$string['infos'] = 'المعلومات';
$string['infos_help'] = 'يعطي صفحة المعلومات الطلاب نظرة عامة عن المراحل والنقاط المطلوبة للوصول إليها. إنها تعرض أيضًا اسم كل مرحلة مع وصفها.';
$string['infosintro'] = 'صفحة المعلومات تعرض قائمة المراحل مع بعض تفاصيلها.سيتم عرض التعليمات في';
$string['installed'] = 'منصب';
$string['instructions'] = 'التعليمات';
$string['instructions_help'] = 'سيتم عرض التعليمات في صفحة المعلومات. قد تستعملهما لمشاركة ما يتعلق بالمعلومات والتوجيهات الخاصة بالمراحل، كيفية اكتساب النقاط، إلخ.';
$string['invalidxp'] = 'قيمة النقاط غير صالحة';
$string['join'] = 'إنضمام';
$string['joinleadeboardconfirmnote'] = 'رائع، يسعدنا انضمامك إلينا!

يرجى العلم أنه بعد انضمامك، ستكون هناك فترة انتظار قبل أن تتمكن من مغادرة قائمة المتصدرين إذا غيرت رأيك.';
$string['joinleadeboardlockednote'] = 'لا يمكنك الانضمام إلى لوحة المتصدرين.';
$string['joinleaderboard'] = 'الانضمام إلى لوحة المتصدرين';
$string['keeplogs'] = 'الإبقاء على سجلات الوقوعات';
$string['ladder'] = 'لوحة المتصدرين';
$string['ladder_help'] = 'تُصنّف لوحة المتصدرين الطلاب بناءً على نقاطهم. عند استعمالها في مساق ذي مجموعات، يُمكنها إنشاء تصنيف لكل مجموعة طلاب.

تتوفر عدة خيارات لتخصيص لوحة المتصدرين والخبرة التي ستُقدمها للمشاركين.';
$string['ladderadditionalcols'] = 'الأعمدة الإضافية';
$string['ladderadditionalcols_help'] = 'يُحدد هذا الإعداد الأعمدة الإضافية التي ستظهر في لوحة المتصدرين. اضغط على مفتاحي CTRL أو CMD أثناء النقر لتحديد أكثر من عمود، أو لإلغاء تحديد عمود محدد.';
$string['ladderempty'] = 'لوحة المتصدرين خالية حاليًا، عاود إليها لاحقًا!';
$string['ladderintro'] = 'تُظهر لوحة المتصدرين رتب الأفراد بناء على إجمالي نقاطهم.';
$string['ladderiso'] = 'عزل المشاركين';
$string['ladderiso_help'] = 'أنشئ لوحات صدارة منفصلة لمجموعات مختلفة من المشاركين.

- الوضع الافتراضي (وضع المجموعة): يتبع وضع المجموعة في المساق لإنشاء لوحات صدارة لكل مجموعة.
- استعمال الزُمر: سيظهر أعضاء الزمرة نفسها فقط في لوحة صدارة الشخص.

[مزيد من المعلومات](https://docs.levelup.plus/xp/docs/leaderboard-isolation)';
$string['ladderisocohorts'] = 'باستعمال الزُمر';
$string['ladderisodefault'] = 'الافتراضي (وضع المجموعة)';
$string['ladderparticipation'] = 'المشاركة';
$string['ladderparticipation_help'] = 'يُحدد ما إذا كان يُتوقع من المستخدمين المشاركة في لوحة المتصدرين، أو ما إذا كان بإمكانهم الانضمام أو المغادرة حسب رغبتهم.

- تلقائي، بدون خيار إلغاء الاشتراك: ينضم كل المستخدمين إلى لوحة المتصدرين تلقائيًا ولا يمكنهم مغادرتها.
- تلقائي، خيار إلغاء الاشتراك متاح: ينضم كل المستخدمين تلقائيًا إلى لوحة المتصدرين، ولكن يمكنهم اختيار مغادرتها.
- اختياري، عن طريق الاشتراك: يجب على المستخدمين الانضمام صراحةً إلى لوحة المتصدرين للمشاركة فيها.

يمكن للمستخدمين تغيير رأيهم ومغادرة لوحة المتصدرين أو إعادة الانضمام إليها بعد الاشتراك أو إلغاء الاشتراك. مع ذلك، لمنع أي سلوك غير مقصود، لا يمكن للمستخدمين المنضمين إلى لوحة المتصدرين إلغاء الاشتراك لمدة 3 أيام.

[مزيد من المعلومات](https://docs.levelup.plus/xp/docs/leaderboard-opt-out)';
$string['ladderparticipationforced'] = 'تلقائي، بدون الاشتراك';
$string['ladderparticipationoptin'] = 'اختياري، عن طريق الاشتراك';
$string['ladderparticipationoptout'] = 'تلقائي، خيار إلغاء الاشتراك متاح';
$string['ladderparticipationreset'] = 'إزالة حالة المشاركة المسجلة من الجميع.';
$string['ladderparticipationreset_help'] = 'عند تأشيره، سيتم مسح حالة المشاركة لكل المستخدمين، وسيتعين عليهم الاشتراك أو إلغاء الاشتراك مرة أخرى.';
$string['laddersettingsmovednotice'] = 'إعدادات لوحة المتصدرين نُقلت إلى [صفحة المتصدرين]({$a->url}).';
$string['learnmore'] = 'معرفة المزيد';
$string['leave'] = 'مغادرة';
$string['leaveleadeboardconfirmnote'] = 'هل أنت متأكد من رغبتك في مغادرة لوحة المتصدرين؟

بمجرد مغادرتك، تخسر وصولك إلى الترتيب ولكن بإمكانك دومًا إعادة الانضمام لاحقًا إذا غيرت رأيك.';
$string['leaveleadeboardlockednote'] = 'لا يمكنك مغادرة لوحة المتصدرين.';
$string['leaveleadeboardlockeduntilnote'] = 'لا يمكنك مغادرة لوحة المتصدرين حتى {$a}.';
$string['leaveleaderboard'] = 'مغادرة لوحة المتصدرين';
$string['level'] = 'المرحلة';
$string['levelbadge'] = 'شارة المرحلة';
$string['levelbadges'] = 'شارات المرحلة';
$string['levelbadges_help'] = 'إرفع صورًا لاستبدال مظهر المراحل الفردية.

ينبغي تسمية الملفات بـ [level].[file extension]، على سبيل المثال 1.png، 2.jpg، إلخ.

نوصي باستعمال صور بحجم 100×100 بكسل، بأي من الصيغ التالية: GIF، JPEG، PNG، وSVG.';
$string['levelbadgesformhelp'] = 'تسمية الملفات [level].[file extension]، على سبيل المثال: 1.png,،2.jpg، إلخ... حجم الصورة الموصى به هو 100 × 100.';
$string['levelcount'] = 'عدد المرحلة';
$string['leveldesc'] = 'وصف المستوى';
$string['leveldesc_help'] = 'وصف موجز للمرحلة، يُعرض في صفحة المعلومات بجانب المرحلة نفسها. يمكنك استعماله لوصف المكافأة الممنوحة للمتعلمين الذين يصلون إليها، أو لإضافة تعليمات حول كيفية التقدم إليها، أو لوصف المرحلة بأسلوب مرح (مثل: _من المعروف أن أشجع النفوس فقط هي التي تصل إلى هذا المستوى_)، إلخ.';
$string['leveldescriptiondesc'] = 'وصف موجز للمرحلة، يُعرض للطلاب في صفحة المعلومات.';
$string['levelname'] = 'اسم المرحلة';
$string['levelname_help'] = 'اسم مختصر يُعرض بدلاً من التسميات الافتراضية _المرحلة #1_، _المرحلة #2_، إلخ. التي يجري عرضها أحيانًا. إذا أعطيت بعض المراحل اسمًا، نوصي أن تعطي أسماءً لكل واحدة منها!';
$string['levelpointslength'] = 'الطول';
$string['levelpointsstart'] = 'إبدأ';
$string['levels'] = 'المراحل';
$string['levelsappearance'] = 'مظهر المراحل';
$string['levelssaved'] = 'تم حفظ المراحل.';
$string['levelswillbereset'] = 'تحذير! حفظ هذا النموذج سيعيد إحتساب المراحل للجميع!';
$string['levelup'] = 'الترقي!';
$string['levelupoptionsunavailableforlevelone'] = 'الخيارات المتعلقة بالوصول إلى المراحل غير متاحة بالنسبة إلى المرحلة الأولى.';
$string['levelupplus'] = 'الترقي XP+';
$string['levelx'] = 'المرحلة #{$a}';
$string['likenotice'] = 'هل تستمتع بالترقي XP؟ رجاء، خصص دقيقة من وقتك لـ <a href="{$a->moodleorg}" target="_blank">إضافته إلى مفضلاتك</a> من ملاحق Moodle.org.';
$string['limitparticipants'] = 'تحديد عدد المشاركين';
$string['limitparticipants_help'] = 'يتحكم هذا الإعداد بمن يظهر في لوحة المتصدرين. الجيران هم المشاركون الذين يقع ترتيبهم أعلى أو أدنى من المستخدم الحالي. على سبيل المثال، عند اختيار "عرض جارين"، سيتم عرض المشاركين اللذين يقع ترتيبهما أعلى أو أدنى مباشرةً من المستخدم الحالي فقط.';
$string['list'] = 'القائمة';
$string['logging'] = 'التسجيل';
$string['manually'] = 'يدويًا';
$string['maxactionspertime'] = 'أقصى عدد من الإجراءات ضمن الإطار الزمني';
$string['maxactionspertime_help'] = 'العدد الأقصى من الإجراءات التي ستحتسب لها نقاط خلال الإطار الزمني المعطى. سيتم تجاهل أي إجراءات لاحقة. عندما تكون هذه القيمة خالية أو مساوية لصفر، لن تؤخذ بعين الاعتبار.';
$string['maxlevelexcl'] = 'أعلى مرحلة!';
$string['menu'] = 'القائمة';
$string['messageprovider:adminnotice'] = 'ملاحظة المشرف';
$string['missing'] = 'مفقود';
$string['movecondition'] = 'نقل الشرط';
$string['moverule'] = 'نقل القاعدة';
$string['name'] = 'الاسم';
$string['namecontains'] = 'يحتوي على "{$a}"';
$string['nameequalsto'] = 'مساوٍ إلى "{$a}"';
$string['navbardisplay'] = 'الإظهار في شريط التنقل';
$string['navbardisplay_desc'] = 'عند تمكينه، سيظهر مستوى المستخدم في شريط التنقل العلوي. إذا تم استعمال الملحق "لكل مساق"، فسيظهر فقط في المساقات. يُرجى ملاحظة أن هذه الميزة تعتمد بشكل كبير على المظهر، وقد لا تعمل بشكل جيد، أو قد لا تعمل على الإطلاق، مع مظاهر الجهات الخارجية. [للمزيد من المعلومات](https://docs.levelup.plus/xp/docs/navbar-display)';
$string['navcompletionrules'] = 'الإكمال';
$string['navdrops'] = 'اللقيات';
$string['naveventrules'] = 'قواعد الأحداث';
$string['navgraderules'] = 'قواعد الدرجات';
$string['navimport'] = 'استيراد';
$string['navinfos'] = 'معلومات';
$string['navladder'] = 'لوحة المتصدرين';
$string['navlevels'] = 'المراحل';
$string['navlevelssetup'] = 'التهيئة';
$string['navlog'] = 'السجل';
$string['navpoints'] = 'النقاط';
$string['navpromo'] = 'XP+';
$string['navreport'] = 'التقرير';
$string['navrules'] = 'القواعد';
$string['navsettings'] = 'الإعدادات';
$string['navvisuals'] = 'المظهر';
$string['newversioninstallednotice'] = 'تم تنصيب إصدار جديد! إكتشف ما الجديد في [ملاحظات الإصدار]({$a->releasenotesurl}).';
$string['nextlevelin'] = 'المرحلة القادمة بعد';
$string['noconditionsyet'] = 'لا شروط بعد!';
$string['noconditionsyetintro'] = 'إبدأ من خلال إضافة الشرط.';
$string['nodescription'] = 'بلا وصف';
$string['noissuesidentified'] = 'لم يتم الكشف عن اي مشاكل';
$string['nologsrecordedyet'] = 'لم يتم توثيق سجلات الوقوعات بعد.';
$string['noname'] = 'بلا اسم';
$string['noneareavailable'] = 'ولا أي منها متاح';
$string['notecompatibilityissues'] = 'ترجى ملاحظة مشاكل التوافق المبينة أدناه:';
$string['notesomesettingslocked'] = 'لاحظ بأن بعض الإعدادات قد لا تكون قابلة للتحرير عندما يتم تأمينها من قبل المشرف.';
$string['nothingmatchesfilter'] = 'لا شيء يطابق المرشح';
$string['notparticipating'] = 'غير مشارك';
$string['notranked'] = 'غير مرتب';
$string['numberoflevels'] = 'عدد المراحل';
$string['occasionally'] = 'أحيانًا';
$string['onlyparticipantscanaccessranking'] = 'المشاركون في لوحة المتصدرين وحدهم يمكنهم الوصول إلى الترتيب.';
$string['outofsync'] = 'عدم توافق ملاحق XP';
$string['outofsyncexcessive'] = 'خارج التزامن بشكل كبير';
$string['outofsyncexcessiveinfo'] = 'إن XP+ أقدم بكثير من XP مما قد يؤدي إلى مشاكل غير متوقعة. مستقبلاً، سيقوم XP+ بتعطيل نفسه تلقائيًا.';
$string['outofsyncinfo'] = 'إن ملاحق XP غير متوافقة فيما بينها مما قد يؤدي إلى مشاكل غير متوقعة. مستقبلاً، سيقوم XP+ بتعطيل نفسه تلقائيًا. الإصدار {$a->localxpversion} من الترقي XP+ (local_xp) هو المتوقع.';
$string['pagecurrentnotvisibletoviewers'] = 'هذه الصفحة ليست ظاهرة للطلاب حاليًا.';
$string['pagecurrentvisibletoviewers'] = 'هذه الصفحة ظاهرة للطلاب حاليًا.';
$string['pagesettings'] = 'إعدادات الصفحة';
$string['participant'] = 'المشارك';
$string['participants'] = 'المشاركون';
$string['participatesinleaderboard'] = 'المشاركون في لوحة المتصدرين.';
$string['participatesnotinleaderboard'] = 'لا يشارك في لوحة المتصدرين.';
$string['participatetolevelup'] = 'شارك في المساق لتكتسب نقاط الخبرة وترتقي سلم التعلم!';
$string['participating'] = 'يشارك';
$string['perpagecolon'] = 'لكل صفحة:';
$string['pickaconditiontype'] = 'إختر نوع الشرط';
$string['pluginavailabilityxpdesc'] = 'هذا الملحق يسمح للمرشدين بتقيد الوصول إلى النشاطات بناء على مراحل الطلاب.';
$string['pluginenrolxpdesc'] = 'هذا الملحق يتيح الانضمام التلقائي إلى المساقات بناءً على مرحلة الطالب في مساق آخر.';
$string['pluginname'] = 'الترقي XP';
$string['pluginshortcodesdesc'] = 'هذا الملحق يسمح للمرشدين بتخصيص موادهم عبر تضمين عناصر ذات صلة بـ XP (نقاط، مراحل، لوحة المتصدرين، ...) في المحتوى التعليمي، فضلاً عن إخفاء المحتوى أو إظهاره بناءً على مرحلة الطالب.';
$string['pluginsoutofsync'] = '__عدم توافق ملاحق XP!__

هناك مشاكل في التوافق ما بين الترقي XP و الترقي XP+. مستقبلاً، سيقوم الترقي XP+ بتعطيل نفسه تلقائيًا إذا لم يكن متوافقًا. لمنع حدوث ذلك، يرجى التواصل مع مشرف الموقع. [إقرأ المزيد]({$a->url})';
$string['pluginxmaybeincompatible'] = 'هذا الإصدار {$a->name} ({$a->component}) قد لا يكون متوافقًا مع مودل {$a->version}.';
$string['pointsintimelinker'] = 'لكل';
$string['pointsperlevel'] = 'النقاط لكل مرحلة';
$string['pointsrequired'] = 'النقاط المطلوبة';
$string['pointstoaward'] = 'النقاط التي تُمنح';
$string['pointstoaward_help'] = 'عدد النقاط التي تُمنح عند تلبية الشرط.';
$string['popupnotificationmessage'] = 'رسالة الإشعار المنبثقة';
$string['popupnotificationmessagedesc'] = 'رسالة إختيارية تُعرض ضمن الإشعار المنبثق تهنئ المستخدم لإحرازه المرحلة.';
$string['potentialmoodleincompatibility'] = 'إحتمالية عدم التوافق مع مودل';
$string['previewpopupnotification'] = 'استعراض الإشعار';
$string['privacy:metadata:log'] = 'يخزن سجل وقوعات الأحداث';
$string['privacy:metadata:log:eventname'] = 'اسم الحدث';
$string['privacy:metadata:log:time'] = 'التاريخ التي وقعت فيه';
$string['privacy:metadata:log:userid'] = 'المستخدم الذي اكتسب النقاط';
$string['privacy:metadata:log:xp'] = 'النقاط التي مُنحت للحدث';
$string['privacy:metadata:prefintro'] = 'يسجل ما إذا قام المستخدم بصرف مقدمة الكتلة';
$string['privacy:metadata:prefladderpagesize'] = 'حجم الصفحة المفضل للمستخدم عند معاينة لوحة المتصدرين';
$string['privacy:metadata:preflevelup'] = 'يسجل ما إذا كان ينبغي للمستخدم مشاهدة إشعار الترقي';
$string['privacy:metadata:prefnotices'] = 'يسجل ما إذا قام المستخدم بإغلاق ملاحظة الدعم';
$string['privacy:metadata:prefseenpromo'] = 'يسجل ما إذا قام المستخدم بمعاينة صفحة الترويج';
$string['privacy:metadata:xp'] = 'يخزن نقاط المستخدمين ومراحلهم';
$string['privacy:metadata:xp:lvl'] = 'مرحلة المستخدم';
$string['privacy:metadata:xp:userid'] = 'المستخدم';
$string['privacy:metadata:xp:xp'] = 'نقاط المستخدم';
$string['privacy:path:addon'] = 'الملحق';
$string['privacy:path:level'] = 'المرحلة';
$string['privacy:path:logs'] = 'سجلات الوقوعات';
$string['progress'] = 'التقدم';
$string['progressbar'] = 'شريط التقدم';
$string['promocheatguard'] = 'إن مانع الغش هذا غير مصمم لتغطية نطاقات زمنية طويلة. يرجى الأخذ بنظر الاعتبار الترقية إلى <em>الترقي XP+</em> لتوفير العدم لنطاقات زمنية طويلة مع ميزات أخرى. <a href="{$a->url}">أقرأ المزيد هنا</a>.';
$string['promocontactintro'] = 'إتصل بنا لمزيد من المعلومات. ستجدنا في غاية التعاون وسريعين في الاستجابة!';
$string['promocontactus'] = 'كن على اتصال';
$string['promoemailusat'] = 'راسلنا على _levelup@branchup.tech_.';
$string['promoerrorsendingemail'] = 'عجبًا! لم نتمكن من إرسال الرسالة... نرجو أن تراسلنا بالبريد الالكتروني مباشرة على: {$a}. شكرًا!';
$string['promogetnow'] = 'إحصل على XP+ الآن!';
$string['promoifpreferemailusat'] = 'إذا كنت تفضل ذلك، راسلنا مباشرة على _{$a}_.';
$string['promointro'] = 'كن سيد اللعبة! أطلق الميزات الإضافية وارتق مع تحويل التعلم إلى متعة نحو مرتبة جديدة تمامًا باستعمال الترقي XP+!';
$string['promointroinstalled'] = 'تم تنصيب ملحق _الترقي XP+_ في نظامك وتم تمكين كل ميزاته.';
$string['promorulesdidyouknow'] = 'هل كنت تعلم بأنه مع <em>الترقي XP+</em> يمكن للطلاب إكتساب النقاط <em>لإكمالهم للمساقات</em> و <em>النشاطات</em>، أو حتى تلقي النقاط التي تُسجل في <em>تقديراتهم</em>? <a href="{$a->url}">إكتشف المزيد هنا</a>.';
$string['promoyourmessagewassent'] = 'شكرًا لك، رسالتك قد أُرسلت. سنتصل بك قريبًا.';
$string['property:action'] = 'إجراء الحدث';
$string['property:component'] = 'مكون الحدث';
$string['property:crud'] = 'CRUD الحدث';
$string['property:eventname'] = 'اسم الحدث';
$string['property:target'] = 'مقصد الحدث';
$string['provisionstates'] = 'التزويد التلقائي للمستخدم';
$string['provisionstates_desc'] = 'افتراضيًا، لا يظهر المستخدمون في لوحة المتصدرين (وفي التقرير في وضع عموم الموقع) إلا بعد اكتشافهم بواسطة XP. يُعدّ توفير المستخدمين ميزة متقدمة تُنشئ تلقائيًا إدخالات للمستخدمين المفقودين الذين يتم تحديدهم بشكل غير دقيق من خلال أدوارهم. يتم ذلك دوريًا عبر مهمة مجدولة تُفعّل يوميًا افتراضيًا.  [للمزيد من المعلومات](https://docs.levelup.plus/xp/docs/automatic-user-provisioning)';
$string['questpromonotice'] = 'ارتق مع تحويل التعلم إلى متعة نحو المرتبة التالية، إكتشف [مهمة الترقي]({$a->questurl}).';
$string['questreleasenotice'] = 'ارتق مع تحويل التعلم إلى متعة نحو المرتبة التالية، إكتشف **مهمة الترقي** 🥳. حول مساقاتك إلى **مغامرات مثيرة**، مفعمة **بالاستراتيجيات المشوقة** و **الاحتفالات** 🤯! أنظر [موقع المهام]({$a->questurl}) و [أطلق المنشور هنا]({$a->questblogurl}) الخاص بنا. 👈';
$string['quickeditpoints'] = 'التحرير السريع للنقاط';
$string['rank'] = 'الرتبة';
$string['ranked'] = 'مرتب';
$string['ranking'] = 'الترتيب';
$string['ranking_help'] = 'الرتبة هي الموقع المطلق للمستخدم الحالي في لوحة المتصدرين. الرتبة النسبية هي الفرق في نقاط الخبرة ما بين المستخدم وجيرانه.';
$string['reallydeleteuserstate'] = 'Deleting a user is only useful to remove them from the leaderboard. For any other reasons, we recommend setting their points to 0 instead. Note that deleting them does not affect their ability to earn points in the future.

Importantly, when using _Level Up XP_ sitewide, deleting them will make them disappear from the report, in which case you will not be able to re-assign them points. However, if you are using _Level Up XP_ per course, the student may still appear in the report if they are enrolled in the course.

Do you really want to delete the points of this user?';
$string['reallydeleteuserstateandlogs'] = 'يؤدي حذف مستخدم إلى إزالته من لوحة المتصدرين وإزالة جميع سجلاته المرتبطة.

قد تُمكّن إزالة السجلات المستخدم من استعادة نقاطه من الإجراءات السابقة. إذا كنت تنوي فقط إعادة تعيين نقاطه، فنوصي بضبط نقاطه على 0. يُرجى العلم أن حذف المستخدم لا يؤثر على قدرته على اكتساب النقاط مستقبلًا.

من المهم، عند استخدام _الترقي XP_ على مستوى الموقع، سيؤدي حذفه إلى اختفائه من التقرير، وفي هذه الحالة لن تتمكن من إعادة تعيين نقاطه. مع ذلك، إذا كنت تستعمل _الترقي XP_ لكل مساق، فقد يظل الطالب ظاهرًا في التقرير إذا كان مسجلاً في المساق.

هل تريد حقًا حذف نقاط وسجلات هذا المستخدم؟';
$string['reallyresetallcourselevelstodefaults'] = 'هل أنت متأكد من رغبتك في إعادة تعيين المراحل في كل المساقات إلى المراحل الافتراضية؟ هذا الإجراء غير قابل للتراجع.';
$string['reallyresetallcoursestodefaults'] = 'هل أنت متأكد من رغبتك في إعادة تعيين القواعد في كل المساقات إلى القواعد الافتراضية؟ هذا الإجراء غير قابل للتراجع.';
$string['reallyresetallcoursevisualstodefaults'] = 'هل أنت متأكد من رغبتك في إعادة تعيين مظهر المراحل في كل المساقات إلى المظهر الافتراضي؟ هذا الإجراء غير قابل للتراجع.';
$string['reallyresetcourselevelstodefaults'] = 'هل أنت متأكد من رغبتك في إعادة تعيين المراحل إلى المراحل الافتراضية؟ هذا الإجراء غير قابل للتراجع.';
$string['reallyresetcourserulestodefaults'] = 'هل أنت متأكد من رغبتك في إعادة تعيين القواعد إلى القواعد الافتراضية؟ هذا الإجراء غير قابل للتراجع.';
$string['reallyresetcoursevisualstodefaults'] = 'هل أنت متأكد من رغبتك في إعادة تعيين مظهر المراحل إلى المظهر الافتراضي؟ هذا الإجراء غير قابل للتراجع.';
$string['reallyresetdata'] = 'هل أنت متأكد من رغبتك في إعادة تعيين المراحل والنقاط لكل من في هذا المساق؟ هذا الإجراء غير قابل للتراجع.';
$string['reallyresetgroupdata'] = 'هل فعلاً تريد إعادة تعيين المراحل والنقاط لكل من في هذه المجموعة؟';
$string['reallyreverttopluginsdefaults'] = 'هل فعلاً تريد إعادة تعيين القواعد إلى الوضع الافتراضي الذي يقترحه الملحق؟ هذا الإجراء غير قابل للتراجع.';
$string['recentrewards'] = 'المكافآت الأخيرة';
$string['recommended'] = 'موصى به';
$string['recommendedplugins'] = 'الملاحق موصى بها';
$string['releasenotes'] = 'ملاحظات الإصدار';
$string['remaining'] = 'المتبقي';
$string['removefilter'] = 'إزالة المرشح';
$string['reportisempty'] = 'التقرير فارغ، لا يزال أمام الطالب إكتساب النقاط.';
$string['reportisemptyenrolstudents'] = 'التقرير فارغ، هل تم ضم الطلاب إلى هذا المساق؟';
$string['requires'] = 'يتطلب';
$string['resetallcoursestodefaults'] = 'إعادة تعيين كل المساقات إلى الافتراضي';
$string['resetallcoursestodefaultsintro'] = 'أنقر الزر أدناه لإعادة تعيين كل المساقات إلى الافتراضيات أعلاه.';
$string['resetcoursedata'] = 'إعادة تعيين بيانات المساق';
$string['resetcourserulestodefaults'] = 'إعادة تعيين قواعد المساق إلى الافتراضي';
$string['resetgroupdata'] = 'إعادة تعيين بيانات المجموعة';
$string['resetladderparticiptionofeveryone'] = 'إعادة تعيين حالة المشاركة للجميع';
$string['resetlevelstodefaults'] = 'إعادة تعيين المراحل إلى الافتراضي';
$string['resettodefaults'] = 'إعادة التعيين إلى الافتراضي';
$string['resetvisualstodefaults'] = 'إعادة تعيين المظهر إلى الافتراضي';
$string['resultsfilteredforn'] = 'النتائج المرشحة لـ {$a}.';
$string['reverttopluginsdefaults'] = 'الرجوع إلى افتراضيات الملحق';
$string['reverttopluginsdefaultsintro'] = 'استعمل الزر أدناه إذا أردت إرجاع التفاصيل أعلاه إلى افتراضيات الملحق. هذا لا يؤثر على القواعد التي في المساقات الموجودة.';
$string['reward'] = 'المكافأة';
$string['rule'] = 'القاعدة';
$string['rule:contains'] = 'تحتوي';
$string['rule:eq'] = 'يساوي';
$string['rule:eqs'] = 'يساوي بالضبط';
$string['rule:gt'] = 'أكبر من';
$string['rule:gte'] = 'أكبر من أو يساوي';
$string['rule:lt'] = 'أقل من';
$string['rule:lte'] = 'أقل من أو يساوي';
$string['rule:regex'] = 'يطابق التعبير الاعتيادي';
$string['ruleadded'] = 'تمت إضافة الشرط';
$string['rulecm'] = 'النشاط أو المورد';
$string['rulecm_help'] = 'يتحقق هذا الشرط عند وقوع الحدث في النشاط أو المورد المحددين.';
$string['rulecmdesc'] = 'النشاط أو المورد هو \'{$a->contextname}\'.';
$string['rulecmdescwithcourse'] = 'النشاط أو المورد هو \'{$a->contextname}\' في \'{$a->coursename}\'.';
$string['rulecminfo'] = 'يتطلب هذا الشرط وقوع الإجراء في النشاط أو المورد المعينين.';
$string['ruleevent'] = 'حدث مُعيَّن';
$string['ruleeventdesc'] = 'الحدث هو \'{$a->eventname}\'';
$string['ruleeventinfo'] = 'إختر الإجراء الذي على المستخدمين القيام به من بين قائمة من الأحداث المنسقة.';
$string['rulefilterany'] = 'أي';
$string['rulefilteranycm'] = 'أي نشاط';
$string['rulefilteranycmdesc'] = 'هذا الشرط سيتطابق مع أي نشاط.';
$string['rulefilteranycourse'] = 'أي مساق';
$string['rulefilteranycoursedesc'] = 'هذا الشرط سيتطابق مع أي مساق.';
$string['rulefilteranydesc'] = 'هذا الشرط يتطابق مع أي شيء.';
$string['rulefilteranysection'] = 'أي مقطع';
$string['rulefilteranysectiondesc'] = 'هذا الشرط سيتطابق مع أي مقطع.';
$string['rulefiltercm'] = 'نشاط معين';
$string['rulefiltercmdesc'] = 'استهدف نشاطًا أو موردًا معينًا في المساق.';
$string['rulefiltercmname'] = 'اسم النشاط';
$string['rulefiltercmnamedesc'] = 'الشرط المبني على اسم النشاط.';
$string['rulefilternone'] = 'لا شيء';
$string['rulefiltersection'] = 'مقطع معين';
$string['rulefiltersectiondesc'] = 'استهدف مقطعًا معينًا في المساق.';
$string['rulefilterthiscourse'] = 'هذا المساق';
$string['rulefilterthiscoursedesc'] = 'استهدف المساق الحالي.';
$string['ruleproperty'] = 'خاصية الحدث';
$string['rulepropertydesc'] = 'الخاصية \'{$a->property}\' {$a->compare} \'{$a->value}\'.';
$string['rulepropertyinfo'] = 'هذا الشرط هو للمستخدمين المتمكنين الذين لديهم فهم للأحداث وخصائصها.';
$string['ruleset'] = 'مجموعة الشروط';
$string['ruleset:all'] = 'كل الشروط منطبقة';
$string['ruleset:any'] = 'أي من الشروط منطبقة';
$string['ruleset:none'] = 'لا أي من الشروط منطبق';
$string['rulesetinfo'] = 'دمج عدة شروط في شرط واحد.';
$string['rulesformhelp'] = '<p>يستغل هذا الملحق الأحداث لنسب نقاط إلى الإجراءات التي يقوم بها الطلاب. يمكنك استعمال النموذج أدناه لإضافة قواعدك الخاصة وعرض القواعد الافتراضية.</p>
<p>يُنصح بالتحقق من <a href="{$a->log}">سجل وقوعات</a> الملحق لتحديد الأحداث التي يتم تشغيلها أثناء تنفيذك للإجراءات في المساق، وللاطلاع على المزيد حول الأحداث نفسها: <a href="{$a->list}">قائمة بكل الأحداث</a>، <a href="{$a->doc}">توثيقات المطور</a>.</p>
<p>أخيرًا، يُرجى ملاحظة أن الملحق يتجاهل دائمًا ما يلي:
<ul>
<li>الإجراءات التي يقوم بها المشرفون أو الضيوف أو المستخدمون غير المسجلين لدخولهم.</li>
<li>الإجراءات التي يقوم بها المستخدمون الذين لا يملكون إمكانية <em>block/xp:earnxp</em>.</li>
<li>الإجراءات المتكررة خلال فترة زمنية قصيرة، لمنع الغش.</li>
<li>الأحداث التي تم وضع علامة عليها على أنها <em>مجهولة</em>، على سبيل المثال في ملاحظات مجهولة المصدر.</li>
<li>وأحداث المستوى التعليمي التي لا ترقى إلى مستوى <em>المشاركة</em>.</li>
</ul>
</p>';
$string['rulesscope'] = 'المدى';
$string['rulesscope_help'] = 'يُحدد نطاق القواعد متى يتم تطبيقها.

يمكن إنشاء القواعد في نطاقين: على مستوى الموقع وعلى مستوى المساق. كلما أمكن، تُقيّم القواعد الخاصة بالمساق أولاً، ثم تُقيّم القواعد على مستوى الموقع. يُمكّن هذا النهج المُعلمين من إنشاء قواعد عامة قابلة للتطبيق على مستوى الموقع، ثم تعديلها لكل مساق على حدة.

- على مستوى الموقع: تُطبق هذه القواعد على مستوى الموقع بأكمله، باستثناء القواعد الخاصة بالمساق.
- المساق: تُطبق هذه القواعد ضمن مساق مُحدد فقط، ولها الأولوية على القواعد التي على مستوى الموقع.';
$string['ruletypecmcompletion'] = 'إكمال النشاط';
$string['ruletypecmcompletiondesc'] = 'يمنح نقاطًا عند وضع علامة الإكمال على نشاط ما.';
$string['ruletypecoursecompletion'] = 'إكمال المساق';
$string['ruletypecoursecompletiondesc'] = 'يمنح نقاطًا عند وضع علامة الإكمال على مساق ما.';
$string['ruletypesectioncompletion'] = 'إكمال المقطع';
$string['ruletypesectioncompletiondesc'] = 'يمنح نقاطًا عند وضع علامة الإكمال على مقطع ما.';
$string['searchandselectcourse'] = 'البحث عن المساق وتحديده';
$string['searchandselectmodule'] = 'البحث عن النشاط أو المورد وتحديده';
$string['selectcourse'] = 'إختر المساق';
$string['send'] = 'إرسال';
$string['setpoints'] = 'ضع النقاط';
$string['settingsoutdatedxppnotice'] = 'إذا كنت تشاهد الإعدادات أدناه، فهذا معناه أن لديك نسخة قديمة من XP+ منصبة. يرجى الطلب من مشرفك بحل هذه المشكلة عبر تنصيب الإصدارات الأخيرة.';
$string['shortcode:xpbadge'] = 'الشارة المطابقة للمرحلة الحالية للمستخدم.';
$string['shortcode:xpiflevel'] = 'عرض المحتوى عندما يتطابق مع المرحلة الحالية للمستخدم.';
$string['shortcode:xpiflevel_help'] = 'إرجع إلى الأمثلة أدناه لتنسيق هذا الرمز المختصر. عند تحديد المستوى بشكل صارم، سيتم عرض المحتوى بغض النظر عن القواعد الأخرى.
ينبغي أن تتطابق The _greater_ and _less than_ rules جميعاً ليتم عرض المحتوى. تنبه لأن ذلك قد يؤدي أحياناً إلى عدم عرض أي محتوى!
لاحظ أن المعلمين، أو سواهم من المستخدمين الذين لهم إمكانية التحرير، سيشاهدون كل شيء دائماً.

```
[xpiflevel 1 3 5]
    تُعرض إذا كان مستوى المستخدم بالضبط 1، 3 أو 5.
[/xpiflevel]

[xpiflevel >3]
    تُعرض إذا كان مستوى المستخدم أكبر من 3.
[/xpiflevel]

[xpiflevel >=3]
    تُعرض إذا كان مستوى المستخدم أكبر من أو مساوياً 3.
[/xpiflevel]

[xpiflevel >=10 <20 30]
    تُعرض إذا كان مستوى المستخدم أكبر من أو مساوياً 10 وحصراً أقل من 20
    أو إذا كان مساوياً بالضبط 30.
[/xpiflevel]

[xpiflevel <=10 >=20]
    لا تُعرَض مطلقاً لأن مستوى المستخدم لا يمكن أبداً أن يكون أقل من أو مساوياً 10 وأكثر من أو مساوياً 20.
[/xpiflevel]
```

لاحظ أن تلك الرموز المختصرة لا يمكن جعلها متداخلة بعضها مع البعض الآخر.';
$string['shortcode:xpladder'] = 'عرض جزء من لوحة المتصدرين';
$string['shortcode:xpladder_help'] = 'افتراضيًا، سيتم عرض جزء من لوحة المتصدرين المحيطة بالمستخدم الحالي.

```
[xpladder]
```

لعرض أفضل 10 طلاب بدلاً من جيران المستخدم الحالي، اضبط العامل `top`. يمكنك اختياريًا تحديد عدد المستخدمين المراد عرضهم، مثل `top=20`.

```
[xpladder top]
[xpladder top=15]
```

سيتم عرض رابط لوحة المتصدرين بالكامل تلقائيًا أسفل الجدول. إذا كنت لا ترغب في عرض هذا الرابط، فأضف الوسيطة `hidelink`.

```
[xpladder hidelink]
```

افتراضيًا، لا يتضمن الجدول عمود التقدم الذي يعرض شريط التقدم. إذا تم تحديد هذا العمود في الأعمدة الإضافية في إعدادات لوحة المتصدرين، يمكنك استعمال الوسيطة `withprogress` لعرضه.

```
[xpladder withprogress]
```

لاحظ أنه عند استعمال المجموعات في المساق، ستُخمن لوحة المتصدرين المجموعة التي سيتم عرض لوحة المتصدرين الخاصة بها بشكل أفضل.';
$string['shortcode:xplevelname'] = 'عرض اسم المرحلة.';
$string['shortcode:xplevelname_help'] = 'يعرض الوسم افتراضيًا اسم مستوى المستخدم الحالي.

كبديل، يمكنك استعمال الوسيطة `level` لعرض اسم مستوى محدد.

```
[xplevelname]
[xplevelname level=5]
```

إذا تم توفير الوسيطة `level` ولم يكن المستوى موجودًا، فلن يتم عرض أي شيء.';
$string['shortcode:xppoints'] = 'عرض عدد من النقاط بتنسيق نقاط الخبرة.';
$string['shortcode:xppoints_help'] = 'افتراضيًا، يعرض هذا عدد نقاط المستخدم الحالي. يمكنك أيضًا تحديد رقم لتجاوز هذه القيمة.

يعتمد تنسيق النقاط على ما إذا كانت قيمة عشوائية معروضة أم نقاط المستخدم الحالي. يمكن استعمال الوسيطة `plain` لإزالة أي تنسيق.

```
[xppoints]
[xppoints 500]
[xppoints 123 plain]
```';
$string['shortcode:xpprogressbar'] = 'شريط التقدم الحالي للمستخدم نحو المرحلة التالية.';
$string['sitewide'] = 'عموم الموقع';
$string['somefeaturesrequireotherplugins'] = 'تتطلب بعض الميزات تنصيب ملاحظ إضافية.';
$string['someoneelse'] = 'شخص آخر';
$string['somethinghappened'] = 'حدث شيء ما';
$string['taskadminnotices'] = 'تنبيهات المشرف';
$string['taskcollectionloggerpurge'] = 'تطهير سجلات وقوعات المجموعة';
$string['taskstateprovisioner'] = 'موفر الحالة';
$string['taskusagereport'] = 'تقرير الاستعمال';
$string['teamleaderboard'] = 'لوحة صدارة الفِرق';
$string['teamleaderboard_help'] = 'تُظهر لوحة صدارة الفرق ترتيبها بناءً على إجمالي النقاط المتراكمة لأعضائها.

يمكن تشكيل الفِرق من مجموعات المساقات أو الزُمر. كما تتوفر خيارات لتناسب أحجام الفِرق المختلفة.

[للمزيد من المعلومات](https://docs.levelup.plus/xp/docs/how-to/setup-team-leaderboard/team-leaderboard?ref=blockxp_help)';
$string['teamleaderboardintro'] = 'لوحة صدارة الفِرق هي مرتبة الفِرق بناءً على نقاط أعضائها';
$string['teams'] = 'الفِرق';
$string['thankyou'] = 'شكرًا لكم!';
$string['timebetweensameactions'] = 'الوقت المطلوب ما بين الإجراءات المتطابقة';
$string['timebetweensameactions_help'] = 'الوقت الأدنى المطلوب قبل قبول الإجراء الذي سبق حدوثه مرة أخرى. يُعتبر الإجراء متطابق إذا وُضع في نفس السياق وعلى نفس المكون، فقراءة منشور المنتدى سيعتبر متطابق مع قراءة لاحقة تجري لنفس المنشور مرة أخرى. عندما تكون هذه القيمة خالية أو مساوية لصفر، لن تؤخذ بعين الاعتبار.';
$string['timeformaxactions'] = 'الإطار الزمني لأقصى عدد من الإجراءات';
$string['timeformaxactions_help'] = 'الفترة الزمنية (بالثواني) التي ينبغي على المستخدم خلالها أن تتجاوز إجراءاته عددًا معينًا كحد أقصى.';
$string['tinytimedays'] = '{$a}ي';
$string['tinytimehours'] = '{$a}س';
$string['tinytimeminutes'] = '{$a}د';
$string['tinytimenow'] = 'الآن';
$string['tinytimeolderyearformat'] = '%b %Y';
$string['tinytimeseconds'] = '{$a}ث';
$string['tinytimeweeks'] = '{$a}أس';
$string['tinytimewithinayearformat'] = '%b %e';
$string['total'] = 'الإجمالي';
$string['tryme'] = 'جربني';
$string['unavailable'] = 'غير متاح';
$string['unknownactivitya'] = 'نشاط مجهول ({$a})';
$string['unknownbadgea'] = 'شارة مجهولة ({$a})';
$string['unknownconditiona'] = 'شرط مجهول ({$a})';
$string['unknowneventa'] = 'حدث مجهول ({$a})';
$string['unknownsectiona'] = 'مقطع مجهول ({$a})';
$string['unknowntypea'] = 'نوع مجهول ({$a})';
$string['unlockfeaturewithxpplus'] = 'أطلق هذه الميزة مع XP+. <a href="{$a}">لمعرفة المزيد</a>';
$string['unstableversioninstalled'] = 'النسخة المنصبة غير مستقرة';
$string['unstableversioninstalledinfo'] = 'هذا الإصدار من الترقي XP (block_xp) لا يزال في مورحلة التطوير ويُعتبر غير مستقر، يرجى استعمال الإصدار الرسمي.';
$string['updateandpreview'] = 'تحديث واستعراض';
$string['upgradingplugins'] = 'ترقية الملاحق';
$string['urlaccessdeprecated'] = 'الوصول عبر الرابط تم إهماله، يرجى تحديث روابطك.';
$string['usagereport'] = 'مشاركة تقرير الاستعمال';
$string['usagereport_desc'] = 'مشاركة معلومات الاستخدام غير المشخصنة مع مطوري الملحق بشكل دوري. ستساعد هذه المعلومات على فهم كيفية استعمال الملحق بشكل أفضل وستؤثر على تطويره. تتضمن المعلومات المُشاركة معلومات أساسية عن موقع مودل (عنوان الرابط، الإصدار)، ومعلومات استعمال الملحق (عدد المستخدمين الذين يحصلون على نقاط، نظرة عامة على الإعدادات، القواعد المُستخدمة، ...).';
$string['usealgo'] = 'استعمال الخوارزمية';
$string['usecustomlevelbadges'] = 'استعمال شارات المراحل المخصصة';
$string['usecustomlevelbadges_help'] = 'عند ضبطه على نعم، عليك توفير صورة لكل مرحلة.';
$string['userladderparticipation'] = 'مشاركات لوحة المتصدرين';
$string['userladderparticipation_help'] = 'يحدد ما إذا كان المستخدم مشترك حاليًا في لوحة المتصدرين. هذا لا يؤثر على صدارة الفِرق.';
$string['userladderparticipationlocked'] = 'قفل وحدة المشاركين';
$string['userladderparticipationlocked_help'] = 'التاريخ الذي يكون بعده المستخدم حرًا في تغيير تفضيله للاشتراك.';
$string['usingalgo'] = 'يجري استعمال الخوارزمية';
$string['value'] = 'القيمة';
$string['valuessaved'] = 'تم حفظ القِيَم بنجاح.';
$string['viewas'] = 'المعاينة بمثابة';
$string['viewlogs'] = 'معاينة سجل الوقوعات';
$string['viewtheladder'] = 'معاينة السُلم';
$string['visualsintro'] = 'تخصيص مظهر المراحل، ومعاني النقاط.';
$string['wewillreplyat'] = 'سنرد عند: _{$a}_.';
$string['when'] = 'عندما';
$string['wherearexpused'] = 'أين تُستعمل النقاط؟';
$string['wherearexpused_desc'] = 'عند ضبطه على "في المساقات"، ستُحتسب النقاط المكتسبة فقط للمساق التي أُضيفت إليه الكتلة. عند ضبطه على "على مستوى الموقع"، سترتفع مرحلة المستخدم في الموقع بدلاً من أن يكون لكل مساق، وسيتم استعمال كل النقاط المكتسبة على عموم الموقع.';
$string['whoops'] = 'عفوًا!';
$string['xp'] = 'نقاط الخبرة';
$string['xp:addinstance'] = 'إضافة كتلة جديدة';
$string['xp:earnxp'] = 'إكتساب النقاط';
$string['xp:manage'] = 'إدارة كل ما يتعلق بنقاط الخبرة';
$string['xp:myaddinstance'] = 'إضافة الكتلة إلى دفة القيادة الخاصة بي';
$string['xp:view'] = 'معاينة الكتلة والصفحات المتعلقة بها';
$string['xp:viewlogs'] = 'معاينة سجلات الوقوعات';
$string['xp:viewreport'] = 'معاينة التقرير';
$string['xpgaindisabled'] = 'إكتساب النقاط معطل';
$string['xpplusrequired'] = 'يتطلب XP+';
$string['xprequired'] = 'يتطلب XP';
$string['xptogo'] = '[[{$a}]] بقيت';
$string['youleveledupexcl'] = 'لقد حصلت على ترقية!';
$string['youreachedlevel'] = 'قد وصلت إلى مرحلة:';
$string['youreachedlevela'] = 'قد وصلت إلى مرحلة {$a}!';
$string['yourmessage'] = 'رسالتك';
$string['yourownrules'] = 'قواعدك الخاصة';
