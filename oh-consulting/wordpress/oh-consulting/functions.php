<?php
/**
 * OH Consulting – funkcie témy.
 *
 * @package oh-consulting
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OH_VERSION', '1.0.0' );

/**
 * Základné nastavenia témy.
 */
function oh_setup() {
	load_theme_textdomain( 'oh-consulting', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 112,
			'width'       => 400,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Hlavné menu', 'oh-consulting' ),
			'footer'  => __( 'Menu v pätičke', 'oh-consulting' ),
		)
	);
}
add_action( 'after_setup_theme', 'oh_setup' );

/**
 * Štýly a skripty.
 */
function oh_assets() {
	wp_enqueue_style( 'oh-style', get_stylesheet_uri(), array(), OH_VERSION );

	$accent = oh_opt( 'accent' );
	if ( $accent && '#A8435C' !== strtoupper( $accent ) ) {
		wp_add_inline_style( 'oh-style', ':root{--oh-accent:' . esc_attr( $accent ) . ';--oh-accent-dark:' . esc_attr( $accent ) . '}' );
	}

	wp_enqueue_script( 'oh-main', get_theme_file_uri( 'assets/js/main.js' ), array(), OH_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'oh_assets' );

/**
 * Prednačítanie písma (rýchlejšie zobrazenie textu).
 */
function oh_preload_fonts() {
	foreach ( array( 'montserrat-latin.woff2', 'montserrat-latin-ext.woff2' ) as $font ) {
		printf(
			'<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
			esc_url( get_theme_file_uri( 'assets/fonts/' . $font ) )
		);
	}
}
add_action( 'wp_head', 'oh_preload_fonts', 1 );

/**
 * Trieda "no-js" sa odstráni, keď beží JavaScript (animácie pri scrollovaní).
 */
function oh_body_class( $classes ) {
	$classes[] = 'no-js';
	return $classes;
}
add_filter( 'body_class', 'oh_body_class' );

function oh_js_detect() {
	echo "<script>document.body.classList.remove('no-js');</script>\n";
}
add_action( 'wp_body_open', 'oh_js_detect', 1 );

/**
 * Predvolené hodnoty nastavení (Vzhľad → Prispôsobiť → OH Consulting).
 */
function oh_defaults() {
	return array(
		'phone'          => '0911 809 838',
		'email'          => 'ohconsulting21@gmail.com',
		'person'         => 'Oľga Hasaralejková',
		'person_role'    => 'konateľka, účtovníčka',
		'office'         => "M. R. Štefánika 270/81\n075 01 Trebišov",
		'seat'           => "Helmecká 6/5\n076 16 Zemplínska Nová Ves",
		'ico'            => '57 325 995',
		'dic'            => '2122665446',
		'company'        => 'OH & Consulting s.r.o.',
		'form_to'        => '',
		'form_shortcode' => '',
		'accent'         => '#A8435C',
		'slider_speed'   => 6,
	);
}

/**
 * Hodnota nastavenia.
 *
 * @param string $key Kľúč.
 * @return string
 */
function oh_opt( $key ) {
	$defaults = oh_defaults();
	$default  = isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	return get_theme_mod( 'oh_' . $key, $default );
}

/**
 * Telefón vo formáte pre odkaz tel: (+421…).
 */
function oh_tel_href() {
	$digits = preg_replace( '/[^0-9+]/', '', oh_opt( 'phone' ) );
	if ( 0 === strpos( $digits, '0' ) ) {
		$digits = '+421' . substr( $digits, 1 );
	}
	return 'tel:' . $digits;
}

/**
 * Cesta k obrázku v téme.
 */
function oh_img( $file ) {
	return get_theme_file_uri( 'assets/img/' . $file );
}

/**
 * Customizer: kontaktné údaje, formulár, farba.
 */
function oh_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'oh_settings',
		array(
			'title'       => __( 'OH Consulting', 'oh-consulting' ),
			'description' => __( 'Kontaktné údaje sa zobrazujú v hornom pruhu, v kontakte aj v pätičke.', 'oh-consulting' ),
			'priority'    => 30,
		)
	);

	$fields = array(
		'phone'          => array( __( 'Telefón', 'oh-consulting' ), 'text' ),
		'email'          => array( __( 'E-mail', 'oh-consulting' ), 'email' ),
		'person'         => array( __( 'Kontaktná osoba', 'oh-consulting' ), 'text' ),
		'person_role'    => array( __( 'Funkcia kontaktnej osoby', 'oh-consulting' ), 'text' ),
		'office'         => array( __( 'Adresa kancelárie', 'oh-consulting' ), 'textarea' ),
		'seat'           => array( __( 'Sídlo firmy', 'oh-consulting' ), 'textarea' ),
		'company'        => array( __( 'Obchodné meno', 'oh-consulting' ), 'text' ),
		'ico'            => array( __( 'IČO', 'oh-consulting' ), 'text' ),
		'dic'            => array( __( 'DIČ', 'oh-consulting' ), 'text' ),
		'form_to'        => array( __( 'Kam posielať dopyty z formulára (prázdne = e-mail vyššie)', 'oh-consulting' ), 'email' ),
		'form_shortcode' => array( __( 'Shortcode iného formulára, napr. Contact Form 7 (nepovinné)', 'oh-consulting' ), 'text' ),
		'slider_speed'   => array( __( 'Rýchlosť slidera v sekundách (0 = bez automatického prepínania)', 'oh-consulting' ), 'number' ),
	);

	$defaults = oh_defaults();
	foreach ( $fields as $key => $field ) {
		$sanitize = 'sanitize_text_field';
		if ( 'textarea' === $field[1] ) {
			$sanitize = 'sanitize_textarea_field';
		} elseif ( 'email' === $field[1] ) {
			$sanitize = 'sanitize_email';
		} elseif ( 'number' === $field[1] ) {
			$sanitize = 'absint';
		}

		$wp_customize->add_setting(
			'oh_' . $key,
			array(
				'default'           => $defaults[ $key ],
				'sanitize_callback' => $sanitize,
			)
		);
		$wp_customize->add_control(
			'oh_' . $key,
			array(
				'label'   => $field[0],
				'section' => 'oh_settings',
				'type'    => $field[1],
			)
		);
	}

	$wp_customize->add_setting(
		'oh_accent',
		array(
			'default'           => $defaults['accent'],
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'oh_accent',
			array(
				'label'   => __( 'Farba tlačidiel a zvýraznení', 'oh-consulting' ),
				'section' => 'oh_settings',
			)
		)
	);
}
add_action( 'customize_register', 'oh_customize_register' );

