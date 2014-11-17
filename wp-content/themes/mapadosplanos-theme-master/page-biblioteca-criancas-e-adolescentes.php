<?php
/**
 * Template Name: Biblioteca Criancas e Adolescentes
 */

get_header('biblioteca'); ?>

	<div id="primary">
		<div id="content" role="main">
		
<div id="query-posts" class="biblioteca">

<?php
$args = array(
	    	'post_type'      => 'dlm_download',
			'posts_per_page' => '8',
			'dlm_download_category' => 'participacao-de-criancas-e-adolescentes-biblioteca',
	    	'no_found_rows'  => 1,
	    	'post_status'    => 'publish',
	    	'meta_query'     => array()
	  	);
		
$downloads = new WP_Query( $args );
if ( $downloads->have_posts() ) : ?>

<?php while ( $downloads->have_posts() ) : $downloads->the_post(); ?>

		<div id="cada-download" <?php post_class(); ?>>

				<a class="img-destacada-biblioteca" href="<?php $dlm_download->the_download_link(); ?>">
					<?php $dlm_download->the_image( 'downloads' ); ?>
				</a>

			<span class="entry-title-download-query"><a href="<?php $dlm_download->the_download_link(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php $dlm_download->the_title(); ?></a></span>

			<div class="entry-content-download">
				<?php $dlm_download->the_short_description(); ?>
			</div><!-- .entry-content-download -->

				<a href="<?php $dlm_download->the_download_link(); ?>" rel="bookmark" class="biblioteca biblioteca-bg">
                	<span class="botao-biblioteca">DOWNLOAD</span>
				</a>

		</div><!-- #cada-download -->

			<?php endwhile; // end of the loop. ?>
		
		<?php endif;

		wp_reset_postdata();
	
		?><!-- Fim Loop -->

</div>


		</div><!-- #content -->
	</div><!-- #primary -->
	
	<div id="prateleira">

		<ul>

		<li class="planos"><a href="http://www.rededeolhonosplanos.org.br" target="_blank">Rede<br/>De Olho nos Planos</a></li>

		<li class="planos"><a href="<?php echo esc_url( home_url( '/colecao/' ) ); ?>">Cole&ccedil;&atilde;o <br />De Olho nos Planos</a></li>

	    <li class="indicadores-qualidade planos"><a class="indicadores-qualidade" href="http://www.indicadoreseducacao.org.br/">Indicadores da Qualidade na Educa&ccedil;&atilde;o</a></li>

		</ul>

	</div>	
	
	
<?php get_footer(); ?>
