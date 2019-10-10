<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/client.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $client = new Client($db);

  // Get ID
  $client->idClient = isset($_GET['clientId']) ? $_GET['clientId'] : die();

  // Get post
  $client->read_one();
if($client->nomClient!=null){
  // Create array
  $client_arr = array(
      "idClient" => $client->idClient,
      "nomClient" => $client->nomClient,
      "prenomClient" => $client->prenomClient,
      "societeClient" => $client->societeClient,
      "villeClient" => $client->villeClient,
	  "rueClient" => $client->rueClient,
      "cpClient" => $client->cpClient,
      "telClient" => $client->telClient,
      "mailClient" => $client->mailClient
  );

  // Make JSON
  http_response_code(200);
  print_r(json_encode($client_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Client does not exist."));
}
