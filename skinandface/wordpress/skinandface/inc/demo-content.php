<?php
/**
 * Úvodný obsah: po aktivácii témy vytvorí stránky, služby s cenami,
 * lekárky, recenzie, časté otázky a menu. Údaje pochádzajú zo súčasného
 * webu skinandface.sk, cenníka, Google profilu a NavstevaLekara.sk.
 *
 * Spustí sa iba raz. Znova ho spustíte v Nástroje › Skin & Face obsah.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

/* ---------- Pomocníci pre bloky ---------- */

/**
 * Odstavec.
 *
 * @param string $text Text (môže obsahovať <strong>, <a>).
 * @return string
 */
function sf_b_p( $text ) {
	return "<!-- wp:paragraph -->\n<p>{$text}</p>\n<!-- /wp:paragraph -->\n\n";
}

/**
 * Nadpis H2.
 *
 * @param string $text Text.
 * @return string
 */
function sf_b_h2( $text ) {
	return "<!-- wp:heading -->\n<h2 class=\"wp-block-heading\">" . esc_html( $text ) . "</h2>\n<!-- /wp:heading -->\n\n";
}

/**
 * Zoznam.
 *
 * @param array $items Položky.
 * @param bool  $ordered Číslovaný.
 * @return string
 */
function sf_b_list( $items, $ordered = false ) {
	$tag  = $ordered ? 'ol' : 'ul';
	$attr = $ordered ? ' {"ordered":true}' : '';
	$out  = "<!-- wp:list{$attr} -->\n<{$tag} class=\"wp-block-list\">";
	foreach ( $items as $item ) {
		$out .= "<!-- wp:list-item -->\n<li>" . esc_html( $item ) . "</li>\n<!-- /wp:list-item -->";
	}
	return $out . "</{$tag}>\n<!-- /wp:list -->\n\n";
}

/**
 * Tabuľka cien (dvojice názov => cena).
 *
 * @param array $rows Riadky.
 * @return string
 */
function sf_b_table( $rows ) {
	$out = "<!-- wp:table {\"className\":\"sf-price-table\"} -->\n<figure class=\"wp-block-table sf-price-table\"><table><tbody>";
	foreach ( $rows as $name => $price ) {
		$out .= '<tr><td>' . esc_html( $name ) . '</td><td>' . esc_html( $price ) . '</td></tr>';
	}
	return $out . "</tbody></table></figure>\n<!-- /wp:table -->\n\n";
}

/**
 * Rozbaľovacia otázka.
 *
 * @param string $q Otázka.
 * @param string $a Odpoveď.
 * @return string
 */
function sf_b_details( $q, $a ) {
	return "<!-- wp:details -->\n<details class=\"wp-block-details\"><summary>" . esc_html( $q ) . "</summary><!-- wp:paragraph -->\n<p>" . esc_html( $a ) . "</p>\n<!-- /wp:paragraph --></details>\n<!-- /wp:details -->\n\n";
}

/* ---------- Dáta ---------- */

/**
 * Služby s cenami z cenníka skinandface.sk.
 *
 * Slugy zodpovedajú adresám pôvodného webu (/sluzba/pery/ a pod.).
 *
 * @return array
 */
