/**
 * Theme functions file
 *
 * Contains handlers for navigation, accessibility, header sizing
 * footer widgets and Featured Content slider
 *
 */
( function( $ ) {
  // Enable menu toggle for small screens.
  ( function() {
    var nav = $( '#primary-navigation' ), button, menu;
    if ( ! nav ) {
      return;
    }
  } )();

  $( function() {
    // Focus styles for menus.
    $( '#access, .secondary-navigation' ).find( 'a' ).on( 'focus.sempress blur.sempress', function() {
      $( this ).parents().toggleClass( 'focus' );
    } );
  } );
} )( jQuery );
