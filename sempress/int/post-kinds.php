<?php
/**
 * SemPress Post Kinds
 *
 * Adds support for Post Kinds
 *
 * @link https://github.com/dshanske/indieweb-post-kinds
 *
 * @package SemPress
 * @subpackage indieweb
 */

/**
 * Removes native Post-Kinds implementation
 */
function sempress_post_kinds_init() {
	remove_filter( 'the_content', array( 'Kind_View', 'content_response' ), 9 );
	remove_filter( 'the_excerpt', array( 'Kind_View', 'excerpt_response' ), 9 );
	remove_action( 'wp_enqueue_scripts', array( 'Post_Kinds_Plugin', 'style_load' ) );
}
add_action( 'init', 'sempress_post_kinds_init' );

/**
 * Adds the reply-context above the article body
 *
 * @return string the reply-context
 */
function sempress_post_kinds_content() {
	printf( '<div class="entry-reaction">%s</div>', Kind_View::get_display() );
}
add_action( 'sempress_before_entry_content', 'sempress_post_kinds_content' );

/**
 * Adds `post-kind` classes to the array of post classes.
 *
 * @since SemPress 1.0.0
 */
function sempress_post_kinds_post_classes( $classes = array() ) {
	if ( Kind_View::get_display() ) {
		$classes[] = 'post-kind';
	}

	return $classes;
}
add_filter( 'post_class', 'sempress_post_kinds_post_classes', 99 );
