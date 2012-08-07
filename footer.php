<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package SemPress
 * @since SemPress 0.1
 */
?>

  </div><!-- #main -->

  <footer id="colophon" role="contentinfo">
    <div id="site-generator">
      <?php do_action( 'sempress_credits' ); ?>
      <a href="<?php echo esc_url( __( 'http://wordpress.org/', 'sempress' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'sempress' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'sempress' ), 'WordPress' ); ?></a>
      <span class="sep"> | </span>
      <?php printf( __( 'Theme: %1$s by %2$s based on the awesome %3$s-Theme by %4$s.', 'sempress' ), 'SemPress', '<a href="http://notizblog.org/" rel="designer">Matthias Pfefferle</a>', 'Toolbox', '<a href="http://automattic.com/" rel="designer">Automattic</a>'); ?>
    </div>
  </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>