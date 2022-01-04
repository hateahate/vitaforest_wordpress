<div class="shop__menu shop-menu">
          <div class="shop-menu__row">
            <h1 class="title">Products</h1>
            <div class="shop-menu__buttons">
              <button class="shop-menu__btn btn-list"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/layout.svg" alt="Layout mode button"></button>
	          <button class="shop-menu__btn btn-grid"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/cell.svg" alt="Grid mode button"></button>
              <button class="shop-menu__btn shop-menu__sort"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/sort.svg" alt="Sorting button"></button>
              <? do_action('vft_orderby'); ?>
              <button class="shop-menu__btn shop-menu__params"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/params.svg" alt="Filter button"></button>
            </div>
          </div>
          <div class="shop-menu__row shop-menu__filters">
			  <div class="shop-menu__production-status">
				  <? echo do_shortcode('[fe_widget id="15428"]'); ?>
			  </div>
          </div>
			<div class="shop-menu__row shop-menu__filters">
			<div class="shop-menu__active-filters">
				<? echo do_shortcode('[fe_chips id="15430"]'); ?>
			</div>
			</div>
			</div>