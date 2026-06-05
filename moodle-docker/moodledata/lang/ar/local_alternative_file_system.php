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
 * Strings for component 'local_alternative_file_system', language 'ar', version '5.1'.
 *
 * @package     local_alternative_file_system
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['bytescalcfailed'] = 'فشل حساب البايتات (وضع fast=0). السبب: {$a}';
$string['bytesline'] = 'البايتات: <strong>{$a->migrated}</strong> / <strong>{$a->total}</strong> &nbsp;|&nbsp; المعدل (10د): <strong>{$a->rate}/دقيقة</strong> &nbsp;|&nbsp; الوقت المتبقي المتوقع (بايتات): <strong>{$a->eta}</strong>';
$string['cachedef_missing_count'] = 'عدد المفقودات في الخبء';
$string['eta'] = 'الوقت المتبقي المتوقع: <strong>{$a}</strong>';
$string['instruction_install'] = '<p><strong>أضف السطر أدناه إلى ملف التهيئة <code>config.php</code> في مودل:</strong></p><pre><code>$CFG->alternative_file_system_class = \'\\local_alternative_file_system\\external_file_system\';</code></pre><p><strong>مهم:</strong> أدخِل هذا السطر <strong>قبل</strong> السطر أدناه (إن وُجد في ملفك):</p><pre><code>require_once(__DIR__ . "/lib/setup.php");</code></pre>';
$string['instruction_title'] = 'إرشادات التنصيب';
$string['lasttransfer'] = 'آخر عملية نقل: <strong>{$a}</strong>';
$string['migrate_link'] = '<p><a class="btn btn-success" href="?execute=1">التنفيذ الآن (قد يستغرق وقتًا طويلًا)</a></p>';
$string['migrate_title'] = 'ترحيل التخزين المحلي إلى التخزين البعيد';
$string['migrate_title_tolocal'] = 'ترحيل التخزين البعيد إلى التخزين المحلي';
$string['migrate_total'] = '<p>لديك <strong>{$a->missing}</strong> ملفًا محليًا بانتظار الترحيل، بينما تم بالفعل ترحيل <strong>{$a->sending}</strong> ملفًا إلى البيئة البعيدة.</p>';
$string['migrate_total_local'] = 'ينقل الملفات من التخزين البعيد إلى التخزين المحلي. قد يستغرق ذلك بعض الوقت حسب كمية البيانات.';
$string['migratedfiles'] = 'تم الترحيل: <strong>{$a}</strong>';
$string['nostoragefound'] = 'لم يتم العثور على مساحة تخزين للإبلاغ عنها. تحقّق مما إذا كان الجدول local_alternativefilesystemf يحتوي على سجلات.';
$string['pluginname'] = 'نظام الملفات البديل';
$string['privacy:no_data_reason'] = 'إن ملحق نظام الملفات البديل لا يخزن أي بيانات شخصية.';
$string['rate'] = 'المعدل: <strong>{$a->r1}</strong> ملف/دقيقة (1د) &nbsp;|&nbsp; <strong>{$a->r10}</strong> ملف/دقيقة (10د) &nbsp;|&nbsp; <strong>{$a->r60}</strong> ملف/دقيقة (60د)';
$string['remainingfiles'] = 'المتبقي: <strong>{$a}</strong>';
$string['reporttitle_status'] = 'الحالة';
$string['settings_bucketname'] = 'اسم الدلو لـ {$a->local}';
$string['settings_bucketnamedesc'] = 'الاسم الفريد المخصّص للدلو في {$a->local}.';
$string['settings_gcs_keyfile'] = 'محتوى Google-storage.json';
$string['settings_gcs_keyfiledesc'] = 'إلصق هنا محتوى ملف "google-storage.json".';
$string['settings_local'] = 'الملفات المحلية في مودل';
$string['settings_migrate_local'] = 'استعمل خدمة <a target="_blank" href="{$a->url}/move-to-local.php">move-to-local.php</a> لترحيل البيانات من {$a->local} إلى التخزين المحلي.';
$string['settings_migrate_remote'] = 'استعمل خدمة <a target="_blank" href="{$a->url}/move-to-external.php">move-to-external.php</a> لترحيل البيانات من التخزين المحلي إلى {$a->local}.';
$string['settings_objectfs_notice'] = '<p>حاليًا، تم تعيين <code>$CFG->alternative_file_system_class</code> إلى <code>"{$a->currentclass}";</code> وهذا يعني أن هذا الموقع يستخدم حاليًا <strong>tool_objectfs</strong> كنظام ملفات بديل في مودل.</p>

