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
		blogCount= document.querySelector('.blog-count'),
		shopCount = document.querySelector('.products-count');
	if(document.querySelector('.blog-results').children.length ===0){
		blogCount.innerHTML = "(0)";
	}else{
		blogCount.innerHTML =  "("+document.querySelector('.blog-results').children.length+")";
	}
	if(document.querySelector('.product-results').children.length ===0){
		shopCount.innerHTML =  "(0)";
	}else{
		shopCount.innerHTML =  "("+document.querySelector('.product-results').children.length+")";
	}
	if(document.querySelector('.wiki-results').children.length ===0){
		encCount.innerHTML =  "(0)";
	}else{
		encCount.innerHTML = "("+ document.querySelector('.wiki-results').children.length+")";
	}