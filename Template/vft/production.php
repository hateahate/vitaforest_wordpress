<? 
/*
* Template Name: Production
*/
get_header();
?>
	<div class ="production-page">
<section class="preview production-preview">
  <h1 class="preview__title">
    Our production
  </h1>
  <p class="preview__description">We implement the whole cycle <br>of VitaForest's powders and extracts production
  </p>
  <button class="preview__scroll scroll"><svg width="12" height="6" viewBox="0 0 12 6" fill="none"
      xmlns="http://www.w3.org/2000/svg">
      <path
        d="M1.39373 0.675242L6.02934 3.75806L10.4146 0.328398L11.4396 1.31909L6.09625 5.49813L0.447752 1.74172L1.39373 0.675242Z"
        fill="white"></path>
    </svg>
  </button>
  <p class="preview__scroll-description">scroll down</p>
</section>
<div class="container">
  <section class="process">
    <h2 class="proscess__title">Process</h2>
    <ul class="process__list">
      <li class="process__item">Obtaining raw materials</li>
      <li class="process__item">Primary processing of raw materials</li>
      <li class="process__item">Production and quality control of powders</li>
      <li class="process__item">Production and quality control of extracts</li>
      <li class="process__item">Storing </li>
      <li class="process__item">Logistics</li>
    </ul>
  </section>

  <section class="process-step obtaining">
    <h2 class="process-step__title">Obtaining raw materials</h2>
    <p>
      Raw materials are obtained in outlying Siberian areas, far away from urban civilization. Our company with help of
      local people carefully forage wild mushrooms, berries, fruits, roots and herbs by hand, this way the ecological
      purity of our raw materials is guaranteed. We do not stimulate growth of raw materials anyhow and do not cultivate
      any organic products, instead we benefit from natural environment and wild nature.</p>
    <p> To maintain high quality of raw materials and nature conservation all foragers get instructed on sight. Foraged
      mushrooms and plants get sorted, verified, tested in laboratory condition and sent for processing.
    </p>
    <ul class="obtaining__features">
      <li class="obtaining__feature">Faraway from industrial areas wilderness</li>
      <li class="obtaining__feature">Clean ecology</li>
      <li class="obtaining__feature">Availability of specialists for collection</li>
    </ul>
  </section>

  <section class="process-step primary">
    <h2 class="process-step__title">Primary processing of raw materials</h2>
    <p>We elaborately adjust processing technology of each herb, berry, fruit or mushroom according to it special
      aspects.
      It ensures high concentration of biologically active substances for VitaForest's finished products.</p>

    <p> Primary processing is implemented at low temperatures. Raw materials is washed through or cleaned, dried at a
      temperatures below 60 degrees Celsius or froze through the use of dry shock freezing method. Further, ready matter
      is pre-packed and gets delivered to the manufacturing site.</p>
  </section>
</div>
<section class="process-step powders">
  <div class="container">
    <h2 class="process-step__title">Production of powders</h2>
    <div class="process-step__slider">

<div class="slider">
      <div class="slider__container slider-cont-upper">
        <div class="slider__wrapper">
          <div class="slider__items">
            <div class="slider__item">
             <div class="prcoess-step__slide process-slide">
        <img class="process-slide__image" src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/production/powders/Grinding.webp" alt="Grinding">
				 <div class="slide-bglayer"></div>
        <h3 class="process-slide__title">Grinding</h3>
        <p class="process-slide__text">
          Ready dry raw materials are loaded into grinder and turned into required size. </p>
      </div>
            </div>
            <div class="slider__item">
               <div class="prcoess-step__slide process-slide">
        <img class="process-slide__image" src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/production/powders/labtest.webp" alt="Laboratory testing">
				   <div class="slide-bglayer"></div>
        <h3 class="process-slide__title">Laboratory testing</h3>
        <p class="process-slide__text">Quantitative and Qualitative analyses are carried out according to
          specifications.
          "Sigma-
          Aldrich" substance standards are used during laboratory tests implementation. Ready products comply with EU
          safety and quality standards.</p>
      </div>
            </div>
            <div class="slider__item">
             <div class="prcoess-step__slide process-slide">
        <img class="process-slide__image" src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/production/powders/Packaging.webp" alt="Packaging">
				 <div class="slide-bglayer"></div>
        <h3 class="process-slide__title">Packaging</h3>
        <p class="process-slide__text">
          Ready plant materials may be delivered in bulk or packed into bags, pouches, jars, capsules
          and other forms according to your order.
        </p>
      </div>
            </div>
          
          </div>
        </div>
      </div>
	<div class="contr contr-upper">
		
	
       <a href="#" class="slider__control" data-slide="prev"></a>
		<div class = "slider-counter countas">
			<span class='count-current'>1</span>
			<span class ='count-sl'>/</span>
			<span class='count-max'>3</span>
		</div>
      <a href="#" class="slider__control" data-slide="next"></a>
		</div>
    </div>


    </div>
    <div class="products-slider">
      <div class="products-slider__header">
        <h3 class="products-slider__title">Powders</h3>
        <a href="/shop/category-powders" class="products-slider__link">See products</a>
      </div>
      <!--Вот тут товары выводи(Powders)-->
		<?
		$a = array(
        'post_type'      => 'product',
		'product_cat' => 'powders',
        'post_status'    => 'publish',
        'order'          => 'DESC',
        'orderby'        => 'date'
    	);
    $query = new WP_Query($a); ?>
      <div class="products-slider__wrapper">
		  <? if ($query->have_posts()) {
			while ($query->have_posts()) {
            $query->the_post(); ?>
        <div class="product-slide">
			<?
			$currentid = get_the_ID();
			$urli = get_the_post_thumbnail_url($currentid);
			?>
          <h4 class="product-slide__title"><?php the_title(); ?></h4>
          <a href="<?php the_permalink(); ?>" class="product-slide__link">Shop now</a>
          <img src="<? echo $urli; ?>" alt="<?php the_title(); ?>" class="product-slide__image">
          <div class="product-slide__bg"></div>
        </div>
		  <?
			}
}
		  else {
			  
		  }
		  ?>
      </div>
      <!--Вот тут товары больше не выводи-->
    </div>
  </div>
