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

	<div id="primary" class="site-home">

		<?php if(function_exists('wp_content_slider')) { wp_content_slider(); } ?>


	</div><!-- #primary -->
	

<?php get_sidebar('front'); ?>

<div class="clear"></div>

<div id="prateleira">

	<ul>

	<li class="home"><a href="<?php echo esc_url( home_url( '/planos-de-educacao/banco-de-experiencia/' ) ); ?>">Banco de Experi&ecirc;ncias</a></li>

	<li class="home"><a href="<?php echo esc_url( home_url( '/colecao/' ) ); ?>">Cole&ccedil;&atilde;o De Olho nos Planos</a></li>

	<li class="indicadores-qualidade home"><a class="indicadores-qualidade" href="http://www.indicadoreseducacao.org.br/">Indicadores da Qualidade na Educa&ccedil;&atilde;o</a></li>

	</ul>

</div>

<div id="title-querys" class="noticias">
	<div class="triangulo triangulo-noticias">
	</div>
	<h1 class="noticias"><a href="<?php echo esc_url( home_url( '/category/noticias/' ) ); ?>">Not&iacute;cias</a></h1>
</div>

<div id="query-posts" class="noticias">

	<?php
		if ( query_posts( array ( 'cat' => '-13,-29,-28,-30','post_status' => 'publish', 'posts_per_page' => 3 ) ) ) : while ( have_posts() ) : the_post(); 
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
				<?php echo excerpt( 20 ); //Imprime 21 palavras ?> ...
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
				<div class="entry-utility">
					<?php edit_post_link( __('Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry-utility -->
			</div><!-- .entry-content -->
			
			<a href="<?php the_permalink(); ?>" rel="bookmark" class="leia-mais noticias-bg"><span class="mais">+</span></a>
		</div><!-- #cada-post -->

	<?php endwhile; endif; // end of the loop. ?>
	<?php wp_reset_query(); // reset query ?>

</div>

<div class="col-3">
	<h3 class="area-title"><a href="<?php echo esc_url( home_url( '/category/noticias/' ) ); ?>">Vídeo</a></h3>
	tste
</div><!-- .col-3 -->

<div class="col-3">
	<div id="query-posts" class="noticias">
		<h3 class="noticias area-title"><a href="<?php echo esc_url( home_url( '/category/noticias/' ) ); ?>">Notícias</a></h3>
		<?php if ( query_posts( array ( 'cat' => '-13,-29,-28,-30','post_status' => 'publish', 'posts_per_page' => 3 ) ) ) : while ( have_posts() ) : the_post();  ?>

			<div <?php post_class( 'media' ); ?>>
				<a class="alignleft" href="<?php echo get_permalink(); ?>">
					<?php 
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('thumbnail-mini');
					}
					else {
						echo '<img class="category-image" src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/thumbnail-default-large.png" />';
					} 
					?>
				</a>
				<div class="media-body">
					<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					<div class="entry-utility">
						<?php edit_post_link( __('Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- .media-body -->
			</div><!-- #cada-post -->

		<?php endwhile; endif; // end of the loop. ?>
		<?php wp_reset_query(); // reset query ?>

	</div>
</div><!-- .col-3 -->

<div class="col-3">
	<h3 class="area-title"><a href="<?php echo esc_url( home_url( '/category/noticias/' ) ); ?>">No Facebook</a></h3>
	teste
</div><!-- .col-3 -->

<?php get_footer(); ?>

<script> markers = <?php echo get_markers_json(); ?>;</script>

