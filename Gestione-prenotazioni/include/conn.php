<?php

//connessione al DB 'gestioneprenotazioni' per il progetto 'Gestione Prenotazioni' - connection to the DB for the project 'Gestione prenotazioni'

$username = 'root';
$password = '';

$dsn="mysql:host=localhost;dbname=gestioneprenotazioni;charset-utf8";

try {
  $PDO = new PDO($dsn, $username, $password);
  $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e) {         
  echo "Connessione fallita: " . $e->getMessage();
}
?>