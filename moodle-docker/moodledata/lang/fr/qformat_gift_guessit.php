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
 * Strings for component 'qformat_gift_guessit', language 'fr', version '5.1'.
 *
 * @package     qformat_gift_guessit
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['braceerror'] = 'Impossible de trouver une paire d\'accolades {…} autour du (des) mot(s) à deviner -> {$a}';
$string['bracketserror'] = 'Crochets mal appariés dans cette question -> {$a}';
$string['giftnovalidquestion'] = 'Il y a une erreur dans le formatage de votre question Devinette. Consultez la documentation.';
$string['nbtrieserror'] = 'Le nombre d\'essais {$a->nbtries} n\'est pas dans la plage de valeurs autorisée : 6, 8, 10, 12, 14 -> {$a->line}';
$string['nodescriptionprovided'] = 'Aucune description n\'est fournie pour la question n°{$a->questionnumber} -> {$a->questionname}';
$string['noguessitgaps'] = 'Impossible de trouver le(s) mot(s) à deviner dans la question -> {$a}';
$string['noname'] = 'Pas de nom fourni ou mauvais formatage des deux-points pour cette question -> {$a}';
$string['pluginname'] = 'Format GIFT Devinette';
$string['pluginname_help'] = 'Le format GIFT Devinette permet d\'importer des questions guessit à partir d\'un fichier texte.';
$string['pluginname_link'] = 'qformat/gift_guessit';
$string['privacy:metadata'] = 'Le plugin de format de question GIFT Devinette n’enregistre aucune donnée personnelle.';
$string['wordlecapitalsonly'] = 'ERREUR ! Dans l\'option Wordle, vous devez taper un seul mot et n\'utiliser que des MAJUSCULES (A-Z) et pas d\'accents. -> {$a}';
$string['wordletoolong'] = 'Trop long ! ERREUR ! Dans l\'option Wordle, les mots sont limités à 8 caractères. -> {$a}';