function sf_demo_services() {
	$branches = 'Stupava, Bratislava-Rača';
	$stupava  = 'Stupava';
	return array(
		array(
			'slug'    => 'dermatovenerologia',
			'title'   => 'Dermatovenerologické vyšetrenie',
			'cat'     => 'dermatologia',
			'price'   => '50 €',
			'scope'   => 'Deti aj dospelí',
			'branch'  => $branches,
			'excerpt' => 'Vyšetrenie a liečba kožných ochorení detí aj dospelých – od materských znamienok až po akné.',
			'short'   => 'Preventívne vyšetrenie kože na odhalenie alebo liečenie rôznych kožných problémov – od materských znamienok až po akné. Venujeme sa diagnostike a liečbe kožných ochorení všetkých vekových kategórií.',
			'content' => sf_b_p( 'Diagnostika a liečba kožných ochorení všetkých vekových kategórií v rodinnom a empatickom prostredí. Pri akné či rosacei nastavíme vhodnú liečbu aj každodennú starostlivosť o pleť.' )
				. sf_b_h2( 'Cena' )
				. sf_b_table(
					array(
						'Dermatovenerologické vyšetrenie (deti a dospelí)' => '50 €',
						'Online dermatologické vyšetrenie (deti a dospelí)' => '50 €',
						'Vyšetrenie + nastavenie terapie (akné, rosacea) a skinrutiny' => '50 €',
						'Vlasová poradňa'                => '60 €',
						'Laboratórne vyšetrenia'         => 'od 10 €',
						'Príplatok za urgentný termín'   => '10 €',
					)
				)
				. sf_b_p( 'Akútne termíny a kontroly, prosím, objednávajte telefonicky.' ),
		),
		array(
			'slug'    => 'vysetrenie-znamienok',
			'title'   => 'Vyšetrenie znamienok dermatoskopom',
			'cat'     => 'dermatologia',
			'price'   => '70 €',
			'scope'   => 'Celé telo',
			'branch'  => $branches,
			'excerpt' => 'Komplexné vyšetrenie znamienok celého tela dermatoskopom s konzultáciou a odporúčaním starostlivosti.',
			'short'   => 'Dermatoskopia slúži na diagnostické spresnenie nádorových ochorení kože a pozorovanie štruktúr kožných lézií, ktoré voľným okom nevidno. Pomáha včas rozpoznať podozrivé znamienka vrátane melanómu.',
			'content' => sf_b_h2( 'Pre koho je vyšetrenie vhodné' )
				. sf_b_list( array( 'máte veľa znamienok alebo sa vám objavilo nové,', 'znamienko mení tvar, farbu či veľkosť, svrbí alebo krváca,', 'v rodine sa vyskytol melanóm,', 'chcete si dať znamienka preventívne skontrolovať.' ) )
				. sf_b_h2( 'Ako vyšetrenie prebieha' )
				. sf_b_list( array( 'Lekárka si prezrie znamienka na celom tele dermatoskopom.', 'Vysvetlí vám nález a odpovie na otázky.', 'Odporučí vhodnú starostlivosť – sledovanie, kontrolu alebo odstránenie znamienka.' ), true )
				. sf_b_h2( 'Časté otázky' )
				. sf_b_details( 'Koľko stojí vyšetrenie znamienok?', 'Komplexné vyšetrenie znamienok celého tela dermatoskopom s konzultáciou a odporúčaniami stojí 70 €. Príplatok za urgentný termín je 10 €.' )
				. sf_b_details( 'Čo ak lekárka nájde podozrivé znamienko?', 'Znamienko odporučí odstrániť a poslať na histologické vyšetrenie. Chirurgické odstránenie znamienka do 10 mm stojí 90 €, histológia 40 €, kontrola s vybratím stehov je v cene zákroku.' )
				. sf_b_details( 'Robíte vyšetrenie znamienok aj pre firmy?', 'Áno, ponúkame vyšetrenie znamienok aj pre firmy. Napíšte nám na rezervacie@skinandface.sk.' ),
		),
		array(
			'slug'    => 'kryoterapia',
			'title'   => 'Kryoterapia tekutým dusíkom',
			'cat'     => 'dermatologia',
			'price'   => '15 € / útvar',
			'scope'   => '',
			'branch'  => $stupava,
			'excerpt' => 'Pôsobenie extrémne nízkych teplôt na terapiu rôznych kožných ochorení.',
			'short'   => 'Kryoterapia využíva pôsobenie extrémne nízkych teplôt tekutého dusíka na terapiu rôznych kožných ochorení, s liftingovým a regeneračným účinkom.',
			'content' => sf_b_h2( 'Cena' ) . sf_b_table( array( 'Kryoterapia tekutým dusíkom (1 útvar)' => '15 €' ) ),
		),
		array(
			'slug'    => 'odstranenie-koznych-utvarov',
			'title'   => 'Odstránenie kožných útvarov a znamienok',
			'cat'     => 'dermatologia',
			'price'   => 'od 20 €',
			'scope'   => '',
			'branch'  => $stupava,
			'excerpt' => 'Odstránenie kožných lézií, znamienok, verúk či cievok – vrátane chirurgickej excízie s histológiou.',
			'short'   => 'Odstránenie kožných lézií a ošetrenie nedokonalostí pleti – elektrokauterom alebo chirurgicky, s histologickým vyšetrením odstráneného znamienka.',
			'content' => sf_b_h2( 'Ošetrenia' )
				. sf_b_table(
					array(
						'Odstraňovanie kožných útvarov elektrokauterom (1 útvar)' => '20 €',
						'Odstraňovanie rozšírených cievok, angiómov' => '60 €',
						'Odstraňovanie seboroických verúk'           => '50 €',
						'Odstraňovanie molúsk'                       => '50 €',
						'Odstraňovanie kondylómov'                   => '70 €',
						'Korekcia jazvy (injekčná)'                  => '80 €',
						'Injekcia pred zákrokom / anestetický krém'   => 'v cene zákroku',
					)
				)
				. sf_b_h2( 'Chirurgické zákroky' )
				. sf_b_table(
					array(
						'Chirurgická excízia – znamienko na tele do 10 mm' => '90 €',
						'Každé ďalšie znamienko'                           => '40 €',
						'Histológia'                                       => '40 €',
						'Biopsia kože – odstránenie znamienka s histológiou' => '80 €',
						'Excízia – vlasová časť hlavy / na tele nad 10 mm'  => '120 €',
						'Excízia – tvár a dekolt'                          => '140 €',
						'Korekcia jazvy (chirurgicky)'                     => 'od 150 €',
						'Chirurgická kontrola s vybratím stehov'           => 'v cene zákroku',
					)
				),
		),
		array(
			'slug'    => 'venerologia',
			'title'   => 'Venerologické vyšetrenie',
			'cat'     => 'dermatologia',
			'price'   => '',
			'scope'   => '',
			'branch'  => $stupava,
			'excerpt' => 'Prevencia a liečba pohlavných ochorení.',
			'short'   => 'Prevencia a liečba pohlavných ochorení a komplexná starostlivosť o všetky infekčné ochorenia prenášané pohlavným stykom.',
			'content' => sf_b_p( 'Vyšetrenie prebieha diskrétne. Termín si dohodnete online alebo telefonicky.' ),
		),
		array(
			'slug'    => 'tvar',
			'title'   => 'Botulotoxín a omladenie tváre',
			'cat'     => 'estetika',
			'price'   => 'od 100 €',
			'scope'   => '',
			'branch'  => $stupava,
			'excerpt' => 'Mimické vrásky, V-shape, gummy smile, bunny lines či niťový lifting.',
			'short'   => 'Aplikácia botulotoxínu na mimické vrásky a modeláciu tváre podľa anatomických proporcií – s cieľom, aby bol výsledok prirodzený a na prvý pohľad neviditeľný.',
			'content' => sf_b_h2( 'Cena' )
				. sf_b_table(
					array(
						'Botulotoxín – 1 lokalita'          => '100 €',
						'Botulotoxín – 2 lokality'          => '170 €',
						'Botulotoxín – 3 lokality'          => '240 €',
						'V-shape (zúženie žuvacích svalov)' => '250 €',
						'Gummy smile'                       => '70 €',
						'Bunny lines'                       => '70 €',
						'DAO'                               => '50 €',
						'Lip lift'                          => '50 €',
						'Zúženie nosa + zdvihnutie špičky'  => '50 €',
						'Dopich – 1 jednotka'               => '1 €',
						'Niťový lifting (4 ks nite)'        => '300 €',
						'Doplnenie ďalšej nite (1 ks)'      => '30 €',
					)
				)
				. sf_b_p( 'Estetická konzultácia stojí 60 €. Ak zákrok absolvujete hneď, konzultáciu neplatíte.' ),
		),
		array(
			'slug'    => 'pery',
			'title'   => 'Zväčšenie pier',
			'cat'     => 'estetika',
			'price'   => 'od 250 €',
			'scope'   => '',
			'branch'  => $stupava,
			'excerpt' => 'Zväčšenie a modelácia pier kyselinou hyalurónovou s prirodzeným výsledkom.',
			'short'   => 'Zväčšenie a modelácia pier kyselinou hyalurónovou. Dbáme na prirodzený výsledok a proporcie tváre; venujeme sa aj korekcii nevydarených zákrokov.',
			'content' => sf_b_h2( 'Cena' )
				. sf_b_table(
					array(
						'Zväčšenie pier kyselinou hyalurónovou (0,5 – 0,8 ml)' => 'od 250 €',
						'Zväčšenie pier kyselinou hyalurónovou (1 ml)'         => 'od 300 €',
						'Hyaluronidáza – rozpustenie výplne na žiadosť pacienta' => '200 €',
					)
				),
		),
		array(
			'slug'    => 'oci-a-obocie',
			'title'   => 'Oči a obočie',
			'cat'     => 'estetika',
			'price'   => 'od 110 €',
			'scope'   => '',
			'branch'  => $stupava,
			'excerpt' => 'Kruhy pod očami, mezoterapia a omladenie očného okolia.',
			'short'   => 'Ošetrenie kruhov pod očami výplňou na báze kyseliny hyalurónovej, mezoterapia a polynukleotidy na omladenie očného okolia.',
			'content' => sf_b_h2( 'Cena' )
				. sf_b_table(
					array(
						'Výplň kruhov pod očami (kyselina hyalurónová)' => 'od 250 €',
						'Mezoterapia očného okolia'                   => '110 €',
						'Polynukleotidy Rejuran – očné okolie (1 ml)'   => '300 €',
					)
				),
		),
		array(
			'slug'    => 'lica',
			'title'   => 'Líca – objem lícnych kostí',
			'cat'     => 'estetika',
			'price'   => 'od 300 €',
			'scope'   => '',
			'branch'  => $stupava,
			'excerpt' => 'Dodanie objemu do oblasti lícnych kostí a biostimulácia.',
			'short'   => 'Dodanie objemu do oblasti lícnych kostí výplňou na báze kyseliny hyalurónovej alebo biostimulačnými prípravkami.',
			'content' => sf_b_h2( 'Cena' )
				. sf_b_table(
					array(
						'Dodanie objemu do oblasti lícnych kostí (1 ml)' => 'od 300 €',
						'Radiesse (1,5 ml)'                              => '370 €',
						'Sculptra – 1 ošetrenie'                         => '500 €',
						'Sculptra – 2 ošetrenia'                         => '650 €',
					)
				),
		),
		array(
			'slug'    => 'brada',
			'title'   => 'Sánka a brada',
			'cat'     => 'estetika',
			'price'   => 'od 250 €',
			'scope'   => '',
			'branch'  => $stupava,
			'excerpt' => 'Konturing sánky, korekcia brady a zúženie tváre (V-shape).',
			'short'   => 'Konturing sánky a korekcia brady výplňou na báze kyseliny hyalurónovej, zúženie tváre botulotoxínom (V-shape).',
			'content' => sf_b_h2( 'Cena' )
				. sf_b_table(
					array(
						'Konturing sánky (1 ml)'            => 'od 300 €',
						'Korekcia brady (1 ml)'             => 'od 300 €',
						'V-shape (zúženie žuvacích svalov)' => '250 €',
					)
				),
		),
		array(
			'slug'    => 'vlasy',
			'title'   => 'Vlasy',
			'cat'     => 'estetika',
			'price'   => 'od 60 €',
			'scope'   => '',
			'branch'  => $branches,
			'excerpt' => 'Vlasová poradňa, mezoterapia a plazmaterapia pri vypadávaní vlasov.',
			'short'   => 'Vlasová poradňa a terapie pri problémoch s vlasmi a pokožkou hlavy – mezoterapia a terapeutická plazmaterapia pri alopécii.',
			'content' => sf_b_h2( 'Cena' )
				. sf_b_table(
					array(
						'Vlasová poradňa'                                  => '60 €',
						'Mezoterapia Venome (tvár, vlasy, tuk pod bradou)' => '150 €',
						'Terapeutická plazmaterapia (akné, seborea, alopécie)' => '180 €',
					)
				),
		),
		array(
			'slug'    => 'podpazusie',
			'title'   => 'Nadmerné potenie',
			'cat'     => 'estetika',
			'price'   => 'od 300 €',
			'scope'   => '',
			'branch'  => $stupava,
			'excerpt' => 'Liečba nadmerného potenia dlaní, podpazušia a chodidiel.',
			'short'   => 'Terapia hyperhidrózy – nadmerného potenia dlaní, podpazušia a chodidiel – botulotoxínom, s individuálnym nastavením dávky.',
			'content' => sf_b_h2( 'Cena' )
				. sf_b_table(
					array(
						'Terapia hyperhidrózy (dlane, podpazušie, chodidlá)' => 'od 300 €',
						'Odstránenie nadmerného potenia botulotoxínom (individuálne)' => 'od 300 €',
					)
				),
		),
		array(
			'slug'    => 'mezoterapia',
			'title'   => 'Mezoterapia a biostimulácia pleti',
			'cat'     => 'estetika',
			'price'   => 'od 80 €',
			'scope'   => '',
			'branch'  => $stupava,
			'excerpt' => 'Mezoterapia, polynukleotidy, plazmaterapia a biostimulačné boostery.',
			'short'   => 'Nechirurgické omladenie a regenerácia pleti – mezoterapia, polynukleotidy, plazmaterapia a biostimulačné boostery.',
			'content' => sf_b_h2( 'Cena' )
				. sf_b_table(
					array(
						'Terapeutická mezoterapia'                       => 'od 80 €',
						'Mezoterapia Venome (tvár, vlasy, tuk pod bradou)' => '150 €',
						'Mezoterapia Neauvia hydro deluxe'               => '250 €',
						'Polynukleotidy Rejuran Healer (2 ml)'           => '350 €',
						'Polynukleotidy Vitaran (1 ml)'                  => '250 €',
						'Profhilo (2 ml) – 5-bodová bioremodelácia'      => '300 €',
						'Sisthaema Hevo+T (2 ml) – biostimulačný booster' => '350 €',
						'Plazmaterapia bez kyseliny hyalurónovej'         => '180 €',
						'Plazmaterapia s kyselinou hyalurónovou'          => '280 €',
					)
				),
		),
	);
}

