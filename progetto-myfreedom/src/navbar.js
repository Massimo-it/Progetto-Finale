import React, { useState } from "react";
import {
    BrowserRouter,
    Routes,
    Route,
    Link
  } from "react-router-dom";
import Home from "./home";
import Description from "./description";
import Equipment from "./equipment";
import Contact from "./contact";

function Navbar() {
    const [navbarOpen, setNavbarOpen] = useState(false);
    const handleToggle = () => {
        setNavbarOpen(!navbarOpen);
      }
      const closeMenu = () => {
        setNavbarOpen(false);
      }
    return (
        <BrowserRouter>
          <header className="headerC">
            <div className="headerContainer">
              <Link to="/" onClick={() => closeMenu()} className="logo"><img className="logoImg" src={process.env.PUBLIC_URL + "/images/logo.png"} alt="logo"/> My Freedom</Link>
            </div>
          </header>
          <nav className="navBar">
              <button id="openClose" onClick={handleToggle}>{navbarOpen ? <img src={process.env.PUBLIC_URL + "/icons/close_black_24dp.svg"} alt="icona della croce"/> : <img src={process.env.PUBLIC_URL + "/icons/hamburger_24dp.svg"} alt="icona hamburger"/> } </button>
              <ul className={`menuNav ${navbarOpen ? " showMenu" : ""}`}>
                <li><Link to="description" className="position" onClick={() => closeMenu()}>Descrizione</Link></li>
                <li><Link to="equipment" className="position" onClick={() => closeMenu()}>Dotazioni</Link></li>
                <li><Link to="contact" className="position" onClick={() => closeMenu()}>Contatti</Link></li>
              </ul>
              <div>

                <Routes>
                  <Route exact path="/" element={<Home />} />
                  <Route path="description" element={<Description />} />
                  <Route path="equipment" element={<Equipment />} />
                  <Route path="contact" element={<Contact />} />
                </Routes>

              </div>
          </nav>     
        </BrowserRouter>
      );
}
export default Navbar;