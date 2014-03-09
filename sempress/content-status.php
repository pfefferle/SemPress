<?php
/**
 * The template for displaying posts in the Status Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */
?>

<article <?php sempress_post_id(); ?> <?php post_class(); ?>>
  <?php if ( is_search() ) : // Only display Excerpts for search pages ?>
  <div class="entry-summary p-summary entry-title p-name" itemprop="name description">
    <?php the_excerpt(); ?>
  </div><!-- .entry-summary -->
  <?php else : ?>	  <?php if(in_array("context",get_post_custom_keys(get_the_ID()))){ 
		$customfields = get_post_custom(get_the_ID());
		echo '<div class="p-in-reply-to h-cite"><p>'.implode("</p><p>",$customfields["context"]).'</p></div>'; }?>
  <div class="entry-content e-content p-summary entry-title p-name" itemprop="name headline description articleBody">
    <?php sempress_the_post_thumbnail('<p>', '</p>'); ?>
    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sempress' ) ); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sempress' ), 'after' => '</div>' ) ); ?>
  </div><!-- .entry-content -->
  <?php endif; ?>
  
  <?php get_template_part( 'entry', 'footer' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
