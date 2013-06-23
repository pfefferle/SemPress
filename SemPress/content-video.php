<?php
/**
 * @package SemPress
 * @since SemPress 1.0.0
 */
?>

<article <?php sempress_post_id(); ?> <?php post_class(); ?><?php sempress_blog_itemprop("blogPost"); ?> itemscope itemtype="http://schema.org/BlogPosting">
  <header class="entry-header">
    <h1 class="entry-title p-name" itemprop="name headline"><a href="<?php the_permalink(); ?>" class="u-url url" title="<?php printf( esc_attr__( 'Permalink to %s', 'sempress' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h1>

    <div class="entry-meta">
      <?php sempress_posted_on(); ?>
    </div><!-- .entry-meta -->
  </header><!-- .entry-header -->

  <?php if ( is_search() ) : // Only display Excerpts for Search ?>
  <div class="entry-summary p-summary" itemprop="description">
    <?php the_excerpt(); ?>
  </div><!-- .entry-summary -->
  <?php else : ?>
  <div class="entry-content e-content" itemprop="description articleBody">
    <?php sempress_the_post_thumbnail(); ?>
    <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sempress' ) ); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'sempress' ), 'after' => '</div>' ) ); ?>
  </div><!-- .entry-content -->
  <?php endif; ?>

  <?php get_template_part( 'entry', 'footer' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
