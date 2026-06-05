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
 * Strings for component 'factor_webauthn', language 'fr', version '5.1'.
 *
 * @package     factor_webauthn
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['action:manage'] = 'Gérer la clef de sécurité';
$string['action:revoke'] = 'Supprimer la clef de sécurité';
$string['authenticator:ble'] = 'BLE';
$string['authenticator:hybrid'] = 'Hybride';
$string['authenticator:internal'] = 'Interne';
$string['authenticator:nfc'] = 'NFC';
$string['authenticator:usb'] = 'USB';
$string['authenticatorname'] = 'Nom de la clef de sécurité';
$string['error'] = 'Échec d’authentification';
$string['error:alreadyregistered'] = 'Le secret de la clef de sécurité a déjà été enregistré.';
$string['info'] = 'Utiliser une clef de sécurité physique ou un scanner d’empreinte digitale.';
$string['logindesc'] = 'Cliquer continuer pour utiliser votre clef de sécurité.';
$string['loginoption'] = 'Utiliser une clef de sécurité';
$string['loginskip'] = 'Je n’ai pas ma clef de sécurité';
$string['loginsubmit'] = 'Continuer';
$string['logintitle'] = 'Vérifier qu’il s’agit bien de vous au moyen d’une clef de sécurité';
$string['managefactor'] = 'Gérer la clef de sécurité';
$string['managefactorbutton'] = 'Gérer';
$string['manageinfo'] = 'Vous utilisez « {$a} » pour vous authentifier.';
$string['pluginname'] = 'Clef de sécurité';
$string['privacy:metadata'] = 'Le plugin Facteur clef de sécurité n’enregistre aucune donnée personnelle.';
$string['register'] = 'Enregistrer la clef de sécurité';
$string['registererror'] = 'Impossible d’enregistrer la clef de sécurité : {$a}';
$string['registersuccess'] = 'Clef de sécurité enregistrée.';
$string['replacefactor'] = 'Remplacer la clef de sécurité';
$string['replacefactorconfirmation'] = 'Remplacer la clef de sécurité « {$a} » ?';
$string['revokefactorconfirmation'] = 'Supprimer la clef de sécurité « {$a} » ?';
$string['settings:authenticatortypes'] = 'Types d’apps d’authentification';
$string['settings:authenticatortypes_help'] = 'Activer certains types d’apps d’authentification';
$string['settings:description'] = '<Les utilisateurs s’authentifient au moyen d’une clef de sécurité physique, par exemple une clef USB ou NFC ou une méthode biométrique comme une empreinte digitale. Lors de la connexion, ils doivent utiliser physiquement leur clef de sécurité pour vérifier leur identité.</p>
<p>Les utilisateurs devront d’abord configurer leurs propres clefs de sécurité.';
$string['settings:shortdescription'] = 'Imposer aux utilisateurs l’utilisation d’une clef de sécurité, comme une clef USB ou un jeton NFC, ou une méthode biométrique, durant la connexion.';
$string['settings:userverification'] = 'Vérification utilisateur';
$string['settings:userverification_help'] = 'Permet de s’assurer que la personne qui s’authentifie est bien celle qu’elle dit être. La vérification peut prendre plusieurs forme, comme un mot de passe, un NIP, une empreinte digitale, etc.';
$string['setupfactor'] = 'Configurer la clef de sécurité';
$string['setupfactor:instructionsregistersecuritykey'] = '2. Enregistrer la clef de sérurité.';
$string['setupfactor:instructionssecuritykeyname'] = '1. Donner un nom à la clef de sécurité.';
$string['setupfactor:intro'] = 'Une clef de sécurité est un dispositif matériel utilisé pour s’authentifier. Les clefs de sécurité sont par exemple des clefs USB, appareils Bluetooth ou des capteurs d’empreinte digitale sur un téléphone portable ou un ordinateur.';
$string['setupfactor:securitykeyinfo'] = 'Ceci vous aide à identifier la clef de sécurité que vous utilisez.';
$string['setupfactorbutton'] = 'Configurer';
$string['setupfactorbuttonadditional'] = 'Ajouter une clef de sécurité';
$string['summarycondition'] = 'à l’aide d’une app d’authentification prenant en charge WebAuthn';
$string['userverification:discouraged'] = 'La vérification utilisateur ne doit pas être employée, par exemple pour minimiser l’interaction';
$string['userverification:preferred'] = 'La vérification utilisateur est préférée. L’authentification n’échouera pas si la vérification est manquante';
$string['userverification:required'] = 'La vérification utilisateur est requise (par exemple au moyen d’un NIP). L’authentification échouera si la vérification est manquante';
