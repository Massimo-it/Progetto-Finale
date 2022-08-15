<?php

require 'include/default.php';

if ($_POST != "") {
  if (isset($_POST['control'])) {
    header('location: controlpanel.php');
  }
  if (isset($_POST['logout'])) {
    require 'include/logout.php';
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
    
    <title>Gestione prenotazioni - Registrazione della prenotazione</title>
    
  </head>
  <body>
    <header>
      <div class="center-text">
        <h1 class="title-h1">GESTIONE PRENOTAZIONI</h1>
        <h2 class="title-h2 light-green">NUOVA PRENOTAZIONE</h2>
      </div>
      
      <div class="buttons">
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" value="Pannello di Controllo" name="control" class="btn-header">
        </form>
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" value="Disconnessione" name="logout" class="btn-header">
        </form>
      </div>
    </header>
    <div class='space'></div>
    
    <section class="section-reservation">
      <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post" class="form-style">
        <label for="customer">scegli il cliente</label>
          <select name="customer" id="customer">
           
            <?php
              
              require 'include/coonProcedurale.php';
              $sql = "SELECT customer_name FROM customers ORDER BY customer_name ASC";
              $result = mysqli_query($conn, $sql);
            
              if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                  echo "<option value='" . $row['customer_name'] . "'>" . $row['customer_name'] . "</optopn>"; 
                }
              } else {
                echo "<h3 class='center-text'>non hai ancora CLIENTI in elenco.</h3>";
              }  
            mysqli_close($conn);               
            ?>
         
          </select>
        <br><br>
        
        <label for="room">Scegli la camera</label>
          <select name="room" id="room">
            <option value="room-1">Camera 1</option>
            <option value="room-2">Camera 2</option>
            <option value="room-3">Camera 3</option>
          </select>
        
        <br><br>
        <label for="date-from">DA <span class="red-point">*</span></label>
        <input type="date" id="date-from" name="date-from" required>
        
        <br><br>
        <label for="date-to">A <span class="red-point">*</span></label>
        <input type="date" id="date-to" name="date-to" required>
        <br><br><br>
        
        <button type="submit" class="light-btn" name="submit">Conferma Prenotazione</button>
      </form>
    </section>
    
    <?php
    if ($_POST != "") {
      if (isset($_POST['submit'])) {
        $cleanCustomer = htmlspecialchars(trim($_POST['customer']));
        $cleanRoom = htmlspecialchars(trim($_POST['room']));
        $cleanDateFrom = trim($_POST['date-from']);
        $cleanDateTo = trim($_POST['date-to']);
        
        $today = date("Y-m-d");
        
        if ($cleanDateFrom <= $today) {
          echo "<script>alert('la data DA non può essere oggi o anteriore a oggi.');</script>";
          return false;
        }
        
        if ($cleanDateTo < $cleanDateFrom) {
          echo "<script>alert('la data A non può anteriore rispetto alla data DA.');</script>";
          return false;
        }
        
        // check if the reservation is not already present into the DB
        require 'include/coonProcedurale.php';
        
        $sql = "SELECT * FROM customer_reservation WHERE room = ?";
        
        $record = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($record, 's',$cleanRoom);
        mysqli_stmt_execute($record);
        $result = mysqli_stmt_get_result($record);
        
        if (mysqli_num_rows($result) > 0) {
          $reservationArray = array();
          $newReservationArray = array();
          while($row = mysqli_fetch_assoc($result)) {
            $begin = new DateTime($row['from_date']);
            $end = new DateTime($row['to_date']);
            for($i = $begin; $i <= $end; $i->modify('+1 day')){
              $dayReserved = $i->format('Y-m-d');
              array_push($reservationArray, $dayReserved);
            }
          }
          $newDateFrom = new DateTime($cleanDateFrom);
          $newDateTo = new DateTime($cleanDateTo);
          for($i = $newDateFrom; $i <= $newDateTo; $i->modify('+1 day')){
            $newDayReserved = $i->format('Y-m-d');
            array_push($newReservationArray, $newDayReserved);
          }
            
          foreach ($newReservationArray as $dateBusy) {
            If (in_array($dateBusy, $reservationArray)) {
              echo "<script>alert('Periodo già occupato per questa camera. Torna al pannello di controllo e vai a vedere il calendario di questa camera.');</script>";
              return false;
              break;
            }
          }
        }
        mysqli_stmt_close($record);
        $sql = "INSERT INTO customer_reservation (customer, room, from_date, to_date) VALUES (?,?,?,?)";
        if($stmt = mysqli_prepare($conn, $sql)){
          mysqli_stmt_bind_param($stmt, "ssss", $cleanCustomer, $cleanRoom, $cleanDateFrom, $cleanDateTo);
          mysqli_stmt_execute($stmt);
          echo "<script>alert('Registrazione effettuata con successo.');</script>";
          return true;
        }
      }
    }
    
    ?>
  
  </body>
</html>