<? //Password change form ?>
<div class="password-change__container">
    <form method="post" class="change-password">
        <p class="password-change__input-name">Current password: </p>
        <input type="text" name="currentpassword">
        <p class="password-change__input-name">New password: </p>
        <input type="text" name="newpass">
        <p class="password-change__input-name">Confirmation: </p>
        <input type="text" name="newpassconfirm">
        <input type="submit" name="submit" value="Change password">
    </form>
</div>
<?
if(isset($_POST['submit'])) {               
    if(empty($_POST['currentpassword']) && empty($_POST['newpass']) && empty($_POST['newpassconfirm'])){
      echo 'Fields cannot be empty';
    }
    else
    {
    $userid = get_current_user_id(); // Get current user ID
    $userdata = get_userdata($userid); // Get userdata array
    $checkresult = "";
    if ($userdata){
        $currentpass = $_POST['currentpassword']; // Get current password from change form
        $passhash = $userdata->data->user_pass; // Get current user password hash from array
        if (wp_check_password($currentpass, $passhash, $userid) == true){ // Check
        $checkresult = "yes"; // Set check result
        }
        else{
        $checkresult = "no";
    }
    }
$newpass = $_POST['newpass']; // Get new password from form
$newpassconfirm = $_POST['newpassconfirm']; // Get password confirmation
if (($newpass == $newpassconfirm) && $checkresult == "yes"){
    wp_set_password($newpass, $userid);
    echo "Password succesfull changed!";
}
else if (($newpass == $newpassconfirm) && $checkresult == "no"){
    echo "Uncorrect current password";
}
else{
    echo "Error!";
}
}
}
?>