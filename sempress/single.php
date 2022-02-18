<?php
defined( 'ABSPATH' ) || exit;

/**
 * The Template for displaying all single posts.
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */

get_header(); ?>

		<section id="primary">
			<main id="content" role="main"<?php sempress_main_class(); ?>>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php sempress_content_nav( 'nav-above' ); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>

				<?php sempress_content_nav( 'nav-below' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template( '', true );
				?>

			<?php endwhile; // end of the loop. ?>

			</main><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
