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
 * Strings for component 'aiprovider_ollama', language 'fr', version '5.1'.
 *
 * @package     aiprovider_ollama
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action:explain_text:model'] = 'Modèle d’explication de texte';
$string['action:explain_text:model_help'] = 'Le modèle utilisé pour expliquer le texte fourni.';
$string['action:explain_text:systeminstruction'] = 'Instruction système';
$string['action:explain_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA avec le prompt de l’utilisateur. Il n’est pas recommandé de la modifier, sauf si c’est absolument nécessaire.';
$string['action:generate_text:model'] = 'Modèle de génération de texte';
$string['action:generate_text:model_help'] = 'Le modèle utilisé pour générer la réponse textuelle.';
$string['action:generate_text:systeminstruction'] = 'Instruction système';
$string['action:generate_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA avec le prompt de l’utilisateur. Il n’est pas recommandé de la modifier, sauf si c’est absolument nécessaire.';
$string['action:summarise_text:model'] = 'Modèle de résumé de texte';
$string['action:summarise_text:model_help'] = 'Le modèle utilisé pour résumer le texte fourni.';
$string['action:summarise_text:systeminstruction'] = 'Instruction système';
$string['action:summarise_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA avec le prompt de l’utilisateur. Il n’est pas recommandé de la modifier, sauf si c’est absolument nécessaire.';
$string['custom_model_name'] = 'Nom de modèle personnalisé';
$string['enablebasicauth'] = 'Activer l’authentification basique';
$string['enablebasicauth_help'] = 'Activer l’authentification basique pour le fournisseur API Ollama.';
$string['endpoint'] = 'Point de terminaison API';
$string['endpoint_help'] = 'Le point de terminaison API du fournisseur API Ollama.';
$string['extraparams'] = 'Paramètres supplémentaires';
$string['extraparams_help'] = 'Des paramètres supplémentaires peuvent être configurés ici. Le format JSON est pris en charge. Par exemple :
<pre>
{
    "temperature": 0.5,
    "max_tokens": 100
}
</pre>';
$string['invalidjson'] = 'Chaîne JSON non valide';
$string['password'] = 'Mot de passe';
$string['password_help'] = 'Le mot de passe utilisé pour l’authentification basique.';
$string['pluginname'] = 'Fournisseur API Ollama';
$string['privacy:metadata'] = 'Le plugin Fournisseur API Ollama n’enregistre aucune donnée personnelle.';
$string['privacy:metadata:aiprovider_ollama:externalpurpose'] = 'Ces informations sont envoyées à l’API Ollama afin de générer une réponse. Les réglages de votre compte Ollama peuvent modifier la façon dont Ollama enregistre et conserve ces données. Aucune donnée personnelle n’est envoyée explicitement à Ollama ou enregistrée par Moodle au moyen de ce plugin.';
$string['privacy:metadata:aiprovider_ollama:model'] = 'Le modèle utilisé pour générer la réponse.';
$string['privacy:metadata:aiprovider_ollama:prompttext'] = 'Le prompt saisi par l’utilisateur pour générer la réponse.';
$string['settings'] = 'Réglages';
$string['settings_help'] = 'Ajuster les réglages ci-dessous pour personnaliser comment les requêtes sont envoyées à Ollama.';
$string['settings_mirostat'] = 'Mirostat';
$string['settings_mirostat_help'] = 'Mirostat est un algorithme neuronal de décodage de texte permettant de contrôler la perplexité. 0 = désactvé, 1 = Mirostat, 2 = Mirostat 2.0 (réglage par défaut : 0).';
$string['settings_seed'] = 'graine';
$string['settings_seed_help'] = 'Définit la graine aléatoire utilisée pour la génération. Si la graine est définie avec un nombre déterminé, le modèle générera un même texte pour un même prompt (réglage par défaut : 0).';
$string['settings_temperature'] = 'température';
$string['settings_temperature_help'] = 'La température détermine si la réponse sera plus aléatoire et créative ou au contraire plus prédictible. En augmentant la température, on rend le modèle plus créatif (réglage par défaut : 0.8).';
$string['settings_top_k'] = 'top_k';
$string['settings_top_k_help'] = 'Réduit la probabilité de générer des absurdités. Une valeur élevée (p.ex. 100) donnera des réponses plus diverses, alors qu’une valeur basse (p.ex. 10) sera plus prudente (réglage par défaut : 40).';
$string['settings_top_p'] = 'top_p';
$string['settings_top_p_help'] = 'En combinaison avec top_k. Une valeur élevée (p.ex. 0.95) donnera des réponses plus diverses, alors qu’une valeur plus basse (p.ex. 0.5) générera un texte plus focalisé et plus prudent (réglage par défaut : 0.9).';
$string['username'] = 'Nom d’utilisateur';
$string['username_help'] = 'Le nom d’utilisateur utilisé par l’authentification basique';
