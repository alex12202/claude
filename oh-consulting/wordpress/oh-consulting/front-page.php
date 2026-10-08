<?php
/**
 * Úvodná stránka.
 *
 * Texty sa upravujú priamo v tomto súbore, kontakty vo Vzhľad → Prispôsobiť → OH Consulting.
 *
 * @package oh-consulting
 */

get_header();

$oh_slides = array(
	array(
		'img'     => 'hero-1.jpg',
		'alt'     => __( 'Účtovníčka konzultuje s klientkou pri notebooku', 'oh-consulting' ),
		'pos'     => 'center 35%',
		'eyebrow' => __( 'Účtovníctvo pre firmy a živnostníkov', 'oh-consulting' ),
		'title'   => __( 'Vy podnikáte.<br><em>Účtovníctvo nechajte na nás.</em>', 'oh-consulting' ),
		'text'    => __( 'Viac ako 10 rokov praxe, presné spracovanie a osobný prístup. Žiadne zmeškané termíny, žiadne pokuty, žiadny stres.', 'oh-consulting' ),
		'cta'     => array( __( 'Získať cenovú ponuku zdarma', 'oh-consulting' ), '#kontakt' ),
		'cta2'    => 'tel',
	),
	array(
		'img'     => 'hero-2.jpg',
		'alt'     => __( 'Podpisovanie dokumentov', 'oh-consulting' ),
		'pos'     => 'center',
		'eyebrow' => __( 'Daňové priznania · DPH · Závierky', 'oh-consulting' ),
		'title'   => __( 'Dane podané správne <em>a vždy načas</em>', 'oh-consulting' ),
		'text'    => __( 'Sledujeme každú zmenu legislatívy, aby ste nemuseli vy. Daň z príjmov FO aj PO, DPH aj daň z motorových vozidiel.', 'oh-consulting' ),
		'cta'     => array( __( 'Chcem mať dane vyriešené', 'oh-consulting' ), '#kontakt' ),
		'cta2'    => array( __( 'Pozrieť služby', 'oh-consulting' ), '#sluzby' ),
	),
	array(
		'img'     => 'hero-3.jpg',
		'alt'     => __( 'Rastlinka rastúca z mincí', 'oh-consulting' ),
		'pos'     => '70% center',
		'eyebrow' => __( 'Mzdy · Personalistika · Poradenstvo', 'oh-consulting' ),
		'title'   => __( 'Viac času na rast <em>vašej firmy</em>', 'oh-consulting' ),
		'text'    => __( 'Mzdy, odvody, zmluvy aj výber informačného systému. Jedna osoba, ktorá pozná vašu firmu a je tu pre vás.', 'oh-consulting' ),
		'cta'     => array( __( 'Dohodnúť stretnutie', 'oh-consulting' ), '#kontakt' ),
		'cta2'    => 'tel',
	),
);

