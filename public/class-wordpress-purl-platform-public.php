<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://biegalski-llc.com/
 * @since      0.0.1
 *
 * @package    Wordpress_Purl_Platform
 * @subpackage Wordpress_Purl_Platform/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordpress_Purl_Platform
 * @subpackage Wordpress_Purl_Platform/public
 * @author     Michael <michael@biegalski-llc.com>
 */
class Wordpress_Purl_Platform_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->wp_cbf_options = get_option($this->plugin_name);

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordpress_Purl_Platform_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Purl_Platform_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-purl-platform-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wordpress_Purl_Platform_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordpress_Purl_Platform_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpress-purl-platform-public.js', array( 'jquery' ), $this->version, false );

	}

	public function buildShortcodes() {

        function purl_shortcode( $atts ) {

            global $wpdb;
            $wpOptionsTable = $wpdb->prefix . 'options';
            $options = unserialize( $wpdb->get_var( $wpdb->prepare( "SELECT option_value FROM $wpOptionsTable WHERE option_name = %s ", 'wordpress-purl-platform' ) ) );

            $table = $wpdb->prefix . strtolower( $options['purl-table-name'] );

            $parsedUrl = parse_url($_SERVER['HTTP_HOST']);
            $subdomain = explode('.', $parsedUrl['path']);
            $purl = sanitize_text_field( $subdomain[0] );

            $purlData = $wpdb->get_var( $wpdb->prepare( "SELECT $atts[0] FROM $table WHERE slug = %s ", $purl ) );

            if(!empty($purlData)){
                $wpdb->update(
                    $table,
                    array(
                        'visited' => '1',	// string
                    ),
                    array( 'slug' => $purl ),
                    array(
                        '%d'	// value2
                    ),
                    array( '%s' )
                );
            }else{
                $purlData = '';
            }

            return print_r($purlData, true);

        }
        add_shortcode( 'purl', 'purl_shortcode' );
    }

}
