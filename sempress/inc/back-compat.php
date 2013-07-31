<?php
/**
 * adds the new HTML5 input types to the comment-form
 *
 * @param string $form
 * @return string
 */
function sempress_comment_input_types($fields) {
  if (get_option("require_name_email", false)) {
    $fields['author'] = preg_replace('/<input/', '<input required', $fields['author']);
    $fields['email'] = preg_replace('/"text"/', '"email" required', $fields['email']);
  } else {
    $fields['email'] = preg_replace('/"text"/', '"email"', $fields['email']);
  }

  $fields['url'] = preg_replace('/"text"/', '"url"', $fields['url']);

  return $fields;
}
add_filter("comment_form_default_fields", "sempress_comment_input_types");

/**
 * adds the new HTML5 input type to the search-field
 *
 * @param string $form
 * @return string
 */
function sempress_search_form_input_type($form) {
  return preg_replace('/"text"/', '"search" placeholder="'.__('Search here&hellip;', 'sempress').'"', $form);
}
add_filter("get_search_form", "sempress_search_form_input_type");

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