<?php
/**
 * Štruktúrované údaje (JSON-LD) pre Google a AI vyhľadávače.
 *
 * Klinika + pobočky + lekári na úvodnej stránke, FAQ, služby s cenou.
 * Hodnotenie (AggregateRating) zámerne nevkladáme – Google ho pri vlastných
 * recenziách na webe firmy nezobrazuje a môže ho považovať za manipuláciu.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

/**
 * Výpis JSON-LD.
 *
 * @param array $data Dáta.
 */
function sf_print_jsonld( $data ) {
	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}

/**
 * Údaje o pobočke.
 *
 * @param string $branch stupava|raca.
 * @return array|null
 */
function sf_schema_branch( $branch ) {
	$is_raca = ( 'raca' === $branch );
	$name    = 'Skin & Face – ' . ( $is_raca ? 'Bratislava-Rača' : 'Stupava' );
	$node    = array(
		'@type'             => array( 'MedicalClinic', 'MedicalBusiness' ),
		'@id'               => home_url( '/#pobocka-' . $branch ),
		'name'              => $name,
		'url'               => $is_raca ? sf_raca_url() : home_url( '/' ),
		'telephone'         => sf_opt( 'phone' ),
		'email'             => sf_opt( 'email' ),
		'medicalSpecialty'  => 'Dermatology',
		'parentOrganization' => array( '@id' => home_url( '/#klinika' ) ),
	);
	if ( sf_opt( $branch . '_street' ) ) {
		$node['address'] = array(
			'@type'           => 'PostalAddress',
			'streetAddress'   => sf_opt( $branch . '_street' ),
			'postalCode'      => sf_opt( $branch . '_zip' ),
			'addressLocality' => sf_opt( $branch . '_city' ),
			'addressCountry'  => 'SK',
		);
	} elseif ( $is_raca ) {
		$node['areaServed'] = 'Bratislava-Rača';
	}
	if ( ! $is_raca && sf_opt( 'stupava_lat' ) ) {
		$node['geo'] = array(
			'@type'     => 'GeoCoordinates',
			'latitude'  => (float) sf_opt( 'stupava_lat' ),
			'longitude' => (float) sf_opt( 'stupava_lng' ),
		);
	}
	$map = sf_opt( $branch . '_map_url' );
	if ( $map ) {
		$node['hasMap'] = $map;
	}
	return $node;
}

/**
 * Schéma pre jednotlivé stránky.
 */
function sf_schema() {
	if ( ! sf_opt( 'schema_enabled' ) ) {
		return;
	}

	$logo   = SF_URI . '/assets/img/site-icon-512.png';
	$same   = array_values( array_filter( array( sf_opt( 'instagram' ), sf_opt( 'facebook' ), sf_opt( 'google_url' ) ) ) );
	$clinic = array(
		'@type'            => array( 'MedicalOrganization' ),
		'@id'              => home_url( '/#klinika' ),
		'name'             => 'Skin & Face Dermaesthetic',
		'alternateName'    => 'Skin and Face – Klinika dermatovenerológie a estetickej medicíny',
		'url'              => home_url( '/' ),
		'logo'             => $logo,
		'telephone'        => sf_opt( 'phone' ),
		'email'            => sf_opt( 'email' ),
		'medicalSpecialty' => array( 'Dermatology' ),
		'sameAs'           => $same,
		'department'       => array( array( '@id' => home_url( '/#pobocka-stupava' ) ), array( '@id' => home_url( '/#pobocka-raca' ) ) ),
	);

	if ( is_front_page() || is_page_template( 'page-templates/kontakt.php' ) || is_page_template( 'page-templates/o-nas.php' ) ) {
		$graph = array( $clinic, sf_schema_branch( 'stupava' ), sf_schema_branch( 'raca' ) );

		foreach ( get_posts( array( 'post_type' => 'sf_lekar', 'posts_per_page' => 10, 'orderby' => 'menu_order', 'order' => 'ASC' ) ) as $doc ) {
			$person = array(
				'@type'    => 'Physician',
				'name'     => get_the_title( $doc ),
				'worksFor' => array( '@id' => home_url( '/#klinika' ) ),
			);
			$spec = get_post_meta( $doc->ID, '_sf_specialty', true );
			if ( $spec ) {
				$person['description'] = $spec;
			}
			if ( has_post_thumbnail( $doc ) ) {
				$person['image'] = get_the_post_thumbnail_url( $doc, 'sf-portrait' );
			}
			$graph[] = $person;
		}

		if ( is_front_page() ) {
			$faq = array();
			foreach ( get_posts( array( 'post_type' => 'sf_otazka', 'posts_per_page' => 20, 'orderby' => 'menu_order', 'order' => 'ASC' ) ) as $q ) {
				$faq[] = array(
					'@type'          => 'Question',
					'name'           => get_the_title( $q ),
					'acceptedAnswer' => array( '@type' => 'Answer', 'text' => wp_strip_all_tags( $q->post_content ) ),
				);
			}
			if ( $faq ) {
				$graph[] = array( '@type' => 'FAQPage', 'mainEntity' => $faq );
			}
		}

		sf_print_jsonld( array( '@context' => 'https://schema.org', '@graph' => $graph ) );
		return;
	}

	if ( is_page_template( 'page-templates/pobocka.php' ) ) {
		sf_print_jsonld( array( '@context' => 'https://schema.org', '@graph' => array( $clinic, sf_schema_branch( 'raca' ) ) ) );
		return;
	}

	if ( is_singular( 'sf_sluzba' ) ) {
		$id      = get_queried_object_id();
		$service = array(
			'@context'    => 'https://schema.org',
			'@type'       => 'MedicalProcedure',
			'name'        => get_the_title( $id ),
			'url'         => get_permalink( $id ),
			'description' => get_post_meta( $id, '_sf_short', true ) ? get_post_meta( $id, '_sf_short', true ) : get_the_excerpt( $id ),
			'provider'    => $clinic,
		);
		$price = sf_service_price( $id );
		if ( preg_match( '/([0-9]+(?:[,.][0-9]+)?)/', $price, $m ) ) {
			$service['offers'] = array(
				'@type'         => 'Offer',
				'price'         => str_replace( ',', '.', $m[1] ),
				'priceCurrency' => 'EUR',
				'description'   => $price,
			);
		}
		sf_print_jsonld( $service );
	}
}
add_action( 'wp_head', 'sf_schema', 20 );

/**
 * Meta popis, ak nie je nainštalovaný SEO plugin.
 */
function sf_meta_description() {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) || defined( 'SEOPRESS_VERSION' ) ) {
		return;
	}
	$desc = '';
	if ( is_front_page() ) {
		$desc = 'Dermatológ a estetická medicína v Stupave a v Bratislave-Rači. Vyšetrenie znamienok dermatoskopom, liečba kožných ochorení, odstránenie kožných útvarov a estetické ošetrenia s prirodzeným výsledkom.';
	} elseif ( is_singular() ) {
		$id   = get_queried_object_id();
		$desc = get_post_meta( $id, '_sf_short', true );
		if ( ! $desc && has_excerpt( $id ) ) {
			$desc = get_the_excerpt( $id );
		}
	}
	if ( $desc ) {
		printf( '<meta name="description" content="%s">' . "\n", esc_attr( wp_trim_words( $desc, 30, '…' ) ) );
	}
}
add_action( 'wp_head', 'sf_meta_description', 2 );
