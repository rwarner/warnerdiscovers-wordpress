<?php
/**
 * Footer template.
 *
 * @package Revood
 */

?>

	</div>
	<!-- /#site-content.site-content -->

	<?php get_sidebar(); ?>

	<footer id="site-footer" class="site-footer">
		<div class="container">
			<?php if ( has_nav_menu( 'footer' ) ) : ?>
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'footer',
						'depth'           => 1,
						'container_class' => 'site-footer-menu-container',
					)
				);
				?>
			<?php endif; ?>

			<div id="colophon" class="colophon">
				<?php
				/* translators: site name */
				echo esc_html( sprintf( __( '&copy; 2021 %s', 'manor' ), esc_html( get_bloginfo( 'name' ) ) ) );
				?>
			</div>
		</div>
	</footer>
	<!-- /#site-footer.site-footer -->

	<?php wp_footer(); ?>
</body>
</html>
