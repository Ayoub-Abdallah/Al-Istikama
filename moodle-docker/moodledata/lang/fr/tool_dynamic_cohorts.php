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
 * Strings for component 'tool_dynamic_cohorts', language 'fr', version '5.1'.
 *
 * @package     tool_dynamic_cohorts
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['add_rule'] = 'Ajouter une nouvelle règle';
$string['addcondition'] = 'Ajouter une condition';
$string['addrule'] = 'Ajouter une nouvelle règle';
$string['after'] = 'Après';
$string['any'] = 'Tous';
$string['before'] = 'Avant';
$string['broken'] = 'Rompu';
$string['brokenruleswarning'] = 'Certaines règles non respectées requièrent votre attention. <br/> Pour corriger une règle non respectée, vous devez supprimer toutes les conditions non respectées. <br/>Parfois, une règle est rompue lorsque la correspondance avec les utilisateurs SQL a échoué. Dans ce cas, toutes les conditions sont correctes, mais la règle est marquée comme non respectée. Vous devez vérifier les journaux de Moodle pour l’événement « Matching users failed » et les erreurs SQL associées. Veuillez noter que, dans tous les cas, vous devez réenregistrer la règle pour la marquer comme non rompue.';
$string['bulkprocessing'] = 'Traitement en masse';
$string['bulkprocessing_help'] = 'Si cette option est activée, les utilisateurs seront ajoutés et supprimés de la cohorte en bloc. Les performances de traitement s’en trouveront considérablement améliorées. Cependant, l’utilisation de cette option supprimera les événements déclencheurs lorsque des utilisateurs sont ajoutés ou supprimés de la cohorte.';
$string['cachedef_conditionrecords'] = 'Conditions pour la règle';
$string['cachedef_matchingusers'] = 'Correspondance des utilisateurs pour une règle';
$string['cachedef_rulesconditions'] = 'Règles avec une condition spéciale';
$string['cannotenablebrokenrule'] = 'Une règle enfreinte ne peut être activée';
$string['cf_include_missing_data'] = 'Inclure les cohortes dont les données sont manquantes.';
$string['cf_include_missing_data_help'] = 'Il se peut que les cohortes ne disposent pas encore d’un ensemble de données sur les champs personnalisés. Cette option permet d’inclure ces cohortes dans le résultat final.';
$string['cf_includingmissingdatadesc'] = '(y compris les cohortes dont les données sont manquantes)';
$string['cohort'] = 'Cohorte';
$string['cohortid'] = 'Cohorte';
$string['cohortid_help'] = 'Une cohorte à gérer dans le cadre de cette règle. Seules les cohortes qui ne sont pas gérées par d’autres plugins sont affichées dans cette liste.';
$string['cohortswith'] = 'Cohorte(s) avec champ';
$string['completed:add'] = 'La règle a été ajoutée.';
$string['completed:delete'] = 'La règle a été supprimée.';
$string['completed:disable'] = 'La règle a été désactivée.';
$string['completed:enable'] = 'La règle a été activée.';
$string['completed:update'] = 'La règle a été mise à jour.';
$string['completiondate'] = 'Date d’achèvement';
$string['completionisdisabled'] = 'L’achèvement est désactivé pour les cours configurés';
$string['condition'] = 'Condition';
$string['condition:auth_method'] = 'Méthode d’authentification';
$string['condition:cohort_field'] = 'Champ de cohorte';
$string['condition:cohort_field_description'] = 'Les utilisateurs qui ont {$a->operator} cohortes avec le champ « {$a->field} » {$a->fieldoperator} {$a->fieldvalue}';
$string['condition:cohort_membership'] = 'Membres de la cohorte';
$string['condition:cohort_membership_broken_description'] = 'La condition est défaillante. Utiliser la même cohorte que celle pour laquelle la règle donnée est configurée.';
$string['condition:cohort_membership_description'] = 'L’utilisateur qui {$a->operator} {$a->cohorts}';
$string['condition:course_completed'] = 'Cours terminé';
$string['condition:course_completed_description'] = 'Les utilisateurs ayant suivi le cours « {$a->course} » {$a->operator} {$a->timecompleted}';
$string['condition:course_not_completed'] = 'Cours non terminé';
$string['condition:course_not_completed_description'] = 'Les utilisateurs n’ayant pas suivi le cours « {$a->cours} »';
$string['condition:profile_field_description'] = 'Utilisateurs avec {$a->field} {$a->fieldoperator} {$a->fieldvalue}';
$string['condition:user_created'] = 'Heure de création de l’utilisateur';
$string['condition:user_custom_profile'] = 'Champ du profil personnalisé de l’utilisateur';
$string['condition:user_enrolment'] = 'Inscription des utilisateurs';
$string['condition:user_enrolment_description'] = 'Les utilisateurs qui sont {$a->operator} dans le cours « {$a->coursename} » (id {$a->courseid}) avec le rôle « {$a->role} » en utilisant la méthode d’inscription « {$a->enrolmethod} ».';
$string['condition:user_last_login'] = 'Dernière connexion de l’utilisateur';
$string['condition:user_profile'] = 'Champ du profil standard de l’utilisateur';
$string['condition:user_profile_interests'] = 'Centres d\'Intérêt de l\'utilisateur';
$string['condition:user_profile_interests_description'] = 'Utilisateurs dont les centres d\'intérêt contiennent les balises suivantes {$a}';
$string['condition:user_profile_interests_description_not'] = 'Utilisateurs dont les centres d\'intérêt ne contiennent pas les balises suivantes {$a}';
$string['condition:user_role'] = 'Rôle de l’utilisateur';
$string['condition:user_role_description_category'] = 'Utilisateurs qui {$a->operator} « {$a->role} » dans la catégorie {$a->categoryname} (id {$a->categoryid})';
$string['condition:user_role_description_course'] = 'Utilisateurs qui {$a->opérateur} « {$a->rôle} » dans le cours {$a->nom du cours} (id {$a->nom du cours})';
$string['condition:user_role_description_system'] = 'Utilisateurs qui {$a->opérateur} « {$a->rôle} » dans le contexte du système';
$string['conditionchnagesnotapplied'] = 'Les modifications des conditions ne sont pas appliquées tant que vous n’avez pas enregistré le formulaire de la règle.';
$string['conditionformtitle'] = 'Condition de la règle';
$string['conditions'] = 'Conditions';
$string['conditionsformtitle'] = 'Conditions de la règle';
$string['conditionstext'] = '{$a->conditions} ( logical {$a->operator} )';
$string['delete_confirm'] = 'Voulez-vous vraiment supprimer cette règle ?';
$string['delete_confirm_condition'] = 'Voulez-vous vraiment supprimer cette condition ?';
$string['delete_rule'] = 'Supprimer la règle';
$string['description'] = 'Description';
$string['description_help'] = 'Une brève description de cette règle';
$string['disable_confirm'] = 'Voulez-vous vraiment désactiver cette règle ?';
$string['disabled'] = 'Désactivé';
$string['donothaverole'] = 'n’a pas de rôle';
$string['dynamic_cohorts:manage'] = 'Gérer les règles';
$string['edit_rule'] = 'Éditer les règles';
$string['enable_confirm'] = 'Voulez-vous vraiment activer cette règle ?';
$string['enabled'] = 'Activé';
$string['enrolled'] = 'Inscrit';
$string['enrolmethod'] = 'Méthode d’inscription';
$string['event:conditioncreated'] = 'Condition créée';
$string['event:conditiondeleted'] = 'Condition supprimée';
$string['event:conditionupdated'] = 'Condition mise à jour';
$string['event:matchingfailed'] = 'La correspondance des utilisateurs a échoué';
$string['event:rulecreated'] = 'Règle créée';
$string['event:ruledeleted'] = 'Règle supprimée';
$string['event:ruleupdated'] = 'Règle mise à jour';
$string['ever'] = 'Toujours';
$string['everloggedin'] = 'Utilisateurs qui se sont connectés au moins une fois';
$string['haverole'] = 'ont le rôle';
$string['include_missing_data'] = 'Inclure les utilisateurs dont les données sont manquantes.';
$string['include_missing_data_help'] = 'Il se peut que certains utilisateurs ne disposent pas encore d’un ensemble de données de champ de profil personnalisé. Cette option permet d’inclure ces utilisateurs dans le résultat final.';
$string['includechildren'] = 'y compris les enfants (catégories et cours)';
$string['includeusersmissingdata'] = 'Inclure les utilisateurs dont les données sont manquantes';
$string['includingmissingdatadesc'] = '(y compris les utilisateurs dont les données sont manquantes)';
$string['inlast'] = 'Au cours du dernier';
$string['inlastloggedin'] = 'Utilisateurs qui se sont connectés au cours des derniers {$a}';
$string['inthefuture'] = 'est à venir';
$string['inthepast'] = 'appartient au passé';
$string['invalidfieldvalue'] = 'Valeur de champ non valide';
$string['isafter'] = 'est après';
$string['isbefore'] = 'est avant';
$string['ismemberof'] = 'sont membres de';
$string['isnotempty'] = 'n’est pas vide';
$string['isnotmemberof'] = 'ne sont pas membres de';
$string['loggedintime'] = 'Utilisateurs qui se sont connectés {$a->operator} {$a->time}';
$string['logical_operator'] = 'Opérateur logique';
$string['logical_operator_help'] = 'Opérateur logique à appliquer aux conditions de cette règle. L’opérateur « ET » signifie qu’un utilisateur doit remplir toutes les conditions pour être ajouté à une cohorte. « OU » signifie qu’un utilisateur doit remplir l’une des conditions pour être ajouté à une cohorte.';
$string['managecohorts'] = 'Gérer les cohortes';
$string['managerules'] = 'Gérer les règles';
$string['matchingusers'] = 'Correspondance des utilisateurs';
$string['missingcourse'] = 'Cours manquant';
$string['missingcoursecat'] = 'Catégorie de cours manquante';
$string['missingenrolmentmethod'] = 'Méthode d’inscription {$a} manquante';
$string['missingrole'] = 'Rôle manquant';
$string['name'] = 'Nom de la règle';
$string['name_help'] = 'Un nom lisible par un humain pour cette règle.';
$string['never'] = 'Jamais';
$string['neverloggedin'] = 'Utilisateurs qui ne se sont jamais connectés';
$string['notenrolled'] = 'Non inscrit';
$string['operator'] = 'Opérateur';
$string['or'] = 'OU';
$string['pleaseselectcohort'] = 'Sélectionner une cohorte';
$string['pleaseselectfield'] = 'Sélectionner un champ';
$string['pluginname'] = 'Cohortes dynamiques';
$string['privacy:metadata:tool_dynamic_cohorts'] = 'Informations sur les règles créées ou mises à jour par un utilisateur';
$string['privacy:metadata:tool_dynamic_cohorts:name'] = 'Nom de la règle';
$string['privacy:metadata:tool_dynamic_cohorts:usermodified'] = 'L’ID de l’utilisateur qui a créé ou mis à jour une règle';
$string['privacy:metadata:tool_dynamic_cohorts_c'] = 'Informations sur les conditions créées ou mises à jour par un utilisateur';
$string['privacy:metadata:tool_dynamic_cohorts_c:ruleid'] = 'ID de la règle';
$string['privacy:metadata:tool_dynamic_cohorts_c:usermodified'] = 'L’ID de l’utilisateur qui a créé ou mis à jour une condition';
$string['processrulestask'] = 'Traiter les règles de cohorte dynamique';
$string['profilefield'] = 'Champ de profil';
$string['realtime'] = 'Traitement en temps réel';
$string['realtime_help'] = 'Si cette option est activée, la règle sera traitée de manière synchrone dans le cadre de l’événement (si les conditions permettent un déclenchement sur l’événement). Il convient d’être prudent lors de l’activation, car le traitement d’une règle de longue durée bloque l’interface utilisateur.';
$string['realtimedisabledglobally'] = 'Traitement en temps réel désactivé globalement';
$string['rule_entity'] = 'Règle de la cohorte dynamique';
$string['rule_entity.bulkprocessing'] = 'Traitement par lots';
$string['rule_entity.description'] = 'Description';
$string['rule_entity.id'] = 'ID';
$string['rule_entity.name'] = 'Nom';
$string['rule_entity.realtime'] = 'Traitement en temps réel';
$string['rule_entity.status'] = 'Statut';
$string['ruledeleted'] = 'La règle a été supprimée';
$string['ruledisabled'] = 'La règle a été désactivée';
$string['ruledisabledpleasereview'] = 'Les règles nouvellement créées ou mises à jour sont désactivées par défaut. Veuillez examiner la règle ci-dessous et l’activer lorsque vous êtes prêt.';
$string['ruleenabled'] = 'La règle a été activée';
$string['settings:realtime'] = 'Traitement en temps réel';
$string['settings:realtime_desc'] = 'Lorsque cette option est activée, les règles dont les conditions permettent le déclenchement de l’événement sont traitées de manière synchrone dans le cadre de l’événement. Il convient d’être prudent lors de l’activation, car le traitement de règles de longue durée bloque l’interface utilisateur.';
$string['settings:releasemembers'] = 'Retirer les membres';
$string['settings:releasemembers_desc'] = 'Si activé, tous les membres seront retirés d’une cohorte lorsqu’elle ne sera plus gérée par le plugin (par exemple, si une règle est supprimée ou si la cohorte associée à une règle est modifiée).
Veuillez noter : aucun événement cohort_member_removed ne sera déclenché lorsque des membres sont retirés d’une cohorte. Dans le cas contraire, la règle sera traitée via le cron.';
$string['usercreated'] = 'L’utilisateur a été créé';
$string['usercreatedin'] = 'Utilisateurs créés au cours du dernier {$a}';
$string['usercreatedtime'] = 'Utilisateurs créés {$a->operator} {$a->time}';
$string['userlastlogin'] = 'Dernière connexion de l’utilisateur';
$string['usersforrule'] = 'Utilisateurs correspondant à la règle « {$a->rule} » pour la cohorte « {$a->cohort} »';
