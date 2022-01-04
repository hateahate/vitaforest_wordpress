<div class="product__additional-info">
<?
defined( 'ABSPATH' ) || exit;
global $product;
$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional information', 'woocommerce' ) );
?>
<? do_action( 'woocommerce_product_additional_information', $product ); ?>
</div>
</div>