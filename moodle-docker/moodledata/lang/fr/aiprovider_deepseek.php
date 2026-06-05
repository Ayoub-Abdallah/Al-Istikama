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
 * Strings for component 'aiprovider_deepseek', language 'fr', version '5.1'.
 *
 * @package     aiprovider_deepseek
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action:explain_text:endpoint'] = 'Point de terminaison API';
$string['action:explain_text:model'] = 'Modèle d’explication de texte';
$string['action:explain_text:model_help'] = 'Le modèle utilisé pour expliquer le texte fourni.';
$string['action:explain_text:systeminstruction'] = 'Instruction système';
$string['action:explain_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA avec le prompt de l’utilisateur. Il n’est pas recommandé de la modifier, sauf si c’est absolument nécessaire.';
$string['action:generate_text:endpoint'] = 'Point de terminaison API';
$string['action:generate_text:model'] = 'Modèle IA';
$string['action:generate_text:model_help'] = 'Le modèle utilisé pour résumer le texte fourni.';
$string['action:generate_text:systeminstruction'] = 'Instruction système';
$string['action:generate_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA avec le prompt de l’utilisateur. Il n’est pas recommandé de la modifier, sauf si c’est absolument nécessaire.';
$string['action:summarise_text:endpoint'] = 'Point de terminaison API';
$string['action:summarise_text:model'] = 'Modèle IA';
$string['action:summarise_text:model_help'] = 'Le modèle utilisé pour résumer le texte fourni.';
$string['action:summarise_text:systeminstruction'] = 'Instruction système';
$string['action:summarise_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA en même temps que le prompt de l’utilisateur. La modification de cette instruction n’est pas recommandée, à moins d’une nécessité absolue.';
$string['apikey'] = 'Clef API DeepSeek';
$string['apikey_help'] = 'Obtenir une clef dans vos <a href="https://platform.deepseek.com/api_keys" target="_blank">clefs DeepSeek API</a>.';
$string['custom_model_name'] = 'Nom de modèle personnalisé';
$string['extraparams'] = 'Paramètres supplémentaires';
$string['extraparams_help'] = 'Des paramètres supplémentaires peuvent être configurés ici. Le format JSON est pris en charge. Par exemple :
<pre>
{
    "temperature": 0.5,
    "max_tokens": 100
}
</pre>';
$string['invalidjson'] = 'Chaîne JSON non valide';
$string['pluginname'] = 'Fournisseur API DeepSeek';
$string['privacy:metadata'] = 'Le plugin Fournisseur API DeepSeek n’enregistre aucune donnée personnelle.';
$string['privacy:metadata:aiprovider_deepseek:externalpurpose'] = 'Cette information est envoyée à l’API DeepSeek pour permettre la génération d’une réponse. Les réglages de votre compte DeepSeek peuvent modifier la façon dont DeepSeek enregistre ces données. Aucune donnée personnelle n’est directement envoyée à DeepSeek ou enregistrée dans Moodle par ce plugin.';
$string['privacy:metadata:aiprovider_deepseek:model'] = 'Le modèle utilisé pour générer la réponse textuelle.';
$string['privacy:metadata:aiprovider_deepseek:prompttext'] = 'Le prompt saisi par l’utilisateur pour générer la réponse.';
$string['settings'] = 'Réglages';
$string['settings_frequency_penalty'] = 'Pénalité de fréquence';
$string['settings_frequency_penalty_help'] = 'Nombre entre -2.0 et 2.0. Les valeurs positives pénalisent les nouveaux mots en fonction de leur fréquence dans le texte jusqu’ici, faisant diminuer la probabilité de répéter la même ligne.';
$string['settings_help'] = 'Ajuster les réglages ci-dessous pour personnaliser les requêtes à DeepSeek.';
$string['settings_logprobs'] = 'logprobs';
$string['settings_logprobs_help'] = 'Indique si les probabilités logarithmiques des jetons de sortie. Si « true », renvoie les probabilités logarithmiques de chaque jeton de sortie renvoyé dans le contenu du message.';
$string['settings_logprobs_label'] = 'Activer';
$string['settings_max_tokens'] = 'Jetons max';
$string['settings_max_tokens_help'] = 'Entier compris entre 1 et 8192. Nombre maximal de jetons pouvant être générés dans la complétion du chat. La longueur totale des jetons d’entrée et des jetons générés est limitée par la longueur du contexte du modèle. Si max_tokens n’est pas spécifié, la valeur par défaut 4096 est utilisée.';
$string['settings_presence_penalty'] = 'Pénalité de présence';
$string['settings_presence_penalty_help'] = 'Nombre entre -2.0 et 2.0. Les valeurs positives pénalisent les nouveaux mots en fonction de leur fréquence dans le texte jusqu’ici, faisant augmenter la probabilité d’insérer de nouveaux termes.';
$string['settings_temperature'] = 'température';
$string['settings_temperature_help'] = 'La température d’échantillonnage à utiliser, entre 0 et 2. Des valeurs plus élevées, comme 0.8, rendront le résultat plus aléatoire, tandis que des valeurs plus faibles, comme 0.2, le rendront plus ciblé et déterministe. Il est recommandé de modifier cette valeur ou top_p, mais pas les deux.';
$string['settings_top_logprobs'] = 'top_logprobs';
$string['settings_top_logprobs_help'] = 'Un entier compris entre 0 et 20 spécifiant le nombre de tokens les plus susceptibles d\'être renvoyés à chaque position de token, chacun avec une probabilité logarithmique associée. Le paramètre « logprobs » doit être défini sur « true » si ce paramètre est utilisé.';
$string['settings_top_p'] = 'top_p';
$string['settings_top_p_help'] = 'Une alternative à l’échantillonnage avec température, appelée échantillonnage par noyau, où le modèle prend en compte les résultats des jetons avec une masse de probabilité « top_p ». Par exemple 0.1 signifie que seuls les jetons représentant les 10 % supérieurs de la masse de probabilité sont pris en compte. Nous recommandons généralement de modifier ce paramètre ou la température, mais pas les deux.';
