/*  images gallery */

const imgClicked = document.getElementsByClassName("img-grid");
const slides = document.getElementsByClassName("mySlides");
const prevGrid = document.getElementById("prev-grid");
const nextGrid = document.getElementById("next-grid");
const closeGallery = document.getElementById("close-gallery");

let countImg = 0;

for (let countImg=0; countImg < imgClicked.length; countImg++) {
	imgClicked[countImg].addEventListener('click', event=> {
		document.getElementById("gallery").style.display = "block";
		slides[countImg].style.display = "block";
		closeGallery.addEventListener('click', functionClose);
		prevGrid.addEventListener('click', event=> {
			slides[countImg].style.display = "none";
			countImg--;
			if (countImg < 0) {
				countImg = (imgClicked.length -1);
			}
			slides[countImg].style.display = "block";
		});
		nextGrid.addEventListener('click', event=> {
			slides[countImg].style.display = "none";
			countImg++;
			if (countImg > (imgClicked.length -1)) {
				countImg = 0;
			}
			slides[countImg].style.display = "block";
		});
	});
}

function functionClose() {
	location.reload();
}

