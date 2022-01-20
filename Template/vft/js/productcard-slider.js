$('.product-card-slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.product-card-slider-nav'
});
$('.product-card-slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.product-card-slider',
  autoplay: true,
  autoplaySpeed: 2000,
});