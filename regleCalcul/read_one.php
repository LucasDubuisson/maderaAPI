<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/regleCalcul.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $regleCalcul = new RegleCalcul($db);

  // Get ID
  $regleCalcul->idRegleCalcul = isset($_GET['regleCalculId']) ? $_GET['regleCalculId'] : die();

  // Get post
  $regleCalcul->read_one();
if ($regleCalcul->ennonceRegleCalcul!=null)
{
  // Create array
  $regleCalcul_arr = array(
            "idRegleCalcul" => $idRegleCalcul,
            "ennonceRegleCalcul" => $ennonceRegleCalcul,
            "regleRegleCalcul" => $regleRegleCalcul
  );

  // Make JSON
  http_response_code(200);
  print_r(json_encode($regleCalcul_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "regleCalcul does not exist."));
}
