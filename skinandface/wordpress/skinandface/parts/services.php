<?php
/**
 * Služby – dve karty (dermatológia, estetika) s cenami.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

$cards = array(
	array(
		'cat'   => 'dermatologia',
		'num'   => '01',
		'title' => __( 'Dermatovenerológia', 'skinandface' ),
		'desc'  => __( 'Prevencia, diagnostika a liečba ochorení kože pre deti aj dospelých – s dôrazom na včasné odhalenie melanómu.', 'skinandface' ),
		'img'   => 'photo-znamienka.webp',
		'alt'   => __( 'Kontrola pigmentových znamienok', 'skinandface' ),
	),
	array(
		'cat'   => 'estetika',
		'num'   => '02',
		'title' => __( 'Estetická medicína', 'skinandface' ),
		'desc'  => __( 'Jemné ošetrenia podľa anatomických proporcií. Venujeme sa aj korekcii nevydarených zákrokov.', 'skinandface' ),
		'img'   => 'photo-estetika.webp',
		'alt'   => __( 'Estetické ošetrenie pleti', 'skinandface' ),
	),
);
?>
<section class="sf-section" id="sluzby">
	<div class="sf-wrap">
		<div class="sf-services">
			<?php foreach ( $cards as $c ) : ?>
				<?php $items = sf_services( $c['cat'] ); ?>
				<div class="sf-card">
					<img class="sf-card__img" src="<?php echo esc_url( sf_img( $c['img'] ) ); ?>" alt="<?php echo esc_attr( $c['alt'] ); ?>" loading="lazy" width="1920" height="480">
					<div class="sf-card__body">
						<span class="sf-card__num"><?php echo esc_html( $c['num'] ); ?></span>
						<h2><?php echo esc_html( $c['title'] ); ?></h2>
						<p class="sf-card__desc"><?php echo esc_html( $c['desc'] ); ?></p>
						<?php if ( $items ) : ?>
							<ul class="sf-list">
								<?php foreach ( $items as $item ) : ?>
									<li>
										<a href="<?php echo esc_url( get_permalink( $item ) ); ?>">
											<span><?php echo esc_html( get_the_title( $item ) ); ?></span>
											<span class="sf-price"><?php echo esc_html( sf_service_price( $item->ID ) ? sf_service_price( $item->ID ) : '→' ); ?></span>
										</a>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="sf-services__foot">
			<?php echo sf_button( sf_page_url( 'cennik' ), __( 'Pozrieť celý cenník', 'skinandface' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<span><?php esc_html_e( 'Estetická konzultácia 60 € – ak zákrok absolvujete hneď, konzultáciu neplatíte.', 'skinandface' ); ?></span>
		</div>
	</div>
</section>
