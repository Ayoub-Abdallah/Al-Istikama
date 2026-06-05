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
 * Strings for component 'quizaccess_wifiresilience', language 'ar', version '5.1'.
 *
 * @package     quizaccess_wifiresilience
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['extraroutes_help'] = 'أضف مسارات جديدة لعامل خدمة الاختبار. إذا أردت من عامل خدمة الاختبار [Wifiresilience-SW] أن يلتقط مسارات إضافية (إمتدادات الملفات، عناوين الويب، إلخ.) وأن يعاملها بشكل مختلف عند انقطاع الاتصال. يمكنك إضافة ما يأتي كمثال:<br>
<code>
// نريد ما لا يزيد على 1000 ملف ذات الامتداد "XYZ" في الخبء.<br />
// نقوم بالفحص باستعمال استراتيجية networkFirst.<br />
global.toolbox.router.get(/\\.(?:XYZ)$/, global.toolbox.<strong>networkFirst</strong>, {<br />
&nbsp;&nbsp;&nbsp;cache: {<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;name: \'Wifiresilience-exams-<strong>XYZ</strong>\', // اسم قاعدة البيانات المحلية (indexedDb).<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;maxEntries: 1000, // أقصى عدد من الملفات المطلوب حفظها.<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;maxAgeSeconds: 86400 // أقصى وقت بالثواني قبل أن يتم حذفها/انتهاء صلاحيتها.<br />
&nbsp;&nbsp;&nbsp;},<br />
&nbsp;&nbsp;&nbsp;origin: /\\.googleapis\\.com$/ // إختياري، إذا كانت الملفات متوضعة خارج نطاق مودل.<br />
});<br />
</code>
<h2 id="options"><a class="anchorjs-link " href="#options" aria-label="رابط المرتكز بالنسبة إلى: الخيارات" style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a>خيارات المسارات</h2>

<p>يمكن تحديد كل الخيارات بشكل عمومي عبر خصائص <code class="highlighter-rouge">toolbox.options</code>.
يمكن تعريف أي خصائص فردية على أساس كل معالج عبر <code class="highlighter-rouge">Object</code> الممرر بمثابة
المعامل الثالث إلى طرق <code class="highlighter-rouge">toolbox.router</code>.</p>

<h3 id="debug-boolean"><a class="anchorjs-link " href="#debug-boolean" aria-label="رابط المرتكز بالنسبة إلى: debug boolean"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a>debug [Boolean]</h3>
<p>يقرر ما إذا كان يتم توثيق المزيد من المعلومات في لوحة التطوير للمستعرض.</p>

<p><em>الافتراضي</em>: <code class="highlighter-rouge">false</code></p>

<h3 id="networktimeoutseconds-number"><a class="anchorjs-link " href="#networktimeoutseconds-number" aria-label="رابط المرتكز بالنسبة إلى: رقم networktimeoutseconds"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a>networkTimeoutSeconds [Number]</h3>
<p>وقت الانقضاء الذي ينطبق على <code class="highlighter-rouge">toolbox.networkFirst</code> في المعالج الداخلي.
إذا تم ضبط <code class="highlighter-rouge">networkTimeoutSeconds</code>، فأي طلبات عبر الشبكة تستغرق مدة أطول من ذلك
ستتراجع تلقائيًا إلى الاستجابة المخبوءة إن كانت موجودة. عندما لا تكون
<code class="highlighter-rouge">networkTimeoutSeconds</code> مضبوطة، يتم تطبيق منطق انقضاء الوقت المحلي في المستعرض.</p>

<p><em>الافتراضي</em>: <code class="highlighter-rouge">null</code></p>

<h3 id="cache-object"><a class="anchorjs-link " href="#cache-object" aria-label="رابط المرتكز بالنسبة إلى: cache object" style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a>cache [Object]</h3>
<p>خصائص متعددة لـ <code class="highlighter-rouge">cache</code> تتحكم بسلوك الخبء الافتراضي عند ضبطه عبر
<code class="highlighter-rouge">toolbox.options.cache</code>، أو الخبء المستعمل من قبل معالج طلبات خاص.</p>

<h3 id="cachename-string"><a class="anchorjs-link " href="#cachename-string" aria-label="رابط المرتكز بالنسبة إلى: cachename string"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a>cache.name [String]</h3>
<p>اسم <a href="https://developer.mozilla.org/en-US/docs/Web/API/Cache" target="_blank"><code class="highlighter-rouge">Cache</code></a>
المستعمل لخزن مكونات <a href="https://fetch.spec.whatwg.org/#response-class" target="_blank"><code class="highlighter-rouge">Response</code></a>. استعمال اسم فريد
يسمح لك بتخصيص الحجم الأقصى للخبء وعمر الإدخالات فيه.</p>

