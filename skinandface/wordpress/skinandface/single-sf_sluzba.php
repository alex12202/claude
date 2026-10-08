<?php
/**
 * Detail služby – optimalizované pre Google a AI vyhľadávače
 * (box „V skratke“, cena, štruktúrované údaje MedicalProcedure).
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	$sf_id       = get_the_ID();
	$sf_cat      = get_post_meta( $sf_id, '_sf_category', true );
	$sf_cat_name = 'estetika' === $sf_cat ? __( 'Estetická medicína', 'skinandface' ) : __( 'Dermatovenerológia', 'skinandface' );
	$sf_short    = get_post_meta( $sf_id, '_sf_short', true );
	$sf_price    = sf_service_price( $sf_id );
	$sf_scope    = get_post_meta( $sf_id, '_sf_scope', true );
	$sf_branches = get_post_meta( $sf_id, '_sf_branches', true );

	get_template_part(
		'parts/page-head',
		null,
		array(
			'lead'   => has_excerpt() ? get_the_excerpt() : '',
			'crumbs' => array( get_post_type_archive_link( 'sf_sluzba' ) => __( 'Služby', 'skinandface' ) ),
		)
	);
	?>
	<div class="sf-wrap sf-layout">
		<article class="sf-layout__main">
			<?php if ( $sf_short || $sf_price ) : ?>
				<section class="sf-summary" aria-labelledby="sf-skratka">
					<h2 id="sf-skratka"><?php esc_html_e( 'V skratke', 'skinandface' ); ?></h2>
					<?php if ( $sf_short ) : ?>
						<p style="margin:0"><?php echo esc_html( $sf_short ); ?></p>
					<?php endif; ?>
					<dl>
						<div><dt><?php esc_html_e( 'Oblasť', 'skinandface' ); ?></dt><dd><?php echo esc_html( $sf_cat_name ); ?></dd></div>
						<?php if ( $sf_price ) : ?>
							<div><dt><?php esc_html_e( 'Cena', 'skinandface' ); ?></dt><dd><?php echo esc_html( $sf_price ); ?></dd></div>
						<?php endif; ?>
						<?php if ( $sf_scope ) : ?>
							<div><dt><?php esc_html_e( 'Rozsah', 'skinandface' ); ?></dt><dd><?php echo esc_html( $sf_scope ); ?></dd></div>
						<?php endif; ?>
						<?php if ( $sf_branches ) : ?>
							<div><dt><?php esc_html_e( 'Pobočky', 'skinandface' ); ?></dt><dd><?php echo esc_html( $sf_branches ); ?></dd></div>
						<?php endif; ?>
					</dl>
				</section>
			<?php endif; ?>

			<?php if ( has_post_thumbnail() ) : ?>
				<?php the_post_thumbnail( 'sf-wide', array( 'style' => 'border-radius:var(--sf-radius);margin-bottom:40px;width:100%;height:340px;object-fit:cover' ) ); ?>
			<?php endif; ?>

			<div class="sf-content"><?php the_content(); ?></div>

			<p style="margin-top:32px;font-size:13px;color:var(--sf-muted)">
				<?php
				printf(
					/* translators: %s: dátum */
					esc_html__( 'Aktualizované: %s', 'skinandface' ),
					esc_html( get_the_modified_date( 'j. n. Y' ) )
				);
				?>
			</p>
		</article>
		<aside class="sf-layout__side">
			<?php get_template_part( 'parts/booking-box', null, array( 'title' => sprintf( __( 'Objednať sa: %s', 'skinandface' ), get_the_title() ) ) ); ?>
		</aside>
	</div>
	<?php
endwhile;

get_footer();