/**
 * Spracovanie kontaktného formulára (bez pluginu).
 */
function oh_handle_contact() {
	$back = wp_get_referer() ? wp_get_referer() : home_url( '/' );
	$back = remove_query_arg( 'dopyt', $back );

	if ( ! isset( $_POST['oh_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['oh_nonce'] ) ), 'oh_contact' ) ) {
		wp_safe_redirect( add_query_arg( 'dopyt', 'chyba', $back ) . '#kontakt' );
		exit;
	}

	// Ochrana proti spamu: skryté pole musí zostať prázdne.
	if ( ! empty( $_POST['oh_web'] ) ) {
		wp_safe_redirect( add_query_arg( 'dopyt', 'ok', $back ) . '#kontakt' );
		exit;
	}

	$name    = isset( $_POST['oh_meno'] ) ? sanitize_text_field( wp_unslash( $_POST['oh_meno'] ) ) : '';
	$phone   = isset( $_POST['oh_telefon'] ) ? sanitize_text_field( wp_unslash( $_POST['oh_telefon'] ) ) : '';
	$email   = isset( $_POST['oh_email'] ) ? sanitize_email( wp_unslash( $_POST['oh_email'] ) ) : '';
	$service = isset( $_POST['oh_sluzba'] ) ? sanitize_text_field( wp_unslash( $_POST['oh_sluzba'] ) ) : '';
	$message = isset( $_POST['oh_sprava'] ) ? sanitize_textarea_field( wp_unslash( $_POST['oh_sprava'] ) ) : '';
	$consent = ! empty( $_POST['oh_gdpr'] );

	if ( '' === $name || ( '' === $phone && ! is_email( $email ) ) || ! $consent ) {
		wp_safe_redirect( add_query_arg( 'dopyt', 'chyba', $back ) . '#kontakt' );
		exit;
	}

	$to = oh_opt( 'form_to' ) ? oh_opt( 'form_to' ) : oh_opt( 'email' );

	$body  = "Nový dopyt z webu\n\n";
	$body .= 'Meno: ' . $name . "\n";
	$body .= 'Telefón: ' . $phone . "\n";
	$body .= 'E-mail: ' . $email . "\n";
	$body .= 'Služba: ' . $service . "\n\n";
	$body .= "Správa:\n" . $message . "\n";

	$headers = array();
	if ( is_email( $email ) ) {
		$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
	}

	$sent = wp_mail( $to, 'Dopyt z webu: ' . $service . ' – ' . $name, $body, $headers );

	wp_safe_redirect( add_query_arg( 'dopyt', $sent ? 'ok' : 'chyba', $back ) . '#kontakt' );
	exit;
}
add_action( 'admin_post_nopriv_oh_contact', 'oh_handle_contact' );
add_action( 'admin_post_oh_contact', 'oh_handle_contact' );

/**
 * Predvolené menu, kým si klientka nevytvorí vlastné (Vzhľad → Menu).
 */
function oh_fallback_menu() {
	$base  = is_front_page() ? '' : home_url( '/' );
	$items = array(
		'#sluzby'  => __( 'Služby', 'oh-consulting' ),
		'#o-nas'   => __( 'O nás', 'oh-consulting' ),
		'#postup'  => __( 'Ako to funguje', 'oh-consulting' ),
		'#cennik'  => __( 'Cenník', 'oh-consulting' ),
		'#kontakt' => __( 'Kontakt', 'oh-consulting' ),
	);
	echo '<ul>';
	foreach ( $items as $hash => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $base . $hash ), esc_html( $label ) );
	}
	echo '</ul>';
}

