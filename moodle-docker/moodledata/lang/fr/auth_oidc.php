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
 * Strings for component 'auth_oidc', language 'fr', version '5.1'.
 *
 * @package     auth_oidc
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['application_not_changed'] = 'Le paramètre de l’application OpenID Connect n’a pas été modifié.';
$string['application_updated'] = 'Le paramètre de l’application OpenID Connect a été mis à jour.';
$string['application_updated_microsoft'] = 'Le paramètre de l’application OpenID Connect a été mis à jour.<br/>
<span class="warning" style="color: red;">L’administrateur Azure devra <b>Fournir le consentement de l’administrateur</b> et <b>Vérifier la configuration</b> à nouveau sur la <a href="{ $a}" target="_blank">Page de configuration de l’intégration Microsoft 365</a> si les paramètres « Type de fournisseur d’identité (IdP) » ou « Méthode d’authentification client » sont mis à jour.</span>';
$string['auth_method_certificate'] = 'Certificat';
$string['auth_method_secret'] = 'Secret';
$string['auth_oidcdescription'] = 'Le plugin OpenID Connect fournit une fonctionnalité d’authentification unique à l’aide de fournisseurs d’identité configurables.';
$string['authendpoint'] = 'Point de terminaison d’autorisation';
$string['authendpoint_help'] = 'L’URI du point de terminaison d’autorisation de votre fournisseur d’identité à utiliser.<br/>
Notez que si le site doit être configuré pour autoriser l’accès aux utilisateurs d’autres locataires, le point de terminaison d’autorisation spécifique au locataire ne peut pas être utilisé.';
$string['authentication_and_endpoints_saved'] = 'Paramètres d’authentification et de point de terminaison mis à jour.';
$string['binding_username_auto'] = 'Choisir automatiquement';
$string['binding_username_claim_description'] = '<p class="warning_header">Il s\'agit d\'une fonctionnalité avancée !</p>
<p>Cette page permet aux administrateurs de site de sélectionner le jeton à utiliser pour la liaison avec le nom d\'utilisateur Moodle.</p>
<p class="warning">Soyez très prudent lorsque vous modifiez ce paramètre. Suivez les étapes ci-dessous pour le modifier sur les sites Moodle dont les utilisateurs utilisent déjà l\'authentification OpenID Connect. Le non-respect de cette procédure peut entraîner la déconnexion des utilisateurs et/ou la création de comptes en double.</p>
<ol>
<li>Assurez-vous de disposer d\'un compte administrateur de site manuel, c\'est-à-dire sans authentification OpenID Connect.</li>
<li>Planifiez un temps d\'arrêt suffisant et mettez le site Moodle en mode maintenance.</li>
<li>Sauvegardez la base de données Moodle, en particulier les tables <span class="code">user</span> et <span class="code">auth_oidc_tokens</span>. Si le plugin local_o365 est installé, sauvegardez également la table <span class="code">local_o365_objects</span>.</li>
<li>Utilisez l\'outil de mise à jour du nom d\'utilisateur de liaison</a> pour mettre à jour le nom d\'utilisateur Moodle, le jeton auth_oidc et les autres enregistrements de connexion de l\'utilisateur existant afin qu\'ils correspondent à la valeur de la revendication à modifier.</li>
<li>Mettez à jour le paramètre du jeton du nom d\'utilisateur de liaison sur cette page.</li>
<li>Purgez les caches.</li>
<li>Sortir le site Moodle du mode maintenance.</li>
</ol>
<p>Dans la plupart des cas, ce paramètre doit être défini sur l\'option par défaut « Choisir automatiquement », ce qui signifie que le plugin tentera de déterminer le jeton à utiliser en fonction du type de fournisseur d\'identité. Une mauvaise configuration ou une modification inattendue de ce paramètre entraînera l\'échec de l\'authentification unique.</p>';
$string['binding_username_claim_description_existing_claims'] = 'Les demandes suivantes sont présentes dans les jetons d\'identification utilisateur existants. Choisir des demandes non répertoriées dans la liste peut entraîner un échec de l\'authentification unique.<br/>
<div class="existing_claims">{$a}</div>';
$string['binding_username_claim_heading'] = 'Demande de nom d\'utilisateur obligatoire';
$string['binding_username_claim_help_ms_no_user_sync'] = 'Les options pour les fournisseurs d\'identité non Microsoft incluent :
<ul>
<li><b>Choisir automatiquement</b> : Utilise la logique actuelle, détermine le jeton par type de fournisseur d\'identité et revient à <b>sub</b> si aucune demande n\'est trouvée.</li>
<li><b>preferred_username</b> : Valeur par défaut pour le type de fournisseur d\'identité de la plateforme d\'identité Microsoft (v2.0). <span class="not_support_user_sync">Ne prend pas en charge la synchronisation des utilisateurs.</span></li>
<li><b>courriel</b> : Valeur de secours pour la plateforme d\'identité Microsoft (v2.0).</li>
<li><b>nom de compte utilisateur</b> : Valeur par défaut pour l\'identifiant Microsoft Entra (v1.0) et les autres types de fournisseurs d\'identité.</li>
<li><b>unique_name</b> : Valeur de secours pour l\'identifiant Microsoft Entra (v1.0) et les autres types de fournisseurs d\'identité. <span class="not_support_user_sync">Ne prend pas en charge la synchronisation des utilisateurs.</span></li>
<li><b>identificateur d\'objet</b> : Solution de secours si aucune autre demande n\'est présente. Uniquement présent dans Microsoft IdP.</li>
<li><b>sub</b> : Solution de secours si aucune autre demande n\'est présente. <span class="not_support_user_sync">Ne prend pas en charge la synchronisation des utilisateurs.</span></li>
<li><b>samaccountname</b> : Demande personnalisée.</li>
<li><b>Custom</b> : Permet à l\'administrateur du site de saisir une valeur personnalisée. <span class="not_support_user_sync">Ne prend pas en charge la synchronisation des utilisateurs.</span></li>
</ul>
Remarque : certaines options ne prennent pas en charge la synchronisation des utilisateurs.';
$string['binding_username_claim_help_ms_with_user_sync'] = 'Les options pour Microsoft IdP avec la fonction de synchronisation des utilisateurs activée sont les suivantes :
<ul>
<li><b>Choisir automatiquement</b> : Utilise la logique actuelle, détermine le jeton par type d\'IdP et revient à <b>sub</b> si aucune revendication n\'est trouvée.</li>
<li><b>courriel</b> : Solution de secours pour la plateforme d\'identité Microsoft (v2.0).</li>
<li><b>nom de compte utilisateur</b> : Valeur par défaut pour Microsoft Entra ID (v1.0) et les autres types d\'IdP.</li>
<li><b>identificateur d\'objet</b> : Solution de secours si aucune autre revendication n\'est présente. Uniquement présent dans Microsoft IdP.</li>
<li><b>nom de compte samac</b> : Demande personnalisée.</li>
</ul>';
$string['binding_username_claim_help_non_ms'] = 'Les options pour Microsoft IdP sans synchronisation des utilisateurs activée sont les suivantes :
<ul>
<li><b>Choisir automatiquement</b> : Utilise la logique actuelle, détermine le jeton par type d\'IdP et revient à <b>sub</b> si aucune revendication n\'est trouvée.</li>
<li><b>nom_utilisateur_préféré</b></li>
<li><b>courriel</b></li>
<li><b>nom_unique</b></li>
<li><b>sub</b></li>
<li><b>nom_de_compte_samac</b></li>
<li><b>personnalisé</b> : revendication personnalisée.</li>
</ul>';
$string['binding_username_claim_updated'] = 'La demande de nom d\'utilisateur de liaison a été mise à jour avec succès.';
$string['binding_username_custom'] = 'Personnalisé';
$string['bindingusernameclaim'] = 'Demande de nom d\'utilisateur obligatoire';
$string['cert_source_path'] = 'Nom du fichier';
$string['cert_source_text'] = 'Texte brut';
$string['cfg_authenticationlink_desc'] = '<a href="{$a}" target="_blank">Lien vers le fournisseur d’identité et la configuration de l’authentification</a>';
$string['cfg_autoappend_desc'] = 'Ajouter automatiquement cette chaîne lors de la connexion des utilisateurs à l’aide de la méthode d’authentification « Informations d’identification du mot de passe du propriétaire de la ressource ». Ceci est utile lorsque votre fournisseur d’identité requiert un domaine commun, mais ne veut pas obliger les utilisateurs à le saisir lors de la connexion. Par exemple, si l’utilisateur OpenID Connect complet est « james@example.com » et que vous saisissez « @example.com » ici, l’utilisateur n’aura qu’à saisir « james » comme nom d’utilisateur. <br /><b>Remarque :</b> Dans le cas où des noms d’utilisateurs en conflit existent - c’est-à-dire qu’un utilisateur Moodle existe avec le même nom, la priorité du plugin d’authentification est utilisée pour déterminer quel utilisateur l’emporte.';
$string['cfg_autoappend_key'] = 'Ajout automatique';
$string['cfg_cleanupoidctokens_desc'] = 'Si vos utilisateurs rencontrent des problèmes pour se connecter à l’aide de leur compte Microsoft 365, essayez de nettoyer les jetons OpenID Connect. Cela supprime les jetons parasites et incomplets qui peuvent provoquer des erreurs. AVERTISSEMENT : cela peut interrompre les connexions en cours, il est donc préférable de le faire hors des périodes d’utilisation.';
$string['cfg_cleanupoidctokens_key'] = 'Nettoyer les jetons de connexion OpenID';
$string['cfg_customicon_desc'] = 'Si vous souhaitez utiliser votre propre icône, téléchargez-la ici. Cela remplace toute icône choisie ci-dessus. <br /><br /><b>Remarques sur l’utilisation des icônes personnalisées :</b><ul><li>Cette image ne sera <b>pas</b> redimensionnée sur la page de connexion, nous vous recommandons donc de télécharger un image ne dépassant pas 35 x 35 pixels.</li><li>Si vous avez téléchargé une icône personnalisée et souhaitez revenir à l’une des icônes du répertoire, cliquez sur l’icône personnalisée dans la case ci-dessus, puis cliquez sur « Supprimer », puis sur « OK », puis cliquez sur « Enregistrer les modifications » au bas de ce formulaire. L’icône du répertoire sélectionné apparaîtra maintenant sur la page de connexion Moodle.</li></ul>';
$string['cfg_customicon_key'] = 'Icône personnalisée';
$string['cfg_debugmode_desc'] = 'En cas d’activation, les informations seront enregistrées dans le journal Moodle pour aider à identifier les problèmes.';
$string['cfg_debugmode_key'] = 'Enregistrer les messages de débogage';
$string['cfg_domainhint_desc'] = 'Lors de l’utilisation de la méthode d’authentification « Code d’autorisation », transmettez cette valeur en tant que paramètre « domain_hint ». « domain_hint » est utilisé par certains fournisseurs OpenID Connect pour faciliter le processus de connexion pour les utilisateurs. Vérifiez auprès de votre fournisseur s’il prend en charge ce paramètre.';
$string['cfg_domainhint_key'] = 'Indice de domaine';
$string['cfg_err_invalidauthendpoint'] = 'Point de terminaison d’autorisation non valide';
$string['cfg_err_invalidclientid'] = 'Identifiant client non valide';
$string['cfg_err_invalidclientsecret'] = 'Secret client non valide';
$string['cfg_err_invalidtokenendpoint'] = 'Point de terminaison de jeton non valide';
$string['cfg_field_mapping_desc'] = 'Les données de profil utilisateur peuvent être mappées depuis Open ID Connect IdP vers Moodle. Les champs distants disponibles pour la correspondance dépendent fortement du type d’IdP.<br/>
<ul>
<li>Certains champs de profil de base sont disponibles à partir des demandes de jeton d’accès et de jeton d’ID de tous les types d’IdP.</li>
<li>Si le type d’IdP Microsoft est configuré (v1.0 ou v2.0), des données de profil supplémentaires peuvent être mises à disposition via des appels d’API Graph en installant et en configurant le <a href="https://moodle.org/plugins /local_o365">Plugin d’intégration Microsoft 365 (local_o365)</a>.</li>
<li>Si la fonctionnalité de synchronisation du profil SDS est activée dans le plugin local_o365, certains champs de profil peuvent être synchronisés de SDS vers Moodle lors de l’exécution de la tâche planifiée « Synchroniser avec SDS », et ne se produira pas lors de l’exécution de la tâche planifiée « Synchroniser les utilisateurs avec Microsoft Entra ID », ni lorsque l’utilisateur se connecte.</li>
</ul>

