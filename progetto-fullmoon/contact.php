<!DOCTYPE html>
<html lang="it-it">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="progetto full moon - sito internet adatto a strutture per vacanza con diverse camere da affittare">
	<meta name="author" content="max.dev@europe.com">
  <link rel="stylesheet" type="text/css" href="style-fullmoon.css">
	
	<title>Progetto full moon per strutture vacanza</title>

</head>

<body>

<?php

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["firstname"];
    $email = $_POST["email"];
    $room = $_POST["room"];
    $dateFrom = $_POST["date-from"];
    $dateTo = $_POST["date-to"];
    $subject = $_POST["subject"];
    
    $name = filter_var(trim($name), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    $room = filter_var(trim($room), FILTER_SANITIZE_STRING);
    $dateFrom = filter_var(trim($dateFrom), FILTER_SANITIZE_STRING);
    $dateTo = filter_var(trim($dateTo), FILTER_SANITIZE_STRING);
    $subject = filter_var(trim($subject), FILTER_SANITIZE_STRING);
    
    if ($dateFrom >= $dateTo  || $dateFrom <= date("Y-m-d", time())) {
      echo "<script>confirm('Date non corrette!');</script>";
      $error = "error";
    }
    
    $y = substr($dateFrom, 0, 4);
    $m = substr($dateFrom, 5, 2);
    $d = substr($dateFrom, 8, 2);
    
    if (checkdate($m,$d,$y) == false) {
      echo "<script>confirm('Date non corrette!');</script>";
      $error = "error";
    }
    
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      echo "<script>confirm('Campo nome: solo lettere maiuscole o minuscole!');</script>";
      $error = "error";
    }
    
    /* send emial */
    
    if ($error == "") { 
    
    $adminEmail = "max.dev@europe.com"; /* ATTENZIONE: METTERE QUI L'EMAIL DEL GESTORE CHE RICEVE L'EMAIL CON LA RICHIESTA */
    
    $userMessage = "
      <html>
        <head>
          <title>Messaggio dal sito PROGETTO FULLMOON</title> /* ATTENZIONE - CORREGGERE */
        </head>
        <body>
          <h1 style='color:white;background-color:#781D42;text-align:center;padding:10px;'>PROGETTO FULLMOON</h1>  /* ATTENZIONE CORREGGERE */
          <p>Grazie per averci contattato.</p>
          <p>La tua richiesta di prenotazione è la seguente:</p>
          <ul>
            <li>Nome: $name</li>
            <li>indirizzo email: $email</li>
            <li>Chiesta prenotazioe per la $room</li>
            <li>Ineteressato al periodo da: $dateFrom a: $dateTo</li>
            <li>Messaggio: $subject</li>
          </ul>
          <p>La sua richiesta è stata inoltrata. Risponderemo al più presto.</p>
          <br>
          <p>PROGETTO FULLMOON</p>  /*<!-- ATTENZIONE - CORREGGERE -->*/
        </body>
      </html>
    ";
    $adminMessage = "
      <html>
        <head>
          <title>Contatto dal sito web</title>
        </head>
        <body>
          <h1>Contatto dal sito web</h1>
          <ul>
            <li>Nome: $name</li>
            <li>indirizzo email: $email</li>
            <li>Chiesta prenotazioe per la $room</li>
            <li>Ineteressato al periodo da: $dateFrom a: $dateTo</li>
            <li>Messaggio: $subject</li>
          </ul>
        </body>
      </html>
    ";

    /* headers for message in HTML format */

    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=utf-8';

    /* other headers */ 

    $headers[] ="from: max.dev@europe.com";  /* ATTENZIONE - CORREGGERE */

    mail($email, 'Richiesta di contatto effettuata con successo', $userMessage, implode("\r\n", $headers));
    mail($adminEmail, 'Richiesta di contatto dal sito web', $adminMessage, implode("\r\n", $headers));
    
    echo "<script>confirm('Messaggio inviato con successo');</script>";
    
    } else {
      echo "<script>confirm('Messaggio non inviato');</script>";
    }

}
?>


