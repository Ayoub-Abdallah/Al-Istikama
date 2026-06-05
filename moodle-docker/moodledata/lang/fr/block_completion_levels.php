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
 * Strings for component 'block_completion_levels', language 'fr', version '5.1'.
 *
 * @package     block_completion_levels
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['activitiescompletion'] = 'Achèvement des activités';
$string['activitiestracking'] = 'Suivi des activités';
$string['adminpix'] = 'Défaut (site) :';
$string['allstudents'] = 'Tous les étudiants';
$string['badge'] = 'Badge';
$string['badgeconfiguration'] = 'Configuration du badge';
$string['badgestouse'] = 'Badges à utiliser';
$string['completion'] = 'Achèvement';
$string['completion_levels:addinstance'] = 'Ajouter un nouveau bloc Niveaux d’achèvement';
$string['completion_levels:myaddinstance'] = 'Ajouter un bloc Niveaux d’achèvement au tableau de bord';
$string['completion_levels:overview'] = 'Accéder à la vue d’ensemble de tous les étudiants du cours pour les blocs Niveaux d’achèvement';
$string['completionrequiredforblockinstance'] = 'Cette activité doit être complétée, pour progresser sur le bloc {$a}.';
$string['config:anonymouswalloffame'] = 'Garder le classement anonyme';
$string['config:anonymouswalloffame_help'] = 'Si réglé à Oui, les noms ne seront pas affichés sur le classement';
$string['config:blocktitle'] = 'Titre personnalisé';
$string['config:blocktitle_help'] = 'Il peut y avoir plusieurs instances du bloc Niveaux d’achèvement dans un cours.<br>
Vous pouvez utiliser différents blocs Niveaux d’achèvement pour suivre différents ensemble d’activités, par exemple un pour les devoirs, un pour les tests…<br>
Pour cette raison, vous pouvez choisir un titre plus adapté à la situation pour chaque instance.';
$string['config:completionnotifications'] = 'Bloc Notifications d’achèvement';
$string['config:displayprogressover'] = 'Afficher le progrès sur';
$string['config:displayprogressover_help'] = 'Affiche le progrès comme une valeur relative à ce nombre. Si laissée vide, le progrès sera exprimé comme pourcentage.';
$string['config:filterinactiveusers'] = 'Filtrer les utilisateurs avec une inscription inactive';
$string['config:filterinactiveusers_help'] = 'Filtre du classement et des vues d’ensemble des utilisateurs dont l’inscription est suspendue, expirée ou non commencée.';
$string['config:group'] = 'Visible seulement pour le groupe';
$string['config:group_help'] = 'Si un groupe est sélectionné, seul ce groupe verra ce bloc.';
$string['config:levels_pix'] = 'Badges personnalisés';
$string['config:levels_pix_help'] = 'Nommez les fichiers [niveau].png, de 0 au niveau maximum souhaité. Par exemple: 0.png, 1.png, etc. La taille recommandée pour les images est 150x150.';
$string['config:markactivities'] = 'Marquer les activités sur la page de cours';
$string['config:markactivities_help'] = 'Si réglé à Oui, les activités suivies par ce bloc seront marquées d’une étoile sur la page de cours.';
$string['config:maxlevel'] = 'Niveau maximum';
$string['config:maxlevel_help'] = 'Niveau maximum à utiliser. Les niveaux vont de 0 à &lt;niveaumax&gt; (c’est-à-dire qu’il y aura &lt;niveaumax&gt;+1 niveaux).';
$string['config:sendcompletionnotifications'] = 'Envoyer des notifications d’achèvement du bloc';
$string['config:sendcompletionnotifications_help'] = 'Envoyer des notifications lorsqu’un étudiant atteint 100% pour ce bloc.';
$string['config:sendnotificationsto'] = 'Envoyer une notification à';
$string['config:showonlycogroupmembers'] = 'Limiter aux groupes de l’utilisateur';
$string['config:showonlycogroupmembers_help'] = 'Dans le classement, afficher uniquement les étudiants appartenant au même groupe que l’utilisateur.';
$string['config:trackingmethod'] = 'Méthode de suivi';
$string['config:trackingmethod_help'] = 'Détermine la métrique à utiliser pour le suivi des activités.<br>
Si « Achèvement » est sélectionné, les étudiants progresseront s’ils complètent une activité (dans le sens standard d’achèvement, i.e. quand la case est cochée sur la page de cours).<br>
Si « Note relative » est sélectionnée, les étudiants progresseront d’un nombre de points relatif à leur note.<br>
Dans les deux cas, le progrès pour chaque activité est pondéré par le poids de l’activité (voir ci-dessous).';
$string['config:usealternatenames'] = 'Utiliser les noms alternatifs';
$string['config:usealternatenames_help'] = 'Utiliser les noms alternatifs des étudiants (si disponible) pour l’affichage du classement.';
$string['config:walloffamesize'] = 'Nombre d\'étudiants';
$string['config:walloffamesize_help'] = 'Le nombre d’étudiants à afficher sur le classement. Sélectionnez « Aucun étudiant » pour n’afficher aucun classement.';
$string['contextualizedstring'] = '{$a->context} : {$a->content}';
$string['custompix'] = 'Personnalisé :';
$string['defaultblocktitle'] = 'Niveaux d’achèvement';
$string['defaultpix'] = 'Défaut :';
$string['deletebadgeconfirmation'] = 'Voulez-vous vraiment supprimer les badges personnalisés pour ce bloc ?
Cela supprimera les emoji actuellement enregistrés et les fichiers dans la zone ci-dessous. Cette action est irréversible.';
$string['deletecustompix'] = 'Supprimer les badges personnalisés';
$string['details'] = 'Détails';
$string['dotrack'] = 'Suivre';
$string['enablecustomlevelpix'] = 'Utiliser des badges personnalisés';
$string['hiddenfromstudents'] = 'Cette activité est cachée pour les étudiants.';
$string['hiddenfromstudents_help'] = 'Cette activité est cachée pour les étudiants. Vous pouvez la suivre, mais les étudiants pourraient ne pas pouvoir la compléter.';
$string['hiddenmodule'] = 'Module caché';
$string['levela'] = 'Niveau {$a}';
$string['message:blockcompleted:fullmessage:completion'] = '{$a->username} vient d’atteindre 100% pour le bloc *{$a->blockname}* dans {$a->coursename}, en complétant le module {$a->modname} {$a->cmname}.';
$string['message:blockcompleted:fullmessage:grade'] = '{$a->username} vient d’atteindre 100% pour le bloc *{$a->blockname}* dans {$a->coursename}, en obtenant la note maximale sur le module {$a->modname} {$a->cmname}.';
$string['message:blockcompleted:shortmessage'] = '{$a->username} vient d’atteindre 100% pour le bloc {$a->blockname} dans {$a->coursename}.';
$string['message:blockcompleted:title'] = '[{$a->coursename}] {$a->blockname} complété par {$a->username}';
$string['messageprovider:blockcompleted'] = 'Bloc Notifications d’achèvement';
$string['no_blocks'] = 'Aucun bloc Niveaux d’achèvement n’est configuré sur vos cours.';
$string['noactivitiestracked'] = 'Aucune activité n’est actuellement suivie par ce bloc. Il ne sera pas visible par les étudiants.<br>
Pour modifier ce comportement, veuillez configurer ce bloc et suivre des activités.';
$string['nocompletion'] = 'Cette activité n’a pas d’option d’achèvement activée.';
$string['nograde'] = 'Cette activité n’a pas d’option de note activée.';
$string['nostudents'] = 'Aucun étudiant';
$string['notcompletedyet'] = 'Pas encore terminé';
$string['nothingtoshow'] = 'Rien à afficher.';
$string['notrackableactivities'] = 'Aucune activité n’est disponible pour être suivie par ce bloc. Configurez l’achèvement ou les notes des activités que vous voulez suivre, puis configurez ce bloc.';
$string['overview'] = 'Vue d’ensemble';
$string['overviewofstudents'] = 'Vue d’ensemble des étudiants';
$string['partiallycompleted'] = 'Partiellement terminé ({$a})';
$string['pluginname'] = 'Niveaux d’achèvement';
$string['progress'] = 'Progrès';
$string['score'] = 'Score';
$string['totalweight'] = 'Poids total : {$a}';
$string['trackall'] = 'Tout suivre';
$string['trackingmethodcompletion'] = 'Achèvement';
$string['trackingmethodgrades'] = 'Note relative';
$string['type'] = 'Type';
$string['untrackall'] = 'Ne rien suivre';
$string['validation:enterpositiveorempty'] = 'Veuillez entrer une valeur positive, ou laissez ce champ vide.';
$string['validation:providebadges0toN'] = 'Veuillez fournir les images pour les badges, nommées 0.png, 1.png… jusqu’au niveau maximum souhaité.';
$string['viewprogress'] = 'Voir mon progrès';
$string['walloffame'] = 'Classement';
$string['walloffamea'] = 'Classement {$a}';
$string['weight'] = 'Poids';
$string['weighta'] = 'Poids : {$a}';
