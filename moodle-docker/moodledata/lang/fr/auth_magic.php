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
 * Strings for component 'auth_magic', language 'fr', version '5.1'.
 *
 * @package     auth_magic
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['and'] = 'Et';
$string['anymethod'] = 'N\'importe quel méthode';
$string['belowpassword'] = 'Mot de passe ci-dessous';
$string['belowusername'] = 'Nom d’utilisateur ci-dessous';
$string['configtitle'] = 'L’authentification Magic';
$string['copyboard'] = 'Copier le lien dans le presse-papiers';
$string['copyinvitationlink'] = 'Copier le lien d’enregistrement Magic pour l’utilisateur';
$string['copyloginlink'] = 'Copier le lien de connexion Magic pour l’utilisateur';
$string['courseenrolment'] = 'L’inscription au cours';
$string['createuserenrolcourse'] = 'a été créé et a été inscrit au cours « {$a} »';
$string['currentlylinkexpiry'] = 'Le lien de connexion étant expiré, un nouveau lien sera envoyé à votre adresse de courriel lorsque vous cliquez sur le lien expiré.';
$string['defaultenrolmentduration'] = 'La durée d’inscription par défaut';
$string['defaultenrolmentrole'] = 'Le rôle de l’utilisateur par défaut';
$string['doesnotaccesskey'] = 'Ne détiens pas l’accès à la clef de connexion dans votre méthode d’authentification';
$string['emailnotexists'] = 'Adresse de courriel de l’utilisateur inconnu';
$string['enrolmentduration'] = 'Durée de l’inscription';
$string['error'] = 'L’heure d’expiration du lien de connexion Magic n\'a pas été actualisé.';
$string['existuserenrolcourse'] = 'a été inscrit(e) au cours "{$a}"';
$string['expiredloginlinkmsg'] = 'Bonjour {$a->fullname},

Vous avez tenté d’accéder à « {$a->sitename} » avec un lien d\'enregistrement expiré.

Un nouveau lien Magic vous a été créé automatiquement :

<a href="{$a->link}"> {$a->link} </a> <br>

Ce lien ne sera plus actif à partir du : <b> {$a->expiry} </b> <br>

Si vous avez besoin d\'assistance, contacter l’administrateur du site,
{$a->admin}';
$string['expiredregistrationmessage'] = 'Bonjour {$a->fullname},

vous avez tenté d’accéder à « {$a->sitename} » avec un lien d\'enregistrement expiré.

Un nouveau lien Magic vous a été créé automatiquement :

<a href="{$a->link}"> {$a->link} </a> <br>

Si vous avez besoin d\'assistance, contacter l’administrateur du site,
{$a->admin}';
$string['firstname'] = 'Prénom';
$string['getmagiclinkviagmail'] = 'Recevoir un lien Magic via l’adresse de courriel';
$string['hasbeencreated'] = 'a été créé';
$string['instructionsforlinktype'] = 'Spécifier un format de lien Magic, les deux formats possibles sont (l’enregistrement ou la connexion).';
$string['invailduser'] = 'Utilisateur non valide';
$string['invitationexpiry'] = 'Expiration du lien d’enregistrement Magic';
$string['invitationexpiryloginlink'] = 'Le lien d’enregistrement n\'est plus valide. Vous ne pouvez plus l’utiliser pour accéder au site.';
$string['invitationexpiryloginlinkwithupdate'] = 'Le lien d’enregistrement n’est plus valide. Si l’adresse de courriel fournie est attribuée à un compte permettant la connexion via un lien, un lien lui sera envoyé.';
$string['invitationmessage'] = 'Bonjour {$a->fullname},

Un nouveau compte a été créé via le site « {$a->sitename} » avec votre adresse de courriel.

Pour vous connecter à votre nouveau compte, utiliser le lien suivant, au lieu de votre nom d’utilisateur et mot de passe :

