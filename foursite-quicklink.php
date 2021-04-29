<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.4sitestudios.com
 * @since             1.0.0
 * @package           Foursite_Quicklink
 *
 * @wordpress-plugin
 * Plugin Name:       4Site Quicklink
 * Plugin URI:        https://github.com/4site-interactive-studios/4site-quicklink
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            4Site Studios
 * Author URI:        https://www.4sitestudios.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       foursite-quicklink
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'FOURSITE_QUICKLINK_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-foursite-quicklink-activator.php
 */
function activate_foursite_quicklink() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-foursite-quicklink-activator.php';
	Foursite_Quicklink_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-foursite-quicklink-deactivator.php
 */
function deactivate_foursite_quicklink() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-foursite-quicklink-deactivator.php';
	Foursite_Quicklink_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_foursite_quicklink' );
register_deactivation_hook( __FILE__, 'deactivate_foursite_quicklink' );


/**
 * The Settings Page.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-foursite-quicklink-settings.php';


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-foursite-quicklink.php';




/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_foursite_quicklink() {

	$plugin = new Foursite_Quicklink();
	$plugin->run();

}
run_foursite_quicklink();