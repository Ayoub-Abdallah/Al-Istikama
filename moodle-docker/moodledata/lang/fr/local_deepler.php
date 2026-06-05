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
 * Strings for component 'local_deepler', language 'fr', version '5.1'.
 *
 * @package     local_deepler
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['apikeytitle'] = 'Clé de l’API pour DeepL Translate';
$string['apikeytitle_desc'] = 'Copier votre clé API de DeepL pour utiliser la traduction automatique.';
$string['badsettings'] = 'La configuration de DeepL semble être incomplète, il manque probablement la clef API.
Vérifier auprès de votre administrateur Moodle.';
$string['canttranslate'] = 'Impossible de traduire « {$a} » en « {$a} ». Sélectionner une autre langue cible.';
$string['canttranslatesame'] = 'Les deux langues sont identiques :';
$string['contextdeepl'] = 'Contexte du cours';
$string['contextdeepl_placeholder'] = 'Indiquer le contexte au traducteur (DeepL) afin de l’aider à traduire de manière plus contextuelle (expérimental).';
$string['deeplapidoc'] = 'voir les détails dans la documentation de DeepL';
$string['deeplapidoctitle'] = 'Réglages de l’API DeepL';
$string['deeplapiexception'] = 'L’API de DeepL a renvoyé une erreur.';
$string['deepler:edittranslations'] = 'Modifier les traductions des cours avec Deepl Translator';
$string['deeplprotitle'] = 'Utiliser DeepL Pro ?';
$string['deeplprotitle_desc'] = 'Si l’option est activée, utiliser DeepL Pro, sinon la version gratuite de DeepL API.';
$string['doselecttarget'] = 'Sélectionner une langue cible.';
$string['editbutton'] = 'Modifier la source dans le champ d’origine.';
$string['errordbpartial'] = '{$a} champs n’ont pas pu être sauvegardés dans la base de données. Vérifier chacun dans la liste.';
$string['errordbtitle'] = 'Erreur de base de données';
$string['errortoolong'] = '(Il se peut que le texte soit trop long pour ce champ… Vérifier manuellement)';
$string['fieldmaxlengtha'] = '{$a} caractères';
$string['fieldmaxlengthb'] = '(max {$a})';
$string['filters'] = 'Filtres';
$string['formality'] = 'Formalités';
$string['formalitydefault'] = 'par défaut';
$string['formalityless'] = 'moins';
$string['formalitymore'] = 'plus';
$string['formalitypreferless'] = 'moins, de préférence';
$string['formalityprefermore'] = 'plus, de préférence';
$string['glossary:actions'] = 'Actions';
$string['glossary:deepl:link'] = 'Documentation de l’API DeepL';
$string['glossary:deeplid'] = 'UUID';
$string['glossary:delete:deeplissue:body'] = 'Le glossaire {$a} n’a pas pu être supprimé sur DeepL.';
$string['glossary:delete:deeplissue:title'] = 'Problême avec DeepL';
$string['glossary:delete:failed:body'] = 'Échec de la suppression du glossaire {$a}';
$string['glossary:delete:failed:title'] = 'Suppression échouée';
$string['glossary:delete:idmissing:body'] = 'Échec de la suppression du glossaire {$a}';
$string['glossary:delete:idmissing:title'] = 'Identifiant manquant';
$string['glossary:delete:invalidsesskey:body'] = 'Échec de la suppression du glossaire {$a}';
$string['glossary:delete:invalidsesskey:title'] = 'Clé de session non valide';
$string['glossary:delete:success:body'] = '{$a} a été supprimé !';
$string['glossary:delete:success:title'] = 'Suppression réussie';
$string['glossary:id'] = 'Identifiant du glossaire';
$string['glossary:id_placeholder'] = 'Glossaire id si vous en avez un…';
$string['glossary:lastused'] = 'Dernière utilisation';
$string['glossary:listempty'] = 'Il n’y a pas de glossaires disponibles pour cette combinaison de langues. Rendez-vous dans « Glossaires DeepLer » de vos préférences utilisateur pour en déposer.';
$string['glossary:manage:title'] = 'Glossaires DeepLer';
$string['glossary:name'] = 'Nom';
$string['glossary:nbentries'] = 'Entrées';
$string['glossary:neverused'] = 'Jamais';
$string['glossary:notselected'] = 'Aucun glossaire sélectionné';
$string['glossary:pool'] = 'Équipe';
$string['glossary:pool:admin'] = 'Propriété des administrateurs';
$string['glossary:pool:title'] = 'Glossaires de l’équipe';
$string['glossary:private:title'] = 'Glossaires privés';
$string['glossary:public:title'] = 'Glossaires publiques';
$string['glossary:select'] = 'Sélectionner un glossaire';
$string['glossary:selectplaceholder'] = 'Saisir le nom d’un glossaire';
$string['glossary:sourcelang'] = 'Source';
$string['glossary:targetlang'] = 'Cible';
$string['glossary:upload'] = 'Déposer';
$string['glossary:upload:btn'] = 'Créer un glossaire';
$string['glossary:upload:deeplissue:body'] = 'Impossible de déposer le glossaire pour la raison suivante : {$a}';
$string['glossary:upload:deeplissue:title'] = 'DeepL issue';
$string['glossary:upload:failed:body'] = 'Échec du dépôt du glossaire pour la raison suivante : {$a}';
$string['glossary:upload:failed:title'] = 'Erreur lors du dépôt';
$string['glossary:upload:file:supported'] = 'Types de fichiers pris en charge : CSV, TSV, XLSX, XLS, ODS';
$string['glossary:upload:fileerror:body'] = 'Échec du dépôt du glossaire : aucun fichier trouvé.';
$string['glossary:upload:fileerror:title'] = 'Erreur due au fichier';
$string['glossary:upload:filetypeunsupported:body'] = 'Type de fichier non pris en charge';
$string['glossary:upload:filetypeunsupported:title'] = '${a} n’est pas un format valide. Veuillez déposer un fichier CSV, TSV, XLSX, XLS ou ODS.';
$string['glossary:upload:helpmodal:col1'] = '##### FR > ES (conventions de nommage des fichiers)

