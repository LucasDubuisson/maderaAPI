<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/composant.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog service object
  $composant = new Composant($db);

  // Get raw serviceed data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $composant->idComposant = $data->idComposant;

  // Delete service
  if($composant->delete()) {
    echo json_encode(
      array('message' => 'composant Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'composant Not Deleted')
    );
  }

