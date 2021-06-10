<?php

function wpplugin_scripts()
{
    wp_enqueue_script(
        'algolia-custom-integration',
        WPPLUGIN_URL . '/js/admin.js',
        ['jquery'],
        false
    );
}
add_action('admin_enqueue_scripts', 'wpplugin_scripts', 100);
