<?php
/**
 * Úvodná stránka.
 *
 * Poradie sekcií sa mení tu. Texty, fotky a údaje sa upravujú
 * v Prispôsobiť › Skin & Face a v typoch obsahu (Služby, Lekári, Recenzie, Časté otázky).
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'parts/hero' );
get_template_part( 'parts/intro' );
get_template_part( 'parts/services' );
get_template_part( 'parts/steps' );
get_template_part( 'parts/team' );
get_template_part( 'parts/reviews' );
get_template_part( 'parts/faq' );
get_template_part( 'parts/branches' );
get_template_part( 'parts/cta' );

get_footer();
