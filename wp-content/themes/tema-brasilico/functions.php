<?php

// Adiciona Minhas Opções
 require_once (get_stylesheet_directory() . '/options/admin_options.php');

// Adiciona a função the_excerpt às Páginas
add_post_type_support( 'page', 'excerpt' );

// Remove notificações de update do WP para usuários abaixo do Administrador
global $user_login;
get_currentuserinfo();
if (!current_user_can('update_plugins')) { // checks to see if current user can update plugins
add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
add_filter( 'pre_option_update_core', create_function( '$a', "return null;" ) );
}

// Personaliza o rodapé do admin
function custom_admin_footer() {
        echo 'Desenvolvido com <a href=http://wordpress.org/>WordPress</a> por <a href=http://www.etedesign.com.br>Eté Design e Tecnologia</a>.';
}
add_filter('admin_footer_text', 'custom_admin_footer');

// Remove o Item Editar do menu Aparência
function remove_editor_menu() {
  remove_action('admin_menu', '_add_themes_utility_last', 101);
}

add_action('_admin_menu', 'remove_editor_menu', 1);

// Remove o MetaBox Format dos Posts
add_action( 'admin_menu', 'remove_meta_boxes' );
function remove_meta_boxes() {
    remove_meta_box( 'formatdiv', 'post', 'normal' ); // Post format meta box
}

// Custom login
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background:url('.get_bloginfo('stylesheet_directory').'/images/logo-medio.png) no-repeat scroll center top !important; 
		height: 180px !important; width: 139px !important;  margin-top: -40px !important;  margin-left: 95px !important;
		overflow: hidden;
		}
		body { background-image:url('.get_bloginfo('stylesheet_directory').'/images/bg.jpg) !important; }
		#login { padding: 70px 0 0; }
		
    </style>';
}

add_action('login_head', 'my_custom_login_logo');

// Remove Widgets do Wp-Admin
function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );

// Aqui começa as Functions do Options Theme

/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {

if ( get_stylesheet_directory() == get_stylesheet_directory_uri() ) {

		define('OPTIONS_FRAMEWORK_URL', get_stylesheet_directory() . '/inc/');

		define('OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/inc/');

	} else {

		define('OPTIONS_FRAMEWORK_URL', get_stylesheet_directory() . '/inc/');

		define('OPTIONS_FRAMEWORK_DIRECTORY', get_stylesheet_directory_uri() . '/inc/');

	}
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}

?>