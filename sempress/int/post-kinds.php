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
	if ( method_exists( 'Kind_Taxonomy', 'get_icon' ) ) {
		add_filter( 'kind_icon_display', '__return_false', 10 );
	}

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
 * Replace the Post-Format header with the Post-Kinds header
 *
 * @param  string $post_format_html Post-Format html
 * @return string                   Post-Kind html
 */
function sempress_post_kinds_format( $post_format_html ) {
	if ( ! get_post_kind_slug() ) {
		return $post_format_html;
	}

	$kind_slug = get_post_kind_slug();
	$kind_icon = Kind_Taxonomy::get_icon( $kind_slug );
	$kind_string = get_post_kind_string( $kind_slug );
	$kind_link = esc_url( get_post_kind_link( get_post_kind() ) );

	return sprintf( '<a class="kind kind-%s" href="%s">%s %s</a>', $kind_slug, $kind_link, $kind_icon, $kind_string );
}
add_filter( 'sempress_post_format', 'sempress_post_kinds_format' );
