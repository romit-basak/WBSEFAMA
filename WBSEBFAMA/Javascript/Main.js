function splash() {
	setTimeout(() => { document.getElementById("Splash").style.opacity = "0"; }, 2000);
	setTimeout(() => { document.getElementById("Splash").style.width = "0"; }, 2500);
}
var navigationDisplayed = false;
function hamburger(btn) {
	btn.classList.toggle("change");
	if (navigationDisplayed) {
		document.getElementById("Navigation").style.width = "0";
		document.body.style.backgroundColor = "rgb(255, 255, 255)";
		document.getElementById("HomeImg").style.opacity = "1";
		navigationDisplayed = false;
	}
	else {
		document.getElementById("Navigation").style.width = "60%";
		document.body.style.backgroundColor = "rgba(0, 0, 0, 0.8)";
		document.getElementById("HomeImg").style.opacity = "0.2";
		navigationDisplayed = true;
	}
}