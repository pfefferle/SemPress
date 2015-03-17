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

    button = nav.find( '.menu-toggle' );
    if ( ! button ) {
      return;
    }

    // Hide button if menu is missing or empty.
    menu = nav.find( '.nav-menu' );
    if ( ! menu || ! menu.children().length ) {
      button.hide();
      return;
    }

    $( '.menu-toggle' ).on( 'click.twentyfourteen', function() {
      nav.toggleClass( 'toggled-on' );
    } );
  } )();

  $( function() {
    // Focus styles for menus.
    $( '#access, .secondary-navigation' ).find( 'a' ).on( 'focus.sempress blur.sempress', function() {
      $( this ).parents().toggleClass( 'focus' );
    } );
  } );
} )( jQuery );
