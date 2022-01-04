<div class="main-cart">
	<div class="main-cart__table">
		<? foreach ( WC()->session->get( 'quotes' ) as $quote_item_key => $quote_item ) {

if (  !isset( $quote_item['data'] ) || !is_object( $quote_item['data'] ) ) {
    continue;
}
$quote_product  = apply_filters( 'addify_quote_item_product', $quote_item['data'], $quote_item, $quote_item_key );

if ( $quote_product && $quote_product->exists() && $quote_item['quantity'] > 0 && apply_filters( 'addify_quote_item_visible', true, $quote_item, $quote_item_key ) ) {
	$quote_items_qty++;
}}; 
?>
		<div class="main-cart__head">
			<h1 class="main-cart__title">
				Shopping cart
			</h1>
			<?
			function count_items_cart(){
            $count = 0;
            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                $count++;
            }
            return $count;
        }
			?>
			<p class="main-cart__items-count"><? $qty = count_items_cart(); echo $qty + $quote_items_qty; ?> items</p>
		</div>
		<div class="request-items-cont">
			<?
$price_display    = 'yes' === get_option( 'afrfq_enable_pro_price' ) ? true : false;
$of_price_display = 'yes' === get_option( 'afrfq_enable_off_price' ) ? true : false;
$tax_display      = 'yes' === get_option( 'afrfq_enable_tax' ) ? true : false;
$colspan          = 4;
$colspan          = $price_display ? $colspan + 2 : $colspan;
$colspan          = $of_price_display ? $colspan + 2 : $colspan;

do_action( 'addify_before_quote_table' ); ?>
	    <? $quote_elements = 0; ?>
