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
 * Strings for component 'qtype_recordrtc', language 'fr', version '5.1'.
 *
 * @package     qtype_recordrtc
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowpausing'] = 'Autoriser la pause';
$string['allowpausing_help'] = 'Si cette option est activée, un bouton « pause » supplémentaire sera ajouté aux widgets d\'enregistrement.';
$string['audio'] = 'Audio seul';
$string['audiobitrate'] = 'Débit audio';
$string['audiobitrate_desc'] = 'Qualité de l’enregistrement audio en bit/seconde (un nombre plus grand signifie une meilleure qualité)';
$string['audiotimelimit'] = 'Durée maximale de l’enregistrement audio';
$string['audiotimelimit_desc'] = 'Durée maximale que l’auteur de la question peut définir pour la durée d’enregistrement audio.';
$string['avplaceholder'] = 'Emplacement de l’audio/vidéo';
$string['avplaceholder_help'] = 'Placez un ou plusieurs widgets d\'enregistrement n\'importe où dans le texte de la question. Vous pouvez copier les exemples ici.

Chaque espace réservé nécessite, entre doubles crochets, un nom unique (par exemple « recorder1 »), un type (« audio » ou « vidéo » ou « écran ») et une durée facultative, séparés par deux-points. La durée doit être exprimée comme « 30s » ou « 05m45s ». Si aucune durée n\'est définie, le widget prend par défaut la durée d\'enregistrement maximale.

