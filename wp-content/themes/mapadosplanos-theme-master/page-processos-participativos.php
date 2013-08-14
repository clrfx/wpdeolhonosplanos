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
	
	

<div id="title-querys">


<div class="triangulo triangulo-downloads"></div><h1 class="downloads"><a href="<?php echo esc_url( home_url( '/category/downloads/' ) ); ?>">Downloads</a></h1>



</div>

<div id="query-posts" class="downloads">


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


						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
				
					
				<div class="entry-utility">

						<?php edit_post_link( __('Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>

				</div><!-- .entry-utility -->
				

				</div><!-- .entry-content -->



			<div class="entry-meta">

			<?php /*

			$category = get_the_category(); 

			if($category[0]){

			echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';

			} */ ?>

			</div>
			
			<a href="<?php the_permalink(); ?>" rel="bookmark" class="leia-mais downloads-bg"><span class="mais">+</span>
			</a>
				

		</div><!-- #cada-post -->



<?php endwhile; // end of the loop. ?>

<?php wp_reset_query(); // reset query ?>



</div>


<?php get_footer(); ?>
