<?php

require_once '../include/conn.php';
require 'classutenti.php';

$userManagement = new UserManagement($PDO);

/* change of the password */
if ($_POST) {
  
  if (isset($_POST['changePsw'])) {
    $_POST['user'] = $_GET['modify'];
    $userManagement->changePassword($_POST['user'], $_POST['psw'], $_POST['psw2']);
  } else {
    header('location: cambioutente.php');
  }
}
?>

<!DOCTYPE html>
<html lang="it-it">
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Gestione prenotazioni - modifica utente</title>
    <style type="text/css">
      body {
        text-align: center;
      }
      .list-btn {
        width: 300px;
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
    <h2>Modifica utente <?php echo $_GET['name']; ?></h2>
    <br>
      
    <div>
    
      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">

        <label for="psw"><b>Nuova Password (da 3 a 20 caratteri - [a-z, A-Z, 0-9, +=!@#$%)</b></label>
        <input type="password" name="psw">
        
        <label for="psw2"><b>Conferma della Nuova Password</b></label>
        <input type="password" name="psw2">
            
        <input class="list-btn" type="submit" name="changePsw" value="Conferma Cambio Password">

      
      </form>
      
      <div>
        <form action="gestioneutenti.php" method="get"> 
          <input type="submit" class="list-btn" value="Ritorna all'elenco" name="comeBack">
        </form>
      </div>
    
    </div>
    
  </div>
    

  </body>
</html>