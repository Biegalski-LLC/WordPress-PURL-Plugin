<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://biegalski-llc.com/
 * @since      0.0.2
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
        <h2 class="nav-tab-wrapper" style="margin-top:20px;"><?php _e('PURL Table Configuration', $this->plugin_name);?></h2>

        <p><?php _e('Please <a href="'.get_site_url().'/wp-admin/admin.php?page=wordpress-purl-platform">Setup PURL Platform</a> table and import PURL data. Currently you have zero PURL clients.', $this->plugin_name);?></p>

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

            <h2 class="nav-tab-wrapper" style="margin-top:20px;"><?php _e('PURL Shortcodes', $this->plugin_name);?></h2>
            <p><?php _e('Utilize the following shortcodes for your Personalized URL landing pages.', $this->plugin_name);?></p>
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

        <?php endif; ?>

    <?php endif; ?>

</div>
