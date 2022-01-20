<?
// BASIC FUNCTIONS
remove_action('woocommerce_no_products_found', 'flrt_add_selected_terms_above_the_top');
remove_action('woocommerce_before_shop_loop', 'flrt_add_selected_terms_above_the_top', 5);
// Register styles and scripts
function vft_register_basics(){
    $version = wp_get_theme()->get ('Version');
	if(is_page('rhodiola-promo') or is_page('chaga-promo')){
	wp_enqueue_style( 'vft-style', get_template_directory_uri() . "/landstyle.css", array(), $version, 'all' );	
	}
	else{
    wp_enqueue_style( 'vft-style', get_template_directory_uri() . "/style.css", array(), $version, 'all' );
	}
    wp_enqueue_script( 'vft-main', get_template_directory_uri() . "/js/main.js", array(), $version, 'all');
  }
  add_action( 'wp_enqueue_scripts', 'vft_register_basics' );

//---------------------------------------------------------------

// Load custom viewport meta
add_action('wp_head', 'vft_viewport');
function vft_viewport() {?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
<?}


// Load analitycs
add_action('wp_head', 'vft_yandexanalitic');
function vft_yandexanalitic() {?>
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(65590639, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
   });
</script>
<!-- /Yandex.Metrika counter -->
<?}

add_action('wp_head', 'vft_js_landjquery');
function vft_js_landjquery(){
if(is_page('rhodiola-promo') or is_page('chaga-promo')){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/jquery.js"></script>';
}
}

add_action('wp_head', 'vft_googleanalitic');
function vft_googleanalitic() {?>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-128175719-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-128175719-2');
</script>
<?}

add_action('wp_head', 'vft_dbanalytics');
function vft_dbanalytics() {?>
<script data-host="https://analytics.digitalbros.xyz" data-dnt="false" src="https://analytics.digitalbros.xyz/js/script.js" id="ZwSg9rf6GA" async defer></script>
<? }

add_action('wp_head', 'vft_googleads');
function vft_googleads() {?>
<!-- Global site tag (gtag.js) - Google Ads: 809692222 -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-809692222"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'AW-809692222');
</script>

<?}

add_action('wp_head', 'vft_facebookpixel');
function vft_facebookpixel() {?>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '613751339814470');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=613751339814470&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
<?}

add_action('wp_head', 'vft_googletag');
function vft_googletag() {?>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TPDRRC5');</script>
<!-- End Google Tag Manager -->
<?}

add_action('wp_head', 'vft_googleactions');
function vft_googleactions() {?>
<script>
function gtag_rhodiola_head(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-809692222/9GT6CPCw4IUDEL7Yi4ID',
      'event_callback': callback
  });
  return false;
}
</script>

<script>
function gtag_rhodiola_files(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-809692222/AbVRCMaziYYDEL7Yi4ID',
      'event_callback': callback
  });
  return false;
}
</script>


<script>
function gtag_rhodiola_footer(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-809692222/pjfPCP-2iYYDEL7Yi4ID',
      'event_callback': callback
  });
  return false;
}
</script>

<script>
function gtag_chaga_head(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-809692222/d-xjCJDYkoYDEL7Yi4ID',
      'event_callback': callback
  });
  return false;
}
</script>

<script>
function gtag_chaga_files(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-809692222/ogsVCMDbkoYDEL7Yi4ID',
      'event_callback': callback
  });
  return false;
}
</script>

<script>
function gtag_chaga_footer(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-809692222/23sXCKvC4IUDEL7Yi4ID',
      'event_callback': callback
  });
  return false;
}
</script>


<?}





// Load slider script
add_action('vft_js_slider', 'vft_js_slider');
function vft_js_slider(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/slider.js"></script>';
}

// Load slider script
add_action('vft_js_landslick', 'vft_js_landslick');
function vft_js_landslick(){
if(is_page('rhodiola-promo') or is_page('chaga-promo'))
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/landslick.js"></script>';
}

add_action('vft_js_blogpage', 'vft_js_blogpage');
function vft_js_blogpage(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/blog-page.js"></script>';
}


add_action('vft_js_authpage', 'vft_js_authpage');
function vft_js_authpage(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/auth-page.js"></script>';
}

// Load slider script
add_action('vft_js_slickslider', 'vft_js_slickslider');
function vft_js_slickslider(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/slick.min.js"></script>';
}

// Connect notify library
add_action('vft_js_notifylib', 'vft_js_notifylib');
function vft_js_notifylib(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/notifylib.js"></script>';
}

// Load search results filter script
add_action('vft_js_searchfilter', 'vft_js_searchfilter');
function vft_js_searchfilter(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/searchfilter.js"></script>';
}

// Load search results filter script
add_action('vft_js_singlewiki', 'vft_js_singlewiki');
function vft_js_singlewiki(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/single-wiki.js"></script>';
}

// Load slider script
add_action('vft_js_pcslider', 'vft_js_pcslider');
function vft_js_pcslider(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/productcard-slider.js"></script>';
}

// Load shop script
add_action('vft_js_shop', 'vft_js_shop');
function vft_js_shop(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/shop.js"></script>';
}

// Load faq script
add_action('vft_js_faq', 'vft_js_faq');
function vft_js_faq(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/faq-page.js"></script>';
}

