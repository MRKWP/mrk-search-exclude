<?php
/**
 * Used for the admin column functions.
 */

namespace MRK_Search_Exclude\Admin;

use MRK_Search_Exclude\Base\BaseController;

/**
 * Class for Bulk Edit Options
 */
class Columns extends BaseController {

	/**
	 * Standard register function. Called from Init to register the actions.
	 *
	 * @return void
	 */
	public function register() {
		add_filter( 'manage_posts_columns', array( $this, 'add_column' ) );
		add_filter( 'manage_pages_columns', array( $this, 'add_column' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'add_column_value' ), 10, 2 );
		add_action( 'manage_pages_custom_column', array( $this, 'add_column_value' ), 10, 2 );
		add_action( 'quick_edit_custom_box', array( $this, 'add_quick_edit_custom_box' ) );
	}

	/**
	 * Used for the quick edit custom box.
	 *
	 * @param [type] $column_name column name.
	 * @return void
	 */
	public function add_quick_edit_custom_box( $column_name ) {
		if ( 'search_exclude' === $column_name ) {
			$this->view( 'quick-edit' );
		}
	}

	/**
	 * Add column for search excluded.
	 *
	 * @param [type] $columns name of columns.
	 * @return $columns columns returned with search excluded.
	 */
	public function add_column( $columns ) {
		$columns['search_exclude'] = esc_html__( 'Search Excluded', 'search-exclude' );
		return $columns;
	}

	/**
	 * Add value to the column value for search excluded.
	 *
	 * @param [type] $column_name name of column.
	 * @param [type] $post_id post ID for column row entry.
	 * @return void
	 */
	public function add_column_value( $column_name, $post_id ) {
		if ( 'search_exclude' === $column_name ) {
			$this->view(
				'column-cell',
				array(
					'exclude' => $this->is_excluded( $post_id ),
					'post_id' => $post_id,
				)
			);
		}
	}
}
