<?php
defined( 'ABSPATH' ) || exit;

/**
 * Template Name: Full-width, no sidebar
 * Description: A full-width template with no sidebar
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */

get_header(); ?>

		<section id="primary" class="full-width">
			<main id="content" role="main"<?php sempress_main_class(); ?>>

				<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #content -->
		</section><!-- #primary -->

<?php get_footer(); ?>
