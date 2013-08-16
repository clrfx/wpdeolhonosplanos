<?php
/**
 * Template Name: Downloads
 */

get_header('resume'); ?>

	<div id="primary">
		<div id="content" role="main">
		
		
		<div id="title-querys" class="download">

<div class="triangulo triangulo-downloads"></div><h1 class="downloads"><a href="<?php echo esc_url( home_url( '/category/downloads/' ) ); ?>">Downloads</a></h1>

</div>

<div id="query-posts" class="downloads">

<?php
$args = array(
	    	'post_type'      => 'dlm_download',
			'posts_per_page' => '6',
	    	'no_found_rows'  => 1,
	    	'post_status'    => 'publish',
	    	'meta_query'     => array()
	  	);
		
$downloads = new WP_Query( $args );
if ( $downloads->have_posts() ) : ?>

<?php while ( $downloads->have_posts() ) : $downloads->the_post(); ?>

		<div id="cada-download" <?php post_class(); ?>>

				<a class="img-destacada-download" href="<?php echo get_permalink(); ?>">
					<?php $dlm_download->the_image( 'downloads' ); ?>
				</a>

			<span class="entry-title-download-query"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php $dlm_download->the_title(); ?></a></span>

			<div class="entry-content-download">
				<?php $dlm_download->the_short_description(); ?>
			</div><!-- .entry-content-download -->

				<a href="<?php $dlm_download->the_download_link(); ?>" rel="bookmark" class="download downloads-bg">
                	<span class="botao-download">DOWNLOAD</span>
				</a>

		</div><!-- #cada-download -->

			<?php endwhile; // end of the loop. ?>
		
		<?php endif;

		wp_reset_postdata();
	
		?><!-- Fim Loop -->

</div>


		</div><!-- #content -->
	</div><!-- #primary -->
	
	
<?php get_footer(); ?>
