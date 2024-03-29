<?php
defined( 'ABSPATH' ) || exit;

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */

get_header(); ?>

		<section id="primary">
			<main id="content" role="main"<?php sempress_main_class(); ?>>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #content -->
		</section><!-- #primary -->

<?php
if ( 'nosidebar' !== get_theme_mod( 'sempress_columns', 'multi' ) ) {
	get_sidebar();
}
?>
<?php get_footer(); ?>
