<?php
/**
 * Template Name: Mobilizacao Popular
 */

get_header('resume'); ?>

	<div id="primary">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page-mae' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			
		
<?php wp_reset_query(); // reset query ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	
	<div id="prateleira">



<ul>
	<li class="planos"><a href="<?php echo esc_url( home_url( '/biblioteca/' ) ); ?>">Biblioteca</a></li>
	<li class="planos"><a href="http://www.rededeolhonosplanos.org.br" target="_blank">Rede De Olho nos Planos</a></li>
	<li class="planos"><a href="<?php echo esc_url( home_url( '/mobilizacao-popular/criancas-e-adolescentes/' ) ); ?>">Mobiliza&ccedil;&atilde;o de Crian&ccedil;as e Adolescentes</a></li>
</ul>



</div>


<?php get_footer(); ?>
