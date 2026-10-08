<?php
/**
 * Pätička.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

$sf_privacy = get_privacy_policy_url();
?>
</main>

<footer class="sf-footer">
	<div class="sf-wrap sf-footer__grid">
		<div>
			<img class="sf-footer__logo" src="<?php echo esc_url( sf_img( 'logo-white.svg' ) ); ?>" alt="Skin &amp; Face Dermaesthetic" width="190" height="122" loading="lazy">
			<p><?php esc_html_e( 'Korektívna dermatológia s prirodzenými výsledkami.', 'skinandface' ); ?></p>
		</div>
		<div>
			<h2><?php esc_html_e( 'Pobočka Stupava', 'skinandface' ); ?></h2>
			<p><?php echo esc_html( sf_opt( 'stupava_street' ) ); ?><br><?php echo esc_html( trim( sf_opt( 'stupava_zip' ) . ' ' . sf_opt( 'stupava_city' ) ) ); ?></p>
		</div>
		<div>
			<h2><?php esc_html_e( 'Pobočka Rača', 'skinandface' ); ?></h2>
			<?php if ( sf_opt( 'raca_street' ) ) : ?>
				<p><?php echo esc_html( sf_opt( 'raca_street' ) ); ?><br><?php echo esc_html( trim( sf_opt( 'raca_zip' ) . ' ' . sf_opt( 'raca_city' ) ) ); ?></p>
			<?php else : ?>
				<p><?php echo esc_html( sf_opt( 'raca_city' ) ); ?><br><?php echo esc_html( sf_opt( 'raca_badge' ) ); ?></p>
			<?php endif; ?>
		</div>
		<div>
			<h2><?php esc_html_e( 'Kontakt', 'skinandface' ); ?></h2>
			<p><a class="sf-footer__tel" href="<?php echo esc_attr( sf_tel_href() ); ?>"><?php echo esc_html( sf_opt( 'phone' ) ); ?></a></p>
			<p><a href="mailto:<?php echo esc_attr( sf_opt( 'email' ) ); ?>"><?php echo esc_html( sf_opt( 'email' ) ); ?></a></p>
		</div>
		<div>
			<h2><?php esc_html_e( 'Menu', 'skinandface' ); ?></h2>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => has_nav_menu( 'footer' ) ? 'footer' : 'primary',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => 'sf_menu_fallback',
				)
			);
			?>
		</div>
	</div>
	<div class="sf-wrap sf-footer__bottom">
		<span>
			© <?php echo esc_html( gmdate( 'Y' ) ); ?> skinandface.sk
			<?php if ( sf_opt( 'company' ) ) : ?>
				· <?php echo esc_html( sf_opt( 'company' ) ); ?>
			<?php endif; ?>
			<?php if ( sf_opt( 'ico' ) ) : ?>
				· <?php echo esc_html( sprintf( 'IČO %s', sf_opt( 'ico' ) ) ); ?>
			<?php endif; ?>
		</span>
		<span>
			<?php if ( $sf_privacy ) : ?>
				<a href="<?php echo esc_url( $sf_privacy ); ?>"><?php esc_html_e( 'Ochrana osobných údajov', 'skinandface' ); ?></a> ·
			<?php endif; ?>
			<?php if ( sf_opt( 'instagram' ) ) : ?>
				<a href="<?php echo esc_url( sf_opt( 'instagram' ) ); ?>" target="_blank" rel="noopener">Instagram</a> ·
			<?php endif; ?>
			<?php if ( sf_opt( 'facebook' ) ) : ?>
				<a href="<?php echo esc_url( sf_opt( 'facebook' ) ); ?>" target="_blank" rel="noopener">Facebook</a>
			<?php endif; ?>
		</span>
	</div>
</footer>

<nav class="sf-mobilebar" aria-label="<?php esc_attr_e( 'Rýchly kontakt', 'skinandface' ); ?>">
	<a class="sf-mobilebar__call" href="<?php echo esc_attr( sf_tel_href() ); ?>" data-sf-track="phone"><?php echo sf_icon( 'phone', 18 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><?php esc_html_e( 'Zavolať', 'skinandface' ); ?></a>
	<a class="sf-mobilebar__book" href="<?php echo esc_url( sf_opt( 'booking_url' ) ); ?>" data-sf-track="booking"><?php esc_html_e( 'Objednať sa', 'skinandface' ); ?></a>
</nav>

<?php wp_footer(); ?>
</body>
</html>
