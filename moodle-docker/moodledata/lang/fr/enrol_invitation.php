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
 * Strings for component 'enrol_invitation', language 'fr', version '5.1'.
 *
 * @package     enrol_invitation
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['a_day'] = '1 jour';
$string['a_minute'] = '1 minute';
$string['about_hour'] = 'environ 1 heure';
$string['about_x_hours'] = 'environ {$a} heures';
$string['accepteddescription'] = 'L’utilisateur d’identifiant {$a->userid} a accepté une invitation pour le cours d’identifiant « {$a->courseid} ».';
$string['action_extend_invite'] = 'Prolonger l’invitation';
$string['action_resend_invite'] = 'Renvoyer l’invitation';
$string['action_revoke_invite'] = 'Révoquer l’invitation';
$string['anonymoususer'] = '(inconnu)';
$string['assignrole'] = 'Attribuer le rôle';
$string['customnamecourse'] = 'Format personnalisé';
$string['customsubjectformat'] = '{$a->shortname} - {$a->fullname}';
$string['default_subject'] = 'Invitation au cours : {$a}';
$string['defaultinvitevalues'] = 'Valeurs par défaut de l’invitation';
$string['defaultsubjectformat'] = 'Format par défaut du sujet';
$string['defaultsubjectformat_desc'] = 'Ce format de nom de cours par défaut sera utilisé dans le sujet lors de l’envoi de courriels d’invitation. Ceci n’affecte que les instances de la méthode d’inscription au moment où elles sont créées. En sélectionnant <strong>format personnalisé</strong>, vous pouvez <a href="../admin/tool/customlang/">personnaliser la chaîne de langue <strong>« customsubjectformat »</strong> du plugin <strong>enrol_invitation</strong> en utilisant n’importe quelle combinaison de nom de cours abrégé ou non. Lorsque le plugin est installé, le format personnalisée est « shortname - fullname ».';
$string['deleteddescription'] = 'L’utilisateur d’identifiant {$a->userid} a supprimé l’invitation pour le cours d’identifiant « {$a->courseid} » à « {$a->email} ».';
$string['editenrolment'] = 'Modifier l’inscription';
$string['email_clarification'] = 'Vous pouvez spécifier plusieurs adresses courriel en les séparant par des points-virgules, des virgules, des espaces ou de nouvelles lignes.';
$string['emailaddressnumber'] = 'Adresse(s) courriel';
$string['emailmessageuserenrolled'] = 'Bonjour,

{$a->userfullname} ({$a->useremail}) a accepté votre invitation au cours {$a->coursefullname} en tant que « {$a->rolename} ». Vous pouvez vérifier l’état de cette invitation en visualisant :

* La liste des participants : {$a->courseenrolledusersurl}
* L’historique des invitations : {$a->invitehistoryurl}

{$a->sitename}
 -------------
{$a->supportemail}';
$string['emailmsghtml'] = 'Prévisualisation';
$string['emailmsghtml_help'] = '<p>Bonjour,</p>
<p>Vous êtes invité(e) à vous inscrire au cours suivant :
<ul>
    <li>Nom du cours : <b>{$a->coursename}</b></li>
    <li>Date de début : <b>{$a->start}</b></li>
    <li>Date de fin : <b>{$a->end}</b></li>
