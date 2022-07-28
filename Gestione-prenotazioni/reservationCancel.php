<?php

require 'include/default.php';

if (isset($_GET['delete'])) {
  $IDReservation = $_GET['delete'];
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
    
    <title>Gestione prenotazioni - Cancellazione della prenotazione</title>
    
  </head>
  <body>
    <header>
      <div class="center-text">
        <h1 class="title-h1">GESTIONE PRENOTAZIONI</h1>
        <h2 class="title-h2 light-red">CANCELLAZIONE DELLA PRENOTAZIONE</h2>
      </div>
      
      <div class="buttons">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" class="logout"> 
          <input type="submit" class="btn-header" value="Pannello di Controllo" name="control">
        </form>
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" value="Disconnessione" name="logout" class="btn-header">
        </form>
      </div>
    </header>
    <div class='space'></div>
    
    <section>
      <h3 class="center-text"> Sicuro che vuoi cancellare questa prenotazione? </h3>
      <br>
      
      <table class="cancel-table">
        <?php
        
        // take from DB the reservation to be cancelled
        
        require 'include/coonProcedurale.php';
        $sql = "SELECT * FROM prenotazioni WHERE IDPr = ?";
        $record = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($record, 'i',$IDReservation);
        mysqli_stmt_execute($record);
        $result = mysqli_stmt_get_result($record);

        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><th>ID</th><td>" . $row['IDPr'] . "</td></tr>";
            echo "<tr><th>Cliente</th><td>" . $row['cliente'] . "</td></tr>";
            echo "<tr><th>Camera</th><td>" . $row['camera'] . "</td></tr>";
            echo "<tr><th>data da</th><td>" . $row['dataDa'] . "</td></tr>";
            echo "<tr><th>data a</th><td>" . $row['dataA'] . "</td></tr>"; 
          }
        } else {
          echo "0 results";
        }

        mysqli_close($conn);
        
        
        if ($_POST != "") {
          
          // here we cancel the reservation
          
          if (isset($_POST['cancel'])) {
            require 'include/coonProcedurale.php';
            $sql = "DELETE FROM prenotazioni WHERE IDPr = ?";
            
            $deleteRecord = mysqli_prepare($conn,$sql);
            mysqli_stmt_bind_param($deleteRecord, 'i',$IDReservation);
            mysqli_stmt_execute($deleteRecord);

            if ($deleteRecord->execute()) {
              echo "<script>alert('Prenotazione cancellata');</script>";
              echo "<script>window.location = 'controlPanel.php';</script>";
            } else {
              echo "Errore di connesione al database: " . mysqli_error($conn);
            }
            mysqli_close($conn);
          }
          
          // come back to the control panel
        
          if (isset($_POST['control'])) {
            header('location: controlpanel.php');
          }
        }

        ?>
      </table>
      
      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" class="logout"> 
        <input type="submit" class="light-btn" value="Conferma Cancellazione" name="cancel">
      </form>
      
      
      
    </section>
  </body>
</html>
    