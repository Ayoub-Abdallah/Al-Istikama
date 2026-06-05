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
 * Strings for component 'auth_enrolkey', language 'fr', version '5.1'.
 *
 * @package     auth_enrolkey
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cohortsync'] = 'Synchroniser les audiences lors de l\'inscription';
$string['cohortsync_description'] = 'Synchroniser les audiences système lorsqu\'un utilisateur s\'inscrit. Cela supprime le délai introduit par l\'exécution de cette tâche par cron. Attention : cela peut ralentir le processus d\'inscription.';
$string['description'] = 'Ce plugin permet l’auto-enregistrement par clef d’inscription';
$string['edit_cohort'] = 'Modifier le devoir';
$string['edit_profile'] = 'Modifier les champs';
$string['edit_redirect'] = 'Modifier l\'URL';
$string['enrolkeyuse'] = 'Utiliser la nouvelle clef d\'inscription';
$string['errorenrolling'] = 'Une erreur s\'est produite lors de l\'inscription au cours « {$a->course} ». Le message d\'erreur est : {$a->err}';
$string['heading_unsuspend'] = 'Il se peut que votre compte soit suspendu, veuillez saisir une clef d\'inscription.';
$string['label_cohortselect'] = 'Sélectionner des cohortes';
$string['label_cohortselect_empty'] = 'Aucune cohorte sélectionnée.';
$string['label_cohortselect_help'] = 'Rechercher les noms et les identifiants des cohortes dans ce champ.';
$string['label_redirection'] = 'URL de redirection';
$string['label_redirection_help'] = 'L\'URL saisie ici redirigera l\'utilisateur à la fin de son auto-inscription.<br/>
Ce champ acceptera des URL absolues et relatives.<br/>
Veuillez vous rappeler d\'inclure la barre oblique initiale (/) lors de l\'utilisation d\'une URL relative.
<ul>
<li>Relative : /course/view.php?id=5</li>
<li>Absolue : http://perhaps.your.intranet/some/page</li>
</ul>';
$string['noemail'] = 'Échec de l’envoi du courriel !';
$string['pluginname'] = 'Auto-enregistrement par clef d’inscription';
$string['privacy:metadata'] = 'Le plugin d’auto-enregistrement par clef d’inscription ne conserve aucune donnée personnelle.';
$string['recaptcha'] = 'Ajoute une confirmation visuelle ou audio aux éléments du formulaire de la page d’enregistrement pour les utilisateurs s’enregistrant eux-mêmes. Ceci protége votre site contre les spammeurs et contribue en même temps à une cause valable. Voir <a href="https://www.google.com/recaptcha">https://www.google.com/recaptcha</a> pour plus de détails.';
$string['recaptcha_key'] = 'Activer reCAPTCHA';
$string['settings_content'] = '<p>L’auto-enregistrement par clef d’inscription permet aux utilisateurs de créer leur propre compte en cliquant sur un bouton « Créer un compte » sur la page de connexion. L’utilisateur reçoit par courriel un message de confirmation contenant un lien sécurisé vers une page où il peut confirmer son compte. Les connexions suivantes ne vérifient que les nom d’utilisateur et mot de passe précédemment enregistrés dans la base de données de Moodle.<p></p>Lors de l’auto-enregistrement, si une clef d’inscription est renseignée dans le champ « Clef d’inscription », le nouvel utilisateur est automatiquement inscrit à tous les cours auxquels cette clef correspond. Les clefs sont activées dans « Administration du cours > Participants > Méthodes d’inscription > Ajouter une méthode > Auto-inscription ».</p><p>Remarque : en plus d’activer ce plugin, il faut également sélectionner l’option « Auto-enregistrement par clef d’inscription » dans le menu déroulant spécifiant l’auto-enregistrement sur la page « Gestion de l’authentification.»</p>';
$string['settings_email_description'] = 'Exiger que les utilisateurs confirment leur compte avec un courriel avant d’accéder les cours auxquels ils sont inscrits.';
$string['settings_email_title'] = 'Exiger la confirmation par courriel.';
$string['settings_heading'] = 'Paramètres généraux';
$string['settings_required_description'] = 'Le champ « Clef d’inscription » sera requis pour valider.';
$string['settings_required_title'] = 'Exiger une clef d’inscription.';
$string['settings_visible_description'] = 'Ajoute une nouvel élément de formulaire à la page de connexion pour les utilisateurs s’enregistrant eux-mêmes. Son existence sera vérifié parmi les clefs d’inscriptions disponibles et l’utilisateur sera inscrit dans les cours correspondants';
$string['settings_visible_title'] = 'Activer l’élément « Clef d’inscription »';
$string['signup_auth_instructions'] = 'Salut ! Pour obtenir l’accès complet aux cours, prenez une minute pour vous créer un nouveau compte sur ce site. Chacun des cours peut également disposer d’une « clef d’inscription » unique que vous pouvez utiliser ici :
<ol>
<li>Remplissez le formulaire « <a href="{$a}">Nouveau compte</a> » avec vos informations personnelles.</li>
<li>Il vous sera demandé une « clef d’inscription » ‒ utilisez celle qui vous a été fournie par votre enseignant. Vous serez inscrit dans le cours.</li>
<li>Votre compte sera créé et vous serez connecté.</li>
<li>Vous pouvez à présent accéder à l’intégralité du cours pour cette session.</li>
<li>De plus, un courriel a immédiatement été envoyé à votre adresse.</li>
<li>Lisez ce message et cliquez sur le lien qui s’y trouve.</li>
<li>A partir de maintenant, il vous sera uniquement demandé votre nom d’utilisateur et votre mot de passe (dans le formulaire sur cette page) pour vous connecter et accéder à tout cours dans lequel vous êtes inscrit.</li>
</ol>';
$string['signup_failure'] = 'Oups ! Il y a eu un problème et il est possible que vous n’ayez pas été inscrit correctement. Retourner à <a href="{$a->href}">l’accueil</a>';
$string['signup_field_title'] = 'Clef d’inscription';
$string['signup_missing'] = 'Clef d’inscription manquante';
$string['signup_token_invalid'] = 'La clef d’inscription que vous avez entrée n’est pas valide';
$string['signup_view'] = 'Inscription aux cours';
$string['signup_view_message_basic'] = 'Vous avez été inscrit en tant que {$a->role} dans le cours « <a href="{$a->href}">{$a->course}</a> »';
$string['signup_view_message_basic_dates'] = 'Vous avez été inscrit dans « {$a->course} » en tant que {$a->role}. <a href={$a->href}>Cliquez ici pour voir le cours.</a><br />Début du cours : {$a->startdate}<br />Fin du cours : {$a->enddate}';
$string['signup_view_message_basic_dates_endonly'] = 'Vous avez été inscrit dans « {$a->course} » en tant que {$a->role}. <a href={$a->href}>Cliquez ici pour voir le cours.</a><br />Fin du cours : {$a->enddate}';
$string['signup_view_message_basic_dates_startonly'] = 'Vous avez été inscrit dans « {$a->course} » en tant que {$a->role}. <a href={$a->href}>Cliquez ici pour voir le cours.</a><br />Début du cours : {$a->startdate}';
