/* massimo.developer
progetto per alloggi in affitto breve e case vacanza */

/* slide show */

let slideIndex = 0;
    
const dots = document.getElementsByClassName("dot");
const slides = document.getElementsByClassName("my-slides");
const prevSlide = document.getElementById("prev");
const nextSlide = document.getElementById("next");

slides[0].style.display = "block";
    
    /* shows a slide every x seconds */
    
    showSlides();

    function showSlides() {
      for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) {slideIndex = 1}
      slides[slideIndex-1].style.display = "block";
      setTimeout(showSlides, 3000); // Change image every 2 seconds
    }



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
	if (slideIndex == 2) {
	  slideIndex = -1;
	}
	  slides[slideIndex+1].style.display = "block";
	  slideIndex +=1;   
});
    

/* event listener for prev button */
    
prevSlide.addEventListener('click', event => {
	moveSlide();
	if (slideIndex == 0) {
	  slideIndex = 3;
	}
	  slides[slideIndex-1].style.display = "block";
	  slideIndex -=1;   
});

/* the icons are inflating */
/*
	let counter = 0;

	document.addEventListener('scroll', function() {
      let coord = document.getElementById("coord-myfreedom");
      let bigger = coord.getBoundingClientRect();
      
	  if  (bigger.top < window.innerHeight) {
		if (counter == 0) {
			inflate();
			} else {
			  counter = 1;
		}

	  } else {
		counter = 0;
	  }
    });
	
	let id = null;
	
	function inflate() {
		counter = 1;
		const elem = document.getElementsByClassName("inflate");		
		let w = 100;
		  clearInterval(id);
		  id = setInterval(frame, 20);
		  function frame() {
			let i;
			for (i = 0; i < elem.length; i++) {
				if (w == 200) {
				  clearInterval(id);
				} else {
				  w++; 
				  elem[i].style.width = w + 'px';
				  elem[i].style.height = w + 'px';
				}
			}
		  }
	}
   */ 
 
let counterMyFreedom = 0;
let counterRikko = 0;
let counterFullMoon = 0;


document.addEventListener('scroll', function() {
  let coordMyFreedom = document.getElementById("coord-myfreedom");
  let coordRikko = document.getElementById("coord-rikko");
  let coordFullMoon = document.getElementById("coord-fullmoon");
  let biggerMyFreedom = coordMyFreedom.getBoundingClientRect();
  let biggerRikko = coordRikko.getBoundingClientRect();
  let biggerFullMoon = coordFullMoon.getBoundingClientRect();
  if  (biggerMyFreedom.top < window.innerHeight) {
	myFreedom();
	if (biggerRikko.top < window.innerHeight) {
		rikko();
		if (biggerFullMoon.top < window.innerHeight) {
			fullMoon();
		}
	}
  } else { 
	counterMyFreedom = 0;
	counterRikko = 0;
	counterFullMoon = 0;
  }
});

function myFreedom() {
	if (counterMyFreedom == 0) {
		counterMyFreedom = 1;
		let id = null;
		let w = 100;
		clearInterval(id);
		id = setInterval(increase, 20);
		  function increase() {
			if (w == 200) {
			  clearInterval(id);
			} else {
			  w++; 
			  document.getElementById("coord-myfreedom").style.width = w + 'px';
			  document.getElementById("coord-myfreedom").style.height = w + 'px';
			}
		  }
	} else {
	  counterMyFreedom = 1;
	}
}

function rikko() {
	if (counterRikko == 0) {
		counterRikko = 1;
		let id = null;
		let w = 100;
		clearInterval(id);
		id = setInterval(increase, 20);
		  function increase() {
			if (w == 200) {
			  clearInterval(id);
			} else {
			  w++; 
			  document.getElementById("coord-rikko").style.width = w + 'px';
			  document.getElementById("coord-rikko").style.height = w + 'px';
			}
		  }
	} else {
	  counterRikko = 1;
	}
}

function fullMoon() {
	if (counterFullMoon == 0) {
		counterFullMoon = 1;
		let id = null;
		let w = 100;
		clearInterval(id);
		id = setInterval(increase, 20);
		  function increase() {
			if (w == 200) {
			  clearInterval(id);
			} else {
			  w++; 
			  document.getElementById("coord-fullmoon").style.width = w + 'px';
			  document.getElementById("coord-fullmoon").style.height = w + 'px';
			}
		  }
	} else {
	  counterFullMoon = 1;
	}
}