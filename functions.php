<?php

require (get_stylesheet_directory() . '/include/widget.php');

add_action( 'wp_enqueue_scripts', 'enqueue_parent_theme_style' ); 
function enqueue_parent_theme_style() {
	wp_enqueue_style( 'pasw2015_parent-style', get_template_directory_uri().'/style.css' );
}



function pasw2015_child_widgets_init() {

    register_sidebar( array(
        'name' => 'Special Page (SX)',
        'id' => 'sidebar-20',
        'description' => 'Area Widget (1) della Special Page.'
    ) );
    register_sidebar( array(
        'name' => 'Special Page (CX)',
        'id' => 'sidebar-21',
        'description' => 'Area Widget (2) della Special Page'
    ) );
    register_sidebar( array(
        'name' => 'Special Page (DX)',
        'id' => 'sidebar-22',
        'description' => 'Area Widget (3) della Special Page.'
    ) );
	register_sidebar( array(
        'name' => 'Sidebar Sticky - utilizzata nel nuovo template home child',
        'id' => 'sidebar-23',
        'description' => 'Area Widget Sticky.'
    ) );


}
add_action( 'widgets_init', 'pasw2015_child_widgets_init' );



/** changing default wordpres email settings */
 
add_filter('wp_mail_from', 'new_mail_from');
add_filter('wp_mail_from_name', 'new_mail_from_name');
 
function new_mail_from($old) {
 return 'no-replay@XXXX.it';
}
function new_mail_from_name($old) {
 return 'Istituco Comprensivo XXXXX';
}

/******* rimozione versione wordpress *******/

function remove_wordpress_version() {
return '';
}
add_filter('the_generator', 'remove_wordpress_version');


/******* login errata senza riscontro *******/

function my_login_messages($error) {
	return '<strong>ERROR</strong>: Autenticazione di accesso non valida.';
}

add_filter('login_errors','my_login_messages');
add_filter('pasw2015childedition', function($text) {return 'G';});
function add_types_files($mime_types){
	    $mime_types['p7m'] = 'application/p7m'; //Adding p7m extension
	    return $mime_types;
	}
add_filter('upload_mimes', 'add_types_files');
