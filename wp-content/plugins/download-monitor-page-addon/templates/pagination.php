<?php
global $wp_query;

echo paginate_links( array(
	'base'    => add_query_arg( 'dlpage', '%#%' ),
	'format'  => '?dlpage=%#%',
	'current' => max( 1, ( isset( $_GET['dlpage'] ) ? $_GET['dlpage'] : 1 ) ),
	'total'   => $wp_query->max_num_pages,
	'type'    => 'list'
) );