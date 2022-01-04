<div class="minicart">
<?php
    global $woocommerce;
    global $product;
    $items = $woocommerce->cart->get_cart();

        foreach($items as $item => $values) { 
            $_product =  wc_get_product( $values['data']->get_id());
            ?>
            <div class="minicart-item">
            <?
            $title = $_product->get_title();
            $price = get_post_meta($values['product_id'] , '_price', true);
            $qty = $values['quantity'];
            $total = $price * $qty;
            ?>
                <div class="minicart-item__thumbnail"><img src="<?php echo wp_get_attachment_url( $product->get_image_id() ); ?>" alt="<? echo $title; ?>" /></div>
                <div class="minicart-item__details">
                    <p class="minicart-item__title"><? echo $title; ?></p>
                    <p class="minicart-item__price-raw"><? echo $qty; ?> * <? echo $price; ?></p>
                    <p class="minicart-item__price-total"><? echo $total; ?></p>
                </div>
            </div>
            <?
        } 
?>
</div>