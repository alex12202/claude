<?php
/**
 * Stránka nenájdená.
 *
 * @package oh-consulting
 */

get_header();
?>
<main id="obsah" class="oh-page" style="text-align:center">
	<h1><?php esc_html_e( 'Stránka sa nenašla', 'oh-consulting' ); ?></h1>
	<p class="oh-lead"><?php esc_html_e( 'Odkaz je možno neplatný. Pokračujte na úvodnú stránku alebo nás kontaktujte.', 'oh-consulting' ); ?></p>
	<p><a class="oh-btn oh-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Späť na úvod', 'oh-consulting' ); ?></a></p>
</main>
<?php
get_footer();
