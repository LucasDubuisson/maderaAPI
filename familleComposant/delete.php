<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
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
  $familleComposant->idFamilleComposant = $data->idFamilleComposant;

  // Delete familleComposant
  if($familleComposant->delete()) {
    echo json_encode(
      array('message' => 'familleComposant Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'familleComposant Not Deleted')
    );
  }

