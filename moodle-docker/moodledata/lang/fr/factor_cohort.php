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
 * Strings for component 'factor_cohort', language 'fr', version '5.1'.
 *
 * @package     factor_cohort
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Cohortes';
$string['privacy:metadata'] = 'Le plugin Facteur cohortes n’enregistre aucune donnée personnelle.';
$string['settings:cohort'] = 'Cohorte qui ne passent pas';
$string['settings:cohort_help'] = 'Sélectionner les cohortes qui ne passeront pas ce facteur. Ceci permet de forcer ces cohortes à utiliser d’autres facteurs pour s’authentifier.';
$string['settings:description'] = '<p>Sélectionner les cohortes d’utilisateurs devant utiliser plusieurs facteurs d’authentification. Si ce facteur n’est pas configuré, toutes les cohortes devront par défaut utiliser plusieurs facteurs d’authentification.</p>
<p>Ce facteur requiert la création d’une cohorte au moins.</p>';
$string['settings:shortdescription'] = 'Indiquer les cohortes d’utilisateurs devant utiliser d’autres facteurs pour s’authentifier. Doit être combiné avec d’autres facteurs.';
$string['summarycondition'] = 'n’est membre d’aucune de ces cohortes dans aucun contexte : {$a}';
