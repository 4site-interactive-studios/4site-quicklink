<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.4sitestudios.com
 * @since      1.0.0
 *
 * @package    Foursite_Quicklink
 * @subpackage Foursite_Quicklink/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Foursite_Quicklink
 * @subpackage Foursite_Quicklink/includes
 * @author     4Site Studios <hosting@4sitestudios.com>
 */
class Foursite_Quicklink_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		// We're deleting the options when the plugin gets deactivated
		delete_option( 'foursite_quicklink_settings_option_name' );
	}

}