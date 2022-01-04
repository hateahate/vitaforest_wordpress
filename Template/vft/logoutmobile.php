<?
/*
* Template Name: Mobile logout
*/
?>
<? get_header(); ?>
<div class="mobile-logout">
<div class="mobile-logout__head">
<a href="javascript:history.back()" class="woocommerce-MyAccount-content__back-btn"><svg width="11" height="6" viewBox="0 0 11 6" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1.39659 0.5L5.5 3.75864L9.60341 0.5L10.5 1.52935L5.5 5.5L0.5 1.52935L1.39659 0.5Z" fill="#303236"></path>
</svg></a>
<h2 class="mobile-logout__title">Log out</h2>
</div>
<div class="mobile-logout__content">
    <p class="mobile-logout__message">Are you sure you want to log out?</p>
    <a class="mobile-logout__btn" href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
</div>
</div>
<? get_footer(); ?>