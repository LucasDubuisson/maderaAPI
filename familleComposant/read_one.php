<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/familleComposant.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $familleComposant = new FamilleComposant($db);

  // Get ID
  $familleComposant->idFamilleComposant = isset($_GET['familleComposantId']) ? $_GET['familleComposantId'] : die();

  // Get post
  $familleComposant->read_one();
if ($familleComposant->libelleFamilleComposant!=null)
{
  // Create array
  $familleComposant_arr = array(
      "idFamilleComposant" => $familleComposant->idFamilleComposant,
      "libelleFamilleComposant" => $familleComposant->libelleFamilleComposant
  );


  // Make JSON
  http_response_code(200);
  print_r(json_encode($familleComposant_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Client does not exist."));
}
