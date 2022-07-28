<?php
session_start();
if ($_SESSION["colore"] != "verde") {
  header('location: login.php');
}
require 'include/conn.php';
require 'gestione-utenti/classutenti.php';

?>