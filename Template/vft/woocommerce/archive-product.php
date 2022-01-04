<?php
defined( 'ABSPATH' ) || exit;
get_header( 'shop' );
do_action( 'woocommerce_before_main_content' );
?>
	<?php
	do_action( 'woocommerce_archive_description' );
	?>
<div class="shop-wrapper">
	<div class="filter-container">
		<div class="filter-container__header">
			<p class="filter-container__title">Filters</p>
			<button class="filter-close"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/burger-close.svg" alt="Close button"></button>
		</div>
	<div class="filter-container__widget">
		<? echo do_shortcode('[fe_widget id="15430"]'); ?>
		</div>
	</div>
	<div id="logindata" style="display: none;" data-logged="<? echo $loginData; ?>"></div>
	<div class="shop-container">
		<section class="shop">
			<h1>
				
			</h1>
			<?php
			if ( woocommerce_product_loop() ) {
				do_action( 'vft_shopmenu_display' );
				do_action( 'woocommerce_before_shop_loop' );

				woocommerce_product_loop_start();

				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();

						do_action( 'woocommerce_shop_loop' );

						wc_get_template_part( 'content', 'product' );
					}
				}

				woocommerce_product_loop_end();

				do_action( 'woocommerce_after_shop_loop' );
			} else {
				do_action( 'vft_shopmenu_display' );
				do_action( 'woocommerce_no_products_found' );
			?><ul class="products-logged products columns-4 grid-layout"></ul><?
			}

			do_action( 'woocommerce_after_main_content' );

			get_footer( 'shop' );
			get_footer();
			do_action('vft_js_jquery');
			do_action('vft_js_slickslider');
			do_action( 'vft_js_shop' );
			?>
		</section>
	</div>
</div>
<?
