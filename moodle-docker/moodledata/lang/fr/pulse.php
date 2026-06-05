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
 * Strings for component 'pulse', language 'fr', version '5.1'.
 *
 * @package     pulse
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actions'] = 'Actions';
$string['apply_customize'] = 'Appliquer et personnaliser';
$string['apply_save'] = 'Appliquer et enregistrer';
$string['approve'] = 'Approuver';
$string['approved'] = 'Approuvé';
$string['approvedby'] = 'approuvé par';
$string['approvedeclined'] = 'Approbation refusée';
$string['approvedon'] = 'Approuvé le {$a->date} par {$a->user}';
$string['approvedsuccess'] = 'Approbation acceptée';
$string['approveduser'] = 'Approuvé par {$a->user}';
$string['approveuser'] = 'Approuver les utilisateurs - {$a->course}';
$string['approveuserbtn'] = 'Approuver les utilisateurs';
$string['box'] = 'Zone';
$string['boxicon'] = 'Icône de zone';
$string['boxtype'] = 'Type de zone';
$string['completereaction'] = 'Réaction complète';
$string['completewhenavaialble'] = 'Achèvement lorsque disponible';
$string['completewhenavaialble_help'] = 'Si cette option est activée, l’activité sera considérée comme terminée lorsque l’utilisateur y aura accès (c’est-à-dire lorsqu’elle sera disponible en fonction des restrictions de disponibilité).';
$string['completion:approval'] = 'Approbation requise';
$string['completion:available'] = 'Les restrictions doivent être respectées';
$string['completion:self'] = 'Marquer comme terminé';
$string['completionapproverules'] = 'Règles d’approbation d’achèvement';
$string['completioncriteria'] = 'Critères de réalisation';
$string['completionfor'] = 'achèvement pour';
$string['completionrequireapproval'] = 'Exiger l’approbation de l’un des rôles suivants';
$string['completionrequireapproval_help'] = 'Si cette option est activée, l’activité sera considérée comme terminée lorsque l’un des rôles sélectionnés aura approuvé l’utilisateur.';
$string['completionself'] = 'Marquer comme terminé par l’étudiant pour achever cette activité';
$string['completionself_help'] = 'Si cette option est activée, l’activité sera considérée comme terminée lorsque l’étudiant la marquera comme achevée sur la page du cours.';
$string['configintro'] = 'Paramètres de configuration globaux pour Pulse';
$string['configparams'] = 'Paramètres de configuration';
$string['configrableparams'] = 'Paramètres configurables';
$string['confirmdeletetemplate'] = 'Voulez-vous vraiment supprimer le préréglage ?';
$string['content'] = 'Contenu';
$string['content_help'] = 'Le contenu sera affiché sur la page du cours et utilisé comme contenu du corps du message pour l’invitation.';
$string['courserole'] = 'rôle dans le cours';
$string['createpreset'] = 'Créer un préréglage';
$string['creditesgroup'] = 'Points de crédit';
$string['credits'] = 'Crédits';
$string['creditsfield'] = 'Champ de profil pour les crédits utilisateurs';
$string['creditsfielddesc'] = 'Sélectionner l’un des champs de profil personnalisé de l’utilisateur pour conserver les enregistrements de crédits utilisateur. <br>
Remarque : verrouiller le champ sélectionné pour les étudiants afin d’éviter que ceux-ci ne modifient leurs cotes de crédit.';
$string['cssclass'] = 'Classe CSS';
$string['danger'] = 'Danger';
$string['dark'] = 'Sombre';
$string['decline'] = 'Refus';
$string['declined'] = 'Refusé';
$string['deletepreset'] = 'Supprimer le modèle prédéfini Pulsepro';
$string['description'] = 'Description';
$string['detailedlog'] = 'Afficher le journal détaillé pour la tâche planifiée — à utiliser uniquement à des fins de dépannage et à désactiver sur un site en production';
$string['diffnotification'] = 'Utiliser le contenu de notification au lieu du contenu général';
$string['diffnotification_help'] = 'Si cette option est activée, l’invitation utilisera le contenu et le sujet de la notification (au lieu du contenu général et du titre).';
$string['disabled'] = 'Désactivé';
$string['dislike'] = 'Ne pas aimer';
$string['displaymode'] = 'Mode d’affichage';
$string['displaytype:contentonly'] = 'Contenu uniquement';
$string['displaytype:notificationcontent'] = 'Les deux';
$string['displaytype:notificationonly'] = 'Notification uniquement';
$string['enable:disable'] = 'Activer / Désactiver';
$string['enabled'] = 'Activé';
$string['enablereminder:first'] = 'Activer le premier rappel';
$string['enablereminder:first_help'] = 'En cas d’activation, Pulse enverra le premier rappel.';
$string['enablereminder:invitation'] = 'Activer les invitations';
$string['enablereminder:recurring'] = 'Activer le rappel récurrent';
$string['enablereminder:recurring_help'] = 'En cas d’activation, Pulse enverra un rappel récurrent aux destinataires sélectionnés. Des rappels récurrents seront envoyés à l’utilisateur dans l’intervalle donné jusqu’à ce que l’utilisateur ne soit plus inscrit ou suspendu.';
$string['enablereminder:second'] = 'Activer le deuxième rappel';
$string['enablereminder:second_help'] = 'Si cette option est activée, Pulse enverra un deuxième rappel aux destinataires sélectionnés en fonction du calendrier.';
$string['enrolmentemptyenddate'] = '-';
$string['enrolmentemptystartdate'] = '-';
$string['generatereport'] = 'Générer un rapport';
$string['head:firstreminder'] = 'Premier rappel';
$string['head:recurringreminder'] = 'Rappel récurrent';
$string['head:secondreminder'] = 'Deuxième rappel';
$string['instancename'] = 'Pulse';
$string['instruction'] = 'Instruction';
$string['invitation'] = 'Invitation';
$string['invitation_help'] = 'Envoyer l’invitation à tous les utilisateurs avec les rôles sélectionnés.';
$string['invitationdbpro'] = 'Invitation envoyée à l’utilisateur non insérée. Veuillez vérifier pulsepro';
$string['invitationnotsend'] = 'Invitation non envoyée à l’utilisateur';
$string['invitationsubject'] = 'Objet de la notification';
$string['invitationsubject_help'] = 'Ajouter le sujet de l’invitation ici.';
$string['learnmore'] = 'En savoir plus';
$string['light'] = 'Clair';
$string['like'] = 'Aimer';
$string['logintoreact'] = 'Connectez-vous avant de réagir';
$string['markcomplete'] = 'Marquer comme achevé';
$string['messageprovider:mod_pulse'] = 'Envoyer une notification';
$string['modulename'] = 'Pulse';
$string['modulename_help'] = 'Pulse est le couteau suisse de l’enseignant pour améliorer l’engagement et le respect des étudiants dans les cours Moodle :
<ul><li><strong>Notifications</strong><br/>
Chaque activité Pulse peut être configurée pour envoyer une notification dès qu’elle devient disponible pour l’étudiant. Il existe un certain nombre d’espaces réservés qui peuvent être utilisés pour personnaliser le message, comme le prénom de l’étudiant ou le nom du cours. La notification peut être envoyée à l’étudiant, à l’enseignant, à l’enseignant non-éditeur ou au responsable. D’autres rôles de contexte de cours ou de contexte utilisateur sont également pris en charge, par ex. parent ou responsable du personnel.</li>
<li><strong>Flux de travail d’achèvement</strong><br/>
Pulse prend en charge la réalisation d’une activité de trois manières (en plus des méthodes principales de Moodle) : selon la disponibilité, lorsqu’elle est marquée comme terminée par l’étudiant et lorsqu’elle est approuvée par un autre rôle.</li></ul>
<p>Comme pour tout ce qui concerne l’automatisation, il est essentiel de réfléchir suffisamment à ce que vous voulez réellement. Idéalement, écrivez ce qui devrait se passer dans chaque cas. Cela nous aide également à vous assister ! Si cela ne fonctionne pas comme prévu, voici les problèmes les plus courants :</p>
<ul>
<li>Le cours n’a pas <b>commencé</b>. Pulse ne fonctionne que dans un cours en cours —> Vérifiez si la date de début est passée.</li>
<li>Le cours est <b>terminé</b>. Pulse ne fonctionne que dans un cours en cours —> Vérifiez si la date de fin est définie, et si c’est le cas, assurez-vous qu’elle est dans le futur.</li>
<li>Le cours compte <b>des étudiants inscrits</b>. Pulse (gratuit) ne fonctionne que pour les étudiants —> Vérifiez si le cours a réellement un utilisateur inscrit avec un statut d’inscription actif.</li>
<li>L’activité Pulse est <b>disponible</b>. Pulse ne fonctionne que si l’activité est accessible à l’étudiant. C’est le « déclencheur » ou la « condition » que nous utilisons pour déterminer si nous devons réellement faire quelque chose (par exemple, attribuer des crédits). —> Vérifiez si l’activité Pulse est masquée ou comporte une restriction qui n’est pas respectée par l’étudiant ; dans les deux cas, il est « désactivé » et ne fonctionnera pas. Si vous n’êtes pas sûr, connectez-vous simplement en tant qu’étudiant et vérifiez si l’étudiant voit l’activité Pulse - s’il la voit, elle est activée ; si l’étudiant ne le voit pas, elle est désactivée.</li>
<li>La <b>tâche cron</b> n’est pas en cours d’exécution ou n’a pas encore été exécutée : l’attribution de crédits s’effectue via une tâche planifiée. Il est donc nécessaire que la tâche cron s’exécute régulièrement. Moodle recommande chaque minute, et nous ne pouvons que vous encourager à suivre cette recommandation !</li>
</ul>';
$string['modulename_link'] = 'Pulse';
$string['modulenameplural'] = 'Pulses';
$string['noreaction'] = 'Pas de réaction';
$string['normal'] = 'Normal';
$string['notassignedgroup'] = 'L’utilisateur doit faire partie d’un groupe pour filtrer par participants.';
$string['notificationfooter'] = 'Pied de page de notification';
$string['notificationfooterdesc'] = '{$a->placeholders}';
$string['notificationheader'] = 'En-tête de notification';
$string['notificationheaderdesc'] = '{$a->placeholders}';
$string['notifyusers'] = 'Informer les étudiants du cours';
$string['notsameuser'] = 'Vous n’êtes pas le bon utilisateur pour réagir';
$string['pluginadministration'] = 'Administration de Pulse';
$string['pluginname'] = 'Pulse';
$string['preset_template'] = 'Modèle prédéfini';
$string['preset_template_help'] = 'Télécharger le fichier de sauvegarde de l’activité du cours du module Pulse';
$string['presetcreated'] = 'Préréglages de Pulse créés avec succès';
$string['presetdeleted'] = 'Préréglages supprimés avec succès';
$string['preseticon'] = 'Icône de préréglage';
$string['presetlist'] = 'Liste des préréglages';
$string['presetmodaltitle'] = 'Utiliser le préréglage {$a->title}';
$string['presetorder'] = 'Ordre des modèles prédéfinis';
$string['presets'] = 'Préréglages Pulse';
$string['presetstatus'] = 'Afficher ce préréglage dans la liste';
$string['presetupdated'] = 'Préréglages de Pulse mis à jour avec succès';
$string['previousreminders'] = 'Rappels précédents';
$string['primary'] = 'Principal';
$string['privacy:completion'] = 'Achèvement';
$string['privacy:invitation'] = 'Invitation';
$string['privacy:metadata'] = 'Le plugin Pulse n’enregistre aucune donnée personnelle.';
$string['privacy:metadata:completion:approvalstatus'] = 'Statut utilisateur approuvé';
$string['privacy:metadata:completion:approvaltime'] = 'Heure à laquelle l’utilisateur a été approuvé par un autre.';
$string['privacy:metadata:completion:approveduser'] = 'Identifiant de l’utilisateur qui a approuvé l’utilisateur étudiant';
$string['privacy:metadata:completion:selfcompletion'] = 'Statut de l’achèvement de l’utilisateur par lui-même';
$string['privacy:metadata:completion:selfcompletiontime'] = 'Heure à laquelle l’utilisateur a marqué l’activité Pulse comme terminée';
$string['privacy:metadata:completion:timemodified'] = 'Heure de fin modifiée';
$string['privacy:metadata:completion:userid'] = 'Identifiant de l’utilisateur';
$string['privacy:metadata:pulsecompletion'] = 'Achèvements d’activités Pulse par l’utilisateur';
$string['privacy:metadata:pulsemessageexplanation'] = 'Les invitations sont envoyées aux étudiants via le système de messagerie.';
$string['privacy:metadata:pulseusers'] = 'Liste des invitations d’utilisateurs notifiées';
$string['privacy:metadata:users:status'] = 'Le statut de l’invitation à rechercher la notification est précédent ou actuel';
$string['privacy:metadata:users:timecreated'] = 'Heure de l’invitation envoyée à l’utilisateur.';
$string['privacy:metadata:users:userid'] = 'Identifiant de l’utilisateur notifié';
$string['promotionaltext'] = 'Avec Pulse Pro, vous recevez des rappels puissants, des réactions par e-mail et vous pouvez créer vos propres préréglages.';
$string['pulse:addinstance'] = 'Ajouter une nouvelle activité Pulse';
$string['pulse:notifyuser'] = 'Envoyer une notification';
$string['pulse:view'] = 'Voir l’activité Pulse';
$string['pulse_subject'] = 'Pulse de {Course_FullName} ({Site_FullName})';
$string['pulsenotavailable'] = 'Instance de Pulse non ajoutée au cours';
$string['pulsenotification'] = 'Notification Pulse';
$string['rate'] = 'Taux';
$string['reaction'] = 'Réaction';
$string['reaction:approve'] = '<a href="{$a->reactionurl}" style="color: #fff;background: #0f6fc5;padding:.375rem .75rem;text-decoration-line: none;" > Approuver </a>';
$string['reaction:markcomplete'] = '<a href="{$a->reactionurl}" style="color: #fff;background: #0f6fc5;padding: .375rem .75rem;text-decoration-line: none;" >Marquer comme terminé</a>';
$string['reactiondisplaytype'] = 'Emplacement';
$string['reactiondisplaytype_help'] = 'Veuillez choisir où la réaction doit être affichée.';
$string['reactions'] = 'Réaction';
$string['reactionthankmsg'] = 'Merci ! Votre réponse est enregistrée.<br><br> <span>Vous pouvez maintenant fermer cette fenêtre</span>';
$string['reactiontype'] = 'Type';
$string['reactiontype_help'] = 'Liste des types de réactions.';
$string['recipients'] = 'Destinataires des notifications';
$string['recipients_help'] = 'Veuillez choisir les rôles auxquels vous souhaitez envoyer la notification. Seuls les utilisateurs inscrits à ce cours et avec le rôle sélectionné recevront des notifications. Veuillez noter que les utilisateurs dotés d’un rôle contextuel d’utilisateur n’ont pas besoin d’être inscrits au cours.';
$string['remindercontent'] = 'Contenu des notifications';
$string['remindercontent_help'] = 'Le contenu que vous saisissez ici sera envoyé aux destinataires.';
$string['reminders:availabletime'] = 'Durée de disponibilité';
$string['reminders:first'] = 'Premier rappel';
$string['reminders:recurring'] = 'Rappel récurrent';
$string['reminders:second'] = 'Deuxième rappel';
$string['reminderschedule'] = 'Calendrier des notifications';
$string['reminderschedule_help'] = 'Définir le type de planification de notification de rappel, <br>
                                    Si une date fixe est sélectionnée, le rappel est envoyé lorsque la date sélectionnée est atteinte. <br>
                                    Si une date relative est sélectionnée, le rappel est envoyé une fois l’heure sélectionnée écoulée. Le chronomètre démarre lorsque l’activité Pulse devient disponible pour l’utilisateur.';
