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
 * Strings for component 'factor_auth', language 'fr', version '5.1'.
 *
 * @package     factor_auth
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['info'] = 'Vérifie comme facteur d’authentification multifacteur le type d’authentification utilisé pour se connecter.';
$string['pluginname'] = 'Type d’authentification';
$string['privacy:metadata'] = 'Le plugin Facteur type d’authentification n’enregistre aucune donnée personnelle';
$string['settings:description'] = 'Vérifier automatiquement les utilisateurs sur la base de leur type d’authentification.';
$string['settings:goodauth'] = 'Types de facteur d’authentification';
$string['settings:goodauth_help'] = 'Sélectionner tous les types d’authentification qui obtiendront des pointsà partir de ce facteur. Les autres types d’authentification ne seront pas traités comme des échecs par l’authentification multifacteur, mais n’auront pas d’effet sur la pondération des points de ce facteur.';
$string['settings:shortdescription'] = 'Permettre aux utilisateurs d’outrepasser les étapes d’authentification supplémentaires selon le type de leur authentification.';
$string['summarycondition'] = 'a un type d’authentification de {$a}';
