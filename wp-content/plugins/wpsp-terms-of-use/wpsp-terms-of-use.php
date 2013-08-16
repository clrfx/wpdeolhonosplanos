<?php
/*
Plugin Name: WPSP - Terms of Use
Plugin URI: http://wp-simple-plugins.com/
Description: Show the Terms of Use of the website on the registration page.
Version: 1.0
Author: WP Simple Plugins
Author URI: http://wp-simple-plugins.com/

/*
Copyright 2011 WP Simple Plugins

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/* When the plugin is activated run the activation hook */
register_activation_hook(__FILE__, 'tou_get_version');

/* We need to get the version of WordPress the user is using */
function tou_get_version() {
	global $wp_version;
	if (version_compare($wp_version, '3.1', '<')) {
		exit("<div style='font-size: 13px; font-family: 'HelveticaNeue-Light','Helvetica Neue Light','Helvetica Neue',sans-serif;'><strong>Attention:</strong> This plugin will not work with your version of WordPress.</div>");
	}
}

/* Register some Actions */
add_action('admin_menu', 'tou_admin_actions');  

add_action('register_form','show_terms_of_use');

add_action('register_post','check_fields',10,3);

add_action('user_register', 'register_agreement');

add_action('admin_notices', 'tou_admin_notice');

/* Register the Terms of Use options page */
function tou_admin_actions() {  
    add_options_page("WPSP Terms of Use", "WPSP Terms of Use", 1, "wpsp-terms-of-use", "wpsptou_admin");  
} 

/* Create the WP Simple Plugins Terms of Use page */
function wpsptou_admin() { 
remove_action( 'admin_notices', 'tou_admin_notice');
 	echo '<div class="wrap">';
    	echo '<h2>' . __( 'WP Simple Plugins - Terms of Use', 'wpsptou_tou' ) . '</h2>';
    	/* Check to see if the post has been submitted */
		if($_POST['termsofuse']) {
			/* If the page is empty return an error */
			if(empty($_POST['page-dropdown'])) {
				echo '<div class="error"><p><strong>ERROR</strong>: You must select a page.</p></div>';
			} else {	
			/* If not empty add it to wp_options */
			$wpsptou_page = $_POST['page-dropdown'];
			$wpsptou_msg = '1';
			update_option('wpsp_tou', $wpsptou_page);
			update_option('wpsp_tou_msg', $wpsptou_msg);
			echo '<div class="updated"><p><strong>Options Saved.</strong></p></div>';
			}    	
		}
		
		echo '<p>Please select your Terms of Use page.</p>';    	
    	echo '<form method="POST" action="'.admin_url("admin.php?page=wpsp-terms-of-use"). '" id="termsofuse">';

		/* Grab a list of pages and sub pages of the website */
		$wpsp_tou = get_option('wpsp_tou'); 
 			$args = array(
    			'depth'            => 0,
    			'child_of'         => 0,
    			'selected'         => $wpsp_tou,
    			'echo'             => 1,
    			'name'             => 'page-dropdown',
    			'show_option_none'  => '-- Please Select -- ');
    			
		wp_dropdown_pages($args);	    	
		echo '<br /><br /><input name="termsofuse" type="submit" value="Update" class="button-primary">';    	
    	echo '</form>';
    echo '</div>';
    echo '<div id="wpbody">';
    	echo '<div id="wpbody-content">';
    		echo '<div class="wrap">';
    			echo '<h2>Support</h2>';
    			echo '<p>Need help with one of our plugins? Head on over to our <a href="http://www.wp-simple-plugins.com/support/forum/plugin-support/terms-of-use/" target="_blank">support forum</a> today.</p>';
    		echo '</div>';
    		echo '<div class="wrap">';
    			echo '<h2>Donate</h2>';
    			echo '<p>Like our work? Why not support us by making a small donation. All donations go towards future development of our scripts and server costs.';
    			echo '<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="78Z4Z8HYNYSUN">
<input type="image" src="https://www.paypalobjects.com/en_AU/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online.">
<img alt="" border="0" src="https://www.paypalobjects.com/en_AU/i/scr/pixel.gif" width="1" height="1">
</form>
';
    		echo '</div>';
    	echo '</div>';
    echo '</div>';
} 

/* Show the Terms of Use on the Registration page */
function show_terms_of_use() {
	$wpsp_tou = get_option('wpsp_tou'); 
	if(!empty($wpsp_tou)) {
 	$permalink = get_permalink( $wpsp_tou );
	echo '<p><input type="checkbox" name="agree" value="1"> Agree to <a href="'.$permalink.'" target="_blank" title="Click to view our Terms of Use">Terms of Use</a>.<br /><br /></p>';
	}
}

/* Check to see if the User data has been submitted */
function check_fields($login, $email, $errors) { 
   if($_POST['agree'] == '') {
   	global $agree;
   	$errors->add('empty_agree', "<strong>ERROR</strong>: You must Agree to our Terms of Use.");
   } else {
   	$agree = $_POST['agree'];
   }
}

/* If everything goes well add to the users meta data */
function register_agreement($user_id, $password="", $meta=array()) {
	$userdata = array();
	$userdata['ID'] = $user_id;
	wp_update_user($userdata);
	update_usermeta($user_id, 'agree','1');
}

/* Display Attention Message to user until they do the settings for the plugin */
function tou_admin_notice(){
$page_name = $_GET['page'];
	if(get_option('wpsp_tou_msg') == '0') {
		if($page_name == 'wpsp-terms-of-use') { 
		} else {
    echo '<div class="updated">
       <p><strong>Attention:</strong> Please visit the WPSP Terms of Use <a href="'.get_admin_url().'options-general.php?page=wpsp-terms-of-use">Settings</a> page to setup the plugin.</p>
    </div>';
    	}
    }
}

?>