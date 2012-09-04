<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */
?>

  </div><!-- #main -->

  <footer id="colophon" role="contentinfo">
    <div id="site-generator">
      <?php do_action( 'sempress_credits' ); ?>
      <?php printf( __( 'This site is powered by %1$s and styled with %2$s by %3$s (with a little help from %4$s and %5$s)', 'sempress' ), '<a href="http://wordpress.org/" rel="generator">WordPress</a>', '<a href="https://github.com/pfefferle/SemPress">SemPress</a>', '<a href="http://notizblog.org/" rel="designer">Matthias Pfefferle</a>', '<a href="http://twitter.github.com/bootstrap/">Bootstrap</a>', '<a href="http://fortawesome.github.com/Font-Awesome/">Font Awesome</a>'); ?>
    </div>
  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>