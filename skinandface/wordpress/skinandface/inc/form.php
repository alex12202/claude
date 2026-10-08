<?php
/**
 * Formulár „Chcem termín“ – uloží dopyt do administrácie a pošle e-mail.
 *
 * Ochrana proti spamu: nonce, skryté pole (honeypot) a minimálny čas vyplnenia.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

/**
 * Možnosti „O čo máte záujem“.
 *
 * @return array
 */
function sf_form_interests() {
	return array(
		__( 'Vyšetrenie znamienok (dermatoskopia)', 'skinandface' ),
		__( 'Kožný problém / dermatologické vyšetrenie', 'skinandface' ),
		__( 'Odstránenie kožného útvaru', 'skinandface' ),
		__( 'Estetická medicína – konzultácia', 'skinandface' ),
		__( 'Iné', 'skinandface' ),
	);
}

/**
 * Vykreslenie formulára.
 *
 * @param string $branch Predvolená pobočka.
 */
function sf_interest_form( $branch = 'Bratislava-Rača' ) {
	$status = isset( $_GET['sf_form'] ) ? sanitize_key( wp_unslash( $_GET['sf_form'] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
	$privacy = get_privacy_policy_url();
	?>
	<form class="sf-form" id="formular" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<h2><?php esc_html_e( 'Rezervujte si termín', 'skinandface' ); ?></h2>
		<p class="sf-branch__muted" style="margin:-6px 0 0;font-size:14px"><?php esc_html_e( 'Nechajte nám kontakt a ozveme sa vám s ponukou termínu.', 'skinandface' ); ?></p>

		<?php if ( 'ok' === $status ) : ?>
			<p class="sf-notice sf-notice--ok" role="status"><?php esc_html_e( 'Ďakujeme, váš dopyt sme prijali. Ozveme sa vám čo najskôr.', 'skinandface' ); ?></p>
		<?php elseif ( 'error' === $status ) : ?>
			<p class="sf-notice sf-notice--err" role="alert"><?php esc_html_e( 'Dopyt sa nepodarilo odoslať. Skontrolujte meno, telefón a súhlas, alebo nám zavolajte.', 'skinandface' ); ?></p>
		<?php endif; ?>

		<input type="hidden" name="action" value="sf_zaujem">
		<input type="hidden" name="sf_t" value="<?php echo esc_attr( time() ); ?>">
		<input type="hidden" name="sf_back" value="<?php echo esc_url( get_permalink() ); ?>">
		<?php wp_nonce_field( 'sf_zaujem', 'sf_nonce' ); ?>
		<div class="sf-form__hp" aria-hidden="true">
			<label for="sf-web"><?php esc_html_e( 'Nevypĺňajte', 'skinandface' ); ?></label>
			<input type="text" id="sf-web" name="sf_web" tabindex="-1" autocomplete="off">
		</div>

		<div class="sf-form__field">
			<label for="sf-meno"><?php esc_html_e( 'Meno a priezvisko', 'skinandface' ); ?></label>
			<input type="text" id="sf-meno" name="sf_meno" autocomplete="name" required>
		</div>
		<div class="sf-form__field">
			<label for="sf-tel"><?php esc_html_e( 'Telefón', 'skinandface' ); ?></label>
			<input type="tel" id="sf-tel" name="sf_tel" autocomplete="tel" placeholder="+421" required>
		</div>
		<div class="sf-form__field">
			<label for="sf-email"><?php esc_html_e( 'E-mail (nepovinný)', 'skinandface' ); ?></label>
			<input type="email" id="sf-email" name="sf_email" autocomplete="email">
		</div>
		<div class="sf-form__field">
			<label for="sf-pobocka"><?php esc_html_e( 'Pobočka', 'skinandface' ); ?></label>
			<select id="sf-pobocka" name="sf_pobocka">
				<?php foreach ( array( 'Bratislava-Rača', 'Stupava' ) as $b ) : ?>
					<option<?php selected( $branch, $b ); ?>><?php echo esc_html( $b ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="sf-form__field">
			<label for="sf-sluzba"><?php esc_html_e( 'O čo máte záujem?', 'skinandface' ); ?></label>
			<select id="sf-sluzba" name="sf_sluzba">
				<?php foreach ( sf_form_interests() as $opt ) : ?>
					<option><?php echo esc_html( $opt ); ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<label class="sf-form__consent">
			<input type="checkbox" name="sf_suhlas" value="1" required>
			<span>
				<?php esc_html_e( 'Súhlasím so spracovaním osobných údajov na účel objednania.', 'skinandface' ); ?>
				<?php if ( $privacy ) : ?>
					<a href="<?php echo esc_url( $privacy ); ?>"><?php esc_html_e( 'Viac informácií', 'skinandface' ); ?></a>
				<?php endif; ?>
			</span>
		</label>
		<button type="submit" class="sf-btn"><?php esc_html_e( 'Odoslať žiadosť o termín', 'skinandface' ); ?></button>
		<p style="margin:0;font-size:13px;color:var(--sf-muted);text-align:center">
			<?php esc_html_e( 'Akútne prípady:', 'skinandface' ); ?>
			<a href="<?php echo esc_attr( sf_tel_href() ); ?>" style="font-weight:600"><?php echo esc_html( sf_opt( 'phone' ) ); ?></a>
		</p>
	</form>
	<?php
}

/**
 * Spracovanie formulára.
 */
function sf_handle_interest() {
	$back = isset( $_POST['sf_back'] ) ? esc_url_raw( wp_unslash( $_POST['sf_back'] ) ) : home_url( '/' );
	$back = wp_validate_redirect( $back, home_url( '/' ) );

	$fail = function () use ( $back ) {
		wp_safe_redirect( add_query_arg( 'sf_form', 'error', $back ) . '#formular' );
		exit;
	};

	if ( ! isset( $_POST['sf_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sf_nonce'] ) ), 'sf_zaujem' ) ) {
		$fail();
	}

	// Roboti vyplnia skryté pole alebo odošlú formulár okamžite – tvárime sa, že prešlo.
	$started = isset( $_POST['sf_t'] ) ? absint( $_POST['sf_t'] ) : 0;
	if ( ! empty( $_POST['sf_web'] ) || ( time() - $started ) < 3 ) {
		wp_safe_redirect( add_query_arg( 'sf_form', 'ok', $back ) . '#formular' );
		exit;
	}

	$name    = isset( $_POST['sf_meno'] ) ? sanitize_text_field( wp_unslash( $_POST['sf_meno'] ) ) : '';
	$phone   = isset( $_POST['sf_tel'] ) ? sanitize_text_field( wp_unslash( $_POST['sf_tel'] ) ) : '';
	$email   = isset( $_POST['sf_email'] ) ? sanitize_email( wp_unslash( $_POST['sf_email'] ) ) : '';
	$branch  = isset( $_POST['sf_pobocka'] ) ? sanitize_text_field( wp_unslash( $_POST['sf_pobocka'] ) ) : '';
	$service = isset( $_POST['sf_sluzba'] ) ? sanitize_text_field( wp_unslash( $_POST['sf_sluzba'] ) ) : '';
	$consent = ! empty( $_POST['sf_suhlas'] );

	if ( '' === $name || strlen( preg_replace( '/\D/', '', $phone ) ) < 9 || ! $consent ) {
		$fail();
	}
	if ( ! in_array( $branch, array( 'Bratislava-Rača', 'Stupava' ), true ) ) {
		$branch = 'Bratislava-Rača';
	}
	if ( ! in_array( $service, sf_form_interests(), true ) ) {
		$service = __( 'Iné', 'skinandface' );
	}

	$post_id = wp_insert_post(
		array(
			'post_type'   => 'sf_dopyt',
			'post_status' => 'private',
			'post_title'  => $name,
		)
	);
	if ( $post_id && ! is_wp_error( $post_id ) ) {
		update_post_meta( $post_id, '_sf_phone', $phone );
		update_post_meta( $post_id, '_sf_email', $email );
		update_post_meta( $post_id, '_sf_branch', $branch );
		update_post_meta( $post_id, '_sf_service', $service );
		update_post_meta( $post_id, '_sf_source', $back );
		update_post_meta( $post_id, '_sf_consent', current_time( 'mysql' ) );
	}

	$to      = sf_opt( 'email' ) ? sf_opt( 'email' ) : get_option( 'admin_email' );
	$subject = sprintf( '[Web] Záujem o termín – %s (%s)', $name, $branch );
	$body    = implode(
		"\n",
		array(
			'Nový dopyt z webu ' . home_url( '/' ),
			'',
			'Meno: ' . $name,
			'Telefón: ' . $phone,
			'E-mail: ' . ( $email ? $email : '–' ),
			'Pobočka: ' . $branch,
			'Záujem: ' . $service,
			'Stránka: ' . $back,
			'',
			'Všetky dopyty nájdete v administrácii v časti „Dopyty z webu“.',
		)
	);
	$headers = array();
	if ( $email ) {
		$headers[] = 'Reply-To: ' . $name . ' <' . $email . '>';
	}
	wp_mail( $to, $subject, $body, $headers );

	wp_safe_redirect( add_query_arg( 'sf_form', 'ok', $back ) . '#formular' );
	exit;
}
add_action( 'admin_post_nopriv_sf_zaujem', 'sf_handle_interest' );
add_action( 'admin_post_sf_zaujem', 'sf_handle_interest' );

/**
 * Udalosť pre meranie kampaní (Google Tag Manager / GA4) po úspešnom odoslaní.
 */
function sf_lead_event() {
	if ( isset( $_GET['sf_form'] ) && 'ok' === $_GET['sf_form'] ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		echo "<script>window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:'sf_lead',form:'zaujem_o_termin'});</script>\n";
	}
}
add_action( 'wp_footer', 'sf_lead_event' );
