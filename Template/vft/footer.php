</div>
</div>
</div>
<footer class="main-footer">
  <div class="container">
    <div class="notification-container">

    </div>
    <? do_action('vft_js_notifylib'); ?>
	  <div class="main-footer__popup footer-popup">
    <div class="container">
        <h4 class="footer-popup__title">Notice</h4>
        <p class="footer-popup__text">Vitaforest.eu uses cookies to provide necessary website
            functionality, improve your experience and analyze our traffic. By using our website, you agree
            to our <a href="/privacy-policy" class="privacy-link">Privacy Policy</a> and our cookies usage.</p>
        <button class="footer-popup__btn">Accept cookies</button>
    </div>
</div>
    <div class="main-footer__row" itemscope itemtype="http://schema.org/Organization">
      <div class="main-footer__column">
        <img class="logo" src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/logo-light.svg" alt="Website logo">
        <div class="main-footer__company-info">
          <p itemprop="name">Siberian Natural Products OÜ</p>
          <p>Register code: 14377464</p>
          <p>VAT No: EE102049370</p>
			<div itemprop="address" itemscope>
		  <p itemprop="addressLocality">Harju maakond, Tallinn,</p>
				<div itemprop="streetAddress">
          <p>Lasnamäe linnaosa,</p>
          <p>Väike-Paala tn 2, <span itemprop="postalCode">11415</span></p>
				</div>
			</div>
        </div>
      </div>
      <div class="main-footer__navigation footer-navigation">
        <h2 hidden="true">Navigation</h2>
        <? do_action('vft_footer_menu_display'); ?>
      </div>
      <div class="main-footer__column">
        <div class="main-footer__social social">
          <a itemprop="sameAs" href="https://www.facebook.com/vitaforestfood/" class="social__link"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/Facebook.svg" alt="Facebook"></a>
          <a itemprop="sameAs" href="https://www.linkedin.com/company/vitaforestfood/" class="social__link"><img src="<?php echo get_bloginfo( 'template_directory' ); ?>/img/Linkedin.svg" alt="LinkedIn"></a>
        </div>
      </div>

    </div>
	  </div>
    <div class="row-top-line">
		<div class="container main-footer__row">
      <p class="main-footer__coperight">© VitaForest 2021</p>
      <a href="/privacy-policy" class="main-footer__privacy">Privacy Policy</a>
		</div>
    </div>

	<? wp_footer(); ?>
</footer>
<script id="logout-popup-init">
let logoutBtn = document.querySelector('.logout-btn');
let logoutClose = document.querySelector('.close-logout-popup');
let logoutPop = document.querySelector('.logout-popup');
let logoutBg = document.querySelector('.desktop-popup-bg');
logoutBtn.onclick = function(){
	logoutPop.classList.add('logout-popup_active');
	logoutBg.classList.add('desktop-popup-bg_active');
}
document.querySelector(".close-logout-popup").onclick = function(){
	document.querySelector('.logout-popup').classList.remove('logout-popup_active');
	document.querySelector('.desktop-popup-bg').classList.remove('desktop-popup-bg_active');
}
document.querySelector(".desktop-popup-bg").onclick = function(){
	document.querySelector('.logout-popup').classList.remove('logout-popup_active');
	document.querySelector('.desktop-popup-bg').classList.remove('desktop-popup-bg_active');
}
</script>
<script id="nologin-check">
let logDataInfo = document.getElementById('logindata');
let logDataset = logDataInfo.dataset.logged;
let logLocalData = localStorage.getItem("logLocal");
if (logDataset == 'yes') {
    null;
}
else if (logLocalData == 2) {
    null;
}
else {
    let nologinClose = document.querySelector('.close-nologin-popup');
    let nologinPop = document.querySelector('.nologin-popup');
    let nologinBg = document.querySelector('.desktop-popup-bg');
    nologinPop.classList.add('nologin-popup_active');
    nologinBg.classList.add('desktop-popup-bg_active');
    document.querySelector(".close-nologin-popup").onclick = function () {
        document.querySelector('.nologin-popup').classList.remove('nologin-popup_active');
        document.querySelector('.desktop-popup-bg').classList.remove('desktop-popup-bg_active');
        localStorage.setItem("logLocal", 2);
    }
    document.querySelector(".desktop-popup-bg").onclick = function () {
        document.querySelector('.nologin-popup').classList.remove('nologin-popup_active');
        document.querySelector('.desktop-popup-bg').classList.remove('desktop-popup-bg_active');
        localStorage.setItem("logLocal", 2);
    }
    document.querySelector('.nologin-ok').onclick = function () {
        document.querySelector('.nologin-popup').classList.remove('nologin-popup_active');
        document.querySelector('.desktop-popup-bg').classList.remove('desktop-popup-bg_active');
        localStorage.setItem("logLocal", 2);
    }
}
</script>
<script id="authpage">
let authcont = document.querySelector('.container');
let authpage = document.querySelector('.auth-page');
let authheader = document.querySelector('.header');
let authfooter = document.querySelector('.main-footer');
let authmain = document.querySelector('.main-content');
let authnologin = document.querySelector('.no-login');
if (authpage){
    authheader.classList.add('header-auth');
    authfooter.classList.add('footer-auth');
	authmain.classList.add('main-content-auth');
	authnologin.classList.add('no-login-auth');
	authcont.classList.remove('container');
}</script>
<script>
        (function(w,d,u){
                var s=d.createElement('script');s.async=true;s.src=u+'?'+(Date.now()/60000|0);
                var h=d.getElementsByTagName('script')[0];h.parentNode.insertBefore(s,h);
        })(window,document,'https://portal.vitaforestfood.com/upload/crm/site_button/loader_8_eal8j3.js');
</script>
<script>
let currentDate = Date.now();
	let visitDate = localStorage.getItem('adVisitDate');
	let intervalDate = currentDate - visitDate;
	if (intervalDate > 7200000){
	localStorage.removeItem('adVisitor');
	}
</script>
<script>
let adVisitorCont = document.querySelector('.advisitor-btn');
	if(localStorage.adVisitor === 'rhodiola'){
	adVisitorCont.innerHTML = '<a href="/rhodiola-promo" class="btn advisitor_btn">Rhodiola Promo</a>';
	}
	else if(localStorage.adVisitor === 'chaga'){
	adVisitorCont.innerHTML = '<a href="/chaga-promo" class="btn advisitor_btn">Chaga Promo</a>';
	}
</script>
<script>
let footerPopup = document.querySelector('.footer-popup');
let footerPopupBtn = document.querySelector('.footer-popup__btn');
let visited = localStorage.getItem("visited");
if (!visited) {
    footerPopup.classList.add('footer-popup_active')
}
footerPopupBtn.onclick = function () {
    localStorage.setItem("visited", "true");
    footerPopup.classList.remove('footer-popup_active');
}
</script>
<script type="text/javascript">
_linkedin_partner_id = "4030041";
window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script><script type="text/javascript">
(function(l) {
if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
window.lintrk.q=[]}
var s = document.getElementsByTagName("script")[0];
var b = document.createElement("script");
b.type = "text/javascript";b.async = true;
b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
s.parentNode.insertBefore(b, s);})(window.lintrk);
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=4030041&fmt=gif" />
</noscript>