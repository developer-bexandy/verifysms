<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://bexandyrodriguez.com.ve
 * @since             1.0.0
 * @package           Verifysms
 *
 * @wordpress-plugin
 * Plugin Name:       VERIFY SMS
 * Plugin URI:        https://github.com/developer-bexandy/verifysms.git
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Bexandy Rodriguez
 * Author URI:        https://bexandyrodriguez.com.ve
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       verifysms
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
define( 'VERIFY_SMS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-verifysms-activator.php
 */
function activate_verifysms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-verifysms-activator.php';
	Verifysms_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-verifysms-deactivator.php
 */
function deactivate_verifysms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-verifysms-deactivator.php';
	Verifysms_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_verifysms' );
register_deactivation_hook( __FILE__, 'deactivate_verifysms' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-verifysms.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_verifysms() {

	$plugin = new Verifysms();
	$plugin->run();

}
run_verifysms();
