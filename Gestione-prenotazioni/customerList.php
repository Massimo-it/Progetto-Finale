<?php

require 'include/default.php';

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
  
  require 'include/coonProcedurale.php';
  
  $sql = "SELECT * FROM clienti ORDER BY nome ASC";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0) {
    while ($record = mysqli_fetch_assoc($result)) {
      $xx = $record['ID'];
      echo "<table class='center-text customer-table'>";
      echo "<tr><th class='customer-title'>ID</th><td>" . $record['ID'] . "</td></tr>";
      echo "<tr><th>NOME</th><td>" . $record['nome'] . "</td></tr>";
      echo "<tr><th>EMAIL</th><td>" . $record['email'] . "</td></tr>";
      echo "<tr><th>NOTE</th><td>" . $record['note'] . "</td></tr>";
      echo "<tr><th>MODIFICA</th><td class='link_modify'><a href='customerChange.php?modify={$xx}'> &#9989 </a></td></tr>";
      echo "<tr><th>ELIMINA</th><td class='link_cancel'><a href='customerCancel.php?delete={$xx}'> &#10060 </a></td></tr>";
      echo "</table><br>";
    }
  } else {
      echo "<h3 class='center-text'>non hai ancora CLIENTI in elenco.</h3>";
  }
    
  ?>
  
  </body>
</html>