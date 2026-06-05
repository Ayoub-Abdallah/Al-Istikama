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
 * Strings for component 'customcertelement_daterange', language 'fr', version '5.1'.
 *
 * @package     customcertelement_daterange
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addrange'] = 'Ajouter une autre plage';
$string['completiondate'] = 'Date d’achèvement';
$string['courseenddate'] = 'Date de fin de cours';
$string['coursegradedate'] = 'Course grade date';
$string['coursestartdate'] = 'Date de début du cours';
$string['currentdate'] = 'Date actuelle';
$string['dateitem'] = 'Date item';
$string['dateitem_help'] = 'Ce sera la date qui sera imprimée sur le certificat.';
$string['dateranges'] = 'Plages de dates';
$string['datestring'] = 'Chaîne de caractères';
$string['end'] = 'Fin';
$string['error:atleastone'] = 'You must have at least one date range configured';
$string['error:datestring'] = 'Vous devez fournir une représentation sous forme de chaîne de caractères pour la plage de dates';
$string['error:enddate'] = 'La date de fin doit être postérieure à la date de début';
$string['error:recurring'] = 'La période de récurrence ne doit pas dépasser 12 mois.';
$string['fallbackstring'] = 'Chaîne de repli';
$string['fallbackstring_help'] = 'Cette chaîne sera affichée si aucune plage de dates ne s\'applique à une date. Si la chaîne de remplacement n\'est pas définie, il n\'y aura pas d\'affichage du tout.';
$string['help'] = 'Configurer une représentation sous forme de chaîne pour vos plages de dates.<br /><br />Si vos plages se chevauchent, la première plage de dates correspondantes sera appliquée.';
$string['issueddate'] = 'Date d\'émission';
$string['placeholders'] = 'Les espaces réservés suivants peuvent être utilisés dans la représentation sous forme de chaîne ou dans la chaîne de secours.  <br/><br /> {{range_first_year}} - première année de la période correspondante,<br/>  {{range_last_year}} - dernière année de la période de référence,<br/>  {{recurring_range_first_year}} - première année de la période récurrente correspondante,<br/> {{current_year}} - l\'année en cours,<br/>  {{date_year}} - l\'année de la date de l\'utilisateur.';
$string['pluginname'] = 'Plage de dates';
$string['preview'] = 'Aperçu {$a}';
$string['privacy:metadata'] = 'Le plugin Date range n’enregistre aucune donnée personnelle.';
$string['recurring'] = 'Récurrent';
$string['recurring_help'] = 'Si vous marquez une plage de dates comme récurrente, l\'année configurée ne sera pas prise en compte.';
$string['setdeleted'] = 'Supprimer';
$string['start'] = 'Démarrage';
