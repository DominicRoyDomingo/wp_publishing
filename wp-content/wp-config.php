<?php
define('DB_NAME', 'wp_publishing');

define('DB_USER', 'usr_wp_publishing');

define('DB_PASSWORD', 'gf6tmH6us73GRV1s');

define('DB_HOST', 'localhost');

define('DB_CHARSET', 'utf8');

define('DB_COLLATE', '');

$table_prefix = 'wp_';

define('WP_DEBUG', false);

if (!defined('ABSPATH')) {
    define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
