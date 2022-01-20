<?
function hide_arrow(){
$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$query=parse_url($url);
	if (array_key_exists('query', $query)){
		$arraykey= 'true';
	}
	else{
		$arraykey= 'false';
	}
$urlpath = $query["path"];
$s = substr($urlpath, 6);
$defaultpath = '/my-account/';
	if ($s === $defaultpath){
		$r = 'true';
	}
	else{
		$s2 = substr($urlpath, 3);
		if ($s2 === $defaultpath){
			$r = 'true';
		}
		else{
			if ($urlpath == $defaultpath){
				$r = 'true';
			}
		else{
			$r = 'false';
		}
		}
	}
$defaultpath = '/my-account/';
if ($r == 'true' && $arraykey == 'false'){
null;
}
else {
echo '<a href="javascript:history.back()" class="woocommerce-MyAccount-content__back-btn">'.'<svg width="11" height="6"
          viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M1.39659 0.5L5.5 3.75864L9.60341 0.5L10.5 1.52935L5.5 5.5L0.5 1.52935L1.39659 0.5Z" fill="#303236" />
        </svg>'.'</a>';
}
}
?>


<div class="woo-container">
<?
	 defined( 'ABSPATH' ) || exit;
do_action( 'woocommerce_account_navigation' ); ?>
<? hide_arrow(); ?>
<div class="woocommerce-MyAccount-content">
	<?php
		/**
		 * My Account content.
		 *
		 * @since 2.6.0
		 */
		do_action( 'woocommerce_account_content' );
	?>
</div>
	</div>