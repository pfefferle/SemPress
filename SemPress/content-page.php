<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */
?>

<article <?php sempress_post_id(); ?> <?php post_class(); ?> itemscope itemtype="http://schema.org/WebPage">
  <header class="entry-header">
    <h1 class="entry-title p-name" itemprop="name"><?php the_title(); ?></h1>
  </header><!-- .entry-header -->

  <div class="entry-content e-content" itemprop="description">
    <?php sempress_the_post_thumbnail(); ?>
    <?php the_content(); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sempress' ), 'after' => '</div>' ) ); ?>
    <?php edit_post_link( __( 'Edit', 'sempress' ), '<span class="edit-link">', '</span>' ); ?>
  </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
