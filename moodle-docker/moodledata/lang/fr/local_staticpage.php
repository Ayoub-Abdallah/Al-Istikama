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
 * Strings for component 'local_staticpage', language 'fr', version '5.1'.
 *
 * @package     local_staticpage
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['apacherewrite'] = 'Forcer l’utilisation du mod_rewrite Apache';
$string['apacherewrite_desc'] = 'Servir les pages statiques avec une URL propre, réécrite par le module mod_rewrite d’Apache. Consulter le fichier README pour plus de détails.';
$string['checkavailability'] = 'Vérifier la disponibilité';
$string['checkavailability_desc'] = 'Configurer si Moodle doit vérifier la disponibilité des fichiers statiques dans la liste des pages statiques ou non.';
$string['checkavailabilityconnecttimeout'] = 'Délai de connexion';
$string['checkavailabilityconnecttimeout_desc'] = 'Configurer le nombre maximum de secondes d’attente lors de la tentative de connexion pendant le contrôle de disponibilité. Utiliser 0 pour attendre indéfiniment.';
$string['checkavailabilityno'] = 'Non, ne pas vérifier la disponibilité';
$string['checkavailabilityresponsedisabled'] = 'Non vérifié';
$string['checkavailabilityresponseerror'] = 'Non disponible - erreur';
$string['checkavailabilityresponsefail'] = 'Non disponible - Non-2xx';
$string['checkavailabilityresponsesuccess'] = 'Disponible';
$string['checkavailabilitytimeout'] = 'Timeout';
$string['checkavailabilitytimeout_desc'] = 'Configurer le nombre maximal de secondes pendant lesquelles les fonctions cURL peuvent être exécutées pendant la vérification de la disponibilité. Utiliser 0 pour autoriser un temps d\'exécution indéfini.';
$string['checkavailabilityyes'] = 'Oui, vérifier la disponibilité';
$string['cleanhtml'] = 'Nettoyer le code HTML';
$string['cleanhtmlno'] = 'Non, ne pas nettoyer le code HTML';
$string['cleanhtmlyes'] = 'Oui, nettoyer le code HTML';
$string['documentheadingsource'] = 'Source pour l’en-tête de données du document';
$string['documentheadingsource_desc'] = 'Données utilisées dans le fichier html pour l’en-tête du document';
$string['documenttitlesource'] = 'Source pour le titre du document';
$string['documenttitlesource_desc'] = 'Données utilisées dans le fichier html pour le titre du document';
$string['documenttitlesourceh1'] = 'Premier tag H1 du code HTML de la page (généralement situé juste après l’ouverture du tag BODY)';
$string['documenttitlesourcehead'] = 'Premier tag TITLE du code HTML de la page (généralement situé entre les tags HEAD)';
$string['eventstaticpageviewed'] = 'Page statique consultée';
$string['forcelogin'] = 'Forcer la connexion';
$string['forceloginglobal'] = 'Respecter le paramètre global $CFG->forcelogin';
$string['pagenotfound'] = 'Page non trouvée';
$string['pluginname'] = 'Pages statiques';
$string['privacy:metadata'] = 'Le plugin des pages statiques offre des fonctionnalités étendues aux administrateurs de Moodle, mais n’enregistre aucune donnée personnelle.';
$string['processcontent'] = 'Contenu du traitement';
$string['processfilters'] = 'Filtres de traitement';
$string['processfiltersno'] = 'Non, pas de filtres de traitement';
$string['processfiltersyes'] = 'Oui, filtres de traitement';
$string['settingspagelist'] = 'Liste des pages statiques';
$string['settingspagelistentryfilename'] = 'Le document suivant a été trouvé :br /><strong>{$a}</strong>';
$string['settingspagelistentrypagename'] = 'A partir du nom de fichier du document, Moodle a dérivé le nom de page suivant :<br /><strong>{$a}</strong>';
$string['settingspagelistentryrewritedisabled'] = 'La page statique devrait être disponible à l\'URL propre suivante, mais n\'est pas vérifiée car la vérification de la disponibilité est désactivée : <br /><strong>{$a}</strong>';
$string['settingspagelistentryrewriteerror'] = 'La page statique devrait être disponible à l\'URL propre suivante, mais en réalité un navigateur ne sera pas en mesure de la télécharger et de la visualiser, soit en raison d\'une erreur de connexion, soit parce qu\'elle répond plus lentement que la configuration checkavailabilitytimeout (il y a peut-être un problème avec votre serveur web ou avec la configuration mod_rewrite) : <br /><strong>{$a}</strong>';
$string['settingspagelistentryrewritefail'] = 'La page statique devrait être disponible à l\'URL propre suivante, mais en réalité un navigateur ne sera pas en mesure de la télécharger et de la visualiser en raison d\'un code d\'état HTTP non-2xx (il y a peut-être quelque chose qui ne va pas avec votre serveur web ou la configuration de mod_rewrite) : <br /><strong>{$a}</strong>';
$string['settingspagelistentryrewritesuccess'] = 'La page statique est disponible et peut être liée à l\'URL propre suivante :br /><strong>{$a}</strong>';
$string['settingspagelistentrystandarddisabled'] = 'La page statique devrait être disponible à l\'URL standard suivante, mais elle n\'est pas vérifiée car le contrôle de disponibilité est désactivé :<br /><strong>{$a}</strong>';
$string['settingspagelistentrystandarderror'] = 'La page statique devrait être disponible à l\'URL standard suivante, mais en réalité un navigateur ne sera pas en mesure de la télécharger et de la visualiser, soit en raison d\'une erreur de connexion, soit parce qu\'elle répond plus lentement que la configuration checkavailabilitytimeout (il y a peut-être quelque chose qui ne va pas dans la configuration de votre serveur web) :<br /><strong>{$a}</strong>';
$string['settingspagelistentrystandardfail'] = 'La page statique devrait être disponible à l\'URL standard suivante, mais en réalité un navigateur ne sera pas en mesure de la télécharger et de la visualiser en raison d\'un code d\'état HTTP non-2xx (il y a peut-être quelque chose qui ne va pas dans la configuration de votre serveur web) :<br /><strong>{$a}</strong>';
$string['settingspagelistentrystandardsuccess'] = 'La page statique est disponible et peut être liée à l\'URL standard suivante :<br /><strong>{$a}</strong>';
$string['settingspagelistinstruction'] = 'Cette liste montre toutes les pages statiques qui ont été téléchargées dans la zone de document <a href="{$a}">pages statiques documents</a> ainsi que leurs URL.';
$string['staticpage:managedocuments'] = 'Gestion des pages statiques';
