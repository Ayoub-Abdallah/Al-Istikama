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
 * Strings for component 'plagiarism_compilatio', language 'fr', version '5.1'.
 *
 * @package     plagiarism_compilatio
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['access_report'] = 'Accéder au rapport';
$string['account_expire_soon_title'] = 'Votre abonnement Compilatio expire bientôt';
$string['activate_compilatio'] = 'Activer le plugin Compilatio';
$string['activate_submissiondraft'] = 'Pour permettre aux étudiants d’analyser leurs brouillons, vous devez activer l’option <b>{$a}</b> dans la partie';
$string['activated'] = 'Autoriser la détection des textes suspects avec Compilatio';
$string['activities_statistics'] = 'Statistiques par activité';
$string['activity'] = 'Activité';
$string['admin_account_expire_content'] = 'Votre abonnement actuel se terminera à la fin du mois en cours. Si votre contrat n’expire pas à la fin du mois, un nouvel abonnement sera automatiquement mis en place par nos services. Lorsque cela sera fait, ce message disparaîtra. Pour plus d’informations, vous pouvez contacter notre service commercial ou notre support à l’adresse support@compilatio.net.';
$string['admin_disabled_reports'] = 'L’administrateur a désactivé l’affichage des rapports de similitudes aux étudiants.';
$string['admin_goto_helpcenter'] = 'Accéder au centre d’aide Compilatio pour voir des articles relatifs à l’administration du plugin Moodle.';
$string['admin_university_composable_label'] = 'Champ utilisé pour déterminer le composant lors de la création d’un compte utilisateur';
$string['ai_included_in_subscription'] = 'détection de textes générés par IA</li></ul>';
$string['ai_not_included_in_subscription'] = 'Votre abonnement ne comprend pas la détection des textes IA.';
$string['ai_score_not_included'] = 'non inclus dans votre abonnement';
$string['aiscore'] = 'Textes potentiellement générés par IA';
$string['aiscore_percentage'] = 'Pourcentage de textes potentiellement rédigés par IA';
$string['allow_analyses_auto'] = 'Possibilité de lancer directement les analyses';
$string['allow_analyses_auto_help'] = 'Cette option permettra aux enseignants d’activer le lancement automatique de l’analyse des documents sur une activité (c’est-à-dire immédiatement après qu’ils aient été soumis). <br>
Notez que dans ce cas :
<ul>
    <li>Le nombre d’analyses effectuées par votre établissement peut être sensiblement plus élevé. </li>
    <li>Les documents des premiers déposants ne sont pas comparés aux documents des derniers déposants. </li>
</ul>
Afin de comparer tous les documents d’une cession, il est nécessaire d’utiliser l’analyse "programmée", en choisissant une date postérieure à la date limite de dépôt.';
$string['allow_search_tab'] = 'Outil de recherche permettant d’identifier l’auteur d’un document.';
$string['allow_search_tab_help'] = 'L’outil de recherche permet de rechercher le nom et prénom d’un étudiant d’après un identifiant de document visible dans les rapports d’analyses parmi tous les documents présent sur votre plateforme.';
$string['allow_student_analyses'] = 'Possibilité d’activer l’analyse des étudiants sur les brouillons.';
$string['allow_student_analyses_help'] = 'Cette option permettra aux enseignants d’activer sur une activité l’analyse par les étudiants de leurs documents soumis en mode brouillon avec Compilatio Magister, avant la soumission finale à l’enseignant.';
$string['allow_teachers_to_show_reports'] = 'Possibilité de montrer les rapports de similitude aux étudiants';
$string['analysed_docs'] = '{$a} document(s) analysé(s)';
$string['analyses_restarted'] = '{$a} analyses correctement relancées.';
$string['analysing'] = 'Document en cours d’analyse';
$string['analysing_docs'] = '{$a} document(s) en cours d’analyse';
$string['analysis'] = 'Lancement des analyses';
$string['analysis_auto'] = 'Lancement des analyses';
$string['analysis_auto_help'] = '<p>Vous avez trois options :
    <ul>
        <li><strong>Manuel :</strong> l’analyse des documents doit être déclenchée manuellement avec le bouton "Analyser" de chaque document ou avec le bouton "Analyser tous les documents".</li>
        <li><strong>Planifié :</strong> tous les documents sont analysés à l’heure/date sélectionnée.</li>
        <li><strong>Direct :</strong> chaque document est analysé dès que l’étudiant le soumet. Les documents de l’activité ne seront pas comparés les uns aux autres.</li>
    </ul>
    Pour que tous les documents soient comparés les uns aux autres lors des analyses, attendez que tous les travaux soient soumis par les étudiants puis déclenchez les analyses.</p>';
$string['analysis_completed'] = 'Analyse terminée : {$a}% de textes suspects.';
$string['analysis_date'] = 'Date de l’analyse (analyse programmée uniquement).';
$string['analysis_help'] = '<p>Vous avez deux options :
    <ul>
        <li><strong>Manuel :</strong> l’analyse des documents doit être déclenchée manuellement avec le bouton "Analyser" de chaque document ou avec le bouton "Analyser tous les documents".</li>
        <li><strong>Planifié :</strong> tous les documents sont analysés à l’heure/date sélectionnée.</li>
    </ul>
    Pour que tous les documents soient comparés les uns aux autres lors des analyses, attendez que tous les travaux soient soumis par les étudiants puis déclenchez les analyses.</p>';
