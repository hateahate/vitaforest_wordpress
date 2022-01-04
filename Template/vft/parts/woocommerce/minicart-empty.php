<?
if(is_user_logged_in()){
$cartnlstyle2 = '';
}
else{
$cartnlstyle2 = ' style="display:none;"';
}
?>
<div class="minicart-container"<? echo $cartnlstyle2; ?>>
<div class="minicart minicart-empty">
<button class="svg-btn minicart-container__close">
<img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/burger-close.svg" alt="Close button">
</button>
<div class="minicart-content">
    <div class="minicart-empty__content">
        <img class="minicart-empty-img" src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/emptyminicart.svg" alt="Empty cart image">
        <p class="minicart-empty__title">You have no items
in your shopping cart</p>
    </div>
</div>
</div>
</div>