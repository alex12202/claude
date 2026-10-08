<?php
/**
 * Doplnkové polia: cena a kategória služby, rola lekára, zdroj recenzie.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

/**
 * Definícia polí podľa typu obsahu.
 *
 * @return array
 */
function sf_meta_fields() {
	return array(
		'sf_sluzba'   => array(
			'title'  => __( 'Údaje služby', 'skinandface' ),
			'fields' => array(
				'_sf_category' => array(
					'label'   => __( 'Kategória', 'skinandface' ),
					'type'    => 'select',
					'options' => array(
						'dermatologia' => __( 'Dermatovenerológia', 'skinandface' ),
						'estetika'     => __( 'Estetická medicína', 'skinandface' ),
					),
				),
				'_sf_price'    => array(
					'label' => __( 'Cena (napr. „70 €“ alebo „od 250 €“)', 'skinandface' ),
					'type'  => 'text',
				),
				'_sf_scope'    => array(
					'label' => __( 'Rozsah / trvanie (voliteľné, napr. „Celé telo“)', 'skinandface' ),
					'type'  => 'text',
				),
				'_sf_branches' => array(
					'label' => __( 'Pobočky (napr. „Stupava, Rača“)', 'skinandface' ),
					'type'  => 'text',
				),
				'_sf_short'    => array(
					'label' => __( '„V skratke“ – 2 až 3 vety, ktoré citujú Google aj AI vyhľadávače', 'skinandface' ),
					'type'  => 'textarea',
				),
			),
		),
		'sf_lekar'    => array(
			'title'  => __( 'Údaje lekára', 'skinandface' ),
			'fields' => array(
				'_sf_role'        => array(
					'label' => __( 'Rola (napr. „Zakladateľka kliniky“)', 'skinandface' ),
					'type'  => 'text',
				),
				'_sf_specialty'   => array(
					'label' => __( 'Odbornosť (napr. „Dermatovenerológia“)', 'skinandface' ),
					'type'  => 'text',
				),
				'_sf_booking_url' => array(
					'label' => __( 'Odkaz na online rezerváciu', 'skinandface' ),
					'type'  => 'url',
				),
			),
		),
		'sf_recenzia' => array(
			'title'  => __( 'Údaje recenzie', 'skinandface' ),
			'fields' => array(
				'_sf_source' => array(
					'label'   => __( 'Zdroj', 'skinandface' ),
					'type'    => 'select',
					'options' => array(
						'web'    => __( 'Web skinandface.sk', 'skinandface' ),
						'google' => __( 'Google', 'skinandface' ),
						'nl'     => __( 'NavstevaLekara.sk', 'skinandface' ),
					),
				),
				'_sf_stars'  => array(
					'label'   => __( 'Hviezdičky', 'skinandface' ),
					'type'    => 'select',
					'options' => array(
						'5' => '5',
						'4' => '4',
					),
				),
			),
		),
	);
}

/**
 * Pridanie boxov.
 */
function sf_add_meta_boxes() {
	foreach ( sf_meta_fields() as $type => $box ) {
		add_meta_box( 'sf_meta_' . $type, $box['title'], 'sf_render_meta_box', $type, 'normal', 'high', $box['fields'] );
	}
}
add_action( 'add_meta_boxes', 'sf_add_meta_boxes' );

/**
 * Vykreslenie boxu.
 *
 * @param WP_Post $post Príspevok.
 * @param array   $box  Box.
 */
function sf_render_meta_box( $post, $box ) {
	wp_nonce_field( 'sf_meta_save', 'sf_meta_nonce' );
	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( $box['args'] as $key => $field ) {
		$value = get_post_meta( $post->ID, $key, true );
		$id    = esc_attr( ltrim( $key, '_' ) );
		echo '<tr><th scope="row"><label for="' . $id . '">' . esc_html( $field['label'] ) . '</label></th><td>';
		if ( 'select' === $field['type'] ) {
			echo '<select id="' . $id . '" name="' . esc_attr( $key ) . '">';
			foreach ( $field['options'] as $opt => $label ) {
				printf( '<option value="%s"%s>%s</option>', esc_attr( $opt ), selected( $value, $opt, false ), esc_html( $label ) );
			}
			echo '</select>';
		} elseif ( 'textarea' === $field['type'] ) {
			printf( '<textarea id="%s" name="%s" rows="3" class="large-text">%s</textarea>', $id, esc_attr( $key ), esc_textarea( $value ) );
		} else {
			printf( '<input type="%s" id="%s" name="%s" value="%s" class="regular-text">', 'url' === $field['type'] ? 'url' : 'text', $id, esc_attr( $key ), esc_attr( $value ) );
		}
		echo '</td></tr>';
	}
	echo '</tbody></table>';
}

/**
 * Uloženie polí.
 *
 * @param int $post_id ID.
 */
function sf_save_meta( $post_id ) {
	if ( ! isset( $_POST['sf_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['sf_meta_nonce'] ) ), 'sf_meta_save' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$type   = get_post_type( $post_id );
	$fields = sf_meta_fields();
	if ( ! isset( $fields[ $type ] ) ) {
		return;
	}
	foreach ( $fields[ $type ]['fields'] as $key => $field ) {
		if ( ! isset( $_POST[ $key ] ) ) {
			continue;
		}
		$raw = wp_unslash( $_POST[ $key ] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
		if ( 'url' === $field['type'] ) {
			$val = esc_url_raw( $raw );
		} elseif ( 'textarea' === $field['type'] ) {
			$val = sanitize_textarea_field( $raw );
		} elseif ( 'select' === $field['type'] ) {
			$val = array_key_exists( $raw, $field['options'] ) ? $raw : '';
		} else {
			$val = sanitize_text_field( $raw );
		}
		update_post_meta( $post_id, $key, $val );
	}
}
add_action( 'save_post', 'sf_save_meta' );

/**
 * Prehľad dopytu (iba na čítanie).
 */
add_action(
	'add_meta_boxes_sf_dopyt',
	function () {
		add_meta_box(
			'sf_dopyt_detail',
			__( 'Detail dopytu', 'skinandface' ),
			function ( $post ) {
				$rows = array(
					__( 'Meno', 'skinandface' )    => get_the_title( $post ),
					__( 'Telefón', 'skinandface' ) => get_post_meta( $post->ID, '_sf_phone', true ),
					__( 'E-mail', 'skinandface' )  => get_post_meta( $post->ID, '_sf_email', true ),
					__( 'Pobočka', 'skinandface' ) => get_post_meta( $post->ID, '_sf_branch', true ),
					__( 'Záujem', 'skinandface' )  => get_post_meta( $post->ID, '_sf_service', true ),
					__( 'Správa', 'skinandface' )  => get_post_meta( $post->ID, '_sf_message', true ),
					__( 'Zdroj', 'skinandface' )   => get_post_meta( $post->ID, '_sf_source', true ),
				);
				echo '<table class="form-table" role="presentation"><tbody>';
				foreach ( $rows as $label => $val ) {
					printf( '<tr><th scope="row">%s</th><td>%s</td></tr>', esc_html( $label ), nl2br( esc_html( $val ) ) );
				}
				echo '</tbody></table>';
			},
			'sf_dopyt',
			'normal',
			'high'
		);
	}
);
