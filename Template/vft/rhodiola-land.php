<?
/*
* Template Name: Rhodiola Promo
*/
?>
<? wp_head(); ?>
<body>
	<div class='bglayer'></div>
    <header class="main-header">
        <div class="main-header__row container">
			<a href="/"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/logo-white.svg" alt="Website logo" class="main-header__logo"></a>
            <a href="tel:+3728801043" class="main-header__phone">+3728801043</a>
        </div>
    </header>
    <main class="main-content">
        <div class="popup popup_sl">
            <button class='popup__close popup_sl__close'><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/close.svg" alt=""></button>
            <h3 class="popup__title">Leave your contact details, we will contact you</h3>
			<div class="popup__noti">
				
			</div>
            <? echo do_shortcode('[contact-form-7 id="16027" title="Rhodiola Land | Header Form" html_class="header-form"]'); ?>
        </div>
		<div class="popup popup_docs">
            <button class='popup__close popup_docs__close'><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/close.svg" alt=""></button>
            <h3 class="popup__title">Leave your contacts to learn more about the product</h3>
			<div class="popup__noti_files">	
			</div>
            <? echo do_shortcode('[contact-form-7 id="16028" title="Rhodiola Land | Files form" html_class="files-form"]'); ?>
        </div>
				<div class="files-preview">
			<img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/file.png">
		</div>
		<div class="preview">
            <div class="container">
               	<picture>
			<source media="(max-width: 1099px)" srcset="<?php echo get_bloginfo( 'template_directory' ); ?>/img/rhodiola-mobile.png">
			<source media="(min-width: 1100px)" srcset="<?php echo get_bloginfo( 'template_directory' ); ?>/img/rhodiola-land.png">
                <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/rhodiola-land.png" alt="#" class="preview__image">
				</picture>
                <div class="preview__wrapper">
                    <h2 class="preview__title">Genuine ingredient boosts the potential benefits of your product </h2>
                   <div class="preview__row">
                        <button class="preview__btn btn">Get now</button>
                        <p class="preview__notice">A product with unique properties
                            from the wild places of Siberia</p>
                    </div>
                </div>
            </div>
        </div>
        <section class="product">
            <div class="container">
                <div class="product__wrapper">
                    <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/rhodiola-product-land.png" alt="" class="product__image">
                    <div class="product__content">
                        <h2 class="product__title">About Rhodiola Rosea</h2>
                        <p class="product__text">Rhodiola rosea is one of the best plants providing adaptogenic
                            properties.
                            Rhodiola has been used since ancient times in Tibetan medicine. It grows in regions with a
                            cold
                            and
                            temperate climate, like North America, the United Kingdom, and Ireland, in alpine mountain
                            meadows (in the
                            Alps, Pyrenees, Carpathians) and in the Pamirs.
                        </p>
                        <p class="product__text">
                            In Russia — in the Urals, in the polar regions of Yakutia, in the mountainous regions of
                            Eastern
                            Siberia,
                            Western Siberia and the Far East, on the coast of the White and Barents Seas.
                        </p>
                    </div>
                </div>
            </div>

        </section>
        <div class="elem-wrapper elem-wrapper_white">
            <section class='mountain-element mountain-element_white'></section>
        </div>
        <section class="advantages">
            <h3 class="advantages__title">Our advantages</h3>
            <div class="advantages__list container">
                <div class="advantages__item advantage">
                    <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/clock.svg" alt="" class="advantage__logo">
                    <h4 class="advantage__title">We work fast</h4>
                    <p class="advantage__description">Shipment with in 2 days</p>
                    <p class="advantage__text">Our warehouse is located in Tallinn, Estonia, which allows us to deliver
                        in the
                        shortest possible time</p>
                </div>
                <div class="advantages__item advantage">
                    <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/mountains.svg" alt="" class="advantage__logo">
                    <h4 class="advantage__title">Products of Russian origin</h4>
                    <p class="advantage__description">Wild raw materials from Siberia</p>
                    <p class="advantage__text">We meticulously collect raw materials
                        in ecologically safe regions of Siberia to preserve the most
                        powerful complex of biologically active substances and share with you the pristine, unbridled
                        power of the
                        wild nature of this unique region</p>
                </div>
                <div class="advantages__item advantage" id="document-list-anchor">
                    <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/european.svg" alt="" class="advantage__logo">
                    <h4 class="advantage__title">European standards</h4>
                    <p class="advantage__description">Bulk ingredients that comply with the EU regulations.</p>
                    <p class="advantage__text">Product quality and safety measurements are performed in European third-party labs. The products do not contain ethylene oxides in accordance with Regulation (EC) No 396/2005.</p>
                </div>
            </div>
        </section>
        <section class="documents">
			<h3 class="documents__title">Learn more about our products</h3>
            <div class="container">
                <ul class="documents__list">
                    <li class="documents__item document document_pdf">
                        <h4 class="document__name">Rhodiola TDS</h4>
                        <a href="#document-list-anchor" class="document__download">Download</a>
                    </li>
                    <li class="documents__item document document_docx">
                        <h4 class="document__name">Rhodiola SDS</h4>
                        <a href="#document-list-anchor" class="document__download">Download</a>
                    </li>
                    <li class="documents__item document document_pdf">
                        <h4 class="document__name">Rhodiola COA</h4>
                        <a href="#document-list-anchor" class="document__download">Download</a>
                    </li>
                </ul>
            </div>
        </section>
        <section class="usage">
            <h3 class="usage__title">Rhodiola Rosea will be interested to manufacturers of</h3>
            <div class="usage__slider">
                <div class="usage__slide usage-slide">
                    <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/supplements.svg" alt="" class="usage-slide__icon">
                    <h4 class="usage-slide__title">Food supplements</h4>
                    <ul class="usage-slide__list">
                        <li>Dietary supplements and creams for recovery after injuries, surgery, or ailments</li>
                        <li>Products for minimizing environmental effects at harsh-condition sites (radioactive
                            zones
                            etc.)</li>
                        <li>Products and vitamins to solve local problems: regulate blооd pressure, improve
                            metabolism;
                            auxiliary
                            products for women and men; heart health medicines, etc</li>
                        <li>Dietary supplements stimulating stamina, enhancing productivity; nootropics</li>
                    </ul>
                </div>
                <div class="usage__slide usage-slide">
                    <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img//cosmetics.svg" alt="" class="usage-slide__icon">
                    <h4 class="usage-slide__title">Cosmetics</h4>
                    <ul class="usage-slide__list">
                        <li>Face, skin, еуе, hand саге cosmetics</li>
                        <li>Shampoos and hair products</li>
                        <li>Perfumery and fragranced cosmetics (including soap)</li>
                        <li>Bath foam, lotions, and salt</li>
                        <li>Deodorants (including dry deodorants) and foot саге creams</li>
                        <li>Hair dyes and coloring balms (rhodiola is а natural dye)</li>
                    </ul>
                </div>
                <div class="usage__slide usage-slide">
                    <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/pharma.svg" alt="" class="usage-slide__icon">
                    <h4 class="usage-slide__title">Pharma</h4>
                    <ul class="usage-slide__list">
                        <li>Products to reduce nervous tension and manifestations of depression</li>
                        <li>Male strength enhancement products</li>
                        <li> lmmunomodulatory products</li>
                        <li>Anti-viral and anti-inflammatory products</li>
                    </ul>
                </div>
                <div class="usage__slide usage-slide">
                    <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/nutrition.svg" alt="" class="usage-slide__icon">
                    <h4 class="usage-slide__title">Healthy nutrition</h4>
                    <ul class="usage-slide__list">
                        <li>Sports nutrition</li>
                        <li>Sports drinks (including powdered)</li>
                        <li>Sports creams and gels</li>
                        <li>Sports dietary supplements.</li>
                    </ul>
                </div>
                <div class="usage__slide usage-slide">
                    <img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/food.svg" alt="" class="usage-slide__icon">
                    <h4 class="usage-slide__title">Food and beverages</h4>
                    <ul class="usage-slide__list">
                        <li>Functional beverage</li>
                        <li>Strong alcoholic drinks (e.g. vodka, whiskey)</li>
                        <li>Marmalade, marshmallows</li>
                        <li>Dry and liquid jelly</li>
                    </ul>
                </div>
            </div>
        </section>
        <div class="elem-wrapper">
            <section class='mountain-element mountain-element_last'></section>
        </div>
        <section class="questions">
            <div class="container">
                <h3 class="questions__title">Still have questions?</h3>
                <p class="questions__description">Contact us and we will answer them as soon as possible</p>
                <div class="questions__wrapper">
					<div class="form">
                   <? echo do_shortcode('[contact-form-7 id="16029" title="Rhodiola Land | Footer Form" html_class="footer-form"]'); ?>
					</div>
