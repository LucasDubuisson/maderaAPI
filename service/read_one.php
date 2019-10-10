<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/service.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $service = new Service($db);

  // Get ID
  $service->idService = isset($_GET['serviceId']) ? $_GET['serviceId'] : die();

  // Get post
  $service->read_one();
if ($service->libelleService!=null)
{
  // Create array
  $service_arr = array(
      "idService" => $service->idService,
      "libelleService" => $service->libelleService,
      "commentaireService" => $service->commentaireService,
      "idSite" => $service->idSite,
      "idDirection" => $service->idDirection
  );


  // Make JSON
  http_response_code(200);
  print_r(json_encode($service_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Service does not exist."));
}