// Load calc script
add_action('vft_js_total', 'vft_js_total');
function vft_js_total(){
echo '<script type="text/javascript" id="vft-js-total" src="'.get_template_directory_uri().'/js/price-total-calc.js"></script>';
}

// Load my account script
add_action('vft_js_acc', 'vft_js_acc');
function vft_js_acc(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/my-account.js"></script>';
}

// Load my account script
add_action('vft_js_jquery', 'vft_js_jquery');
function vft_js_jquery(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/jquery.js"></script>';
}

// Load orders sortering script
add_action('vft_js_orderssort', 'vft_js_orderssort');
function vft_js_orderssort(){
echo '<script type="text/javascript" src="'.get_template_directory_uri().'/js/orderssort.js"></script>';
}

// Theme Support

function vft_theme_support(){
add_theme_support('title-tag');
add_theme_support('woocommerce');
}
add_action('after_setup_theme','vft_theme_support');

if (class_exists('Woocommerce')){
  add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
}
//------------------------------------------------

// Add a custom stylesheet to replace woocommerce.css

function use_woocommerce_custom_css() {
    wp_enqueue_style(
        'woocommerce-custom', 
        get_template_directory_uri() . '/wcstyles.css'
    );
  }
  add_action('wp_enqueue_scripts', 'use_woocommerce_custom_css', 15);
//----------------------------------------------------



// SIDEBARS - NOW EMPTY

// MENUS

// Add menus support

add_theme_support( 'menus' );
function vft_menus(){
    $locations = array(
    'headerpowders' => 'Header menu - Powders',
	'headerextracts' => 'Header menu - Extracts',
    'headerother' => 'Header menu - Other',
    'headercompany'=> 'Header menu - Company Menu',
    'footerfirst' => 'Footer - First column',
    'footersecond' => 'Footer - Second column',
    'footerthird' => 'Footer - Third Column'
    );
    register_nav_menus( $locations );
  }
  add_action('init','vft_menus');

  // Call header menu

  add_action('vft_header_menu','vft_header_menu');
  function vft_header_menu(){
      get_template_part('/parts/menus/header/header-menu');
  }
//---------------------------------------------

// Header products menu, multiparts load

add_action('vft_header_menu_display','vft_header_menu_display');
function vft_header_menu_display(){
    get_template_part('/parts/menus/header/pwd-menu');
    get_template_part('/parts/menus/header/ext-menu');
}

// Other header menu

add_action('vft_header_menu_other','vft_header_menu_other');
function vft_header_menu_other(){
get_template_part('/parts/menus/header/other-menu');
}

// Company header menu

add_action('vft_header_menu_company','vft_header_menu_company');
function vft_header_menu_company(){
get_template_part('/parts/menus/header/company-menu');
}

// Footer column, multipart load

add_action('vft_footer_menu_display', 'vft_footer_menu_display');
function vft_footer_menu_display(){
    get_template_part('/parts/menus/footer/first-column');
    get_template_part('/parts/menus/footer/second-column');
    get_template_part('/parts/menus/footer/third-column');
}

// remove b2bking styles
wp_deregister_style('b2bking');



// CUSTOM FUNCTIONS

// MOQ & Package size value meta

add_action( 'woocommerce_product_options_pricing', 'additional_product_pricing_option_fields', 50 );
function additional_product_pricing_option_fields() {
    $domain = "woocommerce";
    global $post;

    echo '</div><div class="options_group pricing">';

    woocommerce_wp_text_input( array(
        'id'            => '_input_qty',
        'label'         => __("Minimal order quantity", $domain ),
        'placeholder'   => '',
        'description'   => __("Minimal order quantity", $domain ),
        'desc_tip'      => true,
    ) );


    woocommerce_wp_text_input( array(
        'id'            => '_step_qty',
        'label'         => __("Step/Package size", $domain ),
        'placeholder'   => '',
        'description'   => __("Step for quantity in order, package size", $domain ),
        'desc_tip'      => true,
    ) );

}

// Saving product custom quantity values

add_action( 'woocommerce_admin_process_product_object', 'save_product_custom_meta_data', 100, 1 );
function save_product_custom_meta_data( $product ){
    if ( isset( $_POST['_input_qty'] ) )
        $product->update_meta_data( '_input_qty', sanitize_text_field($_POST['_input_qty']) );

    if ( isset( $_POST['_step_qty'] ) )
        $product->update_meta_data( '_step_qty', sanitize_text_field($_POST['_step_qty']) );
}

// Set product quantity field by product

add_filter( 'woocommerce_quantity_input_args', 'custom_quantity_input_args', 10, 2 );
function custom_quantity_input_args( $args, $product ) {
    if( $product->get_meta('_input_qty') ){
        $args['min_value']   = $product->get_meta('_input_qty');
    }

    if( $product->get_meta('_step_qty') ){
        $args['step'] = $product->get_meta('_step_qty');
    }

    return $args;
}
//----------------------------------


// Get front-page news block

add_action('vft_frontpage_posts', 'vft_frontpage_posts');
function vft_frontpage_posts(){
    get_template_part('/parts/functional/frontpage-blog');
}

//-----------------------------------

// Get front-page news block again, but for desktop

add_action('vft_frontpage_posts_desk', 'vft_frontpage_posts_desk');
function vft_frontpage_posts_desk(){
    get_template_part('/parts/functional/frontpage-blog-desktop');
}

