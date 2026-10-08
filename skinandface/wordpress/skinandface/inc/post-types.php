<?php
/**
 * Vlastné typy obsahu: služby, lekári, recenzie, časté otázky, dopyty.
 *
 * Služby majú adresu /sluzba/nazov/ – rovnakú ako na pôvodnom webe,
 * takže staré odkazy v Googli fungujú ďalej.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registrácia typov obsahu.
 */
function sf_register_post_types() {
	register_post_type(
		'sf_sluzba',
		array(
			'labels'        => array(
				'name'          => __( 'Služby', 'skinandface' ),
				'singular_name' => __( 'Služba', 'skinandface' ),
				'add_new_item'  => __( 'Pridať službu', 'skinandface' ),
				'edit_item'     => __( 'Upraviť službu', 'skinandface' ),
				'all_items'     => __( 'Všetky služby', 'skinandface' ),
			),
			'public'        => true,
			'has_archive'   => 'sluzba',
			'rewrite'       => array( 'slug' => 'sluzba', 'with_front' => false ),
			'menu_icon'     => 'dashicons-heart',
			'menu_position' => 20,
			'show_in_rest'  => true,
			'supports'      => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', 'revisions' ),
		)
	);

	register_post_type(
		'sf_lekar',
		array(
			'labels'        => array(
				'name'          => __( 'Lekári', 'skinandface' ),
				'singular_name' => __( 'Lekár', 'skinandface' ),
				'add_new_item'  => __( 'Pridať lekára', 'skinandface' ),
				'edit_item'     => __( 'Upraviť lekára', 'skinandface' ),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_rest'        => true,
			'exclude_from_search' => true,
			'menu_icon'           => 'dashicons-groups',
			'menu_position'       => 21,
			'supports'            => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
		)
	);

	register_post_type(
		'sf_recenzia',
		array(
			'labels'              => array(
				'name'          => __( 'Recenzie', 'skinandface' ),
				'singular_name' => __( 'Recenzia', 'skinandface' ),
				'add_new_item'  => __( 'Pridať recenziu', 'skinandface' ),
				'edit_item'     => __( 'Upraviť recenziu', 'skinandface' ),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_rest'        => true,
			'exclude_from_search' => true,
			'menu_icon'           => 'dashicons-star-filled',
			'menu_position'       => 22,
			'supports'            => array( 'title', 'editor', 'page-attributes' ),
		)
	);

	register_post_type(
		'sf_otazka',
		array(
			'labels'              => array(
				'name'          => __( 'Časté otázky', 'skinandface' ),
				'singular_name' => __( 'Otázka', 'skinandface' ),
				'add_new_item'  => __( 'Pridať otázku', 'skinandface' ),
				'edit_item'     => __( 'Upraviť otázku', 'skinandface' ),
			),
			'public'              => false,
			'show_ui'             => true,
			'show_in_rest'        => true,
			'exclude_from_search' => true,
			'menu_icon'           => 'dashicons-editor-help',
			'menu_position'       => 23,
			'supports'            => array( 'title', 'editor', 'page-attributes' ),
		)
	);

	register_post_type(
		'sf_dopyt',
		array(
			'labels'          => array(
				'name'          => __( 'Dopyty z webu', 'skinandface' ),
				'singular_name' => __( 'Dopyt', 'skinandface' ),
				'edit_item'     => __( 'Dopyt', 'skinandface' ),
			),
			'public'          => false,
			'show_ui'         => true,
			'show_in_rest'    => false,
			'menu_icon'       => 'dashicons-email-alt',
			'menu_position'   => 24,
			'supports'        => array( 'title' ),
			'capability_type' => 'post',
			'capabilities'    => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap'    => true,
		)
	);
}
add_action( 'init', 'sf_register_post_types' );
add_action(
	'init',
	function () {
		add_post_type_support( 'page', 'excerpt' );
	}
);

/**
 * Stĺpce v zozname dopytov.
 */
add_filter(
	'manage_sf_dopyt_posts_columns',
	function ( $cols ) {
		return array(
			'cb'          => $cols['cb'],
			'title'       => __( 'Meno', 'skinandface' ),
			'sf_phone'    => __( 'Telefón', 'skinandface' ),
			'sf_branch'   => __( 'Pobočka', 'skinandface' ),
			'sf_service'  => __( 'Záujem', 'skinandface' ),
			'date'        => __( 'Dátum', 'skinandface' ),
		);
	}
);
add_action(
	'manage_sf_dopyt_posts_custom_column',
	function ( $col, $post_id ) {
		$map = array(
			'sf_phone'   => '_sf_phone',
			'sf_branch'  => '_sf_branch',
			'sf_service' => '_sf_service',
		);
		if ( isset( $map[ $col ] ) ) {
			echo esc_html( get_post_meta( $post_id, $map[ $col ], true ) );
		}
	},
	10,
	2
);

/**
 * Stĺpec s cenou a kategóriou v zozname služieb.
 */
add_filter(
	'manage_sf_sluzba_posts_columns',
	function ( $cols ) {
		$new = array();
		foreach ( $cols as $k => $v ) {
			$new[ $k ] = $v;
			if ( 'title' === $k ) {
				$new['sf_cat']   = __( 'Kategória', 'skinandface' );
				$new['sf_price'] = __( 'Cena', 'skinandface' );
			}
		}
		return $new;
	}
);
add_action(
	'manage_sf_sluzba_posts_custom_column',
	function ( $col, $post_id ) {
		if ( 'sf_price' === $col ) {
			echo esc_html( sf_service_price( $post_id ) );
		} elseif ( 'sf_cat' === $col ) {
			$cat = get_post_meta( $post_id, '_sf_category', true );
			echo esc_html( 'estetika' === $cat ? __( 'Estetická medicína', 'skinandface' ) : __( 'Dermatovenerológia', 'skinandface' ) );
		}
	},
	10,
	2
);
