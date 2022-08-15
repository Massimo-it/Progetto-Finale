<?php
require 'include/default.php';

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
    
    <title>Gestione prenotazioni - Camera 3</title>
    
  </head>
  <body>
    <header>
      <div class="center-text">
        <h1 class="title-h1">GESTIONE PRENOTAZIONI</h1>
        <h2 class="title-h2 title-room3">CAMERA - 3</h2>
      </div>
      
      <div class="buttons">
        <form action='reservation.php' method='post'>
            <input type='submit' value='Nuova Prenotazione'name='newReservation' class="btn-header">
        </form>
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" value="Pannello di Controllo" name="control" class="btn-header">
        </form>
        <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post"> 
          <input type="submit" value="Disconnessione" name="logout" class="btn-header">
        </form>
      </div>
    
    
    
    
<?php
  
  function build_calendar($month, $year) {
    
    // take reservation from DB 
    
    require_once 'include/coonProcedurale.php';
    $room3 = "room-3";
    $sql = "SELECT * FROM customer_reservation WHERE room=?";
    
    $record = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($record, 's',$room3);
    mysqli_stmt_execute($record);
    $result = mysqli_stmt_get_result($record);
    
    $reservationArray = array();
    $dateFromArray = array();
    $dateToArray = array();

    if (mysqli_num_rows($result) == 0) {
      $IDReservation = $customerName = $roomBusy = $dateFrom = $dateTo = "";
      } else {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $IDReservation = $row['IDPr'];
        $customerName = $row['customer'];
        $roomBusy = $row['room'];
        $dateFrom = $row['from_date'];
        $dateTo = $row['to_date'];
      
        $begin = new DateTime( $dateFrom );
        $end   = new DateTime( $dateTo );

          for($i = $begin; $i <= $end; $i->modify('+1 day')){
            $dayReserved = $i->format("Y-m-d");
            array_push($reservationArray, $dayReserved, $customerName, $IDReservation);
            array_push($dateFromArray, $dateFrom);
            array_push($dateToArray, $dateTo);
          }
          
        }
        mysqli_close($conn);
      }
    
    /* variable for the calendar */
    
    $daysOfWeek = array('Domenica', 'Lunedì', 'Martedì', 'Mercoledì', 'Giovedì', 'Venerdì', 'Sabato');
    $monthItalian = array('', 'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);   // (ore,min,sec,mese, giorno, anno) - in giorni dal 01-01-1970
    $numberDays = date('t', $firstDayOfMonth);            //prende quanti giorni ha il mese che stiamo trattando
    $dateCompnents = getdate($firstDayOfMonth);         // crea un array con tutte le informazioni della data 
    $monthNr = $dateCompnents['mon'];                   //prende il nome del mese (in inglese) dall'array
    $monthName = $monthItalian[$monthNr];             //prende il nome del mese in italiano  
    $dateToday = date('Y-m-d');
    
    
    // now we create the calendar
    
    //$calendar = "<table>";   //apertura del TAG <table>
    
    $prev_month = date('m', mktime(0,0,0,$month-1,1,$year));   //numero del mese precedente
    $prev_year = date('Y', mktime(0,0,0,$month-1,1,$year));    //anno precedente
    $next_month = date('m', mktime(0,0,0,$month+1,1,$year));    //numero del mese successivo
    $next_year = date('Y', mktime(0,0,0,$month+1,1,$year));     // anno successivo
    
    $calendar = "<h2 class='month'>$monthName $year</h2>";  // titolo delle tabella con nome del mese e l'anno
    
    $calendar .= "<div class='center'><a class='btn-primary' href='?month=" . $prev_month . "&year=" . $prev_year . "'>Mese -1</a>";
    $calendar .= "<a class='btn-central' href='?month=" . date('m') . "&year=" . date('Y') . "'>Mese Corrente</a>";
    $calendar .= "<a class='btn-primary' href='?month=" . $next_month . "&year=" . $next_year . "'>Mese +1</a></div>";
    
    $calendar .= "</header>
    <div class='space-rooms'></div>";
    
    echo $calendar;
    
    echo "
    <table>
    <th colspan='2'>GIORNO</th>
    <th>MATT/POM</th>
    <th>PRENOTATO DA</th>
    <th> &#10060 </th>";
    
      for ($day=1; $day<=$numberDays; ++$day) {
      $nameToBeShown = getdate(mktime(0, 0, 0, $month, $day, $year))['wday'];
      $currentDayRel = str_pad($day, 2, "0", STR_PAD_LEFT);
      // at the first elaboration the month take the value without the 0 at the beggining
      // now the month will always have two digit
      if (strlen($month) == 1) {   
        $month = 0 . $month;
      }
      $date = "$year-$month-$currentDayRel";
      
     
      // identify today and give a different style
      
      if ($date == $dateToday) {
        $today = "today";
      } else {
        $today = "";
      }
      
      if ($daysOfWeek[$nameToBeShown] == "Domenica") {
        $sunday = "sunday";
      } else {
        $sunday = "";
      }
      
      /* variable fot the reseration */
      
      if (in_array($date, $reservationArray)) {
        
        //to identify the first day of reservation and give the morining free the afternoon not-free
        
        if (in_array($date, $dateFromArray)) {
          $freeOrNotM = "free";
          $clientReservedM = "";
          $buttonCancM = "";
          $freeOrNotA = "not-free"; 
          for ($i = 0; $i < count($reservationArray); ++$i) {
            If ($date == $reservationArray[$i]) {
              $clientReservedA = $reservationArray[$i+1];
              $buttonCancA = "<a href='reservationCancel.php?delete={$reservationArray[$i+2]}' class='link-canc'> &#10060 </a>";
            }
          }
        } else {
          $freeOrNotM = "not-free";
          $freeOrNotA = "not-free";
          for ($i = 0; $i < count($reservationArray); ++$i) {
            If ($date == $reservationArray[$i]) {
              $clientReservedM = $clientReservedA = $reservationArray[$i+1];
              $buttonCancM = "<a href='reservationCancel.php?delete={$reservationArray[$i+2]}' class='link-canc'> &#10060 </a>";
              $buttonCancA = "<a href='reservationCancel.php?delete={$reservationArray[$i+2]}' class='link-canc'> &#10060 </a>";
            }
          }
        }
        
        //to identify the last day of reservation and give the morining not-free the afternoon free
        
        if (in_array($date, $dateToArray)) {
          $freeOrNotA = "free";
          $clientReservedA = "";
          $buttonCancA = "";
          $freeOrNotM = "not-free"; 
          for ($i = 0; $i < count($reservationArray); ++$i) {
            If ($date == $reservationArray[$i]) {
              $clientReservedM = $reservationArray[$i+1];
              $buttonCancM = "<a href='reservationCancel.php?delete={$reservationArray[$i+2]}' class='link-canc'> &#10060 </a>";
            }
          }
        }
        
        //when the variable $date doesn't meet conditions it means that it's free
        
      } else {
        $freeOrNotM = "free";
        $freeOrNotA = "free";
        $clientReservedM = $clientReservedA = "";
        $buttonCancM = $buttonCancA = "";
      }
    
    
      
        echo "
        <tr>
          <td class='$today $sunday border-top' rowspan='2'> $day </td>
          <td class='$today $sunday border-top' rowspan='2'> $daysOfWeek[$nameToBeShown] </td>
          <td class='$freeOrNotM border-top morning-noon'>00:00 - 12:00</td>
          <td class='$freeOrNotM border-top'> $clientReservedM </td>
          <td class='$freeOrNotM border-top'> $buttonCancM </td>
            
          </tr>
          
          <tr>

          <td class='$freeOrNotA morning-noon'>12:00 - 24:00</td>
          <td class='$freeOrNotA'> $clientReservedA </td>
          <td class='$freeOrNotA'> $buttonCancA </td>
        </tr>
        ";
      }
  }
?>
    
      <div class="row">
        <div class="col-md-12">
          <?php
            $dateCompnents = getdate();
            if(isset($_GET['month']) && isset($_GET['year'])) {
              $month = $_GET['month'];
              $year = $_GET['year'];
            } else {
            $month = $dateCompnents['mon'];
            $year = $dateCompnents['year'];
            }
            echo build_calendar($month, $year);
          ?>
          </table>
        </div>
      </div>
    
    
  
  </body>
</html>
  