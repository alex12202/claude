<?php
/**
 * Hero – dve polovice (Stupava | Rača) so spoločným sliderom.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

$slides = sf_slides();
if ( ! $slides ) {
	$slides = sf_slide_defaults();
}
$raca_open = (bool) sf_opt( 'raca_open' );
$halves    = array(
	array(
		'key'     => 'stupava',
		'img'     => 'limg',
		'h1'      => 'l1',
		'h2'      => 'l2',
		'url'     => sf_opt( 'booking_url' ),
		'eyebrow' => __( 'Pobočka 01 · Stupava', 'skinandface' ),
		'badge'   => '',
		'text'    => sf_opt( 'stupava_services' ) . ' ' . sf_address( 'stupava' ) . '.',
		'cta'     => __( 'Objednať sa v Stupave', 'skinandface' ),
	),
	array(
		'key'     => 'raca',
		'img'     => 'rimg',
		'h1'      => 'r1',
		'h2'      => 'r2',
		'url'     => sf_raca_url(),
		'eyebrow' => __( 'Pobočka 02 · Bratislava-Rača', 'skinandface' ),
		'badge'   => $raca_open ? __( 'Nové', 'skinandface' ) : sf_opt( 'raca_badge' ),
		'text'    => sf_opt( 'raca_services' ),
		'cta'     => __( 'Objednať sa v Rači', 'skinandface' ),
	),
);
?>
<section class="sf-hero" aria-label="<?php esc_attr_e( 'Vyberte pobočku', 'skinandface' ); ?>" data-sf-slider data-autoplay="<?php echo sf_opt( 'hero_autoplay' ) ? '1' : '0'; ?>">
	<div class="sf-split">
		<?php foreach ( $halves as $h ) : ?>
			<a class="sf-half sf-half--<?php echo esc_attr( $h['key'] ); ?>" href="<?php echo esc_url( $h['url'] ); ?>"<?php echo sf_ext( $h['url'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> data-sf-track="hero-<?php echo esc_attr( $h['key'] ); ?>">
				<?php foreach ( $slides as $i => $s ) : ?>
					<img class="sf-half__img<?php echo 0 === $i ? ' is-active' : ''; ?>" src="<?php echo esc_url( $s[ $h['img'] ] ); ?>" alt="" data-sf-slide="<?php echo (int) $i; ?>"<?php echo 0 === $i ? ' fetchpriority="high"' : ' loading="lazy"'; ?> width="1920" height="1080">
				<?php endforeach; ?>
				<span class="sf-half__shade"></span>
				<span class="sf-half__body">
					<span class="sf-half__eyebrow">
						<?php echo esc_html( $h['eyebrow'] ); ?>
						<?php if ( $h['badge'] ) : ?>
							<span class="sf-badge"><?php echo esc_html( $h['badge'] ); ?></span>
						<?php endif; ?>
					</span>
					<span class="sf-half__titles">
						<?php foreach ( $slides as $i => $s ) : ?>
							<span class="sf-half__title h2<?php echo 0 === $i ? ' is-active' : ''; ?>" data-sf-slide="<?php echo (int) $i; ?>"<?php echo 0 === $i ? '' : ' aria-hidden="true"'; ?> style="font-family:var(--sf-serif);font-weight:500"><?php echo esc_html( $s[ $h['h1'] ] ); ?> <em><?php echo esc_html( $s[ $h['h2'] ] ); ?></em></span>
						<?php endforeach; ?>
					</span>
					<span class="sf-half__text"><?php echo esc_html( $h['text'] ); ?></span>
					<span class="sf-btn sf-btn--light"><?php echo esc_html( $h['cta'] ); ?> <span class="sf-btn__arr"><?php echo sf_icon( 'arrow', 14 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span></span>
				</span>
			</a>
		<?php endforeach; ?>
	</div>

	<div class="sf-seam" aria-hidden="true"><img src="<?php echo esc_url( sf_img( 'monogram.svg' ) ); ?>" alt="" width="40" height="54"></div>

	<?php if ( count( $slides ) > 1 ) : ?>
		<div class="sf-hero__nav">
			<div class="sf-wrap" role="group" aria-label="<?php esc_attr_e( 'Témy slidera', 'skinandface' ); ?>">
				<?php foreach ( $slides as $i => $s ) : ?>
					<button type="button" class="sf-hero__tab<?php echo 0 === $i ? ' is-active' : ''; ?>" data-sf-go="<?php echo (int) $i; ?>" aria-pressed="<?php echo 0 === $i ? 'true' : 'false'; ?>">
						<b><?php echo esc_html( sprintf( '%02d', $i + 1 ) ); ?></b><?php echo esc_html( $s['label'] ); ?>
					</button>
				<?php endforeach; ?>
				<span class="sf-hero__arrows">
					<button type="button" data-sf-prev aria-label="<?php esc_attr_e( 'Predchádzajúca snímka', 'skinandface' ); ?>"><?php echo sf_icon( 'arrow-l', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
					<button type="button" data-sf-next aria-label="<?php esc_attr_e( 'Ďalšia snímka', 'skinandface' ); ?>"><?php echo sf_icon( 'arrow', 16 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
				</span>
			</div>
		</div>
	<?php endif; ?>
</section>
