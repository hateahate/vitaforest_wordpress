<div class="product__info-wrapper">
<?
// Get SKU number for product (vft_sku_display())
?>
<?
if (!function_exists('sku_draw_nologin')){
function sku_draw_nologin(){
	if (is_user_logged_in()){
		null;
	}
	else{
		echo 'product__sku-nologin';
	}
}	
}
	
if (!function_exists('sku_draw')){
function sku_draw(){
		global $product;
		$sku = $product->get_sku(); // Get SKU from global array
		if ($sku != null){
			echo $sku; // If SKU is not empty get a string with value
		}
		else {
			echo 'Not setup'; // If empty we get a message
		}
	}
}
?>
<? // Sku output ?>
<? if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
if (!function_exists('login_check')){
function login_check(){
	if ( is_user_logged_in() ) {
		$loginstatus = 'true';
}
	else{
		$loginstatus = 'false';
}
	return $loginstatus;
}
}
// ------------------------------------
if (!function_exists('draw_price')){
	function draw_price(){
	global $product;
	$log_status = login_check();
	$pricestring = $product->get_price_html();
    $priceval = $product->get_price();
	if($log_status == 'true' && $priceval > 0 ){
		echo $pricestring;
	}
	else{
		null;
	}
	}
}
?>
<p class="product__sku <? sku_draw_nologin(); ?>">SKU: <? sku_draw(); ?></p>
<div class="price-desktop"><? echo draw_price(); ?></div>
</div>

