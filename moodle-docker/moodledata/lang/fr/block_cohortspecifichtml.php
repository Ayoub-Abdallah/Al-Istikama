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
 * Strings for component 'block_cohortspecifichtml', language 'fr', version '5.1'.
 *
 * @package     block_cohortspecifichtml
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['cohortselection'] = 'Afficher pour ces cohortes';
$string['cohortselection_help'] = 'Le bloc ne sera affiché qu\'aux membres d\'au moins une des cohortes sélectionnées. Si, par exemple, un utilisateur est membre de deux cohortes et qu\'une seule de ces cohortes est sélectionnée, il verra le bloc (puisqu\'il est membre d\'une des deux cohortes). Ceci équivaut à une relation logique OU.';
$string['cohortspecifichtml:addinstance'] = 'Ajouter un nouveau bloc Texte pour cohortes spécifiques';
$string['cohortspecifichtml:myaddinstance'] = 'Ajouter un nouveau bloc Texte pour cohortes spécifiques au Tableau de bord';
$string['cohortspecifichtml:viewalways'] = 'Toujours voir le bloc';
$string['invertcohortselection'] = 'Faire le contraire (<strong>cacher</strong> le bloc aux cohortes sélectionnées)';
$string['invertcohortselection_help'] = 'Ce paramètre permet de faire l\'inverse, soit cacher plutôt qu\'afficher le bloc pour les cohortes sélectionnées. Le bloc devient donc affiché par défaut, sauf pour les membres des cohortes sélectionnées.<br/>
Exemples: <ul> <li>Si un utilisateur fait partie d\'une cohorte sélectionnée, il ne verra pas le bloc, même s\'il est membre d\'une cohorte qui n\'est pas sélectionnée. </li>
<li>If you have selected none of the cohorts and invert that, the block will be visible for <strong>all</strong> users.</li></ul>';
$string['newhtmlcohortblock'] = 'Nouveau Texte pour cohortes spécifiques';
$string['nocohorts'] = 'Il n\'y a pas de cohortes disponibles. En l\'absence de cohortes, <strong>le bloc ne jamais visible</strong>. <br/>
Le cohortes sont gérées dans <a href="{$a->url}">site administration</a>.';
$string['notvisibletoall'] = '<br/>Ce bloc <strong>n\'est visible</strong> pour <strong>aucun</strong> utilisateur.';
$string['notvisibletocohorts'] = '<br/><strong>Non</strong> visible pour les cohortes:';
$string['pluginname'] = 'Texte pour cohortes spécifiques';
$string['privacy:metadata:block'] = 'Le bloc Texte pour cohortes spécifiques stocke toutes ses données dans le sous-système de blocs.';
$string['resetcohortselection'] = 'Réinitialiser la sélection';
$string['resetcohortselection_help'] = 'Si vous activez et enregistrez ce paramètre, la sélection que vous avez effectuée sera réinitialisée. Cela signifie qu\'aucune cohorte ne sera sélectionnée. Malheureusement, cette solution de contournement est nécessaire, car désélectionner toutes les cohortes n\'entraînerait aucun changement étant donné qu\'un résultat vide est transmis au serveur. <br/>Si vous ouvrez à nouveau la configuration du bloc, ce paramètre sera réinitialisé et ne sera plus affiché car il n\'y a plus rien à réinitialiser.';
$string['unrestricted'] = 'Non restreint';
$string['visibletoall'] = '<br/>Ce bloc est <strong>visible</strong> pour <strong>tous</strong> les utilisateurs.';
$string['visibletocohorts'] = '<br/><strong>Visible uniquement</strong> pour les cohortes:';
