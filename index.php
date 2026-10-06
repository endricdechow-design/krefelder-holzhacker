<?php
/**
 * Fallback-Template (z. B. für Impressum, Datenschutz und Blog).
 *
 * @package Holzhacker
 */

get_header();
?>

<main id="main" class="site-main">
	<div class="container page-content">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<h1><?php esc_html_e( 'Nichts gefunden', 'holzhacker' ); ?></h1>
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Zur Startseite', 'holzhacker' ); ?></a></p>
		<?php endif; ?>
	</div>
</main>

<?php
get_footer();
