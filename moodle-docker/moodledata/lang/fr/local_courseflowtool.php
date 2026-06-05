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
 * Strings for component 'local_courseflowtool', language 'fr', version '5.1'.
 *
 * @package     local_courseflowtool
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['associateoutcomes'] = 'Associer les résultats aux leçons (peut créer plusieurs éléments d’évaluation)';
$string['cachedef_courseflow_import_data'] = 'Données d’importation de l’Outil CourseFlow';
$string['confirm_import'] = 'Confirmer et importer';
$string['courseflowtool:view'] = 'Afficher le plugin Outil CourseFlow';
$string['courseflowtool_test'] = 'Tester le plugin Outil CourseFlow';
$string['error'] = 'Erreur';
$string['error_finalize'] = 'Erreur lors de la finalisation de l’importation';
$string['general_instructions'] = 'Pour importer à partir de CourseFlow, allez dans votre cours sur CourseFlow, puis cliquez sur les « … » dans la barre supérieure. Cliquez sur « Plugin Moodle », puis générez soit une URL d’importation, soit un code JSON. Collez le résultat dans la boîte correspondante ci-dessous et cliquez sur le bouton d’importation.';
$string['help_confirm_desc'] = 'Le plugin confirmera maintenant le nombre de sections, de leçons et de résultats qu’il a créés. Vous pouvez ensuite retourner à votre cours.';
$string['help_confirm_title'] = 'Étape 4 : Confirmation finale';
$string['help_courseflow'] = 'Pour commencer, créez votre cours dans CourseFlow comme à l’habitude. Ensuite, pendant que vous consultez votre cours, cliquez sur le bouton (…) en haut à gauche de la page et sélectionnez « Plugin Moodle ». Cela vous mènera à la page où vous pouvez configurer votre cours pour l’exportation vers Moodle. Il y a deux façons d’exporter vers Moodle. La première est de générer un code JSON qui peut être collé dans le plugin CourseFlow Tool. Ce code doit être généré chaque fois que vous effectuez des modifications dans CourseFlow, mais vous permet de garder votre cours privé. L’alternative est de générer une URL d’importation. Cela nécessite que vous ayez créé un lien public vers votre flux de travail (permettant à toute personne ayant le lien de le voir). Ensuite, dans le menu du plugin Moodle, vous verrez une URL d’importation que le plugin peut utiliser pour récupérer automatiquement les données de CourseFlow.';
$string['help_intro'] = 'Cet outil vous permet d’importer des données JSON structurées à partir de CourseFlow dans votre cours Moodle, en créant automatiquement des leçons et des résultats. CourseFlow est un outil gratuit de conception de cours et de programmes disponible à l’adresse';
$string['help_intro_image_alt'] = 'Menu du plugin Moodle dans CourseFlow';
$string['help_option_outcomes'] = 'Associer les résultats aux leçons. Moodle permet d’associer des résultats aux leçons, mais cela crée un élément d’évaluation pour chaque association. Par défaut, le plugin n’associera pas les résultats afin d’éviter d’encombrer le carnet de notes, bien que les résultats s’affichent toujours sur la page principale de la leçon. Si vous souhaitez changer cela plus tard, relancez simplement l’importation.';
$string['help_option_styling'] = 'Activer le style CourseFlow pour les leçons importées. Cela modifiera l’apparence des leçons importées pour ressembler davantage aux nœuds de CourseFlow. Cela ne modifiera pas l’apparence des leçons créées autrement. Si vous souhaitez changer cela plus tard, relancez simplement l’importation et les associations seront mises à jour.';
$string['help_options_desc'] = 'Vous pouvez activer le style CourseFlow et choisir si les résultats doivent être associés aux éléments d’évaluation.';
$string['help_step1_title'] = 'Étape 1 : Générer vos données dans CourseFlow';
$string['help_step2-1_desc'] = 'Accédez au plugin CourseFlow Tool pour commencer le processus d’importation. Il se trouve dans le bloc de navigation, sous les paramètres d’administration de votre cours.';
$string['help_step2-1_image_alt'] = 'Le bloc de navigation du cours';
$string['help_step2-2_desc'] = 'Vous pouvez coller les données JSON brutes ou fournir l’URL dans le champ approprié, puis cliquer sur le bouton d’importation correspondant. Si vous fournissez une URL, le plugin la retiendra pour vous et vous n’aurez pas besoin de la fournir à nouveau pour réimporter ou mettre à jour les données.';
$string['help_step2-2_image_alt'] = 'Écran pour fournir le JSON ou l’URL';
$string['help_step2_title'] = 'Étape 2 : Importer vos données';
$string['help_step3_desc'] = 'Un aperçu de toutes les leçons et de tous les résultats sera affiché. Vous pouvez sélectionner ou désélectionner les éléments à importer si vous ne souhaitez pas importer certaines parties du cours. Lorsque vous avez terminé, cliquez sur « Confirmer et importer » en haut de la page. Le plugin CourseFlow Tool conserve les identifiants de toutes les leçons et de tous les résultats qu’il génère, ainsi que leurs équivalents dans la base de données de CourseFlow. Si vous importez le même cours deux fois, il mettra à jour les leçons et les résultats existants au lieu de les dupliquer. À noter : afin d’éviter toute suppression accidentelle de vos données, aucun élément ne sera supprimé même s’il est manquant dans une nouvelle importation. Par contre, la suppression d’un résultat d’une leçon peut entraîner la suppression d’un élément d’évaluation associé, ce qui peut entraîner la perte de données saisies pour cet élément. Cela ne s’applique que si vous avez sélectionné l’option d’association des résultats.';
$string['help_step3_image_alt'] = 'Aperçu des leçons et des résultats';
$string['help_step3_title'] = 'Étape 3 : Aperçu de votre importation';
$string['help_title'] = 'Aide de l’Outil CourseFlow';
$string['import_json'] = 'Importer à partir de JSON';
$string['import_json_instructions'] = 'Copiez et collez ici le code JSON généré par CourseFlow';
$string['import_options'] = 'Options';
$string['import_success'] = 'Importation complétée avec succès! Créé';
$string['import_url_instructions'] = 'Copiez et collez ici l’URL générée par CourseFlow';
$string['json_import_title'] = 'Importer le JSON CourseFlow';
$string['json_process_decode_error'] = 'Erreur lors du décodage du JSON.';
$string['json_process_error'] = 'Erreur lors du traitement du JSON';
$string['json_process_invalid'] = 'Données JSON invalides.';
$string['jsoninput_button'] = 'Importer à partir de JSON';
$string['jsoninput_placeholder'] = 'Collez votre JSON ici…';
$string['label_overwrite'] = 'Écraser le libellé du sujet existant (si applicable)';
$string['lesson'] = 'Leçon';
$string['lessons'] = 'Leçons';
$string['no_data'] = 'Aucune donnée trouvée dans la session.';
$string['no_data_preview'] = 'Aucune donnée à prévisualiser. Veuillez retourner en arrière et téléverser un JSON d’abord.';
$string['open_help_page'] = 'Ouvrir la page d’aide';
$string['outcome'] = 'Objectif';
$string['outcomes'] = 'Objectifs';
$string['pluginname'] = 'Outil CourseFlow';
$string['preview_title'] = 'Aperçu de l’importation CourseFlow';
$string['privacy:metadata'] = 'Aucune donnée liée à un utilisateur spécifique n’est stockée. Les paramètres sont liés au cours Moodle et à son cours source dans CourseFlow, mais pas à un utilisateur individuel. Les données saisies par l’utilisateur sont stockées uniquement temporairement pendant la création des objets Moodle. Elles ne sont également pas liées à un utilisateur spécifique.';
$string['returntocourse'] = 'Retourner au cours';
$string['section'] = 'Section';
$string['sections'] = 'Sections';
$string['select_all'] = 'Tout sélectionner/désélectionner';
$string['url_input_label'] = 'Importer à partir d’une URL';
$string['urlinput_button'] = 'Importer à partir d’une URL';
$string['usecourseflowstyle'] = 'Utiliser le style CourseFlow pour les leçons importées';
