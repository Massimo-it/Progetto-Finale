<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require '../include/conn.php';
require '../customerClass.php';

$customerMng = new customerMng($PDO);
$request = $customerMng->customerList();

if($request->rowCount() == 0 ) {
  echo json_encode(array("message" => "nessun cliente in elenco"));
  } else {
  $customer_list = array();
  while ($record = $request->fetch(PDO::FETCH_ASSOC)) {
    extract($record);
    $customers = array(
      "ID" => $ID,
      "customer_name" => $customer_name,
      "customer_email" => $customer_email,
      "customer_text" => $customer_text
      );
    array_push($customer_list, $customers);
  }
  echo json_encode($customer_list);
}

?>