<?php
function enqueue_theme_assets() {
    wp_enqueue_style('styles', get_template_directory_uri() . '/css/style.css', array(), filemtime(get_template_directory() . '/css/style.css'));
    wp_enqueue_script('scroll-to', get_template_directory_uri() . '/js/scrollTo.js', array(), filemtime(get_template_directory() . '/js/scrollTo.js'), true);
}
add_action('wp_enqueue_scripts', 'enqueue_theme_assets');


function plp_disable_gutenberg() {
    remove_post_type_support('page', 'editor');
}
add_action('init', 'plp_disable_gutenberg');

function plp_register_strings() {
    pll_register_string('Home', 'Home');
}
add_action('plugins_loaded', 'plp_register_strings');