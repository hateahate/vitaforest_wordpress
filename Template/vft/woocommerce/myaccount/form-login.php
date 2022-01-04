<div class="auth-page">
<?
get_header();
?>
	<div class="auth-page__inner">
    <div class="left-column">
      <div class="logo-light">
        <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/logo-light-reg.svg" alt="">
      </div>
      <div class="social">
        <ul class="social__links">
          <li class="social__link"><a href="https://www.facebook.com/vitaforestfood/"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/regfacebook.svg" alt="Facebook icon"></a></li>
          <li class="social__link"><a href="https://www.linkedin.com/company/vitaforestfood/"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/reglinkedin.svg" alt="Linkedin icon"></a></li>
        </ul>
      </div>
      <div class="copyright">
        <p>© VitaForest 2021</p>
        <a href="/privacy">Privacy Policy</a>
      </div>
    </div>
    <div class="right-column">
      <a href="/" class='button-back'><svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.83696 4.25016L5.09481 1.40698C5.32151 1.12152 5.28357 0.708239 5.0087 0.468816C4.71558 0.213502 4.26865 0.254525 4.02691 0.558934L0.99386 4.37827C0.704668 4.74244 0.704669 5.25789 0.993861 5.62205L4.02691 9.44139C4.26865 9.7458 4.71558 9.78682 5.0087 9.53151C5.28357 9.29208 5.32151 8.8788 5.09481 8.59334L2.83696 5.75016L13.25 5.75016C13.6642 5.75016 14 5.41438 14 5.00016C14 4.58595 13.6642 4.25016 13.25 4.25016L2.83696 4.25016Z" fill="#3C3F54"/>
</svg>
Back</a>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">

<?php endif; ?>

		<h2 class="registered-title"><?php esc_html_e( 'Registered customer', 'woocommerce' ); ?></h2>
		<p class="under-reg-title">If you have an account, sign in with your email address</p>

		<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
					<div class="under-formlogin">
				<button class="forgot-password">Forgot password?</button>
			<p class="required-fields">* Required fields</p>
			</div>
	</div>
	<div class="register">
	<div class="register__title-container">
		<h2 class="registered-title">
			New customer
		</h2>
		</div>
		<div class="register__info">
			<p class="register__info-title">
				Creating an account has many benefits: 
			</p>
			<ul class="register__info-list">
				<li class="register__info-item">check out faster</li>
				<li class="register__info-item">keep more than one address</li>
				<li class="register__info-item">track orders and more</li>
			</ul>
		</div>
		<a href="/registration" class="registration-link">Create B2B account</a>
	</div>
<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
    </div>
	<?
get_footer();
?>
	</div>
  </div>
	
	<div class="reset-password">
	<div class="reset-password-head">
	<p class="reset-password-title">
	Reset password	
	</p>
	<button class="close-reset-password"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/burger-close.svg" alt="Close button"></button>
		</div>
<form method="post" class="woocommerce-ResetPassword lost_reset_password">
	<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Please enter your email address below to recieve password reset link', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first">
		<label for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label>
		<input class="woocommerce-Input woocommerce-Input--text input-text" type="text" name="user_login" id="user_login" autocomplete="username" />
	</p>

	<div class="clear"></div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<p class="woocommerce-form-row form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
	</p>

	<?php wp_nonce_field( 'lost_password', 'woocommerce-lost-password-nonce' ); ?>

</form>
	</div>
	<? do_action('vft_js_authpage'); ?>