//-----------------------------------

// Product production status display

add_action('vft_production_status','vft_production_status');
function vft_production_status(){
    get_template_part('/parts/woocommerce/custom/production-status');
}

//------------------------------------

// Header banner for not logged users

add_action( 'vft_nologin_banner','vft_nologin_banner');
function vft_nologin_banner(){
    if ( is_user_logged_in() ) {
      null;
    }
    else {
      get_template_part('parts/functional/no-login-banner');
    }
  }

//------------------------------------

// Draw SKU number in span container on any page

add_action('vft_sku_display','vft_sku_display');
function vft_sku_display(){
    get_template_part('/parts/woocommerce/custom/sku');
}

//-------------------------------------

// Draw SKU number in span container on any page

add_action('vft_sku_display_single','vft_sku_display_single');
function vft_sku_display_single(){
    get_template_part('/parts/woocommerce/custom/sku-signle');
}

//-------------------------------------

// Draw minicart

add_action('vft_minicart','vft_minicart');
function vft_minicart(){
	global $woocommerce;
	$items = $woocommerce->cart->get_cart();
	if ($items == null){
    get_template_part('/parts/woocommerce/minicart-empty');
	}
	else{
	get_template_part('/parts/woocommerce/minicart');	
	}
}

//-------------------------------------

// Production status drawer

add_action('vft_productionstatus_display','vft_productionstatus_display');
function vft_productionstatus_display(){
    get_template_part('/parts/woocommerce/custom/production-status');
}

//------------------------------------

// Draw shoop loop menu

add_action('vft_shopmenu_display','vft_shopmenu_display');
function vft_shopmenu_display(){
    get_template_part('/parts/woocommerce/custom/shop-menu');
}

//------------------------------------

// Footer dropdown js load
add_action('vft_price_custom','vft_price_custom');
function vft_price_custom(){
    get_template_part('/parts/woocommerce/price');
}

//------------------------------------

// Product stock info drawer
add_action('vft_stock_info','vft_stock_info');
function vft_stock_info(){
    get_template_part('/parts/woocommerce/custom/stock-qty');
}

//------------------------------------

// Excerpt length edit 
add_filter( 'excerpt_length', function($length) {
    return 10;
  } );

//------------------------------------

// Add shop filter widget
add_action( 'widgets_init', 'shop_filter' );
function shop_filter() {
  $args = array(
    'id'=>'shop-filter',
    'name'          => 'Shop filter area'
  );

  register_sidebar( $args );

}

//------------------------------------


// Add shop filter widget
add_action( 'widgets_init', 'shop_filter_active' );
function shop_filter_active() {
  $args = array(
    'id'=>'shop-filter-active',
    'name'          => 'Shop filter active area'
  );

  register_sidebar( $args );

}

//------------------------------------


// Add blog filter widget

add_action( 'widgets_init', 'blog_filter' );
function blog_filter() {
  $argsb = array(
    'id'=>'blog-filter',
    'name'          => 'Blog filter area'
  );

  register_sidebar( $argsb );

}

add_action( 'widgets_init', 'blog2_filter' );
function blog2_filter() {
  $argsb = array(
    'id'=>'blog2-filter',
    'name'          => 'Blog filter area'
  );

  register_sidebar( $argsb );

}

// Orderby drawer
add_action('vft_orderby','vft_orderby');
function vft_orderby(){
    get_template_part('/parts/woocommerce/orderby');
}

//------------------------------------


// Orderby drawer
add_action('vft_product_price','vft_product_price');
function vft_product_price(){
    get_template_part('/parts/woocommerce/product-price');
}

//------------------------------------

// Payment & delivery tab for all product pages
function paymentdelivery_tab_content() {
    get_template_part('/parts/woocommerce/custom/payment-delivery');
  }
  
  // Register new tab for product pages
  add_filter( 'woocommerce_product_tabs', 'paymentdelivery_tab' );
  function paymentdelivery_tab( $tabs ) {
      $tabs['paymentdelivery'] = array(
          'title'     => __( 'Payment & Delivery', 'woocommerce' ),
          'priority'  => 50,
          'callback'  => 'paymentdelivery_tab_content'
      );
      return $tabs;
  }

//------------------------------------

// Payment & delivery tab for all product pages
function product_files_tab_content() {
    get_template_part('/parts/woocommerce/custom/product-files');
  }
  // Register new tab for woocommerce product documents
  add_filter( 'woocommerce_product_tabs', 'product_files' );
  function product_files( $tabs ) {
      $tabs['files'] = array(
          'title'     => __( 'Files', 'woocommerce' ),
          'priority'  => 70,
          'callback'  => 'product_files_tab_content'
      );
      return $tabs;
  }

//------------------------------------


// Rename Woocommerce product tabs
add_filter( 'woocommerce_product_tabs', 'vft_edit_tabs', 98 );
function vft_edit_tabs( $tabs ) {
    unset( $tabs['additional_information'] );
	$tabs['description']['title'] = __( 'Details' );	// Rename the description tab
	return $tabs;

}
//------------------------------------

// Change login logo
function vft_login_logo(){
    echo '
    <style type="text/css">
         #login h1 a { background: url('. get_bloginfo('template_directory') .'/img/login-logo.svg) no-repeat 0 0 !important; }
     </style>';
 }
 add_action('login_head', 'vft_login_logo');
 
 //------------------------------------

