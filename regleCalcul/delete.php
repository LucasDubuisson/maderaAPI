<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/regleCalcul.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog regleCalcul object
  $regleCalcul = new RegleCalcul($db);

  // Get raw regleCalculed data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $regleCalcul->idRegleCalcul = $data->idRegleCalcul;

  // Delete service
  if($regleCalcul->delete()) {
	  http_response_code(200);
    echo json_encode(
      array('message' => 'regleCalcul Deleted')
    );
  } else {
	  http_response_code(404);
    echo json_encode(
      array('message' => 'regleCalcul Not Deleted')
    );
  }

