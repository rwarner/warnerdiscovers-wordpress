<?php
/**
 * Theme functions & definitions.
 *
 * @package Revood
 */


if ( ! function_exists( 'manor_setup' ) ) :
	/**
	 * Setup theme defaults & registers supports for various WordPress features.
	 */
	function manor_setup() {
		// Load translations for the theme.
		load_theme_textdomain( 'manor' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for post thumbnails.
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'manor-blog-thumb', 720, 720, true );

		// Switch core default markup to ouput valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Setup custom logo support
		add_theme_support(
			'custom-logo',
			array(
				'flex-width'  => true,
				'flex-height' => true,
				'header-text' => array( 'site-title', 'site-description' ),
			)
		);

		// Register support for post formats.
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'gallery',
				'video',
			)
		);

		// Add support for selective refresh.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Register navigation menus.
		register_nav_menus(
			array(
				'primary' => __( 'Primary', 'manor' ),
				'footer'  => __( 'Footer Menu', 'manor' ),
				'social'  => __( 'Social Links Menu', 'manor' ),
			)
		);

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for editor stylesheet.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embeds content.
		add_theme_support( 'responsive-embeds' );

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name' => __( 'Primary color', 'manor' ),
					'slug' => 'primary',
					'color' => get_theme_mod( 'primary_color' ) ? get_theme_mod( 'primary_color' ) : '#DF6296',
				),
				array(
					'name' => __( 'Black', 'manor' ),
					'slug' => 'black',
					'color' => '#363636',
				),
				array(
					'name' => __( 'White', 'manor' ),
					'slug' => 'white',
					'color' => '#fff',
				),
			)
		);

		// Add starter content.
		add_theme_support(
			'starter-content',
			array(
				'widgets' => array(
					'sidebar-1' => array(
						'search',
						'text_about',
						'recent-comments',
					),
				),
				'nav_menus' => array(
					'social' => array(
						'name' => __( 'Social Links Menu', 'manor' ),
						'items' => array(
							'link_facebook',
							'link_twitter',
							'link_instagram',
						),
					),
				),
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'manor_setup' );

/**
 * Set the content width in pixels, based on the Theme's design and stylesheet.
 *
 * @global int $content_width
 */
function manor_content_width() {
	/**
	 * Filters the content width of the theme.
	 *
	 * @param int $manor_content_width
	 */
	$manor_content_width = apply_filters( 'manor_content_width', 800 );

	$GLOBALS['content_width'] = $manor_content_width;
}
add_action( 'after_setup_theme', 'manor_content_width', 0 );

/**
 * Register widget areas.
 */
function manor_widgets_init() {
	register_sidebar(
		array(
			'id'            => 'sidebar-1',
			'name'          => __( 'Footer Widget Area', 'manor' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
			'after_widget'  => '</section>',
		)
	);
}
add_action( 'widgets_init', 'manor_widgets_init' );

/**
 * Enqueue scripts & styleshseets.
 */
function manor_enqueue_scripts() {
	// Scripts.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( has_nav_menu( 'primary' ) ) {
		wp_enqueue_script( 'manor-navigation', get_parent_theme_file_uri( 'js/navigation.js' ), array(), '0.1.0', true );
		wp_localize_script(
			'manor-navigation',
			'_btl10n',
			array(
				'expand'   => __( 'Expand child menu', 'manor' ),
				'collapse' => __( 'Collapse child menu', 'manor' ),
			)
		);
	}

	// Stylesheets.
	wp_enqueue_style( 'open-sans' );
	wp_enqueue_style( 'manor-main', get_parent_theme_file_uri( 'style.css' ), array( 'open-sans' ), '0.1.0' );
	if ( is_child_theme() ) {
		wp_enqueue_style( 'manor-child-theme', get_stylesheet_uri() );
	}
}
add_action( 'wp_enqueue_scripts', 'manor_enqueue_scripts' );

/**
 * Output colorscheme css.
 */
function manor_output_color_scheme_css() {
	$primary_color = strtoupper( get_theme_mod( 'primary_color' ) );

	// Don't output if primary color isn't changed.
	if ( ! $primary_color || '#DF6296' === $primary_color ) {
		return;
	}

	echo '<style id="manor-color-scheme-css" type="text/css">' . manor_get_color_scheme_css( $primary_color, manor_darken_color( $primary_color, 15 ) ) . '</style>';
}
add_action( 'wp_head', 'manor_output_color_scheme_css', 100 );

/**
 * Add colorscheme css to block editor.
 *
 * @param array $editor_settings
 * @return array
 */
function manor_block_editor_settings( $editor_settings ) {
	$primary_color = strtoupper( get_theme_mod( 'primary_color' ) );

	if ( $primary_color && '#DF6296' !== $primary_color ) {
		$editor_settings['styles'][] = array(
			'css' => manor_get_editor_color_scheme_css( $primary_color, manor_darken_color( $primary_color, 15 ) ),
		);
	}

	return $editor_settings;
}
add_filter( 'block_editor_settings', 'manor_block_editor_settings' );

/**
 * Enqueue editor styleshseet.
 */
function manor_enqueue_block_editor_assets() {
	wp_enqueue_style( 'open-sans' );
}
add_action( 'enqueue_block_editor_assets', 'manor_enqueue_block_editor_assets' );

/**
 * Excerpt more
 *
 * @param string $more_text
 * @return string
 */
function manor_excerpt_more( $more_text ) {
	if ( is_admin() ) {
		return $more_text;
	}

	return '&hellip;';
}
add_action( 'excerpt_more', 'manor_excerpt_more' );

/**
 * Fallback menu for `primary` menu location
 */
function manor_menu_fallback() {
	wp_page_menu(
		array(
			'menu_id' => 'site-nav-menu',
			'menu_class' => 'site-nav-menu-container',
			'show_home' => true,
			'number' => 3,
			'before' => '<ul class="menu">',
		)
	);
}


function custom_functions() {
    wp_register_script('custom_functions', get_template_directory_uri() . '/js/custom-functions.js', array('jquery'), true);
    wp_enqueue_script('custom_functions');
}

add_action( 'wp_enqueue_scripts', 'custom_functions', 999 ); 

// Custom template tags.
require get_parent_theme_file_path( 'inc/template-tags.php' );

// Customizer additions.
require get_parent_theme_file_path( 'inc/customizer.php' );

// Icon functions.
require get_parent_theme_file_path( 'inc/icon-functions.php' );

// Color functions.
require get_parent_theme_file_path( 'inc/color-functions.php' );

// Ignore Jetpack CSS
add_filter( 'jetpack_implode_frontend_css', '__return_false', 99 ); 
function sertmedia_remove_all_jp_css() {
wp_deregister_style( 'AtD_style' ); // After the Deadline
wp_deregister_style( 'jetpack_likes' ); // Likes
wp_deregister_style( 'jetpack_related-posts' ); //Related Posts
wp_deregister_style( 'jetpack-carousel' ); // Carousel
wp_deregister_style( 'grunion.css' ); // Grunion contact form
wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll
wp_deregister_style( 'infinity-twentyten' ); // Infinite Scroll - Twentyten Theme
wp_deregister_style( 'infinity-twentyeleven' ); // Infinite Scroll - Twentyeleven Theme
wp_deregister_style( 'infinity-twentytwelve' ); // Infinite Scroll - Twentytwelve Theme
wp_deregister_style( 'noticons' ); // Notes
wp_deregister_style( 'post-by-email' ); // Post by Email
wp_deregister_style( 'publicize' ); // Publicize
wp_deregister_style( 'sharedaddy' ); // Sharedaddy
wp_deregister_style( 'sharing' ); // Sharedaddy Sharing
wp_deregister_style( 'stats_reports_css' ); // Stats
wp_deregister_style( 'jetpack-widgets' ); // Widgets
wp_deregister_style( 'jetpack-slideshow' ); // Slideshows
wp_deregister_style( 'presentations' ); // Presentation shortcode
wp_deregister_style( 'jetpack-subscriptions' ); // Subscriptions
wp_deregister_style( 'tiled-gallery' ); // Tiled Galleries
wp_deregister_style( 'widget-conditions' ); // Widget Visibility
wp_deregister_style( 'jetpack_display_posts_widget' ); // Display Posts Widget
wp_deregister_style( 'gravatar-profile-widget' ); // Gravatar Widget
wp_deregister_style( 'widget-grid-and-list' ); // Top Posts widget
wp_deregister_style( 'jetpack-widgets' ); // Widgets
}
add_action('wp_print_styles', 'sertmedia_remove_all_jp_css' );