// User menu changes when user in not logged in

add_action('vft_user_menu','vft_user_menu');
function vft_user_menu(){
    if (is_user_logged_in()){
        get_template_part('/parts/menus/header/user-menu-login');
    }
    else{
        get_template_part('/parts/menus/header/user-menu-nologin');
    }
}

//---------------------------------------


// Single product restriction info

add_action('vft_product_restriction','vft_product_restriction');
function vft_product_restriction(){
    get_template_part('/parts/woocommerce/custom/product-restriction');
}

//-----------------------------------------

// Connect ajax search

require get_template_directory() . '/parts/functional/ajax-search.php';

//-----------------------------------------

// Custom quantity input visual customize

add_action( 'wp_head' , 'custom_quantity_fields_css' );
function custom_quantity_fields_css(){
    ?>
    <style>
    .quantity input::-webkit-outer-spin-button,
    .quantity input::-webkit-inner-spin-button {
        display: none;
        margin: 0;
    }
    .quantity input.qty {
        appearance: textfield;
        -webkit-appearance: none;
        -moz-appearance: textfield;
    }
    </style>
    <?
}


add_action( 'wp_footer' , 'custom_quantity_fields_script' );
function custom_quantity_fields_script(){
    ?>
    <script type='text/javascript'>
    jQuery( function( $ ) {
        if ( ! String.prototype.getDecimals ) {
            String.prototype.getDecimals = function() {
                var num = this,
                    match = ('' + num).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
                if ( ! match ) {
                    return 0;
                }
                return Math.max( 0, ( match[1] ? match[1].length : 0 ) - ( match[2] ? +match[2] : 0 ) );
            }
        }
        // Quantity "plus" and "minus" buttons
        $( document.body ).on( 'click', '.plus, .minus', function() {
            var $qty        = $( this ).closest( '.quantity' ).find( '.qty'),
                currentVal  = parseFloat( $qty.val() ),
                max         = parseFloat( $qty.attr( 'max' ) ),
                min         = parseFloat( $qty.attr( 'min' ) ),
                step        = $qty.attr( 'step' );

            // Format values
            if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) currentVal = 0;
            if ( max === '' || max === 'NaN' ) max = '';
            if ( min === '' || min === 'NaN' ) min = 0;
            if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) step = 1;

            // Change the value
            if ( $( this ).is( '.plus' ) ) {
                if ( max && ( currentVal >= max ) ) {
                    $qty.val( max );
                } else {
                    $qty.val( ( currentVal + parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            } else {
                if ( min && ( currentVal <= min ) ) {
                    $qty.val( min );
                } else if ( currentVal > 0 ) {
                    $qty.val( ( currentVal - parseFloat( step )).toFixed( step.getDecimals() ) );
                }
            }

            // Trigger change event
            $qty.trigger( 'change' );
        });
    });
    </script>
    <?
    }
//--------------------------------------------------------

// Get additional info about product

add_action('vft_additional_info', 'vft_additional_info');
function vft_additional_info(){
    if (is_user_logged_in()){
        get_template_part('/parts/woocommerce/custom/additional-info');
    }
    else{
        echo '</div>';
    }
}
//---------------------------------------------------------

// Get change password form

add_action('vft_change_password', 'vft_change_password');
function vft_change_password(){
    if (is_user_logged_in()){
        get_template_part('/parts/functional/change-password-form');
    }
    else{
        echo "You need to register or be logged in!";
    }
}
//---------------------------------------------------------

// Disable admin bar



//---------------------------------------------------------


// Remove dashboard button from my account page

add_filter( 'woocommerce_account_menu_items', 'account_menu_items_callback' );
function account_menu_items_callback( $items ) {
    foreach( $items as $key => $item ) {
        unset($items[$key]);
        break;
    }
    return $items;
}

//---------------------------------------------------------



// Unset shit from my account page
add_filter ( 'woocommerce_account_menu_items', 'vft_remove_my_account_links' );
function vft_remove_my_account_links( $menu_links ){
	
	unset( $menu_links['bulkorder'] ); // Unset bulk order
	unset( $menu_links['subaccounts'] ); // Remove subaccounts
	unset( $menu_links['downloads'] ); // Remove downloads
	unset( $menu_links['customer-logout'] ); // Disable logout
	unset( $menu_links['purchase-lists'] ); // Disable purchase lists
	//unset( $menu_links['customer-logout'] ); // Remove Logout link
	
	return $menu_links;
	
}
//-------------------------------------------------------

// Email subscription form

add_action('vft_unisender_form', 'vft_unisender_form');
function vft_unisender_form(){
    get_template_part('/parts/functional/unisender-form');
}

//-------------------------------------------------------

// Add li classes for menu items
function add_additional_class_on_li($classes, $item, $args) {
    if(isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

//---------------------------------------------------------

// Add header sale products section to admin appearance customize screen

add_action('customize_register','vft_header_saleproducts');
function vft_header_saleproducts($wp_customize){
	$wp_customize->add_section('vft-header-saleproducts-section', array(
	'title' => 'Sale product header settings'
	));
	
	$wp_customize->add_setting('vft-header-saleproducts-text-first',array(
	'default' => 'Example text'
	));
	
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'vft-header-saleproduct-text-first-control', array(
	'label' => 'Text of first product',
	'section' => 'vft-header-saleproducts-section',
	'settings' => 'vft-header-saleproducts-text-first',
	'type' => 'textarea'
	)));
	
		$wp_customize->add_setting('vft-header-saleproducts-text-second',array(
	'default' => 'Example text'
	));
	
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'vft-header-saleproduct-text-second-control', array(
	'label' => 'Text of second product',
	'section' => 'vft-header-saleproducts-section',
	'settings' => 'vft-header-saleproducts-text-second',
	'type' => 'textarea'
	)));
	
			$wp_customize->add_setting('vft-header-saleproducts-link-first',array(
	'default' => 'Place product link like "/product/name-of-product"'
	));
	
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'vft-header-saleproduct-link-first-control', array(
	'label' => 'First product link',
	'section' => 'vft-header-saleproducts-section',
	'settings' => 'vft-header-saleproducts-link-first'
	)));
	
			$wp_customize->add_setting('vft-header-saleproducts-link-second',array(
	'default' => 'Place product link like "/product/name-of-product"'
	));
	
	$wp_customize->add_control( new WP_Customize_Control($wp_customize, 'vft-header-saleproduct-link-second-control', array(
	'label' => 'Second product link',
	'section' => 'vft-header-saleproducts-section',
	'settings' => 'vft-header-saleproducts-link-second'
	)));
	
				$wp_customize->add_setting('vft-header-saleproducts-img-first');
	
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'vft-header-saleproduct-img-first-control', array(
	'label' => 'First product image',
	'section' => 'vft-header-saleproducts-section',
	'settings' => 'vft-header-saleproducts-img-first',
	'width' => 258,
	'height' => 210
	)));
	
				$wp_customize->add_setting('vft-header-saleproducts-img-second');
	
	$wp_customize->add_control( new WP_Customize_Cropped_Image_Control($wp_customize, 'vft-header-saleproduct-img-second-control', array(
	'label' => 'Second product image',
	'section' => 'vft-header-saleproducts-section',
	'settings' => 'vft-header-saleproducts-img-second',
	'width' => 258,
	'height' => 210
	)));
}
//-------------------------------------------------------------------------------------

