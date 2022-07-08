/* project freedom apartament in Milan */

/* slider */
    
    const smallImg = document.getElementsByClassName("small-img");
    const bigImg = document.getElementsByClassName("slide");
    
    bigImg[0].style.display = "block";

    for (let i=0; i < smallImg.length; i++) {
      smallImg[i].addEventListener('click', event=> {
        for (let e=0; e < smallImg.length; e++) {
          bigImg[e].style.display = "none";
          }
      bigImg[i].style.display = "block";
    });
    }
    
    /* menu navigation */
    
    const hamburger = document.getElementById("hamburger");
    const menu = document.getElementById("menu");
    
    hamburger.addEventListener('click', event=> {
      if (menu.className == "menu-hide") {
        hamburger.innerHTML = '<img src="icons/close_black_24dp.svg" alt="simbolo della croce">';
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
      hamburger.innerHTML = '<img src="icons/hamburger_24dp.svg" alt="simbolo dell hamburger per il menu">';
      menu.className = "menu-hide";
    }
  