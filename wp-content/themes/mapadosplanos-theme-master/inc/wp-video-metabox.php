<?php

/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function mapadosplanos_add_meta_box() {

	$screens = array( 'post' );

	foreach ( $screens as $screen ) {

		add_meta_box(
			'mapadosplanos_video',
			__( 'Vídeo do YouTube em destaque', 'mapadosplanos' ),
			'mapadosplanos_meta_box_callback',
			$screen,
			'normal',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'mapadosplanos_add_meta_box' );

/**
 * Prints the box content.
 * 
 * @param WP_Post $post The object for the current post/page.
 */
function mapadosplanos_meta_box_callback( $post ) {

	// Add an nonce field so we can check for it later.
	wp_nonce_field( 'mapadosplanos_meta_box', 'mapadosplanos_meta_box_nonce' );

	/*
	 * Use get_post_meta() to retrieve an existing value
	 * from the database and use the value for the form.
	 */
	$value = get_post_meta( $post->ID, '_featured_video', true );

	echo '<p><label for="mapadosplanos_new_field">';
	_e( 'ID do vídeo que estará em destaque na capa. Exemplo: no endereço <em>https://www.youtube.com/watch?v=ioKRBe3KVVY</em>, <strong><em>ioKRBe3KVVY</em></strong> é o ID do vídeo.', 'mapadosplanos' );
	echo '</label></p>';
	echo '<input type="text" id="mapadosplanos_new_field" name="mapadosplanos_new_field" value="' . esc_attr( $value ) . '" size="25" class="widefat" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function mapadosplanos_save_meta_box_data( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['mapadosplanos_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['mapadosplanos_meta_box_nonce'], 'mapadosplanos_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['mapadosplanos_new_field'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['mapadosplanos_new_field'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_featured_video', $my_data );
}
add_action( 'wp_insert_post', 'mapadosplanos_save_meta_box_data' );