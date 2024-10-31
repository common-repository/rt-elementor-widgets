<?php
/**
 * Helpers functions
 *
 * @package RT_Elementor_Widgets
 * @author Rigorous Theme
 */

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Custom excerpts based on wp_trim_words
 *
 * @since	1.0.0
 * @link	http://codex.wordpress.org/Function_Reference/wp_trim_words
 */
if ( ! function_exists( 'rt_elementor_widget_excerpt' ) ) {

	function rt_elementor_widget_excerpt( $length = 15 ) {

		// Get global post
		global $post;

		// Get post data
		$id			= $post->ID;
		$excerpt	= $post->post_excerpt;
		$content 	= $post->post_content;

		// Display custom excerpt
		if ( $excerpt ) {
			$output = $excerpt;
		}

		// Check for more tag
		elseif ( strpos( $content, '<!--more-->' ) ) {
			$output = get_the_content( $excerpt );
		}

		// Generate auto excerpt
		else {
			$output = wp_trim_words( strip_shortcodes( get_the_content( $id ) ), $length );
		}

		// Echo output
		echo wp_kses_post( $output );

	}

}

if ( ! function_exists( 'rt_elementor_widget_posted_on' ) ):
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 *
	 * @since	1.0.0
	 */
	function rt_elementor_widget_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( ' %s', 'post date', 'rt-elementor-widgets' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif; 	