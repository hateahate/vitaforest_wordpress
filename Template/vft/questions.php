<? 
/*
* Template Name: Contact us
*/
get_header(); ?>
<div class="container">
	<h1 hidden="true">
		Contact Us
	</h1>
	<div class="contact-us-container">
  <section class="questions">
    <h2 class="questions__title">Got questions?</h2>
    <p class="questions__description">
      If you’d like to learn more about us and our products, get in touch!
    </p>
<? echo do_shortcode('[contact-form-7 id="14735" title="Contact form"]'); ?>
  </section>
  <section class="contact-info" itemscope itemtype="http://schema.org/Organization">
	  <div class="info-wrapper">
		  <div class="info-wrapper__element1">
    <h2 class="contact-info__title">
      Company info
    </h2>
    <p class="contact-info__description">
		<span itemprop="name">SIBERIAN NATURAL PRODUCTS OÜ</span></br>
      <span>Register code: 14377464</span></br>
	<span>VAT No: EE102049370</span></br>
    </p>
			  </div>
		  <div class="info-wrapper__element2" itemprop="address" itemscope>
    <h2 class="contact-info__title">Contact info</h2>
    <p class="contact-info__description">
      <span itemprop="addressLocality">Harju maakond, Tallinn</span>, <br>
      <span itemprop="streetAddress">Lasnamäe linnaosa, <br>
      Väike-Paala tn 2,</span><span itemprop="postalCode">11415</span><br>
		<a href="mailto:info@vitaforest.ru" class="contact-info__link"><span itemprop="email">info@vitaforest.eu</span> </a> <br>
      <span itemprop="telephone">+3728801043</span><br>
    </p>
			  			  
		  </div>
	</div>
    <div class="contact-info__social">
      <h2 class="contact-info__title">Follow us</h2>
      <a href="https://www.facebook.com/vitaforestfood/" itemprop="sameAs">
        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect x="0.7" y="0.7" width="48.6" height="48.6" rx="24.3" stroke="#40BF6A" stroke-width="1.4" />
          <path
            d="M30.8105 27.1875L31.4941 22.6953H27.1484V19.7656C27.1484 18.4961 27.7344 17.3242 29.6875 17.3242H31.6895V13.4668C31.6895 13.4668 29.8828 13.125 28.1738 13.125C24.6094 13.125 22.2656 15.3223 22.2656 19.2285V22.6953H18.2617V27.1875H22.2656V38.125H27.1484V27.1875H30.8105Z"
            fill="#40BF6A" />
        </svg>

      </a>
      <a href="https://www.linkedin.com/company/vitaforestfood/" itemprop="sameAs">
        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect x="0.7" y="0.7" width="48.6" height="48.6" rx="24.3" stroke="#40BF6A" stroke-width="1.4" />
          <path
            d="M34.375 14.6875H15.5762C14.7461 14.6875 14.0625 15.4199 14.0625 16.2988V35C14.0625 35.8789 14.7461 36.5625 15.5762 36.5625H34.375C35.2051 36.5625 35.9375 35.8789 35.9375 35V16.2988C35.9375 15.4199 35.2051 14.6875 34.375 14.6875ZM20.6543 33.4375H17.4316V23.0371H20.6543V33.4375ZM19.043 21.5723C17.9688 21.5723 17.1387 20.7422 17.1387 19.7168C17.1387 18.6914 17.9688 17.8125 19.043 17.8125C20.0684 17.8125 20.8984 18.6914 20.8984 19.7168C20.8984 20.7422 20.0684 21.5723 19.043 21.5723ZM32.8125 33.4375H29.541V28.3594C29.541 27.1875 29.541 25.625 27.8809 25.625C26.1719 25.625 25.9277 26.9434 25.9277 28.3105V33.4375H22.7051V23.0371H25.7812V24.4531H25.8301C26.2695 23.623 27.3438 22.7441 28.9062 22.7441C32.1777 22.7441 32.8125 24.9414 32.8125 27.7246V33.4375Z"
            fill="#40BF6A" />
          
        </svg>
      </a>
    </div>
  </section>
		</div>
</div>
<section class="map">
  <iframe
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8117.38207369215!2d24.80841003287177!3d59.4273117648483!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4692ed68ede5daf1%3A0x4c59afde623e8814!2zVsOkaWtlLVBhYWxhIDIsIDExNDE0IFRhbGxpbm4sINCt0YHRgtC-0L3QuNGP!5e0!3m2!1sru!2sru!4v1626443861445!5m2!1sru!2sru"
    style="border:0;" allowfullscreen="" loading="lazy"></iframe>
</section>
<? get_footer(); ?>