<?php
/**
 * Theme functions and definitions.
 */
function travic_child_enqueue_styles() {

    if ( SCRIPT_DEBUG ) {
        wp_enqueue_style( 'travic-style' , get_template_directory_uri() . '/style.css' );
    } else {
        wp_enqueue_style( 'travic-minified-style' , get_template_directory_uri() . '/style.min.css' );
    }

    wp_enqueue_style( 'travic-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'travic-style' ),
        wp_get_theme()->get('Version')
    );
}

add_action(  'wp_enqueue_scripts', 'travic_child_enqueue_styles' );