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
 * Strings for component 'factor_role', language 'fr', version '5.1'.
 *
 * @package     factor_role
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Rôles';
$string['privacy:metadata'] = 'Le plugin Facteur rôles n’enregistre aucune donnée personnelle.';
$string['settings:description'] = 'Sélectionner les rôles devant utiliser des facteurs supplémentaires pour se connecter. Si ce facteur n’est pas activé, tous les rôles devront utiliser un facteur supplémentaire.';
$string['settings:roles'] = 'Rôles qui ne passent pas';
$string['settings:roles_help'] = 'Sélectionner les rôles qui ne passeront pas ce facteur. Ceci permet de forcer ces rôles à utiliser d’autres facteurs pour s’authentifier.';
$string['settings:shortdescription'] = 'Indiquer les utilisateurs devant utiliser d’autres facteurs pour s’authentifier, selon leur rôle. Doit être combiné avec d’autres facteurs.';
$string['summarycondition'] = 'n’a aucun de ces rôles attribué dans aucun contexte : {$a}';
