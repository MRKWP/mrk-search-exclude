<?php
/**
 * Used for the Metabox in the sidebar.
 */

namespace MRK_Search_Exclude\Admin;

use MRK_Search_Exclude\Base\BaseController;

/**
 * Class for Metabox to be added to sidebar.
 */
class Metabox extends BaseController {

	/**
	 * Standard register function. Called from Init to register the actions.
	 *
	 * @return void
	 */
	public function register() {
			add_action( 'post_updated', array( $this, 'post_save' ) );
			add_action( 'edit_attachment', array( $this, 'post_save' ) );
			add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
	}

	/**
	 * Add metabox to sidebar.
	 *
	 * @return void
	 */
	public function add_meta_box() {
		$current_screen = get_current_screen();
		/* Do not show meta box on service pages */
		if ( empty( $current_screen->post_type ) ) {
			return;
		}
		add_meta_box( 'sep_metabox_id', 'Search Exclude', array( $this, 'metabox' ), null, 'side' );
	}

	/**
	 * Display Metabox.
	 *
	 * @param [type] $post post object for metabox.
	 * @return void
	 */
	public function metabox( $post ) {
		wp_nonce_field( 'sep_metabox_nonce', 'metabox_nonce' );
		$this->view( 'metabox', array( 'exclude' => $this->is_excluded( $post->ID ) ) );
	}

	/**
	 * When post is saved hook into this for additonal option save.
	 *
	 * @param [type] $post_id ID for post item.
	 * @return $post_id post ID.
	 */
	public function post_save( $post_id ) {
		if ( ! isset( $_POST['sep'] ) ) {
			return $post_id;
		}
		$sep     = $_POST['sep'];
		$exclude = ( isset( $sep['exclude'] ) ) ? filter_var( $sep['exclude'], FILTER_VALIDATE_BOOLEAN ) : false;
		$this->save_post_id_to_search_exclude( $post_id, $exclude );
		return $post_id;
	}
}