$oh_services = array(
	array(
		'img'   => 'sluzba-uctovnictvo.jpg',
		'alt'   => __( 'Daňové tlačivá a kalkulačka', 'oh-consulting' ),
		'title' => __( 'Účtovníctvo', 'oh-consulting' ),
		'desc'  => __( 'Jednoduché aj podvojné, vrátane ročnej závierky.', 'oh-consulting' ),
		'items' => array(
			__( 'peňažný denník, hlavná kniha, účtovný denník', 'oh-consulting' ),
			__( 'pokladnica, bankové výpisy, pohľadávky a záväzky', 'oh-consulting' ),
			__( 'evidencia majetku, interné smernice', 'oh-consulting' ),
			__( 'závierka: súvaha, výkaz ziskov a strát, cash flow', 'oh-consulting' ),
		),
	),
	array(
		'img'   => 'sluzba-dane.jpg',
		'alt'   => __( 'Formulár na podložke a notebook', 'oh-consulting' ),
		'title' => __( 'Dane', 'oh-consulting' ),
		'desc'  => __( 'Priznania správne a bez zbytočných nedoplatkov.', 'oh-consulting' ),
		'items' => array(
			__( 'daň z príjmov fyzických osôb', 'oh-consulting' ),
			__( 'daň z príjmov právnických osôb', 'oh-consulting' ),
			__( 'DPH – evidencia a priznania', 'oh-consulting' ),
			__( 'daň z motorových vozidiel', 'oh-consulting' ),
		),
	),
	array(
		'img'   => 'sluzba-mzdy.jpg',
		'alt'   => __( 'Tím pri pracovnom stole', 'oh-consulting' ),
		'title' => __( 'Mzdy a personalistika', 'oh-consulting' ),
		'desc'  => __( 'Od pracovnej zmluvy po ročné zúčtovanie.', 'oh-consulting' ),
		'items' => array(
			__( 'zmluvy a dohody, prihlášky a odhlášky', 'oh-consulting' ),
			__( 'mesačné mzdy a výkazy do poisťovní', 'oh-consulting' ),
			__( 'príkazy na úhradu miezd a odvodov', 'oh-consulting' ),
			__( 'ročné zúčtovanie, mzdové a evidenčné listy', 'oh-consulting' ),
		),
	),
	array(
		'img'   => 'sluzba-poradenstvo.jpg',
		'alt'   => __( 'Notebook s finančným prehľadom', 'oh-consulting' ),
		'title' => __( 'Poradenstvo', 'oh-consulting' ),
		'desc'  => __( 'Odborná pomoc priamo vo vašej firme.', 'oh-consulting' ),
		'items' => array(
			__( 'účtovný dozor a poradenstvo', 'oh-consulting' ),
			__( 'výber, zavedenie a údržba informačného systému', 'oh-consulting' ),
			__( 'zaškolenie používateľov', 'oh-consulting' ),
			__( 'podklady pre podnikateľský úver', 'oh-consulting' ),
		),
	),
);

// Ukážkové referencie – pred spustením nahradiť skutočnými (so súhlasom klientov).
$oh_refs = array(
	array( __( 'Konečne nemusím riešiť termíny ani zmeny v zákonoch. Všetko je vždy pripravené včas a keď niečomu nerozumiem, dostanem jasné vysvetlenie.', 'oh-consulting' ), 'Martina K.', __( 'kaderníčka, živnostníčka', 'oh-consulting' ) ),
	array( __( 'Prešli sme k OH & Consulting pri zmene účtovníčky a prechod bol úplne bezproblémový. Mzdy aj DPH máme každý mesiac hotové bez stresu.', 'oh-consulting' ), 'Peter H.', __( 'konateľ stavebnej firmy', 'oh-consulting' ) ),
	array( __( 'Oceňujem osobný prístup a ochotu poradiť aj mimo bežného účtovníctva. Pomohli nám aj s podkladmi pre podnikateľský úver.', 'oh-consulting' ), 'Jana a Tomáš V.', __( 'rodinný e-shop', 'oh-consulting' ) ),
);

$oh_tel   = oh_tel_href();
$oh_phone = oh_opt( 'phone' );
$oh_email = antispambot( oh_opt( 'email' ) );
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- iba zobrazenie výsledku.
$oh_status = isset( $_GET['dopyt'] ) ? sanitize_key( wp_unslash( $_GET['dopyt'] ) ) : '';
?>

