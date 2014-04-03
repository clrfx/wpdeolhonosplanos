<?php
/**
 * Template Name: Biblioteca Planos de educacao
 */

get_header('biblioteca'); ?>

	<div id="primary">
		<div id="content" role="main">
		
<div id="query-posts" class="biblioteca">

<?php
$args = array(
	    	'post_type'      => 'dlm_download',
			'posts_per_page' => '8',
			'dlm_download_category' => 'planos-de-educacao-biblioteca',
	    	'no_found_rows'  => 1,
	    	'post_status'    => 'publish',
	    	'meta_query'     => array()
	  	);
		
$downloads = new WP_Query( $args );
if ( $downloads->have_posts() ) : ?>

<?php $cadastro_download = get_page_by_title( 'Cadastro Download' ); ?>

<?php while ( $downloads->have_posts() ) : $downloads->the_post(); ?>
		<?php
			// Pega o ID de cada download
			$id = $dlm_download->id;
		?>

		<?php // Cria cada popup com o conteúdo respectivo ao ID ?>
		<div class="white-popup mfp-hide" id="<?php echo $id; ?>">
			<?php echo apply_filters( 'the_content', $cadastro_download->post_content ); ?>
			<a href="<?php $dlm_download->the_download_link(); ?>" rel="bookmark" class="download-hidden biblioteca biblioteca-popup biblioteca-bg">
				<span class="botao-biblioteca">DOWNLOAD</span>
			</a>
		</div>

		<div id="cada-download" <?php post_class(); ?>>

				<a class="img-destacada-biblioteca open-popup-link" href="#<?php /* Linka para o popup montado acima */ echo $id; ?>">
					<?php $dlm_download->the_image( 'downloads' ); ?>
				</a>

			<span class="entry-title-download-query"><a class="open-popup-link" href="#<?php /* Linka para o popup montado acima */ echo $id; ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php $dlm_download->the_title(); ?></a></span>

			<div class="entry-content-download">
				<?php $dlm_download->the_short_description(); ?>
			</div><!-- .entry-content-download -->

					<a href="#<?php /* Linka para o popup montado acima */ echo $id; ?>" class="open-popup-link botao-download download biblioteca-bg">DOWNLOAD</a>

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

		<li class="planos"><a href="<?php echo esc_url( home_url( '/planos-de-educacao/banco-de-experiencia/' ) ); ?>">Banco de <br />Experi&ecirc;ncias</a></li>

		<li class="planos"><a href="<?php echo esc_url( home_url( '/colecao/' ) ); ?>">Cole&ccedil;&atilde;o <br />De Olho nos Planos</a></li>

	    <li class="indicadores-qualidade planos"><a class="indicadores-qualidade" href="http://www.indicadoreseducacao.org.br/">Indicadores da Qualidade na Educa&ccedil;&atilde;o</a></li>

		</ul>

	</div>	
	
	
<?php get_footer(); ?>
