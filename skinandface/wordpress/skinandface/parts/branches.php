<?php
/**
 * Pobočky s mapou.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

$raca_open = (bool) sf_opt( 'raca_open' );
?>
<section class="sf-section sf-section--white" id="pobocky">
	<div class="sf-wrap">
		<span class="sf-eyebrow"><?php esc_html_e( 'Pobočky', 'skinandface' ); ?></span>
		<h2 class="sf-h2" style="margin-bottom:44px"><?php esc_html_e( 'Kde nás nájdete', 'skinandface' ); ?></h2>
		<div class="sf-branches">

			<div class="sf-branch">
				<img class="sf-branch__map" src="<?php echo esc_url( sf_img( 'mapa-stupava.webp' ) ); ?>" alt="<?php echo esc_attr( sprintf( 'Mapa: Skin & Face, %s', sf_address( 'stupava' ) ) ); ?>" loading="lazy" width="1200" height="800">
				<div class="sf-branch__body">
					<h3><?php echo esc_html( sf_opt( 'stupava_city' ) ); ?></h3>
					<p><?php echo esc_html( sf_opt( 'stupava_street' ) ); ?><br><?php echo esc_html( trim( sf_opt( 'stupava_zip' ) . ' ' . sf_opt( 'stupava_city' ) ) ); ?></p>
					<p class="sf-branch__muted"><?php echo nl2br( esc_html( sf_opt( 'stupava_hours' ) ) ); ?></p>
					<p><a href="<?php echo esc_attr( sf_tel_href() ); ?>" style="font-weight:600" data-sf-track="phone"><?php echo esc_html( sf_opt( 'phone' ) ); ?></a></p>
					<?php if ( sf_opt( 'google_rating' ) ) : ?>
						<p class="sf-branch__muted" style="font-size:14px"><span class="sf-stars">★</span> <?php echo esc_html( sprintf( '%s na Google', sf_opt( 'google_rating' ) ) ); ?></p>
					<?php endif; ?>
					<?php if ( sf_opt( 'stupava_map_url' ) ) : ?>
						<a class="sf-link" href="<?php echo esc_url( sf_opt( 'stupava_map_url' ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Navigovať cez Google Maps', 'skinandface' ); ?> →</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="sf-branch sf-branch--new">
				<img class="sf-branch__map" src="<?php echo esc_url( sf_img( 'mapa-raca.webp' ) ); ?>" alt="<?php esc_attr_e( 'Mapa: mestská časť Bratislava-Rača', 'skinandface' ); ?>" loading="lazy" width="1200" height="800">
				<div class="sf-branch__body">
					<h3><?php echo esc_html( sf_opt( 'raca_city' ) ); ?> <span class="sf-badge"><?php esc_html_e( 'Nové', 'skinandface' ); ?></span></h3>
					<?php if ( sf_opt( 'raca_street' ) ) : ?>
						<p><?php echo esc_html( sf_opt( 'raca_street' ) ); ?><br><?php echo esc_html( trim( sf_opt( 'raca_zip' ) . ' ' . sf_opt( 'raca_city' ) ) ); ?></p>
					<?php else : ?>
						<p><?php esc_html_e( 'Nová pobočka v mestskej časti Bratislava-Rača', 'skinandface' ); ?></p>
					<?php endif; ?>
					<p class="sf-branch__muted">
						<?php
						if ( sf_opt( 'raca_hours' ) ) {
							echo nl2br( esc_html( sf_opt( 'raca_hours' ) ) );
						} elseif ( ! $raca_open ) {
							esc_html_e( 'Presnú adresu a ordinačné hodiny zverejníme pred otvorením.', 'skinandface' );
						}
						?>
					</p>
					<p><a href="<?php echo esc_attr( sf_tel_href() ); ?>" style="font-weight:600" data-sf-track="phone"><?php echo esc_html( sf_opt( 'phone' ) ); ?></a></p>
					<a class="sf-link" href="<?php echo esc_url( sf_raca_url() ); ?>"><?php echo esc_html( $raca_open ? __( 'Objednať sa v Rači', 'skinandface' ) : __( 'Chcem termín v Rači', 'skinandface' ) ); ?> →</a>
				</div>
			</div>

		</div>
	</div>
</section>
