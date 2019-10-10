<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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

  // Set ID to update
  $stocker->idSite = $data->idSite;
  $stocker->idProductionSite = $data->idProductionSite;
  $stocker->idComposant = $data->idComposant;

  // Delete stocker
  if($stocker->delete()) {
	  http_response_code(200);
    echo json_encode(
      array('message' => 'stocker Deleted')
    );
  } else {
	  http_response_code(404);
    echo json_encode(
      array('message' => 'stocker Not Deleted')
    );
  }

