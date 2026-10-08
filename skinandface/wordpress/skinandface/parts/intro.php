<?php
/**
 * Pás pod hero s hlavným nadpisom H1 (dôležité pre SEO).
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;
?>
<section class="sf-intro">
	<div class="sf-wrap">
		<h1><?php echo esc_html( sf_opt( 'hero_h1' ) ); ?> <em><?php echo esc_html( sf_opt( 'hero_h1_em' ) ); ?></em></h1>
		<p><?php echo esc_html( sf_opt( 'hero_intro' ) ); ?></p>
	</div>
</section>