$string['remindersubject'] = 'Sujet de la notification';
$string['remindersubject_help'] = 'Le contenu sera utilisé comme sujet pour les notifications de rappel.';
$string['reports'] = 'Rapports Pulse';
$string['reportsfilename'] = 'Rapports Pulse - {$a->name}';
$string['resendnotification'] = 'Renvoyer la notification';
$string['resendnotification_help'] = 'S’il est activé, le rappel d’invitation sera reprogrammé et enverra également l’invitation aux utilisateurs déjà notifiés.';
$string['resendnotificationdesc'] = 'L’invitation a été programmée pour être renvoyée';
$string['restrictionmet'] = 'Restriction respectée';
$string['schedule:fixeddate'] = 'Date fixe';
$string['schedule:relativedate'] = 'Date relative';
$string['search:activity'] = 'Pulse';
$string['secondary'] = 'Secondaire';
$string['selectpulse'] = 'Sélectionnez une instance de Pulse';
$string['self'] = 'Autonome';
$string['selfmarked'] = 'Auto-évaluation terminée le {$a->date}';
$string['sendnotificaton'] = 'Envoyer une notification Pulse';
$string['sendnotificaton_help'] = 'Si cette option est activée, l’invitation sera envoyée.';
$string['setup'] = 'Champ de configuration';
$string['setupcredit'] = 'Pour utiliser cette fonction, vous devez d’abord configurer le champ du profil de l’utilisateur.
Veuillez demander à votre administrateur local de procéder à cette configuration.';
$string['showhide'] = 'Journal détaillé';
$string['statuslabel'] = 'Activer / Désactiver';
$string['success'] = 'Succès';
$string['tasklimituser'] = 'Limiter les utilisateurs par tâche';
$string['tasklimituserdesc'] = 'Utilisez ce paramètre pour limiter le nombre d’utilisateurs traités par tâche. Réduisez le nombre d’utilisateurs si la tâche prend trop de temps à se terminer.';
$string['teacher'] = 'Enseignant';
$string['title'] = 'Titre';
$string['title_help'] = 'Le titre est utilisé comme nom d’activité. Il sert de sujet pour envoyer l’invitation.';
$string['tokenexpired'] = 'Jeton expiré ! Votre réponse n’a pas été enregistrée.';
$string['update_preset'] = 'Mettre à jour le modèle prédéfini';
$string['updatecompletion'] = 'Achèvement de la mise à jour des modules Pulse';
$string['updateusercredits'] = 'Mettre à jour les crédits utilisateur';
$string['usepreset'] = 'Utiliser le préréglage';
$string['userrole'] = 'rôle utilisateur';
$string['viewreport'] = 'Voir le rapport';
$string['warning'] = 'Avertissement';
