<?php


namespace FilterEverything\Filter;

if ( ! defined('WPINC') ) {
    wp_die();
}

class Shortcodes
{
    function __construct(){
        add_shortcode( 'fe_open_widget', '__return_false' );
        add_shortcode( 'fe_open_button', '__return_false' );
        add_shortcode( 'fe_chips', [$this, 'chipsShortcode'] );
    }

    public function chipsShortcode( $atts )
    {
        ob_start();

        $showReset  = true;
        $setIds     = [];
        $classes    = [];

        if( isset( $atts['reset'] ) && $atts['reset'] === 'no' ){
            $showReset = false;
        }

        if( isset( $atts['mobile'] ) && $atts['mobile'] ){
            $classes[] = 'wpc-show-on-mobile';
        }

        if( isset( $atts['id'] ) ){
            $atts['id'] = preg_replace('/[^\d\,]?/', '', $atts['id']);
            $setIds = explode( ",", $atts['id'] );
        }

        flrt_show_selected_terms($showReset, $setIds, $classes);

        $html = ob_get_clean();

        return $html;
    }

}