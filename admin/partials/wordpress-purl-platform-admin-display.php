<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://biegalski-llc.com/
 * @since      0.0.4
 *
 * @package    Wordpress_Purl_Platform
 * @subpackage Wordpress_Purl_Platform/admin/partials
 */


//Grab all options
$options = get_option($this->plugin_name);

// Cleanup
$importCSVId = (isset($options['purl-table-name']) && !empty($options['purl-table-name'])) ? $options['purl-table-name'] : '';

settings_fields($this->plugin_name);
do_settings_sections($this->plugin_name);

global $wpdb;



?>

<div class="wrap">

    <?php if($importCSVId === ''): ?>

        <form method="post" name="purlType" action="options.php">
            <?php
            if ( function_exists('wp_nonce_field') ):
                wp_nonce_field('purlType_' . $this->plugin_name);
            endif;
            ?>

            <?php settings_fields($this->plugin_name); ?>

            <h2 class="nav-tab-wrapper" style="margin-top:20px;"><?php _e('PURL Table Configuration', $this->plugin_name);?></h2>

            <p><?php _e('Build the table schema that will retain your PURL data. Recommended fields are auto-populated, feel free to modify these at your leisure.  A more dynamic table building approach will be developed and implemented in future version releases.<br />For the time being, please contact <a href="mailto:mbiegalski@alliancefranchisebrands.com">Michael Biegalski</a> if you need additional fields.', $this->plugin_name);?></p>

            <fieldset style="margin-top:20px;">
                <legend><?php esc_attr_e('Required Schema', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_11">
                    <p><?php _e('The following columns and data types are required and are included in the setup of your PURL campaign schema. You do not need to define them.', $this->plugin_name);?></p>
                    <ul>
                        <li><?php _e('id mediumint(9) NOT NULL AUTO_INCREMENT', $this->plugin_name);?></li>
                        <li><?php _e('slug varchar(255) NOT NULL', $this->plugin_name);?></li>
                        <li><?php _e('visited mediumint(9)', $this->plugin_name);?></li>
                        <li><?php _e('created_at timestamp', $this->plugin_name);?></li>
                        <li><?php _e('updated_at timestamp', $this->plugin_name);?></li>
                    </ul>
                </label>
            </fieldset>

            <fieldset style="margin-top:30px;">
                <legend><span><?php esc_attr_e('PURL Table Name:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-purl_table_name">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[purl-table-name]" value="purlCampaign">
                </label>
            </fieldset>

            <fieldset style="margin-top:30px;">
                <legend><span><?php esc_attr_e('Field 1:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_1">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-1]" value="referral"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-1-type]">
                        <option value="VARCHAR">VARCHAR</option>
                        <option value="BOOLEAN">BOOLEAN</option>
                        <option value="DATE">DATE</option>
                        <option value="DECIMAL">DECIMAL</option>
                        <option value="FLOAT">FLOAT</option>
                        <option value="INT">INT</option>
                        <option value="LONGTEXT">LONGTEXT</option>
                        <option value="MEDIUMINT">MEDIUMINT</option>
                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                        <option value="SMALLINT">SMALLINT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="TINYINT">TINYINT</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-1-size]" value="255">
                </label>
            </fieldset>

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 2:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_2">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-2]" value="first_name"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-2-type]">
                        <option value="VARCHAR">VARCHAR</option>
                        <option value="BOOLEAN">BOOLEAN</option>
                        <option value="DATE">DATE</option>
                        <option value="DECIMAL">DECIMAL</option>
                        <option value="FLOAT">FLOAT</option>
                        <option value="INT">INT</option>
                        <option value="LONGTEXT">LONGTEXT</option>
                        <option value="MEDIUMINT">MEDIUMINT</option>
                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                        <option value="SMALLINT">SMALLINT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="TINYINT">TINYINT</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-2-size]" value="255">
                </label>
            </fieldset>

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 3:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_3">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-3]" value="last_name"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-3-type]">
                        <option value="VARCHAR">VARCHAR</option>
                        <option value="BOOLEAN">BOOLEAN</option>
                        <option value="DATE">DATE</option>
                        <option value="DECIMAL">DECIMAL</option>
                        <option value="FLOAT">FLOAT</option>
                        <option value="INT">INT</option>
                        <option value="LONGTEXT">LONGTEXT</option>
                        <option value="MEDIUMINT">MEDIUMINT</option>
                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                        <option value="SMALLINT">SMALLINT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="TINYINT">TINYINT</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-3-size]" value="255">
                </label>
            </fieldset>

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 4:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_4">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-4]" value="phone"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-4-type]">
                        <option value="VARCHAR">VARCHAR</option>
                        <option value="BOOLEAN">BOOLEAN</option>
                        <option value="DATE">DATE</option>
                        <option value="DECIMAL">DECIMAL</option>
                        <option value="FLOAT">FLOAT</option>
                        <option value="INT">INT</option>
                        <option value="LONGTEXT">LONGTEXT</option>
                        <option value="MEDIUMINT">MEDIUMINT</option>
                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                        <option value="SMALLINT">SMALLINT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="TINYINT">TINYINT</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-4-size]" value="20">
                </label>
            </fieldset>

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 5:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_5">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-5]" value="email"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-5-type]">
                        <option value="VARCHAR">VARCHAR</option>
                        <option value="BOOLEAN">BOOLEAN</option>
                        <option value="DATE">DATE</option>
                        <option value="DECIMAL">DECIMAL</option>
                        <option value="FLOAT">FLOAT</option>
                        <option value="INT">INT</option>
                        <option value="LONGTEXT">LONGTEXT</option>
                        <option value="MEDIUMINT">MEDIUMINT</option>
                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                        <option value="SMALLINT">SMALLINT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="TINYINT">TINYINT</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-5-size]" value="80">
                </label>
            </fieldset>

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 6:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_6">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-6]" value="address"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-6-type]">
                        <option value="VARCHAR">VARCHAR</option>
                        <option value="BOOLEAN">BOOLEAN</option>
                        <option value="DATE">DATE</option>
                        <option value="DECIMAL">DECIMAL</option>
                        <option value="FLOAT">FLOAT</option>
                        <option value="INT">INT</option>
                        <option value="LONGTEXT">LONGTEXT</option>
                        <option value="MEDIUMINT">MEDIUMINT</option>
                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                        <option value="SMALLINT">SMALLINT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="TINYINT">TINYINT</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-6-size]" value="30">
                </label>
            </fieldset>

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 7:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_7">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-7]" value="city"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-7-type]">
                        <option value="VARCHAR">VARCHAR</option>
                        <option value="BOOLEAN">BOOLEAN</option>
                        <option value="DATE">DATE</option>
                        <option value="DECIMAL">DECIMAL</option>
                        <option value="FLOAT">FLOAT</option>
                        <option value="INT">INT</option>
                        <option value="LONGTEXT">LONGTEXT</option>
                        <option value="MEDIUMINT">MEDIUMINT</option>
                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                        <option value="SMALLINT">SMALLINT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="TINYINT">TINYINT</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-7-size]" value="20">
                </label>
            </fieldset>

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 8:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_8">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-8]" value="state"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-8-type]">
                        <option value="VARCHAR">VARCHAR</option>
                        <option value="BOOLEAN">BOOLEAN</option>
                        <option value="DATE">DATE</option>
                        <option value="DECIMAL">DECIMAL</option>
                        <option value="FLOAT">FLOAT</option>
                        <option value="INT">INT</option>
                        <option value="LONGTEXT">LONGTEXT</option>
                        <option value="MEDIUMINT">MEDIUMINT</option>
                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                        <option value="SMALLINT">SMALLINT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="TINYINT">TINYINT</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-8-size]" value="30">
                </label>
            </fieldset>

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 9:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_9">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-9]" value="zip_code"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-9-type]">
                        <option value="VARCHAR">VARCHAR</option>
                        <option value="BOOLEAN">BOOLEAN</option>
                        <option value="DATE">DATE</option>
                        <option value="DECIMAL">DECIMAL</option>
                        <option value="FLOAT">FLOAT</option>
                        <option value="INT">INT</option>
                        <option value="LONGTEXT">LONGTEXT</option>
                        <option value="MEDIUMINT">MEDIUMINT</option>
                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                        <option value="SMALLINT">SMALLINT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="TINYINT">TINYINT</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-9-size]" value="7">
                </label>
            </fieldset>

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 10:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_10">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-10]" value="country"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-10-type]">
                        <option value="VARCHAR">VARCHAR</option>
                        <option value="BOOLEAN">BOOLEAN</option>
                        <option value="DATE">DATE</option>
                        <option value="DECIMAL">DECIMAL</option>
                        <option value="FLOAT">FLOAT</option>
                        <option value="INT">INT</option>
                        <option value="LONGTEXT">LONGTEXT</option>
                        <option value="MEDIUMINT">MEDIUMINT</option>
                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                        <option value="SMALLINT">SMALLINT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="TINYINT">TINYINT</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-10-size]" value="30">
                </label>
            </fieldset>

            <?php submit_button(__('Save PURL Config', $this->plugin_name), 'primary','submit', TRUE); ?>

        </form>

    <?php else: ?>

        <?php
        $tableName = $wpdb->prefix . $importCSVId;

        $columns = array();
        foreach ( $wpdb->get_col( "DESC " . $tableName, 0 ) as $column_name ) {
            $columns[] = $column_name;
        }

        $result = $wpdb->get_results("SELECT * from $tableName WHERE `id` IS NOT NULL");
        if(count($result) == 0):
            ?>

            <h2 class="nav-tab-wrapper"><?php _e('Data Import', $this->plugin_name);?></h2>

            <p><?php _e('Due to varying hosting environments, typically massive data import sizes, timeouts and failures - for the moment, you will have to manually insert SQL data. <br /><br />To circumvent time/money being wasted - just use our <a href="http://tools.mrcfury.com/csv-to-sql" target="_blank">CSV-To-SQL</a> MRC Tool.<br />Import your data into table: <code>'.$tableName.'</code><br /><br />Import data directly from WordPress coming in future releases.', $this->plugin_name);?></p>

        <?php else: ?>


            <h2 class="nav-tab-wrapper" style="margin-top:20px;"><?php _e('PURL Table Configuration', $this->plugin_name);?></h2>
            <div class="col-xs-12 col-md-2 text-center">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="text-center"><code><?php echo $tableName; ?></code></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($columns as $column): ?>
                        <tr>
                            <td><?php echo $column; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="col-xs-12 col-md-2 text-center">
                <div class="row">
                    <div class="col-xs-12">
                        <h3><?php _e('Need to start fresh?', $this->plugin_name);?></h3>
                        <button type="button" class="btn btn-danger">Delete Table</button>
                    </div>
                </div>

            </div>


        <?php endif; ?>

    <?php endif; ?>

</div>
