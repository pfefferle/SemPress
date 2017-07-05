<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">
		<div id="site-publisher" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
			<meta itemprop="name" content="<?php echo get_bloginfo( 'name', 'display' ); ?>" />
			<meta itemprop="url" content="<?php echo home_url( '/' ); ?>" />
			<?php
			if ( has_custom_logo() ) {
				$image = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ) );
			?>
				<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
					<meta itemprop="url" content="<?php echo current( $image ); ?>" />
					<meta itemprop="width" content="<?php echo next( $image ); ?>" />
					<meta itemprop="height" content="<?php echo next( $image ); ?>" />
				</div>
			<?php } ?>
		</div>
		<div id="site-generator">
			<?php do_action( 'sempress_credits' ); ?>
			<?php printf( __( 'This site is powered by %1$s and styled with %2$s', 'sempress' ), '<a href="http://wordpress.org/" rel="generator">WordPress</a>', '<a href="http://notiz.blog/projects/sempress/">SemPress</a>' ); ?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
