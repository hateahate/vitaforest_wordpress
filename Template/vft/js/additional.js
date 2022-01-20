// Auth page
let authElement = document.querySelector(".forgot-password");
if (authElement != null) {
    authElement.addEventListener('click', () => {
        document.querySelector('.reset-password').classList.add('reset-password_active');
    });
}


let authElement2 = document.querySelector(".close-reset-password");
if (authElement2 != null) {
    authElement2.addEventListener('click', () => {
        document.querySelector('.reset-password').classList.remove('reset-password_active');
    });
}

//Blog filter close
let blogFiltElem = document.querySelector('.blog-filters-shown');
let blogFiltElem2 = document.querySelector('.blog-filter-close');

if (blogFiltElem != null) {
    blogFiltElem.addEventListener('click', () => {
        document.querySelector('.blog-filter').classList.toggle('blog-filter_active');
    })
}

if (blogFiltElem2 != null) {
    blogFiltElem2.addEventListener('click', () => {
        document.querySelector('.blog-filter').classList.toggle('blog-filter_active');
    })
}

//Faq page
let kbTitle = document.querySelectorAll('.kb-section__subtitle');
[...kbTitle].forEach(btn => btn.onclick = function () {
    btn.nextElementSibling.classList.toggle('kb-section__description_active');
});

// My account
const myAccOfferBtns = document.querySelectorAll('.b2bking_myaccount_individual_offer_top');
if (myAccOfferBtns != null) {
    [...myAccOfferBtns].forEach(btn => btn.onclick = function () {
        btn.nextElementSibling.classList.toggle('shown-offer_active');
    });
    let blocks = document.querySelectorAll('.shown-offer');
    if (blocks[0] != undefined) {
        blocks[0].classList.add('shown-offer_active');
        const myAccOfferBtnsDesk = document.querySelectorAll('.offer-button');
        myAccOfferBtnsDesk[0].classList.add('offer-button_active');
        [...myAccOfferBtnsDesk].forEach(btn => btn.onclick = function () {
            doSmth(btn)
        });
    }
}

function doSmth(btn) {
    for (var i = 0; i < blocks.length; i++) {
        if (blocks[i].firstElementChild.innerHTML.replace(/\s+/g, '') == btn.innerHTML.replace(/\s+/g, '')) {
            blocks[i].classList.toggle('shown-offer_active');
            for (let d = 0; d < myAccOfferBtnsDesk.length; d++) {
                myAccOfferBtnsDesk[d].classList.remove('offer-button_active');
            }
            btn.classList.add('offer-button_active')
        } else {
            blocks[i].classList.remove('shown-offer_active');
        }
    }
}

// Order sort

const allOrdersBtn = document.querySelector('.orders__navigation-btn_all');
const statusBtn = document.querySelector('.title-status');
const ordersNavigation = document.querySelector('.orders__navigation');
const pendingOrdersBtn = document.querySelector('.orders__navigation-btn_onhold');
const completeOrdersBtn = document.querySelector('.orders__navigation-btn_complete');
const currentStatus = document.querySelectorAll('.order-item__status');
if (allOrdersBtn != null) {
    allOrdersBtn.onclick = function () {
        currentStatus.forEach(function (item, i, arr) {
            item.parentNode.classList.remove('order-item_hide');
        });
        ordersNavigation.classList.remove('orders__navigation_active')

    }
    statusBtn.onclick = function () {
        ordersNavigation.classList.toggle('orders__navigation_active')
    }

    pendingOrdersBtn.onclick = function () {
        currentStatus.forEach(function (item, i, arr) {
            if (item.innerHTML === 'On hold') {
                item.parentNode.classList.remove('order-item_hide');
                return
            } else {
                item.parentNode.classList.add('order-item_hide');
                return
            }

        });
        ordersNavigation.classList.remove('orders__navigation_active')
    }
    completeOrdersBtn.onclick = function () {
        currentStatus.forEach(function (item, i, arr) {
            if (item.innerHTML === 'Completed') {
                item.parentNode.classList.remove('order-item_hide');
                return
            } else {
                item.parentNode.classList.add('order-item_hide');
                return
            }

        });
        ordersNavigation.classList.remove('orders__navigation_active')
    }
}

