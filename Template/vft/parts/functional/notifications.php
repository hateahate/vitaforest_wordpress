<? // Notifications ?>
<div class="notification-wrapper">
<div class="notification-container">
</div>
</div>
<div class="notification-cotrollers">
    <? 
    function notification_auth_data(){
    if(is_user_logged_in(  )){
        echo 'true';
    }
    else{
        echo 'false';
    }
    }
    ?>
<div id="notification-auth-data" data-auth="<? notification_auth_data(); ?>"></div>
<? do_action('vft_js_notifylib'); ?>
<script id="notification-load">
<? echo get_theme_mod('vft-notification-controller-data'); ?>
</script>
</div>