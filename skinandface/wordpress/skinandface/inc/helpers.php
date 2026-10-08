<?php
/**
 * Pomocné funkcie: nastavenia, obrázky, ikony.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

/**
 * Predvolené hodnoty nastavení (Vzhľad › Prispôsobiť › Skin & Face).
 *
 * @return array
 */
function sf_defaults() {
	return array(
		// Kontakt.
		'phone'             => '+421 910 903 300',
		'email'             => 'rezervacie@skinandface.sk',
		'booking_url'       => 'https://www.navstevalekara.sk/lekari/kozny-lekar-dermatovenerolog-dermatolog-s11006/bratislavsky-kraj-k300/malacky-o505/stupava-m1035/mudr-barbora-javorek-vargova-d27949.html#order',
		'urgent_note'       => 'Akútne termíny a kontroly objednávajte telefonicky',
		'instagram'         => 'https://www.instagram.com/skinface_dermaesthetic/',
		'facebook'          => 'https://www.facebook.com/profile.php?id=100087168727539',
		'company'           => '',
		'ico'               => '',

		// Recenzie.
		'google_url'        => 'https://maps.app.goo.gl/hDWwvNyEyEYdf2UC9',
		'google_rating'     => '4,7',
		'nl_url'            => 'https://www.navstevalekara.sk/lekari/kozny-lekar-dermatovenerolog-dermatolog-s11006/bratislavsky-kraj-k300/malacky-o505/stupava-m1035/mudr-barbora-javorek-vargova-d27949.html',
		'reviews_count'     => 8,

		// Pobočka Stupava.
		'stupava_street'    => 'Námestie Slovenského povstania 5',
		'stupava_zip'       => '900 31',
		'stupava_city'      => 'Stupava',
		'stupava_hours'     => 'Po – Ne: podľa objednaných pacientov',
		'stupava_lat'       => '48.2785986',
		'stupava_lng'       => '17.0302164',
		'stupava_map_url'   => 'https://maps.app.goo.gl/hDWwvNyEyEYdf2UC9',
		'stupava_services'  => 'Dermatológia, vyšetrenie znamienok, odstránenie kožných útvarov a estetická medicína.',

		// Pobočka Rača.
		'raca_open'         => false,
		'raca_badge'        => 'Otvárame čoskoro',
		'raca_street'       => '',
		'raca_zip'          => '831 06',
		'raca_city'         => 'Bratislava-Rača',
		'raca_hours'        => '',
		'raca_map_url'      => '',
		'raca_booking_url'  => '',
		'raca_services'     => 'Dermatológia, vyšetrenie znamienok a estetická medicína – už aj v Bratislave-Rači.',

		// Úvod.
		'hero_h1'           => 'Dermatológ a estetická medicína v Stupave a v Bratislave-Rači',
		'hero_h1_em'        => 's prirodzenými výsledkami.',
		'hero_intro'        => 'Túžba robiť medicínu inak, kde profesionalita a ľudskosť sú našimi hlavnými piliermi. Výsledok estetického zákroku má byť na prvý pohľad neviditeľný.',
		'hero_autoplay'     => true,

		// Technické.
		'schema_enabled'    => true,
	);
}

/**
 * Hodnota nastavenia s predvolenou hodnotou.
 *
 * @param string $key Kľúč.
 * @return mixed
 */
function sf_opt( $key ) {
	$defaults = sf_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( 'sf_' . $key, $default );
}

/**
 * Snímky slidera v hero sekcii.
 *
 * @return array
 */
function sf_slides() {
	$defaults = sf_slide_defaults();
	$slides   = array();
	foreach ( $defaults as $i => $d ) {
		$n     = $i + 1;
		$slide = array();
		foreach ( $d as $k => $v ) {
			$slide[ $k ] = get_theme_mod( "sf_slide{$n}_{$k}", $v );
		}
		if ( '' !== trim( $slide['label'] ) ) {
			$slides[] = $slide;
		}
	}
	return $slides;
}

/**
 * Predvolené snímky slidera.
 *
 * @return array
 */
function sf_slide_defaults() {
	$derm  = SF_URI . '/assets/img/photo-dermatoskopia.webp';
	$face  = SF_URI . '/assets/img/photo-estetika.webp';
	$moles = SF_URI . '/assets/img/photo-znamienka.webp';
	return array(
		array( 'label' => 'Prevencia', 'l1' => 'Zdravá koža', 'l2' => 'začína prevenciou.', 'r1' => 'Prirodzená krása,', 'r2' => 'teraz aj v Rači.', 'limg' => $derm, 'rimg' => $face ),
		array( 'label' => 'Vyšetrenie znamienok', 'l1' => 'Znamienka', 'l2' => 'pod kontrolou.', 'r1' => 'Dermatoskopia', 'r2' => 'bližšie k vám.', 'limg' => $moles, 'rimg' => $derm ),
		array( 'label' => 'Estetická medicína', 'l1' => 'Výsledok, ktorý', 'l2' => 'nie je vidieť.', 'r1' => 'Jemná estetika,', 'r2' => 'prirodzený vzhľad.', 'limg' => $face, 'rimg' => $moles ),
		array( 'label' => 'Odstránenie útvarov', 'l1' => 'Odstránenie útvarov', 'l2' => 'bez kompromisov.', 'r1' => 'Nová pobočka,', 'r2' => 'rovnaký prístup.', 'limg' => $derm, 'rimg' => $face ),
	);
}

