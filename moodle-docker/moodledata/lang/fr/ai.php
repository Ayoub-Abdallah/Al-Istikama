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
 * Strings for component 'ai', language 'fr', version '5.1'.
 *
 * @package     ai
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['acceptai'] = 'Accepter et continuer';
$string['action'] = 'Action';
$string['action_explain_text'] = 'Expliquer texte';
$string['action_explain_text_desc'] = 'Explique le contenu textuel sur une page de cours.';
$string['action_explain_text_help'] = 'Fournit une explication qui développe les idées clefs, simplifie les concepts compliqués et ajoute du contexte pour faciliter la compréhension du texte.';
$string['action_explain_text_instruction'] = 'Tu vas recevoir un texte de l’utilisateur. Ta tâche consiste à expliquer le texte fourni. Observe les instructions suivantes :
    1. Élabore : développe les idées et concepts clefs, en t’assurant que l’explication ajoute de la profondeur et évite de répéter le texte.
    2. Simplifie : rend les termes ou idées complexes plus faciles à comprendre, en particulier pour les personnes qui étudient.
    3. Fournis du contexte : explique pourquoi quelque chose se passe, comment ça fonctionne ou quel est l’objectif. Inclus des exemples pertinents ou des analogies pour améliorer la compréhension, lorsque cela est adéquat.
    4. Organise logiquement : structure ton explication naturellement, en commençant par les idées de base avant de passer aux détails plus précis.

Consignes importantes :
    1. Retourne l’explication en texte brut uniquement.
    2. N’inclus pas de formatage markdown, de salutations ou de platitudes.
    3. Mets l’accent sur la clarté, la concision et l’accessibilité.

Veille à ce que l’explication soit facile à lire et qu’elle transmette effectivement les principaux points du texte original.';
$string['action_generate_image'] = 'Générer image';
$string['action_generate_image_desc'] = 'Génère une image selon un prompt textuel.';
$string['action_generate_image_help'] = 'Crée une image sur la base d’un prompt.';
$string['action_generate_text'] = 'Générer texte';
$string['action_generate_text_desc'] = 'Génère un texte selon un prompt textuel.';
$string['action_generate_text_help'] = 'Crée un texte sur la base d’un prompt.';
$string['action_generate_text_instruction'] = 'Tu vas recevoir un texte de l’utilisateur. Ta tâche consiste à générer un texte sur la base de sa requête. Observe ces instructions importantes :
    1. Retourne le résumé en texte brut uniquement.
    2. N’inclus pas de formatage markdown, de salutations ou de platitudes.';
$string['action_summarise_text'] = 'Résumer texte';
$string['action_summarise_text_desc'] = 'Résume le contenu textuel sur une page de cours.';
$string['action_summarise_text_help'] = 'Crée un bref condensé du contenu d’une page.';
$string['action_summarise_text_instruction'] = 'Tu vas recevoir un texte de l’utilisateur. Ta tâche consiste à résumer le texte fourni. Observe les instructions suivantes :
    1. Condense : raccourcis les longs passages pour en faire des points clefs.
    2. Simplifie : rends les informations complexes plus faciles à comprendre, en particulier pour les personnes qui étudient.

Consignes importantes :
    1. Retourne le résumé en texte brut uniquement.
    2. N’inclus pas de formatage markdown, de salutations ou de platitudes.
    3. Mets l’accent sur la clarté, la concision et l’accessibilité.