<p><em>الافتراضي</em>: يتم توليده عند التشغيل بناءً على قيمة <code class="highlighter-rouge">registration.scope</code> لعامل الخدمة.</p>

<h3 id="cachemaxentries-number"><a class="anchorjs-link " href="#cachemaxentries-number" aria-label="رابط المرتكز بالنسبة إلى: رقم cachemaxentries"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a>cache.maxEntries [Number]</h3>
<p>يفرض سياسة انتهاء الصلاحية في الخبء حسب الأبعد استعمالاً
على الإدخالات المخبوءة بواسطة المعالجات الداخلية المتعددة. يمكنك استعمال ذلك مع خبء مخصص
لخزن الإدخالات لمجموعة متحركة من الموارد التي ليس لها حد طبيعي عبر جعل <code class="highlighter-rouge">cache.maxEntries</code> بقيمة
<code class="highlighter-rouge">10</code> مثلاً سيعني أنه بعد تخبئة الإدخال الحادي عشر، فالإدخال الأبعد استعمالاً سيتم
حذفه تلقائيًا. ينبغي أن لا يُترك الخبء لينمو أكبر من <code class="highlighter-rouge">cache.maxEntries</code> من الإدخالات.
هذا الخيار سيكون مؤثرًا فقط إذا تم ضبط <code class="highlighter-rouge">cache.name</code> أيضًا.
يمكن استعماله لوحده أو بالتزامن مع <code class="highlighter-rouge">cache.maxAgeSeconds</code>.</p>

<p><em>الافتراضي</em>: <code class="highlighter-rouge">null</code></p>

<h3 id="cachemaxageseconds-number"><a class="anchorjs-link " href="#cachemaxageseconds-number" aria-label="رابط المرتكز بالنسبة إلى: رقم cachemaxageseconds"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a>cache.maxAgeSeconds [Number]</h3>
<p>يفرض العمر الأقصى لإدخالات الخبء، بالثواني.
يمكنك استعماله مع خبء مخصص لخزن الإدخالات لمجموعة متحركة من الموارد
التي ليس لها حد طبيعي عبر جعل <code class="highlighter-rouge">cache.maxAgeSeconds</code> بقيمة <code class="highlighter-rouge">60 * 60 * 24</code> مثلاً سيعني أن أي
إدخالات أقدم من يوم واحد سيتم حذفها تلقائياً.
هذا الخيار سيكون مؤثرًا فقط إذا تم ضبط <code class="highlighter-rouge">cache.name</code> أيضًا.
يمكن استعماله لوحده أو بالتزامن مع <code class="highlighter-rouge">cache.maxEntries</code>.</p>

<p><em>الافتراضي</em>: <code class="highlighter-rouge">null</code></p>

<h2 id="handlers"><a class="anchorjs-link " href="#handlers" aria-label="رابط المرتكز بالنسبة إلى: المعالجات"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a>المعالجات</h2>

<p>هناك خمسة معالجات داخلية لتغطية أغلب استراتيجيات الشبكة. لمزيد من المعلومات عن استراتيجيات عدم الاتصال <a href="http://jakearchibald.com/2014/offline-cookbook/">كتاب الطبخ بدون اتصال</a>.</p>

<h3 id="toolboxnetworkfirst"><a class="anchorjs-link " href="#toolboxnetworkfirst" aria-label="رابط المرتكز بالنسبة إلى: toolboxnetworkfirst"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a><code class="highlighter-rouge">toolbox.networkFirst</code></h3>
<p>يحاول معالجة الطلب عبر الإحضار من الشبكة. إذا نجح في ذلك، يخزن الإجابة في الخبء. بخلاف ذلك، يحاول تلبية الطلب من الخبء. هذه هي الاستراتيجية المستعملة في التخبئة الأساسية عبر القراءة. إنها جيدة أيضاً لطلبات واجهة برمجة التطبيق عندما تريد أحدث نسخة من البيانات عند توفرها ولكنك تفضل الحصول على بيانات قديمة على أن لا تحصل على أي بيانات أصلاً.</p>

<h3 id="toolboxcachefirst"><a class="anchorjs-link " href="#toolboxcachefirst" aria-label="رابط المرتكز بالنسبة إلى: toolboxcachefirst"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a><code class="highlighter-rouge">toolbox.cacheFirst</code></h3>
<p>إذا تطابق الطلب من أحد إدخالات الخبء، استجب به. بخلاف ذلك، يحاول تلبية الطلب من الشبكة. إذا نجح الطلب من الشبكة، يقوم بتحديث الخبء. هذا الخيار جيد بالنسبة إلى الموارد التي لا تتغير، أو لديها آلية تحديث أخرى.</p>

