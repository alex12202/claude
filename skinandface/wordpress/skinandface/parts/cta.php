<?php
/**
 * Záverečná výzva na objednanie.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="sf-cta">
	<img class="sf-cta__bg" src="<?php echo esc_url( sf_img( 'photo-dermatoskopia.webp' ) ); ?>" alt="" loading="lazy" width="1920" height="480">
	<div class="sf-wrap">
		<div>
			<h2><?php esc_html_e( 'Objednajte sa', 'skinandface' ); ?> <em><?php esc_html_e( 'ešte dnes.', 'skinandface' ); ?></em></h2>
			<p><?php esc_html_e( 'Vyberte si pobočku, ktorá je vám bližšie.', 'skinandface' ); ?></p>
		</div>
		<div class="sf-cta__btns">
			<?php echo sf_button( sf_opt( 'booking_url' ), __( 'Stupava', 'skinandface' ), 'light', array( 'data-sf-track' => 'booking' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<?php echo sf_button( sf_raca_url(), __( 'Bratislava-Rača', 'skinandface' ), 'light' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>
</section>
