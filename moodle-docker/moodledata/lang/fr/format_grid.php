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
 * Strings for component 'format_grid', language 'fr', version '5.1'.
 *
 * @package     format_grid
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addsections'] = 'Ajouter une section';
$string['asconfigintlower'] = '{$a->valeur} est inférieur à la limite inférieure de {$a->inférieur}';
$string['asconfigintnan'] = '{$a->valeur} n\'est pas un nombre';
$string['asconfigintupper'] = '{$a->valeur} est supérieur à la limite supérieure de {$a->supérieur}';
$string['cannotconvertuploadedimagetodisplayedimage'] = 'Impossible de convertir l’image téléchargée en image affichée - {$a}.';
$string['cannotgetmanagesectionimagelock'] = 'Impossible d’obtenir le verrouillage de l’image de la section de gestion. Cela peut arriver si deux personnes modifient les paramètres de la même section sur le même parcours en même temps.';
$string['centre'] = 'Centre';
$string['courseindex'] = 'Index des cours';
$string['courseindex_help'] = 'Afficher « l\'index des cours »';
$string['crop'] = 'Rognage';
$string['currentsection'] = 'Cette section';
$string['default'] = 'Défaut - {$a}';
$string['defaultcompletionlowpercentagevalue'] = 'Pourcentage d\'achèvement faible';
$string['defaultcompletionlowpercentagevalue_desc'] = 'Pour qu\'un pourcentage d\'achèvement soit « faible », il doit être inférieur à cette valeur.';
$string['defaultcompletionmediumpercentagevalue'] = 'Valeur du pourcentage du support d\'achèvement';
$string['defaultcompletionmediumpercentagevalue_desc'] = 'Pour qu\'un pourcentage d\'achèvement soit « moyen », il doit être inférieur à cette valeur.';
$string['defaultdisplayedimagefiletype'] = 'Type d’image affichée';
$string['defaultdisplayedimagefiletype_desc'] = '« Original » ou « WebP ».';
$string['defaultgridjustification'] = 'Justification par défaut de la grille';
$string['defaultgridjustification_desc'] = 'L’un des éléments suivants : Début, Centre, Fin, Espace autour, Espace entre ou Espace uniformément.';
$string['defaultimagecontainerratio'] = 'Ratio par défaut du conteneur de l’image relatif à la largeur';
$string['defaultimagecontainerratio_desc'] = 'Parmi : 3-2, 3-1, 3-3, 2-3, 1-3, 4-3 ou 3-4.';
$string['defaultimagecontainerwidth'] = 'Largeur par défaut du conteneur de l’image';
$string['defaultimagecontainerwidth_desc'] = 'Parmi : 128, 192, 210, 256, 320, 384, 448, 512, 576, 640, 704 ou 768.';
$string['defaultimageresizemethod'] = 'Méthode par défaut de redimensionnement de l’image';
$string['defaultimageresizemethod_desc'] = 'Définir sur : « Échelle » ou « Recadrer » lors du redimensionnement de l’image pour l’adapter au conteneur.';
$string['defaultpopup'] = 'Utiliser une fenêtre flottante';
$string['defaultpopup_desc'] = 'Affiche par défaut la section dans une fenêtre flottante au lieu de naviguer sur une seule page de section.';
$string['defaultsectionbadgeingridbox'] = 'Badge de section dans la grille';
$string['defaultsectionbadgeingridbox_desc'] = 'Afficher le badge de la section dans la grille.';
$string['defaultsectiontitleingridbox'] = 'Titre de la section dans la grille';
$string['defaultsectiontitleingridbox_desc'] = 'Afficher le titre de la section dans la grille.';
$string['defaultsectionzeroingrid'] = 'Section zéro dans la grille';
$string['defaultsectionzeroingrid_desc'] = 'Placer la section zéro dans la grille';
$string['defaultshowcompletion'] = 'Afficher l’achèvement';
$string['defaultshowcompletion_desc'] = 'Affiche le pourcentage d\'achèvement des sections.';
$string['defaultsinglepagesummaryimage'] = 'Afficher l’image de la grille dans le résumé de la section';
$string['defaultsinglepagesummaryimage_desc'] = 'Afficher l’image de la grille pour cette section dans le résumé de la section lorsqu’il y a un résumé dans la section.';
$string['deletesection'] = 'Supprimer la section';
$string['editsection'] = 'Modifier la section';
$string['editsectionname'] = 'Modifier le nom de section';
$string['end'] = 'Fin';
$string['formatnotsupported'] = 'Le format n’est pas pris en charge sur ce serveur ; veuillez installer sur ce serveur l’extension PHP GD - {$a}';
$string['functionfailed'] = 'La fonction a échoué sur l’image - {$a}';
$string['gridjustification'] = 'Définir la justification de la grille';
$string['gridjustification_help'] = 'Définir la justification sur l’une des valeurs suivantes : Début, Centre, Fin, Espace autour, Espace entre ou Espace uniforme.';
$string['hidefromothers'] = 'Masquer la section';
$string['imagecontainerratio'] = 'Définir le rapport du conteneur d’image par rapport à la largeur';
$string['imagecontainerratio_help'] = 'Définir le rapport du conteneur d’image sur l’une des valeurs : 3-2, 3-1, 3-3, 2-3, 1-3, 4-3 ou 3-4.';
$string['imagecontainerwidth'] = 'Définir la largeur du conteneur d’image';
$string['imagecontainerwidth_help'] = 'Définir la largeur du conteneur d’image sur l’une des valeurs : 128, 192, 210, 256, 320, 384, 448, 512, 576, 640, 704 ou 768';
$string['imagecopyresampledfailed'] = 'La copie d\'image ré-échantillonnée a échoué sur l\'image - {$a}';
$string['imagemanagement'] = 'Gestion des image : {$a}.';
$string['imageresizemethod'] = 'Définir la méthode de redimensionnement de l’image';
$string['imageresizemethod_help'] = 'Définir la méthode de redimensionnement de l’image sur : « Scale » ou « Crop » lors du redimensionnement de l’image pour l’adapter au conteneur.';
$string['indentation'] = 'Autoriser l\'indentation sur la page du cours';
$string['indentation_help'] = 'Permettre aux enseignants et aux autres utilisateurs ayant la possibilité de gérer des activités d\'indenter des éléments sur la page du cours.';
$string['information'] = 'Information';
$string['informationchanges'] = 'Modifications';
$string['informationsettings'] = 'Paramètres d’informations';
$string['informationsettingsdesc'] = 'Informations sur le format de la grille';
$string['left'] = 'Gauche';
$string['love'] = 'amour';
$string['markedthissection'] = 'Cette section en surbrillance est la section courante';
$string['markthissection'] = 'Mettre en surbrillance cette section comme la section courante.';
$string['mimetypenotsupported'] = 'Le type MIME n’est pas accepté comme format d’image dans le format Vue en images - {$a}';
$string['newsection'] = 'Nouvelle section';
$string['newsectionname'] = 'Nouveau nom pour la section {$a}';
$string['noimageinformation'] = 'Les informations sur l’image sont vides - {$a}';
$string['off'] = 'Désactivé';
$string['original'] = 'Original';
$string['originalheightempty'] = 'La hauteur d’origine est vide - {$a}';
$string['originalwidthempty'] = 'La largeur d’origine est vide - {$a}';
$string['page-course-view-grid'] = 'Toutes les pages principales de cours au format vue en image.';
$string['page-course-view-grid-x'] = 'Toutes les pages de cours au format vue en image.';
$string['plugin_description'] = 'Le cours est divisé en sections sélectionnables via une grille.';
$string['pluginname'] = 'Vue en image';
$string['popup'] = 'Utiliser une fenêtre flottante';
$string['popup_help'] = 'Afficher la section dans une fenêtre flottante au lieu de naviguer sur une seule page de section.';
$string['privacy:nop'] = 'Le format Vue en image stocke de nombreux paramètres relatifs à sa configuration. Aucun de ces paramètres n’est lié à un utilisateur spécifique. Il est de votre responsabilité de vous assurer qu’aucune donnée utilisateur n’est entrée dans les champs de texte libre. Si vous définissez un paramètre, cette action sera consignée dans les journaux de Moodle par rapport à l’utilisateur qui l’a modifiée. Cela ne relève pas du contrôle des formats. Veuillez consulter le système de journaux principal pour en savoir plus sur la confidentialité. Lorsque vous déposez des images, évitez de les déposer avec des données de localisation intégrées (GPS EXIF) incluses ou toute autre donnée personnelle. Il serait possible d’extraire n’importe quelle localisation / donnée personnelle des images. Veuillez examiner attentivement le code pour vous assurer qu’il est conforme à votre interprétation des lois sur la confidentialité. Je ne suis pas avocat et mon analyse repose sur mon interprétation. Si vous avez un doute, supprimez le format.';
$string['reporterror'] = 'Veuillez utiliser les informations d\'erreur pour comprendre la raison pour laquelle l\'image téléchargée ne peut pas être utilisée.';
$string['right'] = 'Droite';
$string['scale'] = 'Mise à l’échelle';
$string['section0name'] = 'Général';
$string['sectionbadgeingridbox'] = 'Badge de section dans la grille';
$string['sectionbadgeingridbox_help'] = 'Afficher le badge de la section dans la grille';
$string['sectionbreak'] = 'Saut de section';
$string['sectionbreak_help'] = 'Saut dans la grille à cette section.';
$string['sectionbreakheading'] = 'En-tête de saut de section';
$string['sectionbreakheading_help'] = 'Afficher cet en-tête à l’endroit où le saut de section se trouve dans la grille. HTML peut être utilisé.';
$string['sectionimage'] = 'Image de la section';
$string['sectionimage_help'] = 'L’image de la section.';
$string['sectionimagealttext'] = 'Texte alternatif de l’image';
$string['sectionimagealttext_help'] = 'Ce texte sera défini comme l’attribut alternatif de l’image.';
$string['sectionname'] = 'Section';
$string['sectiontitleingridbox'] = 'Titre de la section dans la grille';
$string['sectiontitleingridbox_help'] = 'Afficher le titre de la section dans la grille';
$string['sectionzeroingrid'] = 'Section zéro dans la grille';
$string['sectionzeroingrid_help'] = 'Placer la section zéro dans la grille';
$string['settings'] = 'Paramètres';
$string['settingssettings'] = 'Paramètres des paramètres';
$string['settingssettingsdesc'] = 'Paramètres du format vue en images';
$string['showcompletion'] = 'Afficher l’achèvement';
$string['showcompletion_help'] = 'Afficher le pourcentage d\'achèvement des sections';
$string['showfromothers'] = 'Afficher';
$string['showsectioncompletion'] = 'Afficher l\'achèvement de la section';
$string['showsectioncompletion_help'] = 'Cela vous permet d\'indiquer si une section donnée présente le pourcentage d\'achèvement requis.';
$string['singlepagesummaryimage'] = 'Afficher l’image de la grille dans le résumé de la section';
$string['singlepagesummaryimage_help'] = 'Afficher l’image de la grille pour cette section dans le résumé de la section lorsqu’il existe dans la section.';
$string['spacearound'] = 'Espace autour';
$string['spacebetween'] = 'Espace entre';
$string['spaceevenly'] = 'Espace uniforme';
$string['start'] = 'Début';
$string['stealthwarning'] = 'Attention : ce cours compte {$a} section(s) orpheline(s) avec du contenu. Veuillez résoudre ce problème rapidement. Note : l’importation d’un contenu en provenance d’un autre cours transformera les sections orphelines en véritables sections. Aucune autre solution n’existe en ce moment.';
$string['topic'] = 'Section';
$string['topic0'] = 'Général';
$string['versionalpha'] = 'Version Alpha - Contient presque certainement des bogues. Il s’agit d’une version de développement pour les développeurs « uniquement » ! Ne pensez même pas à installer sur un serveur de production !';
$string['versionbeta'] = 'Version bêta - susceptible de contenir des bogues. Prêt à être testé par les administrateurs sur un serveur de test uniquement.';
$string['versioninfo'] = 'Release {$a->release}, version {$a->version} sur Moodle {$a->moodle}';
$string['versionrc'] = 'Version Release Candidate - Peut contenir des bogues. Vérifiez complètement sur un serveur de test avant d’envisager sur un serveur de production.';
$string['versionstable'] = 'Version stable - Peut contenir des bogues. Vérifiez sur un serveur de test avant d’installer sur votre serveur de production.';
$string['webp'] = 'WebP';