**Fichier : \'litérature\\_fr-es.csv**\'

belle      , hermosa

delicieux  , exquisito

mouse      , mouse

##### ES > FR (en utilisant les en-têtes)
**Fichier : « litérature-es-fr.csv »**

ES   , FR

hermosa   , belle

exquisito , delicieux

mouse     , mouse';
$string['glossary:upload:helpmodal:col2'] = '##### Exemples de conventions de nommage des fichiers :

**Expl OK**

*   私の用語集**_en-ja.xls**
*   Tech\\_jargon**\\_FR-ES.CSV**
*   myGlossary**-**en-fr.csv (ok uniquement s\'il comporte une ligne d\'en-tête EN FR)

**Expl NOT OK (lorsque les en-têtes ne sont pas utilisés)**

*   myGlossary**-**en-fr.csv (ici, le programme recherchera les langues dans la ligne d\'en-tête)
*   Tech\\_jargon\\_**FRA-SPA**.ods (codes à 3 lettres, mais ne recherchera pas la ligne d\'en-tête)
*   myHistoricalGlo_fr-es.**txt** (extension non prise en charge)';
$string['glossary:upload:helpmodal:intro'] = '#### Règles

Les glossaires bidirectionnels (v3) ne sont pas encore autorisés.

Le tableur doit contenir une seule feuille avec deux colonnes et soit (1) :

- Des en-têtes de colonne avec des codes à deux lettres valides (par exemple EN et JA) en majuscules ou en minuscules.
- Un nom de fichier valide respectant les conventions ci-dessous.

##### Conventions de nommage des fichiers :

1.  Renommez le fichier GLOSSARYNAME\\_SOURCE-TARGET.EXTENSION
2.  Donnez-lui un nom significatif mais pas trop long (pour un affichage correct dans les tableaux).
3.  Pas d##### Exemples de conventions de nommage des fichiers :

**Expl OK**

*   私の用語集**_en-ja.xls**
*   Tech\\_jargon**\\_FR-ES.CSV**
*   myGlossary**-**en-fr.csv (ok uniquement s\'il comporte une ligne d\'en-tête EN FR)

**Expl NOT OK (lorsque les en-têtes ne sont pas utilisés)**

*   myGlossary**-**en-fr.csv (ici, le programme recherchera les langues dans la ligne d\'en-tête)
*   Tech\\_jargon\\_**FRA-SPA**.ods (codes à 3 lettres, mais ne recherchera pas la ligne d\'en-tête)
*   myHistoricalGlo_fr-es.**txt** (extension non prise en charge)en-tête dans le fichier csv.
4.  SOURCE et TARGET dans le nom du fichier doivent être des codes de langue à 2 caractères.

(1)_Le nom du fichier a priorité sur les en-têtes.
Si vous souhaitez utiliser les en-têtes mais ajouter les paires de langues dans le nom du fichier,
 assurez-vous que le nom ne comporte pas de suffixe tel que \\_SOURCE-TARGET, et évitez d\'utiliser un « \\_ » suivi d\'un « - ».
Utilisez par exemple GLOSSARYNAME-SOURCE-TARGET.EXTENSION.';
$string['glossary:upload:helpmodal:title'] = 'Déposer un simple tableur Source|Cible à 2 colonnes.';
$string['glossary:upload:invalidsesskey:body'] = 'Échec du dépôt du glossaire pour la raison suivante : {$a}';
$string['glossary:upload:invalidsesskey:title'] = 'Clé de session non valide';
$string['glossary:upload:langpair:notresolved:body'] = 'Ni dans le titre du fichier, ni dans les en-têtes.';
$string['glossary:upload:langpair:notresolved:title'] = 'Impossible de déterminer la paire source-cible de langues';
$string['glossary:upload:sourcenotsupported:body'] = '{$a} nest pas une langue source prise en charge.';
$string['glossary:upload:sourcenotsupported:title'] = 'DeepL ne prend pas en charge cette langue source.';
$string['glossary:upload:success:body'] = '{$a} a été déposer !';
$string['glossary:upload:success:title'] = 'Dépôt réussi';
$string['glossary:upload:suffixerror:body'] = 'Échec du dépôt du glossaire pour la raison suivante : {$a}, veuillez vérifier les instructions.';
$string['glossary:upload:suffixerror:title'] = 'Suffixe incorrect';
$string['glossary:upload:targetnotsupported:body'] = '{$a} n’est pas une langue cible prise en charge.';
$string['glossary:upload:targetnotsupported:title'] = 'DeepL ne prend pas en charge cette langue cible.';
$string['glossary:upload:unknownerror:body'] = 'Échec du dépôt du glossaire pour la raison suivante : {$a}, veuillez vérifier les instructions.';
$string['glossary:upload:unknownerror:title'] = 'Incorrect suffix';
$string['glossary:visibility'] = 'Visibilité';
$string['glossary:visibility:pool'] = 'Équipe';
$string['glossary:visibility:private'] = 'Privé';
$string['glossary:visibility:public'] = 'Public';
$string['hideiframes'] = 'Afficher les iframes intégrées dans le texte source.';
$string['hideiframesadmin'] = 'Sélectionner cette option si vous souhaitez que le rendu des iframes intégrées soit l’option par défaut.';
$string['hideiframesadmin_desc'] = 'Parfois, les iframes peuvent chevaucher l’interface utilisateur ou altérer les performances du navigateur.';
$string['ignoretags'] = 'Tags à ignorer';
$string['keepselected'] = 'Conserver la sélection';
$string['latexeascape'] = 'Ignorer LaTeX (ne pas envoyer, à traduire, les formules $$LaTeXFormulas$$)';
$string['latexescapeadmin'] = 'Réglage par défaut de « Ignorer LaTeX » (« Réglages avancés » de l’interface traducteur)';
$string['latexescapeadmin_desc'] = 'Si cette option est activée, le plugin définira « échapper les formules LaTeX » sur « vrai » dans le formulaire de traduction du cours (paramètres avancés).
La désactiver ici si votre organisation utilise rarement des formules LaTeX dans les cours afin d’améliorer légèrement les performances de Deepler.';
$string['missingmainapikey'] = 'Ajoutez d’abord une clé API générique pour utiliser cette fonctionnalité.';
$string['modeltpreferqualityoptimized'] = 'Optimiser de préférence la qualité';
$string['modeltype'] = 'Modèle';
$string['modeltypelatencyoptimized'] = 'Optimiser la latence';
$string['modeltypequalityoptimized'] = 'Optimiser la qualité';
$string['module:select:label'] = 'Choisir une activité';
$string['moduleall'] = 'TOUTES LES ACTIVITÉS';
$string['needsupdate'] = 'Mise à jour requise';
$string['neverrephrased'] = 'Ce texte n\'a jamais été amélioré.';
$string['nevertranslated'] = 'Aucune traduction en «{$a}» pour l’instant';
$string['nodeeplpapi'] = 'Impossible de se connecter à l‘API DeepL. <br/>Vérifier avec votre administrateur. Il semble qu’il y ait un problème de réseau.';
$string['nonsplittingtags'] = 'Balises non fractionnables';
$string['notsupportedsource'] = 'La langue source utilisée n’est pas prise en charge par DeepL.';
$string['onomatopoeia'] = 'Aïe !!!';
$string['othersettingstitle'] = 'Autres réglages';
$string['outlinedetection'] = 'XML détection automatique de la structure';
$string['pluginname'] = 'DeepL Translator';
$string['pluginversion'] = 'Version actuelle';
$string['preescape'] = 'Ignorer tag html PRE';
$string['preescapeadmin'] = 'Ignorer tag PRE html';
$string['preescapeadmin_desc'] = 'Si cette option est activée, le contenu &lt;pre&gt;…&lt;/pre&gt; ne sera pas envoyé à la traduction.';
$string['preserveformatting'] = 'Préserver le formatage';
$string['privacy:metadata'] = 'Le plugin Deepler n’enregistre aucune donnée personnelle.';
$string['rephraseinfos'] = 'L’amélioration du texte est en version beta et actuellement prise en charge pour les langues cibles suivantes : <strong>{$a}</strong>.';
$string['rephraseoptionsinfos'] = 'Les options de ton ou de style d’écriture ne sont prises en charge que pour <strong>de</strong>, <strong>en-GB</strong> et <strong>en-US</strong>. L’utilisation de « default » comme valeur revient à ne pas envoyer de ton ni de style d\'écriture.';
$string['rephrasetitle'] = '{$a}Rephrase settings';
$string['saveall'] = 'Enregistrer tous';
$string['saveallexplain'] = 'Enregistrer par lots, dans la base de données, toutes les traductions sélectionnées.';
$string['saveallmodalbody'] = '<div class="spinner-border text-primary" role="status"><span class="sr-only">Sauvegarde…</span>\\n</div>
<p>Patience …<br/>Lorsque tous les champs sont enregistrés dans la base de données,<br/>cette fenêtre se fermera.
<p>Si vous êtes impatient et que vous souhaitez fermer cette fenêtre,
<br/>assurez vous que tous les statuts des traductions sélectionnées sont <i class="fa fa-database" aria-hidden="true"></i></p>';
$string['saveallmodaltitle'] = 'Sauvegarde des traductions dans la base de données';
$string['scannedfieldsize'] = 'Taille minimale des champs de texte';
$string['scannedfieldsize_desc'] = 'Les petits champs de texte sont souvent limités dans la base de données. Le contenu du texte augmente assez rapidement (en plus des balises mlang) à chaque étape de la traduction.
Après la traduction, si le texte est trop grand, la base de données affichera une erreur. Régler cettte valeur en fonction des propriétés de la langue principale et du nombre de langues supportées par votre Moodle.';
$string['section:coursesettings'] = 'Paramètres du cours';
$string['section:select:label'] = 'Choisir une section';
$string['sectionall'] = 'TOUTES LES SECTIONS';
$string['seesetting'] = 'Réglages avancés';
$string['selectall'] = 'Tout';
$string['selecttargetlanguage'] = 'Langue cible <em>{mlang {$a}}</em>';
$string['showhiddenforstudents'] = 'Afficher «{$a}»';
$string['sourcelang'] = 'Langue source <em>{mlang other}</em>';
$string['specialsourcetext'] = 'Choisir une autre source que «{$a}»';
$string['splitsentences'] = 'Phrases fractionnées ?';
$string['splitsentences0'] = 'Aucun fractionnement';
$string['splitsentences1'] = 'Fractionner sur la ponctuation et sur les nouvelles lignes';
$string['splitsentencesnonewlines'] = 'Fractionner en fonction de la ponctuation uniquement, en ignorant les nouvelles lignes';
$string['splittingtags'] = 'Balises de fractionnement';
$string['statusfailed'] = 'Échec';
$string['statussaved'] = 'Sauvegardé';
$string['statussuccess'] = 'Succès';
$string['statustosave'] = 'Enregistrer';
$string['statustotranslate'] = 'Prêt à traduire';
$string['statuswait'] = 'Pas sélectionné';
$string['taghandling'] = 'Gestion des balises :';
$string['tagsplaceholder'] = 'Lister tous les tags (séparer les tags par une virgule &quot;,&quot;)';
$string['targetcompatibleexplain'] = 'Choisissez une langue cible à enregistrer dans {mlang xx}.';
$string['tokenmanager_desc'] = 'Ici, vous pouvez associer vos clés API DeepL aux attributs des utilisateurs afin de créer des pools de traducteurs. Cela peut être utile si vous avez besoin de mesurer et de contrôler la consommation de chaque clé API.';
$string['toneconfident'] = 'Ton confiant';
$string['tonediplomatic'] = 'Ton diplomatique';
$string['toneenthusiastic'] = 'Ton enthousiaste';
$string['tonefriendly'] = 'Ton amical';
$string['toneorstyle'] = 'Modifie le ton ou le style rédactionnel de vos améliorations :';
$string['tour_advancedsettings00'] = 'Cliquer ici pour voir comment vous pouvez affiner le comportement de DeepL.<br/><br/>Cliquer maintenant pour obtenir une visite guidée des fonctionnalités.';
$string['tour_advancedsettings00title'] = 'Réglages avancés de DeepL';
$string['tour_advancedsettings01formality'] = '<p>Définit si le texte traduit doit utiliser vers un langage formel ou informel.
Cette fonction ne fonctionne actuellement que pour les langues cibles <em>DE</em> (<strong>allemand</strong>), <em>FR</em> (<strong>français</strong>), <em>IT</em>
(<strong>Italien</strong>), <em>ES</em> (Espagnol), <em>NL</em> (Néerlandais), <em>PL</em> (Polonais), <em>PT-BR</em> et <em>PT-PT</em> (Portugais),
<em>JA</em> (japonais), et <em>RU</em> (russe).
En savoir plus sur la fonction plain\\/polite pour le japonais <a
href="https://support.deepl.com/hc/en-us/articles/6306700061852-About-the-plain-polite-feature-in-Japanese">ici</a>.
La définition de ce paramètre avec une langue cible qui ne prend pas en charge la formalité échouera, sauf si l’une des&nbsp ;
<em>prefer_…</em> soit utilisée. Les options possibles sont :</p>
<ul><li><em>default</em> (par défaut)</li>
<li><em>more</em> - pour une langue plus formelle</li>
<li><em>less</em> - pour une langue plus informelle</li>
<li><em>prefer more</em> - pour une langue plus formelle si disponible, sinon retour à la formalité par défaut</li>
<li><em>prefer less</em> - pour une langue plus informelle si disponible, sinon retour à la formalité par défaut</li></ul>.';
$string['tour_advancedsettings01formalitytitle'] = 'Gestion des formalités';
$string['tour_advancedsettings02split'] = '<p>Définit si le moteur de traduction doit d’abord diviser l’entrée en phrases.
Lorsque <em>splits on punctuation and on newlines</em>, le moteur divise sur la ponctuation et sur les nouvelles lignes.</p>
</p> <p>Lorsque <em>splits on punctuation only, ignoring newlines</em>, le moteur scinde sur la ponctuation uniquement, en ignorant les nouvelles lignes.</p>';
$string['tour_advancedsettings02splittitle'] = 'Gèrer la façon dont les phrases sont divisées par ligne';
$string['tour_advancedsettings03formating'] = '<p>Définit si le moteur de traduction doit respecter la mise en forme originale, même s’il doit normalement en corriger certains aspects,
</p> <p>Les aspects de la mise en forme affectés par ce paramètre comprennent :</p>
<ul><li>Ponctuation en début et en fin de phrase</li><li>Majuscules/minuscules en début de phrase</li></ul>.';
$string['tour_advancedsettings03formatingtitle'] = 'Gestion du formatage';
$string['tour_advancedsettings04glossary'] = '<p>Spécifier le glossaire à utiliser pour la traduction.</p>
</p><em>(Les glossaires doivent être téléchargés via l’API Deepl. Ceci n’est pas encore disponible avec ce plugin. Voir avec votre service informatique).</em></p>';
$string['tour_advancedsettings04glossarytitle'] = 'Glossaire';
$string['tour_advancedsettings05context'] = '<p>Ce champ <em>contexte</em> supplémentaire peut potentiellement améliorer la qualité de la traduction lorsque vous traduisez des textes sources courts et peu contextuels,
Le paramètre <em>contexte</em> est une <strong>fonctionnalité alpha</strong>.</p><p>Le paramètre <em>contexte</em> est une <strong>fonctionnalité alpha</strong>.
</p> <p>Essayez donc d’ajouter du contexte si vous pensez que les résultats de la traduction pourraient être améliorés, mais ne vous y fiez pas.</p>';
$string['tour_advancedsettings05contexttitle'] = 'Informations contextuelles qui peuvent influencer une traduction mais qui ne sont pas elles-mêmes traduites.';
$string['tour_advancedsettings06tag'] = '<p>Définit le type de balises à prendre en compte.<br/>
Par défaut, le moteur de traduction ne prend pas en compte les balises.</p>
<p>En définissant le paramètre <em>tag handling</em> sur <em>xml</em> ou <em>html</em>, l’API traitera l’entrée de balisage en extrayant le texte de la structure, en le divisant en phrases individuelles, en les traduisant et en les replaçant dans la structure de balisage correspondante.</p>';
$string['tour_advancedsettings06tagtitle'] = 'Gestion des balises';
$string['tour_advancedsettings07outline'] = '<p>La détection automatique de la structure XML ne donne pas les meilleurs résultats dans tous les fichiers XML.
Vous pouvez désactiver ce mécanisme automatique en réglant le paramètre <em>XML détection automatique de la structure</em> sur <em>unchecked</em>
et en sélectionnant les balises qui doivent être considérées comme des balises de structure. Ceci divisera les phrases en utilisant le paramètre <em>splitting tags (Fractionement des balises)</em>.</p>';
$string['tour_advancedsettings07outlinetitle'] = 'Comment est détectée la structure XML';
$string['tour_advancedsettings08skiptag'] = '<p>Liste séparée par des virgules de balises XML ou HTML indiquant que le texte ne doit pas être traduit.
</p> <p>Pour garantir que les éléments du texte original ne sont pas modifiés lors de la traduction (par exemple, les marques commerciales ou les noms de produits).
</p><p>Expl : ajouter « x » dans la liste :</p><p>Request:<em>Veuillez ouvrir la page &lt;x&gt;Settings&lt;/x&gt ; pour configurer votre système.</em></p></p>
<p>Réponse:<em>Bitte öffnen Sie die Seite &lt;x&gt;Settings&lt;/x&gt ; um Ihr System zu konfigurieren.</em></p>
<p>En HTML, vous pouvez également utiliser l’attribut <code><strong>translate=« no »</strong></code> :</p>
<p><code> &lt;body&gt;</code><br /><code> &lt;h1&gt;Mon premier titre&lt;/h1&gt;</code><br /><code> &lt;p
<strong>translate=« no »</strong>&gt;Ceci ne sera pas traduit.&lt;/p&gt;</code><br /><code> &lt;/body&gt;</code></p>';
$string['tour_advancedsettings08skiptagtitle'] = 'Ne pas traduire le contenu de certaines balises.';
$string['tour_advancedsettings09splittag'] = '<p>Liste séparée par des virgules de balises XML ou HTML qui ne divisent jamais les phrases.</p>';
$string['tour_advancedsettings09splittagtitle'] = 'Les balises qui ne doivent pas être prises en compte pour diviser les phrases.';
$string['tour_advancedsettings101other'] = '<p>Indiquer ici au plugin d’éviter de traduire les chaînes LaTeX ($$…$$) et ou les balises HTML PRE.</p>';
$string['tour_advancedsettings101othertitle'] = 'Activation de l’échappement des balises LaTeX et/ou PRE';
$string['tour_advancedsettings10splittag'] = '<p>Liste séparée par des virgules de balises XML ou HTML qui provoquent toujours des scissions.</p>';
$string['tour_advancedsettings10splittagtitle'] = 'Balises qui divisent le texte en phrases.';
$string['tour_advancedsettings11sourcelang'] = '<p>La langue source est la langue dans laquelle le cours a été écrit.
La meilleure pratique consiste à conserver la même langue tout au long du cours.</p>';
$string['tour_advancedsettings11sourcelangtitle'] = 'Langue source';
$string['tour_advancedsettings12targetlang'] = '<p>La langue cible est la langue que DeepL renverra</p><p>Biensûr l’orsque la langue source est la même que la langue cible le bouton de traduction sera désactivé.</p>';
$string['tour_advancedsettings12targetlangtitle'] = 'Langue cible';
$string['tour_advancedsettings13filters'] = '<p>Ces filtres affichent/masquent le contenu textuel trouvé dans le cours.
<p><strong>À jour :<br /></strong></p>
<p>Ce sont les contenus qui sont déjà traduits et qui n’ont pas été modifiés dans la source.</p>
<p>Ils apparaissent avec l’indicateur <span class=\'badge badge-pill badge-success\'> </span>. </p>
<p><strong>Mise à jour nécessaire:<br /></strong></p>
<p>Il s’agit des contenus textuels qui n’ont jamais été traduits ou qui ont été modifiés après avoir été traduits.</p>
<p>Ils apparaissent avec l’indicateur <span class=\'badge badge-pill badge-danger\'> </span> lorsqu’ils n’ont jamais été traduits. </p>
<p>Ils apparaissent avec l’indicateur <span class=\'badge badge-pill badge-warning\'> </span> lorsqu’ils ont déjà été traduits mais que le texte source a été modifié depuis.</p>';
$string['tour_advancedsettings13filterstitle'] = 'Filtres d’état de traduction';
$string['tour_advancedsettings14filters'] = '<p>En cliquant ici, vous sélectionnez tout le contenu visible à envoyer à la traduction.</p>';
$string['tour_advancedsettings14filterstitle'] = 'Tout séléctionner';
$string['tour_advancedsettings15filters'] = 'Statut en temps réel de la consommation planifiée et réelle du service de DeepL (pour le mois en cours).';
$string['tour_advancedsettings15filterstitle'] = 'État de la consommation de l’API DeepL';
$string['tour_advancedsettings16sendtodeepl'] = '<p>En cliquant sur ce bouton, vous envoyez tous les textes sélectionnés à Deepl et les insérez dans les éditeurs.</p> <p>Il faut au moins une sélection pour activer ce bouton.
</p>';
$string['tour_advancedsettings16sendtodeepltitle'] = 'Envoyer à DeepL';
$string['tour_advancedsettings17statusbullet'] = '<p>Il indique l’état de la traduction par un code de 3 couleurs.</p>
<p><span class="badge badge-pill badge-danger"> </span> Ce texte n’a jamais été traduit.</p>
<p><span class="badge badge-pill badge-warning"> </span> Ce texte a été traduit mais une modification a été apportée à la base de données depuis.</p>
<p><span class="badge badge-pill badge-success"> </span> Ce texte était déjà traduit et mis à jour.</p>
<p><span class="badge badge-pill badge-dark"> </span> Impossible d’obtenir l’état de la traduction car les langues <em>source</em> et <em>cible</em> sont les mêmes.</p>';
$string['tour_advancedsettings17statusbullettitle'] = 'Symbole en forme de puce de l’état de la traduction.';
$string['tour_advancedsettings18selection'] = 'Pour envoyer un contenu à Deepl pour qu’il soit traduit, vous devez cocher cette case.';
$string['tour_advancedsettings18selectiontitle'] = 'Case à cocher pour la sélection';
$string['tour_advancedsettings19editsource'] = '<p><span class="p-1 btn btn-sm btn-outline-info"><i class="fa fa-pencil"> </i>
</span>En cliquant sur le crayon, vous accédez à l’éditeur dans le cours Moodle.</p>
<p>Si vous avez des révisions de la source, ou si vous voulez faire des changements, car vous ne pouvez pas changer la source à partir d’ici.</p>';
$string['tour_advancedsettings19editsourcetitle'] = 'Modifier la source sur place.';
$string['tour_advancedsettings20togglemultilang'] = '<p>Lorsque les balises {mlang} de traduction sont présentes, ce bouton apparaît.</p>
<p><i class=\'fa fa-language\'></i></p> <p>Cliquez sur ce bouton pour faire basculer le contenu et voir ce qui a déjà été traduit.
Si la langue source actuellement sélectionnée se trouve dans les balises
{mlang}, elle est affichée en rouge pour vous avertir que la balise sera remplacée.';
$string['tour_advancedsettings20togglemultilangtitle'] = 'Changer l’état d’affichage du contenu multilang.';
$string['tour_advancedsettings21secondsource'] = 'Vous pouvez choisir une source secondaire pour un contenu spécifique. <br/>S’il n’y a pas encore de balise OTHER lang, la source sera sauvegardée dans sa langue plus OTHER.';
$string['tour_advancedsettings21secondsourcetitle'] = 'Langue source secondaire.';
$string['tour_advancedsettings22process'] = '<p>Lorsqu’un contenu textuel n’est pas sélectionné et qu’aucune traduction n’a été demandée. <i class=\'fa-ellipsis-h\'></i> s’affiche.</p>
<p><i class=\' fa fa-hourglass-start\'></i> s’affiche lorsque vous l’avez sélectionné et attend que vous appuyiez sur le bouton « Traduire » pour l’envoyer à DeepL.</p>
<br /><i class=\'fa fa-floppy-o\'></i> s’affiche après que le texte a été renvoyé dans l’éditeur de texte adjacent.
Vous pouvez revoir le contenu traduit, y apporter des modifications, puis appuyer sur l’icône pour l’enregistrer dans la base de données. <br /><br />
<em>Notez</em> que vous pouvez également enregistrer dans la base de données par lots en cliquant sur le bouton flottant « Enregistrer tout » ci-dessous. <br />
Si vous souhaitez enregistrer tous les textes traduits mais en laisser quelques-uns à revoir plus tard, vous pouvez les décocher sur la gauche afin qu’ils soient ignorés lors de l’enregistrement de tous les textes.
</p> <p>Une fois qu’un texte est sauvegardé, cette icône s’affiche <i class=\'fa-solid fa-database\'></i></p>.';
$string['tour_advancedsettings22processtitle'] = 'Indicateur du processus de traduction (tout à droite)';
$string['tour_advancedsettings23saveall'] = '<p>Lorsque des traductions sont récupérées sur DeepL, elles ne sont pas automatiquement sauvegardées dans la base de données.</p>
<p>C’est pour garantir les bases de la traduction, qu’une révision est faite avant d’être stockée et automatiquement distribuée au public.</p>
<p>Vous pouvez donc les enregistrer une par une ou en cliquant sur le bouton « Enregistrer tout ».
</p> <p>Si vous ne souhaitez pas enregistrer certaines traductions dans le lot, il vous suffit de les désélectionner avant de cliquer sur « enregistrer tout »</p>.';
$string['tour_advancedsettings23savealltitle'] = 'Enregistrer toutes les traductions dans la base de données.';
$string['translate:modal:body'] = 'Cela peut prendre un certain temps si vous avez beaucoup de contenu.';
$string['translate:modal:title'] = 'Envoit à DeepL';
$string['translatebutton'] = 'Traduire &rarr; {$a}';
$string['translateexplain'] = 'Traduire tout les rangées sélectionées vers {$a}';
$string['translationdisabled'] = 'La traduction est désactivée car ce lien est utilisé dans la base de données.';
$string['uptodate'] = 'À jour';
$string['viewsource'] = 'Vérifier le contenu multilingue.';
$string['viewsourcedisabled'] = 'Pas encore de contenu multilingue.';
$string['warningsource'] = 'Attention ! La langue source actuelle « {$a} » se trouve déjà en tant que balise multilang à côté de la balise de repli « OTHER ». Noter que les deux seront fusionnées en tant que balise multi-lang « OTHER ».';
$string['wordcountsentence'] = 'Total <span id="local_deepler__wc">0</span> words, <span id="local_deepler__wosc">0</span> caractères (<span id="local_deepler__wsc">0</span> caractères éspaces inclus) Consommation DeepL = <span id="local_deepler__used">0</span>/<span id="local_deepler__max">0</span>';
$string['writingstyleacademic'] = 'Style d\'écriture accadémique';
$string['writingstylebusiness'] = 'Style d\'écriture  « Business »';
$string['writingstylecasual'] = 'Style d\'écriture décontracté';
$string['writingstylesimple'] = 'Style d\'écriture simple';
