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
 * Strings for component 'tool_cmdlinetools', language 'ar', version '5.1'.
 *
 * @package     tool_cmdlinetools
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['add_assignment_capa_cli_help'] = 'إضافة إمكانية الأخذ بزمام التحكم بحالة الإظهار للإفادة أو إضافات الواجب في السياقات
طريقة الاستعمال:
		\\$sudo -u www-data /usr/bin/php admin/cli/admin/tool/cmdlinetools/cli/cmdline_manager.php add_assignment_capa

الخيارات:
-h, --help                 طباعة هذه التعليمات';
$string['add_assignmentcapa_cli_mustbeint'] = 'القيمة المدخلة ينبغي أن تكون رقمًا صحيحًا';
$string['apply_defaults_settings_to_plugin_cli_settingset'] = 'مجموعة الإضافة {$a->plugin} المفتاح {$a->key} القيمة {$a->value}';
$string['clititle_'] = 'عنوان واجهة سطر الأوامر';
$string['cmdlinecli_help'] = 'أداة سطر الأوامر لإطلاق أوامر مودل:
الاستعمال:
		\\$sudo -u www-data /usr/bin/php admin/cli/admin/tool/cmdlinetools/cli/cmdline_manager.php [argument]
Argument(optional) : اسم الأمر المزمع تنفيذه (المدرج أدناه)
{$a}

الخيارات:
-h, --help                 طباعة هذه التعليمات';
$string['delete_plugin_cli_help'] = 'حذف الإضافة

طريقة الاستعمال:
		\\$sudo -u www-data /usr/bin/php admin/cli/admin/tool/cmdlinetools/cli/cmdline_manager.php delete_plugin plugintype pluginname

حيث أن:
plugintype هو
		mod,
		block,
		qtype,
		qbehaviour,
		enrol,
		filter,
		editor,
		auth,
		license,
		repository,
		courseformat,
		assignfeedback أو assignsubmission
		tool
pluginname هو اسم الإضافة (اسم مجلد الإضافة)

الخيارات:
-h, --help                 طباعة هذه التعليمات';
$string['hideshow_plugin_cli_help'] = 'إخفاء/إظهار الإضافة

طريقة الاستعمال:
		\\$sudo -u www-data /usr/bin/php admin/cli/admin/tool/cmdlinetools/cli/cmdline_manager.php hideshow_plugin plugintype pluginname hideshow

حيث أن:
plugintype هو
		mod,
		block,
		qtype,
		qbehaviour,
		enrol,
		filter,
		editor,
		auth,
		license,
		repository,
		courseformat,
		assignfeedback or assignsubmission
هو اسم الإضافة (اسم مجلد الإضافة)
hideshow هو قيمة رقمية صحيحة، 0 يمثل خطأ أو إطفاء (إضافة المرشح)، 1 يمثل صواب أة تشغيل (إضافة المرشح)، -9999 تمثل التعطيل (إضافة المرشح)

الخيارات:
-h, --help                 طباعة هذه التعليمات';
$string['namevaluerequired_set_config_cli'] = 'ينبغي عليك إدخال إما المعامل  --name أو المعامل --value';
$string['remove_assignment_capa_cli_help'] = 'إزالة إمكانية الأخذ بزمام التحكم بحالة الإظهار للإفادة أو إضافات الواجب في السياقات
طريقة الاستعمال:
		\\$sudo -u www-data /usr/bin/php admin/cli/admin/tool/cmdlinetools/cli/cmdline_manager.php remove_assignment_capa

الخيارات:
-h, --help                 طباعة هذه التعليمات';
$string['remove_assignmentcapa_cli_mustbeint'] = 'القيمة المدخلة ينبغي أن تكون رقمًا صحيحًا';
$string['set_config_cli_help'] = 'تعيين متغير التهيئة
طريقة الاستعمال:
		\\$sudo -u www-data /usr/bin/php admin/cli/admin/tool/cmdlinetools/cli/cmdline_manager.php set_config [options]

الخيارات:
-h, --help                 طباعة صفحة المساعدة هذه
-n, --name=config_name     تهيئة الاسم إذا كان الوضع هو لا استدعاء مثل config_param_name، إذا كان معامل تهيئة عام، أو  plugintype_pluginname/config_param_name إذا كان اسم معامل الإضافة
-v, --value=config_value   قيمة التهيئة إذا كان الوضع هو لا استدعاء
-c, --check 				التحري ما إذا كان اسم التهيئة موجود';