// Slider controller
add_action('customize_register', 'vft_slider_controller');
function vft_slider_controller($wp_customize){
   $wp_customize->add_section('vft-slider-controller-section', array(
       'title' => 'Slider customizer'
   ));
   // First slider

   //First slide title control
   $wp_customize->add_setting('vft-slider-title-first', array(
       'default' => 'First slider title (h3)'
   ));

   $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-slider-title-first-ctrl', array(
       'label' => 'First slide title',
       'section' => 'vft-slider-controller-section',
       'settings' => 'vft-slider-title-first',
       'type' => 'textarea'
   )));

    //First slider subtitle control
    $wp_customize->add_setting('vft-slider-subtitle-first', array(
    'default' => 'First slide subtitle'
    )); 

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-slider-subtitle-first-ctrl', array(
    'label' => 'First slide subtitle',
    'section' => 'vft-slider-controller-section',
    'settings' => 'vft-slider-subtitle-first',
    'type' => 'textarea'
    )));

    //First slider image set
    $wp_customize->add_setting('vft-slider-img-first');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'vft-slider-img-first-ctrl', array(
        'label' => 'First slide image',
        'section' => 'vft-slider-controller-section',
        'settings' => 'vft-slider-img-first'
    )));




    //Second slide title control
   $wp_customize->add_setting('vft-slider-title-second', array(
    'default' => 'Second slide title (h3)'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-slider-title-second-ctrl', array(
        'label' => 'Second slide title',
        'section' => 'vft-slider-controller-section',
        'settings' => 'vft-slider-title-second',
        'type' => 'textarea'
    )));

    //Second slide subtitle control
    $wp_customize->add_setting('vft-slider-subtitle-second', array(
    'default' => 'Second slide subtitle'
    )); 

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-slider-subtitle-second-ctrl', array(
    'label' => 'Second slider subtitle',
    'section' => 'vft-slider-controller-section',
    'settings' => 'vft-slider-subtitle-second',
    'type' => 'textarea'
    )));

    //Second slide image set
    $wp_customize->add_setting('vft-slider-img-second');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'vft-slider-img-second-ctrl', array(
        'label' => 'Second slide image',
        'section' => 'vft-slider-controller-section',
        'settings' => 'vft-slider-img-second'
    )));



    //Third slide title control
   $wp_customize->add_setting('vft-slider-title-third', array(
    'default' => 'Third slide title (h3)'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-slider-title-third-ctrl', array(
        'label' => 'Third slide title',
        'section' => 'vft-slider-controller-section',
        'settings' => 'vft-slider-title-third',
        'type' => 'textarea'
    )));

    //Third slide subtitle control
    $wp_customize->add_setting('vft-slider-subtitle-third', array(
    'default' => 'third slide subtitle'
    )); 

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-slider-subtitle-third-ctrl', array(
    'label' => 'Third slide subtitle',
    'section' => 'vft-slider-controller-section',
    'settings' => 'vft-slider-subtitle-third',
    'type' => 'textarea'
    )));

    //Third slide image set
    $wp_customize->add_setting('vft-slider-img-third');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'vft-slider-img-third-ctrl', array(
        'label' => 'Third slide image',
        'section' => 'vft-slider-controller-section',
        'settings' => 'vft-slider-img-third'
    )));





    //Four slide title control
   $wp_customize->add_setting('vft-slider-title-four', array(
    'default' => 'Four slide title (h3)'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-slider-title-four-ctrl', array(
        'label' => 'Four slide title',
        'section' => 'vft-slider-controller-section',
        'settings' => 'vft-slider-title-four',
        'type' => 'textarea'
    )));

    //Four slide subtitle control
    $wp_customize->add_setting('vft-slider-subtitle-four', array(
    'default' => 'four slide title (h3)'
    )); 

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-slider-subtitle-four-ctrl', array(
    'label' => 'Four slide subtitle',
    'section' => 'vft-slider-controller-section',
    'settings' => 'vft-slider-subtitle-four',
    'type' => 'textarea'
    )));

    //Four slide image set
    $wp_customize->add_setting('vft-slider-img-four');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'vft-slider-img-four-ctrl', array(
        'label' => 'Four slide image',
        'section' => 'vft-slider-controller-section',
        'settings' => 'vft-slider-img-four'
    )));
}

