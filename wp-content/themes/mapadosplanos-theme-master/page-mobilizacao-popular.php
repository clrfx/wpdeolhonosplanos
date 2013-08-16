<?php
/**
 * Template Name: Mobilizacao Popular
 */

get_header('resume'); ?>

	<div id="primary">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			
		
<?php wp_reset_query(); // reset query ?>

		</div><!-- #content -->
	</div><!-- #primary -->
	
	<div id="prateleira">



<ul>

<li class="planos"><a href="<?php echo esc_url( home_url( '/planos-de-educacao/banco-de-experiencia/' ) ); ?>">Como fazer uma peti&ccedil;&atilde;o?</a></li>

<li class="planos"><a href="<?php echo esc_url( home_url( '/processos-participativos/' ) ); ?>">Comiss&otilde;es Permanentes</a></li>

<li class="planos"><a href="<?php echo esc_url( home_url( '/mobilizacao-popular/criancas-e-adolescentes/' ) ); ?>">Mobiliza&ccedil;&atilde;o de Crian&ccedil;as e Adolescentes</a></li>

    
   
    


</ul>



</div>


<?php get_footer(); ?>
