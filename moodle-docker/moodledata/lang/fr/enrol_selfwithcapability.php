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
 * Strings for component 'enrol_selfwithcapability', language 'fr', version '5.1'.
 *
 * @package     enrol_selfwithcapability
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['canntenrol'] = 'L’inscription est désactivée';
$string['canntenrolcapabilitymissing'] = 'Vous ne pouvez pas vous inscrire : vous n’avez pas la capacité {$a}.';
$string['defaultrole'] = 'Rôle attribué par défaut';
$string['defaultrole_desc'] = 'Sélectionner le rôle à attribuer aux utilisateurs lors de l’auto-inscription';
$string['expirymessageenrolledbody'] = 'Bonjour {$a->user},

Ce message est une notification de la prochaine échéance le {$a->timeend} de votre inscription au cours « {$a->course} ».

Si vous avez besoin d’aide, veuillez contacter {$a->enroller}.';
$string['expirymessageenrolledsubject'] = 'Notification d’échéance d’inscription';
$string['expirymessageenrollerbody'] = 'L’inscription dans le cours « {$a->course} » arrivera à échéance dans {$a->threshold} pour les utilisateurs suivants :

{$a->users}

Pour prolonger leur inscription, visitez {$a->extendurl}';
$string['expirymessageenrollersubject'] = 'Notification d’échéance d’inscription';
$string['invalidcapability'] = 'Nom de capacité non valide : {$a}';
$string['messageprovider:expiry_notification'] = 'Notifications d’échéance d’auto-inscription avec capacité';
$string['pluginname'] = 'Auto-inscription avec capacité';
$string['pluginname_desc'] = 'Une méthode d’inscription se comportant de la même manière que l’auto-inscription standard, avec des paramètres additionnels pour obliger les utilisateurs à posséder certaines capacités pour pouvoir s’inscrire.';
$string['privacy:metadata'] = 'Le plugin Auto-inscription avec capacité n’enregistre aucune donnée personnelle.';
$string['requiredcapabilities'] = 'Capacités requises';
$string['requiredcapabilities_help'] = 'Seuls les utilisateurs possédant les capacités requises pourront s’auto-inscrire au moyen de cette méthode d’inscription.<br>
Ces capacités doivent être permises au niveau du système ou de la catégorie de cours.';
$string['selfwithcapability:config'] = 'Configurer les instances d’auto-inscription avec capacité';
$string['selfwithcapability:manage'] = 'Gérer les utilisateurs inscrits';
$string['selfwithcapability:unenrol'] = 'Désinscrire du cours les utilisateurs';
$string['selfwithcapability:unenrolself'] = 'Se désinscrire du cours';
$string['sendexpirynotificationstask'] = 'Envoi des notifications d’échéance des auto-inscriptions avec capacité';
$string['showhint'] = 'Afficher l’indice';
$string['showhint_desc'] = 'Afficher la première lettre de la clef d’inscription.';
$string['showunavailableenrolform'] = 'Afficher le formulaire d’inscription pour les instances non disponibles';
$string['showunavailableenrolform_desc'] = 'Si cette option est cochée, pour les cas où l’instance de la méthode d’inscription est indisponible, un formulaire d’inscription sera affiché replié avec un message expliquant pourquoi la méthode d’inscription est indisponible.';
$string['status'] = 'Autoriser les inscriptions existantes';
$string['status_desc'] = 'Activer l’auto-inscription avec capacité dans les nouveaux cours.';
$string['syncenrolmentstask'] = 'Tâche de synchronisation des auto-inscriptions avec capacité';
