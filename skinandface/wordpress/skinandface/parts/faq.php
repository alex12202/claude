<?php
/**
 * Časté otázky (typ obsahu „Časté otázky“). Na úvodnej stránke sa
 * k nim automaticky pridáva štruktúra FAQPage pre Google a AI.
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

$questions = get_posts(
	array(
		'post_type'      => 'sf_otazka',
		'posts_per_page' => 20,
		'orderby'        => array( 'menu_order' => 'ASC', 'date' => 'ASC' ),
	)
);
if ( ! $questions ) {
	return;
}
?>
<section class="sf-section sf-section--white" id="faq" style="background:var(--sf-ground)">
	<div class="sf-wrap sf-faq">
		<div class="sf-faq__intro">
			<span class="sf-eyebrow"><?php esc_html_e( 'Časté otázky', 'skinandface' ); ?></span>
			<h2 class="sf-h2"><?php esc_html_e( 'Skôr než prídete', 'skinandface' ); ?></h2>
			<p class="sf-lead">
				<?php esc_html_e( 'Nenašli ste odpoveď? Zavolajte nám na', 'skinandface' ); ?>
				<a href="<?php echo esc_attr( sf_tel_href() ); ?>" style="font-weight:600"><?php echo esc_html( sf_opt( 'phone' ) ); ?></a>.
			</p>
		</div>
		<div class="sf-faq__list">
			<?php foreach ( $questions as $i => $q ) : ?>
				<details<?php echo 0 === $i ? ' open' : ''; ?>>
					<summary><?php echo esc_html( get_the_title( $q ) ); ?></summary>
					<div class="sf-faq__answer"><?php echo wp_kses_post( wpautop( $q->post_content ) ); ?></div>
				</details>
			<?php endforeach; ?>
		</div>
	</div>
</section>
