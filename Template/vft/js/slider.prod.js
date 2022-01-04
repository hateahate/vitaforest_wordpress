let counter =  document.querySelector('.countas');
let plusx = counter.nextElementSibling
let minusx = counter.previousElementSibling
let currentnum = counter.firstElementChild

plusx.onclick = function(){
	if( Number(currentnum.innerHTML)<5){
	currentnum.innerHTML  = Number(currentnum.innerHTML)+1}
	else {currentnum.innerHTML  = Number(currentnum.innerHTML)-4}
	
}
minusx.onclick = function(){
	if( Number(currentnum.innerHTML)===1){
	
	currentnum.innerHTML  = 5}
	else {currentnum.innerHTML  = Number(currentnum.innerHTML)-1}
}