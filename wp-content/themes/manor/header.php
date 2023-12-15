<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
	<meta name="Description" content="Warner Discovers Blog">

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-M8MN5BB');</script>
	<!-- End Google Tag Manager -->

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<!-- Pinterest business connection -->
	<meta name="p:domain_verify" content="2df23fab5ba9151c35e7d041970f323f"/> 
	
	<link rel="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<!-- Google Tag Manager (noscript) -->
	<noscript>
		<iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M8MN5BB" height="0" width="0" style="display:none;visibility:hidden"></iframe>
	</noscript>
	<!-- End Google Tag Manager (noscript) -->

	<header id="mastheader" class="site-header">
		<div class="container">
			<?php the_custom_logo(); ?>

			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></p>
			<?php if ( get_bloginfo( 'description' ) ) : ?>
				<div class="site-description"><?php bloginfo( 'description' ); ?></div>
			<?php endif; ?>
		</div>
	</header>
	<!-- /#mastheader.site-header -->

	<?php if ( has_nav_menu( 'social' ) || is_customize_preview() ) : ?>
	<nav class="social-nav">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'social',
				'menu_class'     => 'social-nav-menu',
				'link_before'    => '<span class="screen-reader-text">',
				'link_after'     => '</span>' . manor_get_link_icon(),
				'depth'          => 1,
				'fallback_cb'    => '',
			)
		);
		?>
	</nav>
	<?php endif; ?>

	<nav id="site-nav" class="site-nav">
		<div class="container">
			<button id="site-nav-toggle" class="site-nav-toggle" aria-controls="site-nav-menu" aria-expanded="false">
				<span class="site-nav-toggle-lines">
					<span class="site-nav-toggle-line top"></span>
					<span class="site-nav-toggle-line bottom"></span>
				</span>
				<span class="site-nav-toggle-text"><?php esc_html_e( 'Menu', 'manor' ); ?></span>
			</button>

			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container_id'    => 'site-nav-menu',
					'container_class' => 'site-nav-menu-container',
					'fallback_cb'     => 'manor_menu_fallback',
				)
			);
			?>
		</div>
	</nav>
	<!-- /#site-nav.site-nav -->

	<div id="site-content" class="site-content">
