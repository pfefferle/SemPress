<?php
/**
 * The template for displaying posts in the Aside Post Format on index and archive pages
 *
 * Learn more: http://codex.wordpress.org/Post_Formats
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */
?>

<article <?php sempress_post_id(); ?> <?php post_class(); ?>>
  <header class="entry-header">
    <h1 class="entry-title p-name"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sempress' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
  </header><!-- .entry-header -->

  <?php if ( is_search() ) : // Only display Excerpts for search pages ?>
  <div class="entry-summary p-summary">
    <?php the_excerpt(); ?>
  </div><!-- .entry-summary -->
  <?php else : ?>
  <div class="entry-content e-content">
    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sempress' ) ); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sempress' ), 'after' => '</div>' ) ); ?>
  </div><!-- .entry-content -->
  <?php endif; ?>

  <footer class="entry-meta">
    <?php sempress_posted_on(); ?>
    <?php
      /* translators: used between list items, there is a space after the comma */
      $categories_list = get_the_category_list( __( ', ', 'sempress' ) );
      if ( $categories_list && sempress_categorized_blog() ) :
    ?>
    <span class="cat-links">
      <?php printf( __( 'in %1$s', 'sempress' ), $categories_list ); ?>
    </span>
    <?php endif; // End if categories ?>

    <?php
      /* translators: used between list items, there is a space after the comma */
      $tags_list = get_the_tag_list( '', __( ', ', 'sempress' ) );
      if ( $tags_list ) :
    ?>
    <span class="tag-links">
      <?php printf( __( 'tagged with %1$s', 'sempress' ), $tags_list ); ?>
    </span>
    <?php endif; // End if $tags_list ?>
    
    <?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
    <span class="sep"> | </span>
    <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'sempress' ), __( '1 Comment', 'sempress' ), __( '% Comments', 'sempress' ) ); ?></span>
    <?php endif; ?>
    <?php edit_post_link( __( 'Edit', 'sempress' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
  </footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
