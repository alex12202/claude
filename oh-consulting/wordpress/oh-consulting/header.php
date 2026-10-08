<?php
/**
 * Hlavička.
 *
 * @package oh-consulting
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#obsah"><?php esc_html_e( 'Preskočiť na obsah', 'oh-consulting' ); ?></a>

<div class="oh-topbar">
	<div class="oh-container">
		<span><strong><?php esc_html_e( 'Nezáväzná cenová ponuka zdarma', 'oh-consulting' ); ?></strong> – <?php esc_html_e( 'ozvite sa ešte dnes', 'oh-consulting' ); ?></span>
		<span class="oh-topbar__links">
			<a href="<?php echo esc_attr( oh_tel_href() ); ?>"><?php echo esc_html( oh_opt( 'phone' ) ); ?></a>
			<a href="mailto:<?php echo esc_attr( antispambot( oh_opt( 'email' ) ) ); ?>"><?php echo esc_html( antispambot( oh_opt( 'email' ) ) ); ?></a>
			<span><?php echo esc_html( str_replace( "\n", ', ', oh_opt( 'office' ) ) ); ?></span>
		</span>
	</div>
</div>

<header class="oh-header">
	<div class="oh-container">
		<a class="oh-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<?php if ( has_custom_logo() ) : ?>
				<?php
				$oh_logo_id = get_theme_mod( 'custom_logo' );
				echo wp_get_attachment_image( $oh_logo_id, 'full', false, array( 'class' => 'custom-logo', 'alt' => get_bloginfo( 'name' ) ) );
				?>
			<?php else : ?>
				<?php oh_lotus(); ?>
				<span class="oh-brand__text">
					<span class="oh-brand__name">OH <span>&amp;</span> Consulting</span>
					<span class="oh-brand__tag"><?php esc_html_e( 'Účtovníctvo · Dane · Poradenstvo', 'oh-consulting' ); ?></span>
				</span>
			<?php endif; ?>
		</a>

		<button class="oh-nav-toggle" type="button" aria-controls="oh-nav" aria-expanded="false" aria-label="<?php esc_attr_e( 'Otvoriť menu', 'oh-consulting' ); ?>">
			<?php oh_icon( 'menu', 22 ); ?>
		</button>

		<nav id="oh-nav" class="oh-nav" aria-label="<?php esc_attr_e( 'Hlavné menu', 'oh-consulting' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'depth'          => 1,
					'fallback_cb'    => 'oh_fallback_menu',
				)
			);
			?>
			<a class="oh-btn oh-btn--primary oh-btn--sm" href="<?php echo esc_url( ( is_front_page() ? '' : home_url( '/' ) ) . '#kontakt' ); ?>"><?php esc_html_e( 'Chcem cenovú ponuku', 'oh-consulting' ); ?></a>
		</nav>
	</div>
</header>
