<?php

//retrieval of reservations from the database
    /*
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "reservations";
    */
    $servername = getenv('DB_HOST');
    $username = getenv('DB_USER');
    $password = getenv('DB_PSW');
    $dbname = getenv('DB_NAME');

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    
    
?>