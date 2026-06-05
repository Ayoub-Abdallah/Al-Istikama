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
 * Strings for component 'block_xp', language 'fr', version '5.1'.
 *
 * @package     block_xp
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['actions'] = 'Actions';
$string['activityname'] = 'Nom de l’activité';
$string['activityname_help'] = 'Texte que le nom de l’activité doit contenir ou auquel il doit être égal. Ce n’est pas sensible à la casse.';
$string['activityoresourceis'] = 'L’activité ou ressource est {$a}';
$string['addacondition'] = 'Ajouter une condition';
$string['addarule'] = 'Ajouter une règle';
$string['addinstructions'] = 'Ajouter plus d’information';
$string['additionalresources'] = 'Ressources supplémentaires';
$string['addlevel'] = 'Ajouter un niveau';
$string['addondeactivated'] = 'XP+ désactivé';
$string['addondeactivatedinfo'] = 'Les plugins XP sont incompatibles entre eux, ce qui a entraîné la désactivation de XP+. La version {$a->localxpversion} de Level Up XP+ (local_xp) est attendue.';
$string['addoninstallationerror'] = 'Nous détectons un problème avec le module complémentaire (local_xp), il ne semble pas être installé correctement. Un administrateur devrait finaliser son installation.';
$string['addonnotactivated'] = 'Le module complémentaire n’est pas activé.';
$string['addrulesformhelp'] = 'La dernière colonne définit la quantité de points d’expérience acquise lorsque le critère est rempli.';
$string['admindefaultrulesintro'] = 'Les règles suivantes seront utilisées par défaut dans les cours où le bloc est ajouté.';
$string['admindefaultsettingsintro'] = 'Les réglages ci-dessous seront utilisés par défaut quand le bloc est ajouté dans un cours. Certains réglages peuvent être verrouillés, auquel cas leur valeur est imposée dans toutes les instances du plugin.';
$string['admindefaultvisualsintro'] = 'Le visuel suivant sera utilisé par défaut quand le bloc est ajouté dans un cours.';
$string['adminnoticeaddondeactivatedmessage'] = 'Level Up XP+ a été désactivé !

Vous recevez cet avis à titre d\'avertissement car Level Up XP+ a été désactivé afin d\'éviter tout problème potentiel. Les deux plugins Level Up XP (block_xp) et Level Up XP+ (local_xp) sont actuellement incompatibles l\'un avec l\'autre. Ce problème survient lorsque XP a été mis à niveau vers une nouvelle version majeure alors que XP+ reste obsolète.

Cette incompatibilité peut entraîner une perte de fonctionnalité, des bogues et d\'autres conséquences inattendues. Pour résoudre ce problème, vous devez mettre à jour Level Up XP+.

- Level Up XP (block_xp) version : {$a->blockxpversion}
- Level Up XP+ (local_xp) version : {$a->localxpversion}
- Version attendue de Level Up XP+ : {$a->localxpversionexpected}

Ressources supplémentaires :

