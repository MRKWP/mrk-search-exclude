<?php
/**
 * Used for the Admin page with options MRK Search Exclude.
 */

namespace MRK_Search_Exclude\Admin;

use MRK_Search_Exclude\Base\BaseController;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

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
		add_action( 'carbon_fields_register_fields', array( $this, 'init' ) );
	}

	/**
	 * Init function linked to action hook inside register function.
	 *
	 * @return void
	 */
	public function init() {
		// Add Options Page.

		$mrk_search_exclude_submenu = Container::make( 'theme_options', __( 'MRK Search Exclude' ) )
		->set_page_parent( 'options-general.php' )
		->add_fields(
			array(
				
			)
		);
	}

}
