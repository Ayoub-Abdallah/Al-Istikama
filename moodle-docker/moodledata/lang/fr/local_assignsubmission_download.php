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
 * Strings for component 'local_assignsubmission_download', language 'fr', version '5.1'.
 *
 * @package     local_assignsubmission_download
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['all'] = 'Tous';
$string['assignsubmission_download:view'] = 'Autoriser à renommer les fichiers et exporter les devoirs';
$string['choosegradingaction'] = 'Action';
$string['clean_filerenaming'] = 'Nettoyer les noms de fichiers';
$string['clean_filerenaming_help'] = 'Supprime les caractères spéciaux dans le nom des fichiers. Les espaces et les umlauts sont toujours remplacés. Exemple : « Übung 1-Groupe$4 » devient « Uebung_1-Groupe4 »';
$string['data_preview'] = 'Prévisualisation des données';
$string['data_preview_help'] = 'Cliquez sur [+] ou [-] pour afficher ou cacher les colonnes en prévisualisation.';
$string['datapreviewtitle'] = 'Prévisualisation des données';
$string['datasettingstitle'] = 'Réglages des données';
$string['dateinthefutureerror'] = 'La date ne peut pas être positionnée dans le futur';
$string['defaultfilerenamingpattern'] = '[filename]';
$string['defaultziprenamingpattern'] = '[courseshortname]-[assignmentname]-[assignmentid]';
$string['downloadprintpreviewtable'] = 'Télécharger le tableau d’exportation des devoirs.';
$string['downloadtype'] = 'Télécharger';
$string['downloadtype:error'] = 'Veuillez sélectionner au moins une option';
$string['downloadtype:feedbacks'] = 'Tous les feedbacks des enseignants';
$string['downloadtype:submissions'] = 'Tous les devoirs des étudiants';
$string['downloadtype_feedbacks'] = 'Télécharger les feedbacks';
$string['downloadtype_help'] = 'Vous pouvez sélectionner quels fichiers vous souhaitez télécharger - fichiers envoyés par les étudiants et/ou feedbacks des enseignants (commentaires, pdf annotés, fichiers de feedback)';
$string['downloadtype_submissions'] = 'Télécharger les devoirs';
$string['exportformat'] = 'Format';
$string['filenumberinfo'] = 'Le nombre maximum de fichiers à remettre est supérieur à 1. Pensez à utiliser l’étiquette [filenumber] pour numéroter tous les fichiers d’un étudiant afin de faciliter le tri.';
$string['filerenamesettingstitle'] = 'Téléchargement de devoirs renommés';
$string['filerenamingpattern'] = 'Schéma de nommage';
$string['filerenamingpattern_help'] = 'Le paramètre « schéma de nommage » détermine le nommage des fichiers. Les termes entre crochets suivants (« étiquettes ») sont disponibles :<br><br>[idnumber] numéro d’identification<br>[lastname] nom<br>[firstname] prénom<br>[fullname] nom complet<br>[group] groupe, dans le cas où le participant est affecté à un groupe<br>[groupid] identifiant du groupe, dans le cas où le participant est affecté à un groupe et que le groupe possède un identifiant<br>[filename] nom original du fichier<br>[filenumber] numéro séquentiel pour les fichiers déposés par un unique étudiant<br>[assignmentname] nom du dépôt de devoirs<br>[courseshortname] nom abrégé du cours<br>[currentdate] date actuelle au format AAAAMMJJ (AnnéeMoisJour)<br>[currenttime] heure actuelle HHMM (HeuresMinutes)<br><br>Si vous ajoutez des caractres alphanumériques (sans crochet), ces caractères seront ajoutés à tous les noms de fichiers<br><br>Exemple :<br>L’entrée « [idnumber]-[lastname]_[assignmentname] » donnera le nom de fichier suivant : « 01234567-Dupont_TD5 »';
$string['functionnotused'] = 'Fonction non utilisée';
$string['hiddenuser'] = 'Participant';
$string['labelgroup'] = 'Télécharger par groupe';
$string['labelgroup_help'] = 'Télécharger seulement les devoirs d’un groupe d’étudiants spécifique.';
$string['labelgrouping'] = 'Télécharger par groupement';
$string['labelgrouping_help'] = 'Télécharger seulement les devoirs d’un groupement d’étudiants spécifique.';
$string['lastdownloaded_title'] = 'Date de dernier téléchargement des devoirs';
$string['lastdownloaded_title_help'] = 'La date indique le dernier téléchargement des devoirs.';
$string['lastdownloadedfeedbacks_title'] = 'Date de dernier téléchargement des feedbacks';
$string['lastdownloadedfeedbacks_title_help'] = 'La date indique le dernier téléchargement des feedbacks.';
$string['lastfeedbackdownloadsettings'] = 'Réglages du dernier téléchargement des feedbacks';
$string['lastsubmissionsdownloadsettings'] = 'Réglages du dernier téléchargement des devoirs';
$string['nameofziparchive'] = 'Nom de l’archive zip';
$string['nameofziparchive_help'] = 'Nom de l’archive zip qui contient les fichiers téléchargés. Les termes entre crochets suivants (« étiquettes ») sont disponibles :<br><br>[assignmentname] nom du dépôt de devoirs<br>[assignmentid] identifiant du dépôt de devoirs<br>[courseshortname] nom abrégé du cours<br>[currentdate] date actuelle au format AAAAMMJJ (AnnéeMoisJour)<br>[currenttime] heure actuelle HHMM (HeuresMinutes)<br><br>Si vous ajoutez des caractres alphanumériques (sans crochet), ces caractères seront ajoutés au nom de l’archive zip<br><br>Exemple :<br>L’entrée « [courseshortname]-[assignmentname]_[currentdate] » donnera le nom d’archive zip suivant : « EC-TD5_20240401 »';
$string['nodownloadsyet'] = 'aucun téléchargement pour l’instant';
$string['nosubmissionneweras'] = 'Aucun devoir n’a été déposé après le {$a}';
$string['notreuploadable_hint'] = 'Note : si un des types de feedbacks « Fichiers de feedback » ou « Formulaire d’évaluation hors ligne » est coché, les fichiers téléchargés renommés de cette page ne peuvent plus être téléchargés.';
$string['onlinetext_defaultfilename'] = 'Texte en ligne';
$string['onlypdf'] = 'Réglages pdf';
$string['optimum'] = 'Optimum';
$string['pdf_assignment'] = 'Devoir';
$string['pdf_availablefrom'] = 'Disponible jusqu’au';
$string['pdf_course'] = 'Cours';
$string['pdf_duedate'] = 'Date limite';
$string['pdf_group'] = 'Groupe';
$string['pdf_nogroup'] = 'Aucun groupe';
$string['pdf_notactive'] = 'non activé';
$string['pdf_view'] = 'Aperçu avant impression';
$string['perpage'] = 'Devoirs affichés par page';
$string['perpage_help'] = 'Règle le nombre de devoirs qui sont affichés par page dans le fichier pdf. Choisir « Optimum » pour optimiser la répartition en fonction de la taille de police choisie et de l’orientation de la page, si votre cours compte un grand nombre de participants inscrits.';
$string['perpage_propertydefault'] = '100';
$string['perpage_propertydescription'] = 'Règle le nombre de devoirs qui sont affichés par page, lorsque les enseignants consultent les devoirs remis.<br>Cette option est remplacée par les préférences individuelles de l’enseignant. La valeur saisie sera évaluée de manière absolue.';
$string['perpage_propertyname'] = 'Nombre de devoirs affichés par défaut';
$string['pluginname'] = 'Exportation et renommage de devoirs';
$string['pluginname_print'] = 'Exportation';
$string['pluginname_submissions'] = 'Téléchargement de devoirs renommés';
$string['prevent_nameextension'] = 'Empêcher l’ajout d’un suffixe automatique aux noms de fichiers';
$string['prevent_nameextension_help'] = 'Cette fonction empêche l’ajout d’un suffixe automatique aux noms de fichiers (avec des termes comme « _assignsubmission_file »).';
$string['printpreview'] = 'Exportation';
$string['printpreviewtabledownloaded'] = 'Tableau d’exportation téléchargé';
$string['printpreviewtabledownloaded_description'] = 'L’utilisateur avec l’identifiant {$a->userid} a téléchargé le tableau d’exportation des devoirs ayant l’identifiant de module de cours {$a->contextinstanceid}.';
$string['printpreviewtableviewed'] = 'Tableau d’exportation affiché';
$string['printpreviewtableviewed_description'] = 'L’utilisateur avec l’identifiant {$a->userid} a affiché le tableau d’exportation des devoirs ayant l’identifiant de module de cours {$a->contextinstanceid}.';
$string['printsettingstitle'] = 'Réglages d’exportation';
$string['privacy:metadata:local_assignsubm_download'] = 'Table stockant les informations relatives au dernier téléchargement des devoirs.';
$string['privacy:metadata:local_assignsubm_download:choosegroup'] = 'L’dentifiant du groupe à filtrer.';
$string['privacy:metadata:local_assignsubm_download:choosegrouping'] = 'L’identifiant du groupement à filtrer.';
$string['privacy:metadata:local_assignsubm_download:cleanfilenames'] = 'Si les noms de fichiers sont nettoyés des caractères spéciaux.';
$string['privacy:metadata:local_assignsubm_download:cmid'] = 'L’identifiant du module de cours du devoir.';
$string['privacy:metadata:local_assignsubm_download:filenamingscheme'] = 'Le schéma de nommage des fichiers utilisé pour les fichiers à télécharger.';
$string['privacy:metadata:local_assignsubm_download:id'] = 'L’identifiant unique de l’enregistrement.';
$string['privacy:metadata:local_assignsubm_download:lastdownloaded'] = 'La date du dernier téléchargement des devoirs.';
$string['privacy:metadata:local_assignsubm_download:preventnameextension'] = 'Si l’extension automatique des noms de fichiers est désactivée.';
$string['privacy:metadata:local_assignsubm_download:userid'] = 'L’identifiant de l’utilisateur qui a téléchargé les devoirs.';
$string['privacy:metadata:local_assignsubm_download:zipnamingscheme'] = 'Le schéma de nommage utilisé pour l’archive zip.';
$string['privacy:metadata:local_assignsubm_feedback'] = 'Table stockant les informations relatives au dernier téléchargement des feedbacks.';
$string['privacy:metadata:local_assignsubm_feedback:choosegroup'] = 'L’identifiant du groupe à filtrer.';
$string['privacy:metadata:local_assignsubm_feedback:choosegrouping'] = 'L’identifiant du groupement à filtrer.';
$string['privacy:metadata:local_assignsubm_feedback:cleanfilenames'] = 'Si les noms de fichiers sont nettoyés des caractères spéciaux.';
$string['privacy:metadata:local_assignsubm_feedback:cmid'] = 'L’identifiant du module de cours du devoir.';
$string['privacy:metadata:local_assignsubm_feedback:filenamingscheme'] = 'Le schéma de nommage des fichiers utilisé pour les fichiers à télécharger.';
$string['privacy:metadata:local_assignsubm_feedback:id'] = 'L’identifiant unique de l’enregistrement.';
$string['privacy:metadata:local_assignsubm_feedback:lastdownloaded'] = 'La date du dernier téléchargement des feedbacks';
$string['privacy:metadata:local_assignsubm_feedback:preventnameextension'] = 'Si l’extension automatique des noms de fichiers est désactivée.';
$string['privacy:metadata:local_assignsubm_feedback:userid'] = 'L’identifiant de l’utilisateur qui a téléchargé les feedbacks';
$string['privacy:metadata:local_assignsubm_feedback:zipnamingscheme'] = 'Le schéma de nommage utilisé pour l’archive zip.';
$string['privacy:metadata:preference:clean_filerenaming'] = 'Préférence concernant le nettoyage supplémentaire des noms de fichiers contenant des caractères spéciaux dans les devoirs téléchargées.';
$string['privacy:metadata:preference:downloadtype_feedbacks'] = 'Préférence concernant le téléchargement des feedbacks.';
$string['privacy:metadata:preference:downloadtype_submissions'] = 'Préférence concernant le téléchargement des devoirs.';
$string['privacy:metadata:preference:exportformat'] = 'Préférence concernant le format à utiliser lors de l’exportation de fichiers.';
$string['privacy:metadata:preference:filerenamingpattern'] = 'Préférence concernant le schéma de nommage utilisé pour renommer les devoirs';
$string['privacy:metadata:preference:nameofziparchive'] = 'Préférence concernant le nom de l’archive zip lors du téléchargement des devoirs ou des feedbacks.';
$string['privacy:metadata:preference:optimum'] = 'Préférence concernant le choix automatique du nombre de devoirs à afficher par page lors de l’exportation en fichier pdf.';
$string['privacy:metadata:preference:pageorientation'] = 'Préférence concernant l’orientation de la page à utiliser lors de l’exportation en fichier pdf.';
$string['privacy:metadata:preference:perpage'] = 'Préférence concernant le nombre de devoirs à afficher par page lors de l’exportation en fichier pdf.';
$string['privacy:metadata:preference:prevent_nameextension'] = 'Préférence concernant l’empêchement de l’ajout d’un suffixe automatique aux noms de fichiers lors du téléchargement des devoirs ou des feedbacks.';
$string['privacy:metadata:preference:printheader'] = 'Préférence concernant l’impression des entêtes et pieds de page lors de l’exportation en fichier pdf.';
$string['privacy:metadata:preference:textsize'] = 'Préférence concernant la taille du texte à utiliser lors de l’exportation en fichier pdf.';
$string['privacy:metadata:preference:userfilter'] = 'Préférence concernant les utilisateurs à filtrer lors de l’exportation en fichier pdf.';
$string['rename_propertydescription'] = 'Étiquettes disponibles : {$a}';
$string['show'] = 'Afficher';
$string['show_propertydescription'] = 'Utilisé pour afficher ou cacher le menu « {$a->entrytoshow} »';
$string['show_propertyname'] = 'Afficher « {$a->entrytoshow} »';
$string['strallononepage'] = 'imprimer tout sur une page';
$string['strfilerenaming'] = 'Télécharger les devoirs';
$string['strlandscape'] = 'paysage';
$string['strlarge'] = 'grand';
$string['strmedium'] = 'moyen';
$string['stror'] = 'ou';
$string['strpageorientation'] = 'Orientation de la page';
$string['strpapersizes'] = 'Format de la page';
$string['strportrait'] = 'portrait';
$string['strprint'] = 'Télécharger';
$string['strprintheader'] = 'Imprimer les entêtes/pieds de page';
$string['strprintheader_help'] = 'Si cochée, imprime les entêtes et les pieds de page';
$string['strprintheaderlong'] = 'si cochée, imprime les entêtes et les pieds de page';
$string['strrefreshdata'] = 'Mettre à jour l’aperçu des données';
$string['strsmall'] = 'petit';
$string['strtextsize'] = 'Taille du texte';
$string['submissionneweras'] = 'Devoirs déposés après le';
$string['submissionneweras_help'] = 'Télécharge uniquement les devoirs qui ont été modifiés après la date donnée.';
$string['submissions'] = 'Devoirs';
$string['userfilter'] = 'Filtre utilisateur';
$string['viewprintpreviewtable'] = 'Afficher le tableau d’exportation des devoirs.';
