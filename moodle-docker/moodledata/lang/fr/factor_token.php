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
 * Strings for component 'factor_token', language 'fr', version '5.1'.
 *
 * @package     factor_token
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['event:token_created'] = 'Jeton authentification multifacteur créé.';
$string['form:trust'] = 'Faire confiance à cet appareil pour {$a}.';
$string['pluginname'] = 'Faire confiance à cet appareil';
$string['privacy:metadata'] = 'Le plugin Facteur faire confiance à cet appareil n’enregistre aucune donnée personnelle.';
$string['settings:description'] = 'Permettre aux utilisateurs de contourner l’authentification multiples facteurs sur les appareils marqués comme fiables après la première authentification.';
$string['settings:expireovernight'] = 'Retirer la confiance pendant la nuit';
$string['settings:expireovernight_help'] = 'Ceci fait arriver les jetons à échéance pendant la nuit, ce qui évite aux utilisateurs d’être interrompus en milieu de journée. Au lieu de cela, il leur sera demandé une authentification multifacteur au début de la journée suivant l’échéance.';
$string['settings:expiry'] = 'Durée de confiance';
$string['settings:expiry_help'] = 'La durée pendant laquelle un appareil est considéré fiable avant de demander une nouvelle authentification multifacteur.';
$string['settings:shortdescription'] = 'Autoriser les utilisateurs à outrepasser l’authentification à partir d’appareils marqués comme fiables. Doit d’être combiné avec d’autres facteurs.';
$string['summarycondition'] = 'l’utilisateur a déjà fait confiance à cet appareil';
$string['tokenstoredindevice'] = 'L’utilisateur d’ID {$a->userid} a un jeton d’authentification multifacteur enregistré sur son appareil.<br>Information : {$a->string}.';
