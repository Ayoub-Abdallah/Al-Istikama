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
 * Strings for component 'qtype_oumultiresponse', language 'fr', version '5.1'.
 *
 * @package     qtype_oumultiresponse
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['choices'] = 'Choix de réponse disponibles';
$string['correctanswer'] = 'Bonne réponse';
$string['err_correctanswerblank'] = 'Attention ! Vous avez marqué ce choix de réponse comme étant « correct » mais il est vide !';
$string['err_nonecorrect'] = 'Attention ! Vous devez marquer au moins un choix de réponse comme étant « correct » !';
$string['err_youneedmorechoices'] = 'Attention ! Vous devez au moins rentrer 2 choix de réponse !';
$string['notenoughcorrectanswers'] = 'Vous devez sélectionner au moins 1 choix de réponse correct !';
$string['pluginname'] = 'QCM simplifié';
$string['pluginname_help'] = 'Il s’agit d’une <b>version simplifiée</b> du type de question « choix multiple » disponible par défaut.

Avec les QCM simplifiés, <b>il suffit de cocher les réponses correctes pour que la répartition des points par bonnes / mauvaises réponses se fasse automatiquement de façon équitable</b>.

Attention ! Si vous souhaitez pondérer vos choix de réponse de façon variable (ex : en valorisant davantage une bonne ou mauvaise réponse plutôt qu’une autre), il est conseillé d’utiliser le type de question « choix multiple » par défaut et d’appliquer un pourcentage de points différent selon vos choix de réponse.

À noter qu’il existe également un type de question « choix multiple tout-ou-rien » qui permet d’imposer que l’apprenant ait l’ensemble des bonnes réponses pour pouvoir obtenir la totalité des points : la moindre erreur fait perdre l’ensemble des points.';
$string['pluginname_link'] = 'question/type/oumultiresponse';
$string['pluginnameadding'] = 'Ajouter un QCM simplifié';
$string['pluginnameediting'] = 'Modifier un QCM simplifié';
$string['pluginnamesummary'] = 'Il s’agit d’une <b>version simplifiée</b> du type de question « choix multiple » disponible par défaut.

Avec les QCM simplifiés, <b>il suffit de cocher les réponses correctes pour que la répartition des points par bonnes / mauvaises réponses se fasse automatiquement de façon équitable</b>.

Attention ! Si vous souhaitez pondérer vos choix de réponse de façon variable (ex : en valorisant davantage une bonne ou mauvaise réponse plutôt qu’une autre), il est conseillé d’utiliser le type de question « choix multiple » par défaut et d’appliquer un pourcentage de points différent selon vos choix de réponse.

À noter qu’il existe également un type de question « choix multiple tout-ou-rien » qui permet d’imposer que l’apprenant ait l’ensemble des bonnes réponses pour pouvoir obtenir la totalité des points : la moindre erreur fait perdre l’ensemble des points.';
$string['privacy:metadata'] = 'Le plugin QCM simplifié (OU multiple response) n’enregistre aucune donnée personnelle.';
$string['privacy:preference:showstandardinstruction'] = 'Si les instructions standard doivent être affichées';
$string['showeachanswerfeedback'] = 'Montrer le feedback (rétroaction) pour les réponses sélectionnées.';
$string['showstandardinstruction'] = 'Afficher les instructions standards';
$string['showstandardinstruction_help'] = 'S’il faut afficher les instructions « Veuillez choisir au moins une réponse. : » avant les réponses proposées';
$string['toomanyoptions'] = 'Vous avez sélectionné trop d’options.';
$string['yougot1right'] = 'Vous avez sélectionné 1 bonne réponse.';
$string['yougotnright'] = 'Vous avez sélectionné {$a->num} bonnes réponses.';
