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
     * @since    0.0.1
     */

    public function add_plugin_admin_menu() {
        add_menu_page( 'WordPress PURL Platform', 'PURL', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page'), 'dashicons-groups' );
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
     * @param $input
     * @return array
     */
    public function validate($input) {
        global $wpdb;

        $purlTableName = sanitize_text_field( $input['purl-table-name'] );

        // All checkboxes inputs
        $valid = array();

        if($purlTableName !== ''){

            $table_name = $wpdb->prefix.$purlTableName;

            if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

                $dataTypes = array('BOOLEAN', 'DATE', 'DECIMAL', 'FLOAT', 'LONGTEXT', 'MEDIUMTEXT', 'TIMESTAMP');

                $x = 1;
                $tableSchema = array();
                while ($x < 14){
                    $tableSchema['field'.$x] = sanitize_text_field( $input['field-'.$x] );
                    $tableSchema['field'.$x.'-type'] = sanitize_text_field( $input['field-'.$x.'-type'] );
                    $tableSchema['field'.$x.'-size'] = sanitize_text_field( $input['field-'.$x.'-size'] );
                    $x++;
                }


                //table not in database. Create new table
                $charset_collate = $wpdb->get_charset_collate();

                $sql = "CREATE TABLE $table_name (
                              id mediumint(9) NOT NULL AUTO_INCREMENT,";
                    $i = 1;
                    while ($i < 14){
                            $sql .= $tableSchema['field' . $i] . ' ' . $tableSchema['field' . $i . '-type'];
                            if(!empty($tableSchema['field' . $i . '-size'])){
                                $sql .= '(' . $tableSchema['field' . $i . '-size'] . '), ';
                            }else{
                                $sql .= ', ';
                            }

                        $i++;
                    }
                $sql .= "
                              UNIQUE KEY id (id)
                         ) $charset_collate;";

                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                dbDelta( $sql );
            }
        }

        //Cleanup
        $valid['purl-table-name'] = (isset($purlTableName) && !empty($purlTableName)) ? $purlTableName : '';
        $y = 1;
        while ($y < 14){
            $valid[$tableSchema['field'.$y]] = (isset($tableSchema['field'.$y]) && !empty($tableSchema['field'.$y])) ? $tableSchema['field'.$y] : '';
            $valid[$tableSchema['field'.$y.'-type']] = (isset($tableSchema['field'.$y.'-type']) && !empty($tableSchema['field'.$y.'-type'])) ? $tableSchema['field'.$y.'-type'] : '';
            $valid[$tableSchema['field'.$y.'-size']] = (isset($tableSchema['field'.$y.'-size']) && !empty($tableSchema['field'.$y.'-size'])) ? $tableSchema['field'.$y.'-size'] : '';
            $y++;
        }

        return $valid;
    }

    /**
     *
     */
    public function options_update() {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }

}
