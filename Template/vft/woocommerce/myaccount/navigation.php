<?
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
if ($r == 'true' && $arraykey == 'true'){
    $headerhide = ' my-account-header_hide';
	$navhide = ' woocommerce-MyAccount-navigation_hide';
}
else if ($r == 'false' && $arraykey == 'false'){
	$headerhide = ' my-account-header_hide';
	$navhide = ' woocommerce-MyAccount-navigation_hide';	
	}
else if ($r == 'false' && $arraykey == 'true'){
	$headerhide = ' my-account-header_hide';
	$navhide = ' woocommerce-MyAccount-navigation_hide';	
	}
else {
	$headerhide = '';
	$navhide = '';
}


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>
<div class="my-account-wrapper">
<?
$uid = get_current_user_id();
$userdata = get_userdata($uid);
$firstname = $userdata->first_name;
$lastname = $userdata->last_name;
$email = $userdata->user_email;
?>
<div class="my-account-header<? echo $headerhide; ?>">
<h3 class="my-account-header__username"><? echo $firstname.' '.$lastname; ?></h3>
<p class="my-account-header__email"><? echo $email; ?></p>
<a href="/my-account/edit-account/" class="my-account-header__edit"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/edit.svg" alt="Edit button"></a>
	<div class="my-account-header__nav account-nav">
    <a href="/my-account/edit-account/" class="account-nav__pass account-nav__link">Change password</a>
    <a href="/log-out/" class="account-nav__logout account-nav__link">Logout</a>
  </div>
</div>
<nav class="woocommerce-MyAccount-navigation<? echo $navhide; ?>">
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>
</div>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>