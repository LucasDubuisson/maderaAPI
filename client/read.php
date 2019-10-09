<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/client.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $client = new Client($db);

  // Category read query
  $result = $read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $client_arr = array();
        $client_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $client_item = array(
                  "idClient" => $idClient,
				  "nomClient" => $nomClient,
				  "prenomClient" => $prenomClient,
				  "societeClient" => $societeClient,
				  "villeClient" => $villeClient,
				  "rueClient" => $rueClient,
				  "cpClient" => $cpClient,
				  "telClient" => $telClient,
				  "mailClient" => $mailClient
          );

          // Push to "data"
          array_push($client_arr['data'], $client_item);
        }

        // Turn to JSON & output
        echo json_encode($client_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No clients Found')
        );
  }
