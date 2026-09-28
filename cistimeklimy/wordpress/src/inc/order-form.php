<?php
/**
 * Formulár „Rýchly zásah do 60 minút“ – odošle objednávku e-mailom (bez pluginu).
 */

defined( 'ABSPATH' ) || exit;

/** Vypíše skryté polia formulára. */
function ck_order_fields() {
	echo '<input type="hidden" name="action" value="ck_order">';
	echo '<input type="hidden" name="back" value="' . esc_url( get_permalink() ? get_permalink() : home_url( '/' ) ) . '">';
	// Čas zobrazenia formulára – roboty odosielajú okamžite. (Bez nonce, aby formulár fungoval aj s cache.)
	echo '<input type="hidden" name="ck_t" value="' . esc_attr( time() ) . '">';
	// Pole proti spamu – ľudia ho nevidia, roboty ho vyplnia.
	echo '<label class="ck-hp" aria-hidden="true">Web<input type="text" name="website" tabindex="-1" autocomplete="off"></label>';
}

/** Správa po odoslaní (?objednavka=ok|chyba). */
function ck_order_notice() {
	if ( empty( $_GET['objednavka'] ) ) {
		return;
	}
	$state = sanitize_key( wp_unslash( $_GET['objednavka'] ) );
	if ( 'ok' === $state ) {
		echo '<p class="form-ok" role="status">Ďakujeme, objednávku sme prijali. Ozveme sa vám do 60 minút.</p>';
	} else {
		echo '<p class="form-ok form-err" role="alert">Objednávku sa nepodarilo odoslať. Zavolajte nám prosím na ' . esc_html( ck_phone() ) . '.</p>';
	}
}

function ck_handle_order() {
	$back = isset( $_POST['back'] ) ? esc_url_raw( wp_unslash( $_POST['back'] ) ) : home_url( '/' );
	$back = wp_validate_redirect( $back, home_url( '/' ) );
	$fail = add_query_arg( 'objednavka', 'chyba', $back ) . '#kontakt';

	// Formulár odoslaný skôr ako 3 s po zobrazení = robot. Starší čas (z cache) nevadí.
	$shown = isset( $_POST['ck_t'] ) ? (int) $_POST['ck_t'] : 0;
	if ( ! $shown || time() - $shown < 3 ) {
		wp_safe_redirect( $fail );
		exit;
	}
	// Robot vyplnil skryté pole – tváriť sa, že je všetko v poriadku.
	if ( ! empty( $_POST['website'] ) ) {
		wp_safe_redirect( add_query_arg( 'objednavka', 'ok', $back ) . '#kontakt' );
		exit;
	}

	$name  = isset( $_POST['name'] ) ? sanitize_text_field( wp_unslash( $_POST['name'] ) ) : '';
	$phone = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
	$type  = isset( $_POST['type'] ) ? sanitize_text_field( wp_unslash( $_POST['type'] ) ) : '';

	if ( '' === $name || strlen( preg_replace( '/\D/', '', $phone ) ) < 9 ) {
		wp_safe_redirect( $fail );
		exit;
	}

	$to = ck_opt( 'order_to' );
	if ( ! is_email( $to ) ) {
		$to = is_email( ck_email() ) ? ck_email() : get_option( 'admin_email' );
	}

	$subject = sprintf( 'Nová objednávka čistenia: %s', $name );
	$body    = "Nová objednávka z webu " . home_url( '/' ) . "\n\n"
		. "Meno: {$name}\n"
		. "Telefón: {$phone}\n"
		. "Čo vyčistiť: {$type}\n"
		. 'Odoslané: ' . wp_date( 'j. n. Y H:i' ) . "\n";

	$sent = wp_mail( $to, $subject, $body );

	// Záloha: objednávka sa uloží aj do administrácie (Nástroje → Objednávky).
	$log   = get_option( 'ck_orders', array() );
	$log[] = array( 'time' => time(), 'name' => $name, 'phone' => $phone, 'type' => $type, 'sent' => (bool) $sent );
	update_option( 'ck_orders', array_slice( $log, -200 ), false );

	wp_safe_redirect( add_query_arg( 'objednavka', 'ok', $back ) . '#kontakt' );
	exit;
}
add_action( 'admin_post_ck_order', 'ck_handle_order' );
add_action( 'admin_post_nopriv_ck_order', 'ck_handle_order' );

// Nástroje → Objednávky: prehľad posledných objednávok (keby e-mail nedorazil).
add_action( 'admin_menu', function () {
	add_management_page( 'Objednávky z webu', 'Objednávky', 'manage_options', 'ck-orders', function () {
		$log = array_reverse( get_option( 'ck_orders', array() ) );
		echo '<div class="wrap"><h1>Objednávky z webu</h1>';
		if ( ! $log ) {
			echo '<p>Zatiaľ žiadne objednávky.</p></div>';
			return;
		}
		echo '<table class="widefat striped"><thead><tr><th>Dátum</th><th>Meno</th><th>Telefón</th><th>Čo vyčistiť</th><th>E-mail odoslaný</th></tr></thead><tbody>';
		foreach ( $log as $o ) {
			printf(
				'<tr><td>%s</td><td>%s</td><td><a href="%s">%s</a></td><td>%s</td><td>%s</td></tr>',
				esc_html( wp_date( 'j. n. Y H:i', $o['time'] ) ),
				esc_html( $o['name'] ),
				esc_attr( 'tel:' . preg_replace( '/[^0-9+]/', '', $o['phone'] ) ),
				esc_html( $o['phone'] ),
				esc_html( $o['type'] ),
				$o['sent'] ? 'áno' : '<strong>nie</strong>'
			);
		}
		echo '</tbody></table></div>';
	} );
} );
