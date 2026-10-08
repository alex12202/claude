<?php
/**
 * Stránka nenájdená.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

get_header();
get_template_part(
	'parts/page-head',
	null,
	array(
		'title' => __( 'Stránku sme nenašli', 'skinandface' ),
		'lead'  => __( 'Možno bola presunutá. Skúste služby, cenník alebo nás kontaktujte.', 'skinandface' ),
	)
);
?>
<div class="sf-wrap" style="padding-top:48px;padding-bottom:96px;display:flex;gap:12px;flex-wrap:wrap">
	<?php echo sf_button( home_url( '/' ), __( 'Úvodná stránka', 'skinandface' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<a class="sf-btn sf-btn--outline" href="<?php echo esc_url( get_post_type_archive_link( 'sf_sluzba' ) ); ?>"><?php esc_html_e( 'Služby', 'skinandface' ); ?></a>
	<a class="sf-btn sf-btn--outline" href="<?php echo esc_url( sf_page_url( 'cennik' ) ); ?>"><?php esc_html_e( 'Cenník', 'skinandface' ); ?></a>
</div>
<?php
get_footer();