/**
 * URL obrázka z témy.
 *
 * @param string $file Názov súboru v assets/img.
 * @return string
 */
function sf_img( $file ) {
	return SF_URI . '/assets/img/' . $file;
}

/**
 * Telefón pre odkaz tel:.
 *
 * @return string
 */
function sf_tel_href() {
	return 'tel:' . preg_replace( '/[^0-9+]/', '', sf_opt( 'phone' ) );
}

/**
 * URL stránky so šablónou.
 *
 * @param string $template Napr. page-templates/pobocka.php.
 * @return string
 */
function sf_template_url( $template ) {
	$pages = get_pages(
		array(
			'meta_key'   => '_wp_page_template',
			'meta_value' => $template,
			'number'     => 1,
		)
	);
	return $pages ? get_permalink( $pages[0] ) : '';
}

/**
 * URL stránky pobočky Rača.
 *
 * @return string
 */
function sf_raca_url() {
	$url = sf_template_url( 'page-templates/pobocka.php' );
	return $url ? $url : home_url( '/raca/' );
}

/**
 * URL stránky podľa slugu (napr. cennik, kontakt).
 *
 * @param string $slug Slug stránky.
 * @return string
 */
function sf_page_url( $slug ) {
	$page = get_page_by_path( $slug );
	return $page ? get_permalink( $page ) : home_url( '/' . $slug . '/' );
}

/**
 * Riadok adresy pobočky.
 *
 * @param string $branch stupava|raca.
 * @return string
 */
function sf_address( $branch ) {
	$street = sf_opt( $branch . '_street' );
	$city   = trim( sf_opt( $branch . '_zip' ) . ' ' . sf_opt( $branch . '_city' ) );
	return $street ? $street . ', ' . $city : '';
}

/**
 * Menu, kým nie je vytvorené v Vzhľad › Menu.
 *
 * @param array $args Argumenty wp_nav_menu.
 */
function sf_menu_fallback( $args = array() ) {
	$items = array(
		home_url( '/sluzba/' ) => __( 'Služby', 'skinandface' ),
		sf_page_url( 'cennik' ) => __( 'Cenník', 'skinandface' ),
		sf_page_url( 'o-nas' )  => __( 'O nás', 'skinandface' ),
		sf_raca_url()           => __( 'Pobočka Rača', 'skinandface' ),
		sf_page_url( 'kontakt' ) => __( 'Kontakt', 'skinandface' ),
	);
	echo '<ul class="menu">';
	foreach ( $items as $url => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Inline SVG ikona (farba podľa textu).
 *
 * @param string $name Názov ikony.
 * @param int    $size Veľkosť v px.
 * @return string
 */
function sf_icon( $name, $size = 16 ) {
	$paths = array(
		'arrow'   => '<path d="M5 12h14M13 6l6 6-6 6"/>',
		'arrow-l' => '<path d="M19 12H5M11 6l-6 6 6 6"/>',
		'phone'   => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/>',
		'menu'    => '<path d="M4 8h16M4 16h16"/>',
		'close'   => '<path d="M6 6l12 12M18 6L6 18"/>',
		'check'   => '<path d="M20 6 9 17l-5-5"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}
	return sprintf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%2$s</svg>',
		(int) $size,
		$paths[ $name ]
	);
}

/**
 * Tlačidlo so šípkou.
 *
 * @param string $url     Odkaz.
 * @param string $label   Text.
 * @param string $variant '', light, ghost.
 * @param array  $attrs   Ďalšie atribúty.
 * @return string
 */
function sf_button( $url, $label, $variant = '', $attrs = array() ) {
	$class = 'sf-btn' . ( $variant ? ' sf-btn--' . $variant : '' );
	$extra = '';
	foreach ( $attrs as $k => $v ) {
		$extra .= sprintf( ' %s="%s"', esc_attr( $k ), esc_attr( $v ) );
	}
	return sprintf(
		'<a class="%s" href="%s"%s>%s <span class="sf-btn__arr">%s</span></a>',
		esc_attr( $class ),
		esc_url( $url ),
		$extra,
		esc_html( $label ),
		sf_icon( 'arrow', 14 )
	);
}

/**
 * Atribúty pre externý odkaz.
 *
 * @param string $url URL.
 * @return string
 */
function sf_ext( $url ) {
	$host = wp_parse_url( $url, PHP_URL_HOST );
	if ( $host && wp_parse_url( home_url(), PHP_URL_HOST ) !== $host ) {
		return ' target="_blank" rel="noopener"';
	}
	return '';
}

/**
 * Cena služby, napr. „od 250 €“.
 *
 * @param int $post_id ID služby.
 * @return string
 */
function sf_service_price( $post_id ) {
	return (string) get_post_meta( $post_id, '_sf_price', true );
}

/**
 * Služby podľa kategórie.
 *
 * @param string $cat dermatologia|estetika.
 * @return WP_Post[]
 */
function sf_services( $cat ) {
	return get_posts(
		array(
			'post_type'      => 'sf_sluzba',
			'posts_per_page' => 30,
			'orderby'        => array( 'menu_order' => 'ASC', 'title' => 'ASC' ),
			'meta_key'       => '_sf_category',
			'meta_value'     => $cat,
		)
	);
}
