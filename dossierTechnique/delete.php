<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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
  $dossier->idDossier = $data->idDossier;

  // Delete dossier
  if($dossier->delete()) {
    echo json_encode(
      array('message' => 'dossier Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'dossier Not Deleted')
    );
  }

