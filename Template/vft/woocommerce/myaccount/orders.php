<?php
// VFT Orders page
// Last Update 09.07.2021
// Rev. 7
?>
<h2 class="my-account-title">Orders</h2>
<?
defined( 'ABSPATH' ) || exit;
do_action( 'woocommerce_before_account_orders', $has_orders ); ?>
<?php if ( $has_orders ) : ?>

<div class="orders">
	<div class="orders__head">
	<div class="orders__navigation">
		<button class="orders__navigation-btn orders__navigation-btn_all">All <span class="all-count order-count"></span></button>
		<button class="orders__navigation-btn orders__navigation-btn_onhold">On hold <span class="onhold-count order-count"></span></button>
		<button class="orders__navigation-btn orders__navigation-btn_complete">Complete <span class="completed-count order-count"></span></button>
	</div>
	<div class="orders__table-heading table-heading">
		<div class="table-heading__element">
			<p class="table-heading__element-title title-number">Order number</p>
		</div>
		<div class="table-heading__element">
			<p class="table-heading__element-title title-date">Date</p>
		</div>
		<div class="table-heading__element">
			<p class="table-heading__element-title title-status">Status</p>
		</div>
		<div class="table-heading__element">
		    <p class="table-heading__element-title title-total">Order total</p>
			
		</div>
		<div class="table-heading__element">
			<p class="table-heading__element-title title-actions">Actions</p>
		</div>
	</div>
	</div>
	<div class="orders__items-container">
	<? foreach ( $customer_orders->orders as $customer_order ) {
		$order      = wc_get_order( $customer_order ); 
		$item_count = $order->get_item_count() - $order->get_item_count_refunded(); ?>
	<? $columns_vft = wc_get_account_orders_columns();
		unset($columns_vft['order-placed-by']); ?>
	<div class="order-item<? $orderstatus2 = $order->get_status(); if($orderstatus2 == 'completed'){echo ' order-item_complete';}elseif($orderstatus2 == 'on-hold'){echo ' order-item_onhold';} else{null;} ?>">
		<?php foreach ( $columns_vft as $column_id => $column_name ) : ?>
		<?php if ( has_action( 'woocommerce_my_account_my_orders_column_' . $column_id ) ) : ?>
		<?php do_action( 'woocommerce_my_account_my_orders_column_' . $column_id, $order ); ?>
		<?php elseif ( 'order-number' === $column_id ) : ?>
		<h3 class="order-item__id"><?php echo esc_html( _x( '', '', 'woocommerce' ) . $order->get_order_number() );?></h3>
		<?php elseif ( 'order-date' === $column_id ) : ?>
		<p class="order-item__time"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></p>
		<?php elseif ( 'order-total' === $column_id ) : ?>
		<p class="order-item__summary">
			<? echo wp_kses_post( sprintf( _n( '<span>%1$s <span class="order-page-items">for %2$s item</span></span>', '<span>%1$s <span class="order-page-items">for %2$s items</span></span>', $item_count, 'woocommerce' ), $order->get_formatted_order_total(), $item_count ) ); ?>
		</p>
		<? elseif ( 'order-actions' === $column_id ) : ?>
		<? $actions = wc_get_account_orders_actions( $order );
		if ( ! empty( $actions ) ) {
		foreach ( $actions as $key => $action ) {
			echo '<a href="' . esc_url( $action['url'] ) . '" class="order-iteam__btn btn ' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a>';
		}
	}?>
		<?php elseif ( 'order-status' === $column_id ) : ?>
		<p class="order-item__status order-item__status<? $orderstatus = $order->get_status(); if($orderstatus == 'completed'){echo ' order-item__status_complete';}elseif($orderstatus == 'cancelled'){echo ' order-item__status_cancelled';} else{null;}?>"><?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?></p>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
<? } ?>
	</div>						
</div>
	<?php do_action( 'woocommerce_before_account_orders_pagination' ); ?>

	<?php if ( 1 < $customer_orders->max_num_pages ) : ?>
<div class="woocommerce-pagination woocommerce-pagination--without-numbers woocommerce-Pagination">
	<?php if ( 1 !== $current_page ) : ?>
	<a class="woocommerce-button woocommerce-button--previous woocommerce-Button woocommerce-Button--previous button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page - 1 ) ); ?>"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/backward.png" alt="Previous button"></a>
	<?php endif; ?>

	<?php if ( intval( $customer_orders->max_num_pages ) !== $current_page ) : ?>
	<a class="woocommerce-button woocommerce-button--next woocommerce-Button woocommerce-Button--next button" href="<?php echo esc_url( wc_get_endpoint_url( 'orders', $current_page + 1 ) ); ?>"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/forward.png" alt="Next button">
</a>
	<?php endif; ?>
</div>
	<?php endif; ?>
	<?php else : ?>
<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<a class="woocommerce-Button button" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>"><?php esc_html_e( 'Browse products', 'woocommerce' ); ?></a>
		<?php esc_html_e( 'No order has been made yet.', 'woocommerce' ); ?>
</div>
<?php endif; ?>
<?php do_action( 'woocommerce_after_account_orders', $has_orders ); ?>