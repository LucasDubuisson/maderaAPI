<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/dossierTechnique.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $dossier = new Dossier($db);

  // Category read query
  $result = $dossier->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $dossier_arr = array();
        $dossier_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $dossier_item = array(
            "idDossier" => $idDossier,
            "libelleDossier" => $libelleDossier,
            "resumeEnML" => $resumeEnML
          );

          // Push to "data"
          array_push($dossier_arr['data'], $dossier_item);
        }
    http_response_code(200);
        // Turn to JSON & output
        echo json_encode($dossier_arr);

  } else {
	      http_response_code(404);
        // No Categories
        echo json_encode(
          array('message' => 'No Dossiers Found')
        );
  }
