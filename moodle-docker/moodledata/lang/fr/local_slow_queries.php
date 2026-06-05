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
 * Strings for component 'local_slow_queries', language 'fr', version '5.1'.
 *
 * @package     local_slow_queries
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['col_avgtime'] = 'Temps moyen (s)';
$string['col_count'] = 'Nombre';
$string['col_cron'] = 'CRON';
$string['col_origin'] = 'Trace d’exécution';
$string['col_parameters'] = 'Paramètres';
$string['col_sqlpreview'] = 'SQL';
$string['comments_title'] = 'Commentaires';
$string['detail_indexes'] = 'Index éventuellement manquants';
$string['detail_indexes_none'] = 'Aucune suggestion d’index détectée pour cette requête.';
$string['detail_indexes_notice'] = 'Les suggestions sont heuristiques. Testez avec prudence sur un environnement de préproduction et validez avec EXPLAIN/ANALYZE.';
$string['detail_sql'] = 'SQL et paramètres';
$string['detail_sql_expanded'] = 'SQL avec paramètres';
$string['detail_sql_expanded_desc'] = 'Développement au mieux pour l’analyse (affichage uniquement)';
$string['detail_title'] = 'Détails de la requête';
$string['duration_days'] = '{$a} jour(s)';
$string['duration_hours'] = '{$a} heure(s)';
$string['duration_minutes'] = '{$a} minute(s)';
$string['duration_seconds'] = '{$a} seconde(s)';
$string['filter_apply'] = 'Appliquer';
$string['filter_minexec'] = 'Temps d’exécution min (s)';
$string['filter_search'] = 'Rechercher dans le SQL';
$string['filter_search_ph'] = 'Saisir une partie du SQL à rechercher…';
$string['filter_title'] = 'Filtres';
$string['index_title'] = 'Requêtes lentes';
$string['logslow_warning_body'] = 'Cette page lit à partir de <code>mdl_log_queries</code>, mais votre site n’est pas configuré pour enregistrer les requêtes SQL lentes. Activez <code>logslow</code> dans <code>config.php</code> (définissez-le sur <code>true</code> ou sur un nombre de secondes). Exemple :';
$string['logslow_warning_current'] = 'Valeur actuelle';
$string['logslow_warning_hint'] = 'Après avoir enregistré <code>config.php</code>, reproduisez la page lente/la tâche cron, puis actualisez cette page pour voir de nouvelles entrées.';
$string['logslow_warning_title'] = 'L’enregistrement des requêtes lentes est désactivé';
$string['nav_index'] = 'Requêtes lentes';
$string['pluginname'] = 'Requêtes lentes';
$string['privacy:metadata'] = 'Le plugin Requêtes lentes n’enreigstre aucune donnée personnelle. Il affiche uniquement aux administrateurs les enregistrements existants du journal des requêtes de la base de données.';
$string['timeline_calendar'] = 'Chronologie du calendrier';
$string['timeline_last_7'] = '<strong>{$a}</strong> exécutions au cours des 7 derniers jours';
$string['timeline_scale'] = 'L’échelle correspond à 1 seconde pour {$a} pixels';
$string['timeline_title'] = 'Chronologie des requêtes';
$string['timeline_totaltime'] = 'Au total, la base de données a passé <strong>{$a}</strong> à exécuter ces instructions SQL';
