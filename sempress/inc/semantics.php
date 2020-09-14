<?php
/**
 * SemPress websemantics polyfill
 *
 * Some functions to add backwards compatibility to older WordPress versions
 * Adds some awesome websemantics like microformats(2) and microdata
 *
 * @link http://microformats.org/wiki/microformats
 * @link http://microformats.org/wiki/microformats2
 * @link http://schema.org
 * @link http://indiewebcamp.com
 *
 * @package SemPress
 * @subpackage semantics
 * @since SemPress 1.5.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since SemPress 1.0.0
 */
function sempress_body_classes( $classes = array() ) {
	$classes[] = get_theme_mod( 'sempress_columns', 'multi' ) . '-column';

	// Adds a class of single-author to blogs with only 1 published author
	if ( ! is_multi_author() ) {
		$classes[] = 'single-author';
	}

	if ( get_header_image() ) {
		$classes[] = 'custom-header';
	}

	if ( ! is_singular() && ! is_404() ) {
		$classes[] = 'hfeed';
		$classes[] = 'h-feed';
		$classes[] = 'feed';
	}

	return $classes;
}
add_filter( 'body_class', 'sempress_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since SemPress 1.0.0
 */
function sempress_post_classes( $classes = array() ) {
	$classes = array_diff( $classes, array( 'hentry' ) );

	if ( ! get_the_title() ) {
		$classes[] = 'no-title';
	}

	if ( ! is_singular() ) {
		return sempress_get_post_classes( $classes );
	} else {
		return $classes;
	}
}
add_filter( 'post_class', 'sempress_post_classes', 99 );

/**
 * Adds custom classes to the array of comment classes.
 *
 * @since SemPress 1.4.0
 */
function sempress_comment_classes( $classes = array() ) {
	$classes[] = 'h-entry';
	$classes[] = 'h-cite';
	$classes[] = 'p-comment';
	$classes[] = 'comment';

	return array_unique( $classes );
}
add_filter( 'comment_class', 'sempress_comment_classes', 99 );

/**
 * encapsulates post-classes to use them on different tags
 */
function sempress_get_post_classes( $classes = array() ) {
	if ( ! $classes ) {
		$classes = array();
	}
	// Adds a class for microformats v2
	$classes[] = 'h-entry';

	// add hentry to the same tag as h-entry
	$classes[] = 'hentry';

	return array_unique( $classes );
}

/**
 * Adds microformats v2 support to the comment_author_link.
 *
 * @since SemPress 1.0.0
 */
function sempress_author_link( $link ) {
	// Adds a class for microformats v2
	return preg_replace( '/(class\s*=\s*[\"|\'])/i', '${1}u-url ', $link );
}
add_filter( 'get_comment_author_link', 'sempress_author_link' );

/**
 * Adds microformats v2 support to the get_avatar() method.
 *
 * @since SemPress 1.0.0
 */
function sempress_pre_get_avatar_data( $args, $id_or_email ) {
	if ( ! isset( $args['class'] ) ) {
		$args['class'] = array();
	}

	// Adds a class for microformats v2
	$args['class'] = array_unique( array_merge( $args['class'], array( 'u-photo' ) ) );
	$args['extra_attr'] = 'itemprop="image"';

	return $args;
}
add_filter( 'pre_get_avatar_data', 'sempress_pre_get_avatar_data', 99, 2 );

/**
 * add rel-prev attribute to previous_image_link
 *
 * @param string a-tag
 * @return string
 */
function sempress_semantic_previous_image_link( $link ) {
	return preg_replace( '/<a/i', '<a rel="prev"', $link );
}
add_filter( 'previous_image_link', 'sempress_semantic_previous_image_link' );

/**
 * add rel-next attribute to next_image_link
 *
 * @param string a-tag
 * @return string
 */
function sempress_semantic_next_image_link( $link ) {
	return preg_replace( '/<a/i', '<a rel="next"', $link );
}
add_filter( 'next_image_link', 'sempress_semantic_next_image_link' );

/**
 * add rel-prev attribute to next_posts_link_attributes
 *
 * @param string attributes
 * @return string
 */
function sempress_next_posts_link_attributes( $attr ) {
	return $attr . ' rel="prev"';
}
add_filter( 'next_posts_link_attributes', 'sempress_next_posts_link_attributes' );

/**
 * add rel-next attribute to previous_posts_link
 *
 * @param string attributes
 * @return string
 */
function sempress_previous_posts_link_attributes( $attr ) {
	return $attr . ' rel="next"';
}
add_filter( 'previous_posts_link_attributes', 'sempress_previous_posts_link_attributes' );

/**
 *
 *
 */
function sempress_get_search_form( $form ) {
	$form = preg_replace( '/<form/i', '<form itemprop="potentialAction" itemscope itemtype="http://schema.org/SearchAction"', $form );
	$form = preg_replace( '/<\/form>/i', '<meta itemprop="target" content="' . home_url( '/?s={search} ' ) . '"/></form>', $form );
	$form = preg_replace( '/<input type="search"/i', '<input type="search" itemprop="query-input"', $form );

	return $form;
}
add_filter( 'get_search_form', 'sempress_get_search_form' );

/**
 * add semantics
 *
 * @param string $id the class identifier
 * @return array
 */
function sempress_get_semantics( $id = null ) {
	$classes = array();

	// add default values
	switch ( $id ) {
		case 'body':
			if ( ! is_singular() ) {
				$classes['itemscope'] = array( '' );
				$classes['itemtype'] = array( 'http://schema.org/Blog', 'http://schema.org/WebPage' );
			} elseif ( is_single() ) {
				$classes['itemscope'] = array( '' );
				$classes['itemtype'] = array( 'http://schema.org/BlogPosting' );
			} elseif ( is_page() ) {
				$classes['itemscope'] = array( '' );
				$classes['itemtype'] = array( 'http://schema.org/WebPage' );
			}
			break;
		case 'site-title':
			if ( ! is_singular() ) {
				$classes['itemprop'] = array( 'name' );
				$classes['class'] = array( 'p-name' );
			}
			break;
		case 'site-description':
			if ( ! is_singular() ) {
				$classes['itemprop'] = array( 'description' );
				$classes['class'] = array( 'p-summary', 'e-content' );
			}
			break;
		case 'site-url':
			if ( ! is_singular() ) {
				$classes['itemprop'] = array( 'url' );
				$classes['class'] = array( 'u-url', 'url' );
			}
			break;
		case 'post':
			if ( ! is_singular() ) {
				$classes['itemprop'] = array( 'blogPost' );
				$classes['itemscope'] = array( '' );
				$classes['itemtype'] = array( 'http://schema.org/BlogPosting' );
			}
			break;
	}

	$classes = apply_filters( 'sempress_semantics', $classes, $id );
	$classes = apply_filters( "sempress_semantics_{$id}", $classes, $id );

	return $classes;
}

/**
 * echos the semantic classes added via
 * the "sempress_semantics" filters
 *
 * @param string $id the class identifier
 */
function sempress_semantics( $id ) {
	$classes = sempress_get_semantics( $id );

	if ( ! $classes ) {
		return;
	}

	foreach ( $classes as $key => $value ) {
		echo ' ' . esc_attr( $key ) . '="' . esc_attr( join( ' ', $value ) ) . '"';
	}
}

/**
 * Add `p-category` to tags links
 *
 * @link https://www.webrocker.de/2016/05/13/add-class-attribute-to-wordpress-the_tags-markup/
 *
 * @param  array $links
 * @return array
 */
function sempress_term_links_tag( $links ) {
	$post  = get_post();
	$terms = get_the_terms( $post->ID, 'post_tag' );

	if ( is_wp_error( $terms ) ) {
		return $terms;
	}

	if ( empty( $terms ) ) {
		return false;
	}

	$links = array();
	foreach ( $terms as $term ) {
		$link = get_term_link( $term );

		if ( is_wp_error( $link ) ) {
			return $link;
		}

		$links[] = '<a class="p-category" href="' . esc_url( $link ) . '" rel="tag">' . $term->name . '</a>';
	}

	return $links;
}
add_filter( 'term_links-post_tag', 'sempress_term_links_tag' );

function sempress_main_class( $class = '' ) {
	// Separates class names with a single space, collates class names for body element
	echo ' class="' . join( ' ', sempress_get_main_class( $class ) ) . '"';
}

function sempress_get_main_class( $class = '' ) {
	$classes = array();

	if ( is_singular() ) {
		$classes = sempress_get_post_classes( $classes );
	}

	if ( ! empty( $class ) ) {
		if ( ! is_array( $class ) ) {
			$class = preg_split( '#\s+#', $class );
		}
		$classes = array_merge( $classes, $class );
	} else {
		// Ensure that we always coerce class to being an array.
		$class = array();
	}

	$classes = array_map( 'esc_attr', $classes );

	/**
	 * Filters the list of CSS main class names for the current post or page.
	 *
	 * @since 2.8.0
	 *
	 * @param string[] $classes An array of main class names.
	 * @param string[] $class   An array of additional class names added to the main.
	 */
	$classes = apply_filters( 'sempress_main_class', $classes, $class );

	return array_unique( $classes );
}
