<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/direction.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $direction = new Direction($db);

  // Category read query
  $result = $direction->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $direction_arr = array();
        $direction_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $direction_item = array(
            "idDirection" => $idDirection,
            "libelleDirection" => $libelleDirection
          );

          // Push to "data"
          array_push($direction_arr['data'], $direction_item);
        }

        // Turn to JSON & output
        echo json_encode($direction_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Direction Found')
        );
  }
