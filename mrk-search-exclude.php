<?php
/**
 * Plugin Name:     MRK Search Exclude
 * Plugin URI:      https://www.mrkwp.com
 * Description:     MRK Search Exclude by MRK WP
 * Author:          MRK WP
 * Author URI:      https://www.mrkwp.com
 * Text Domain:     mrk-search-exclude
 * Domain Path:     /languages
 * Version:         1.0.0
 * PHP version:     8.1
 *
 * @category Plugin
 * @package  MRK_Search_Exclude
 * @author   Matt Knighton <matt@mrkwp.com>
 * @license  GPL 2.0 https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     https://www.mrkwp.com
 */

// If this file is called firectly, abort!!!
defined( 'ABSPATH' ) or die( 'No Access!' );

define( 'MRK_SEARCH_EXCLUDE_PLUGIN_VERSION', '1.0.0' );

// Require once the Composer Autoload.
if ( file_exists( __DIR__ . '/lib/autoload.php' ) ) {
	include_once __DIR__ . '/lib/autoload.php';
}

/**
 * Added the CRB loader here and linked to a base class to avoid name space issues.
 *
 * @return void
 */
function load_mrk_search_exclude_crb() {
	MRK_Search_Exclude\Base\CrbLoader::load();
}
add_action( 'after_setup_theme', 'load_mrk_search_exclude_crb' );

/**
 * The code that runs during plugin activation.
 *
 * @return void
 */
function activate_mrk_search_exclude_plugin() {
	MRK_Search_Exclude\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_mrk_search_exclude_plugin' );

/**
 * The code that runs during plugin deactivation.
 *
 * @return void
 */
function deactivate_mrk_search_exclude_plugin() {
	MRK_Search_Exclude\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_mrk_search_exclude_plugin' );

/**
 * Initialize all the core classes of the plugin.
 */

if ( class_exists( 'MRK_Search_Exclude\\Init' ) ) {
		MRK_Search_Exclude\Init::register_services();
}
