<footer class="entry-meta">
  <?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
    <?php if (in_array(get_post_format(), array("aside", "link", "status", "quote"))) {
      sempress_posted_on();
    } else {
      _e( 'Posted', 'sempress' );
    }?>
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
    <span class="sep"> | </span>
    <span class="tag-links" itemprop="keywords">
      <?php printf( __( 'Tagged %1$s', 'sempress' ), $tags_list ); ?>
    </span>
    <?php endif; // End if $tags_list ?>
  <?php endif; // End if 'post' == get_post_type() ?>

  <?php if ( comments_open() || ( '0' != get_comments_number() && ! comments_open() ) ) : ?>
  <span class="sep"> | </span>
  <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'sempress' ), __( '1 Comment', 'sempress' ), __( '% Comments', 'sempress' ) ); ?></span>
  <?php endif; ?>

  <?php edit_post_link( __( 'Edit', 'sempress' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
</footer><!-- #entry-meta -->