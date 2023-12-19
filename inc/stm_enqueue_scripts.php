<?php 
function stm_enqueue_child_styles() {
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('stm-theme-style') );
	wp_enqueue_script( 'stm-boost-listing', get_stylesheet_directory_uri() . '/assets/js/stm_boost_listing.js', array(), time(), true );
	wp_enqueue_script( 'stm-send-report', get_stylesheet_directory_uri() . '/assets/js/send-report.js', array(), time(), true );
}
//Enqueue scripts
add_action( 'wp_enqueue_scripts', 'stm_enqueue_child_styles' );