<?php

// namespace Eco;

/**
 * Enqueue styles
 */
add_action( 'wp_enqueue_scripts', function() {

	wp_enqueue_style( 'centraldesign-style', get_stylesheet_uri() );

	wp_enqueue_script( 'centraldesign-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'centraldesign-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style( 'centraldesign-dist-style', get_template_directory_uri() . '/assets/dist/css/style.css', array(), '' );

	// wp_enqueue_style(
	// 	'eco_styles',
	// 	ECO_URL . '/assets/dist/css/app.css',
	// 	'',
	// 	ECO_VERSION,
	// 	''
	// );

	//Google fonts: PT Serif & Reenie Beanie
	// font-family: 'PT Serif', serif;
	// font-family: 'Reenie Beanie', cursive;
	wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=PT+Serif:400,400i,700,700i|Reenie+Beanie&subset=latin-ext', false ); 
	

} );