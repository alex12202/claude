<?php
/**
 * Čistímeklimy – funkcie témy.
 */

defined( 'ABSPATH' ) || exit;

define( 'CK_VERSION', '1.0.0' );
define( 'CK_ASSETS', get_template_directory_uri() . '/assets' );

require get_template_directory() . '/inc/helpers.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/order-form.php';
require get_template_directory() . '/inc/setup.php';

add_action( 'after_setup_theme', function () {
	load_theme_textdomain( 'cistimeklimy', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	register_nav_menus( array(
		'primary' => 'Hlavné menu',
		'footer'  => 'Pätička – odkazy',
	) );
} );

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'ck-fonts', 'https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@1,700&family=Manrope:wght@400;500;600;700;800&display=swap', array(), null );
	wp_enqueue_style( 'ck-style', CK_ASSETS . '/css/style.css', array( 'ck-fonts' ), CK_VERSION );
	wp_enqueue_style( 'ck-wp', CK_ASSETS . '/css/wp.css', array( 'ck-style' ), CK_VERSION );
	wp_enqueue_script( 'ck-main', CK_ASSETS . '/js/main.js', array(), CK_VERSION, true );
} );

// Preload písma nadpisov + preconnect na Google Fonts.
add_action( 'wp_head', function () {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
	echo '<link rel="preload" href="' . esc_url( CK_ASSETS . '/fonts/cistime-display-800.woff2' ) . '" as="font" type="font/woff2" crossorigin>' . "\n";
}, 1 );

// Favicon, ak nie je nastavená ikona webu.
add_action( 'wp_head', function () {
	if ( ! has_site_icon() ) {
		echo '<link rel="icon" href="' . esc_url( CK_ASSETS . '/logo/favicon.svg' ) . '" type="image/svg+xml">' . "\n";
	}
} );

// Blokový editor: rovnaké písma a farby ako na webe.
add_action( 'after_setup_theme', function () {
	add_theme_support( 'editor-styles' );
	add_editor_style( array( 'assets/css/style.css', 'assets/css/wp.css' ) );
} );
