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
function sempress_body_classes( $classes ) {
  $classes[] = get_theme_mod( 'sempress_columns', 'multi' ). "-column";

  // Adds a class of single-author to blogs with only 1 published author
  if ( ! is_multi_author() ) {
    $classes[] = 'single-author';
  }

  if ( get_header_image() ) {
    $classes[] = 'custom-header';
  }

  if (!is_singular()) {
    $classes[] = "hfeed";
    $classes[] = "h-feed";
    $classes[] = "feed";
  } else {
    $classes = sempress_get_post_classes($classes);
  }

  return $classes;
}
add_filter( 'body_class', 'sempress_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since SemPress 1.0.0
 */
function sempress_post_classes( $classes ) {
  $classes = array_diff($classes, array('hentry'));

  if (!is_singular()) {
    return sempress_get_post_classes($classes);
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
function sempress_comment_classes( $classes ) {
  $classes[] = "h-as-comment";
  $classes[] = "h-entry";
  $classes[] = "h-cite";
  $classes[] = "p-comment";
  $classes[] = "comment";

  return array_unique($classes);
}
add_filter( 'comment_class', 'sempress_comment_classes', 99 );

/**
 * encapsulates post-classes to use them on different tags
 */
function sempress_get_post_classes($classes = array()) {
  // Adds a class for microformats v2
  $classes[] = 'h-entry';

  // add hentry to the same tag as h-entry
  $classes[] = 'hentry';

  // adds microformats 2 activity-stream support
  // for pages and articles
  if ( get_post_type() == "page" ) {
    $classes[] = "h-as-page";
  }
  if ( !get_post_format() && get_post_type() == "post" ) {
    $classes[] = "h-as-article";
  }

  // adds some more microformats 2 classes based on the
  // posts "format"
  switch ( get_post_format() ) {
    case "aside":
    case "status":
      $classes[] = "h-as-note";
      break;
    case "audio":
      $classes[] = "h-as-audio";
      break;
    case "video":
      $classes[] = "h-as-video";
      break;
    case "gallery":
    case "image":
      $classes[] = "h-as-image";
      break;
    case "link":
      $classes[] = "h-as-bookmark";
      break;
  }

  return array_unique($classes);
}

/**
 * Adds microformats v2 support to the comment_author_link.
 *
 * @since SemPress 1.0.0
 */
function sempress_author_link( $link ) {
  // Adds a class for microformats v2
  return preg_replace('/(class\s*=\s*[\"|\'])/i', '${1}u-url ', $link);
}
add_filter( 'get_comment_author_link', 'sempress_author_link' );

/**
 * Adds microformats v2 support to the get_avatar() method.
 *
 * @since SemPress 1.0.0
 */
function sempress_pre_get_avatar_data( $args, $id_or_email ) {
  if(!isset($args['class']) ) {
    $args['class'] = array();
  }

  // Adds a class for microformats v2
  $args['class'] = array_unique(array_merge($args['class'], array('u-photo')));
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
  return $attr.' rel="prev"';
}
add_filter( 'next_posts_link_attributes', 'sempress_next_posts_link_attributes' );

/**
 * add rel-next attribute to previous_posts_link
 *
 * @param string attributes
 * @return string
 */
function sempress_previous_posts_link_attributes( $attr ) {
  return $attr.' rel="next"';
}
add_filter( 'previous_posts_link_attributes', 'sempress_previous_posts_link_attributes' );

/**
 * add semantics
 *
 * @param string $id the class identifier
 * @return array
 */
function sempress_get_semantics($id = null) {
  $classes = array();

  // add default values
  switch ($id) {
    case "body":
      if (!is_singular()) {
        $classes['itemscope'] = array('');
        $classes['itemtype'] = array('http://schema.org/Blog');
      } elseif (is_single()) {
        $classes['itemscope'] = array('');
        $classes['itemtype'] = array('http://schema.org/BlogPosting');
        $classes['itemprop'] = array('mainEntityOfPage');
      } elseif (is_page()) {
        $classes['itemscope'] = array('');
        $classes['itemtype'] = array('http://schema.org/WebPage');
        $classes['itemprop'] = array('mainEntityOfPage');
      }
      break;
    case "site-title":
      if (!is_singular()) {
        $classes['itemprop'] = array('name');
        $classes['class'] = array('p-name');
      }
      break;
    case "site-description":
      if (!is_singular()) {
        $classes['itemprop'] = array('description');
        $classes['class'] = array('p-summary', 'e-content');
      }
      break;
    case "site-url":
      if (!is_singular()) {
        $classes['itemprop'] = array('url');
        $classes['class'] = array('u-url', 'url');
      }
      break;
    case "post":
      if (!is_singular()) {
        $classes['itemprop'] = array('blogPost');
        $classes['itemscope'] = array('');
        $classes['itemtype'] = array('http://schema.org/BlogPosting');
      }
      break;
  }

  $classes = apply_filters( "sempress_semantics", $classes, $id );
  $classes = apply_filters( "sempress_semantics_{$id}", $classes, $id );

  return $classes;
}

/**
 * echos the semantic classes added via
 * the "sempress_semantics" filters
 *
 * @param string $id the class identifier
 */
function sempress_semantics($id) {
  $classes = sempress_get_semantics($id);

  if (!$classes) {
    return;
  }

  foreach ( $classes as $key => $value ) {
    echo ' ' . esc_attr( $key ) . '="' . esc_attr( join( ' ', $value ) ) . '"';
  }
}
