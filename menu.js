/* massimo.developer
progetto per alloggi in affitto breve e case vacanza */
    

/* menu navigation */
    
const hamburger = document.getElementById("hamburger");
const menu = document.getElementById("menu");

hamburger.addEventListener('click', event=> {
  if (menu.className == "menu-hide") {
	hamburger.style.color = "#ff000b";
	menu.className = "menu-show";
  } else {
	closeMenu();
  }
})

const positions = document.getElementsByClassName("position");

for (let i = 0; i < positions.length; i++) {
positions[i].addEventListener('click', closeMenu);
}

function closeMenu() {
  hamburger.style.color = "#293241";
  menu.className = "menu-hide";
}
    
	
