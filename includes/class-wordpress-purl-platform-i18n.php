<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://biegalski-llc.com/
 * @since      1.0.0
 *
 * @package    Wordpress_Purl_Platform
 * @subpackage Wordpress_Purl_Platform/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wordpress_Purl_Platform
 * @subpackage Wordpress_Purl_Platform/includes
 * @author     Michael <michael@biegalski-llc.com>
 */
class Wordpress_Purl_Platform_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wordpress-purl-platform',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
