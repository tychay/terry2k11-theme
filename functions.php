<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

if ( function_exists( 'fml_register_sizes' ) ) {
	fml_register_sizes(
		'theme-medium-sizes',
		'(max-width: 30em) 100vw, (max-width: 50em) 50vw, calc(33vw - 100px)',
		array( 'medium', 'Medium')
	);
}
// add picturefill cdn support
add_filter( 'picturefill_wp_use_cdn', '__return_true' );
// eliminate commentary's default stylesheet
add_filter( 'tccomment_add_default_css', '__return_false' );