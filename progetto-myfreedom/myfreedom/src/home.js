import React, { Component } from "react";
import Facciata from './images/big-facciata.jpg';
import Soggiorno from './images/big-soggiorno.jpg';
import Cucina from './images/big-cucina.jpg';
import Bagno from './images/big-bagno.jpg';
import Camera from './images/big-cameraletto.jpg';




const Home = () => {
  return (
    <div>
      <section className="homeSection">
        <div className="each-img">
          <div className="image-container">
            <img src={Facciata} />
            <h1>La facciata</h1>
          </div>
          
        </div>
        <div className="each-img">
          <div className="image-container">
            <img src={Soggiorno} />
            <h1>Il Soggiorno</h1>
          </div>
        </div>

        <div className="each-img">
          <div className="image-container">
            <img src={Cucina} />
            <h1>La Cucina</h1>
          </div>  
        </div>

        <div className="each-img">
          <div className="image-container">
            <img src={Bagno} />
            <h1>Il Bagno</h1>
          </div>  
        </div>

        <div className="each-img">
          <div className="image-container">
            <img src={Camera} />
            <h1>La Camera da Letto</h1>
          </div>  
        </div>

      </section>

      <footer>
        <p className="textFooter">nota sulla privacy: questo sito utilizza solo cookie tecnici</p>
        <p className="textFooter">Le immagini del sito sono tratte da pixabay.com</p>
      </footer>
    </div>
  )
}
export default Home;
