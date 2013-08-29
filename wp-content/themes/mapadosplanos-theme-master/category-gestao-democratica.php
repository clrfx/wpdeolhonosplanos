<?php
/**
 * The template for displaying Category pages.
 *
 * Used to display archive-type pages for posts in a category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header('noticias'); ?>

	<section id="primary" class="site-content">

		
		<div id="content" role="main">

		<?php if ( have_posts() ) : ?>
	
			<?php 
			/* Start the Sticky Loop */ 
			$cat = get_query_var('cat');
			if (get_option('sticky_posts')) {
				$sticky = array_slice(get_option('sticky_posts'),-1);
			}
			else {
				$sticky = array();
			}
			$stickyquery = new WP_Query( array( 'post__in' => $sticky, 'cat' => $cat) );
			while ($stickyquery->have_posts()) : $stickyquery->the_post(); ?>
			<div id="cada-noticia-destacada" <?php post_class("category-sticky"); ?>>
			<a class="link-categoria" href="<?php echo get_permalink(); ?>">
			<?php 
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('category-sticky', array('class'	=> "category-image"));
			}
			else {
				echo '<img class="category-image" src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/thumbnail-default-large.png" />';
			} 
			?>
			</a>
				<h1 class="entry-title-query-destacado noticias"><a class="noticias" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h1>
				
				<div class="entry-content-post-category">
				<?php the_excerpt(); ?>
				</div>
				
				<a href="<?php the_permalink(); ?>" rel="bookmark" class="leia-mais noticias-bg"><span class="mais">+</span>
				</a>
				
			</div>		
			<?php endwhile; ?>
			<?php
			/* Start the regular Loop */
			while (have_posts()) : the_post();  ?>	

		<div id="cada-noticia" <?php post_class(array("category-regular","post-thumb")); ?>>
				<a class="link-categoria" href="<?php echo get_permalink(); ?>">
			<?php 
			if ( has_post_thumbnail() ) {
				the_post_thumbnail('category-regular', array('class'	=> "category-image"));
			}
			else {
				echo '<img class="category-image" src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/thumbnail-default-small.png" />';
			}
			?>
				</a>
				<h1 class="entry-title-query noticias"><a class="noticias" href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h1>
				
				<div class="entry-content-post-category">
				<?php echo excerpt( 17 ); //Imprime 13 palavras ?> ...
				</div>

				<a href="<?php the_permalink(); ?>" rel="bookmark" class="leia-mais noticias-bg"><span class="mais">+</span>
				</a>

		</div>		
			<?php endwhile; ?>

			
			<?php twentytwelve_content_nav( 'nav-below' ); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	
	</section><!-- #primary -->
	
	<?php if ( is_active_sidebar( 'sidebar-noticias-widget' ) ) : ?>
	<div id="secondary" class="noticias-sidebar" role="complementary">
			<?php dynamic_sidebar( 'sidebar-noticias-widget' ); ?>
	</div><!-- #secondary -->
	<?php endif; ?>


<div class="clear"></div>

<div id="prateleira">

	<ul>

	<li class="home"><a href="<?php echo esc_url( home_url( '/planos-de-educacao/banco-de-experiencia/' ) ); ?>">Banco de Experi&ecirc;ncias</a></li>

	<li class="home"><a href="<?php echo esc_url( home_url( '/downloads/' ) ); ?>">Downloads</a></li>

	<li class="indicadores-qualidade home"><a class="indicadores-qualidade" href="http://www.indicadoreseducacao.org.br/">Indicadores da Qualidade na Educa&ccedil;&atilde;o</a></li>

	</ul>

</div>

<?php get_footer(); ?>
