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
 * Fix more link text
 *
 * Basically remove the arrow, and make sure "Continue reading " is there as well as my habit of saying
 * after the jump. (unless link is bare, in which case, pass it on through)
 */
function terry2k_more_link( $more_link_element, $more_link_text ) {
	$post = get_post();
	$link = get_permalink();
	if ( strpos( $more_link_text, 'Continue reading <span') !== 0 ) {
		// strip the arrow since css rule applies it
		if ( mb_substr($more_link_text, -1) == '→' ) {
			$more_link_text = mb_substr( $more_link_text, 0, -1 );
		}
		// Add Continue reading about…
		if ( strpos($more_link_text, 'Continue reading') !== 0 ) {
			$more_link_text = 'Continue reading about '.$more_link_text;
		}
		// Add …after the jump
		if ( !strpos( $more_link_text, ' after the jump' ) ) {
			$more_link_text = $more_link_text . ' after the jump';
		}
	}
	return sprintf(
		'<a href="%s#more-%d" class="more-link">%s</a>',
		esc_attr( $link ),
		$post->ID,
		$more_link_text
		);
}
add_filter( 'the_content_more_link', 'terry2k_more_link', 10, 2 );

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











