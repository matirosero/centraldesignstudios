<?php

/**
 * Load jQuery from Google CDN in footer
 */
if (!is_admin()) add_action( 'wp_enqueue_scripts', 'add_jquery_to_my_theme' );

function add_jquery_to_my_theme() {
    // scrap WP jquery and register from google cdn - load in footer
    wp_deregister_script('jquery');
    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js", false, null, true );    
    // load jquery
    wp_enqueue_script('jquery');
}

/**
 * Enqueue styles
 */
add_action( 'wp_enqueue_scripts', function() {

	wp_enqueue_style( 'centraldesign-style', get_stylesheet_uri() );


	wp_enqueue_style( 'centraldesign-dist-style', get_template_directory_uri() . '/assets/dist/css/style.css', array(), '' );

	//Google fonts: Raleway
	// font-family: 'Raleway', sans-serif;
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Raleway:400,400i,700,700i', false ); 

} );


/**
 * Enqueue scripts
 */
add_action( 'wp_enqueue_scripts', function() {

	// Add our main app js file
	wp_enqueue_script(
		'centraldesign_appjs', 
		get_template_directory_uri() . '/assets/dist/js/app.js',
		array( 'jquery' ),
		null,
		true
	);

	// wp_enqueue_script( 'centraldesign-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	// wp_enqueue_script( 'centraldesign-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	// Add comment script on single posts with comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (!is_admin()) {
	    // script will load in footer
		wp_enqueue_script( 'isotope-js',  get_stylesheet_directory_uri() . '/assets/dist/js/isotope.pkgd.min.js', array('jquery'), true );
		wp_enqueue_script( 'images-loaded',  get_stylesheet_directory_uri() . '/assets/dist/js/imagesloaded.pkgd.min.js', false, true );
	}



} );