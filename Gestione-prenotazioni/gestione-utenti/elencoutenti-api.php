<?php

// elencoutenti-api.php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require '../include/conn.php';
require 'classutenti.php';

$userManagement = new UserManagement($PDO);
$request = $userManagement->utentiList();

if($request->rowCount() == 0 ) {
  echo json_encode(array("message" => "nessun utente in elenco"));
  } else {
  $user_list = array();
  while ($record = $request->fetch(PDO::FETCH_ASSOC)) {
    extract($record);
    $users = array(
      "ID" => $ID,
      "username" => $username
      );
    array_push($user_list, $users);
  }
  echo json_encode($user_list);
}

?>