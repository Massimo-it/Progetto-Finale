<?php

require 'include/default.php';

if ($_POST != "") {
  if (isset($_POST['logout'])) {
    require 'include/logout.php';
  }
  if (isset($_POST['control'])) {
    header('location: controlpanel');
  }
  if (isset($_POST['customer'])) {
    header('location: customerlist');
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
    
    <title>Gestione prenotazioni - Registrazione clienti</title>
    
  </head>
  <body>
    <header>
      <div class="center-text">
        <h1 class="title-h1">GESTIONE PRENOTAZIONI</h1>
        <h2 class="title-h2 light-yellow">REGISTRAZIONE CLIENTI</h2>
      </div>
      
      <div class="buttons">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" class="logout"> 
          <input type="submit" class="btn-header" value="Pannello di Controllo" name="control">
        </form>
        
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" class="logout"> 
          <input type="submit" class="btn-header" value="Elenco Clienti" name="customer">
        </form>
        
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" class="logout"> 
          <input type="submit" class="btn-header" value="Disconnessione" name="logout">
        </form>
      </div>
    </header>
    
    <div class='space'></div>
    
    <!-- For printing result from server -->
    <p class="result" style="
      text-align: center;
      color: red;
      padding: 10px;
      margin: 10px;
      font-style: bold;
      font-size: 25px;">
    </p>
  
    <section class="section-new-customer">
    
      <div class="box-form">
        <div class="form-style">
          <label for="name" class="label-customer">Nome del Cliente</label>
          <input type="text" name="nome" id="nome" required>
          <br>
          <label for="email" class="label-customer">Indirizzo email del Cliente</label>
          <input type="email" name="email" id="email" required>
          <br>
          <label for="note" class="label-customer">Note Aggiuntive</label>
          <input type="text" name="note" id="note" required>
          <br> <br><br> 
          <button onclick="sendJSON()" type="submit" class="light-btn">Conferma inserimento</button>
        </div>
      </div>
    
    </section>
    
    <script>
    function sendJSON(){
              
      let result = document.querySelector('.result');
      let nome = document.querySelector('#nome');
      let email = document.querySelector('#email');
      let note = document.querySelector('#note');
      
      // Creating a XHR object
      let xhr = new XMLHttpRequest();
      let url = "./my-api/customeradd-api.php";
 
      // open a connection
      xhr.open("POST", url, true);

      // Set the request header i.e. which type of content you are sending
      xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");

      // Create a state change callback
      xhr.onreadystatechange = function () {

        // Print received data from server
        result.innerHTML = this.responseText;
      };

      // Converting JSON data to string
      var data = JSON.stringify({ "nome": nome.value, "email": email.value, "note": note.value });
      
      // Sending data with the request
      xhr.send(data);
      
    }
    </script>

  </body>
  
</html>


