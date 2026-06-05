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
 * Strings for component 'aiprovider_openai', language 'fr', version '5.1'.
 *
 * @package     aiprovider_openai
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action:explain_text:endpoint'] = 'Point de terminaison API';
$string['action:explain_text:model'] = 'Modèle IA';
$string['action:explain_text:model_help'] = 'Le modèle utilisé pour expliquer le texte fourni.';
$string['action:explain_text:systeminstruction'] = 'Instruction système';
$string['action:explain_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA avec le prompt de l’utilisateur. Il n’est pas recommandé de la modifier, sauf si c’est absolument nécessaire.';
$string['action:generate_image:endpoint'] = 'Point de terminaison API';
$string['action:generate_image:model'] = 'Modèle IA';
$string['action:generate_image:model_desc'] = 'Le modèle utilisé pour générer des images sur la base de prompts utilisateur.';
$string['action:generate_image:model_help'] = 'Le modèle utilisé pour générer des images à partir de prompts d’utilisateurs.';
$string['action:generate_text:endpoint'] = 'Point de terminaison API';
$string['action:generate_text:model'] = 'Modèle IA';
$string['action:generate_text:model_desc'] = 'Le modèle utilisé pour générer la réponse textuelle.';
$string['action:generate_text:model_help'] = 'Le modèle utilisé pour générer des réponses textuelles.';
$string['action:generate_text:systeminstruction'] = 'Instruction système';
$string['action:generate_text:systeminstruction_desc'] = 'Cette instruction est envoyée au modèle IA avec le prompt de l’utilisateur. Il n’est pas recommandé de la modifier, sauf si c’est absolument nécessaire.';
$string['action:generate_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA en même temps que le prompt de l’utilisateur. La modification de cette instruction n’est pas recommandée, à moins d’une nécessité absolue.';
$string['action:summarise_text:endpoint'] = 'Point de terminaison API';
$string['action:summarise_text:model'] = 'Modèle IA';
$string['action:summarise_text:model_desc'] = 'Le modèle utilisé pour résumer le texte fourni.';
$string['action:summarise_text:model_help'] = 'Le modèle utilisé pour résumer le texte fourni.';
$string['action:summarise_text:systeminstruction'] = 'Instruction système';
$string['action:summarise_text:systeminstruction_desc'] = 'Cette instruction est envoyée au modèle IA avec le prompt de l’utilisateur. Il n’est pas recommandé de la modifier, sauf si c’est absolument nécessaire.';
$string['action:summarise_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA en même temps que le prompt de l’utilisateur. La modification de cette instruction n’est pas recommandée, à moins d’une nécessité absolue.';
$string['apikey'] = 'Clef API OpenAI';
$string['apikey_desc'] = 'Obtenir une clef dans les <a href="https://platform.openai.com/account/api-keys" target="_blank">clefs OpenAI Platform API</a>.';
$string['apikey_help'] = 'Obtenir une clef sur la page de vos <a href="https://platform.openai.com/account/api-keys" target="_blank">clefs API OpenAI</a>.';
$string['custom_model_name'] = 'Nom du modèle personnalisé';
$string['enableglobalratelimit'] = 'Fixer la limite du taux de requêtes pour le site';
$string['enableglobalratelimit_desc'] = 'Limite le nombre de requêtes que tout le site peut faire au fournisseur API OpenAI toutes les heures.';
$string['enableuserratelimit'] = 'Fixer la limite du taux de requêtes pour le site par utilisateur';
$string['enableuserratelimit_desc'] = 'Limite le nombre de requêtes que chaque utilisateur peut faire au fournisseur API OpenAI toutes les heures.';
$string['extraparams'] = 'Paramètres supplémentaires';
$string['extraparams_help'] = 'Des paramètres supplémentaires peuvent être configurés ici. Le format JSON est pris en charge. Par exemple :
<pre>
{
    "temperature": 0.5,
    "max_completion_tokens": 100
}
</pre>';
$string['globalratelimit'] = 'Nombre maximum de requêtes pour tout le site';
$string['globalratelimit_desc'] = 'Le nombre de requêtes permises par heure, pour tout le site.';
$string['invalidjson'] = 'Chaîne JSON non valide';
$string['orgid'] = 'ID d’organisation OpenAI';
$string['orgid_desc'] = 'Obtenir une ID d’organisation OpenAI sur votre <a href="https://platform.openai.com/account/org-settings" target="_blank">compte OpenAI Platform</a>';
$string['orgid_help'] = 'Obtenir votre ID d’organisation sur la page de votre <a href="https://platform.openai.com/account/org-settings" target="_blank">compte OpenAI</a>.';
$string['pluginname'] = 'Fournisseur API OpenAI';
$string['privacy:metadata'] = 'Le plugin fournisseur API OpenAI n’enregistre aucune donnée personnelle.';
$string['privacy:metadata:aiprovider_openai:externalpurpose'] = 'Cette information est envoyée à l’API OpenAI pour permettre la génération d’une réponse. Les réglages de votre compte OpenAI peuvent modifier la façon dont OpenAI enregistre ces données. Aucune donnée personnelle n’est directement envoyée à OpenAI ou enregistrée dans Moodle par ce plugin.';
$string['privacy:metadata:aiprovider_openai:model'] = 'Le modèle utilisé pour générer la réponse.';
$string['privacy:metadata:aiprovider_openai:numberimages'] = 'Lorsque des images sont générées, le nombre d’images utilisées dans la réponse.';
$string['privacy:metadata:aiprovider_openai:prompttext'] = 'Le prompt saisi par l’utilisateur pour générer la réponse.';
$string['privacy:metadata:aiprovider_openai:responseformat'] = 'Le format de la réponse, quand des images sont générées.';
$string['settings'] = 'Réglages';
$string['settings_frequency_penalty'] = 'frequency_penalty';
$string['settings_frequency_penalty_help'] = 'La pénalité de fréquence ajuste la fréquence à laquelle les mots sont répétés. Plus la pénalité est élevée, moins il y aura de répétitions dans le texte.';
$string['settings_help'] = 'Ajuster les réglages ci-dessous pour personnaliser comment les requêtes sont envoyées à OpenAI.';
$string['settings_max_completion_tokens'] = 'max_completion_tokens';
$string['settings_max_completion_tokens_help'] = 'Le nombre maximal de tokens utilisés dans le texte généré.';
$string['settings_max_tokens'] = 'Jetons max';
$string['settings_max_tokens_help'] = 'Le nombre maximal de tokens utilisés dans le texte généré.';
$string['settings_presence_penalty'] = 'Pénalité de présence';
$string['settings_presence_penalty_help'] = 'La pénalité de présence encourage le modèle à utiliser de nouveaux mots en augmentant la probabilité de choisir des mots non utilisés jusque là. Une valeur élevée rend le texte plus diversifié, tandis qu’une valeur basse autorise plus de répétition.';
$string['settings_top_p'] = 'top_p';
$string['settings_top_p_help'] = 'La valeur top_p (échantillonnage du noyau) détermine le nombre possible de mots à considérer. Une valeur élevée (p.ex. 0.9) signifie que le modèle considèrera plus de mots possibles, ce qui rend le texte plus diversifié.';
$string['userratelimit'] = 'Nombre maximum de requêtes par utilisateur';
$string['userratelimit_desc'] = 'Le nombre de requêtes permises par heure, par utilisateur.';
