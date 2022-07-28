<?php

require 'include/default.php';

if ($_POST != "") {
  if (isset($_POST['logout'])) {
    require 'include/logout.php';
  }
}
?>

<!DOCTYPE html>
<html lang="it-it">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="max.dev@europe.com">
    <link rel="stylesheet" type="text/css" href="style-prenotazioni.css">
    
    <title>Gestione prenotazioni - Pannello di Controllo</title>
    
  </head>
  <body>
    <header>
      <div class="center-text">
        <h1 class="title-h1">GESTIONE PRENOTAZIONI</h1>
        <h2 class="title-h2 light-blue">PANNELLO DI CONTROLLO</h2>
      </div>
      
      <div class="buttons">
        <form action='reservation.php' method='post'>
            <input type='submit' value='Nuova Prenotazione'name='newReservation' class="btn-header">
        </form>
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" value="Disconnessione" name="logout" class="btn-header">
        </form>
      </div>
    </header>
    <div class='space'></div>
    
    <main>
      <h3 class="title-h3 center-text">Gestione delle prenotazioni delle camere</h3>
      <section class="rooms">
        <div class="room1">
          <a href="room1.php">CAMERA 1</a>
        </div>
        <div class="room2">
          <a href="room2.php">CAMERA 2</a>
        </div>
        <div class="room3">
          <a href="room3.php">CAMERA 3</a>
        </div>
      </section>
        
      <section>
        <h3 class="title-h3 center-text">Gestione dell'anagrafica clienti</h3>
        <div class="customers">
          <div>
            <a href="customerlist.php">ELENCO CLIENTI</a>
          </div>
          <div>
            <a href="customeradd.php">NUOVO CLIENTE</a>
          </div>
        </div>
      </section>
    </main>
  
  </body>
</html>