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
 * Strings for component 'quizaccess_quiztimer', language 'fr', version '5.1'.
 *
 * @package     quizaccess_quiztimer
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['canteditquiztimes'] = 'Vous ne pouvez pas modifier les temps des questions car ce test a déjà été tenté. ({$a})';
$string['canteditquiztype'] = 'Vous ne pouvez pas modifier le type de temps du test car des tentatives ont déjà eu lieu.';
$string['configsavedpage'] = 'Configuration enregistrée avec succès. <br> <b>Pensez à modifier les temps des pages.</b>';
$string['configsavedquestion'] = 'Configuration enregistrée avec succès. <br> <b>Pensez à modifier les temps des questions.</b>';
$string['configsavedsection'] = 'Configuration enregistrée avec succès. <br> <b>Pensez à modifier les temps des sections.</b>';
$string['disabledbycustomtimer'] = 'Verrouillé en raison du minuteur personnalisé sélectionné dans la section « Temps ».';
$string['distributesectiontime'] = 'Répartir le temps de la section sur les pages';
$string['eventsectiontimerupdated'] = 'Minuteur de section mis à jour';
$string['eventsectiontimerupdateddescription'] = 'L’utilisateur ayant l’identifiant {$a->userid} a mis à jour le minuteur de la section {$a->section} avec une nouvelle valeur de {$a->timevalue} {$a->timeunit}';
$string['eventslottimerupdated'] = 'Minuteur de question mis à jour';
$string['eventslottimerupdateddescription'] = 'L’utilisateur ayant l’identifiant {$a->userid} a mis à jour le minuteur de la question {$a->slot} avec une nouvelle valeur de {$a->timevalue} {$a->timeunit}';
$string['hours'] = 'heures';
$string['invalidsettedtime'] = 'Temps saisi invalide ; la valeur précédente a été rétablie';
$string['minutes'] = 'minutes';
$string['pagetime'] = 'Temps pour la page';
$string['pagingchangesnotapply'] = 'Ce test utilise un minuteur personnalisé (par questions ou par sections). Les modifications apportées à la pagination des questions ne seront pas appliquées et seront écrasées';
$string['pluginname'] = 'Règles d’accès du Minuteur de test';
$string['privacy:metadata:attempt'] = 'Le numéro de tentative associé aux données de temps.';
$string['privacy:metadata:quiz'] = 'Le test auquel appartient cette configuration du minuteur.';
$string['privacy:metadata:quiz_mode'] = 'Le mode du minuteur utilisé dans le test.';
$string['privacy:metadata:quizaccess_quiztimer'] = 'Données de configuration du minuteur de test.';
$string['privacy:metadata:quizaccess_usertimedsections'] = 'Données de temps utilisateur par section.';
$string['privacy:metadata:quizaccess_usertimedslots'] = 'Données de temps utilisateur par question.';
$string['privacy:metadata:quizid'] = 'Le test associé aux données de minuteur utilisateur.';
$string['privacy:metadata:section'] = 'La section du test à laquelle se rapportent les données de temps.';
$string['privacy:metadata:slot'] = 'L’emplacement (position de la question) auquel se rapportent les données de temps.';
$string['privacy:metadata:timecreated'] = 'La date et l’heure de la création des paramètres du minuteur.';
$string['privacy:metadata:timefinish'] = 'La date et l’heure de fin enregistrée pour cette question ou cette section.';
$string['privacy:metadata:timemodified'] = 'La date et l’heure de dernière modification des paramètres du minuteur.';
$string['privacy:metadata:timestart'] = 'La date et l’heure de début enregistré pour cette question ou cette section.';
$string['privacy:metadata:userid'] = 'L’identifiant de l’utilisateur dont les données de temps sont enregistrées.';
$string['privacy:metadata:usermodified'] = 'L’identifiant de l’utilisateur ayant modifié les paramètres de minuteur.';
$string['questiontime'] = 'Temps pour la question';
$string['quizquiztimer'] = 'Minuteur de test';
$string['quiztime'] = 'Ajuster les temps des questions';
$string['quiztimer'] = 'Zone de messages des temps du quiz :';
$string['quiztimer:manage'] = 'Gérer les paramètres de temps du minuteur de test';
$string['quiztimererrors'] = 'Des minuteurs de test nécessitent une attention particulière pour permettre l’exécution du test :';
$string['repaginatewarning'] = 'Choisir le type de modification « Question » ou « Section » peut modifier la pagination des questions comme suit :
− Temps par section : toutes les questions sur une page pour chaque section.
− Temps par question : une question par page.
Souhaitez-vous tout de même poursuivre l’opération ?';
$string['requirequiztimermessage'] = 'Ce test utilise une limite de temps personnalisée pour les questions et les sections.';
$string['seconds'] = 'secondes';
$string['sectiontime'] = 'Temps pour la section';
$string['selecttypetimes'] = 'Sélectionnez un type de temps pour utiliser des temps personnalisés dans le test';
$string['setting:timedsections'] = 'Temps par défaut des sections';
$string['setting:timedsections_desc'] = 'Temps par défaut attribué aux sections créées';
$string['setting:timedslots'] = 'Temps par défaut des questions';
$string['setting:timedslots_desc'] = 'Temps par défaut attribué aux questions créées';
$string['submit'] = 'Enregistrer';
$string['subtimes'] = 'Limite de temps à utiliser';
$string['subtimes_help'] = 'La liste déroulante propose trois options pour configurer le minuteur de test (Section, Question, Total)';
$string['timelimit'] = 'Limite de temps';
$string['timelimitedit'] = 'Limite de temps (sans utilisation de temps personnalisés)';
$string['totalsectiontime'] = 'Temps total de la section :';
$string['totaltime'] = 'Temps total';
$string['unitsections'] = 'Unité utilisée pour les sections';
$string['unitslots'] = 'Unité utilisée pour les questions';
$string['warningtime'] = 'Temps défini invalide';