<? foreach ( WC()->session->get( 'quotes' ) as $quote_item_key => $quote_item ) {

if (  !isset( $quote_item['data'] ) || !is_object( $quote_item['data'] ) ) {
    continue;
}
$quote_product  = apply_filters( 'addify_quote_item_product', $quote_item['data'], $quote_item, $quote_item_key );

if ( $quote_product && $quote_product->exists() && $quote_item['quantity'] > 0 && apply_filters( 'addify_quote_item_visible', true, $quote_item, $quote_item_key ) ) {
	$quote_elements++;
}}; 
if($quote_elements > 0 ){
	echo '<h3 class="cart-inner-request__title">Items requiring request</h3>';
	echo '<div class="request-notification">
	<p class="request-notification__text">'.$quote_elements.' item(s) have been added to the request cart. <a href="#" class="request-notification__link">Learn more</a></p>
	</div>';
}
?>
	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents  addify-quote-form__contents cart-inner-request" cellspacing="0" <? if($quote_elements == 0){ echo 'style="display: none;"';} ?>>
		<thead>
			<tr>
				<th class="product-remove">Product</th>
				<th class="product-thumbnail">&nbsp;</th>
				<th class="product-name"><?php esc_html_e( 'Quantity', 'addify_rfq' ); ?></th>
				<?php if ( $price_display ) : ?>
					<th class="product-price"><?php esc_html_e( 'Price', 'addify_rfq' ); ?></th>
				<?php endif; ?>
				<?php if ( $of_price_display ) : ?>
					<th class="product-price"><?php esc_html_e( 'Offered Price', 'addify_rfq' ); ?></th>
				<?php endif; ?>
				<th class="product-quantity"></th>
				<?php if ( $price_display ) : ?>
					<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'addify_rfq' ); ?></th>
				<?php endif; ?>
				<?php if ( $of_price_display ) : ?>
					<th class="product-subtotal"><?php esc_html_e( 'Offered Subtotal', 'addify_rfq' ); ?></th>
				<?php endif; ?>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'addify_before_quote_contents' ); ?>

			<?php
			foreach ( WC()->session->get( 'quotes' ) as $quote_item_key => $quote_item ) {

				if (  !isset( $quote_item['data'] ) || !is_object( $quote_item['data'] ) ) {
					continue;
				}

				$_product      = apply_filters( 'addify_quote_item_product', $quote_item['data'], $quote_item, $quote_item_key );
				$product_id    = apply_filters( 'addify_quote_item_product_id', $quote_item['product_id'], $quote_item, $quote_item_key );
				$price         = empty( $quote_item['addons_price'] ) ? $_product->get_price('edit') : $quote_item['addons_price'];
				$offered_price = isset( $quote_item['offered_price'] ) ? floatval( $quote_item['offered_price'] ) : $price;

				if ( $_product && $_product->exists() && $quote_item['quantity'] > 0 && apply_filters( 'addify_quote_item_visible', true, $quote_item, $quote_item_key ) ) {
					$product_permalink = apply_filters( 'addify_quote_item_permalink', $_product->is_visible() ? $_product->get_permalink( $quote_item ) : '', $quote_item, $quote_item_key );
					?>
					<tr class="woocommerce-cart-form__quote-item <?php echo esc_attr( apply_filters( 'addify_quote_item_class', 'cart_item', $quote_item, $quote_item_key ) ); ?>">

						<td class="product-thumbnail">
						<?php
						$thumbnail = apply_filters( 'addify_quote_item_thumbnail', $_product->get_image(), $quote_item, $quote_item_key );

						if ( ! $product_permalink ) {
							echo wp_kses_post( $thumbnail ); // phpcs:ignore WordPress.Security.EscapeOutput
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) ); // phpcs:ignore WordPress.Security.EscapeOutput
						}
						?>
						</td>

						<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'addify_rfq' ); ?>">
						<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'addify_quote_item_name', $_product->get_name(), $quote_item, $quote_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'addify_quote_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $quote_item, $quote_item_key ) );
						}

						do_action( 'addify_after_quote_item_name', $quote_item, $quote_item_key );

						// Meta data.
						echo wp_kses_post( wc_get_formatted_cart_item_data( $quote_item ) ); // phpcs:ignore WordPress.Security.EscapeOutput

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $quote_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'addify_quote_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'addify_rfq' ) . '</p>', $product_id ) );
						}
						?>
						</td>

						<?php if ( $price_display ) : ?>
							<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'addify_rfq' ); ?>">
								<?php
									$args['qty']   = 1;
									$args['price'] = empty( $quote_item['addons_price'] ) ? $_product->get_price('edit') : $quote_item['addons_price'];
									
									echo wp_kses_post( apply_filters( 'addify_quote_item_price', $af_quote->get_product_price( $_product, $args ), $quote_item, $quote_item_key ) ); // phpcs:ignore WordPress.Security.EscapeOutput
								?>
							</td>
						<?php endif; ?>
						
						<?php if ( $of_price_display ) : ?>
							<td class="product-price offered-price" data-title="<?php esc_attr_e( 'Offered Price', 'addify_rfq' ); ?>">
								<input type="number" class="input-text offered-price-input text" step="any" name="offered_price[<?php echo esc_attr( $quote_item_key ); ?>]" value="<?php echo esc_attr( $offered_price ); ?>">
							</td>
						<?php endif; ?>	

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'addify_rfq' ); ?>">
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '<input type="hidden" name="quote_qty[%s]" value="1" />', $quote_item_key );
						} else {
							woocommerce_quantity_input(
								array(
									'input_name'   => "quote_qty[{$quote_item_key}]",
									'input_value'  => $quote_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
								),
								$_product,
								true
							);
						}
						?>
						</td>
						<td class="product-remove">
							<div class="product-remove__relative-container">
								<div class="product-remove-inner">
							<?php
								// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								echo wp_kses_post( apply_filters( 
									'addify_quote_item_remove_link',
									sprintf(
										'<a href="%s" class="remove remove-cart-item remove-quote-item" aria-label="%s" data-cart_item_key="%s" data-product_id="%s" data-product_sku="%s"></a>',
										esc_attr( $quote_item_key ),
										esc_html__( 'Remove this item', 'addify_rfq' ),
										esc_attr( $quote_item_key ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$quote_item_key
								) );
							?>
									</div>
								</div>
						</td>

						<?php if ( $price_display ) : ?>
							<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'addify_rfq' ); ?>">
								<?php
									$args['qty']   = $quote_item['quantity'];
									$args['price'] = empty( $quote_item['addons_price'] ) ? $_product->get_price('edit') : $quote_item['addons_price'];
									echo wp_kses_post( apply_filters( 'addify_quote_item_subtotal', $af_quote->get_product_subtotal( $_product, $quote_item['quantity'], $args ), $quote_item, $quote_item_key ) ); // phpcs:ignore WordPress.Security.EscapeOutput
								?>
							</td>
						<?php endif; ?>	

						<?php if ( $of_price_display ) : ?>
							<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'addify_rfq' ); ?>">
								<?php
									echo wp_kses_post( apply_filters( 'addify_quote_item_subtotal', wc_price( $offered_price * $quote_item['quantity'] ), $quote_item, $quote_item_key ) ); // phpcs:ignore WordPress.Security.EscapeOutput
								?>
							</td>
						<?php endif; ?>
						
					</tr>
					<?php
				}
			}
			?>
			<td colspan="<?php echo esc_attr( $colspan ); ?>" class="actions">

					<button type="button" type="submit" id="afrfq_update_quote_btn" class="button afrfq_update_quote_btn" name="update_quote" value="<?php esc_html_e( 'Update Quote', 'addify_rfq' ); ?>"><?php esc_html_e( 'Update Quote', 'addify_rfq' ); ?></button> 

					<?php do_action( 'addify_quote_actions' ); ?>

					<?php wp_nonce_field( 'addify-cart', 'addify-cart-nonce' ); ?>
				</td>
			</tbody>
			<?php do_action( 'addify_quote_contents' ); ?>
			</tbody>
		</table>
			<?php do_action( 'addify_after_quote_contents' ); ?>

	<?php do_action( 'addify_after_quote_table' ); ?>
		</div>
