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
 * Strings for component 'kanban', language 'fr', version '5.1'.
 *
 * @package     kanban
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addcard'] = 'Ajouter une carte à cette colonne';
$string['addcolumn'] = 'Ajouter une colonne à ce tableau';
$string['aftercompletion'] = 'après la clotûre d\'une carte';
$string['afterdue'] = 'après échéance de la carte';
$string['assignee'] = 'Attribuée';
$string['assignees'] = 'Attribuées';
$string['assignme'] = 'Me l\'attribuer';
$string['attachments'] = 'Annexes';
$string['autoclose'] = 'Clôturer la carte automatiquement';
$string['autohide'] = 'Cacher automatiquement les cartes clôturées';
$string['cachedef_board'] = 'Mettre en cache pour une instance de tableau';
$string['cachedef_timestamp'] = 'Horodatage de la dernière modification de la carte, de la colonne ou de l\'instance de tableau';
$string['cardcount'] = 'Nombre de cartes dans cette colonne';
$string['cardnotfound'] = 'Carte non trouvée';
$string['cardtitle'] = 'Titre de la carte';
$string['changegroup'] = 'Changer le tableau de groupe';
$string['changeuser'] = 'Changer l\'utilisateur du tableau';
$string['closecard'] = 'Clôturer la carte';
$string['color'] = 'Couleur';
$string['column'] = 'Colonne';
$string['columntitle'] = 'Titre de la colonne';
$string['completioncomplete'] = 'Clôturer ce nombre de cartes';
$string['completioncreate'] = 'Créer ce nombre de cartes';
$string['completiondetail:complete'] = 'Clôturer les cartes : {$a}';
$string['completiondetail:create'] = 'Créer les cartes : {$a}';
$string['connectionlost'] = 'Connexion perdue';
$string['connectionlostmessage'] = 'La connexion avec le serveur a été perdue. essai de reconnexion…';
$string['courseboard'] = 'Tableau partagé';
$string['createtemplate'] = 'Créer un modèle';
$string['deleteboard'] = 'Supprimer le tableau';
$string['deleteboardconfirm'] = 'Voulez-vous vraiment supprimer ce tableau ? Un nouveau tableau sera créé sur la base du modèle.';
$string['deletecard'] = 'Supprimer la carte';
$string['deletecardconfirm'] = 'Voulez-vous vraiment supprimer cette carte ?';
$string['deletecolumn'] = 'Supprimer la colonne';
$string['deletecolumnconfirm'] = 'Voulez-vous vraiment supprimer cette colonne ?';
$string['deletemessage'] = 'Supprimer le message';
$string['deletemessageconfirm'] = 'Voulez-vous vraiment supprimer ce message ?';
$string['deletetemplate'] = 'Supprimer le modèle';
$string['deletetemplateconfirm'] = 'Voulez-vous vraiment supprimer ce modèle ?';
$string['doing'] = 'En cours';
$string['done'] = 'Fait';
$string['due'] = 'Requis';
$string['duedate'] = 'Date requise';
$string['editboard'] = 'Modifier le tableau';
$string['editcard'] = 'Modifier la carte';
$string['editcolumn'] = 'Modifier la colonne';
$string['editdetails'] = 'Modifier les détails';
$string['editing_this_card_is_not_allowed'] = 'L\'édition de cette carte est interdit';
$string['enablehistory'] = 'Activer l\'historique';
$string['enablehistory_help'] = 'Activer l\'enregistrement de l\'historique des cartes du tableau (par exemple quand une carte est déplacée / renommée / clôturée)';
$string['enablehistorydescription'] = 'Activer cette option va créer l\'historique des changements réalisés sur les tableaux.';
$string['groupboard'] = 'Grouper le tableau avec le groupe « {$a} »';
$string['hidehidden'] = 'Cacher les cartes cachées';
$string['history'] = 'Historique';
$string['history_card_added'] = '{$a->username} a ajouté la carte « {$a->title} » à la colonne « {$a->columnname} »';
$string['history_card_assigned'] = '{$a->username} a attribué la carte à {$a->affectedusername}';
$string['history_card_completed'] = '{$a->username} a clôturé la carte';
$string['history_card_deleted'] = '{$a->username} a effacé la carte de la colonne « {$a->columnname} »';
$string['history_card_moved'] = '{$a->username} a déplacé la carte vers la colonne « {$a->columnname} »';
$string['history_card_reopened'] = '{$a->username} a réouvert la carte';
$string['history_card_unassigned'] = '{$a->username} a retiré m\'attribution de la carte à {$a->affectedusername}';
$string['history_card_updated'] = '{$a->username} a changé le titre de la carte en « {$a->title} »';
$string['history_discussion_added'] = '{$a->username} a ajouté un message dans la discussion';
$string['history_discussion_deleted'] = '{$a->username} a effacé un message de la discussion';
$string['kanban:addcard'] = 'Ajouter une carte au tableau Kanban';
$string['kanban:addinstance'] = 'Ajouter un tableau Kanban';
$string['kanban:assignothers'] = 'Attribuer une carte à d\'autres personnes';
$string['kanban:assignself'] = 'S\'auto attribuer une carte';
$string['kanban:editallboards'] = 'Modifier tous les tableaux';
$string['kanban:manageallcards'] = 'Modifier / déplacer toutes les cartes';
$string['kanban:manageassignedcards'] = 'Modifier / déplacer toutes les cartes qui me sont attribuées';
$string['kanban:manageboard'] = 'Gérer les tableaux (modèles, supprimer le tableau)';
$string['kanban:managecolumns'] = 'Modifier les colonnes du tableau';
$string['kanban:view'] = 'Afficher un tableau Kanban';
$string['kanban:viewallboards'] = 'Afficher tous les tableaux';
$string['kanban:viewhistory'] = 'Afficher l\'historique du tableau';
$string['linknumbers'] = 'Lier les numéros de cartes';
$string['linknumbers_help'] = 'Les numéros des descriptions de cartes, des discussions et commentaires vont être liés.';
$string['liveupdatetime'] = 'Intervalle de mise à jour en secondes';
$string['liveupdatetimedescription'] = 'Les tableaux se mettront à jour après cette intervalle. Mettre 0 pour désactiver la mise à jour automatique';
$string['loading'] = 'Chargement d\'un tableau Kanban';
$string['loadingdiscussion'] = 'Chargement de la discussion';
$string['lock'] = 'Vérouiller';
$string['lockboardcolumns'] = 'Vérouiller les colonne du tableau';
$string['message_assigned_fullmessage'] = 'La carte « {$a->title} » du tableau « {$a->boardname} » vous a été attribuée par {$a->username}';
$string['message_assigned_smallmessage'] = 'La carte « {$a->title} »  vous a été attribuée';
$string['message_closed_fullmessage'] = 'La carte « {$a->title} » a été clôturée par {$a->username}';
$string['message_closed_smallmessage'] = 'La carte « {$a->title} » a été clôturée';
$string['message_discussion_fullmessage'] = 'Il y a un nouveau message dans la discussion de la carte « {$a->title} » du tableau « {$a->boardname} » :
{$a->username}
{$a->content}';
$string['message_discussion_smallmessage'] = 'Une discussion à débuté pour la carte « {$a->title} »';
$string['message_due_fullmessage'] = 'L\'échéance de la carte « {$a->title} » du tableau « {$a->boardname} » est fixée au {$a->duedate}';
$string['message_due_smallmessage'] = 'La carte « {$a->title} » est échue';
$string['message_moved_fullmessage'] = 'La carte « {$a->title} » a été déplacée dans la colonne « {$a->columnname} » par {$a->username}';
$string['message_moved_smallmessage'] = 'La carte « {$a->title} » a été déplacée';
$string['message_reopened_fullmessage'] = 'La carte « {$a->title} » du tableau « {$a->boardname} » a été réouverte par {$a->username}';
$string['message_reopened_smallmessage'] = 'La carte « {$a->title} » a été réouverte';
$string['message_unassigned_fullmessage'] = 'L\'attribution de la carte « {$a->title} » du tableau « {$a->boardname} » vous a été retirée par {$a->username}';
$string['message_unassigned_smallmessage'] = 'L\'attribution de la carte « {$a->title} » vous a été retirée';
$string['messageprovider:assigned'] = 'Carte attribuée / retirée';
$string['messageprovider:closed'] = 'Carte clôturée / réouverte';
$string['messageprovider:discussion'] = 'Discussion dans la carte';
$string['messageprovider:due'] = 'Carte échue';
$string['messageprovider:moved'] = 'Carte déplacée';
$string['modulename'] = 'Tableau Kanban';
$string['modulename_help'] = 'Cette activité utilise la méthode Kanban pour la gestion de projets ou les processus d\'apprentissage.
Kanban est une méthode agile de gestion de projet qui organise les tâches à l\'aide d\'un tableau visuel afin d\'optimiser le flux de travail. Les tâches sont classées dans des colonnes telles que « À faire », « En cours » et « Terminé » afin de rendre les progrès transparents. L\'objectif est d\'identifier les goulots d\'étranglement dans le flux de travail et d\'améliorer continuellement l\'efficacité.
<br>Selon les paramètres, il peut y avoir plusieurs types de tableaux dans une activité Kanban :
<ul>
    <li>Le tableau du cours : accessible à tous ceux qui ont accès à l\'activité.</li>
    <li>Tableaux personnels : pour chaque utilisateur</li>
    <li>Tableaux de groupe</li>
    <li>Modèles de tableaux : toute personne pouvant gérer des tableaux peut copier un tableau existant pour en faire un modèle.</li>
