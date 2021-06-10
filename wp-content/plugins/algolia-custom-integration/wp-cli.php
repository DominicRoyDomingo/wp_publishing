<?php

if (!(defined('WP_CLI') && WP_CLI)) {
	return;
}

require_once __DIR__ . '/cli/providers.php';
require_once __DIR__ . '/cli/courses.php';
require_once __DIR__ . '/cli/geolocalization.php';
require_once __DIR__ . '/cli/actors.php';

$env_file = $_SERVER['SERVER_NAME'] == "www.med4.care" ? ".env" : ".env.development";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__, $env_file);
$dotenv->load();

WP_CLI::add_command('algolia', 'Providers');
WP_CLI::add_command('algolia', 'Courses');
WP_CLI::add_command('algolia', 'Geolocalization');
WP_CLI::add_command('algolia', 'Actors');
