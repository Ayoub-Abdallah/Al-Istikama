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
 * Strings for component 'block_smartedu', language 'fr', version '5.1'.
 *
 * @package     block_smartedu
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aiprovider'] = 'Choisir votre fournisseur d\'IA générative';
$string['aiprovidererror'] = 'Il semble qu\'une erreur se soit produite lors de l\'utilisation du service AI. Veuillez réessayer dans quelques minutes. Si le problème persiste, veuillez contacter le service d\'assistance.';
$string['apikey'] = 'Insérer votre clé API';
$string['enablecache'] = 'Activer le cache du prompt';
$string['internalerror'] = 'Erreur interne du système.';
$string['invalidaiprovider'] = 'Le fournisseur d\'IA n\'est pas pris en charge.';
$string['invalidtypefile'] = 'Le type de ressource n\'est pas pris en charge.';
$string['mindmap:title'] = 'Carte heuristique (mindmap)';
$string['noresources'] = 'Aucun <a href="https://github.com/dired-ufla/moodle-block_smartedu/blob/main/file-formats.md" target="_blank">fichier compatible</a> n\'est disponible pour ce cours.';
$string['nquestions'] = 'Nombre de questions';
$string['pluginname'] = 'SmartEdu - Apprentissage intelligent';
$string['privacy:metadata'] = 'Le bloc SmartEdu n\'affiche que les données des cours existants.';
$string['prompt:detailedsummary'] = 'Sur la base du contenu suivant du cours intitulé « {$a} », rédigez un résumé détaillé de 300 mots maximum, en soulignant et en expliquant les principaux concepts pour un étudiant de premier cycle.';
$string['prompt:mindmap'] = 'Créer également une carte mentale des principaux concepts de la leçon, dans un format qui peut être lu correctement par la bibliothèque JavaScript MindElixir, comme dans l\'exemple suivant : {"nodeData" : {"id" : "root", "topic" : "root", "children" : [{"id" : "sub1", "topic" : "sub1", "enfants" : [{"id" : "sub2", "topic" : "sub2"}]}}}';
$string['prompt:quizz'] = 'Créer {$a} questions à choix multiples au format JSON, avec 4 options (A, B, C, D), dont une seule est correcte. Pour chaque option, expliquez brièvement pourquoi elle est correcte ou incorrecte, sans utiliser les mots Correct ou Incorrect avant l\'explication. Retournez les questions dans le format suivant : "questions": [{"question" : "Texte de la question", "options" : {"A" : "Texte de l\'option A", "B" : "Texte de l\'option B", "C" : "Option C texte", "D" : "Texte de l\'option D"}, "feedbacks" : {"A" : "Explication de l\'option A", "B" : "Explication de l\'option B", "C" : "Explication de l\'option C", "D" : "Explication de l\'option D"}, "correct_option" : "Lettre de l\'option correcte"}].';
$string['prompt:simplesummary'] = 'Sur la base du contenu suivant de la conférence intitulée « {$a} », rédiger un résumé simple de 10 phrases maximum, mettant en évidence les principaux concepts d\'une manière claire et objective pour un étudiant de premier cycle. Renvoyer le résumé dans le format suivant : "summary" : "Résumé de la conférence".';
$string['prompt:studyscript'] = 'Rédiger un guide d\'étude pour ce cours, formaté en HTML en utilisant les balises h5 pour les titres, contenant le sujet principal, les objectifs du texte, les matières à apprendre et ce que l\'étudiant devrait être capable de savoir après avoir lu le texte.';
$string['quizz:correct'] = 'Réponse correcte';
$string['quizz:question'] = 'Question';
$string['quizz:sendresponses'] = 'Envoyer les réponses';
$string['quizz:showresponse'] = 'La réponse correcte est :';
$string['quizz:wrong'] = 'Mauvaise réponse';
$string['resourcenotfound'] = 'La ressource spécifiée n\'a pas été trouvée.';
$string['resourcenotprocessable'] = 'Le contenu de la ressource spécifiée n\'a pas pu être traité.';
$string['smartedu:addinstance'] = 'Ajouter un nouveau bloc SmartEdu';
$string['smartedu:myaddinstance'] = 'Ajouter un nouveau bloc SmartEdu à la page Mon Moodle';
$string['studentinvisible'] = '- caché pour les étudiants';
$string['studyscript:title'] = 'Guide d\'étude';
$string['summarytype'] = 'Type de résumé';
$string['summarytype:detailed'] = 'Détaillé';
$string['summarytype:simple'] = 'Simple';
$string['termsofuse'] = 'En utilisant le bloc SmartEdu, vous acceptez ses <a href="https://github.com/dired-ufla/moodle-block_smartedu/blob/main/terms-of-use.md" target="_blank">Conditions d\'utilisation</a>.';
