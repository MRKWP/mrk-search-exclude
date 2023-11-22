<?php
/**
 * Used for the Bulk Edit Options
 */

namespace MRK_Search_Exclude\Admin;

use MRK_Search_Exclude\Base\BaseController;

/**
 * Class for Bulk Edit Options
 */
class BulkEdit extends BaseController {

	/**
	 * Standard register function. Called from Init to register the actions.
	 *
	 * @return void
	 */
	public function register() {
		/**
		* Add bulk edit actions
		*/
		foreach ( get_post_types() as $post_type ) {
			add_action( 'admin_notices', array( $this, 'bulk_action_notices' ) );

			add_filter( "bulk_actions-edit-$post_type", array( $this, 'bulk_edit' ) );
			add_filter( "handle_bulk_actions-edit-$post_type", array( $this, 'bulk_action_handler' ), 10, 3 );
		}

		add_action( 'admin_notices', array( $this, 'bulk_action_notices' ) );
	}

	/**
	 * Used for the display of admin notices.
	 *
	 * @return void
	 */
	public function bulk_action_notices() {

		if ( empty( $_GET['se_saved'] ) ) {
			return;
		}

		$count   = (int) $_GET['se_saved'];
		$message = sprintf(
			// phpcs:ignore
			_n(
				'%d item updated.',
				'%d items updated.',
				$count
			),
			$count
		);
		?>
		<div class="notice notice-success is-dismissible">
			<p><?php echo esc_html( $message ); ?></p>
		</div>
		<?php
	}

	/**
	 * Used for the bulk action handler.
	 *
	 * @param [type] $redirect redirect URL.
	 * @param [type] $doaction what action.
	 * @param [type] $object_ids object or post ids.
	 * @return $redirect redirect is returned.
	 */
	public function bulk_action_handler( $redirect, $doaction, $object_ids ) {
		$redirect = remove_query_arg(
			array( 'se_saved' ),
			$redirect
		);

		if ( 'se_show' !== $doaction && 'se_hide' !== $doaction ) {
			return $redirect;
		}

		$exclude = ( 'se_hide' === $doaction );
		$this->save_post_ids_to_search_exclude( $object_ids, $exclude );

		$redirect = add_query_arg(
			'se_saved', /* just a parameter for URL */
			count( $object_ids ), /* how many posts have been selected */
			$redirect
		);
		return $redirect;
	}

	/**
	 * Bulk edit function for hide and show in search.
	 *
	 * @param [type] $bulk_array array from option.
	 * @return $bulk_array array returned of bulk item ids.
	 */
	public function bulk_edit( $bulk_array ) {
		$bulk_array['se_hide'] = esc_html__( 'Hide from Search', 'search-exclude' );
		$bulk_array['se_show'] = esc_html__( 'Show in Search', 'search-exclude' );
		return $bulk_array;
	}
}
