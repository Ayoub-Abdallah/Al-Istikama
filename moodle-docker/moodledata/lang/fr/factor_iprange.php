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
 * Strings for component 'factor_iprange', language 'fr', version '5.1'.
 *
 * @package     factor_iprange
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowedipsempty'] = 'Actuellement, personne ne passe ce facteur ! Vous pouvez ajouter votre propre adresse IP (<i>{$a->ip}</i>)';
$string['allowedipshasmyip'] = 'Votre adresse IP (<i>{$a->ip}</i>) est dans la liste et vous passerez ce facteur.';
$string['allowedipshasntmyip'] = 'Votre adresse IP (<i>{$a->ip}</i>) n’est dans la liste et vous ne passerez pas ce facteur.';
$string['pluginname'] = 'Plage IP';
$string['privacy:metadata'] = 'Le plugin Facteur plage IP n’enregistre aucune donnée personnelle.';
$string['settings:description'] = 'Activer la vérification automatique des utilisateurs par adresse IP. Ceci ne nécessite pas de configuration de la part de l’utilisateur et peut fournir une connexion sécurisée et transparente sur des réseaux fiables.';
$string['settings:safeips'] = 'Plages IP sûres';
$string['settings:safeips_help'] = 'Saisir une liste d’adresses IP ou de sous-réseaux à compter comme passant ce facteur. Si ce champ est laissé vide, personne ne passera ce facteur. {$a->info} {$a->syntax}';
$string['settings:shortdescription'] = 'Utiliser les adresses IP pour vérifier automatiquement l’identité des utilisateurs.';
$string['summarycondition'] = 'est sur un réseau sûr';
