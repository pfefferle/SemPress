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
 * @since SemPress 1.0.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
  $content_width = 670; /* pixels */

/**
 * Set a default theme color array for WP.com.
 */
$themecolors = array(
  'bg' => 'f0f0f0',
  'border' => 'cccccc',
  'text' => '555555',
  'shadow' => 'ffffff'
);

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
  global $themecolors;

  /**
   * Make theme available for translation
   * Translations can be filed in the /languages/ directory
   * If you're building a theme based on sempress, use a find and replace
   * to change 'sempress' to the name of your theme in all the template files
   */
  load_theme_textdomain( 'sempress', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head
  add_theme_support( 'automatic-feed-links' );

  // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 668, 9999 ); // Unlimited height, soft crop

  // Register custom image size for image post formats.
  add_image_size( 'sempress-image-post', 668, 1288 );

  // Switches default core markup for search form to output valid HTML5.
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

  // This theme uses wp_nav_menu() in one location.
  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'sempress' ),
  ) );

  // Add support for the Aside, Gallery Post Formats...
  add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'status', 'image', 'video', 'audio', 'quote' ) );
  //add_theme_support( 'structured-post-formats', array( 'image', 'video', 'audio', 'quote' ) );

  /**
   * This theme supports jetpacks "infinite-scroll"
   *
   * @see http://jetpack.me/support/infinite-scroll/
   */
  add_theme_support( 'infinite-scroll', array('container' => 'content', 'footer' => 'colophon') );

  if (get_theme_mod( 'sempress_columns', 'single' ) == "single") {
    $width = 670;
  } else {
    $width = 950;
  }

  // This theme supports a custom header
  $custom_header_args = array(
    'width'         => $width,
    'height'        => 200,
    'header-text'   => false
  );
  add_theme_support( 'custom-header', $custom_header_args );

  // This theme supports custom backgrounds
  $custom_background_args = array(
    'default-color' => $themecolors['bg'],
    'default-image' => get_template_directory_uri() . '/img/noise.png',
  );
  add_theme_support( 'custom-background', $custom_background_args );

  // This theme uses its own gallery styles.
  //add_filter( 'use_default_gallery_style', '__return_false' );

  // Nicer WYSIWYG editor
  add_editor_style( 'css/editor-style.css' );
}
endif; // sempress_setup

/**
 * Tell WordPress to run sempress_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'sempress_setup' );

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since 1.3.1
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string Filtered title.
 */
function sempress_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'sempress' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'sempress_wp_title', 10, 2 );

/**
 * Adds "custom-color" support
 *
 * @since 1.3.0
 */
function sempress_customize_register( $wp_customize ) {
  global $themecolors;

  $wp_customize->add_section( 'sempress_settings_section', array(
    'title'       => __( 'Sempress Settings', 'sempress' ),
    'description' => __('Allows you to customize some example settings for MyTheme.', 'mytheme'), //Descriptive tooltip
    'priority'    => 35
  ) );

  $wp_customize->add_setting( 'sempress_textcolor' , array(
    'default'     => '#'.$themecolors['text'],
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sempress_textcolor', array(
    'label'      => __( 'Text Color', 'sempress' ),
    'section'    => 'colors',
    'settings'   => 'sempress_textcolor',
  ) ) );

  $wp_customize->add_setting( 'sempress_shadowcolor' , array(
    'default'     => '#'.$themecolors['shadow'],
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sempress_shadowcolor', array(
    'label'      => __( 'Shadow Color', 'sempress' ),
    'section'    => 'colors',
    'settings'   => 'sempress_shadowcolor',
  ) ) );

  $wp_customize->add_setting( 'sempress_bordercolor' , array(
    'default'     => '#'.$themecolors['border'],
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sempress_bordercolor', array(
    'label'      => __( 'Border Color', 'sempress' ),
    'section'    => 'colors',
    'settings'   => 'sempress_bordercolor',
  ) ) );

  $wp_customize->add_setting( 'sempress_columns' , array(
    'default'     => 'multi',
    'transport'   => 'refresh',
  ) );

  $wp_customize->add_control( 'sempress_columns', array(
    'label'      => __( 'Page Structure', 'sempress' ),
    'section'    => 'sempress_settings_section',
    'settings'   => 'sempress_columns',
    'type'       => 'select',
    'choices'    => array(
      'single'   => __( 'Single Column (Sidebar at the bottom)', 'sempress' ),
      'multi'    => __( 'Multi Column (Sidebar at the right)', 'sempress' ),
    )
  ) );
}
add_action( 'customize_register', 'sempress_customize_register' );