</ul>
{$a->message}
<p>Connectez-vous pour confirmer votre inscription au cours.</p>
<p>En utilisant ce lien, vous reconnaissez être l’utilisateur à qui ce courriel a été adressé et à qui cette invitation est destinée.</p>
<p><a class="btn btn-primary" href="{$a->inviteurl}">{$a->acceptinvitation}</a></p>
<p>Si vous ne souhaitez pas vous inscrire à ce cours, veuillez utiliser le lien suivant :</p>
<p><a class="btn btn-danger" href="{$a->rejecturl}">{$a->rejectinvitation}</a></p>
<p>Notez que ces liens expireront le <b>{$a->expiration}</b></p>
<p>Au plaisir de vous voir dans le cours.</p>';
$string['emailmsgunsubscribe'] = '<span class="apple-link">Si vous pensez avoir reçu ce message par erreur, si vous avez besoin d’aide ou si vous ne souhaitez pas recevoir d’autres invitations pour ce cours, veuillez contacter :</span> <a href="mailto:{$a->supportemail}">{$a->supportemail}</a>.';
$string['emailtitleuserenrolled'] = '{$a->userfullname} a accepté l’invitation au cours {$a->coursefullname}.';
$string['enrolconfimation'] = 'Exiger une confirmation de l’inscription de la part de l’étudiant';
$string['err_cohortlist'] = 'Ou vous devez sélectionner des cohortes ici.';
$string['err_userlist'] = 'Ou vous devez sélectionner des utilisateurs ici.';
$string['event_invitation_accepted'] = 'Accepter';
$string['event_invitation_attempted'] = 'Tentative';
$string['event_invitation_deleted'] = 'Supprimé';
$string['event_invitation_rejected'] = 'Rejet';
$string['event_invitation_sent'] = 'Envoyer';
$string['event_invitation_updated'] = 'Mis à jour';
$string['event_invitation_viewed'] = 'Consulté';
$string['expiredtoken'] = 'Le jeton d’invitation est expiré ou il a déjà été utilisé.';
$string['extend_invite_sucess'] = 'L’invitation a été prolongée avec succès';
$string['failuredescription'] = 'Échec : identifiant de l’utilisateur d’identifiant {$a->userid} pour l’identifiant du cours « {$a->courseid} ». Raison : {$a->errormsg}.';
$string['half_minute'] = 'une demi-minute';
$string['header_email'] = 'Qui voulez-vous inviter ?';
$string['header_role'] = 'Quel rôle souhaitez-vous attribuer à l’utilisateur invité ?';
$string['historyactions'] = 'Actions';
$string['historydateexpiration'] = 'Date d’expiration';
$string['historydatesent'] = 'Date d’envoi';
$string['historyexpires_in'] = 'Expiration dans';
$string['historyinvitee'] = 'Invité';
$string['historyrole'] = 'Rôle';
$string['historystatus'] = 'Statut';
$string['historyundefinedrole'] = 'Rôle introuvable. Veuillez renvoyer l’invitation et choisir un autre rôle.';
$string['invitation:config'] = 'Paramétrage des instances d’invitation';
$string['invitation:enrol'] = 'Inviter des utilisateurs';
$string['invitation:manage'] = 'Gérer l’attribution des invitations';
$string['invitation:unenrol'] = 'Désinscrire des utilisateurs du cours';
$string['invitation:unenrolself'] = 'Se désinscrire du cours';
$string['invitation_acceptance_title'] = 'Acceptation d’invitation';
$string['invitationacceptance'] = 'Vous êtes invité à accéder au cours <strong>{$a->coursefullname}</strong> en tant que <strong>{$a->rolename}</strong>. Veuillez confirmer votre inscription à ce cours.';
$string['invitationacceptancebutton'] = 'Accepter l’invitation';
$string['invitationrejectbutton'] = 'Refuser l’invitation';
$string['invitationrejected'] = 'Invitation refusée';
$string['invitationsuccess'] = 'Invitation envoyée avec succès';
$string['inviteexpiration'] = 'Expiration de l’invitation';
$string['inviteexpiration_desc'] = 'Durée de validité d’une invitation (en secondes). La valeur par défaut est de 2 semaines.';
$string['invitehistory'] = 'Historique d’invitation';
$string['inviteusers'] = 'Inviter des utilisateurs';
$string['invtitation_rejected_notice'] = '<p>Cette invitation a été refusée.</p>';
$string['less_minute'] = 'moins d’une minute';
$string['less_than_x_seconds'] = 'moins de {$a} secondes';
$string['loggedinnot'] = '<p>Vous devez vous connecter avant d’accepter cette invitation.</p>';
$string['message'] = 'Message';
$string['message_help_link'] = 'Voir les consignes envoyées aux invités';
$string['noenddate'] = 'Pas de date de fin';
$string['noinvitationinstanceset'] = 'Aucune instance d’inscription par invitation n’a été trouvée. Merci d’ajouter d’abord une instance d’inscription par invitation à votre cours.';
$string['noinvitehistory'] = 'Aucune invitation envoyée jusqu’à maintenant';
$string['nopermissiontosendinvitation'] = 'Vous n’êtes pas autorisé à envoyer des invitations';
$string['norole'] = 'Veuillez choisir un rôle.';
$string['notify_inviter'] = 'M’envoyer une notification à {$a->email} lorsque les utilisateurs invités acceptent cette invitation.';
$string['notsentdescription'] = 'L’utilisateur d’identifiant {a->userid} n’a pas réussi à envoyer une invitation pour le cours d’identifiant « {a->courseid} » car il n’y a pas de compte associé à l’adresse de courriel « {a->email} ».';
$string['pluginname'] = 'Invitation';
$string['pluginname_desc'] = 'Le module d’invitation permet d’envoyer des invitations par courriel. Ces invitations ne peuvent être utilisées qu’une seule fois. Les utilisateurs cliquent sur le lien transmis dans le courriel et sont automatiquement inscrits au cours.';
$string['registeredonly'] = 'Envoyer une invitation uniquement aux utilisateurs enregistrés';
$string['registeredonly_help'] = 'L’invitation ne sera envoyée qu’aux adresses courriel des utilisateurs enregistrés.';
$string['rejecteddescription'] = 'L’utilisateur d’identifiant {$a->userid} a refusé l’invitation au cours dont l’identifiant est « {$a->courseid} ».';
$string['reminder'] = 'Rappel :';
$string['resend_invite_sucess'] = 'L’invitation a été renvoyée avec succès';
$string['returntocourse'] = 'Retourner au cours';
$string['returntoinvite'] = 'Envoyer une nouvelle invitation';
$string['revoke_invite_sucess'] = 'Invitation révoquée avec succès';
$string['sentdescription'] = 'L’utilisateur d’identifiant {$a->userid} a envoyé à « {$a->email} » une invitation au cours dont l’identifiant est « {$a->courseid} ».';
$string['show_from_email'] = 'Permettre à l’utilisateur invité de me contacter à {$a->email} (votre adresse sera dans le champ « FROM ». S’il n’est pas sélectionné, le champ « FROM » sera {$a->supportemail})';
$string['status'] = 'Autoriser l’inscription par invitation';
$string['status_desc'] = 'Autoriser les utilisateurs à inviter des gens à s’inscrire au cours par défaut.';
$string['status_invite_active'] = 'Actif';
$string['status_invite_expired'] = 'Expiré';
$string['status_invite_invalid'] = 'Non valide';
$string['status_invite_rejected'] = 'Refusé';
$string['status_invite_resent'] = 'Renvoyé';
$string['status_invite_revoked'] = 'Révoqué';
$string['status_invite_used'] = 'Accepté';
$string['status_invite_used_expiration'] = '(l’accès se termine le {$a})';
$string['status_invite_used_noaccess'] = '(n’a plus accès)';
$string['subject'] = 'Sujet';
$string['unenrol'] = 'Désinscrire l’utilisateur';
$string['unenroluser'] = 'Voulez-vous vraiment désinscrire « {$a->user} » du cours « {$a->course} » ?';
$string['updateddescription'] = 'L’utilisateur d’identifiant {$a->userid} a lancé l’invitation pour le cours d’identifiant « {$a->courseid} » à « {$a->email} ».';
$string['used_by'] = 'par {$a->username} ({$a->roles}, {$a->useremail}) le {$a->timeused}';
$string['usedefaultvalues'] = 'Utiliser l’invitation avec les valeurs par défaut';
$string['usernotmatch'] = '<p>L’invitation est destinée à un autre utilisateur.</p>';
$string['vieweddescription'] = 'L’utilisateur d’identifiant {$a->userid} a consulté l’invitation pour le cours d’identifiant « {$a->courseid} ».';
$string['x_days'] = '{$a} jours';
$string['x_minutes'] = '{$a} minutes';