</section>

<section class="process-step extracts">
  <div class="container">
    <h2 class="process-step__title">Production of extracts</h2>
     <div class="recent-blog__slider">
      <div class="slider__container">
        <div class="slider__wrapper slider-wrap-lower">
          <div class="slider__items">
            <div class="slider__item">
             <div class="prcoess-step__slide process-slide">
        <img class="process-slide__image" src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/production/extracts/grinding.webp" alt="Grinding">
				 <div class="slide-bglayer"></div>
        <h3 class="process-slide__title">Grinding</h3>
        <p class="process-slide__text">
		Ready dry raw materials are loaded into grinder and turned into required size.
        </p>
      </div>
            </div>
            <div class="slider__item">
               <div class="prcoess-step__slide process-slide">
        <img class="process-slide__image" src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/production/extracts/extraction.webp" alt="Extraction">
		<div class="slide-bglayer"></div>
        <h3 class="process-slide__title">Extraction</h3>
        <p class="process-slide__text">
          To achieve highest possible quantity of useful substances every extract is going through individually
adjusted, scientifically justified and laboratory tested production.
        </p>
      </div>

            </div>
            <div class="slider__item">
             <div class="prcoess-step__slide process-slide">
        <img class="process-slide__image" src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/production/extracts/filtration.webp" alt="Filtration">
				 <div class="slide-bglayer"></div>
        <h3 class="process-slide__title">Filtration</h3>
        <p class="process-slide__text">
		After the extraction process, the resulting raw material is thoroughly filtered.
          .
        </p>
      </div>
            </div>
            <div class="slider__item">
          
      <div class="prcoess-step__slide process-slide">
        <img class="process-slide__image" src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/production/extracts/drying.webp" alt="Drying">
		  <div class="slide-bglayer"></div>
        <h3 class="process-slide__title">Drying</h3>
        <p class="process-slide__text">
          Under vacuum drying, matter reforms into dry leaf and gets grinded. Under spray dehydration extract is loaded
          into tank with circulating warm air where particles instantly dry up and reform into powder.
        </p>
      </div>
            </div>
            <div class="slider__item">
            
      <div class="prcoess-step__slide process-slide">
        <img class="process-slide__image" src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/production/extracts/labtest.webp" alt="Laboratory testing">
		  <div class="slide-bglayer"></div>
        <h3 class="process-slide__title">Laboratory testing</h3>
        <p class="process-slide__text">
          Quantitative and Qualitative analyses of matter and ready extracts are carried out according to
          specifications. Sigma-Aldrich matter standards are used during laboratory tests implementation. Ready products
          comply with EU safety and quality standards.
        </p>
      </div>
			  </div>
				<div class="slider__item">
				      <div class="process-step__slide process-slide">
        <img class="process-slide__image" src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/production/extracts/packaging.webp" alt="Packaging">
		  <div class="slide-bglayer"></div>
        <h3 class="process-slide__title">Packaging</h3>
        <p class="process-slide__text">
Extracts are packed into double bags to avoid moisture condensation. During shipment bags are stored into
double-double carton boxes.
        </p>
      </div>
            </div>
          </div>
        </div>
