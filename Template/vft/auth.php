<?
/*
* Template Name: Auth
*/
?>
<div class="auth-page">
    <? get_header(); ?>
	<div class="auth-page__inner">
    <div class="left-column">
      <div class="logo-light">
        <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/logo-light-reg.svg" alt="Website Logo">
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
      <button class='button-back'>Back</button>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( 'yes' === get_option( 'woocommerce_enable_myaccount_registration' ) ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">

<?php endif; ?>

		<h2><?php esc_html_e( 'Registered customer', 'woocommerce' ); ?></h2>

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
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-button button woocommerce-form-login__submit" name="login" value="<?php esc_attr_e( 'Log in', 'woocommerce' ); ?>"><?php esc_html_e( 'Log in', 'woocommerce' ); ?></button>
			</p>
			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
	</div>
	<div class="register">
	<div class="register__title-container">
		<h2 class="register-title">
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
	</div>
    <? get_footer(); ?>
  </div>