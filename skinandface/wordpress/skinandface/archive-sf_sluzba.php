<?php
/**
 * Prehľad služieb (/sluzba/).
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part(
	'parts/page-head',
	null,
	array(
		'title' => __( 'Služby', 'skinandface' ),
		'lead'  => __( 'Dermatovenerológia a estetická medicína v Stupave a v Bratislave-Rači.', 'skinandface' ),
	)
);

$sf_groups = array(
	'dermatologia' => __( 'Dermatovenerológia', 'skinandface' ),
	'estetika'     => __( 'Estetická medicína', 'skinandface' ),
);
?>
<div class="sf-wrap" style="padding-top:56px;padding-bottom:96px">
	<?php foreach ( $sf_groups as $sf_cat => $sf_label ) : ?>
		<?php $sf_items = sf_services( $sf_cat ); ?>
		<?php if ( $sf_items ) : ?>
			<h2 class="sf-h2" style="margin:0 0 24px"><?php echo esc_html( $sf_label ); ?></h2>
			<div class="sf-archive-grid" style="margin-bottom:56px">
				<?php foreach ( $sf_items as $sf_item ) : ?>
					<a class="sf-tile" href="<?php echo esc_url( get_permalink( $sf_item ) ); ?>">
						<h3><?php echo esc_html( get_the_title( $sf_item ) ); ?></h3>
						<?php if ( has_excerpt( $sf_item ) ) : ?>
							<p><?php echo esc_html( get_the_excerpt( $sf_item ) ); ?></p>
						<?php endif; ?>
						<?php if ( sf_service_price( $sf_item->ID ) ) : ?>
							<span class="sf-price"><?php echo esc_html( sf_service_price( $sf_item->ID ) ); ?></span>
						<?php endif; ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
	<?php echo sf_button( sf_page_url( 'cennik' ), __( 'Celý cenník', 'skinandface' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
<?php
get_footer();
