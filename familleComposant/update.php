<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/familleComposant.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog familleComposant object
  $familleComposant = new FamilleComposant($db);

  // Get raw familleComposanted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
 
  $familleComposant->libelleFamilleComposant = $data->libelleFamilleComposant;
  $familleComposant->idFamilleComposant = $data->idFamilleComposant;

  // Update familleComposant
  if($familleComposant->update()) {
	      http_response_code(200);
    echo json_encode(
      array('message' => 'familleComposant Updated')
    );
  } else {
	      http_response_code(404);
    echo json_encode(
      array('message' => 'familleComposant Not Updated')
    );
  }

