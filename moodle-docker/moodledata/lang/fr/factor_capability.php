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
 * Strings for component 'factor_capability', language 'fr', version '5.1'.
 *
 * @package     factor_capability
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['capability:cannotpassfactor'] = 'Doit utiliser un autre facteur AMF pour s’authentifier.';
$string['pluginname'] = 'Capacité utilisateur';
$string['privacy:metadata'] = 'Le plugin Facteur capacité utilisateur n’enregistre aucune donnée personnelle.';
$string['settings:adminpasses'] = 'Les administrateurs peuvent passer ce facteur';
$string['settings:adminpasses_help'] = 'Par défaut, les administrateurs passent toutes les vérifications de capacité, y compris celui-ci, qui utilise la capacité « factor/capability:cannotpassfactor », ce qui signifie qu’ils échoueront à ce facteur. Si ce réglage est activé, tous les administrateurs du site passeront ce facteur s’ils n’ont pas hérité cette capacité d’un autre rôle. S’il n’est pas activé, les administrateurs échoueront à ce facteur.';
$string['settings:description'] = '<p>Utiliser la capacité factor/capability:cannotpassfacto pour spécifier les utilisateurs devant utiliser un autre facteur pour s’authentifier.</p>
<p>Autoriser cette capacité à des rôles spécifiques dans <a href="roles/manage.php">Définir les rôles</a> page.</p>';
$string['settings:shortdescription'] = 'Indiquer les utilisateurs devant utiliser d’autres facteurs pour s’authentifier. Doit être combiné avec d’autres facteurs.';
$string['summarycondition'] = 'n’a la capacité « factor/capability:cannotpassfactor » dans aucun rôle, y compris celui d’administrateur de site.';
