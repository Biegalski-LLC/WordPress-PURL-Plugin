<?php

/**
 * Created by PhpStorm.
 * User: mbiegalski
 * Date: 9/6/2016
 * Time: 1:18 PM
 */
class PurlController
{
    public function dataImportText(){
        include __DIR__.'/wordpress-purl-platform-admin-data.php';
    }

    public function outputColumnNames($columns){
        $output = null;

        foreach ($columns as $column){
            if($column === 'created_at' || $column === 'updated_at') {
            }else{
                $output .= '<th>'. $column .'</th>';
            }
        }
        return $output;
    }

    public function outputPurlUsers($query, $type){
        $output = null;
        if(empty($query)){
            echo '<td colspan="13" class="text-center">No '. $type .' Users</td>';
        }else {
            foreach ($query as $user) {
                $output .= '<tr>';
                foreach ($user as $key => $value){
                    $output .= '<td>'. $value .'</td>';
                }
                $output .= '</tr>';
            }
        }
        return $output;
    }

    public function displayPagination($total_records, $posts_per_page, $page){
        $total = ceil( $total_records / $posts_per_page );

        if(is_numeric($page)){
            $page = $page;
        }else{
            $page = 1;
        }

        $prev_arrow = is_rtl() ? '&rarr;' : '&larr;';
        $next_arrow = is_rtl() ? '&larr;' : '&rarr;';

        $big = 999999999;
        $output = null;
        if( $total > 1 )  {
            if( get_option('permalink_structure') ) {
                $format = 'page/%#%/';
            } else {
                $format = '&paged=%#%';
            }
            $links = paginate_links(array(
                'base'          => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'format'        => $format,
                'current'       => max( 1, $page ),
                'total'         => $total_records,
                'mid_size'      => 3,
                'type'          => 'array',
                'prev_text'     => $prev_arrow,
                'next_text'     => $next_arrow,
            ) );

            if(!empty($links) && $links !== null){
                foreach ($links as $link){
                    $output .= $link . '&nbsp;';
                }
            }
            return $output;
        }else{
            return $output;
        }
    }

    public function paginationStartPage($postsPerPage, $page){
        if(is_numeric($page)){
            $paged = $page;
        }else{
            $paged = 1;
        }
        return ($paged-1)*$postsPerPage;
    }

}