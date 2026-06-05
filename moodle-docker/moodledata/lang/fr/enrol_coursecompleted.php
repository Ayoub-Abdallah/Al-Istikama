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
 * Strings for component 'enrol_coursecompleted', language 'fr', version '5.1'.
 *
 * @package     enrol_coursecompleted
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['aftercourse'] = 'Après avoir terminé le cours : {$a}';
$string['cachedef_compcourses'] = 'Cache de l’inscription après achèvement de cours';
$string['compcourse'] = 'Cours terminé';
$string['compcourse_help'] = 'Le cours qui doit être terminé.';
$string['confirmbulkdeleteenrolment'] = 'Voulez-vous vraiment supprimer ces inscriptions d’utilisateurs ?';
$string['confirmbulkediteenrolment'] = 'Voulez-vous vraiment modifier ces inscriptions d’utilisateurs ?';
$string['coursecompleted:config'] = 'Configurer les instances d’inscription après achèvement de cours';
$string['coursecompleted:enrolpast'] = 'Inscrire des utilisateurs ayant terminé des cours';
$string['coursecompleted:manage'] = 'Gérer les utilisateurs inscrits';
$string['coursecompleted:unenrol'] = 'Désinscrire les utilisateurs du cours';
$string['coursecompleted:unenrolself'] = 'Me désinscrire du cours';
$string['customwelcome'] = 'Message d’accueil personnalisé';
$string['customwelcome_help'] = 'Un message d’accueil personnalisé peut être ajouté sous forme de texte brut ou au format Moodle, y compris les balises HTML et les balises multilingues.

Les espaces réservés suivants peuvent être inclus dans le message :

* Nom du cours {$a->coursename}
* Nom du cours terminé {$a->completed}
* Lien vers la page de profil de l’utilisateur {$a->profileurl}
* Courriel de l’utilisateur {$a->email}
* Nom complet de l’utilisateur {$a->fullname}';
$string['defaultrole'] = 'Attribution de rôle par défaut';
$string['defaultrole_desc'] = 'Sélectionne le rôle à attribuer aux utilisateurs lorsqu’ils sont inscrits.';
$string['deleteselectedusers'] = 'Supprimer les inscriptions sélectionnées à l’achèvement du cours';
$string['editselectedusers'] = 'Modifier les inscriptions sélectionnées à l’achèvement du cours';
$string['editusers'] = 'Modifier les inscriptions d’utilisateurs';
$string['enroldate'] = 'Date d’inscription';
$string['enroldate_help'] = 'Si ce réglage est activé, les utilisateurs seront automatiquement inscrits à un moment précis dans le futur.';
$string['enrolenddate'] = 'Date de fin';
$string['enrolenddate_help'] = 'Si ce réglage est activé, les utilisateurs seront automatiquement inscrits jusqu\'à cette date uniquement. Tous les cours terminés après cette date seront ignorés.';
$string['enrolperiod'] = 'Durée d’inscription';
$string['enrolperiod_desc'] = 'Durée par défaut pendant laquelle l’inscription est valide. Si elle est définie sur zéro, la durée d’inscription sera illimitée par défaut.';
$string['enrolperiod_help'] = 'Durée de validité de l’inscription, à compter du moment où l’utilisateur est inscrit. Si elle est désactivée, la durée d’inscription sera illimitée.';
$string['enrolstartdate'] = 'Date de début';
$string['enrolstartdate_help'] = 'Si ce réglage est activé, les utilisateurs ne seront pas inscrits automatiquement qu’à partir de cette date. Tous les cours terminés avant cette date seront ignorés.';
$string['group'] = 'Conserver le groupe';
$string['group_help'] = 'Essayer d’ajouter des utilisateurs à un groupe portant le même nom';
$string['keepgroup'] = 'Paramètres par défaut de conservation de groupe';
$string['keepgroup_help'] = 'Essayer par défaut d’ajouter des utilisateurs à un groupe portant le même nom';
$string['pluginname'] = 'Inscription après achèvement de cours';
$string['pluginname_desc'] = 'Le plugin d’inscription après achèvement de cours permet de donner accès à des cours sur la base de l’achèvement d’un autre cours.';
$string['privacy:metadata'] = 'Le plugin d’inscription après achèvement de cours n’enregistre aucune donnée personnelle.';
$string['processexpirationstask'] = 'Tâche d’expiration de l’inscription au cours achevé';
$string['status'] = 'Activé';
$string['status_desc'] = 'Autoriser par défaut l’inscription par achèvement de cours.';
$string['status_help'] = 'Ce paramètre détermine si l’inscription par achèvement de cours est activée.';
$string['status_link'] = 'enrol/coursecompleted';
$string['svglearnpath'] = 'Afficher le parcours d’apprentissage';
$string['svglearnpath_help'] = 'Afficher le parcours d’apprentissage (possible) à l’aide d’icônes svg.';
$string['tryunenrol'] = 'Désinscrire l’utilisateur du cours terminé.';
$string['tryunenrol_help'] = 'Essaie de désinscrire automatiquement l’utilisateur du cours terminé.
Si l’utilisateur a été inscrit avec une méthode permettant la désinscription automatique, ce plugin tentera de désinscrire automatiquement l’utilisateur.';
$string['unenrolusers'] = 'Désinscrire des utilisateurs';
$string['uponcompleting'] = 'Lorsque le cours {$a} est terminé';
$string['usersenrolled'] = '{$a} utilisateurs inscrits';
$string['welcome'] = 'Envoyer un message de bienvenue au cours';
$string['welcome_help'] = 'Lorsqu’un utilisateur s’inscrit à un cours en suivant un autre cours, un courriel de bienvenue peut être envoyé.';
$string['welcometocourse'] = 'Bienvenue dans {$a->coursename} !

Toutes nos félicitations !

Après avoir terminé avec succès {$a->completed}, vous êtes désormais automatiquement inscrit au cours suivant {$a->coursename}.';
$string['willbeenrolled'] = 'Vous serez inscrit à ce cours lorsque vous aurez terminé le cours {$a}';