Veille à ce que le résumé soit facile à lire et qu’il transmette effectivement les principaux points du texte original.';
$string['action_translate_text'] = 'Traduire un texte';
$string['action_translate_text_desc'] = 'Traduit un texte fourni d’une langue à une autre.';
$string['actionsettingprovider'] = 'Réglage d’action {$a}';
$string['actionsettingprovider_desc'] = 'Ces réglages déterminent comment le fournisseur {$a->providername} effectue l’action {$a->actionname}.';
$string['actionsettings'] = 'Réglages d’action';
$string['actionsettings_desc'] = 'Ces réglages définissent les actions de l’IA pour cette instance de fournisseur.';
$string['ai'] = 'IA';
$string['aiactionregister'] = 'Registre d’actions IA';
$string['aiactionshdr'] = 'Sélectionner les fonctionnalités IA pour cette activité :';
$string['aiplacements'] = 'Placements IA';
$string['aipolicyacceptance'] = 'Acceptation de politique IA';
$string['aipolicyregister'] = 'Registre de politique IA';
$string['aiproviders'] = 'Fournisseurs IA';
$string['aireports'] = 'Rapports IA';
$string['aitools'] = 'Outils IA';
$string['aitoolsincourseactivitydesc'] = 'Si ce réglage est activé, vous pouvez indiquer les fonctionnalités IA qui seront disponibles.';
$string['aitoolsincoursedesc'] = 'Si ce réglage est activé, les outils IA seront disponibles pour les activités de ce cours. Les outils IA peuvent être configurés dans les réglages de chaque activité.';
$string['aitoolsnotenabled'] = 'Pour spécifier les fonctionnalités IA disponibles dans cette activité, consulter les réglages du cours et autoriser les outils IA.';
$string['aiusage'] = 'Usage IA';
$string['aiusagepolicy'] = 'Politique d’usage IA';
$string['availableplacements'] = 'Choisir où les actions IA sont disponibles';
$string['availableplacements_desc'] = 'Les placements définissent comment et où les actions IA peuvent être utilisées sur votre site. Ces réglages permettent de choisir les actions disponibles pour chaque placement.';
$string['availableproviders'] = 'Gérer les fournisseurs IA connectés à votre site';
$string['availableproviders_desc'] = 'Les fournisseurs IA ajoutent des fonctionnalités à votre site au moyen d’« actions » telles que résumer un texte ou générer une image.<br />
Les actions peuvent être gérées pour chaque fournisseur dans ses réglages.';
$string['btninstancecreate'] = 'Créer une instance';
$string['btninstanceupdate'] = 'Modifier l’instance';
$string['completiontokens'] = 'Jeton d’achèvement';
$string['completiontokens_help'] = 'Les jetons de complétion sont les morceaux de textes générés par le modèle d’IA en réponse à votre saisie. Les réponses plus longues utilisent plus de jetons, ce qui coûtera probablement plus.';
$string['configureprovider'] = 'Configurer une instance de fournisseur';
$string['contentwatermark'] = 'Généré par IA';
$string['createnewprovider'] = 'Créer une instance de fournisseur';
$string['dateaccepted'] = 'Date d’acceptation';
$string['declineaipolicy'] = 'Refuser';
$string['enableaitoolsincourse'] = 'Autoriser les outils IA pour ce cours';
$string['enableaitoolsincourseactivity'] = 'Autoriser les outils IA pour cette activité';
$string['enableglobalratelimit'] = 'Définir une limite pour le site';
$string['enableglobalratelimit_help'] = 'Limite le nombre de requêtes que le fournisseur AI peut recevoir chaque heure de la part de ce site.';
$string['enableuserratelimit'] = 'Définir une limite par utilisateur';
$string['enableuserratelimit_help'] = 'Limite le nombre de requêtes que chaque utilisateur peut envoyer chaque heure au fournisseur IA.';
$string['error:400'] = 'Requête incorrecte';
$string['error:401'] = 'Non autorisé';
$string['error:401:upstreamless'] = 'Impossible de se connecter au service IA. Essayez plus tard.';
$string['error:404'] = 'Non trouvé';
$string['error:404:upstreamless'] = 'Le service IA est temporairement indisponible. Essayez plus tard.';
$string['error:429'] = 'Trop de requêtes';
$string['error:429:internalsitewide'] = 'Le service IA a atteint le nombre maximum de requêtes du site par heure. Essayez plus tard.';
$string['error:429:internaluser'] = 'Vous avez atteint le nombre maximum de requêtes IA que vous pouvez faire en une heure. Essayez plus tard.';
$string['error:429:upstreamless'] = 'Ce service IA a atteint sa limite de requêtes. Essayez plus tard.';
$string['error:500'] = 'Erreur de serveur interne';
$string['error:503'] = 'Service indisponible';
$string['error:actionnotfound'] = 'L’action « {$a} » n’est pas prise en charge.';
$string['error:defaultmessage'] = 'Une erreur est survenue lors du traitement de votre requête. Essayez plus tard.';
$string['error:defaultmessageshort'] = 'Essayez plus tard.';
$string['error:defaultname'] = 'Une erreur est survenue';
$string['error:noproviders'] = 'Aucun fournisseur disponible pour traiter l’action.';
$string['error:providernotfound'] = 'Instance de fournisseur IA introuvable.';
$string['error:unknown'] = 'Erreur inconnue';
$string['globalratelimit'] = 'Nombre maximal de requêtes du site';
$string['globalratelimit_help'] = 'Le nombre de requêtes autorisées chaque heure pour tout le site.';
$string['manageaiplacements'] = 'Gérer les placements IA';
$string['manageaiproviders'] = 'Gestion des fournisseurs IA';
$string['noproviderplugins'] = 'Aucun plugin fournisseur IA n’est installé. Veuillez installer un plugin fournisseur IA pour activer la création d’instances de fournisseur.';
$string['noproviders'] = 'Cette action n’est pas disponible. Aucun <a href="{$a}">fournisseur IA</a> n’est configuré pour cette action.';
$string['off'] = 'Désactivé';
$string['on'] = 'Activé';
$string['placement'] = 'Placement';
$string['placementactionsettings'] = 'Actions';
$string['placementactionsettings_desc'] = 'Les actions AI disponibles pour ce placement.';
$string['placementsettings'] = 'Réglages spécifiques au placement';
$string['placementsettings_desc'] = 'Ces réglages déterminent comment ce placement IA se connecte au service IA et d’autres opérations en lien.';
$string['privacy:metadata:ai_action_explain_text'] = 'Une table enregistrant les requêtes d’explication faites par les utilisateurs.';
$string['privacy:metadata:ai_action_explain_text:completiontoken'] = 'Les jetons de complétion utilisés pour expliquer le texte.';
$string['privacy:metadata:ai_action_explain_text:fingerprint'] = 'Le hachage unique représentant l’état/la version du modèle et du contenu.';
$string['privacy:metadata:ai_action_explain_text:generatedcontent'] = 'Le texte généré par le modèle IA sur la base du prompt envoyé.';
$string['privacy:metadata:ai_action_explain_text:prompt'] = 'Le prompt de la requête d’explication de texte.';
$string['privacy:metadata:ai_action_explain_text:prompttokens'] = 'Les jetons de prompt utilisés pour expliquer le texte.';
$string['privacy:metadata:ai_action_explain_text:responseid'] = 'L’ID de la réponse.';
$string['privacy:metadata:ai_action_generate_image'] = 'Une table contenant les requêtes de génération faites par les utilisateurs.';
$string['privacy:metadata:ai_action_generate_image:aspectratio'] = 'Le rapport hauteur/largeur des images générées.';
$string['privacy:metadata:ai_action_generate_image:numberimages'] = 'Le nombre d’images générées.';
$string['privacy:metadata:ai_action_generate_image:prompt'] = 'Le prompt de la requête de génération d’image.';
$string['privacy:metadata:ai_action_generate_image:quality'] = 'La qualité des images générées.';
$string['privacy:metadata:ai_action_generate_image:revisedprompt'] = 'Le prompt des images générées, révisé.';
$string['privacy:metadata:ai_action_generate_image:sourceurl'] = 'L’URL source des images générées.';
$string['privacy:metadata:ai_action_generate_image:style'] = 'Le style des images générées.';
$string['privacy:metadata:ai_action_generate_text'] = 'Une table contenant les requêtes des utilisateurs.';
$string['privacy:metadata:ai_action_generate_text:completiontoken'] = 'Les jetons de complétion utilisés pour générer le texte.';
$string['privacy:metadata:ai_action_generate_text:fingerprint'] = 'Le hachage unique représentant l’état/la version du modèle et du contenu.';
$string['privacy:metadata:ai_action_generate_text:generatedcontent'] = 'Le texte généré par le modèle IA sur la base du prompt envoyé.';
$string['privacy:metadata:ai_action_generate_text:prompt'] = 'Le prompt de requête pour la génération du texte.';
$string['privacy:metadata:ai_action_generate_text:prompttokens'] = 'Les jetons de prompt utilisés pour générer le texte.';
$string['privacy:metadata:ai_action_generate_text:responseid'] = 'L’ID de la réponse.';
$string['privacy:metadata:ai_action_register'] = 'Une table contenant les requêtes d’action des utilisateurs.';
$string['privacy:metadata:ai_action_register:actionid'] = 'L’ID de la requête d’action.';
$string['privacy:metadata:ai_action_register:actionname'] = 'Le nom de l’action de la requête.';
$string['privacy:metadata:ai_action_register:model'] = 'Le modèle utilisé pour générer la réponse';
$string['privacy:metadata:ai_action_register:provider'] = 'Le nom du fournisseur qui a traité la requête.';
$string['privacy:metadata:ai_action_register:success'] = 'L’état de la requête d’action.';
$string['privacy:metadata:ai_action_register:timecompleted'] = 'L’horodatage de la fin de la requête.';
$string['privacy:metadata:ai_action_register:timecreated'] = 'L’horodatage de la création de la requête.';
$string['privacy:metadata:ai_action_register:userid'] = 'L’ID de l’utilisateur qui a fait la requête.';
$string['privacy:metadata:ai_action_summarise_text'] = 'Une table contenant les requêtes de résumé de textes des utilisateurs.';
$string['privacy:metadata:ai_action_summarise_text:completiontoken'] = 'Les jetons de complétion utilisés pour résumer le texte.';
$string['privacy:metadata:ai_action_summarise_text:fingerprint'] = 'Le hachage unique représentant l’état/la version du modèle et du contenu.';
$string['privacy:metadata:ai_action_summarise_text:generatedcontent'] = 'Le texte généré par le modèle IA sur la base du prompt saisi.';
$string['privacy:metadata:ai_action_summarise_text:prompt'] = 'Le prompt de la requête de résumé de texte.';
$string['privacy:metadata:ai_action_summarise_text:prompttokens'] = 'Les jetons du prompt utilisés pour résumer le texte.';
$string['privacy:metadata:ai_action_summarise_text:responseid'] = 'L’ID de la réponse.';
$string['privacy:metadata:ai_policy_register'] = 'Une table contenant le statut d’acceptation de la politique IA pour chaque utilisateur.';
$string['privacy:metadata:ai_policy_register:contextid'] = 'L’ID du contexte où les données ont été enregistrées.';
$string['privacy:metadata:ai_policy_register:timeaccepted'] = 'L’horodatage de l’acceptation de la politique IA par l’utilisateur.';
$string['privacy:metadata:ai_policy_register:userid'] = 'L’ID de l’utilisateur dont les données ont été enregistrées.';
$string['prompttokens'] = 'Jeton de prompt';
$string['prompttokens_help'] = 'Les jetons de prompt sont de morceaux de textes qui composent votre saisie envoyée au modèle d’IA. Les prompts plus longs utilisent plus de jetons, ce qui coûtera probablement plus.';
$string['provider'] = 'Fournisseur';
$string['provideractionsettings'] = 'Actions';
$string['provideractionsettings_desc'] = 'Choisir et configurer les actions que le fournisseur {$a} peut effectuer sur votre site.';
$string['providerinstanceactionupdated'] = 'Réglage d’action {$a} modifié';
$string['providerinstancecreated'] = 'Instance de fournisseur IA {$a} créée.';
$string['providerinstancedelete'] = 'Supprimer l’instance de fournisseur IA';
$string['providerinstancedeleteconfirm'] = 'Vous allez supprimer l’instance de fournisseur IA {$a->name} ({$a->provider}). Voulez-vous vraiment continuer ?';
$string['providerinstancedeleted'] = 'Instance de fournisseur IA {$a} supprimée.';
$string['providerinstancedeletefailed'] = 'Impossible de supprimer l’instance de fournisseur IA {$a}. Le fournisseur est soit en cours d’utilisation, soit il s’agit d’un problème avec la base de données. Vérifiez si le fournisseur est actif ou contactez l’administrateur de la base de données.';
$string['providerinstancedisablefailed'] = 'Impossible de désactiver l’instance de fournisseur IA. Le fournisseur est soit en cours d’utilisation, soit il s’agit d’un problème avec la base de données. Vérifiez si le fournisseur est actif ou contactez l’administrateur de la base de données.';
$string['providerinstanceupdated'] = 'Instance de fournisseur IA {$a} modifiée';
$string['providermoveddown'] = '{$a} déplacé vers le bas.';
$string['providermovedup'] = '{$a} déplacé vers le haut.';
$string['providername'] = 'Nom de l’instance';
$string['providers'] = 'Fournisseurs';
$string['providersettings'] = 'Réglages';
$string['providertype'] = 'Choisir un plugin Fournisseur IA';
$string['timegenerated'] = 'Temps de génération';
$string['unknownvalue'] = '—';
$string['userpolicy'] = '<h4><strong>Bienvenue dans la nouvelle fonctionnalité IA !</strong></h4>
<p>Cette fonction d’intelligence artificielle (IA) est basée uniquement sur de grands modèles de langue (LLM) externes pour permettre d’améliorer l’expérience d’apprentissage et d’enseignement. Avant de commencer à utiliser ces services d’IA, veuillez lire cette politique d’utilisation.</p>
<h4><strong>Exactitude du contenu généré par l’IA</strong></h4>
<p>L’IA peut donner des suggestions et des informations utiles, mais leur exactitude est douteuse. Vous devez toujours vérifier les informations fournies pour vous assurer qu’elles sont exactes, complètes et adaptées à votre situation spécifique.</p>
<h4><strong>Comment vos données sont traitées</strong></h4>
<p>Cette fonctionnalité IA utilise des grands modèles de langage (LLM) externes. Si vous choisissez d’utiliser cette fonction, toute information et donnée personnelle que vous envoyez sera traitée conformément à la politique de confidentialité de ces LLMs. Nous vous recommandons de lire leur politique de confidentialité pour comprendre comment ils traiteront vos données. En outre, un enregistrement de vos interactions avec les fonctions IA peut être enregistré sur ce site.</p>
<p>Si vous avez des questions sur la façon dont vos données sont traitées, veuillez vous adresser à vos enseignants ou à votre institution.</p>
<p>En continuant, vous confirmez avoir compris et accepter cette politique.</p>';
$string['userratelimit'] = 'Nombre maximal de requêtes par utilisateur';
$string['userratelimit_help'] = 'Le nombre de requêtes autorisé par utilisateur et par heure.';
