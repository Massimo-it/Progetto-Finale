/* change the background of the header */

document.addEventListener('scroll', function() {
	let coordHeader = document.getElementById("detect").getBoundingClientRect();
	if (window.innerHeight < 560) {
		if  (coordHeader.top < 0) {
		document.querySelector("header").style.backgroundColor = "white"; 
		} else {
			document.querySelector("header").style.backgroundColor = "transparent";
		}
	} else {
		document.querySelector("header").style.backgroundColor = "white";
	}
});