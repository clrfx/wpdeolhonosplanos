<?php
/*
Plugin Name: Download Monitor Page Addon
Plugin URI: http://mikejolley.com/projects/download-monitor/
Description: Adds a [download_page] shortcode for showing off your available downloads, tags and categories.
Version: 1.0.0
Author: Mike Jolley
Author URI: http://mikejolley.com
Requires at least: 3.5
Tested up to: 3.5

	Copyright: © 2013 Mike Jolley.
	License: GNU General Public License v3.0
	License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

/**
 * WP_DLM_Page_Addon class.
 */
class WP_DLM_Page_Addon {

	private $plugin_slug = '';
	private $api_url = 'http://mikejolley.com/api/';
	private $page_id = '';

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->plugin_slug = basename( dirname( __FILE__ ) );

		// Actions
		add_action( 'pre_set_site_transient_update_plugins', array( $this, 'check_for_updates' ) );
		add_filter( 'plugins_api', array( $this, 'plugin_api_call' ), 10, 3 );
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );
		add_filter( 'query_vars', array( $this, 'add_query_vars') );
		add_action( 'init', array( $this, 'add_endpoint') );
		add_action( 'parse_request', array( $this, 'parse_request') );
		add_filter( 'the_title', array( $this, 'change_the_title' ) );

		// Activation
		register_activation_hook( __FILE__, array( $this, 'add_endpoint' ), 10 );
		register_activation_hook( __FILE__, 'flush_rewrite_rules', 11 );

		// Shortcodes
		add_shortcode( 'download_page', array( $this, 'download_page' ) );
	}

	/**
	 * Check for plugin updates
	 */
	public function check_for_updates( $checked_data ) {
		global $wp_version;

		if ( empty( $checked_data->checked ) )
			return $checked_data;

		$args = array(
			'slug'    => $this->plugin_slug,
			'version' => $checked_data->checked[ $this->plugin_slug . '/' . $this->plugin_slug .'.php' ],
		);

		$request_string = array(
			'body' => array(
				'action'  => 'basic_check',
				'request' => serialize( $args ),
				'api-key' => md5( get_bloginfo( 'url' ) )
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);

		// Start checking for an update
		$raw_response = wp_remote_post( $this->api_url, $request_string );

		if ( ! is_wp_error( $raw_response ) && ( $raw_response['response']['code'] == 200 ) )
			$response = unserialize( $raw_response['body'] );

		if ( is_object( $response ) && ! empty( $response ) ) // Feed the update data into WP updater
			$checked_data->response[ $this->plugin_slug . '/' . $this->plugin_slug .'.php'] = $response;

		return $checked_data;
	}

	/**
	 * Take over the Plugin info screen
	 */
	public function plugin_api_call( $def, $action, $args ) {
		global $wp_version;

		if ( ! isset( $args->slug ) || ( $args->slug != $this->plugin_slug ) )
			return false;

		// Get the current version
		$plugin_info     = get_site_transient('update_plugins');
		$current_version = $plugin_info->checked[ $this->plugin_slug . '/' . $this->plugin_slug .'.php' ];
		$args->version   = $current_version;

		$request_string = array(
			'body' => array(
				'action'  => $action,
				'request' => serialize( $args ),
				'api-key' => md5( get_bloginfo( 'url' ) )
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);

		$request = wp_remote_post( $this->api_url, $request_string );

		if ( is_wp_error( $request ) ) {
			$res = new WP_Error( 'plugins_api_failed', __( 'An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>' ), $request->get_error_message() );
		} else {
			$res = unserialize( $request['body'] );

			if ($res === false)
				$res = new WP_Error( 'plugins_api_failed', __( 'An unknown error occurred' ), $request['body'] );
		}

		return $res;
	}

	/**
	 * Localisation
	 *
	 * @access private
	 * @return void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'dlm_page_addon', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * frontend_scripts function.
	 *
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {
		wp_enqueue_style( 'dlm-page-addon-frontend', $this->plugin_url() . '/assets/css/page.css' );
	}

	/**
	 * Get the plugin url
	 *
	 * @access public
	 * @return string
	 */
	public function plugin_url() {
		return plugins_url( basename( plugin_dir_path(__FILE__) ), basename( __FILE__ ) );
	}

	/**
	 * Get the plugin path
	 *
	 * @access public
	 * @return string
	 */
	public function plugin_path() {
		return plugin_dir_path( __FILE__ );
	}

	/**
	 * add_endpoint function.
	 *
	 * @access public
	 * @return void
	 */
	public function add_endpoint() {
		add_rewrite_endpoint( 'download-tag', EP_PAGES );
		add_rewrite_endpoint( 'download-category', EP_PAGES );
		add_rewrite_endpoint( 'download-info', EP_PAGES );
	}

	/**
	 * add_query_vars function.
	 *
	 * @access public
	 * @return void
	 */
	public function add_query_vars( $vars ) {
		$vars[] = 'download-tag';
		$vars[] = 'download-category';
		$vars[] = 'download-info';
		return $vars;
	}

	/**
	 * Listen for download page requests.
	 *
	 * @access public
	 * @return void
	 */
	public function parse_request() {
		global $wp, $wpdb;

		if ( ! empty( $_GET[ 'download-tag' ] ) )
			$wp->query_vars[ 'download-tag' ] = $_GET[ 'download-tag' ];
		if ( ! empty( $_GET[ 'download-category' ] ) )
			$wp->query_vars[ 'download-category' ] = $_GET[ 'download-category' ];
		if ( ! empty( $_GET[ 'download-info' ] ) )
			$wp->query_vars[ 'download-info' ] = $_GET[ 'download-info' ];
	}

	/**
	 * Include a template file and expand args
	 * @param  string $name
	 * @param  array $args
	 */
	private function get_template_file( $name, $args = array() ) {
		extract( $args );

		if ( file_exists( get_stylesheet_directory() . '/download-monitor/' . $name ) )
			include( get_stylesheet_directory() . '/download-monitor/' . $name );
		else
			include( 'templates/' . $name );
	}

	/**
	 * Get the endpoint link for a tag (to display on the page addon)
	 * @param  object $tag
	 * @return string
	 */
	public function get_tag_link( $tag ) {
		if ( get_option( 'permalink_structure' ) ) {
			$link = trailingslashit( get_permalink( $this->page_id ) ) . 'download-tag/' . $tag->slug . '/';
		} else {
			$link = add_query_arg( 'download-tag', $tag->slug );
		}

		return esc_url( $link );
	}

	/**
	 * Get the endpoint link for a category (to display on the page addon)
	 * @param  object $tag
	 * @return string
	 */
	public function get_category_link( $cat ) {
		if ( get_option( 'permalink_structure' ) ) {
			$link = trailingslashit( get_permalink( $this->page_id ) ) . 'download-category/' . $cat->slug . '/';
		} else {
			$link = add_query_arg( 'download-category', $cat->slug );
		}

		return esc_url( $link );
	}

	/**
	 * Get the endpoint link for a download (to display on the page addon)
	 * @param  object $tag
	 * @return string
	 */
	public function get_download_info_link( $dlm_download ) {
		if ( get_option( 'permalink_structure' ) ) {
			$link = trailingslashit( get_permalink( $this->page_id ) ) . 'download-info/' . $dlm_download->post->post_name . '/';
		} else {
			$link = add_query_arg( 'download-info', $dlm_download->post->post_name );
		}

		return esc_url( $link );
	}

	/**
	 * Change the post title
	 *
	 * @param  string $title
	 * @return string
	 */
	public function change_the_title( $title ) {
		global $post, $wp, $wpdb;

		if ( is_main_query() && in_the_loop() && is_page() && strstr( $post->post_content, '[download_page' ) && $title == $post->post_title ) {

			if ( ! empty( $wp->query_vars[ 'download-category' ] ) ) {
				$term = get_term_by( 'slug', sanitize_title( $wp->query_vars[ 'download-category' ] ), 'dlm_download_category' );

				$title = '<a href="' . get_permalink( $this->page_id ) . '">' . $title . '</a>';

				if ( ! is_wp_error( $term ) ) {
					$titles[] = ' &gt; ' . $term->name . ' (' . $term->count . ')';
					while ( $term->parent > 0 ) {
						$term = get_term_by( 'id', $term->parent, 'dlm_download_category' );
						$titles[] = ' &gt; <a href="' . $this->get_category_link( $term ) . '">' . $term->name . '</a> (' . $term->count . ')';
					}
					$titles = array_reverse( $titles );
					$title .= implode( '', $titles );
				}
			}

			elseif ( ! empty( $wp->query_vars[ 'download-tag' ] ) ) {
				$term = get_term_by( 'slug', sanitize_title( $wp->query_vars[ 'download-tag' ] ), 'dlm_download_tag' );

				$title = '<a href="' . get_permalink( $this->page_id ) . '">' . $title . '</a>';

				if ( ! is_wp_error( $term ) )
					$title .= ' &gt; ' . $term->name . ' (' . $term->count . ')';
			}

			elseif ( ! empty( $wp->query_vars[ 'download-info' ] ) ) {
				$download_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_name = '%s' AND post_type = 'dlm_download' AND post_status = 'publish';", sanitize_title( $wp->query_vars[ 'download-info' ] ) ) );
				$dlm_download = new DLM_download( $download_id );
				$title = $dlm_download->get_the_title();
			}

			elseif( ! empty( $_GET['download_search'] ) ) {
				$title = '<a href="' . get_permalink( $this->page_id ) . '">' . $title . '</a>';
				$title .= ' &gt; ' . sprintf( __( 'Searching for "%s"', 'dlm_page_addon' ), sanitize_text_field( $_GET['download_search'] ) );
			}
		}

		return $title;
	}

	/**
	 * The download page shortcode
	 *
	 * @param  array $args
	 * @return string
	 */
	public function download_page( $args = array() ) {
		global $post, $wp;

		$this->page_id = $post->ID;

		ob_start();

		if ( ! empty( $wp->query_vars[ 'download-category' ] ) ) {
			$this->download_term( $wp->query_vars[ 'download-category' ], 'dlm_download_category', $args );
		}

		elseif ( ! empty( $wp->query_vars[ 'download-tag' ] ) ) {
			$this->download_term( $wp->query_vars[ 'download-tag' ], 'dlm_download_tag', $args );
		}

		elseif ( ! empty( $wp->query_vars[ 'download-info' ] ) ) {
			$this->download_info( $wp->query_vars[ 'download-info' ], $args );
		}

		elseif( ! empty( $_GET['download_search'] ) ) {
			$this->search_results( sanitize_text_field( $_GET['download_search'] ), $args );
		}

		else {

			extract( shortcode_atts( array(
				'format'          => 'pa',
				'show_search'     => 'true',
				'show_featured'   => 'true',
				'show_tags'       => 'true',
				'featured_limit'  => '4',
				'featured_format' => 'pa-thumbnail',
				'category_limit'  => '4',
				'front_orderby'   => 'download_count'
			), $args ) );

			$show_search   = ( $show_search === 'true' );
			$show_featured = ( $show_featured === 'true' );
			$show_tags     = ( $show_tags === 'true' );
			$meta_key      = '';

			switch ( $front_orderby ) {
				case 'title' :
				default :
					$order = 'asc';
				break;
				case 'download_count' :
					$order         = 'desc';
					$front_orderby = 'meta_value_num';
					$meta_key      = '_download_count';
				break;
				case 'date' :
					$order = 'desc';
				break;
			}

			if ( $show_search )
				$this->get_template_file( 'search-downloads.php' );

			if ( $show_featured ) {
				$downloads = new WP_Query( apply_filters( 'dlm_page_addon_featured_query_args', array(
			    	'post_type'      => 'dlm_download',
			    	'posts_per_page' => $featured_limit,
			    	'no_found_rows'  => 1,
			    	'post_status'    => 'publish',
			    	'orderby'        => $front_orderby,
				    'order'          => $order,
				    'meta_key'       => $meta_key,
			    	'meta_query'     => array(
			    		array(
			    			'key'   => '_featured',
			    			'value' => 'yes'
			    		)
			    	)
			  	) ) );

				if ( $downloads->have_posts() )
			  		$this->get_template_file( 'featured-downloads.php', array( 'downloads' => $downloads, 'format' => $featured_format ) );
			  }

		  	if ( $show_tags ) {
		  		$tags = get_terms( 'dlm_download_tag', apply_filters( 'dlm_page_addon_get_tag_args', array( 'orderby' => 'count', 'order' => 'DESC' ) ) );

				if ( ! empty( $tags ) && ! is_wp_error( $tags ) ) {

					foreach ( $tags as $key => $tag ) {
						$tags[ $key ]->link = $this->get_tag_link( $tag );
						$tags[ $key ]->id = $tag->term_id;
					}

					$this->get_template_file( 'download-tags.php', array( 'tags' => $tags ) );
				}
		  	}

		  	// Categories
			$categories = get_terms( 'dlm_download_category', apply_filters( 'dlm_page_addon_get_category_args', array(
			    'orderby'       => 'name',
			    'order'         => 'ASC',
			    'hide_empty'    => true,
			    'parent'        => 0
			) ) );

			if ( $categories ) {
				echo '<div class="download-monitor-categories">';
				foreach ( $categories as $category ) {
					$downloads = new WP_Query( apply_filters( 'dlm_page_addon_category_query_args', array(
				    	'post_type'      => 'dlm_download',
				    	'posts_per_page' => $category_limit,
				    	'no_found_rows'  => 1,
				    	'post_status'    => 'publish',
				    	'orderby'        => $front_orderby,
				    	'order'          => $order,
				    	'meta_key'       => $meta_key,
				    	'tax_query'      => array(
			    			array(
								'taxonomy' => 'dlm_download_category',
								'field'    => 'slug',
								'terms'    => $category->slug,
			    			)
			    		)
				  	) ) );

				  	if ( $downloads->have_posts() )
		  				$this->get_template_file( 'download-categories.php', array( 'category' => $category, 'downloads' => $downloads, 'format' => $format ) );
				}
				echo '</div>';
			}

		}

		return '<div id="download-page">' . ob_get_clean() . '</div><!-- Download Page powered by WordPress Download Monitor (http://mikejolley.com) -->';
	}

	/**
	 * Show a download's info page
	 *
	 * @param  string $slug
	 * @param  array $args
	 */
	public function download_info( $slug, $args ) {
		global $wpdb, $download_monitor;

		$download_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM {$wpdb->posts} WHERE post_name = '%s' AND post_type = 'dlm_download' AND post_status = 'publish';", sanitize_title( $slug ) ) );
		$download    = get_post( $download_id );

		setup_postdata( $download );

		$download_monitor->get_template_part( 'content-download', 'pa-single', $this->plugin_path() . 'templates/' );

		wp_reset_postdata();
	}

	/**
	 * Show a term page
	 *
	 * @param  string $slug
	 * @param  string $taxonomy
	 * @param  array $args
	 */
	public function download_term( $slug, $taxonomy, $args ) {
		global $wp_query, $download_monitor;

		$term = get_term_by( 'slug', $slug, $taxonomy );

		if ( is_wp_error( $term ) || ! $term )
			return;

		extract( shortcode_atts( array(
			'posts_per_page'  => '20',
			'format'          => 'pa',
			'default_orderby' => 'title',
		), $args ) );

		$dlpage          = ! empty( $_GET['dlpage'] ) ? $_GET['dlpage'] : 1;
		$current_orderby = ! empty( $_GET['orderby'] ) ? sanitize_text_field( $_GET['orderby'] ) : $default_orderby;
		$meta_key        = '';

		switch ( $current_orderby ) {
			case 'title' :
			default :
				$order = 'asc';
			break;
			case 'download_count' :
				$order           = 'desc';
				$current_orderby = 'meta_value_num';
				$meta_key        = '_download_count';
			break;
			case 'date' :
				$order = 'desc';
			break;
		}

		$args = apply_filters( 'dlm_page_addon_term_query_args', array(
    		'post_status' 	 => 'publish',
    		'post_type'      => 'dlm_download',
    		'posts_per_page' => $posts_per_page,
    		'offset'         => $posts_per_page * ( $dlpage - 1 ),
    		'orderby' 		 => $current_orderby,
    		'order'          => $order,
    		'meta_key'       => $meta_key,
    		'tax_query'      => array(
    			array(
					'taxonomy' => $taxonomy,
					'field'    => 'slug',
					'terms'    => $slug
    			)
    		)
    	) );

		$wp_query = new WP_Query( $args );

		$this->get_template_file( 'subcategories.php', array( 'term' => $term, 'taxonomy' => $taxonomy ) );
		$this->get_template_file( 'orderby.php', array( 'current_orderby' => $current_orderby ) );
		$this->get_template_file( 'download-list.php', array( 'format' => $format ) );
		$this->get_template_file( 'pagination.php' );

		wp_reset_query();
	}

	/**
	 * Show search results
	 *
	 * @param  string $search
	 * @param  array $args
	 */
	public function search_results( $search, $args ) {
		global $wp_query, $download_monitor;

		extract( shortcode_atts( array(
			'posts_per_page' => '20',
			'format'         => 'pa'
		), $args ) );

		$dlpage         = ! empty( $_GET['dlpage'] ) ? $_GET['dlpage'] : 1;

		$args = apply_filters( 'dlm_page_addon_search_query_args', array(
    		'post_status' 	 => 'publish',
    		'post_type'      => 'dlm_download',
    		'orderby'        => 'post__in',
    		'order'          => 'asc',
    		'posts_per_page' => $posts_per_page,
    		'offset'         => $posts_per_page * ( $dlpage - 1 ),
    		's'              => $search
    	) );

		$wp_query = new WP_Query( $args );

		$this->get_template_file( 'download-list.php', array( 'format' => $format ) );
		$this->get_template_file( 'pagination.php' );

		wp_reset_query();
	}
}

$GLOBALS['dlm_page_addon'] = new WP_DLM_Page_Addon();