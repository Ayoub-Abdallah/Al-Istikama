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
 * Strings for component 'labnbook', language 'fr', version '5.1'.
 *
 * @package     labnbook
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addMission'] = 'Créer une nouvelle mission';
$string['addMission_help'] = 'Ce bouton vous permet d’accéder à l’onglet LabNBook de création de mission. Une fois la mission créée, cliquez sur « rafraichir la liste » pour pouvoir sélectionner la mission';
$string['bindaccount'] = 'Lier mon compte';
$string['cannotDeleteActivityTitle'] = 'Impossible de supprimer l’activité LabNBook.';
$string['connectaccount'] = 'Lier votre compte Moodle à LabNBook';
$string['connectaccountdetails'] = 'Pour utiliser LabNBook depuis Moodle, il faut établir un lien entre Moodle et un compte LabNBook (existant ou à créer).';
$string['deleteActivityTitle'] = 'Suppression d’une activité LabNBook';
$string['deleteActivityWithReport'] = 'Attention ! Des étudiants ont déjà commencé à travailler sur des rapports pour cette activité ! Vous ne pouvez pas supprimer cette activité sans supprimer les rapports sur LabNBook au préalable.';
$string['emailifdefined'] = 'Adresse de courriel (si définie)';
$string['enrolled_users_lnb'] = 'actuellement, {$a} étudiant a déjà lié son compte Moodle à LabNBook';
$string['enrolled_users_lnb_plural'] = 'actuellement, {$a} étudiants ont déjà lié leur compte Moodle à LabNBook';
$string['enrolled_users_moodle'] = '{$a} étudiant inscrit pour cette activité';
$string['enrolled_users_moodle_plural'] = '{$a} étudiants inscrits pour cette activité';
$string['enrolled_users_on'] = 'sur les';
$string['error_connection_to_labnbook'] = 'Impossible de se connecter à LabNBook, veuillez contacter votre administrateur';
$string['error_duplicate_teaming'] = 'Cette mission a déjà été attribuée à ce groupe dans ce cours. Il n’est pas possible d’affecter plusieurs fois une mission à un même groupe pour un cours donné. Si vous venez de supprimer une activité identique, veuillez patienter quelques minutes pour que Moodle se mette à jour';
$string['error_invalid_response'] = 'LabNBook a renvoyé une réponse invalide';
$string['error_invalid_token'] = 'LabNBook a refusé la connexion, veuillez contacter votre administrateur';
$string['external_classe'] = 'Voir la classe LabNBook utilisée';
$string['external_mission'] = 'Modifier la mission';
$string['external_reports'] = 'Voir et gérer les rapports étudiants';
$string['external_teaming'] = 'Choisir les options de mise en équipe dans LabNBook';
$string['field_required_for_method'] = 'Cette valeur doit être >0 pour cette méthode de mise en équipe';
$string['firstnameandlastname'] = 'Prénom et Nom';
$string['gotoreport'] = 'Accéder au rapport';
$string['group_for_activity'] = 'Activité à destination de';
$string['group_for_activity_help'] = 'Cette option permet de choisir les étudiants qui peuvent accéder à la mission dans LabNBook - à utiliser conjointement avec les options de restrictions d’accès ci-dessous si vous souhaitez cacher le lien Moodle aux étudiants qui n’ont pas accès à l’activité';
$string['group_is_required'] = 'Vous devez spécifier quels étudiants peuvent choisir cette activité';
$string['group_name'] = 'Groupe : {$a}';
$string['informationtransmitted'] = 'Les informations suivantes seront transmises à LabNBook :';
$string['instancename'] = 'En-tête';
$string['instancename_help'] = 'Ce texte sera affiché comme titre de l’activité dans le cours Moodle';
$string['labnbook:addinstance'] = 'Nouvelle activité LabNBook';
$string['labnbook:edit'] = 'Modifier LabNBook';
$string['labnbook:view'] = 'Voir LabNBook';
$string['labnbookSettings'] = 'Paramètres LabNBook';
$string['labnbook_api_key'] = 'Clef d’API LabNBook';
$string['labnbook_api_key_descr'] = 'La clef secrète autorisant Moodle à utiliser l’API LabNBook. Cette clef est fournie par l’instance LabNBook.';
$string['labnbook_api_url'] = 'URL LabNBook';
$string['labnbook_api_url_descr'] = 'L’url de la racine de l’API LabNBook, avec un slash final. i.e. https://uga.labnbook.fr/api/';
$string['labnbook_institution_id'] = 'Numéro de plateforme externe LabNBook';
$string['labnbook_institution_id_descr'] = 'Le numéro de plateforme externe LabNBook qui sera assigné à cette instance Moodle.';
$string['labnbook_send_user_email'] = 'Transmettre les adresses de courriels utilisateurs à LabNBook';
$string['labnbook_send_user_email_descr'] = 'Ce champ est utilisé par LabNBook pour identifier les utilisateurs afin d’éviter les doublons de comptes. Il permet aussi aux enseignants d’envoyer des courriels groupés directement depuis LabNBook.';
$string['labnbook_send_user_student_num'] = 'Transmettre les numéros étudiants des utilisateurs à LabNBook';
$string['labnbook_send_user_student_num_descr'] = 'Ce champ est utilisé par LabNBook pour identifier les utilisateurs afin d’éviter les doublons de comptes.';
$string['lnb_management_links'] = 'Autres liens LabNBook pour cette activité :';
$string['lnb_management_main_links'] = 'Finalisation de la création de l’activité LabNBook :';
$string['login'] = 'Identifiant de connexion';
$string['method'] = 'Méthode';
$string['method_help'] = 'Avec le premier choix, les étudiants vont choisir leur propre équipe s’ils n’en ont pas.\\n\\nAvec le second choix, ils seront affectés aléatoirement à une équipe (nouvelle ou existante) quand ils commenceront leur activité.\\n\\nAvec le troisième choix, seuls les enseignants peuvent gérer les équipes. La gestion des équipes ne peut alors être effectuée que depuis LabNBook.\\n\\nLe nombre d’équipe et leur taille sont contrôlés par les prochains réglages';
$string['missingidandcmid'] = 'id et cmid manquants';
$string['mission'] = 'Mission';
$string['mission_help'] = 'Choisir une de vos missions dans LabNBook. Si vous créez une mission LabNBook, utiliser le bouton « Mise à jour des missions » pour rafraichir la liste.';
$string['modulename'] = 'LabNBook';
$string['modulename_help'] = 'Cette activité Moodle va donner un accès à une mission LabNBook. Après avoir sélectionné la mission, vous allez devoir configurer la façon dont les équipes seront construites.';
$string['modulenameplural'] = 'Activités LabNBook';
$string['newmodulefieldset'] = 'LabNBook';
$string['newmodulename'] = 'Nouvelle activité LabNBook';
$string['newmodulename_help'] = 'Créer une nouvelle activité liée à une mission LabNBook.';
$string['newmodulesettings'] = 'Réglages';
$string['nonewmodules'] = 'Pas de nouveaux modules';
$string['not_part_of_group'] = 'Cette activité est restreinte à un groupe dont vous ne faites pas partie';
$string['onclickbind'] = 'En cliquant sur le bouton ci-dessous, un onglet LabNBook va être ouvert et vous permettra de faire la liaison.';
$string['pluginadministration'] = 'Administration de LabNBook';
$string['pluginname'] = 'LabNBook';
$string['privacy:comments'] = 'Commentaires';
$string['privacy:conversations'] = 'Conversations';
$string['privacy:labdocs'] = 'Labdocs';
$string['privacy:messages'] = 'Messages';
$string['privacy:metadata'] = 'Le plugin Moodle LabNBook n’enregistre aucune donnée personnelle, mais transfert les informations suivantes au serveur LabNook pour configurer les utilisateurs qui lient leur comptes : nom, prénom, login, courriel, numéro étudiant (si renseigné)';
$string['privacy:metadata:labnbook'] = 'Afin d’identifier les utilisateurs Moodle sur LabNBook, un certain nombre d’informations sont transmises au serveur LabNBook pour les utilisateurs ayant lié leurs comptes.';
$string['privacy:metadata:labnbook:email'] = 'Courriel de l’utilisateur ayant lié son compte à LabNBook';
$string['privacy:metadata:labnbook:firstname'] = 'Prénom de l’utilisateur ayant lié son compte à LabNBook';
$string['privacy:metadata:labnbook:idnumber'] = 'Numéro étudiant de l’utilisateur ayant lié son compte à LabNBook';
$string['privacy:metadata:labnbook:lastname'] = 'Nom de l’utilisateur ayant lié son compte à LabNBook';
$string['privacy:metadata:labnbook:username'] = 'Identifiant de l’utilisateur ayant lié son compte à LabNBook';
$string['privacy:reports'] = 'Rapports';
$string['refresh'] = 'Actualiser la liste des missions';
$string['refresh_help'] = 'Rafraîchir la liste des missions disponibles en interrogeant la plateforme LabNBook';
$string['reports_started'] = '{$a} rapport commencé';
$string['reports_started_plural'] = 'actuellement, {$a} rapports commencés';
$string['reports_submitted'] = 'dont {$a} rendu';
$string['reports_submitted_plural'] = 'dont {$a} rendus';
$string['restricted_to_group'] = 'Accès restreint au groupe "{$a}"';
$string['size_max'] = 'Taille maximale';
$string['size_min'] = 'Taille minimale';
$string['size_opt'] = 'Taille optimale';
$string['size_opt_help'] = 'La taille d’équipe qui serait optimale. Les tailles minimales et maximales seront déduites à partir de cette valeur si elles ne sont pas spécifiées';
$string['studentnumber'] = 'Numéro étudiant (si défini)';
$string['team_config_init'] = 'Vous devez maintenant configurer la mise en équipe dans LabNBook. Si vous n’êtes pas redirigé automatiquement, cliquez sur le lien « Choisir les options de mise en équipe dans LabNBook »';
$string['teamconfigmethod_random'] = 'Distribution aléatoire';
$string['teamconfigmethod_students'] = 'Au choix des étudiants';
$string['teamconfigmethod_teacher'] = 'Au choix de l’enseignant (géré dans LabNBook)';
$string['teaming'] = 'Paramètre de la mise en équipe';
$string['teams_max'] = 'Nombre maximum d’équipes';
$string['teams_max_help'] = 'Il n’y aura jamais plus que ce nombre d’équipes, sauf si un enseignant en crée plus manuellement.';
$string['view'] = 'Voir';
