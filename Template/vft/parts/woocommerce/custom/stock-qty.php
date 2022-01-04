<?
// Stock quantity get
if (!function_exists('stock_qty')){
function stock_qty(){
    global $product;
	$price = $product->get_price();
    $stock = $product->is_in_stock();
    $qty = $product->get_stock_quantity();
	$ulogin = is_user_logged_in();
	$mqty = $product->get_meta('_input_qty');
	$prstatus = $product->get_attribute('productionstatus');
	$border = $product->backorders_allowed();
    $qtyout = '<p class="product__stock-info">In stock:&nbsp<span class="product__stock-qty"> '.$qty.' kg</span></p>';
    $qtyout2 = '<p class="product__stock-info">Backorder</p>';
	$qtyout3 = '<p class="product__stock-info">Out of stock</p>';
	$qtyout4 = '<p class="product__stock-info">In stock</p>';
	$qtyout5 = '<p class="product__stock-info">Request</p>';
    if ($ulogin == true && $qty > $mqty && $stock == true && $price > 0){
        echo $qtyout;
    }
	elseif ($ulogin == true && $qty < $mqty && $stock == true && $border == true){
		echo $qtyout2;
	}
	elseif ($ulogin == true && $stock == true && $qty <=0){
		echo $qtyout4;
	}
	elseif ($ulogin == true && $prstatus == 'Soon'){
		echo $qtyout5;
	}
	elseif ($ulogin == true && $qty < $mqty && $stock == true && $border == false){
		echo $qtyout3;
	}
	elseif ($ulogin == true && $stock == false){
		echo $qtyout3;
	}
	elseif ($ulogin == false && $stock == true ){
		echo $qtyout4;
	}
	elseif ($ulogin == false && $stock == false){
		$qtyout3;
	}
	elseif ($ulogin == false && $prstatus == 'Soon'){
		$qtyout5;
	}
	else{
		echo '<p class="product__stock-info">Error. Out of logical scheme.</p>';
	}
}
}
?>
<? stock_qty(); ?>