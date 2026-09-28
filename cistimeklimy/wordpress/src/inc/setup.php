<?php
/**
 * Po aktivácii témy: vytvorí stránky Úvod a Čistenie radiátorov a nastaví úvodnú stránku.
 * Existujúce stránky neprepisuje.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'after_switch_theme', function () {
	// Úvodná stránka.
	$home = get_page_by_path( 'uvod' );
	if ( ! $home ) {
		$home_id = wp_insert_post( array(
			'post_type'   => 'page',
			'post_status' => 'publish',
			'post_title'  => 'Úvod',
			'post_name'   => 'uvod',
		) );
	} else {
		$home_id = $home->ID;
	}
	if ( $home_id && ! is_wp_error( $home_id ) && 'page' !== get_option( 'show_on_front' ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
	}

	// Podstránka o radiátoroch s pripraveným textom.
	if ( ! get_page_by_path( 'cistenie-radiatorov' ) ) {
		$content = file_get_contents( get_template_directory() . '/inc/radiatory-content.html' );
		$id      = wp_insert_post( array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_title'   => 'Čistenie radiátorov',
			'post_name'    => 'cistenie-radiatorov',
			'post_excerpt' => 'Čistenie zaprášených radiátorov a vykurovacích telies v Bratislave a okolí. Menej prachu vo vzduchu, lepšie vykurovanie, žiadny zápach spáleného prachu.',
			'post_content' => "<!-- wp:html -->\n" . $content . "\n<!-- /wp:html -->",
		) );
		if ( $id && ! is_wp_error( $id ) ) {
			update_post_meta( $id, '_wp_page_template', 'template-radiatory.php' );
		}
	}

	// Pekné odkazy (/cistenie-radiatorov/ namiesto ?page_id=).
	if ( ! get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}
	flush_rewrite_rules();
} );

// Výpis stránok povolí ukážku v excerpt poli (pre SEO popis stránky).
add_action( 'init', function () {
	add_post_type_support( 'page', 'excerpt' );
} );
