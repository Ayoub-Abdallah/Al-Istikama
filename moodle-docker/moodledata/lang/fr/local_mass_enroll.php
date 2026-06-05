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
 * Strings for component 'local_mass_enroll', language 'fr', version '5.1'.
 *
 * @package     local_mass_enroll
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['allowedunenrolmentmethods_help'] = 'Indiquer les méthodes d’inscription autorisées par défaut pouvant être utilisées pour la désinscription en masse.<br/>
Veuillez noter que la méthode « manuelle » ne peut pas être configurée, car elle est définie par défaut et sera toujours traitée.<br/>
<i>Faites attention aux méthodes que vous sélectionnez, car cela peut soulever des questions ! Par exemple, vous pourriez <strong>ne pas</strong> vouloir supprimer des inscriptions qui ont été payées (PayPal, Stripe, ClassicPay, etc.).</i>';
$string['checknonmanualenrolments'] = 'Inclure les inscriptions autres que manuelles ?';
$string['checknonmanualenrolments_help'] = 'Lorsque cette option est activée, les attributions de rôles provenant de méthodes d’inscription autres que manuelles seront prises en compte, ce qui signifie que le rôle cible peut être appliqué par n’importe quel plugin d’inscription.
Si l’utilisateur possède déjà le rôle cible via un plugin d’inscription quelconque, le traitement sera ignoré.';
$string['coursepage'] = 'Page de la formation';
$string['csvresulttable'] = 'Résultats CSV';
$string['defaultrole'] = 'Rôle par défaut à attribuer';
$string['defaultrole_help'] = 'Indique le rôle par défaut à attribuer lorsqu’aucun rôle n’est précisé dans le fichier CSV.';
$string['email_sent'] = 'Courriel envoyé à {$a}';
$string['enableextraunenrolmentplugins'] = 'Autoriser des plugins de désinscription supplémentaires ?';
$string['enableextraunenrolmentplugins_help'] = 'Cocher cette option pour autoriser la désinscription à l’aide de plugins autres que « manuel ».';
$string['enablemassenrol'] = 'Autoriser l’inscription en masse à partir du menu des participants de la formation ?';
$string['enablemassenrol_help'] = 'Cocher cette option pour autoriser l’extension d’inscription en masse dans l’arborescence d’administration de la formation.
Veuillez noter que le lien se trouve désormais dans le menu tertiaire de la section « Participants ».';
$string['enablemassunenrol'] = 'Autoriser la désinscription en masse à partir du menu des participants de la formation ?';
$string['enablemassunenrol_help'] = 'Cocher cette option pour autoriser l’extension de désinscription en masse dans l’arborescence d’administration de la formation.
Veuillez noter que le lien se trouve désormais dans le menu tertiaire de la section « Participants ».';
$string['enclosure'] = 'Délimiteur de texte CSV';
$string['error'] = 'Erreur';
$string['event:massenrolcreated'] = 'Inscription en masse créée';
$string['event:massunenrolcreated'] = 'Désinscription en masse créée';
$string['identifier'] = 'Identifiant';
$string['im:nonassignablerole'] = 'Le rôle {$a} ne peut pas être attribué dans ce contexte.';
$string['im:opening_file'] = 'Ouverture du fichier : {$a}';
$string['im:roleassigned'] = 'Le rôle {$a} a été attribué.';
$string['im:roleunassigned'] = 'Le rôle {$a} a été retiré.';
$string['info'] = 'Information';
$string['localmassenrolldefaults'] = 'Paramètres par défaut de l’inscription en masse';
$string['localmassenrollextensions'] = 'Paramètres de l’extension du menu';
$string['mailreportdefault'] = 'Envoi des rapports par défaut';
$string['mailreportdefault_help'] = 'Définit le paramètre par défaut pour l’envoi des rapports liés aux formulaires d’inscription et de désinscription en masse.';
$string['mapping:column'] = 'Colonne {$a}';
$string['mappings'] = 'Correspondances';
$string['massenrollsettings'] = 'Paramètres d’inscription en masse';
$string['massenrolunenrolredirect'] = 'Redirection';
$string['massenrolunenrolredirect_help'] = 'Définit la page vers laquelle rediriger lors de l’annulation du formulaire d’inscription ou de désinscription en masse.';
$string['other'] = 'Autres paramètres';
$string['participantpage'] = 'Page des participants de la formation';
$string['privacy:metadata'] = 'Le plugin local Mass Enrol ne stocke aucune donnée personnelle.';
$string['process:massenrol:success'] = 'Inscription en masse réussie';
$string['process:massunenrol:success'] = 'Désinscription en masse réussie';
$string['role'] = 'ID du rôle';
$string['roleshortname'] = 'Nom abrégé du rôle';
$string['updateroles'] = 'Mettre à jour les rôles ?';
$string['userfullname'] = 'Lorsqu’elle est définie à « Oui », cette option met à jour tous les rôles des utilisateurs.<br/>
Elle peut être utilisée pour modifier les rôles des inscriptions existantes.<br/>
<strong>Veuillez noter que les rôles multiples dans le fichier CSV <i>ne sont pas</i> pris en charge ; cette option retirera donc tous les rôles (de la formation) à l’exception du rôle indiqué dans le fichier CSV ou dans les paramètres (qui sera attribué s’il n’est pas déjà présent).</strong><br/>
Si l’inscription n’existe pas encore, le processus de base d’inscription de l’utilisateur avec le rôle indiqué sera appliqué.';
$string['userid'] = 'ID de l’utilisateur';
