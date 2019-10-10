<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/dossierTechnique.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $dossier = new Dossier($db);

  // Get ID
  $dossier->idDossier = isset($_GET['dossierId']) ? $_GET['dossierId'] : die();

  // Get post
  $dossier->read_one();

  // Create array
  $dossier_arr = array(
      "idDossier" => $dossier->idDossier,
      "libelleDossier" => $dossier->libelleDossier,
      "resumeEnML" => $dossier->resumeEnML,
      "idDevis" => $dossier->idDevis
  );

  // Make JSON
  http_response_code(200);
  print_r(json_encode($dossier_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Dossier does not exist."));
}
