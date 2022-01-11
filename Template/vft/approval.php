<?
/*
* Template Name: Users table
*/
?>
<? get_header(); ?>
<?

$params = array(
'role' => 'customer'
);

$userQuery = new WP_User_Query($params);
$userCount = 1;
?>
<div class="container">
<h2>Table of unapproved users</h2>
<table border="1">
    <tr>
        <th>ID</th>
		<th>Approved?</th>
        <th>Registration date</th>
        <th>Company name</th>
        <th>Company website</th>
        <th>Registry code</th>
        <th>VAT</th>
        <th>Phone</th>
		<th>Email</th>
        <th>Address</th>
        <th>Name</th>
		<th>Date of birth</th>
    </tr>
<?
if (!empty($userQuery->results)){
    foreach ($userQuery->results as $user){
        $userID = $user->ID;
        $approveState = get_user_meta($userID, b2bking_account_approved);
        if($approveState[0] == 'yes'){
            null;
        }
        else{
        ?>
        <tr>
        <?
        // Main info
        $userDate = $user->user_registered;
        $userEmail = $user->user_email;
        $userWebsite = get_user_meta($userID,  b2bking_custom_field_15819);
		$userGender = get_user_meta($userID, b2bking_custom_field_15817);
        $userCode = get_user_meta($userID, b2bking_custom_field_15821);
		$userVat = get_user_meta($userID, b2bking_custom_field_15829);
        $userPhone = $user->billing_phone;
        $userCompany = $user->billing_company;
        $userCountry = $user->billing_country;
        $userBirth = get_user_meta($userID, b2bking_custom_field_15815);
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
        <td><? echo $userID; ?></td>
		<td><? echo $approveState[0]; ?></td>
        <td><? echo $userDate; ?></td>
        <td><? echo $userCompany; ?></td>
        <td><? echo $userWebsite[0]; ?></td>
        <td><? echo $userCode[0]; ?></td>
        <td><? echo $userVat[0]; ?></td>
        <td><? echo $userPhone; ?></td>
			<td><? echo $userEmail; ?></td>
        <td><? echo $userAddress; ?></td>
        <td><? echo $userName; ?></td>
        <td><? echo $userBirth[0]; ?></td>
        </tr>
        <?
        }
    }
}

else{
    echo 'Empty';
}
	?></table>
	</div>
<? get_footer();?>