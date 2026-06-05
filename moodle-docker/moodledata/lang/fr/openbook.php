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
 * Strings for component 'openbook', language 'fr', version '5.1'.
 *
 * @package     openbook
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['add_uploads'] = 'Ajouter des fichiers';
$string['allfiles'] = 'Fichiers déposés';
$string['allowedfiletypes'] = 'Types de fichiers acceptés';
$string['allowedfiletypes_err'] = 'Entrée invalide ! Vérifiez les extensions ou les séparateurs.';
$string['allowedfiletypes_help'] = 'Les types de fichiers acceptés peuvent être limités en saisissant une liste séparée par des virgules de types MIME, par exemple « video/mp4, audio/mp3, image/png, image/jpeg », ou d\'extensions de fichiers incluant un point, par exemple « .png, .jpg ». Si le champ est laissé vide, tous les types de fichiers sont autorisés.';
$string['allowsubmissionsanddescriptionfromdatesummary'] = 'Les détails et le formulaire de dépôt seront disponibles dès le <strong>{$a}</strong>';
$string['allowsubmissionsfromdate'] = 'Dépôt à partir du';
$string['allowsubmissionsfromdate_help'] = 'Si activé, les utilisateurs ne peuvent pas envoyer leurs fichiers avant cette date. Si désactivé, les utilisateurs peuvent commencer à envoyer leurs fichiers immédiatement.';
$string['allowsubmissionsfromdate_upload'] = 'Dépôt dès le';
$string['allowsubmissionsfromdatesummary'] = 'Ce dossier acceptera les dépôts à partir du <strong>{$a}</strong>';
$string['alwaysshowdescription'] = 'Toujours afficher la description';
$string['alwaysshowdescription_help'] = 'Si désactivé, la description ne sera visible qu\'à partir de la date de début de dépôt/approbation.';
$string['answered'] = 'Répondu';
$string['approval_required'] = 'Décision en attente';
$string['approval_timeover'] = 'Aucun fichier en attente d\'approbation ou le délai est dépassé.';
$string['approval_timeover_description'] = 'Approbation du partage';
$string['approvalchange'] = 'Statut du dossier modifié';
$string['approvalfromdate'] = 'Approbation à partir du';
$string['approvalfromdate_help'] = 'Le statut d\'approbation ne peut pas être modifié avant cette date. Valable uniquement si l\'approbation étudiante n\'est pas automatique.';
$string['approvalsettings'] = 'Paramètres du dossier de documents autorisés';
$string['approvaltodate'] = 'Approbation jusqu\'au';
$string['approvaltodate_help'] = 'Le statut d\'approbation ne peut pas être modifié après cette date.';
$string['approvaltodatevalidation'] = 'La date de fin d\'approbation doit être postérieure à la date de début.';
$string['approved'] = 'Approuvé';
$string['approveusers'] = 'Approuver';
$string['availability'] = 'Période d\'édition (dépôt ou approbation)';
$string['availabilityrestriction'] = 'Appliquer les restrictions de disponibilité à la liste des utilisateurs';
$string['availabilityrestriction_admin'] = 'Réglage par défaut des restrictions de disponibilité pour la liste des utilisateurs';
$string['availabilityrestriction_admin_desc'] = 'Les utilisateurs qui ne peuvent pas accéder à l\'activité en raison de restrictions de disponibilité seront retirés de la liste.<br>Ceci n\'inclut que les conditions marquées comme s\'appliquant aux listes d\'utilisateurs. Par exemple, les conditions de groupe sont incluses, mais pas les conditions de date.';
$string['availabilityrestriction_help'] = 'Les utilisateurs qui ne peuvent pas accéder à l\'activité en raison de restrictions de disponibilité seront retirés de la liste.<br>Ceci n\'inclut que les conditions marquées comme s\'appliquant aux listes d\'utilisateurs. Par exemple, les conditions de groupe sont incluses, mais pas les conditions de date.';
$string['calendarapprovalend'] = '{$a} ferme pour les approbations';
$string['calendarapprovalstart'] = '{$a} ouvre pour les approbations';
$string['calendarsubmissionend'] = '{$a} ferme pour les dépôts';
$string['calendarsubmissionstart'] = '{$a} ouvre pour les dépôts';
$string['completiondetail:upload'] = 'Déposer un fichier';
$string['completionupload'] = 'L\'étudiant doit déposer un fichier';
$string['configmaxbytes'] = 'Taille maximale par défaut pour tous les fichiers du dossier.';
$string['configmaxfiles'] = 'Nombre maximum de fichiers par défaut par utilisateur.';
$string['courseuploadlimit'] = 'Limite de dépôt du cours';
$string['currentlynotapproved'] = '* Actuellement non approuvé ou rejeté pour publication.';
$string['datalogapprovalstudent'] = '(Étudiants {$a->approving} sur {$a->needed}) {$a->approval}';
$string['details'] = 'Détails';
$string['downloadall'] = 'Télécharger tous les dépôts';
$string['duedate'] = 'Jusqu\'au';
$string['duedate_help'] = 'Si activé, les utilisateurs ne peuvent plus envoyer leurs fichiers après cette date. Si désactivé, les utilisateurs peuvent envoyer leurs fichiers à tout moment.';
$string['duedate_upload'] = 'Dépôt jusqu\'au';
$string['duedatevalidation'] = 'La date d\'échéance doit être postérieure à la date de début de dépôt.';
$string['edit_notcapable'] = 'La période d\'édition est ouverte mais vous n\'êtes pas autorisé à modifier les fichiers.';
$string['edit_teacher_uploads'] = 'Modifier/déposer des fichiers enseignants';
$string['edit_timeover'] = 'Les fichiers ne peuvent être modifiés que durant la période d\'édition.';
$string['edit_uploads'] = 'Modifier/déposer des fichiers';
$string['email:filechange:footer'] = '</ul><br />Veuillez vérifier si votre approbation est requise.';
$string['email:filechange_upload:header'] = '<b>{$a->username}</b> a déposé le(s) fichier(s) suivant(s) dans <b>« {$a->openbook} »</b> le {$a->dayupdated} à {$a->timeupdated} :<br /><ul>';
$string['email:filechange_upload:subject'] = 'Fichier(s) déposé(s)';
$string['email:statuschange:filename'] = '<li>« {$a->filename} » passé à <b>« {$a->apstatus} »</b></li>';
$string['email:statuschange:footer'] = '</ul>';
$string['email:statuschange:header'] = 'Le statut du dossier de documents autorisés pour le fichier suivant dans <b>« {$a->openbook} »</b> a été modifié le {$a->dayupdated} à {$a->timeupdated} par <b>{$a->username}</b> :<br /><ul>';
$string['email:statuschange:subject'] = 'Statut du dossier de documents autorisés modifié';
$string['entiresperpage'] = 'Participants par page';
$string['eventopenbookapprovalchanged'] = 'Approbation du fichier du dossier de documents autorisés modifiée';
$string['eventopenbookduedateextended'] = 'Date d\'échéance du dossier de documents autorisés prolongée';
$string['eventopenbookfiledeleted'] = 'Fichier du dossier de documents autorisés supprimé';
$string['eventopenbookfileuploaded'] = 'Fichier du dossier de documents autorisés déposé';
$string['eventoverridecreated'] = 'Dérogation créée';
$string['eventoverridedeleted'] = 'Dérogation supprimée';
$string['eventoverrideupdated'] = 'Dérogation mise à jour';
$string['extensionto'] = 'Prolongation jusqu\'au';
$string['filedetails'] = 'Détails';
$string['filesarepersonal'] = 'Les fichiers sont personnels/privés';
$string['filesarepersonal_admin'] = 'Les fichiers sont personnels/privés';
$string['filesarepersonal_admin_desc'] = 'Détermine la visibilité par défaut des fichiers étudiants.';
$string['filesarepersonal_help'] = 'Cette option détermine si les fichiers restent personnels et privés : <br><ul><li><strong>Oui</strong> - les fichiers sont personnels et privés.</li><li><strong>Non</strong> - les fichiers peuvent être partagés si approuvés par les parties concernées.</li></ul>';
$string['filesarepersonal_no'] = 'No (les fichiers peuvent être partagés entre étudiants)';
$string['filesarepersonal_yes'] = 'Oui (les fichiers sont personnels/privés)';
$string['filesofthesetypes'] = 'Types de fichiers autorisés :';
$string['filter'] = 'Filtrer';
$string['filter:allfiles'] = 'Tous les dépôts';
$string['filter:approvalrequired'] = 'Décision en attente';
$string['filter:approved'] = 'Dépôts approuvés';
$string['filter:nofiles'] = 'Aucun dépôt';
$string['filter:nofilter'] = 'Aucun filtre';
$string['filter:rejected'] = 'Dépôts rejetés';
$string['giveapproval'] = 'Donner l\'approbation';
$string['go'] = 'Appliquer';
$string['grantextension'] = 'Accorder une prolongation';
$string['group_approved'] = 'Partage approuvé par tous les membres du groupe.';
$string['guideline'] = 'Dossier de documents autorisés pour dépôts';
$string['hidden'] = 'Non publié';
$string['maxbytes'] = 'Taille maximale des fichiers';
$string['maxbytes_help'] = 'Les fichiers déposés ne peuvent pas dépasser cette taille.';
$string['maxfiles'] = 'Nombre maximum de fichiers joints';
$string['maxfiles_help'] = 'Chaque étudiant peut déposer jusqu\'à ce nombre de fichiers.';
$string['messageprovider:openbook_updates'] = 'Notifications du dossier de documents autorisés';
$string['modulename'] = 'Dossier de documents autorisés';
$string['modulename_help'] = '###### Fonctionnalités cléfs
- Permet aux utilisateurs de télécharger des fichiers dans un délai fixé par les enseignants
- Prend en charge la publication automatique ou sur autorisation des fichiers, avec des paramètres optionnels pour le partage par les utilisateurs
- Envoie des notifications aux utilisateurs et aux enseignants concernant les téléchargements et les changements de statut
- Permet l\'affichage sécurisé des documents dans une « fenêtre sécurisée » de Moodle pour un accès contrôlé
- Offre l\'intégration PDF.js pour l\'affichage direct des fichiers PDF dans le navigateur

