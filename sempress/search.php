<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */

get_header(); ?>

		<section id="primary">
			<main id="content" role="main"<?php sempress_main_class(); ?>>

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'sempress' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php sempress_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ? get_post_format() : get_post_type() ); ?>

				<?php endwhile; ?>

				<?php sempress_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title p-entry-title"><?php _e( 'Nothing Found', 'sempress' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content e-entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'sempress' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</main><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
