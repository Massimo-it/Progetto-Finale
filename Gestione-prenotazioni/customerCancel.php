<?php

require 'include/default.php';

if (isset($_GET['customers'])) {
    header('location: customerList.php');
}

if ($_POST != "") {
  if (isset($_POST['logout'])) {
    require 'include/logout.php';
  }
  if (isset($_POST['control'])) {
    header('location: controlpanel.php');
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
    
    <title>Gestione prenotazioni - Cancella cliente</title>
    
  </head>
  <body>
    <header>
      <div class="center-text">
        <h1 class="title-h1">GESTIONE PRENOTAZIONI</h1>
        <h2 class="title-h2 light-red">CLIENTE DA CANCELLARE</h2>
      </div>
      
      <div class="buttons">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="get" class="logout"> 
          <input type="submit" class="btn-header" value="Elenco Clienti" name="customers">
        </form>
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" value="Pannello di Controllo" name="control" class="btn-header">
        </form>        
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" value="Disconnessione" name="logout" class="btn-header">
        </form>
      </div>
    </header>
    <div class='space'></div>
    
    <section>
      <h3 class="center-text">Confermi che vuoi eliminare dal data base questo cliente?</h3>
      
      <table class="cancel-table">
        
        <?php
        
        require 'include/coonProcedurale.php';
        if (isset($_GET['delete'])) {
          $idCancel = $_GET['delete'];
          $sql = "SELECT * FROM customers WHERE ID = ?";
            
          $record = mysqli_prepare($conn,$sql);
          mysqli_stmt_bind_param($record,'s',$idCancel);
          mysqli_stmt_execute($record);
          $result = mysqli_stmt_get_result($record);
          
          while ($row = mysqli_fetch_assoc($result)) {
            $customerName = $row['customer_name'];
            $customerEmail = $row['customer_email'];
            $customerNote = $row['customer_text'];
            echo "<tr><th>ID</th><td id='idCancel'>" . $row['ID'] . "</td></tr>";
            echo "<tr><th>NOME</th><td id='nameCancel'>" . $customerName . "</td></tr>";
            echo "<tr><th>EMAIL</th><td>" . $customerEmail . "</td></tr>";
            echo "<tr><th>NOTE</th><td>" . $customerNote . "</td></tr>";
          }
          } else {
          header('location: customerList.php');
        }
        
        ?> 
      </table>
      
      
      <button onclick="sendJSON()" type="submit" class="light-btn" value="CONFERMA CANCELLAZIONE" name="cancel">CONFERMA</button>
      
    </section>
    
    <!-- For printing result from server -->
    <p class="result" style="
      text-align: center;
      color: red;
      padding: 10px;
      margin: 10px;
      font-style: bold;
      font-size: 25px;"></p>
    
    <script>
    function sendJSON(){
              
      let result = document.querySelector('.result');
      let idCancel = document.querySelector('#idCancel');
      let nameCancel = document.querySelector('#nameCancel');
        
      // Creating a XHR object
      let xhr = new XMLHttpRequest();
      let url = "./my-api/customerCancel-api.php";
 
      // open a connection
      xhr.open("POST", url, true);

      // Set the request header i.e. which type of content you are sending
      xhr.setRequestHeader("Content-Type", "application/json");

      // Create a state change callback
      xhr.onreadystatechange = function () {

        // Print received data from server
        result.innerHTML = this.responseText;
      };

      // Converting JSON data to string
      var data = JSON.stringify({ "idCancel": idCancel.textContent, "nameCancel": nameCancel.textContent });
      
      // Sending data with the request
      xhr.send(data);
    }
    </script>
    
  </body>
</html>