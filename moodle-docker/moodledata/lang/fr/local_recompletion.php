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
 * Strings for component 'local_recompletion', language 'fr', version '5.1'.
 *
 * @package     local_recompletion
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['abandoned'] = 'Abandonné';
$string['advancedrecompletiontitle'] = 'Avancé';
$string['archive'] = 'Archiver les anciennes tentatives';
$string['archivecertificate'] = 'Archiver les certificats émis (mod_certificate)';
$string['archivecertificate_help'] = 'Les certificats émis doivent-ils être archivés ?';
$string['archivechoice'] = 'Archiver les anciennes tentatives de choix';
$string['archivecompletiondata'] = 'Archiver les données d\'achèvement';
$string['archivecompletiondata_help'] = 'Écrit les données d\'achèvement dans les tableaux local_recompletion_cc, local_recompletion_cc_cc et local_recompletion_cmc. Les données d\'achèvement seront définitivement supprimées si cette option n\'est pas sélectionnée.';
$string['archivecoursecertificate'] = 'Archiver les certificats émis (mod_coursecertificate)';
$string['archivecoursecertificate_help'] = 'Les certificats émis doivent-ils être archivés ? Les certificats archivés resteront dans la table tool_certificate_issues, mais auront le statut archivé.';
$string['archivecustomcertcertificates'] = 'Archiver les certificats émis';
$string['archivecustomcertcertificates_help'] = 'Les certificats personnalisés délivrés doivent-ils être archivés ?';
$string['archiveh5p'] = 'Archiver les anciennes tentatives de H5P (mod_h5pactivity)';
$string['archivehotpot'] = 'Archive les anciennes tentatives de Hot potatoes (hotpot)';
$string['archivehvp'] = 'Archiver les anciennes tentatives de H5P (mod_hvp)';
$string['archivelesson'] = 'Archive les anciennes tentatives de leçons';
$string['archivequestionnaire'] = 'Archiver les anciennes tentatives de questionnaire';
$string['archivequiz'] = 'Archiver les anciennes tentatives de quiz (evalutation)';
$string['archivescorm'] = 'Archiver les anciennes tentatives SCORM';
$string['assignattempts'] = 'Tentatives de devoirs';
$string['assignattempts_help'] = 'Comment gérer les tentatives de devoir dans le cours. Si le paramètre « Mise à jour lors d\'un changement de note » est utilisé, lorsqu\'un enseignant met à jour la note dans une activité de devoir et que l\'utilisateur a déjà terminé le cours, la date d\'achèvement du cours sera mise à jour pour utiliser la date du changement de note du devoir.';
$string['assignevent'] = 'Mise à jour de l\'achèvement du cours en cas de changement de note.';
$string['bulkchangedate'] = 'Modifier la date d\'achèvement pour les utilisateurs sélectionnés.';
$string['bulkresetallcompletion'] = 'Réinitialiser tous les achèvements pour les utilisateurs sélectionnés';
$string['certificate'] = 'Certificats (mod_certificate)';
$string['certificate_help'] = 'Les certificats délivrés doivent-ils être supprimés ?';
$string['certificateverifywarn'] = 'Attention : la suppression des certificats délivrés sans archivage aura pour conséquence que les certificats délivrés ne pourront plus être vérifiés dans Moodle. Ne supprime les certificats que si cela est acceptable pour toi.';
$string['choiceattempts'] = 'Tentatives de choix';
$string['choiceattempts_help'] = 'Si les tentatives de choix existantes sont supprimées - si l\'option archive est sélectionnée, les anciennes tentatives de choix seront archivées dans la table local_recompletion_cha.';
$string['completed'] = 'Terminé';
$string['completionnotenabled'] = 'L\'achèvement n\'est pas activé dans ce cours.';
$string['completionreset'] = 'L\'achèvement des cours pour les étudiants sélectionnés dans ce cours a été réinitialisé.';
$string['completionresetuser'] = 'L\'achèvement pour {$a} dans ce cours a été remise à zéro.';
$string['completionupdated'] = 'Les dates de fin de cours ont été mises à jour';
$string['coursecertificate'] = 'Certificats (mod_coursecertificate)';
$string['coursecertificate_help'] = 'Les certificats délivrés doivent-ils être supprimés ?';
$string['coursecertificateverifywarn'] = 'Attention : la suppression des certificats délivrés sans archivage aura pour conséquence que les certificats délivrés ne pourront plus être vérifiés dans Moodle. Ne supprime les certificats que si cela est acceptable pour toi.';
$string['coursecompletiondate'] = 'Nouvelle date d\'achèvement du cours';
$string['customcertcertificates'] = 'Certificats personnalisés';
$string['customcertcertificates_help'] = 'Les certificats personnalisés délivrés doivent-ils être supprimés ?';
$string['customcertresetcertificates'] = 'Supprimer les certificats émis';
$string['customcertresetcertificatesverifywarn'] = 'Attention : la suppression des certificats émis, même si vous les archivez avant la suppression, aura pour conséquence que les certificats émis ne pourront plus être vérifiés dans Moodle. Veuillez ne supprimer les certificats que si cela est acceptable pour vous.';
$string['datasource:local_recompletion_cc'] = 'Archives des cours terminés';
$string['datasource:local_recompletion_ccert_is'] = 'Archive des certificats émis (mod_customcert)';
$string['datasource:local_recompletion_cert'] = 'Archive des certificats émis (mod_certificate)';
$string['datasource:local_recompletion_cmc'] = 'Archive des activités achevées';
$string['datasource:local_recompletion_h5p'] = 'Archive des tentatives de H5P (mod_h5pactivity)';
$string['datasource:local_recompletion_hpa'] = 'Archive des tentatives de hotpot';
$string['datasource:local_recompletion_lg'] = 'Archives des notes de cours';
$string['datasource:local_recompletion_qa'] = 'Archive des tentatives de quiz';
$string['datasource:local_recompletion_qg'] = 'Archive des notes de quiz';
$string['defaultsettings'] = 'Paramètres par défaut de la recomplétion';
$string['delete'] = 'Supprimer les tentatives existantes';
$string['deletecertificate'] = 'Supprimer les certificats émis';
$string['deletecoursecertificate'] = 'Supprimer les certificats émis';
$string['deletegradedata'] = 'Supprimer toutes les notes de l\'utilisateur';
$string['deletegradedata_help'] = 'Supprimer les données des notes d\'achèvement actuelles du tableau grade_grades. Les données des notes de requalification sont supprimées de manière permanente, mais elles sont conservées dans le tableau de données de l\'historique des notes.';
$string['donothing'] = 'Ne rien faire';
$string['editcompletion'] = 'Modifier la date d\'achèvement du cours';
$string['editcompletion_desc'] = 'Modifiez la date d\'achèvement du cours pour les utilisateurs suivants :';
$string['editrecompletion'] = 'Modifier les paramètres de requalification de la formation';
$string['emailrecompletiontitle'] = 'Paramètres du message de requalification personnalisé';
$string['endtime'] = 'Heure de fin';
$string['entity:local_recompletion_cc'] = 'Archiver des cours terminés';
$string['entity:local_recompletion_ccert_is'] = 'Archiver les certificats émis (mod_customcert)';
$string['entity:local_recompletion_cert'] = 'Archiver les certificats émis (mod_certificate)';
$string['entity:local_recompletion_cmc'] = 'Archiver les achèvements d\'activités';
$string['entity:local_recompletion_h5p'] = 'Archiver les tentatives de H5P (mod_h5pactivity)';
$string['entity:local_recompletion_hpa'] = 'Archiver les tentatives du module d\'activite Hotpots';
$string['entity:local_recompletion_lg'] = 'Archiver les notes de cours';
$string['entity:local_recompletion_qa'] = 'Archiver des tentatives de l\'activite évaluation (quiz)';
$string['entity:local_recompletion_qg'] = 'Archiver des notes de l\'activite évaluation (quiz)';
$string['eventrecompletion'] = 'Requalification de la formation';
$string['extraattempt'] = 'Donner aux apprenants des tentatives supplémentaires';
$string['forcearchivecompletiondata'] = 'Forcer l\'archivage des données d\'achèvement';
$string['forcearchivecompletiondata_help'] = 'Si cette option est activée, l\'archivage des données d\'achèvement sera forcé pour tous les réachèvements de cours. Cela peut éviter la perte accidentelle de données.';
$string['h5pattempts'] = 'Tentatives de module H5P (mod_h5pactivity)';
$string['h5pattempts_help'] = 'Comment gérer les tentatives H5P dans le cours. Si l\'option archive est sélectionnée, les anciennes tentatives H5P seront archivées dans les tables local_recompletion_h5p et local_recompletion_h5pr.';
$string['hotpotattempts'] = 'Tentatives du module Hotpot';
$string['hotpotattempts_help'] = 'Comment gérer les tentatives de Hotpot dans le cours. Si vous choisissez d\'archiver, les tentatives seront archivées.';
$string['hvpattempts'] = 'Tentatives plugiciel H5P (mod_hvp)';
$string['hvpattempts_help'] = 'Comment gérer les tentatives du module d\'activite H5P dans le cours. Si l\'option archive est sélectionnée, les anciennes tentatives H5P seront archivées dans la table local_recompletion_hvp.';
$string['inprogress'] = 'En cours';
$string['invalidscheduledate'] = 'La date de programmation saisie n\'est pas valide.';
$string['invalidschedulestartdate'] = 'Date de début de l’horaire invalide : elle doit être aujourd’hui ou dans le futur.';
$string['lessonattempts'] = 'Tentatives de leçons';
$string['lessonattempts_help'] = 'Comment gérer les tentatives du module d\'activite leçons dans le cours. Si vous choisissez d\'archiver, les tentatives seront archivées.';
$string['modifycompletiondates'] = 'Modifier les dates d\'achèvement du cours';
$string['noassigngradepermission'] = 'Votre achèvement a été réinitialisé, mais cette formation contient un devoir qui ne peut pas être réinitialisé. Veuillez demander à votre enseignant de le faire si nécessaire.';
$string['nousersselected'] = 'Aucun utilisateur n\'a été sélectionné';
$string['penalties'] = 'Sanctions';
$string['pluginname'] = 'Requalification de la formation';
$string['pluginssettings'] = 'Paramètres des plugins';
$string['privacy:metadata:attempt'] = 'Le nombre de tentatives';
$string['privacy:metadata:completionstate'] = 'Si l\'activité est terminée';
$string['privacy:metadata:correct'] = 'Réponse correcte ?';
$string['privacy:metadata:course'] = 'L\'identifiant de formation lié à ce tableau.';
$string['privacy:metadata:coursemoduleid'] = 'L\'identifiant de l\'activité';
$string['privacy:metadata:coursesummary'] = 'Stocke les données d\'achèvement de formation pour un utilisateur.';
$string['privacy:metadata:deadline'] = 'Date limite';
$string['privacy:metadata:endtime'] = 'Heure de fin';
$string['privacy:metadata:flag'] = 'Drapeau';
$string['privacy:metadata:grade'] = 'Grade';
$string['privacy:metadata:gradefinal'] = 'Note finale reçue pour l\'achèvement de la formation';
$string['privacy:metadata:lessontime'] = 'Durée de la leçon';
$string['privacy:metadata:local_recompletion_cc'] = 'Archive des achèvements de formation précédents.';
$string['privacy:metadata:local_recompletion_cc_cc'] = 'Archive des cours course_completion_crit_compl  (Critères d\'achèvement de la formation.)';
$string['privacy:metadata:local_recompletion_ccert_is'] = 'Archives des certificats personnalisés';
$string['privacy:metadata:local_recompletion_ccert_is:emailed'] = 'Si le certificat personnalisé a été envoyé par courrier électronique.';
$string['privacy:metadata:local_recompletion_ccert_is:timecreated'] = 'Heure de création de l\'émission du certificat personnalisé';
$string['privacy:metadata:local_recompletion_cert'] = 'Archives des certificats précédents.';
$string['privacy:metadata:local_recompletion_cert:timecreated'] = 'L\'heure de création de l\'émission du certificat';
$string['privacy:metadata:local_recompletion_cha'] = 'Archive des réponses à choix';
$string['privacy:metadata:local_recompletion_cha:choiceid'] = 'L\'ID de choix de l\'archive des réponses de choix';
$string['privacy:metadata:local_recompletion_cha:optionid'] = 'L\'ID d\'option de l\'archive des réponses du choix';
$string['privacy:metadata:local_recompletion_cmc'] = 'Archives des modules de cours précédents.';
$string['privacy:metadata:local_recompletion_cmv'] = 'Archive des modules de cours achevés.';
$string['privacy:metadata:local_recompletion_h5p'] = 'Archiver le suivi des tentatives de module H5P (mod_h5pactivity).';
$string['privacy:metadata:local_recompletion_h5pr'] = 'Archive  le suivi des résultats des tentatives de H5P (mod_h5pactivity).';
$string['privacy:metadata:local_recompletion_hpa'] = 'Archiver pour les tentatives de hotpots.';
$string['privacy:metadata:local_recompletion_hvp'] = 'Archives des données utilisateur du module H5P (mod_hvp).';
$string['privacy:metadata:local_recompletion_hvp:data'] = 'Les données de l\'utilisateur qui ont été sauvegardées.';
$string['privacy:metadata:local_recompletion_hvp:hvp_id'] = 'Id du contenu plugiciel hvp';
$string['privacy:metadata:local_recompletion_la'] = 'Archiver les tentatives de leçons';
$string['privacy:metadata:local_recompletion_lb'] = 'Archiver des branchs de leçons';
$string['privacy:metadata:local_recompletion_lg'] = 'Archiver des notes de cours';
$string['privacy:metadata:local_recompletion_lo'] = 'Archiver des dérogations aux leçons';
$string['privacy:metadata:local_recompletion_lt'] = 'Archive de la minuterie des leçons';
$string['privacy:metadata:local_recompletion_ltia'] = 'Journal d\'accès des utilisateurs et données de mise à niveau.';
$string['privacy:metadata:local_recompletion_ltia:lastaccess'] = 'L\'heure à laquelle l\'utilisateur a accédé au cours pour la dernière fois.';
$string['privacy:metadata:local_recompletion_ltia:lastgrade'] = 'La dernière note enregistrée détenue par l\'utilisateur.';
$string['privacy:metadata:local_recompletion_ltia:timecreated'] = 'L\'heure à laquelle l\'utilisateur a été inscrit.';
$string['privacy:metadata:local_recompletion_ltia:toolid'] = 'L\'ID de l\'outil de la méthode d\'inscription LTI.';
$string['privacy:metadata:local_recompletion_ltia:userid'] = 'ID de l\'utilisateur';
$string['privacy:metadata:local_recompletion_qr'] = 'Tableau des réponses au questionnaire de Requalification.';
$string['privacy:metadata:local_recompletion_qr:complete'] = 'complète';
$string['privacy:metadata:local_recompletion_qr:grade'] = 'Note';
$string['privacy:metadata:local_recompletion_qr:questionnaireid'] = 'Questionnaire id';
$string['privacy:metadata:local_recompletion_qr:submitted'] = 'Soumis';
$string['privacy:metadata:maxattempts'] = 'Nombre maximal de tentatives';
$string['privacy:metadata:overrideby'] = 'L\'identifiant de l\'utilisateur qui a contourné l\'achèvement de l\'activité';
$string['privacy:metadata:quiz_attempts'] = 'Détails archivés de chaque tentative pour le quiz.';
$string['privacy:metadata:quiz_attempts:attempt'] = 'Le nombre de tentatives.';
$string['privacy:metadata:quiz_attempts:currentpage'] = 'La page actuelle sur laquelle l\'utilisateur se trouve.';
$string['privacy:metadata:quiz_attempts:preview'] = 'Que ce soit un aperçu du quiz.';
$string['privacy:metadata:quiz_attempts:state'] = 'L\'état actuel de la tentative.';
$string['privacy:metadata:quiz_attempts:sumgrades'] = 'La somme des notes dans la tentative.';
$string['privacy:metadata:quiz_attempts:timecheckstate'] = 'L\'heure à laquelle l\'état a été vérifié.';
$string['privacy:metadata:quiz_attempts:timefinish'] = 'L\'heure à laquelle la tentative a été complétée.';
$string['privacy:metadata:quiz_attempts:timemodified'] = 'L\'heure à laquelle la tentative a été mise à jour.';
$string['privacy:metadata:quiz_attempts:timemodifiedoffline'] = 'L\'heure à laquelle la tentative a été mise à jour par une mise à jour hors ligne.';
$string['privacy:metadata:quiz_attempts:timestart'] = 'L\'heure à laquelle la tentative a été lancée.';
$string['privacy:metadata:quiz_grades'] = 'Détails archivés sur la note globale des tentatives de quiz précédentes.';
$string['privacy:metadata:quiz_grades:grade'] = 'La note globale pour ce quiz.';
$string['privacy:metadata:quiz_grades:quiz'] = 'Le quiz qui a été noté.';
$string['privacy:metadata:quiz_grades:timemodified'] = 'L\'heure à laquelle la note a été modifiée.';
$string['privacy:metadata:quiz_grades:userid'] = 'L\'utilisateur qui a été noté.';
$string['privacy:metadata:rawscore'] = 'La note obtenue';
$string['privacy:metadata:reaggregate'] = 'Si l\'achèvement de formation a été regroupé.';
$string['privacy:metadata:retake'] = 'Reprise';
$string['privacy:metadata:scoes_value:element'] = 'Date de début de l’horaire invalide : elle doit être aujourd’hui ou dans le futur.';
$string['privacy:metadata:scoes_value:value'] = 'Identifiant de l’élément à suivre';
$string['privacy:metadata:score'] = 'Note';
$string['privacy:metadata:scorm_attempt'] = 'Archivage des tentatives SCORM précédentes';
$string['privacy:metadata:scorm_scoes_value'] = 'Archivage des données suivies des SCO appartenant à l’activité';
$string['privacy:metadata:scormid'] = 'ID SCORM';
$string['privacy:metadata:starttime'] = 'Heure de début';
$string['privacy:metadata:timecompleted'] = 'L\'heure à laquelle la formation a été complétée.';
$string['privacy:metadata:timecreated'] = 'Heure de création de l\'élément suivi';
$string['privacy:metadata:timeenrolled'] = 'L\'heure à laquelle l\'utilisateur s\'est inscrit à la formation';
$string['privacy:metadata:timemodified'] = 'L\'heure à laquelle l\'enregistrement a été modifié';
$string['privacy:metadata:timestarted'] = 'L\'heure à laquelle la formation a été commencée.';
$string['privacy:metadata:unenroled'] = 'Si l\'utilisateur a été déinscrit de la formation';
$string['privacy:metadata:useranswer'] = 'Réponse';
$string['privacy:metadata:userid'] = 'L\'identifiant d\'utilisateur lié à ce tableau.';
$string['privacy:metadata:viewed'] = 'Si l\'activité a été visionnée';
$string['pulsenotifications'] = 'Envoi de notifications';
$string['pulsenotifications_help'] = 'Les notifications qui ont déjà été envoyées doivent-elles être réinitialisées ?';
$string['pulseresetnotifications'] = 'Réinitialiser les notifications';
$string['questionnaireattempts'] = 'Tentatives de questionnaires';
$string['questionnaireattempts_help'] = 'Que faire des tentatives de quiz existantes? Si Supprimer et Archiver est sélectionné, les anciennes tentatives de quiz seront archivées dans les tableaux local_recompletion,  si Donner des tentatives supplémentaires est sélectionné, il sera possible de contourner le quiz pour permettre à l\'utilisateur d\'avoir le nombre maximal de tentatives défini.';
$string['quizattempts'] = 'Tentatives pour le Quiz';
$string['quizattempts_help'] = 'Que faire avec les tentatives de quiz existantes. Si l\'option « supprimer et archiver » est sélectionnée, les anciennes tentatives de quiz seront archivées dans les tables de recomplétion locales. Si l\'option « donner des tentatives supplémentaires » est sélectionnée, cela ajoutera une dérogation au quiz pour permettre à l\'utilisateur de définir le nombre maximum de tentatives autorisées.';
$string['recompletion'] = 'requalification';
$string['recompletion:bulkoperations'] = 'Opérations en masse';
$string['recompletion:manage'] = 'Autoriser la modification des paramètres de requalification de formation';
$string['recompletion:resetmycompletion'] = 'Réinitialiser ma propre requalification';
$string['recompletioncalculateddate'] = 'Date calculée : {$a}';
$string['recompletionemailbody'] = 'Corps du message de requalification';
$string['recompletionemailbody_help'] = 'Un objet personnalisé de courriel de requalification peut être ajouté en texte brut ou en format Moodle-auto, y compris les balises HTML et multi-langues Les espaces réservés suivants peuvent être inclus dans le message : * Nom de la formation {$a->coursename} * Lien vers la formation {$a->link} * Lien vers la page de profil de l\'utilisateur {$a->profileurl} * Courriel de l\'utilisateur {$a->email} * Nom de l\'utilisateur {$a->fullname}';
$string['recompletionemaildefaultbody'] = 'Bonjour, la formation {$a->coursename} {$a->link} doit être reprise';
$string['recompletionemaildefaultsubject'] = 'Une requalification de la formation {$a->coursename} est requise';
$string['recompletionemailsubject'] = 'Sujet du message de recomplétion';
$string['recompletionemailsubject_help'] = 'A custom recompletion email subject may be added as plain text The following placeholders may be included in the message: * Course name {$a->coursename} * User fullname {$a->fullname}';
$string['recompletionnotenabledincourse'] = 'La recomplétion n\'est pas activée dans le cours : {$a}';
$string['recompletionnotify'] = 'Message de recompletion';
$string['recompletionnotify:activeenrolled'] = 'Envoyer aux utilisateurs complétés avec une inscription active';
$string['recompletionnotify:completed'] = 'Envoyer aux utilisateurs ayant complété';
$string['recompletionnotify:enrolled'] = 'Envoyer aux utilisateurs ayant complété avec une inscription';
$string['recompletionnotify_help'] = 'Détermine quels utilisateurs sont avisés de la recompletion.
* Envoyer aux utilisateurs ayant complété – Si un enregistrement d’achèvement de cours existe pour un utilisateur, celui-ci sera avisé.
* Envoyer aux utilisateurs ayant complété avec une inscription active – Si un utilisateur possède une inscription active, il sera avisé.
* Envoyer aux utilisateurs ayant complété avec une inscription – Si un utilisateur possède une inscription active ou suspendue, il sera avisé.';
$string['recompletionrange'] = 'Fréquence de requalification';
$string['recompletionrange_help'] = 'Définissez le délai avant la réinitialisation des résultats d\'achèvement des utilisateurs.';
$string['recompletionschedule'] = 'Requalification planifiée';
$string['recompletionschedule_help'] = 'Fixez une date (par exemple, Jan 1st) à laquelle les résultats de l\'achèvement sont réinitialisés. Cette date est calculée à partir de la dernière exécution d\'une requalification. Cette réinitialisation se produit alors à intervalles réguliers. Le 1er janvier entraînera une requalification annuelle, tandis que \'friday\' entraînera l\'exécution d\'une requalification tous les vendredis.';
$string['recompletionschedulestart'] = 'Heure de début de la planification de la recompletion (requalification)';
$string['recompletionschedulestart_help'] = 'À utiliser en combinaison avec une planification basée sur une période de temps plutôt que sur une date fixe (ex. « 3 mois »). Si cette option est sélectionnée, la première recompletion aura lieu à cette date, puis la planification de la recompletion sera appliquée. Cette date doit être actuelle ou future.';
$string['recompletionsettingssaved'] = 'Paramètres de requalification enregistrés';
$string['recompletiontask'] = 'Recherchez les utilisateurs qui doivent reprendre une formation';
$string['recompletiontype'] = 'Type de requalification';
$string['recompletiontype:disabled'] = 'Désactivé';
$string['recompletiontype:ondemand'] = 'À la demande';
$string['recompletiontype:period'] = 'Période';
$string['recompletiontype:schedule'] = 'Planifié';
$string['recompletiontype_help'] = 'Détermine comment les résultats des utilisateurs seront réinitialisés pour les nouveaux cours. * Désactivé - désactive cette fonctionnalité. * Période - permet à l\'enseignant de définir une réinitialisation automatique basée sur la date d\'achèvement du cours de l\'utilisateur. * Sur demande - permet à l\'enseignant de réinitialiser manuellement les utilisateurs individuels en fonction des besoins.';
$string['recompletionunenrolenable'] = 'Réinitialisation de l\'achèvement en cas de désinscription';
$string['recompletionunenrolenable_help'] = 'Permet de déclencher la réinitialisation de l\'achèvement lors de la désinscription de l\'utilisateur';
$string['resetallcompletion'] = 'Réinitialiser tous les achèvements';
$string['resetcompletionconfirm'] = 'Êtes-vous sûr de vouloir réinitialiser toutes les données d\'achèvement de ce cours pour {$a} ? Avertissement - cette opération peut supprimer définitivement certains contenus soumis';
$string['resetcompletionfor'] = 'Remise à zéro de l\'achèvement pour {$a}';
$string['resetlti'] = 'Réinitialisation des notes LTI';
$string['resetltis'] = 'Notes du LTI';
$string['resetltis_help'] = 'Comment gérer les notes LTI dans le cours. Si l\'option « Réinitialiser les notes LTI au cours » est utilisée, tous les résultats des participations au cours seront réinitialisés à 0. Lorsque l\'utilisateur obtient un nouveau résultat dans le cours, la note du cours mise à jour sera renvoyée au fournisseur de  cours LTI.';
$string['resetmycompletion'] = 'Réinitialiser l\'achèvement de mes activités';
$string['resetquizoverride'] = 'Réinitialiser les dérogations utilisateur de l’évaluation (quiz)';
$string['restricted'] = 'La réinitialisation de l\'achèvement  pour un utilisateur donné est limitée';
$string['restrictedbyenrol'] = 'La réinitialisation de l\'achèvement pour un utilisateur donné est limitée par la méthode d\'inscription.';
$string['restrictenrol'] = 'Méthode d\'inscription';
$string['restrictenrol_help'] = 'Tous les utilisateurs inscrits avec les méthodes d\'inscription sélectionnées seront inclus dans la réinitialisation des données d\'achèvement. Si aucun n\'est sélectionné, cela signifie qu\'il n\'y a aucune restriction sur la méthode d\'inscription des utilisateurs.';
$string['restrictionsettings'] = 'Paramètres de restriction';
$string['restrictionsheader'] = 'Restrictions';
$string['score'] = 'Score';
$string['scormattempts'] = 'Tentatives d\'utilisation de SCORM';
$string['scormattempts_help'] = 'Si les tentatives SCORM existantes sont supprimées - si l\'option archive est sélectionnée, les anciennes tentatives SCORM seront archivées dans la table local_recompletion_sst.';
$string['starttime'] = 'Heure de début';
$string['status'] = 'État d\'achèvement';
$string['timecreated'] = 'Temps de création';
$string['timedout'] = 'Délai d\'attente';
$string['timemodified'] = 'Temps modifié';
$string['yearly'] = 'Annuel';