Les demandes disponibles à partir des jetons d’identification et d’accès varient en fonction du type d’IdP, mais la plupart des IdP permettent un certain niveau de personnalisation des demandes. La documentation sur les IdP Microsoft est liée ci-dessous :
<ul>
<li><a target="_blank" href="https://learn.microsoft.com/en-us/entra/identity-platform/access-token-claims-reference">Demandes de jeton d’accès</a>< /li>
<li><a target="_blank" href="https://learn.microsoft.com/en-us/entra/identity-platform/id-token-claims-reference">Demandes de jeton d’identification</a>< /li>
<li><a target="_blank" href="https://learn.microsoft.com/en-us/entra/identity-platform/optional-claims-reference">Configuration facultative des demandes</a> : remarque " « E-mail » est une revendication facultative dans le type d’IdP Microsoft Entra ID (v1.0).</li>
</ul>';
$string['cfg_forceredirect_desc'] = 'En cas d’activation, sautera la page d’index de connexion et redirigera vers la page OpenID Connect. Peut être contourné avec le paramètre d’URL ?noredirect=1';
$string['cfg_forceredirect_key'] = 'Forcer la redirection';
$string['cfg_frontchannellogouturl_desc'] = 'Il s’agit de l’URL que votre fournisseur d’identité doit déclencher lorsqu’il tente de déconnecter les utilisateurs de Moodle.<br/>
Pour la plate-forme d’identité Microsoft Entra ID / Microsoft, le paramètre s’appelle « URL de déconnexion du canal frontal » et est configurable dans l’application Azure.';
$string['cfg_frontchannellogouturl_key'] = 'URL de déconnexion du canal principal';
$string['cfg_icon_desc'] = 'Une icône à afficher à côté du nom du fournisseur sur la page de connexion.';
$string['cfg_icon_key'] = 'Icône';
$string['cfg_iconalt_check'] = 'Icône de coche';
$string['cfg_iconalt_go'] = 'Cercle vert';
$string['cfg_iconalt_group'] = 'Icône de groupe';
$string['cfg_iconalt_group2'] = 'Icône de groupe alternative';
$string['cfg_iconalt_key'] = 'Icône clé';
$string['cfg_iconalt_lock'] = 'Icône de verrouillage';
$string['cfg_iconalt_locked'] = 'Icône verrouillée';
$string['cfg_iconalt_mnet'] = 'Icône MNET';
$string['cfg_iconalt_o365'] = 'Icône Microsoft 365';
$string['cfg_iconalt_plus'] = 'Icône plus';
$string['cfg_iconalt_rightarrow'] = 'Icône flèche vers la droite';
$string['cfg_iconalt_stop'] = 'Cercle rouge';
$string['cfg_iconalt_user'] = 'Icône utilisateur';
$string['cfg_iconalt_user2'] = 'Icône utilisateur alternative';
$string['cfg_iconalt_userlock'] = 'Utilisateur avec icône de verrouillage';
$string['cfg_loginflow_authcode'] = 'Flux de code d’autorisation (recommandé)';
$string['cfg_loginflow_authcode_desc'] = 'En utilisant ce flux, l’utilisateur clique sur le nom du fournisseur d’identité (voir « Nom du fournisseur » ci-dessus) sur la page de connexion Moodle et est redirigé vers le fournisseur pour se connecter. Une fois connecté avec succès, l’utilisateur est redirigé vers Moodle où la connexion à Moodle s’effectue de manière transparente. Il s’agit du moyen le plus standardisé et le plus sécurisé pour la connexion de l’utilisateur.';
$string['cfg_loginflow_key'] = 'Méthode d’authentification';
$string['cfg_loginflow_rocreds'] = 'Octroi des identifiants de mot de passe du propriétaire de la ressource <b>(obsolète)</b>';
$string['cfg_loginflow_rocreds_desc'] = 'En utilisant ce flux, l’utilisateur entre son nom d’utilisateur et son mot de passe dans le formulaire de connexion Moodle comme il le ferait avec une connexion manuelle. Cela autorisera l’utilisateur avec fournisseur d’identité, mais ne créera pas de session sur le site du fournisseur d’identité. Par exemple, si vous utilisez Microsoft 365 avec OpenID Connect, l’utilisateur sera connecté à Moodle mais pas aux applications Web Microsoft 365. L’utilisation de la demande d’autorisation est recommandée si vous souhaitez que les utilisateurs soient connectés à la fois à Moodle et au fournisseur d’identité. Notez que tous les fournisseurs d’identité ne prennent pas en charge ce flux. Cette option ne doit être utilisée que lorsque d’autres types d’octroi d’autorisation ne sont pas disponibles.';
$string['cfg_logoutendpoint_desc'] = 'L’URI du point de terminaison de déconnexion de votre fournisseur d’identité à utiliser.';
$string['cfg_logoutendpoint_key'] = 'Point de terminaison de déconnexion';
$string['cfg_opname_desc'] = 'Il s’agit d’une étiquette destinée à l’utilisateur final qui identifie le type d’informations d’identification que l’utilisateur doit utiliser pour se connecter. Cette étiquette est utilisée dans toutes les parties de ce plugin destinées aux utilisateurs pour identifier votre fournisseur.';
$string['cfg_opname_key'] = 'Nom du fournisseur';
$string['cfg_redirecturi_desc'] = 'Il s’agit de l’URI à enregistrer en tant qu\' « URI de redirection ». Votre fournisseur d’identité OpenID Connect doit le demander lors de l’enregistrement de Moodle en tant que client. <br /><b>REMARQUE :</b> Vous devez entrer ceci dans votre fournisseur OpenID Connect *exactement* tel qu’il apparaît ici. Toute différence empêchera les connexions à l’aide d’OpenID Connect.';
$string['cfg_redirecturi_key'] = 'URI de redirection';
$string['cfg_signoffintegration_desc'] = 'Si activé, lorsqu’un utilisateur de Moodle utilisant la méthode d’authentification OIDC se déconnecte de Moodle, Moodle tentera également de déconnecter l’utilisateur d’Office 365.

