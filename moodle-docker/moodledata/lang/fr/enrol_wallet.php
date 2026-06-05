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
 * Strings for component 'enrol_wallet', language 'fr', version '5.1'.
 *
 * @package     enrol_wallet
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['MWC'] = 'Pièces du portefeuille';
$string['addbundle'] = 'Ajouter un lot';
$string['addbundle_help'] = 'Ajouter une valeur de recharge rapide associée à cette règle de remise conditionnelle.';
$string['agreepolicy_intro'] = 'Pour effectuer une recharge du portefeuille, cela signifie que vous avez <strong>lu et accepté</strong> la politique de remboursement manuel.<br/> Cliquez sur le lien ci-dessous pour lire la politique.<br/>';
$string['agreepolicy_label'] = 'J\'accepte la politique de remboursement manuel.';
$string['allowmultiple'] = 'Nombre d\'instances autorisées';
$string['allowmultiple_help'] = 'Sélectionnez le nombre d\'instances autorisées dans un seul cours, 0 signifie illimité.';
$string['allusers'] = 'Transactions pour tous les utilisateurs sélectionnés';
$string['alreadyenroled'] = 'Vous êtes déjà inscrit à ce cours, peut-être que votre période est expirée ou que vous avez été suspendu <br> contactez votre assistant ou le support technique pour plus d\'aide';
$string['amount'] = 'Montant';
$string['applycoupon'] = 'Appliquer un coupon';
$string['applycoupon_help'] = 'Appliquez un code de coupon pour obtenir une remise ou une valeur fixe pour recharger votre portefeuille. <br> Si le coupon a une valeur fixe supérieure au coût du cours, vous serez inscrit.';
$string['availability_form_desc'] = 'Certaines restrictions de disponibilité dépendent des modules du cours (ex. : achèvement d’activité, note). Vous pouvez désormais inclure d’autres cours en augmentant le nombre de cours requis, en les sélectionnant, puis en enregistrant le formulaire. En rouvrant celui-ci, tous les paramètres nécessaires des cours sélectionnés seront automatiquement pris en compte.';
$string['availability_plugins'] = 'Plugins de disponibilité';
$string['availability_plugins_desc'] = 'Choisissez ici le plugin de condition de disponibilité adapté à votre besoin logique pour empêcher le créateur de cours d\'ajouter des restrictions non adaptées.';
$string['availablebalance'] = 'Solde disponible';
$string['awardcreteria'] = 'Condition pour obtenir une récompense';
$string['awardcreteria_help'] = 'Les récompenses fonctionnent lorsque l\'étudiant termine un cours. Quel est le pourcentage de la note maximale à partir duquel l\'étudiant reçoit une récompense s\'il le dépasse ?';
$string['awardingdesc'] = 'L\'utilisateur reçoit une récompense de {$a->amount} dans le cours {$a->courseshortname} pour avoir obtenu {$a->usergrade} sur {$a->maxgrade}';
$string['awards'] = 'Programme de récompenses';
$string['awards_help'] = 'Activer ou désactiver le programme de récompenses dans ce cours';
$string['awardsalter'] = 'Modifier les récompenses';
$string['awardsalter_help'] = 'Modifier le statut du programme de récompenses';
$string['awardssite'] = 'Activer les récompenses';
$string['awardssite_help'] = 'Activer la possibilité pour le créateur du cours de définir des récompenses pour le cours.';
$string['awardvalue'] = 'Valeur de la récompense';
$string['awardvalue_help'] = 'Quel est le montant accordé à l’étudiant pour chaque point au-dessus de la condition?';
$string['balance'] = 'Solde';
$string['balance_after'] = 'Solde après';
$string['balance_before'] = 'Solde avant';
$string['borrow'] = 'Solde emprunté';
$string['borrow_desc'] = 'Activer et définir la condition permettant aux utilisateurs de confiance de s’inscrire à des cours sans solde suffisant ; leur solde devient négatif et ils devront recharger leur portefeuille pour payer plus tard.';
$string['borrow_enable'] = 'Activer l\'emprunt';
$string['borrow_enable_help'] = 'Si activé, les étudiants répondant aux conditions pourront être inscrits même avec un solde insuffisant.';
$string['borrow_period'] = 'Période de transactions pour l’emprunt.';
$string['borrow_period_help'] = 'La période pendant laquelle l’utilisateur doit avoir effectué le nombre de transactions requis pour être éligible à l’emprunt.';
$string['borrow_trans'] = 'Transactions pour l’emprunt';
$string['borrow_trans_help'] = 'Nombre de transactions de crédit dans une période donnée nécessaire pour que l’utilisateur soit éligible à l’emprunt de solde.';
$string['bulk_instanceshead'] = 'Modification groupée des inscriptions (pour toutes les instances de cours)';
$string['bulk_instancesno'] = 'Aucune instance créée ou mise à jour';
$string['bulk_instancestitle'] = 'Modification groupée des instances d’inscription par portefeuille';
$string['bulk_instancesyes'] = '{$a->updated} instances d’inscription ont été mises à jour ET {$a->created} ont été créées.';
$string['bulkeditor'] = 'Modification groupée des inscriptions';
$string['bulkeditor_head'] = 'Modification groupée des inscriptions (pour tous les utilisateurs dans les cours sélectionnés)';
$string['bulkfolder'] = 'Extra par inscriptions via portefeuille';
$string['bundle_desc'] = 'Description du lot';
$string['bundle_desc_help'] = 'Ajouter une description pour ce lot (ex. : suffisant pour 11 cours au prix de 9).';
$string['bundle_value'] = 'Valeur de recharge rapide';
$string['bundle_value_error'] = 'La valeur du lot doit être supérieure ou égale à la condition';
$string['bundle_value_help'] = 'Cette valeur doit être supérieure ou égale à la condition. Assurez-vous également qu’il s’agit de la valeur avant réduction.';
$string['bundlevalidin'] = 'Valide pour être utilisé dans';
$string['cachedef_balance'] = 'Stocke les détails du solde de l’utilisateur';
$string['cachedef_coupon'] = 'Stockage des données du coupon';
$string['cachedef_offers'] = 'Données de cache des offres';
$string['cannotdeductbalance'] = 'Impossible de déduire le solde en raison d’une erreur. Veuillez réessayer et si le problème persiste, contactez le support du site.';
$string['canntenrol'] = 'L’inscription est désactivée ou inactive';
$string['canntenrolearly'] = 'Vous ne pouvez pas encore vous inscrire ; l’inscription commence le {$a}.';
$string['canntenrollate'] = 'Vous ne pouvez plus vous inscrire, l’inscription s’est terminée le {$a}.';
$string['cashback'] = 'Remboursement (cashback)';
$string['cashback_desc'] = 'Vous recevrez un cashback de {$a}% chaque fois que vous achetez un cours en utilisant la méthode d’inscription par portefeuille.';
$string['cashbackdesc'] = 'ajouté par cashback en raison de l’inscription dans {$a}';
$string['cashbackenable'] = 'Activer le cashback';
$string['cashbackenable_desc'] = 'Lorsque cette option est activée, l’étudiant recevra un pourcentage de cashback à chaque achat de cours via le portefeuille.';
$string['cashbackpercent'] = 'Pourcentage de cashback';
$string['cashbackpercent_help'] = 'Le pourcentage remboursé au portefeuille à partir du montant payé avec le solde du portefeuille.';
$string['catbalance'] = 'Solde par catégorie';
$string['catbalance_desc'] = 'Si activé, un solde peut être défini séparément pour chaque catégorie et utilisé uniquement dans celle-ci. Un solde global du site reste utilisable partout.';
$string['category_options'] = 'Catégorie';
$string['category_options_help'] = 'Identique aux coupons fixes, sauf qu’il est limité à la catégorie choisie';
$string['categorycoupon'] = 'Coupon de catégorie';
$string['categorycoupondisabled'] = 'Coupons de catégorie désactivés';
$string['ch_result_after'] = '<p>Solde après : <b>{$a}</b></p>';
$string['ch_result_before'] = '<p>Solde avant : <b>{$a}</b></p>';
$string['ch_result_error'] = '<p style = "text-align: center;"><b> ERREUR
{$a}
Veuillez revenir en arrière et vérifier à nouveau</b></p>';
$string['ch_result_info_balance'] = '<span style="text-align: center; width: 100%;"><h5> l’utilisateur : {$a->userfull} a un solde de {$a->before} </h5></span>';
$string['ch_result_info_charge'] = '<span style="text-align: center; width: 100%;"><h5> l’utilisateur : {$a->userfull} a maintenant un solde de {$a->after} après l’avoir rechargé de {$a->after_before}… </h5></span>';
$string['ch_result_negative'] = '<p><b>CET UTILISATEUR A UN SOLDE NÉGATIF</b></p>';
$string['characters'] = 'Caractères dans le code';
$string['characters_help'] = 'Choisissez le type de caractères dans les codes générés';
$string['charge'] = 'Recharger';
$string['charger_credit_desc'] = 'Recharge manuelle de {$a}';
$string['charger_debit_desc'] = '(déduction manuelle de {$a})';
$string['charger_debit_err'] = 'La valeur ({$a->value}) est supérieure au solde de l’utilisateur ({$a->before})';
$string['charger_invalid_operation'] = 'Opération invalide';
$string['charger_nouser'] = 'Aucun utilisateur sélectionné';
$string['charger_novalue'] = 'Aucune valeur valide saisie';
$string['charging_value'] = 'Montant de la recharge :';
$string['chargingoperation'] = 'Opération';
$string['chargingoptions'] = 'Recharge du portefeuille de l’utilisateur';
$string['chargingvalue'] = 'Valeur';
$string['checkout'] = '{$a->credit_cost} {$a->currency} sera déduit de votre solde de {$a->user_balance} {$a->currency}.';
$string['checkout_borrow'] = '{$a->credit_cost} {$a->currency} nécessaires pour l’inscription, votre solde de {$a->user_balance} {$a->currency} sera déduit et vous emprunterez {$a->borrow}.';
$string['checkout_borrow_discounted'] = '<del>{$a->credit_cost} {$a->currency}</del> {$a->after_discount} {$a->currency} nécessaires pour l’inscription, votre solde de {$a->user_balance} {$a->currency} sera déduit et vous emprunterez {$a->borrow}.';
$string['checkout_discounted'] = '<del>{$a->credit_cost} {$a->currency}</del> {$a->after_discount} {$a->currency} sera déduit de votre solde de {$a->user_balance} {$a->currency}.';
$string['cleanupwalletitemstask'] = 'Nettoyer les éléments de portefeuille orphelins et expirés';
$string['clear_filter'] = 'Effacer les filtres';
$string['cohortnonmemberinfo'] = 'Seuls les membres de la cohorte « {$a} » peuvent s’inscrire.';
$string['cohortonly'] = 'Membres de cohorte uniquement';
$string['cohortonly_help'] = 'L’inscription peut être limitée aux seuls membres d’une cohorte spécifique. Notez que la modification de ce paramètre n’a aucun effet sur les inscriptions existantes.';
$string['condition'] = 'Condition';
$string['conditionaldiscount'] = 'Remise conditionnelle';
$string['conditionaldiscount_apply'] = 'Remises conditionnelles';
$string['conditionaldiscount_apply_help'] = 'Activer la remise conditionnelle pour l’ensemble du site';
$string['conditionaldiscount_condition'] = 'Condition pour appliquer la remise';
$string['conditionaldiscount_condition_help'] = 'Les remises ne seront appliquées que si le portefeuille de l’utilisateur est rechargé d’un montant supérieur ou égal à la valeur saisie ici.';
$string['conditionaldiscount_desc'] = 'Rechargement du portefeuille grâce aux remises conditionnelles de {$a->rest} pour un rechargement supérieur à {$a->condition}';
$string['conditionaldiscount_link_desc'] = 'Ajouter, modifier ou supprimer des règles de remise conditionnelle';
$string['conditionaldiscount_percent'] = 'Pourcentage de remise';
$string['conditionaldiscount_percent_help'] = 'Les utilisateurs sont crédités de ce pourcentage (appliqué uniquement lors du rechargement du portefeuille).
Note importante : si l’utilisateur choisit de recharger le portefeuille de 400 et que la remise est fixée à 15 %, il ne paiera que 340 et 60 seront ajoutés automatiquement.';
$string['conditionaldiscount_percentage'] = 'Pourcentage';
$string['conditionaldiscount_timefrom'] = 'Disponible après';
$string['conditionaldiscount_timefrom_help'] = 'Disponible après la date définie ; avant celle-ci, la condition n’est pas applicable.';
$string['conditionaldiscount_timeto'] = 'Disponible jusqu’au';
$string['conditionaldiscount_timeto_help'] = 'Disponible jusqu’à la date définie ; après celle-ci, la condition n’est plus applicable.';
$string['confirm_additional_credit'] = '<strong> Avec un ajout de {$a} grâce à la remise conditionnelle.</strong>';
$string['confirm_credit'] = 'Vous êtes sur le point d’ajouter un montant de {$a->amount} à l’utilisateur {$a->name} dans le <strong>portefeuille {$a->category}</strong>, qui a déjà un solde de {$a->balance} valide.';
$string['confirm_debit'] = 'Vous êtes sur le point de déduire un montant de {$a->amount} de l’utilisateur {$a->name} dans le <strong>solde {$a->category}</strong>, dont le solde actuel est de {$a->balance} utilisable dans {$a->category}. Le solde après transaction sera de {$a->after}.';
$string['confirm_enrol_confirm'] = 'Vous êtes sur le point de vous inscrire au cours <strong>{$a->course}</strong>.
Cela nécessite une déduction de <strong>{$a->cost} {$a->currency}</strong> de votre solde.
Votre solde actuel est de {$a->balance}
<p>{$a->policy}</p> <strong> Cette opération est irréversible.
Le voulez-vous vraiment ?</strong>';
$string['confirm_enrol_error'] = 'Accès invalide à la page d’inscription.';
$string['confirm_negative'] = '<b>Avertissement solde négatif :</b> le solde de l’utilisateur deviendra négatif après cette transaction.';
$string['confirmbulkdeleteenrolment'] = 'Voulez-vous vraiment supprimer ces inscriptions d’utilisateurs ?';
$string['confirmdeletecoupon'] = 'Voulez-vous vraiment supprimer les coupons avec les identifiants {$a} ? Cette opération est irréversible.';
$string['confirmedit'] = 'Confirmer la modification';
$string['confirmpayment'] = 'Confirmez le paiement de {$a->value} {$a->currency}. Remarque : cliquer sur Oui signifie que vous acceptez la politique de remboursement.
{$a->policy}';
$string['confirmpayment_discounted'] = 'Confirmez le paiement de {$a->value} {$a->currency}. Remarque : cliquer sur Oui signifie que vous acceptez la politique de remboursement.
{$a->policy}Confirmez le paiement de <del>{$a->before} {$a->currency}</del> {$a->value} {$a->currency}. Remarque : cliquer sur Oui signifie que vous acceptez la politique de remboursement.
{$a->policy}';
$string['coupon_applydiscount'] = 'Vous bénéficiez maintenant d’une remise de {$a}%';
$string['coupon_applyerror'] = 'ERREUR code coupon invalide :
{$a}';
$string['coupon_applyfilter'] = 'Appliquer le filtre';
$string['coupon_applyfixed'] = 'Code coupon appliqué avec succès, valeur : {$a->value} {$a->currency}.';
$string['coupon_applynocourse'] = 'Erreur lors de l’application du coupon, cours introuvable.';
$string['coupon_applynothere'] = 'Impossible d’appliquer ce type de coupons ici.';
$string['coupon_applynothere_category'] = 'Impossible d’appliquer un coupon de catégorie ici, il doit être utilisé uniquement dans une catégorie spécifique.';
$string['coupon_applynothere_discount'] = 'Impossible d’appliquer un coupon de remise ici.';
$string['coupon_applynothere_enrol'] = 'Impossible d’appliquer les coupons d’inscription ici. Veuillez les utiliser sur la page du cours.';
$string['coupon_cat_notsufficient'] = 'La valeur de ce coupon n’est pas suffisante pour être utilisée dans ce cours.';
$string['coupon_categoryapplied'] = 'Le coupon a été appliqué.';
$string['coupon_categoryfail'] = 'Désolé, ce coupon ne peut être appliqué que dans cette catégorie : {$a}';
$string['coupon_code'] = 'Code coupon';
$string['coupon_code_applied'] = 'Code coupon {$a} appliqué.';
$string['coupon_code_error'] = 'Veuillez saisir un code ou sélectionner la méthode aléatoire';
$string['coupon_code_help'] = 'Saisissez le code coupon souhaité.';
$string['coupon_edit_heading'] = 'Modifier le coupon';
$string['coupon_edit_title'] = 'Édition du coupon';
$string['coupon_enrolapplied'] = 'Le coupon a été appliqué';
$string['coupon_enrolerror'] = 'Désolé, ce coupon ne peut être appliqué que dans ces cours :
{$a}';
$string['coupon_exceedusage'] = 'Ce coupon dépasse le nombre d’utilisations autorisées';
$string['coupon_exist'] = 'Ce code coupon existe déjà.';
$string['coupon_expired'] = 'Ce coupon est expiré';
$string['coupon_generation'] = 'Créer des coupons';
$string['coupon_generation_heading'] = 'Ajouter de nouveaux coupons';
$string['coupon_generation_method'] = 'Méthode de génération';
$string['coupon_generation_method_help'] = 'Choisissez si vous souhaitez créer un coupon unique avec un code personnalisé ou générer un nombre de coupons aléatoires';
$string['coupon_generation_title'] = 'Générer des coupons';
$string['coupon_generator_error'] = 'Erreur lors de la génération des coupons.';
$string['coupon_generator_nonumber'] = 'Aucun nombre de coupons spécifié.';
$string['coupon_generator_peruser_gt_max'] = 'Le nombre maximal d’utilisations par utilisateur ne doit pas dépasser le nombre maximal d’utilisations d’un coupon.';
$string['coupon_invalidid'] = 'Aucun enregistrement de coupon avec cet identifiant ou il ne correspond pas au code.';
$string['coupon_invalidrecord'] = 'Enregistrement de coupon invalide.';
$string['coupon_invalidreturntype'] = 'Type de coupon renvoyé invalide, erreur d’API ou code coupon non valide.';
$string['coupon_invalidtype'] = 'Type de coupon invalide, seuls « fixe », « pourcentage », « inscription » et « catégorie » sont autorisés.';
$string['coupon_nocode'] = 'Aucun code.';
$string['coupon_notexist'] = 'Ce coupon n’existe pas';
$string['coupon_notvalidyet'] = 'Ce coupon n’est pas valide avant le {$a}';
$string['coupon_novalue'] = 'Le coupon n’a renvoyé aucune valeur, probablement que le code n’existe pas';
$string['coupon_perpage'] = 'Coupons par page';
$string['coupon_resetusetime'] = 'Réinitialiser l’utilisation';
$string['coupon_resetusetime_help'] = 'Réinitialise l’utilisation du coupon à zéro.';
$string['coupon_t_code'] = 'Code';
$string['coupon_t_lastuse'] = 'Dernière utilisation';
$string['coupon_t_timecreated'] = 'Date de création';
$string['coupon_t_type'] = 'Type';
$string['coupon_t_usage'] = 'Utilisation';
$string['coupon_t_value'] = 'Valeur';
$string['coupon_table'] = 'Voir les coupons du portefeuille';
$string['coupon_type'] = 'Type de coupons';
$string['coupon_type_help'] = 'Choisissez le type de coupons à générer.
Coupons à valeur fixe : utilisables partout et rechargent le portefeuille de l’utilisateur de leur valeur ; utilisés sur la page d’inscription, ils inscrivent l’utilisateur si la valeur est suffisante.
Coupons à pourcentage : appliquent une remise en pourcentage sur le coût du cours.
Coupons de catégorie : identiques aux coupons fixes, mais utilisables uniquement pour inscrire l’utilisateur dans la catégorie sélectionnée.
Coupons de cours : n’ont pas de valeur, servent uniquement à inscrire l’utilisateur à un des cours sélectionnés.';
$string['coupon_update_failed'] = 'Échec de la mise à jour du coupon.';
$string['coupon_update_success'] = 'Le coupon a été mis à jour avec succès.';
$string['coupon_usage'] = 'Historique d’utilisation des coupons';
$string['coupon_usetimes'] = 'Nombre d’utilisations';
$string['coupon_value'] = 'Valeur du coupon';
$string['coupon_value_help'] = 'Valeur du coupon (fixe ou pourcentage de remise).';
$string['coupons'] = 'Coupons';
$string['coupons_category_error'] = 'Une catégorie doit être sélectionnée';
$string['coupons_courseserror'] = 'Vous devez sélectionner au moins un cours.';
$string['coupons_delete_selected'] = 'Supprimer les coupons sélectionnés';
$string['coupons_discount_error'] = 'La valeur de la remise ne peut pas dépasser 100 %';
$string['coupons_generation_success'] = '{$a} codes coupons générés avec succès.';
$string['coupons_generation_taskcreated'] = '{$a->count} tâches de génération de coupons en cours de traitement en arrière-plan, vérifiez ce lien ultérieurement : {$a->link}.';
$string['coupons_ids'] = 'Identifiants de coupons séparés par (,)';
$string['coupons_length'] = 'Longueur';
$string['coupons_length_help'] = 'Nombre de caractères dans un coupon';
$string['coupons_maxperuser'] = 'Utilisation maximale / utilisateur';
$string['coupons_maxperuser_help'] = 'Nombre de fois qu’un utilisateur peut utiliser ce coupon (0 = maximum autorisé).';
$string['coupons_maxusage'] = 'Utilisation maximale';
$string['coupons_maxusage_help'] = 'Nombre de fois que le coupon peut être utilisé (0 = illimité).';
$string['coupons_number'] = 'Nombre de coupons';
$string['coupons_number_help'] = 'Veuillez ne pas définir un nombre trop élevé afin de ne pas surcharger la base de données.';
$string['coupons_uploadcreated'] = '{$a} coupons ont été créés avec succès.';
$string['coupons_uploaderrors'] = '{$a} coupons contiennent des erreurs et n’ont pas été créés ni mis à jour.';
$string['coupons_uploadtotal'] = '{$a} coupons au total dans le fichier.';
$string['coupons_uploadupdated'] = '{$a} coupons ont été mis à jour avec succès.';
$string['coupons_valueerror'] = 'Valeur requise';
$string['couponsall'] = 'Autoriser tous les types';
$string['couponsdeleted'] = '{$a} coupons ont été supprimés avec succès';
$string['couponsdiscount'] = 'Coupons de remise uniquement';
$string['couponsfixed'] = 'Coupons à montant fixe uniquement';
$string['couponstype'] = 'Autoriser les coupons';
$string['couponstype_help'] = 'Choisissez de désactiver les coupons, d’autoriser certains types ou de tout autoriser.';
$string['courses_options'] = 'Cours';
$string['courses_options_help'] = 'Choisissez les cours dans lesquels inscrire directement l’utilisateur en utilisant ces coupons.';
$string['coursesrestriction'] = 'Autre restriction de cours';
$string['coursesrestriction_help'] = 'Seuls les utilisateurs inscrits à un nombre de cours supérieur ou égal au requis parmi ceux sélectionnés peuvent acheter ce cours.';
$string['coursesrestriction_num'] = 'Nombre de cours requis';
$string['coursesrestriction_num_help'] = 'Sélectionnez le nombre minimal de cours auquel l’utilisateur doit être inscrit pour pouvoir acheter ce cours via cette instance.';
$string['courseswithdiscounts'] = 'Cours disponibles avec remises';
$string['createdfrom'] = 'Créé après';
$string['createdto'] = 'Créé avant';
$string['credit'] = 'Crédit';
$string['credit_cost'] = 'Coût';
$string['credit_cost_help'] = 'Les frais qui seront déduits lors de l’inscription.';
$string['credit_wallet_transformation_desc'] = 'Votre crédit a été transféré vers votre portefeuille.';
$string['csvfile'] = 'Fichier CSV';
$string['csvfile_help'] = 'Seuls les fichiers avec l’extension *.csv sont acceptés';
$string['currency'] = 'Devise';
$string['currency_help'] = 'Sélectionnez la devise pour le paiement du cours.';
$string['customcurrency'] = 'Devise personnalisée';
$string['customcurrency_desc'] = 'Ajout d’un nom de devise personnalisée pour le crédit du portefeuille.
Remarque : ceci n’est pas valide si une passerelle de paiement est utilisée.
Si laissé vide, une devise "Pièces du portefeuille" sera ajoutée à la liste des devises.';
$string['customcurrencycode'] = 'Code de devise personnalisée';
$string['customcurrencycode_desc'] = 'Ajout d’un code pour la devise personnalisée (ex. USD). Assurez-vous que ce code n’existe pas déjà dans les passerelles de paiement disponibles, car il ne sera pas remplacé. Vous pouvez toutefois remplacer la devise "Moodle Wallet Coin (MWC)".';
$string['customwelcomemessage'] = 'Message de bienvenue personnalisé';
$string['customwelcomemessage_help'] = 'Un message de bienvenue personnalisé peut être ajouté en texte brut ou en format automatique Moodle, incluant des balises HTML et multi-langues.

