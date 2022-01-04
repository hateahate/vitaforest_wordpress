<nav class="navigation">
	<div class="container" >
	<ul class="navigation__list">
		<li class="navigation__main-link nav-main" >
                <a class="nav-desktop-products" href="/shop">Products</a>
		<button class="nav-desktop-products-arrow svg-btn navigation__btn-show"><svg width="11" height="6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.397.5L5.5 3.759 9.603.5l.897 1.03-5 3.97-5-3.97L1.397.5z" fill="#303236"/></svg></button>
			                <a class="nav-mobile-products" href="#">Products</a>
		<button class="svg-btn navigation__btn-show nav-mobile-products"><svg width="11" height="6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.397.5L5.5 3.759 9.603.5l.897 1.03-5 3.97-5-3.97L1.397.5z" fill="#303236"/></svg></button>
			<ul class="navigation__category navigation__category-with-sale">
        <? do_action('vft_header_menu_display'); ?>
			<li class="navigation__sale-products">
				<div class="sale-products">
					<div class="sale-products__item">
						<p class="sale-products__text">
							<? echo get_theme_mod('vft-header-saleproducts-text-first'); ?>
						</p>
						<a href="<? echo get_theme_mod('vft-header-saleproducts-link-first'); ?>" class="sale-products__link">Read more<img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/salearrow.svg"  style="margin-left: 3px;" alt="Arrow"></a>
						<div class="product-bg"></div>
						<img src="<? echo wp_get_attachment_url(get_theme_mod('vft-header-saleproducts-img-first'));?>" class="sale-products__bg" alt="Product image">
					</div>
					<div class="sale-products__item">
												<p class="sale-products__text"><? echo get_theme_mod('vft-header-saleproducts-text-second'); ?></p>
						<a href="<? echo get_theme_mod('vft-header-saleproducts-link-second'); ?>" class="sale-products__link">Read more<img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/salearrow.svg" style="margin-left: 3px;" alt="Arrow"></a>
						<div class="product-bg"></div>
						<img src="<? echo wp_get_attachment_url(get_theme_mod('vft-header-saleproducts-img-second'));?>" class="sale-products__bg" alt="Product image">
</div>
				</div>
			</li>
			</ul>
		</li>
		<li class="navigation__main-link">
                <a href="#">Company</a>
		<button class="svg-btn navigation__btn-show"><svg width="11" height="6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.397.5L5.5 3.759 9.603.5l.897 1.03-5 3.97-5-3.97L1.397.5z" fill="#303236"/></svg></button>
			<ul class="navigation__category">
        <? do_action('vft_header_menu_company'); ?>
			</ul>
			</li>
			<li>
		<? do_action('vft_header_menu_other'); ?>
		</li>
		<li class="navigation__main-link-n"><a href="<? if(is_user_logged_in()){echo '/shop/productionstatus-get-now/?min_warehouse=1';}else{echo '/shop/productionstatus-get-now';}?>">In stock products</a></li>
	</ul>
	</div>
</nav>	
