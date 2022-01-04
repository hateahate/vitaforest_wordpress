<?php
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
global $wt_wishlist_table_settings_options;
$wishlist_text = apply_filters('wishlist_table_heading','My wish list');
?>
<h4 class='b2bking_purchase_lists_top_title'><?php _e($wishlist_text, 'wt-woocommerce-wishlist'); ?></h4>
<?php if ($products) { ?>
    <form action="">
        <table class="wt_frontend_wishlist_table" >
            <tr class='head'>
                <th colspan="2"><?php _e('Product name', 'wt-woocommerce-wishlist'); ?></th> 
                <?php if(isset($wt_wishlist_table_settings_options['wt_enable_unit_price_column'])==1){ ?> <th class="wishlist-unit-price"><div class="wishlist-unit-price-static"><?php _e('Unit price', 'wt-woocommerce-wishlist'); ?></div></th> <?php } ?>
              
				<?php if(isset($wt_wishlist_table_settings_options['wt_enable_stock_status_column'])==1){ ?> <th class="wishlist-status"><div class="wishlist-status-static"><?php _e('Stock', 'wt-woocommerce-wishlist'); ?></div></th> <?php } ?>
                <?php if(isset($wt_wishlist_table_settings_options['wt_enable_add_to_cart_option_column'])==1){ ?> <th></th> <?php } ?>
				<th class="wishlit-remove-btn-wrap"></th>
            </tr>
            <?php
            foreach ($products as $product) {
                $product_data = wc_get_product($product['product_id']);
                if ($product_data) {
                    ?>
                    <tr class="wishlist-table-row">
                        <td class='image' ><?php 
                            if($product_data->is_type( 'variable' )){
                                if($product['variation_id'] !=0){
                                    $product_data = wc_get_product($product['variation_id']);
                                }
                            }
                            echo $product_data->get_image('woocommerce_gallery_thumbnail'); ?> 
                        </td>
                        <td class="wishlist-product-title"> <a  class='wish-item-title' href="<?php echo $product_data->get_permalink(); ?>"><?php echo $product_data->get_title();  ?></a>
                            <?php 
                            if( (isset($wt_wishlist_table_settings_options['wt_enable_product_variation_column'])==1) && $product_data->is_type( 'variation' ) ){ 
                              echo wc_get_formatted_variation( $product_data );
                            }
                            ?>  
                        </td>
                        <?php if(isset($wt_wishlist_table_settings_options['wt_enable_unit_price_column'])==1){ ?>
                        <td class="wishlist-product-price">
							<div class="wishlist-price-inner">
                            <?php 
                            $base_price = $product_data->is_type( 'variable' ) ? $product_data->get_variation_regular_price( 'max' ) : $product_data->get_price();
                            echo $product_data->get_price_html(); ?>
								</div>
                       </td>
                        <?php } ?>
                        
                        <?php if(isset($wt_wishlist_table_settings_options['wt_enable_stock_status_column'])==1){ ?>  
                        <td class="wishlist-product-status"><?php
                            if ($product_data->is_in_stock() == 1) {
                                $instock = __('In Stock', 'wt-woocommerce-wishlist');
                                echo "<div class='stock_column' style='background: rgba(0, 206, 45, 0.1); border-radius: 40px; padding: 4px 0px;width: 82px; height: 31px;'><span style='color: #00CE2D;'><center> $instock </center></span></div>";
                                // echo "<span style=\"color: red\">$instock</span>";
                            } else {
                                $outstock = __('Out of Stock', 'wt-woocommerce-wishlist');
                                echo "<span style=\"color: red\">$outstock</span>";
                            };
                            ?>
                        </td>
                        <?php } ?>
                        <?php if(isset($wt_wishlist_table_settings_options['wt_enable_add_to_cart_option_column'])==1){ 
                            $id = ($product_data->is_type( 'variation' )) ? $product['variation_id'] : $product['product_id'] ;
                            $redirect_to_cart = isset($wt_wishlist_table_settings_options['redirect_to_cart']) ? $wt_wishlist_table_settings_options['redirect_to_cart'] : '';
                        ?>  
                        <td class="wishlist-item-remove">
                            <button  class="button single-add-to-cart" data-product_id="<?php echo $id; ?>" data-redirect_to_cart="<?php echo $redirect_to_cart; ?>" style="background: #2EA3F2;border-radius: 5px;color: white;border: none;padding: 10px 18px;"> <?php ( ! empty($wt_wishlist_table_settings_options['wt_add_to_cart_text']) ? _e($wt_wishlist_table_settings_options['wt_add_to_cart_text'], 'wt-woocommerce-wishlist')  :  _e('Add to cart', 'wt-woocommerce-wishlist') ); ?></button>
                        </td>
						<td>
                           <center><div class="wishlist-remove-btn"><div class="wishlist-remove-btn-position"><a href='#' > <i class='remove_wishlist_single'  data-product_id="<?php echo $product['product_id']; ?>" data-variation_id="<?php echo $product['variation_id']; ?>" data-product_type="<?php echo $product_data->is_type( 'variable' ); ?>"  ><svg width="10" height="14" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.01016 5.80005C4.54071 5.80005 4.16016 6.18061 4.16016 6.65005V10.25C4.16016 10.7195 4.54071 11.1 5.01016 11.1C5.4796 11.1 5.86016 10.7195 5.86016 10.25V6.65005C5.86016 6.18061 5.4796 5.80005 5.01016 5.80005Z" fill="#7F878B"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M2.14286 13.5C1.35714 13.5 0.714286 12.85 0.714286 12.0556V4.11111C0.714286 3.71224 1.03408 3.38889 1.42857 3.38889H8.57143C8.96592 3.38889 9.28571 3.71224 9.28571 4.11111V12.0556C9.28571 12.85 8.64286 13.5 7.85714 13.5H2.14286ZM7.85714 4.83333H2.14286V12.0556H7.85714V4.83333Z" fill="#7F878B"/>
<path d="M7.29079 1.01069C7.42475 1.14613 7.60643 1.22222 7.79587 1.22222H9.28571C9.6802 1.22222 10 1.54557 10 1.94444C10 2.34332 9.6802 2.66667 9.28571 2.66667H0.714286C0.319797 2.66667 0 2.34332 0 1.94444C0 1.54557 0.319797 1.22222 0.714286 1.22222H2.20413C2.39357 1.22222 2.57525 1.14613 2.70921 1.01069L3.00508 0.711534C3.13903 0.576091 3.32071 0.5 3.51015 0.5H6.48985C6.67929 0.5 6.86097 0.576091 6.99492 0.711534L7.29079 1.01069Z" fill="#7F878B"/>
</svg>
</i> </a></div></div></center>
                        </td>
                        <?php } ?>
                    </tr>
                <?php
                }
            }
            ?>
        </table>
		 <?php if(isset($wt_wishlist_table_settings_options['add_all_to_cart'])==1){
            $redirect_to_cart = isset($wt_wishlist_table_settings_options['redirect_to_cart']) ? $wt_wishlist_table_settings_options['redirect_to_cart'] : '';
        ?>
        <button id="bulk-add-to-cart" data-redirect_to_cart="<?php echo $redirect_to_cart; ?>" class="button" style="background: #2EA3F2;border-radius: 5px;color: white;border: none;padding: 10px 18px; float: right; margin-bottom: 20px;"> <?php (_e('Add all to cart', 'wt-woocommerce-wishlist') ); ?></button>
    </form>
<?php }} else { ?>
<p class="empty-wishlist-notification" style="text-align: center"><?php _e('No item added to your wishlist', 'wt-woocommerce-wishlist'); ?></p>
<?php } ?>