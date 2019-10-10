<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/stocker.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $stocker = new Stocker($db);

  // Get ID
  $stocker->idStocker = isset($_GET['siteId']) ? $_GET['siteId'] : die();
  $stocker->idStocker = isset($_GET['productionsiteId']) ? $_GET['productionsiteId'] : die();
  $stocker->idStocker = isset($_GET['composantId']) ? $_GET['composantId'] : die();

  // Get post
  $stocker->read_one();

  // Create array
  $stocker_arr = array(
      "idSite" => $stocker->idSite,
      "idProductionSite" => $stocker->idProductionSite,
      "idComposant" => $stocker->idComposant,
      "quantite" => $stocker->quantite,
      "lastUpdateUserId" => $stocker->lastUpdateUserId
  );

  // Make JSON
  http_response_code(200);
  print_r(json_encode($stocker_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Stocker does not exist."));
}