- [Documentation de mise à niveau](https://docs.levelup.plus/xp/docs/upgrade)
- [Documentation sur la désactivation de XP+](https://docs.levelup.plus/xp/docs/addon-deactivated)
- [Documentation sur la compatibilité](https://docs.levelup.plus/xp/docs/requirements-compatibility)

--

Cet avis a été envoyé à tous les administrateurs. Pour désactiver toutes les notifications aux administrateurs, veuillez modifier les paramètres d\'administration de Level Up XP.';
$string['adminnoticeaddondeactivatedsubject'] = 'Plugin XP+ désactivé !';
$string['adminnoticeoutofsyncmessage'] = 'Avis d\'incompatibilité entre Level Up XP et Level Up XP+ !

Vous recevez cet avertissement car les deux plugins Level Up XP (block_xp) et Level Up XP+ (local_xp) sont actuellement "désynchronisés" et incompatibles l\'un avec l\'autre. Ce problème survient lorsque XP a été mis à niveau vers une nouvelle version majeure alors que XP+ reste obsolète.

Cette incompatibilité peut entraîner une perte de fonctionnalité, des bogues et d\'autres conséquences inattendues. Pour résoudre ce problème, vous devez mettre à jour Level Up XP+.

**À l\'avenir, si ces plugins ne sont pas synchronisés, Level Up XP+ se désactivera automatiquement. Pour éviter cela, assurez-vous de ne pas mettre à jour Level Up XP vers une nouvelle version majeure sans mettre également à jour Level Up XP+.

- Level Up XP (block_xp) version : {$a->blockxpversion}
- Level Up XP+ (local_xp) version : {$a->localxpversion}
- Version attendue de Level Up XP+ : {$a->localxpversionexpected}

Ressources supplémentaires :

- [Documentation sur la mise à niveau](https://docs.levelup.plus/xp/docs/upgrade)
- [Documentation sur la compatibilité](https://docs.levelup.plus/xp/docs/requirements-compatibility)

--

Cet avis a été envoyé à tous les administrateurs. Pour désactiver tous les avis administratifs, veuillez modifier les paramètres administratifs de Level Up XP.';
$string['adminnoticeoutofsyncsubject'] = 'Avis d\'incompatibilité des plugins XP !';
$string['adminnotices'] = 'Avis de l\'administration';
$string['adminnotices_desc'] = 'Lorsque cette option est activée, les administrateurs de sites peuvent occasionnellement recevoir des notifications importantes concernant la compatibilité, la sécurité et la disponibilité de nouvelles versions de Level Up XP+.';
$string['adminscanearnxp'] = 'Les administrateurs peuvent gagner des points';
$string['adminscanearnxp_desc'] = 'Par défaut, les administrateurs ne sont pas inclus dans le groupe d’utilisateurs qui peuvent gagner des points. Ceci parce que les administrateurs ont toujours la permission _block/xp:earnxp_, ce qui leur permet de gagner des points continuellement et partout. Utilisez ce paramètre pour permettre aux administrateurs de gagner des points.';
$string['allcoursesreset'] = 'Tous les cours ont été réinitialisés.';
$string['anonymity'] = 'Anonymat';
$string['anonymity_help'] = 'Ce réglage contrôle si les participants peuvent voir les noms et avatars des autres participants.';
$string['apply'] = 'Appliquer';
$string['awardaxpwhen'] = '<strong>{$a}</strong> points d’expérience sont attribués quand :';
$string['badgeaward'] = 'Badge à donner';
$string['badgeawarddesc'] = 'Un badge à donner quand l’utilisateur atteint le niveau.';
$string['basepoints'] = 'Points de base';
$string['basepointslineardesc'] = 'L’incrémentation minimum entre les niveaux.';
$string['basepointsrelativedesc'] = 'Les nombre de points pour démarrer.';
$string['basexp'] = 'Base de l’algorithme';
$string['blockappearance'] = 'Apparence du bloc';
$string['blockappearancemovedtopluginsettings'] = 'Les paramètres d’apparence du bloc ont été déplacés vers la page de paramètres du plugin.';
$string['cachedef_block_count'] = 'Nombre d\'instances de blocs';
$string['cachedef_filters'] = 'Filtres de niveau';
$string['cachedef_metadata'] = 'Métadonnées';
$string['cachedef_ruleevent_eventslist'] = 'Liste de quelques événements';
$string['canjoinfromdatex'] = 'Vous pourrez vous inscrire à partir de {$a}.';
$string['cannotbesetindefaults'] = 'Ceci ne peut pas être défini dans les valeurs par défaut.';
$string['cannotearnpoints'] = 'Ne peut pas gagner de points.';
$string['cannotshowblockconfig'] = 'Normalement, j’afficherais les paramètres d’apparence ici, mais je n’ai pas trouvé votre bloc. Pour modifier l’apparence du bloc, retournez [ici]({$a}) (ou à l’endroit où vous avez ajouté le bloc), activez le mode d’édition et suivez l’option « Configurer » dans la liste déroulante du bloc. Si vous ne trouvez pas le bloc, ajoutez-le à nouveau à votre cours.';
$string['cannotshowblockconfigsys'] = 'Normalement, j’afficherais les paramètres d’apparence ici, mais je n’ai pas trouvé votre bloc. Il est peut-être absent de la [page d’accueil]({$a->fp}) et du [tableau de bord par défaut]({$a->mysys}) de vos utilisateurs, ou présent dans les deux. Pour modifier les paramètres à partir d’ici, assurez-vous qu’il n’apparaît que dans l’un d’eux.';
$string['changecourse'] = 'Changer de cours';
$string['changelevelformhelp'] = 'Si vous changez le nombre de niveaux, les badges de niveau personnalisés seront temporairement désactivés pour éviter d’éventuels niveaux sans badges. Si vous changez le nombre de niveaux, une fois ce formulaire enregistré, visitez la page \'Visuels\' pour réactiver les badges personnalisés.';
$string['changetocourse'] = 'Changer pour le cours';
$string['changetositewide'] = 'Retour à l\'ensemble du site';
$string['cheatguard'] = 'Protection anti-triche';
$string['cheatguardsettingsmovednotice'] = 'Les paramètres de la protection contre les tricheurs ont été déplacés vers la [page des règles de l\'événement] ({$a->url}).';
$string['checkaddoncompatibility'] = 'Compatibilité avec l\'extension Level Up XP';
$string['chooseacondition'] = 'Choisir une condition';
$string['clearfilter'] = 'Effacer le filtre';
$string['clicktoselectcm'] = 'Cliquer pour choisir une activité ou une ressource';
$string['cmselector'] = 'Sélecteur de module';
$string['coefxp'] = 'Coefficient de l’algorithme';
$string['colon'] = '{$a->a} : {$a->b}';
$string['comparisonmethod'] = 'Méthode de comparaison';
$string['compatibilitycheck'] = 'Test de compatibilité';
$string['completionrules'] = 'Règles d’achèvement';
$string['completionrules_help'] = 'Les règles d’achèvement sont réparties en trois catégories : achèvement de l’activité, achèvement de la section et achèvement du cours. L’ajout de conditions aux catégories détermine quand et combien de points sont attribués.

Les règles sont évaluées dans l’ordre dans lequel elles sont présentées à l’écran. Dès qu’une condition est remplie, les points correspondants sont attribués et les autres règles ne sont pas évaluées.

[En savoir plus](https://docs.levelup.plus/xp/docs/completion-rules?ref=blockxp_help)';
$string['completionrulesintro'] = 'Attribuez des points aux étudiants lorsqu’ils terminent des activités, des sections ou des cours.';
$string['completionruleslegacyusednotice'] = 'Vous avez des « règles d’événement » existantes qui utilisent des conditions d’achèvement. Nous vous recommandons vivement de les supprimer au profit des méthodes ci-dessous, car l’utilisation à la fois de « règles d’événement » et de « règles d’achèvement » pourrait doubler les points attribués.';
$string['condition'] = 'Condition';
$string['configblockrankingsnapshot'] = 'Afficher l’instantané du classement';
$string['configblockrankingsnapshot_help'] = 'L’instantané du classement affiche le rang de l’utilisateur. Il tente également d’afficher les deux personnes qui entourent l’utilisateur. Cette fonctionnalité nécessite que le classement soit activé et que les rangs soient affichés.';
$string['configdescription'] = 'Introduction';
$string['configdescription_help'] = 'Un court message d’introduction s’affiche dans le bloc. Les étudiants ont la possibilité de rejeter le message, auquel cas ils ne le verront plus.';
$string['configheader'] = 'Réglages';
$string['configrecentactivity'] = 'Afficher les récompenses récentes';
$string['configrecentactivity_help'] = 'Si c’est activé, le bloc affichera une courte liste d’événements récents qui ont récompensé l’étudiant avec des points.';
$string['configtitle'] = 'Titre';
$string['configtitle_help'] = 'Le titre du bloc.';
$string['congratulationsyouleveledup'] = 'Félicitations !';
$string['coolthanks'] = 'Merci c’est cool !';
$string['copiedexcl'] = 'Copié !';
$string['coursea'] = 'Cours « {$a} »';
$string['courselog'] = 'Journal';
$string['courselogintro'] = 'Le journal affiche les actions observées et le nombre de points qu\'elles ont permis d\'obtenir.';
$string['coursereport'] = 'Rapport';
$string['coursereportintro'] = 'Le rapport fournit des détails sur chaque participant et permet d\'agir sur chacun individuellement ou sur tous globalement.';
$string['courserules'] = 'Règles du cours';
$string['courseselectedcolon'] = 'Cours sélectionné&nbsp;:';
$string['coursesettings'] = 'Réglages du cours';
$string['coursevisuals'] = 'Visuels de cours';
$string['currencysign'] = 'Symbole des points';
$string['currencysign_help'] = 'Avec ce paramètre vous pouvez changer la signification des points. Il sera affiché à côté des points des utilisateurs à la place du traditionnel _points d’expérience_.

Choisissez un des symboles proposés, ou téléchargez le vôtre !';
$string['currencysignxp'] = 'XP (Points d’expérience)';
$string['customizelevels'] = 'Personnaliser les niveaux';
$string['dangerzone'] = 'Zone de danger';
$string['dataformat'] = 'Format';
$string['defaultlevels'] = 'Niveaux par défaut';
$string['defaultrules'] = 'Règles par défaut';
$string['defaultrulesformhelp'] = 'Ce sont les règles par défaut fournies par le plugin, elles donnent automatiquement des points par défaut et ignorent certains événements redondants. Vos propres règles ont la priorité sur elles.';
$string['defaultsettings'] = 'Réglages par défaut';
$string['defaultvisuals'] = 'Apparence par défaut';
$string['deletecondition'] = 'Supprimer la condition';
$string['deleterule'] = 'Supprimer la règle';
$string['description'] = 'Description';
$string['difference'] = 'Diff.';
$string['difficulty'] = 'Méthode du calcul des points';
$string['difficultyflat'] = 'Égal';
$string['difficultyflatdesc'] = 'Tous les niveaux requiert le même nombre de points à atteindre.';
$string['difficultylinear'] = 'Augmentant';
$string['difficultylineardesc'] = 'Les niveaux prennent progressivement plus de temps à atteindre.';
$string['difficultylinearincrdesc'] = 'Le nombre de points utilisés pour la difficulté progressive.';
$string['difficultypointincrease'] = 'Augmentation de point';
$string['difficultyrelative'] = 'Boule de neige';
$string['difficultyrelativedesc'] = 'Les niveaux deviennent exponentiellement plus difficile à atteindre.';
$string['difficultyrelativeincrdesc'] = 'Le pourcentage de points à augmenter depuis le niveau précédent.';
$string['discoverlevelupplus'] = 'Découvrez Level Up XP+';
$string['dismissnotice'] = 'Masquer la note';
$string['displayeveryone'] = 'Afficher tout le monde';
$string['displaynneighbours'] = 'Afficher {$a} voisins';
$string['displayoneneigbour'] = 'Afficher un voisin';
$string['displayparticipantsidentity'] = 'Afficher l’identité des participants';
$string['displayrank'] = 'Afficher le rang';
$string['displayrelativerank'] = 'Afficher un rang relatif';
$string['documentation'] = 'Documentation';
$string['drops'] = 'Drops';
$string['drops_help'] = 'Dans les jeux vidéo, certains personnages peuvent _lâcher_ ("drop" en anglais) des objets ou des points d’expérience sur le sol pour que le joueur les ramasse. Ces objets et points sont communément appelés "drops".

Dans Level Up XP, les drops sont des codes courts (par exemple `[xpdrop abcdef]`) qu’un enseignant peut placer dans le contenu Moodle. Lorsqu’ils sont rencontrés par un utilisateur, ces drops seront ramassés et un certain nombre de points seront attribués.

Pour l’instant, les drops sont invisibles pour l’utilisateur et attribuent passivement des points la première fois qu’ils sont rencontrés.

Les drops peuvent être utilisés pour attribuer astucieusement des points lorsque certains types de contenu sont consommés par un étudiant. Voici quelques idées :

- Placer un drop dans les commentaires d’un quiz uniquement visible pour les scores parfaits
- Placer un drop dans un contenu approfondi pour récompenser sa consommation
- Placer un drop dans une discussion de forum intéressante
- Placer un drop dans une page difficile à atteindre dans un module de cours

[Plus d’informations](https://docs.levelup.plus/xp/docs/how-to/use-drops?ref=blockxp_help)';
$string['dropsintro'] = 'Les drops sont des morceaux de code directement placés dans le contenu qui attribuent des points lorsqu’ils sont rencontrés par un utilisateur.';
$string['editcondition'] = 'Modifier la condition';
$string['editingdefaultsettingsincoursemodenotice'] = '**Attention !** Vous ne modifiez pas les paramètres actuellement actifs, mais les valeurs par défaut. Pour modifier les paramètres d\'un cours, cliquez sur le lien « Paramètres » dans le bloc XP.';
$string['editingdefaultsettingsinwholesitemodenotice'] = '**Attention !** Vous ne modifiez pas les paramètres actifs actuellement, mais vous êtes en train de modifier les valeurs par défaut. Comme Level Up XP est utilisé sur l’ensemble du site, votre intention est probablement de modifier les paramètres du site. [Naviguez ici]({$a->url}) pour modifier ces paramètres, ou suivez le lien "Paramètres" à partir du bloc XP lui-même.';
$string['editinstructions'] = 'Modifier l’information';
$string['embedleaderboard'] = 'Intégrer le classement';
$string['enablecheatguard'] = 'Activer la mise en garde sur la triche';
$string['enablecheatguard_help'] = 'Le dispositif de protection contre la tricherie offre un mécanisme simple et peu coûteux pour empêcher les étudiants d’abuser du système en utilisant des techniques évidentes, telles que l’actualisation permanente de la même page ou la répétition de la même action à plusieurs reprises.

[Plus d’infos](https://docs.levelup.plus/xp/docs/getting-started/cheat-guard?ref=blockxp_help)';
$string['enableinfos'] = 'Activer la page d’info';
$string['enableinfos_help'] = 'Lorsque ce réglage est sur « Non », les étudiants ne seront pas en mesure d’afficher la page d’information.';
$string['enableladder'] = 'Activer le classement';
$string['enableladder_help'] = 'Si cette option est réglée sur « Non », les étudiants ne pourront pas consulter le classement.';
$string['enablelevelupnotif'] = 'Activer la notification de progression';
$string['enablelevelupnotif_help'] = 'Lorsque ce réglage est à « Oui », une fenêtre surgissante sera affichée pour féliciter les étudiants du nouveau niveau atteint.';
$string['enablelogging'] = 'Activer l’historique';
$string['enablexpgain'] = 'Activer le gain de points';
$string['enablexpgain_help'] = 'Si ce réglage est à « Non », personne ne pourra gagner des points d’expérience dans ce cours. Ceci peut être utile pour bloquer l’expérience acquise, ou pour la débloquer à un certain moment.

Notez que ceci peut être contrôlé de manière plus fine par la permission \'block/xp:earnxp\'.';
$string['entersearchterm'] = 'Entrez un terme de recherche';
$string['envcheckaddonincompatibilitymessage'] = 'Le plugin Level Up XP+ (local_xp) est incompatible avec Level Up XP (block_xp). Cela entraînera la désactivation de XP+. Pour éviter cela, veuillez mettre à jour les deux plugins. Pour plus d\'informations, veuillez consulter le site https://docs.levelup.plus/xp/docs/compatibility.';
$string['erroraddondeactivated'] = 'Level Up XP+ a été désactivé. Veuillez consulter la [documentation]({$a->docsurl}) pour plus d\'informations.';
$string['errorcontextcoursemismatchforwholesite'] = 'L’URL de cette page <em>Progressez !</em> ne correspond pas à la configuration actuelle du plugin. Votre configuration actuelle déclare que <em>Progressez !</em> doit être utilisé « Pour l’ensemble du site », mais cette page s’attend à ce qu’il soit utilisé « Par cours ». Veuillez <a href="{$a->nexturl}">cliquer ici</a> pour aller à la bonne page. Cherchez le paramètre « block_xp_context » si vous voulez changer votre configuration.';
$string['errorcontextcoursemismatchpercourse'] = 'L’URL de cette page <em>Progressez !</em> ne correspond pas à la configuration actuelle du plugin. Votre configuration actuelle déclare que <em>Progressez !</em> doit être utilisé « Par cours », mais cette page s’attend à ce qu’il soit utilisé « Pour l’ensemble du site ». Il provient très probablement d’un <em>bloc</em> qui a été ajouté au tableau de bord ou à la page d’accueil dans une configuration différente. Vous devez supprimer le bloc des dernières pages et n’utiliser le bloc que dans les cours individuels.';
$string['errorformvalues'] = 'll y a quelques problèmes dans les valeurs de formulaire, veuillez les corriger.';
$string['errorlevelsincorrect'] = 'Le nombre minimum de niveaux est 2';
$string['errornotalllevelsbadgesprovided'] = 'Tous les badges de niveau n’ont pas été fournis. Manquant : {$a}';
$string['errorunknownevent'] = 'Erreur : événement inconnu';
$string['errorunknownmodule'] = 'Erreur : module inconnu';
$string['errorxprequiredlowerthanpreviouslevel'] = 'Les points requis sont inférieurs ou égaux au niveau précédent.';
$string['event_user_leveledup'] = 'Utilisateur promu';
$string['eventis'] = 'L’événement est {$a}';
$string['eventname'] = 'Nom de l’événement';
$string['eventproperty'] = 'Propriété de l’événement';
$string['eventsrules'] = 'Règles pour les événements';
$string['eventsrules_help'] = 'Ce plugin utilise les événements pour attribuer des points aux actions effectuées par les étudiants.
Vous pouvez utiliser le formulaire ci-dessous pour ajouter vos propres règles et modifier les règles par défaut.

Il est conseillé de consulter la page _Log_ du plugin pour identifier les événements déclenchés lorsque les étudiants effectuent des actions dans le cours.

Ressources additionnelles:

- [Comment sont calculés les points d’expérience?] (https://docs.levelup.plus/xp/docs/getting-started/points-calculation?ref=blockxp_help))
- [Règles de dépannage] (https://docs.levelup.plus/xp/docs/troubleshooting/event-rule-not-working?ref=blockxp_help)';
$string['eventsrulesintro'] = 'Observez les actions et attribuez des points aux étudiants lorsqu’ils les réalisent.';
$string['eventtime'] = 'Heure de l’événement';
$string['export'] = 'Exporter';
$string['exportdata'] = 'Exporter des données';
$string['filterbyuser'] = 'Filtrer par utilisateur';
$string['filterellipsis'] = 'Filtrer…';
$string['filtermodules'] = 'Filtrer les modules';
$string['filterparticipants'] = 'Filtrer les participants';
$string['for1day'] = 'Pour 1 jour';
$string['for1month'] = 'Pour 1 mois';
$string['for1week'] = 'Pour une semaine';
$string['for3days'] = 'Pour 3 jours';
$string['forever'] = 'Pour toujours';
$string['forthewholesite'] = 'Pour tout le site';
$string['give'] = 'donne';
$string['gotofullladder'] = 'Voir le classement complet';
$string['graderules'] = 'Les règles d’éléments d’évaluation';
$string['graderules_help'] = 'Les étudiants recevront autant de points que leurs notes.
Une note de 5/10, et une note de 5/100 donneront toutes deux 5 points à l’étudiant.
Quand la note d’un étudiant change plusieurs fois, ils recevront les points égaux à la note maximale qu’ils ont obtenu.
Les points d’un étudiant ne sont jamais diminués, et les notes négatives sont ignorées.

Exemple : Alice soumet un devoir et reçoit une note de 40/100. Dans _Level Up XP_, Alice reçoit 40 points pour sa note.
Alice soumet une autre version de son devoir, mais cette fois sa note est diminuée à 25/100. Les points d’Alice dans _Level Up XP_ ne changent pas.
Pour sa dernière tentative, Alice reçoit une note de 60/100, elle gagne 20 points additionels dans _Level Up XP_, le total de points qu’elle a obtenu est de 60.

[Plus sur la documentation de _Level Up XP_ (anglais)](https://docs.levelup.plus/xp/docs/how-to/grade-based-rewards?ref=blockxp_help)"';
$string['graderulesintro'] = 'Les règles d’éléments d’évaluation permettent aux utilisateurs de recevoir des points égaux aux notes qu’ils reçoivent.';
$string['grid'] = 'Grille';
$string['hasbadgeaward'] = 'Badge à donner défini';
$string['hasdescription'] = 'Description définie';
$string['hasname'] = 'Nom défini';
$string['hasnobadgeaward'] = 'Pas de badge à donner';
$string['hasnodescription'] = 'Pas de description';
$string['hasnoname'] = 'Pas de nom';
$string['hasnopopupmessage'] = 'Pas de message de popup';
$string['haspopupmessage'] = 'Message de popup défini';
$string['hideparticipantsidentity'] = 'Masquer l’identité des participants';
$string['hiderank'] = 'Masquer le rang';
$string['importpoints'] = 'Importer des points';
$string['importpoints_help'] = 'L’importation peut être utilisée pour _augmenter_ les points des étudiants, ou pour les _remplacer_ par la valeur fournie.

Notez que l’importation __n’utilise pas__ le même format que le rapport exporté. Le format requis est décris dans la [documentation (en)](https://docs.levelup.plus/xp/docs/how-to/import-points/importing-points-from-csv?ref=block_xp_help), où un [fichier d’exemple](https://docs.levelup.plus/xp/docs/how-to/import-points/importing-points-from-csv?ref=blockxp_help#sample-file) est disponible.';
$string['importpointsintro'] = 'Importez des points à partir d’un fichier CSV et, facultativement, envoyez un message au destinataire.';
$string['incourses'] = 'Dans les cours';
$string['ineffective'] = 'Ineffectif';
$string['infos'] = 'Information';
$string['infos_help'] = 'La page d\'information donne aux étudiants une vue d\'ensemble des niveaux et des points nécessaires pour les atteindre. Elle affiche également le nom de chaque niveau, ainsi que sa description.';
$string['infosintro'] = 'La page d\'information affiche la liste des niveaux et certains de leurs détails.';
$string['installed'] = 'Installé';
$string['instructions'] = 'Instructions';
$string['instructions_help'] = 'Les instructions seront affichées sur la page d\'information. Vous pouvez les utiliser pour partager des informations et des instructions concernant les niveaux, la manière d\'obtenir des points, etc.';
$string['invalidxp'] = 'Valeur des points non valide';
$string['join'] = 'Rejoindre';
$string['joinleadeboardconfirmnote'] = 'Fantastique, nous sommes ravis de vous compter parmi nous !

Veuillez noter qu\'une fois que vous vous êtes inscrit, il y a une période d\'attente avant que vous ne puissiez quitter le classement si vous changez d\'avis.';
$string['joinleadeboardlockednote'] = 'Vous ne pouvez pas rejoindre le classement.';
$string['joinleaderboard'] = 'Rejoindre le classement';
$string['keeplogs'] = 'Conserver l’historique';
$string['ladder'] = 'Classement';
$string['ladder_help'] = 'Le tableau de classement classe les étudiants en fonction de leurs points. Lorsqu\'il est utilisé dans un cours avec des groupes, il peut créer un classement pour chaque groupe d\'étudiants.

Plusieurs options sont disponibles pour personnaliser le tableau de classement et l\'expérience qu\'il offrira aux participants.';
$string['ladderadditionalcols'] = 'Colonnes additionnelles';
$string['ladderadditionalcols_help'] = 'Ce réglage détermine quelles colonnes additionnelles sont affichées sur le tableau de classement. Maintenez la touche Ctrl ou Cmd appuyée tout en cliquant pour sélectionner plus d’une colonne, ou pour enlever une colonne déjà sélectionnée.';
$string['ladderempty'] = 'Le classement est actuellement vide, n’hésitez pas à revenir plus tard !';
$string['ladderintro'] = 'Le tableau de classement présente un classement des personnes en fonction de leur nombre total de points.';
$string['ladderiso'] = 'Isoler les participants';
$string['ladderiso_help'] = 'Créez des classements distincts pour différents groupes de personnes.

- Défaut (mode groupe) : suit le mode groupe du cours pour créer des classements pour chaque groupe.
- Utilisation de cohortes : Seuls les membres d\'une même cohorte apparaîtront dans le classement d\'une personne.

[Plus d\'informations] (https://docs.levelup.plus/xp/docs/leaderboard-isolation)';
$string['ladderisocohorts'] = 'Utilisation de cohortes';
$string['ladderisodefault'] = 'Défaut (mode groupe)';
$string['ladderparticipation'] = 'Participation';
$string['ladderparticipation_help'] = 'Définit si les utilisateurs sont tenus de participer au classement ou s\'ils peuvent le faire ou le quitter selon leurs préférences.

- Automatique, pas d\'exclusion : Tous les utilisateurs participent automatiquement au classement et ne peuvent pas le quitter.
- Automatique, avec possibilité de retrait : Tous les utilisateurs s\'inscrivent automatiquement au classement mais peuvent choisir de le quitter.
- Facultatif, avec option d\'adhésion : les utilisateurs doivent s\'inscrire explicitement au classement pour y participer.

Les utilisateurs peuvent changer d\'avis et quitter ou rejoindre le classement après avoir choisi de s\'y inscrire ou non. Toutefois, pour éviter tout comportement involontaire, les utilisateurs qui s\'inscrivent au classement ne peuvent pas se retirer pendant trois jours.

[Plus d\'informations] (https://docs.levelup.plus/xp/docs/leaderboard-opt-out)';
$string['ladderparticipationforced'] = 'Automatique, pas de désinscription possible';
$string['ladderparticipationoptin'] = 'Optionnel, avec inscription possible';
$string['ladderparticipationoptout'] = 'Automatique, désinscription possible';
$string['ladderparticipationreset'] = 'Supprimer le statut de participation enregistré de chacun.';
$string['ladderparticipationreset_help'] = 'Si cette case est cochée, le statut de participation de tous les utilisateurs sera effacé et tous les utilisateurs devront à nouveau s\'inscrire ou se désinscrire.';
$string['laddersettingsmovednotice'] = 'Les paramètres du classement ont été déplacés vers la [page du classement] ({$a->url}).';
$string['learnmore'] = 'En savoir plus';
$string['leave'] = 'Quitter';
$string['leaveleadeboardconfirmnote'] = 'Voulez-vous vraiment quitter le classement ?

Une fois que vous quittez le classement, vous n\'y avez plus accès, mais vous pouvez toujours le rejoindre plus tard si vous changez d\'avis.';
$string['leaveleadeboardlockednote'] = 'Vous ne pouvez pas quitter le classement.';
$string['leaveleadeboardlockeduntilnote'] = 'Vous ne pouvez pas quitter le classement avant {$a}.';
$string['leaveleaderboard'] = 'Quitter le classement';
$string['level'] = 'Niveau';
$string['levelbadge'] = 'Badge de niveau';
$string['levelbadges'] = 'Badges de niveau';
$string['levelbadges_help'] = 'Télécharger des images pour remplacer individuellement l’apparence de niveaux.

Les fichiers doivent être appelés [niveau].[extension de fichier], soit 1.png, 2.jpg, etc.

Nous recommandons des images d’une taille de 100x100 pixels, dans un de ces types : GIF, JPEG, PNG et SVG.';
$string['levelbadgesformhelp'] = 'Nommez les fichiers [niveau].[extension de fichier] par exemple 1.png, 2.jpg, etc. La taille d’image recommandée est 100 x 100.';
$string['levelcount'] = 'Nombre de niveaux';
$string['leveldesc'] = 'Description du niveau';
$string['leveldesc_help'] = 'Une courte description du niveau, qui s’affiche sur la page d’information à côté du niveau lui-même. Vous pouvez l’utiliser pour décrire une récompense pour les apprenants qui atteignent le niveau, pour inclure des instructions sur la manière de travailler pour atteindre ce niveau, pour décrire le niveau de manière ludique (par exemple, « Seules les âmes les plus courageuses sont connues pour atteindre ce niveau »), etc.';
$string['leveldescriptiondesc'] = 'Une description courte du niveau, celle-ci est présentée aux étudiants sur la page d’information.';
$string['levelname'] = 'Nom du niveau';
$string['levelname_help'] = 'Un nom court à afficher au lieu des noms par défaut _Niveau #1_, _Niveau #2_, etc. qui sont parfois affichés. Si vous donnez des noms à certains niveaux, nous vous recommandons de donner un nom à tous les niveaux !';
$string['levelpointslength'] = 'Longeur';
$string['levelpointsstart'] = 'Départ';
$string['levels'] = 'Niveaux';
$string['levelsappearance'] = 'Apparence des niveaux';
$string['levelssaved'] = 'Les niveaux ont été sauvegardés.';
$string['levelswillbereset'] = 'Attention ! Sauver ce formulaire recalculera le niveau de chaque participant !';
$string['levelup'] = 'Progressez !';
$string['levelupoptionsunavailableforlevelone'] = 'Les options liées à l’atteinte du niveau ne sont pas disponibles pour le premier niveau.';
$string['levelupplus'] = 'Progressez !';
$string['levelx'] = 'Niveau #{$a}';
$string['likenotice'] = '<strong>Aimez-vous le plugin Level Up XP ?</strong> Prenez un moment pour <a href="{$a->moodleorg}" target="_blank">l’ajouter à vos favoris</a> sur Moodle.org .';
$string['limitparticipants'] = 'Limiter les participants';
$string['limitparticipants_help'] = 'Ce réglage contrôle ce qui est affiché dans le classement. Les voisins sont les participants classés au-dessus ou en-dessous de l’utilisateur actuel. Par exemple, si vous choisissez « Afficher 2 voisins », seuls les deux participants classés directement au-dessus et en-dessous de l’utilisateur actuel seront affichés.';
$string['list'] = 'Liste';
$string['logging'] = 'Historiques';
$string['manually'] = 'Manuellement';
$string['maxactionspertime'] = 'Nombre max d’actions par intervalle de temps';
$string['maxactionspertime_help'] = 'Le nombre maximal d’actions qui seront prises en compte pour le calcul de l’expérience au cours de la période de temps donnée. Toute action ultérieure sera ignorée.';
$string['maxlevelexcl'] = 'niveau maximum !';
$string['menu'] = 'Menu';
$string['messageprovider:adminnotice'] = 'Avis de l\'administration';
$string['missing'] = 'Manquant';
$string['movecondition'] = 'Déplacer la condition';
$string['moverule'] = 'Déplacer la règle';
$string['name'] = 'Nom';
$string['namecontains'] = 'Contient « {$a} »';
$string['nameequalsto'] = 'Est égal à « {$a} »';
$string['navbardisplay'] = 'Afficher dans la barre de navigation';
$string['navbardisplay_desc'] = 'Quand ceci est activé, le niveau de l’utilisateur sera affiché dans la barre de navigation supérieure. Si le plugin est utilisé "Par cours", il n’apparaîtra que dans les cours. Veuillez noter que cette fonctionnalité dépend largement du thème et peut ne pas fonctionner correctement, ou pas du tout, avec des thèmes tiers. [En savoir plus](https://docs.levelup.plus/xp/docs/navbar-display)';
$string['navcompletionrules'] = 'Achèvement';
$string['navdrops'] = 'Drops';
$string['naveventrules'] = 'Règles d’événement';
$string['navgraderules'] = 'Règles d’évaluation';
$string['navimport'] = 'Importation';
$string['navinfos'] = 'Info';
$string['navladder'] = 'Classement';
$string['navlevels'] = 'Niveaux';
$string['navlevelssetup'] = 'Paramétrage';
$string['navlog'] = 'Historique';
$string['navpoints'] = 'Points';
$string['navpromo'] = 'XP+';
$string['navreport'] = 'Rapport';
$string['navrules'] = 'Règles';
$string['navsettings'] = 'Réglages';
$string['navvisuals'] = 'Apparence';
$string['newversioninstallednotice'] = 'Une nouvelle version a été installée ! Découvrez les nouveautés dans les [notes de version]({$a->releasenotesurl}).';
$string['nextlevelin'] = 'le niveau suivant dans';
$string['noconditionsyet'] = 'Pas de conditions pour l\'instant !';
$string['noconditionsyetintro'] = 'Commencez par ajouter une condition.';
$string['nodescription'] = 'Pas de description';
$string['noissuesidentified'] = 'Pas de problèmes identifiés';
$string['nologsrecordedyet'] = 'Aucun journal n’a été capturé jusqu’à présent.';
$string['noname'] = 'Pas de nom';
$string['noneareavailable'] = 'Aucune n\'est disponible.';
$string['notecompatibilityissues'] = 'Veuillez notez les problèmes de compatibilité identifiés ci-dessous :';
$string['notesomesettingslocked'] = 'Notez que certains paramètres ne pourront pas être modifiés si ils ont été verrouillés par un administrateur.';
$string['nothingmatchesfilter'] = 'Rien ne correspond au filtre.';
$string['notparticipating'] = 'Ne pas participer';
$string['notranked'] = 'Non classé';
$string['numberoflevels'] = 'Nombre de niveaux';
$string['occasionally'] = 'Occasionnellement';
$string['onlyparticipantscanaccessranking'] = 'Seules les personnes participant au classement peuvent y accéder.';
$string['outofsync'] = 'Incompatibilité des plugins XP';
$string['outofsyncexcessive'] = 'Hors synchronisation excessive';
$string['outofsyncexcessiveinfo'] = 'XP+ est beaucoup plus ancien que XP, ce qui peut entraîner des problèmes inattendus. À l\'avenir, XP+ se désactivera automatiquement.';
$string['outofsyncinfo'] = 'Les plugins XP ne sont pas compatibles l’un avec l’autre, ce qui peut entraîner des problèmes inattendus. À l\'avenir, XP+ se désactivera automatiquement. La version {$a->localxpversion} de Level Up XP+ (local_xp) est attendue.';
$string['pagecurrentnotvisibletoviewers'] = 'Cette page n\'est actuellement pas visible par les étudiants.';
$string['pagecurrentvisibletoviewers'] = 'Cette page est actuellement visible par les étudiants.';
$string['pagesettings'] = 'Mise en page';
$string['participant'] = 'Participant';
$string['participants'] = 'Participants';
$string['participatesinleaderboard'] = 'Participe au classement.';
$string['participatesnotinleaderboard'] = 'Ne participe pas au classement.';
$string['participatetolevelup'] = 'Participez au cours pour gagner des points d’expérience et progresser !';
$string['participating'] = 'Participer';
$string['perpagecolon'] = 'Par page :';
$string['pickaconditiontype'] = 'Choisissez un type de condition';
$string['pluginavailabilityxpdesc'] = 'Ce plugin permet aux enseignants de restreindre l’accès aux activités en fonction du niveau des étudiants.';
$string['pluginenrolxpdesc'] = 'Ce plugin permet l’inscription automatique à des cours en fonction du niveau d’un étudiant dans un autre cours.';
$string['pluginname'] = 'Level Up XP';
$string['pluginshortcodesdesc'] = 'Ce plugin permet aux formateurs de personnaliser leur matériel en incluant des éléments liés à XP (points, niveau, tableau de classement…) dans le contenu, ainsi que de masquer ou d’afficher le contenu en fonction du niveau de l’étudiant.';
$string['pluginshortcodesrequiredtousefeature'] = 'Le plugin [Shortcodes](https://docs.levelup.plus/xp/docs/getting-started/installation/recommended-plugins) doit être installé et activé pour pouvoir utiliser cette fonctionnalité.';
$string['pluginsoutofsync'] = '__Incompatibilité des plugins XP !__

Il y a des problèmes de compatibilité entre Level Up XP et Level Up XP+. À l\'avenir, Level Up XP+ se désactivera automatiquement s\'il n\'est pas compatible. Pour éviter cela, veuillez contacter l\'administrateur de votre site. [Lire la suite]({$a->url})';
$string['pluginxmaybeincompatible'] = 'La version de {$a->name} ({$a->component}) peut être incompatible avec Moodle {$a->version}.';
$string['pointsintimelinker'] = 'par';
$string['pointsperlevel'] = 'Points par niveau';
$string['pointsrequired'] = 'Points requis';
$string['pointstoaward'] = 'Points à attribuer';
$string['pointstoaward_help'] = 'Le nombre de points à attribuer lorsque la condition est remplie.';
$string['popupnotificationmessage'] = 'Message de la popup de notification';
$string['popupnotificationmessagedesc'] = 'Message optionnel à afficher dans la notification popup qui félicite l’utilisateur d’avoir atteint le niveau.';
$string['potentialmoodleincompatibility'] = 'Potentielle incompatibilité avec Moodle';
$string['previewpopupnotification'] = 'Avis de prévisualisation';
$string['privacy:metadata:log'] = 'Enregistre le journal d’événements';
$string['privacy:metadata:log:eventname'] = 'Le nom de l’événement';
$string['privacy:metadata:log:time'] = 'La date à laquelle cela a eu lieu';
$string['privacy:metadata:log:userid'] = 'L’utilisateur recevant les points';
$string['privacy:metadata:log:xp'] = 'Les points accordés à l’événement';
$string['privacy:metadata:prefintro'] = 'Enregistre si l’utilisateur a fermé l’information introductive';
$string['privacy:metadata:prefladderpagesize'] = 'La taille de page préférée de l’utilisateur lors de la consultation du classement.';
$string['privacy:metadata:preflevelup'] = 'Enregistre si l’utilisateur doit voir la notification de niveau';
$string['privacy:metadata:prefnotices'] = 'Enregistre si l’utilisateur a fermé l’information d’assistance';
$string['privacy:metadata:prefseenpromo'] = 'Enregistre si l’utilisateur a vu la page de promo';
$string['privacy:metadata:xp'] = 'Enregistre les points et niveau des utilisateurs';
$string['privacy:metadata:xp:lvl'] = 'Le niveau de l’utilisateur';
$string['privacy:metadata:xp:userid'] = 'L’utilisateur';
$string['privacy:metadata:xp:xp'] = 'Les points de l’utilisateur';
$string['privacy:path:addon'] = 'Extension';
$string['privacy:path:level'] = 'Niveau';
$string['privacy:path:logs'] = 'Journaux';
$string['progress'] = 'Progression';
$string['progressbar'] = 'Barre de progression';
$string['promocheatguard'] = 'Cette protection anti-triche n’est pas viable à long terme. Veuillez envisager de le mettre à niveau en « Progressez ! Plus » pour débloquer des solutions plus viables et d’autres fonctionnalités. <a href="{$a->url}">Plus d’information ici</a>.';
$string['promocontactintro'] = 'Contactez-nous pour plus d’informations. On ne mord pas et on répond rapidement !';
$string['promocontactus'] = 'Entrez en contact';
$string['promoemailusat'] = 'Écrivez-nous à levelup@branchup.tech.';
$string['promoerrorsendingemail'] = 'Oups ! Nous n’avons pas pu envoyer le message… Veuillez nous écrire directement à l’adresse {$a}. Merci !';
$string['promogetnow'] = 'Obtenez XP+ maintenant !';
$string['promoifpreferemailusat'] = 'Psst ! Si vous préférez, écrivez-nous directement à l’adresse {$a}.';
$string['promointro'] = 'Devenez le maître du jeu ! Débloquez des fonctionnalités supplémentaires et portez la gamification à un tout nouveau niveau avec Level Up XP+ !';
$string['promointroinstalled'] = 'Le module complémentaire _Progressez !_ est installé sur votre système et toutes ses fonctions ont été activées.';
$string['promorulesdidyouknow'] = 'Saviez-vous qu’avec <em>Progressez !</em> les étudiants peuvent recevoir des points pour <em>avoir terminé des cours</em> et des <em>activités</em>, ou même recevoir des points en fonction de leurs <em>notes </em> ? <a href="{$a->url}">En savoir plus ici</a>.';
$string['promoyourmessagewassent'] = 'Merci ! Votre message a été envoyé. Nous vous recontacterons bientôt.';
$string['property:action'] = 'Action de l’événement';
$string['property:component'] = 'Composant de l’événement';
$string['property:crud'] = 'Event CRUD';
$string['property:eventname'] = 'Nom de l’événement';
$string['property:target'] = 'Cible de l’événement';
$string['provisionstates'] = 'Approvisionnement automatique des utilisateurs';
$string['provisionstates_desc'] = 'Par défaut, les utilisateurs n\'apparaissent dans le classement (et dans le rapport en mode sitewide) qu\'après avoir été détectés par XP. Le provisionnement des utilisateurs est une fonction avancée qui crée automatiquement des entrées pour les utilisateurs manquants, vaguement identifiés par leur rôle. Cette opération est effectuée périodiquement via une tâche planifiée qui s\'exécute quotidiennement par défaut. [Mode d\'apprentissage] (https://docs.levelup.plus/xp/docs/automatic-user-provisioning)';
$string['questpromonotice'] = 'Faites passer la gamification au niveau supérieur en découvrant [Level Up Quest]({$a->questurl}).';
$string['questreleasenotice'] = 'Faites passer la gamification au niveau supérieur, découvrez **Level Up Quest** 🥳. Transformez vos cours en **aventures passionnantes**, remplies de **stratégies de réengagement** et de **célébrations** 🤯! Consultez [le site web de Quest]({$a->questurl}) et notre [article de lancement ici]({$a->questblogurl}). 👈';
$string['quickeditpoints'] = 'Edition rapide des points';
$string['rank'] = 'Rang';
$string['ranked'] = 'Classé';
$string['ranking'] = 'Classement';
$string['ranking_help'] = 'Le rang est la position réelle de l’utilisateur actuel dans le classement. Le rang relatif est la différence en points d’expérience entre un utilisateur et ses voisins.';
$string['reallydeleteuserstate'] = 'La suppression d’un utilisateur n’est utile que pour le retirer du classement. Pour toute autre raison, nous vous recommandons de mettre ses points à 0. Notez que la suppression d’un utilisateur n’affecte pas sa capacité à gagner des points à l’avenir.

Il est important de noter que si vous utilisez _Progressez !_ pour l’ensemble du site, le fait de les supprimer les fera disparaître du rapport, auquel cas vous ne pourrez pas leur réattribuer de points. Cependant, si vous utilisez _Progressez !_ par cours, l’étudiant peut toujours apparaître dans le rapport s’il est inscrit au cours.

Voulez-vous vraiment supprimer les points de cet utilisateur ?';
$string['reallydeleteuserstateandlogs'] = 'La suppression d’un utilisateur le retire du classement et supprime tous les journaux qui lui sont associés.

La suppression des journaux peut permettre à un utilisateur de regagner des points pour des actions antérieures. Si votre intention est uniquement de réinitialiser ses points, nous vous recommandons de mettre ses points à 0. Notez que la suppression d’un utilisateur n’affecte pas sa capacité à gagner des points à l’avenir.

Il est important de noter que si vous utilisez _Progressez !_ pour l’ensemble du site, la suppression d’un utilisateur le fera disparaître du rapport, auquel cas vous ne pourrez pas lui réattribuer de points. Cependant, si vous utilisez _Progressez !_ par cours, l’étudiant peut toujours apparaître dans le rapport s’il est inscrit au cours.

Voulez-vous vraiment supprimer les points et les journaux de cet utilisateur ?';
$string['reallyresetallcourselevelstodefaults'] = 'Voulez-vous vraiment rétablir les niveaux par défaut dans TOUS les cours ? Cette action est irréversible.';
$string['reallyresetallcoursessettingstodefaults'] = 'Voulez-vous vraiment réinitialiser TOUS les cours aux paramètres par défaut ? Cette action est irréversible.';
$string['reallyresetallcoursestodefaults'] = 'Voulez-vous vraiment rétablir les règles par défaut dans TOUS les cours ? Cette action est irréversible.';
$string['reallyresetallcoursevisualstodefaults'] = 'Voulez-vous vraiment rétablir les règles par défaut dans TOUS les cours ? Cette action est irréversible.';
$string['reallyresetcourselevelstodefaults'] = 'Voulez-vous vraiment réinitialiser les niveaux du cours aux niveaux par défaut ? Cette action est irréversible.';
$string['reallyresetcourserulestodefaults'] = 'Voulez-vous vraiment réinitialiser les règles du cours et rétablir les règles par défaut ? Cette action est irréversible.';
$string['reallyresetcoursevisualstodefaults'] = 'Voulez-vous vraiment réinitialiser l’apparence des niveaux de cours à l’apparence par défaut ? Cette action est irréversible.';
$string['reallyresetdata'] = 'Voulez-vous vraiment remettre à zéro les niveaux et les points de chacun dans ce cours ? Cette action est irréversible.';
$string['reallyresetgroupdata'] = 'Voulez-vous vraiment remettre à zéro les niveaux et points d’expérience de tout le monde dans ce groupe ?';
$string['reallyreverttopluginsdefaults'] = 'Voulez-vous vraiment rétablir les règles par défaut suggérées par le plugin ? Cette action est irréversible.';
$string['recentrewards'] = 'Récompenses récentes';
$string['recommended'] = 'Recommandé';
$string['recommendedplugins'] = 'Plugins recommandés';
$string['releasenotes'] = 'Notes de mise à jour';
$string['remaining'] = 'restant';
$string['removefilter'] = 'Enlever le filtre';
$string['reportisempty'] = 'Le rapport est vide, les étudiants n’ont pas encore gagné de points.';
$string['reportisemptyenrolstudents'] = 'Le rapport est vide, est-ce que les étudiants ont été inscrits au cours ?';
$string['requires'] = 'Requiert';
$string['resetallcoursessettingstodefaults'] = 'Suivez ce lien pour [réinitialiser tous les cours aux paramètres par défaut]({$a->url}). Si vous avez apporté des modifications, vous devez les enregistrer au préalable. Notez que cette opération remplacera les paramètres de tous les cours et qu\'elle est irréversible. Cela n\'affecte pas les niveaux, l\'apparence et les règles par défaut. Pour les réinitialiser, veuillez consulter les pages d\'administration correspondantes.';
$string['resetallcoursestodefaults'] = 'Rétablir tous les cours aux paramètres par défaut.';
$string['resetallcoursestodefaultsintro'] = 'Cliquez le bouton ci-dessous pour rétablir tous les cours aux paramètres par défaut ci-dessus.';
$string['resetcoursedata'] = 'Réinitialiser les données du cours';
$string['resetcourserulestodefaults'] = 'Rétablir le cours aux règles par défaut.';
$string['resetcourses'] = 'Réinitialiser les cours';
$string['resetgroupdata'] = 'Remettre à zéro les données du groupe';
$string['resetladderparticiptionofeveryone'] = 'Réinitialiser le statut de participation de tout le monde';
$string['resetlevelstodefaults'] = 'Réinitialiser les niveaux aux valeurs par défaut';
$string['resettodefaults'] = 'Réinitialisation aux valeurs par défaut';
$string['resetvisualstodefaults'] = 'Réinitialiser l’apparence aux valeurs par défaut';
$string['resultsfilteredforn'] = 'Résultats filtrés pour {$a}.';
$string['reverttopluginsdefaults'] = 'Revenir aux réglages par défaut du plugin';
$string['reverttopluginsdefaultsintro'] = 'Utilisez le bouton ci-dessous si vous souhaitez rétablir les valeurs par défaut ci-dessus par rapport aux valeurs par défaut du plugin. Cela n’affecte pas les règles des cours existants.';
$string['reward'] = 'Récompense';
$string['rule'] = 'Règle';
$string['rule:contains'] = 'contient';
$string['rule:eq'] = 'est égal à';
$string['rule:eqs'] = 'est strictement égal à';
$string['rule:gt'] = 'est supérieur à';
$string['rule:gte'] = 'est supérieur ou égal à';
$string['rule:lt'] = 'est inférieur à';
$string['rule:lte'] = 'est inférieur ou égal à';
$string['rule:regex'] = 'correspond à l’expression rationnelle';
$string['ruleadded'] = 'La condition a été ajoutée.';
$string['rulecm'] = 'Activité ou ressource';
$string['rulecm_help'] = 'Cette condition est remplie quand l’événement se produit dans l’activité ou la ressourc indiquée.';
$string['rulecmdesc'] = 'L’activité ou ressource est « {$a->contextname} ».';
$string['rulecmdescwithcourse'] = 'L’activité ou ressource est : « {$a->contextname} » dans « {$a->coursename} ».';
$string['rulecminfo'] = 'Cette condition requiert que l’action se produise dans une activité our ressource spécifique.';
$string['ruleevent'] = 'Événement précis';
$string['ruleeventdesc'] = 'L’événement est « {$a->eventname} »';
$string['ruleeventinfo'] = 'Choisissez l’action que les utilisateurs doivent effectuer à partir d’une liste d’événements préparée.';
$string['rulefilterany'] = 'Tous';
$string['rulefilteranycm'] = 'Toute activité';
$string['rulefilteranycmdesc'] = 'Cette condition s\'applique à toutes les activités.';
$string['rulefilteranycourse'] = 'Tout cours';
$string['rulefilteranycoursedesc'] = 'Cette condition correspondra à n’importe quel cours.';
$string['rulefilteranydesc'] = 'Cette condition correspond à tout.';
$string['rulefilteranysection'] = 'Toute section';
$string['rulefilteranysectiondesc'] = 'Cette condition correspondra à n’importe quelle section.';
$string['rulefiltercm'] = 'Activité spécifique';
$string['rulefiltercmdesc'] = 'Cibler une activité ou une ressource spécifique dans le cours.';
$string['rulefiltercmname'] = 'Nom de l\'activité';
$string['rulefiltercmnamedesc'] = 'Condition basée sur le nom de l\'activité.';
$string['rulefilternone'] = 'Rien';
$string['rulefiltersection'] = 'Section spécifique';
$string['rulefiltersectiondesc'] = 'Cibler une section spécifique du cours.';
$string['rulefilterthiscourse'] = 'Ce cours';
$string['rulefilterthiscoursedesc'] = 'Cibler le cours actuel.';
$string['ruleproperty'] = 'Propriété de l’événement';
$string['rulepropertydesc'] = 'La propriété « {$a->property} » {$a->compare} « {$a->value} ».';
$string['rulepropertyinfo'] = 'Cette condition est pour les utilisateurs avancés avec une connaissance technique des événements et de leurs propriétés.';
$string['ruleset'] = 'Groupe de conditions';
$string['ruleset:all'] = 'TOUTES les conditions sont vraies';
$string['ruleset:any'] = 'UNE des conditions est vraie';
$string['ruleset:none'] = 'AUCUNE des conditions n’est vraie';
$string['rulesetinfo'] = 'Combinez plusieurs conditions en une seule.';
$string['rulesformhelp'] = '<p>Ce plugin utilise les événements pour attribuer des points d’expérience aux étudiants selon les actions effectuées. Vous pouvez utiliser le formulaire ci-dessous pour ajouter vos propres règles et voir celles par défaut.</p>
<p>Il est conseillé de vérifier <a href="{$a->log}">l’historique</a> du plugin pour identifier les événements qui sont déclenchés lorsque vous effectuez des actions dans le cours, et aussi pour en savoir plus sur les événements eux-mêmes : <a href="{$a->list}">liste de tous les événements</a>, <a href="{$a->doc}">documentation développeur</a>.</p>
<p>Enfin, veuillez noter que le plugin ignore toujours :
<ul>
    <li>Les actions effectuées par les administrateurs, invités ou non connectés.</li>
    <li>Les actions réalisées par des utilisateurs n’ayant pas la permission <em>block/xp:earnxp</em>.</li>
    <li>Les actions répétées dans un court intervalle de temps, pour éviter la tricherie.</li>
    <li>Les événements considéré comme <em>Anonyme</em>, ex : dans un Feedback anonyme.</li>
    <li>Et les événements de niveau d’éducation différent de <em>Participation.</em></li>
</ul>
</p>';
$string['rulesscope'] = 'Champ d\'application';
$string['rulesscope_help'] = 'Le champ d\'application des règles détermine quand elles s\'appliquent.

Les règles peuvent être créées dans deux domaines : à l\'échelle du site et à l\'échelle d\'un cours. Dans la mesure du possible, les règles spécifiques à un cours sont évaluées en premier, suivies des règles applicables à l\'ensemble du site. Cette approche permet aux éducateurs de créer des règles générales applicables à l\'ensemble du site (à l\'échelle du site), puis de les adapter à chaque cours.

- Sur l\'ensemble du site : Ces règles s\'appliquent à l\'ensemble du site, sauf lorsque des règles spécifiques à un cours sont en place.
- Cours : Ces règles ne s\'appliquent qu\'à un cours spécifique. Elles ont la priorité sur les règles applicables à l\'ensemble du site.';
$string['ruletypecmcompletion'] = 'Achèvement de l\'activité';
$string['ruletypecmcompletiondesc'] = 'Attribuer des points lorsqu\'une activité est marquée comme terminée.';
$string['ruletypecoursecompletion'] = 'Achèvement du cours';
$string['ruletypecoursecompletiondesc'] = 'Attribuer des points lorsqu\'un cours est considéré comme terminé.';
$string['ruletypesectioncompletion'] = 'Achèvement de la section';
$string['ruletypesectioncompletiondesc'] = 'Attribuer des points lorsqu\'une section de cours est marquée comme complète.';
$string['searchandselectcourse'] = 'Cherchez et sélectionnez un cours';
$string['searchandselectmodule'] = 'Rechercher et sélectionner une activité ou une ressource';
$string['selectcourse'] = 'Sélectionner un cours';
$string['send'] = 'Envoyer';
$string['setpoints'] = 'Définir les points';
$string['settingsoutdatedxppnotice'] = 'Si vous voyez les paramètres ci-dessous, cela signifie qu\'une version obsolète de XP+ est installée. Veuillez demander à votre administrateur de résoudre le problème en installant les versions les plus récentes.';
$string['shortcode:xpbadge'] = 'Le badge correspondant au niveau actuel de l’utilisateur.';
$string['shortcode:xpiflevel'] = 'Afficher le contenu correspondant au niveau actuel de l’utilisateur.';
$string['shortcode:xpiflevel_help'] = 'Voici quelques exemples pour formatter ce code. Quand un niveau est strictement spécifié, le contenu sera affiché sans prendre compte des autres règles.
Les règles _greater_ et _less than_ doivent toutes être respectées pour que le contenu s’affiche. Faites attention, le contenu pourrait donc ne jamais s’afficher !
Remarque : les enseignants et plus globalement les utilisateurs avec les droits d’édition, verront toujours tout.
```
[xpiflevel 1 3 5]
    Affiché si le niveau de l’utilisateur est exactement égal à 1, 3 or 5.
[/xpiflevel]

[xpiflevel >3]
    Affiché si le niveau de l’utilisateur est supérieur à 3.
[/xpiflevel]

[xpiflevel >=3]
    Affiché si le niveau de l’utilisateur est supérieur ou égal à 3.
[/xpiflevel]

[xpiflevel >=10 <20 30]
    Affiché si le niveau de l’utilisateur est supérieur ou égal à 10 ET est strictement inférieur à 20
    OU est exactement égal à 30.
[/xpiflevel]

[xpiflevel <=10 >=20]
    Jamais affiché car le niveau de l’utilisateur ne peut pas être inférieur ou égal à 10 ET supérieur à 20.
[/xpiflevel]
```

Remarque : ces codes ne peuvent PAS être imbriqués les uns dans les autres.';
$string['shortcode:xpladder'] = 'Affiche une partie du classement.';
$string['shortcode:xpladder_help'] = 'Par défaut, une partie du classement autour du rang de l’utilisateur est affiché.

```
[xpladder]
```

Pour afficher le top 10 des étudiants à la place, mettez comme paramètre `top`. Vous pouvez aussi définir un nombre à afficher comme : `top=20`.

```
[xpladder top]
[xpladder top=15]
```

Un lien vers le classement total est automatiquement disponible en dessous du tableau. Si vous ne voulez pas l’afficher, ajouter le paramètre `hidelink`.

```
[xpladder hidelink]
```

Par défaut, le tableau n’inclut pas la colonne des progression avec les barres de progression. Si cette colonne a été sélectionnée dans les paramètres du classement, vous pouvez utiliser le paramètre `withprogress` pour l’afficher.

```
[xpladder withprogress]
```

Remarque : si votre cours utilise les groupes, le classement va s’afficher en fonction des groupes.';
$string['shortcode:xplevelname'] = 'Affiche le nom du niveau.';
$string['shortcode:xplevelname_help'] = 'Par défaut, la balise affiche le nom du niveau de l’utilisateur.
Sinon, vous pouvez utiliser le paramètre `level` pour afficher le nom spécifique d’un niveau.

```
[xplevelname]
[xplevelname level=5]
```

Si le paramètre `level` est défini, mais que le niveau n’existe pas, rien ne s’affichera.';
$string['shortcode:xppoints'] = 'Affiche un nombre de points formatés en points d’expérience.';
$string['shortcode:xppoints_help'] = 'Par défaut, cela affiche le nombre de points de l’utilisateur actuel. Alternativement, vous pouvez spécifier un nombre pour écraser cette valeur.

Le style des points dépendra de si une valeur arbitraire est affichée ou des points de l’utilisateur actuel. L’argument `plain` peut être utilisé pour supprimer tout style.

```
[xppoints]
[xppoints 500]
[xppoints 123 plain]
```';
$string['shortcode:xpprogressbar'] = 'La barre de progression de l’utilisateur actuel vers le prochain niveau.';
$string['shortcodeinactiveleaderboarddisabled'] = 'Le classement est actuellement désactivé, le code court sera inactif. Vous pouvez activer le classement dans ses paramètres.';
$string['shortcodexpladderembedintro'] = 'Grâce au code court suivant, le classement peut être intégré n\'importe où sur ce site. Vous trouverez plus d\'options et d\'informations dans la [documentation](https://docs.levelup.plus/xp/docs/how-to/use-shortcodes).';
$string['shortcodexpteamladderembedintro'] = 'Grâce au code court suivant, le classement peut être intégré n\'importe où sur ce site. Vous trouverez plus d\'options et d\'informations dans la [documentation](https://docs.levelup.plus/xp/docs/how-to/use-shortcodes).';
$string['sitewide'] = 'Sur tout le site';
$string['somefeaturesrequireotherplugins'] = 'Certaines fonctionnalités nécessitent l’installation de plugins supplémentaires.';
$string['someoneelse'] = 'Quelqu’un d’autre';
$string['somethinghappened'] = 'Quelque chose est arrivé';
$string['taskadminnotices'] = 'Avis de l\'administration';
$string['taskcollectionloggerpurge'] = 'Supprimer les journaux de collection';
$string['taskusagereport'] = 'Rapport d’utilisation';
$string['teamleaderboard'] = 'Classement par équipe';
$string['teamleaderboard_help'] = 'Le tableau de classement des équipes montre un classement des équipes basé sur le total des points cumulés de leurs membres.

Les équipes peuvent être composées de groupes de cours ou de cohortes. Des options sont également disponibles pour s\'adapter à différentes tailles d\'équipes.

[En savoir plus] (https://docs.levelup.plus/xp/docs/how-to/setup-team-leaderboard/team-leaderboard?ref=blockxp_help)';
$string['teamleaderboardintro'] = 'Le tableau de bord des équipes est un classement des équipes basé sur les points de leurs membres.';
$string['teams'] = 'Les équipes';
$string['thankyou'] = 'Merci !';
$string['timebetweensameactions'] = 'Temps requis entre deux actions identiques';
$string['timebetweensameactions_help'] = 'Le temps minimum requis avant qu’une action qui s’est déjà produite précédemment soit à nouveau acceptée. Une action est considérée comme identique si elle a été placée dans le même contexte et objet, la lecture d’un message de forum sera considérée comme identique si le même message est lu à nouveau. Lorsque cette valeur est vide, ou égale à zéro, elle ne s’applique pas.';
$string['timeformaxactions'] = 'Temps max pour un nombre max d’actions';
$string['timeformaxactions_help'] = 'Le laps de temps (en secondes) pendant lequel l’utilisateur ne doit pas excéder un nombre maximal d’actions.';
$string['tinytimedays'] = '{$a} j';
$string['tinytimehours'] = '{$a} h';
$string['tinytimeminutes'] = '{$a} m';
$string['tinytimenow'] = 'mnt';
$string['tinytimeolderyearformat'] = '%b %Y';
$string['tinytimeseconds'] = '{$a} s';
$string['tinytimeweeks'] = '{$a} sem.';
$string['tinytimewithinayearformat'] = '%e %b';
$string['total'] = 'Total';
$string['tryme'] = 'Essayez-moi';
$string['unavailable'] = 'Indisponible';
$string['unknownactivitya'] = 'Activité inconnue ({$a})';
$string['unknownbadgea'] = 'Badge inconnu ({$a})';
$string['unknownconditiona'] = 'Condition inconnue ({$a})';
$string['unknowneventa'] = 'Événement inconnu ({$a})';
$string['unknownsectiona'] = 'Section inconnue ({$a})';
$string['unknowntypea'] = 'Type inconnu ({$a})';
$string['unlockfeaturewithxpplus'] = 'Débloquez cette fonctionnalité avec XP+. <a href="{$a}">En savoir plus</a>';
$string['unstableversioninstalled'] = 'Version instable installée';
$string['unstableversioninstalledinfo'] = 'Cette version de Level Up XP (block_xp) est encore en développement et considérée comme instable, veuillez utiliser une version officielle.';
$string['updateandpreview'] = 'Mise à jour et aperçu';
$string['upgradingplugins'] = 'Mettre à jour les plugins';
$string['urlaccessdeprecated'] = 'L’accès via ce lien est déconseillé, veuillez mettre à jour vos liens.';
$string['usagereport'] = 'Partager le rapport d’utilisation';
$string['usagereport_desc'] = 'Partager périodiquement des informations d’utilisation anonymes avec les développeurs du plugin. Ces informations permettront de mieux comprendre comment le plugin est utilisé et influenceront son développement. Les informations partagées contiennent des informations de base sur le site Moodle (URL, version), et des informations sur l’utilisation du plugin (nombre d’utilisateurs gagnant des points, aperçu des paramètres, règles utilisées…).';
$string['usealgo'] = 'Utiliser l’algorithme';
$string['usecustomlevelbadges'] = 'Utiliser les badges de niveau personnalisés';
$string['usecustomlevelbadges_help'] = 'Lorsque cette option est sur \'Oui\', vous devez fournir une image pour chaque niveau.';
$string['userladderparticipation'] = 'Participation au classement';
$string['userladderparticipation_help'] = 'Détermine si l\'utilisateur participe actuellement au classement. Cela n\'affecte pas le classement des équipes.';
$string['userladderparticipationlocked'] = 'Verrouiller la participation jusqu\'à ce que';
$string['userladderparticipationlocked_help'] = 'Date à partir de laquelle l\'utilisateur est libre de modifier ses préférences en matière de participation.';
$string['usingalgo'] = 'Avec l’algorithme';
$string['value'] = 'Valeur';
$string['valuessaved'] = 'Les valeurs ont été enregistrées avec succès';
$string['viewas'] = 'Voir en';
$string['viewlogs'] = 'Voir les logs';
$string['viewtheladder'] = 'Voir l’échelle';
$string['visualsintro'] = 'Personnalisez l’apparence des niveaux, et la signification des points.';
$string['wewillreplyat'] = 'Nous vous répondrons à : _{$a}_.';
$string['when'] = 'Quand';
$string['wherearexpused'] = 'Où les points d’expériences sont-ils utilisés ?';
$string['wherearexpused_desc'] = 'Quand « Dans les cours » est sélectionné, les points d’expérience sont seulement acquis dans les cours où le bloc a été ajouté. Quand « Pour tout le site » est sélectionné, un utilisateur augmentera de niveau dans le site plutôt que par cours, toute l’expérience reçue à travers le site sera utilisée.';
$string['whoops'] = 'Oups !';
$string['xp'] = 'Points d’expérience';
$string['xp:addinstance'] = 'Ajouter un nouveau bloc';
$string['xp:earnxp'] = 'Gagner des points';
$string['xp:manage'] = 'Gérer tous les aspects des points d’expérience';
$string['xp:myaddinstance'] = 'Ajouter le bloc à mon tableau de bord';
$string['xp:view'] = 'Voir le bloc et ses pages relatives';
$string['xp:viewlogs'] = 'Voir le journal';
$string['xp:viewreport'] = 'Visualiser le rapport';
$string['xpgaindisabled'] = 'Gain de points désactivé';
$string['xpplusrequired'] = 'XP+ requis';
$string['xprequired'] = 'Expérience requise';
$string['xptogo'] = '[[{$a}]] restant';
$string['youleveledupexcl'] = 'Vous avez progressé !';
$string['youreachedlevel'] = 'Vous avez atteint le niveau :';
$string['youreachedlevela'] = 'Vous avez atteint le niveau {$a} !';
$string['yourmessage'] = 'Votre message';
$string['yourownrules'] = 'Vos propres règles';
