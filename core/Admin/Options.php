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
		// add_action( 'carbon_fields_register_fields', array( $this, 'init' ) );
		add_action( 'admin_menu', array( $this, 'mrk_search_exclude_submenu' ) );
	}

	/**
	 * Init function linked to action hook inside register function.
	 *
	 * @return void
	 */
	public function init() {
		// Add Options Page.
		Container::make( 'theme_options', __( 'Style Options' ) )
		// ->set_page_parent( 'edit.php?post_type=mrkwp_distributors' )
		->set_page_file( 'mrk___style_options' )
		->add_fields(
			array(
				Field::make( 'separator', 'css_button_separator', __( 'Button Colors' ) ),
				Field::make( 'color', $this->prepend . 'button_background', 'Button Background' )->set_width( 50 ),
			)
		);
	}


	public function mrk_search_exclude_submenu() {
		add_submenu_page(
			'options-general.php',
			'MRK Search Exclude',
			'MRK Search Exclude',
			'administrator',
			'mrk-search-exclude'
		);
	}

}
