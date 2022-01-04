const qty = document.querySelector('.input-text');
const totalPrice = document.querySelector('.product__total-price');
const price = document.querySelector('.product-price-calc');
const currency =document.querySelector('.woocommerce-Price-currencySymbol').innerHTML


totalPrice.innerHTML = currency+""+Number(qty.value) * Number(price.innerHTML);
qty.onchange = function () {
  totalPrice.innerHTML = currency+""+Number(this.value) * Number(price.innerHTML);
}