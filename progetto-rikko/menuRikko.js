const hamburger = document.getElementById("hamburger");
const menu = document.getElementById("menu");

hamburger.addEventListener('click', event=> {
  if (menu.className == "menu-hide") {
	  hamburger.innerHTML = " &#10006 ";
	  menu.className = "menu-show";
	  } else {
	  closeMenu();
	}
})

const positions = document.getElementsByClassName("menu-line");

for (let i = 0; i < positions.length; i++) {
	positions[i].addEventListener('click', closeMenu);
}

function closeMenu() {
  hamburger.innerHTML = " &#8801 ";
  menu.className = "menu-hide";
}