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
 * Strings for component 'filter_synhi', language 'fr', version '5.1'.
 *
 * @package     filter_synhi
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['brokenmarkup'] = 'Le balisage est défectueux, la mise en évidence sera erronée.';
$string['codeexample'] = 'Code';
$string['codeexampledesc'] = 'Code à utiliser dans l\'exemple. Note : Enregistrer pour utiliser dans l\'exemple.';
$string['engine'] = 'Moteur';
$string['enginedesc'] = 'Moteur à utiliser.  Soit « <a href="https://github.com/EnlighterJS/EnlighterJS" target="_blank">EnlighterJS</a> - Licence publique Mozilla 2.0 (MPL-2.0) » ou « <a href="https://github.com/syntaxhighlighter/syntaxhighlighter" target="_blank">SyntaxHighlighter </a> - sous licence MIT ».';
$string['enlighterinformation'] = 'Entourez votre code de la balise « code » pour le code en ligne, pour le code multiligne, puis englobez-le dans une balise « pre ». Enlighter tentera de déterminer la langue. Vous pouvez toutefois la spécifier en ajoutant l\'attribut « data-enlighter-language » à la balise « code » avec la valeur de la langue, par exemple « data-enlighter-language="java" ». Ainsi, le texte souhaité entre crochets pour : <br><ul><li>ABAP (abap)</li><li>Apache HTTPD (apache)</li><li>Assembly (assembly, asm)</li><li>AVR Assembly (avrassembly, avrasm)</li><li>Windows Batch/Bat (bat,batch,cmd)</li><li>C/C++ (c,cpp, c++)</li><li>C# (csharp)</li><li>CSS(css)</li><li>Cython (cython)</li><li>CordPro (cordpro)</li><li>diff (diff)</li><li>Dockerfile (docker, dockerfile)</li><li>Generic (generic, standard) - default highlighting scheme</li><li>Groovy (groovy)</li><li>Go (go, golang)</li><li>HTML (html)</li><li>Ini (ini, conf)</li><li>Java (java)</li><li>Javascript (js, javascript, jquery, mootools, ext.js)</li><li>JSON (json)</li><li>JSX (jsx)</li><li>Kotlin (kotlin)</li><li>LATEX (latex)</li><li>LESS (less)</li><li>lighttpd (lighttpd)</li><li>LUA (lua)</li><li>MariaDB (mariadb)</li><li>Markdown (gfm, md, markdown)</li><li>Matlab/Octave (octave, matlab)</li><li>MSSQL (mssql)</li><li>NGINX (nginx)</li><li>NSIS (nsis)</li><li>Oracle Database (oracledb)</li><li>PHP (php)</li><li>Powerhsell (powershell)</li><li>Prolog (prolog)</li><li>Python (py, python)</li><li>PureBasic (purebasic, pb)</li><li>QML (qml)</li><li>R (r)</li><li>RAW (raw) - raw code without highlighting with EnlighterJS container styles!</li><li>RouterOS/SwitchOS (routeros)</li><li>Ruby (ruby)</li><li>Rust (rust)</li><li>Scala (scala)</li><li>SCSS (scss, sass)</li><li>Shellscript (shell, bash)</li><li>Generic SQL (sql)</li><li>Squirrel (squirrel)</li><li>Swift (swift)</li><li>Typescript (typescript)</li><li>VHDL (vhdl)</li><li>VisualBasic (visualbasic,vb)</li><li>Verilog (verilog)</li><li>XML (xml, html)</li><li>YAML (yaml)</li></ul>';
$string['enlighterjs'] = 'EnlighterJS';
$string['enlighterjsstyle'] = 'Style EnlighterJS';
$string['filtername'] = 'SynHi';
$string['generalinformation'] = 'L\'utilisation de la balise « pre » uniquement pour la mise en évidence du code a été supprimée. Veuillez utiliser la balise « code » à la place et l\'entourer d\'une balise « pre » pour le code multiligne. Les symboles « < » et « > » semblent problématiques dans une balise « code » lorsqu\'ils ressemblent à une balise. Remplacez-les respectivement par « <i>(amphersand)</i>lt; » et « <i>(amphersand)</i>gt; » pour votre code ; ici, <i>(amphersand)</i> signifie « & ».';
$string['information'] = 'Informations';
$string['informationchanges'] = 'Modifications';
$string['informationheading'] = 'Informations';
$string['informationheadingdesc'] = 'Informations sur le filtre.';
$string['informationsettings'] = 'Paramètres d\'information';
$string['informationsettingsdesc'] = 'Informations sur le filtre SynHi';
$string['love'] = 'amour';
$string['pluginname'] = 'SynHi';
$string['privacy:nop'] = 'Le filtre SynHi enregistre les paramètres relatifs à sa configuration.  Aucun des paramètres n\'est lié à un utilisateur spécifique. Il est de votre responsabilité de vous assurer qu\'aucune donnée d\'utilisateur n\'est saisie dans les champs de texte libre. Le réglage d\'un paramètre entraînera l\'enregistrement de cette action dans le système de journalisation de Moodle au nom de l\'utilisateur qui l\'a modifié. Ceci est hors du contrôle du filtre, veuillez vous référer au système de journalisation de Moodle pour le respect de la vie privée. Veuillez examiner attentivement le code pour vous assurer qu\'il est conforme à votre interprétation des lois sur la protection de la vie privée. Je ne suis pas juriste et mon analyse est basée sur mon interprétation. Si vous avez le moindre doute, supprimez immédiatement le filtre.';
$string['settings'] = 'Paramètres';
$string['settingssettings'] = 'Paramètres des paramètres';
$string['settingssettingsdesc'] = 'Paramètres du filtre SynHi';
$string['styledesc'] = 'Choisir le style que vous souhaitez utiliser.';
$string['syntaxhighlighter'] = 'Surlignage syntaxique';
$string['syntaxhighlighterexample'] = 'Exemple';
$string['syntaxhighlighterexampledesc'] = 'À partir du paramètre « codeexample » …';
$string['syntaxhighlighterinformation'] = 'Pour Surlignage syntaxique, entourez votre code d\'une balise « code » et ajoutez la classe ="brush: alias" où « alias » (entre parenthèses) est l\'un des éléments suivants :<br><ul><li>ActionScript3 (as3, actionscript3)</li><li>Bash/shell (bash, shell)</li><li>ColdFusion (cf, coldfusion)</li><li>C# (c-sharp, csharp)</li><li>C++ (cpp, c)</li><li>CSS (css)</li><li>Delphi (delphi, pas, pascal)</li><li>Diff (diff, patch)</li><li>Erlang (erl, erlang)</li><li>Groovy (groovy)</li><li>JavaScript (js, jscript, javascript)</li><li>Java (java)</li><li>JavaFX (jfx, javafx)</li><li>Perl (perl, pl)</li><li>PHP (php)</li><li>Texte brut (plain, text)</li><li>PowerShell (ps, powershell)</li><li>Python (py, python)</li><li>Ruby (rails, ror, ruby)</li><li>Scala (scala)</li><li>SQL (sql)</li><li>Visual Basic (vb, vbnet)</li><li>XML (xml, xhtml, xslt, html, xhtml)</li></ul>';
$string['syntaxhighlighterstyle'] = 'Style de surlignage syntaxique';
$string['versionalpha'] = 'Version alpha - Contient très certainement des bogues. Il s\'agit d\'une version de développement destinée aux développeurs « uniquement » ! Ne pensez même pas à l\'installer sur un serveur de production !';
$string['versionbeta'] = 'Version bêta - Susceptible de contenir des bogues. Prêt à être testé par les administrateurs sur un serveur de test uniquement.';
$string['versioninfo'] = 'Version {$a->release}, version {$a->version} sur Moodle {$a->moodle}. Fabriqué avec {$a->love} en Grande-Bretagne.';
$string['versionrc'] = 'Version candidate à la publication - Peut contenir des bogues. Vérifier complètement sur un serveur de test avant de l\'envisager sur un serveur de production.';
$string['versionstable'] = 'Version stable - Peut contenir des bogues. Vérifiez sur un serveur de test avant de l\'installer sur votre serveur de production.';
