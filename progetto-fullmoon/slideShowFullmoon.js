let slideIndex = 0;
      
const dots = document.getElementsByClassName("dot");
const slides = document.getElementsByClassName("my-slides");
const prevSlide = document.getElementById("prev");
const nextSlide = document.getElementById("next");

slides[0].style.display = "block";
  
  /* shows a slide every x seconds */
 /*
showSlides();

function showSlides() {
	for (let i = 0; i < slides.length; i++) {
	  slides[i].style.display = "none";
	}
	slideIndex++;
	if (slideIndex > slides.length) {slideIndex = 1}
		slides[slideIndex-1].style.display = "block";
		setTimeout(showSlides, 5000); // Change image every 2 seconds
}

*/

/* event listener for dots */
  
for (let i=0; i < dots.length; i++) {
	dots[i].addEventListener('click', event=> {
		moveSlide();
		slides[i].style.display = "block";
		dots[i].style.backgroundColor = "#717171";
	});
}
  
/* funtion removes the slides */
  
function moveSlide() {
	for (let e=0; e < dots.length; e++) {
		slides[e].style.display = "none";
		dots[e].style.backgroundColor = "#bbb";
	}
}
  

/* event listener for next button */
  
nextSlide.addEventListener('click', event => {
	moveSlide();
	if (slideIndex == dots.length-1) {
		slideIndex = -1;
	}
	slides[slideIndex+1].style.display = "block";
	slideIndex +=1;   
});
  

/* event listener for prev button */
  
prevSlide.addEventListener('click', event => {
	moveSlide();
	if (slideIndex == 0) {
		slideIndex = dots.length;
	}
	slides[slideIndex-1].style.display = "block";
	slideIndex -=1;   
});