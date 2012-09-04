<?php
/**
 * SemPress functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package SemPress
 * @since SemPress 0.1
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
  $content_width = 600; /* pixels */

if ( ! function_exists( 'sempress_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override sempress_setup() in a child theme, add your own sempress_setup to your child theme's
 * functions.php file.
 */
function sempress_setup() {
  /**
   * Make theme available for translation
   * Translations can be filed in the /languages/ directory
   * If you're building a theme based on sempress, use a find and replace
   * to change 'sempress' to the name of your theme in all the template files
   */
  load_theme_textdomain( 'sempress', get_template_directory() . '/languages' );

  $locale = get_locale();
  $locale_file = get_template_directory() . "/languages/$locale.php";
  if ( is_readable( $locale_file ) )
    require_once( $locale_file );

  /**
   * Add default posts and comments RSS feed links to head
   */
  add_theme_support( 'automatic-feed-links' );
  
  /**
   * This theme uses post thumbnails
   */
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 600, 9999 ); // Unlimited height, soft crop

  /**
   * This theme uses wp_nav_menu() in one location.
   */
  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'sempress' ),
  ) );

  /**
   * Add support for the Aside and Gallery Post Formats
   */
  add_theme_support( 'post-formats', array( 'aside', 'image', 'gallery', 'quote', 'link', 'audio', 'video', 'status' ) );
}
endif; // sempress_setup

/**
 * Tell WordPress to run sempress_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'sempress_setup' );

/**
 * Set a default theme color array for WP.com.
 */
$themecolors = array(
  'bg' => 'ffffff',
  'border' => 'eeeeee',
  'text' => '444444',
);

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function sempress_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'sempress_page_menu_args' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function sempress_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Sidebar 1', 'sempress' ),
    'id' => 'sidebar-1',
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>',
  ) );

  register_sidebar( array(
    'name' => __( 'Sidebar 2', 'sempress' ),
    'id' => 'sidebar-2',
    'description' => __( 'An optional second sidebar area', 'sempress' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => "</aside>",
    'before_title' => '<h1 class="widget-title">',
    'after_title' => '</h1>',
  ) );
}
add_action( 'init', 'sempress_widgets_init' );

if ( ! function_exists( 'sempress_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since SemPress 0.1
 */
function sempress_content_nav( $nav_id ) {
  global $wp_query;

  ?>
  <nav id="<?php echo $nav_id; ?>">
    <h1 class="assistive-text section-heading"><?php _e( 'Post navigation', 'sempress' ); ?></h1>

  <?php if ( is_single() ) : // navigation links for single posts ?>

    <?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'sempress' ) . '</span> %title' ); ?>
    <?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'sempress' ) . '</span>' ); ?>

  <?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

    <?php if ( get_next_posts_link() ) : ?>
    <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sempress' ) ); ?></div>
    <?php endif; ?>

    <?php if ( get_previous_posts_link() ) : ?>
    <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sempress' ) ); ?></div>
    <?php endif; ?>

  <?php endif; ?>

  </nav><!-- #<?php echo $nav_id; ?> -->
  <?php
}
endif; // sempress_content_nav


