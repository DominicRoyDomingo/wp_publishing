<?php

require_once '_functions.php';

// data parsing
$post = get_post(get_the_ID());
$patterns = array();
$replacements = array();
$patterns[0] = '/"\[/mi';
$patterns[1] = '/\]"/mi';
$replacements[0] = '[';
$replacements[1] = ']';

// processing the whole content
$arr_content = preg_replace($patterns, $replacements, $post->post_content);

// folder
$algolia_slug_prefix = 'partials/single/algolia/';
