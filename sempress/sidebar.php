<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package SemPress
 * @since SemPress 1.0.0
 */
?>
	<aside id="sidebar">
		<div id="secondary" class="widget-area" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<section id="search" class="widget widget_search">
					<?php get_search_form(); ?>
				</section>

				<section id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'sempress' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</section>

				<section id="meta" class="widget">
					<h3 class="widget-title"><?php _e( 'Meta', 'sempress' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</section>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->

		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="tertiary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>
		</div><!-- #tertiary .widget-area -->
		<?php endif; ?>
	</aside>
