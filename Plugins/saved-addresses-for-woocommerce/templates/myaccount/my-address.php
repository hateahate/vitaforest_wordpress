<? 
$uid = get_current_user_id();
$userdata = get_userdata($uid);
$firstname_acc = $userdata->first_name;
$lastname_acc = $userdata->last_name;
$phone_number = get_user_meta( $uid, 'billing_phone', true );
?>
<div class="addresses-container">
	<h1 class="addresses-container__title">
		Address book
	</h1>
<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

$b_oldcol                = 1;
$b_col                   = 1;
$saved_billing_addresses = get_user_meta( $customer_id, 'sa_saved_formatted_billing_addresses', true );
?>

<div class="u-columns woocommerce-Addresses col2-set addresses">
	<?php
	if ( ! empty( $saved_billing_addresses ) ) {
		?>
		<h3 class="saw-billing"><?php echo esc_html__( 'Saved billing addresses', 'saved-addresses-for-woocommerce' ); ?>
		</h3>
		<?php
		foreach ( $saved_billing_addresses as $key => $billing_address ) {
			$b_col    = $b_col * -1;
			$b_oldcol = $b_oldcol * -1;
			?>
			<div class="u-column<?php echo $b_col < 0 ? 1 : 2; ?> col-<?php echo $b_oldcol < 0 ? 1 : 2; ?> woocommerce-Address" id="billing_address_<?php echo esc_html( $key ); ?>">
				<header class="woocommerce-Address-title title">
					<h3></h3>
				</header>
				<? $default_address_class_billing = SA_Saved_Addresses_For_WooCommerce::get_instance()->is_default_address( $key, 'billing' ); ?>
				<address <? if($default_address_class_billing === true){echo 'class="bs-default"';}else{echo 'class="bsn-default"';} ?>>
					<?php
						echo wp_kses_post( $billing_address );
					?>
					<br><br>
					<div class="account-billing-actions">
						<a title="<?php esc_attr_e( 'Edit this address', 'saved-addresses-for-woocommerce' ); ?>" href="<?php echo esc_url( get_saw_endpoint_url( $key, 'billing', 'edit' ) ); ?>" class="edit saw-edit"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.3358 5.51593C16.2214 4.6303 16.2214 3.2056 15.3358 2.31997L13.6801 0.664232C12.7944 -0.221395 11.3697 -0.221395 10.4841 0.664232L0.395645 10.7527L0.0105896 14.2567C-0.104927 15.2578 0.742195 16.1049 1.74334 15.9894L5.24734 15.6044L15.3358 5.51593ZM11.9381 6.98838L4.7468 14.1797L1.68508 14.413L1.91837 11.3513L9.1097 4.15995L11.9381 6.98838ZM14.2695 3.38625C14.6854 3.80215 14.7666 4.15995 14.3924 4.53407L12.9795 5.94697L10.1704 3.09929L11.5448 1.72489C11.9381 1.33152 12.3396 1.45639 12.6138 1.73052L14.2695 3.38625Z" fill="#7F878B"/>
</svg>
</a> 
						<a title="<?php esc_attr_e( 'Delete this address', 'saved-addresses-for-woocommerce' ); ?>" data-delete-id='<?php echo esc_html( $key ); ?>' id="delete-billing" class="saw-delete"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.04329 1.0141C1.75887 0.729676 1.29773 0.729676 1.01331 1.0141C0.728894 1.29851 0.728894 1.75965 1.01331 2.04407L5.97003 7.00078L1.01331 11.9575C0.728894 12.2419 0.728894 12.703 1.01331 12.9875C1.29773 13.2719 1.75887 13.2719 2.04329 12.9875L7.00001 8.03075L11.9567 12.9874C12.2411 13.2719 12.7023 13.2719 12.9867 12.9874C13.2711 12.703 13.2711 12.2419 12.9867 11.9575L8.02998 7.00078L12.9867 2.04409C13.2711 1.75967 13.2711 1.29853 12.9867 1.01412C12.7023 0.729696 12.2411 0.729696 11.9567 1.01411L7.00001 5.97081L2.04329 1.0141Z" fill="#7F878B"/>
</svg>
</a>
						<?php
							$is_default_address = SA_Saved_Addresses_For_WooCommerce::get_instance()->is_default_address( $key, 'billing' );
							$default_class      = ( true === $is_default_address ) ? 'is-default' : 'not-is-default';
							$default_text       = ( true === $is_default_address ) ? __( 'Selected by default', 'saved-addresses-for-woocommerce' ) : _x( 'Select by default', 'set default billing', 'saved-addresses-for-woocommerce' );
							$default_title      = ( true === $is_default_address ) ? __( 'Default address', 'saved-addresses-for-woocommerce' ) : _x( 'Set this as default address', 'billing', 'saved-addresses-for-woocommerce' );
						?>
						<span>
							<a title="<?php echo sprintf( ( '%s' ), esc_html( $default_title ) ); ?>" data-default-id='<?php echo esc_html( $key ); ?>' id="modify-default-billing" class="<?php echo sprintf( ( '%s' ), esc_html( $default_class ) ); ?>"><?php echo sprintf( ( '%s' ), esc_html( $default_text ) ); ?></a>
						</span>
					</div>
				</address>
			</div>
			<?php
		}?>
	<div class="add-new-adress-button">
<a href="/my-account/edit-address/saw_billing/?saw_type=add" class="add"><?php echo esc_html_x( 'Add new address', 'billing address', 'saved-addresses-for-woocommerce' ); ?></a></div><?
	} else {
		?>
		<header class="woocommerce-Address-title title">
			<h3><?php echo esc_html__( 'Billing address', 'saved-addresses-for-woocommerce' ); ?></h3>
		</header>
		<address>
			<?php
				echo esc_html_e( 'The billing address you entered during registration will be available in your account after the first purchase.', 'saved-addresses-for-woocommerce' );
			?>
		</address>
		<?php
	}
	?>
