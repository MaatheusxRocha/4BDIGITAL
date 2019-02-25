<?php

/**
 * Define a funcionalidade para serializar a opcao salva na meta box.
 *
 * @package	    Epico
 * @subpackage  Featured metabox helper class
 * @version     1.0.0
 * @since       1.0.0
 *
 */

class Uberstart_Metabox_Helper {

	public function __construct() {
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	public function save_post( $post_id ) {

		if ( $this->user_can_save( $post_id, 'epico-show-featured-nonce', 'epico-show-featured' ) ) {

			if ( isset( $_POST['epico-show-featured'] ) ) {
				update_post_meta( $post_id, 'epico-show-featured', $_POST['epico-show-featured'] );
			} else {
				delete_post_meta( $post_id, 'epico-show-featured' );
			}
		}
	}

	private function user_can_save( $post_id, $nonce, $action ) {

		$is_autosave    = wp_is_post_autosave( $post_id );
		$is_revision    = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], $action ) );

		return ! ( $is_autosave || $is_revision ) && $is_valid_nonce;

	}

}