/**
 * Celý cenník ako obsah stránky.
 *
 * @return string
 */
function sf_demo_pricelist() {
	$out = sf_b_p( 'Ceny sú uvedené vrátane anestézie (injekcia alebo anestetický krém je v cene zákroku). Akútne termíny a kontroly objednávajte telefonicky.' );

	$out .= sf_b_h2( 'Vyšetrenia a konzultácie' ) . sf_b_table(
		array(
			'Dermatovenerologické vyšetrenie (deti a dospelí)' => '50 €',
			'Príplatok za urgentný termín'                     => '10 €',
			'Online dermatologické vyšetrenie (deti a dospelí)' => '50 €',
			'Vyšetrenie + nastavenie terapie (akné, rosacea) a skinrutiny' => '50 €',
			'Komplexné vyšetrenie znamienok celého tela dermatoskopom + konzultácia' => '70 €',
			'Estetická konzultácia (pri okamžitom zákroku ju neplatíte)' => '60 €',
			'Vlasová poradňa'                                  => '60 €',
			'Laboratórne vyšetrenia'                           => 'od 10 €',
		)
	);
	$out .= sf_b_h2( 'Ošetrenia a zákroky' ) . sf_b_table(
		array(
			'Kryoterapia tekutým dusíkom (1 útvar)'                     => '15 €',
			'Odstraňovanie kožných útvarov elektrokauterom (1 útvar)'   => '20 €',
			'Odstraňovanie rozšírených cievok, angiómov'                => '60 €',
			'Odstraňovanie seboroických verúk'                          => '50 €',
			'Odstraňovanie molúsk'                                      => '50 €',
			'Odstraňovanie kondylómov'                                  => '70 €',
			'Terapeutická plazmaterapia (akné, seborea, alopécie)'      => '180 €',
			'Terapeutická mezoterapia'                                  => 'od 80 €',
			'Terapia hyperhidrózy (dlane, podpazušie, chodidlá)'        => 'od 300 €',
			'Korekcia jazvy (injekčná)'                                 => '80 €',
			'Intralezionálna aplikácia kortikosteroidu'                 => '80 €',
		)
	);
	$out .= sf_b_h2( 'Chirurgické zákroky' ) . sf_b_table(
		array(
			'Chirurgická excízia – znamienko na tele do 10 mm'  => '90 €',
			'Každé ďalšie znamienko'                            => '40 €',
			'Histológia'                                        => '40 €',
			'Biopsia kože – odstránenie znamienka s histológiou' => '80 €',
			'Excízia – vlasová časť hlavy / na tele nad 10 mm'   => '120 €',
			'Excízia – tvár a dekolt'                           => '140 €',
			'Korekcia jazvy (chirurgicky)'                      => 'od 150 €',
			'Chirurgická kontrola s vybratím stehov'            => 'v cene zákroku',
		)
	);
	$out .= sf_b_h2( 'Kyselina hyalurónová' ) . sf_b_table(
		array(
			'Stylage (0,8 ml)'                                  => '250 €',
			'Stylage / Neauvia (1 ml)'                          => '300 €',
			'Juvederm Ultra Smile (0,55 ml)'                    => '320 €',
			'Juvederm (1 ml)'                                   => '380 €',
			'Každý ďalší 1 ml'                                  => '50 % zo sumy 1 ml',
			'Zväčšenie pier (0,5 – 0,8 ml)'                     => 'od 250 €',
			'Zväčšenie pier (1 ml)'                             => 'od 300 €',
			'Výplň kruhov pod očami'                            => 'od 250 €',
			'Dodanie objemu do oblasti lícnych kostí (1 ml)'    => 'od 300 €',
			'Konturing sánky (1 ml)'                            => 'od 300 €',
			'Korekcia brady (1 ml)'                             => 'od 300 €',
			'Hyaluronidáza – rozpustenie výplne'                => '200 €',
		)
	);
	$out .= sf_b_h2( 'Botulotoxín' ) . sf_b_table(
		array(
			'1 lokalita'                                   => '100 €',
			'2 lokality'                                   => '170 €',
			'3 lokality'                                   => '240 €',
			'V-shape (zúženie žuvacích svalov)'            => '250 €',
			'Odstránenie nadmerného potenia (individuálne)' => 'od 300 €',
			'Gummy smile'                                  => '70 €',
			'Bunny lines'                                  => '70 €',
			'DAO'                                          => '50 €',
			'Lip lift'                                     => '50 €',
			'Zúženie nosa + zdvihnutie špičky'             => '50 €',
			'Dopich – 1 jednotka'                          => '1 €',
		)
	);
	$out .= sf_b_h2( 'Biostimulácia, mezoterapia a niťový lifting' ) . sf_b_table(
		array(
			'Niťový lifting (4 ks nite)'                     => '300 €',
			'Doplnenie ďalšej nite (1 ks)'                   => '30 €',
			'Mezoterapia Venome (tvár, vlasy, tuk pod bradou)' => '150 €',
			'Mezoterapia Neauvia hydro deluxe'               => '250 €',
			'Mezoterapia očného okolia'                      => '110 €',
			'Polynukleotidy Rejuran Healer (2 ml)'           => '350 €',
			'Polynukleotidy Rejuran – očné okolie (1 ml)'    => '300 €',
			'Polynukleotidy Vitaran (1 ml)'                  => '250 €',
			'Profhilo (2 ml) – 5-bodová bioremodelácia'      => '300 €',
			'Sisthaema Hevo+T (2 ml)'                        => '350 €',
			'Radiesse (1,5 ml)'                              => '370 €',
			'Plazmaterapia bez kyseliny hyalurónovej'         => '180 €',
			'Plazmaterapia s kyselinou hyalurónovou'          => '280 €',
			'Sculptra – 1 ošetrenie'                         => '500 €',
			'Sculptra – 2 ošetrenia'                         => '650 €',
		)
	);
	$out .= sf_b_p( '<strong>Storno poplatok:</strong> pri zrušení rezervovaného termínu menej ako 24 hodín vopred účtujeme 20 €, ktoré uhradíte pri najbližšej návšteve.' );
	return $out;
}

