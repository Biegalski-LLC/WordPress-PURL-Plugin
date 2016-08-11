<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://biegalski-llc.com/
 * @since      0.0.1
 *
 * @package    Wordpress_Purl_Platform
 * @subpackage Wordpress_Purl_Platform/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordpress_Purl_Platform
 * @subpackage Wordpress_Purl_Platform/admin
 * @author     Michael <michael@biegalski-llc.com>
 */
class Wordpress_Purl_Platform_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        $this->wp_cbf_options = get_option($this->plugin_name);

	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wordpress-purl-platform-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wordpress-purl-platform-admin.js', array( 'jquery', 'media-upload' ), $this->version, false );

	}

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    0.0.2
     */

    public function add_plugin_admin_menu() {
        add_menu_page( 'WordPress PURL Platform', 'PURL Platform', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'), 'dashicons-groups' );
        add_submenu_page( 'wordpress-purl-platform', 'PURL Settings', 'PURL Settings', 'manage_options', 'wordpress-purl-platform', array($this, 'display_plugin_setup_page'));
        add_submenu_page( 'wordpress-purl-platform', 'All PURL Clients', 'All PURL Clients', 'manage_options', 'wordpress-purl-platform-all', array($this, 'display_plugin_all_users_page'));
        add_submenu_page( 'wordpress-purl-platform', 'PURL Clients That Visited', 'Active Clients', 'manage_options', 'wordpress-purl-platform-active', array($this, 'display_plugin_visited_users_page'));
        add_submenu_page( 'wordpress-purl-platform', 'PURL Clients That Haven\'t Visited', 'Inactive Clients', 'manage_options', 'wordpress-purl-platform-inactive', array($this, 'display_plugin_non_visited_users_page'));
        add_submenu_page( 'wordpress-purl-platform', 'PURL Shortcodes', 'PURL Shortcodes', 'manage_options', 'wordpress-purl-platform-shortcodes', array($this, 'display_plugin_shortcodes_page'));
    }

    /**
     * Add settings action link to the plugins page.
     *
     * @since    0.0.1
     */

    public function add_action_links( $links ) {
        $settings_link = array(
            '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
        );
        return array_merge(  $settings_link, $links );

    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    0.0.1
     */

    public function display_plugin_setup_page() {
        include_once( 'partials/wordpress-purl-platform-admin-display.php' );
    }

    /**
     * Render the all clients page for this plugin.
     *
     * @since    0.0.2
     */
    public function display_plugin_all_users_page() {
        include_once( 'partials/wordpress-purl-platform-admin-display-all-users.php' );
    }

    /**
     * Render the visited clients page for this plugin.
     *
     * @since    0.0.2
     */
    public function display_plugin_visited_users_page() {
        include_once( 'partials/wordpress-purl-platform-admin-display-visited-users.php' );
    }

    /**
     * Render the non-visited clients page for this plugin.
     *
     * @since    0.0.2
     */
    public function display_plugin_non_visited_users_page() {
        include_once( 'partials/wordpress-purl-platform-admin-display-inactive-users.php' );
    }

    /**
     * Render the non-visited clients page for this plugin.
     *
     * @since    0.0.2
     */
    public function display_plugin_shortcodes_page() {
        include_once( 'partials/wordpress-purl-platform-admin-display-shortcodes.php' );
    }

    /**
     * @param $input
     * @return array
     *
     * @since    0.0.3
     */
    public function validate($input) {
        global $wpdb;

        $purlTableName = sanitize_text_field( $input['purl-table-name'] );

        $valid = array();

        if($purlTableName !== ''){

            $table_name = $wpdb->prefix.$purlTableName;

            if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

                $tableSchema = array();
                foreach ($input as $column => $value) {
                    $tableSchema[$column] = sanitize_text_field($value);
                }

                $charset_collate = $wpdb->get_charset_collate();

                $sql = "CREATE TABLE $table_name (
                              id mediumint(9) NOT NULL AUTO_INCREMENT,";
                    $i = 1;
                    foreach ($tableSchema as $column => $value){
                        if($tableSchema['field-' . $i]){
                            $sql .= $tableSchema['field-' . $i] . ' ' . $tableSchema['field-' . $i . '-type'];
                            if(!empty($tableSchema['field-' . $i . '-size'])){
                                $sql .= '(' . $tableSchema['field-' . $i . '-size'] . '), ';
                            }else{
                                $sql .= ', ';
                            }
                        }
                        $i++;
                    }
                $sql .= "       visited mediumint(9) DEFAULT 0,
                                created_at timestamp,
                                updated_at timestamp,
                              UNIQUE KEY id (id)
                         ) $charset_collate;";

                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                dbDelta( $sql );
            }
        }

        $valid['purl-table-name'] = (isset($purlTableName) && !empty($purlTableName)) ? $purlTableName : '';

        return $valid;
    }

    /**
     *
     */
    public function options_update() {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }

}
