<?php
/**
 * The Template for displaying filter labels.
 *
 * This template can be overridden by copying it to yourtheme/filter/labels.php.
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
        <ul class="wpc-filters-ul-list wpc-filters-labels">
            <?php if( ! empty( $terms ) ): ?>

                <?php foreach ( $terms as $id => $term_object ){

                    $checked         = ( in_array( $term_object->slug, $filter['values'] ) ) ? 1 : 0;
                    $active_class    = $checked ? ' wpc-term-selected' : '';
                    $link            = $url_manager->getTermUrl( $term_object->slug, $filter['e_name'] );
                    $link_attributes = 'href="'.esc_url($link).'"';

                    ?>
                        <li class="wpc-label-item wpc-term-item<?php echo esc_attr( $active_class ); ?> wpc-term-count-<?php echo esc_attr( $term_object->cross_count ); ?> wpc-term-id-<?php echo esc_attr( $id ); ?>" id="<?php flrt_term_id('term', $filter, $id ); ?>">
                            <div class="wpc-term-item-content-wrapper">
                                <input class="wpc-label-input" <?php checked( 1, $checked ); ?> type="checkbox" data-wpc-link="<?php echo esc_url( $link ); ?>" id="<?php flrt_term_id('checkbox', $filter, $id); ?>" />
                                <label for="<?php flrt_term_id('checkbox', $filter, $id); ?>">
                                    <span class="wpc-filter-label-wrapper">
                                        <?php
                                        /**
                                         * Allow developers to change filter terms html
                                         */
                                        echo apply_filters( 'wpc_filters_label_term_html', '<a '.$link_attributes.'>'.$term_object->name.'</a>', $link_attributes, $term_object, $filter );

                                        ?>&nbsp;<?php flrt_count( $term_object, $set['show_count']['value'] ); // Safe, escaped?>
                                    </span>
                                </label>
                            </div>
                        </li>
                <?php } ?><!-- end foreach -->

            <?php  else:  ?>
                <li><?php esc_html_e('There are no terms yet.', 'filter-everything' ); ?></li>
            <?php endif; ?><!-- end if -->
        </ul>
    </div>
</div>