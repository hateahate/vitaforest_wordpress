<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

class WT_Wishlist_Singlepage {


    public function __construct() {
        
        global $wt_wishlist_general_settings_options, $wt_wishlist_button_style_settings_options;

        if(isset($wt_wishlist_general_settings_options['wt_enabled_pages']) && in_array('product',$wt_wishlist_general_settings_options['wt_enabled_pages'])) {

            if(isset($wt_wishlist_button_style_settings_options['wt_button_type']) && ($wt_wishlist_button_style_settings_options['wt_button_type'] == 'normal_button')){
                add_action( 'woocommerce_after_add_to_cart_button', array( $this, 'render_webtoffee_wishlist_button' ), 11 );
            }else{
                add_action( 'woocommerce_single_product_summary', array( $this, 'render_webtoffee_wishlist_button' ), 31 );
            }
        }
        
    }
   
    public function render_webtoffee_wishlist_button() {
        
        global $product, $wt_wishlist_button_style_settings_options, $wt_wishlist_table_settings_options;

        $wt_wishlist_general_settings_options = get_option('wt_wishlist_general_settings');
		$wt_enable_for_loggedin_users = isset($wt_wishlist_general_settings_options['wt_enable_for_loggedin_users']) ? $wt_wishlist_general_settings_options['wt_enable_for_loggedin_users'] : '';

        if(! is_user_logged_in() && ($wt_enable_for_loggedin_users == 1)){
            return;
        }
        
        if ($this->product_already_exists($product->get_id(), get_current_user_id())) {

            $class         = 'webtoffee_wishlist_remove';
            $text_title    = empty($wt_wishlist_button_style_settings_options['wt_after_adding_product_text']) ? __('Product added to wishlist','wt-woocommerce-wishlist')  : $wt_wishlist_button_style_settings_options['wt_after_adding_product_text'];
            $text_icon_src = WEBTOFFEE_WISHLIST_BASEURL .'public/images/favourite.svg';
            $icon_src      = WEBTOFFEE_WISHLIST_BASEURL .'public/images/icon_favourite.svg';
            $button_class  = ' button_product_added';
            $button_msg    = empty($wt_wishlist_button_style_settings_options['wt_after_adding_product_button']) ?  __('Product added to wishlist','wt-woocommerce-wishlist') : $wt_wishlist_button_style_settings_options['wt_after_adding_product_button'];
            $product_added = 1;

            $my_id =  isset($wt_wishlist_table_settings_options['wt_wishlist_page']) ? $wt_wishlist_table_settings_options['wt_wishlist_page'] : get_option( 'wt_webtoffee-wishlist_page_id' );
				
            $browse_wishlist = isset($wt_wishlist_button_style_settings_options['wt_enable_browse_wishlist']) ? $wt_wishlist_button_style_settings_options['wt_enable_browse_wishlist'] : '';
            if($browse_wishlist){
                $element = "<br><sapn> <a href='".get_the_permalink($my_id)."'>".__('View wishlist','wt-woocommerce-wishlist')."</a></span>";
            }else{
                $element = "<span></span>";
            }

        } else {

            $class         = 'webtoffee_wishlist';
            $text_title    = empty($wt_wishlist_button_style_settings_options['wt_add_to_wishlist_text']) ?  __('Add to wishlist','wt-woocommerce-wishlist') : $wt_wishlist_button_style_settings_options['wt_add_to_wishlist_text'];
            $text_icon_src = WEBTOFFEE_WISHLIST_BASEURL .'public/images/unfavourite.svg';
            $icon_src      = WEBTOFFEE_WISHLIST_BASEURL .'public/images/icon_favourite.svg';
            $button_class  = ' button_product_to_add';
            $button_msg    = empty($wt_wishlist_button_style_settings_options['wt_add_to_wishlist_button']) ?  __('Add to wishlist','wt-woocommerce-wishlist') : $wt_wishlist_button_style_settings_options['wt_add_to_wishlist_button'];
            $product_added = 0;

            $element = "<span></span>";

        }

        if(isset($wt_wishlist_button_style_settings_options['wt_button_type'])){

            if($wt_wishlist_button_style_settings_options['wt_button_type'] == 'text'){

                echo "<div class='single_product_div'> <a href='#' ><span class='" . $class . " wt-wishlist-button' data-act='add' data-product_id='" . $product->get_id() . "' data-user_id='" . get_current_user_id() . "' >".'<img class="wishlist_text_icon_image" style="margin-bottom: -2px !important;" src="'.$text_icon_src.'"></span></a>'.$element.' </div>';

            }else if($wt_wishlist_button_style_settings_options['wt_button_type'] == 'icon'){

                echo "<div class='single_product_div'> <a href='#' > <i class='" . $class . " wt-wishlist-button' data-act='add' data-product_id='" . $product->get_id() . "' data-user_id='" . get_current_user_id() . "' ><img style='width:auto; display:inline-flex; margin-bottom: 0px !important;'src='".$text_icon_src."'></i> </a> ".$element." </div>";

            }else if($wt_wishlist_button_style_settings_options['wt_button_type'] == 'normal_button'){

                if($product_added == 1){
                    echo "<div class='single_product_div single_product_button_div'> <a href='#' > <img class='wishlist_text_icon_image' style='margin-bottom: -2px !important;' src='".$text_icon_src."'> <span class='" . $class . " wt-wishlist-button' data-act='add' data-product_id='" . $product->get_id() . "' data-user_id='" . get_current_user_id() . "' >".$button_msg."</span></a> ".$element." </div>";
                }else{
                    echo "<div class='single_product_div single_product_button_div'>  <button class='button " . $class .$button_class. " wt-wishlist-button' data-act='add' data-product_id='" . $product->get_id() . "' data-user_id='" . get_current_user_id() . "' >".$button_msg."</button> </div>";
                }

            }
            
        }
       
    }

    public function product_already_exists($product_id, $current_user) {
        
        global $wpdb;
        if (is_user_logged_in()) {
            $table_name = $wpdb->prefix . 'wt_wishlists';
            $rowcount = $wpdb->get_var("SELECT COUNT(*) FROM $table_name where `product_id` = '$product_id' and `user_id` = '$current_user'");
        }else{
            $session_id = WC()->session->get('sessionid');
            $table_name = $wpdb->prefix . 'wt_guest_wishlists';
            $rowcount = $wpdb->get_var("SELECT COUNT(*) FROM $table_name where `product_id` = '$product_id' and `session_id` = '$session_id'");
        }
        
        return $rowcount;
    }

}

new WT_Wishlist_Singlepage();