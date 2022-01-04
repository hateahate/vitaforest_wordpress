const allOrdersBtn = document.querySelector('.orders__navigation-btn_all');
const statusBtn  = document.querySelector('.title-status');
const ordersNavigation = document.querySelector('.orders__navigation');
const pendingOrdersBtn = document.querySelector('.orders__navigation-btn_onhold');
const completeOrdersBtn = document.querySelector('.orders__navigation-btn_complete');
const status = document.querySelectorAll('.order-item__status')
allOrdersBtn.onclick = function(){
	status.forEach( function(item, i, arr){
		item.parentNode.classList.remove('order-item_hide');
	});
	ordersNavigation.classList.remove('orders__navigation_active')
		
}
statusBtn.onclick = function(){
	ordersNavigation.classList.toggle('orders__navigation_active')
}

pendingOrdersBtn.onclick = function(){
	status.forEach( function(item, i, arr) {
 	if(item.innerHTML ==='On hold'){
		item.parentNode.classList.remove('order-item_hide');
		return
	} else{
		item.parentNode.classList.add('order-item_hide');
		return
	}
		
	});  
	ordersNavigation.classList.remove('orders__navigation_active')
}
completeOrdersBtn.onclick = function(){
status.forEach( function(item, i, arr) {
 	if(item.innerHTML ==='Completed'){
		item.parentNode.classList.remove('order-item_hide');
		return
	} else{
		item.parentNode.classList.add('order-item_hide');
		return
	}
	
	});  
	ordersNavigation.classList.remove('orders__navigation_active')
}


let allCount = document.querySelector('.all-count'),
    onholdCount = document.querySelector('.onhold-count'),
    completedCount = document.querySelector('.completed-count');
let all= 0; let hold = 0 ; let complete = 0;
console.log(status)
for(var i = 0; i < status.length; i++){
	all++
	console.log(all)
	if(status[i].innerHTML ==='Completed'){
		complete++
	}
	else if(status[i].innerHTML ==='On hold'){
		hold++
	}
}
allCount.innerHTML= "("+all+")";
onholdCount.innerHTML = "("+hold+")";
completedCount.innerHTML= "("+complete+")";