$string['analysis_started'] = '{$a} analyse(s) demandée(s).';
$string['analysistype'] = 'Lancement de l’analyse';
$string['analysistype_auto'] = 'Immédiat';
$string['analysistype_auto_help'] = 'Vous avez trois options :
<ul>
<li><strong>Manuel :</strong> L’analyse des documents doit être lancée manuellement avec le bouton "Analyser" de chaque document ou avec le bouton "Analyser tous les documents".</li>
<li><strong>Planifié :</strong> Tous les documents sont analysés à la date/heure sélectionnée.</li>
<li><strong>Direct :</strong> Chaque document est analysé dès que l’étudiant le soumet. Les documents dans l’activité ne seront pas comparés entre eux.</li>
</ul>
Pour que tous les documents soient comparés entre eux pendant les analyses, attendez que tous les travaux soient soumis par les étudiants, puis déclenchez les analyses.';
$string['analysistype_help'] = 'Vous avez deux options :
<ul>
<li><strong>Manuel :</strong> L’analyse des documents doit être déclenchée manuellement avec le bouton "Analyser" de chaque document ou avec le bouton "Analyser tous les documents".</li>
<li><strong>Planifié :</strong> Tous les documents sont analysés à la date/heure sélectionnée.</li>
</ul>
Pour que tous les documents soient comparés entre eux pendant les analyses, attendez que tous les travaux soient soumis par les étudiants, puis déclenchez les analyses.';
$string['analysistype_manual'] = 'Manuel';
$string['analysistype_prog'] = 'Programmé';
$string['analyze'] = 'Analyse';
$string['analyzing'] = 'Analyse';
$string['api_key_not_tested'] = 'La clef API n’a pas pu être vérifiée car la connexion au service Compilatio à échouée.';
$string['api_key_not_valid'] = 'Votre clé API n’est pas valide. Elle est spécifique à la plateforme utilisée. Vous pouvez en obtenir une en contactant (ent@compilatio.net).';
$string['api_key_valid'] = 'La clé API enregistrée est valide.';
$string['apiconfiguration'] = 'Configuration de l’API';
$string['apikey'] = 'Clé API';
$string['apikey_help'] = 'Code personnel fourni par Compilatio pour accéder à l’API';
$string['assign_statistics'] = 'Statistiques des devoirs';
$string['auto_diagnosis_title'] = 'Auto-diagnostic';
$string['average'] = 'Taux moyen';
$string['average_similarities'] = 'Le taux moyen de textes suspects pour cette activité est de {$a}%.';
$string['badqualityanalysis'] = 'Des incidents ont été détectés lors l’analyse du document. Il est possible que certaines sources n’aient pas été identifiées ou que le résultat soit incomplet.';
$string['btn_analysing'] = 'Analyse en cours';
$string['btn_error_analysis_failed'] = 'L’analyse a échoué';
$string['btn_error_extraction_failed'] = 'L’extraction a échoué';
$string['btn_error_not_found'] = 'Document introuvable';
$string['btn_error_sending_failed'] = 'Échec de l’envoi';
$string['btn_error_too_large'] = 'Fichier trop volumineux';
$string['btn_error_too_long'] = 'Le document est trop long.';
$string['btn_error_too_short'] = 'Le document est trop court.';
$string['btn_error_unsupported'] = 'Le fichier n’est pas pris en charge.';
$string['btn_planned'] = 'Analyse planifiée';
$string['btn_queue'] = 'Dans la file d’attente';
$string['btn_sent'] = 'Analyser';
$string['btn_unsent'] = 'Envoyer';
$string['certificate'] = 'Certificat d’analyse';
$string['compi_student_analyses'] = 'Permettre aux étudiants d’analyser leurs documents';
$string['compi_student_analyses_help'] = 'Ceci permet aux étudiants d’analyser leur fichiers en brouillon avec Compilatio Magister, avant le rendu final à l’enseignant.';
$string['compilatio'] = 'Plugin de détection de plagiat Compilatio';
$string['compilatio:enable'] = 'Autoriser l’enseignant à activer/désactiver Compilatio au sein d’une activité';
$string['compilatio:resetfile'] = 'Autoriser l’enseignant à soumettre à nouveau le fichier à Compilatio après une erreur';
$string['compilatio:triggeranalysis'] = 'Autoriser l’enseignant à déclencher manuellement l’analyse';
$string['compilatio:viewreport'] = 'Autoriser l’enseignant à consulter le rapport complet depuis Compilatio';
$string['compilatio_author'] = 'Le document {$a->idcourt} présent dans l’activité <b>{$a->modulename}</b> appartient à <b>{$a->lastname} {$a->firstname}</b>.';
$string['compilatio_depositor'] = 'Le document dans l’activité <b>{$a->modulename}</b> a été soumis par l’utilisateur Moodle <b>{$a->lastname} {$a->firstname}</b>.';
$string['compilatio_display_student_report'] = 'Permettre à l’étudiant de visualiser le rapport d’analyse';
$string['compilatio_display_student_report_help'] = 'Le rapport d’analyse d’un document présente les passages similaires avec les sources détectées et leurs pourcentages de similitudes.';
$string['compilatio_display_student_score'] = 'Rendre le pourcentage de similitudes visible par les étudiants';
$string['compilatio_display_student_score_help'] = 'Le pourcentage de similitudes indique la quantité de texte dans le document qui a été retrouvée dans d’autres documents.';
$string['compilatio_help_assign'] = 'Obtenir de l’aide sur le plugin Compilatio';
$string['compilatio_iddocument'] = 'Identifiant du document';
$string['compilatio_maintenance_content'] = 'Les services Compilatio sont en maintenance programmée.
Cette interruption devrait être de courte durée.<br>
Abonnez-vous à notre page
<a href="https://support.compilatio.net/hc/{$a}/articles/13326036778769-Compilatio-Etat-des-services" target="_blank"
style="text-decoration: none;">
<strong>État du service</strong>
</a>
pour être informé du retour à la normale de l’application.';
$string['compilatio_maintenance_title'] = 'L’application Compilatio est en maintenance';
$string['compilatio_search'] = 'Rechercher';
$string['compilatio_search_help'] = 'Vous pouvez retrouver l’auteur d’un document en récupérant l’identifiant du document dans les sources du rapport d’analyse.';
$string['compilatio_search_notfound'] = 'Aucun document n’a été trouvé pour cet identifiant parmi les documents chargés sur votre plateforme Moodle.';
$string['compilatio_search_tab'] = 'Rechercher le déposant d’un document.';
$string['compilatio_studentemail'] = 'Envoyer un courriel à l’étudiant';
$string['compilatio_studentemail_help'] = 'Ceci enverra un courriel à l’étudiant quand un fichier a été traité pour lui faire savoir que le rapport est disponible.';
$string['compilatioapi'] = 'Adresse de l’API';
$string['compilatioapi_help'] = 'Il s’agit de l’adresse de l’API Compilatio';
$string['compilatiodate'] = 'Date d’activation';
$string['compilatiodate_help'] = 'Cliquez sur "Activer" si vous voulez que cette configuration de l’API s’active automatiquement à une date voulue. Laisser la date vide si vous souhaitez l’activer tout de suite.';
$string['compilatiodefaults'] = 'Valeurs par défaut pour Compilatio.';
$string['compilatioenableplugin'] = 'Activer Compilatio pour {$a}';
$string['compilatioexplain'] = 'Pour obtenir des informations complémentaires sur ce plugin, voir : <a href="http://compilatio.net" target="_blank">compilatio.net</a>';
$string['compilatiopassword'] = 'Clé API';
$string['compilatiopassword_help'] = 'Code personnel fourni par Compilatio pour accéder à l’API';
$string['context'] = 'Contexte';
$string['cron_check'] = 'La tâche programmée get_scores du plugin a été exécutée le {$a} pour la dernière fois.';
$string['cron_check_never_called'] = 'La tâche planifiée get_scores du plugin n’a pas été exécuté depuis l’activation du plugin. Il est possible qu’il soit mal configuré.';
$string['cron_check_not_ok'] = 'La tâche planifiée get_scores du plugin n’a pas été exécuté depuis plus d’une heure.';
$string['cron_frequency'] = 'Il semblerait qu’il soit exécuté toutes les {$a} minutes.';
$string['cron_recommandation'] = 'Pour les tâches planifiées du plugin Compilatio, nous recommandons d’utiliser un délai inférieur à 15 minutes entre chaque exécution.';
$string['defaultindexing'] = 'Ajouter des documents dans la base de données documentaires.';
$string['defaultindexing_help'] = 'Oui : ajouter des documents dans la base de données documentaires. Ces documents seront utilisés comme matériel de comparaison pour les analyses futures.
    Non : les documents ne sont pas ajoutés à la base de données et ne seront pas utilisés pour les comparaisons.';
