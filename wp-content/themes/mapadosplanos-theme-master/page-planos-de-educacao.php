<?php
/**
 * Template Name: Planos de Educacao
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

<li class="planos"><a href="<?php echo esc_url( home_url( '/planos-de-educacao/' ) ); ?>">Historia dos Planos de Educa&ccedil;&atilde;o</a></li>

<li class="planos"><a href="<?php echo esc_url( home_url( '/planos-de-educacao/' ) ); ?>">Referencias Bibliograficas</a></li>

<li class="planos"><a href="<?php echo esc_url( home_url( '/planos-de-educacao/banco-de-experiencia/' ) ); ?>">Conhe&ccedil;a o Banco de Experiencias</a></li>

</ul>



</div>


<?php get_footer(); ?>
