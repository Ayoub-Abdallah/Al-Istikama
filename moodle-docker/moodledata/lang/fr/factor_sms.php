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
 * Strings for component 'factor_sms', language 'fr', version '5.1'.
 *
 * @package     factor_sms
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action:manage'] = 'Gérer le numéro de téléphone mobile';
$string['action:revoke'] = 'Supprimer le numéro de téléphone mobile';
$string['addnumber'] = 'Numéro mobile';
$string['clientnotfound'] = 'Client AWS Service introuvable. Le client doit être nom de classe complet, p.ex. \\Aws\\S3\\S3Client.';
$string['editphonenumber'] = 'Modifier numéro de téléphone';
$string['editphonenumberinfo'] = 'Si vous n’avez pas reçu le code ou si vous avez saisi un numéro erroné, veuillez le modifier et recommencer.';
$string['error:emptyverification'] = 'Code vide. Veuillez réessayer.';
$string['error:wrongphonenumber'] = 'Le format du numéro de téléphone fourni n’est pas valide.';
$string['error:wrongverification'] = 'Code incorrecte. Veuillez réessayer.';
$string['errorawsconection'] = 'Erreur de connexion au serveur AWS {$a}';
$string['errorsmssent'] = 'Erreur lors de l’envoi du SMS contenant votre code de vérification.';
$string['event:smssent'] = 'Message SMS envoyé.';
$string['event:smssentdescription'] = 'Code de vérification envoyé via SMS à l’utilisateur d’ID {$a->userid}.
Information : {$a->debuginfo}';
$string['info'] = 'Envoyer un code de vérification au numéro de mobile choisi.';
$string['logindesc'] = 'Message SMS contenant un code à 6 chiffres envoyé au numéro de mobile {$a}';
$string['loginoption'] = 'Recevoir un code sur le téléphone mobile';
$string['loginskip'] = 'Je n’ai pas reçu de code';
$string['loginsubmit'] = 'Continuer';
$string['logintitle'] = 'Saisir le code de vérification envoyé sur votre mobile';
$string['managefactor'] = 'Gérer SMS';
$string['managefactorbutton'] = 'Gérer';
$string['manageinfo'] = 'Vous utilisez « {$a} » pour vous authentifier.';
$string['notification:smsgatewaymigration'] = 'Les réglages SMS ont été déplacés';
$string['notification:smsgatewaymigrationinfo'] = 'Un nouveau sous-système SMS est maintenant disponible pour la gestion et la configuration de toutes les fonctions liées aux SMS. Vos configurations SMS ont été déplacées vers la page <a href="{$a}">Passerelles SMS</a>.';
$string['phonehelp'] = 'Saisir le numéro de votre mobile (y compris le code du pays) pour recevoir un code de vérification.';
$string['pluginname'] = 'SMS';
$string['privacy:metadata'] = 'Le plugin Facteur SMS n’enregistre aucune donnée personnelle.';
$string['revokefactorconfirmation'] = 'Supprimer le SMS « {$a} » ?';
$string['settings:aws'] = 'AWS SNS';
$string['settings:aws:key'] = 'Clef';
$string['settings:aws:key_help'] = 'Clef de l’accréditation API Amazon.';
$string['settings:aws:region'] = 'Region';
$string['settings:aws:region_help'] = 'Région de la passerelle API Amazon.';
$string['settings:aws:secret'] = 'Secret';
$string['settings:aws:secret_help'] = 'Secret de l’accréditation API Amazon.';
$string['settings:aws:usecredchain'] = 'Trouver l’accréditation AWS au moyen de la chaîne de fournisseurs d’accréditation par défaut';
$string['settings:countrycode'] = 'Le numéro de code du pays';
$string['settings:countrycode_help'] = 'Le préfixe d’appel à utiliser par défaut (sans le + initial) quand un utilisateur saisit son numéro sans indiquer de préfixe international.

Voir ce lien pour une liste des préfixes : {$a}';
$string['settings:duration'] = 'Durée de validité';
$string['settings:duration_help'] = 'La durée de validité du code.';
$string['settings:gateway'] = 'Passerelle SMS';
$string['settings:gateway_help'] = 'Le fournisseur SMS via lequel envoyer les messages';
$string['settings:heading'] = 'Les utilisateurs recevront durant la connexion un code à 6 chiffres via SMS, qu’ils devront saisir afin de terminer le processus de connexion. Ils devront d’abord enregistrer leur numéro de téléphone mobile.';
$string['settings:setupdesc'] = 'Pour utiliser SMS comme facteur d’authentification, vous devez d’abord <a href="{$a}">configurer une passerelle SMS</a>.';
$string['settings:shortdescription'] = 'Imposer aux utilisateurs de saisir un code reçu via SMS durant la connexion.';
$string['settings:smsgateway'] = 'Passerelle SMS';
$string['settings:smsgateway_help'] = 'Choisir une passerelle dans la liste ou <a href="{$a}">créer une nouvelle passerelle</a>.';
$string['setupfactor'] = 'Configurer SMS';
$string['setupfactorbutton'] = 'Configurer';
$string['setupsubmitcode'] = 'Enregistrer';
$string['setupsubmitphone'] = 'Envoyer code';
$string['smsstring'] = '{$a->code} est votre code de sécurité unique {$a->fullname}.

@{$a->url} #{$a->code}';
$string['summarycondition'] = 'Utilisation d’un code de sécurité unique SMS';