$string['defaults_desc'] = 'Les paramètres suivants sont utilisés comme valeurs par défaut dans les activités de Moodle intégrant Compilatio.';
$string['defaultupdated'] = 'Les valeurs par défaut ont été mises à jour';
$string['detailed'] = 'Rapport détaillé';
$string['detailed_error_analysis_failed'] = 'L’analyse de ces documents n’a pas fonctionné correctement. Vous pouvez réinitialiser ces documents.';
$string['detailed_error_extraction_failed'] = 'L’extraction de ces documents n’a pas fonctionné correctement. Vous pouvez réinitialiser ces documents.';
$string['detailed_error_not_found'] = 'Ces documents n’ont pas été trouvés. Veuillez contacter votre administrateur Moodle. Erreur : document introuvable pour cette clé API.';
$string['detailed_error_sending_failed'] = 'Ces documents n’ont pas pu être envoyés à Compilatio. Vous pouvez renvoyer ces documents.';
$string['detailed_error_too_large'] = 'Ces documents n’ont pas pu être analysés par Compilatio car ils sont trop volumineux (Taille maximale : {$a} Mo).';
$string['detailed_error_too_long'] = 'Ces documents n’ont pas pu être analysés par Compilatio car ils contenaient un trop grand nombre de mots (Taille maximale : {$a} mots).';
$string['detailed_error_too_short'] = 'Ces documents n’ont pas pu être analysés par Compilatio car ils ne contenaient pas assez de mots (Taille minimale : {$a} mots).';
$string['detailed_error_unsupported'] = 'Ces documents n’ont pas pu être analysés par Compilatio car leur format n’est pas supporté.';
$string['disable_ssl_verification'] = 'Ignorer la vérification du certificat SSL.';
$string['disable_ssl_verification_help'] = 'Activez cette option si vous avez des problèmes de vérification des certificats SSL ou si vous rencontrez des erreurs lors de l’envoi de fichiers à Compilatio.';
$string['disabled_in_maintenance'] = 'Désactivé pendant la maintenance';
$string['disclaimer_data'] = 'En activant Compilatio, vous acceptez que des informations concernant la configuration de votre plateforme Moodle soient collectées afin de faciliter le support et la maintenance du service.';
$string['display_notifications'] = 'Afficher les notifications';
$string['display_settings_frame'] = 'Paramètres d’affichage des scores';
$string['display_stats'] = 'Afficher les statistiques de cette activité';
$string['display_stats_per_student'] = 'Afficher les statistiques par étudiant concernant cette activité';
$string['document_deleting'] = 'Suppression des documents';
$string['document_reset_failures'] = '{$a} échecs de réinitialisation de document';
$string['document_sent'] = '{$a} documents envoyés.';
$string['documents_analyzed'] = '{$a->countAnalyzed} document(s) sur {$a->documentsCount} ont été envoyés et analysés.';
$string['documents_analyzed_between_thresholds'] = '{$a->documentsBetweenThresholds} document(s) entre {$a->greenThreshold}% et {$a->redThreshold}%.';
$string['documents_analyzed_higher_red'] = '{$a->documentsAboveRedThreshold} document(s) supérieur(s) à {$a->redThreshold}%.';
$string['documents_analyzed_lower_green'] = '{$a->documentsUnderGreenThreshold} document(s) inférieur(s) à {$a->greenThreshold}%.';
$string['documents_analyzing'] = '{$a} document(s) en cours d’analyse.';
$string['documents_failed'] = '{$a} document(s) dont l’analyse n’a pas fonctionné correctement.';
$string['documents_in_queue'] = '{$a} document(s) en attente d’analyse.';
$string['documents_notfound'] = '{$a} document(s) qui n’ont pas été trouvés.';
$string['documents_number'] = 'Les documents analysés';
$string['download_compilatio_database_button'] = 'Télécharger les tables Compilatio';
$string['download_compilatio_database_content'] = 'Exporter les tables liées à la base de données de Compilatio dans un fichier ZIP :';
$string['download_compilatio_database_title'] = 'Télécharger les tables liées à la base de données de Compilatio';
$string['download_report_failed'] = 'Une erreur s’est produite lors du téléchargement du rapport d’analyse.';
$string['element_included_in_subscription'] = 'Votre abonnement comprend : <ul><li>détection de similitudes</li><li>détection des textes altérés';
$string['enable_activities_title'] = 'Activer Compilatio pour les activités';
$string['enable_analyses_auto'] = 'Possibilité de lancer directement les analyses';
$string['enable_analyses_auto_help'] = 'Cette option permettra aux enseignants d’activer le lancement automatique de l’analyse des documents sur une activité (c’est-à-dire immédiatement après leur soumission).<br>
Notez que dans ce cas :
<ul>
    <li>Le nombre de scans effectués par votre institution peut être significativement plus élevé.</li>
    <li>Les documents des premiers soumissionnaires ne sont pas comparés avec ceux des derniers déposants.</li>
