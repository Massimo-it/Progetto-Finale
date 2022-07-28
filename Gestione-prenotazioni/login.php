<?php
session_start();
require 'include/conn.php';
require 'gestione-utenti/classutenti.php';


if ($_POST != '') {
  if (isset($_POST['uname'])) {
    $userManagement = new UserManagement($PDO);
    $userManagement->login($_POST['uname'], $_POST['psw']);
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
    
    <title>Gestione prenotazioni - login</title>

  </head>
  <body>
    <div class="center-text">
      <h1 class="title-h1">GESTIONE PRENOTAZIONI</h1>
      <h2 class="title-h2">PROGETTO FULL MOON</h2>
      <h3 class="title-h3">digita la tua username e la tua password per accedere al pannello di controllo</h3>
    </div>
    
    <div class="login-form">
      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
      
        <label for="uname">username:</label>
        <br>
        <input type="text" name="uname">
        <br><br>
        <label for="psw">password:</label>
        <br>
        <input type="password" name="psw">
        <br><br>
            
        <button type="submit" class="light-btn">Accedi</button>
      
      </form>
      
      <a href="changePassword.php">Cambio Password</a>
    </div>
  
  
  </body>
</html>