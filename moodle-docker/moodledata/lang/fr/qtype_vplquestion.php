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
 * Strings for component 'qtype_vplquestion', language 'fr', version '5.1'.
 *
 * @package     qtype_vplquestion
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['additionaloptions'] = 'Options supplémentaires';
$string['allornothing'] = 'Tout ou rien';
$string['allowasynceval'] = 'Autoriser les évaluations asynchrones';
$string['allowasynceval_desc'] = 'Si cette option est activée, les enseignants pourront configurer les Questions VPL pour qu’elles soient évaluées de manière asynchrone, via des tâches ad-hoc.';
$string['answertemplate'] = 'Squelette de réponse';
$string['answertemplate_help'] = 'Écrivez ici le code qui sera pré-rempli dans la zone de réponse de l’étudiant.';
$string['awaitingasyncevaluation'] = 'En attente d’évaluation';
$string['cannotimportquestionvplnotfound'] = 'Erreur d’importation : l’id du module VPL de la Question VPL « {$a} » n’est pas valide.';
$string['cannotimportquestionvplunreachable'] = 'Erreur d’importation : le VPL spécifié dans la Question VPL « {$a} » n’est pas dans ce cours.';
$string['choose'] = 'Choisissez…';
$string['closerecievednoretrieve'] = 'Opération abandonnée par le serveur d’exécution. Les limites de ressources d’exécution ont peut-être été dépassées.
Cause : {$a}';
$string['compilation'] = 'Compilation :';
$string['correction'] = 'Correction';
$string['deletesubmissions'] = 'Supprimer les soumissions du VPL';
$string['deletesubmissions_help'] = 'Détermine si les soumissions faites par une Question VPL sur un VPL seront supprimées.<br>
Attention : cette option supprimera toutes les soumissions pour l’utilisateur concerné sur le VPL base lors de l’évaluation de la question. Veillez à ce que le VPL base soit utilisé uniquement pour des Questions VPL.';
$string['editorfontsize'] = 'Taille de police de l’éditeur :';
$string['editoroptions'] = 'Options de l’éditeur';
$string['editortheme'] = 'Thème de l’éditeur :';
$string['errorvplgrade'] = 'La note du VPL n’est pas correctement paramétrée (le réglage doit être « Point »).';
$string['evaluating'] = 'Cette question est en cours d’évaluation…';
$string['evaluatingsoon'] = 'Cette question sera bientôt évaluée…';
$string['evaluatingsoontime'] = 'Cette question sera bientôt évaluée. Temps d’attente estimé : {$a}.';
$string['evaluation'] = 'Évaluation :';
$string['evaluationdetails'] = 'Détails de l’évaluation :';
$string['evaluationerror'] = 'Erreur d’évaluation :';
$string['eventquestionasyncevaluated'] = 'Question VPL évaluée via tâche ad-hoc';
$string['eventquestionevaluationfailed'] = 'Échec de l’évaluation de la Question VPL';
$string['eventquestionevaluationqueued'] = 'Question VPL placée en file d’attente pour évaluation';
$string['execerror'] = 'Erreur d’exécution :';
$string['execfiles'] = 'Fichiers d’exécution';
$string['execfiles_help'] = 'Vous pouvez modifier ici les fichiers d’exécution. Ils sont transmis uniquement lors de l’évaluation (et pré-évaluation si les fichiers sont les mêmes), et non lors de l’exécution (sauf pour les fichiers spécifiés comme étant « à conserver durant l’exécution » dans le VPL).<br>
Pour ajouter des fichiers, créez-les dans le VPL comme fichiers d’exécution.<br>
Les fichiers marqués comme « Hérité du VPL » ne sont pas sauvegardés et utiliseront le contenu des fichiers d’exécution correspondants de l’activité VPL.<br>
<em>Legacy</em> : Les fichiers commençant par « UNUSED » hériteront du contenu des fichiers du VPL. Veuillez considérer utiliser la fonctionnalité « Hériter du VPL » pour ces fichiers.';
$string['execfilesevalsettings'] = 'Fichiers d’exécution et paramètres d’évaluation';
$string['execution'] = 'Erreur d’exécution :';
$string['flagifproblem'] = 'Si vous pensez que la question présente un problème, veuillez la marquer et contacter votre enseignant.';
$string['gradehaschangedreload'] = 'La note vient peut-être de changer. Vous pouvez <a {$a->aattr}>recharger la page</a> pour voir la nouvelle note.';
$string['gradetypeerror'] = 'Il semble que l’évaluation ait donné une note non numérique.';
$string['gradingmethod'] = 'Notation';
$string['gradingmethod_help'] = 'Détermine la méthode de notation de cette question.
<ul><li>Si « Tout ou rien » est sélectionné, l’étudiant obtiendra 100% ou 0% de la note pour cette question, selon qu’il a ou non obtenu une note parfaite sur le VPL.</li>
<li>Si « Proportionnel » est sélectionné, l’étudiant obtiendra une note proportionnelle à celle du VPL.</li></ul>';
$string['informationtext'] = 'Question VPL';
$string['inheritfromvpl'] = 'Hériter du VPL';
$string['lastservermessage'] = 'Dernier message du serveur d’exécution : "{$a}"';
$string['merge'] = 'Fusionner';
$string['noanswertag'] = 'La balise {{ANSWER}} requise est absente. Veuillez l’ajouter au code là où le code étudiant sera injecté.';
$string['nogradeerror'] = 'Une erreur est survenue lors de l’évaluation de cette question (pas de note obtenue).
{$a}';
$string['nogradenoerror'] = 'Aucune erreur levée - la note brute reçue est "{$a}".';
$string['noprecheck'] = 'Pas de pré-évaluation';
$string['noprevplrun'] = 'Cette base VPL n’a pas de fichier pre_vpl_run.sh !';
$string['noprevplrun_help'] = 'Les Questions VPL ont besoin que le VPL base ait un fichier d’exécution pre_vpl_run.sh avec un contenu comme spécifié dans <a href="https://moodle.org/plugins/qtype_vplquestion" target="_blank">la documentation</a>.';
$string['noreqfile'] = 'Cette base VPL n’a pas de fichier requis !';
$string['noreqfile_help'] = 'Les Questions VPL ont besoin que le VPL base ait un fichier requis. La question ne fonctionnera pas dans l’état actuel de cette base.';
$string['overwrite'] = 'Écraser';
$string['overwriteexecfile'] = 'Remplacer';
$string['pleaseanswer'] = 'Merci de fournir une réponse.';
$string['pluginname'] = 'Question VPL';
$string['pluginname_help'] = 'Les Questions VPL permettent aux étudiants d’effectuer de simples exercices de programmation.<br>
Elles fonctionnent à l’aide d’un VPL, mais sont plus simples du point de vue de l’étudiant.';
$string['pluginnameadding'] = 'Ajout d’une Question VPL';
$string['pluginnameediting'] = 'Édition d’une Question VPL';
$string['pluginnamesummary'] = 'Les Questions VPL permettent aux étudiants d’effectuer de simples exercices de programmation.<br>
Elles fonctionnent à l’aide d’un VPL, mais sont plus simples du point de vue de l’étudiant.';
$string['possiblesolution'] = 'Solution proposée :';
$string['precheck'] = 'Pré-évaluer';
$string['precheckexecfiles'] = 'Fichiers d’exécution pour la pré-évaluation';
$string['precheckexecfiles_help'] = 'Vous pouvez modifier ici les fichiers d’exécution de la pré-évaluation. Pour plus d’informations, voir l’aide de « Fichiers d’exécution ».';
$string['precheckhasownfiles'] = 'La pré-évaluation utilise ses propres fichiers';
$string['precheckhassamefiles'] = 'La pré-évaluation utilise les mêmes fichiers que l’évaluation';
$string['precheckhelp'] = 'Évaluer votre réponse sur un sous-ensemble de tests';
$string['precheckisdebug'] = 'La pré-évaluation utilise Debug';
$string['precheckpreference'] = 'Préférences de pré-évaluation';
$string['precheckpreference_help'] = 'Détermine si l’étudiant a accès au bouton « Pré-évaluation » lors de sa tentative (utilisation illimitée).
<ul><li>Si « Pas de pré-évaluation » est sélectionné, le bouton ne sera pas disponible.</li>
<li>Si « La pré-évaluation utilise Debug » est sélectionné, le bouton sera comme le bouton Debug du VPL. Veuillez noter que l’interface graphique usuelle sera indisponible.</li>
<li>Si « La pré-évaluation utilise les mêmes fichiers que l’évaluation » est sélectionné, le bouton évaluera la réponse avec les mêmes fichiers que ci-dessus.</li>
<li>Si « La pré-évaluation utilise ses propres fichiers » est sélectionné, vous pourrez éditer des fichiers d’exécution spécifiques qui seront utilisés pour la pré-évaluation. Cette option est recommandée, car elle vous permet de spécifier un sous-ensemble de tests auquel l’étudiant aura accès durant sa tentative.</li></ul>';
$string['privacy:preference:defaultmark'] = 'La note par défaut choisie pour une question donnée.';
$string['privacy:preference:deletesubmissions'] = 'Si les soumissions VPL doivent être supprimées ou non à l’évaluation de la question.';
$string['privacy:preference:gradingmethod'] = 'Si la note de la question doit être proportionnelle à la note du VPL ou « tout ou rien ».';
$string['privacy:preference:penalty'] = 'La pénalité pour chaque tentative incorrecte lorsqu’une question utilise le comportement « Interactif avec essais multiples » ou « Mode adaptatif ».';
$string['privacy:preference:precheckpreference'] = 'Le comportement du bouton « Pré-évaluer ».';
$string['privacy:preference:useasynceval'] = 'Si la question doit être évaluée de manière asynchrone (via une tâche ad-hoc) ou non.';
$string['qvplbase'] = 'Base de la Question VPL';
$string['reschedule_tasks_for_stranded_questions_task'] = 'Re-planifier les tâches ad-hoc pour les questions bloquées';
$string['run'] = 'Exécuter';
$string['scaling'] = 'Proportionnel';
$string['selectavpl'] = '<a href="{$a}">Sélectionner un VPL</a> pour éditer les fichiers d’exécution.';
$string['serverexecutionerrorstudentmessage'] = 'Cela peut être causé par un facteur externe. Veuillez évaluer à nouveau ou contacter votre enseignant.';
$string['serverexecutionerrorteachermessage'] = 'Cela peut être causé par un facteur externe, ce qui signifie que ce n’est pas nécessairement une mauvaise manipulation de votre part. Veuillez évaluer à nouveau ou contacter le support.';
$string['servermessages'] = 'Messages du serveur :
{$a}';
$string['serverwassilent'] = 'Le serveur d’exécution était silencieux - aucun message reçu.';
$string['switchbacktodefaultfile'] = 'Basculement vers le mode Hériter';
$string['switchbacktodefaultfileprompt'] = 'Vous êtes en train de basculer vers le mode « Hériter du VPL » pour ce fichier, ce qui écrasera son contenu actuel. Continuer ?';
$string['teachercorrection'] = 'Correction de l’enseignant';
$string['teachercorrection_help'] = 'Écrivez ici votre correction pour cette question.';
$string['templatecontext'] = 'Éditer le code';
$string['templatecontext_help'] = 'Vous pouvez éditer ici le code qui sera exécuté (c’est-à-dire le contenu du fichier requis).<br>
La balise « {{ANSWER}} » sera remplacée par la réponse de l’étudiant. Vous pouvez la placer où vous le souhaitez, mais elle doit apparaître !';
$string['templatevpl'] = 'VPL à utiliser comme base';
$string['templatevpl_help'] = 'Sélectionnez le VPL sur lequel baser cette question.<br>
<b>Note :</b> Veuillez sélectionner un VPL dédié à cet effet, notamment si l’option « Supprimer les soumissions du VPL » est réglée à « Oui » ci-après.';
$string['templatevplchange'] = 'Changement de VPL';
$string['templatevplchange_help'] = 'Le code du VPL utilisé comme base et les fichiers d’exécution contiennent des données.<br>
Le changement du VPL de base écrasera ces données, sauf si vous décidez de fusionner le contenu actuel vers le nouveau.<br>
Veuillez noter que la fusion fonctionnera uniquement sur les fichiers ayant le même nom, les fichiers sans correspondance de nom seront écrasés.';
$string['templatevplchangeprompt'] = 'Que voulez-vous faire avec le contenu actuel du code du VPL de base et des fichiers d’exécution ?';
$string['unexpectedendofws'] = 'Fin inattendue de la communication avec le serveur.
Cause : {$a}';
$string['unexpectederror'] = 'Une erreur inattendue est survenue pendant l’évaluation.
{$a}';
$string['useasyncevaluation'] = 'Utiliser l’évaluation asynchrone';
$string['useasyncevaluation_help'] = 'Si réglé sur « Oui », l’évaluation de la question sera déléguée à une tâche ad-hoc asynchrone. Cette option permet une meilleure réactivité des pages du quiz.';
$string['validateonsave'] = 'Valider';
$string['validateonsave_help'] = 'Si cette case est cochée, la correction sera testée avec les cas de tests avant la sauvegarde cette question.';
$string['vplnotavailablewarning'] = 'Attention ! Le VPL utilisé comme base par cette question n’est pas disponible. La question peut ne pas fonctionner correctement.';
$string['vplnotfounderror'] = 'Erreur ! Le VPL utilisé comme base par cette question n’a pas pu être instancié :<br>{$a}';
$string['vplnotincoursewarning'] = 'Attention ! Le VPL utilisé comme base par cette question ne se trouve pas dans ce cours. La question peut ne pas fonctionner correctement.';
$string['wsconnectionerror'] = 'La connexion au serveur a échoué.';
$string['wshandshakeerror'] = 'L’initialisation de la websocket a échoué.';
$string['wsreaderror'] = 'La lecture des données de la websocket a échoué.';
