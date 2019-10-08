<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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

  $familleComposant->libelleFamilleComposant = $data->libelleFamilleComposant;

  // Create familleComposant
  if($familleComposant->create()) {
    echo json_encode(
      array('message' => 'familleComposant Created')
    );
  } else {
    echo json_encode(
      array('message' => 'familleComposant Not Created')
    );
  }