add_action('customize_register', 'vft_fpsale_controller');
function vft_fpsale_controller($wp_customize){
   $wp_customize->add_section('vft-fpsale-controller-section', array(
       'title' => 'Front-page sale products customizer'
   ));

 $wp_customize->add_setting('vft-fpsale-title-first', array(
    'default' => 'Sale product text'
    ));

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-fpsale-title-first-ctrl', array(
        'label' => 'First sale product title',
        'section' => 'vft-fpsale-controller-section',
        'settings' => 'vft-fpsale-title-first',
        'type' => 'textarea'
    )));

    $wp_customize->add_setting('vft-fpsale-link-first', array(
    'default' => 'Place product link like "/product/name-of-product"'
    )); 

    $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-fpsale-link-first-ctrl', array(
    'label' => 'First sale product link',
    'section' => 'vft-fpsale-controller-section',
    'settings' => 'vft-fpsale-link-first'
    )));

    $wp_customize->add_setting('vft-fpsale-img-first');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'vft-fpsale-img-first-ctrl', array(
        'label' => 'First sale product image',
        'section' => 'vft-fpsale-controller-section',
        'settings' => 'vft-fpsale-img-first',
        'width' => 744,
        'height' => 165
    )));




    $wp_customize->add_setting('vft-fpsale-title-second', array(
        'default' => 'Sale product text'
        ));
    
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-fpsale-title-second-ctrl', array(
            'label' => 'Second sale product title',
            'section' => 'vft-fpsale-controller-section',
            'settings' => 'vft-fpsale-title-second',
            'type' => 'textarea'
        )));
    
        $wp_customize->add_setting('vft-fpsale-link-second', array(
        'default' => 'Place product link like "/product/name-of-product"'
        )); 
    
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-fpsale-link-second-ctrl', array(
        'label' => 'second sale product link',
        'section' => 'vft-fpsale-controller-section',
        'settings' => 'vft-fpsale-link-second'
        )));
    
        $wp_customize->add_setting('vft-fpsale-img-second');
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'vft-fpsale-img-second-ctrl', array(
            'label' => 'second sale product image',
            'section' => 'vft-fpsale-controller-section',
            'settings' => 'vft-fpsale-img-second',
            'width' => 744,
            'height' => 165
        )));
}

//Loop item title shorter
remove_action( 'woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title', 10 );
add_action('woocommerce_shop_loop_item_title', 'vftChangeProductsTitle', 10 );
function vftChangeProductsTitle() {
	$title = get_the_title();
	$titlelenght = iconv_strlen($title);
	if ($titlelenght > 53){
	$cuttedtitle = substr($title, 0, 50).'...';
	echo '<h2 class="woocommerce-loop-product__title">' .$cuttedtitle . '</h2>';
	}
	else{
    echo '<h2 class="woocommerce-loop-product__title">' . $title . '</h2>';
	}
}

