<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    /*
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
    */
}

/*
 * Flickr Media Library (+ Picturefill)
 */
// picturefill CDN support
add_filter( 'picturefill_wp_use_cdn', '__return_true' );

// force mimic attachment handling
add_filter( 'fml_attachment_prepend', '__return_true' );
add_filter( 'fml_attachment_prepend_remove', '__return_true' );

// Register picturefill sizes that match theme breakpoints
if ( function_exists( 'fml_register_sizes' ) ) {
	fml_register_sizes(
		'2015-post-thumbnail-size',
		'(max-width:38.75em) 100vw, (max-width: 59.6875em) 84.6154vw, 58.82355vw',
		array( 'post-thumbnail')
	);
	/*
	fml_register_sizes(
		'theme-medium-sizes',
		'(max-width: 30em) 100vw, (max-width: 50em) 50vw, calc(33vw - 100px)',
		array( 'medium', 'Medium')
	);
	*/
}


/*
 * TCCommentary
 */
// Eliminate commentary's default stylesheet
add_filter( 'tccomment_add_default_css', '__return_false' );
// A fancier built-in tooltip (with gradients and such)
/*
function you_already_know($ignore) {
	return 'fancy.css';
}
add_filter( 'tccomment_default_css', 'you_already_know' );
*/
// Support the [tooltip] shortcode
//add_filter( 'tccomment_add_tooltip_shortcode', '__return_true');











