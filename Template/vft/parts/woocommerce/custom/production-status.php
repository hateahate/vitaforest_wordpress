<?
// Production status display function (vft_productionstatus_display())
?>
<?
if (!function_exists('status_display')){
function status_display(){
    global $product;
    $value = $product->get_attribute('productionstatus');
    if ($value == "Get now"){
        echo '<p class="product__status product__status_avaliable">Get now</p>';
    }
    elseif ($value == "Soon"){
        echo '<p class="product__status product__status_request">Soon</p>';
    }
    else{
        echo '<p class="product__status product__status_empty">'.'</p>';
    }
}
}
?>
<? status_display(); ?>