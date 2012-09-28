<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */

get_header(); ?>

    <section id="primary">
      <div id="content" role="main">

      <?php if ( have_posts() ) : ?>

        <?php
          /* Queue the first post, that way we know
           * what author we're dealing with (if that is the case).
           *
           * We reset this later so we can run the loop
           * properly with a call to rewind_posts().
           */
          the_post();
        ?>

        <header class="page-header author vcard h-card" itemprop="author" itemscope itemtype="http://schema.org/Person">
          <h1 class="page-title"><?php printf( __( 'Author Archives: %s', 'sempress' ), '<a class="url u-url fn p-fn n p-name" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me author" itemprop="url"><span itemprop="name">' . get_the_author() . '</span></a>' ); ?></h1>
          
        <?php if (get_the_author_meta('description')) { ?>
          <div class="author-note note p-note" itemprop="description"><?php echo get_the_author_meta('description'); ?></div>
        <?php } ?>
        </header>

        <?php
          /* Since we called the_post() above, we need to
           * rewind the loop back to the beginning that way
           * we can run the loop properly, in full.
           */
          rewind_posts();
        ?>

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

      </div><!-- #content -->
    </section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>