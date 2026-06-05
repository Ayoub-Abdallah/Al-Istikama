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
 * Strings for component 'block_openai_chat', language 'fr', version '5.1'.
 *
 * @package     block_openai_chat
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowinstancesettings'] = 'Paramètres d\'instance';
$string['allowinstancesettingsdesc'] = 'Ce paramètre permet aux enseignants, ou à toute personne ayant la possibilité d\'ajouter un bloc dans un contexte, d\'ajuster les paramètres au niveau de chaque bloc. L\'activation de ce paramètre pourrait entraîner des frais supplémentaires en permettant à des non-administrateurs de choisir des modèles plus coûteux ou d\'autres paramètres.';
$string['askaquestion'] = 'Poser une question…';
$string['assistantname'] = 'Nom de l\'assistant';
$string['assistantnamedesc'] = 'Le nom que l\'IA utilisera pour elle-même en interne. Il est également utilisé pour les titres de l\'interface utilisateur dans la fenêtre de discussion.';
$string['blocktitle'] = 'Titre du bloc';
$string['config_assistantname'] = 'Nom de l\'assistant';
$string['config_assistantname_help'] = 'Il s\'agit du nom que l\'IA utilisera pour l\'assistant. S\'il est vide, c\'est le nom de l\'assistant du site qui sera utilisé. Ce nom est également utilisé pour les titres de l\'interface utilisateur dans la fenêtre de discussion.';
$string['config_persistconvo'] = 'Conserver la conversation';
$string['config_persistconvo_help'] = 'Si cette case est cochée, l’assistant se souviendra des conversations de ce bloc entre les différents chargements de page.';
$string['config_prompt'] = 'Texte d’invite pour la réponse';
$string['config_prompt_help'] = 'Ceci est l’invite qui sera fournie à l’IA avant la transcription de la conversation. Vous pouvez influencer la personnalité de l’IA en modifiant cette description. Par défaut, l’invite est : « Ci-dessous se trouve une conversation entre un utilisateur et un assistant de support pour un site Moodle, où les utilisateurs viennent pour l’apprentissage en ligne. »';
$string['config_sourceoftruth'] = 'Source de vérité';
$string['config_sourceoftruth_help'] = 'Vous pouvez ajouter ici des informations dont l’IA tiendra compte pour répondre aux questions. Les informations doivent être présentées exactement sous forme de questions et de réponses, comme dans les exemples suivants : 
Q : Quand la section 3 doit-elle être rendue ? R : Jeudi 16 mars.
Q : Quelles sont les heures de permanence ? R : Vous pouvez trouver le professeur Shown dans son bureau entre 14h00 et 16h00, les mardis et jeudis.';
$string['config_username'] = 'Nom de l\'utilisateur';
$string['config_username_help'] = 'C’est le nom que l’IA utilisera pour désigner l’utilisateur. Si ce champ est vide, le nom d’utilisateur défini pour l’ensemble du site sera utilisé. Ce nom apparaît également dans les en-têtes de la fenêtre de discussion.';
$string['defaultassistantname'] = 'Assistant';
$string['defaultprompt'] = 'Ci-dessous se trouve une conversation entre un utilisateur et un assistant de support pour un site Moodle, où les utilisateurs viennent pour l’apprentissage en ligne :';
$string['defaultusername'] = 'Utilisateur';
$string['downloadfilename'] = 'block_openai_chat_logs';
$string['erroroccurred'] = 'Une erreur s\'est produite ! Veuillez réessayer plus tard.';
$string['logging'] = 'Activer la journalisation';
$string['loggingdesc'] = 'Si ce paramètre est activé, tous les messages des utilisateurs et les réponses de l\'IA seront enregistrés.';
$string['loggingenabled'] = 'L\'enregistrement est activé. Tous les messages que vous envoyez ou recevez ici seront enregistrés et pourront être consultés par l\'administrateur du site.';
$string['new_chat'] = 'Nouvelle discussion';
$string['openai_chat'] = 'Open AI Chat';
$string['openai_chat:addinstance'] = 'Ajouter un nouveau bloc OpenAI Chat';
$string['openai_chat:myaddinstance'] = 'Ajouter un nouveau bloc OpenAI Chat à la page Mon Moodle';
$string['openai_chat:viewreport'] = 'Voir le rapport de OpenAI Chat';
$string['openai_chat_logs'] = 'Journal de bord de OpenAI Chat';
$string['persistconvo'] = 'Conserver les conversations';
$string['persistconvodesc'] = 'Si cette case est cochée, l’assistant se souviendra de la conversation entre les différents chargements de page. Toutefois, chaque instance de bloc conservera des conversations séparées. Par exemple, la conversation d’un utilisateur sera conservée entre les chargements de page au sein d’un même cours, mais discuter avec un assistant dans un autre cours ne poursuivra pas la même conversation.';
$string['pluginname'] = 'Bloc Open AI Chat';
$string['popout'] = 'Fenêtre Open AI Chat';
$string['privacy:chatmessagespath'] = 'Envoyer les messages de Open AI Chat';
$string['privacy:metadata:openai_chat_log'] = 'Messages d\'utilisateurs enregistrés envoyés à OpenAI. Cela comprend l\'ID de l\'utilisateur qui a envoyé le message, le contenu du message, la réponse de OpenAI et l\'heure à laquelle le message a été envoyé.';
$string['privacy:metadata:openai_chat_log:airesponse'] = 'La réponse de OpenAI.';
$string['privacy:metadata:openai_chat_log:timecreated'] = 'L\'heure à laquelle le message a été envoyé.';
$string['privacy:metadata:openai_chat_log:userid'] = 'L\'ID de l\'utilisateur qui a envoyé le message.';
$string['privacy:metadata:openai_chat_log:usermessage'] = 'Le contenu du message.';
$string['prompt'] = 'Prompt de réponse';
$string['promptdesc'] = 'L\'invite que l\'IA recevra avant la transcription de la conversation';
$string['restrictusage'] = 'Restreindre l\'utilisation aux utilisateurs connectés';
$string['restrictusagedesc'] = 'Si cette case est cochée, seuls les utilisateurs connectés pourront utiliser la boîte de dialogue.';
$string['showlabels'] = 'Afficher les libellés';
$string['sourceoftruth'] = 'Source de vérité';
$string['sourceoftruthdesc'] = 'Bien que l’IA soit très performante dès l’installation, si elle ne connaît pas la réponse à une question, elle risque davantage de fournir une information incorrecte de façon assurée que de refuser de répondre. Dans cette zone de texte, vous pouvez ajouter des questions fréquentes ainsi que leurs réponses, afin que l’IA puisse s’y référer. Veuillez formuler les questions et réponses selon le format suivant : <pre>Q : Question 1<br />R : Réponse 1<br /><br />Q : Question 2<br />R : Réponse 2</pre>';
$string['sourceoftruthpreamble'] = 'Ci-dessous, une liste de questions et leurs réponses. Ces informations doivent être utilisées comme référence pour toute demande de renseignements.';
$string['username'] = 'Nom de l\'utilisateur';
$string['usernamedesc'] = 'Le nom que l\'IA utilisera pour l\'utilisateur en interne. Il est également utilisé pour les titres de l\'interface utilisateur dans la fenêtre de discussion.';