/**
 * Lekárky (iba zamestnankyne kliniky).
 *
 * @return array
 */
function sf_demo_doctors() {
	return array(
		array(
			'title'   => 'MUDr. Barbora Vargová',
			'role'    => 'Zakladateľka kliniky',
			'spec'    => 'Dermatovenerológia a estetická medicína',
			'booking' => 'https://www.navstevalekara.sk/lekari/kozny-lekar-dermatovenerolog-dermatolog-s11006/bratislavsky-kraj-k300/malacky-o505/stupava-m1035/mudr-barbora-javorek-vargova-d27949.html#order',
			'photo'   => 'mudr-barbora-vargova.webp',
			'content' => sf_b_p( 'Zakladateľkou našej kliniky je MUDr. Barbora Vargová, absolventka Lekárskej fakulty Univerzity Komenského v Bratislave v odbore všeobecné lekárstvo. Svoju odbornú prax začínala na detskej kožnej klinike NÚDCH, kde sa venovala liečbe detských kožných ochorení a špecializovala sa najmä na diagnostiku a terapiu hemangiómov.' )
				. sf_b_p( 'Súbežne s prácou v nemocnici pôsobila aj na viacerých klinikách estetickej medicíny. Neustále sa vzdeláva v dermatovenerológii, dermatochirurgii a estetickej medicíne a aktívne sa zúčastňuje domácich aj zahraničných školení a odborných stáží.' )
				. sf_b_p( 'V súčasnosti sa špecializuje predovšetkým na diagnostiku a liečbu kožných ochorení s dôrazom na včasné rozpoznanie a odstránenie malígnych melanómov.' ),
		),
		array(
			'title'   => 'MUDr. Lucia Michael',
			'role'    => 'Dermatovenerológia · estetická medicína',
			'spec'    => 'Dermatovenerológia a estetická medicína',
			'booking' => 'https://www.navstevalekara.sk/lekari/kozny-lekar-dermatovenerolog-dermatolog-s11006/bratislavsky-kraj-k300/malacky-o505/stupava-m1035/mudr-lucia-michael-d29057.html',
			'photo'   => 'mudr-lucia-michael.webp',
			'content' => sf_b_p( 'MUDr. Lucia Michael je atestovaná lekárka so špecializáciou v dermatovenerológii a zameraním na estetickú medicínu. Vo svojej praxi spája dermatologické znalosti s modernými technológiami omladenia pleti a každému klientovi ponúka individuálny prístup s dôrazom na prirodzený a harmonický výsledok.' )
				. sf_b_p( 'Lekárske štúdium absolvovala na LF UK v Bratislave (2012 – 2018), špecializačné štúdium ukončila atestáciou v roku 2023. Od roku 2018 pôsobila na oddelení korektívnej dermatológie, kde nadobudla bohaté skúsenosti s estetickými zákrokmi.' )
				. sf_b_p( 'Zameriava sa najmä na nechirurgické anti-aging ošetrenia vrátane aplikácie botulotoxínu, dermálnych výplní, mezoterapie, plazmaterapie, chemického peelingu, injekčnej lipolýzy a laserových či rádiofrekvenčných technológií.' ),
		),
	);
}

