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
 * Strings for component 'tool_userautodelete', language 'fr', version '5.1'.
 *
 * @package     tool_userautodelete
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['a_users_would_be_deleted'] = 'Les {$a} utilisateurs suivants seront supprimés';
$string['a_users_would_be_warned'] = 'Les {$a} utilisateurs suivants recevront un courriel d’avertissement';
$string['action_log'] = 'Journaux d’actions';
$string['action_log_explanation'] = 'Cette page répertorie toutes les actions qui ont été effectuées par le plugin de suppression automatique d’utilisateurs. Chaque fois qu’un courriel d’avertissement est envoyé, qu’un utilisateur soit finalement supprimé ou qu’un utilisateur soit marqué comme récupéré après un courriel d’avertissement envoyé précédemment, une entrée est créée dans ce journal d’actions. Les vérifications d’inactivité des utilisateurs qui n’ont donné lieu à aucune action ne sont pas consignées.';
$string['affected_users'] = 'Utilisateurs concernés';
$string['back_to_settings'] = 'Retour aux réglages';
$string['current_configuration'] = 'Configuration actuelle';
$string['current_configuration_table_desc'] = 'Ce tableau indique la prochaine fois qu’une vérification des utilisateurs inactifs sera effectuée en arrière-plan, ainsi que les seuils configurés pour les courriels d’avertissement et les suppressions d’utilisateurs. De plus, les rôles d’utilisateurs exclus du processus de suppression sont également répertoriés ici.';
$string['delete_email_sent_to_user'] = 'Courriel de suppression envoyé à l’utilisateur ayant l’identifiant {$a}';
$string['deleted'] = 'Supprimé';
$string['dry_run'] = 'Essai (sans modification)';
$string['dry_run_affected_users_desc'] = 'Les utilisateurs répertoriés ici recevront un courriel d’avertissement ou seront immédiatement supprimés. Si aucun utilisateur n’est répertorié, cela signifie qu’aucun utilisateur n’est resté inactif pendant une durée supérieure aux seuils configurés, ou que l’utilisateur est ignoré conformément à la configuration du plugin.';
$string['dry_run_explanation'] = 'Cette page affiche les actions qui seraient effectuées lors de l’exécution de la prochaine tâche de vérification. Aucune de ces actions ne sera réellement effectuée !';
$string['error_anonymizing_user'] = 'L’anonymisation de l’utilisateur avec l’identifiant {$a} a échoué.';
$string['error_delete_email_body_empty'] = 'Le corps du courriel de suppression est vide.';
$string['error_delete_email_subject_empty'] = 'Le sujet du courriel de suppression ne doit pas être vide.';
$string['error_delete_threshold_days_negative'] = 'Le seuil de suppression doit être supérieur à 0.';
$string['error_deleting_user'] = 'La suppression de l’utilisateur avec l’identifiant {$a} a échoué.';
$string['error_invalid_config_aborting'] = 'Configuration du plugin non valide détectée. Abandon…';
$string['error_invalid_role_id'] = 'L’identifiant de rôle invalide {$a} a été trouvé dans la liste de rôles ignorés. Il s’agit très probablement d’un bug dans le plugin. Veuillez le signaler au responsable de la maintenance du plugin.';
$string['error_sending_delete_mail_to_user'] = 'L’envoi du courriel de suppression à l’utilisateur avec l’identifiant {$a} a échoué.';
$string['error_sending_warning_mail_to_user'] = 'L’envoi du courriel d’avertissement à l’utilisateur avec l’identifiant {$a} a échoué.';
$string['error_warning_email_body_empty'] = 'Le corps du courriel d’avertissement est vide.';
$string['error_warning_email_subject_empty'] = 'Le sujet du courriel d’avertissement ne doit pas être vide.';
$string['error_warning_threshold_days_geq_delete'] = 'Le seuil d’avertissement doit être inférieur au seuil de suppression.';
$string['error_warning_threshold_days_negative'] = 'Le seuil d’avertissement doit être supérieur à 0.';
$string['inactivity_warning'] = 'Avertissement d’inactivité';
$string['inspecting_raw_logs'] = 'Inspection des journaux bruts';
$string['last_check'] = 'Dernière vérification';
$string['latest_actions'] = 'Dernières actions';
$string['latest_actions_desc'] = 'Ce tableau répertorie les dernières actions qui ont été effectuées par le plugin de suppression automatique d’utilisateurs. Les vérifications sans action sont exclues.';
$string['next_check'] = 'Prochaine vérification';
$string['next_check_never'] = 'Jamais (plugin désactivé)';
$string['next_check_would'] = 'Sera vérifié';
$string['no_users_to_delete'] = 'Aucun utilisateur éligible à la suppression trouvé.';
$string['no_users_to_warn'] = 'Aucun utilisateur éligible au courriel d’avertissement trouvé.';
$string['page_title_action_log'] = 'Suppression automatique d’utilisateurs (journaux d’actions)';
$string['page_title_dryrun'] = 'Suppression automatique d’utilisateurs (essai)';
$string['plugin_disabled_skipping_execution'] = 'Le plugin est désactivé globalement, l’exécution est ignorée.';
$string['pluginname'] = 'Suppression automatique d’utilisateurs';
$string['privacy:metadata:tool_userautodelete_mail'] = 'Informations sur les utilisateurs ayant reçu un courriel d’avertissement d’inactivité.';
$string['privacy:metadata:tool_userautodelete_mail:timesent'] = 'L’heure à laquelle le courriel a été envoyé.';
$string['privacy:metadata:tool_userautodelete_mail:userid'] = 'L’identifiant de l’utilisateur qui a reçu le courriel.';
$string['recovered'] = 'Récupéré';
$string['reltime_prefix_ago'] = 'il y a';
$string['reltime_prefix_in'] = 'dans';
$string['reltime_suffix_ago'] = '';
$string['reltime_suffix_in'] = '';
$string['setting_anonymize_user_data'] = 'Anonymisation des utilisateurs supprimés';
$string['setting_anonymize_user_data_desc'] = 'Lors de la suppression d’un utilisateur, Moodle conserve par conception certaines informations de l’utilisateur en base de données. Cela inclut le prénom, le nom, l’adresse de courriel, la dernière adresse IP et d’autres informations sensibles. Cela peut poser problème, selon les politiques spécifiques de confidentialité des données de votre organisation ou les interprétations juridiques locales. Si ce paramètre est activé, toutes les données utilisateur restantes seront anonymisées, éliminant ainsi toute possibilité de retracer un compte utilisateur supprimé jusqu’à son ancien propriétaire.';
$string['setting_delete_email_body'] = 'Corps du courriel';
$string['setting_delete_email_body_default'] = '<p>Bonjour,</p><p>Votre compte sur notre site a été supprimé en raison de son inactivité. Si vous souhaitez continuer à utiliser notre service, veuillez créer un nouveau compte.</p><p>Cordialement,</p>';
$string['setting_delete_email_body_desc'] = 'Le corps de la notification de suppression.';
$string['setting_delete_email_enable'] = 'Notifications de suppression';
$string['setting_delete_email_enable_desc'] = 'Si activé, les utilisateurs recevront un dernier courriel et seront après immédiatement supprimés. Cela peut être utilisé pour envoyer une confirmation de suppression.';
$string['setting_delete_email_subject'] = 'Sujet du courriel';
$string['setting_delete_email_subject_default'] = 'Votre compte a été supprimé';
$string['setting_delete_email_subject_desc'] = 'Le sujet de la notification de suppression.';
$string['setting_delete_threshold_days'] = 'Seuil de suppression';
$string['setting_delete_threshold_days_desc'] = 'Le nombre de jours d’inactivité après lequel un utilisateur sera supprimé. La suppression sera seulement exécutée si l’utilisateur ne s’est pas connecté depuis ce nombre de jours.';
$string['setting_dryrun'] = 'Essai (sans modification)';
$string['setting_dryrun_button'] = 'Effectuer un essai (sans modification)';
$string['setting_dryrun_desc'] = 'Un essai (sans modification) vous permet de répertorier tous les utilisateurs qui recevraient un message d’avertissement ou seraient supprimés lors de l’exécution de la prochaine tâche de vérification. Cela est utile pour vérifier que le plugin est correctement configuré et pour voir quels utilisateurs seraient concernés. Le test n’effectue aucune action et est donc totalement non destructif !';
$string['setting_enable'] = 'Activer le plugin';
$string['setting_enable_desc'] = 'Active ou désactive le plugin de manière globale. Si cette option est désactivée, aucune action ne sera effectuée.';
$string['setting_header_deletion_warning'] = 'Avertissement de suppressions';
$string['setting_header_deletion_warning_desc'] = 'Configuration des courriels d’avertissement de suppressions. Les courriels d’avertissement sont envoyés un nombre de jours avant la suppression du compte. Cela informe les utilisateurs que leur compte sera supprimé bientôt et leur donne un délai pour s’authentifier à nouveau afin de maintenir leur compte actif.';
$string['setting_header_user_deletion'] = 'Suppression des utilisateurs';
$string['setting_header_user_deletion_desc'] = 'Configuration de la suppression automatique des utilisateurs. Les utilisateurs qui ne se sont pas connectés depuis au moins le nombre de jours configuré et qui ne sont pas ignorés par les paramètres ci-dessus seront automatiquement supprimés.';
$string['setting_ignore_roles'] = 'Rôles ignorés';
$string['setting_ignore_roles_desc'] = 'Tous les utilisateurs auxquels au moins un des rôles sélectionnés est attribué ne seront jamais supprimés.';
$string['setting_ignore_siteadmins'] = 'Ignore les administrateurs';
$string['setting_ignore_siteadmins_desc'] = 'Les administrateurs ne peuvent pas être supprimés. ne peuvent pas être supprimés. Révoquez le rôle d’administrateur de l’utilisateur pour l’inclure dans le processus de suppression automatique.';
$string['setting_plugin_desc'] = 'Ce plugin supprime automatiquement les utilisateurs qui ne se sont pas connectés après un nombre de jours paramétrable. Cela permet de garder votre base de données propre et de supprimer les anciens comptes qui ne sont plus nécessaires. Le plugin peut être configuré pour envoyer des courriels d’avertissement quelques jours avant la suppression de l’utilisateur. Cela donne aux utilisateurs la possibilité de se reconnecter et de conserver leur compte actif. Ce plugin prend également en charge la suppression des utilisateurs conformément au RGPD (règlement général européen sur la protection des données), sans laisser aucune trace d’informations personnelles identifiables dans la table « user » en base de données.';
$string['setting_task_execution_interval'] = 'Intervalle de vérification';
$string['setting_task_execution_interval_button'] = 'Configurer l’intervalle de vérification';
$string['setting_task_execution_interval_desc'] = 'La vérification des utilisateurs inactifs est exécutée en utilisant une tâche programmée qui est exécutée par le cron de Moodle. Vous pouvez configurer l’intervalle auquel il s’exécute en cliquant sur le bouton suivant.';
$string['setting_task_logs'] = 'Journaux d’actions';
$string['setting_task_logs_button'] = 'Consulter les journaux d’actions';
$string['setting_task_logs_desc'] = 'Ce plugin enregistre toutes les actions qu’il effectue (par exemple, suppression des utilisateurs). Vous pouvez accéder aux journaux de toutes les actions précédemment effectuées en cliquant sur le bouton suivant.';
$string['setting_warning_email_body'] = 'Corps du courriel';
$string['setting_warning_email_body_default'] = '<p>Bonjour,</p><p>Votre compte sur notre site est inactif depuis longue période. Pour conserver votre compte, veuillez <strong>vous reconnecter dès maintenant afin d’éviter qu’il ne soit supprimé</strong> dans les prochains jours, conformément à notre politique de protection des données. Si vous souhaitez que votre compte soit supprimé, vous pouvez ignorer ce message.</p><p>Cordialement,</p>';
$string['setting_warning_email_body_desc'] = 'Le corps du courriel d’avertissement.';
$string['setting_warning_email_enable'] = 'Avertissement de suppressions';
$string['setting_warning_email_enable_desc'] = 'Si activé, les utilisateurs recevront un courriel d’avertissement après un nombre de jours paramétrable avant la suppression de leur compte.';
$string['setting_warning_email_subject'] = 'Sujet du courriel';
$string['setting_warning_email_subject_default'] = 'Votre compte sera supprimé bientôt - action requise !';
$string['setting_warning_email_subject_desc'] = 'Le sujet du courriel d’avertissement.';
$string['setting_warning_threshold_days'] = 'Seuil d’avertissement';
$string['setting_warning_threshold_days_desc'] = 'Le nombre de jours avant la suppression du compte pour lequel une courriel d’avertissement sera envoyé. Ce nombre est relatif au seuil de suppression.';
$string['task_check_and_delete_users'] = 'Vérifier et supprimer les utilisateurs';
$string['user_anonymized'] = 'L’utilisateur avec l’identifiant {$a} a été anonymisé';
$string['user_deleted'] = 'L’utilisateur avec l’identifiant {$a} a été supprimé';
$string['user_recovered'] = 'L’utilisateur avec l’identifiant {$a} était marqué comme inactif, mais est revenu. L’utilisateur ne sera pas supprimé.';
$string['users_to_delete'] = 'Les utilisateurs à supprimer';
$string['users_to_delete_a'] = '{$a} utilisateurs éligibles à la suppression trouvés.';
$string['users_to_warn'] = 'Les utilisateurs à avertir';
$string['users_to_warn_a'] = '{$a} utilisateurs éligibles au courriel d’avertissement trouvés.';
$string['view_scheduled_task_logs'] = 'Voir les journaux brutes des tâches programmées';
$string['view_scheduled_task_logs_desc'] = 'Les vérifications des utilisateurs actifs sont effectuées par une tâche programmée de Moodle, exécutée en arrière-plan. Si vous rencontrez des problèmes avec ce plugin, vous pouvez inspecter les journaux brutes des tâches programmées exécutées en cliquant sur le bouton ci-dessous.';
$string['warned'] = 'Averti';
$string['warning_email_disabled'] = 'Les courriels d’avertissement sont désactivés.';
$string['warning_email_disabled_skipping'] = 'L’envoi de courriels d’avertissement est désactivé, étape ignorée…';
$string['warning_email_sent_to_user'] = 'Courriel d’avertissement envoyé à l’utilisateur ayant l’identifiant {$a}';