</ul>
Pour comparer tous les documents d’une tâche, il est nécessaire d’utiliser l’analyse "planifiée", en choisissant une date après la date limite de soumission.';
$string['enable_javascript'] = 'Veuillez activer Javascript pour profiter de toutes les fonctionnalités du plugin Compilatio.<br/>
Voici les <a href=\'http://www.enable-javascript.com/fr/\' target=\'_blank\'> instructions pour activer JavaScript dans votre navigateur Web</a>.';
$string['enable_mod_assign'] = 'Devoirs';
$string['enable_mod_forum'] = 'Forums';
$string['enable_mod_quiz'] = 'Test';
$string['enable_mod_workshop'] = 'Ateliers';
$string['enable_search_tab'] = 'Outil de recherche permettant d’identifier l’auteur d’un document.';
$string['enable_search_tab_help'] = 'L’outil de recherche vous permet de rechercher le nom et le prénom d’un étudiant à partir d’un identifiant de document visible dans les rapports d’analyse parmi tous les documents présents sur votre plateforme.';
$string['enable_show_reports'] = 'Possibilité de montrer les rapports d’analyse aux étudiants';
$string['enable_student_analyses'] = 'Possibilité d’autoriser l’analyse des brouillons par les étudiants.';
$string['enable_student_analyses_help'] = 'Cette option permettra aux enseignants d’activer sur une activité l’analyse par les étudiants de leurs documents soumis en mode brouillon avec Compilatio Magister, avant la soumission finale à l’enseignant.';
$string['enabledandworking'] = 'Le plugin Compilatio est actif et fonctionnel.';
$string['error'] = 'Erreur';
$string['errors'] = 'Erreurs';
$string['excluded_from_score'] = 'Exclu du score :';
$string['export_csv'] = 'Exporter les données de cette activité au format CSV';
$string['export_csv_per_student'] = 'Exporter les résultats de cet étudiant dans un fichier CSV';
$string['export_global_csv'] = 'Cliquez-ici pour exporter ces données au format CSV';
$string['export_raw_csv'] = 'Cliquez-ici pour exporter les données brutes au format CSV';
$string['extraction_in_progress'] = 'extraction du document en cours, veuillez réessayer plus tard';
$string['failed'] = 'L’analyse de ce document n’a pas fonctionné correctement.';
$string['failedanalysis'] = 'Compilatio n’a pas réussi à analyser votre document :';
$string['failedanalysis_files'] = 'L’analyse des documents suivants n’a pas fonctionné correctement. Vous pouvez réinitialiser ces documents et relancer leur analyse :';
$string['file'] = 'Fichier';
$string['filename'] = 'Nom du fichier';
$string['filereset'] = 'Un fichier a été remis à zéro pour re-soumission à Compilatio';
$string['firstname'] = 'Prénom';
$string['formapikey'] = 'Clé API';
$string['formcheck'] = 'Valider';
$string['formdelete'] = 'Supprimer';
$string['formenabled'] = 'Activée';
$string['formstartdate'] = 'Date d’activation';
$string['formurl'] = 'Adresse de l’API';
$string['get_scores'] = 'Récupère les taux de similitudes depuis Compilatio';
$string['global_statistics'] = 'Statistiques globales';
$string['global_statistics_description'] = 'Toutes les données des documents envoyés à Compilatio.';
$string['globalscore'] = 'Total';
$string['goto_compilatio_service_status'] = 'Voir l’état des services Compilatio.';
$string['goto_helpcenter'] = 'Cliquez sur le point d’interrogation pour ouvrir une nouvelle fenêtre et vous connecter au centre d’aide Compilatio.';
$string['green_threshold'] = 'Vert jusqu’à';
$string['help_compilatio_format_content'] = 'Compilatio gère la plupart des formats utilisés dans les traitements de texte et sur Internet. Les formats suivants sont pris en charge :';
$string['helpcenter'] = 'Accéder au centre d’aide Compilatio pour l’utilisation du plugin Compilatio dans Moodle.';
$string['helpcenter_error'] = 'Nous ne pouvons pas vous connecter automatiquement au centre d’aide. Veuillez ré-essayer ultérieurement ou vous y rendre directement grâce au lien suivant :';
$string['hide_area'] = 'Masquer les informations Compilatio';
$string['immediately'] = 'Immédiatement';
$string['include_percentage_in_suspect_text'] = 'Inclure dans le pourcentage de textes suspects affiché :';
$string['indexed_document'] = 'Document ajouté à la base de données de documents de votre institution. Son contenu peut être utilisé pour détecter des similitudes avec d’autres documents.';
$string['indexing_state'] = 'Ajouter des documents dans la base de données';
$string['indexing_state_help'] = 'Oui : ajoutez des documents dans la base de données. Ces documents seront utilisés comme matériel de comparaison pour des analyses futures.
Non : les documents ne sont pas ajoutés dans la base de données et ne seront pas utilisés pour les comparaisons.';
$string['info_cm_activated'] = 'Les documents soumis dans le cadre de cette activité sont téléchargés sur le compte Compilatio {$a}.<br>Tous les enseignants inscrits à ce cours peuvent utiliser Compilatio pour cette activité.';
$string['info_cm_activation'] = 'En activant Compilatio sur cette activité, les documents soumis seront téléchargés sur votre compte Compilatio {$a}.<br>Tous les enseignants inscrits à ce cours pourront utiliser Compilatio sur cette activité.';
$string['information_settings'] = 'Informations';
$string['keep_docs_indexed'] = 'Conserver les documents dans la bibliothèque de référence';
$string['keep_docs_indexed_help'] = 'Lors de la suppression d’un cours, de la réinitialisation d’un cours ou de la suppression d’une activité, vous pouvez choisir de supprimer définitivement les documents envoyés à Compilatio ou de les conserver dans la bibliothèque de référence (seul le texte sera conservé et servira de matériel de comparaison lors de vos prochaines analyses)';
$string['lastname'] = 'Nom';
$string['loading'] = 'Chargement en cours, veuillez patienter…';
$string['manual_analysis'] = 'L’analyse de ce document doit être déclenchée manuellement.';
$string['manual_send_confirmation'] = '{$a} fichier(s) soumis à Compilatio.';
$string['max_attempts_reach_files'] = 'Les fichiers suivants n’ont pas pu être analysés par Compilatio. La limite de relance d’analyses a été atteinte :';
$string['max_file_size'] = 'Les fichiers ne doivent pas dépasser <strong>{$a} Mo</strong>';
$string['max_file_size_allowed'] = 'Taille maximale des documents : <strong>{$a->Mo} Mo</strong>';
$string['maximum'] = 'Taux maximum';
$string['migration_apikey'] = 'Saisir la nouvelle clé d’API v5';
$string['migration_btn'] = 'Lancer la mise à jour des données stockées dans Moodle';
$string['migration_completed'] = 'Mise à jour terminée :';
$string['migration_failed_doc'] = 'Le document n’a pas pu être mis à jour ; vous pouvez réessayer de mettre à jour ces documents à la fin de la mise à jour.';
$string['migration_form_title'] = 'Lance la mise à jour des données stockées dans Moodle, pour terminer la mise à jour de v4 vers v5.';
$string['migration_info'] = 'Compilatio implémente une nouvelle plateforme technique v5 pour tous ses clients.<br>
Une fois demandé par l’équipe technique, vous devrez lancer une action pour terminer cette mise à jour.';
$string['migration_inprogress'] = 'Mise à jour en cours, cela peut prendre plusieurs heures <small>(vous pouvez quitter cette page pendant la mise à jour)</small>.';
$string['migration_np'] = 'Vous pouvez utiliser le plugin Compilatio même si la migration n’est pas terminée.';
$string['migration_restart'] = 'Réessayer';
$string['migration_success_doc'] = 'les documents ont été mis à jour';
$string['migration_task'] = 'Mise à jour des documents de la v4 à la v5';
$string['migration_title'] = 'Mise à jour de v4 vers v5';
$string['migration_toupdate_doc'] = 'documents à mettre à jour';
$string['minimum'] = 'Taux minimum';
$string['news_analysis_perturbated'] = 'Analyses Compilatio perturbées';
$string['news_incident'] = 'Incident Compilatio';
$string['news_maintenance'] = 'Maintenance Compilatio';
$string['news_update'] = 'Mise à jour Compilatio';
$string['next_student'] = 'Étudiant suivant';
$string['no_document_analysed'] = 'Aucun document analysé';
$string['no_document_available_for_analysis'] = 'Aucun document n’était disponible pour analyse.';
$string['no_document_to_display'] = 'Aucun document à afficher';
$string['no_documents_available'] = 'Aucun document n’est disponible pour analyse dans cette activité.';
$string['no_documents_to_reset'] = 'Pas de document à réinitialiser';
$string['no_notification'] = 'Pas de notification';
$string['no_statistics_yet'] = 'Aucun document n’a encore été analysé.';
$string['no_students_finished_quiz'] = 'Aucun étudiant n’a terminé le Test';
$string['not_analysed'] = 'non analysé';
$string['not_analyzed'] = 'Les documents suivants n’ont pas pu être analysés :';
$string['not_analyzed_extracting'] = 'Les documents suivants ne peuvent pas être analysés car ils sont en cours d’extraction, veuillez réessayer plus tard';
$string['not_analyzed_toolong'] = '{$a} document(s) n’a/ont pas pu être analysé(s) car contenant trop de mots.';
$string['not_analyzed_tooshort'] = '{$a} document(s) n’ont pas été analysés car ils ne contenaient pas assez de mots.';
$string['not_analyzed_unextractable'] = '{$a} document(s) n’ont pas été analysés car ils n’ont pas pu être chargés sur Compilatio.';
$string['not_analyzed_unsupported'] = '{$a} document(s) n’ont pas été analysés car leur format n’est pas supporté.';
$string['not_indexed_document'] = 'Document non ajouté à la base de données de documents de votre institution. Son contenu ne sera pas utilisé pour détecter des similitudes avec d’autres documents.';
$string['not_sent'] = 'Les documents suivants n’ont pas pu être envoyés :';
$string['notfound'] = 'Ce document n’a pas été trouvé. Veuillez contacter votre administrateur Moodle.
Erreur : document non trouvé pour cette clé API.';
$string['notifications'] = 'Notifications';
$string['numeric_threshold'] = 'Le seuil doit être un nombre.';
$string['open'] = 'Ouvrir';
$string['orange_threshold'] = 'Orange jusqu’à';
$string['other_analysis_options'] = 'Autres options d’analyse';
$string['owner_file'] = 'RGPD et propriété du devoir';
$string['owner_file_school'] = 'L’établissement est propriétaire des devoirs';
$string['owner_file_school_details'] = 'En cas de demande de suppression des données personnelles d’un étudiant, le contenu des devoirs sera conservé et disponible pour une comparaison future avec de nouveaux devoirs. À échéance du contrat avec Compilatio, toutes les données à caractère personnel de votre établissement, dont les devoirs, sont supprimées dans les délais prévus contractuellement.';
$string['owner_file_student'] = 'L’étudiant est l’unique propriétaire de son devoir';
$string['owner_file_student_details'] = 'En cas de demande de suppression des données personnelles d’un étudiant, les devoirs seront supprimés de la plateforme Moodle et de la bibliothèque de références Compilatio. Les devoirs ne seront plus disponibles pour une comparaison avec de nouveaux documents.';
$string['pending'] = 'Le fichier est en attente de soumission à Compilatio.';
$string['pending_status'] = 'En attente';
$string['planned'] = 'Planifié';
$string['plugin_disabled'] = 'Le plugin n’est pas activé pour la plateforme Moodle.';
$string['plugin_disabled_assign'] = 'Le plugin n’est pas activé pour les devoirs.';
$string['plugin_disabled_forum'] = 'Le plugin n’est pas activé pour les forums.';
$string['plugin_disabled_quiz'] = 'Le plugin n’est pas activé pour les tests.';
$string['plugin_disabled_workshop'] = 'Le plugin n’est pas activé pour les ateliers.';
$string['plugin_enabled'] = 'Le plugin est activé pour la plateforme Moodle.';
$string['plugin_enabled_assign'] = 'Le plugin est activé pour les devoirs.';
$string['plugin_enabled_forum'] = 'Le plugin est activé pour les forums.';
$string['plugin_enabled_quiz'] = 'Le plugin est activé pour les tests.';
$string['plugin_enabled_workshop'] = 'Le plugin est activé pour les ateliers.';
$string['pluginname'] = 'Compilatio - Plugin de détection de plagiat';
$string['previous_student'] = 'Étudiant précédent';
$string['previouslysubmitted'] = 'Auparavant soumis comme';
$string['privacy:metadata:core_files'] = 'Fichiers déposés ou créés depuis un champ de saisie';
$string['privacy:metadata:core_plagiarism'] = 'Ce plugin est appelé par le sous-système de détection de plagiat de Moodle';
$string['privacy:metadata:external_compilatio_document'] = 'Informations et contenu des documents dans la base de données de Compilatio';
$string['privacy:metadata:external_compilatio_document:authors'] = 'Nom, prénom et adresse de courriel de l’utilisateur Moodle (ou des membres du groupe) qui a remis le fichier';
$string['privacy:metadata:external_compilatio_document:depositor'] = 'Nom, prénom et adresse de courriel de l’utilisateur Moodle qui a remis le fichier';
$string['privacy:metadata:external_compilatio_document:filename'] = 'Nom du fichier remis ou nom généré pour les contenus texte';
$string['privacy:metadata:external_compilatio_user'] = 'Informations sur l’enseignant qui a créé un module de cours avec Compilatio';
$string['privacy:metadata:external_compilatio_user:email'] = 'Courriel de l’enseignant';
$string['privacy:metadata:external_compilatio_user:firstname'] = 'Prénom de l’enseignant';
$string['privacy:metadata:external_compilatio_user:lastname'] = 'Nom de famille de l’enseignant';
$string['privacy:metadata:external_compilatio_user:username'] = 'Courriel de l’enseignant';
$string['privacy:metadata:plagiarism_compilatio_cm_cfg'] = 'Information sur les fichiers de configuration';
$string['privacy:metadata:plagiarism_compilatio_cm_cfg:cmid'] = 'L’ID Compilatio du module';
$string['privacy:metadata:plagiarism_compilatio_cm_cfg:userid'] = 'L’ID Moodle de l’enseignant';
$string['privacy:metadata:plagiarism_compilatio_files'] = 'Informations à propos des fichiers soumis à Compilatio';
$string['privacy:metadata:plagiarism_compilatio_files:filename'] = 'Nom du fichier remis ou nom généré pour les contenus texte';
$string['privacy:metadata:plagiarism_compilatio_files:userid'] = 'L’identifiant Moodle de l’utilisateur qui a remis le fichier';
$string['privacy:metadata:plagiarism_compilatio_user'] = 'Informations sur l’enseignant qui a créé un module de cours avec Compilatio';
$string['privacy:metadata:plagiarism_compilatio_user:compilatioid'] = 'L’ID Compilatio de l’enseignant';
$string['privacy:metadata:plagiarism_compilatio_user:userid'] = 'L’identifiant Moodle de l’enseignant';
$string['processing_doc'] = 'Le fichier est en cours d’analyse par Compilatio.';
$string['programmed_analysis_future'] = 'Les documents seront analysés par Compilatio le {$a}.';
$string['programmed_analysis_past'] = 'Les documents ont été soumis pour analyse à Compilatio le {$a}.';
$string['progress'] = 'Progression :';
$string['queue'] = 'Attente';
$string['queued'] = 'Le document est en attente d’analyse et va bientôt être traité par Compilatio';
$string['queuing_docs'] = '{$a} document(s) en attente d’analyse';
$string['quiz_help'] = 'Seules les questions dont la réponse contient au moins {$a} mots seront analysées.';
$string['read_only_apikey'] = 'Votre clé API en lecture seule ne permet pas le téléversement ou l’analyse de documents.';
$string['read_only_apikey_error'] = 'Votre clé API en lecture seule ne permet pas de télécharger ou d’analyser des documents.';
$string['read_only_apikey_title'] = 'Clé API en lecture seule.';
$string['red_threshold'] = 'rouge au delà';
$string['redirect_report_failed'] = 'Une erreur s’est produite lors de la récupération du rapport d’analyse. Veuillez réessayer plus tard ou contacter le support (support@compilatio.net) si le problème persiste.';
$string['report'] = 'rapport';
$string['reporttype'] = 'Rapport disponible pour les étudiants';
$string['reporttype_help'] = '<p>Il existe 2 options possibles :</p>
<ul>
    <li><strong>Certificat d’analyse :</strong> L’étudiant aura accès au certificat d’analyse de son document.</li>
    <li><strong>Rapport détaillé :</strong> L’étudiant aura accès à la version PDF du rapport.</li>
