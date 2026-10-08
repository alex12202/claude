<?php
/**
 * Template Name: Pobočka Rača (stránka pre kampane)
 *
 * Cieľová stránka pre reklamy: formulár záujmu, služby, mapa.
 * Obsah stránky z editora sa zobrazí pod úvodom (napr. novinky k otvoreniu).
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

get_header();

$sf_open    = (bool) sf_opt( 'raca_open' );
$sf_booking = sf_opt( 'raca_booking_url' );

$sf_offer = array(
	array( __( 'Vyšetrenie znamienok', 'skinandface' ), __( 'Komplexné vyšetrenie znamienok celého tela dermatoskopom s konzultáciou – 70 €.', 'skinandface' ) ),
	array( __( 'Dermatologické vyšetrenie', 'skinandface' ), __( 'Kožné problémy detí aj dospelých – od znamienok až po akné – 50 €.', 'skinandface' ) ),
	array( __( 'Vlasová poradňa', 'skinandface' ), __( 'Konzultácia problémov s vlasmi a pokožkou hlavy – 60 €.', 'skinandface' ) ),
	array( __( 'Estetická medicína', 'skinandface' ), __( 'Botulotoxín, výplne, pery, mezoterapia. Estetická konzultácia 60 €.', 'skinandface' ) ),
);

while ( have_posts() ) :
	the_post();
	?>
	<section class="sf-section" style="background:var(--sf-white);padding-top:72px;border-bottom:1px solid var(--sf-line)">
		<div class="sf-wrap" style="display:flex;flex-wrap:wrap;gap:56px;align-items:flex-start">
			<div style="flex:1 1 520px;min-width:0">
				<nav class="sf-breadcrumbs" aria-label="<?php esc_attr_e( 'Omrvinky', 'skinandface' ); ?>">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Domov', 'skinandface' ); ?></a> / <span aria-current="page"><?php the_title(); ?></span>
				</nav>
				<span class="sf-badge" style="margin-bottom:20px"><?php echo esc_html( $sf_open ? __( 'Nová pobočka', 'skinandface' ) : sprintf( __( 'Nová pobočka · %s', 'skinandface' ), sf_opt( 'raca_badge' ) ) ); ?></span>
				<h1 style="font-size:clamp(40px,5vw,58px);line-height:1.06;margin:0 0 18px"><?php the_title(); ?></h1>
				<p class="sf-lead" style="font-size:18px;margin-bottom:28px"><?php esc_html_e( 'Skin & Face prichádza zo Stupavy aj do Rače. Vyšetrenie znamienok, liečba kožných ochorení a estetická medicína s prirodzenými výsledkami.', 'skinandface' ); ?></p>
				<ul class="sf-checks">
					<li><?php echo sf_icon( 'check', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( $sf_open ? __( 'Objednajte sa online alebo nám nechajte kontakt', 'skinandface' ) : __( 'Nechajte nám kontakt a ozveme sa vám s termínom hneď po otvorení', 'skinandface' ) ); ?></span></li>
					<li><?php echo sf_icon( 'check', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php esc_html_e( 'Tím MUDr. Barbory Vargovej – dermatovenerológia a estetická medicína', 'skinandface' ); ?></span></li>
					<?php if ( sf_opt( 'google_rating' ) ) : ?>
						<li><?php echo sf_icon( 'check', 20 ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><span><?php echo esc_html( sprintf( __( 'Hodnotenie kliniky %s ★ na Google', 'skinandface' ), sf_opt( 'google_rating' ) ) ); ?></span></li>
					<?php endif; ?>
				</ul>
				<?php if ( $sf_open && $sf_booking ) : ?>
					<p><?php echo sf_button( $sf_booking, __( 'Objednať sa online v Rači', 'skinandface' ), '', array( 'data-sf-track' => 'booking-raca' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
				<img src="<?php echo esc_url( sf_img( 'photo-estetika.webp' ) ); ?>" alt="<?php esc_attr_e( 'Estetické ošetrenie pleti – Skin & Face Bratislava-Rača', 'skinandface' ); ?>" width="1920" height="480" style="width:100%;height:280px;object-fit:cover;object-position:30% center;border-radius:var(--sf-radius)">
			</div>
			<div style="flex:1 1 380px;min-width:0">
				<?php sf_interest_form( 'Bratislava-Rača' ); ?>
			</div>
		</div>
	</section>

	<?php if ( trim( get_the_content() ) ) : ?>
		<section class="sf-section" style="padding-bottom:0">
			<div class="sf-wrap sf-content"><?php the_content(); ?></div>
		</section>
	<?php endif; ?>

	<section class="sf-section">
		<div class="sf-wrap">
			<h2 class="sf-h2" style="margin-bottom:36px"><?php esc_html_e( 'Čo v Rači ponúkame', 'skinandface' ); ?></h2>
			<div class="sf-archive-grid">
				<?php foreach ( $sf_offer as $sf_o ) : ?>
					<div class="sf-tile">
						<h3 style="font:600 17px/1.4 var(--sf-sans);color:var(--sf-ink)"><?php echo esc_html( $sf_o[0] ); ?></h3>
						<p><?php echo esc_html( $sf_o[1] ); ?></p>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<section class="sf-section sf-section--white" style="border-bottom:1px solid var(--sf-line)">
		<div class="sf-wrap" style="display:flex;flex-wrap:wrap;gap:48px;align-items:center">
			<img src="<?php echo esc_url( sf_img( 'mapa-raca.webp' ) ); ?>" alt="<?php esc_attr_e( 'Mapa: mestská časť Bratislava-Rača', 'skinandface' ); ?>" loading="lazy" width="1200" height="800" style="flex:1 1 520px;min-width:0;height:360px;object-fit:cover;border-radius:var(--sf-radius)">
			<div style="flex:1 1 360px">
				<h2 class="sf-h2"><?php esc_html_e( 'Nájdete nás v Rači', 'skinandface' ); ?></h2>
				<?php if ( sf_opt( 'raca_street' ) ) : ?>
					<p><strong><?php esc_html_e( 'Adresa:', 'skinandface' ); ?></strong> <?php echo esc_html( sf_address( 'raca' ) ); ?></p>
					<?php if ( sf_opt( 'raca_hours' ) ) : ?>
						<p><strong><?php esc_html_e( 'Ordinačné hodiny:', 'skinandface' ); ?></strong><br><?php echo nl2br( esc_html( sf_opt( 'raca_hours' ) ) ); ?></p>
					<?php endif; ?>
					<?php if ( sf_opt( 'raca_map_url' ) ) : ?>
						<a class="sf-btn sf-btn--outline" href="<?php echo esc_url( sf_opt( 'raca_map_url' ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Navigovať cez Google Maps', 'skinandface' ); ?></a>
					<?php endif; ?>
				<?php else : ?>
					<p><?php esc_html_e( 'Novú ambulanciu otvárame v mestskej časti Bratislava-Rača.', 'skinandface' ); ?></p>
					<p class="sf-branch__muted"><?php echo esc_html( sprintf( __( 'Presnú adresu a ordinačné hodiny zverejníme pred otvorením. Dovtedy nás nájdete v Stupave na adrese %s.', 'skinandface' ), sf_address( 'stupava' ) ) ); ?></p>
					<?php if ( sf_opt( 'stupava_map_url' ) ) : ?>
						<a class="sf-btn sf-btn--outline" href="<?php echo esc_url( sf_opt( 'stupava_map_url' ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Pobočka Stupava na Google Maps', 'skinandface' ); ?></a>
					<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<section class="sf-cta">
		<div class="sf-wrap" style="justify-content:center;text-align:center;flex-direction:column">
			<h2><?php esc_html_e( 'Buďte medzi prvými pacientmi', 'skinandface' ); ?> <em><?php esc_html_e( 'v Rači.', 'skinandface' ); ?></em></h2>
			<p><?php esc_html_e( 'Nechajte nám kontakt a ozveme sa vám.', 'skinandface' ); ?></p>
			<div class="sf-cta__btns" style="justify-content:center">
				<?php echo sf_button( '#formular', __( 'Chcem termín', 'skinandface' ), 'light' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<a class="sf-btn sf-btn--ghost" style="padding:0 24px" href="<?php echo esc_attr( sf_tel_href() ); ?>" data-sf-track="phone"><?php esc_html_e( 'Zavolať', 'skinandface' ); ?></a>
			</div>
		</div>
	</section>
	<?php
endwhile;

get_footer();
