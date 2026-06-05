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
 * Strings for component 'customfield_number', language 'fr', version '5.1'.
 *
 * @package     customfield_number
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activitytypes'] = 'Types d’activité';
$string['automaticallypopulated'] = 'Rempli automatiquement';
$string['crontaskname'] = 'Remplissage automatique des champs personnalisés nombre';
$string['decimalplaces'] = 'Décimales';
$string['defaultvalueconfigerror'] = 'La valeur par défaut doit être entre le minimum et le maximum';
$string['display'] = 'Modèle d’affichage';
$string['display_help'] = 'La manière d’afficher la valeur du champ. Utiliser les paramètres suivants :

* **{value}** - affiche la valeur en format numérique (nombre avec décimales selon configuration du champ)
* **{value} €** - prix en dollars
* **{value} h** - durée en heures';
$string['displayvalueconfigerror'] = 'Paramètre non valide';
$string['displaywhenzero'] = 'Afficher si zéro';
$string['displaywhenzero_help'] = 'La manière d’afficher la valeur du champ si elle vaut « 0 ». Par exemple, pour un prix, on peut afficher le mot « Gratuit », et pour une durée, laisser le champ vide pour indiquer que la durée n’a pas été estimée.

Laisser le champ vide pour ne rien afficher du tout quand la valeur du champ est « 0 ».';
$string['fieldtype'] = 'Type de champ';
$string['fieldtype_help'] = 'Sélectionner le type de champ numérique à définir. Certaines options nécessitent une saisie manuelle dans les réglages du cours, tandis que d’autres rempliront automatiquement les valeurs, par exemple le nombre d’activités spécifiées dans un cours.';
$string['genericfield'] = 'Champ générique pour donnée numérique';
$string['headerdisplaysettings'] = 'Format d’affichage';
$string['invalidprovider'] = 'Fournisseur non valide';
$string['manualinput'] = 'Saisie manuelle';
$string['maximumvalue'] = 'Valeur maximale';
$string['maximumvalueerror'] = 'La valeur doit être inférieure ou égale à {$a}';
$string['minimumvalue'] = 'Valeur minimale';
$string['minimumvalueconfigerror'] = 'La valeur doit être inférieure au maximum';
$string['minimumvalueerror'] = 'La valeur doit être supérieure ou égale à {$a}';
$string['missingrequired'] = 'ID d’instance ou de champ manquant';
$string['nofactivities'] = 'Nombre d’activités du cours';
$string['pluginname'] = 'Nombre';
$string['privacy:metadata'] = 'Le plugin champ personnalisé nombre n’enregistre aucune donnée personnelle';
$string['specificsettings'] = 'Réglages du champ nombre';
