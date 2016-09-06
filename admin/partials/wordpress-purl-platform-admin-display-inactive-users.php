<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://biegalski-llc.com/
 * @since      0.0.5
 *
 * @package    Wordpress_Purl_Platform
 * @subpackage Wordpress_Purl_Platform/admin/partials
 */

$options = get_option($this->plugin_name);

$importCSVId = (isset($options['purl-table-name']) && !empty($options['purl-table-name'])) ? $options['purl-table-name'] : '';

settings_fields($this->plugin_name); do_settings_sections($this->plugin_name);

global $wpdb;
include __DIR__.'/PurlController.php';
$purl = new PurlController;
if($importCSVId === ''):
?>

<div class="wrap">
        <h2 class="nav-tab-wrapper" style="margin-top:20px;"><?php _e('PURL Table Configuration', $this->plugin_name);?></h2>

        <p><?php _e('Please <a href="'.get_site_url().'/wp-admin/admin.php?page=wordpress-purl-platform">Setup PURL Platform</a> table and import PURL data. Currently you have zero PURL Users.', $this->plugin_name);?></p>

</div>

<?php else:
    $tableName = $wpdb->prefix . $importCSVId;

    $columns = array();
    foreach ( $wpdb->get_col( 'DESC ' . $tableName, 0 ) as $column_name ) {
        $columns[] = $column_name;
    }

    $posts_per_page = 20;
    $start = $purl->paginationStartPage($posts_per_page, $_GET['paged']);

    $result = $wpdb->get_results("SELECT * from $tableName WHERE `id` IS NOT NULL");
    $total_records = $wpdb->num_rows;

    if($total_records === 0):
        $purl->dataImportText();
    else:
        $nonVisitedResults = $wpdb->get_results("SELECT * from $tableName WHERE visited = '0' LIMIT $start, $posts_per_page");
        $total_records = $wpdb->num_rows;
?>
<div class="wrap">
    <h2 class="nav-tab-wrapper" style="margin-top:20px;"><?php _e('Inactive PURL Users', $this->plugin_name);?></h2>
    <p><?php _e('The table below represents all users who haven\'t visited their Personalized URL [PURL] landing page.', $this->plugin_name);?></p>
    <table class="table table-striped">
        <thead>
        <tr>
            <?php echo $purl->outputColumnNames($columns); ?>
        </tr>
        </thead>
        <tbody>
            <?php echo $purl->outputPurlUsers($nonVisitedResults, 'Inactive'); ?>
        </tbody>
    </table>
    <?php echo $purl->displayPagination($total_records, $posts_per_page, $_GET['paged'] ); ?>
<?php endif; ?>
</div>

<?php endif; ?>


