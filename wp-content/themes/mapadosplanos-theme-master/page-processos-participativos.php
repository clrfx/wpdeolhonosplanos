<?php
/**
 * Template Name: Processos Participativos
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
	
	

<div id="title-querys" class="download">


<div class="triangulo triangulo-downloads"></div><h1 class="downloads"><a href="<?php echo esc_url( home_url( '/downloads/' ) ); ?>">Downloads</a></h1>



</div>

<div id="query-posts" class="downloads">

<?php
$args = array(
	    	'post_type'      => 'dlm_download',
	    	'posts_per_page' => '2',
	    	'no_found_rows'  => 1,
	    	'post_status'    => 'publish',
	    	'meta_query'     => array()
	  	);
		
$downloads = new WP_Query( $args );
if ( $downloads->have_posts() ) : ?>

<?php while ( $downloads->have_posts() ) : $downloads->the_post(); ?>

		<div id="cada-download" <?php post_class(); ?>>

				<a class="img-destacada-download" href="<?php $dlm_download->the_download_link(); ?>">
					<?php $dlm_download->the_image( 'downloads' ); ?>
				</a>

			<span class="entry-title-download-query"><a href="<?php $dlm_download->the_download_link(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyten' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php $dlm_download->the_title(); ?></a></span>

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

<?php get_footer(); ?>