<div class="contr contr-lower">
		
	
       <a href="#" class="slider__control slider__controls-white" data-slide="prev"></a>
		<div class = "slider-countey countas slider-counter__white">
			<span class='count-current'>1</span>
			<span class ='count-sl'>/</span>
			<span class='count-max'>6</span>
		</div>
      <a href="#" class="slider__control slider__controls-white" data-slide="next"></a>
		</div>
    </div>
	</div>
    <div class="products-slider">
      <div class="products-slider__header">
        <h3 class="products-slider__title">Extracts</h3>
        <a href="/shop/category-extracts" class="products-slider__link">See products</a>
      </div>
      <!--Вот тут товары выводи(Extracts)-->
      <?
		$b = array(
        'post_type'      => 'product',
		'product_cat' => 'extracts',
        'post_status'    => 'publish',
        'order'          => 'DESC',
        'orderby'        => 'date'
    	);
    $queryb = new WP_Query($b); ?>
      <div class="products-slider__wrapper">
		  <? if ($queryb->have_posts()) {
			while ($queryb->have_posts()) {
            $queryb->the_post(); ?>
        <div class="product-slide">
			<?
			$currentidb = get_the_ID();
			$urlib = get_the_post_thumbnail_url($currentidb);
			?>
          <h4 class="product-slide__title"><?php the_title(); ?></h4>
          <a href="<?php the_permalink(); ?>" class="product-slide__link">Shop now</a>
          <img src="<? echo $urlib; ?>" alt="<?php the_title(); ?>" class="product-slide__image">
          <div class="product-slide__bg"></div>
        </div>
		  <?
			}
}
		  else {
			  
		  }
		  ?>
      </div>
      <!--Вот тут товары больше не выводи-->
    </div>
  </div>
</section>

<div class="container">
  <section class="process-step storing">
    <h2 class="process-step__title">Obtaining raw materials</h2>
    <p>Ready extracts and plant materials are stored at our warehouse in Tallin, Estonia. Warehouse complies with EU
      safety and quality standards. Thick bags encased in strong carton boxes are used as packages.
    </p>
  </section>
  <section class="process-step logistics">
    <h2 class="process-step__title">Logistics</h2>
    <p>We collaborate with the logistics company Europiir Logistics for more than 3 years already, whos competence helps our customers to save on shipping costs without sacrificing quality. At your request, we will send the available goods to you by any convenient way from Tallinn, within 2 days after making the payment. The average cumulative production and delivery time for custom-made goods are 35-40 days. Each shipment of goods comes with complete documentation set.
.

    </p>
  </section>
</div>
<style>.slider{position:relative}.slider__container{overflow:hidden}.slider__items{display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;transition:transform .5s ease}.slider_disable-transition{-webkit-transition:none;-o-transition:none;transition:none}.slider__item{-webkit-box-flex:0;-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.slider__control{position:absolute;top:50%;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;width:40px;color:#fff;text-align:center;height:50px;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%);background:rgba(0,0,0,.2)}.slider__control_hide{display:none}.slider__control[data-slide=prev]{left:0}.slider__control[data-slide=next]{right:0}.slider__control:focus,.slider__control:hover{color:#fff;text-decoration:none;outline:0;background:rgba(0,0,0,.3)}.slider__control::before{content:'';display:inline-block;width:20px;height:20px;background:transparent no-repeat center center;background-size:100% 100%}.slider__control[data-slide=prev]::before{background-image:url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E")}.slider__control[data-slide=next]::before{background-image:url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E")}.slider__indicators{position:absolute;right:0;bottom:0;left:0;z-index:15;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;padding-left:0;margin-right:15%;margin-left:15%;list-style:none;margin-top:0;margin-bottom:0}.slider__indicators li{-webkit-box-sizing:content-box;box-sizing:content-box;-webkit-box-flex:0;-ms-flex:0 1 auto;flex:0 1 auto;width:30px;height:5px;margin-right:3px;margin-left:3px;text-indent:-999px;cursor:pointer;background-color:rgba(255,255,255,.5);background-clip:padding-box;border-top:15px solid transparent;border-bottom:15px solid transparent}.slider__indicators li.active{background-color:rgba(255,255,255,.9)}
</style>
<?
do_action('vft_js_jquery');
do_action('vft_js_slickslider');
do_action('vft_js_slider');
?>
<script type="text/javascript">
  $('.products-slider__wrapper').slick({
	    infinite: true,
  speed: 300,
  slidesToShow: 1,
	  arrows: false,
  centerMode: true,
  variableWidth: true,
	  dots:true
  });
	
	let counter =  document.querySelector('.slider-counter');
let plusx = counter.nextElementSibling
let minusx = counter.previousElementSibling
let currentnum= counter.firstElementChild

plusx.onclick = function(){
	if( Number(currentnum.innerHTML)<3){
	currentnum.innerHTML  = Number(currentnum.innerHTML)+1}
	else {currentnum.innerHTML  = Number(currentnum.innerHTML)-2}
	
}
minusx.onclick = function(){
	if( Number(currentnum.innerHTML)===1){
	
	currentnum.innerHTML  = 3}
	else {currentnum.innerHTML  = Number(currentnum.innerHTML)-1}
	
}

let cuts =document.querySelector('.slider-countey');
	let plisx = cuts.nextElementSibling;
	let minisx= cuts.previousElementSibling;
let	curentnum= cuts.firstElementChild

plisx.onclick = function(){
	if( Number(curentnum.innerHTML)<6){
	curentnum.innerHTML  = Number(curentnum.innerHTML)+1}
	else {curentnum.innerHTML  = Number(curentnum.innerHTML)-5}
	
}
minisx.onclick = function(){
	if( Number(curentnum.innerHTML)===1){
	
	curentnum.innerHTML  = 6}
	else {curentnum.innerHTML  = Number(curentnum.innerHTML)-1}
	
}

		</script></div>
<? get_footer(); ?>