<?php
defined( 'ABSPATH' ) || exit;

/**
 * The template used for displaying page content in page.php
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */
?>

<article <?php sempress_post_id(); ?> <?php post_class(); ?><?php sempress_semantics( 'page' ); ?>>
	<?php get_template_part( 'entry', 'header' ); ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary p-summary" itemprop="description">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<?php sempress_the_post_thumbnail( '<div class="entry-media">', '</div>' ); ?>

	<div class="entry-content e-content" itemprop="description text">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sempress' ), 'after' => '</div>' ) ); ?>
		<?php edit_post_link( __( 'Edit', 'sempress' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
