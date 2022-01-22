<?
if ( ! defined( 'ABSPATH' ) ) {
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
//-------------------------------------



if(!function_exists('authquote')){
	function authquote(){
		global $product;
		$lInfo = is_user_logged_in();
		$stockInfo = $product->get_stock_status();
		if ($stockInfo == 'outofstock' && $lInfo == true){
			echo get_template_part('/parts/woocommerce/auth-quote');
		}
		else{
			quote();
		}
	}
}

if(!function_exists('authquote2')){
	function authquote2(){
		global $product;
		$stockInfo = $product->get_stock_status();
		if($stockInfo == 'outofstock'){
			echo 'hide-qty-quote';
		}
	}
}



//-------------------------------------

if (!function_exists('quote')){
	function quote(){
		global $product;
		$log_status = login_check();
		$pricevalue = $product->get_price();
		if($log_status == 'true' && $pricevalue > 0){
			get_template_part('/parts/woocommerce/addtocart');
		}
		else if($log_status == 'true' && $pricevalue <= 0){
			get_template_part('/parts/woocommerce/addtoquote');
		}
		else if($log_status == 'false'){
			get_template_part('/parts/woocommerce/addtocart');
		}
	}
}
// ------------------------------------

if (!function_exists('moq_in_cart')){
function moq_in_cart(){
		global $product;
		$stockinfo = $product->is_in_stock();
		$qty = $product->get_meta('_input_qty');
	if ($qty > 0 && $stockinfo == true){
		$qtyprint = "&quantity=".$qty;
		return $qtyprint;
	}
		else{
			null;
		}
	}
}
?>
	<?
	global $product;
	$dvalue = $product->get_meta('_input_qty');
	$svalue = $product->get_meta('_step_qty');
	?>
<?
if (!function_exists('hide_qty_editor')){
	function hide_qty_editor(){
	if (is_user_logged_in()){
	null;
	}
	else{
	echo 'number-nologin';
	}
}
}
?>
<?
if (!function_exists('logged_sku')){
	function logged_sku(){
	if (is_user_logged_in()){
	echo 'product__sku-bottom_logged';
	}
	else{
	null;
	}
}
}
?>
<?
if (!function_exists('sku_drawer')){
function sku_drawer(){
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
<div class="product__purchase-wrapper">
<p class="product__sku product__sku-bottom <? logged_sku(); ?>">SKU: <? sku_drawer(); ?></p>
	<? authquote(); ?>
<div class="number <? hide_qty_editor(); ?> <? authquote2(); ?>">
	<button class="number-minus" type="button" onclick="this.nextElementSibling.stepDown(); this.nextElementSibling.onchange();">-</button>
	<input class="product-quantity" type="number" value="<? if ($dvalue <= 0){echo '1';}else{echo $dvalue;} ?>" step="<? if ($svalue <= 0){echo '1';}else{echo $svalue;} ?>" min="<? if ($dvalue <= 0){echo '1';}else{echo $dvalue;} ?>"/>
	<button class="number-plus" type="button" onclick="this.previousElementSibling.stepUp(); this.previousElementSibling.onchange();">+</button>
</div>
		<?
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
<div class="price-mobile">
<? echo draw_price(); ?>
</div>
</div>