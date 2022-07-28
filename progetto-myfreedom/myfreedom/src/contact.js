import React, { Component } from "react";
import MyMap from './images/duomo-milano.jpg';
import Address from './icons/home_black_24dp.svg';
import Tel from './icons/call_black_24dp.svg';
import Wapp from './icons/whatsapp_black_24dp.svg';
import Email from './icons/email_black_24dp.svg';
 
class Contact extends Component {
  render() {
    return (
      <div>
        <section id="contact">
            
            <h2>CONTATTI</h2>
            
            <h3>l'appartamento Freedom si trova qui</h3>
            
            <p className="textCenter">Clicca sulla mappa per vedere la posizione</p>
            
            <div id="center">
            
            <a href="https://www.google.pl/maps/place/Duomo+di+Milano/@45.4641013,9.1897324,17z/data=!3m1!4b1!4m5!3m4!1s0x4786c6aec34636a1:0xab7f4e27101a2e13!8m2!3d45.4640976!4d9.1919265?hl=it"
            ><img className="map" src={MyMap} alt="mappa per raggiungere l'appartamento" target="_blank" rel="noopener noreferrer"></img></a>
            <p className="figcaption">Coordinate GPS:  45.464210, 9.191905</p>
            
            </div>
            
            <div className="descriptionBlock">
            
            <p><img className="icons" src={Address} alt="icona per indirizzo"></img> - Via Roma 100, Milano</p>
            <p><img className="icons" src={Tel} alt="icona telefono"></img> - +48 784 025 883</p>
            <p><img className="icons" src={Wapp} alt="icona di whatsapp"></img> - +48 574 691 064</p>
            <p><img className="icons" src={Email} alt="icona per l'email"></img> - max.dev@europe.com</p>
            
            </div>
            
            <div className="button">
            <a className="email" href="mailto:max.dev@europe.com">Mandami una email</a>
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
 
export default Contact;