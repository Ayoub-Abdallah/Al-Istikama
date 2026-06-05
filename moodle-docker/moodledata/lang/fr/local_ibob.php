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
 * Strings for component 'local_ibob', language 'fr', version '5.1'.
 *
 * @package     local_ibob
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['addvalidationcodelink'] = 'Code de confirmation reçu ? Le saisir ici';
$string['emailconfirmationcode'] = 'Code';
$string['emailconfirmationdescription'] = 'Ajouter votre code de validation ici';
$string['emailconfirmationexpirationdatereached'] = 'La date d’expiration est dépassée…';
$string['emailconfirmationinvalidcode'] = 'Code non valide !';
$string['emailconfirmationlinknewcode'] = 'Cliquer ici pour générer un nouveau code';
$string['emailconfirmationreturn'] = 'Retour';
$string['emaildescription'] = 'Saisir dans le champs texte ci-dessous l’adresse de courriel utilisée par votre compte Open Badge Passport. La laisser vide pour supprimer vos open badges de Moodle.';
$string['emaildescriptiontitle'] = 'Configurer votre connexion à votre compte Open Badge Passport.';
$string['emails_notifications:click'] = 'Cliquez ici';
$string['emails_notifications:fullmess1'] = 'Bonjour\\n\\n';
$string['emails_notifications:fullmess2'] = 'Le cours « {a} » a été modifié et vous n’avez plus les open badges nécessaires pour y être inscrit.\\n\\n';
$string['emails_notifications:fullmess3'] = 'Aucune action de votre part n’est requise, vous êtes automatiquement désinscrit de ce cours.\\n\\n';
$string['emails_notifications:fullmess4'] = 'Merci d’utiliser {$a} et bon apprentissage !';
$string['emails_notifications:fullmesshtml1'] = '<p>Bonjour</p>';
$string['emails_notifications:fullmesshtml2'] = '<p>Le cours « {a} » a été modifié et vous n’avez plus les open badges nécessaires pour y être inscrit.</p>';
$string['emails_notifications:fullmesshtml3'] = '<p>Aucune action de votre part n’est requise, vous êtes automatiquement désinscrit de ce cours.</p>';
$string['emails_notifications:fullmesshtml4'] = '<p>Merci d’utiliser {$a} et bon apprentissage !</p>';
$string['emails_notifications:subject'] = 'Le cours « {$a} » a été modifié';
$string['emailsequenceexplanation'] = 'Vous recevrez un courriel contenant un code de confirmation. Votre compte ne sera pas mis à jour tant que vous ne confirmerez pas votre adresse de courriel.';
$string['emailvalidated'] = 'Adresse de courriel validée';
$string['emailvalidatedno'] = 'Non';
$string['emailvalidatedyes'] = 'Oui';
$string['forceprocessing'] = 'Forçage de l’éxécution des tâches adhoc, pour assurer un délai maximum de 5 minutes pour l’éxécution';
$string['ibobprefs'] = 'Connexion au compte Open Badge Passport (ibob)';
$string['ibobprefslink'] = 'Gérer votre configuration';
$string['invalidcode'] = 'Code non valide !';
$string['invalidemail'] = 'Adresse de courriel non valide.';
$string['messageprovider:defaults'] = 'Demande de changement d’adresse de courriel pour Open badge passport (ibob)';
$string['messageprovider:enrolcreatedupdated'] = 'Un nouveau cours accessible par vos Open Badge est disponible';
$string['messageprovider:ibobemailchange'] = 'Changement de courriel Open Badge Passport effectué';
$string['messconfirmchangeemail'] = 'Bonjour\\n\\nVous avez initié un changement d’adresse de courriel dans la plateforme Moodle {$a->wwwroot}
         pour votre compte Open Badge Passport.\\n\\nSi vous êtes à l’initiative de ce changement, pour qu’il soit effectif,
         vous devez cliquer sur le lien {$a->link} et saisir le code de confirmation suivant :\\n\\nCode de confirmation à saisir : {$a->code}\\n\\n
         Ce code sera valide jusqu’au {$a->date} à {$a->time}\\n\\nMerci d’utiliser {$a->wwwroot} et bon apprentissage !';
$string['messconfirmchangeemailhtml'] = '<h1>Bonjour</h1><p>Vous avez initié un changement d’adresse de courriel dans la plateforme Moodle {$a->wwwroot}
         pour votre compte Open Badge Passport.</p>Si vous êtes à l’initiative de ce changement, pour qu’il soit effectif,
         vous devez cliquer sur le lien {$a->link} et saisir le code de confirmation suivant :<p><strong>Code de confirmation à saisir : {$a->code}</strong></p>
         <p>Ce code sera valide jusqu’au {$a->date} à {$a->time}</p><p>Merci d’utiliser {$a->wwwroot} et bon apprentissage !</p>';
$string['messconfirmchangeemaillinktext'] = 'de validation de votre adresse de courriel';
$string['modalBadgeDetail'] = 'Détail du badge';
$string['multiplenotificationhtml'] = '<p>Vos Open Badges vous permettent de vous inscrire à de nouveaux cours.</p><p>Les cours suivant vous sont maintenant ouverts à l’inscription :<br>{$a}</p>';
$string['multiplenotificationtxt'] = 'Vos Open Badges vous permettent de vous inscrire à de nouveaux cours.\\nLes cours suivant vous sont maintenant ouverts à l’inscription :\\n{$a}\\n';
$string['mustachelibcreationdate'] = 'Date d’émission';
$string['mustachelibemitter'] = 'Émetteur';
$string['mustachelibexpirationdate'] = 'Expire le';
$string['mustachelibobtained'] = 'Obtenu le';
$string['noBadgesFound'] = 'Aucun badge trouvé…';
$string['notifopmailfullmessage'] = '\\nBonjour,\\nVos Open Badges vous permettent de vous inscrire à un nouveau cours !\\n\\n{$a} pour le découvrir.\\n';
$string['notifopmailfullmessagehtml'] = '<p>Bonjour,<br>Vos Open Badges vous permettent de vous inscrire à un nouveau cours !</p><p>{$a} pour le découvrir.</p>';
$string['notifopmailsubject'] = 'Nouveau cours disponible, accessible par vos Open Badges';
$string['pluginname'] = 'Inscription par Open Badges';
$string['profilebadgelist'] = 'Liste des Open Badges publics';
$string['scheduleddeletenotifications'] = 'Tâche planifiée : suppression des anciennes notifications';
$string['scheduledupdateusersbadgesname'] = 'Tâche planifiée : mise à jour des données user - badge';
$string['singlenotificationhtml'] = '<p>Vos Open Badges vous permettent de vous inscrire à ce nouveau cours.<br>Cliquer sur ce cours « {$a} » pour le découvrir.';
$string['subjectconfirmchangeemail'] = 'Confirmation de changement d’adresse de courriel pour votre compte Open Badge Passport dans Moodle';
$string['testbackpackapiurlexception'] = 'Erreur : impossible de se connecter au backpack';
$string['userconfig:error1'] = 'cas 1<br>';
$string['userconfig:error2'] = 'cas 2<br>';
$string['userconfig:errorgeneral'] = 'cas 3<br>';
