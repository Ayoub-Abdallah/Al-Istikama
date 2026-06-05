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
 * Strings for component 'theme_degrade', language 'fr', version '5.1'.
 *
 * @package     theme_degrade
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['background_color'] = 'Couleur d’arrière-plan';
$string['background_color_default'] = 'Thème par défaut {$a}';
$string['background_color_desc'] = 'Couleur de fond de l’en-tête et du pied de page !';
$string['background_text_color'] = 'Couleur du texte';
$string['background_text_color_desc'] = 'Couleur du texte du haut et du pied de page !';
$string['choosereadme'] = 'Degrade est un thème créé avec soin pour apporter des couleurs vives à Moodle.';
$string['contact_address'] = 'Adresse';
$string['contact_email'] = 'E-mail';
$string['contact_phone'] = 'Numéro de téléphone';
$string['content_pagefonts'] = 'Polices supplémentaires Google';
$string['content_pagefonts_desc'] = 'Ajouter ici le lien @import de Google pour les polices supplémentaires.<br>Plusieurs @import peuvent être ajoutés au besoin.<br><a href="https://fonts.google.com/selection/embed" target="google">Code d’intégration</a><br><img src="{$a}" style="max-width: 100%;width: 420px;">';
$string['content_type_default'] = 'Par défaut Moodle';
$string['content_type_empty'] = '(Aucun contenu)';
$string['content_type_footer'] = 'Type de contenu pour le pied de page';
$string['content_type_footer_desc'] = 'Sélectionnez le type de contenu à afficher dans le pied de page.';
$string['content_type_home'] = 'Type de contenu pour la page d’accueil';
$string['content_type_home_desc'] = 'Sélectionnez le type de contenu à afficher sur la page d’accueil.';
$string['content_type_html'] = 'Page à créer avec l’éditeur';
$string['continuar'] = 'Continuer à étudier';
$string['countlesson'] = '{$a} leçon';
$string['countlessons'] = '{$a} leçons';
$string['course_access'] = 'Accéder au cours';
$string['course_moore'] = 'Plus de détails';
$string['customcss_desc'] = 'Toutes les règles CSS que vous ajoutez à cette zone de texte seront reflétées sur toutes les pages, facilitant la personnalisation de ce thème.';
$string['custommenuitems'] = 'Éléments personnalisés du menu principal';
$string['custommenuitems_desc'] = 'Vous pouvez créer un menu personnalisé à côté des menus supérieurs. Le menu racine doit commencer au bord et les sous-menus doivent être précédés d’un trait d’union (-). Le nombre de traits d’union détermine la profondeur de l’élément. Ainsi, les éléments avec un seul trait d’union apparaissent dans un sous-menu sous l’élément de niveau supérieur précédent, et les éléments avec deux traits d’union apparaissent dans un sous-menu sous le sous-menu précédent.
Le contenu de chaque élément de menu doit se composer de trois éléments maximum (<strong>label</strong> | <strong>url</strong> | <strong>info-bulle</strong> | <strong>langue</strong>), chacun séparé par le caractère "|".
<ul>
<li><strong>label</strong> : Ceci est le texte qui sera affiché dans l’élément de menu. Vous devez spécifier un label pour chaque élément de menu.</li>
<li><strong>url</strong> : Ceci est l’URL vers laquelle l’utilisateur sera dirigé en cliquant sur l’élément de menu. Ceci est facultatif ; si non fourni, l’élément ne sera pas lié à un site.<br>
D’autres attributs tels que "target" peuvent être ajoutés à la fin de l’URL.</li>
<li><strong>info-bulle</strong> : Si vous fournissez une URL, vous pouvez également choisir de fournir une info-bulle pour le lien créé avec l’URL. Ceci est facultatif, et si non défini, le label est utilisé comme info-bulle pour l’élément de menu.</li>
<li><strong>langue</strong> : Vous pouvez ajouter un code de langue (ou une liste de codes séparés par des virgules) comme quatrième élément de la ligne. La ligne sera affichée uniquement si l’utilisateur a sélectionné la ou les langues répertoriées.</li>
</ul>
Ci-dessous un exemple de création de menu personnalisé :
<blockquote><pre>
Cours
-Tous les cours | /course/
-Mes cours
--Cours Exemple
---Cours Exemple 7 | /course/view.php?id=7
---Cours Exemple 9 | /course/view.php?id=9
--Cours Test
---Cours Test 2 | /course/view.php?id=2
---Cours Test 5 | /course/view.php?id=5
Google
-Google dans toutes les langues | https://google.com/" target="_blank
-Google au Mexique | https://www.google.com.mx/" target="_blank|Label Google|en
-Google en portugais | https://google.com.br/" target="_blank|Label Google|pt,pt_br,pt_br_kids
Page de Support | https://support.com/" target="_blank
</pre></blockquote>
Pour Moodle avec support de plusieurs langues, la valeur <strong>label</strong> doit être formatée comme <strong>"nomdelangue,nomducomposant"</strong>.
<blockquote><pre>
profil,moodle | /user/profile.php
messages,message | /message/index.php
</pre></blockquote>
<a href="https://docs.moodle.org/404/en/Advanced_theme_settings" target="_blank">Plus d’informations sur le menu</a>';
$string['editor_link_footer'] = 'Modifier le bloc du pied de page pour la langue {$a}';
$string['editor_link_footer_all'] = 'Modifier le bloc du pied de page pour toutes les langues';
$string['editor_link_home'] = 'Modifier la page d’accueil pour la langue {$a}';
$string['editor_link_home_all'] = 'Modifier la page d’accueil pour toutes les langues';
$string['favicon'] = 'Favicon';
$string['favicon_desc'] = 'Le favicon est affiché à côté du titre de la page dans l’onglet du navigateur. Un favicon Moodle est affiché si aucun favicon personnalisé n’est fourni.';
$string['fontfamily'] = 'Police du site';
$string['fontfamily_desc'] = 'Choisissez la police que vous souhaitez utiliser dans votre Moodle';
$string['fontfamily_menus'] = 'Polices des menus';
$string['fontfamily_menus_desc'] = 'Choisir la police à utiliser pour les menus sur votre site Moodle.';
$string['fontfamily_sitename'] = 'Police pour le nom du site';
$string['fontfamily_sitename_desc'] = 'La police qui sera appliquée au nom du site si aucun logo n’est fourni.';
$string['fontfamily_title'] = 'Polices des titres';
$string['fontfamily_title_desc'] = 'Choisir la police à utiliser pour les titres sur votre site Moodle.';
$string['fontpreview'] = 'Aperçu de la liste des polices';
$string['footer_contact_title'] = 'Titre du bloc de contact';
$string['footer_contact_title_default'] = 'Contactez-nous';
$string['footer_contact_title_desc'] = 'Ajoutez le titre du bloc qui apparaîtra dans le pied de page avec les coordonnées de contact.';
$string['footer_description'] = 'Description';
$string['footer_description_desc'] = 'Décrivez votre Moodle, ce que vous faites, et cette information sera affichée sous le logo dans le pied de page de Moodle';
$string['footer_frontpage_blockcourses_instructor'] = 'Afficher le nom de l’enseignant';
$string['footer_frontpage_blockcourses_instructor_desc'] = 'Si coché, affiche les noms des enseignants dans la liste des cours !';
$string['footer_frontpage_blockcourses_text'] = 'Texte court expliquant le bloc "{$a}"';
$string['footer_frontpage_blockcourses_text_desc'] = 'Ajoutez un texte décrivant les "{$a}" !';
$string['footer_links_title'] = 'Titre du bloc des liens';
$string['footer_links_title_default'] = 'Liens importants';
$string['footer_show_copywriter'] = 'Afficher le "Fait avec ❤️"';
$string['footer_show_copywriter_desc'] = 'Décochez si vous souhaitez masquer le "Fait avec ❤️"';
$string['footer_social_title'] = 'Titre du bloc des réseaux sociaux';
$string['footer_social_title_default'] = 'Suivez-nous sur les réseaux sociaux';
$string['footer_social_title_desc'] = 'Ajoutez le titre du bloc qui apparaîtra dans le pied de page avec les données de vos réseaux sociaux.';
$string['footerblink'] = 'Liens du bloc du pied de page';
$string['footerblink_desc'] = 'Vous pouvez configurer ici un bloc de liens du pied de page à afficher par thème. <br>Chaque ligne se compose d’un texte de menu ou d’une clé de langue ou d’un texte, d’une URL de lien (facultatif), séparés par des barres verticales. Par exemple :<br><pre>Support Moodle|https://moodle.org/support</pre>';
$string['footerblock_contact'] = 'Bloc de contact';
$string['footerblock_copywriter'] = 'Fait avec ❤️';
$string['footerblock_description'] = 'Bloc de description';
$string['footerblock_links'] = 'Bloc des liens';
$string['footerblock_social'] = 'Bloc social';
$string['free_name'] = 'Gratuit';
$string['frontpage_about_description'] = 'Décrivez ce que vous faites';
$string['frontpage_about_description_desc'] = 'Décrivez en maximum 5 lignes la finalité de votre Moodle';
$string['frontpage_about_enable'] = 'Activer le bloc À propos';
$string['frontpage_about_enable_desc'] = 'Si coché, le bloc À propos apparaîtra sous la bannière !';
$string['frontpage_about_info'] = 'Boîte de données {$a}';
$string['frontpage_about_logo'] = 'Logo différent à afficher ici';
$string['frontpage_about_logo_desc'] = 'Si défini, ce logo sera utilisé ici au lieu du logo en haut.<br>
                                         Laissez vide pour utiliser le logo en haut !';
