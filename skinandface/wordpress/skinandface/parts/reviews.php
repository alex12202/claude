<?php
/**
 * Recenzie (typ obsahu „Recenzie“).
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

$count   = max( 1, (int) sf_opt( 'reviews_count' ) );
$reviews = get_posts(
	array(
		'post_type'      => 'sf_recenzia',
		'posts_per_page' => $count,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'DESC' ),
	)
);
if ( ! $reviews ) {
	return;
}
$sources = array(
	'google' => 'Google',
	'nl'     => 'NavstevaLekara.sk',
);
?>
<section class="sf-section sf-section--white" id="recenzie">
	<div class="sf-wrap">
		<div class="sf-head">
			<div>
				<span class="sf-eyebrow"><?php esc_html_e( 'Referencie', 'skinandface' ); ?></span>
				<h2 class="sf-h2"><?php esc_html_e( 'Povedali o nás', 'skinandface' ); ?></h2>
			</div>
			<?php if ( sf_opt( 'google_rating' ) ) : ?>
				<div class="sf-rating" style="flex:0 0 auto">
					<span class="sf-rating__num"><?php echo esc_html( sf_opt( 'google_rating' ) ); ?></span>
					<span class="sf-rating__label"><span class="sf-stars" aria-hidden="true">★★★★★</span><br><?php esc_html_e( 'hodnotenie kliniky na Google', 'skinandface' ); ?></span>
				</div>
			<?php endif; ?>
		</div>
		<div class="sf-reviews">
			<?php foreach ( $reviews as $r ) : ?>
				<?php
				$stars  = (int) get_post_meta( $r->ID, '_sf_stars', true );
				$stars  = $stars ? $stars : 5;
				$source = get_post_meta( $r->ID, '_sf_source', true );
				?>
				<figure class="sf-review">
					<span class="sf-stars" role="img" aria-label="<?php echo esc_attr( sprintf( '%d z 5 hviezdičiek', $stars ) ); ?>"><?php echo esc_html( str_repeat( '★', $stars ) ); ?></span>
					<blockquote>„<?php echo esc_html( wp_strip_all_tags( $r->post_content ) ); ?>“</blockquote>
					<figcaption>
						<?php echo esc_html( get_the_title( $r ) ); ?>
						<?php if ( isset( $sources[ $source ] ) ) : ?>
							<span>· <?php echo esc_html( $sources[ $source ] ); ?></span>
						<?php endif; ?>
					</figcaption>
				</figure>
			<?php endforeach; ?>
		</div>
		<div class="sf-reviews__foot">
			<span><?php esc_html_e( 'Overené hodnotenia pacientov nájdete aj na:', 'skinandface' ); ?></span>
			<?php if ( sf_opt( 'google_url' ) ) : ?>
				<a class="sf-link" href="<?php echo esc_url( sf_opt( 'google_url' ) ); ?>" target="_blank" rel="noopener">Google →</a>
			<?php endif; ?>
			<?php if ( sf_opt( 'nl_url' ) ) : ?>
				<a class="sf-link" href="<?php echo esc_url( sf_opt( 'nl_url' ) ); ?>" target="_blank" rel="noopener">NavstevaLekara.sk →</a>
			<?php endif; ?>
		</div>
	</div>
</section>