/**
 * Recenzie – z webu skinandface.sk a z NavstevaLekara.sk.
 *
 * @return array [meno, text, zdroj]
 */
function sf_demo_reviews() {
	return array(
		array( 'Zuzana', 'Z hľadiska ľudského prístupu je to veľmi milá pani doktorka, z hľadiska profesionálneho – pragmatická, rýchla, rozhodná. Zostávam pacientom aj do budúcnosti.', 'web' ),
		array( 'Simona', 'Veľmi pekne ďakujeme za úžasný, milý prístup pani doktorky a rýchle zhodnotenie zdravotného stavu dcérky. Som rada, že sme išli práve sem.', 'web' ),
		array( 'Martina', 'Ďakujem za výborný prístup, zodpovedanie všetkých otázok, rýchlu reakciu na danú situáciu, dodržanie času objednania. Odporúčam.', 'web' ),
		array( 'Andrea', 'Veľmi milá pani doktorka, poradí, vysvetlí. Dlho som sa nestretla s takým prístupom.', 'web' ),
		array( 'Ľubica', 'Pani doktorka je veľmi milá, ústretová, pomohla mi s problémom. Veľmi pekne ďakujem.', 'web' ),
		array( 'Tana', 'Príjemná pani doktorka, vyšetrenie načas, skvelý prístup.', 'web' ),
		array( 'Jana', 'Absolútne fantastický prístup. Boli sme prvýkrát s dcérou. Skvelá pani doktorka, termín objednania absolútne super, všetko klaplo. Ďakujeme.', 'web' ),
		array( 'Alžbeta', 'Pani doktorka je veľmi milá, ústretová, poradí, pomôže. Vrelo odporúčam.', 'web' ),
		array( 'Eva', 'Pani doktorka Vargová je veľmi profesionálna a milá. Všetko dôkladne vysvetlí.', 'nl' ),
		array( 'Filip', 'Veľmi milá pani doktorka. Všetko ochotne aj viackrát vysvetlila. Zodpovedala otázky.', 'nl' ),
		array( 'Mária', 'Pani doktorka je milá, ústretová a snažila sa vysvetliť možnosti odstránenia problému.', 'nl' ),
		array( 'Dana', 'Veľmi milá pani doktorka, max spokojnosť.', 'nl' ),
	);
}

