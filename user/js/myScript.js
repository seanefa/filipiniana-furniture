var register = document.getElementById("_btnRegister");
var policy = document.getElementById("_cbxPolicy");

register.disabled = true;

policy.addEventListener('click', function(event){
	register.disabled = !register.disabled;
});

var message = document.getElementById("_lblAccountMsg");
var password = document.getElementById("input-password");

password.addEventListener("focus", function(event){
	password.setAttribute("placeholder", "Make sure to pick a strong password");
});

password.addEventListener("focusout", function(event){
	password.setAttribute("placeholder", "Password");
});

function productImgError(image) {
	image.onerror = "";
	image.src = "";
	return true;
}

function promoImgError(image) {
	image.onerror = "";
	image.src = "";
	return true;
}