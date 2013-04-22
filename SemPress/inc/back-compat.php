<?php
/**
 * SemPress back compat functionality.
 *
 * @package WordPress
 * @since SemPress 1.4
 */

if ( ! function_exists( 'the_post_format_video' ) ) :
  function the_post_format_video() {
    return;
  }
endif;

if ( ! function_exists( 'the_post_format_audio' ) ) :
  function the_post_format_audio() {
    return;
  }
endif;

if ( ! function_exists( 'the_post_format_image' ) ) :
  function the_post_format_image( $attached_size = 'full' ) {
    return;
  }
endif;

if ( ! function_exists( 'the_post_format_chat' ) ) :
  function the_post_format_chat() {
    return the_content();
  }
endif;

if ( ! function_exists( 'the_remaining_content' ) ) :
  function the_remaining_content( $more_link_text = null, $strip_teaser = false ) {
    return the_content( $more_link_text, $stripteaser );
  }
endif;

if ( ! function_exists( 'get_post_format_meta' ) ) :
  function get_post_format_meta( $ID ) {
    return;
  }
endif;

if ( ! function_exists( 'the_post_format_quote' ) ) :
  function the_post_format_quote( &$post = null ) {
    return;
  }
endif;