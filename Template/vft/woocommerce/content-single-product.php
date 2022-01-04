<?php
defined( 'ABSPATH' ) || exit;
global $product;
do_action( 'woocommerce_before_single_product' );
if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div class="product-container">
	<div class="product">
				<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
				<div class="product-before-content">
					<div class="product-head">
						<div class="mobile-head">
							<p class="product-price-calc">
								<? echo $product->get_price(); ?>
							</p>
							<h4 class="mobile-head__title">
								<? echo $product->get_title(); ?>
							</h4>
							<p class="mobile-head__sku">SKU: 
								<? $skuval = $product->get_sku(); if($skuval == null){echo 'NOT SETUP';}else{echo $skuval;} ?>
							</p>
						</div>
						<div class="woocommerce-product-gallery">
								<?
								function production_status(){
									global $product;
									$status = $product->get_attribute('productionstatus');
									if ($status == 'Get now'){
										echo '<p class="product-card-status product-card-status_avaliable">Get now</p>';
									}
									elseif ($status == 'Soon'){
										echo '<p class="product-card-status product-card-status_request">Soon</p>';
									}
									else{
										null;
									}
								}
							production_status();
								?>
							<div class="product-card-slider">
							<?php $post_thumbnail_id = $product->get_image_id(); ?>
								<div class="product-card-slide" itemscope itemtype="http://schema.org/ImageObject"><a rel="lightbox" href="<?php echo wp_get_attachment_url( $post_thumbnail_id ); ?>"><img src="<?php echo wp_get_attachment_url( $post_thumbnail_id ); ?>" alt="<? echo $product->get_title(); ?>" itemprop="contentUrl"><p hidden="true" itemprop="name"><? echo $product->get_title(); ?></p><p hidden="true" itemprop="description"><? echo $product->get_title(); ?> photo</p></a></div>
								<?php $attachment_ids = $product->get_gallery_image_ids(); ?>
								<?php foreach ( $attachment_ids as $attachment_id ) { ?>
								<div class="product-card-slide"><a rel="lightbox" href="<?php echo wp_get_attachment_url( $attachment_id ); ?>" data-fancybox="product-gallery"><img src="<?php echo wp_get_attachment_url( $attachment_id ); ?>" alt="<? echo $product->get_title(); ?>"></a></div>
								<?php } ?>
							</div>
								<div class="product-card-slider-nav">
								<?php $post_thumbnail_id = $product->get_image_id(); ?>
									<div class="product-card-slide"><img src="<?php echo wp_get_attachment_url( $post_thumbnail_id ); ?>" alt="<? echo $product->get_title(); ?>"></div>
								<?php $attachment_ids = $product->get_gallery_image_ids(); ?>
								<?php foreach ( $attachment_ids as $attachment_id ) { ?>
								<div class="product-card-slide"><img src="<?php echo wp_get_attachment_url( $attachment_id ); ?>" alt="<? echo $product->get_title(); ?>"></div>
								<?php } ?>
								</div>
						</div>
						<?
						function summary_nologin(){
							if(is_user_logged_in()){
								echo ' '.'entry-summary-login';
							}
							else{
								echo ' '.'entry-summary-nologin';
							}
						}
						?>
						<div class="summary entry-summary<? summary_nologin(); ?>">
							<?php
							do_action( 'woocommerce_single_product_summary' );
							?>
													<script src="https://yastatic.net/share2/share.js"></script>
			<div class="ya-share2" data-curtain data-limit="0" data-more-button-type="short" data-services="facebook,twitter,linkedin"></div>
						</div>
					</div>
<?php
do_action( 'woocommerce_after_single_product_summary' );
?>
				</div>
			</div>
		<div class="product__ask-сontainer">
  <a href="" class="product__ask-link">Ask question</a>
</div>
<?php do_action( 'woocommerce_after_single_product' ); ?>
<? do_action( 'vft_js_jquery' ); ?>
<? do_action( 'vft_js_slickslider' ); ?>
<? do_action( 'vft_js_pcslider' ); ?>
<? do_action( 'vft_js_total' ); ?>