let allCount = document.querySelector('.all-count'),
    onholdCount = document.querySelector('.onhold-count'),
    completedCount = document.querySelector('.completed-count');
if (allCount != null) {
    let all = 0; let hold = 0; let complete = 0;
    console.log(currentStatus)
    for (var i = 0; i < currentStatus.length; i++) {
        all++
        console.log(all)
        if (currentStatus[i].innerHTML === 'Completed') {
            complete++
        }
        else if (currentStatus[i].innerHTML === 'On hold') {
            hold++
        }
    }
    allCount.innerHTML = "(" + all + ")";
    onholdCount.innerHTML = "(" + hold + ")";
    completedCount.innerHTML = "(" + complete + ")";
}
// Total price calc

const qty = document.querySelector('.input-text');
const totalPrice = document.querySelector('.product__total-price');
const price = document.querySelector('.product-price-calc');
const currency = document.querySelector('.woocommerce-Price-currencySymbol').innerHTML
const priceNum = Number(price.innerHTML);
if (price != null && qty != null && priceNum != 0) {
    totalPrice.innerHTML = currency + "" + Number(qty.value) * Number(price.innerHTML);
    qty.onchange = function () {
        totalPrice.innerHTML = currency + "" + Number(this.value) * Number(price.innerHTML);
    }
}

// Search filter
const searchPage = document.querySelector('.search-page');
console.log('debug: ' + searchPage);
let prdbtn = document.querySelector(".search-navigation__btn_products");
let blogbtn = document.querySelector(".search-navigation__btn_blog");
let wikibtn = document.querySelector(".search-navigation__btn_wiki");

let prdwrapper = document.querySelector('.product-results');
let blogwrapper = document.querySelector('.blog-results');
let wikiwrapper = document.querySelector('.wiki-results');

prdbtn.classList.add('search-btn_active');

prdbtn.onclick = function () {
    prdwrapper.classList.remove('search-block_hide');
    prdwrapper.classList.add('search-block_active');
    prdbtn.classList.add('search-btn_active');
    wikibtn.classList.remove('search-btn_active');
    blogbtn.classList.remove('search-btn_active');
    wikiwrapper.classList.remove('search-block_active');
    blogwrapper.classList.add('search-block_hide');
    wikiwrapper.classList.add('search-block_hide');
    blogwrapper.classList.remove('search-block_active');
}
blogbtn.onclick = function () {
    blogbtn.classList.add('search-btn_active');
    prdbtn.classList.remove('search-btn_active');
    wikibtn.classList.remove('search-btn_active');
    blogwrapper.classList.remove('search-block_hide');
    blogwrapper.classList.add('search-block_active');
    prdwrapper.classList.remove('search-block_active');
    wikiwrapper.classList.remove('search-block_active');
    prdwrapper.classList.add('search-block_hide');
    wikiwrapper.classList.add('search-block_hide');
}

wikibtn.onclick = function () {
    wikibtn.classList.add('search-btn_active');
    prdbtn.classList.remove('search-btn_active');
    blogbtn.classList.remove('search-btn_active');
    wikiwrapper.classList.remove('search-block_hide');
    wikiwrapper.classList.add('search-block_active');
    prdwrapper.classList.remove('search-block_active');
    blogwrapper.classList.remove('search-block_active');
    prdwrapper.classList.add('search-block_hide');
    blogwrapper.classList.add('search-block_hide');

}


let encCount = document.querySelector('.wiki-count'),
    blogCount = document.querySelector('.blog-count'),
    shopCount = document.querySelector('.products-count');
if (document.querySelector('.blog-results').children.length === 0) {
    blogCount.innerHTML = "(0)";
} else {
    blogCount.innerHTML = "(" + document.querySelector('.blog-results').children.length + ")";
}
if (document.querySelector('.product-results').children.length === 0) {
    shopCount.innerHTML = "(0)";
} else {
    shopCount.innerHTML = "(" + document.querySelector('.product-results').children.length + ")";
}
if (document.querySelector('.wiki-results').children.length === 0) {
    encCount.innerHTML = "(0)";
} else {
    encCount.innerHTML = "(" + document.querySelector('.wiki-results').children.length + ")";
}
