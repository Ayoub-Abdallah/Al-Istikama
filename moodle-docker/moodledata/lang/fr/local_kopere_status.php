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
 * Strings for component 'local_kopere_status', language 'fr', version '5.1'.
 *
 * @package     local_kopere_status
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['day'] = '1 jour';
$string['days'] = '{$a} jours';
$string['down'] = 'Hors service';
$string['intervalminutes'] = 'Intervalle de vérification (minutes)';
$string['intervalminutes_desc'] = 'Temps minimum entre les cycles de vérification. La tâche planifiée s’auto-limitera selon cette valeur.';
$string['lastcheck'] = 'Dernière vérification';
$string['minute'] = '1 minute';
$string['minutes'] = '{$a} minutes';
$string['modules'] = 'Modules';
$string['modules_desc'] = 'Saisir un module par ligne. Chaque ligne sera répliquée pour les différents statuts. Par exemple, si « Inscription » et « Support » sont indiqués (un par ligne), les statuts ne seront affichés que pour « Inscription » et pour « Support ».';
$string['nodata'] = 'Aucune donnée pour le moment';
$string['overall_down'] = 'Système indisponible';
$string['overall_operational'] = 'Tous les systèmes sont opérationnels';
$string['pluginname'] = 'Statut du système';
$string['privacy:metadata'] = 'Le plugin Kopere Status n’enregistre aucune donnée personnelle.';
$string['publiclink'] = 'Page de statut publique';
$string['publictitle'] = 'Titre public';
$string['publictitle_desc'] = 'Titre affiché sur la page de statut publique.';
$string['retentiondays'] = 'Rétention (jours)';
$string['retentiondays_desc'] = 'Supprimer les lignes de regroupement horaire plus anciennes que ce nombre de jours. Les journaux bruts sont également purgés après chaque regroupement (conserver uniquement l’heure en cours pour la prochaine agrégation).';
$string['statuspagedays'] = 'Jours de la page de statut';
$string['statuspagedays_desc'] = 'Nombre de jours à afficher sur la page de statut (choisir de 1 à 7).';
$string['task_hourly_rollup'] = 'Regroupement horaire et nettoyage du StatusBoard';
$string['up'] = 'Opérationnel';
