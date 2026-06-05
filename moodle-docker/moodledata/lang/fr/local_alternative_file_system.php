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
 * Strings for component 'local_alternative_file_system', language 'fr', version '5.1'.
 *
 * @package     local_alternative_file_system
 * @category    string
 * @copyright   1999 Ayoub Ben Chahla and contributors
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['bytescalcfailed'] = 'Impossible de calculer les octets (mode fast=0). Raison : {$a}';
$string['bytesline'] = 'Octets : <strong>{$a->migrated}</strong> / <strong>{$a->total}</strong> &amp;nbsp;|&amp;nbsp; Taux (10 min) : <strong>{$a->rate}/min</strong> &amp;nbsp;|&amp;nbsp; ETA (octets) : <strong>{$a->eta}</strong>';
$string['cachedef_missing_count'] = 'Nombre d’éléments manquants dans le cache';
$string['eta'] = 'Heure d’arrivée estimée : <strong>{$a}</strong>';
$string['instruction_install'] = '<p><strong>Ajoutez la ligne ci-dessous au fichier <code>config.php</code> de Moodle :</strong></p><pre><code>$CFG->alternative_file_system_class = "\\local_alternative_file_system\\external_file_system";</code></pre><p><strong>Important :</strong> insérez cette ligne <strong>avant</strong> la ligne ci-dessous (si elle existe dans votre fichier) :</p><pre><code>require_once(__DIR__ . "/lib/setup.php");</code></pre>';
$string['instruction_title'] = 'Instructions d’installation';
$string['lasttransfer'] = 'Dernier transfert : <strong>{$a}</strong>';
$string['migrate_link'] = '<p><a class="btn btn-success" href="?execute=1">Exécuter maintenant (peut prendre beaucoup de temps)</a></p>';
$string['migrate_title'] = 'Migrer le stockage local vers le stockage distant';
$string['migrate_title_tolocal'] = 'Migrer le stockage distant vers le stockage local';
$string['migrate_total'] = '<p>Vous avez <strong>{$a->missing}</strong> fichiers locaux en attente de migration, tandis que <strong>{$a->sending}</strong> fichiers ont déjà été migrés vers l’environnement distant.</p>';
$string['migrate_total_local'] = 'Déplace les fichiers du stockage distant vers le stockage local. Cela peut prendre un certain temps selon la quantité de données.';
$string['migratedfiles'] = 'Migrés : <strong>{$a}</strong>';
$string['nostoragefound'] = 'Aucun stockage trouvé à rapporter. Vérifiez si la table local_alternativefilesystemf contient des enregistrements.';
$string['pluginname'] = 'Système de fichiers alternatif';
$string['privacy:no_data_reason'] = 'Le plugin Système de fichiers alternatif ne stocke aucune donnée personnelle.';
$string['rate'] = 'Taux : <strong>{$a->r1}</strong> fichier/min (1 min) &amp;nbsp;|&amp;nbsp; <strong>{$a->r10}</strong> fichier/min (10 min) &amp;nbsp;|&amp;nbsp; <strong>{$a->r60}</strong> fichier/min (60 min)';
$string['remainingfiles'] = 'Restants : <strong>{$a}</strong>';
$string['reporttitle_status'] = 'Statut';
$string['settings_bucketname'] = 'Nom du compartiment {$a->local}';
$string['settings_bucketnamedesc'] = 'Le nom unique attribué au compartiment dans {$a->local}.';
$string['settings_gcs_keyfile'] = 'Contenu de google-storage.json';
$string['settings_gcs_keyfiledesc'] = 'Collez ici le contenu du fichier "google-storage.json".';
$string['settings_local'] = 'Fichiers locaux dans Moodle';
$string['settings_migrate_local'] = 'Utilisez le service <a target="_blank" href="{$a->url}/move-to-local.php">move-to-local.php</a> pour migrer les données de {$a->local} vers le stockage local.';
$string['settings_migrate_remote'] = 'Utilisez le service <a target="_blank" href="{$a->url}/move-to-external.php">move-to-external.php</a> pour migrer les données du stockage local vers {$a->local}.';
$string['settings_objectfs_notice'] = '<p>Actuellement, <code>$CFG->alternative_file_system_class</code> est défini sur <code>"{$a->currentclass}";</code> et cela signifie que ce site utilise actuellement <strong>tool_objectfs</strong> comme système de fichiers alternatif de Moodle.</p>