</ul>';
$string['resend_document_in_error'] = 'Renvoyer les documents en erreur';
$string['reset'] = 'Relancer';
$string['reset_docs_in_error'] = 'Réinitialiser les documents en erreur';
$string['reset_docs_in_error_in_progress'] = 'Réinitialisation des documents en erreur en cours';
$string['reset_documents_in_error'] = 'Réinitialiser les documents en erreur';
$string['reset_failed_document'] = 'Réinitialiser les documents en erreur';
$string['reset_failed_document_in_progress'] = 'Réinitialisation des documents en erreur en cours';
$string['reset_failed_document_title'] = 'Réinitialiser les documents en erreur :';
$string['response_type'] = 'Type de réponse';
$string['restart_failed_analyses'] = 'Relancer les analyses échouées';
$string['results'] = 'Résultats';
$string['results_by_student'] = 'Résultats par étudiant';
$string['saved_config_failed'] = '<strong>La combinaison de la clé API et de l’adresse saisie est non valide. Compilatio est désactivé, veuillez réessayer.<br/>
    La page <a href="autodiagnosis.php">d’auto-diagnostic</a> peut vous aider à configurer ce plugin.</strong><br/>
    Erreur :';
$string['savedconfigsuccess'] = 'Paramètres de plagiat sauvegardés';
$string['score'] = 'Score';
$string['score_settings_info'] = 'La mise à jour des notes affecte tous les documents analysés dans le devoir, y compris ceux qui ont été modifiés individuellement.';
$string['see_all_notifications'] = 'Voir toutes les notifications';
$string['select_a_student'] = 'Sélectionner un étudiant';
$string['send_all_documents'] = 'Envoyer tous les documents';
$string['send_documents_in_progress'] = 'Envoi de documents en cours';
$string['send_files'] = 'Téléchargement de fichiers vers Compilatio pour la détection des similitudes';
$string['sending_failed'] = 'Le chargement du fichier vers Compilatio a échoué {$a}';
$string['short_error_analysis_failed'] = 'analyses échouées.';
$string['short_error_extraction_failed'] = 'extraction de documents échoué.';
$string['short_error_not_found'] = 'documents introuvables.';
$string['short_error_sending_failed'] = 'échec de l’envoi.';
$string['short_error_too_large'] = 'documents trop volumineux.';
$string['short_error_too_long'] = 'documents trop longs.';
$string['short_error_too_short'] = 'documents trop courts.';
$string['short_error_unsupported'] = 'documents non pris en charge.';
$string['show_area'] = 'Afficher les informations de Compilatio';
$string['showstudentreport'] = 'Montrer le rapport d’analyse à l’étudiant';
$string['showstudentreport_help'] = 'Le rapport d\'analyse indique les parties suspectes du document et l\'emplacement des sources détectées pour lesquelles des similitudes ont été constatées.';
$string['showstudentscore'] = 'Afficher le score de textes suspects à l’étudiant.';
$string['showstudentscore_help'] = 'Le score de texte suspect correspond au pourcentage du document soumis qui pourrait ne pas être authentique.
<br>Il peut inclure : des similitudes, du contenu potentiellement généré par une IA ou des textes altérés (textes transformés pour contourner les logiciels de détection).';
$string['showwhenclosed'] = 'Quand l’activité est fermée';
$string['similarities'] = 'Textes suspects';
$string['similarities_disclaimer'] = 'Vous pouvez analyser les textes suspects dans les documents de cette activité avec <a href=\'http://www.compilatio.net\' target=\'_blank\'>Compilatio</a>.<br/>
    Attention : les textes suspects mesurés lors de l’analyse ne signifient pas nécessairement qu’il y a eu plagiat. Le rapport d’analyse vous aide à identifier si les textes suspects correspondent à une citation appropriée ou à un plagiat.';
