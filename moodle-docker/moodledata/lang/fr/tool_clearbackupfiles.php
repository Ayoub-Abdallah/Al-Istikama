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
 * Strings for component 'tool_clearbackupfiles', language 'fr', version '5.1'.
 *
 * @package     tool_clearbackupfiles
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['backupcompletedlog'] = 'Pendant cette opération, {$a->filecount} sauvegardes de fichiers d’une taille de totale {$a->filesize} ont été supprimées.';
$string['backupremovedlog'] = 'La sauvegarde du cours {$a->filename} d’une taille de {$a->filesize} a été supprimée.';
$string['clearbackupcompleted'] = 'Nettoyage des sauvegardes terminé';
$string['coursebackupremoved'] = 'Sauvegarde de cours supprimée';
$string['filedeletedempty'] = 'Il n’y a pas de sauvegarde à supprimer.';
$string['filedeletedfooter'] = 'En tout, {$a->filecount} sauvegardes ont été supprimées et {$a->filesize} d’espace disque a été libéré.';
$string['filedeletedheader'] = 'Les sauvegardes de cours supprimées durant cette opération sont les suivantes :';
$string['filename'] = 'Nom du fichier';
$string['filesize'] = 'Taille du fichier';
$string['pluginname'] = 'Nettoyer les sauvegardes';
$string['warningalert'] = 'Voulez-vous vraiment continuer ?';
$string['warningmsg'] = 'Veuillez prendre note que la suppression des sauvegardes est un processus irréversible. Vous ne pourrez pas récupérer les sauvegardes supprimées.';
