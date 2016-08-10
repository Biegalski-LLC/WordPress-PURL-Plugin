<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://biegalski-llc.com/
 * @since             0.0.1
 * @package           Wordpress_Purl_Platform
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress PURL Platform
 * Plugin URI:        https://biegalski-llc.com/plugins/wordpress-purl-platform/
 * Description:       Launch and easily manage Personalized URL (PURL) Campaigns. Marketers can seamlessly monitor their campaigns and gather data for analysis.
 * Version:           0.0.1
 * Author:            Michael Biegalski
 * Author URI:        https://biegalski-llc.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordpress-purl-platform
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordpress-purl-platform-activator.php
 */
function activate_wordpress_purl_platform() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-purl-platform-activator.php';
	Wordpress_Purl_Platform_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordpress-purl-platform-deactivator.php
 */
function deactivate_wordpress_purl_platform() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-purl-platform-deactivator.php';
	Wordpress_Purl_Platform_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wordpress_purl_platform' );
register_deactivation_hook( __FILE__, 'deactivate_wordpress_purl_platform' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordpress-purl-platform.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.1
 */
function run_wordpress_purl_platform() {

	$plugin = new Wordpress_Purl_Platform();
	$plugin->run();

}
run_wordpress_purl_platform();
