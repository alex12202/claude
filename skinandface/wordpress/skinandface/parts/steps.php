<?php
/**
 * Ako prebieha návšteva.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

$steps = array(
	array( __( 'Výber pobočky a termínu', 'skinandface' ), __( 'Online rezervácia v Stupave alebo v Rači, akútne prípady telefonicky.', 'skinandface' ) ),
	array( __( 'Konzultácia s lekárkou', 'skinandface' ), __( 'Vyšetrenie, vysvetlenie možností a individuálny plán.', 'skinandface' ) ),
	array( __( 'Ošetrenie', 'skinandface' ), __( 'Výkon v ambulantných podmienkach, s dôrazom na komfort.', 'skinandface' ) ),
	array( __( 'Kontrola a starostlivosť', 'skinandface' ), __( 'Odporúčania na doma a kontrolný termín podľa potreby.', 'skinandface' ) ),
);
?>
<section class="sf-section sf-section--plum">
	<div class="sf-wrap">
		<span class="sf-eyebrow"><?php esc_html_e( 'Ako prebieha návšteva', 'skinandface' ); ?></span>
		<h2 class="sf-h2" style="margin-bottom:56px"><?php esc_html_e( 'Od objednania po kontrolu', 'skinandface' ); ?> <em><?php esc_html_e( 'bez stresu.', 'skinandface' ); ?></em></h2>
		<ol class="sf-steps">
			<?php foreach ( $steps as $i => $s ) : ?>
				<li>
					<p class="sf-steps__num"><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></p>
					<h3><?php echo esc_html( $s[0] ); ?></h3>
					<p><?php echo esc_html( $s[1] ); ?></p>
				</li>
			<?php endforeach; ?>
		</ol>
	</div>
</section>
