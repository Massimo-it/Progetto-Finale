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
          $sql = "SELECT * FROM clienti WHERE ID = ?";
            
          $record = mysqli_prepare($conn,$sql);
          mysqli_stmt_bind_param($record,'s',$idCancel);
          mysqli_stmt_execute($record);
          $result = mysqli_stmt_get_result($record);
          
          while ($row = mysqli_fetch_assoc($result)) {
            $customerName = $row['nome'];
            $customerEmail = $row['email'];
            $customerNote = $row['note'];
            echo "<tr><th>ID</th><td>" . $row['ID'] . "</td></tr>";
            echo "<tr><th>NOME</th><td>" . $customerName . "</td></tr>";
            echo "<tr><th>EMAIL</th><td>" . $customerEmail . "</td></tr>";
            echo "<tr><th>NOTE</th><td>" . $customerNote . "</td></tr>";
          }
          } else {
          header('location: customerList.php');
        }
        
        ?> 
      </table>
     
     <?php
      if (isset($_POST['cancel'])) {
        $idCancel = $_GET['delete'];
        
        //delete the customer 
        $sql1 = "DELETE FROM clienti WHERE ID = ?";
        $deleteRecord = mysqli_prepare($conn,$sql1);
        mysqli_stmt_bind_param($deleteRecord, 'i',$idCancel);
        mysqli_stmt_execute($deleteRecord);
        if (mysqli_error($conn)) {
          echo "Errore di sistema: " . mysqli_error($conn);
        } else {
          echo "<script>alert('Cancellazione del cliente effettuata');</script>"; 
        }
        
        // delete all reservations 
        $sql2 = "DELETE FROM prenotazioni WHERE cliente = ?";
        $deleteRecord = mysqli_prepare($conn,$sql2);
        mysqli_stmt_bind_param($deleteRecord, 's',$customerName);
        mysqli_stmt_execute($deleteRecord);
        if (mysqli_error($conn)) {
          echo "Errore di sistema: " . mysqli_error($conn);
        } else {
          echo "<script>alert('Effettuata la cancellazione di tutte le prenotazioni di questo cliente');</script>";
        }
        echo "<script>window.location = 'customerList.php';</script>";
      }
      
      ?>
      
      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" class="logout"> 
        <input type="submit" class="light-btn" value="CONFERMA CANCELLAZIONE" name="cancel">
      </form>
    </section>
    
  </body>
</html>