<?php
/**
 * Crb Loader Class
 *
 * @package MRK_Search_Exclude
 */

namespace MRK_Search_Exclude\Base;

use Carbon_Fields\Carbon_fields;

/**
 * Load Carbon Fields.
 */
class CrbLoader {
	/**
	 * Hooked for Carbon Field Loader
	 *
	 * @return void
	 */
	public static function load() {
		\Carbon_Fields\Carbon_Fields::boot();
	}
}
