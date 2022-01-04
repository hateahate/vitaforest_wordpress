const myAccOfferBtns = document.querySelectorAll('.b2bking_myaccount_individual_offer_top');
[...myAccOfferBtns].forEach(btn => btn.onclick = function () {
  btn.nextElementSibling.classList.toggle('shown-offer_active');
});
let blocks = document.querySelectorAll('.shown-offer');

blocks[0].classList.add('shown-offer_active');
const myAccOfferBtnsDesk = document.querySelectorAll('.offer-button');
myAccOfferBtnsDesk[0].classList.add('offer-button_active');
[...myAccOfferBtnsDesk].forEach(btn => btn.onclick = function () {
doSmth(btn)
});

function doSmth(btn){
	  for (var i = 0; i < blocks.length; i++) {
    if (blocks[i].firstElementChild.innerHTML.replace(/\s+/g, '') == btn.innerHTML.replace(/\s+/g, '')) {
      blocks[i].classList.toggle('shown-offer_active');
		for(let d = 0; d<myAccOfferBtnsDesk.length; d++){
			myAccOfferBtnsDesk[d].classList.remove('offer-button_active')
		}
		btn.classList.add('offer-button_active')
    } else {
      blocks[i].classList.remove('shown-offer_active');
    }
  }
}