$string['frontpage_about_number'] = 'Quantité de données';
$string['frontpage_about_number_desc'] = 'Indiquez ici la quantité d’informations mentionnée ci-dessus';
$string['frontpage_about_text'] = 'Nom de la donnée';
$string['frontpage_about_text_1_defalt'] = 'Cours';
$string['frontpage_about_text_2_defalt'] = 'Enseignants';
$string['frontpage_about_text_3_defalt'] = 'Étudiants';
$string['frontpage_about_text_4_defalt'] = 'Leçons';
$string['frontpage_about_text_desc'] = 'Ajoutez ici le nom de la donnée qui sera affichée sur la page d’accueil';
$string['frontpage_about_title'] = 'Titre du bloc À propos';
$string['frontpage_about_title_default'] = 'Notre communauté mondiale';
$string['heart'] = 'Si vous appréciez ce thème, n’oubliez pas de cliquer sur ❤️ sur la page des thèmes <a href="{$a}" target="_blank">en cliquant ici</a>';
$string['instructor'] = 'Enseignant';
$string['login_backgroundcolor'] = 'Couleur de fond';
$string['login_backgroundcolor_desc'] = 'Sélectionnez la couleur de fond de la page de récupération de mot de passe';
$string['login_backgroundfoto'] = 'Image de fond';
$string['login_backgroundfoto_desc'] = 'Sélectionnez l’image de fond de la connexion/Récupération du mot de passe/Création de compte. L’image par défaut est : {$a}';
$string['login_forgot_description'] = 'Texte sur le côté de l’écran de récupération de mot de passe';
$string['login_forgot_description_desc'] = 'Texte qui apparaîtra uniquement sur l’écran de récupération de mot de passe';
$string['login_login_description'] = 'Texte sur le côté de l’écran de connexion';
$string['login_login_description_desc'] = 'Texte qui apparaîtra uniquement sur l’écran de connexion';
$string['login_signup_description'] = 'Texte sur le côté de l’écran de création de compte';
$string['login_signup_description_desc'] = 'Texte qui apparaîtra uniquement sur l’écran de création de compte';
$string['login_theme'] = 'Thème de connexion';
$string['login_theme_block'] = 'Bloc blanc central avec fond optionnel';
$string['login_theme_desc'] = 'Choisissez le thème que vous souhaitez pour la zone de connexion';
$string['login_theme_image_login'] = 'Image de fond et connexion sur le côté';
$string['login_theme_imagetext_login'] = 'Image de fond, texte sur l’image et connexion sur le côté';
$string['login_theme_login'] = 'Seulement l’écran de connexion, sans image latérale';
$string['logo_color'] = 'Logo en couleur';
$string['logo_color_desc'] = 'Veuillez télécharger votre LOGO en couleur si vous souhaitez l’inclure en haut. Ce logo sera affiché lorsque la page est défilée, et le menu sera affiché sur un fond blanc.';
$string['logo_write'] = 'Logo du menu supérieur lors du défilement';
$string['logo_write_desc'] = 'Veuillez télécharger votre logo si vous souhaitez l’inclure en haut. Ce logo sera affiché lorsque le défilement reste en haut, et le menu sera affiché sur un fond coloré.';
$string['matricular'] = 'S’inscrire';
$string['mycourses_color'] = 'Couleur de fond du bloc';
$string['mycourses_color_desc'] = 'La couleur de fond du bloc.';
$string['mycourses_icon'] = 'Icône';
$string['mycourses_icon_desc'] = 'Une icône représentative pour le bloc. La taille de l’icône doit être de 48x48 pixels.';
$string['mycourses_info'] = 'Bloc {$a}';
$string['mycourses_numblocos'] = 'Aucun bloc';
$string['mycourses_numblocos_desc'] = 'Combien d’images souhaitez-vous dans le diaporama ?';
$string['mycourses_numblocos_nenhum'] = 'Aucune diapositive sur la page d’accueil';
$string['mycourses_title'] = 'Titre court du bloc';
$string['mycourses_title_desc'] = 'Un titre court et descriptif pour le bloc.';
$string['mycourses_url'] = 'Lien du bloc';
$string['mycourses_url_desc'] = 'L’URL vers laquelle naviguer en cliquant sur le bloc. Il peut s’agir d’un lien externe ou d’un lien interne dans la plateforme.';
$string['pluginname'] = 'Degrade';
$string['privacy:metadata'] = 'Le thème Degrade n’enregistre aucune donnée personnelle.';
$string['settings_about_heading'] = 'À propos de votre Moodle';
$string['settings_css_heading'] = 'Polices et CSS';
$string['settings_footer_heading'] = 'Bloc du pied de page';
$string['settings_icons_change_icons'] = 'Changer l’icône par défaut dans la liste des cours';
$string['settings_login_heading'] = 'Écran de connexion';
$string['settings_mycourses_heading'] = 'Mes blocs de cours';
$string['settings_slideshow_heading'] = 'Diaporama';
$string['settings_theme_heading'] = 'Thème';
$string['settings_top_heading'] = 'Menu Principal';
$string['sitefonts'] = 'Polices Google supplémentaires';
$string['sitefonts_desc'] = 'Insérer le code @import des Google Fonts comme indiqué dans l’image ci-dessous. Après avoir enregistré, le champ « Police du site » sera mis à jour, affichant ces polices. Plusieurs @import peuvent être ajoutés au besoin.';
$string['slidecaption_desc'] = 'Entrez le texte de la légende à utiliser sur la diapositive';
$string['slideshow_image'] = 'Image de la diapositive';
$string['slideshow_image_desc'] = 'L’image doit avoir une taille de 1250px X 400px.';
$string['slideshow_info'] = 'Diapositive {$a}';
$string['slideshow_numslides'] = 'Combien d’images dans le diaporama';
$string['slideshow_numslides_desc'] = 'Combien d’images souhaitez-vous dans le diaporama ?';
$string['slideshow_numslides_nenhum'] = 'Aucune diapositive sur la page d’accueil';
$string['slideshow_text'] = 'Texte court descriptif de la diapositive';
$string['slideshow_text_desc'] = 'Insérez un petit texte sur la diapositive.';
$string['slideshow_url'] = 'Lien du bouton des diapositives';
$string['slideshow_url_desc'] = 'Insérez la destination du lien du bouton de l’image de la diapositive';
$string['social_facebook'] = 'Votre Facebook';
$string['social_facebook_desc'] = 'L’URL Facebook de votre organisation.';
$string['social_instagram'] = 'Votre Instagram';
$string['social_instagram_desc'] = 'L’URL Instagram de votre organisation.';
$string['social_linkedin'] = 'Votre Linkedin';
$string['social_linkedin_desc'] = 'L’URL Linkedin de votre organisation.';
$string['social_twitter'] = 'Votre Twitter';
$string['social_twitter_desc'] = 'L’URL Twitter de votre organisation.';
$string['social_youtube'] = 'Votre Youtube';
$string['social_youtube_desc'] = 'L’URL Youtube de votre organisation.';
$string['theme_color-color_buttons'] = 'Couleur des boutons';
$string['theme_color-color_buttons_desc'] = 'La couleur utilisée pour les boutons, ajoutant une cohésion visuelle et mettant en évidence les actions interactives.';
$string['theme_color-color_names'] = 'Couleur des noms';
$string['theme_color-color_names_desc'] = 'Couleur utilisée pour mettre en évidence des noms ou des identifiants, offrant clarté et accentuation des informations de texte spécifiques.';
$string['theme_color-color_primary'] = 'Couleur primaire';
$string['theme_color-color_primary_desc'] = 'La couleur primaire principale du thème, généralement utilisée pour les éléments en surbrillance et l’accentuation.';
$string['theme_color-color_secondary'] = 'Couleur secondaire';
$string['theme_color-color_secondary_desc'] = 'Une couleur secondaire qui complète la couleur primaire, utilisée pour mettre en valeur des éléments secondaires ou pour contraster avec la couleur primaire.';
$string['theme_color_desc'] = 'Sélectionnez les couleurs des textes et des boutons de Moodle ou cliquez sur la ligne ci-dessous :';
$string['theme_color_heading'] = 'Sélection des couleurs du thème';
$string['theme_color_sugestion'] = 'Suggestion de couleur';
$string['theme_color_sugestion_text'] = 'Cliquer sur la ligne pour appliquer la couleur aux champs ci-dessous :';
$string['theme_degrade_about_editbooton'] = 'Modifier le bloc À propos';
$string['theme_degrade_frontpage_bloco'] = 'Bloc "{$a}"';
$string['theme_degrade_frontpage_home'] = 'Blocs de la page d’accueil';
$string['theme_degrade_mycourses_editbooton'] = 'Modifier les blocs';
$string['theme_degrade_slideshow_editbooton'] = 'Modifier le diaporama';
$string['theme_login_branco'] = 'Seulement l’écran de connexion, sans image latérale, avec le formulaire sur fond blanc';
$string['top_color_heading'] = 'Couleur du haut en défilement';
$string['top_scroll'] = 'Épingler le menu lors du défilement de la page';
$string['top_scroll_background_color'] = 'Couleur de fond du menu en haut en défilement';
$string['top_scroll_background_color_desc'] = 'Définissez la couleur de fond lors du défilement de la page.';
$string['top_scroll_desc'] = 'Lorsqu’activé, le menu sera épinglé en haut de l’écran lorsque vous faites défiler la page, assurant un accès facile aux options du menu.';
$string['top_scroll_text_color'] = 'Couleur du texte du menu en haut en défilement';
$string['top_scroll_text_color_desc'] = 'Définissez la couleur du texte du menu lors du défilement de la page.';
$string['vvveb_footer_contact_title_default'] = 'Nous contacter';
$string['vvveb_home_access'] = 'Accéder au cours';
$string['vvveb_home_automatically_catalogo'] = 'Ne pas modifier. Ce bloc sera automatiquement remplacé par le catalogue des cours.';
$string['vvveb_home_automatically_category'] = 'Ne pas modifier. Ce bloc sera automatiquement remplacé par les catégories de cours.';
$string['vvveb_home_automatically_my_course'] = 'Ne pas modifier. Ce bloc sera automatiquement remplacé par les cours auxquels l’étudiant est inscrit.';
$string['vvveb_home_automatically_popular'] = 'Ne pas modifier. Ce bloc sera automatiquement remplacé par les cours les plus populaires.';
$string['vvveb_home_catalogo_heading'] = 'Catalogue des cours';
$string['vvveb_home_category_heading'] = 'Catégories de cours';
$string['vvveb_home_mycourses_heading'] = 'Mes cours';
$string['vvveb_home_popular_course'] = 'Cours populaires';
$string['vvveb_home_team_subtitle'] = 'Nous sommes un groupe de professionnels dédiés à leur travail';
$string['vvveb_home_team_title'] = 'Rencontrez notre équipe';
