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
 * Strings for component 'logstore_socialflow', language 'fr', version '5.1'.
 *
 * @package     logstore_socialflow
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['buffersize'] = 'taille d';
$string['configloglifetime_descr'] = 'Ce paramètre spécifie la durée de conservation des journaux des activités liées aux cours. Les journaux sont supprimés lorsqu\'une action n\'a plus été réalisée par aucun participant pendant cette durée.';
$string['loglifetime'] = 'Conserver les journaux pendant';
$string['pluginname'] = 'Journaux de flux social';
$string['privacy:metadata'] = 'Ce plugin n\'enregistre aucune donnée personnelle.';
$string['privacy:metadata:contextid'] = 'Le contexte dans lequel l\'événement enregistré s\'est déroulé.';
$string['privacy:metadata:courseid'] = 'Le cours associé à l\'événement enregistré.';
$string['privacy:metadata:eventid'] = 'L\'identifiant de la définition d\'événement associé à l\'entré de journaux.';
$string['privacy:metadata:log'] = 'Un ensemble d\'événements passés';
$string['privacy:metadata:log:eventid'] = 'L\'id de l\'événement';
$string['privacy:metadata:log:timecreated'] = 'Le moment précis auquel l\'événement est survenu.';
$string['privacy:metadata:log:userid'] = 'L\'ID de l\'utilisateur qui a lancé l\'événement.';
$string['privacy:metadata:logstore'] = 'Ce plugin enregistre des données liées aux interactions utilisateurs et définies dans le Flux Social.';
$string['privacy:metadata:timecreated'] = 'Le moment précis auquel l\'événement a été enregistré.';
$string['privacy:metadata:userid'] = 'L\'ID de l\'utilisateur qui a lancé l\'événement.';
$string['setting_course_ids'] = 'course_ids';
$string['setting_course_ids_descr'] = 'À utiliser avec l\'option log_scope « include » ou « exclude » pour le suivi de cours spécifiques uniquement. Exemple : <code>10,103,102</code>';
$string['setting_log_scope'] = 'log_scope';
$string['setting_log_scope_all'] = 'Enregistre les événements dans tous les cours';
$string['setting_log_scope_descr'] = 'Definit l\'étendue du processus d\'enregistrement des journaux. Par défaut, les données de tous les cours sont enregistrées.';
$string['setting_log_scope_exclude'] = 'Enregistrer les événements en EXCLUANT les cours définis via les course_ids ci-dessous';
$string['setting_log_scope_include'] = 'Enregistrer les événements seulement dans les cours spécifiés via les course_ids ci-dessous';
$string['setting_nontracking_roles'] = 'rôles non enregistrés';
$string['setting_nontracking_roles_descr'] = 'Définit les rôles qui ne doivent <strong>pas</strong> être suivis (blacklist).
C\'est utile pour exclure certains rôles du suivi (comme les enseignants). Spécifier le rôle en utilisant le « shortname » (visible via <em>Administration du site</em> > <em>Utilisateurs</em> > <em>Permissions</em> > <em>Définir les rôles</em>). Par défaut, seul le rôle étudiant « student » est suivi. Exemple : <code>teacher,editingteacher,manager</code>. Ce paramètre est prioritaire sur <code>les rôles suivis</code>.';
$string['setting_tracking_roles'] = 'rôles suivis';
$string['setting_tracking_roles_descr'] = 'Définit les rôles qui doivent être suivis (whitelist).  Spécifier le rôle en utilisant son « shortname » (visible via <em>Administration du site</em> > <em>Utilisateurs</em> > <em>Permissions</em> > <em>Définir les rôles</em>).  Par défaut, seul le rôle étudiant « student » est suivi. Exemple : <code>student,guest</code>';
$string['taskcleanup'] = 'Nettoyage de la table de flux social';
$string['taskhits'] = 'Mise à jour des données d\'information sur les hits';
$string['tasknbpa'] = 'Mise à jour des informations sur le nombre de participants';
