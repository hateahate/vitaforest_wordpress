let generalbtn = document.querySelector(".tabs__btn_general");
let extbtn = document.querySelector(".tabs__btn_external");
let cntbtn = document.querySelector(".tabs__btn_cnt");

let generalwrapper = document.getElementById('wiki-general');
let extwrapper = document.getElementById('wiki-external');
let cntwrapper = document.getElementById('wiki-cnt');

generalbtn.classList.add('tabs__btn_active');
extwrapper.classList.add('wrapper-disable');
cntwrapper.classList.add('wrapper-disable');


generalbtn.onclick = function () {
	generalwrapper.classList.remove('wrapper-disable');
	generalbtn.classList.add('tabs__btn_active');
	extbtn.classList.remove('tabs__btn_active');
	cntbtn.classList.remove('tabs__btn_active');
	extwrapper.classList.add('wrapper-disable');
	cntwrapper.classList.add('wrapper-disable');
}
extbtn.onclick = function () {
	extwrapper.classList.remove('wrapper-disable');
	extbtn.classList.add('tabs__btn_active');
	generalbtn.classList.remove('tabs__btn_active');
	cntbtn.classList.remove('tabs__btn_active');
	generalwrapper.classList.add('wrapper-disable');
	cntwrapper.classList.add('wrapper-disable');
}

cntbtn.onclick = function () {
	cntwrapper.classList.remove('wrapper-disable');
	cntbtn.classList.add('tabs__btn_active');
	generalbtn.classList.remove('tabs__btn_active');
	extbtn.classList.remove('tabs__btn_active');
	extwrapper.classList.add('wrapper-disable');
	generalwrapper.classList.add('wrapper-disable');
}
$('.related-products__slider').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  centerMode: true,
  variableWidth: true
});