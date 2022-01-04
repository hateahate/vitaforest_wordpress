<?
// Get SKU number for product (vft_sku_display_single())
?>
<?
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
<p class="product__sku">SKU: <? sku_draw(); ?></p>
