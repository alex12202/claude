<?php
/**
 * Záložná šablóna (blog, archívy, vyhľadávanie).
 *
 * @package skinandface
 */

defined( 'ABSPATH' ) || exit;

get_header();

$sf_title = is_search() ? sprintf( __( 'Výsledky vyhľadávania: %s', 'skinandface' ), get_search_query() ) : wp_strip_all_tags( get_the_archive_title() );
if ( is_home() ) {
	$sf_title = get_the_title( (int) get_option( 'page_for_posts' ) );
}
get_template_part( 'parts/page-head', null, array( 'title' => $sf_title ) );
?>
<div class="sf-wrap" style="padding-top:56px;padding-bottom:96px">
	<?php if ( have_posts() ) : ?>
		<div class="sf-archive-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<a class="sf-tile" href="<?php the_permalink(); ?>">
					<h3><?php the_title(); ?></h3>
					<p><?php echo esc_html( get_the_excerpt() ); ?></p>
				</a>
			<?php endwhile; ?>
		</div>
		<div style="margin-top:32px"><?php the_posts_pagination(); ?></div>
	<?php else : ?>
		<p><?php esc_html_e( 'Nič sme nenašli.', 'skinandface' ); ?></p>
	<?php endif; ?>
</div>
<?php
get_footer();
