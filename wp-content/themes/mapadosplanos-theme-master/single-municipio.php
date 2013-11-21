<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header('sem-main'); ?>


			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'municipio' ); ?>
				
				<?php comments_template( '', true ); ?>
			
			<?php endwhile; // end of the loop. ?>

		</div><!-- #content.site-content -->
				
<?php get_template_part( 'barra-search-munic'); ?>

<?php get_footer(); ?>
