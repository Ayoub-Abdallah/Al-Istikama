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
 * Strings for component 'tool_mergeusers', language 'fr', version '5.1'.
 *
 * @package     tool_mergeusers
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['choose_users'] = 'Choisir les utilisateurs à fusionner';
$string['clear_selection'] = 'Désélectionnez l’utilisateur actuel';
$string['cligathering:description'] = 'Entrez les ID utilisateur à fusionner : le premier (fromid) vers le second (toid). Les données liées au premier utilisateur seront transférées vers le second, qui intégrera alors toutes les données.
Introduire les identifiants des utilisateurs pour fusionner le premier dans le second. Le premier identifiant d\'utilisateur (fromid) « perdra » toutes ses données pour être « migré » dans le second (toid). L\'utilisateur « toid » comprendra les données des deux utilisateurs.';
$string['cligathering:fromid'] = 'ID de l’utilisateur d’origine (fromid) :';
$string['cligathering:stopping'] = 'Pour arrêter la fusion, appuyez sur Ctrl+C ou tapez -1 dans les champs fromid ou toid.';
$string['cligathering:toid'] = 'ID de l’utilisateur de destination (toid) :';
$string['dbko_no_transactions'] = '<strong>La fusion a échoué !</strong> <br/> Votre moteur de base de données ne supporte pas les transactions. Par conséquent, votre base de données <strong>a été modifiée</strong> et a été laissée dans un état incohérent. <br/>Vérifiez le journal de la fusion et signalez les erreurs aux développeurs de plugin.<br/> Une fois le plugin corrigé par les développeurs et mis à jour, réitérez la fusion pour finaliser.';
$string['dbko_transactions'] = '<strong>Échec de la fusion !</strong> <br/>Votre moteur de base de données prend en charge les transactions. Par conséquent, l\'ensemble de la transaction en cours a été annulé et <strong>aucune modification n\'a été apportée à votre base de données</strong>.';
$string['dbok'] = 'La fusion a réussi';
$string['deletableuser'] = 'Ce compte utilisateur est suspendu et la dernière fusion a été effectuée avec succès vers un autre compte : ce compte peut être supprimé. <strong>Vérifiez bien avant de continuer</strong>.';
$string['deleted'] = 'L’utilisateur d’ID {$a} a été éliminé';
$string['error_return'] = 'Retourner au formulaire de recherche';
$string['errorsameuser'] = 'Impossible de fusionner le même utilisateur';
$string['errortransactionsonly'] = 'Erreur : le support des transactions est requis, et votre base de données {$a} ne les supporte pas. Si nécessaire, vous pouvez configurer ce module pour que les fusions soient faites sans utiliser les transactions. Ajustez les paramètres en fonction de vos besoins.';
$string['eventusermergedfailure'] = 'Fusion échouée';
$string['eventusermergedsuccess'] = 'Fusion réussie';
$string['exception:nocoursemodule'] = 'Impossible de trouver le module de cours pour le module « {$a->module} », l\'activité « {$a->activityid} » et le cours « {$a->courseid} ».';
$string['exception:nomoduleinstance'] = 'Impossible de trouver l\'activité « {$a->module} » avec l\'identifiant « {$a->activityid} ».';
$string['excluded_exceptions'] = 'Exceptions à exclure';
$string['excluded_exceptions_desc'] = 'L’expérience dans ce domaine suggère que ces tables de base de données doivent être exclues du processus de fusion. Voir le fichier README pour plus de détails.<br>Donc, si vous voulez appliquer le comportement par défaut, vous devez choisir « {$a} » afin d’exclure ces tables du processus de fusion (recommandé).<br>Si vous préférez, vous pouvez choisir les tables que vous souhaitez inclure dans le processus de fusion (non recommandé).';
$string['exportlogs'] = 'Exporter le journal comme CSV';
$string['finishtime'] = 'Fusion terminée à {$a}';
$string['form_description'] = '<p>Vous pouvez rechercher des utilisateurs ici si vous ne connaissez pas leur nom d’utilisateur / numéro d’identification. Sinon, vous pouvez développer le formulaire pour saisir ces informations directement. Veuillez consulter l’aide sur les champs pour en savoir plus</p>';
$string['form_header'] = 'Trouver les utilisateurs à fusionner';
$string['frommedetail'] = 'À partir de ce compte dans {$a->profilelink} avec {$a->success} à {$a->time}. {$a->loglink}';
$string['header'] = 'Fusionner deux comptes utilisateur en un';
$string['header_help'] = '<p>Si un utilisateur doit être supprimé et un autre conservé, cette opération fusionnera les données utilisateur associées au premier utilisateur avec celles du second. Notez que les deux utilisateurs doivent déjà exister et qu\'aucun compte ne sera réellement supprimé. Cette opération doit être effectuée manuellement par l\'administrateur.</p><p><strong>N\'effectuez cette opération que si vous savez ce que vous faites, car elle est irréversible !</strong></p>';
$string['into'] = 'vers';
$string['invalid_option'] = 'Option de formulaire non valide';
$string['invaliduser'] = 'Il n\'existe aucun utilisateur avec le champ « {$a->field} » = « {$a->value} ».';
$string['lastmerge'] = 'Dernières fusions impliquant cet utilisateur :';
$string['logid'] = 'Pour référence ultérieure, ces données apparaissent dans le journal avec l’id {$a}.';
$string['logko'] = 'Les erreurs suivantes se sont produites :';
$string['loglist'] = 'Tous ces enregistrements correspondent à des actions de fusion effectuées, indiquant si elles se sont déroulées correctement :';
$string['logok'] = 'Voici les requêtes qui ont été faites sur la base de données :';
$string['mergedbyuseridonlog'] = 'Fusionné par';
$string['mergeusers'] = 'Fusionner des comptes utilisateur';
$string['mergeusers:mergeusers'] = 'Fusionner comptes utilisateur';
$string['mergeusers:view'] = 'Fusionner les comptes utilisateur';
$string['mergeusers:viewlog'] = 'Afficher les journaux de fusion';
$string['mergeusers_confirm'] = 'Après confirmation, le processus de fusion démarrera. <br /><strong>Ceci est irréversible !</strong> Voulez-vous vraiment continuer ?';
$string['mergeusersadvanced'] = '<strong>Saisie directe de l’utilisateur</strong>';
$string['mergeusersadvanced_help'] = 'Ici, vous pouvez saisir les champs proposés ci-dessous si vous savez exactement quels utilisateurs vous souhaitez fusionner. <br /> <br />Cliquez sur le bouton « rechercher » pour vérifier / confirmer l’existence des utilisateurs.';
$string['merging'] = 'Fusion';
$string['newuser'] = 'Utilisateur à conserver';
$string['newuserid'] = 'ID de l’utilisateur à conserver';
$string['newuseridonlog'] = 'ID de l’utilisateur conservé';
$string['no_saveselection'] = 'Vous n’avez pas sélectionné un ancien ou nouvel utilisateur.';
$string['nologs'] = 'Il n\'y a pas encore de journaux de fusion. Tant mieux pour vous !';
$string['nomergedby'] = 'Non enregistré';
$string['nondeletableuser'] = 'Ce compte utilisateur n\'est pas suspendu et la dernière fusion avec ce compte a été effectuée avec succès : <strong>ce compte est actif et doit être conservé</strong>.';
$string['olduser'] = 'Utilisateur à supprimer';
$string['olduserid'] = 'ID de l’utilisateur à supprimer';
$string['olduseridonlog'] = 'Utilisateur supprimé';
$string['openlog'] = 'Afficher le journal';
$string['pluginname'] = 'Fusionner des comptes utilisateur';
$string['privacy:metadata'] = 'Le plugin Fusionner des comptes utilisateur n’enregistre aucune donnée personnelle.';
$string['profilefields'] = 'Champs du profil utilisateur';
$string['profilefieldsdesc'] = 'Ce plugin affiche désormais l\'état de la fusion dans une case spécifique sur la page de profil utilisateur. Les champs personnalisés du profil utilisateur liés à ce plugin <strong>ne sont plus utilisés et affichent des informations obsolètes</strong>.<p>Nous vous informons que nous avons trouvé les champs avec le nom court « {$a->shortnames} » toujours présents dans les catégories de champs « {$a->categories} ». Veuillez vous rendre sur la <a href="{$a->url}">page de gestion des champs du profil utilisateur</a> pour les supprimer manuellement. Nous ne les avons pas supprimés lors du processus de mise à jour afin de vous permettre de vous adapter à la nouvelle situation.';
$string['qa_action_delete_fromid'] = 'Conserver les tentatives du nouvel utilisateur';
$string['qa_action_delete_toid'] = 'Conserver les tentatives de l’ancien utilisateur';
$string['qa_action_remain'] = 'Ne rien faire : ni fusion ni suppression';
$string['qa_action_remain_log'] = 'Les données utilisateur de la table <strong>{$a}</strong> ne sont pas modifiées.';
$string['qa_action_renumber'] = 'Fusionner les tentatives des utilisateurs et renuméroter';
$string['qa_chosen_action'] = 'Option active pour tentatives de test : {$a}.';
$string['qa_grades'] = 'Notes recalculées pour les tests : {$a}.';
$string['quizattemptsaction'] = 'Résoudre les tentatives d’un test';
$string['quizattemptsaction_desc'] = 'Lors de la fusion des tentatives de quiz, trois cas peuvent se présenter : <ol><li>Seul l\'ancien utilisateur a des tentatives de quiz. Toutes les tentatives apparaîtront comme si elles avaient été effectuées par le nouvel utilisateur. </li><li>Seul le nouvel utilisateur a des tentatives de quiz. Tout est correct et aucune action n\'est effectuée. </li><li>Les deux utilisateurs ont des tentatives pour le même quiz. <strong>Vous devez choisir quoi faire dans ce cas de conflit. </strong>Vous devez choisir l\'une des actions suivantes : <ul> <li><strong>{$a->renumber}</strong>. Les tentatives de l\'ancien utilisateur sont fusionnées avec celles du nouvel utilisateur et renumérotées en fonction de l\'heure à laquelle elles ont été commencées. </li><li><strong>{$a->delete_fromid}</strong>. Les tentatives de l\'ancien utilisateur sont supprimées. Les tentatives du nouvel utilisateur sont conservées, car cette option les considère comme les plus importantes. </li><li><strong>{$a->delete_toid}</strong>. Les tentatives du nouvel utilisateur sont supprimées. Les tentatives de l\'ancien utilisateur sont conservées, car cette option les considère comme les plus importantes. </li><li><strong>{$a->remain}</strong>. Les tentatives ne sont ni fusionnées ni supprimées, elles restent associées à l\'utilisateur qui les a effectuées. Il s\'agit de l\'action la plus sûre, mais la fusion des utilisateurs de l\'utilisateur A vers l\'utilisateur B ou de B vers A peut produire des notes de quiz différentes. </li></ul> </li></ol>';
$string['results'] = 'Fusionner les résultats et le journal';
$string['review_users'] = 'Confirmez utilisateurs à fusionner';
$string['saveselection_submit'] = 'Sauvegarder la sélection';
$string['searchuser'] = 'Chercher l’utilisateur';
$string['searchuser_help'] = 'Saisir l\'expression que à faire correspondre à un champ utilisateur spécifique. Seul l\'identifiant permet une correspondance exacte. Les autres champs utilisateur permettent une correspondance partielle. Vous pouvez également rechercher tous les champs utilisateur pris en charge en même temps.';
$string['setting:invalidjson'] = 'Contenu JSON invalide.';
$string['settings:calculateddbsettings'] = 'Paramètres calculés de la base de données';
$string['settings:calculateddbsettingsdesc'] = 'Les paramètres suivants sont les paramètres calculés de la base de données et les paramètres par défaut, afin de vous aider à comprendre et à comparer les deux types de paramètres. Les paramètres calculés comprennent les paramètres par défaut et les paramètres personnalisés correctement fusionnés, et ils seront utilisés lors de la fusion des utilisateurs. <p><table><tr><th>{$a->calculatedname}</th><th>{$a->defaultname}</th></tr><tr><td><blockquote><code><pre>{$a->calculated}</pre></code></blockquote></td><td><blockquote><code><pre>{$a->default}</pre></code></blockquote></td></tr></table>';
$string['settings:customdbsettings'] = 'Paramètres personnalisés de la base de données';
$string['settings:customdbsettingsdesc'] = 'Spécifiez les paramètres personnalisés de la base de données pour cette instance Moodle au format <strong>JSON</strong>. Ils compléteront et remplaceront les paramètres existants des paramètres par défaut de la base de données. Le contenu actuel du fichier <code>config/config.local.php</code> (s\'il existe) s\'affichera comme valeur par défaut pour vous aider dans le processus de migration. Le contenu est automatiquement formaté lors du stockage de la valeur du paramètre. </p>Si vous rencontrez des problèmes d\'<code>erreur de syntaxe</code> lors du stockage de ce paramètre, veuillez envisager d\'échapper les caractères, car il doit s\'agir d\'une <strong>chaîne JSON</strong> valide. Par exemple, la barre oblique inversée (<code>\\</code>) doit être présente sous la forme d\'une double barre oblique inversée (<code>\\\\\\</code>).';
$string['settings:databasesettings'] = 'Paramètres de la base de données';
$string['settings:defaultdbsettings'] = 'Paramètres par défaut de la base de données à partir de <code>default_db_config.php</code>';
$string['settings:generalsettings'] = 'Paramètres généraux';
$string['starttime'] = 'Fusion démarrée à {$a}';
$string['suspenduser_setting'] = 'Suspendre l’ancien utilisateur';
$string['suspenduser_setting_desc'] = 'S’il est activé, il suspend l’ancien utilisateur automatiquement lors d’un processus de fusion réussi, empêchant l’utilisateur de se connecter à Moodle (recommandé). S’il est désactivé, l’ancien utilisateur reste actif. Dans les deux cas, l\'ancien utilisateur ne disposera pas de ses données associées.';
$string['tableko'] = 'Table {$a} : mise à jour PAS OK !';
$string['tableok'] = 'Table {$a} : mise à jour OK';
$string['tableskipped'] = 'Pour des raisons de traçabilité ou de sécurité, la table <strong>{$a}</strong> n’est pas traitée.<br />Pour supprimer ces entrées, supprimez l’ancien compte utilisateur une fois la fusion réussie.';
$string['timetaken'] = 'La fusion a duré {$a} secondes';
$string['tomedetail'] = 'Depuis {$a->profilelink}, connecté à ce compte avec {$a->success} le {$a->time}. {$a->loglink}';
$string['transactions_not_supported'] = 'Pour votre information, votre base de données <strong>ne prend pas en charge les transactions</strong>.';
$string['transactions_setting'] = 'Seules les transactions sont autorisées';
$string['transactions_setting_desc'] = 'Si cette option est activée, les comptes utilisateur ne peuvent être fusionnés que si votre base de données prend en charge les transactions (recommandé). Avec cette option activée, vous vous assurez que la base de données reste toujours dans un état cohérent, même si une fusion se termine avec des erreurs.<br /> Si cette option est désactivée, vous pourrez fusionner des comptes utilisateur sans utiliser de transactions.
En cas d’erreur, le journal de la fusion montrera quel était le problème. Si vous signalez cette erreur aux développeurs de ce plugin, une solution devrait être trouvée rapidement.<br />À noter : ce plugin prend en charge tous les composants intégrés à Moodle et quelques plugins additionnels. Par conséquent, si vous avez une installation de Moodle standard, vous pouvez exécuter ce plugin sans problème, que cette option soit activée ou désactivée.';
$string['transactions_supported'] = 'Pour votre information, votre base de données <strong>prend en charge les transactions</strong>.';
$string['uniquekeynewidtomaintain'] = 'Conserver les données du nouvel utilisateur';
$string['uniquekeynewidtomaintain_desc'] = 'En cas de conflit, comme lorsque la colonne associée à user.id est une clé unique, ce plugin conservera les données du nouvel utilisateur (par défaut). Cela signifie également que les données de l’ancien utilisateur seront supprimées pour conserver la cohérence. Sinon, si vous décochez cette option, les données de l’ancien utilisateur seront conservées.';
$string['unknownprofile'] = 'Identifiant utilisateur inconnu {$a}';
$string['usermergingheader'] = '&laquo;{$a->username}&raquo; (ID utilisateur = {$a->id})';
$string['userreviewtable_legend'] = '<b>Vérifiez les utilisateurs à fusionner</b>';
$string['userselecttable_legend'] = '<b>Sélectionnez les utilisateurs à fusionner</b>';
$string['viewlog'] = 'Journaux des utilisateurs fusionnés';
$string['wronglogid'] = 'Il n’existe aucun enregistrement correspondant à votre choix.';
