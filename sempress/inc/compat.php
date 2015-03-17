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
 * adds the new HTML5 input types to the comment-text-area
 *
 * @param string $field
 * @return string
 */
function sempress_comment_field_input_type($field) {
  return preg_replace('/<textarea/', '<textarea required', $field);
}
add_filter("comment_form_field_comment", "sempress_comment_field_input_type");

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
