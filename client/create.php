<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/client.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog client object
  $client = new Client($db);

  // Get raw cliented data
  $data = json_decode(file_get_contents("php://input"));

  $client->nomClient = $data->nomClient;
  $client->prenomClient = $data->prenomClient;
  $client->societeClient = $data->societeClient;
  $client->villeClient = $data->villeClient;
  $client->rueClient = $data->rueClient;
  $client->cpClient = $data->cpClient;
  $client->telClient = $data->telClient;
  $client->mailClient = $data->mailClient;

  // Create client
  if($client->create()) {
    echo json_encode(
      array('message' => 'client Created')
    );
  } else {
    echo json_encode(
      array('message' => 'client Not Created')
    );
  }

