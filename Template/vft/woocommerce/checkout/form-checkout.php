<div class="checkout-container">
<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<? echo '<a href="javascript:history.back()" class="woocommerce-MyAccount-content__back-btn">'.'<svg width="11" height="6"
          viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.39659 0.5L5.5 3.75864L9.60341 0.5L10.5 1.52935L5.5 5.5L0.5 1.52935L1.39659 0.5Z" fill="#303236" />
        </svg>'.'</a>';?>
			<h1 class="checkout-title">Checkout</h1>
			<div class="col-1">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
			</div>
				<div class="checkout-other-stuff">
						<h3 class="checkout__inner-title">
		Payment method
	</h3>
	<p class="delivery-payment-notification">
		Bank transfer method
	</p>
			</div>
			<div class="col-2">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>
	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
</div>