<div class="about-company">
	<div class="logo-wrapper">
	 <img src="https://vitaforest.eu/wp-content/themes/vft/img/logo-land-footer.svg" alt="Website logo"
                    class="footer-logo">
		</div>
            <div class="contacts">
                <h2 class="contacts__title">
                    Contact info
                </h2>
                <p>Harju maakond, Tallinn,</p>
                <p>Lasnamäe linnaosa,</p>
                <p>Väike-Paala tn 2, 11415</p>
                <a class="phone-number" href="mailto:info@vitaforest.eu">info@vitaforest.eu</a>
                <p style="color: white; text-decoration: none;">+3728801043</p>
            </div>
            <div class="company">
                <h2 class="company__title">Company info</h2>
                <p>SIBERIAN NATURAL PRODUCTS OÜ</p>
                <p>Register code: 14377464</p>
                <p>VAT No: EE102049370</p>
            </div>
            <div class="follow-us">
                <h2 class="follow-us__title">Follow us</h2>
                <div class="follow-us__links">
                    <a href="https://www.facebook.com/vitaforestfood/" class="follow-us__link">
                        <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect x="0.7" y="0.7" width="48.6" height="48.6" rx="24.3" stroke="#40BF6A" stroke-width="1.4"></rect>
          <path d="M30.8105 27.1875L31.4941 22.6953H27.1484V19.7656C27.1484 18.4961 27.7344 17.3242 29.6875 17.3242H31.6895V13.4668C31.6895 13.4668 29.8828 13.125 28.1738 13.125C24.6094 13.125 22.2656 15.3223 22.2656 19.2285V22.6953H18.2617V27.1875H22.2656V38.125H27.1484V27.1875H30.8105Z" fill="#40BF6A"></path>
        </svg>
                    </a>
                    <a href="https://www.linkedin.com/company/vitaforestfood/" class="follow-us__link">
                     <svg width="50" height="50" viewBox="0 0 50 50" fill="none" xmlns="http://www.w3.org/2000/svg">
			<rect x="0.7" y="0.7" width="48.6" height="48.6" rx="24.3" stroke="#40BF6A" stroke-width="1.4"></rect>
          <path d="M34.375 14.6875H15.5762C14.7461 14.6875 14.0625 15.4199 14.0625 16.2988V35C14.0625 35.8789 14.7461 36.5625 15.5762 36.5625H34.375C35.2051 36.5625 35.9375 35.8789 35.9375 35V16.2988C35.9375 15.4199 35.2051 14.6875 34.375 14.6875ZM20.6543 33.4375H17.4316V23.0371H20.6543V33.4375ZM19.043 21.5723C17.9688 21.5723 17.1387 20.7422 17.1387 19.7168C17.1387 18.6914 17.9688 17.8125 19.043 17.8125C20.0684 17.8125 20.8984 18.6914 20.8984 19.7168C20.8984 20.7422 20.0684 21.5723 19.043 21.5723ZM32.8125 33.4375H29.541V28.3594C29.541 27.1875 29.541 25.625 27.8809 25.625C26.1719 25.625 25.9277 26.9434 25.9277 28.3105V33.4375H22.7051V23.0371H25.7812V24.4531H25.8301C26.2695 23.623 27.3438 22.7441 28.9062 22.7441C32.1777 22.7441 32.8125 24.9414 32.8125 27.7246V33.4375Z" fill="#40BF6A"></path>
          
        </svg>
                    </a>
                </div>
            </div>
        </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="main-footer">
        <div class="footer__row copyright">
            <p class="copyright__text">Copyright © 2021 All rights reserved Vitaforest</p>
        </div>
	  <div class="main-footer__popup footer-popup">
    <div class="container">
        <h4 class="footer-popup__title">Notice</h4>
        <p class="footer-popup__text">Vitaforest.eu uses cookies to provide necessary website
            functionality, improve your experience and analyze our traffic. By using our website, you agree
            to our <a href="/privacy-policy" class="phone-number">Privacy Policy</a> and our cookies usage.</p>
        <button class="footer-popup__btn">Accept cookies</button>
    </div>
