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
 * Strings for component 'local_lockgrades', language 'fr', version '5.1'.
 *
 * @package     local_lockgrades
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['backtoform'] = 'Retour au formulaire';
$string['error_invalididnumber'] = 'Le numéro ID de la catégorie spécifié n\'a pas été trouvé.';
$string['error_noidnumber'] = 'Insérer un ID valide';
$string['idnumber'] = 'ID des catégories';
$string['lock_success'] = 'Les notes ont été verrouillées avec succès.';
$string['lockgrades'] = 'Verrouillage des notes';
$string['lockgrades:manage'] = 'Gérer le plugin Verrouillage des notes';
$string['lockgrades_info'] = '<strong>Information importante</strong><br>
Lorsque vous verrouillez une note, Moodle peut afficher un message d\'avertissement dans le carnet de notes ainsi qu\'un bouton « Recalculer quand même ».<br>
<ul>
<li>Ce message  signifie que tout changement de note effectué via une activité ne sera pas répercuté tant que la note reste verrouillée. </li>
<li>Le bouton « Recalculer quand même » permet de forcer la mise à jour des notes, même pour les éléments verrouillés.</li>
<li>Utilisez ce bouton avec prudence : toute modification forcée peut écraser une note verrouillée et provoquer une incohérence.</li>
</ul>
Ce comportement est normal et a pour but de sécuriser la gestion des notes dans Moodle.';
$string['pluginname'] = 'Verrouillage des notes';
$string['privacy:metadata'] = 'Le plugin Verrouillage des notes n\'agit que sur les notes (et n\'utilise pas de données personnelles).';
$string['unlock_success'] = 'Les notes ont été déverrouillées avec succès.';
$string['unlockgrades'] = 'Déverrouiller les notes';
