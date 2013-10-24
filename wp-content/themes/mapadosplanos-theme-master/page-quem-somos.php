<?php
/**
 * Template Name: Quem Somos 
 */

get_header('resume'); ?>

	<div id="primary" class="content-quem-somos">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			
	</div><!-- #primary -->

<?php get_footer(); ?>
