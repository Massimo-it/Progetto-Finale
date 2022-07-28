import React, { Component } from "react";
import Clock from './icons/schedule_black_24dp.svg';
 
class Description extends Component {
  render() {
    return (
        <div>
        <section id="description">
            
            <h2>DESCRIZIONE</h2>
            
            <div className="descriptionBlock">
            <p className="boxText">Il nostro appartamento si trova in centro di Milano con tutti i servizi a portata di mano.</p>
            <p className="boxText">L'appartamento è dotato delle comodità necessarie per passare un soggiorno nella capitale della moda
            in modo piacevole e confortevole.</p>
            <p className="boxText">Ci teniamo che i nostri ospiti trovino un ambiente comodo e pulito. Ad ogni cambio di ospite facciamo il cambio
            di tutta la biancheria e disinfettiamo l'intero ambiente comprese le stoviglie in cucina.</p>
            
            </div>
            
            <div className="descriptionBlock">
            <h3>CHECK-IN/CHECK-OUT</h3>
            <div className="containerFlex">
                <p className="smallerAnte">Check-in</p>
                <img className="icons" src={Clock} alt="icona dell'orologio" height="50"></img>
                <p className="smallerPost">Gli ospiti sono pregati di arrivare dopo le ore 14:00</p>
            </div>
            <br></br>
            <div className="containerFlex">
                <p className="smallerAnte">Check-out</p>
                <img className="icons" src={Clock} alt="icona dell'orologio" height="50"></img>
                <p className="smallerPost">Gli ospiti sono pregati di lasciare libero l'appartamento prima delle ore 10:00</p>
            </div>
            
            <div className="descriptionBlock">
                <h3>PREZZI</h3>
                <p className="textCenter">xxx € - per notte</p>
            </div>
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
 
export default Description;