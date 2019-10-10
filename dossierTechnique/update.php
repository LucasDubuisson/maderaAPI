<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/dossierTechnique.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog dossier object
  $dossier = new Dossier($db);

  // Get raw dossiered data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
 
  $dossier->libelleDossier = $data->libelleDossier;
  $dossier->resumeEnML = $data->resumeEnML;
  $dossier->idDevis = $data->idDevis;
  $dossier->idDossier = $data->idDossier;

  // Update dossier
  if($dossier->update()) {
	    http_response_code(200);
    echo json_encode(
      array('message' => 'dossier Updated')
    );
  } else {
	    http_response_code(404);
    echo json_encode(
      array('message' => 'dossier Not Updated')
    );
  }

