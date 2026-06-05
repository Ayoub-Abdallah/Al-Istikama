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
 * Strings for component 'report_sphorphanedfiles', language 'fr', version '5.1'.
 *
 * @package     report_sphorphanedfiles
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accessruleviolationmessage'] = 'Le rapport n’est pas activé ou la capacité est manquante';
$string['confighandleractivitiescore'] = 'Toutes les <b>activités standard de Moodle</b> ne prennent pas en charge la description d’introduction (ex. : étiquette). Cette liste séparée par des virgules d’activités standard de Moodle sera vérifiée pour les fichiers orphelins dans la description d’introduction. Si de nouvelles activités standard sont ajoutées à votre Moodle, il faudra les ajouter à cette liste.';
$string['confighandleractivitiesplugin'] = 'Toutes les <b>activités non standard</b> ne prennent pas en charge la description d’introduction. Cette liste séparée par des virgules d’activités non standard sera vérifiée pour les fichiers orphelins dans la description d’introduction. Si de nouvelles activités non standard sont ajoutées à votre Moodle, il faudra les ajouter à cette liste si elles prennent en charge la description d’introduction.';
$string['confighandlermaterialscore'] = 'Toutes les <b>ressources standard de Moodle</b> ne prennent pas en charge la description d’introduction. Cette liste séparée par des virgules de ressources standard de Moodle sera vérifiée pour les fichiers orphelins dans la description d’introduction. Si de nouvelles ressources standard sont ajoutées à votre Moodle, il faudra les ajouter à cette liste si elles prennent en charge la description d’introduction.';
$string['confighandlermaterialsplugin'] = 'Toutes les <b>ressources non standard</b> ne prennent pas en charge la description d’introduction. Cette liste séparée par des virgules de ressources non standard sera vérifiée pour les fichiers orphelins dans la description d’introduction. Si de nouvelles ressources non standard sont ajoutées à votre Moodle, il faudra les ajouter à cette liste si elles prennent en charge la description d’introduction.';
$string['configisactive'] = 'Lorsque le rapport est activé, il peut être lancé dans la navigation du cours.';
$string['configisactiveforadmin'] = 'Lorsque le rapport est activé, un administrateur peut le lancer dans la navigation du cours, quelle que soit la situation d’activation pour les utilisateurs normaux.';
$string['deleteMessage'] = 'Fichier orphelin supprimé avec succès';
$string['description'] = 'Si un enseignant ajoute un fichier à l’éditeur et supprime le fichier, celui-ci reste néanmoins stocké en arrière-plan de ce contexte (ex. : étiquette). L’enseignant peut supprimer le fichier avec la boîte de dialogue "gérer les fichiers" dans l’éditeur. Ce n’est pas très pratique. Ce rapport aide à montrer les fichiers orphelins qui pourraient ne pas être utilisés dans les descriptions des activités ou des ressources, et aide à les supprimer.';
$string['handleractivitiescore'] = 'Vérifier cette activité standard de Moodle pour les fichiers orphelins dans la description d’introduction';
$string['handleractivitiesplugin'] = 'Vérifier cette activité non standard de Moodle pour les fichiers orphelins dans la description d’introduction';
$string['handlermaterialscore'] = 'Vérifier ces ressources standard de Moodle pour les fichiers orphelins dans la description d’introduction';
$string['handlermaterialsplugin'] = 'Vérifier ces ressources non standard de Moodle pour les fichiers orphelins dans la description d’introduction';
$string['header.code'] = 'Code source :';
$string['header.content'] = 'Contenu';
$string['header.filename'] = 'Nom de fichier';
$string['header.modName'] = 'Module';
$string['header.moduleContent'] = 'Description…';
$string['header.preview'] = '';
$string['header.tool'] = 'supprimer des fichiers sans demande !';
$string['invalidcourseidmessage'] = 'id de cours invalide';
$string['isactive'] = 'Activer le rapport';
$string['isactiveforadmin'] = 'Activer le rapport pour l’administrateur du site';
$string['isallowedtodeleteallfiles'] = 'L’utilisateur est autorisé / dispose de la capacité de supprimer tous les fichiers dans ce cours';
$string['isgridlayoutfilehint'] = 'Ce fichier a peut-être été utilisé par le plugin de mise en page en grille mais semble ne pas être utilisé.';
$string['pluginname'] = 'Rapport des fichiers orphelins';
$string['sphorphanedfiles:delete'] = 'Capacité d’ajouter une icône à chaque fichier orphelin afin de pouvoir supprimer les fichiers.';
$string['sphorphanedfiles:view'] = 'Capacité de visualiser ce rapport.';