//Override pagination arrows
add_filter( 'woocommerce_pagination_args' , 'vft_override_pagination_args' );
function vft_override_pagination_args( $args ) {
	$args['prev_text'] = __( '<svg class="pagination-arrow" width="6" height="12" viewBox="0 0 6 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M5.49997 1.48606L2.24133 5.99981L5.49997 10.5136L4.47063 11.4998L0.499973 5.99981L4.47063 0.499806L5.49997 1.48606Z" fill="#3C3F54"/>
</svg>' );
	$args['next_text'] = __( '<svg class="pagination-arrow" width="6" height="12" viewBox="0 0 6 12" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M0.675242 10.6063L3.75805 5.97066L0.328397 1.58544L1.31909 0.560371L5.49813 5.90375L1.74172 11.5522L0.675242 10.6063Z" fill="#3C3F54"/>
</svg>' );
	return $args;
}


//Single product content logged in validation
add_action('vft_price_product_valid', 'vft_price_product_valid');
function vft_price_product_valid(){
	if (is_user_logged_in()){
		get_template_part('/parts/woocommerce/price-product-valid');
	}
	else{
		null;
	}
}

//Unset state field
add_filter( 'woocommerce_default_address_fields', 'vft_remove_fields' );
function vft_remove_fields( $fields ) {

	unset( $fields[ 'state' ] );
	return $fields;

}

// Custom blog page pagination
function blog_pagination($pages = '', $range = 4)
{  
     $showitems = ($range * 2)+1;  
  
     global $paged;
     if(empty($paged)) $paged = 1;
  
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
  
     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span class=\"page-count\">Page ".$paged." of ".$pages."</span>";
         if($paged > 1 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";
  
         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"page-current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"page\">".$i."</a>";
             }
         }
  
         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

add_filter( 'widget_categories_args', 'wphelp_show_empty_categories' );
function wphelp_show_empty_categories($cat_args) {
    $cat_args['hide_empty'] = 0;
    return $cat_args;
}
//------------------------------------


// Custom phone validation for CF7
function custom_phone_validation($result,$tag){

    $type = $tag->type;
    $name = $tag->name;

    if($type == 'tel*'){

        $phoneNumber = isset( $_POST[$name] ) ? trim( $_POST[$name] ) : '';

        $phoneNumber = preg_replace('/[() .+-]/', '', $phoneNumber);
            if (strlen((string)$phoneNumber) < 10) {
                $result->invalidate( $tag, 'Please enter a valid phone number.' );
            }
    }
    return $result;
}
add_filter('wpcf7_validate_tel','custom_phone_validation', 10, 2);
add_filter('wpcf7_validate_tel*', 'custom_phone_validation', 10, 2);
//----------------------------------------------------------------------

function sitemap_exclude_taxonomy( $value, $taxonomy ) {
if ( $taxonomy == 'glossary_cat' ) return true;
if ( $taxonomy == 'glossary_tag' ) return true;
}
add_filter( 'wpseo_sitemap_exclude_taxonomy', 'sitemap_exclude_taxonomy', 10, 2 );




add_action( 'wpcf7_mail_sent', 'chaga_promo_create_lead' );
function chaga_promo_create_lead( $contact_form ) {

   // Подключаемся к серверу CRM
   define('CRM_HOST', 'portal.vitaforestfood.com'); // Ваш домен CRM системы
   define('CRM_PORT', '443'); // Порт сервера CRM. Установлен по умолчанию
   define('CRM_PATH', '/crm/configs/import/lead.php'); // Путь к компоненту lead.rest

   // Авторизуемся в CRM под необходимым пользователем:
   // 1. Указываем логин пользователя Вашей CRM по управлению лидами
   define('CRM_LOGIN', 'pavlenko');
   // 2. Указываем пароль пользователя Вашей CRM по управлению лидами
   define('CRM_PASSWORD', '123@123');

   // Перехватываем данные из Contact Form 7
   $title = $contact_form->title;
   $posted_data = $contact_form->posted_data;
   // Вместо "Контактная форма 1" необходимо указать название вашей контактной формы
   if ('Chaga Land | Files Form' == $title || 'Chaga Land | Footer Form' == $title || 'Chaga Land | Header Form' == $title  ) {
       $submission = WPCF7_Submission::get_instance();
       $posted_data = $submission->get_posted_data();
	   
	   // Механизм "Русская рулетка"
	   $russianRoulette = rand(1,2);
	   if ( $russianRoulette == 1 ){
		   $assignedUser = 492; // Тарас
	   }
	   elseif ($russianRoulette == 2){
		   $assignedUser = 571; // Вася
	   }

       // Далее перехватываем введенные данные в полях Contact Form 7:
       // 1. Перехватываем поле [your-name]
       $firstName = $posted_data['your-name'];
       // 2. Перехватываем поле [your-message]
       $message = $posted_data['your-message']; 
	   $companyName = $posted_data['company'];
	   $senderEmail = $posted_data['your-email'];
	   $phoneNumber = $posted_data['phone'];

       // Формируем параметры для создания лида в переменной $postData = array
       $postData = array(
          // Устанавливаем название для заголовка лида
          'TITLE' => $companyName,
          'COMPANY_TITLE' => $companyName,
          'COMMENTS' => $message,
		  'EMAIL_WORK' => $senderEmail,
		  'SOURCE_ID' => 'Промо-страница Чаги',
		   'PHONE_WORK' => $phoneNumber,
		  'NAME' => $firstName,
		  'ASSIGNED_BY_ID' => $assignedUser,
       );

       // Передаем данные из Contact Form 7 в Bitrix24
       if (defined('CRM_AUTH')) {
          $postData['AUTH'] = CRM_AUTH;
       } else {
          $postData['LOGIN'] = CRM_LOGIN;
          $postData['PASSWORD'] = CRM_PASSWORD;
       }

       $fp = fsockopen("ssl://".CRM_HOST, CRM_PORT, $errno, $errstr, 30);
       if ($fp) {
          $strPostData = '';
          foreach ($postData as $key => $value)
             $strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);

          $str = "POST ".CRM_PATH." HTTP/1.0\r\n";
          $str .= "Host: ".CRM_HOST."\r\n";
          $str .= "Content-Type: application/x-www-form-urlencoded\r\n";
          $str .= "Content-Length: ".strlen($strPostData)."\r\n";
          $str .= "Connection: close\r\n\r\n";

          $str .= $strPostData;

          fwrite($fp, $str);

          $result = '';
          while (!feof($fp))
          {
             $result .= fgets($fp, 128);
          }
          fclose($fp);

          $response = explode("\r\n\r\n", $result);

          $output = '<pre>'.print_r($response[1], 1).'</pre>';
       } else {
          echo 'Connection Failed! '.$errstr.' ('.$errno.')';
       }
    }

}

add_action( 'wpcf7_mail_sent', 'rhodiola_promo_create_lead' );
function rhodiola_promo_create_lead( $contact_form ) {

   // Подключаемся к серверу CRM
   define('CRM_HOST', 'portal.vitaforestfood.com'); // Ваш домен CRM системы
   define('CRM_PORT', '443'); // Порт сервера CRM. Установлен по умолчанию
   define('CRM_PATH', '/crm/configs/import/lead.php'); // Путь к компоненту lead.rest

   // Авторизуемся в CRM под необходимым пользователем:
   // 1. Указываем логин пользователя Вашей CRM по управлению лидами
   define('CRM_LOGIN', 'pavlenko');
   // 2. Указываем пароль пользователя Вашей CRM по управлению лидами
   define('CRM_PASSWORD', '123@123');

   // Перехватываем данные из Contact Form 7
   $title = $contact_form->title;
   $posted_data = $contact_form->posted_data;
   // Вместо "Контактная форма 1" необходимо указать название вашей контактной формы
   if ('Rhodiola Land | Header Form' == $title || 'Rhodiola Land | Footer Form' == $title || 'Rhodiola Land | Files form' == $title  ) {
       $submission = WPCF7_Submission::get_instance();
       $posted_data = $submission->get_posted_data();

       // Далее перехватываем введенные данные в полях Contact Form 7:
       // 1. Перехватываем поле [your-name]
       $firstName = $posted_data['your-name'];
       // 2. Перехватываем поле [your-message]
       $message = $posted_data['your-message']; 
	   $companyName = $posted_data['company'];
	   $senderEmail = $posted_data['your-email'];
	   $phoneNumber = $posted_data['phone'];
	   
	   	   $russianRoulette = rand(1,2);
	   if ( $russianRoulette == 1 ){
		   $assignedUser = 492; // Тарас
	   }
	   elseif ($russianRoulette == 2){
		   $assignedUser = 571; // Вася
	   }


       // Формируем параметры для создания лида в переменной $postData = array
       $postData = array(
          // Устанавливаем название для заголовка лида
          'TITLE' => $companyName,
          'COMPANY_TITLE' => $companyName,
          'COMMENTS' => $message,
		  'EMAIL_WORK' => $senderEmail,
		  'SOURCE_ID' => 'Промо-страница Родиола',
		   'PHONE_WORK' => $phoneNumber,
		  'NAME' => $firstName,
		  'ASSIGNED_BY_ID' => $assignedUser,
       );

       // Передаем данные из Contact Form 7 в Bitrix24
       if (defined('CRM_AUTH')) {
          $postData['AUTH'] = CRM_AUTH;
       } else {
          $postData['LOGIN'] = CRM_LOGIN;
          $postData['PASSWORD'] = CRM_PASSWORD;
       }

       $fp = fsockopen("ssl://".CRM_HOST, CRM_PORT, $errno, $errstr, 30);
       if ($fp) {
          $strPostData = '';
          foreach ($postData as $key => $value)
             $strPostData .= ($strPostData == '' ? '' : '&').$key.'='.urlencode($value);

          $str = "POST ".CRM_PATH." HTTP/1.0\r\n";
          $str .= "Host: ".CRM_HOST."\r\n";
          $str .= "Content-Type: application/x-www-form-urlencoded\r\n";
          $str .= "Content-Length: ".strlen($strPostData)."\r\n";
          $str .= "Connection: close\r\n\r\n";

          $str .= $strPostData;

          fwrite($fp, $str);

          $result = '';
          while (!feof($fp))
          {
             $result .= fgets($fp, 128);
          }
          fclose($fp);

          $response = explode("\r\n\r\n", $result);

          $output = '<pre>'.print_r($response[1], 1).'</pre>';
       } else {
          echo 'Connection Failed! '.$errstr.' ('.$errno.')';
       }
    }

}



/** Отключение выделения текста */ 
function wpschool_disable_selection_text() {

    if ( !current_user_can( 'manage_options' ) ) {
        echo '<script>';
        echo 'function disableSelection(target){';
        echo 'if (typeof target.onselectstart!="undefined")';
        echo ' target.onselectstart=function(){return false};';
        echo 'else if (typeof target.style.MozUserSelect!="undefined")';
        echo 'target.style.MozUserSelect="none";';
        echo 'else';
        echo ' target.onmousedown=function(){return false};';
        echo 'target.style.cursor = "default"';
        echo '}';
        echo 'disableSelection(document.body);';
        echo '</script>';
    }
}


add_action( 'wp_footer', 'wpschool_disable_selection_text' );

// Контроллер уведомлений из админ-панели (Кастомизация - Настройка)
add_action('customize_register', 'vft_notification_controller');
function vft_notification_controller($wp_customize){
$wp_customize->add_section('vft-notification-controller-section', array(
    'title' => 'Front-page sale products customizer'
));

$wp_customize->add_setting('vft-notification-controller-data', array(
'default' => 'Sale product text'
));

$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'vft-notification-controller-ctrl', array(
    'label' => 'Notification control',
    'section' => 'vft-notification-controller-section',
    'settings' => 'vft-notification-controller-data',
    'type' => 'textarea'
)));
}

?>