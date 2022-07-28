<?php

require 'include/coonProcedurale.php';
    
$sql = "DELETE FROM utentiloggati";

if (mysqli_query($conn, $sql)) {
  session_destroy();
  header('location: login.php');
} else {
  echo "Error deleting record: " . mysqli_error($conn);
}
  
mysqli_close($conn);


?>