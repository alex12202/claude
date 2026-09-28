<?php
/**
 * Vzhľad → Prispôsobiť: kontakty a úvodný slider.
 */

defined( 'ABSPATH' ) || exit;

add_action( 'customize_register', function ( WP_Customize_Manager $wp ) {
	$wp->add_panel( 'ck_panel', array(
		'title'    => 'Čistímeklimy',
		'priority' => 25,
	) );

	// Kontakty.
	$wp->add_section( 'ck_contact', array( 'title' => 'Kontakty', 'panel' => 'ck_panel' ) );
	$fields = array(
		'phone'     => array( 'Telefón', 'text', 'sanitize_text_field' ),
		'email'     => array( 'E-mail (zobrazí sa na webe)', 'email', 'sanitize_email' ),
		'order_to'  => array( 'Objednávky posielať na e-mail (prázdne = e-mail vyššie)', 'email', 'sanitize_email' ),
		'hours'     => array( 'Otváracie hodiny', 'text', 'sanitize_text_field' ),
		'area'      => array( 'Oblasť pôsobenia', 'text', 'sanitize_text_field' ),
		'facebook'  => array( 'Facebook (odkaz)', 'url', 'esc_url_raw' ),
		'instagram' => array( 'Instagram (odkaz)', 'url', 'esc_url_raw' ),
	);
	$defaults = ck_defaults();
	foreach ( $fields as $key => $f ) {
		$wp->add_setting( 'ck_' . $key, array(
			'default'           => $defaults[ $key ],
			'sanitize_callback' => $f[2],
		) );
		$wp->add_control( 'ck_' . $key, array(
			'label'   => $f[0],
			'section' => 'ck_contact',
			'type'    => $f[1],
		) );
	}

	// Úvodný slider.
	$wp->add_section( 'ck_slider', array(
		'title'       => 'Úvodný slider',
		'panel'       => 'ck_panel',
		'description' => 'Fotky na šírku, ideálne 1920 × 1080 px. V nadpise zvýraznite slová modrou pomocou &lt;em&gt;…&lt;/em&gt;. Snímku skryjete vymazaním nadpisu aj fotky.',
	) );
	$slide_defaults = array(
		1 => array( 'Dýchajte doma <em>čistý vzduch</em>, nie prach a plesne', 'Čistý vzduch pre celú domácnosť' ),
		2 => array( 'Rozoberieme, vyčistíme a <em>vydezinfikujeme</em>', 'Hĺbkové čistenie priamo u vás doma' ),
		3 => array( 'Cítite ten rozdiel? <em>Svieži vzduch</em> bez zápachu', 'Svieži vzduch hneď po prvom zapnutí' ),
		4 => array( 'Nižšia spotreba, <em>tichší chod</em>, dlhšia životnosť', 'Vyčistená klimatizácia chladí rýchlejšie' ),
	);
	foreach ( $slide_defaults as $n => $d ) {
		$wp->add_setting( "ck_slide{$n}_image", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
		$wp->add_control( new WP_Customize_Image_Control( $wp, "ck_slide{$n}_image", array(
			'label'       => "Snímka {$n} – fotka",
			'description' => 'Prázdne = predvolená fotka témy.',
			'section'     => 'ck_slider',
		) ) );
		$wp->add_setting( "ck_slide{$n}_title", array( 'default' => $d[0], 'sanitize_callback' => 'ck_kses_title' ) );
		$wp->add_control( "ck_slide{$n}_title", array(
			'label'   => "Snímka {$n} – nadpis",
			'section' => 'ck_slider',
			'type'    => 'text',
		) );
		$wp->add_setting( "ck_slide{$n}_caption", array( 'default' => $d[1], 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp->add_control( "ck_slide{$n}_caption", array(
			'label'   => "Snímka {$n} – popis",
			'section' => 'ck_slider',
			'type'    => 'text',
		) );
	}
} );
