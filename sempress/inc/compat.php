<?php
/**
 * SemPress back compat handling
 *
 * Some functions to add backwards compatibility to older WordPress versions
 * or to add some new functions to be more (for example) HTML5 compatible
 *
 * @package SemPress
 * @subpackage compat
 * @since SemPress 1.5.0
 */


/**
 * adds compat handling for WP versions pre-*.
 *
 * @category pre-all
 */

/**
 * adds the new HTML5 input types to the comment-form
 *
 * @param string $form
 * @return string
 */
function sempress_comment_input_required($fields) {
  $fields['author'] = preg_replace('/<input/', '<input required', $fields['author']);
  $fields['email'] = preg_replace('/<input/', '<input required', $fields['email']);

  return $fields;
}
add_filter("comment_form_default_fields", "sempress_comment_input_required");


/**
 * adds the new HTML5 input types to the comment-form
 *
 * @param string $form
 * @return string
 */
function sempress_comment_autocomplete($fields) {
  $fields['author'] = preg_replace('/<input/', '<input autocomplete="nickname name" ', $fields['author']);
  $fields['email'] = preg_replace('/<input/', '<input autocomplete="email" ', $fields['email']);
  $fields['url'] = preg_replace('/<input/', '<input autocomplete="url" ', $fields['url']);

  return $fields;
}
add_filter("comment_form_default_fields", "sempress_comment_autocomplete");


/**
 * Adds back compat handling for WP versions pre-3.9.
 *
 * @category pre-3.9
 */
if ( version_compare( $GLOBALS['wp_version'], '3.9', '<' ) ) {
  add_filter( 'img_caption_shortcode', 'sempress_html5_caption', 10, 3 );
}


/**
 * HTML5: Use figure and figcaption for captions
 *
 * @param string $empty Empty string
 * @param array $attr Attributes attributed to the shortcode
 * @param string $content Shortcode content
 * @return string the HTML5 code
 */
function sempress_html5_caption($empty, $attr, $content) {
  extract(shortcode_atts(array(
    'id'      => '',
    'align'   => 'alignnone',
    'width'   => sempress_content_width(),
    'caption' => ''
  ), $attr));

  if ( 1 > (int) $width || empty($caption) )
    return $empty;

  $capid = '';
  if ( $id ) {
    $id = esc_attr($id);
    $capid = 'id="figcaption_'. $id . '" ';
    $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
  }

  return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align)
    . '" style="width: ' . $width . 'px;">'
    . do_shortcode( $content ) . '<figcaption ' . $capid
    . 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}


/**
 * adds back compat handling for WP versions pre-3.6.
 *
 * @category pre-3.6
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6', '<' ) ) {
  add_filter("comment_form_default_fields", "sempress_comment_input_types");
  add_filter("get_search_form", "sempress_search_form_input_type");
}


/**
 * adds the new HTML5 input types to the comment-form
 *
 * @param string $form
 * @return string
 */
function sempress_comment_input_types($fields) {
  $fields['email'] = preg_replace('/"text"/', '"email"', $fields['email']);
  $fields['url'] = preg_replace('/"text"/', '"url"', $fields['url']);

  return $fields;
}


/**
 * adds the new HTML5 input type to the search-field
 *
 * @param string $form
 * @return string
 */
function sempress_search_form_input_type($form) {
  return preg_replace('/"text"/', '"search" placeholder="'.__('Search here&hellip;', 'sempress').'"', $form);
}


/**
 * adds the new HTML5 input types to the comment-text-area
 *
 * @param string $field
 * @return string
 */
function sempress_comment_field_input_type($field) {
  return preg_replace('/<textarea/', '<textarea required', $field);
}
add_filter("comment_form_field_comment", "sempress_comment_field_input_type");
