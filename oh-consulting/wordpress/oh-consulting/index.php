<?php
/**
 * Zoznam príspevkov a záložná šablóna.
 *
 * @package oh-consulting
 */

get_header();
?>
<main id="obsah" class="oh-page">
	<?php if ( have_posts() ) : ?>
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'oh-post' ); ?>>
				<?php if ( is_singular() ) : ?>
					<h1><?php the_title(); ?></h1>
				<?php else : ?>
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				<?php endif; ?>
				<div class="entry-content">
					<?php is_singular() ? the_content() : the_excerpt(); ?>
				</div>
			</article>
		<?php endwhile; ?>
		<?php the_posts_pagination(); ?>
	<?php else : ?>
		<h1><?php esc_html_e( 'Nič sa nenašlo', 'oh-consulting' ); ?></h1>
		<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Späť na úvod', 'oh-consulting' ); ?></a></p>
	<?php endif; ?>
</main>
<?php
get_footer();
