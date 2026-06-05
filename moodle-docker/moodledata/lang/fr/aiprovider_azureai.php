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
 * Strings for component 'aiprovider_azureai', language 'fr', version '5.1'.
 *
 * @package     aiprovider_azureai
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action:explain_text:apiversion'] = 'Version API';
$string['action:explain_text:deployment'] = 'ID de déploiement';
$string['action:explain_text:deployment_help'] = 'L’ID de déploiement du point de terminaison de l’API utilisée par le fournisseur pour cette action.';
$string['action:explain_text:systeminstruction'] = 'Instruction système';
$string['action:explain_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA en même temps que le prompt de l’utilisateur. La modification de cette instruction n’est pas recommandée, à moins d’une nécessité absolue.';
$string['action:generate_image:apiversion'] = 'Version API';
$string['action:generate_image:deployment'] = 'ID de déploiement';
$string['action:generate_image:deployment_help'] = 'L’ID de déploiement du point de terminaison de l’API utilisée par le fournisseur pour cette action.';
$string['action:generate_text:apiversion'] = 'Version API';
$string['action:generate_text:deployment'] = 'ID de déploiement';
$string['action:generate_text:deployment_help'] = 'L’ID de déploiement du point de terminaison de l’API utilisée par le fournisseur pour cette action.';
$string['action:generate_text:systeminstruction'] = 'Instruction système';
$string['action:generate_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA en même temps que le prompt de l’utilisateur. La modification de cette instruction n’est pas recommandée, à moins d’une nécessité absolue.';
$string['action:summarise_text:apiversion'] = 'Version API';
$string['action:summarise_text:deployment'] = 'ID de déploiement';
$string['action:summarise_text:deployment_help'] = 'L’ID de déploiement du point de terminaison de l’API utilisée par le fournisseur pour cette action.';
$string['action:summarise_text:systeminstruction'] = 'Instruction système';
$string['action:summarise_text:systeminstruction_help'] = 'Cette instruction est envoyée au modèle IA en même temps que le prompt de l’utilisateur. La modification de cette instruction n’est pas recommandée, à moins d’une nécessité absolue.';
$string['action_apiversion'] = 'Version API';
$string['action_deployment'] = 'ID de déploiement';
$string['action_deployment_desc'] = 'L’ID de déploiement associé au point de terminaison d’API que le fournisseur utilise pour cette action.';
$string['action_systeminstruction'] = 'Instruction système';
$string['action_systeminstruction_desc'] = 'Cette instruction est envoyée au modèle IA avec le prompt de l’utilisateur. Il n’est pas recommandé de la modifier, sauf si c’est absolument nécessaire.';
$string['apikey'] = 'Clef API Azure AI';
$string['apikey_desc'] = 'Saisir votre clef API Azure AI.';
$string['apikey_help'] = 'Saisir votre clef API Azure AI.';
$string['deployment'] = 'Nom de déploiement API Azure AI';
$string['deployment_desc'] = 'Saisir le nom de déploiement de votre API Azure AI.';
$string['enableglobalratelimit'] = 'Fixer la limite du taux de requêtes pour le site';
$string['enableglobalratelimit_desc'] = 'Limite le nombre de requêtes que tout le site peut faire au fournisseur API Azure AI toutes les heures.';
$string['enableuserratelimit'] = 'Fixer la limite du taux de requêtes pour le site par utilisateur';
$string['enableuserratelimit_desc'] = 'Limite le nombre de requêtes que chaque utilisateur peut faire au fournisseur API Azure AI toutes les heures.';
$string['endpoint'] = 'Point de terminaison API Azure AI';
$string['endpoint_desc'] = 'Saisir l’URL du point de terminaison de votre API Azure AI, dans le format : https://NOM_RESSOURCE.openai.azure.com';
$string['endpoint_help'] = 'Saisir l’URL de point de terminaison de l’API Azure AI dans le format suivant :
https://NOM_DE_VOTRE_RESSOURCE.openai.azure.com';
$string['globalratelimit'] = 'Nombre maximum de requêtes pour tout le site';
$string['globalratelimit_desc'] = 'Le nombre de requêtes permises par heure, pour tout le site.';
$string['pluginname'] = 'Fournisseur API Azure AI';
$string['privacy:metadata'] = 'Le plugin Fournisseur API Azure AI n’enregistre aucune donnée personnelle.';
$string['privacy:metadata:aiprovider_azureai:externalpurpose'] = 'Cette information est envoyée à l’API Azure AI pour permettre la génération d’une réponse. Les réglages de votre compte Azure AI peuvent modifier la façon dont Microsoft enregistre ces données. Aucune donnée personnelle n’est directement envoyée à Microsoft ou enregistrée dans Moodle par ce plugin.';
$string['privacy:metadata:aiprovider_azureai:model'] = 'Le modèle utilisé pour générer la réponse.';
$string['privacy:metadata:aiprovider_azureai:numberimages'] = 'Lorsque des images sont générées, le nombre d’images utilisées dans la réponse.';
$string['privacy:metadata:aiprovider_azureai:prompttext'] = 'Le prompt saisi par l’utilisateur pour générer la réponse.';
$string['privacy:metadata:aiprovider_azureai:responseformat'] = 'Le format de la réponse, quand des images sont générées.';
$string['userratelimit'] = 'Nombre maximum de requêtes par utilisateur';
$string['userratelimit_desc'] = 'Le nombre de requêtes permises par heure, par utilisateur.';
