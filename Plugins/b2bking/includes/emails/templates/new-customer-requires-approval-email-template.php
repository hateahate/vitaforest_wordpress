<?php
	
defined( 'ABSPATH' ) || exit;

/*
 * @hooked WC_Emails::email_header() Output the email header
 */
do_action( 'woocommerce_email_header', $email_heading, $email );
$user = get_user_by('login', $user_login);
$user_email = $user->user_email;
$userID = $user->ID;
// Main info
$userDate = $user->user_registered;
$userEmail = $user->user_email;
$userWebsite = get_user_meta($userID,  b2bking_custom_field_14766);
$userGender = get_user_meta($userID, b2bking_custom_field_14768);
$userCode = get_user_meta($userID, b2bking_custom_field_14764);
$userVat = get_user_meta($userID, b2bking_custom_field_14761);
$userPhone = $user->billing_phone;
$userCompany = $user->billing_company;
$userCountry = $user->billing_country;
$userBirth = get_user_meta($userID, b2bking_custom_field_14770);
// Address compile
$adFLine = $user->billing_address_1;
$adSLine = $user->billing_address_2;
$adPostcode = $user->billing_postcode;
$adCity = $user->billing_city;
$adCountry = $user->billing_country;
$adState = $user->billing_state;
$userAddress = 'Country: '.$adCountry.'</br>'.'State: '.$adState.'</br>'.'City: '.$adCity.'</br>'.'Address: '.$adFLine.', '.$adSLine.'</br>'.'Postcode: '.$adPostcode;
// Name compile
$firstname = $user->first_name;
$lastname = $user->last_name;
$userName = $firstname.' '.$lastname;
 ?>

<p>
	<?php esc_html_e( 'You have a new customer registration that requires approval.', 'b2bking');	?>
	<br /><br />
 	<?php esc_html_e( 'Username: ','b2bking'); echo esc_html($user_login); ?>
 	<br />
 	<?php esc_html_e( 'Email: ','b2bking'); echo esc_html($user_email); ?>
 	<br /><br />
 	<a href="<?php echo esc_attr(admin_url('/user-edit.php?user_id='.$user->ID)); ?> "><?php esc_html_e( 'Click to Review User', 'b2bking' ); ?> </a>
</p>
<div>
	<table>
		<tr>
		<th>ID</th>
        <th>Registration date</th>
        <th>Company name</th>
        <th>Company website</th>
        <th>Registry code</th>
        <th>VAT</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Name</th>
        <th>Date of birth</th>
		</tr>
		<tr>
		<td><? echo $userID; ?></td>
        <td><? echo $userDate; ?></td>
        <td><? echo $userCompany; ?></td>
        <td><? echo $userWebsite[0]; ?></td>
        <td><? echo $userCode[0]; ?></td>
        <td><? echo $userVat[0]; ?></td>
        <td><? echo $userPhone; ?></td>
        <td><? echo $userAddress; ?></td>
        <td><? echo $userName; ?></td>
        <td><? echo $userBirth[0]; ?></td>
		</tr>
	</table>
</div>
<?php

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

/*
 * @hooked WC_Emails::email_footer() Output the email footer
 */
do_action( 'woocommerce_email_footer', $email );
