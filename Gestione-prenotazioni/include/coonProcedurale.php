<?php

//retrieval of reservations from the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestioneprenotazioni";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    
?>