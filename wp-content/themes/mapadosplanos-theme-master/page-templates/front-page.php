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

<div class="featured-content pane clearfix">
	<div class="featured-slider content-slider col-3">
		<?php
		if ( function_exists( 'wp_content_slider' ) ) :
			wp_content_slider();
			
			$campanha_id = get_category_by_slug( 'campanhas' )->term_id;
			?>
			<a href="<?php echo get_category_link( $campanha_id ); ?>" class="leia-mais">Conheça as outras campanhas</a>
			<?php if ( current_user_can( 'switch_themes' ) ) : ?>
				<span class="edit-link"><a href="<?php echo admin_url('admin.php?page=content-slide/content_slide.php'); ?>" class="post-edit-link"><?php _e( 'Edit', 'twentyten' ); ?></a></span>
			<?php
			endif;
		endif;
		?>
	</div>

	<?php
	$destaques = new WP_Query( array(
		'ignore_sticky_posts' => true,
		'cat' => '-13,-29,-28,-30',
		'post_status' => 'publish',
		'posts_per_page' => 4,
	    'tax_query' => array(
	        array(                
	            'taxonomy' => 'post_format',
	            'field' => 'slug',
	            'terms' => array( 
	                'post-format-aside',
	                'post-format-audio',
	                'post-format-chat',
	                'post-format-gallery',
	                'post-format-image',
	                'post-format-link',
	                'post-format-quote',
	                'post-format-status',
	                'post-format-video'
	            ),
	            'operator' => 'NOT IN'
	        )
	    )
	) );

	if ( $destaques->have_posts() ) : 

		$i = 1;
		while ( $destaques->have_posts() ) : $destaques->the_post(); ?>

			<?php if ( $i == 1 ) : ?>

			<div class="news-main col-3">
				<div <?php post_class(); ?>>
					<a class="link-img-destacada" href="<?php echo get_permalink(); ?>">
						<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('category-sticky', array('class'	=> "category-image"));
						}
						else {
							echo '<img class="category-image" src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/thumbnail-default-small.png" />';
						} 
						?>
					</a>

					<h1 class="entry-title-query"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					<div class="entry-content-post-home">
						<?php the_excerpt(); ?>
					</div><!-- .entry-content -->
					<div class="entry-utility">
						<?php edit_post_link( __('Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-utility -->
				</div><!-- .post -->
			</div><!-- .news-main .col-3 -->

			<div class="news-list col-3">
			<?php else : ?>

				<div <?php post_class( 'media' ); ?>>
					<a class="alignleft" href="<?php echo get_permalink(); ?>">
						<?php 
						if ( has_post_thumbnail() ) {
							the_post_thumbnail('thumbnail-mini');
						}
						else {
							echo '<img class="category-image" src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/thumbnail-default-mini.png" />';
						} 
						?>
					</a>
					<div class="media-body">
						<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
						<div class="entry-utility">
							<?php edit_post_link( __('Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
						</div><!-- .entry-utility -->
					</div><!-- .media-body -->
				</div><!-- .media -->
			<?php endif; // if ( $i == 1 ) ?>

		<?php
		$i++;
		endwhile; ?>

			</div><!-- .news-list .col-3 -->

		<?php endif; // end of the loop. ?>

		<?php wp_reset_query(); // reset query ?>
</div><!-- .featured-content -->

<div class="clear"></div>

<div class="secondary-content pane clearfix">
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
		<h3 class="area-title">Mão na massa</h3>
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

<div class="tertiary-content pane clearfix">
	<div class="col-3">
		<h3 class="area-title"><a href="<?php echo get_post_format_link( 'video' ); ?>">Vídeos</a></h3>
		<?php
		$videos = new WP_Query ( array(
			'ignore_sticky_posts' => true,
			'posts_per_page' => 1,
			'tax_query' => array(
		        array(
		            'taxonomy' 	=> 'post_format',
		            'field' 	=> 'slug',
		            'terms' 	=> 'post-format-video',
	      		)
	      	)
		));
		
		if ( $videos->have_posts() ) : while ( $videos->have_posts() ) : $videos->the_post(); ?>

		<div <?php post_class( 'clearfix' ); ?>>
			<?php mapadosplanos_the_video(); ?>
			<h1 class="entry-title-query">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<div class="entry-content-post-home"><?php the_excerpt(); ?><?php edit_post_link( __('Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?></div>

			<a href="<?php the_permalink(); ?>" rel="bookmark" class="leia-mais noticias-bg--video"><span class="mais">+</span></a>
		</div><!-- .post .format-video -->

		<?php endwhile; endif; // end of the loop. ?>
	</div><!-- .col-3 -->

	<div class="col-3">
		<div id="query-posts" class="noticias">
			<h3 class="noticias area-title"><a href="<?php echo esc_url( home_url( '/category/noticias/' ) ); ?>">Outras notícias</a></h3>
			<?php
			$mais_noticias = new WP_Query( array(
				'ignore_sticky_posts' 	=> true,
				'cat' 					=> '-13,-29,-28,-30',
				'post_status' 			=> 'publish',
				'posts_per_page' 		=> 4,
				'offset'				=> 4,
			    'tax_query' 			=> array(
			        array(                
			            'taxonomy' => 'post_format',
			            'field' => 'slug',
			            'terms' => array( 
			                'post-format-aside',
			                'post-format-audio',
			                'post-format-chat',
			                'post-format-gallery',
			                'post-format-image',
			                'post-format-link',
			                'post-format-quote',
			                'post-format-status',
			                'post-format-video'
			            ),
			            'operator' => 'NOT IN'
			        )
			    )
			) );

			if ( $mais_noticias->have_posts() ) : while ( $mais_noticias->have_posts() ) : $mais_noticias->the_post(); ?>

			<div <?php post_class( 'media' ); ?>>
				<a class="alignleft" href="<?php echo get_permalink(); ?>">
					<?php 
					if ( has_post_thumbnail() ) {
						the_post_thumbnail('thumbnail-mini');
					}
					else {
						echo '<img class="category-image" src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/thumbnail-default-mini.png" />';
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
		<h3 class="area-title"><a href="https://www.facebook.com/DeOlhoNosPlanos">Redes Sociais</a></h3>
		<div class="facebook">
			<div class="fb-like-box" data-href="https://www.facebook.com/DeOlhoNosPlanos" data-colorscheme="light" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false" data-max-rows="6"></div>
		</div>
		<div class="twitter">
			<a class="twitter-timeline" href="https://twitter.com/DeOlhonosPlanos" data-chrome="transparent" data-border-color="#f26122" data-link-color="#f26122" data-widget-id="525350313385922560" height="380" width="100%">Tweets by @DeOlhonosPlanos</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
	</div><!-- .col-3 -->
</div><!-- .tertiary-content -->

<div class="clear"></div>

<?php get_footer(); ?>

<script> markers = <?php echo get_markers_json(); ?>;</script>

