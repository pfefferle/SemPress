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
    <h1 class="entry-title p-name" itemprop="name headline"><?php the_title(); ?></h1>
  </header><!-- .entry-header -->
  
  <?php if ( '' != get_the_post_thumbnail() ) { ?>
  <div class="entry-media">
    <?php the_post_thumbnail( "post-thumbnail", array( "itemprop" => "image", "class" => "aligncenter" ) ); ?>
  </div>
  <?php } ?>
  
  <div class="entry-content e-content" itemprop="description">
    <?php the_content(); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sempress' ), 'after' => '</div>' ) ); ?>
    <?php edit_post_link( __( 'Edit', 'sempress' ), '<span class="edit-link">', '</span>' ); ?>
  </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
