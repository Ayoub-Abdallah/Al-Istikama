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
 * Strings for component 'wooflash', language 'fr', version '5.1'.
 *
 * @package     wooflash
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesskeyid'] = 'Identifiant de plateforme (accessKeyId)';
$string['accesskeyid-description'] = 'Clé d’accès utilisée pour communiquer avec la plateforme Wooflash. Elle devrait commencer par « ak. »';
$string['baseurl'] = 'URL du webservice';
$string['baseurl-description'] = 'Sert uniquement au débogage ou au test. Ne modifiez cette valeur que si demandé par le support Wooflash.';
$string['consent-screen:agree'] = 'J’accepte';
$string['consent-screen:description'] = '<b>Wooflash</b> rend les étudiants acteurs de leur apprentissage.';
$string['consent-screen:disagree'] = 'Je refuse';
$string['consent-screen:explanation'] = 'Pour le bon fonctionnement de certaines opérations, Wooflash demande votre adresse de courriel. Cliquez sur « J’accepte » pour partager votre adresse de courriel avec Wooflash, ou « Je refuse » pour continuer sans les fonctionnalités avancées.';
$string['customcompletion'] = 'Suivi d’achèvement mis à jour uniquement par Wooflash';
$string['customcompletiongroup'] = 'Conditions de suivi d’achèvement Wooflash';
$string['error-auth-nosession'] = 'Session manquante lors de la connexion';
$string['error-callback-is-not-url'] = 'L’URL de retour (callback) n’est pas une URL valide';
$string['error-couldnotauth'] = 'Impossible d’obtenir l’utilisateur ou le cours durant l’authentification';
$string['error-couldnotloadevents'] = 'Impossible de charger les cours Wooflash';
$string['error-couldnotperformv3upgradestep1'] = 'L’étape 1 de la mise à niveau V3 n’a pas pu être effectuée. Veuillez vérifier que l’identifiant de clé d’accès, l’URL de base et la clé d’accès secrète sont correctement configurés dans les paramètres du plugin.';
$string['error-couldnotperformv3upgradestep2'] = 'Impossible d’effectuer l’étape 2 de la mise à niveau V3';
$string['error-couldnotredirect'] = 'Impossible d’effectuer la redirection';
$string['error-couldnotupdatereport'] = 'Impossible de mettre à jour le rapport';
$string['error-invalid-callback-url'] = 'L’URL de retour (callback) ne correspond pas au domaine défini dans la configuration.';
$string['error-invalidjoinurl'] = 'L’URL pour rejoindre le cours est invalide';
$string['error-invalidtoken'] = 'Le valeur du paramètre « token » est invalide';
$string['error-missingparameters'] = 'Paramètres manquants';
$string['error-noeventid'] = 'Impossible de déterminer l’identifiant du cours';
$string['error-reportdeprecated'] = 'report_wooflash.php n’est plus supporté. Veuillez plutôt utiliser report_wooflash_v3.php.';
$string['modulename'] = 'Wooflash';
$string['modulename_help'] = 'Cette activité permet d’intégrer la plateforme interactive Wooflash à Moodle';
$string['modulenameplural'] = 'Wooflash';
$string['modulenamepluralformatted'] = 'Liste des activités Wooflash';
$string['nowooflash'] = 'Il n’y a pas d’instance Wooflash';
$string['pingNOTOK'] = 'La connexion n’a pas pu être établie avec Wooflash. Veuillez vérifier vos réglages.';
$string['pingOK'] = 'Connexion établie avec Wooflash';
$string['pluginadministration'] = 'Administration Wooflash';
$string['pluginname'] = 'Wooflash';
$string['privacy:metadata:wooflash_server'] = 'Nous échangeons certaines données utilisateur avec Wooflash pour mieux intégrer leurs services.';
$string['privacy:metadata:wooflash_server:userid'] = 'Votre identifiant Moodle est envoyé pour que vous puissiez accéder à vos données sur Wooflash.';
$string['quiz'] = 'Importer un Test Moodle';
$string['secretaccesskey'] = 'Clé API (secretAccessKey)';
$string['secretaccesskey-description'] = 'Clé secrète utilisée pour communiquer avec la plateforme Wooflash. Elle devrait commencer par « sk. »';
$string['showconsentscreen'] = 'Afficher l’écran de consentement ?';
$string['showconsentscreen-description'] = 'Si cette option est active, Wooflash demandera aux participants leur consentement avant de récupérer leur adresse de courriel.';
$string['testconnection'] = 'Tester la Connexion';
$string['warn-missing-config-during-upgrade-to-v3'] = 'Pour effectuer la migration, l’identifiant de clé d’accès (accesskeyid), l’URL de base (baseurl) et la clé d’accès secrète (secretaccesskey) doivent être configurés dans les paramètres. La migration est ignorée pour le moment : vous pourrez l’exécuter ultérieurement via le script cli/v3_upgrade.php. Remarque : cette migration est indispensable pour utiliser le plugin.';
$string['wooflash:addinstance'] = 'Ajouter une activité Wooflash à un cours';
$string['wooflash:view'] = 'Accéder à une activité Wooflash';
$string['wooflasheventid'] = 'Dupliquer un cours Wooflash';
$string['wooflashintro'] = 'Description de l’activité';
$string['wooflashname'] = 'Nom de l’activité';
$string['wooflashredirect'] = 'Vous allez être redirigé vers Wooflash. Si cela ne se fait pas automatiquement, cliquez sur ce lien afin de continuer.';
$string['wooflashsettings'] = 'Réglages';
