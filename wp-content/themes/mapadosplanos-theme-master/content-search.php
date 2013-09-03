<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
	<div style="display:none;">
	<?php 
	    global $custom_fields;
	    $custom_fields = get_post_custom(the_ID());
	?></div>

	<article id="post-<?php the_ID(); ?>" <?php post_class('media'); ?>>
	

		<header class="entry-header media-body">
			<?php the_post_thumbnail(); ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>

			<?php if ( comments_open() ) : ?>
				<div class="comments-link">
					<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'twentytwelve' ) . '</span>', __( '1 Reply', 'twentytwelve' ), __( '% Replies', 'twentytwelve' ) ); ?> <strong>&middot;</strong> <span class="anexos"> 
					<?php
              if( function_exists( 'attachments_get_attachments' ) )
              {
                $attachments = attachments_get_attachments();
                $total_attachments = count( $attachments );
                if ($total_attachments == 0) {
                echo "Nenhum anexo";
                } else {
                	echo $total_attachments . " anexos";
                	
                }
             } ?></span>

		<!-- FIM DOS ATTACHMENTS -->
				</div><!-- .comments-link -->
			<?php endif; // comments_open() ?>
			
		<div class="entry-summary">
			<?php  the_excerpt(); ?>
		</div><!-- .entry-summary -->

		</header><!-- .entry-header -->


		

</article><!-- #post -->
