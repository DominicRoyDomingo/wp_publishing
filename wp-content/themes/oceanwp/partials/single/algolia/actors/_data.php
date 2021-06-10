<?php

include get_template_directory() . '/partials/single/algolia/utils/_data.php';

// data
$actors_meta = json_decode($arr_content, true);

// template slug
$actors_slug = $algolia_slug_prefix . 'actors/';

//account status
$account_status = $actors_meta['account_status'];

// subscription - free message
$default_message = "Vorresti inserire il tuo studio o la tua struttura in questo elenco?";
?>