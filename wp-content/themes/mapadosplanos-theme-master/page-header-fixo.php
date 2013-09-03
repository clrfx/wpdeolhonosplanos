<?php
/**
 * Template Name: Header Fixo
 */

get_header('fixo'); ?>

	<div id="primary">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'page' ); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
			

		</div><!-- #content -->
	</div><!-- #primary -->


<?php get_footer(); ?>
