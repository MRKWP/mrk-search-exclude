<?php
/**
 * Base Controller is used as a master class to store various reused functions and data for the Plugin.
 *
 * @packageMRK_Search_Exclude
 *
 * update 1.3.1
 */

namespace MRK_Search_Exclude\Base;

/**
 * Base controller class.
 */
class BaseController {

	/**
	 * The plugin path
	 *
	 * @var [type]
	 */
	public $plugin_path;

	/**
	 * Plugin URL
	 *
	 * @var [type]
	 */
	public $plugin_url;

	/**
	 * Plugin reference for the name of the plugin.
	 *
	 * @var [type]
	 */
	public $plugin;

	/**
	 * List of excluded post IDs.
	 *
	 * @var [type]
	 */
	protected $excluded;

	/**
	 * Construct for Base Controller.
	 */
	public function __construct() {

		$this->plugin_path = plugin_dir_path( dirname( __DIR__, 1 ) );
		$this->plugin_url  = plugin_dir_url( dirname( __DIR__, 1 ) );
		$this->plugin      = plugin_basename( dirname( __DIR__, 2 ) ) . '/mrk-search-exclude.php';

		add_action( 'admin_print_scripts-edit.php', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_style' ) );

		add_filter( 'pre_get_posts', array( $this, 'search_filter' ) );
	}

	/**
	 * Save excluded array to 'sep_exclude' option.
	 *
	 * @param [type] array $excluded array of excluded post IDs.
	 * @return void
	 */
	protected function save_excluded( $excluded ) {
		update_option( 'sep_exclude', $excluded );
		$this->excluded = $excluded;
	}

	/**
	 * Get Excluded items from the get option 'sep_exclude' entry in database.
	 *
	 * @return array excluded post ids.
	 */
	protected function get_excluded() {
		if ( null === $this->excluded ) {
			$this->excluded = get_option( 'sep_exclude' );
			if ( ! is_array( $this->excluded ) ) {
				$this->excluded = array();
			}
		}
		return $this->excluded;
	}

	/**
	 * Function used on activate to setup the options value and save the excluded items.
	 *
	 * @return void
	 */
	public function activate() {
		$excluded = $this->get_excluded();
		if ( empty( $excluded ) ) {
			$this->save_excluded( array() );
		}
	}

	/**
	 * Check if post ID is excluded.
	 *
	 * @param [type] $post_id WP Post ID.
	 * @return boolean
	 */
	protected function is_excluded( $post_id ) {
		return false !== array_search( $post_id, $this->get_excluded(), true );
	}

	/**
	 * Functon to display view file
	 *
	 * @param [type] $view name if view.
	 * @param array  $params option params.
	 * @return void
	 */
	protected function view( $view, $params = array() ) {
		// phpcs:ignore
		extract( $params );
		if ( file_exists( MRK_SEARCH_EXCLUDE_PLUGIN_DIR . 'views/' . $view . '.php' ) ) {
			include MRK_SEARCH_EXCLUDE_PLUGIN_DIR . 'views/' . $view . '.php';
		}
	}

	/**
	 * Save post meta data for specific post id to search exclude.
	 *
	 * @param [type] $post_id post ID to exclude.
	 * @param [type] $exclude boolean to indicate exclusion.
	 * @return void
	 */
	protected function save_post_id_to_search_exclude( $post_id, $exclude ) {
		$this->save_post_ids_to_search_exclude( array( intval( $post_id ) ), $exclude );
	}

	/**
	 * Save multiple post IDs to search exclude.
	 *
	 * @param [type] $post_ids post IDs.
	 * @param [type] $exclude exclude boolean.
	 * @return void
	 */
	public function save_post_ids_to_search_exclude( $post_ids, $exclude ) {
		$exclude  = (bool) $exclude;
		$excluded = $this->get_excluded();

		if ( $exclude ) {
			$excluded = array_unique( array_merge( $excluded, $post_ids ) );
		} else {
			$excluded = array_diff( $excluded, $post_ids );
		}
		$this->save_excluded( $excluded );
	}

	/**
	 * Filter the post IDs
	 *
	 * @param [type] $post_ids array of post IDs.
	 * @return array filtered array of post ids.
	 */
	private function filter_posts_ids( $post_ids ) {
		return array_filter( filter_var( $post_ids, FILTER_VALIDATE_INT, FILTER_FORCE_ARRAY ) );
	}

	/**
	 * Enqueue the scripts for the backend.
	 *
	 * @return void
	 */
	public function enqueue_scripts() {

		$backend = include MRK_SEARCH_EXCLUDE_PLUGIN_DIR . 'build/backend/js/index.asset.php';

		wp_enqueue_script(
			'search-exclude-backend',
			plugins_url( '/build/backend/js/index.js', MRK_SEARCH_EXCLUDE_PLUGIN_FILE ),
			array_merge(
				$backend['dependencies'],
				array( 'inline-edit-post' )
			),
			$backend['version'],
			true
		);
	}

	/**
	 * Enqueue the style for the backend.
	 *
	 * @return void
	 */
	public function enqueue_style() {
		wp_enqueue_style(
			'search-exclude-backend',
			plugins_url( '/build/backend/css/style.css', MRK_SEARCH_EXCLUDE_PLUGIN_FILE ),
			array(),
			MRK_SEARCH_EXCLUDE_PLUGIN_VERSION
		);
	}

	/**
	 * Check permissions. Throw die statement on fail permission.
	 *
	 * @return void
	 */
	private function check_permissions() {
		$capability = apply_filters( 'searchexclude_filter_permissions', 'edit_others_pages' );
		if ( ! current_user_can( $capability ) ) {
			wp_die(
				'Not enough permissions',
				'',
				array(
					'response' => 401,
					'exit'     => true,
				)
			);
		}
	}

	/**
	 * Update the search to have filtered items in the search or removed.
	 *
	 * @param [type] $query search query.
	 * @return $query adjusted search query.
	 */
	public function search_filter( $query ) {
		$exclude =
		( ! is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) )
		&& $query->is_search;

		$exclude = apply_filters( 'searchexclude_filter_search', $exclude, $query );

		if ( $exclude ) {
			$query->set( 'post__not_in', array_merge( array(), $this->get_excluded() ) );
		}

		return $query;
	}
}
