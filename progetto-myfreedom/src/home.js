import React from "react";

const Home = () => {
  return (
    <div>
      <section className="homeSection">
        <div className="each-img">
          <div className="image-container">
            <img src={process.env.PUBLIC_URL + "/images/big-facciata.jpg"} alt="facciata"/>
            <h1>La facciata</h1>
          </div>
          
        </div>
        <div className="each-img">
          <div className="image-container">
            <img src={process.env.PUBLIC_URL + "/images/big-soggiorno.jpg"} alt="soggiorno"/>
            <h1>Il Soggiorno</h1>
          </div>
        </div>

        <div className="each-img">
          <div className="image-container">
            <img src={process.env.PUBLIC_URL + "/images/big-cucina.jpg"} alt="cucina"/>
            <h1>La Cucina</h1>
          </div>  
        </div>

        <div className="each-img">
          <div className="image-container">
            <img src={process.env.PUBLIC_URL + "/images/big-bagno.jpg"} alt="bagno"/>
            <h1>Il Bagno</h1>
          </div>  
        </div>

        <div className="each-img">
          <div className="image-container">
            <img src={process.env.PUBLIC_URL + "/images/big-cameraletto.jpg"} alt="camera da letto"/>
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
