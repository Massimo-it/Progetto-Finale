<?php

require_once '../include/conn.php';

if ($_POST) {
  require 'classutenti.php';
  $userManagement = new UserManagement($PDO);
  $userManagement->newUser($_POST['uname'], $_POST['psw'], $_POST['psw2']);
}
?>

<!DOCTYPE html>
<html lang="it-it">
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Gestione prenotazioni - nuovo utente</title>

<style type="text/css">
  body {
    text-align: center;
  }
  .list-btn {
    width: 200px;
    height: 50px;
    background-color: blue;
    color: white;
    border-color: yellow;
    margin: 10px;
    cursor: pointer;
  }
</style>
</head>

<body>

<div class="container">
  
  <h1>Gestione Immobili</h1>
  <br>
  <h2>Registrazione nuovo utente</h2>
  <br>
  
  <div>
    <div>
  
      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
      
        <label for="uname"><b>Username (da 3 a 20 caratteri alfanumerici senza spazi)</b></label>
        <input type="text" name="uname">
        <br>
        <label for="psw"><b>Password (da 3 a 20 caratteri - [a-z, A-Z, 0-9, +=!@#$%)</b></label>
        <input type="password" name="psw">
        <br>
        <label for="psw2"><b>Conferma della Password</b></label>
        <input type="password" name="psw2">
        <br> 
        <button class="list-btn" type="submit">Conferma registrazione</button>
      
      </form>
      
      <form action="gestioneutenti.php" method="get"> 
        <input type="submit" class="list-btn" value="Ritorna alla gestione utenti" name="comeBack">
      </form>
    
    </div> 
  </div>
  
</div>
  

</body>
</html>