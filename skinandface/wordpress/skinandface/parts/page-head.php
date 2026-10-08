<?php
/**
 * Záhlavie podstránky s omrvinkami.
 *
 * Argumenty: title, lead, crumbs (pole URL => názov).
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

$title  = isset( $args['title'] ) ? $args['title'] : get_the_title();
$lead   = isset( $args['lead'] ) ? $args['lead'] : '';
$crumbs = isset( $args['crumbs'] ) ? $args['crumbs'] : array();
?>
<header class="sf-page-head">
	<div class="sf-wrap">
		<nav class="sf-breadcrumbs" aria-label="<?php esc_attr_e( 'Omrvinky', 'skinandface' ); ?>">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Domov', 'skinandface' ); ?></a>
			<?php foreach ( $crumbs as $url => $label ) : ?>
				/ <a href="<?php echo esc_url( $url ); ?>"><?php echo esc_html( $label ); ?></a>
			<?php endforeach; ?>
			/ <span aria-current="page"><?php echo esc_html( wp_strip_all_tags( $title ) ); ?></span>
		</nav>
		<h1><?php echo esc_html( $title ); ?></h1>
		<?php if ( $lead ) : ?>
			<p><?php echo esc_html( $lead ); ?></p>
		<?php endif; ?>
	</div>
</header>
