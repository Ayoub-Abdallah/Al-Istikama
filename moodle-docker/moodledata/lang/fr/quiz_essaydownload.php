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
 * Strings for component 'quiz_essaydownload', language 'fr', version '5.1'.
 *
 * @package     quiz_essaydownload
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['attachments'] = 'Annexes';
$string['byattempt'] = 'Tentative';
$string['byquestion'] = 'Question';
$string['errorfilename'] = 'erreur-{$a}.txt';
$string['errorfontsize'] = 'La taille de la police doit être un nombre entier entre 6 et 50.';
$string['errormargin'] = 'Les marges de la page doivent être des nombres entiers entre 0 et 80.';
$string['errormessage'] = 'Une erreur s’est produite, l’archive pourrait être incomplète. Merci de contacter les développeurs du plugin pour le téléchargement de réponses aux questions de composition (quiz_essaydownload) et de leur faire parvenir les informations suivantes:';
$string['essaydownload'] = 'Télécharger des réponses';
$string['fileformat'] = 'Format de fichier';
$string['fileformat_help'] = 'Vous avez le choix parmi deux formats:<ul><li>Le format PDF vous permet d’obtenir un document formaté pour chaque réponse, prêt pour l’impression ou la correction à l’écran.</li><li>Le format texte (TXT) est plus rapide et l’archive aura une taille plus petite ce qui peut s’avérer utile en cas de tests de grande envergure. Les fichiers peuvent être lus avec n’importe quel éditeur de texte ou ouverts dans un programme de traitement de texte pour une mise en page. Vous pouvez également choisir ce format si vous avez des scripts personnalisés pour convertir ou traiter les réponses de manière automatique.</li></ul>';
$string['fileformatpdf'] = 'Format PDF';
$string['fileformattxt'] = 'Format texte (TXT)';
$string['firstlast'] = 'Prénom - Nom';
$string['font'] = 'Police';
$string['font_help'] = 'Si vous utilisez le format original (HTML), la police peut être différente selon le formatage appliqué par les étudiants.<br><br>Si vous utilisez le résumé texte, une police à chasse fixe est souvent un bon choix.';
$string['fontmono'] = 'Police à chasse fixe';
$string['fontsans'] = 'Police sans empattement';
$string['fontserif'] = 'Police avec empattement';
$string['fontsize'] = 'Taille de police (points)';
$string['fontsize_help'] = 'Si vous utilisez le format original (HTML), la taille de police peut être différente selon le format utilisé par les étudiants.';
$string['generaloptions'] = 'Réglages généraux';
$string['groupby'] = 'Groupement par';
$string['groupby_help'] = 'L’archive peut être structurée par question ou par tentative :<ul><li>Si vous groupez par question, l’archive contiendra un répertoire pour chaque question. Dans chacun des répertoires, il y aura un sous-répertoire par tentative.</li><li>Si vous groupez par tentative, l’archive contiendra un répertoire pour chaque tentative. Dans chacun des répertoires, il y aura un sous-répertoire par question.</li></ul>';
$string['includeattachments'] = 'Télécharger également d’éventuelles annexes aux réponses.';
$string['includeattachments_help'] = 'Les annexes seront intégrées telles quelles. Pensez tout fichier peut contenir du code malveillant.';
$string['includequestiontext'] = 'Intégrer également la question.';
$string['includequestiontext_help'] = 'L’intégration de la question est particulièrement utile si votre test utilise des questions aléatoires.';
$string['lastfirst'] = 'Nom - Prénom';
$string['linedouble'] = 'Double';
$string['lineoneandhalf'] = '1.5 lignes';
$string['linesingle'] = 'Simple';
$string['linespacing'] = 'Espacement des lignes';
$string['margins'] = 'Marges de la page (mm) : gauche, droite, haut, bas';
$string['nameordering'] = 'Format du nom';
$string['noessayquestion'] = 'Ce test ne contient pas de questions de composition.';
$string['nothingtodownload'] = 'Rien à télécharger';
$string['page'] = 'Format de page';
$string['pagea4'] = 'A4';
$string['pageletter'] = 'US Letter';
$string['pdfoptions'] = 'Réglages du PDF';
$string['plugindescription'] = 'Télécharger les réponses aux questions de composition et les éventuelles annexes.';
$string['pluginname'] = 'Plugin pour le téléchargement de réponses aux questions de composition (quiz_essaydownload)';
$string['presentedto'] = 'Présenté à : {$a}';
$string['privacy:metadata'] = 'Le plugin pour le téléchargement de réponses aux questions de composition (quiz_essaydownload) ne sauvegarde pas de données personnelles.';
$string['response'] = 'Réponse';
$string['shortennames'] = 'Raccourcir les noms de l’archive et des sous-répertoires';
$string['shortennames_help'] = 'Si le nom du chemin d’un fichier extrait est plus long que 260 caractères, ceci risque de causer des problèmes avec l’outil de décompression d’archives inclus dans Windows. Dans ce cas, activer cette option peut être une solution. Il peut, toutefois, devenir plus difficile d’identifier les étudiants, s’ils ont des noms très longs.';
$string['source'] = 'Source de texte à utiliser';
$string['source_help'] = 'Si le texte d’une question ou la réponse d’un étudiant est écrit en format HTML, Moodle générera automatiquement un résumé textuel qui ne contiendra plus de balises HTML et aura un formatage basic (p. ex. texte en gras ou titres écrits EN MAJUSCULES).<br><br>Pour générer des fichiers PDF, vous pouvez choisir si vous voulez utiliser le résumé textuel ou la version original avec son formatage. Lorsque vous utilisez le résumé textuels, il est souvent préférable d’utiliser également une police à chasse fixe.<br><br>Notez qu’il n’est pas possible d’utiliser le texte original au format HTML lorsque vous générez une archive avec des fichiers texte (TXT). Notez également que cette option n’aura pas d’effet si l’étudiant n’a pas écrit sa réponse au format HTML.';
$string['sourceoriginal'] = 'Format original (HTML)';
$string['sourcesummary'] = 'Résumé textuel';
