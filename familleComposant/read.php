<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/familleComposant.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $familleComposant = new FamilleComposant($db);

  // Category read query
  $result = $familleComposant->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $familleComposant_arr = array();
        $familleComposant_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $familleComposant_item = array(
            "idFamilleComposant" => $idFamilleComposant,
            "libelleFamilleComposant" => $libelleFamilleComposant
          );

          // Push to "data"
          array_push($familleComposant_arr['data'], $familleComposant_item);
        }
    http_response_code(200);
        // Turn to JSON & output
        echo json_encode($familleComposant_arr);

  } else {
	      http_response_code(404);
        // No Categories
        echo json_encode(
          array('message' => 'No FamilleComposants Found')
        );
  }
