<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header('resume'); ?>

	<section id="primary" class="lista-busca">
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentytwelve' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header>

			<?php twentytwelve_content_nav( 'nav-above' ); ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php 
				if ( 'municipio' == get_post_type() ) {
					get_template_part( 'content-search-munic', get_post_format() ); 
				}
				else {
					get_template_part( 'content', get_post_format() ); 
				}
					?>

			<?php endwhile; ?>

			<?php twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<article id="post-0" class="post no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentytwelve' ); ?></p>
					<p>Fa&ccedil;a outra Busca por municipios ou estados</p>
					<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Voltar para a Home</a></p>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		<?php endif; ?>

		</div><!-- #content -->
	</section><!-- #primary -->
	
	<?php 
				if ( 'municipio' == get_post_type() ) {
					get_template_part( 'barra-search-munic', get_post_format() ); 
				};
				?>

<?php get_footer(); ?>