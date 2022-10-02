import React, { Component } from "react";

function Equipment() {
  return (
    <div>
      <section id="equipment">
          
          <h2>DOTAZIONI</h2>

          <div className="descriptionBlock">
          
          <p><img className="icons" src={process.env.PUBLIC_URL + "/icons/bed_black_24dp.svg"} alt="icona del letto"></img>- Un letto matrimoniale</p>
          <p><img className="icons" src={process.env.PUBLIC_URL + "/icons/bathtub_black_24dp.svg"} alt="icona della vasca da bagno"></img> - Vasca da bagno con doccia</p>
          <p><img className="icons" src={process.env.PUBLIC_URL + "/icons/wifi_black_24dp.svg"} alt="icona del wifi"></img> - Wifi gratuito</p>
          <p><img className="icons" src={process.env.PUBLIC_URL + "/icons/tv_black_24dp.svg"} alt="icona della TV"></img> - TV 50 pollici</p>
          <p><img className="icons" src={process.env.PUBLIC_URL + "/icons/restaurant_black_24dp.svg"} alt="icona delle stoviglie"></img> - set completo di stoviglie</p>
          <p><img className="icons" src={process.env.PUBLIC_URL + "/icons/thermostat_black_24dp.svg"} alt="icona del termometro"></img> - riscaldamento autonomo</p>
          <p><img className="icons" src={process.env.PUBLIC_URL + "/icons/ac_unit_black_24dp.svg"} alt="icona per l'aria condizionata"></img> - aria condizionata</p>
          <p><img className="icons" src={process.env.PUBLIC_URL + "/icons/accessible_black_24dp.svg"} alt="icona per disabilita"></img> - accesso facilitato</p>
          <p><img className="icons" src={process.env.PUBLIC_URL + "/icons/pets_black_24dp.svg"} alt="icona per animali domestici"></img> - animali domestici accettati</p>
          
          </div>
          
      </section>
      
      <footer>
          <p className="textFooter">nota sulla privacy: questo sito utilizza solo cookie tecnici</p>
          <p className="textFooter">Le immagini del sito sono tratte da pixabay.com</p>
      </footer>

    </div>
  );
}
 
export default Equipment;