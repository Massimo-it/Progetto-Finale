/*  images gallery */

const imgClicked = document.getElementsByClassName("img-grid");
const slides = document.getElementsByClassName("mySlides");
const prevGrid = document.getElementById("prev-grid");
const nextGrid = document.getElementById("next-grid");

let countImg = 0;

for (let i=0; i < imgClicked.length; i++) {
	imgClicked[i].addEventListener('click', event=> {
		document.getElementById("gallery").style.display = "block";
		slides[i].style.display = "block";
		countImg = i;
		prevGrid.addEventListener('click', event=> {
			slides[countImg].style.display = "none";
			countImg -= 1;
			if (countImg < 0) {
				countImg = (imgClicked.length -1);
			}
			slides[countImg].style.display = "block";
		});
		nextGrid.addEventListener('click', event=> {
			slides[countImg].style.display = "none";
			countImg += 1;
			if (countImg > (imgClicked.length -1)) {
				countImg = 0;
			}
			slides[countImg].style.display = "block";
		});
	});
}



const closeGallery = document.getElementById("close-gallery");

closeGallery.addEventListener('click', event=> {
	location.reload();
});

