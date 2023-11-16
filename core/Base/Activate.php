<?php
/**
 * Simple Activation Class.
 *
 * @package MRK_Search_Exclude
 */

namespace MRK_Search_Exclude\Base;

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
	}
}