<h3 id="toolboxfastest"><a class="anchorjs-link " href="#toolboxfastest" aria-label="رابط المرتكز بالنسبة إلى: toolboxfastest"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a><code class="highlighter-rouge">toolbox.fastest</code></h3>
<p>أطلب المورد بالتوازي من كل من الخبء والشبكة. الاستجابة تكون من أيهما يصل أولاً. عادة ما يكون ذلك النسخة المخبأة، إن وجدت. من جانب آخر، هذه الاستراتيجية ستقوم دائمًا بالطلب من الشبكة، حتى وإن كان المورد مخبأً. فضلاً عن ذلك، إذا/عندما اكتمل الطلب من الشبكة، يتم تحديث الخبء، ولذلك تكون الطلبات اللاحقة من الخبء بأحدث نسخة.</p>

<h3 id="toolboxcacheonly"><a class="anchorjs-link " href="#toolboxcacheonly" aria-label="رابط المرتكز بالنسبة إلى: toolboxcacheonly"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a><code class="highlighter-rouge">toolbox.cacheOnly</code></h3>
<p>أوجد الطلب في الخبء، أو الفشل. هذا الخيار جيد عندما تريد أن تضمن عدم إجراء الطلب عبر الشبكة، على سبيل المثال عند توفير بطارية الجوال.</p>

<h3 id="toolboxnetworkonly"><a class="anchorjs-link " href="#toolboxnetworkonly" aria-label="رابط المرتكز بالنسبة إلى: toolboxnetworkonly"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a><code class="highlighter-rouge">toolbox.networkOnly</code></h3>
<p>يعالج الطلب عبر محاولة إحضار الرابط من الشبكة. إذا فشل الإحضار، فشل الطلب. مبدئيًا مشابه لعدم إنشاء مسار للرابط على الإطلاق.</p>

<h2 id="expressive-approach"><a class="anchorjs-link " href="#expressive-approach" aria-label="رابط المرتكز بالنسبة إلى: المقاربة التعبيرية"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a>الطرق</h2>

<h3 id="toolboxroutergetpostputdeleteheadurlpattern-handler-options"><a class="anchorjs-link " href="#toolboxroutergetpostputdeleteheadurlpattern-handler-options" aria-label="رابط المرتكز بالنسبة إلى: خيارات المعالج toolboxroutergetpostputdeleteheadurlpattern"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a><code class="highlighter-rouge">toolbox.router.&lt;get|post|put|delete|head&gt;(urlPattern, handler, options)</code></h3>

<p>إنشاء مسار يؤدي إلى أن طلبات الروابط المطابقة لـ <code class="highlighter-rouge">urlPattern</code> يجري حلها عبر استدعاء <code class="highlighter-rouge">handler</code>. يطابق الطلبات التي تستعمل الطرق GET، POST، PUT، DELETE أو HEAD HTTP على التوالي.</p>

<ul>
  <li><code class="highlighter-rouge">urlPattern</code> - مسار نمط تعبيري. أنظر التوثيقات من أجل <a href="https://github.com/pillarjs/path-to-regexp"  target="_blank">path-to-regexp</a> الوحدة المعنية بالصيغة الكاملة</li>
  <li><code class="highlighter-rouge">handler</code> - معالج الطلب، كما <a href="#handlers">موصوف أعلاه</a></li>
  <li><code class="highlighter-rouge">options</code> - المكون الذي يحتوي خيارات المسار. سيتم تمرير هذا المكون إلى معالج الطلب. الخيار <code class="highlighter-rouge">origin</code> يختص بطرق الموجه، ويمكن أن يكون إما نصًا بالضبط أو تعبيرًا إعتياديًا لتتم معه مطابقة أصل الطلب من أجل استعمال المسار.</li>
</ul>

<h3 id="toolboxrouteranyurlpattern-handler-options"><a class="anchorjs-link " href="#toolboxrouteranyurlpattern-handler-options" aria-label="رابط المرتكز بالنسبة إلى: خيارات المعالج toolboxrouteranyurlpattern"  style="font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 1em; line-height: inherit; font-family: anchorjs-icons; position: absolute; margin-left: -1em; padding-right: 0.5em;"></a><code class="highlighter-rouge">toolbox.router.any(urlPattern, handler, options)</code></h3>
<p>مثل <code class="highlighter-rouge">toolbox.router.get</code>، إلخ.، لكنه يطابق أي طريقة لـ HTTP.</p>

<h3 id="toolboxrouterالافتراضي"><a class="anchorjs-link " href="#toolboxrouterالافتراضي"';