/**
 * Adds the custom CSS to the theme-header
 *
 * @since 1.3.0
 */
function sempress_customize_css() {
  global $themecolors;
?>
  <style type="text/css" id="sempress-custom-colors">
    body { text-shadow: 0 1px 0 <?php echo get_theme_mod('sempress_shadowcolor', "#".$themecolors["shadow"]); ?>; }
    body, a { color: <?php echo get_theme_mod('sempress_textcolor', "#".$themecolors["text"]); ?>; }
    .widget, #access {
      border-bottom: 1px solid <?php echo get_theme_mod('sempress_bordercolor', 'inherit'); ?>;
      -moz-box-shadow: <?php echo get_theme_mod('sempress_shadowcolor', 'inherit'); ?> 0 1px 0 0;
      -webkit-box-shadow: <?php echo get_theme_mod('sempress_shadowcolor', 'inherit'); ?> 0 1px 0 0;
      box-shadow: <?php echo get_theme_mod('sempress_shadowcolor', 'inherit'); ?> 0 1px 0 0;
    }
    article.comment {
      border-top: 1px solid <?php echo get_theme_mod('sempress_shadowcolor', 'inherit'); ?>;
      -moz-box-shadow: <?php echo get_theme_mod('sempress_bordercolor', 'inherit'); ?> 0 -1px 0 0;
      -webkit-box-shadow: <?php echo get_theme_mod('sempress_bordercolor', 'inherit'); ?> 0 -1px 0 0;
      box-shadow: <?php echo get_theme_mod('sempress_bordercolor', 'inherit'); ?> 0 -1px 0 0;
    }
  </style>
<?php
}
add_action( 'wp_head', 'sempress_customize_css');

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
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => "</section>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => __( 'Sidebar 2', 'sempress' ),
    'id' => 'sidebar-2',
    'description' => __( 'An optional second sidebar area', 'sempress' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget' => "</section>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
}
add_action( 'init', 'sempress_widgets_init' );

if ( ! function_exists( 'sempress_enqueue_scripts' ) ) :
/**
 * Enqueue theme scripts
 *
 * @uses wp_enqueue_scripts() To enqueue scripts
 *
 * @since SemPress 1.1.1
 */
function sempress_enqueue_scripts() {
  /*
   * Adds JavaScript to pages with the comment form to support sites with
   * threaded comments (when in use).
   */
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
    wp_enqueue_script( 'comment-reply' );

  // Add HTML5 support to older versions of IE
  if ( isset( $_SERVER['HTTP_USER_AGENT'] ) &&
     ( false !== strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) ) &&
     ( false === strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 9' ) ) ) {

    wp_enqueue_script('html5', get_template_directory_uri() . '/js/html5.js', false, '3.6');
  }

  // Loads our main stylesheet.
  wp_enqueue_style( 'sempress-style', get_stylesheet_uri() );
}
endif;

add_action( 'wp_enqueue_scripts', 'sempress_enqueue_scripts' );

