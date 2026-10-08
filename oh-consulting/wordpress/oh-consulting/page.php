<?php
/**
 * Bežná stránka (napr. Ochrana osobných údajov).
 *
 * @package oh-consulting
 */

get_header();
?>
<main id="obsah" class="oh-page">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article <?php post_class(); ?>>
			<h1><?php the_title(); ?></h1>
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</article>
	<?php endwhile; ?>
</main>
<?php
get_footer();
