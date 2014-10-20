<?php
/**
 * Find the first video occurence in a post that has the 'video' format
 * and create a iframe for it
 *
 * @todo Find a way to use it strictly with registered video providers
 * 
 */
function mapadosplanos_the_video() {

	global $post;

	// Get all the post meta
	$post_meta = get_post_custom();

	foreach ( $post_meta as $key => $value ) {
		// Search for _oembed_ keys
		$pos = strpos($key, '_oembed_');
		if ( $pos !== false ) {

			// Remove predefined proportions
			$v = preg_replace( '/(width|height)="\d*"\s/', "", $value );
			echo $v[0];

			// We just want the first one
			break;
		}					
	}
}