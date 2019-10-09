<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/direction.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog service object
  $direction = new Direction($db);

  // Get raw serviceed data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
 
  $direction->libelleDirection = $data->libelleDirection;
  $direction->idDirection = $data->idDirection;


  // Update service
  if($direction->update()) {
    echo json_encode(
      array('message' => 'direction Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'direction Not Updated')
    );
  }

