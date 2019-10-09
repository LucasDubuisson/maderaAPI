<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/stocker.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog stocker object
  $stocker = new Stocker($db);

  // Get raw stockered data
  $data = json_decode(file_get_contents("php://input"));

  $stocker->idSite = $data->idSite;
  $stocker->idProductionSite = $data->idProductionSite;
  $stocker->idComposant = $data->idComposant;
  $stocker->quantite = $data->quantite;
  $stocker->lastUpdateUserId = $data->lastUpdateUserId;

  // Create stocker
  if($stocker->create()) {
    echo json_encode(
      array('message' => 'stocker Created')
    );
  } else {
    echo json_encode(
      array('message' => 'stocker Not Created')
    );
  }

