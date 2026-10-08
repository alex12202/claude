<?php
/**
 * Bežná stránka (napr. Cenník, Ochrana osobných údajov).
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	get_template_part( 'parts/page-head', null, array( 'lead' => has_excerpt() ? get_the_excerpt() : '' ) );
	?>
	<div class="sf-wrap sf-layout">
		<article class="sf-layout__main sf-content">
			<?php the_content(); ?>
		</article>
		<aside class="sf-layout__side">
			<?php get_template_part( 'parts/booking-box' ); ?>
		</aside>
	</div>
	<?php
endwhile;

get_footer();
