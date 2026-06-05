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
 * Strings for component 'aiprovider_gemini', language 'fr', version '5.1'.
 *
 * @package     aiprovider_gemini
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
$string['action:generate_image:model_help'] = 'Le modèle utilisé pour générer des images sur la base de prompts utilisateur.';
$string['action:generate_image:systeminstruction'] = 'Instruction système';
$string['action:generate_text:endpoint'] = 'Point de terminaison API';
$string['action:generate_text:model'] = 'Modèle IA';
$string['action:generate_text:model_help'] = 'Le modèle utilisé pour générer la réponse textuelle.';
$string['action:generate_text:systeminstruction'] = 'Instruction système';
$string['action:generate_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA avec le prompt de l’utilisateur. Il n’est pas recommandé de la modifier, sauf si c’est absolument nécessaire.';
$string['action:summarise_text:endpoint'] = 'Point de terminaison API';
$string['action:summarise_text:model'] = 'Modèle IA';
$string['action:summarise_text:model_help'] = 'Le modèle utilisé pour résumer le texte fourni.';
$string['action:summarise_text:systeminstruction'] = 'Instruction système';
$string['action:summarise_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA avec le prompt de l’utilisateur. Il n’est pas recommandé de la modifier, sauf si c’est absolument nécessaire.';
$string['apikey'] = 'Clef API';
$string['custom_model_name'] = 'Nom du modèle personnalisé';
$string['extraparams'] = 'Paramètres supplémentaires';
$string['getallmodels_error'] = 'Vous devez d’abord insérer la clef API.';
$string['invalidjson'] = 'Chaîne JSON non valide';
$string['pluginname'] = 'Fournisseur API Gemini';
$string['privacy:metadata'] = 'Le plugin fournisseur API Gemini n’enregistre aucune donnée personnelle.';
$string['privacy:metadata:aiprovider_gemini:externalpurpose'] = 'Cette information est envoyée à l’API Gemini pour permettre la génération d’une réponse. Les réglages de votre compte Gemini peuvent modifier la façon dont Gemini enregistre ces données. Aucune donnée personnelle n’est directement envoyée à Gemini ou enregistrée dans Moodle par ce plugin.';
$string['privacy:metadata:aiprovider_gemini:model'] = 'Le modèle utilisé pour générer la réponse.';
$string['privacy:metadata:aiprovider_gemini:numberimages'] = 'Lorsque des images sont générées, le nombre d’images utilisées dans la réponse.';
$string['privacy:metadata:aiprovider_gemini:prompttext'] = 'Le prompt saisi par l’utilisateur pour générer la réponse.';
$string['privacy:metadata:aiprovider_gemini:responseformat'] = 'Le format de la réponse, quand des images sont générées.';
$string['settings'] = 'Réglages';
$string['settings_help'] = 'Ajuster les réglages ci-dessous pour personnaliser comment les requêtes sont envoyées à Gemini.';
