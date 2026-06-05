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
 * Strings for component 'gamoteca', language 'fr', version '5.1'.
 *
 * @package     gamoteca
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['completionscorerequired'] = 'Score du jeu à atteindre';
$string['completionscorerequired_help'] = 'Score du jeu Gamoteca à atteindre pour marquer cette activité comme achevée';
$string['completionstatus'] = 'Réussie';
$string['completionstatusrequired'] = 'Statut du jeu à atteindre';
$string['completionstatusrequired_help'] = 'Statut du jeu Gamoteca requis pour marquer cette activité comme achevée';
$string['defaultstatus'] = 'Pas commencé';
$string['event:gamoteca_created'] = 'Module Gamoteca créé';
$string['event:gamoteca_created_desc'] = 'Le module Gamoteca avec id de module {$a->coursemoduleid} dans le cours {$a->courseid} a été créé.';
$string['event:gamoteca_deleted'] = 'Module Gamoteca supprimé';
$string['event:gamoteca_deleted_desc'] = 'Le module Gamoteca avec id de module {$a->coursemoduleid} dans le cours {$a->courseid} a été supprimé.';
$string['event:gamoteca_updated'] = 'Module Gamoteca mis à jour';
$string['event:gamoteca_updated_desc'] = 'Le module Gamoteca avec id de module {$a->coursemoduleid} dans le cours {$a->courseid} a été mis à jour.';
$string['gameotecatextmobile'] = 'Le jeu Gamoteca sera lancé dans l’application Gamoteca. Pour une expérience optimale, téléchargez l’application Gamoteca depuis l’App Store avant de lancer le jeu.';
$string['gameotecatextmobileopen'] = 'Ouvrir le jeu';
$string['gameotecatextmobilepost'] = 'Remarque : une fois inscrit ou connecté sur Gamoteca, votre compte sera lié à Moodle et votre progression et votre achèvement de jeu seront également mis à jour ici.';
$string['gamoteca:addinstance'] = 'Ajouter un lien vers un jeu sur Gamoteca';
$string['gamoteca:view'] = 'Voir le lien vers le jeu sur Gamoteca';
$string['gamotecaLinkTitlePrefix'] = '[Lancer]';
$string['gamotecanote'] = '<strong>Remarque</strong> : une fois inscrit ou connecté sur Gamoteca, votre compte sera lié à cette plateforme et votre progression et votre achèvement du jeu seront également mis à jour ici.';
$string['gamotecaurl'] = 'URL de jeu Gamoteca';
$string['gamotecaurl_help'] = 'URL du jeu sur Gamoteca';
$string['invalidurl'] = 'L’URL saisie n’est pas valide. Elle doit commencer par http:// ou https://';
$string['modulename'] = 'Gamoteca';
$string['modulename_help'] = 'Le module d’activités Gamoteca permet d’intégrer dans vos cours des jeux d’apprentissage développés sur Gamoteca.com';
$string['modulenameplural'] = 'Gamoteca';
$string['name'] = 'Jeu Gamoteca';
$string['name_help'] = 'Titre du jeu Gamoteca';
$string['openednewwindow'] = 'L’expérience d’apprentissage (jeu) Gamoteca a été ouverte dans une nouvelle fenêtre.';
$string['pluginadministration'] = 'Administration de Gamoteca';
$string['pluginname'] = 'Gamoteca';
$string['privacy:metadata:gameid'] = 'ID du module Moodle';
$string['privacy:metadata:gamotecadata'] = 'Informations sur la progression du jeu Gamoteca';
$string['privacy:metadata:gamotecadata_timecreated'] = 'Horodatage du moment où la progression du jeu a été ajoutée';
$string['privacy:metadata:gamotecadata_timemodified'] = 'Horodatage du moment où la progression du jeu a été modifiée';
$string['privacy:metadata:gamotecadataid'] = 'ID unique de la progression du jeu Gamoteca';
$string['privacy:metadata:lti_client'] = 'Afin de s’intégrer à un service LTI distant, les données utilisateur doivent être échangées avec ce service.';
$string['privacy:metadata:lti_client:courseid'] = 'L’identifiant du cours est envoyé depuis Moodle pour lier la progression.';
$string['privacy:metadata:lti_client:moduleid'] = 'L’identifiant du module est envoyé depuis Moodle pour lier la progression.';
$string['privacy:metadata:lti_client:siteshortname'] = 'Le nom court du site Moodle est envoyé depuis Moodle pour être associé au compte Gamoteca pro/entreprise correct.';
$string['privacy:metadata:lti_client:userid'] = 'L’identifiant est envoyé depuis Moodle pour vous permettre d’associer le compte sur Gamoteca.';
$string['privacy:metadata:score'] = 'Le nombre de points obtenus dans le jeu Gamoteca';
$string['privacy:metadata:timespent'] = 'Temps passé par l’apprenant depuis la dernière mise à jour de progression';
$string['privacy:metadata:userid'] = 'ID utilisateur de l’utilisateur Moodle';
$string['settings:encryption_key:helper'] = 'Cette clé sera utilisée pour crypter les détails des utilisateurs et des cours transmis entre le LMS et Gamoteca.';
$string['settings:encryption_key:title'] = 'Clé de chiffrement';
$string['usergamestate'] = 'Statut : {$a->status} / Score : {$a->score} / Temps passé : {$a->timespent}';
