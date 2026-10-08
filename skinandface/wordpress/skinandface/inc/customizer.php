<?php
/**
 * Nastavenia v Prispôsobiť › Skin & Face.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registrácia nastavení.
 *
 * @param WP_Customize_Manager $wp_customize Customizer.
 */
function sf_customize_register( $wp_customize ) {
	$d = sf_defaults();

	$wp_customize->add_panel(
		'sf_panel',
		array(
			'title'    => __( 'Skin & Face', 'skinandface' ),
			'priority' => 30,
		)
	);

	$sections = array(
		'sf_contact' => __( 'Kontakt a odkazy', 'skinandface' ),
		'sf_stupava' => __( 'Pobočka Stupava', 'skinandface' ),
		'sf_raca'    => __( 'Pobočka Rača', 'skinandface' ),
		'sf_hero'    => __( 'Úvod a slider', 'skinandface' ),
		'sf_reviews' => __( 'Recenzie a hodnotenie', 'skinandface' ),
		'sf_tech'    => __( 'Technické', 'skinandface' ),
	);
	foreach ( $sections as $id => $title ) {
		$wp_customize->add_section( $id, array( 'title' => $title, 'panel' => 'sf_panel' ) );
	}

	$fields = array(
		// Kontakt.
		array( 'phone', 'sf_contact', __( 'Telefón', 'skinandface' ), 'text' ),
		array( 'email', 'sf_contact', __( 'E-mail (sem chodia aj dopyty z formulára)', 'skinandface' ), 'email' ),
		array( 'booking_url', 'sf_contact', __( 'Hlavný odkaz na online rezerváciu', 'skinandface' ), 'url' ),
		array( 'urgent_note', 'sf_contact', __( 'Text v hornej lište', 'skinandface' ), 'text' ),
		array( 'instagram', 'sf_contact', __( 'Instagram', 'skinandface' ), 'url' ),
		array( 'facebook', 'sf_contact', __( 'Facebook', 'skinandface' ), 'url' ),
		array( 'company', 'sf_contact', __( 'Obchodné meno (do pätičky)', 'skinandface' ), 'text' ),
		array( 'ico', 'sf_contact', __( 'IČO (do pätičky)', 'skinandface' ), 'text' ),

		// Stupava.
		array( 'stupava_street', 'sf_stupava', __( 'Ulica a číslo', 'skinandface' ), 'text' ),
		array( 'stupava_zip', 'sf_stupava', __( 'PSČ', 'skinandface' ), 'text' ),
		array( 'stupava_city', 'sf_stupava', __( 'Mesto', 'skinandface' ), 'text' ),
		array( 'stupava_hours', 'sf_stupava', __( 'Ordinačné hodiny', 'skinandface' ), 'textarea' ),
		array( 'stupava_services', 'sf_stupava', __( 'Krátky popis služieb pobočky', 'skinandface' ), 'textarea' ),
		array( 'stupava_map_url', 'sf_stupava', __( 'Odkaz na Google Maps', 'skinandface' ), 'url' ),
		array( 'stupava_lat', 'sf_stupava', __( 'GPS – zemepisná šírka', 'skinandface' ), 'text' ),
		array( 'stupava_lng', 'sf_stupava', __( 'GPS – zemepisná dĺžka', 'skinandface' ), 'text' ),

		// Rača.
		array( 'raca_open', 'sf_raca', __( 'Pobočka je už otvorená', 'skinandface' ), 'checkbox' ),
		array( 'raca_badge', 'sf_raca', __( 'Štítok pred otvorením (napr. „Otvárame 1. 12.“)', 'skinandface' ), 'text' ),
		array( 'raca_street', 'sf_raca', __( 'Ulica a číslo', 'skinandface' ), 'text' ),
		array( 'raca_zip', 'sf_raca', __( 'PSČ', 'skinandface' ), 'text' ),
		array( 'raca_city', 'sf_raca', __( 'Mesto / mestská časť', 'skinandface' ), 'text' ),
		array( 'raca_hours', 'sf_raca', __( 'Ordinačné hodiny', 'skinandface' ), 'textarea' ),
		array( 'raca_services', 'sf_raca', __( 'Krátky popis služieb pobočky', 'skinandface' ), 'textarea' ),
		array( 'raca_map_url', 'sf_raca', __( 'Odkaz na Google Maps (po založení profilu)', 'skinandface' ), 'url' ),
		array( 'raca_booking_url', 'sf_raca', __( 'Odkaz na online rezerváciu pre Raču', 'skinandface' ), 'url' ),

		// Úvod.
		array( 'hero_h1', 'sf_hero', __( 'Hlavný nadpis stránky (H1 – dôležitý pre Google)', 'skinandface' ), 'text' ),
		array( 'hero_h1_em', 'sf_hero', __( 'Zvýraznené pokračovanie nadpisu', 'skinandface' ), 'text' ),
		array( 'hero_intro', 'sf_hero', __( 'Úvodný text pod nadpisom', 'skinandface' ), 'textarea' ),
		array( 'hero_autoplay', 'sf_hero', __( 'Slider sa prepína automaticky', 'skinandface' ), 'checkbox' ),

		// Recenzie.
		array( 'google_rating', 'sf_reviews', __( 'Hodnotenie na Google (napr. 4,7)', 'skinandface' ), 'text' ),
		array( 'google_url', 'sf_reviews', __( 'Odkaz na Google profil', 'skinandface' ), 'url' ),
		array( 'nl_url', 'sf_reviews', __( 'Odkaz na NavstevaLekara.sk', 'skinandface' ), 'url' ),
		array( 'reviews_count', 'sf_reviews', __( 'Počet recenzií na úvodnej stránke (ideálne 4 alebo 8)', 'skinandface' ), 'number' ),

		// Technické.
		array( 'schema_enabled', 'sf_tech', __( 'Štruktúrované údaje pre Google a AI (vypnúť len ak ich rieši SEO plugin)', 'skinandface' ), 'checkbox' ),
	);

	foreach ( $fields as $f ) {
		list( $key, $section, $label, $type ) = $f;
		$sanitize = 'sanitize_text_field';
		if ( 'url' === $type ) {
			$sanitize = 'esc_url_raw';
		} elseif ( 'email' === $type ) {
			$sanitize = 'sanitize_email';
		} elseif ( 'textarea' === $type ) {
			$sanitize = 'sanitize_textarea_field';
		} elseif ( 'checkbox' === $type ) {
			$sanitize = 'sf_sanitize_checkbox';
		} elseif ( 'number' === $type ) {
			$sanitize = 'absint';
		}
		$wp_customize->add_setting(
			'sf_' . $key,
			array(
				'default'           => $d[ $key ],
				'sanitize_callback' => $sanitize,
			)
		);
		$wp_customize->add_control(
			'sf_' . $key,
			array(
				'label'   => $label,
				'section' => $section,
				'type'    => $type,
			)
		);
	}

	// Snímky slidera.
	foreach ( sf_slide_defaults() as $i => $slide ) {
		$n      = $i + 1;
		$labels = array(
			'label' => sprintf( __( 'Snímka %d – názov v spodnom páse (prázdne = skryť)', 'skinandface' ), $n ),
			'l1'    => __( 'Stupava – nadpis', 'skinandface' ),
			'l2'    => __( 'Stupava – zvýraznená časť', 'skinandface' ),
			'r1'    => __( 'Rača – nadpis', 'skinandface' ),
			'r2'    => __( 'Rača – zvýraznená časť', 'skinandface' ),
		);
		foreach ( $labels as $k => $label ) {
			$wp_customize->add_setting( "sf_slide{$n}_{$k}", array( 'default' => $slide[ $k ], 'sanitize_callback' => 'sanitize_text_field' ) );
			$wp_customize->add_control( "sf_slide{$n}_{$k}", array( 'label' => $label, 'section' => 'sf_hero', 'type' => 'text' ) );
		}
		foreach ( array( 'limg' => __( 'Stupava – fotka', 'skinandface' ), 'rimg' => __( 'Rača – fotka', 'skinandface' ) ) as $k => $label ) {
			$wp_customize->add_setting( "sf_slide{$n}_{$k}", array( 'default' => $slide[ $k ], 'sanitize_callback' => 'esc_url_raw' ) );
			$wp_customize->add_control(
				new WP_Customize_Image_Control(
					$wp_customize,
					"sf_slide{$n}_{$k}",
					array(
						'label'   => sprintf( '%s (%d)', $label, $n ),
						'section' => 'sf_hero',
					)
				)
			);
		}
	}
}
add_action( 'customize_register', 'sf_customize_register' );

/**
 * Sanitizácia zaškrtávacieho poľa.
 *
 * @param mixed $value Hodnota.
 * @return bool
 */
function sf_sanitize_checkbox( $value ) {
	return (bool) $value;
}
