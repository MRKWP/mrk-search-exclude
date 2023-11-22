<?php
/**
 * Used for the Admin page with options MRK Search Exclude.
 */

namespace MRK_Search_Exclude\Admin;

use MRK_Search_Exclude\Base\BaseController;

/**
 * Class for all option management for the plugin
 */
class Options extends BaseController {

	/**
	 * Standard register function. Called from Init to register the actions.
	 *
	 * @return void
	 */
	public function register() {
		/**
		* Admin menu
		*/
		add_action( 'admin_init', array( $this, 'save_options' ) );
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Create the Admin Menu
	 *
	 * @return void
	 */
	public function admin_menu() {
		add_options_page(
			'Search Exclude',
			'Search Exclude',
			'manage_options',
			'search_exclude',
			array( $this, 'options' )
		);
	}

	/**
	 * Save Options used to save the search exclude submit post.
	 *
	 * @return void
	 */
	public function save_options() {
		if ( ! isset( $_POST['search_exclude_submit'] ) ) {
			return;
		}
		$sep_exclude = isset( $_POST['sep_exclude'] ) ? $_POST['sep_exclude'] : array();

		check_admin_referer( 'search_exclude_submit' );

		$this->check_permissions();

		$excluded = $this->filter_posts_ids( $sep_exclude );
		$this->save_excluded( $excluded );
	}


	/**
	 * Public function to show the view page for the excluded posts.
	 * Renders the View function to show the listed posts.
	 *
	 * @return void
	 */
	public function options() {
		$excluded = $this->get_excluded();
		$query    = new \WP_Query(
			array(
				'post_type'   => 'any',
				'post_status' => 'any',
				'post__in'    => $excluded,
				'order'       => 'ASC',
				'nopaging'    => true,
			)
		);
		$this->view(
			'options',
			array(
				'excluded' => $excluded,
				'query'    => $query,
			)
		);
	}
}
