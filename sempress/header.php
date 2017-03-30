<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="profile" href="http://microformats.org/profile/specs" />
<link rel="profile" href="http://microformats.org/profile/hatom" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?><?php sempress_semantics( 'body' ); ?>>
<div id="page">
<?php do_action( 'before' ); ?>
	<header id="branding" role="banner">
		<?php
		if ( has_custom_logo() ) {
			$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) );
		?>
			<div class="u-photo photo logo" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
				<img itemprop="url" src="<?php echo current( $image ); ?>" />
				<meta itemprop="width" content="<?php echo next( $image ); ?>" />
				<meta itemprop="height" content="<?php echo next( $image ); ?>" />
			</div>
		<?php } ?>
		<h1 id="site-title"<?php sempress_semantics( 'site-title' ); ?>><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"<?php sempress_semantics( 'site-url' ); ?>><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="site-description"<?php sempress_semantics( 'site-description' ); ?>><?php bloginfo( 'description' ); ?></h2>

		<?php if ( get_header_image() ) { ?>
			<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="header image" id="site-image" />
		<?php } ?>

		<nav id="access" role="navigation">
			<h1 class="assistive-text section-heading"><a href="#access" title="<?php esc_attr_e( 'Main menu', 'sempress' ); ?>"><?php _e( 'Main menu', 'sempress' ); ?></a></h1>
			<a class="skip-link screen-reader-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'sempress' ); ?>"><?php _e( 'Skip to content', 'sempress' ); ?></a>

			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
		</nav><!-- #access -->
	</header><!-- #branding -->

	<div id="main">
