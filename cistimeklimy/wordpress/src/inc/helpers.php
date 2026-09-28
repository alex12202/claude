<?php
/**
 * Pomocné funkcie – kontakty a odkazy používané v šablónach.
 */

defined( 'ABSPATH' ) || exit;

/** Hodnota z Customizera s predvolenou hodnotou. */
function ck_opt( $key ) {
	$defaults = ck_defaults();
	$value    = get_theme_mod( 'ck_' . $key, isset( $defaults[ $key ] ) ? $defaults[ $key ] : '' );
	return is_string( $value ) ? trim( $value ) : $value;
}

function ck_defaults() {
	return array(
		'phone'     => '0948 444 001',
		'email'     => 'info@cistimeklimy.sk',
		'hours'     => 'Po – Ne: 7:00 – 20:00',
		'area'      => 'Bratislava a okolie',
		'facebook'  => '',
		'instagram' => '',
		'order_to'  => '',
	);
}

/** Telefón na zobrazenie. */
function ck_phone() {
	return ck_opt( 'phone' );
}

/** Telefón ako odkaz tel:+421… */
function ck_tel() {
	$digits = preg_replace( '/[^0-9+]/', '', ck_phone() );
	if ( 0 === strpos( $digits, '00' ) ) {
		$digits = '+' . substr( $digits, 2 );
	} elseif ( 0 === strpos( $digits, '0' ) ) {
		$digits = '+421' . substr( $digits, 1 );
	}
	return 'tel:' . $digits;
}

function ck_email() {
	return ck_opt( 'email' );
}

/** Odkaz na podstránku o radiátoroch (stránka so šablónou Radiátory). */
function ck_radiatory_url() {
	$pages = get_pages( array(
		'meta_key'   => '_wp_page_template',
		'meta_value' => 'template-radiatory.php',
		'number'     => 1,
	) );
	if ( $pages ) {
		return get_permalink( $pages[0] );
	}
	$page = get_page_by_path( 'cistenie-radiatorov' );
	return $page ? get_permalink( $page ) : home_url( '/cistenie-radiatorov/' );
}

/** Odkaz na sekciu úvodnej stránky, napr. ck_home_anchor('kontakt'). */
function ck_home_anchor( $id ) {
	return is_front_page() ? '#' . $id : home_url( '/#' . $id );
}

function ck_privacy_url() {
	$url = get_privacy_policy_url();
	return $url ? $url : '#';
}

/** Snímky úvodného slidera (Customizer → Úvodný slider). */
function ck_slides() {
	$defaults = array(
		1 => array( 'hero-home', 'Dýchajte doma <em>čistý vzduch</em>, nie prach a plesne', 'Čistý vzduch pre celú domácnosť', '60% 45%', 'Pár odpočíva na gauči pod klimatizáciou' ),
		2 => array( 'hero-technik', 'Rozoberieme, vyčistíme a <em>vydezinfikujeme</em>', 'Hĺbkové čistenie priamo u vás doma', '50% 35%', 'Technik otvára nástennú klimatizáciu' ),
		3 => array( 'hero-fresh', 'Cítite ten rozdiel? <em>Svieži vzduch</em> bez zápachu', 'Svieži vzduch hneď po prvom zapnutí', '55% 45%', 'Ruka pod prúdom vzduchu z klimatizácie' ),
		4 => array( 'hero-remote', 'Nižšia spotreba, <em>tichší chod</em>, dlhšia životnosť', 'Vyčistená klimatizácia chladí rýchlejšie', '60% 40%', 'Muž zapína klimatizáciu ovládačom' ),
	);
	$slides = array();
	foreach ( $defaults as $n => $d ) {
		$img     = get_theme_mod( "ck_slide{$n}_image", '' );
		$title   = get_theme_mod( "ck_slide{$n}_title", $d[1] );
		$caption = get_theme_mod( "ck_slide{$n}_caption", $d[2] );
		if ( '' === trim( wp_strip_all_tags( $title ) ) && ! $img && $n > 1 ) {
			continue;
		}
		$slides[] = array(
			'src'     => $img ? $img : CK_ASSETS . '/img/' . $d[0] . '.webp',
			'srcset'  => $img ? '' : CK_ASSETS . '/img/' . $d[0] . '-m.webp 960w, ' . CK_ASSETS . '/img/' . $d[0] . '.webp 1920w',
			'title'   => $title,
			'caption' => $caption,
			'focus'   => $d[3],
			'alt'     => $img ? wp_strip_all_tags( $title ) : $d[4],
		);
	}
	return $slides;
}

/** Povolené HTML v nadpisoch snímok (zvýraznenie modrou). */
function ck_kses_title( $html ) {
	return wp_kses( $html, array( 'em' => array(), 'br' => array() ) );
}

/** Predvolené menu, kým nie je vytvorené vlastné (Vzhľad → Menu). */
function ck_menu_fallback() {
	$items = array(
		array( home_url( '/' ), 'Úvod', is_front_page() ),
		array( ck_home_anchor( 'sluzby' ), 'Služby', false ),
		array( ck_home_anchor( 'postup' ), 'Ako prebieha čistenie', false ),
		array( ck_radiatory_url(), 'Radiátory', is_page_template( 'template-radiatory.php' ) ),
		array( ck_home_anchor( 'referencie' ), 'Referencie', false ),
		array( ck_home_anchor( 'kontakt' ), 'Kontakt', false ),
	);
	echo '<ul>';
	foreach ( $items as $it ) {
		printf( '<li><a href="%s"%s>%s</a></li>', esc_url( $it[0] ), $it[2] ? ' aria-current="page"' : '', esc_html( $it[1] ) );
	}
	echo '</ul>';
}
