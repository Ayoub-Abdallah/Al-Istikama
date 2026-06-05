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
 * Strings for component 'qbehaviour_certaintywithstudentfbdeferred', language 'fr', version '5.1'.
 *
 * @package     qbehaviour_certaintywithstudentfbdeferred
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allegederror'] = 'Erreur présumée';
$string['allegederror_details'] = 'Erreur présumée ({$a})';
$string['allegederrorplural'] = 'Erreurs présumées';
$string['almostsure'] = 'Quasiment sûr';
$string['almostsure_details'] = 'vous étiez quasiment sûr';
$string['answer'] = 'votre réponse était {$a}';
$string['answercategorydetails'] = '{$a->certainty} et {$a->youranswer}';
$string['answersrepartition'] = 'Répartition des réponses';
$string['attemptsevolution'] = 'Évolution des tentatives';
$string['attempttitle'] = 'Tentative {$a->num} sur {$a->attemptcount} du {$a->date}';
$string['behavioursummary'] = 'Résumé des niveaux de certitude';
$string['clickfordetails'] = '(Cliquez pour voir les détails)';
$string['confidencerate'] = 'Confiance';
$string['confidencerate_help'] = '<p>Indique le degré de certitude moyen des réponses correctes (hors réponses au hasard) ; idéalement, il est élevé puisque vous devriez être plutôt certain de vos réponses correctes ; s’il est faible, cela signifie que vos connaissances sont fragiles ; si vous n’avez donné aucune réponse correcte, le taux de confiance n’est pas calculé.</p><div><b>Valeur :</b> entre {$a->min} et {$a->max}</div>';
$string['confidencerate_nodi'] = 'Confiance';
$string['confidencerate_nodi_help'] = '<p>Indique le degré de certitude moyen des réponses correctes ; idéalement, il est élevé puisque vous devriez être plutôt certain de vos réponses correctes ; s’il est faible, cela signifie que vos connaissances sont fragiles ; si vous n’avez donné aucune réponse correcte, le taux de confiance n’est pas calculé.</p><div><b>Valeur :</b> entre {$a->min} et {$a->max}</div>';
$string['confidenceratea'] = 'Confiance : {$a}';
$string['correct'] = 'correcte';
$string['correctanswers'] = 'Réponses correctes';
$string['declaredignorance'] = 'Réponse au hasard';
$string['declaredignorance_details'] = 'Réponse au hasard (vous avez répondu au hasard, peu importe que votre réponse soit correcte ou incorrecte)';
$string['declaredignoranceplural'] = 'Réponses au hasard';
$string['declaredignorancerate'] = 'Taux de réponses au hasard';
$string['declaredignorancerate_help'] = '<p>Indique la proportion de questions pour lesquelles vous avez répondu en associant le degré de certitude minimal « {$a} », ce qui est interprété comme une réponse « au hasard » de votre part ; les réponses associées à ce degré de certitude ne sont pas prises en comptes dans les autres indicateurs métacognitifs.</p><div><b>Valeur :</b> entre 0% et 100%</div>';
$string['declaredignoranceratea'] = 'Taux de réponses au hasard : {$a}';
$string['declaredignorancerateabove'] = 'Taux de réponses au hasard supérieur à {$a}';
$string['declaredignoranceratebelow'] = 'Taux de réponses au hasard inférieur à {$a}';
$string['expectedtrend'] = 'Tendance attendue';
$string['expectedtrend_help'] = 'Cette courbe décrit la forme globale que l’histogramme prendrait pour un comportement lucide. Plus l’histogramme est proche de la forme de cette courbe, plus vous étiez lucide vis-à-vis de vos réponses et votre certitude.';
$string['gradeover100a'] = 'Note : {$a}/100';
$string['imprudencerate'] = 'Imprudence';
$string['imprudencerate_help'] = '<p>Indique le degré de certitude moyen des réponses incorrectes (hors réponses au hasard) ; idéalement, il est faible puisque vous devriez douter de vos réponses incorrectes ; s’il est élevé, cela signifie que vous faites des erreurs que vous ne soupçonnez pas ; si vous n’avez donné aucune réponse incorrecte, le taux d’imprudence n’est pas calculé.</p><div><b>Valeur :</b> entre {$a->min} et {$a->max}</div>';
$string['imprudencerate_nodi'] = 'Imprudence';
$string['imprudencerate_nodi_help'] = '<p>Indique le degré de certitude moyen des réponses incorrectes ; idéalement, il est faible puisque vous devriez douter de vos réponses incorrectes ; s’il est élevé, cela signifie que vous faites des erreurs que vous ne soupçonnez pas ; si vous n’avez donné aucune réponse incorrecte, le taux d’imprudence n’est pas calculé.</p><div><b>Valeur :</b> entre {$a->min} et {$a->max}</div>';
$string['imprudenceratea'] = 'Imprudence : {$a}';
$string['incorrect'] = 'incorrecte';
$string['incorrectanswers'] = 'Réponses incorrectes';
$string['lucidityindex'] = 'Indice de lucidité';
$string['lucidityindex_help'] = '<p>Cet indice est calculé comme agrégat des degrés de certitude des réponses (en ignorant les réponses au hasard), selon la classification de ces réponses (les réussites confirmées et erreurs présumées comptent positivement, les erreurs insoupçonnées et réussites chanceuses comptent négativement).<br>Plus cette valeur est grande, plus cela indique que vous étiez plutôt sûr de vos réponses correctes et peu sûr de vos réponses incorrectes ; dans le cas contraire, si cette valeur est basse (largement en-dessous de 0), c’est un problème car vous semblez davantage certain de vos réponses incorrectes que de vos réponses correctes ! Enfin, si cette valeur est proche de 0, cela signifie que vous êtes proportionnellement autant sûr de vos réponses correctes que de vos réponses incorrectes.</p><div><b>Valeur :</b> entre -100 et 100</div>';
$string['lucidityindex_nodi'] = 'Indice de lucidité';
$string['lucidityindex_nodi_help'] = '<p>Cet indice est calculé comme agrégat des degrés de certitude des réponses, selon la classification de ces réponses (les réussites confirmées et erreurs présumées comptent positivement, les erreurs insoupçonnées et réussites chanceuses comptent négativement).<br>Plus cette valeur est grande, plus cela indique que vous étiez plutôt sûr de vos réponses correctes et peu sûr de vos réponses incorrectes ; dans le cas contraire, si cette valeur est basse (largement en-dessous de 0), c’est un problème car vous semblez davantage certain de vos réponses incorrectes que de vos réponses correctes ! Enfin, si cette valeur est proche de 0, cela signifie que vous êtes proportionnellement autant sûr de vos réponses correctes que de vos réponses incorrectes.</p><div><b>Valeur :</b> entre -100 et 100</div>';
$string['lucidityindexa'] = 'Indice de lucidité : {$a}';
$string['lucidityindexdisclaimer'] = 'Il y a peu de questions dans ce test, l’indice de lucidité peut être biaisé.';
$string['lucidityindicatorallegederror'] = 'Aucune erreur insoupçonnée, mais au moins une erreur présumée';
$string['lucidityindicatordeclaredignorance'] = 'Toutes les questions ont été répondues au hasard';
$string['lucidityindicatorsureknowledge'] = 'Toutes les réponses sont des réussites confirmées';
$string['lucidityindicatorunexpectederror'] = 'Au moins une erreur insoupçonnée';
$string['lucidityindicatorunsureknowledge'] = 'Aucune erreur, mais au moins une réussite chanceuse';
$string['metacognitiveindicator'] = 'Indicateur métacognitif';
$string['metacognitiveindicators'] = 'Indicateurs métacognitifs';
$string['ncorrectanswers'] = 'Réponses correctes : {$a}';
$string['ndeclaredignorance'] = 'Réponses au hasard : {$a}';
$string['nincorrectanswers'] = 'Réponses incorrectes : {$a}';
$string['nnocertainty'] = 'Réponses sans degré de certitude renseigné : {$a}';
$string['nnotanswered'] = 'Questions non répondues : {$a}';
$string['noallegederror'] = 'Aucune erreur présumée';
$string['nocertaintyprovided'] = 'Vous n’avez pas sélectionné de degré de certitude !';
$string['nodeclaredignorance'] = 'Aucune réponse au hasard';
$string['nosureknowledge'] = 'Aucune réussite confirmée';
$string['nounexpectederror'] = 'Aucune erreur insoupçonnée';
$string['nounsureknowledge'] = 'Aucune réussite chanceuse';
$string['numofanswers'] = 'Nombre de réponses';
$string['otherattempts'] = 'Autres tentatives';
$string['pleaseselectcertainty'] = 'Veuillez sélectionner une catégorie.';
$string['pluginname'] = 'Niveaux de certitude et feedback de l’étudiant (différé)';
$string['pluginsettings'] = 'Paramètres des comportements avec degrés de certitudes';
$string['quitesure'] = 'Assez sûr';
$string['quitesure_details'] = 'vous étiez assez sûr';
$string['quiteunsure'] = 'Peu sûr';
$string['quiteunsure_details'] = 'vous étiez peu sûr';
$string['random'] = 'Fifty-fifty ou moins';
$string['random_alt'] = 'J’ai répondu au hasard';
$string['random_details'] = 'vous avez répondu au hasard';
$string['random_open'] = 'Je pense que c’est faux';
$string['settings:answercategorization'] = 'Catégorisation des réponses';
$string['settings:answerclasses'] = 'Classes de réponses';
$string['settings:answerclassesinfo'] = 'Vous pouvez personnaliser la couleur associée à chaque classe de réponses.<br>Vous pouvez modifier le nom affiché des classes de réponses via <a href="{$a}">les paramètres de personnalisation de la langue</a>.';
$string['settings:certaintylevela'] = 'Degré de certitude {$a}';
$string['settings:certaintylevels'] = 'Degrés de certitude';
$string['settings:certaintylevelsinfo'] = 'Vous pouvez personnaliser le nom affiché (si pertinent), le pourcentage affiché ainsi que la manière dont sera catégorisée chaque réponse selon qu’elle est vraie / fausse, pour chaque degré de certitude.<br>Vous pouvez modifier plus finement le nom affiché des degrés de certitude via <a href="{$a}">les paramètres de personnalisation de la langue</a>.';
$string['settings:enablefbforclasses'] = 'Afficher le champ de commentaire étudiant pour les classes de réponses';
$string['settings:enablefbforclasses_help'] = 'Le champ proposant à l’étudiant d’écrire un commentaire à propos de sa réponse ne sera affiché que pour les réponses appartenant aux classifications sélectionnées.';
$string['settings:error:categoryorder'] = 'Veuillez conserver une continuité entre les catégorisations de degrés de certitude : d’abord un degré optionnel de Réponse au hasard, puis les degrés de Réussites chanceuses / Erreurs présumées, et enfin les degrés de Réussites confirmées / Erreurs insoupçonnées.';
$string['settings:label'] = 'Nom affiché';
$string['settings:loadpresets'] = 'Charger le préréglage d’échelle';
$string['settings:percentage'] = 'Pourcentage';
$string['settings:preset:alternative'] = 'Alternatif (linéaire)';
$string['settings:preset:default'] = 'Défaut (<em>legacy</em>)';
$string['settings:preset:recommended'] = 'Recommandé (non-linéaire)';
$string['settings:studentfeedback'] = 'Champ de commentaire étudiant';
$string['settings:useopenlabel'] = 'le nom alternatif de degré de certitude pour les questions ouvertes';
$string['settings:useopenlabel_help'] = 'Pour les questions ouvertes (i.e. ni Vrai/Faux ni Questions à choix multiple), ce nom alternatif peut être utilisé pour décrire ce degré de certitude.';
$string['settings:useopenlabela'] = 'Utiliser « {$a} » pour les questions ouvertes';
$string['settingsformerrors'] = 'Modifications non enregistrées. Des erreurs ont été trouvées dans les données envoyées. Veuillez vous référer aux messages d’erreur ci-après.';
$string['showthatattempt'] = 'Afficher la tentative';
$string['sure'] = 'Tout à fait sûr';
$string['sure_details'] = 'vous étiez tout à fait sûr';
$string['sureknowledge'] = 'Réussite confirmée';
$string['sureknowledge_details'] = 'Réussite confirmée ({$a})';
$string['sureknowledgeplural'] = 'Réussites confirmées';
$string['thisattempt'] = 'Cette tentative (n°{$a})';
$string['thisattemptdetail'] = 'Détail de cette tentative (n°{$a})';
$string['unexpectederror'] = 'Erreur insoupçonnée';
$string['unexpectederror_details'] = 'Erreur insoupçonnée ({$a})';
$string['unexpectederrorplural'] = 'Erreurs insoupçonnées';
$string['unsure'] = 'Très peu sûr';
$string['unsure_details'] = 'vous étiez très peu sûr';
$string['unsureknowledge'] = 'Réussite chanceuse';
$string['unsureknowledge_details'] = 'Réussite chanceuse ({$a})';
$string['unsureknowledgeplural'] = 'Réussites chanceuses';
$string['viewcoursereport'] = 'Voir l’évolution sur le cours';
$string['whatisyourcertaintylevel'] = 'Quel est votre degré de certitude associé à votre réponse ?';