Les variables suivantes peuvent être incluses :
* Nom du cours {$a->coursename}
* Lien vers le profil de l’utilisateur {$a->profileurl}
* Email de l’utilisateur {$a->email}
* Nom complet de l’utilisateur {$a->fullname}';
$string['datefrom'] = 'De';
$string['dateto'] = 'À';
$string['debit'] = 'Débit';
$string['debitdesc_course'] = 'L’utilisateur a été débité de {$a->amount} pour l’inscription au cours {$a->coursename}';
$string['debitdesc_instance'] = 'L’utilisateur a été débité de {$a->amount} pour l’inscription au cours {$a->coursename} via l’instance {$a->instance}';
$string['debitdesc_user'] = 'L’utilisateur a été débité de {$a->amount} par l’utilisateur {$a->charger}';
$string['debitnegative'] = 'Autoriser le débit négatif';
$string['defaultrole'] = 'Rôle attribué par défaut';
$string['defaultrole_desc'] = 'Sélectionnez le rôle à attribuer aux utilisateurs lors de l’inscription';
$string['deleteselectedusers'] = 'Supprimer les inscriptions des utilisateurs sélectionnés';
$string['digits'] = 'Chiffres (nombres)';
$string['discount'] = 'remise';
$string['discount_behavior'] = 'Comportement des remises';
$string['discount_behavior_desc'] = 'Les utilisateurs peuvent être éligibles à plusieurs remises ou règles d’offre. Choisissez comment elles seront calculées :
* récursive : la remise est recalculée après chaque réduction appliquée.
* somme : toutes les remises sont additionnées (max 100 %) puis appliquées.
* max : seule la remise la plus élevée est appliquée.';
$string['discount_behavior_max'] = 'Appliquer la remise maximale';
$string['discount_behavior_sequential'] = 'Appliquer les remises séquentiellement';
$string['discount_behavior_sum'] = 'Appliquer la somme des remises';
$string['discountcoupondisabled'] = 'Les coupons de remise sont désactivés sur ce site.';
$string['discounts'] = 'Remises';
$string['discountscopouns'] = 'Remises et Coupons';
$string['discountscopouns_desc'] = 'Choisissez si vous voulez appliquer des remises en pourcentage aux utilisateurs via un champ de profil personnalisé.
Vous pouvez aussi activer l’utilisation de coupons pour ce plugin.';
$string['editselectedusers'] = 'Modifier les inscriptions des utilisateurs sélectionnés';
$string['enablerefund'] = 'Activer le remboursement';
$string['enablerefund_desc'] = 'Si non coché, tous les crédits seront désormais non remboursables. N’oubliez pas de l’indiquer clairement dans la politique de remboursement.';
$string['endpoint_error'] = 'L’API a renvoyé une erreur';
$string['endpoint_incorrect'] = 'Réponse incorrecte';
$string['enrol_type'] = 'Type d’inscription';
$string['enrol_wallet'] = 'Inscription avec le solde du portefeuille';
$string['enrolcoupon'] = 'Coupon d’inscription';
$string['enrolcoupondisabled'] = 'Les coupons d’inscription sont désactivés sur ce site.';
$string['enrolenddate'] = 'Date de fin';
$string['enrolenddate_help'] = 'Si activé, les utilisateurs peuvent s’inscrire jusqu’à cette date uniquement.';
$string['enrolenddaterror'] = 'La date de fin d’inscription ne peut pas être antérieure à la date de début';
$string['enrollmentupdated'] = 'inscription(s) mise(s) à jour';
$string['enrolme'] = 'M’inscrire';
$string['enrolpage_viewed_desc'] = 'L’utilisateur avec l’ID {$a->userid} a consulté la page d’inscription du cours avec l’ID {$a->courseid}.';
$string['enrolpage_viewed_event'] = 'Options d’inscription via portefeuille consultées.';
$string['enrolperiod'] = 'Durée d’inscription';
$string['enrolperiod_desc'] = 'Durée par défaut pendant laquelle l’inscription est valide. Si définie à 0, la durée est illimitée par défaut.';
$string['enrolperiod_help'] = 'Durée pendant laquelle l’inscription est valide, à partir du moment où l’utilisateur s’inscrit. Si désactivée, la durée est illimitée.';
$string['enrolstartdate'] = 'Date de début';
$string['enrolstartdate_help'] = 'Si activé, les utilisateurs peuvent s’inscrire à partir de cette date uniquement.';
$string['entervalue'] = 'Veuillez saisir une valeur.';
$string['equalsto'] = 'Égal à';
$string['event_award'] = 'Récompense portefeuille reçue';
$string['event_award_desc'] = 'L’utilisateur avec l’ID {$a->userid} a reçu une récompense de {$a->amount} pour avoir obtenu {$a->grade}% dans le cours avec l’ID {$a->courseid}.';
$string['event_cashback'] = 'Cashback portefeuille';
$string['event_cashback_desc'] = 'L’utilisateur avec l’ID {$a->userid} a reçu un cashback de {$a->amount} après avoir payé {$a->original} pour s’inscrire au cours avec l’ID {$a->courseid}.';
$string['event_coupon'] = 'Coupon portefeuille utilisé';
$string['event_coupon_desc'] = 'Le coupon ({$a->code}) a été utilisé par l’utilisateur avec l’ID {$a->userid}.';
$string['event_newuser_gifted'] = 'Nouvel utilisateur crédité';
$string['event_newuser_gifted_desc'] = 'Nouvel utilisateur avec l’ID {$a->userid} crédité de {$a->amount} en solde de portefeuille.';
$string['event_transaction_credit_description'] = 'Le solde portefeuille de l’utilisateur avec l’ID {$a->relateduserid} a été crédité de {$a->amount} {$a->refundable} par l’utilisateur {$a->userid}.
Info : {$a->reason}';
$string['event_transaction_debit_description'] = 'Le solde portefeuille de l’utilisateur avec l’ID {$a->relateduserid} a été débité de {$a->amount} par l’utilisateur {$a->userid}.
Info : {$a->reason}';
$string['event_transactions'] = 'Événement de transaction du portefeuille';
$string['expiredaction'] = 'Action à l’expiration de l’inscription';
$string['expiredaction_help'] = 'Sélectionnez l’action à effectuer lorsque l’inscription d’un utilisateur expire. Notez que certaines données et paramètres de l’utilisateur sont supprimés du cours lors de la désinscription.';
$string['expirymessageenrolledbody'] = 'Cher {$a->user},
Ceci est une notification indiquant que votre inscription au cours « {$a->course} » expirera le {$a->timeend}.
Si vous avez besoin d’aide, contactez {$a->enroller}.';
$string['expirymessageenrolledsubject'] = 'Notification d’expiration d’inscription';
$string['expirymessageenrollerbody'] = 'L’inscription au cours « {$a->course} » expirera dans {$a->threshold} pour les utilisateurs suivants :
{$a->users} Pour prolonger leur inscription, allez à {$a->extendurl}.';
$string['expirymessageenrollersubject'] = 'Avis d\'expiration de l\'inscription';
$string['filter_coupons'] = 'Filtrer les coupons';
$string['filter_transaction'] = 'Filtrer les transactions';
$string['fixedcoupondisabled'] = 'Les coupons à valeur fixe sont désactivés sur ce site.';
$string['fixedvaluecoupon'] = 'Coupon à valeur fixe';
$string['freecourses'] = 'Cours gratuits sur ce site';
$string['frontpageoffers'] = 'Lien vers la page des offres dans la navigation de la page d’accueil';
$string['frontpageoffers_desc'] = 'Ajouter un lien vers la page des offres dans la navigation de la page d’accueil';
$string['giftdesc'] = 'Nouvel utilisateur avec l’ID {$a->userid} à {$a->time} a reçu un cadeau de {$a->amount} dans son portefeuille.';
$string['giftvalue'] = 'Valeur du cadeau pour les nouveaux utilisateurs';
$string['giftvalue_help'] = 'La valeur qui sera ajoutée au portefeuille des nouveaux utilisateurs.';
$string['greaterthan'] = 'Supérieur à';
$string['greaterthanorequal'] = 'Supérieur ou égal à';
$string['insufficient_balance'] = 'Solde insuffisant pour vous inscrire. {$a->cost_before} {$a->currency} sont requis, votre solde est de {$a->user_balance} {$a->currency}.';
$string['insufficient_balance_discount'] = 'Solde insuffisant pour vous inscrire. <del>{$a->cost_before} {$a->currency}</del> {$a->cost_after} {$a->currency} sont requis, votre solde est de {$a->user_balance} {$a->currency}.';
$string['insufficientbalance'] = 'Désolé, votre solde est insuffisant pour cette opération. Vous avez besoin de {$a->amount} alors que vous n’avez que {$a->balance}.';
$string['invalidcoupon_operation'] = 'Opération de coupon invalide. Ce type de coupon est peut-être désactivé sur ce site ou mal configuré.';
$string['invalidpercentcoupon'] = 'Valeur invalide pour un coupon en pourcentage, elle ne peut pas dépasser 100.';
$string['invalidvalue'] = 'Valeur invalide, veuillez entrer une valeur valide.';
$string['inyourwallet'] = 'dans votre portefeuille.';
$string['longtimenosee'] = 'Désinscrire les inactifs après';
$string['longtimenosee_help'] = 'Si des utilisateurs n’ont pas accédé à un cours pendant une longue période, ils sont automatiquement désinscrits. Ce paramètre définit cette limite de temps.';
$string['lowbalancenotice'] = 'Activer l’avertissement de solde faible';
$string['lowbalancenotification'] = 'Solde faible du portefeuille
Votre solde est de {$a}.';
$string['lowbalancenotify'] = 'Notification de solde faible.';
$string['lowbalancenotify_desc'] = 'Si activé et que le solde de l’utilisateur est inférieur ou égal à la condition, un avertissement s’affiche sur chaque page du site.';
$string['lowerletters'] = 'minuscules';
$string['mainbalance'] = 'Solde principal :';
$string['manualrefundboxlabel'] = 'Cochez la case suivante pour afficher les options de recharge.';
$string['maxenrolled'] = 'Nombre maximal d’utilisateurs inscrits';
$string['maxenrolled_help'] = 'Définit le nombre maximal d’utilisateurs pouvant s’inscrire. 0 signifie illimité.';
$string['maxenrolledreached'] = 'Le nombre maximum d’utilisateurs autorisés à s’inscrire a déjà été atteint.';
$string['messagebody_credit'] = 'Votre portefeuille a été crédité de {$a->amount}
Votre solde précédent était de {$a->before}
Votre solde actuel est : {$a->balance}
Plus d’infos : {$a->desc}. à : {$a->time}';
$string['messagebody_debit'] = 'Un montant de {$a->amount} a été débité de votre portefeuille
Votre solde précédent était de {$a->before}
Votre solde actuel est : {$a->balance}
Plus d’infos : {$a->desc}. à : {$a->time}';
$string['messageprovider:expiry_notification'] = 'Notifications d’expiration d’inscription portefeuille';
$string['messageprovider:wallet_transaction'] = 'Notifications de transaction portefeuille';
$string['messagesubject'] = 'Transactions du portefeuille ({$a})';
$string['migrate_enrollments_task'] = 'Migrer les inscriptions et crédits utilisateurs de enrol_credit vers enrol_wallet';
$string['mintransfer'] = 'Le montant minimum de transfert est {$a}';
$string['mintransfer_config'] = 'Transfert minimum autorisé';
$string['mintransfer_config_desc'] = 'Montant minimum de transfert autorisé. Les utilisateurs ne peuvent pas transférer un solde inférieur entre eux.';
$string['mustselectchar'] = 'Vous devez sélectionner au moins un type de caractère.';
$string['mywallet'] = 'Mon portefeuille';
$string['negativebalance'] = 'Le solde ne peut pas être négatif. Tentative de déduction de {$a->amount} depuis un solde de {$a->before}.';
$string['newenrols'] = 'Autoriser les nouvelles inscriptions';
$string['newenrols_desc'] = 'Autoriser les utilisateurs à s’inscrire par défaut aux nouveaux cours.';
$string['newenrols_help'] = 'Ce paramètre détermine si un utilisateur peut s’inscrire à ce cours.';
$string['newusergift'] = 'Cadeaux pour nouveaux utilisateurs';
$string['newusergift_desc'] = 'Appliquer un cadeau portefeuille aux nouveaux utilisateurs du site Moodle';
$string['newusergift_enable'] = 'Activer les cadeaux pour nouveaux utilisateurs';
$string['newusergift_enable_help'] = 'Si activé, les nouveaux utilisateurs recevront le cadeau défini dans leur portefeuille.';
$string['noaccount'] = 'Aucun compte';
$string['nochange'] = 'Aucun changement';
$string['nocost'] = 'Ce cours a un coût invalide';
$string['nocoupons'] = 'Désactiver les coupons';
$string['nodiscountstoshow'] = 'Aucune remise à afficher.';
$string['nonrefundable'] = 'Non remboursable';
$string['nonrefundable_transform_desc'] = 'Transformer la transaction en non remboursable en raison de l’expiration de la période de remboursement.';
$string['noreferraldata'] = 'Aucun parrainage passé.';
$string['not_set'] = 'Non défini';
$string['notequal'] = 'Différent de';
$string['noticecondition'] = 'Solde minimum pour notifier';
$string['noticecondition_desc'] = 'Si le solde est inférieur ou égal à cette condition, une notification est affichée à l’utilisateur.';
$string['notrefund'] = 'Non remboursable (supplémentaire) :';
$string['offers'] = 'Offres';
$string['offers_ce_desc'] = '{$a->discount}% de RÉDUCTION si vous êtes inscrit à {$a->condition} de ces cours :
{$a->courses}';
$string['offers_course_enrol_based'] = 'Offre basée sur une autre inscription à un cours';
$string['offers_desc'] = 'Offres et cours gratuits';
$string['offers_error_ce'] = 'Veuillez sélectionner au moins un cours';
$string['offers_error_discountvalue'] = 'Valeur de remise invalide.';
$string['offers_error_ncnumber'] = 'Veuillez choisir un nombre de cours.';
$string['offers_error_otherccoursesexceed'] = 'Ce nombre dépasse le nombre réel de cours dans cette catégorie';
$string['offers_error_othercnocourses'] = 'Veuillez sélectionner un nombre de cours.';
$string['offers_error_othercnotexist'] = 'La catégorie n’existe pas.';
$string['offers_error_pfnovalue'] = 'Veuillez saisir une valeur.';
$string['offers_error_pfselect'] = 'Veuillez sélectionner un champ de profil';
$string['offers_error_timefrom'] = 'L’heure ne peut pas dépasser le « jusqu’à ».';
$string['offers_error_timeto'] = 'Impossible de sélectionner une date dans le passé.';
$string['offers_location_based'] = 'Offre basée sur la géolocalisation';
$string['offers_nc_desc'] = '{$a->discount}% de RÉDUCTION si vous êtes déjà inscrit à au moins {$a->number} cours dans la catégorie {$a->catname}';
$string['offers_number_courses_base'] = 'Offre basée sur le nombre de cours';
$string['offers_other_category_courses_based'] = 'Nombre de cours dans une autre catégorie';
$string['offers_pf_desc'] = '{$a->discount}% de RÉDUCTION si votre champ de profil {$a->field} {$a->op} « {$a->value} »';
$string['offers_pfop_contains'] = 'Contient';
$string['offers_pfop_doesnotcontain'] = 'Ne contient pas';
$string['offers_pfop_endswith'] = 'Se termine par';
$string['offers_pfop_isempty'] = 'Est vide';
$string['offers_pfop_isequalto'] = 'Est égal à';
$string['offers_pfop_isnotempty'] = 'N’est pas vide';
$string['offers_pfop_startswith'] = 'Commence par';
$string['offers_please_select'] = 'Veuillez sélectionner un type d’offre à ajouter';
$string['offers_profile_field'] = 'Champ de profil';
$string['offers_profile_field_based'] = 'Offre basée sur un champ de profil';
$string['offers_time_based'] = 'Remise sur une période donnée';
$string['offers_time_desc'] = '{$a->discount}% de RÉDUCTION si vous achetez ce cours entre {$a->from} et {$a->to}';
$string['offersnav'] = 'Ajouter les offres dans la navigation principale';
$string['offersnav_desc'] = 'ou cliquez ici pour ajouter les offres à la navigation principale';
$string['othercourserestriction'] = 'Impossible de vous inscrire à ce cours sauf si vous êtes inscrit à au moins {$a->number} de ces cours {$a->courses}';
$string['paymentaccount'] = 'Compte de paiement';
$string['paymentaccount_help'] = 'Choisissez le compte de paiement dans lequel vous accepterez les paiements';
$string['paymentrequired'] = 'Vous pouvez payer ce cours directement en utilisant les moyens de paiement disponibles';
$string['paymenttopup_desc'] = 'Paiement pour recharger le portefeuille';
$string['percent_error'] = 'La valeur en pourcentage doit être comprise entre 0 et 100';
$string['percentcoupondisabled'] = 'Les coupons de remise sont désactivés sur ce site.';
$string['percentdiscountcoupon'] = 'Coupon de remise en pourcentage';
$string['pluginconfig'] = 'Configuration de l’inscription via portefeuille';
$string['pluginname'] = 'Inscription via portefeuille';
$string['pluginname_desc'] = 'Description du plugin d’inscription via portefeuille';
$string['privacy:metadata'] = 'Le plugin d’inscription Wallet n’enregistre aucune donnée personnelle.';
$string['privacy:metadata:enrol_wallet_awards'] = 'Contient des informations sur les récompenses que l’utilisateur reçoit.';
$string['privacy:metadata:enrol_wallet_awards:amount'] = 'Le montant de la récompense.';
$string['privacy:metadata:enrol_wallet_awards:courseid'] = 'L’ID du cours complété.';
$string['privacy:metadata:enrol_wallet_awards:grade'] = 'La note totale obtenue par l’utilisateur dans le cours.';
$string['privacy:metadata:enrol_wallet_awards:userid'] = 'L’ID de l’utilisateur.';
$string['privacy:metadata:enrol_wallet_balance'] = 'Contient les détails du solde de l’utilisateur';
$string['privacy:metadata:enrol_wallet_balance:catbalance'] = 'Toutes les informations sur les soldes par catégorie';
$string['privacy:metadata:enrol_wallet_balance:freegift'] = 'Part du solde du site obtenue grâce à des cadeaux';
$string['privacy:metadata:enrol_wallet_balance:nonrefundable'] = 'Le montant non remboursable dans le solde du site';
$string['privacy:metadata:enrol_wallet_balance:refundable'] = 'Le montant remboursable dans le solde du site';
$string['privacy:metadata:enrol_wallet_balance:userid'] = 'L’ID de l’utilisateur';
$string['privacy:metadata:enrol_wallet_cond_discount'] = 'Règles de remise conditionnelle, cela ne contient aucune information personnelle';
$string['privacy:metadata:enrol_wallet_cond_discount:usermodified'] = 'L’ID de l’utilisateur ayant modifié la règle de remise';
$string['privacy:metadata:enrol_wallet_coupons_usage'] = 'Contient des informations sur les coupons utilisés par chaque utilisateur.';
$string['privacy:metadata:enrol_wallet_coupons_usage:instanceid'] = 'L’ID de l’instance où le coupon a été utilisé.';
$string['privacy:metadata:enrol_wallet_coupons_usage:userid'] = 'L’ID de l’utilisateur.';
$string['privacy:metadata:enrol_wallet_hold_gift'] = 'Stocke les informations sur les cadeaux de parrainage en attente.';
$string['privacy:metadata:enrol_wallet_hold_gift:amount'] = 'Le montant du cadeau de parrainage.';
$string['privacy:metadata:enrol_wallet_hold_gift:courseid'] = 'L’ID du cours dans lequel l’utilisateur parrainé s’est inscrit et a reçu le cadeau.';
$string['privacy:metadata:enrol_wallet_hold_gift:referred'] = 'Le nom d’utilisateur de l’utilisateur parrainé.';
$string['privacy:metadata:enrol_wallet_hold_gift:referrer'] = 'L’ID de l’utilisateur parrain.';
$string['privacy:metadata:enrol_wallet_items'] = 'Stocke quelques informations non critiques avant chaque paiement : montant, devise et objet du paiement de l’utilisateur.';
$string['privacy:metadata:enrol_wallet_items:cost'] = 'Le coût de l’élément (soit un faux élément de recharge, soit une instance d’inscription).';
$string['privacy:metadata:enrol_wallet_items:currency'] = 'La devise de l’élément.';
$string['privacy:metadata:enrol_wallet_items:instanceid'] = 'L’ID de l’instance d’inscription si elle existe.';
$string['privacy:metadata:enrol_wallet_items:userid'] = 'L’ID de l’utilisateur.';
$string['privacy:metadata:enrol_wallet_referral'] = 'Contient des informations sur le programme de parrainage.';
$string['privacy:metadata:enrol_wallet_referral:code'] = 'Un code de parrainage unique.';
$string['privacy:metadata:enrol_wallet_referral:userid'] = 'L’ID de l’utilisateur.';
$string['privacy:metadata:enrol_wallet_referral:users'] = 'Les noms d’utilisateurs des personnes parrainées par cet utilisateur.';
$string['privacy:metadata:enrol_wallet_referral:usetimes'] = 'Le nombre de fois que l’utilisateur a utilisé le code.';
$string['privacy:metadata:enrol_wallet_transactions'] = 'Contient des informations sur chaque transaction du portefeuille.';
$string['privacy:metadata:enrol_wallet_transactions:amount'] = 'Le montant de la transaction.';
$string['privacy:metadata:enrol_wallet_transactions:balance'] = 'Le solde après transaction.';
$string['privacy:metadata:enrol_wallet_transactions:balbefore'] = 'Le solde avant transaction.';
$string['privacy:metadata:enrol_wallet_transactions:description'] = 'La description de la transaction, incluant des détails sur le cours ou la méthode utilisée par l’utilisateur pour recharger son portefeuille.';
$string['privacy:metadata:enrol_wallet_transactions:norefund'] = 'Si le montant de cette transaction est remboursable ou non.';
$string['privacy:metadata:enrol_wallet_transactions:type'] = 'Le type de la transaction (débit ou crédit).';
$string['privacy:metadata:enrol_wallet_transactions:userid'] = 'L’ID de l’utilisateur.';
$string['privacy:metadata:wordpress'] = 'Contient des informations critiques sur l’utilisateur envoyées au site WordPress lié pour y créer automatiquement un compte utilisateur.';
$string['privacy:metadata:wordpress:email'] = 'L’adresse e-mail.';
$string['privacy:metadata:wordpress:password'] = 'Le mot de passe brut lors de la création de l’utilisateur, ou une chaîne aléatoire si l’utilisateur existe déjà.';
$string['privacy:metadata:wordpress:userid'] = 'L’ID de l’utilisateur.';
$string['privacy:metadata:wordpress:username'] = 'Le nom d’utilisateur.';
$string['profile_field_map'] = 'Mappage du champ de profil';
$string['profile_field_map_help'] = 'Sélectionnez le champ de profil qui stocke les informations sur les remises dans les profils des utilisateurs.';
$string['purchase'] = 'Achat';
$string['purchasedescription'] = 'Inscription au cours {$a}';
$string['randomcoupons'] = 'Coupons aléatoires';
$string['receiver'] = 'Destinataire';
$string['referral'] = 'Parrainage';
$string['referral_amount'] = 'Montant du parrainage.';
$string['referral_amount_desc'] = 'Le montant du cadeau que le parrain et le parrainé recevront dans leurs portefeuilles.';
$string['referral_amount_help'] = 'Le montant du cadeau que vous et le nouvel utilisateur recevrez dans le portefeuille.';
$string['referral_code'] = 'Code de parrainage';
$string['referral_code_help'] = 'Au lieu d’envoyer l’URL de parrainage, vous pouvez transmettre ce code que le nouvel utilisateur saisira lors de son inscription.';
$string['referral_code_signup'] = 'Code de parrainage à l’inscription';
$string['referral_code_signup_help'] = 'Si ce champ est vide, saisissez un code de parrainage pour recevoir le cadeau.';
$string['referral_copied'] = 'Copié !';
$string['referral_copy_to_clipboard'] = 'Copier dans le presse-papier';
$string['referral_data'] = 'Données de parrainage';
$string['referral_done'] = 'Cadeau accordé';
$string['referral_enabled'] = 'Activer le programme de parrainage';
$string['referral_exceeded'] = 'Le code de parrainage {$a} a dépassé son nombre maximal d’utilisations.';
$string['referral_gift'] = 'En raison d’un code de parrainage de l’utilisateur : {$a}';
$string['referral_header'] = 'Partagez un lien et gagnez des crédits dans votre portefeuille !';
$string['referral_hold'] = 'Cadeau en attente';
$string['referral_holdgift'] = 'Vous avez un cadeau en attente ({$a->amount}) grâce à l’utilisation d’un code de parrainage de {$a->name}, achetez un cours pour recevoir votre cadeau.';
$string['referral_max'] = 'Nombre maximal de parrainages';
$string['referral_max_desc'] = 'Nombre maximal de fois qu’un utilisateur peut recevoir un cadeau de parrainage (0 = illimité).';
$string['referral_noparents'] = 'Les parents ne sont pas autorisés à accéder au programme de parrainage';
$string['referral_not_enabled'] = 'Le parrainage n’est pas activé';
$string['referral_notexist'] = 'Le code : « {$a} » n’existe pas dans la base de données.';
$string['referral_notyet'] = 'Pas encore reçu !';
$string['referral_past'] = 'Parrainages passés';
$string['referral_plugins'] = 'Plugins d’inscription';
$string['referral_plugins_desc'] = 'Les utilisateurs ne reçoivent le cadeau de parrainage que lorsque l’utilisateur parrainé s’inscrit à un cours afin de s’assurer qu’il est actif.<br/>Choisissez les méthodes d’inscription permettant d’obtenir ce cadeau';
$string['referral_program'] = 'Programme de parrainage';
$string['referral_program_desc'] = 'Les utilisateurs existants peuvent parrainer de nouveaux utilisateurs pour rejoindre ce site et les deux recevront un cadeau.';
$string['referral_remain'] = 'Parrainages restants.';
$string['referral_remain_help'] = 'Nombre de fois restant pour recevoir le cadeau de parrainage.';
$string['referral_share_body'] = 'Bonjour,

