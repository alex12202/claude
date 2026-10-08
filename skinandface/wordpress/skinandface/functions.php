<?php
/**
 * Skin & Face – funkcie témy.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

define( 'SF_VERSION', '1.0.0' );
define( 'SF_DIR', get_template_directory() );
define( 'SF_URI', get_template_directory_uri() );

require SF_DIR . '/inc/helpers.php';
require SF_DIR . '/inc/post-types.php';
require SF_DIR . '/inc/meta-boxes.php';
require SF_DIR . '/inc/customizer.php';
require SF_DIR . '/inc/form.php';
require SF_DIR . '/inc/schema.php';
require SF_DIR . '/inc/demo-content.php';

/**
 * Základné nastavenia témy.
 */
function sf_setup() {
	load_theme_textdomain( 'skinandface', SF_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'assets/css/fonts.css', 'assets/css/editor.css' ) );

	add_theme_support(
		'editor-color-palette',
		array(
			array( 'name' => __( 'Slivková', 'skinandface' ), 'slug' => 'sf-plum', 'color' => '#4a2c52' ),
			array( 'name' => __( 'Levanduľová', 'skinandface' ), 'slug' => 'sf-accent', 'color' => '#8e6ba3' ),
			array( 'name' => __( 'Text', 'skinandface' ), 'slug' => 'sf-ink', 'color' => '#2b2030' ),
			array( 'name' => __( 'Svetlé pozadie', 'skinandface' ), 'slug' => 'sf-ground', 'color' => '#faf7f4' ),
			array( 'name' => __( 'Biela', 'skinandface' ), 'slug' => 'sf-white', 'color' => '#ffffff' ),
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Hlavné menu', 'skinandface' ),
			'footer'  => __( 'Menu v pätičke', 'skinandface' ),
		)
	);

	add_image_size( 'sf-portrait', 600, 600, true );
	add_image_size( 'sf-wide', 1920, 1080, false );
}
add_action( 'after_setup_theme', 'sf_setup' );

/**
 * Štýly a skripty.
 */
function sf_assets() {
	wp_enqueue_style( 'sf-fonts', SF_URI . '/assets/css/fonts.css', array(), SF_VERSION );
	wp_enqueue_style( 'sf-style', get_stylesheet_uri(), array( 'sf-fonts' ), SF_VERSION );
	wp_enqueue_script( 'sf-main', SF_URI . '/assets/js/main.js', array(), SF_VERSION, array( 'in_footer' => true, 'strategy' => 'defer' ) );
}
add_action( 'wp_enqueue_scripts', 'sf_assets' );

/**
 * Predbežné načítanie hlavného písma (rýchlejšie vykreslenie nadpisov).
 */
function sf_preload_fonts() {
	printf(
		'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
		esc_url( SF_URI . '/assets/fonts/cormorant-garamond-normal-latin.woff2' )
	);
}
add_action( 'wp_head', 'sf_preload_fonts', 1 );

/**
 * Ikona webu z témy, kým nie je nastavená v Prispôsobiť › Identita webu.
 */
function sf_fallback_site_icon() {
	if ( has_site_icon() ) {
		return;
	}
	printf( '<link rel="icon" href="%s" sizes="512x512">' . "\n", esc_url( SF_URI . '/assets/img/site-icon-512.png' ) );
	printf( '<link rel="apple-touch-icon" href="%s">' . "\n", esc_url( SF_URI . '/assets/img/site-icon-512.png' ) );
}
add_action( 'wp_head', 'sf_fallback_site_icon' );

/**
 * Trieda pre úvodnú stránku (priehľadná hlavička cez hero).
 */
function sf_body_class( $classes ) {
	if ( is_front_page() ) {
		$classes[] = 'sf-is-front';
	}
	return $classes;
}
add_filter( 'body_class', 'sf_body_class' );

/**
 * Kratší úryvok.
 */
add_filter(
	'excerpt_length',
	function () {
		return 26;
	}
);

/**
 * Vypne komentáre – klinika ich nepotrebuje a sú zdrojom spamu.
 */
function sf_disable_comments() {
	foreach ( get_post_types() as $type ) {
		if ( post_type_supports( $type, 'comments' ) ) {
			remove_post_type_support( $type, 'comments' );
			remove_post_type_support( $type, 'trackbacks' );
		}
	}
}
add_action( 'init', 'sf_disable_comments', 100 );
add_filter( 'comments_open', '__return_false', 20 );
add_filter( 'pings_open', '__return_false', 20 );
add_filter( 'comments_array', '__return_empty_array', 10 );
add_action(
	'admin_menu',
	function () {
		remove_menu_page( 'edit-comments.php' );
	}
);

/**
 * Bezpečnostné drobnosti: skryje verziu WordPressu a vypne XML-RPC.
 */
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'xmlrpc_enabled', '__return_false' );
