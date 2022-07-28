<?php
/*********************************

FILE gestioneutenti.php DA  ATTIVARE SOLO QUANDO E' NECESSARIO GESTIRE GLI UTENTI 
CHE AVRANNO ACCESSO AL PROGRAMMA. TERMNATE LE OPERAZIONI SUGLI UTENTI E'
NECESSARIO INIBIRLO IMMEDIATAMENTE.  PER RAGIONI DI SICUREZZA, IN MODO CHE NESSUNO
DALL'ESTERNO POSSA AVERE ACCESSO A QUESTO FILE 


http://localhost/progetto-immobili/gestione-prenotazioni/gestione-utenti/

****************************************************/

require '../include/conn.php';
require 'classutenti.php';
 
if (isset($_GET['delete'])) {
  $user = $_GET['delete'];
  $userManagement = new UserManagement($PDO);
  $userManagement->cancelUser($user);
}

?>
<!DOCTYPE html>
<html lang="it-it">
  <head>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <title>Gestione prenotazioni - Gestione Utenti</title>
    
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
      .colored-table {
        color: green;
        font-size: 20px;
      }
      table {
        width: 30%;
        margin: auto;
        text-align: center;
      }
      tr, td, th {
        border: 1px solid black;
      }
    </style>
  </head>
  <body>
    <h1>PROGRAMMA PER LA GESTIONE DELLE PRENOTAZIONI</h3>
    <h2>Progetto gestione immobili</h2>
    <h3>- sezione gestione utenti -</h3>
    
    <table>
  
    <tr>
      <th>ID</th>
      <th>USERNAME</th>
      <th class="change">MODIFICA</th>
      <th class="cancel">ELIMINA</th>
    </tr>
    
      <?php
      
      $url = "http://localhost/progetto-immobili/gestione-prenotazioni/gestione-utenti/elencoutenti-api.php";
      $client = curl_init($url);
      curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
      $response = curl_exec($client);
      
      $result = json_decode($response, true);
      
      foreach($result as $key) {
        echo "<tr>";
        echo "<td class='colored-table'>" . $key['ID'] . "</td>";
        echo "<td class='colored-table'>" . $key['username'] . "</td>";
        
        $xx = $key['ID'];
        $name = $key['username'];
        
        echo "<td class='link_modify'><a href='cambioutente.php?modify={$xx}&name={$name}'> &#9989 </a></td>";
        echo "<td class='link_cancel'><a href='gestioneutenti.php?delete={$xx}'> &#10060 </a></td>";
        echo "</tr>";
      }
     
      ?>
    </table>
    
    <div>    
      <form action="nuovoutente.php" method="get"> 
        <input type="submit" class="list-btn" value="Nuovo Utente" name="nuovoUtente">
      </form>
    </div>
    
  </body>
</html>