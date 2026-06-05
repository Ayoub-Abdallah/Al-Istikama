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
 * Strings for component 'message_kopereemail', language 'fr', version '5.1'.
 *
 * @package     message_kopereemail
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action_create'] = 'Créer un message personnalisé';
$string['action_delete'] = 'Supprimer le message personnalisé';
$string['action_edit'] = 'Modifier le message personnalisé';
$string['action_export'] = 'Exporter le JSON';
$string['action_import'] = 'Importer le JSON';
$string['action_preview'] = 'Modèles';
$string['action_preview_click'] = 'Cliquer ici pour recevoir un courriel avec ce test de modèle';
$string['action_preview_success'] = 'Courriel envoyé correctement. Veuillez vérifier votre boîte de réception ou votre dossier spam.';
$string['export_filename_prefix'] = 'kopereemail-templates';
$string['export_title'] = 'Exporter les modèles';
$string['import_file'] = 'Fichier JSON';
$string['import_file_help'] = 'Sélectionner le JSON exporté depuis l\'autre environnement.';
$string['import_invalid_json'] = 'Fichier non valide : JSON mal formé.';
$string['import_invalid_payload'] = 'Fichier non valide : la structure d’exportation ne correspond pas.';
$string['import_overwrite'] = 'Écraser les modèles existants';
$string['import_overwrite_help'] = 'Si coché, les modèles existants seront mis à jour. Si décoché, les modèles existants seront ignorés.';
$string['import_success'] = 'Importation terminée.<br>&amp;nbsp;&amp;gt; <strong>Importés :</strong> {$a->imported}<br>&amp;nbsp;&amp;gt; <strong>Ignorés :</strong> {$a->skipped}<br>&amp;nbsp;&amp;gt; <strong>Habillage mis à jour :</strong> {$a->wrapper}.';
$string['import_title'] = 'Importer les modèles';
$string['import_wrapper'] = 'Importer l’habillage HTML (modèle de base)';
$string['import_wrapper_help'] = 'Si coché, l’habillage HTML du JSON remplacera l’habillage configuré dans cet environnement.';
$string['messages'] = 'messages';
$string['placeholders_course_data_desc'] = 'Données du cours (lorsqu’elles sont détectables).';
$string['placeholders_course_url_desc'] = 'URL du cours (lorsqu’elle est détectable).';
$string['placeholders_dates_now_desc'] = 'Date/heure actuelles (userdate).';
$string['placeholders_desc'] = 'Vous pouvez utiliser des espaces réservés Mustache dans le message.';
$string['placeholders_fullmessage_desc'] = 'Message en texte brut.';
$string['placeholders_fullmessagehtml_desc'] = 'Message HTML (utiliser des triples accolades).';
$string['placeholders_site_fullname_desc'] = 'Nom complet du site (<code>{$SITE->fullname}</code>).';
$string['placeholders_site_logourl_desc'] = 'Logo du site (<img src="{$a->logo_url}" style="max-width:70px;max-height:70px;">).';
$string['placeholders_site_shortname_desc'] = 'Nom court du site (<code>{$SITE->shortname}</code>).';
$string['placeholders_site_url_desc'] = 'URL du site (<code>{$CFG->wwwroot}</code>).';
$string['placeholders_subject_desc'] = 'Objet de la notification actuelle.';
$string['placeholders_title'] = 'Espaces réservés disponibles';
$string['placeholders_userfrom_data_desc'] = 'Données de l’expéditeur.';
$string['placeholders_userto_data_desc'] = 'Données du destinataire.';
$string['pluginname'] = 'Kopere Email';
$string['privacy:metadata:attachment'] = 'Fichier joint dans le système de fichiers.';
$string['privacy:metadata:attachname'] = 'Nom de la pièce jointe.';
$string['privacy:metadata:externalpurpose'] = 'Finalité externe';
$string['privacy:metadata:fullmessage'] = 'Message en texte brut.';
$string['privacy:metadata:fullmessagehtml'] = 'Message HTML.';
$string['privacy:metadata:recipient'] = 'Destinataire du courriel.';
$string['privacy:metadata:replyto'] = 'Courriel de réponse (Reply-to).';
$string['privacy:metadata:replytoname'] = 'Nom de réponse (Reply-to).';
$string['privacy:metadata:subject'] = 'Objet du courriel.';
$string['privacy:metadata:userfrom'] = 'Expéditeur du courriel.';
$string['settings_customtemplates'] = 'Messages personnalisés par fournisseur';
$string['settings_customtemplates_desc'] = 'Créer/modifier un message personnalisé pour chaque fournisseur de notifications.';
$string['settings_wrapper'] = 'Modèle de base du courriel (habillage)';
$string['settings_wrapper_desc'] = 'Ce HTML est au format Mustache et sera appliqué comme modèle de message à envoyer à l’étudiant. Le contenu HTML doit être inséré à l’emplacement de {{{fullmessagehtml}}}.';
$string['table_actions'] = 'Actions';
$string['table_component'] = 'Composant';
$string['table_name'] = 'Nom';
$string['table_provider'] = 'Fournisseur';
$string['template'] = 'Modèle';
$string['template_changue'] = 'Je souhaite utiliser ce modèle comme modèle par défaut pour Kopere Mail';
$string['template_changued'] = 'Modèle mis à jour avec succès';
$string['template_delete_confirm'] = 'Voulez-vous vraiment supprimer le message personnalisé pour ce fournisseur ?';
$string['template_delete_title'] = 'Supprimer le message personnalisé';
$string['template_deleted'] = 'Message personnalisé supprimé.';
$string['template_edit_bodyhtml'] = 'HTML du message';
$string['template_edit_provider'] = 'Fournisseur';
$string['template_edit_save'] = 'Enregistrer';
$string['template_edit_subject'] = 'Objet (facultatif)';
$string['template_edit_title'] = 'Message personnalisé';
$string['template_preview'] = 'Aperçu du modèle';
$string['template_saved'] = 'Message personnalisé enregistré.';
$string['templates_other'] = 'Autres modèles';
$string['templates_transfer_desc'] = 'Utiliser ce service pour migrer les paramètres entre les environnements (p. ex. préproduction -> production).';
$string['templates_transfer_title'] = 'Exporter / Importer les paramètres';
