<?php
/**
 * The Template for displaying filter checkboxes.
 *
 * This template can be overridden by copying it to yourtheme/filter/checkboxes.php.
 *
 * $set - array, with the Filter Set parameters
 * $filter - array, with the Filter parameters
 * $url_manager - object, of the UrlManager PHP class
 * $terms - array, with objects of all filter terms except excluded
 *
 * @see https://filtereverything.pro/resources/templates-overriding/
 */

if ( ! defined('WPINC') ) {
    wp_die();
}

?>
<div class="<?php echo flrt_filter_class( $filter ); // Already escaped ?>" data-fid="<?php echo esc_attr( $filter['ID'] ); ?>">
    <?php flrt_filter_header( $filter, $terms ); // Safe, escaped ?>
    <div class="<?php echo esc_attr( flrt_filter_content_class( $filter ) ); ?>">
        <ul class="wpc-filters-ul-list wpc-filters-checkboxes"><?php

            if( ! empty( $terms ) ):
                $args = array(
                    'url_manager'       => $url_manager,
                    'filter'            => $filter,
                    'show_count'        => $set['show_count']['value']
                );

                echo flrt_walk_terms_tree( $terms, $args );

            else:

                ?><li><?php esc_html_e('There are no terms yet.', 'filter-everything' ); ?></li><?php

            endif;

?>      </ul>
    </div>
</div>