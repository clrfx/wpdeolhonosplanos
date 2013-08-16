<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content">
		
		<?php if(function_exists('wp_content_slider')) { wp_content_slider(); } ?>

	</div><!-- #primary -->
	
<?php get_sidebar('front'); ?>
<div class="clear"></div>
<div id="prateleira">

<ul>

<li><a href="<?php echo esc_url( home_url( '/planos-de-educacao/banco-de-experiencia/' ) ); ?>">Banco de <br />Experi&ecirc;ncias</a></li>
<li><a href="<?php echo esc_url( home_url( '/processos-participativos/' ) ); ?>">Guia de Participa&ccedil;&atilde;o na Constru&ccedil;&atilde;o e Revis&atilde;o de Planos de Educa&ccedil;&atilde;o</a></li>
<li><a href="<?php echo esc_url( home_url( '/mobilizacao-popular/criancas-e-adolescentes/' ) ); ?>">Guia de Participa&ccedil;&atilde;o de Crian&ccedil;as e Adolescentes</a></li>
<li><a href="<?php echo esc_url( home_url( '/processos-participativos/uso-dos-indiques-na-construcao-dos-planos/' ) ); ?>">O Uso dos Indiques na Constru&ccedil;&atilde;o de Planos de Educa&ccedil;&atilde;o</a></li>
<li class="indicadores-qualidade"><a class="indicadores-qualidade" href="http://www.indicadoreseducacao.org.br/">Indicadores da Qualidade na Educa&ccedil;&atilde;o</a></li>
</ul>

</div>

<div id="title-querys" class="noticias">
<div class="triangulo triangulo-noticias"></div><h1 class="noticias"><a href="<?php echo esc_url( home_url( '/category/noticias/' ) ); ?>">Noticias</a></h1>

</div>
<div id="query-posts" class="noticias">

	<?php
			if ( query_posts( array ( 'cat' => '-59','post_status' => 'publish', 'posts_per_page' => 3 )) ) while ( have_posts() ) : the_post(); 
	?>
		<div id="cada-post" <?php post_class(); ?>>
			
				<a class="link-img-destacada" href="<?php echo get_permalink(); ?>">
				<?php 
				if ( has_post_thumbnail() ) {
					the_post_thumbnail('category-sticky', array('class'	=> "category-image"));
				}
				else {
					echo '<img class="category-image" src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/thumbnail-default-large.png" />';
				} 
				?>
				</a>

			<h1 class="entry-title-query"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

				
			<div class="entry-content-post-home">

				<?php echo excerpt( 21 ); //Imprime 21 palavras ?> ...
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>													<div class="entry-utility">						<?php edit_post_link( __('Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>				</div><!-- .entry-utility -->				
				</div><!-- .entry-content -->

			<div class="entry-meta">
			<?php /*
			$category = get_the_category(); 
			if($category[0]){
			echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
			} */ ?>
			</div>						<a href="<?php the_permalink(); ?>" rel="bookmark" class="leia-mais noticias-bg"><span class="mais">+</span>			</a>
				
		</div><!-- #cada-post -->

<?php endwhile; // end of the loop. ?>
<?php wp_reset_query(); // reset query ?>

</div>

<?php get_footer(); ?>
<script> markers = <?php echo get_markers_json(); ?>;</script>