/**
 * Časté otázky.
 *
 * @return array [otázka, odpoveď]
 */
function sf_demo_faq() {
	return array(
		array( 'Ako sa objednám k dermatológovi v Stupave alebo v Rači?', 'Plánované vyšetrenia si rezervujete online – vyberiete si lekárku a termín. Akútne termíny a kontroly objednávajte telefonicky na +421 910 903 300 alebo e-mailom na rezervacie@skinandface.sk.' ),
		array( 'Koľko stojí dermatologické vyšetrenie?', 'Dermatovenerologické vyšetrenie detí aj dospelých stojí 50 €, komplexné vyšetrenie znamienok celého tela dermatoskopom s konzultáciou 70 €. Príplatok za urgentný termín je 10 €.' ),
		array( 'Ošetrujete aj deti?', 'Áno. Venujeme sa diagnostike a liečbe kožných ochorení všetkých vekových kategórií – v rodinnom a empatickom prostredí. Ponúkame aj online dermatologické vyšetrenie pre deti a dospelých.' ),
		array( 'Opravujete aj nevydarené estetické zákroky z iných kliník?', 'Áno, venujeme sa aj korekcii nevydarených predchádzajúcich zákrokov. Postup vždy určíme po osobnej konzultácii.' ),
		array( 'Kedy otvárate pobočku v Bratislave-Rači?', 'Pobočku v Bratislave-Rači otvárame čoskoro. Na stránke pobočky nám môžete nechať kontakt a ozveme sa vám s termínom hneď po otvorení.' ),
		array( 'Čo ak nemôžem prísť na rezervovaný termín?', 'Termín, prosím, zrušte čo najskôr. Pri zrušení menej ako 24 hodín vopred účtujeme storno poplatok 20 €, ktorý uhradíte pri najbližšej návšteve.' ),
	);
}

/* ---------- Import ---------- */

/**
 * Nahrá obrázok z témy do knižnice médií.
 *
 * @param string $file   Súbor v assets/img.
 * @param int    $parent Rodičovský príspevok.
 * @return int ID prílohy alebo 0.
 */