<a href="{$a->link}"> {$a->link} </a> <br>

Ce lien ne sera plus actif à partir du : <b> {$a->expiry} </b> <br>

Si vous avez besoin d\'assistance, contacter l’administrateur du site,
{$a->admin}';
$string['keyusemultiple'] = 'Jusqu’à sa fin de validité';
$string['keyuseonce'] = 'Une seule fois';
$string['lastname'] = 'Nom de famille';
$string['linkexpirytime'] = 'Définir la date de fin de validité du lien de connexion Magic';
$string['listofmagiclink'] = 'Comptes utilisateurs Magic';
$string['loginexpiry'] = 'Expiration du lien de connexion Magic';
$string['loginexpiryloginlink'] = 'Le lien de connexion Magic est n\'est plus valable. Vous ne pouvez plus l’utiliser pour accéder au site.';
$string['loginexpiryloginlinkwithupdate'] = 'Le lien de connexion Magic est n\'est plus valable. Un nouveau lien a été envoyé à votre adresse de courriel.';
$string['loginkeytype'] = 'Paramétrer le lien de la clef de connexion';
$string['loginkeytype_desc'] = 'Ce paramètre permet aux administrateurs du site de paramétrer le comportement des clefs de connexion. Ils ne pourront être utilisés qu’une seule fois où jusqu’à la date d’expiration.';
$string['loginlinkbtnpostion'] = 'Emplacement du bouton de connexion Magic';
$string['loginlinkmessage'] = 'Bonjour {$a->fullname},

Pour accéder à votre compte sur le site « {$a->sitename} », utiliser le lien Magic suivant :

<a href="{$a->link}"> {$a->link} </a> <br>

Ce lien ne sera plus actif à partir du : <b> {$a->expiry} </b> <br>

Si vous avez besoin d\'assistance, contacter l’administrateur du site,
{$a->admin}.';
$string['loginlinksubject'] = 'Authentification Magic via un lien de connexion';
$string['loginoption'] = 'Permettre le nom d’utilisateur de recevoir un lien Magic';
$string['loginoptiondesc'] = 'Activer ce paramètre pour permettre la connexion avec le nom d’utilisateur indiqué dans le formulaire de connexion.';
$string['loginsubject'] = '{$a} : Authentification Magic via la connexion';
$string['magiclink'] = 'Lien Magic';
$string['magicloginlink'] = '{$a} : Lien de connexion Magic';
$string['magiconly'] = 'Magic uniquement';
$string['manualinfo'] = 'L’auto-inscription est indisponible dans ce cours.';
$string['messageprovider:auth_magic'] = 'Liens de connexion de l’authentification Magic';
$string['more'] = '{$a} plus';
$string['normal'] = 'Normal';
$string['notexists_loginlinkmsg'] = 'Bonjour {$a->fullname},

Vous n\'avez pas un lien de connexion Magic, donc vous ne pouvez pas accéder au site avec l’authentification Magic.

Si vous avez besoin d’assistance, contacter l’administrateur du site,
{$a->admin}.';
$string['notsentinvitationlink'] = 'Ne communique pas le lien par adresse de courriel';
$string['passinfo'] = '- ou saisir votre mot de passe -';
$string['pluginisdisabled'] = 'Le plugin d’authentification Magic est désactivé.';
$string['pluginname'] = 'Authentification Magic';
$string['preventmagicauthmessage'] = 'Bonjour {$a->fullname},

Un nouveau compte a été demandé via le site « {$a->sitename} » avec votre adresse de courriel.

<strong> Avertissement : </strong> L’authentification via un lien Magic est impossible avec votre compte. Privilégier la connexion avec votre mot de passe.

<br>

{$a->forgothtml} <br>

