import React, { useState } from "react";
import {
    Route,
    NavLink,
    HashRouter
  } from "react-router-dom";
import Description from "./description";
import Equipment from "./equipment";
import Contact from "./contact";
import Home from "./home";

function Navbar() {
    const [navbarOpen, setNavbarOpen] = useState(false);
    const handleToggle = () => {
        setNavbarOpen(!navbarOpen);
      }
      const closeMenu = () => {
        setNavbarOpen(false);
      }
    return (
        <HashRouter>
          <header className="headerC">
            <div className="headerContainer">
              <NavLink to="/" onClick={() => closeMenu()} className="logo"><img className="logoImg" src={process.env.PUBLIC_URL + "/images/logo.png"} alt="logo"/> My Freedom</NavLink>
            </div>
          </header>
          <nav className="navBar">
              <button id="openClose" onClick={handleToggle}>{navbarOpen ? <img src={process.env.PUBLIC_URL + "/icons/close_black_24dp.svg"} alt="icona della croce"/> : <img src={process.env.PUBLIC_URL + "/icons/hamburger_24dp.svg"} alt="icona hamburger"/> } </button>
              <ul className={`menuNav ${navbarOpen ? " showMenu" : ""}`}>
                <li><NavLink to="/description" className="position" onClick={() => closeMenu()}>Descrizione</NavLink></li>
                <li><NavLink to="/equipment" className="position" onClick={() => closeMenu()}>Dotazioni</NavLink></li>
                <li><NavLink to="/contact" className="position" onClick={() => closeMenu()}>Contatti</NavLink></li>
              </ul>
              <div>
                <Route path="/description" component={Description} />
                <Route path="/equipment" component={Equipment} />
                <Route path="/contact" component={Contact} />
                <Route exact path="/" component={Home} />
              </div>
          </nav>     
        </HashRouter>
      );
}
export default Navbar;