function sf_demo_attach( $file, $parent = 0 ) {
	$path = SF_DIR . '/assets/img/' . $file;
	if ( ! file_exists( $path ) ) {
		return 0;
	}
	$upload = wp_upload_bits( $file, null, file_get_contents( $path ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
	if ( ! empty( $upload['error'] ) ) {
		return 0;
	}
	$type = wp_check_filetype( $upload['file'] );
	$id   = wp_insert_attachment(
		array(
			'post_mime_type' => $type['type'],
			'post_title'     => sanitize_file_name( pathinfo( $file, PATHINFO_FILENAME ) ),
			'post_status'    => 'inherit',
		),
		$upload['file'],
		$parent
	);
	if ( ! $id || is_wp_error( $id ) ) {
		return 0;
	}
	require_once ABSPATH . 'wp-admin/includes/image.php';
	wp_update_attachment_metadata( $id, wp_generate_attachment_metadata( $id, $upload['file'] ) );
	return (int) $id;
}

/**
 * Vytvorí stránku, ak ešte neexistuje (podľa slugu).
 *
 * @param string $slug     Slug.
 * @param string $title    Názov.
 * @param string $content  Obsah.
 * @param string $template Šablóna.
 * @param string $excerpt  Úryvok.
 * @return int
 */
function sf_demo_page( $slug, $title, $content = '', $template = '', $excerpt = '' ) {
	$existing = get_page_by_path( $slug );
	if ( $existing ) {
		return (int) $existing->ID;
	}
	$id = wp_insert_post(
		array(
			'post_type'    => 'page',
			'post_status'  => 'publish',
			'post_name'    => $slug,
			'post_title'   => $title,
			'post_content' => $content,
			'post_excerpt' => $excerpt,
		)
	);
	if ( $id && ! is_wp_error( $id ) && $template ) {
		update_post_meta( $id, '_wp_page_template', $template );
	}
	return is_wp_error( $id ) ? 0 : (int) $id;
}

/**
 * Hlavný import.
 */
function sf_demo_import() {
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	add_post_type_support( 'page', 'excerpt' );

	// Stránky.
	$home = sf_demo_page( 'domov', 'Domov' );
	sf_demo_page( 'cennik', 'Cenník', sf_demo_pricelist(), '', 'Cenník vyšetrení, ošetrení a zákrokov dermatovenerológie a estetickej medicíny.' );
	sf_demo_page(
		'o-nas',
		'O nás',
		sf_b_h2( 'Prečo sme vznikli?' )
		. sf_b_p( 'Túžba robiť medicínu inak, kde profesionalita a ľudskosť sú našimi hlavnými piliermi.' )
		. sf_b_p( 'V estetickej medicíne je pre nás dôležité, aby bol výsledok na prvý pohľad neviditeľný, pretože len vtedy je estetický zákrok vykonaný podľa daných anatomických proporcií. Venujeme sa aj korekcii nevydarených predchádzajúcich zákrokov.' )
		. sf_b_p( '<em>„Vnímanie korektívnej dermatológie by malo byť založené na prísnom dodržaní všetkých anatomických a estetických aspektov, aby bol konečný výsledok výkonu maximálne prirodzený.“</em> – MUDr. Barbora Vargová' ),
		'page-templates/o-nas.php',
		'Korektívna dermatológia s prirodzenými výsledkami.'
	);
	sf_demo_page( 'kontakt', 'Kontakt', '', 'page-templates/kontakt.php' );
	sf_demo_page( 'raca', 'Dermatológ a estetická medicína v Bratislave-Rači', '', 'page-templates/pobocka.php' );

	// Služby.
	if ( ! get_posts( array( 'post_type' => 'sf_sluzba', 'posts_per_page' => 1, 'post_status' => 'any' ) ) ) {
		foreach ( sf_demo_services() as $i => $s ) {
			$id = wp_insert_post(
				array(
					'post_type'    => 'sf_sluzba',
					'post_status'  => 'publish',
					'post_name'    => $s['slug'],
					'post_title'   => $s['title'],
					'post_content' => $s['content'],
					'post_excerpt' => $s['excerpt'],
					'menu_order'   => $i + 1,
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_sf_category', $s['cat'] );
				update_post_meta( $id, '_sf_price', $s['price'] );
				update_post_meta( $id, '_sf_scope', $s['scope'] );
				update_post_meta( $id, '_sf_branches', $s['branch'] );
				update_post_meta( $id, '_sf_short', $s['short'] );
			}
		}
	}

	// Lekárky.
	if ( ! get_posts( array( 'post_type' => 'sf_lekar', 'posts_per_page' => 1, 'post_status' => 'any' ) ) ) {
		foreach ( sf_demo_doctors() as $i => $d ) {
			$id = wp_insert_post(
				array(
					'post_type'    => 'sf_lekar',
					'post_status'  => 'publish',
					'post_title'   => $d['title'],
					'post_content' => $d['content'],
					'menu_order'   => $i + 1,
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_sf_role', $d['role'] );
				update_post_meta( $id, '_sf_specialty', $d['spec'] );
				update_post_meta( $id, '_sf_booking_url', $d['booking'] );
				$photo = sf_demo_attach( $d['photo'], $id );
				if ( $photo ) {
					set_post_thumbnail( $id, $photo );
					update_post_meta( $photo, '_wp_attachment_image_alt', $d['title'] );
				}
			}
		}
	}

	// Recenzie.
	if ( ! get_posts( array( 'post_type' => 'sf_recenzia', 'posts_per_page' => 1, 'post_status' => 'any' ) ) ) {
		foreach ( sf_demo_reviews() as $i => $r ) {
			$id = wp_insert_post(
				array(
					'post_type'    => 'sf_recenzia',
					'post_status'  => 'publish',
					'post_title'   => $r[0],
					'post_content' => $r[1],
					'menu_order'   => $i + 1,
				)
			);
			if ( $id && ! is_wp_error( $id ) ) {
				update_post_meta( $id, '_sf_source', $r[2] );
				update_post_meta( $id, '_sf_stars', '5' );
			}
		}
	}

	// Časté otázky.
	if ( ! get_posts( array( 'post_type' => 'sf_otazka', 'posts_per_page' => 1, 'post_status' => 'any' ) ) ) {
		foreach ( sf_demo_faq() as $i => $q ) {
			wp_insert_post(
				array(
					'post_type'    => 'sf_otazka',
					'post_status'  => 'publish',
					'post_title'   => $q[0],
					'post_content' => $q[1],
					'menu_order'   => $i + 1,
				)
			);
		}
	}

	// Úvodná stránka.
	if ( $home ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home );
	}

	// Pekné adresy (/cennik/ namiesto ?page_id=).
	if ( '' === get_option( 'permalink_structure' ) ) {
		update_option( 'permalink_structure', '/%postname%/' );
	}

	// Menu.
	if ( ! has_nav_menu( 'primary' ) ) {
		$menu_id = wp_create_nav_menu( 'Hlavné menu' );
		if ( ! is_wp_error( $menu_id ) ) {
			$items = array(
				array( 'Služby', get_post_type_archive_link( 'sf_sluzba' ) ),
				array( 'Cenník', sf_page_url( 'cennik' ) ),
				array( 'O nás', sf_page_url( 'o-nas' ) ),
				array( 'Pobočka Rača', sf_page_url( 'raca' ) ),
				array( 'Kontakt', sf_page_url( 'kontakt' ) ),
			);
			foreach ( $items as $pos => $item ) {
				wp_update_nav_menu_item(
					$menu_id,
					0,
					array(
						'menu-item-title'    => $item[0],
						'menu-item-url'      => $item[1],
						'menu-item-status'   => 'publish',
						'menu-item-type'     => 'custom',
						'menu-item-position' => $pos + 1,
					)
				);
			}
			$locations            = get_theme_mod( 'nav_menu_locations', array() );
			$locations['primary'] = $menu_id;
			set_theme_mod( 'nav_menu_locations', $locations );
		}
	}

	update_option( 'sf_demo_imported', SF_VERSION );
	flush_rewrite_rules();
}

/**
 * Po aktivácii témy.
 */
function sf_after_switch_theme() {
	sf_register_post_types();
	if ( ! get_option( 'sf_demo_imported' ) ) {
		sf_demo_import();
		set_transient( 'sf_demo_notice', 1, 300 );
	} else {
		flush_rewrite_rules();
	}
}
add_action( 'after_switch_theme', 'sf_after_switch_theme' );

/**
 * Oznámenie po importe.
 */
add_action(
	'admin_notices',
	function () {
		if ( ! get_transient( 'sf_demo_notice' ) ) {
			return;
		}
		delete_transient( 'sf_demo_notice' );
		printf(
			'<div class="notice notice-success is-dismissible"><p><strong>Skin &amp; Face:</strong> %s <a href="%s">%s</a></p></div>',
			esc_html__( 'Vytvorili sme stránky, služby s cenami, lekárky, recenzie, otázky a menu. Kontakty a pobočky upravíte v', 'skinandface' ),
			esc_url( admin_url( 'customize.php?autofocus[panel]=sf_panel' ) ),
			esc_html__( 'Prispôsobiť › Skin & Face', 'skinandface' )
		);
	}
);

/**
 * Nástroje › Skin & Face obsah – ručné spustenie importu (doplní len to, čo chýba).
 */
add_action(
	'admin_menu',
	function () {
		add_management_page(
			__( 'Skin & Face obsah', 'skinandface' ),
			__( 'Skin & Face obsah', 'skinandface' ),
			'manage_options',
			'sf-demo',
			function () {
				$done = false;
				if ( isset( $_POST['sf_demo_run'] ) && check_admin_referer( 'sf_demo_run' ) ) {
					sf_demo_import();
					$done = true;
				}
				echo '<div class="wrap"><h1>' . esc_html__( 'Skin & Face – úvodný obsah', 'skinandface' ) . '</h1>';
				if ( $done ) {
					echo '<div class="notice notice-success"><p>' . esc_html__( 'Hotovo. Chýbajúci obsah bol doplnený.', 'skinandface' ) . '</p></div>';
				}
				echo '<p>' . esc_html__( 'Doplní stránky, služby, lekárky, recenzie, otázky a menu. Existujúci obsah neprepíše – ak typ obsahu už má položky, preskočí ho.', 'skinandface' ) . '</p>';
				echo '<form method="post">';
				wp_nonce_field( 'sf_demo_run' );
				submit_button( __( 'Doplniť obsah', 'skinandface' ), 'primary', 'sf_demo_run' );
				echo '</form></div>';
			}
		);
	}
);