<main id="obsah">

	<!-- HERO SLIDER -->
	<section class="oh-hero" id="top" aria-roledescription="carousel" aria-label="<?php esc_attr_e( 'Úvodné slidy', 'oh-consulting' ); ?>" data-speed="<?php echo esc_attr( (int) oh_opt( 'slider_speed' ) ); ?>">
		<?php foreach ( $oh_slides as $i => $slide ) : ?>
			<div class="oh-slide<?php echo 0 === $i ? ' is-active' : ''; ?>" role="group" aria-roledescription="slide" aria-label="<?php echo esc_attr( ( $i + 1 ) . ' / ' . count( $oh_slides ) ); ?>"<?php echo 0 === $i ? '' : ' aria-hidden="true"'; ?>>
				<img class="oh-slide__img" src="<?php echo esc_url( oh_img( $slide['img'] ) ); ?>" alt="<?php echo esc_attr( $slide['alt'] ); ?>" style="object-position: <?php echo esc_attr( $slide['pos'] ); ?>" width="2000" height="1333"<?php echo 0 === $i ? ' fetchpriority="high"' : ' loading="lazy"'; ?>>
				<div class="oh-slide__scrim"></div>
				<div class="oh-container">
					<div class="oh-slide__body">
						<p class="oh-slide__eyebrow"><?php echo esc_html( $slide['eyebrow'] ); ?></p>
						<?php
						$oh_tag = 0 === $i ? 'h1' : 'h2';
						printf( '<%1$s class="oh-slide__title">%2$s</%1$s>', $oh_tag, wp_kses( $slide['title'], array( 'br' => array(), 'em' => array() ) ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						?>
						<p class="oh-slide__text"><?php echo esc_html( $slide['text'] ); ?></p>
						<div class="oh-slide__ctas">
							<a class="oh-btn oh-btn--primary oh-btn--lg" href="<?php echo esc_attr( $slide['cta'][1] ); ?>"><?php echo esc_html( $slide['cta'][0] ); ?> <span aria-hidden="true">→</span></a>
							<?php if ( 'tel' === $slide['cta2'] ) : ?>
								<a class="oh-btn oh-btn--ghost oh-btn--lg" href="<?php echo esc_attr( $oh_tel ); ?>"><?php echo esc_html( sprintf( /* translators: %s: telefón */ __( 'Zavolať %s', 'oh-consulting' ), $oh_phone ) ); ?></a>
							<?php else : ?>
								<a class="oh-btn oh-btn--ghost oh-btn--lg" href="<?php echo esc_attr( $slide['cta2'][1] ); ?>"><?php echo esc_html( $slide['cta2'][0] ); ?></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>

		<div class="oh-hero__controls">
			<div class="oh-container">
				<div class="oh-dots">
					<?php foreach ( $oh_slides as $i => $slide ) : ?>
						<button class="oh-dot" type="button" data-slide="<?php echo esc_attr( $i ); ?>" aria-label="<?php echo esc_attr( sprintf( /* translators: %d: číslo slidu */ __( 'Slide %d', 'oh-consulting' ), $i + 1 ) ); ?>" aria-current="<?php echo 0 === $i ? 'true' : 'false'; ?>"><span></span></button>
					<?php endforeach; ?>
				</div>
				<div class="oh-arrows">
					<button class="oh-arrow" type="button" data-dir="-1" aria-label="<?php esc_attr_e( 'Predchádzajúci slide', 'oh-consulting' ); ?>"><?php oh_icon( 'left', 20 ); ?></button>
					<button class="oh-arrow" type="button" data-dir="1" aria-label="<?php esc_attr_e( 'Ďalší slide', 'oh-consulting' ); ?>"><?php oh_icon( 'right', 20 ); ?></button>
				</div>
			</div>
		</div>
	</section>

	<!-- KARTA DÔVERY -->
	<section class="oh-trust" aria-label="<?php esc_attr_e( 'Prečo my', 'oh-consulting' ); ?>">
		<div class="oh-container">
			<div class="oh-trust__card">
				<div class="oh-trust__item"><div class="oh-trust__big">10+</div><div><strong><?php esc_html_e( 'rokov praxe', 'oh-consulting' ); ?></strong><br><span><?php esc_html_e( 'v účtovníctve a daniach', 'oh-consulting' ); ?></span></div></div>
				<div class="oh-trust__item"><?php oh_icon( 'clock', 40 ); ?><div><strong><?php esc_html_e( 'Vždy načas', 'oh-consulting' ); ?></strong><br><span><?php esc_html_e( 'strážime všetky termíny', 'oh-consulting' ); ?></span></div></div>
				<div class="oh-trust__item"><?php oh_icon( 'shield', 40 ); ?><div><strong><?php esc_html_e( 'Podľa aktuálnych zákonov', 'oh-consulting' ); ?></strong><br><span><?php esc_html_e( 'legislatívu sledujeme za vás', 'oh-consulting' ); ?></span></div></div>
				<div class="oh-trust__item"><?php oh_icon( 'user', 40 ); ?><div><strong><?php esc_html_e( 'Osobný prístup', 'oh-consulting' ); ?></strong><br><span><?php esc_html_e( 'jedna kontaktná osoba', 'oh-consulting' ); ?></span></div></div>
			</div>
		</div>
	</section>

	<!-- POZNÁTE TO? -->
	<section class="oh-section oh-pains">
		<div class="oh-container">
			<div class="oh-head-center oh-reveal">
				<p class="oh-eyebrow"><?php esc_html_e( 'Poznáte to?', 'oh-consulting' ); ?></p>
				<h2 class="oh-h2"><?php esc_html_e( 'Účtovníctvo by vás nemalo pripravovať o spánok', 'oh-consulting' ); ?></h2>
			</div>
			<div class="oh-grid-3">
				<div class="oh-pain oh-reveal">
					<p class="oh-pain__before"><?php esc_html_e( '„Zase sa blíži termín priznania a ja nemám nič pripravené.“', 'oh-consulting' ); ?></p>
					<p class="oh-pain__after"><?php esc_html_e( 'S nami: termíny strážime my a doklady si vyžiadame včas.', 'oh-consulting' ); ?></p>
				</div>
				<div class="oh-pain oh-reveal">
					<p class="oh-pain__before"><?php esc_html_e( '„Neviem, čo sa zase zmenilo v zákone o DPH.“', 'oh-consulting' ); ?></p>
					<p class="oh-pain__after"><?php esc_html_e( 'S nami: legislatívu sledujeme a zmeny vám vysvetlíme ľudsky.', 'oh-consulting' ); ?></p>
				</div>
				<div class="oh-pain oh-reveal">
					<p class="oh-pain__before"><?php esc_html_e( '„Mzdy a odvody mi berú hodiny každý mesiac.“', 'oh-consulting' ); ?></p>
					<p class="oh-pain__after"><?php esc_html_e( 'S nami: mzdy, výkazy aj platobné príkazy dostanete hotové.', 'oh-consulting' ); ?></p>
				</div>
			</div>
		</div>
	</section>

	<!-- SLUŽBY -->
	<section class="oh-section oh-services" id="sluzby">
		<div class="oh-container">
			<div class="oh-services__head">
				<div>
					<p class="oh-eyebrow"><?php esc_html_e( 'Služby', 'oh-consulting' ); ?></p>
					<h2 class="oh-h2"><?php esc_html_e( 'Kompletný servis pod jednou strechou', 'oh-consulting' ); ?></h2>
				</div>
				<a class="oh-btn oh-btn--dark" href="#kontakt"><?php esc_html_e( 'Nezáväzne sa opýtať', 'oh-consulting' ); ?></a>
			</div>
			<div class="oh-grid-4">
				<?php foreach ( $oh_services as $service ) : ?>
					<article class="oh-card oh-reveal">
						<div class="oh-card__img"><img src="<?php echo esc_url( oh_img( $service['img'] ) ); ?>" alt="<?php echo esc_attr( $service['alt'] ); ?>" width="800" height="533" loading="lazy"></div>
						<div class="oh-card__body">
							<h3 class="oh-card__title"><?php echo esc_html( $service['title'] ); ?></h3>
							<p class="oh-card__desc"><?php echo esc_html( $service['desc'] ); ?></p>
							<ul>
								<?php foreach ( $service['items'] as $item ) : ?>
									<li><?php echo esc_html( $item ); ?></li>
								<?php endforeach; ?>
							</ul>
							<a class="oh-card__link" href="#kontakt"><?php esc_html_e( 'Mám záujem →', 'oh-consulting' ); ?></a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- O NÁS -->
	<section class="oh-section oh-section--blush" id="o-nas">
		<div class="oh-container oh-about">
			<div class="oh-about__media oh-reveal">
				<img src="<?php echo esc_url( oh_img( 'o-nas.jpg' ) ); ?>" alt="<?php esc_attr_e( 'Spracovanie daňových dokladov', 'oh-consulting' ); ?>" width="1100" height="631" loading="lazy">
				<div class="oh-about__badge"><b>10+</b><?php esc_html_e( 'rokov skúseností s účtovníctvom firiem aj živnostníkov', 'oh-consulting' ); ?></div>
			</div>
			<div class="oh-about__text oh-reveal">
				<p class="oh-eyebrow"><?php esc_html_e( 'O nás', 'oh-consulting' ); ?></p>
				<h2 class="oh-h2"><?php esc_html_e( 'Nová firma, dlhoročné skúsenosti', 'oh-consulting' ); ?></h2>
				<p class="oh-lead"><?php esc_html_e( 'OH & Consulting s.r.o. vznikla v roku 2025 transformáciou živnosti s dlhoročnou praxou. Klienti tak dostávajú istotu skúsenej účtovníčky a zázemie spoločnosti.', 'oh-consulting' ); ?></p>
				<p class="oh-lead" style="margin-bottom:26px"><?php esc_html_e( 'Našou prioritou je presnosť, zodpovednosť a individuálny prístup. Postaráme sa, aby bolo všetko správne, prehľadné a včas – a vy ste sa mohli naplno venovať podnikaniu.', 'oh-consulting' ); ?></p>
				<ul class="oh-checks">
					<li><?php oh_icon( 'check', 22 ); ?><?php esc_html_e( 'Jednoduché aj podvojné účtovníctvo', 'oh-consulting' ); ?></li>
					<li><?php oh_icon( 'check', 22 ); ?><?php esc_html_e( 'Dane, mzdy a odvody v jednej ruke', 'oh-consulting' ); ?></li>
					<li><?php oh_icon( 'check', 22 ); ?><?php esc_html_e( 'Férová cena podľa rozsahu', 'oh-consulting' ); ?></li>
					<li><?php oh_icon( 'check', 22 ); ?><?php esc_html_e( 'Kancelária v Trebišove', 'oh-consulting' ); ?></li>
				</ul>
				<div class="oh-about__cta">
					<a class="oh-btn oh-btn--primary" href="#kontakt"><?php esc_html_e( 'Dohodnúť stretnutie', 'oh-consulting' ); ?></a>
					<div class="oh-person">
						<div class="oh-person__avatar">OH</div>
						<div><b><?php echo esc_html( oh_opt( 'person' ) ); ?></b><small><?php echo esc_html( oh_opt( 'person_role' ) ); ?></small></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- AKO TO FUNGUJE -->
	<section class="oh-section" id="postup">
		<div class="oh-container">
			<div class="oh-head-center oh-reveal">
				<p class="oh-eyebrow"><?php esc_html_e( 'Ako to funguje', 'oh-consulting' ); ?></p>
				<h2 class="oh-h2"><?php esc_html_e( 'Prechod k nám je jednoduchý', 'oh-consulting' ); ?></h2>
			</div>
			<ol class="oh-steps">
				<li class="oh-step oh-reveal"><div class="oh-step__num">1</div><h3><?php esc_html_e( 'Ozvete sa', 'oh-consulting' ); ?></h3><p><?php esc_html_e( 'Telefonicky, e-mailom alebo cez formulár. Stačí pár viet o vašej firme.', 'oh-consulting' ); ?></p></li>
				<li class="oh-step oh-reveal"><div class="oh-step__num">2</div><h3><?php esc_html_e( 'Dostanete ponuku', 'oh-consulting' ); ?></h3><p><?php esc_html_e( 'Nezáväznú a na mieru – podľa rozsahu a počtu položiek.', 'oh-consulting' ); ?></p></li>
				<li class="oh-step oh-reveal"><div class="oh-step__num">3</div><h3><?php esc_html_e( 'Máte pokoj', 'oh-consulting' ); ?></h3><p><?php esc_html_e( 'Doklady, termíny, priznania aj mzdy riešime my. Vy sa venujete biznisu.', 'oh-consulting' ); ?></p></li>
			</ol>
			<div class="oh-center">
				<a class="oh-btn oh-btn--primary oh-btn--lg" href="#kontakt"><?php esc_html_e( 'Začať spoluprácu', 'oh-consulting' ); ?> <span aria-hidden="true">→</span></a>
			</div>
		</div>
	</section>

	<!-- REFERENCIE -->
	<section class="oh-section oh-refs" aria-labelledby="oh-refs-title">
		<div class="oh-container">
			<h2 class="oh-refs__title" id="oh-refs-title"><?php esc_html_e( 'Čo hovoria klienti', 'oh-consulting' ); ?></h2>
			<div class="oh-grid-3">
				<?php foreach ( $oh_refs as $ref ) : ?>
					<figure class="oh-ref oh-reveal">
						<div class="oh-ref__stars" role="img" aria-label="<?php esc_attr_e( 'Hodnotenie 5 z 5', 'oh-consulting' ); ?>">★★★★★</div>
						<blockquote>„<?php echo esc_html( $ref[0] ); ?>“</blockquote>
						<figcaption><strong><?php echo esc_html( $ref[1] ); ?></strong>, <?php echo esc_html( $ref[2] ); ?></figcaption>
					</figure>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- CENNÍK -->
	<section class="oh-cta" id="cennik">
		<img class="oh-cta__bg" src="<?php echo esc_url( oh_img( 'cennik-pozadie.jpg' ) ); ?>" alt="" width="1800" height="1200" loading="lazy">
		<div class="oh-cta__overlay"></div>
		<div class="oh-container oh-section">
			<div class="oh-cta__text">
				<p class="oh-eyebrow"><?php esc_html_e( 'Cenník', 'oh-consulting' ); ?></p>
				<h2><?php esc_html_e( 'Platíte len za to, čo naozaj potrebujete', 'oh-consulting' ); ?></h2>
				<p><?php esc_html_e( 'Cenu stanovujeme individuálne podľa zložitosti a počtu zaúčtovaných položiek – s dôrazom na vzájomnú spokojnosť. Cenovú ponuku vám pripravíme nezáväzne a zdarma.', 'oh-consulting' ); ?></p>
			</div>
			<div class="oh-cta__buttons">
				<a class="oh-btn oh-btn--primary oh-btn--lg" href="#kontakt"><?php esc_html_e( 'Chcem cenovú ponuku', 'oh-consulting' ); ?></a>
				<a class="oh-btn oh-btn--ghost oh-btn--lg" href="<?php echo esc_attr( $oh_tel ); ?>"><?php echo esc_html( sprintf( /* translators: %s: telefón */ __( 'Zavolať %s', 'oh-consulting' ), $oh_phone ) ); ?></a>
			</div>
		</div>
	</section>

	<!-- KONTAKT -->
	<section class="oh-section oh-section--blush" id="kontakt">
		<div class="oh-container oh-contact">
			<div class="oh-contact__info">
				<p class="oh-eyebrow"><?php esc_html_e( 'Kontakt', 'oh-consulting' ); ?></p>
				<h2 class="oh-h2"><?php esc_html_e( 'Poďme sa porozprávať o vašej firme', 'oh-consulting' ); ?></h2>
				<p class="oh-lead"><?php esc_html_e( 'Napíšte nám alebo zavolajte. Ozveme sa čo najskôr a pripravíme ponuku presne pre vás.', 'oh-consulting' ); ?></p>

				<a class="oh-contact-card" href="<?php echo esc_attr( $oh_tel ); ?>">
					<span class="oh-contact-card__icon oh-contact-card__icon--accent"><?php oh_icon( 'phone', 22 ); ?></span>
					<span><small><?php echo esc_html( oh_opt( 'person' ) ); ?></small><b><?php echo esc_html( $oh_phone ); ?></b></span>
				</a>
				<a class="oh-contact-card" href="mailto:<?php echo esc_attr( $oh_email ); ?>">
					<span class="oh-contact-card__icon"><?php oh_icon( 'mail', 22 ); ?></span>
					<span><small><?php esc_html_e( 'E-mail', 'oh-consulting' ); ?></small><b><?php echo esc_html( $oh_email ); ?></b></span>
				</a>

				<div class="oh-addresses">
					<div><div class="oh-label"><?php esc_html_e( 'Kancelária', 'oh-consulting' ); ?></div><?php echo nl2br( esc_html( oh_opt( 'office' ) ) ); ?></div>
					<div><div class="oh-label"><?php esc_html_e( 'Sídlo firmy', 'oh-consulting' ); ?></div><?php echo nl2br( esc_html( oh_opt( 'seat' ) ) ); ?><small>IČO <?php echo esc_html( oh_opt( 'ico' ) ); ?> · DIČ <?php echo esc_html( oh_opt( 'dic' ) ); ?></small></div>
				</div>
			</div>

			<div class="oh-form">
				<div>
					<h3><?php esc_html_e( 'Cenová ponuka zdarma', 'oh-consulting' ); ?></h3>
					<p class="oh-form__sub"><?php esc_html_e( 'Vyplnenie trvá menej ako minútu. Nezáväzné.', 'oh-consulting' ); ?></p>
				</div>

				<?php if ( 'ok' === $oh_status ) : ?>
					<div class="oh-notice oh-notice--ok" role="status"><?php esc_html_e( 'Ďakujeme, dopyt sme prijali. Ozveme sa vám čo najskôr.', 'oh-consulting' ); ?></div>
				<?php elseif ( 'chyba' === $oh_status ) : ?>
					<div class="oh-notice oh-notice--err" role="alert"><?php esc_html_e( 'Dopyt sa nepodarilo odoslať. Skontrolujte meno, telefón alebo e-mail a súhlas, prípadne nám zavolajte.', 'oh-consulting' ); ?></div>
				<?php endif; ?>

				<?php if ( oh_opt( 'form_shortcode' ) ) : ?>
					<?php echo do_shortcode( oh_opt( 'form_shortcode' ) ); ?>
				<?php else : ?>
					<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="display:flex;flex-direction:column;gap:18px">
						<input type="hidden" name="action" value="oh_contact">
						<?php wp_nonce_field( 'oh_contact', 'oh_nonce' ); ?>
						<label class="oh-hp" aria-hidden="true"><?php esc_html_e( 'Nevypĺňajte', 'oh-consulting' ); ?><input type="text" name="oh_web" tabindex="-1" autocomplete="off"></label>
						<div class="oh-form__row">
							<label><?php esc_html_e( 'Meno a priezvisko', 'oh-consulting' ); ?><input type="text" name="oh_meno" autocomplete="name" required></label>
							<label><?php esc_html_e( 'Telefón', 'oh-consulting' ); ?><input type="tel" name="oh_telefon" autocomplete="tel"></label>
						</div>
						<label><?php esc_html_e( 'E-mail', 'oh-consulting' ); ?><input type="email" name="oh_email" autocomplete="email"></label>
						<label><?php esc_html_e( 'O čo máte záujem?', 'oh-consulting' ); ?>
							<select name="oh_sluzba">
								<option><?php esc_html_e( 'Jednoduché účtovníctvo', 'oh-consulting' ); ?></option>
								<option><?php esc_html_e( 'Podvojné účtovníctvo', 'oh-consulting' ); ?></option>
								<option><?php esc_html_e( 'Daňové priznanie', 'oh-consulting' ); ?></option>
								<option><?php esc_html_e( 'Mzdy a personalistika', 'oh-consulting' ); ?></option>
								<option><?php esc_html_e( 'Poradenstvo', 'oh-consulting' ); ?></option>
								<option><?php esc_html_e( 'Iné', 'oh-consulting' ); ?></option>
							</select>
						</label>
						<label><?php esc_html_e( 'Správa (nepovinné)', 'oh-consulting' ); ?><textarea name="oh_sprava" rows="4"></textarea></label>
						<label class="oh-consent"><input type="checkbox" name="oh_gdpr" value="1" required>
							<span>
								<?php esc_html_e( 'Súhlasím so spracovaním osobných údajov na účel odpovede na môj dopyt.', 'oh-consulting' ); ?>
								<?php if ( get_privacy_policy_url() ) : ?>
									<a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php esc_html_e( 'Viac informácií', 'oh-consulting' ); ?></a>
								<?php endif; ?>
							</span>
						</label>
						<button class="oh-btn oh-btn--primary" type="submit"><?php esc_html_e( 'Získať cenovú ponuku →', 'oh-consulting' ); ?></button>
						<small style="color:var(--oh-text)"><?php esc_html_e( 'Vyplňte telefón alebo e-mail, aby sme sa vám mohli ozvať.', 'oh-consulting' ); ?></small>
					</form>
				<?php endif; ?>
			</div>
		</div>
	</section>

</main>

<?php
get_footer();
