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

// Cleanup values
$importCSVId = (isset($options['purl-table-name']) && !empty($options['purl-table-name'])) ? $options['purl-table-name'] : '';

settings_fields($this->plugin_name);
do_settings_sections($this->plugin_name);

global $wpdb;

?>

<div class="wrap">

    <?php if($importCSVId === ''): ?>
        <h2 class="nav-tab-wrapper" style="margin-top:20px;"><?php _e('PURL Table Configuration', $this->plugin_name);?></h2>

        <p><?php _e('Please <a href="'.get_site_url().'/wp-admin/admin.php?page=wordpress-purl-platform">Setup PURL Platform</a> table and import PURL data. Currently you have zero PURL clients.', $this->plugin_name);?></p>

    <?php

    else:
        $tableName = $wpdb->prefix . $importCSVId;

        $columns = array();
        foreach ( $wpdb->get_col( "DESC " . $tableName, 0 ) as $column_name ) {
            $columns[] = $column_name;
        }

        $posts_per_page = 1;
        $start = 0;
        $paged = $_GET['paged']; //get_query_var( 'page') ? get_query_var( 'page', 1 ) : 1; <--not working for some odd reason, bug/security fix coming soon
        $start = ($paged-1)*$posts_per_page;

        $result = $wpdb->get_results("SELECT * from $tableName WHERE `id` IS NOT NULL");
        $total_records = $wpdb->num_rows;

        if($total_records === 0):
        ?>

            <h2 class="nav-tab-wrapper"><?php _e('Data Import', $this->plugin_name);?></h2>

            <p><?php _e('Due to varying hosting environments, typically massive data import sizes, timeouts and failures - for the moment, you will have to manually insert SQL data. <br /><br />To circumvent time/money being wasted - just use our <a href="http://tools.mrcfury.com/csv-to-sql" target="_blank">CSV-To-SQL</a> MRC Tool.<br />Import your data into table: <code>'.$tableName.'</code><br /><br />Import data directly from WordPress coming in future releases.', $this->plugin_name);?></p>

        <?php else: ?>

            <?php $allResults = $wpdb->get_results("SELECT * from $tableName LIMIT $start, $posts_per_page"); ?>

            <h2 class="nav-tab-wrapper" style="margin-top:20px;"><?php _e('All PURL Clients', $this->plugin_name);?></h2>
            <p><?php _e('The table below represents all users who have a Personalized URL [PURL] landing page in your database - whether they visited it or not.', $this->plugin_name);?></p>
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
                    <?php

                    if(empty($allResults)){
                        echo '<td colspan="10" class="text-center">No Users</td>';
                    }else {
                        foreach ($allResults as $user) {
                            echo '<tr>';
                            $y = 1;
                            while ($y < 11) {
                                echo '<td>' . $user->$columns[$y] . '</td>';
                                $y++;
                            }
                            echo '</tr>';
                        }
                    }
                    ?>
                </tbody>
            </table>

            <?php
            // Display Pagination
            $total = ceil( $total_records / $posts_per_page); // Calculate Total pages

            $prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
            $next_arrow = is_rtl() ? '&larr;' : '&rarr;';

            $big = 999999999; // need an unlikely integer
            if( $total > 1 )  {
                if( !$current_page = get_query_var('paged') )
                    $current_page = 1;
                if( get_option('permalink_structure') ) {
                    $format = 'page/%#%/';
                } else {
                    $format = '&paged=%#%';
                }
                $links = paginate_links(array(
                    'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'        => $format,
                    'current'       => max( 1, $_GET['paged'] ), //get_query_var('paged') <--bug/security fix coming soon
                    'total'         => $total_records,
                    'mid_size'      => 3,
                    'type'          => 'array',
                    'prev_text'     => $prev_arrow,
                    'next_text'     => $next_arrow,
                ) );
                foreach ($links as $link){
                    echo $link . '&nbsp;';
                }
            }
            ?>
        <?php endif; ?>

    <?php endif; ?>

</div>