###### Exemples d\'utilisation
- Collecter les documents des utilisateurs pour un accès ultérieur pendant les examens ou les devoirs
- Partager des ressources entre les utilisateurs avec des workflows d\'approbation facultatifs
- Restreindre l\'accès aux documents en mode sécurisé pour les tests importants
- Fournir un référentiel centralisé pour les soumissions des utilisateurs avec des paramètres de visibilité flexibles
- Faciliter le partage des ressources tout en conservant le contrôle des enseignants';
$string['modulenameplural'] = 'Dossiers de documents autorisés';
$string['myfiles'] = 'Fichiers propres';
$string['myownfiles'] = 'Mes propres fichiers';
$string['name'] = 'Nom';
$string['noentries'] = 'Aucune entrée';
$string['nofiles'] = 'Aucun fichier disponible';
$string['nofilestodisplay'] = 'Aucun fichier disponible ou publié pour le moment.';
$string['nofilestozip'] = 'Aucun fichier à compresser (ZIP)';
$string['nonexistentfiletypes'] = 'Les types de fichiers suivants n\'ont pas été reconnus : {$a}';
$string['noopenbooksincourse'] = 'Il n\'y a pas de dossier de documents autorisés dans ce cours.';
$string['notanswered'] = 'Sans réponse';
$string['nothing_to_show_groups'] = 'Rien à afficher - aucun groupe disponible';
$string['nothing_to_show_users'] = 'Rien à afficher - aucun étudiant disponible';
$string['nothingtodisplay'] = 'Rien à afficher';
$string['notice'] = '<strong>Note : </strong>';
$string['notice_upload_filesarepersonal_teachernotrequired'] = 'Les fichiers déposés ici seront personnels/privés et visibles par vous <strong>automatiquement.</strong>';
$string['notice_upload_filesarepersonal_teacherrequired'] = 'Les fichiers déposés ici seront personnels/privés et visibles par vous <strong>uniquement après approbation de l\'enseignant.</strong> Les enseignants se réservent le droit de refuser la publication de vos fichiers à tout moment.';
$string['notice_upload_studentnotrequired_teachernotrequired'] = 'Les fichiers déposés ici seront publiés pour tous <strong>automatiquement.</strong>';
$string['notice_upload_studentnotrequired_teacherrequired'] = 'Les fichiers seront publiés pour tous les étudiants <strong>uniquement après approbation de l\'enseignant.</strong>';
$string['notice_upload_studentrequired_teachernotrequired'] = 'Les fichiers sont personnels/privés par défaut. Ils ne seront partagés avec les autres étudiants <strong>qu\'après votre approbation.</strong>';
$string['notice_upload_studentrequired_teacherrequired'] = 'Les fichiers seront accessibles par vous après approbation de l\'enseignant. Ils ne seront partagés avec les autres étudiants <strong>qu\'après votre propre approbation.</strong>';
$string['notifications'] = 'Notifications';
$string['notify:filechange'] = 'Notifications sur les fichiers déposés';
$string['notify:filechange_admin'] = 'Réglage par défaut des notifications pour les modifications de fichiers';
$string['notify:filechange_help'] = 'Selon le réglage, les étudiants et/ou enseignants recevront une notification lorsqu\'un étudiant dépose ou modifie un fichier.';
$string['notify:setting:0'] = 'Aucune notification';
$string['notify:setting:1'] = 'Enseignants uniquement';
$string['notify:setting:2'] = 'Étudiants uniquement';
$string['notify:setting:3'] = 'Enseignants et étudiants';
$string['notify:statuschange'] = 'Notifications sur les changements de statut du dossier';
$string['notify:statuschange_admin'] = 'Réglage par défaut des notifications pour les changements de statut';
$string['notify:statuschange_help'] = 'Selon le réglage, les étudiants et/ou enseignants recevront une notification lors du changement de statut d\'un fichier.';
$string['notifystudents'] = 'Notifier les étudiants des changements du dossier';
$string['notifystudents_help'] = 'Si activé, les étudiants recevront une notification lorsque le statut de l\'un de leurs fichiers déposés change.';
$string['notifyteacher'] = 'Notifier les enseignants des fichiers déposés';
$string['notifyteacher_help'] = 'Si activé, les enseignants recevront une notification lorsqu\'un étudiant dépose un fichier.';
$string['obtainapproval_automatic'] = 'Automatique';
$string['obtainapproval_required'] = 'Requise';
$string['obtainstudentapproval'] = 'Approbation de l\'étudiant';
$string['obtainstudentapproval_admin'] = 'Réglage par défaut de l\'approbation étudiante';
$string['obtainstudentapproval_admin_desc'] = 'Détermine le réglage par défaut pour l\'approbation des étudiants.';
$string['obtainstudentapproval_help'] = 'Cette option détermine comment l\'approbation de l\'étudiant affecte la visibilité : <br><ul><li><strong>Automatique</strong> - aucune approbation requise de l\'étudiant.</li><li><strong>Requise</strong> - Les étudiants doivent approuver manuellement le fichier pour sa publication dans le dossier.</li></ul>';
$string['obtainstudentapproval_no'] = 'Automatique';
$string['obtainstudentapproval_yes'] = 'Requise';
$string['obtainteacherapproval'] = 'Approbation de l\'enseignant';
$string['obtainteacherapproval_admin'] = 'Réglage par défaut de l\'approbation enseignant';
$string['obtainteacherapproval_admin_desc'] = 'Détermine le réglage par défaut pour l\'approbation des enseignants.';
$string['obtainteacherapproval_help'] = 'Cette option détermine comment l\'approbation de l\'enseignant affecte la visibilité : <br><ul><li><strong>Automatique</strong> - aucune approbation requise de l\'enseignant.</li><li><strong>Requise</strong> - les enseignants doivent approuver manuellement le fichier.</li></ul>';
$string['obtainteacherapproval_no'] = 'Automatique';
$string['obtainteacherapproval_yes'] = 'Requise';
$string['openbook:addinstance'] = 'Ajouter un nouveau dossier de documents autorisés';
$string['openbook:approve'] = 'Décider si les fichiers doivent être publiés (visibles par tous)';
$string['openbook:grantextension'] = 'Accorder une prolongation';
$string['openbook:manageoverrides'] = 'Gérer les dérogations';
$string['openbook:receiveteachernotification'] = 'Recevoir les notifications pour les enseignants';
$string['openbook:upload'] = 'Déposer des fichiers dans un dossier de documents autorisés';
$string['openbook:uploadcommonteacherfile'] = 'Déposer des fichiers enseignants visibles par tous';
$string['openbook:view'] = 'Voir le dossier de documents autorisés';
$string['openbookstatus'] = 'Approbation';
$string['openbookstatus_help'] = 'Le statut représente l\'approbation de l\'enseignant : <ul><li><i class="fa fa-check text-success fa-fw"></i><i class="fa fa-share-from-square text-success fa-fw"></i> Approuvé, partagé et visible par tous.</li><li><i class="fa fa-check text-success fa-fw"></i><i class="fa fa-user text-success fa-fw"></i> Approuvé mais visible par l\'auteur uniquement.</li><li><i class="fa fa-times text-danger fa-fw"></i> Non approuvé ou rejeté (non visible).</li></ul>';
$string['openpdffilesinpdfjs'] = 'Activer PDF.js';
$string['openpdffilesinpdfjs_admin'] = 'Afficher les PDF avec le lecteur PDF.js';
$string['openpdffilesinpdfjs_admin_desc'] = 'Définit le mode d\'affichage par défaut des documents PDF.';
$string['openpdffilesinpdfjs_help'] = 'Détermine si les fichiers PDF doivent être affichés via la bibliothèque PDF.js.';
$string['openpdffilesinpdfjs_no'] = 'Non';
$string['openpdffilesinpdfjs_yes'] = 'Oui';
$string['optionalsettings'] = 'Options';
$string['overdue'] = 'Délai d\'édition/dépôt dépassé';
$string['override:add:group'] = 'Ajouter une dérogation de groupe';
$string['override:add:user'] = 'Ajouter une dérogation utilisateur';
$string['override:approval:from'] = 'Approbation dès le {$a->from}';
$string['override:approval:fromto'] = 'Approbation du {$a->from} au {$a->to}';
$string['override:approval:to'] = 'Approbation jusqu\'au {$a->to}';
$string['override:delete:ask'] = 'Voulez-vous vraiment supprimer la dérogation pour {$a->userorgroup} {$a->fullname} ?';
$string['override:delete:success'] = 'Dérogation supprimée avec succès !';
$string['override:invalidid'] = 'ID de dérogation invalide';
$string['override:nothingtochange'] = 'Aucun paramètre ne peut être dérogé avec la configuration actuelle de l\'activité !';
$string['override:save:success'] = 'Dérogation enregistrée avec succès';
$string['override:securewindow:from'] = 'Fenêtre sécurisée dès le {$a->from}';
$string['override:securewindow:fromto'] = 'Fenêtre sécurisée du {$a->from} au {$a->to}';
$string['override:securewindow:to'] = 'Fenêtre sécurisée jusqu\'au {$a->to}';
$string['override:submission:from'] = 'Dépôts autorisés dès le {$a->from}';
$string['override:submission:fromto'] = 'Dépôts autorisés du {$a->from} au {$a->to}';
$string['override:submission:to'] = 'Dépôts autorisés jusqu\'au {$a->to}';
$string['override:user:choose'] = 'Choisir un utilisateur';
$string['overrides'] = 'Dérogations';
$string['overrides:empty'] = 'Aucune dérogation';
$string['overview'] = 'Vue d\'ensemble';
$string['pending'] = 'En attente';
$string['pluginadministration'] = 'Administration du dossier de documents autorisés';
$string['pluginname'] = 'Dossier de documents autorisés';
$string['privacy:metadata:contenthash'] = 'Hash SHA1 du contenu du fichier.';
$string['privacy:metadata:fileid'] = 'Identifiant du fichier.';
$string['privacy:metadata:filename'] = 'Nom du fichier.';
$string['privacy:metadata:files'] = 'Stocke les informations sur les fichiers (identifiant, propriétaire, hash, nom, approbations).';
$string['privacy:metadata:openbook'] = 'Le dossier de documents autorisés';
$string['privacy:metadata:openbook_overrides'] = 'Dérogations pour ce dossier';
$string['privacy:metadata:openbookfileexplanation'] = 'Les fichiers sont stockés via l\'API de fichiers de Moodle.';
$string['privacy:metadata:openbookperpage'] = 'Nombre d\'entrées à afficher par page.';
$string['privacy:metadata:studentapproval'] = 'Si l\'étudiant a approuvé la publication.';
$string['privacy:metadata:teacherapproval'] = 'Si l\'enseignant a approuvé la publication.';
$string['privacy:metadata:timecreated'] = 'Date de création de l\'enregistrement.';
$string['privacy:metadata:timemodified'] = 'Date de dernière modification.';
$string['privacy:metadata:userextensionallowsubmissionsfromdate'] = 'Date de début de dépôt dérogatoire.';
$string['privacy:metadata:userextensionapprovalfromdate'] = 'Date de début d\'approbation dérogatoire.';
$string['privacy:metadata:userextensionapprovaltodate'] = 'Date de fin d\'approbation dérogatoire.';
$string['privacy:metadata:userextensionsecurewindowfromdate'] = 'Date de début de fenêtre sécurisée dérogatoire.';
$string['privacy:metadata:userextensionsecurewindowtodate'] = 'Date de fin de fenêtre sécurisée dérogatoire.';
$string['privacy:metadata:userextensiontodate'] = 'Date de fin de dépôt dérogatoire.';
$string['privacy:metadata:userid'] = 'Identifiant de l\'utilisateur.';
$string['privacy:path:files'] = 'Fichiers';
$string['publicfiles'] = 'Fichiers partagés';
$string['published_aftercheck'] = 'Approbation des enseignants requise';
$string['published_immediately'] = 'Approuver automatiquement';
$string['rejected'] = 'Rejeté';
$string['rejectusers'] = 'Rejeter';
$string['reset'] = 'Réinitialiser';
$string['reset_userdata'] = 'Toutes les données';
$string['resetstudentapproval'] = 'Réinitialiser l\'approbation étudiante';
$string['save_changes'] = 'Enregistrer les modifications';
$string['saveapproval'] = 'Enregistrer les modifications';
$string['savestudentapprovalwarning'] = 'Voulez-vous enregistrer ces changements ? Le statut de publication ne pourra plus être modifié une fois défini.';
$string['saveteacherapproval'] = 'Enregistrer les modifications';
$string['search:activity'] = 'Dossier de documents autorisés - informations sur l\'activité';
$string['securewindowfromdate'] = 'Début de la fenêtre sécurisée';
$string['securewindowfromdate_help'] = 'Si activé, l\'activité s\'ouvrira dans une fenêtre sécurisée qui masque la navigation et ne propose aucun lien vers d\'autres parties de Moodle. Ainsi, par exemple, seuls les liens vers les fichiers autorisés seront visibles pendant un test. La fenêtre sécurisée s\'ouvre à la date indiquée.';
$string['securewindowsettings'] = 'Paramètres de la fenêtre sécurisée';
$string['securewindowtodate'] = 'Fin de la fenêtre sécurisée';
$string['securewindowtodate_help'] = 'Si activé, l\'activité s\'ouvrira dans une fenêtre sécurisée qui masque la navigation et ne propose aucun lien vers d\'autres parties de Moodle. Ainsi, par exemple, seuls les liens vers les fichiers autorisés seront visibles pendant un test. La fenêtre sécurisée se ferme à la date indiquée.';
$string['securewindowtodatevalidation'] = 'La date de fin doit être postérieure à la date de début de la fenêtre sécurisée.';
$string['sharedfilesnotshowing'] = 'Le tableau des fichiers partagés est masqué car les fichiers sont privés.';
$string['show_details'] = 'Afficher les détails';
$string['status'] = 'Statut';
$string['status:approved'] = 'Approuvé';
$string['status:approvedautomatic'] = 'Automatique';
$string['status:approvednot'] = 'Rejeté';
$string['status:approvedrevoke'] = 'Révoqué';
$string['student_approve'] = 'Partager';
$string['student_approved'] = 'Partage approuvé par l\'étudiant.';
$string['student_approved_automatically'] = 'Partage approuvé automatiquement par l\'étudiant.';
$string['student_pending'] = 'Décision de l\'étudiant en attente.';
$string['student_reject'] = 'Ne pas partager';
$string['student_rejected'] = 'Partage rejeté par l\'étudiant.';
$string['studentapproval'] = 'Approbation (étudiants)';
$string['studentapproval_help'] = 'Affiche le retour de l\'étudiant :<br><ul><li><i class="fa fa-question fa-fw text-warning"></i> - En attente</li><li><i class="fa fa-check text-success fa-fw"></i> - Approuvé</li><li><i class="fa fa-times text-danger fa-fw"></i> - Rejeté</li></ul>';
$string['studentswhosubmitted'] = 'Étudiants ayant déposé';
$string['submissionsettings'] = 'PParamètres de dépôt';
$string['submittedbystudents'] = 'Fichiers déposés par les étudiants';
$string['submittedbyteachers'] = 'Fichiers déposés par les enseignants';
$string['teacher_approve'] = 'Approuver';
$string['teacher_approved'] = 'Approuvé par l\'enseignant.';
$string['teacher_approved_automatically'] = 'Approuvé automatiquement par l\'enseignant.';
$string['teacher_files'] = 'Fichiers enseignants';
$string['teacher_pending'] = 'Décision de l\'enseignant en attente.';
$string['teacher_reject'] = 'Rejeter';
$string['teacher_rejected'] = 'Rejeté par l\'enseignant.';
$string['teacherapproval'] = 'Approbation';
$string['teacherapproval_help'] = 'État actuel de l\'approbation des fichiers pour la publication : <br><ul><li><strong>Choisir…</strong> - décision en attente, fichier non visible.</li><li><strong>Approuver</strong> - approbation accordée, fichier visible par tous.</li><li><strong>Rejeter</strong> - approbation refusée, fichier non publié.</li></ul>';
$string['teacherfiles'] = 'Fichiers enseignants visibles par tous';
$string['total'] = 'Total';
$string['uploaded'] = 'Déposé';
$string['uploadnotopen'] = 'Le dépôt de fichiers est fermé !';
$string['uselegacyviewer'] = 'Utiliser l\'ancien lecteur PDF.js';
$string['uselegacyviewer_help'] = 'Si activé, la visionneuse PDF.js héritée sera utilisée. Sinon, la visionneuse PDF.js moderne sera utilisée. La visionneuse héritée est nécessaire lorsque vous utilisez d\'anciennes versions de navigateur qui ont des difficultés à afficher les fichiers PDF à l\'aide de la visionneuse PDF.js moderne.';
$string['uselegacyviewer_no'] = 'Non';
$string['uselegacyviewer_yes'] = 'Oui';
$string['viewallxsubmissions'] = 'Voir les {$a} dépôts';
$string['visibility'] = 'Publié';
$string['visible'] = 'Publié';
$string['visibleforstudents'] = 'Publié';
$string['visibleforstudents_no'] = 'Ce fichier n\'est pas publié (masqué pour les étudiants).';
$string['visibleforstudents_yes'] = 'Ce fichier est publié (visible pour les étudiants).';
$string['withselected'] = 'Avec la sélection…';
$string['zipusers'] = 'Télécharger les fichiers sélectionnés';
