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
	
	
	
			<div class="entry-content pull-left">
			<img src="http://api.tiles.mapbox.com/v3/acaoeducativa.mapadosplanos/<?php echo $custom_fields['lng'][0] . "," . $custom_fields['lat'][0]; ?>,8/150x150.png" />
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'twentytwelve' ), 'after' => '</div>' ) ); ?>
			<h5 class="entry-title-municipio">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h5>
		</div><!-- .entry-content -->

</article><!-- #post -->