<!-- header -->

  <header class="header" id="white">
    <nav>
      <a href="index.html" class="logo"><img src="images-fullmoon/logo-progetto-fullmoon-foto.svg" alt="logo progetto full moon" width="70" height="70"></a>
      <a id="prenota-button" href="contact.php">CONTATTACI</a>
    </nav>
    
    <div id="menu" class="menu-hide">
      <a href="about.html" class="menu-line">Struttura</a>
      <a href="service.html" class="menu-line">Servizi</a>
      <a href="gallery.html" class="menu-line">Galleria</a>
      <a href="tarif.html" class="menu-line">Tariffe</a>
    </div>
      
    <div id="second-line">
      <span id="cell-rooms">CAMERE</span>
      <span id="hamburger">MENU</span>
    </div>
    <div id="rooms-menu" class="menu-hide">
      <a href="room1.html" class="title-room">CAMERA-1</a>
      <a href="room2.html" class="title-room">CAMERA-2</a>
      <a href="room3.html" class="title-room">CAMERA-3</a>
    </div>
    <div id="decoration"></div>
  </header>
 
  <h1 class="title-h1">CONTATTI</h1>
  
  <h2 class="text-h2">qui diamo le varie possibilità di contatto</h2>
  
  </section>
  
  <!-- section contact with the form -->
  
  <p class="text-form">Se vuoi puoi contattarci compilando i dati di questo modulo:</p>
  
  <div class="container-form">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

      <label for="name">Nome <span class="red-point">*</span></label>
      <input type="text" id="name" name="firstname" placeholder="Digita il tuo nome.." maxlength="30" required >
      
      <label for="email">Indirizzo email <span class="red-point">*</span></label>
      <input type="email" id="email" name="email" placeholder="digita qui il tuo indirizzo email.." required>
      
      <p>Scegli quale camera vorresti prenotare <span class="red-point">*</span></p>
      
      <div class="options-container">
        <div class="room-box">
          <input type="radio" id="room1" name="room" value="Camera 1" required>
          <label for="room1">Camera 1</label>
        </div>
        
        <div class="room-box">
          <input type="radio" id="room2" name="room" value="Camera 2" required>
          <label for="room2">Camera 2</label>
        </div>
        
        <div class="room-box">
          <input type="radio" id="room3" name="room" value="Camera 3" required>
          <label for="room3">Camera 3</label>
        </div>
      </div>
      
      <p class="text-form-center">Mi interessa il periodo</p>
      
      <div class="date-flex">
        <div class="data-block">
          <label for="date-from">DA <span class="red-point">*</span></label>
          <input type="date" id="date-from" name="date-from" required>
        </div>
        
        <div class="data-block">
          <label for="date-to">A <span class="red-point">*</span></label>
          <input type="date" id="date-to" name="date-to" required>
        </div>
      </div>
      
      <label for="subject">Messaggio</label>
      <textarea id="subject" name="subject" placeholder="digita qui il messaggio che vuoi inviarci.." maxlength="300"></textarea>

      <input type="submit" name="Invia" value="Invia" class="input-invia">

    </form>
  </div>
  
  <!-- button for email -->
  
  <div class="button">
    <h3 class="text-h3">Oppure puoi inviarci una email cliccando su questo pulsante</h3>
    
    <div class="button-center">
      <a class="prenota-button-main" href="mailto:max.dev@europe.com">Mandaci una email</a>
    </div>

  </div>
  
  <!-- map section -->
  
  <h2 class="text-h2">Clicca sulla mappa per vedere dove siamo</h2>
  
  <div class="map">
    <a href="https://www.google.pl/maps/place/Duomo+di+Milano/@45.4641013,9.1897324,17z/data=!3m1!4b1!4m5!3m4!1s0x4786c6aec34636a1:0xab7f4e27101a2e13!8m2!3d45.4640976!4d9.1919265?hl=it"
    target="_blank"><img class="map" src="images-fullmoon/duomo-milano.jpg" alt="mappa per raggiungere l'appartamento"></a>
    <p class="figcaption">Coordinate GPS:  45.464210, 9.191905</p>
  </div>
  
  <!-- footer section -->
  
  <footer>
  <br>
    <img src="images-fullmoon/logo-progetto-fullmoon-foto.svg" alt="logo progetto fullmoon">
    <div class="menu-footer">
      <a href="index.html" class="menu-line">Home</a>
      <a href="about.html" class="menu-line">Struttura</a>
      <a href="service.html" class="menu-line">Servizi</a>
      <a href="gallery.html" class="menu-line">Galleria</a>
      <a href="tarif.html" class="menu-line">Tariffe</a>
      <a href="contact.php" class="menu-line">Contatti</a>
    </div>
    <div class="contact-footer">
      <ul>
        <li class="footer-line">email:  max.dev@europe.com</li>
        <li class="footer-line">tel: +48 784 025 883</li>
        <li class="footer-line">whatsapp: +48 574 691 064</li>
      </ul>
    </div>
    <p>Le immagini del sito sono tratte da pixabay.com</p>
  </footer>
  
  <script src="menuFullmoon.js"></script>
  
</body>
</html>