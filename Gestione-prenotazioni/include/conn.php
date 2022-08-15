<?php

// take the enviroment variable from the file .env

$fileContent = file(__DIR__.'/.env');

foreach ($fileContent as $envVar) {
  putenv(trim($envVar));
}

$dbname = getenv('DB_NAME');
$dbuser = getenv('DB_USER');
$dbpsw = getenv('DB_PSW');
$dbhost = getenv('DB_HOST');

//connessione al DB 'reservations' per il progetto 'Gestione Prenotazioni' 
// connection to the DB for the project 'Gestione prenotazioni'

$dsn = "mysql:host=$dbhost;dbname=$dbname";

try {
  $PDO = new PDO($dsn, $dbuser, $dbpsw);
  $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $PDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e) {         
  echo "Connessione fallita: " . $e->getMessage();
}

?>