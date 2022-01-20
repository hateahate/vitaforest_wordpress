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
const currency = document.querySelector('.woocommerce-Price-currencySymbol').innerHTML;
if (price != null) {
    const priceNum = Number(price.innerHTML);
    if (qty != null && priceNum != 0) {
        totalPrice.innerHTML = currency + "" + Number(qty.value) * Number(price.innerHTML);
        qty.onchange = function () {
            totalPrice.innerHTML = currency + "" + Number(this.value) * Number(price.innerHTML);
        }
    }
}

// Search filter
const searchPage = document.querySelector('.search-page');
if (searchPage != null) {
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
}

//Wiki tabs
const wikiMainContainer = document.querySelector('.single-wiki');
if (wikiMainContainer != null) {
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
}


// Shop
const shopMainContainer = document.querySelector('.shop-wrapper');
if (shopMainContainer != null) {
    const productsWrapper = document.querySelector('.products');
    const sortBtn = document.querySelector(".shop-menu__sort");
    const sortForm = document.querySelector(".shop__order-by")
    const sortSelect = document.querySelector(".orderby");
    const filterBtn = document.querySelector(".shop-menu__params");
    const filter = document.querySelector('.filter-container');
    const filterClose = document.querySelector('.filter-close');
    const filterCategoryBtns = document.querySelectorAll(".shop-filter__button");
    const filterTitle = document.querySelectorAll('.wpc-filter-header');
    const filterInput = document.querySelectorAll('.filter-search');
    let layout = document.querySelector('.products');
    let gridButton = document.querySelector('.btn-grid');
    let listButton = document.querySelector('.btn-list');

    let lyt = localStorage.getItem("setLayout");

    if (lyt == 2) {
        listButton.classList.add('btn-list_active');
        layout.classList.add('row-layout');
    }

    if (lyt == 1) {
        gridButton.classList.add('btn-grid_active');
        layout.classList.add('grid-layout');
    }

    gridButton.onclick = function () {
        listButton.classList.remove('btn-list_active');
        gridButton.classList.add('btn-grid_active');
        layout.classList.remove('row-layout');
        layout.classList.add('grid-layout');
        localStorage.setItem("setLayout", 1);
    }

    listButton.onclick = function () {
        listButton.classList.add('btn-list_active');
        gridButton.classList.remove('btn-grid_active');
        layout.classList.add('row-layout');
        layout.classList.remove('grid-layout');
        localStorage.setItem("setLayout", 2);
    }

    const qtyInput = document.querySelectorAll('.product-quantity');
    [...qtyInput].forEach(input => input.onchange = function () {
        this.parentElement.previousElementSibling.previousElementSibling.href = this.parentElement.previousElementSibling.previousElementSibling.href.replace(/&.+$/, '&quantity=' + this.value)
    });
    filterBtn.onclick = function () {
        filter.classList.toggle('filter-container_active');
    }

    filterClose.onclick = function () {
        filter.classList.toggle('filter-container_active');
    }

    sortBtn.onclick = function () {
        sortBtn.classList.toggle('sort-btn_active');
        sortForm.classList.toggle("shop__order-by_active");
        sortSelect.click();
    };

    [...filterTitle].forEach(btn => btn.onclick = function () {
        btn.parentElement.classList.toggle('wpc-filters-section_active');
    });

    [...filterCategoryBtns].forEach(btn => btn.onclick = function () {
        btn.nextElementSibling.classList.toggle('list_active');
    });


    let prdbtn = document.querySelectorAll('.product__btn');
    for (let i = 0; i < prdbtn.length; i++) {
        if (window.innerWidth < 1128) {
            if (prdbtn[i].innerHTML === 'Add to cart') {
                prdbtn[i].innerHTML = `<svg width="17" height="14" viewBox="0 0 17 14" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 1.05407C0.5 0.748065 0.755186 0.5 1.06997 0.5H3.1056C3.35093 0.5 3.56874 0.652607 3.64632 0.878857L4.1271 2.28094H15.93C16.1132 2.28094 16.2853 2.36655 16.3924 2.51103C16.4995 2.65552 16.5287 2.84125 16.4707 3.01022L14.6387 8.35302C14.5611 8.57927 14.3433 8.73188 14.098 8.73188H5.54834C5.18859 8.73188 4.89695 9.01538 4.89695 9.3651C4.89695 9.71482 5.18859 9.99832 5.54835 9.99832H13.6908C14.0056 9.99832 14.2608 10.2464 14.2608 10.5524C14.2608 10.8042 14.088 11.0168 13.8513 11.0842C14.0055 11.3261 14.0945 11.6114 14.0945 11.9169C14.0945 12.7912 13.3654 13.5 12.466 13.5C11.5666 13.5 10.8375 12.7912 10.8375 11.9169C10.8375 11.6207 10.9212 11.3435 11.0669 11.1065H8.13565C8.28129 11.3435 8.36498 11.6207 8.36498 11.9169C8.36498 12.7912 7.63588 13.5 6.73648 13.5C5.83709 13.5 5.10798 12.7912 5.10798 11.9169C5.10798 11.6161 5.19433 11.3348 5.34424 11.0953C4.45102 10.9968 3.757 10.2597 3.757 9.3651C3.757 8.65911 4.18919 8.05125 4.81041 7.77789L2.69478 1.60814H1.06997C0.755186 1.60814 0.5 1.36007 0.5 1.05407ZM5.95916 7.62374H13.6871L15.1392 3.38907H4.50708L5.95916 7.62374ZM7.22503 11.9169C7.22503 12.1792 7.0063 12.3919 6.73648 12.3919C6.46666 12.3919 6.24793 12.1792 6.24793 11.9169C6.24793 11.6547 6.46666 11.442 6.73648 11.442C7.0063 11.442 7.22503 11.6547 7.22503 11.9169ZM12.9546 11.9169C12.9546 12.1792 12.7359 12.3919 12.466 12.3919C12.1962 12.3919 11.9775 12.1792 11.9775 11.9169C11.9775 11.6547 12.1962 11.442 12.466 11.442C12.7359 11.442 12.9546 11.6547 12.9546 11.9169Z" fill="white"/>
</svg>`;
                prdbtn[i].style.width = '30px'
                prdbtn[i].style.height = '30px'
            }
        }
    }

    function submit(evt) {
        evt.preventDefault();
    }

    function filters(evt) {
        evt.preventDefault();
        let input = document.querySelector('#site-search');
        let inputValue = input.value.toUpperCase();
        let cards = document.querySelectorAll('.wpc-term-item');

        cards.forEach(
            function getMatch(info) {
                let heading = info.querySelector('a');
                let headingContent = heading.innerHTML.toUpperCase();

                if (headingContent.includes(inputValue)) {
                    info.classList.add('showx');
                    info.classList.remove('hidex');
                }
                else {
                    info.classList.add('hidex');
                    info.classList.remove('showx');
                }
            }
        )
    }

    function autoReset() {
        let input = document.querySelector('#site-search');
        let cards = document.querySelectorAll('.wpc-term-item');

        cards.forEach(
            function getMatch(info) {
                if (input.value == null, input.value == "") {
                    info.classList.remove('showx');
                    info.classList.remove('showx');
                }
                else {
                    return;
                }
            }
        )
    }

    let form = document.querySelector('#site-search');

    form.addEventListener('keyup', filters);

    form.addEventListener('submit', submit);
}


// Production page counter

let productCardSlidercounter = document.querySelector('.slider-counter');
if (productCardSlidercounter != null) {
    let plusx = productCardSlidercounter.nextSibling;
    let plusx = productCardSlidercounter.previousSibling;
}


// slider.prod.js???
let counter = document.querySelector('.countas');
if (counter != null) {
    let plusx = counter.nextElementSibling;
    let minusx = counter.previousElementSibling;
    let currentnum = counter.firstElementChild;

    plusx.onclick = function () {
        if (Number(currentnum.innerHTML) < 5) {
            currentnum.innerHTML = Number(currentnum.innerHTML) + 1
        }
        else { currentnum.innerHTML = Number(currentnum.innerHTML) - 4 }

    }
    minusx.onclick = function () {
        if (Number(currentnum.innerHTML) === 1) {

            currentnum.innerHTML = 5
        }
        else { currentnum.innerHTML = Number(currentnum.innerHTML) - 1 }
    }
}
