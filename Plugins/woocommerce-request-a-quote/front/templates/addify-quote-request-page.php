<?php
/**
 * Quote Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/addify/rfq/front/addify_quote_request_page.php.
 *
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

$af_quote = new AF_R_F_Q_Quote( WC()->session->get( 'quotes' ) );

$quotes = WC()->session->get( 'quotes' );

if ( !empty( $quotes ) ) {
	
	foreach ( WC()->session->get( 'quotes' ) as $quote_item_key => $quote_item ) {

		if ( isset( $quote_item['quantity'] ) && empty( $quote_item['quantity'] ) ) {

			unset( $quotes[$quote_item_key] );
		}

		if ( !isset( $quote_item['data'] ) ) {
			unset( $quotes[$quote_item_key] );
		}
	}

	WC()->session->set( 'quotes', $quotes );
}


if ( ! empty( WC()->session->get( 'quotes' ) ) ) {

	$quotes         = WC()->session->get( 'quotes' );
	$total          = 0;
	$user           = null;
	$user_name      = '';
	$user_email_add = '';

	if ( is_user_logged_in() ) {
		$user = wp_get_current_user(); // object
		if ( '' == $user->user_firstname && '' == $user->user_lastname ) {
			$user_name = $user->nickname; // probably admin user
		} elseif ( '' == $user->user_firstname || '' == $user->user_lastname ) {
			$user_name = trim( $user->user_firstname . ' ' . $user->user_lastname );
		} else {
			$user_name = trim( $user->user_firstname . ' ' . $user->user_lastname );
		}

		$user_email_add = $user->user_email;
	}

	do_action( 'addify_before_quote' );

	$price_display    = 'yes' === get_option( 'afrfq_enable_pro_price' ) ? true : false;
	$of_price_display = 'yes' === get_option( 'afrfq_enable_off_price' ) ? true : false;
	$tax_display      = 'yes' === get_option( 'afrfq_enable_tax' ) ? true : false;

	?>
	<div class="woocommerce">
		<style>
			.request_logged{
				display: none !important;
			}
		</style>
		<div class="main-quote">
			<div class="main-quote__wrapper">
		<h1 class="main-quote__title">
		Request a quote
		</h1>
		<div class="woocommerce-notices-wrapper">
		</div>
		<form class="woocommerce-cart-form addify-quote-form" method="post" enctype="multipart/form-data">
			<div class="quote-container-inner-box">
			
			<?php
			if ( file_exists( get_template_directory() . '/woocommerce/addify/rfq/front/quote-table.php' ) ) {

				include get_template_directory() . '/woocommerce/addify/rfq/front/quote-table.php';

			} else {

				include AFRFQ_PLUGIN_DIR . 'front/templates/quote-table.php';
			}

			?>

			<?php do_action( 'addify_before_quote_collaterals' ); ?>
			<?php if ( $price_display || $of_price_display ) : ?>
				<div class="cart-collaterals">
					<?php
						/**
						 * Cart collaterals hook.
						 *
						 * @hooked addify_cross_sell_display
						 * @hooked addify_quote_totals - 10
						 */
						do_action( 'addify_quote_collaterals' );
					?>
					<div class="cart_totals">

						<?php do_action( 'addify_rfq_before_quote_totals' ); ?>

						<h2><?php esc_html_e( 'Quote totals', 'addify_rfq' ); ?></h2>

						<?php
						if ( file_exists( get_template_directory() . '/woocommerce/addify/rfq/front/quote-totals-table.php' ) ) {

							include get_template_directory() . '/woocommerce/addify/rfq/front/quote-totals-table.php';

						} else {

							include AFRFQ_PLUGIN_DIR . 'front/templates/quote-totals-table.php';
						}
						?>
					</div>
				</div>
			<?php endif; ?>

			<?php do_action( 'addify_after_quote' ); ?>

			<div class="af_quote_fields">

				<?php
				if ( file_exists( get_template_directory() . '/woocommerce/addify/rfq/front/quote-fields.php' ) ) {

					include get_template_directory() . '/woocommerce/addify/rfq/front/quote-fields.php';

				} else {

					include AFRFQ_PLUGIN_DIR . 'front/templates/quote-fields.php';
				}

				?>

				<?php do_action( 'addify_after_quote_fields' ); ?>

				<?php if ( 'yes' == get_option( 'afrfq_enable_captcha' ) ) { ?>

					<?php if ( ! empty( get_option( 'afrfq_site_key' ) ) ) { ?>

						<div class="form_row">
							<div class="g-recaptcha" data-sitekey="<?php echo esc_attr( get_option( 'afrfq_site_key' ) ); ?>"></div>
						</div>
					<?php } ?>
				<?php } ?>
			</div>

			</div>
							<div class="form_row">
					<input name="afrfq_action" type="hidden" value="save_afrfq"/>
					<?php wp_nonce_field( 'save_afrfq', 'afrfq_nonce' ); ?>
					<button type="submit" name="addify_checkout_place_quote" class="button alt addify_checkout_place_quote"><?php echo esc_html__( 'Place Quote', 'addify_rfq' ); ?></button>
				</div>
		</form>
								<div class="loggedinvalid" style="display:none;" data-loggedin="<? if(is_user_logged_in()){ echo 'true'; }else{ echo 'false'; } ?>"></div>
				<script>
let validator = document.querySelector('.loggedinvalid');
let field1 = document.querySelector('.feild1');
let field2 = document.querySelector('.feild2');
let field3 = document.querySelector('.feild3');
let field4 = document.querySelector('.feild4');
let field5 = document.querySelector('.feild5');
let field6 = document.querySelector('.feild6');
if(validator.dataset.loggedin == 'false'){
    field1.getElementsByTagName('input')[0].required = true;
    field2.getElementsByTagName('input')[0].required = true;
    field3.getElementsByTagName('input')[0].required = true;
    field5.getElementsByTagName('input')[0].required = true;
    field6.getElementsByTagName('input')[0].required = true;
}
else{
	field1.classList.add('request_logged');
	field2.classList.add('request_logged');
	field3.classList.add('request_logged');
	field4.classList.add('request_logged');
	field5.classList.add('request_logged');
	field6.classList.add('request_logged');
}
				</script>
	</div>	

<?php } else { ?>
<div class="main-cart">
<div class="container">
	<div class="empty-cart-main">
	<div class="empty-cart-text">
<h1 class="cart-title">
	Request cart
	</h1>
<p class='wc-cart-empty'>
	 You have no items in your request cart
	</p>
	</div>

<?php
defined( 'ABSPATH' ) || exit;

?>
	<p class="return-to-shop">
		<a class="wc-backward" href="/shop">
		Return to shop
		</a>
	</p>
		
	</div>
	<div class='empty-cart-bg'>
		
	</div>
	</div>
</div>
</div>
</div>
	<?php
}
