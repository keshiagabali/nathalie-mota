<?php

//MENU
function register_header_menu() {
    register_nav_menu( 'header-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_header_menu' );

function register_footer_menu() {
    register_nav_menu( 'footer-menu', __( 'Footer Menu', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_footer_menu' );


/* STYLE ET SCRIPT */
function enqueue_custom_styles() {
    wp_enqueue_style('custom-theme-css', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

function enqueue_custom_scripts() {
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

/* IMG MIS EN AVANT */

add_theme_support( 'post-thumbnails' );


?>

