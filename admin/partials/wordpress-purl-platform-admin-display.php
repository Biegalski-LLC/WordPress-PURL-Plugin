<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://biegalski-llc.com/
 * @since      0.0.1
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

    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <form method="post" name="purlType" action="options.php">
        <?php
        if ( function_exists('wp_nonce_field') ):
            wp_nonce_field('purlType_' . $this->plugin_name);
        endif;
        ?>

        <?php settings_fields($this->plugin_name); ?>

        <?php if($importCSVId === ''): ?>
            <h2 class="nav-tab-wrapper" style="margin-top:20px;"><?php _e('PURL Table Configuration', $this->plugin_name);?></h2>

            <p><?php _e('Build the table that will retain your PURL data. Recommended fields are auto-populated, feel free to modify these at your leisure. A more dynamic table building approach will be developed and implemented in future version releases.<br />For the time being, please contact <a href="mailto:mbiegalski@alliancefranchisebrands.com">Michael Biegalski</a> if you need additional fields.', $this->plugin_name);?></p>

            <fieldset>
                <legend><span><?php esc_attr_e('PURL Table Name:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-purl_table_name">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[purl-table-name]" value="purlCampaign">
                </label>
            </fieldset>

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 1:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_1">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-1]" value="slug"> &nbsp;
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

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 11:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_11">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-11]" value="visited"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-11-type]">
                        <option value="MEDIUMINT">MEDIUMINT</option>
                        <option value="BOOLEAN">BOOLEAN</option>
                        <option value="DATE">DATE</option>
                        <option value="DECIMAL">DECIMAL</option>
                        <option value="FLOAT">FLOAT</option>
                        <option value="INT">INT</option>
                        <option value="LONGTEXT">LONGTEXT</option>
                        <option value="MEDIUMTEXT">MEDIUMTEXT</option>
                        <option value="SMALLINT">SMALLINT</option>
                        <option value="TEXT">TEXT</option>
                        <option value="TINYINT">TINYINT</option>
                        <option value="TIMESTAMP">TIMESTAMP</option>
                        <option value="VARCHAR">VARCHAR</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-11-size]" value="9"> &nbsp; (Default = 0; Visited = 1;)
                </label>
            </fieldset>

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 12:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_12">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-12]" value="created_at"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-12-type]">
                        <option value="TIMESTAMP">TIMESTAMP</option>
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
                        <option value="VARCHAR">VARCHAR</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-12-size]" value="">
                </label>
            </fieldset>

            <fieldset style="margin-top:10px;">
                <legend><span><?php esc_attr_e('Field 13:', $this->plugin_name);?></span></legend>
                <label for="<?php echo $this->plugin_name;?>-field_13">
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-13]" value="updated_at"> &nbsp;
                    <select name="<?php echo $this->plugin_name; ?>[field-13-type]">
                        <option value="TIMESTAMP">TIMESTAMP</option>
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
                        <option value="VARCHAR">VARCHAR</option>
                    </select> &nbsp;
                    <input type="text" name="<?php echo $this->plugin_name; ?>[field-13-size]" value="">
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

        <p><?php _e('Due to varying hosting environments, massive data import sizes, timeouts and failures - you will have to manually insert SQL data. <br />To circumvent time/money being wasted - just use our <a href="http://tools.mrcfury.com/csv-to-sql" target="_blank">CSV-To-SQL</a> MRC Tool. Import data coming in version 2.0 maybe....', $this->plugin_name);?></p>

        <?php else: ?>
            <?php
                $allResults= $wpdb->get_results("SELECT * from $tableName");
                $visitedResults = $wpdb->get_results("SELECT * from $tableName WHERE visited = '1'");
                $nonVisitedResults = $wpdb->get_results("SELECT * from $tableName WHERE visited = '0'");
            ?>
                <ul class="nav nav-pills">
                    <li class="active"><a data-toggle="pill" href="#home">All PURL Users</a></li>
                    <li><a data-toggle="pill" href="#menu1">Visited Users</a></li>
                    <li><a data-toggle="pill" href="#menu2">Non-Visited Users</a></li>
                    <li><a data-toggle="pill" href="#menu3">Shortcodes</a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h3>All PURL Users</h3>
                        <p>The table below represents all users in your PURL campaign - whether they visited the PURL landing page or not.</p>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <?php $x = 1;
                                while($x < 11): ?>
                                    <th><?php echo $columns[$x]; ?></th>
                                    <?php $x++; endwhile; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php foreach ($allResults as $user){
                                    $y = 1;
                                    while($y < 11){
                                        echo '<td>'.$user->$columns[$y].'</td>';
                                        $y++;
                                    }
                                }?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3>Visited Users</h3>
                        <p>The table below represents all users who have visited their Personalized URL [PURL] landing page.</p>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <?php $x = 1;
                                while($x < 11): ?>
                                    <th><?php echo $columns[$x]; ?></th>
                                    <?php $x++; endwhile; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php foreach ($visitedResults as $user){
                                    $y = 1;
                                    while($y < 11){
                                        echo '<td>'.$user->$columns[$y].'</td>';
                                        $y++;
                                    }
                                }?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h3>Non-Visited Users</h3>
                        <p>The table below represents all users who have <em>not</em> visited their Personalized URL [PURL] landing page yet.</p>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <?php $x = 1;
                                while($x < 11): ?>
                                    <th><?php echo $columns[$x]; ?></th>
                                    <?php $x++; endwhile; ?>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php foreach ($nonVisitedResults as $user){
                                    $y = 1;
                                    while($y < 11){
                                        echo '<td>'.$user->$columns[$y].'</td>';
                                        $y++;
                                    }
                                }?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div id="menu3" class="container tab-pane fade">
                        <h3>Shortcodes</h3>
                        <p>Utilize the following shortcodes for your Personalized URL landing page.</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Table Column</th>
                                    <th>Shortcode</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $x = 1;
                            while($x < 11): ?>
                            <tr>
                                <td><?php echo $columns[$x]; ?></td>
                                <td>[purl <?php echo $columns[$x]; ?>]</td>
                            </tr>
                            <?php $x++; endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

        <?php endif; ?>

        <?php endif; ?>

</div>
