<?php

// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require 'include/conn.php';
require 'customerClass.php';
 
$customerMng = new customerMng($PDO);
 
$data = json_decode(file_get_contents("php://input"));


if($data->email) {
  $idModify = $data->myId;
  $email = $data->email;
  $note = $data->note;
  
  
  if($request = $customerMng->changeCustomer($email, $note, $idModify)) {       
    http_response_code(200); 
    echo "Il cliente e' stato modificato.";
  } else {
    http_response_code(503);    
    echo "La classe non ha funzionato. Registrazione impossibile";
  }
} else {
  http_response_code(400);    
  echo "Dati mancanti. Registrazione impossibile";
}


?>