if ( ! function_exists( 'sempress_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own sempress_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since SemPress 0.1
 */
function sempress_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment <?php $comment->comment_type; ?>">
      <footer>
        <div class="comment-author vcard h-card">
          <?php echo get_avatar( $comment, 40 ); ?>
          <?php printf( __( '%s <span class="says">says:</span>', 'sempress' ), sprintf( '<cite class="fn p-fn">%s</cite>', get_comment_author_link() ) ); ?>
        </div><!-- .comment-author .vcard -->
        <?php if ( $comment->comment_approved == '0' ) : ?>
          <em><?php _e( 'Your comment is awaiting moderation.', 'sempress' ); ?></em>
          <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata">
          <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time datetime="<?php comment_time( 'c' ); ?>">
          <?php
            /* translators: 1: date, 2: time */
            printf( __( '%1$s at %2$s', 'sempress' ), get_comment_date(), get_comment_time() ); ?>
          </time></a>
          <?php edit_comment_link( __( '(Edit)', 'sempress' ), ' ' ); ?>
        </div><!-- .comment-meta .commentmetadata -->
      </footer>

      <div class="comment-content"><?php comment_text(); ?></div>

      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div><!-- .reply -->
    </article><!-- #comment-## -->

  <?php
}
endif; // ends check for sempress_comment()

if ( ! function_exists( 'sempress_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own sempress_posted_on to override in a child theme
 *
 * @since SemPress 0.1
 */
function sempress_posted_on() {
  printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date updated dt-updated" datetime="%3$s" itemprop="dateModified">%4$s</time></a><span class="byline"> <span class="sep"> by </span> <span class="author p-author vcard h-card" itemprop="author" itemscope itemtype="http://schema.org/Person"><a class="url u-url fn p-fn p-name n" href="%5$s" title="%6$s" rel="author" itemprop="name url">%7$s</a></span></span>', 'sempress' ),
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    esc_attr( sprintf( __( 'View all posts by %s', 'sempress' ), get_the_author() ) ),
    esc_html( get_the_author() )
  );
}
endif;

/**
 * Adds post-thumbnail support :)
 *
 * @since SemPress 0.1
 */
function sempress_post_thumbnail($content) {
  if ( has_post_thumbnail() ) {
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
    $class = "aligncenter";
    if ($image['1'] < "480")
      $class="alignright";

    $post_thumbnail = '<p>'.get_the_post_thumbnail( null, "post-thumbnail", array( "class" => $class ) ).'</p>';

    return $post_thumbnail . $content;
  } else {
    return $content;
  }
}

add_action('the_content', 'sempress_post_thumbnail', 1);

/**
 * Adds custom classes to the array of body classes.
 *
 * @since SemPress 0.1
 */
function sempress_body_classes( $classes ) {
  // Adds a class of single-author to blogs with only 1 published author
  if ( ! is_multi_author() ) {
    $classes[] = 'single-author';
  }

  return $classes;
}
add_filter( 'body_class', 'sempress_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since SemPress 0.1
 */
function sempress_post_classes( $classes ) {
  // Adds a class for microformats v2
  $classes[] = 'h-entry';

  return $classes;
}
add_filter( 'post_class', 'sempress_post_classes' );

/**
 * Adds microformats v2 support to the comment_author_link.
 *
 * @since SemPress 0.1
 */
function sempress_author_link( $link ) {
  // Adds a class for microformats v2
  return preg_replace('/(class\s*=\s*[\"|\'])/i', '${1}u-url ', $link);
}
add_filter( 'get_comment_author_link', 'sempress_author_link' );

/**
 * Adds microformats v2 support to the get_avatar() method.
 *
 * @since SemPress 0.1
 */
function sempress_get_avatar( $tag ) {
  // Adds a class for microformats v2
  return preg_replace('/(class\s*=\s*[\"|\'])/i', '${1}u-photo ', $tag);
}
add_filter( 'get_avatar', 'sempress_get_avatar' );

/**
 * Returns true if a blog has more than 1 category
 *
 * @since SemPress 0.1
 */
function sempress_categorized_blog() {
  if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
    // Create an array of all the categories that are attached to posts
    $all_the_cool_cats = get_categories( array(
      'hide_empty' => 1,
    ) );

    // Count the number of categories that are attached to the posts
    $all_the_cool_cats = count( $all_the_cool_cats );

    set_transient( 'all_the_cool_cats', $all_the_cool_cats );
  }

  if ( '1' != $all_the_cool_cats ) {
    // This blog has more than 1 category so sempress_categorized_blog should return true
    return true;
  } else {
    // This blog has only 1 category so sempress_categorized_blog should return false
    return false;
  }
}

/**
 * Flush out the transients used in sempress_categorized_blog
 *
 * @since SemPress 0.1
 */
function sempress_category_transient_flusher() {
  // Like, beat it. Dig?
  delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'sempress_category_transient_flusher' );
add_action( 'save_post', 'sempress_category_transient_flusher' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function sempress_enhanced_image_navigation( $url ) {
  global $post, $wp_rewrite;

  $id = (int) $post->ID;
  $object = get_post( $id );
  if ( wp_attachment_is_image( $post->ID ) && ( $wp_rewrite->using_permalinks() && ( $object->post_parent > 0 ) && ( $object->post_parent != $id ) ) )
    $url = $url . '#main';

  return $url;
}
add_filter( 'attachment_link', 'sempress_enhanced_image_navigation' );

/**
 * Display the id for the post div.
 *
 * @param string $id.
 */
function sempress_post_id( $post_id = null ) {
  if ($post_id) {
    echo 'id="' . $post_id  . '"';
  } else {
    echo 'id="' . sempress_get_post_id()  . '"';
  } 
}

/**
 * Retrieve the id for the post div.
 *
 * @return string The post-id.
 */
function sempress_get_post_id() {
  $post_id = "post-" . get_the_ID();
  
  return apply_filters('sempress_post_id', $post_id, get_the_ID());
}

/**
 * Displays a blog description (context sensitive)
 */
function sempress_meta_description( $display = true ) {
  $description = wp_trim_words( wptexturize ( get_bloginfo( "description" ) ) );

  if ( is_singular() ) {
    global $post;
    $description = wp_trim_words( wptexturize ( strip_shortcodes($post->post_content) ), 25, '...' );
  }
  
  if ( is_category() )
    $description = wp_trim_words( wptexturize ( category_description() ), 25, '...' );
  
  if ( is_tag() )
    $description = wp_trim_words( wptexturize ( tag_description() ), 25, '...' );
  
  if ($display) {
    echo $description;
  } else {
    return $description;
  } 
}

/**
 * Displays a blogs keywords (context sensitive)
 */
function sempress_meta_keywords( $display = true ) {
  $keywords = "";
  $output = array();

  if ( is_category() || is_tag() || is_tax() ) {
    global $wp_query;
    $term = $wp_query->get_queried_object();
    $keywords = $term->name;
  }
  
  if ( is_single() ) {
    $tags  = get_the_tags();
    if ( $tags ) {
      foreach ( $tags as $tag ) {
        $output[] = trim($tag->name);
      }
      $keywords = implode(", ", $output);
    }
  }
  
  // if tags are still empty take the most used
  if (empty($keywords)) {
    $tags = get_tags(array("orderby" => "count", "order" => "desc", "number" => 10));
    if ( $tags ) {
      foreach ( $tags as $tag ) {
        $output[] = trim($tag->name);
      }
      $keywords = implode(", ", $output);
    }
  }

  if ($display) {
    echo $keywords;
  } else {
    return $keywords;
  }
}

/**
 * adds the new HTML5 input types to the comment-form
 */
function sempress_comment_input_types($fields) {
  if (get_option("require_name_email", false)) {
    $fields['author'] = preg_replace('/<input/', '<input required', $fields['author']);
    $fields['email'] = preg_replace('/"text"/', '"email" required', $fields['email']);
  } else {
    $fields['email'] = preg_replace('/"text"/', '"email"', $fields['email']);
  }

  $fields['url'] = preg_replace('/"text"/', '"url"', $fields['url']);

  return $fields;
}
add_filter("comment_form_default_fields", "sempress_comment_input_types");

/**
 * adds the new HTML5 input type to the search-field
 */
function sempress_search_form_input_type($form) {
  return preg_replace('/"text"/', '"search"', $form);
}
add_filter("get_search_form", "sempress_search_form_input_type");

/**
 * adds the new HTML5 input types to the comment-text-area
 */
function sempress_comment_field_input_type($field) {
  return preg_replace('/<textarea/', '<textarea required', $field);
}
add_filter("comment_form_field_comment", "sempress_comment_field_input_type");

/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a SemPress.
 */