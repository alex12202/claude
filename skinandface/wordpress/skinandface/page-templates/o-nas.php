<?php
/**
 * Template Name: O nás
 *
 * Úvod z editora + lekárky s celým životopisom + recenzie.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'parts/page-head', null, array( 'lead' => has_excerpt() ? get_the_excerpt() : '' ) );
	if ( trim( get_the_content() ) ) :
		?>
		<div class="sf-wrap sf-content" style="padding-top:56px"><?php the_content(); ?></div>
		<?php
	endif;
	get_template_part( 'parts/team', null, array( 'full' => true ) );
	get_template_part( 'parts/reviews' );
	get_template_part( 'parts/cta' );
endwhile;

get_footer();