<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>
<h3 class="main-cart__title" <? if($quote_elements == 0){echo 'style="display: none;"';} ?>>
Available products	
</h3>
<form class="woocommerce-cart-form origin-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-thumbnail"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-name"><span class="product-name-hide"><?php esc_html_e( 'Product', 'woocommerce' ); ?></span></th>
				<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
				<th class="product-placeholder">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-thumbnail">
						<?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

						if ( ! $product_permalink ) {
							echo $thumbnail; // PHPCS: XSS ok.
						} else {
							printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
						}
						?>
						</td>

						<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
						<?php
						if ( ! $product_permalink ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<p class="product-name__row"><a href="%s">%s</a></p>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}

						do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

						// Meta data.
						echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

						// Backorder notification.
						if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
							echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
						}
						?>
	<? $prodstatus = $_product->get_attribute('productionstatus');
    if ($prodstatus == "Get now"){
        echo '</br><p class="main-cart__item-status main-cart__item-status_avaliable">Get now</p>';
    }
    elseif ($prodstatus == "Soon"){
        echo '</br><p class="main-cart__item-status main-cart__item-status_request">Soon</p>';
    }
    else{
        echo '</br><p class="main-cart__item-status main-cart__item-status_empty">'.'</p>';
    }?>
						</td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
						$cart_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
					    $p = $_product->price;
					if ( $p <= 0 ){
						null;
					}
					else{
						echo $cart_price;
					}
							?>
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php
						if ( $_product->is_sold_individually() ) {
							$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
						} else {
							$product_quantity = woocommerce_quantity_input(
								array(
									'input_name'   => "cart[{$cart_item_key}][qty]",
									'input_value'  => $cart_item['quantity'],
									'max_value'    => $_product->get_max_purchase_quantity(),
									'min_value'    => '0',
									'product_name' => $_product->get_name(),
								),
								$_product,
								false
							);
						}

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
						</td>

						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?php
								$subtotal = apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
					 $sp = $_product->price;
					if ($sp <= 0 ){
						null;
					}
					else{
						echo $subtotal;
					}
							?>
						</td>
						<td class="product-remove">
							<div class="product-remove__relative-container" style="position: relative;">
							<div class="product-remove-inner">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg width="10" height="14" viewBox="0 0 10 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.01016 5.80005C4.54071 5.80005 4.16016 6.18061 4.16016 6.65005V10.25C4.16016 10.7195 4.54071 11.1 5.01016 11.1C5.4796 11.1 5.86016 10.7195 5.86016 10.25V6.65005C5.86016 6.18061 5.4796 5.80005 5.01016 5.80005Z" fill="#7F878B"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M2.14286 13.5C1.35714 13.5 0.714286 12.85 0.714286 12.0556V4.11111C0.714286 3.71224 1.03408 3.38889 1.42857 3.38889H8.57143C8.96592 3.38889 9.28571 3.71224 9.28571 4.11111V12.0556C9.28571 12.85 8.64286 13.5 7.85714 13.5H2.14286ZM7.85714 4.83333H2.14286V12.0556H7.85714V4.83333Z" fill="#7F878B"/>
<path d="M7.29079 1.01069C7.42475 1.14613 7.60643 1.22222 7.79587 1.22222H9.28571C9.6802 1.22222 10 1.54557 10 1.94444C10 2.34332 9.6802 2.66667 9.28571 2.66667H0.714286C0.319797 2.66667 0 2.34332 0 1.94444C0 1.54557 0.319797 1.22222 0.714286 1.22222H2.20413C2.39357 1.22222 2.57525 1.14613 2.70921 1.01069L3.00508 0.711534C3.13903 0.576091 3.32071 0.5 3.51015 0.5H6.48985C6.67929 0.5 6.86097 0.576091 6.99492 0.711534L7.29079 1.01069Z" fill="#7F878B"/>
</svg>
</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
								</div>
								</div>
						</td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>
			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<div class="request-in-cart">
	<?
	if ( ! isset( $af_quote ) ) {
	$af_quote = new AF_R_F_Q_Quote();
}?>
	</div>
	<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>
