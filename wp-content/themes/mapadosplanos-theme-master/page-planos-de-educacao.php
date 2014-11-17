<?php
/**
 * Template Name: Planos de Educacao
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
			<li class="planos"><a href="<?php echo esc_url( home_url( '/colecao/' ) ); ?>">Cole&ccedil;&atilde;o De Olho nos Planos</a></li>
			<li class="planos"><a href="<?php echo esc_url( home_url( '/biblioteca/' ) ); ?>">Biblioteca</a></li>
			<li class="planos"><a href="http://www.rededeolhonosplanos.org.br" target="_blank">Rede de Olho nos Planos</a></li>
		</ul>
	</div><!-- #prateleira -->

<?php get_footer(); ?>
