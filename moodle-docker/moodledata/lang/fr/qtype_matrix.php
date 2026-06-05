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
 * Strings for component 'qtype_matrix', language 'fr', version '5.1'.
 *
 * @package     qtype_matrix
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['all'] = 'Sous-points';
$string['allow_dnd_ui'] = 'Autoriser l’utilisation du glisser-déposer';
$string['allow_dnd_ui_descr'] = 'Si autorisé, les enseignants auront la possibilité d’activer le glisser-déposer pour toutes les questions Matrix';
$string['cols_description'] = 'Description';
$string['cols_shorttext'] = 'Réponse';
$string['colsheader'] = 'Colonnes de matrice';
$string['colsheader_desc'] = '<p>Le texte court sera utilisé lorsqu’il est présent, avec un texte plus long comme info-bulle.<br />Soyez attentif à la façon dont il sera affiché.</p>
<p>Les étudiants peuvent sélectionner plusieurs ou une seule colonne par ligne, selon la configuration de la question, et chaque ligne reçoit une note, définie par l’une des méthodes de notation.</p>
<p>La note finale pour la question est une moyenne de leurs notes pour chacune des lignes à l’exception du type Kprime où toutes les réponses doivent être correctes.</p>';
$string['correctresponse'] = 'Réponse correcte';
$string['difference'] = 'Différence';
$string['false'] = 'Faux';
$string['grademethod'] = 'Méthode de notation';
$string['grademethod_help'] = '<ul>
<li><b>Kprime</b> : l’étudiant reçoit un point, si toutes les réponses sont correctes, un demi-point si une réponse est fausse et que les autres réponses sont correctes, et zéro point sinon.</li>
<li><b>Kprime1/0</b> : l’étudiant reçoit un point, si toutes les réponses sont correctes, et zéro point sinon.</li>
<li><b>Sous-points</b> : l’étudiant reçoit des sous-points pour chaque réponse correcte.</li>
<li><b>Différence</b> : l’étudiant reçoit un point en fonction de l’écart de sa réponse sélectionnée par rapport à une valeur prédéfinie (réponse correcte). La formule pour les scores d’écart est : valeur de différence maximale atteignable - (réponse de l’étudiant - réponse correcte) ^ 2. Le score d’écart est ensuite transformé en un score de crédit partiel compris entre 0 et 1, où 1 correspond à une réponse correcte.</li>
</ul>';
$string['kany'] = 'Kprime (au moins une bonne réponse, pas de mauvaise réponse)';
$string['kprime'] = 'Kprime1/0';
$string['matrixheader'] = 'Matrice de réponse';
$string['multipleallowed'] = 'Autoriser plusieurs réponses possibles par proposition de réponse ?';
$string['mustaddupto100'] = 'La somme de tous les poids non négatifs dans chaque ligne doit être de 100 %';
$string['mustdefine1by1'] = 'Vous devez définir au moins une matrice 1 x 1 ; avec une réponse courte ou longue définie pour chaque ligne et colonne';
$string['oneanswerperrow'] = 'Vous devez fournir une réponse pour chaque ligne';
$string['pluginname'] = 'Kprime';
$string['pluginname_help'] = '<p>Les questions Kprime se composent d’une base d’item et de quatre propositions de réponse correspondants. Pour chaque proposition de réponse, les étudiants doivent décider si elle est bonne ou mauvaise.</p>';
$string['pluginname_link'] = 'question/type/matrix';
$string['pluginnameadding'] = 'Ajouter une question Kprime';
$string['pluginnameediting'] = 'Modifier une question Kprime';
$string['pluginnamesummary'] = 'Dans les questions Kprime, exactement quatre de ces affirmations doivent être correctement notées comme « vraies » ou « fausses ».';
$string['privacy:metadata'] = 'Le plugin Type de question Kprime/Matrix n’enregistre aucune donnée personnelle.';
$string['refresh_matrix'] = 'Actualiser la matrice de réponse';
$string['rows_description'] = 'Description';
$string['rows_feedback'] = 'Feedback';
$string['rows_shorttext'] = 'Proposition de réponse';
$string['rowsheader'] = 'Lignes de la matrice';
$string['rowsheader_desc'] = '<p>Le texte court sera utilisé lorsqu’il est présent, avec du texte plus long comme info-bulle.<br />Soyez attentif à la façon dont il sera affiché</p>
<p>Les étudiants peuvent sélectionner plusieurs ou une seule colonne par ligne, selon la configuration de la question, et chaque ligne reçoit une note, définie par l’une des méthodes de notation.</p>
<p>La note finale pour la question est une moyenne de leurs notes pour chacune des lignes à l’exception du type Kprime où toutes les réponses doivent être correctes.</p>';
$string['show_non_kprime_gui'] = 'Afficher l\'interface graphique pour les options qui ne sont pas strictement des options de la matrice kprime (plus de quatre lignes, plus de deux colonnes, options multiples).';
$string['shuffleanswers'] = 'Mélanger les propositions de réponse ?';
$string['shuffleanswers_help'] = 'Si cette option est activée, l’ordre des propositions de réponse est mélangé de manière aléatoire pour chaque tentative, à condition que « Mélanger les questions » dans les paramètres de l’activité soit également activé.';
$string['true'] = 'Vrai';
$string['use_dnd_ui'] = 'Utiliser le glisser-déposer ?';
$string['weightednomultiple'] = 'Il n’y a pas de sens à choisir une notation pondérée avec plusieurs réponses non autorisées';
