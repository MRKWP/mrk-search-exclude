<?php
/**
 * Deactivate Class.
 *
 * @package MRK_Search_Exclude
 */

namespace MRK_Search_Exclude\Base;

/**
 * Deactivate Class
 */
class Deactivate {
	/**
	 * Static function for Deactivate.
	 *
	 * @return void
	 */
	public static function deactivate() {
		flush_rewrite_rules();
	}
}
