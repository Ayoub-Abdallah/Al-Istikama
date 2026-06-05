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
 * Strings for component 'wooclap', language 'fr', version '5.1'.
 *
 * @package     wooclap
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['accesskeyid'] = 'Identifiant de plate-forme (accessKeyId)';
$string['accesskeyid-description'] = 'Clef d’accès utilisée pour communiquer avec Wooclap. Elle devrait commencer par « ak ».';
$string['baseurl'] = 'URL de base';
$string['baseurl-description'] = 'Ceci est uniquement pour le débogage ou le test. Ne modifiez cette valeur qu’à la demande de l’équipe de support de Wooclap.';
$string['consent-screen:agree'] = 'J’accepte';
$string['consent-screen:description'] = '<b>Wooclap</b> fait jouer aux étudiants un rôle actif dans leur expérience d’apprentissage.';
$string['consent-screen:disagree'] = 'Je n’accepte pas';
$string['consent-screen:explanation'] = 'Pour que certaines options fonctionnent, comme l’envoi d’un rapport personnalisé à la fin d’une session, Wooclap vous demande votre adresse de courriel. Elle ne sera jamais utilisée à des fins de marketing. Cliquez sur « J’accepte » pour donner votre adresse de courriel à Wooclap, ou sur « Je n’accepte pas » pour continuer sans les fonctions avancées.';
$string['customcompletion'] = 'État d’achèvement mis à jour uniquement par Wooclap';
$string['customcompletion_help'] = 'Si elle est activée, l’est considérée comme terminée lorsqu’un étudiant a interagi avec au moins une question Wooclap.';
$string['customcompletiongroup'] = 'Achèvement personnalisé Wooclap';
$string['error-auth-nosession'] = 'Session manquante dans l’authentification';
$string['error-callback-is-not-url'] = 'Le paramètre de callback n’est pas une URL valide';
$string['error-couldnotauth'] = 'Impossible d’obtenir l’utilisateur ou le cours pendant l’authentification';
$string['error-couldnotloadevents'] = 'Impossible de charger les événements Wooclap de l’utilisateur';
$string['error-couldnotperformv3upgradestep1'] = 'Impossible de réaliser l’étape 1 de la mise à jour vers la V3. Veuillez vérifier que accesskeyid, baseurl et secretaccesskey sont bien configurés dans les réglages du plugin.';
$string['error-couldnotperformv3upgradestep2'] = 'Impossible de réaliser l’étape 2 de la mise à jour vers la V3';
$string['error-couldnotredirect'] = 'Impossible de rediriger';
$string['error-couldnotupdatereport'] = 'Impossible de mettre à jour le rapport';
$string['error-during-quiz-import'] = 'Le test ne peut pas être converti en questions Wooclap car il ne contient que des questions non compatibles avec Wooclap.';
$string['error-invalid-callback-url'] = 'L’URL de rappel fournie ne correspond pas au nom de domaine de l’URL de base défini dans les paramètres.';
$string['error-invalidjoinurl'] = 'URL pour rejoindre non valide';
$string['error-invalidtoken'] = 'Jeton non valide';
$string['error-missingparameters'] = 'Paramètres manquants';
$string['error-noeventid'] = 'Impossible de déterminer l’identifiant de l’événement';
$string['error-reportdeprecated'] = 'report_wooclap.php est déprécié. Utilisez report_wooclap_v3.php à la place.';
$string['importquiz'] = 'Importer un Test Moodle';
$string['importquiz_help'] = 'Tous les types de questions des tests Moodle ne sont pas pris en charge sur Wooclap. Cliquez [ici](https://docs.google.com/spreadsheets/d/1qNfegWe99EBQD2Sv2HEDD2i2cC1OVM-x1H9E2ZWliA4/edit?gid=0#gid=0) pour en savoir plus sur la compatibilité des questions entre les deux plateformes.';
$string['modulename'] = 'Wooclap';
$string['modulename_help'] = 'Ce module fournit une intégration de la plateforme interactive Wooclap à Moodle';
$string['modulenameplural'] = 'Wooclap';
$string['modulenamepluralformatted'] = 'Liste des activités Wooclap';
$string['nowooclap'] = 'Il n’y a pas d’instance Wooclap';
$string['pingNOTOK'] = 'La connexion n’a pas pu être établie avec Wooclap. Veuillez vérifier vos paramètres.';
$string['pingOK'] = 'Connexion établie avec Wooclap';
$string['pluginadministration'] = 'Administration de Wooclap';
$string['pluginname'] = 'Wooclap';
$string['privacy:metadata:wooclap_server'] = 'Pour pouvoir s’intégrer à Wooclap, des données utilisateur doivent être échangées.';
$string['privacy:metadata:wooclap_server:userid'] = 'L’identifiant de l’utilisateur est envoyé par Moodle pour vous permettre d’accéder à vos données sur Wooclap.';
$string['secretaccesskey'] = 'Clef API (secretAccessKey)';
$string['secretaccesskey-description'] = 'Clef d’accès secrète utilisée pour communiquer avec Wooclap. Devrait commencer par « sk ».';
$string['showconsentscreen'] = 'Afficher l’écran de consentement ?';
$string['showconsentscreen-description'] = 'Si ce réglage est activé, Wooclap demandera aux participants leur consentement avant de recueillir leur adresse de courriel.';
$string['testconnection'] = 'Test de connexion';
$string['warn-missing-config-during-upgrade-to-v3'] = 'Afin d’exécuter la migration, l’Identifiant de la plate-forme (accesskeyid), l’URL de base et la clé API (secretaccesskey) doivent être configurés dans les paramètres. Ignorer la migration pour l’instant : vous pourrez l’exécuter plus tard via le script cli/v3_upgrade.php. Remarque : si vous souhaitez utiliser le plugin, cette migration est obligatoire.';
$string['wooclap:addinstance'] = 'Ajouter une activité Wooclap à un cours';
$string['wooclap:view'] = 'Accéder à une activité Wooclap';
$string['wooclapeventid'] = 'Dupliquer un événement Wooclap';
$string['wooclapintro'] = 'Description';
$string['wooclapname'] = 'Nom';
$string['wooclapsettings'] = 'Paramètres';