</div>

<?php
if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$s_oldcol                 = 1;
	$s_col                    = 1;
	$saved_shipping_addresses = get_user_meta( $customer_id, 'sa_saved_formatted_addresses', true );
	?>
	<div class="u-columns woocommerce-Addresses col2-set addresses">
		<?php
		if ( ! empty( $saved_shipping_addresses ) ) {
			?>
		<div class="shipping-head">
			<h3 class="saw-shipping"><?php echo esc_html__( 'Saved shipping addresses', 'saved-addresses-for-woocommerce' ); ?>
			</h3>
			<?php
			foreach ( $saved_shipping_addresses as $key => $shipping_address ) {
				$s_col    = $s_col * -1;
				$s_oldcol = $s_oldcol * -1;
				?>
				<div class="u-column<?php echo $s_col < 0 ? 1 : 2; ?> col-<?php echo $s_oldcol < 0 ? 1 : 2; ?> woocommerce-Address" id="shipping_address_<?php echo esc_html( $key ); ?>">
					<header class="woocommerce-Address-title title">
						<h3></h3>
					</header>
					<? $default_address_class_shipping = SA_Saved_Addresses_For_WooCommerce::get_instance()->is_default_address( $key, 'shipping' ); ?>
					<address <? if($default_address_class_shipping === true){echo 'class="ss-default"';}else{echo 'class="ssn-default"';} ?>>>
						<?php
							echo wp_kses_post( $shipping_address );
						?>
						<br><br>
						<div class="account-shipping-actions">
							<a title="<?php esc_attr_e( 'Edit this address', 'saved-addresses-for-woocommerce' ); ?>" href="<?php echo esc_url( get_saw_endpoint_url( $key, 'shipping', 'edit' ) ); ?>" class="edit saw-edit"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.3358 5.51593C16.2214 4.6303 16.2214 3.2056 15.3358 2.31997L13.6801 0.664232C12.7944 -0.221395 11.3697 -0.221395 10.4841 0.664232L0.395645 10.7527L0.0105896 14.2567C-0.104927 15.2578 0.742195 16.1049 1.74334 15.9894L5.24734 15.6044L15.3358 5.51593ZM11.9381 6.98838L4.7468 14.1797L1.68508 14.413L1.91837 11.3513L9.1097 4.15995L11.9381 6.98838ZM14.2695 3.38625C14.6854 3.80215 14.7666 4.15995 14.3924 4.53407L12.9795 5.94697L10.1704 3.09929L11.5448 1.72489C11.9381 1.33152 12.3396 1.45639 12.6138 1.73052L14.2695 3.38625Z" fill="#7F878B"/>
</svg>
</a>
							<a title="<?php esc_attr_e( 'Delete this address', 'saved-addresses-for-woocommerce' ); ?>" data-delete-id='<?php echo esc_html( $key ); ?>' id="delete-shipping" class="saw-delete"><svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.04329 1.0141C1.75887 0.729676 1.29773 0.729676 1.01331 1.0141C0.728894 1.29851 0.728894 1.75965 1.01331 2.04407L5.97003 7.00078L1.01331 11.9575C0.728894 12.2419 0.728894 12.703 1.01331 12.9875C1.29773 13.2719 1.75887 13.2719 2.04329 12.9875L7.00001 8.03075L11.9567 12.9874C12.2411 13.2719 12.7023 13.2719 12.9867 12.9874C13.2711 12.703 13.2711 12.2419 12.9867 11.9575L8.02998 7.00078L12.9867 2.04409C13.2711 1.75967 13.2711 1.29853 12.9867 1.01412C12.7023 0.729696 12.2411 0.729696 11.9567 1.01411L7.00001 5.97081L2.04329 1.0141Z" fill="#7F878B"/>
</svg>
</a> 
							<?php
								$is_default_address = SA_Saved_Addresses_For_WooCommerce::get_instance()->is_default_address( $key, 'shipping' );
								$default_class      = ( true === $is_default_address ) ? 'is-default' : 'not-is-default';
								$default_text       = ( true === $is_default_address ) ? __( 'Selected by default', 'saved-addresses-for-woocommerce' ) : _x( 'Select by default', 'set default shipping', 'saved-addresses-for-woocommerce' );
								$default_title      = ( true === $is_default_address ) ? __( 'Default address', 'saved-addresses-for-woocommerce' ) : _x( 'Set this as default address', 'shipping', 'saved-addresses-for-woocommerce' );
							?>
							<span>
								<a title="<?php echo sprintf( ( '%s' ), esc_html( $default_title ) ); ?>" data-default-id='<?php echo esc_html( $key ); ?>' id="modify-default-shipping" class="<?php echo sprintf( ( '%s' ), esc_html( $default_class ) ); ?>"><?php echo sprintf( ( '%s' ), esc_html( $default_text ) ); ?></a>
							</span>
						</div>
					</address>
				</div>
				<?php
			}?>
	<div class="add-new-adress-button">
<a href="/my-account/edit-address/saw_shipping/?saw_type=add" class="add"><?php echo esc_html_x( 'Add new address', 'billing address', 'saved-addresses-for-woocommerce' ); ?></a></div><?
		} else {
			?>
			<header class="woocommerce-Address-title title">
				<h3><?php echo esc_html__( 'Shipping address', 'saved-addresses-for-woocommerce' ); ?></h3>
				<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', 'shipping' ) ); ?>" class="add" style="margin-left: 0.5em;"><?php echo esc_html_x( 'Add', 'shipping address', 'saved-addresses-for-woocommerce' ); ?></a>
			</header>
			<address>
				<?php
					echo esc_html_e( 'The shipping address you entered during registration will be available in your account after the first purchase.', 'saved-addresses-for-woocommerce' );
				?>
			</address>
			<?php
		}
		?>
	</div>
	<?php
} ?>
</div>
