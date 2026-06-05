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
 * Strings for component 'collabora', language 'fr', version '5.1'.
 *
 * @package     collabora
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cachedef_discovery'] = 'Fichier xml discovery pour Collabora';
$string['collabora:addinstance'] = 'Ajouter un document collaboratif au cours';
$string['collabora:directdownload'] = 'Télécharger directement le document';
$string['collabora:editlocked'] = 'Éditer un document collaboratif verrouillé';
$string['collabora:lock'] = 'Verrouiller/déverrouiller un document collaboratif';
$string['collabora:manageversions'] = 'Gérer les version d\'un document collaboratif';
$string['collabora:repair'] = 'Réparer un document endommagé';
$string['collabora:view'] = 'Afficher un document collaboratif';
$string['collaboraurl'] = 'URL Collabora';
$string['collaboraurlnotset'] = 'L\'URL Collabora n\'est pas configurée pour ce site';
$string['couldnotdeleteversion'] = 'Impossible de supprimer cette version';
$string['couldnotrestoreversion'] = 'Impossible de restaurer cette version';
$string['current'] = 'Onglet actuel';
$string['defaultdisplay'] = 'Affichage par défaut';
$string['defaultdisplaydescription'] = 'Description de l\'affichage par défaut';
$string['defaultdisplayname'] = 'Nom de l\'affichage par défaut';
$string['defaultformat'] = 'Format par défaut';
$string['display'] = 'Affichage';
$string['display_help'] = 'Quand « Nouvel onglet » est sélectionné, le document est affiché dans sa taille maximale dans un nouvel onglet';
$string['displaydescription'] = 'Afficher le titre';
$string['displayname'] = 'Afficher la description';
$string['displayname_help'] = 'Si activé, le nom du fichier actif est affiché au-dessus du document.';
$string['dnduploadcollabora'] = 'Créer un document Collabora';
$string['enableversions'] = 'Activer le suivi des versions';
$string['enableversions_help'] = 'Si activé, une nouvelle version est créée à chaque enregistrement des modifications. Ces versions peuvent être téléchargées et restaurées au cas par cas.';
$string['eventdocumentlocked'] = 'Document collaboratif verrouillé';
$string['eventdocumentrepaired'] = 'Document collaboratif réparé';
$string['eventdocumentunlocked'] = 'Document collaboratif déverrouillé';
$string['format'] = 'Type de document';
$string['fullscreen'] = 'Plein écran';
$string['height'] = 'Hauteur (0 pour automatique)';
$string['initialfile'] = 'Fichier initial';
$string['initialtext'] = 'Texte initial';
$string['locked'] = 'Document verrouillé par l\'enseignant';
$string['lockedunlock'] = 'Document verrouillé, cliquer ici pour le déverrouiller et autoriser la modification';
$string['modulename'] = 'Document collaboratif';
$string['modulename_help'] = 'Avec cette activité, vous pouvez utiliser un serveur Collabora Online pour créer un document texte, un document de traitement de texte, une présentation ou un tableur, ou télécharger un document et travailler de manière collaborative sur celui-ci.';
$string['modulenameplural'] = 'Documents collaboratifs';
$string['name'] = 'Titre';
$string['new'] = 'Nouvel onglet';
$string['nogroupaccess'] = 'Cette activité n\'est disponible que pour les utilisateurs  qui sont membres d\'un groupe de ce cours';
$string['pleasewait'] = 'Veuillez patienter…';
$string['pluginadministration'] = 'Paramètres du document collaboratif';
$string['pluginname'] = 'Document collaboratif';
$string['presentation'] = 'Diaporama';
$string['privacy:metadata:collabora_extsystem'] = 'Les informations et le contenu du fichier sont partagés avec Collabora pour permettre le travail collaboratif';
$string['privacy:metadata:collabora_extsystem:filecontent'] = 'Le contenu du fichier';
$string['privacy:metadata:collabora_extsystem:lastmodified'] = 'La date a laquelle le fichier a été modifié pour la dernière fois';
$string['privacy:metadata:collabora_extsystem:username'] = 'Le nom d\'utilisateur';
$string['privacy:metadata:core_files'] = 'mod_collabora stocke les fichiers collaboratifs.';
$string['repair'] = 'Réparer';
$string['repair_failed'] = 'Le document n\'a pas pu être réparé.';
$string['repair_succeeded'] = 'Le document a été réparé.';
$string['repairdocument'] = 'Réparer le document « {$a} »';
$string['repairdocumentconfirm'] = 'Voulez-vous réellement essayer de réparer le document actuel ?';
$string['repairdocumentconfirm_help'] = 'Parfois, le serveur Collabora ne charge pas le dernier document en raison d’un conflit de version ou d’un processus bloqué.
En général, ce problème se résout de lui‑même, mais cela peut prendre du temps et vous ne pourrez pas travailler sur votre document entre‑temps.
Si vous utilisez cette fonction de réparation, un nouveau processus sera démarré sur le serveur Collabora et associé au dernier document enregistré dans Moodle.
Remarque : assurez‑vous que le document n’est pas utilisé par d’autres utilisateurs. Sinon, ils recevront un message d’erreur s’ils tentent d’enregistrer le document.';
$string['requiredfortext'] = 'Requis si le format est « Texte spécifié »';
$string['requiredforupload'] = 'Requis si le format est « Envoi de fichier »';
$string['restorewindowsize'] = 'Rétablir la taille de la fenêtre';
$string['setting_allowcollaboraserverexplicit'] = 'Autoriser explicitement l’URL de Collabora';
$string['setting_allowcollaboraserverexplicit_help'] = '<strong>Remarque : </strong> Ce paramètre peut représenter un risque de sécurité. Vous ne devez l’activer que si votre serveur Collabora fonctionne sur un réseau privé ou sur le même hôte que Moodle.<br>
Si votre serveur Collabora est accessible depuis l’un des hôtes définis dans <strong>$CFG->curlsecurityblockedhosts</strong> , vous devez activer ce réglage ou retirer l’hôte de la liste bloquée.';
$string['setting_connection'] = 'Connexion';
$string['setting_header_security'] = 'Sécurité';
$string['setting_share_userimages'] = 'Partager les images des utilisateurs avec les utilisateurs Collabora.';
$string['setting_share_userimages_help'] = 'Les utilisateurs qui travaillent ensemble sur un document peuvent voir les images des utilisateurs dans l’éditeur Collabora. Si vous ne le souhaitez pas, désactivez ce réglage.';
$string['setting_showlegacytemplates'] = 'Afficher les modèles historiques';
$string['setting_showlegacytemplates_help'] = 'Lorsqu’un nouveau document est créé, les anciens modèles peuvent également être utilisés en plus des modèles définis ici.';
$string['setting_showserveraudit'] = 'Afficher l\'audit du serveur';
$string['setting_showserveraudit_help'] = 'Si activé, l’utilisateur siteadmin dispose d’un élément de menu supplémentaire « Audit du serveur » dans le menu de l’éditeur Collabora, qui affiche certaines informations sur le serveur Collabora.';
$string['setting_templates'] = 'Modèles';
$string['spreadsheet'] = 'Tableur';
$string['task_cleanup'] = 'Nettoyage';
$string['template_fixed_text'] = 'Fichier de texte brut avec contenu prérempli.';
$string['template_fixed_upload'] = 'Téléverser votre propre modèle';
$string['template_legacy_presentation'] = 'Ancien modèle de diaporama';
$string['template_legacy_spreadsheet'] = 'Ancien modèle de tableur';
$string['template_legacy_wordprocessor'] = 'Ancien modèle de traitement texte';
$string['templates'] = 'Modèles';
$string['templates_dynamic'] = 'Modèles dynamiques';
$string['templates_legacy'] = 'Anciens modèles';
$string['text'] = 'Texte brut';
$string['uicompact'] = 'Vue compacte';
$string['uimode'] = 'Mode d\'interface';
$string['uiserver'] = 'Interface par défaut du serveur';
$string['uitabbed'] = 'Vue en onglets';
$string['unlockedlock'] = 'Document déverrouillé, cliquer ici pour le verrouiller et empêcher sa modification';
$string['unsupportedtype'] = 'Type de fichier non supporté : {$a}';
$string['upload'] = 'Fichier à télécharger';
$string['wordprocessor'] = 'Document traitement de texte';