/**
 * Lotos (značka loga) ako inline SVG.
 *
 * @param string $class CSS trieda.
 * @param bool   $full  S kvapkami a bodkami (veľká verzia).
 */
function oh_lotus( $class = 'oh-brand__mark', $full = false ) {
	$sw = $full ? '1.3' : '2';
	?>
	<svg class="<?php echo esc_attr( $class ); ?>" viewBox="<?php echo $full ? '0 -14 120 96' : '0 0 120 80'; ?>" aria-hidden="true" focusable="false">
		<?php if ( $full ) : ?>
			<circle cx="60" cy="-10" r="1.4" fill="#B08A4A"/><circle cx="60" cy="-4" r="2" fill="#C98A9A"/>
		<?php endif; ?>
		<g stroke="#B08A4A" stroke-width="<?php echo esc_attr( $sw ); ?>" stroke-linejoin="round">
			<path d="M60 62 C40 64 18 56 6 42 C26 36 46 44 60 62 Z" fill="#F4DDE2"/>
			<path d="M60 62 C80 64 102 56 114 42 C94 36 74 44 60 62 Z" fill="#F4DDE2"/>
			<path d="M60 62 C42 56 30 38 33 18 C47 25 58 40 60 62 Z" fill="#EFCCD4"/>
			<path d="M60 62 C78 56 90 38 87 18 C73 25 62 40 60 62 Z" fill="#EFCCD4"/>
			<path d="M60 4 C75 20 77 42 60 62 C43 42 45 20 60 4 Z" fill="#E7B9C4"/>
		</g>
		<path d="M10 74 C38 66 82 66 110 74" fill="none" stroke="#B08A4A" stroke-width="<?php echo esc_attr( $sw ); ?>" stroke-linecap="round"/>
	</svg>
	<?php
}

/**
 * Jednoduché ikonky (stroke SVG).
 *
 * @param string $name Názov ikony.
 * @param int    $size Veľkosť v px.
 */
function oh_icon( $name, $size = 24 ) {
	$paths = array(
		'phone'  => '<path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/>',
		'mail'   => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
		'clock'  => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
		'shield' => '<path d="M12 3 4 6v6c0 5 3.4 8.4 8 9 4.6-.6 8-4 8-9V6z"/><path d="m9 12 2 2 4-4"/>',
		'user'   => '<circle cx="12" cy="8" r="4"/><path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"/>',
		'check'  => '<path d="m5 12 5 5 9-10"/>',
		'left'   => '<path d="m15 18-6-6 6-6"/>',
		'right'  => '<path d="m9 18 6-6-6-6"/>',
		'menu'   => '<path d="M4 7h16M4 12h16M4 17h16"/>',
	);
	if ( ! isset( $paths[ $name ] ) ) {
		return;
	}
	$stroke = 'check' === $name ? '2.2' : ( in_array( $name, array( 'left', 'right', 'menu' ), true ) ? '2' : '1.6' );
	printf(
		'<svg width="%1$d" height="%1$d" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="%2$s" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%3$s</svg>',
		(int) $size,
		esc_attr( $stroke ),
		$paths[ $name ] // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- pevný SVG obsah.
	);
}

/**
 * Favicon z témy, ak nie je nastavená ikona webu.
 */
function oh_favicon() {
	if ( has_site_icon() ) {
		return;
	}
	printf( '<link rel="icon" href="%s" type="image/svg+xml">' . "\n", esc_url( oh_img( 'favicon.svg' ) ) );
}
add_action( 'wp_head', 'oh_favicon' );
