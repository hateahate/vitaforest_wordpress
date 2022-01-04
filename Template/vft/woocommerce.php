<?
//WOOCOMMERCE BASIC
?>
<?
get_header( );
if ( is_singular( 'product' ) ) {
    woocommerce_content();
   }else{
    woocommerce_get_template( 'archive-product.php' );
   }
get_footer( );
?> 