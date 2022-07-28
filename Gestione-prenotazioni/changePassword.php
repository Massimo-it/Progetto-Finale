<?php

if ($_POST != "") {
  if (isset($_POST['control'])) {
    header('location: login.php');
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
    
    <title>Gestione prenotazioni - Cambio Password</title>
    
  </head>
  <body>
  
    <header>
      <div class="center-text">
        <h1 class="title-h1">GESTIONE PRENOTAZIONI</h1>
        <h2 class="title-h2 light-blue">Cambio Password</h2>
      </div>
      
      <div class="buttons">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" value="Torna Indietro" name="control" class="btn-header">
        </form>
      </div>
    </header>
    <div class='space'></div>
    
    <div class="login-form">
      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
      
        <label for="uname">username:</label>
        <br>
        <input type="text" name="uname">
        <br><br>
        <label for="psw">vecchia password:</label>
        <br>
        <input type="password" name="psw">
        <br><br>
        <label for="newpsw">nuova password:</label>
        <br>
        <input type="password" name="newpsw">
        <br><br>
        <label for="newpsw1">ripeti la nuova password:</label>
        <br>
        <input type="password" name="newpsw1">
        <br><br>
        
        <input class="light-btn" type="submit" name="changePsw" value="Conferma">
        
        <?php
        if ($_POST != "") {
          if (isset($_POST['changePsw'])) {
            
            $user = $_POST['uname'];
            $psw = $_POST['psw'];
            $newPsw = $_POST['newpsw'];
            $newPsw1 = $_POST['newpsw1'];
            
            $cleanOldPsw = trim(htmlspecialchars($psw));
            $cleanUser = trim(htmlspecialchars($user));
            $cleanPsw = trim(htmlspecialchars($newPsw));
            $cleanPsw1 = trim(htmlspecialchars($newPsw1));
            
            require 'include/coonProcedurale.php';
            $sql = "SELECT * FROM utenti WHERE username = '$cleanUser'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0) {
              echo "<script>alert('User inesistente');</script>";
              return false;
            } else {
              
              while($row = mysqli_fetch_assoc($result)) {
                if (password_verify($cleanOldPsw, $row['password'])) {
                  if ($cleanPsw != $cleanPsw1) {
                    echo "<script>alert('nuova password e conferma nuova password non uguali!');</script>";
                    return false;
                  } elseif (!(mb_strlen($cleanPsw) >= 3 && mb_strlen($cleanPsw) <= 20)) {
                    echo "<script>alert('Password troppo lunga lunga o troppo corta! (min 3 - max 20 caratteri)');</script>";
                    return false;
                  } elseif (!preg_match('/^[a-zA-Z0-9\+=\!@#\$%]{3,20}$/', $cleanPsw)) {
                    echo "<script>alert('La buova password contiene caratteri speciali non validi (caratteri ammessi: +=!@#$%');</script>";
                    return false;
                  } elseif ($psw == $cleanPsw) {
                    echo "<script>alert('Password vecchia uguale a password nuova');</script>";
                    return false;
                  } else {
                      // encript the password
                      $passwordHash = password_hash($cleanPsw, PASSWORD_DEFAULT);
                      require 'include/coonProcedurale.php';
                      $sql = "UPDATE utenti SET password = ? WHERE username = '$cleanUser'";
                      if($stmt = mysqli_prepare($conn, $sql)){
                                                                      //if (mysqli_query($conn, $sql)) {
                        mysqli_stmt_bind_param($stmt, "s", $passwordHash);
                        mysqli_stmt_execute($stmt);
                        echo "<script>alert('Aggiornamento effettuato con successo');</script>";
                      } else {
                        echo "<script>alert('Errore di connessione');</script>" . mysqli_error($conn);
                      }
                    }
                } else {
                  echo "<script>alert('Password non corretta');</script>";
                    return false;
                }                    
              }
            }
          }
        }
        ?>
      
      </form>
    </div>
    
  </body>
</html>