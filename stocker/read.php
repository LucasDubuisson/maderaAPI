<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/stocker.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $stocker = new Stocker($db);

  // Category read query
  $result = $stocker->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $stocker_arr = array();
        $stocker_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $stocker_item = array(
            "idSite" => $idSite,
            "idProductionSite" => $idProductionSite,
            "idComposant" => $idComposant,
            "quantite" => $quantite,
            "lastUpdateUserId" => $lastUpdateUserId
          );

          // Push to "data"
          array_push($stocker_arr['data'], $stocker_item);
        }

        // Turn to JSON & output
        echo json_encode($stocker_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Stockers Found')
        );
  }
