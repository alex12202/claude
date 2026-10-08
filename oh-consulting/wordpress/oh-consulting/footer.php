<?php
/**
 * Pätička.
 *
 * @package oh-consulting
 */

$oh_base = is_front_page() ? '' : home_url( '/' );
?>
<footer class="oh-footer">
	<div class="oh-container oh-footer__grid">
		<div>
			<div class="oh-footer__brand">OH <span>&amp;</span> Consulting</div>
			<p style="margin-top:12px"><?php esc_html_e( 'Účtovníctvo, dane, mzdy a poradenstvo s osobným prístupom.', 'oh-consulting' ); ?></p>
		</div>
		<div>
			<div class="oh-footer__title"><?php esc_html_e( 'Služby', 'oh-consulting' ); ?></div>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'footer',
						'container'      => false,
						'depth'          => 1,
					)
				);
			} else {
				?>
				<ul>
					<li><a href="<?php echo esc_url( $oh_base . '#sluzby' ); ?>"><?php esc_html_e( 'Účtovníctvo', 'oh-consulting' ); ?></a></li>
					<li><a href="<?php echo esc_url( $oh_base . '#sluzby' ); ?>"><?php esc_html_e( 'Dane', 'oh-consulting' ); ?></a></li>
					<li><a href="<?php echo esc_url( $oh_base . '#sluzby' ); ?>"><?php esc_html_e( 'Mzdy a personalistika', 'oh-consulting' ); ?></a></li>
					<li><a href="<?php echo esc_url( $oh_base . '#sluzby' ); ?>"><?php esc_html_e( 'Poradenstvo', 'oh-consulting' ); ?></a></li>
				</ul>
				<?php
			}
			?>
		</div>
		<div>
			<div class="oh-footer__title"><?php esc_html_e( 'Kontakt', 'oh-consulting' ); ?></div>
			<?php echo esc_html( str_replace( "\n", ', ', oh_opt( 'office' ) ) ); ?><br>
			<a href="<?php echo esc_attr( oh_tel_href() ); ?>"><?php echo esc_html( oh_opt( 'phone' ) ); ?></a><br>
			<a href="mailto:<?php echo esc_attr( antispambot( oh_opt( 'email' ) ) ); ?>"><?php echo esc_html( antispambot( oh_opt( 'email' ) ) ); ?></a>
		</div>
		<div>
			<div class="oh-footer__title"><?php esc_html_e( 'Firemné údaje', 'oh-consulting' ); ?></div>
			<?php echo esc_html( oh_opt( 'company' ) ); ?><br>
			<?php echo esc_html( str_replace( "\n", ', ', oh_opt( 'seat' ) ) ); ?><br>
			IČO <?php echo esc_html( oh_opt( 'ico' ) ); ?> · DIČ <?php echo esc_html( oh_opt( 'dic' ) ); ?>
		</div>
	</div>
	<div class="oh-container oh-footer__bottom">
		<span>© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( oh_opt( 'company' ) ); ?></span>
		<?php if ( get_privacy_policy_url() ) : ?>
			<a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php esc_html_e( 'Ochrana osobných údajov', 'oh-consulting' ); ?></a>
		<?php endif; ?>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
