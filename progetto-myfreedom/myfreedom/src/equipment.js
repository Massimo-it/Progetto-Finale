import React, { Component } from "react";
import Bad from './icons/bed_black_24dp.svg';
import Bathtub from './icons/bathtub_black_24dp.svg';
import Wifi from './icons/wifi_black_24dp.svg';
import Tv from './icons/tv_black_24dp.svg';
import Restaurant from './icons/restaurant_black_24dp.svg';
import Thermostat from './icons/thermostat_black_24dp.svg';
import Acunit from './icons/ac_unit_black_24dp.svg';
import Accessible from './icons/accessible_black_24dp.svg';
import Pets from './icons/pets_black_24dp.svg';

class Equipment extends Component {
  render() {
    return (
      <div>
        <section id="equipment">
            
            <h2>DOTAZIONI</h2>

            <div className="descriptionBlock">
            
            <p><img className="icons" src={Bad} alt="icona del letto"></img>- Un letto matrimoniale</p>
            <p><img className="icons" src={Bathtub} alt="icona della vasca da bagno"></img> - Vasca da bagno con doccia</p>
            <p><img className="icons" src={Wifi} alt="icona del wifi"></img> - Wifi gratuito</p>
            <p><img className="icons" src={Tv} alt="icona della TV"></img> - TV 50 pollici</p>
            <p><img className="icons" src={Restaurant} alt="icona delle stoviglie"></img> - set completo di stoviglie</p>
            <p><img className="icons" src={Thermostat} alt="icona del termometro"></img> - riscaldamento autonomo</p>
            <p><img className="icons" src={Acunit} alt="icona per l'aria condizionata"></img> - aria condizionata</p>
            <p><img className="icons" src={Accessible} alt="icona per disabilia"></img> - accesso facilitato</p>
            <p><img className="icons" src={Pets} alt="icona per animali domestici"></img> - animali domestici accettati</p>
            
            </div>
            
        </section>
        
        <footer>
            <p className="textFooter">nota sulla privacy: questo sito utilizza solo cookie tecnici</p>
            <p className="textFooter">Le immagini del sito sono tratte da pixabay.com</p>
        </footer>

      </div>
        );
  }
}
 
export default Equipment;