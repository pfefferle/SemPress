<?php
/**
 * SemPress Syndication Links
 *
 * Adds support for Syndication Links
 *
 * @link https://github.com/dshanske/syndication-links
 *
 * @package SemPress
 * @subpackage indieweb
 */

/**
 * Remove the integration of `the_content` filter
 */
function sempress_syndication_links_init() {
	remove_filter( 'the_content', array( 'Syn_Config', 'the_content' ) , 30 );
}
add_action( 'init', 'sempress_syndication_links_init' );

/**
 * Remove the Syndication-Links CSS
 */
function sempress_syndication_links_print_scripts() {
	wp_dequeue_style( 'syndication-style' );
}
add_action( 'wp_print_styles', 'sempress_syndication_links_print_scripts', 100 );

/**
 * Added links to the post-footer
 */
function sempress_syndication_links() {
	if ( function_exists( 'get_syndication_links' ) && get_syndication_links() ) {
		echo '<span class="sep"> | </span>';
		_e( 'Syndication Links', 'sempress' );
		echo get_syndication_links( null, array( 'show_text_before' => null) );
	}
}
add_action( 'sempress_entry_footer', 'sempress_syndication_links' );
