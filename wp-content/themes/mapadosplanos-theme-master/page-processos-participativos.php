<?php
/**
 * Template Name: Processos Participativos
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
	
	

<div id="title-querys" class="download">


<div class="triangulo triangulo-downloads"></div><h1 class="downloads"><a href="<?php echo esc_url( home_url( '/category/downloads/' ) ); ?>">Downloads</a></h1>



</div>

<div id="query-posts" class="downloads">


	<?php

			if ( query_posts( array ( 'cat' => '-59','post_status' => 'publish', 'posts_per_page' => 2 )) ) while ( have_posts() ) : the_post(); 

	?>

		<div id="cada-download" <?php post_class(); ?>>

			

				<a class="img-destacada-download" href="<?php echo get_permalink(); ?>">

				<?php 

				if ( has_post_thumbnail() ) {

					the_post_thumbnail('category-sticky', array('class'	=> "category-image"));

				}

				else {

					echo '<img class="category-image" src="' . get_bloginfo( 'stylesheet_directory' ) . '/img/thumbnail-default-large.png" />';

				} 

				?>

				</a>



			<span class="entry-title-download-query"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></span>



				

			<div class="entry-content-download">



				<?php echo excerpt( 13 ); //Imprime 13 palavras ?> ...


						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
				
					
				<div class="entry-utility">

						<?php edit_post_link( __('Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>

				</div><!-- .entry-utility -->
				

				</div><!-- .entry-content-download -->

				<a href="<?php the_permalink(); ?>" rel="bookmark" class="download downloads-bg"><span class="botao-download">DOWNLOAD</span>
			</a>
			

		</div><!-- #cada-download -->



<?php endwhile; // end of the loop. ?>

<?php wp_reset_query(); // reset query ?>

</div>

<?php get_downloads( 'limit=2' ); ?>

<?php get_footer(); ?>
