<?php
/**
 * Bočný panel s objednaním a výberom pobočky.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

$title = isset( $args['title'] ) ? $args['title'] : __( 'Objednať sa', 'skinandface' );
?>
<div class="sf-booking">
	<h2><?php echo esc_html( $title ); ?></h2>
	<p><?php esc_html_e( 'Vyberte pobočku:', 'skinandface' ); ?></p>
	<a class="sf-booking__opt" href="<?php echo esc_url( sf_opt( 'booking_url' ) ); ?>"<?php echo sf_ext( sf_opt( 'booking_url' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> data-sf-track="booking">
		<span><strong><?php echo esc_html( sf_opt( 'stupava_city' ) ); ?></strong><small><?php echo esc_html( sf_opt( 'stupava_street' ) ); ?> · <?php esc_html_e( 'online rezervácia', 'skinandface' ); ?></small></span>
		<?php echo sf_icon( 'arrow', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</a>
	<a class="sf-booking__opt" href="<?php echo esc_url( sf_raca_url() ); ?>">
		<span><strong><?php echo esc_html( sf_opt( 'raca_city' ) ); ?></strong><small><?php echo esc_html( sf_opt( 'raca_street' ) ? sf_opt( 'raca_street' ) : sf_opt( 'raca_badge' ) ); ?></small></span>
		<?php echo sf_icon( 'arrow', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	</a>
	<p style="margin-top:8px"><?php esc_html_e( 'Akútne termíny a kontroly telefonicky:', 'skinandface' ); ?></p>
	<a class="sf-btn sf-btn--outline" href="<?php echo esc_attr( sf_tel_href() ); ?>" data-sf-track="phone" style="justify-content:center"><?php echo esc_html( sf_opt( 'phone' ) ); ?></a>
</div>