</div>
        <? wp_footer(); ?>
    </footer>
    <script>
		let btns = document.querySelectorAll('.btn');
		let popupsl = document.querySelector('.popup_sl');
		let slclose = document.querySelector('.popup_sl__close');
		let popupDocs = document.querySelector('.popup_docs');
		let docsBtns = document.querySelectorAll('.document__download');
		let docsClose = document.querySelector(".popup_docs__close");
		let bg = document.querySelector('.bglayer');
		let footerPopup = document.querySelector('.footer-popup');
		let footerPopupBtn = document.querySelector('.footer-popup__btn');
		let visited = localStorage.getItem("visited");
		let filesPreview = document.querySelector('.files-preview');
		[...btns].forEach(btn => btn.onclick = function () {
			popupsl.classList.add('popup_active');
			bg.classList.add('bglayer_active');
		});
		slclose.onclick = function(){
			popupsl.classList.remove('popup_active');
			bg.classList.remove('bglayer_active');
			
		};
		[...docsBtns].forEach(btn => btn.onclick = function () {
			popupDocs.classList.add('popup_active');
			bg.classList.add('bglayer_active');
			filesPreview.classList.add('files-preview_active');
		});
		docsClose.onclick = function(){
			popupDocs.classList.remove('popup_active');
			bg.classList.remove('bglayer_active');
			filesPreview.classList.remove('files-preview_active');
		};
		bg.onclick = function(){
			popupsl.classList.remove('popup_active');
			popupDocs.classList.remove('popup_active');
			bg.classList.remove('bglayer_active');
			filesPreview.classList.remove('files-preview_active');
		}
		if(!visited){
			footerPopup.classList.add('footer-popup_active')
		}
		footerPopupBtn.onclick = function(){
			localStorage.setItem("visited","true");
			footerPopup.classList.remove('footer-popup_active')
		}
		function validateClick() {
    let formfooter = document.querySelector('.footer-form');
    let formheader = document.querySelector('.header-form');
    let formfiles = document.querySelector('.files-form');
	let notiFirst = document.querySelector('.popup__noti');
	let notiSecond = document.querySelector('.popup__noti_files');
    let datatypeheader = formheader.dataset.status;
    let datatypefooter = formfooter.dataset.status;
    let datatypefiles = formfiles.dataset.status;
    if (datatypeheader === 'sent') {
        gtag_rhodiola_head();
		notiFirst.innerHTML = 'Successfully sended! Thanks!';
		notiFirst.classList.add('noti_active');
    }
    else if (datatypefooter === 'sent') {
        gtag_rhodiola_footer();
    }
    else if (datatypefiles === 'sent') {
        gtag_rhodiola_files();
		notiSecond.innerHTML = 'Successfully sended! Thanks!';
		notiSecond.classList.add('noti_active');
    }
    else {
        console.log('Not valid!');
    }
}
let cfBtn = document.querySelector('.rosea-footer'),
    cfiBtn = document.querySelector('.rosea-files'),
    chBtn = document.querySelector('.rosea-header')

cfBtn.onclick = function () {
    let timer = setTimeout(validateClick, 3000);;
}
cfiBtn.onclick = function () {
    let timer = setTimeout(validateClick, 3000);;
}
chBtn.onclick = function () {
    let timer = setTimeout(validateClick, 3000);;
}
	</script>
	<script>
	if(localStorage.getItem('adVisitDate') != null){
	null;
	}
	else{
	let dateController = Date.now();
	localStorage.setItem('adVisitDate', dateController);
	}
	let dateController = Date.now();
	localStorage.setItem('adVisitDate', dateController);
	localStorage.setItem('adVisitor', 'rhodiola');
	</script>
    <? do_action('vft_js_landslick'); ?>
<script>
        (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://portal.vitaforestfood.com/upload/crm/site_button/loader_9_ckkdae.js');
</script>
</body>