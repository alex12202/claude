<?php
/**
 * Hlavička.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

$sf_overlay = is_front_page();
$sf_menu    = array(
	'theme_location' => 'primary',
	'container'      => false,
	'depth'          => 1,
	'fallback_cb'    => 'sf_menu_fallback',
);
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#obsah"><?php esc_html_e( 'Preskočiť na obsah', 'skinandface' ); ?></a>

<div class="sf-topbar">
	<div class="sf-wrap">
		<span class="sf-topbar__text"><?php echo esc_html( sf_opt( 'urgent_note' ) ); ?></span>
		<div class="sf-topbar__links">
			<a class="sf-topbar__tel" href="<?php echo esc_attr( sf_tel_href() ); ?>"><?php echo esc_html( sf_opt( 'phone' ) ); ?></a>
			<a href="mailto:<?php echo esc_attr( sf_opt( 'email' ) ); ?>"><?php echo esc_html( sf_opt( 'email' ) ); ?></a>
		</div>
	</div>
</div>

<header class="sf-header<?php echo $sf_overlay ? ' sf-header--overlay' : ''; ?>">
	<div class="sf-wrap">
		<a class="sf-header__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php esc_attr_e( 'Skin & Face – domov', 'skinandface' ); ?>">
			<img class="sf-logo-dark" src="<?php echo esc_url( sf_img( 'logo-horizontal.svg' ) ); ?>" alt="Skin &amp; Face Dermaesthetic" width="240" height="56">
			<img class="sf-logo-light" src="<?php echo esc_url( sf_img( 'logo-horizontal-white.svg' ) ); ?>" alt="Skin &amp; Face Dermaesthetic" width="240" height="56">
		</a>
		<nav class="sf-nav" aria-label="<?php esc_attr_e( 'Hlavná navigácia', 'skinandface' ); ?>">
			<?php wp_nav_menu( $sf_menu ); ?>
		</nav>
		<div class="sf-header__cta">
			<?php echo sf_button( sf_opt( 'booking_url' ), __( 'Objednať sa', 'skinandface' ), $sf_overlay ? 'ghost' : '', array( 'data-sf-track' => 'booking' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<button class="sf-burger" type="button" aria-controls="sf-drawer" aria-expanded="false" aria-label="<?php esc_attr_e( 'Otvoriť menu', 'skinandface' ); ?>">
				<?php echo sf_icon( 'menu', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</button>
		</div>
	</div>
</header>

<div class="sf-drawer" id="sf-drawer" aria-hidden="true">
	<button class="sf-drawer__close" type="button" aria-label="<?php esc_attr_e( 'Zavrieť menu', 'skinandface' ); ?>"><?php echo sf_icon( 'close', 22 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></button>
	<nav aria-label="<?php esc_attr_e( 'Mobilná navigácia', 'skinandface' ); ?>">
		<?php wp_nav_menu( $sf_menu ); ?>
	</nav>
	<?php echo sf_button( sf_opt( 'booking_url' ), __( 'Objednať sa online', 'skinandface' ), 'light', array( 'data-sf-track' => 'booking' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<p style="margin-top:20px"><a href="<?php echo esc_attr( sf_tel_href() ); ?>" style="font:600 18px var(--sf-sans);border:0"><?php echo esc_html( sf_opt( 'phone' ) ); ?></a></p>
</div>

<main id="obsah">