if ( ! function_exists( 'sempress_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since SemPress 1.0.0
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
 * @since SemPress 1.0.0
 */
function sempress_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;

  switch ( $comment->comment_type ) :
  	case 'pingback' :
  	case 'trackback' :
    case 'webmention' :
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
  	<article id="comment-<?php comment_ID(); ?>" class="comment <?php $comment->comment_type; ?>" itemprop="comment" itemscope itemtype="http://schema.org/UserComments">
      <div class="comment-content p-summary p-name" itemprop="commentText name description"><?php comment_text(); ?></div>
      <footer>
        <div class="comment-meta commentmetadata">
          <address class="comment-author p-author author vcard hcard h-card" itemprop="creator" itemscope itemtype="http://schema.org/Person">
            <?php printf( '<cite class="fn p-name" itemprop="name">%s</cite>', get_comment_author_link() ); ?>
          </address>
          <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time class="updated published u-updated u-published" datetime="<?php comment_time( 'c' ); ?>" itemprop="commentTime">
            <?php
            /* translators: 1: date, 2: time */
            printf( __( '%1$s at %2$s', 'sempress' ), get_comment_date(), get_comment_time() ); ?>
          </time></a>
          <?php edit_comment_link( __( '(Edit)', 'sempress' ), ' ' ); ?>
        </div>
      </footer>
    </article>
  <?php
  		break;
  	default :
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment <?php $comment->comment_type; ?>" itemprop="comment" itemscope itemtype="http://schema.org/UserComments">
      <footer>
        <address class="comment-author p-author author vcard hcard h-card" itemprop="creator" itemscope itemtype="http://schema.org/Person">
          <?php echo get_avatar( $comment, 50 ); ?>
          <?php printf( __( '%s <span class="says">says:</span>', 'sempress' ), sprintf( '<cite class="fn p-name" itemprop="name">%s</cite>', get_comment_author_link() ) ); ?>
        </address><!-- .comment-author .vcard -->
        <?php if ( $comment->comment_approved == '0' ) : ?>
          <em><?php _e( 'Your comment is awaiting moderation.', 'sempress' ); ?></em>
          <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata">
          <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>"><time class="updated published u-updated u-published" datetime="<?php comment_time( 'c' ); ?>" itemprop="commentTime">
          <?php
            /* translators: 1: date, 2: time */
            printf( __( '%1$s at %2$s', 'sempress' ), get_comment_date(), get_comment_time() ); ?>
          </time></a>
          <?php edit_comment_link( __( '(Edit)', 'sempress' ), ' ' ); ?>
        </div><!-- .comment-meta .commentmetadata -->
      </footer>

      <div class="comment-content e-content p-summary p-name" itemprop="commentText name description"><?php comment_text(); ?></div>

      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div><!-- .reply -->
    </article><!-- #comment-## -->
  <?php
      break;
  endswitch;
}
endif; // ends check for sempress_comment()

if ( ! function_exists( 'sempress_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own sempress_posted_on to override in a child theme
 *
 * @since SemPress 1.0.0
 */
function sempress_posted_on() {
  printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark" class="url u-url"><time class="entry-date updated published dt-updated dt-published" datetime="%3$s" itemprop="dateModified">%4$s</time></a><address class="byline"> <span class="sep"> by </span> <span class="author p-author vcard hcard h-card" itemprop="author" itemscope itemtype="http://schema.org/Person">%5$s <a class="url uid u-url u-uid fn p-name" href="%6$s" title="%7$s" rel="author" itemprop="url"><span itemprop="name">%8$s</span></a></span></address>', 'sempress' ),
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    get_avatar( get_the_author_meta('ID'), 40 ),
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    esc_attr( sprintf( __( 'View all posts by %s', 'sempress' ), get_the_author() ) ),
    esc_html( get_the_author() )
  );
}
endif;

/**
 * Adds post-thumbnail support :)
 *
 * @since SemPress 1.0.0
 */
function sempress_the_post_thumbnail($before = "", $after = "") {
  if ( '' != get_the_post_thumbnail() ) {
    $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'post-thumbnail');
    $class = "";

    if ($image['1'] < "300")
      $class="alignright";

    echo $before;
    the_post_thumbnail( "post-thumbnail", array( "class" => $class . " photo u-photo", "itemprop" => "image" ) );
    echo $after;
  }
}

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since SemPress 1.3.0
 */
function sempress_content_width() {
  if ( is_page_template( 'full-width-page.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
    global $content_width;
    $content_width = 880;
  }

  /*
  if ( has_post_format( 'image' ) || has_post_format( 'video' ) || is_attachment() ) {
    global $content_width;
    $content_width = 668;
  }
  */
}
add_action( 'template_redirect', 'sempress_content_width' );

/**
 * replace post-title with id when empty
 *
 * @since SemPress 1.4.6
 *
 * @param string $title the post-title
 * @param int $id the post-id
 * @return string the filtered post-title
 */
function sempress_the_title($title, $id) {
  // if title is empty, return the id
  if (empty($title)) {
    return "#$id";
  }

  return $title;
}
add_filter( 'the_title', 'sempress_the_title', 10, 2 );

/**
 * Adds custom classes to the array of body classes.
 *
 * @since SemPress 1.0.0
 */
function sempress_body_classes( $classes ) {
  $classes[] = get_theme_mod( 'sempress_columns', 'multi' ). "-column";

  // Adds a class of single-author to blogs with only 1 published author
  if ( ! is_multi_author() ) {
    $classes[] = 'single-author';
  }

  if ( get_header_image() ) {
    $classes[] = 'custom-header';
  }

  if (!is_singular()) {
    $classes[] = "hfeed";
    $classes[] = "h-feed";
    $classes[] = "feed";
  } else {
    $classes = sempress_get_post_classes($classes);
  }

  return $classes;
}
add_filter( 'body_class', 'sempress_body_classes' );

/**
 * Adds custom classes to the array of post classes.
 *
 * @since SemPress 1.0.0
 */
function sempress_post_classes( $classes ) {
  $classes = array_diff($classes, array('hentry'));

  if (!is_singular()) {
    return sempress_get_post_classes($classes);
  } else {
    return $classes;
  }
}
add_filter( 'post_class', 'sempress_post_classes', 99 );

/**
 * Adds custom classes to the array of comment classes.
 *
 * @since SemPress 1.4.0
 */
function sempress_comment_classes( $classes ) {
  $classes[] = "h-as-comment";
  $classes[] = "p-comment";
  $classes[] = "h-entry";
  $classes[] = "comment";

  return array_unique($classes);
}
add_filter( 'comment_class', 'sempress_comment_classes', 99 );

/**
 * encapsulates post-classes to use them on different tags
 */
function sempress_get_post_classes($classes = array()) {
  // Adds a class for microformats v2
  $classes[] = 'h-entry';

  // add hentry to the same tag as h-entry
  $classes[] = 'hentry';

  // adds microformats 2 activity-stream support
  // for pages and articles
  if ( get_post_type() == "page" ) {
    $classes[] = "h-as-page";
  }
  if ( !get_post_format() && get_post_type() == "post" ) {
    $classes[] = "h-as-article";
  }

  // adds some more microformats 2 classes based on the
  // posts "format"
  switch ( get_post_format() ) {
    case "aside":
    case "status":
      $classes[] = "h-as-note";
      break;
    case "audio":
      $classes[] = "h-as-audio";
      break;
    case "video":
      $classes[] = "h-as-video";
      break;
    case "gallery":
    case "image":
      $classes[] = "h-as-image";
      break;
    case "link":
      $classes[] = "h-as-bookmark";
      break;
  }

  return array_unique($classes);
}

/**
 * Adds microformats v2 support to the comment_author_link.
 *
 * @since SemPress 1.0.0
 */
function sempress_author_link( $link ) {
  // Adds a class for microformats v2
  return preg_replace('/(class\s*=\s*[\"|\'])/i', '${1}u-url ', $link);
}
add_filter( 'get_comment_author_link', 'sempress_author_link' );

/**
 * Adds microformats v2 support to the get_avatar() method.
 *
 * @since SemPress 1.0.0
 */
function sempress_get_avatar( $tag ) {
  // Adds a class for microformats v2
  return preg_replace('/(class\s*=\s*[\"|\'])/i', '${1}u-photo ', $tag);
}
add_filter( 'get_avatar', 'sempress_get_avatar' );

/**
 * Returns true if a blog has more than 1 category
 *
 * @since SemPress 1.0.0
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
 * @since SemPress 1.0.0
 */
function sempress_category_transient_flusher() {
  // Like, beat it. Dig?
  delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'sempress_category_transient_flusher' );
add_action( 'save_post', 'sempress_category_transient_flusher' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @param string $url
 * @return string
 */
function sempress_enhanced_image_navigation( $url ) {
  if ( is_admin() ) {
    return $url;
  }

  global $post, $wp_rewrite;

  $id = (int) $post->ID;
  $object = get_post( $id );
  if ( wp_attachment_is_image( $post->ID ) && ( $wp_rewrite->using_permalinks() && ( $object->post_parent > 0 ) && ( $object->post_parent != $id ) ) )
    $url = $url . '#main';

  return $url;
}
add_filter( 'attachment_link', 'sempress_enhanced_image_navigation' );

/**
 * add rel-prev attribute to previous_image_link
 *
 * @param string a-tag
 * @return string
 */
function sempress_semantic_previous_image_link( $link ) {
  return preg_replace( '/<a/i', '<a rel="prev"', $link );
}
add_filter( 'previous_image_link', 'sempress_semantic_previous_image_link' );

/**
 * add rel-next attribute to next_image_link
 *
 * @param string a-tag
 * @return string
 */
function sempress_semantic_next_image_link( $link ) {
  return preg_replace( '/<a/i', '<a rel="next"', $link );
}
add_filter( 'next_image_link', 'sempress_semantic_next_image_link' );

/**
 * add rel-prev attribute to next_posts_link_attributes
 *
 * @param string attributes
 * @return string
 */
function sempress_next_posts_link_attributes( $attr ) {
  return $attr.' rel="prev"';
}
add_filter( 'next_posts_link_attributes', 'sempress_next_posts_link_attributes' );

/**
 * add rel-next attribute to previous_posts_link
 *
 * @param string attributes
 * @return string
 */
function sempress_previous_posts_link_attributes( $attr ) {
  return $attr.' rel="next"';
}
add_filter( 'previous_posts_link_attributes', 'sempress_previous_posts_link_attributes' );

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
 * adds the new HTML5 input types to the comment-form
 *
 * @param string $form
 * @return string
 */
function sempress_comment_autocomplete($fields) {
  $fields['author'] = preg_replace('/<input/', '<input autocomplete="nickname name" ', $fields['author']);
  $fields['email'] = preg_replace('/<input/', '<input autocomplete="email" ', $fields['email']);
  $fields['url'] = preg_replace('/<input/', '<input autocomplete="url" ', $fields['url']);

  return $fields;
}
add_filter("comment_form_default_fields", "sempress_comment_autocomplete");

/**
 * Switches default core markup for search form to output valid HTML5.
 *
 * @param string $format Expected markup format, default is `xhtml`
 * @return string SemPress loves HTML5.
 */
function sempress_searchform_format( $format ) {
	return 'html5';
}
add_filter( 'search_form_format', 'sempress_searchform_format' );

/**
 * add semantics
 *
 * @param string $id the class identifier
 * @return array
 */
function sempress_get_semantics($id = null) {
  $classes = array();

  // add default values
  switch ($id) {
    case "body":
      if (!is_singular()) {
        $classes['itemscope'] = array('');
        $classes['itemtype'] = array('http://schema.org/Blog');
      } elseif (is_single()) {
        $classes['itemscope'] = array('');
        $classes['itemtype'] = array('http://schema.org/BlogPosting');
      } elseif (is_page()) {
        $classes['itemscope'] = array('');
        $classes['itemtype'] = array('http://schema.org/WebPage');
      }
      break;
    case "site-title":
      if (!is_singular()) {
        $classes['itemprop'] = array('name');
        $classes['class'] = array('p-title');
      }
      break;
    case "site-description":
      if (!is_singular()) {
        $classes['itemprop'] = array('description');
        $classes['class'] = array('p-summary', 'e-content');
      }
      break;
    case "site-url":
      if (!is_singular()) {
        $classes['itemprop'] = array('url');
        $classes['class'] = array('u-url', 'url');
      }
      break;
    case "post":
      if (!is_singular()) {
        $classes['itemprop'] = array('blogPost');
        $classes['itemscope'] = array('');
        $classes['itemtype'] = array('http://schema.org/BlogPosting');
      }
      break;
  }

  $classes = apply_filters( "sempress_semantics", $classes, $id );
  $classes = apply_filters( "sempress_semantics_{$id}", $classes, $id );

  return $classes;
}

/**
 * echos the semantic classes added via
 * the "sempress_semantics" filters
 *
 * @param string $id the class identifier
 */
function sempress_semantics($id) {
  $classes = sempress_get_semantics($id);

  if (!$classes) {
    return;
  }

  foreach ( $classes as $key => $value ) {
    echo ' ' . esc_attr( $key ) . '="' . esc_attr( join( ' ', $value ) ) . '"';
  }
}

/**
 * Adds back compat handling for older WP versions
 */
require( get_template_directory() . '/inc/back-compat.php' );

/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and SemPress.
 */