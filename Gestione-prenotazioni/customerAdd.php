<?php

require 'include/default.php';

if ($_POST != "") {
  if (isset($_POST['logout'])) {
    require 'include/logout.php';
  }
  if (isset($_POST['control'])) {
    header('location: controlpanel.php');
  }
  if (isset($_POST['customer'])) {
    header('location: customerList.php');
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
  
    <section class="section-new-customer">
    
      <div class="box-form">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" class="form-style">
          <label for="name" class="label-customer">Nome del Cliente</label>
          <input type="text" name="name" required>
          <br>
          <label for="email" class="label-customer">Indirizzo email del Cliente</label>
          <input type="email" name="email" required>
          <br>
          <label for="note" class="label-customer">Note Aggiuntive</label>
          <input type="text" name="note" required>
          <br> <br><br> 
          <button type="submit" class="light-btn">Conferma inserimento</button>
        </form>
      </div>
    
    </section>
    
    <?php
    if ($_POST != "") {
      if (isset($_POST['name'])) {

        require 'include/coonProcedurale.php';
        
        $cleanName = trim($_POST['name']);
        $cleanEmail = trim($_POST['email']);
        $cleanNote = trim($_POST['note']);
        $cleanName = htmlspecialchars($cleanName);
        $cleanEmail = filter_var(filter_var($cleanEmail, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        $cleanNote = htmlspecialchars($cleanNote);

        $sql = "SELECT * FROM clienti WHERE nome = ?";
        $record = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($record,'s',$cleanName);
        mysqli_stmt_execute($record);
        $result = mysqli_stmt_get_result($record);
        // check if the username is not already present into the DB
        if (mysqli_num_rows($result) > 0) {
          echo "<script>alert('Un cliente con questo nome e già presente! Ricontrolla l\'elenco clienti oppure scegli un altro nome.');</script>";
          return false;
          // check if user name has been provided
          } elseif (mb_strlen($cleanName) == 0 ) {
            echo "<script>alert('Nome non inserito!');</script>";
            return false;
            // check of the length of username and note
          } elseif (!(mb_strlen($cleanName) >= 3 && mb_strlen($cleanName) <= 50)) {
            echo "<script>alert('Nome troppo lungo o troppo corto -min 3, max 50 caratteri-');</script>";
            return false;
          } elseif (!(mb_strlen($cleanEmail) <= 50)) {
            echo "<script>alert('Indirizzo email troppo lungo, max 50 caratteri');</script>";
            return false;
          } elseif (!(mb_strlen($cleanNote) >= 1 && mb_strlen($cleanNote) <= 255)) {
            echo "<script>alert('Le note possono essere al massimo 255 caratteri.');</script>";
            return false;
          } else {
            // now we can launch the query
              $sql = "INSERT INTO clienti (nome, email, note) VALUES (?,?,?)";
              if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "sss", $cleanName, $cleanEmail, $cleanNote);
                mysqli_stmt_execute($stmt);
              echo "<script>alert('Registrazione effettuata con successo.');</script>";
            }
            mysqli_close($conn);
            return true;
          }  
      }
    }
    ?>

  </body>
  
</html>
