<?php

namespace FilterEverything\Filter\Pro\Admin;

if ( ! defined('WPINC') ) {
    wp_die();
}

use FilterEverything\Filter\Container;
use FilterEverything\Filter\Pro\Settings\Tabs\SeoRulesTab;
use FilterEverything\Filter\Pro\Settings\Tabs\IndexingDepth;

class Admin{

    private $tabRenderer;

    public function __construct()
    {
        add_action( 'wpc_add_submenu_pages', [$this, 'adminMenu'] );
        $this->tabRenderer = Container::instance()->getTabRenderer();
        add_action( 'wpc_setttings_tabs_register', [$this, 'initTabs'] );

        add_filter( 'parent_file', array( $this, 'highLightMenuItem') );
        add_filter( 'submenu_file', array( $this, 'highLightSubMenuItem' ) );

        add_action( 'edit_form_before_permalink', array( $this, 'forbidEditTitle' ) );
        add_filter( 'enter_title_here', array($this, 'titlePlaceHolderForSeoRule'), 10, 2 );

        add_filter( 'manage_edit-'.FLRT_SEO_RULES_POST_TYPE.'_columns', array( $this, 'seoRulesPostTypeCol' ) );
        add_action( 'manage_'.FLRT_SEO_RULES_POST_TYPE.'_posts_custom_column', array( $this, 'seoRulesPostTypeColContent'), 10, 2 );

        add_filter( 'manage_edit-'.FLRT_SEO_RULES_POST_TYPE.'_sortable_columns', array( $this, 'seoRulesSortableColumn') );
        add_action( 'pre_get_posts', array( $this, 'seoRulesOrderby' ) );

        add_filter( 'wpc_general_filters_settings', [$this, 'generalFilterSettings'] );
        add_filter( 'wpc_experimental_filters_settings', [$this, 'experimentalFilterSettings'] );
    }

    public function initTabs( $renderer )
    {
        $renderer->register(new SeoRulesTab());
        $renderer->register(new IndexingDepth());
    }

    public function adminMenu()
    {
        $page = 'edit.php?post_type=' . FLRT_FILTERS_SET_POST_TYPE;
        $seo = 'edit.php?post_type=' . FLRT_SEO_RULES_POST_TYPE;

        add_submenu_page($page, esc_html__('SEO Rules', 'filter-everything'), esc_html__('SEO Rules', 'filter-everything'), 'manage_options', $seo);
    }

    public function seoRulesPostTypeCol( $columns )
    {
        $newColumns = [];

        foreach ( $columns as $columnId => $columnName ) {
            if( $columnId === 'date' ){
                continue;
            }

            $newColumns[$columnId] = $columnName;
            if( $columnId === 'title' ){
                $newColumns['seo_post_id']      = esc_html__( 'Rule ID', 'filter-everything' );
                $newColumns['seo_post_type']    = esc_html__( 'Post type', 'filter-everything' );
            }
        }

        return $newColumns;
    }

    public function seoRulesPostTypeColContent( $column_name, $post_id )
    {
        if ( ! in_array( $column_name, array( 'seo_post_type', 'seo_post_id' ), true ) ){
            return;
        }

        if( $column_name === 'seo_post_type' ) {
            $post_type = get_post_meta($post_id, 'wpc_seo_rule_post_type', true);
            $postTypes = get_post_types(array('name' => $post_type), 'objects');
            $data = reset($postTypes);

            if (isset($data->labels->singular_name)) {
                echo esc_html( $data->labels->singular_name );
            } else {
                echo esc_html( $post_type );
            }
        }

        if( $column_name === 'seo_post_id' ){
            echo esc_html( $post_id );
        }
    }

    public function seoRulesSortableColumn( $columns )
    {
        $columns['seo_post_type']   = 'seo_post_type';
        $columns['seo_post_id']     = 'seo_post_id';
        return $columns;
    }