<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>
<div class="cart-controls">
<div class="cart-other-actions">									
					<button type="submit" class="button btn-upd" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M15.8676 0.400391C15.4576 0.400391 15.1275 0.736833 15.1353 1.14668L15.1963 4.34611L14.9895 4.02602C13.5762 1.83831 11.1022 0.400817 8.33839 0.433486L8.33656 0.433508C3.93282 0.433822 0.368008 4.09344 0.400118 8.53266L0.400126 8.53386C0.400313 13.0062 3.96514 16.6004 8.36972 16.6004C10.3922 16.6004 12.2868 15.8183 13.7002 14.5471L13.7061 14.5409C13.8204 14.4189 13.8186 14.2297 13.7007 14.1099L13.0492 13.4477C12.9681 13.3652 12.8059 13.3496 12.676 13.4518L12.6711 13.4562C11.5121 14.4979 10.0228 15.1024 8.36972 15.1024C4.76092 15.1024 1.87698 12.173 1.87698 8.50038C1.87698 4.86122 4.76056 1.89839 8.36972 1.89839C10.9873 1.89839 13.2395 3.51514 14.2661 5.80439L14.3393 5.96763L10.5231 5.87887C10.1161 5.8694 9.7811 6.19671 9.7811 6.60377C9.7811 7.00422 10.1057 7.32886 10.5062 7.32886H16.0999C16.376 7.32886 16.5999 7.105 16.5999 6.82886V1.13274C16.5999 0.728274 16.272 0.400391 15.8676 0.400391Z" fill="#40BF6A"/>
					</svg>
					<?php esc_html_e( 'Update shopping cart', 'woocommerce' ); ?></button>
					<?php do_action( 'woocommerce_cart_actions' ); ?>
					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
					</div>
					<a href="/request-a-quote" class="go-to-request btn" <? if($quote_items_qty == 0){echo 'style="display: none;"';}?>>Go to request cart</a>
					<a href="/checkout" class="send-request btn">Start new order</a>
</div>
</form>
</div>
	<div class="main-cart__coupon">
		<h3 class="main-cart__coupon-title">Apply discount code</h3>
			<form class="woocommerce-coupon-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
			<?php if ( wc_coupons_enabled() ) { ?>
				<div class="coupon">
				<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> 
				<button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply', 'woocommerce' ); ?></button>
				</div>
			<?php } ?>
		</form>
	</div>
<?php do_action( 'woocommerce_after_cart' ); ?>
<div class="request-learn-more">
<div class="requestin-popup">
    <div class="logout-popup__head">
        <p class="logout-popup__title">
            About request
        </p>
        <button class="close-requestin-popup"><img
                src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/burger-close.svg"
                alt="Close button"></button>
    </div>
    <p class="logout-popup__text">Some of the products you added to the cart have the "Request" status, you can change the number of added products, as well as add a comment on the <a href="/request-a-quote">request page</a>. When you click the "Start new order" button, the request will be sent automatically. After processing by the manager, it will be displayed in your personal account in the orders section.</p>
    <div class="logout-actions">
        <button class="requestin-ok">Ok</button>
    </div>
</div>	
</div>
<script>
let notifyBtn = document.querySelector('.request-notification__link');
let notifyContainer = document.querySelector('.requestin-popup');
let notifyOk = document.querySelector('.requestin-ok');
let notifyClose = document.querySelector('.close-requestin-popup');
let notifyBg = document.querySelector('.desktop-popup-bg');
notifyBtn.onclick = function(){
	notifyContainer.classList.add('requestin-popup_active');
	notifyBg.classList.add('desktop-popup-bg_active');
}
notifyOk.onclick = function(){
	notifyContainer.classList.remove('requestin-popup_active');
	notifyBg.classList.remove('desktop-popup-bg_active');
}
notifyClose.onclick = function(){
	notifyContainer.classList.remove('requestin-popup_active');
	notifyBg.classList.remove('desktop-popup-bg_active');
}
notifyBg.onclick = function(){
notifyContainer.classList.remove('requestin-popup_active');
notifyBg.classList.remove('desktop-popup-bg_active');
}
</script>
