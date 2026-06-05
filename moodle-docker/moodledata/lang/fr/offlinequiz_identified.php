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
 * Strings for component 'offlinequiz_identified', language 'fr', version '5.1'.
 *
 * @package     offlinequiz_identified
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['create'] = 'Créer';
$string['enableidentified'] = 'Activer les formulaires de réponse pré-remplis';
$string['enableidentified_help'] = 'Donne aux enseignants le choix de créer des formulaires de réponse, pré-remplis avec le nom et le numéro d\'identification. Cela facilite le remplissage des formulaires, mais supprime la possibilité de décider du groupe d\'utilisateurs au moment de l\'examen.';
$string['group'] = 'Groupe QCM Papier';
$string['identified'] = 'Pré-remplir les formulaires de réponse';
$string['identifiedreport'] = '<p class="alert alert-primary">Veuillez sélectionner le groupe de QCM Papier et la liste de présence (définis dans la section<a href="{$a}">Présences</a>) pour lesquels les formulaires de réponse doivent être pré-remplis avec le nom et le numéro d\'identification des participants.<br> Les formulaires de réponse pré-remplis créés peuvent être sauvegardés, imprimés et remis aux étudiants à la place des formulaires de réponse habituels au début du test. <br><br><strong>Note : </strong>Cela signifie que le groupe du QCM Papier est déjà défini à ce stade et qu\'il ne peut plus être attribué directement lorsque le QCM Papier a lieu.
<br>Cette fonction est recommandée pour les petits groupes de participants. La création des formulaires de réponse pré-remplis peut prendre un certain temps en fonction du nombre de participants.</p>';
$string['missinggroup'] = 'Données manquantes pour le groupe de quiz hors ligne {$a}';
$string['nogroupmark'] = 'Ne pas marquer le groupe';
$string['noparticipantsinlist'] = 'Il n\'y a pas de participants dans la liste de présence sélectionnée';
$string['noroles'] = 'Aucun rôle avec la capacité « mod/offlinequiz:attempt » n\'est défini dans le contexte du système.';
$string['notgenerated'] = 'Les formulaires n\'ont pas encore été générés. Veuillez vous rendre sur la <a href="{$a}">Section Préparation</a> et créez vos formulaires.';
$string['offlinequizidentifiedheading'] = 'Pré-remplir les formulaires de réponse';
$string['participants'] = 'Liste de présence';
$string['pluginname'] = 'Formulaires de réponse pré-remplis';
$string['return'] = 'Retour';
