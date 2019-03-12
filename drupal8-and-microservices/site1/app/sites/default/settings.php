<?php

use Drupal\Core\Config\BootstrapConfigStorageFactory;
use Drupal\Core\Database\Database;

$settings['container_yamls'][] = __DIR__ . '/services.yml';

$databases['default']['default'] = array(
  'driver' => 'mysql',
  'database' => 'local',
  'username' => 'drupal',
  'password' => 'drupal',
  'host' => 'db',
);
$config['cron_safe_threshold'] = '0';
$settings['file_public_path'] = 'sites/default/files';
$config['system.file.path.temporary'] = 'sites/default/files/tmp';
$settings['file_private_path'] = 'sites/default/files/private';

$settings['install_profile'] = 'standard';

$settings['hash_salt'] = 'hackme';

$settings['trusted_host_patterns'][] = '^127\.0\.0\.1$';
$settings['trusted_host_patterns'][] = '^localhost$';
