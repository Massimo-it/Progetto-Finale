/* menu */

const hamburger = document.getElementById("hamburger");
const menu = document.getElementById("menu");

hamburger.addEventListener('click', event=> {
  if (menu.className == "menu-hide") {
	  hamburger.innerHTML = "CHIUDI";
	  hamburger.style.backgroundColor = "#F2CC96";
	  menu.className = "menu-show";
	  closeRoom();
	  } else {
	  closeMenu();
	}
})

const positions = document.getElementsByClassName("menu-line");

for (let i = 0; i < positions.length; i++) {
	positions[i].addEventListener('click', closeMenu);
}

function closeMenu() {
  hamburger.innerHTML = "MENU";
  hamburger.style.backgroundColor = "white";
  menu.className = "menu-hide";
}

/* menu for rooms */

const cellRooms = document.getElementById("cell-rooms");
const roomsMenu = document.getElementById("rooms-menu");

cellRooms.addEventListener('click', event=> {
  if (roomsMenu.className == "menu-hide") {
	  cellRooms.innerHTML = "CHIUDI";
	  cellRooms.style.backgroundColor = "#F2CC96";
	  roomsMenu.className = "menu-show";
	  closeMenu();
	  } else {
	  closeRoom();
	}
})

const titleRoom = document.getElementsByClassName("title-room");

for (let i = 0; i < titleRoom.length; i++) {
	titleRoom[i].addEventListener('click', closeRoom);
}

function closeRoom() {
  cellRooms.innerHTML = "CAMERE";
  cellRooms.style.backgroundColor = "white";
  roomsMenu.className = "menu-hide";
}