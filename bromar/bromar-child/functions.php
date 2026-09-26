<?php
/**
 * BROMAR – child téma pre Domi.
 */

// Štýly: rodičovská téma sa načíta sama, child štýl ide za ňou.
add_action( 'wp_enqueue_scripts', 'bromar_enqueue', 3000 );
function bromar_enqueue() {
	$ver = wp_get_theme()->get( 'Version' );
	wp_enqueue_style( 'bromar-style', get_stylesheet_uri(), array(), $ver );
	wp_enqueue_script( 'bromar', get_stylesheet_directory_uri() . '/assets/js/bromar.js', array(), $ver, true );
	if ( is_rtl() ) {
		wp_enqueue_style( 'domi-style-rtl', get_template_directory_uri() . '/rtl.css' );
	}
}

// Predvolená farebná schéma Domi → paleta BROMAR.
// Beží po domi_skin_setup_schemes (priorita 1). Hodnoty uložené v Customizeri majú prednosť.
add_action( 'after_setup_theme', 'bromar_color_scheme', 2 );
function bromar_color_scheme() {
	if ( ! function_exists( 'domi_storage_get' ) ) {
		return;
	}
	$schemes = domi_storage_get( 'schemes' );
	if ( empty( $schemes['default']['colors'] ) ) {
		return;
	}
	$schemes['default']['colors'] = array_merge(
		$schemes['default']['colors'],
		array(
			'bg_color'       => '#F5F2ED',
			'bg_color_2'     => '#E9E2D7',
			'bd_color'       => '#DDD5C8',
			'title'          => '#1C2A3E',
			'text'           => '#4A4D52',
			'meta'           => '#8C8377',
			'link'           => '#B5302A',
			'hover'          => '#962620',
			'alt_bg_color'   => '#1C2A3E',
			'alt_bg_color_2' => '#243650',
			'alt_bd_color'   => '#34465F',
			'alt_title'      => '#FFFFFF',
			'alt_text'       => '#C9D1DC',
			'alt_meta'       => '#9FABBB',
			'alt_link'       => '#E9C9A7',
			'alt_hover'      => '#FFFFFF',
		)
	);
	domi_storage_set( 'schemes', $schemes );
}
