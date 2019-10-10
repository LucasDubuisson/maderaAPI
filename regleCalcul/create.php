<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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

  $regleCalcul->ennonceRegleCalcul = $data->ennonceRegleCalcul;
  $regleCalcul->regleRegleCalcul = $data->regleRegleCalcul;

  // Create regleCalcul
  if($regleCalcul->create()) {
	  http_response_code(200);
    echo json_encode(
      array('message' => 'regleCalcul Created')
    );
  } else {
	  http_response_code(404);
    echo json_encode(
      array('message' => 'regleCalcul Not Created')
    );
  }

