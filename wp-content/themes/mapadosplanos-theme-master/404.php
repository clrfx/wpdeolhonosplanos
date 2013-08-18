<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header('search'); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentytwelve' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentytwelve' ); ?></p>
					<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Visite a nossa Home</a></p>

					
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->
	
	<div id="barra-mapa">

		<div id="content-mapa">
		
			<div id="box-below-map">
			<span><a href="<?php echo esc_url( home_url( '/ajuda/' ) ); ?>"> Como Usar?</a></span>
			</div>
			
			<div id="box-below-map">
			<span><a href="<?php echo esc_url( home_url( '/participe/' ) ); ?>"> Participe!</a></span>
			</div>
			
			<div id="box-below-map" class="last">
			<span class="box-busca-mapa">Pesquisa no Mapa</span>
			<?php get_template_part( 'searchform-munic' ); ?>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	

<?php get_footer(); ?>