<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/service.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $service = new Service($db);

  // Category read query
  $result = $service->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $service_arr = array();
        $service_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $service_item = array(
            "idService" => $idService,
            "libelleService" => $libelleService,
            "commentaireService" => $commentaireService,
            "idSite" => $idSite,
            "idDirection" => $idDirection
          );

          // Push to "data"
          array_push($service_arr['data'], $service_item);
        }

        // Turn to JSON & output
        echo json_encode($service_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Services Found')
        );
  }