<p>لاستعمال الإعدادات نفسها وعدم فقدان أي ملفات، استعمل الإعدادات التالية في هذا الملحق:</p>
<ul>
  <li><strong>{$a->settings_local_lang}</strong>: <code>{$a->settings_local}</code></li>
  <li><strong>{$a->settings_s3_region_lang}</strong>: <code>{$a->settings_s3_region}</code></li>
  <li><strong>{$a->settings_s3_credentials_key_lang}</strong>: <code>{$a->settings_s3_credentials_key}</code></li>
  <li><strong>{$a->settings_s3_credentials_secret_lang}</strong>: <code>{$a->settings_s3_credentials_secret}</code></li>
  <li><strong>{$a->settings_bucketname_lang}</strong>: <code>{$a->settings_bucketname}</code></li>
  <li><strong>{$a->settings_path_lang}</strong>: <code>{$a->settings_path}</code></li>
</ul>

<p>بعد ذلك، تحتاج أولاً إلى تغيير القيمة في <code>config.php</code> إلى <code>$CFG->alternative_file_system_class = \'\\local_alternative_file_system\\external_file_system\';</code> لاستخدام هذا الملحق كنظام ملفات بديل.</p>';
$string['settings_path'] = 'مسار المكون {$a->local}';
$string['settings_pathdesc'] = 'المسار داخل الدلو حيث سيتم تخزين المكونات. يُسمح بالحروف والأرقام فقط.';
$string['settings_s3_credentials_key'] = 'مفتاح الوصول لـ {$a->local}';
$string['settings_s3_credentials_keydesc'] = 'مفتاح الوصول المستعمل للمصادقة مع خدمة {$a->local}.';
$string['settings_s3_credentials_secret'] = 'المفتاح السري لـ {$a->local}';
$string['settings_s3_credentials_secretdesc'] = 'المفتاح السري المستعمل للمصادقة مع خدمة {$a->local}.';
$string['settings_s3_region'] = 'منطقة {$a->local}';
$string['settings_s3_regiondesc'] = 'المنطقة التي يقع فيها دلو {$a->local}، على سبيل المثال "{$a->ex_region}".';
$string['settings_s3generic_destino'] = 'S3 عام (نقطة طرفية مخصصة)';
$string['settings_s3generic_endpoint'] = 'عنوان الرابط للنقطة الطرفية S3';
$string['settings_s3generic_endpoint_desc'] = 'النقطة الطرفية هي العنوان الأساسي لخدمة S3 لديك (مزوّد متوافق مع S3). يمكنك إدخاله بدون <code>https://</code> ومع المنفذ أو بدونه. لا تُدرج أسماء الدلاء، ولا تُدخل فقط مضيف الخدمة (والمنفذ إن لزم).<blockquote>أمثلة: <code>https://s3.eu-central-1.amazonaws.com</code>، <code>o000.idrivee.com</code> أو <code>minio:9000</code>.<br>لا تستعمل: <code><strong style="color:#673AB7;text-decoration:underline;">mybucket.</strong>s3.amazonaws.com</code> أو <code>server:9000<strong style="color:#673AB7;text-decoration:underline;">/mybucket</strong></code>.</blockquote>';
$string['settings_success'] = '<strong>البيانات صحيحة.</strong><br>يرجى توخي الحذر عند تعديل الإعدادات، لأن أي تغييرات غير صحيحة قد تؤدي إلى تعذّر الوصول إلى الملفات المخزنة.';
$string['storage_destination'] = 'وجهة التخزين';
$string['storage_destinationdesc'] = 'إختر وجهة التخزين واحفظ لتحميل البيانات المتعلقة بالتخزين.';
$string['totalfiles'] = 'إجمالي الملفات في MDL_FILES: <strong>{$a}</strong>';
