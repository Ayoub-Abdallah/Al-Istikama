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
 * Strings for component 'factor_grace', language 'fr', version '5.1'.
 *
 * @package     factor_grace
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['info'] = 'Autorise la connexion sans autre facteur pour une durée spécifiée.';
$string['pluginname'] = 'Période de tolérance';
$string['preferences'] = 'Préférences utilisateur';
$string['privacy:metadata'] = 'Le plugin Facteur période de tolérance n’enregistre aucune donnée personnelle.';
$string['redirectsetup'] = 'Vous devez terminer la configuration de l’authentification multifacteur avant de continuer.';
$string['revokeexpiredfactors'] = 'Révoquer les facteurs avec période de tolérance échue';
$string['settings:customwarning'] = 'Contenu du bandeau d’avertissement';
$string['settings:customwarning_help'] = 'Ajouter ici un texte de remplacement de la notification d’avertissement de période de tolérance avec du code HTML personnalisé. Le paramètre fictif {timeremaining} dans le texte sera remplacé par la durée de tolérance actuelle pour l’utilisateur, et {setuplink} sera remplacé par l’URL de la page de configuration pour l’utilisateur.';
$string['settings:description'] = 'Permettre aux utilisateurs de se connecter sans AFM pendant une période donnée, afin de leur donner le temps de configurer leurs facteurs d’authentification. À l’expiration de ce délai, les utilisateurs devront utiliser l’AFM pour se connecter.';
$string['settings:forcesetup'] = 'Imposer la configuration du facteur';
$string['settings:forcesetup_help'] = 'Lorsque la période de tolérance échoit, force l’utilisateur à configurer l’authentification multifacteur sur sa page de préférences. Si ce réglage est désactivé, les utilisateurs ne pourront pas se connecter à l’échéance de la période de tolérance.';
$string['settings:graceperiod'] = 'Période de tolérance';
$string['settings:graceperiod_help'] = 'Durée pendant laquelle les utilisateurs peuvent accéder au site sans facteur configuré et activé.';
$string['settings:ignorelist'] = 'Facteurs ignorés';
$string['settings:ignorelist_help'] = 'La période de tolérance ne donnera aucun point s’il y a d’autres facteurs permettant aux utilisateurs de s’authentifier avec l’authentification multifacteur. Les facteurs indiqués ici ne seront pas pris en compte par la période de tolérance pour la décision de donner de points. Ceci donne la possibilité de permettre l’authentification si un autre facteur, par exemple le courriel, a des problèmes de configuration ou d’autres problèmes.';
$string['settings:shortdescription'] = 'Permettre aux utilisateurs de se connecter sans MFA pour une durée spécifiée, afin de leur donner le temps de configurer leurs facteurs d’authentification.';
$string['setupfactors'] = 'Vous êtes actuellement dans la période de tolérance et n’avez peut-être pas assez de facteurs configurés pour vous connecter lorsque la période sera échue. Visitez {$a->url} pour vérifier votre statut d’authentification et configurez d’autres facteurs d’authentification. Votre période de tolérance arrive à échéance dans {$a->time}.';
$string['summarycondition'] = 'est dans la période de tolérance';