$string['similarity_percent'] = '% de textes suspects';
$string['simscore'] = 'Similitudes';
$string['simscore_percentage'] = 'Pourcentages des similitudes';
$string['start_all_analysis'] = 'Analyser tous les documents';
$string['start_analysis_in_progress'] = 'Lancement des analyses en cours';
$string['start_analysis_title'] = 'Démarrage des analyses';
$string['start_selected_files_analysis'] = 'Analyser les documents sélectionnés';
$string['start_selected_questions_analysis'] = 'Analyser les questions sélectionnées';
$string['startallcompilatioanalysis'] = 'Analyser tous les documents';
$string['startanalysis'] = 'Démarrer l’analyse';
$string['statistics_title'] = 'Statistiques';
$string['stats_avg'] = 'Moyenne';
$string['stats_error_unknown'] = 'erreurs inconnues';
$string['stats_errors'] = 'Erreurs';
$string['stats_failed'] = 'Analyses échouées';
$string['stats_max'] = 'Maximum';
$string['stats_min'] = 'Minimum';
$string['stats_notfound'] = 'Fichier non trouvé';
$string['stats_score'] = 'Pourcentage de textes suspects';
$string['stats_threshold'] = 'Nombre de documents par seuil';
$string['stats_toolong'] = 'Le fichier contient trop de mots';
$string['stats_tooshort'] = 'Le fichier ne contient pas assez de mots';
$string['stats_unextractable'] = 'Le fichier n’a pas pu être chargé sur Compilatio';
$string['stats_unsupported'] = 'Format de fichier non supporté';
$string['student'] = 'Étudiant';
$string['student_analyse'] = 'L’analyse peut être lancée par l’étudiant';
$string['student_analyze'] = 'Analyse par l’étudiant';
$string['student_help'] = 'Vous pouvez analyser votre brouillon avec Compilatio Magister, afin de mesurer les similitudes présentes dans le texte de vos fichiers.<br/>
Le contenu de votre brouillon ne sera pas utilisé par Compilatio comme matériel de comparaison pour les futures analyses effectuées.<br/>
Votre enseignant aura cependant accès à ce rapport d’analyse.';
$string['student_start_analyze'] = 'L’analyse peut être lancée par l’étudiant';
$string['studentanalyses'] = 'Permettre aux étudiants d’analyser leurs documents';
$string['studentanalyses_help'] = 'Cela permet aux étudiants d’analyser leurs fichiers de brouillon avec Compilatio Magister, avant la soumission finale à l’enseignant.';
$string['studentdisclosuredefault'] = 'L\'ensemble des fichiers téléchargés ici seront soumis au service de détection de textes suspects Compilatio.';
$string['studentemailcontent'] = 'Le fichier que vous avez soumis à {$a->modulename} dans {$a->coursename} a été traité par l’outil de détection de plagiat Compilatio
{$a->modulelink}';
$string['studentemailsubject'] = 'Le fichier a été traité par Compilatio';
$string['students_disclosure'] = 'Message de prévention pour les étudiants';
$string['students_disclosure_help'] = 'Ce texte sera affiché à tous les étudiants sur la page de dépôt de fichier.';
$string['subscription'] = '<b>Informations sur votre abonnement :</b>';
$string['subscription_analysis_count'] = 'Documents analysés : {$a->usage} de {$a->value}';
$string['subscription_analysis_page_count'] = 'Pages analysées : {$a->usage} de {$a->value}';
$string['subscription_end'] = 'Date d’échéance incluse :';
$string['subscription_start'] = 'Date de début :';
$string['subscription_will_expire'] = 'Votre abonnement à Compilatio expirera à la fin de';
$string['suspect_words/total_words'] = 'mots suspects / mots totaux';
$string['suspect_words_quiz_on_total'] = 'mots suspects / <br>mots totaux';
$string['tabs_title_help'] = 'Aide';
$string['tabs_title_notifications'] = 'Notifications';
$string['tabs_title_stats'] = 'Statistiques';
$string['tabs_title_technical_tools'] = 'Outils techniques';
$string['teacher'] = 'Enseignant';
$string['teacher_features_title'] = 'Fonctionnalités activées pour les enseignants';
$string['terms_of_service_info'] = '<a href=\'{$a}\'>Conditions d’utilisation</a> de Compilatio';
$string['text'] = 'Texte';
$string['thresholds_description'] = 'Indiquez les seuils que vous souhaitez utiliser, afin de faciliter le repérage des rapports d’analyse (% de textes suspects) :';
$string['thresholds_settings'] = 'Réglage des seuils d’affichage des taux de similitudes :';
$string['timesubmitted'] = 'Soumis à Compilatio le';
$string['title_analysing'] = 'Compilatio est en train d’analyser ce fichier.';
$string['title_error_analysis_failed'] = 'L’analyse de ce document n’a pas fonctionné correctement.';
$string['title_error_extraction_failed'] = 'L’extraction de ce document n’a pas fonctionné correctement.';
$string['title_error_not_found'] = 'Ce document n’a pas été trouvé. Veuillez contacter votre administrateur Moodle. Erreur : document non trouvé pour cette clé API.';
$string['title_error_sending_failed'] = 'Une erreur s’est produite lors de l’envoi de ce fichier à Compilatio.';
$string['title_error_too_large'] = 'Ce fichier est trop volumineux pour être traité par Compilatio. Taille maximale : {$a} Mo';
$string['title_error_too_long'] = 'Ce document contient trop de mots pour être analysé. Taille maximale : {$a} mots';
$string['title_error_too_short'] = 'Ce document ne contient pas assez de mots pour être traité par Compilatio. Taille minimale : {$a} mots';
$string['title_error_unsupported'] = 'Ce type de fichier n’est pas pris en charge par Compilatio';
$string['title_planned'] = 'Ce fichier sera traité le {$a}';
$string['title_queue'] = 'Le document est maintenant dans la file d’attente et il sera bientôt analysé par Compilatio';
$string['title_score'] = 'Analyse terminée : {$a}% de textes suspects.';
$string['title_score_teacher'] = 'Si vous avez ignoré des sources dans le rapport, cliquez ici pour mettre à jour le score.';
$string['title_sent'] = 'Démarrer l’analyse';
$string['title_unsent'] = 'Envoyer le document à Compilatio';
$string['toolarge'] = 'Le fichier est trop volumineux pour être traité par Compilatio. Taille maximale : {$a->Mo} Mo';
$string['toolong'] = 'Ce document contient trop de mots pour être analysé. Taille maximum : {$a} mots.';
$string['toolong_files'] = 'Ce(s) fichier(s) ne peut/peuvent pas être analysé(s) par Compilatio car il contient/contiennent trop de mots (taille maximum : {$a} mots) :';
$string['tooltip_detailed_scores'] = '% de textes suspects, dont :';
$string['tooshort'] = 'Ce document ne contient pas assez de mots pour être traité par Compilatio. Taille minimale : {$a} mots';
$string['tooshort_files'] = 'Les fichiers suivants n’ont pas pu être analysés par Compilatio car ils ne contenaient pas assez de mots (Taille minimale : {$a} mots) :';
$string['total'] = 'Total';
$string['trigger_analyses'] = 'Déclencher les analyses Compilatio';
$string['unextractable'] = 'Le document n’a pas pu être chargé sur Compilatio';
$string['unextractable_files'] = 'Les fichiers suivants n’ont pas pu être analysés par Compilatio car leur contenu n’a pas pu être extrait correctement :';
$string['unextractablefile'] = 'Ce document n’a pas pu être chargé sur Compilatio.';
$string['university_composable_none'] = 'Aucun';
$string['unknownlang'] = 'Attention, la langue de certains passages de ce document n’a pas été reconnue.';
$string['unknownwarning'] = 'Une erreur s’est produite lors de l’envoi du fichier à Compilatio';
$string['unmeasured'] = 'non mesuré';
$string['unsent_docs'] = 'Cette activité contient des documents qui n’ont pas été soumis à Compilatio.';
$string['unsent_documents'] = 'Document(s) non-soumis';
$string['unsent_documents_content'] = 'Attention, cette activité contient un (ou des) document(s) non soumis à Compilatio.';
$string['unsupported'] = 'Document non supporté';
$string['unsupported_files'] = 'Le(s) fichier(s) suivant(s) n’ont pas pu être analysés par Compilatio car leur format n’est pas supporté :';
$string['unsupportedfiletype'] = 'Ce type de fichier n’est pas pris en charge par Compilatio';
$string['update_in_progress'] = 'Mise à jour des informations en cours';
$string['update_meta'] = 'Exécute les tâches planifiées par Compilatio';
$string['updatecompilatioresults'] = 'Rafraîchir les informations';
$string['updated_analysis'] = 'Les résultats de l’analyse Compilatio ont été mis à jour.';
$string['use_compilatio'] = 'Permettre de détecter les similitudes avec Compilatio';
$string['user_management'] = 'Gestion utilisateur';
$string['utlscore'] = 'Langues non reconnues';
$string['utlscore_percentage'] = 'Pourcentage de types de langues non reconnues';
$string['waitingforanalysis'] = 'Ce fichier sera traité le {$a}';
$string['webservice_not_ok'] = 'Le service web n’a pas pu être contacté. Il est possible que votre pare-feu bloque la connexion.';
$string['webservice_ok'] = 'Le serveur est capable de contacter le service web.';
$string['webservice_unreachable'] = 'Compilatio est actuellement indisponible. Nous nous excusons pour le désagrément.';
$string['webservice_unreachable_content'] = 'Le service Compilatio est actuellement indisponible. Veuillez nous excuser pour la gêne occasionnée.';
$string['webservice_unreachable_title'] = 'Compilatio est indisponible.';
$string['word'] = 'mots';
$string['word_limits'] = 'Pour pouvoir être analysé, un texte doit contenir entre {$a->min} et {$a->max} mots.';
$string['wrong_apikey_type'] = 'La clé API saisie n’est pas valide. Si vous avez récemment mis à jour la version de votre plugin Compilatio, contactez le support (support@compilatio.net) pour obtenir une nouvelle clé.';
