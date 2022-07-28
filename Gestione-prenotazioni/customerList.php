<?php

require 'include/default.php';
require 'customerClass.php';

if ($_POST != "") {
  if (isset($_POST['logout'])) {
    require 'include/logout.php';
  }
  if (isset($_POST['control'])) {
    header('location: controlpanel.php');
  }
  if (isset($_POST['newCustomer'])) {
    header('location: customerAdd.php');
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
    
    <title>Gestione prenotazioni - Elenco clienti</title>
    
  </head>
  <body>
    <header>
      <div class="center-text">
        <h1 class="title-h1">GESTIONE PRENOTAZIONI</h1>
        <h2 class="title-h2 light-yellow">ELENCO CLIENTI</h2>
      </div>
      
      <div class="buttons">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" class="btn-header" value="Pannello di Controllo" name="control">
        </form>
        
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" class="btn-header" value="Nuovo Cliente" name="newCustomer">
        </form>
        
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" class="btn-header" value="Disconnessione" name="logout">
        </form>
      </div>
    </header>
    <div class='space'></div>
    
  <?php

    $url = "http://localhost/progetto-immobili/gestione-prenotazioni/customerList-api.php";
    $client = curl_init($url);
    curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
    $response = curl_exec($client);
    
    $result = json_decode($response, true);
    
    foreach($result as $key) {
      echo "<table class='center-text customer-table'>";
      echo "<tr><th class='customer-title'>ID</th><td>" . $key['ID'] . "</td></tr>";
      echo "<tr><th>NOME</th><td>" . $key['nome'] . "</td></tr>";
      echo "<tr><th>EMAIL</th><td>" . $key['email'] . "</td></tr>";
      echo "<tr><th>NOTE</th><td>" . $key['note'] . "</td></tr>";
      
      $xx = $key['ID'];
      
      echo "<tr><th>MODIFICA</th><td class='link_modify'><a href='customerChange.php?modify={$xx}'> &#9989 </a></td></tr>";
      echo "<tr><th>ELIMINA</th><td class='link_cancel'><a href='customerCancel.php?delete={$xx}'> &#10060 </a></td></tr>";
      echo "</table><br>";
    }
    
  ?>
  
  </body>
</html>