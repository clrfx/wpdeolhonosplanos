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

		<?php //if(function_exists('wp_content_slider')) { wp_content_slider(); } ?>
		Aqui ficava o slider

	</div><!-- #primary -->

	<?php get_sidebar('front'); ?>

	<div class="clear"></div>

	<hr/>

	<div class="featured-content">
		<div class="featured-slider content-slider col-3">
			<?php if(function_exists('wp_content_slider')) { wp_content_slider(); } ?>
		</div>

		<div class="news-main col-3">
			<?php
			$rs = new WP_Query( array ( 'ignore_sticky_posts' => true, cat => '-13,-29,-28,-30','post_status' => 'publish', 'posts_per_page' => 1 ) );
			if ( $rs->have_posts() ) : while ( $rs->have_posts() ) : $rs->the_post(); 
		?>

			<div <?php post_class(); ?>>
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
					<?php echo excerpt( 30 ); //Imprime 21 palavras ?> &hellip;
					<div class="entry-utility">
						<?php edit_post_link( __('Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- .entry-content -->
			</div><!-- #cada-post -->

		<?php endwhile; endif; // end of the loop. ?>
		<?php wp_reset_query(); // reset query ?>
		</div>

		<div class="news-list col-3">
			<?php

			$oi = new WP_Query( array ( 'cat' => '-13,-29,-28,-30','post_status' => 'publish', 'posts_per_page' => 3 ) );
			if ( $oi->have_posts() ) : while ( $oi->have_posts() ) : $oi->the_post(); 
			?>


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
	</div><!-- .featured-content -->

<div class="clear"></div>

<div class="secondary-content">
	<div class="container-mapa col col-2-3">
		<h3 class="area-title">De Olho no Mapa</h3>
		<div id="barra-mapa">

			<div id="content-mapa">
			
				<div id="box-below-map">
				<span><a href="<?php echo esc_url( home_url( '/ajuda/' ) ); ?>"> Como Usar?</a></span>
				</div>
				
				<div id="box-below-map">
				<span><a href="<?php echo esc_url( home_url( '/participe/' ) ); ?>"> Participe!</a></span>
				</div>
				
				<div id="box-below-map" class="last">
				<span class="box-busca-mapa">Busque no Mapa</span>
				<?php get_template_part( 'searchform-munic' ); ?>
				</div>
				
				<div class="clear"></div>
				
				<?php get_template_part( 'mapbox' ); ?>
				
				<div class="clear"></div>

			</div>
		</div>
	</div><!-- .container-mapa -->

	<div class="col col-3 container-prateleira">
		<h3 class="area-title">Prateleira</h3>
		<div class="prateleira">
			<ul class="prateleira-list">
				<li class="prateleira-item">
					<a href="<?php echo esc_url( home_url( '/planos-de-educacao/banco-de-experiencia/' ) ); ?>">
						<h2 class="prateleira-item-title">Rede De Olho</h2>
						<p class="prateleira-item-description">Participe e troque informações com pessoas de todo o país sobre os Planos Municipais de Educação</p>
						<span class="mais">+</span>
					</a>
				</li>
				<li class="prateleira-item">
					<a href="<?php echo esc_url( home_url( '/colecao/' ) ); ?>">
						<h2 class="prateleira-item-title">Coleção</h2>
						<p class="prateleira-item-description">Faça o download dos materiais do De Olho nos Planos e se junte a esta iniciativa!</p>
						<span class="mais">+</span>
					</a>
				</li>
				<li class="indicadores-qualidade prateleira-item">
					<a class="indicadores-qualidade" href="http://www.indicadoreseducacao.org.br/">
						<h2 class="prateleira-item-title">Indicadores da Qualidade na Educação</h2>
						<p class="prateleira-item-description">Avaliação: conheça nossa proposta de autoavaliação participativa para as escolas</p>
						<span class="mais">+</span>
					</a>
				</li>
			</ul>
		</div>
	</div>

</div><!-- .secondary-content -->

<div class="clear"></div>

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

