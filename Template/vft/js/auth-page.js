document.querySelector(".forgot-password").onclick = function(){
	document.querySelector('.reset-password').classList.add('reset-password_active');
}
document.querySelector(".close-reset-password").onclick = function(){
	document.querySelector('.reset-password').classList.remove('reset-password_active');
}
