<?php
defined( 'ABSPATH' ) || exit;

/**
 * The template for displaying Category Archive pages.
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */

get_header(); ?>

		<section id="primary">
			<main id="content" role="main"<?php sempress_main_class(); ?>>

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php the_archive_title(); ?></h1>

					<?php
					$category_description = category_description();
					if ( ! empty( $category_description ) ) {
						echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					}
					?>
				</header>

				<?php sempress_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php sempress_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title p-entry-title"><?php _e( 'Nothing Found', 'sempress' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content e-entry-content">
						<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'sempress' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</main><!-- #content -->
		</section><!-- #primary -->

<?php
if ( 'nosidebar' !== get_theme_mod( 'sempress_columns', 'multi' ) ) {
	get_sidebar();
}
?>
<?php get_footer(); ?>
