  <header class="page-header">
    <h1 class="page-title">
      <?php
        if ( is_category() ) :
          single_cat_title();

        elseif ( is_tag() ) :
          single_tag_title();

        elseif ( is_author() ) :
          printf( __( 'Author: %s', 'sempress' ), '<span class="vcard">' . get_the_author() . '</span>' );

        elseif ( is_day() ) :
          printf( __( 'Day: %s', 'sempress' ), '<span>' . get_the_date() . '</span>' );

        elseif ( is_month() ) :
          printf( __( 'Month: %s', 'sempress' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'sempress' ) ) . '</span>' );

        elseif ( is_year() ) :
          printf( __( 'Year: %s', 'sempress' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'sempress' ) ) . '</span>' );

        elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
          _e( 'Asides', 'sempress' );

        elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
          _e( 'Galleries', 'sempress');

        elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
          _e( 'Images', 'sempress');

        elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
          _e( 'Videos', 'sempress' );

        elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
          _e( 'Quotes', 'sempress' );

        elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
          _e( 'Links', 'sempress' );

        elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
          _e( 'Statuses', 'sempress' );

        elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
          _e( 'Audio', 'sempress' );

        elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
          _e( 'Chats', 'sempress' );

        elseif ( is_404( 'post_format', 'post-format-chat' ) ) :
          _e( 'Well this is somewhat embarrassing, isn&rsquo;t it?', 'sempress' );

        else :
          _e( 'Archives', 'sempress' );

        endif;
      ?>
    </h1>

    <?php /* If this is a category archive */ if (is_category()) { ?>
      <div class="category-archive-meta"><?php echo category_description( $category_id ); ?></div>
    <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
      <?php /* Show an optional tag description. */ $tag_description = tag_description(); if ( ! empty( $tag_description ) ) echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' ); ?>
    <?php /* If this is a tag archive */ } elseif( is_tax() ) { ?>
      <?php /* Show an optional term description. */ $term_description = term_description(); if ( ! empty( $term_description ) ) : printf( '<div class="taxonomy-description">%s</div>', $term_description ); endif; ?>
    <?php } ?>

  </header><!-- .page-header -->