Il est possible d\'appliquer un formatage au widget, par exemple en modifiant son alignement ou en le plaçant dans un tableau.';
$string['canselfcomment'] = 'Les étudiants peuvent s\'auto-commenter';
$string['canselfcomment_help'] = 'Si cette option est activée, les étudiants pourront commenter leur propre tentative de réponse à la question.';
$string['canselfrate'] = 'Les étudiants peuvent s\'auto-évaluer';
$string['canselfrate_help'] = 'Si cette option est activée, les étudiants pourront évaluer leur propre tentative de réponse à la question sur une échelle de cinq étoiles (plutôt que d\'attendre que quelqu\'un d\'autre évalue leur travail, si les notes sont pertinentes).';
$string['customav'] = 'Plusieurs widgets';
$string['downloadrecording'] = 'Télécharger {$a}';
$string['err_audiotimelimit'] = 'La durée maximale de l’enregistrement ne peut pas être supérieure à {$a} secondes (paramètre « Durée maximale d’enregistrement audio »).';
$string['err_closesquarebrackets'] = 'Il manque un ou plusieurs crochets fermant. {$a->format}';
$string['err_compatibility'] = 'Si les appareils iOS/iPadOS peuvent enregistrer des fichiers vidéo dans des formats ouverts, ils ne peuvent actuellement pas les lire. Tant qu\'Apple n\'aura pas résolu ce problème, vous devrez utiliser un autre appareil pour visionner cette vidéo.';
$string['err_opensquarebrackets'] = 'Il manque un ou plusieurs crochets ouvrant. {$a->format}';
$string['err_placeholderformat'] = 'Le format de la chaîne de remplacement est [[title:audio]], où \'title\' est une chaîne de caractères (qui peut contenir des lettres, des traits d’union et des caractères de soulignement).';
$string['err_placeholderincorrectformat'] = 'Le format de la chaîne de remplacement du média n’est pas correct. {$a->format}';
$string['err_placeholdermediatype'] = '"{$a->text}" n’est pas un type de média valide. Pour le type de média, utiliser la chaîne "audio". {$a->format}';
$string['err_placeholdermissingduration'] = 'La durée de {$a} est manquante. N\'incluez les deux derniers points que si une durée est donnée. Les deux points ont été supprimés pour vous.';
$string['err_placeholderneeded'] = 'Vous devez ajouter au moins un emplacement au texte de la question.';
$string['err_placeholdernotallowed'] = 'Vous ne pouvez pas utiliser de caractères génériques avec le type d\'enregistrement {$a}.';
$string['err_placeholdertitle'] = '"{$a->text}" n’est pas un titre valide. Utiliser une chaîne de caractères appropriée. {$a->format}';
$string['err_placeholdertitlecase'] = '"{$a->text}" n’est pas un titre valide. Les titres ne peuvent contenir que des lettres minuscules. {$a->format}';
$string['err_placeholdertitleduplicate'] = '« {$a->text} » a été utilisé plus d\'une fois. Chaque nom doit être différent.';
$string['err_placeholdertitlelength'] = '« {$a->text} « est plus long que {$a->maxlength} caractères.';
$string['err_screentimelimit'] = 'La durée maximale d\'enregistrement de l\'écran vidéo ne peut être supérieure à {$a} secondes.';
$string['err_timelimit'] = 'La durée maximale d’enregistrement ne peut être supérieure à {$a}.';
$string['err_timelimitpositive'] = 'La durée maximale d’enregistrement doit être supérieure à 0.';
$string['err_videotimelimit'] = 'La durée maximale de l’enregistrement ne peut pas être supérieure à {$a} secondes (paramètre « Durée maximale d’enregistrement vidéo »).';
$string['err_zeroornegativetimelimit'] = '« {$a} » n’est pas valide. La durée maximale de l’enregistrement doit être supérieure à 0.';
$string['feedbackfor'] = 'Commentaires pour « {$a} »';
$string['filex'] = 'Fichier {$a}';
$string['gumabort'] = 'Il s’est passé quelque chose d’étrange qui a empêché l’utilisation de la webcam et/ou du microphone.';
$string['gumabort_title'] = 'Il s’est passé quelque chose…';
$string['gumnotallowed'] = 'L’utilisateur doit autoriser le navigateur à accéder à la webcam/microphone';
$string['gumnotallowed_title'] = 'Autorisations erronées';
$string['gumnotfound'] = 'Il n’y a pas de dispositif d’entrée connecté ou activé';
$string['gumnotfound_title'] = 'Périphérique manquant';
$string['gumnotreadable'] = 'Quelque chose empêche le navigateur d’accéder à la webcam et/ou au microphone';
$string['gumnotreadable_title'] = 'Erreur matérielle';
$string['gumnotsupported'] = 'Votre navigateur ne prend pas en charge l’enregistrement sur une connexion non sécurisée et doit fermer le greffon';
$string['gumnotsupported_title'] = 'Pas de prise en charge des connexions non sécurisées';
$string['gumoverconstrained'] = 'La webcam et le microphone ne peuvent pas produire un flux d’enregistrement avec les paramètres actuels';
$string['gumoverconstrained_title'] = 'Problème avec les paramètres';
$string['gumsecurity'] = 'Votre navigateur ne prend pas en charge l’enregistrement sur une connexion non sécurisée et doit fermer le greffon';
$string['gumsecurity_title'] = 'Pas de prise en charge des connexions non sécurisées';
$string['gumtype'] = 'Impossible d’obtenir le flux de la webcam/microphone, car aucun paramètre n’a été spécifié';
$string['gumtype_title'] = 'Aucun paramètre spécifié';
$string['insecurewarning'] = 'Votre navigateur ne permettra pas à ce greffon de fonctionner s’il n’est pas utilisé avec une connexion sécurisée (HTTPS).';
$string['insecurewarningtitle'] = 'Connexion non sécurisée';
$string['mediatype'] = 'Type d’enregistrement';
$string['mediatype_help'] = 'L’étudiant est-il invité à enregistrer de l’audio ou de la vidéo ?';
$string['nearingmaxsize'] = 'Vous avez atteint la limite de taille maximale pour le dépôt de fichiers';
$string['nearingmaxsize_title'] = 'Enregistrement stoppé';
$string['norecording'] = 'Pas d’enregistrement';
$string['nowebrtc'] = 'Votre navigateur ne prend pas en charge les technologies WebRTC, ou alors de manière limitée, et ne peut pas être utilisé pour ce type de questions. Veuillez changer de navigateur ou le mettre à jour.';
$string['nowebrtctitle'] = 'WebRTC n’est pas supporté';
$string['optionsforaudio'] = 'Options audio';
$string['optionsforaudioandvideo'] = 'Options audio et vidéo';
$string['optionsforscreen'] = 'Options d\'enregistrement d\'écran';
$string['optionsforvideo'] = 'Options vidéo';
$string['pause'] = 'Pause';
$string['pleaserecordsomethingineachpart'] = 'Veuillez compléter votre réponse';
$string['pluginname'] = 'Enregistrement audio/vidéo';
$string['pluginname_help'] = 'Les étudiants répondent aux questions en enregistrant leur voix directement dans le navigateur web, et peuvent ensuite être notés manuellement.';
$string['pluginname_link'] = 'question/type/recordrtc';
$string['pluginnameadding'] = 'Ajouter une question audio/vidéo';
$string['pluginnameediting'] = 'Éditer une question audio/vidéo';
$string['pluginnamesummary'] = 'Les étudiants répondent aux questions en enregistrant leur voix directement dans le navigateur web, et peuvent ensuite être notés manuellement.';
$string['privacy:metadata'] = 'Le plugin type de question audio n’enregistre aucune donnée personnelle.';
$string['privacy:preference:allowpausing'] = 'Le bouton « Pause » est désactivé/activé pour une question donnée.';
$string['privacy:preference:canselfcomment'] = 'La fonctionnalité d\'auto-commentaire est désactivée/activée pour une question donnée.';
$string['privacy:preference:canselfrate'] = 'La fonctionnalité « auto-évaluation » est désactivée/activée pour une question donnée.';
$string['privacy:preference:defaultmark'] = 'La note par défaut pour une question donnée.';
$string['privacy:preference:timelimitinseconds'] = 'La « durée maximale de l’enregistrement » définie pour une question donnée.';
$string['recordagain'] = 'Ré-enregistrer';
$string['recordagainx'] = 'Ré-enregistrer {$a}';
$string['recordingfailed'] = 'L’enregistrement a échoué';
$string['recordrtc:downloadrecordings'] = 'Télécharger les enregistrements';
$string['resume'] = 'Reprendre';
$string['screen'] = 'Enregistrement d\'un seul écran';
$string['screenbitrate_desc'] = 'Qualité de l\'enregistrement de l\'écran (un chiffre plus élevé signifie une meilleure qualité)';
$string['screensize'] = 'Résolution de la sortie vidéo';
$string['screensize_desc'] = 'La taille de la résolution de sortie vidéo.';
$string['screentimelimit'] = 'Durée maximale d\'enregistrement de l\'écran';
$string['screentimelimit_desc'] = 'Durée maximale que l\'auteur de la question peut fixer pour la durée de l\'enregistrement de l\'écran.';
$string['selfassessmentheading'] = 'Paramètres pour l\'auto-évaluation';
$string['startcamera'] = 'Démarrer la caméra';
$string['startcamerax'] = 'Démarrer la caméra {$a}';
$string['startrecording'] = 'Démarrer l’enregistrement';
$string['startrecordingx'] = 'Démarrer l’enregistrement {$a}';
$string['startsharescreen'] = 'Démarrer l\'enregistrement de l\'écran';
$string['startsharescreenx'] = 'Démarrer l\'enregistrement de l\'écran {$a}';
$string['stoprecording'] = 'Arrêter l’enregistrement';
$string['timelimit'] = 'Durée d’enregistrement maximum';
$string['timelimit_help'] = 'Durée maximale d’un enregistrement que l’étudiant est autorisé à faire. S’il atteint cette durée, l’enregistrement s’arrête automatiquement. La limite peut être supérieure à cette valeur, vous devez demander à un administrateur de l’augmenter.';
$string['updateform'] = 'Mise à jour du formulaire';
$string['updateformdone'] = 'Le formulaire a été mis à jour. Vous pouvez ajouter des commentaires par entrée ci-dessous.';
$string['uploadaborted'] = 'Sauvegarde annulée';
$string['uploadcomplete'] = 'Enregistrement déposé';
$string['uploadfailed'] = 'Échec du dépôt';
$string['uploadfailed404'] = 'La sauvegarde de l’enregistrement a échoué : le fichier est probablement trop volumineux';
$string['uploadpreparing'] = 'Préparation de la sauvegarde…';
$string['uploadpreparingpercent'] = 'Préparation du téléchargement ({$a} %)';
$string['uploadprogress'] = 'Sauvegarde de l’enregistrement ({$a})…';
$string['video'] = 'Vidéo seule';
$string['videobitrate'] = 'Débit vidéo';
$string['videobitrate_desc'] = 'Qualité de l’enregistrement vidéo en bit/seconde (un nombre plus grand signifie une meilleure qualité)';
$string['videosize'] = 'Taille de la vidéo';
$string['videosize_desc'] = 'La taille de la vidéo';
$string['videotimelimit'] = 'Durée maximale de l’enregistrement vidéo.';
$string['videotimelimit_desc'] = 'Durée maximale que l’auteur de question peut définir pour la durée de l’enregistrement vidéo.';
$string['xminutes'] = '{$a} minutes';
$string['xseconds'] = '{$a} secondes';
