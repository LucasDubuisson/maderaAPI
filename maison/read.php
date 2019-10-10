<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/maison.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $maison = new Maison($db);

  // Category read query
  $result = $maison->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $maison_arr = array();
        $maison_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $maison_item = array(
			  "idMaison" => $maison->idMaison,
			  "libelleMaison" => $maison->libelleMaison,
			  "dateCreationMaison" => $maison->dateCreationMaison,
			  "createdByUserIdMaison" => $maison->createdByUserIdMaison
          );

          // Push to "data"
          array_push($maison_arr['data'], $maison_item);
        }
    http_response_code(200);
        // Turn to JSON & output
        echo json_encode($maison_arr);

  } else {
	      http_response_code(404);
        // No Categories
        echo json_encode(
          array('message' => 'No Maisons Found')
        );
  }