<p>Pour utiliser les mêmes paramètres et ne perdre aucun fichier, utilisez les paramètres suivants dans ce plugin :</p>
<ul>
  <li><strong>{$a->settings_local_lang}</strong> : <code>{$a->settings_local}</code></li>
  <li><strong>{$a->settings_s3_region_lang}</strong> : <code>{$a->settings_s3_region}</code></li>
  <li><strong>{$a->settings_s3_credentials_key_lang}</strong> : <code>{$a->settings_s3_credentials_key}</code></li>
  <li><strong>{$a->settings_s3_credentials_secret_lang}</strong> : <code>{$a->settings_s3_credentials_secret}</code></li>
  <li><strong>{$a->settings_bucketname_lang}</strong> : <code>{$a->settings_bucketname}</code></li>
  <li><strong>{$a->settings_path_lang}</strong> : <code>{$a->settings_path}</code></li>
</ul>

<p>Ensuite, vous devez d’abord modifier la valeur dans <code>config.php</code> en <code>$CFG->alternative_file_system_class = "\\local_alternative_file_system\\external_file_system";</code> afin d’utiliser ce plugin comme système de fichiers alternatif.</p>';
$string['settings_path'] = 'Chemin de l’objet {$a->local}';
$string['settings_pathdesc'] = 'Le chemin à l’intérieur du compartiment où les objets seront stockés. Seules les lettres et les chiffres sont acceptés.';
$string['settings_s3_credentials_key'] = 'Clé d’accès {$a->local}';
$string['settings_s3_credentials_keydesc'] = 'La clé d’accès utilisée pour s’authentifier auprès du service {$a->local}.';
$string['settings_s3_credentials_secret'] = 'Clé secrète {$a->local}';
$string['settings_s3_credentials_secretdesc'] = 'La clé secrète utilisée pour s’authentifier auprès du service {$a->local}.';
$string['settings_s3_region'] = 'Région {$a->local}';
$string['settings_s3_regiondesc'] = 'La région où se trouve le compartiment {$a->local}, par exemple "{$a->ex_region}".';
$string['settings_s3generic_destino'] = 'S3 générique (endpoint personnalisé)';
$string['settings_s3generic_endpoint'] = 'URL de l’endpoint S3';
$string['settings_s3generic_endpoint_desc'] = 'L’endpoint est l’adresse de base de votre service S3 (un fournisseur compatible S3). Vous pouvez le saisir sans <code>https://</code> et avec ou sans le port. N’incluez pas les noms de buckets, ni uniquement l’hôte du service (et le port, si nécessaire).<blockquote>Exemples : <code>https://s3.eu-central-1.amazonaws.com</code>, <code>o000.idrivee.com</code> ou <code>minio:9000</code>.<br>N’utilisez PAS : <code><strong style="color:#673AB7;text-decoration:underline;">mybucket.</strong>s3.amazonaws.com</code> ou <code>server:9000<strong style="color:#673AB7;text-decoration:underline;">/mybucket</strong></code>.</blockquote>';
$string['settings_success'] = '<strong>Les données sont correctes.</strong><br>Veuillez faire preuve de prudence lors de la modification des paramètres, car toute modification incorrecte peut rendre les fichiers stockés inaccessibles.';
$string['storage_destination'] = 'Destination de stockage';
$string['storage_destinationdesc'] = 'Choisissez la destination de stockage et enregistrez pour charger les données liées au stockage.';
$string['totalfiles'] = 'Nombre total de fichiers dans MDL_FILES : <strong>{$a}</strong>';
