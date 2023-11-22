<?php
/**
 * Simple Activation Class.
 *
 * @package MRK_Search_Exclude
 */

namespace MRK_Search_Exclude\Base;

use MRK_Search_Exclude\Base\BaseController;

/**
 * Activate Class.
 */
class Activate {
	/**
	 * Hooked for Activate inside Plugin.
	 *
	 * @return void
	 */
	public static function activate() {
		flush_rewrite_rules();

		// Setup a base controller to run the activate function inside the core.
		$base_controller = new BaseController();
		$base_controller->activate();
	}
}
