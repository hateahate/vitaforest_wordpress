<?
function stock_qty_changer(){
    global $product;
	$priceedit = $product->get_price();
    if ($priceedit > 0){
        echo '';
    }
	else{
		echo ' product__order_request';
	}
}
?>

<div class="product__order<? stock_qty_changer(); ?>">
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if (!function_exists('check_login')){
function check_login(){
global $product;
$price_num = $product->get_price();
$price_html = $product->get_price_html();
if ( is_user_logged_in() && $price_num > 0 ) {
echo '<div class="product__price-wrapper">';
echo '<p class="product__price">'.$price_html.'<span class="kilogramm">&nbsp/ kg</span></p>';
		echo '<div class="govno">';
	echo '<p class="govno-v-govne">total price:</p>';
echo '<p class="product__total-price"></p>';
echo '</div>';
	echo '</div>';
    }
    else{
        null;    
        }
    }
}
?>
<? check_login(); ?>


<?
defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart product_qty" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );

		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);

		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
    </div>