<?php
/**
 * Template Name: Kontakt
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'parts/page-head', null, array( 'lead' => __( 'Objednajte sa online, telefonicky alebo e-mailom. Akútne termíny a kontroly, prosím, telefonicky.', 'skinandface' ) ) );
	?>
	<section class="sf-section" style="padding-top:56px;padding-bottom:0">
		<div class="sf-wrap" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(min(100%,260px),1fr));gap:20px">
			<a class="sf-tile" href="<?php echo esc_url( sf_opt( 'booking_url' ) ); ?>"<?php echo sf_ext( sf_opt( 'booking_url' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> data-sf-track="booking">
				<p><?php esc_html_e( 'Online rezervácia', 'skinandface' ); ?></p>
				<h3><?php esc_html_e( 'Vyberte si lekárku a termín', 'skinandface' ); ?></h3>
			</a>
			<a class="sf-tile" href="<?php echo esc_attr( sf_tel_href() ); ?>" data-sf-track="phone">
				<p><?php esc_html_e( 'Zavolajte nám', 'skinandface' ); ?></p>
				<h3><?php echo esc_html( sf_opt( 'phone' ) ); ?></h3>
			</a>
			<a class="sf-tile" href="mailto:<?php echo esc_attr( sf_opt( 'email' ) ); ?>">
				<p><?php esc_html_e( 'Napíšte nám', 'skinandface' ); ?></p>
				<h3 style="font-size:22px;word-break:break-word"><?php echo esc_html( sf_opt( 'email' ) ); ?></h3>
			</a>
		</div>
	</section>
	<?php if ( trim( get_the_content() ) ) : ?>
		<div class="sf-wrap sf-content" style="padding-top:48px"><?php the_content(); ?></div>
	<?php endif; ?>
	<?php
	get_template_part( 'parts/branches' );
endwhile;

get_footer();