Notez que l’URL du site Moodle ({$a}) doit être ajoutée en tant qu’URI de redirection dans l’application Azure créée pour l’intégration de Moodle dans Office 365.';
$string['cfg_signoffintegration_key'] = 'Déconnexion unique (de Moodle vers le fournisseur d’identité)';
$string['cfg_silentloginmode_desc'] = 'S’il est activé, Moodle essaiera d’utiliser la session active d’un utilisateur authentifié auprès du point de terminaison d’autorisation configuré pour connecter l’utilisateur.<br/>
Pour utiliser cette fonctionnalité, les configurations suivantes sont requises :
<ul>
<li><b>Forcer les utilisateurs à se connecter</b> (forcelogin) dans la <a href="{$a}" target="_blank">section Règles du site</a> est activé.</li>
Le paramètre <li><b>Forcer la redirection</b> (auth_oidc/forceredirect) ci-dessus est activé.</li>
</ul>
Afin d’éviter que Moodle n’essaye d’utiliser des comptes personnels ou des comptes d’autres locataires pour se connecter, il est également recommandé d’utiliser des points de terminaison spécifiques au locataire, plutôt que des points de terminaison génériques utilisant des chemins « communs » ou « d’organisation », etc.<br/>
<br/>
Pour les IdP Microsoft, l’expérience utilisateur est la suivante :
<ul>
<li>Si aucune session utilisateur active n’est trouvée, la page de connexion Moodle s’affichera.</li>
<li>Si une seule session utilisateur active est trouvée et que l’utilisateur a accès à l’application Entra ID (c’est-à-dire qu’il appartient au même locataire ou est un utilisateur invité du locataire), l’utilisateur sera automatiquement connecté à Moodle. en utilisant SSO.</li>
<li>Si une seule session utilisateur active est trouvée, mais que l’utilisateur n’a pas accès à l’application Entra ID (par exemple, l’utilisateur appartient à un autre locataire ou l’application nécessite une affectation d’utilisateur et l’utilisateur n’est pas attribué), la page de connexion Moodle s’affichera.</li>
<li>S’il existe plusieurs sessions utilisateur actives ayant accès à l’application Entra ID, une page s’affichera pour permettre à l’utilisateur de sélectionner le compte avec lequel se connecter.</li>
</ul>';
$string['cfg_silentloginmode_key'] = 'Mode de connexion silencieuse';
$string['cfg_userrestrictions_desc'] = 'Autoriser uniquement les utilisateurs qui répondent à certaines restrictions à se connecter. <br /><b>Comment utiliser les restrictions d’utilisateur : </b> <ul><li>Entrez une <a href="https://en.wikipedia.org/wiki/Regular_expression">expression régulière</a > modèle qui correspond aux noms d’utilisateur des utilisateurs que vous souhaitez autoriser.</li><li>Entrez un modèle par ligne</li><li>Si vous entrez plusieurs modèles, un utilisateur sera autorisé s’il correspond à N’IMPORTE QUEL modèle. </li><li>Le caractère "/" doit être échappé avec "\\".</li><li>Si vous n’entrez aucune restriction ci-dessus, tous les utilisateurs pouvant se connecter au fournisseur OpenID Connect seront accepté par Moodle.</li><li>Tout utilisateur qui ne correspond à aucun des modèles saisis ne pourra pas se connecter à l’aide d’OpenID Connect.</li></ul>';
$string['cfg_userrestrictions_key'] = 'Restrictions utilisateurs';
$string['cfg_userrestrictionscasesensitive_desc'] = 'Ceci contrôle si l’option « /i » dans l’expression régulière est utilisée dans la correspondance de restriction d’utilisateur.<br/>Si elle est activée, toutes les vérifications de restriction d’utilisateur seront effectuées en respectant la casse. Notez que si cette option est désactivée, tous les motifs sur la casse des lettres seront ignorés.';
$string['cfg_userrestrictionscasesensitive_key'] = 'Restrictions utilisateur sensibles à la casse';
$string['change_binding_username_claim_tool'] = 'Outil de modification de demande de nom d\'utilisateur obligatoire';
$string['change_binding_username_claim_tool_description'] = '<p class="warning_header">Il s\'agit d\'une fonctionnalité avancée !</p>
<p>Cet outil permet aux administrateurs de site de mettre à jour en masse les enregistrements suivants :</p>
<ul>
<li>Noms d\'utilisateur des comptes Moodle,</li>
<li>Noms d\'utilisateur liés dans les jetons d\'identification OpenID Connect enregistrés,</li>
<li>Enregistrements de connexion aux comptes Moodle et Microsoft.</li>
</ul>
<p>Cette fonctionnalité ne doit être utilisée que lors de la modification des paramètres de <b>demande de nom d\'utilisateur lié</b>.</p>
<p class="warning">Soyez très prudent lorsque vous utilisez cette fonctionnalité et suivez les étapes de la <a href="{$a}" target="_blank">page de configuration de la demande de nom d\'utilisateur lié</a>. Une mauvaise utilisation de cet outil entraînera la corruption des enregistrements d\'utilisateurs Moodle et/ou l\'échec de l\'authentification unique.</p>
<p>L\'outil accepte un fichier CSV simple à deux colonnes :</p>
<ul>
<li><b><span class="code">nom_utilisateur</span></b> : Nom d\'utilisateur actuel du compte Moodle à mettre à jour. Si l\'utilisateur actuel est associé manuellement, il doit s\'agir de la valeur de la demande de liaison actuelle.</li>
<li><b><span class="code">nouveau_nom_utilisateur</span></b> : Valeur sensible à la casse de la nouvelle revendication de jeton à utiliser comme revendication de nom d\'utilisateur associé. Si l\'utilisateur est associé automatiquement et utilise le type d\'authentification OpenID Connect, la minuscule de cette valeur sera utilisée comme nom d\'utilisateur Moodle.</li>
</ul>
<p>Lors du téléchargement du fichier, l\'outil effectue les actions suivantes :</p>
<ol>
<li>Recherchez un utilisateur Moodle existant avec le <span class="code">nom d\'utilisateur</span> indiqué comme nom d\'utilisateur ou adresse courriel, et utilisez la méthode d\'authentification OpenID Connect. Si vous en trouvez un, mettez à jour le nom d\'utilisateur avec la minuscule <span class="code">nouveau_nom_d\'utilisateur</span>.</li>
<li>Mettre à jour l\'enregistrement du jeton OpenID Connect. <ul>
<li>Si un utilisateur est trouvé à l\'étape 1 ci-dessus, recherchez l\'enregistrement de jeton correspondant dans la table <span class="code">auth_oidc_token</span> et mettez à jour la colonne <span class="code">username</span> avec la minuscule <span class="code">new_username</span> et la colonne <span class="code">oidcusername</span> avec la même valeur que <span class="code">new_username</span>.</li>
<li>Si aucun enregistrement n\'est trouvé ci-dessus, l\'application essaiera de trouver un enregistrement dans la table <span class="code">auth_oidc_token</span> dont la colonne <span class="code">oidcusername</span> correspond à l\'ancien <span class="code">username</span> et le mettra à jour avec la valeur <span class="code">newusername</span>.</li>
</ul>
<li>Si le plugin <span class="code">local_365</span> est installé, mettez à jour l\'enregistrement de connexion de l\'utilisateur. <ul>
<li>Si un utilisateur est trouvé à l\'étape 1 ci-dessus, recherchez son enregistrement de connexion dans la table <span class="code">local_o365_objects</span> et mettez à jour la colonne <span class="code">o365name</span> pour qu\'elle corresponde à <span class="code">new_username</span>.</li>
<li>Si aucun utilisateur n\'est trouvé à l\'étape 1, l\'application tente de trouver un enregistrement pour un utilisateur dans la table <span class="code">local_o365_objects</span> dont la valeur <span class="code">o365name</span> correspond à la valeur <span class="code">username</span> et la met à jour avec la valeur <span class="code">newusername</span>.</li>
</ul>
</ol>
<p>Le fichier d\'exemple ci-dessous remplace la demande du nom d\'utilisateur de liaison <span class="code">upn</span> ou <span class="code">email</span> par <span class="code">oid</span>.</p>';
$string['change_binding_username_claim_tool_result'] = 'Mettre à jour les résultats';
$string['cleanup_oidc_tokens'] = 'Nettoyer les jetons OpenID Connect';
$string['clientauthmethod'] = 'Méthode d’authentification client';
$string['clientauthmethod_help'] = '<ul>
<li>IdP dans tous les types peut utiliser la méthode d’authentification « <b>Secret</b> ».</li>
<li>Le fournisseur d’identité de type <b>Plate-forme d’identité Microsoft (v2.0)</b> peut également utiliser la méthode d’authentification <b>Certificat</b>.</li>
</ul>
Remarque : la méthode d’authentification <b>Certificat</b> n’est pas prise en charge dans le flux de connexion <b>Ressource Propriétaire Mot de passe Certificat Attribution</b>.';
$string['clientcert'] = 'Clef publique du certificat client';
$string['clientcert_help'] = 'Lors de l’utilisation de la méthode d’authentification <b>certificat</b>, il s’agit de la clef publique, ou du certificat, utilisée pour s’authentifier auprès de l’IdP.';
$string['clientcertfile'] = 'Nom de fichier de la clé publique du certificat client';
$string['clientcertfile_help'] = 'Lorsque vous utilisez la méthode d’authentification par <b>certificat</b> et la source du certificat <b>Nom de fichier</b>, il s’agit du nom de fichier de la clé publique, ou du certificat, utilisé pour s’authentifier auprès de l’IdP. Le fichier doit être présenté dans un dossier <b>microsoft_certs</b> dans le dossier de données Moodle.';
$string['clientcertpassphrase'] = 'Phrase secrète du certificat client';
$string['clientcertpassphrase_help'] = 'Si la clé privée du certificat client est chiffrée, il s’agit de la phrase secrète permettant de la déchiffrer.';
$string['clientcertsource'] = 'Origine du certificat';
$string['clientcertsource_help'] = 'Lors de l’utilisation de la méthode d’authentification <b>certificat</b>, celle-ci est utilisée pour définir où récupérer le certificat.
<ul>
La source <li><b>Texte brut</b> nécessite que le contenu du fichier de certificat/clé privée soit configuré dans les paramètres suivants de la zone de texte.</li>
La source <li><b>Nom de fichier</b> nécessite que les fichiers de certificat/clé privée existent dans un dossier <b>microsoft_certs</b> dans le dossier de données Moodle.</li>
</ul>';
$string['clientid'] = 'ID d’application';
$string['clientid_help'] = 'Votre identifiant d’application / client enregistré sur le fournisseur d’identité.';
$string['clientprivatekey'] = 'Clef privée du certificat client';
$string['clientprivatekey_help'] = 'Lors de l’utilisation de la méthode d’authentification <b>certificat</b>, il s’agit de la clef privée du certificat utilisé pour s’authentifier auprès du fournisseur d’identité.';
$string['clientprivatekeyfile'] = 'Nom de fichier de la clé privée du certificat client';
$string['clientprivatekeyfile_help'] = 'Lors de l’utilisation de la méthode d’authentification par <b>certificat</b> et de la source du certificat <b>Nom de fichier</b>, il s’agit du nom de fichier de la clé privée utilisée pour s’authentifier auprès de l’IdP. Le fichier doit être présenté dans un dossier <b>microsoft_certs</b> dans le dossier de données Moodle.';
$string['clientsecret'] = 'clef secrète du client';
$string['clientsecret_help'] = 'Lors de l’utilisation de la méthode d’authentification <b>secret</b>, il s’agit du secret client sur le fournisseur d’identité. chez certains fournisseurs, il est également appelé clef.';
$string['csvdelimiter'] = 'séparateur CSV';
$string['csvline'] = 'ligne CSV';
$string['customclaimname'] = 'Personnaliser le nom de la demande';
$string['customclaimname_description'] = 'Ce champ est utilisé uniquement lorsque le paramètre <b>Demande de nom d\'utilisateur de liaison</b> est défini sur <b>Personnalisé</b>';
$string['delete_token'] = 'Supprimer le jeton';
$string['delete_token_and_reference'] = 'Supprimer le jeton et la référence';
$string['encoding'] = 'Codage';
$string['error_empty_client_cert'] = 'La clef publique du certificat client ne peut pas être vide lors de l’utilisation de la méthode d’authentification « certificat »';
$string['error_empty_client_cert_file'] = 'Le fichier de clé publique du certificat client ne peut pas être vide lors de l’utilisation de la méthode d’authentification « certificat »';
$string['error_empty_client_private_key'] = 'La clef privée du certificat client ne peut pas être vide lors de l’utilisation de la méthode d’authentification « certificat »';
$string['error_empty_client_private_key_file'] = 'Le fichier de clé privée du certificat client ne peut pas être vide lors de l’utilisation de la méthode d’authentification « certificat »';
$string['error_empty_client_secret'] = 'Le secret client ne peut pas être vide lors de l’utilisation de la méthode d’authentification « secrète »';
$string['error_empty_oidcresource'] = 'La ressource ne peut pas être vide lors de l’utilisation d’Azure AD (v1.0) ou d’autres types de fournisseurs d’identité.';
$string['error_empty_tenantname_or_guid'] = 'Le nom du locataire ou le GUID ne peut pas être vide lors de l’utilisation de la méthode d’authentification « certificat »';
$string['error_empty_tenantnameorguid'] = 'Le nom du locataire ou le GUID ne peut pas être vide lors de l’utilisation des IdP Microsoft Entra ID (v1.0) ou de la plateforme d’identités Microsoft (v2.0).';
$string['error_endpoint_mismatch_auth_endpoint'] = 'Le point de terminaison d’autorisation configuré ne correspond pas au type de fournisseur d’identité configuré.<br/>
<ul>
<li>Lorsque vous utilisez le type de fournisseur d’identité « Azure AD (v1.0) », utilisez le point de terminaison v1.0, par exenple https://login.microsoftonline.com/common/oauth2/authorize</li>
<li>Lorsque vous utilisez le type de fournisseur d’identité « Plate-forme d’identité Microsoft (v2.0) », utilisez le point de terminaison v2.0, par exemple https://login.microsoftonline.com/common/oauth2/v2.0/authorize</li>
</ul>';
$string['error_endpoint_mismatch_token_endpoint'] = 'Le point de terminaison du jeton configuré ne correspond pas au type de fournisseur d’identité configuré.<br/>
<ul>
<li>Lorsque vous utilisez le type de fournisseur d’identité « Azure AD (v1.0) », utilisez le point de terminaison v1.0, par exemple https://login.microsoftonline.com/common/oauth2/token</li>
<li>Lorsque vous utilisez le type de fournisseur d’identité « Plate-forme d’identité Microsoft (v2.0) », utilisez le point de terminaison v2.0, par exemple https://login.microsoftonline.com/common/oauth2/v2.0/authorize</li>
</ul>';
$string['error_invalid_client_authentication_method'] = 'Méthode d’authentification client non valide';
$string['error_invalid_upload_file'] = 'Fichier de téléchargement non valide.';
$string['error_no_response_available'] = 'Aucune réponse disponible.';
$string['error_tenant_specific_endpoint_required'] = 'Lors de l’utilisation du type d’IdP « Plateforme d’identité Microsoft (v2.0) » et de la méthode d’authentification « Certificat », un point de terminaison spécifique au locataire (c’est-à-dire non commun/organisations/consommateurs) est requis.';
$string['errorauthdisconnectemptypassword'] = 'Le mot de passe ne peut pas être vide';
$string['errorauthdisconnectemptyusername'] = 'Le nom d’utilisateur ne peut pas être vide';
$string['errorauthdisconnectifmanual'] = 'En cas d’utilisation de la méthode de connexion manuelle, entrer les informations d’identification ci-dessous.';
$string['errorauthdisconnectinvalidmethod'] = 'Méthode de connexion non valide reçue.';
$string['errorauthdisconnectnewmethod'] = 'Utiliser la méthode de connexion';
$string['errorauthdisconnectusernameexists'] = 'Ce nom d’utilisateur est déjà pris. Veuillez en choisir un autre.';
$string['errorauthgeneral'] = 'Un problème est survenu lors de votre connexion. Veuillez contacter votre administrateur pour obtenir de l’aide.';
$string['errorauthinvalididtoken'] = 'Identifiant de jeton non valide reçu.';
$string['errorauthloginfaileddupemail'] = 'Connexion non valide : un compte existant sur ce Moodle a la même adresse de courriel que le compte que vous essayez de créer, et le paramètre « Autoriser les comptes avec la même adresse de courriel » (allowaccountssameemail) est désactivé.';
$string['errorauthloginfailednouser'] = 'Connexion non valide : utilisateur introuvable dans Moodle. Si ce site a le paramètre « authpreventaccountcreation » activé, cela peut signifier que vous avez besoin d’un administrateur pour vous créer un compte d’abord.';
$string['errorauthnoaccesstoken'] = 'Jeton d’accès non reçu.';
$string['errorauthnoauthcode'] = 'Aucun code d’autorisation n’a été reçu du serveur d’identité. Les journaux d’erreurs peuvent contenir plus d’informations.';
$string['errorauthnocredsandendpoints'] = 'Veuillez configurer les informations d’identification et les points de terminaison du client OpenID Connect.';
$string['errorauthnohttpclient'] = 'Veuillez définir un client HTTP.';
$string['errorauthnoidtoken'] = 'OpenID Connect id_token non reçu.';
$string['errorauthunknownstate'] = 'État inconnu.';
$string['errorauthuseralreadyconnected'] = 'Vous êtes déjà connecté à un autre utilisateur OpenID Connect.';
$string['errorauthuserconnectedtodifferent'] = 'L’utilisateur OpenID Connect qui s’est authentifié est déjà connecté à un utilisateur Moodle.';
$string['errorbadloginflow'] = 'Type d’authentification spécifié non valide. Remarque : si vous recevez ceci après une installation ou une mise à niveau récente, veuillez vider votre cache Moodle.';
$string['errorinvalidcertificatesource'] = 'Source de certificat non valide';
$string['errorinvalidredirect_message'] = 'L’URL vers laquelle vous essayez de rediriger n’existe pas.';
$string['errorjwtbadpayload'] = 'Impossible de lire la charge utile JWT.';
$string['errorjwtcouldnotreadheader'] = 'Impossible de lire l’en-tête JWT';
$string['errorjwtempty'] = 'Chaîne JWT vide ou non-reçue.';
$string['errorjwtinvalidheader'] = 'En-tête JWT non valide';
$string['errorjwtmalformed'] = 'JWT incorrect reçu.';
$string['errorjwtunsupportedalg'] = 'Algorithme JWS ou JWE non pris en charge';
$string['errorlogintoconnectedaccount'] = 'Cet utilisateur Microsoft 365 est connecté à un compte Moodle, mais la connexion OpenID Connect n’est pas activée pour ce compte Moodle. Veuillez vous connecter au compte Moodle en utilisant la méthode d’authentification définie du compte pour utiliser les fonctionnalités de Microsoft 365';
$string['errornodisconnectionauthmethod'] = 'Impossible de se déconnecter car il n’y a pas de plugin d’authentification activé vers lequel se replier (soit la méthode de connexion précédente de l’utilisateur, soit la méthode de connexion manuelle).';
$string['erroroidccall'] = 'Erreur dans OpenID Connect. Veuillez consulter les journaux pour plus d’informations.';
$string['erroroidccall_message'] = 'Erreur dans OpenID Connect : {$a}';
$string['erroroidcclientinsecuretokenendpoint'] = 'Le point de terminaison du jeton doit utiliser SSL/TLS pour cela.';
$string['erroroidcclientinvalidendpoint'] = 'URI de point de terminaison non valide reçu.';
$string['erroroidcclientnoauthendpoint'] = 'Aucun point de terminaison d’autorisation défini. Veuillez définir avec $this->setendpoints';
$string['erroroidcclientnocreds'] = 'Veuillez définir les informations d’identification du client avec setcreds';
$string['erroroidcclientnotokenendpoint'] = 'Aucun point de terminaison de jeton défini. Veuillez définir avec $this->setendpoints';
$string['erroroidcnotenabled'] = 'Le plugin d’authentification OpenID Connect n’est pas activé.';
$string['errorrestricted'] = 'Ce site a des restrictions en place sur les utilisateurs qui peuvent se connecter avec OpenID Connect. Ces restrictions vous empêchent actuellement de terminer cette tentative de connexion.';
$string['errorucpinvalidaction'] = 'Action reçue non valide.';
$string['errorusermatched'] = 'Le compte Microsoft 365 "{$a->entraidupn}" est déjà associé à l’utilisateur Moodle "{$a->username}". Pour terminer la connexion, veuillez d’abord vous connecter en tant qu’utilisateur Moodle et suivre les instructions du bloc Microsoft.';
$string['erroruserwithusernamealreadyexists'] = 'Une erreur s’est produite lors de la tentative de renommer votre compte Moodle. Un utilisateur Moodle avec le nouveau nom d’utilisateur existe déjà. Demandez d’abord à l’administrateur de votre site de résoudre ce problème.';
$string['event_debug'] = 'Message de débogage';
$string['eventuserauthed'] = 'Utilisateur autorisé avec OpenID Connect';
$string['eventuserconnected'] = 'Utilisateur connecté à OpenID Connect';
$string['eventusercreated'] = 'Utilisateur créé avec OpenID Connect';
$string['eventuserdisconnected'] = 'Utilisateur déconnecté d’OpenID Connect';
$string['eventuserloggedin'] = 'Utilisateur connecté avec OpenID Connect';
$string['eventuserrenameattempt'] = 'Le plugin auth_oidc a tenté de renommer un utilisateur';
$string['examplecsv'] = 'Exemple de fichier de téléchargement';
$string['heading_additional_options'] = 'Options supplémentaires';
$string['heading_basic'] = 'Paramètres de base';
$string['heading_debugging'] = 'Débogage';
$string['heading_display'] = 'Affichage';
$string['heading_sign_out'] = 'Déconnexion de l’intégration';
$string['heading_user_restrictions'] = 'Restrictions des utilisateurs';
$string['idp_type_microsoft_entra_id'] = 'Microsoft Entra ID (v1.0)';
$string['idp_type_microsoft_identity_platform'] = 'Plateforme d’identité Microsoft (v2.0)';
$string['idp_type_other'] = 'Autre';
$string['idptype'] = 'Type de fournisseur d’identité (IdP)';
$string['idptype_help'] = 'Trois types de fournisseurs d’identités sont actuellement pris en charge :
<ul>
<li><b>Microsoft Entra ID (v1.0)</b> : Microsoft Entra ID avec points de terminaison oauth2 v1.0, par exemple https://login.microsoftonline.com/common/oauth2/authorize.</li>
<li><b>Plate-forme d’identité Microsoft (v2.0)</b> : Microsoft Entra ID avec points de terminaison oath2 v2.0, par exemple https://login.microsoftonline.com/common/oauth2/v2.0/authorize.</li>
<li><b>Autre</b> : tout fournisseur d’identité autre que Microsoft.</li>
</ul>
Les différences entre les options <b>Azure AD (v1.0)</b> et <b>Microsoft Identity Platform (v2.0)</b> sont disponibles sur <a href="https://docs.microsoft .com/en-us/azure/active-directory/azuread-dev/azure-ad-endpoint-comparison">https://docs.microsoft.com/en-us/azure/active-directory/azuread-dev/azure-ad-endpoint-comparison</a>.<br/>
Notamment, l’application configurée peut utiliser un <b>certificat</b> en plus du <b>secret</b> pour l’authentification lors de l’utilisation du fournisseur d’identité <b>Plateforme d’identité Microsoft (v2.0)</b>.<br/>
Les points de terminaison d’autorisation et de jeton doivent être configurés en fonction du type de fournisseur d’identité configuré.';
$string['mismatched'] = 'Non concordant';
$string['mismatched_details'] = 'L’enregistrement du jeton contient le nom d’utilisateur "{$a->tokenusername}" ; L’utilisateur Moodle correspondant a le nom d’utilisateur "{$a->moodleusername}".';
$string['missing_idp_type'] = 'Cette configuration n\'est disponible que si un type d\'IdP est configuré.';
$string['na'] = 'n/a';
$string['new_username'] = 'Nouveau nom d\'utilisateur';
$string['no_token_to_cleanup'] = 'Il n’y a pas de jeton OIDC à nettoyer.';
$string['oidc:manageconnection'] = 'Autoriser la connexion et la déconnexion OpenID';
$string['oidc:manageconnectionconnect'] = 'Autoriser la connexion OpenID';
$string['oidc:manageconnectiondisconnect'] = 'Autoriser la déconnexion OpenID';
$string['oidcresource'] = 'Ressource';
$string['oidcresource_help'] = 'La ressource OpenID Connect pour laquelle envoyer la demande.<br/>
<b>Remarque :</b> ce paramètre n’est pas pris en charge dans le type de fournisseur d’identité <b>Microsoft Identity Platform (v2.0)</b>.';
$string['oidcscope'] = 'Portée';
$string['oidcscope_help'] = 'Portée de l’OIDC à utiliser.';
$string['pluginname'] = 'Connexion OpenID';
$string['privacy:metadata:auth_oidc'] = 'Authentification OpenID Connect';
$string['privacy:metadata:auth_oidc_prevlogin'] = 'Méthodes de connexion précédentes pour annuler les connexions Microsoft 365';
$string['privacy:metadata:auth_oidc_prevlogin:method'] = 'La méthode de connexion précédente';
$string['privacy:metadata:auth_oidc_prevlogin:password'] = 'Le champ du mot de passe utilisateur précédent (crypté).';
$string['privacy:metadata:auth_oidc_prevlogin:userid'] = 'L’identifiant de l’utilisateur Moodle';
$string['privacy:metadata:auth_oidc_token'] = 'Jetons OpenID Connect';
$string['privacy:metadata:auth_oidc_token:authcode'] = 'Le code d’autorisation du jeton';
$string['privacy:metadata:auth_oidc_token:expiry'] = 'L’expiration du jeton';
$string['privacy:metadata:auth_oidc_token:idtoken'] = 'Le jeton d’identification';
$string['privacy:metadata:auth_oidc_token:oidcuniqid'] = 'L’identifiant unique de l’utilisateur OIDC.';
$string['privacy:metadata:auth_oidc_token:oidcusername'] = 'Le nom d’utilisateur de l’utilisateur OIDC';
$string['privacy:metadata:auth_oidc_token:refreshtoken'] = 'Le jeton de rafraîchissement';
$string['privacy:metadata:auth_oidc_token:scope'] = 'La portée du jeton';
$string['privacy:metadata:auth_oidc_token:token'] = 'Le jeton';
$string['privacy:metadata:auth_oidc_token:tokenresource'] = 'La ressource du jeton';
$string['privacy:metadata:auth_oidc_token:userid'] = 'L’identifiant de l’utilisateur Moodle';
$string['privacy:metadata:auth_oidc_token:useridentifier'] = 'L\'identifiant utilisateur de l\'utilisateur OIDC';
$string['privacy:metadata:auth_oidc_token:username'] = 'Le nom d’utilisateur de l’utilisateur Moodle';
$string['rowpreviewnum'] = 'Aperçu des lignes';
$string['secretexpiryrecipients'] = 'Destinataires des notifications d’expiration secrètes';
$string['secretexpiryrecipients_help'] = 'Liste d’adresses e-mail séparées par des virgules auxquelles envoyer des notifications d’expiration secrètes.<br/>
Si aucune adresse e-mail n’est saisie, l’administrateur principal du site en sera informé.';
$string['settings_fieldmap_feild_not_mapped'] = '(non mappé)';
$string['settings_fieldmap_field_bindingusernameclaim'] = 'Demande de nom d\'utilisateur de liaison (ne peut être mappée que lors de la connexion)';
$string['settings_fieldmap_field_businessPhones'] = 'Téléphone de bureau';
$string['settings_fieldmap_field_city'] = 'Ville';
$string['settings_fieldmap_field_companyName'] = 'Nom de l’entreprise';
$string['settings_fieldmap_field_country'] = 'Pays';
$string['settings_fieldmap_field_department'] = 'Département';
$string['settings_fieldmap_field_displayName'] = 'Afficher un nom';
$string['settings_fieldmap_field_employeeId'] = 'Identifiant de l’employé';
$string['settings_fieldmap_field_extensionattribute'] = 'Attribut d’extension {$a}';
$string['settings_fieldmap_field_faxNumber'] = 'Numéro de fax';
$string['settings_fieldmap_field_givenName'] = 'Prénom';
$string['settings_fieldmap_field_groups'] = 'Groupes';
$string['settings_fieldmap_field_jobTitle'] = 'Profession';
$string['settings_fieldmap_field_mail'] = 'Courriel';
$string['settings_fieldmap_field_manager'] = 'Nom du gestionnaire';
$string['settings_fieldmap_field_manager_email'] = 'Adresse de courriel du gestionnaire';
$string['settings_fieldmap_field_mobile'] = 'Mobile';
$string['settings_fieldmap_field_mobilePhone'] = 'Téléphone Mobile';
$string['settings_fieldmap_field_objectId'] = 'Identifiant de l’objet';
$string['settings_fieldmap_field_officeLocation'] = 'Bureau';
$string['settings_fieldmap_field_onPremisesSamAccountName'] = 'Nom du compte SAM local';
$string['settings_fieldmap_field_postalCode'] = 'Code postal';
$string['settings_fieldmap_field_preferredLanguage'] = 'Langue';
$string['settings_fieldmap_field_preferredName'] = 'Nom d’usage';
$string['settings_fieldmap_field_roles'] = 'Rôles';
$string['settings_fieldmap_field_sds_school_id'] = 'Identifiant d’école SDS ({$a})';
$string['settings_fieldmap_field_sds_school_name'] = 'Nom de l’école SDS ({$a})';
$string['settings_fieldmap_field_sds_school_role'] = 'Rôle de l’école SDS (« Étudiant » ou « Enseignant »)';
$string['settings_fieldmap_field_sds_student_birthDate'] = 'Date de naissance de l’étudiant SDS';
$string['settings_fieldmap_field_sds_student_externalId'] = 'Identifiant externe étudiant SDS';
$string['settings_fieldmap_field_sds_student_grade'] = 'Note d’étudiant SDS';
$string['settings_fieldmap_field_sds_student_graduationYear'] = 'Année de fin d’études des étudiants SDS';
$string['settings_fieldmap_field_sds_student_studentNumber'] = 'Numéro d’étudiant SDS';
$string['settings_fieldmap_field_sds_teacher_externalId'] = 'Identifiant externe de l’enseignant SDS';
$string['settings_fieldmap_field_sds_teacher_teacherNumber'] = 'Numéro d’enseignant SDS';
$string['settings_fieldmap_field_state'] = 'État';
$string['settings_fieldmap_field_streetAddress'] = 'Nom de la rue';
$string['settings_fieldmap_field_surname'] = 'Nom de famille';
$string['settings_fieldmap_field_teams'] = 'Équipes';
$string['settings_fieldmap_field_telephoneNumber'] = 'Numéro de téléphone';
$string['settings_fieldmap_field_userPrincipalName'] = 'Nom d’utilisateur (UPN)';
$string['settings_page_application'] = 'Fournisseur d’identité et authentification';
$string['settings_page_binding_username_claim'] = 'Demande de nom d\'utilisateur obligatoire';
$string['settings_page_change_binding_username_claim_tool'] = 'Outil de modification de demande de nom d\'utilisateur obligatoire';
$string['settings_page_cleanup_oidc_tokens'] = 'Nettoyer les jetons OpenID Connect';
$string['settings_page_field_mapping'] = 'Correspondances de champs';
$string['settings_page_other_settings'] = 'Autres options';
$string['settings_section_authentication'] = 'Authentification';
$string['settings_section_basic'] = 'Paramètres de base';
$string['settings_section_binding_username_claim'] = 'Demande de nom d\'utilisateur obligatoire';
$string['settings_section_endpoints'] = 'Points de terminaison';
$string['settings_section_other_params'] = 'Autres paramètres';
$string['settings_section_secret_expiry_notification'] = 'Notification d’expiration secrète';
$string['table_action'] = 'Action';
$string['table_matching_details'] = 'Détails';
$string['table_matching_status'] = 'Statut de correspondance';
$string['table_oidc_unique_identifier'] = 'identifiant unique OIDC';
$string['table_oidc_username'] = 'Nom d’utilisateur OIDC';
$string['table_token_id'] = 'Identifiant d’enregistrement de jeton';
$string['table_token_unique_id'] = 'Identifiant unique OIDC';
$string['task_cleanup_oidc_sid'] = 'Nettoyer les enregistrements SID OIDC';
$string['task_cleanup_oidc_state_and_token'] = 'Nettoyer l’état OIDC et le jeton non valide';
$string['token_deleted'] = 'Le jeton a été supprimé avec succès';
$string['tokenendpoint'] = 'Point de terminaison de jeton';
$string['tokenendpoint_help'] = 'L’URI du point de terminaison du jeton de votre fournisseur d’identité à utiliser.<br/>
Notez que si le site doit être configuré pour autoriser l’accès aux utilisateurs d’autres locataires, le point de terminaison de jeton spécifique au locataire ne peut pas être utilisé.';
$string['ucp_disconnect_details'] = 'Cela déconnectera votre compte Moodle de {$a}. Vous devrez créer un nom d’utilisateur et un mot de passe pour vous connecter à Moodle.';
$string['ucp_disconnect_title'] = 'Déconnexion {$a}';
$string['ucp_general_intro'] = 'Ici, vous pouvez gérer votre connexion à {$a}. En cas d’activation, vous pourrez utiliser votre compte {$a} pour vous connecter à Moodle au lieu d’un nom d’utilisateur et d’un mot de passe distincts. Une fois connecté, vous n’aurez plus à vous souvenir d’un nom d’utilisateur et d’un mot de passe pour Moodle, toutes les connexions seront gérées par {$a}.';
$string['ucp_login_start'] = 'Commencez à utiliser {$a} pour vous connecter à Moodle';
$string['ucp_login_start_desc'] = 'Cela changera votre compte pour utiliser {$a} pour vous connecter à Moodle. Une fois activé, vous vous connecterez en utilisant vos identifiants {$a} - votre nom d’utilisateur et votre mot de passe Moodle actuels ne fonctionneront pas. Vous pouvez à tout moment vous déconnecter de votre compte et vous reconnecter normalement.';
$string['ucp_login_status'] = 'La connexion {$a} est :';
$string['ucp_login_stop'] = 'Arrêtez d’utiliser {$a} pour vous connecter à Moodle';
$string['ucp_login_stop_desc'] = 'Vous utilisez actuellement {$a} pour vous connecter à Moodle. Cliquer sur « Arrêter d’utiliser {$a} login » déconnectera votre compte Moodle de {$a}. Vous ne pourrez plus vous connecter à Moodle avec votre compte {$a}. Il vous sera demandé de créer un nom d’utilisateur et un mot de passe, et à partir de là, vous pourrez vous connecter directement à Moodle.';
$string['ucp_o365accountconnected'] = 'Ce compte Microsoft 365 est déjà connecté à un autre compte Moodle.';
$string['ucp_status_disabled'] = 'Désactivé';
$string['ucp_status_enabled'] = 'Activé';
$string['ucp_title'] = 'Gestion {$a}';
$string['unmatched'] = 'Incomparable';
$string['update_error_incomplete_line'] = 'La ligne ne contient pas de champs obligatoires.';
$string['update_error_invalid_new_username'] = 'Le nouveau nom d\'utilisateur n\'est pas valide.';
$string['update_error_nothing_updated'] = 'Rien n\'a été mis à jour.';
$string['update_error_user_not_found'] = 'Aucun utilisateur correspondant au nom d\'utilisateur n\'a été trouvé. Nous allons essayer de mettre à jour manuellement l\'utilisateur correspondant.';
$string['update_error_user_not_oidc'] = 'L\'utilisateur n\'utilise pas la méthode d\'authentification OpenID Connect. Nous allons essayer de mettre à jour l\'utilisateur associé manuellement.';
$string['update_error_user_update_failed'] = 'Échec de la mise à jour de l\'utilisateur.';
$string['update_oncreate_and_onlogin'] = 'À la création et à chaque connexion';
$string['update_oncreate_and_onlogin_and_usersync'] = 'Lors de la création, chaque connexion et chaque tâche de synchronisation utilisateur s’exécutent';
$string['update_onlogin_and_usersync'] = 'À chaque connexion et chaque tâche de synchronisation d’utilisateur exécutée';
$string['update_stats_users_errors'] = '{$a} utilisateurs ont rencontré des erreurs';
$string['update_stats_users_updated'] = '{$a} utilisateurs ont été mis à jour';
$string['update_success_o365'] = 'L’enregistrement de connexion Microsoft 365 a été mis à jour avec succès.';
$string['update_success_token'] = 'Jeton mis à jour avec succès.';
$string['update_success_username'] = 'Nom d\'utilisateur mis à jour avec succès.';
$string['update_username_results'] = 'Mettre à jour les résultats du nom d\'utilisateur';
$string['update_warning_email_match'] = 'Le courriel correspond à l\'utilisateur existant.';
$string['upload_usernames'] = 'Mettre à jour les noms d\'utilisateur de liaison';
$string['usernamefile'] = 'Fichier';
