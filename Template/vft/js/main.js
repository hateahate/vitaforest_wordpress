const aboutTitles = document.querySelectorAll('.about-dropdown__title');
[...aboutTitles].forEach(btn => btn.onclick = function () {
  this.nextElementSibling.classList.toggle('about-dropdown__content_active')
});
jQuery(document).ready(function (a) {
    const t = a(".search__input"),
        e = a(".ajax-search");
    t.keyup(function () {
        let t = a(this).val();
        t.length > 2
            ? a.ajax({
                  url: "/wp-admin/admin-ajax.php",
                  type: "POST",
                  data: { action: "ajax_search", term: t },
                  success: function (a) {
                      e.fadeIn(200).html(a);
                  },
              })
            : e.fadeOut(200);
    }),
        a(document).mouseup(function (a) {
            0 === t.has(a.target).length && 0 === e.has(a.target).length && e.fadeOut(200);
        });
});




const body = document.body;
const cartBtn = document.querySelector('.cart-btn');
const cartClose = document.querySelector('.minicart-container__close');
const cartBlock = document.querySelector('.minicart');
const cartCont = document.querySelector('.minicart-container');
const menuButton = document.querySelector('.show-menu');
const menuArrow = document.querySelectorAll('.navigation__btn-show');
const navigation = document.querySelector('.navigation-container');
const showUserMenu = document.querySelector('.header__user-open');
const userMenu = document.querySelector('.user-menu');
const userMenuCont = document.querySelector('.user-menu__container');
const userMenuClose = document.querySelector('.user-menu__close');
const showSearch = document.querySelector('.show-search');
const searchForm = document.querySelector('.header__search');
const closeNavigation = document.querySelector('.navigation-container__close');
const backgroundLayer = document.querySelector('.bg-layer');
const footerMenu = document.querySelectorAll('.footer-navigation__title');
const navigationMainBtn = document.querySelectorAll('.navigation__main-link');

[...navigationMainBtn].forEach(btn => btn.onclick = function () {
	if (window.innerWidth < 1128) {
  this.lastElementChild.classList.toggle('navigation__category_active');
  this.classList.toggle('navigation__main-link_active');
	
} else {
  return
}
});


cartBtn.onclick = function () {
  cartBlock.classList.toggle('minicart_shown');
cartCont.classList.toggle('minicart-container__active')
  backgroundLayer.classList.toggle('bg-layer_active');
body.classList.toggle('jija');
}

cartClose.onclick = function () {
  cartBlock.classList.toggle('minicart_shown');
  backgroundLayer.classList.toggle('bg-layer_active');
	cartCont.classList.toggle('minicart-container__active')
	body.classList.remove('jija')
}
//scrol btn

function trackScroll() {

  if (window.pageYOffset > 1000) {
    goTopBtn.classList.add('back_to_top-show')
  }
  else if(window.pageYOffset < 1000) {
    goTopBtn.classList.remove('back_to_top-show');
  }
}

function backToTop() {
  if (window.pageYOffset > 0) {
    window.scrollBy(0, -60);
    setTimeout(backToTop, 0);
  }
}

var goTopBtn = document.querySelector('.back_to_top');

window.addEventListener('scroll', trackScroll);
goTopBtn.addEventListener('click', backToTop);


//scrolbtn finished

menuButton.onclick = function () {
  navigation.classList.toggle('navigation-container_active');
	backgroundLayer.classList.toggle('bg-layer_active');
};

backgroundLayer.onclick = function () {
  searchForm.classList.remove('header__search_active');
	this.classList.toggle('bg-layer_active');
	 navigation.classList.remove('navigation-container_active');
	cartBlock.classList.remove('minicart_shown');
	userMenu.classList.remove('user-menu_active');
	cartCont.classList.remove('minicart-container__active');
	body.classList.remove('jija');
	userMenuCont.classList.remove('user-menu__container_active');
	[...navigationMainBtn].forEach(function (item, i, arr) {
  item.lastElementChild.classList.remove('navigation__category_active');
  item.classList.remove('navigation__main-link_active');
});

}

closeNavigation.onclick = function () {
  navigation.classList.toggle('navigation-container_active');
	backgroundLayer.classList.toggle('bg-layer_active');
	body.classList.remove('jija');
}

showSearch.onclick = function () {
  searchForm.classList.toggle('header__search_active');
  backgroundLayer.classList.toggle('bg-layer_active');
	body.classList.toggle('jija')
};
showUserMenu.mouseover  = function () {
  userMenu.classList.toggle('user-menu_active');
	backgroundLayer.classList.toggle('bg-layer_active');
	body.classList.toggle('jija')
};
showUserMenu.onclick = function () {
  userMenu.classList.toggle('user-menu_active');
	userMenuCont.classList.toggle('user-menu__container_active')
	backgroundLayer.classList.toggle('bg-layer_active');
	body.classList.toggle('jija')
};

userMenuClose.onclick = function () {
  userMenu.classList.toggle('user-menu_active');
	userMenuCont.classList.toggle('user-menu__container_active')
	backgroundLayer.classList.toggle('bg-layer_active');
	body.classList.remove('jija')
};



[...footerMenu].forEach(btn => btn.onclick = function () {
  btn.nextElementSibling.classList.toggle('footer-navigation__list_active');
  this.classList.toggle("footer-navigation__title_active")
})


document.addEventListener('DOMContentLoaded', function () {
  const slider = new ChiefSlider('.slider', {
    loop: false
  });
	
  const postsSlider = new ChiefSlider('.recent-blog__slider', {
    loop: true
  });
});


let textToShow = document.querySelector('.about__full-text');
let showBtn = document.querySelector('.about__show-btn');
showBtn.onclick = function () {
  textToShow.classList.toggle('about__full-text_active');
  this.classList.toggle('about__show-btn_active')
  if (this.classList.contains('about__show-btn_active')) {
    this.innerHTML = "-"
  } else {
    this.innerHTML = "+"
    window.scrollTo({
      top: 2200,
      behavior: "smooth"
    });
  }}

let dude={}

dude.hui = function(){
	alert('mat')
}

