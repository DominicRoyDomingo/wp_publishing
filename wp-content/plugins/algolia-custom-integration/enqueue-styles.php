<?php

function wpplugin_styles()
{
    wp_enqueue_style(
        'algolia-custom-integration',
        WPPLUGIN_URL . '/css/admin.css',
        [],
        false
    );
}

add_action('admin_enqueue_scripts', 'wpplugin_styles');