Si vous avez besoin d’assistance, contacter l’administrateur du site,
{$a->admin}';
$string['preventmagicauthsubject'] = 'Information technique de l’authentification Magic';
$string['privacy:metadata:auth_magic'] = 'L’authentification Magic';
$string['privacy:metadata:auth_magic:invitationexpiry'] = 'La date de fin de validité de la clef d’inscription';
$string['privacy:metadata:auth_magic:invitationuserkey'] = 'La valeur de la clef d’inscription utilisateur';
$string['privacy:metadata:auth_magic:loginexpiry'] = 'La date de fin de validité de la clef de connexion';
$string['privacy:metadata:auth_magic:loginuserkey'] = 'La valeur de la clef de connexion utilisateur';
$string['privacy:metadata:auth_magic:magicauth'] = 'La valeur indiquant si le parent peut l’attribuer ou pas.';
$string['privacy:metadata:auth_magic:magicinvitation'] = 'La valeur du lien d’enregistrement utilisateur';
$string['privacy:metadata:auth_magic:magiclogin'] = 'La valeur du lien de connexion utilisateur';
$string['privacy:metadata:auth_magic:manualexpiry'] = 'La date de fin de validité de la clef de connexion utilisateur';
$string['privacy:metadata:auth_magic:parent'] = 'La valeur du userid à attribuer au parent de l’utilisateur.';
$string['privacy:metadata:auth_magic:parentrole'] = 'L’instance de l’id du rôle de parent';
$string['privacy:metadata:auth_magic:timecreated'] = 'La date et heure de création du lien de connexion.';
$string['privacy:metadata:auth_magic:timemodified'] = 'La date et heure à laquelle le lien de connexion a été modfié.';
$string['privacy:metadata:auth_magic:userid'] = 'L’ID de l’utilisateur avec ce lien de connexion';
$string['privacy:metadata:auth_magic_loginlinks'] = 'Les liens Magic de l’utilisateur.';
$string['quickregistration'] = 'Inscription rapide';
$string['registrationexpirylink'] = 'Le lien d\'inscription est expiré. Un nouveau lien a été envoyé à votre adresse de courriel.';
$string['registrationmessage'] = 'Bonjour {$a->emailplaceholder},

Nous vous remercions pour votre intérêt de rejoindre {$a->sitename} ! Pour créer votre compte, cliquer sur le lien d’enregistrement suivant :

<a href={$a->link}> {$a->link} </a> <br>

En cas de questions ou de besoins d\'assistance, contacter l’administrateur du site, {$a->admin}.

Nous attendons avec impatience de vous accueillir parmi notre communauté !

Bien cordialement,
L\'équipe {$a->sitename}';
$string['registrationsubject'] = 'Lien d’enregistrement de l’authentificateur Magic';
$string['sendlink'] = 'Envoyer un lien Magic à l’utilisateur';
$string['sentinvitationlink'] = 'Envoyer un lien d’enregistrement à l’adresse de courriel';
$string['sentlinktouser'] = 'Si vous avez saisi une adresse de courriel valide, vous recevrez un courriel avec un lien de connexion Magic.';
$string['sentlinktousername'] = 'Si vous avez saisi un nom d’utilisateur valide, vous recevrez un courriel avec un lien de connexion Magic.';
$string['sentregisterlinktouser'] = 'Si vous avez saisi une adresse de courriel valide, vous recevrez un courriel avec un lien d’enregistrement.';
$string['statuscreateuser'] = 'a été créé';
$string['strconfirm'] = 'Confirmation';
$string['strenrolinto'] = 'inscrit à';
$string['strkeyaccount'] = 'Compte à clef d’inscription';
$string['strowneraccountrole'] = 'Rôle du propriétaire du compte';
$string['strsupportauth'] = 'Méthode d’authentification permis';
$string['strsupportpassword'] = 'Permet le mot de passe';
$string['success'] = 'Modifications enregistrées';
$string['userhavenotlinks'] = 'L’utilisateur n\'a aucun lien {$a}';
$string['userkeyslist'] = 'Mes comptes utilisateur';
