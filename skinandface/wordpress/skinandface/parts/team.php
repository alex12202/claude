<?php
/**
 * Lekári (typ obsahu „Lekári“).
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

$doctors = get_posts(
	array(
		'post_type'      => 'sf_lekar',
		'posts_per_page' => 12,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
	)
);
if ( ! $doctors ) {
	return;
}
$full = ! empty( $args['full'] );
?>
<section class="sf-section" id="tim">
	<div class="sf-wrap">
		<div class="sf-head">
			<div>
				<span class="sf-eyebrow"><?php esc_html_e( 'Náš tím', 'skinandface' ); ?></span>
				<h2 class="sf-h2"><?php esc_html_e( 'Lekárky, ktorým', 'skinandface' ); ?> <em><?php esc_html_e( 'môžete dôverovať.', 'skinandface' ); ?></em></h2>
			</div>
			<p><?php esc_html_e( 'Profesionalita, odbornosť a empatia. Pravidelne sa vzdelávame na domácich aj zahraničných školeniach a kongresoch.', 'skinandface' ); ?></p>
		</div>
		<div class="sf-team">
			<?php foreach ( $doctors as $doc ) : ?>
				<?php
				$role    = get_post_meta( $doc->ID, '_sf_role', true );
				$booking = get_post_meta( $doc->ID, '_sf_booking_url', true );
				$bio     = $full ? apply_filters( 'the_content', $doc->post_content ) : wpautop( wp_trim_words( wp_strip_all_tags( $doc->post_content ), 60, '…' ) );
				?>
				<article class="sf-doctor">
					<?php if ( has_post_thumbnail( $doc ) ) : ?>
						<?php echo get_the_post_thumbnail( $doc, 'sf-portrait', array( 'class' => 'sf-doctor__photo', 'loading' => 'lazy', 'alt' => esc_attr( get_the_title( $doc ) ) ) ); ?>
					<?php endif; ?>
					<div class="sf-doctor__body">
						<?php if ( $role ) : ?>
							<p class="sf-doctor__role"><?php echo esc_html( $role ); ?></p>
						<?php endif; ?>
						<h3><?php echo esc_html( get_the_title( $doc ) ); ?></h3>
						<div class="sf-doctor__bio"><?php echo wp_kses_post( $bio ); ?></div>
						<?php if ( $booking ) : ?>
							<a class="sf-link" href="<?php echo esc_url( $booking ); ?>"<?php echo sf_ext( $booking ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> data-sf-track="booking"><?php esc_html_e( 'Objednať sa online', 'skinandface' ); ?> →</a>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>
