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
 * Strings for component 'factor_admin', language 'fr', version '5.1'.
 *
 * @package     factor_admin
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['info'] = 'Ce facteur permet de compter le fait de ne pas être un administrateur comme un facteur. L’utilisation envisagée est de s’assurer qu’une sécurité plus stricte est exigée pour les administrateurs, et que les utilisateurs ordinaires obtiennent ainsi un facteur, alors que les administrateurs doivent utiliser d’autres facteurs.';
$string['pluginname'] = 'Non-administrateur';
$string['privacy:metadata'] = 'Le plugin Facteur non-administrateur n’enregistre aucune donnée personnelle.';
$string['settings:description'] = 'Tous les utilisateurs reçoivent les points de ce facteur, sauf les administrateurs du site. Ceci permet d’exiger d’autres facteurs d’authentification pour les administrateurs du site.';
$string['settings:shortdescription'] = 'Exiger des facteurs d’authentification supplémentaires pour les administrateurs.';
$string['settings:weight_help'] = 'Une pondération est donnée aux utilisateurs ordinaires pour ce facteur ; les administrateurs doivent quant à eux avoir d’autres facteurs pour s’authentifier.';
$string['summarycondition'] = 'n’est pas un administrateur';
