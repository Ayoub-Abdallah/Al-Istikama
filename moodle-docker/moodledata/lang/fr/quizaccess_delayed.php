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
 * Strings for component 'quizaccess_delayed', language 'fr', version '5.1'.
 *
 * @package     quizaccess_delayed
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['attemptquiz'] = 'Faire le test';
$string['delayedattemptlock'] = 'Entrée progressive dans le test';
$string['delayedattemptlock_help'] = 'Quand cette option est activée, le bouton pour commencer le test est temporairement désactivé lorsque la page du test est chargée avant la date son début.
Un compte à rebours est lancé (de manière aléatoire et dans une limite de temps définie par votre établissement). À la fin du compte à rebours, le bouton pour démarrer la tentative est réactivé et les étudiants peuvent lancer le test.';
$string['explaindelayedattempt'] = 'Définit un délai d’entrée aléatoire';
$string['flipdowncounter'] = 'Compteur en cartes animées';
$string['noscriptwarning'] = 'Ce test nécessite un navigateur supportant JavaScript. Désactivez votre bloqueur de JavaScript si vous en utilisez un.';
$string['plaintextcounter'] = 'Compteur en texte plein';
$string['pleasewait'] = 'Veuillez attendre ici';
$string['pluginname'] = 'Démarrage de test avec délai aléatoire';
$string['pluginname_desc'] = 'Afficher automatiquement le bouton de démarrage de tentative de test selon un délai aléatoire';
$string['quizaccess_delayed_allowdisable'] = 'Les enseignants peuvent désactiver la règle';
$string['quizaccess_delayed_countertype'] = 'Type de compte-à-rebours à utiliser.';
$string['quizaccess_delayed_dangerousquiznotice'] = 'Message institutionnel affiché en cas de test problématique';
$string['quizaccess_delayed_dangerousquiznotice_desc'] = 'Ce message sera affiché aux enseignants lors de la configuration du test si le plugin détecte des paramètres potentiellement problématiques. C’est un endroit adapté pour pointer vers des tutoriels ou des instructions pour concevoir des tests posant moins de problèmes.';
$string['quizaccess_delayed_enabled'] = 'Tentative retardée activée';
$string['quizaccess_delayed_enabledbydefault'] = 'Les nouveaux tests utiliserons cette règle par défaut';
$string['quizaccess_delayed_maxdelay'] = 'Délai maximal (minutes)';
$string['quizaccess_delayed_maxdelay_desc'] = 'C’est le délai maximal qu’un étudiant peut attendre avant de pouvoir commencer le test. Le délai réel sera un nombre aléatoire compris entre 0 et <b>AU PLUS</b> cette valeur.';
$string['quizaccess_delayed_notice'] = 'Information aux étudiants';
$string['quizaccess_delayed_notice_desc'] = 'Ce texte est affiché à tous les étudiants en parallèle de la description de l’activité définie par l’enseignant. Il est prévu pour fournir un message institutionnel, généralement en lien avec l’utilisation des tests.';
$string['quizaccess_delayed_showdangerousquiznotice'] = 'Montre à l’enseignant un avertissement en cas de test gourmand en ressources';
$string['quizaccess_delayed_sitewidecount'] = 'Utiliser le nombre d’étudiants du site pour le calcul du taux';
$string['quizaccess_delayed_sitewidecount_desc'] = 'Si activé, le taux d’étudiants susceptibles de commencer le test sera calculé en fonction de tous les tests qui débutent simultanément sur le site. Sinon, seuls les étudiants inscrits au cours seront comptabilisés..';
$string['quizaccess_delayed_startrate'] = 'Taux d’entrée (étudiants par minute)';
$string['quizaccess_delayed_startrate_desc'] = 'C’est le nombre moyen d’étudiants par minute que vos serveurs peuvent supporter pour démarrer le test. Un nombre faible entraînera de longs délais, mais réduira la charge sur le serveur. Un nombre élevé entraînera de courts délais, mais risque de surcharger le serveur si de nombreux étudiants tentent de commencer simultanément. Vous devez effectuer des tests de performance sur votre site.';
$string['quizaccess_delayed_teachernotice'] = 'Ce test va utiliser un contrôle d’entrée progressif, lequel va faire entrer les étudiants de manière aléatoire avec un délai maximal de {$a} minutes.';
$string['quizaccess_delayed_teachernotice2'] = 'Message pour l’enseignant : vos étudiants verront le message suivant pendant l’attente :';
$string['quizaccess_delayed_timelimitpercent'] = 'Retard maximal en pourcentage de temps de complétion';
$string['quizaccess_delayed_timelimitpercent_desc'] = 'Si le test a une durée limitée, ce paramètre servira à calculer le délai maximal en pourcentage de cette durée. Le délai maximal réel sera la plus petite valeur entre ce paramètre et celle définie dans « Délai maximal (minutes) ». Cela permet de définir un délai maximal relatif à la durée du test. Par exemple, si vous définissez cette valeur à 10 % et que le test a une durée de 60 minutes, le délai maximal sera de 6 minutes. Si le test n\'a pas de durée limitée, ce paramètre est ignoré.';
$string['quizwillstartinabout'] = 'Votre tentative de test va démarrer dans environ';
$string['quizwillstartinless'] = 'Votre tentative de test va démarrer dans moins d’une minute';
$string['tooshortpagesadvice'] = 'Le test contient {$a->pages} pages qui sont trop courtes. Cela augmente considérablement la charge du serveur. Envisagez d’allouer plus de temps pour chaque page (par exemple en ajoutant plus de questions)';
$string['tooshorttimeguardadvice'] = 'Une durée de disponibilité de {$a->timespanstr} n’est pas suffisante. Veuillez prendre en compte que certains étudiants vont être retardés jusqu’à {$a->maxdelaystr} et auront {$a->timelimitstr} pour passer le test. Il est recommandé de prévoir une marge de sécurité pour d’autres retards en début de test.';
