<!DOCTYPE html>
<html lang="it-it">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Esempio sito casa affitto breve - contatti">
  <meta name="author" content="max.dev@europe.com">
	<link rel="stylesheet" type="text/css" href="style-rikko.css">
  <title>Casa Affitto Breve Progetto Rikko</title>

</head>

<body>

<?php

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["firstname"];
    $email = $_POST["email"];
    $dateFrom = $_POST["date-from"];
    $dateTo = $_POST["date-to"];
    $subject = $_POST["subject"];
    
    $name = filter_var(trim($name), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
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
    
    if (strlen($subject) > 300) {
      echo "<script>confirm('Messaggio troppo lungo. Max 300 caratteri.');</script>";
      $error = "error";
    }
    
    /* send emial */
    
    if ($error == "") { 
    
    $adminEmail = "max.dev@europe.com"; /* ATTENZIONE: METTERE QUI L'EMAIL DEL GESTORE CHE RICEVE L'EMAIL CON LA RICHIESTA */
    
    $userMessage = "
      <html>
        <head>
          <title>Messaggio dal sito PROGETTO RIKKO</title> /*<!-- ATTENZIONE - CORREGGERE -->*/
        </head>
        <body>
          <h1 style='color:white;background-color:#781D42;text-align:center;padding:10px;'>PROGETTO RIKKO</h1>  /* ATTENZIONE CORREGGERE */
          <p>Grazie per averci contattato.</p>
          <p>La sua richiesta è stata inoltrata. Risponderemo al più presto.</p>
          <br>
          <p>PROGETTO RIKKO</p>  /* ATTENZIONE - CORREGGERE */
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


<!-- header with logo and menu -->

  <header class="header">
    <a href="index.html" class="logo"><img src="images-rikko/logo-progetto-rikko-sito.svg" alt="logo progetto Rikko"></a>
    <p id="hamburger"> &#8801 </p>
    
    <ul id="menu" class="menu-hide">
      <li class="menu-line"><a href="presentation.html">La Struttura</a></li>
      <li class="menu-line"><a href="service.html">Servizi</a></li>
      <li class="menu-line"><a href="gallery.html">Galleria</a></li>
      <li class="menu-line"><a href="tarif.html">Tariffe</a></li>
      <li class="menu-line"><a href="contact.php">Contatti</a></li>
    </ul>
    
  </header>

<!-- cover of the presentation -->

  <section class="about">
  
    <h1 class="title-h1">ECCO COME CONTATTARCI</h1>
    <h2 class="title-h2">qui diamo le varie possibilità di contatto</h2>
  
  </section>
  
  <!-- section contact with the form -->
  
  <p class="text-form">Se vuoi puoi contattarci compilando i dati di questo modulo:</p>
  
  <div class="container-form">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

      <label for="name">Nome <span class="red-point">*</span></label>
      <input type="text" id="name" name="firstname" placeholder="Digita il tuo nome.." maxlength="30" required >
      
      <label for="email">Indirizzo email <span class="red-point">*</span></label>
      <input type="email" id="email" name="email" placeholder="digita qui il tuo indirizzo email.." required>
      
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
      
      <label for="subject">Messaggio (max 300 caratteri)</label>
      <textarea id="subject" name="subject" placeholder="digita qui il messaggio che vuoi inviarci.." maxlength="300"></textarea>

      <input type="submit" name="Invia" value="Invia" class="input-invia">

    </form>
  </div>
  
  <div class="map">
    <a href="https://www.google.pl/maps/place/Duomo+di+Milano/@45.4641013,9.1897324,17z/data=!3m1!4b1!4m5!3m4!1s0x4786c6aec34636a1:0xab7f4e27101a2e13!8m2!3d45.4640976!4d9.1919265?hl=it"
    target="_blank"><img class="map" src="images-rikko/duomo-milano.jpg" alt="mappa per raggiungere l'appartamento"></a>
    <p class="figcaption">Coordinate GPS:  45.464210, 9.191905</p>
  </div>
  
  <footer>
  
    <div class="center-img">
      <img src="images-rikko/logo-progetto-rikko-sito-y.svg" alt="logo progetto Rikko">
    </div>
    
    <div class="contanier-footer">
      <div class="list-footer">
        <ul>
          <li class="footer-line"><a href="presentation.html">La Struttura</a></li>
          <li class="footer-line"><a href="service.html">Servizi</a></li>
          <li class="footer-line"><a href="gallery.html">Galleria</a></li>
          <li class="footer-line"><a href="tarif.html">Tariffe</a></li>
          <li class="footer-line"><a href="contact.php">Contatti</a></li>
        </ul>
      </div>
      
      <div class="contact-footer">
        <ul>
          <li class="footer-line">email:  max.dev@europe.com</li>
          <li class="footer-line">tel: +48 784 025 883</li>
          <li class="footer-line">whatsapp: +48 574 691 064</li>
        </ul>
      </div>
    
    </div>
    <p class="footer-text">Le immagini del sito sono tratte da pixabay.com</p>
    <br>
  </footer>
  
  <script src="menuRikko.js"></script>

  
</body>
</html>
