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
 * Strings for component 'filter_moddata', language 'fr', version '5.1'.
 *
 * @package     filter_moddata
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['databasenotfound'] = 'Impossible de trouver l’activité Base de données nommée « {$a} » dans le cours courant.';
$string['datasetnotfound'] = 'Impossible de trouver un jeu de données pour l’utilisateur courant.';
$string['datasetrecordsnotfound'] = 'Impossible de trouver les données pour le jeu de données « {$a} » dans l’activité Base de données spécifiée.';
$string['filtername'] = 'Jeux de données';
$string['recordnotfound'] = 'Impossible de trouver le champ `{$a->fieldname}` pour l\'élément `{$a->itemname}` dans le jeu de données `{$a->datasetname}`.';
$string['requiredfieldsnotfound'] = 'Impossible de trouver les champs requis. Pour afficher cet élément, l’activité Base de données doit contenir a minima les champs « {$a->field1} », « {$a->field2} », et « {$a->field3} ».';
$string['toomanyrecordsfound'] = 'Trop d’enregistrements trouvés pour l’élément « {$a->itemname} » dans le jeu de données « {$a->datasetname} »';