Vous avez été invité à rejoindre {$a->site} et à recevoir {$a->amount} en cadeau de bienvenue dans votre portefeuille.

Veuillez utiliser le lien suivant pour vous inscrire :

{$a->url}';
$string['referral_share_subject'] = 'Rejoignez {$a->site} et recevez un crédit gratuit dans votre portefeuille.';
$string['referral_site_desc'] = 'Ce site dispose d’un programme de parrainage : envoyez le code à vos amis et, dès qu’ils rejoignent au moins un cours, vous recevrez tous les deux un cadeau dans vos portefeuilles.';
$string['referral_subheader'] = 'Partagez simplement un lien et, lorsqu’une personne s’inscrit et achète un cours, vous recevrez {$a} dans votre portefeuille.';
$string['referral_timecreated'] = 'Date d’inscription';
$string['referral_timereleased'] = 'Offert le :';
$string['referral_topup'] = 'En raison d’un parrainage de l’utilisateur : {$a}.';
$string['referral_url'] = 'URL de parrainage';
$string['referral_url_help'] = 'Envoyez cette URL à votre ami pour qu’il s’inscrive sur ce site et reçoive un cadeau de parrainage dans son portefeuille.';
$string['referral_user'] = 'Parrainages';
$string['refundperiod'] = 'Délai de remboursement';
$string['refundperiod_desc'] = 'Délai après lequel l’utilisateur ne peut plus être remboursé pour avoir rechargé son portefeuille. 0 = remboursement possible à tout moment.';
$string['refundpolicy'] = 'Politique de remboursement manuel';
$string['refundpolicy_default'] = '<h5>Politique de remboursement</h5> Veuillez noter :
Le paiement pour recharger votre portefeuille ne peut pas être remboursé dans les cas suivants :
1- Si ce montant provient d’un cadeau de nouvel utilisateur, d’une récompense ou d’un cashback.
2- Si le délai de remboursement (14 jours) a expiré.
3- Toute somme déjà utilisée pour une inscription n’est pas remboursable.
Recharger votre portefeuille par tout moyen implique votre accord à cette politique.';
$string['refundpolicy_help'] = 'Définissez une politique de remboursement personnalisée afin que les utilisateurs connaissent les conditions de remboursement avant de recharger leur portefeuille. Cette politique sera affichée lors des recharges ou de la consultation du solde.';
$string['refunduponunenrol_desc'] = 'Remboursé d’un montant de {$a->credit} après déduction des frais de désinscription de {$a->fee} pour le cours : {$a->coursename}.';
$string['repurchase'] = 'Racheter';
$string['repurchase_desc'] = 'Paramètres pour racheter les cours. Si activé, les utilisateurs peuvent racheter les cours une fois leur période d’inscription terminée.';
$string['repurchase_firstdis'] = 'Première remise lors du rachat';
$string['repurchase_firstdis_desc'] = 'Si défini, les utilisateurs bénéficieront de cette remise en pourcentage (0 - 100) lors de leur deuxième achat du cours.';
$string['repurchase_seconddis'] = 'Deuxième remise lors du rachat';
$string['repurchase_seconddis_desc'] = 'Lors du troisième achat du cours (deuxième rachat), les utilisateurs bénéficieront de cette remise (doit être comprise entre 0 et 100).';
$string['restrictionenabled'] = 'Activer les restrictions.';
$string['restrictionenabled_desc'] = 'Si désactivé, aucune restriction ne sera vérifiée.';
$string['restrictions'] = 'Restrictions d’inscription';
$string['restrictions_desc'] = 'Comme pour les sections et modules de cours, Wallet Enrolment offre désormais la possibilité d’ajouter des restrictions à l’inscription. Tous les plugins de disponibilité n’ont pas été testés correctement, vous pouvez donc choisir ici ce qui fonctionne bien et signaler toute erreur pour améliorer cette fonctionnalité.';
$string['role'] = 'Rôle attribué par défaut';
$string['selectuser'] = 'Veuillez sélectionner un utilisateur.';
$string['sendcoursewelcomemessage'] = 'Envoyer un message de bienvenue au cours';
$string['sendcoursewelcomemessage_help'] = 'Lorsqu’un utilisateur s’inscrit au cours, un message de bienvenue peut lui être envoyé par e-mail. Si le message est envoyé depuis le contact du cours (par défaut l’enseignant) et que plusieurs utilisateurs ont ce rôle, l’e-mail est envoyé par le premier utilisateur assigné au rôle.';
$string['sender'] = 'Expéditeur';
$string['sendexpirynotificationstask'] = 'Tâche d’envoi des notifications d’expiration de l’inscription Wallet';
$string['sendpaymentbutton'] = 'Paiement direct';
$string['share_referral'] = 'Partager avec des amis';
$string['showbalance'] = 'Afficher le solde';
$string['showprice'] = 'Afficher le prix sur l’icône d’inscription';
$string['showprice_desc'] = 'Si sélectionné, le prix du cours sera affiché sur l’icône d’inscription dans la carte du cours.';
$string['singlecoupon'] = 'Coupon unique';
$string['smallerthan'] = 'Inférieur à';
$string['smallerthanorequal'] = 'Inférieur ou égal à';
$string['sourcemoodle'] = 'Portefeuille interne Moodle';
$string['sourcewordpress'] = 'Portefeuille externe Tera-wallet (WooWallet)';
$string['status'] = 'Autoriser les inscriptions existantes';
$string['status_desc'] = 'Activer la méthode d’inscription par portefeuille dans les nouveaux cours.';
$string['status_help'] = 'Si activé avec « Autoriser les nouvelles inscriptions » désactivé, seuls les utilisateurs déjà inscrits pourront accéder au cours. Si désactivé, cette méthode d’inscription est totalement désactivée, car toutes les inscriptions existantes sont suspendues et les nouveaux utilisateurs ne peuvent pas s’inscrire.';
$string['submit_coupongenerator'] = 'Créer';
$string['syncenrolmentstask'] = 'Tâche de synchronisation des inscriptions Wallet';
$string['tellermen'] = 'Agents de recharge à afficher';
$string['tellermen_desc'] = 'Les utilisateurs sélectionnés ici seront affichés publiquement dans les options de recharge afin que les autres sachent à qui s’adresser pour recharger leur portefeuille. (Si aucun n’est sélectionné, rien ne sera affiché)';
$string['tellermen_display_guide'] = 'Besoin d’aide pour recharger votre portefeuille ? Demandez à un administrateur du portefeuille de le recharger manuellement ou de vous aider dans la procédure.';
$string['tellermen_heading'] = 'Agents de recharge';
$string['tellermen_heading_desc'] = 'Tous les utilisateurs ayant la capacité de créditer ou débiter les portefeuilles seront affichés dans le formulaire de recharge afin que les autres sachent à qui s’adresser pour recharger leur portefeuille.';
$string['topup'] = 'Recharger';
$string['topupafterdiscount'] = 'Paiement réel';
$string['topupafterdiscount_help'] = 'Montant après remise.';
$string['topupbundle'] = 'Rechargez votre portefeuille et ne payez que :';
$string['topupbycoupon'] = 'En utilisant des coupons';
$string['topupbypayment'] = 'En utilisant un paiement';
$string['topupbytellerman'] = 'Manuellement de notre côté';
$string['topupbyvc'] = 'En utilisant un transfert vers un portefeuille mobile ou Instapay';
$string['topupcoupon_desc'] = 'avec le code coupon {$a}';
$string['topupoffers'] = 'Offres de recharge du portefeuille';
$string['topupoffers_desc'] = 'En rechargeant votre portefeuille avec une valeur égale ou supérieure aux montants indiqués, vous bénéficierez de la remise correspondante et ne paierez qu’un montant réduit de ce pourcentage.';
$string['topuppayment_desc'] = 'Recharger le portefeuille en payant {$a} via une passerelle de paiement.';
$string['topupvalue'] = 'Montant de recharge';
$string['topupvalue_help'] = 'Montant de la recharge via des moyens de paiement';
$string['transaction_perpage'] = 'Transactions par page';
$string['transaction_type'] = 'Type de transaction';
$string['transactions'] = 'Transactions du portefeuille';
$string['transactions_details'] = 'Plus de détails sur la transaction';
$string['transfer'] = 'Transférer le solde à un autre utilisateur';
$string['transfer_desc'] = 'Activer ou désactiver la possibilité pour les utilisateurs de transférer leur solde à d’autres et définir les frais pour chaque opération.';
$string['transfer_enabled'] = 'Transférer à un autre utilisateur';
$string['transfer_enabled_desc'] = 'Activer ou désactiver la possibilité de transférer le solde à d’autres utilisateurs par e-mail.';
$string['transfer_notenabled'] = 'Le transfert d’utilisateur à utilisateur n’est pas activé sur ce site.';
$string['transferfee_desc'] = 'Notez qu’un montant de {$a->fee}% sera déduit de {$a->from}.';
$string['transferfee_from'] = 'Déduire les frais de :';
$string['transferfee_from_desc'] = 'Sélectionnez comment les frais sont déduits.
Depuis l’expéditeur : le montant est totalement transféré et les frais supplémentaires sont déduits de l’expéditeur.
Depuis le destinataire : le montant reçu est inférieur au montant envoyé, les frais étant déduits de ce dernier.';
$string['transferop_desc'] = 'Transfert d’un montant net de {$a->amount} avec des frais de {$a->fee} vers {$a->receiver}';
$string['transferpage'] = 'Transférer le solde';
$string['transferpercent'] = 'Pourcentage de frais de transfert';
$string['transferpercent_desc'] = 'Pour transférer un montant à un autre utilisateur, des frais en pourcentage seront déduits par défaut de l’expéditeur. Mettez 0 pour qu’aucun frais ne soit déduit.';
$string['transformation_credit_desc'] = 'Utilisez-vous enrol_credit ? Vous pouvez transformer tous les crédits utilisateurs vers leur portefeuille et migrer toutes les inscriptions et instances vers enrol_wallet. Il y a {$a->credit} instances de crédits et {$a->enrol} inscriptions à migrer.';
$string['transformation_credit_done'] = 'La transformation et la migration ont été mises en file d’attente avec succès et s’exécuteront prochainement. Veuillez vérifier ultérieurement les crédits et inscriptions.';
$string['transformation_credit_title'] = 'Transformation des crédits vers le portefeuille';
$string['turn_not_refundable_task'] = 'Rendre le solde non remboursable.';
$string['unenrol'] = 'Désinscrire un utilisateur';
$string['unenrollimitafter'] = 'Impossible de se désinscrire après :';
$string['unenrollimitafter_desc'] = 'Les utilisateurs ne peuvent plus se désinscrire après ce délai à compter de la date de début de l’inscription. 0 = illimité.';
$string['unenrollimitbefor'] = 'Impossible de se désinscrire avant :';
$string['unenrollimitbefor_desc'] = 'Les utilisateurs ne peuvent pas se désinscrire avant ce délai à compter de la date de fin de l’inscription. 0 = aucun délai.';
$string['unenrolrefund'] = 'Rembourser lors d’une désinscription ?';
$string['unenrolrefund_desc'] = 'Si activé, les utilisateurs seront remboursés s’ils se désinscrivent du cours.';
$string['unenrolrefund_head'] = 'Rembourser les utilisateurs lors d’une désinscription.';
$string['unenrolrefund_head_desc'] = 'Rembourser le montant payé pour un cours après désinscription.';
$string['unenrolrefundfee'] = 'Pourcentage de frais de remboursement';
$string['unenrolrefundfee_desc'] = 'Choisissez un pourcentage du montant qui ne sera pas remboursé après désinscription, en tant que frais.';
$string['unenrolrefundperiod'] = 'Délai de remboursement après désinscription';
$string['unenrolrefundperiod_desc'] = 'Si l’utilisateur se désinscrit dans ce délai à compter de la date de début d’inscription, il sera remboursé.';
$string['unenrolrefundpolicy'] = 'Politique de remboursement lors d’une désinscription';
$string['unenrolrefundpolicy_default'] = '<strong>Conditions de remboursement lors d’une désinscription :</strong>
Si vous vous désinscrivez dans les {period} jours suivant la date de début, vous serez remboursé du montant payé après déduction de {fee} %.
Ce montant sera restitué dans votre portefeuille et pourra être utilisé pour d’autres cours, mais ne pourra pas être remboursé manuellement.
En validant l’achat, vous acceptez ces conditions.';
$string['unenrolrefundpolicy_help'] = 'Si le remboursement lors d’une désinscription est activé, cette politique sera visible avant l’inscription avec le portefeuille.
{fee} sera remplacé par le pourcentage de frais.
{period} sera remplacé par le délai en jours.';
$string['unenrolself_notallowed'] = 'Vous ne pouvez pas vous désinscrire de ce cours.';
$string['unenrolselfconfirm'] = 'Voulez-vous vraiment vous désinscrire du cours « {$a} » ?';
$string['unenrolselfenabled'] = 'Activer la désinscription autonome';
$string['unenrolselfenabled_desc'] = 'Si activé, les utilisateurs peuvent se désinscrire eux-mêmes du cours.';
$string['unenroluser'] = 'Voulez-vous vraiment désinscrire « {$a->user} » du cours « {$a->course} » ?';
$string['unenrolusers'] = 'Désinscrire des utilisateurs';
$string['upload_coupons'] = 'Importer des coupons';
$string['upload_coupons_help'] = 'Importez des coupons dans un fichier CSV pour en ajouter ou modifier en masse. Le fichier doit contenir :
Colonnes obligatoires :
- code : le code du coupon
- value : la valeur du coupon (peut être 0 si le type est enrol)
Colonnes optionnelles :
- type : type du coupon (fixed, percent, category, enrol)
- courses : noms courts des cours (séparés par / ) si type = enrol
- category : ID de la catégorie
- maxusage : nombre maximum d’utilisations
- validfrom : date de début (timestamp)
- validto : date de fin (timestamp)
- maxperuser : nombre max d’utilisations par utilisateur
- id : ID du coupon (en cas de mise à jour)';
$string['upload_result'] = 'Résultat';
$string['uploadcsvfilerequired'] = 'Veuillez importer le fichier CSV.';
$string['upperletters'] = 'MAJUSCULES';
$string['usedfrom'] = 'Utilisé depuis';
$string['usedto'] = 'Utilisé jusqu’à';
$string['usernotexist'] = 'Utilisateur inexistant';
$string['usernotfound'] = 'Aucun utilisateur trouvé avec cet e-mail {$a}';
$string['validfrom'] = 'Valide à partir du';
$string['validto'] = 'Valide jusqu’à';
$string['value'] = 'Montant par transaction';
$string['wallet:bulkedit'] = 'Édition groupée des inscriptions dans tous les cours';
$string['wallet:config'] = 'Configurer les instances d’inscription par portefeuille';
$string['wallet:createcoupon'] = 'Créer des coupons portefeuille';
$string['wallet:creditdebit'] = 'Créditer et débiter d’autres utilisateurs';
$string['wallet:deletecoupon'] = 'Supprimer un coupon portefeuille';
$string['wallet:downloadcoupon'] = 'Télécharger des coupons portefeuille';
$string['wallet:editcoupon'] = 'Modifier les coupons';
$string['wallet:enrolself'] = 'Acheter un cours via l’instance d’inscription par portefeuille';
$string['wallet:manage'] = 'Gérer les utilisateurs inscrits';
$string['wallet:transaction'] = 'Voir le tableau des transactions';
$string['wallet:transfer'] = 'Transférer le solde du portefeuille à un autre utilisateur';
$string['wallet:unenrol'] = 'Désinscrire des utilisateurs d’un cours';
$string['wallet:unenrolself'] = 'Se désinscrire d’un cours';
$string['wallet:viewcoupon'] = 'Voir le tableau des coupons portefeuille';
$string['wallet:viewotherbalance'] = 'Voir le solde du portefeuille des autres';
$string['walletbulk'] = 'Édition groupée des instances d’inscription par portefeuille';
$string['walletcashback'] = 'Cashback pour utilisation du portefeuille';
$string['walletcashback_desc'] = 'Active le programme de cashback sur tout le site';
$string['walletcredit'] = 'Crédit du portefeuille';
$string['walletsource'] = 'Source du portefeuille';
$string['walletsource_help'] = 'Choisissez de connecter le portefeuille avec Tera Wallet (WooCommerce) externe, ou d’utiliser simplement le portefeuille interne de Moodle';
$string['welcometocourse'] = 'Bienvenue dans {$a}';
$string['welcometocoursetext'] = 'Bienvenue dans {$a->coursename} !
Si vous ne l’avez pas encore fait, veuillez modifier votre page de profil afin que nous puissions mieux vous connaître :
{$a->profileurl}';
$string['wordpress_secretkey'] = 'Clé secrète';
$string['wordpress_secretkey_help'] = 'L’administrateur doit ajouter une valeur ici, identique à celle saisie dans les paramètres moo-wallet du site WordPress.';
$string['wordpressloggins'] = 'Connexion/déconnexion de l’utilisateur à partir de WordPress';
$string['wordpressloggins_desc'] = 'Si activé, les utilisateurs sont connectés et déconnectés du site WordPress lorsqu’ils se connectent ou se déconnectent de Moodle. (attention : sens unique uniquement)';
$string['wordpressurl'] = 'URL de WordPress';
$string['wordpressurl_desc'] = 'URL du site WordPress avec le plugin Woo-Wallet (Tera Wallet) installé';
$string['wrongemailformat'] = 'Format d’adresse e-mail incorrect.';
$string['youhavebalance'] = 'Votre solde est :';
