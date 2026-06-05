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
 * Strings for component 'report_coursesize', language 'fr', version '5.1'.
 *
 * @package     report_coursesize
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['alwaysdisplaymb'] = 'Toujours afficher en Mo';
$string['alwaysdisplaymb_desc'] = 'Si activé, l’information du cours sera toujours affichée en Mo.';
$string['backupsize'] = 'Poids des sauvegardes';
$string['bytes'] = 'octets';
$string['cachedef_topuserdata'] = 'Informations en cache sur les utilisateurs principaux.';
$string['calcmethod'] = 'Calcul du rapport';
$string['calcmethodcron'] = 'Par une tâche programmée';
$string['calcmethodhelp'] = 'S’il est calculé par une tâche programmée, le rapport sera généré à l’heure programmée et mettra les résultats en cache pour une consultation ultérieure. Ceci est recommandé par rapport aux calculs en temps réel effectués au chargement de la page, car la charge du site sera pendant une période de faible activité, une seule fois par jour.
Soyez particulièrement vigilant avec les calculs en temps réel, car les requêtes de base de données volumineuses peuvent fortement impacter la charge du serveur et ralentir l’ensemble de l\'instance. L’activation de cette fonctionnalité est déconseillée sur les instances contenant plus de 10 000 enregistrements de fichiers ; nous vous encourageons plutôt à utiliser les calculs quotidiens effectués par tâche programmée.';
$string['calcmethodlive'] = 'Lors du chargement de la page';
$string['coursefilearea'] = 'Zone des fichiers de cours';
$string['coursereport'] = 'Rapport de l’usage des cours';
$string['coursesize'] = 'Poids des cours';
$string['coursesize:view'] = 'Voir le rapport des poids de cours';
$string['disabledcap'] = 'Désactivé';
$string['diskusage'] = 'Usage disque';
$string['displaysize'] = 'Afficher les poids comme :';
$string['emailrecipients'] = 'Destinataires du courriel';
$string['emailrecipients_desc'] = 'Une liste d’adresses de courriel, séparées par des virgules, auxquelles envoyer le rapport de stockage chaque jour.';
$string['enabledcap'] = 'Activé';
$string['excludebackup'] = 'Exclure les sauvegardes :';
$string['excludebackups'] = 'Exclure les sauvegardes';
$string['excludebackups_desc'] = 'Si activé, une option sera disponible pour exclure les sauvegardes des détails de poids des cours.';
$string['export'] = 'Exporter';
$string['exporttocsv'] = 'Exporter comme fichier CSV';
$string['exporttoexcel'] = 'Exporter comme fichier Excel';
$string['granularcomponent'] = 'Composant';
$string['granularfilearea'] = 'Zone de fichier';
$string['granularfilename'] = 'Nom de fichier';
$string['granularfilesize'] = 'Poids de fichier';
$string['granularfiletype'] = 'Type';
$string['granularlink'] = 'Détails';
$string['granularnofiles'] = 'Aucun fichier à voir dans le cours sélectionné.';
$string['granularusername'] = 'Nom d’utilisateur';
$string['lastcalculated'] = 'Poids des catégories et cours calculés par une tâche programmée à :';
$string['livecalc'] = 'Calculs en direct :';
$string['nevercap'] = 'Jamais';
$string['numberofusers'] = 'Nombre d’utilisateurs principaux';
$string['numberofusers_desc'] = 'Nombre d’utilisateurs principaux à afficher.';
$string['pluginname'] = 'Poids des cours';
$string['pluginsettings'] = 'Réglages Poids des cours';
$string['privacy:metadata:report_coursesize_users'] = 'Utilisateurs Poids des cours.';
$string['privacy:metadata:userid'] = 'ID utilisateur';
$string['salphan'] = 'A-Z (nom complet du cours)';
$string['salphas'] = 'A-Z (nom court du cours)';
$string['sharedusagecourse'] = 'Usage partagé';
$string['showcoursecomponents'] = 'Afficher les composants de cours';
$string['showcoursecomponents_desc'] = 'Si activé, une option supplémentaire dépliable sera disponible pour afficher les détails de poids de fichiers par composant.';
$string['showgranular'] = 'Affichage granulaire';
$string['showgranular_desc'] = 'Si activé, un détail précis des fichiers par cours sera disponible, avec les poids des fichiers.';
$string['sizeauto'] = 'Auto';
$string['sorder'] = 'Ordre de tri Moodle';
$string['sortby'] = 'Trier par :';
$string['sortdir'] = 'Sens du tri :';
$string['ssize'] = 'Poids';
$string['tab_courses'] = 'Poids du cours';
$string['tab_users'] = 'Top utilisateurs par usage';
$string['taskcalculate'] = 'Calculer le poids des cours';
$string['tasksendreport'] = 'Envoyer le rapport d’usage du disque';
$string['tbsize'] = 'Seulement le poids des sauvegardes de cours';
$string['tcategories'] = 'Catégorie complète';
$string['tcourse'] = 'Cours';
$string['tcsize'] = 'Poids total du cours (excluant les sauvegardes de cours)';
$string['tdtoggle'] = 'Basculer';
$string['topusers'] = 'Utilisateurs (top {$a})';
$string['totalfilesize'] = 'Poids de fichiers total';
$string['tsize'] = 'Poids';
$string['ttitle'] = 'Catégorie de cours';
$string['ttsize'] = 'Poids total du cours (incluant les sauvegardes de cours)';
$string['uniquefilesize'] = 'Poids total des fichiers uniques';
$string['userfilesize'] = 'Poids des fichiers utilisateur';
$string['viewcoursestats'] = 'Voir les statistiques';
