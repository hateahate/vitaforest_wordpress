<?php
header('Expires: '.gmdate('D, d M Y H:i:s', time() + 7200).' GMT');
header('Cache-Control: no-cache, must-revalidate');
$mt = filemtime($file_name);
$mt_str = gmdate("D, d M Y H:i:s ")."GMT";
if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) &&
strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) >= $mt)
{header('HTTP/1.1 304 Not Modified');
die;
}
header('Last-Modified: '.$mt_str);
echo $text;
header("Vary: Accept-Encoding");
header("Accept-Encoding:gzip,deflate,sdch");
?>
<?wp_head();?>
<a class="back_to_top" title="Go up">&uarr;</a>
<div class="advisitor-btn">
	
</div>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TPDRRC5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<noscript><img src="https://mc.yandex.ru/watch/65590639" style="position:absolute; left:-9999px;" alt="yandex-metrika" /></noscript>
<div class="desktop-popup-bg">
</div>
<div class="bg-layer"></div>
<div class="document-container">
	<div class="main">
  <header class="header">
    <div class="header__container">
      <div class="header__row user__btns">
        <button class="svg-btn show-menu"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/burger.svg" alt="Menu icon"></button>
        <div class="logo">
          <a href="/"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/logo.svg" alt="Website logo"></a>
        </div>
        <button class="svg-btn show-search"><picture>
			<source media="(max-width: 1127px)" srcset="<?php echo get_bloginfo( 'template_directory' ); ?>/img/m-search.svg">
			<source media="(max-width: 1128px)" srcset="<?php echo get_bloginfo( 'template_directory' ); ?>/img/search.svg">
			<img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/search.svg" alt="Search icon"/>
			</picture></button>
        <?php get_search_form(); ?>
		  <?
		  function my_acc_btn(){
		  if (is_user_logged_in()){
			$uid = get_current_user_id();
			$userdata = get_userdata($uid);
			$firstname = $userdata->first_name;
			$lastname = $userdata->last_name;
			$fullname = $firstname.' '.$lastname;
			$fulllenght = iconv_strlen($fullname);
			  if ($fulllenght > 11){
				$cuttedwdots = substr($fullname, 0, 9);
				$result = $cuttedwdots.'...';
				echo $result;
			  }
			  else{
				  echo $fullname;
			  }
		  			}
		  	else{
			  echo 'My account';
			}
		  }
		  ?>
        <button class="svg-btn header__user-open"><picture>
			<source media="(max-width: 1127px)" srcset="<?php echo get_bloginfo( 'template_directory' ); ?>/img/m-user-icon.svg">
			<source media="(max-width: 1128px)" srcset="<?php echo get_bloginfo( 'template_directory' ); ?>/img/user-icon.svg">
			<img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/user-icon.svg" alt="User icon"/>
			</picture><span class="user-text-name"><? my_acc_btn(); ?></span></button>
		  <div class="user-menu-cont">
		   <a href="<? if(is_user_logged_in()){echo '#';}else{echo '/request-a-quote';} ?>" class="cart-btn"><picture>
			<source media="(max-width: 1127px)" srcset="<?php echo get_bloginfo( 'template_directory' ); ?>/img/m-cart.svg">
			<source media="(max-width: 1128px)" srcset="<?php echo get_bloginfo( 'template_directory' ); ?>/img/cart.svg">
			<img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/cart.svg" alt="Cart icon"/>
			</picture></a>
       <? do_action('vft_user_menu');?>
		  </div>
			<? do_action('vft_minicart'); ?>
      </div>
      <div class="header__row navigation-container navigation-container_closer modal-menu">
        <div class="menu__container">
          <div class="navigation-container__row">

            <button class="svg-btn navigation-container__close">
              <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/burger-close.svg" alt="Close button">
            </button>
          </div>
           <? do_action('vft_header_menu'); ?>
        </div>
      </div>
    </div>
</header>
<div class="logout-popup">
    <div class="logout-popup__head">
        <p class="logout-popup__title">
            Log out
        </p>
		<button class="close-logout-popup"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/burger-close.svg" alt="Close button"></button>
    </div>
    <p class="logout-popup__text">Are you sure you want to log out?</p>
    <div class="logout-actions">
<a class="logout-popup__confirm-logout" href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
    </div>  
</div>
<div class="nologin-popup">
    <div class="logout-popup__head">
        <p class="logout-popup__title">
            Notification
        </p>
        <button class="close-nologin-popup"><img
                src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/burger-close.svg"
                alt="Close button"></button>
    </div>
    <p class="logout-popup__text">To find out more information about products (price, stock, documentation), you need to
        <a href="/registration">register</a> or <a href="/my-account">log in</a>.</p>
    <div class="logout-actions">
        <button class="nologin-ok">Ok</button>
    </div>
</div>		
<div class='main-content'>
<? do_action('vft_nologin_banner'); ?>
<div class="breadcrumbs container">
<?php
	if( is_front_page() ) {
		null;
}
	elseif (is_page('wiki')){
		null;
	}
	elseif (is_page('my-account')){
		null;
	}
	elseif (is_page('registration')){
		null;
	}
	elseif (is_page('wiki')){
		null;
	}
	elseif (is_page('cart')){
		null;
	}
	elseif (is_page('checkout')){
		null;
	}
	elseif (is_page('about-us')){
		null;
	}
	elseif (is_page('production')){
		null;
	}
		elseif (is_page('faq')){
		null;
	}
	else{
echo do_shortcode("[breadcrumb]");
}	

?>
</div>