</ul>';
$string['modulenameplural'] = 'Tableaux Kanban';
$string['moveaftercard'] = 'Déplacer après';
$string['movecard'] = 'Déplacer la carte';
$string['movecolumn'] = 'Déplacer la colonne';
$string['myuserboard'] = 'Mon tableau personnel';
$string['name'] = 'Nom du tableau';
$string['name_help'] = 'Ce nom sera visible dans l\'aperçu du cours et comme titre du tableau.';
$string['newcard'] = 'Nouvelle carte';
$string['newcolumn'] = 'Nouvelle colonne';
$string['nogroupavailable'] = 'Aucun groupe disponible';
$string['nokanbaninstances'] = 'Il n\'y a pas de tableaux Kanban disponibles dans ce cours ou vous n\'êtes pas autorisé à y accéder.';
$string['nonewduedate'] = 'Nouvelle date d\'échéance';
$string['nouser'] = 'Aucun utilisateur';
$string['nouserboards'] = 'Aucun tableaux personnels';
$string['pluginadministration'] = 'Administration Kanban';
$string['pluginname'] = 'Tableau Kanban';
$string['privacy:metadata:action'] = 'Action';
$string['privacy:metadata:affected_userid'] = 'Utilisateur affecté';
$string['privacy:metadata:content'] = 'Contenu';
$string['privacy:metadata:createdby'] = 'Utilisateur qui a créé la carte';
$string['privacy:metadata:groupid'] = 'ID du groupe';
$string['privacy:metadata:kanban_assignee'] = 'Attribuée';
$string['privacy:metadata:kanban_board'] = 'Tableau';
$string['privacy:metadata:kanban_card'] = 'Carte';
$string['privacy:metadata:kanban_column'] = 'Colonne';
$string['privacy:metadata:kanban_discussion_comment'] = 'Commentaire';
$string['privacy:metadata:kanban_history'] = 'Historique';
$string['privacy:metadata:parameters'] = 'Information sur l\'action';
$string['privacy:metadata:timecreated'] = 'Date de création';
$string['privacy:metadata:timemodified'] = 'Date de dernière modification';
$string['privacy:metadata:timestamp'] = 'Date de l\'action';
$string['privacy:metadata:userid'] = 'ID de l\'utilisateur';
$string['pushcard'] = 'Envoyer la carte dans tous les tableaux';
$string['pushcardconfirm'] = 'Cela enverra une copie de cette carte dans tous les tableaux le l\'activité Kanban y compris les modèles. Les copies existantes seront remplacées.';
$string['reminderdate'] = 'Date de rappel';
$string['remindertask'] = 'Envoyer des notifications de rappel';
$string['repeat'] = 'Répéter la carte';
$string['repeat_help'] = 'Si cette option est sélectionnée, une nouvelle copie de cette carte sera créée dans la colonne la plus à gauche dès que cette instance sera terminée. La discussion, l\'historique et les personnes assignées ne sont pas copiés.
Vous pouvez choisir comment calculer la nouvelle date d\'échéance, si nécessaire. Cela s\'appliquera également à la nouvelle date de rappel.';
$string['repeat_interval'] = 'Intervalle';
$string['repeat_interval_type'] = 'Fréquence';
$string['repeat_newduedate'] = 'Nouvelle date d\'échéance';
$string['reset_group'] = 'Réinitialiser les tableaux de groupe';
$string['reset_kanban'] = 'Réinitialiser les tableaux partagés';
$string['reset_personal'] = 'Réinitialiser les tableaux personnels';
$string['saveastemplate'] = 'Enregistrer comme modèle';
$string['saveastemplateconfirm'] = 'Voulez-vous vraiment enregistrer ce tableau comme modèle ? Il remplacera le modèle courant s\'il existe.';
$string['senddiscussion'] = 'Envoyer un message dans la discussion';
$string['showattachment'] = 'Afficher les liens';
$string['showboard'] = 'Afficher le tableau partagé';
$string['showdescription'] = 'Afficher la description';
$string['showdiscussion'] = 'Afficher la discussion';
$string['showhidden'] = 'Afficher les cartes cachées';
$string['showtemplate'] = 'Afficher le modèle';
$string['startdiscussion'] = 'Commencer la discussion';
$string['template'] = 'Modèle';
$string['toboard'] = 'Tableau « {$a->boardname} »';
$string['todo'] = 'À faire';
$string['topofcolumn'] = 'Remonter vers le haut';
$string['unassign'] = 'Supprimer l\'affectation de cet utilisateur';
$string['unassignme'] = 'Supprimer mon affectation';
$string['uncomplete'] = 'Réouvrir';
$string['unlock'] = 'Déverrouiller';
$string['unlockboardcolumns'] = 'Déverrouiller les colonnes du tableau';
$string['usenumbers'] = 'Utiliser les numéros de carte';
$string['usenumbers_help'] = 'Cela active les numéros de carte pour cette activité kanban. Les numéros sont uniques par tableau (c\'est-à-dire que les cartes des tableaux utilisateur / groupe et du tableau partagé peuvent avoir le même numéro).';
$string['userboard'] = 'Tableau personnel de {$a}';
$string['userboards'] = 'Tableaux personnels';
$string['userboards_help'] = 'Activer les tableaux personnels pour les participants (visibles uniquement d\'eux même et des enseignants)';
$string['userboardsenabled'] = 'Tableaux personnels activés';
$string['userboardsonly'] = 'Tableaux personnels uniquement';
$string['wiplimit'] = 'WIP limités par personne';
$string['wiplimitenable'] = 'Activer la limite WIP';
$string['wiplimitgreaterzero'] = 'La limite WIP doit être supérieure à 0';
$string['wiplimitreached'] = 'La limite WIP a été atteinte par {$a->users}.';
