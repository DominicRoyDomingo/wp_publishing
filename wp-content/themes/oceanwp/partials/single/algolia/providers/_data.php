<?php

include get_template_directory() . '/partials/single/algolia/utils/_data.php';

// data
$provider_meta = json_decode($arr_content, true);

// template slug
$provider_slug = $algolia_slug_prefix . 'providers/';

// subscription
$is_free = $provider_meta['account_status'] == 'free';

if (!$is_free) {
    $container_class = "upgraded-provider";
}

// subscription - free message
$default_message = "Sei il Direttore di questa struttura e vuoi aiutarci a migliorare le informazioni qui pubblicate?";

// location
$provider_location = null;

if ($provider_meta['address'])
    if (
        $provider_meta['city']['name']
        || $provider_meta['division']['name']
        || $provider_meta['country']['name']
    ) {
        $provider_location .= trim($provider_meta['address']) . ", ";
    } else
        $provider_location .= trim($provider_meta['address']);
if ($provider_meta['city']['name'])
    if (
        $provider_meta['division']['name']
        || $provider_meta['country']['name']
    ) {
        $provider_location .= trim($provider_meta['city']['name']) . ", ";
    } else
        $provider_location .= trim($provider_meta['city']['name']);
if ($provider_meta['division']['name'])
    if (
        $provider_meta['country']['name']
    ) {
        $provider_location .= trim($provider_meta['division']['name']) . ", ";
    } else
        $provider_location .= trim($provider_meta['division']['name']);
if ($provider_meta['country']['name'])
    $provider_location .= trim($provider_meta['country']['name']);
