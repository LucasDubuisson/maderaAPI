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
  print_r(json_encode($client_arr));