    public function seoRulesOrderby( $query ) {
        if( ! is_admin() )
            return;

        if( $query->get('post_type') !== FLRT_SEO_RULES_POST_TYPE ){
            return;
        }

        $orderby = $query->get( 'orderby' );

        if( $orderby === 'menu_order title' ){
            $query->set( 'orderby', 'date' );
            $query->set( 'order', 'DESC' );
        }

        if( 'seo_post_type' == $orderby ) {
            $query->set('meta_key','wpc_seo_rule_post_type');
            $query->set('orderby','meta_value');
        }

        if( 'seo_post_id' == $orderby ) {
            $query->set( 'orderby', 'ID' );
        }
    }

    public function forbidEditTitle( $post )
    {
        if( isset($post->post_type) && $post->post_type === FLRT_SEO_RULES_POST_TYPE ){
            ?>
            <script>document.getElementById("title").setAttribute('readonly', 'readonly');</script>
            <?php
        }

        return $post;
    }

    public function titlePlaceHolderForSeoRule( $placeHolder, $post )
    {
        if( isset($post->post_type) && $post->post_type === FLRT_SEO_RULES_POST_TYPE ){
            $placeHolder = esc_html__( 'Title will be created automatically', 'filter-everything' );
        }

        return $placeHolder;
    }

    public function highLightMenuItem( $parentFile )
    {
        $screen = get_current_screen();

        if( isset( $screen->post_type ) && $screen->post_type === FLRT_SEO_RULES_POST_TYPE ){
            $parentFile = 'edit.php?post_type=' . FLRT_FILTERS_SET_POST_TYPE;
        }

        return $parentFile;
    }

    public function highLightSubMenuItem( $submenu_file )
    {
        $screen = get_current_screen();
        if( isset( $screen->post_type ) && $screen->post_type === FLRT_SEO_RULES_POST_TYPE ){
            if( $submenu_file === 'post-new.php?post_type=' . FLRT_SEO_RULES_POST_TYPE ){
                $submenu_file = 'edit.php?post_type=' . FLRT_SEO_RULES_POST_TYPE;
            }
        }
        return $submenu_file;
    }

    public function experimentalFilterSettings( $settings )
    {
        $pro_settings = [];
        foreach ( $settings as $key => $config ){

            if( $key === 'customization' ){
                $pro_settings['buttons_settings'] = array(
                    'label'  => esc_html__('Opening widgets buttons', 'filter-everything'),
                    'fields' => array(
                        'disable_buttons' => array(
                            'type'  => 'checkbox',
                            'title' => esc_html__('Hide widget buttons', 'filter-everything'),
                            'id'    => 'disable_buttons',
                            'label' => esc_html__('Do not display opening widgets buttons. I will insert them myself with shortcodes.', 'filter-everything'),
                        )
                    )
                );
            }

            $pro_settings[$key] = $config;
        }

        return $pro_settings;
    }

    public function generalFilterSettings( $settings )
    {
        $new_fields = [];

        foreach ( $settings['mobile_devices']['fields'] as $id => $field ){
            $new_fields[$id] = $field;

            if( $id === 'show_open_close_button' ){
                $new_fields['show_bottom_widget'] = array(
                    'type'  => 'checkbox',
                    'title' => esc_html__('Special Pop-up Filters Widget for Mobile', 'filter-everything' ),
                    'id'    => 'show_bottom_widget',
                    'label' => esc_html__('Try to use Pop-up Filter widget', 'filter-everything' ),
                );
            }
        }

        $settings['mobile_devices']['fields'] = $new_fields;

        $settings['common_settings']['fields']['terms_with_capital_letter'] = array(
                    'type'          => 'text',
                    'title'         => esc_html__('Entities, whose terms should display in SEO data without force lowercasing', 'filter-everything' ),
                    'id'            => 'terms_with_capital_letter',
                    'default'       => '',
                    'tooltip'       => esc_html__( 'By default all terms is H1, SEO title and Description are displayed in lowercase. If you need to display them exactly as term names, specify them in this field.', 'filter-everything' ),
                    'description'   => esc_html__( 'Comma separated entities. E.g. "pa_brand,pa_color,pa_size"', 'filter-everything' ),
                    'label'         => ''
            );

        return $settings;
    }
}