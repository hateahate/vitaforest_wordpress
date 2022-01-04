<div class="checkout__order-summary-wrapper">
<div class="checkout__order-summary order-summary order-summary-desktop">
    <div class="order-summary__head">
        <h3 class="order-summary__title">Order summary</h3>
        <?
        function count_items_checkout(){
            $count = 0;
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $count++;
            }
            return $count;
        }
        ?>
        <p class="order-summary__items-qty"><? echo count_items_checkout(); ?> <span class="order-summary__items-qty-title">items</span></p>
    </div>
    <div class="order-summary__items">
    <?  global $woocommerce;
    global $product;
    $items = $woocommerce->cart->get_cart();

        foreach($items as $item => $values) { 
            $_product =  wc_get_product( $values['data']->get_id());
            ?>
            <div class="order-summary__item summary-item">
            <?
            $title = $_product->get_title();
            $price = $_product->get_price();
            $ps = $_product->get_attribute('productionstatus');
            $qty = $values['quantity'];
			if ($ps == 'Get now'){
				$attribute2 = ' minicart-item__status_avaliable';
			}
			elseif ($ps == 'Soon'){
				$attribute2 = ' minicart-item__status_request';
			}
			else{
				$attribute2 = '';
			}
            ?>
                <div class="summary-item__thumb">
                    <img class="minicart-item__thumbnail" src="<?php echo wp_get_attachment_url( $_product->get_image_id() ); ?>" alt="Cart item thumbnail">
                    <? echo '<p class="minicart-item__status'.$attribute2.'">'.$ps.'</p>'; ?>
                </div>
                <div class="summary-item__details">
                    <p class="minicart-item__title"><? echo $title; ?></p>
                    <p class="minicart-item__price"><? if ($price <=0){null;}else{ echo get_woocommerce_currency_symbol(); echo $price.' / kg';} ?></p>
                        <div class="summary-item__price-details">
                            <p class="minicart-item__qty"><? echo $qty; ?></p>
                            <?
                            $sipt = $price * $qty;
                            ?>
                            <p class="summary-item__price-total"><? if ($price <=0){null;}else{echo get_woocommerce_currency_symbol(); echo $sipt;} ?></p>
                        </div>
                </div>
            </div>
            <?}?>
    </div>
    <div class="order-summary__details price-details">
        <div class="price-details__before-total">
            <table>
                <? $subtotal = WC()->cart->get_displayed_subtotal(); ?>
            <tr class="price-details__cart-subtotal">
                <td class="subtotal-left"><p>Cart subtotal</p></td>
                <td class="subtotal-right"><?echo get_woocommerce_currency_symbol(); echo $subtotal; ?></td>
            </tr>
			<tr class="price-details__cart-subtotal">
				<td class="subtotal-left"><p>Shipping</p></td>
				<td class="subtotal-right">Individual calculation</td>
			</tr>
            <tr class="price-details__coupon-discount">
            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <td><?php wc_cart_totals_coupon_label( $coupon ); ?></td>
                <td><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
            </tr>
            <?php endforeach; ?>
            </table>
        </div>
    <table>
    <tr class="price-details__order-total">
        <td class="subtotal-left">Order total:</td>
        <? $ordertotal = (int)$woocommerce->cart->total; ?>
        <td class="subtotal-right"><?echo get_woocommerce_currency_symbol(); echo $ordertotal;?></td>
    </tr>
    </table>
    </div>
</div>
<div class="checkout__order-summary order-summary order-summary-mobile">
<h3 class="order-summary__title-mobile">Order summary</h3>
<p class="order-summary__items-qty-mobile"><? echo count_items_checkout(); ?> <span class="order-summary__items-qty-title">items</span></p>
    <table class="order-summary-mobile__table">
        <thead class="order-summary-mobile__table-head">
             <tr class="order-summary-mobile__table-head-row">
                 <th class="order-summary-mobile__table-head-row-element row-element__name">Product</th>
                 <th class="order-summary-mobile__table-head-row-element row-element__price">Unit price</th>
                 <th class="order-summary-mobile__table-head-row-element row-element__qty">Qty</th>
                 <th class="order-summary-mobile__table-head-row-element row-element__amount">Amount</th>
             </tr>    
        </thead>
        <tbody class="order-summary-mobile__table-body mobile-summary-items">
            <?
            $items2 = $woocommerce->cart->get_cart();
            foreach($items2 as $item => $values) {
                $title2 = $_product->get_title();
                $price2 = $_product->get_price();
                $qty2 = $values['quantity'];
                $sipt2 = $price2*$qty2;
            $_product =  wc_get_product( $values['data']->get_id());
            ?>
            <tr class="order-summary-mobile__summary-item">
               <td class="order-summary-mobile__summary-item-title"><? echo $title2; ?></td>
               <td class="order-summary-mobile__summary-item-unit-price"><? if ($price2 <=0){null;}else{ echo get_woocommerce_currency_symbol(); echo $price2;} ?></td>
               <td class="order-summary-mobile__summary-item-qty"><span class="mama-prosti"><? echo $qty2; ?></span></td>
               <td class="order-summary-mobile__summary-item-amount"><?  if ($price2 <=0){null;}else{echo get_woocommerce_currency_symbol(); echo $sipt2;} ?></td>
            </tr>
            <? } ?>
        </tbody>
    </table>
    <div class="order-total-mobile">
        <p class="order-total-mobile-title ">Cart subtotal: <?echo get_woocommerce_currency_symbol(); echo $subtotal; ?></p>
		<p class="order-total-mobile-title__shipping">Shipping: Individual calculation</p>
        <p class="order-total-mobile-title__order-total">Order total: <?echo get_woocommerce_currency_symbol(); echo $ordertotal;?></p>
    </div>
    
</div>
<?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
</div>