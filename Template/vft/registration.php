<?
/*
* Template Name: Registration
*/
?>
<div class="registration-page">
<?
get_header();
?>
	<div class="registration-page__inner">
    <div class="left-column">
      <div class="logo-light">
        <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/logo-light-reg.svg" alt="Website logo">
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
      <a href="/my-account" class='button-back'><svg width="14" height="10" viewBox="0 0 14 10" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.83696 4.25016L5.09481 1.40698C5.32151 1.12152 5.28357 0.708239 5.0087 0.468816C4.71558 0.213502 4.26865 0.254525 4.02691 0.558934L0.99386 4.37827C0.704668 4.74244 0.704669 5.25789 0.993861 5.62205L4.02691 9.44139C4.26865 9.7458 4.71558 9.78682 5.0087 9.53151C5.28357 9.29208 5.32151 8.8788 5.09481 8.59334L2.83696 5.75016L13.25 5.75016C13.6642 5.75016 14 5.41438 14 5.00016C14 4.58595 13.6642 4.25016 13.25 4.25016L2.83696 4.25016Z" fill="#3C3F54"/>
</svg>
Back</a>
		<p class="registration-page__title">
			New customer registration
		</p>
<?php wc_print_notices(); ?>
<div class="reg-container">
	<h2 class='woocommerce-title'>PERSONAL INFORMATION </h2>

	<form method="post" class="woocommerce-form woocommerce-form-register register"<?php do_action( 'woocommerce_register_form_tag' ); ?> >
	<?php do_action( 'woocommerce_register_form' ); ?>
		<?php do_action( 'woocommerce_register_form_start' ); ?>
		<h2 class='woocommerce-title'>SIGN-IN INFORMATION</h2>	
		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
			</p>

		<?php endif; ?>
		
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
			<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /><?php // @codingStandardsIgnoreLine ?>
		</p>

		<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?>&nbsp;<span class="required">*</span></label>
				<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" />
			</p>
			<p class="form-row form-row-wide">
<label for="reg_password2"><?php _e( 'Repeat password', 'woocommerce' ); ?> <span class="required">*</span></label>
<input type="password" class="input-text" name="password2" id="reg_password2" value="<?php if ( ! empty( $_POST['password2'] ) ) echo esc_attr( $_POST['password2'] ); ?>" />
</p>

		<?php else : ?>

			<p><?php esc_html_e( 'A password will be sent to your email address.', 'woocommerce' ); ?></p>

		<?php endif; ?>

		
		
		<p class="woocommerce-form-row form-row">
			<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
			<button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
		</p>

		<?php do_action( 'woocommerce_register_form_end' ); ?>

	</form>
<script>
	let h = document.createElement('h2');
h.className = 'woocommerce-title';
h.innerHTML = 'COMPANY INFORMATION';
document.querySelectorAll('.b2bking_custom_registration_container')[4].before(h)</script>
</div>
	<?
get_footer();
?>
	</div>
  </div>