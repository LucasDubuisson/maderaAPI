<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/direction.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $direction = new Direction($db);

  // Get ID
  $direction->idDirection = isset($_GET['directionId']) ? $_GET['directionId'] : die();

  // Get post
  $direction->read_one();

  // Create array
  $direction_arr = array(
      "idDirection" => $direction->idDirection,
      "libelleDirection" => $direction->libelleDirection
      
  );

  // Make JSON
  http_response_code(200);
  print_r(json_encode($direction_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Direction does not exist."));
}
